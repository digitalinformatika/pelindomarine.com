<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
	$isIndo = ($weblangs == 'indonesia');

	// Hero banner (sementara: jika file banner dari CMS tidak ditemukan, pakai banner halaman About Us)
	// Dua lapisan: banner CMS di depan, gambar cadangan di belakang (tampil bila banner CMS gagal dimuat)
	$bannerCss = struktur_banner_css($banner['GAMBAR'] ?? null, base_url('upload/about-bgheader.jpg'));
?>
<section id="pms-inner-header" style="background-image: <?= $bannerCss ?>; background-size: cover; background-position: center;">
	<div class="container">
		<?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5><?= esc(!empty($banner['SUB_JUDUL']) ? $banner['SUB_JUDUL'] : 'Tentang Kami') ?></h5>
				<h2><?= esc(!empty($banner['JUDUL']) ? $banner['JUDUL'] : 'STRUKTUR ORGANISASI') ?></h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Tentang Kami / <b><a href="company/organization-structure" class="text-light">Struktur Organisasi</a></b></div>
			</div>
		</div>
		<?php } else { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5><?= esc(!empty($banner['SUB_TITLE']) ? $banner['SUB_TITLE'] : 'Company') ?></h5>
				<h2><?= esc(!empty($banner['TITLE']) ? $banner['TITLE'] : 'ORGANIZATION STRUCTURE') ?></h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Company / <b><a href="company/organization-structure" class="text-light">Organization Structure</a></b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock">
    <div class="container animate-box" style="background: #ffffff; margin-top: -80px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); padding: 40px 25px 60px;">
        <!-- Header Section -->
        <div class="row mb-5" style="padding: 0 15px 10px;">
            <div class="col-xs-12">
                <?php if ($weblangs=='indonesia') { ?>
                <span class="pms-org-badge">Kepemimpinan & Tata Kelola</span>
                <h3 class="pms-org-main-heading">Bagan Struktur Organisasi</h3>
                <p class="pms-org-sub-desc">Struktur tata kelola PT Pelindo Marine Service yang mencerminkan integrasi profesional antara Dewan Komisaris dan Direksi untuk mewujudkan layanan maritim terintegrasi berkelas dunia.</p>
                <?php } else { ?>
                <span class="pms-org-badge">Leadership & Governance</span>
                <h3 class="pms-org-main-heading">Organizational Chart</h3>
                <p class="pms-org-sub-desc">The corporate governance structure of PT Pelindo Marine Service, showcasing the professional alignment between the Board of Commissioners and the Board of Directors to deliver world-class integrated maritime services.</p>
                <?php } ?>
                <div class="pms-org-divider"></div>
            </div>
        </div>

        <!-- View Controls & Toolbar -->
        <div class="pms-org-toolbar">
            <div class="pms-org-toolbar-left">
                <span class="pms-org-instruction">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px; margin-right: 4px; color: #ff7f23;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <?php if ($weblangs=='indonesia') { ?>Klik kartu pejabat untuk melihat profil dan riwayat lengkap<?php } else { ?>Click any officer card to view their full profile and background<?php } ?>
                </span>
            </div>
        </div>

        <!-- Main Chart Container (Dynamic Template from CMS) -->
        <div class="pms-org-canvas-wrap" id="pmsOrgCanvasWrap">
            <?php
                $tplSlug = !empty($template['SLUG']) ? trim($template['SLUG']) : 'template-2';
                $viewFile = 'company/struktur/' . $tplSlug;
                if (! is_file(APPPATH . 'Views/' . $viewFile . '.php')) {
                    $viewFile = 'company/struktur/template-2';
                    if (! is_file(APPPATH . 'Views/' . $viewFile . '.php')) {
                        $viewFile = 'company/struktur/bagan_cards';
                    }
                }
                echo view($viewFile, [
                    'tree'     => $tree,
                    'officers' => $officers,
                    'isIndo'   => $isIndo,
                    'template' => $template,
                ]);
            ?>
        </div>
    </div>
</section>

<style>
    /* Styling Scoped for Organization Structure */
    .pms-org-badge {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(255, 127, 35, 0.1);
        color: #ce2c00;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 30px;
        margin-bottom: 12px;
    }

    .pms-org-main-heading {
        font-size: 30px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-top: 0;
        margin-bottom: 12px;
    }

    .pms-org-sub-desc {
        font-size: 15px;
        color: #475569;
        line-height: 1.7;
        max-width: 850px;
        margin: 0 0 20px 0;
    }

    .pms-org-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #ff7f23, #204280);
        margin: 0 0 10px 0;
        border-radius: 2px;
    }

    .pms-org-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 12px 18px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 25px;
    }

    .pms-org-instruction {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    .pms-org-toolbar-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pms-org-layout-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: #ce2c00;
        background: rgba(255, 127, 35, 0.08);
        border: 1px solid rgba(255, 127, 35, 0.25);
    }

    .pms-org-canvas-wrap {
        position: relative;
        width: 100%;
        overflow-x: auto;
        padding: 20px 10px 40px;
        background: #fafbfc;
        border: 1px solid #edf2f7;
        border-radius: 14px;
    }

    @media (max-width: 991px) {
        #pms-innerblock > .container {
            padding: 24px 14px 36px !important;
            margin-top: -40px !important;
            border-radius: 12px !important;
        }

        .pms-org-main-heading {
            font-size: 22px;
        }

        .pms-org-sub-desc {
            font-size: 13.5px;
        }

        .pms-org-toolbar {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
            padding: 10px 14px;
            gap: 10px;
        }

        .pms-org-toolbar-right {
            justify-content: center;
        }

        .pms-org-canvas-wrap {
            padding: 14px 6px 20px !important;
            overflow-x: visible !important;
            border-radius: 10px;
        }
    }
</style>
