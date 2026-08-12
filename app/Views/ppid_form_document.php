<?php
// Dokumen formulir permohonan informasi publik (E-PPID),
// disimpan ke database & file, dan ditampilkan kembali di web admin.
$checked   = $uploadUrl . 'checked.png';
$unchecked = $uploadUrl . 'unchecked.png';
$img       = static fn (bool $on): string => '<img src="' . ($on ? $checked : $unchecked) . '">';
?>
<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Pelindo Marine - PPID</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<style>
    body{
        width: 100%;
        margin: 20px;
        font-family: "Segoe UI", sans-serif;
        font-size: 10px;
    }
    table {
        border-collapse: collapse;
    }

    tr {
        border-bottom: 1pt solid #ccc;
    }
    h3{
        font-family: "Segoe UI", sans-serif;
        font-size: 13px;
    }
    th, td {
        padding: 5px;
    }
</style>
<body>

    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
            <tr>
                <td width="30%"><img src="<?= $uploadUrl ?>kop-pelindo.jpg" width="200"></td>
                <td width="70%">
                <h3 style="text-align:center"><strong>PT PELINDO MARINE SERVICE</strong></h3>

                <p style="text-align:center"><span style="font-size:10px; font-family:Segoe UI, sans-serif;">Pelindo Place, Lt. 19 Jl. Perak Timur 478, Surabaya 60165 - Indonesia<br />
                Telp. (031) 99210400/Email. info@pelindomarine.com</span></p>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <br><br>
    <h3 style="text-align:center;"><strong>FORMULIR PERMOHONAN INFORMASI PUBLIK<br />
    (UNTUK PEMOHON PERORANGAN)</strong></h3>

    <p style="text-align:center">Nomor Pendaftaran : <?= esc($nomor) ?></p><br>

    <table cellpadding="3" cellspacing="3" style="width:100%">
        <tbody>
            <tr>
                <td width="15%"><strong>Nama</strong></td>
                <td width="1%">:</td>
                <td><?= esc($nama) ?></td>
                <td>&nbsp;</td>
                <td width="3%">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><strong>No. KTP/NPWP</strong></td>
                <td>:</td>
                <td><?= esc($ktp) ?></td>
                <td>&nbsp;</td>
                <td width="15%"><strong>Telp/HP</strong></td>
                <td width="1%">:</td>
                <td><?= esc($hp) ?></td>
            </tr>
            <tr>
                <td><strong>Tanggal Lahir</strong></td>
                <td>:</td>
                <td><?= esc($tgllahir) ?></td>
                <td>&nbsp;</td>
                <td><strong>Tempat Lahir</strong></td>
                <td>:</td>
                <td><?= esc($tmplahir) ?></td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td>:</td>
                <td><?= esc($alamat) ?></td>
                <td>&nbsp;</td>
                <td><strong>Kota</strong></td>
                <td>:</td>
                <td><?= esc($kota) ?></td>
            </tr>
            <tr>
                <td><strong>Provinsi</strong></td>
                <td>:</td>
                <td><?= esc($provinsi) ?></td>
                <td>&nbsp;</td>
                <td><strong>Kodepos</strong></td>
                <td>:</td>
                <td><?= esc($kodepos) ?></td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>:</td>
                <td><?= esc($email) ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <br>
    <p><strong>Informasi yang dibutuhkan :</strong></p>

    <p><?= esc($info) ?></p>

    <hr />
    <p><strong>Alasan penggunaan informasi :</strong></p>

    <p><?= esc($alasan) ?></p>

    <hr />
    <table border="0" cellpadding="3" cellspacing="3" style="width:100%">
        <tbody>
            <tr>
                <td valign="top"><strong>Cara memperoleh informasi</strong></td>
                <td>
                    <p><?= $img($cara === '2') ?> Langsung
                    <i>(Melihat/membaca/mendengarkan/mencatat)</i></p>
                    <p><?= $img($cara === '1') ?> Mendapat salinan <i>(Hardcopy/softcopy)</i></p>
                </td>
            </tr>
            <tr>
                <td valign="top"><strong>Cara mendapat salinan informasi</strong></td>
                <td>
                    <p><?= $img($berkas === '1') ?> Mengambil langsung&nbsp;&nbsp; <?= $img($berkas === '2') ?> Email</p>
                    <p><?= $img($berkas === '3') ?> Dikirim lewat pos</p>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <p>Dengan ini menyatakan bahwa data dan informasi yang kami peroleh akan kami gunakan sebagai peruntukannya dengan penuh rasa tanggung jawab.</p>

    <p>&nbsp;</p>

    <table border="0" cellpadding="3" cellspacing="3" style="width:100%">
        <tbody>
            <tr>
                <td>
                <p style="text-align:center">&nbsp;</p>

                <p style="text-align:center"><strong>Petugas Informasi Publik,</strong></p>

                <p style="text-align:center"><div style="width:100px; height:100px;">&nbsp;</div></p>

                <p style="text-align:center">&nbsp;<br>________________________</p>
                </td>
                <td>
                <p style="text-align:center"><?= esc($tmpdates) ?></p>

                <p style="text-align:center"><strong>Pemohon Informasi Publik,</strong></p>

                <p style="text-align:center"><img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= urlencode($nama . ' - ' . $tglqrcode) ?>" title="" /></p>

                <p style="text-align:center"><?= esc($nama) ?><br>________________________</p>
                </td>
            </tr>
        </tbody>
    </table>

    <p>&nbsp;</p>
    <hr>
    <p>Kartu Identitas<br><img src="<?= esc($gbrkartu, 'attr') ?>"></p>

    <p>&nbsp;</p>
    <hr>
    <p>Surat Pengantar</p><br>
    <img src="<?= esc($gbrsurat, 'attr') ?>" width="100%">

</body>
</html>
