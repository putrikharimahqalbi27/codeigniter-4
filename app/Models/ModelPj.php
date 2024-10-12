<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPj extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_pj')
            ->orderBy('id_pj', 'DESC')
            ->get()->getResultArray();
    }
    public function AddData($data)
    {
        $this->db->table('tbl_pj')->insert($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_pj')
            ->where('id_pj', $data['id_pj'])
            ->delete($data);
    }
    public function EditData($data)
    {
        $this->db->table('tbl_pj')
            ->where('id_pj', $data['id_pj'])
            ->update($data);
    }
}
