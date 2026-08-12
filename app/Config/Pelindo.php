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
}
