<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function checkPass(){
		$pass = $this->input->post('newpass');
		$repass = $this->input->post('newpass2');
		$currentpass = sha1($this->input->post('actualpass'));

		$query = $this->db->query("SELECT pass FROM users WHERE username='".$this->session->username."'");
		$queryPass = $query->row_array();
		$queryPass = $queryPass['pass'];

		if($pass === $repass){
			if($currentpass === $queryPass){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function changePass(){
		$this->db->where('username', $this->session->username);

		$data = array(
			'pass' => sha1($this->input->post('newpass'))
		);

		$this->db->update('users', $data);
	}

}
