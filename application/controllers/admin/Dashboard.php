<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard_admin');

		if ($this->session->userdata('aktif') != TRUE) {
			redirect('home');
		}

		if ($this->session->userdata('jabatan') != 'Admin') {
			redirect('home');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-dashboard',
			'admin' => $this->m_dashboard_admin->getadmin($this->session->userdata('id'))->row(),
			'pembayaran' => $this->m_dashboard_admin->getpembayaran()->result(),
			'refund' => $this->m_dashboard_admin->getrefund()->result(),
			'diterima' => $this->m_dashboard_admin->getterima()->result()
		];
		$this->template->load('template', 'admin/Dashboard', $data);
	}

	public function editdata()
	{
		if (!empty($_FILES["foto"]["name"])) {
					//$username = $this->input->post('username');
			$data = $this->session->userdata('foto');
			$path = './assets/img/profile/';
			@unlink($path.$data);

			$config['upload_path'] = './assets/img/profile';
			$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
			$config['max_size'] = '1000000';
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('foto')){
				//validasi gagal
				$error = ['error' => $this->upload->display_error()];
				$this->index($error);
			} else {
				$upload_data = $this->upload->data();
				$foto = $upload_data['file_name'];
			}
		}else{
			$foto = $this->input->post('foto_lama');
		}

		$data = [
			'nama_admin' => htmlspecialchars($this->input->post('nama', true)),
			'jns_kel' => htmlspecialchars($this->input->post('jns_kel', true)),
			'tmpt_lahir' => htmlspecialchars($this->input->post('tmpt_lahir', true)),
			'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
			'alamat' => htmlspecialchars($this->input->post('alamat', true)),
			'foto' => $foto
		];

		$this->db->where('id_admin', $this->session->userdata('id'));
		$this->db->update('admin',$data);
		$this->session->sess_destroy();
		redirect('login?s=ok');	
	}

	public function password()
	{
		$passlama = md5($this->input->post('passlama'));
		if ($passlama != $this->input->post('passasli')) {
			$this->session->sess_destroy();
			redirect('login');
		}else{

			$this->form_validation->set_rules('passbaru', 'Password', 'trim|min_length[6]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[passbaru]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message1', "<script>
					$('#password').modal('show');
					</script>");
				$this->index();
			}
			else{

				$data = ['password' => md5($this->input->post('passbaru', PASSWORD_DEFAULT))];
				$this->db->where('id_admin', $this->session->userdata('id'));
				$this->db->update('admin',$data);
				$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemeritahuan!</h4>Data berhasil diubah</div>');
				redirect('admin/Dashboard');
			}
		}
	}

	public function tambah()
	{
		$this->form_validation->set_rules('username' , 'Username' , 'is_unique[admin.username]|is_unique[member.username]');

		if($this->form_validation->run()== FALSE) {
			$this->session->set_flashdata('message1', "<script>
				$('#new').modal('show');
				</script>");
			$this->index();
		}else {
			$config['upload_path'] = './assets/img/profile/';
			$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
			$config['max_size'] = '1000000';
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('foto')){
				//validasi gagal
				$error = ['error' => $this->upload->display_error()];
				$this->index($error);
			} else {
				$upload_data = $this->upload->data();
				$foto = $upload_data['file_name'];
				$data = [
					'nama_admin' => htmlspecialchars($this->input->post('nama', true)),
					'tmpt_lahir' => htmlspecialchars($this->input->post('tmpt_lahir', true)),
					'jns_kel' => htmlspecialchars($this->input->post('jns_kel', true)),
					'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
					'alamat' => htmlspecialchars($this->input->post('alamat', true)),
					'username' => htmlspecialchars($this->input->post('username', true)),
					'password' => md5($this->input->post('tgl_lahir', PASSWORD_DEFAULT)),
					'level' => htmlspecialchars($this->input->post('level', true)),
					'foto' => $foto
				];
				$this->db->insert('admin',$data);
				$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil ditambahkan</div>');
				redirect('admin/dashboard');
			}
		}
	}
}