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
				'driver_data' => $this->data_user->getDriver()->result()
			);
		} else if ($this->session->userdata('level') == 'driver'){
			$page = 'driverInfo';
			$data = array(
				'user_data' => $this->data_user->get_driverById($this->session->userdata('user_id'))->result()
			);
			$js = array('js' => 'assets/js/driverdashboard.js');
		} else {
			$page = 'personalInfo';
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

}
