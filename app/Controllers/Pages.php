<?php

namespace App\Controllers;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use App\Models\BerkasModel;
use App\Models\BerkasJaringanModel;
use App\Models\KategoriModel;
use App\Models\LaporanModel;
use App\Models\JaringanIrigasiModel;
use App\Models\DaerahIrigasiModel;
use App\Models\BangunanIrigasiModel;
use App\Models\BeritaModel;

class Pages extends BaseController
{
    protected $BerkasModel;
    protected $BerkasJaringanModel;
    protected $LaporanModel;
    protected $KategoriModel;
    protected $JaringanIrigasiModel;
    protected $DaerahIrigasiModel;
    protected $BangunanIrigasiModel;
    protected $BeritaModel;

    public function __construct()
    {
        $this->BerkasModel = new BerkasModel();
        $this->BerkasJaringanModel = new BerkasJaringanModel();
        $this->LaporanModel = new LaporanModel();
        $this->KategoriModel = new KategoriModel();
        $this->BangunanIrigasiModel = new BangunanIrigasiModel();
        $this->DaerahIrigasiModel = new DaerahIrigasiModel();
        $this->JaringanIrigasiModel = new JaringanIrigasiModel();
        $this->BeritaModel = new BeritaModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Beranda',
            'berita' => $this->BeritaModel->orderBy("created_at", "desc")->first(),
            'berita1' => $this->BeritaModel->findAll(),
        ];
        return view('pages/home', $data);
        // dd($data);
    }

    public function berita($id_berita)
    {
        $data = [
            'title' => 'Berita',
            'detail' => $this->BeritaModel->find($id_berita)
        ];

        return view('pages/berita', $data);
    }

    public function jaringanIrigasi()
    {
        $data = [
            'title' => 'Jaringan Irigasi',
            'jaringan' => $this->JaringanIrigasiModel->getAllJaringan()
        ];
        return view('pages/jaringanIrigasi', $data);
    }

    public function daerahIrigasi()
    {
        $data = [
            'title' => 'Daerah Irigasi',
            'daerah' => $this->DaerahIrigasiModel->findAll()
        ];
        echo view('pages/daerahIrigasi', $data);
    }

    public function bangunanIrigasi()
    {
        $data = [
            'title' => 'Bangunan Irigasi',
            'bangunan' => $this->BangunanIrigasiModel->findAll()
        ];
        echo view('pages/bangunanIrigasi', $data);
    }

    public function dataDaerahIrigasi()
    {
        $berkas = $this->BerkasModel->findAll();
        $data = [
            'title' => 'Data Irigasi',
            'berkas' => $berkas
        ];

        echo view('pages/dataDaerahIrigasi', $data);
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

    public function dataJaringanIrigasi()
    {
        $berkas = $this->BerkasJaringanModel->findAll();
        $data = [
            'title' => 'Data Irigasi',
            'berkas' => $berkas
        ];

        echo view('pages/dataJaringanIrigasi', $data);
        // dd($data);
    }

    public function pelaporan()
    {
        $kategori = $this->KategoriModel->getAllKategori();
        $data = [
            'title' => 'Pelaporan',
            'kategori' => $kategori
        ];
        echo view('pages/pelaporan', $data);
        // dd($data);
    }
}
