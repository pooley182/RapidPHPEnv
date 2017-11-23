<?php 
	// This would inherit the api.php template, but we don't want to so override with the below.
	$template->_use('default');
?>
<?php $template->_set('title',"Api"); ?>
<?php ob_start(); ?>
	<div class="box cta">
		<p class="has-text-centered">
			<span class="tag is-primary">/example/api</span> How our api works
		</p>
	</div>
<?php $primary_content = ob_get_clean(); ?>
<?php $template->_set('primary',$primary_content); ?>