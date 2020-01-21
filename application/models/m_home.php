<?php


class m_home extends CI_Model
{	

	function count()
	{
		return $this->db->query("SELECT
			`barang`.*
			, `toko`.`nama_toko`
			, `kategori`.`nm_kategori`
			FROM
			`agrition`.`barang`
			INNER JOIN `agrition`.`toko` 
			ON (`barang`.`id_toko` = `toko`.`id_toko`)
			INNER JOIN `agrition`.`kategori` 
			ON (`barang`.`id_kategori` = `kategori`.`id_kategori`)")->num_rows();
	}

	function getbarang($perpage,$start)
	{
		$this->db->select('
			`barang`.*
			, `toko`.`nama_toko`
			, `kategori`.`nm_kategori`');
		$this->db->join('toko', '`barang`.`id_toko` = `toko`.`id_toko`');
		$this->db->join('kategori', '`barang`.`id_kategori` = `kategori`.`id_kategori`');
		$this->db->order_by('id_barang', 'DESC');
		$query = $this->db->get('barang', $perpage,$start);
		return $query->result();
	}

	function getdata($id_barang)
	{
		return $this->db->query("SELECT
			`barang`.*
			, `toko`.`nama_toko`
			, `kategori`.`nm_kategori`
			FROM
			`agrition`.`barang`
			INNER JOIN `agrition`.`toko` 
			ON (`barang`.`id_toko` = `toko`.`id_toko`)
			INNER JOIN `agrition`.`kategori` 
			ON (`barang`.`id_kategori` = `kategori`.`id_kategori`)
			WHERE id_barang = '$id_barang'")->row();
	}

	function cekkeranjang($id_barang,$id_member)
	{
		return $this->db->query("SELECT * FROM keranjang where id_barang='$id_barang' AND id_member='$id_member'");
	}

	function cekbarang($id_barang, $id_toko)
	{
		return $this->db->query("SELECT * FROM barang WHERE id_barang ='$id_barang' AND id_toko='$id_toko'");
	}

	function gettoko($id_toko)
	{
		return $this->db->get_where('toko', "id_toko = $id_toko");
	}

	function getbarangtoko($id_toko)
	{
		return $this->db->query("SELECT
			`barang`.*
			, `kategori`.`nm_kategori`
			FROM
			`agrition`.`barang`
			INNER JOIN `agrition`.`kategori` 
			ON (`barang`.`id_kategori` = `kategori`.`id_kategori`)
			WHERE id_toko = '$id_toko'");
	}

	function getbarangtoko2($perpage,$start,$id_toko)
	{
		$this->db->select('
			`barang`.*
			, `kategori`.`nm_kategori`');
		$this->db->join('kategori', '`barang`.`id_kategori` = `kategori`.`id_kategori`');
		$this->db->where('id_toko', $id_toko);
		$this->db->order_by('id_barang', 'DESC');
		$query = $this->db->get('barang', $perpage,$start);
		return $query->result();
	}

	function verifikasi($id)
	{
		$this->db->where('id_member', $id);
		$this->db->update('member', array('is_active' => '1' ));

		return TRUE;
	}
}