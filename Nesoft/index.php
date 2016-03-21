<?php
/**
 * 这是typecho系统的一套基于Bootstrap的响应式主题！你可以在<a href="http://nesoft.cn">Nesoft的官方网站</a>获得更多关于此皮肤的信息。
 * @package Nesoft Theme 
 * @author nesoft
 * @version 1.0.4
 * @link http://nesoft.cn
 *
 */
 
 include('header.php');
 ?>
 <div class="container">
	<div class="row">
		<div class="col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php  include('inc/post-format/content.php'); ?>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!--/.col-md-8-->

		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">				
				<?php include('sidebar.php'); ?>
			</div>
		</aside>

	</div><!--/.row-->
</div>	
 
<?php include('footer.php'); ?>
