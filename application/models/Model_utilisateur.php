<?php
class Model_utilisateur extends CI_Model {

	/*public $profil_id   ;
	public $droit_id   ;
	public $qui   ;*/
    
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	
	public function get_all()
    {
		$this->db->select("users.*");
		$this->db->from('gestionvoyage.users');
        $this->db->order_by('users.nomUsers', 'asc'); 
       
      //  $this->db->order_by('sys_droit.Nom', 'asc');
		$query = $this->db->get();
		
        return $query->result();
    }
	
	
	public function get_droit_for_select()
    {
    	 
        $query = $this->db->get('sys_droit');
		
		$list=array();
		// $list['-1']='Sélectionner...'.$query->num_rows();;
		 foreach($query->result_array() as $row)
		 { 
		   $list[$row['Id']]=$row['Nom'];
		 }
		 return $list;
		  
    }
	
	public function insert()
    {
     
	 	$this->db->select();
		$this->db->where('emailUsers', $this->emailUsers);
		//$this->db->where('droit_id',$this->droit_id);
		$this->db->from('users');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{
			$this->db->insert('users', $this);
			return $this->db->insert_id();
		}
		else
		{
			return -1;
		}
		
       
		/*if (!$insert ) 
		{
		   //some logics here, you may create some string here to alert user
		} else {
		   //other logics here
		}*/
    }
	
	
	public function update_utilisateur_agence($data)
    {
	 	if($this->db->insert('agence_utilisateur', $data))
		{
			return true;
		}
		else
		{
			echo $this->db->_error_number()."_".$this->db->_error_message();
		}
		
    }
	
	/*function update($id)
    {
		$this->db->where('id',$id);
		$this->db->update('sys_profil_droit', array('intitule'=>$lib));
 	
    }*/
	
	
	public function LoadId($id)
	{
		$this->db->select();
		$this->db->where('idUsers',$id);
		$this->db->from('users');
		
		$q=$this->db->get();
		return $q;
	}
	
	
	public function Search($Email,$hash)
	{
		
	
		
		$this->db->select("users.*");
		$this->db->where('emailUsers',$Email);
		$this->db->where('passwordUsers',MD5($hash));
		//$this->db->where('Hash',MD5($hash));
		//$this->db->where('Bureau_ID',$Bureau_ID);
		$this->db->where('actif',1);
		
		$this->db->from('users');
		//$this->db->join('bureau','bureau.code=sys_utilisateurs.Bureau_ID');
		$query=$this->db->get();
		 
		 
		 
		return $query;
	}
	
	
	function update($id)
    {
		$this->db->where('idUsers',$id);
		$this->db->update('users',  $this);
    
    
		
    }
		
 
	public function user_activer($id,$activer)
    { 
		 
			$this->db->where('idUsers',$id);
			$this->db->update('users', array('actif'=>$activer));
	
    }
	
	public function changer_password($login,$Hash,$passeword_old)
    { 
		 
		 $this->db->select();
		$this->db->where('login', $login);
		$this->db->where('Hash',MD5($passeword_old));
		$this->db->from('users');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{
			//$this->db->insert('sys_utilisateurs', $this);
			return 0;
		}
		else
		{
			$this->db->where('Login',$login);
			$this->db->update('users', array('Hash'=>MD5($Hash)));
			return 1;
		}
			
	
    }
	
	
}