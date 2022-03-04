<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->model('data_wastecat');
		$this->load->model('data_municipal');
		$this->load->model('data_transac');
		$this->load->model('data_expend');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');

		$total_pendapatan = $this->data_transac->total_income_year();
		$total_expend = $this->data_expend->total_spend_year();
		$total_keuntungan = $total_pendapatan - $total_expend;
		$data = array(
					'n_wastecat' => $this->data_wastecat->count_rows(),
					'n_municipal' => $this->data_municipal->count_rows(),
					'n_transac' => $this->data_transac->count_rows(),
					'n_transac_aktif' => $this->data_transac->count_active(),
					'total_pendapatan' => $total_pendapatan ,
					'total_expend' => $total_expend,
					'total_keuntungan' => $total_keuntungan
				);

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('dashboard', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}
}
