<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Konfigurasi khusus aplikasi Pelindo Marine.
 * Nilai default di bawah dapat di-override lewat file .env
 * dengan prefix "pelindo.", contoh: pelindo.contactEmail = 'x@y.com'
 */
class Pelindo extends BaseConfig
{
    /** Email penerima form kontak / marine care */
    public string $contactEmail = 'info@pelindomarine.com';

    /**
     * Folder penyimpanan file upload/arsip form.
     * Kosong = public/upload. Di production diarahkan ke folder
     * mounting bucket GCS pada VM (mis. pelindo.uploadPath = /mnt/gcs/upload),
     * tanpa perlu credential/SDK GCS.
     */
    public string $uploadPath = '';

    /**
     * Domain CMS tempat file media (banner, foto pejabat, dokumen, dsb.)
     * di-upload. Bila diisi, website memuat file yang tidak ada di folder
     * public/uploads miliknya dari <mediaBaseUrl>/uploads/<path>.
     * Contoh: pelindo.mediaBaseUrl = https://cms.pelindomarine.com
     * Kosong = hanya folder lokal (development: otomatis salin dari repo CMS).
     */
    public string $mediaBaseUrl = '';

    /** Penerima notifikasi form E-PPID (dipisah koma) */
    public string $ppidRecipients = '';

    /** Endpoint API pengirim email PPID */
    public string $ppidMailApi = '';

    /** API key untuk endpoint email PPID */
    public string $ppidMailApiKey = '';

    /** Jumlah berita per halaman pada halaman news */
    public int $newsPerPage = 13;

    /** Bahasa default website */
    public string $defaultLanguage = 'english';

    /** API key Gemini untuk chatbot (kosong = chatbot selalu eskalasi) */
    public string $geminiApiKey = '';

    /** Model Gemini yang dipakai chatbot */
    public string $geminiModel = 'gemini-flash-latest';

    /** Email admin penerima eskalasi pertanyaan chatbot yang tak terjawab */
    public string $chatAdminEmail = '';

    // ---- Section "Media Sosial" di homepage ----

    /** Channel ID YouTube (embed video otomatis menampilkan upload terbaru) */
    public string $youtubeChannelId = 'UC1Jcoic__w92PEOYjrJ3aBw';

    /** URL halaman Facebook untuk Page Plugin */
    public string $facebookPageUrl = 'https://www.facebook.com/pelindomarines/';

    /** Username Instagram (untuk link & kartu profil) */
    public string $instagramUser = 'pelindomarines';

    /**
     * URL post/reel Instagram yang di-embed di homepage (embed resmi IG
     * hanya mendukung post individual). Ganti berkala dengan post terbaru.
     */
    public string $instagramPostUrl = '';

    /** Akun sosial lain untuk baris tombol follow */
    public string $linkedinUrl = 'https://www.linkedin.com/company/pt-pelindo-marines/';
    public string $twitterUrl  = 'https://twitter.com/pelindomarines';
    public string $youtubeUrl  = 'https://www.youtube.com/c/PelindoMarines';

    public function __construct()
    {
        parent::__construct();

        if ($this->uploadPath === '') {
            $this->uploadPath = FCPATH . 'upload';
        }

        $this->uploadPath   = rtrim($this->uploadPath, '/\\');
        $this->mediaBaseUrl = rtrim(trim($this->mediaBaseUrl), '/');
    }
}
