<?php

namespace App\Controllers;

use App\Models;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use App\Models\BerkasModel;

class Pages extends BaseController
{
    protected $BerkasModel;

    public function __construct()
    {
        $this->BerkasModel = new BerkasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda | Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('pages/home', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login | Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('pages/login', $data);
    }

    public function jaringanIrigasi()
    {
        $data = [
            'title' => 'Jaringan Irigasi | Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('pages/jaringanIrigasi', $data);
    }

    public function daerahIrigasi()
    {
        $data = [
            'title' => 'Daerah Irigasi | Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('pages/daerahIrigasi', $data);
    }

    public function dataAdmin()
    {
        $data = [
            'title' => 'Data Admin | Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('pages/dataAdmin', $data);
    }

    public function dokumentasi()
    {
        $data = [
            'title' => 'Dokumentasi | Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('pages/dokumentasi', $data);
    }

    public function bangunanIrigasi()
    {
        $data = [
            'title' => 'Bangunan Irigasi | Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('pages/bangunanIrigasi', $data);
    }

    public function dataIrigasi()
    {
        $berkas = $this->BerkasModel->findAll();
        $data = [
            'title' => 'Detail | Dinas PUPR Kabupaten Aceh Barat Daya',
            'berkas' => $berkas
        ];

        echo view('pages/dataIrigasi', $data);
        // dd($data);
    }
}
