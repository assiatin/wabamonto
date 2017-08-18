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

	public function inscription()
    {
     
	 	$this->db->select();
		$this->db->where('emailUtilisateurs', $this->emailUtilisateurs);	
		$this->db->from('utilisateurs');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{
			$this->db->trans_begin();
			$this->db->insert('utilisateurs', $this);
			$id = $this->db->insert_id();
			if ($this->db->trans_status() === FALSE)
			{
					$this->db->trans_rollback();
					return 2;
			}
			else
			{
					$this->db->trans_commit();
					
					$this->load->library('email');

					$this->email->set_mailtype("html");
					$this->email->from('clangnito@gmail.com', 'Wabamonto: Inscription');
					$this->email->to($this->emailUtilisateurs);
					$this->email->cc('another@another-example.com');
					$this->email->bcc('them@their-example.com');
					
					$this->email->subject('Confirmation de votre inscription sur Wabamonto');
					$this->email->message('<html>

    <body>
        <p style="">Bonjour '.$this->nomUtilisateurs.' '.$this->prenomUtilisateurs.',
        </p>

        <p>Veuillez cliquer sur le lien suivant pour valider votre inscription 
        </p>

         Lien <a href="'.base_url().'index.php/welcome/register_validation/'.$this->emailUtilisateurs.'/'.$id.'">'.base_url().'index.php/welcome/register_validation/'.$this->emailUtilisateurs.'/'.$id.'</a>
		
		<br>

        <p>Merci ,<br><br>
            Wabamonto : Voyager en toute securité. 
        </p>
    </body>
</html>');
					$this->email->send();
					/*var_dump($this->email->send());
					
					exit();*/
					return 1;
			}
			
		}
		else
		{
			return 2;
		}
		
      
    }
	
	public function connexion($login,$hash)
	{
		$this->db->select("utilisateurs.*");
		$this->db->where('emailUtilisateurs',$login);
		$this->db->where('passwordUtilisateurs',MD5($hash));
		$this->db->where('statut',"2");
		
		$this->db->from('utilisateurs');
		//$this->db->join('bureau','bureau.code=sys_utilisateurs.Bureau_ID');
		$query=$this->db->get();
		/*var_dump(count($query->result()));
		exit();*/
		return $query->result();
	}
	
	
	
	public function register_validation()
    {
     
		$this->db->select();
		$this->db->where('emailUtilisateurs', $this->emailUtilisateurs);	
		$this->db->where('idUtilisateurs', $this->idUtilisateurs);	
		//$this->db->where('etatCandidat', "1");	pas necessaire pour la validation cause une erreur lorsqu on clique 2 fois sur le lien de validation
		$this->db->from('utilisateurs');
		$res = $this->db->get();
		if (count($res->result())!=0 )
		{
			
			$this->db->where('idUtilisateurs',$this->idUtilisateurs);
			$this->db->update('utilisateurs', array('statut'=>"2"));
			
			
			return 1;
			
			
		}
		else
		{
			
			return 0;
		}
		
      
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
	
	
	
	
}