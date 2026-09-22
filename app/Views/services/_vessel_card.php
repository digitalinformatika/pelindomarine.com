<?php
/**
 * Satu kartu kapal beserta popup detailnya.
 *
 * @var array  $b        Baris tabel kapal.
 * @var string $catLabel Nama jenis kapal sesuai bahasa aktif (dari tabel jenis_kapal).
 * @var string $nopic    URL gambar cadangan.
 */

$popid = $b['KAPAL_ID'];

// Foto utama: upload CMS (folder kapal) atau file lama, cadangan nopic.
$gambar = media_img_url($b['LINK_FILE'], 'kapal', ['upload', 'upload/vessels', 'main/uploads/kapal', 'main/uploads/vessels'], $nopic);

// Foto tambahan untuk thumbnail di popup.
$thumbs = [$gambar];
foreach (['FOTO1', 'FOTO2', 'FOTO3', 'FOTO4'] as $kolom) {
    if (empty($b[$kolom])) {
        continue;
    }
    $thumbs[] = media_img_url($b[$kolom], 'kapal', ['upload/vessels', 'upload', 'main/uploads/kapal', 'main/uploads/vessels'], $nopic);
}

// Baris spesifikasi di popup; label kiri, nilai kanan.
$spesifikasi = [
    'Place'            => $b['PELABUHAN'],
    'Kind of Ship'     => $catLabel,
    'Vessel Name'      => $b['VESSEL_NAME'],
    'Manufacture Year' => $b['YEAR_OF_BUILT'],
    'Engine Power'     => $b['DAYA_ENGINE'],
    'Propulsion'       => $b['PROPULSION'],
];
?>
<div class="col-md-3 col-6" style="display: none;">
   <a href="#popup<?php echo $popid; ?>" class="open-popup-link">
   <div class="vessel-item">
      <div class="wrapimg"><img src="<?php echo esc($gambar); ?>" alt="" title="" class="imgwrap" <?= img_fallback_attr($nopic) ?>></div>
      <div class="tdpadding">
         <div class="biry36 fbold mb-2"><?php echo $b['VESSEL_NAME']; ?></div>
         <div class="robo24"><?php echo esc($catLabel); ?></div>
      </div>
   </div>
   </a>
   <div id="popup<?php echo $popid; ?>" class="white-popup mfp-hide">
      <div class="row">
         <div class="col-md-6 col-12">
            <div class="wrapimage">
               <img src="<?php echo esc($gambar); ?>" class="imgwrap" id="mainImage" <?= img_fallback_attr($nopic) ?>>
            </div>
            <div id="divId" onclick="changeImageOnClick(event);">
               <?php foreach ($thumbs as $thumb) { ?>
               <div class="imgthumbs">
                  <img src="<?php echo esc($thumb); ?>" class="imgwrap imgStyle" <?= img_fallback_attr($nopic) ?>>
               </div>
               <?php } ?>
            </div>
         </div>
         <div class="col-md-6 col-12 fbold">
            <div class="biry24"><?php echo esc($catLabel); ?></div>
            <div class="biry40 fbold mb-4 mt-2 themeblue"><?php echo $b['VESSEL_NAME']; ?></div>
            <?php $baris = 0; ?>
            <?php foreach ($spesifikasi as $label => $nilai) { ?>
            <div class="row <?php echo $baris++ % 2 === 0 ? 'bgpop-detail' : ''; ?>">
               <div class="col-6"><?php echo $label; ?></div>
               <div class="col-6"><?php echo esc((string) $nilai); ?></div>
            </div>
            <?php } ?>
         </div>
      </div>
   </div>
</div>
