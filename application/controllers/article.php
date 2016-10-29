<?php  

/**
* 
*/
class Article extends CI_Controller
{
	
	public function post($year, $name)
	{
		//$post = $this->post->getPostById($id);
		$post = $this->post->getPostYearAndTitle($year, $name);
		if ($post == null) {
			echo "Error";
			return;
		}

		if (!isset($post->image) || $post->image == "") {
			$post->image = 'home-bg.jpg';
		}

		$data = array('title' => $post->title, 'app' => 'Blog', 'description' => $post->description, 'content' => $post->content, 'img' => $post->image);
		$this->load->view("/guest/head",$data);
		$this->load->view("/guest/nav",$data);
		$this->load->view("/guest/header",$data);
		$this->load->view("/guest/post",$data);
		$this->load->view("/guest/footer");
	}

	public function newPost()
	{
		if (!$this->session->userdata('login')) {
			header("Location: " . base_url());
		}

		$data = array(
			'title' => 'Nuevo post', 
			'img' => 'home-bg.jpg',
			'app' => 'Post', 
			'description' => 'Estas a punto de crear un nuevo post');
		$this->load->helper('richtext');
		$this->load->view("/guest/head",$data);
		$this->load->view("/guest/nav",$data);
		$this->load->view("/guest/header",$data);
		//Para carggar formularios con Codeigniter
		$this->load->helper('bootstrap');
		$this->load->view("/article/new");
		$this->load->view("/guest/footer");
	}

	public function createPost()
	{
		if (!$this->session->userdata('login')) {
			header("Location: " . base_url());
		}

		$post = $this->input->post();
		$this->load->model('file');
		$file_name = $this->file->UploadImage('./public/img/','Error al subir imagen');
		$post['file_name'] = $file_name;
		$bool = $this->post->insertPost($post);
		if ($bool) {
			header("Location: " . base_url() . "profile");
		} else {
			header("Location: " . base_url() . "article/newPost");
		}
	}

	public function delete()
	{
		$post = $this->input->post();
		$postname = $post['postname'];
		$id = $post['id'];
		//echo $id;
		$bool = $this->post->deletePostByName($postname);

		if ($bool) {
			echo $id;
		} else {
			echo false;
		}
		
	}

	public function edit($year,$title)
	{
		$post = $this->post->getPostYearAndTitle($year, $title);
		
		if ($post == null) {
			echo "Error";
			return;
		}

		if (!isset($post->image) || $post->image == "") {
			$post->image = 'home-bg.jpg';
		}

		$data = array('title' => $post->title, 'app' => 'Blog', 'description' => $post->description, 'content' => $post->content, 'img' => $post->image);
		$this->load->view("/guest/head",$data);
		$this->load->view("/guest/nav",$data);
		//$this->load->view("/guest/header",$data);
		$data['row'] = $post;
		$this->load->view("/article/edit",$data);
		$this->load->view("/guest/footer");
		
	}

	public function update()
	{
		$post = $this->input->post();
		$data['title'] = $post['title'];
		$data['description'] = $post['description'];
		$data['content'] = $post['content'];
		$this->db->where('id', $post['id']);
		if($this->db->update('post',$data)){
			header("Location: " . base_url('profile'));
		} else {
			echo "No se puede actualizar";
		}
	}

	public function updateImage()
	{
		$this->load->model('file');
		$file_name = $this->file->UploadImage('./public/img/','Error al subir imagen');
		if ($file_name == null) {
			echo false;
			return;
		}
		$post = $this->input->post();
		$this->db->where('id', $post['id']);
		$data['image'] = $file_name;
		if($this->db->update('post',$data)){
			echo base_url('public/img/') . '/' . $file_name;
		} else {
			echo false;
		}
	}

}