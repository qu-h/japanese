
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kanji extends MY_Controller
{
    static $test = "abc";
    function __construct()
    {
        parent::__construct();
        $this->template
            ->set_theme('nicdarkthemes_baby_kids')
            ->set_layout('baby_kids');
    }

    function index(){
        $page = 1;
        $data = [
            'items'=>$this->Kanji_Model->items_get($page)
        ];
//        g($data);die;
        temp_view('index',$data);
    }

    function character($ascii=null){
        $char = $this->Kanji_Model->item_get(['ascii'=>$ascii]);
//bug($char);die;
        //https://github.com/KanjiVG/kanjivg
        //http://kanjivg.tagaini.net
        add_js(git_assets('raphael-min.js','raphael',"2.0.2",null,false));
        add_js(git_assets('kanjiviewer.js','svg',null,null,false));
        add_module_asset("kanji.js",'kanji');

        temp_view('character',["kanji"=>$char]);
    }
}