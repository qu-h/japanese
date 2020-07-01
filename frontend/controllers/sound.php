<?php
class Sound extends MX_Controller
{
    function __construct()
    {
    }

    function index(){

    }

    function syllabary($file){
        $dir = APPPATH."sound/syllabary";
        if( !file_exists("$dir/$file") ){
            $mp3_data = file_get_contents("https://www.nhk.or.jp/lesson/mp3/syllabary/$file");
            $fh = fopen("$dir/$file", "w") or die("Can't open file");
            fwrite($fh, $mp3_data);
            fclose($fh);

            redirect("/sound/syllabary/$file");
        }
    }
}