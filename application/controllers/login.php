<?php 

/**
* 
*/
class Login extends CI_Controller
{
	public function index()
	{
		$user = $this->input->post('user');
		$password = $this->input->post('password');
		$this->load->model('user');
		$result = $this->user->getUser($user);

		if ($result != null) {
			if ($result->password == $password) {
				$data = array('user' => $user, 'id' => $result->id, 'login' => true);
				$this->session->set_userdata($data);		
			} else {
				header("Location: " . base_url());
			}	
		} else {
			header("Location: " . base_url());
		}
		
		//echo $this->session->userdata('user');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		header("Location: " . base_url());
	}
}
