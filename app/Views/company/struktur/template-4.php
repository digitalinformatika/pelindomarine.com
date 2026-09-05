<?php
/**
 * Template 4: Daftar Bertingkat
 * Tampilan daftar berjenjang (indented list), ringan dan mobile-friendly.
 *
 * @var array $tree
 * @var array $officers
 * @var bool  $isIndo
 */

$txtViewProfile = $isIndo ? 'Lihat Profil' : 'View Profile';
$txtSearch = $isIndo ? 'Cari nama atau jabatan...' : 'Search officer or position...';

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
            return '<img src="' . esc($photoUrl, 'attr') . '" alt="' . esc($name, 'attr') . '" class="pms-list-avatar-img" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'flex\';">' .
                   '<span class="pms-list-avatar-initials" style="display: none;">' . esc($initials) . '</span>';
        }

        return '<span class="pms-list-avatar-initials">' . esc($initials) . '</span>';
    }
}

/**
 * Recursive function to render indented tree list.
 */
function render_indented_list_node(array $node, int $depth, bool $isIndo, string $txtViewProfile): string {
    $slug = officer_slug($node);
    $name = !empty($node['NAMA']) ? $node['NAMA'] : '-';
    $jabatan = !empty($node['JABATAN']) ? $node['JABATAN'] : '';
    $photoHtml = render_officer_photo($node, 42);
    $hasChildren = !empty($node['children']);
    $depthClass = 'pms-depth-' . min($depth, 4);

    $html = '<li class="pms-list-item ' . $depthClass . ' ' . ($hasChildren ? 'has-sub' : '') . '" data-search="' . esc(strtolower($name . ' ' . $jabatan), 'attr') . '">';
    $html .= '<div class="pms-list-item-card">';
    $html .= '<div class="pms-list-avatar">' . $photoHtml . '</div>';
    
    $html .= '<div class="pms-list-info">';
    $html .= '<span class="pms-list-role">' . esc($jabatan) . '</span>';
    $html .= '<h4 class="pms-list-name">' . esc($name) . '</h4>';
    $html .= '</div>';

    $html .= '<div class="pms-list-action">';
    $html .= '<a href="' . site_url('profile/' . $slug) . '" class="pms-list-btn-profile">';
    $html .= '<span>' . esc($txtViewProfile) . '</span>';
    $html .= '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
    $html .= '</a>';
    $html .= '</div>';
    $html .= '</div>';

    if ($hasChildren) {
        $html .= '<ul class="pms-list-nested">';
        foreach ($node['children'] as $child) {
            $html .= render_indented_list_node($child, $depth + 1, $isIndo, $txtViewProfile);
        }
        $html .= '</ul>';
    }

    $html .= '</li>';

    return $html;
}
?>

<div class="pms-indented-wrapper">
    <!-- Quick Search Header -->
    <div class="pms-list-search-wrap">
        <div class="pms-list-search-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="pms-list-search-icon">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="pmsListSearchInput" class="pms-list-search-input" placeholder="<?= esc($txtSearch, 'attr') ?>" autocomplete="off">
        </div>
    </div>

    <!-- Hierarchical List -->
    <ul class="pms-indented-list" id="pmsIndentedList">
        <?php foreach ($tree as $root) : ?>
            <?= render_indented_list_node($root, 0, $isIndo, $txtViewProfile) ?>
        <?php endforeach; ?>
    </ul>
</div>

<style>
    /* =========================================================
       TEMPLATE 4: DAFTAR BERTINGKAT STYLES
       ========================================================= */
    .pms-indented-wrapper {
        width: 100%;
        max-width: 920px;
        margin: 0 auto;
    }

    .pms-list-search-wrap {
        margin-bottom: 24px;
    }

    .pms-list-search-box {
        position: relative;
        width: 100%;
    }

    .pms-list-search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .pms-list-search-input {
        width: 100%;
        height: 48px;
        padding: 10px 18px 10px 46px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        color: #1e293b;
        outline: none;
        transition: all 0.2s ease;
    }

    .pms-list-search-input:focus {
        border-color: #00ADB5;
        box-shadow: 0 0 0 3px rgba(0, 173, 181, 0.15);
    }

    .pms-indented-list,
    .pms-list-nested {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pms-list-nested {
        position: relative;
        padding-left: 28px;
        margin-top: 8px;
        margin-bottom: 8px;
        border-left: 2px dashed #cbd5e1;
    }

    .pms-list-item {
        position: relative;
        margin-bottom: 12px;
    }

    .pms-list-item-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 14px 18px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        transition: all 0.2s ease;
    }

    .pms-list-item-card:hover {
        border-color: #00ADB5;
        box-shadow: 0 6px 18px rgba(0, 173, 181, 0.1);
        transform: translateX(3px);
    }

    /* Depth Accents */
    .pms-depth-0 > .pms-list-item-card {
        background: linear-gradient(135deg, #ffffff 0%, #f0fdfa 100%);
        border-left: 4px solid #00ADB5;
    }

    .pms-depth-1 > .pms-list-item-card {
        border-left: 4px solid #204280;
    }

    .pms-depth-2 > .pms-list-item-card {
        border-left: 4px solid #0284c7;
    }

    .pms-depth-3 > .pms-list-item-card {
        border-left: 4px solid #64748b;
    }

    .pms-list-avatar {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #f1f5f9;
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pms-list-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pms-list-avatar-initials {
        font-size: 14px;
        font-weight: 700;
        color: #00ADB5;
    }

    .pms-list-info {
        flex: 1;
        min-width: 0;
    }

    .pms-list-role {
        display: block;
        font-size: 11.5px;
        font-weight: 700;
        color: #00828a;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 2px;
    }

    .pms-list-name {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1.35;
    }

    .pms-list-action {
        flex-shrink: 0;
    }

    .pms-list-btn-profile {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: #f0fdfa;
        border: 1px solid #ccfbf1;
        border-radius: 8px;
        color: #00828a;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }

    .pms-list-btn-profile:hover {
        background: #00ADB5;
        color: #ffffff;
        border-color: #00ADB5;
    }

    @media (max-width: 768px) {
        .pms-list-nested {
            padding-left: 14px;
        }
        .pms-list-item-card {
            padding: 12px 14px;
            gap: 12px;
        }
        .pms-list-btn-profile span {
            display: none;
        }
        .pms-list-btn-profile {
            padding: 8px;
            border-radius: 50%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('pmsListSearchInput');
        const items = document.querySelectorAll('.pms-list-item');
        if (!input || !items.length) return;

        input.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();
            items.forEach(function (item) {
                if (query === '') {
                    item.style.display = '';
                } else {
                    const text = item.getAttribute('data-search') || '';
                    if (text.includes(query)) {
                        item.style.display = '';
                    } else {
                        // Check if any descendant matches
                        const subMatches = item.querySelectorAll('.pms-list-item[data-search*="' + query + '"]');
                        item.style.display = subMatches.length > 0 ? '' : 'none';
                    }
                }
            });
        });
    });
</script>
