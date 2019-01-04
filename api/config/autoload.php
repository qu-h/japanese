<?php defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['model'] = ["Kanji_Model"];
$autoload['packages'] =
    [
        APPPATH."../backend/",
        APPPATH."../frontend/"
    ];
$autoload['helper'] = ['ascii_helper'];
