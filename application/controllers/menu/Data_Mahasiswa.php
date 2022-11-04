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


    $data['data_mahasiswa'] = $this->mahasiswa_model->getKeahlian();
    $data['data_keahlian'] = $this->db->get('tb_keahlian')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/data_mahasiswa', $data);
    $this->load->view('templates/footer');
  }

  // function getOtomatis()
  // {
  //   if (isset($_GET['term'])) {
  //     $result = $this->mahasiswa_model->get_otomatis($_GET['term']);
  //     if (count($result) > 0) {
  //       foreach ($result as $row)
  //         $result_array[] = array(
  //           'nim' => $row->nim,
  //           'name' => strtoupper($row->name)
  //         );
  //       echo json_encode($result_array);
  //     }
  //   }
  // }
}