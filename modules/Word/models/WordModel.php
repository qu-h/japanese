<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class WordModel extends MX_Model {
	var $table = 'word';

	var $img_dirs = array(
	       'akira.edu.vn'
	);
	var $word_fields = array(
	    'id' => array(
	        'type' => 'hidden'
	    ),
        'romaji'=>'',
	    
	    'alias' => array(
	        'label' => 'Alias',
	        'desc' => null,
	        'icon' => 'link'
	    ),
        'type'=>array('type'=>'select'),
        'kanji' => array(
            'icon' => 'send',
            'id'=>'input-kanji'
        ),
        'hiragana'=>array("id"=>'input_hira','class'=>'hiragana-input'),
        'katakana'=>['class'=>'katakana-input'],
        'vietnamese'=>['class'=>'vietnamese-input'],
        'english'=>'',
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
        
        $query = "SHOW COLUMNS FROM ".$this->table." LIKE 'type'";
        $row = $this->db->query("SHOW COLUMNS FROM ".$this->table." LIKE 'type'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $this->word_fields["type"]['options'][$value] = lang($value);
        }
		
        return $this->word_fields;
    }
    
	function get_item_by_id($id=0){
	    return $this->db->where('id',$id)->get($this->table)->row();
	}
	function get_item_by_alias($id=0){
	    return $this->db->where('alias',$id)->get($this->table)->row();
	}
	function get_item_by_romaji($romaji_str=null){
	    $romaji_str = strtolower($romaji_str);
	    $this->db->from($this->table);
        $this->db->where("LOWER(romaji)",$romaji_str);
        return $this->db->get()->row();
	}

	/**
	 * Update Word
	 */
	function update($data=NULL,$returnIdExist=false){

	    $data['romaji'] = trim($data['romaji']);
        $data['romaji'] = mb_strtolower($data['romaji']);
	    if( strlen($data['romaji']) < 1 ){
	        set_error('Please enter romaji');
	        return false;
	    }
	    
	    if( !isset($data['alias']) OR  strlen($data['alias']) < 1 ){
	        if( strlen($data['romaji']) > 0 ){
	            $data['alias'] = url_title($data['romaji'],'-',true);
	        } else {
	            set_error('Please enter alias');
	            return false;
	        }
	    }
	    
	    if( !isset($data['id']) || strlen($data['id']) < 1 ){
	        $data['id'] = 0;
	    }

	    if( $id_exist = $this->check_exist($data['romaji'],$data['id']) ){
	        if( $returnIdExist ){
	            return $id_exist;
            }
	        //set_error('Dupplicate Word, are you want '.anchor("admin/word/edit/$id_exist","edit")." ?");
	        return false;
	    } elseif( intval($data['id']) > 0 ) {
	        $data['modified'] = date("Y-m-d H:i:s");
	        $id = $data['id'];
	        unset($data['id']);

	        $this->db->where('id',$id)->update($this->table,$data);
	    } else {
	        $data['created'] = date("Y-m-d H:i:s");
	        $this->db->insert($this->table,$data);

	        $id = $this->db->insert_id();
	    }

        return $id;
	}

	function update_by_romaji($data){
	    if( strlen($data['romaji']) < 1 ){
	        set_error('Please enter romaji');
	        return false;
	    }
	    $data['romaji'] = strtolower($data['romaji']);
	    foreach ($data AS $k=>$val){
	        if( !in_array($k, array("romaji","hiragana","katakana","kanji")) ){
	            unset($data[$k]);
	        }
	    }
	    $row = $this->db->where('romaji',trim($data['romaji']))->get($this->table);
	    if( $row->num_rows() > 0 ){
	        $old_data = $row->row();
	        $data['modified'] = date("Y-m-d H:i:s");
	        $this->db->where('id',$row->row()->id)->update($this->table,$data);
	    } else {
	        $data['id'] = 0;
	        $data['created'] = date("Y-m-d H:i:s");
	        $this->db->insert($this->table,$data);
	    }
	    return $data['romaji'];
	}

	function check_exist($romaji,$id){

	    if( !is_numeric($id) ){
	        $id = 0;
	    }
	    $this->db->where('romaji',trim($romaji))
	    ->where('id <>',$id);
	    $result = $this->db->get($this->table);

	    return ( $result->num_rows() > 0) ? $result->row()->id : false;
	}
	/*
	 * using other module
	 */
	function romaji_check($romaji_str=NULL){
	    $romaji_str = strtolower($romaji_str);
	    $this->db->from($this->table);
        $this->db->where("LOWER(romaji)",$romaji_str);
        $word_check = $this->db->get();
        if( $word_check->num_rows() > 0 ){
            $id = $word_check->row()->id;
        } else {
            $data['romaji'] = $romaji_str;
            $data['alias'] = url_title($romaji_str,'-',true);
            $data['created'] = date("Y-m-d H:i:s");
            $this->db->insert($this->table,$data);
            
            $id = $this->db->insert_id();
        }
        return $id;
	}
	/*
	 * Json return for Datatable
	 */
	function items_json($fields=[]){
	    $this->db->select('id,romaji, kanji, hiragana, katakana, vietnamese, english, alias')->from($this->table);
	    $this->db->order_by('id DESC');

	    if ( strlen($this->search) > 0 ){
            $this->search = trim($this->search);
            $whereLike =     "LOWER(romaji) LIKE '%$this->search%' ESCAPE '!'";
            $whereLike.= " OR LOWER(kanji) LIKE '%$this->search%' ESCAPE '!'";
            $whereLike.= " OR LOWER(vietnamese) LIKE '%$this->search%' ESCAPE '!'";

            $this->db->where("($whereLike)");
        }

        $num_rows = $this->count_ajax();

        $query = $this->db->limit($this->limit, $this->offset)->get();
	    $items = [];
	    foreach ($query->result() AS $ite){
	        $ite->img = "";
	        $ite->word = $ite->hiragana;
	        if( strlen($ite->word) < 1 ){
	            $ite->word = $ite->kanji;
	        }
	        if( strlen($ite->word) < 1 ){
	            $ite->word = $ite->katakana;
	        }

	        $ite->translate = strlen($ite->vietnamese) > 0 ? $ite->vietnamese : $ite->english;
	        
	        $img_dir = realpath(config_item('word_img_dir'));
	        foreach ($this->img_dirs AS $dirName){
	            
	            $files = glob($img_dir."/$dirName/word/".$ite->romaji.".*");
	            if( !empty($files) ){
	                $img = reset($files);
	                $ite->img = img(str_replace($img_dir,config_item("word_img_url"), $img),false,'class="maxw_50"');
	            }
	            
	            if( strlen($ite->img) < 1 ){
	                $files = glob($img_dir."/$dirName/word/".$ite->alias.".*");
	                if( !empty($files) ){
	                    $img = reset($files);
	                    $ite->img = img(str_replace($img_dir,config_item("word_img_url"), $img),false,'class="maxw_50"');
	                }
	            }
	        }
	        $ite->actions = "";
	        $items[] = $ite;
	    }
        return jsonData(array('data' => $items, 'draw' => $this->draw, 'recordsTotal' => $num_rows, 'recordsFiltered' => $num_rows));

	}

	
	function items_search($key=""){
	    $this->db->from($this->table)->select("id, hiragana AS name");
	    $this->db->where("hiragana  LIKE '$key%' ESCAPE '!'");
	    $items = $this->db->get();
	    if( $items->num_rows() > 0 ){
	        return $items->result();
	    }
	    return array();
	}
	function item_search($where=[],$where_like=[]){
        $this->db->where($where);
        return $this->db->limit(1)->get($this->table)->row();
    }
}