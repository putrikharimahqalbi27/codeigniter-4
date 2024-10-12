<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table = 'tbl_user'; // Pastikan tabel yang digunakan benar
    protected $primaryKey = 'id'; // Kunci utama jika berbeda

    protected $allowedFields = ['email', 'password', 'nama_user', 'level']; // Sesuaikan dengan kolom tabel

    public function LoginUser($email, $password)
    {
        // Implementasi metode login
        return $this->where('email', $email)->where('password', $password)->first();
    }
    public function Daftar($data)
    {
        return $this->db->table('tbl_anggota')->insert($data);
    }
    public function LoginAnggota($kode, $password)
    {
        // Implementasi metode login
        return $this->db->table('tbl_anggota')
            ->where([
                'kode' => $kode,
                'password' => $password,
            ])->get()->getRowArray();
    }
}
