<?php

class Jadwal_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function getDataSempro()
	{
		return $this->db->query("SELECT * FROM tb_proposal WHERE status=1");
	}

	public function getDataJadwalDosen()
	{
		return $this->db->query("SELECT * FROM tb_jadwal_dosen");
	}

	public function getDataAcakProposal()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$query = $this->db->get();

		return $query->result_array();
		// return $this->db->query("SELECT * FROM data_acak_sp")->result_array();
	}

	public function getJadwaHari()
	{
		// Data Hari
		return $this->db->query("SELECT * FROM tb_hari");
	}

	public function getJadwalJam()
	{
		// Data Jam
		return $this->db->query("SELECT * FROM tb_jam");
	}

	public function getDospeng1()
	{
		// Data Dospeng 1
		return $this->db->query("SELECT * FROM tb_dosen");
	}
	public function getDospeng2()
	{
		// Data Dospeng 2
		return $this->db->query("SELECT * FROM tb_dosen");
	}

	public function getDosbim()
	{
		// Data Dospeng 1
		return $this->db->query("SELECT dosbim_1,dosbim_2 FROM tb_proposal");
	}
	public function getDosbim2()
	{
		// Data Dospeng 2
		return $this->db->query("SELECT dosbim_1,dosbim_2 FROM tb_proposal");
	}

	public function getNamaMahasiswa_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_proposal', 'data_acak_sp.kode_sp = tb_proposal.kode_sp');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaDospeng1_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_dosen', 'data_acak_sp.dospeng_1 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaDospeng2_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_dosen', 'data_acak_sp.dospeng_2 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaHari_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_hari', 'tb_hari.kode_hari = data_acak_sp.hari');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaJam_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_jam', 'tb_jam.kode_jam = data_acak_sp.jam');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function simpan_sempro()
	{
		$post = $this->input->post();
		$this->tanggal = $post['tanggal'];
		return $this->db->query("INSERT INTO tb_jadwal_proposal SELECT '$_POST[kode_jadwal_sp]' as kd,kode_sp,dospeng_1,dospeng_2,hari,jam,tanggal,'$_POST[tahun_ajaran]' as thn,'$_POST[periode]' as periode FROM data_acak_sp");
	}

	public function edit_sempro()
	{
		$post = $this->input->post();
		$this->kode_sp = $post['kode_sp'];
		$this->jam = $post['jam'];
		$this->hari = $post['hari'];
		$this->dospeng_1 = $post['dospeng_1'];
		$this->dospeng_2 = $post['dospeng_2'];

		return $this->db->update('data_acak_sp', $this, array('kode_sp' => $post['kode_sp']));
	}

	public function edit_jadwal()
	{
		$post = $this->input->post();
		$this->kode_sp = $post['kode_sp'];
		$this->jam = $post['jam'];
		$this->hari = $post['hari'];
		$this->tanggal = $post['tanggal'];
		$this->dospeng_1 = $post['dospeng_1'];
		$this->dospeng_2 = $post['dospeng_2'];

		return $this->db->update('data_acak_sp', $this, array('kode_sp' => $post['kode_sp']));
	}

	public function getNamaMahasiswa_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_proposal', 'tb_jadwal_proposal.kode_sp = tb_proposal.kode_sp');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaDospeng1_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_dosen', 'tb_jadwal_proposal.dospeng_1 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaDospeng2_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_dosen', 'tb_jadwal_proposal.dospeng_2 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaHari_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_hari', 'tb_hari.kode_hari = tb_jadwal_proposal.hari');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaJam_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_jam', 'tb_jam.kode_jam = tb_jadwal_proposal.jam');
		$query = $this->db->get();

		return $query->result_array();
	}

	// GET DATA DOSBIM SEMPRO
	public function getDosBim_1_proposal()
	{
		$this->db->select('*');
		$this->db->from('tb_proposal');
		$this->db->join('tb_dosen', 'tb_proposal.dosbim_1 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getDosBim_2_proposal()
	{
		$this->db->select('*');
		$this->db->from('tb_proposal');
		$this->db->join('tb_dosen', 'tb_proposal.dosbim_2 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getJadwaHariDosen()
	{
		// Data Hari Dosen
		return $this->db->query("SELECT kode_hari FROM tb_hari");
	}

	public function getJadwalJamDosen()
	{
		// Data Jam Dosen
		return $this->db->query("SELECT kode_jam FROM tb_jam");
	}

	public function getJadwalDospeng1()
	{
		// Data Dospeng 1
		return $this->db->query("SELECT id FROM tb_dosen ORDER BY id ASC");
	}
	public function getJadwalDospeng2()
	{
		// Data Dospeng 2
		return $this->db->query("SELECT id FROM tb_dosen ORDER BY id ASC");
	}

	public function getNamaDospeng_1()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_dosen', 'tb_dosen.id = data_acak_sp.dospeng_1');
		$query = $this->db->get();

		return $query->result_array();
	}
	public function getNamaDospeng_2()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_dosen', 'tb_dosen.id = data_acak_sp.dospeng_2');
		$query = $this->db->get();

		return $query->result_array();
	}

	// Dospeng Jadwal
	public function getDospeng_1_jadwal()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_dosen', 'tb_dosen.id = tb_jadwal_proposal.dospeng_1');
		$query = $this->db->get();

		return $query->result_array();
	}
	public function getDospeng_2_jadwal()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_dosen', 'tb_dosen.id = tb_jadwal_proposal.dospeng_2');
		$query = $this->db->get();

		return $query->result_array();
	}
}
