<?php

namespace App\Models;

use CodeIgniter\Model;

class WarnaModel extends Model
{
    protected $table            = 'warna';
    protected $primaryKey       = 'warna';
    protected $returnType       = 'object';
    protected $allowedFields    = ['warna'];

    public function getAllWarna()
    {
        return $this->findAll();
    }
}
