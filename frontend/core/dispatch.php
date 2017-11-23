<?php
define('BASE_DIR', realpath('../../'));
include(BASE_DIR.'/core/_init.php');

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
$requestBegin = microtime_float();

require('env.php');
if(DEBUG_STATEMENTS){
	error_reporting(E_ALL);	
} else {
	error_reporting(0);
}
require('func.php');
require('url.php');
require('lessCompiler.php');
require('jsCompiler.php');
require('template.php');
require('dopage.php');
?>