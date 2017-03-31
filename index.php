<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors',1);

	require_once 'n.inc.php';

	use \N\Sys\Core;
	use \N\Sys\Autoload;

	$loader = new \N\Sys\Autoload;
	$loader->register();
	$loader->addNamespace('N\Sys', 'sys');
	$loader->addNamespace('N\App', 'app');
	$loader->addNamespace('N\App\Controllers', 'app/controllers');
	$loader->addNamespace('N\App\Models', 'app/models');
	$loader->addNamespace('N\App\Views', 'app/views');
	$loader->addNamespace('N\App\Tpl', 'app/tpl');
	$loader->addNamespace('N\App\Map', 'app/map');



	
	

	Core::init();