<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SatuanModel extends CI_Model
{
    public function getSatuanAll()
    {
        return $this->db->get('satuan')->result_array();
    }

    public function getSatuanById($id)
    {
        return $this->db->get_where('satuan', ['id' => $id])->row_array();
    }

    public function insertSatuan($data)
    {
        return $this->db->insert('satuan', $data);
    }

    public function updateSatuan($data, $id)
    {
        return $this->db->update('satuan', $data, ['id' => $id]);
    }
}

/* End of file SatuanModel.php */
