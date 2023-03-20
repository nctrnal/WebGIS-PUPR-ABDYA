<?php

namespace App\Controllers;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use App\Models\BerkasModel;

class Admin extends BaseController
{
    protected $BerkasModel;

    public function __construct()
    {
        $this->BerkasModel = new BerkasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda'

        ];
        echo view('admin/homeAdmin', $data);
    }

    public function jaringanIrigasiAdmin()
    {
        $data = [
            'title' => 'Jaringan Irigasi'
        ];

        echo view('admin/jaringanIrigasiAdmin', $data);
    }
    public function bangunanIrigasiAdmin()
    {
        $data = [
            'title' => 'Bangunan Irigasi'
        ];

        echo view('admin/bangunanIrigasiAdmin', $data);
    }
    public function daerahIrigasiAdmin()
    {
        $data = [
            'title' => 'Daerah Irigasi'
        ];

        echo view('admin/daerahIrigasiAdmin', $data);
    }
    public function pelaporanAdmin()
    {
        $data = [
            'title' => 'Pelaporan'
        ];

        echo view('admin/pelaporanAdmin', $data);
    }
    public function dataIrigasiAdmin()
    {
        $berkas = $this->BerkasModel->findAll();
        $data = [
            'title' => 'Data Irigasi Admin',
            'berkas' => $berkas
        ];

        echo view('admin/dataIrigasiAdmin', $data);
    }
}
