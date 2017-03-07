<?php

$domain = "//"."/themes/school/";

$config['assets_url'] = "//".$_SERVER['HTTP_HOST']."/themes";
$config['assets_dir'] = APPPATH."/themes/school/";
$config['theme_url'] = "//".$_SERVER['HTTP_HOST']."/themes/rometheme_kids/";

$config['css'] = array(
	//'character.css',

    'site_global.css',
    'master_a-master.css',
    'index.css',
    'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css',

	);

$config['js'] = array(
	'//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js',
    'https://webfonts.creativecloud.com/pacifico:n4:default;pt-sans:n4,n7,i4:default;open-sans:n8:default.js',
    'https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.4/SmoothScroll.min.js',
    'http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'

// 	'script.js'
	);

// $config['css'][] = assets('bootstrap.min.css','bootstrap');
// $config['css'][] = assets('font-awesome.min.css','font-awesome');

// $config['css'][] = assets('demo.css','dmak');
// $config['js'][] = assets('dmak.js','dmak');
// $config['js'][] = assets('jquery.dmak.js','dmak');
// $config['js'][] = assets('dmakLoader.js','dmak');
// $config['js'][] = assets('jquery.dmak.js','dmak');


