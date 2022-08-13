<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function insertUser($data)
    {
        return $this->db->insert('user', $data);
    }

    public function updateUser($data, $id)
    {
        return $this->db->update('user', $data, ['id' => $id]);
    }
}

/* End of file UserModel.php */
