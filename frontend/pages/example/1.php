<?php $template->_set('title',"Example 1"); ?>
<?php ob_start(); ?>
	<div class="box cta">
		<p class="has-text-centered">
			<span class="tag is-primary">/example/1/</span>
		</p>
	</div>
<?php $primary_content = ob_get_clean(); ?>
<?php $template->_set('primary',$primary_content); ?>