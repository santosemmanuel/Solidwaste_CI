<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wastecat extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		};
		$this->load->library('form_validation');
		$this->load->model('data_wastecat');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$data['data_wastecat'] = $this->data_wastecat->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('wastecat', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'wastecat';
		$info['operation'] = 'Input';
		
		$wastecat_id = $this->input->post('wastecat_id');
		$name_wastecat = $this->input->post('name_wastecat');
		$col_day = $this->input->post('col_day');
		$spec = $this->input->post('spec');
		$source = $this->input->post('source');
		$col_fees = $this->input->post('col_fees');
		$col_date = $this->input->post('col_date');
		$fin_date = $this->input->post('fin_date');

		$aktif = 0;

		if ($fin_date == null) {
			$aktif = 1;
		}

		$this->load->view('header');

		$records = $this->data_wastecat->get_records($wastecat_id)->result();
		if (count($records) == 0) {
			$data = array(
				'wastecat_id' => $wastecat_id,
				'name_wastecat' => $name_wastecat,
				'col_day' => $col_day,
				'spec' => $spec,
				'source' => $source,
				'col_fees' => $col_fees,
				'col_date' => $col_date,
				'fin_date' => $fin_date,
				'aktif' => $aktif
			);
			$aktif = $this->data_wastecat->insert_data($data,'wastecat');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'wastecat';
		$info['operation'] = 'Ubah';
		
		$wastecat_id = $this->input->post('wastecat_id');
		$name_wastecat = $this->input->post('name_wastecat');
		$col_day = $this->input->post('col_day');
		$spec = $this->input->post('spec');
		$source = $this->input->post('source');
		$col_fees = $this->input->post('col_fees');
		$col_date = $this->input->post('col_date');
		$fin_date = $this->input->post('fin_date');

		$aktif = 0;

		if ($fin_date == null) {
			$aktif = 1;
		}

		$this->load->view('header');

		$data = array(
			'wastecat_id' => $wastecat_id,
			'name_wastecat' => $name_wastecat,
			'col_day' => $col_day,
			'spec' => $spec,
			'source' => $source,
			'col_fees' => $col_fees,
			'col_date' => $col_date,
			'fin_date' => $fin_date,
			'aktif' => $aktif
		);
		$action = $this->data_wastecat->update_data($wastecat_id, $data,'wastecat');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'wastecat';

		$wastecat_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_wastecat->delete_data($wastecat_id, 'wastecat');
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
		$this->load->view('laporan/laporan_filter_wastecat');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_wastecat'] = $this->data_wastecat->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_wastecat', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_wastecat'] = $this->data_wastecat->filter($dari, $sampai)->result();
		
		$this->load->view('print/wastecat', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_wastecat'] = $this->data_wastecat->filter($dari, $sampai)->result();
		
		$this->load->view('pdf/wastecat', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Wastecategory_Data.pdf", array('Attachment'=>0));
	}
}
