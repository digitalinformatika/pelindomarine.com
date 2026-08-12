# Migrasi Pelindo Marine: CodeIgniter 3 → CodeIgniter 4

Hasil porting dari repo `pelindo-marine` (CI3) ke project ini (CI 4.7, PHP ^8.2).

## Menjalankan

1. Siapkan database MySQL `website_pms` (import dump dari server), lalu sesuaikan
   kredensial di `.env` (`database.default.*`).
2. `php spark serve` → buka http://localhost:8080

## Pemetaan kode

| CI3 | CI4 |
|---|---|
| `application/controllers/Homepage.php` | `app/Controllers/Home.php` |
| `application/controllers/FormWizard.php` | `app/Controllers/FormWizard.php` (HTML dokumen dipindah ke view `ppid_form_document.php`) |
| `application/models/Homepage_m.php` (juga berisi `Webmeta_m`) | `app/Models/HomepageModel.php`, `app/Models/WebmetaModel.php` |
| `Company_m`, `News_m`, `Services_m`, `Search_m`, `Save_ppid` | `CompanyModel`, `NewsModel`, `ServicesModel`, `SearchModel`, `PpidModel` |
| `application/views/*` | `app/Views/*` (file backup/tak terpakai tidak diporting) |
| `assets/`, `images/` | `public/assets/`, `public/images/` |
| routes di `application/config/routes.php` | `app/Config/Routes.php` |

Render header/page/footer kini lewat `BaseController::renderPage()`.

## Konfigurasi (baru, via `.env` / `app/Config/Pelindo.php`)

Nilai yang dulu hardcoded kini configurable:

- `pelindo.contactEmail` — penerima form kontak / marine care
- `pelindo.ppidRecipients` — penerima notifikasi E-PPID
- `pelindo.ppidMailApi` + `pelindo.ppidMailApiKey` — API pengirim email PPID
- `newsPerPage`, `defaultLanguage` — di `app/Config/Pelindo.php`

## Perbaikan sekalian dilakukan

- **SQL injection** di pencarian berita & kapal (query string disambung langsung)
  diganti query builder dengan binding.
- Output form PPID di dokumen kini di-escape (`esc()`).
- Notifikasi PPID pakai `curlrequest` service + logging, tidak lagi curl mentah.
- Pagination berita memakai Pager bawaan CI4 (tampilan default CI4 — sesuaikan
  template pager bila ingin gaya lama).

## Tidak diporting (dead code di CI3)

- `Contact.php` (kode contoh, email tujuan pribadi, view-nya tidak ada)
- `Company.php` (duplikat class Homepage, rusak), `Profil.php` (tidak valid)
- View backup: `ppid_backup.php`, `profiles_backup*.php`, `profiles_20240812.php`,
  `generatepost.php` (tidak direferensikan controller manapun)

## Catatan penting

- Folder `upload/` (gambar konten: `upload/homepage/...`, `upload/maps/...`, dst.)
  **tidak ada di repo CI3** — hanya ada di server produksi. Salin folder itu ke
  `public/upload/` agar gambar tampil. Submit E-PPID menulis file ke
  `public/upload/ppid/`.
- Folder `main/uploads` (551MB, upload CMS lama) tidak disalin; salin manual bila
  masih dipakai.
- Stored procedure `cekMasaWelcomeScreen()` harus ada di database.
- Form kontak memakai email service CI4; set konfigurasi SMTP di `.env`
  (`email.*`) atau `app/Config/Email.php` agar benar-benar terkirim.
