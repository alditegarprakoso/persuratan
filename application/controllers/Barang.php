<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
        $this->load->model('BarangModel', 'Barang');
        $this->load->model('SatuanModel', 'Satuan');
        $this->load->model('MerkModel', 'Merk');
    }

    public function index()
    {
        $data['title'] = 'Data Barang';
        $this->load->view('layouts/header', $data);
        $this->load->view('barang/index');
        $this->load->view('layouts/footer');
        $this->load->view('barang/script');
    }

    public function getDataById()
    {
        $id     = $this->input->post('id');

        $this->db->select('barang.id, kode_barang, nama_barang, stok, merk.name as merkName, satuan.name as satuanName, tgl_pengadaan, keterangan')
            ->from('barang')
            ->join('merk', 'barang.id_merk = merk.id')
            ->join('satuan', 'barang.id_satuan = satuan.id')
            ->where('barang.id', $id);
        $result = $this->db->get()->row();
        echo json_encode($result);
    }

    public function getBarang()
    {
        $this->load->library('datatables');
        $this->datatables->select('barang.id, kode_barang, nama_barang, stok, merk.name as merkName, satuan.name as satuanName, tgl_pengadaan, keterangan');
        $this->datatables->from('barang');
        $this->datatables->join('merk', 'barang.id_merk = merk.id');
        $this->datatables->join('satuan', 'barang.id_satuan = satuan.id');
        $this->datatables->add_column(
            'Action',
            '<a href="' . base_url('barang/edit?id=$1') . '" class="edit_barang btn btn-sm btn-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a> 
             
            <a href="javascript:void(0);" class="delete_barang btn btn-sm btn-danger" data-id="$1">Delete 
            <i class="fas fa-trash"></i></a>',
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function add()
    {
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required|min_length[3]', [
            'required'      => 'Kode Barang tidak boleh kosong',
            'min_length' => 'Kode Barang tidak boleh kurang dari 3 huruf',
        ]);

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|min_length[3]', [
            'required'      => 'Nama Barang tidak boleh kosong',
            'min_length' => 'Nama Barang tidak boleh kurang dari 3 huruf',
        ]);

        $this->form_validation->set_rules('merk', 'Merk', 'required|trim', [
            'required' => 'Merk tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim', [
            'required' => 'Satuan tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('tgl_pengadaan', 'Tanggal Pengadaan', 'required|trim', [
            'required' => 'Tanggal Pengadaan tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[3]', [
            'required'      => 'Keterangan tidak boleh kosong',
            'min_length' => 'Keterangan tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add Barang';
            $data['dataSatuan'] = $this->Satuan->getSatuanAll();
            $data['dataMerk'] = $this->Merk->getMerkAll();
            $data['kode_barang'] = $this->Barang->CreateCode();
            $this->load->view('layouts/header', $data);
            $this->load->view('barang/add');
            $this->load->view('layouts/footer');
        } else {
            $data['kode_barang'] = $this->Barang->CreateCode();
            $data['nama_barang'] = $this->input->post('nama_barang');
            $data['stok'] = 0;
            $data['id_merk'] = $this->input->post('merk');
            $data['id_satuan'] = $this->input->post('satuan');
            $data['tgl_pengadaan'] = $this->input->post('tgl_pengadaan');
            $data['keterangan'] = $this->input->post('keterangan');

            $this->Barang->insertBarang($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Add barang success</div>');
            redirect('barang');
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|min_length[3]', [
            'required'      => 'Nama Barang tidak boleh kosong',
            'min_length' => 'Nama Barang tidak boleh kurang dari 3 huruf',
        ]);

        $this->form_validation->set_rules('merk', 'Merk', 'required|trim', [
            'required' => 'Merk tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim', [
            'required' => 'Satuan tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('tgl_pengadaan', 'Tanggal Pengadaan', 'required|trim', [
            'required' => 'Tanggal Pengadaan tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[3]', [
            'required'      => 'Keterangan tidak boleh kosong',
            'min_length' => 'Keterangan tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Barang';
            $data['data'] = $this->Barang->getBarangById($id);
            $data['dataSatuan'] = $this->Satuan->getSatuanAll();
            $data['dataMerk'] = $this->Merk->getMerkAll();
            $this->load->view('layouts/header', $data);
            $this->load->view('barang/edit');
            $this->load->view('layouts/footer');
        } else {
            $data['nama_barang'] = $this->input->post('nama_barang');
            $data['id_merk'] = $this->input->post('merk');
            $data['id_satuan'] = $this->input->post('satuan');
            $data['tgl_pengadaan'] = $this->input->post('tgl_pengadaan');
            $data['keterangan'] = $this->input->post('keterangan');
            $idBarang = $this->input->post('id');
            $this->Barang->updateBarang($data, $idBarang);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Edit barang success</div>');
            redirect('barang');
        }
    }

    public function delete()
    {
        $id   = $this->input->post('id_hapus3');

        $this->db->delete('barang', ['id' => $id]);
        $delete = $this->db->affected_rows();
        echo json_encode($delete);
    }

    public function getLaporan()
    {
        $this->load->library('datatables');
        $this->datatables->select('barang.id, kode_barang, nama_barang, stok, merk.name as merkName, satuan.name as satuanName, tgl_pengadaan, keterangan');
        $this->datatables->from('barang');
        $this->datatables->join('merk', 'barang.id_merk = merk.id');
        $this->datatables->join('satuan', 'barang.id_satuan = satuan.id');
        return print_r($this->datatables->generate());
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Data Barang';
        $this->load->view('layouts/header', $data);
        $this->load->view('barang/laporan');
        $this->load->view('layouts/footer');
        $this->load->view('barang/script');
    }

    public function print_laporan()
    {
        $data['title'] = 'Laporan Data Barang Saat Ini';
        $data['dataLaporan'] =
            $this->db->select('barang.id, kode_barang, nama_barang, stok, merk.name as merkName, satuan.name as satuanName, tgl_pengadaan, keterangan')
            ->from('barang')
            ->join('merk', 'barang.id_merk = merk.id')
            ->join('satuan', 'barang.id_satuan = satuan.id')
            ->get()->result_array();
        $this->load->view('barang/print_laporan', $data);
    }
}

/* End of file Barang.php */
