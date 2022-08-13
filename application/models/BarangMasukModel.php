<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasukModel extends CI_Model
{

    public function getBarangMasukById($id)
    {
        return $this->db->get_where('barang_masuk', ['id' => $id])->row_array();
    }

    public function insertBarangMasuk($data)
    {
        return $this->db->insert('barang_masuk', $data);
    }

    public function updateBarangMasuk($data, $id)
    {
        return $this->db->update('barang_masuk', $data, ['id' => $id]);
    }

    public function getTahun()
    {
        $query = $this->db->query("SELECT YEAR(tanggal) AS tahun FROM barang_masuk GROUP BY YEAR(tanggal) ORDER BY YEAR(tanggal) ASC");
        return $query->result_array();
    }

    public function filterByTanggal($awal, $akhir)
    {
        $query = $this->db->query("SELECT barang_masuk.id, barang_masuk.tanggal, barang.nama_barang AS barangName, barang_masuk.jumlah, kondisi.name AS kondisiName FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id JOIN kondisi ON barang_masuk.id_kondisi = kondisi.id WHERE barang_masuk.tanggal BETWEEN '$awal' and '$akhir' ORDER BY barang_masuk.tanggal ASC");
        return $query->result_array();
    }

    public function filterByBulan($tahun, $awal, $akhir)
    {
        $query = $this->db->query("SELECT barang_masuk.id, barang_masuk.tanggal, barang.nama_barang AS barangName, barang_masuk.jumlah, kondisi.name AS kondisiName FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id JOIN kondisi ON barang_masuk.id_kondisi = kondisi.id WHERE YEAR(barang_masuk.tanggal) = '$tahun' and MONTH(barang_masuk.tanggal) BETWEEN '$awal' and '$akhir' ORDER BY barang_masuk.tanggal ASC");
        return $query->result_array();
    }

    public function filterByTahun($tahun)
    {
        $query = $this->db->query("SELECT barang_masuk.id, barang_masuk.tanggal, barang.nama_barang AS barangName, barang_masuk.jumlah, kondisi.name AS kondisiName FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id JOIN kondisi ON barang_masuk.id_kondisi = kondisi.id WHERE YEAR(barang_masuk.tanggal) = '$tahun' ORDER BY barang_masuk.tanggal ASC");
        return $query->result_array();
    }
}

/* End of file BarangMasukModel.php */
