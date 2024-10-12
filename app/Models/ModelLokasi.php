<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLokasi extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_lokasi')
            ->orderBy('id_lokasi', 'DESC')
            ->get()->getResultArray();
    }
    public function AddData($data)
    {
        $this->db->table('tbl_lokasi')->insert($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_lokasi')
            ->where('id_lokasi', $data['id_lokasi'])
            ->delete($data);
    }
    public function EditData($data)
    {
        $this->db->table('tbl_lokasi')
            ->where('id_lokasi', $data['id_lokasi'])
            ->update($data);
    }
}
