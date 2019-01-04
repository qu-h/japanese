<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        set_temp_val('uri_add',('menu/add'));
    }

    function index(){
        modules::run("SystemMenu/items");
    }

    public function add(){
        modules::run("SystemMenu/form");
    }

}