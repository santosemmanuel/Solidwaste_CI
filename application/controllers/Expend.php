<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expend extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->library('form_validation');
		$this->load->model('data_expend');
		$this->load->model('data_wastecat');
	}

	public function index()
	{
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);	
		$data['data_expend'] = $this->data_expend->get_data()->result();
		$data['data_wastecat'] = $this->data_wastecat->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('admin/expend', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'expend';
		$info['operation'] = 'Input';
		
		$detail = $this->input->post('detail');
		$total = $this->input->post('total');
		$start_expend = $this->input->post('start_expend');
		$wastecat_id = $this->input->post('wastecat_id');

		$expend_id = date('YmdHis');

		$this->load->view('header');

		$where = array(
			'expend_id' => $expend_id
		);
		$records = $this->data_expend->get_records($where)->result();

		if (count($records) == 0) {
			$data = array(
				'expend_id' => $expend_id,				
				'detail' => $detail,
				'total' => $total,
				'start_expend' => $start_expend,
				'wastecat_id' => $wastecat_id
			);
			$action = $this->data_expend->insert_data($data,'expend');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function bayar_gaji()
	{
		$info['datatype'] = 'expend';
		$info['operation'] = 'Input';

		$detail = 'Waste Category  '.date('F Y');
		$total = $this->data_expend->total_gaji();;
		$start_expend = date('Y-m-d');
		$wastecat_id = 'K000'; //Bu Rindu

		$expend_id = date('YmdHis');

		$this->load->view('header');

		$where = array(
			'expend_id' => $expend_id
		);
		$records = $this->data_expend->get_records($where)->result();

		if (count($records) == 0) {
			$data = array(
				'expend_id' => $expend_id,				
				'detail' => $detail,
				'total' => $total,
				'start_expend' => $start_expend,
				'wastecat_id' => $wastecat_id
			);
			$action = $this->data_expend->insert_data($data,'expend');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'expend';
		$info['operation'] = 'Ubah';
		
		$expend_id = $this->input->post('expend_id');
		$detail = $this->input->post('detail');
		$total = $this->input->post('total');
		$start_expend = $this->input->post('start_expend');
		$wastecat_id = $this->input->post('wastecat_id');

		$this->load->view('header');

		$where = array(
			'expend_id' => $expend_id
		);
		$data = array(
			'expend_id' => $expend_id,				
			'detail' => $detail,
			'total' => $total,
			'start_expend' => $start_expend,
			'wastecat_id' => $wastecat_id
		);
		$action = $this->data_expend->update_data($where, $data,'expend');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

			
		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'expend';

		$expend_id = $this->uri->segment('3');

		$where = array(
			'expend_id' => $expend_id
		);

		$this->load->view('header');

		$action = $this->data_expend->delete_data($where, 'expend');
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
		$this->load->view('laporan/laporan_filter_expend');
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

		$data['data_expend'] = $this->data_expend->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_expend', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_expend'] = $this->data_expend->filter($dari, $sampai)->result();
		
		$this->load->view('print/expend', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_expend'] = $this->data_expend->filter($dari, $sampai)->result();
		
		$this->load->view('pdf/expend', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Expenditure_Data.pdf", array('Attachment'=>0));
	}
}
