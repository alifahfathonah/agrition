<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Pesanan extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pesanan');

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
			'title' => 'Pesanan',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-cart-arrow-down',
			'pesanan' => $this->m_pesanan->getpesanan($this->session->userdata('id_toko'))->result()
		];
		$this->template->load('template', 'toko/pesanan', $data);
	}

	public function detail($id_transaksi)
	{
		$data = [
			'title' => 'Pesanan',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-cart-arrow-down',
			'detail' => $this->m_pesanan->getdetail($this->session->userdata('id_toko'),$id_transaksi)->row(),
			'detail2' => $this->m_pesanan->getdetail($this->session->userdata('id_toko'),$id_transaksi)->result(),
		];
		$this->template->load('template', 'toko/detail_pesanan', $data);
	}

	public function nores()
	{
		$date = '%Y-%m-%d %H:%i:%s';
		$exp = mdate($date, strtotime('+ 2 days'));

		$data = [
			'no_resi' => $this->input->post('no_res'),
			'tgl_exp' => $exp,
			'status' => 'Dikirim'
		];

		$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
		$this->db->update('transaksi', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Status berhasil diperbarui, pembayaran akan dilanjutkan setelah barang diterima</div>');
		redirect('toko/pesanan/detail/'.$this->input->post('id_transaksi'));
	}

	public function batal($id_transaksi)
	{
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->where('id_toko', $this->session->userdata('id_toko'));
		$this->db->update('transaksi', array('status' => 'Refund' ));

		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Transaksi telah dibatalkan.</div>');
		redirect('toko/pesanan/detail/'.$id_transaksi);
	}
}