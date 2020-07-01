<?php
/*
 * http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/
 */

//$config['theme_url'] = "//".$_SERVER['HTTP_HOST']."/themes/nicdarkthemes_baby_kids/";
$config['theme_url'] = env('ASSETS_GIT_PATH')."sites-template/nicdarkthemes/baby_kids/";

$config['css'] = array(
    'http://fonts.googleapis.com/css?family=Great+Vibes&ver=4.1.1',
);
$config['css'][] = git_assets("bootstrap.css",'bootstrap','4.0.0');
$config['css'][] = git_assets("style.min.css",'sites-template/nicdarkthemes/baby_kids');

$config['js'] = [];
$config['js'][] = git_assets("jquery-plugin.js",'sites-template/nicdarkthemes/baby_kids');
$config['js'][] = git_assets("baby_kids.js",'sites-template/nicdarkthemes/baby_kids');

