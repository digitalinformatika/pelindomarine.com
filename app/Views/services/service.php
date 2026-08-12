<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
?>
<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/service-bgheader.jpg);">
	<div class="container">
		<?php if ($weblangs=='english') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -50px;">
				<h5>Services</h5>
				<h2>SERVICE AND COMPLAINTS FLOW</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Services / <b><a href="services/vessel" class="text-light">Service and Complaints Flow</a></b></div>
			</div>
		</div>
		<?php } ?>
		<?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -50px;">
				<h5>Layanan Kami</h5>
				<h2>ALUR LAYANAN &amp; PENGADUAN</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Layanan Kami / <b><a href="services/vessel" class="text-light">Alur Layanan &amp; Pengaduan</a></b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #204280; margin-top: -80px;">
		<div class="container pb-5">
			<div class="row">
				<div class="col-md-12 mt-5">
					<?php if ($weblangs=='english') { ?><span class="biry36 fbold text-light">Service Offer</span><?php } ?>
					<?php if ($weblangs=='indonesia') { ?><span class="biry36 fbold text-light">Alur Layanan</span><?php } ?>
				</div>
				<div class="col-md-12">
					<img src="upload/service-offer.jpg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
	
	<div class="container animate-box">
		<div class="row">
			<div class="col-md-12 mt-5">
				<?php if ($weblangs=='english') { ?><span class="biry36 fbold themeblue">Complaints <br>Handling Procedure</span><?php } ?>
				<?php if ($weblangs=='indonesia') { ?><span class="biry36 fbold themeblue">Prosedur<br>Penanganan Pengaduan</span><?php } ?>
			</div>
			<div class="col-md-12">
				<img src="upload/handling.jpg" alt="" class="img-fluid">
			</div>
		</div>
	</div>
</section>