<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfModel extends CI_Model { 

   public function __construct () 
   { 
      parent::__construct();

      $this->load->database();
   } 

   /**
    * Returns all studies for a family, that corresponds to a type of studies (GM or GS)
    * @param  [string] $family        [Study family code, this code are a secondary key value]
    * @param  [string] [$type='fpgm'] [Type of studies, possible values are: fpgs, fpgm]
    * @return [object_array] [DB rows, with all studies for a family code and a type]
    */
   public function getStudiesByFamily ($family, $type='fpgm')
   {
      $this->db->order_by("name","ASC")  ;
      $query = $this->db->get_where('studies', 
                                    array('familia' => $this->db->escape_str($family),
                                          'type'    => $this->db->escape_str($type)   )); 

      return $query->result_array();
   }

   /**
    * Gets all centers for an study
    * @param  [integer] $id [Study id, to select centers ]
    * @return [object_array] [DB rows, with all centers that has an study]
    */
   public function getCentresByEstudi($id)
   {
      $this->db->select('centers.*, centers_studies.observation, centers_studies.dual');
      $this->db->from('centers');
      $this->db->join('centers_studies', 'centers.id = centers_studies.idcenter');
      $this->db->join('studies', 'centers_studies.idstudy = studies.id');
      $this->db->where('studies.id', $this->db->escape_str($id));  
      $query = $this->db->get();

      return $query->result_array();
   } 
   
   /**
    * Get centre object with a particular code, this code identifies a centre for Dept. Ensenyament, centers 
    * in Lleida has a 8 digits code, that starts with 25
    * @param  [string] $codi [Key to identify a center]
    * @return [object] [DB result, with the center search]
    */
   public function getCentreByCode($codi)
   {
      $query = $this->db->get_where('centers', 
                                    array('codicentre' => $this->db->escape_str($codi))); 

      return $query->row_array();
   }
   
   /**
    * Get all studies that a Center identified with $id performs
    * @param  [string] $id [Key to identify center]
    * @return [object_array] [DB rows, with all studies that are performed in the center]
    */
   public function getEstudisByCentre($id)
   {
      $this->db->select('studies.name,studies.type, studies.familia, centers_studies.observation, centers_studies.dual,families.name as fname');
      $this->db->from('centers');
      $this->db->join('centers_studies', 'centers.id = centers_studies.idcenter');
      $this->db->join('studies', 'centers_studies.idstudy = studies.id');
      $this->db->join('families', 'families.code = studies.familia');
      $this->db->where('centers.codicentre', $this->db->escape_str($id));  
      $this->db->order_by('families.name','ASC');  
      $this->db->order_by('studies.type','ASC');  
      $this->db->order_by('studies.name','ASC');  
      $query = $this->db->get();

      return $query->result_array();
   }

   /**
    * Get a family identified with a secondary key
    * @param  [string] $codiFamily [Secondary key for a family, this key is user friendly]
    * @return [object] [DB result, with the family]
    */
   public function getFamily($codiFamily)
   {
      $query = $this->db->get_where('families', 
                                    array('code' => $this->db->escape_str($codiFamily))); 

      return $query->row_array();
   }
   
   /**
    * Get all families into DDBB
    * @return [object_array] [DB rows, with all families into DB]
    */
   public function getFamilies()
   {
      $query=$this->db->get("families");

      return $query->result_array();
   }   
   /**
    * Get all centres into DDBB
    * @return [object_array] [DB rows, with all centres into DB]
    */
   public function getCentres()
   {
      $query=$this->db->get("centers");

      return $query->result_array();
   }
}