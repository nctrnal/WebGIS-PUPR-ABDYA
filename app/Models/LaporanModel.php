<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table            = 'pelaporan';
    protected $primaryKey       = 'id_pelaporan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_pelaporan', 'nama_pelapor', 'pelapor', 'lokasi', 'longitude', 'latitude', 'jenis_kerusakan', 'status', 'deskripsi', 'bukti'];
    protected $useTimestamps = true;

    public function deleteLaporan($id_pelaporan)
    {
        return $this->delete($id_pelaporan);
    }
}
