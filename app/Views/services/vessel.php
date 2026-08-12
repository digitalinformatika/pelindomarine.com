<?php
   // friendlyURL() kini ada di app/Helpers/site_helper.php
   //session language
   $weblangs = session('weblang');
   if (strval($weblangs) == "") $weblangs = "english";
   
   ?>
<section id="pms-inner-header" style="background-image: url(<?php echo base_url('/'); ?>upload/vessel-bgheader.jpg);">
   <div class="container">
      <?php if ($weblangs=='english') { ?>
      <div class="row animate-box breadcumb-box">
         <div class="col-md-6 col-xs-12" style="">
            <h5>Services</h5>
            <h2>VESSEL</h2>
         </div>
         <div class="col-md-6 col-xs-12 text-right">
            <div class="breadcumbs">Home / Services / <b><a href="services/vessel" class="text-light">Vessel</a></b></div>
         </div>
      </div>
      <?php } ?>
      <?php if ($weblangs=='indonesia') { ?>
      <div class="row animate-box breadcumb-box">
         <div class="col-md-6 col-xs-12" style="">
            <h5>Layanan Kami</h5>
            <h2>ARMADA</h2>
         </div>
         <div class="col-md-6 col-xs-12 text-right">
            <div class="breadcumbs">Home / Layanan Kami / <b><a href="services/vessel" class="text-light">Armada</a></b></div>
         </div>
      </div>
      <?php } ?>
   </div>
</section>
<section id="pms-innerblock">
   <div class="container-fluid animate-box" style="background: #204280; margin-top: -80px;">
      <div class="container pb-5">
         <div class="row">
            <div class="col-md-12 mt-3">
               <?php if ($weblangs=='english') { ?>
               <?php foreach ($vesselcat as $vc) { ?>
               <a href="services/vessel/<?php echo friendlyURL($vc['NAMA']); ?>" class="breadcumbs filter-button"><?php echo $vc['NAMA']; ?> </a> <span class="breadcumbs">/ </span>
               <?php } ?>
               <?php } ?>
               <?php if ($weblangs=='indonesia') { ?>
               <?php foreach ($vesselcat as $vc) { ?>
               <a href="services/vessel/<?php echo friendlyURL($vc['KETERANGAN']); ?>" class="breadcumbs filter-button"><?php echo $vc['KETERANGAN']; ?> </a> <span class="breadcumbs">/ </span>
               <?php } ?>
               <?php } ?>
            </div>
            <?php
               $total = 0;
               
               $tug = 0;
               
               $pilot = 0;
               
               $other = 0;
               
               foreach ($vessels as $v) {
               
               	$total++;
               
               	if ($v['JENIS_KAPAL_ID']=='1') $tug++;
               
               	if ($v['JENIS_KAPAL_ID']=='2') $pilot++;
               
               	if ($v['JENIS_KAPAL_ID']=='4') $other++;
               
               }
			   
			   $total = 191;
			   $tug = 74;
			   $pilot = 112;
			   $other = 5;
               
               ?>
            <div class="col-md-3 col-6 mt-5">
               <div class="box-stats">
                  <span class="stats-value torange"><?php echo $total; ?></span><br>
                  <?php if ($weblangs=='english') { ?><span class="stats-cats torange">Boats Total</span><?php } ?>
                  <?php if ($weblangs=='indonesia') { ?><span class="stats-cats torange">Jumlah Kapal</span><?php } ?>
               </div>
            </div>
            <div class="col-md-3 col-6 mt-5">
               <div class="box-stats">
                  <span class="stats-value"><?php echo $tug; ?></span><br>
                  <?php if ($weblangs=='english') { ?><span class="stats-cats">Tug Boats</span><?php } ?>
                  <?php if ($weblangs=='indonesia') { ?><span class="stats-cats">Kapal Tunda</span><?php } ?>
               </div>
            </div>
            <div class="col-md-3  col-6 mt-5">
               <div class="box-stats">
                  <span class="stats-value"><?php echo $pilot; ?></span><br>
                  <?php if ($weblangs=='english') { ?><span class="stats-cats">Pilot Boats</span><?php } ?>
                  <?php if ($weblangs=='indonesia') { ?><span class="stats-cats">Kapal Pandu</span><?php } ?>
               </div>
            </div>
            <div class="col-md-3 col-6 mt-5">
               <div class="box-stats">
                  <span class="stats-value"><?php echo $other; ?></span><br>
                  <?php if ($weblangs=='english') { ?><span class="stats-cats">Other Vessels</span><?php } ?>
                  <?php if ($weblangs=='indonesia') { ?><span class="stats-cats">Lain-lain</span><?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container animate-box" style="margin-top: -120px;">
      <div class="row">
         <?php foreach ($vesselcat as $vc) { ?>
         <div class="col-md-4 gallery_product filter 1">
            <div class="vessel-item">
               <a href="services/vessel/<?php echo friendlyURL($vc['NAMA']); ?>">
               <?php if (empty(uri_segment(3))) { ?>
               <img src="upload/<?php echo $vc['FOTO']; ?>" class="img-fluid">
               <?php } ?>
               <?php if (!empty(uri_segment(3))) { ?>
               <img src="upload/<?php echo $vc['FOTO']; ?>" class="graying img-fluid <?php if (uri_segment(3)==friendlyURL($vc['NAMA'])) echo 'nograying'; ?>">
               <?php } ?>
               
               <div class="tdpadding">
                  <?php if (empty(uri_segment(3))) { ?>
                  <div class="biry40 fbold text-center mb-2">
                     <?php if ($weblangs=='english') { ?><?php echo $vc['NAMA']; ?><?php } ?>
                     <?php if ($weblangs=='indonesia') { ?><?php echo $vc['KETERANGAN']; ?><?php } ?>
                  </div>
                  <?php } ?>
                  <?php if (!empty(uri_segment(3))) { ?>
                  <div class="biry40 fbold text-center graying mb-2 <?php if (uri_segment(3)==friendlyURL($vc['NAMA'])) echo 'nograying'; ?>">
                     <?php if ($weblangs=='english') { ?><?php echo $vc['NAMA']; ?><?php } ?>
                     <?php if ($weblangs=='indonesia') { ?><?php echo $vc['KETERANGAN']; ?><?php } ?>
                  </div>
                  <?php } ?>
               </div>
               </a>
            </div>
         </div>
         <?php } ?>
      </div>
      
      <?php if (uri_segment(3)<>"result") { ?>
      <div class="row">
         <?php if (!empty(uri_segment(3)) and empty(uri_segment(4))) { ?>
            <div class="col-md-4 col-sm-12 mb-5">
               <?php $ftypes = uri_segment(3); $fregion = uri_segment(4); ?>
               <a href="services/vessel/<?php echo $ftypes; ?>/west" class="btnfilter <?php if ($fregion=="west") echo '$filteractive'; ?>">West</a>
               <a href="services/vessel/<?php echo $ftypes; ?>/central" class="btnfilter <?php if ($fregion=="central") echo '$filteractive'; ?>">Central</a>
               <a href="services/vessel/<?php echo $ftypes; ?>/east" class="btnfilter <?php if ($fregion=="east") echo '$filteractive'; ?>">East</a>
            </div>
            <div class="col-md-8 col-sm-12 mb-5">
               <form class="form-search form-inline" method="post" action="./services/vessel/result">
                  <div class="">
                      <input type="text" class="search-query" placeholder="Enter your keyword" name="keyword" />
                      <button type="submit" class="btn btn-primary">Search</button>
                  </div>
               </form>
            </div>
      
            <?php if (!empty(uri_segment(3))) { ?>
            <input type='hidden' id='current_page' />
            <input type='hidden' id='show_per_page' />
            <div class="container">
               <div class="row" id="myvessel">
                  <?php foreach ($allvessel as $b) { ?>
                  <?php
                     $popid = $b['KAPAL_ID'];
                     $vesscat = uri_segment(3);
                     if ($vesscat=='tug-boat') $jeniskapal = '1';
                     if ($vesscat=='pilot-boat') $jeniskapal = '2';
                     if ($vesscat=='other-vessel') $jeniskapal = '4';
                     
                     $jeniskapalid = $b['JENIS_KAPAL_ID'];
                     if ($jeniskapalid==$jeniskapal) {
                  ?>
                  
                  <?php if (!empty(trim($b['LINK_FILE']))) { ?>
                  
                  <div class="col-md-3 col-6" style="display: none;">
                     <a href="#popup<?php echo $popid; ?>" class="open-popup-link">
                     <div class="vessel-item">
                        <?php
                           if (!file_exists("upload/".$b['LINK_FILE'])) $gambar = "upload/news/nopic.png";
                           if (file_exists("upload/vessels/".$b['LINK_FILE'])) $gambar = "upload/vessels/".$b['LINK_FILE'];
                           if (file_exists("main/uploads/kapal/".$b['LINK_FILE'])) $gambar = "main/uploads/vessels/".$b['LINK_FILE'];
                        ?>
                        <div class="wrapimg"><img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" alt="" title="" class="imgwrap"></div>
                        <div class="tdpadding">
                           <div class="biry36 fbold mb-2"><?php echo $b['VESSEL_NAME']; ?></div>
                           <div class="robo24">Tug Boat</div>
                        </div>
                     </div>
                     </a>
                     <div id="popup<?php echo $popid; ?>" class="white-popup mfp-hide">
                        <div class="row">
                           <div class="col-md-6 col-12">
                              <div class="wrapimage">
                                 <img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" class="imgwrap" id="mainImage">
                              </div>
                              <div id="divId" onclick="changeImageOnClick(event);">
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php if (!empty($b['FOTO1'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO1']; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php } ?>
                                 <?php if (!empty($b['FOTO2'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO2']; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php } ?>
                                 <?php if (!empty($b['FOTO3'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO3']; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php } ?>
                                 <?php if (!empty($b['FOTO4'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO4']; ?>" class="imgwrap imgStyle">hi
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                           <div class="col-md-6 col-12 fbold">
                              <div class="biry24">
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Tunda") echo "Tug Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Pandu") echo "Pilot Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Lainnya") echo "Other Vessel"; ?>
                              </div>
                              <div class="biry40 fbold mb-4 mt-2 themeblue"><?php echo $b['VESSEL_NAME']; ?></div>
                              <div class="row bgpop-detail">
                                 <div class="col-6">Place</div>
                                 <div class="col-6"><?php echo $b['PELABUHAN']; ?></div>
                              </div>
                              <div class="row">
                                 <div class="col-6">Kind of Ship</div>
                                 <div class="col-6"><?php if($b['KIND_OF_VESSEL']=="Kapal Tunda") echo "Tug Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Pandu") echo "Pilot Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Lainnya") echo "Other Vessel"; ?></div>
                              </div>
                              <div class="row bgpop-detail">
                                 <div class="col-6">Vessel Name</div>
                                 <div class="col-6"><?php echo $b['VESSEL_NAME']; ?></div>
                              </div>
                              <div class="row">
                                 <div class="col-6">Manufacture Year</div>
                                 <div class="col-6"><?php echo $b['YEAR_OF_BUILT']; ?></div>
                              </div>
                              <div class="row bgpop-detail">
                                 <div class="col-6">Engine Power</div>
                                 <div class="col-6"><?php echo $b['DAYA_ENGINE']; ?></div>
                              </div>
                              <div class="row">
                                 <div class="col-6">Propulsion</div>
                                 <div class="col-6"><?php echo $b['PROPULSION']; ?></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php }}} ?>
                  <?php } ?>
               
               
               </div>
            </div>
            <?php if (!empty(uri_segment(3)) and empty(uri_segment(4))) { ?>
            <div class="col-md-12 mb-5">
               <center><div id='page_navigation'></div></center>
            </div>
            <?php } ?>
         <?php } ?>
         
         <?php if (!empty(uri_segment(3)) and !empty(uri_segment(4))) { ?>
            <div class="col-md-4 col-sm-12 mb-5">
               <?php $ftypes = uri_segment(3); $fregion = uri_segment(4); ?>
               <a href="services/vessel/<?php echo $ftypes; ?>/west" class="btnfilter <?php if ($fregion=="west") echo 'filteractive'; ?>">West</a>
               <a href="services/vessel/<?php echo $ftypes; ?>/central" class="btnfilter <?php if ($fregion=="central") echo 'filteractive'; ?>">Central</a>
               <a href="services/vessel/<?php echo $ftypes; ?>/east" class="btnfilter <?php if ($fregion=="east") echo 'filteractive'; ?>">East</a>
            </div>
            <div class="col-md-8 col-sm-12 mb-5">
               <form class="form-search form-inline" method="post" action="./services/vessel/result">
                  <div class="">
                      <input type="text" class="search-query" placeholder="Enter your keyword" name="keyword"/>
                      <button type="submit" class="btn btn-primary">Search</button>
                  </div>
               </form>
            </div>
      
            <?php if (!empty(uri_segment(3))) { ?>
            <input type='hidden' id='current_page' />
            <input type='hidden' id='show_per_page' />
            <div class="container">
               <div class="row" id="myvessel">
                  <?php foreach ($vessels as $b) { ?>
                  <?php
                     $popid = $b['KAPAL_ID'];
                     $vesscat = uri_segment(3);
                     if ($vesscat=='tug-boat') $jeniskapal = '1';
                     if ($vesscat=='pilot-boat') $jeniskapal = '2';
                     if ($vesscat=='other-vessel') $jeniskapal = '4';
                     
                     $jeniskapalid = $b['JENIS_KAPAL_ID'];
                     if ($jeniskapalid==$jeniskapal and strtolower($b['REGION'])==$fregion) {
                  ?>
                  
                  <?php if (!empty(trim($b['LINK_FILE']))) { ?>
                  
                  <div class="col-md-3 col-6" style="display: none;">
                     <a href="#popup<?php echo $popid; ?>" class="open-popup-link">
                     <div class="vessel-item">
                        <?php
                           if (!file_exists("upload/".$b['LINK_FILE'])) $gambar = "upload/news/nopic.png";
                           if (file_exists("upload/vessels/".$b['LINK_FILE'])) $gambar = "upload/vessels/".$b['LINK_FILE'];
                           if (file_exists("main/uploads/kapal/".$b['LINK_FILE'])) $gambar = "main/uploads/vessels/".$b['LINK_FILE'];
                        ?>
                        <div class="wrapimg"><img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" alt="" title="" class="imgwrap"></div>
                        <div class="tdpadding">
                           <div class="biry36 fbold mb-2"><?php echo $b['VESSEL_NAME']; ?></div>
                           <div class="robo24">Tug Boat</div>
                        </div>
                     </div>
                     </a>
                     <div id="popup<?php echo $popid; ?>" class="white-popup mfp-hide">
                        <div class="row">
                           <div class="col-md-6 col-12">
                              <div class="wrapimage">
                                 <img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" class="imgwrap" id="mainImage">
                              </div>
                              <div id="divId" onclick="changeImageOnClick(event);">
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php if (!empty($b['FOTO1'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO1']; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php } ?>
                                 <?php if (!empty($b['FOTO2'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO2']; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php } ?>
                                 <?php if (!empty($b['FOTO3'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO3']; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php } ?>
                                 <?php if (!empty($b['FOTO4'])) { ?>
                                 <div class="imgthumbs">
                                    <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO4']; ?>" class="imgwrap imgStyle">
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                           <div class="col-md-6 col-12 fbold">
                              <div class="biry24">
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Tunda") echo "Tug Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Pandu") echo "Pilot Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Lainnya") echo "Other Vessel"; ?>
                              </div>
                              <div class="biry40 fbold mb-4 mt-2 themeblue"><?php echo $b['VESSEL_NAME']; ?></div>
                              <div class="row bgpop-detail">
                                 <div class="col-6">Place</div>
                                 <div class="col-6"><?php echo $b['PELABUHAN']; ?></div>
                              </div>
                              <div class="row">
                                 <div class="col-6">Kind of Ship</div>
                                 <div class="col-6"><?php if($b['KIND_OF_VESSEL']=="Kapal Tunda") echo "Tug Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Pandu") echo "Pilot Boat"; ?>
                                 <?php if($b['KIND_OF_VESSEL']=="Kapal Lainnya") echo "Other Vessel"; ?></div>
                              </div>
                              <div class="row bgpop-detail">
                                 <div class="col-6">Vessel Name</div>
                                 <div class="col-6"><?php echo $b['VESSEL_NAME']; ?></div>
                              </div>
                              <div class="row">
                                 <div class="col-6">Manufacture Year</div>
                                 <div class="col-6"><?php echo $b['YEAR_OF_BUILT']; ?></div>
                              </div>
                              <div class="row bgpop-detail">
                                 <div class="col-6">Engine Power</div>
                                 <div class="col-6"><?php echo $b['DAYA_ENGINE']; ?></div>
                              </div>
                              <div class="row">
                                 <div class="col-6">Propulsion</div>
                                 <div class="col-6"><?php echo $b['PROPULSION']; ?></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php }}} ?>
                  <?php } ?>
               
               
               </div>
            </div>
            <?php if (!empty(uri_segment(3)) and !empty(uri_segment(4))) { ?>
            <div class="col-md-12 mb-5">
               <center><div id='page_navigation'></div></center>
            </div>
            <?php } ?>
         <?php } ?>
      </div>
      <?php } ?>
      
      <?php if (uri_segment(3)=="result") { ?>
      <div class="row">
         <div class="col-md-6 col-sm-12 mb-5">
            <form class="form-search form-inline" method="post" action="./services/vessel/result" style="margin-left: 0 !important;">
               <div class="">
                   <input type="text" class="search-query" placeholder="Enter your keyword" name="keyword" />
                   <button type="submit" class="btn btn-primary">Search</button>
               </div>
            </form>
         </div>
         <div class="col-md-6 col-sm-12 text-right mb-5">
            Search result for: <b><i><?php echo $fkeyword; ?></i>,
            <?php
               $cnt = 0;
               foreach ($searchresult as $b) { $cnt++; }
               echo $cnt;
            ?> vessel(s) found.
            </b>
         </div>
   
         <input type='hidden' id='current_page' />
         <input type='hidden' id='show_per_page' />
         <div class="container">
            <div class="row" id="myvessel">
               <?php foreach ($searchresult as $b) { ?>
               <?php
                  $popid = $b['KAPAL_ID'];
                  $jeniskapalid = $b['JENIS_KAPAL_ID'];
               ?>
               
               <?php if (!empty(trim($b['LINK_FILE']))) { ?>
               
               <div class="col-md-3 col-6" style="display: none;">
                  <a href="#popup<?php echo $popid; ?>" class="open-popup-link">
                  <div class="vessel-item">
                     <?php
                        if (!file_exists("upload/".$b['LINK_FILE'])) $gambar = "upload/news/nopic.png";
                        if (file_exists("upload/vessels/".$b['LINK_FILE'])) $gambar = "upload/vessels/".$b['LINK_FILE'];
                        if (file_exists("main/uploads/kapal/".$b['LINK_FILE'])) $gambar = "main/uploads/vessels/".$b['LINK_FILE'];
                     ?>
                     <div class="wrapimg"><img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" alt="" title="" class="imgwrap"></div>
                     <div class="tdpadding">
                        <div class="biry36 fbold mb-2"><?php echo $b['VESSEL_NAME']; ?></div>
                        <div class="robo24">Tug Boat</div>
                     </div>
                  </div>
                  </a>
                  <div id="popup<?php echo $popid; ?>" class="white-popup mfp-hide">
                     <div class="row">
                        <div class="col-md-6 col-12">
                           <div class="wrapimage">
                              <img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" class="imgwrap" id="mainImage">
                           </div>
                           <div id="divId" onclick="changeImageOnClick(event);">
                              <div class="imgthumbs">
                                 <img src="<?php echo base_url('/'); ?><?php echo $gambar; ?>" class="imgwrap imgStyle">
                              </div>
                              <?php if (!empty($b['FOTO1'])) { ?>
                              <div class="imgthumbs">
                                 <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO1']; ?>" class="imgwrap imgStyle">
                              </div>
                              <?php } ?>
                              <?php if (!empty($b['FOTO2'])) { ?>
                              <div class="imgthumbs">
                                 <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO2']; ?>" class="imgwrap imgStyle">
                              </div>
                              <?php } ?>
                              <?php if (!empty($b['FOTO3'])) { ?>
                              <div class="imgthumbs">
                                 <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO3']; ?>" class="imgwrap imgStyle">
                              </div>
                              <?php } ?>
                              <?php if (!empty($b['FOTO4'])) { ?>
                              <div class="imgthumbs">
                                 <img src="<?php echo base_url('/'); ?>/upload/vessels/<?php echo $b['FOTO4']; ?>" class="imgwrap imgStyle">hi
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6 col-12 fbold">
                           <div class="biry24">
                              <?php if($b['KIND_OF_VESSEL']=="Kapal Tunda") echo "Tug Boat"; ?>
                              <?php if($b['KIND_OF_VESSEL']=="Kapal Pandu") echo "Pilot Boat"; ?>
                              <?php if($b['KIND_OF_VESSEL']=="Kapal Lainnya") echo "Other Vessel"; ?>
                           </div>
                           <div class="biry40 fbold mb-4 mt-2 themeblue"><?php echo $b['VESSEL_NAME']; ?></div>
                           <div class="row bgpop-detail">
                              <div class="col-6">Place</div>
                              <div class="col-6"><?php echo $b['PELABUHAN']; ?></div>
                           </div>
                           <div class="row">
                              <div class="col-6">Kind of Ship</div>
                              <div class="col-6"><?php if($b['KIND_OF_VESSEL']=="Kapal Tunda") echo "Tug Boat"; ?>
                              <?php if($b['KIND_OF_VESSEL']=="Kapal Pandu") echo "Pilot Boat"; ?>
                              <?php if($b['KIND_OF_VESSEL']=="Kapal Lainnya") echo "Other Vessel"; ?></div>
                           </div>
                           <div class="row bgpop-detail">
                              <div class="col-6">Vessel Name</div>
                              <div class="col-6"><?php echo $b['VESSEL_NAME']; ?></div>
                           </div>
                           <div class="row">
                              <div class="col-6">Manufacture Year</div>
                              <div class="col-6"><?php echo $b['YEAR_OF_BUILT']; ?></div>
                           </div>
                           <div class="row bgpop-detail">
                              <div class="col-6">Engine Power</div>
                              <div class="col-6"><?php echo $b['DAYA_ENGINE']; ?></div>
                           </div>
                           <div class="row">
                              <div class="col-6">Propulsion</div>
                              <div class="col-6"><?php echo $b['PROPULSION']; ?></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php }} ?>           
            
            </div>
         </div>
         <?php if (!empty(uri_segment(3)) and empty(uri_segment(4))) { ?>
         <div class="col-md-12 mb-5">
            <center><div id='page_navigation'></div></center>
         </div>
         <?php } ?>
      </div>
      <?php } ?>
   </div>
</section>
