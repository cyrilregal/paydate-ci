<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {
	
	/**
	 * Login form managment.
	 */
	public function login() {
		
		$rules = array(
			array('field' => 'login_input', 'lang:label_login_input', 'rules' => 'required'),
			array('field' => 'password_input', 'lang:label_password_input', 'rules' => 'required'),
			array('field' => 'remember_me_radio', 'lang:label_remember_me_radio', 'rules' => 'trim')
		);
		
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() === false) {
			$this->connection_form();
		}
		else {
			$this->connection_treatment();
		}
	}
	
	/**
	 * Prepare login form
	 */
	private function connection_form() {
		
		$this->page_infos->title = $this->lang->line('login_page_title');
		$this->page_infos->keyword = $this->lang->line('login_page_keyword');
		$this->page_infos->description = $this->lang->line('login_page_description');
		
		$this->load->view('header');
		$this->load->view('login_form.php');
		$this->load->view('footer');
	}
	
	/**
	 * Treat login form
	 */
	private function connection_treatment() {
		
	}
	
	/**
	 * Disconnect user session and redirect him to main
	 */
	public function deconnection() {
		$this->destruction_session();
		redirect('main');
	}
	
	/**
	 * Crash manually importants related datas by safety and destroy session.
	 */
	private function session_destroy() {
		$this->session->unset_userdata('isUserConnected');
		$this->session->unset_userdata('isAdminConnected');
		$this->session->unset_userdata('userId');
		
		$this->session->sess_destroy();
		$this->session->sess_create();
	}
}
