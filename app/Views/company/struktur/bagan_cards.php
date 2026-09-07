<?php
/**
 * Bagan Cards (Alias for Template 2: Kartu Foto)
 * Delegates rendering to company/struktur/template-2
 */
echo view('company/struktur/template-2', [
    'tree'     => $tree ?? [],
    'officers' => $officers ?? [],
    'isIndo'   => $isIndo ?? false,
    'template' => $template ?? [],
]);
