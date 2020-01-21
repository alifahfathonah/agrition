<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transaksi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');

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
			'title' => 'Transaksi',
			'small' => 'Welcome',
			'transaksi' => $this->m_transaksi->gettransaksi($this->session->userdata('id'))->result(),
			'trans' => $this->m_transaksi->gettransaksi($this->session->userdata('id'))->row(),
			'total' => $this->m_transaksi->total($this->session->userdata('id'))->row('total'),
			'kurir' => $this->m_transaksi->getkurir()->result(),
			'rekening' => $this->m_transaksi->getrekening()->result(),
			'recenttrans' => $this->m_transaksi->getrecent($this->session->userdata('id'))->result()
		];

		$this->template->load('frontend/template','frontend/transaksi', $data);
	}

	public function action()
	{
		$formsubmit = $this->input->post('formsubmit');

		if ($formsubmit == 'batal') {
			$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
			$this->db->delete('transaksi');
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Transaksi berhasil dibatalkan.</div>');
			redirect('keranjang');
		}else{
			if ($this->input->post('kurir') == null || $this->input->post('rekening') == null) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Anda belum memilih kurir atau pembayaran.</div>');
				redirect('transaksi');
			}else{

				$this->load->helper('string');

				$getbiayakurir = $this->m_transaksi->getbiaya($this->input->post('kurir'))->row('biaya_kirim');
				$total = $this->input->post('total')+$getbiayakurir+2500;
				$kode = random_string('nozero',3);
				$nominal = $total - $kode;

				$date = '%Y-%m-%d %H:%i:%s';
				$exp = mdate($date, strtotime('+ 1 days'));

				$data = [
					'id_kurir' => $this->input->post('kurir'),
					'total_bayar' => $nominal,
					'tgl_exp' => $exp,
					'status' => 'Menunggu Pembayaran'
				]; 

				$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
				$this->db->update('transaksi', $data);

				$data2 = [
					'id_transaksi' => $this->input->post('id_transaksi'),
					'id_rekening' => $this->input->post('rekening'),
					'kode_unik' => $kode,
					'nominal' => $nominal
				];

				$this->db->insert('pembayaran', $data2);

				redirect('transaksi/pembayaran/'.$this->input->post('id_transaksi'));
			}
		}
	}

	public function detail($id_transaksi)
	{

		$cek = $this->db->get_where('transaksi', "id_transaksi = '$id_transaksi'")->row();

		if ($cek->status == 'Menunggu Pembayaran') {
			$cekpembayaran = $this->db->get_where('Pembayaran', "id_transaksi = '$id_transaksi'")->row();
			if ($cekpembayaran->status = "Ditolak") {
				$this->session->set_flashdata('message1', "<script>
					$('#fail').modal('show');
					</script>");
				redirect('transaksi/pembayaran/'.$id_transaksi);
			}
			redirect('transaksi/pembayaran/'.$id_transaksi);
		}elseif ($cek->status == 'Memproses Pembayaran' || $cek->status == 'Pengemasan' || $cek->status == 'Dikirim' || $cek->status == 'Diterima' || $cek->status == 'Refund' || $cek->status == 'Selesai') {

			$data = [
				'title' => 'Transaksi',
				'small' => 'Detail',
				'detail' => $this->m_transaksi->detailtrans($this->session->userdata('id'),$id_transaksi)->row(),
				'detail2' => $this->m_transaksi->detailtrans($this->session->userdata('id'),$id_transaksi)->result(),
				'pembayaran' => $this->m_transaksi->pembayaran($id_transaksi,$this->session->userdata('id'))->row(),
			];

			$this->template->load('frontend/template','frontend/detailtrans', $data);
		}elseif ($cek->status == null) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Silahkan Pilih Kurir dan Pembayaran Terlebih Dahulu.</div>');
			redirect('transaksi');
		}
	}

	public function pembayaran($id_transaksi)
	{
		$data = [
			'title' => 'Pembayaran',
			'small' => 'Welcome',
			'pembayaran' => $this->m_transaksi->pembayaran($id_transaksi,$this->session->userdata('id'))->row(),
			'detail' => $this->m_transaksi->detailtrans($this->session->userdata('id'),$id_transaksi)->row(),
			'detail2' => $this->m_transaksi->detailtrans($this->session->userdata('id'),$id_transaksi)->result()
		];

		$this->template->load('frontend/template','frontend/Pembayaran', $data);
	}

	public function cancel($id_transaksi)
	{
		$this->db->where('id_member', $this->session->userdata('id'));
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->delete('transaksi');
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Transaksi berhasil dibatalkan.</div>');
		redirect('transaksi');
	}

	public function upload()
	{
		$date = '%Y-%m-%d %H:%i:%s';
		$tgl = mdate($date);
		$exp = mdate($date, strtotime('+ 1 days'));

		$config['upload_path'] = './assets/img/bukti';
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
			$data = [
				'nama_rek' => htmlspecialchars($this->input->post('pemilik', true)),
				'no_rek_bayar' => htmlspecialchars($this->input->post('no_rek', true)),
				'bank' => htmlspecialchars($this->input->post('bank', true)),
				'jmlh_bayar' => htmlspecialchars($this->input->post('jumlah', true)),
				'tgl_bayar' => $tgl,
				'bukti_bayar' => $foto,
				'status' => 'Proses'
			];
			$this->db->where('id_pembayaran', $this->input->post('id_pembayaran'));
			$this->db->update('pembayaran',$data);

			$data2 = [
				'tgl_exp' => $exp,
				'status' => 'Memproses Pembayaran',
			];

			$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
			$this->db->update('transaksi',$data2);

			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Pembayaran akan segera diproses dalam waktu 1x24 jam, harap tunggu!</div>');
			redirect('transaksi');

		}
	}

	public function diterima()
	{
		$date = '%Y-%m-%d %H:%i:%s';
		$exp = mdate($date, strtotime('+ 2 days'));

		$data = [
			'status' => 'Diterima',
			'tgl_exp' => $exp,
		];

		$this->db->where('id_transaksi', $this->input->post('id_transaksi'));
		$this->db->update('transaksi',$data);
		redirect('transaksi/detail/'.$this->input->post('id_transaksi'));
	}
}