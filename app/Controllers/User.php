<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelUser;
use CodeIgniter\Validation\StrictRules\Rules;

class User extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelUser = new ModelUser;
    }

    public function index()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'User',
            'page' => 'user/v_index',
            'user' => $this->ModelUser->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {

        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'Tambah Data User',
            'page' => 'user/v_adddata',
            'user' => $this->ModelUser->AllData(),

        ];
        return view('v_template_admin', $data);
    }
    public function SimpanData()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                    'is_unique' => '{field} Sudah terdaftar Gunakan email yang lain !!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]

            ],
            'level' => [
                'label' => 'level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi !!',
                    'max_size' => '{field} Max 1024 kb',
                    'mime_in' => '{field} Format Foto harus jpg, png, gif, jpeg !',
                ]
            ],

        ])) {


            // jika lolos validasi data
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'no_hp' => $this->request->getPost('no_hp'),
                'level' => $this->request->getPost('level'),
                'foto' => $nama_file,
            ];

            //memindahkan/ upload file foto kedalam folder foto
            $foto->move('foto', $nama_file);
            $this->ModelUser->AddData($data);
            session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
            return redirect()->to(base_url('User'));
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/AddData'))->withInput('validation', \config\Services::validation());

            //jika tidak lolos validasi data
        }
    }

    public function EditData($id_user)
    {

        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'Edit Data User',
            'page' => 'user/v_editdata',
            'user' => $this->ModelUser->DetailData($id_user),

        ];
        return view('v_template_admin', $data);
    }
    public function UpdateData($id_user)
    {
        // Validasi input
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                    'valid_email' => '{field} harus berformat email yang valid!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                    'numeric' => '{field} harus berupa angka!',
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 1024 kb',
                    'mime_in' => '{field} Format Foto harus jpg, png, gif, jpeg!',
                ]
            ],
        ])) {
            // Jika validasi lolos
            $foto = $this->request->getFile('foto');

            if ($foto->getError() == 4) {
                // Jika tidak mengganti foto
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                ];
                $this->ModelUser->EditData($data);
            } else {
                // Menghapus foto lama jika ada
                $user = $this->ModelUser->DetailData($id_user);
                if (!empty($user['foto'])) {
                    $oldFilePath = 'foto/' . $user['foto'];
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); // Hapus file foto lama
                    }
                }

                // Upload dan simpan foto baru
                $nama_file = $foto->getRandomName();
                $foto->move('foto', $nama_file);

                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                    'foto' => $nama_file,
                ];

                $this->ModelUser->EditData($data);
            }

            // Set pesan sukses dan redirect
            session()->setFlashdata('pesan', 'Data Berhasil diUpdate');
            return redirect()->to(base_url('User'));
        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/EditData/' . $id_user))->withInput();
        }
    }

    public function DeleteData($id_user)
    {
        // Hapus foto lama
        $user = $this->ModelUser->DetailData($id_user);

        // Pastikan $user tidak null dan 'foto' ada serta tidak kosong
        if ($user && isset($user['foto']) && $user['foto'] != '') {

            $filePath = 'foto/' . $user['foto'];

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
            'id_user' => $id_user
        ];
        $this->ModelUser->DeleteData($data);

        // Set pesan sukses dan redirect
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('User'));
    }
}
