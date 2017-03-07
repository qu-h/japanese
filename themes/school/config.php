<?php

$domain = "//"."/themes/school/";

$config['assets_url'] = "//".$_SERVER['HTTP_HOST']."/themes";
$config['assets_dir'] = APPPATH."/themes/school/";
$config['theme_url'] = "//".$_SERVER['HTTP_HOST']."/themes/school/";

$config['css'] = array(
	'character.css'
	);

$config['js'] = array(
	'//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js',
	'//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js',

	'script.js'
	);

$config['css'][] = assets('bootstrap.min.css','bootstrap');

$config['css'][] = assets('demo.css','dmak');
$config['js'][] = assets('dmak.js','dmak');
$config['js'][] = assets('jquery.dmak.js','dmak');
$config['js'][] = assets('dmakLoader.js','dmak');
$config['js'][] = assets('jquery.dmak.js','dmak');


