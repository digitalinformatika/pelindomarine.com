<?php
	//session language
	$weblangs = session('weblang');
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
				<div class="breadcumbs">Home / <a href="./marine-care/" class="linkbread">Marine Care</a> / <a href="./marine-care/ppid" class="linkbread"><b>e-PPID</b></a></div>
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
							<div class="col-md-10 offset-md-1" style="height: 8rem;">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5 pt-5 pb-5 order-1 order-sm-12" style="background: #204280;">
					&nbsp;
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container-fluid animate-box" style="position: relative;background: #efefef; margin-top: -40px;z-index: 99;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-12 pb-5 paddmob">
					<div class="biry60 fbolds"  style="margin-top: -110px;">e-PPID</div>
					<div class="biry36">
						<?php if ($weblangs=='indonesia') { ?>Pejabat Pengelola Informasi &amp; Dokumentasi<?php } ?>
						<?php if ($weblangs=='english') { ?>Information Management & Documentation Officer<?php } ?>
					</div>
					<div style="width: 90%; font-weight: 400; padding-top: 90px;" class="robo24 text-dark">
						<p>Layanan ini merupakan sarana online publik untuk mengajukan permohonan informasi dan menyampaikan pengaduan masyarakat sebagai salah satu wujud pelaksanaan keterbukaan informasi publik di PT Pelindo Marine Service</p>
						<p>Untuk mengajukan permohonan informasi atau menyampaikan pengaduan silakan mengisi form dibawah ini:</p>
					</div>
				</div>
				<div class="col-md-6 col-12 nopadd">
					<img src="upload/bkip-photo.png" alt="" style="position: absolute; bottom: 0; margin-top: 10px; right: -8rem;" class="bkip-mob" >
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="container" style="background: #fff; position: relative; z-index: 99;">
		<div class="row pt-4 pb-4">
			<div class="col-md-12" id="divprogress">
				<form id="msform">
					<ul id="progressbar">
						<li class="active" id="readme"><img src="upload/step1.png" width="100" class="istep"><div class="istep1">Step 1</div><div class="istep2">Penjelasan dan<br> Dasar Hukum</div><div class="stepline"></div></li>
						<li id="eform" style="padding-left: 50px;"><img src="upload/step2.png" width="100" class="istep"><div class="istep1">Step 2</div><div class="istep2">Pengisian<br>E-Form</div><div class="stepline"></div></li>
						<li id="confirm" style="padding-left: 50px;"><img src="upload/step3.png" width="100" class="istep"><div class="istep1">Step 3</div><div class="istep2">Proses <br>Selesai</div></li>
					</ul>
					<fieldset>
						<div class="form-card mt-5 mb-5">
							<div class="row">
								<div class="col-md-4">
									<nav class="section-nav">
										<ul>
										  <li><a href="#"><span  class="themeblue fbold biry24">Dasar Hukum PPID</span></a></li>
										  <li><a href="./upload/ppid/hukum/Pedoman Pelaksanaan Keterbukaan Informasi Publik PMS 2024.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> Pedoman Pelaksanaan Keterbukaan Informasi Publik PT Pelindo Marine Service</a></li>
										  <li><a href="./upload/ppid/hukum/Penetapan PPID Nomor 7 Tahun 2020_SOP Layanan Informasi Publik.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> Penetapan PPID Nomor 7 Tahun 2020 SOP Layanan Informasi Publik</a></li>
										  <li><a href="./upload/ppid/hukum/Peraturan Komisi Informasi Nomor 1 Th 2010_SLIP.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> Peraturan Komisi Informasi Nomor 1 Th 2010 SLIP</a></li>
										  <li><a href="./upload/ppid/hukum/Peraturan Komisi Informasi Nomor 1 Th 2013_Prosedur Penyelesaian Sengketa Informasi.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> Peraturan Komisi Informasi Nomor 1 Th 2013 Prosedur Penyelesaian Sengketa Informasi</a></li>
										  <li><a href="./upload/ppid/hukum/Peraturan Komisi Informasi Nomor 1 Th 2017_Pengklasifikasian Informasi Publik.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> Peraturan Komisi Informasi Nomor 1 Th 2017 Pengklasifikasian Informasi Publik</a></li>
										  <li><a href="./upload/ppid/hukum/Perdir KIP PER.13.HM.03.P.III-2016.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> Perdir KIP PER.13.HM.03.P.III-2016</a></li>
										  <li><a href="./upload/ppid/hukum/Perdir KIP PER.0040.HM.03.HOFC-2018.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> Perdir KIP PER.0040.HM.03.HOFC-2018</a></li>
										  <li><a href="./upload/ppid/hukum/PP 61 Tahun 2010_Pelaksanaan UU No 14 Tahun 2008 Ttg KIP.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> PP 61 Tahun 2010_Pelaksanaan UU No 14 Tahun 2008 Ttg KIP</a></li>
										  <li><a href="./upload/ppid/hukum/UU Nomor 14 Tahun 2008_KIP.pdf" target="_blank"><i class="far fa-file-pdf text-danger"></i> UU Nomor 14 Tahun 2008 KIP</a></li>
										</ul>
									</nav>
								</div>
								<div class="col-md-8">
									<div class="boxed-content">
										<section id="read1">
										  <center><span  class="themeblue fbold biry32">Pejabat Pengelola Informasi dan Dokumentasi (PPID)</span>	</center><br>
										  <p>Sebagai perusahaan yang bekerja langsung di bawah naungan pemerintah dan bertujuan untuk melayani publik dengan sepenuh hati, PT Pelindo Marine Service hadir sebagai perusahaan yang mendukung dan berkomitmen terhadap pelaksanaan Keterbukaan Informasi Publik di masyarakat.</p>
										<p>Keterbukaan Informasi Publik memiliki misi untuk memfasilitasi masyarakat untuk mengakses kebutuhan informasi seputar lingkungan PT Pelindo Marine Service. Fasilitas ini dikelola dengan penuh integritas untuk mewujudkan kepedulian terhadap pemenuhan hak memperoleh informasi.</p>
										<p>Sistem ini berpegang teguh pada prinsip transparansi yang diusung oleh perusahaan, dengan mengacu pada prinsip-prinsip yang telah ditetapkan pada undang-undang pelindung yang memayungi segala proses tata laksana pelayanan keterbukaan informasi.</p>
										<p>Perusahaan menjalankan layanan keterbukaan informasi sebagai perwujudan prinsip Good Corporate Governance yang dijunjung oleh perusahaan, dengan kolaborasi dan sinergi dengan satuan-satuan unit yang dibawahinya.</p>
										<p>Segala proses pengelolaan Keterbukaan Informasi Publik dijalankan secara konsisten guna memberikan layanan informasi kepada masyarakat secara tepat dan akurat sesuai undang-undang yang berlaku.</p>
										</section>
									</div>
									<div class="form-row" style="padding-top: 30px;">
										<div class="col form-group">
											<label class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" name="fread1" id="fread1" value="1" style="margin-top: -5px; margin-right: 7px;">
												<span class="form-check-label"> Saya telah membaca dan menyetujui.</span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<input type="button" name="next" id="btnstep1" class="next btn-primary-blue float-right btnoff" value="Selanjutnya >>" disabled="disabled"/>
					</fieldset>
					<fieldset>
						<div class="form-card mt-5 mb-2">
							<div class="row">
								<div class="col-md-6">
									<div class="box-formleft">
										<span  class="themeblue fbold biry26">Personal Information</span>
										<div class="form-group mt-2">
											<label>Nama</label>
											<input type="text" class="form-control required" maxlength="200" placeholder="" name="fnama" id="fnama" required value="">
										</div>
										<div class="form-row">
											<div class="col form-group">
												<label>Nomor KTP/NPWP</label>   
												<input type="text" class="form-control" placeholder="" maxlength="20" name="fktp" id="fktp" required value="">
											</div>
											<div class="col form-group">
												<label>Telp/HP</label>
												<input type="text" class="form-control" placeholder="" name="fhp" maxlength="50" id="fhp" required value="">
											</div>
										</div>
										<div class="form-row">
											<div class="col form-group">
												<label>Tanggal Lahir</label>   
												<input type="text" class="form-control" placeholder="dd/mm/yy" name="ftgllahir" id="ftgllahir" required value="">
											</div>
											<div class="col form-group">
												<label>Tempat Lahir</label>
												<input type="text" class="form-control" placeholder="" name="ftmplahir" maxlength="100" id="ftmplahir" required value="">
											</div>
										</div>
										<div class="form-group mt-2">
											<label>Alamat</label>
											<input type="text" class="form-control" placeholder="" name="falamat" id="falamat" maxlength="150" required value="">
										</div>
										<div class="form-row">
											<div class="col form-group">
												<label>Kota</label>   
												<input type="text" class="form-control" placeholder="" name="fkota" maxlength="100" id="fkota" required value="">
											</div>
											<div class="col form-group">
												<label>Provinsi</label>
												<input type="text" class="form-control" placeholder="" maxlength="100" name="fprovinsi" id="fprovinsi" required value="">
											</div>
										</div>
										<div class="form-row">
											<div class="col form-group">
												<label>Kodepos</label>   
												<input type="text" class="form-control" placeholder="" maxlength="10" name="fkodepos" id="fkodepos" value="">
											</div>
											<div class="col form-group">
												<label>&nbsp;</label>
											</div>
										</div>
										<div class="form-group mt-2">
											<label>Email</label>
											<input type="email" class="form-control" placeholder="" maxlength="100" name="femail" id="femail" required value="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-formright">
										<span  class="themeblue fbold biry26">Personal Information</span>
										<div class="form-group mt-2">
											<label>Informasi yang dibutuhkan</label>
											<input type="text" class="form-control" maxlength="200" placeholder="" name="finfo" id="finfo" required value="">
										</div>
										<div class="form-group mt-2">
											<label>Alasan penggunaan informasi</label>
											<textarea class="form-control" maxlength="200" name="falasan" id="falasan" style="height: 100px;" required></textarea>
										</div>
										<label>Cara memperoleh informasi*</label>
										<div class="form-row" style="border-bottom: 1px solid #777; margin-bottom: 20px;">
											<div class="col form-group">
												<label class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="fcara" id="fcara" value="1" style="margin-top: -20px; margin-right: 7px;" checked="checked" required>
												<span class="form-check-label"> Mendapat salinan<br><span class="themegrey">(hardcopy/softcopy)</span> </span>
											</div>
											<div class="col form-group">
												<label class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="fcara" id="fcara" value="2" style="margin-top: -35px; margin-right: 7px;" required>
													<span class="form-check-label"> Langsung<br><span class="themegrey">(melihat/membaca/mendengar/mencatat)</span>
													<input type="hidden" name="getcara" id="getcara" value="1">
												</label>
											</div>
										</div>
										<label>Cara mendapatkan salinan informasi*</label>
										<div class="form-row">
											<div class="col form-group">
												<label class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="fcopy" id="fcopy" value="1" style="margin-top: -5px; margin-right: 7px;" checked="checked" required>
												<span class="form-check-label"> Mengambil langsung </span>
											</div>
											<div class="col form-group">
												<label class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="fcopy" id="fcopy" value="2" style="margin-top: -5px; margin-right: 7px;" required>
													<span class="form-check-label"> Email</span>
												</label>
											</div>
										</div>
										<div class="form-row" style="margin-top: -15px;">
											<div class="col form-group">
												<label class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="fcopy" id="fcopy" value="3" style="margin-top: -5px; margin-right: 7px;" required>
													<span class="form-check-label"> Dikirim lewat pos</span>
													<input type="hidden" name="getcopy" id="getcopy" value="1">
												</label>
											</div>
										</div>
										<div class="form-row" style="border-top: 1px solid #777;border-bottom: 1px solid #777; padding-top: 20px;">
											<div class="col form-group">
												<input type="file" name="input" id="input" onchange="validateKTP()" accept=".png, .jpg, .jpeg" required> Upload scan KTP/NPWP
												<textarea name="gambarkartu" id="gambarkartu" hidden="hidden"></textarea><br><canvas id="canvas" height="1"></canvas>
											</div>
										</div>
										<div class="form-row" style="border-top: 1px solid #777;border-bottom: 1px solid #777; padding-top: 20px;">
											<div class="col form-group">
												<input type="file" name="inputSurat" id="inputSurat" onchange="validateKTP()" accept=".png, .jpg, .jpeg" required> Upload Surat Pengantar
												<textarea name="gambarSurat" id="gambarSurat" hidden="hidden"></textarea><br><canvas id="canvasSurat" height="1"></canvas><br>
												
												<p><small>Data yang dikirim pemohon dijamin kerahasiaannya dan hanya dipergunakan untuk verifikasi permohonan data.</small></p>
												<label class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" name="fagree" id="fread2" value="1" style="margin-top: -5px; margin-right: 7px;">
													<span class="form-check-label"> Saya menyetujui persyaratan dan ketentuan yang berlaku.</span>
												</label>
											</div>
										</div>
										<div class="form-row mt-4">
											<div class="form-group">												
												<div><label><small>Keterangan: * Pilih salah satu</small></label></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="button" name="next" class="next btn-primary-blue float-right btnoff" id="btnconfirm" value="Selanjutnya >>" disabled="disabled"/> <input type="reset" name="reset" class="btn-primary-bluel float-right" style="margin-right: 5px;" value="Reset"/> 
					</fieldset>
					<fieldset>
						<div class="form-card mt-5 mb-5">
							<div class="row">
								<div class="col-md-12 text-center">
									<div id="hasilnya"></div>
									<div id="proceed">
										<img src="upload/process.gif"><br>
										<h6>Memproses data, mohon tunggu...</h6>
									</div>
									<div id="succeed">
										<img src="upload/bkip-mail.png">
										<h3 class="themeblue fbold pt-4">Terima kasih Anda telah mengisi <br>formulir pengajuan e-PPID.</h3>
										<p class="themeblue fbold biry24">Permintaan Anda akan segera kami tindak lanjuti, silahkan menunggu balasan dari kami.</p>
									</div>
									
								</div>
								<div class="col-md-12 text-center mt-4" id="datafile">
									<div id="proceed2">
										<img src="upload/process.gif" width="130">
										<div style="position: relative; margin-top: -50px;">Memproses data terakhir...</div>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>