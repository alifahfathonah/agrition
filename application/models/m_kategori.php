<?php


class m_kategori extends CI_Model
{

	function getdata()
	{
		return $this->db->get('kategori');
	}

	function cekdata($nama)
	{
		return $this->db->get_where('kategori', "nm_kategori = '$nama'")->row();
	}

	function getdatakategori($id_kategori)
	{
		return $this->db->get_where('kategori', "id_kategori = '$id_kategori'")->row();
	}
}