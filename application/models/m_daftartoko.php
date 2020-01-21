<?php


class m_daftartoko extends CI_Model
{

	function cektoko($id_member)
	{
		return $this->db->get_where('toko', "id_member = '$id_member'")->row();
	}
}