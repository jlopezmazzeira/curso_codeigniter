<?php 

/**
* 
*/
class Home extends CI_Controller
{
	
	public function index($value='')
	{
		header("Location: " . base_url('home/articles'));
	}

	public function articles()
	{
		/*Para destruir las sesiones*/
		//$this->session->sess_destroy();
		$data = array(
			'title' => 'Home', 
			'img' => 'home-bg.jpg',
			'app' => 'Blog', 
			'description' => 'Esta es la descripción de la app');
		$this->load->view("/guest/head",$data);
		$this->load->view("/guest/nav",$data);
		$this->load->view("/guest/header",$data);
		/*
		Cuando no lo cargamos automaticamente, lo podemos usar de la siguiente forma
		$this->load->model('post');
		*/
		
		/*Para utilizar la paginación*/
		$this->load->library('pagination');

		$config['base_url'] = base_url() . 'home/articles/';
		$config['total_rows'] = $this->post->numPost();
		$config['per_page'] = 2;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$result = $this->post->getPagination($config['per_page']);
		//$result = $this->db->get('post');
		$data['data'] = $result;
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view("/guest/content",$data);
		$this->load->view("/guest/footer");

		//$this->load->view("home",$data);
	}

}