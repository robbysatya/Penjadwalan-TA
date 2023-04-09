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

	public function getDataSidang()
	{
		return $this->db->query("SELECT * FROM tb_sidang WHERE status=5");
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

	public function getDataJadwalProposal()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$query = $this->db->get();

		return $query->result_array();
		// return $this->db->query("SELECT * FROM data_acak_sp")->result_array();
	}

	public function getDataJadwalSidang()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_sidang');
		$query = $this->db->get();

		return $query->result_array();
		// return $this->db->query("SELECT * FROM data_acak_sp")->result_array();
	}

	public function getDataAcakSidang()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sa');
		$query = $this->db->get();

		return $query->result_array();
		// return $this->db->query("SELECT * FROM data_acak_sp")->result_array();
	}

	public function getJadwalHari()
	{
		// Data Hari
		return $this->db->query("SELECT * FROM tb_hari");
	}

	public function getJadwalJam()
	{
		// Data Jam
		return $this->db->query("SELECT * FROM tb_jam_sempro");
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

	public function getNamaMahasiswaSidang_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sa');
		$this->db->join('tb_sidang', 'data_acak_sa.kode_sa = tb_sidang.kode_sa');
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

	public function getNamaDospengSidang1_acak()
	{
		$query = "SELECT *
		FROM `data_acak_sa` AS `sa`
		JOIN `tb_sidang` AS `s`
		ON `s`.`kode_sa` = `sa`.`kode_sa` 
		JOIN `tb_dosen`
		ON `tb_dosen`.`id` = `s`.`dospeng_1`";

		return $this->db->query($query)->result_array();
	}

	public function getNamaDospengSidang2_acak()
	{
		$query = "SELECT *
		FROM `data_acak_sa` AS `sa`
		JOIN `tb_sidang` AS `s`
		ON `s`.`kode_sa` = `sa`.`kode_sa` 
		JOIN `tb_dosen`
		ON `tb_dosen`.`id` = `s`.`dospeng_2`";

		return $this->db->query($query)->result_array();
	}

	public function getNamaHari_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_hari', 'tb_hari.kode_hari = data_acak_sp.hari');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaHariSidang_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sa');
		$this->db->join('tb_hari', 'tb_hari.kode_hari = data_acak_sa.hari');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaJam_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sp');
		$this->db->join('tb_jam_sempro', 'tb_jam_sempro.kode_jam = data_acak_sp.jam');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaJamSidang_acak()
	{
		$this->db->select('*');
		$this->db->from('data_acak_sa');
		$this->db->join('tb_jam_sidang', 'tb_jam_sidang.kode_jam = data_acak_sa.jam');
		$query = $this->db->get();

		return $query->result_array();
	}

	// PROSES JADWAL SEMPRO
	public function simpan_sempro()
	{
		$post = $this->input->post();
		$this->tanggal = $post['tanggal'];
		$this->link = $post['link'];
		return $this->db->query("INSERT INTO tb_jadwal_proposal SELECT '$_POST[kode_jadwal_sp]' as kd,kode_sp,dospeng_1,dospeng_2,hari,jam,tanggal,link,'$_POST[tahun_ajaran]' as thn,'$_POST[periode]' as periode FROM data_acak_sp");
	}

	public function edit_jadwal_sempro()
	{
		$post = $this->input->post();
		$this->kode_sp = $post['kode_sp'];
		$this->jam = $post['jam'];
		$this->hari = $post['hari'];
		$this->tanggal = $post['tanggal'];
		$this->dospeng_1 = $post['dospeng_1'];
		$this->dospeng_2 = $post['dospeng_2'];
		$this->link = $post['link'];

		return $this->db->update('data_acak_sp', $this, array('kode_sp' => $post['kode_sp']));
	}

	public function edit_jadwalfix_sempro()
	{
		$post = $this->input->post();
		$this->kode_sp = $post['kode_sp'];
		$this->jam = $post['jam'];
		$this->hari = $post['hari'];
		$this->tanggal = $post['tanggal'];
		$this->dospeng_1 = $post['dospeng_1'];
		$this->dospeng_2 = $post['dospeng_2'];
		$this->link = $post['link'];

		return $this->db->update('tb_jadwal_proposal', $this, array('kode_sp' => $post['kode_sp']));
	}

	// PROSES JADWAL SIDANG
	public function simpan_sidang()
	{
		$post = $this->input->post();
		$this->tanggal = $post['tanggal'];
		$this->link = $post['link'];
		return $this->db->query("INSERT INTO tb_jadwal_sidang SELECT '$_POST[kode_jadwal_sa]' as kd,kode_sa,hari,jam,tanggal,link,'$_POST[tahun_ajaran]' as thn,'$_POST[periode]' as periode FROM data_acak_sp");
	}

	public function edit_jadwal_sidang()
	{
		$post = $this->input->post();
		$this->kode_sa = $post['kode_sa'];
		$this->jam = $post['jam'];
		$this->hari = $post['hari'];
		$this->tanggal = $post['tanggal'];
		$this->link = $post['link'];

		return $this->db->update('data_acak_sa', $this, array('kode_sa' => $post['kode_sa']));
	}

	public function edit_jadwalfix_sidang()
	{
		$post = $this->input->post();
		$this->kode_sa = $post['kode_sa'];
		$this->jam = $post['jam'];
		$this->hari = $post['hari'];
		$this->tanggal = $post['tanggal'];
		$this->link = $post['link'];

		return $this->db->update('tb_jadwal_sidang', $this, array('kode_sa' => $post['kode_sa']));
	}

	public function getNamaMahasiswa_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_proposal', 'tb_jadwal_proposal.kode_sp = tb_proposal.kode_sp');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaMahasiswa_sa()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_sidang');
		$this->db->join('tb_sidang', 'tb_jadwal_sidang.kode_sa = tb_sidang.kode_sa');
		$query = $this->db->get();

		return $query->result_array();
	}

	// GET NAMA DOSPENG PROPOSAL
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

	// GET NAMA DOSPENG PROPOSAL
	public function getNamaDospeng1_sa()
	{
		$query = "SELECT *
		FROM `tb_jadwal_sidang` AS `sa`
		JOIN `tb_sidang` AS `s`
		ON `s`.`kode_sa` = `sa`.`kode_sa` 
		JOIN `tb_dosen`
		ON `tb_dosen`.`id` = `s`.`dospeng_1`";

		return $this->db->query($query)->result_array();
	}

	public function getNamaDospeng2_sa()
	{
		$query = "SELECT *
		FROM `tb_jadwal_sidang` AS `sa`
		JOIN `tb_sidang` AS `s`
		ON `s`.`kode_sa` = `sa`.`kode_sa` 
		JOIN `tb_dosen`
		ON `tb_dosen`.`id` = `s`.`dospeng_2`";

		return $this->db->query($query)->result_array();
	}

	// GET DATA HARI DAN JAM SIDANG
	public function getNamaHari_sa()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_sidang');
		$this->db->join('tb_hari', 'tb_hari.kode_hari = tb_jadwal_sidang.hari');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getNamaJam_sa()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_sidang');
		$this->db->join('tb_jam_sidang', 'tb_jam_sidang.kode_jam = tb_jadwal_sidang.jam');
		$query = $this->db->get();

		return $query->result_array();
	}

	// GET DATA HARI DAN JAM SEMPRO
	public function getNamaHari_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_hari', 'tb_hari.kode_hari = tb_jadwal_proposal.hari');
		$query = $this->db->get();

		return $query->result_array();
	}

	// GET DATA LINK ZOOM
	public function getLink_proposal()
	{
		$query = "SELECT *
		FROM `tb_proposal` AS `p`
		JOIN `tb_jadwal_proposal` AS `jp`
		ON `jp`.`kode_sp` = `p`.`kode_sp` 
		WHERE `p`.`kode_sp` = `jp`.`kode_sp`";

		return $this->db->query($query)->result_array();
	}

	public function getLink_sidang()
	{
		$query = "SELECT *
		FROM `tb_sidang` AS `p`
		JOIN `tb_jadwal_sidang` AS `jp`
		ON `jp`.`kode_sa` = `p`.`kode_sa` 
		WHERE `p`.`kode_sa` = `jp`.`kode_sa`";

		return $this->db->query($query)->result_array();
	}

	public function getNamaJam_sp()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_jam_sempro', 'tb_jam_sempro.kode_jam = tb_jadwal_proposal.jam');
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

	// GET DATA DOSBIM SIDANG
	public function getDosBim_1_sidang()
	{
		$this->db->select('*');
		$this->db->from('tb_sidang');
		$this->db->join('tb_dosen', 'tb_sidang.dosbim_1 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getDosBim_2_sidang()
	{
		$this->db->select('*');
		$this->db->from('tb_sidang');
		$this->db->join('tb_dosen', 'tb_sidang.dosbim_2 = tb_dosen.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getJadwalHariSempro()
	{
		// Data Hari Dosen
		return $this->db->query("SELECT kode_hari FROM tb_hari");
	}

	public function getJadwalHariSidang()
	{
		// Data Hari Dosen
		return $this->db->query("SELECT kode_hari FROM tb_hari");
	}

	public function getJadwalJamSempro()
	{
		// Data Jam Dosen
		return $this->db->query("SELECT kode_jam FROM tb_jam_sempro");
	}

	public function getJadwalJamSidang()
	{
		// Data Jam Dosen
		return $this->db->query("SELECT kode_jam FROM tb_jam_sidang");
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
