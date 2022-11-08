<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_Mahasiswa extends CI_Controller
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
    $data['title'] = 'Data Mahasiswa';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['data_mahasiswa'] = $this->db->get('user')->result_array();
    $data['data_mahasiswa'] = $this->mahasiswa_model->getKeahlian();
    $data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();
    $data['data_ujian'] = $this->mahasiswa_model->getUjian();
    $data['list_data_ujian'] = $this->db->get('tb_jenis_ujian')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/mahasiswa/data_mahasiswa', $data);
    $this->load->view('templates/footer');
  }

  public function edit()
  {
    $mahasiswa =  $this->mahasiswa_model;
    $validation = $this->form_validation->set_rules($mahasiswa->rules());

    if ($validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Validation Failed!</div>');
      redirect('menu/data_mahasiswa');
    } else {
      $mahasiswa->update();

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Mahasiswa Success Updated!</div>');
      redirect('menu/data_mahasiswa');
    }
  }
}