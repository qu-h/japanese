<?php defined('BASEPATH') OR exit('No direct script access allowed');

 $hook['post_controller_constructor'][] = array(
     'class'    => 'ModuleHook',
     'function' => 'loadModule',
     'filename' => 'module_hook.php',
     'filepath' => 'config',
     //'params'   => array('beer', 'wine', 'snacks')
 );