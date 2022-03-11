<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transac extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		};
		$this->load->library('form_validation');
		$this->load->model('data_transac');
		$this->load->model('data_municipal');
		$this->load->model('data_wastecat');
	}

	public function index()
	{
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$data['data_transac'] = $this->data_transac->get_data()->result();
		$data['data_municipal'] = $this->data_municipal->get_data()->result();
		$data['data_wastecat'] = $this->data_wastecat->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('admin/transac', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'transac';
		$info['operation'] = 'Input';
		
		$municipal_id = $this->input->post('municipal_id');
		$wastecat_id = $this->input->post('wastecat_id');
		$weight = $this->input->post('weight');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		date_default_timezone_set("Asia/Jakarta");
		$transac_id = date('YmdHis');
		$total = $weight * 2;

		$this->load->view('header');

		$where = array(
			'transac_id' => $transac_id
		);
		$records = $this->data_transac->get_records($where)->result();

		if (count($records) == 0) {
			$data = array(
				'transac_id' => $transac_id,
				'municipal_id' => $municipal_id,
				'wastecat_id' => $wastecat_id,
				'weight' => $weight,
				'total' => $total,
				'start_date' => $start_date,
				'end_date' => $end_date
			);
			$action = $this->data_transac->insert_data($data,'transac');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'transac';
		$info['operation'] = 'Ubah';
		
		$transac_id = $this->input->post('transac_id');
		$municipal_id = $this->input->post('municipal_id');
		$wastecat_id = $this->input->post('wastecat_id');
		$weight = $this->input->post('weight');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$total = $weight * 2;

		$this->load->view('header');

		$where = array(
			'transac_id' => $transac_id
		);
		$data = array(
			'transac_id' => $transac_id,
			'municipal_id' => $municipal_id,
			'wastecat_id' => $wastecat_id,
			'weight' => $weight,
			'total' => $total,
			'start_date' => $start_date,
			'end_date' => $end_date
		);
		$action = $this->data_transac->update_data($where, $data,'transac');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

			
		$this->load->view('source');	
	}

	public function done()
	{
		$info['datatype'] = 'transac';
		$info['operation'] = 'Ubah';
		
		$transac_id = $this->uri->segment('3');
		$end_date = date('Y-m-d'); //Tambahkan tgl selesai order

		$action = $this->db->query("update transac set end_date = '$end_date' where transac_id = '$transac_id'");

		$this->load->view('header');
		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}	
		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'transac';

		$transac_id = $this->uri->segment('3');

		$where = array(
			'transac_id' => $transac_id
		);

		$this->load->view('header');

		$action = $this->data_transac->delete_data($where, 'transac');
		if ($action) {
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');
	}

	public function laporan()
	{
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_filter_transac');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_transac'] = $this->data_transac->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_transac', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_transac'] = $this->data_transac->filter($dari, $sampai)->result();
		
		$this->load->view('print/transac', $data);
	}

	function print_nota() {	

		$transac_id = $this->uri->segment('3');

		$where = array(
			'transac_id' => $transaksi_id
		);
		$data['data_transac'] = $this->data_transac->get_full_records($where)->result();
		
		$this->load->view('print/nota_transac', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_transac'] = $this->data_transac->filter($dari, $sampai)->result();
		
		$this->load->view('pdf/transac', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Transaction_Detail.pdf", array('Attachment'=>0));
	}
}
