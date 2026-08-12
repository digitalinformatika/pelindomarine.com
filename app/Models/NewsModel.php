<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    public function getNewsTop(): array
    {
        return $this->db->table('informasi')
            ->where('STATUS_AKTIF', '1')
            ->orderBy('TANGGAL', 'DESC')
            ->limit(1)
            ->get()->getResultArray();
    }

    public function getNewsList(): array
    {
        return $this->db->table('informasi')
            ->where('STATUS_AKTIF', '1')
            ->orderBy('TANGGAL', 'DESC')
            ->limit(12)
            ->get()->getResultArray();
    }

    /**
     * @return array|null Baris berita, atau null bila tidak ditemukan.
     */
    public function getNewsDetail(?string $slug = null): ?array
    {
        if ($slug === null) {
            return $this->db->table('informasi')->get()->getResultArray();
        }

        return $this->db->table('informasi')
            ->where('INFORMASI_ID', $slug)
            ->get()->getRowArray();
    }

    public function datanews(int $number, int $offset): array
    {
        return $this->db->table('informasi')
            ->orderBy('TANGGAL', 'DESC')
            ->limit($number, $offset)
            ->get()->getResultArray();
    }

    public function cntDatanews(): int
    {
        return $this->db->table('informasi')->countAllResults();
    }
}
