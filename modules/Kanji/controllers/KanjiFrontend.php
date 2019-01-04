<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kanji extends JP_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->module("word");
        $this->template
            ->set_theme('nicdarkthemes_baby_kids')
            ->set_layout('baby_kids');
    }

    function index(){
        $page = input_get('p',1);
        $data = [
            'items'=>$this->Kanji_Model->items_get($page)
        ];
        temp_view('index',$data);
    }

    function character($ascii=null){
        $char = $this->Kanji_Model->item_get(['ascii'=>$ascii]);

        //https://github.com/KanjiVG/kanjivg
        //http://kanjivg.tagaini.net
        //https://github.com/mbilbille/dmak
        add_js(git_assets('raphael-min.js','raphael',"2.0.2",null,false));
        add_js(git_assets('kanjiviewer.js','svg',null,null,false));
        add_module_asset("kanji.js",'kanji');
//bug($char,'test');
        temp_view('character',["kanji"=>$char]);
    }
}