<?php
	//session language
	$weblangs = session('weblang');
?>
<section id="pms-inner-header2" style="background: #204280;">
	<div class="container">
	</div>
</section>

<section id="pms-innerblock-small">
	<div class="container">
		<div class="row animate-box">
			<div class="col-md-12 col-xs-12 text-right">
				<?php if ($weblangs=='english') { ?><div class="breadcumbs2">Home / <b>Line of Business</b></div><?php } ?>
				<?php if ($weblangs=='indonesia') { ?><div class="breadcumbs2">Home / <b>Bidang Usaha</b></div><?php } ?>
			</div>
		</div>
	</div>
	
	<div class="container animate-box">
		<div class="row nopadding">
			<div class="col-md-12 mt-3">
				<?php if ($weblangs=='english') { ?>
				<div class="biry72 themeblue fbolds mt-5">Line of Business</div>
				<?php } ?>
				<?php if ($weblangs=='indonesia') { ?>
				<div class="biry72 themeblue fbolds mt-5">Bidang Usaha</div>
				<?php } ?>
			</div>
			<?php if ($weblangs=='english') { ?>
			<div class="col-md-12 mt-5 lob-1">
				<img src="upload/homepage/plob1.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob1.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Tug Assist &amp; Pilot Boat</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Pilot boat services and tug assistance for vessels,
						barges, and offshore operations to uphold safety
						and efficiency in port berthing docking and
						mooring.</span>
					</div>
				</div>
			</div>
			<!--div class="col-md-12 mt-5 lob-2">
				<img src="upload/homepage/plob2.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob2.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Voluntary Pilotage</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Experienced deep sea pilot as marine advisor for
						assisting vessel navigation at the Voluntary
						Pilotage Services in the Strait of Malacca and
						Singapore (SOMS).</span>
					</div>
				</div>
			</div-->
			<div class="col-md-12 mt-5 lob-3">
				<img src="upload/homepage/plob3.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob3.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Ship Brokerage</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Single window of agency services to hire tugboats,
						pilot boats, and other vessels, for various maritime
						operations.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-4">
				<img src="upload/homepage/plob4.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob4.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Vessel Maintenance</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Graving docks for maintenance and repair services
						for merchant vessels, tugboat, pilot boat, and
						exotic cruise.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-5">
				<img src="upload/homepage/plob5.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob5.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Dredging Expert</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Dredging project operations for various purposes,
						including depth maintenance for shipping channel
						and port basin, as well as reclamation.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-6">
				<img src="upload/homepage/plob6.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob6.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Energy Logistic & Shorebase</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Midstream LNG Terminal services, energy logistics
						from ship-to-ship to tank storages and trucking
						distribution, and full service shore base for offshore
						operations.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-7">
				<img src="upload/homepage/plob7.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob7.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Port Utility &amp; Waste Management</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Port Utility & Waste Management
						Full service at ports for electricity and clean water
						supply, including oil spill and waste management.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-8">
				<img src="upload/homepage/plob8.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob8.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Multimodal Transportation</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Integrated logistics services including multimodal
						transport, open yard, warehouse, custom
						clearance, and project cargo handling.</span>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<?php if ($weblangs=='indonesia') { ?>
			<div class="col-md-12 mt-5 lob-1">
				<img src="upload/homepage/plob1.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob1.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Kapal Tunda &amp; Kapal Pandu</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Layanan kapal pandu serta penundaan kapal, tug-assist, dan transportasi untuk operasional sandar, dukungan offshore, hingga perbaikan kapal, yang sesuai regulasi, selamat, dan efisien.</span>
					</div>
				</div>
			</div>
			<!--div class="col-md-12 mt-5 lob-2">
				<img src="upload/homepage/plob2.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob2.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Pemanduan Luar Biasa</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Layanan Pandu Laut Dalam yang berpengalaman untuk membantu navigasi pelayaran yang aman di Perairan Pandu Luar Biasa Selat Malaka dan Singapura.</span>
					</div>
				</div>
			</div-->
			<div class="col-md-12 mt-5 lob-3">
				<img src="upload/homepage/plob3.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob3.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Keagenan Kapal</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Pelayanan satu pintu untuk penyediaan kapal tunda, kapal pandu, dan sebagainya sesuai kebutuhan pengguna jasa maritim.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-4">
				<img src="upload/homepage/plob4.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob4.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Fasilitas Perbaikan &amp; Pemeliharaan Kapal</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Fasilitas Perbaikan dan Pemeliharaan kapal untuk berbagai jenis kapal di Palabuhan Tanjung Perak Surabaya dan Pelabuhan Tanjung Emas Semarang.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-5">
				<img src="upload/homepage/plob5.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob5.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Pengerukan & Penyiapan Lahan</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Jasa teknis pengerukan bawah air untuk berbagai kebutuhan, termasuk perawatan kedalaman alur pelayaran dan kolam pelabuhan, serta penyiapan lahan.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-6">
				<img src="upload/homepage/plob6.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob6.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Logistik Energi dan Shorebase</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Layanan midstream Terminal LNG, logistik energi dari ship-to-ship hingga tangki timbun dan pengangkutan distribusi, serta fasilitas shorebase dengan layanan prioritas.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-7">
				<img src="upload/homepage/plob7.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob7.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Utilitas Pelabuhan & Pengelolaan Limbah</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Dukungan utilitas di pelabuhan, seperti suplai listrik dan air bersih. Layanan pengelolaan limbah dan tumpahan minyak.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-5 lob-8">
				<img src="upload/homepage/plob8.jpg" alt="" class="img-fluid">
				<div class="row lobpadd mb-3">
					<div class="col-md-2 col-sm-3 col-sm-3 col-4">
						<div class="btnin-services">
							<img src="images/lob8.png" alt="" title="" class="img-fluid">
						</div>
					</div>
					<div class="col-md-3 col-sm-9 col-sm-9 col-8 align-self-center">
						<span class="biry48 themeblue fbold">Transportasi Multimoda</span>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 align-self-center m-lobtopad">
						<span class="biry32">Layanan logistik terintegrasi, mulai dari transportasi multimoda, lapangan penumpukkan, pergudangan, perizinan, hingga project cargo.</span>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>