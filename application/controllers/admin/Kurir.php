<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Kurir extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_kurir');

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
			'title' => 'Kurir',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-motorcycle',
			'kurir' => $this->m_kurir->getdata()->result()
		];
		$this->template->load('template', 'admin/Kurir', $data);
	}

	public function tambah()
	{
		$nama = $this->input->post('nama');
		$cekdata =  $this->m_kurir->cekdata($nama);

		if ($cekdata != null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Data sudah ada.</div>');
			redirect('admin/kurir');
		}else{

			$data = [
				'nama_kurir' => htmlspecialchars($this->input->post('nama', true)),
				'durasi_kirim' => htmlspecialchars($this->input->post('durasi', true)),
				'biaya_kirim' => htmlspecialchars($this->input->post('biaya', true)),
			];

			$this->db->insert('kurir', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil ditambahkan.</div>');
			redirect('admin/kurir');
		}
	}

	public function edit($id_kurir)
	{
		$data = [
			'title' => 'Edit Kurir',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-motorcycle',
			'kurir' => $this->m_kurir->getdatakurir($id_kurir)
		];
		$this->template->load('template', 'admin/kurir_edit', $data);
	}

	public function simpan()
	{
		$data = [
			'nama_kurir' => htmlspecialchars($this->input->post('nama', true)),
			'durasi_kirim' => htmlspecialchars($this->input->post('durasi', true)),
			'biaya_kirim' => htmlspecialchars($this->input->post('biaya', true)),
		];

		$this->db->where('id_kurir', $this->input->post('id_kurir'));
		$this->db->update('kurir',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil diubah.</div>');
		redirect('admin/kurir');
	}

	public function hapus($id_kurir)
	{
		$this->db->where('id_kurir', $id_kurir);
		$this->db->delete('kurir');
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');
		redirect('admin/kurir');
	}
}