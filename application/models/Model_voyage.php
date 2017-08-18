<?php
class Model_voyage extends CI_Model {

	
	
	function __construct()
    {
			
        parent::__construct();
		
    }

	public function proposer()
    {
      
			
			$this->db->insert('voyage',array('prendreBagage'=>$this->prendreBagage,'nbrePlaceVoyages'=>$this->nbrePlaceVoyages,'retardVogages'=>$this->retardVogages,'coutVoyages'=>$this->coutVoyages,'descriptionVoyages'=>$this->descriptionVoyages,'estAllerSimple'=>$this->estAllerSimple,'typeVoyages'=>$this->typeVoyages,'villeDepartVoyages'=>$this->villeDepartVoyages,'villeArriveeVoyages'=>$this->villeArriveeVoyages,'dateDepartVoyages'=>$this->dateDepartVoyages,'dateRetourVoyages'=>$this->dateRetourVoyages,'heureDepartVoyages'=>$this->heureDepartVoyages,'heureRetourVoyages'=>$this->heureRetourVoyages	));
			//$id = $this->db->insert_id();
			
			
      
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
	
	
	public function search()
	
    { 
			$this->db->select("voyage.*");
			$this->db->from('voyage');
		
			$this->db->limit(50);
			$this->db->order_by('heureDepartVoyages', 'desc');
			if ($this->villeDepartVoyages!='')
			{
				$this->db->where('voyage.villeDepartVoyages',$this->villeDepartVoyages);
				
			}
			if ($this->villeArriveeVoyages!='')
			{
				$this->db->where('voyage.villeArriveeVoyages',$this->villeArriveeVoyages);
				
			}
			if ($this->dateDepartVoyages!='1970-01-01')
			{
				$this->db->where('voyage.dateDepartVoyages',$this->dateDepartVoyages);
				
			}
			if ($this->dateRetourVoyages!='1970-01-01')
			{
				$this->db->where('voyage.dateRetourVoyages',$this->dateRetourVoyages);
				
			}
			$query = $this->db->get();
			//var_dump($query->result());
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
	
	
	
	



	

}