<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanDiterimaModel extends Model
{
    protected $table            = 'laporanDiterima';
    protected $primaryKey       = 'id_pelaporan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_pelapor', 'user', 'pelapor', 'lokasi', 'longitude', 'latitude', 'jenis_kerusakan', 'deskripsi', 'bukti'];
    protected $useTimestamps = true;
}
