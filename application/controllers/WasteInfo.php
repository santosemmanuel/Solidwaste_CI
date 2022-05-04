<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WasteInfo extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model('data_wastecat');
		$this->load->model('data_request');
		$this->load->model('data_user');
	}

	public function index()
	{
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$data['requestWasteList'] = $this->data_request->get_requestWasteList($this->session->userdata('user_id'))
									->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('wasteInfo', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function driverCollection(){
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('driverwastecollection');
		$this->load->view('footer');
		$this->load->view('source', array('js' => 'assets/js/driverdashboard.js'));
	}

	public function getDriverWasteCollection(){
		$result = $this->DriverWasteCollection($this->input->post('type'), $this->input->post('dataItem'));
		echo json_encode($result);
	}

	public function DriverWasteCollection($type, $dataItem){
		$barangay = $this->data_user->get_barangay()->result();
		$waste = $this->data_wastecat->get_data()->result();
		$collectionArray = array();
		$queryWhereDate = "";

		if($type == 'daily'){
			$queryWhereDate .= "request.date_pickup = '{$dataItem}'";
		} else if ($type == 'weekly'){
			$queryWhereDate = "request.date_pickup BETWEEN '{$dataItem[0]}' AND '{$dataItem[1]}'";
		} else if ($type == 'monthly'){
			$queryWhereDate = "MONTHNAME(request.date_pickup) = '{$dataItem[0]}' AND YEAR(request.date_pickup) = '{$dataItem[1]}'";
		}

		foreach($barangay as $brgy){
			$temp = array();
			foreach($waste as $category){
				$where = "driver_id = 3 AND user_info.brgy = {$brgy->id} AND request.waste_id = {$category->wastecat_id} AND ";
				$where .= $queryWhereDate;
				$wasteCollection = $this->data_wastecat->getCollectionByDriver($where)->result();
				array_push($temp, (int)$wasteCollection[0]->total_kg);
			}
			array_push($collectionArray, array($brgy->barangay, $temp));
			unset($temp);
		}
		return $collectionArray;
	}

	public function printTable() {
		$this->session->unset_userdata('wasteToPrint');
		$this->session->unset_userdata('chartDate');
		$this->session->unset_userdata('chartType');
		$resultWasteToPrint = $this->DriverWasteCollection($this->input->post('type'), $this->input->post('dataItem'));
		$data['wasteToPrint'] = $resultWasteToPrint;
		$data['chartDate'] = $this->input->post('dataItem');
		$data['chartType'] = $this->input->post('type');
		$this->session->set_userdata($data);
		echo true;
	}

	public function printPage($page) {

		$data['printWaste'] = $this->session->userdata('wasteToPrint');
		$data['chartType'] = $this->session->userdata('chartType');
		$data['chartDate'] = $this->session->userdata('chartDate');

		if($page == 'pdf') {
			$this->load->library('pdf');
			$this->pdf->load_view('pdf/driverWasteInfo', $data);
		} else {
			$this->load->view('print/driverWasteInfo', $data);
		}
	}
}
