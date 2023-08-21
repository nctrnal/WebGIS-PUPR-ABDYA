<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class BangunanIrigasiModel extends Model
{
    protected $table            = 'bangunanIrigasi';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'lebar_bawah', 'lebar_atas', 'keterangan', 'kecamatan', 'kondisi', 'warna', 'json', 'foto'];
    protected $useTimestamps = true;

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getAllBangunan()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->get()->getResultObject();
        return $query;
    }

    public function getBangunanId($id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function bendung()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Bendung'])->getResult();
        return $query;
    }

    public function jembatan()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Jembatan'])->getResultObject();
        return $query;
    }

    public function bangunanBagi()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Bangunan Bagi'])->getResult();
        return $query;
    }

    public function gorong()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Gorong-Gorong'])->getResult();
        return $query;
    }

    public function intake()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Intake'])->getResult();
        return $query;
    }

    public function sedimentasi()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Sedimentasi'])->getResult();
        return $query;
    }

    public function boxBagi()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Box Bagi'])->getResult();
        return $query;
    }

    public function primer()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Primer'])->getResult();
        return $query;
    }
    public function pintuPenguras()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Pintu Penguras'])->getResult();
        return $query;
    }
    public function lining()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Lining'])->getResult();
        return $query;
    }
    public function lantai()
    {
        $builder = $this->db->table('bangunanIrigasi');
        $query = $builder->getWhere(['keterangan' => 'Lantai'])->getResult();
        return $query;
    }
}
