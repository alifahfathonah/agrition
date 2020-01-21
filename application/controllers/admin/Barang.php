<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Barang extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang_admin');

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
			'title' => 'Barang',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-tasks',
			'barang' => $this->m_barang_admin->getdata()
		];
		$this->template->load('template', 'admin/barang', $data);
	}

	public function hapus($id_barang)
	{
		$data = $this->m_barang_admin->getdatabarang($id_barang);
		$path = './assets/img/barang';
		@unlink($path.$data->gambar);

		$this->db->where('id_barang', $id_barang);
		$this->db->delete('barang');
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');
		redirect('admin/barang');
	}
}