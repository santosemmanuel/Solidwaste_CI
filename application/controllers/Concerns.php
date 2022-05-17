<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Concerns extends CI_Controller{

	public $userConversation;

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
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('concerns');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function sendConcern(){

		$admin_user = $this->data_user->get_admin()->result();
		date_default_timezone_set('Asia/Manila');
		$dateNow = date('Y-m-d h:i:s');

		if($this->uri->segment(3) == 'user'){
			$info['datatype'] = 'concerns';
			$where = array(
				'sender' => $this->session->userdata('user_id'),
				'message' => $this->input->post('message'),
				'reciever' => $admin_user[0]->user_id,
				'message_date' => $dateNow
			);
		} else {
			$info['datatype'] = 'concerns/concernAdmin';
			$where = array(
				'sender' => $admin_user[0]->user_id,
				'message' => $this->input->post('message'),
				'reciever' => $this->input->post('sendTo'),
				'message_date' => $dateNow
			);
		}

		$this->load->view('header');

		if($this->data_concern->sendConcern($where)){
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');

	}

	public function getConcernList(){
		echo json_encode($this->data_concern->getConcern($this->session->userdata('user_id'))->result());
	}

	public function concernAdmin(){
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('admin/concernadmin');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function concernConversation(){

		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('admin/conversation');
		$this->load->view('footer');
		$this->load->view('source');
		$this->userConversation = $this->uri->segment(3);
	}

	public function getConversationConcern(){
		echo json_encode($this->data_concern->getUserConversation($this->input->post('dataItem'))->result());
	}
}
