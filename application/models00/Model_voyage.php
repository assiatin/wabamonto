<?php
class Model_offre extends CI_Model {

	/*public $profil_id   ;
	public $droit_id   ;
	public $qui   ;*/
	
	function __construct()
    {
			/*$this->idOffre = null;
			$this->numOffre = null;
			$this->posteOffre = null;
			$this->profilrechercheOffre = null;
			$this->nombrePostesOffre = null;
			$this->DomaineDEtude_idDomaineDEtude= null;
			$this->DomaineEmploi_idDomaineEmploi= null;
			$this->experienceProfessionnelleOffre = null;
			$this->nbreAnExperienceProOffre = null;
			$this->age = null;
			$this->sexe = null;
			$this->idPaysTravail = null;
			$this->lieuTravailOffre = null;
			$this->TypeContrat_idTypeContrat = null;
			$this->NiveauDetudes_idNiveauDetudes = null;
			$this->emailRepresentantEmployeur = null;
			$this->autreConditionsOffre = null;
			$this->piecesOffre = null;
			$this->dateClotureOffre = null;
			$this->cree_par = null;
			$this->idEmployeur = null;
		*/
		// Call the Model constructor
        parent::__construct();
		
    }


	public function mes_offre()
	
    {
		$data_session=$this->session->userdata('emploiuser');
		
		$this->db->select("offre.*,pays.nomPays as pays,domainedetude.nomDomaineDEtude as domaine_etude,typecontrat.libelle as type_contrat,niveaudetudes.nomNiveauDetudes as niveau_etude");
		$this->db->from('offre');
		
		$this->db->join('pays','pays.idPays=offre.idPaysTravail');
		$this->db->join('domainedetude','domainedetude.idDomaineDEtude=offre.DomaineDEtude_idDomaineDEtude');
		$this->db->join('typecontrat','typecontrat.idTypeContrat=offre.TypeContrat_idTypeContrat');
		$this->db->join('niveaudetudes','niveaudetudes.idNiveauDetudes=offre.NiveauDetudes_idNiveauDetudes');
		
	 
		$this->db->where('idEmployeur',$data_session['idEmployeur']);
//		$this->db->join('sys_profil','sys_profil.Id=sys_profil_droit.Profil_ID');
		
       // $this->db->order_by('sys_utilisateurs.Nom_Utilisateur', 'asc'); 
       
      //  $this->db->order_by('sys_droit.Nom', 'asc');
		$query = $this->db->get();
		
        return $query->result();
    }
	
	
	public function les_voyages()
	
    { 
			$this->db->select("voyage.*,utilisateurs.nomUtilisateurs as niveau_etude,utilisateurs.prenomUtilisateurs as Employeur");
			$this->db->from('voyage');
			$this->db->join('utilisateurs','utilisateurs.idUtilisateurs=voyage.idUtilisateurs');
                $this->db->limit(100);
                $this->db->order_by('idVoyages', 'desc');
		 
//		$this->db->join('sys_profil','sys_profil.Id=sys_profil_droit.Profil_ID');
		
       // $this->db->order_by('sys_utilisateurs.Nom_Utilisateur', 'asc'); 
       
      //  $this->db->order_by('sys_droit.Nom', 'asc');
		$query = $this->db->get();
		
        return $query->result();
    }
	
	
	
	
	public function top50voyages()
	
    {
		
		$date = new DateTime('now');
        $currentDate = $date->format('Y-m-d');
		
		/*var_dump( $this);
		exit();*/
	
		$this->db->select("voyage.*,utilisateurs.nomUtilisateurs as niveau_etude,utilisateurs.prenomUtilisateurs as Employeur");
		$this->db->from('voyage');
		$this->db->join('utilisateurs','utilisateurs.idUtilisateurs=voyage.idUtilisateurs');
                $this->db->limit(100);
                $this->db->order_by('idVoyages', 'desc');
				/*
				
				if ($this->reference!='')
				$this->db->like('numOffre', $this->reference);
				if ($this->employeurId!='')
				$this->db->like('nomEmployeur', $this->employeurId);
				if ($this->poste!='')
				$this->db->like('posteOffre', $this->poste);
				if ($this->lieudetravail!='')
				$this->db->like('lieuTravailOffre', $this->lieudetravail);
				if ($this->idPaysTravail!='')
				$this->db->where('idPaysTravail', $this->idPaysTravail);
				if ($this->idNiveauDetudes!='')
				$this->db->where('idNiveauDetudes', $this->idNiveauDetudes);
				if ($this->idTypeContrat!='')
				$this->db->where('TypeContrat_idTypeContrat', $this->idTypeContrat);
				/*if ($this->datedepublication!='')
				$this->db->where('TypeContrat_idTypeContrat', $this->datedepublication);
				if (($this->datedecloture!='') and ($this->datedecloture!='01-01-1970'))
				$this->db->where('dateClotureOffre',  date('Y-m-d',strtotime($this->datedecloture)) ); */
			
			
				
                
//		$this->db->join('sys_profil','sys_profil.Id=sys_profil_droit.Profil_ID');
		
       
       
      //  $this->db->order_by('sys_droit.Nom', 'asc');
		$query = $this->db->get();
		//var_dump( $query->result());
		//exit();
        return $query->result();
    }
	
	
	
	
	public function insert_offre()
    {
     
	 	/*$this->db->select();
		$this->db->where('login', $this->login);
		//$this->db->where('droit_id',$this->droit_id);
		$this->db->from('sys_utilisateurs');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{*/
			$this->db->insert('offre', $this);
			return 0;
		/*}
		else
		{
			return 1;
		}
		*/
       
		 
    }


	public function get_dom_etu_for_select()
    {
    	 
        $query = $this->db->get('domainedetude');
		
		$list=array();
		// $list['-1']='Sélectionner...'.$query->num_rows();;
		 foreach($query->result_array() as $row)
		 { 
		   $list[$row['idDomaineDEtude']]=$row['nomDomaineDEtude'];
		 }
		 return $list;
		  
    }
	
	public function get_dom_emp_for_select()
    {
    	
        $query = $this->db->get('domaineemploi');
		
		$list=array();
		// $list['-1']='Sélectionner...'.$query->num_rows();;
		 foreach($query->result_array() as $row)
		 { 
		   $list[$row['idDomaineEmploi']]=$row['nomDomaineEmploi'];
		 }
		 return $list;
		  
    }
	/**
	*	Obtenir la liste des sous domaines  de emploi
	*	@param $idDomaineEmploi, integer
	*
	*/
	public function getDomaineEmploi($idSousDomaineEmploi)
    {
    	  $this->db->select('domaineemploi_idDomaineEmploi');
		  $this->db->from('sousdomaineemploi');
		  $this->db->where('idsousdomaineemploi', (int) $idSousDomaineEmploi);
          $res = $this->db->get();
		  return $res->result_array(); 
    }
	
	/**
	*	Obtenir tous les sous domaines emploi du meme domaine
	*	@param $idSousDomaineEmploi, integer
	*
	*/
	public function getSousDomaineEmploi($idDomaineEmploi)
    {
    	  $this->db->select();
		  $this->db->from('sousdomaineemploi');
		  $this->db->where('domaineemploi_idDomaineEmploi', (int) $idDomaineEmploi);
          $res = $this->db->get();
		  return $res->result_array();  
    }
	
	public function get_pays_for_select()
    {
    	 
        $query = $this->db->get('pays');
		
		$list=array();
		 $list['']='Sélectionner...';
		 foreach($query->result_array() as $row)
		 { 
		   $list[$row['idPays']]=$row['nomPays'];
		 }
		 return $list;
		  
    }
	
	
	public function get_type_contrat_for_select()
    {
    	 
        $query = $this->db->get('typecontrat');
		
		$list=array();
		// $list['-1']='Sélectionner...'.$query->num_rows();;
		 foreach($query->result_array() as $row)
		 { 
		   $list[$row['idTypeContrat']]=$row['libelle'];
		 }
		 return $list;
		  
    }
	
	public function get_niv_etu_for_select()
    {
    	 
        $query = $this->db->get('niveaudetudes');
		
		$list=array();
		// $list['-1']='Sélectionner...'.$query->num_rows();;
		 foreach($query->result_array() as $row)
		 { 
		   $list[$row['idNiveauDetudes']]=$row['nomNiveauDetudes'];
		 }
		 return $list;
		  
    }
	
	

	public function register()
    {
     
	 	$this->db->select();
		$this->db->where('emailCandidat', $this->emailCandidat);	
		$this->db->from('candidat');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{
			$this->db->trans_begin();
			$this->db->insert('candidat', $this);
			$id_candidat = $this->db->insert_id();
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
					$this->email->from('clangnito@gmail.com', 'Accueil emploi');
					$this->email->to($this->emailCandidat);
					/*$this->email->cc('another@another-example.com');
					$this->email->bcc('them@their-example.com');*/
					
					$this->email->subject('Confirmation inscription');
					$this->email->message('<html>

    <body>
        <p style="">Bonjour '.$this->nomCandidat.' '.$this->prenomCandidat.',
        </p>

        <p>Veuillez cliquer sur le lien suivant pour valider l inscription 
        </p>

         Lien http://echel-it.com/echel-it.com/dev/index.php/welcome/register_validation/'.$this->emailCandidat.'/'.$id_candidat.'
		
		<br>

        <p>Merci ,<br><br>
            Accueil emploi
        </p>
    </body>
</html>');
					
					//$this->email->send();
					
					
					return 1;
			}
			
		}
		else
		{
			return 0;
		}
		
      
    }




	public function register_employeur()
    {
     
	 	$this->db->select();
		$this->db->where('emailEmployeur', $this->emailCandidat);	
		$this->db->from('employeur');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{
			$this->db->trans_begin();
			$this->db->insert('employeur',array('nomEmployeur'=>$this->emailCandidat,'emailEmployeur'=>$this->emailCandidat,'pwdEmployeur'=>$this->pwdCandidat,'etatEmployeur'=>$this->etatCandidat));
			$id_candidat = $this->db->insert_id();
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
					$this->email->from('clangnito@gmail.com', 'Accueil emploi');
					$this->email->to($this->emailCandidat);
					/*$this->email->cc('another@another-example.com');
					$this->email->bcc('them@their-example.com');*/
					
					$this->email->subject('Confirmation inscription');
					$this->email->message('<html>

    <body>
        <p style="">Bonjour '.$this->nomCandidat.' '.$this->prenomCandidat.',
        </p>

        <p>Veuillez cliquer sur le lien suivant pour valider l inscription 
        </p>

         Lien http://echel-it.com/echel-it.com/dev/index.php/welcome/register_validation/'.$this->emailCandidat.'/'.$id_candidat.'
		
		<br>

        <p>Merci ,<br><br>
            Accueil emploi
        </p>
    </body>
</html>');
					
					//$this->email->send();
					
					
					return 1;
			}
			
		}
		else
		{
			return 0;
		}
		
      
    }
	
	public function register_validation()
    {
     
	 	$this->db->select();
		$this->db->where('emailCandidat', $this->emailCandidat);	
		$this->db->where('idCandidat', $this->id);	
		$this->db->where('etatCandidat', "1");	
		$this->db->from('candidat');
		$res=$this->db->get();
		 
		if (count($res->result())!=0)
		{
			
			$this->db->where('idCandidat',$this->id);
			$this->db->update('candidat', array('etatCandidat'=>"2"));
			
			
			return 1;
			
			
		}
		else
		{
			
			return 0;
		}
		
      
    }
	
	
	public function Search($login,$hash)
	{
		$this->db->select("candidat.*");
		$this->db->where('emailCandidat',$login);
		$this->db->where('pwdCandidat',MD5($hash));
		$this->db->where('etatCandidat',"2");
		
		$this->db->from('candidat');
		//$this->db->join('bureau','bureau.code=sys_utilisateurs.Bureau_ID');
		$query=$this->db->get();
		return $query;
	}
	
	public function Search_employeur($login,$hash)
	{
		$this->db->select("employeur.*");
		$this->db->where('emailEmployeur',$login);
		$this->db->where('pwdEmployeur',MD5($hash));
		//$this->db->where('etatCandidat',"2");
		
		$this->db->from('employeur');
		//$this->db->join('bureau','bureau.code=sys_utilisateurs.Bureau_ID');
		$query=$this->db->get();
		return $query;
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
	

	
	
	public function pre_insert()
    {
     
	 
    }
	
	/*function update($id)
    {
		$this->db->where('id',$id);
		$this->db->update('sys_profil_droit', array('intitule'=>$lib));
 	
    }*/
	
	public function load($id)
	{
		$this->db->select();
		$this->db->where('idoffre',$id);
		$this->db->from('offre');
		
		$q = $this->db->get()->result();
		
		return $q[0];
	}
	
	public function LoadId($id)
	{
		$this->db->select();
		$this->db->where('id',$id);
		$this->db->from('sys_utilisateurs');
		
		$q=$this->db->get();
		return $q;
	}
	
	
	
	
	
	function update($id)
    {
		$this->db->where('id',$id);
		$this->db->update('sys_utilisateurs',  $this);
    
    
		
    }
	
	
	public function update_offre()
	{
		$this->db->where('idOffre',$this->idOffre);
		if($this->db->update('offre', $this))
		{
			return 0;
		}
		else
		{
			return $this->db->_error_message();
		}
	}	
 
	public function user_activer($id,$activer)
    { 
		 
			$this->db->where('id',$id);
			$this->db->update('sys_utilisateurs', array('Actif'=>$activer));
	
    }
	
	public function changer_password($login,$Hash,$passeword_old)
    { 
		 
		 $this->db->select();
		$this->db->where('login', $login);
		$this->db->where('Hash',MD5($passeword_old));
		$this->db->from('sys_utilisateurs');
		$res=$this->db->get();
		 
		if (count($res->result())==0)
		{
			//$this->db->insert('sys_utilisateurs', $this);
			return 0;
		}
		else
		{
			$this->db->where('Login',$login);
			$this->db->update('sys_utilisateurs', array('Hash'=>MD5($Hash)));
			return 1;
		}
			
	
    }
	
	/**
     * @param void
     * @return array list of offres
     */
    public function getOffreReferenceList($query_str)
    {
         $this->db->select("idOffre,numOffre");
		 $this->db->from('offre');
		  $this->db->where('referenceOffre LIKE', $query_str."%");
         $query = $this->db->get();
         return $query->result_array();
    }
	

}