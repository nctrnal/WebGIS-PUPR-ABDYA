<?php

namespace App\Controllers;

use App\Models\JaringanIrigasiModel;
use App\Models\DaerahIrigasiModel;
use App\Models\BangunanIrigasiModel;
use App\Models\KategoriModel;

class Irigasi extends BaseController
{
    protected $JaringanIrigasiModel;
    protected $DaerahIrigasiModel;
    protected $BangunanIrigasiModel;
    protected $KategoriModel;

    public function __construct()
    {
        $this->BangunanIrigasiModel = new BangunanIrigasiModel();
        $this->DaerahIrigasiModel = new DaerahIrigasiModel();
        $this->JaringanIrigasiModel = new JaringanIrigasiModel();
        $this->KategoriModel = new KategoriModel();
    }

    //Controller ini berfungsi untuk menangani CRUD untuk mengelola peta
    public function jaringanIrigasiAdmin()
    {
        $data = [
            'title' => 'Jaringan Irigasi',
            'kategori' => $this->KategoriModel->getAllKategori(),
            'jaringan' => $this->JaringanIrigasiModel->getAllJaringan()
        ];

        echo view('admin/jaringanIrigasiAdmin', $data);
    }
    public function bangunanIrigasiAdmin()
    {
        $data = [
            'title' => 'Bangunan Irigasi',
            'kategori' => $this->KategoriModel->getAllKategori(),
            'bangunan' => $this->BangunanIrigasiModel->getAllBangunan()

        ];

        echo view('admin/bangunanIrigasiAdmin', $data);
    }
    public function daerahIrigasiAdmin()
    {
        $data = [
            'title' => 'Daerah Irigasi',
            'kategori' => $this->KategoriModel->getAllKategori(),
            'daerah' => $this->DaerahIrigasiModel->getAllDaerah()
        ];

        echo view('admin/daerahIrigasiAdmin', $data);
    }

    //UNTUK JARINGAN IRIGASI
    //Upload Jaringan Irigasi
    public function simpanJaringanIrigasi()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'panjang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'json' => [
                'rules' => 'uploaded[json]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload'
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
            return redirect()->back()->withInput();
        }
        $irigasi = $this->JaringanIrigasiModel;
        $dataIrigasi = $this->request->getFile('foto');
        $dataJson = $this->request->getFile('json');
        $fileJson = $dataJson->getRandomName();
        $fileName = $dataIrigasi->getRandomName();
        $irigasi->insert([
            'nama' => $this->request->getVar('nama'),
            'panjang' => $this->request->getVar('panjang'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kondisi' => $this->request->getVar('kondisi'),
            'json' => $fileJson,
            'foto' => $fileName
        ]);

        $dataJson->move('geojson/jaringanIrigasi/', $fileJson);
        $dataIrigasi->move('uploads/fotoIrigasi/jaringanIrigasi', $fileName);
        session()->setFlashdata('success', 'Jaringan Irigasi Berhasil diupload');
        return redirect()->to(base_url('/Irigasi/jaringanIrigasiAdmin'));
        dd($fileName);
    }
    //Hapus Jaringan Irigasi
    public function hapusJaringanIrigasi($id = null)
    {
        $irigasi = $this->JaringanIrigasiModel;
        $irigasi->delete($id);
        session()->setFlashdata('success', 'Jaringan Irigasi Berhasil Dihapus');
        return redirect()->to('/Irigasi/jaringanIrigasiAdmin');
    }

    //mengambil id jaringan irigasi
    public function ubahJaringanIrigasi($id)
    {
        $data = [
            'title' => 'Update',
            'irigasi' => $this->JaringanIrigasiModel->find($id),
            'kategori' => $this->KategoriModel->findAll()
        ];
        return view('admin/updateJaringan', $data);
    }

    //Validasi dan Update jaringan irigasi
    public function simpanUbahJaringanIrigasi($id)
    { {
            if (!$this->validate([
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'panjang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'kecamatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'kondisi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'json' => [
                    'rules' => 'uploaded[json]|mime_in[json,application/json,text/json]',
                    'errors' => [
                        'uploaded' => 'Harus ada file yang diupload',
                        'mime_in' => 'File Extention Harus Berupa json'
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
                return redirect()->back()->withInput();
            }
            $irigasi = $this->JaringanIrigasiModel;
            $dataIrigasi = $this->request->getFile('foto');
            $dataJson = $this->request->getFile('json');
            $fileJson = $dataJson->getRandomName();
            $fileName = $dataIrigasi->getRandomName();
            $irigasi->update($id, [
                'nama' => $this->request->getVar('nama'),
                'panjang' => $this->request->getVar('panjang'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kondisi' => $this->request->getVar('kondisi'),
                'json' => $fileJson,
                'foto' => $fileName
            ]);

            $dataJson->move('geojson/jaringanIrigasi/', $fileJson);
            $dataIrigasi->move('uploads/fotoIrigasi/jaringanIrigasi', $fileName);
            session()->setFlashdata('success', 'Jaringan irigasi berhasil di update');
            return redirect()->to(base_url('/Irigasi/jaringanIrigasiAdmin'));
        }
    }

    //UNTUK DAERAH IRIGASI
    //Upload daerah irigasi dan validasi
    public function simpanDaerahIrigasi()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'lebar_bawah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'lebar_atas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'warna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'json' => [
                'rules' => 'uploaded[json]|mime_in[json,application/json,text/json]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'mime_in' => 'File Extention Harus Berupa json'
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
            return redirect()->back()->withInput();
        }
        $daerah = $this->DaerahIrigasiModel;
        $dataDaerah = $this->request->getFile('foto');
        $dataJson = $this->request->getFile('json');
        $fileJson = $dataJson->getRandomName();
        $fileName = $dataDaerah->getRandomName();
        $daerah->insert([
            'nama' => $this->request->getVar('nama'),
            'lebar_bawah' => $this->request->getVar('lebar_bawah'),
            'lebar_atas' => $this->request->getVar('lebar_atas'),
            'keterangan' => $this->request->getVar('keterangan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'warna' => $this->request->getVar('warna'),
            'kondisi' => $this->request->getVar('kondisi'),
            'json' => $fileJson,
            'foto' => $fileName
        ]);

        $dataJson->move('geojson/daerahIrigasi/', $fileJson);
        $dataDaerah->move('uploads/fotoIrigasi/daerahIrigasi/', $fileName);
        session()->setFlashdata('success', 'Daerah irigasi berhasil di upload');
        return redirect()->to(base_url('/Irigasi/daerahIrigasiAdmin'));
    }

    //hapus daerah irigasi
    public function hapusDaerahIrigasi($id = null)
    {
        $daerah = $this->DaerahIrigasiModel;
        $daerah->delete($id);
        session()->setFlashdata('success', 'Daerah Irigasi Berhasil Dihapus');
        return redirect()->to('/Irigasi/daerahIrigasiAdmin');
    }

    //update daerah irigasi
    public function ubahDaerahIrigasi($id)
    {

        $data = [
            'title' => 'Update',
            'daerah' => $this->DaerahIrigasiModel->find($id),
            'kategori' => $this->KategoriModel->findAll()
        ];
        return view('admin/updateDaerah', $data);
    }

    //Validasi dan update data kedalam database
    public function simpanUbahDaerahIrigasi($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'lebar_bawah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'lebar_atas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'json' => [
                'rules' => 'uploaded[json]|mime_in[json,application/json,text/json]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'mime_in' => 'File Extention Harus Berupa json'
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
            return redirect()->back()->withInput();
        }
        $daerah = $this->DaerahIrigasiModel;
        $dataDaerah = $this->request->getFile('foto');
        $dataJson = $this->request->getFile('json');
        $fileJson = $dataJson->getRandomName();
        $fileName = $dataDaerah->getRandomName();
        $daerah->update($id, [
            'nama' => $this->request->getVar('nama'),
            'lebar_bawah' => $this->request->getVar('lebar_bawah'),
            'lebar_atas' => $this->request->getVar('lebar_atas'),
            'keterangan' => $this->request->getVar('keterangan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kondisi' => $this->request->getVar('kondisi'),
            'json' => $fileJson,
            'foto' => $fileName
        ]);

        $dataJson->move('geojson/daerahIrigasi/', $fileJson);
        $dataDaerah->move('uploads/fotoIrigasi/daerahIrigasi/', $fileName);
        session()->setFlashdata('success', 'Daerah irigasi berhasil diubah');
        return redirect()->to(base_url('/Irigasi/daerahIrigasiAdmin'));
    }

    //UNTUK BANGUNAN IRIGASI
    //Simpan bangunan irigasi
    public function simpanBangunanIrigasi()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'luas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'json' => [
                'rules' => 'uploaded[json]|mime_in[json,application/json,text/json]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'mime_in' => 'File Extention Harus Berupa json'
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
            return redirect()->back()->withInput();
        }
        $irigasi = $this->BangunanIrigasiModel;
        $dataIrigasi = $this->request->getFile('foto');
        $dataJson = $this->request->getFile('json');
        $fileJson = $dataJson->getRandomName();
        $fileName = $dataIrigasi->getRandomName();
        $irigasi->insert([
            'nama' => $this->request->getVar('nama'),
            'luas' => $this->request->getVar('luas'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'json' => $fileJson,
            'foto' => $fileName
        ]);

        $dataJson->move('geojson/bangunanIrigasi/', $fileJson);
        $dataIrigasi->move('uploads/fotoIrigasi/bangunanIrigasi/', $fileName);
        session()->setFlashdata('success', 'Bangunan Irigasi Berhasil diupload');
        return redirect()->to(base_url('/Irigasi/bangunanIrigasiAdmin'));
    }

    //hapus bangunan irigasi
    public function hapusBangunanIrigasi($id = null)
    {
        $irigasi = $this->BangunanIrigasiModel;
        $irigasi->delete($id);
        session()->setFlashdata('success', 'Bangunan Irigasi Berhasil Dihapus');
        return redirect()->to('/Irigasi/bangunanIrigasiAdmin');
    }

    // update bangunan irigasi
    public function ubahBangunanIrigasi($id)
    {
        $data = [
            'title' => 'Update',
            'bangunan' => $this->BangunanIrigasiModel->find($id),
        ];
        return view('admin/updateBangunan', $data);
    }

    //validasi dan update bangunan irigasi
    public function simpanUbahBangunanIrigasi($id)
    { {
            if (!$this->validate([
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'luas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'kecamatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong'
                    ]
                ],
                'json' => [
                    'rules' => 'uploaded[json]|mime_in[json,application/json,text/json]',
                    'errors' => [
                        'uploaded' => 'Harus ada file yang diupload',
                        'mime_in' => 'File Extention Harus Berupa json'
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
                return redirect()->back()->withInput();
            }
            $bangunan = $this->BangunanIrigasiModel;
            $dataIrigasi = $this->request->getFile('foto');
            $dataJson = $this->request->getFile('json');
            $fileJson = $dataJson->getRandomName();
            $fileName = $dataIrigasi->getRandomName();
            $bangunan->update($id, [
                'nama' => $this->request->getVar('nama'),
                'luas' => $this->request->getVar('luas'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'json' => $fileJson,
                'foto' => $fileName
            ]);

            $dataJson->move('geojson/bangunanIrigasi/', $fileJson);
            $dataIrigasi->move('uploads/fotoIrigasi/bangunanIrigasi/', $fileName);
            session()->setFlashdata('success', 'Data Bangunan Irigasi Berhasil Diupload');
            return redirect()->to(base_url('/Irigasi/bangunanIrigasiAdmin'));
        }
    }
}
