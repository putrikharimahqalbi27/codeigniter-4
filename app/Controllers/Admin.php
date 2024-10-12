<?php

namespace App\Controllers;

use App\Models\ModelAdmin;
use App\Models\ModelPeminjaman;

class Admin extends BaseController
{
    public function __construct()
    {
        helper('form'); // Memuat helper form untuk keperluan validasi dan pengolahan form
        $this->ModelAdmin = new ModelAdmin; // Inisialisasi ModelAdmin
        $this->ModelPeminjaman = new ModelPeminjaman(); // Inisialisasi ModelPeminjaman
    }

    // Menampilkan dashboard admin
    public function index(): string
    {
        // Mengumpulkan data untuk dashboard
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Dashboard',
            'page' => 'v_dashboard_admin',
            'totalanggota' => $this->ModelAdmin->TotalAnggota(), // Mengambil total anggota
            'totalbarang' => $this->ModelAdmin->TotalBarang(), // Mengambil total barang
            'totaluser' => $this->ModelAdmin->TotalUser(), // Mengambil total user
            'totalsurat' => $this->ModelAdmin->TotalSurat(), // Mengambil total surat
        ];
        return view('v_template_admin', $data); // Mengembalikan view dashboard dengan data
    }

    // Menampilkan pengajuan yang masuk
    public function PengajuanMasuk()
    {
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'pengajuanmasuk',
            'judul' => 'Pengajuan Masuk',
            'page' => 'peminjaman/v_pengajuan_masuk',
            'pengajuanmasuk' => $this->ModelPeminjaman->pengajuanmasuk(), // Mengambil data pengajuan yang masuk
        ];
        return view('v_template_admin', $data); // Mengembalikan view pengajuan masuk
    }

    // Menolak pengajuan peminjaman
    public function TolakBarang($id_pinjam)
    {
        $data = [
            'id_pinjam' => $id_pinjam, // ID peminjaman yang ditolak
            'status_pinjam' => 'Ditolak', // Status peminjaman diubah menjadi 'Ditolak'
            'keterangan' => $this->request->getPost('keterangan'), // Mengambil keterangan dari input form
        ];
        $this->ModelPeminjaman->EditData($data); // Memperbarui data peminjaman di database
        session()->setFlashdata('ditolak', 'Permohonan Berhasil Ditolak'); // Mengatur pesan flash
        return redirect()->to(base_url('Admin/PengajuanMasuk')); // Mengarahkan kembali ke halaman pengajuan masuk
    }

    // Menerima pengajuan peminjaman
    public function TerimaBarang($id_pinjam)
    {
        $data = [
            'id_pinjam' => $id_pinjam, // ID peminjaman yang diterima
            'status_pinjam' => 'Diterima', // Status peminjaman diubah menjadi 'Diterima'
            'keterangan' => $this->request->getPost('keterangan'), // Mengambil keterangan dari input form
        ];
        $this->ModelPeminjaman->EditData($data); // Memperbarui data peminjaman di database
        session()->setFlashdata('diterima', 'Permohonan Berhasil Diterima'); // Mengatur pesan flash
        return redirect()->to(base_url('Admin/PengajuanMasuk')); // Mengarahkan kembali ke halaman pengajuan masuk
    }

    public function KembaliBarang($id_pinjam)
    {
        // Ambil tanggal saat ini untuk tgl_kembali
        $tgl_kembali = date('Y-m-d H:i:s'); // Format sesuai dengan kebutuhan database Anda

        // Siapkan data untuk diupdate
        $data = [
            'id_pinjam' => $id_pinjam, // ID peminjaman yang dikembali
            'status_pinjam' => 'Dikembalikan', // Status peminjaman diubah menjadi 'Dikembali'
            'tgl_kembali' => $tgl_kembali, // Tambahkan tanggal kembali
            'keterangan' => $this->request->getPost('keterangan'), // Mengambil keterangan dari input form
        ];

        // Memperbarui data peminjaman di database
        $this->ModelPeminjaman->EditData($data);

        // Mengatur pesan flash
        session()->setFlashdata('dikembalikan', 'Barang Telah Dikembalikan');

        // Mengarahkan kembali ke halaman pengajuan masuk
        return redirect()->to(base_url('Admin/PengajuanMasuk'));
    }

    // Menampilkan pengajuan yang diterima
    public function PengajuanDiterima()
    {
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'pengajuanditerima',
            'judul' => 'Pengajuan Diterima',
            'page' => 'peminjaman/v_pengajuan_diterima',
            'pengajuanditerima' => $this->ModelPeminjaman->PengajuanDiterima(), // Mengambil data pengajuan yang diterima
        ];
        return view('v_template_admin', $data); // Mengembalikan view pengajuan diterima
    }

    // Menampilkan pengajuan yang ditolak
    public function PengajuanDitolak()
    {
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'pengajuanditolak',
            'judul' => 'Pengajuan Ditolak',
            'page' => 'peminjaman/v_pengajuan_ditolak',
            'pengajuanditolak' => $this->ModelPeminjaman->PengajuanDitolak(), // Mengambil data pengajuan yang ditolak
        ];
        return view('v_template_admin', $data); // Mengembalikan view pengajuan ditolak
    }

    public function PengajuanDikembalikan()
    {
        $data = [
            'menu' => 'peminjaman',
            'submenu' => 'pengajuandikembalikan',
            'judul' => 'Barang Telah Di kembalikan',
            'page' => 'peminjaman/v_pengajuan_dikembalikan',
            'pengajuandikembalikan' => $this->ModelPeminjaman->PengajuanDikembalikan(), // Mengambil data pengajuan yang diterima
        ];
        return view('v_template_admin', $data); // Mengembalikan view pengajuan diterima
    }
}
