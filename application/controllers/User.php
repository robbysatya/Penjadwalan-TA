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
		$this->load->model('jadwal_model');
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

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile berhasil diperbaharui!</div>');
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

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil Diubah!</div>');
			redirect('user/changepassword');
		}
	}

	public function daftar_sidang()
	{
		$data['title'] = 'Daftar Sidang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_mahasiswa'] = $this->db->get('user')->result_array();
		$data['data_proposal'] = $this->db->get('tb_proposal', ['email' => $this->session->userdata('email')])->row_array();
		$data['data_sidang'] = $this->db->get('tb_sidang', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();
		$data['data_ujian'] = $this->db->get('tb_jenis_ujian')->result_array();

		// Data Dosbim Sempro
		$data['data_dosen_1_proposal'] = $this->mahasiswa_model->getDosBim_1_proposal();
		$data['data_dosen_2_proposal'] = $this->mahasiswa_model->getDosBim_2_proposal();

		// Data Dosbim Sidang
		$data['data_dosen_1_sidang'] = $this->mahasiswa_model->getDosBim_1_sidang();
		$data['data_dosen_2_sidang'] = $this->mahasiswa_model->getDosBim_2_sidang();

		// Data Dospeng
		$data['data_dospeng_1_sidang'] = $this->mahasiswa_model->getDospeng_1_sidang();
		$data['data_dospeng_2_sidang'] = $this->mahasiswa_model->getDospeng_2_sidang();

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

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran Seminar Proposal Berhasil!</div>');
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

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran Sidang Akhir Berhasil!</div>');
		redirect('user/daftar_sidang');
	}

	public function batal_daftar_sempro()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->user_model->batal_daftar_sempro();

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembatalan Seminar Proposal Berhasil!</div>');
		redirect('user/daftar_sidang');
	}

	public function batal_daftar_sidang()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->user_model->batal_daftar_sidang();

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembatalan Sidang Akhir Berhasil!</div>');
		redirect('user/daftar_sidang');
	}

	public function jadwal_sidang()
	{
		$data['title'] = 'Jadwal Seminar Proposal dan Sidang Akhir';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_jadwal_user'] = $this->db->get_where('tb_proposal', ['email' => $this->session->userdata('email')])->result_array();
		$data['data_jadwal_user_sidang'] = $this->db->get_where('tb_sidang', ['email' => $this->session->userdata('email')])->result_array();

		$data['data_dosbim_1'] = $this->user_model->getDosBim_1_proposal();
		$data['data_dosbim_2'] = $this->user_model->getDosBim_2_proposal();

		$data['data_dospeng_1'] = $this->user_model->getDospeng_1_proposal();
		$data['data_dospeng_2'] = $this->user_model->getDospeng_2_proposal();

		$data['data_jam'] = $this->user_model->getJam_proposal();
		$data['data_hari'] = $this->user_model->getHari_proposal();
		$data['data_tanggal'] = $this->user_model->getTanggal_proposal();
		$data['data_link'] = $this->user_model->getLink_proposal();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/jadwal_user', $data);
		$this->load->view('templates/footer');
	}
}
