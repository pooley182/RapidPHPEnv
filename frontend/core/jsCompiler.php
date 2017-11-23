<?php
use MatthiasMullie\Minify;

class JsCompiler{
	public $id;
	private $lastUpdated;
	private $inputJs;
	private $outputJsFile;

	function __construct($id){
		$this->id = $id;
	}

	function addFile($filename){
		//add new file to inputLess and update lastUpdated if time stamp more recent.
		if(file_exists(BASEPATH.'themes/'.THEME_NAME.'/js/'.$filename)){
			ob_start();
			include(BASEPATH.'themes/'.THEME_NAME.'/js/'.$filename);
			$this->inputJs.= ob_get_contents()."\n";
			ob_end_clean();
			$fileUpdated = date("YmdHis",filemtime(BASEPATH.'themes/'.THEME_NAME.'/js/'.$filename));
			if ($fileUpdated > $this->lastUpdated) {
				$this->lastUpdated = $fileUpdated;
			}			
		}
	}

	function addSnippet($snippet){
		$this->inputJs.=$snippet."\n";
	}

	function compile($minify = false){
		$time = time();
		try {
			//get Updated date of "$id".js
			if(count(glob(BASEPATH.'public/js/'.$this->id.'.*.js'))){
				$fileUpdated = date("YmdHis",filemtime(glob(BASEPATH.'public/js/'.$this->id.'.*.js')[0]));
			} else {
				$fileUpdated = 0;
			}
			//comapre Updated against lastUpdated
			if (($fileUpdated < $this->lastUpdated) || !JS_CACHE){
				//Remove any old css files for this id
				array_map('unlink', glob(BASEPATH.'public/js/'.$this->id.'.*.js'));
				// set our default extension
				$extension = '.js';
				// minify if argumets is valid
				if($minify || ALWAYS_MINIFY){
					$minifier = new Minify\JS();
					$minifier->add($this->inputJs);
					$this->inputJs = $minifier->minify();
					$extension = '.min.js';
				}
				//Write contents to public/css/ folder with JsCompiler's id
				$this->outputJsFile = fopen(BASEPATH.'public/js/'.$this->id.".".$time.$extension,"w");
				
				fwrite($this->outputJsFile, $this->inputJs);
				fclose($this->outputJsFile);
				//Print out link to 
				echo '<script type="text/javascript" src="/public/js/'.$this->id.".".$time.$extension.'"></script>';
			} else {
				$extension = '.js';
				if($minify || ALWAYS_MINIFY){
					$extension = '.min.js';
				}

				if( sizeOf(glob(BASEPATH.'public/js/'.$this->id.'.*'.$extension)) > 0 ){
					$pathToJs = ltrim(glob(BASEPATH.'public/js/'.$this->id.'.*'.$extension)[0],".");
					echo '<script type="text/javascript" src="'.$pathToJs.'"></script>';
				}
			}
			
		} catch (exception $e){
			throw_500($e);
		}

	}
}
?>