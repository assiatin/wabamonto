<?php
class Model_user extends CI_Model {

	/*public $profil_id   ;
	public $droit_id   ;
	public $qui   ;*/
    
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	
	
	public function connexion($login,$hash)
	{
		$this->db->select("users.*");
		$this->db->where('emailUsers',$login);
		$this->db->where('passwordUsers',MD5($hash));
		$this->db->where('actif',"1");
		
		$this->db->from('users');
		//$this->db->join('bureau','bureau.code=sys_utilisateurs.Bureau_ID');
		$query=$this->db->get();
		/*var_dump(count($query->result()));
		exit();*/
		return $query->result();
	}
	
	
		public function insert_user()
    {
     
	 	$this->db->select();
		$this->db->where('emailUsers', $this->emailUsers);	
		$this->db->from('users');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{
			
			$this->db->insert('users',array('nomUsers'=>$this->nomUsers,'prenomUsers'=>$this->prenomUsers,'telUsers'=>$this->telUsers,'emailUsers'=>$this->emailUsers,'Profil'=>$this->Profil,'actif'=>$this->statut,'emailUsers'=>$this->emailUsers,'passwordUsers'=>MD5("waba")	));
			//$id = $this->db->insert_id();
			
			return 1;
		}
		else
		{
			return 0;
		}
		
      
    }

	
	
	
	public function get_all()
    {
		$this->db->select("users.*");
		$this->db->from('users');
		
		
        $this->db->order_by('users.nomUsers', 'asc'); 
       
      //  $this->db->order_by('sys_droit.Nom', 'asc');
		$query = $this->db->get();
		
        return $query->result();
    }

	public function user_init($id)
    {
     
	 	$this->db->where('idUsers',$id);
		$this->db->update('users', array('passwordUsers'=>MD5("waba")));
    
		
      
    }
	
	
	public function LoadId($id)
	{
		$this->db->select();
		$this->db->where('idUsers',$id);
		$this->db->from('users');
		
		$query=$this->db->get();
		return $query->result();
	}
	
	
	
	
}