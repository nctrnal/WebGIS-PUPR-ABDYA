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
            $berkas->findAll(),
            'title' => 'Data Irigasi Admin'
        ];
        return view('admin/dataIrigasiAdmin', $data);
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

    function download($id)
    {
        $berkas = new BerkasModel();
        $data = $berkas->find($id);
        return $this->response->download('uploads/berkas/' . $data->pdf, null);
    }
}
