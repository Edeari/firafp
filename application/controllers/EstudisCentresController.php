<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstudisCentresController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('EstudisCentresModel');
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

	public function checkSession(){
		if(!$this->session->username){
            redirect(base_url('login'), 'refresh');
        }
	}

	public function index($slug = NULL){
		$this->checkSession();

		$data['dades'] = $this->EstudisCentresModel->getRegisters($slug);
		$data['centres'] = $this->EstudisCentresModel->getAllCenters($slug);
		$data['estudi'] = $slug;
		$data['nomestudi'] = $this->EstudisCentresModel->getStudyName($slug);

		$this->createTemplate('EstudisCentresView', $data);
	}

	public function addStudy($centre, $estudi){
		$this->checkSession();
		$this->EstudisCentresModel->addStudy($centre, $estudi);
		$this->index($centre);
	}

	public function deleteStudy($estudi, $centre){
		$this->checkSession();
		if($this->session->level >= 5){
			$this->EstudisCentresModel->deleteStudy($centre, $estudi);
		}
		$this->index($estudi);
	}

	public function editDataStudy($centre){
		$this->checkSession();
		$this->EstudisCentresModel->editDataStudy();
		$this->index($centre);
	}

	public function addAllCenters($estudi){
		$this->checkSession();
		$this->EstudisCentresModel->addAllCenters($estudi);
		$this->index($estudi);
	}

}
