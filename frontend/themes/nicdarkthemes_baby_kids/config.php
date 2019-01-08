<?php
/*
 * http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/
 */

//$config['theme_url'] = "//".$_SERVER['HTTP_HOST']."/themes/nicdarkthemes_baby_kids/";
$config['theme_url'] = env('ASSETS_GIT_PATH')."/sites-template/nicdarkthemes/baby_kids/";

$config['css'] = array(
    'http://fonts.googleapis.com/css?family=Great+Vibes&ver=4.1.1',
);
$config['css'][] = git_assets("bootstrap.css",'bootstrap','4.0.0');
$config['css'][] = git_assets("style.min.css",'sites-template/nicdarkthemes/baby_kids');


$config['js'] = array(
    //'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js',
);

// $config['js'][] = git_assets('tether.min.js','tether','1.3.3');
$config['js'][] = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js';
// $config['js'][] = git_assets('bootstrap.min.js','bootstrap','4.0.0-beta');
// $config['css'][] = assets('font-awesome.min.css','font-awesome');
// $config['js'][] = '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js';


$config['js'][] = git_assets("jquery-plugin.js",'sites-template/nicdarkthemes/baby_kids');
$config['js'][] = git_assets("baby_kids.js",'sites-template/nicdarkthemes/baby_kids');

