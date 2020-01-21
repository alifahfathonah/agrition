<?php


class m_transaksi_admin extends CI_Model
{

	function getAll()
	{
		return $this->db->query("SELECT
			`transaksi`.*
			, `toko`.`nama_toko`
			, `member`.`nama_member`
			FROM
			`agrition`.`transaksi`
			INNER JOIN `agrition`.`member` 
			ON (`transaksi`.`id_member` = `member`.`id_member`)
			INNER JOIN `agrition`.`toko` 
			ON (`transaksi`.`id_toko` = `toko`.`id_toko`)");
	}

	function gettransaksi($id_transaksi)
	{
		return $this->db->query("SELECT
			`pembayaran`.*
			, `transaksi`.`tgl_exp`
			, `rekening`.*
			, `transaksi`.`id_member`
			, `transaksi`.`id_toko`
			, `toko`.`nama_toko`
			, `member`.`nama_member`
			FROM
			`agrition`.`pembayaran`
			INNER JOIN `agrition`.`transaksi` 
			ON (`pembayaran`.`id_transaksi` = `transaksi`.`id_transaksi`)
			INNER JOIN `agrition`.`rekening` 
			ON (`rekening`.`id_rekening` = `pembayaran`.`id_rekening`)
			INNER JOIN `agrition`.`member` 
			ON (`member`.`id_member` = `transaksi`.`id_member`)
			INNER JOIN `agrition`.`toko` 
			ON (`toko`.`id_toko` = `transaksi`.`id_toko`)
			WHERE pembayaran.id_transaksi = '$id_transaksi'");
	}

	function getdetail($id_transaksi)
	{
		return $this->db->query("SELECT
			`transaksi`.*
			, `detail_transaksi`.*
			, `member`.*
			, `barang`.*
			, `kurir`.*
			, `toko`.*
			, `pembayaran`.*
			, transaksi.`status` AS status_trans
			, `rekening`.*
			, `toko`.bank AS bank_toko
			, `admin`.*
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
			INNER JOIN `agrition`.`toko` 
			ON (`toko`.`id_toko` = `transaksi`.`id_toko`)
			INNER JOIN `agrition`.`pembayaran` 
			ON (`pembayaran`.`id_transaksi` = `transaksi`.`id_transaksi`)
			INNER JOIN `agrition`.`rekening` 
			ON (`pembayaran`.`id_rekening` = `rekening`.`id_rekening`)
			INNER JOIN `agrition`.`admin` 
			ON (`pembayaran`.`id_admin` = `admin`.`id_admin`)
			
			WHERE transaksi.id_transaksi='$id_transaksi'");
	}

}