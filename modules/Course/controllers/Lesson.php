<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lesson extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->module('layouts');
        $this->template->set_theme('nicdarkthemes_baby_kids')->set_layout('course');
        add_css('chating.css');
    }

    function index(){
		$data = array();
		temp_view('course/lesson_conversation',$data);
    }

    function item($alias=NULL){
    	$course = $this->Course_Model->get_item_by_alias($alias);
    	// bug($course); die;
    	$data = array('lesson'=>$course);
		temp_view('course/lesson_conversation',$data);
    }
}