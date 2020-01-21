<?php

class m_login extends CI_Model
{
	function auth_admin($username,$password)
	{
		$query = $this->db->query("SELECT * FROM admin WHERE username='$username' AND PASSWORD='$password' limit 1");
		return $query;
	}

	function auth_member($username,$password)
	{
		$query = $this->db->query("SELECT * FROM member WHERE username='$username' AND PASSWORD='$password' limit 1");
		return $query; 
	}

	function cektoko($id_member)
	{
		return $this->db->get_where('toko', "id_member = '$id_member'");
	}
}