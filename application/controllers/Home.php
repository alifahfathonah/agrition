<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
	}

	public function index()
	{	

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] ='<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] ='<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['num_tag_open'] ='<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] ='<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] ='<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] ='<li class="page-item active"><a>';
		$config['cur_tag_close'] = '</a></li>';

		$config['attributes'] = array('class' => '');


		$jumlah_data = $this->m_home->count();
		$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
		$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME'])."/home/index/";
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 12;
		$start = $this->uri->segment(3);
		$this->pagination->initialize($config);

		$data = [
			'title' => 'Home',
			'small' => 'Welcome',
			'barang' => $this->m_home->getbarang($config['per_page'],$start)
		];

		$this->template->load('frontend/template','frontend/home', $data);
	}

	public function reg()
	{
		
		$this->form_validation->set_rules('no_telp' , 'No Telepon' , 'is_unique[member.no_telp]', ['is_unique'=>'No telepon sudah digunakan']);
		$this->form_validation->set_rules('email' , 'Email' , 'is_unique[member.email]', ['is_unique'=>'Email sudah digunakan']);
		$this->form_validation->set_rules('username' , 'Username' , 'is_unique[member.username]|is_unique[admin.username]', ['is_unique'=>'Username sudah digunakan']);
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]',['min_length'=>'Password kurang dari 6 karakter']);
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]',['matches' => 'Password tidak sama']);

		if($this->form_validation->run()== FALSE) {
			$this->session->set_flashdata('message1', "<script>
				$('#regis').modal('show');
				</script>");
			$this->index();
		}else {
			$email = htmlspecialchars($this->input->post('email', true));

			$data = [
				'nama_member' => htmlspecialchars($this->input->post('nama', true)),
				'jns_kel' => htmlspecialchars($this->input->post('jns_kel', true)),
				'tmpt_lahir' => htmlspecialchars($this->input->post('tmpt_lahir', true)),
				'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
				'alamat' => htmlspecialchars($this->input->post('alamat', true)),
				'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'password' => md5($this->input->post('password', PASSWORD_DEFAULT)),
				'status' => 'Pembeli',
				'email' => $email,
				'is_active' => '0'
			];
			$this->db->insert('member',$data);
			$id = $this->db->insert_id();

			$enkripsi = encrypt_url($id);

			$config['charset'] = 'utf-8';
			$config['useragent'] = 'Codeigniter';
			$config['protocol']= "smtp";
			$config['mailtype']= "html";
    		$config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
    		$config['smtp_port']= "465";
    		$config['smtp_timeout']= "400";
    		$config['smtp_user']= "agrobosnissolution@gmail.com"; // isi dengan email kamu
    		$config['smtp_pass']= "agrition001"; // isi dengan password kamu
    		$config['crlf']="\r\n"; 
    		$config['newline']="\r\n"; 
    		$config['wordwrap'] = TRUE;

    		$this->email->initialize($config);
    		$this->email->from($config['smtp_user']);
    		$this->email->to($email);
    		$this->email->subject("Verifikasi Akun Agrition");
    		$this->email->message("Terima kasih telah melakukan registrasi di Agrition, silahkan verifikasi email anda agar dapat melakukan transaksi, <a href='".site_url('home/verifikasi/'.$enkripsi)."'>Klik Disini</a>");

    		if ($this->email->send()) {
    			$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Registrasi berhasil dan email verifikasi telah terkirim (Cek spam bila tidak ada di inbox), silahkan login untuk melanjutkan.</div>');
    			redirect('home');
    		}else{
    			$this->session->set_flashdata('message', '<div class="alert alert-warning fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Registrasi berhasil tetapi email verifikasi gagal terkirim, silahkan login untuk melanjutkan.</div>');
    			redirect('home');
    		}
    	}
    }

    public function verifikasi($key)
    {
    	$id = decrypt_url($key);

    	$run = $this->m_home->verifikasi($id);

    	if ($run == TRUE) {
    		$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Verifikasi email berhasil, silahkan login untuk melanjutkan.</div>');
    		redirect('home');
    	}else{
    		$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Pemberitahuan!</h4>Verifikasi email gagal, silahkan coba lagi.</div>');
    		redirect('home');
    	}
    }

    public function addcart($id_barang)
    {
    	if ($this->session->userdata('aktif') != true) {
    		$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Warning!</h4>Silahkan login untuk melanjutkan</div>');
    		redirect('home');
    	}else{
    		$id = $this->session->userdata('id');
    		if ($this->db->get_where('member', "id_member= '$id'")->row('is_active') == 0) {
    			$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Warning!</h4>Silahkan Verifikasi Email Anda.</div>');
    				redirect('home');
    		}else{
    			$cektoko = $this->m_home->cekbarang($id_barang, $this->session->userdata('id_toko'))->row();
    			if ($cektoko != null) {
    				$this->session->set_flashdata('message', '<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Warning!</h4>Anda tidak bisa membeli barang anda sendiri.</div>');
    				redirect('home');
    			}else{
    				$cekkeranjang = $this->m_home->cekkeranjang($id_barang,$this->session->userdata('id'))->row();
    				if ($this->input->post('jumlah') != null) {
    					$jumlah = $this->input->post('jumlah');
    				}else{
    					$jumlah = 1;
    				}

    				if ($cekkeranjang == null) {
    					$barang = $this->m_home->getdata($id_barang);

    					$data = [
    						'id_barang' => $id_barang,
    						'id_member' => $this->session->userdata('id'),
    						'id_toko' => $barang->id_toko,
    						'tanggal' => date(DATE_ATOM),
    						'jmlh_barang' => $jumlah,
    					];
    					$this->db->insert('keranjang',$data);
    					$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Berhasil menambahkan ke keranjang.</div>');
    					redirect('');
    				}else{
    					$data = [
    						'jmlh_barang' => $cekkeranjang->jmlh_barang+$jumlah
    					];
    					$this->db->where('id_barang', $id_barang);
    					$this->db->where('id_member', $this->session->userdata('id'));
    					$this->db->update('keranjang',$data);
    					$this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Berhasil menambahkan ke keranjang.</div>');
    					redirect('');
    				}
    			}
    		}
    	}
    }

    public function detail($id_barang)
    {
    	$data = [
    		'title' => 'Barang',
    		'small' => 'Detail',
    		'barang' => $this->m_home->getdata($id_barang),
    	];

    	$this->template->load('frontend/template','frontend/detail', $data);
    }

    public function toko($id_toko=null)
    {
    	$config['full_tag_open'] = '<ul class="pagination">';
    	$config['full_tag_close'] = '</ul>';

    	$config['first_link'] = 'First';
    	$config['first_tag_open'] ='<li class="page-item">';
    	$config['first_tag_close'] = '</li>';

    	$config['last_link'] = 'Last';
    	$config['last_tag_open'] ='<li class="page-item">';
    	$config['last_tag_close'] = '</li>';

    	$config['num_tag_open'] ='<li class="page-item">';
    	$config['num_tag_close'] = '</li>';

    	$config['next_link'] = '&raquo';
    	$config['next_tag_open'] ='<li class="page-item">';
    	$config['next_tag_close'] = '</li>';

    	$config['prev_link'] = '&laquo';
    	$config['prev_tag_open'] ='<li class="page-item">';
    	$config['prev_tag_close'] = '</li>';

    	$config['cur_tag_open'] ='<li class="page-item active"><a>';
    	$config['cur_tag_close'] = '</a></li>';

    	$config['attributes'] = array('class' => '');


    	$jumlah_data = $this->m_home->getbarangtoko($id_toko)->num_rows();
    	$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    	$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
    	$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME'])."/home/toko/".$id_toko;
    	$config['total_rows'] = $jumlah_data;
    	$config['per_page'] = 6;
    	$start = $this->uri->segment(4);
    	$this->pagination->initialize($config);

    	$data = [
    		'title' => 'Toko',
    		'small' => 'Detail',
    		'toko' => $this->m_home->gettoko($id_toko)->row(),
    		'barang' => $this->m_home->getbarangtoko2($config['per_page'],$start,$id_toko),
    	];

    	$this->template->load('frontend/template','frontend/toko', $data);
    }

    public function sendemail()
    {
        $id = $this->session->userdata('id');
        if ($this->db->get_where('member', "id_member= '$id'")->row('is_active') == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Email Anda Telah Terverifikasi</div>');
                redirect('home');
        }else{
        $enkripsi = encrypt_url($id);
        $email = $this->db->get_where('member', "id_member= '$id'")->row('email');

        $config['charset'] = 'utf-8';
        $config['useragent'] = 'Codeigniter';
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "400";
        $config['smtp_user']= "agrobosnissolution@gmail.com"; // isi dengan email kamu
        $config['smtp_pass']= "agrition001"; // isi dengan password kamu
        $config['crlf']="\r\n"; 
        $config['newline']="\r\n"; 
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject("Verifikasi Akun Agrition");
        $this->email->message("Terima kasih telah melakukan registrasi di Agrition, silahkan verifikasi email anda agar dapat melakukan transaksi, <a href='".site_url('home/verifikasi/'.$enkripsi)."'>Klik Disini</a>");

        if ($this->email->send()) {
            $this->session->set_flashdata('message', '<div class="alert alert-success fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Registrasi berhasil dan email verifikasi telah terkirim (Cek spam bila tidak ada di inbox).</div>');
                redirect('home');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-warning fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Pemberitahuan!</h4>Email gagal terkirim, silahkan coba lagi.</div>');
            redirect('home');
        }
        }
    }
}