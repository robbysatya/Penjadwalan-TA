<?php

class Auth_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  const SESSION_KEY = 'id';

  public function rules()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
  }

  public function login($email, $password)
  {
    $this->db->where('email', $email);

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    // jika Usernya ada
    if ($user) {
      // jika User aktif
      if ($user['is_active'] == 1) {
        // cek password
        if (password_verify($password, $user['password'])) {
          $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);
          if ($user['role_id'] == 1) {
            redirect('admin');
          } else {
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
      redirect('auth');
    }

    // Membuat Session
    $this->session->set_userdata([self::SESSION_KEY =>  $user->id]);
    $this->_update_last_login($user->id);

    return $this->session->has_userdata(self::SESSION_KEY);
  }

  private function _update_last_login($id)
  {
    $data = [
      'last_login' => date("Y-m-d H:i:s"),
    ];

    $user = $this->db->update('user', ['id' => $id]);
  }

  public function current_user()
  {
    if (!$this->session->has_userdata(self::SESSION_KEY)) {
      return null;
    }

    $user_id = $this->session->userdata(self::SESSION_KEY);
    $this->db->get_where('user', ['id' => $user_id])->row_array();
  }

  public function logout()
  {
    $this->session->unset_userdata(self::SESSION_KEY);
    return !$this->session->has_userdata(self::SESSION_KEY);
  }
}