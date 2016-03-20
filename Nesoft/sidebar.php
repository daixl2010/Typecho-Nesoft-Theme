<section class="widget panel">
	<h3 class="widget-title"><i class="fa"></i><?php _e('最新文章'); ?></h3>
	<ul class="widget-list">
		<?php $this->widget('Widget_Contents_Post_Recent')
		->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
	</ul>
</section>
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