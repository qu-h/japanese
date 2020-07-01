<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Character_Model extends CI_Model {
	var $table = 'characters';

	

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

    function get_row($type=NULL,$romaji=NULL){
        $return_array = array(
                "character"=>'','type'=>'','romaji'=>'','code'=>''
        );
        $this->db->select(array_keys($return_array));
        $this->db->where(array('type'=>$type,'romaji'=>$romaji));
        $row = $this->db->get($this->table)->row_array();
        
        return !empty($row) ? $row : $return_array;
    }
}