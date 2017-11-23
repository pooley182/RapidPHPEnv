<?php //Keep white space out of this file
	$theme_path = THEME_PATH;
	$bodyClass = "";


 // Default Secondary content
ob_start(); ?>
<span>Secondary Content</span>
<?php 
	$secondary_content = ob_get_clean();

	$secondary_content = '';

	$template->_set('secondary',$secondary_content);
?>