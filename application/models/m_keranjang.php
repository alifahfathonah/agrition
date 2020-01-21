<?php


class m_keranjang extends CI_Model
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

	function gettoko($id_member)
	{
		return $this->db->query("SELECT DISTINCT
			`keranjang`.`id_toko`
			, `toko`.`nama_toko`
			, `keranjang`.`id_member`
			FROM
			`agrition`.`keranjang`
			INNER JOIN `agrition`.`toko` 
			ON (`keranjang`.`id_toko` = `toko`.`id_toko`)
			WHERE keranjang.id_member = '$id_member'");
	}

	function getlastid()
	{
		return $this->db->query('SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1
			');
	}

	function cektrans($id_member)
	{
		return $this->db->query("SELECT * FROM transaksi WHERE id_member = '$id_member' AND status IS NULL");
	}

	function pertoko($id_toko,$id_member)
	{
		return $this->db->query("SELECT
			`keranjang`.*
			, `keranjang`.`jmlh_barang` AS jumlah
			, `keranjang`.`id_barang` AS id_brg
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
			WHERE keranjang.id_member = '$id_member' AND keranjang.id_toko = '$id_toko'");
	}
}