<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_municipal extends CI_Model {

	public function get_data() {
		
		return $this->db->get('municipal');
	}

	public function count_rows() {
		return $this->db->count_all('municipal');
	}

	public function get_records($municipal_id){
		
		$where = array('municipal_id' => $municipal_id);
		$this->db->where($where);
		return $this->db->get('municipal');
	}

	public function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

	public function update_data($municipal_id, $data, $table){
		$where = array('municipal_id' => $municipal_id);
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function delete_data($municipal_id, $table){
		$where = array('municipal_id' => $municipal_id);
		$this->db->where($where);
		return $this->db->delete($table);
	}

}