<?php get_header();?>
<div id="page-content">
	<div class="container">
		<div class="row">

			<?php if(have_posts()) : ?>
				<div class="blog-posts">
					<?php if (suxingme('suxingme_breadcrumbs',false) && function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
					<div class="ajax-load-box posts-con">
						<?php while ( have_posts() ) : the_post(); 
							include( TEMPLATEPATH.'/includes/excerpt.php' );endwhile; ?>
					</div>
					<div class="clearfix"></div>
					<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
							<div id="ajax-load-posts">
								<?php echo fa_load_postlist_button();?>
							</div>
							<?php  } else {
								the_posts_pagination( array(
									'prev_text'          =>'上页',
									'next_text'          =>'下页',
									'screen_reader_text' =>'',
									'mid_size' => 1,
								) ); 
							} ?>
					</div>
				<?php else: ?>			
					<div class="blog-posts"><p><?php echo '站长很懒，该栏目还没有文章...'; ?></p></div>
				<?php  endif; ?>
					
			<?php get_sidebar(); ?>
		</div>
		
	</div>
</div>
<?php get_footer(); ?>