<?php get_header(); ?>
<div id="page-content">
	<div class="container">
		<div class="row">
			<div class="blog-posts search-posts">
				<?php if ( !have_posts() ) : ?>
					<?php _e('没有找到相关的内容'); ?></p>
				<?php else: ?>
				<div class="search-title">
					<h3><span><?php global $wp_query; echo '搜索到 ' . $wp_query->found_posts . ' 篇相关的文章';?></span></h3>
				</div>
				<div class="ajax-load-box posts-con">
					<?php while ( have_posts() ) : the_post(); 
						include( TEMPLATEPATH.'/includes/excerpt.php' );endwhile; ?>
				</div>
				<div class="clearfix"></div>
				<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
					<div id="ajax-load-posts">
						<?php echo fa_load_postlist_button();?>
					</div>
					<?php  }else {
						the_posts_pagination( array(
							'prev_text'          =>上页,
							'next_text'          =>下页,
							'screen_reader_text' =>'',
							'mid_size' => 1,
						) ); } 
				endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>