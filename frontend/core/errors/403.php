<?php $template->_set('title','403 Error Forbidden');

IF(DEBUG_STATEMENTS){
	$request_uri = "server URI = ".$_SERVER['REQUEST_URI'];
} else {
	$request_uri = "";
}

?>
<?php ob_start() ?>
<section class="container">
	<div class="intro column is-8 is-offset-2">
		<h1 class="title">403.</h1>
		<h2>You do not have permission to access this content.</h2>
		<pre>// TODO: Login form.</pre>
	</div>
	<?php $request_uri; ?>
</section>

<?php $primary_content = ob_get_clean();
$template->_set('primary',$primary_content);

$template->_set('secondary','');
?>