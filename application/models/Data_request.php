<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_request extends CI_Model {

	public function get_data() {
		return $this->db->get('request');
	}

	public function get_request(){
		return $this->db->select()->from('request')->join('user_info','request.user_id = user_info.user_info_id')
			->where('remarks !=','done')->get();
	}

	public function add_request($dataRequest){
		return $this->db->insert('request', $dataRequest);
	}

	public function update_request($updateData, $requestID){
		$this->db->where(array('request_id' => $requestID));
		return $this->db->update('request', $updateData);
	}

	public function get_requestDriver($driverID){
		return $this->db->select()->from('request')->join('user_info','request.user_id = user_info.user_info_id')
			->where('remarks !=','done')->where('driver_id', $driverID)->get();
	}


}
