<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('EditModel');
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

	public function index($table = NULL, $slug = NULL){
		if(!$this->session->username){
            redirect(base_url('login'), 'refresh');
        }

		if($slug === 'save_register'){
			$data['dades'] = $this->EditModel->saveRegister($table);
		} elseif($slug === 'new_register'){
			$this->EditModel->newRegister($table);
			redirect(base_url('admin/'.$table), 'refresh');
		} else {
			$data['dades'] = $this->EditModel->getRegister($table, $slug);
		}

		$data['nomactual'] = $this->setBackButtonText($table);
		$data['table'] = $table;
		$data['columns'] = $this->EditModel->getHeaders($table);
		$data['families'] = $this->EditModel->getAllRegisters('families');

		$this->createTemplate('EditView', $data);
	}

	private function setBackButtonText($table){
		switch ($table) {
			case 'centers':
				return "als centres";
				break;
			case 'families':
				return "a les families";
				break;
			case 'studies':
				return "als estudis";
				break;
			case 'diary':
				return "a l'agenda";
				break;
			case 'contests':
				return "als concursos";
				break;
			case 'news':
				return "a les notícies";
				break;
		}
	}

}
