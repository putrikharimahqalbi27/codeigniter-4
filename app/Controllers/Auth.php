<?php

namespace App\Controllers;

use App\Models\ModelAuth;
use App\Models\ModelJabatan;

class Auth extends BaseController
{
    protected $ModelAuth;
    public function __construct()
    {
        helper('form');
        $this->ModelAuth = new ModelAuth;
        $this->ModelJabatan = new ModelJabatan;
    }

    public function index(): string
    {
        $data = [
            'judul' => 'Login',
            'page' => 'v_login',

        ];
        return view('v_template_login', $data);
    }
    public function LoginUser()
    {
        $data = [
            'judul' => 'LoginUser',
            'page' => 'v_login_user',

        ];
        return view('v_template_login', $data);
    }
    public function CekLoginUser()
    {
        if ($this->validate([
            'email' => [
                'label' => 'email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',
                    'valid_email' =>  '{field} Harus Format E-mail!! ',
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',

                ]
            ]


        ])) {
            //jika entry  valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginUser($email, $password);
            if ($cek_login) {
                session()->set('id_user', $cek_login['id_user']);
                session()->set('nama_user', $cek_login['nama_user']);
                session()->set('email', $cek_login['email']);
                session()->set('level', $cek_login['level']);
                return redirect()->to(base_url('Admin'));
            } else {

                //jika login gagal
                session()->setFlashdata('pesan', 'Email atau password salah !!!');
                return redirect()->to(base_url('Auth/LoginUser'));
            }
        } else {
            //jika entry tdk valid
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/LoginUser'));
        }
    }
    public function LoginAnggota()
    {
        $data = [
            'judul' => 'LoginAnggota',
            'page' => 'v_login_anggota',

        ];
        return view('v_template_login', $data);
    }
    public function LogOut()
    {
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('email');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Logout Sukses');
        return redirect()->to(base_url('Auth/LoginUser'));
    }

    public function Register()
    {
        $data = [
            'judul' => 'Daftar Anggota',
            'page' => 'v_daftar_anggota',
            'jabatan' => $this->ModelJabatan->AllData(),

        ];
        return view('v_template_login', $data);
    }
    public function Daftar()
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

            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',

                ]
            ],
            'ulangi_password' => [
                'label' => 'password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' =>  '{field} Masih Kosong!! ',
                    'matches' =>  '{field} Tidak sama dengan password sebelumnya !',


                ]
            ],

        ])) {

            $data = [
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'kode' => $this->request->getPost('kode'),
                'nama_anggota' => $this->request->getPost('nama_anggota'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $this->request->getPost('password'),
                'verifikasi' => '0',
            ];
            $this->ModelAuth->Daftar($data);
            session()->setFlashdata('pesan', 'Pendaftaran Berhasil ! Silahkan Login');
            return redirect()->to(base_url('Auth/Register'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/Register'));
        }
    }
    public function CekLoginAnggota()
    {
        if ($this->validate([
            'kode' => [
                'label' => 'kode',
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
            ]


        ])) {
            //jika entry  valid
            $kode = $this->request->getPost('kode');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginAnggota($kode, $password);
            if ($cek_login) {
                session()->set('id_anggota', $cek_login['id_anggota']);
                session()->set('nama_anggota', $cek_login['nama_anggota']);
                session()->set('level', 'Anggota');
                return redirect()->to(base_url('DashboardAnggota'));
            } else {

                //jika login Anggota gagal
                session()->setFlashdata('pesan', 'NIM/ NIP /NIK Salah atau password salah !!!');
                return redirect()->to(base_url('Auth/LoginAnggota'));
            }
        } else {
            //jika entry tdk valid
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/LoginAnggota'));
        }
    }
    public function LogOutAnggota()
    {
        session()->remove('id_anggota');
        session()->remove('nama_anggota');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Logout Sukses');
        return redirect()->to(base_url('Auth/LoginAnggota'));
    }
}
