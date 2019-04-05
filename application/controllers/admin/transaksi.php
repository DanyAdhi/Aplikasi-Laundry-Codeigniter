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
			$data = [
						'content'	=> $this->folder.('paket'),
						'section'	=> $this->section,
					];

			$this->load->view('template/template', $data);
		}

		public function kiloan()
		{
			$this->db->order_by('nama_pakaian', 'ASC');
			$data = ['content'	=> $this->folder.('kiloan'),
					 'section'	=> $this->section,
					 'tampil'	=> $this->model->get_all('pakaian')->result(),
					 'tarif'	=> $this->model->get_by('tarif', 'jenis_tarif', 'Kg')->result()
					 ];

			$this->load->view('template/template', $data);
		}


		public function add_cart()
		{
			$id 	= $this->input->post('id');
			$p 		= $this->model->get_by('pakaian', 'id_pakaian', $id)->row_array();
			$i 		=$p;

			$data = [
						'id'	=> $p['id_pakaian'],
						'name'	=> $p['nama_pakaian'],
						'price'	=> 0,
						'qty'	=> $this->input->post('jumlah')
					];

			if($this->cart->total_items()>0)
			{
				$id 		= $items['id'];
				$idPakaian 	= $this->input->post('id');
				if($id==$idPakaian)
				{
					$up=['rowid'=>$rowid];
					$this->cart->update($up);
				}
				else
				{
					$this->cart->insert($data);
				}
			}
			else
			{
				$this->cart->insert($data);
			}
		redirect('admin/transaksi/kiloan');
		}


	public function remove_kiloan()
	{
			$row_id=$this->uri->segment(4);
			$this->cart->update(array(
	               'rowid'      => $row_id,
	               'qty'     	=> 0
	            ));
			redirect('admin/transaksi/kiloan');
		
	}

	public function save_kiloan()
	{

		$this->form_validation->set_rules($this->validation->val_transaksi());

		if($this->form_validation->run()==true){

			// Save ke table transaksi
			date_default_timezone_set('Asia/Jakarta');
			$row 	= count($this->model->get_all($this->table)->result());
			$id 	= date('dmyHis').'0'.($row+1);
			$paket 	= $this->input->post('paket');
			$berat 	= $this->input->post('berat');
			$bayar 	= $this->input->post('total');

			$data = [
						'id_transaksi' 		=> $id,
						'tgl_transaksi'		=> date('d-m-Y'),
						'jam_transaksi'		=> date('H-i-s'),
						'paket_transaksi'	=> 'namapaket(harga)',
						'jenis_paket'		=> 'Kg',
						'berat_jumlah'		=> $berat,
						'total_transaksi'	=> $bayar
					];
			$this->model->save($this->table, $data);


			// save ke table detail transaksi
			foreach ($this->cart->contents() as $item) {
			$data =	[
						'id_detail' 			=>	null,
						'id_transaksi_d'		=>	$id,
						'nama_d'				=>	$item['name'],
						'jumlah_d'				=>	$item['qty'],
					];


			$this->model->save('transaksi_detail', $data);
			$this->cart->destroy();

			}







			redirect('admin/transaksi/berhasil');




		}else{
			$this->db->order_by('nama_pakaian', 'ASC');
			$data = ['content'	=> $this->folder.('kiloan'),
					 'section'	=> $this->section,
					 'tampil'	=> $this->model->get_all('pakaian')->result(),
					 'tarif'	=> $this->model->get_by('tarif', 'jenis_tarif', 'Kg')->result()
					 ];

			$this->load->view('template/template', $data);
		}

		
	}


	public function berhasil()
	{
		echo 'Berhasil';
	}

}
?>