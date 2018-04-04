<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("Api_Model");
        $this->load->model("Kanji/Kanji_Model");
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
    public function kanjiword_post(){

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
}