<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
	$isIndo = ($weblangs == 'indonesia');

	// ---- Data pejabat aktif ------------------------------------------------
	$officerName    = !empty($officer['NAMA']) ? $officer['NAMA'] : (!empty($officer['JABATAN']) ? $officer['JABATAN'] : 'Pejabat Pelindo Marine');
	$jabatanId      = !empty($officer['JABATAN']) ? $officer['JABATAN'] : '';
	$jabatanEn      = !empty($officer['DESCRIPTION']) ? $officer['DESCRIPTION'] : $jabatanId; // kolom DESCRIPTION = jabatan versi Inggris
	$officerJabatan = $isIndo ? $jabatanId : $jabatanEn;
	$officerId      = (int) ($officer['STRUKTUR_ID'] ?? 0);

	$curSlug    = !empty($currentSlug) ? strtolower($currentSlug) : officer_slug($officer);
	$profilSlug = !empty($template['SLUG']) ? trim($template['SLUG']) : 'profil-1';

	// Hero banner (sementara: jika file banner dari CMS tidak ditemukan, pakai banner halaman About Us)
	// Dua lapisan: banner CMS di depan, gambar cadangan di belakang (tampil bila banner CMS gagal dimuat)
	$bannerCss = struktur_banner_css($banner['GAMBAR'] ?? null, base_url('upload/about-bgheader.jpg'));

	// Foto: dari CMS, fallback ke banner board website lama
	$legacyPhotos = [
		'm-masyhud'          => 'board-m-masyhud_komut.png',
		'muhammad-masyhud'   => 'board-m-masyhud_komut.png',
		'andrei'             => 'board-andrei.png',
		'andrei-simanjuntak' => 'board-andrei.png',
		'warsilan'           => 'board4.png',
		'elvin'              => 'board-dirkom-elvin.png',
		'elvin-syah-putra'   => 'board-dirkom-elvin.png',
		'lia-indi-agustiana' => 'board5.jpg',
		'perbager'           => 'board-perbager.png',
	];
	$resolvedPhoto = '';
	if (!empty($officer['FOTO'])) {
		$resolvedPhoto = struktur_media_url($officer['FOTO']);
	} elseif (isset($legacyPhotos[$curSlug])) {
		$resolvedPhoto = base_url('upload/homepage/' . $legacyPhotos[$curSlug]);
	}
	$initials = '';
	foreach (array_slice(explode(' ', trim($officerName)), 0, 2) as $w) { $initials .= mb_substr($w, 0, 1); }
	$initials = strtoupper($initials);

	// Kelompok pejabat: Dewan Komisaris vs Direksi
	$isKomisaris = function (array $row): bool {
		$j = strtolower($row['JABATAN'] ?? '');
		return str_contains($j, 'komisaris') || str_contains($j, 'commissioner');
	};
	$komisarisList = [];
	$direksiList   = [];
	$ordered       = [];
	foreach ($allOfficers as $row) {
		if (empty($row['NAMA'])) continue;
		if ($isKomisaris($row)) $komisarisList[] = $row; else $direksiList[] = $row;
	}
	// Pimpinan (tanpa induk) tampil lebih dulu, lalu bawahannya sesuai urutan
	$byRank = function (array $a, array $b): int {
		$ra = empty($a['PARENT_ID']) ? 0 : 1;
		$rb = empty($b['PARENT_ID']) ? 0 : 1;
		return [$ra, (int) $a['URUTAN'], (int) $a['STRUKTUR_ID']] <=> [$rb, (int) $b['URUTAN'], (int) $b['STRUKTUR_ID']];
	};
	usort($komisarisList, $byRank);
	usort($direksiList, $byRank);
	$ordered = array_merge($komisarisList, $direksiList);

	// Navigasi pejabat sebelumnya / berikutnya
	$prevOfficer = null;
	$nextOfficer = null;
	foreach ($ordered as $i => $row) {
		if ((int) $row['STRUKTUR_ID'] === $officerId) {
			$prevOfficer = $ordered[$i - 1] ?? null;
			$nextOfficer = $ordered[$i + 1] ?? null;
			break;
		}
	}
	$groupLabel = $isKomisaris($officer ?? [])
		? ($isIndo ? 'Dewan Komisaris' : 'Board of Commissioners')
		: ($isIndo ? 'Dewan Direksi' : 'Board of Directors');

	// Judul & isi section sesuai bahasa
	$secTitle = function (array $sec, int $idx) use ($isIndo): string {
		$a = $isIndo ? ($sec['JUDUL'] ?? '') : ($sec['TITLE'] ?? '');
		$b = $isIndo ? ($sec['TITLE'] ?? '') : ($sec['JUDUL'] ?? '');
		return !empty($a) ? $a : (!empty($b) ? $b : 'Section ' . ($idx + 1));
	};
	$secBody = function (array $sec) use ($isIndo): string {
		$a = $isIndo ? ($sec['KETERANGAN'] ?? '') : ($sec['DESCRIPTION'] ?? '');
		$b = $isIndo ? ($sec['DESCRIPTION'] ?? '') : ($sec['KETERANGAN'] ?? '');
		return !empty($a) ? $a : (string) $b;
	};

	// Teks antarmuka
	$txtBack      = $isIndo ? 'Kembali ke Bagan Organisasi' : 'Back to Org Chart';
	$txtKomisaris = $isIndo ? 'Dewan Komisaris' : 'Board of Commissioners';
	$txtDireksi   = $isIndo ? 'Dewan Direksi' : 'Board of Directors';
	$txtPrev      = $isIndo ? 'Sebelumnya' : 'Previous';
	$txtNext      = $isIndo ? 'Berikutnya' : 'Next';
	$txtOthers    = $isIndo ? 'Pejabat Lainnya' : 'Other Officers';
	$txtProfile   = $isIndo ? 'Profil' : 'Profile';
	$txtEmpty     = $isIndo ? 'Informasi detail profil pejabat ini dapat diperbarui melalui CMS.' : 'Detailed biographical sections for this officer can be maintained via CMS.';
?>
<section id="pms-inner-header" style="background-image: <?= $bannerCss ?>; background-size: cover; background-position: center;">
	<div class="container">
		<?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5><?= esc(!empty($banner['SUB_JUDUL']) ? $banner['SUB_JUDUL'] : 'Struktur Organisasi') ?></h5>
				<h2><?= esc(!empty($banner['JUDUL']) ? $banner['JUDUL'] : 'PROFIL PEJABAT') ?></h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / <a href="company/organization-structure" class="text-light">Struktur Organisasi</a> / <b><?= esc($officerName) ?></b></div>
			</div>
		</div>
		<?php } else { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5><?= esc(!empty($banner['SUB_TITLE']) ? $banner['SUB_TITLE'] : 'Organization Structure') ?></h5>
				<h2><?= esc(!empty($banner['TITLE']) ? $banner['TITLE'] : 'EXECUTIVE PROFILE') ?></h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / <a href="company/organization-structure" class="text-light">Organization Structure</a> / <b><?= esc($officerName) ?></b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock" class="pms-prof-block">
	<div class="container animate-box pms-prof-container">

		<!-- ================= Kartu identitas pejabat ================= -->
		<div class="pms-prof-hero" style="background-image: <?= $bannerCss ?>;">
			<div class="pms-prof-hero-bg"></div>
			<div class="pms-prof-hero-inner">
				<div class="pms-prof-portrait">
					<?php if ($resolvedPhoto !== '') : ?>
						<img src="<?= esc($resolvedPhoto) ?>" alt="<?= esc($officerName) ?>"
						     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
						<span class="pms-prof-initials" style="display:none"><?= esc($initials) ?></span>
					<?php else : ?>
						<span class="pms-prof-initials"><?= esc($initials) ?></span>
					<?php endif; ?>
				</div>

				<div class="pms-prof-identity">
					<span class="pms-prof-group"><?= esc($groupLabel) ?></span>
					<h1 class="pms-prof-name"><?= esc($officerName) ?></h1>
					<p class="pms-prof-role"><?= esc($officerJabatan) ?></p>
					<?php if ($jabatanId !== '' && $jabatanEn !== '' && $jabatanId !== $jabatanEn) : ?>
						<p class="pms-prof-role-alt"><?= esc($isIndo ? $jabatanEn : $jabatanId) ?></p>
					<?php endif; ?>
					<div class="pms-prof-divider"></div>
					<div class="pms-prof-actions">
						<a href="<?= site_url('company/organization-structure') ?>" class="pms-prof-btn pms-prof-btn-light">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
							<?= $txtBack ?>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row pms-prof-body">
			<!-- ================= Konten section ================= -->
			<div class="col-md-8 col-xs-12">
				<div class="pms-prof-sections">
					<?php if (empty($sections)) : ?>
						<div class="pms-prof-empty"><?= $txtEmpty ?></div>

					<?php elseif ($profilSlug === 'profil-2') : ?>
						<!-- Template: Tab -->
						<div class="pms-tab-nav-wrapper">
							<button type="button" class="pms-tab-scroll-btn pms-tab-scroll-left" id="pmsTabScrollLeft" aria-label="Scroll left">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
							</button>
							<div class="pms-tab-nav-scroller" id="pmsTabNavScroller">
								<div class="pms-tab-nav-bar" role="tablist">
									<?php foreach ($sections as $idx => $sec) : ?>
										<button type="button" class="pms-tab-btn <?= $idx === 0 ? 'active' : '' ?>" data-tab-idx="<?= $idx ?>" role="tab"><?= esc($secTitle($sec, $idx)) ?></button>
									<?php endforeach; ?>
								</div>
							</div>
							<button type="button" class="pms-tab-scroll-btn pms-tab-scroll-right" id="pmsTabScrollRight" aria-label="Scroll right">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
							</button>
						</div>
						<div class="pms-tab-panels">
							<?php foreach ($sections as $idx => $sec) : ?>
								<div class="pms-tab-panel <?= $idx === 0 ? 'active' : '' ?>" id="pmsTabSec<?= $idx ?>" role="tabpanel">
									<div class="pms-section-body"><?= $secBody($sec) ?></div>
								</div>
							<?php endforeach; ?>
						</div>

					<?php elseif ($profilSlug === 'profil-3') : ?>
						<!-- Template: Accordion -->
						<div class="pms-profile-accordion">
							<?php foreach ($sections as $idx => $sec) : ?>
								<div class="pms-accordion-item <?= $idx === 0 ? 'open' : '' ?>">
									<button type="button" class="pms-accordion-header" aria-expanded="<?= $idx === 0 ? 'true' : 'false' ?>">
										<span class="pms-accordion-title"><span class="pms-section-num"><?= $idx + 1 ?></span><?= esc($secTitle($sec, $idx)) ?></span>
										<svg class="pms-accordion-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
									</button>
									<div class="pms-accordion-content" style="<?= $idx === 0 ? 'display:block;' : 'display:none;' ?>">
										<div class="pms-section-body"><?= $secBody($sec) ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

					<?php else : ?>
						<!-- Template: Klasik (section mengalir ke bawah) -->
						<?php foreach ($sections as $idx => $sec) :
							$t = $secTitle($sec, $idx); $b = $secBody($sec);
							if ($t === '' && $b === '') continue;
						?>
							<div class="pms-prof-section">
								<h4 class="pms-section-title"><span class="pms-section-num"><?= $idx + 1 ?></span><?= esc($t) ?></h4>
								<div class="pms-section-body"><?= $b ?></div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<!-- Navigasi pejabat sebelumnya / berikutnya -->
				<?php if ($prevOfficer || $nextOfficer) : ?>
				<div class="pms-prof-pager">
					<?php if ($prevOfficer) : ?>
						<a href="<?= site_url('profile/' . officer_slug($prevOfficer)) ?>" class="pms-prof-pager-item">
							<span class="pms-prof-pager-label">&larr; <?= $txtPrev ?></span>
							<span class="pms-prof-pager-name"><?= esc($prevOfficer['NAMA']) ?></span>
							<span class="pms-prof-pager-role"><?= esc($isIndo ? $prevOfficer['JABATAN'] : ($prevOfficer['DESCRIPTION'] ?: $prevOfficer['JABATAN'])) ?></span>
						</a>
					<?php else : ?><span></span><?php endif; ?>
					<?php if ($nextOfficer) : ?>
						<a href="<?= site_url('profile/' . officer_slug($nextOfficer)) ?>" class="pms-prof-pager-item text-right">
							<span class="pms-prof-pager-label"><?= $txtNext ?> &rarr;</span>
							<span class="pms-prof-pager-name"><?= esc($nextOfficer['NAMA']) ?></span>
							<span class="pms-prof-pager-role"><?= esc($isIndo ? $nextOfficer['JABATAN'] : ($nextOfficer['DESCRIPTION'] ?: $nextOfficer['JABATAN'])) ?></span>
						</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<!-- ================= Sidebar pejabat lain ================= -->
			<div class="col-md-4 col-xs-12 pms-prof-sidebar-col">
				<aside class="pms-prof-sidebar">
					<div class="pms-prof-sidebar-head"><?= $txtOthers ?></div>
					<?php foreach ([[$txtKomisaris, $komisarisList], [$txtDireksi, $direksiList]] as [$label, $list]) : if (empty($list)) continue; ?>
						<div class="pms-prof-sidebar-group">
							<div class="pms-prof-sidebar-title"><?= $label ?></div>
							<ul class="pms-prof-sidebar-nav">
								<?php foreach ($list as $item) :
									$itemSlug  = officer_slug($item);
									$isActive  = ((int) $item['STRUKTUR_ID'] === $officerId);
									$itemPhoto = !empty($item['FOTO']) ? struktur_media_url($item['FOTO']) : (isset($legacyPhotos[$itemSlug]) ? base_url('upload/homepage/' . $legacyPhotos[$itemSlug]) : '');
									$itemIni   = '';
									foreach (array_slice(explode(' ', trim($item['NAMA'])), 0, 2) as $w) { $itemIni .= mb_substr($w, 0, 1); }
								?>
								<li>
									<a href="<?= site_url('profile/' . $itemSlug) ?>" class="pms-prof-sidebar-item <?= $isActive ? 'active' : '' ?>">
										<span class="pms-prof-sidebar-avatar">
											<?php if ($itemPhoto !== '') : ?>
												<img src="<?= esc($itemPhoto) ?>" alt="" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
												<span style="display:none"><?= esc(strtoupper($itemIni)) ?></span>
											<?php else : ?>
												<span><?= esc(strtoupper($itemIni)) ?></span>
											<?php endif; ?>
										</span>
										<span class="pms-prof-sidebar-text">
											<span class="pms-prof-sidebar-name"><?= esc($item['NAMA']) ?></span>
											<span class="pms-prof-sidebar-role"><?= esc($isIndo ? $item['JABATAN'] : (!empty($item['DESCRIPTION']) ? $item['DESCRIPTION'] : $item['JABATAN'])) ?></span>
										</span>
										<?php if ($isActive) : ?><span class="pms-prof-sidebar-now"><?= $txtProfile ?></span><?php endif; ?>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endforeach; ?>
				</aside>
			</div>
		</div>
	</div>
</section>

<style>
	/* ============ Halaman profil pejabat ============ */
	/* Jarak ke header memakai padding berlatar putih (bukan margin) agar menu
	   off-canvas mobile yang terpasang di belakang halaman tidak terlihat di celah */
	#pms-innerblock.pms-prof-block {
		margin-top: 0;
		padding-top: 40px;
		background: #ffffff;
	}
	.pms-prof-container {
		background: #ffffff;
		margin-top: 0;
		border-radius: 16px;
		box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
		padding: 0 0 50px;
		overflow: hidden;
	}

	/* Kartu identitas */
	.pms-prof-hero {
		position: relative;
		padding: 40px 40px 34px;
		background-color: #204280;
		background-size: cover;
		background-position: center;
		overflow: hidden;
	}
	/* Lapisan biru transparan di atas gambar banner */
	.pms-prof-hero-bg {
		position: absolute;
		inset: 0;
		background: linear-gradient(135deg, rgba(29, 61, 122, 0.9) 0%, rgba(32, 66, 128, 0.82) 60%, rgba(43, 79, 146, 0.78) 100%);
	}
	.pms-prof-hero-inner {
		position: relative;
		display: flex;
		align-items: center;
		gap: 36px;
	}
	.pms-prof-portrait {
		flex: 0 0 200px;
		width: 200px;
		height: 200px;
		border-radius: 20px;
		overflow: hidden;
		background: #e2e8f0;
		border: 4px solid rgba(255, 255, 255, 0.9);
		box-shadow: 0 16px 40px rgba(0, 0, 0, 0.28);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.pms-prof-portrait img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		object-position: center top;
		display: block;
	}
	.pms-prof-initials {
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100%;
		height: 100%;
		font-size: 56px;
		font-weight: 800;
		color: #204280;
		background: #e2e8f0;
	}
	.pms-prof-identity {
		flex: 1;
		min-width: 0;
		color: #ffffff;
	}
	.pms-prof-group {
		display: inline-block;
		padding: 5px 14px;
		border-radius: 30px;
		background: #ff7f23;
		color: #ffffff;
		font-size: 11px;
		font-weight: 700;
		letter-spacing: 1px;
		text-transform: uppercase;
		margin-bottom: 14px;
	}
	.pms-prof-name {
		font-size: 34px;
		font-weight: 800;
		line-height: 1.15;
		margin: 0 0 8px;
		color: #ffffff;
		letter-spacing: -0.3px;
	}
	.pms-prof-role {
		font-size: 17px;
		font-weight: 600;
		color: #ffffff;
		margin: 0;
	}
	.pms-prof-role-alt {
		font-size: 13.5px;
		color: rgba(255, 255, 255, 0.72);
		margin: 4px 0 0;
		font-style: italic;
	}
	.pms-prof-divider {
		width: 56px;
		height: 3px;
		background: #ff7f23;
		border-radius: 2px;
		margin: 18px 0;
	}
	.pms-prof-actions {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
	}
	.pms-prof-btn {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 9px 18px;
		border-radius: 30px;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none !important;
		transition: all 0.2s ease;
	}
	.pms-prof-btn-light {
		background: rgba(255, 255, 255, 0.14);
		color: #ffffff;
		border: 1px solid rgba(255, 255, 255, 0.35);
	}
	.pms-prof-btn-light:hover {
		background: #ff7f23;
		border-color: #ff7f23;
		color: #ffffff;
		transform: translateX(-3px);
	}

	/* Badan halaman */
	.pms-prof-body {
		padding: 36px 25px 0;
	}
	.pms-prof-sections {
		padding-right: 10px;
	}
	.pms-prof-section {
		margin-bottom: 28px;
		padding-bottom: 24px;
		border-bottom: 1px solid #eef2f7;
	}
	.pms-prof-section:last-child {
		border-bottom: none;
	}
	.pms-section-title {
		display: flex;
		align-items: center;
		gap: 12px;
		font-size: 18px;
		font-weight: 700;
		color: #204280;
		margin: 0 0 14px;
	}
	.pms-section-num {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 28px;
		height: 28px;
		border-radius: 8px;
		background: rgba(255, 127, 35, 0.12);
		color: #ce2c00;
		font-size: 12px;
		font-weight: 800;
		flex-shrink: 0;
	}
	.pms-section-body {
		font-size: 14.5px;
		color: #334155;
		line-height: 1.85;
	}
	.pms-section-body p { margin-bottom: 12px; text-align: justify; }
	.pms-section-body p:last-child { margin-bottom: 0; }
	.pms-section-body h1, .pms-section-body h2, .pms-section-body h3,
	.pms-section-body h4, .pms-section-body h5, .pms-section-body h6 {
		color: #0f172a; font-weight: 700; margin: 18px 0 8px;
	}
	.pms-section-body ul, .pms-section-body ol { padding-left: 24px; margin-bottom: 14px; }
	.pms-section-body ul { list-style-type: disc; }
	.pms-section-body ol { list-style-type: decimal; }
	.pms-section-body li { margin-bottom: 6px; line-height: 1.7; }
	.pms-section-body blockquote {
		border-left: 4px solid #ff7f23; padding: 8px 16px; margin: 14px 0;
		background: #f8fafc; color: #475569; font-style: italic; border-radius: 0 8px 8px 0;
	}
	.pms-section-body table { width: 100%; border-collapse: collapse; margin: 16px 0; font-size: 13.5px; }
	.pms-section-body table th, .pms-section-body table td { border: 1px solid #e2e8f0; padding: 10px 14px; text-align: left; }
	.pms-section-body table th { background: #f1f5f9; font-weight: 700; color: #1e293b; }
	.pms-section-body a { color: #ce2c00; text-decoration: underline; }
	.pms-section-body a:hover { color: #ff7f23; }
	.pms-section-body img { max-width: 100%; height: auto; border-radius: 8px; margin: 12px 0; }

	.pms-prof-empty {
		padding: 30px 20px;
		text-align: center;
		color: #64748b;
		background: #f8fafc;
		border-radius: 12px;
		border: 1px dashed #cbd5e1;
	}

	/* Pager pejabat */
	.pms-prof-pager {
		display: flex;
		justify-content: space-between;
		gap: 14px;
		margin-top: 30px;
		padding-top: 22px;
		border-top: 2px solid #eef2f7;
	}
	.pms-prof-pager-item {
		display: flex;
		flex-direction: column;
		max-width: 48%;
		padding: 12px 16px;
		border-radius: 12px;
		border: 1px solid #e2e8f0;
		text-decoration: none !important;
		transition: all 0.2s ease;
	}
	.pms-prof-pager-item:hover {
		border-color: #ff7f23;
		box-shadow: 0 6px 18px rgba(255, 127, 35, 0.15);
		transform: translateY(-2px);
	}
	.pms-prof-pager-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #ce2c00; margin-bottom: 4px; }
	.pms-prof-pager-name  { font-size: 14px; font-weight: 700; color: #204280; }
	.pms-prof-pager-role  { font-size: 12px; color: #64748b; }

	/* Sidebar */
	.pms-prof-sidebar {
		background: #f8fafc;
		border: 1px solid #e2e8f0;
		border-radius: 14px;
		padding: 18px 14px;
		position: sticky;
		top: 24px;
	}
	.pms-prof-sidebar-head {
		font-size: 15px;
		font-weight: 800;
		color: #204280;
		padding: 0 8px 12px;
		margin-bottom: 8px;
		border-bottom: 2px solid #ff7f23;
	}
	.pms-prof-sidebar-group { margin-top: 10px; }
	.pms-prof-sidebar-title {
		font-size: 11px;
		font-weight: 800;
		text-transform: uppercase;
		letter-spacing: 0.8px;
		color: #64748b;
		padding: 6px 8px;
	}
	.pms-prof-sidebar-nav { list-style: none; padding: 0; margin: 0; }
	.pms-prof-sidebar-item {
		display: flex;
		align-items: center;
		gap: 12px;
		padding: 8px 10px;
		border-radius: 12px;
		border: 1px solid transparent;
		text-decoration: none !important;
		margin-bottom: 4px;
		transition: all 0.2s ease;
	}
	.pms-prof-sidebar-item:hover { background: #ffffff; border-color: #cbd5e1; }
	.pms-prof-sidebar-item.active {
		background: #ffffff;
		border-color: #ff7f23;
		box-shadow: 0 4px 14px rgba(255, 127, 35, 0.14);
	}
	.pms-prof-sidebar-avatar {
		flex: 0 0 44px;
		width: 44px;
		height: 44px;
		border-radius: 50%;
		overflow: hidden;
		background: #e2e8f0;
		border: 2px solid #ffffff;
		box-shadow: 0 2px 8px rgba(0, 32, 96, 0.14);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.pms-prof-sidebar-item.active .pms-prof-sidebar-avatar { border-color: #ff7f23; }
	.pms-prof-sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; object-position: center top; display: block; }
	.pms-prof-sidebar-avatar span { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; font-size: 13px; font-weight: 800; color: #204280; }
	.pms-prof-sidebar-text { display: flex; flex-direction: column; min-width: 0; flex: 1; }
	.pms-prof-sidebar-name { font-size: 13.5px; font-weight: 700; color: #0f172a; line-height: 1.3; }
	.pms-prof-sidebar-item.active .pms-prof-sidebar-name { color: #204280; }
	.pms-prof-sidebar-role { font-size: 11.5px; color: #64748b; line-height: 1.3; margin-top: 2px; }
	.pms-prof-sidebar-now {
		font-size: 10px;
		font-weight: 700;
		text-transform: uppercase;
		color: #ffffff;
		background: #ff7f23;
		padding: 3px 8px;
		border-radius: 20px;
		flex-shrink: 0;
	}

	/* Template tab */
	.pms-tab-nav-wrapper { position: relative; display: flex; align-items: center; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; }
	.pms-tab-nav-scroller { flex: 1; overflow-x: auto; overflow-y: hidden; scrollbar-width: none; scroll-behavior: smooth; padding-bottom: 2px; margin-bottom: -2px; }
	.pms-tab-nav-scroller::-webkit-scrollbar { display: none; }
	.pms-tab-nav-bar { display: inline-flex; white-space: nowrap; gap: 8px; padding: 0 4px; }
	.pms-tab-btn {
		flex: 0 0 auto; padding: 10px 20px; font-size: 13.5px; font-weight: 600; color: #64748b;
		background: transparent; border: none; border-bottom: 2px solid transparent; margin-bottom: -2px;
		cursor: pointer; outline: none; border-radius: 6px 6px 0 0; transition: all 0.2s ease;
	}
	.pms-tab-btn:hover { color: #ce2c00; background: rgba(255, 127, 35, 0.05); }
	.pms-tab-btn.active { color: #204280; border-bottom-color: #ff7f23; font-weight: 700; background: rgba(255, 127, 35, 0.08); }
	.pms-tab-scroll-btn {
		display: none; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%;
		background: #ffffff; border: 1px solid #cbd5e1; color: #334155; cursor: pointer; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		flex-shrink: 0; margin-bottom: -2px; transition: all 0.2s ease;
	}
	.pms-tab-scroll-btn:hover { background: #ff7f23; border-color: #ff7f23; color: #ffffff; }
	.pms-tab-scroll-left { margin-right: 6px; }
	.pms-tab-scroll-right { margin-left: 6px; }
	.pms-tab-panel { display: none; animation: pmsFadeIn 0.3s ease; }
	.pms-tab-panel.active { display: block; }
	@keyframes pmsFadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

	/* Template accordion */
	.pms-profile-accordion { display: flex; flex-direction: column; gap: 12px; }
	.pms-accordion-item { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; transition: all 0.2s ease; }
	.pms-accordion-item.open { border-color: #ff7f23; box-shadow: 0 4px 14px rgba(255, 127, 35, 0.1); }
	.pms-accordion-header { display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 14px 18px; background: #f8fafc; border: none; cursor: pointer; outline: none; }
	.pms-accordion-item.open .pms-accordion-header { background: #fff7f0; }
	.pms-accordion-title { display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 700; color: #204280; }
	.pms-accordion-icon { color: #64748b; transition: transform 0.25s ease; flex-shrink: 0; }
	.pms-accordion-item.open .pms-accordion-icon { transform: rotate(180deg); color: #ff7f23; }
	.pms-accordion-content { padding: 18px 20px 20px; border-top: 1px solid #e2e8f0; }

	@media (max-width: 991px) {
		/* Breadcrumb header di mobile keluar dari area banner (di halaman lain
		   tertutup kartu konten), jadi disembunyikan agar tidak menimpa kartu */
		#pms-inner-header .breadcumbs { display: none; }
		#pms-inner-header { overflow: hidden; }
		.pms-prof-container { margin-top: 0; border-radius: 12px; }
		.pms-prof-hero { padding: 28px 20px 26px; }
		.pms-prof-hero-inner { flex-direction: column; align-items: flex-start; gap: 20px; }
		.pms-prof-portrait { flex-basis: auto; width: 140px; height: 140px; border-radius: 16px; }
		.pms-prof-name { font-size: 26px; }
		.pms-prof-role { font-size: 15px; }
		.pms-prof-body { padding: 26px 15px 0; }
		.pms-prof-sections { padding-right: 0; }
		/* Di mobile navigasi pejabat (sidebar & sebelumnya/berikutnya) disembunyikan,
		   pengunjung kembali lewat tombol "Kembali ke Bagan Organisasi" */
		.pms-prof-sidebar-col,
		.pms-prof-pager { display: none; }
		.pms-tab-btn { padding: 8px 12px; font-size: 12.5px; }
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Tab (profil-2)
		var tabBtns = document.querySelectorAll('.pms-tab-btn');
		var scroller = document.getElementById('pmsTabNavScroller');
		var btnL = document.getElementById('pmsTabScrollLeft');
		var btnR = document.getElementById('pmsTabScrollRight');
		if (scroller) {
			var check = function () {
				var overflow = scroller.scrollWidth > scroller.clientWidth;
				if (btnL) btnL.style.display = (overflow && scroller.scrollLeft > 5) ? 'inline-flex' : 'none';
				if (btnR) btnR.style.display = (overflow && scroller.scrollLeft < scroller.scrollWidth - scroller.clientWidth - 5) ? 'inline-flex' : 'none';
			};
			scroller.addEventListener('scroll', check);
			window.addEventListener('resize', check);
			setTimeout(check, 100);
			if (btnL) btnL.addEventListener('click', function () { scroller.scrollBy({ left: -220, behavior: 'smooth' }); });
			if (btnR) btnR.addEventListener('click', function () { scroller.scrollBy({ left: 220, behavior: 'smooth' }); });
		}
		tabBtns.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var idx = this.getAttribute('data-tab-idx');
				tabBtns.forEach(function (b) { b.classList.remove('active'); });
				this.classList.add('active');
				this.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
				document.querySelectorAll('.pms-tab-panel').forEach(function (p) { p.classList.remove('active'); });
				var panel = document.getElementById('pmsTabSec' + idx);
				if (panel) panel.classList.add('active');
			});
		});

		// Accordion (profil-3)
		document.querySelectorAll('.pms-accordion-header').forEach(function (header) {
			header.addEventListener('click', function () {
				var item = this.closest('.pms-accordion-item');
				var content = item.querySelector('.pms-accordion-content');
				var open = item.classList.toggle('open');
				this.setAttribute('aria-expanded', open ? 'true' : 'false');
				content.style.display = open ? 'block' : 'none';
			});
		});
	});
</script>
