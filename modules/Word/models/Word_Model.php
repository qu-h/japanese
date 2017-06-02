<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Word_Model extends CI_Model {
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
                'icon' => 'send'
        ),
        'hiragana'=>'',
        'katakana'=>'',
	        'vietnamese'=>'',
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

	function update($data=NULL){

	    $data['romaji'] = trim($data['romaji']);
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
	    
	    if( !isset($data['id']) ){
	        $data['id'] = 0;
	    }

	    if( $id_exist = $this->check_exist($data['romaji'],$data['id']) ){
	        set_error('Dupplicate Word, are you want '.anchor("admin/word/edit/$id_exist","edit")." ?");
	        return false;
	    } elseif( intval($data['id']) > 0 ) {
	        $data['modified'] = date("Y-m-d H:i:s");
	        $id = $data['id'];
	        unset($data['id']);
	        
	        $this->db->where('id',$id)->update($this->table,$data);

	        return $id;
	    } else {
	        $data['created'] = date("Y-m-d H:i:s");
	        $this->db->insert($this->table,$data);

	        return $this->db->insert_id();
	    }
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
	 * Json return for Datatable
	 */
	function items_json($actions_allow=NULL){
	    $this->db->select('id,romaji, kanji, hiragana, katakana, vietnamese, alias');
	    $this->db->order_by('id DESC');
	    $query = $this->db->get($this->table);
	    $items = array();
	    foreach ($query->result() AS $ite){
	        $ite->img = "";
	        $ite->word = $ite->hiragana;
	        if( strlen($ite->word) < 1 ){
	            $ite->word = $ite->kanji;
	        }
	        if( strlen($ite->word) < 1 ){
	            $ite->word = $ite->katakana;
	        }
	        
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
	    return jsonData(array('data'=>$items));
	}
}