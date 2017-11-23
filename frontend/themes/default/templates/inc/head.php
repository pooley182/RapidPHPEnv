<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php $template->_get('title'); echo " | ".SITE_NAME; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<?php
		//
		$css = new LessCompiler('framework');
		$css->addFile('bulma-0.6.0.css');
		$css->addFile('font-awesome.css');
		$css->compile();


		$css = new LessCompiler('main-style');
		$css->addFile('style.less');
		$css->compile();

	?>
</head>
<body class="<?=$bodyClass?>">
	<section class="hero is-info is-medium is-bold">
	    <div class="hero-head">
	      <nav class="navbar">
	        <div class="container">
	          <div class="navbar-brand">
	            <a class="navbar-item" href="../">
	              <img src="http://bulma.io/images/bulma-type-white.png" alt="Logo">
	            </a>
	            <span class="navbar-burger burger" data-target="navbarMenu">
	              <span></span>
	              <span></span>
	              <span></span>
	            </span>
	          </div>
	          <div id="navbarMenu" class="navbar-menu">
	            <div class="navbar-end">
	              <a class="navbar-item is-active">
	                Home
	              </a>
	              <a class="navbar-item">
	                Examples
	              </a>
	              <a class="navbar-item">
	                Documentation
	              </a>
	              <span class="navbar-item">
	                <a class="button is-white is-outlined is-small" href="https://github.com/dansup/bulma-templates/blob/master/templates/hero.html">
	                  <span class="icon">
	                    <i class="fa fa-github"></i>
	                  </span>
	                  <span>View Source</span>
	                </a>
	              </span>
	            </div>
	          </div>
	        </div>
	      </nav>
	    </div>
	    <?php $template->_get('banner'); ?>
	  </section>