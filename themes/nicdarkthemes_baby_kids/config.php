<?php
/*
 * http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/
 */

$config['theme_url'] = "//".$_SERVER['HTTP_HOST']."/themes/nicdarkthemes_baby_kids/";

$config['css'] = array(
    'http://fonts.googleapis.com/css?family=Great+Vibes&ver=4.1.1',
    git_assets("bootstrap.css",'bootstrap','4.0.0-beta',null,true),
    'style.css'
);


$config['js'] = array(
    //'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
    'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js',

    'jquery.themepunch.tools.min.js',
    'jquery.themepunch.revolution.js',
    // 'jquery.parallax-1.1.3.js',
    'excanvas.js',

    'jquery-ui.js',

    git_assets('widget.min.js','jquery/ui','1.11.2',null,false),
    //'widget.min.js', // jquery UI
    git_assets('widget.min.js','jquery/ui','1.11.2',null,false),
    //'tabs.min.js',  // jquery UI

    'scroolto.js',
    git_assets('jquery.nicescroll.min.js','jquery/nicescroll','3.2.0',null,false),
    //'jquery.nicescroll.min.js',
    git_assets('jquery.inview.min.js','jquery/inview',null,null,false),
    //'jquery.inview.min.js',
    git_assets('tinynav.min.js','jquery/tinynav',1.1,null,false),
    //'tinynav.min.js',
    git_assets('superfish.min.js','jquery/superfish','1.7.4',null),
    //'superfish.min.js',
    git_assets('jquery.magnific-popup.min.js','jquery/magnific-popup','0.9.9',null,false),
    //'jquery.magnific-popup.min.js',
    git_assets('jquery.cookie.min.js','jquery/cookie','1.4.0',null,false),
    //'jquery.cookie.min.js',

    'settings.js',
    'japan_text.js'
);

$config['js'][] = git_assets('jquery.countdown.js','jquery/countdown','1.0.1',null,false);
$config['js'][] = git_assets('jquery.parallax-1.1.3.js','jquery/parallax','1.1.3',null,false);
$config['js'][] = git_assets('isotope.pkgd.min.js','jquery/isotope','2.0.0',null,false);

$config['js'][] = 'script.js';
// $config['js'][] = git_assets('tether.min.js','tether','1.3.3');
$config['js'][] = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js';
// $config['js'][] = git_assets('bootstrap.min.js','bootstrap','4.0.0-beta');
// $config['css'][] = assets('font-awesome.min.css','font-awesome');
// $config['js'][] = '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js';

$config['js'][] = 'settings.js';
