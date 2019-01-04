<?php
/**
 * Created by PhpStorm.
 * User: hongq
 * Date: 1/3/2019
 * Time: 2:35 AM
 */

class WordUpdate extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        self::Date20190103();
    }

    private function Date20190103(){
        if ( $this->db->field_exists('romaji', 'word'))
        {
//            $this->db->query("ALTER TABLE `word` CHANGE `romaji` `romaji` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL;");
        }
    }
}