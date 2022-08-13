<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kondisi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
        $this->load->model('KondisiModel', 'Kondisi');
    }

    public function index()
    {
        $data['title'] = 'Data Kondisi';
        $this->load->view('layouts/header', $data);
        $this->load->view('kondisi/index');
        $this->load->view('layouts/footer');
        $this->load->view('kondisi/script');
    }

    public function getDataById()
    {
        $id     = $this->input->post('id');
        $result = $this->db->select('*')->where('id', $id)->get('kondisi')->row();
        echo json_encode($result);
    }

    public function getKondisi()
    {
        $this->load->library('datatables');
        $this->datatables->select('id, name');
        $this->datatables->from('kondisi');
        $this->datatables->add_column(
            'Action',
            '<a href="' . base_url('kondisi/edit?id=$1') . '" class="edit_kondisi btn btn-sm btn-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a> 
             
            <a href="javascript:void(0);" class="delete_kondisi btn btn-sm btn-danger" data-id="$1">Delete 
            <i class="fas fa-trash"></i></a>',
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[3]', [
            'required'      => 'Nama kondisi tidak boleh kosong',
            'min_length' => 'Nama kondisi tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add Kondisi';
            $this->load->view('layouts/header', $data);
            $this->load->view('kondisi/add');
            $this->load->view('layouts/footer');
        } else {
            $data['name'] = $this->input->post('name');

            $this->Kondisi->insertKondisi($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Add kondisi success</div>');
            redirect('kondisi');
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');

        $this->form_validation->set_rules('name', 'Nama', 'required|trim|min_length[3]', [
            'required' => 'Nama kondisi tidak boleh kosong',
            'min_length' => 'Nama kondisi tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Kondisi';
            $data['data'] = $this->Kondisi->getKondisiById($id);
            $this->load->view('layouts/header', $data);
            $this->load->view('kondisi/edit');
            $this->load->view('layouts/footer');
        } else {
            $data['name'] = $this->input->post('name');
            $idKondisi = $this->input->post('id');
            $this->Kondisi->updateKondisi($data, $idKondisi);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Edit kondisi success</div>');
            redirect('kondisi');
        }
    }

    public function delete()
    {
        $id   = $this->input->post('id_hapus3');

        $this->db->delete('kondisi', ['id' => $id]);
        $delete = $this->db->affected_rows();
        echo json_encode($delete);
    }
}

/* End of file Kondisi.php */
