<?php
class News extends MX_Controller
{
    function __construct()
    {
        
        $this->load->module('Backend/article');
        $this->template->set_theme('nicdarkthemes_baby_kids')->set_layout('baby_kids');
        $this->Article_Model->page_limit = 5;
        
    }

    function index(){
        $data = array(
            "items"=>$this->Article_Model->get_items_latest()
            );
        //bug($data);die;
        temp_view('pages/articles',$data);
    }


}