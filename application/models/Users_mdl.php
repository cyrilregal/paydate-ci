<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_mdl extends CI_Model {
	
	public function login_test($login, $password) {
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('login', $login);
		$this->db->where('pass_crypted', sha1($password));
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row()->id;
		}
		else {
			return false;
		}
	}
	
	public function get($id_user){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('rowid', $id_user);
		$query = $this->db->get();
		echo $id_user;
		echo(printr($query->row()));
		return $query->row();
	}
}
	