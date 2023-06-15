<?php

namespace App\Models;

use CodeIgniter\Model;

class DaerahIrigasiModel extends Model
{
    protected $table            = 'daerahIrigasi';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'luas', 'kecamatan', 'warna', 'json'];
    protected $useTimestamps = true;

    public function getAllDaerah()
    {
        return $this->findAll();
    }
}
