<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

	class Status extends CI_Controller{

		var $folder 	= 'proses/';
		var $section 	= 'Proses';
		var $table		= 'transaction_status';

		function __construct(){
			parent::__construct();
			if($this->session->userdata('masuk') != TRUE) { redirect(base_url('')); };
			$this->load->model(['Model']);
			$this->load->library(['encryption']);
		}

		public function proses() {
			$data = [
				'content'	=> $this->folder.('proses'),
				'section'	=> 'Proses Laundry',
				'tampil'	=> $this->Model->proses()
			];

			$this->load->view('template/template', $data);
		}

		public function detail($id=null) {
			if(!isset($id)) show_404();

			$id = str_replace(['-','_','~'],['=','+','/'],$id);
			$id = $this->encryption->decrypt($id);
			
			$get_data = $this->Model->get_by('transactions', 'id', $id)->row_array();
			
			if ($get_data) {
				//assign detail on get_data variable
				$getDetail = $this->Model->get_by('transaction_detail', 'transaction_id', $id)->result();

				$get_data['detail'] = $getDetail;

				$data = [
					"data" 		=> $get_data,
					"success"	=> true,
					"message"	=> "Data detail transaksi"
				];
			} else {
				$data = [
					"data" 		=> "",
					"success"	=> false,
					"message"	=> "Data detail transaksi"
				];
			}

			echo json_encode($data);
		}

		public function selesai() {
			$data = [
				'content'	=> $this->folder.('selesai'),
				'section'	=> 'Transaksi Selesai',
				'tampil'	=> $this->Model->get_by('transactions', 'status', 1)->result()
			];

			$this->load->view('template/template', $data);
		}

		public function update($id = null, $type = null) {	
			if(!isset($id) || !isset($type)) show_404();

			// get data transaction status
			$get_data = $this->Model->get_by($this->table, 'id', $id)->result_array();

			//check if type true
			$check_type = array_key_exists($type, $get_data[0]);
			if ($check_type == false) show_404();

			$validation_type = $this->validation_type($type, $get_data[0]);
			if ($validation_type == true) {
				$this->Model->update('transaction_status', 'id', $id, [ $type => '1' ]);

				if ($type == 'selesai') {
					$selesai = $this->Model->update('transactions', 'id', $get_data[0]['transaction_id'], ['status' 	=> 1]);
				}
			}
			redirect('admin/status/proses');
		}

		private function validation_type($type = null, $data = []) {
			//validation
			if ($type == 'kering' && $data['cuci'] == 0) return false;
			if ($type == 'strika' && $data['kering'] == 0) return false;
			if ($type == 'siap' && $data['strika'] == 0) return false;
			if ($type == 'selesai' && $data['siap'] == 0) return false;
			return true;
		}
	}
 ?>


