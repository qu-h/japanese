<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vocabulary extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->module('layouts');
        $this->template->set_theme('nicdarkthemes_baby_kids')->set_layout('course');
        $this->load->model('Word/Word_Model');
    }

    function index(){
        
    }
    function word($romaji=NULL) {
        $data['word'] = $this->Word_Model->get_item_by_alias($romaji);

        add_module_asset("vocabulary.css","vocabulary");
        temp_view('word',$data);
    }
    
}