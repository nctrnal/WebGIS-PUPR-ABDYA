<?php

namespace App\Models;

use CodeIgniter\Model;

class JaringanIrigasiModel extends Model
{
    protected $table            = 'jaringanIrigasi';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'panjang', 'kondisi', 'kecamatan', 'warna', 'json', 'foto'];
    protected $useTimestamps = true;

    public function getAllJaringan()
    {
        return $this->findAll();
    }
}
