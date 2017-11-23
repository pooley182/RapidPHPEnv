<?php
class Template{

	function __construct(){
		global $template_to_load, $page_name;

		//Set up auto templating variables. These can be overridden at page level if needed.
		if( file_exists(BASEPATH.'themes/'.THEME_NAME.'/templates/'.$page_name) && !is_dir(BASEPATH.'themes/'.THEME_NAME.'/templates/'.$page_name) ){
			$template_to_load = BASEPATH.'themes/'.THEME_NAME.'/templates/'.$page_name;
		} else if(file_exists(BASEPATH.'themes/'.THEME_NAME.'/templates/default.php')){
			$template_to_load = BASEPATH.'themes/'.THEME_NAME.'/templates/default.php';
		} else {
			throw_500();
		}
	}

	function _use($template){
		global $template_to_load;

		if(file_exists(BASEPATH.'themes/'.THEME_NAME.'/templates/'.$template.'.php')){
			$template_to_load = BASEPATH.'themes/'.THEME_NAME.'/templates/'.$template.'.php';
		}
	}

	function _set($section, $content, $append = false){
		global ${"template_section-$section"};
		if( $append == true){
			${"template_section-$section"} .= $content;
		} else{
			${"template_section-$section"} = $content;
		}
	}

	function _get($section){
		global ${"template_section-$section"};
		echo ${"template_section-$section"};
	}
}

$template = new Template;

?>