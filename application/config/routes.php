<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pages/home';
$route['kanji/(:any)'] = 'kanji/character/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;



