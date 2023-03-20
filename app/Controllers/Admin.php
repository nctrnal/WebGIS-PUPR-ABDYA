<?php

namespace App\Controllers;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use App\Models\BerkasModel;
use App\Models\LaporanModel;
use App\Models\LaporanDiterimaModel;


class Admin extends BaseController
{
    protected $BerkasModel;
    protected $LaporanModel;
    protected $LaporanDiterimaModel;

    public function __construct()
    {
        $this->BerkasModel = new BerkasModel();
        $this->LaporanModel = new LaporanModel();
        $this->LaporanDiterimaModel = new LaporanDiterimaModel();
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

    //menampilkan data laporan dari masyarakat
    public function lihatLaporan()
    {
        $laporan = $this->LaporanModel->findAll();
        $data = [
            'title' => 'Pelaporan',
            'laporan' => $laporan
        ];

        echo view('admin/pelaporanAdmin', $data);
    }

    public function saveLaporan()
    {
        if (!$this->validate([
            'nama_pelapor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'jenis_kerusakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'bukti' => [
                'rules' => 'uploaded[bukti]|mime_in[bukti,image/jpg,image/jpeg,image/gif,image/png]|max_size[bukti,51200]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg, jpeg, gif, png',
                    'max_size' => 'Ukuran File Maksimal 50 MB'
                ]

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $laporan = $this->LaporanModel;
        $dataLaporan = $this->request->getFile('bukti');
        $fileName = $dataLaporan->getRandomName();
        $laporan->insert([
            'nama_pelapor' => $this->request->getVar('nama_pelapor'),
            'lokasi' => $this->request->getVar('lokasi'),
            'jenis_kerusakan' => $this->request->getVar('jenis_kerusakan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'bukti' => $fileName
        ]);
        $dataLaporan->move('uploads/bukti/', $fileName);
        session()->setFlashdata('success', 'Laporan Berhasil diupload');
        return redirect()->to(base_url('Pages/pelaporan'));
    }

    public function detailLaporan($id_pelaporan)
    {
        $laporan = $this->LaporanModel;
        $data = [
            'title' => 'Detail',
            'laporan' => $laporan->find($id_pelaporan)
        ];
        // return view('admin/detailLaporan', $data);
        dd($data);
    }
}
