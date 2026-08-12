<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

/**
 * Chatbot "Marime" — menjawab pertanyaan pengunjung berdasarkan
 * knowledge base FAQ (writable/chatbot/) via Gemini API.
 * Pertanyaan yang tak terjawab dieskalasi ke email admin.
 */
class Chat extends BaseController
{
    private const ESCALATE_MARKER = '[ESCALATE]';

    private const ESCALATION_MESSAGES = [
        'id' => "Maaf, informasi tersebut belum tersedia di pengetahuan saya saat ini.\n\nNamun jangan khawatir, Anda tetap dapat mengajukan permintaan informasi melalui kanal PPID PT Pelindo Marine Service, dan tim terkait akan membantu menindaklanjuti kebutuhan Anda. (Link ke Laman PPID)",
        'en' => "I'm sorry, that information is not currently available in my knowledge base.\n\nHowever, no worries. You can submit an information request through the PT Pelindo Marine Service PPID channel, and the relevant team will be happy to assist you further. (Link to PPID Page)",
    ];

    private const KNOWLEDGE_BASE_FILES = [
        'id' => 'FAQ.txt',
        'en' => 'FAQ-ENGLISH.txt',
    ];

    /** Kata-kata umum bahasa Indonesia yang jarang muncul di kalimat Inggris. */
    private const INDONESIAN_MARKERS = [
        'yang', 'dan', 'dengan', 'untuk', 'apa', 'apakah', 'bagaimana', 'berapa',
        'dimana', 'di mana', 'kapan', 'siapa', 'kenapa', 'mengapa', 'bisa', 'saya',
        'kami', 'anda', 'kamu', 'adalah', 'tidak', 'ada', 'dari', 'pada', 'ini', 'itu',
    ];

    public function respond(): ResponseInterface
    {
        $payload = $this->request->getJSON(true) ?? [];

        $message      = trim((string) ($payload['message'] ?? ''));
        $history      = is_array($payload['history'] ?? null) ? $payload['history'] : [];
        $visitorName  = trim((string) ($payload['visitor_name'] ?? ''));
        $visitorEmail = trim((string) ($payload['visitor_email'] ?? ''));
        $lang         = $payload['lang'] ?? null;

        if ($message === '' || mb_strlen($message) > 2000) {
            return $this->response->setStatusCode(422)->setJSON(['error' => 'Invalid message.']);
        }

        if (! in_array($lang, ['id', 'en'], true)) {
            $lang = $this->detectLanguage($message);
        }

        $escalationMessage = self::ESCALATION_MESSAGES[$lang];

        if ($visitorName !== '' || $visitorEmail !== '') {
            log_message('info', 'Chat visitor: {name} <{email}> — {message}', [
                'name'    => $visitorName,
                'email'   => $visitorEmail,
                'message' => $message,
            ]);
        }

        $apiKey        = $this->pelindo->geminiApiKey;
        $knowledgeBase = $this->knowledgeBase($lang);

        if ($apiKey === '' || $knowledgeBase === '') {
            return $this->escalate($escalationMessage, $visitorName, $visitorEmail, $message);
        }

        $contents = [];

        foreach ($history as $turn) {
            if (! is_array($turn) || ! in_array($turn['role'] ?? '', ['user', 'model'], true)) {
                continue;
            }
            $contents[] = [
                'role'  => $turn['role'],
                'parts' => [['text' => (string) ($turn['content'] ?? '')]],
            ];
        }

        $contents[] = ['role' => 'user', 'parts' => [['text' => $message]]];

        try {
            $model    = $this->pelindo->geminiModel;
            $response = service('curlrequest')->post(
                "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
                [
                    'timeout'     => 15,
                    'http_errors' => false,
                    'json'        => [
                        'system_instruction' => [
                            'parts' => [['text' => $this->systemInstruction($lang, $visitorName, $knowledgeBase)]],
                        ],
                        'contents' => $contents,
                    ],
                ],
            );

            if ($response->getStatusCode() !== 200) {
                throw new \RuntimeException('Gemini request failed: ' . $response->getBody());
            }

            $body = json_decode((string) $response->getBody(), true);
            $text = trim((string) ($body['candidates'][0]['content']['parts'][0]['text'] ?? ''));

            if ($text === '' || str_contains($text, self::ESCALATE_MARKER)) {
                return $this->escalate($escalationMessage, $visitorName, $visitorEmail, $message);
            }

            return $this->response->setJSON(['reply' => $text, 'escalated' => false]);
        } catch (\Throwable $e) {
            log_message('warning', 'Gemini chat error: ' . $e->getMessage());

            return $this->escalate($escalationMessage, $visitorName, $visitorEmail, $message);
        }
    }

    private function detectLanguage(string $message): string
    {
        $normalized = ' ' . strtolower($message) . ' ';

        foreach (self::INDONESIAN_MARKERS as $marker) {
            if (str_contains($normalized, ' ' . $marker . ' ')) {
                return 'id';
            }
        }

        return preg_match('/[a-z]/i', $message) === 1 ? 'en' : 'id';
    }

    private function knowledgeBase(string $lang): string
    {
        $path = WRITEPATH . 'chatbot/' . self::KNOWLEDGE_BASE_FILES[$lang];

        return cache()->remember("chat_knowledge_base_{$lang}", 3600, static function () use ($path): string {
            return is_file($path) ? (string) file_get_contents($path) : '';
        });
    }

    private function escalate(string $escalationMessage, string $visitorName, string $visitorEmail, string $question): ResponseInterface
    {
        $adminEmail = $this->pelindo->chatAdminEmail;

        if ($adminEmail !== '' && $visitorEmail !== '') {
            try {
                $email = service('email');
                $email->setTo($adminEmail);
                $email->setReplyTo($visitorEmail, $visitorName);
                $email->setSubject('Pertanyaan Baru dari Chatbot Pelindo Marine');
                $email->setMailType('html');
                $email->setMessage(view('chat_escalation_email', [
                    'visitorName'  => $visitorName,
                    'visitorEmail' => $visitorEmail,
                    'question'     => $question,
                ]));
                $email->send();
            } catch (\Throwable $e) {
                log_message('warning', 'Failed to send escalation email: ' . $e->getMessage());
            }
        }

        return $this->response->setJSON(['reply' => $escalationMessage, 'escalated' => true]);
    }

    private function systemInstruction(string $lang, string $visitorName, string $knowledgeBase): string
    {
        $escalateMarker   = self::ESCALATE_MARKER;
        $visitorFirstName = $visitorName !== '' ? explode(' ', $visitorName)[0] : '';

        if ($lang === 'en') {
            return <<<TEXT
                You are Marime, a warm, friendly customer service assistant for PT Pelindo Marine Service. The visitor's name is "{$visitorFirstName}" (empty if unknown).

                TONE:
                - Be as warm, welcoming, and enthusiastic as possible, like a helpful friend, while staying professional.
                - Address the visitor by their first name when it's known, naturally worked into the reply (not every single sentence).
                - Use a friendly emoji occasionally (😊, 👍, 🚢, ✅) where it fits, but don't overdo it.
                - Show empathy and appreciation for the question before or while answering it.

                SMALL TALK EXCEPTION:
                - If the user is just making small talk, greeting you, complimenting you, or joking around (not actually asking for information about PT Pelindo Marine Service), do NOT escalate and do NOT use the KNOWLEDGE BASE. Instead, reply playfully and warmly — feel free to be a little funny, e.g. a short witty rhyme or lighthearted joke, then gently invite them to ask something about Pelindo Marine's services. Do not add the closing sentence from rule 6 in this case.

                STRICT RULES:
                1. For any actual question about PT Pelindo Marine Service, you may ONLY answer using information found in the KNOWLEDGE BASE below. Never use general knowledge or assumptions outside of it.
                2. If such a question cannot be answered using the KNOWLEDGE BASE below (the topic isn't covered, the information isn't there, or you're not sure), reply with EXACTLY this text and nothing else: {$escalateMarker}
                3. Do not make up answers. Do not go outside the PT Pelindo Marine Service topics covered in the KNOWLEDGE BASE.
                4. You may rephrase sentences from the KNOWLEDGE BASE for readability, but the content must stay faithful to the source.
                5. Format the answer neatly: for multiple points, lists of services, or sequences, use bullet lists ("- item") or numbered lists ("1. item") with each item on its own line. Separate paragraphs with a blank line. Use **bold text** only for important terms.
                6. After fully answering a real knowledge-base question (only when you are NOT replying with {$escalateMarker} and it's not small talk per the exception above), end your reply with a new paragraph containing exactly this closing sentence: "I hope the information provided was helpful. 😊 If you have any other questions about PT Pelindo Marine Service, feel free to reach out anytime. Have a great day and see you again."

                === KNOWLEDGE BASE ===
                {$knowledgeBase}
                === END OF KNOWLEDGE BASE ===
                TEXT;
        }

        return <<<TEXT
            Kamu adalah Marime, asisten customer service PT Pelindo Marine Service yang hangat dan ramah. Nama pengunjung adalah "{$visitorFirstName}" (kosong jika belum diketahui).

            GAYA BICARA:
            - Bersikap seramah dan sehangat mungkin, seperti teman yang senang membantu, namun tetap profesional.
            - Sapa pengunjung dengan nama depannya jika diketahui, diselipkan secara natural dalam jawaban (tidak perlu di setiap kalimat).
            - Sesekali gunakan emoji yang ramah (😊, 👍, 🚢, ✅) bila pas, tapi jangan berlebihan.
            - Tunjukkan empati dan apresiasi atas pertanyaan pengguna sebelum atau sambil menjawab.

            PENGECUALIAN OBROLAN SANTAI:
            - Jika pengguna cuma basa-basi, menyapa, memuji kamu, atau bercanda (bukan benar-benar menanyakan informasi tentang PT Pelindo Marine Service), JANGAN escalate dan JANGAN pakai KNOWLEDGE BASE. Balas dengan santai dan hangat — boleh sedikit lucu, misalnya bikin pantun singkat yang jenaka atau candaan ringan, lalu ajak dia dengan ramah untuk bertanya seputar layanan Pelindo Marine kalau ada yang ingin diketahui. Jangan tambahkan kalimat penutup dari aturan 6 dalam kasus ini.

            ATURAN KETAT:
            1. Untuk pertanyaan sungguhan tentang PT Pelindo Marine Service, kamu HANYA boleh menjawab menggunakan informasi yang ada di dalam KNOWLEDGE BASE di bawah ini. Jangan pernah menggunakan pengetahuan umum atau asumsi di luar itu.
            2. Jika pertanyaan semacam itu tidak dapat dijawab menggunakan KNOWLEDGE BASE di bawah (topiknya tidak dibahas, informasinya tidak ada, atau kamu tidak yakin), balas HANYA dengan teks persis: {$escalateMarker}
            3. Jangan mengarang jawaban. Jangan keluar dari topik layanan PT Pelindo Marine Service yang ada di KNOWLEDGE BASE.
            4. Kamu boleh merangkai ulang kalimat dari KNOWLEDGE BASE agar enak dibaca, tetapi isinya harus tetap sesuai sumber.
            5. Format jawaban dengan rapi: jika menyebutkan beberapa poin, daftar layanan, atau urutan, gunakan list bullet ("- item") atau list bernomor ("1. item") dengan setiap item di baris baru. Pisahkan paragraf dengan baris kosong. Gunakan **teks tebal** hanya untuk istilah penting.
            6. Setelah selesai menjawab pertanyaan sungguhan dari knowledge base (HANYA jika kamu TIDAK membalas dengan {$escalateMarker} dan ini bukan obrolan santai sesuai pengecualian di atas), akhiri jawabanmu dengan paragraf baru berisi persis kalimat penutup ini: "Semoga informasi yang saya berikan dapat membantu. Jika masih ada pertanyaan lain terkait PT Pelindo Marine Service, jangan ragu untuk menghubungi saya kembali. Selamat melanjutkan aktivitas dan sampai jumpa!"

            === KNOWLEDGE BASE ===
            {$knowledgeBase}
            === AKHIR KNOWLEDGE BASE ===
            TEXT;
    }
}
