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
		$this->load->view('templates/menu');
		$this->load->view($page, $data);
		$this->load->view('NewRegisterView', $data);
		$this->load->view('templates/footer');
	}

	public function index($table = NULL){
		if(!$this->session->username){
            redirect(base_url('login'), 'refresh');
        }

		$data['dades'] = $this->AdminModel->getTable($table);
		$data['columnes'] = $this->AdminModel->getTableHeader($table);
		$data['truecolumnes'] = $this->AdminModel->getTrueTableHeader($table);
		$data['database'] = $table;
		$data['families'] = $this->AdminModel->getTable('families');
		$this->createTemplate('AdminView', $data);
	}

	public function deleteRegister($table, $id){
		$this->AdminModel->deleteRegister($table, $id);
		$this->index($table);
	}

}
