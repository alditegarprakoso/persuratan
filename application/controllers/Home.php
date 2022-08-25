<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function json()
	{
		$this->load->library('datatables');
		$this->datatables->select('id, no_agenda_direktorat, no_surat, asal_surat, perihal, tanggal_surat, tanggal');
		$this->datatables->from('surat_masuk');
		$this->datatables->add_column(
			'aksi',
			'<a href="' . base_url('home/editSuratMasuk?id=$1') . '" class="edit badge badge-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a>',
			'id'
		);
		return print_r($this->datatables->generate());
	}

	public function json2()
	{
		$this->load->library('datatables');
		$this->datatables->select('id, no_agenda_direktorat, no_surat, asal_surat, perihal, kepada, tanggal_surat, tanggal');
		$this->datatables->from('surat_masuk');
		$this->datatables->add_column(
			'aksi',
			'<a href="' . base_url('home/editDisposisi?id=$1') . '" class="edit badge badge-primary" data-id="$1">Edit
            <i class="fas fa-edit"></i></a>',
			'id'
		);
		return print_r($this->datatables->generate());
	}

	public function getDataById()
	{
		$id     = $this->input->post('id');
		$result = $this->db->select('*')->where('id', $id)->get('surat_masuk')->row();
		echo json_encode($result);
	}

	public function index()
	{
		$data['title'] = 'Persuratan';
		$this->load->view('layouts/header', $data);
		$this->load->view('index');
		$this->load->view('layouts/footer');
	}

	public function suratMasuk()
	{
		$data['title'] = 'Surat Masuk';
		$this->load->view('suratmasuk/index', $data);
	}

	public function tambahSuratMasuk()
	{
		$this->form_validation->set_rules('no_agenda', 'Nomor Agenda Direktorat', 'trim|required|min_length[3]', [
			'required'      => 'Nomor Agenda Direktorat tidak boleh kosong',
			'min_length' => 'Nomor Agenda Direktorat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required|min_length[3]', [
			'required'      => 'Nomor Surat tidak boleh kosong',
			'min_length' => 'Nomor Surat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('asal_surat', 'Asal Surat', 'trim|required|min_length[3]', [
			'required'      => 'Asal Surat tidak boleh kosong',
			'min_length' => 'Asal Surat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required|min_length[3]', [
			'required'      => 'Perihal tidak boleh kosong',
			'min_length' => 'Perihal tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required', [
			'required'      => 'Tanggal Surat tidak boleh kosong',
		]);

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', [
			'required'      => 'Tanggal tidak boleh kosong',
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Data Surat Masuk';
			$this->load->view('layouts/header', $data);
			$this->load->view('suratmasuk/tambah');
			$this->load->view('layouts/footer');
		} else {
			$data['no_agenda_direktorat'] = $this->input->post('no_agenda');
			$data['no_surat'] = $this->input->post('no_surat');
			$data['asal_surat'] = $this->input->post('asal_surat');
			$data['perihal'] = $this->input->post('perihal');
			$data['kepada'] = '';
			$data['tanggal_surat'] = $this->input->post('tanggal_surat');
			$data['tanggal'] = $this->input->post('tanggal');

			$this->db->insert('surat_masuk', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil ditambahkan</div>');
			redirect('home/suratMasuk');
		}
	}

	public function editSuratMasuk()
	{
		$id = $this->input->get('id');

		$this->form_validation->set_rules('no_agenda', 'Nomor Agenda Direktorat', 'trim|required|min_length[3]', [
			'required'      => 'Nomor Agenda Direktorat tidak boleh kosong',
			'min_length' => 'Nomor Agenda Direktorat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required|min_length[3]', [
			'required'      => 'Nomor Surat tidak boleh kosong',
			'min_length' => 'Nomor Surat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('asal_surat', 'Asal Surat', 'trim|required|min_length[3]', [
			'required'      => 'Asal Surat tidak boleh kosong',
			'min_length' => 'Asal Surat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required|min_length[3]', [
			'required'      => 'Perihal tidak boleh kosong',
			'min_length' => 'Perihal tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required', [
			'required'      => 'Tanggal Surat tidak boleh kosong',
		]);

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', [
			'required'      => 'Tanggal tidak boleh kosong',
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Surat Masuk';
			$data['data'] = $this->db->get_where('surat_masuk', ['id' => $id])->row_array();
			$this->load->view('layouts/header', $data);
			$this->load->view('suratmasuk/edit', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->db->set('no_agenda_direktorat', $this->input->post('no_agenda'));
			$this->db->set('no_surat', $this->input->post('no_surat'));
			$this->db->set('asal_surat', $this->input->post('asal_surat'));
			$this->db->set('perihal', $this->input->post('perihal'));
			$this->db->set('tanggal_surat', $this->input->post('tanggal_surat'));
			$this->db->set('tanggal', $this->input->post('tanggal'));
			$this->db->where('id', $id);
			$this->db->update('surat_masuk');
			$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil diedit</div>');
			redirect('home/suratMasuk');
		}
	}

	public function disPosisi()
	{
		$data['title'] = 'Disposisi';
		$this->load->view('disposisi/index', $data);
	}

	public function editDisposisi()
	{
		$id = $this->input->get('id');

		$this->form_validation->set_rules('no_agenda', 'Nomor Agenda Direktorat', 'trim|required|min_length[3]', [
			'required'      => 'Nomor Agenda Direktorat tidak boleh kosong',
			'min_length' => 'Nomor Agenda Direktorat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required|min_length[3]', [
			'required'      => 'Nomor Surat tidak boleh kosong',
			'min_length' => 'Nomor Surat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('asal_surat', 'Asal Surat', 'trim|required|min_length[3]', [
			'required'      => 'Asal Surat tidak boleh kosong',
			'min_length' => 'Asal Surat tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required|min_length[3]', [
			'required'      => 'Perihal tidak boleh kosong',
			'min_length' => 'Perihal tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('kepada', 'Kepada', 'trim|required|min_length[3]', [
			'required'      => 'Kepada tidak boleh kosong',
			'min_length' => 'Kepada tidak boleh kurang dari 3 huruf'
		]);

		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required', [
			'required'      => 'Tanggal Surat tidak boleh kosong',
		]);

		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required', [
			'required'      => 'Tanggal tidak boleh kosong',
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Surat Masuk';
			$data['data'] = $this->db->get_where('surat_masuk', ['id' => $id])->row_array();
			$this->load->view('layouts/header', $data);
			$this->load->view('disposisi/edit', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->db->set('no_agenda_direktorat', $this->input->post('no_agenda'));
			$this->db->set('no_surat', $this->input->post('no_surat'));
			$this->db->set('asal_surat', $this->input->post('asal_surat'));
			$this->db->set('perihal', $this->input->post('perihal'));
			$this->db->set('kepada', $this->input->post('kepada'));
			$this->db->set('tanggal_surat', $this->input->post('tanggal_surat'));
			$this->db->set('tanggal', $this->input->post('tanggal'));
			$this->db->where('id', $id);
			$this->db->update('surat_masuk');
			$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil diedit</div>');
			redirect('home/disPosisi');
		}
	}

	// public function delete()
	// {
	// 	$id   = $this->input->post('id_hapus3');

	// 	$this->db->delete('surat_masuk', ['id' => $id]);
	// 	$delete = $this->db->affected_rows();
	// 	echo json_encode($delete);
	// }
}
