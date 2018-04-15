
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kanji extends MY_Controller
{
    static $test = "abc";
    function __construct()
    {
        parent::__construct();

        //$this->load->library('layouts/template');

        //$this->template->add_theme_location(APPPATH.'/themes/');
        $this->template
            ->set_theme('nicdarkthemes_baby_kids')
            ->set_layout('baby_kids');
    }

    function index(){
        die("call me");
    }

    function character($ascii=null){
        $char = $this->Kanji_Model->item_get(['ascii'=>$ascii]);
//bug($char);die;
        temp_view('character',["kanji"=>$char]);

    }


}