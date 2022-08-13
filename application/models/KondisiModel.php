<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KondisiModel extends CI_Model
{
    public function getKondisiAll()
    {
        return $this->db->get('kondisi')->result_array();
    }

    public function getKondisiById($id)
    {
        return $this->db->get_where('kondisi', ['id' => $id])->row_array();
    }

    public function insertKondisi($data)
    {
        return $this->db->insert('kondisi', $data);
    }

    public function updateKondisi($data, $id)
    {
        return $this->db->update('kondisi', $data, ['id' => $id]);
    }
}

/* End of file KondisiModel.php */
