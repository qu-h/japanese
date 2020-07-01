<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class CourseVocabulary_Model extends CI_Model {
    var $table = 'course_vocabulary';
    var $word_tbl = NULL;
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    var $table_fields = array(
            'id' => array( 'type' => 'hidden' ),
            'course' => array( 'type' => 'hidden'),
            'word' => array(
                'type' => 'japan_text'
            ),
            'answer' => array(
                'type' => 'japan_text_answer',
                'icon' => 'link'
            ),
    );
    
    function fields(){
        return $this->table_fields;
    }
    
    function get_item_by_id($id=0){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    
    function update($data){
        if( empty($data) ){
            return false;
        }
        if( !isset($data['id']) ){
            $data['id'] = 0;
        }
        if( !array_key_exists("word", $data) ){
            return false;
        }
        $word = $data['word'];
        $data['word'] = $this->Word_Model->update_by_romaji($word);
        
        $answers = $data["answer"];
        $data["answer"] = NULL;
        if( array_key_exists('romaji', $answers) && !empty($answers['romaji']) ){
            foreach ($answers['romaji'] AS $index=>$romaji){
                if( strlen($romaji) < 1 ){
                    continue;
                }
                $word = array(
                    'romaji'=>$romaji,
                    'hiragana'=>$answers["hiragana"][$index],
                    'katakana'=>$answers["katakana"][$index],
                    'kanji'=>$answers["kanji"][$index],
                );
                if( strlen($word['hiragana']) < 1 ){
                    unset($word['hiragana']);
                }
                if( strlen($word['romaji']) > 1 ){
                    $data["answer"][] = $this->Word_Model->update_by_romaji($word);
                }
            }
        }
        if( !empty($data["answer"]) ){
            $data["answer"] = serialize($data["answer"]);
        }
        
        if( $data['id'] > 0 ){
            $this->db->where(array('id'=>$data['id']));
            $this->db->update($this->table,$data);
            $id = $data['id'];
        } else {
            
            $this->db->insert($this->table,$data);
            $id = $this->db->insert_id();
        }

        return $id;
    }
    
    function update_from_course($course_id=0,$data=NULL){
        if( isset($data['answer']) && is_array($data['answer']) ){
            $answers = $data['answer'];
            $data['answer'] =  NULL;
            if( !empty($answers) ){
                
                mb_internal_encoding('utf-8');
                $data['answer'] =  serialize($answers);
                if( strlen($this->word_tbl) > 0 ){
                    $answer_vocabulary = array();
                    foreach ($answers AS $ans){
                        $answer_vocabulary[] = $this->Word_Model->romaji_check($ans);
                    }
                    $data['answer_vocabulary'] = serialize($answer_vocabulary);
                }
            }
        }
        $data['word'] = strtolower($data['word']);
        $where_check = array("course"=>$course_id,'word'=>$data['word']);
        $row = $this->db->where($where_check)->get($this->table);
        if( $row->num_rows() > 0 ){
            $this->db->where($where_check)->update($this->table,$data);
            $id = $row->row()->id;
        } else {
            $data["course"] = $course_id;
            $this->db->insert($this->table,$data);
            $id = $this->db->insert_id();
        }
        return $id;
    }
    
    function count_for_course($course_id){
        $items = $this->db->where("course",$course_id)->get($this->table);
        return $items->num_rows();
    }
    
    /*
     * Json return for Datatable
     */
    function items_json($actions_allow=NULL,$course_id=0){
        $this->db->select('*')->where("course",$course_id);
        $this->db->order_by('id DESC');
        $query = $this->db->get($this->table);
        $items = array();
        foreach ($query->result() AS $ite){
            $ite->actions = "";
            $ite->answers = "";
            
            if( strlen($ite->answer) > 1 ){
                $answers = unserialize($ite->answer);
                $ite->answers = implode(",", $answers);
            }
            
            $ite->write = "";
            
            $word = $this->Word_Model->get_item_by_romaji($ite->word);
            if( is_object($word) ){
                $ite->write = $word->hiragana;
            }
            
            $items[] = $ite;
        }
        return jsonData(array('data'=>$items));
    }
}