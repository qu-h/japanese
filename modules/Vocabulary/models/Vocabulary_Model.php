<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Vocabulary_Model extends CI_Model {
	var $table = 'course';

	var $course_fields = array(
	    'id' => array(
	        'type' => 'hidden'
	    ),
	    'name' => array(
	        'label' => 'Course Name',
	        'desc' => null,
	        'icon' => 'send'
	    ),
	    'alias' => array(
	        'label' => 'Alias',
	        'desc' => null,
	        'icon' => 'link'
	    ),
	    'category' => array(
	        'type' => 'select',
	        'icon' => 'list'
	    ),
	    'source' => array(
	        'type' => 'text',
	        'icon' => 'link'
	    ),
	    'content' => array(
	        'type' => 'textarea'
	    )
	);

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

    function fields(){
        return $this->course_fields;
    }
	function get_item_by_id($id=0){
	    return $this->db->where('id',$id)->get($this->table)->row();
	}

	function update($data=NULL){
	    if( !isset($data['alias']) OR  strlen($data['alias']) < 1 ){
	        if( strlen($data['name']) > 0 ){
	            $data['alias'] = url_title($data['name'],'-',true);
	        } else {
	            set_error('Please enter alias');
	            return false;
	        }

	    }
	    if( !isset($data['id']) ){
	        $data['id'] = 0;
	    }
	    if( is_null($data['category']) ){
	        $data['category'] = 0;
	    }
	    if( $this->check_exist($data['alias'],$data['id'],$data['category']) ){
	        set_error('Dupplicate Course');
	        return false;
	    } elseif( intval($data['id']) > 0 ) {
	        $data['modified'] = date("Y-m-d H:i:s");
	        $id = $data['id']; unset($data['id']);
	        $this->db->where('id',$id)->update($this->table,$data);
	        return $id;
	    } else {
	        $this->db->insert($this->table,$data);
	        return $this->db->insert_id();
	    }


	}


	function check_exist($alias,$id,$category=0){
	    if( !is_numeric($category) ){
	        $category = 0;
	    }
	    if( !is_numeric($id) ){
	        $id = 0;
	    }
	    $this->db->where('alias',$alias)
	    ->where("category = $category")
	    ->where('id <>',$id);
	    $result = $this->db->get($this->table);
	    //bug($this->db->last_query());
	    return ( $result->num_rows() > 0) ? true : false;
	}
}