<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller{

		function __construct(){
			parent::__construct();
			if ($this->session->userdata('masuk') != TRUE) { redirect(base_url('')); };
			
			$this->load->model(['Model', 'DashboardModel']);
		}

		var $section = 'Dashboard';
		public function index() {
			$today = date('Y-m-d');

			//get data daily
			$daily = $this->DashboardModel->getCustomerByDate($today.' 00:00:00', $today.' 23:59:59');
			
			//get data monthly
			$monthly = $this->DashboardModel->getCustomerByDate(date('Y-m-01').' 00:00:00', $today.' 23:59:59');
			
			//get data yearly
			$yearly = $this->DashboardModel->getCustomerByDate(date('Y-01-01').' 00:00:00', $today.' 23:59:59');

			$totalCustomer = [
				'daily' 	=> $daily,
				'monthly'	=> $monthly,
				'yearly'	=> $yearly
			];

			$data = [
				'content'					=> 'admin/dashboard',
				'section'					=> $this->section,
				'totalCustomer' 	=> $totalCustomer
			];
			$this->load->view('template/template', $data);
		}

		public function chart() {

			$startDate 	= date('Y-01-01').' 00:00:00';
			$endDate 		= date('Y-m-d 23:59:59');

			// $get_data = $this->db->query("SELECT DATE_FORMAT(createDate, '%M') AS month,  SUM(amount_transaction) AS total FROM transactions WHERE createDate BETWEEN '2023-01-01' AND '2023-12-31' GROUP BY (month) ")->result();
			$get_data = $this->DashboardModel->getEarningYearly($startDate, $endDate)->result();
			if ($get_data || count($get_data) == 0) {
				$data = [
					"data" 		=> $get_data,
					"success"	=> true,
					"message"	=> "Data chart earning"
				];
			} else {
				$data = [
					"data" 		=> "",
					"success"	=> false,
					"message"	=> "Data chart earning"
				];
			}

			echo json_encode($data);
		}

	}
 ?>