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

	public function getBarangay(){
		return $this->db->get('barangay');
	}

	public function getDailyWaste($data){
		return $this->db->select("IF(SUM(waste_kg) IS NULL, 0, SUM(waste_kg)) AS total_kg")
			->where($data)->get('request');
	}

	public function getCollectionByDriver($where){
		$queryCollectionByDriver = "SELECT request.user_id, request.waste_id, wastecat.name_wastecat, 
									SUM(request.waste_kg) AS total_kg FROM request INNER JOIN user_info ON 
									request.user_id = user_info.user_info_id INNER JOIN wastecat ON 
									request.waste_id = wastecat.wastecat_id WHERE ";
		$queryCollectionByDriver .= $where;
		return $this->db->query($queryCollectionByDriver);
	}

}
