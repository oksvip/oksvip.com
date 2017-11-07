<div class="sidebar <?php echo $GLOBALS['wow_sidebar'];?>">
	<?php 
		if (is_single() && suxingme('suxingme_post_author_box',true) || is_author() && suxingme('suxingme_author_box',true)) { ?>
		<div class="widget suxingme_post_author">
			
			<?php 
				$author_id=get_the_author_meta('ID');
				$author_url=get_author_posts_url($author_id);	
				$user_email = get_the_author_meta( 'user_email' );
			?>	
				<div class="authors_profile">
					<div class="avatar-panel" <?php if( suxingme('suxingme_author_bgp',false ) ){ echo 'style="background-image:url('.suxingme('suxingme_author_bgp').')"'; }?>>
						<a target="_blank" href="<?php echo $author_url;?>" title="<?php  echo the_author_meta( 'nickname' ); ?>" class="author_pic">
							<?php echo get_avatar( $author_id, 80 ); ?>
						</a>
					</div>	
					<div class="author_name"><a target="_blank" href="<?php echo $author_url;?>" title="<?php  echo the_author_meta( 'nickname' ); ?>"><?php the_author()?></a><span><?php echo suxing_level() ?></span></div>
					<p class="author_dec"><?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我真的不是自黑!'; }?></p>
				</div>
			
		</div>			
	<?php }	?>
	<?php if ( !is_active_sidebar( 'widget_right' ) && !is_active_sidebar( 'widget_post' ) && !is_active_sidebar( 'widget_page' ) && !is_active_sidebar( 'widget_sidebar' ) && !is_active_sidebar( 'widget_other' )) { 
			echo '<div class="widget"><p>请到[后台->外观->小工具]中添加需要显示的小工具。</p></div>';
		 }else{
			dynamic_sidebar( 'widget_right' ); 
			wp_reset_query();
			if (is_home()){
				dynamic_sidebar( 'widget_sidebar' ); 
			}
			else if (is_page()){
				dynamic_sidebar( 'widget_page' ); 
			}
			else if (is_single()){
				dynamic_sidebar( 'widget_post' ); 
			}
			else {
				dynamic_sidebar( 'widget_other' );
			}
		
		} ?>

</div>