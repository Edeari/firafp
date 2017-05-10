<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APIModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

    public function getAllRegisters($taula){
        $query = $this->db->get($taula);
        return $query->result_array();
    }

	public function getStudiesCenter($idcentre){
		$this->db->select('studies.id, studies.name, studies.type');
		$this->db->from('centers');
		$this->db->join('centers_studies', 'centers.id = centers_studies.idcenter');
		$this->db->join('studies', 'centers_studies.idstudy = studies.id');
		$this->db->where('centers.id', $idcentre);

		$query = $this->db->get();
		return $query->result();
	}

	public function getAgenda(){
		$query = $this->db->get('diary');
		return $query->result();
	}

	public function getFamiliesWithStudies($familia){
		$this->db->select('*');
		$this->db->from('studies');
		$this->db->where('familia', $familia);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getCentresFromStudies($idstudy){

		$this->db->select('centers.name');
		$this->db->select('centers.location');
		$this->db->from('centers');
		$this->db->join('centers_studies', 'centers.id = centers_studies.idcenter');
		$this->db->join('studies', 'centers_studies.idstudy = studies.id');
		$this->db->where('studies.id', $idstudy);

		$query = $this->db->get();
		
		$centres = [];
		foreach ($query->result() as $element) {
			$centre['name'] = $element->name;
			$centre['location'] = $element->location;
			array_push($centres, $centre);
		}
		
		return $centres;
	}

	public function getCentresDual(){
		$this->db->distinct();
		$this->db->select('centers.id, centers.name, centers.location, centers.logo');
		$this->db->from('centers');
		$this->db->join('centers_studies', 'centers.id = centers_studies.idcenter');
		$this->db->join('studies', 'centers_studies.idstudy = studies.id');
		$this->db->where('centers_studies.dual', '1');

		$query = $this->db->get();

		return $query->result_array();

	}

	public function getStudiesDual($idcentre){
		$this->db->select('studies.name, studies.type');
		$this->db->from('centers');
		$this->db->join('centers_studies', 'centers.id = centers_studies.idcenter');
		$this->db->join('studies', 'centers_studies.idstudy = studies.id');
		$this->db->where('centers_studies.dual', '1');
		$this->db->where('centers_studies.idcenter', $idcentre);

		$query = $this->db->get();

		return $query->result();
	}

	public function getStudiesFromFamily($familycode, $type){
		$this->db->where('familia', $familycode);
		$this->db->where('type', $type);
		$query = $this->db->get('studies');
		return $query->result_array();
	}

	public function getSpecialFamilies(){
		$this->db->select('*');
		$this->db->from('families');
		$where = "LENGTH(url) > 0 AND code NOT IN (SELECT familia FROM studies)";
		$this->db->where($where);

		$query = $this->db->get();

		return $query->result_array();

	}
}
