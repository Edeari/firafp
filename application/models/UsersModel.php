<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getAllUsers(){
		$query = $this->db->get('users');
		$data = $query->result_array();

		$jsondata = json_encode($data);

		return $jsondata;
	}

	public function editUser(){
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		$repass = $this->input->post('repass');

		if($pass === $repass){
			$this->db->set('pass', sha1($pass), TRUE);
			$this->db->where('username', $username);
			$this->db->update('users');
		}
	}

	public function editRole(){
		$username = $this->input->post('username');
		$role = $this->input->post('rol');

		$this->db->set('level', $role);
		$this->db->where('username', $username);
		$this->db->update('users');
	}

	public function deleteUser(){
		$username = $this->input->post('username');

		$this->db->where('username', $username);
		$this->db->delete('users');
	}

	public function addUser(){
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		$repass = $this->input->post('repass');
		$role = $this->input->post('role');

		if($pass === $repass){
			$data = array(
		        'username' => $username,
		        'pass' => sha1($pass),
		        'level' => $role
			);

			$this->db->insert('users', $data);
		}

	}

}
