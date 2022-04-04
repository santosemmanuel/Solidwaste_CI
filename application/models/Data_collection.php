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

	public function delete_collection($collectionId){
		$tables = array('location','collection');
		$this->db->where('collection_id', $collectionId);
		return $this->db->delete($tables);
	}

	public function get_collectionLocation(){
		/*
		 * QUERY: SELECT * FROM collection INNER JOIN location ON collection.collection_id = location.collection_id
		 * WHERE collection.collection_id = 'C001';
		 */
	}
}
