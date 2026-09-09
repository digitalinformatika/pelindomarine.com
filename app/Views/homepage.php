

<?php
	//session language
	$weblangs = session('weblang');
	
	
	foreach ($homebody as $p) {
		//homepage profile short intro
		if ($p['type']=='intro') $pintro = $p['value'];
		if ($p['type']=='introdesc') $pintrodesc = $p['value'];
		if ($p['type']=='intro_id') $pintroid = $p['value'];
		if ($p['type']=='introdesc_id') $pintrodescid = $p['value'];
	}

	// Persiapkan background banner
	$activeBanners = [];
	foreach (($homebanners ?? []) as $b) {
		$bRel = ltrim((string) ($b['gambar'] ?? ''), '/\\');
		$bImg = null;
		if (!empty($bRel)) {
			if (is_file(FCPATH . 'uploads/' . $bRel)) {
				$bImg = base_url('uploads/' . $bRel);
			} elseif (is_file(FCPATH . 'upload/' . $bRel)) {
				$bImg = base_url('upload/' . $bRel);
			} elseif (is_file(FCPATH . $bRel)) {
				$bImg = base_url($bRel);
			} else {
				// File upload CMS (shared storage / salin dari repo CMS saat development)
				$bImg = cms_media_url($bRel, '', true);
			}
		}
		if ($bImg) {
			$b['resolved_img'] = $bImg;
			$activeBanners[] = $b;
		}
	}
	$bannerCount = count($activeBanners);
	$fallbackBg = base_url('upload/homepage/p-mainimage.jpg');
?>
	<section id="pms-welcome" class="js-fullheight" style="position: relative; overflow: hidden; background-color: #0b192c; <?php if ($bannerCount <= 1) { ?>background-image: <?php echo $bannerCount === 1 ? "url('" . esc($activeBanners[0]['resolved_img'], 'attr') . "'), " : ''; ?>url('<?php echo esc($fallbackBg, 'attr'); ?>'); background-size: cover; background-position: center;<?php } ?>" data-next="yes">

		<?php if ($bannerCount > 1) { ?>
		<!-- Hero Slider Background (Otomatis Slide, Tanpa Tombol Navigasi) -->
		<div class="pms-hero-slider-wrap" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;">
			<?php foreach ($activeBanners as $idx => $b) { ?>
				<div class="pms-hero-slide" data-duration="<?php echo (int) ($b['durasi'] ?? 5); ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('<?php echo esc($b['resolved_img'], 'attr'); ?>'), url('<?php echo esc($fallbackBg, 'attr'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: <?php echo $idx === 0 ? '1' : '0'; ?>; transition: opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1); will-change: opacity;">
					<?php if (!empty($b['url'])) { ?>
						<a href="<?php echo esc($b['url'], 'attr'); ?>" target="<?php echo !empty($b['is_new_tab']) ? '_blank' : '_self'; ?>" rel="noopener" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block; z-index: 2; text-indent: -9999px;">Banner Link</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<script>
		(function() {
			var slides = document.querySelectorAll('#pms-welcome .pms-hero-slide');
			if (!slides || slides.length <= 1) return;
			var currentIdx = 0;
			var timerId = null;

			function advanceSlide() {
				var prev = slides[currentIdx];
				currentIdx = (currentIdx + 1) % slides.length;
				var next = slides[currentIdx];

				prev.style.opacity = '0';
				next.style.opacity = '1';

				var dur = parseInt(next.getAttribute('data-duration') || '5', 10);
				if (isNaN(dur) || dur < 1) dur = 5;
				timerId = setTimeout(advanceSlide, dur * 1000);
			}

			var initDur = parseInt(slides[0].getAttribute('data-duration') || '5', 10);
			if (isNaN(initDur) || initDur < 1) initDur = 5;
			timerId = setTimeout(advanceSlide, initDur * 1000);
		})();
		</script>
		<?php } ?>

		<!-- Overlay & Slogan Maritim Statis -->
		<div class="container" style="position: relative; z-index: 5;">
			<div class="pms-intro js-fullheight">
				
				<div class="pms-intro-text">
					<div class="pms-left-position">
						<?php if ($weblangs=='english') { ?>
						<h2 class="animated slideInUp">INTEGRATED<br><span class="boldy"> MARINE SERVICES</span></h2>
						<p class="animated slideInUp">We provide a one-stop service that caters to a variety of marine services nationwide and globally.</p>
						<?php } ?>
						<?php if ($weblangs=='indonesia') { ?>
						<h2 class="animated slideInUp">LAYANAN<br><span class="boldy"> MARITIM TERINTEGRASI</span></h2>
						<p class="animated slideInUp">Pelayanan satu atap berdedikasi penuh untuk kebutuhan kelautan berskala nasional maupun global.</p>
						<?php } ?>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	
	<section id="services-box">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 bgcover">
					&nbsp;
				</div>
				<div class="section-services animated slideInUp">
					<div class="boxed-services">
						<div class="scol grid_1_of_8">
							<a href="line-of-business/lob-1">
							<div class="btn-services">
								<img src="images/lob1.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice">
									<div class="content-info">
										<span class="show-detail">
											<img src="images/lob1.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Tug Assist &amp; Pilot Boat</h5>
											Pilot boat services and tug assistance for vessels,
											barges, and offshore operations to uphold safety
											and efficiency in port berthing docking and
											mooring.
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Kapal Tunda &amp; Kapal Pandu</h5>
											Layanan kapal pandu serta penundaan kapal, tug-assist, dan transportasi untuk operasional sandar, dukungan offshore, hingga perbaikan kapal, yang sesuai regulasi, selamat, dan efisien.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							</a>
						</div>
						<!--div class="scol grid_1_of_8">
							<a href="line-of-business/lob-2">
							<div class="btn-services">
								<img src="images/lob2.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice">
									<div class="content-info">
										<span class="show-detail">
											<img src="images/lob2.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Voluntary Pilotage</h5>
											Experienced deep sea pilot as marine advisor for
											assisting vessel navigation at the Voluntary
											Pilotage Services in the Strait of Malacca and
											Singapore (SOMS).
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Pemanduan Luar Biasa</h5>
											Layanan Pandu Laut Dalam yang berpengalaman untuk membantu navigasi pelayaran yang aman di Perairan Pandu Luar Biasa Selat Malaka dan Singapura.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							</a>
						</div-->
						<div class="scol grid_1_of_8">
							<a href="line-of-business/lob-3">
							<div class="btn-services">
								<img src="images/lob3.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice">
									<div class="content-info">
										<span class="show-detail">
											<img src="images/lob3.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Ship Brokerage</h5>
											Single window of agency services to hire tugboats,
											pilot boats, and other vessels, for various maritime
											operations.
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Keagenan Kapal</h5>
											Pelayanan satu pintu untuk penyediaan kapal tunda, pilot, dan sebagainya sesuai kebutuhan pengguna jasa maritim.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							</a>
						</div>
						<div class="scol grid_1_of_8">
							<a href="line-of-business/lob-4">
							<div class="btn-services">
								<img src="images/lob4.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice">
									<div class="content-info">
										<span class="show-detail">
											<img src="images/lob4.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Vessel Maintenance</h5>
											Graving docks for maintenance and repair services
											for merchant vessels, tugboat, pilot boat, and
											exotic cruise.
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Fasilitas Perbaikan &amp; Pemeliharaan Kapal</h5>
											Fasilitas Perbaikan dan Pemeliharaan kapal untuk berbagai jenis kapal di Palabuhan Tanjung Perak Surabaya dan Pelabuhan Tanjung Emas Semarang.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							</a>
						</div>
						<div class="scol grid_1_of_8 lobgadget">
							<a href="line-of-business/lob-5">
							<div class="btn-services ">
								<img src="images/lob5.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice">
									<div class="content-info">
										<span class="show-detail">
											<img src="images/lob5.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Dredging Expert</h5>
											Dredging project operations for various purposes,
											including depth maintenance for shipping channel
											and port basin, as well as reclamation.
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Pengerukan & Penyiapan Lahan</h5>
											Jasa teknis pengerukan bawah air untuk berbagai kebutuhan, termasuk perawatan kedalaman alur pelayaran dan kolam pelabuhan, serta penyiapan lahan.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							</a>
						</div>
						<div class="scol grid_1_of_8">
							<a href="line-of-business/lob-6">
							<div class="btn-services">
								<img src="images/lob6.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice2 adjust1">
									<div class="content-info2">
										<span class="show-detail">
											<img src="images/lob6.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Energy Logistics &amp; Shorebase</h5>
											Midstream LNG Terminal services, energy logistics
											from ship-to-ship to tank storages and trucking
											distribution, and full service shore base for offshore
											operations.
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Logistik Energi dan Shorebase</h5>
											Layanan midstream Terminal LNG, logistik energi dari ship-to-ship hingg tangki timbun dan pengangkutan distribusi, serta fasilitas shorebase dengan layanan  prioritas.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							</a>
						</div>
						<div class="scol grid_1_of_8">
							<a href="line-of-business/lob-7">
							<div class="btn-services">
								<img src="images/lob7.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice2 adjust2">
									<div class="content-info2">
										<span class="show-detail">
											<img src="images/lob7.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Port Utility &amp; Waste Management</h5>
											Port Utility & Waste Management
											Full service at ports for electricity and clean water
											supply, including oil spill and waste management.
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Utilitas Pelabuhan & Pengelolaan Limbah</h5>
											Dukungan utilitas di pelabuhan, seperti suplai listrik dan air bersih. Layanan pengelolaan limbah dan tumpahan minyak.
											<?php } ?>
											
										</span>
									</div>
								</div>
							</div>
							</a>
						</div>
						<div class="scol grid_1_of_8">
							<a href="line-of-business/lob-8">
							<div class="btn-services">
								<img src="images/lob8.png" alt="" title="" class="img-fluid">
								<div class="box-infoservice2">
									<div class="content-info2">
										<span class="show-detail">
											<img src="images/lob8.png" alt="" title="" class="img-iconshow">
											<?php if ($weblangs=='english') { ?>
											<h5 class="head-lob">Multimodal Transport</h5>
											Integrated logistics services including multimodal
											transport, open yard, warehouse, custom
											clearance, and project cargo handling.
											<?php } ?>
											<?php if ($weblangs=='indonesia') { ?>
											<h5 class="head-lob">Transportasi Multimoda</h5>
											Layanan logistik terintegrasi, mulai dari transportasi multimoda, lapangan penumpukan, pergudangan, perizinan, hingga project cargo.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	
	<section id="pms-about">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 nopadding animate-box">
					<img src="images/p-bgabout.png?ver=1" alt="" title="" class="img-fluid">
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12 mabout">
							<?php if ($weblangs=='english') { ?>
							<div class="pms-feature">
								<div class="animate-box">
									<h1 class="themeblue fbiryani"><?php echo $pintro; ?></h1>
								</div>
							</div>
							<div class="pms-feature">
								<div class="pms-text animate-box">
									<p><?php echo $pintrodesc; ?></p>
								</div>
							</div>
							<div class="pms-feature pt-15">
								<div class="pms-text animate-box">
									<a href="company/about-us" class="btn btn-primary">Learn More</a> <a href="company/regulatory" class="btn btn-light">Our Regulations</a>
								</div>
							</div>
							<?php } ?>
							<?php if ($weblangs=='indonesia') { ?>
							<div class="pms-feature">
								<div class="animate-box">
									<h1 class="themeblue fbiryani"><?php echo $pintroid; ?></h1>
								</div>
							</div>
							<div class="pms-feature">
								<div class="pms-text animate-box">
									<p><?php echo $pintrodescid; ?></p>
								</div>
							</div>
							<div class="pms-feature pt-15">
								<div class="pms-text animate-box">
									<a href="company/about-us" class="btn btn-primary">Lebih Lanjut</a> <a href="company/regulatory" class="btn btn-light">Kebijakan Kami</a>
								</div>
							</div>
							
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="pms-cert">
		<div class="container-fluid">
			<div class="box-cert">
				<div class="row">
					<div class="col-md-12 animate-box text-center">
						<?php if ($weblangs=='english') { ?>
						<h5 class="fbiryani text-light nomargin">Providing integrated marine service solutions</h5>
						<?php } ?>
						<?php if ($weblangs=='indonesia') { ?>
						<h5 class="fbiryani text-light nomargin">Menyediakan layanan perkapalan global dengan optimal</h5>
						<?php } ?>
						<div class="row givepadd">
							<?php foreach ($homecert as $cert) { ?>
							<div class="col mt-5">
								<img src="upload/<?php echo $cert['logo']; ?>" alt="" title="" height="99">
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	
	<section id="pms-vessel">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 col-sm-10 nopadding animate-box">
					<div class="owl-carousel active_vessel">
						<?php foreach ($homevessel as $vess) { ?>
						<div class="shipimg" style="">
							<div class="">
								<img src="upload/<?php echo $vess['boatimage']; ?>" alt="" />
							</div>
							<div class="vessel-title">
								<?php echo $vess['title']; ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-2 link-vesselmore col-sm-3 animate-box justify-content-center align-self-center">
					<?php if ($weblangs=='english') { ?><a href="services/vessel" class="vessel-more">More Vessel</a><?php } ?>
					<?php if ($weblangs=='indonesia') { ?><a href="services/vessel" class="vessel-more">Lihat semua</a><?php } ?>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12 animate-box">                    
					<div class="ops-titles">
						<?php if ($weblangs=='english') { ?>
						<h5 class="themeblue fbiryani">Operational Area</h5>
						<p class="themeblue">We build an extensive network across Indonesian water and overseas, providing integrated marine service solutions.</p>
						<?php } ?>
						<?php if ($weblangs=='indonesia') { ?>
						<h5 class="themeblue fbiryani">Area Operasional</h5>
						<p class="themeblue">Kami membangun jaringan yang luas di seluruh perairan Indonesia dan luar negeri dengan layanan terintegrasi di setiap lokasi.</p>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-12 mview animate-box">
					<div class="ops-titles">
						<?php if ($weblangs=='english') { ?>
						<h5 class="themeblue fbiryani">Operational Area</h5>
						<p class="themeblue">We build an extensive network across Indonesian water and overseas, providing integrated marine service solutions</p>
						<?php } ?>
						<?php if ($weblangs=='indonesia') { ?>
						<h5 class="themeblue fbiryani">Area Operasional</h5>
						<p class="themeblue">Kami membangun jaringan yang luas di seluruh perairan Indonesia dan luar negeri dengan layanan terintegrasi di setiap lokasi</p>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="gmaps">
						<div id="map" style="height: 600px; border-radius: 25px;"></div>
						<div id="legend"></div>

					</div>
					<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
						integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
					<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
						integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
					<script>
						const icons = {
							west:   { name: "West",    icon: "./images/pin1.png" },
							middle: { name: "Central", icon: "./images/pin2.png" },
							east:   { name: "East",    icon: "./images/pin3.png" },
						};

						// Peta OpenStreetMap via Leaflet
						var map = L.map('map', {
							center: [-1.6551471, 118.8555969],
							zoom: 5,
							minZoom: 4,
							zoomControl: false,
							attributionControl: true,
							maxBounds: [[-19.0075, 90], [16, 146]], // batas wilayah Indonesia
							maxBoundsViscosity: 0.7
						});

						L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
							maxZoom: 19,
							attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
						}).addTo(map);

						function addMarker(prop) {
							var options = {};
							if (prop.iconImage) {
								options.icon = L.icon({
									iconUrl: prop.iconImage,
									iconSize: [27, 43],
									iconAnchor: [13, 43],
									popupAnchor: [0, -45]
								});
							}
							var marker = L.marker([prop.coordinates.lat, prop.coordinates.lng], options).addTo(map);
							if (prop.content) {
								marker.bindPopup(prop.content, { maxWidth: 320 });
								var closeTimer = null;
								marker.on('mouseover', function () { clearTimeout(closeTimer); this.openPopup(); });
								marker.on('mouseout', function () {
									var m = this;
									closeTimer = setTimeout(function () { m.closePopup(); }, 1500);
								});
							}
						}

						<?php
							foreach ($homemaps as $mapItem) {
								$maplink = $mapItem['MAP_URL'];
								$mapurl = strstr($maplink, '/@');
								// Ambil koordinat lat,lng dari URL peta ("/@lat,lng,zoom...")
								if ($mapurl === false || strpos($mapurl, '/@') === false) continue;
								$kord = explode(",", $mapurl);
								if (count($kord) < 2) continue;
								$latit = substr($kord[0], strpos($kord[0], "@") + 1);

								$sicon = "pin1.png";
								if ($mapItem['MAP_REGION']=="East") $sicon = "pin3.png";
								if ($mapItem['MAP_REGION']=="Middle") $sicon = "pin2.png";

								$foto = $mapItem['MAP_PHOTO'] !== "" ? $mapItem['MAP_PHOTO'] : "nopic.jpg";
						?>
						addMarker({
						   coordinates:{lat: <?php echo $latit; ?>, lng: <?php echo $kord[1]; ?>},
						   iconImage:'./images/<?php echo $sicon; ?>',
						   content:	'<div class="row" style="margin:0;padding:0;overflow:hidden;"><div class=""><img src="./upload/maps/<?php echo $foto; ?>" width="100" style="margin-right: 15px; margin-bottom: 7px;"></div>' +
									'<div style="margin-right: 25px;"><div class="maptitle"><?php echo $mapItem['MAP_TITLE']; ?></div>' +
									'<span style="font-size: 12px;" ?><?php echo $mapItem['MAP_ADDRESS']; ?></span><br><br><a href="<?php echo $maplink; ?>" class="maplink" target="_blank">View Location</a></div></div>'
						});
						<?php } ?>

						// Legend region di pojok kanan bawah
						var legendControl = L.control({ position: 'bottomright' });
						legendControl.onAdd = function () {
							var legend = document.getElementById('legend');
							for (const key in icons) {
								const div = document.createElement('div');
								div.innerHTML = '<img src="' + icons[key].icon + '" height="22"> ' + icons[key].name;
								legend.appendChild(div);
							}
							return legend;
						};
						legendControl.addTo(map);
					</script>
				</div>
			</div>
			
		</div>
	</section>
	<!-- END #pms-testimonials -->
	
	<section class="docks-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 nopadding">
					<div class="owl-carousel docks">
						<?php foreach ($homedockgal as $dock) { ?>
						<div class="box-docks">
							<div class="docksimg">
								<?php if ($weblangs=='english') { ?>
								<a href="upload/<?php echo $dock['dockimage']; ?>" class="docksgal" data-title="<?php echo $dock['title']; ?>" data-caption="<?php echo $dock['descs']; ?>">
								<?php } ?>
								<?php if ($weblangs=='indonesia') { ?>
								<a href="upload/<?php echo $dock['dockimage']; ?>" class="docksgal" data-title="<?php echo $dock['titleid']; ?>" data-caption="<?php echo $dock['deskripsi']; ?>">
								<?php } ?>
								<img src="upload/<?php echo $dock['dockimage']; ?>" alt="" /></a>
								<div class="docks-desc">
									<div class="docks-title">
										<?php if ($weblangs=='english') { ?><?php echo $dock['title']; ?><?php } ?>
										<?php if ($weblangs=='indonesia') { ?><?php echo $dock['titleid']; ?><?php } ?>
									</div>
									<?php if ($weblangs=='english') { ?><p><?php echo $dock['descs']; ?></p><?php } ?>
									<?php if ($weblangs=='indonesia') { ?><p><?php echo $dock['deskripsi']; ?></p><?php } ?>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="news-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php if ($weblangs=='english') { ?><h3 class="fbiryani themeblue tnewsmob">Latest News</h3><?php } ?>
					<?php if ($weblangs=='indonesia') { ?><h3 class="fbiryani themeblue tnewsmob">Berita Terbaru</h3><?php } ?>
				</div>
				<?php foreach ($homenews as $n) { ?>
				<div class="col-md-3 col-6 mb-5">
					<?php
						// Gambar berita: upload CMS (folder informasi) atau file lama, cadangan nopic
						$nopic  = base_url('upload/news/nopic.png');
						$gambar = media_img_url($n['LINK_FILE'] ?? null, 'informasi', ['upload/news', 'main/uploads/informasi'], $nopic);
					?>
					<div class="swrapimg">
						<img src="<?php echo esc($gambar); ?>" alt="" title="" class="img-fluid" <?= img_fallback_attr($nopic) ?>>
					</div>
					<div class="news-desc">
						<h6><a href="company/readnews/<?php echo $n['INFORMASI_ID']; ?>" class="postlink"><?= (($weblangs=='indonesia') ? htmlspecialchars_decode($n['NAMA'], ENT_QUOTES) : htmlspecialchars_decode($n['TITLE'], ENT_QUOTES)); ?></a></h6>
					</div>
					<div class="postdate">
						<span class="themeorg"><i class="far fa-calendar-alt"></i> <?php echo date('d M Y', strtotime($n['TANGGAL'])); ?></span><br>
						<?php if ($weblangs=='english') { ?><a href="company/readnews/<?php echo $n['INFORMASI_ID']; ?>" class="themegrey">Read more</a><?php } ?>
						<?php if ($weblangs=='indonesia') { ?><a href="company/readnews/<?php echo $n['INFORMASI_ID']; ?>" class="themegrey">Lebih lanjut</a><?php } ?>
					</div>
				</div>
				<?php } ?>
				
				<div class="col-md-12 mb-5">
					<div class="news-more">
						<?php if ($weblangs=='english') { ?><a href="company/news" class="themegrey"><b>More News</b></a><?php } ?>
						<?php if ($weblangs=='indonesia') { ?><a href="company/news" class="themegrey"><b>Lihat Semua</b></a><?php } ?>
					</div>
					<br>
				</div>
			</div>
		</div>
	</section>
	
	<?= view('partials/social_media') ?>

	<section id="pms-affiliate">
		<div class="container-fluid bgaff">
			<div class="container">
				<div class="row pb-3 justify-content-center text-center">
					<?php //foreach ($homelinks as $l) { ?>
					<!-- <div class="col-md-2 col-4 offset-md-1">
						<a href="https://www.pelindo.co.id/" target="_blank"><img src="upload/logo5_Subsidiary.png" alt="PT Pelindo" class="img-fluid" /></a>
					</div> -->
					
					<div class="col-md-2 col-4">
						<a href="https://ptapbs.com/" target="_blank"><img src="upload/logo1_Subsidiary.png" alt="PT Alur Pelayaran Barat Surabaya" class="img-fluid" /></a>
					</div>
					<div class="col-md-2 col-4">
						<a href="http://pel.co.id" target="_blank"><img src="upload/logo2_Subsidiary.png" alt="PT Pelindo Energi Logistik" class="img-fluid" /></a>
					</div>
					<!-- <div class="col-md-2 col-4">
						<a href="http://pelindologistics.co.id/" target="_blank"><img src="upload/logo3_Subsidiary.png" alt="PT Berkah Multi Cargo Logistics" class="img-fluid" /></a>
					</div>
					<div class="col-md-2 col-4">
						<a href="https://www.instagram.com/lamongnusantaragas/" target="_blank"><img src="upload/logo4_Subsidiary.png" alt="PT Lamong Nusantara Gas" class="img-fluid" /></a>
					</div> -->
				<?php //} ?>
				</div>
			</div>
		</div>
	</section>

<!--Start Flyer-->
<style>
	.lightbox {
		display: none
	}
	.featherlight:last-of-type {
		background-color: white;
		background-color: rgba(0, 0, 0, 0.50);		
		color: white;
	}
</style>
