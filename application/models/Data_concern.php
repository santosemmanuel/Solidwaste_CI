<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_concern extends CI_Model {

	public function SendConcern($where){
		return $this->db->insert('concern', $where);
	}

	public function getConcern($userID){
		$where = "sender = {$userID} OR sender = 1";
		$this->db->where($where);
		return $this->db->get('concern');
	}

}
