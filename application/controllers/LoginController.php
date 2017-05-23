<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
        $this->load->library('session');
		$this->load->helper('url');
	}

	public function createTemplate($page, $data){
		$this->load->view('templates/header');
		$this->load->view($page, $data);
		$this->load->view('templates/footer');
	}

	public function checkSession(){
		if(!$this->session->username){
            redirect(base_url('admin/centers'), 'refresh');
        }
	}

	public function index(){
		$this->checkSession();
        $data['error'] = TRUE;
		$this->createTemplate('LoginView', $data);
	}

    public function login(){
        if($this->session->username){
            redirect(base_url('login'), 'refresh');
        }

        $username = $this->input->post('username');
        $pass = $this->input->post('pass');
        $session_status = $this->LoginModel->check_login($username, $pass);

        if($session_status){
            $level = $this->LoginModel->getLevel($username);
            $this->sessionStart($username, $pass, $level);
        }

        $data['session'] = $this->session;

        if($session_status){
            redirect(base_url('admin/centers'), 'refresh');
        } else {
            $data['error'] = FALSE;
            $this->createTemplate('LoginView', $data);
        }
    }

    private function sessionStart($username, $pass, $level){
        $userData = array(
            'username'  => $username,
            'pass'      => $pass,
            'level'     => $level
        );

        $this->session->set_userdata($userData);
    }

    public function logout(){
        $data['error'] = TRUE;

        $session_data = array('username', 'pass');

        $this->session->unset_userdata($session_data);

        $this->createTemplate('LoginView', $data);
    }

}
