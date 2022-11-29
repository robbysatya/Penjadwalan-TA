<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_Mahasiswa_Sidang extends CI_Controller
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
		$data['title'] = 'Data Mahasiswa Sidang Akhir';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_mahasiswa'] = $this->mahasiswa_model->getDataAll_sidang();

		$data['data_user'] = $this->mahasiswa_model->getNim_sidang();
		$data['data_keahlian'] = $this->mahasiswa_model->getKeahlian_sidang();
		$data['data_ujian'] = $this->mahasiswa_model->getUjian_sidang();
		$data['data_dosen_1'] = $this->mahasiswa_model->getDosBim_1_sidang();
		$data['data_dosen_2'] = $this->mahasiswa_model->getDosBim_2_sidang();	
		$data['list_data_keahlian'] = $this->db->get('tb_keahlian')->result_array();
		$data['list_data_ujian'] = $this->db->get('tb_jenis_ujian')->result_array();
		$data['list_data_dosen'] = $this->db->get('tb_dosen')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/mahasiswa/data_mahasiswa_sidang', $data);
		$this->load->view('templates/footer');
	}

	public function terimaSidang()
	{
		$nim = $this->input->post('nim');
		
		$this->db->set('status', 5);
		$this->db->where('nim', $nim);
		$this->db->update('tb_sidang');

		$this->db->set('status', 5);
		$this->db->where('nim', $nim);
		$this->db->update('user');

		redirect('menu/data_mahasiswa_sidang');
	}
}
