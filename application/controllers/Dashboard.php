<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model('data_user');
		$this->load->model('data_request');
		$this->load->model('data_wastecat');
	}

	public function index()
	{
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);

		$page = 'personalInfo';
		$js = array('js'=> 'assets/js/dashboard.js');
		if($this->session->userdata('level') == 'admin'){
			$page = 'admin/dashboard';
			$data = array(
				'user_data' => $this->data_user->get_admin($this->session->userdata('user_id'))->result(),
				'truck_data' => $this->data_user->getTruck()->result(),
				'driver_data' => $this->data_user->getDriver()->result(),
				'wastecat_data' => $this->data_wastecat->get_data()->result()
			);
		} else if ($this->session->userdata('level') == 'driver'){
			$page = 'driverInfo';
			$data = array(
				'user_data' => $this->data_user->get_driverById($this->session->userdata('user_id'))->result()
			);
			$js = array('js' => 'assets/js/driverdashboard.js');
		} else {
			$page = 'personalInfo';
			$js = array('js' => 'assets/js/user.js');
			$data = array(
				'user_data' => $this->data_user->get_userById($this->session->userdata('user_id'))->result()
			);
		}

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view($page, $data);
		$this->load->view('footer');
		$this->load->view('source',$js);
	}

	public function addRequest(){
		$info['datatype'] = 'dashboard';
		$this->load->view('header');

		$dataRequest = array(
			'request_date' => $this->input->post('request_date'),
			'user_id' => $this->session->userdata('user_id'),
			'remarks' => 'request'
		);

		if ($this->data_request->add_request($dataRequest)) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');
	}

	public function getRequest(){
		echo json_encode($this->data_request->get_request()->result());
	}

	public function getRequestDriver(){
		$driverID = $this->session->userdata('user_id');
		echo json_encode($this->data_request->get_requestDriver($driverID)->result());
	}

	public function getUser(){
		echo json_encode($this->data_user->get_userById($this->input->post('userID'))->result());
	}

	public function updateRequest(){
		$data = array(
			'driver_id' => $this->input->post('driver'),
			'truck_id' => $this->input->post('truck'),
			'remarks' => 'pending'
		);

		$info['datatype'] = 'dashboard';

		$this->load->view('header');

		if ($this->data_request->update_request($data, $this->input->post('requestID'))) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');
	}

	public function doneRequest(){
		$data = array(
			'waste_id' => $this->input->post('name_wastecat'),
			'waste_kg' => $this->input->post('wastecat_kg'),
			'date_pickup' => date('Y-m-d'),
			'remarks' => 'done'
		);
		$info['datatype'] = 'dashboard';

		$this->load->view('header');

		if ($this->data_request->update_request($data, $this->input->post('requestID'))) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');
	}

	public function getChartDataReport(){

		$reportArray = $this->chartDataReport($this->input->post('type'), $this->input->post('dataItem'));
		echo json_encode($reportArray);
		
	}

	public function printTable() {
		$this->session->unset_userdata('chartToPrint');
		$this->session->unset_userdata('chartDate');
		$this->session->unset_userdata('chartType');
		$resultWasteToPrint = $this->chartDataReport($this->input->post('type'), $this->input->post('dataItem'));
		$data['chartToPrint'] = $resultWasteToPrint;
		$data['chartDate'] = $this->input->post('dataItem');
		$data['chartType'] = $this->input->post('type');
		$this->session->set_userdata($data);
		echo true;
	}

	public function printPage($page){

		$data['report'] = $this->session->userdata('chartToPrint');
		$data['chartType'] = $this->session->userdata('chartType');
		$data['chartDate'] = $this->session->userdata('chartDate');
		if($page == 'pdf') {
			$this->load->library('pdf');
			$this->pdf->load_view('pdf/dashboardReport', $data);
		} else {
			$this->load->view('print/dashboardReport', $data);
		}

	}

	public function printPdfChart(){

		$reportDate =  $this->uri->segment(3);
		$reportWaste = $this->uri->segment(4);
		$outputType = $this->uri->segment(5);
		$barangayResult = $this->data_user->get_barangay()->result();
		$reportArray = array();

		foreach($barangayResult as $barangay){
			$resultDataReport = $this->data_request->get_chartDataReport($barangay->id, $reportWaste, $reportDate)->result();
			$reportArray[] = array('barangay' => $barangay->id, 'totalWaste' => (int)$resultDataReport[0]->sum_kg);
		}

		if($outputType == 'print'){
			$this->load->view('print/dashboardReport', array('report' => $reportArray));
		} else if ($outputType == 'pdf'){
			$this->load->library('pdf');
			$this->pdf->load_view('pdf/dashboardReport', array('report' => $reportArray));
		}

	}

	public function getListRequestUser(){
		$requestByUser = $this->data_request->get_requestListUser($this->session->userdata('user_id'))->result();
		echo json_encode($requestByUser);
	}

	private function chartDataReport($type, $dataItem){

		$wasteData = $this->data_wastecat->get_data()->result();
		$brgyData = $this->data_user->get_barangay()->result();
		$resultCountWaste = array();
		$queryWhereDate = "";

		if($type == 'daily'){
			$queryWhereDate .= "request.date_pickup = '{$dataItem}'";
		} else if ($type == 'weekly'){
			$queryWhereDate = "request.date_pickup BETWEEN '{$dataItem[0]}' AND '{$dataItem[1]}'";
		} else if ($type == 'monthly'){
			$queryWhereDate = "MONTHNAME(request.date_pickup) = '{$dataItem[0]}' AND YEAR(request.date_pickup) = '{$dataItem[1]}'";
		}

		foreach ($wasteData as $waste){
			$temp = array();
			foreach ($brgyData as $brgy){
				$queryWhere = "request.waste_id = {$waste->wastecat_id} AND UT.brgy = {$brgy->id} AND ";
				$queryWhere .= $queryWhereDate;
				$resultDataReport = $this->data_request->get_chartDataReport($queryWhere)->result();
				$temp[] = array('barangay' => $brgy->id, 'totalWaste' => (int)$resultDataReport[0]->sum_kg);
			}
			array_push($resultCountWaste, $temp);
		}

		return $resultCountWaste;

	}


}
