<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Member extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_member');

		if ($this->session->userdata('aktif') != TRUE) {
			redirect('home');
		}

		if ($this->session->userdata('jabatan') != 'Admin') {
			redirect('home');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Member',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-users',
			'member'=> $this->m_member->getdata()->result()
		];
		$this->template->load('template', 'admin/member', $data);
	}

	public function tambah()
	{
		$this->form_validation->set_rules('no_telp' , 'No Telepon' , 'is_unique[member.no_telp]', ['is_unique'=>'No telepon sudah digunakan']);
		$this->form_validation->set_rules('username' , 'Username' , 'is_unique[member.username]|is_unique[admin.username]', ['is_unique'=>'Username sudah digunakan']);

		if($this->form_validation->run()== FALSE) {
			$this->index();
		}else {
			$data = [
				'nama_member' => htmlspecialchars($this->input->post('nama', true)),
				'jns_kel' => htmlspecialchars($this->input->post('jns_kel', true)),
				'tmpt_lahir' => htmlspecialchars($this->input->post('tmpt_lahir', true)),
				'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
				'alamat' => htmlspecialchars($this->input->post('alamat', true)),
				'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'password' => md5($this->input->post('tgl_lahir', PASSWORD_DEFAULT)),
				'status' => 'Pembeli',
			];
			$this->db->insert('member',$data);
			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil ditambahkan</div>');
			redirect('admin/member');
		}
	}

	public function edit($id_member)
	{
		$data = [
			'title' => 'Edit Member',
			'title_icon' => 'fa-folder-open',
			'breadcrumb_icon' => 'fa-users',
			'member' => $this->m_member->getdatamember($id_member)
		];
		$this->template->load('template', 'admin/member_edit', $data);
	}

	public function simpan()
	{
		$data = [
			'nama_member' => htmlspecialchars($this->input->post('nama', true)),
			'jns_kel' => htmlspecialchars($this->input->post('jns_kel', true)),
			'tmpt_lahir' => htmlspecialchars($this->input->post('tmpt_lahir', true)),
			'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
			'alamat' => htmlspecialchars($this->input->post('alamat', true)),
			'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
			'username' => htmlspecialchars($this->input->post('username', true)),
			'password' => md5($this->input->post('tgl_lahir', PASSWORD_DEFAULT)),
		];

		$this->db->where('id_member', $this->input->post('id_member'));
		$this->db->update('member',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil diubah.</div>');
		redirect('admin/member');
	}

	public function hapus($id_member)
	{
		$this->db->where('id_member', $id_member);
		$this->db->delete('member');
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Data berhasil dihapus.</div>');
		redirect('admin/member');
	}
}