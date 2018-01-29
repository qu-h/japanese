<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Kanji_Model extends CI_Model
{
    var $table = 'kanji';

    var $tip_fields = array(
        'id' => array(
            'type' => 'hidden'
        ),
        'word' => array(
            'label' => 'Kanji Word',
            'desc' => null,
            'icon' => 'send'
        ),
        'romaji'=>[],
        'chinese'=>['label'=>"Han Viet"],
        'vietnamese'=>['icon'=>'font'],
        'english'=>['label'=>"Meaning",'icon'=>'font'],
        'type'=>['type'=>'select'],
        'stroke'=>['type'=>"number"],
        'onyomi' => [ 'label' => 'Onyomi', 'icon' => 'link' ],
        'kunyomi' => [ 'label' => 'Kunyomi', 'icon' => 'link' ],
        'explanation'=>['type'=>'textarea','editor'=>''],
        'level'=>['type'=>'select'],
        'example'=>['type'=>'textarea','editor'=>''],

    );

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function fields(){
        $fields = $this->tip_fields;

        $fields['level']['options'] = [
            5 =>"JLPT N5",
            4 =>"JLPT N4",
            3 =>"JLPT N3",
            2 =>"JLPT N2",
            1 =>"JLPT N1",
        ];
        $fields['level']['value'] = 5;
        $fields['type']['options'] = [
            "noun"=>lang("noun"),
            'adjective'=>lang("adjective"),
        ];
        return $fields;
    }
    function get_item_by_id($id=0){
        return $this->db->where('id',$id)->get($this->table)->row();
    }

    function update($data=NULL){
//        if( !isset($data['alias']) OR  strlen($data['alias']) < 1 ){
//            if( strlen($data['name']) > 0 ){
//                $data['alias'] = url_title($data['name'],'-',true);
//            } else {
//                set_error('Please enter alias');
//                return false;
//            }
//
//        }
        if( !isset($data['id']) || strlen($data['id']) < 1 ){
            $data['id'] = 0;
        }

        if( !isset($data['stroke']) || strlen($data['stroke']) < 1 ){
            $data['stroke'] = null;
        }

        if( $this->check_exist($data['romaji'],$data['id']) ){
            set_error('Dupplicate Kanji Word');
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

    function check_exist($romaji,$id){
        if( !is_numeric($id) ){
            $id = 0;
        }
        $this->db->where('romaji',$romaji)->where('id <>',$id);
        $result = $this->db->get($this->table);
        return ( $result->num_rows() > 0) ? true : false;
    }


    function items_json($fields=[], $actions_allow=NULL){
        $this->db->from($this->table." AS k")
            ->select('k.*');

        $query = $this->db->get();
        $items = array();
        if( !$query ){
            bug($this->db->last_query());die("error");
        }
        foreach ($query->result() AS $ite){
            $ite->level = ($ite->level > 0) ? "JLPT N".$ite->level : null;
            $items[] = $ite;
        }
        return jsonData(array('data'=>$items));
    }
}