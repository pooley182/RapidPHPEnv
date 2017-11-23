<?php
	require(THEME_CONF); //Load theme config file, including any default content.
	require($load_path); //Load file from pages directory, and it's content.
	require($template_to_load); //Load template and dump in all content from pages file.
?>