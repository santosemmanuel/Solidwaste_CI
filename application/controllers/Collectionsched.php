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
		$this->load->view('admin/collectsched', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}


}