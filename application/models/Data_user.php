<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Model {
	
	public function get_data() {
		return $this->db->get('user');
	}

	public function get_userById($userId){
		return $this->db->select()->from('user')->join('user_info','user.user_id = user_info.user_info_id')
			->where(array('user.user_id' => $userId))->get();
	}

	public function get_driverById($userId){
		return $this->db->select()->from('user')->join('driver_info','user.user_id = driver_info.driver_info_id')
			->where(array('user.user_id' => $userId))->get();
	}

	public function get_admin(){
		$this->db->where(array('level' => 'admin'));
		return $this->db->get('user');
	}

	public function get_records($where){
		$this->db->where($where);
		return $this->db->get('user');
	}

	public function save_user_data($user_data) {
		
		$data = array(
			'firstName' => $user_data['firstName'],
			'middleName' => $user_data['middleName'],
			'lastName' => $user_data['lastName'],
			'username' => $user_data['userName'],
			'password' => base64_encode($user_data['password']),
			'level' => 'user'
		);
		$this->db->insert('user', $data);
		$userId = $this->db->insert_id();

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
		
		if($this->db->insert('user_info', $data_info)){
			return true;
		} else {
			return false;
		}

	}

	public function update_data($id, $data, $table){
		$this->db->where($id);
		return $this->db->update($table, $data);
	}

	public function saveDriver($driver_data){
		$data = array(
			'firstName' => $driver_data['firstName'],
			'middleName' => $driver_data['middleName'],
			'lastName' => $driver_data['lastName'],
			'username' => $driver_data['userName'],
			'password' => base64_encode($driver_data['password']),
			'level' => 'driver'
		);
		$this->db->insert('user', $data);
		$userId = $this->db->insert_id();

		$driver_info = array(
			'driver_info_id' => $userId,
			'phoneNumber' => $driver_data['phoneNumber'],
			'driversLicense' => $driver_data['driversLicense'],
			'brgy' => $driver_data['barangay'],
			'street' => $driver_data['address'],
		);

		if($this->db->insert('driver_info', $driver_info)){
			return true;
		} else {
			return false;
		}
	}

	public function getDriver(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('driver_info','user.user_id = driver_info.driver_info_id');
		$this->db->where('user.level','driver');
		return $this->db->get();
	}

	public function getDriverTruckById($driverId, $truckId, $collectionId){
		return $this->db->query("SELECT DISTINCT * FROM truck INNER JOIN (SELECT location.collection_id, user.user_id, 
								user.firstName, user.lastName, location.truck_id, location.driver_id FROM location 
								INNER JOIN user ON location.driver_id = user.user_id WHERE location.collection_id = '".$collectionId."') 
								AS driver ON driver.truck_id = truck.id WHERE truck.id = ".(int)$truckId." AND 
								driver.driver_id = '".$driverId."'");
	}

	public function deleteDriver($driver_id){
		if($this->db->delete('driver_info', array('driver_info_id' => $driver_id)) && $this->db->delete('user', array('user_id' => $driver_id))){
			return true;
		} else {
			return false;
		}
	}

	public function editDriver($driver_data){
		$data = array(
			'firstName' => $driver_data['firstName'],
			'middleName' => $driver_data['middleName'],
			'lastName' => $driver_data['lastName'],
			'username' => $driver_data['userName'],
			'password' => base64_encode($driver_data['password']),
			'level' => 'driver'
		);

		$driver_info = array(
			'phoneNumber' => $driver_data['phoneNumber'],
			'driversLicense' => $driver_data['driversLicense'],
			'brgy' => $driver_data['barangay'],
			'street' => $driver_data['address'],
		);

		if($this->update_data(array('user_id' => $driver_data['driverID']), $data, 'user') && $this->update_data(array('driver_info_id' => $driver_data['driverID']), $driver_info, 'driver_info')){
			return true;
		} else {
			return false;
		}
	}

	public function addTruck($truck_data){
		$data = array(
			'plate_no' => $truck_data['plateNumber'],
			'truck_model' => $truck_data['truckModel'],
			'truck_color' => $truck_data['truckColor'],
			'truck_no' => $truck_data['truckNumber'],
		);
		return $this->db->insert('truck', $data);
	}

	public function getTruck(){
		return $this->db->get('truck');
	}

	public function deleteTruck($truck_id){
		return $this->db->delete('truck', array('id' => $truck_id));
	}

	public function editTruck($truck_data){
		$data = array(
			'plate_no' => $truck_data['plateNumber'],
			'truck_model' => $truck_data['truckModel'],
			'truck_color' => $truck_data['truckColor'],
		);
		$this->db->where(array('id' => $truck_data['truckID']));
		return $this->db->update('truck', $data);
	}

	public function get_barangay(){
		return $this->db->get("barangay");
	}

}
