<div class="clearfix"></div>
	<footer id="footer-no-top">
		<div class="container">
			<div class="copyrights">
				Copyright &copy; 2016 <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>  All rights reserved.
			</div>
			<div class="social">				
				<?php if($this->options->global_beian) : ?>
					<a href="http://www.miibeian.gov.cn" rel="nofollow"><?php echo $this->options->global_beian; ?></a>
				<?php endif; ?>
				Theme By <a href="http://www.nesoft.cn" target="_blank">Nesoft</a>.
			</div>
		</div>
	</footer>
	<div class="go-up"><i class="fa fa-chevron-up"></i></div>
	<?php $this->footer(); ?>
	<script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('js/custom.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('inc/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="<?php $this->options->themeUrl('js/html5shiv.js'); ?>"></script>
		<script src="<?php $this->options->themeUrl('js/respond.min.js'); ?>"></script>
    <![endif]-->
	<!--[if IE 7]>
		<link rel="stylesheet" href="/css/font-awesome-ie7.min.css">
	<![endif]-->
	</body>
</html>
