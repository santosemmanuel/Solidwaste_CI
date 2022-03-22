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

		$query = $this->db->select('user_id')->order_by('user_id','DESC')->limit(1)->get('user');
		$lastId = $query->result();
		$lastIdNumber = substr($lastId[0]->user_id, -1);
		$userIdNumber = (int)$lastIdNumber;
		$userId = "U00".($userIdNumber+ 1);
		
		$data = array(
			'user_id' => $userId,
			'firstName' => $user_data['firstName'],
			'middleName' => $user_data['middleName'],
			'lastName' => $user_data['lastName'],
			'username' => $user_data['userName'],
			'password' => base64_encode($user_data['password']),
			'level' => 'user'
		);

		$businessName = (isset($user_data['businessName']))? $user_data['businessName'] : "null";
		$businessType = (isset($user_data['businessType']))? $user_data['businessType'] : "null";
		$businessPermit = (isset($user_data['businessPermit']))? $user_data['businessPermit'] : "null";

		$data_info = array(
			'user_info_id' => $userId,
			'phoneNumber' => $user_data['contactNumber'],
			'businessName' => $businessName,
			'businessType' => $businessType,
			'permitNumber' => $businessPermit,
			'realEstate' => $user_data['realEstate'],
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

	public function update_data($id, $data, $table){
		$this->db->where($id);
		return $this->db->update($table, $data);
	}

	public function save_admin($user_data){

		$query = $this->db->select('user_id')->order_by('user_id','DESC')->limit(1)->get('user');
		$lastId = $query->result();
		$lastIdNumber = (int) substr($lastId[0]->user_id, -1);
		$userId = "U00".($lastIdNumber+ 1);

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