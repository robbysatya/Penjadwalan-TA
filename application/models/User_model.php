<?php

class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function edit()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$nim = $this->input->post('nim');
		$name = $this->input->post('name');
		$email = $this->input->post('email');

		// Cek jika ada gambar yang akan diupload
		$upload_image = $_FILES['image'];
		if ($upload_image) {
			$config['upload_path'] = './assets/img/profile/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '2048';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image')) {
				$old_image = $data['user']['image'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			}
		}

		$this->db->set('nim', $nim);
		$this->db->set('name', $name);
		$this->db->where('email', $email);
		$this->db->update('user');
	}

	public function changepassword()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password1');

		if (!password_verify($current_password, $data['user']['password'])) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
			redirect('user/changepassword');
		} else if ($current_password == $new_password) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be same the current password!</div>');
			redirect('user/changepassword');
		} else {
			// Password sudah ok
			$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

			$this->db->set('password', $password_hash);
			$this->db->where('email', $this->session->userdata('email'));
			$this->db->update('user');
		}
	}

	public function save_daftar_sempro()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$nim = $this->input->post('nim');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$judul = $this->input->post('judul');
		$keahlian_id = $this->input->post('keahlian_id');
		$id_jenis_ujian = $this->input->post('id_jenis_ujian');
		$dosbim_1 = $this->input->post('dosbim_1');
		$dosbim_2 = $this->input->post('dosbim_2');
		$date_created = time();

		$config['upload_path'] = './assets/files/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']     = '25600';
		$this->load->library('upload', $config);

		if (!empty($_FILES['file_draft'])) {
			$this->upload->do_upload('file_draft');
			$data1 = $this->upload->data();
			$file_draft = $data1['file_name'];

			$this->db->set('file_draft', $file_draft);
		}
		if (!empty($_FILES['file_ppt'])) {
			$this->upload->do_upload('file_ppt');
			$data2 = $this->upload->data();
			$file_ppt = $data2['file_name'];

			$this->db->set('file_ppt', $file_ppt);
		}
		if (!empty($_FILES['file_persetujuan'])) {
			$this->upload->do_upload('file_persetujuan');
			$data3 = $this->upload->data();
			$file_persetujuan = $data3['file_name'];

			$this->db->set('file_persetujuan', $file_persetujuan);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Daftar gagal file masih ada yang kurang atau ukuran file lebih dari 25 Mb!</div>');
			redirect('user/daftar_sidang');
		}

		$this->db->set('nim', $nim);
		$this->db->set('name', $name);
		$this->db->set('email', $email);
		$this->db->set('judul', $judul);
		$this->db->set('keahlian_id', $keahlian_id);
		$this->db->set('id_jenis_ujian', $id_jenis_ujian);
		$this->db->set('dosbim_1', $dosbim_1);
		$this->db->set('dosbim_2', $dosbim_2);
		$this->db->set('dosbim_2', $dosbim_2);
		$this->db->set('status', 2);
		$this->db->set('date_created', $date_created);
		$this->db->insert('tb_proposal');

		$this->db->set('status', 2);
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('user');
	}

	public function save_daftar_sidang()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$nim = $this->input->post('nim');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$judul = $this->input->post('judul');
		$keahlian_id = $this->input->post('keahlian_id');
		$id_jenis_ujian = $this->input->post('id_jenis_ujian');
		$dosbim_1 = $this->input->post('dosbim_1');
		$dosbim_2 = $this->input->post('dosbim_2');
		$date_created = time();

		$config['upload_path'] = './assets/files/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']     = '25600';
		$this->load->library('upload', $config);

		if (!empty($_FILES['file_draft'])) {
			$this->upload->do_upload('file_draft');
			$data1 = $this->upload->data();
			$file_draft = $data1['file_name'];

			$this->db->set('file_draft', $file_draft);
		}
		if (!empty($_FILES['file_ppt'])) {
			$this->upload->do_upload('file_ppt');
			$data2 = $this->upload->data();
			$file_ppt = $data2['file_name'];

			$this->db->set('file_ppt', $file_ppt);
		}
		if (!empty($_FILES['file_persetujuan'])) {
			$this->upload->do_upload('file_persetujuan');
			$data3 = $this->upload->data();
			$file_persetujuan = $data3['file_name'];

			$this->db->set('file_persetujuan', $file_persetujuan);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Daftar gagal file masih ada yang kurang atau ukuran file lebih dari 25 Mb!</div>');
			redirect('user/daftar_sidang');
		}

		$this->db->set('nim', $nim);
		$this->db->set('name', $name);
		$this->db->set('email', $email);
		$this->db->set('judul', $judul);
		$this->db->set('keahlian_id', $keahlian_id);
		$this->db->set('id_jenis_ujian', $id_jenis_ujian);
		$this->db->set('dosbim_1', $dosbim_1);
		$this->db->set('dosbim_2', $dosbim_2);
		$this->db->set('date_created', $date_created);
		$this->db->set('status', 4);
		$this->db->insert('tb_sidang');

		$this->db->set('status', 4);
		$this->db->set('alasan', null);
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('user');
	}

	public function batal_daftar_sempro()
	{
		$data['user'] = $this->db->get_where('tb_proposal', ['email' => $this->session->userdata('email')])->row_array();

		$old_file_draft = $data['user']['file_draft'];
		$old_file_ppt = $data['user']['file_ppt'];
		$old_file_persetujuan = $data['user']['file_persetujuan'];
		unlink(FCPATH . 'assets/files/' . $old_file_draft);
		unlink(FCPATH . 'assets/files/' . $old_file_ppt);
		unlink(FCPATH . 'assets/files/' . $old_file_persetujuan);

		$this->db->where('email', $this->session->userdata('email'));
		$this->db->delete('tb_proposal');

		$this->db->set('status', 0);
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('user');
	}

	public function batal_daftar_sidang()
	{
		$data['user'] = $this->db->get_where('tb_sidang', ['email' => $this->session->userdata('email')])->row_array();

		$old_file_draft = $data['user']['file_draft'];
		$old_file_ppt = $data['user']['file_ppt'];
		$old_file_persetujuan = $data['user']['file_persetujuan'];
		unlink(FCPATH . 'assets/files/' . $old_file_draft);
		unlink(FCPATH . 'assets/files/' . $old_file_ppt);
		unlink(FCPATH . 'assets/files/' . $old_file_persetujuan);

		$this->db->where('email', $this->session->userdata('email'));
		$this->db->delete('tb_sidang');

		$this->db->set('status', 3);
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('user');
	}

	public function data_jadwal_user()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_proposal', 'tb_jadwal_proposal.kode_sp = tb_proposal.kode_sp');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getJam()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_jam', 'tb_jadwal_proposal.jam = tb_jam.kode_jam');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getHari()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_hari', 'tb_jadwal_proposal.hari = tb_hari.kode_hari');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getTanggal()
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_proposal');
		$this->db->join('tb_proposal', 'tb_jadwal_proposal.kode_sp = tb_proposal.kode_sp');
		$query = $this->db->get();

		return $query->result_array();
	}
}
