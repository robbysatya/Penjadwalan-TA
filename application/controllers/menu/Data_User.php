<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_User extends CI_Controller
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
    $this->load->model('data_user_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['title'] = 'Data User';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['data_user'] = $this->db->get('user')->result_array();
    $data['data_user'] = $this->data_user_model->getRole();
    $data['data_role'] = $this->db->get('user_role')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/data/data_user', $data);
    $this->load->view('templates/footer');
  }

  // Fungsi pada controller untuk menampilkan form add data user
  public function add()
  {
    $data['title'] = 'Tambah Data User';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['data_user'] = $this->db->get('user')->result_array();
    $data['data_user'] = $this->data_user_model->getRole();
    $data['data_role'] = $this->db->get('user_role')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/data/add_data_user', $data);
    $this->load->view('templates/footer');
  }

  // Fungsi pada controller untuk menyimpan data user
  public function addUser()
  {
    $data_user =  $this->data_user_model;
    $validation = $this->form_validation;
    $validation->set_rules($data_user->rules());

    if ($validation->run() == false) {
      $data['title'] = 'Tambah Data User';
      $data['user'] = $this->db->get_where('user', ['email' =>
      $this->session->userdata('email')])->row_array();

      $data['data_user'] = $this->db->get('user')->result_array();
      $data['data_user'] = $this->data_user_model->getRole();
      $data['data_role'] = $this->db->get('user_role')->result_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/data/add_data_user', $data);
      $this->load->view('templates/footer');
    } else {
      $data_user->save();

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Menambahkan Akun!</div>');
      redirect('menu/data_user');
    }
  }

  // Fungsi pada controller untuk menampilkan form add data user
  public function edit($id = null)
  {
    $data['title'] = 'Edit Data User';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['user_recent'] = $this->data_user_model->getById($id);
    $data['data_user'] = $this->data_user_model->getRole();
    $data['data_role'] = $this->db->get('user_role')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/data/edit_data_user', $data);
    $this->load->view('templates/footer');
  }

  // Fungsi pada controller untuk edit data user
  public function editUser($id = null)
  {
    $data['title'] = 'Edit Data User';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['user_recent'] = $this->data_user_model->getById($id);

    $data_user =  $this->data_user_model;
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    // $this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[user.nim]', ['is_unique' => 'This NIM has already registered!']);
    // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);

    if ($this->form_validation->run() == false) {
      $data['user_recent'] = $this->data_user_model->getById($id);

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/data/edit_data_user', $data);
      $this->load->view('templates/footer');
    } else {
      $data_user->update($id);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit Akun Berhasil!</div>');
      redirect('menu/data_user');
    }
  }

  public function deleteUser($id = null)
  {
    $id = $this->input->post('id');

    if (!isset($id)) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Menghapus Akun!</div>');
      redirect('menu/data_user');
    } elseif ($this->data_user_model->delete($id)) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Menghapus Data Akun!</div>');
      redirect('menu/data_user');
    }
  }

  public function changepassword($id = null)
  {
    $data['title'] = 'Ubah Password User';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['user_recent'] = $this->data_user_model->getById($id);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/data/changepassword_user', $data);
    $this->load->view('templates/footer');
  }


  public function changepasswordUser($id = null)
  {
    $data['title'] = 'Ubah Password User';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data_user =  $this->data_user_model;

    $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
    $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

    if ($this->form_validation->run() == false) {
      $data['user_recent'] = $this->data_user_model->getById($id);

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/data/changepassword_user', $data);
      $this->load->view('templates/footer');
    } else {
      $data_user->changepasswordUser($id);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
      redirect('menu/data_user/edit/' . $id);
    }
  }
}
