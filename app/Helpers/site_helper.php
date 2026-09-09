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

if (! function_exists('struktur_banner_css')) {
    /**
     * Nilai CSS background-image untuk banner: gambar CMS di lapisan depan,
     * gambar cadangan di lapisan belakang. Bila file CMS gagal dimuat
     * (mis. 404 di domain CMS), browser tetap menampilkan gambar cadangan.
     *
     * Contoh hasil: url('https://cms/uploads/x.jpg'), url('https://web/upload/about-bgheader.jpg')
     */
    function struktur_banner_css(?string $filename, ?string $fallbackUrl = null): string
    {
        $fallbackUrl ??= base_url('upload/about-bgheader.jpg');
        $primary       = struktur_banner_url($filename, $fallbackUrl);

        $layers = [$primary];
        if ($primary !== $fallbackUrl) {
            $layers[] = $fallbackUrl;
        }

        return implode(', ', array_map(static fn (string $u) => "url('" . esc($u, 'attr') . "')", $layers));
    }
}

if (! function_exists('media_img_url')) {
    /**
     * URL gambar untuk modul yang punya file warisan website lama DAN upload
     * baru lewat CMS (berita, kapal, dsb). Nilai kolom di database bisa berupa
     * path lama ("news/news_684.jpg") maupun path CMS ("2026/09/abc.jpg").
     *
     * Urutan pencarian:
     *  1. public/uploads/<module>/<rel>        (upload CMS, shared storage)
     *  2. public/<legacyDir>/<rel> dan public/<legacyDir>/<basename>  (file lama)
     *  3. <pelindo.mediaBaseUrl>/uploads/<module>/<rel>  (domain CMS, production)
     *  4. repo CMS di sebelah repo ini          (development lokal, disalin)
     *  5. $fallback
     *
     * @param list<string> $legacyDirs folder lama relatif public/, mis. ['upload/news', 'main/uploads/informasi']
     */
    function media_img_url(?string $rel, string $module, array $legacyDirs = [], ?string $fallback = null): ?string
    {
        if ($rel === null || trim($rel) === '') {
            return $fallback;
        }

        $rel    = ltrim(trim($rel), '/\\');
        $module = trim($module, '/');

        if (str_starts_with($rel, 'http://') || str_starts_with($rel, 'https://')) {
            return $rel;
        }

        // 1. upload CMS di folder website
        foreach (array_filter(['uploads/' . $module . '/' . $rel, 'uploads/' . $rel]) as $p) {
            if (is_file(FCPATH . $p)) {
                return base_url($p);
            }
        }

        // 2. file warisan website lama
        $base = basename($rel);
        foreach ($legacyDirs as $dir) {
            $dir = trim($dir, '/');
            foreach (array_unique([$dir . '/' . $rel, $dir . '/' . $base]) as $p) {
                if (is_file(FCPATH . $p)) {
                    return base_url($p);
                }
            }
        }

        // 3. production: domain CMS.
        //    Upload CMS selalu berpola "YYYY/MM/nama" -> /uploads/<module>/...
        //    Selain itu berarti file warisan website lama -> /main/uploads/<module>/...
        //    (dilayani route FileServer::mainUploads di CMS).
        if (cms_media_base() !== '') {
            $isCmsUpload = (bool) preg_match('#^\d{4}/\d{2}/#', $rel);

            return cms_media_base() . ($isCmsUpload ? '/uploads/' : '/main/uploads/') . $module . '/' . $rel;
        }

        // 4. development lokal: salin dari repo CMS (upload baru) atau dari
        //    repo website lama di sebelah repo ini (file warisan).
        $repoRoot = dirname(FCPATH, 2) . DIRECTORY_SEPARATOR;
        $sources  = [
            [$repoRoot . 'cms.pelindomarine.com/public/uploads/' . $module . '/' . $rel, 'uploads/' . $module . '/' . $rel],
        ];
        foreach ($legacyDirs as $dir) {
            $dir = trim($dir, '/');
            // Disalin ke public/uploads/<module>/ (diabaikan git), bukan ke public/upload/ yang ikut repo
            foreach (array_unique([$dir . '/' . $rel, $dir . '/' . $base]) as $p) {
                $sources[] = [$repoRoot . 'website-pms-gcp/' . $p, 'uploads/' . $module . '/' . $rel];
            }
        }
        foreach ($sources as [$src, $relDest]) {
            if (! is_file($src)) {
                continue;
            }
            $dest = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $relDest);
            if (! is_dir(dirname($dest))) {
                @mkdir(dirname($dest), 0775, true);
            }
            if (! is_file($dest)) {
                @copy($src, $dest);
            }

            return base_url($relDest);
        }

        return $fallback;
    }
}

if (! function_exists('img_fallback_attr')) {
    /**
     * Atribut onerror untuk <img>: bila gambar gagal dimuat (mis. 404 di
     * domain CMS), ganti ke gambar cadangan sekali saja.
     */
    function img_fallback_attr(string $fallbackUrl): string
    {
        return 'onerror="this.onerror=null;this.src=\'' . esc($fallbackUrl, 'attr') . '\';"';
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

