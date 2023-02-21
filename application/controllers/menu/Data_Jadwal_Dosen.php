<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_Jadwal_Dosen extends CI_Controller
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
    $this->load->model('dosen_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['title'] = 'Data Jadwal Dosen';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['data_jadwal_dosen'] = $this->dosen_model->getJadwalDosen();
    $data['hari'] = $this->dosen_model->getHariDosen();
    $data['jam'] = $this->dosen_model->getJamDosen();
    $data['data_dosen'] = $this->dosen_model->getNamaDosen();
    $data['data_list_dosen'] = $this->dosen_model->getDosen();
    $data['data_hari'] = $this->db->get('tb_hari')->result_array();
    $data['data_jam'] = $this->db->get('tb_jam')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/dosen/data_jadwal_dosen', $data);
    $this->load->view('templates/footer');
  }

	// public function getHari(){
	// 	$hari = $this->db->get('tb_hari')->result_array();
	// 	$output = '<option value="" selected="" disabled=""></option>';
	// 	while($h=$hari->fetch(PDO::FETCH_ASSOC)){
	// 			$output .= '<option value="'.$h["kode_hari"].'">'.$h["nama_hari"].'</option>';
	// 	}
	// 	echo $output;
	// }

  public function add()
  {
		$this->form_validation->set_rules('id_dosen', 'Dosen', 'trim|required');
		$this->form_validation->set_rules('hari', 'Hari', 'trim|required');

    $data['data_jadwal_dosen'] = $this->dosen_model->getJadwalDosen();

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Validation Failed!</div>');
      redirect('menu/data_jadwal_dosen');
    } else {
      $this->dosen_model->save_jadwal();

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jadwal Dosen Saved!</div>');
      redirect('menu/data_jadwal_dosen');
    }
  }

  // public function edit()
  // {
  //   $dosen =  $this->dosen_model;
  //   $validation = $this->form_validation->set_rules($dosen->rules());

  //   if ($validation->run() == false) {
  //     if (!isset($id)) {
  //       redirect('menu/data_dosen');
  //     }
  //   } else {
  //     $dosen->update();

  //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Success Updated!</div>');
  //     redirect('menu/data_dosen');
  //   }
  // }

  public function delete($id = null)
  {
    $id = $this->input->post('id');

    if (!isset($id)) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Delete Data Jadwal Dosen!</div>');
      redirect('menu/data_jadwal_dosen');
    } elseif ($this->dosen_model->delete($id)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete Data Jadwal Dosen Success!</div>');
      redirect('menu/data_jadwal_dosen');
    }
  }
}
