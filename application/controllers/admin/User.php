<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

	class User extends CI_Controller{

		var $table		= 'users';
		var $section	= 'User';
		var $folder		= 'user/';

		function __construct() {
			parent::__construct();
			if($this->session->userdata('masuk') != TRUE) { redirect(base_url('')); };
			if($this->session->userdata('scope') != 'admin') { redirect(base_url('admin/dashboard')); };

			$this->load->model(['Model','Validation']);
			$this->load->library(['form_validation','encryption']);
		}

		public function index() {
			$this->db->order_by('id', 'DESC');
			$data = [
				'content'	=> $this->folder.('view'),
				'section'	=> $this->section,
				'users'	=> $this->Model->get_all($this->table)->result()
			];
			$this->load->view('template/template', $data);
		}

		public function add() {
			$data = [
				'content'	=> $this->folder.('post'),
				'section'	=> $this->section
			];
			$this->load->view('template/template', $data);
		}

		public function save() {

			$validasi 	= $this->form_validation->set_rules($this->Validation->val_user());
			if ($validasi->run() == false) {
				$data = [
					'content'	=> $this->folder.('post'),
					'section'	=> $this->section,
				];
				$this->load->view('template/template', $data);
			} else {
				$post		= $this->input->post();
				$data = [
					'id' 				=> null,
					'name'			=> $post['name'],
					'username'	=> $post['username'],
					'password'	=> password_hash($post['password'], PASSWORD_DEFAULT),
					'scope'			=> $post['scope']
				];
				$this->Model->save($this->table, $data);
				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/user/add');
			}
		}


		public function reset($id=null) {
			if(!isset($id)) show_404();

			$id	=	str_replace(['-','_','~',],['=','+','/'], $id);
			$id	=	$this->encryption->decrypt($id);

			$data = [
				'password' => password_hash('password', PASSWORD_DEFAULT)
			];

			$this->Model->update($this->table, 'id', $id, $data);
			$this->session->set_flashdata('flash','<div class="alert alert-success alert-dismissible fade show" role="alert"><b>Password</b> berhasil di reset.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/user');
		}

		public function delete($id=null) {
			if(!isset($id)) show_404();

			$id	=	str_replace(['-','_','~'],['=','+','/'],$id);
			$id	=	$this->encryption->decrypt($id);

			$this->Model->delete($this->table,'id',$id);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/user');
		}

	}

?>