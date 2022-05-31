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
		$this->load->view('source', array('js'=> null));
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
		$this->session->unset_userdata('chartDate');
		$this->session->unset_userdata('chartType');
		$resultWasteToPrint = $this->wasteReport($this->input->post('type'), $this->input->post('dataItem'));
		$data['wasteToPrint'] = $resultWasteToPrint;
		$data['chartDate'] = $this->input->post('dataItem');
		$data['chartType'] = $this->input->post('type');
		$this->session->set_userdata($data);
		echo true;
	}

	public function printPage($page){

		$data['printWaste'] = $this->session->userdata('wasteToPrint');
		$data['chartType'] = $this->session->userdata('chartType');
		$data['chartDate'] = $this->session->userdata('chartDate');

		if($page == 'pdf') {
			$this->load->library('pdf');
			$this->pdf->load_view('pdf/wastecat', $data);
		} else {
			$this->load->view('print/wastecat', $data);
		}
	}

}
