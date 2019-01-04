<?php defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['model'] = ["Kanji_Model",'SystemCategory/SystemCategoryModel'];
$autoload['packages'] = [
    ROOT_PATH."backend",
    ROOT_PATH."frontend"
];
$autoload['helper'] = ['ascii_helper','file'];
