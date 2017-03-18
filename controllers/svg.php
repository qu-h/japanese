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
            //header("Refresh:0");

            header('Content-type: image/svg+xml');
            echo $svg_data;
        }
    }

    function hiragana($file=NULL){
        if( !file_exists(APPPATH."svg/hiragana/$file") ){
            $svg_data = file_get_contents("http://learn.akira.edu.vn/libs/dmak/svg/$file");
            $fh = fopen(APPPATH."svg/hiragana/$file", "w") or die("Can't open file");
            fwrite($fh, $svg_data);
            fclose($fh);

            //header('Content-type: image/svg+xml');
            header("Location: /svg/hiragana/$file"); /* Redirect browser */
            exit();
            //header("Refresh:0");
        }
    }
}