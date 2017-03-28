<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Course_Model extends CI_Model {
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
	    ),
	    'vocabulary' => array(
	        'type' => 'vocabulary',
	        'icon' => 'send',
	        'course'=>0
	    ),
	    'conversation' => array(
	        'type' => 'conversation',
	        'course'=>0
	    ),

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

	function get_item_by_alias($alias=NULL){
	    $this->db->where("alias LIKE '$alias' ")->from($this->table);
	    $item = $this->db->get()->row();

	    if( !empty($item) ){
	    	$this->db->where('c.course',$item->id)->from('course_conversation AS c')->select('c.id, c.content_jp, c.content_vn, c.content_read, c.mp3');
	    	$this->db->join('course_conversation_character AS ch','ch.id= c.character','LEFT')->select('ch.name AS char_name, ch.id AS char_id, ch.avatar');
    		$this->db->order_by('c.order ASC, c.id ASC');
	    	$item->conversation = $this->db->get()->result();
	    }
	    return $item;
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
	    $conversations = array();
	    if( isset($data['conversation']) ){
	        $conversations = $data['conversation'];
	        if( is_array($conversations) AND isset($conversations['content_jp']) ){

	        }
	        unset($data['conversation']);
	    }
	    $vocabulary = array();
	    if( isset($data['vocabulary']) ){
	        $vocabulary = $data['vocabulary'];
	        unset($data['vocabulary']);
	    }


	    if( $this->check_exist($data['alias'],$data['id'],$data['category']) ){
	        set_error('Dupplicate Course');
	        return false;
	    } elseif( intval($data['id']) > 0 ) {
	        $data['modified'] = date("Y-m-d H:i:s");
	        $id = $data['id']; unset($data['id']);
	        $this->db->where('id',$id)->update($this->table,$data);
	    } else {
	        $this->db->insert($this->table,$data);
	        $id = $this->db->insert_id();
	    }

	    $this->Conversation_Model->update_course($conversations,$id);

	    $vocabularys = $this->Vocabulary_Model->update_course($vocabulary);
	    mb_internal_encoding('utf-8');
        $vocabularys = serialize($vocabularys);

	    $this->db->where('id',$id)->update($this->table,array('vocabulary'=>$vocabularys) );

	    return $id;
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