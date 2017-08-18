<?php
class Model_ville extends CI_Model {

	/*public $profil_id   ;
	public $droit_id   ;
	public $qui   ;*/
    
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


	
	
	
	public function get_all_ville()
    {
		$this->db->select("ville.*");
		$this->db->from('ville');
     	$query = $this->db->get();
		
        return $query->result();
    }

	
	
	
	
	
}