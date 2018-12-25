<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Word extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->module('layouts');
        $this->template
            ->set_theme('nicdarkthemes_baby_kids')
            ->set_layout('baby_kids');
    }


    function index(){

    }

    function search(){

        $word = input_get('txt');
        $data = $this->extractData($word);
        if( isset($data["kanji"]) && strlen($data['kanji']) > 0 ){
//            $this->load->library('crawler/simple_html_dom');
//            $url = "https://j-dict.com/?keyword=".$data['kanji'];
//            $html = file_get_html($url);
//            $test = $html->find('#txtKanji .romaji',0)->plaintext;
//            bug($test);
            redirect("https://j-dict.com/?keyword=".$data['kanji']);
        }


//        bug($data);
        //bug($this);
        temp_view('front-end/form',["word"=>(object)$data]);
    }

    private function extractData($word){
        setlocale(LC_ALL, "ja_JP.utf8");
        $data = ['kanji'=>'','hiragana'=>''];
        $pattern_kanji = '/\p{Han}+/u';
        $pattern_hira = '/\p{Hiragana}+/u';

        //$pattern = '/([\p{Han}\p{Katakana}\p{Hiragana}]+)+([(])+([\p{Katakana}\p{Hiragana}])+([)])/u';



//        preg_match_all('/
//    ([\p{Han}\p{Katakana}\p{Hiragana}]+)    # Kanji
//    (?: [(]                                 # optional part: paren (
//    ([\p{Hiragana}]+)                       # Hiragana
//    [)] )?                                  # closing paren )
//    \s*=\s*                                 # spaces and =
//    ([\w\s;=]+)                             # English letters
//    /ux',
//            $word, $keywords, PREG_SET_ORDER
//        );

        preg_match($pattern_kanji, $word, $matches);
        if( isset($matches[0]) ){
            $data['kanji'] = $matches[0];
        }
        preg_match($pattern_hira, $word, $matches);
        if( isset($matches[0]) ){
            $data['hiragana'] = $matches[0];
            //$data['katakana'] =  mb_convert_kana($data['hiragana'], 'C', 'UTF-8');
        }

        return $data;
    }
}