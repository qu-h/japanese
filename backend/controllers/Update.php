<?php
/**
 * Created by PhpStorm.
 * User: hongq
 * Date: 12/30/2018
 * Time: 3:36 AM
 */

class Update extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index(){
        modules::run('Backend/BackendUpdate/index');
    }
}