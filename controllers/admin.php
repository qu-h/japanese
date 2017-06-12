<?php
class Admin extends MX_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->module('layouts');
        $this->template->set_theme('smartadmin')->set_layout('main');
        $this->load->helper('Backend/datatables');
        //add_js(array('japanese.js','nicdarkthemes_baby_kids'));
    }

    function index(){
        $this->load->module('backend/user');
        $this->user->login();
    }

    function home(){
        $this->smarty->view('pages/home');
    }

    function article($action=NULL,$id=0){
        $this->load->module('Backend/article');
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

    function course($action=NULL,$id=0){
        $this->load->module('Course');
        if( strlen($action) < 1 ){
            $action = "items";
        }
        if( strlen($action) > 0 ){
            if( method_exists($this->course, $action) ){
                $this->course->$action();
            } elseif( $action=='add' ){
                $this->course->form();
            } elseif( $action=='edit' ){
                $this->course->form($id);
            } else {
                show_404();
            }
        }
    }

    function grammar($action=NULL,$id=0){
        $this->load->module('grammar');
        if( strlen($action) > 0 ){
            if( method_exists($this->grammar, $action) ){
                $this->grammar->$action();
            } elseif( $action=='add' ){
                $this->grammar->form();
            } elseif( $action=='edit' ){
                $this->grammar->form($id);
            } else {
                show_404();
            }
        } else {
            $this->grammar->items();
        }
    }
    function word($action=NULL,$id=0){
        $this->load->module('word');
        if( strlen($action) > 0 ){
            if( method_exists($this->word, $action) ){
                $this->word->$action();
            } elseif( $action=='add' ){
                $this->word->form();
            } elseif( $action=='edit' ){
                $this->word->form($id);
            } else {
                show_404();
            }
        } else {
            $this->word->items();
        }
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



}