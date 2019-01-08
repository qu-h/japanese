<?php
/*
 * http://preview.themeforest.net/item/kids-kindergarten-and-child-care-muse-templates/full_screen_preview/19284858?_ga=1.14775926.1577307158.1487318162
 * http://progressive.nikadevs.com/content/home-creative
 * http://2goodtheme.net/html/kidcenter/layout-animation/index-02.html
 * http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/color-section/
 */

class Pages extends JP_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('grammar');
        $this->template->set_theme('nicdarkthemes_baby_kids')->set_layout('baby_kids');
    }

    function home(){
        $data = array();
        temp_view('pages/home',$data);
    }

    function grammar(){
        $this->load->module('grammar');
        $alias= $this->uri->segment(2);
        $article = $this->Grammar_Model->get_item_by_alias($alias);

        $article->content = grammar_color($article->content);
        $this->template->set_layout('single');
        temp_view('modules/grammar',array('art'=>$article));
    }

    function articles(){
        temp_view('pages/learning/vocabulary');
    }


}