<?php

class AnalyzeSentenceModel extends MX_Model
{
    var $grammar_fields = array(
        'id' => array(
            'type' => 'hidden'
        ),
        'title' => array(
            'label' => 'Grammar Title',
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
        'grammar'=>array(
            'type' => 'textarea'
        ),
        'description'=>array(
            'type' => 'textarea'
        ),
        'using'=>array(
            'type' => 'textarea',
            'title'=>'how to use'
        ),
        'note'=>array(
            'type' => 'textarea'
        ),
        'example'=>array(
            'type' => 'textarea'
        ),
// 	    'content' => array(
// 	        'type' => 'textarea'
// 	    ),
    );

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function items_json($fields=[]){
        $this->db->from("sentence_analyze AS A")->select("A.id");
        $this->db->join('sentence AS S','S.id = A.sentence','LEFT')
            ->select('S.japanese AS sentence, S.vietnamese');

        $analyzes= $this->db->get()->result();
        dd($analyzes);
    }
}