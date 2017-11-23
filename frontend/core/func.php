<?php
function throw_404(){
	global $load_path;

	header("HTTP/1.1 404 Not Found");
	$load_path = BASEPATH.'core/errors/404.php';
}

function forbidden(){
	global $load_path;	

	header("HTTP/1.1 403 Forbidden");
	$load_path = BASEPATH.'core/errors/403.php';
}

function unauthorized(){
	global $load_path;

	header("HTTP/1.1 401 Unauthorized");
	$load_path = BASEPATH.'core/errors/401.php';
}

function throw_500($e=null){
	global $load_path;
	
	header("HTTP/1.1 500 Internal Server Error");
	$load_path = BASEPATH.'core/errors/500.php';
}

function process_time(){
	global $requestBegin;

	$now = microtime_float();
	echo "Request took ".round((($now - $requestBegin) * 1000),2)." ms";
}

function startsWith( $str, $sub ) {
   return ( substr( $str, 0, strlen( $sub ) ) === $sub );
}

function endsWith( $str, $sub ) {
   return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
}
?>