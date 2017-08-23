<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_lib {
	
	public $id;
	public $isAdmin = 0;
	public $firstname = "";
	public $last_name = "";
	public $login = "";
	public $isConnected = false;
	
	private $CI;
	private $session;
	
	public function __construct() {
		
		$this->CI = &get_instance();
		$this->session = &$this->CI->session;
		
		if($this->session->userdata('isUserConnected')) {
			
			$this->CI->load->model('users_mdl');
			$this->id = $this->session->userdata('userId');
			
			$user = $this->CI->users_mdl->get($this->id);
			if(!empty($user)) {
				$this->login = $user->login;
				$this->lastname = $user->lastname;
				$this->firstname = $user->firstname;
				$this->email = $user->email;
				$this->isAdmin = (bool)$user->admin;
				$this->datelastlogin = $user->datelastlogin;
				$this->isConnected = true;
			}
		}
	}
}


