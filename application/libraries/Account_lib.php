<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Account class
 */
class Account_lib {
	public $element='account';
	public $table_element='account';
	public $TChamps = array(
			'rowid'=>'number'
			,'label'=>'string'
			,'ref'=>'string'
			,'amount'=>'float'
			,'comment'=>'text'
	);
	
	var $label;
	var $ref;
	var $bank_name;
	var $code_banque;
	var $code_guichet;
	var $number;
	var $cle_rib;
	var $bic;
	var $iban_prefix;
	var $country_iban;
	var $cle_iban;
	var $status;
	var $url;
	var $account_number;
	var $min_allowed;
	var $min_desired;
	var $amount;
	var $amount_before;
	var $comment;
	var $signe;
	var $trans_signe;
	
	private $CI;
	private $db;
	
	public function __construct() {
		$this->status = 0;
		$this->CI = &get_instance();
		$this->db = &$this->CI->db;
	}
	
	public function signe() {
		if($this->amount == 0) {
			$this->signe = 0;
			$this->trans_signe = 'null';
			return 0;
		} elseif($this->amount > 0) {
			$this->signe = 1;
			$this->trans_signe = 'positif';
			return 1;
		} else {
			$this->signe = 2;
			$this->trans_signe = 'negatif';
			return 2;
		}
	}
	
	public function fetch($id, $year = null) {
		
		$this->fetch_last_total($year);
		$this->fetch_total();
		$this->fetch_current_total();
		
		$this->db->select('*');
		$this->db->from('account');
		$query = $this->db->get();
		
		if(!empty($id)) {
			$this->db->where('rowid', $id);
		}
		return $query->result();
	}
	
	public function fetchAll() {
		$ret = array();
		
		$this->db->select('rowid');
		$this->db->from('account');
		$query = $this->db->get();
		$res = $query->row();
		$this->fetch($res->rowid);
		
		$ret[$res->rowid] = $this;
		
		return $ret;
	}
	
	public function fetch_current_total() {
		
		$total = 0;
		$date = time();
		
		$this->db->select_sum('amount', 'total');
		$this->db->from('payment');
		$this->db->where('fk_bank', 0);
		$this->db->where('datep <=', (date('Y',$date)).'-'.(date('m',$date)).'-'.(date('d',$date)));
		$this->db->where('datep >', "1970-01-01");
		$this->db->where('exceptionnel >', 0);
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			$total = $query->row()->total;
		}
		$this->amount = (float)$total;
	}
	
	public function fetch_total() {
		
		$total = 0;
		$date = time();
		
		$this->db->select_sum('amount', 'total');
		$this->db->from('payment');
		$this->db->where('fk_bank', 0);
		$this->db->where('datep >', "1970-01-01");
		$this->db->where('exceptionnel', 0);
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			$total = $query->row()->total;
		}
		$this->amount = (float)$total;
	}
	
	public function fetch_last_total($year = null) {
		if(!empty($year)) {
			
			$total = 0;
			
			$this->db->select_sum('amount', 'total');
			$this->db->from('payment');
			$this->db->where('fk_bank', 0);
			$this->db->where('datep <=', (date('Y',$year)).'-'.(date('m',$year)).'-'.(date('d',$year)));
			$this->db->where('datep >', "1970-01-01");
			$this->db->where('exceptionnel', 0);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$total = $query->row()->total;
			}
			$this->amount_before= (float)$total;
		}
	}
	
	public static function calcul_totaux($compte, $TData) {
		$res = array();
		if(!empty($TData)) {
			foreach($TData as $year => $TMonths) {
				$res[$year]['current'] = 0;
				
				if(!empty($TMonths)) {
					foreach($TMonths as $month => $TDays) {
						$res[$year][$month]['current'] = 0;
						
						if(!empty($TDays)) {
							foreach($TDays as $day => $TPayments) {
								$res[$year][$month][$day]['current'] = 0;
								
								if(!empty($TPayments)) {
									foreach($TPayments as $payment) {
										// Test si payé
										if($payment->rowid > 0) {
											$res[$year][$month][$day]['current'] += $payment->amount;
											$res[$year][$month]['current'] += $payment->amount;
											$res[$year]['current'] += $payment->amount;
										}
									}
								}
							}
						}
					}
				}
			}
		}
		return $res;
	}
}