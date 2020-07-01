<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
if( !defined('CORE_MODULE_PATH') ){
    define('CORE_MODULE_PATH',  BASEPATH."/../application/third_party/MX/");
}
require CORE_MODULE_PATH."Router.php";

class JP_Router extends MX_Router {}