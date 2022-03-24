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
	}

    public function user(){
        return $user = array(
            'name' => $this->session->userdata('name'),
            'level' => $this->session->userdata('level')
        );
    }

	public function index(){
        $data['adminUsers'] = $this->data_user->get_admin()->result();
        $this->load->view('header');
		$this->load->view('navigation', $this->user());
		$this->load->view('admin/settings', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}
}
