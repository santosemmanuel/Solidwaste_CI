<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_concern extends CI_Model {

	public function SendConcern($where){
		return $this->db->insert('concern', $where);
	}

	public function getConcern($userID){
		return $this->db->query("SELECT * FROM user INNER JOIN (SELECT DISTINCT con.sender FROM 
					(SELECT * FROM concern WHERE reciever = 1) AS con) AS SEND ON SEND.sender = user.user_id");
	}

	public function getUserConversation($userID){
		return $this->db->query("SELECT * FROM `concern` INNER JOIN user ON concern.sender = user.user_id 
				WHERE reciever = {$userID} OR sender = {$userID} ORDER BY message_date DESC");
	}

}
