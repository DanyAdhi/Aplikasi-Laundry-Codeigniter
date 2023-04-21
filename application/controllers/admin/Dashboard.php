<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller{

		function __construct(){
			parent::__construct();
			if ($this->session->userdata('masuk') != TRUE) { redirect(base_url('')); };
			
			$this->load->model(['Model']);
		}

		var $section = 'Dashboard';
		public function index() {
			//get data daily
			// $count_customer_daily = $this->Model->get_all($this->table)->result();
			//get data monthly
			//get data yearly
			$data = [
				'content'=>'admin/dashboard',
				'section'=>$this->section
			];
			$this->load->view('template/template', $data);
		}

	}
 ?>