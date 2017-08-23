<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page_Infos {
	public $title = "Title";
	public $keywords = "Keyword";
	public $description = "Description";
	private $CI;
	private $lang;
	
	public function __construct(){
		$this->CI = &get_instance();
		$this->lang = &$this->CI->lang;
	}
	
	public function setInfos($page){
		$this->title = $this->lang->line($page.'_page_title');
		$this->keyword = $this->lang->line($page.'_page_keyword');
		$this->description = $this->lang->line($page.'_page_description');
	}
}