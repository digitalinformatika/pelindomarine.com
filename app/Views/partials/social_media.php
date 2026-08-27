<?php
// Section "Media Sosial" — embed resmi (IG post, FB Page Plugin, YouTube),
// dibungkus kartu bergaya modern. Konfigurasi akun di app/Config/Pelindo.php
$social   = config('Pelindo');
$weblangs = session('weblang');

// Ikon inline SVG (tidak bergantung icon font)
$svgInstagram = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.2 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.2 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.2-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.2-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2m0-2.2C8.7 0 8.3 0 7 .1 5.7.1 4.9.3 4.1.6c-.8.3-1.5.7-2.1 1.4C1.3 2.6.9 3.3.6 4.1.3 4.9.1 5.7.1 7 0 8.3 0 8.7 0 12s0 3.7.1 5c0 1.3.2 2.1.5 2.9.3.8.7 1.5 1.4 2.1.6.6 1.3 1.1 2.1 1.4.8.3 1.6.5 2.9.5 1.3.1 1.7.1 5 .1s3.7 0 5-.1c1.3 0 2.1-.2 2.9-.5.8-.3 1.5-.7 2.1-1.4.6-.6 1.1-1.3 1.4-2.1.3-.8.5-1.6.5-2.9.1-1.3.1-1.7.1-5s0-3.7-.1-5c0-1.3-.2-2.1-.5-2.9-.3-.8-.7-1.5-1.4-2.1C21.4 1.3 20.7.9 19.9.6c-.8-.3-1.6-.5-2.9-.5C15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4 6.2 6.2 0 0 0 0-12.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.9a1.4 1.4 0 1 0 0 2.9 1.4 1.4 0 0 0 0-2.9z"/></svg>';
$svgYoutube   = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31.3 31.3 0 0 0 0 12c0 2 .2 3.9.5 5.8a3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1c.3-1.9.5-3.8.5-5.8s-.2-3.9-.5-5.8zM9.5 15.6V8.4L15.8 12l-6.3 3.6z"/></svg>';
$svgFacebook  = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12a12 12 0 1 0-13.9 11.9v-8.4h-3V12h3V9.4c0-3 1.8-4.7 4.6-4.7 1.3 0 2.7.2 2.7.2v3h-1.5c-1.5 0-2 .9-2 1.9V12h3.3l-.5 3.5h-2.8v8.4A12 12 0 0 0 24 12z"/></svg>';
$svgLinkedin  = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.4 20.5h-3.6v-5.6c0-1.3 0-3-1.9-3s-2.1 1.4-2.1 2.9v5.7H9.3V9h3.4v1.6c.5-.9 1.7-1.9 3.4-1.9 3.6 0 4.3 2.4 4.3 5.5v6.3zM5.3 7.4a2.1 2.1 0 1 1 0-4.1 2.1 2.1 0 0 1 0 4.1zM7.1 20.5H3.5V9h3.6v11.5zM22.2 0H1.8C.8 0 0 .8 0 1.7v20.5c0 1 .8 1.8 1.8 1.8h20.4c1 0 1.8-.8 1.8-1.8V1.7c0-1-.8-1.7-1.8-1.7z"/></svg>';
$svgX         = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.2 2.3h3.3l-7.3 8.3 8.6 11.1h-6.7l-5.3-6.8-6 6.8H1.5l7.8-8.9L1 2.3h6.9l4.8 6.2 5.5-6.2zm-1.2 17.5h1.8L7 4.1H5l12 15.7z"/></svg>';
?>
<link rel="stylesheet" href="<?php echo base_url('/'); ?>assets/css/social-media.css?v=4">
<section id="pms-socialmedia">
	<div class="pmsoc-container">
		<div class="pmsoc-heading">
			<?php if ($weblangs=='english') { ?>
			<h5 class="themeblue fbiryani">Follow Our Journey</h5>
			<p class="themeblue">Stay connected with the latest updates from Pelindo Marine on social media</p>
			<?php } else { ?>
			<h5 class="themeblue fbiryani">Ikuti Perjalanan Kami</h5>
			<p class="themeblue">Tetap terhubung dengan kabar terbaru Pelindo Marine di media sosial</p>
			<?php } ?>

			<div class="pmsoc-pills">
				<a href="https://www.instagram.com/<?= esc($social->instagramUser, 'attr') ?>/" target="_blank" rel="noopener" class="pmsoc-pill pmsoc-pill-ig"><?= $svgInstagram ?> Instagram</a>
				<a href="<?= esc($social->youtubeUrl, 'attr') ?>" target="_blank" rel="noopener" class="pmsoc-pill pmsoc-pill-yt"><?= $svgYoutube ?> YouTube</a>
				<a href="<?= esc($social->facebookPageUrl, 'attr') ?>" target="_blank" rel="noopener" class="pmsoc-pill pmsoc-pill-fb"><?= $svgFacebook ?> Facebook</a>
				<a href="<?= esc($social->linkedinUrl, 'attr') ?>" target="_blank" rel="noopener" class="pmsoc-pill pmsoc-pill-in"><?= $svgLinkedin ?> LinkedIn</a>
				<a href="<?= esc($social->twitterUrl, 'attr') ?>" target="_blank" rel="noopener" class="pmsoc-pill pmsoc-pill-x"><?= $svgX ?> X</a>
			</div>
		</div>

		<div class="pmsoc-scrollwrap">
			<button type="button" class="pmsoc-arrow pmsoc-arrow-left" aria-label="<?= $weblangs=='english' ? 'Scroll left' : 'Geser ke kiri' ?>">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
			</button>
			<button type="button" class="pmsoc-arrow pmsoc-arrow-right" aria-label="<?= $weblangs=='english' ? 'Scroll right' : 'Geser ke kanan' ?>">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
			</button>
			<div class="pmsoc-fade pmsoc-fade-left"></div>
			<div class="pmsoc-fade pmsoc-fade-right"></div>
		<div class="pmsoc-scroller">
			<!-- YouTube: playlist upload channel, otomatis video terbaru -->
			<div class="pmsoc-item">
				<div class="pmsoc-card">
					<div class="pmsoc-card-head">
						<span class="pmsoc-badge pmsoc-badge-yt"><?= $svgYoutube ?></span>
						<span>YouTube</span>
					</div>
					<div class="pmsoc-embed pmsoc-embed-video">
						<iframe loading="lazy"
							src="https://www.youtube.com/embed/videoseries?list=UU<?= esc(substr($social->youtubeChannelId, 2), 'attr') ?>"
							title="Pelindo Marine YouTube"
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
							allowfullscreen></iframe>
					</div>
				</div>
			</div>

			<!-- Instagram: embed post resmi (bila dikonfigurasi), else kartu profil -->
			<div class="pmsoc-item">
				<div class="pmsoc-card">
					<div class="pmsoc-card-head">
						<span class="pmsoc-badge pmsoc-badge-ig"><?= $svgInstagram ?></span>
						<span>Instagram</span>
					</div>
					<div class="pmsoc-embed">
						<?php if ($social->instagramPostUrl !== '') { ?>
						<blockquote class="instagram-media" data-instgrm-captioned
							data-instgrm-permalink="<?= esc($social->instagramPostUrl, 'attr') ?>"
							data-instgrm-version="14" style="margin:0 auto; width:100%;"></blockquote>
						<script async defer src="https://www.instagram.com/embed.js"></script>
						<?php } else { ?>
						<a class="pmsoc-profilecard pmsoc-igcard" href="https://www.instagram.com/<?= esc($social->instagramUser, 'attr') ?>/" target="_blank" rel="noopener">
							<span class="pmsoc-profileicon pmsoc-igicon"><?= $svgInstagram ?></span>
							<b>@<?= esc($social->instagramUser) ?></b>
							<span><?= $weblangs=='english' ? 'See our latest photos & reels' : 'Lihat foto & reels terbaru kami' ?></span>
						</a>
						<?php } ?>
					</div>
				</div>
			</div>

			<!-- Facebook Page Plugin: timeline resmi -->
			<div class="pmsoc-item">
				<div class="pmsoc-card">
					<div class="pmsoc-card-head">
						<span class="pmsoc-badge pmsoc-badge-fb"><?= $svgFacebook ?></span>
						<span>Facebook</span>
					</div>
					<div class="pmsoc-embed pmsoc-embed-fb">
						<iframe loading="lazy"
							src="https://www.facebook.com/plugins/page.php?href=<?= urlencode($social->facebookPageUrl) ?>&tabs=timeline&width=340&height=420&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=false"
							title="Pelindo Marine Facebook"
							width="340" height="420"
							allow="encrypted-media"></iframe>
					</div>
				</div>
			</div>

			<!-- X (Twitter): timeline embed resmi -->
			<div class="pmsoc-item">
				<div class="pmsoc-card">
					<div class="pmsoc-card-head">
						<span class="pmsoc-badge pmsoc-badge-x"><?= $svgX ?></span>
						<span>X (Twitter)</span>
					</div>
					<div class="pmsoc-embed">
						<a class="twitter-timeline" data-height="396" data-dnt="true"
							href="<?= esc($social->twitterUrl, 'attr') ?>">Tweets by @pelindomarines</a>
						<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
				</div>
			</div>

			<!-- LinkedIn: tidak menyediakan embed timeline — kartu profil branded -->
			<div class="pmsoc-item">
				<div class="pmsoc-card">
					<div class="pmsoc-card-head">
						<span class="pmsoc-badge pmsoc-badge-in"><?= $svgLinkedin ?></span>
						<span>LinkedIn</span>
					</div>
					<div class="pmsoc-embed">
						<a class="pmsoc-profilecard pmsoc-incard" href="<?= esc($social->linkedinUrl, 'attr') ?>" target="_blank" rel="noopener">
							<span class="pmsoc-profileicon pmsoc-inicon"><?= $svgLinkedin ?></span>
							<b>PT Pelindo Marine</b>
							<span><?= $weblangs=='english' ? 'Follow our company updates & careers' : 'Ikuti kabar perusahaan & info karir kami' ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>
<script>
(function () {
	var wrap = document.querySelector('#pms-socialmedia .pmsoc-scrollwrap');
	if (!wrap) return;
	var scroller = wrap.querySelector('.pmsoc-scroller');
	var leftBtn  = wrap.querySelector('.pmsoc-arrow-left');
	var rightBtn = wrap.querySelector('.pmsoc-arrow-right');

	// Geser selebar satu kartu (item + gap)
	function step() {
		var item = scroller.querySelector('.pmsoc-item');
		return item ? item.offsetWidth + 20 : 400;
	}

	// Tampilkan/sembunyikan panah & fade sesuai posisi scroll
	function update() {
		var max = scroller.scrollWidth - scroller.clientWidth - 2;
		var atStart = scroller.scrollLeft <= 2;
		var atEnd = scroller.scrollLeft >= max;
		leftBtn.classList.toggle('pmsoc-arrow-hidden', atStart);
		rightBtn.classList.toggle('pmsoc-arrow-hidden', atEnd);
		wrap.classList.toggle('pmsoc-at-start', atStart);
		wrap.classList.toggle('pmsoc-at-end', atEnd);
	}

	leftBtn.addEventListener('click', function () {
		scroller.scrollBy({ left: -step(), behavior: 'smooth' });
	});
	rightBtn.addEventListener('click', function () {
		scroller.scrollBy({ left: step(), behavior: 'smooth' });
	});
	scroller.addEventListener('scroll', update, { passive: true });
	window.addEventListener('resize', update);
	update();
})();
</script>
