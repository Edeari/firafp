<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function createTemplate($page, $data){
		$this->load->view('templates/header');
		$this->load->view('templates/menu', $data);
		$this->load->view($page, $data);
		$this->load->view('NewRegisterView', $data);
		$this->load->view('templates/footer');
	}

	public function checkSession(){
		if(!$this->session->username){
            redirect(base_url('login'), 'refresh');
        }
	}

	public function checkRoleLevel(){

	}

	public function index($table = NULL){
		$this->checkSession();

		$data['dades'] = $this->AdminModel->getTable($table);
		$data['columnes'] = $this->AdminModel->getTableHeader($table);
		$data['truecolumnes'] = $this->AdminModel->getTrueTableHeader($table);
		$data['database'] = $table;
		$data['families'] = $this->AdminModel->getTable('families');
		$data['title'] = $this->setTitle($table);
		$this->createTemplate('AdminView', $data);
	}

	public function setTitle($table){
		$pageTitle = null;

		switch ($table) {
			case 'families':
				$pageTitle = "Administrant les famílies";
				break;
			case 'centers':
				$pageTitle = "Administrant els centres";
				break;
			case 'studies':
				$pageTitle = "Administrant els estudis";
				break;
			case 'diary':
				$pageTitle = "Administrant l\'agenda";
				break;
			case 'contets':
				$pageTitle = "Administrant els concursos";
				break;
			case 'news':
				$pageTitle = "Administrant les notícies";
				break;
		}

		return $pageTitle;
	}

	public function deleteRegister($table, $id){
		$this->checkSession();
		if($this->session->level >= 5){
			$this->AdminModel->deleteRegister($table, $id);
		}
		$this->index($table);
	}

}
