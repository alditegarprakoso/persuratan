<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
        $this->load->model('SatuanModel', 'Satuan');
    }

    public function index()
    {
        $data['title'] = 'Data Satuan';
        $this->load->view('layouts/header', $data);
        $this->load->view('satuan/index');
        $this->load->view('layouts/footer');
        $this->load->view('satuan/script');
    }

    public function getDataById()
    {
        $id     = $this->input->post('id');
        $result = $this->db->select('*')->where('id', $id)->get('satuan')->row();
        echo json_encode($result);
    }

    public function getSatuan()
    {
        $this->load->library('datatables');
        $this->datatables->select('id, name');
        $this->datatables->from('satuan');
        $this->datatables->add_column(
            'Action',
            '<a href="' . base_url('satuan/edit?id=$1') . '" class="edit_satuan btn btn-sm btn-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a> 
             
            <a href="javascript:void(0);" class="delete_satuan btn btn-sm btn-danger" data-id="$1">Delete 
            <i class="fas fa-trash"></i></a>',
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[3]', [
            'required'      => 'Nama satuan tidak boleh kosong',
            'min_length' => 'Nama satuan tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add Satuan';
            $this->load->view('layouts/header', $data);
            $this->load->view('satuan/add');
            $this->load->view('layouts/footer');
        } else {
            $data['name'] = $this->input->post('name');

            $this->Satuan->insertSatuan($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Add satuan success</div>');
            redirect('satuan');
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');

        $this->form_validation->set_rules('name', 'Nama', 'required|trim|min_length[3]', [
            'required' => 'Nama satuan tidak boleh kosong',
            'min_length' => 'Nama satuan tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Satuan';
            $data['data'] = $this->Satuan->getSatuanById($id);
            $this->load->view('layouts/header', $data);
            $this->load->view('satuan/edit');
            $this->load->view('layouts/footer');
        } else {
            $data['name'] = $this->input->post('name');
            $idSatuan = $this->input->post('id');
            $this->Satuan->updateSatuan($data, $idSatuan);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Edit satuan success</div>');
            redirect('satuan');
        }
    }

    public function delete()
    {
        $id   = $this->input->post('id_hapus3');

        $this->db->delete('satuan', ['id' => $id]);
        $delete = $this->db->affected_rows();
        echo json_encode($delete);
    }
}

/* End of file Satuan.php */
