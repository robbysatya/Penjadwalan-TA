<?php

class Mahasiswa_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  public function rules()
  {
    $this->form_validation->set_rules('nim', 'NIM', 'trim|required');
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
    $this->form_validation->set_rules('topik', 'Topik', 'trim|required');
    $this->form_validation->set_rules('kelompok_keahlian', 'Kelompok_keahlian', 'trim|required');
    $this->form_validation->set_rules('jenis_ujian', 'Jenis_ujian', 'trim|required');
    $this->form_validation->set_rules('dosbim_1', 'Dosbim_1', 'trim|required');
    $this->form_validation->set_rules('dosbim_2', 'Dosbim_2', 'trim|required');
    $this->form_validation->set_rules('file_draft', 'File_draft', 'trim|required');
    $this->form_validation->set_rules('file_ppt', 'File_ppt', 'trim|required');
    $this->form_validation->set_rules('file_persetujuan', 'File_persetujuan', 'trim|required');
  }

  public function getAll()
  {
    $this->db->get_where('user')->result_array();
  }

  public function getById($id)
  {
    $this->db->get_where('user', ['id' => $id])->row_array();
  }

  public function getKeahlian()
  {
    $query = "SELECT `user`.*, `tb_keahlian`.`keahlian`
              FROM `user` JOIN `tb_keahlian`
              ON `user`.`keahlian_id` = `tb_keahlian`.`id` ORDER BY `user`.`id`";
    return $this->db->query($query)->result_array();
  }

  function get_otomatis($nim)
  {
    $this->db->like('nim', $nim, 'BOTH');
    $this->db->order_by('id', 'asc');
    $this->db->limit(10);
    return $this->db->get('user')->result();
  }
}