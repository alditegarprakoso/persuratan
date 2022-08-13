<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
        $this->load->model('BarangModel', 'Barang');
        $this->load->model('BarangKeluarModel', 'BarangKeluar');
        $this->load->model('KondisiModel', 'Kondisi');
    }

    public function index()
    {
        $data['title'] = 'Data Barang Keluar';
        $this->load->view('layouts/header', $data);
        $this->load->view('barang_keluar/index');
        $this->load->view('layouts/footer');
        $this->load->view('barang_keluar/script');
    }

    public function getBarangKeluar()
    {
        $this->load->library('datatables');
        $this->datatables->select('barang_keluar.id, tanggal, barang.nama_barang as barangName, jumlah, kondisi.name as kondisiName, barang_keluar.keterangan');
        $this->datatables->from('barang_keluar');
        $this->datatables->join('barang', 'barang_keluar.id_barang = barang.id');
        $this->datatables->join('kondisi', 'barang_keluar.id_kondisi = kondisi.id');
        $this->datatables->add_column(
            'Action',
            '<a href="' . base_url('barangkeluar/edit?id=$1') . '" class="edit_barang_keluar btn btn-sm btn-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a> 
             
            <a href="javascript:void(0);" class="delete_barang_keluar btn btn-sm btn-danger" data-id="$1">Delete 
            <i class="fas fa-trash"></i></a>',
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function getDataById()
    {
        $id     = $this->input->post('id');

        $this->db->select('barang_keluar.id, tanggal, barang.nama_barang as barangName, jumlah, kondisi.name as kondisiName, barang_keluar.keterangan')
            ->from('barang_keluar')
            ->join('barang', 'barang_keluar.id_barang = barang.id')
            ->join('kondisi', 'barang_keluar.id_kondisi = kondisi.id')
            ->where('barang_keluar.id', $id);
        $result = $this->db->get()->row();
        echo json_encode($result);
    }

    public function add()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', [
            'required'      => 'Tanggal tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('barang', 'Barang', 'trim|required', [
            'required'      => 'Barang tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required', [
            'required'      => 'Kondisi tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric|greater_than[0]', [
            'required'      => 'Jumlah tidak boleh kosong',
            'numeric'      => 'Jumlah harus angka',
            'greater_than' => 'Jumlah harus lebih dari 0'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[3]', [
            'required'      => 'Keterangan tidak boleh kosong',
            'min_length' => 'Keterangan tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add Barang Keluar';
            $data['dataBarang'] = $this->Barang->getBarangAll();
            $data['dataKondisi'] = $this->Kondisi->getKondisiAll();
            $this->load->view('layouts/header', $data);
            $this->load->view('barang_keluar/add');
            $this->load->view('layouts/footer');
        } else {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['id_barang'] = $this->input->post('barang');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['id_kondisi'] = $this->input->post('kondisi');
            $data['keterangan'] = $this->input->post('keterangan');

            $dataBarang = $this->Barang->getBarangById($this->input->post('barang'));
            $updateStok['stok'] = $dataBarang['stok'] - $this->input->post('jumlah');

            if ($updateStok['stok'] < 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Gagal input data, maaf jumlah barang keluar melebihi stok barang</div>');
                redirect('barangkeluar/add');
            } else {
                $this->Barang->updateBarang($updateStok, $this->input->post('barang'));
                $this->BarangKeluar->insertBarangKeluar($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Add barang keluar success</div>');
                redirect('barangkeluar');
            }
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', [
            'required'      => 'Tanggal tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('barang', 'Barang', 'trim|required', [
            'required'      => 'Barang tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required', [
            'required'      => 'Kondisi tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric|greater_than[0]', [
            'required'      => 'Jumlah tidak boleh kosong',
            'numeric'      => 'Jumlah harus angka',
            'greater_than' => 'Jumlah harus lebih dari 0'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[3]', [
            'required'      => 'Keterangan tidak boleh kosong',
            'min_length' => 'Keterangan tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Barang Keluar';
            $data['data'] = $this->BarangKeluar->getBarangKeluarById($id);
            $data['dataBarang'] = $this->Barang->getBarangAll();
            $data['dataKondisi'] = $this->Kondisi->getKondisiAll();
            $this->load->view('layouts/header', $data);
            $this->load->view('barang_keluar/edit');
            $this->load->view('layouts/footer');
        } else {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['id_barang'] = $this->input->post('barang');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['keterangan'] = $this->input->post('keterangan');
            $data['id_kondisi'] = $this->input->post('kondisi');

            $idBarangKeluar = $this->input->post('id');

            $previousData = $this->BarangKeluar->getBarangKeluarById($idBarangKeluar);

            if ($this->input->post('barang') != $this->input->post('idPreviousBarang')) {
                $dataBarang = $this->Barang->getBarangById($this->input->post('barang'));
                $updateStok['stok'] = $dataBarang['stok'] - $previousData['jumlah'];

                if ($updateStok['stok'] < 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning">Gagal input data, maaf jumlah barang keluar melebihi stok barang</div>');
                    redirect('barangkeluar/edit?id=' . $idBarangKeluar);
                } else {
                    $dataPreviousBarang = $this->Barang->getBarangById($this->input->post('idPreviousBarang'));
                    $updatePreviousStok['stok'] = $dataPreviousBarang['stok'] + $previousData['jumlah'];
                    $this->Barang->updateBarang($updatePreviousStok, $this->input->post('idPreviousBarang'));
                    $this->Barang->updateBarang($updateStok, $this->input->post('barang'));
                }
            } else if ($this->input->post('barang') == $this->input->post('idPreviousBarang')) {
                $dataBarang = $this->Barang->getBarangById($this->input->post('barang'));
                $updateStok['stok'] = ($dataBarang['stok'] + $previousData['jumlah']) - $this->input->post('jumlah');

                if ($updateStok['stok'] < 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning">Gagal input data, maaf jumlah barang keluar melebihi stok barang</div>');
                    redirect('barangkeluar/edit?id=' . $idBarangKeluar);
                }

                $this->Barang->updateBarang($updateStok, $this->input->post('barang'));
            }

            $this->BarangKeluar->updateBarangKeluar($data, $idBarangKeluar);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Edit barang keluar success</div>');
            redirect('barangkeluar');
        }
    }

    public function delete()
    {
        $id   = $this->input->post('id_hapus3');

        $previousData = $this->BarangKeluar->getBarangKeluarById($id);
        $dataPreviousBarang = $this->Barang->getBarangById($previousData['id_barang']);
        $updatePreviousStok['stok'] = $dataPreviousBarang['stok'] + $previousData['jumlah'];
        $this->Barang->updateBarang($updatePreviousStok, $previousData['id_barang']);

        $this->db->delete('barang_keluar', ['id' => $id]);
        $delete = $this->db->affected_rows();
        echo json_encode($delete);
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Barang Keluar';
        $data['dataTahun'] = $this->BarangKeluar->getTahun();
        $this->load->view('layouts/header', $data);
        $this->load->view('barang_keluar/laporan');
        $this->load->view('layouts/footer');
    }

    public function tanggalFilter()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');

        $data['title'] = 'Laporan Barang Keluar';
        $data['subtitle'] = '(' . $awal . ' to ' . $akhir . ')';
        $data['dataLaporan'] = $this->BarangKeluar->filterByTanggal($awal, $akhir);
        $this->load->view('barang_keluar/print_laporan', $data);
    }

    public function bulanFilter()
    {
        $tahun = $this->input->post('tahun');
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');

        // Convert Number Month to Name Month
        $dateObjAwal   = DateTime::createFromFormat('!m', $awal);
        $convertAwal = $dateObjAwal->format('F');

        $dateObjAkhir   = DateTime::createFromFormat('!m', $akhir);
        $convertAkhir = $dateObjAkhir->format('F');

        $data['title'] = 'Laporan Barang Keluar';
        $data['subtitle'] = '(' . $convertAwal . ' to ' . $convertAkhir . ' - ' . $tahun . ')';
        $data['dataLaporan'] = $this->BarangKeluar->filterByBulan($tahun, $awal, $akhir);
        $this->load->view('barang_keluar/print_laporan', $data);
    }

    public function tahunFilter()
    {
        $tahun = $this->input->post('tahun');

        $data['title'] = 'Laporan Barang Keluar';
        $data['subtitle'] = '(' . $tahun . ')';
        $data['dataLaporan'] = $this->BarangKeluar->filterByTahun($tahun);
        $this->load->view('barang_keluar/print_laporan', $data);
    }
}

/* End of file BarangKeluar.php */
