<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	var $folder = 'users/';
	var $layout = 'users/layout';

	function __construct(){
		parent::__construct();
		$this->load->model(['Model', 'Validation']);
		$this->load->library(['form_validation']);
	}

	public function index() {
		$data = ['content'=> $this->folder.('home')];
		$this->load->view($this->layout, $data);
	}

	public function listHarga() {
		$data = [
			'content'	=> $this->folder.('tarif'),
			'data'		=> $this->Model->get_all('packages')->result()
		];
		$this->load->view($this->layout, $data);
	}

	public function lacak($id=null) {
		$id = $this->input->get('idOrder');

		if (!$id) {
			$data = [
				'content'	=> $this->folder.('lacak'),
				'tampil' 	=> null,
				'id'			=> ''
			];

		} else {
			$cek = $this->Model->find_transaction_by_idTransaction($id);
			$jum = count($cek);

			if ($jum < 1) {
				$data = [
					'content'	=> $this->folder.('lacak'),
					'tampil'	=> 'noData',
					'id'			=> $id
				];
			} else {
				$data = [
					'content'	=> $this->folder.('lacak'),
					'tampil' 	=> 1,
					'data'		=> $cek,
					'id'			=> $id
				];
			}
		}
		$this->load->view($this->layout, $data);
	}

	public function kontak() {
		$data = ['content'=> $this->folder.('contact')];
		$this->load->view($this->layout, $data);
	}

}

/* End of file UserController.php */
/* Location: ./application/controllers/UserController.php */