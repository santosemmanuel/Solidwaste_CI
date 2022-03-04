<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_expend extends CI_Model {

	public function get_data() {
		$this->db->select('*');
		$this->db->from('expend');
		$this->db->join('wastecat', 'wastecat.wastecat_id = expend.wastecat_id');
		return $this->db->get();
	}

	public function count_rows() {
		return $this->db->count_all('expend');
	}

	public function get_records($where){
		$this->db->where($where);
		return $this->db->get('expend');
	}

	public function filter($dari, $sampai) {
		return $this->db->query("select * from expend join wastecat on expend.wastecat_id = wastecat.wastecat_id where start_expend >= '$dari' and start_expend <= '$sampai'");
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

	public function total_gaji(){
		$result = $this->db->query("select sum(col_fees) as total_gaji from wastecat where aktif = 1")->result();

	    return $result[0]->total_gaji;
	}

	public function total_spend_year(){
		$result = $this->db->query("select sum(total) as start_expend from expend where year(start_expend) = year(curdate())")->result();

	    return $result[0]->start_expend;
	}
}