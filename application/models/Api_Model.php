<?php
class Api_Model extends CI_Model {
    var $wordTable = 'word';
    function wordFindByRomaji($romaji){
        $romaji_str = strtolower($romaji);
        $this->db->select("id, type, kanji, romaji, vietnamese, english");
        $this->db->from($this->wordTable);
        $this->db->where("LOWER(romaji)",$romaji_str);
        return $this->db->get()->row();
    }

    function updateKanji($data,$setNull=true){

        //$kanji_id = $this->

    }
}