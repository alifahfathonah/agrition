<?php


class m_cari extends CI_Model
{
	function getkategori()
	{
		return $this->db->get('kategori');
	}

	function cari($keyword)
	{
		$this->db->select('
			`barang`.*
			, `toko`.`nama_toko`
			, `kategori`.`nm_kategori`');
		$this->db->like('nama_barang', $keyword);
		$this->db->or_like('nama_toko', $keyword);
		$this->db->join('toko', '`barang`.`id_toko` = `toko`.`id_toko`');
		$this->db->join('kategori', '`barang`.`id_kategori` = `kategori`.`id_kategori`');
		$this->db->order_by('id_barang', 'DESC');
		$query = $this->db->get('barang');
		return $query;
	}

	function kategori($kategori)
	{
		$this->db->select('
			`barang`.*
			, `toko`.`nama_toko`
			, `kategori`.`nm_kategori`');
		$this->db->join('toko', '`barang`.`id_toko` = `toko`.`id_toko`');
		$this->db->join('kategori', '`barang`.`id_kategori` = `kategori`.`id_kategori`');
		$this->db->where('barang.`id_kategori`', $kategori);
		$this->db->order_by('id_barang', 'DESC');
		$query = $this->db->get('barang');
		return $query;
	}
}