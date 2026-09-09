<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
	$isIndo = ($weblangs == 'indonesia');
?>
<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/regulatory-bgheader.jpg);">
	<div class="container">
		<?php if ($weblangs=='english') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -50px;">
				<h5>Company</h5>
				<h2>REGULATORY FRAMEWORKS</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Company / <b><a href="company/regulatory" class="text-light">Regulatory Frameworks</a></b></div>
			</div>
		</div>
		<?php } ?>
		<?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -50px;">
				<h5>Tentang Kami</h5>
				<h2>REGULASI LAYANAN</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Tentang Kami / <b><a href="company/regulatory" class="text-light">Regulasi Layanan</a></b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock">
<div class="container animate-box" style="background: #fff; margin-top: -80px;">
	<div class="row tdpadding">
		<?php if ($weblangs=='english') { ?>
		<?php
			foreach ($companydata as $c) {
				if ($c['TITLE']=='Regulatory Frameworks') echo $c['DESCRIPTION'];
			}
		?>
		<?php } ?>
		<?php if ($weblangs=='indonesia') { ?>
		<?php
			foreach ($companydata as $c) {
				if ($c['TITLE']=='Regulatory Frameworks') echo $c['KETERANGAN'];
			}
		?>
		<?php } ?>

		<!-- Dokumen regulasi (dikelola dari CMS: Perusahaan > Regulasi) -->
		<div class="col-md-12 mt-5">
			<div class="row">
				<?php
					$cnt=0;
					foreach (($companydocs ?? []) as $cd) {
						$cnt++;
						$docTitle = $isIndo
							? $cd['judul']
							: (!empty($cd['title']) ? $cd['title'] : $cd['judul']);
						$docLink  = !empty($cd['file']) ? cms_media_url($cd['file']) : ($cd['url'] ?? '#');
				?>
				<div class="col-md-4">
					<div class="themeblue titledownload">
						<b><?php echo esc($docTitle); ?></b>
					</div>
					<div class="mt-4">
						<a href="<?php echo esc($docLink); ?>" target="_blank" class="linkdownload"><img src="upload/Icon5_Regulatory_Download.png" alt="" style="padding-right: 15px;" width="32"> <?php echo $isIndo ? 'Unduh' : 'Download'; ?></a>
					</div>
				</div>
				<?php if ($cnt=="3") { $cnt = 0; ?><div class="col-md-12"><hr class="mt-5 mb-5"></div><?php } ?>
				<?php } ?>
			</div>
		</div>

		<!-- Annual report (dikelola dari CMS: Perusahaan > Regulasi > Annual Report) -->
		<?php if (!empty($annualreports)) { ?>
		<div class="col-md-12"><hr class="mt-5 mb-5"></div>
		<div class="col-md-12 mt-5 mb-5">
			<div class="row">
				<?php foreach ($annualreports as $ar) {
					$arLabel = $isIndo
						? (!empty($ar['judul']) ? $ar['judul'] : 'Laporan Tahunan')
						: (!empty($ar['title']) ? $ar['title'] : 'Annual Report');
					$arCover = cms_media_url($ar['cover'] ?? null, 'upload');
					$arLink  = !empty($ar['file']) ? cms_media_url($ar['file']) : ($ar['url'] ?? '#');
				?>
				<div class="col-md-2 col-sm-4 col-xs-6 pms-annual-col">
					<div class="pms-annual-card">
						<div class="annultitle">
							<div class="biry24 text-light">
								<?php echo esc($arLabel); ?>
							</div>
							<h3 class="biry48 text-light"><?php echo esc($ar['tahun']); ?></h3>
						</div>
						<div class="pms-annual-cover">
							<?php if ($arCover) { ?>
							<img src="<?php echo esc($arCover); ?>" alt="<?php echo esc($arLabel . ' ' . $ar['tahun']); ?>" title="">
							<?php } ?>
							<div class="pms-annual-download">
								<a href="<?php echo esc($arLink); ?>" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> <?php echo $isIndo ? 'Unduh' : 'Download'; ?></a>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
</section>

<style>
	/* Kartu annual report: semua cover memakai rasio sama agar tinggi kartu seragam */
	.pms-annual-col {
		margin-bottom: 30px;
	}
	.pms-annual-card {
		display: flex;
		flex-direction: column;
		height: 100%;
		overflow: hidden;
		border-radius: 6px;
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
	}
	.pms-annual-card .annultitle {
		min-height: 120px;
	}
	.pms-annual-card .annultitle h3 {
		margin: 0;
	}
	.pms-annual-cover {
		position: relative;
		width: 100%;
		padding-top: 100%; /* rasio 1:1 */
		background: #e9eef5;
		overflow: hidden;
	}
	.pms-annual-cover > img {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
		object-position: center top;
	}
	.pms-annual-download .btnorg img {
		position: static;
		width: 15px;
		height: auto;
		display: inline;
		vertical-align: middle;
	}
	.pms-annual-download {
		position: absolute;
		left: 0;
		right: 0;
		bottom: 0;
		padding: 0 0 18px 18px;
		background: linear-gradient(to top, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0));
		padding-top: 40px;
	}
	.pms-annual-download .btnorg {
		display: inline-block;
	}
</style>
