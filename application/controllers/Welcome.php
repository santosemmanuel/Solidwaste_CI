<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->load->model('data_user');
		$this->load->library('form_validation');
	}
	
	function index() {
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('source', array('js'	 => ''));
	}

	function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		if($this->form_validation->run() != false){
			$where = array(
						'username' => $username,
						'password' => base64_encode($password)
					);
			$data = $this->data_user->get_records($where);
			$d = $this->data_user->get_records($where)->row();
			$cek = $data->num_rows();
			if($cek > 0){
				$session = array(
							'user_id'=> $d->user_id,
							'name' => $d->firstName,
							'username'=> $d->username,
							'level'=> $d->level,
							'status' => 'login'
						   );
			$this->session->set_userdata($session);
			redirect(base_url().'dashboard');
			} else {
				redirect(base_url().'welcome?pesan=gagal');
			}
		} else {
			$this->index();
		}
	}

	function signUp(){

		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('firstName', 'First Name', 'required');
			$this->form_validation->set_rules('middleName', 'Middle Name', 'required');
			$this->form_validation->set_rules('lastName', 'Last Name', 'required');
			$this->form_validation->set_rules('contactNumber', 'Contact Number', 'required');
			$this->form_validation->set_rules('userName', 'User Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('reTypePassword', 'Password Confirmation', 'required|matches[password]');
			if ($this->input->post('realEstate') != 'residential') {
				$this->form_validation->set_rules('businessName', 'Business Name', 'required');
				$this->form_validation->set_rules('businessPermit', 'Business Permit Number', 'required');
			}
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('coordinates', 'Location on the Map', 'required');
		
			if ($this->form_validation->run() != FALSE) {
				if($this->data_user->save_user_data($this->input->post())){
					$data = array('response' => 'success');
				} else {
					$data= array('response' => 'error', 'message' => 'Data Failed');
				}
				
			} else {
				$data = array('response' => 'error', 'message' => validation_errors());
			}

		} else {
			echo "No direct script access allowed";
		}
		echo json_encode($data);
	}

	function logout(){
		$this->session->sess_destroy();
		$this->load->view('header');
		$this->load->view('notifications/logout_success');
		$this->load->view('source',array('js'=>''));
	}
}
