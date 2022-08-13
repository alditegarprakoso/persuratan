<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MerkModel extends CI_Model
{
    public function getMerkAll()
    {
        return $this->db->get('merk')->result_array();
    }

    public function getMerkById($id)
    {
        return $this->db->get_where('merk', ['id' => $id])->row_array();
    }

    public function insertMerk($data)
    {
        return $this->db->insert('merk', $data);
    }

    public function updateMerk($data, $id)
    {
        return $this->db->update('merk', $data, ['id' => $id]);
    }
}

/* End of file MerkModel.php */
