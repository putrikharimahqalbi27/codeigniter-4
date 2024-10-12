<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPengaturan;

class Pengaturan extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelPengaturan = new ModelPengaturan();
    }
    public function web()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'web',
            'judul' => 'Pengaturan WEB',
            'page' => 'v_pengaturan_web',
            'web' => $this->ModelPengaturan->DetailWeb(),

        ];
        return view('v_template_admin', $data);
    }
    public function UpdateWeb()
    {
        if ($this->validate([
            'bmn_univ' => [
                'label' => 'Nama Organisasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',

                ]
            ],
            'kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'kab_kota' => [
                'label' => 'Kabupaten Kota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'pos' => [
                'label' => 'Kode Pos',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]
            ],
            'no_telpon' => [
                'label' => 'No Telpon  ',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]

            ],
            'sejarah' => [
                'label' => 'Sejarah  ',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]

            ],
            'visi' => [
                'label' => 'Visi  ',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]

            ],
            'misi' => [
                'label' => 'Misi ',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi !!',
                ]

            ],
            'logo' => [
                'label' => 'Logo Organisasi',
                'rules' => 'max_size[logo,1024]|mime_in[logo,image/png]',
                'errors' => [
                    'max_size' => '{field} Max 1024 kb',
                    'mime_in' => '{field} Format Foto harus png !',
                ]
            ],

        ])) {

            // jika lolos validasi data
            $logo = $this->request->getFile('logo');

            if ($logo->getError() == 4) {
                //jika ganti logo
                $data = [
                    'id_web' => '1',
                    'bmn_univ' => $this->request->getPost('bmn_univ'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'pos' => $this->request->getPost('pos'),
                    'no_telpon' => $this->request->getPost('no_telpon'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                ];
                $this->ModelPengaturan->UpdateWeb($data);
            } else {

                //hapus foto lama
                $web = $this->ModelPengaturan->DetailWeb();
                if ($web['logo'] <> '') {
                    unlink('logo/' . $web['logo']);
                }

                //jika ganti foto
                $nama_file = $logo->getRandomName();
                $data = [
                    'id_web' => '1',
                    'bmn_univ' => $this->request->getPost('bmn_univ'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'pos' => $this->request->getPost('pos'),
                    'no_telpon' => $this->request->getPost('no_telpon'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                    'logo' => $nama_file,
                ];

                //memindahkan/ upload file foto kedalam folder foto
                $logo->move('logo', $nama_file);
                $this->ModelPengaturan->UpdateWeb($data);
            }


            session()->setFlashdata('pesan', 'Data Web  Berhasil diUpdate');
            return redirect()->to(base_url('Pengaturan/web'));
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pengaturan/web'));

            //jika tidak lolos validasi data
        }
    }
    public function Slider()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'slider',
            'judul' => 'Data Slider',
            'page' => 'v_slider',
            'slider' => $this->ModelPengaturan->Slider(),

        ];
        return view('v_template_admin', $data);
    }
    public function EditSlider($id_slider)
    {
        if ($this->validate([

            'slider' => [
                'label' => 'Gambar Slider',
                'rules' => 'uploaded[slider]|max_size[slider,2048]|mime_in[slider,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 2048 kb',
                    'mime_in' => '{field} Format Foto harus jpg, png, jpeg !',
                ]
            ],

        ])) {

            // jika lolos validasi data
            $slider = $this->request->getFile('slider');
            //hapus foto lama
            $file = $this->ModelPengaturan->DetailSlider($id_slider);
            if ($file['slider'] <> '') {
                unlink('slider/' . $file['slider']);
            }

            //jika ganti foto
            $nama_file = $slider->getRandomName();
            $data = [
                'id_slider' => $id_slider,
                'slider' => $nama_file,
            ];

            //memindahkan/ upload file foto kedalam folder foto
            $slider->move('slider', $nama_file);
            $this->ModelPengaturan->UpdateSlider($data);



            session()->setFlashdata('pesan', 'Slider Berhasil diUpdate');
            return redirect()->to(base_url('Pengaturan/Slider'));
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pengaturan/Slider'));

            //jika tidak lolos validasi data
        }
    }
}
