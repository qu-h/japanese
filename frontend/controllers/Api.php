<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("Api_Model");
//        $this->load->model("Kanji/Kanji_Model");
//        $this->load->model("Word/Word_Model");
        $this->load->helper('file');
    }

    function index_get(){
        die("get index");
    }

    public function word_get(){
        $romaji = input_get("r");

        $data = $this->Api_Model->wordFindByRomaji($romaji);
        if( !empty($data) ){

        }
        $this->response([
            'status' => !empty($data),
            'data' => $data
        ], REST_Controller::HTTP_OK);
    }

    public function kanjichar_get(){
        $char = input_get("txt");
        $id = $this->Kanji_Model->check_exist($char);
        $this->response([
            'status' => $id > 0,
        ], REST_Controller::HTTP_OK);
    }
    public function kanjichar_post(){

        $data = [
            'word' => "",
            'chinese'=>null,
            'vietnamese'=>null,
            'english'=>null,
            'type'=>null,
            'stroke'=>1,
            'explanation'=>"",
            'meaning'=>'',
            'level'=>null,
            'examples'=>[],
            'parts'=>[],
            'onyomi' => [],
            'kunyomi' => [],
            'remembering'=>[],
            'source'=>null
        ];
        foreach ($data AS $k=>$v){
            $data[$k] = input_post($k);
        }

        $data["explanation"] = strip_tags($data["explanation"]);
        $data["vietnamese"] = strip_tags($data["vietnamese"]);
        
        $id = $this->Kanji_Model->update($data);
        $this->response([
            'status' => $id > 0,
        ], REST_Controller::HTTP_OK);
    }

    public function kanjiword_post(){
        $data = [
            'kanji' => "",
            'romaji'=>null,
            'hiragana'=>null,
            'vietnamese'=>null,
            'type'=>null,
            'source'=>null,
        ];
        foreach ($data AS $k=>$v){
            $data[$k] = input_post($k);
        }
        $data['romaji'] = str_replace(['/'], '', $data['romaji']);
        if( is_array($data['vietnamese']) ){
            $data['vietnamese'] = implode('\n',$data['vietnamese']);
        }
        $id = $this->Word_Model->update($data,true);
        bug($data);
        bug($id);
    }
}