<?php if ($this->options->sidebar_posts == 'yes') : ?>
	<aside id="widget_ui_post" class="widget widget_ui_post panel clearfix">
		<div class="widget-title"><i class="fa"></i>最新文章</div>
		<ul>
			<?php $this->widget('Widget_Contents_Post_Recent','pageSize=3')->to($posts); ?>
			<?php while($posts->next()): ?>
				<li><a href="<?php $posts->permalink() ?>" title="<?php $posts->title() ?>">
					<img src="<?php $posts->options->themeUrl(); ?>timthumb.php?src=<?php Thumbnail_Plugin::show($posts); ?>&h=150&w=310&zc=1" />
					<span class="text"><?php $posts->title() ?></span>
					<span class="wid-tg-comment"><i class="fa fa-comments-o"></i> <?php $posts->commentsNum('%d 评论'); ?></span>
				</a></li>
			<?php endwhile; ?>		
		</ul>
	</aside>
<?php endif; ?>
<?php $this->need('inc/ad/ad_widget_top.php'); ?>
<section class="widget panel">
	<h3 class="widget-title"><i class="fa"></i><?php _e('归档'); ?></h3>
	<ul class="widget-list">
		<?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
		->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
	</ul>
</section>

<section class="widget panel">
	<h3 class="widget-title"><i class="fa"></i><?php _e('最近回复'); ?></h3>
	<ul class="widget-list">
	<?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
	<?php while($comments->next()): ?>
		<li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
	<?php endwhile; ?>
	</ul>
</section>
