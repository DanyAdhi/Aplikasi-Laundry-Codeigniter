<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller{

		function __construct(){
			parent::__construct();
			if($this->session->userdata('masuk') !=TRUE){
	            redirect(base_url('')); 
	        };
		}

		var $section = 'Dashboard';
		public function index()
		{
			$data = ['content'=>'admin/dashboard',
					 'section'=>$this->section];
			$this->load->view('template/template', $data);
		}

	}
 ?>