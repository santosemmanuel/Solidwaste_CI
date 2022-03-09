<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Model {
	
	public function get_data() {
		return $this->db->get('user');
	}

	public function get_records($where){
		$this->db->where($where);
		return $this->db->get('user');
	}

	public function save_user_data($user_data) {
		//TODO: Get first the Prev ID then create Variable
		//TODO: Put Created Variable in Table 1 and Table 2
		$data = array(
			'firstName' => $user_data['firstName']
		);
		$this->db->insert('user_info', $data);
		$insert_id = $this->db->insert_id();
	}
}