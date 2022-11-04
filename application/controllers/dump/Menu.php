<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
    $this->load->library('form_validation');
  }


  // Fungsi Menu Utama
  public function index()
  {
    $data['title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/index', $data);
    $this->load->view('templates/footer');
  }

  // Fungsi Edit/Update Menu
  public function update()
  {

    $this->form_validation->set_rules('menu', 'Menu', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Edit Menu!</div>');
      redirect('menu');
    } else {
      $menu = $this->input->post('menu');
      $id = $this->input->post('id');

      $this->db->set('menu', $menu);
      $this->db->where('id', $id);
      $this->db->update('user_menu');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu Successfully Edited!</div>');
      redirect('menu');
    }
  }

  // Fungsi Delete Menu
  public function delete($id)
  {
    if ($id == "") {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Delete Menu!</div>');
      redirect('menu');
    } else {
      $this->db->where('id', $id);
      $this->db->delete('user_menu');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu Successfully Deleted!</div>');
      redirect('menu');
    }
  }


  public function jadwal()
  {
    $data['title'] = 'Menu Jadwal';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/jadwal', $data);
    $this->load->view('templates/footer');
  }

  // public function data_mahasiswa()
  // {
  //   $data['title'] = 'Data Mahasiswa';
  //   $data['user'] = $this->db->get_where('user', ['email' =>
  //   $this->session->userdata('email')])->row_array();

  //   $data['data_mahasiswa'] = $this->db->get('user')->result_array();

  //   $this->load->view('templates/header', $data);
  //   $this->load->view('templates/sidebar', $data);
  //   $this->load->view('templates/topbar', $data);
  //   $this->load->view('menu/data_mahasiswa', $data);
  //   $this->load->view('templates/footer');
  // }

  // public function data_dosen()
  // {
  //   $data['title'] = 'Data Dosen';
  //   $data['user'] = $this->db->get_where('user', ['email' =>
  //   $this->session->userdata('email')])->row_array();

  //   $data['data_dosen'] = $this->db->get('tb_dosen')->result_array();
  //   $data['data_keahlian'] = $this->db->get('tb_keahlian_dosen')->result_array();

  //   $this->load->model('dosen_model');

  //   $this->load->view('templates/header', $data);
  //   $this->load->view('templates/sidebar', $data);
  //   $this->load->view('templates/topbar', $data);
  //   $this->load->view('menu/data_dosen', $data);
  //   $this->load->view('templates/footer');
  // }
}