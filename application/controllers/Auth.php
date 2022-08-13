<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required'      => 'Username tidak boleh kosong!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required'      => 'Password tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('index');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $user       = $this->db->get_where('user', ['username' => $username])->row_array();

        // Jika user ada
        if ($user) {
            // Cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username'  => $user['username'],
                    'nama'  => $user['nama'],
                    'role'  => $user['role']
                ];
                $this->session->set_userdata($data);
                redirect('admin');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                Oops! Password salah.
                </div>'
                );
                redirect('auth');
            }
        } else {
            //Tidak ada user
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
            Oops! Akun tidak terdaftar.
            </div>'
            );
            redirect('auth');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('auth');
    }
}

/* End of file Auth.php */
