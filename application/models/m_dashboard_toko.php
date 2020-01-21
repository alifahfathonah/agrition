<?php


class m_dashboard_toko extends CI_Model
{

	function gettoko($id_toko)
	{
		return $this->db->get_where('toko', "id_toko='$id_toko'");
	}

}