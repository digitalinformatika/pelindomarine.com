<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
?>

<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/career-bgheader.jpg);">
	<div class="container">
	    <?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -140px;">
				<h2 class="h2-mobpos">Jadilah bagian dari pusat layanan kemaritiman yang berkompetensi.</h2>
				<a href="" class="btnorg">Gabung sekarang</a>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Tentang Kami / <b><a href="company/careers" class="text-light">Karir</a></b></div>
			</div>
		</div>
		<?php } else { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: -100px;">
				<h2 class="h2-mobpos">Join our force and demonstrate your innovation.</h2>
				<a href="" class="btnorg">Work With Us</a>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Company / <b><a href="company/careers" class="text-light">Careers</a></b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock">
<div class="container animate-box" style="background: #fff; margin-top: -80px;">
	<div class="row">
			<div class="col-md-12 mt-5">
			    <?php if ($weblangs=='indonesia') { ?>
				<div class="biry24 fbold themegrey">Karir</div>
				<h4 class="themeblue biry72" style="margin-bottom: 10px;"><b>Berkarir Bersama Kami</b></h4>
				<p class="biry24" style="width: 50%;">
					Kami memiliki peluang tak terbatas bagi para tenaga kerja berintegritas untuk mendedikasikan keahliannya. Scroll untuk informasi lebih lanjut.
				</p>
				<?php } else { ?>
				<div class="biry24 fbold themegrey">Careers</div>
				<h4 class="themeblue biry72" style="margin-bottom: 10px;"><b>OPPORTUNITIES</b></h4>
				<p class="biry24" style="width: 50%;">
					We're always looking for dedicated problem solvers who are ready to apply their expertise in a place with limitless opportunities.
				</p>
				<?php } ?>
			</div>
			
			<div class="col-md-12 mt-5">
				<div class="row tdpadding">
					<?php
						$cnt = 0;
						foreach ($companyjobs as $j) {
							if ($j['STATUS']<>1) {
							$cnt++;
					?>
					<div class="col-md-4">
						<div class="jobitem" style="min-height: 330px;">
							<div class="themeblue biry32 mb-2" style="height: 220px;">
								<span style="line-height: 35px !important;"><b><?php echo htmlspecialchars_decode($j['NAMA'], ENT_QUOTES); ?></b></span>
							</div>
							<div class="mt-5">
								<div class="row">
									<div class="col-md-8 col-8">
										<div class="biry24 themeorg fbold" style="margin-top: 5px;">See Details</div>
									</div>
									<div class="col-md-4 col-4 text-right">
										<a onClick="openPopup('#wrap_popup<?php echo $cnt; ?>')" class="linkdownload" id="next">
										<span class="arrow"><img src="images/arrow_career.png" alt="" width="32" style="margin-right: 30px;"></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php }} ?>
					<?php if ($cnt==0) echo 'Sorry, currently no job information available.'; ?>
					
					<?php
						$cnt = 0;
						foreach ($companyjobs as $c) {
							if ($c['STATUS']<>1) {
							$cnt++;
					?>
					<div id="wrap_popup<?php echo $cnt; ?>" class="wrap_popup">
						<div class="popup">
							<div class="title">
								Careers Opportunity
								<span class="float-right text-right">
									<a onClick="closePopup('#wrap_popup<?php echo $cnt; ?>');" style="cursor: pointer;"><img src="images/iclose.png" width="18"></a>
								</span>
							</div>
							<div class="box-popup">
								<h4><?php echo htmlspecialchars_decode($c['NAMA'], ENT_QUOTES); ?></h4>
								<p><?php echo htmlspecialchars_decode($c['KETERANGAN'], ENT_QUOTES); ?></p>
								<?php if (!empty(trim($c['DOWNLOAD']))) { ?>
								<p>
									<img src="upload/<?php echo $c['DOWNLOAD']; ?>" class="img-fluid">
								</p>
								<?php } ?>
								
								<br><br>
								<center><a onClick="closePopup('#wrap_popup<?php echo $cnt; ?>');" class="btnorgout btneye" style="cursor: pointer;">Close</a></center>
							</div>
						</div>
					</div>
					<?php }} ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="show-more">
					<!--[if lt IE 7]<a href="" class="biry24 themegrey"><b>Show More</b></a> -->
				</div>
			</div>
			
			<div class="col-md-6">
				<img src="upload/career-img.jpg" alt="" class="img-fluid">
			</div>
			<div class="col-md-6 align-self-center">
			    <?php if ($weblangs=='indonesia') { ?>
				<p class="biry24 pb-4 pt-3">Terkait maraknya penipuan rekrutmen yang mengatasnamakan PT Pelindo Marine Service, kami menghimbau kepada calon kandidat untuk hanya merujuk pada halaman ini untuk informasi mengenai ketersediaan peluang kerja.</p>
				<?php if ($cnt>=1) { ?><a href="" class="btnorg">Bergabung</a><?php } ?><br><br>
				<?php } else { ?>
				<p class="biry24 pb-4 pt-3">We are aware of a cyber-scam involving suspicious recruiting-related contacts targeting prospective candidates. Please only refer to this page for job opportunities availability.</p>
				<?php if ($cnt>=1) { ?><a href="" class="btnorg">Join Us</a><?php } ?><br><br>
				<?php } ?>
			</div>
	</div>
</div>
</section>
