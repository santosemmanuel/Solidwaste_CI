<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		if ($this->session->userdata('level') == "user"){
			show_404();
		}
		$this->load->model('data_user');
		$this->load->library('form_validation');
		$this->load->model('data_log');
	}

    public function user(){
        return $user = array(
            'name' => $this->session->userdata('name'),
            'level' => $this->session->userdata('level')
        );
    }

	public function index(){
        $data['activityLog'] = $this->data_log->show_log();
        $this->load->view('header');
		$this->load->view('navigation', $this->user());
		$this->load->view('admin/activitylog', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function getLoggerByDate(){
		$dateLog = $this->input->post('dataWaste');
		$loggerByDate = $this->data_log->getLoggerByDate(date('Y/m/d', strtotime($dateLog)));
		echo json_encode($loggerByDate);
	}

	public function recyclebin(){

		$data['deletedUserList'] = $this->data_user->deleted_UserList()->result();
		$data['deletedDriverList'] = $this->data_user->deleted_DriverList()->result();
		$data['deletedTruckList'] = $this->data_user->deleted_TruckList()->result();

		$this->load->view('header');
		$this->load->view('navigation', $this->user());
		$this->load->view('admin/recyclebin', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function restore_UserDriver(){
		$info['datatype'] = 'settings/recyclebin';

		$user_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_user->restore_item_userDriver($user_id);
		if ($action) {
			$this->data_log->message_log("Admin Restore a User/Driver with an ID of".$user_id);
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');
	}

	public function restore_Truck(){
		$info['datatype'] = 'settings/recyclebin';

		$truck_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_user->restore_item_Truck($truck_id);
		if ($action) {
			$this->data_log->message_log("Admin Restore a Truck with an ID of ",$truck_id);
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');
	}
}
