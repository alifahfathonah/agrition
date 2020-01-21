<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Toko extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_toko');

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
			'title' => 'Toko',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-bank',
			'toko' => $this->m_toko->getdata()
		];
		$this->template->load('template', 'admin/toko', $data);
	}

	public function hapus($id_toko)
	{
		$data = $this->m_toko->getfoto($id_toko);
		$path = './assets/img/toko/';
		@unlink($path.$data->foto);

		$this->db->where('id_toko', $id_toko);
		$this->db->delete('toko');
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');
		redirect('admin/toko');
	}

	public function edit($id_toko)
	{
		$data = [
			'title' => 'Edit toko',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-bank',
			'toko' => $this->m_toko->getdatatoko($id_toko)
		];

		$this->template->load('template', 'admin/toko_edit', $data);
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
			'nm_rek' => htmlspecialchars($this->input->post('nm_rek')),
			'bank' => htmlspecialchars($this->input->post('bank')),
			'no_rek' => htmlspecialchars($this->input->post('no_rek')),
			'foto' => $foto
		];

		$this->db->where('id_toko', $this->input->post('id_toko'));
		$this->db->update('toko',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil diubah.</div>');
		redirect('admin/toko');	
	}
}