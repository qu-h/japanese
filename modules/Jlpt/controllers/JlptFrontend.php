<?php

class JlptFrontend extends JP_Controller
{
    private $coursePath;

    function __construct()
    {
        parent::__construct();
        $this->coursePath = env('MinaDirectory');

    }
    public function grammar($number=1){
        $filePath = realpath($this->coursePath."/$number/grammar.md");
        if( $filePath ){

        }
    }

    public function showMarkdown($lesson,$course ){
        /*
         * https://github.com/showdownjs/showdown
         */
    }
}