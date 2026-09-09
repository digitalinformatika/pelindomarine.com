<?php
	//session language
	$weblangs = session('weblang');
	if (strval($weblangs) == "") $weblangs = "english";
?>
<section id="pms-inner-header2" style="background: #204280;">
	<div class="container">
	</div>
</section>

<section id="pms-innerblock-small">
	<div class="container">
		<div class="row animate-box">
			<div class="col-md-12 col-xs-12 text-right">
				<?php if ($weblangs=='english') { ?><div class="breadcumbs2">Home / Company / <b><a href="company/news" class="themeblue">News</a></b></div><?php } ?>
				<?php if ($weblangs=='indonesia') { ?><div class="breadcumbs2">Home / Tentang Kami / <b><a href="company/news" class="themeblue">Berita</a></b></div><?php } ?>
			</div>
		</div>
	</div>
	
	<div class="container animate-box pb-5">
		<div class="row nopadding">
			<div class="col-md-12">
				<h4 class="themeblue titlenewsdet"><?= ($weblangs=='english' && !empty($newsdetail['TITLE'])) ? htmlspecialchars_decode($newsdetail['TITLE'], ENT_QUOTES) : htmlspecialchars_decode($newsdetail['NAMA'], ENT_QUOTES);?></h4>
				<div class="datenews"><?php echo date('l, d M Y', strtotime($newsdetail['TANGGAL'])); ?></div>
				<?php
					// Gambar berita: upload CMS (folder informasi) atau file lama, cadangan nopic
					$nopic  = base_url('upload/news/nopic.png');
					$gambar = media_img_url($newsdetail['LINK_FILE'] ?? null, 'informasi', ['upload/news', 'main/uploads/informasi'], $nopic);
				?>
				<img src="<?php echo esc($gambar); ?>" alt="" title="" class="img-fluid" <?= img_fallback_attr($nopic) ?>>
				<div class="row">
					<div class="col-md-3 mt-5">
						<?php if ($weblangs=='english') { ?>Share this news<br><?php } ?>
						<?php if ($weblangs=='indonesia') { ?>Bagikan berita ini<br><?php } ?>
						<?php
							$ttitle = ucwords(strtolower(htmlspecialchars_decode($newsdetail['NAMA'], ENT_QUOTES)));
							if($weblangs=='english' && !empty($newsdetail['TITLE'])) $ttitle = ucwords(strtolower(htmlspecialchars_decode($newsdetail['TITLE'], ENT_QUOTES)));
							$sharetitle = str_replace(" ", "%20", $ttitle);
							$shareurl = base_url(uri_string());
						?>
						<a href="https://twitter.com/share?url=<?php echo $shareurl; ?>&via=PT_PMS&text=<?php echo $sharetitle; ?>"><img src="images/share1.png" alt="Share Twitter" title="Share Twitter" width="40"></a> &nbsp;&nbsp;
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareurl; ?>&t=<?php echo $sharetitle; ?>"><img src="images/share2.png" alt="Share Facebook" title="Share Facebook" width="40"></a> &nbsp;&nbsp;
						<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $shareurl; ?>"><img src="images/share4.png" alt="Share LinkedIn" title="Share LinkedIn" width="40"></a> 
					</div>
					<div class="col-md-9 mt-5">
                        <?php
						$berita = '';
						if($weblangs=='indonesia') $berita = htmlspecialchars_decode($newsdetail['KETERANGAN'], ENT_QUOTES);
						elseif($weblangs=='english') $berita = htmlspecialchars_decode($newsdetail['DESCRIPTION'], ENT_QUOTES);
						
						if($berita=='') {
							if(!empty($newsdetail['DESCRIPTION'])) $berita = htmlspecialchars_decode($newsdetail['DESCRIPTION'], ENT_QUOTES);
							elseif(!empty($newsdetail['KETERANGAN'])) $berita = htmlspecialchars_decode($newsdetail['KETERANGAN'], ENT_QUOTES);
						}
						
						echo $berita;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="pms-othernews">
	<div class="container animate-box">
		<div class="othernews-head">
			<h4 class="othernews-title"><?php echo ($weblangs=='indonesia') ? 'Berita Lainnya' : 'Other News'; ?></h4>
			<a href="company/news" class="othernews-all"><?php echo ($weblangs=='indonesia') ? 'Lihat Semua' : 'View All'; ?></a>
		</div>
		<div class="row">
			<?php
				$shown = 0;
				foreach ($homenews as $n) {
					if ($n['INFORMASI_ID'] == $newsdetail['INFORMASI_ID']) continue;
					if ($shown >= 6) break;
					$shown++;

					$headline = htmlspecialchars_decode($n['NAMA'], ENT_QUOTES);
					if ($weblangs=='english' && !empty($n['TITLE'])) $headline = htmlspecialchars_decode($n['TITLE'], ENT_QUOTES);

					$nopic = base_url('upload/news/nopic.png');
					$thumb = media_img_url($n['LINK_FILE'] ?? null, 'informasi', ['upload/news', 'main/uploads/informasi'], $nopic);
			?>
			<div class="col-md-4 col-sm-6 col-12 mb-4">
				<a href="company/readnews/<?php echo $n['INFORMASI_ID']; ?>" class="othernews-card">
					<div class="othernews-thumb">
						<img src="<?php echo esc($thumb); ?>" alt="<?php echo strip_tags($headline); ?>" class="img-fluid" <?= img_fallback_attr($nopic) ?>>
					</div>
					<div class="othernews-body">
						<div class="othernews-date"><?php echo date('d M Y', strtotime($n['TANGGAL'])); ?></div>
						<div class="othernews-headline"><?php echo $headline; ?></div>
						<span class="othernews-more"><?php echo ($weblangs=='indonesia') ? 'Lebih Lanjut' : 'Read More'; ?></span>
					</div>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</section>