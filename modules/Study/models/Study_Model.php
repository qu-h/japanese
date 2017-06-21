<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Study_Model extends CI_Model {
	var $table = 'learning';
	var $table_word = 'learning_vocabulary';
	
	function __construct(){
	    parent::__construct();
	    $this->load->database();
	}
	
	public function get_words($uid=0){
	    $query = $this->db->select("word, word_id")->get($this->table_word);
	    return $query->result();
	}
}