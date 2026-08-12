<?php

namespace App\Models;

use CodeIgniter\Model;

class PpidModel extends Model
{
    public function saveRecords(array $data): bool
    {
        return $this->db->table('ppid')->insert($data);
    }

    public function getByNomor(string $nomor = ''): ?array
    {
        return $this->db->table('ppid')
            ->where('nomor', $nomor)
            ->get()->getRowArray();
    }
}
