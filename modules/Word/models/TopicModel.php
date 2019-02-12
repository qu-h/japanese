<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class TopicModel extends MX_Model
{
    var $table = 'word_topic';

    var $topic_fields = [
        'id' => array(
            'type' => 'hidden'
        ),
        'name' => [

        ],
        'alias' => array(
            'label' => 'Alias',
            'desc' => null,
            'icon' => 'link'
        ),
        'words' => ['type'=>'words'],
        'source' => ['icon'=>"glyphicon-link"],

    ];

    function __construct()
    {
        parent::__construct();

    }

    function fields()
    {
        return $this->topic_fields;
    }

    function update($data=NULL){
        if( strlen($data['name']) < 1 ){
            set_error('Please enter topic name');
            return false;
        }
        if( !isset($data['alias']) OR  strlen($data['alias']) < 1 ){
            if( strlen($data['name']) > 0 ){
                $data['alias'] = url_title($data['name'],'-',true);
            } else {
                set_error('Please enter alias');
                return false;
            }
        }

        $words = $data["words"]; unset($data['words']);

        $data['words'] = serialize($this->updateWords($words));

        if( !isset($data['id']) || strlen($data['id']) < 1 ){
            $data['id'] = 0;
        }

        if( $id_exist = $this->check_exist($data['alias'],$data['id']) ){
            set_error('Dupplicate Topic, are you want '.anchor("admin/word/edit/$id_exist","edit")." ?");
            return false;
        } elseif( intval($data['id']) > 0 ) {
            $data['modified'] = date("Y-m-d H:i:s");
            $id = $data['id'];
            unset($data['id']);
            $this->db->where('id',$id)->update($this->table,$data);
        } else {
            $this->db->insert($this->table,$data);
            $id = $this->db->insert_id();
        }

        set_success('Success save Topic [<strong>'.$data['name'].'</strong>]');
        return $id;
    }

    function check_exist($alias,$id){
        if( !is_numeric($id) ){
            $id = 0;
        }
        $this->db->where('alias',trim($alias))
            ->where('id <>',$id);
        $result = $this->db->get($this->table);
        return ( $result->num_rows() > 0) ? $result->row()->id : false;
    }

    function get_item_by_id($id=0){
        return $this->db->where('id',$id)->get($this->table)->row();
    }

    private function updateWords($words=[]){
        $ids = [];
        asort($words['order']);
        if( array_key_exists('order',$words) ) foreach ($words['order'] AS $k=>$txt){

            if( strlen($words['romaji'][$k]) > 0 && strlen($words['kanji'][$k]) > 0
                && ( strlen($words['vn'][$k]) > 0 || strlen($words['en'][$k]) > 0 )
            ){
                $wordData = [
                    'id' => $words['id'][$k],
                    'romaji' => $words['romaji'][$k],
                    'kanji' => $words['kanji'][$k],
                    'vietnamese' => $words['vn'][$k],
                    'english' => $words['en'][$k],
                ];

                $ids[] = $this->WordModel->update($wordData,true);
                $ids = array_filter($ids);
            }
        }

        return $ids;
    }


    function items_json(){
        $this->db->select('*')->from($this->table);
        $this->db->order_by('id DESC');

        $db = $this->db;
        $tempdb = clone $db;
        $num_rows = $tempdb->count_all_results();

        $query = $this->db->limit($this->limit, $this->offset)->get();
        $items = [];

        foreach ($query->result() AS $ite){
            $words = unserialize($ite->words);
            $ite->total = count($words);
            $ite->actions = "";
            $items[] = $ite;
        }
        return jsonData(array('data' => $items, 'draw' => $this->draw, 'recordsTotal' => $num_rows, 'recordsFiltered' => $num_rows));

    }

    function row(){
        $row = parent::row();
        if( !empty($row) ){
            $wordIds = unserialize($row->words);
            $row->words = $this->WordModel->where_in('id',$wordIds)->get();
        }
        return $row;
    }

    function row_array(){
        $row = parent::row_array();
        if( !empty($row) ){
            $wordIds = unserialize($row['words']);
            $row['words'] = $this->WordModel->where_in('id',$wordIds)->get_array();
        }
        return $row;
    }
}