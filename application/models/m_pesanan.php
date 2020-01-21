<?php


class m_pesanan extends CI_Model
{

	function getdetail($id_toko,$id_transaksi)
	{
		return $this->db->query("SELECT
			`transaksi`.*
			, `detail_transaksi`.*
			, `member`.*
			, `barang`.*
			, `kurir`.*
			, transaksi.`status` AS status_trans
			FROM
			`agrition`.`transaksi`
			INNER JOIN `agrition`.`member` 
			ON (`transaksi`.`id_member` = `member`.`id_member`)
			INNER JOIN `agrition`.`detail_transaksi` 
			ON (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`)
			INNER JOIN `agrition`.`barang` 
			ON (`detail_transaksi`.`id_barang` = `barang`.`id_barang`)
			INNER JOIN `agrition`.`kurir` 
			ON (`transaksi`.`id_kurir` = `kurir`.`id_kurir`)
			WHERE transaksi.id_toko = '$id_toko' AND transaksi.id_transaksi='$id_transaksi'");
	}

	function getpesanan($id_toko)
	{
		return $this->db->query("SELECT
			`transaksi`.*
			, `member`.*
			, transaksi.`status` AS status_trans
			FROM
			`agrition`.`transaksi`
			INNER JOIN `agrition`.`member` 
			ON (`transaksi`.`id_member` = `member`.`id_member`)
			WHERE transaksi.id_toko = '$id_toko'
			ORDER BY id_transaksi DESC");
	}

}