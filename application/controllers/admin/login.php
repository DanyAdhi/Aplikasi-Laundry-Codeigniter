<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

	class Login extends CI_Controller{

		var $table 		= 'user';
		var $section 	= 'Login';


		function __construct()
		{
			parent::__construct();
			$this->load->model('model');
			$this->load->model('validation', 'val');
			$this->load->library('form_validation');
		}

		public function index()
		{
			$data = ['content' 	=> 'admin/login',
					 'section'	=> $this->section,
					];
			$this->load->view('template/login', $data);
		}
	
		public function auth()
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


	}
 ?>