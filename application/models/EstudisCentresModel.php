<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstudisCentresModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getRegisters($idstudy){
		$this->db->select('centers.id, centers.name, centers.location, centers.codicentre, centers_studies.observation, centers_studies.dual');
		$this->db->from('centers');
		$this->db->join('centers_studies', 'centers.id = centers_studies.idcenter');
		$this->db->join('studies', 'centers_studies.idstudy = studies.id');
		$this->db->where('studies.id', $idstudy);

		$query = $this->db->get();
		$centres = $query->result_array();

		$jsoncentres = json_encode($centres);

		return $jsoncentres;
	}

	public function getAllCenters($slug){
		// $this->db->where_not_in('id', $slug);
		$query = $this->db->query('SELECT id, codicentre, name, location FROM centers WHERE id NOT IN(SELECT idcenter FROM centers_studies WHERE idstudy="'.$slug.'")');
		// $query = $this->db->get('studies');
		$centres = $query->result_array();

		$jsoncentres = json_encode($centres);

		return $jsoncentres;
	}

	public function getStudyName($id){
		$query = $this->db->get_where('studies', array('id' => $id));

		return $query->row_array();
	}

	public function addStudy($estudi, $centre){
		$data = array(
	        'idcenter' => $centre,
	        'idstudy' => $estudi
		);

		$this->db->insert('centers_studies', $data);
	}

	public function deleteStudy($centre, $estudi){
		$this->db->delete('centers_studies', array('idcenter' => $centre, 'idstudy' => $estudi));  // Produces: // DELETE FROM mytable  // WHERE id = $id
	}

	public function editDataStudy(){
		$idcentre = $this->input->post('idcentre');
		$idestudi = $this->input->post('idestudi');
		$dual = $this->input->post('dual');
		if(isset($dual) == 1){
			$dual = 1;
		} else {
			$dual = 0;
		}

		$observation = $this->input->post('observation');

		$this->db->set('observation', $observation, TRUE);
		$this->db->set('dual', $dual, TRUE);
		$this->db->where('idcenter', $idcentre);
		$this->db->where('idstudy', $idestudi);
		$this->db->update('centers_studies');
	}

}
