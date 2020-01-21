<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Kategori extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_kategori');

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
			'title' => 'Kategori',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-tags',
			'kategori' => $this->m_kategori->getdata()->result()
		];
		$this->template->load('template', 'admin/Kategori', $data);
	}

	public function tambah()
	{
		$nama = $this->input->post('nama');
		$cekdata =  $this->m_kategori->cekdata($nama);

		if ($cekdata != null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Data sudah ada.</div>');
			redirect('admin/kategori');
		}else{

			$data = [
				'nm_kategori' => htmlspecialchars($this->input->post('nama', true)),
				'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
			];

			$this->db->insert('kategori', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil ditambahkan.</div>');
			redirect('admin/kategori');
		}
	}

	public function edit($id_kategori)
	{
		$data = [
			'title' => 'Edit Kategori',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-tags',
			'kategori' => $this->m_kategori->getdatakategori($id_kategori)
		];
		$this->template->load('template', 'admin/Kategori_edit', $data);
	}

	public function simpan()
	{

		$data = [
			'nm_kategori' => htmlspecialchars($this->input->post('nama', true)),
			'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
		];

		$this->db->where('id_kategori', $this->input->post('id_kategori'));
		$this->db->update('kategori',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil diubah.</div>');
		redirect('admin/kategori');
	}

	public function hapus($id_kategori)
	{
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('kategori');
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');
		redirect('admin/kategori');
	}
}