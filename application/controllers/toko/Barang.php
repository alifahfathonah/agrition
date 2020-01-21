<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Barang extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');

		if ($this->session->userdata('aktif') != TRUE) {
			redirect('home');
		}

		if ($this->session->userdata('jabatan') != 'Member') {
			redirect('home');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Barang',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-tasks',
			'barang' => $this->m_barang->getdata($this->session->userdata('id_toko')),
			'kategori' => $this->m_barang->getkategori()->result()
		];
		$this->template->load('template', 'toko/Barang', $data);
	}

	public function tambah()
	{
		$config['upload_path'] = './assets/img/barang';
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
		$config['max_size'] = '10000000000000000000000000000000000';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('foto')){
				//validasi gagal
			$error = ['error' => $this->upload->display_errors()];
			$this->index($error);
		} else {
			$upload_data = $this->upload->data();
			$foto = $upload_data['file_name'];
			$data = [
				'nama_barang' => htmlspecialchars($this->input->post('nama', true)),
				'berat_barang' => htmlspecialchars($this->input->post('berat', true)),
				'harga_barang' => htmlspecialchars($this->input->post('harga', true)),
				'gambar' => $foto,
				'jmlh_barang' => htmlspecialchars($this->input->post('jumlah', true)),
				'status_barang' => 'Tersedia',
				'keterangan' => htmlspecialchars($this->input->post('keterangan', true)), 
				'id_toko' => $this->session->userdata('id_toko'),
				'id_kategori' => htmlspecialchars($this->input->post('kategori', true)),
			];
			$this->db->insert('barang', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil ditambahkan</div>');
			redirect('toko/barang');
		}
	}

	public function hapus($id_barang)
	{
		$data = $this->m_barang->getdatabarang($this->session->userdata('id_toko'), $id_barang);
		$path = './assets/img/barang/';
		@unlink($path.$data->gambar);

		$this->db->where('id_barang', $id_barang);
		$this->db->delete('barang');
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');
		redirect('toko/barang');
	}

	public function edit($id_barang)
	{
		$data = [
			'title' => 'Edit Barang',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-tasks',
			'barang' => $this->m_barang->getdatabarang($this->session->userdata('id_toko'), $id_barang),
			'kategori' => $this->m_barang->getkategori()->result()
		];
		$this->template->load('template', 'toko/barang_edit', $data);
	}

	public function simpan()
	{
		if (!empty($_FILES["foto"]["name"])) {
			$data = $this->input->post('foto_lama');
			$path = './assets/img/barang/';
			@unlink($path.$data);

			$config['upload_path'] = './assets/img/barang';
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
				'nama_barang' => htmlspecialchars($this->input->post('nama', true)),
				'berat_barang' => htmlspecialchars($this->input->post('berat', true)),
				'harga_barang' => htmlspecialchars($this->input->post('harga', true)),
				'gambar' => $foto,
				'jmlh_barang' => htmlspecialchars($this->input->post('jumlah', true)),
				'status_barang' => htmlspecialchars($this->input->post('status', true)),
				'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),  
				'id_toko' => $this->session->userdata('id_toko'),
				'id_kategori' => htmlspecialchars($this->input->post('kategori', true)),
			];

		$this->db->where('id_barang', $this->input->post('id_barang'));
		$this->db->update('barang',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil diubah.</div>');
		redirect('toko/barang');	
	}
}