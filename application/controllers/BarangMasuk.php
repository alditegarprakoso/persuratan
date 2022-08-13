<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
        $this->load->model('BarangModel', 'Barang');
        $this->load->model('BarangMasukModel', 'BarangMasuk');
        $this->load->model('KondisiModel', 'Kondisi');
    }

    public function index()
    {
        $data['title'] = 'Data Barang Masuk';
        $this->load->view('layouts/header', $data);
        $this->load->view('barang_masuk/index');
        $this->load->view('layouts/footer');
        $this->load->view('barang_masuk/script');
    }

    public function getBarangMasuk()
    {
        $this->load->library('datatables');
        $this->datatables->select('barang_masuk.id, tanggal, barang.nama_barang as barangName, jumlah, kondisi.name as kondisiName');
        $this->datatables->from('barang_masuk');
        $this->datatables->join('barang', 'barang_masuk.id_barang = barang.id');
        $this->datatables->join('kondisi', 'barang_masuk.id_kondisi = kondisi.id');
        $this->datatables->add_column(
            'Action',
            '<a href="' . base_url('barangmasuk/edit?id=$1') . '" class="edit_barang_masuk btn btn-sm btn-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a> 
             
            <a href="javascript:void(0);" class="delete_barang_masuk btn btn-sm btn-danger" data-id="$1">Delete 
            <i class="fas fa-trash"></i></a>',
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function getDataById()
    {
        $id     = $this->input->post('id');

        $this->db->select('barang_masuk.id, tanggal, barang.nama_barang as barangName, jumlah, kondisi.name as kondisiName')
            ->from('barang_masuk')
            ->join('barang', 'barang_masuk.id_barang = barang.id')
            ->join('kondisi', 'barang_masuk.id_kondisi = kondisi.id')
            ->where('barang_masuk.id', $id);
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

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add Barang Masuk';
            $data['dataBarang'] = $this->Barang->getBarangAll();
            $data['dataKondisi'] = $this->Kondisi->getKondisiAll();
            $this->load->view('layouts/header', $data);
            $this->load->view('barang_masuk/add');
            $this->load->view('layouts/footer');
        } else {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['id_barang'] = $this->input->post('barang');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['id_kondisi'] = $this->input->post('kondisi');

            $this->BarangMasuk->insertBarangMasuk($data);

            $dataBarang = $this->Barang->getBarangById($this->input->post('barang'));
            $updateStok['stok'] = $this->input->post('jumlah') + $dataBarang['stok'];
            $this->Barang->updateBarang($updateStok, $this->input->post('barang'));

            $this->session->set_flashdata('message', '<div class="alert alert-success">Add barang masuk success</div>');
            redirect('barangmasuk');
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

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Barang Masuk';
            $data['data'] = $this->BarangMasuk->getBarangMasukById($id);
            $data['dataBarang'] = $this->Barang->getBarangAll();
            $data['dataKondisi'] = $this->Kondisi->getKondisiAll();
            $this->load->view('layouts/header', $data);
            $this->load->view('barang_masuk/edit');
            $this->load->view('layouts/footer');
        } else {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['id_barang'] = $this->input->post('barang');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['id_kondisi'] = $this->input->post('kondisi');

            $idBarangMasuk = $this->input->post('id');

            $previousData = $this->BarangMasuk->getBarangMasukById($idBarangMasuk);

            if ($this->input->post('barang') != $this->input->post('idPreviousBarang')) {
                $dataPreviousBarang = $this->Barang->getBarangById($this->input->post('idPreviousBarang'));
                $updatePreviousStok['stok'] = $dataPreviousBarang['stok'] - $previousData['jumlah'];
                $this->Barang->updateBarang($updatePreviousStok, $this->input->post('idPreviousBarang'));

                $dataBarang = $this->Barang->getBarangById($this->input->post('barang'));
                $updateStok['stok'] = $dataBarang['stok'] + $this->input->post('jumlah');
                $this->Barang->updateBarang($updateStok, $this->input->post('barang'));
            } else if ($this->input->post('barang') == $this->input->post('idPreviousBarang')) {
                $dataBarang = $this->Barang->getBarangById($this->input->post('barang'));
                $updateStok['stok'] = ($dataBarang['stok'] - $previousData['jumlah']) + $this->input->post('jumlah');
                $this->Barang->updateBarang($updateStok, $this->input->post('barang'));
            }

            $this->BarangMasuk->updateBarangMasuk($data, $idBarangMasuk);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Edit barang masuk success</div>');
            redirect('barangmasuk');
        }
    }

    public function delete()
    {
        $id   = $this->input->post('id_hapus3');

        $previousData = $this->BarangMasuk->getBarangMasukById($id);
        $dataPreviousBarang = $this->Barang->getBarangById($previousData['id_barang']);
        $updatePreviousStok['stok'] = $dataPreviousBarang['stok'] - $previousData['jumlah'];
        $this->Barang->updateBarang($updatePreviousStok, $previousData['id_barang']);

        $this->db->delete('barang_masuk', ['id' => $id]);
        $delete = $this->db->affected_rows();
        echo json_encode($delete);
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Barang Masuk';
        $data['dataTahun'] = $this->BarangMasuk->getTahun();
        $this->load->view('layouts/header', $data);
        $this->load->view('barang_masuk/laporan');
        $this->load->view('layouts/footer');
    }

    public function tanggalFilter()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');

        $data['title'] = 'Laporan Barang Masuk';
        $data['subtitle'] = '(' . $awal . ' to ' . $akhir . ')';
        $data['dataLaporan'] = $this->BarangMasuk->filterByTanggal($awal, $akhir);
        $this->load->view('barang_masuk/print_laporan', $data);
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

        $data['title'] = 'Laporan Barang Masuk';
        $data['subtitle'] = '(' . $convertAwal . ' to ' . $convertAkhir . ' - ' . $tahun . ')';
        $data['dataLaporan'] = $this->BarangMasuk->filterByBulan($tahun, $awal, $akhir);
        $this->load->view('barang_masuk/print_laporan', $data);
    }

    public function tahunFilter()
    {
        $tahun = $this->input->post('tahun');

        $data['title'] = 'Laporan Barang Masuk';
        $data['subtitle'] = '(' . $tahun . ')';
        $data['dataLaporan'] = $this->BarangMasuk->filterByTahun($tahun);
        $this->load->view('barang_masuk/print_laporan', $data);
    }
}

/* End of file BarangMasuk.php */
