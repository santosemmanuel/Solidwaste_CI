<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_log extends CI_Model {

	public function message_log($message){
		$logfile = null;
		if(!file_exists(APPPATH."logs\log_file.txt")){
			$logfile = fopen(APPPATH.'logs\log_file.txt', 'w');
		} else {
			$logfile = fopen(APPPATH.'logs\log_file.txt', 'a') or die("Unable to open file!");
		}
		date_default_timezone_set('Asia/Manila');
		$dateTime = date("Y/m/d-h:i:sa");
		$data = $dateTime.",".$message."\n";
		fwrite($logfile, $data);
		fclose($logfile);
	}

	public function show_log(){
		$logFile = fopen(APPPATH.'logs\log_file.txt', 'r') or die ("Unable to open file!");
		$arrayLog = array();
		while(!feof($logFile)){
			$chunk = explode(",", fgets($logFile));
			if (!empty($chunk[0])) {
				array_push($arrayLog, array('date_log' => $chunk[0], 'message_log' => $chunk[1]));
			}
		}
		fclose($logFile);
		return $arrayLog;
	}

	public function getLoggerByDate($dateLog){
		$logFile = fopen(APPPATH.'logs\log_file.txt', 'r') or die ("Unable to open file!");
		$arrayLog = array();
		while(!feof($logFile)){
			$chunk = explode(",", fgets($logFile));
			if (!empty($chunk[0])) {
				$getdate  = explode('-', $chunk[0]);
				if($getdate[0] == $dateLog){
					array_push($arrayLog, array('date_log' => $chunk[0], 'message_log' => $chunk[1]));
				}
			}
		}
		fclose($logFile);
		return $arrayLog;
	}
}
