<?php
//切换标签插件
//widget suxingme_mostviews

add_action('widgets_init', create_function('', 'return register_widget("suxingme_mostviews");'));
class suxingme_mostviews extends WP_Widget {

    function __construct() {
    	$widget_ops = array('description' => '默认显示30天内，浏览次数最多的图文列表');
    	parent::__construct('suxingme_mostviews', '热门浏览 ', $widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );

		$limit = $instance['limit'];
		$time = $instance['time'];
		$cat = $instance['cat'];
		$title = apply_filters('widget_name', $instance['title']);
		echo $before_widget;
		echo $before_title.$title.$after_title; 
        echo suxingme_widget_mostviews($limit,$time,$cat);
        echo $after_widget;	
    }

		function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		$instance['time'] = strip_tags($new_instance['time']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '最热点击文章',
			'limit' => '5',
			'time' => '3 month ago',
			) 
		);
		$title = strip_tags($instance['title']);
		$limit = strip_tags($instance['limit']);
		$instance['cat'] = ! empty( $instance['cat'] ) ? esc_attr( $instance['cat'] ) : '';
		
?>
<p>
	<label> 显示标题：（例如：最热点击排行榜）
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</label>
</p>
<p>
	<label>
		显示某个时间段：
		
		<input class="widefat" id="<?php echo $this->get_field_id('time'); ?>" name="<?php echo $this->get_field_name('time'); ?>" type="text" value="<?php echo $instance['time']; ?>" />
		<p>填写格式：（注意空格）</p>
		<p>1周内：1 week ago</p>
		<p>1月内：1 month ago</p>
		<p>1年内：1 year ago</p>
		
	</label>
</p>

<p>
	<label> 显示文章数目：
		<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
	</label>
</p>
<p>
	<label>
		分类限制：
		<a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的">？</a>
		<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
	</label>
</p>
<p><?php show_category() ?><br/><br/></p>
<?php
	}
}

function suxingme_widget_mostviews($limit,$time,$cat){ 
?>
		
             <?php 
                $args = array(
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                    'posts_per_page'    => $limit,
					'cat'              => $cat,
					'meta_key' 			=> 'views',
					'orderby'  => array('meta_value_num' => 'DESC', 'date' => 'DESC'),
					'ignore_sticky_posts' => 1,
					'date_query' => array(
						array(
						'after' => $time,
						),
					),
					'tax_query' => array( array( 
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							//请根据需要保留要排除的文章形式
							'post-format-aside',
							
							),
						'operator' => 'NOT IN',
						) ),
                );
				
				$hot_posts = new WP_Query( $args );
				if ( !$hot_posts->have_posts() ) :?>
				<p>暂无文章</p>
				<?php else:
				while ( $hot_posts->have_posts() ) :
					$hot_posts->the_post(); ?>
					<li>
						<a class="img" href="<?php the_permalink(); ?>"	title="<?php the_title(); ?>">
							<i class="icon-forward"></i>
							<?php if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { ?>
								<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=175&w=315.98&zc=1" src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" alt="<?php the_title(); ?>" />	
							<?php }
							if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {	?>
								<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=175&w=315.98&zc=1" alt="<?php the_title(); ?>" />
							<?php } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){ ?>
								<img src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" data-original="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="lazy thumbnail" />
							<?php } ?>
							<?php if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){ ?>
								<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
							<?php } ?> 					
						</a>	
							<div class="title">
								<div class="entry-meta"><span><i class="icon-eye"></i> <?php post_views('',''); ?></span><span><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span></div>
								<h4><a href="<?php the_permalink(); ?>"	title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
							</div>
							
						
					
					
					</li>

					
				 <?php endwhile; wp_reset_query();endif; ?>
		
<?php }?>
