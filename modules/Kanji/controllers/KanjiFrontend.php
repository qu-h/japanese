<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kanji extends JP_Controller
{
    private $levels = [
        0=>'Any',
        5=>'JLPT N5',
        4=>'JLPT N4',
        3=>'JLPT N3',
        2=>'JLPT N2',
        1=>'JLPT N1'
    ];
    function __construct()
    {
        parent::__construct();

    }



    function index(){
        $page = input_get('p',1);
        $level = input_get('level',5);
        $items = $this->KanjiModel->where('level',$level)->pagination_get($page);

        set_layout('full-content');
        $levels = $this->levels;
        temp_view('index',compact('items','levels'));
    }

    function character($ascii=null){
        $kanji = $this->KanjiModel->item_get(['ascii'=>$ascii]);

//        add_js(git_assets('raphael-min.js','raphael',"2.0.2",null,false));
//        add_js(git_assets('kanjiviewer.js','svg',null,null,false));
        //        add_module_asset("kanji.js",'kanji');

        $svnPath = env('ASSETS_GIT_PATH').'svg/kanji/';
        add_git_assets("kanji.min.js",'sites-template/nicdarkthemes/baby_kids');

        set_layout('full-content');
        temp_view('character',compact('kanji','svnPath'));
    }
}