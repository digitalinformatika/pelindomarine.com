<?php

namespace App\Models;

use CodeIgniter\Model;

class StrukturOrganisasiModel extends Model
{
    protected $table      = 'struktur_organisasi';
    protected $primaryKey = 'STRUKTUR_ID';

    /**
     * Get all active organization nodes ordered by hierarchy and position.
     *
     * @return list<array>
     */
    public function getAllActive(): array
    {
        return $this->db->table('struktur_organisasi')
            ->where('STATUS_AKTIF', 1)
            ->orderBy('URUTAN', 'ASC')
            ->orderBy('STRUKTUR_ID', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Build nested tree of active officers.
     *
     * @return array
     */
    public function getTree(): array
    {
        $rows = $this->getAllActive();

        $byParent = [];
        foreach ($rows as $row) {
            $parentId = $row['PARENT_ID'] ?? 0;
            $byParent[$parentId][] = $row;
        }

        $buildTree = function ($parentId) use (&$buildTree, $byParent): array {
            $branch = [];
            foreach ($byParent[$parentId] ?? [] as $node) {
                $node['children'] = $buildTree($node['STRUKTUR_ID']);
                $branch[] = $node;
            }
            return $branch;
        };

        // Roots are nodes with PARENT_ID = null or 0
        $roots = array_merge($byParent[0] ?? [], $byParent[null] ?? []);
        $tree = [];
        foreach ($roots as $root) {
            $root['children'] = $buildTree($root['STRUKTUR_ID']);
            $tree[] = $root;
        }

        return $tree;
    }

    /**
     * Get active template configuration for a given type ('bagan' or 'profil').
     */
    public function getActiveTemplate(string $jenis = 'bagan'): ?array
    {
        $row = $this->db->table('struktur_organisasi_template')
            ->where('JENIS', $jenis)
            ->where('IS_ACTIVE', 1)
            ->where('STATUS_AKTIF', 1)
            ->get()
            ->getRowArray();

        return $row ?: null;
    }

    /**
     * Get banner configuration for a given type ('bagan' or 'profil').
     */
    public function getBanner(string $jenis = 'bagan'): ?array
    {
        $row = $this->db->table('struktur_organisasi_banner')
            ->where('JENIS', $jenis)
            ->where('STATUS_AKTIF', 1)
            ->get()
            ->getRowArray();

        return $row ?: null;
    }

    /**
     * Find an officer by integer ID or slug string (e.g. 'warsilan', 'm-masyhud', etc.).
     */
    public function findOfficer($identifier): ?array
    {
        if (empty($identifier)) {
            return null;
        }

        // 1. Direct match by integer primary key
        if (is_numeric($identifier)) {
            $officer = $this->db->table('struktur_organisasi')
                ->where('STRUKTUR_ID', (int) $identifier)
                ->where('STATUS_AKTIF', 1)
                ->get()
                ->getRowArray();

            if ($officer) {
                return $officer;
            }
        }

        // 2. Slug matching: iterate active officers and compare friendlyURL
        $all = $this->getAllActive();
        $targetSlug = strtolower(trim((string) $identifier));

        // Direct alias mappings for legacy URLs
        $legacyAliases = [
            'm-masyhud'            => 'Muhammad Masyhud',
            'andrei'               => 'Andrei Simanjuntak',
            'warsilan'             => 'Warsilan',
            'elvin'                => 'Elvin Syah Putra',
            'lia-indi-agustiana'   => 'Lia Indi Agustiana',
            'perbager'             => 'Perbager',
            'rizky-pratama'        => 'Rizky Pratama',
        ];

        foreach ($all as $officer) {
            $nameSlug = friendlyURL($officer['NAMA'] ?? '');
            if ($nameSlug === $targetSlug) {
                return $officer;
            }

            // Check if matches legacy alias
            if (isset($legacyAliases[$targetSlug]) && stripos($officer['NAMA'] ?? '', $legacyAliases[$targetSlug]) !== false) {
                return $officer;
            }

            // Check partial match (e.g. first name)
            $firstName = explode(' ', trim($officer['NAMA'] ?? ''))[0] ?? '';
            if (friendlyURL($firstName) === $targetSlug) {
                return $officer;
            }
        }

        return null;
    }

    /**
     * Get dynamic profile sections for a given officer.
     */
    public function getOfficerProfiles(int $strukturId): array
    {
        return $this->db->table('struktur_organisasi_profil')
            ->where('STRUKTUR_ID', $strukturId)
            ->where('STATUS_AKTIF', 1)
            ->orderBy('URUTAN', 'ASC')
            ->orderBy('PROFIL_ID', 'ASC')
            ->get()
            ->getResultArray();
    }
}
