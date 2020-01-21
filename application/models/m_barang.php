<?php


class m_barang extends CI_Model
{

	function getdata($id_toko)
	{
		$query = $this->db->query("SELECT
			`barang`.*
			, `kategori`.`nm_kategori`
			FROM
			`agrition`.`barang`
			INNER JOIN `agrition`.`kategori` 
			ON (`barang`.`id_kategori` = `kategori`.`id_kategori`)
			WHERE id_toko = '$id_toko'");
		return $query->result();
	}

	function getdatabarang($id_toko,$id_barang)
	{
		$query = $this->db->query("SELECT
			`barang`.*
			, `kategori`.`nm_kategori`
			FROM
			`agrition`.`barang`
			INNER JOIN `agrition`.`kategori` 
			ON (`barang`.`id_kategori` = `kategori`.`id_kategori`)
			WHERE id_toko = '$id_toko' AND id_barang='$id_barang'");
		return $query->row();
	}

	function getkategori()
	{
		return $this->db->get('kategori');
	}
}