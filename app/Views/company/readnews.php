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
					if (!file_exists("upload/news/".$newsdetail['LINK_FILE'])) $gambar = "upload/news/nopic.png";
					if (file_exists("main/uploads/informasi/".$newsdetail['LINK_FILE'])) $gambar = "main/uploads/informasi/".$newsdetail['LINK_FILE'];
				?>
				<img src="<?php echo $gambar; ?>" alt="" title="" class="img-fluid">
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

<section id="pms-innerblock-small">
	<div class="container-fluid" style="background: #ff8600; min-height: 150px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="owl-carousel newsslides">
						<?php
							foreach ($homenews as $n) {
						?>
						<div class="item">
							<div class="titlenews3"><a href="company/readnews/<?php echo $n['INFORMASI_ID']; ?>" class="themeblue">
							<?php
							$headline = htmlspecialchars_decode($n['NAMA'], ENT_QUOTES);
							if ($weblangs=='english' && !empty($n['TITLE'])) $headline = htmlspecialchars_decode($n['TITLE'], ENT_QUOTES);
							echo $headline;
							?>
                            </a></div>
							<div class="datenews3"><?php echo date('l, d M Y', strtotime($n['TANGGAL'])); ?></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>