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
        'meaning'=>[],
        'level'=>['type'=>'select'],
        'example'=>['type'=>'textarea','editor'=>''],
    );

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    var $levels = [
        5 =>"JLPT N5",
        4 =>"JLPT N4",
        3 =>"JLPT N3",
        2 =>"JLPT N2",
        1 =>"JLPT N1"
    ];
    function fields(){
        $fields = $this->tip_fields;

        $fields['level']['options'] = $this->levels;
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

    function item_get($where=[]){
        $item = $this->db->where($where)->get($this->table)->row();
        if ( !empty($item->parts) ){
            $item->parts = $this->getParts(json_decode($item->parts));
        }
        if ( !empty($item->onyomi) ){
            $item->onyomi = $this->getReading('on',json_decode($item->onyomi));
        }
        if ( !empty($item->kunyomi) ){
            $item->kunyomi = $this->getReading('kun',json_decode($item->kunyomi));
        }
        if ( !empty($item->example) ){
            $item->example = $this->getExample(json_decode($item->example));
        }
        return $item;
    }

    function update($data=NULL,$setNull=false){

        if( !isset($data['id']) || strlen($data['id']) < 1 ){
            $data['id'] = 0;
        }

        if( !isset($data['stroke']) || strlen($data['stroke']) < 1 ){
            $data['stroke'] = 0;
        }

        $kunyomi = $data["kunyomi"]; unset($data["kunyomi"]);
        $onyomi = $data["onyomi"]; unset($data["onyomi"]);
        $parts = $data["parts"]; unset($data["parts"]);
        $examples = $data['examples']; unset($data['examples']);
        $remembering = $data['remembering']; unset($data['remembering']);

        if( !$setNull ){
            foreach ($data AS $k=>$v){
                if( is_null($v)  ){
                    unset($data[$k]);
                }
            }
        }
        $data['ascii'] = unihex($data['word']);
        if( strlen($data['level']) > 0 ){
            $data['level'] = array_search($data['level'], $this->levels);
        }

        if( $idExist = $this->check_exist($data['word'],$data['id']) ){
            //set_error('Dupplicate Kanji Word');
            $id = $idExist;
        } elseif( intval($data['id']) > 0 ) {
            $data['modified'] = date("Y-m-d H:i:s");
            $id = $data['id']; unset($data['id']);
            $this->db->where('id',$id)->update($this->table,$data);
        } else {
            $this->db->insert($this->table,$data);
            $id = $this->db->insert_id();
        }

        if( is_array($kunyomi) && !empty($kunyomi) ){
            $kunyomi_ids=[];
            foreach ($kunyomi AS $val){
                $kunyomi_ids[] = $this->updateReading($val,"kun",$id);
            }
            $this->db->where('id',$id)->update($this->table,['kunyomi'=>json_encode($kunyomi_ids)]);
        }

        if( is_array($onyomi) && !empty($onyomi) ){
            $onyomiIDs=[];
            foreach ($onyomi AS $val){
                $onyomiIDs[] = $this->updateReading($val,"on",$id);
            }
            $this->db->where('id',$id)->update($this->table,['onyomi'=>json_encode($onyomiIDs)]);
        }

        if( is_array($parts) && !empty($parts) ){
            $partIDs=[];
            foreach ($parts AS $val){
                $part2IDs = [];
                if( is_array($val) && !empty($val) ) foreach ($val AS $val2){
                    $part2IDs[] = $this->updatePart($val2);
                }
                if( !empty($part2IDs) ){
                    $partIDs[] = $part2IDs;
                }

            }
            $this->db->where('id',$id)->update($this->table,['parts'=>json_encode($partIDs)]);
        }

        if( is_array($examples) && !empty($examples) ){
            $examplesIDs=[];
            foreach ($examples AS $val){
                if( is_array($val) && !empty($val) ){
                    $examplesIDs[] = $this->updateExamples($val[0],$this->table,$id);    
                }
            }
            $this->db->where('id',$id)->update($this->table,['example'=>json_encode($examplesIDs)]);
        }

        if( is_array($remembering) && !empty($remembering) ){
            foreach ($remembering AS $val){
                $this->updateRemembering($remembering,$id);
            }
        }

        return $id;
    }

    function check_exist($word,$id=0){
        if( !is_numeric($id) ){
            $id = 0;
        }
        $this->db->where('word',$word);
        if($id > 0 ){
            $this->db->where('id <>',$id);
        }
        $result = $this->db->get($this->table)->row();
        return ( !empty($result) ) ? $result->id : false;
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
            $ite->code = mb_convert_encoding($ite->word, "UTF-8", "Shift-JIS");
            $items[] = $ite;

        }

        return jsonData(array('data'=>$items));
    }

    /*
     * Kanji Reading
     * on/kun
     */
    private function updateReading($text,$type="kun",$kanji_id=0){
        $table = "kanji_reading";
        $data = ['text'=>$text,'type'=>$type];
        $word = $this->db->where($data)
            ->limit(1)->get($table)->row();
        if( !empty($word) ){
            $id = $word->id;
        } else {
            $data['kanji_id'] = $kanji_id;
            $this->db->insert($table,$data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    private function getReading($type="kun",$ids=[]){
        $parts = [];
        if( !empty($ids) ) {
            foreach ( $ids AS $k=>$id){
                if( is_array($id) ){
                    $parts[$k] = $this->getParts($type,$id);
                } else if ( is_numeric($id) ){
                    $part = $this->db->where(['id'=>$id,'type'=>$type])->limit(1)->get("kanji_reading")->row();
                    $parts[$k] = $part->text;
                }
            }
        }
        return $parts;
    }

    /*
     * Kanji parts
     */
    private function updatePart($char){
        $table = "kanji_part";
        $data = ['character'=>$char];
        $character = $this->db->where($data)
            ->limit(1)->get($table)->row();
        if( !empty($character) ){
            $id = $character->id;
        } else {
            $this->db->insert($table,$data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    private function getParts($ids=[]){
        $parts = [];
        if( !empty($ids) ) {
            foreach ( $ids AS $k=>$id){
                if( is_array($id) ){
                    $parts[$k] = $this->getParts($id);
                } else if ( is_numeric($id) ){
                    $part = $this->db->where('id',$id)->limit(1)->get("kanji_part")->row();
                    $parts[$k] = $part->character;
                }
            }
        }
        return $parts;
    }

    /*
     * Kanji Examples
     */
    private function updateExamples($text,$tableLink=null,$tableLinkId=0){
        $table = "example";
        $data = ['content'=>$text,'table_link'=>$tableLink,'table_link_id'=>$tableLinkId];
        $character = $this->db->where($data)
            ->limit(1)->get($table)->row();
        if( !empty($character) ){
            $id = $character->id;
        } else {
            $this->db->insert($table,$data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    private function getExample($ids=[]){
        $parts = [];
        if( !empty($ids) ) {
            foreach ( $ids AS $k=>$id){
                if( is_array($id) ){
                    $parts[$k] = $this->getExamples($id);
                } else if ( is_numeric($id) ){
                    $exm = $this->db->where([
                        'id'=>$id,
                    ])->limit(1)->get("example")->row();
                    $parts[$k] = $exm->content;
                }
            }
        }
        return $parts;
    }

    private function updateRemembering($data=[],$kanji_id=0){
        $table = "kanji_remembering";
        $id = 0;
        $tableFields = [
            'kanji_id'=>$kanji_id,
            'image'=>'',
            'text'=>'',
        ];
        $tableFields = array_merge($tableFields,$data);
        $url=getimagesize($tableFields['image']);
        if( is_array($url) ){
            if( strlen($tableFields['image']) > 0){
                $filename = pathinfo($tableFields['image'],PATHINFO_BASENAME);

                copy($tableFields['image'], $this->config->item('kanjiImagePath')."/$filename");
                $tableFields['image'] = $filename;
            }

            $remembering = $this->db->where($tableFields)
                ->limit(1)->get($table)->row();
            if( !empty($remembering) ){
                $id = $remembering->id;
            } else {
                $this->db->insert($table,$tableFields);
                $id = $this->db->insert_id();
            }
        }

        return $id;
        
    }
}