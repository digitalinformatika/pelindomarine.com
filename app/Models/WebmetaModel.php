<?php

namespace App\Models;

use CodeIgniter\Model;

class WebmetaModel extends Model
{
    public function getMeta(): array
    {
        return $this->db->table('pms_meta')->get()->getResultArray();
    }
}
