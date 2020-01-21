<?php


class m_profile extends CI_Model
{
	function getkeranjang($id_member)
	{
		return $this->db->query("SELECT
			`keranjang`.*
			, `keranjang`.`jmlh_barang` AS jumlah
			, `member`.*
			, `barang`.*
			, `toko`.*
			FROM
			`agrition`.`keranjang`
			INNER JOIN `agrition`.`toko` 
			ON (`keranjang`.`id_toko` = `toko`.`id_toko`)
			INNER JOIN `agrition`.`barang` 
			ON (`keranjang`.`id_barang` = `barang`.`id_barang`)
			INNER JOIN `agrition`.`member` 
			ON (`keranjang`.`id_member` = `member`.`id_member`)
			WHERE keranjang.id_member = '$id_member'
			ORDER BY nama_toko ASC");
	}
}