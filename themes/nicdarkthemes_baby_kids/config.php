<?php
/*
 * http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/
 */
// $config['assets_url'] = "//".$_SERVER['HTTP_HOST']."/themes";
// $config['assets_dir'] = APPPATH."/themes/nicdarkthemes_baby_kids/";

$config['theme_url'] = "//".$_SERVER['HTTP_HOST']."/themes/nicdarkthemes_baby_kids/";

$config['css'] = array(
//     'http://fonts.googleapis.com/css?family=Montserrat%7CRaleway%7CMontez',
    'char.css','grammar.css'


);
$config['css'][] = git_assets("bootstrap.css",'bootstrap','4.0.0-beta');
//"{root_assets}/bootstrap/css/bootstrap.css";

$config['css'][] = 'nicdark_style.css';
$config['css'][] = 'js_composer.css';
$config['css'][] = 'revslider-settings.css';
$config['css'][] = 'custom.css';


// $config['js'][] = assets('jquery-3.1.1.min.js','jquery');

$config['js'] = array(
    //git_assets("jquery-3.2.1.min.js",'jquery','3.2.1'),
    //'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
    //"{root_assets}/jquery/js/jquery-1.1.1.min.js",
    //git_assets("bootstrap.js",'bootstrap','4.0.0'),

//     'http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-includes/js/jquery/jquery.js?ver=1.11.1',

    'https://code.jquery.com/jquery-3.1.1.slim.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js',


    'jquery.themepunch.tools.min.js',
    'jquery.themepunch.revolution.js',
    // 'jquery.parallax-1.1.3.js',
    'excanvas.js',

    'jquery-ui.js',
    'widget.min.js', // jquery UI
    'tabs.min.js',  // jquery UI

    'scroolto.js',
    'jquery.nicescroll.min.js',
    'jquery.inview.min.js',
    'tinynav.min.js',
    'superfish.min.js',
    'jquery.magnific-popup.min.js',
    'settings.js',

    'jquery.cookie.min.js',

    'japan_text.js'
);

$config['js'][] = git_assets('jquery.countdown.js','jquery/countdown','1.0.1');
$config['js'][] = git_assets('jquery.parallax-1.1.3.js','jquery/parallax','1.1.3');
$config['js'][] = git_assets('isotope.pkgd.min.js','jquery/isotope','2.0.0');

$config['js'][] = 'script.js';
// $config['js'][] = git_assets('tether.min.js','tether','1.3.3');
$config['js'][] = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js';
// $config['js'][] = git_assets('bootstrap.min.js','bootstrap','4.0.0-beta');


// $config['css'][] = assets('font-awesome.min.css','font-awesome');

// $config['js'][] = '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js';




$config['js'][] = 'settings.js';
