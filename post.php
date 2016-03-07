<?php include('header.php');?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<div class="well">
						<header class="single-header">
							<h3 class="single-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h3>
							<div class="post-meta">
								<span class="author"><i class="fa fa-user"></i> <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> </span>
								<span class="time"><i class="fa fa-calendar"></i> <?php $this->date('F j, Y'); ?></span>
								<span class="categories"><i class="fa fa-folder-o"></i> <?php $this->category(','); ?> </span>
								<span class="comments"><i class="fa fa-comments-o comments-link" ></i> <a href="<?php $this->permalink() ?>"><?php $this->commentsNum('%d 评论'); ?></a> </span>
							</div>
						</header>
						<?php $this->need('inc/ad/ad_single_top.php'); ?>
						<div class="single-content"><?php $this->content('Continue Reading...'); ?></div>
						<p class="tags">标签：<?php $this->tags(' , ', true, '无'); ?></p>
						<h6 class="copyright alert alert-success">
							<p>版权属于: <?php echo '<a href="';$this->options->siteUrl();echo '">';$this->options->title();echo '</a>';?></p>
							<p>原文地址: <?php echo '<a href="';echo $this->permalink().'">';echo $this->permalink().'</a>';?></p>
							<p>转载时必须以链接形式注明原始出处及本声明。</p>
						</h6>
						<ul class="post-near">
							<li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
							<li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
						</ul>
					</div>
                    <?php $this->need('inc/ad/ad_comments_top.php'); ?>
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

