<?php

/**
 * Helper khusus website Pelindo Marine.
 * Dimuat otomatis lewat $helpers di BaseController.
 */

if (! function_exists('friendlyURL')) {
    /**
     * Mengubah string menjadi slug URL (dipakai di view vessel).
     */
    function friendlyURL(string $string): string
    {
        $string = preg_replace('`\[.*\]`U', '', $string);
        $string = str_replace('&', '-', $string);
        $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = str_replace('&quot;', '-', $string);
        $string = preg_replace('`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i', '\\1', $string);
        $string = preg_replace(['`[^a-z0-9]`i', '`[-]+`'], '-', $string);

        return strtolower(trim($string, '-'));
    }
}

if (! function_exists('uri_segment')) {
    /**
     * Pengganti $this->uri->segment(n) milik CI3 untuk dipakai di view.
     * Mengembalikan string kosong bila segmen tidak ada.
     */
    function uri_segment(int $n): string
    {
        $segments = service('uri')->getSegments();

        return $segments[$n - 1] ?? '';
    }
}

if (! function_exists('cms_media_base')) {
    /**
     * Domain CMS untuk file media (Config\Pelindo::$mediaBaseUrl),
     * tanpa slash di akhir. Kosong bila tidak diset.
     */
    function cms_media_base(): string
    {
        static $base = null;

        if ($base === null) {
            $base = rtrim(trim((string) (config('Pelindo')->mediaBaseUrl ?? '')), '/');
        }

        return $base;
    }
}

if (! function_exists('struktur_media_url')) {
    /**
     * Resolve media URL for organization structure photos and hero banners.
     */
    function struktur_media_url(?string $filename, string $defaultPlaceholder = ''): string
    {
        if ($filename === null || trim($filename) === '') {
            return $defaultPlaceholder;
        }

        $filename = trim($filename);

        if (str_starts_with($filename, 'http://') || str_starts_with($filename, 'https://')) {
            return $filename;
        }

        // Check if file exists under uploads/struktur_organisasi/
        if (is_file(FCPATH . 'uploads/struktur_organisasi/' . $filename)) {
            return base_url('uploads/struktur_organisasi/' . $filename);
        }

        // Check general uploads folder
        if (is_file(FCPATH . 'uploads/' . $filename)) {
            return base_url('uploads/' . $filename);
        }

        // Check legacy upload folder
        if (is_file(FCPATH . 'upload/' . $filename)) {
            return base_url('upload/' . $filename);
        }

        // Production: file dilayani langsung dari domain CMS
        if (cms_media_base() !== '') {
            return cms_media_base() . '/uploads/struktur_organisasi/' . $filename;
        }

        // Local development: check if file was uploaded to CMS project uploads folder
        $cmsPath = dirname(FCPATH, 2) . DIRECTORY_SEPARATOR . 'cms.pelindomarine.com' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'struktur_organisasi' . DIRECTORY_SEPARATOR . $filename;
        if (is_file($cmsPath)) {
            // Also copy to local uploads/struktur_organisasi so it is served by the main web server
            $dest = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'struktur_organisasi' . DIRECTORY_SEPARATOR . $filename;
            $destDir = dirname($dest);
            if (! is_dir($destDir)) {
                @mkdir($destDir, 0775, true);
            }
            if (! is_file($dest)) {
                @copy($cmsPath, $dest);
            }
            return base_url('uploads/struktur_organisasi/' . $filename);
        }

        return base_url('uploads/struktur_organisasi/' . $filename);
    }
}

if (! function_exists('struktur_banner_url')) {
    /**
     * Resolve hero banner URL for organization structure pages.
     *
     * Unlike struktur_media_url(), this returns $fallbackUrl when the file
     * referenced in the database does not physically exist anywhere, so the
     * page never renders an empty (404) background. Sementara fallback memakai
     * banner halaman About Us (upload/about-bgheader.jpg).
     */
    function struktur_banner_url(?string $filename, ?string $fallbackUrl = null): string
    {
        $fallbackUrl ??= base_url('upload/about-bgheader.jpg');

        if ($filename === null || trim($filename) === '') {
            return $fallbackUrl;
        }

        $filename = trim($filename);

        if (str_starts_with($filename, 'http://') || str_starts_with($filename, 'https://')) {
            return $filename;
        }

        $cmsPath = dirname(FCPATH, 2) . DIRECTORY_SEPARATOR . 'cms.pelindomarine.com'
            . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads'
            . DIRECTORY_SEPARATOR . 'struktur_organisasi' . DIRECTORY_SEPARATOR . $filename;

        // Bila domain CMS diset, file dianggap tersedia di sana (tidak dicek lewat HTTP)
        $exists = cms_media_base() !== ''
            || is_file(FCPATH . 'uploads/struktur_organisasi/' . $filename)
            || is_file(FCPATH . 'uploads/' . $filename)
            || is_file(FCPATH . 'upload/' . $filename)
            || is_file($cmsPath);

        return $exists ? struktur_media_url($filename) : $fallbackUrl;
    }
}

if (! function_exists('cms_media_url')) {
    /**
     * URL publik file yang di-upload lewat modul CMS (kolom path relatif
     * terhadap folder uploads, mis. "regulasi/2026/09/abc.pdf").
     *
     * Urutan pencarian:
     *  1. public/uploads/<path>            (shared storage / mounting GCS)
     *  2. public/<legacyDir>/<nama file>   (file warisan website lama)
     *  3. repo CMS di sebelah repo ini     (development lokal, disalin ke uploads/)
     *  4. URL absolut bila path sudah berupa http(s)
     * Bila tidak ditemukan di mana pun, tetap kembalikan URL uploads/<path>
     * (atau null bila path kosong), kecuali $nullIfMissing = true.
     */
    function cms_media_url(?string $rel, string $legacyDir = 'upload', bool $nullIfMissing = false): ?string
    {
        if ($rel === null || trim($rel) === '') {
            return null;
        }

        $rel = ltrim(trim($rel), '/\\');

        if (str_starts_with($rel, 'http://') || str_starts_with($rel, 'https://')) {
            return $rel;
        }

        if (is_file(FCPATH . 'uploads/' . $rel)) {
            return base_url('uploads/' . $rel);
        }

        $legacy = trim($legacyDir, '/') . '/' . basename($rel);
        if ($legacyDir !== '' && is_file(FCPATH . $legacy)) {
            return base_url($legacy);
        }

        // Production: file dilayani langsung dari domain CMS (pelindo.mediaBaseUrl).
        if (cms_media_base() !== '') {
            return cms_media_base() . '/uploads/' . $rel;
        }

        // Development lokal: file ada di folder upload repo CMS.
        $cmsPath = dirname(FCPATH, 2) . DIRECTORY_SEPARATOR . 'cms.pelindomarine.com'
            . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $rel;
        if (is_file($cmsPath)) {
            $dest = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . $rel;
            if (! is_dir(dirname($dest))) {
                @mkdir(dirname($dest), 0775, true);
            }
            if (! is_file($dest)) {
                @copy($cmsPath, $dest);
            }

            return base_url('uploads/' . $rel);
        }

        return $nullIfMissing ? null : base_url('uploads/' . $rel);
    }
}

if (! function_exists('officer_slug')) {
    /**
     * Generate standard SEO friendly URL slug for an officer.
     */
    function officer_slug(array $officer): string
    {
        $name = !empty($officer['nama']) ? $officer['nama'] : (!empty($officer['NAMA']) ? $officer['NAMA'] : '');
        if ($name !== '') {
            return friendlyURL($name);
        }
        $jabatan = !empty($officer['jabatan']) ? $officer['jabatan'] : (!empty($officer['JABATAN']) ? $officer['JABATAN'] : '');
        if ($jabatan !== '') {
            return friendlyURL($jabatan);
        }
        $id = $officer['struktur_id'] ?? ($officer['STRUKTUR_ID'] ?? 'pejabat');
        return 'pejabat-' . $id;
    }
}

