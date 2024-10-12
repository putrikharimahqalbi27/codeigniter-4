<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelBarang;
use App\Models\ModelKategori;
use App\Models\ModelPj;
use App\Models\ModelLokasi;

class Barang extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelBarang = new ModelBarang;
        $this->ModelKategori = new ModelKategori;
        $this->ModelPj = new ModelPj;
        $this->ModelLokasi = new ModelLokasi;
    }


    public function index()
    {
        $data = [
            'menu' => 'masterbarang',
            'submenu' => 'barang',
            'judul' => 'Barang',
            'page' => 'barang/v_index',
            'barang' => $this->ModelBarang->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'menu' => 'masterbarang',
            'submenu' => 'barang',
            'judul' => 'Add Barang',
            'page' => 'barang/v_adddata',
            'kategori' => $this->ModelKategori->AllData(),
            'pj' => $this->ModelPj->AllData(),
            'lokasi' => $this->ModelLokasi->AllData(),



        ];
        return view('v_template_admin', $data);
    }
    public function SimpanData()
    {
        if ($this->validate([
            'kode_barang' => [
                'label' => 'Kode Barang',
                'rules' => 'required|is_unique[tbl_barang.kode_barang]',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                    'is_unique' => '{field} Sudah terdaftar  !!',
                ]
            ],
            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'id_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]

            ],
            'id_pj' => [
                'label' => 'Penanggung Jawab',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'id_lokasi' => [
                'label' => 'Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'gambar' => [
                'label' => 'Gambar Barang',
                'rules' => 'uploaded[gambar]|max_size[gambar,2048]|mime_in[gambar,image/png,image/jpg,image/gif,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi !!',
                    'max_size' => '{field} Max 2048 kb',
                    'mime_in' => ' Format {field} harus jpg, png, gif, jpeg !',
                ]
            ],

        ])) {


            // jika lolos validasi data
            $gambar = $this->request->getFile('gambar');
            $nama_file = $gambar->getRandomName();
            $data = [
                'kode_barang' => $this->request->getPost('kode_barang'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'id_pj' => $this->request->getPost('id_pj'),
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                'jml_tersedia' => $this->request->getPost('jml_tersedia'),
                'jml_dipinjam' => '0',
                'gambar' => $nama_file,

            ];

            //memindahkan/ upload file foto kedalam folder foto
            $gambar->move('gambar', $nama_file);
            $this->ModelBarang->AddData($data);
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('Barang/AddData'));
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Barang/AddData'))->withInput('validation', \config\Services::validation());

            //jika tidak lolos validasi data
        }
    }
    public function EditData($id_barang)
    {
        $data = [
            'menu' => 'masterbarang',
            'submenu' => 'barang',
            'judul' => 'Edit Barang',
            'page' => 'barang/v_editdata',
            'kategori' => $this->ModelKategori->AllData(),
            'pj' => $this->ModelPj->AllData(),
            'lokasi' => $this->ModelLokasi->AllData(),
            'barang' => $this->ModelBarang->DetailData($id_barang),

        ];
        return view('v_template_admin', $data);
    }
    public function UpdateData($id_barang)
    {
        if ($this->validate([
            'kode_barang' => [
                'label' => 'Kode Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',

                ]
            ],
            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'id_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]

            ],
            'id_pj' => [
                'label' => 'Penanggung Jawab',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'id_lokasi' => [
                'label' => 'Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'gambar' => [
                'label' => 'Gambar Barang',
                'rules' => 'max_size[gambar,2048]|mime_in[gambar,image/png,image/jpg,image/gif,image/jpeg]',
                'errors' => [

                    'max_size' => '{field} Max 2048 kb',
                    'mime_in' => ' Format {field} harus jpg, png, gif, jpeg !',
                ]
            ],

        ])) {


            // jika lolos validasi data
            $gambar = $this->request->getFile('gambar');
            if ($gambar->getError() == 4) {
                //tanpa ganti gambar
                $data = [
                    'id_barang' => $id_barang,
                    'kode_barang' => $this->request->getPost('kode_barang'),
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_pj' => $this->request->getPost('id_pj'),
                    'id_lokasi' => $this->request->getPost('id_lokasi'),
                    'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                ];
                $this->ModelBarang->EditData($data);
            } else {
                //jika ganti gambar
                //hapus gambar lama
                $barang = $this->ModelBarang->DetailData($id_barang);
                if ($barang['gambar'] <> '') {
                    unlink('gambar/' . $barang['gambar']);
                }
                $nama_file = $gambar->getRandomName();
                $data = [
                    'id_barang' => $id_barang,
                    'kode_barang' => $this->request->getPost('kode_barang'),
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_pj' => $this->request->getPost('id_pj'),
                    'id_lokasi' => $this->request->getPost('id_lokasi'),
                    'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                    'gambar' => $nama_file,

                ];

                //memindahkan/ upload file foto kedalam folder foto
                $gambar->move('gambar', $nama_file);
                $this->ModelBarang->EditData($data);
            }

            session()->setFlashdata('pesan', 'Data Berhasil diUpdate');
            return redirect()->to(base_url('Barang'));
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Barang/EditData/' . $id_barang))->withInput('validation', \config\Services::validation());

            //jika tidak lolos validasi data
        }
    }
    public function DeleteData($id_barang)
    {
        // Hapus foto lama
        $barang = $this->ModelBarang->DetailData($id_barang);

        // Pastikan $user tidak null dan 'foto' ada serta tidak kosong
        if ($barang && isset($barang['gambar']) && $barang['gambar'] != '') {

            $filePath = 'gambar/' . $barang['gambar'];

            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                } else {
                }
            } else {
            }
        } else {
        }

        // Hapus data pengguna dari database
        $data = [
            'id_barang' => $id_barang
        ];
        $this->ModelBarang->DeleteData($data);

        // Set pesan sukses dan redirect
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('Barang'));
    }
}
