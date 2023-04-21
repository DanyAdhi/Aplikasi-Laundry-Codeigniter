<?php  
defined('BASEPATH') OR exit ('No direct script access allowed');

class Tarif extends CI_Controller{

	var $table 		= 'packages';
	var $folder 	= 'tarif/';
	var $section 	= 'Tarif Dan Paket';
	private $nama;
	private $waktu;
	private $biaya;
	private $jenis;


	function __construct() {
		parent::__construct();
		if($this->session->userdata('masuk') != TRUE) { redirect(base_url('')); };
		if($this->session->userdata('scope') != 'admin') { redirect(base_url('admin/dashboard')); };
		$this->load->model(['Model','Validation']);
		$this->load->library(['form_validation', 'encryption']);
	}

	public function index() {
		$this->db->order_by('id', 'DESC');

		$data = [
			'content'	=> $this->folder.('view'),
			'section'	=> $this->section,
			'prices'	=> $this->Model->get_all($this->table)->result()
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
		$post				= $this->input->post();
		$validasi 	= $this->form_validation->set_rules($this->Validation->val_prices());

		if ($validasi->run() == True) {
			$data = [
						'id'			=> null,
						'name'		=> $post['name'],
						'time'		=> $post['time'],
						'amount'	=> $post['amount'],
						'type'		=> $post['type']
					];
			$this->Model->save($this->table, $data);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/tarif/add');
		
		} else {
			$data = [
				'content'	=> $this->folder.('post'),
				'section'	=> $this->section
			];
			$this->load->view('template/template', $data);
		}
	}

	public function edit($id=null) {
		if (!isset($id)) show_404();
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);

		$data = [
					'content'	=> $this->folder.('edit'),
				 	'section'	=> $this->section,
				 	'price'	=> $this->Model->get_by($this->table, 'id', $id)->result()
				];

		$this->load->view('template/template', $data);
	}

	public function update() {
		$post = $this->input->post();

		$id = $post['id'];
		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);

		//cek data by id
		$get_data 	= $this->Model->get_by($this->table, 'id', $id)->result_array();
		if (count($get_data) === 0) {
			show_404();
		}

		// $check_duplicate = count($this->Model->get_by($this->table, 'name', $post['name'])->result_array());


		$is_unique_name = '';
		if ($post['name'] != $get_data[0]['name']) {
			$is_unique_name = '|is_unique[prices.name]';
		}

		$this->form_validation->set_rules('name', 'Nama', 'required|rtrim'.$is_unique_name, ['required' => 'Form <b>%s</b> tidak boleh kosong']);
		$this->form_validation->set_rules('time', 'Waktu', 'required|rtrim', ['required' =>'Form <b>%s</b> tidak boleh kosong.']);
		$this->form_validation->set_rules('amount', 'Biaya', 'required|rtrim|is_natural_no_zero', ['required' =>'Form <b>%s</b> tidak boleh kosong.']);

		if ($this->form_validation->run() === false) {
			$data = [
				'content'	=> $this->folder.('edit'),
				'section'	=> $this->section,
				'price'	=> $this->Model->get_by($this->table, 'id', $id)->result()
			];
			$this->load->view('template/template', $data);

		} else {
			$data = [
				'name'		=> $post['name'],
				'time'		=> $post['time'],
				'amount'	=> $post['amount'],
				'type'		=> $post['type']
			];
			$this->Model->update($this->table, 'id', $id, $data);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di Ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/tarif');
		}

	}

	public function delete($id=null) {
		if(!isset($id)) show_404();

		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);
		$this->Model->delete($this->table, 'id' , $id);
		$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data telah di hapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/tarif');
	}


}
?>