<?php
if( null === BASE_DIR ){
	define('BASE_DIR', realpath('../'));
}

define('SALT', 'PxQApSWPTaNZ1GhD');
if(SALT === ''){ die('You Must set a unique SALT value in core/_init.php'); }

// setup the autoloading
require_once(BASE_DIR.'/vendor/autoload.php');
// setup Propel
require_once(BASE_DIR.'/core/datamodel/generated-conf/config.php');