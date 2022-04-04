<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Collectionsched extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model('data_user');
		$this->load->model('data_wastecat');
		$this->load->library('form_validation');
		$this->load->model('data_collection');
	}

    public function user(){
        return $user = array(
            'name' => $this->session->userdata('name'),
            'level' => $this->session->userdata('level')
        );
    }

	public function index(){
        $data['driverData'] = $this->data_user->getDriver()->result();
		$data['truckData'] = $this->data_user->getTruck()->result();
		$data['barangayData'] = $this->data_wastecat->getBarangay()->result();
		$data['collectionID'] = $this->data_collection->get_data()->result();
        $this->load->view('header');
		$this->load->view('navigation', $this->user());
		$this->load->view('admin/collectsched', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function getData(){
		$data = array(
			'driverData' => $this->data_user->getDriver()->result(),
			'truckData' => $this->data_user->getTruck()->result(),
			'barangayData' => $this->data_wastecat->getBarangay()->result()
		);

		echo json_encode($data);
	}

	public function addCollectionSched(){

		$collectionID = $this->input->post('collectionID');
		$collectionDate = $this->input->post('collectionDate');

		$collection = array(
			'collection_id' => $collectionID,
			'collection_date' => $collectionDate,
			'remarks' => 'pending'
		);

		if($this->data_collection->add_collection($collection)){
			$driver = $this->input->post('driver');
			$truck = $this->input->post('truck');
			$location = $this->input->post('brgy');
			for($i = 0; $i < count($driver); $i++){
				for($count = 0; $count < count($location[$i]); $count++){
					$dataLocation = array(
						'collection_id' => $collectionID,
						'truck_id' => (int)$truck[$i][0],
						'driver_id' => $driver[$i][0],
						'brgy_id' => (int)$location[$i][$count],
						'kg' => 0
					);
					$this->data_collection->add_location($dataLocation);
				}
			}
		}

		$info['datatype'] = 'collectionsched';
		$info['operation'] = 'Input';
		$this->load->view('header');
		$this->load->view('notifications/insert_success', $info);
		$this->load->view('source');
	}

	public function getCollection(){
		$query = $this->data_collection->get_data()->result();
		$newArray = array();
		foreach($query as $value){
			if($value->remarks == "pending"){
				$colorRemarks = "orange";
			} else if ($value->remarks == "finish"){
				$colorRemarks = "green";
			}
			array_push($newArray, array('id'=> $value->collection_id, 'title'=> $value->remarks, 'start' => $value->collection_date, 'color' => $colorRemarks, 'selectable' => false));
		}
		echo json_encode($newArray);
	}

	public function deleteCollection(){
		$info['datatype'] = 'collectionsched';
		$info['operation'] = 'delete';
		$this->load->view('header');

		if(!$this->data_collection->delete_collection($this->input->post('schedID'))){
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}
		$this->load->view('source');
	}
}
