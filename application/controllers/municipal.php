<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Municipal extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->library('form_validation');
		$this->load->model('data_municipal');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$data['data_municipal'] = $this->data_municipal->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('municipal', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'municipal';
		$info['operation'] = 'Input';
		
		$municipal_id = $this->input->post('municipal_id');
		$name_municipal = $this->input->post('name_municipal');
		$zipcode = $this->input->post('zipcode');
		$province = $this->input->post('province');
		$barangay = $this->input->post('barangay');

		$this->load->view('header');

		$records = $this->data_municipal->get_records($municipal_id)->result();
		if (count($records) == 0) {
			$data = array(
				'municipal_id' => $municipal_id,
				'name_municipal' => $name_municipal,
				'zipcode' => $zipcode,
				'province' => $province,
				'barangay' => $barangay
			);
			$action = $this->data_municipal->insert_data($data,'municipal');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'municipal';
		$info['operation'] = 'Ubah';
		
		$municipal_id = $this->input->post('municipal_id');
		$name_municipal = $this->input->post('name_municipal');
		$zipcode = $this->input->post('zipcode');
		$province = $this->input->post('province');
		$barangay = $this->input->post('barangay');

		$this->load->view('header');

		$data = array(
			'municipal_id' => $municipal_id,
			'name_municipal' => $name_municipal,
			'zipcode' => $zipcode,
			'province' => $province,
			'barangay' => $barangay
		);
		$action = $this->data_municipal->update_data($municipal_id, $data,'municipal');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'municipal';

		$municipal_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_municipal->delete_data($municipal_id, 'municipal');
		if ($action) {
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');
	}

	public function laporan()
	{
		$user['username'] = $this->session->userdata('username');
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_filter_municipal');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');
		
		$zipcode = $this->input->post('zipcode');

		if ($zipcode == "Semua") {
			$data['data_municipal'] = $this->data_municipal->get_data()->result();
		} else {
			$data['data_municipal'] = $this->db->query("select * from municipal where zipcode = '$zipcode'")->result();
		}

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_municipal', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$zipcode = $this->uri->segment('3');

		$data['zipcode'] = $zipcode;
		if ($zipcode == "Semua") {
			$data['data_municipal'] = $this->data_municipal->get_data()->result();
		} else {
			$data['data_municipal'] = $this->db->query("select * from municipal where zipcode = '$zipcode'")->result();
		}
		
		$this->load->view('print/municipal', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$zipcode = $this->uri->segment('3');

		$data['zipcode'] = $zipcode;
		if ($zipcode == "Semua") {
			$data['data_municipal'] = $this->data_municipal->get_data()->result();
		} else {
			$data['data_municipal'] = $this->db->query("select * from municipal where zipcode = '$zipcode
				'")->result();
		}
		
		$this->load->view('pdf/municipal', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Municipal_Data.pdf", array('Attachment'=>0));
	}
}
