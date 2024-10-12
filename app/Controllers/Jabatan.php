<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelJabatan;

class Jabatan extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelJabatan = new ModelJabatan;
    }

    public function index()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'jabatan',
            'judul' => 'Organisasi ',
            'page' => 'v_jabatan',
            'jabatan' => $this->ModelJabatan->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
        ];
        $this->ModelJabatan->AddData($data);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to(base_url('Jabatan'));
    }
    public function EditData($id_jabatan)
    {
        $data = [


            'id_jabatan' => $id_jabatan,
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
        ];
        $this->ModelJabatan->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diUpdate');
        return redirect()->to(base_url('Jabatan'));
    }
    public function DeleteData($id_jabatan)
    {
        $data = [
            'id_jabatan' => $id_jabatan

        ];
        $this->ModelJabatan->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('Jabatan'));
    }
}
