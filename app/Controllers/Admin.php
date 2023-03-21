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
    // public function pelaporanAdmin()
    // {
    //     $data = [
    //         'title' => 'Pelaporan'
    //     ];

    //     echo view('admin/pelaporanAdmin', $data);
    // }

    //CRUD untuk Admin

    //Menampilkan data irigasi, pada function ini memiliki hubungan dengan
    //Controller BerkasController
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

    //function ini digunakan untuk menyimpan laporan masyarakat
    //kedalam database, sebelum form laporan dimasukkan kedalam
    //database, dilakukan validasi terlebih dahulu pada form tersebut
    //Note : untuk file yang di upload oleh masyarakat akan tersimpan di lokal
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
            //membuat session, untuk menampilkan pesan error jika terdapat
            //input yang tidak sesuai
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        //objek dibawah digunakan untuk mengambil input user dari form
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
        //$dataLaporan merupakan nama file yang sudah diacak untuk menghidari
        //kesamaan nama file, yang akan menyebabkan file lama akan tertimpa
        //saat ditampilkan di view.

        //file yang di upload user akan di pindahkan ke folder
        //public->uploads->bukti
        $dataLaporan->move('uploads/bukti/', $fileName);
        //membuat session, jika proses insert data kedalam database berhasil
        //akan menampilkan pesan 'Laporan Berhasil diupload'
        session()->setFlashdata('success', 'Laporan Berhasil diupload');
        return redirect()->to(base_url('Pages/pelaporan'));
    }

    //function ini digunakan untuk melihat detail laporan masyarakat.
    //function ini akan menangkap id dari table pelaporan yaitu id_pelaporan
    //sehingga detail yang ditampilkan akan berdasarkan id dari tabel pelaporan
    public function detailLaporan($id_pelaporan)
    {
        $laporan = $this->LaporanModel;
        $data = [
            'title' => 'Pelaporan',
            'laporan' => $laporan->find($id_pelaporan)
        ];
        return view('admin/detailLaporan', $data);
    }

    //function ini digunakan untuk insert data ke table laporanDiterima
    //sekaligus menghapus data pada tabel pelaporan
    public function terimaLaporan($id_pelaporan)
    {
        //code dibawah digunakan untuk melakukan validasi form yang sebelumnya
        //ditampilan saat membuka detail laporan
        if (!$this->validate(
            [
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
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],


            ]
        )) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        //code dibawa digunakan untuk memasukkan data ke tabel laporanDiterima
        $laporan = $this->LaporanDiterimaModel;
        $laporan->insert([
            'nama_pelapor' => $this->request->getVar('nama_pelapor'),
            'lokasi' => $this->request->getVar('lokasi'),
            'jenis_kerusakan' => $this->request->getVar('jenis_kerusakan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'bukti' => $this->request->getVar('bukti')
        ]);

        //query dibawa digunakan untuk menghapus laporan sebelumnya di tabel
        //pelaporan. hal ini dilakukan agar data yang ditampilkan di function
        //lihatLaporan() tidak menumpuk.
        $this->LaporanModel->deleteLaporan($id_pelaporan);

        session()->setFlashdata('success', 'Laporan Diterima');
        return redirect()->to(base_url('Admin/lihatLaporan'));
    }

    //function ini hanya menampilan semua data yang diterima
    public function laporanDiterima()
    {
        $laporan = $this->LaporanDiterimaModel->findAll();
        $data = [
            'title' => 'Pelaporan',
            'laporan' => $laporan
        ];

        return view('admin/laporanDiterima', $data);
    }

    //function ini digunakan untuk menghapus laporan masyarakat yang ditolak
    public function tolakLaporan($id_pelaporan)
    {
        $this->LaporanModel->deleteLaporan($id_pelaporan);
        session()->setFlashdata('success', 'Laporan Ditolak');
        return redirect()->to(base_url('/Admin/lihatLaporan'));
    }
}
