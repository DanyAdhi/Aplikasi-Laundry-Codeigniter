<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller{

		var $section = 'Dashboard';
		public function index()
		{
			$data = ['content'=>'admin/dashboard',
					 'section'=>$this->section];
			$this->load->view('template/template', $data);
		}

	}
 ?>