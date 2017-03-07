<?php
class Admin extends MX_Controller {

    function __construct(){
        parent::__construct();

    }

    function index(){
        $this->load->module('backend/user');
        $this->user->login();
    }

    function home(){
        $this->smarty->view('pages/home');
    }

    function article($action=NULL,$id=0){
        $this->load->module('backend/article');
        if( strlen($action) > 0 ){
            if( method_exists($this->article, $action) ){
                return $this->article->$action();
            } elseif( $action=='add' ){
                return $this->article->form();
            } elseif( $action=='edit' ){
                return $this->article->form($id);
            } else {
                show_404();
            }
        } else {
            return  $this->article->items();
        }
    }

    function course(){

    }

    function category($action=NULL){
        $this->load->module('backend/category');
        if( strlen($action) > 0 ){
            switch ($action){
                case 'add':
                    $this->category->form();
                    break;
                default: show_404();
            }
        } else {
            $this->category->items();
        }
    }

    function product($action=NULL){
        $this->load->module('backend/product');
        if( strlen($action) > 0 ){
            switch ($action){
                case 'add':
                    $this->product->form();
                    break;
                default: show_404();
            }
        } else {
            $this->product->items();
        }
    }


}