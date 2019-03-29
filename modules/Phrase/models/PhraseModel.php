<?php if ( ! defined('BASEPATH')) exit('No direct script core allowed');

class PhraseModel extends MX_Model
{
    var $table = 'phrase_japan';
    var $fields = [
        'id'=>['type'=>'hidden'],
        'phrase'=>['type'=>'text','placeholder'=>'Phrase'],
        'etymology'=>['type'=>'text','placeholder'=>'Etymology'],
        'hiragana'=>['type'=>'text','placeholder'=>'Hiragana'],
        'romaji'=>['type'=>'text','placeholder'=>'Rōmaji'],
    ];


    function __construct()
    {
        parent::__construct();
    }

}