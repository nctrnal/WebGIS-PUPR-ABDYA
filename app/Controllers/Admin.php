<?php

namespace App\Controllers;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use App\Models\BerkasModel;
use App\Models\BerkasJaringanModel;
use App\Models\LaporanModel;
use App\Models\LaporanDiterimaModel;
use App\Models\BeritaModel;
use App\Models\KategoriModel;
use App\Models\LoginModel;


class Admin extends BaseController
{
    protected $BerkasModel;
    protected $BerkasJaringanModel;
    protected $LaporanModel;
    protected $LaporanDiterimaModel;
    protected $BeritaModel;
    protected $KategoriModel;
    protected $LoginModel;

    public function __construct()
    {
        $this->BerkasModel = new BerkasModel();
        $this->BerkasJaringanModel = new BerkasJaringanModel();
        $this->LaporanModel = new LaporanModel();
        $this->LaporanDiterimaModel = new LaporanDiterimaModel();
        $this->BeritaModel = new BeritaModel();
        $this->KategoriModel = new KategoriModel();
        $this->LoginModel = new LoginModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'berita' => $this->BeritaModel->findAll()

        ];
        echo view('admin/homeAdmin', $data);
    }

    //CRUD untuk Admin

    //Menampilkan data irigasi, pada function ini memiliki hubungan dengan
    //Controller BerkasController
    public function dataDaerahIrigasiAdmin()
    {
        $berkas = $this->BerkasModel->findAll();
        $data = [
            'title' => 'Berkas Daerah Irigasi',
            'berkas' => $berkas
        ];

        echo view('admin/dataDaerahIrigasiAdmin', $data);
    }

    public function dataJaringanIrigasiAdmin()
    {
        $berkas = $this->BerkasJaringanModel->findAll();
        $data = [
            'title' => 'Berkas Jaringan Irigasi',
            'berkas' => $berkas
        ];

        echo view('admin/dataJaringanIrigasiAdmin', $data);
    }

    //menampilkan data laporan dari masyarakat
    public function lihatLaporan()
    {

        $data = [
            'title' => 'Pelaporan',
            'laporan' => $this->LaporanModel->findAll(),
            // 'laporan' => $this->LaporanModel->orderBy("created_at", "desc")
        ];

        // dd($data);
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
            'pelapor' => [
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
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'latitude' => [
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
            'pelapor' => $this->request->getVar('pelapor'),
            'lokasi' => $this->request->getVar('lokasi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'longitude' => $this->request->getVar('longitude'),
            'latitude' => $this->request->getVar('latitude'),
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
        return redirect()->to(base_url('/'));
    }

    //function ini digunakan untuk melihat detail laporan masyarakat.
    //function ini akan menangkap id dari table pelaporan yaitu id_pelaporan
    //sehingga detail yang ditampilkan akan berdasarkan id dari tabel pelaporan
    public function detailLaporan($id_pelaporan)
    {
        $username = session()->get('username');
        $laporan = $this->LaporanModel;
        $kategori = $this->KategoriModel;
        $data = [
            'title' => 'Pelaporan',
            'laporan' => $laporan->find($id_pelaporan),
            'kategori' => $kategori->findAll(),
            'username' => $username,
        ];
        return view('admin/detailLaporan', $data);
        // return dd($data);
    }

    //function ini digunakan untuk insert data ke table laporanDiterima
    //sekaligus menghapus data pada tabel pelaporan
    public function terimaLaporan($id_pelaporan)
    {
        //mengambil username admin yang melakukan perubahan data dari session
        $username = session()->get('username');

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
                'pelapor' => [
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
                'longitude' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'latitude' => [
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
            'user' => $username,
            'pelapor' => $this->request->getVar('pelapor'),
            'lokasi' => $this->request->getVar('lokasi'),
            'jenis_kerusakan' => $this->request->getVar('jenis_kerusakan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'longitude' => $this->request->getVar('longitude'),
            'latitude' => $this->request->getVar('latitude'),
            'bukti' => $this->request->getVar('bukti')
        ]);

        //query dibawa digunakan untuk menghapus laporan sebelumnya di tabel
        //pelaporan. hal ini dilakukan agar data yang ditampilkan di function
        //lihatLaporan() tidak menumpuk.
        $this->LaporanModel->deleteLaporan($id_pelaporan);

        session()->setFlashdata('success', 'Laporan Diterima');
        session()->setFlashdata('error', 'Laporan Tidak Terkirim');
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

    public function berita()
    {
        $data = [
            'title' => 'Beranda',
            'kategori' => $this->KategoriModel->findAll(),
            'berita' => $this->BeritaModel
        ];
        echo view('admin/form_berita', $data);
    }

    public function tambahBerita()
    {
        $user = session()->get('username');

        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'body' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,51200]',
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
        $berita = $this->BeritaModel;
        $dataBerita = $this->request->getFile('foto');
        $fileName = $dataBerita->getRandomName();
        $berita->insert([
            'foto' => $fileName,
            'judul' => $this->request->getVar('judul'),
            'penulis' => $user,
            'kategori' => $this->request->getVar('kategori'),
            'body' => $this->request->getVar('body')
        ]);

        $dataBerita->move('uploads/berita/', $fileName);
        session()->setFlashdata('success', 'Berita berhasil ditambahkan');
        return redirect()->to(base_url('/Admin'));
    }

    public function detailBerita($id_berita)
    {
        $data = [
            'title' => 'Beranda',
            'laporan' => $this->BeritaModel->find($id_berita)
        ];
        return view('admin/detailLaporan', $data);
    }

    public function update($id_berita)
    {
        $berita = $this->BeritaModel->find($id_berita);
        $data = [
            'title' => 'Beranda',
            'berita' => $berita,
            'kategori' => $this->KategoriModel->findAll()
        ];

        if (empty($berita)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Berita tidak ditemukan !!');
        }

        return view('admin/form_beritaUpdate', $data);
    }

    public function updateBerita($id_berita)
    {
        $user = session()->get('username');

        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'body' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,51200]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg, jpeg, gif, png',
                    'max_size' => 'Ukuran File Maksimal 50 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        $berita = $this->BeritaModel;
        $dataBerita = $this->request->getFile('foto');
        $fileName = $dataBerita->getRandomName();
        $berita->update($id_berita, [
            'judul' => $this->request->getVar('judul'),
            'penulis' => $user,
            'kategori' => $this->request->getVar('kategori'),
            'body' => $this->request->getVar('body'),
            'foto' => $fileName
        ]);
        $dataBerita->move('uploads/berita/', $fileName);
        session()->setFlashdata('success', 'Update berita berhasil');
        return redirect()->to('/Admin');
    }

    public function delete($id_berita = null)
    {
        $this->BeritaModel->delete($id_berita);
        session()->setFlashdata('success', 'Berita berhasil dihapus');
        return redirect()->to('/Admin');
    }

    // public function masuk()
    // {
    //     echo view('pages/v_login');
    // }

    // public function regis()
    // {
    //     if (!$this->validate([
    //         'username' => [
    //             'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
    //             'errors' => [
    //                 'required' => '{field} Harus diisi',
    //                 'min_length' => '{field} Minimal 4 Karakter',
    //                 'max_length' => '{field} Maksimal 20 Karakter',
    //                 'is_unique' => 'Username sudah digunakan sebelumnya'
    //             ]
    //         ],
    //         'password' => [
    //             'rules' => 'required|min_length[4]|max_length[50]',
    //             'errors' => [
    //                 'required' => '{field} Harus diisi',
    //                 'min_length' => '{field} Minimal 4 Karakter',
    //                 'max_length' => '{field} Maksimal 50 Karakter',
    //             ]
    //         ],
    //         'password_conf' => [
    //             'rules' => 'matches[password]',
    //             'errors' => [
    //                 'matches' => 'Konfirmasi Password tidak sesuai dengan password',
    //             ]
    //         ],
    //     ])) {
    //         session()->setFlashdata('error', $this->validator->listErrors());
    //         return redirect()->back()->withInput();
    //     }
    //     $users = new LoginModel();
    //     $users->insert([
    //         'username' => $this->request->getVar('username'),
    //         'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
    //     ]);
    //     return redirect()->to('Pages/');
    // }
}
