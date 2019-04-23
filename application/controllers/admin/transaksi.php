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


		public function add_cart_kiloan()
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
			$nama 	= $this->input->post('nama');
			$paket 	= $this->input->post('paket');
			$berat 	= $this->input->post('berat');
			$bayar 	= $this->input->post('total');

			$data = [
						'id_transaksi' 		=> $id,
						'nama'				=> $nama,
						'tgl_transaksi'		=> date('d-m-Y'),
						'jam_transaksi'		=> date('H-i-s'),
						'paket_transaksi'	=> $paket.')',
						'jenis_paket'		=> 'Kg',
						'berat_jumlah'		=> $berat,
						'total_transaksi'	=> $bayar,
						'status'			=> 0
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

			// Save ke table status laundry
			$data = [
						'id_status'			=> null,
						'id_transaksi_s'	=> $id,
						'cuci'				=> 1,
						'kering'			=> 0,
						'strika'			=> 0,
						'siap'				=> 0,
						'selesai'			=> 0,
						'tgl_ambil'			=> 0,
					];
			$this->model->save('transaksi_status', $data);

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

	public function satuan()
	{
		$this->db->order_by('nama_tarif', 'ASC');
		$data = ['content'	=> $this->folder.('satuan'),
				 'section'	=> $this->section,
				 'tampil'	=> $this->model->get_by('tarif', 'jenis_tarif', 'Satuan')->result()
				 ];

		$this->load->view('template/template', $data);
	}

	public function add_cart_satuan()
		{
			$id 	= $this->input->post('id');
			$p 		= $this->model->get_by('tarif', 'id_tarif', $id)->row_array();
			$i 		=$p;

			$data = [
						'id'	=> $p['id_tarif'],
						'name'	=> $p['nama_tarif'],
						'price'	=> $p['biaya_tarif'],
						'qty'	=> $this->input->post('jumlah')
					];

			if($this->cart->total_items()>0)
			{
				$id 		= $items['id'];
				$idBarang 	= $this->input->post('id');
				if($id==$idBarang)
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
		redirect('admin/transaksi/satuan');
		}



	public function save_satuan()
	{

			// Save ke table transaksi
			date_default_timezone_set('Asia/Jakarta');
			$bayar 	= $this->cart->total();

			foreach ($this->cart->contents() as $item) 
			{
				$row 	= count($this->model->get_all($this->table)->result());
				$id 	= date('dmyHis').'0'.($row+1);
				$data = [
							'id_transaksi' 		=> $id,
							'tgl_transaksi'		=> date('d-m-Y'),
							'jam_transaksi'		=> date('H-i-s'),
							'paket_transaksi'	=> $item['name'].' ('.$item['price'].')',
							'jenis_paket'		=> 'Pcs',
							'berat_jumlah'		=> $item['qty'],
							'total_transaksi'	=> $item['subtotal']
						];
				$this->model->save($this->table, $data);

				// save ke table detail transaksi
				$dati =	[
							'id_detail' 			=>	null,
							'id_transaksi_d'		=>	$id,
							'nama_d'				=>	$item['name'],
							'jumlah_d'				=>	$item['qty'],
						];
				$this->model->save('transaksi_detail', $dati);
			}
		
		$this->cart->destroy();
		redirect('admin/transaksi/berhasil');
	}



	public function berhasil()
	{
		echo 'Berhasil';
	}



	

}
?>