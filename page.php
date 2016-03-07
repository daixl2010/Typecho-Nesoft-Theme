<?php

    if (isset($_GET["action"]) && $_GET["action"] == "ajax_comments") {
        $this->need('comments.php');
    } else {
        if(strpos($_SERVER["PHP_SELF"],"themes")) header('Location:/');
        $this->need('header.php');
?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<div class="well">
						<header class="page-header">
							<h3 class="page-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h3>
							<div class="post-meta">
								<span class="author"><i class="fa fa-user"></i> <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> </span>
								<span class="time"><i class="fa fa-calendar"></i> <?php $this->date('F j, Y'); ?></span>
								<span class="comments"><i class="fa fa-comments-o comments-link" ></i> <a href="<?php $this->permalink() ?>"><?php $this->commentsNum('%d 评论'); ?></a> </span>
							</div>
						</header>
						<div class="single-content"><?php $this->content('Continue Reading...'); ?></div>
					</div>
                    
					<div class="well">
						<?php $this->need('comments.php'); ?>
					</div>
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
<?php } ?>