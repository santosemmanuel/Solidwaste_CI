<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_collection extends CI_Model {
	
	public function get_data() {
		return $this->db->get('collection');
	}

	public function add_collection($data){
		return $this->db->insert('collection',$data);
	}

	public function add_location($dataLocation){
		return $this->db->insert('location',$dataLocation);
	}

}
