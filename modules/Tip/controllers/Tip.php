<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tip extends JP_Controller {

    function __construct()
    {
        parent::__construct();

    }
    function items($alias){
        return $this->TipModel->get_items_by_alias($alias);
    }
}