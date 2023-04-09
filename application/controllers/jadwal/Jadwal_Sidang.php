<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_Sidang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else if ($this->session->userdata('role_id') == null) {
            redirect('auth');
        } else if ($this->session->userdata('role_id') != '1') {
            redirect('auth/blocked');
        };
        $this->load->library('form_validation');
        $this->load->model('jadwal_model');
    }

    public function index()
    {
        $data['title'] = 'Jadwal Sidang Akhir';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['data_sidang'] = $this->jadwal_model->getNamaMahasiswa_sa();
        $data['data_jadwal'] = $this->jadwal_model->getDataJadwalSidang();
        $data['data_dosbim1'] = $this->jadwal_model->getDosBim_1_sidang();
        $data['data_dosbim2'] = $this->jadwal_model->getDosBim_2_sidang();
        $data['data_dospeng1'] = $this->jadwal_model->getNamaDospeng1_sa();
        $data['data_dospeng2'] = $this->jadwal_model->getNamaDospeng2_sa();
        $data['data_hari'] = $this->jadwal_model->getNamaHari_sa();
        $data['data_jam'] = $this->jadwal_model->getNamaJam_sa();
        $data['data_link'] = $this->jadwal_model->getLink_sidang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/jadwal/jadwal_sidang', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->jadwal_model->edit_jadwalfix_sempro();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jadwal Berhasil Diubah!</div>');
        redirect('jadwal/jadwal_sidang');
    }
}
