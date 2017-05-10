<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CentresEstudisController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('CentresEstudisModel');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function createTemplate($page, $data){
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view($page, $data);
		$this->load->view('templates/footer');
	}

	public function index($slug = NULL){
		if(!$this->session->username){
			redirect(base_url('login'), 'refresh');
		}

		$data['dades'] = $this->CentresEstudisModel->getRegisters($slug);
		$data['estudis'] = $this->CentresEstudisModel->getAllStudies($slug);
		$data['centre'] = $slug;
		$data['nomcentre'] = $this->CentresEstudisModel->getCenterName($slug);

		$this->createTemplate('CentresEstudisView', $data);
	}

	public function addStudy($centre, $estudi){
		$this->CentresEstudisModel->addStudy($centre, $estudi);
		$this->index($centre);
	}

	public function deleteStudy($centre, $estudi){
		$this->CentresEstudisModel->deleteStudy($centre, $estudi);
		$this->index($centre);
	}

	public function editDataStudy($centre){
		$this->CentresEstudisModel->editDataStudy();
		$this->index($centre);
	}

}
