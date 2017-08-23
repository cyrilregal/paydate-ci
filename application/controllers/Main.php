<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function index() {
		
		if(testAllSession() === true) {
			redirect('home');
		}
		else {
			
			if($this->session->flashdata('error_msg')) {
				$this->session->keep_flashdata('error_msg');
			}
			
			redirect('connection/login');
		}
	}
}
