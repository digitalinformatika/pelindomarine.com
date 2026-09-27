<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
	$isIndo = ($weblangs == 'indonesia');

	/**
	 * Ukuran file, hanya bila berkasnya benar-benar ada di server ini.
	 * Dokumen yang disimpan sebagai tautan Google Drive tidak bisa diukur,
	 * jadi subjudulnya cukup "Unduh File" tanpa angka.
	 */
	$ukuranFile = static function (?string $rel): string {
		if ($rel === null || trim($rel) === '') {
			return '';
		}

		$path = FCPATH . 'uploads/' . ltrim(trim($rel), '/\\');
		if (! is_file($path)) {
			return '';
		}

		$bytes = filesize($path);
		if ($bytes === false || $bytes <= 0) {
			return '';
		}

		$satuan = ['B', 'KB', 'MB', 'GB'];
		$i      = (int) min(floor(log($bytes, 1024)), count($satuan) - 1);

		return number_format($bytes / (1024 ** $i), $i === 0 ? 0 : 2, ',', '.') . $satuan[$i];
	};

	$teksUnduh = $isIndo ? 'Unduh' : 'Download';

	/**
	 * Prinsip GCG (Transparansi, Akuntabilitas, ...) di konten CMS ditulis
	 * sebagai dua tabel berdampingan tanpa ikon. Saat render, tabel itu
	 * diubah menjadi daftar vertikal ber-ikon ala list-icon-text pelindotpk.
	 * HTML di database tidak disentuh; bila struktur tabelnya tidak dikenali,
	 * konten tampil apa adanya.
	 */
	$ubahPrinsipGcg = static function (string $html): string {
		$ikon = [
			'transparen'  => 'icon-transparency.svg', // Transparansi / Transparency
			'akuntabil'   => 'icon-accountability.svg',
			'accountab'   => 'icon-accountability.svg',
			'tanggung'    => 'icon-responsibility.svg',
			'responsib'   => 'icon-responsibility.svg',
			'kemandirian' => 'icon-independence.svg',
			'independen'  => 'icon-independence.svg',
			'kewajaran'   => 'icon-fairness.svg',
			'fairness'    => 'icon-fairness.svg',
		];

		$polaTabel = '#<table class="table-responsive-sm"[^>]*>\s*<tr>\s*((?:<td class="tdpadright">.*?</td>\s*)+)</tr>\s*</table>#is';
		$polaSel   = '#<td class="tdpadright">\s*<p class="tvalues3 themeblue"[^>]*>\s*(.*?)\s*</p>\s*<span class="themeblue">(.*?)</span>\s*</td>#is';

		$html = preg_replace_callback($polaTabel, static function (array $tabel) use ($polaSel, $ikon): string {
			if (! preg_match_all($polaSel, $tabel[1], $sel, PREG_SET_ORDER)) {
				return $tabel[0];
			}

			$items = '';
			foreach ($sel as $s) {
				$judul     = trim(strip_tags($s[1]));
				$deskripsi = trim(preg_replace('#(<br\s*/?>\s*)+$#i', '', trim($s[2])));
				$file      = 'icon-responsibility.svg';
				foreach ($ikon as $kunci => $namaFile) {
					if (stripos($judul, $kunci) !== false) {
						$file = $namaFile;
						break;
					}
				}

				$items .= '<div class="list-icon-text__item">'
					. '<figure><img src="images/gcg/' . $file . '" alt=""></figure>'
					. '<div class="list-icon-text__item--content">'
					. '<h6>' . esc($judul) . '</h6>'
					. '<p>' . $deskripsi . '</p>'
					. '</div></div>';
			}

			// Penanda akhir daftar dipakai untuk membersihkan <br> di bawahnya.
			return '<div class="list-icon-text smaller">' . $items . '</div><!--/list-icon-text-->';
		}, $html);

		// Dua tabel yang berurutan menjadi satu daftar.
		$html = preg_replace('#</div><!--/list-icon-text-->\s*<div class="list-icon-text smaller">#', '', $html);

		// Konten CMS memberi <br> bertumpuk di atas dan bawah tabel; jarak
		// daftar sudah diatur lewat margin CSS, jadi <br> itu dibuang.
		$html = preg_replace('#(?:<br\s*/?>\s*)+(<div class="list-icon-text smaller">)#i', '$1', $html);
		$html = preg_replace('#(<!--/list-icon-text-->)(?:\s*<br\s*/?>)+#i', '$1', $html);

		return str_replace('<!--/list-icon-text-->', '', $html);
	};
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap">

<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/regulatory-bgheader.jpg);">
	<div class="container">
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -50px;">
				<h5><?php echo $isIndo ? 'Tentang Kami' : 'Company'; ?></h5>
				<h2><?php echo $isIndo ? 'REGULASI LAYANAN' : 'REGULATORY FRAMEWORKS'; ?></h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / <?php echo $isIndo ? 'Tentang Kami' : 'Company'; ?> / <b><a href="company/regulatory" class="text-light"><?php echo $isIndo ? 'Regulasi Layanan' : 'Regulatory Frameworks'; ?></a></b></div>
			</div>
		</div>
	</div>
</section>

<section id="pms-innerblock">
<div class="container animate-box" style="background: #fff; margin-top: -80px;">
	<div class="tdpadding">
		<!-- Mengikuti struktur halaman tata-kelola pelindotpk.co.id:
		     .main-content > .wrapper-content > .section-textintro + .box-accordion -->
		<div class="main-content">
			<div class="wrapper-content">

				<div class="section-textintro">
					<?php
						foreach ($companydata as $c) {
							if ($c['TITLE'] !== 'Regulatory Frameworks') {
								continue;
							}
							echo $ubahPrinsipGcg($isIndo ? $c['KETERANGAN'] : $c['DESCRIPTION']);
						}
					?>
				</div>

				<div class="box-accordion">

					<!-- Dokumen regulasi (dikelola dari CMS: Perusahaan > Regulasi) -->
					<?php if (!empty($companydocs)) { ?>
					<div class="accordion active">
						<a class="accordion__head" role="button" tabindex="0" aria-expanded="true">
							<?php echo $isIndo ? 'Dokumen Regulasi' : 'Regulatory Documents'; ?>
						</a>
						<div class="accordion__content">
							<div class="list-document">
								<?php foreach ($companydocs as $cd) {
									$docTitle = $isIndo
										? $cd['judul']
										: (!empty($cd['title']) ? $cd['title'] : $cd['judul']);
									$docLink  = !empty($cd['file']) ? cms_media_url($cd['file']) : ($cd['url'] ?? '#');
									$docSize  = $ukuranFile($cd['file'] ?? null);
									$docNote  = ($isIndo ? 'Unduh File' : 'Download File') . ($docSize !== '' ? ' ' . $docSize : '');
								?>
								<a class="list-document__item" href="<?php echo esc($docLink); ?>" target="_blank" rel="noopener">
									<figure><img src="images/icon-pdf.svg" alt=""></figure>
									<div class="list-document__item--text">
										<h6><?php echo esc($docTitle); ?></h6>
										<span><?php echo esc($docNote); ?></span>
									</div>
									<span class="button button-link button-icon">
										<?php echo $teksUnduh; ?> <i class="button-icon__right"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 3v11m0 0-4-4m4 4 4-4M4 20h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></i>
									</span>
								</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>

					<!-- Annual report (dikelola dari CMS: Perusahaan > Regulasi > Annual Report) -->
					<?php if (!empty($annualreports)) { ?>
					<div class="accordion<?php echo empty($companydocs) ? ' active' : ''; ?>">
						<a class="accordion__head" role="button" tabindex="0" aria-expanded="<?php echo empty($companydocs) ? 'true' : 'false'; ?>">
							<?php echo $isIndo ? 'Laporan Tahunan' : 'Annual Report'; ?>
						</a>
						<div class="accordion__content">
							<div class="list-annual">
								<?php foreach ($annualreports as $ar) {
									$arLabel = $isIndo
										? (!empty($ar['judul']) ? $ar['judul'] : 'Laporan Tahunan')
										: (!empty($ar['title']) ? $ar['title'] : 'Annual Report');
									$arCover = cms_media_url($ar['cover'] ?? null, 'upload');
									$arLink  = !empty($ar['file']) ? cms_media_url($ar['file']) : ($ar['url'] ?? '#');
								?>
								<a class="list-annual__item" href="<?php echo esc($arLink); ?>" target="_blank" rel="noopener">
									<figure>
										<?php if ($arCover) { ?>
										<img src="<?php echo esc($arCover); ?>" alt="<?php echo esc($arLabel . ' ' . $ar['tahun']); ?>" onerror="this.onerror=null;this.style.display='none';">
										<?php } ?>
									</figure>
									<div class="list-annual__item--text">
										<h6><?php echo esc($arLabel); ?> <?php echo esc($ar['tahun']); ?></h6>
										<span class="button button-link button-icon">
											<?php echo $teksUnduh; ?> <i class="button-icon__right"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 3v11m0 0-4-4m4 4 4-4M4 20h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></i>
										</span>
									</div>
								</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
</div>
</section>

<style>
	/* ==================================================================
	   Halaman Regulasi — replika gaya halaman tata-kelola pelindotpk.co.id
	   (font Manrope, akordeon berjudul huruf kapital dengan garis bawah dan
	   chevron, daftar dokumen berlatar #f3faff). Nilai ukuran, warna, dan
	   spasi diambil dari stylesheet situs tersebut.
	   ================================================================== */
	.main-content {
		--c-neutral-black: #4C4C4C;
		--c-neutral-white: #fff;
		--c-primary-main: #0475BC;
		--c-primary-hover: #3CB4E5;
		--c-primary-pressed: #1c5f90;

		padding: 40px 0 60px;
		color: var(--c-neutral-black);
		font-family: "Manrope", sans-serif;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.6;
	}
	.main-content h1, .main-content h2, .main-content h3,
	.main-content h4, .main-content h5, .main-content h6 {
		color: #000;
		font-family: "Manrope", sans-serif;
		font-weight: 400;
	}
	.main-content p {
		margin: 0 0 15px;
		line-height: 1.6;
		text-align: justify;
	}
	.main-content a {
		color: var(--c-primary-main);
		text-decoration: none;
	}
	.wrapper-content {
		margin: 0 auto;
		max-width: 990px;
		padding: 0;
		position: relative;
		width: 100%;
	}

	/* Teks pembuka */
	.section-textintro {
		margin-bottom: 45px;
	}
	.section-textintro h5,
	.section-textintro .title {
		font-size: 1.75rem;
		line-height: 1.5;
		text-transform: uppercase;
		font-weight: 400;
		margin: 0 0 16px;
	}
	/* Blok "Persyaratan" di konten CMS: daftarnya ditulis sebagai tabel dua
	   sel .td50 berdampingan. Ditumpuk jadi satu kolom (sel kedua langsung
	   menyambung di bawah sel pertama). Sel gambar di kirinya (.td60) tidak
	   ikut disentuh, dan HTML di database tidak diubah. */
	.section-textintro td.td50 {
		display: block;
		width: 100% !important;
	}
	.section-textintro td.td50 + td.td50 {
		padding-top: 0;
	}

	/* Prinsip GCG: daftar vertikal ber-ikon (list-icon-text.smaller referensi) */
	.list-icon-text {
		display: flex;
		flex-direction: column;
		gap: 24px;
		margin: 24px 0 32px;
	}
	.list-icon-text__item {
		display: flex;
		align-items: center;
		gap: 24px 0;
	}
	.list-icon-text__item figure {
		display: flex;
		flex: 0 0 90px;
		width: 90px;
		height: 90px;
		margin: 0;
		border-radius: 14px;
		border: 1px solid rgba(4, 117, 188, .15);
		background: #fff;
	}
	.list-icon-text__item figure img {
		display: block;
		width: 44px;
		height: 44px;
		margin: auto;
	}
	.list-icon-text__item--content {
		width: calc(100% - 90px);
		padding-left: 24px;
	}
	.list-icon-text__item--content h6 {
		font-size: 1.313rem;
		font-weight: 700;
		line-height: 1.4;
		margin: 0 0 10px;
		color: var(--c-neutral-black);
	}
	.list-icon-text__item--content p {
		margin: 0;
		text-align: left;
	}
	.list-icon-text__item--content .themeblue {
		color: inherit;
	}

	/* Akordeon */
	.box-accordion {
		margin-top: 38px;
	}
	.box-accordion .accordion {
		padding: 0;
		margin: 0 0 60px;
		border-bottom: none;
	}
	.box-accordion .accordion:last-child {
		margin-bottom: 0;
	}
	.box-accordion .accordion__head {
		display: block;
		position: relative;
		padding: 0 64px 32px 0;
		border-bottom: 1px solid #E3E3E3;
		color: #000;
		font-size: 1.75rem;
		font-style: normal;
		font-weight: 400;
		line-height: 160%;
		text-transform: uppercase;
		cursor: pointer;
		user-select: none;
	}
	.box-accordion .accordion__head:after {
		content: "";
		position: absolute;
		top: 8px;
		right: 0;
		width: 32px;
		height: 32px;
		background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32' fill='none'%3E%3Cpath d='M15.9996 21.5996L5.59961 10.3996' stroke='%234C4C4C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M16 21.5996L26.4 10.3996' stroke='%234C4C4C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat center;
	}
	.box-accordion .accordion.active .accordion__head:after {
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32' fill='none'%3E%3Cpath d='M15.9996 10.4004L5.59961 21.6004' stroke='%234C4C4C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M16 10.4004L26.4 21.6004' stroke='%234C4C4C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
	}
	.box-accordion .accordion__content {
		display: none;
		padding-top: 32px;
		color: var(--c-neutral-black);
	}
	.box-accordion .accordion.active .accordion__content {
		display: block;
	}
	.box-accordion .accordion__content h6 {
		font-size: 1rem;
	}

	/* Daftar dokumen */
	.list-document {
		display: flex;
		flex-direction: column;
		gap: 20px;
		margin-bottom: 60px;
	}
	.list-document__item {
		display: flex;
		align-items: center;
		gap: 0;
		border-radius: 8px;
		background: #f3faff;
		padding: 24px 32px;
		transition: background .3s ease-out;
	}
	.list-document__item:hover {
		background: #f3faff;
	}
	.list-document__item figure {
		width: 31px;
		flex: 0 0 31px;
		margin: 0;
	}
	.list-document__item figure img {
		display: block;
		width: 31px;
		height: auto;
	}
	.list-document__item--text {
		width: calc(100% - 131px);
		line-height: 1;
		padding: 0 20px;
	}
	.list-document__item--text h6 {
		font-size: 1.313rem;
		line-height: 1.3;
		margin: 0 0 4px;
		color: #4c4c4c;
		font-weight: 700;
	}
	.list-document__item--text span {
		font-size: .813rem;
		color: var(--c-neutral-black);
		opacity: .5;
	}

	/* Tombol (varian .button-link .button-icon) */
	.main-content .button {
		display: inline-block;
		height: 42px;
		line-height: 36px;
		padding: 0 36px;
		border: 0;
		border-radius: 100px;
		background: linear-gradient(104deg, #eb9433 49.57%, #b6670f 120.83%);
		color: var(--c-neutral-white);
		font-size: .813rem;
		font-weight: 700;
		text-align: center;
		text-decoration: none;
		white-space: nowrap;
		box-sizing: border-box;
		cursor: pointer;
		transition: all .3s ease-out;
	}
	.main-content .button.button-link {
		background: transparent;
		border-color: transparent;
		color: var(--c-primary-main);
	}
	.main-content .button-icon {
		position: relative;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		padding: 0 20px;
	}
	.main-content .button-icon i {
		position: relative;
		display: inline-flex;
		font-size: 1.125rem;
		line-height: 1;
		margin-left: 8px;
		transition: all .3s ease-out;
	}
	.main-content .button-icon i svg {
		width: 1em;
		height: 1em;
	}
	.list-document__item .button {
		margin-left: auto;
		padding: 0;
		max-width: 100px;
	}
	.list-document__item:hover .button,
	.list-annual__item:hover .button {
		color: var(--c-primary-hover);
	}
	.list-document__item:hover .button i,
	.list-annual__item:hover .button i {
		margin-left: 8px;
		transform: translateX(4px);
	}

	/* Laporan tahunan: kartu bersampul, mengikuti idiom kartu situs referensi
	   (radius 16px, bayangan biru muda #d1ecf8) */
	.list-annual {
		display: grid;
		grid-template-columns: repeat(4, minmax(0, 1fr));
		gap: 24px;
	}
	.list-annual__item {
		display: flex;
		flex-direction: column;
		overflow: hidden;
		border-radius: 16px;
		background: var(--c-neutral-white);
		box-shadow: 0 8px 24px #d1ecf8;
		transition: transform .3s ease-out, box-shadow .3s ease-out;
	}
	.list-annual__item:hover {
		transform: translateY(-4px);
		box-shadow: 0 12px 28px #b9e1f2;
	}
	.list-annual__item figure {
		position: relative;
		margin: 0;
		width: 100%;
		padding-top: 133%;
		background: #f3faff;
		overflow: hidden;
	}
	.list-annual__item figure img {
		position: absolute;
		inset: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
		object-position: center top;
	}
	.list-annual__item--text {
		padding: 16px 20px 12px;
		line-height: 1;
	}
	.list-annual__item--text h6 {
		font-size: 1rem;
		line-height: 1.3;
		margin: 0 0 6px;
		color: #4c4c4c;
		font-weight: 700;
	}
	.list-annual__item .button {
		padding: 0;
		height: auto;
		line-height: 1.6;
	}

	@media all and (max-width: 1200px) {
		.wrapper-content {
			width: auto;
			margin-left: 40px;
			margin-right: 40px;
		}
		.box-accordion .accordion {
			margin-bottom: 40px;
		}
		.box-accordion .accordion__head {
			font-size: 1.5rem;
		}
		.box-accordion .accordion__head:after {
			top: 1px;
		}
		.list-document__item--text h6 {
			font-size: 1rem;
		}
		.section-textintro h5,
		.section-textintro .title {
			font-size: 1.375rem;
		}
		.list-annual {
			grid-template-columns: repeat(3, minmax(0, 1fr));
		}
	}

	@media all and (max-width: 1023px) {
		.main-content {
			font-size: .875rem;
		}
	}

	@media all and (max-width: 767px) {
		.main-content {
			padding: 32px 0 48px;
		}
		.wrapper-content {
			margin-left: 16px;
			margin-right: 16px;
		}
		.section-textintro h5,
		.section-textintro .title {
			font-size: 1.125rem;
		}
		.box-accordion .accordion {
			margin-bottom: 24px;
		}
		.box-accordion .accordion__head {
			font-size: 18px;
			line-height: normal;
			padding-bottom: 24px;
		}
		.box-accordion .accordion__head:after {
			width: 24px;
			height: 24px;
			background-size: 24px !important;
		}
		.list-document__item {
			flex-flow: row wrap;
			text-align: left;
			padding: 16px;
			gap: 0;
			border-radius: 0;
		}
		.list-document__item--text {
			width: calc(100% - 31px);
			padding: 0 0 0 20px;
		}
		.list-document__item .button {
			width: auto;
			text-align: left;
			margin: 16px 0 0;
		}
		.list-annual {
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 16px;
		}
		.list-icon-text {
			gap: 24px;
			margin: 32px 0;
		}
		.list-icon-text__item {
			align-items: flex-start;
		}
		.list-icon-text__item figure {
			flex-basis: 56px;
			width: 56px;
			height: 56px;
			border-radius: 8px;
		}
		.list-icon-text__item figure img {
			width: 28px;
			height: 28px;
		}
		.list-icon-text__item--content {
			width: calc(100% - 56px);
			padding-left: 16px;
		}
		.list-icon-text__item--content h6 {
			font-size: 16px;
		}
	}
</style>

<script>
	// Akordeon: klik judul membuka/menutup isinya (tiap seksi berdiri sendiri).
	(function () {
		var heads = document.querySelectorAll('.box-accordion .accordion__head');

		function toggle(head) {
			var item   = head.parentNode;
			var active = item.classList.toggle('active');
			head.setAttribute('aria-expanded', active ? 'true' : 'false');
		}

		Array.prototype.forEach.call(heads, function (head) {
			head.addEventListener('click', function (e) {
				e.preventDefault();
				toggle(head);
			});
			head.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					toggle(head);
				}
			});
		});
	})();
</script>
