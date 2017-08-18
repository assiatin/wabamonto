<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$data['notification']="";
		
		
		//$this->load->model('Model_candidat','mdcandidat');
		
		//$data['statistique']=$this->mdcandidat->statistique();
		
		$this->load->view('index_font',$data);
		
		
		
	}
	
	public function admin()
	{
		//$this->CheckUser();
		$data=array();
		$data['notification']="";
		$this->session->unset_userdata('user_admin');
		if($this->input->post('btnSave'))
		{
			$this->load->model('Model_user','mduser');
			
			$res=$this->mduser->connexion($this->input->post('txtlogin'),$this->input->post('txtpwd'));
				
					
				/*var_dump($res[0]);
		        exit();*/
			
			if(count($res)==1)
			{
				    $sessionarray=array();
					$result=$res[0]; 

					$sessionarray=array("idUsers"=>$result->idUsers,"nomUsers"=>$result->nomUsers,"prenomUsers"=>$result-> prenomUsers,"emailUsers"=>$result->emailUsers,"Profil"=>$result->Profil); 
					 
	         	    $this->session->set_userdata(array("user_admin"=>$sessionarray));
					redirect('welcome/dashboard');
					
				
			}
			else {
				$data['notification']="0";
			}
			
		}
		 
		//$this->load->view('wrapper',$data);
		$this->load->view('connexion_back',$data);

	}
	
	public function dashboard()
	{
		$this->CheckUserAdmin();
		$data=array();
		//$data_session=$this->session->userdata('user_admin');
		//var_dump($data_session);
		
		$this->load->view('menu',$data);
		
		$this->load->view('footer',$data);
		
	}
	
	
	
	public function CheckUser()
	{ 
        if((!$this->session->userdata('user')))
		{
		// $data_session=$this->session->userdata('vitaluser'); 			 
		 redirect('welcome/connexion');
		}
	}
	
	public function CheckUserAdmin()
	{ 
        if((!$this->session->userdata('user_admin')))
		{
		// $data_session=$this->session->userdata('vitaluser'); 			 
		 redirect('welcome/connexion');
		}
	}
	
	
		public function inscription()
	{
		//$this->CheckUser();
		$this->session->unset_userdata('user');
		$data=array();
		$data['nomUtilisateurs']="";
		$data['prenomUtilisateurs']="";
		$data['telUtilisateurs']="";
		$data['emailUtilisateurs']="";
		$data['passwordUtilisateurs']="";
		$data['notification']='a';
			
		$this->load->model('Model_utilisateur','mdutilisateur');
		 if($this->input->post('btnSave'))
		{
	
			$this->mdutilisateur->nomUtilisateurs=$this->input->post('nomUtilisateurs');
			$this->mdutilisateur->prenomUtilisateurs=$this->input->post('prenomUtilisateurs');
			$this->mdutilisateur->telUtilisateurs=$this->input->post('telUtilisateurs');
			$this->mdutilisateur->emailUtilisateurs=$this->input->post('emailUtilisateurs');
			$this->mdutilisateur->passwordUtilisateurs=MD5($this->input->post('passwordUtilisateurs'));
			$this->mdutilisateur->statut=1;
			
			if ($this->input->post('passwordUtilisateurs')!=$this->input->post('passwordUtilisateurs_conf'))
			{
				$data['nomUtilisateurs']=$this->input->post('nomUtilisateurs');
				$data['prenomUtilisateurs']=$this->input->post('prenomUtilisateurs');
				$data['telUtilisateurs']=$this->input->post('telUtilisateurs');
				$data['emailUtilisateurs']=$this->input->post('emailUtilisateurs');
				//$data['pwdCandidat']=$this->input->post('pwdCandidat');
				
				$data['notification']=3;
			}
			else
				$data['notification']= $this->mdutilisateur->inscription();
			//redirect('welcome/pre_insert');
			 
		}
		
		//$this->load->view('header_font',$data);
		//echo base_url();
		$this->load->view('inscription',$data);
        $this->load->view('footer_font',$data);
		
	}
	
	
	public function register_validation($email,$id)
	{
		//$this->CheckUser();
		$data=array();
		$data['notification']='';
		
		$this->load->model('Model_utilisateur','mdutilisateur');
		$this->mdutilisateur->emailUtilisateurs=$email;
		$this->mdutilisateur->idUtilisateurs=$id;
		
		$data['notification']= $this->mdutilisateur->register_validation();
		
		if ($data['notification']=="1")
			{
				redirect('welcome/connexion');

			}
			else
			{
				echo "une erreur s est produite lors de la validation";
				redirect('welcome/connexion');

			}
	}
	
	
	
	public function connexion()
	{
		
		$data=array();
		$data['notification']="";
		$this->session->unset_userdata('user');
		if($this->input->post('btnSave'))
		{
			$this->load->model('Model_utilisateur','mdutilisateur');
			
			$res=$this->mdutilisateur->connexion($this->input->post('txtlogin'),$this->input->post('txtpwd'));
				
					
				/*var_dump($res[0]);
		        exit();*/
			
			if(count($res)==1)
			{
				    $sessionarray=array();
					$result=$res[0]; 

					$sessionarray=array("idUtilisateurs"=>$result->idUtilisateurs,"nomUtilisateurs"=>$result->nomUtilisateurs,"prenomUtilisateurs"=>$result-> 	prenomUtilisateurs,"adresseUtilisateurs"=>$result->adresseUtilisateurs,"telUtilisateurs"=>$result->telUtilisateurs); 
					 
	         	    $this->session->set_userdata(array("user"=>$sessionarray));
					redirect('welcome/proposer_voyage/');
					
				
			}
			else {
				$data['notification']="0";
			}
			
		}
		
		
		//var_dump($this->session->userdata('user'));
		/*exit();*/
		
		//$this->load->view('header_font',$data);
		$this->load->view('connexion_font',$data);
		$this->load->view('footer_font',$data);
		
	}
	
	public function proposer_voyage()
	{
		
		$data=array();
		$data['notification']="";
		
		if(!$this->session->userdata('user'))
		 {
			redirect('welcome/connexion/'); 
		 }
		 $this->load->model('Model_ville','mdville');
		 $data['liste_ville']=$this->mdville->get_all_ville();

		$this->load->view('header_font',$data);
		$this->load->view('proposer_voyage',$data);
		$this->load->view('footer_font',$data);
		
	}
	
	
	public function proposer_voyage2()
	{
		
		$data=array();
		$data['notification']="";
		if(!$this->session->userdata('user'))
		 {
			redirect('welcome/connexion/'); 
		 }
		 
		 $this->load->model('Model_voyage','mdvoyage');
		 if($this->input->post('btnSave'))
		{
	
			$this->mdvoyage->prendreBagage=$this->input->post('prendreBagage');
			$this->mdvoyage->nbrePlaceVoyages=$this->input->post('nbrePlaceVoyages');
			$this->mdvoyage->retardVogages=$this->input->post('retardVogages');
			$this->mdvoyage->coutVoyages=$this->input->post('coutVoyages');
			$this->mdvoyage->descriptionVoyages=$this->input->post('descriptionVoyages');
			$this->mdvoyage->estAllerSimple=$this->input->post('estAllerSimple');
			$this->mdvoyage->typeVoyages=$this->input->post('typeVoyages');
			$this->mdvoyage->villeDepartVoyages=$this->input->post('villeDepartVoyages');
			$this->mdvoyage->villeArriveeVoyages=$this->input->post('villeArriveeVoyages');
			$this->mdvoyage->dateDepartVoyages=date('Y-m-d',strtotime($this->input->post('dateDepartVoyages')));
			$this->mdvoyage->dateRetourVoyages=date('Y-m-d',strtotime($this->input->post('dateRetourVoyages')));
			$this->mdvoyage->heureDepartVoyages=$this->input->post('heureDepartVoyages');
			$this->mdvoyage->heureRetourVoyages=$this->input->post('heureRetourVoyages');
			 
			
				$data['notification']= $this->mdvoyage->proposer();
			redirect('welcome/proposer_voyage');
			 
		}
		
		// $this->load->model('Model_ville','mdville');
		// $data['liste_ville']=$this->mdville->get_all_ville();

		$this->load->view('header_font',$data);
		$this->load->view('proposer_voyage2',$data);
		$this->load->view('footer_font',$data);
		
	}
	
	public function chercher_voyage()
	{
		
		$data=array();
		$data['notification']="";
		$data['villeDepartVoyages']="";
		$data['villeArriveeVoyages']="";
		$data['dateDepartVoyages']="";
		$data['dateRetourVoyages']="";
		
		if(!$this->session->userdata('user'))
		 {
			redirect('welcome/connexion/'); 
		 }
		 
		  	$this->load->model('Model_voyage','mdvoyage');
			/*$this->mdvoyage->villeDepartVoyages="";
			$this->mdvoyage->villeArriveeVoyages="";
			$this->mdvoyage->dateDepartVoyages="";
			$this->mdvoyage->dateRetourVoyages="";
			$data['liste_voyage']=$this->mdvoyage->search();*/
			$data['liste_voyage']=array();
		 if($this->input->post('btnSave'))
		{
	
			
			$this->mdvoyage->villeDepartVoyages=$this->input->post('villeDepartVoyages');
			$this->mdvoyage->villeArriveeVoyages=$this->input->post('villeArriveeVoyages');
			$this->mdvoyage->dateDepartVoyages=date('Y-m-d',strtotime($this->input->post('dateDepartVoyages')));
			$this->mdvoyage->dateRetourVoyages=date('Y-m-d',strtotime($this->input->post('dateRetourVoyages')));
			
			  $data['villeDepartVoyages']=$this->input->post('villeDepartVoyages');
			$data['villeArriveeVoyages']=$this->input->post('villeArriveeVoyages');
		 
			
				$data['liste_voyage']= $this->mdvoyage->search();
			// var_dump($data['liste_voyage']);
			 //exit();
			 
		}
		 
		 
		 $this->load->model('Model_ville','mdville');
		 $data['liste_ville']=$this->mdville->get_all_ville();
		
		
		$this->load->view('header_font',$data);
		$this->load->view('chercher_voyage',$data);
		$this->load->view('footer_font',$data);
		
	}
	
	public function demo()
	{
		
		$data=array();
		$data['notification']="";
		
		
		
		$this->load->view('demo',$data);
		
	}
	
	public function deconnexion_admin()
	{
		 
    	
		$this->session->set_userdata(array('user_admin'=>null));	 
		 redirect('welcome');
	
	}
	
	
	public function deconnexion()
	{
		 
    	
		$this->session->set_userdata(array('user'=>null));	 
		 redirect('welcome');
	
	}
	
	
		
		public function user_sys($id="")
	{
		//$this->CheckUser();
		$this->session->unset_userdata('user');
		$data=array();
		$data['idUsers']='';
        $data['nomUsers']='';
        $data['prenomUsers']='';
        $data['adresseUsers']='';
        $data['telUsers']='';
        $data['emailUsers']='';
        $data['Profil']='';
        $data['actif']='';
        
			
		$this->load->model('Model_user','mduser');
		 if($this->input->post('btnSave'))
		{
	
			$this->mduser->nomUsers=$this->input->post('nomUsers');
			$this->mduser->prenomUsers=$this->input->post('prenomUsers');
			$this->mduser->telUsers=$this->input->post('telUsers');
			$this->mduser->emailUsers=$this->input->post('emailUsers');
			$this->mduser->Profil=$this->input->post('Profil');
			if ($this->input->post('statut')=='on')
				$this->mduser->statut=1;
			else
				$this->mduser->statut=0;
			
			
			if ($id=="")
			$data['notification']= $this->mduser->insert_user();
			else
			$data['notification']= $this->mduser->update_user();
			//redirect('welcome/pre_insert');
			 
		}
		
		 if($id!="")
		{
			$data['user']=$this->mduser->LoadId($id);
			 
			if(count($data['user'])==1)
			{
				$row=$data['user'][0];
				 
				$data['idUsers']=$row->idUsers;
				$data['nomUsers']=$row->nomUsers;
				$data['prenomUsers']=$row->prenomUsers;
				$data['adresseUsers']=$row->adresseUsers;
				$data['emailUsers']=$row->emailUsers;
				$data['telUsers']=$row->telUsers;
				$data['Profil']=$row->Profil;
				$data['actif']=$row->actif;
				 
				
				 
			}
			
		}
		$data['user']=$this->mduser->get_all();
		//$this->load->view('header_font',$data);
		//echo base_url();
		$this->load->view('menu',$data);
		$this->load->view('user_sys',$data);
		$this->load->view('footer',$data);
		
	}
	
	
	public function user_init($id="")
	{
		//$this->CheckUser();
		$this->session->unset_userdata('user');
		$data=array();
		$this->load->model('Model_user','mduser');
		 if($id!="")
		{
			$this->mduser->user_init($id);
		}
		redirect('welcome/user_sys');
		
	}
	
	
	
	
}
