<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    public function getCompany(): array
    {
        return $this->db->table('konten')->orderBy('KONTEN_ID', 'ASC')->get()->getResultArray();
    }

    public function getCompanyDocs(): array
    {
        return $this->db->table('pms_docs')->orderBy('id', 'ASC')->limit(20)->get()->getResultArray();
    }

    public function getCompanyJobs(): array
    {
        return $this->db->table('karir')->orderBy('KARIR_ID', 'DESC')->limit(6)->get()->getResultArray();
    }
}
