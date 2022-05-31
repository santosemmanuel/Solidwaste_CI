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
		$this->data_concern->unNotifyConcern($this->session->userdata('user_id'), 1);
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
				'message_date' => $dateNow,
				'notify' => 1
			);
		} else {
			$info['datatype'] = 'concerns/concernAdmin';
			$where = array(
				'sender' => $admin_user[0]->user_id,
				'message' => $this->input->post('message'),
				'reciever' => $this->input->post('sendTo'),
				'message_date' => $dateNow,
				'notify' => 1
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
		$userConversation = $this->data_concern->getConcern($this->session->userdata('user_id'))->result();
		$concernUser = array();
		foreach($userConversation as $user){
			$resultCount = $this->data_concern
				->getConcernCountByUser((int)$user->user_id, $this->session->userdata('user_id'))
				->result();
			array_push($concernUser, array($user,(int)$resultCount[0]->notification));
		}
		echo json_encode($concernUser);
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
		$this->data_concern->unNotifyConcern($this->session->userdata('user_id'), $this->uri->segment(3));
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
		if($this->session->userdata('level') != 'admin'){
			echo json_encode($this->data_concern->getUserConversation($this->input->post('dataItem'), 1)->result());
		} else {
			echo json_encode($this->data_concern->getUserConversation(1, $this->input->post('dataItem'))->result());
		}
	}

	public function deleteConcern(){
		$user_id = $this->session->userdata('user_id');
		$concern_id = $this->uri->segment(3);

		$result = $this->data_concern->deleteConversation($concern_id, $user_id);
		$this->checkConcernToBeDelete($concern_id);

		$info['datatype'] = ($this->session->userdata('level') == 'admin')? "concerns/concernAdmin" : "concerns";
		$this->load->view('header');

		if($result){
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');

	}

	private function checkConcernToBeDelete($concern_id){
		$confirmDelete = $this->data_concern->checkDelete($concern_id)->result();
		if ($confirmDelete[0]->deleteConfirm == 1){
			$this->data_concern->deleteConcern($concern_id);
		}
	}

	public function getNotifyConcern(){
		echo json_encode($this->data_concern->getConcernCount($this->session->userdata('user_id'))->result());
	}

	public function deleteUserConcern(){
		$adminID = $this->session->userdata('user_id');
		$userID = $this->input->post('deleteConcernID');
		$resultUpdate = $this->data_concern->deleteConcernID($adminID, $userID);
		$info['datatype'] = "concerns/concernAdmin";
		$this->load->view('header');

		if($resultUpdate){
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');
	}
}
