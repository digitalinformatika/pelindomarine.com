<?php
   // friendlyURL() kini ada di app/Helpers/site_helper.php
   //session language
   $weblangs = session('weblang');
   if (strval($weblangs) == "") $weblangs = "english";

   $isEn  = $weblangs === 'english';
   $nopic = base_url('upload/news/nopic.png');

   // --- Kategori kapal, seluruhnya dari tabel jenis_kapal -------------------
   // NAMA = nama Inggris, KETERANGAN = nama Indonesia, FOTO = gambar kategori.
   // Slug URL selalu diambil dari nama Inggris supaya tautan tidak berubah
   // saat pengunjung berganti bahasa.
   $kategori = [];
   foreach ($vesselcat as $vc) {
       $kid    = (string) $vc['JENIS_KAPAL_ID'];
       $namaEn = trim((string) $vc['NAMA']);
       $namaId = trim((string) ($vc['KETERANGAN'] ?? ''));

       $kategori[$kid] = [
           'id'       => $kid,
           'slug'     => friendlyURL($namaEn),
           // Tautan bahasa Indonesia dulu memakai slug dari KETERANGAN;
           // tetap dikenali supaya tautan lama tidak mati.
           'slug_lama' => $namaId !== '' ? friendlyURL($namaId) : '',
           'label'    => $isEn ? $namaEn : ($namaId !== '' ? $namaId : $namaEn),
           'foto'     => media_img_url($vc['FOTO'] ?? null, 'jenis_kapal', ['upload'], $nopic),
       ];
   }

   // --- Jumlah kapal per kategori, dihitung dari tabel kapal ----------------
   $jumlah = array_fill_keys(array_keys($kategori), 0);
   foreach ($vessels as $v) {
       $jk = (string) $v['JENIS_KAPAL_ID'];
       if (isset($jumlah[$jk])) {
           $jumlah[$jk]++;
       }
   }
   $total = count($vessels);

   // --- Kategori dan region yang sedang dibuka ------------------------------
   $slugAktif   = (string) uri_segment(3);
   $regionAktif = (string) uri_segment(4);

   $katAktif = null;
   foreach ($kategori as $k) {
       if ($k['slug'] === $slugAktif || ($k['slug_lama'] !== '' && $k['slug_lama'] === $slugAktif)) {
           $katAktif = $k;
           break;
       }
   }

   // Daftar region ikut data kapal, bukan daftar tetap.
   $regions = [];
   foreach ($vessels as $v) {
       $r = trim((string) ($v['REGION'] ?? ''));
       if ($r !== '') {
           $regions[strtolower($r)] = $r;
       }
   }
   ksort($regions);

   // Lebar kotak statistik menyesuaikan jumlah kategori (+1 untuk total).
   $kolomStat = max(2, (int) floor(12 / max(1, count($kategori) + 1)));

   // Kategori diredupkan saat salah satunya sedang dipilih.
   $redup = $slugAktif !== '';
   ?>
<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/vessel-bgheader.jpg);">
   <div class="container">
      <div class="row animate-box breadcumb-box">
         <div class="col-md-6 col-xs-12" style="">
            <h5><?php echo $isEn ? 'Services' : 'Layanan Kami'; ?></h5>
            <h2><?php echo $isEn ? 'VESSEL' : 'ARMADA'; ?></h2>
         </div>
         <div class="col-md-6 col-xs-12 text-right">
            <div class="breadcumbs">Home / <?php echo $isEn ? 'Services' : 'Layanan Kami'; ?> / <b><a href="services/vessel" class="text-light"><?php echo $isEn ? 'Vessel' : 'Armada'; ?></a></b></div>
         </div>
      </div>
   </div>
</section>
<section id="pms-innerblock">
   <div class="container-fluid animate-box" style="background: #204280; margin-top: -80px;">
      <div class="container pb-5">
         <div class="row">
            <div class="col-md-12 mt-3">
               <?php foreach ($kategori as $k) { ?>
               <a href="services/vessel/<?php echo $k['slug']; ?>" class="breadcumbs filter-button"><?php echo esc($k['label']); ?> </a> <span class="breadcumbs">/ </span>
               <?php } ?>
            </div>

            <div class="col-md-<?php echo $kolomStat; ?> col-6 mt-5">
               <div class="box-stats">
                  <span class="stats-value torange"><?php echo $total; ?></span><br>
                  <span class="stats-cats torange"><?php echo $isEn ? 'Boats Total' : 'Jumlah Kapal'; ?></span>
               </div>
            </div>
            <?php foreach ($kategori as $k) { ?>
            <div class="col-md-<?php echo $kolomStat; ?> col-6 mt-5">
               <div class="box-stats">
                  <span class="stats-value"><?php echo $jumlah[$k['id']]; ?></span><br>
                  <span class="stats-cats"><?php echo esc($k['label']); ?></span>
               </div>
            </div>
            <?php } ?>
         </div>
      </div>
   </div>
   <div class="container animate-box" style="margin-top: -120px;">
      <div class="row">
         <?php foreach ($kategori as $k) { ?>
         <?php $aktif = $katAktif !== null && $katAktif['id'] === $k['id']; ?>
         <?php $kelasRedup = $redup ? ('graying' . ($aktif ? ' nograying' : '')) : ''; ?>
         <div class="col-md-4 gallery_product filter 1">
            <div class="vessel-item">
               <a href="services/vessel/<?php echo $k['slug']; ?>">
               <img src="<?php echo esc($k['foto']); ?>" class="img-fluid <?php echo $kelasRedup; ?>" <?= img_fallback_attr($nopic) ?>>
               <div class="tdpadding">
                  <div class="biry40 fbold text-center mb-2 <?php echo $kelasRedup; ?>">
                     <?php echo esc($k['label']); ?>
                  </div>
               </div>
               </a>
            </div>
         </div>
         <?php } ?>
      </div>

      <?php if ($slugAktif !== 'result' and $katAktif !== null) { ?>
      <div class="row">
         <div class="col-md-4 col-sm-12 mb-5">
            <?php foreach ($regions as $slugRegion => $namaRegion) { ?>
            <a href="services/vessel/<?php echo $katAktif['slug']; ?>/<?php echo $slugRegion; ?>" class="btnfilter <?php if (strtolower($regionAktif) === $slugRegion) echo 'filteractive'; ?>"><?php echo esc($namaRegion); ?></a>
            <?php } ?>
         </div>
         <div class="col-md-8 col-sm-12 mb-5">
            <form class="form-search form-inline" method="post" action="./services/vessel/result">
               <div class="">
                   <input type="text" class="search-query" placeholder="<?php echo $isEn ? 'Enter your keyword' : 'Masukkan kata kunci'; ?>" name="keyword" />
                   <button type="submit" class="btn btn-primary"><?php echo $isEn ? 'Search' : 'Cari'; ?></button>
               </div>
            </form>
         </div>

         <input type='hidden' id='current_page' />
         <input type='hidden' id='show_per_page' />
         <div class="container">
            <div class="row" id="myvessel">
               <?php foreach ($vessels as $b) { ?>
               <?php
                  if ((string) $b['JENIS_KAPAL_ID'] !== $katAktif['id']) {
                      continue;
                  }
                  if ($regionAktif !== '' && strtolower(trim((string) ($b['REGION'] ?? ''))) !== strtolower($regionAktif)) {
                      continue;
                  }

                  echo view('services/_vessel_card', [
                      'b'        => $b,
                      'catLabel' => $katAktif['label'],
                      'nopic'    => $nopic,
                  ]);
               ?>
               <?php } ?>
            </div>
         </div>
         <div class="col-md-12 mb-5">
            <center><div id='page_navigation'></div></center>
         </div>
      </div>
      <?php } ?>

      <?php if ($slugAktif === 'result') { ?>
      <div class="row">
         <div class="col-md-6 col-sm-12 mb-5">
            <form class="form-search form-inline" method="post" action="./services/vessel/result" style="margin-left: 0 !important;">
               <div class="">
                   <input type="text" class="search-query" placeholder="<?php echo $isEn ? 'Enter your keyword' : 'Masukkan kata kunci'; ?>" name="keyword" />
                   <button type="submit" class="btn btn-primary"><?php echo $isEn ? 'Search' : 'Cari'; ?></button>
               </div>
            </form>
         </div>
         <div class="col-md-6 col-sm-12 text-right mb-5">
            <?php echo $isEn ? 'Search result for' : 'Hasil pencarian untuk'; ?>: <b><i><?php echo esc((string) $fkeyword); ?></i>,
            <?php echo count($searchresult); ?>
            <?php echo $isEn ? 'vessel(s) found.' : 'kapal ditemukan.'; ?>
            </b>
         </div>

         <input type='hidden' id='current_page' />
         <input type='hidden' id='show_per_page' />
         <div class="container">
            <div class="row" id="myvessel">
               <?php foreach ($searchresult as $b) { ?>
               <?php
                  $kat = $kategori[(string) $b['JENIS_KAPAL_ID']] ?? null;

                  echo view('services/_vessel_card', [
                      'b'        => $b,
                      'catLabel' => $kat['label'] ?? '',
                      'nopic'    => $nopic,
                  ]);
               ?>
               <?php } ?>
            </div>
         </div>
         <div class="col-md-12 mb-5">
            <center><div id='page_navigation'></div></center>
         </div>
      </div>
      <?php } ?>
   </div>
</section>
