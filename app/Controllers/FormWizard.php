<?php

namespace App\Controllers;

use App\Models\PpidModel;

/**
 * Menangani submit form E-PPID (Permohonan Informasi Publik)
 * yang dikirim via AJAX dari halaman /ppid.
 */
class FormWizard extends BaseController
{
    private const UPLOAD_BASE = 'https://pelindomarine.com/upload/ppid/';

    public function ajaxRequestPost(): string
    {
        $ppidModel = model(PpidModel::class);

        $tmpdates  = date('Y-m-d');
        $tglqrcode = date('d-m-Y');
        $nomor     = 'E-PPID/' . date('d.m.Y') . '/' . date('Hi');

        $post = static fn (string $key): string => (string) service('request')->getPost($key);

        $nama     = $post('ynama');
        $ktp      = $post('yktp');
        $hp       = $post('yhp');
        $tgllahir = $post('ytgllahir');
        $tmplahir = $post('ytmplahir');
        $alamat   = $post('yalamat');
        $kota     = $post('ykota');
        $provinsi = $post('yprovinsi');
        $kodepos  = $post('ykodepos');
        $email    = $post('yemail');
        $info     = $post('yinfo');
        $alasan   = $post('yalasan');
        $cara     = $post('ycara');
        $berkas   = $post('ycopy');
        $gbrkartu = $post('ykartufile');
        $gbrsurat = $post('ykartufileSurat');

        $berkasLabels = [
            '1' => 'Mengambil langsung',
            '2' => 'Email',
            '3' => 'Dikirim lewat pos',
        ];
        $caraLabels = [
            '1' => 'Mendapat salinan (hardcopy/softcopy)',
            '2' => 'Langsung (melihat/membaca/mendengar/mencatat)',
        ];

        $layout = view('ppid_form_document', [
            'nomor'     => $nomor,
            'nama'      => $nama,
            'ktp'       => $ktp,
            'hp'        => $hp,
            'tgllahir'  => $tgllahir,
            'tmplahir'  => $tmplahir,
            'alamat'    => $alamat,
            'kota'      => $kota,
            'provinsi'  => $provinsi,
            'kodepos'   => $kodepos,
            'email'     => $email,
            'info'      => $info,
            'alasan'    => $alasan,
            'cara'      => $cara,
            'berkas'    => $berkas,
            'gbrkartu'  => $gbrkartu,
            'gbrsurat'  => $gbrsurat,
            'tmpdates'  => $tmpdates,
            'tglqrcode' => $tglqrcode,
            'uploadUrl' => self::UPLOAD_BASE,
        ]);

        $ppidModel->saveRecords([
            'nomor'       => $nomor,
            'nama'        => $nama,
            'ktp'         => $ktp,
            'hp'          => $hp,
            'tgllahir'    => $tgllahir,
            'tmplahir'    => $tmplahir,
            'alamat'      => $alamat,
            'kota'        => $kota,
            'provinsi'    => $provinsi,
            'kodepos'     => $kodepos,
            'email'       => $email,
            'info'        => $info,
            'alasan'      => $alasan,
            'cara'        => $caraLabels[$cara] ?? '',
            'berkas'      => $berkasLabels[$berkas] ?? '',
            'scanid'      => $gbrkartu,
            'scanidSurat' => $gbrsurat,
            'layouts'     => $layout,
            'tanggal'     => $tmpdates,
        ]);

        $this->notifyByEmail($nomor);

        // Simpan salinan dokumen sebagai file
        helper('filesystem');
        $namafile = url_title(strtolower($nama)) . '-' . $tmpdates . '.txt';
        $uploadDir = $this->pelindo->uploadPath . '/ppid/';

        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (! write_file($uploadDir . $namafile, $layout)) {
            return 'Unable to write the file<br>' . $layout;
        }

        return 'File written!<br>' . $layout;
    }

    /**
     * Kirim notifikasi email permohonan baru lewat API internal.
     */
    private function notifyByEmail(string $nomor): void
    {
        if ($nomor === '' || $this->pelindo->ppidMailApi === '') {
            return;
        }

        $item = model(PpidModel::class)->getByNomor($nomor);

        $subjek   = 'E-PPID Form Permohonan Baru';
        $konten   = 'Formulir permohanan baru melalui e-PPID Website Pelindo Marine : ';
        $pengirim = '';

        if (! empty($item)) {
            $hash = md5('pms_ppid-' . $item['id']);
            $this->session->set('no_ppid', $hash);

            $subjek = $item['nomor'] . ' | E-PPID Form Permohonan Baru  An ' . $item['nama'];
            $konten .= "<br><br>
                <a href='" . base_url('webadmin/ppid/' . $hash) . "' target='_blank' style='border:1px solid #06F;background-color:#06F;color:#FFF;padding:5px;text-decoration:none'>" . $item['nomor'] . '</a>
                <br><br>
            ';
            $pengirim = $item['email'];
        }

        try {
            service('curlrequest')->post($this->pelindo->ppidMailApi, [
                'form_params' => [
                    'KEY_GETTER' => $this->pelindo->ppidMailApiKey,
                    'penerima'   => $this->pelindo->ppidRecipients,
                    'subjek'     => $subjek,
                    'konten'     => $konten,
                    'pengirim'   => $pengirim,
                ],
                'verify'      => false,
                'http_errors' => false,
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Gagal mengirim notifikasi PPID: ' . $e->getMessage());
        }
    }
}
