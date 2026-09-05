<?php
    $weblangs = session('weblang');
    if (strval($weblangs) == '') $weblangs = 'english';
    $isIndo = ($weblangs === 'indonesia');

    // Resolve current officer details
    $officerName = !empty($officer['NAMA']) ? $officer['NAMA'] : (!empty($officer['JABATAN']) ? $officer['JABATAN'] : 'Pejabat Pelindo Marine');
    $officerJabatan = !empty($officer['JABATAN']) ? $officer['JABATAN'] : '';
    $officerDesc = !empty($officer['DESCRIPTION']) ? $officer['DESCRIPTION'] : '';

    // Hero banner configuration
    $bannerImg = !empty($banner['GAMBAR']) ? struktur_media_url($banner['GAMBAR']) : base_url('upload/about-bgheader.jpg');
    $heroTitle = $isIndo
        ? (!empty($banner['JUDUL']) ? $banner['JUDUL'] : 'PROFIL PEJABAT')
        : (!empty($banner['TITLE']) ? $banner['TITLE'] : 'EXECUTIVE PROFILE');
    $heroSubtitle = $isIndo
        ? (!empty($banner['SUB_JUDUL']) ? $banner['SUB_JUDUL'] : 'Struktur Organisasi')
        : (!empty($banner['SUB_TITLE']) ? $banner['SUB_TITLE'] : 'Organization Structure');

    // Legacy photo mappings for fallback
    $legacyPhotos = [
        'm-masyhud'            => 'board-m-masyhud_komut.png?ver=2',
        'andrei'               => 'board-andrei.png',
        'warsilan'             => 'board4.png?ver=1',
        'elvin'                => 'board-dirkom-elvin.png',
        'lia-indi-agustiana'   => 'board5.jpg',
        'perbager'             => 'board-perbager.png',
    ];

    $curSlug = !empty($currentSlug) ? strtolower($currentSlug) : officer_slug($officer);
    $profilSlug = !empty($template['SLUG']) ? trim($template['SLUG']) : 'profil-1';
    $resolvedPhoto = '';
    if (!empty($officer['FOTO'])) {
        $resolvedPhoto = struktur_media_url($officer['FOTO']);
    } elseif (isset($legacyPhotos[$curSlug])) {
        $resolvedPhoto = base_url('upload/homepage/' . $legacyPhotos[$curSlug]);
    }

    // Group all officers for sidebar
    $komisarisList = [];
    $direksiList = [];
    foreach ($allOfficers as $row) {
        if (empty($row['NAMA'])) continue;
        $jabLower = strtolower($row['JABATAN'] ?? '');
        if (str_contains($jabLower, 'komisaris') || str_contains($jabLower, 'commissioner')) {
            $komisarisList[] = $row;
        } else {
            $direksiList[] = $row;
        }
    }

    $txtBreadcrumbHome = 'Home';
    $txtBreadcrumbParent = $isIndo ? 'Struktur Organisasi' : 'Organization Structure';
    $txtBackToChart = $isIndo ? 'Kembali ke Bagan Organisasi' : 'Back to Org Chart';
    $txtKomisarisTitle = $isIndo ? 'Dewan Komisaris' : 'Board of Commissioners';
    $txtDireksiTitle = $isIndo ? 'Dewan Direksi' : 'Board of Directors';
?>

<!-- Hero Header -->
<section id="pms-inner-header" style="background-image: url('<?= esc($bannerImg, 'attr') ?>'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row animate-box breadcumb-box">
            <div class="col-md-6 col-xs-12">
                <h5><?= esc($heroSubtitle) ?></h5>
                <h2><?= esc($heroTitle) ?></h2>
            </div>
            <div class="col-md-6 col-xs-12 text-right">
                <div class="breadcumbs">
                    <a href="<?= base_url('/') ?>" class="text-light"><?= $txtBreadcrumbHome ?></a> / 
                    <a href="<?= site_url('company/organization-structure') ?>" class="text-light"><?= $txtBreadcrumbParent ?></a> / 
                    <b><span class="text-light"><?= esc($officerName) ?></span></b>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Block -->
<section id="pms-innerblock">
    <div class="container animate-box" style="background: #ffffff; margin-top: -80px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); padding: 40px 25px 60px;">
        <div class="row">
            <!-- Back button bar -->
            <div class="col-md-12 mb-4">
                <a href="<?= site_url('company/organization-structure') ?>" class="pms-profile-back-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span><?= $txtBackToChart ?></span>
                </a>
            </div>

            <!-- Left Column: Navigation Directory Sidebar -->
            <div class="col-md-4 col-sm-5 col-xs-12">
                <div class="pms-profile-sidebar">
                    <!-- Dewan Komisaris Group -->
                    <?php if (!empty($komisarisList)) : ?>
                        <div class="pms-sidebar-group">
                            <div class="pms-sidebar-group-title"><?= $txtKomisarisTitle ?></div>
                            <ul class="pms-sidebar-nav">
                                <?php foreach ($komisarisList as $item) : 
                                    $itemSlug = officer_slug($item);
                                    $isActive = ($itemSlug === $curSlug || (int)($item['STRUKTUR_ID'] ?? 0) === (int)($officer['STRUKTUR_ID'] ?? 0));
                                ?>
                                    <li>
                                        <a href="<?= site_url('profile/' . $itemSlug) ?>" class="pms-sidebar-item <?= $isActive ? 'active' : '' ?>">
                                            <span class="pms-sidebar-indicator"></span>
                                            <div class="pms-sidebar-item-text">
                                                <div class="pms-sidebar-item-name"><?= esc($item['NAMA'] ?? '-') ?></div>
                                                <div class="pms-sidebar-item-role"><?= esc($item['JABATAN'] ?? '') ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Dewan Direksi Group -->
                    <?php if (!empty($direksiList)) : ?>
                        <div class="pms-sidebar-group mt-4">
                            <div class="pms-sidebar-group-title"><?= $txtDireksiTitle ?></div>
                            <ul class="pms-sidebar-nav">
                                <?php foreach ($direksiList as $item) : 
                                    $itemSlug = officer_slug($item);
                                    $isActive = ($itemSlug === $curSlug || (int)($item['STRUKTUR_ID'] ?? 0) === (int)($officer['STRUKTUR_ID'] ?? 0));
                                ?>
                                    <li>
                                        <a href="<?= site_url('profile/' . $itemSlug) ?>" class="pms-sidebar-item <?= $isActive ? 'active' : '' ?>">
                                            <span class="pms-sidebar-indicator"></span>
                                            <div class="pms-sidebar-item-text">
                                                <div class="pms-sidebar-item-name"><?= esc($item['NAMA'] ?? '-') ?></div>
                                                <div class="pms-sidebar-item-role"><?= esc($item['JABATAN'] ?? '') ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Officer Profile Content -->
            <div class="col-md-8 col-sm-7 col-xs-12">
                <div class="pms-profile-content-card">
                    <!-- Profile Header with Portrait -->
                    <div class="pms-profile-main-header">
                        <?php if ($resolvedPhoto !== '') : ?>
                            <div class="pms-profile-photo-box">
                                <img src="<?= esc($resolvedPhoto, 'attr') ?>" alt="<?= esc($officerName, 'attr') ?>" class="pms-profile-photo img-fluid">
                            </div>
                        <?php endif; ?>

                        <div class="pms-profile-identity">
                            <span class="pms-profile-role-badge"><?= esc($officerJabatan) ?></span>
                            <h2 class="pms-profile-fullname"><?= esc($officerName) ?></h2>
                            <?php if (!empty($officerDesc)) : ?>
                                <p class="pms-profile-lead-desc"><?= nl2br(esc($officerDesc)) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Dynamic Sections from DB (struktur_organisasi_profil) -->
                    <div class="pms-profile-sections-wrap">
                        <?php if (empty($sections)) : ?>
                            <!-- Fallback / Empty State -->
                            <div class="pms-profile-empty-hint">
                                <p class="text-muted"><?= $isIndo ? 'Informasi detail profil pejabat ini dapat diperbarui melalui CMS.' : 'Detailed biographical sections for this officer can be maintained via CMS.' ?></p>
                            </div>
                        <?php elseif ($profilSlug === 'profil-2') : ?>
                            <!-- Layout Template: Profil Tab -->
                            <div class="pms-profile-tabs-container">
                                <div class="pms-tab-nav-wrapper">
                                    <button type="button" class="pms-tab-scroll-btn pms-tab-scroll-left" id="pmsTabScrollLeft" aria-label="Scroll left">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="15 18 9 12 15 6"></polyline>
                                        </svg>
                                    </button>
                                    <div class="pms-tab-nav-scroller" id="pmsTabNavScroller">
                                        <div class="pms-tab-nav-bar" role="tablist">
                                            <?php foreach ($sections as $idx => $sec) :
                                                $secTitle = $isIndo
                                                    ? (!empty($sec['JUDUL']) ? $sec['JUDUL'] : (!empty($sec['TITLE']) ? $sec['TITLE'] : 'Section ' . ($idx + 1)))
                                                    : (!empty($sec['TITLE']) ? $sec['TITLE'] : (!empty($sec['JUDUL']) ? $sec['JUDUL'] : 'Section ' . ($idx + 1)));
                                            ?>
                                                <button type="button" class="pms-tab-btn <?= $idx === 0 ? 'active' : '' ?>" data-tab-idx="<?= $idx ?>" role="tab">
                                                    <?= esc($secTitle) ?>
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <button type="button" class="pms-tab-scroll-btn pms-tab-scroll-right" id="pmsTabScrollRight" aria-label="Scroll right">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </button>
                                </div>
                                <div class="pms-tab-panels">
                                    <?php foreach ($sections as $idx => $sec) :
                                        $secBody = $isIndo
                                            ? (!empty($sec['KETERANGAN']) ? $sec['KETERANGAN'] : (!empty($sec['DESCRIPTION']) ? $sec['DESCRIPTION'] : ''))
                                            : (!empty($sec['DESCRIPTION']) ? $sec['DESCRIPTION'] : (!empty($sec['KETERANGAN']) ? $sec['KETERANGAN'] : ''));
                                    ?>
                                        <div class="pms-tab-panel <?= $idx === 0 ? 'active' : '' ?>" id="pmsTabSec<?= $idx ?>" role="tabpanel">
                                            <div class="pms-section-body">
                                                <?= $secBody ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php elseif ($profilSlug === 'profil-3') : ?>
                            <!-- Layout Template: Profil Accordion -->
                            <div class="pms-profile-accordion" id="pmsProfileAccordion">
                                <?php foreach ($sections as $idx => $sec) :
                                    $secTitle = $isIndo
                                        ? (!empty($sec['JUDUL']) ? $sec['JUDUL'] : (!empty($sec['TITLE']) ? $sec['TITLE'] : 'Section ' . ($idx + 1)))
                                        : (!empty($sec['TITLE']) ? $sec['TITLE'] : (!empty($sec['JUDUL']) ? $sec['JUDUL'] : 'Section ' . ($idx + 1)));
                                    $secBody = $isIndo
                                        ? (!empty($sec['KETERANGAN']) ? $sec['KETERANGAN'] : (!empty($sec['DESCRIPTION']) ? $sec['DESCRIPTION'] : ''))
                                        : (!empty($sec['DESCRIPTION']) ? $sec['DESCRIPTION'] : (!empty($sec['KETERANGAN']) ? $sec['KETERANGAN'] : ''));
                                ?>
                                    <div class="pms-accordion-item <?= $idx === 0 ? 'open' : '' ?>">
                                        <button type="button" class="pms-accordion-header" aria-expanded="<?= $idx === 0 ? 'true' : 'false' ?>">
                                            <span class="pms-accordion-title">
                                                <span class="pms-section-dot"></span>
                                                <?= esc($secTitle) ?>
                                            </span>
                                            <svg class="pms-accordion-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </button>
                                        <div class="pms-accordion-content" style="<?= $idx === 0 ? 'display: block;' : 'display: none;' ?>">
                                            <div class="pms-section-body">
                                                <?= $secBody ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <!-- Layout Template: Profil Klasik (Flowing vertical sections) -->
                            <?php foreach ($sections as $sec) : 
                                $secTitle = $isIndo
                                    ? (!empty($sec['JUDUL']) ? $sec['JUDUL'] : (!empty($sec['TITLE']) ? $sec['TITLE'] : ''))
                                    : (!empty($sec['TITLE']) ? $sec['TITLE'] : (!empty($sec['JUDUL']) ? $sec['JUDUL'] : ''));
                                
                                $secBody = $isIndo
                                    ? (!empty($sec['KETERANGAN']) ? $sec['KETERANGAN'] : (!empty($sec['DESCRIPTION']) ? $sec['DESCRIPTION'] : ''))
                                    : (!empty($sec['DESCRIPTION']) ? $sec['DESCRIPTION'] : (!empty($sec['KETERANGAN']) ? $sec['KETERANGAN'] : ''));
                                
                                if (empty($secTitle) && empty($secBody)) continue;
                            ?>
                                <div class="pms-profile-section-item">
                                    <h4 class="pms-section-title">
                                        <span class="pms-section-dot"></span>
                                        <?= esc($secTitle) ?>
                                    </h4>
                                    <div class="pms-section-body">
                                        <?= $secBody ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* =========================================================
       DYNAMIC PROFILE DETAIL STYLES
       ========================================================= */
    .pms-profile-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #00828a;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none !important;
        padding: 6px 14px;
        background: #f0fdfa;
        border: 1px solid #ccfbf1;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .pms-profile-back-link:hover {
        background: #00ADB5;
        color: #ffffff;
        border-color: #00ADB5;
        transform: translateX(-3px);
    }

    /* Sidebar Navigation */
    .pms-profile-sidebar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px 16px;
        position: sticky;
        top: 24px;
    }

    .pms-sidebar-group-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #204280;
        padding: 0 10px 8px;
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 8px;
    }

    .pms-sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pms-sidebar-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        margin-bottom: 4px;
        border: 1px solid transparent;
    }

    .pms-sidebar-item:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .pms-sidebar-item.active {
        background: #ffffff;
        border-color: #00ADB5;
        box-shadow: 0 4px 14px rgba(0, 173, 181, 0.12);
    }

    .pms-sidebar-indicator {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #cbd5e1;
        margin-top: 6px;
        flex-shrink: 0;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .pms-sidebar-item.active .pms-sidebar-indicator {
        background: #00ADB5;
        transform: scale(1.4);
    }

    .pms-sidebar-item-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.35;
    }

    .pms-sidebar-item.active .pms-sidebar-item-name {
        color: #00ADB5;
    }

    .pms-sidebar-item-role {
        font-size: 11.5px;
        color: #64748b;
        margin-top: 2px;
        line-height: 1.3;
    }

    /* Content Card */
    .pms-profile-content-card {
        padding: 0 10px;
    }

    .pms-profile-main-header {
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 25px;
        margin-bottom: 30px;
    }

    .pms-profile-photo-box {
        max-width: 320px;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 22px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .pms-profile-photo {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .pms-profile-role-badge {
        display: inline-block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #00828a;
        background: rgba(0, 173, 181, 0.1);
        padding: 4px 14px;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .pms-profile-fullname {
        font-size: 26px;
        font-weight: 800;
        color: #204280;
        margin: 0 0 14px 0;
        letter-spacing: -0.3px;
    }

    .pms-profile-lead-desc {
        font-size: 15px;
        color: #334155;
        line-height: 1.8;
        margin: 0;
    }

    /* Section Items */
    .pms-profile-section-item {
        margin-bottom: 30px;
        padding-bottom: 24px;
        border-bottom: 1px solid #f1f5f9;
    }

    .pms-profile-section-item:last-child {
        border-bottom: none;
    }

    .pms-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 17px;
        font-weight: 700;
        color: #204280;
        margin: 0 0 14px 0;
    }

    .pms-section-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #00ADB5;
        flex-shrink: 0;
    }

    .pms-section-body {
        font-size: 14.5px;
        color: #334155;
        line-height: 1.8;
    }

    .pms-section-body p {
        margin-bottom: 12px;
        text-align: justify;
    }

    .pms-section-body p:last-child {
        margin-bottom: 0;
    }

    .pms-section-body h1,
    .pms-section-body h2,
    .pms-section-body h3,
    .pms-section-body h4,
    .pms-section-body h5,
    .pms-section-body h6 {
        color: #0f172a;
        font-weight: 700;
        margin-top: 18px;
        margin-bottom: 8px;
    }

    .pms-section-body ul,
    .pms-section-body ol {
        padding-left: 24px;
        margin-bottom: 14px;
    }

    .pms-section-body ul {
        list-style-type: disc;
    }

    .pms-section-body ol {
        list-style-type: decimal;
    }

    .pms-section-body li {
        margin-bottom: 6px;
        line-height: 1.7;
    }

    .pms-section-body blockquote {
        border-left: 4px solid #00ADB5;
        padding: 8px 16px;
        margin: 14px 0;
        background: #f8fafc;
        color: #475569;
        font-style: italic;
        border-radius: 0 8px 8px 0;
    }

    .pms-section-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 16px 0;
        font-size: 13.5px;
    }

    .pms-section-body table th,
    .pms-section-body table td {
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        text-align: left;
    }

    .pms-section-body table th {
        background: #f1f5f9;
        font-weight: 700;
        color: #1e293b;
    }

    .pms-section-body a {
        color: #00ADB5;
        text-decoration: underline;
    }

    .pms-section-body a:hover {
        color: #00828a;
    }

    .pms-section-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 12px 0;
    }

    .pms-profile-empty-hint {
        padding: 30px 20px;
        text-align: center;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px dashed #cbd5e1;
    }

    /* Tab Layout Styles (profil-2) - Elegant 1-row scrollable tab */
    .pms-profile-tabs-container {
        width: 100%;
    }

    .pms-tab-nav-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        margin-bottom: 24px;
        border-bottom: 2px solid #e2e8f0;
    }

    .pms-tab-nav-scroller {
        flex: 1;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE/Edge */
        scroll-behavior: smooth;
        padding-bottom: 2px;
        margin-bottom: -2px;
    }

    .pms-tab-nav-scroller::-webkit-scrollbar {
        display: none; /* Chrome, Safari */
    }

    .pms-tab-nav-bar {
        display: inline-flex;
        flex-wrap: nowrap;
        white-space: nowrap;
        gap: 8px;
        padding: 0 4px;
    }

    .pms-tab-btn {
        flex: 0 0 auto;
        padding: 10px 20px;
        font-size: 13.5px;
        font-weight: 600;
        color: #64748b;
        background: transparent;
        border: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        outline: none;
        white-space: nowrap;
        border-radius: 6px 6px 0 0;
    }

    .pms-tab-btn:hover {
        color: #00ADB5;
        background: rgba(0, 173, 181, 0.04);
    }

    .pms-tab-btn.active {
        color: #00828a;
        border-bottom-color: #00ADB5;
        font-weight: 700;
        background: rgba(0, 173, 181, 0.08);
    }

    .pms-tab-scroll-btn {
        display: none;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #334155;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.2s ease;
        z-index: 5;
        flex-shrink: 0;
        margin-bottom: -2px;
    }

    .pms-tab-scroll-btn:hover {
        background: #00ADB5;
        color: #ffffff;
        border-color: #00ADB5;
    }

    .pms-tab-scroll-left {
        margin-right: 6px;
    }

    .pms-tab-scroll-right {
        margin-left: 6px;
    }

    .pms-tab-panel {
        display: none;
        animation: pmsFadeIn 0.3s ease;
    }

    .pms-tab-panel.active {
        display: block;
    }

    @keyframes pmsFadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Accordion Layout Styles (profil-3) */
    .pms-profile-accordion {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .pms-accordion-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
    }

    .pms-accordion-item.open {
        border-color: #00ADB5;
        box-shadow: 0 4px 14px rgba(0, 173, 181, 0.08);
    }

    .pms-accordion-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 16px 20px;
        background: #f8fafc;
        border: none;
        cursor: pointer;
        outline: none;
        transition: background 0.2s ease;
    }

    .pms-accordion-item.open .pms-accordion-header {
        background: #f0fdfa;
    }

    .pms-accordion-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
    }

    .pms-accordion-icon {
        color: #64748b;
        transition: transform 0.25s ease;
        flex-shrink: 0;
    }

    .pms-accordion-item.open .pms-accordion-icon {
        transform: rotate(180deg);
        color: #00ADB5;
    }

    .pms-accordion-content {
        padding: 18px 20px 20px;
        border-top: 1px solid #e2e8f0;
        background: #ffffff;
    }

    @media (max-width: 768px) {
        .pms-profile-sidebar {
            margin-bottom: 30px;
            position: static;
        }
        .pms-profile-fullname {
            font-size: 22px;
        }
        .pms-profile-photo-box {
            max-width: 100%;
        }
        .pms-tab-btn {
            padding: 8px 12px;
            font-size: 12.5px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tab switching and horizontal scroll navigation (profil-2)
        const tabBtns = document.querySelectorAll('.pms-tab-btn');
        const tabScroller = document.getElementById('pmsTabNavScroller');
        const btnScrollLeft = document.getElementById('pmsTabScrollLeft');
        const btnScrollRight = document.getElementById('pmsTabScrollRight');

        if (tabScroller) {
            const checkScrollOverflow = () => {
                const canScrollLeft = tabScroller.scrollLeft > 5;
                const canScrollRight = tabScroller.scrollLeft < (tabScroller.scrollWidth - tabScroller.clientWidth - 5);
                const hasOverflow = tabScroller.scrollWidth > tabScroller.clientWidth;

                if (btnScrollLeft) {
                    btnScrollLeft.style.display = (hasOverflow && canScrollLeft) ? 'inline-flex' : 'none';
                }
                if (btnScrollRight) {
                    btnScrollRight.style.display = (hasOverflow && canScrollRight) ? 'inline-flex' : 'none';
                }
            };

            tabScroller.addEventListener('scroll', checkScrollOverflow);
            window.addEventListener('resize', checkScrollOverflow);
            setTimeout(checkScrollOverflow, 100);

            if (btnScrollLeft) {
                btnScrollLeft.addEventListener('click', () => {
                    tabScroller.scrollBy({ left: -220, behavior: 'smooth' });
                });
            }

            if (btnScrollRight) {
                btnScrollRight.addEventListener('click', () => {
                    tabScroller.scrollBy({ left: 220, behavior: 'smooth' });
                });
            }

            // Drag to scroll
            let isDown = false;
            let startX, scrollLeft;
            tabScroller.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - tabScroller.offsetLeft;
                scrollLeft = tabScroller.scrollLeft;
            });
            window.addEventListener('mouseup', () => { isDown = false; });
            tabScroller.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - tabScroller.offsetLeft;
                const walk = (x - startX) * 1.5;
                tabScroller.scrollLeft = scrollLeft - walk;
            });
        }

        if (tabBtns.length > 0) {
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const idx = this.getAttribute('data-tab-idx');
                    tabBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Center clicked tab in view if overflowing
                    this.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });

                    const panels = document.querySelectorAll('.pms-tab-panel');
                    panels.forEach(p => p.classList.remove('active'));

                    const targetPanel = document.getElementById('pmsTabSec' + idx);
                    if (targetPanel) {
                        targetPanel.classList.add('active');
                    }
                });
            });
        }

        // Accordion toggle logic (profil-3)
        const accordionHeaders = document.querySelectorAll('.pms-accordion-header');
        if (accordionHeaders.length > 0) {
            accordionHeaders.forEach(header => {
                header.addEventListener('click', function () {
                    const item = this.closest('.pms-accordion-item');
                    const content = item.querySelector('.pms-accordion-content');
                    const isOpen = item.classList.contains('open');

                    if (isOpen) {
                        item.classList.remove('open');
                        this.setAttribute('aria-expanded', 'false');
                        content.style.display = 'none';
                    } else {
                        item.classList.add('open');
                        this.setAttribute('aria-expanded', 'true');
                        content.style.display = 'block';
                    }
                });
            });
        }
    });
</script>