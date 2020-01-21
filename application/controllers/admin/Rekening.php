<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Rekening extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_rekening');

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
			'title' => 'Rekening',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-credit-card',
			'rekening'=> $this->m_rekening->getdata()
		];
		$this->template->load('template', 'admin/Rekening', $data);
	}

	public function tambah()
	{
		$data = [
			'nm_bank' => htmlspecialchars($this->input->post('nama', true)),
			'kode_bank' => htmlspecialchars($this->input->post('kode', true)),
			'pemilik' => htmlspecialchars($this->input->post('pemilik', true)),
			'no_rek' => htmlspecialchars($this->input->post('no_rek', true))
		];
		$this->db->insert('rekening',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil ditambahkan</div>');
		redirect('admin/rekening');
	}

	public function hapus($id_rekening)
	{

		if ($this->m_rekening->hapus_data($id_rekening)==true) {
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');

		}
		redirect('admin/rekening');
	}

	public function edit($id_rekening)
	{
		$data = [
			'title' => 'Edit rekening',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-dollar',
			'rekening' => $this->m_rekening->getrekening($id_rekening)
		];

		$this->template->load('template', 'admin/rekening_edit', $data);
	}

	public function simpan()
	{
		$data = [
			'nm_bank' => htmlspecialchars($this->input->post('nama', true)),
			'kode_bank' => htmlspecialchars($this->input->post('kode', true)),
			'pemilik' => htmlspecialchars($this->input->post('pemilik', true)),
			'no_rek' => htmlspecialchars($this->input->post('no_rek', true)),
		];
		$this->db->where('id_rekening', $this->input->post('id_rekening'));
		$this->db->update('rekening',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil diubah</div>');
		redirect('admin/rekening');
	}
}