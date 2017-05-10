<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getRegister($table, $slug){
		$query = $this->db->get_where($table, array('id' => $slug));
		$result = $query->result_array();

		return $result;
	}

	public function saveRegister($table){
		$posts = $this->input->post();
		foreach ($posts as $key => $value) {
			if($key != 'save_button'){
				$data[$key] = $value;
			}
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update($table, $data);
		return true;
	}

	public function newRegister($table){
		$posts = $this->input->post();
		foreach ($posts as $key => $value) {
			if($key != 'save_button'){
				$data[$key] = $value;
			}
		}

		$this->db->insert($table, $data);
		return true;
	}

	public function getHeaders($table){
		$query = $this->db->query('SELECT COLUMN_COMMENT FROM information_schema.COLUMNS WHERE TABLE_NAME = "'.$table.'"');
		$camps = [];

		foreach ($query->result() as $columna) {
        	foreach($columna as $colu){
				array_push($camps, $colu);
			}
		}

		return $camps;
	}

	public function getAllRegisters($taula){
		$query = $this->db->get($taula);
		$data = $query->result_array();

		$jsondata = json_encode($data);

		return $jsondata;
	}

}
