<?php
/**
 * Created by PhpStorm.
 * User: hongq
 * Date: 1/17/2019
 * Time: 2:30 AM
 */

class WordApiModel extends CI_Model
{
    var $wordTable = 'word';

    function __construct(){
        parent::__construct();
//        $this->load->database();
    }

    public function wordFindByRomaji($romaji=''){
        $romaji = strtolower($romaji);
        $this->db->select("id, type, kanji, romaji, vietnamese, english");
        $this->db->from($this->wordTable);
        $this->db->where("LOWER(romaji)",$romaji);
        return $this->db->get()->row();
    }
}