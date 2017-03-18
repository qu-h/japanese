<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tip extends MX_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function items($alias){
        return $this->Tip_Model->get_items_by_alias($alias);
    }
}