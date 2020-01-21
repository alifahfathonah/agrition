<?php


class m_kurir extends CI_Model
{

	function getdata()
	{
		return $this->db->get('kurir');
	}

	function cekdata($nama)
	{
		return $this->db->get_where('kurir', "nama_kurir = '$nama'")->row();
	}

	function getdatakurir($id_kurir)
	{
		return $this->db->get_where('kurir', "id_kurir = '$id_kurir'")->row();
	}
}