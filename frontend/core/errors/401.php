<?php $template->_set('title','401 Error Unauthorized');

IF(DEBUG_STATEMENTS){
	$request_uri = "server URI = ".$_SERVER['REQUEST_URI'];
} else {
	$request_uri = "";
}

?>
<?php ob_start() ?>

<section class="container">
	<div class="intro column is-8 is-offset-2">
		<h1 class="title">401.</h1>
		<h2>You do not have permission to access this content.</h2>
	</div>
</section>
<?php $request_uri; ?>

<?php $primary_content = ob_get_clean();
$template->_set('primary',$primary_content);

$template->_set('secondary','');
?>