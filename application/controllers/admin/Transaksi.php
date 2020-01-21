<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transaksi extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi_admin');

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
			'title' => 'Transaksi',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-money',
			'transaksi' => $this->m_transaksi_admin->getAll()->result()
			
		];
		$this->template->load('template', 'admin/transaksi', $data);
	}

	public function detail($id_transaksi)
	{
		$cek = $this->db->get_where('transaksi', "id_transaksi = '$id_transaksi'")->row();

		if ($cek->status == "Memproses Pembayaran") {
			redirect('admin/transaksi/konfirmasi/'.$id_transaksi);
		}else{
			$data = [
				'title' => 'Transaksi',
				'title_icon' => 'fa-folder-open',
				'breadcrumb_icon' => 'fa-money',
				'detail' => $this->m_transaksi_admin->getdetail($id_transaksi)->row(),
				'detail2' => $this->m_transaksi_admin->getdetail($id_transaksi)->result()

			];
			$this->template->load('template', 'admin/detail_trans', $data);
		}
	}

	public function konfirmasi($id_transaksi)
	{
		$cek = $this->db->get_where('transaksi', "id_transaksi = '$id_transaksi'")->row();

		if ($cek->status != "Memproses Pembayaran") {
			redirect('admin/transaksi');
		}else{
			$data = [
				'title' => 'Transaksi',
				'title_icon' => 'fa-folder-open',
				'breadcrumb_icon' => 'fa-money',
				'transaksi' => $this->m_transaksi_admin->gettransaksi($id_transaksi)->row()

			];
			$this->template->load('template', 'admin/konfirmasi', $data);
		}
	}

	public function action()
	{
		$formsubmit = $this->input->post('formsubmit');

		$date = '%Y-%m-%d %H:%i:%s';
		$exp = mdate($date, strtotime('+ 1 days'));

		if ($formsubmit == 'terima') {
			$this->db->where('id_pembayaran', $this->input->post('id_pembayaran'));
			$this->db->update('pembayaran', array('status' => 'Diterima', 'id_admin' => $this->session->userdata('id')));

			$data = [
				'tgl_exp' => $exp,
				'status' => 'Pengemasan',
			];

			$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
			$this->db->update('transaksi', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Transaksi berhasil dikonfirmasi.</div>');
			redirect('admin/transaksi');
		}elseif($formsubmit == 'tolak'){
			$this->db->where('id_pembayaran', $this->input->post('id_pembayaran'));
			$this->db->update('pembayaran', array('status' => 'Ditolak', 'id_admin' => $this->session->userdata('id')));

			$data = [
				'tgl_exp' => $exp,
				'status' => 'Menunggu Pembayaran',
			];

			$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
			$this->db->update('transaksi', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Transaksi berhasil dikonfirmasi.</div>');
			redirect('admin/transaksi');
		}
	}

	public function melanjutkan()
	{
		$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
		$this->db->update('transaksi', array('status' => 'Selesai' ));

		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Transaksi Berhasil Diselesaikan.</div>');
		redirect('admin/transaksi');
	}
}