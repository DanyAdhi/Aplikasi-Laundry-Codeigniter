<?php 
	defined('BASEPATH') OR exit ('No direct scrip access allowed');

	class Transaksi extends CI_Controller{
		
		var $folder 	= 'transaksi/';
		var $section 	= 'Transaksi';
		var $table		= 'transactions';


		function __construct(){
			parent::__construct();
			if($this->session->userdata('masuk') != TRUE) { redirect(base_url('')); };
			$this->load->model(['Model','Validation']);
			$this->load->library(['form_validation', 'encryption', 'pdf']);
		}

		public function index() {
			$this->db->order_by('id', 'DESC');
			$data = [
				'content'				=> $this->folder.('view'),
				'section'				=> $this->section,
				'transactions'	=> $this->Model->get_all($this->table)->result()
			];

			$this->load->view('template/template', $data);
		}

		public function detail($id=null) {
			$id = str_replace(['-','_','~'],['=','+','/'],$id);
			$id = $this->encryption->decrypt($id);
			$getOne = $this->Model->get_by($this->table, 'id', $id)->row_array();
			
			if ($getOne) {
				//assign detail on getOne variable
				$getDetail = $this->Model->get_by('transaction_detail', 'transaction_id', $id)->result();
				// var_dump($getDetail);
				$getOne['detail'] = $getDetail;

				$data = [
					"data" 		=> $getOne,
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

		public function paket(){
			$data = [
				'content'	=> $this->folder.('paket'),
				'section'	=> $this->section,
			];

			$this->load->view('template/template', $data);
		}

		// Start Kiloan
		public function kiloan(){
			$this->db->order_by('name', 'ASC');
			$data = [
				'content'		=> $this->folder.('kiloan'),
				'section'		=> $this->section,
				'clothes'		=> $this->Model->get_all('clothes')->result(),
				'packages'	=> $this->Model->get_by('packages', 'type', 'Kg')->result()
			];

			$this->load->view('template/template', $data);
		}

		public function add_cart_kiloan() {
			$id 			= $this->input->post('id');
			$clothe 	= $this->Model->get_by('clothes', 'id', $id)->row_array();

			$data = [
				'id'		=> $clothe['id'],
				'name'	=> $clothe['name'],
				'price'	=> 0,
				'qty'		=> $this->input->post('jumlah')
			];
			$this->cart->insert($data);

			redirect('admin/transaksi/kiloan');
		}

		public function remove_kiloan(){
			$row_id=$this->uri->segment(4);
			$this->cart->update(
				[
					'rowid'	=> $row_id,
					'qty'		=> 0
				]
			);
			redirect('admin/transaksi/kiloan');
		}

		public function save_kiloan(){

			$this->form_validation->set_rules($this->Validation->val_transaksi_kiloan());

			$post = $this->input->post();

			if ($this->form_validation->run() == true) {
				// Save ke table transaksi
				date_default_timezone_set('Asia/Jakarta');
				$row 								= count($this->Model->get_all($this->table)->result());
				$receipt 						= date('dmyHis').'0'.($row+1);

				$data_transactions = [
					'receipt' 						=> $receipt,
					'name'								=> $post['name'],
					'package'							=> $post['package'].')',
					'type'								=> 'Kg',
					'amount'							=> $post['amount'],
					'amount_transaction'	=> $post['amount_transaction'],
				];
				$id_transaction = $this->Model->save($this->table, $data_transactions);

				// save ke table detail transaksi
				foreach ($this->cart->contents() as $item) {
					$data_transaction_detail =	[
						'id' 								=>	null,
						'transaction_id'		=>	$id_transaction,
						'name'							=>	$item['name'],
						'amount'						=>	$item['qty'],
					];
					$this->Model->save('transaction_detail', $data_transaction_detail);
					$this->cart->destroy();

				}

				// Save ke table status laundry
				$data_transaction_status = [
					'id'							=> null,
					'transaction_id'	=> $id_transaction,
					'cuci'						=> 1,
					'kering'					=> 0,
					'strika'					=> 0,
					'siap'						=> 0,
					'selesai'					=> 0,
				];
				$this->Model->save('transaction_status', $data_transaction_status);
				$id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($id_transaction));
				redirect('admin/transaksi/cetak/'.$id_transaction);

			} else {
				$this->db->order_by('name', 'ASC');
				$data = [
					'content'		=> $this->folder.('kiloan'),
					'section'		=> $this->section,
					'clothes'		=> $this->Model->get_all('clothes')->result(),
					'packages'	=> $this->Model->get_by('packages', 'type', 'Kg')->result()
				];

				$this->load->view('template/template', $data);
			}
		}
		// End Kiloan


		// Start Satuan
		public function satuan() {
			$this->db->order_by('name', 'ASC');
			$data = [
				'content'		=> $this->folder.('satuan'),
				'section'		=> $this->section,
				'packages'	=> $this->Model->get_by('packages', 'type', 'Satuan')->result()
			];

			$this->load->view('template/template', $data);
		}

		public function add_cart_satuan(){
			$id 			= $this->input->post('id');
			$package 	= $this->Model->get_by('packages', 'id', $id)->row_array();

			$data = [
				'id'		=> $package['id'],
				'name'	=> $package['name'],
				'price'	=> $package['amount'],
				'qty'		=> $this->input->post('jumlah')
			];

			$this->cart->insert($data);
			redirect('admin/transaksi/satuan');
		}

		public function remove_satuan() {
			$row_id=$this->uri->segment(4);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     	=> 0
				));
			redirect('admin/transaksi/satuan');
		}

		public function save_satuan(){
			$this->form_validation->set_rules($this->Validation->val_transaksi_satuan());

			$post = $this->input->post();

			if ($this->form_validation->run() === true) {
				// Save ke table transaksi
				date_default_timezone_set('Asia/Jakarta');
				$bayar 	= $this->cart->total();
				$name 	= $this->input->post('name');
				$row 								= count($this->Model->get_all($this->table)->result());
				$receipt 						= date('dmyHis').'0'.($row+1);

				$data = [
					'receipt' 						=> $receipt,
					'name'								=> $post['name'],
					'package'							=> 'Satuan',
					'type'								=> 'Pcs',
					'amount'							=> $this->cart->total_items(),
					'amount_transaction'	=> $this->cart->total()
				];
				$id_transaction = $this->Model->save($this->table, $data);
	
				foreach ($this->cart->contents() as $item) {

					// save ke table detail transaksi
					$data_transaction_detail =	[
						'transaction_id'	=>	$id_transaction,
						'name'						=>	$item['name'],
						'amount'					=>	$item['qty'],
					];
					$this->Model->save('transaction_detail', $data_transaction_detail);
					$this->cart->destroy();
				}

				// Save ke table status laundry
				$data_transaction_status = [
					'transaction_id'	=> $id_transaction,
					'cuci'						=> 1,
					'kering'					=> 0,
					'strika'					=> 0,
					'siap'						=> 0,
					'selesai'					=> 0,
				];
				$this->Model->save('transaction_status', $data_transaction_status);
		
				$id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($id_transaction));
				redirect('admin/transaksi/cetak/'.$id_transaction);
			} else {
				$data = [
					'content'	=> $this->folder.('satuan'),
					'section'	=> $this->section,
					'packages'	=> $this->Model->get_by('packages', 'type', 'Satuan')->result()
				];

				$this->load->view('template/template', $data);
			}
		}
		// End Satuan


		public function cetak($id=null){
			if(!isset($id)) show_404();

			$id = str_replace(['-','_','~'],['=','+','/'], $id);
			$id = $this->encryption->decrypt($id);

			$transaksi = $this->db->select('receipt, transactions.name AS customer_name, transactions.createDate, package, type, transactions.amount AS transaction_amount, amount_transaction, transaction_detail.name AS clothe_name, transaction_detail.amount')
								->from('transactions')
								->join('transaction_detail', 'transactions.id = transaction_detail.transaction_id')
								->where('transactions.id',$id)
								->get()
								->result();

			if (count($transaksi) === 0) { redirect('admin/transaksi'); }

			$struk 			= $transaksi[0]->receipt;
			$jml_uang 	= 5000;
			$nama  			= $transaksi[0]->customer_name;
			$total 			= $transaksi[0]->amount_transaction;
			$berat 			= $transaksi[0]->transaction_amount .' '. $transaksi[0]->type;
			$paket 			= $transaksi[0]->package;
			$tanggal 		= $transaksi[0]->createDate;
			

			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(190,7,'Struk Laundry' ,0,0,'C');
			$pdf->Cell(10,20,'',0,1); //Jarak

			
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(110,	6,	'No.Struk  : '.$struk,0,0);
			$pdf->Cell(80,	6,	'Paket               : '.$paket,0,1);
			$pdf->Cell(110,	6,	'Name      : '.$nama,0,0);
			$pdf->Cell(80,	6,	'Jumlah/Berat   : '.$berat,0,1);
			$pdf->Cell(110,	6,	'Tanggal  	 : '.$tanggal,0,0);
			$pdf->Cell(80,	6,	'Total                : Rp '.number_format($total,0,'','.'),0,1);
			$pdf->Cell(10,	10,	'',0,1); //Jarak
			
			// Start table
			$pdf->SetFont('Arial','B','10');
			$pdf->Cell(10,6,'NO',1,0);
			$pdf->Cell(133,6,'Jenis Pakaian',1,0);
			$pdf->Cell(20,6,'Jumlah',1,1,'C');

			$pdf->SetFont('Arial','','10');

			$no=1;
			foreach($transaksi as $t){
				$pdf->Cell(10,	6,	$no,1,0,'C');
				$pdf->Cell(133,	6,	$t->clothe_name,1,0);
				$pdf->Cell(20,	6,	$t->amount,1,1);
				$no++;
			}

			$pdf->SetFont('Arial','',8);
			$pdf->Cell(0,		2,	'',0,1); //Jarak
			$pdf->Cell(125,	6,	'*Note: untuk pengecekan progres laundry di www.laundry.com dan masukkan no struk anda.',0,0);
			// End Table
			$pdf->Output();

		}

	}
?>