<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_Proposal extends CI_Controller
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
    };
    $this->load->library('form_validation');
    $this->load->model('jadwal_model');
  }

	public function index()
	{
		$data['title'] = 'Jadwal Seminar Proposal';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_proposal'] = $this->jadwal_model->getNamaMahasiswa_sp();
		$data['data_dosbim1'] = $this->jadwal_model->getDosBim_1_proposal();
		$data['data_dosbim2'] = $this->jadwal_model->getDosBim_2_proposal();	
		$data['data_dospeng1'] = $this->jadwal_model->getNamaDospeng1_sp();
		$data['data_dospeng2'] = $this->jadwal_model->getNamaDospeng2_sp();
		$data['data_hari'] = $this->jadwal_model->getNamaHari_sp();
		$data['data_jam'] = $this->jadwal_model->getNamaJam_sp();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/jadwal/jadwal_sempro', $data);
    $this->load->view('templates/footer');
	}
}
