<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        add_site_structure('video',lang("Admin Videos") );
        set_temp_val('uri_add',('video/add'));
    }

    function index(){
        modules::run('SystemVideo/items');
    }

    function add(){
        modules::run('SystemVideo/form');
    }
}