<?php

namespace App\Models;

use CodeIgniter\Model;

class BangunanIrigasiModel extends Model
{
    protected $table            = 'bangunanIrigasi';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'lebar_bawah', 'lebar_atas', 'keterangan', 'kecamatan', 'kondisi', 'warna', 'json', 'foto'];
    protected $useTimestamps = true;

    public function getAllBangunan()
    {
        return $this->findAll();
    }
}
