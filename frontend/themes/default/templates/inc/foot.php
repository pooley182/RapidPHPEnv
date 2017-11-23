	<footer class="footer">
		<div class="container">
			<div class="content has-text-centered">
				<p>
					<strong>Bulma Templates</strong> by <a href="https://github.com/dansup">Daniel Supernault</a>. The source code is licensed
					<a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
				</p>
				<p>
					<a class="icon" href="https://github.com/dansup/bulma-templates">
						<i class="fa fa-github"></i>
					</a>
				</p>
			</div>
		</div>
	</footer>

	<?php $template->_get('js'); ?>

	<?php
	$js = new JsCompiler('utils');
	$js->addFile('jquery-3.2.1.js');
	$js->addFile('react.js');
	$js->addFile('react-dom.js');
	$js->compile();

	$js = new JsCompiler('main-script');
	$js->addFile('main.js');
	$js->compile();
	?>
</body>

</html>