<?php

namespace App\Controllers;

use App\Models\ModelPengaturan;
use App\Models\ModelBarang;
use App\Models\ModelPeminjaman;

class Home extends BaseController
{
    protected $ModelPeminjaman;
    public function __construct()
    {
        helper('form');
        $this->ModelPengaturan = new ModelPengaturan();
        $this->ModelBarang = new ModelBarang();
        $this->ModelPeminjaman = new ModelPeminjaman();
    }
    public function index(): string

    {


        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'slider' => $this->ModelPengaturan->Slider(),
            'barang' => $this->ModelBarang->barangbmn(),

        ];
        return view('v_template', $data);
    }

    public function Sejarah()
    {
        $data = [
            'judul' => 'INFO  BMN UNSULBAR',
            'page' => 'v_sejarah',
            'profile' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template', $data);
    }
    public function VisiMisi()
    {
        $data = [
            'judul' => 'VISI & MISI',
            'page' => 'v_visi_misi',
            'profile' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template', $data);
    }
    public function GalleryBarang()
    {
        $data = [
            'judul' => 'Gallery Barang',
            'page' => 'v_gallery_barang',
            'barang' => $this->ModelBarang->AllData(),

        ];
        return view('v_template', $data);
    }

    public function GalleryBarangPinjam()
    {
        $barang = $this->ModelPeminjaman->getBarangDipinjam(); // Ambil barang yang dipinjam


        $data = [
            'judul' => 'Gallery Barang yang sedang Dipinjam',
            'page' => 'v_gallery_barang_pinjam',
            'barang' => $barang,
        ];

        return view('v_template', $data);
    }


    public function GalleryRuangan()
    {
        $data = [
            'judul' => 'Gallery Ruangan',
            'page' => 'v_gallery_ruangan',
            'barang' => $this->ModelBarang->barangbmn(),

        ];
        return view('v_template', $data);
    }
}
