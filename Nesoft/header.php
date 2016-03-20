<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta charset="<?php $this->options->charset(); ?>">
	<meta name="renderer" content="webkit">
	<title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
	<!-- 使用url函数转换相关路径 -->
   	<link rel="stylesheet" href="<?php $this->options->themeUrl('inc/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php $this->options->themeUrl('inc/font-awesome/css/font-awesome.min.css'); ?>">
    	<link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
		<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<?php if($this->options->seo_zdts) : ?>
		<?php echo $this->options->seo_zdts; ?>
	<?php endif; ?>
	<?php if($this->options->seo_analysis_yb) : ?>
		<?php echo $this->options->seo_analysis_yb; ?>
	<?php endif; ?>
	<!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>	
</head>
<header id="header" class="clearfix">
    <div class="container header-main">
		<nav class="navigation_mobile navigation_mobile_main">
			<div class="navigation_mobile_click"><i class="fa fa-align-justify"></i></div>
			<ul></ul>
		</nav><!-- End navigation_mobile -->
		<div class="site-name">
			<a id="logo" href="<?php $this->options->siteUrl(); ?>">
				<?php if ($this->options->logoUrl): ?>
				<img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
				<?php endif; ?>
				<?php $this->options->title() ?>
			</a>
		</div>
		<nav id="nav-menu" class="navigation" role="navigation">			
			<ul class="nav navbar-nav">
				<li<?php if($this->is('index')): ?> class="active"<?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
				<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
				<?php while($category->next()): ?>
					<?php if(count($category->children)):?>
						<li class="dropdown">
							<a href="<?php $category->permalink(); ?>" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo $category->name?>
							<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php foreach($category->children as $k=>$v):?>
									<li><a href="<?php echo $v['permalink'] ?>"><?php echo $v['name'] ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
					<?php else:?>
						<?php if($category->levels == 0):?>
							<li 
								<?php if ($this->is('category', $category->slug)): ?>
									class="active" 
								<?php endif; ?> style="<?php print_r($category->children) ?> ">
								<a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>">
									<?php $category->name(); ?>
								</a>
							</li>
						<?php endif;?>
					<?php endif;?>
				<?php endwhile; ?>
				<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                    <li><a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                <?php endwhile; ?>
			</ul>
		</nav>
		<div class="site-search">
			<form id="search" method="post" action="./" role="search">
				<label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
				<input type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
				<button type="submit" class="submit"><?php _e('搜索'); ?></button>
			</form>
		</div>
		<div class="notice">
			<strong class="global_notice"><i class="fa fa-volume-up"></i></strong> 
			<?php echo $this->options->global_notice; ?>
		</div>
    </div>
</header><!-- end #header -->
