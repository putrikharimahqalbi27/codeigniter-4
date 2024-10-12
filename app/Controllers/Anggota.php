<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelAnggota;
use App\Models\ModelJabatan;

class Anggota extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelAnggota = new ModelAnggota;
        $this->ModelJabatan = new ModelJabatan();
    }

    public function index()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'anggota',
            'judul' => 'Anggota',
            'page' => 'anggota/v_index',
            'anggota' => $this->ModelAnggota->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function Verifikasi($id_anggota)
    {
        $data = [
            'id_anggota' => $id_anggota,
            'verifikasi' => '1',
        ];
        $this->ModelAnggota->EditData($data);
        session()->setFlashdata('pesan', ' Anggota Berhasil diVerifikasi');
        return redirect()->to(base_url('Anggota'));
    }

    public function AddData()
    {

        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'anggota',
            'judul' => 'Tambah Data Anggota',
            'page' => 'anggota/v_adddata',
            'jabatan' => $this->ModelJabatan->AllData(),

        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {

        if ($this->validate([

            'id_jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Belum dipilih!! ',


                ]
            ],
            'kode' => [
                'label' => 'kode',
                'rules' => 'required|is_unique[tbl_anggota.kode]',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',
                    'is_unique' =>  'NIM/NIP/NIK Sudah Terdaftar ',

                ]
            ],

            'nama_anggota' => [
                'label' => 'nama_anggota',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],

            'no_hp' => [
                'label' => 'no_hp',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],
            'jenis_kelamin' => [
                'label' => 'jenis_kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],
            'alamat' => [
                'label' => 'alamat',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],

            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',

                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi !!',
                    'max_size' => '{field} Max 1024 kb',
                    'mime_in' => '{field} Format Foto harus jpg, png, gif, jpeg !',
                ]
            ],

        ])) {
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'kode' => $this->request->getPost('kode'),
                'nama_anggota' => $this->request->getPost('nama_anggota'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $this->request->getPost('password'),
                'foto' => $nama_file,
                'verifikasi' => '1',
            ];
            $foto->move('foto', $nama_file);
            $this->ModelAnggota->AddData($data);
            session()->setFlashdata('pesan', 'Data Anggota berhasil disimpan');
            return redirect()->to(base_url('Anggota/AddData'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Anggota/AddData'));
        }
    }

    public function EditData($id_anggota)
    {

        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'anggota',
            'judul' => 'Edit Data Anggota',
            'page' => 'anggota/v_editdata',
            'jabatan' => $this->ModelJabatan->AllData(),
            'anggota' => $this->ModelAnggota->DetailData($id_anggota),
        ];
        return view('v_template_admin', $data);
    }
    public function UpdateData($id_anggota)
    {
        if ($this->validate([

            'id_jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Belum dipilih!! ',


                ]
            ],
            'kode' => [
                'label' => 'kode',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',

                ]
            ],

            'nama_anggota' => [
                'label' => 'nama_anggota',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],

            'no_hp' => [
                'label' => 'no_hp',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],
            'jenis_kelamin' => [
                'label' => 'jenis_kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],
            'alamat' => [
                'label' => 'alamat',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',


                ]
            ],

            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',

                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 1024 kb',
                    'mime_in' => '{field} Format Foto harus jpg, png, gif, jpeg !',
                ]
            ],

        ])) {

            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                //tdk ganti foto
                $data = [
                    'id_anggota' => $id_anggota,
                    'id_jabatan' => $this->request->getPost('id_jabatan'),
                    'kode' => $this->request->getPost('kode'),
                    'nama_anggota' => $this->request->getPost('nama_anggota'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'password' => $this->request->getPost('password'),
                    'verifikasi' => '1',
                ];

                $this->ModelAnggota->EditData($data);
            } else {

                $anggota = $this->ModelAnggota->DetailData($id_anggota);
                if ($anggota['foto'] <> '' or $anggota['foto'] <> 'null') {
                    unlink('foto/' . $anggota['foto']);
                }
                //jika ganti foto
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_anggota' => $id_anggota,
                    'id_jabatan' => $this->request->getPost('id_jabatan'),
                    'kode' => $this->request->getPost('kode'),
                    'nama_anggota' => $this->request->getPost('nama_anggota'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'password' => $this->request->getPost('password'),
                    'foto' => $nama_file,
                    'verifikasi' => '1',
                ];
                $foto->move('foto', $nama_file);
                $this->ModelAnggota->EditData($data);
            }

            session()->setFlashdata('pesan', 'Data Anggota berhasil diupdate');
            return redirect()->to(base_url('Anggota'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Anggota/EditData/' . $id_anggota))->withInput('validation' . \Config\Services::validation());
        }
    }
    public function DeleteData($id_anggota)
    {
        // Hapus foto lama
        $anggota = $this->ModelAnggota->DetailData($id_anggota);

        // Pastikan $anggota tidak null dan 'foto' ada serta tidak kosong
        if ($anggota && isset($anggota['foto']) && $anggota['foto'] != '') {

            $filePath = 'foto/' . $anggota['foto'];

            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                } else {
                }
            } else {
            }
        } else {
        }

        // Hapus data pengguna dari database
        $data = ['id_anggota' => $id_anggota];
        $this->ModelAnggota->DeleteData($data);

        // Set pesan sukses dan redirect
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('Anggota'));
    }
}
