<?php

class Dosen_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  public function rules()
  {
    $this->form_validation->set_rules('nidn', 'NIDN', 'trim|required');
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('keahlian_id', 'Keahlian_id', 'trim|required');
    $this->form_validation->set_rules('kuota', 'Kuota', 'trim|required');
  }

  public function getAll()
  {
    $this->db->get_where('tb_dosen')->result_array();
  }

  // FUNGSI MODEL GET ID
  public function getById($id)
  {
    $this->db->get_where('tb_dosen', ['id' => $id])->row_array();
  }

  public function getKeahlian()
  {
    $query = "SELECT `tb_dosen`.*, `tb_keahlian`.`keahlian`
              FROM `tb_dosen` JOIN `tb_keahlian`
              ON `tb_dosen`.`keahlian_id` = `tb_keahlian`.`id` ORDER BY `tb_dosen`.`id`";
    return $this->db->query($query)->result_array();
  }

  // FUNGSI MODEL SIMPAN
  public function save()
  {
    $post = [
      'nip' => $this->input->post('nip'),
      'nidn' => $this->input->post('nidn'),
      'name' => $this->input->post('name'),
      'email' => $this->input->post('email'),
      'keahlian_id' => $this->input->post('keahlian_id'),
      'kuota_uji' => $this->input->post('kuota')
    ];
    return $this->db->insert('tb_dosen', $post);
  }

  // FUNGSI MODEL EDIT/UPDATE
  public function update()
  {
    $post = $this->input->post();
    $this->id = $post['id'];
    $this->nip = $post['nip'];
    $this->name = $post['name'];
    $this->email = $post['email'];
    $this->kelompok_keahlian = $post['kelompok_keahlian'];
    $this->kuota_uji = $post['kuota'];

    return $this->db->update('tb_dosen', $this, array('id' => $post['id']));
  }

  // FUNGSI MODEL DELETE
  public function delete($id)
  {
    return $this->db->delete('tb_dosen', array('id' => $id));
  }
}