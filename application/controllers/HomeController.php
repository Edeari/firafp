<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->model('HomeModel');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function createTemplate($page, $data){
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view($page, $data);
		$this->load->view('templates/footer');
	}

	public function index(){
		if(!$this->session->username){
            redirect(base_url('login'), 'refresh');
        }
		// $data['dades'] = $this->HomeModel->getTable();
		$data['var'] = "Fira FT";
		$this->createTemplate('HomeView', $data);
	}

}
