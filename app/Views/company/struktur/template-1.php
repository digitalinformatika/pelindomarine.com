<?php
/**
 * Template 1: Bagan Klasik
 * Bagan pohon vertikal klasik dengan atasan di atas dan garis penghubung formal ke bawah.
 *
 * @var array $tree
 * @var array $officers
 * @var bool  $isIndo
 */

$txtViewProfile = $isIndo ? 'Lihat Profil' : 'View Profile';

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
/** Foto pejabat bulat; fallback inisial nama bila foto tidak ada. */
if (! function_exists("classic_officer_photo")) {
    function classic_officer_photo(array $o): string
    {
        $url  = ! empty($o["FOTO"]) ? struktur_media_url($o["FOTO"]) : "";
        $name = trim((string) ($o["NAMA"] ?? $o["JABATAN"] ?? "PM"));
        $ini  = "";
        foreach (array_slice(explode(" ", $name), 0, 2) as $w) { $ini .= mb_substr($w, 0, 1); }
        $ini = strtoupper($ini);
        if ($url !== "") {
            return "<div class=\"pms-classic-avatar\"><img src=\"" . esc($url, "attr") . "\" alt=\"" . esc($name, "attr") . "\" onerror=\"this.style.display='none';this.nextElementSibling.style.display='flex';\"><span class=\"pms-classic-initials\" style=\"display:none\">" . esc($ini) . "</span></div>";
        }
        return "<div class=\"pms-classic-avatar\"><span class=\"pms-classic-initials\">" . esc($ini) . "</span></div>";
    }
}
?>

<div class="pms-classic-wrapper">
    <!-- Mobile Swipe Hint -->
    <div class="pms-mobile-swipe-hint">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
        <span><?= $isIndo ? 'Geser kiri & kanan untuk melihat seluruh bagan' : 'Swipe left & right to explore the full chart' ?></span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </div>

    <!-- Tree Scrollport -->
    <div class="pms-classic-scrollport" id="pmsClassicScrollport">
        <div class="pms-classic-tree">
            <!-- Root 1: Dewan Komisaris -->
            <?php if (!empty($komisarisGroup)) : 
                $slugK = officer_slug($komisarisGroup);
            ?>
                <div class="pms-classic-branch">
                    <div class="pms-classic-node pms-classic-node-komisaris">
                        <a href="<?= site_url('profile/' . $slugK) ?>" class="pms-classic-card">
                            <div class="pms-classic-card-header pms-header-navy"></div>
                            <div class="pms-classic-card-body">
<?= classic_officer_photo($komisarisGroup) ?>
                                <h5 class="pms-classic-name"><?= esc(!empty($komisarisGroup['NAMA']) ? $komisarisGroup['NAMA'] : ($komisarisGroup['JABATAN'] ?? '-')) ?></h5>
<?php if (!empty($komisarisGroup['NAMA'])) : ?><div class="pms-classic-role"><?= esc($komisarisGroup['JABATAN'] ?? '') ?></div><?php endif; ?>
                                <span class="pms-classic-link"><?= $txtViewProfile ?> &rarr;</span>
                            </div>
                        </a>
                    </div>

                    <?php if (!empty($komisarisGroup['children'])) : ?>
                        <div class="pms-classic-line-down"></div>
                        <div class="pms-classic-children">
                            <?php foreach ($komisarisGroup['children'] as $child) : 
                                $slugChild = officer_slug($child);
                            ?>
                                <div class="pms-classic-child-col">
                                    <div class="pms-classic-node">
                                        <a href="<?= site_url('profile/' . $slugChild) ?>" class="pms-classic-card">
                                            <div class="pms-classic-card-header pms-header-navy-sub"></div>
                                            <div class="pms-classic-card-body">
<?= classic_officer_photo($child) ?>
                                                <h5 class="pms-classic-name"><?= esc(!empty($child['NAMA']) ? $child['NAMA'] : ($child['JABATAN'] ?? '-')) ?></h5>
<?php if (!empty($child['NAMA'])) : ?><div class="pms-classic-role"><?= esc($child['JABATAN'] ?? '') ?></div><?php endif; ?>
                                                <span class="pms-classic-link"><?= $txtViewProfile ?> &rarr;</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Root 2: Dewan Direksi (Direktur Utama & Jajaran) -->
            <?php if (!empty($direksiGroup)) : 
                $slugD = officer_slug($direksiGroup);
            ?>
                <div class="pms-classic-branch">
                    <div class="pms-classic-node pms-classic-node-dirut">
                        <a href="<?= site_url('profile/' . $slugD) ?>" class="pms-classic-card pms-card-highlight">
                            <div class="pms-classic-card-header pms-header-teal"></div>
                            <div class="pms-classic-card-body">
<?= classic_officer_photo($direksiGroup) ?>
                                <h5 class="pms-classic-name"><?= esc(!empty($direksiGroup['NAMA']) ? $direksiGroup['NAMA'] : ($direksiGroup['JABATAN'] ?? '-')) ?></h5>
<?php if (!empty($direksiGroup['NAMA'])) : ?><div class="pms-classic-role"><?= esc($direksiGroup['JABATAN'] ?? '') ?></div><?php endif; ?>
                                <span class="pms-classic-link"><?= $txtViewProfile ?> &rarr;</span>
                            </div>
                        </a>
                    </div>

                    <?php if (!empty($direksiGroup['children'])) : ?>
                        <div class="pms-classic-line-down"></div>
                        <div class="pms-classic-children">
                            <?php foreach ($direksiGroup['children'] as $child) : 
                                $slugChild = officer_slug($child);
                            ?>
                                <div class="pms-classic-child-col">
                                    <div class="pms-classic-node">
                                        <a href="<?= site_url('profile/' . $slugChild) ?>" class="pms-classic-card">
                                            <div class="pms-classic-card-header pms-header-blue"></div>
                                            <div class="pms-classic-card-body">
<?= classic_officer_photo($child) ?>
                                                <h5 class="pms-classic-name"><?= esc(!empty($child['NAMA']) ? $child['NAMA'] : ($child['JABATAN'] ?? '-')) ?></h5>
<?php if (!empty($child['NAMA'])) : ?><div class="pms-classic-role"><?= esc($child['JABATAN'] ?? '') ?></div><?php endif; ?>
                                                <span class="pms-classic-link"><?= $txtViewProfile ?> &rarr;</span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php if (!empty($child['children'])) : ?>
                                        <div class="pms-classic-line-down"></div>
                                        <div class="pms-classic-children">
                                            <?php foreach ($child['children'] as $subChild) : 
                                                $slugSub = officer_slug($subChild);
                                            ?>
                                                <div class="pms-classic-child-col">
                                                    <div class="pms-classic-node">
                                                        <a href="<?= site_url('profile/' . $slugSub) ?>" class="pms-classic-card">
                                                            <div class="pms-classic-card-header pms-header-slate"></div>
                                                            <div class="pms-classic-card-body">
<?= classic_officer_photo($subChild) ?>
                                                                <h5 class="pms-classic-name"><?= esc(!empty($subChild['NAMA']) ? $subChild['NAMA'] : ($subChild['JABATAN'] ?? '-')) ?></h5>
<?php if (!empty($subChild['NAMA'])) : ?><div class="pms-classic-role"><?= esc($subChild['JABATAN'] ?? '') ?></div><?php endif; ?>
                                                                <span class="pms-classic-link"><?= $txtViewProfile ?> &rarr;</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* =========================================================
       TEMPLATE 1: BAGAN KLASIK STYLES
       ========================================================= */
    .pms-classic-wrapper {
        position: relative;
        width: 100%;
        user-select: none;
    }

    .pms-classic-scrollport {
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        padding: 20px 10px 40px;
        cursor: grab;
    }

    .pms-classic-scrollport:active {
        cursor: grabbing;
    }

    .pms-classic-tree {
        display: table;
        margin: 0 auto;
        min-width: max-content;
        text-align: center;
    }

    .pms-classic-branch {
        margin: 0 auto 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .pms-classic-node {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        width: 100%;
        height: 100%;
    }

    .pms-classic-node-komisaris,
    .pms-classic-node-dirut {
        width: auto;
    }

    .pms-classic-card {
        display: flex;
        flex-direction: column;
        width: 260px;
        height: 100%;
        min-height: 145px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
        text-decoration: none !important;
        overflow: hidden;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        text-align: center;
    }

    .pms-classic-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0, 32, 96, 0.12);
        border-color: #ff7f23;
    }

    .pms-classic-card-header {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 8px 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #ffffff;
        line-height: 1.35;
        text-align: center;
    }

    .pms-header-navy { background: #204280; }
    .pms-header-navy-sub { background: #1d3d7a; }
    .pms-header-teal { background: #ff7f23; }
    .pms-header-blue { background: #3d629f; }
    .pms-header-slate { background: #475569; }

    .pms-card-highlight {
        border: 2px solid #ff7f23;
        box-shadow: 0 6px 20px rgba(255, 127, 35, 0.15);
    }

    .pms-classic-card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex: 1;
        padding: 14px 14px 12px;
        background: #ffffff;
    }

    .pms-classic-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        overflow: hidden;
        margin: -46px auto 8px;
        background: #e2e8f0;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 12px rgba(0, 32, 96, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
    }
    .pms-classic-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        display: block;
    }
    .pms-classic-initials {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 20px;
        font-weight: 800;
        color: #204280;
        background: #e2e8f0;
    }
    .pms-classic-card-body {
        padding-top: 0 !important;
    }
    .pms-classic-card-header {
        padding-bottom: 40px !important;
    }
    .pms-classic-name {
        font-size: 14.5px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 6px;
        line-height: 1.35;
    }

    .pms-classic-role {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #204280;
        line-height: 1.4;
        margin: 0 0 10px;
        padding: 0 6px;
    }
    .pms-card-highlight .pms-classic-role {
        color: #ce2c00;
    }

    .pms-classic-link {
        font-size: 11px;
        font-weight: 600;
        color: #ff7f23;
        display: inline-block;
        transition: transform 0.2s ease;
    }

    .pms-classic-card:hover .pms-classic-link {
        transform: translateX(3px);
    }

    /* Classic Tree Connector Lines (Continuous & Seamless) */
    .pms-classic-line-down {
        width: 2px;
        height: 24px;
        background: #94a3b8;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .pms-classic-children {
        display: flex;
        justify-content: center;
        align-items: stretch;
        position: relative;
        margin: 0;
        padding: 0;
    }

    .pms-classic-child-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        padding: 24px 15px 0 15px;
    }

    /* Continuous horizontal bar on each child column */
    .pms-classic-child-col::before,
    .pms-classic-child-col::after {
        content: '';
        position: absolute;
        top: 0;
        width: 50%;
        height: 2px;
        background: #94a3b8;
    }

    .pms-classic-child-col::before {
        left: 0;
    }

    .pms-classic-child-col::after {
        right: 0;
    }

    /* Remove outer ends for first and last child */
    .pms-classic-child-col:first-child::before {
        display: none !important;
    }

    .pms-classic-child-col:last-child::after {
        display: none !important;
    }

    /* Single child has no horizontal bar */
    .pms-classic-child-col:only-child::before,
    .pms-classic-child-col:only-child::after {
        display: none !important;
    }

    /* Vertical drop line to child card */
    .pms-classic-child-col > .pms-classic-node::before {
        content: '';
        position: absolute;
        top: -24px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 24px;
        background: #94a3b8;
        z-index: 1;
    }

    @media (max-width: 991px) {
        .pms-classic-card {
            width: 210px;
            min-height: 135px;
        }
        .pms-classic-child-col {
            padding: 24px 8px 0 8px;
        }
        .pms-classic-card-header {
            font-size: 10px;
            min-height: 48px;
            padding: 6px 8px;
        }
        .pms-classic-avatar {
            width: 60px;
            height: 60px;
            margin-top: -38px;
        }
        .pms-classic-card-header {
            padding-bottom: 36px !important;
        }
        .pms-classic-name {
            font-size: 13px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const port = document.getElementById('pmsClassicScrollport');
        if (!port) return;

        let isDown = false;
        let startX, scrollLeft;

        port.addEventListener('mousedown', (e) => {
            isDown = true;
            port.style.cursor = 'grabbing';
            startX = e.pageX - port.offsetLeft;
            scrollLeft = port.scrollLeft;
        });

        port.addEventListener('mouseleave', () => {
            isDown = false;
            port.style.cursor = 'grab';
        });

        port.addEventListener('mouseup', () => {
            isDown = false;
            port.style.cursor = 'grab';
        });

        port.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - port.offsetLeft;
            const walk = (x - startX) * 1.5;
            port.scrollLeft = scrollLeft - walk;
        });
    });
</script>
