<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersection extends CI_Controller {

	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model("data_usersection");
		$this->load->model("data_user");
		$this->load->model("data_log");
	}

	public function index(){
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$data['data_usersection'] = $this->data_usersection->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('admin/usersection', $data);
		$this->load->view('footer');
		$this->load->view('source', array('js' => null));
	}

	public function edit(){
		$user = $this->uri->segment('4');
		if(isset($user)){
			$info['datatype'] = 'dashboard';
			$info['operation'] = 'Ubah';
		} else {
			$info['datatype'] = 'usersection';
			$info['operation'] = 'Ubah';
		}

		$user_id = $this->uri->segment('3');
		$firstName = $this->input->post('firstName');
		$middleName = $this->input->post('middleName');
		$lastName = $this->input->post('lastName');
		$contactNumber = $this->input->post('contactNumber');
		$username = $this->input->post('userName');
		$password = $this->input->post('password');
		$realEstate = $this->input->post('realEstate');
		$barangay = $this->input->post('barangay');
		$address = $this->input->post('address');
		$coordinate = $this->input->post('coordinate');

		if($this->input->post('businessName') != ""){ $businessName = $this->input->post('businessName'); } else { $businessName = "null"; };
		if($this->input->post('businessType') != ""){ $businessType = $this->input->post('businessType'); } else { $businessType = "null"; };
		if($this->input->post('businessPermit') != ""){ $businessPermit = $this->input->post('businessPermit'); } else { $businessPermit = "null"; };

		$data = array(
			'firstName' => $firstName,
			'middleName' => $middleName,
			'lastName' => $lastName,
			'username' => $username,
			'password' => base64_encode($password),
			'level' => 'user'
		);

		$data_info = array(
			'phoneNumber' => $contactNumber,
			'businessName' => $businessName,
			'businessType' => $businessType,
			'permitNumber' => $businessPermit,
			'realEstate' => $realEstate,
			'brgy' => $barangay,
			'street' => $address,
			'location' => $coordinate
		);

		$user_action = $this->data_user->update_data(array('user_id' => $user_id), $data,'user');
		$user_info_action = $this->data_user->update_data(array('user_info_id' => $user_id), $data_info, 'user_info');

		$this->load->view('header');

		if ($user_action && $user_info_action) {
			if($this->session->userdata('level') == 'admin'){
				$this->data_log->message_log("Admin Edit a User");
			}
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');
	}

	public function delete()
	{
		$info['datatype'] = 'usersection';

		$user_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_user->delete_UserDriver($user_id);
		if ($action) {
			if($this->session->userdata('level') == 'admin'){
				$this->data_log->message_log("Admin Deleted a User");
			}
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');
	}

	public function deletePersonal(){
		$user_id = $this->uri->segment('3');
		$action  = $this->data_usersection->delete_data($user_id);
		if($action){
			redirect(base_url().'welcome/logout');
		}
	}

	function get_ajaxData(){
		echo json_encode($this->data_usersection->get_data()->result());
	}


}
