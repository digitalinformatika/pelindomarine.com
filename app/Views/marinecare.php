<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
?>
<section id="pms-inner-header-care" style="background-image: url(<?php echo base_url('/'); ?>upload/care-bgheader.jpg);">
	<div class="container">
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12" style="margin-top: 70px;">
				<h2 style="margin-bottom: 30px;">Marine Care</h2>
				<?php if ($weblangs=='english') { ?>
				<p style="width: 75%; color: #fff; line-height: 18px; font-size: 16px;">
					Service desk for an easy access to integrated maritime services ranging from correspondence, administration, procurement, commerce, to report.
				<?php } ?>
				<?php if ($weblangs=='indonesia') { ?>
				<p style="width: 60%; color: #fff; line-height: 16px;">Pelayanan online untuk kemudahan akses layanan maritim terintegrasi mulai dari korespondensi, administrasi, pengadaan, niaga, hingga pelaporan.
				<?php } ?>
				</p>
			</div>
			<div class="col-md-6 col-xs-12 text-right" style="padding-top: 90px;">
				<div class="breadcumbs">Home / <b>Marine Care</b></div>
			</div>
		</div>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #204280 url('upload/care-bg247.jpg') top center; margin-top: -80px; background-size: cover;">
		<div class="container pb-5">
			<div class="row">
				<?php if ($weblangs=='english') { ?>
				<div class="col-md-6 care-padd mt-2">
					<div class="biry60 themeblue fbolds">MARINE CARE <!--span class="themeorg">24/7</span--></div>
					<div style="font-weight: 400; width: 90%;" class="robo24 mt-5 themeblue">
						We Provide Integrated Marine Services. Contact Us for More!
					</div>
					<div class="mt-5 mb-2">
                    <a href="https://api.whatsapp.com/send/?phone=%2B6281133304181&text&type=phone_number&app_absent=0" class='btnorgout btneye2 themeblue' style='cursor:pointer;' target="_blank">Contact Us</a>
                    <!--
						<script type="text/javascript" src='https://mylivechat.com/chatapi.aspx?hccid=88917783'></script>
						<script type="text/javascript">
						if(typeof("MyLiveChat")!="undefined"){
							document.write("<a onclick='MyLiveChat_OpenDialog"+"()' class='btnorgout btneye2 themeblue' style='cursor:pointer;'>")
							if(MyLiveChat.HasReadyAgents)
								document.write('We are online!')
							else
								document.write('We are offline!')
							document.write("</a>");
						}
						</script>
					-->
                    </div>
				</div>
				<div class="col-md-6 themeblue pt-5">
					<div style="font-weight: 400;" class="robo24">
						<div class="row">
							<div class="col-md-4">
								Whatsapp<br>
								<b>+62 811 3330 4181</b>
							</div>
							<div class="col-md-4">
								Phone<br>
								<b>+62 31 9921 0400</b>
							</div>
							<div class="col-md-4">
								Email<br>
								<b>info@pelindomarines.com</b>
							</div>
						</div>
						<!--div class="row mt-5">
							<div class="col-md-4">
								<h6 class="fbolds themeorg mb-2">Marine Operations</h6>
								Anang Wahyudi<br>
								<b>+62 821 4219 9980</b>
							</div>
							<div class="col-md-4">
								<h6 class="fbolds themeorg mb-2">Marine Service</h6>
								Ery Ferriati<br>
								<b>+62 31 9921 0400</b>
							</div>
							<div class="col-md-4">
								&nbsp;
							</div>
						</div>
						<div class="row mt-5 mb-5">
							<div class="col-md-4 mt-2">
								<div class="care-icons pb-2">
									<img src="upload/care-icon1.png" alt="PT Alur Pelayaran Barat Surabaya" height="50" />
								</div>
								<h6 class="fbolds themeorg mb-2">Shipping Access Channel</h6>
					      Mahde Kumar<br>
								<b>+62 812 3264 474</b></div>
							<div class="col-md-4 mt-2">
								<div class="care-icons pb-2">
									<img src="upload/care-icon2.png" alt="Pelindo Energi Logistik"  height="50" />
								</div>
								<h6 class="fbolds themeorg mb-2">Energy Logistics</h6>
								Surya Yuwardana<br>
								<b>+62 812 3456 7360</b></div>
							<div class="col-md-4 mt-2">
								<div class="care-icons pb-2">
									<img src="upload/care-icon3.png" alt="BMC Logistik" height="50" />
								</div>
								<h6 class="fbolds themeorg mb-2">Multimodal Transport</h6>
								Dhanu Kurnia Ismail<br>
								<b>+62 821 4002 3214</b>
							</div>
						</div-->
					</div>
				</div>
				<?php } ?>
				<?php if ($weblangs=='indonesia') { ?>
				<div class="col-md-6 care-padd">
					<div class="biry60 themeblue fbolds mt-2">MARINE CARE <!--span class="themeorg">24/7</span--></div>
					<div style="font-weight: 400;" class="robo24 mt-5 themeblue">
						Kami menyediakan layanan kelautan terpadu. Hubungi kami untuk informasi lebih lanjut!
					</div>
					<div class="mt-5 mb-2">
                    	<a href="https://api.whatsapp.com/send/?phone=%2B6281133304181&text&type=phone_number&app_absent=0" class='btnorgout btneye2 themeblue' style='cursor:pointer;' target="_blank">Hubungi Kami</a>
                        <!--
						<script type="text/javascript" src='https://mylivechat.com/chatapi.aspx?hccid=88917783'></script>
						<script type="text/javascript">
						if(typeof("MyLiveChat")!="undefined"){
							document.write("<a onclick='MyLiveChat_OpenDialog"+"()' class='btnorgout btneye2 themeblue' style='cursor:pointer;'>")
							if(MyLiveChat.HasReadyAgents)
								document.write('Kami online!')
							else
								document.write('Kami offline!')
							document.write("</a>");
						}
						</script>
                        -->
					</div>
				</div>
				<div class="col-md-6 themeblue">
					<div style="font-weight: 400; padding-top: 130px;" class="robo24">
						<div class="row">
							<div class="col-md-4">
								Whatsapp<br>
								<b>+62 811 3330 4181</b>
							</div>
							<div class="col-md-4">
								Telepon<br>
								<b>+62 31 9921 0400</b>
							</div>
							<div class="col-md-4">
								Email<br>
								<b>info@pelindomarines.com</b>
							</div>
						</div>
						<!--div class="row mt-5">
							<div class="col-md-4">
								<h6 class="fbolds themeorg mb-2">Marine Operations</h6>
								Anang Wahyudi<br>
								<b>+62 821 4219 9980</b>
							</div>
							<div class="col-md-4">
								<h6 class="fbolds themeorg mb-2">Marine Service</h6>
								Ery Ferriati<br>
								<b>+62 31 9921 0400</b>
							</div>
							<div class="col-md-4">
								&nbsp;
							</div>
						</div>
						<div class="row mt-5 mb-5">
							<div class="col-md-4">
								<div class="care-icons pb-2">
									<img src="upload/care-icon1.png" alt="PT Alur Pelayaran Barat Surabaya" height="50" />
								</div>
								<h6 class="fbolds themeorg mb-2">Shipping Access Channel</h6>
								<span class="col-md-4 mt-2">Mahde Kumar<br />
                                <b>+62 812 3264 474</b></span></div>
							<div class="col-md-4">
								<div class="care-icons pb-2">
									<img src="upload/care-icon2.png" alt="Pelindo Energi Logistik"  height="50" />
								</div>
								<h6 class="fbolds themeorg mb-2">Energy Logistics</h6>
								<span class="col-md-4 mt-2">Surya Yuwardana<br />
                                <b>+62 812 3456 7360</b></span></div>
							<div class="col-md-4">
								<div class="care-icons pb-2">
									<img src="upload/care-icon3.png" alt="BMC Logistik" height="50" />
								</div>
								<h6 class="fbolds themeorg mb-2">Trasportasi Multimodal</h6>
								Dhanu Kurnia Ismail<br>
								<b>+62 821 4002 3214</b>
							</div>
						</div-->
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #fff; margin-top: -80px;">
		<div class="">
			<div class="row">
				<div class="col-md-7 mb-5 order-2">
					<div class="container">
						<div class="row mt-5">
							<div class="col-md-10 offset-md-1">
								<?php if(!empty($status)){ ?>
								<div class="status alert alert-info" role="alert"><?php echo $status['msg']; ?></div>
								<?php } ?>
								<form action="" method="post" name="contactSubmit" class="boxform animate-box" enctype="multipart/form-data">
								<?php if ($weblangs=='english') { ?>
								<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required>
									</div>
									<div class="col-md-6">
										<select class="form-control" name="category">
											<option value="Question">Question</option>
											<option value="Suggestion">Suggestion</option>
											<option value="Complaint">Complaint</option>
										</select>
									</div>
									
									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required>
									</div>
									<div class="col-md-6">
										<input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required>
									</div>
									<div class="col-md-12">
										<input type="text" class="form-control" placeholder="Company" id="company" name="company">
									</div>
									<div class="col-md-12">
										<textarea class="form-control" placeholder="Message" id="message" name="message" required></textarea>
									</div>
									<div class="col-md-12 mt-3">
										<input type="submit" value="Send" name="contactSubmit" class="btn btn-primary">
									</div>
								</div>
								<?php } ?>
								<?php if ($weblangs=='indonesia') { ?>
								<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Nama" id="name" name="name" required>
									</div>
									<div class="col-md-6">
										<select class="form-control" name="category">
											<option value="Pertanyaan">Pertanyaan</option>
											<option value="Saran">Saran</option>
											<option value="Pengaduan">Pengaduan</option>
										</select>
									</div>
									
									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Subjek" id="subject" name="subject" required>
									</div>
									<div class="col-md-6">
										<input type="email" class="form-control" placeholder="Alamat Email" id="email" name="email" required>
									</div>
									<div class="col-md-12">
										<input type="text" class="form-control" placeholder="Nama Perusahaan" id="company" name="company">
									</div>
									<div class="col-md-12">
										<textarea class="form-control" placeholder="Pesan" id="message" name="message" required></textarea>
									</div>
									<div class="col-md-12 mt-3">
										<input type="submit" value="Kirim" name="contactSubmit" class="btn btn-primary">
									</div>
								</div>
								<?php } ?>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5 text-center nopadd pt-5 pb-5 order-1 order-sm-12" style="background: transparent url('upload/care-bgcontact.jpg') no-repeat top left; background-size: cover">
					<img src="upload/care-bgcontactcall.jpg" width="90">
					<?php if ($weblangs=='english') { ?>
					<div class="biry72 themeorg fbolds mt-5">Contact Us</div>
					<center><p style="font-weight: 400; color: #fff; width: 60%;">Should there be any questions or suggestions, please fill in the form below.</p></center>
					<?php } ?>
					<?php if ($weblangs=='indonesia') { ?>
					<div class="biry72 themeorg fbolds mt-5">Hubungi Kami</div>
					<center><p style="font-weight: 400; color: #fff; width: 60%;">Sampaikan pertanyaan atau saran Anda dengan mengisi formulir di bawah ini.</p></center>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>



<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #efefef url('upload/care-bgppid.jpg') top center; margin-top: -50px; background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-12 themeblue pb-5 paddmob" style="position: relative; z-index: 9;">
					<div class="biry60 fbolds mt-5">e-PPID</div>
					<div class="biry36">
						<?php if ($weblangs=='indonesia') { ?>Pejabat Pengelola Informasi &amp; Dokumentasi<?php } ?>
						<?php if ($weblangs=='english') { ?>Information Management & Documentation Officer<?php } ?>
					</div>
					<?php if ($weblangs=='english') { ?>
					<div style="width: 90%; font-weight: 400;" class="robo24 mt-4">
						Get assistance in obtaining information about Pelindo Marine
						Service through our information and documentation
						management system.
					</div>
					<div class="mt-5 mb-2">
						<a href="./ppid" class="btnorgout btneye2">Explore</a>
					</div>
					<?php } ?>
					<?php if ($weblangs=='indonesia') { ?>
					<div style="width: 90%; font-weight: 400;" class="robo24 mt-4">
						Dapatkan bantuan dalam memperoleh informasi tentang Pelindo Marine Service melalui sistem manajemen informasi dan dokumentasi kami.
					</div>
					<div class="mt-5 mb-2">
						<a href="./ppid" class="btnorgout btneye2">Jelajahi</a>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-7 col-12 nopadd">
					<img src="upload/ppid-photo.png" alt="" style="position: absolute; bottom: 0; margin-top: 10px;" class="img-fluid" >
				</div>
				
			</div>
		</div>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #204280 url('upload/Gambar5_MarineCare.jpg') top center; background-size: cover; margin-top: -50px;">
		<div class="container pb-5">
			<div class="row pb-5">
				<div class="col-md-6 care-padd">
					<div class="biry60 text-light fbolds mt-5">MARCOFEE</div>
					<div class="biry48 text-light mt-4">Marine Complaints &amp;<br> Feedback</div>
				</div>
				<div class="col-md-6 text-light">
					<?php if ($weblangs=='english') { ?>
					<div style="width: 70%; font-weight: 400; padding-top: 160px;" class="robo24">
						Should any concerns or suggestions emerge during the service period, please visit our customer service desk.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://marcofee.pelindomarines.com" class="btnorgout btneye" target="_blank">Visit</a>
					</div><?php } ?>
					<?php if ($weblangs=='indonesia') { ?>
					<div style="width: 70%; font-weight: 400; padding-top: 160px;" class="robo24">
						Berikan saran maupun laporkan keluhan yang Anda alami selama proses pelayanan kami melalui layanan pelanggan.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://marcofee.pelindomarines.com" class="btnorgout btneye" target="_blank">Kunjungi</a>
					</div><?php } ?>
				</div>
				
			</div>
		</div>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #efefef url('upload/Gambar4_MarineCare.jpg') top center; margin-top: -50px;">
		<div class="container pb-5">
			<div class="row">
				<div class="col-md-6 themeblue pb-5 order-2">
					<?php if ($weblangs=='english') { ?>
					<div style="width: 70%; font-weight: 400; padding-top: 130px;" class="robo24">
						Navigate to our invoice management system for easy invoice tracking and monitoring.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://inv.pelindomarines.com" class="btnorgout btneye2" target="_blank">Start Tracking</a>
					</div>
					<?php } ?>
					<?php if ($weblangs=='indonesia') { ?>
					<div style="width: 70%; font-weight: 400; padding-top: 130px;" class="robo24">
						Ketahui status invoice lebih mudah melalui sistem manajemen invoice online kami.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://inv.pelindomarines.com" class="btnorgout btneye2" target="_blank">Cek Invoice</a>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-6 care-padd order-1 order-sm-12">
					<div class="biry60 themeblue fbolds mt-5">MARIMON</div>
					<div class="biry48 themeblue mt-4">Marine Invoice Monitoring</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #204280 url('upload/Gambar3_MarineCare.jpg') top center; margin-top: -50px;">
		<div class="container pb-5">
			<div class="row pb-5">
				<?php if ($weblangs=='english') { ?>
				<div class="col-md-6 care-padd">
					<div class="biry60 text-light fbolds mt-5">e-COMMERCE</div>
				</div>
				<div class="col-md-6 text-light">
					<div style="font-weight: 400; padding-top: 130px;" class="robo24">
						Easy access to explore our integrated marine service options.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://ecommerce.pelindomarines.com" class="btnorgout btneye" target="_blank">Browse</a>
					</div>
				</div>
				<?php } ?>
				<?php if ($weblangs=='indonesia') { ?>
				<div class="col-md-6 care-padd">
					<div class="biry60 text-light fbolds mt-5">Marine e-Commerce</div>
				</div>
				<div class="col-md-6 text-light">
					<div style="font-weight: 400; padding-top: 130px;" class="robo24">
						Akses mudah untuk menjelajahi opsi layanan maritim terintegrasi.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://ecommerce.pelindomarines.com" class="btnorgout btneye" target="_blank">Telusuri</a>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #204280 url('upload/Gambar6_MarineCare.jpg') top center; margin-top: -50px;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 care-padd order-2">
					<img src="upload/care-procimg.png" alt="" style="position: absolute;" class="img-fluid paddship">
				</div>
				<div class="col-md-6 themeblue care-padd order-1 order-sm-12 paddmob2">
					<div class="biry60 themeblue fbolds">e-Proc</div>
					<?php if ($weblangs=='english') { ?>
					<div style="width: 70%; font-weight: 400;" class="robo24">
						Integrated system for marine goods and service procurement.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://eproc.pelindo.co.id/app/index/?reqPerusahaan=pms" class="btnorgout btneye2" target="_blank">e-Proc</a>
					</div><?php } ?>
					<?php if ($weblangs=='indonesia') { ?>
					<div style="width: 70%; font-weight: 400;" class="robo24">
						Layanan pengadaan barang dan jasa maritim yang terintegrasi.
					</div>
					<div class="mt-5 mb-2">
						<a href="https://eproc.pelindo.co.id/app/index/?reqPerusahaan=pms" class="btnorgout btneye2" target="_blank">e-Proc</a>
					</div><?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>



<section id="pms-innerblock">
	<div class="container-fluid animate-box" style="background: #fff; margin-top: -50px;">
		<div class="container">
			<div class="row pt-3 pb-3">
				<div class="col-md-6 care-padd themeblue order-2">
					<div class="biry60 themeblue fbolds">WHISTLEBLOWING SYSTEM</div>
					<?php if ($weblangs=='english') { ?>
					<div style="width: 90%; font-weight: 400; padding-top: 70px;" class="robo24 text-dark">
						We are committed to implementing our Good Corporate
						Governance in all situations. In case of irregularity or impropriety,
						please submit your inquiry here. We ensure confidentiality in
						every report.
					</div>
					<div class="mt-5 mb-2">
						<a href="mailto:lapor.gratifikasi@pelindomarine.com" class="btnorgout btneye2">Submit Report</a>
						<div class="small pt-2 text-dark">Please attach an <span class="fbold">identity card</span>, e.g. KTP</div>
					</div>
					<?php } ?>
					<?php if ($weblangs=='indonesia') { ?>
					<div style="width: 90%; font-weight: 400; padding-top: 70px;" class="robo24 text-dark">
						Kami berkomitmen untuk menerapkan Tata Kelola Perusahaan yang Baik dalam segala situasi. Kami menerima laporan dugaan pelanggaran dari pihak internal maupun eksternal seperti pengguna jasa, supplier, maupun masyarakat. Jika terjadi ketidakwajaran, harap kirimkan pertanyaan Anda di sini. Kami menjamin kerahasiaan dalam setiap laporan.
					</div>
					<div class="mt-5 pb-3">
						<a href="mailto:lapor.gratifikasi@pelindomarine.com" class="btnorgout btneye2">Kirim Laporan</a>
						<div class="small pt-2 text-dark">Lampirkan <span class="fbold">kartu identitas</span>, contoh: KTP.</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-6 align-self-center order-1 order-sm-12">
					<img src="upload/Gambar8_MarineCare.jpg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</section>
