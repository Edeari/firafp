<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getTable($table){
		$query = $this->db->get($table);
		$data = $query->result_array();

		$jsondata = json_encode($data);

		return $jsondata;
	}

	public function getTableHeader($table){
		$query = $this->db->query('SELECT COLUMN_COMMENT FROM information_schema.COLUMNS WHERE TABLE_NAME = "'.$table.'"');
		$camps = [];

		foreach ($query->result() as $columna) {
        	foreach($columna as $colu){
				array_push($camps, $colu);
			}
		}

		return $camps;
	}

	public function getTrueTableHeader($table){
		$fields = $this->db->list_fields($table);
		return $fields;
	}

	public function deleteRegister($table, $id){
		$this->db->delete($table, array('id' => $id));
	}

}
