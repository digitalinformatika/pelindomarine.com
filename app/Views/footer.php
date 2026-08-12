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
	$linkimg = "";
	if (!uri_segment(1)) {
		foreach (($welcome ?? []) as $l) {
			if ($l['status']=="1") {
				$auctionstat = "ON";
				$linkimg = "../main/uploads/".$l['link_file'];
			}
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
	
	<?php
		service('response')->setCookie('pop_status', '1', 3600);
	?>
	<div class="modal fade" id="gettrial" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"  data-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="showpopmini();">
				<img src="images/iclose.png" alt="" title="" width="20">
			</button>
			<div class="modal-body">
			  <a href="https://eproc.pelindo.co.id/app/index/?reqPerusahaan=pms"><img src="<?php echo $linkimg; ?>" alt="" title="" class="img-fluid"></a>
			</div>
			<div class="modal-footer">
			  <img src="images/iclose.png" alt="" title="" width="12"> don't show this message again <?php
			  $popcookie= get_cookie('pop_status');
			  //echo $popcookie;
			  ?>
			</div>
        </div>
      </div>
    </div>
	
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
			if ($auctionstat=="ON") {
	?>
    <script>
      $(document).ready(function(){
        setTimeout(function () { $("#gettrial").modal('show'); }, 1000);
      });
    </script>
    
    <script>
      function showpopmini(){ 
        var mq = window.matchMedia( "(min-width: 500px)" );
        if (mq.matches) {
          $('#pop-mini').toggle();
        } else {
          $('#popmini').toggle();
        }
      }
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

