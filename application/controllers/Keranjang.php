<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Keranjang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_keranjang');

		if ($this->session->userdata('aktif') != TRUE) {
			redirect('home');
		}

		if ($this->session->userdata('jabatan') != 'Member') {
			redirect('admin/dashboard');
		}
	}


	public function index()
	{
		
		$data = [
			'title' => 'Keranjang',
			'small' => 'Welcome',
			'keranjang' => $this->m_keranjang->getkeranjang($this->session->userdata('id'))->result(),
			'toko' => $this->m_keranjang->gettoko($this->session->userdata('id'))->result()
		];

		$this->template->load('frontend/template','frontend/Keranjang', $data);
	}

	public function action1()
	{
		$pilihan = $this->input->post('formsubmit');

		if ($pilihan == 'simpan') {
			$this->db->where('id_keranjang', $this->input->post('id_keranjang'));
			$this->db->update('keranjang', array('jmlh_barang' => $this->input->post('jumlah')));
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemeritahuan!</h4>Data berhasil tersimpan</div>');
			redirect('keranjang');
		}elseif ($pilihan == 'hapus') {
			$this->db->where('id_keranjang', $this->input->post('id_keranjang'));
			$this->db->delete('keranjang');
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');
			redirect('keranjang');
		}else{
			$cek = $this->m_keranjang->cektrans($this->session->userdata('id'))->row();
			if ($cek->id_transaksi != null) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Anda memiliki transaksi yang belum di selesaikan.</div>');
				redirect('keranjang');
			}else{
				$date = '%Y-%m-%d %H:%i:%s';
				$now = mdate($date);
				$subtotal = $this->input->post('harga')*$this->input->post('jumlah');
				$lastid = $this->m_keranjang->getlastid()->row('id_transaksi');
				$exp = mdate($date, strtotime('+ 1 days'));

				$data = [
					'id_transaksi' => $lastid+1,
					'tgl_trans' => $now,
					'id_toko' => $this->input->post('id_toko'),
					'id_member' => $this->session->userdata('id'),
					'tgl_exp' => $exp,
				];

				$this->db->insert('transaksi',$data);

				$data2 = [
					'id_transaksi' => $lastid+1,
					'id_barang' => $this->input->post('id_barang'),
					'qty' => $this->input->post('jumlah'),
					'subtotal' => $subtotal,
				];

				$this->db->insert('detail_transaksi',$data2);

				$this->db->where('id_keranjang', $this->input->post('id_keranjang'));
				$this->db->delete('keranjang');

				redirect('transaksi');
			}
		}
	}

	public function pertoko()
	{
		if ($this->input->post('toko') == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Anda belum memilih toko.</div>');
			redirect('keranjang');
		}else{
			$cek = $this->m_keranjang->cektrans($this->session->userdata('id'))->row();
			if ($cek->id_transaksi != null) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Anda memiliki transaksi yang belum di selesaikan.</div>');
				redirect('keranjang');
			}else{
				$id_toko = $this->input->post('toko');
				$id_member = $this->session->userdata('id');
				$toko = $this->m_keranjang->pertoko($id_toko, $id_member)->result();

				$date = '%Y-%m-%d %h:%i:%s';
				$now = mdate($date);
				$lastid = $this->m_keranjang->getlastid()->row('id_transaksi');
				$exp = mdate($date, strtotime('+ 1 days'));

				$data = [
					'id_transaksi' => $lastid+1,
					'tgl_trans' => $now,
					'id_toko' => $id_toko,
					'id_member' => $this->session->userdata('id'),
					'tgl_exp' => $exp,
				]; 

				$this->db->insert('transaksi',$data);

				foreach ($toko as $t) {
					$data2 = [
						'id_transaksi' => $lastid+1,
						'id_barang' => $t->id_brg,
						'qty' => $t->jumlah,
						'subtotal' => $t->jumlah*$t->harga_barang,
					];

					$this->db->insert('detail_transaksi',$data2);

					$this->db->where('id_keranjang', $t->id_keranjang);
					$this->db->delete('keranjang');
				}
				redirect('transaksi');
			}
		}
	}
}