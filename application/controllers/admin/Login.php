<?php 
	defined('BASEPATH') OR exit ('No direct script access allowed');

	class Login extends CI_Controller{

		var $section 	= 'Login';

		function __construct() {
			parent::__construct();
			if ($this->session->userdata('masuk') == TRUE) { redirect(base_url('admin/dashboard')); };
			$this->load->library('form_validation');
		}

		public function index() {
			$data = [
				'content' 	=> 'admin/login',
				'section'	=> $this->section,
			];
			$this->load->view('template/login', $data);
		}
	}

 ?>