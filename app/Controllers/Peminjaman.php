<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelAnggota;
use App\Models\ModelBarang;
use App\Models\ModelPeminjaman;
use Codeigniter\I18n\Time;

class Peminjaman extends BaseController
{
    protected $ModelAnggota;
    protected $ModelBarang;
    protected $ModelPeminjaman;

    public function __construct()
    {
        helper('form'); // Memuat helper form untuk keperluan validasi dan pengolahan form
        $this->ModelAnggota = new ModelAnggota(); // Inisialisasi ModelAnggota
        $this->ModelBarang = new ModelBarang(); // Inisialisasi ModelBarang
        $this->ModelPeminjaman = new ModelPeminjaman(); // Inisialisasi ModelPeminjaman
    }

    // Menampilkan halaman utama peminjaman
    public function index()
    {
        //
    }

    // Mengajukan peminjaman barang
    public function Pengajuan()
    {
        $id_anggota = session()->get('id_anggota');

        // Cek apakah user sudah login
        if (!$id_anggota) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data dari model
        $anggota = $this->ModelAnggota->ProfileAnggota($id_anggota);
        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        // Cek status verifikasi anggota
        if ($anggota['verifikasi'] == 0) {
            return redirect()->to(base_url('DashboardAnggota'))->with('error', 'Akun Anda belum terverifikasi oleh admin. Harap lengkapi data dan tunggu verifikasi sebelum melakukan pengajuan.');
        }

        // Jika sudah terverifikasi, ambil data barang dan pengajuan
        $barang = $this->ModelBarang->AllData();
        $pengajuanbarang = $this->ModelPeminjaman->PengajuanBarang($id_anggota);

        // Siapkan data untuk dikirim ke view
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'pengajuan',
            'judul' => 'Pengajuan Peminjaman',
            'page' => 'peminjaman/v_pengajuan',
            'anggota' => $anggota,
            'barang' => $barang,
            'pengajuanbarang' => $pengajuanbarang,
            'diterima' => $pengajuanbarang,
        ];

        // Kembalikan view dengan data yang dikirim
        return view('v_template_anggota', $data);
    }

    // Menambahkan pengajuan peminjaman
    public function AddPengajuan()
    {
        // Validasi input
        if ($this->validate([
            'id_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib dipilih !!',
                ]
            ],
            'surat' => [
                'label' => 'Surat Permohonan',
                'rules' => 'uploaded[surat]|max_size[surat,2048]|ext_in[surat,pdf]',
                'errors' => [
                    'uploaded' => 'Surat Permohonan harus diunggah !!',
                    'max_size' => 'Ukuran {field} maksimal 2MB !!',
                    'ext_in' => '{field} harus berformat PDF !!',
                ]
            ],
        ])) {
            // Menghitung tanggal harus kembali
            $time = Time::parse($this->request->getPost('tgl_pinjam'));
            $lama_pinjam = $this->request->getPost('lama_pinjam');
            $tgl_harus_kembali = date("Y-m-d", strtotime("+$lama_pinjam days", $time->getTimestamp()));

            // Memproses upload file
            $file = $this->request->getFile('surat');
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName(); // Membuat nama file acak
                $file->move('uploads/surat/', $fileName); // Memindahkan file ke direktori
            } else {
                session()->setFlashdata('errors', 'File tidak valid atau telah dipindahkan!');
                return redirect()->to(base_url('Peminjaman/Pengajuan'));
            }

            // Menyiapkan data untuk disimpan
            $data = [
                'no_pinjam' => $this->request->getPost('no_pinjam'),
                'tgl_pengajuan' => date('Y-m-d'),
                'id_anggota' => session()->get('id_anggota'),
                'tgl_pinjam' => $this->request->getPost('tgl_pinjam'),
                'id_barang' => $this->request->getPost('id_barang'),
                'qty' => '1',
                'lama_pinjam' => $this->request->getPost('lama_pinjam'),
                'tgl_harus_kembali' => $tgl_harus_kembali,
                'surat' => $fileName,
                'uraian_kegiatan' => $this->request->getPost('uraian_kegiatan'),
                'status_pinjam' => 'Diajukan',
            ];

            // Menyimpan data ke database
            $this->ModelPeminjaman->AddData($data);
            session()->setFlashdata('pesan', 'Peminjaman telah diajukan');
            return redirect()->to(base_url('Peminjaman/Pengajuan'));
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Peminjaman/Pengajuan'));
        }
    }

    // Menghapus data pengajuan peminjaman
    public function DeleteData($id_pinjam)
    {
        $data = [
            'id_pinjam' => $id_pinjam
        ];
        $this->ModelPeminjaman->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil diHapus');
        return redirect()->to(base_url('Peminjaman/Pengajuan'));
    }

    // Menampilkan pengajuan yang diterima
    public function PengajuanDiterima()
    {
        $id_anggota = session()->get('id_anggota');

        // Cek apakah user sudah login
        if (!$id_anggota) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data dari model
        $anggota = $this->ModelAnggota->ProfileAnggota($id_anggota);
        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        $barang = $this->ModelBarang->AllData();
        $pengajuanditerima = $this->ModelPeminjaman->PengajuanBarangDiterima($id_anggota);

        // Siapkan data untuk dikirim ke view
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'diterima',
            'judul' => 'Pengajuan Peminjaman diterima',
            'page' => 'peminjaman/v_diterima',
            'anggota' => $anggota,
            'barang' => $barang,
            'pengajuanditerima' => $pengajuanditerima,
        ];

        // Kembalikan view dengan data yang dikirim
        return view('v_template_anggota', $data);
    }

    // Menampilkan pengajuan yang ditolak
    public function PengajuanDitolak()
    {
        $id_anggota = session()->get('id_anggota');

        // Cek apakah user sudah login
        if (!$id_anggota) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data dari model
        $anggota = $this->ModelAnggota->ProfileAnggota($id_anggota);
        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        $barang = $this->ModelBarang->AllData();
        $pengajuanditolak = $this->ModelPeminjaman->PengajuanBarangDitolak($id_anggota);

        // Siapkan data untuk dikirim ke view
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'ditolak',
            'judul' => 'Pengajuan Peminjaman ditolak',
            'page' => 'peminjaman/v_ditolak',
            'anggota' => $anggota,
            'barang' => $barang,
            'pengajuanditolak' => $pengajuanditolak,
        ];

        // Kembalikan view dengan data yang dikirim
        return view('v_template_anggota', $data);
    }
    public function PengajuanDikembalikan()
    {
        $id_anggota = session()->get('id_anggota');

        // Cek apakah user sudah login
        if (!$id_anggota) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data dari model
        $anggota = $this->ModelAnggota->ProfileAnggota($id_anggota);
        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        $barang = $this->ModelBarang->AllData();
        $pengajuandikembalikan = $this->ModelPeminjaman->PengajuanBarangDikembalikan($id_anggota);

        // Siapkan data untuk dikirim ke view
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'dikembalikan',
            'judul' => 'Pengajuan Peminjaman dikembalikan',
            'page' => 'peminjaman/v_dikembalikan',
            'anggota' => $anggota,
            'barang' => $barang,
            'pengajuandikembalikan' => $pengajuandikembalikan,
        ];

        // Kembalikan view dengan data yang dikirim
        return view('v_template_anggota', $data);
    }
}
