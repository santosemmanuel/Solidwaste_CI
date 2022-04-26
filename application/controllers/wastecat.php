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
		$user = array(
			'name' => $this->session->userdata('name'),
			'level' => $this->session->userdata('level')
		);
		$data['data_wastecat'] = $this->data_wastecat->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('admin/wastecat', $data);
		$this->load->view('footer');
		$this->load->view('source', array('js'=>''));
	}

	private function wasteReport($type, $dataItem){

		$wasteCat = $this->data_wastecat->get_data()->result();
		$resultCountWaste = array();

		if($type == 'daily'){

			$stringdate = new DateTime($dataItem);
			array_push($resultCountWaste, $stringdate->format('F d Y'));

			foreach ($wasteCat as $category){
				$data = array('date_pickup' => $dataItem,
					'waste_id' => $category->wastecat_id, 'remarks'=> 'done');
				$resultwaste = $this->data_wastecat->getDailyWaste($data)->result();
				array_push($resultCountWaste, (int)$resultwaste[0]->total_kg);
			}

		} else if ($type == 'weekly'){

			$dateWeek = $dataItem;
			$startDate = new DateTime($dateWeek[0]);
			$endDate = new DateTime($dateWeek[1]);
			array_push($resultCountWaste, $startDate->format('F d Y')."-".$endDate->format('F d Y'));

			foreach ($wasteCat as $category){
				$where = "date_pickup BETWEEN '{$dateWeek[0]}' AND '{$dateWeek[1]}' AND waste_id = {$category->wastecat_id} AND remarks = 'done'";
				$resultwaste = $this->data_wastecat->getDailyWaste($where)->result();
				array_push($resultCountWaste, (int)$resultwaste[0]->total_kg);
			}

		} else if ($type == 'monthly'){

			$monthReport = $dataItem;
			array_push($resultCountWaste, $monthReport[0]);

			foreach ($wasteCat as $category){
				$data = array('MONTHNAME(date_pickup)' => $monthReport[0],
					'waste_id' => $category->wastecat_id, 'remarks'=> 'done', 'YEAR(date_pickup)' => $monthReport[1]);
				$resultwaste = $this->data_wastecat->getDailyWaste($data)->result();
				array_push($resultCountWaste, (int)$resultwaste[0]->total_kg);
			}

		}

		array_push($resultCountWaste, array_sum($resultCountWaste));

		return $resultCountWaste;
	}

	public function getWasteReport(){

		$resultWaste = $this->wasteReport($this->input->post('type'), $this->input->post('dataItem'));
		echo json_encode($resultWaste);

	}

	public function printTable() {
		$this->session->unset_userdata('wasteToPrint');
		$resultWasteToPrint = $this->wasteReport($this->input->post('type'), $this->input->post('dataItem'));
		$data['wasteToPrint'] = $resultWasteToPrint;
		$this->session->set_userdata($data);
		echo true;
	}

	public function printPage($page){

		$data['printWaste'] = $this->session->userdata('wasteToPrint');

		if($page == 'pdf') {
			$this->load->library('pdf');
			$this->pdf->load_view('pdf/wastecat', $data);
		} else {
			$this->load->view('print/wastecat', $data);
		}
	}

//	public function add()
//	{
//		$info['datatype'] = 'wastecat';
//		$info['operation'] = 'Input';
//
//		$wastecat_id = $this->input->post('wastecat_id');
//		$name_wastecat = $this->input->post('name_wastecat');
//		$col_day = $this->input->post('wastecat_day');
//		$col_date = $this->input->post('wastecat_date');
//		$spec = $this->input->post('spec');
//		$fin_date = $this->input->post('fin_date');
//		$col_kg = $this->input->post('wastecat_kg');
//
//		$aktif = 0;
//
//		if ($fin_date == null) {
//			$aktif = 1;
//		}
//
//		$this->load->view('header');
//
//		$records = $this->data_wastecat->get_records($wastecat_id)->result();
//		if (count($records) == 0) {
//			$data = array(
//				'wastecat_id' => $wastecat_id,
//				'name_wastecat' => $name_wastecat,
//				'col_day' => $col_day,
//				'spec' => $spec,
//				'col_date' => $col_date,
//				'collection_kg' => $col_kg,
//				'aktif' => $aktif
//			);
//			$aktif = $this->data_wastecat->insert_data($data,'wastecat');
//			$this->load->view('notifications/insert_success', $info);
//		} else {
//			$this->load->view('notifications/insert_failed', $info);
//		}
//		$this->load->view('source');
//	}

//	public function edit()
//	{
//		$info['datatype'] = 'wastecat';
//		$info['operation'] = 'Ubah';
//
//		$wastecat_id = $this->input->post('wastecat_id');
//		$name_wastecat = $this->input->post('name_wastecat');
//		$col_day = $this->input->post('wastecat_day');
//		$col_date = $this->input->post('wastecat_date');
//		$spec = $this->input->post('spec');
//		$fin_date = $this->input->post('fin_date');
//		$col_kg = $this->input->post('wastecat_kg');
//
//		$aktif = 0;
//
//		if ($fin_date == null) {
//			$aktif = 1;
//		}
//
//		$this->load->view('header');
//
//		$data = array(
//			'wastecat_id' => $wastecat_id,
//			'name_wastecat' => $name_wastecat,
//			'col_day' => $col_day,
//			'spec' => $spec,
//			'col_date' => $col_date,
//			'collection_kg' => $col_kg,
//			'aktif' => $aktif
//		);
//		$action = $this->data_wastecat->update_data($wastecat_id, $data,'wastecat');
//
//		if ($action) {
//			$this->load->view('notifications/insert_success', $info);
//		} else {
//			$this->load->view('notifications/insert_failed', $info);
//		}
//
//		$this->load->view('source');
//	}

//	public function delete()
//	{
//		$info['datatype'] = 'wastecat';
//
//		$wastecat_id = $this->uri->segment('3');
//
//		$this->load->view('header');
//
//		$action = $this->data_wastecat->delete_data($wastecat_id, 'wastecat');
//		if ($action) {
//			$this->load->view('notifications/delete_success', $info);
//		} else {
//			$this->load->view('notifications/delete_failed', $info);
//		}
//
//		$this->load->view('source');
//	}
//
//	public function laporan()
//	{
//		$user = array(
//			'name' => $this->session->userdata('name'),
//			'level' => $this->session->userdata('level')
//		);
//		$this->load->view('header');
//		$this->load->view('navigation', $user);
//		$this->load->view('laporan/laporan_filter_wastecat');
//		$this->load->view('footer');
//		$this->load->view('source');
//	}
//
//	public function laporan_filter()
//	{
//		$user = array(
//			'name' => $this->session->userdata('name'),
//			'level' => $this->session->userdata('level')
//		);
//
//		$dari = $this->input->post('dari');
//		$sampai = $this->input->post('sampai');
//
//		$data['data_wastecat'] = $this->data_wastecat->filter($dari, $sampai)->result();
//
//		$this->load->view('header');
//		$this->load->view('navigation', $user);
//		$this->load->view('laporan/laporan_wastecat', $data);
//		$this->load->view('footer');
//		$this->load->view('source');
//	}
//
//	function print() {
//
//		$dari = $this->uri->segment('3');
//		$sampai = $this->uri->segment('4');
//
//		$data['dari'] = $dari;
//		$data['sampai'] = $sampai;
//		$data['data_wastecat'] = $this->data_wastecat->filter($dari, $sampai)->result();
//
//		$this->load->view('print/wastecat', $data);
//	}
//
//	function cetak_pdf() {
//		$this->load->library('dompdf_gen');
//
//		$dari = $this->uri->segment('3');
//		$sampai = $this->uri->segment('4');
//
//		$data['dari'] = $dari;
//		$data['sampai'] = $sampai;
//		$data['data_wastecat'] = $this->data_wastecat->filter($dari, $sampai)->result();
//
//		$this->load->view('pdf/wastecat', $data);
//
//		$paper_size = 'A4';
//		$orientation = 'landscape';
//		$html = $this->output->get_output();
//		$this->dompdf->set_paper($paper_size, $orientation);
//
//		$this->dompdf->load_html($html);
//		$this->dompdf->render();
//		$this->dompdf->stream("Wastecategory_Data.pdf", array('Attachment'=>0));
//	}
}
