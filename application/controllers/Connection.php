<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {
	
	/**
	 * Login form managment.
	 */
	public function login() {
		
		$rules = array(
			array('field' => 'login_input', 'lang:label_login_input', 'rules' => 'required'),
			array('field' => 'password_input', 'lang:label_password_input', 'rules' => 'required'),
			array('field' => 'remember_me_checkbox', 'lang:label_remember_me_checkbox', 'rules' => 'trim')
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
		
		$this->page_infos->setInfos('login');
		
		$this->load->view('header');
		$this->load->view('login_form.php');
		$this->load->view('footer');
	}
	
	/**
	 * Treat login form
	 */
	private function connection_treatment() {
		
		$this->load->model('users_mdl');
		
		$login = $this->input->post('login_input');
		$password = $this->input->post('password_input');
		
		$id_user = $this->users_mdl->login_test($login, $password);
		
		if($id_user === false) {
			$this->session->set_flashdata('error_msg', $this->lang->line('error_msg_bad_login'));
			redirect('connection/login');
		}
		else {
			
			$this->session->set_userdata('isUserConnected', true);
			$this->session->set_userdata('userId',$id_user);
			redirect('home');
		}
	}
	
	/**
	 * Disconnect user session and redirect him to main
	 */
	public function logout() {
		$this->session_destroy();
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
	}
}
