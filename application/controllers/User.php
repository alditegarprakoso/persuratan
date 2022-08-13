<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
        is_logStaff();
        $this->load->model('UserModel', 'User');
    }

    public function index()
    {
        $data['title'] = 'Data User';
        $this->load->view('layouts/header', $data);
        $this->load->view('user/index');
        $this->load->view('layouts/footer');
        $this->load->view('user/script');
    }

    public function getDataById()
    {
        $id     = $this->input->post('id');
        $result = $this->db->select('*')->where('id', $id)->get('user')->row();
        echo json_encode($result);
    }

    public function getUsers()
    {
        $this->load->library('datatables');
        $this->datatables->select('id, username, nama, jabatan, bagian, role');
        $this->datatables->from('user');
        $this->datatables->add_column(
            'Action',
            '<a href="' . base_url('user/edit?id=$1') . '" class="edit_user btn btn-sm btn-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a> 
             
            <a href="javascript:void(0);" class="delete_user btn btn-sm btn-danger" data-id="$1">Delete 
            <i class="fas fa-trash"></i></a>',
            'id'
        );
        return print_r($this->datatables->generate());
    }

    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[user.username]', [
            'required'      => 'Username tidak boleh kosong',
            'min_length' => 'Username tidak boleh kurang dari 5 huruf',
            'is_unique' => 'Username sudah digunakan'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[confirmPassword]', [
            'matches' => 'Password dan Confirm Password harus sama',
            'min_length' => 'Password tidak boleh kurang dari 5 huruf'
        ]);

        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'trim|required|min_length[5]|matches[password]', [
            'matches' => 'Password dan Confirm Password harus sama',
            'min_length' => 'Confirm Password tidak boleh kurang dari 5 huruf'
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|alpha_numeric_spaces|min_length[3]|regex_match[/^([a-zA-Z]+\s)*[a-zA-Z]+$/]', [
            'required' => 'Nama tidak boleh kosong',
            'min_length' => 'Nama tidak boleh kurang dari 3 huruf',
            'regex_match' => 'Nama tidak boleh menggunakan angka',
            'alpha_numeric_spaces' => 'Nama harus huruf'
        ]);

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim|min_length[3]', [
            'required' => 'Jabatan tidak boleh kosong',
            'min_length' => 'Jabatan tidak boleh kurang dari 3 huruf',
        ]);

        $this->form_validation->set_rules('bagian', 'Bagian', 'required|trim|min_length[3]', [
            'required' => 'Bagian tidak boleh kosong',
            'min_length' => 'Bagian tidak boleh kurang dari 3 huruf',
        ]);

        $this->form_validation->set_rules('role', 'Role', 'required|trim|min_length[3]', [
            'required' => 'Role tidak boleh kosong',
            'min_length' => 'Role tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add User';
            $this->load->view('layouts/header', $data);
            $this->load->view('user/add');
            $this->load->view('layouts/footer');
        } else {
            $data['username'] = $this->input->post('username');
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $data['nama'] = $this->input->post('nama');
            $data['jabatan'] = $this->input->post('jabatan');
            $data['bagian'] = $this->input->post('bagian');
            $data['role'] = $this->input->post('role');

            $this->User->insertUser($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Add user success</div>');
            redirect('user');
        }
    }

    public function edit()
    {
        $id = $this->input->get('id');
        $idUser = $this->input->post('id');

        if ($idUser) {
            $user = $this->db->get_where('user', ['id' => $idUser])->row_array()['username'];

            if ($user != $this->input->post('username')) {
                $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[user.username]', [
                    'required'      => 'Username tidak boleh kosong',
                    'min_length' => 'Username tidak boleh kurang dari 5 huruf',
                    'is_unique' => 'Username sudah digunakan'
                ]);
            } else {
                $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]', [
                    'required'      => 'Username tidak boleh kosong',
                    'min_length' => 'Username tidak boleh kurang dari 5 huruf',
                ]);
            }
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|alpha_numeric_spaces|min_length[3]|regex_match[/^([a-zA-Z]+\s)*[a-zA-Z]+$/]', [
            'required' => 'Nama tidak boleh kosong',
            'min_length' => 'Nama tidak boleh kurang dari 3 huruf',
            'regex_match' => 'Nama tidak boleh menggunakan angka',
            'alpha_numeric_spaces' => 'Nama harus huruf'
        ]);

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim|min_length[3]', [
            'required' => 'Jabatan tidak boleh kosong',
            'min_length' => 'Jabatan tidak boleh kurang dari 3 huruf',
        ]);

        $this->form_validation->set_rules('bagian', 'Bagian', 'required|trim|min_length[3]', [
            'required' => 'Bagian tidak boleh kosong',
            'min_length' => 'Bagian tidak boleh kurang dari 3 huruf',
        ]);

        $this->form_validation->set_rules('role', 'Role', 'required|trim|min_length[3]', [
            'required' => 'Role tidak boleh kosong',
            'min_length' => 'Role tidak boleh kurang dari 3 huruf',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit User';
            $data['data'] = $this->User->getUserById($id);
            $this->load->view('layouts/header', $data);
            $this->load->view('user/edit');
            $this->load->view('layouts/footer');
        } else {
            $data['username'] = $this->input->post('username');
            $data['nama'] = $this->input->post('nama');
            $data['jabatan'] = $this->input->post('jabatan');
            $data['bagian'] = $this->input->post('bagian');
            $data['role'] = $this->input->post('role');

            $this->User->updateUser($data, $idUser);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Edit user success</div>');
            redirect('user');
        }
    }

    public function delete()
    {
        $id   = $this->input->post('id_hapus3');

        $this->db->delete('user', ['id' => $id]);
        $delete = $this->db->affected_rows();
        $this->session->set_flashdata('message', '<div class="alert alert-success">Delete user success</div>');
        echo json_encode($delete);
    }
}

/* End of file User.php */
