<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	var $folder 	= 'laporan/';
	var $section 	= 'Transaksi';
	var $table		= 'transaksi';


	function __construct(){
	parent::__construct();
	$this->load->model(['model','validation']);
	$this->load->library(['form_validation', 'encrypt']);
	}


	public function index()
	{
		$data = [
					'content'	=> $this->folder.'coba',
					'section'	=> $this->section,
					'tampil'	=> $this->model->get_all($this->table)->result()
				];
		$this->load->view('template/template', $data);
	}

}

/* End of file laporan.php */
/* Location: ./application/controllers/admin/laporan.php */