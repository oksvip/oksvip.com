<?php

/* -- 支持海外主题就是不支持国内主题 */
/*if (is_admin()) {
	$theme_name = 'Grace';
	$mee_api = 'http://yun.api.suxing.me/';
	if (!function_exists('curl_init')) {
		wp_die('主机不支持curl，请联系主机服务商。');
	}
	function mee_curl_get_contents($_var_0, $_var_1 = 30)
	{
		$_var_2 = curl_init();
		curl_setopt($_var_2, CURLOPT_URL, $_var_0);
		curl_setopt($_var_2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($_var_2, CURLOPT_TIMEOUT, $_var_1);
		$_var_3 = curl_exec($_var_2);
		curl_close($_var_2);
		return $_var_3;
	}
	function GetUrlToDomain($_var_4, $_var_5)
	{
		$_var_6 = get_option('_nice_domain_' . $_var_4);
		if ($_var_6) {
			return $_var_6;
		} else {
			$_var_7 = '';
			$_var_8 = mee_curl_get_contents($_var_5 . '?do=get_weiba');
			$_var_9 = json_decode($_var_8, !0);
			$_var_10 = explode('.', $_var_4);
			$_var_11 = count($_var_10) - 1;
			if ($_var_10[$_var_11] == 'cn') {
				if (in_array($_var_10[$_var_11 - 1], $_var_9)) {
					$_var_7 = $_var_10[$_var_11 - 2] . '.' . $_var_10[$_var_11 - 1] . '.' . $_var_10[$_var_11];
				} else {
					$_var_7 = $_var_10[$_var_11 - 1] . '.' . $_var_10[$_var_11];
				}
			} else {
				$_var_7 = $_var_10[$_var_11 - 1] . '.' . $_var_10[$_var_11];
			}
			update_option('_nice_domain_' . $_var_4, $_var_7);
			return $_var_7;
		}
	}
	if (defined('WP_HOME')) {
		if (is_ssl()) {
			$site_str = str_replace('https://', '', WP_HOME);
		} else {
			$site_str = str_replace('http://', '', WP_HOME);
		}
	} else {
		if (is_ssl()) {
			$site_str = str_replace('https://', '', home_url());
		} else {
			$site_str = str_replace('http://', '', home_url());
		}
	}
	$strdomain = explode('/', $site_str);
	$domain = $strdomain[0];
	$deldomain = GetUrlToDomain($domain, $mee_api);
	if (isset($_GET['do']) && $_GET['do'] == 'activeapi') {
		$sd = '{"copyright":"200"}';
		$sdapi = json_decode($sd, !0);
		update_option('_nice_' . $theme_name . '_' . $deldomain, $sdapi);
	}
	if (isset($_GET['do']) && $_GET['do'] == 'delelteapi') {
		update_option('_nice_' . $theme_name . '_' . $deldomain, '');
	}
	$mee_themes_key = get_option('_nice_' . $theme_name . '_' . $deldomain);
	if ($mee_themes_key) {
		$copyright = (int) $mee_themes_key['copyright'];
	} else {
		$copyright = 400;
	}
	if ($copyright == 400 || $mee_themes_key && $copyright != 200) {
		$c_api = mee_curl_get_contents($mee_api . '?domain=' . $deldomain . '&theme=' . $theme_name);
		$api = json_decode($c_api, !0);
		update_option('_nice_' . $theme_name . '_' . $deldomain, $api);
		$api_copyright = (int) $api['copyright'];
		switch ($api_copyright) {
			case 200:
				break;
			default:
				header('Content-type: text/html; charset=utf-8');
				wp_die('您未获得' . $theme_name . '主题的授权，请联系苏醒：<a href="https://www.suxing.me/i?a=qq">获取授权</a>', '授权提示');
				break;
		}
	}
}*/
date_default_timezone_set('PRC');
define('THEME_VERSION', 'Grace6');
define('THEME_URI', get_stylesheet_directory_uri());
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once get_template_directory() . '/inc/options-framework.php';
require get_template_directory() . '/includes/pagemetabox.php';
require get_template_directory() . '/includes/widgets/index.php';
require get_template_directory() . '/functions_suxingme.php';
require get_template_directory() . '/includes/modules/categories-images.php';
require get_template_directory() . '/includes/metabox.php';
require get_template_directory() . '/ajax-comment/do.php';
require get_template_directory() . '/includes/modules/comments.php';
require get_template_directory() . '/simple-local-avatars.php';
require get_template_directory() . '/includes/modules/canonical.php';
require get_template_directory() . '/includes/wp-alu/functions.php';
require get_template_directory() . '/includes/modules/breadcrumbs.php';
//禁用自动保存（方法一）
add_action( 'admin_print_scripts', create_function( '$a', "wp_deregister_script('autosave');" ) );
//禁用自动保存（方法二）
add_action('wp_print_scripts', 'fanly_no_autosave'); function fanly_no_autosave() { wp_deregister_script('autosave'); }
//禁用所有文章类型的修订版本
add_filter( 'wp_revisions_to_keep', 'fanly_wp_revisions_to_keep', 10, 2 ); function fanly_wp_revisions_to_keep( $num, $post ) { return 0;}
/**
 * WordPress 后台禁用Google Open Sans字体，加速网站
 * https://www.wpdaxue.com/disable-google-fonts.html
 */
add_filter( 'gettext_with_context', 'wpdx_disable_open_sans', 888, 4 );
function wpdx_disable_open_sans( $translations, $text, $context, $domain ) {
  if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
    $translations = 'off';
  }
  return $translations;
}

// 替换图片链接为https
function https_image_replacer($content){
    if( is_ssl() ){
        /*已经验证使用 $_SERVER['SERVER_NAME']也可以获取到数据，但是貌似$_SERVER['HTTP_HOST']更好一点*/
        $host_name = $_SERVER['HTTP_HOST'];
        $http_host_name='http://'.$host_name.'/wp-content/uploads';
        $https_host_name='https://'.$host_name.'/wp-content/uploads';
        $content = str_replace($http_host_name, $https_host_name, $content);
    }
    return $content;
}
add_filter('the_content', 'https_image_replacer');

/* 去除链接的category开始 */
add_action( 'load-themes.php',  'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
function no_category_base_refresh_rules() {
    global $wp_rewrite;
    $wp_rewrite -> flush_rules();
}
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
    global $wp_rewrite, $wp_version;
    if (version_compare($wp_version, '3.4', '<')) {         // For pre-3.4 support         $wp_rewrite -> extra_permastructs['category'][0] = '%category%';
    } else {
        $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
    }
}
// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
    $category_rewrite = array();
    $categories = get_categories(array('hide_empty' => false));
    foreach ($categories as $category) {
        $category_nicename = $category -> slug;
        if ($category -> parent == $category -> cat_ID)// recursive recursion
            $category -> parent = 0;
        elseif ($category -> parent != 0)
            $category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
        $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
    }
    // Redirect support from Old Category Base
    global $wp_rewrite;
    $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
    $old_category_base = trim($old_category_base, '/');
    $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';
    
    return $category_rewrite;
}
    
// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
    $public_query_vars[] = 'category_redirect';
    return $public_query_vars;
}
    
// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
    if (isset($query_vars['category_redirect'])) {
        $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
        status_header(301);
        header("Location: $catlink");
        exit();
    }
    return $query_vars;
}
/* 去除链接的category结束 */
// 代码高亮代码
function add_prism() {
        wp_register_style(
            'prismCSS', 
            get_stylesheet_directory_uri() . '/prism.css' //自定义路径
         );
          wp_register_script(
            'prismJS',
            get_stylesheet_directory_uri() . '/js/prism.js'   //自定义路径
         );
        wp_enqueue_style('prismCSS');
        wp_enqueue_script('prismJS');
    }
add_action('wp_enqueue_scripts', 'add_prism');

if (suxingme('suxingme_post_like', !0)) {
	include_once get_template_directory() . '/includes/modules/like.php';
}
if (suxingme('friendly', !0)) {
	include_once get_template_directory() . '/includes/modules/friendlyimages.php';
}
if (suxingme('suxingme_keywordlink', !1)) {
	include_once get_template_directory() . '/includes/modules/keywordlink.php';
}
if (suxingme('suxingme_fancybox', !1)) {
	include_once get_template_directory() . '/includes/modules/fancybox.php';
}
if (suxingme('suxingme_autonofollow', !1)) {
	include_once get_template_directory() . '/includes/modules/autonofollow.php';
}
if (suxingme('suxingme_wphead', !0)) {
	include_once get_template_directory() . '/includes/modules/wphead.php';
}
if (suxingme('suxingme_ajax_posts', !0)) {
	include_once get_template_directory() . '/includes/modules/ajaxpost.php';
}
function remove_open_sans()
{
	wp_deregister_style('open-sans');
	wp_register_style('open-sans', !1);
	wp_enqueue_style('open-sans', '');
}
add_action('init', 'remove_open_sans');
register_nav_menu('top-nav', '导航菜单');
register_nav_menu('mobile-nav', '移动端菜单');
register_nav_menu('footer-nav', '底部菜单');
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($_var_12)
{
	return is_array($_var_12) ? array_intersect($_var_12, array('current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent', 'menu-item-has-children')) : '';
}
if (function_exists('register_sidebar')) {
	register_sidebar(array('name' => '全站侧栏', 'id' => 'widget_right', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '首页侧栏', 'id' => 'widget_sidebar', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '文章页侧栏', 'id' => 'widget_post', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '页面侧栏', 'id' => 'widget_page', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '分类/标签/搜索页侧栏', 'id' => 'widget_other', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
}
add_action('media_buttons_context', 'mee_insert_post_custom_button');
function mee_insert_post_custom_button($_var_13)
{
	$_var_13 .= '<button type="button" id="insert-media-button" class="button insert-post-embed" data-editor="content"><span class="dashicons dashicons-pressthis"></span>插入指定文章</button><div class="smilies-wrap"></div><script>jQuery(document).ready(function(){jQuery(document).on("click", ".insert-post-embed",function(){var post_id=prompt("输入文章ID，多个文章，使用英文逗号隔开","");if (post_id!=null && post_id!=""){send_to_editor("[suxing_insert_post ids="+ post_id +"]");}return false;});});</script>';
	return $_var_13;
}
function suxingme_head_css()
{
	$_var_14 = '';
	if (suxingme('suxingme_site_gray')) {
		$_var_14 .= 'html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}';
	}
	if (suxingme('theme_skin_custom')) {
		$_var_15 = suxingme('theme_skin_custom');
		$_var_16 = $_var_15;
	} else {
		$_var_15 = suxingme('theme_skin');
		$_var_16 = '#' . $_var_15;
	}
	if ($_var_15 && $_var_15 !== '19B5FE' && suxingme('suxingme_site_gray_turn')) {
		$_var_14 .= "#top-slide .owl-item .slider-content .post-categories a,#top-slide .owl-item .slider-content .slider-title h2:after,.comments-title:after,.sx-box h3:after,#top-slide .owl-item .slider-content .read-more a:hover,.posts-default-title h2:after,#ajax-load-posts a, #ajax-load-posts span, #ajax-load-posts button,.post-title .title:after,#commentform .form-submit input[type='submit'],.tag-clouds .tagname:hover,.cat ul li .title span,#top-slide-three .slider-content .slider-content-box .slider-content-item .post-categories a{background-color:{$_var_16};}a:hover,.authors_profile .author_name a{color:{$_var_16};}#ajax-load-posts a:hover,#ajax-load-posts button:hover{background-color:#273746}#header .search-box form button:hover, #header .primary-menu ul > li > a:hover, #header .primary-menu ul > li:hover > a, #header .primary-menu ul > li.current-menu-ancestor > a, #header .primary-menu ul > li.current-menu-item > a, #header .primary-menu ul > li .sub-menu li.current-menu-item > a, #header .primary-menu ul > li .sub-menu li a:hover, #menu-mobile a:hover{color:{$_var_16};}@media screen and (max-width: 767px){#header .search-box form button{background-color:{$_var_16};}}.widget h3{color:{$_var_16};border-color:{$_var_16}}.comment-form-smilies .smilies-box a:hover{border-color:{$_var_16}}.widget h3:after{background-color:{$_var_16};}";
	}
	$_var_14 .= suxingme('csscode');
	if ($_var_14) {
		echo '<style>' . $_var_14 . '</style>';
	}
}
add_action('wp_head', 'suxingme_head_css');
function get_links_category()
{
	$_var_17 = get_terms('link_category');
	$_var_18 .= '<div class="show-links-id"><p>相关的链接分类ID：</p><ul>';
	foreach ($_var_17 as $_var_19 => $_var_20) {
		$_var_18 .= '<li>' . $_var_20->name . '（' . $_var_20->term_id . '）</li>';
	}
	$_var_18 .= '</ul></div>';
	return $_var_18;
}
function suxingme_add_page($_var_21, $_var_22, $_var_23 = '')
{
	$_var_24 = get_pages();
	$_var_25 = !1;
	foreach ($_var_24 as $_var_26) {
		if (strtolower($_var_26->post_name) == strtolower($_var_22)) {
			$_var_25 = !0;
		}
	}
	if ($_var_25 == !1) {
		$_var_27 = wp_insert_post(array('post_title' => $_var_21, 'post_type' => 'page', 'post_name' => $_var_22, 'comment_status' => 'closed', 'ping_status' => 'closed', 'post_content' => '', 'post_status' => 'publish', 'post_author' => 1, 'menu_order' => 0));
		if ($_var_27 && $_var_23 != '') {
			update_post_meta($_var_27, '_wp_page_template', $_var_23);
		}
	}
}
function suxingme_add_pages()
{
	global $pagenow;
	if ('themes.php' == $pagenow && isset($_GET['activated'])) {
		suxingme_add_page('热门标签', 'tags-page', 'pages/page-tags.php');
		suxingme_add_page('友情链接', 'links-page', 'pages/page-links.php');
		suxingme_add_page('年度归档', 'archives-page', 'pages/page-archives.php');
		suxingme_add_page('人气文章排行榜', 'like-page', 'pages/page-like.php');
	}
}
add_action('load-themes.php', 'suxingme_add_pages');
add_theme_support('post-formats', array('gallery', 'aside', 'image', 'link'));
function rename_post_formats($_var_28)
{
	if ($_var_28 == '相册') {
		return '左图模版';
	}
	if ($_var_28 == '图像') {
		return '多图模版';
	}
	if ($_var_28 == '日志') {
		return '无图模版';
	}
	if ($_var_28 == '链接') {
		return '推广模版';
	}
	return $_var_28;
}
add_filter('esc_html', 'rename_post_formats');
add_action('wp_head', 'wow_duang');
function wow_duang()
{
	$GLOBALS['wow_slide'] = $GLOBALS['wow_3cat'] = $GLOBALS['wow_single_list'] = $GLOBALS['wow_loadmore_btn'] = $GLOBALS['wow_sidebar'] = $GLOBALS['wow_single_embed_post'] = $GLOBALS['wow_single_related'] = '';
	if (is_home()) {
		if (suxingme('suxing_wow_index_slide', !1)) {
			$GLOBALS['wow_slide'] = 'wow bounceInDown';
		}
		if (suxingme('suxing_wow_index_3cat', !1)) {
			$GLOBALS['wow_3cat'] = 'wow zoomIn';
		}
	}
	if (is_category() || is_home() || is_search()) {
		if (suxingme('suxing_wow_single_list', !0)) {
			$GLOBALS['wow_single_list'] = 'wow bounceInUp';
		}
		if (suxingme('suxing_wow_loadmore_btn', !0)) {
			$GLOBALS['wow_loadmore_btn'] = 'wow zoomIn';
		}
	}
	if (is_single()) {
		if (suxingme('suxing_wow_single_embed_post', !1)) {
			$GLOBALS['wow_single_embed_post'] = 'wow zoomIn';
		}
		if (suxingme('suxing_wow_single_related', !1)) {
			$GLOBALS['wow_single_related'] = 'wow zoomIn';
		}
	}
	if (suxingme('suxing_wow_sidebar', !1)) {
		$GLOBALS['wow_sidebar'] = 'wow bounceInRight';
	}
	if (is_single() || is_page()) {
		if (function_exists('get_query_var')) {
			$_var_29 = intval(get_query_var('page'));
			$_var_30 = intval(get_query_var('comment-page'));
		}
		if (!empty($_var_29) || !empty($_var_30)) {
			echo '
			';
			echo '<meta name="robots" content="noindex, nofollow" />';
			echo '
			';
		}
	}
}
add_filter('user_contactmethods', 'suxingme_add_contact_fields');
function suxingme_add_contact_fields($_var_31)
{
	$_var_31['alipay'] = '支付宝二维码图片链接';
	$_var_31['wxpay'] = '微信二维码图片链接';
	return $_var_31;
}
add_filter('get_avatar', 'sutheme_avatar', 10, 3);
function sutheme_avatar($_var_32)
{
	if (!is_admin() && suxingme('suxingme_timthumb_lazyload', !0) || $_SERVER['PHP_SELF'] == '/wp-admin/admin-ajax.php' && suxingme('suxingme_timthumb_lazyload', !0)) {
		$_var_32 = str_replace('src=', 'src="' . suxingme('new_avatar_pic') . '" data-original=', $_var_32);
	}
	if (suxingme('suxingme_get_avatar', 'two') == 'two') {
		$_var_32 = str_replace(array('www.gravatar.com/avatar', '0.gravatar.com/avatar', '1.gravatar.com/avatar', '2.gravatar.com/avatar'), 'cdn.v2ex.com/gravatar', $_var_32);
	}
	return $_var_32;
}
