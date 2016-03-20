<?php $this->need('header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
            <div class="archive-header"><?php $this->archiveTitle(array(
                'category'  =>  _t('分类: %s '),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签: %s 下的文章'),
                'author'    =>  _t('作者：%s 发布的文章')
                ), '', ''); ?></div>
            <?php if ($this->have()): ?>

					<?php  include('inc/post-format/content.php'); ?>

			<?php else: ?>
				<article class="well">
					<h2 class="header"><?php _e('没有找到内容'); ?></h2>
				</article>
			<?php endif; ?>

        </div><!--/.col-md-8-->
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">				
				<?php include('sidebar.php'); ?>
			</div>
		</aside>


		

	</div><!--/.row-->
</div>	
 
<?php include('footer.php'); ?>
