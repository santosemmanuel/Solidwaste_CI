<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_wastecat extends CI_Model {

	public function get_data() {
		return $this->db->get('wastecat');
	}

	public function count_rows() {
		return $this->db->count_all('wastecat');
	}

	public function get_records($wastecat_id){
		$where = array('wastecat_id' => $wastecat_id);
		$this->db->where($where);
		return $this->db->get('wastecat');
	}

	public function filter($dari, $sampai){
		return $this->db->query("select * from wastecat where (fin_date >= '$dari' and fin_date <= '$sampai') or (col_date <= '$sampai' and  fin_date = '0000-00-00') and (aktif <= 1)");
	}

	public function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

	public function update_data($wastecat_id, $data, $table){
		$where = array('wastecat_id' => $wastecat_id);
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function delete_data($wastecat_id, $table){
		$where = array('wastecat_id' => $wastecat_id);
		$this->db->where($where);
		return $this->db->delete($table);
	}

}