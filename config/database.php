<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$db['default'] = array(
    'hostname'=>'localhost',
    'database'=>'ict_japanese',
    'username'=>'root',
    'password'=>'q1',
    'dbdriver'=>'mysqli',
    'dbprefix'=>'',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'cache_on'=>false,
    'db_debug'=>true
);