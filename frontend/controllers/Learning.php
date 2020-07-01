<?php
class Learning extends MX_Controller
{
    function __construct()
    {
        $this->load->module('layouts');
        $this->template->set_theme('nicdarkthemes_baby_kids')->set_layout('baby_kids');
        $this->load->module("Study");
    }
    
    public function vocabulary(){
        $data = array(
                'words'=>$this->Study_Model->get_words()
        );
        add_root_asset("wanakana/wanakana.min.js");
        add_module_asset("inputs.js","word");
        temp_view('pages/learning/vocabulary',$data);
    }
}
