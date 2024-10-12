<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang extends Model
{


    public function AllData()
    {
        return $this->db->table('tbl_barang')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj= tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi= tbl_barang.id_lokasi', 'left')
            ->orderBy('id_barang', 'DESC')
            ->get()->getResultArray();
    }


    public function DetailData($id_barang)
    {
        return $this->db->table('tbl_barang')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj = tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi = tbl_barang.id_lokasi', 'left')
            ->where('tbl_barang.id_barang', $id_barang)  // Menggunakan $id_barang sebagai parameter
            ->get()
            ->getRowArray();
    }

    public function AddData($data)
    {
        $this->db->table('tbl_barang')->insert($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_barang')
            ->where('id_barang', $data['id_barang'])
            ->delete($data);
    }
    public function EditData($data)
    {
        $this->db->table('tbl_barang')
            ->where('id_barang', $data['id_barang'])
            ->update($data);
    }
    public function Barangbmn()
    {
        return $this->db->table('tbl_barang')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori= tbl_barang.id_kategori', 'left')
            ->join('tbl_pj', 'tbl_pj.id_pj= tbl_barang.id_pj', 'left')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi= tbl_barang.id_lokasi', 'left')
            ->orderBy('id_barang', 'DESC')
            ->limit(5)
            ->get()->getResultArray();
    }
}
