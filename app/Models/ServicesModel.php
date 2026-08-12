<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    public function getVesselCat(): array
    {
        return $this->db->table('jenis_kapal')->orderBy('JENIS_KAPAL_ID', 'ASC')->get()->getResultArray();
    }

    public function getVessels(): array
    {
        return $this->db->table('kapal')->orderBy('KAPAL_ID', 'ASC')->get()->getResultArray();
    }

    public function getVesselsAll(): array
    {
        return $this->db->table('kapal')->orderBy('REGION', 'ASC')->get()->getResultArray();
    }

    public function getKeyword(?string $string): array
    {
        if ($string === null || $string === '') {
            return [];
        }

        return $this->db->table('kapal')
            ->groupStart()
                ->like('VESSEL_NAME', $string)
                ->orLike('PELABUHAN', $string)
            ->groupEnd()
            ->orderBy('KIND_OF_VESSEL', 'DESC')
            ->get()->getResultArray();
    }
}
