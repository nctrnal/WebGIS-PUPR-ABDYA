<?php

namespace App\Controllers;

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
            'title' => 'Beranda'
        ];
        echo view('pages/home', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        echo view('pages/login', $data);
    }

    public function jaringanIrigasi()
    {
        $data = [
            'title' => 'Jaringan Irigasi'
        ];
        echo view('pages/jaringanIrigasi', $data);
    }

    public function daerahIrigasi()
    {
        $data = [
            'title' => 'Daerah Irigasi'
        ];
        echo view('pages/daerahIrigasi', $data);
    }

    public function dataAdmin()
    {
        $data = [
            'title' => 'Data Admin'
        ];
        echo view('pages/dataAdmin', $data);
    }

    public function pelaporan()
    {
        $data = [
            'title' => 'Pelaporan'
        ];
        echo view('pages/pelaporan', $data);
    }

    public function bangunanIrigasi()
    {
        $data = [
            'title' => 'Bangunan Irigasi'
        ];
        echo view('pages/bangunanIrigasi', $data);
    }

    public function dataIrigasi()
    {
        $berkas = $this->BerkasModel->findAll();
        $data = [
            'title' => 'Data Irigasi',
            'berkas' => $berkas
        ];

        echo view('pages/dataIrigasi', $data);
        // dd($data);
    }

    public function detail($id)
    {
        $berkas = $this->BerkasModel;
        $data = [
            'title' => 'Data Irigasi',
            'berkas' => $berkas->find($id)
        ];

        echo view('pages/detail', $data);
    }
}
