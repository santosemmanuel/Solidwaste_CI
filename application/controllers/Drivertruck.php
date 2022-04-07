<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Drivertruck extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model('data_user');
		$this->load->library('form_validation');
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
        $this->load->view('header');
		$this->load->view('navigation', $this->user());
		$this->load->view('admin/drivertruck', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function addDriver(){
		if ($this->input->is_ajax_request()) {
			if ($this->driverValidation() != FALSE) {
				if ($this->data_user->saveDriver($this->input->post())) {
					$data = array('response' => 'success');
				} else {
					$data = array('response' => 'error', 'message' => 'Data Failed');
				}
			} else {
				$data = array('response' => 'error', 'message' => validation_errors());
			}
			echo json_encode($data);
		}
	}

	public function delete(){
		$info['datatype'] = 'drivertruck';

		$driver_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_user->deleteDriver($driver_id);
		if ($action) {
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');
	}

	public function editDriver(){
		if ($this->input->is_ajax_request()) {
			if ($this->driverValidation() != FALSE) {
				if ($this->data_user->editDriver($this->input->post())) {
					$data = array('response' => 'success');
				} else {
					$data = array('response' => 'error', 'message' => 'Data Failed');
				}
			} else {
				$data = array('response' => 'error', 'message' => validation_errors());
			}
			echo json_encode($data);
		}
	}

	public function getDriverTruckById(){
		$driverId = $this->input->post('driver');
		$truckId = $this->input->post('truck');
		$collectionId = $this->input->post('collection');
		echo json_encode($this->data_user->getDriverTruckById($driverId, $truckId, $collectionId)->result());
	}

	public function addTruck(){
		if ($this->input->is_ajax_request()) {
			if ($this->truckValidation() != FALSE) {
				if ($this->data_user->addTruck($this->input->post())) {
					$data = array('response' => 'success');
				} else {
					$data = array('response' => 'error', 'message' => 'Data Failed');
				}
			} else {
				$data = array('response' => 'error', 'message' => validation_errors());
			}
			echo json_encode($data);
		}
	}

	public function deleteTruck(){
		$info['datatype'] = 'drivertruck';

		$truck_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_user->deleteTruck($truck_id);
		if ($action) {
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');
	}

	public function editTruck(){
		if ($this->input->is_ajax_request()) {
			if ($this->truckValidation() != FALSE) {
				if ($this->data_user->editTruck($this->input->post())) {
					$data = array('response' => 'success');
				} else {
					$data = array('response' => 'error', 'message' => 'Data Failed');
				}
			} else {
				$data = array('response' => 'error', 'message' => validation_errors());
			}
			echo json_encode($data);
		}
	}

	public function driverValidation(){
		
		$this->form_validation->set_rules('firstName', 'First Name', 'required');
		$this->form_validation->set_rules('middleName', 'Middle Name', 'required');
		$this->form_validation->set_rules('lastName', 'Last Name', 'required');
		$this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required');
		$this->form_validation->set_rules('driversLicense', 'Drivers License', 'required');
		$this->form_validation->set_rules('address', 'Street', 'required');
		$this->form_validation->set_rules('userName', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('reTypePassword', 'Password Confirmation', 'required|matches[password]');

		return $this->form_validation->run();
	}

	public function truckValidation(){
		
		$this->form_validation->set_rules('plateNumber', 'Plate Number', 'required');
		$this->form_validation->set_rules('truckModel', 'Truck Model', 'required');
		$this->form_validation->set_rules('truckColor', 'Truck Color', 'required');
		
		return $this->form_validation->run();
	}
}
