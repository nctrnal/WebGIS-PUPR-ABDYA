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

    public function getGeoJSONbyId($id)
    {
        return $this->where('id', $id)->get()->getRow();
    }

    public function getGeoJSONFilenames()
    {
        $builder = $this->db->table($this->table);
        $builder->select('json'); // Ganti dengan nama kolom yang menyimpan nama file GeoJSON
        $query = $builder->get();

        return $query->getResultObject();
    }
}
