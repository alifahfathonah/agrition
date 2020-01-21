<?php


class m_toko extends CI_Model
{

	function getdata()
	{
		$query = $this->db->query("SELECT
			`toko`.*
			, `member`.*
			FROM
			`member`
			INNER JOIN `toko` 
			ON (`member`.`id_member` = `toko`.`id_member`);");
		return $query->result();
	}

	function getfoto($id_toko)
	{
		return $this->db->get_where('toko', "id_toko = '$id_toko'")->row();
	}

	function getdatatoko($id_toko)
	{
		return $this->db->get_where('toko', "id_toko = '$id_toko'")->row();
	}
}