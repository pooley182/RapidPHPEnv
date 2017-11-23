<?php $template->_set('title',"Example"); ?>
<?php ob_start(); ?>
	<div class="box cta">
		<p class="has-text-centered">
			<span class="tag is-primary">/example/</span>
		</p>
	</div>
<?php $primary_content = ob_get_clean(); ?>
<?php $template->_set('primary',$primary_content); ?>