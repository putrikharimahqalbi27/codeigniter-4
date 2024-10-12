<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeminjaman extends Model
{
    protected $table = 'tbl_peminjaman'; // Nama tabel yang digunakan
    protected $primaryKey = 'id'; // Primary key untuk tabel
    protected $allowedFields = ['nama_barang', 'nama_kategori', 'nama_pj', 'nama_lokasi', 'lantai_lokasi', 'jumlah_barang', 'status_pinjam', 'tgl_kembali']; // Kolom yang dapat diisi

    // Menambahkan data peminjaman
    public function AddData($data)
    {
        return $this->db->table('tbl_peminjaman')->insert($data);
    }

    // Mengambil data peminjaman yang diajukan oleh anggota
    public function PengajuanBarang($id_anggota)
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_barang', 'tbl_barang.id_barang= tbl_peminjaman.id_barang', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj= tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi= tbl_barang.id_lokasi', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'Diajukan')
            ->get()->getResultArray();
    }

    // Mengambil data peminjaman yang diterima oleh anggota
    public function PengajuanBarangDiterima($id_anggota)
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_barang', 'tbl_barang.id_barang= tbl_peminjaman.id_barang', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj= tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi= tbl_barang.id_lokasi', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'Diterima')
            ->get()->getResultArray();
    }

    // Mengambil data peminjaman yang ditolak oleh anggota
    public function PengajuanBarangDitolak($id_anggota)
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_barang', 'tbl_barang.id_barang= tbl_peminjaman.id_barang', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj= tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi= tbl_barang.id_lokasi', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'Ditolak')
            ->get()->getResultArray();
    }

    // Mengambil data peminjaman yang diterima oleh anggota
    public function PengajuanBarangDikembalikan($id_anggota)
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_barang', 'tbl_barang.id_barang= tbl_peminjaman.id_barang', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj= tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi= tbl_barang.id_lokasi', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'Dikembalikan')
            ->get()->getResultArray();
    }

    // Menghapus data peminjaman
    public function DeleteData($data)
    {
        $this->db->table('tbl_peminjaman')
            ->where('id_pinjam', $data['id_pinjam'])
            ->delete($data);
    }

    // Mengambil pengajuan masuk
    public function PengajuanMasuk()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota= tbl_peminjaman.id_anggota', 'left')
            ->where('status_pinjam', 'Diajukan')
            ->selectCount('tbl_peminjaman.id_anggota', 'qty')
            ->select('tbl_anggota.id_anggota,tbl_anggota.kode,tbl_anggota.nama_anggota,tbl_anggota.foto')
            ->groupBy('tbl_peminjaman.id_anggota')
            ->get()->getResultArray();
    }

    // Mengedit data peminjaman
    public function EditData($data)
    {
        $this->db->table('tbl_peminjaman')
            ->where('id_pinjam', $data['id_pinjam'])
            ->update($data);
    }

    // Mengambil pengajuan yang diterima
    public function PengajuanDiterima()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota= tbl_peminjaman.id_anggota', 'left')
            ->where('status_pinjam', 'Diterima')
            ->selectCount('tbl_peminjaman.id_anggota', 'qty')
            ->select('tbl_anggota.id_anggota,tbl_anggota.kode,tbl_anggota.nama_anggota,tbl_anggota.foto')
            ->groupBy('tbl_peminjaman.id_anggota')
            ->get()->getResultArray();
    }


    // Mengambil pengajuan yang ditolak
    public function PengajuanDitolak()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota= tbl_peminjaman.id_anggota', 'left')
            ->where('status_pinjam', 'Ditolak')
            ->selectCount('tbl_peminjaman.id_anggota', 'qty')
            ->select('tbl_anggota.id_anggota,tbl_anggota.kode,tbl_anggota.nama_anggota,tbl_anggota.foto')
            ->groupBy('tbl_peminjaman.id_anggota')
            ->get()->getResultArray();
    }

    public function PengajuanDikembalikan()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota= tbl_peminjaman.id_anggota', 'left')
            ->where('status_pinjam', 'Dikembalikan')
            ->selectCount('tbl_peminjaman.id_anggota', 'qty')
            ->select('tbl_anggota.id_anggota,tbl_anggota.kode,tbl_anggota.nama_anggota,tbl_anggota.foto')
            ->groupBy('tbl_peminjaman.id_anggota')
            ->get()->getResultArray();
    }

    // Mengambil barang yang dipinjam
    public function getBarangDipinjam()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_peminjaman.id_barang', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj = tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi = tbl_barang.id_lokasi', 'left')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan = tbl_peminjaman.id_jabatan', 'left')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota', 'left')
            ->select('tbl_peminjaman.*, tbl_barang.nama_barang, tbl_barang.gambar, tbl_barang.jumlah_barang, tbl_kategori.nama_kategori, tbl_pj.nama_pj, tbl_lokasi.nama_lokasi, tbl_jabatan.nama_jabatan, tbl_anggota.nama_anggota, tbl_peminjaman.tgl_harus_kembali')
            ->where('tbl_peminjaman.status_pinjam', 'Diterima')
            ->get()
            ->getResultArray();
    }
}
