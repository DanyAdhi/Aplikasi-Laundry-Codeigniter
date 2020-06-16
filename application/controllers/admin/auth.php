<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	var $table 		= 'user';
	var $section 	= 'Login';

	function __construct()
	{
		parent::__construct();
		$this->load->model('model');
		$this->load->model('validation', 'val');
		$this->load->library('form_validation');
	}


	public function login()
	{

		$post 	= $this->input->post();
		$user 	= $post['username'];
		$pass	= $post['password'];
		$cek 	= $this->model->get_by($this->table, 'username' ,$user)->row_array();
		$validasi = $this->form_validation->set_rules($this->val->val_login());
		
		if($validasi->run()==false)
		{
			$data = ['content' 	=> 'admin/login',
					 'section'	=> $this->section,
					];
			$this->load->view('template/login', $data);
		}else{
			if($cek){
				if(password_verify($pass, $cek['password'])){
					$data = [
							'masuk'		=>true,
							'username'	=>$cek['username'],
							'nama'		=>$cek['nama'],
							'level'		=>$cek['level']
							];
					$this->session->set_userdata($data);
					redirect('admin/dashboard');
				}else{
					$data = ['content' 	=> 'admin/login',
							 'section'	=> $this->section,
							];
					$this->session->set_flashdata('flash','<div class="alert alert-danger" role="alert">Password yang anda masukkan salah! </div>' );
					$this->load->view('template/login', $data);
				}
			}else{
				$data = ['content' 	=> 'admin/login',
						 'section'	=> $this->section,
						];
				$this->session->set_flashdata('flash','<div class="alert alert-danger" role="alert">Username tidak ada! </div>' );
				$this->load->view('template/login', $data);
			}
		};
	}

	public function logout()
	{
		session_destroy();
		redirect('admin/login');
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/admin/auth.php */