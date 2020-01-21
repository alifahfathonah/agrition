<?php


class m_transaksi extends CI_Model
{

	function gettransaksi($id_member)
	{
		return $this->db->query("SELECT
			`transaksi`.*
			, `detail_transaksi`.*
			, `barang`.*
			, `toko`.*
			FROM
			`transaksi`
			INNER JOIN `detail_transaksi` 
			ON (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`)
			INNER JOIN `barang` 
			ON (`barang`.`id_barang` = `detail_transaksi`.`id_barang`)
			INNER JOIN `agrition`.`toko` 
			ON (`transaksi`.`id_toko` = `toko`.`id_toko`)

			WHERE transaksi.id_member = '$id_member' AND transaksi.status IS NULL");
	}

	function total($id_member)
	{
		return $this->db->query("SELECT
			SUM(subtotal) AS total
			FROM
			`transaksi`
			INNER JOIN `detail_transaksi` 
			ON (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`)
			INNER JOIN `barang` 
			ON (`barang`.`id_barang` = `detail_transaksi`.`id_barang`)

			WHERE id_member = '$id_member' AND transaksi.status IS NULL");
	}

	function getkurir()
	{
		return $this->db->get('kurir');
	}

	function getrekening()
	{
		return $this->db->get('rekening');
	}

	function getrecent($id_member)
	{
		return $this->db->query("SELECT
			`transaksi`.*
			, `toko`.*
			FROM
			`transaksi`
			INNER JOIN `agrition`.`toko` 
			ON (`transaksi`.`id_toko` = `toko`.`id_toko`)

			WHERE transaksi.id_member = '$id_member' ORDER BY id_transaksi DESC");
	}

	function getbiaya($id_kurir)
	{
		return $this->db->get_where('kurir', "id_kurir = '$id_kurir'");
	}

	function pembayaran($id_transaksi,$id_member)
	{
		return $this->db->query("SELECT
			`pembayaran`.*
			, `rekening`.*
			FROM
			`agrition`.`pembayaran`
			INNER JOIN `agrition`.`rekening` 
			ON (`pembayaran`.`id_rekening` = `rekening`.`id_rekening`)
			INNER JOIN `agrition`.`transaksi` 
			ON (`pembayaran`.`id_transaksi` = `transaksi`.`id_transaksi`)
			WHERE pembayaran.id_transaksi='$id_transaksi' AND id_member = '$id_member'");
	}

	function detailtrans($id_member,$id_transaksi)
	{
		return $this->db->query("SELECT
			`transaksi`.*
			, `detail_transaksi`.*
			, `barang`.*
			, `toko`.*
			, `kurir`.*
			, transaksi.`status` AS status_trans
			FROM
			`transaksi`
			INNER JOIN `detail_transaksi` 
			ON (`transaksi`.`id_transaksi` = `detail_transaksi`.`id_transaksi`)
			INNER JOIN `barang` 
			ON (`barang`.`id_barang` = `detail_transaksi`.`id_barang`)
			INNER JOIN `agrition`.`toko` 
			ON (`transaksi`.`id_toko` = `toko`.`id_toko`)
			INNER JOIN `agrition`.`kurir` 
			ON (`transaksi`.`id_kurir` = `kurir`.`id_kurir`)

			WHERE transaksi.id_member = '$id_member' AND transaksi.id_transaksi = '$id_transaksi'");
	}
}