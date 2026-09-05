<?php
/**
 * Template 5: Grid Per Level
 * Setiap level jabatan ditampilkan sebagai baris grid terpisah.
 *
 * @var array $tree
 * @var array $officers
 * @var bool  $isIndo
 */

helper('text');

$txtViewProfile = $isIndo ? 'Lihat Profil Lengkap' : 'View Full Profile';

if (! function_exists('render_officer_photo')) {
    function render_officer_photo(array $officer, int $size = 72): string {
        $photoUrl = !empty($officer['FOTO']) ? struktur_media_url($officer['FOTO']) : '';
        $name = !empty($officer['NAMA']) ? trim($officer['NAMA']) : (!empty($officer['JABATAN']) ? trim($officer['JABATAN']) : 'PM');
        
        $words = explode(' ', $name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= mb_substr($w, 0, 1);
        }
        $initials = strtoupper($initials);

        if ($photoUrl !== '') {
            return '<img src="' . esc($photoUrl, 'attr') . '" alt="' . esc($name, 'attr') . '" class="pms-grid-photo" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'flex\';">' .
                   '<span class="pms-grid-initials" style="display: none;">' . esc($initials) . '</span>';
        }

        return '<span class="pms-grid-initials">' . esc($initials) . '</span>';
    }
}

// Group officers into tiers
$tierKomisaris = [];
$tierDirut = [];
$tierDireksi = [];
$tierOthers = [];

foreach ($officers as $officer) {
    $jabLower = strtolower($officer['JABATAN'] ?? '');
    if (str_contains($jabLower, 'komisaris') || str_contains($jabLower, 'commissioner')) {
        $tierKomisaris[] = $officer;
    } elseif (str_contains($jabLower, 'direktur utama') || str_contains($jabLower, 'president director')) {
        $tierDirut[] = $officer;
    } elseif (str_contains($jabLower, 'direktur') || str_contains($jabLower, 'director') || str_contains($jabLower, 'direksi')) {
        $tierDireksi[] = $officer;
    } else {
        $tierOthers[] = $officer;
    }
}

$tiers = [
    [
        'title' => $isIndo ? 'Dewan Komisaris' : 'Board of Commissioners',
        'badge' => $isIndo ? 'Tingkat Pengawas' : 'Supervisory Board',
        'desc'  => $isIndo ? 'Menjalankan fungsi pengawasan dan memberikan nasihat kepada Direksi.' : 'Carries out supervisory functions and provides advice to the Board of Directors.',
        'items' => $tierKomisaris,
        'cols'  => 'pms-grid-cols-2',
    ],
    [
        'title' => $isIndo ? 'Direktur Utama' : 'President Director',
        'badge' => $isIndo ? 'Pimpinan Eksekutif' : 'Executive Leadership',
        'desc'  => $isIndo ? 'Memimpin operasional dan strategi utama PT Pelindo Marine Service.' : 'Leads corporate operations and main strategic directions of PT Pelindo Marine Service.',
        'items' => $tierDirut,
        'cols'  => 'pms-grid-cols-1',
    ],
    [
        'title' => $isIndo ? 'Dewan Direksi' : 'Board of Directors',
        'badge' => $isIndo ? 'Jajaran Direksi' : 'Executive Directors',
        'desc'  => $isIndo ? 'Mengelola operasional maritim, komersial, keuangan, SDM, dan tata kelola risiko.' : 'Directs maritime operations, commercial, finance, human capital, and risk governance.',
        'items' => $tierDireksi,
        'cols'  => 'pms-grid-cols-2',
    ],
];

if (!empty($tierOthers)) {
    $tiers[] = [
        'title' => $isIndo ? 'Manajemen & Komite' : 'Management & Committees',
        'badge' => $isIndo ? 'Dukungan Tata Kelola' : 'Governance Support',
        'desc'  => $isIndo ? 'Mendukung efektivitas tata kelola dan pengawasan korporasi.' : 'Supports effective corporate governance and oversight functions.',
        'items' => $tierOthers,
        'cols'  => 'pms-grid-cols-3',
    ];
}
?>

<div class="pms-levelgrid-wrapper">
    <?php foreach ($tiers as $tier) : 
        if (empty($tier['items'])) continue;
    ?>
        <div class="pms-tier-section">
            <div class="pms-tier-header">
                <div class="pms-tier-badge-row">
                    <span class="pms-tier-badge"><?= esc($tier['badge']) ?></span>
                </div>
                <h3 class="pms-tier-title"><?= esc($tier['title']) ?></h3>
                <p class="pms-tier-desc"><?= esc($tier['desc']) ?></p>
            </div>

            <div class="pms-tier-grid <?= esc($tier['cols']) ?>">
                <?php foreach ($tier['items'] as $officer) : 
                    $slug = officer_slug($officer);
                    $name = !empty($officer['NAMA']) ? $officer['NAMA'] : '-';
                    $jabatan = !empty($officer['JABATAN']) ? $officer['JABATAN'] : '';
                    $desc = !empty($officer['DESCRIPTION']) ? $officer['DESCRIPTION'] : '';
                ?>
                    <div class="pms-level-card">
                        <div class="pms-level-card-photo-wrap">
                            <?= render_officer_photo($officer, 160) ?>
                        </div>
                        <div class="pms-level-card-content">
                            <span class="pms-level-role-tag"><?= esc($jabatan) ?></span>
                            <h4 class="pms-level-name"><?= esc($name) ?></h4>
                            <?php if (!empty($desc)) : ?>
                                <p class="pms-level-bio"><?= esc(character_limiter(strip_tags($desc), 120)) ?></p>
                            <?php endif; ?>
                            <a href="<?= site_url('profile/' . $slug) ?>" class="pms-level-btn">
                                <span><?= esc($txtViewProfile) ?></span>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
    /* =========================================================
       TEMPLATE 5: GRID PER LEVEL STYLES
       ========================================================= */
    .pms-levelgrid-wrapper {
        width: 100%;
        max-width: 1080px;
        margin: 0 auto;
    }

    .pms-tier-section {
        margin-bottom: 50px;
    }

    .pms-tier-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .pms-tier-badge {
        display: inline-block;
        padding: 4px 14px;
        background: #f0fdfa;
        color: #00828a;
        border: 1px solid #ccfbf1;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .pms-tier-title {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 6px;
    }

    .pms-tier-desc {
        font-size: 13.5px;
        color: #64748b;
        margin: 0;
    }

    .pms-tier-grid {
        display: grid;
        gap: 24px;
    }

    .pms-grid-cols-1 {
        grid-template-columns: 1fr;
        max-width: 540px;
        margin: 0 auto;
    }

    .pms-grid-cols-2 {
        grid-template-columns: repeat(2, 1fr);
    }

    .pms-grid-cols-3 {
        grid-template-columns: repeat(3, 1fr);
    }

    .pms-level-card {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .pms-level-card:hover {
        transform: translateY(-4px);
        border-color: #00ADB5;
        box-shadow: 0 12px 30px rgba(0, 173, 181, 0.12);
    }

    .pms-level-card-photo-wrap {
        width: 90px;
        height: 90px;
        border-radius: 14px;
        background: #f1f5f9;
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .pms-grid-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pms-grid-initials {
        font-size: 24px;
        font-weight: 700;
        color: #00ADB5;
    }

    .pms-level-card-content {
        flex: 1;
        min-width: 0;
    }

    .pms-level-role-tag {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        color: #00828a;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 4px;
    }

    .pms-level-name {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 6px;
        line-height: 1.3;
    }

    .pms-level-bio {
        font-size: 12.5px;
        color: #64748b;
        line-height: 1.5;
        margin: 0 0 12px;
    }

    .pms-level-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #00ADB5;
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none !important;
        transition: gap 0.2s ease;
    }

    .pms-level-btn:hover {
        gap: 10px;
        color: #00828a;
    }

    @media (max-width: 991px) {
        .pms-grid-cols-2,
        .pms-grid-cols-3 {
            grid-template-columns: 1fr;
        }

        .pms-level-card {
            padding: 16px;
            gap: 14px;
        }

        .pms-level-card-photo-wrap {
            width: 74px;
            height: 74px;
        }
    }
</style>
