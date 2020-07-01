<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends JPAdmin_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        redirect('article');
    }
}