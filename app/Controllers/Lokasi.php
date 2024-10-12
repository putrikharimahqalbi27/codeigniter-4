<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelLokasi;

class Lokasi extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelLokasi = new ModelLokasi;
    }

    public function index()
    {
        $data = [
            'menu' => 'masterbarang',
            'submenu' => 'lokasi',
            'judul' => 'Lokasi',
            'page' => 'v_lokasi',
            'lokasi' => $this->ModelLokasi->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'lantai_lokasi' => $this->request->getPost('lantai_lokasi')
        ];
        $this->ModelLokasi->AddData($data);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to(base_url('Lokasi'));
    }
    public function EditData($id_lokasi)
    {
        $data = [


            'id_lokasi' => $id_lokasi,
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'lantai_lokasi' => $this->request->getPost('lantai_lokasi')
        ];
        $this->ModelLokasi->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diUpdate');
        return redirect()->to(base_url('Lokasi'));
    }
    public function DeleteData($id_lokasi)
    {
        $data = [
            'id_lokasi' => $id_lokasi

        ];
        $this->ModelLokasi->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('Lokasi'));
    }
}
