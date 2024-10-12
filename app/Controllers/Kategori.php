<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelKategori;

class Kategori extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelKategori = new ModelKategori;
    }
    public function index()
    {
        $data = [

            'menu' => 'masterbarang',
            'submenu' => 'kategori',
            'judul' => 'Kategori',
            'page' => 'v_kategori',
            'kategori' => $this->ModelKategori->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $this->ModelKategori->AddData($data);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to(base_url('Kategori'));
    }
    public function EditData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];
        $this->ModelKategori->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diUpdate');
        return redirect()->to(base_url('Kategori'));
    }
    public function DeleteData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori
        ];
        $this->ModelKategori->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('Kategori'));
    }
}
