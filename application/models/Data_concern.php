<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_concern extends CI_Model {

	public function SendConcern($where){
		return $this->db->insert('concern', $where);
	}

	public function getConcern($userID){
		return $this->db->query("SELECT DISTINCT * FROM user INNER JOIN (SELECT IF(con.sender = 1, con.reciever, con.sender) 
								AS userID FROM ( SELECT DISTINCT sender, reciever FROM concern WHERE sender=1 AND 
								delete_sender = 0 OR reciever = 1 AND delete_receiver = 0) AS con) AS SEND ON 
								SEND.userID = user.user_id;");
	}

	public function getConcernCount($userID)
	{
		return $this->db->query("SELECT COUNT(notify) AS notification FROM `concern` WHERE reciever = {$userID} AND notify = 1");
	}

	public function getConcernCountByUser($reciever, $sender){
		return $this->db->query("SELECT COUNT(CON.notify) AS notification FROM (SELECT * FROM concern WHERE sender = {$reciever} 
								AND reciever = {$sender}) AS CON WHERE CON.notify = 1");
	}

	public function getUserConversation($sender, $reciever){
		return $this->db->query("SELECT * FROM (SELECT * FROM concern WHERE sender = {$reciever} or reciever = {$reciever}) 
					AS CON INNER JOIN user ON CON.sender = user.user_id  WHERE IF (CON.sender = {$sender}, CON.delete_sender = 0, CON.delete_sender) OR 
					IF(CON.reciever = {$sender}, CON.delete_receiver = 0, CON.delete_receiver) ORDER BY CON.message_date DESC;");
	}

	public function deleteConversation($concer_id, $user_id){
		return $this->db->query("UPDATE concern SET delete_receiver = IF(reciever = {$user_id}, 1, delete_receiver), 
								delete_sender = IF(sender = {$user_id}, 1, delete_sender) WHERE concern_id = {$concer_id}");
	}

	public function checkDelete($concern_id){
		return $this->db->query("SELECT IF(delete_receiver = 1 AND delete_sender = 1, 1, 0) AS deleteConfirm
								FROM concern WHERE concern_id = {$concern_id}");
	}

	public function deleteConcern($concern_id){
		$this->db->where('concern_id', $concern_id);
		return $this->db->delete('concern');
	}
	
	public function unNotifyConcern($reciever, $sender){
		$this->db->set('notify', 0);
		$this->db->where(array('reciever'=>$reciever, 'sender'=>$sender));
		$this->db->update('concern');
	}

	public function deleteConcernID($admin, $user){
		return $this->db->query("UPDATE concern SET delete_sender = IF(sender = {$admin}, 1, 0), 
								delete_receiver = IF(reciever = {$admin}, 1, 0) WHERE sender = {$admin} OR reciever = {$admin} 
								AND sender = {$user} OR reciever = {$user};");
	}

}
