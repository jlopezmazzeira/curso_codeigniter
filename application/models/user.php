<?php 

/**
* 
*/
class User extends CI_model
{
	public function getUser($email='')
	{
		$result = $this->db->query("SELECT * FROM user WHERE email = '".$email."'");
		if ($result->num_rows() > 0) {
			return $return->row();
		} else {
			return null;
		}
		
	}	
}

 ?>