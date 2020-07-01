<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if( !class_exists("REST_Controller") ){
    require_once APPPATH.DS."modules/Api/libraries/REST_Controller.php";
}
class Character extends \Restserver\Libraries\REST_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->db = get_instance()->db;
    }
    
    public function index_get()
    {
        $type = $this->get('type');
        $romaji = $this->get('romaji');
        $row = $this->Character_Model->get_row($type,$romaji);
        if( strlen($row['code']) < 1){
            $row['code'] = $row['romaji'];
        }
        // Display all books
        $this->response($row);
    }
    
    public function index_post()
    {
        // Create a new book
    }
}