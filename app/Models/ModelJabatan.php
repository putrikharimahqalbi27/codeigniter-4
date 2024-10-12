<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJabatan extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_jabatan')
            ->orderBy('id_jabatan', 'ASC')
            ->get()->getResultArray();
    }
    public function AddData($data)
    {
        $this->db->table('tbl_jabatan')->insert($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_jabatan')
            ->where('id_jabatan', $data['id_jabatan'])
            ->delete($data);
    }
    public function EditData($data)
    {
        $this->db->table('tbl_jabatan')
            ->where('id_jabatan', $data['id_jabatan'])
            ->update($data);
    }
}
