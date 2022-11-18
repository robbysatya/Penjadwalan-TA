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
              FROM `user` INNER JOIN `tb_keahlian`
              ON `user`.`keahlian_id` = `tb_keahlian`.`id`";
    return $this->db->query($query)->result_array();
  }

  // GET DATA JENIS UJIAN
  public function getUjian()
  {
    $query = "SELECT `user`.*, `tb_jenis_ujian`.`jenis_ujian`
              FROM `user` INNER JOIN `tb_jenis_ujian`
              ON `user`.`id_jenis_ujian` = `tb_jenis_ujian`.`id`";
    return $this->db->query($query)->result_array();
  }

  // GET DATA JENIS UJIAN
  public function getDosen()
  {
    $query = "SELECT `user`.*, `tb_dosen`.`name`
              FROM `user` INNER JOIN `tb_dosen`
              ON `user`.`dosbim_1` = `tb_dosen`.`id`
              OR `user`.`dosbim_2` = `tb_dosen`.`id`";
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
  public function update($id = null)
  {

    $data['user'] = $this->db->get_where('user', ['id' => $id]);

    $post = $this->input->post();
    $this->id = $post['id'];
    $this->nim = $post['nim'];
    $this->name = $post['name'];
    $this->judul = $post['judul'];
    $this->topik = $post['topik'];
    $this->keahlian_id = $post['keahlian_id'];
    $this->id_jenis_ujian = $post['id_jenis_ujian'];
    $this->dosbim_1 = $post['dosbim_1'];
    $this->dosbim_2 = $post['dosbim_2'];
    $this->file_draft = $_FILES['file_draft'];
    $this->file_ppt = $_FILES['file_ppt'];
    $this->file_persetujuan = $_FILES['file_persetujuan'];

    $config['upload_path'] = './assets/files/';
    $config['allowed_types'] = 'pdf';
    $config['max_size']     = '5120';

    $this->load->library('upload', $config);

    $this->upload->do_upload('file_draft');
    $this->upload->do_upload('file_ppt');
    $this->upload->do_upload('file_persetujuan');
    $old_file = $this->db->query("SELECT file_draft, file_ppt, file_persetujuan FROM user WHERE id='$id'")->row();
    unlink(FCPATH . 'assets/files/' . $old_file);

    $new_file = $this->upload->data('file_name');
    $this->db->set('file_draft', $new_file);
    $this->db->set('file_ppt', $new_file);
    $this->db->set('file_persetujuan', $new_file);

    return $this->db->update('user', $this, array('id' => $post['id']));
  }
}