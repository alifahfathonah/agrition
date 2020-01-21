<?php


class m_dashboard_admin extends CI_Model
{

	function getadmin($id_admin)
	{
		return $this->db->get_where('admin', "id_admin='$id_admin'");
	}

	function getpembayaran()
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
			ON (`transaksi`.`id_toko` = `toko`.`id_toko`)
			WHERE transaksi.status='Memproses Pembayaran'
			ORDER BY tgl_exp ASC");
	}

	function getrefund()
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
			ON (`transaksi`.`id_toko` = `toko`.`id_toko`)
			WHERE transaksi.status='Refund'
			ORDER BY tgl_exp ASC");
	}

	function getterima()
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
			ON (`transaksi`.`id_toko` = `toko`.`id_toko`)
			WHERE transaksi.status='Diterima'
			ORDER BY tgl_exp ASC");
	}
}