<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("Api_Model");
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
}