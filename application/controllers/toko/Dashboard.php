<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard_toko');

		if ($this->session->userdata('aktif') != TRUE) {
			redirect('home');
		}

		if ($this->session->userdata('jabatan') != 'Member') {
			redirect('home');
		}

		$gettoko = $this->m_dashboard_toko->gettoko($this->session->userdata('id_toko'))->row();
		if ($gettoko == null) {
			redirect('daftartoko');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-dashboard',
			'toko' => $this->m_dashboard_toko->gettoko($this->session->userdata('id_toko'))->row()
		];
		$this->template->load('template', 'toko/Dashboard', $data);
	}

	public function edittoko()
	{
		$data = [
			'title' => 'Edit Toko',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-dashboard',
			'toko' => $this->m_dashboard_toko->gettoko($this->session->userdata('id_toko'))->row()
		];
		$this->template->load('template', 'toko/toko_edit', $data);
	}

	public function simpan()
	{
		if (!empty($_FILES["foto"]["name"])) {
			$data = $this->input->post('foto_lama');
			$path = './assets/img/toko/';
			@unlink($path.$data);

			$config['upload_path'] = './assets/img/toko';
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
			'nama_toko' => htmlspecialchars($this->input->post('nama', true)),
			'alamat' => htmlspecialchars($this->input->post('alamat', true)),
			'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'foto' => $foto
		];

		$this->db->where('id_toko', $this->session->userdata('id_toko'));
		$this->db->update('toko',$data);

		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil diubah.</div>');
		redirect('daftartoko/session');	
	}
}