<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

	class User extends CI_Controller{

		var $table		= 'user';
		var $section	= 'User';
		var $folder		= 'user/';

		function __construct(){
			parent::__construct();
			if($this->session->userdata('masuk') !=TRUE){
	            redirect(base_url('')); 
	        };
			$this->load->model(['model','validation']);
			$this->load->library(['form_validation','encryption']);
		}

		public function index()
		{
			$data = ['content'	=> $this->folder.('view'),
					 'section'	=> $this->section,
					 'tampil'	=> $this->model->get_all($this->table)->result()];
			$this->load->view('template/template', $data);
		}

		public function add()
		{
			$data = ['content'	=> $this->folder.('post'),
					 'section'	=> $this->section,
					 ];
			$this->load->view('template/template', $data);
		}

		public function save()
		{
			$post		= $this->input->post();
			$validasi 	= $this->form_validation->set_rules($this->validation->val_user());
			if($validasi->run()==false)
			{
				$data = ['content'	=> $this->folder.('post'),
						 'section'	=> $this->section,
						 ];
				$this->load->view('template/template', $data);
			}else{
				$data = [
							'id' 		=> null,
							'nama'		=> $post['nama'],
							'username'	=> $post['username'],
							'password'	=> password_hash($post['password1'], PASSWORD_DEFAULT),
							'level'		=> $post['level']
						];
				$this->model->save($this->table, $data);
				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/user/add');
			}
		}


		public function reset($id=null)
		{
			if(!isset($id)) show_404();
			$id=str_replace(['-','_','~',],['=','+','/'], $id);
			$id=$this->encryption->decrypt($id);

			$this->model->reset_pass($this->table, 'id', $id, 'password');
			$this->session->set_flashdata('flash','<div class="alert alert-success alert-dismissible fade show" role="alert"><b>Password</b> berhasil di reset.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/user');

		}

		public function delete($id=null)
		{
			if(!isset($id)) show_404();
			$id=str_replace(['-','_','~'],['=','+','/'],$id);
			$id=$this->encryption->decrypt($id);

			$this->model->delete($this->table,'id',$id);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/user');
		}

	}
?>