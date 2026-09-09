<?php
/**
 * Executive Photo Card Tree Layout
 * Renders hierarchical organizational chart with connecting lines,
 * executive avatar cards, interactive hover, and mobile-friendly list fallback.
 *
 * @var array $tree
 * @var array $officers
 * @var bool  $isIndo
 */

$txtViewProfile = $isIndo ? 'Lihat Profil' : 'View Profile';

// Separate Dewan Komisaris and Direksi for balanced corporate presentation
$komisarisGroup = null;
$direksiGroup = null;
$otherRoots = [];

foreach ($tree as $root) {
    $jabatanLower = strtolower($root['JABATAN'] ?? '');
    if (str_contains($jabatanLower, 'komisaris') || str_contains($jabatanLower, 'commissioner')) {
        $komisarisGroup = $root;
    } elseif (str_contains($jabatanLower, 'direktur utama') || str_contains($jabatanLower, 'president director') || str_contains($jabatanLower, 'direksi')) {
        $direksiGroup = $root;
    } else {
        $otherRoots[] = $root;
    }
}

/**
 * Helper to get officer photo or generate initials SVG avatar.
 */
if (! function_exists('render_officer_photo')) {
    function render_officer_photo(array $officer, int $size = 72): string {
        $photoUrl = !empty($officer['FOTO']) ? struktur_media_url($officer['FOTO']) : '';
        $name = !empty($officer['NAMA']) ? trim($officer['NAMA']) : (!empty($officer['JABATAN']) ? trim($officer['JABATAN']) : 'PM');
        
        // Extract initials
        $words = explode(' ', $name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= mb_substr($w, 0, 1);
        }
        $initials = strtoupper($initials);

        if ($photoUrl !== '') {
            return '<img src="' . esc($photoUrl, 'attr') . '" alt="' . esc($name, 'attr') . '" class="pms-node-avatar-img" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'flex\';">' .
                   '<span class="pms-node-avatar-initials" style="display: none;">' . esc($initials) . '</span>';
        }

        return '<span class="pms-node-avatar-initials">' . esc($initials) . '</span>';
    }
}
?>

<div class="pms-tree-wrapper">
    <!-- Mobile Swipe Indicator Hint -->
    <div class="pms-mobile-swipe-hint">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
        <span><?= $isIndo ? 'Geser kiri & kanan untuk melihat seluruh bagan' : 'Swipe left & right to explore the full chart' ?></span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </div>

    <div class="pms-tree-viewport" id="pmsTreeViewport">
        <!-- ==================== TREE VIEW MODE ==================== -->
        <div class="pms-tree-container" id="pmsTreeContainer">
        
        <!-- SECTION 1: DEWAN KOMISARIS -->
        <?php if ($komisarisGroup) : ?>
            <div class="pms-tree-tier pms-tier-komisaris">
                <div class="pms-tier-header">
                    <span class="pms-tier-pill pms-pill-gold">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        <?= esc($komisarisGroup['JABATAN'] ?? ($isIndo ? 'Dewan Komisaris' : 'Board of Commissioners')) ?>
                    </span>
                </div>

                <!-- If root itself has a name, show it, otherwise show its children -->
                <div class="pms-tier-row">
                    <?php 
                        $komisarisList = !empty($komisarisGroup['children']) ? $komisarisGroup['children'] : [$komisarisGroup];
                        foreach ($komisarisList as $item) : 
                            $slug = officer_slug($item);
                            $url = site_url('profile/' . $slug);
                            $isUtama = stripos($item['JABATAN'] ?? '', 'utama') !== false;
                    ?>
                        <div class="pms-node-card-wrap">
                            <a href="<?= $url ?>" class="pms-node-card <?= $isUtama ? 'is-leader' : '' ?>" title="<?= esc($item['NAMA'] ?? '') ?>">
                                <div class="pms-node-avatar-ring">
                                    <?= render_officer_photo($item, 72) ?>
                                </div>
                                <div class="pms-node-body">
                                    <div class="pms-node-jabatan"><?= esc($item['JABATAN'] ?? '') ?></div>
                                    <h4 class="pms-node-nama"><?= esc($item['NAMA'] ?? '-') ?></h4>
                                    <div class="pms-node-cta">
                                        <span><?= $txtViewProfile ?></span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Vertical Connector between Komisaris and Direksi -->
            <div class="pms-tree-link-v">
                <div class="pms-link-line"></div>
            </div>
        <?php endif; ?>

        <!-- SECTION 2: DIREKTUR UTAMA -->
        <?php if ($direksiGroup) : 
            $dirutSlug = officer_slug($direksiGroup);
            $dirutUrl = site_url('profile/' . $dirutSlug);
        ?>
            <div class="pms-tree-tier pms-tier-dirut">
                <div class="pms-node-card-wrap">
                    <a href="<?= $dirutUrl ?>" class="pms-node-card is-dirut" title="<?= esc($direksiGroup['NAMA'] ?? '') ?>">
                        <div class="pms-node-badge-top"><?= $isIndo ? 'Pimpinan Eksekutif' : 'Chief Executive' ?></div>
                        <div class="pms-node-avatar-ring is-large">
                            <?= render_officer_photo($direksiGroup, 84) ?>
                        </div>
                        <div class="pms-node-body">
                            <div class="pms-node-jabatan is-accent"><?= esc($direksiGroup['JABATAN'] ?? '') ?></div>
                            <h4 class="pms-node-nama is-large"><?= esc($direksiGroup['NAMA'] ?? '-') ?></h4>
                            <div class="pms-node-cta">
                                <span><?= $txtViewProfile ?></span>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Branch Connector to BOD Members -->
            <?php if (!empty($direksiGroup['children'])) : ?>
                <div class="pms-tree-link-v">
                    <div class="pms-link-line"></div>
                </div>

                <!-- SECTION 3: JAJARAN DIREKSI (BOD) -->
                <div class="pms-tree-tier pms-tier-bod">
                    <div class="pms-tier-header">
                        <span class="pms-tier-pill pms-pill-blue">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <?= $isIndo ? 'Jajaran Direksi' : 'Board of Directors' ?>
                        </span>
                    </div>

                    <div class="pms-tier-row has-fork">
                        <?php foreach ($direksiGroup['children'] as $idx => $bod) : 
                            $bodSlug = officer_slug($bod);
                            $bodUrl = site_url('profile/' . $bodSlug);
                        ?>
                            <div class="pms-node-card-wrap">
                                <a href="<?= $bodUrl ?>" class="pms-node-card is-bod" title="<?= esc($bod['NAMA'] ?? '') ?>">
                                    <div class="pms-node-avatar-ring">
                                        <?= render_officer_photo($bod, 72) ?>
                                    </div>
                                    <div class="pms-node-body">
                                        <div class="pms-node-jabatan"><?= esc($bod['JABATAN'] ?? '') ?></div>
                                        <h4 class="pms-node-nama"><?= esc($bod['NAMA'] ?? '-') ?></h4>
                                        <div class="pms-node-cta">
                                            <span><?= $txtViewProfile ?></span>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </a>

                                <!-- Render Subordinates under this BOD member if any -->
                                <?php if (!empty($bod['children'])) : ?>
                                    <div class="pms-tree-link-v is-sub">
                                        <div class="pms-link-line"></div>
                                    </div>
                                    <div class="pms-tier-sub-row">
                                        <?php foreach ($bod['children'] as $sub) : 
                                            $subUrl = site_url('profile/' . officer_slug($sub));
                                        ?>
                                            <a href="<?= $subUrl ?>" class="pms-node-card is-compact" title="<?= esc($sub['NAMA'] ?? '') ?>">
                                                <div class="pms-node-avatar-ring is-small">
                                                    <?= render_officer_photo($sub, 48) ?>
                                                </div>
                                                <div class="pms-node-body">
                                                    <div class="pms-node-jabatan is-small"><?= esc($sub['JABATAN'] ?? '') ?></div>
                                                    <h5 class="pms-node-nama is-small"><?= esc($sub['NAMA'] ?? '-') ?></h5>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- SECTION 4: OTHER ROOTS (If any custom nodes) -->
        <?php if (!empty($otherRoots)) : ?>
            <div class="pms-tree-tier mt-5">
                <div class="pms-tier-row">
                    <?php foreach ($otherRoots as $item) : 
                        $slug = officer_slug($item);
                        $url = site_url('profile/' . $slug);
                    ?>
                        <div class="pms-node-card-wrap">
                            <a href="<?= $url ?>" class="pms-node-card" title="<?= esc($item['NAMA'] ?? '') ?>">
                                <div class="pms-node-avatar-ring">
                                    <?= render_officer_photo($item, 72) ?>
                                </div>
                                <div class="pms-node-body">
                                    <div class="pms-node-jabatan"><?= esc($item['JABATAN'] ?? '') ?></div>
                                    <h4 class="pms-node-nama"><?= esc($item['NAMA'] ?? '-') ?></h4>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- ==================== LIST VIEW MODE ==================== -->
    <div class="pms-list-container" id="pmsListContainer">
        <div class="pms-list-header-box">
            <h4 class="pms-list-title"><?= $isIndo ? 'Daftar Pejabat & Pimpinan Organisasi' : 'Directory of Executive Officers' ?></h4>
            <p class="pms-list-sub"><?= $isIndo ? 'Pilih salah satu pejabat untuk membaca profil lengkap dan rekam jejak karir.' : 'Select any leader to review their comprehensive profile and career achievements.' ?></p>
        </div>

        <div class="pms-list-grid">
            <?php foreach ($officers as $row) : 
                if (empty($row['NAMA'])) continue;
                $slug = officer_slug($row);
                $url = site_url('profile/' . $slug);
            ?>
                <a href="<?= $url ?>" class="pms-list-item-card">
                    <div class="pms-list-item-avatar">
                        <?= render_officer_photo($row, 56) ?>
                    </div>
                    <div class="pms-list-item-info">
                        <div class="pms-list-item-jabatan"><?= esc($row['JABATAN'] ?? '') ?></div>
                        <h4 class="pms-list-item-nama"><?= esc($row['NAMA'] ?? '-') ?></h4>
                    </div>
                    <div class="pms-list-item-arrow">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
</div>

<style>
    /* =========================================================
       EXECUTIVE PHOTO CARD TREE STYLES
       ========================================================= */
    .pms-tree-wrapper {
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .pms-mobile-swipe-hint {
        display: none;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: #f0fdfa;
        color: #0d9488;
        border: 1px solid #ccfbf1;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 14px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .pms-tree-viewport {
        position: relative;
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior-x: contain;
        scroll-behavior: smooth;
        cursor: grab;
        padding: 10px 4px 25px;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f8fafc;
    }

    .pms-tree-viewport::-webkit-scrollbar {
        height: 6px;
    }
    .pms-tree-viewport::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 4px;
    }
    .pms-tree-viewport::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .pms-tree-viewport::-webkit-scrollbar-thumb:hover {
        background: #ff7f23;
    }

    .pms-tree-viewport.is-dragging {
        cursor: grabbing;
        user-select: none;
    }

    .pms-tree-container {
        display: table;
        margin: 0 auto;
        min-width: max-content;
        text-align: center;
        padding: 5px 20px 25px;
        box-sizing: border-box;
    }

    .pms-list-container {
        display: none;
        width: 100%;
        max-width: 880px;
        margin: 0 auto;
        padding: 10px 0 30px;
        animation: pmsFadeIn 0.3s ease-out;
    }

    /* Toggle Modes */
    .mode-list-view .pms-tree-container {
        display: none !important;
    }
    .mode-list-view .pms-list-container {
        display: block !important;
    }

    /* Tier Headers */
    .pms-tree-tier {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        position: relative;
    }

    .pms-tier-header {
        margin-bottom: 22px;
        z-index: 2;
    }

    .pms-tier-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
    }

    .pms-pill-gold {
        background: #fefce8;
        color: #854d0e;
        border: 1px solid #fde047;
    }

    .pms-pill-blue {
        background: #f0fdf4;
        color: #0f766e;
        border: 1px solid #99f6e4;
    }

    /* Row Layouts */
    .pms-tier-row {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        flex-wrap: wrap;
        gap: 24px;
        position: relative;
        z-index: 2;
    }

    /* Connecting Lines */
    .pms-tree-link-v {
        width: 100%;
        display: flex;
        justify-content: center;
        height: 40px;
        position: relative;
    }

    .pms-link-line {
        width: 2px;
        height: 100%;
        background: #cbd5e1;
        position: relative;
    }

    .pms-tier-row.has-fork {
        position: relative;
        padding-top: 14px;
    }

    /* Top Horizontal Bar connecting BOD cards */
    .pms-tier-row.has-fork::before {
        content: '';
        position: absolute;
        top: 0;
        left: 12%;
        right: 12%;
        height: 2px;
        background: #cbd5e1;
        z-index: 1;
    }

    .pms-tier-row.has-fork .pms-node-card-wrap::before {
        content: '';
        position: absolute;
        top: -14px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 14px;
        background: #cbd5e1;
        z-index: 1;
    }

    /* =========================================================
       NODE CARD STYLES
       ========================================================= */
    .pms-node-card-wrap {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .pms-node-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 230px;
        padding: 22px 18px 18px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        cursor: pointer;
    }

    .pms-node-card:hover {
        transform: translateY(-6px);
        border-color: #ff7f23;
        box-shadow: 0 16px 36px rgba(255, 127, 35, 0.14), 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    /* President Director Special Card */
    .pms-node-card.is-dirut {
        width: 280px;
        padding: 28px 22px 22px;
        border: 2px solid #ff7f23;
        box-shadow: 0 12px 30px rgba(255, 127, 35, 0.12), 0 4px 10px rgba(0, 0, 0, 0.04);
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .pms-node-card.is-dirut:hover {
        transform: translateY(-8px);
        box-shadow: 0 22px 45px rgba(255, 127, 35, 0.22);
    }

    .pms-node-badge-top {
        position: absolute;
        top: -12px;
        background: linear-gradient(135deg, #ff7f23, #204280);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 3px 12px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(255, 127, 35, 0.4);
    }

    /* Avatar Ring */
    .pms-node-avatar-ring {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        padding: 3px;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
        position: relative;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .pms-node-card:hover .pms-node-avatar-ring {
        background: linear-gradient(135deg, #ff7f23, #204280);
        transform: scale(1.05);
    }

    .pms-node-avatar-ring.is-large {
        width: 86px;
        height: 86px;
        background: linear-gradient(135deg, #ff7f23, #204280);
    }

    .pms-node-avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        background: #ffffff;
        border: 2px solid #ffffff;
    }

    .pms-node-avatar-initials {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #204280, #ff7f23);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: 2px solid #ffffff;
    }

    .pms-node-avatar-ring.is-large .pms-node-avatar-initials {
        font-size: 24px;
    }

    /* Text info */
    .pms-node-body {
        width: 100%;
    }

    .pms-node-jabatan {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        line-height: 1.4;
        min-height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
    }

    .pms-node-jabatan.is-accent {
        color: #ce2c00;
    }

    .pms-node-nama {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.35;
        margin: 0 0 10px 0;
        transition: color 0.2s ease;
    }

    .pms-node-nama.is-large {
        font-size: 17px;
        color: #204280;
    }

    .pms-node-card:hover .pms-node-nama {
        color: #ff7f23;
    }

    .pms-node-cta {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        color: #ff7f23;
        padding: 4px 10px;
        background: rgba(255, 127, 35, 0.08);
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .pms-node-card:hover .pms-node-cta {
        background: #ff7f23;
        color: #ffffff;
    }

    /* Subordinate nodes */
    .pms-tier-sub-row {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 8px;
    }

    .pms-node-card.is-compact {
        width: 200px;
        padding: 10px 12px;
        border-radius: 12px;
        flex-direction: row;
        text-align: left;
        gap: 10px;
    }

    .pms-node-avatar-ring.is-small {
        width: 44px;
        height: 44px;
        min-width: 44px;
        margin-bottom: 0;
    }

    .pms-node-avatar-ring.is-small .pms-node-avatar-initials {
        font-size: 14px;
    }

    .pms-node-jabatan.is-small {
        min-height: auto;
        justify-content: flex-start;
        font-size: 10.5px;
        margin-bottom: 2px;
    }

    .pms-node-nama.is-small {
        font-size: 12.5px;
        margin-bottom: 0;
    }

    /* =========================================================
       LIST VIEW STYLES
       ========================================================= */
    .pms-list-header-box {
        text-align: center;
        margin-bottom: 25px;
    }

    .pms-list-title {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 6px 0;
    }

    .pms-list-sub {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    .pms-list-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 16px;
    }

    .pms-list-item-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 20px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        text-decoration: none !important;
        transition: all 0.25s ease;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
    }

    .pms-list-item-card:hover {
        border-color: #ff7f23;
        background: #f8fafc;
        transform: translateX(4px);
        box-shadow: 0 6px 20px rgba(255, 127, 35, 0.12);
    }

    .pms-list-item-avatar {
        width: 56px;
        height: 56px;
        min-width: 56px;
        border-radius: 50%;
        position: relative;
    }

    .pms-list-item-info {
        flex: 1;
        text-align: left;
    }

    .pms-list-item-jabatan {
        font-size: 12px;
        font-weight: 700;
        color: #ff7f23;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 3px;
    }

    .pms-list-item-nama {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .pms-list-item-arrow {
        color: #94a3b8;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .pms-list-item-card:hover .pms-list-item-arrow {
        color: #ff7f23;
        transform: translateX(4px);
    }

    /* Mobile Responsive Optimizations */
    @media (max-width: 991px) {
        .pms-mobile-swipe-hint {
            display: inline-flex;
        }

        .pms-tree-container {
            min-width: max-content;
        }

        .pms-node-card {
            width: 200px;
            padding: 16px 12px;
        }

        .pms-node-card.is-dirut {
            width: 240px;
        }
    }

    @media (max-width: 991px) {
        .pms-tree-viewport {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            padding: 8px 4px 22px !important;
            width: 100% !important;
        }

        .pms-tree-container {
            display: table !important;
            margin: 0 auto !important;
            min-width: max-content !important;
            width: auto !important;
            padding: 5px 16px 20px !important;
        }

        .pms-tree-tier {
            width: 100% !important;
        }

        /* Keep horizontal tree row on mobile! */
        .pms-tier-row {
            display: flex !important;
            flex-direction: row !important;
            align-items: flex-start !important;
            justify-content: center !important;
            flex-wrap: nowrap !important;
            gap: 14px !important;
            padding: 0 !important;
        }

        .pms-tier-row.has-fork {
            padding-top: 14px !important;
            position: relative;
        }

        .pms-tier-row.has-fork::before {
            display: block !important;
            left: calc(185px / 2) !important;
            right: calc(185px / 2) !important;
            height: 2px !important;
            background: #cbd5e1 !important;
        }

        .pms-tier-row.has-fork .pms-node-card-wrap::before {
            display: block !important;
            top: -14px !important;
            height: 14px !important;
            width: 2px !important;
            background: #cbd5e1 !important;
        }

        /* Compact, mobile-friendly cards in tree view for effortless swipe */
        .pms-node-card-wrap {
            width: auto !important;
            max-width: none !important;
            flex-shrink: 0 !important;
        }

        .pms-node-card {
            width: 185px !important;
            max-width: 185px !important;
            padding: 16px 12px 14px !important;
            border-radius: 14px !important;
        }

        .pms-node-card.is-dirut {
            width: 225px !important;
            max-width: 225px !important;
            padding: 20px 16px 16px !important;
        }

        .pms-node-avatar-ring {
            width: 62px !important;
            height: 62px !important;
            margin-bottom: 10px !important;
        }

        .pms-node-avatar-ring.is-large {
            width: 74px !important;
            height: 74px !important;
        }

        .pms-node-avatar-initials {
            font-size: 17px !important;
        }

        .pms-node-avatar-ring.is-large .pms-node-avatar-initials {
            font-size: 20px !important;
        }

        .pms-node-jabatan {
            font-size: 10.5px !important;
            min-height: 28px !important;
            margin-bottom: 4px !important;
        }

        .pms-node-nama {
            font-size: 13.5px !important;
            margin-bottom: 8px !important;
        }

        .pms-node-nama.is-large {
            font-size: 15.5px !important;
        }

        .pms-node-cta {
            font-size: 11px !important;
            padding: 3px 8px !important;
        }

        .pms-tree-link-v {
            height: 32px !important;
        }

        .pms-list-grid {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        .pms-list-item-card {
            padding: 14px 16px !important;
            gap: 12px !important;
        }

        .pms-list-item-nama {
            font-size: 15px !important;
        }
    }
</style>

<script>
    (function () {
        const slider = document.getElementById('pmsTreeViewport');
        if (!slider) return;

        let isDown = false;
        let startX = 0;
        let scrollLeft = 0;
        let moved = false;

        slider.addEventListener('mousedown', function (e) {
            // Prevent interfering with link clicks
            if (e.target.closest('a')) return;
            isDown = true;
            moved = false;
            slider.classList.add('is-dragging');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', function () {
            isDown = false;
            slider.classList.remove('is-dragging');
        });

        slider.addEventListener('mouseup', function () {
            isDown = false;
            slider.classList.remove('is-dragging');
        });

        slider.addEventListener('mousemove', function (e) {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.4;
            slider.scrollLeft = scrollLeft - walk;
            moved = true;
        });
    })();
</script>
