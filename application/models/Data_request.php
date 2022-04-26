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

	public function get_chartDataReport($dataReport){
			$queryWithWhere = "SELECT request.waste_id, IF(SUM(request.waste_kg) IS NULL, 0, SUM(request.waste_kg)) 
									AS sum_kg, request.date_pickup, request.remarks, UT.brgy FROM request INNER JOIN 
									(SELECT user.level, user_info.brgy, user.user_id FROM user INNER JOIN user_info ON 
									user.user_id = user_info.user_info_id WHERE user.level = 'user') AS UT ON 
									request.user_id = UT.user_id WHERE ";
			$queryWithWhere .= $dataReport;
			return $this->db->query($queryWithWhere);
	}


}
