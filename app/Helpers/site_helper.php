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
