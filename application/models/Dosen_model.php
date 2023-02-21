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
    $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
    $this->form_validation->set_rules('nidn', 'NIDN', 'trim|required');
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('keahlian_id', 'Keahlian_id', 'trim|required');
    $this->form_validation->set_rules('kuota', 'Kuota', 'trim|required');
  }

  public function getDosen()
  {
    return $this->db->get('tb_dosen')->result_array();
  }

  // FUNGSI MODEL GET ID
  public function getById($id)
  {
    return $this->db->get_where('tb_dosen', ['id' => $id])->row_array();
  }

	public function getJadwalDosen()
  {
    return $this->db->get('tb_jadwal_dosen')->result_array();
  }

	public function getJamDosen()
  {
		$this->db->select('*');
		$this->db->from('tb_jam');
		$this->db->join('tb_jadwal_dosen', 'tb_jadwal_dosen.jam = tb_jam.kode_jam');
		$query = $this->db->get();

		return $query->result_array();
  }
	
	public function getHariDosen()
  {
		$this->db->select('*');
		$this->db->from('tb_hari');
		$this->db->join('tb_jadwal_dosen', 'tb_jadwal_dosen.hari = tb_hari.kode_hari');
		$query = $this->db->get();

		return $query->result_array();
  }

	public function getNamaDosen()
  {
		$this->db->select('*');
		$this->db->from('tb_dosen');
		$this->db->join('tb_jadwal_dosen', 'tb_jadwal_dosen.id_dosen = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
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
    $this->nidn = $post['nidn'];
    $this->name = $post['name'];
    $this->email = $post['email'];
    $this->keahlian_id = $post['keahlian_id'];
    $this->kuota_uji = $post['kuota'];

    return $this->db->update('tb_dosen', $this, array('id' => $post['id']));
  }

  // FUNGSI MODEL DELETE
  public function delete($id)
  {
    return $this->db->delete('tb_jadwal_dosen', array('id' => $id));
  }

	// SIMPAN JADWAL
	public function save_jadwal(){
		$id_dosen = $this->input->post('id_dosen');
		$hari = $this->input->post('hari');
		$jam = $this->input->post('jam');

		$jumlah = count($jam);

		for($i = 0; $i < $jumlah; $i++){
			$save_db = $this->db->query("INSERT INTO tb_jadwal_dosen VALUES (0, '$id_dosen','$hari','$jam[$i]');");
		}

		return $save_db;
	}
}
