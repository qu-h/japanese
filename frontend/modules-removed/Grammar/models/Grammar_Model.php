<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Grammar_Model_removed extends CI_Model {
	var $table = 'grammar';

	var $grammar_fields = array(
	    'id' => array(
	        'type' => 'hidden'
	    ),
	    'title' => array(
	        'label' => 'Grammar Title',
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
        'grammar'=>array(
	        'type' => 'textarea'
	    ),
        'description'=>array(
	        'type' => 'textarea'
	    ),
        'example'=>array(
	        'type' => 'textarea'
	    ),
// 	    'content' => array(
// 	        'type' => 'textarea'
// 	    ),
	    //'type'=>array('type' => 'hidden','value'=>'grammar')
	);

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

    function fields(){

    	$this->grammar_fields["category"]['options'] = $this->SystemCategoryModel->load_options("grammar");
        return $this->grammar_fields;
    }

	function get_item_by_id($id=0){
	    return $this->db->where('id',$id)->get($this->table)->row();
	}

	function get_item_by_alias($alias=0){
	    $row = $this->db->where('alias',$alias)->get($this->table)->row();
	    return $row;
	}

	function update($data=NULL){
	    if( !isset($data['alias']) OR  strlen($data['alias']) < 1 ){
	        if( strlen($data['title']) > 0 ){
	            $data['alias'] = url_title($data['title'],'-',true);
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
	        set_error('Dupplicate Grammar');
	        return false;
	    } elseif( intval($data['id']) > 0 ) {
	        $data['modified'] = date("Y-m-d H:i:s");
	        $id = $data['id'];
	        unset($data['id']);
	        
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
	    return ( $result->num_rows() > 0) ? true : false;
	}

	/*
	 * Json return for Datatable
	 */
	function items_json($actions_allow=NULL){
	    $this->db->from($this->table." AS gra")->select('gra.id,gra.title,gra.grammar');
	    $this->db->join("category AS c","c.id=gra.category","LEFT")->select("c.name AS category");
// 	    $this->db->where('type','grammar');
	    $this->db->order_by('id ASC');
	    $query = $this->db->get();
	    $items = array();
	    foreach ($query->result() AS $ite){

	        $ite->actions = "";
	        $items[] = $ite;
	    }
	    return jsonData(array('data'=>$items));
	}
}