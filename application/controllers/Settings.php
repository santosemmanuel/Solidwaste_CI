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
}
