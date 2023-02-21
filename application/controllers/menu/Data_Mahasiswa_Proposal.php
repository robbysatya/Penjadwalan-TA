<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_Mahasiswa_Proposal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		} else if ($this->session->userdata('role_id') == null) {
			redirect('auth');
		} else if ($this->session->userdata('role_id') != '1') {
			redirect('auth/blocked');
		}
		$this->load->model('mahasiswa_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Data Mahasiswa Seminar Proposal';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_mahasiswa'] = $this->mahasiswa_model->getDataAll_sempro();

		$data['data_user'] = $this->mahasiswa_model->getNim_proposal();
		$data['data_keahlian'] = $this->mahasiswa_model->getKeahlian_proposal();
		$data['data_ujian'] = $this->mahasiswa_model->getUjian_proposal();
		$data['data_dosen_1'] = $this->mahasiswa_model->getDosBim_1_proposal();
		$data['data_dosen_2'] = $this->mahasiswa_model->getDosBim_2_proposal();
		$data['list_data_keahlian'] = $this->db->get('tb_keahlian')->result_array();
		$data['list_data_ujian'] = $this->db->get('tb_jenis_ujian')->result_array();
		$data['list_data_dosen'] = $this->db->get('tb_dosen')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/mahasiswa/data_mahasiswa_proposal', $data);
		$this->load->view('templates/footer');
	}

	public function terimaSidang()
	{
		$nim = $this->input->post('nim');

		$this->db->set('status', 1);
		$this->db->where('nim', $nim);
		$this->db->update('tb_proposal');

		$this->db->set('status', 1);
		$this->db->where('nim', $nim);
		$this->db->update('user');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menerima!</div>');
		redirect('menu/data_mahasiswa_proposal');
	}

	public function tolakSidang()
	{
		$nim = $this->input->post('nim');
		$this->mahasiswa_model->tolak_sempro($nim);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Ditolak!</div>');
		redirect('menu/data_mahasiswa_proposal');
	}

	public function lanjutSidang()
	{
		$nim = $this->input->post('nim');

		$data['user'] = $this->db->get_where('user', ['nim' => $nim]);

		$this->db->set('status', 3);
		$this->db->where('nim', $nim);
		$this->db->update('tb_proposal');

		$this->db->set('status', 3);
		$this->db->where('nim', $nim);
		$this->db->update('user');

		redirect('menu/data_mahasiswa_proposal');
	}
}