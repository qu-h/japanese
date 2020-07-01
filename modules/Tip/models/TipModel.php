<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class TipModel extends CI_Model {
	var $table = 'tip';

	var $tip_fields = array(
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

	    'content' => array(
	        'type' => 'textarea'
	    ),
        'status' => ['type' => 'publish', 'value'=>1],
        'ordering'=>['type'=>'number','icon'=>'sort-numeric-desc']
	);

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

    function fields(){
        return $this->tip_fields;
    }
	function get_item_by_id($id=0){
	    return $this->db->where('id',$id)->get($this->table)->row();
	}

	function get_items_by_alias($alias=NULL){
	    $alias = explode(',', $alias);

	    return $this->db->where_in('alias',$alias)->get($this->table)->result();
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
	    if( !isset($data['id']) || strlen($data['id']) < 1 ){
	        $data['id'] = 0;
	    }

        $data['status'] = $data['status']=='on' ? true:false;

        if( !isset($data['ordering']) || strlen($data['ordering']) < 1 ){
            $data['ordering'] = 0;
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

    function items_json($fields=[], $actions_allow=NULL){
        $this->db->select('a.id,a.name,a.content, a.category,a.status, a.ordering');
//        if( $category_id !== null ){
//            $this->db->where("a.category",$category_id);
//        }
        $this->db->where("(a.status <> -1 OR a.status IS NULL)");
//	    $this->db->order_by('a.ordering DESC');
        $query = $this->db->get($this->table." AS a");
        $items = array();
        if( !$query ){
            bug($this->db->last_query());die("error");
        }
        foreach ($query->result() AS $ite){
            $ite->content = word_limiter($ite->content,20);
            $items[] = $ite;
        }
        return jsonData(array('data'=>$items));
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