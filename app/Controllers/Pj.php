<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPj;

class Pj extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelPj = new ModelPj;
    }

    public function index()
    {
        $data = [
            'menu' => 'masterbarang',
            'submenu' => 'pj',
            'judul' => 'Penanggung Jawab',
            'page' => 'v_pj',
            'pj' => $this->ModelPj->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'nama_pj' => $this->request->getPost('nama_pj'),
        ];
        $this->ModelPj->AddData($data);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to(base_url('Pj'));
    }
    public function EditData($id_pj)
    {
        $data = [
            'id_pj' => $id_pj,
            'nama_pj' => $this->request->getPost('nama_pj'),
        ];
        $this->ModelPj->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diUpdate');
        return redirect()->to(base_url('Pj'));
    }
    public function DeleteData($id_pj)
    {
        $data = [
            'id_pj' => $id_pj

        ];
        $this->ModelPj->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('Pj'));
    }
}
