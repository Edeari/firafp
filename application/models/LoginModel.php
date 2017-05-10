<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

    public function check_login($username, $pass){
        $query = $this->db->get_where('users', array('username' => $username));
        $user = $query->row_array();

        if($user['pass'] == $pass && $user!=NULL){
            return true;
        } else {
            return false;
        }
    }



}
