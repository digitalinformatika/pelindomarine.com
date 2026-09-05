<?php
	foreach ($webmeta as $m) {
		if ($m['type']=='title') $mtitle = $m['value'];
		if ($m['type']=='keyword') $mkeyword = $m['value'];
		if ($m['type']=='description') $mdesc = $m['value'];
	}
	
	//session language
	$weblangs = session('weblang');
	if ($weblangs=='english') { $menulang = 'ID'; $menulangmob = 'Indonesia'; }
	if ($weblangs=='indonesia') { $menulang = 'ENG'; $menulangmob = 'English'; }
	date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="<?php echo base_url('/'); ?>">
	<title><?php echo $mtitle; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $mdesc; ?>" />
	<meta name="keywords" content="<?php echo $mkeyword; ?>" />
	<meta name="author" content="" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="<?php echo $mtitle; ?>"/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="<?php echo $mtitle; ?>" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />
    <meta name="theme-color" content="#204280" />
    <meta name="google-site-verification" content="4v8BQRjIqgKzk8NMmJ_2wZbqYkaJc9DPrAu5Hb0wn-k" />
	<link rel="shortcut icon" href="<?php echo base_url('/'); ?>theme/2015/image/pms.ico?v=2">
	<link href="https://fonts.googleapis.com/css2?family=Biryani:wght@300;400;600;900&family=Roboto:wght@300;400;900&display=swap" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/css/animate.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/css/flexslider.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/css/magnific-popups.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/js/owl-carousel/owl.carousel.min.css" />
	<link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/css/ptpms2.css?ver=3">

	<!-- Modernizr JS -->
	<script src="<?php echo base_url('/'); ?>assets/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url('/'); ?>assets/js/respond.min.js"></script>
	<![endif]-->
	</head>

	<body>
		<div class='top'></div>
		
		<div id="search-overlay" class="block">
			<div class="centered">
				<div id='search-box'>
				  
				  <img src="images/iclose.png" alt="Close" title="Close" id="close-btn">
				  <form action='<?php echo site_url('search');?>' id='search-form' method='POST' target='_top'>
					  <?php if ($weblangs=='english') { ?><input id='search-text' name='keyword' placeholder='Enter your keyword(s)' type='text' /><?php } ?>
					  <?php if ($weblangs=='indonesia') { ?><input id='search-text' name='keyword' placeholder='Kata kunci pencarian' type='text' /><?php } ?>
					  <input id='search-button' type='submit' value='<?php if ($weblangs=='english') { ?>Search<?php } ?><?php if ($weblangs=='indonesia') { ?>Cari<?php } ?>'>
					  </input>
				  </form>
				</div>
			</div>
		</div>

<div id="pms-page">
	<section id="pms-header">
		<div class="container">
			<nav role="navigation">
				<ul class="pull-left left-menu">
					
				</ul>
				<h1 id="pms-logo" class="animated slideInDown">
                	<a href="<?php echo base_url('/'); ?>"><img src="images/logo.png?ver=3" alt="" title="" width="250"></a>
                </h1>
				<div class="m-marinecare">
					<a href="marine-care" class="btnmarinecare float-right">
						  Marine Care
					</a>
                    
                    <div style="text-align: right; display: block; position: absolute; width: 100%; right: 30px; top: 50px; z-index: 1;">
                        <img src="images/award.png" alt="" title="">
                    </div>
				</div>
				<?php if ($weblangs=='english') { ?>
				<ul class="pull-right right-menu animated slideInDown">
					<li class="d-lg-none d-md-none animated slideInDown"><img src="images/logo.png?ver=3" alt="" title="" width="130"></li>
					<li class="d-lg-none d-md-none">
						<div id='search-box2' style="margin-top: 40px;">
						<form action='<?php echo site_url('search');?>' id='search-form2' method='post' target='_top'>
							<?php if ($weblangs=='english') { ?><input id='search-text2' name='keyword' placeholder='Enter your keyword(s)' type='text' /><?php } ?>
							<?php if ($weblangs=='indonesia') { ?><input id='search-text2' name='keyword' placeholder='Kata kunci pencarian' type='text' /><?php } ?>
							<input id='search-button2' type='submit' value='<?php if ($weblangs=='english') { ?>Search<?php } ?><?php if ($weblangs=='indonesia') { ?>Cari<?php } ?>'>
						</form>
					  </div>
					</li>
					<li class="d-lg-none d-md-none">
						<?php if ($weblangs=='english' || $weblangs=='') { ?>
							<a href="language" class='fbold'>English</a>
							<span class="text-light">|</span>
							<a href="language">Indonesia</a>
						<?php } ?>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle menu-mob" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							Company <img src="images/p-menudrop.png" alt="" width="19" class="deskshow">
						</a>
						<ul class="dropdown-menu animate slideIn">
							<div class="boxed-dropmenu">
								<li class="submenu-mob"><a href="company/about-us">About Us</a></li>
								<li class="submenu-mob"><a href="company/organization-structure">Organization Structure</a></li>
								<li class="submenu-mob"><a href="company/regulatory">Regulatory Frameworks</a></li>
								<li class="submenu-mob"><a href="company/news">News</a></li>
								<li class="submenu-mob"><a href="company/careers">Careers</a></li>
							</div>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle menu-mob" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							Services <img src="images/p-menudrop.png" alt="" width="19" class="deskshow">
						</a>
						<ul class="dropdown-menu animate slideIn">
							<div class="boxed-dropmenu">
								<li class="submenu-mob"><a href="services/vessel">Vessels</a></li>
								<li class="submenu-mob"><a href="services/shipyard">Graving Docks</a></li>
								<li class="submenu-mob"><a href="services/service">Service and Complaints Flow</a></li>
							</div>
						</ul>
					</li>
					<li class="deskshow"><a href="language"><?php echo $menulang; ?></a></li>
					<li class="deskshow">
						<a class="openBtn"><img src="images/isearch.png" alt="Search" title="Search"></a>
					</li>
					<li class="pms-cta-btn deskshow" style="margin-top: 30px;">
						<a href="marine-care">
							  Marine Care
						</a>
					</li>
                    <li class="animated slideInDown"><img src="images/award.png" alt="" title=""></li>
				</ul>
				<?php } ?>
				<?php if ($weblangs=='indonesia') { ?>
				<ul class="pull-right right-menu animated slideInDown">
					<li class="d-lg-none d-md-none animated slideInDown"><img src="images/logo.png?ver=3" alt="" title="" width="130"></li>
					<li class="d-lg-none d-md-none">
						<div id='search-box2' style="margin-top: 40px;">
						<form action='/search' id='search-form2' method='get' target='_top'>
							<?php if ($weblangs=='english') { ?><input id='search-text2' name='q' placeholder='Enter your keyword(s)' type='text' /><?php } ?>
							<?php if ($weblangs=='indonesia') { ?><input id='search-text2' name='q' placeholder='Kata kunci pencarian' type='text' /><?php } ?>
							<button id='search-button2' type='submit'>                     
							<?php if ($weblangs=='english') { ?><span>Search</span><?php } ?>
							<?php if ($weblangs=='indonesia') { ?><span>Cari</span><?php } ?>
							</button>
						</form>
					  </div>
					</li>
					<li class="d-lg-none d-md-none">
						<?php if ($weblangs=='indonesia') { ?>
							<a href="language">English</a>
							<span class="text-light">|</span>
							<a href="language" class='fbold'>Indonesia</a>
						<?php } ?>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle menu-mob" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							Tentang Kami <img src="images/p-menudrop.png" alt="" width="19" class="deskshow">
						</a>
						<ul class="dropdown-menu animate slideIn">
							<div class="boxed-dropmenu">
								<li class="submenu-mob"><a href="company/about-us">Profil</a></li>
								<li class="submenu-mob"><a href="company/organization-structure">Struktur Organisasi</a></li>
								<li class="submenu-mob"><a href="company/regulatory">Regulasi Layanan</a></li>
								<li class="submenu-mob"><a href="company/news">Berita</a></li>
								<li class="submenu-mob"><a href="company/careers">Karir</a></li>
							</div>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle menu-mob" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							Layanan Kami <img src="images/p-menudrop.png" alt="" width="19" class="deskshow">
						</a>
						<ul class="dropdown-menu animate slideIn">
							<div class="boxed-dropmenu">
								<li class="submenu-mob"><a href="services/vessel">Armada</a></li>
								<li class="submenu-mob"><a href="services/shipyard">Fasilitas Pemeliharaan &amp; Perbaikan Kapal</a></li>
								<li class="submenu-mob"><a href="services/service">Alur Layanan dan Pengaduan</a></li>
							</div>
						</ul>
					</li>
					<li class="deskshow"><a href="language"><?php echo $menulang; ?></a></li>
					<li class="deskshow">
						<a class="openBtn"><img src="images/isearch.png" alt="Search" title="Search"></a>
					</li>
					<li class="pms-cta-btn deskshow" style="margin-top: 30px;">
						<a href="marine-care">
							  Marine Care
						</a>
					</li>
                    <li class="animated slideInDown"><img src="images/award.png" alt="" title=""></li>
				</ul>
				<?php } ?>
			</nav>
		</div>
	</section>
	<!-- #pms-header -->

