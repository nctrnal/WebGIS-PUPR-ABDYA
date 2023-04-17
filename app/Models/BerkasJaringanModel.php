<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasJaringanModel extends Model
{
    protected $table            = 'berkas_jaringan';
    protected $primaryKey       = 'id_berkas';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_daerah', 'pdf'];
    protected $useTimestamps = true;

    public function getAllJaringanBerkas()
    {
        $this->BerkasJaringanModel->findAll();
    }
}
