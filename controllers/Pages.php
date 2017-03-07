<?php
/*
 * http://preview.themeforest.net/item/kids-kindergarten-and-child-care-muse-templates/full_screen_preview/19284858?_ga=1.14775926.1577307158.1487318162
 * http://progressive.nikadevs.com/content/home-creative
 * http://2goodtheme.net/html/kidcenter/layout-animation/index-02.html
 */
class Pages extends MX_Controller
{
    function __construct()
    {
        $this->load->module('layouts');
        $this->template->set_theme('rometheme_kids')
        ->set_layout('rometheme');
    }

    function home(){
        $data = array();
        $this->template
        ->build('pages/home',$data);
    }
}