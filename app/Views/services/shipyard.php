<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
?>
<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/graving-bgheader.jpg);">
	<div class="container">
		<?php if ($weblangs=='english') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -50px;">
				<h5>Services</h5>
				<h2 style="margin-bottom: 10px;">GRAVING DOCKS</h2>
				<p style="width: 80%; color: #fff; line-height: 16px;">We strategically placed graving docks in key
					locations in the middle region of Indonesia with a
					wide range of services, including tug assist,
					logistics, and port utility services
				</p>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Services / <b>Graving Docks</b></div>
			</div>
		</div>
		<?php } ?>
		<?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-7 col-xs-12" style="margin-top: -80px;">
				<h5>Layanan Kami</h5>
				<h2 style="margin-bottom: 10px;">Fasilitas Pemeliharaan & Perbaikan Kapal</h2>
				<p style="width: 80%; color: #fff; line-height: 16px;">Kami menempatkan galangan kapal secara strategis di wilayah strategis tengah Indonesia dengan berbagai layanan, termasuk tug assist, logistik, dan layanan utilitas pelabuhan
				</p>
			</div>
			<div class="col-md-5 col-xs-12 text-right">
				<div class="breadcumbs">Home / Layanan Kami / <b>Galangan Kapal</b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #204280; margin-top: -80px;">
		<div class="container pb-5">
			<div class="row">
				<div class="col-md-12">
					<img src="upload/shipyard_surabaya.png" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
	
	<div class="container animate-box">
		<div class="row">
			<div class="col-md-12">
				<img src="upload/shipyard_semarang.png" alt="" class="img-fluid">
			</div>
		</div>
	</div>
</section>