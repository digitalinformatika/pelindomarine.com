<?php
	//session language
	$weblangs = session('weblang');
	
	foreach ($webmeta as $m) {
		if ($m['type']=='email_kontak') $memail = $m['value'];
		if ($m['type']=='alamat') $maddress = $m['value'];
		if ($m['type']=='telp1') $mphone1 = $m['value'];
		if ($m['type']=='telp2') $mphone2 = $m['value'];
	}
	$auctionstat = "";
	$activeWelcomePopups = [];
	if (!uri_segment(1)) {
		foreach (($welcome ?? []) as $wItem) {
			if (($wItem['status'] ?? '') == "1") {
				$rel = ltrim((string) ($wItem['link_file'] ?? ''), '/\\');
				$wImg = null;
				if (!empty($rel)) {
					if (is_file(FCPATH . 'uploads/' . $rel)) {
						$wImg = base_url('uploads/' . $rel);
					} elseif (is_file(FCPATH . 'upload/' . $rel)) {
						$wImg = base_url('upload/' . $rel);
					} elseif (is_file(FCPATH . $rel)) {
						$wImg = base_url($rel);
					}
				}
				if ($wImg) {
					$wItem['resolved_img'] = $wImg;
					$activeWelcomePopups[] = $wItem;
				}
			}
		}
		if (!empty($activeWelcomePopups)) {
			$auctionstat = "ON";
		}
	}
?>
		<?php if ($weblangs=='english') { ?>
		<footer id="pms-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Company</h3>
							<ul class="pms-links">
								<li><a href="company/about-us">About Us</a></li>
								<li><a href="company/regulatory">Regulatory Frameworks</a></li>
								<li><a href="company/news">News</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Services</h3>
							<ul class="pms-links">
								<li><a href="services/vessel">Vessels</a></li>
								<li><a href="services/shipyard">Graving Docks</a></li>
								<li><a href="services/service">Service and Complaints Flow</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Office</h3>
							<p>
								<?php echo $maddress; ?>
								<a href="mailto:<?php echo $memail; ?>"><?php echo $memail; ?></a>
							</p>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box mb-5">
						<div class="pms-footer-widget">
							<h3>Careers</h3>
							<p>Take part in delivering the optimal solutions today.<br><br>
							<a href="company/careers" class="btnorgout">Learn more</a></p>
							
						</div>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12 d-md-none animate-box" style="margin-top: -50px;">
						<div class="pms-footer-widget">
							<h3>Marine Care</h3>
							<p>One gate for integrated marine services.<br><br>
							<a href="marine-care/" class="btnorgout">Visit</a></p>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<img src="images/danantara.png" alt="" title="" height="60" >
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Contact</h3>
							<ul class="pms-links">
								<li><a href="#"><?php echo $mphone1; ?></a></li>
								<li><a href="#"><?php echo $mphone2; ?></a></li>
							</ul>
							<a href="https://www.youtube.com/c/PelindoMarines" class="footer-smicon"><img src="images/p-icon-yt.png" width="40"></a>
							<a href="https://www.facebook.com/pelindomarines/" class="footer-smicon"><img src="images/p-icon-fb.png" width="40"></a>
							<a href="https://www.instagram.com/pelindomarines/" class="footer-smicon"><img src="images/p-icon-ig.png" width="40"></a>
							<a href="https://www.linkedin.com/company/pt-pelindo-marines/" class="footer-smicon"><img src="images/p-icon-in.png" width="40"></a>
							<a href="https://twitter.com/pelindomarines" class="footer-smicon"><img src="images/p-icon-tw.png" width="40"></a>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 d-none d-lg-block d-md-block animate-box">
						<div class="pms-footer-widget">
							<h3>Marine Care</h3>
							<p>One gate for integrated marine services.<br><br>
							<a href="marine-care/" class="btnorgout">Visit</a></p>
						</div>
					</div>
					
					<div class="col-md-12 col-sm-12 col-xs-12 mt-5 animate-box">
						Copyright &copy <?php echo date('Y'); ?> - PT Pelindo Marine Services
					</div>

				</div>
			</div>
		</footer>
		<?php } ?>
		<?php if ($weblangs=='indonesia') { ?>
		<footer id="pms-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Tentang Kami</h3>
							<ul class="pms-links">
								<li><a href="company/about-us">Profil</a></li>
								<li><a href="company/regulatory">Regulasi Layanan</a></li>
								<li><a href="company/news">Berita</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Layanan Kami</h3>
							<ul class="pms-links">
								<li><a href="services/vessel">Armada</a></li>
								<li><a href="services/shipyard">Fasilitas Pemeliharaan & Perbaikan Kapal</a></li>
								<li><a href="services/service">Alur Layanan dan Pengaduan</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Kantor</h3>
							<p>
								<?php echo $maddress; ?>
								<a href="mailto:<?php echo $memail; ?>"><?php echo $memail; ?></a> 
							</p>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box mb-5">
						<div class="pms-footer-widget">
							<h3>Karir</h3>
							<p>Bergabung bersama kami, melayani secara optimal.<br><br>
							<a href="company/careers" class="btnorgout">Lebih lanjut</a></p>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12 d-md-none animate-box" style="margin-top: -50px;">
						<div class="pms-footer-widget">
							<h3>Marine Care</h3>
							<p>Satu gerbang untuk layanan pengadaan barang dan jasa.<br><br>
							<a href="marine-care/" class="btnorgout">Visit</a></p>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<img src="images/p-footlogo1.png" alt="" title="" height="80" >
							<img src="images/p-footlogo2a.png" alt="" title="" height="80" ><br>
							<img src="images/p-footlogo3.png" alt="" title="" height="80" >
							<img src="images/p-footlogo4.png" alt="" title="" height="80" >
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="pms-footer-widget">
							<h3>Kontak</h3>
							<ul class="pms-links">
								<li><a href="#"><?php echo $mphone1; ?></a></li>
								<li><a href="#"><?php echo $mphone2; ?></a></li>
							</ul>
							<a href="https://www.youtube.com/c/PelindoMarines" class="footer-smicon"><img src="images/p-icon-yt.png" width="40"></a>
							<a href="https://www.facebook.com/pelindomarines/" class="footer-smicon"><img src="images/p-icon-fb.png" width="40"></a>
							<a href="https://www.instagram.com/pelindomarines/" class="footer-smicon"><img src="images/p-icon-ig.png" width="40"></a>
							<a href="https://www.linkedin.com/company/pt-pelindo-marines/" class="footer-smicon"><img src="images/p-icon-in.png" width="40"></a>
							<a href="https://twitter.com/pelindomarines" class="footer-smicon"><img src="images/p-icon-tw.png" width="40"></a>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 d-none d-lg-block d-md-block animate-box">
						<div class="pms-footer-widget">
							<h3>Marine Care</h3>
							<p>Satu gerbang untuk layanan maritim terintegrasi.<br><br>
							<a href="marine-care/" class="btnorgout">Visit</a></p>
						</div>
					</div>
					
					<div class="col-md-12 col-sm-12 col-xs-12 mt-5 animate-box">
						Copyright &copy <?php echo date('Y'); ?> - PT Pelindo Marine Services
					</div>

				</div>
			</div>
		</footer>
		<?php } ?>
		<!-- END #pms-footer -->
	</div>
	
	<?php if (!empty($activeWelcomePopups)) { 
		$popupCount = count($activeWelcomePopups);
		$isIndo = ($weblangs == 'indonesia');
		$txtDontShow = $isIndo ? 'Jangan tampilkan pesan ini lagi' : "Don't show this message again";
		$txtVisit = $isIndo ? 'Kunjungi Tautan' : 'Visit Link';
	?>
	<!-- Maritime Submarine Welcome Screen Modal -->
	<style>
		#gettrial.modal {
			background: rgba(4, 13, 26, 0.88);
			backdrop-filter: blur(8px);
			-webkit-backdrop-filter: blur(8px);
			padding-left: 0 !important;
		}
		#gettrial .modal-dialog {
			max-width: 820px;
			margin: 2rem auto;
		}
		.pms-submarine-card {
			background: linear-gradient(165deg, #0b1c33 0%, #061222 100%) !important;
			border: 1px solid rgba(0, 173, 181, 0.4) !important;
			border-radius: 20px !important;
			box-shadow: 0 25px 60px -10px rgba(0, 0, 0, 0.9), 0 0 40px rgba(0, 173, 181, 0.22) !important;
			position: relative;
			overflow: hidden;
			color: #e2e8f0;
			padding: 0;
		}
		.pms-submarine-sonar-bar {
			height: 3px;
			width: 100%;
			background: linear-gradient(90deg, #00ADB5 0%, #38ef7d 50%, #00ADB5 100%);
			box-shadow: 0 0 12px rgba(0, 173, 181, 0.8);
		}
		.pms-submarine-close-btn {
			position: absolute;
			top: 14px;
			right: 14px;
			width: 38px;
			height: 38px;
			border-radius: 50%;
			background: rgba(11, 28, 51, 0.9);
			border: 1px solid rgba(0, 173, 181, 0.5);
			color: #00ADB5;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			z-index: 30;
			transition: all 0.25s ease;
			outline: none;
			padding: 0;
		}
		.pms-submarine-close-btn:hover {
			background: #00ADB5;
			color: #061222;
			transform: rotate(90deg) scale(1.08);
			box-shadow: 0 0 16px rgba(0, 173, 181, 0.7);
		}
		.pms-popup-slider-container {
			position: relative;
			overflow: hidden;
			width: 100%;
			min-height: 220px;
			background: #040a14;
		}
		.pms-popup-slide-item {
			display: none;
			width: 100%;
			text-align: center;
			animation: pmsFadeIn 0.4s ease-out forwards;
		}
		.pms-popup-slide-item.active {
			display: block;
		}
		@keyframes pmsFadeIn {
			from { opacity: 0; transform: scale(0.985); }
			to { opacity: 1; transform: scale(1); }
		}
		.pms-popup-img-wrap {
			position: relative;
			display: block;
			max-height: 72vh;
			overflow: hidden;
			background: #02070f;
			text-decoration: none;
		}
		.pms-popup-img-wrap img {
			max-height: 72vh;
			width: auto;
			max-width: 100%;
			margin: 0 auto;
			display: block;
			object-fit: contain;
			transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
		}
		.pms-popup-img-wrap:hover img {
			transform: scale(1.015);
		}
		.pms-popup-cta-badge {
			position: absolute;
			bottom: 14px;
			right: 16px;
			background: rgba(11, 28, 51, 0.9);
			border: 1px solid rgba(0, 173, 181, 0.6);
			backdrop-filter: blur(6px);
			-webkit-backdrop-filter: blur(6px);
			color: #00e1d9;
			padding: 7px 16px;
			border-radius: 30px;
			font-size: 12px;
			font-weight: 600;
			letter-spacing: 0.5px;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.5);
			transition: all 0.25s ease;
		}
		.pms-popup-img-wrap:hover .pms-popup-cta-badge {
			background: #00ADB5;
			color: #040d1a;
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(0, 173, 181, 0.6);
		}
		.pms-popup-nav-btn {
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			width: 44px;
			height: 44px;
			border-radius: 50%;
			background: rgba(6, 18, 34, 0.85);
			border: 1px solid rgba(0, 173, 181, 0.4);
			color: #00ADB5;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			z-index: 20;
			transition: all 0.25s ease;
			outline: none;
			padding: 0;
		}
		.pms-popup-nav-btn:hover {
			background: #00ADB5;
			color: #061222;
			transform: translateY(-50%) scale(1.1);
			box-shadow: 0 0 16px rgba(0, 173, 181, 0.7);
		}
		.pms-popup-nav-prev { left: 14px; }
		.pms-popup-nav-next { right: 14px; }
		.pms-submarine-footer {
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 12px;
			padding: 12px 20px;
			background: rgba(4, 13, 26, 0.95);
			border-top: 1px solid rgba(0, 173, 181, 0.2);
			font-size: 13px;
		}
		.pms-submarine-dots {
			display: flex;
			align-items: center;
			gap: 8px;
		}
		.pms-submarine-dot {
			width: 8px;
			height: 8px;
			border-radius: 4px;
			background: rgba(255, 255, 255, 0.25);
			cursor: pointer;
			transition: all 0.3s ease;
		}
		.pms-submarine-dot.active {
			width: 22px;
			background: #00ADB5;
			box-shadow: 0 0 8px #00ADB5;
		}
	</style>

	<div class="modal fade" id="gettrial" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content pms-submarine-card">
				<!-- Glowing Sonar Trim -->
				<div class="pms-submarine-sonar-bar"></div>

				<!-- Floating Close Button -->
				<button type="button" class="pms-submarine-close-btn" data-dismiss="modal" aria-label="Close" onclick="handlePmsPopupClose();">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</button>

				<!-- Popup Slides Container -->
				<div class="pms-popup-slider-container">
					<?php foreach ($activeWelcomePopups as $idx => $popup) { 
						$hasUrl = !empty($popup['url']);
						$targetBlank = !empty($popup['is_new_tab']) ? '_blank' : '_self';
					?>
						<div class="pms-popup-slide-item <?php echo $idx === 0 ? 'active' : ''; ?>" data-index="<?php echo $idx; ?>">
							<?php if ($hasUrl) { ?>
								<a href="<?php echo esc($popup['url'], 'attr'); ?>" target="<?php echo $targetBlank; ?>" rel="noopener" class="pms-popup-img-wrap">
									<img src="<?php echo $popup['resolved_img']; ?>" alt="Pelindo Marines Welcome" class="img-fluid">
									<span class="pms-popup-cta-badge">
										<?php echo $txtVisit; ?>
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
											<line x1="7" y1="17" x2="17" y2="7"></line>
											<polyline points="7 7 17 7 17 17"></polyline>
										</svg>
									</span>
								</a>
							<?php } else { ?>
								<div class="pms-popup-img-wrap">
									<img src="<?php echo $popup['resolved_img']; ?>" alt="Pelindo Marines Welcome" class="img-fluid">
								</div>
							<?php } ?>
						</div>
					<?php } ?>

					<?php if ($popupCount > 1) { ?>
						<!-- Nav Arrows -->
						<button type="button" class="pms-popup-nav-btn pms-popup-nav-prev" onclick="pmsPrevPopup();" aria-label="Previous">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="15 18 9 12 15 6"></polyline>
							</svg>
						</button>
						<button type="button" class="pms-popup-nav-btn pms-popup-nav-next" onclick="pmsNextPopup();" aria-label="Next">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="9 18 15 12 9 6"></polyline>
							</svg>
						</button>
					<?php } ?>
				</div>

				<!-- Maritime Footer -->
				<div class="pms-submarine-footer">
					<label class="d-inline-flex align-items-center mb-0" style="cursor: pointer; user-select: none; font-size: 12.5px;">
						<input type="checkbox" id="chk-pms-dontshow" style="margin-right: 8px; accent-color: #00ADB5; width: 16px; height: 16px; cursor: pointer;">
						<span style="color: #94a3b8; font-weight: 500;"><?php echo $txtDontShow; ?></span>
					</label>

					<?php if ($popupCount > 1) { ?>
						<div class="pms-submarine-dots">
							<?php for ($d = 0; $d < $popupCount; $d++) { ?>
								<span class="pms-submarine-dot <?php echo $d === 0 ? 'active' : ''; ?>" data-dot="<?php echo $d; ?>" onclick="pmsGoPopup(<?php echo $d; ?>);"></span>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<div class='scrolltop'>
		<div class='scroll icon'><img src="images/goup.png" width="50"></div>
	</div>
	
	
	<!-- jQuery -->
	<script src="<?php echo base_url('/'); ?>assets/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="<?php echo base_url('/'); ?>assets/js/jquery.easing.1.3.js"></script>
	<script>
		<?php $idlob = uri_segment(2); ?>
		function scrollToElement(anchorname) {
			$('html, body').animate({
				scrollTop: $(anchorname).offset().top
			}, 3000);
		}
	</script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url('/'); ?>assets/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?php echo base_url('/'); ?>assets/js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="<?php echo base_url('/'); ?>assets/js/jquery.flexslider-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<!-- Magnific Popup -->
	<script src="<?php echo base_url('/'); ?>assets/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url('/'); ?>assets/js/magnific-popup-options.js"></script>
	<script src="<?php echo base_url('/'); ?>assets/js/imageMapResizer.min.js"></script>
	<script src="<?php echo base_url('/'); ?>assets/js/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php echo base_url('/'); ?>assets/js/owl-carousel/owl-carousel-thumb.min.js"></script>
	<!-- Main JS (Do not remove) -->
	<script src="<?php echo base_url('/'); ?>assets/js/main.js"></script>
	
	<?php
        for ($x = 1; $x <= 19; $x++) {
    ?>
	<script>
		$(document).ready(function(){
			$("area.pos<?php echo $x; ?>").mouseenter(function(){
				$("div.pos<?php echo $x; ?>").show();
			});
			$("area.pos<?php echo $x; ?>").mouseleave(function(){
				$("div.pos<?php echo $x; ?>").hide();
			});
		});
	</script>
	<?php } ?>
	<?php if (uri_segment(1)=='') { ?>
	<script>
		$(document).ready(function() {
			$('map').imageMapResize();
		});
		
	</script>
	<?php } ?>
	
	<?php if (uri_segment(1)=='line-of-business') { ?>
	<script>
		$(document).ready(function() {
			scrollToElement($('.<?php echo $idlob; ?>'));
		});
	</script>
	<?php } ?>
	
	<script>
		$(document).ready(function() {
			$('#close-btn').click(function() {
			  $('#search-overlay').fadeOut();
			  $('.openBtn').show();
			});
			$('.openBtn').click(function() {
			  $(this).hide();
			  $('#search-overlay').fadeIn();
			});
		});
	</script>
	
	<script>
		$(document).ready(function(){
			$('.stats-value').each(function () {
				$(this).prop('box-stats',0).animate({
					Counter: $(this).text()
				}, {
					duration: 5000,
					easing: 'swing',
					step: function (now) {
						$(this).text(Math.ceil(now));
					}
				});
			});
		});
	</script>
	
	<script>
		$(document).ready(function(){
			$(".filter-button").click(function(){
				var value = $(this).attr('data-filter');
				if(value == "all")
				{
					$('.filter').show('1000');
				}
				else
				{
					$(".filter").not('.'+value).hide('3000');
					$('.filter').filter('.'+value).show('3000');
				}
			});
			if ($(".filter-button").removeClass("active")) {
				$(this).removeClass("active");
			}
			$(this).addClass("active");
		});
	</script>
	<script>
		function openPopup(divPopup) {
			$(divPopup).fadeIn(250);
		}
		
		function closePopup(divPopup) {
			$(divPopup).fadeOut(250);
		}
	</script>
	
	<?php
		if (!uri_segment(1)) {
			if ($auctionstat=="ON" && !empty($activeWelcomePopups)) {
	?>
    <script>
      var pmsCurrentPopup = 0;
      var pmsPopupTotal = <?php echo count($activeWelcomePopups); ?>;

      function pmsGoPopup(targetIdx) {
        var slides = document.querySelectorAll('.pms-popup-slide-item');
        var dots = document.querySelectorAll('.pms-submarine-dot');
        if (!slides || slides.length === 0) return;
        pmsCurrentPopup = (targetIdx + slides.length) % slides.length;
        for (var i = 0; i < slides.length; i++) {
          if (i === pmsCurrentPopup) {
            slides[i].classList.add('active');
          } else {
            slides[i].classList.remove('active');
          }
        }
        for (var d = 0; d < dots.length; d++) {
          if (d === pmsCurrentPopup) {
            dots[d].classList.add('active');
          } else {
            dots[d].classList.remove('active');
          }
        }
      }

      function pmsNextPopup() { pmsGoPopup(pmsCurrentPopup + 1); }
      function pmsPrevPopup() { pmsGoPopup(pmsCurrentPopup - 1); }

      function handlePmsPopupClose() {
        var chk = document.getElementById('chk-pms-dontshow');
        if (chk && chk.checked) {
          try {
            localStorage.setItem('pms_pop_status', '1');
          } catch(e) {}
          document.cookie = "pop_status=1; path=/; max-age=" + (24 * 3600);
        }
      }

      $(document).ready(function(){
        var isHidden = false;
        try {
          if (localStorage.getItem('pms_pop_status') === '1') isHidden = true;
        } catch(e) {}
        if (document.cookie.indexOf('pop_status=1') !== -1) {
          isHidden = true;
        }

        if (!isHidden) {
          setTimeout(function () { 
            $("#gettrial").modal('show'); 
          }, 800);
        }

        $('#gettrial').on('hide.bs.modal', function() {
          handlePmsPopupClose();
        });

        // Keyboard navigation (kiri/kanan)
        $(document).keydown(function(e) {
          if ($('#gettrial').hasClass('show') || $('#gettrial').is(':visible')) {
            if (e.keyCode === 37) pmsPrevPopup();
            else if (e.keyCode === 39) pmsNextPopup();
          }
        });
      });
    </script>
    <?php }} ?>
	
	<script>
		$('.open-popup-link').magnificPopup({
			type: 'inline',
			midClick: true,
			mainClass: 'mfp-fade'
		});
	</script>
	<script>
		var images = document.getElementsByTagName("img");
		for (var i = 0; i < images.length; i++) {
		  images[i].onmouseover = function() {
			this.style.cursor = "hand";
			this.style.borderColor = "red";
		  };
		  images[i].onmouseout = function() {
			this.style.cursor = "pointer";
			this.style.borderColor = "grey";
		  };
		}
		
		function changeImageOnClick(event) {
		  event = event || window.event;
			var targetElement = event.target || event.srcElement;
			if (targetElement.tagName == "IMG") {
			  document.getElementById("mainImage").src = targetElement.getAttribute("src");
			}
		}
	</script>
	<script>
		$(document).ready(function(){
	
		//how much items per page to show
		var show_per_page = 12; 
		//getting the amount of elements inside pagingBox div
		var number_of_items = $('#myvessel').children().size();
		//calculate the number of pages we are going to have
		var number_of_pages = Math.ceil(number_of_items/show_per_page);
		var last_pages = Math.ceil(number_of_pages - 1);
		
		//set the value of our hidden input fields
		$('#current_page').val(0);
		$('#show_per_page').val(show_per_page);
		
		//now when we got all we need for the navigation let's make it '
		
		/* 
		what are we going to have in the navigation?
			- link to previous page
			- links to specific pages
			- link to next page
		*/
		var navigation_html = '<a class="previous_link" href="javascript:go_to_page(0)">First</a><a class="previous_link" href="javascript:previous();"><img src="upload/vessels/prev.png" width="25"></a>';
		var current_link = 0;
		while(number_of_pages > current_link){
			navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
			current_link++;
		}
		navigation_html += '<a class="next_link" href="javascript:next();"><img src="upload/vessels/next.png" width="25"></a><a class="previous_link" href="javascript:go_to_page(' + last_pages + ')">Last</a>';
		
		$('#page_navigation').html(navigation_html);
		
		//add active_page class to the first page link
		$('#page_navigation .page_link:first').addClass('active_page');
		
		//hide all the elements inside pagingBox div
		$('#myvessel').children().css('display', 'none');
		
		//and show the first n (show_per_page) elements
		$('#myvessel').children().slice(0, show_per_page).css('display', 'inline');
		
	});
	
	function previous(){
		
		new_page = parseInt($('#current_page').val()) - 1;
		//if there is an item before the current active link run the function
		if($('.active_page').prev('.page_link').length==true){
			go_to_page(new_page);
		}
		
	}
	
	function next(){
		new_page = parseInt($('#current_page').val()) + 1;
		//if there is an item after the current active link run the function
		if($('.active_page').next('.page_link').length==true){
			go_to_page(new_page);
		}
		
	}
	function go_to_page(page_num){
		//get the number of items shown per page
		var show_per_page = parseInt($('#show_per_page').val());
		
		//get the element number where to start the slice from
		start_from = page_num * show_per_page;
		
		//get the element number where to end the slice
		end_on = start_from + show_per_page;
		
		//hide all children elements of pagingBox div, get specific items and show them
		$('#myvessel').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
		
		/*get the page link that has longdesc attribute of the current page and add active_page class to it
		and remove that class from previously active page link*/
		$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
		
		//update the current page input field
		$('#current_page').val(page_num);
	}
	
	function validateKTP(){	
		var tombol1 = document.getElementById('btnconfirm');
		var tombol2 = document.getElementById("btnconfirm");
			
		// Allowing file type
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

		var fileInputKtp = document.getElementById('input');
		var filePathKtp = fileInputKtp.value;
		var validKtp = false;

		var fileInputSurat = document.getElementById('inputSurat');
		var filePathSurat = fileInputSurat.value;
		var validSurat = false;
		
		if (!allowedExtensions.exec(filePathKtp)) {
			validKtp = false;
		} else {
			validKtp = true;
		}
		
		if (!allowedExtensions.exec(filePathSurat)) {
			validSurat = false;
		} else {
			validSurat = true;
		}
		
		if(validKtp==false || validSurat==false) {
			alert('Untuk menyelesaikan proses, mohon lampirkan copy kartu identitas dan surat pengantar resmi dalam format .jpg/.jpeg/.png. Terima kasih.');
			tombol1.disabled = true;
			tombol2.classList.add("btnoff");
			
			document.getElementById('fread2').checked =  false;
		}
	}
	</script>
	
	<script>
		//eform ppid progress step wizard
		$(document).ready(function(){
			var current_fs, next_fs, previous_fs; //fieldsets
			var opacity;
			
			$(".next").click(function(){
				
				current_fs = $(this).parent();
				next_fs = $(this).parent().next();
				
				//Add Class Active
				$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
				
				//show the next fieldset
				next_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now) {
						// for making fielset appear animation
						opacity = 1 - now;
			
						current_fs.css({
							'display': 'none',
							'position': 'relative'
						});
						next_fs.css({'opacity': opacity});
					}, 
					duration: 600
				});
			});
			
			$(".previous").click(function(){
				
				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();
				
				//Remove class active
				$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
				
				//show the previous fieldset
				previous_fs.show();
			
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now) {
						// for making fielset appear animation
						opacity = 1 - now;
			
						current_fs.css({
							'display': 'none',
							'position': 'relative'
						});
						previous_fs.css({'opacity': opacity});
					}, 
					duration: 600
				});
			});
			
			$('.radio-group .radio').click(function(){
				$(this).parent().find('.radio').removeClass('selected');
				$(this).addClass('selected');
			});
			
			$(".submit").click(function(){
				return false;
			})
		});
	</script>
	
	<script>
		//eform ppid readme scroll
		window.addEventListener('DOMContentLoaded', () => {
		
		  const observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {
			  const id = entry.target.getAttribute('id');
			  if (entry.intersectionRatio > 0) {
				document.querySelector(`nav li a[href="#${id}"]`).parentElement.classList.add('active');
			  } else {
				document.querySelector(`nav li a[href="#${id}"]`).parentElement.classList.remove('active');
			  }
			});
		  });
		
		  // Track all sections that have an `id` applied
		  document.querySelectorAll('section[id]').forEach((section) => {
			observer.observe(section);
		  });
		  
		});
	</script>
	
	<script>
		$(document).ready(function(){
			var checker = document.getElementById('fread1');
			var sendbtn = document.getElementById('btnstep1');
			var element = document.getElementById("btnstep1");
			// when unchecked or checked, run the function
			checker.onchange = function(){
				if(this.checked){
					sendbtn.disabled = false;
					element.classList.remove("btnoff");
				} else {
					sendbtn.disabled = true;
					element.classList.add("btnoff");
				}
			};
			
			var checker2 = document.getElementById('fread2');
			var okbtn = document.getElementById('btnconfirm');
			var element2 = document.getElementById("btnconfirm");
			checker2.onchange = function(){
				if ($("#msform").valid()) {
					if(this.checked){
						okbtn.disabled = false;
						element2.classList.remove("btnoff");
					} else {
						okbtn.disabled = true;
						element2.classList.add("btnoff");
					}
					validateKTP();
				}
			};
			
			$('#msform').delegate(':input[type="text"]', 'focus', function() {
				checker2.checked = false;
				okbtn.disabled = true;
				element2.classList.add("btnoff");
			});
			$('#msform').delegate(':input[type="radio"]', 'focus', function() {
				checker2.checked = false;
				okbtn.disabled = true;
				element2.classList.add("btnoff");
			});
			
			$(document).on('click', 'input[name="fcara"]', function() {
				//alert($(this).val());
				$('input[name="getcara"]').val($(this).val());
				//alert($('#getcara').val());
			});
			$(document).on('click', 'input[name="fcopy"]', function() {
				//alert($(this).val());
				$('input[name="getcopy"]').val($(this).val());
				//alert($('#getcopy').val());
			});
		});
	</script>
	<script>
		//form validation on next button click
		$(document).ready(function() {
			$("#msform").validate();
		  });
	</script>
	<script type="text/javascript">
		//generate from btn selanjutnya form detail
		var confirm = document.getElementById('btnconfirm');
		confirm.onclick = function(){
			var ynama = $('#fnama').val(),
                yktp = $('#fktp').val(),
                yhp = $('#fhp').val(),
                ytgllahir = $("#ftgllahir").val(),
				ytmplahir = $("#ftmplahir").val(),
				yalamat = $("#falamat").val(),
				ykota = $("#fkota").val(),
				yprovinsi = $("#fprovinsi").val(),
				ykodepos = $("#fkodepos").val(),
				yemail = $("#femail").val(),
				yinfo = $("#finfo").val(),
				yalasan = $("#falasan").val(),
				ycara = $("#getcara").val(),
				ycopy = $("#getcopy").val(),
				yagree = $("#fread2").val(),
				ykartufile 	= $("textarea#gambarkartu").val(),
				ykartufileSurat = $("textarea#gambarSurat").val();
			
				ykartufile = encodeURIComponent(ykartufile);
				ykartufileSurat = encodeURIComponent(ykartufileSurat);
				
            	var dataString = 'ynama='+ ynama + '&yktp='+ yktp + '&yhp='+ yhp +'&ytgllahir=' + ytgllahir +'&ytmplahir=' + ytmplahir +'&yalamat=' + yalamat +'&ykota=' + ykota +'&yprovinsi=' + yprovinsi +'&ykodepos=' + ykodepos +'&yemail=' + yemail +'&yinfo=' + yinfo +'&yalasan=' + yalasan +'&ycara=' + ycara +'&ycopy=' + ycopy +'&yagree=' + yagree + '&ykartufile=' + ykartufile + '&ykartufileSurat=' + ykartufileSurat;

			//alert("Hey, " + ykartufile + "!");
			$("#proceed").hide();
			$("#proceed2").hide();
			$("#succeed").hide();
			$("#datafile").hide();
			$.ajax({
				url: 'ppid/ajax-requestPost',
				type: 'POST',
				data: dataString,
				cache: false,
				processData: false,
				success: function(result) {
					$("#proceed").show();
					setTimeout(function(){
						//$("#hasilnya").html(result);
						$("#proceed").hide();
						$("#succeed").show();
						$("#datafile").show();
						//alert("Record added successfully");
						$("#proceed2").show();
						$.ajax({
							url: './pdfmail.php',
							data: dataString,
							type: 'POST',
							success: function (results)
							{
								$("#datafile").html(results);
							    //alert("works!");
								$("#proceed2").hide();
							}
						});
						
					}, 2000);
					
				}
			});
			
		};
	</script>
	<script type="text/javascript">
		var canvas=document.getElementById("canvas");
		var ctx=canvas.getContext("2d");
		var cw=canvas.width;
		var ch=canvas.height;
		var maxW=500;
		var maxH=500;
		
		var input = document.getElementById('input');
		var output = document.getElementById('gambarkartu');
		input.addEventListener('change', handleFiles);
		
		function handleFiles(e) {
		  var img = new Image;
		  img.onload = function() {
			var iw=img.width;
			var ih=img.height;
			var scale=Math.min((maxW/iw),(maxH/ih));
			var iwScaled=iw*scale;
			var ihScaled=ih*scale;
			canvas.width=iwScaled;
			canvas.height=ihScaled;
			ctx.drawImage(img,0,0,iwScaled,ihScaled);
			output.value = canvas.toDataURL("image/jpeg",1.0);
		  }
		  img.src = URL.createObjectURL(e.target.files[0]);
		}
		var canvasSurat=document.getElementById("canvasSurat");
		var ctxS=canvasSurat.getContext("2d");
		var cwS=canvasSurat.width;
		var chS=canvasSurat.height;
		var maxWS=500;
		var maxHS=500;
		
		var inputSurat = document.getElementById('inputSurat');
		var outputSurat = document.getElementById('gambarSurat');
		inputSurat.addEventListener('change', handleFilesSurat);
		
		function handleFilesSurat(e) {
		  var img = new Image;
		  img.onload = function() {
			var iw=img.width;
			var ih=img.height;
			var scale=Math.min((maxWS/iw),(maxHS/ih));
			var iwScaled=iw*scale;
			var ihScaled=ih*scale;
			canvasSurat.width=iwScaled;
			canvasSurat.height=ihScaled;
			ctxS.drawImage(img,0,0,iwScaled,ihScaled);
			outputSurat.value = canvasSurat.toDataURL("image/jpeg",1.0);
		  }
		  img.src = URL.createObjectURL(e.target.files[0]);
		}
	</script>
	
	<script>
		$(window).scroll(function() {
			if ($(this).scrollTop() > 50 ) {
				$('.scrolltop:hidden').stop(true, true).fadeIn();
			} else {
				$('.scrolltop').stop(true, true).fadeOut();
			}
		});
		$(function(){$(".scroll").click(function(){$("html,body").animate({scrollTop:$(".top").offset().top},"1000");return false})})
	</script>
	<script type="text/javascript" >
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-57302332-1', 'auto');
      ga('send', 'pageview');
    </script>
    <!-- Chatbot Marime -->
    <link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/css/chat-widget.css">
    <script src="<?php echo base_url('/'); ?>assets/js/chat-widget.js" defer></script>
	</body>
</html>

