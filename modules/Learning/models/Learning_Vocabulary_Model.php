<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Learning_Vocabulary_Model extends CI_Model {
	var $table = 'learning_vocabulary';

	var $vocabulary_fields = array(
	        'id'=>array('type'=>'hidden'),
	        'word' => array(
                'label' => 'Word',
                'desc' => null,
	                "class"=>"typeaheadcomplate",
                'icon' => 'send'
	        ),
	        'word_id'=>array('type'=>'hidden','value'=>0),
	);
	function fields(){
	    return $this->vocabulary_fields;
	}
	
	function get_item_by_id($id=0){
	    return $this->db->where('id',$id)->get($this->table)->row();
	}
	
	function update($data=NULL){
     
	    if( !isset($data['id']) ){
	        $data['id'] = 0;
	    }
	

	    $this->db->where('word',trim($data['word']))
	    ->where('id <>',$data['id']);
	    $check = $this->db->get($this->table);
    	
	    if( $check->num_rows() < 1 ) {
	        $data['created'] = date("Y-m-d H:i:s");
	        $this->db->insert($this->table,$data);
	        return $this->db->insert_id();
	    }
	}
}