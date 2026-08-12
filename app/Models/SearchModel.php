<?php

namespace App\Models;

use CodeIgniter\Model;

class SearchModel extends Model
{
    public function searchKeyword(?string $string): array
    {
        if ($string === null || $string === '') {
            return [];
        }

        return $this->db->table('informasi')
            ->like('NAMA', $string)
            ->orderBy('INFORMASI_ID', 'DESC')
            ->get()->getResultArray();
    }
}
