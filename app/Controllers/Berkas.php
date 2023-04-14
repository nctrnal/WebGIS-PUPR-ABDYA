<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BerkasModel;

class Berkas extends BaseController
{
    protected $BerkasModel;

    public function __construct()
    {
        $this->BerkasModel = new BerkasModel();
    }

    public function index()
    {
        $berkas = $this->BerkasModel->findAll();
        $data = [
            'title' => 'Data Irigasi Admin',
            'berkas' => $berkas
        ];
        echo view('admin/dataIrigasiAdmin', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Dinas PUPR Kabupaten Aceh Barat Daya'
        ];
        echo view('admin/form_upload', $data);
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
        return redirect()->to(base_url('Berkas/index'));
    }

    // public function dataIrigasi()
    // {
    //     $berkas = new BerkasModel();
    //     $data['berkas'] = [
    //         'title' => 'Data Irigasi | Dinas PUPR Kabupaten Aceh Barat Daya',
    //         $berkas->findAll()
    //     ];
    //     echo view('pages/dataIrigasi', $data);
    // }

    public function delete($id = null)
    {
        $berkas = $this->BerkasModel;
        $berkas->delete($id);
        session()->setFlashdata('success', 'Berkas Berhasil dihapus');
        return redirect()->to('/Berkas');
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
            'title' => 'Update',
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
        return redirect()->to('/Berkas');


        // cara lain

        // $this->BerkasModel->update($id, [
        //     'namaDaerah' => $this->request->getPost('namaDaerah'),
        //     'pdf' => $this->request->getVar('pdf')
        // ]);

        // return redirect('berkas')->with('success', 'Data Berhasil di Update');
    }
}
