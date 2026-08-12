<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
	
	function truncate($text, $length) {
        $length = abs((int)$length);
        if(strlen($text) > $length) {
           $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...</span></font></p>', $text);
        }
        return($text);
     }
?>
<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/news-bgheader.jpg?v=202305101700);">
	<div class="container">
	    <?php if ($weblangs=='indonesia') { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5>Tentang Kami</h5>
				<h2>BERITA</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Tentang Kami / <b><a href="company/news" class="text-light">Berita</a></b></div>
			</div>
		</div>
		<?php } else { ?>
		<div class="row animate-box breadcumb-box">
			<div class="col-md-6 col-xs-12">
				<h5>Company</h5>
				<h2>NEWS</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right">
				<div class="breadcumbs">Home / Company / <b><a href="company/news" class="text-light">News</a></b></div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<section id="pms-innerblock">
<div class="container animate-box" style="background: #fff; margin-top: -80px;">
	<?php if (uri_segment(3)=="") { ?>
	<div class="row sectionnews" style="padding-top: 40px;">
		<?php foreach ($newstop as $t) { ?>
		<div class="col-md-6 col-12 tdpadright">
				<a href="company/readnews/<?php echo $t['INFORMASI_ID']; ?>" class="linksnews2"><h4 class="themeblue titlenews"><?= (($weblangs=='indonesia') ? htmlspecialchars_decode($t['NAMA'], ENT_QUOTES) : htmlspecialchars_decode($t['TITLE'], ENT_QUOTES));?></h4></a>
				<div class="datenews"><?php echo date('l, d M Y', strtotime($t['TANGGAL'])); ?></div>
				<p align="justify">
					<?= (($weblangs=='indonesia') ? truncate($t['KETERANGAN'], 330) : truncate($t['DESCRIPTION'], 330)); ?>
				</p>
				<?php if ($weblangs=='indonesia') { ?><a href="company/readnews/<?php echo $t['INFORMASI_ID']; ?>" class="linksnewstop">Lebih Lanjut</a>
				<?php } else { ?><a href="company/readnews/<?php echo $t['INFORMASI_ID']; ?>" class="linksnewstop">Read More</a><?php } ?>
		</div>
		<div class="col-md-6 col-12">
			<?php
				if (!file_exists("upload/news/".$t['LINK_FILE'])) $gambar = "upload/news/nopic.png";
				if (file_exists("main/uploads/informasi/".$t['LINK_FILE'])) $gambar = "main/uploads/informasi/".$t['LINK_FILE'];
			?>
			<img src="<?php echo $gambar; ?>" alt="" title="" class="img-fluid">
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	
	<div class="row sectionnews pt-5">
		<?php
			$no = (int) uri_segment(3) + 1;
			foreach ($newslist as $n) {
				if ($n['STATUS_AKTIF']=='1') {
		?>
		<div class="col-md-4 col-6 mb-5">
			<div class="boxed-news">
				<?php
					if (!file_exists("upload/news/".$n['LINK_FILE'])) $gambar = "upload/news/nopic.png";
					//if (file_exists("upload/news/".$n['LINK_FILE'])) $gambar = "upload/news/".$n['LINK_FILE'];
					if (file_exists("main/uploads/informasi/".$n['LINK_FILE'])) $gambar = "main/uploads/informasi/".$n['LINK_FILE'];
				?>
				<div class="wrapimg">
					<img src="https://pelindomarine.com/main/uploads/informasi/<?php echo $n['LINK_FILE']; ?>" alt="" title="" class="img-fluid">
				</div>
				<div class="shortdesc-box">
					<a href="<?php echo $gambar; ?>" class="linksnews2"><div class="titlenews2"><?= (($weblangs=='indonesia') ? htmlspecialchars_decode($n['NAMA'], ENT_QUOTES) : htmlspecialchars_decode($n['TITLE'], ENT_QUOTES));?></div></a>
					<div class="datenews2"><?php echo date('l, d M Y', strtotime($n['TANGGAL'])); ?></div>
					<?php if ($weblangs=='indonesia') { ?><a href="company/readnews/<?php echo $n['INFORMASI_ID']; ?>" class="linksnews2">Lebih Lanjut</a>
					<?php } else { ?><a href="company/readnews/<?php echo $n['INFORMASI_ID']; ?>" class="linksnews2">Read More</a><?php } ?>
				</div>
			</div>
		</div>
		<?php }} ?>
		<div class="col-md-12 mt-4 mb-5 text-center">
			<?php 
				echo $pagerLinks;
			?>
		</div>
	</div>
</div>
</section>