<?php
use MatthiasMullie\Minify;
require("lessc.inc.php");

class LessCompiler{
	public $id;
	private $lastUpdated;
	private $inputLess;
	private $outputCss;
	private $outputCssFile;
	private $less;


	function __construct($id){
		$this->less = new lessc;
		$this->id = $id;
	}

	function addFile($filename){
		//add new file to inputLess and update lastUpdated if time stamp more recent.
		if(file_exists(BASEPATH.'themes/'.THEME_NAME.'/less/'.$filename)){
			ob_start();
			include(BASEPATH.'themes/'.THEME_NAME.'/less/'.$filename);
			$this->inputLess.= ob_get_contents()."\n";
			ob_end_clean();
			$fileUpdated = date("YmdHis",filemtime(BASEPATH.'themes/'.THEME_NAME.'/less/'.$filename));
			if ($fileUpdated > $this->lastUpdated) {
				$this->lastUpdated = $fileUpdated;
			}			
		}
	}

	function addSnippet($snippet){
		$this->inputLess.=$snippet."\n";
	}

	function compile($minify = false){
		$time = time();
		try {
			//get Updated date of "$id".css
			if(count(glob(BASEPATH.'public/css/'.$this->id.".*.css"))){
				$fileUpdated = date("YmdHis",filemtime(glob(BASEPATH.'public/css/'.$this->id.".*.css")[0]));
			} else {
				$fileUpdated = 0;
			}
			//comapre Updated against lastUpdated
			if (($fileUpdated < $this->lastUpdated) || !CSS_CACHE){
				//Remove any old css files for this id
				array_map('unlink', glob(BASEPATH.'public/css/'.$this->id."*.css"));
				//Compile Less down into css
				$this->outputCss = $this->less->compile($this->inputLess);
				//set our default file extension
				$extension = '.css';
				//minify if argument is valid
				if($minify || ALWAYS_MINIFY){
					$minifier = new Minify\CSS();
					$minifier->add($this->outputCss);
					$this->outputCss = $minifier->minify();
					//override our extension
					$extension = '.min.css';
				}
				//Write contents to public/css/ folder with LessCompiler's id
				$this->outputCssFile = fopen(BASEPATH.'public/css/'.$this->id.".".$time.$extension,"w");
				fwrite($this->outputCssFile, $this->outputCss);
				fclose($this->outputCssFile);
				//Print out link  
				echo '<link rel="stylesheet" type="text/css" href="/public/css/'.$this->id.".".$time.$extension.'">';
			}else{
				$extension = '.css';
				if($minify || ALWAYS_MINIFY){
					$extension = '.min.css';
				}
				if( sizeOf(glob(BASEPATH.'public/css/'.$this->id.'.*'.$extension)) > 0 ){
					$pathToCss = ltrim(glob(BASEPATH.'public/css/'.$this->id.'.*'.$extension)[0],".");
				}
				//Print out link  
				echo '<link rel="stylesheet" type="text/css" href="'.$pathToCss.'">';
			}
			
		} catch (exception $e){
			throw_500($e);
		}

	}
}
?>