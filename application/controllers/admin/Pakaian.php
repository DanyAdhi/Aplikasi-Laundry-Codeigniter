<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');


class Pakaian extends CI_Controller {

	var $table 		= 'clothes';
	var $folder		= 'pakaian/';
	var $section 	= 'Pakaian';

	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') != TRUE) { redirect(base_url('')); };
		$this->load->model(['Model']);
		$this->load->library(['form_validation', 'encryption']);
	}

	public function index() {	
		$this->db->order_by('id', 'DESC');
		$data = [
					'content' => $this->folder.('view'),
					'section'	=> $this->section,
					'clothes'	=> $this->Model->get_all($this->table)->result()
				];
		$this->load->view('template/template', $data);
	}

	public function add() {
		$post 	= $this->input->post();
		$this->form_validation->set_rules('name', 'Jenis Pakaian', 'required|rtrim');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Jenis Pakaian</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
		}


		$get_clothes 	= count($this->Model->get_by($this->table, 'name', $post['name'])->result());
		if ($get_clothes != 0) {
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Jenis Pakaian</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
		}

		$data = [
			'id'		=> null,
			'name'	=> $post['name']
		];
		$this->Model->save($this->table, $data);
		$this->session->set_flashdata('flash','<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' );
		redirect('admin/pakaian');
	}


	public function edit() {
		$post 		= $this->input->post();
		$id				= $post['id'];
		$name 		= $post['name'];
		
		
		$this->form_validation->set_rules('name', 'Jenis Pakaian', "required|rtrim");

		if ($this->form_validation->run() == False) {
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Jenis Pakaian</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
		}

		$get_clothes = count($this->Model->get_by($this->table, 'name', $name)->result());
		if ($get_clothes != 0) {
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Jenis Pakaian</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
		}

		$data = ['name'=>$name];
		$this->Model->update($this->table, 'id', $id, $data);
		$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/pakaian');
	}


	public function delete($id = null) {
		if(!isset($id)) show_404();

		$id = str_replace(['-','_','~'],['=','+','/'],$id);
		$id = $this->encryption->decrypt($id);
		$this->Model->delete($this->table, 'id' , $id);
		$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/pakaian');
	}


}
?>