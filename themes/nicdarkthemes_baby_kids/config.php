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
$config['css'][] = "{root_assets}/bootstrap/css/bootstrap.css";

$config['css'][] = 'nicdark_style.css';
$config['css'][] = 'js_composer.css';
$config['css'][] = 'revslider-settings.css';
$config['css'][] = 'custom.css';


// $config['js'][] = assets('jquery-3.1.1.min.js','jquery');

$config['js'] = array(
//     'http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-includes/js/jquery/jquery.js?ver=1.11.1',
	array('jquery-1.1.1.min.js','jquery'),
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

$config['js'][] = assets('jquery.countdown.js','jquery/countdown');
$config['js'][] = assets('jquery.parallax-1.1.3.js','jquery/parallax');
$config['js'][] = assets('isotope.pkgd.min.js','isotope');

$config['js'][] = 'script.js';
$config['js'][] = assets('tether.min.js','tether');
$config['js'][] = assets('bootstrap.min.js','bootstrap');


// $config['css'][] = assets('font-awesome.min.css','font-awesome');

// $config['js'][] = '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js';




$config['js'][] = 'settings.js';
