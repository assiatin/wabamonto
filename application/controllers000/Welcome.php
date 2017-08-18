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
		$data['notification']='';
		 
		//$this->load->view('wrapper',$data);
		$this->load->view('connexion_back',$data);

	}
	
	public function dashboard()
	{
		$this->CheckUser();
		$data=array();
		
		$this->load->view('menu',$data);
		
		$this->load->view('footer',$data);
		
	}
	
	
	
	public function CheckUser()
	{ 
        /*if(!$this->session->userdata('sysuser'))
		{
		// $data_session=$this->session->userdata('vitaluser'); 			 
		 redirect('welcome');
		}*/
	}
	
	
	
	
	
	
}
