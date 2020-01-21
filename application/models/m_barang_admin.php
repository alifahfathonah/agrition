<?php


class m_barang_admin extends CI_Model
{

	function getdata()
	{
		$query = $this->db->query("SELECT
			`barang`.*
			, `kategori`.`nm_kategori`
			, `toko`.`nama_toko`
			FROM
			`barang`
			INNER JOIN `kategori` 
			ON (`barang`.`id_kategori` = `kategori`.`id_kategori`)
			INNER JOIN `toko` 
			ON (`toko`.`id_toko` = `barang`.`id_toko`)");
		return $query->result();
	}

	function getdatabarang($id_barang)
	{
		$query = $this->db->query("SELECT
			`barang`.*
			, `kategori`.`nm_kategori`
			, `toko`.`nama_toko`
			FROM
			`barang`
			INNER JOIN `kategori` 
			ON (`barang`.`id_kategori` = `kategori`.`id_kategori`)
			INNER JOIN `toko` 
			ON (`toko`.`id_toko` = `barang`.`id_toko`)
			where id_barang='$id_barang'");
		return $query->row();
	}
}