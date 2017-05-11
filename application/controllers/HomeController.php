<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function createTemplate($page, $data){
		$this->load->view('templates/header');
		$this->load->view($page, $data);
		$this->load->view('templates/footer');
	}

	public function changePass(){
		if($this->HomeModel->checkPass()){
			$this->HomeModel->changePass();
			$this->logout();
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		$this->createTemplate('ChangePassView', $data);
	}

	public function index(){
		if(!$this->session->username){
            redirect(base_url('login'), 'refresh');
        }
		// $data['dades'] = $this->HomeModel->getTable();
		$data['var'] = "Fira FT";
		$this->createTemplate('HomeView', $data);
	}

	public function logout(){
        $session_data = array('username', 'pass');
        $this->session->unset_userdata($session_data);
    }

}
