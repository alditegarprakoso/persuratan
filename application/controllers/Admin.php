<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        is_logAdmin();
    }


    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/index');
        $this->load->view('layouts/footer');
    }
}

/* End of file Admin.php */
