<?php 

/**
* 
*/
class Post extends CI_Model
{
	
	public function getPost()
	{
		return $this->db->get('post');
	}
	
	public function getPostById($id = '')
	{
		$result = $this->db->query("SELECT *FROM post WHERE id = '". $id ."' LIMIT 1");
		return $result->row();
	}

	public function insertPost($post = null)
	{
		if ($post != null) {
			$title = $post['title'];
			$description = $post['description'];
			$content = $post['content'];
			$file_name = $post['file_name'];

			$SQL = "INSERT INTO post(id,title,description,content,image,date_post) VALUES (null,'$title','$description','$content','$file_name',curdate());";
			
			if ($this->db->query($SQL)) {
				return true;
			}
		}
		
		return false;
	}

	public function getPostYearAndTitle($year = '', $title = '')
	{
		$result = $this->db->query("SELECT *FROM post WHERE year(date_post) = '$year' AND title LIKE '$title'");
		return $result->row();
	}

	public function numPost()
	{
		$number = $this->db->query("SELECT count(*) AS number FROM post")->row()->number;
		return intval($number);
	}

	public function getPagination($numberPerPage)
	{
		return $this->db->get("post",$numberPerPage,$this->uri->segment(3));
	}

	public function deletePostByName($name = null)
	{
		if ($name != null) {
			
			$SQL = "DELETE FROM post WHERE title = '". $name ."'";
			
			if ($this->db->query($SQL)) {
				return true;
			}
		}
		return false;
	}
}