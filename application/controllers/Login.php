<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Login extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');

		if (isset($_GET['s'])) {
			if ($_GET['s'] == 'ok') {
				$this->session->set_flashdata('message', 'Data berhasil diubah silahkan login untuk melanjutkan');
			}
		}
	}

	public function index()
	{
		if ($this->session->userdata('aktif') == TRUE) {
			redirect('home');
		}

		$this->load->view('auth/login');
	}

	public function auth()
	{
		$username = $this->input->post('username'); 
		$password = md5($this->input->post('password'));

		$cek_admin = $this->m_login->auth_admin($username,$password);

		if ($cek_admin->num_rows() > 0) {
			//$where = array('username' => $username);
			$data = $cek_admin->row_array();
			$data_session = array(
				'id' => $data['id_admin'],
				'username' => $username,
				'jabatan' => 'Admin',
				'nama' => $data['nama_admin'],
				'foto' => $data['foto'],
				'aktif' => TRUE,
				'level' => $data['level']
			);

			$this->session->set_userdata($data_session);
			redirect('admin/dashboard');
		}else{
			$cek_member = $this->m_login->auth_member($username,$password);
			if ($cek_member->num_rows() > 0) {
				$data = $cek_member->row_array();
				$toko = $this->m_login->cektoko($data['id_member'])->row();
				$data_session = array(
					'id' => $data['id_member'],
					'nama' => $data['nama_member'],
					'status' => $data['status'],
					'foto' => 'default.png',
					'jabatan' => 'Member',
					'id_toko' => $toko->id_toko,
					'aktif' => TRUE
				);
				$this->session->set_userdata($data_session);
				redirect('home');
			}else{
				$this->session->set_flashdata('message', 'Username atau Password salah');
				redirect('login');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
}