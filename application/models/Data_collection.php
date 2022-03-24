<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_collection extends CI_Model {
	
	public function get_data() {
		return $this->db->get('user');
	}

}