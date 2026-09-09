<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    public function getCompany(): array
    {
        return $this->db->table('konten')->orderBy('KONTEN_ID', 'ASC')->get()->getResultArray();
    }

    /**
     * Dokumen regulasi/tata kelola (dikelola CMS: Perusahaan > Regulasi).
     * Fallback ke tabel lama pms_docs bila tabel baru belum ada.
     */
    public function getCompanyDocs(): array
    {
        if ($this->db->tableExists('regulasi_dokumen')) {
            return $this->db->table('regulasi_dokumen')
                ->where('status', 1)
                ->orderBy('urutan', 'ASC')
                ->orderBy('id', 'ASC')
                ->get()->getResultArray();
        }

        $rows = $this->db->table('pms_docs')->orderBy('id', 'ASC')->limit(20)->get()->getResultArray();

        return array_map(static fn (array $r) => [
            'judul' => $r['judul'],
            'title' => $r['title'] ?? null,
            'file'  => null,
            'url'   => $r['docfile'] ?? null,
        ], $rows);
    }

    /** Annual report (dikelola CMS: Perusahaan > Regulasi > Annual Report). */
    public function getAnnualReports(): array
    {
        if (! $this->db->tableExists('regulasi_annual_report')) {
            return [];
        }

        return $this->db->table('regulasi_annual_report')
            ->where('status', 1)
            ->orderBy('urutan', 'ASC')
            ->orderBy('tahun', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }

    public function getCompanyJobs(): array
    {
        return $this->db->table('karir')->orderBy('KARIR_ID', 'DESC')->limit(6)->get()->getResultArray();
    }
}
