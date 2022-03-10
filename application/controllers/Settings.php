<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model('data_user');
        $this->load->helper('array');
		$this->load->library('form_validation');
	}

    public function user(){
        return $user = array(
            'name' => $this->session->userdata('name'),
            'level' => $this->session->userdata('level')
        );
    }

	public function admin(){
        $data['adminUsers'] = $this->data_user->get_admin()->result();
        $this->load->view('header');
		$this->load->view('navigation', $this->user());
		$this->load->view('admin', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function addAdmin(){
		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('firstName', 'First Name', 'required');
			$this->form_validation->set_rules('middleName', 'Middle Name', 'required');
			$this->form_validation->set_rules('lastName', 'Last Name', 'required');
			$this->form_validation->set_rules('userName', 'User Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('reTypePassword', 'Password Confirmation', 'required|matches[password]');
			
			if ($this->form_validation->run() != FALSE) {
				if($this->data_user->save_admin($this->input->post())){
					$data = array('response' => 'success');
				} else {
					$data= array('response' => 'error', 'message' => 'Data Failed');
				}
			} else {
				$data = array('response' => 'error', 'message' => validation_errors());
			}
			echo json_encode($data);
		}
	}

	public function editAdmin(){
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('firstName', 'First Name', 'required');
			$this->form_validation->set_rules('middleName', 'Middle Name', 'required');
			$this->form_validation->set_rules('lastName', 'Last Name', 'required');
			$this->form_validation->set_rules('userName', 'User Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('reTypePassword', 'Password Confirmation', 'required|matches[password]');

			if($this->form_validation->run() != FALSE){
				
			}
		}
	}

	public function deleteAdmin(){

	}

    public function activityLog(){

    }
}
