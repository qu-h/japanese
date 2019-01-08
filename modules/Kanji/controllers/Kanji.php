<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kanji extends JP_Controller
{
    function __construct()
    {
        parent::__construct();

     }

    function index(){
        $page = input_get('p',1);
        $level = input_get('level',5);
        $items = $this->KanjiModel->where('level',$level)->pagination_get($page);

        set_layout('full-content');
        temp_view('index',compact('items'));
    }

    function character($ascii=null){
        $char = $this->KanjiModel->item_get(['ascii'=>$ascii]);

        //https://github.com/KanjiVG/kanjivg
        //http://kanjivg.tagaini.net
        //https://github.com/mbilbille/dmak
        add_js(git_assets('raphael-min.js','raphael',"2.0.2",null,false));
        add_js(git_assets('kanjiviewer.js','svg',null,null,false));
        add_module_asset("kanji.js",'kanji');

        temp_view('character',["kanji"=>$char]);
    }
}