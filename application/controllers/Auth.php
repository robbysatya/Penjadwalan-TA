<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return $this->login();
	}

	private function login()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$this->load->model('auth_model');
		$this->load->library('form_validation');

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);


		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if ($this->form_validation->run() == false && $this->session) {
			$data['title'] = 'Masuk | SIPETA IF';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else if ($this->auth_model->login($email, $password)) {
			$this->auth_model->login();
		}
	}

	public function register()
	{

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[user.nim]', ['is_unique' => 'This nim has already registered!']);
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password dont match', 'min_length' => 'Password too short!']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Daftar Akun | SIPETA IF';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/register');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'nim' => htmlspecialchars($this->input->post('nim', true)),
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($email),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'image' => 'default.jpg',
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			// Mempersiapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];
			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please check email to activate your account!</div>');
			redirect('auth');
		}
	}

	// SEND EMAIL
	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'sistemtaif@gmail.com',
			'smtp_pass' => 'hnpxkduybdxgizor',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email');
		$this->load->initialize($config);

		$this->email->from('sistemtaif@gmail.com', 'Sistem Penjadwalan TA IF');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account! : ' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' .  urlencode($token));
		}
		//  else if ($type == 'forgot') {
		//   $this->email->subject('Reset Password');
		//   $this->email->message('Click this link to reset your password! : ' . '<a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&&' . 'token=' .  urlencode($token) . '">Reset Password</a>');
		// }

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	// VERIFIKASI
	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated. Please login.</div>');
					redirect('auth');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed!</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

	// FITUR FORGOT PASSWORD
	public function forgotpassword()
	{

		$data['title'] = 'Forgot Password';
		$this->load->view('templates/auth_header', $data);
		$this->load->view('auth/forgotpassword');
		$this->load->view('templates/auth_footer');

		// $this->load->model('auth_model');
		// $this->load->library('form_validation');

		// $rules = $this->auth_model->rules();
		// $this->form_validation->set_rules($rules);

		// if ($this->form_validation->run() == false) {
		//   $data['title'] = 'Forgot Password';
		//   $this->load->view('templates/auth_header', $data);
		//   $this->load->view('auth/forgotpassword');
		//   $this->load->view('templates/auth_footer');
		// } else {

		//   $email = $this->input->post('email', true);
		//   $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

		//   if ($user) {
		//     $token = base64_encode(random_bytes(32));
		//     $user_token = [
		//       'email' => $email,
		//       'token' => $token,
		//       'date_created' => time()
		//     ];

		//     $this->db->insert('user_token', $user_token);
		//     $this->_sendEmail($token, 'forgot');

		//     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
		//     redirect('auth/forgotpassword');
		//   } else {
		//     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email not registered or not activated!</div>');
		//     redirect('auth/forgotpassword');
		//   }
		// }
	}

	// public function resetpassword()
	// {
	//   $token = $this->input->get('token');
	//   $email = $this->input->get('email');

	//   $user = $this->Auth_model->getUserByEmail();

	//   if ($user) {
	//     $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

	//     if ($user_token) {
	//       $this->session->set_userdata('reset_email', $email);
	//     }
	//   } else {
	//     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed, wrong email!</div>');
	//     redirect('auth');
	//   }
	// }
}