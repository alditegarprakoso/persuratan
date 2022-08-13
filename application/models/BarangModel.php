<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangModel extends CI_Model
{
    public function getBarangAll()
    {
        return $this->db->get('barang')->result_array();
    }

    public function CreateCode()
    {
        $this->db->select('RIGHT(barang.kode_barang,3) as kode_barang', FALSE);
        $this->db->order_by('kode_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "BRG-" . $batas;
        return $kodetampil;
    }

    public function getBarangById($id)
    {
        return $this->db->get_where('barang', ['id' => $id])->row_array();
    }

    public function insertBarang($data)
    {
        return $this->db->insert('barang', $data);
    }

    public function updateBarang($data, $id)
    {
        return $this->db->update('barang', $data, ['id' => $id]);
    }
}

/* End of file BarangModel.php */
