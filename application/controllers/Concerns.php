<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Concerns extends CI_Controller{

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
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('concerns');
		$this->load->view('footer');
		$this->load->view('source');
	}
}