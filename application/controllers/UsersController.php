<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UsersModel');
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

	public function checkAdmin(){
		if($this->session->level == 10){
			return true;
		} else{
			return false;
		}
	}

	public function index(){
		$this->checkSession();
		if($this->checkAdmin()){
			$data['usuaris'] = $this->UsersModel->getAllUsers();
			$this->createTemplate('UsersView', $data);
		} else {
			redirect(base_url('admin/centers'), 'refresh');
		}
	}

	public function editUser(){
		$this->checkSession();
		if($this->checkAdmin()){
			$this->UsersModel->editUser();
			$this->index();
		}
	}

	public function editRole(){
		$this->checkSession();
		if($this->checkAdmin()){
			$this->UsersModel->editRole();
			$this->index();
		}
	}

	public function deleteUser(){
		$this->checkSession();
		if($this->checkAdmin()){
			$this->UsersModel->deleteUser();
			$this->index();
		}
	}

	public function addUser(){
		$this->checkSession();
		if($this->checkAdmin()){
			$this->UsersModel->addUser();
			$this->index();
		}
	}

}
