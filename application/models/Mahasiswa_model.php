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
    // $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
    // $this->form_validation->set_rules('topik', 'Topik', 'trim|required');
    // $this->form_validation->set_rules('kelompok_keahlian', 'Kelompok_keahlian', 'trim|required');
    // $this->form_validation->set_rules('jenis_ujian', 'Jenis_ujian', 'trim|required');
    // $this->form_validation->set_rules('dosbim_1', 'Dosbim_1', 'trim|required');
    // $this->form_validation->set_rules('dosbim_2', 'Dosbim_2', 'trim|required');
    // $this->form_validation->set_rules('file_draft', 'File_draft', 'trim|required');
    // $this->form_validation->set_rules('file_ppt', 'File_ppt', 'trim|required');
    // $this->form_validation->set_rules('file_persetujuan', 'File_persetujuan', 'trim|required');
  }

  public function getAll()
  {
    $this->db->get_where('user')->result_array();
  }

  public function getById($id)
  {
    $this->db->get_where('user', ['id' => $id])->row_array();
  }

  // GET DATA KEAHLIAN
  public function getKeahlian()
  {
    $query = "SELECT `user`.*, `tb_keahlian`.`keahlian`
              FROM `user` JOIN `tb_keahlian`
              ON `user`.`keahlian_id` = `tb_keahlian`.`id`";
    return $this->db->query($query)->result_array();
  }

  // GET DATA JENIS UJIAN
  public function getUjian()
  {
    $query = "SELECT `user`.*, `tb_jenis_ujian`.`jenis_ujian`
              FROM `user` JOIN `tb_jenis_ujian`
              ON `user`.`id_jenis_ujian` = `tb_jenis_ujian`.`id`";
    return $this->db->query($query)->result_array();
  }

  function get_otomatis($nim)
  {
    $this->db->like('nim', $nim, 'BOTH');
    $this->db->order_by('id', 'asc');
    $this->db->limit(10);
    return $this->db->get('user')->result_array();
  }

  // FUNGSI MODEL EDIT/UPDATE
  public function update()
  {
    $post = $this->input->post();
    $this->id = $post['id'];
    $this->nim = $post['nim'];
    $this->name = $post['name'];
    $this->judul = $post['judul'];
    $this->topik = $post['topik'];
    $this->keahlian_id = $post['keahlian_id'];
    $this->id_jenis_ujian = $post['id_jenis_ujian'];
    // $this->dosbim_1 = $post['dosbim_1'];
    // $this->dosbim_2 = $post['dosbim_2'];
    // $this->file_draft = $post['file_draft'];
    // $this->file_ppt = $post['file_ppt'];
    // $this->file_persetujuan = $post['file_persetujuan'];

    return $this->db->update('user', $this, array('id' => $post['id']));
  }
}