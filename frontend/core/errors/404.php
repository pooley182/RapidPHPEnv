<?php $template->_set('title','404 Error Page Not Found');

IF(DEBUG_STATEMENTS){
	$request_uri = "server URI = ".$_SERVER['REQUEST_URI'];
} else {
	$request_uri = "";
}

?>
<?php ob_start() ?>
<section class="container">
	<div class="intro column is-8 is-offset-2">
		<h1 class="title">404.</h1>
		<h2>The Page You Requested Could Not Be Found</h2>
	</div>
	<?php $request_uri; ?>
</section>
<?php $primary_content = ob_get_clean();
$template->_set('primary',$primary_content);

$template->_set('secondary','');
?>