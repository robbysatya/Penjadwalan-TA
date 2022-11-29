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

	// GET DATA KEAHLIAN SEMPRO
	public function getKeahlian_proposal()
	{
		$this->db->select('*');
		$this->db->from('tb_proposal');
		$this->db->join('tb_keahlian', 'tb_proposal.keahlian_id = tb_keahlian.id');
		$query = $this->db->get();

		return $query->result_array();
	}

		// GET DATA JENIS UJIAN PROPOSAL
		public function getUjian_proposal()
		{
			$this->db->select('*');
			$this->db->from('tb_proposal');
			$this->db->join('tb_jenis_ujian', 'tb_proposal.id_jenis_ujian = tb_jenis_ujian.id');
			$query = $this->db->get();
	
			return $query->result_array();
		}

	
		// // GET DATA KEAHLIAN SIDANG
		public function getKeahlian_sidang()
		{
			$this->db->select('*');
			$this->db->from('tb_sidang');
			$this->db->join('tb_keahlian', 'tb_sidang.keahlian_id = tb_keahlian.id');
			$query = $this->db->get();

			return $query->result_array();
		}
		
		// // GET DATA JENIS UJIAN SIDANG
		public function getUjian_sidang()
		{
			$this->db->select('*');
			$this->db->from('tb_sidang');
			$this->db->join('tb_jenis_ujian', 'tb_sidang.id_jenis_ujian = tb_jenis_ujian.id');
			$query = $this->db->get();

			return $query->result_array();
		}

	// GET DATA SEMPRO
	public function getNim_proposal()
	{
		$this->db->select('*');
		$this->db->from('tb_proposal');
		$this->db->join('user', 'tb_proposal.status = user.status', 'LEFT');
		$query = $this->db->get();

		return $query->result_array();
	}

	// GET DATA SIDANG
	public function getNim_sidang()
	{
		$this->db->select('*');
		$this->db->from('tb_sidang');
		$this->db->join('user', 'tb_sidang.status = user.status', 'LEFT');
		$query = $this->db->get();

		return $query->result_array();
	}

	// GET DATA SEMPRO
	public function getDataAll_sempro()
	{		
		$query = "SELECT `tb_proposal`.* FROM `tb_proposal` WHERE `status` = 2 OR `status` = 1";

		return $this->db->query($query)->result_array();
	}

	// GET DATA SIDANG
	public function getDataAll_sidang()
	{
		$query = "SELECT `tb_sidang`.* FROM `tb_sidang` WHERE `status` = 3 OR `status` = 4";

		return $this->db->query($query)->result_array();
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

	// public function getKategori_Sidang($sidang)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tb_sidang');
	// 	$query = $this->db->get('tb_sidang', $sidang);

	// 	return $query->result_array();
	// }

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
