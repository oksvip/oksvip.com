<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
function optionsframework_options() {

// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '选择页面：';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	$options_metainfo = array(
		'author' => '作者',
		'cat' => '分类',
		'time' => '时间',
		'view' => '浏览量',
		'like' => '喜欢'
	);
	
	$wp_editor_settings = array(
		'wpautop' => true, // 默认
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	$topslide_array = array(		
		'DESC' => __('默认排序'),
		'date' => __('时间排序'),
		'rand' => __('随机排序')
	);
	$avatar_array = array(		
		'one' => 'WP默认',
		'two' => 'V2EX',		
	);

	$index3_array = array(		
		'one' => '显示分类',
		'two' => '显示顶置文章',
		'three' => '关闭',	
	);


    $options_links = array();
    $options_links_obj = get_terms( 'link_category' );
    foreach ($options_links_obj as $link) {
        $options_links[$link->term_id] = $link->name;
    }

	$imagepath =  get_template_directory_uri() . '/img/themestyle/';

	$options = array();
	
	/*****基本设置*****/
	$options[] = array(
		'name' => __('基本设置'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('PC端顶部Logo'),
		'desc' => __('上传一个尺寸为宽220px，高50px的图片，或者直接输入图片地址'),
		'id' => 'suxingme_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('移动端顶部Logo'),
		'desc' => __('上传一个尺寸为高38px的图片，或者直接输入图片地址'),
		'id' => 'suxingme_mlogo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('后台登陆Logo'),
		'desc' => __('请上传一个尺寸为280*84的Logo文件或是输入文件URL'),
		'id' => 'suxingme_login_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('作者小工具背景图'),
		'desc' => __('请上传一个作者背景图片或是输入图片URL'),
		'id' => 'suxingme_author_bgp',
		'type' => 'upload');

	$options[] = array(
		'name' => __('网站Favicon地址'),
		'desc' => __('输入Favicon文件URL,或者直接替换主题img文件夹中的Favicon文件。&#28304;&#65;&#30721;&#83;&#30001;&#68;&#25240;&#70;&#32764;&#71;&#22825;&#86;&#20351;&#66;&#36164;&#78;&#28304;&#78;&#31038;&#77;&#21306;&#77;&#25552;&#82;&#20379;'),
		'id' => 'suxingme_favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('文章页上下篇背景图'),
		'desc' => __('请上传一个文章页上一篇和下一篇默认的背景图片或是输入图片URL'),
		'id' => 'suxingme_p_n_bgp',
		'type' => 'upload');

	$options[] = array(
		'name' => __('网站统计代码'),
		'desc' => sprintf( __( '如百度统计、CNZZ、Google Analytics，不填则不显示' ) ),
		'id' => 'suxingme_statistics_code',
		'type' => 'textarea');

		
	$options[] = array(
		'name' => __('网站备案号'),
		'desc' => __('在显示网站底部，没有备案号可不填。不填则不显示'),
		'id' => 'suxingme_beian',
		"class" => "mini",
		'type' => 'text');
		
	/*****SEO优化*****/
	$options[] = array(
		'name' => __('SEO优化'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('主题自带SEO设置'),
		'id' => 'suxingme_dis_seo',
		'std' => true,
		'desc' => __('关闭之后，请自行安装SEO插件，下方填写的连接符，描述和关键词将无效。'),
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('网站标题连接符'),
		'desc' => __('一经选择，切勿更改，对SEO不友好，一般为“-”或“_”'),
		'id' => 'page_sign',
		'std' => '-',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('网站描述'),
		'desc' => __('SEO设置，输入您的网站描述，一般不超过200字符'),
		'id' => 'suxingme_description',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('网站关键词'),
		'desc' => sprintf( __( 'SEO设置，输入您的网站关键词，以英文逗号(,)隔开。' ) ),
		'id' => 'suxingme_keywords',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => __('启动面包屑导航(Breadcrumb)'),
		'id' => 'suxingme_breadcrumbs',
		'std' => false,
		'desc' => __('显示在文章页面及分类列表页面中'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章外链自动添加nofollow属性'),
		'id' => 'suxingme_autonofollow',
		'std' => false,
		'desc' => __('防止外链分散了网站内页的权重'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章tag关键词自动描文本'),
		'id' => 'suxingme_keywordlink',
		'std' => false,
		'desc' => __('自动描文本,优化seo'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('自动给文章图片添加Alt信息'),
		'id' => 'friendly',
		'std' => true,
		'desc' => __(''),
		'type' => 'checkbox');

		/*****网站加速/优化设置*****/
	$options[] = array(
		'name' => __('网站加速/优化'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('网站导航智能显示'),
		'id' => 'suxingme_head_fixed',
		'std' => true,
		'desc' => __('默认开启，关闭之后导航将固定在顶部'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章列表AJAX加载文章'),
		'id' => 'suxingme_ajax_posts',
		'desc' => __('启动后，文章翻页按钮改为：【加载更多】，取消分页显示文章列表'),
		'std' => true,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('文章列表使用TimThumb进行截取缩略图'),
		'id' => 'suxingme_timthumb',
		'desc' => __('设置后，请使用ftp工具或者putty或类似的SSH工具登陆VPS或服务器，给主题文件夹中的cache文件夹和TimThumb.php文件设置755权限，否则会出现图片无法读取显示的情况。'),
		'std' => false,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('设置文章默认缩略图'),
		'id' => 'suxingme_post_thumbnail',
		'desc' => __('当文章无图或者没有指定特色图像的时候，默认显示该张图片作为文章缩略图'),
		'std' => '',
		'type' => 'upload');

	
	$options[] = array(
		'name' => __('图片延迟加载'),
		'id' => 'suxingme_timthumb_lazyload',
		'std' => true,
		'desc' => __(''),
		'type' => 'checkbox');	
		
	$options[] = array(
		'name' => __('延迟加载默认图片-小图'),
		'desc' => __('请上传一个尺寸为240*160的图片文件或是输入文件URL'),
		'id' => 'default_thumbnail',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('延迟加载默认图片-大图'),
		'desc' => __('请上传一个尺寸为760*300的图片文件或是输入文件URL'),
		'id' => 'default_thumbnail_700',
		'type' => 'upload');

	$options[] = array(
		'name' => __('文章页图片fancybox暗箱功能'),
		'id' => 'suxingme_fancybox',
		'std' => false,
		'desc' => __('打开后，文章中如带【有图片链接的图片】，点击都将是弹窗显示。'),
		'type' => 'checkbox');	

	$options[] = array(
		'name' => __('文章分类显示文章TAG标签'),
		'id' => 'suxingme_post_tags',
		'std' => true,
		'desc' => __('默认开启'),
		'type' => 'checkbox');	

	$options[] = array(
		'name' => __('默认头像'),
		'desc' => __('新增自定义默认头像,自定义头像设置之后会存在等待缓存周期，请不要捉急。在后台-》设置-》讨论 中选择新增的默认头像即可。如果您有翻墙工具可以开启全局模式访问一次网站，生效会很快。如果没有，可以到<a target="_blank" href="https://www.tizipuss.com/?grace">这里</a>购买一个，科学上网，谷歌搜索等必须的。'),
		'id' => 'new_avatar_pic',
        'std' => get_template_directory_uri() . '/img/avatar.png',
		'type' => 'upload');	
	
	$options[] = array(
		'name' => __('Gravatar 头像调用渠道'),
		'desc' => __('默认使用【V2EX】'),
		'id' => 'suxingme_get_avatar',
		'std' => 'two',
		'type' => 'radio',	
		'options' => $avatar_array);	

	$options[] = array(
		'name' => __('文章页每段文字首行缩进2个字符'),
		'id' => 'suxingme_text_indent',
		'std' => false,
		'desc' => __(''),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('根据上传时间重命名上传的图片文件'),
		'id' => 'suxingme_upload_filter',
		'std' => true,
		'desc' => __('', 'options_framework_theme）'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章评论中禁止含有链接的评论（防垃圾评论机制）'),
		'id' => 'suxing_comment_no_html',
		'std' => true,
		'desc' => __('', 'options_framework_theme）'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章评论中禁止全英文评论（防垃圾评论机制）'),
		'id' => 'suxing_some_chinese',
		'std' => true,
		'desc' => __('', 'options_framework_theme）'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('禁用所有文章类型的修订版本'),
		'id' => 'revisions_to_keep',
		'std' => true,
		'desc' => __('', 'options_framework_theme）'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('删除 wp_head 中无关紧要的代码'),
		'id' => 'suxingme_wphead',
		'std' => true,
		'desc' => __(''),
		'type' => 'checkbox');



	/*****网站配色设置*************/
	$options[] = array(
		'name' => __('网站配色设置'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('网站整体变灰'),
		'id' => 'suxingme_site_gray',
		'std' => false,
		'desc' => __('使网站变灰，支持IE、Chrome，基本上覆盖了大部分用户，不会降低访问速度'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('网站换色功能'),
		'id' => 'suxingme_site_gray_turn',
		'std' => false,
		'desc' => __('开启之后支持网站主题风格自定义，默认关闭。'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __("主题风格"),
		'desc' => __("3种颜色供选择，点击选择你喜欢的颜色，保存后前端展示会有所改变。"),
		'id' => "theme_skin",
		'std' => "19B5FE",
		'type' => "colorradio",
		'options' => array(
			'273746' => 1,
			'19B5FE' => 2,
			'00D6AC' => 3,
		)
	);

	$options[] = array(
		'id' => 'theme_skin_custom',
		'std' => "",
		'desc' => __('不喜欢上面提供的颜色，你好可以在这里自定义设置，如果不用自定义颜色清空即可（默认不用自定义）'),
		'type' => "color");

	/*******CMS设置*******/
	$options[] = array(
		'name' => __('CMS设置'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('顶部通知'),
		'desc' => __('开启顶部通知。调取的分类需要填写下方输入框。'),
		'id' => 'suxingme_top_g',
		'std' => false,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('通知调取的分类'),
		'desc' => __('选择通知调取的分类，需要分类有文章'),
		'id' => 'suxingme_top_g_cat',
		'type' => 'select',
		'options' => $options_categories);

	$options[] = array(
		'name' => __('通知显示数'),
		'desc' => __('填写显示通知的数量,默认5条'),
		'id' => 'suxingme_top_g_cat_num',
		'std' => 5,
		"class" => "mini",
		'type' => 'text');

	$options[] = array(
		'name' => __('通知小红点'),
		'desc' => __('多少天内有更新则显示小红点，默认1天'),
		'id' => 'suxingme_top_g_red',
		'std' => 1,
		"class" => "mini",
		'type' => 'text');

	$options[] = array(
		'name' => __('首页3个区块'),
		'desc' => __('选择首页3个区块显示分类还是顶置文章。需要填写下方输入框。'),
		'id' => 'suxingme_get_index3',
		'std' => 'one',
		'type' => 'radio',	
		'options' => $index3_array);
		
	$options[] = array(
		'name' => __('首页3个区块-显示的分类'),
		'desc' => __('如果你想在首页显示指定分类及它的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2）,后台-文章-分类 上传封面图。'),
		'id' => 'suxing_cat_index',
		"class" => "mini",
		'type' => 'text');

	
	$options[] = array(
		'name' => __('首页显示自定义分类TAB'),
		'desc' => __('开启后，首页将显示自定义分类的TAB选项[需要开启文章列表AJAX加载]'),
		'id' => 'suxing_index_custom_cat_tab',
		'std' => false,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('首页显示自定义分类TAB-显示的分类'),
		'desc' => __('如果你想在首页自定义分类TAB显示指定分类，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2）'),
		'id' => 'suxing_index_custom_cat_tab_id',
		"class" => "mini",
		'type' => 'text');	

	$options[] = array(
		'name' => __('幻灯4标题'),
		'desc' => __('自定义幻灯4标题，默认为头条'),
		'id' => 'suxing_index_custom_slide4_title',
		'std' => '头条',
		"class" => "mini",
		'type' => 'text');

	$options[] = array(
		'name' => __('首页显示最新文章模块及右侧栏'),
		'id' => 'suxingme_new_post',
		'std' => true,
		'desc' => __('最新文章模块：在首页中，按时间排序显示全站文章。'),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('不显示指定分类中的文章（从首页最新文章模块中）'),
		'desc' => __('在分类前打扣即不显示该分类的文章。'),
		'id' => 'notinhome',
		'options' => $options_categories,
		'type' => 'multicheck');

	$options[] = array(
        'name' => "底部（Footer）样式",
        'desc' => "选择你喜欢的Footer样式",
        'id' => "suxingme_footer_style",
        'std' => "suxingme_footer_style_1",
        'type' => "images",
        'options' => array(
            'suxingme_footer_style_1' => $imagepath . 'footer1.png',
            'suxingme_footer_style_2' => $imagepath . 'footer2.png',
        )
    );

    $options[] = array(
        'name' => '底部友情链接',
        'desc' => '选择一个链接的分类，作为友情链接来显示到底部，需要启动【底部样式二】才可以显示（PS:如果没有显示内容请在 【链接】中新增分类。）',
        'id' => 'select_link_friends',
        'type' => 'select',
        'options' => $options_links
    );

    $options[] = array(
    	'name' => '预定义搜索关键词',
    	'desc' => '按照如下格式填写预定的搜索关键词：每个关键词用英文逗号隔开',
    	'id' => 'suxingme_custom_searchkey',
    	'type' => 'text');


    $options[] = array(
    	'name' => __('文章列表和文章不显示指定meta数据'),
    	'desc' => __('打扣即显示该文章meta数据。'),
    	'id' => 'single_metainfo',
    	'options' => $options_metainfo,
    	'type' => 'multicheck');


	/*******首页幻灯片设置*******/
	$options[] = array(
		'name' => __('首页幻灯片'),
		'type' => 'heading');

	$options[] = array(
		'name' => "首页幻灯样式",
		'desc' => "选择你喜欢的样式",
		'id' => "suxing_slide_img_button",
		'std' => "index_slide_sytle_1",
		'type' => "images",
		'options' => array(
			'index_slide_sytle_1' => $imagepath . 'slide1.png',
			'index_slide_sytle_2' => $imagepath . 'slide2.png',
			'index_slide_sytle_3' => $imagepath . 'slide3.png',
			'index_slide_sytle_4' => $imagepath . 'slide4.png',
			'index_no_slide' => $imagepath . 'noslide.png'
		)
	);


	$options[] = array(
		'name' => __('幻灯片显示文章数量'),
		'desc' => __('首页幻灯片显示文章的数量，默认4篇，不要超过6篇'),
		'id' => 'suxingme_slide_number',
		'std' => '4',
		"class" => "mini",
		'type' => 'text');

	$options[] = array(
		'name' => __('显示指定分类的文章'),
		'desc' => __('首页幻灯片轮播指定分类中的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2），不可留空。如果需要展示推荐的文章，可以在编辑文章时，下方的【文章拓展】中，勾选【推送至首页幻灯片】。'),
		'id' => 'suxingme_slide_fenlei',
		"class" => "mini",
		'type' => 'text');

	$options[] = array(
		'name' => __('显示文章信息（标题、作者信息、摘文等）'),
		'desc' => __('首页幻灯片轮播指定分类中的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2），不可留空。如果需要展示推荐的文章，可以在编辑文章时，下方的【文章拓展】中，勾选【推送至首页幻灯片】。'),
		'id' => 'suxingme_slide_info',
		'std' => true,
		'type' => 'checkbox');


	$options[] = array(
		'name' => __('显示文章顺序'),
		'desc' => __(''),
		'id' => 'suxingme_slide_order',
		'std' => 'DESC',
		'type' => 'radio',
		'options' => $topslide_array);

	$options[] = array(
		'name' => __('首页幻灯片【手动添加图片版】', 'options_framework_theme'),
		'id' => 'suxingme_slide2',
		'std' => false,
		'desc' => __('展示在首页，此功能具有优先权，选择后，则幻灯会展示手动设置的图片幻灯,并且只支持样式为Slide2和Slide3和Slide4','options_framework_theme'),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('图片1', 'options_framework_theme'),
		'desc' => __('请上传一个尺寸为740*350的图片文件或是输入文件URL', 'options_framework_theme'),
		'id' => 'suxingme_slide_img_1',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('图片1跳转链接', 'options_framework_theme'),
		'desc' => __('填写图片的跳转链接，链接前记得加上“http://”', 'options_framework_theme'),
		'id' => 'suxingme_slide_url_1',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片1文字说明', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'suxingme_slide_title_1',
		'type' => 'text');
	
		
	$options[] = array(
		'name' => __('图片2', 'options_framework_theme'),
		'desc' => __('请上传一个尺寸为740*350的图片文件或是输入文件URL', 'options_framework_theme'),
		'id' => 'suxingme_slide_img_2',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('图片2跳转链接', 'options_framework_theme'),
		'desc' => __('填写图片的跳转链接，链接前记得加上“http://”', 'options_framework_theme'),
		'id' => 'suxingme_slide_url_2',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片2文字说明', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'suxingme_slide_title_2',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片3', 'options_framework_theme'),
		'desc' => __('请上传一个尺寸为740*350的图片文件或是输入文件URL', 'options_framework_theme'),
		'id' => 'suxingme_slide_img_3',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('图片3跳转链接', 'options_framework_theme'),
		'desc' => __('填写图片的跳转链接，链接前记得加上“http://”', 'options_framework_theme'),
		'id' => 'suxingme_slide_url_3',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片3文字说明', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'suxingme_slide_title_3',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片4', 'options_framework_theme'),
		'desc' => __('请上传一个尺寸为740*350的图片文件或是输入文件URL', 'options_framework_theme'),
		'id' => 'suxingme_slide_img_4',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('图片4跳转链接', 'options_framework_theme'),
		'desc' => __('填写图片的跳转链接，链接前记得加上“http://”', 'options_framework_theme'),
		'id' => 'suxingme_slide_url_4',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片4文字说明', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'suxingme_slide_title_4',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片5', 'options_framework_theme'),
		'desc' => __('请上传一个尺寸为740*350的图片文件或是输入文件URL', 'options_framework_theme'),
		'id' => 'suxingme_slide_img_5',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('图片5跳转链接', 'options_framework_theme'),
		'desc' => __('填写图片的跳转链接，链接前记得加上“http://”', 'options_framework_theme'),
		'id' => 'suxingme_slide_url_5',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片5文字说明', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'suxingme_slide_title_5',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片6', 'options_framework_theme'),
		'desc' => __('请上传一个尺寸为740*350的图片文件或是输入文件URL', 'options_framework_theme'),
		'id' => 'suxingme_slide_img_6',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('图片6跳转链接', 'options_framework_theme'),
		'desc' => __('填写图片的跳转链接，链接前记得加上“http://”', 'options_framework_theme'),
		'id' => 'suxingme_slide_url_6',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('图片6文字说明', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'suxingme_slide_title_6',
		'type' => 'text');		


	/*******文章页优化设置*******/
	$options[] = array(
		'name' => __('文章页优化'),
		'type' => 'heading');


    $options[] = array(
    	'name' => '原创标识文字',
    	'desc' => '自定义原创标识文字',
    	'std' => '原创文章',
    	"class" => "mini",
    	'id' => 'suxingme_custom_cc',
    	'type' => 'text');


	$options[] = array(
		'name' => __('文章页显示作者信息'),
		'desc' => __('默认开启。开启后，作者信息将展示在右侧栏第一位'),
		'id' => 'suxingme_post_author_box',
		'std' => true,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('管理员的称号'),
		'desc' => __('设置管理员的称号，默认为 【官方】'),
		'id' => 'suxing_site_admin_name',
		'std' => '官方',
		"class" => "mini",
		'type' => 'text');	

	$options[] = array(
		'name' => __('文章启动点赞功能'),
		'id' => 'suxingme_post_like',
		'std' => true,
		'desc' => __('免插件文章点赞功能'),
		'type' => 'checkbox');	

	$options[] = array(
		'name' => __('文章页显示百度分享'),
		'id' => 'suxingme_baidushare',
		'std' => true,
		'desc' => __('默认开启', 'options_framework_theme）'),
		'type' => 'checkbox');


	$options[] = array(
		'name' => __('文章页显示上下文图文链接'),
		'desc' => __('默认开启。'),
		'id' => 'nextprevposts',
		'std' => true,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章页显示相关文章模块'),
		'desc' => __('默认开启。'),
		'id' => 'related-post',
		'std' => true,
		'type' => 'checkbox');

	$options[] = array(
    	'name' => '文章页显示相关文章模块-显示文章数量',
    	'desc' => '默认6篇，请填写3的倍数',
    	'std' => '6',
    	'id' => 'related-post-num',
    	"class" => "mini",
    	'type' => 'text');

	$options[] = array(
		'name' => __('作者页面页显示作者信息'),
		'desc' => __('默认开启。开启后，作者信息将展示在右侧栏第一位'),
		'id' => 'suxingme_author_box',
		'std' => true,
		'type' => 'checkbox');


	$options[] = array(
		'name' => __('文章页打赏功能'),
		'desc' => __('默认关闭。开启后请在下方上传二维码图片。'),
		'id' => 'suxingme_reward',
		'std' => false,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('支付宝打赏【默认】二维码上传'),
		'desc' => __('请先开启打赏功能，【不填写则不显示支付宝】，请上传一个尺寸为200*200的图片文件或是输入文件URL。如需每个用户都单独显示各自的支付二维码，请到【后台】-【用户】-【个人资料】中上传。'),
		'id' => 'suxingme_alireward',
		'type' => 'upload');

	$options[] = array(
		'name' => __('微信打赏【默认】二维码上传'),
		'desc' => __('请先开启打赏功能，【不填写则不显示微信】，请上传一个尺寸为200*200的图片文件或是输入文件URL。如需每个用户都单独显示各自的支付二维码，请到【后台】-【用户】-【个人资料】中上传。'),
		'id' => 'suxingme_wxreward',
		'type' => 'upload');

		/*******页面设置*******/
	$options[] = array(
		'name' => __('页面设置'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('友情链接-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'links_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('热门标签-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'tags_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('热门文章列表-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'like_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('归档页面-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'archives_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('网址导航页面-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'pagenav_banner_pic',
		'type' => 'upload');

	/****侧栏随动*****/
	$options[] = array(
		'name' => __('侧栏悬停'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('侧栏随动').__('首页'),
		'id' => 'sideroll_index_s',
		'std' => false,
		'desc' => __('开启后，默认为小工具最后一个栏目随动'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('侧栏随动').__('分类|标签|搜索页'),
		'id' => 'sideroll_list_s',
		'std' => false,
		'desc' => __('开启后，默认为小工具最后一个栏目随动'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('侧栏随动').__('文章页'),
		'id' => 'sideroll_post_s',
		'std' => false,
		'desc' => __('开启后，默认为小工具最后一个栏目随动'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('侧栏随动').__('页面'),
		'id' => 'sideroll_page_s',
		'std' => false,
		'desc' => __('开启后，默认为小工具最后一个栏目随动'),
		'type' => 'checkbox');

	/*******社交链接设置*******/
	$options[] = array(
		'name' => __('社交工具'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('新浪微博链接'),
		'desc' => __('直接输入您的新浪微博链接，别忘了开头带 http:// ，将出现在底栏。'),
		'id' => 'suxingme_social_weibo',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('腾讯微博'),
		'desc' => __('直接输入您的腾讯微博链接，别忘了开头带 http://，将出现在底栏。'),
		'id' => 'suxingme_social_qqweibo',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('QQ邮箱'),
		'desc' => __('直接输入QQ邮箱即可，将出现在底栏。'),
		'id' => 'suxingme_social_email',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('QQ'),
		'desc' => __('直接输入QQ号即可，将出现在底栏。'),
		'id' => 'suxingme_social_qq',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('微信图片'),
		'desc' => __('请上传一个尺寸为长宽160px图片文件或是输入文件URL，将出现在底栏和侧栏社交小工具中（需先启用）'),
		'id' => 'suxingme_social_weixin',
		'type' => 'upload');
			
	/*******广告设置	*******/
	$options[] = array(
		'name' => __('PC端广告设置'),
		'type' => 'heading' );
	
	$options[] = array(
		'name' => __('文章列表中广告模块'),
		'id' => 'suxing_ad_posts_pc',
		'std' => false,
		'desc' => __('展示于文章列表的1个宽度为747.88px的广告位，有极高的点击率'),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('展示于第几篇文章后？'),
		'desc' => __('自定义显示位置，例如输入7，则此图片出现于第七篇文章之后。'),
		'id' => 'suxing_ad_posts_pc_num',
		"class" => "mini",
		'std' => '3',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('文章列表中广告模块-广告代码'),
		'desc' => __('图片宽度为760px'),
		'id' => 'suxing_ad_posts_pc_url',
	
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');	
	
	$options[] = array(
		'name' => __('文章标题上方广告模块'),
		'id' => 'suxing_single_top_ad_content_pc',
		'std' => false,
		'desc' => __('展示于文章列表的1个宽度为760px的广告位，有极高的点击率'),
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('文章标题上方广告模块-广告代码'),
		'desc' => __('图片宽度为760px'),
		'id' => 'suxing_single_top_ad_content_pc_url',
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');		

	$options[] = array(
		'name' => __('文章下方广告模块'),
		'id' => 'suxing_ad_content_pc',
		'std' => false,
		'desc' => __('展示于文章列表的1个宽度为760px的广告位，有极高的点击率'),
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('文章下方广告模块-广告代码'),
		'desc' => __('图片宽度为760px'),
		'id' => 'suxing_ad_content_pc_url',
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');		

	
	/******移动端广告设置*******/
	$options[] = array(
		'name' => __('移动端广告设置'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('【文章列表】广告模块'),
		'desc' => __('展示于文章列表，有极高的点击率。'),
		'id' => 'suxing_ad_posts_m',
		'std' => false,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('展示于第几篇文章后？'),
		'desc' => __('自定义显示位置，例如输入7，则此图片出现于第七篇文章之后。'),
		'id' => 'suxing_ad_posts_m_num',
		"class" => "mini",
		'type' => 'text');
		
	$options[] = array(
		'name' => __('广告代码'),
		'desc' => sprintf( __( '广告图片宽度为480px，图片高度自行决定。' ) ),
		'id' => 'suxing_ad_posts_m_url',
		"std" => '<a href="跳转链接" title="广告标题"><img src="图片链接" alt="图片描述"></a>',
		'type' => 'textarea');	

	$options[] = array(
		'name' => __('文章标题上方广告模块'),
		'id' => 'suxing_top_ad_content_mini',
		'std' => false,
		'desc' => __('展示于文章列表的1个宽度为760px的广告位，有极高的点击率'),
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('文章标题上方广告模块-广告代码'),
		'desc' => __('图片宽度为760px'),
		'id' => 'suxing_top_ad_content_mini_url',
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');		

	$options[] = array(
		'name' => __('文章下方广告模块'),
		'id' => 'suxing_ad_content_mini',
		'std' => false,
		'desc' => __('展示于文章列表的1个宽度为760px的广告位，有极高的点击率'),
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('文章下方广告模块-广告代码'),
		'desc' => __('图片宽度为480px，图片高度自行决定。'),
		'id' => 'suxing_ad_content_mini_url',
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');	
		
		
	/*******自定义Header/footer代码*******/
	$options[] = array(
		'name' => __('自定义代码'),
		'type' => 'heading');

	$options[] = array(
	'name' => __('自定义Header代码'),
	'desc' => __('如果有任何想添加在头部的代码，可以写在这里。例如一些调用JS的代码、css代码等。'),
	'id' => 'headcode',
	'std' => '',
	'type' => 'textarea');
	
	$options[] = array(
	'name' => __('自定义底部footer代码'),
	'desc' => __('如果有任何想添加在底部的代码，可以写在这里。例如一些调用JS的代码等。'),
	'id' => 'footcode',
	'std' => '',
	'type' => 'textarea');

	/*******特效开关*******/
	$options[] = array(
		'name' => __('特效选择'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('首页幻灯特效'),
		'id' => 'suxing_wow_index_slide',
		'std' => false,
		'desc' => __('开启则加特效，Duang~'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('首页显示3个热门分类特效'),
		'id' => 'suxing_wow_index_3cat',
		'std' => false,
		'desc' => __('开启则加特效，Duang~'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章列表特效'),
		'id' => 'suxing_wow_single_list',
		'std' => true,
		'desc' => __('开启则加特效，Duang~'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('加载更多按钮'),
		'id' => 'suxing_wow_loadmore_btn',
		'std' => true,
		'desc' => __('开启则加特效，Duang~'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('侧边栏特效'),
		'id' => 'suxing_wow_sidebar',
		'std' => false,
		'desc' => __('开启则加特效，Duang~'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章页面内-内嵌文章特效'),
		'id' => 'suxing_wow_single_embed_post',
		'std' => false,
		'desc' => __('开启则加特效，Duang~'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章页面内-猜你喜欢特效'),
		'id' => 'suxing_wow_single_related',
		'std' => false,
		'desc' => __('开启则加特效，Duang~'),
		'type' => 'checkbox');
	return $options;
}