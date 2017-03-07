<?php
class Svg extends MX_Controller
{
    function __construct()
    {
    }

    function index(){

    }

    function kanji($file=NULL){
        if( !file_exists(APPPATH."svg/kanji/$file") ){
            $svg_data = file_get_contents("http://kanjivg.tagaini.net/kanjivg/kanji/$file");
            $fh = fopen(APPPATH."svg/kanji/$file", "w") or die("Can't open file");
            fwrite($fh, $svg_data);
            fclose($fh);
            header("Refresh:0");
        }
        die('file existed');
    }
}