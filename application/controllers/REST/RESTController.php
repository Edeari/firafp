<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH.'/libraries/REST_Controller.php' ;

class RESTController extends REST_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('APIModel');
	}

    private function setHeaderResponse(){
        $this->output->set_header("Access-Control-Allow-Origin: *");
    }

    public function getDades_get($taula)
    {
        $this->setHeaderResponse();
        $dades = $this->APIModel->getAllRegisters($taula);
        $this->response($dades, REST_CONTROLLER::HTTP_OK);
    }

    public function getDades_options($taula) {
        // $this->setHeaderResponse();
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_output(null);
    }

    public function getAgenda_get(){
        $this->setHeaderResponse();
        $agenda = $this->APIModel->getAgenda();
        $this->setHeaderResponse();
    }

    public function getFamiliesWithStudies_get($familia){
        $estudisArray = [];

        $this->setHeaderResponse();
        $families = $this->APIModel->getFamiliesWithStudies($familia);

        foreach ($families as $estudi) {
            $cicle['name'] = $estudi['name'];
            $cicle['id'] = $estudi['id'];
            $cicle['tipus'] = $estudi['type'];
            $cicle['map'] = $estudi['map'];
            $cicle['centres'] = $this->APIModel->getCentresFromStudies($estudi['id']);

            array_push($estudisArray, $cicle);
        }

        // print_r($estudisArray);

        $this->response($estudisArray, REST_CONTROLLER::HTTP_OK);
    }

    public function getCentersDual_get(){
        $centresdual = [];

        $this->setHeaderResponse();
        $centres = $this->APIModel->getCentresDual();

        foreach ($centres as $centre) {
            $centreAr['name'] = $centre['name'];
            $centreAr['logo'] = $centre['logo'];
            $centreAr['location'] = $centre['location'];
            $centreAr['estudis'] = $this->APIModel->getStudiesDual($centre['id']);

            array_push($centresdual, $centreAr);
        }

        $this->response($centresdual, REST_CONTROLLER::HTTP_OK);
    }

    public function getFamiliesStudies_get(){
        $families = [];

        $this->setHeaderResponse();
        $familiaAr = $this->APIModel->getAllRegisters('families');

        foreach ($familiaAr as $family) {
            $familia['id'] = $family['id'];
            $familia['name'] = $family['name'];
            $familia['code'] = $family['code'];
            $familia['logo'] = $family['logo'];
            $familia['map_sector'] = $family['map_sector'];
            $familia['url'] = $family['url'];
            $familia['observation'] = $family['observation'];
            $familia['cfgm'] = $this->APIModel->getStudiesFromFamily($family['code'], 'fpgm');
            $familia['cfgs'] = $this->APIModel->getStudiesFromFamily($family['code'], 'fpgs');

            array_push($families, $familia);
        }

        $this->response($families, REST_CONTROLLER::HTTP_OK);
    }

    public function getSpecialFamilies_get(){
        $this->setHeaderResponse();
        $especials = $this->APIModel->getSpecialFamilies();
        $this->response($especials, REST_CONTROLLER::HTTP_OK);
    }
}
