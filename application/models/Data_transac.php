<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_transac extends CI_Model {

	public function get_data() {
		$this->db->select('*');
		$this->db->from('transac');
		$this->db->join('municipal', 'municipal.municipal_id = transac.municipal_id');
		$this->db->join('wastecat', 'wastecat.wastecat_id = transac.wastecat_id');
		$this->db->order_by('transac_id', 'desc');
		return $this->db->get();
	}

	public function count_rows() {
		return $this->db->count_all('transac');
	}

	public function count_active() {
		$this->db->select('*');
	    $this->db->from('transac');
	    $this->db->where('end_date','0000-00-00');
	    $num_results = $this->db->count_all_results();

	    return $num_results;
	}

	public function get_records($where){
		$this->db->where($where);
		return $this->db->get('transac');
	}

	public function get_full_records($where){
		$this->db->select('*');
		$this->db->from('transac');
		$this->db->join('municipal', 'municipal.municipal_id = transac.municipal_id');
		$this->db->join('wastecat', 'wastecat.wastecat_id = transac.wastecat_id');
		$this->db->where($where);
		return $this->db->get();
	}

	public function filter($dari, $sampai) {
		return $this->db->query("select * from transac join wastecat on transac.wastecat_id = wastecat.wastecat_id join municipal on transac.municipal_id = municipal.municipal_id where end_date >= '$dari' and end_date <= '$sampai'");
	}

	public function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

	public function update_data($where, $data, $table){
		$this->db->where($where);
		return $this->db->replace($table, $data);
	}

	public function delete_data($where, $table){
		$this->db->where($where);
		return $this->db->delete($table);
	}

	public function total_income_year(){
	    $result = $this->db->query("select sum(total) as total_pendapatan from transac where year(end_date) = year(curdate())")->result();

	    return $result[0]->total_pendapatan;
	}
}