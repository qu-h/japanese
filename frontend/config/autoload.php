<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['language'] = array();
$autoload['model'] = ['SystemCategory/SystemCategoryModel'];

$autoload['helper'] = array(
    'html','file','ascii',

//    'layouts/messages',
//    'layouts/assets',
//    'layouts/ci_smarty_function',
    //'layouts/template',
);
$autoload['language'] = array("site",'format');
//$autoload['libraries'] = array('layouts/Smarty','layouts/Template');

//$autoload['config'] = array('characters');
