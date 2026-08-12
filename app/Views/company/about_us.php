<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
?>
<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/about-bgheader.jpg);">
	<div class="container">
	    <?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5>Tentang Kami</h5>
				<h2>PROFIL</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Tentang Kami / <b><a href="company/about-us" class="text-light">Profil</a></b></div>
			</div>
		</div>
		<?php } else {?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5>Company</h5>
				<h2>ABOUT US</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Company / <b><a href="company/about-us" class="text-light">About Us</a></b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock">
<div class="container animate-box" style="background: #fff; margin-top: -80px;">
	<div class="row nopadding">
	    <?php if ($weblangs=='indonesia') { ?>
		<?php
			foreach ($companydata as $c) {
				if ($c['TITLE']=='About Us') echo $c['KETERANGAN'];
			}
		?>
		<?php } else {?>
		<?php
			foreach ($companydata as $c) {
				if ($c['TITLE']=='About Us') echo $c['DESCRIPTION'];
			}
		?>
		<?php } ?>
	</div>
</div>
</section>