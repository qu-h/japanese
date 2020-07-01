<?php
/**
 * Created by PhpStorm.
 * User: hongq
 * Date: 1/11/2019
 * Time: 3:53 AM
 */

class TopicFrontend extends JP_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        $items = $this->TopicModel->select("name, alias")
            ->where('status',1)
            ->get_array();

        $urlDetail = site_url('word/topic');
        set_layout("full-content");
        temp_view('Word/frontend/topics',compact('items','urlDetail'));
    }

    function detail($topicAlias){
        $blockLeft = [];
        $topic = $this->TopicModel->where('alias',$topicAlias)
            ->row_array();

        if( !empty($topic) ){
            $topics = $this->TopicModel->select("name, alias")
                ->not_like('alias',$topicAlias)
                ->order_by('name', 'RANDOM')
                ->limit(3)->get_array();
            $blockLeft = $this->otherLeftPage($topics);
        }
        temp_view('Word/frontend/topic-detail',compact('topic','blockLeft'));
    }

    private function otherLeftPage($topics){
        $urlDetail = site_url('word/topic');
        return temp_subview('Word/block/topics',compact('topics','urlDetail'));
    }
}