<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_usersection extends CI_Model {

	public function get_data() {

		return $this->db->query("SELECT * FROM (SELECT * FROM user_info INNER JOIN barangay ON 
								user_info.brgy = barangay.id) AS UB INNER JOIN user ON user.user_id = UB.user_info_id 
								WHERE user.level = 'user' AND user.delete_item = 0");

	}

	public function delete_data($user_id){
		if($this->db->delete('user_info', array('user_info_id' => $user_id)) && $this->db->delete('user', array('user_id' => $user_id))){
			return true;
		} else {
			return false;
		}
	}

}
