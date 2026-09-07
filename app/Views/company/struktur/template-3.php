<?php
/**
 * Template 3: Bagan Horizontal
 * Bagan menyamping dari kiri ke kanan, cocok untuk struktur yang dalam.
 *
 * @var array $tree
 * @var array $officers
 * @var bool  $isIndo
 */

$txtViewProfile = $isIndo ? 'Lihat Profil' : 'View Profile';

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
            return '<img src="' . esc($photoUrl, 'attr') . '" alt="' . esc($name, 'attr') . '" class="pms-h-avatar-img" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'flex\';">' .
                   '<span class="pms-h-avatar-initials" style="display: none;">' . esc($initials) . '</span>';
        }

        return '<span class="pms-h-avatar-initials">' . esc($initials) . '</span>';
    }
}

/**
 * Recursive function to render horizontal hierarchy branch.
 */
function render_horizontal_node(array $node, bool $isIndo, string $txtViewProfile): string {
    $slug = officer_slug($node);
    $name = !empty($node['NAMA']) ? $node['NAMA'] : '-';
    $jabatan = !empty($node['JABATAN']) ? $node['JABATAN'] : '';
    $photoHtml = render_officer_photo($node, 44);
    $hasChildren = !empty($node['children']);

    $html = '<div class="pms-h-item ' . ($hasChildren ? 'pms-h-has-children' : '') . '">';
    $html .= '<div class="pms-h-node">';
    $html .= '<a href="' . site_url('profile/' . $slug) . '" class="pms-h-card">';
    $html .= '<div class="pms-h-avatar-wrap">' . $photoHtml . '</div>';
    $html .= '<div class="pms-h-card-content">';
    $html .= '<span class="pms-h-role">' . esc($jabatan) . '</span>';
    $html .= '<h5 class="pms-h-name">' . esc($name) . '</h5>';
    $html .= '<span class="pms-h-link">' . esc($txtViewProfile) . ' &rarr;</span>';
    $html .= '</div>';
    $html .= '</a>';
    $html .= '</div>';

    if ($hasChildren) {
        $html .= '<div class="pms-h-children">';
        foreach ($node['children'] as $child) {
            $html .= render_horizontal_node($child, $isIndo, $txtViewProfile);
        }
        $html .= '</div>';
    }

    $html .= '</div>';

    return $html;
}
?>

<div class="pms-horizontal-wrapper">
    <!-- Mobile Swipe Hint -->
    <div class="pms-mobile-swipe-hint">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
        <span><?= $isIndo ? 'Geser kiri & kanan untuk melihat alur struktur' : 'Swipe left & right to explore the horizontal chart' ?></span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </div>

    <!-- Horizontal Tree Container -->
    <div class="pms-h-scrollport" id="pmsHScrollport">
        <div class="pms-h-tree">
            <?php foreach ($tree as $root) : ?>
                <div class="pms-h-root-branch">
                    <?= render_horizontal_node($root, $isIndo, $txtViewProfile) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    /* =========================================================
       TEMPLATE 3: BAGAN HORIZONTAL STYLES
       ========================================================= */
    .pms-horizontal-wrapper {
        position: relative;
        width: 100%;
        user-select: none;
    }

    .pms-h-scrollport {
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        padding: 24px 14px 40px;
        cursor: grab;
    }

    .pms-h-scrollport:active {
        cursor: grabbing;
    }

    .pms-h-tree {
        display: inline-flex;
        flex-direction: column;
        gap: 40px;
        min-width: max-content;
    }

    .pms-h-root-branch {
        display: flex;
        align-items: center;
    }

    .pms-h-item {
        display: flex;
        align-items: center;
        position: relative;
    }

    .pms-h-node {
        position: relative;
        z-index: 2;
        padding: 10px 0;
    }

    .pms-h-card {
        display: flex;
        align-items: center;
        gap: 14px;
        width: 290px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
        text-decoration: none !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .pms-h-card:hover {
        transform: translateX(4px);
        border-color: #00ADB5;
        box-shadow: 0 8px 24px rgba(0, 173, 181, 0.15);
    }

    .pms-h-avatar-wrap {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: #f1f5f9;
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pms-h-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pms-h-avatar-initials {
        font-size: 14px;
        font-weight: 700;
        color: #00ADB5;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .pms-h-card-content {
        flex: 1;
        min-width: 0;
    }

    .pms-h-role {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #00828a;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }

    .pms-h-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pms-h-link {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        display: inline-block;
        transition: color 0.2s ease;
    }

    .pms-h-card:hover .pms-h-link {
        color: #00ADB5;
    }

    /* Horizontal Connectors */
    .pms-h-has-children {
        position: relative;
    }

    .pms-h-has-children > .pms-h-node::after {
        content: '';
        position: absolute;
        right: -32px;
        top: 50%;
        width: 32px;
        height: 2px;
        background: #cbd5e1;
    }

    .pms-h-children {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 16px;
        padding-left: 32px;
        position: relative;
    }

    .pms-h-children::before {
        content: '';
        position: absolute;
        left: 0;
        top: 36px;
        bottom: 36px;
        width: 2px;
        background: #cbd5e1;
    }

    .pms-h-children > .pms-h-item::before {
        content: '';
        position: absolute;
        left: -32px;
        top: 50%;
        width: 32px;
        height: 2px;
        background: #cbd5e1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const port = document.getElementById('pmsHScrollport');
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
