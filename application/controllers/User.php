<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		} else if ($this->session->userdata('role_id') == null) {
			redirect('auth');
		}
		$this->load->model('user_model');
		$this->load->model('mahasiswa_model');
		$this->load->library('form_validation');
	}


	public function index()
	{

		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nim', 'NIM', 'required');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->user_model->edit();

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile has been updated!</div>');
			redirect('user');
		}
	}

	public function changepassword()
	{

		$data['title'] = 'Ubah Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$this->user_model->changepassword();

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
			redirect('user/changepassword');
		}
	}

	public function daftar_sidang()
	{
		$data['title'] = 'Daftar Sidang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_mahasiswa'] = $this->db->get('user')->result_array();
		$data['data_proposal'] = $this->db->get('tb_proposal', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();
		$data['data_ujian'] = $this->db->get('tb_jenis_ujian')->result_array();
		$data['data_dosen_1_proposal'] = $this->mahasiswa_model->getDosBim_1_proposal();
		$data['data_dosen_1_sidang'] = $this->mahasiswa_model->getDosBim_1_sidang();
		$data['data_dosen_2_proposal'] = $this->mahasiswa_model->getDosBim_2_proposal();
		$data['data_dosen_2_sidang'] = $this->mahasiswa_model->getDosBim_2_sidang();
		$data['list_data_dosen'] = $this->db->get('tb_dosen')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/daftar_sidang', $data);
		$this->load->view('templates/footer');
	}

	public function save_daftar_sempro()
	{
		$data['title'] = 'Form Daftar Sidang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_mahasiswa'] = $this->db->get('user')->result_array();
		$data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();
		$data['list_data_ujian'] = $this->db->get('tb_jenis_ujian')->result_array();
		$data['list_data_dosen'] = $this->db->get('tb_dosen')->result_array();

		$this->user_model->save_daftar_sempro();

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran Berhasil!</div>');
		redirect('user/daftar_sidang');
	}

	public function save_daftar_sidang()
	{
		$data['title'] = 'Form Daftar Sidang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_mahasiswa'] = $this->db->get('user')->result_array();
		$data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();
		$data['list_data_ujian'] = $this->db->get('tb_jenis_ujian')->result_array();
		$data['list_data_dosen'] = $this->db->get('tb_dosen')->result_array();

		$this->user_model->save_daftar_sidang();

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran Berhasil!</div>');
		redirect('user/daftar_sidang');
	}

	public function batal_daftar_sempro()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->user_model->batal_daftar_sempro();

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembatalan Berhasil!</div>');
		redirect('user/daftar_sidang');
	}

	public function batal_daftar_sidang()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->user_model->batal_daftar_sidang();

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembatalan Berhasil!</div>');
		redirect('user/daftar_sidang');
	}
}
