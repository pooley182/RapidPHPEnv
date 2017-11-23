<?php
// Perform immediate redirect if we have no URL path at all.
if($path == '' || $path == '/'){
	header("HTTP/1.1 301 Moved Permanently");
	header( 'Location: /'.HOME_PAGE.'/' );
	die();
}

//Explode to maintain querystring.
$path = explode('?',$path);
// Perform immediate redirect to form consistent URL's that always end with a '/'
if(!endsWith($path[0],'/')){
	header("HTTP/1.1 301 Moved Permanently");
	if(count($path) > 1){
		header( 'Location: '.$path[0].'/?'.$path[1] );
	} else {
		header( 'Location: '.$path[0].'/' );
	}
	die();	
}
//Explode URI into an array
$uri = trim($path[0], '/');
$uri_parts = explode('/', $uri);

//Check Page Exists beofre attempting to load it, otherwise set header for 404
$load_path = BASEPATH.'pages';
$size = count($uri_parts);
$counter = 0;
$page_name = '';
foreach($uri_parts as $part){
	$counter++;
	$pre_load_path = $load_path;
	$load_path = $load_path.'/'.$part;
	${$part."Class"} = 'active';
	//If we're looking in public and we 404 (i.e. end up here via dispatch process) search out file within the theme folder.
	if( startsWith($load_path,'../pages/public')){
		$load_path = BASEPATH.'pages';
		$size = count($uri_parts);
		$counter = 0;
		foreach($uri_parts as $part){
			$counter++;
			$load_path = $load_path.'/'.$part;				
			if( $counter == $size ){
				$test_path = preg_replace('/^\.\.\/pages\/public/','..'.THEME_PATH,$load_path);
				if((file_exists($test_path)) && (is_file($test_path))){
					$load_path = $test_path;
					// $page_name is used by templating engine, if set before template is created it becomes the template we load.
					$page_name = 'null.php';
					break 2;
				}
			}
		}
	}
	// find if we have a template that matches a current page. Overwirte if we do, this inherets along the url.
	// /api/v1/userDetails/ for example would use an api.php template if it existed, though if a userDetails.php file existed this would take priority.
	// Explicitly setting $template->_use() in a page file is the highest priority and will override any defaults set here.
	if(file_exists(BASEPATH.'themes/'.THEME_NAME.'/templates/'.$part.'.php')){
		$page_name = $part.'.php';
	}

	if((file_exists($load_path) && is_dir($load_path)) || (file_exists($load_path.'.php') && is_file($load_path.'.php'))){
		if( $counter == $size ){
			// We're on the last part of the path, if we match a folder then we want index.php otherwise match the filename.
			if((file_exists($load_path)) && (is_dir($load_path))){
				//We're looking at a directory - check for index.php in folder
				$test_path = $load_path.'/index.php';
				if((file_exists($test_path)) && (is_file($test_path))){
					$load_path = $test_path;
				} else {
					throw_404();
					break;
				}
			}else{
				$test_path = $load_path.'.php';
				if((file_exists($test_path)) && (is_file($test_path)) && !endsWith($test_path,"index.php")){
				//We've found a php file in a folder.
				$load_path = $test_path;
				}else{
					throw_404();
					break;
				}
			}
		}
	}else{
		//Neither a folder nor a php file exists for the current path.
		//If we're not on the last part of the URL do we have a regex folder that our path matches?
		if( $counter != $size ){
			$test_load_path = $pre_load_path.'/(regex)';
			if( file_exists($test_load_path) && is_dir($test_load_path) ){
				//Do we have a regext test file in our directory.
				if( file_exists($test_load_path.'/regex') && is_file($test_load_path.'/regex') ){
					//Test regex against our path part
					$pattern = file_get_contents($test_load_path.'/regex');
					if( preg_match($pattern, $part) ){
						$load_path = $test_load_path;
					} else {
						//Nothing found. Throw 404
						throw_404();
						break;
					}
				} else {
					//Nothing found. Throw 404
					throw_404();
					break;
				}
			} else {
				//Nothing found. Throw 404
				throw_404();
				break;
			}
		} else {
			//Nothing found. Throw 404
			throw_404();
			break;
		}
	}
}
?>