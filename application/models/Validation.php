<?php 
defined('BASEPATH') OR exit ('No script direct access allowed');

	class Validation extends CI_Model{

		public function val_login()
		{
			return [
				[
					'field'	=> 'username',
					'label'	=> 'Username',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'<b>%s</b> harus diisi.'],
				],
				[
					'field'	=> 'password',
					'label'	=> 'Password',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'<b>%s</b> harus diisi.']
				]
			];
		}

		public function val_user()
		{
			return [
				[
					'field'	=> 'name',
					'label'	=> 'Nama',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'username',
					'label'	=> 'Username',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'password',
					'label'	=> 'Password',
					'rules'	=> "required|rtrim|matches[confirm_password]|min_length[4]",
					'errors'=> [
						'required'	=> 'Form <b>%s</b> harus diisi',
						'matches'		=> '<b>Password</b> tidak cocok',
						'min_length'=> 'Pangjang <b>%s<b/> minimal 4 karakter'
					],
				],
				[
					'field'	=> 'confirm_password',
					'label'	=> 'Password',
					'rules'	=> "required|rtrim",
				]
			];
		}

		public function val_prices() {
			return [
				[
					'field'	=> 'name',
					'label'	=> 'Nama Tarif',
					'rules'	=> 'required|rtrim|is_unique[prices.name]',
					'errors'=> [
						'required' 	=> 'Form <b>%s</b> tidak boleh kosong',
						'is_unique'	=> 'Nama Tarif sudah ada.'
					]
				],
				[
					'field'	=> 'time',
					'label'	=> 'Waktu Proses',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				],
				[
					'field'	=> 'amount',
					'label'	=> 'Biaya',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required'=>'Form <b>%s</b> tidak boleh kosong.']
				]
			];
		}


		public function val_transaksi_kiloan()
		{
			return [
				[
					'field'	=> 'amount',
					'label'	=> 'Berat',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required' => 'Form %s tidak boleh kosong.']

				],
				[
					'field'	=> 'name',
					'label'	=> 'Nama Pemilik',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required' => 'Form %s tidak boleh kosong.']
				]
			];
		}

		public function val_transaksi_satuan(){
			return [
				[
					'field'	=> 'name',
					'label'	=> 'Nama Pemilik',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required' => 'Form %s tidak boleh kosong.']
				],
				[
					'field'	=> 'amount',
					'label'	=> 'Jumlah Barang',
					'rules'	=> 'required|rtrim',
					'errors'=> ['required' => 'Form %s tidak boleh kosong.']
				]
			];
		}




	}
?>