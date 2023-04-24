<?php
  class DashboardModel extends CI_Model {
    
    public function getCustomerByDate($startDate, $endDate) {
      $query = $this->db->from('transactions')
                        ->where('createDate BETWEEN "'.$startDate.'" AND "'.$endDate.'"')
                        ->count_all_results();
      return $query;
    }

    public function getEarningYearly($startDate, $endDate) {
      $query = $this->db->select("DATE_FORMAT(createDate, '%M') AS month,  SUM(amount_transaction) AS total")
                        ->from('transactions')
                        ->where('createDate BETWEEN "'.$startDate.'" AND "'.$endDate.'"')
                        ->group_by('month')
                        ->get();
      return $query;
    }

  }
?>