<?php while($this->next()): ?>
	<?php if ($this->sequence == 2) : ?>
		<?php $this->need('inc/ad/ad-list.php'); ?>
	<?php endif; ?>
	<div class="well mdl-card">
		<header class="post-header">
			<h3 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h3>
			<div class="post-meta">
				<span class="author"><i class="fa fa-user"></i> <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> </span>
				<span class="time"><i class="fa fa-calendar"></i> <?php $this->date('F j, Y'); ?></span>
				<span class="categories"><i class="fa fa-folder-o"></i> <?php $this->category(','); ?> </span>
				<span class="comments"><i class="fa fa-comments-o comments-link" ></i> <a href="<?php $this->permalink() ?>"><?php $this->commentsNum('%d 评论'); ?></a> </span>
			</div>
		</header>
		<div class="post-content">
			<div class="thumb hidden-xs hidden-sm pull-left">
				<a href="<?php $this->permalink() ?>" class="thumbnail">
                <img src="<?php $this->options->themeUrl('img/random/'); ?><?php echo rand(1,10); ?>.jpg" style="width: 200px;height: 150px;" title="<?php $this->title() ?>" alt="<?php $this->title() ?>"></a>
            </div>
			<?php $this->excerpt(180, '...'); ?>
		</div>
		<div class="more-link"><a href="<?php $this->permalink() ?>" title="阅读全文">阅读全文&raquo;</a></div>
	</div>
<?php endwhile; ?>
<?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>