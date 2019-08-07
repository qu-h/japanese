<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends JPAdmin_Controller
{
    function __construct()
    {
        parent::__construct();

        add_site_structure('article',lang("Admin Article") );

        set_temp_val('uri_add',('article/add'));
//        set_temp_val('uri_edit',('articleM/edit'));
    }

    function index(){
        modules::run('BaseArticle/items');
    }

    public function edit($id=0){
        modules::run('BaseArticle/form',$id);
    }

    public function add(){
        modules::run('BaseArticle/form');
    }

    public function __call($method,$arguments) {
        $this->load->module('BaseArticle');
        dd($method);
    }
}