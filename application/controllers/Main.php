<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function index() {
		
		if(testUserSession() === true OR testAdminSession() === true) {
			redirect('home');
		}
		else {
			redirect('connection/login');
		}
	}
}
