<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAnggota;
use App\Models\ModelJabatan;
use CodeIgniter\HTTP\ResponseInterface;


class DashboardAnggota extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelAnggota = new ModelAnggota;
        $this->ModelJabatan = new ModelJabatan;
    }
    public function index()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Profile Anggota',
            'page' => 'v_dashboard_anggota',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
        ];
        return view('v_template_anggota', $data);
    }
    public function EditProfile()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Edit Profile Anggota',
            'page' => 'v_edit_profile_anggota',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
            'jabatan' => $this->ModelJabatan->AllData(),
        ];
        return view('v_template_anggota', $data);
    }
    public function UpdateProfile()
    {
        $id_anggota = session()->get('id_anggota');
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

                ];

                $this->ModelAnggota->EditData($data);
            } else {

                $anggota = $this->ModelAnggota->DetailData($id_anggota);

                // Pastikan bahwa 'foto' bukan kosong dan file benar-benar ada
                if (!empty($anggota['foto']) && file_exists('foto/' . $anggota['foto'])) {
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
                    'verifikasi' => '0',
                ];
                $foto->move('foto', $nama_file);
                $this->ModelAnggota->EditData($data);
            }

            session()->setFlashdata('pesan', 'Data Anggota berhasil diupdate');
            return redirect()->to(base_url('DashboardAnggota'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('DashboardAnggota' . $id_anggota))->withInput('validation' . \Config\Services::validation());
        }
    }
}
