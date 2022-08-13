<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluarModel extends CI_Model
{

    public function getBarangKeluarById($id)
    {
        return $this->db->get_where('barang_keluar', ['id' => $id])->row_array();
    }

    public function insertBarangKeluar($data)
    {
        return $this->db->insert('barang_keluar', $data);
    }

    public function updateBarangKeluar($data, $id)
    {
        return $this->db->update('barang_keluar', $data, ['id' => $id]);
    }

    public function getTahun()
    {
        $query = $this->db->query("SELECT YEAR(tanggal) AS tahun FROM barang_keluar GROUP BY YEAR(tanggal) ORDER BY YEAR(tanggal) ASC");
        return $query->result_array();
    }

    public function filterByTanggal($awal, $akhir)
    {
        $query = $this->db->query("SELECT barang_keluar.id, barang_keluar.tanggal, barang.nama_barang AS barangName, barang_keluar.jumlah, kondisi.name AS kondisiName, barang_keluar.keterangan FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id JOIN kondisi ON barang_keluar.id_kondisi = kondisi.id WHERE barang_keluar.tanggal BETWEEN '$awal' and '$akhir' ORDER BY barang_keluar.tanggal ASC");
        return $query->result_array();
    }

    public function filterByBulan($tahun, $awal, $akhir)
    {
        $query = $this->db->query("SELECT barang_keluar.id, barang_keluar.tanggal, barang.nama_barang AS barangName, barang_keluar.jumlah, kondisi.name AS kondisiName, barang_keluar.keterangan FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id JOIN kondisi ON barang_keluar.id_kondisi = kondisi.id WHERE YEAR(barang_keluar.tanggal) = '$tahun' and MONTH(barang_keluar.tanggal) BETWEEN '$awal' and '$akhir' ORDER BY barang_keluar.tanggal ASC");
        return $query->result_array();
    }

    public function filterByTahun($tahun)
    {
        $query = $this->db->query("SELECT barang_keluar.id, barang_keluar.tanggal, barang.nama_barang AS barangName, barang_keluar.jumlah, kondisi.name AS kondisiName, barang_keluar.keterangan FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id JOIN kondisi ON barang_keluar.id_kondisi = kondisi.id WHERE YEAR(barang_keluar.tanggal) = '$tahun' ORDER BY barang_keluar.tanggal ASC");
        return $query->result_array();
    }
}

/* End of file BarangKeluarModel.php */
