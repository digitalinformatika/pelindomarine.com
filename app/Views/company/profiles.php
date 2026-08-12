<?php
   //session language
   $weblangs = session('weblang');
   if (strval($weblangs) == "") $weblangs = "english";
   
   function reurl($string){
        $string=str_replace("-"," ", $string);
        $string=ucwords($string);
        return $string;
    }
?>
<?php
   $getprofile = uri_segment(2);
   $photo = "";
   if ($getprofile=="m-masyhud") $photo = "board-m-masyhud_komut.png?ver=2";
   if ($getprofile=="andrei") $photo = "board-andrei.png";
   if ($getprofile=="warsilan") $photo = "board4.png?ver=1";
   if ($getprofile=="elvin") $photo = "board-dirkom-elvin.png";
   if ($getprofile=="lia-indi-agustiana") $photo = "board5.jpg";
   if ($getprofile=="perbager") $photo = "board-perbager.png";
?>
<style>
.rata {
   text-align:justify
}
.rata br {
   margin-bottom:10px
}
.getprofil {
   text-decoration:underline;
}
</style>
<section id="pms-inner-header2" style="background:#204280;">
   <div class="container">
      &nbsp;
   </div>
</section>
<section id="pms-innerblock-small">
   <div class="container">
      <div class="row animate-box">
         <div class="col-md-12 col-xs-12 text-right">
            <?php if ($weblangs=='english') { ?><div class="breadcumbs2">Home / Profile / <b><?php echo reurl($getprofile); ?></b></div><?php } ?>
            <?php if ($weblangs=='indonesia') { ?><div class="breadcumbs2">Home / Profil / <b><?php echo reurl($getprofile); ?></b></div><?php } ?>
         </div>
      </div>
   </div>
   <div class="container animate-box pb-5">
      <div class="row nopadding">
         <div class="col-md-12" style="margin-bottom: 60px;">
            <img src="upload/homepage/<?php echo $photo; ?>" alt="" class="img-fluid">
         </div>
         <div class="col-md-4">
            <?php
            if ($weblangs=='english') echo '<div class="biry24 themeblue">Board of Commissioners</div>';
            if ($weblangs=='indonesia') echo '<div class="biry24 themeblue">Dewan Komisaris</div>';
         ?>
          <div class="mt-2 themeblue biry36"><a href="profile/m-masyhud" class="themeblue biry36 <?= ($getprofile=="m-masyhud") ? 'getprofil' : ''; ?>">Muhammad Masyhud</a></div>
            <div class="mt-2 themeblue biry36"><a href="profile/andrei" class="themeblue biry36 <?= ($getprofile=="andrei") ? 'getprofil' : ''; ?>">Andrei Simanjuntak</a></div>
            <div class="mt-2 themeblue biry36"><a href="profile/perbager" class="themeblue biry36 <?= ($getprofile=="perbager") ? 'getprofil' : ''; ?>">Perbager</a></div>
            <?php
            if ($weblangs=='english') echo '<div class="biry24 themeblue mt-5">Board of Directors</div>';
            if ($weblangs=='indonesia') echo '<div class="biry24 themeblue mt-5">Dewan Direksi</div>';
         ?>
            <div class="mt-2 themeblue biry36"><a href="profile/warsilan" class="themeblue biry36 <?= ($getprofile=="warsilan") ? 'getprofil' : ''; ?>">Warsilan</a></div>
           <div class="mt-2"><a href="profile/elvin" class="themeblue biry36 <?= ($getprofile=="elvin") ? 'getprofil' : ''; ?>">Elvin Syah Putra</a></div>
            <div class="mt-2"><a href="profile/lia-indi-agustiana" class="themeblue biry36 <?= ($getprofile=="lia-indi-agustiana") ? 'getprofil' : ''; ?>">Lia Indi Agustiana</a></div>
         </div>
         
         <?php if ($getprofile=="m-masyhud") { ?>
         <div class="col-md-8 profile-detail">
            <?php if ($weblangs=='english') { ?>
            <div class="row">               
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Term of Office and Basis of Appointment
</div>
                  <p class="rata">
                  Indonesian citizen born in Jakarta on June 22, 1970. Currently serving as the President Commissioner of PT Pelindo Marine Service since August 1, 2024, based on the Circular Decision of the Shareholders of PT Pelindo Marine Service No. SK.03/29/7/1/PMAP/DRUT/PLJM-24 I 61/KEPSIR/KP/VII-2024.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Education</div>
                  <p class="rata">
                  Obtained a Bachelor's degree in Civil Engineering from the University of Indonesia and a Master's degree in Transportation from the Bandung Institute of Technology.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Career Experience</div>
                  <p class="rata">
                  In his career, he has experienced roles as a Project Leader for the development of several ports, including the Port of Wani in Central Sulawesi (2007) and the Port of Garongkong in South Sulawesi (2009). Subsequently, he held various strategic positions in several Directorates at the Ministry of Transportation. Among them are as the Head of the Sub-Directorate for the Design and Development Program of Port Facilities (2017), Head of Planning at the Inspectorate General of the Ministry of Transportation (2019), Head of the Sub-Directorate for Port Services and Business (2019), and Head of the Sub-Directorate for the Arrangement and Planning of Port Development (2022).
                  </p>
               </div>
            </div>
            <?php } ?>
            <?php if ($weblangs=='indonesia') { ?>
            <div class="row">               
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Masa Jabatan dan Dasar Penunjukan</div>
                  <p class="rata">
                  Warga Negara Indonesia yang lahir di Jakarta, 22 Juni 1970. Menjabat sebagai Komisaris Utama PT Pelindo Marine Service sejak 1 Agustus 2024 berdasarkan Keputusan Sirkuler Para Pemegang Saham PT Pelindo Marine Service No. SK.03/29/7/1/PMAP/DRUT/PLJM-24 I 61/KEPSIR/KP/VII-2024.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Pendidikan</div>
                  <p class="rata">
                  Memperoleh gelar Sarjana Teknik Sipil dari Universitas Indonesia gelar Magister Transportasi dari Institut Teknologi Bandung.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Perjalanan Karier</div>
                  <p class="rata">
                  Dalam karirnya berpengalaman sebagai Pemimpin Proyek Pembangunan sejumlah pelabuhan, di antaranya Pelabuhan Wani di Sulawesi Tengah (2007) dan Pelabuhan Garongkong di Sulawesi Selatan (2009). Kemudian menempati beberapa posisi strategis pada sejumlah Direktorat di Kementerian Perhubungan. Di antaranya sebagai Kepala Subdit Perancangan dan Program Pembangunan Fasilitas Pelabuhan (2017), Kepala Bagian Perencanaan, Inspektorat Jenderal Kemenhub (2019), Kepala Subdit Pelayanan Jasa dan Usaha Pelabuhan (2019), dan Kepala Subdit Tatanan dan Perencanaan Pengembangan Pelabuhan (2022). Kemudian pada tahun 2023 menjabat sebagai Direktur Kepelabuhanan, Kementerian Perhubungan, hingga saat ini.
                  </p>
               </div>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
         
         <?php if ($getprofile=="andrei") { ?>
         <div class="col-md-8 profile-detail">
            <?php if ($weblangs=='english') { ?>
            <div class="row">               
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Term of Office and Basis of Appointment
</div>
                  <p class="rata">
                  Indonesian citizen, born in Jakarta on 14 December 1972. He has served as Commissioner of PT Pelindo Marine Service since 1 August 2024 based on the Circular Decree of the Shareholders of PT Pelindo Marine Service No. SK.03/29/7/1/PMAP/DRUT/PLJM-24 61/KEPSIR/KP/VII-2024.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Education</div>
                  <p class="rata">
                  Obtained a Bachelor of Arts (BA) degree in philosophy from Ithaca College, New York, USA, and a Master of Arts (MA) degree in Addiction Counseling from Hazelden Graduate School of Addiction Studies, Centre City, Minnesota, USA.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Career Experience</div>
                  <p class="rata">
                  In his career, he experienced as Director of the Recovery Unit at Yayasan Nurani Bali Drug Rehabilitation Centre (2003). Then continued his career as Manager of General Affairs (GA) at Principia Management Group (2010). In 2015, he worked as a Project Lobbyist at North Star Group and succeeded in approaching and strategising efforts at the State Electricity Company (PLN) and several state-owned enterprises.
                  </p>
               </div>
            </div>
            <?php } ?>
            <?php if ($weblangs=='indonesia') { ?>
            <div class="row">               
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Masa Jabatan dan Dasar Pengangkatan</div>
                  <p class="rata">
                  Warga Negara Indonesia, lahir di Jakarta pada 14 Desember 1972. Menjabat sebagai Komisaris PT Pelindo Marine Service sejak 1 Agustus 2024 berdasarkan Keputusan Sirkuler Para Pemegang Saham PT Pelindo Marine Service No. SK.03/29/7/1/PMAP/DRUT/PLJM-24 I 61/KEPSIR/KP/VII-2024.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Pendidikan</div>
                  <p class="rata">
                  Memperoleh gelar Bachelor of Arts (BA) di bidang filsafat dari Perguruan Tinggi Ithaca, New York, Amerika Serikat, serta gelar Master of Arts (MA) di bidang Addiction Counseling dari Hazelden Graduate School of Addiction Studies, Center City, Minnesota, Amerika Serikat.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Perjalanan Karier</div>
                  <p class="rata">
                  Dalam karirnya berpengalaman sebagai Direktur Unit Pemulihan di Balai Rehabilitasi Narkoba Yayasan Nurani Bali (2003). Kemudian melanjutkan karir sebagai Manager of General Affair (GA) di Principia Management Group (2010). Pada tahun 2015, berkarir sebagai Project Lobbyist di North Star Group dan berhasil dalam upaya pendekatan dan strategi di Perusahaan Listrik Negara (PLN), serta beberapa perusahaan milik pemerintah.
                  </p>
               </div>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
         
         <?php if ($getprofile=="perbager") { ?>
         <div class="col-md-8 profile-detail">
            <?php if ($weblangs=='english') { ?>
            <div class="row">               
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Term of Office and Basis of Appointment
</div>
                  <p class="rata">
                  Indonesian citizen born in Medan on December 29, 1994. Currently serving as the Independent Commissioner of PT Pelindo Marine Service since January 1, 2025, based on the Circular Decision of the Shareholders of PT Pelindo Marine Service No. SK.03/29/12/2/DPAP/DRUT/PLJM-24 | 87/KEPSIR/KP/XII-2024
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Education</div>
                  <p class="rata">
                  Obtained a Bachelor of Economic Tax
                  <br />Management from the University of Borobudur.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Career Experience</div>
                  <p class="rata">
                  In his career, he has experienced in construction projects carried out by Waskita Beton Precast (2019), served as a member of the communication team at the Ministry of State-Owned Enterprises (2019–2024), and has been part of the staff of the Chairman of the Indonesian Football Association (PSSI), he has also played a key role in the renovation of 21 football stadiums and the development of young players in Indonesia to date.
                  </p>
               </div>
            </div>
            <?php } ?>
            <?php if ($weblangs=='indonesia') { ?>
            <div class="row">               
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Masa Jabatan dan Dasar Pengangkatan</div>
                  <p class="rata">
                  Warga Negara Indonesia yang lahir di Medan, 29 Desember 1994. Menjabat sebagai Komisaris IndependenPT Pelindo Marine Service sejak 1 Januari 2025 berdasarkan Keputusan Sirkuler Para Pemegang Saham PT Pelindo Marine Service No. SK.03/29/12/2/DPAP/DRUT/PLJM-24 | 87/KEPSIR/KP/XII-2024
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Pendidikan</div>
                  <p class="rata">
                  Memperoleh gelar Sarjana Manajemen Ekonomi Perpajakan dari Universitas Borobudur.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Perjalanan Karier</div>
                  <p class="rata">
                  Dalam karirnya berpengalaman dalam proyek pembangunan yang dilaksanakan oleh Waskita Beton Precast (2019), anggota tim komunikasi Kementerian Badan Usaha Milik Negara (BUMN) (2019-2024), dan menjadi bagian staf dari Ketua Persatuan Sepak Bola Seluruh Indonesia (PSSI), serta berperan penting pada renovasi 21 Stadion Sepak Bola dan pengembangan pemain muda di Indonesia hingga saat ini.
                  </p>
               </div>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
         
         <?php if ($getprofile=="lia-indi-agustiana") { ?>
         <div class="col-md-8 profile-detail">
            <?php if ($weblangs=='english') { ?>
            <div class="row">
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Term of Office and Basis of Appointment</div>
                  <p class="rata">
                     Indonesian Citizen, born in Surabaya on Agustus 1st, 1982. She has served as the Director of Finance, Human Capital, and General Affairs of PT Pelindo Marine Service since November 9th, 2020, based on the Circular Resolution of the Shareholders outside the General Meeting of Shareholders of PT Pelindo Marine Service No. KEP.0181/KU.07.01/HOFC-2020 | 127.1/KEPSIR/KP.III/XI- 2020.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Education</div>
                  <p class="rata">
                     She earned a Bachelor's Degree in Accounting from Universitas Airlangga (Unair) in 2004 and a Master of Business Administration (MBA) degree from Bandung Institute of Technology (ITB) in 2019. Besides non-formal education, she also participated in various courses and training such as Certified Risk Management Professional (CRMP) organized by LSPMR, Certified Executive Public Relations organized by LSPR, and Chartered Accountant organized by IAI.<br />Moreover, she participated in the Risk Management Conference held in Semarang, the Bloomberg System Workshop held by Bloomberg in Jakarta, and the Asia Pacific Economy Forum held by Citibank in Hong Kong.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Career Experience</div>
                  <p class="rata">
                  She began her career as VP of Financial Risk (2015-2017), VP of Corporate Communications (2017-2018), and SVP of Management System and Risk Management (2018 - 2020).
                  </p>
               </div>
            </div>
            <?php } ?>
            <?php if ($weblangs=='indonesia') { ?>
            <div class="row">
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Masa Jabatan dan Dasar Penunjukan</div>
                  <p class="rata">
                  Menjabat sebagai Direktur Keuangan, SDM dan Umum PT Pelindo Marine Service sejak 9 November 2020 berdasarkan Keputusan Sirkuler Para Pemegang Saham di Luar Rapat Umum Pemegang Saham PT Pelindo Marine Service No. KEP.0181/KU.07.01/HOFC-2020 | 127.1/KEPSIR/KP.III/XI- 2020.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Pendidikan</div>
                  <p class="rata">
                  Memperoleh gelar Sarjana Akuntansi dalam bidang Akuntansi dari Universitas Airlangga pada tahun 2004 serta gelar Master of Business Administration (MBA) dari Institut Teknologi Bandung pada tahun 2019. Di samping pendidikan non-formal, turut terlibat berpartisipasi dalam berbagai pendidikan dan pelatihan yang diselenggarakan, antara lain Certified Risk Management Profesional yang diselenggarakan LSPMR, Certified Executive Public Relation yang diselenggarakan LSPR, Chartered Accountant yang diselenggarakan IAI.
                  <br />Selain itu, turut mengikuti Konferensi Manajemen Risiko yang diselenggarakan di Semarang, Bloomberg System Workshop yang diselenggarakan oleh Bloomberg di Jakarta, dan Asia Pacific Economy Forum yang diselenggarakan oleh Citibank di Hong Kong.
                  </p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Perjalanan Karier</div>
                  <p class="rata">
                  Memulai karier manajerial dengan menjabat sebagai VP Financial Risk pada tahun 2015 - 2017, kemudian selanjutnya mengisi posisi VP Corporate Communications dari tahun 2017 - 2018, dan terakhir sebagai SVP Management System and Risk Management yang menjabat dari tahun 2018 - 2020.
                  </p>
               </div>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
         
         <?php if ($getprofile=="warsilan") { ?>
         <div class="col-md-8 profile-detail">
            <?php if ($weblangs=='english') { ?>
            <div class="row">
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Term of Office and Basis of Appointment</div>
                  <p class="rata">He serves as the President Director of PT Pelindo Marine Service since June 1st, 2022 based on the Circular Resolution of the Shareholders of PT Pelindo Marine Service No: HK.104/30/513/KUAP/DRUT/PLAM-22 dan Nomor: 41/KEPSIR/KP/V-2022.</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Education</div>
                  <p class="rata">He graduated from the 10 Nopember Institute of Technology (ITS) in electrical engineering in 1998. He also participated in several certifications and courses, such as Certified Risk Governance Professional (CRGP) in 1998 from Risk Management Professional Certification Institute (LSPMR), Port Professionals Training from PKSPLIPB-Ministry of Transportation (2020), and Professional Internal Auditor Training from Internal Auditor Association (2020).</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Career Experience</div>
                  <p class="rata">He experienced held several strategic positions as Senior Vice president (SVP) and director in the maritime industry. Such as SVP of Procurement (2015-2017) and SVP of Equipment (2019-2020) in Pelindo III. He served as the Director of Operations and Engineering of PT Berlian Jasa Terminal Indonesia (BJTI Port) (2017-2019) and Director of Operations and Engineering of PT Terminal Teluk Lamong (2019-2022).</p>
               </div>
            </div>
            <?php } ?>
            <?php if ($weblangs=='indonesia') { ?>
            <div class="row">
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Masa Jabatan dan Dasar Penunjukan</div>
                  <p class="rata">Menjabat sebagai Direktur Utama PT Pelindo Marine Service sejak 1 Juni 2022 berdasarkan Keputusan Sirkular Para Pemegang Saham PT Pelindo Marine Service Nomor: HK.104/30/513/KUAP/DRUT/PLAM-22 dan Nomor: 41/KEPSIR/KP/V-2022.</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Pendidikan</div>
                  <p class="rata">Menyelesaikan Pendidikan S1 Jurusan Teknik Elektro di Institut Teknologi Sepuluh Nopember (ITS) Surabaya pada 1998. Memegang sertifikasi Certified Risk Governance Professional (CRGP) pada 2021 dari Lembaga Sertifikasi Profesi Manajemen Risiko (LSPMR). Selain itu juga telah menempuh program diklat fungsional, yakni Pendidikan dan Pelatihan Ahli Kepelabuhanan dari PKSPLIPB-Kementerian Perhubungan (2020) dan Pendidikan dan Pelatihan Professional Internal Auditor dari Asosiasi Auditor Internal (2020).</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Perjalanan Karier</div>
                  <p class="rata">Berpengalaman menjabat sejumlah posisi strategis dalam karirnya pada industri kepelabunanan. Baik level senior manajer, maupun Direksi pada anak perusahaan PT Pelabuhan Indonesia (Persero). Di antaranya yakni Senior Manajer Pengadaan Barang dan Jasa pada 2015 – 2017 dan Senior Manajer Peralatan pada 2019 – 2020. Sebelum terpilih sebagai Direktur Utama PT Pelindo Marine Service pernah menjabat sebagai Direktur Operasi dan Teknik PT Berlian Jasa Terminal Indonesia (BJTI Port) pada 2017 – 2019 dan Direktur Operasi dan Teknik PT Terminal Teluk Lamong (TTL) pada 2020 – 2022. </p>
               </div>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
         
         <?php if ($getprofile=="elvin") { ?>
         <div class="col-md-8 profile-detail">
            <?php if ($weblangs=='english') { ?>
            <div class="row">
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Term of Office and Basis of Appointment</div>
                  <p class="rata">He has been appointed as the Director of Commercial, Operations and Engineering of PT Pelindo Marine Service since March 1 2024 based on the Circular Decision of PT Pelindo Marine Service Shareholders No. SK.03/29/2/5/PMAP/DRUT/PLJM-24 and KEPSIR/KP/III.2024.</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Education</div>
                  <p class="rata">He graduated from the STIP Jakarta (Marine Higher Education Institute) with a Master Mariner (M. Mar. Eng.) education degree for Engineer Officer Class 1 in 2016 and Engineer Officer Class 2 in 2011. Previously, he obtained a Engineer Officer Class 3 degree from BPLP (Merchant Marine Academy) in 1996.</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Career Experience</div>
                  <p class="rata">He has served as Vice President of Engineering at PT Jasa Armada Indonesia (2019-2021), Senior Vice President of Product Planning Control & Added Value at PT Jasa Peralatan Pelabuhan Indonesia (2021-2022), Senior Vice President of Vessels and Channel Management at PT Pelindo Jasa Maritim (2022-2023). Currently entrusted as the Director of Commercial, Operations and Engineering of PT Pelindo Marine Service (2024 - present).</p>
               </div>
            </div>
            <?php } ?>
            <?php if ($weblangs=='indonesia') { ?>
            <div class="row">
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Masa Jabatan dan Dasar Penunjukan</div>
                  <p class="rata">Menjabat sebagai Direktur Komersial, Operasi, dan Teknik PT Pelindo Marine Service sejak 1 Maret 2024 berdasarkan Keputusan Sirkular Para Pemegang Saham PT Pelindo Marine Service No. SK.03/29/2/5/PMAP/DRUT/PLJM-24 dan KEPSIR/KP/III.2024.</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Pendidikan</div>
                  <p class="rata">Merupakan lulusan Sekolah Tinggi Ilmu Pelayaran, Jakarta (STIP) dengan gelar pendidikan Master Mariner (M. Mar. Eng.) untuk Ahli Teknika Tingkat I pada tahun 2016 dan Ahli Teknika Tingkat  II di tahun 2011. Sebelumnya memperoleh gelar Ahli Teknika Tingkat III dari BPLP Akademi Ilmu Pelayaran pada tahun 1996.</p>
               </div>
               <div class="col-md-12 mt-3">
                  <div class="biry36 themeblue fbold">Perjalanan Karier</div>
                  <p class="rata">Pernah menjabat sebagai Vice President Teknik PT Jasa Armada Indonesia (2019-2021), Senior Vice President Kontrol Perencanaan Produk & Nilai Tambah di PT Jasa Peralatan Pelabuhan Indonesia (2021-2022), Senior Vice President Kapal dan Pengelolaan Alur di PT Pelindo Jasa Maritim (2022-2023). Kini dipercaya sebagai Direktur Komersial, Operasi, dan Teknik PT Pelindo Marine Service (2024 - sekarang).</p>
               </div>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
      </div>
   </div>
</section>