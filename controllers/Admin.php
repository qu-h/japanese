<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    function __construct(){
        parent::__construct();


        
        $this->load->module('layouts');
        $this->template->set_theme('smartadmin')->set_layout('main');
        add_site_structure('admin',lang("Admin area") );

        $this->checkLogin();
        modules::run('user/checkLogin',["admin/"]);
        set_temp_val("SignOutLink","/admin/logout");
    }

    private function checkLogin(){
        if ( !$this->session->userdata('user_id') ) {
            /*
             * check url for json/request
             */
            if ($this->uri->segment(2) != 'login') {
                redirect('admin/login/' . base64url_encode($this->uri->uri_string()), 'location');
            }
        }
    }

    function index(){

        if ( $this->session->userdata('user_id') ) {
            redirect('admin/article', 'location');
        }
        $this->login();
    }

    function login()
    {
        modules::run("User/login",'admin/article');
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

    /*
     * run Module Word
     */
    function word($action=NULL,$id=0){
        if ( $action =='topic' ){
            $action = $this->uri->segment(4);
            $id = $this->uri->segment(5);
            $this->wordTopic($action,$id);
        } else {
            $this->wordMain($action,$id);
        }
    }
    private function wordMain($action=NULL,$id=0){
        set_temp_val('uri_add',('admin/word/add'));

        switch ($action){
            case 'add':
            case 'edit':
                Modules::run("word/form",$id);
                break;
            default:
                Modules::run("word/items");
                break;
        }
    }
    private function wordTopic($action=NULL,$id=0){
        $this->load->module('word/topic');
        set_temp_val('uri_add',('admin/word/topic/add'));
        switch ($action){
            case 'add':
            case 'edit':
                Modules::run("word/topic/form",$id);
                break;
            default:
                Modules::run("word/topic/items");
                break;
        }
//        if( strlen($action) > 0 ){
//            if( method_exists($this->topic, $action) ){
//                $this->topic->$action();
//            } elseif( $action=='add' || $action =='edit' ){
//                $this->topic->form($id);
//            } else {
//                show_404();
//            }
//        } else {
//            $this->topic->items();
//        }
    }

    function learning($action=NULL,$id=0){
        $this->load->module('Learning');
        if( strlen($action) < 1 ){
            $action = "items";
        }
        if( strlen($action) > 0 ){
            if( method_exists($this->learning, $action) ){
                $this->learning->$action();
            } elseif( $action=='add' ){
                $this->learning->form();
            } elseif( $action=='edit' ){
                $this->learning->form($id);
            } else {
                show_404();
            }
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

    function tip($action=NULL){
        add_site_structure('tip',lang("Admin Tip") );
        set_temp_val('uri_add',('admin/tip/add'));
        $this->load->module('Tip');
        if( strlen($action) > 0 ){
            switch ($action){
                case 'add':
                    $this->tip->form();
                    break;
                default: show_404();
            }
        } else {
            $this->tip->items();
        }
    }

    function kanji($action=NULL,$id=0){
        add_site_structure('kanji',lang("Admin Kanji") );
        set_temp_val('uri_add',('admin/kanji/add'));
        $this->load->module('Kanji/KanjiAdmin');
        if( strlen($action) > 0 ){
            switch ($action){
                case 'add':
                    $this->kanjiadmin->form();
                    break;
                case 'edit':
                    $this->kanjiadmin->form($id);
                    break;
                default: show_404();
            }
        } else {
            $this->kanjiadmin->items();
        }
    }

}