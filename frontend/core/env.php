<?php
	session_start();

	DEFINE ('BASEPATH', '../');

	DEFINE('DEBUG_STATEMENTS', 1); // Set this to 0 for production environments
	DEFINE('CSS_CACHE',1); // Set to 1 to enable caching of css. css will only be recompiled if source less/css files change.
	DEFINE('JS_CACHE',1); // Set to 1 to enable caching of js. js will only be recompiled if source files change.
	DEFINE('ALWAYS_MINIFY',1); // Always minify CSS/JS overrides any compile() functions in the css/js compiler classes

	//Set the below variables if a database is not to be used.
	DEFINE('THEME_NAME','default');
	DEFINE('THEME_PATH','/themes/'.THEME_NAME);
	DEFINE('THEME_CONF','../'.THEME_PATH.'/conf.php');
	DEFINE('SITE_NAME','Loneworker');
	DEFINE('HOME_PAGE','home');

	$path = $_SERVER['REQUEST_URI'];
	$called_404 = false;
?>