<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_Dosen extends CI_Controller
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
    $data['title'] = 'Data Dosen';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['data_dosen'] = $this->dosen_model->getKeahlian();
    $data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/dosen/data_dosen', $data);
    $this->load->view('templates/footer');
  }

  public function add()
  {
    $dosen =  $this->dosen_model;
    $validation = $this->form_validation->set_rules($dosen->rules());
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['data_dosen'] = $this->db->get('tb_dosen')->result_array();
    $data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();

    if ($validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Validation Failed!</div>');
      redirect('menu/data_dosen');
    } else {
      $this->dosen_model->save();

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Saved!</div>');
      redirect('menu/data_dosen');
    }
  }

  public function edit()
  {
    $dosen =  $this->dosen_model;
    $validation = $this->form_validation->set_rules($dosen->rules());

    if ($validation->run() == false) {
      if (!isset($id)) {
        redirect('menu/data_dosen');
      }
    } else {
      $dosen->update();

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Success Updated!</div>');
      redirect('menu/data_dosen');
    }
  }

  public function delete($id = null)
  {
    $id = $this->input->post('id');

    if (!isset($id)) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Delete Data Dosen!</div>');
      redirect('menu/data_dosen');
    } elseif ($this->dosen_model->delete($id)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete Data Dosen Success!</div>');
      redirect('menu/data_dosen');
    }
  }
}