<?php

namespace App\Models;

use CodeIgniter\Model;

class DaerahIrigasiModel extends Model
{
    protected $table            = 'daerahIrigasi';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'lebar_bawah', 'lebar_atas', 'keterangan', 'kecamatan', 'kondisi', 'json', 'foto'];
    protected $useTimestamps = true;

    public function getAllDaerah()
    {
        return $this->findAll();
    }
}
