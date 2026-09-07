<?php

namespace App\Models;

use CodeIgniter\Model;

class HomepageModel extends Model
{
    public function getWelcome(): array
    {
        $today = date('Y-m-d');

        return $this->db->table('welcome_screen')
            ->where('status', '1')
            ->where('tgl_start <=', $today)
            ->where('tgl_end >=', $today)
            ->orderBy('welcome_screen_id', 'DESC')
            ->get()->getResultArray();
    }

    public function getHomeBanners(): array
    {
        return $this->db->table('banner_home')
            ->where('status', 1)
            ->orderBy('urutan', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }

    public function getHomebody(): array
    {
        return $this->db->table('pms_meta')->get()->getResultArray();
    }

    public function getHomeCert(): array
    {
        return $this->db->table('pms_cert')
            ->where(['jenis' => 'sertifikasi', 'status' => 1])
            ->orderBy('urutan', 'ASC')
            ->get()->getResultArray();
    }

    public function getHomeVessel(): array
    {
        return $this->db->table('vessel_home')->orderBy('id', 'ASC')->get()->getResultArray();
    }

    public function getHomeDockGal(): array
    {
        return $this->db->table('dock_gals')->orderBy('id', 'ASC')->get()->getResultArray();
    }

    public function getHomeNews(int $limit = 4): array
    {
        return $this->db->table('informasi')
            ->where('STATUS_AKTIF', '1')
            ->orderBy('TANGGAL', 'DESC')
            ->limit($limit)
            ->get()->getResultArray();
    }

    public function getHomeLinks(): array
    {
        return $this->db->table('link_terkait')->orderBy('LINK_TERKAIT_ID', 'ASC')->get()->getResultArray();
    }

    public function getHomeMaps(): array
    {
        return $this->db->table('map_ops')->orderBy('MAP_ID', 'ASC')->get()->getResultArray();
    }

    /**
     * Menonaktifkan welcome screen yang sudah lewat masa tayangnya
     * (stored procedure di database).
     */
    public function cekMasaWelcomeScreen(): void
    {
        try {
            $this->db->query('call cekMasaWelcomeScreen()');
        } catch (\Throwable $e) {
            // Procedure belum ada di database — jangan sampai homepage ikut tumbang.
            log_message('warning', 'cekMasaWelcomeScreen gagal: ' . $e->getMessage());
        }
    }
}
