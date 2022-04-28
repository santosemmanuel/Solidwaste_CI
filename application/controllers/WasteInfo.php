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
}
