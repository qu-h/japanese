<?php

class Syllabary extends MX_Controller
{
    function __construct()
    {
        $this->load->module('layouts');

        $this->template->set_theme('school')
        ->set_layout('kidcenter');
    }
    function index(){
        die('show index');
    }
    /*
     * https://www.nhk.or.jp/lesson/vietnamese/syllabary/index.html#tab
     * http://www.studyjapanese.net/p/kinh-nghiem.html
     */
    function hiragana()
    {
        $data = array();
        $this->template
        ->build('syllabary/hiragana',$data);
    }

    function draw($char = NULL){
        $this->template
        ->build('syllabary/draw',array('char'=>$char));
    }
}