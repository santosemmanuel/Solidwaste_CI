<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_usersection extends CI_Model {

	public function get_data() {
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_info','user.user_id = user_info.user_info_id');
		$this->db->where('user.level','user');
		return $this->db->get();
	}

	public function delete_data($user_id){
		if($this->db->delete('user_info', array('user_info_id' => $user_id)) && $this->db->delete('user', array('user_id' => $user_id))){
			return true;
		} else {
			return false;
		}
	}

}
