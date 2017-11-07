<?php
///删除 wp_head 中无关紧要的代码
remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'noindex', 1 );
remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );//禁用 REST API 及去除相应链接
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10 );
remove_filter('oembed_response_data',   'get_oembed_response_data_rich',  10, 4);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
show_admin_bar( false );
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'the_content', 'capital_P_dangit' );
remove_filter( 'the_content', 'wptexturize');//禁止代码标点转换
remove_filter( 'comment_text', 'capital_P_dangit' );
/*//删除仪表盘模块
function example_remove_dashboard_widgets() {
    // Globalize the metaboxes array, this holds all the widgets for wp-admin
    global $wp_meta_boxes;
    // 以下这一行代码将删除 "快速发布" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    // 以下这一行代码将删除 "引入链接" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    // 以下这一行代码将删除 "插件" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    // 以下这一行代码将删除 "近期评论" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    // 以下这一行代码将删除 "近期草稿" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    // 以下这一行代码将删除 "WordPress 开发日志" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    // 以下这一行代码将删除 "其它 WordPress 新闻" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    // 以下这一行代码将删除 "概况" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
//add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );
remove_action('welcome_panel', 'wp_welcome_panel');
function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//3.8版开始
}
add_action( 'admin_init', 'remove_dashboard_meta' );

function custom_logo() {
  echo '<style type="text/css">
    #wp-admin-bar-wp-logo { display: none !important; }
    </style>';
}
add_action('admin_head', 'custom_logo');
// 移除后台底部右侧版权
function modify_footer_version() {
	return 'Powered By <a href="http://WordPress.org" target="_blank">WordPress</a>';
} 
add_filter( 'update_footer', 'modify_footer_version', 9999);*/

//自定义后台版权
function remove_footer_admin () {
echo '感谢选择 <a href="www.suxing.me" target="_blank">苏醒WP建站</a> 为您设计！</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

?>