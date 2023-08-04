<?php

namespace App\Controllers;

use App\Database\Migrations\Kategori;
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
            'berita1' => $this->BeritaModel->paginate(6, 'berita1'),
            'pager' => $this->BeritaModel->pager,
            'daerah' => $this->DaerahIrigasiModel->getAllDaerah(),
            'bangunan' => $this->BangunanIrigasiModel->getAllBangunan(),
            'jaringan' => $this->JaringanIrigasiModel->getAllJaringan(),
        ];
        return view('pages/home', $data);
        // dd($data);
    }

    public function berita($id_berita)
    {
        $data = [
            'title' => 'Beranda',
            'detail' => $this->BeritaModel->find($id_berita)
        ];

        return view('pages/berita', $data);
    }

    public function jaringanIrigasi()
    {
        $data = [
            'title' => 'Peta Irigasi',
            'jaringan' => $this->JaringanIrigasiModel->getAllJaringan()
        ];
        return view('pages/jaringanIrigasi', $data);
    }

    public function daerahIrigasi()
    {
        $data = [
            'title' => 'Peta Irigasi',
            'daerah' => $this->DaerahIrigasiModel->findAll()
        ];
        echo view('pages/daerahIrigasi', $data);
    }

    public function bangunanIrigasi()
    {
        $data = [
            'title' => 'Peta Irigasi',
            'bendung' => $this->BangunanIrigasiModel->bendung(),
            'jembatan' => $this->BangunanIrigasiModel->jembatan(),
            'gorong' => $this->BangunanIrigasiModel->gorong(),
            'bangunanBagi' => $this->BangunanIrigasiModel->bangunanBagi(),
            'lantai' => $this->BangunanIrigasiModel->lantai(),
            'sedimentasi' => $this->BangunanIrigasiModel->sedimentasi(),
            'lining' => $this->BangunanIrigasiModel->lining(),
            'pintuPenguras' => $this->BangunanIrigasiModel->pintuPenguras(),
            'intake' => $this->BangunanIrigasiModel->intake(),
            'primer' => $this->BangunanIrigasiModel->primer(),
            'boxBagi' => $this->BangunanIrigasiModel->boxBagi(),

        ];
        // dd($data['bendung']);
        echo view('pages/bangunanIrigasi', $data);
    }

    // Berkas Daerah Irigasi
    public function dataDaerahIrigasi()
    {
        $berkas = $this->BerkasModel->findAll();
        $data = [
            'title' => 'Berkas',
            'berkas' => $berkas
        ];

        echo view('pages/dataDaerahIrigasi', $data);
        // dd($data);
    }

    // public function detail($id)
    // {
    //     $berkas = $this->BerkasModel;
    //     $data = [
    //         'title' => 'Berkas',
    //         'berkas' => $berkas->find($id)
    //     ];

    //     echo view('pages/detail', $data);
    // }

    // Berkas Jaringan Irigasi
    public function dataJaringanIrigasi()
    {
        $berkas = $this->BerkasJaringanModel->findAll();
        $data = [
            'title' => 'Berkas',
            'berkas' => $berkas
        ];

        echo view('pages/dataJaringanIrigasi', $data);
        // dd($data);
    }

    //Geojson
    public function dataGeojsonJaringan()
    {
        $irigasi = $this->JaringanIrigasiModel->findAll();
        $data = [
            'title' => 'Geojson',
            'jaringan' => $irigasi
        ];

        echo view('pages/dataGeojsonJaringan', $data);
        // dd($data);
    }
    public function dataGeojsonDaerah()
    {
        $irigasi = $this->DaerahIrigasiModel->findAll();
        $data = [
            'title' => 'Geojson',
            'daerah' => $irigasi
        ];

        echo view('pages/dataGeojsonDaerah', $data);
        // dd($data);
    }
    public function dataGeojsonBangunan()
    {
        $irigasi = $this->BangunanIrigasiModel->getAllBangunan();
        $data = [
            'title' => 'Geojson',
            'bangunan' => $irigasi
        ];

        echo view('pages/dataGeojsonBangunan', $data);
        // dd($data);
    }

    public function panduan()
    {
        $data = [
            'title' => 'Panduan',
        ];

        echo view('pages/panduan', $data);
    }

    public function pelaporan()
    {
        $data = [
            'title' => 'Pelaporan'
        ];
        echo view('pages/pelaporan', $data);
    }
}
