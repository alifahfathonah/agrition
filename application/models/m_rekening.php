<?php


class m_rekening extends CI_Model
{

	function getdata()
	{
		return $this->db->get('rekening')->result();
	}

	function hapus_data($id_rekening)
	{
		$this->db->where('id_rekening', $id_rekening);
		$this->db->delete('rekening');
		return TRUE;
	}

	function getrekening($id_rekening)
	{
		$query = $this->db->query("SELECT * FROM rekening WHERE id_rekening = '$id_rekening'");
		return $query->row();
	}
}