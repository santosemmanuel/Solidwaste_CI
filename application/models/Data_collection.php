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

	public function get_collectionLocation($collectID){
		return $this->db->select('*')->from('collection')
							->join('location', 'collection.collection_id = location.collection_id')
							->where(array('collection.collection_id' => $collectID))
							->get();

	}

	public function get_distinctDriver($collectionId){
		return $this->db->distinct()->select('driver_id, location.collection_id, collection.collection_date, truck_id')
									->from('location')
									->join('collection', 'collection.collection_id = location.collection_id')
									->where(array('location.collection_id' => $collectionId))
									->get();
	}

	public function get_locationByIDs($collectionID, $driverID){
		return $this->db->select('brgy_id')->from('location')
							->where(array('collection_id' => $collectionID, 'driver_id' => $driverID))
							->get();
	}

	public function get_locationBrgy($collectionID, $driverID){
		return $this->db->select('barangay.id, barangay.barangay, location.brgy_id')
						->from('location')
						->join('barangay', 'barangay.id = location.brgy_id')
						->where(array('collection_id' => $collectionID, 'driver_id' => $driverID))
						->get();
	}

	public function delete_location($collectionID){
		$this->db->where(array('collection_id' => $collectionID));
		return $this->db->delete('location');

	}
}
