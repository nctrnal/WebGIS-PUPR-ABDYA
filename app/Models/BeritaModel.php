<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'berita';
    protected $primaryKey       = 'id_berita';
    protected $returnType       = 'object';
    protected $allowedFields    = ['judul', 'penulis', 'kategori', 'body', 'foto'];
    protected $useTimestamps = true;

    public function getAllBerita()
    {
        return $this->findAll();
    }
}
