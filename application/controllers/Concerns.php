<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Concerns extends CI_Controller{

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model('data_user');
		$this->load->model('data_concern');
	}

	public function index()
	{
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$data['list_concern'] = $this->data_concern->getConcern($this->session->userdata('user_id'))->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('concerns', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function sendConcern(){

		$info['datatype'] = 'dashboard';

		$admin_user = $this->data_user->get_admin()->result();
		$dateNow = date('Y-m-d');

		if($this->uri->segment(3) == 'user'){
			$where = array(
				'sender' => $this->session->userdata('user_id'),
				'message' => $this->input->post('message'),
				'reciever' => $admin_user[0]->user_id,
				'message_date' => $dateNow
			);
		} else {
			$where = array(
				'sender' => $admin_user[0]->user_id,
				'message' => $this->input->post('message'),
				'reciever' => $this->session->userdata('user_id'),
				'message_date' => $dateNow
			);
		}

		$this->load->view('header');

		if($this->data_concern->sendConcern($where)){
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');

	}
}
