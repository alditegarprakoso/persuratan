<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Merk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
        $this->load->model('MerkModel', 'Merk');
    }

    public function index()
    {
        $data['title'] = 'Data Merk';
        $this->load->view('layouts/header', $data);
        $this->load->view('merk/index');
        $this->load->view('layouts/footer');
        $this->load->view('merk/script');
    }

    public function getDataById()
    {
        $id     = $this->input->post('id');
        $result = $this->db->select('*')->where('id', $id)->get('merk')->row();
        echo json_encode($result);
    }

    public function getMerk()
    {
        $this->load->library('datatables');
        $this->datatables->select('id, name');
        $this->datatables->from('merk');
        $this->datatables->add_column(
            'Action',
            '<a href="' . base_url('merk/edit?id=$1') . '" class="edit_merk btn btn-sm btn-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a> 
             
            <a href="javascript:void(0);" class="delete_merk btn btn-sm btn-danger" data-id="$1">Delete 
            <i class="fas fa-trash"></i></a>',
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[3]', [
            'required'      => 'Nama merk tidak boleh kosong',
            'min_length' => 'Nama merk tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add Merk';
            $this->load->view('layouts/header', $data);
            $this->load->view('merk/add');
            $this->load->view('layouts/footer');
        } else {
            $data['name'] = $this->input->post('name');

            $this->Merk->insertMerk($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Add merk success</div>');
            redirect('merk');
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');

        $this->form_validation->set_rules('name', 'Nama', 'required|trim|min_length[3]', [
            'required' => 'Nama merk tidak boleh kosong',
            'min_length' => 'Nama merk tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Merk';
            $data['data'] = $this->Merk->getMerkById($id);
            $this->load->view('layouts/header', $data);
            $this->load->view('merk/edit');
            $this->load->view('layouts/footer');
        } else {
            $data['name'] = $this->input->post('name');
            $idMerk = $this->input->post('id');
            $this->Merk->updateMerk($data, $idMerk);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Edit merk success</div>');
            redirect('merk');
        }
    }

    public function delete()
    {
        $id   = $this->input->post('id_hapus3');

        $this->db->delete('merk', ['id' => $id]);
        $delete = $this->db->affected_rows();
        echo json_encode($delete);
    }
}

/* End of file Merk.php */
