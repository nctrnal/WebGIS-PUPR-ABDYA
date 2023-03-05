<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BerkasModel;

class Berkas extends BaseController
{
    public function index()
    {
        $berkas = new BerkasModel();
        $data['berkas'] = [
            'title' => 'Data Irigasi Admin',
            $berkas->findAll()
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

        $berkas = new BerkasModel();
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

    public function dataIrigasi()
    {
        $berkas = new BerkasModel();
        $data['berkas'] = [
            'title' => 'Data Irigasi | Dinas PUPR Kabupaten Aceh Barat Daya',
            $berkas->findAll()
        ];
        echo view('pages/dataIrigasi', $data);
    }

    public function delete($id = null)
    {
        $berkas = new BerkasModel();
        $berkas->delete($id);
        session()->setFlashdata('success', 'Berkas Berhasil dihapus');
        return redirect()->to('/Berkas');
    }

    public function download($id)
    {
        $berkas = new BerkasModel();
        $data = $berkas->find($id);
        return $this->response->download('uploads/berkas/' . $data->pdf, null);
    }

    public function update($id)
    {
        $berkas = new BerkasModel();
        $data['berkas'] = $berkas->findAll($id);
        if (empty($berkas)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data daerah irigasi tidak ditemukan !!');
        }
        return view('admin/form_update', $data);
    }

    public function updateData($id)
    {
        if (!$this->validate([
            'namaDaerah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'pdf' => [
                'rules' => 'uploaded[pdf]',
                'errors' => [
                    'required' => 'File yang di upload harus berupa PDF'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }

        $berkas = new BerkasModel();
        $dataBerkas = $this->request->getFile('pdf');
        $fileName = $dataBerkas->getRandomName();
        $berkas->update($id, [
            'pdf' => $fileName,
            'namaDaerah' => $this->request->getVar('namaDaerah')
        ]);
        $dataBerkas->move('uploads/berkas/', $fileName);
        session()->setFlashdata('message', 'Update Data Irigasi Berhasil');
        return redirect()->to('/Berkas');
    }
}
