<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAnggota extends Model

{
    public function ProfileAnggota($id_anggota)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan = tbl_anggota.id_jabatan', 'left')
            ->where('id_anggota', $id_anggota)
            ->get()->getRowArray();
    }

    public function AllData()
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan = tbl_anggota.id_jabatan', 'left')
            ->orderBy('id_anggota', 'DESC')
            ->get()->getResultArray();
    }
    public function EditData($data)
    {
        $this->db->table('tbl_anggota')
            ->where('id_anggota', $data['id_anggota'])
            ->update($data);
    }

    public function AddData($data)
    {
        return $this->db->table('tbl_anggota')->insert($data);
    }
    public function DetailData($id_anggota)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan = tbl_anggota.id_jabatan', 'left')
            ->where('id_anggota', $id_anggota)  // Menggunakan $id_anggota sebagai parameter
            ->get()
            ->getRowArray();
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_anggota')
            ->where('id_anggota', $data['id_anggota'])
            ->delete($data);
    }
}
