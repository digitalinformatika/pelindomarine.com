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
				<?php if ($weblangs=='english') { ?><div class="breadcumbs2">Home / <b>Search</b></div><?php } ?>
				<?php if ($weblangs=='indonesia') { ?><div class="breadcumbs2">Home / <b>Cari</b></div><?php } ?>
			</div>
		</div>
	</div>
	
	<div class="container animate-box">
		<div class="row nopadding">
				<div class="col-md-12 mt-3">
					<?php if ($weblangs=='english') { ?>
					<div class="biry72 themeorg fbolds mt-5">Search Result</div>
					<p style="font-weight: 400" class="biry36">Keyword(s): <b><?php echo $fkeyword; ?></b></p>
					<?php } ?>
					<?php if ($weblangs=='indonesia') { ?>
					<div class="biry72 themeorg fbolds mt-5">Hasil Pencarian</div>
					<p style="font-weight: 400" class="biry36">Kata Kunci: <b><?php echo $fkeyword; ?></p>
					<?php } ?>
				</div>
				<div class="col-md-12 mt-3">
					<?php
						foreach ($searchresult as $s) {
					?>
					<a href="company/readnews/<?php echo $s['INFORMASI_ID']; ?>" class="linksnews2"><h5 style="margin-bottom: 0px;"><?php echo ucwords(strtolower(htmlspecialchars_decode($s['NAMA'], ENT_QUOTES))); ?></h5></a>
					<div class="themeorg mb-3"><?php echo date('l d M Y', strtotime($s['TANGGAL'])); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>