<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
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
		
		<div class="col-md-12 mt-5">
			<div class="row">
				<?php
					$cnt=0;
					foreach ($companydocs as $cd) {
						$cnt++;
				?>
				<div class="col-md-4">
					<div class="themeblue titledownload">
						<b><?php echo $cd['judul']; ?></b>
					</div>
					<div class="mt-4">
						<a href="<?php echo $cd['docfile']; ?>" target="_blank" class="linkdownload"><img src="upload/Icon5_Regulatory_Download.png" alt="" style="padding-right: 15px;" width="32"> Download</a>
					</div>
				</div>
				<?php if ($cnt=="3") { $cnt = 0; ?><div class="col-md-12"><hr class="mt-5 mb-5"></div><?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="col-md-12"><hr class="mt-5 mb-5"></div>
		<div class="col-md-12 mt-5 mb-5">
			<div class="row">
				<div class="col-md-2">
					<div class="annultitle">
						<div class="biry24 text-light">
							Annual Report
						</div>
						<h3 class="biry48 text-light">2018</h3>
					</div>
					<img src="upload/annualreport2018.jpg" alt="" title="" class="img-fluid">
					<div class="annualdownload">
						<a href="https://drive.google.com/file/d/1QjBndLE_f8Sw5IyCOWFUv1BYxuOBmJz-/view" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> Download</a>
						<!--button class="btnorg btneye" style="border-color:#ff8600"><img src="images/idownload.png" width="15"> Download</button-->
					</div>
				</div>
				<div class="col-md-2">
					<div class="annultitle">
						<div class="biry24 text-light">
							Annual Report
						</div>
						<h3 class="biry48 text-light">2019</h3>
					</div>
					<img src="upload/annualreport2019.jpg" alt="" title="" class="img-fluid">
					<div class="annualdownload">
						<a href="https://drive.google.com/file/d/14I3rTITmfsTdQXfBNNDON8Kjct9Mvc9-/view" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> Download</a>
						<!--button class="btnorg btneye" style="border-color:#ff8600"><img src="images/idownload.png" width="15"> Download</button-->
					</div>
				</div>
				<div class="col-md-2">
					<div class="annultitle">
						<div class="biry24 text-light">
							Annual Report
						</div>
						<h3 class="biry48 text-light">2020</h3>
					</div>
					<img src="upload/annualreport2020.jpg" alt="" title="" class="img-fluid">
					<div class="annualdownload">
						<a href="https://drive.google.com/file/d/1NpGTbCkK_VPuPqayA-rBQxJv46cFAk1C/view" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> Download</a>
						<!-- button class="btnorg btneye" style="border-color:#ff8600"><img src="images/idownload.png" width="15"> Download</button-->
					</div>
				</div>
				<div class="col-md-2">
					<div class="annultitle">
						<div class="biry24 text-light">
							Annual Report
						</div>
						<h3 class="biry48 text-light">2021</h3>
					</div>
					<img src="upload/annualreport2021.png" alt="" title="" class="img-fluid">
					<div class="annualdownload">
						<a href="https://drive.google.com/file/d/1KGWRavbu-iCRRI1XVvTv9g5LQHmngHoO/view" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> Download</a>
                        <!-- button class="btnorg btneye" style="border-color:#ff8600"><img src="images/idownload.png" width="15"> Download</button-->
					</div>
				</div>
				<div class="col-md-2">
					<div class="annultitle">
						<div class="biry24 text-light">
							Annual Report
						</div>
						<h3 class="biry48 text-light">2022</h3>
					</div>
					<img src="upload/annualreport2022.png" alt="" title="" class="img-fluid">
					<div class="annualdownload">
						<a href="https://drive.google.com/file/d/1-Lnat1Nk7h5kO1nHm1nTdcC7KVxtBAaA/view" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> Download</a>
					</div>
				</div>
				<div class="col-md-2">
					<div class="annultitle">
						<div class="biry24 text-light">
							Annual Report
						</div>
						<h3 class="biry48 text-light">2023</h3>
					</div>
					<img src="upload/annualreport2023.png" alt="" title="" class="img-fluid">
					<div class="annualdownload">
						<a href="https://drive.google.com/file/d/1TbrVsB-75h44H1byVItjdXiLTIcWjdWk/view" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> Download</a>
					</div>
				</div>
				<div class="col-md-2">
					<div class="annultitle">
						<div class="biry24 text-light">
							Annual Report
						</div>
						<h3 class="biry48 text-light">2024</h3>
					</div>
					<img src="upload/annualreport2024.png" alt="" title="" class="img-fluid">
					<div class="annualdownload">
						<a href="https://drive.google.com/file/d/1xMTJePkpCJS_5TNsc21iIgEvXZh6RS21/view" target="_blank" class="btnorg btneye"><img src="images/idownload.png" width="15"> Download</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>