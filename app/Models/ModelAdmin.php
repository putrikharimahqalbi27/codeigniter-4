<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function TotalBarang()
    {
        return $this->db->table('tbl_barang')->countAll();
    }
    public function TotalAnggota()
    {

        return $this->db->table('tbl_anggota')->countAll();
    }
    public function TotalUser()
    {
        return $this->db->table('tbl_user')->countAll();
    }
    public function TotalSurat()
    {
        return $this->db->table('tbl_peminjaman')->where('status_pinjam', 'diajukan')->countAllResults();
    }
}
