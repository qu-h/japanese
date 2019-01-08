<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Kanji extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Api_Model");
//        $this->load->helper('file');
    }

    public function char_get(){
        $char = input_get("txt");
        $id = $this->Kanji_Model->check_exist($char);
        $this->response([
            'status' => $id > 0,
        ], self::HTTP_OK);
    }

    public function char_post(){
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
dd($data);
        $id = $this->Kanji_Model->update($data);
        $this->response([
            'status' => $id > 0,
        ], self::HTTP_OK);
    }
}