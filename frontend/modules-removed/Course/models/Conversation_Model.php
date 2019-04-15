<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class Conversation_Model extends CI_Model {
    var $table = 'course';
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function update_course($items,$course_id=0){

    }
}