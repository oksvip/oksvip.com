<?php 

$metainfo = suxingme('single_metainfo');
$dis_author = $metainfo['author'];
$dis_cat  = $metainfo['cat'];
$dis_time = $metainfo['time'];
$dis_view = $metainfo['view'];
$dis_like = $metainfo['like'];

get_header(); ?>
<div id="page-content">
	<div class="container">
		<div class="row">
			
			<div class="blog-post">
				<?php if (suxingme('suxingme_breadcrumbs',false) && function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
				<?php if(!wp_is_mobile()): echo single_pc_top_ad_pic();endif; if(wp_is_mobile()): echo single_mini_top_ad_pic(); endif; ?>
				<div class="post">
					<?php if(have_posts()): while(have_posts()):the_post();  ?>
					<div class="post-title">
						<?php the_tags('<div class="post-entry-categories">','','</div>'); ?>
						<h1 class="title"><?php the_title(); ?></h1>
						<div class="post_icon"> 
							<?php if(get_post_meta($post->ID,"cc_value",true )) { ?>
								<span class="postoriginal"><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span>
							<?php } ?>
							<?php if( wp_is_mobile() && $dis_author == 1 ):?>
								<span  class="postauthor"><?php echo get_avatar( get_the_author_meta('email'), '' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author() ?></a></span> 
							<?php endif; ?>
							<?php if( $dis_cat == 1 ) { ?>
								<span  class="postcat"><i class=" icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></span>
							<?php } if( $dis_time == 1 ) { ?>
								<span class="postclock"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
							<?php } if( $dis_view == 1 ) { ?>
								<span class="posteye"><i class="icon-eye-4"></i> <?php post_views('',''); ?></span>
							<?php } if(suxingme('suxingme_post_comment',true)) { ?>
								<span class="postcomment"><i class="icon-comment-4"></i> <a href="<?php the_permalink(); ?>" title="评论"><?php comments_popup_link( __( '0' ) , __( '1'), __( '%') ); ?></a></span>
							<?php }  if( $dis_like == 1 ) { ?><span class="postlike"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span><?php } ?>
							<?php if( has_post_format( 'link' ) ){ ?>
								<span class="postpublicity"><i class="icon-link"></i><a href="<?php echo get_post_meta($post->ID,"tuiguang_value",true ); ?>"><?php echo get_post_meta($post->ID,"tuiguangtext_value",true ); ?></a></span>
							<?php } ?>
							<?php edit_post_link('[编辑]'); ?>
						</div>
					</div>
					<div class="post-content">
						<?php if(has_excerpt()): ?>
							<p class="post-abstract"><span class="abstract-tit">摘要：</span><?php echo get_the_excerpt(); ?></p>
						<?php endif;?>
						<?php the_content(); suxing_link_pages('before=<div class="page-links">&after=&next_or_number=next&previouspagelink=上一页&nextpagelink=');  suxing_link_pages('before=&after='); suxing_link_pages('before=&after=</div>&next_or_number=next&previouspagelink=&nextpagelink=下一页'); ?>
					</div>

					<?php
					if( get_post_meta($post->ID,"cc_value",true ) ) :
					?>
					<div class="post-declare">
						<span><i class="icon-bookmark"></i></span>
						<p>原创文章，作者：<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author() ?></a>，如若转载，请注明出处：《<?php the_title();?>》<?php the_permalink(); ?></p>
					</div>
					<?php endif; ?>

					<div class="shareBox  clearfix">
						<p>
							<?php if( has_post_format( 'link' ) ){ ?>
								<a href="<?php echo get_post_meta($post->ID,"tuiguang_value",true ); ?>" class="sharebtn publicity-btn" rel="nofollow" target="_blank"><i class="icon-link"></i> <?php echo get_post_meta($post->ID,"tuiguangtext_value",true ); ?></a>
							<?php } ?>
							<?php if(suxingme('suxingme_post_like',true)) { ?>
							<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action sharebtn like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
								<span class="icon s-like"><i class="icon-heart"></i><i class="icon-heart-filled"></i> 喜欢 </span>
								(<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>)
							</a>
							<?php } ?>
							<?php if(suxingme('suxingme_reward')) { ?>
								<a href="javascript:;" class="sharebtn pay-author"><i class="icon-cup"></i> 打赏</a>
							<?php } ?>
							
							<?php if(suxingme('suxingme_baidushare')) { ?>
								<a href="javascript:;" class="sharebtn J_showAllShareBtn"><i class="icon-forward"></i> 分享</a>
							<?php } ?>
						</p>
						<div class="socialBox">
							<?php if(suxingme('suxingme_baidushare')) { ?>
								<div class="action-share bdsharebuttonbox"><?php echo suxing_get_share() ?></div>
							<?php } ?>
							<?php if(suxingme('suxingme_reward')) { ?>
								<div class="panel-reward">
									<ul>
										<?php if(suxingme('suxingme_alireward') or get_the_author_meta( 'alipay' )) { ?>
											<li class="alipay"><img alt="打赏" src="<?php if ( get_the_author_meta( 'alipay' ) ){echo get_the_author_meta( 'alipay' );}else{echo suxingme('suxingme_alireward') ;}?>"><b>支付宝扫一扫</b></li>
										<?php } ?>
										<?php if(suxingme('suxingme_wxreward') or get_the_author_meta( 'wxpay' )) { ?>
											<li class="weixinpay"><img alt="打赏" src="<?php if ( get_the_author_meta( 'wxpay' ) ){echo get_the_author_meta( 'wxpay' );}else{echo suxingme('suxingme_wxreward') ;}?>"><b>微信扫一扫</b></li>
										<?php } ?>	
									</ul>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php if(!wp_is_mobile()): echo single_pc_ad_pic(); endif; if(wp_is_mobile()): echo single_mini_ad_pic(); endif;?>
					<?php if(suxingme('nextprevposts',true)) { ?>
						<div class="next-prev-posts clearfix">
							
							<?php 	
								$next_class = '';
								$prev_class = '';
								$prev_post = get_previous_post(false,'');
								$next_post = get_next_post(false,'');

								if ( empty( $prev_post ) ) : 
									$next_class = 'style="width:100%;"';
								endif;

								if(empty( $next_post )): 
									$prev_class = 'style="width:100%;"';
								endif;
								
								if ( !empty( $prev_post ) ) : ?>
									<div class="prev-post" <?php echo $prev_class; ?>>
										<a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo $prev_post->post_title; ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?> class="prev has-background" style="background-image: url(<?php $prev_img = get_post_thumbnail_url($prev_post->ID); echo !empty( $prev_img ) ? $prev_img : suxingme('suxingme_p_n_bgp'); ?>)" alt="<?php echo $prev_post->post_title; ?>">	
											<span>上一篇</span><h4><?php echo $prev_post->post_title; ?></h4>
										</a> 
									</div> 
								<?php endif;

								if(!empty( $next_post )): ?>
									<div class="next-post" <?php echo $next_class; ?>>
										<a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo $next_post->post_title; ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?> class="next has-background" style=" background-image: url(<?php $next_img = get_post_thumbnail_url($next_post->ID); echo !empty( $next_img ) ? $next_img : suxingme('suxingme_p_n_bgp'); ?>)" alt="<?php echo $next_post->post_title; ?>">	
											<span>下一篇</span><h4><?php echo $next_post->post_title; ?></h4>
										</a> 
									</div> 
								<?php endif;?>
						
						</div>
					<?php } ?>	 
				</div>
				
				<?php if(suxingme('related-post',true)) {  include get_template_directory() . '/includes/relatepost.php'; }?>

				<div class="clear"></div>
				<?php if (comments_open()) comments_template( '', true ); endwhile;  endif; ?>	
			</div>	
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
