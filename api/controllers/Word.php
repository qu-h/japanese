<?php

class Word extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("WordApiModel");

    }

    function index_get(){
        $romaji = input_get("r");

        $data = $this->WordApiModel->wordFindByRomaji($romaji);
        if( !empty($data) ){

        }
        $this->response([
            'status' => !empty($data),
            'data' => $data
        ], REST_Controller::HTTP_OK);
    }
}