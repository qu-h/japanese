<?php

if (! defined('BASEPATH'))
    exit('No direct script core allowed');

class Vocabulary_Model extends CI_Model
{

    var $table = 'word';

    var $course_fields = array(
        'id' => array(
            'type' => 'hidden'
        ),
        'name' => array(
            'label' => 'Course Name',
            'desc' => null,
            'icon' => 'send'
        )
    )
    ;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function fields()
    {
        return $this->course_fields;
    }

    function get_item_by_id($id = 0)
    {
        return $this->db->where('id', $id)
            ->get($this->table)
            ->row();
    }

    function get_course_row($word=""){
        $query = $this->db->where("japanese LIKE '$word'")->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }

    function update_course(array $data)
    {
        if (empty($data) or ! isset($data['jp']) or empty($data['jp']))
            return FALSE;

        $words = array();

        foreach ($data['jp'] as $index=>$word) {
            $word = trim($word);
            if( strlen($word) < 1 )
                continue;
            $new_row = array(
                'id'=>0,
                'japanese' => $word,
                'romaji'=>$data['romaji'][$index],
                'english'=>$data['english'][$index],
                'kanji'=>$data['kanji'][$index],
//                 'man_speak'=>$data['mp3'][$index],
            );
            $query = $this->db->where("japanese LIKE '$word'")->get($this->table);

            if ($query->num_rows() > 0) {
                $row = $query->row();
                if( strlen($row->romaji) > 1 ){
                    $new_row['romaji'] = $row->romaji;
                }
                if( strlen($row->man_speak) > 1 ){
                    $new_row['man_speak'] = $row->man_speak;
                }
                $new_row['id'] = $row->id;

            }

            $this->update_row($new_row);
            $words[] = $word;
        }

        return $words;

    }

    function update_row(array $data){
        if( !empty($data) ){
            if( isset($data['id']) && $data['id'] > 0 ){
                $data['modified'] = date("Y-m-d H:i:s");
                $id = $data['id'];
                unset($data['id']);
                $this->db->where('id',$id)->update($this->table,$data);
            } else {
                $this->db->insert($this->table,$data);
                $id = $this->db->insert_id();
            }

            return $id;
        }
        return FALSE;
    }

    function check_exist($alias, $id, $category = 0)
    {
        if (! is_numeric($category)) {
            $category = 0;
        }
        if (! is_numeric($id)) {
            $id = 0;
        }
        $this->db->where('alias', $alias)
            ->where("category = $category")
            ->where('id <>', $id);
        $result = $this->db->get($this->table);
        // bug($this->db->last_query());
        return ($result->num_rows() > 0) ? true : false;
    }
}