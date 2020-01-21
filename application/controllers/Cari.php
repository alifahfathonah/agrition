<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Cari extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_cari');
	}

	public function index($keyword = null, $kategori = null)
	{
		if (isset($_GET['keyword'])) {
			$keyword = $_GET['keyword'];
			$hasil = $this->m_cari->cari($keyword)->result();
			$kata = $keyword;
		}elseif (isset($_GET['kategori'])) {
			$kategori = $_GET['kategori'];
			$hasil = $this->m_cari->kategori($kategori)->result();
			$kata = $this->m_cari->kategori($kategori)->row('nm_kategori');
		}else{
			$hasil = null;
			$kata = null;
		}

		$data = [
			'title' => 'Cari',
			'small' => 'Welcome',
			'kategori' => $this->m_cari->getkategori()->result(),
			'hasil' => $hasil,
			'kata' => $kata
		];

		$this->template->load('frontend/template','frontend/cari', $data);
	}
}