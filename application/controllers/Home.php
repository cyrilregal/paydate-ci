<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		
		parent::__construct();
		
		if(testAllSession() === false) {
			redirect('main');
		}
	}
	
	public function index() {
		
		$this->load->library('account_lib');
		
		$this->page_infos->setInfos('home');
		
		$action = $this->uri->segment(3);
		$id = ($this->uri->segment(4) == null) ? 1 : ($this->uri->segment(4) == null);
		$year = ((int)$this->uri->segment(5) === 0) ? date('Y') : (int)$this->uri->segment(5);
		$posy = (int)$this->uri->segment(4);
		
		$this->account_lib->fetch($id, $year);
		$TComptes = $this->account_lib->fetchAll();
		
		$datas['posy'] = $posy;
		$datas['js_load'] = array(JS_FOLDER.'spe-index.js');
		
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('home', $datas);
		$this->load->view('footer');
	}
}