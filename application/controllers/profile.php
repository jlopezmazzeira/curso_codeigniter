<?php 

/**
* 
*/
class Profile extends CI_Controller
{
	
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('login')) {
			header("Location: " . base_url());
		}

	}

	public function index()
	{
		$data = array(
			'title' => 'Perfil', 
			'app' => 'Blog',
			'img' => 'home-bg.jpg', 
			'description' => 'Esta es la descripción de la app');
		$this->load->view("/guest/head",$data);
		$this->load->view("/guest/nav",$data);
		$this->load->view("/guest/header",$data);
		//Para carggar formularios con Codeigniter
		//$this->load->helper('form');
		$data['post'] = $this->post->getPost();
		$this->load->view("/user/content",$data);
		$this->load->view("/guest/footer");

	}	
}