<?php

class Data_User_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  public function rules()
  {
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password dont match', 'min_length' => 'Password too short!']);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('role_id', 'Role Akun', 'trim|required');
  }

  public function getRole()
  {
    $query = "SELECT `user`.*, `user_role`.`role`
              FROM `user` JOIN `user_role`
              ON `user`.`role_id` = `user_role`.`id`";
    return $this->db->query($query)->result_array();
  }

  public function getAll()
  {
    return $this->db->get_where('user')->result_array();
  }

  public function getById($id)
  {
    return $this->db->get_where('user', ['id' => $id])->row_array();
  }

  // FUNGSI SIMPAN DATA USER
  public function save()
  {
    $post = [
      'name' => htmlspecialchars($this->input->post('name', true)),
      'email' => htmlspecialchars($this->input->post('email', true)),
      'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      'image' => 'default.jpg',
      'role_id' => $this->input->post('role_id'),
      'is_active' => $this->input->post('is_active'),
      'date_created' => time()
    ];

    return $this->db->insert('user', $post);
  }

  // FUNGSI EDIT DATA USER
  public function update()
  {
    $post = $this->input->post();
    $this->id = $post['id'];
    $this->name = $post['name'];
    $this->email = $post['email'];
    $this->role_id = $post['role_id'];
    $this->is_active = $post['is_active'];
    $this->date_created = time();


    return $this->db->update('user', $this, array('id' => $post['id'], 'email' => $post['email']));
  }

  // Fungsi Delete Data User
  public function delete($id = null)
  {
    return $this->db->delete('user', array('id' => $id));
  }

  // FUNGSI EDIT DATA USER
  public function changepasswordUser($id = null)
  {

    $id = $this->input->post('id');
    $new_password = $this->input->post('new_password1');
    // Password sudah ok
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    $this->db->set('password', $password_hash);
    $this->db->where('id', $id);
    $this->db->update('user');
  }
}