<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$data=array();
		/*$data['notification']="";
		$this->session->unset_userdata('vitaluser');
		if($this->input->post('btnconnexion'))
		{
			$this->load->model('Model_utilisateur','users');
			$res=$this->users->Search($this->input->post('txtlogin'),$this->input->post('txtpwd'),$this->input->post('bureau_id'));
			if($res->num_rows()==1)
			{
				    $sessionarray=array();
					$droit=array();
					$result=$res->row(); 
					$this->load->model('Model_profil_droit','mdprofil_droit');
			        $liste_droit=$this->mdprofil_droit->Load_droit($result->Profil_ID);
					
					foreach ($liste_droit as $liste) 
					{
						array_push($droit, $liste->Code);
					} 
					
					 
				
					
					
					$sessionarray=array("profil_id"=>$result->Profil_ID,"userid"=>$result->Id,"bureau"=>$result->bureau,"Bureau_ID"=>$result->Bureau_ID,"prenom"=>$result->Prenom_Utilisateur,"nom"=>$result->Nom_Utilisateur,"login"=>$result->Login,"droit"=>$droit); 
					 
	         	   $this->session->set_userdata(array("vitaluser"=>$sessionarray));
				   
				redirect('welcome/home');
			}
			else {
				$data['notification']="Connexion echouée!";
			}
			
		}
		
		$this->load->model('Model_bureau','mdbureau');
		$data['bureau']=$this->mdbureau->get_bureau_agence();*/
		
		$this->load->view('index_font',$data);
		
		
		
	}
	
	
					
					
	public function CheckDroit($droit)
	{
		 
    	$data_session=$this->session->userdata('sysuser'); 
				   
    	$a_droit=array_search($droit, $data_session['droit']);
		if (trim($a_droit)=="")
			{
				 redirect('admin/pas_droit');
			}
		
	}
	
	
	
	public function pas_de_caisse()
	{
		 
    	$data=array();
		$this->load->model('Model_caisse','mdcaisse');
		$res=$this->mdcaisse->numero_caisse_ouverte();
		
		if (count($res)==1)
			{
				 return $res;
			}
			else 
			{
				
				redirect('welcome/page_pas_de_caisse');
			}
	
	}
	
	
	public function page_pas_de_caisse()
	{
		 
    	$data=array();
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('pas_de_caisse',$data);
		$this->load->view('footer',$data);
	}
	
	public function pas_droit()
	{
        $data=array();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/pas_droit',$data);
		$this->load->view('admin/footer',$data);
	}
	
	public function CheckUser()
	{ 
        if(!$this->session->userdata('sysuser'))
		{
		// $data_session=$this->session->userdata('vitaluser'); 			 
		 redirect('welcome');
		}
	}
	
	
	public function dashboard()
	{
		$this->CheckUser();
		$data=array();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		//$this->load->view('wrapper',$data);
		$this->load->view('admin/footer',$data);

	}
	
	/**
         * Traite les diplomes
         */
	public function diplome()
	{
                // $this->CheckUser();
		$data=array();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/diplome',$data);
		$this->load->view('admin/footer',$data);
	}
        /**
         * 
         * Affiche la liste des offres
         */
    public function offre()
	{
                // $this->CheckUser();
            $this->load->model('admin/Model_offre', 'mdoffre');
            $data ['mesoffres']= $this->mdoffre->Mes_offre();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/offre',$data);
		$this->load->view('admin/footer',$data);
	}
	
	 public function listevoyage()
	{
                // $this->CheckUser();
            $this->load->model('admin/Model_voyage', 'mdvoyage');
            $data ['mesoffres']= $this->mdvoyage->Les_voyages();
		//$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/listing_voyage',$data);
		$this->load->view('admin/footer',$data);
	}
	 
	
	/**
         * 
         * Publie ou modifie une offre d emploi
         */
    public function nouvelle_offre()
	{
        // TO DO Revoir la logique et separer l affichage du formulaire et son traitement
		
		 $this->CheckUser();	//pour verifier l utilisateur est connecte	
	     $data_session = $this->session->userdata('sysuser');
		
		// Get l id offre
		$offre_id = 0;
		//$offre_id = $this->uri->segment('3');
		
		$data = array();
		$data['notification']='';
		$data['domaineEmploi'] = 0;
		$data['idSousDomaineEmploi']='';
		$data['listeSousDomaineEmploi'] = null;
		$data['idTypeContrat']='';
		$data['idNiveauEtude'] = '';
		$data['idPays'] = '';
		$data['dateClotureOffre']='';
		$data['idDomaineEtude'] = 0;
		$this->load->model('Model_offre','mdoffre');
		$this->load->model('Model_employeur', 'mdemployeur');
		
		/*$this->mdoffre->numOffre="";
		$this->mdoffre->idOffre="";
 		$this->mdoffre->posteOffre="";
		$this->mdoffre->profilrechercheOffre="";
		$this->mdoffre->nombrePostesOffre="";
		$this->mdoffre->nbreAnExperienceProOffre=0;
		$this->mdoffre->age="";
		$this->mdoffre->lieuTravailOffre="";
		$this->mdoffre->autreConditionsOffre="";
		$this->mdoffre->piecesOffre="";
		$this->mdoffre->sexe=0;
		$this->mdoffre->age="";
//		*/
		$this->mdoffre->idOffre = null;
			$this->mdoffre->numOffre = null;
			$this->mdoffre->posteOffre = null;
			$this->mdoffre->profilrechercheOffre = null;
			$this->mdoffre->nombrePostesOffre = null;
			$this->mdoffre->DomaineDEtude_idDomaineDEtude= null;
			$this->mdoffre->DomaineEmploi_idDomaineEmploi= null;
			$this->mdoffre->experienceProfessionnelleOffre = null;
			$this->mdoffre->nbreAnExperienceProOffre = null;
			$this->mdoffre->age = null;
			$this->mdoffre->sexe = null;
			$this->mdoffre->idPaysTravail = null;
			$this->mdoffre->lieuTravailOffre = null;
			$this->mdoffre->TypeContrat_idTypeContrat = null;
			$this->mdoffre->NiveauDetudes_idNiveauDetudes = null;
			$this->mdoffre->emailRepresentantEmployeur = null;
			$this->mdoffre->autreConditionsOffre = null;
			$this->mdoffre->piecesOffre = null;
			$this->mdoffre->dateClotureOffre = null;
			$this->mdoffre->cree_par = null;
			$this->mdoffre->idEmployeur = null;
			$this->mdoffre->etatOffre = 1;
		
		if((int) $offre_id >0)
		{
			$offre = $this->mdoffre->load((int) $offre_id);
			$data['offre'] = $offre;
			$data['employeur'] = $this->mdemployeur->load ( (int) $offre->idEmployeur);
			$data['idDomaineEtude'] = $offre->DomaineDEtude_idDomaineDEtude;
			$data['idSousDomaineEmploi'] = $offre->DomaineEmploi_idDomaineEmploi;// Se rappeler que c est le sous domaine emploi qui migre dans ce champ
			$domaineResult = $this->mdoffre->getDomaineEmploi((int) $offre->DomaineEmploi_idDomaineEmploi);
			$domaineEmploi = $domaineResult[0]['domaineemploi_idDomaineEmploi'];
			$data['domaineEmploi'] = $domaineEmploi;
			$data['listeSousDomaineEmploi'] = $this->mdoffre->getSousDomaineEmploi($data['domaineEmploi']);
			
			$data['idTypeContrat'] = $offre->TypeContrat_idTypeContrat;
			$data['idNiveauEtude'] = $offre->NiveauDetudes_idNiveauDetudes;
			$data['idPays'] = $offre->idPaysTravail;
			$dateDeCloture = DateTime::createFromFormat('Y-m-d',$offre->dateClotureOffre);
			$data['dateClotureOffre'] = $dateDeCloture->format('d/m/Y');
			
		}
		elseif($offre_id == 0){
			$data['offre'] = $this->mdoffre;
		}
		
		//var_dump($this->mdoffre);
		//exit();
		
		 if($this->input->post('btnSave'))
		{
			
			$this->mdoffre->idOffre = $this->input->post('offre_id');
			$this->mdoffre->numOffre = $this->input->post('numOffre');
			$this->mdoffre->posteOffre = $this->input->post('posteOffre');
			$this->mdoffre->profilrechercheOffre = $this->input->post('profilrechercheOffre');
			$this->mdoffre->nombrePostesOffre = $this->input->post('nombrePostesOffre');
			$this->mdoffre->DomaineDEtude_idDomaineDEtude=$this->input->post('DomaineDEtude_idDomaineDEtude');
			$this->mdoffre->DomaineEmploi_idDomaineEmploi=$this->input->post('sousdomaineemploi');
			$this->mdoffre->experienceProfessionnelleOffre=$this->input->post('experienceProfessionnelleOffre');
			$this->mdoffre->nbreAnExperienceProOffre=$this->input->post('nbreAnExperienceProOffre');
			$this->mdoffre->age=$this->input->post('age');
			$this->mdoffre->sexe=$this->input->post('sexe');
			$this->mdoffre->idPaysTravail=$this->input->post('idPaysTravail');
			$this->mdoffre->lieuTravailOffre=$this->input->post('lieuTravailOffre');
			$this->mdoffre->TypeContrat_idTypeContrat=$this->input->post('TypeContrat_idTypeContrat');
			$this->mdoffre->NiveauDetudes_idNiveauDetudes=$this->input->post('NiveauDetudes_idNiveauDetudes');
			$this->mdoffre->emailRepresentantEmployeur=$this->input->post('emailRepresentantEmployeur');
			$this->mdoffre->autreConditionsOffre=$this->input->post('autreConditionsOffre');
			$this->mdoffre->piecesOffre=$this->input->post('piecesOffre');
			$this->mdoffre->etatOffre = 1;
			
			
			//$dateCloture = DateTime::createFromFormat('d/m/Y', $this->input->post('dateClotureOffre'));
			$this->mdoffre->dateClotureOffre= date('d/m/Y',$this->input->post('dateClotureOffre'));
			//$dateCloture->format('Y-m-d');
			$this->mdoffre->cree_par = $data_session['idUtilisateur'];
			
			//$this->mdoffre->etatCandidat=1;
			// On retire l employeur depuis le formulaire ou de la session au cas il s agit de l employeur qui est connecté
			$idEmployeur = $this->input->post('employeur_id');
			$this->mdoffre->idEmployeur = $idEmployeur;
			
			
			// Persistance dans la base de données
			if(empty($this->mdoffre->idOffre)) // Cas de modification
			{
				$data['notification']= $this->mdoffre->insert_offre();
				
			}
			elseif($this->mdoffre->idOffre > 0)
			{
				$data['notification'] = $this->mdoffre->update_offre();
				
			}
		}
		 
		$data['DomaineDEtude_idDomaineDEtude']=$this->mdoffre->get_dom_etu_for_select();
		$data['DomaineEmploi_idDomaineEmploi']=$this->mdoffre->get_dom_emp_for_select();
		$data['idPaysTravail']=$this->mdoffre->get_pays_for_select();
		$data['NiveauDetudes_idNiveauDetudes']=$this->mdoffre->get_niv_etu_for_select();
		$data['TypeContrat_idTypeContrat']=$this->mdoffre->get_type_contrat_for_select();
        
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/nouvelle_offre',$data);
		$this->load->view('admin/footer',$data);
	}
        
        /**
         * 
         * Permet de rechercher une offre
         */
        public function rechercheoffre()
	{
                // $this->CheckUser();
            $this->load->model('admin/Model_offre', 'mdoffre');
            $data ['mesoffres']= $this->mdoffre->Mes_offre();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/rechercheoffre',$data);
		$this->load->view('admin/footer',$data);
	}
	
	
	 public function mes_demandeurs()
	{
                // $this->CheckUser();
		$this->load->model('admin/Model_candidat', 'mdcandidat');
		$data ['mes_demandeurs']= $this->mdcandidat->mes_demandeurs();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/mes_demandeurs',$data);
		$this->load->view('admin/footer',$data);
	}
	
	

	
	
	public function mes_demandeur_excel()
	{
//load PHPExcel library
$this->load->library('Excel');
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
 
// Set document properties
$objPHPExcel->getProperties()->setCreator("b.mignanwande@anpe.bj")
							 ->setLastModifiedBy("b.mignanwande@anpe.bj")
							 ->setTitle("Liste des demandeurs d emplois")
							 ->setSubject("Liste des demandeurs d emplois")
							 ->setDescription("Liste des demandeurs d emplois inscrits sur la plateforme de l'ANPE, generated by PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
 
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'N°')
            ->setCellValue('B1', 'Noms')
            ->setCellValue('C1', 'Prénoms')
            ->setCellValue('D1', 'Sexe')
            ->setCellValue('E1', 'Résidence')
			->setCellValue('F1', 'Contact')
			->setCellValue('G1', 'Age')
			->setCellValue('H1', 'Diplôme / Formation principale')
            ->setCellValue('I1', 'TER (ES ou EI)')
            ->setCellValue('J1', 'Catégorie (primo, chom, occ)')
            ->setCellValue('K1', 'Emplois principaux recherchés (Compétences associées à la formation principales)')
            ->setCellValue('L1', 'Durée d\'expérience pratique ')
			//->setCellValue('M1', 'Autres emplois recherchés (Autres domaines de compétences)')
			->setCellValue('N1', 'Programmes (CPEP, PAEI, RCDE)')
			->setCellValue('O1', 'Type de Mobilité (D, N, I)')
            ->setCellValue('P1', 'Prescription TRE')
            ->setCellValue('Q1', 'Autres Observations');
			
			
			$this->load->model('admin/Model_candidat', 'mdcandidat');
			$mes_demandeurs = $this->mdcandidat->mes_demandeurs();	
			
			$i=2;
			foreach ($mes_demandeurs as $demandeur ):
			 
              $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i,$demandeur->idCandidat)
            ->setCellValue('B'.$i, $demandeur->nomCandidat)
            ->setCellValue('C'.$i, $demandeur->prenomCandidat)
            ->setCellValue('D'.$i, $demandeur->sexeCandidat)
            ->setCellValue('E'.$i, $demandeur->adresseCandidat)
			->setCellValue('F'.$i, $demandeur->telephoneUnCandidat)
			->setCellValue('G'.$i, (date('Y') - date('Y',strtotime($demandeur->dateNaissanceCandidat))) )
			->setCellValue('H'.$i,$this->mdcandidat->diplome_obtenir($demandeur->idCandidat))
            ->setCellValue('I'.$i, $demandeur->typeemploiCandidat)
            ->setCellValue('J'.$i, "")
            ->setCellValue('K'.$i, $demandeur->intituleemploiCandidat)
            ->setCellValue('L'.$i, $demandeur->dureeTravailRechercheCandidat)
			//->setCellValue('M'.$i, $demandeur->intituleemploiCandidat)
			->setCellValue('N'.$i, "")
			->setCellValue('O'.$i, "")
			->setCellValue('P'.$i, "")
			->setCellValue('Q'.$i, "");
			           
		     $i=$i+1;                  
            endforeach;
			
// Rename worksheet (worksheet, not filename)
$objPHPExcel->getActiveSheet()->setTitle('MES_DEMANDEURS_'.date('d-m-Y'));
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
//clean the output buffer

if (ob_get_length() > 0) { ob_end_clean(); } 
 
//this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//so, we use this header instead.
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="MES_DEMANDEURS_'.date('d-m-Y').'.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
		
		
 
	}
	
	
	public function connexion_font()
	{
		//$this->CheckUser();
		$data=array();
		 
		//$this->load->view('wrapper',$data);
		$this->load->view('connexion_font',$data);

	}
	/*
         * 
         */
	public function recoverpw()
	{
		//$this->CheckUser();
		$data=array();
		 
		//$this->load->view('wrapper',$data);
		$this->load->view('recoverpw',$data);

	}
	
	public function register()
	{
		//$this->CheckUser();
		$data=array();
		 
		//$this->load->view('wrapper',$data);
		$this->load->view('register',$data);

	}
	
	
	
	
	
	public function panel()
	{
		//$this->CheckUser();
		$data=array();
		 
		//$this->load->view('wrapper',$data);
		$this->load->view('panel',$data);

	}
	
	public function typecontrat($id="")
	{
	
	 
		$data=array();
		$data['codetypecontrat']='';
		$data['libelletypecontrat']='';
		
	$this->load->model('Model_typecontrat','mdtypecontrat');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdtypecontrat->idTypeContrat=$this->input->post('codetypecontrat');
			
			$this->mdtypecontrat->libelle=$this->input->post('libelletypecontrat');
			$this->mdtypecontrat->qui="1";
			$this->mdtypecontrat->quand=date("Y-m-d H:i");
			 
			if($this->input->post('codetypecontrat')=="")
			{
				
				$res=$this->mdtypecontrat->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdtypecontrat->update($this->input->post('codetypecontrat'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdtypecontrat->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['codetypecontrat']=$row->idTypeContrat;
				$data['libelletypecontrat']=$row->libelle;
			}
			
		}

		$data['typecontrat']=$this->mdtypecontrat->get_all();
		
		//$this->CheckUser();
		 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/typecontrat',$data);
		$this->load->view('admin/footer',$data);

	}
	public function typecontrat_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_typecontrat','mdtypecontrat');
		$res=$this->mdtypecontrat->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/typecontrat');
	}
	
		public function secteuractivite($id="")
	{
	
	//$this->CheckUser();
		$data=array();
		$data['idSecteurActivite']='tptp';
		$data['libelle']='';
		
	$this->load->model('Model_secteuractivite','mdsecteuractivite');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdsecteuractivite->idSecteurActivite=$this->input->post('idSecteurActivite');
			
			$this->mdsecteuractivite->libelle=$this->input->post('libelle');
			$this->mdsecteuractivite->qui="1";
			$this->mdsecteuractivite->quand=date("Y-m-d H:i");
			 
			if($this->input->post('idSecteurActivite')=="")
			{
				
				$res=$this->mdsecteuractivite->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdsecteuractivite->update($this->input->post('idSecteurActivite'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdsecteuractivite->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idSecteurActivite']=$row->idSecteurActivite;
				$data['libelle']=$row->libelle;
			}
			
		}
	 
		
	
		$data['secteuractivite']=$this->mdsecteuractivite->get_all();
		/*var_dump($data['secteuractivite']);
											exit();*/
		//$this->CheckUser();
		//$data=array();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/secteuractivite',$data);
		$this->load->view('admin/footer',$data);

	}
		public function secteuractivite_del($id)
	{
		// $this->CheckUser();
		
		$this->load->model('Model_secteuractivite','mdsecteuractivite');
		$res=$this->mdsecteuractivite->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/secteuractivite');
	}
	 
	
	public function pays($id="")
	{
	
	//$this->CheckUser();
		$data=array();
		$data['idPays']='';
		$data['nomPays']='';
		
	$this->load->model('Model_pays','mdpays');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdpays->idPays=$this->input->post('idPays');
			
			$this->mdpays->nomPays=$this->input->post('nomPays');
			$this->mdpays->qui="1";
			$this->mdpays->quand=date("Y-m-d H:i");
			 
			if($this->input->post('idSecteurActivite')=="")
			{
				
				$res=$this->mdpays->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdpays->update($this->input->post('idPays'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdpays->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idPays']=$row->idPays;
				$data['nomPays']=$row->nomPays;
			}
			
		}
	 
		
	
		$data['pays']=$this->mdpays->get_all();
		
		//$this->CheckUser();
		 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/pays',$data);
		$this->load->view('admin/footer',$data);

	}
		public function pays_del($id)
	{
		// $this->CheckUser();
		
		$this->load->model('Model_pays','mdpays');
		$res=$this->mdpays->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reponse_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/pays');
	}
	 
	public function langue($id="")
	{
	
	//$this->CheckUser();
		$data=array();
		$data['idLangue']='';
		$data['libelleLangue']='';
		
	$this->load->model('Model_langue','mdlangue');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdlangue->idLangue=$this->input->post('idLangue');
			
			$this->mdlangue->libelleLangue=$this->input->post('libelleLangue');
			$this->mdlangue->qui="1";
			$this->mdlangue->quand=date("Y-m-d H:i");
			 
			if($this->input->post('idLangue')=="")
			{
				
				$res=$this->mdlangue->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdlangue->update($this->input->post('idLangue'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdlangue->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idLangue']=$row->idLangue;
				$data['libelleLangue']=$row->libelleLangue;
			}
			
		}
	 
		
	
		$data['langue']=$this->mdlangue->get_all();
		
		//$this->CheckUser();
		 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/langue',$data);
		$this->load->view('admin/footer',$data);

	}
		public function langue_del($id)
	{
		// $this->CheckUser();
		
		$this->load->model('Model_langue','mdlangue');
		$res=$this->mdlangue->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/langue');
	}
	 
	
	public function competences($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['idCompetences']='';
		$data['nom_competences']='';
		$data['idDomaineCompetence']='';
		
		//$data['key']='';
		
		$this->load->model('Model_competences','mdcompetences');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdcompetences->idCompetences=$this->input->post('idCompetences');
			
			$this->mdcompetences->competences=$this->input->post('nom_competences');
			$this->mdcompetences->idDomaineCompetence=$this->input->post('idDomaineCompetence');
			$this->mdcompetences->qui="1";
			$this->mdcompetences->quand=date("Y-m-d H:i");
			
			/*var_dump($this->input->post('idDomaineCompetence'));
			exit();*/
			 
			if($this->input->post('idCompetences')=="")
			{
				
				$res=$this->mdcompetences->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdcompetences->update($this->input->post('idCompetences'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdcompetences->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idCompetences']=$row->idCompetences;
				$data['nom_competences']=$row->competences;
				$data['nomDomaineCompetence']=$row->idDomaineCompetence;
			}
			
		}
	 
	 $this->load->model('Model_domainecompetence','mddomainecompetence');
		$data['domainecompetence']=$this->mddomainecompetence->get_all_for_select();
	 
		
	
		$data['competences']=$this->mdcompetences->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/competences',$data);
		$this->load->view('admin/footer');
	}
	
	public function competences_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_competences','mdcompetences');
		$res=$this->mdcompetences->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/competences');
	}
	
	public function departement($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['idDepartement']='';
		$data['nomDepartement']='';
		
		//$data['key']='';
		
		$this->load->model('Model_departement','mddepartement');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mddepartement->idDepartement=$this->input->post('idDepartement');
			
			$this->mddepartement->nomDepartement=$this->input->post('nomDepartement');
			$this->mddepartement->qui="1";
			$this->mddepartement->quand=date("Y-m-d H:i");
			 
			if($this->input->post('idDepartement')=="")
			{
				
				$res=$this->mddepartement->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mddepartement->update($this->input->post('idDepartement'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mddepartement->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idDepartement']=$row->idDepartement;
				$data['nomDepartement']=$row->nomDepartement;
			}
			
		}
	 
		
	
		$data['departement']=$this->mddepartement->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/departement',$data);
		$this->load->view('admin/footer');
	}
	
	public function departement_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_departement','mddepartement');
		$res=$this->mdcompetences->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/departement');
	}
	
	
	
	
	public function devise($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['iddevise']='';
		$data['libelleDevise']='';
		
		//$data['key']='';
		
		$this->load->model('Model_devise','mddevise');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mddevise->iddevise=$this->input->post('iddevise');
			
			$this->mddevise->libelleDevise=$this->input->post('libelleDevise');
			$this->mddevise->qui="1";
			$this->mddevise->quand=date("Y-m-d H:i");
			 
			if($this->input->post('iddevise')=="")
			{
				
				$res=$this->mddevise->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mddevise->update($this->input->post('iddevise'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mddevise->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['iddevise']=$row->iddevise;
				$data['libelleDevise']=$row->libelleDevise;
			}
			
		}
	 
		
	
		$data['devise']=$this->mddevise->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/devise',$data);
		$this->load->view('admin/footer');
	}
	
	public function devise_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_devise','mddevise');
		$res=$this->mdcompetences->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/devise');
	}
	
	
	public function domainecompetence($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['idDomaineCompetence']='';
		$data['nomDomaineCompetence']='';
		
		//$data['key']='';
		
		$this->load->model('Model_domainecompetence','mddomainecompetence');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mddomainecompetence->idDomaineCompetence=$this->input->post('idDomaineCompetence');
			
			$this->mddomainecompetence->nomDomaineCompetence=$this->input->post('nomDomaineCompetence');
			$this->mddomainecompetence->qui="1";
			$this->mddomainecompetence->quand=date("Y-m-d H:i");
			 
			if($this->input->post('idDomaineCompetence')=="")
			{
				
				$res=$this->mddomainecompetence->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mddomainecompetence->update($this->input->post('idDomaineCompetence'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mddomainecompetence->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idDomaineCompetence']=$row->idDomaineCompetence;
				$data['nomDomaineCompetence']=$row->nomDomaineCompetence;
			}
			
		}
	 
		
	
		$data['domainecompetence']=$this->mddomainecompetence->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/domainecompetence',$data);
		$this->load->view('admin/footer');
	}
	
	public function domainecompetence_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_domainecompetence','mddomainecompetence');
		$res=$this->mddomainecompetence->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/domainecompetence');
	}
		
	
	public function domaineedetude($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['idDomaineDEtude']='';
		$data['nomDomaineDEtude']='';
		
		//$data['key']='';
		
		$this->load->model('Model_domaineetude','mddomaineetude');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mddomaineetude->idDomaineDEtude=$this->input->post('idDomaineDEtude');
			
			$this->mddomaineetude->nomDomaineDEtude=$this->input->post('nomDomaineDEtude');
			$this->mddomaineetude->qui="1";
			$this->mddomaineetude->ou="1";
			$this->mddomaineetude->quand=date("Y-m-d H:i");
			 
			if($this->input->post('idDomaineDEtude')=="")
			{
				
				$res=$this->mddomaineetude->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mddomaineetude->update($this->input->post('idDomaineDEtude'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mddomaineetude->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idDomaineDEtude']=$row->idDomaineDEtude;
				$data['nomDomaineDEtude']=$row->nomDomaineDEtude;
			}
			
		}
	 
		
	
		$data['domaineedetude']=$this->mddomaineetude->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/domaineedetude',$data);
		$this->load->view('admin/footer');
	}
	
	public function domaineetude_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_domaineetude','mddomaineetude');
		$res=$this->mddomaineetude->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/domaineedetude');
	}
	
	
	
	
	
	public function programmes($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['idProgramme']='';
		$data['libelleProgramme']='';
		$data['actif']='';
		
		//$data['key']='';
		
		$this->load->model('Model_programme','mdprogramme');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdprogramme->idProgramme=$this->input->post('idProgramme');
			
			$this->mdprogramme->libelleProgramme=$this->input->post('libelleProgramme');
			if($this->input->post('actif')=='on')
			{
				$this->mdprogramme->actif=1;
			}
			else
			{
				$this->mdprogramme->actif=0;
			}
			
			$this->mdprogramme->qui="1";
			$this->mdprogramme->quand=date("Y-m-d H:i");
			
			
			 
			if($this->input->post('idProgramme')=="")
			{
				
				
				$res=$this->mdprogramme->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdprogramme->update($this->input->post('idProgramme'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdprogramme->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idProgramme']=$row->idProgramme;
				$data['libelleProgramme']=$row->libelleProgramme;
			}
			
		}
	 
		
	
		$data['programmes']=$this->mdprogramme->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/programmes',$data);
		$this->load->view('admin/footer');
	}
	
	public function progamme_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_programme','mdprogramme');
		$res=$this->mdprogramme->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/programmes');
	}
	
	
		
	
	public function search_candidat()
	{
		
		
		    $this->CheckUser();
            $this->load->model('admin/Model_candidat', 'mdcandidat');
          
			
			$this->mdcandidat->nom = "";
			$this->mdcandidat->prenom = "";
			$this->mdcandidat->telephone = "";
			$this->mdcandidat->email ="";
			$this->mdcandidat->idDepartement = "";
			$this->mdcandidat->idProgramme ="";
		  $data['notification']="";
			
		 
			
			$data ['top500candidat'] =array();
			 
			 
		if($this->input->post('btnSave'))
		{
			$this->mdcandidat->nom = $this->input->post('nom');
			$this->mdcandidat->prenom = $this->input->post('prenom');
			$this->mdcandidat->telephone = $this->input->post('telephone');
			$this->mdcandidat->email = $this->input->post('email');
			$this->mdcandidat->idDepartement =  $this->input->post('idDepartement');
			$this->mdcandidat->idProgramme =  $this->input->post('idProgramme');
			
            $data ['top500candidat'] = $this->mdcandidat->top500candidat();         

		}
		
		if($this->input->post('export_excel'))
		{
			$this->mdcandidat->nom = $this->input->post('nom');
			$this->mdcandidat->prenom = $this->input->post('prenom');
			$this->mdcandidat->telephone = $this->input->post('telephone');
			$this->mdcandidat->email = $this->input->post('email');
			$this->mdcandidat->idDepartement =  $this->input->post('idDepartement');
			$this->mdcandidat->idProgramme =  $this->input->post('idProgramme');
			
			$this->search_candidat_excel($this->mdcandidat);
			
                

		}
		
		if($this->input->post('btnSendmail'))
		{
			 $this->mdcandidat->liste_choix=$this->input->post('liste_choix');
			 $this->mdcandidat->message_mail=$this->input->post('message_mail');
			 $this->mdcandidat->objet_mail=$this->input->post('objet_mail');
			 
			 if (count($this->mdcandidat->liste_choix)>0)
			foreach ($this->mdcandidat->liste_choix as $hobys=>$value) 
			{
				//if (LoadId($value)[0])
				$lecandidat=$this->mdcandidat->LoadId($value);
				
				$this->load->library('email');

				$this->email->set_mailtype("html");
				$this->email->from('inscription.admin@anpe.bj', $this->mdcandidat->objet_mail);
				$this->email->to($lecandidat[0]->emailCandidat);
				/*$this->email->cc('another@another-example.com');
				$this->email->bcc('them@their-example.com');*/
				
				$this->email->subject('Confirmation de votre inscription sur le portail de l emploi de l ANPE');
				$this->email->message('<html>
				
				<body>
				<p style="">
				'.$this->mdcandidat->message_mail.'
				</p>
				</body>
				</html>');
				
				$this->email->send();
				
				
			 }
			 
		
			 
			 
			// $this->mdcandidat->send_mail_liste(); 
			 
			 
			 
			 
		     $data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>Mail envoyé avec succès.<div>"
					});';
		}
		
		
		if($this->input->post('btnSendsms'))
		{
			 $this->mdcandidat->liste_choix=$this->input->post('liste_choix');
			 $this->mdcandidat->message_mail=$this->input->post('message_sms');
			
			 
			 $this->mdcandidat->send_sms_liste(); 
		     $data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>SMS envoyé avec succès.<div>"
					});';
		}
		
		
		$this->load->model('Model_departement','mddepartement');
		$data['departement']=$this->mddepartement->get_all_for_select();
		
		$this->load->model('Model_programme','mdprogramme');
		$data['programme']=$this->mdprogramme->get_all_for_select();
		
		$data['rechercher']=$this->mdcandidat;
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/search_candidat',$data);
		$this->load->view('admin/footer',$data);
		

	
		

	}
	
	
	public function detailCandidat()
	{
		$offre_id = $this->uri->segment('3');
		 
		$this->load->model('admin/Model_candidat', 'mdcandidat');
		$candidat = $this->mdcandidat->LoadId((int) $offre_id );
		
		
		$data['numCINCandidat']=$candidat[0]->numCINCandidat;
		$data['idCandidat']=$candidat[0]->idCandidat;
		$data['nomCandidat']=$candidat[0]->nomCandidat;
		$data['prenomCandidat']=$candidat[0]->prenomCandidat;
		$data['sexeCandidat']=$candidat[0]->sexeCandidat;
		$data['dateNaissanceCandidat']=$candidat[0]->dateNaissanceCandidat;
		$data['lieuNaissanceCandidat']=$candidat[0]->lieuNaissanceCandidat;
		$data['paysNaissanceCandidat']=$candidat[0]->paysNaissanceCandidat;
		$data['nationaliteCandidat']=$candidat[0]->nationaliteCandidat;
		$data['situationFamilleCandidat']=$candidat[0]->situationFamilleCandidat;
		$data['numeroPassportCandidat']=$candidat[0]->numeroPassportCandidat;
		$data['adresseCandidat']=$candidat[0]->adresseCandidat;
		$data['telephoneUnCandidat']=$candidat[0]->telephoneUnCandidat;
		$data['telephoneDeuxCandidat']=$candidat[0]->telephoneDeuxCandidat;
		$data['emailCandidat']=$candidat[0]->emailCandidat;
		
		$data['candidat'] = $candidat;
		 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/detailCandidat',$data);
		$this->load->view('admin/footer',$data);
	}
	
	
	
	
	public function search_candidat_excel($mdcandidat)
	{
		
		
		   $this->CheckUser();
             $this->load->model('admin/Model_candidat', 'mdcandidat');
          
			
			$this->mdcandidat->nom = $mdcandidat->nom;
			$this->mdcandidat->prenom = $mdcandidat->prenom;
			$this->mdcandidat->telephone = $mdcandidat->telephone;
			$this->mdcandidat->email = $mdcandidat->email;
			$this->mdcandidat->idDepartement =  $mdcandidat->idDepartement;
			$this->mdcandidat->idProgramme = $mdcandidat->idProgramme;
			
		
            $mes_demandeurs = $this->mdcandidat->search_candidat_excel();         
                       
           
		
//load PHPExcel library
$this->load->library('Excel');
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
 
// Set document properties
$objPHPExcel->getProperties()->setCreator("b.mignanwande@anpe.bj")
							 ->setLastModifiedBy("b.mignanwande@anpe.bj")
							 ->setTitle("Liste des demandeurs d emplois")
							 ->setSubject("Liste des demandeurs d emplois")
							 ->setDescription("Liste des demandeurs d emplois inscrits sur la plateforme de l'ANPE, generated by PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
 
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'N°')
            ->setCellValue('B1', 'Noms')
            ->setCellValue('C1', 'Prénoms')
            ->setCellValue('D1', 'Sexe')
            ->setCellValue('E1', 'Résidence')
			->setCellValue('F1', 'Contact')
			->setCellValue('G1', 'Age')
			->setCellValue('H1', 'Diplôme / Formation principale')
            ->setCellValue('I1', 'TER (ES ou EI)')
            ->setCellValue('J1', 'Catégorie (primo, chom, occ)')
            ->setCellValue('K1', 'Emplois principaux recherchés (Compétences associées à la formation principales)')
            ->setCellValue('L1', 'Durée d\'expérience pratique ')
			//->setCellValue('M1', 'Autres emplois recherchés (Autres domaines de compétences)')
			->setCellValue('N1', 'Programmes (CPEP, PAEI, RCDE)')
			->setCellValue('O1', 'Type de Mobilité (D, N, I)')
            ->setCellValue('P1', 'Prescription TRE')
            ->setCellValue('Q1', 'Autres Observations');
			
			
			
			
			$i=2;
			foreach ($mes_demandeurs as $demandeur ):
			 
              $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i,$demandeur->idCandidat)
            ->setCellValue('B'.$i, $demandeur->nomCandidat)
            ->setCellValue('C'.$i, $demandeur->prenomCandidat)
            ->setCellValue('D'.$i, $demandeur->sexeCandidat)
            ->setCellValue('E'.$i, $demandeur->adresseCandidat)
			->setCellValue('F'.$i, $demandeur->telephoneUnCandidat)
			->setCellValue('G'.$i, (date('Y') - date('Y',strtotime($demandeur->dateNaissanceCandidat))) )
			->setCellValue('H'.$i,$this->mdcandidat->diplome_obtenir($demandeur->idCandidat))
            ->setCellValue('I'.$i, $demandeur->typeemploiCandidat)
            ->setCellValue('J'.$i, "")
            ->setCellValue('K'.$i, $demandeur->intituleemploiCandidat)
            ->setCellValue('L'.$i, $demandeur->dureeTravailRechercheCandidat)
			//->setCellValue('M'.$i, $demandeur->intituleemploiCandidat)
			->setCellValue('N'.$i, "")
			->setCellValue('O'.$i, "")
			->setCellValue('P'.$i, "")
			->setCellValue('Q'.$i, "");
			           
		     $i=$i+1;                  
            endforeach;
			
// Rename worksheet (worksheet, not filename)
$objPHPExcel->getActiveSheet()->setTitle('MES_DEMANDEURS_'.date('d-m-Y'));
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
//clean the output buffer

if (ob_get_length() > 0) { ob_end_clean(); } 
 
//this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//so, we use this header instead.
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="MES_DEMANDEURS_'.date('d-m-Y').'.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
		
		
 
	}
	
	
	
	public function offre_emploi()
	{
		
		
		  $this->CheckUser();
            $this->load->model('Model_offre', 'mdoffre');
            $this->load->model('Model_typecontrat', 'mdtypecontrat');
            $this->load->model('Model_niveaudetudes', 'mdniveaudetudes');
            //$this->load->model('Model_typecontrat', 'mdtypecontrat');
            $data['idTypeDeContrat'] = $this->mdtypecontrat->get_all_for_select();
            $data['idPaysTravail'] = $this->mdoffre->get_pays_for_select();
            $data['idNiveauDetudes'] = $this->mdniveaudetudes->get_all_for_select();
			//$conditions = array();   
			$this->load->model('Model_offre', 'mdoffre');
			
			
			$this->mdoffre->reference = "";
			$this->mdoffre->employeurId = "";
			$this->mdoffre->poste = "";
			$this->mdoffre->lieudetravail ="";
			$this->mdoffre->idPaysTravail = "";
			$this->mdoffre->idNiveauDetudes =  "";
			$this->mdoffre->idTypeContrat = "";
			$this->mdoffre->datedepublication ="";
			
			$this->mdoffre->datedecloture = "";
			
			
			 $data ['top50offres'] = $this->mdoffre->top50offres();
			 
		if($this->input->post('btnSave'))
		{
			$this->mdoffre->reference = $this->input->post('reference');
			$this->mdoffre->employeurId = $this->input->post('employeur');
			$this->mdoffre->poste = $this->input->post('poste');
			$this->mdoffre->lieudetravail = $this->input->post('lieudetravail');
			$this->mdoffre->idPaysTravail =  $this->input->post('idPaysTravail');
			$this->mdoffre->idNiveauDetudes =  $this->input->post('idNiveauDetudes');
			$this->mdoffre->idTypeContrat =  $this->input->post('idTypeContrat');
			$this->mdoffre->datedepublication = date('d-m-Y',strtotime($this->input->post('datedepublication'))) ;
			
			$this->mdoffre->datedecloture = date('d-m-Y',strtotime($this->input->post('datedecloture'))) ;  
			   
			
                $data ['top50offres'] = $this->mdoffre->top50offres();         
                       
                         
			/*
                        
                        if($this->input->post('codetypecontrat')=="")
			{
				
				$res=$this->mdtypecontrat->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdtypecontrat->update($this->input->post('codetypecontrat'));
				$id="";
			}
			 */
		}
		
		//var_dump($this->mdoffre);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$data['rechercher']=$this->mdoffre;
		$this->load->view('admin/offre_emploi',$data);
		$this->load->view('admin/footer',$data);
		

	
		

	}
	
	
	
	public function detailOffre()
	{
		
		$this->CheckUser();
		$offre_id = $this->uri->segment('3');
		
		$this->load->model('admin/Model_offre', 'adminmdoffre');
		$offre = $this->adminmdoffre->load((int) $offre_id );
		
		
		$this->load->model('Model_pays', 'mdpays');
		$data['paysdetravail'] = $this->mdpays->LoadId($offre->idPaysTravail);
		
		$this->load->model('Model_utilisateur', 'mdutilisateur');
		
		$data['antenne'] = $this->mdutilisateur->getAntenne($offre->cree_par);
		$data['nomAgence'] ="";
		$data['telephoneAgence'] ="";
		if (!empty($data['antenne']))
		{
			$antenne=$data['antenne'];
			$data['nomAgence'] =$antenne->nomAgence;
			$data['telephoneAgence'] =$antenne->telephoneAgence;
		}
		
		
		
		$data['offre'] = $offre;
		 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		 
		$this->load->view('admin/offre_detail',$data);
		$this->load->view('admin/footer',$data);
	}
	
	
	
	public function traiterOffre()
	{
		$this->CheckUser();
		$offre_id = $this->uri->segment('3');
		
		$this->load->model('admin/Model_offre', 'adminmdoffre');
		$offre = $this->adminmdoffre->load((int) $offre_id );
		
		$data['type_liste'] ="potentiel";
		
		$this->load->model('Model_pays', 'mdpays');
		$data['paysdetravail'] = $this->mdpays->LoadId($offre->idPaysTravail);
		
		$this->load->model('Model_utilisateur', 'mdutilisateur');
		
		$data['antenne'] = $this->mdutilisateur->getAntenne($offre->cree_par);
		$data['nomAgence'] ="";
		$data['telephoneAgence'] ="";
		if (!empty($data['antenne']))
		{
			$antenne=$data['antenne'];
			$data['nomAgence'] =$antenne->nomAgence;
			$data['telephoneAgence'] =$antenne->telephoneAgence;
		}
		
		
		$this->load->model('admin/Model_candidat', 'mdcandidat');  
		$this->mdcandidat->idNiveauDetudes=$offre->idNiveauDetudes;
		$this->mdcandidat->idDomaineDEtude=$offre->idDomaineDEtude;
		/*var_dump($this->mdcandidat->candidat_par_niveau_domaine());
		exit();*/
        $data ['candidat_par_niveau_domaine'] = $this->mdcandidat->candidat_par_niveau_domaine(); 
		 $data ['titre_tableau'] ="Liste des candidats potentiels";
		
		$this->load->model('admin/Model_offrecandidat', 'mdoffrecandidat');  
		if($this->input->post('btnSelection'))
		{
			 
			$this->mdoffrecandidat->offre_id=$offre_id;
			$this->mdoffrecandidat->liste_choix=$this->input->post('liste_choix');
			
			/*var_dump($this->mdoffrecandidat->liste_choix);
			exit();*/
			 
			$this->mdoffrecandidat->affecter_candidat(); 
			
		 //  redirect('admin/traiterOffre/'.$offre_id);
			 
		}
		
		
		if($this->input->post('btnAffecter'))
		{
			 $data ['titre_tableau'] ="Liste des candidats selectionnés";
			 
			 $this->mdoffrecandidat->idDomaineDEtude=$offre->idDomaineDEtude;
			 
			 $data ['candidat_par_niveau_domaine'] = $this->mdoffrecandidat->candidat_selectionner(); 
			 
			 $data['type_liste'] ="affecter";
		 
		}
		
		
		
		if($this->input->post('btnSupprimer'))
		{
			$this->mdoffrecandidat->offre_id=$offre_id;
			$this->mdoffrecandidat->liste_choix=$this->input->post('liste_choix');
			 
			$this->mdoffrecandidat->sup_candidat_affecter(); 
			
			$data ['titre_tableau'] ="Liste des candidats selectionnés";
			 
			 $this->mdoffrecandidat->idDomaineDEtude=$offre->idDomaineDEtude;
			 $data ['candidat_par_niveau_domaine'] = $this->mdoffrecandidat->candidat_selectionner(); 
			 
			 $data['type_liste'] ="affecter";
		 
		}
		
		
		
		
		
		/*var_dump($offre->idNiveauDetudes);
		var_dump($offre->idDomaineDEtude);
		exit();*/
		
		$data['offre'] = $offre;
		 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		 
		$this->load->view('admin/traiterOffre',$data);
		$this->load->view('admin/footer',$data);
	}
	
	
	public function profil($id="")
	{
		$this->CheckUser();
		$this->CheckDroit('view_profil');
		$data=array();
		$data['nom']='';
		$data['code']='';
		
		$data['key']='';
		
		$this->load->model('Model_profil','mdprofil');
	
		if($this->input->post('btnSave'))
		{
			 
			$this->mdprofil->nom=$this->input->post('nom');
			$this->mdprofil->code=$this->input->post('code');
			
			$this->mdprofil->id=$this->input->post('key');
			 
			
			if($this->mdprofil->id=="")
				$this->mdprofil->insert();
			else 
			{
				$this->mdprofil->update();
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdprofil->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['nom']=$row->Nom;
				$data['code']=$row->code;
				$data['key']=$row->Id;
			}
			
		}
		
	
		$data['profil']=$this->mdprofil->get_all();
		
		/*$this->load->view('header',$data);
        $this->load->view('admin/menu',$data);
        $this->load->view('admin/utilisateur',$data);
        //$this->load->view('footer',$data);*/
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/profil',$data);
		$this->load->view('admin/footer',$data);

	}
	
	public function profil_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_profil','mdprofil');
		$res=$this->mdprofil->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/profil');
	}
	
	
	
	public function profil_droit($id="")
	{
		$this->CheckUser();
		$this->CheckDroit('view_droit');
		$data=array();
		$data['nom']='';
		$data['profil_id']='';
		$data['droit_id']='';
		
		$data['key']='';
		
		$this->load->model('Model_profil_droit','mdprofil_droit');
		if($this->input->post('btnSave'))
		{
			
			$this->mdprofil_droit->profil_id=$this->input->post('profil_id');
			$this->mdprofil_droit->droit_id=$this->input->post('droit_id');
			$this->mdprofil_droit->qui=1;
			
			$res=$this->mdprofil_droit->insert();
			if ($res==1)
			$this->session->set_flashdata('reposne_querry', 'ce droit existe deja pour ce profil');
			
			
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdprofil_droit->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['nom']=$row->Nom;
				$data['key']=$row->Id;
			}
			
		}
		$this->load->model('Model_profil','mdprofil');
		$data['profil']=$this->mdprofil->get_all_for_select();
		 
		$data['droit']=$this->mdprofil_droit->get_droit_for_select();
		$data['profil_droit']=$this->mdprofil_droit->get_all();
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/profil_droit',$data);
		$this->load->view('admin/footer',$data);

	}
	
	public function profil_droit_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_profil_droit','mdprofil_droit');
		$res=$this->mdprofil_droit->delete($id);
		/*if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');*/
		redirect('admin/profil_droit');
	}
	
	public function bureau($id="")
	{
		$this->CheckUser();
		$data=array();
		$data['code']='';
		$data['nom']='';
		$data['agence_id']='';
		
		//$data['key']='';
		
		$this->load->model('Model_bureau','mdbureau');
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdbureau->nom=$this->input->post('nom');
			
			$this->mdbureau->code=$this->input->post('code');
			$this->mdbureau->agence_id=$this->input->post('agence_id');
			$this->mdbureau->qui="1";
			$this->mdbureau->quand=date("Y-m-d H:i");
			 
			if($this->input->post('key')=="")
			{
				$res=$this->mdbureau->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdbureau->update($this->input->post('key'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdbureau->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['nom']=$row->nom;
				$data['code']=$row->code;
				$data['agence_id']=$row->agence_id;
			}
			
		}
		
		$this->load->model('Model_agence','mdagence');
		$data['agence']=$this->mdagence->get_all_for_select();
	
		$data['bureau']=$this->mdbureau->get_all();
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('bureau',$data);
		$this->load->view('footer',$data);

	}
	
	public function bureau_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_bureau','mdbureau');
		$res=$this->mdbureau->delete($id);
		if ($res==1)
		{
			$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
			redirect('welcome/bureau');
		}
	}
	
	
	
	
	public function cv_candidat($id="")
	{
		
		$this->CheckUser();
		$data_session=$this->session->userdata('emploiuser');
		//var_dump( $data_session);

		
		$data=array();
		$data['notification']='';
		$data['numCINCandidat']='';
		$data['idCandidat']='';
		$data['nomCandidat']='';
		$data['prenomCandidat']='';
		$data['sexeCandidat']='';
		$data['dateNaissanceCandidat']='';
		$data['lieuNaissanceCandidat']='';
		$data['paysNaissanceCandidat']='';
		$data['nationaliteCandidat']='';
		$data['situationFamilleCandidat']='';
		$data['numeroPassportCandidat']='';
		$data['adresseCandidat']='';
		$data['lieuResidenceCandidat']='';
		$data['idDepartement']='';
		$data['telephoneUnCandidat']='';
		$data['telephoneDeuxCandidat']='';
		$data['emailCandidat']='';
		$data['intituleemploiCandidat']='';
		$data['ideedeprojetCandidat']='';
		$data['numPieceCandidat']='';
		$data['antenne_id']='';
		$data['typeemploirecherche']='';
		
		
		$this->load->model('Model_offre','mdoffre');
		$this->load->helper(array('form', 'url'));		
		
		$this->load->library('form_validation');
		
		$this->load->model('Model_candidat','mdcandidat');
		 if($this->input->post('btnSave'))
		{
			// form validation
			$this->form_validation->set_rules('nomCandidat', 'Nom', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('prenomCandidat', 'Prenom', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('sexeCandidat', 'Sexe', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('dateNaissanceCandidat', 'Date de Naissance', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('lieuNaissanceCandidat', 'Lieu de Naissance', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('paysNaissanceCandidat', 'Pays de Naissance', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('nationaliteCandidat', 'Nationalité', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('situationFamilleCandidat', 'Situation matrimoniale', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('idDepartement', 'Departement de résidence', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('lieuResidenceCandidat', 'Lieu de résidence', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('telephoneUnCandidat', 'N° Téléphone', 'required',
                        array('required' => 'Le champ %s est requis')
                );
			$this->form_validation->set_rules('emailCandidat', 'Email', 'required|valid_email',
                        array('required' => 'Le champ %s est requis')
                );
				
			if ($this->form_validation->run() == FALSE)
			{
				$validation_errors = $this->form_validation->error_array();
				$data = $this->input->post(NULL);
				$data['validation_errors'] = $validation_errors;
				$data['notification'] = -1;
			}
			else
			{
				// we retrieve data and pass to 
				if($this->input->post('type_piece') == 'ci')
				{
					$this->mdcandidat->numCINCandidat=$this->input->post('numPieceCandidat');
				}
				elseif($this->input->post('type_piece') == 'pp')
				{
					$this->mdcandidat->numeroPassportCandidat=$this->input->post('numPieceCandidat');
				}
			
				$this->mdcandidat->idCandidat=$this->input->post('idCandidat');
				$this->mdcandidat->nomCandidat=$this->input->post('nomCandidat');
				$this->mdcandidat->prenomCandidat=$this->input->post('prenomCandidat');
				$this->mdcandidat->sexeCandidat=$this->input->post('sexeCandidat');
				
				$dateNaissance = DateTime::createFromFormat('d/m/Y', $this->input->post('dateNaissanceCandidat'));
				
				$this->mdcandidat->dateNaissanceCandidat=$dateNaissance->format('Y-m-d');
				$this->mdcandidat->lieuNaissanceCandidat=$this->input->post('lieuNaissanceCandidat');
				$this->mdcandidat->paysNaissanceCandidat=$this->input->post('paysNaissanceCandidat');
				$this->mdcandidat->nationaliteCandidat=$this->input->post('nationaliteCandidat');
				$this->mdcandidat->situationFamilleCandidat=$this->input->post('situationFamilleCandidat');
				$this->mdcandidat->idDepartement=$this->input->post('idDepartement');
				$this->mdcandidat->lieuResidenceCandidat=$this->input->post('lieuResidenceCandidat');
				$this->mdcandidat->adresseCandidat=$this->input->post('adresseCandidat');
				$this->mdcandidat->telephoneUnCandidat=$this->input->post('telephoneUnCandidat');
				$this->mdcandidat->telephoneDeuxCandidat=$this->input->post('telephoneDeuxCandidat');
				$this->mdcandidat->antenne_id=$this->input->post('antenne_id');
				
				$this->mdcandidat->emailCandidat=$this->input->post('emailCandidat');
				$id=$this->input->post('idCandidat');
		
			/* var_dump(date('Y-m-d',strtotime($this->input->post('dateNaissanceCandidat'))));
			exit();
				*/
				$data['notification']= $this->mdcandidat->update_candidat();
				//redirect('welcome/pre_insert');
			}
		}
		 
		
		/* if ( $id!=$data_session['idCandidat'])
		redirect('welcome/connexion_font');*/
		 
		 
		 if($id!="")
		{
			
			$employeur = $this->mdcandidat->LoadId($id);
			/*var_dump($employeur[0]->nomCandidat);
		exit();
			if($employeur->num_rows()==1)
			{*/
				 
				if(!empty($employeur[0]->numCINCandidat))
				{
					$data['numPieceCandidat'] = $employeur[0]->numCINCandidat;
					$data['type_piece'] = "ci";
				}
				else
				{
					$data['numPieceCandidat'] = $employeur[0]->numeroPassportCandidat;
					$data['type_piece'] = "pp";
				}
				$data['idCandidat']=$employeur[0]->idCandidat;
				$data['nomCandidat']=$employeur[0]->nomCandidat;
				$data['prenomCandidat']=$employeur[0]->prenomCandidat;
				$data['sexeCandidat']=$employeur[0]->sexeCandidat;
				$data['dateNaissanceCandidat']= date('d/m/Y',strtotime($employeur[0]->dateNaissanceCandidat));
			//	DateTime::createFromFormat('Y-m-d',$employeur[0]->dateNaissanceCandidat)->format('d/m/Y');
				$data['lieuNaissanceCandidat']=$employeur[0]->lieuNaissanceCandidat;
				$data['paysNaissanceCandidat']=$employeur[0]->paysNaissanceCandidat;
				$data['nationaliteCandidat']=$employeur[0]->nationaliteCandidat;
				$data['situationFamilleCandidat']=$employeur[0]->situationFamilleCandidat;
				$data['adresseCandidat']=$employeur[0]->adresseCandidat;
				$data['telephoneUnCandidat']=$employeur[0]->telephoneUnCandidat;
				$data['telephoneDeuxCandidat']=$employeur[0]->telephoneDeuxCandidat;
				$data['emailCandidat']=$employeur[0]->emailCandidat;
				$data['lieuResidenceCandidat']=$employeur[0]->lieuResidenceCandidat;
				$data['idDepartement']=$employeur[0]->idDepartement;
				$data['reference_cv']=$employeur[0]->reference_cv;
				$data['conn_info_cv']=$employeur[0]->conn_info_cv;
				$data['conn_lang_cv']=$employeur[0]->conn_lang_cv;
				$data['qualite_cv']=$employeur[0]->qualite_cv;
				$data['intituleemploiCandidat']=$employeur[0]->intituleemploiCandidat;
				$data['antenne_id']=$employeur[0]->antenne_id;
				$data['ideedeprojetCandidat']=$employeur[0]->ideedeprojetCandidat;
				$data['typeemploirecherche']=$employeur[0]->typeemploiCandidat;
				 
			/*}*/
			
		}
		
		/* var_dump($employeur[0]);
		 exit();*/
		 
		$data['DomaineEmploi_idDomaineEmploi']=$this->mdoffre->get_dom_emp_for_select();
		$data['idPaysTravail']=$this->mdoffre->get_pays_for_select();
		
		$this->load->model('Model_candidat','mdcandidat');
		$data['competence']=$this->mdcandidat->competence();
		$data['DomaineDEtude']=$this->mdcandidat->DomaineDEtude();
		$data['competence_liste']=$this->mdcandidat->competence_liste($id);
		$data['diplome_liste']=$this->mdcandidat->diplome_liste($id);
		$data['autre_diplome_liste']=$this->mdcandidat->autre_diplome_liste($id);
		$data['experience_liste']=$this->mdcandidat->experience_liste($id);
		$data['certificat_liste']=$this->mdcandidat->certificat_liste($id);
		$data['langue']=$this->mdcandidat->langue($id);
		$data['langue_liste']=$this->mdcandidat->langue_liste($id);
		$data['logiciel']=$this->mdcandidat->logiciel($id);
		$data['logiciel_liste']=$this->mdcandidat->logiciel_liste($id);
		$data['departementResidenceCandidat']=$this->mdcandidat->departement();
		$data['NiveauDEtude']=$this->mdcandidat->NiveauDEtude();
		 $this->load->model('admin/Model_agence','mdagence');
        $data['liste_antennes']=$this->mdagence->get_all_for_select();
		
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/mon_cv',$data);
		$this->load->view('admin/footer',$data);
		
		
		
	}
	
		
	 public function statistique()
    {
        
		$this->CheckUser();
        $this->CheckDroit('uc_conseiller_08');
        
        $data=array();

        
        $this->load->view('admin/header',$data);
        $this->load->view('admin/menu',$data);
        $this->load->view('admin/statistique',$data);
        $this->load->view('admin/footer',$data);

    }
	
	
	 public function utilisateur($id="")
    {
        
		//$this->CheckUser();
        //$this->CheckDroit('view_user');
        
        
		 
		
        $data=array();
        $data['id']='';
        $data['nom']='';
        $data['prenom']='';
        $data['login']='';
        $data['titre']='';
        $data['profil_id']='';
        $data['passeword']='';
        $data['date_entre']='';
        $data['date_sortie']='';
        $data['email']='';
        $data['actif']='';/**/
        $data['adresse']='';
		$data['telephone']='';
        
        $data['notification']='';
        
        $data['key']='';
        
        $this->load->model('Model_utilisateur','mdutilisateur');
		
		
		//$this->load->model('admin/Model_groupe_agence','mdgroupeagence');
		
        if($this->input->post('btnSave'))
        {
             
            $this->mdutilisateur->nomUsers=$this->input->post('nom');
            $this->mdutilisateur->prenomUsers=$this->input->post('prenom');
            $this->mdutilisateur->adresseUsers=$this->input->post('adresse');
            $this->mdutilisateur->telUsers=$this->input->post('telephone');
			$this->mdutilisateur->emailUsers=$this->input->post('email');
			$this->mdutilisateur->Profil=$this->input->post('Profil');
			
			//$idAgence = (int) $this->input->post('antenne_id');
            
            if ($this->input->post('check_pwd')=='on')
                $this->mdutilisateur->passwordUsers=MD5($this->input->post('passeword'));    
            
        
                 
           $this->mdutilisateur->emailUsers=$this->input->post('email');
            
            if ($this->input->post('actif')=='on')
                $this->mdutilisateur->actif="1";
            else
                $this->mdutilisateur->actif="0";
                
            $data_session=$this->session->userdata('anpeuser');     
           // $this->mdutilisateur->qui=$data_session['login'];
            
           /// $this->mdutilisateur->quand=date("Y-m-d H:i");
             
            if ($this->input->post('passeword')==$this->input->post('confirmPassword'))
            {
            if($this->input->post('key')=="")
            {
                $res=$this->mdutilisateur->insert();
				
				
				/* if($this->input->post('profil_id')==2)
					{
							$this->mdgroupeagence->Agence_idAgence=$this->input->post('antenne_id');
							$resu=$this->mdgroupeagence->insert();		 
					} */
				
				/*
				if($res != -1)   // succes je mets a jour l antenne
				{
					
					$varData = array(
						"sys_utilisateur_id"=>$res,
						"agence_id"=>$idAgence,
						"actif"=>1
					
					);
					
					//$this->mdutilisateur->update_utilisateur_agence($varData);
				}*/
                // Ici je recupere l utilisateur pour l inserer dans une antenne
				// TO DO prevoir une interface pour l affectation des conseillers dans les antennes
				if ($res == -1)
                    $this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
            }
            else 
            {
                $this->mdutilisateur->update($this->input->post('key'));
                $id="";
            }
            }
            else
                $data['notification']='bootbox.dialog({
                      title: "Préfinancement",
                     message: "<div style=\'color:red\'>le mot de passe confirmé ne correspond pas au mot de passe entré.<div>"
                    });';
             
        }
     
        if($id!="")
        {
            $resp=$this->mdutilisateur->LoadId($id);
            if($resp->num_rows()==1)
            {
                $row=$resp->row();
                 /*var_dump($row);
				 exit();*/
                $data['nom']=$row->nomUsers;
                $data['prenom']=$row->prenomUsers;
                $data['adresse']=$row->adresseUsers;
                $data['telephone']=$row->telUsers;
                $data['Profil']=$row->Profil;
                $data['email']=$row->emailUsers;
                $data['actif']=$row->actif; 
          
                $data['key']=$row->idUsers;
            }
            
        }
        
		// Charger la liste des profils
        //$this->load->model('Model_profil','mdprofil');
        //$data['profil']=$this->mdprofil->get_all_for_select();
		
		// Charger la liste des antennes
       // $this->load->model('admin/Model_agence','mdagence');
       // $data['liste_antennes']=$this->mdagence->get_all_for_select();
    
        $data['utilisateur']=$this->mdutilisateur->get_all();
        
      //  $this->load->view('admin/header',$data);
        $this->load->view('menu',$data);
        $this->load->view('admin/utilisateur',$data);
        $this->load->view('footer',$data);

    }
	
	/*
	* Methode utilisee pour tester la fonction 
	*
	public function update_utilisateur_agence()
	{
		 $this->load->model('admin/Model_utilisateur','mdutilisateur');
		$varData = array(
						"sys_utilisateur_id"=>5,
						"agence_id"=>11,
						"actif"=>1
					
					);
		$this->mdutilisateur->update_utilisateur_agence($varData);
	}
	 */
	 public function bureau_dune_agence($agence)
	 {
	 	$this->load->model('Model_bureau','mdbureau');
		$query=$this->mdbureau->bureau_dune_agence($agence);
		$option="<option value='-1'>Selectionner...</option>";
		foreach($query->result() as $row)
		{
			$option.="<option value='".$row->code."'>".$row->nom."</option>";
		}
		echo $option;
	 }
	 
	 
	
	public function user_activer($id,$activer)
	{
		$this->CheckUser();
		
		$this->load->model('Model_utilisateur','mdutilisateur');
		$res=$this->mdutilisateur->user_activer($id,$activer);
		//if ($res==1)
		
		
		
		$this->session->set_flashdata('reposne_querry', 'opération effetuée avec succes.');
		redirect('admin/utilisateur');
	}
	
	
	public function changer_password()
	{
		$this->CheckUser();
		$data=array();
		$data_session=$this->session->userdata('vitaluser'); 			 
		 
		$data['login']=$data_session['login'];
		
		$this->load->model('Model_utilisateur','mdutilisateur');
		
		if($this->input->post('btnSave'))
		{
			
			if ($this->input->post('passeword')==$this->input->post('confirmPassword'))
			{
				 
				 	$this->mdutilisateur->login=$data['login'];
					$this->mdutilisateur->Hash=$this->input->post('passeword');
					$this->mdutilisateur->passeword_old=$this->input->post('passeword_old');
					
					$res=$this->mdutilisateur->changer_password($this->mdutilisateur->login,$this->mdutilisateur->Hash,$this->mdutilisateur->passeword_old);
					
					
					
					if ($res==1)
						$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>le mot de passe changé avec succès.<div>"
					});';
					else 
						$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:red\'>l\'encien mot de passe est incorrecte.<div>"
					});';
			}
			else
				$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:red\'>le mot de passe confirmé ne correspond pas au mot de passe entré.<div>"
					});';
			
			
			
		}
		
	
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('changer_password',$data);
		$this->load->view('footer',$data);

	}
	
	
	
	
	public function region($id="")
	{
		$this->CheckUser();
		$data=array();
		$data['code']='';
		$data['nom']='';
		
		//$data['key']='';
		
		$this->load->model('Model_region','mdregion');
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdregion->nom=$this->input->post('nom');
			
			$this->mdregion->code=$this->input->post('code');
			
			$data_session=$this->session->userdata('vitaluser'); 	
			$this->mdregion->qui=$data_session['login'];
			$this->mdregion->quand=date("Y-m-d H:i");
			 
			if($this->input->post('key')=="")
			{
				
				$res=$this->mdregion->insert();
				
				if ($res==1)
				$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdregion->update($this->input->post('key'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdregion->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['nom']=$row->nom;
				$data['code']=$row->code;
			}
			
		}
		
	
		$data['region']=$this->mdregion->get_all();
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('region',$data);
		$this->load->view('footer',$data);

	}
	
	public function region_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_region','mdregion');
		$res=$this->mdregion->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('welcome/region');
	}
	
	
	
	
	public function produit($id="")
	{
		$this->CheckUser();
		$data=array();
		$data['code']='';
		$data['nom']='';
		
		//$data['key']='';
		
		$this->load->model('Model_produit','mdproduit');
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdproduit->nom=$this->input->post('nom');
			
			$this->mdproduit->code=$this->input->post('code');
			
			$data_session=$this->session->userdata('vitaluser'); 	
			$this->mdproduit->qui=$data_session['login'];
			$this->mdproduit->quand=date("Y-m-d H:i");
			 
			if($this->input->post('key')=="")
			{
				
				$res=$this->mdproduit->insert();
				
				if ($res==1)
				$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdproduit->update($this->input->post('key'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdproduit->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['nom']=$row->nom;
				$data['code']=$row->code;
			}
			
		}
		
	
		$data['produit']=$this->mdproduit->get_all();
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('produit',$data);
		$this->load->view('footer',$data);

	}
	
	public function produit_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_produit','mdproduit');
		$res=$this->mdproduit->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('welcome/produit');
	}
	
	public function allegement($id="")
	{
		$this->CheckUser();
		
		$caisse=$this->pas_de_caisse();
		
		
		$data=array();
		
		$data['dates']=date('d-m-Y',strtotime($caisse[0]->dates));
		$data['id_caisse_ouv']=$caisse[0]->id;
		
		$data['montant']="";
		$data['nom']="";
		$data['note_reference']="";

		$data['key']="";
		
		$data['notification']='';
		
		$this->load->model('Model_operation','mdoperation');
		if($this->input->post('btnSave'))
		{
			
			
		
		
			$this->mdoperation->date_operation=date('Y-m-d',strtotime($this->input->post('dates')));
			$this->mdoperation->id_caisse_ouv=$caisse[0]->id;
			$this->mdoperation->montant_allegement=$this->input->post('montant');
			$data_session=$this->session->userdata('vitaluser'); 
			$this->mdoperation->bureau_id=$data_session['Bureau_ID'];	
			$this->mdoperation->qui=$data_session['login'];
			$this->mdoperation->quand=date("Y-m-d H:i");
			$this->mdoperation->status=1;
			$this->mdoperation->nom=$this->input->post('nom');
			$this->mdoperation->note_reference=$this->input->post('note_reference');
			$this->mdoperation->type_operation="allegement";
			$this->mdoperation->type_operation="allegement";
			 
			
			if ($this->input->post('key')=="")
				$res=$this->mdoperation->insert();
			else 
				$res=$this->mdoperation->update($this->input->post('key'));
			
			if ($res==0)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>Opération effectué avec succès.<div>"
					});';
				 
			 
		}
		
		if($id!="")
		{
			$resp=$this->mdoperation->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				 
				$data['dates']=$row->date_operation;
				$data['montant']=$row->montant_allegement;
				$data['nom']=$row->nom;
				$data['note_reference']=$row->note_reference;

		        $data['key']=$row->id;
			}
			
		}
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('allegement',$data);
		$this->load->view('footer',$data);

	}
	
	
	
	
	public function alimentation($id="")
	{
		$this->CheckUser();
		
		$caisse=$this->pas_de_caisse();
		
		
		$data=array();
		
		$data['dates']=date('d-m-Y',strtotime($caisse[0]->dates));
		$data['id_caisse_ouv']=$caisse[0]->id;
		$data['montant']="";
		$data['nom']="";
		$data['note_reference']="";

		$data['key']="";
		
		$data['notification']='';
		
		$this->load->model('Model_operation','mdoperation');
		if($this->input->post('btnSave'))
		{
			
			
			
			$this->mdoperation->date_operation=date('Y-m-d',strtotime($this->input->post('dates')));
			$this->mdoperation->id_caisse_ouv=$caisse[0]->id;
			$this->mdoperation->montant_alimentation=$this->input->post('montant');
			$data_session=$this->session->userdata('vitaluser'); 
			$this->mdoperation->bureau_id=$data_session['Bureau_ID'];	
			$this->mdoperation->qui=$data_session['login'];
			$this->mdoperation->quand=date("Y-m-d H:i");
			$this->mdoperation->status=1;
			$this->mdoperation->nom=$this->input->post('nom');
			$this->mdoperation->note_reference=$this->input->post('note_reference');
			$this->mdoperation->type_operation="alimentation";
			
			if ($this->input->post('key')=="")
				$res=$this->mdoperation->insert();
			else 
				$res=$this->mdoperation->update($this->input->post('key'));
			
			if ($res==0)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>Opération effectué avec succès.<div>"
					});';
				 
			 
		}
		
		
		if($id!="")
		{
			$resp=$this->mdoperation->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				 
				$data['dates']=$row->date_operation;
				$data['montant']=$row->montant_alimentation;
				$data['nom']=$row->nom;
				$data['note_reference']=$row->note_reference;

		        $data['key']=$row->id;
			}
			
		}
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('alimentation',$data);
		$this->load->view('footer',$data);

	}
	
	
	
	public function historique($id="")
	{
		$this->CheckUser();
		//$this->CheckDroit('view_user');
		
		
		$data=array();
		$data['date_debut']=date('d-m-Y');
		$data['date_fin']=date('d-m-Y');
		$data['envoi']="";
		$data['paiement']="";
		$data['allegement']="";
		$data['alimentation']="";
		$data['region_id']="-1";
		$data['produit_id']="-1";
		$data_session=$this->session->userdata('vitaluser'); 
		$data['bureau_id']=$data_session['Bureau_ID'];	
		
		$data['notification']='';
		
		$data['key']='';
		
		
		
		$this->load->model('Model_operation','mdoperation');
		
		$this->mdoperation->date_debut=date('Y-m-d');
		$this->mdoperation->date_fin=date('Y-m-d');
		
		$this->mdoperation->envoi="";
		$this->mdoperation->paiement="";
		$this->mdoperation->allegement="";
		$this->mdoperation->alimentation="";
		$this->mdoperation->region_id="";
		$this->mdoperation->produit_id="";
		$this->mdoperation->bureau_id="";
			
		$data['date_debut']=date('d-m-Y');
		$data['date_fin']=date('d-m-Y');
		if($this->input->post('btnSave'))
		{
			 
			$data['date_debut']=$this->input->post('date_debut');
			$data['date_fin']=$this->input->post('date_fin');
			$data['envoi']=$this->input->post('envoi');
			$data['paiement']=$this->input->post('paiement');
			$data['allegement']=$this->input->post('allegement');
			$data['alimentation']=$this->input->post('alimentation');
			$data['region_id']=$this->input->post('region_id');
			$data['produit_id']=$this->input->post('produit_id');
			$data['bureau_id']=$this->input->post('bureau_id');
			
			$this->mdoperation->date_debut=date('Y-m-d',strtotime($this->input->post('date_debut')));
			$this->mdoperation->date_fin=date('Y-m-d',strtotime($this->input->post('date_fin')));
			$this->mdoperation->envoi=$this->input->post('envoi');
			$this->mdoperation->paiement=$this->input->post('paiement');
			$this->mdoperation->allegement=$this->input->post('allegement');
			$this->mdoperation->alimentation=$this->input->post('alimentation');
			$this->mdoperation->region_id=$this->input->post('region_id');
			$this->mdoperation->produit_id=$this->input->post('produit_id');
			$this->mdoperation->bureau_id=$this->input->post('bureau_id');
			
			 
		}

		$data['operation']=$this->mdoperation->historique();
		
		$this->load->model('Model_region','mdregion');
		$data['region']=$this->mdregion->get_all_for_select();
			
		$this->load->model('Model_produit','mdproduit');
		$data['produit']=$this->mdproduit->get_all_for_select();
		
		$this->load->model('Model_bureau','mdbureau');
		$data['bureau']=$this->mdbureau->get_bureau_agence2();
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('historique',$data);
		$this->load->view('footer',$data);

	}
	
	
	
	public function fermeture_detail($id="")
	{
		$this->CheckUser();
		//$this->CheckDroit('view_user');
		
		
		$data=array();
		
		
		$data['notification']='';
		
		$this->load->model('Model_operation','mdoperation');
		$data['recapitulatif']=$this->mdoperation->fermeture_detail($id);
	
		//$data['operation']=$this->mdoperation->fermeture_detail_liste($id);
		
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('fermeture_detail',$data);
		$this->load->view('footer',$data);

	}
	
	
	public function fermeture_caisse($id="")
	{
		$this->CheckUser();
		//$this->CheckDroit('view_user');
		
		
		$caisse=$this->pas_de_caisse();
		
		
		$data=array();
		
		//$data['dates']=date('d-m-Y',strtotime($caisse[0]->dates));
		$data['id_caisse_ouv']=$caisse[0]->id;
		
		
		
		$data['notification']='';
		
		$data['key']='';
		
		$this->load->model('Model_operation','mdoperation');
		/*$this->mdoperation->date_debut=date('Y-m-d');
		$this->mdoperation->date_fin=date('Y-m-d');*/
		$this->mdoperation->id_caisse_ouv=$caisse[0]->id;
		$data['date_debut']=date('d-m-Y',strtotime($caisse[0]->dates));
		$data['solde_overture']=$caisse[0]->solde_ouverture;
		//$data['date_fin']=date('d-m-Y');
		
		
		
		if($this->input->post('btnSave'))
		{
			 
			  
			  
			$data['date_debut']=$this->input->post('date_debut');
			//$data['date_fin']=$this->input->post('date_fin');
			$this->mdoperation->dates=date('Y-m-d',strtotime($this->input->post('date_debut')));
			//$this->mdoperation->date_fin=date('Y-m-d',strtotime($this->input->post('date_debut')));
			
			
			$this->mdoperation->date_f_reel=date('Y-m-d');
			
			$data_session=$this->session->userdata('vitaluser'); 
			$this->mdoperation->bureau_id=$data_session['Bureau_ID'];	
			$this->mdoperation->qui=$data_session['login'];
			$this->mdoperation->quand=date("Y-m-d H:i");
			$this->mdoperation->status=2;
			$this->mdoperation->solde=$this->input->post('solde');
			$this->mdoperation->solde_physique=$this->input->post('solde_physique');
			$this->mdoperation->motif=$this->input->post('motif');
			$this->mdoperation->login_sup=$this->input->post('login_sup');
			$this->mdoperation->pwd=$this->input->post('pwd');
			
			$res=$this->mdoperation->fermeture();
				
		
			
			
			if ($res==0)
			{
				$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>Opération effectué avec succès.<div>"
					});';
				
				redirect('welcome/page_pas_de_caisse');
			}
			
			else if($res==1)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:red\'>Le login et le mot de passe du chef de bureau sont erronés<div>"
					});';
			else if($res==2)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:red\'>la date de debut de fermeture coïncide avec la date de fermeture d\'une caisse precedente.<div>"
					});';
				 
			
			 
		}
	 
		/*if($id!="")
		{
			$resp=$this->mdutilisateur->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				 
				$data['nom']=$row->Nom_Utilisateur;
				$data['prenom']=$row->Prenom_Utilisateur;
				$data['login']=$row->Login;
				$data['titre']=$row->Titre;
				$data['profil_id']=$row->Profil_ID;
				$data['email']=$row->Email;
				$data['agence_id']=$row->Agence_ID;
				$data['bureau_id']=$row->Bureau_ID;
				$data['date_entre']=date('d-m-Y',strtotime($row->Date_Entree));
				$data['date_sortie']=date('d-m-Y',strtotime($row->Date_Sortie));
				$data['actif']=$row->Actif;
			 
				
				 
		
		        $data['key']=$row->Id;
			}
			
		}*/
		
		
		
		
		$data['recapitulatif']=$this->mdoperation->recapitulatif();
	
		$data['operation']=$this->mdoperation->liste_opera_jrne2();
		//$data['operation']=array();
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('fermeture_caisse',$data);
		$this->load->view('footer',$data);

	}
	
	
	
	public function rapport_ferm_caisse($id="")
	{
		$this->CheckUser();
		//$this->CheckDroit('view_user');
		
		
		
		$data=array();
		
		$data_session=$this->session->userdata('vitaluser'); 
		$data['bureau_id']=$data_session['Bureau_ID'];
			
		
		$data['notification']='';
		
		$data['key']='';
		
		$this->load->model('Model_caisse','mdferm_caisse');
		$date=date_create(date('Y-m-d'));
		date_add($date,date_interval_create_from_date_string("-7 days"));
		//echo date_format($date,"Y-m-d");

		$this->mdferm_caisse->date_debut=date_format($date,"Y-m-d");
		$this->mdferm_caisse->date_fin=date('Y-m-d');
		$this->mdferm_caisse->bureau_id=$data_session['Bureau_ID'];
		$data['date_debut']=date_format($date,"d-m-Y");
		$data['date_fin']=date('d-m-Y');
		if($this->input->post('btnSave'))
		{
			 
			$data['date_debut']=$this->input->post('date_debut');
			$data['date_fin']=$this->input->post('date_fin');
			$data['bureau_id']=$this->input->post('bureau_id');
			
			$this->mdferm_caisse->date_debut=date('Y-m-d',strtotime($this->input->post('date_debut')));
			$this->mdferm_caisse->date_fin=date('Y-m-d',strtotime($this->input->post('date_fin')));
			
			$this->mdferm_caisse->bureau_id=$this->input->post('bureau_id');
			
			 
		}
	 
		/*if($id!="")
		{
			$resp=$this->mdutilisateur->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				 
				$data['nom']=$row->Nom_Utilisateur;
				$data['prenom']=$row->Prenom_Utilisateur;
				$data['login']=$row->Login;
				$data['titre']=$row->Titre;
				$data['profil_id']=$row->Profil_ID;
				$data['email']=$row->Email;
				$data['agence_id']=$row->Agence_ID;
				$data['bureau_id']=$row->Bureau_ID;
				$data['date_entre']=date('d-m-Y',strtotime($row->Date_Entree));
				$data['date_sortie']=date('d-m-Y',strtotime($row->Date_Sortie));
				$data['actif']=$row->Actif;
			 
				
				 
		
		        $data['key']=$row->Id;
			}
			
		}*/
		
		
		
		
		$this->load->model('Model_bureau','mdbureau');
		$data['bureau']=$this->mdbureau->get_bureau_agence2();
	
		$data['ferm_caisse']=$this->mdferm_caisse->liste_caisse_fer();
		
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('rapport_ferm_caisse',$data);
		$this->load->view('footer',$data);

	}
	
		public function liste_opera_jrne($id="")
	{
		$this->CheckUser();
		//$this->CheckDroit('view_user');
		
		
		$data=array();
		
		
		$data['notification']='';
		
		$data['key']='';
		
		$this->load->model('Model_operation','mdoperation');
		$this->mdoperation->date_debut=date('Y-m-d');
		$this->mdoperation->date_fin=date('Y-m-d');
		$data['date_debut']=date('d-m-Y');
		$data['date_fin']=date('d-m-Y');
		if($this->input->post('btnSave'))
		{
			 
			$data['date_debut']=$this->input->post('date_debut');
			$data['date_fin']=$this->input->post('date_fin');
			$this->mdoperation->date_debut=date('Y-m-d',strtotime($this->input->post('date_debut')));
			$this->mdoperation->date_fin=date('Y-m-d',strtotime($this->input->post('date_fin')));
			
			 
		}
	 
		/*if($id!="")
		{
			$resp=$this->mdutilisateur->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				 
				$data['nom']=$row->Nom_Utilisateur;
				$data['prenom']=$row->Prenom_Utilisateur;
				$data['login']=$row->Login;
				$data['titre']=$row->Titre;
				$data['profil_id']=$row->Profil_ID;
				$data['email']=$row->Email;
				$data['agence_id']=$row->Agence_ID;
				$data['bureau_id']=$row->Bureau_ID;
				$data['date_entre']=date('d-m-Y',strtotime($row->Date_Entree));
				$data['date_sortie']=date('d-m-Y',strtotime($row->Date_Sortie));
				$data['actif']=$row->Actif;
			 
				
				 
		
		        $data['key']=$row->Id;
			}
			
		}*/
		
		
		
		
		
	
		$data['operation']=$this->mdoperation->liste_opera_jrne();
		
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('liste_opera_jrne',$data);
		$this->load->view('footer',$data);

	}
	
	
	public function ouverture_caisse()
	{
		$this->CheckUser();
		//$this->CheckDroit('view_user');
		
		
		$data=array();
		
		
		$data['notification']='';
		
		//$data['key']='';
		
		$this->load->model('Model_caisse','mdcaisse');
		/*$this->mdoperation->date_debut=date('Y-m-d');
		$this->mdoperation->date_fin=date('Y-m-d');
		
		$data['date_fin']=date('d-m-Y');*/
		$data['dates']=date('d-m-Y');
		if($this->input->post('btnSave'))
		{
			$data_session=$this->session->userdata('vitaluser'); 
			
			
			$this->mdcaisse->dates=date('Y-m-d',strtotime($this->input->post('dates')));
			$this->mdcaisse->date_o_reel=date('Y-m-d');
			$this->mdcaisse->bureau_id=$data_session['Bureau_ID'];
			$this->mdcaisse->solde_ouverture=$this->input->post('montant');
			$this->mdcaisse->qui=$data_session['login'];
			$this->mdcaisse->status="1";
			$this->mdcaisse->quand=date('Y-m-d');
			
			$res=$this->mdcaisse->ouvrir_caisse();
			
			if ($res==0)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>Opération effectué avec succès.<div>"
					});';
			else if($res==1)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:red\'>Une caisse est ouverte actuellement,veuillez fermer la caisse<div>"
					});';
			else if($res==2)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:red\'>la date d\'ouverte d\'une caisse ne doit pas être antécédente à la date d\'ouverture d\'une caisse precedante.<div>"
					});';
			 
		}
	 
		
	
		$data['caisse']=$this->mdcaisse->derniere_caisse_ferme();
		
		
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('ouverture_caisse',$data);
		$this->load->view('footer',$data);

	}
	
	
	public function oper_jrne_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_operation','mdoperation');
		$res=$this->mdoperation->oper_jrne_del($id);
		//if ($res==1)
		//$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('welcome/liste_opera_jrne');
	}
	
	
	public function operation($id="")
	{
		$this->CheckUser();
		
		$caisse=$this->pas_de_caisse();
		
		
		$data=array();
		
		$data['dates']=date('d-m-Y',strtotime($caisse[0]->dates));
		$data['type_operation']="";
		$data['produit_id']="";
		$data['montant']="";
		$data['region_id']="";
		$data['pays']="";
		$data['nom']="";
		$data['note_reference']="";
		
		$data['id_caisse_ouv']=$caisse[0]->id;
		$data['key']="";
		
		$data['notification']='';
		
		$this->load->model('Model_operation','mdoperation');
		if($this->input->post('btnSave'))
		{
			
			
			
			$this->mdoperation->date_operation=date('Y-m-d',strtotime($this->input->post('dates')));
			$this->mdoperation->id_caisse_ouv=$caisse[0]->id;
			
			if ($this->input->post('type_operation')=="envoi")
				$this->mdoperation->montant_envois=$this->input->post('montant');
			else
				$this->mdoperation->montant_paiement=$this->input->post('montant');
			$data_session=$this->session->userdata('vitaluser'); 
			$this->mdoperation->bureau_id=$data_session['Bureau_ID'];	
			$this->mdoperation->qui=$data_session['login'];
			$this->mdoperation->quand=date("Y-m-d H:i");
			$this->mdoperation->status=1;
			$this->mdoperation->nom=$this->input->post('nom');
			$this->mdoperation->pays=$this->input->post('pays');
			$this->mdoperation->note_reference=$this->input->post('note_reference');
			$this->mdoperation->type_operation=$this->input->post('type_operation');
			$this->mdoperation->region_id=$this->input->post('region_id');
			$this->mdoperation->produit_id=$this->input->post('produit_id');
				//var_dump($this->input->post('montant'));
				
		
			if ($this->input->post('key')=="")
				$res=$this->mdoperation->insert();
			else 
				$res=$this->mdoperation->update($this->input->post('key'));
			
			if ($res==0)
			$data['notification']='bootbox.dialog({
  					title: "Réponse",
 					message: "<div style=\'color:#008D4C\'>Opération effectué avec succès.<div>"
					});';
				 
			 
		}
		
		
		if($id!="")
		{
			$resp=$this->mdoperation->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				 
				$data['dates']=$row->date_operation;
				$data['montant']=$row->montant_alimentation;
				$data['nom']=$row->nom;
				$data['note_reference']=$row->note_reference;
				 
			
				$data['dates']=date('d-m-Y',strtotime($row->date_operation));
				$data['type_operation']=$row->type_operation;
				$data['produit_id']=$row->produit_id;
				if ($row->type_operation=='envoi')
					$data['montant']=$row->montant_envois;
				else
					$data['montant']=$row->montant_paiement;
				$data['region_id']=$row->region_id;
				$data['pays']=$row->pays;
				$data['nom']=$row->nom;
				$data['note_reference']=$row->note_reference;

		        $data['key']=$row->id;
			}
			
		}
		
		
		$this->load->model('Model_region','mdregion');
		$data['region']=$this->mdregion->get_all_for_select();
			
		$this->load->model('Model_produit','mdproduit');
		$data['produit']=$this->mdproduit->get_all_for_select();
				
		
		$this->load->view('header',$data);
		$this->load->view('menu',$data);
		$this->load->view('operation',$data);
		$this->load->view('footer',$data);

	}
	
	
public function fermeture_excel($id="")
	{
//load PHPExcel library
$this->load->library('Excel');

$alphabe=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
 
// Set document properties
$objPHPExcel->getProperties()->setCreator("mohamadikhwan.com")
							 ->setLastModifiedBy("mohamadikhwan.com")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated by PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
 
 
// Add some data

$this->load->model('Model_produit','mdproduit');
$produit=$this->mdproduit->get_all();
$nbr_produit=count($produit);

$this->load->model('Model_region','mdregion');
$region=$this->mdregion->get_all();
$nbr_region=count($region);


$this->load->model('Model_caisse','mdcaisse');
$caisse=$this->mdcaisse->load_caisse_ferme($id);


$this->load->model('Model_operation','mdoperation');
//$operation=$this->mdoperation->LoadByCaisse($id);

//$nbr_region=count($region);
/*for ($i = 1; $i <= $nbr_produit; $i++) 
{
    echo $alphabe[$i-1]."1";
}

var_dump($operation);
exit();
*/

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A3", "VITAL FINANCE");
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A4", "Agence :");
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A5", "Bureau:");

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("B4", $caisse[0]->agence);
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("B5", $caisse[0]->bureau );

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("H6", "DATE DU JOUR:");
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("I6", date('d-m-Y',strtotime( $caisse[0]->dates)));
$objPHPExcel->setActiveSheetIndex(0) 
->mergeCells('C8:I8');
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("C8", "Points dispatchés des opérations de transferts d'argent par zone économique");

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A10", "REGIONS");

$objPHPExcel->setActiveSheetIndex(0) 
->mergeCells($alphabe[1].'10:'.$alphabe[$nbr_produit+1].'10');
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[1].'10', "TRANSFERTS RECUS");

$objPHPExcel->setActiveSheetIndex(0) 
->mergeCells($alphabe[$nbr_produit+2].'10:'.$alphabe[$nbr_produit+2+$nbr_produit].'10');
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[$nbr_produit+2].'10', "TRANSFERTS EMIS");

//liste Produit envoi Horizontal
for ($i = 1; $i <= $nbr_produit+1; $i++) 
{
	$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[$i]."11", $produit[$i-1]->nom);

}
//Total [1]
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[$nbr_produit+1]."11", "Total [1]");

//liste Produit paiement Horizontal
for ($i = $nbr_produit+1; $i <= (2*$nbr_produit+2)+1; $i++) 
{
	 
	$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[$i+1]."11", $produit[$i-$nbr_produit-1]->nom);
    
}

//Total [2]
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[(2*$nbr_produit+2)]."11", "Total [2]");


//liste region  Vertical
for ($i = 13; $i < $nbr_region+13; $i++) 
{
	$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A".$i, $region[$i-13]->nom);

}

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("A".($nbr_region+13), "Total");

/*$PHPExcel->setActiveSheetIndex(0)
        ->getStyle('A1')
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('FF0000');*/

//liste count envoi Horizontal
for ($j = 0; $j < $nbr_region; $j++) 
{
	$ligne_region=$this->mdoperation->LoadByExcel($id,$region[$j]->code,"envoi");
    $t=$j+13;
	$total_ligne=0;
	for ($i = 1; $i <= $nbr_produit+1; $i++) 
	{
		$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($alphabe[$i]."".$t, $ligne_region[$i-1]->montant);
	$total_ligne=$total_ligne+$ligne_region[$i-1]->montant;
	}
	
	
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($alphabe[$nbr_produit+1]."".$t,"=SUM(".$alphabe[1]."".$t.":".$alphabe[$nbr_region-1]."".$t.")");
	
}



for ($i = 1; $i <= $nbr_produit+1; $i++) 
{
	$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[$i]."".(13+$nbr_region), "=SUM(".$alphabe[$i]."13:".$alphabe[$i]."".(13+$nbr_region-1).")");

}




//liste count envoi Horizontal
for ($j = 0; $j < $nbr_region; $j++) 
{
	$ligne_region=$this->mdoperation->LoadByExcel($id,$region[$j]->code,"paiement");
    $t=$j+13;
	$total_ligne=0;
	for ($i = $nbr_produit+2; $i <= (2*$nbr_produit)+1; $i++) 
	{
		$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($alphabe[$i]."".$t, $ligne_region[$i-$nbr_produit-2]->montant);
	$total_ligne=$total_ligne+$ligne_region[$i-$nbr_produit-2]->montant;
	
	}
	
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($alphabe[(2*$nbr_produit)+2]."".$t,"=SUM(".$alphabe[$nbr_produit+2]."".$t.":".$alphabe[(2*$nbr_produit)+1]."".$t.")");
}

for ($i = $nbr_produit+1; $i <= (2*$nbr_produit+2); $i++) 
{
	$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($alphabe[$i]."".(13+$nbr_region), "=SUM(".$alphabe[$i]."13:".$alphabe[$i]."".(13+$nbr_region-1).")");

}



           /* ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'bonjour')
            ->mergeCells('C2:D3')
			 ->setCellValue('C2', 'monde')
            ->setCellValue('A4', 'tutorial from: mohamadikhwan.com');*/
			
			
			
			 
 
// Rename worksheet (worksheet, not filename)
$objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y',strtotime( $caisse[0]->dates)));
 
 
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
//clean the output buffer
ob_end_clean();
 
//this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//so, we use this header instead.
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Rapport_de_fermeture_'.date('d-m-Y',strtotime( $caisse[0]->dates)).'_cocotomey.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
		
		
 
	}
	
	
	public function excel()
	{
//load PHPExcel library
$this->load->library('Excel');
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
 
// Set document properties
$objPHPExcel->getProperties()->setCreator("mohamadikhwan.com")
							 ->setLastModifiedBy("mohamadikhwan.com")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated by PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
 
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'bonjour')
            ->setCellValue('C2', 'monde')
            ->setCellValue('A4', 'tutorial from: mohamadikhwan.com');
			
			
			
			 
 
// Rename worksheet (worksheet, not filename)
$objPHPExcel->getActiveSheet()->setTitle('createdUsingPHPExcel');
 
 
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel2007)
//clean the output buffer
ob_end_clean();
 
//this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//so, we use this header instead.
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="mohamadikhwan_dot_com_phpexcel_tut.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
		
		
 
	}
	
	
	
	
	function excel_t($table_name)
    {
        $query = $this->db->get($table_name);
 
        if(!$query)
            return false;
 
        // Starting the PHPExcel library
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
 
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Products_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
    }
	
    
    
    public function commune($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['idCommune']='';
		$data['nomCommune']='';
		$data['departement_id']='';
		
		//$data['key']='';
		
		$this->load->model('Model_commune','mdcommune');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdcommune->nomCommune=$this->input->post('nomCommune');
			
			$this->mdcommune->idDepartement=$this->input->post('departement_id');
			/*$this->mdcompetences->qui="1";
			$this->mdcompetences->quand=date("Y-m-d H:i");*/
			
			
			 
			if($this->input->post('idCommune')=="")
			{
				
				$res=$this->mdcommune->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdcommune->update($this->input->post('idCommune'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdcommune->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idCommune']=$row->idCompetences;
				$data['nomCommune']=$row->departement_id;
				$data['idDepartement']=$row->idCompetences;
				$data['nomDepartement']=$row->departement_id;
			}
			
		}
	    $this->load->model('Model_departement','mddepartement');
		$data['departement']=$this->mddepartement->get_all_for_select();
		
	
		$data['commune']=$this->mdcommune->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/commune',$data);
		$this->load->view('admin/footer');
	}
	
	public function commune_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_competences','mdcompetences');
		$res=$this->mdcompetences->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/competences');
	}
	
	
	public function agence($id="")
	{
 
		//$this->CheckUser();
		$data=array();
		$data['idAgence']='';
		$data['nomAgence']='';
		$data['etatAgence']='';
		$data['adresseAgence']='';
		$data['telephoneAgence']='';
		$data['faxAgence']='';
		$data['emailAgence']='';
		$data['idDepartement']='';
		$data['boitepostalAgence']='';
		$data['departement_id']='';
		
		
		$this->load->model('Model_agence','mdagence');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			$this->mdagence->idAgence=$this->input->post('idAgence');
			$this->mdagence->nomAgence=$this->input->post('nomAgence');
			$this->mdagence->etatAgence=$this->input->post('etatAgence');
			$this->mdagence->adresseAgence=$this->input->post('adresseAgence');
			$this->mdagence->telephoneAgence=$this->input->post('telephoneAgence');
			$this->mdagence->faxAgence=$this->input->post('faxAgence');
			$this->mdagence->emailAgence=$this->input->post('emailAgence');
			$this->mdagence->idDepartement=$this->input->post('departement_id');
			$this->mdagence->boitepostalAgence=$this->input->post('boitepostalAgence');
			
			//var_dump($this->input->post('departement_id'));
			//exit();
			/*$this->mdcompetences->qui="1";
			$this->mdcompetences->quand=date("Y-m-d H:i");*/
			
			//var_dump($this->input->post('idAgence'));
			//exit();
			 
			if($this->input->post('idAgence')=="")
			{
				
				$res=$this->mdagence->insert();
				
				if ($res==1)
				$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				
				
				$this->mdagence->update($this->input->post('idAgence'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdagence->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idAgence']=$row->idAgence;
				$data['nomAgence']=$row->nomAgence;
				$data['etatAgence']=$row->etatAgence;
				$data['adresseAgence']=$row->adresseAgence;
				
				$data['telephoneAgence']=$row->telephoneAgence;
				$data['faxAgence']=$row->faxAgence;
				$data['emailAgence']=$row->emailAgence;
				//$data['idDepartement']=$row->departement_id;
				
				$data['boitepostalAgence']=$row->boitepostalAgence;
			}
			
		}
	    $this->load->model('Model_departement','mddepartement');
		$data['departement']=$this->mddepartement->get_all_for_select();
		
	
		$data['agence']=$this->mdagence->get_all();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/agence',$data);
		$this->load->view('admin/footer');
	}
	
	public function agence_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_agence','mdagence');
		$res=$this->mdagence->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/agence');
	}
	
	
	/**
         * get list of id and reference of all offres 
         * @param void
         * @return json of all 
         * 
         */
        public function offrereferencelist()
        {
            $this->load->model('Model_offre', 'mdoffre');
            $data = $this->mdoffre->getOffreReferenceList();
            $response = array();
            
            foreach($data as $row)
            {
                $response[] = array("id"=>$row['idOffre'], 'label'=>$row['numOffre']);
            }
            
            echo json_encode($response);
        }
        
        /**
         * get list of id and name of all employeurs
         * @param void
         * @return json list nom de tous les employeurs 
         * 
         */
        public function nomemployeurlist()
        {
            $query_str = $this->input->get('query'); 
           
            $this->load->model('Model_employeur', 'mdemployeur');
            $data = $this->mdemployeur->getNomEmployeurList($query_str);
			$response = array();
            
            foreach($data as $row)
            {
                $response[] = array("id"=>$row['idEmployeur'], 'label'=>$row['nomEmployeur']);
            }
			
            echo json_encode($response);
        }
		
		/**
		*   Methode d ajout d offre par le personnel ANPE
		*
		*/
		public function addEmployeur()
		{
			$this->load->model('Model_employeur', 'mdemployeur');
			$this->mdemployeur->nomEmployeur = $this->input->post('nomEmployeur');
			$this->mdemployeur->raisonSocialeEmployeur = $this->input->post('raison_sociale');
			$this->mdemployeur->telEmployeur = $this->input->post('tel');
			$this->mdemployeur->emailEmployeur = $this->input->post('email');
			$this->mdemployeur->adresseEmployeur = $this->input->post('adresse');
			$this->mdemployeur->pwdEmployeur = $this->input->post('email');  // A corriger pour integrer une logique de mot de passe par defaut
			$this->mdemployeur->etatEmployeur = 1;  
			$result = $this->mdemployeur->register_employeur();
			
			echo $result;
		}
		
		/**
		*   Methode d ajout d offre par le personnel ANPE
		*
		*/
		public function getSousDomaineEmploi()
		{
			$idDomaineEmploi = $this->input->post('domaine_id');
			$this->load->model('Model_offre', 'mdoffre');
			$result = $this->mdoffre->getSousDomaineEmploi($idDomaineEmploi);
			echo json_encode($result);
		}
		
		
		public function doConnect()
		{
			//$login = $this->input->post('login');
			$login = $this->input->post('Email');
			$pwd = $this->input->post('pwd');
			$bureauId = 0;
			$this->load->Model('Model_utilisateur', 'mdutilisateur');
			//$res = $this->mdutilisateur->Search($login,$pwd,$bureauId);
			$res = $this->mdutilisateur->Search($login,$pwd);
			$data['notification']='';
			
			
			
			if($res->num_rows()==1)
			{
				   
				   
					$result=$res->row(); 
					
					/*$droit=array();
					$this->load->model('Model_profil_droit','mdprofil_droit');
			        $liste_droit=$this->mdprofil_droit->Load_droit($result->Profil_ID);
					
					foreach ($liste_droit as $liste) 
					{
						array_push($droit, $liste->Code);
					} */
					
					
					/*var_dump($liste_droit);
					var_dump($droit);
					exit();*/
				
					
					$sessionarray=array("idUsers"=>$result->idUsers,
					"nomUsers"=>$result->nomUsers,
					"prenomUsers"=>$result->prenomUsers,
					"emailUsers"=>$result->emailUsers,
					"Profil"=>$result->Profil
					); 
					 
	         	$this->session->set_userdata(array("sysuser"=>$sessionarray));
				redirect('welcome/dashboard/'.$result->Id); 
				//redirect('admin/dashboard/'.$result->Id); menu
					
				}
				else
				{
					$data['notification']='0';
				$this->load->view('connexion_back',$data);
				}
		}
		
		
		public function logout()
		{
			$this->session->set_userdata(array('sysuser'=>null));
			redirect('welcome/admin');
		}
		
		
		public function statutemployeur($id="")
	{
	
	//$this->CheckUser();
		$data=array();
		$data['idStatutemployeur']='tptp';
		$data['libelleStatutemployeur']='';
		
	$this->load->model('Model_statutemployeur','mdstatutemployeur');
		
		if($this->input->post('btnSave'))
		{
			//$data['key']=$this->input->post('key');
			
			$this->mdstatutemployeur->idStatutemployeur=$this->input->post('idStatutemployeur');
			
			$this->mdstatutemployeur->libelleStatutemployeur=$this->input->post('libelleStatutemployeur');
			$this->mdstatutemployeur->qui="1";
			$this->mdstatutemployeur->quand=date("Y-m-d H:i");
			 
			if($this->input->post('idStatutemployeur')=="")
			{
				
				$res=$this->mdstatutemployeur->insert();
				
				if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement existe deja.');
			}
			else 
			{
				$this->mdstatutemployeur->update($this->input->post('idStatutemployeur'));
				$id="";
			}
			 
		}
	 
		if($id!="")
		{
			$resp=$this->mdstatutemployeur->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idStatutemployeur']=$row->idStatutemployeur;
				$data['libelleStatutemployeur']=$row->libelleStatutemployeur;
			}
			
		}
	 
		
	
		$data['statutemployeur']=$this->mdstatutemployeur->get_all();
		/*var_dump($data['secteuractivite']);
											exit();*/
		//$this->CheckUser();
		//$data=array();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/statutemployeur',$data);
		$this->load->view('admin/footer',$data);

	}
		public function statutemployeur_del($id)
	{
		// $this->CheckUser();
		
		$this->load->model('Model_statutemployeur','mdstatutemployeur');
		$res=$this->mdstatutemployeur->delete($id);
		if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');
		redirect('admin/statutemployeur');
	}
	
	
	public function affectation_programme($id="")
	{
		//$this->CheckUser();
		//$this->CheckDroit('view_droit');
		$data=array();
		$data['nom']='';
		$data['idProgramme']='';
		$data['idCandidat']='';
		
		$data['key']='';
		
		$this->load->model('admin/Model_affectation_programme','mdaffectation_programme');
		if($this->input->post('btnSave'))
		{
			
			$this->mdaffectation_programme->idProgramme=$this->input->post('idProgramme');
			$this->mdaffectation_programme->idCandidat=$this->input->post('idCandidat');
			$this->mdaffectation_programme->qui=1;
			$this->mdaffectation_programme->ou='vv'; 
			$this->mdaffectation_programme->quand=date("Y-m-d H:i"); 
			
			$res=$this->mdaffectation_programme->insert();
			if ($res==1)
			$this->session->set_flashdata('reposne_querry', 'ce candidat est déja affecté à ce programme');
			
			
			 
		}
		//var_dump($id);
		//exit();
	 /*
		if($id!="")
		{
			$resp=$this->mdaffectation_programme->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['nom']=$row->Nom;
				$data['key']=$row->Id;
			}
			
		}*/
		 
		$data['candidat']=$this->mdaffectation_programme->get_candidat_for_select();
		 
		$data['programmes']=$this->mdaffectation_programme->get_programme_for_select();
		$data['affectation_programme']=$this->mdaffectation_programme->get_all();
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/affectation_programme',$data);
		$this->load->view('admin/footer',$data);

	}
	
	public function affectation_programme_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('Model_affectation_programme','mdaffectation_programme');
		$res=$this->mdaffectation_programme->delete($id);
		/*if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');*/
		redirect('admin/affectation_programmme');
	}
	
	
	// VVVVVVVVVVVVVVVVVVVVVV
	
	
	
	public function entreprise($id="")
	{
		//$this->CheckUser();
		//$this->CheckDroit('view_droit');
		$data=array();
		$data['nom']='';
		$data['nomEntreprise']='';
		$data['raisonSocialeEntreprise']='';
		$data['adresseEntreprise']='';
		$data['emailEntreprise']='';
		$data['telEntreprise']='';
		$data['idStatutemployeur']='';
		$data['Pays_idPays']='';
		$data['etatEntreprise']='';
		
		$data['key']='';
		
		$this->load->model('admin/Model_entreprise','mdentreprise');
		if($this->input->post('btnSave'))
		{
			
			
			$this->mdentreprise->nomEntreprise=$this->input->post('nomEntreprise');
			$this->mdentreprise->raisonSocialeEntreprise=$this->input->post('raisonSocialeEntreprise');
			$this->mdentreprise->adresseEntreprise=$this->input->post('adresseEntreprise');
			$this->mdentreprise->emailEntreprise=$this->input->post('emailEntreprise');
			$this->mdentreprise->telEntreprise=$this->input->post('telEntreprise');
			$this->mdentreprise->Pays_idPays=$this->input->post('Pays_idPays');
			$this->mdentreprise->idStatutemployeur=$this->input->post('idStatutemployeur');
			$this->mdentreprise->etatEntreprise=1;
			$this->mdentreprise->qui=1;
			$this->mdentreprise->ou='vv'; 
			$this->mdentreprise->quand=date("Y-m-d H:i"); 

			$res=$this->mdentreprise->insert();
			if ($res==1) 
			$this->session->set_flashdata('reposne_querry', 'cet entreprise est déja enrégistré');
			else
			$this->session->set_flashdata('reposne_querry', 'enregistrement réussi');	
		}

		if($id!="")
		{
			$resp=$this->mdentreprise->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['idStatutemployeur']=$row->idStatutemployeur;
				$data['nomEntreprise']=$row->nomEntreprise;
				$data['raisonSocialeEntreprise']=$row->raisonSocialeEntreprise;
				$data['adresseEntreprise']=$row->adresseEntreprise;
				$data['emailEntreprise']=$row->emailEntreprise;
				$data['telEntreprise']=$row->telEntreprise;
				$data['Pays_idPays']=$row->Pays_idPays;
				$data['idStatutemployeur']=$row->idStatutemployeur;
			}
			
		}
	 
		
		
		
		
		
		//var_dump($id);
		//exit();
	 /*
		if($id!="")
		{
			$resp=$this->mdaffectation_programme->LoadId($id);
			if($resp->num_rows()==1)
			{
				$row=$resp->row();
				$data['nom']=$row->Nom;
				$data['key']=$row->Id;
			}
			
		}*/
		 
		$data['pays']=$this->mdentreprise->get_pays_for_select();
		 
		$data['statutemployeur']=$this->mdentreprise->get_statutemployeur_for_select();
		$data['entreprise']=$this->mdentreprise->get_all();
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/entreprise',$data);
		$this->load->view('admin/footer',$data);

	}
	
	public function entreprise_del($id)
	{
		$this->CheckUser();
		
		$this->load->model('admin/Model_entreprise','mdentreprise');
		$res=$this->mdentreprise->delete($id);
		/*if ($res==1)
		$this->session->set_flashdata('reposne_querry', 'Cet enregistrement a des relations dans d\'autre tables, veuillez les supprimer d\'abord.');*/
		redirect('admin/entreprise');
	}
	
		
}