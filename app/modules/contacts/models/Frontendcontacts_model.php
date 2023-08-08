<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendContacts_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	public function create(){
		$data = array(
			'title' => $this->input->post('title'),
			'fullname' => $this->input->post('fullname'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'message' => $this->input->post('message'),
			// 'address' => $this->input->post('address'),
			'read' => 0,
			'publish' => 1,
			'receiverid' => 1,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('contacts', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	public function create1(){
		$data = array(
			// 'title' => $this->input->post('title'),
			'fullname' => $this->input->post('fullname'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'message' => $this->input->post('message'),
			'address' => $this->input->post('address'),
			'read' => 0,
			'publish' => 1,
			'receiverid' => 1,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('contacts', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function Create_ar($data = ''){
		$this->db->insert('contacts', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	
	public function create_(){
		$data = array(
			'fullname' => $this->input->post('fullname'),
			'title' => $this->input->post('title'),
			'message' => $this->input->post('message'),
			'read' => 0,
			'publish' => 1,
			'receiverid' => 1,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('contacts', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	
	public function InsertByParam($data =  ''){
		$this->db->insert('contacts', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
}