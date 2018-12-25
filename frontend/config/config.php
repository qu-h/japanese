<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['url_suffix'] = '.html';
$config['index_page'] = '';
$config['theme_url'] = "//".$_SERVER['HTTP_HOST']."/themes/";
$config['theme_dir'] = APPPATH."themes/nicdarkthemes_baby_kids/";

$config['language']	= 'vietnamese';
$config['enable_hooks'] = TRUE;

$config['site'] = array(
        "phone"=>"098 998 2285",
        "email"=>"hongquan2712@gmail.com",
        "facebook_id"=>"hongquan2712"
);
$config['kanjiImagePath'] = "E:/quanict.github.io/imageResource/kanji/";
$config['kanjiImageUrl'] = "//github.giaiphapict.loc/imageResource/kanji/";

if( substr($_SERVER["REQUEST_URI"],0,5) === "/api/" ){
    $config['subclass_prefix'] = 'REST_';
} else {
    $config['subclass_prefix'] = 'JP_';
}

