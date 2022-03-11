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
		$numOfUser = $this->db->count_all('user');
		$userId = "U00".($numOfUser + 1);

		$data = array(
			'user_id' => $userId,
			'firstName' => $user_data['firstName'],
			'middleName' => $user_data['middleName'],
			'lastName' => $user_data['lastName'],
			'username' => $user_data['userName'],
			'password' => md5($user_data['password']),
			'level' => 'user'
		);
		$data_info = array(
			'user_info_id' => $userId,
			'phoneNumber' => $user_data['contactNumber'],
			'businessName' => $user_data['businessName'],
			'businessType' => $user_data['businessType'],
			'annualIncomeTax' => $user_data['ITR'],
			'tin' => $user_data['TIN'],
			'municipality' => '',
			'brgy' => $user_data['barangay'],
			'street' => $user_data['address'],
			'location' => $user_data['coordinates']
		);
		
		if($this->db->insert('user', $data) && $this->db->insert('user_info', $data_info)){
			return true;
		} else {
			return false;
		}
	}

	public function save_admin($user_data){
		$numOfUser = $this->db->count_all('user');
		$userId = "U00".($numOfUser + 1);
		$data = array(
			'user_id' => $userId,
			'firstName' => $user_data['firstName'],
			'middleName' => $user_data['middleName'],
			'lastName' => $user_data['lastName'],
			'username' => $user_data['userName'],
			'password' => base64_encode($user_data['password']),
			'level' => 'admin'
		);
		return $this->db->insert('user',$data);
	}

	public function get_admin(){
		$this->db->where('level', "admin");
		return $this->db->get('user');
		
	}

	public function edit_admin($user_data){
		$data = array(
			'firstName' => $user_data['firstName'],
			'middleName' => $user_data['middleName'],
			'lastName' => $user_data['lastName'],
			'username' => $user_data['userName'],
			'password' => base64_encode($user_data['password']),
		);
		$this->db->where('user_id', $user_data['userID']);
		return $this->db->update('user', $data);
	}

	public function delete_admin($user_id){
		$this->db->where('user_id', $user_id);
		return $this->db->delete('user');
	}
}