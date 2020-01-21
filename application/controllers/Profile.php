<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_profile');

		if ($this->session->userdata('aktif') != TRUE) {
			redirect('home');
		}

		if ($this->session->userdata('jabatan') != 'Member') {
			redirect('admin/dashboard');
		}
	}

	public function index()
	{

		$data = [
			'title' => 'Profile',
			'small' => 'Welcome',
			'profile' => $this->db->get_where('member', 'id_member = '. $this->session->userdata('id'))->row(),
			'toko' => $this->db->get_where('toko', 'id_member = '. $this->session->userdata('id'))->row(),
			'keranjang' => $this->m_profile->getkeranjang($this->session->userdata('id'))->result(),
			'jumlah' => $this->m_profile->getkeranjang($this->session->userdata('id'))->num_rows()
		];

		$this->template->load('frontend/template','frontend/profile', $data);
	}

	public function update()
	{

		$data = [
			'nama_member' => htmlspecialchars($this->input->post('nama', true)),
			'jns_kel' => htmlspecialchars($this->input->post('jns_kel', true)),
			'tmpt_lahir' => htmlspecialchars($this->input->post('tmpt_lahir', true)),
			'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
			'alamat' => htmlspecialchars($this->input->post('alamat', true)),
			'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
		];
		$this->db->where('id_member', $this->session->userdata('id'));
		$this->db->update('member',$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemeritahuan!</h4>Data berhasil diubah</div>');
		redirect('profile');
	}

	public function pass()
	{
		$passlama = md5($this->input->post('passlama'));
		if ($passlama != $this->input->post('passasli')) {
			$this->session->sess_destroy();
			redirect('home');
		}else{

			$this->form_validation->set_rules('passbaru', 'Password', 'trim|min_length[6]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[passbaru]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message1', "<script>
					$('#pass').modal('show');
					</script>");
				$this->index();
			}
			else{

				$data = ['password' => md5($this->input->post('passbaru', PASSWORD_DEFAULT))];
				$this->db->where('id_member', $this->session->userdata('id'));
				$this->db->update('member',$data);
				$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemeritahuan!</h4>Data berhasil tersimpan</div>');
				redirect('profile');
			}
		}
	}

}