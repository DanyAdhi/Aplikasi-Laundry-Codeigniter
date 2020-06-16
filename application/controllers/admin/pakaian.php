<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');


class Pakaian extends CI_Controller {

	var $table 		= 'pakaian';
	var $folder		= 'pakaian/';
	var $section 	= 'Pakaian';

	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect(base_url('')); 
        };
		$this->load->model(['model']);
		$this->load->library(['form_validation', 'encryption']);

	}

	public function index()
	{	
		$this->db->order_by('nama_pakaian', 'ASC');
		$data = [
					'content' 	=> $this->folder.('view'),
					'section'	=> $this->section,
					'tampil'	=> $this->model->get_all($this->table)->result()
				];
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama', 'Jenis Pakaian', 'required|rtrim');
		$post 	= $this->input->post();
		$cek 	= count($this->model->get_by($this->table, 'nama_pakaian', $post['nama'])->result());
		if ($this->form_validation->run()==true) {
			if($cek<1){
				$data = [
							'id_pakaian'	=>null,
							'nama_pakaian'	=>$post['nama']
						];
				$this->model->save($this->table, $data);
				$this->session->set_flashdata('flash','<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' );
				redirect('admin/pakaian');
			}else{
				$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Jenis Pakaian</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/pakaian');
			}
		}else{
		}
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Jenis Pakaian</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
	}


	public function edit()
	{
		$this->form_validation->set_rules('namapakaian', 'Jenis Pakaian', "required|rtrim|");
		$post 		= $this->input->post();
		$oldNama	= $post['oldNama'];
		$nama 		= $post['nama'];
		$cek = count($this->model->get_by($this->table, 'nama_pakaian', $nama)->result());

		if($this->form_validation->run()==False){
			if($cek<1){
				$data = ['nama_pakaian'=>$nama];
				$this->model->update($this->table, 'nama_pakaian', $oldNama, $data);
				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/pakaian');
			}else{
				$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Jenis Pakaian</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/pakaian');
			}
		}else{
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Jenis Pakaian</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
		}
	}




}
?>