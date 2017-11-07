<div class="owl-carousel top-slide-three <?php echo $GLOBALS['wow_slide'];?>">
	<?php
	if( suxingme('suxingme_slide2',false) ): 
		for ($i=1; $i < suxingme('suxingme_slide_number') + 1; $i++) { ?>
				<div class="item" style="background: url(<?php echo suxingme('suxingme_slide_img_'.$i); ?>); background-repeat: no-repeat;background-size: cover;background-position: center top;">	
					<div class="slider-content">
						<div class="slider-content-box"> 
							<div class="slider-content-item">
								
								<div class="slider-title">
									<h2><?php echo suxingme('suxingme_slide_title_'.$i);?></h2>
					            </div>
					             
				           	</div>
			           	</div>   
					</div>
					<a class="read-slider" href="<?php echo suxingme('suxingme_slide_url_'.$i);?>" title="<?php echo suxingme('suxingme_slide_title_'.$i);?>"></a>

				</div>
		<?php }
	?>
		

	<?php else: ?>
		<?php 
			$numpost = suxingme('suxingme_slide_number');
			$args = array( 
			'showposts' => $numpost,
			'ignore_sticky_posts' => 1,	
			'meta_query' => array(
				array(
					'key' => 'lunbo_value', 
					'value' => 'true'  
					)));
			query_posts($args);
			if (have_posts()) : 
				while (have_posts()) : the_post();?>
					<div class="item" style="background: url(<?php if (get_post_meta($post->ID,"postthumb_value",true ) ){ echo get_post_meta($post->ID,"postthumb_value",true); } elseif( suxingme('suxingme_timthumb') ){ echo get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=500&w=1120'; } else { echo post_thumbnail_src(); } ?>); background-repeat: no-repeat;background-size: cover;background-position: center top;">	
						<div class="slider-content">
							<div class="slider-content-box"> 
								<div class="slider-content-item">
									<div class="post-categories clearfix">            
										<?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?>       
									</div>  
									
									<div class="slider-title">
										<h2><?php the_title();?></h2>
						            </div>
						            
							        <div class="read-more"><a href="<?php the_permalink(); ?>">阅读全文</a></div>   
					           	</div>
				           	</div>   
						</div>
						<a class="read-slider" href="<?php the_permalink(); ?>" title="<?php the_title();?>"></a>

					</div>
			<?php 
				endwhile; 
			else:  
				$categories = explode(",",suxingme( 'suxingme_slide_fenlei' ));
				$order = suxingme('suxingme_slide_order');
				$num = suxingme('suxingme_slide_number');
				$args = array(
					'ignore_sticky_posts'=> 1,
					'paged' => $paged,
					'orderby'=> $order,//date DESC rand
					'posts_per_page' =>  $num,
					'cat' => $categories , 
					'tax_query' => array( array( 
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							//请根据需要保留要排除的文章形式
							'post-format-aside',
							'post-format-link'
							),
						'operator' => 'NOT IN',
					) ),
				);
				query_posts($args);			
				while (have_posts()) : the_post();?>
				<div class="item" style="background: url(<?php if( suxingme('suxingme_timthumb') ){ echo get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=500&w=1120'; } else { echo post_thumbnail_src(); } ?>); background-repeat: no-repeat;background-size: cover;background-position: center top;">	
						<div class="slider-content">
							<div class="slider-content-box"> 
							<div class="slider-content-item">
								<div class="post-categories clearfix">            
									<?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?>       
								</div>  
								
								<div class="slider-title">
									<h2><?php the_title();?></h2>
					            </div>
					            
						        <div class="read-more"><a href="<?php the_permalink(); ?>">阅读全文</a></div>   
				           	</div>
				           	</div>   
						</div>
						<a class="read-slider" href="<?php the_permalink(); ?>" title="<?php the_title();?>"></a>

				</div>
		<?php endwhile; wp_reset_query(); endif; ?>
	<?php endif; ?>
</div>
