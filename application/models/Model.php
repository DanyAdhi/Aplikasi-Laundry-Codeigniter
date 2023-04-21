<?php 

	class Model extends CI_Model {


		public function get_all($table) {
			return $this->db->get($table);
		}

		public function get_by($table, $id, $where) {
			return $this->db->get_where($table, [$id=>$where]);
		}

		public function save($table,$data) {
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}

		public function delete($table,$pk, $where) {
			$this->db->delete($table, [$pk=>$where]);
		}

		public function update($table, $id, $where, $data) {
			$update = $this->db->update($table, $data , [$id=>$where]);
			return $update;
		}


		public function proses() {
				$this->db->select('*');
				$this->db->from('transactions');
				$this->db->join('transaction_status','transactions.id = transaction_status.transaction_id');
				$this->db->where('transaction_status.selesai = 0');
				$this->db->order_by('transactions.id', 'DESC');
				$query = $this->db->get();

				return $query->result();
		}

		public function find_transaction_by_idTransaction($id_transaction) {
			$this->db->select('*');
			$this->db->from('transaksi_status');
			$this->db->join('transaksi', 'transaksi.id_transaksi = transaksi_status.id_transaksi_s');
			$this->db->where(['transaksi_status.id_transaksi_s' => $id_transaction]);
			$query = $this->db->get();

			return $query->result_array();
		}

	}

?>
