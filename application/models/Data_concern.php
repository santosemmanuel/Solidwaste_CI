<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_concern extends CI_Model {

	public function SendConcern($where){
		return $this->db->insert('concern', $where);
	}

	public function getConcern($userID){
		return $this->db->query("SELECT * FROM `concern` INNER JOIN user ON concern.sender = user.user_id 
				WHERE reciever = {$userID} OR sender = {$userID} ORDER BY message_date");
	}

}
