<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ArticleMarkdown
 * @property BaseArticle BaseArticle
 */
class ArticleMarkdown extends JPAdmin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->module('BaseArticle');
        add_site_structure('articlemarkdown',lang("Admin Article") );
        set_temp_val('uri_add',('articlemarkdown/add'));
        set_temp_val('uri_edit',('articlemarkdown/edit/%d'));

        $this->BaseArticle->model->fields['content']['editor'] = 'editor-md';
        $this->BaseArticle->model->fields['content']['id'] = 'editor-md';
    }

    function index(){
//        dd($this->BaseArticle);
//        modules::run('BaseArticle/items');
        $this->BaseArticle->items();
    }

    public function edit($id=0){
        modules::run('BaseArticle/form',$id);
    }

    public function add(){
        $this->BaseArticle->form();
//        modules::run('BaseArticle/form');
    }

    public function __call($method,$arguments) {
        $this->load->module('BaseArticle');
        dd($method);
    }
}