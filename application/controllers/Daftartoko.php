<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Daftartoko extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_daftartoko');

		if ($this->session->userdata('aktif') != TRUE) {
			redirect('home');
		}

		if ($this->session->userdata('jabatan') != 'Member') {
			redirect('admin/dashboard');
		}

		$id = $this->session->userdata('id');
		if ($this->db->get_where('member', "id_member= '$id'")->row('is_active') == 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Warning!</h4>Silahkan Verifikasi Email Anda.</div>');
			redirect('home');
		}
	}
	
	public function index()
	{
		$cektoko = $this->m_daftartoko->cektoko($this->session->userdata('id'));

		if ($cektoko != null) {
			redirect('toko/dashboard');
		}

		$data = [
			'title' => 'Daftar Toko',
			'small' => 'Welcome',
			//'profile' => $this->profile_model->getdata($id),
		];

		$this->template->load('frontend/template','frontend/daftartoko', $data);
	}

	public function simpan()
	{
		$config['upload_path'] = './assets/img/toko/';
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
				'nama_toko' => htmlspecialchars($this->input->post('nama', true)),
				'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
				'alamat' => htmlspecialchars($this->input->post('alamat', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'nm_rek' => htmlspecialchars($this->input->post('nm_rek',true)),
				'bank' => htmlspecialchars($this->input->post('bank', true)),
				'no_rek' => htmlspecialchars($this->input->post('no_rek', true)),
				'id_member' => $this->session->userdata('id'),
				'foto' => $foto
			];
			$this->db->insert('toko',$data);
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Selamat!</h4>Pendaftaran toko berhasil.</div>');
			redirect('daftartoko/session');
			//redirect('toko/Dashboard');
		}
	}

	public function session()
	{
		$gettoko = $this->m_daftartoko->cektoko($this->session->userdata('id'));
		$data_session = array(
			'id_toko' => $gettoko->id_toko
		);
		$this->session->set_userdata($data_session);
		redirect('toko/Dashboard');
	}
}