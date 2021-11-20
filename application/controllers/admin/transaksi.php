<?php 
defined('BASEPATH') OR exit ('No direct scrip access allowed');

	class Transaksi extends CI_Controller{
		
		var $folder 	= 'transaksi/';
		var $section 	= 'Transaksi';
		var $table		= 'transaksi';


		function __construct(){
			parent::__construct();
			if($this->session->userdata('masuk') !=TRUE){ redirect(base_url('')); };
			$this->load->model(['model','validation']);
			$this->load->library(['form_validation', 'encryption', 'pdf']);
		}

		public function index(){
			$this->db->order_by('id_transaksi', 'DESC');
			$data = [
				'content'	=> $this->folder.('view'),
				'section'	=> $this->section,
				'tampil'	=> $this->model->get_all($this->table)->result()
			];

			$this->load->view('template/template', $data);
		}

		public function detail($id=null){
			$id = str_replace(['-','_','~'],['=','+','/'],$id);
			$id = $this->encryption->decrypt($id);
			$getOne = $this->model->get_by($this->table, 'id_transaksi', $id)->row_array();

			if($getOne){
				$getDetail = $this->model->get_by('transaksi_detail', 'id_transaksi_d', $id)->result();
				$getOne['detail']= $getDetail;
				$data = [
					"data" 		=> $getOne,
					"success"	=> true,
					"message"	=> "Data detail transaksi"
				];
			}else{
				$data = [
					"data" 		=> "",
					"success"	=> false,
					"message"	=> "Data detail transaksi"
				];
			}

			echo json_encode($data);
		}

		public function paket(){
			$data = [
				'content'	=> $this->folder.('paket'),
				'section'	=> $this->section,
			];

			$this->load->view('template/template', $data);
		}

		public function kiloan(){
			$this->db->order_by('nama_pakaian', 'ASC');
			$data = [
				'content'	=> $this->folder.('kiloan'),
				'section'	=> $this->section,
				'tampil'	=> $this->model->get_all('pakaian')->result(),
				'tarif'	=> $this->model->get_by('tarif', 'jenis_tarif', 'Kg')->result()
			];

			$this->load->view('template/template', $data);
		}

		public function add_cart_kiloan(){
			$id 	= $this->input->post('id');
			$p 		= $this->model->get_by('pakaian', 'id_pakaian', $id)->row_array();
			$i 		=$p;

			$data = [
				'id'	=> $p['id_pakaian'],
				'name'	=> $p['nama_pakaian'],
				'price'	=> 0,
				'qty'	=> $this->input->post('jumlah')
			];

			if($this->cart->total_items() > 0){
				$id 		= $items['id'];
				$idPakaian 	= $this->input->post('id');
				if($id==$idPakaian){
					$up=['rowid'=>$rowid];
					$this->cart->update($up);
				}else{
					$this->cart->insert($data);
				}
			}else{
				$this->cart->insert($data);
			}
			redirect('admin/transaksi/kiloan');
		}

		public function remove_kiloan(){
			$row_id=$this->uri->segment(4);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     	=> 0
				));
			redirect('admin/transaksi/kiloan');
		}

		public function save_kiloan(){

			$this->form_validation->set_rules($this->validation->val_transaksi_kiloan());

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
				$id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($id));
				redirect('admin/transaksi/cetak/'.$id);

			}else{
				$this->db->order_by('nama_pakaian', 'ASC');
				$data = [
					'content'	=> $this->folder.('kiloan'),
					'section'	=> $this->section,
					'tampil'	=> $this->model->get_all('pakaian')->result(),
					'tarif'		=> $this->model->get_by('tarif', 'jenis_tarif', 'Kg')->result()
				];

				$this->load->view('template/template', $data);
			}
		}

		public function satuan(){
			$this->db->order_by('nama_tarif', 'ASC');
			$data = [
				'content'	=> $this->folder.('satuan'),
				'section'	=> $this->section,
				'tampil'	=> $this->model->get_by('tarif', 'jenis_tarif', 'Satuan')->result()
			];

			$this->load->view('template/template', $data);
		}

		public function add_cart_satuan(){
			$id 	= $this->input->post('id');
			$p 		= $this->model->get_by('tarif', 'id_tarif', $id)->row_array();
			$i 		=$p;

			$data = [
				'id'	=> $p['id_tarif'],
				'name'	=> $p['nama_tarif'],
				'price'	=> $p['biaya_tarif'],
				'qty'	=> $this->input->post('jumlah')
			];

			if($this->cart->total_items()>0){
				$id 		= $items['id'];
				$idBarang 	= $this->input->post('id');
				if($id==$idBarang){
					$up=['rowid'=>$rowid];
					$this->cart->update($up);
				}else{
					$this->cart->insert($data);
				}
			}
			else{
				$this->cart->insert($data);
			}
			redirect('admin/transaksi/satuan');
		}

		public function remove_satuan(){
			$row_id=$this->uri->segment(4);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     	=> 0
				));
			redirect('admin/transaksi/satuan');
		}

		public function save_satuan(){
			$this->form_validation->set_rules($this->validation->val_transaksi_satuan());

			if($this->form_validation->run()==true){
				// Save ke table transaksi
				date_default_timezone_set('Asia/Jakarta');
				$bayar 	= $this->cart->total();
				$nama 	= $this->input->post('nama');
	
				foreach ($this->cart->contents() as $item) {
					$row 	= count($this->model->get_all($this->table)->result());
					$id 	= date('dmyHis').'0'.($row+1);
					$data = [
						'id_transaksi' 		=> $id,
						'nama'				=> $nama,
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
						'id_transaksi_d'	=>	$id,
						'nama_d'					=>	$item['name'],
						'jumlah_d'				=>	$item['qty'],
					];
					$this->model->save('transaksi_detail', $dati);
					$this->cart->destroy();
				}

				// Save ke table status laundry
				$data = [
					'id_status'				=> null,
					'id_transaksi_s'	=> $id,
					'cuci'						=> 1,
					'kering'					=> 0,
					'strika'					=> 0,
					'siap'						=> 0,
					'selesai'					=> 0,
					'tgl_ambil'				=> 0,
				];
				$this->model->save('transaksi_status', $data);
		
				$id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($id));
				redirect('admin/transaksi/cetak/'.$id);
			}else{
				$data = [
					'content'	=> $this->folder.('satuan'),
					'section'	=> $this->section,
					'tampil'	=> $this->model->get_by('tarif', 'jenis_tarif', 'Satuan')->result(),
				];

				$this->load->view('template/template', $data);
			}
		}

		public function berhasil(){
			echo 'Berhasil';
		}

		public function cetak($idTransaksi=null){
			if(!isset($idTransaksi)) show_404();

			$idTransaksi = str_replace(['-','_','~'],['=','+','/'],$idTransaksi);
			$idTransaksi = $this->encryption->decrypt($idTransaksi);

			$transaksi = $this->db->select('nama, tgl_transaksi, paket_transaksi, jenis_paket, berat_jumlah, total_transaksi, nama_d, jumlah_d')
								->from('transaksi as a')
								->join('transaksi_detail as b', 'a.id_transaksi=b.id_transaksi_d')
								->where('id_transaksi',$idTransaksi)
								->get()
								->result();

			if(count($transaksi) === 0){ redirect('admin/transaksi'); }

			$struk 		= $idTransaksi;
			$jml_uang 	= 5000;
			$nama  		= $transaksi[0]->nama;
			$total 		= $transaksi[0]->total_transaksi;
			$berat 		= $transaksi[0]->berat_jumlah .' '. $transaksi[0]->jenis_paket;
			$paket 		= $transaksi[0]->paket_transaksi;
			$tanggal 	= $transaksi[0]->tgl_transaksi;
			

			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(190,7,'Struk Laundry' ,0,0,'C');
			$pdf->Cell(10,20,'',0,1); //Jarak

			
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(125,6,'No.Struk  : '.$struk,0,0);
			$pdf->Cell(80,6,'Paket    : '.$paket,0,1);
			$pdf->Cell(125,6,'Name       : '.$nama,0,0);
			$pdf->Cell(80,6,'Berat     : '.$berat,0,1);
			$pdf->Cell(125,6,'Tanggal  	 : '.$tanggal,0,0);
			$pdf->Cell(80,6,'Total      : Rp '.number_format($total,0,'','.'),0,1);
			$pdf->Cell(10,10,'',0,1); //Jarak
			
			// Start table
			$pdf->SetFont('Arial','B','10');
			$pdf->Cell(10,6,'NO',1,0);
			$pdf->Cell(133,6,'Jenis Pakaian',1,0);
			$pdf->Cell(20,6,'Jumlah',1,1,'C');

			$pdf->SetFont('Arial','','10');

			$no=1;
			foreach($transaksi as $t){
				$pdf->Cell(10,6,$no,1,0,'C');
				$pdf->Cell(133,6,$t->nama_d,1,0);
				$pdf->Cell(20,6,$t->jumlah_d,1,1);
				$no++;
			}

			$pdf->SetFont('Arial','',8);
			$pdf->Cell(0,2,'',0,1); //Jarak
			$pdf->Cell(125,6,'*Note: untuk pengecekan progres laundry di www.laundry.com dan masukkan no struk anda.',0,0);
			// End Table
			$pdf->Output();

		}

	}
?>