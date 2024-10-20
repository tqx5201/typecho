<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<section class="content-wrap">
    <div class="container">
        <div class="row">
            <main class="col-md-8 main-content">
                
            <div class="cover tag-cover">
                <ol class="breadcrumb tag-name">
                  <li><a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">首页</a></li>
                  <?php $this->archiveTitle(array(
                        'category'  =>  _t('<li>分类</li><li class="active">%s</li>'),
                        'search'    =>  _t('<li>搜索</li><li class="active">%s</li>'),
                        'tag'       =>  _t('<li>标签</li><li class="active">%s</li>'),
                        'author'    =>  _t('<li>作者</li><li class="active">%s</li>')
                    ), '', ''); ?>
                  
                </ol>
            </div>

            <?php while($this->next()): ?>
			<!----全文模式开始----->
			<?php if ($this->options->articles_list==0):?>
			<article id="<?php $this->cid() ?>" class="post">

				<?php if (array_key_exists('star',unserialize($this->___fields()))): ?><div class="featured" title="推荐文章">
					<i class="glyphicon glyphicon-star"></i>
				</div><?php endif; ?>

				<div class="post-head">
					<h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
					<div class="post-meta">
						<span class="author">作者：<a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
						<time class="post-date" datetime="<?php $this->date('c'); ?>" title="<?php $this->date('Y年m月d日'); ?>">时间：<?php $this->date('Y年m月d日'); ?></time>
						<span class="author">分类：<?php $this->category(','); ?></span>
						<span class="author">字数：<?php echo art_count($this->cid); ?></span>
						<!--span class="author">阅读：<?php //get_post_view($this) ?></span-->
					</div>
					<div class="post-border"></div>
				</div>
						
				<?php if (array_key_exists('img',unserialize($this->___fields()))): ?>
                <div class="featured-media">
                    <a href="<?php $this->permalink() ?>"><img src="<?php $this->fields->img(); ?>" alt="<?php $this->title() ?>"></a>
                </div>
                <?php endif; ?>
				
				<div class="post-content">
					<?php echo getIndexContent($this->content,$this->permalink); ?>
				</div>
				

				<footer class="post-footer clearfix">
					
					<div class="pull-left tag-list" >
						<i class="glyphicon glyphicon-folder-open"></i>
						<?php $this->tags(' , ', true, 'none'); ?>
					</div>
					
					<div class="pull-right post-permalink" >
						<a href="<?php $this->permalink() ?>#comments" class="btn btn-default">前往评论</a>
					</div>
				</footer>
			</article>
			<?php endif; ?>
			<!----摘要模式开始----->
			<?php if ($this->options->articles_list==1):?>

			<article id="<?php $this->cid() ?>" class="post" style="padding:25px 10px;">
				
				<?php if (array_key_exists('star',unserialize($this->___fields()))): ?>
					<div class="featured" title="推荐文章"> <i class="glyphicon glyphicon-star"></i></div>
				<?php endif; ?>
				<div class="excerpt">
				<?php if (array_key_exists('img',unserialize($this->___fields()))): ?>
					<div class="excerpt-img">
						<img class="lazyload" src="'<?php $this->options->JQlazyload_gif(); ?>" data-original="<?php $this->fields->img(); ?>" alt="<?php $this->title() ?>" title="<?php $this->title() ?>">
					</div>
				<?php else: ?>
					<?php if (getFirstImg($this->content)): ?>
					<div class="excerpt-img">
						<img class="lazyload" src="<?php $this->options->JQlazyload_gif(); ?>" data-original="<?php echo getFirstImg($this->content); ?>" alt="<?php $this->title() ?>" title="<?php $this->title() ?>">
					</div>
					<?php endif; ?>
				<?php endif; ?>
				<div class="post-excerpt">
					
					<div class="excerpt-title">
						<a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
					</div>
					<div class="excerpt-info">
						<div class="excerpt-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></div> 
						<div class="excerpt-item"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php $this->date('Y-m-d'); ?></div> 
						<div class="excerpt-item"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span><?php $this->category(','); ?></div>
						<!--div class="excerpt-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span><?php $this->tags(' , ', true, 'none'); ?></div-->
					</div>
					<div class="excerpt-content">
						<?php if (array_key_exists('info',unserialize($this->___fields()))){ $this->fields->info();} else { echo getExcerpt($this->text,75,'');} ?>
						<a href="<?php $this->permalink() ?>" style="white-space:nowrap;" > - 阅读更多 - </a>
					</div>
				</div>
				</div>
			</article>

			<?php endif; ?>

			<?php endwhile; ?>

            <nav class="pagination" role="navigation">
                    
                    <?php $this->pageLink('<x aria-label="Previous" class="newer-posts"><i class="glyphicon glyphicon-menu-left"></i></x>'); ?>
                <span class="page-number">第 <?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?> 页 / 共 <?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?> 页</span>
                    <?php $this->pageLink('<x aria-label="Next" class="older-posts"><i class="glyphicon glyphicon-menu-right"></i></x>','next'); ?>
            </nav>

            </main>

            <?php $this->need('sidebar.php'); ?>

        </div class="row">
    </div class="container">
</section>

<?php $this->need('footer.php'); ?>
