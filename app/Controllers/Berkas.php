<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BerkasModel;
use App\Models\BerkasJaringanModel;
use App\Models\JaringanIrigasiModel;
use App\Models\DaerahIrigasiModel;
use App\Models\BangunanIrigasiModel;
use CodeIgniter\Filters\Filters;
use Dompdf\Dompdf;

class Berkas extends BaseController
{
    protected $BerkasModel;
    protected $BerkasJaringanModel;
    protected $JaringanIrigasiModel;
    protected $DaerahIrigasiModel;
    protected $BangunanIrigasiModel;

    public function __construct()
    {
        $this->BerkasModel = new BerkasModel();
        $this->BerkasJaringanModel = new BerkasJaringanModel();
        $this->JaringanIrigasiModel = new JaringanIrigasiModel();
        $this->DaerahIrigasiModel = new DaerahIrigasiModel();
        $this->BangunanIrigasiModel = new BangunanIrigasiModel();
    }


    //UNTUK BERKAS DAERAH IRIGASI

    public function viewDaerah($id)
    {
        $data = [
            'title' => 'Berita',
            'daerah' => $this->BerkasModel->find($id)
        ];

        return view('pages/viewDaerah', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'namaDaerah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            //note : masih belum tau cara validasi buat file yang ekstensi nya pdf
            'pdf' => [
                'rules' => 'uploaded[pdf]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                ]

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $berkas = $this->BerkasModel;
        $dataBerkas = $this->request->getFile('pdf');
        $fileName = $dataBerkas->getRandomName();
        $berkas->insert([
            'pdf' => $fileName,
            'namaDaerah' => $this->request->getVar('namaDaerah')
        ]);
        $dataBerkas->move('uploads/berkas/', $fileName);
        session()->setFlashdata('success', 'Berkas Berhasil diupload');
        return redirect()->to(base_url('Admin/dataDaerahIrigasiAdmin'));
    }

    public function delete($id = null)
    {
        $berkas = $this->BerkasModel;
        $berkas->delete($id);
        session()->setFlashdata('success', 'Berkas Berhasil dihapus');
        return redirect()->to('Admin/dataDaerahIrigasiAdmin');
    }

    public function download($id)
    {
        $berkas = $this->BerkasModel;
        $data = $berkas->find($id);
        return $this->response->download('uploads/berkas/' . $data->pdf, null);
    }

    public function update($id)
    {
        $berkas = $this->BerkasModel->find($id);

        if (empty($berkas)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data daerah irigasi tidak ditemukan !!');
        }
        $data = [
            'title' => 'Berkas Daerah Irigasi',
            'berkas' => $berkas
        ];
        return view('admin/form_update', $data);
    }

    public function updateData($id)
    {
        if (!$this->validate([
            'namaDaerah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama daerah harus diisi'
                ]
            ],
            'pdf' => [
                'rules' => 'uploaded[pdf]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang di upload'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        $berkas = $this->BerkasModel;
        $dataBerkas = $this->request->getFile('pdf');
        $fileName = $dataBerkas->getRandomName();
        $berkas->update($id, [
            'namaDaerah' => $this->request->getVar('namaDaerah'),
            'pdf' => $fileName
        ]);
        $dataBerkas->move('uploads/berkas/', $fileName);
        session()->setFlashdata('success', 'Update Data Irigasi Berhasil');
        return redirect()->to('Admin/dataDaerahIrigasiAdmin');
    }

    //UNTUK BERKAS JARINGAN IRIGASI

    public function viewJaringan($id_berkas)
    {
        $data = [
            'title' => 'Berkas Jaringan Irigasi',
            'jaringan' => $this->BerkasJaringanModel->find($id_berkas)
        ];

        return view('pages/viewJaringan', $data);
    }

    public function saveJaringan()
    {
        if (!$this->validate([
            'nama_daerah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            //note : masih belum tau cara validasi buat file yang ekstensi nya pdf
            'pdf' => [
                'rules' => 'uploaded[pdf]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                ]

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $berkas = $this->BerkasJaringanModel;
        $dataBerkas = $this->request->getFile('pdf');
        $fileName = $dataBerkas->getRandomName();
        $berkas->insert([
            'pdf' => $fileName,
            'nama_daerah' => $this->request->getVar('nama_daerah')
        ]);
        $dataBerkas->move('uploads/berkas/', $fileName);
        session()->setFlashdata('success', 'Berkas Berhasil diupload');
        return redirect()->to(base_url('Admin/dataJaringanIrigasiAdmin'));
    }

    public function deleteJaringan($id_berkas = null)
    {
        $berkas = $this->BerkasJaringanModel;
        $berkas->delete($id_berkas);
        session()->setFlashdata('success', 'Berkas Berhasil dihapus');
        return redirect()->to('Admin/dataJaringanIrigasiAdmin');
    }

    public function downloadJaringan($id_berkas)
    {
        $berkas = $this->BerkasJaringanModel;
        $data = $berkas->find($id_berkas);
        return $this->response->download('uploads/berkas/' . $data->pdf, null);
    }

    public function updateJaringan($id_berkas)
    {
        $berkas = $this->BerkasJaringanModel->find($id_berkas);

        if (empty($berkas)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data daerah irigasi tidak ditemukan !!');
        }
        $data = [
            'title' => 'Berkas Jaringan Irigasi',
            'berkas' => $berkas
        ];
        return view('admin/form_updateJaringan', $data);
    }

    public function updateDataJaringan($id_berkas)
    {
        if (!$this->validate([
            'nama_daerah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama daerah harus diisi'
                ]
            ],
            'pdf' => [
                'rules' => 'uploaded[pdf]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang di upload'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        $berkas = $this->BerkasJaringanModel;
        $dataBerkas = $this->request->getFile('pdf');
        $fileName = $dataBerkas->getRandomName();
        $berkas->update($id_berkas, [
            'nama_daerah' => $this->request->getVar('nama_daerah'),
            'pdf' => $fileName
        ]);
        $dataBerkas->move('uploads/berkas/', $fileName);
        session()->setFlashdata('success', 'Update Data Irigasi Berhasil');
        return redirect()->to('Admin/dataJaringanIrigasiAdmin');
    }

    // Download Geojson
    public function downloadJaringanGeojson($id)
    {
        $jaringan = $this->JaringanIrigasiModel;
        $data = $jaringan->find($id);
        // dd($data);
        return $this->response->download('geojson/jaringanIrigasi/' . $data->json, null);
    }
    public function downloadBangunanGeojson($id)
    {
        $bangunan = $this->BangunanIrigasiModel;
        $data = $bangunan->getBangunanId($id);
        return $this->response->download('geojson/bangunanIrigasi/' . $data->json, null);
    }
    public function downloadDaerahGeojson($id)
    {
        $daerah = $this->DaerahIrigasiModel;
        $data = $daerah->find($id);
        return $this->response->download('geojson/daerahIrigasi/' . $data->json, null);
    }
}
