<?php


class m_member extends CI_Model
{

	function getdata()
	{
		return $this->db->get('member');
	}

	function getdatamember($id_member)
	{
		return $this->db->get_where('member', "id_member = '$id_member'")->row();
	}
}