<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends JPAdmin_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function login(){
        modules::run("SystemUser/Login","article");
    }

    function logout()
    {
        modules::run("SystemUser/logout");
        redirect('login', 'location');
    }

}