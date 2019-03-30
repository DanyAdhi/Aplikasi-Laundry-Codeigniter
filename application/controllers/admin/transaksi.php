<?php 
defined('BASEPATH') OR exit ('No direct scrip access allowed');

	class Transaksi extends CI_Controller{
		
		var $folder 	= 'transaksi/';
		var $section 	= 'Transaksi';
		var $table		= 'transaksi';


		function __construct(){
		parent::__construct();
		$this->load->model(['model','validation']);
		$this->load->library(['form_validation', 'encrypt']);
		}

		public function index()
		{
			$this->db->order_by('nama_pakaian', 'ASC');
			$data = ['content'	=> $this->folder.('view'),
					 'section'	=> $this->section,
					 'tampil'	=> $this->model->get_all('pakaian')->result(),
					 'tarif'	=> $this->model->get_all('tarif')->result()
					 ];

			$this->load->view('template/template', $data);
		}








	}
?>