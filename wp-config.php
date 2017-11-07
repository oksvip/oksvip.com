<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'oksvip_com');

/** MySQL数据库用户名 */
define('DB_USER', 'oksvip_com');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'WANGTAO');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

//禁用自动保存
define('AUTOSAVE_INTERVAL', false);

//设置自动保存间隔/秒
define('AUTOSAVE_INTERVAL', 3600);

//禁用文章修订
define('WP_POST_REVISIONS', false);

//设置修订版本最多允许几个
define('WP_POST_REVISIONS', 1);

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|U7~UO*v[;RqU HC6DA>jFd0-LyMgF!$)6!}?Rg4~cXU,9NBhYjSL%SADSzw}sqQ');
define('SECURE_AUTH_KEY',  '0fsr*I9@!00BmLZ1ro~ HxFyl^bE:N=je%&#}h.Vibud8!|rHtGcS!Z$}3YxW[#H');
define('LOGGED_IN_KEY',    'WN`hSxSnrpOW_Riunjyc|ke~q?po0/5me0M!;4~-S:bn*@VvP}Lzi/F|sKWX6zqH');
define('NONCE_KEY',        'l5pp-*08tK-d!yk0 [=TK ${*%?JDN<%1D~46~99-T@;PVuj?y%o}{3l0oD&RPoa');
define('AUTH_SALT',        ')5xFl|J?sJ{ee{(;6>1l37cHP_AsU<3%Gq$:m_h+3Er&M<)EiKIr!G8/e<f)v,|5');
define('SECURE_AUTH_SALT', '{/b!>0:^O<dagi-6=l$:3T*?&/}`q?&oj)1Q:QS/=6fC!,Wony?+vcV 58qU@tG|');
define('LOGGED_IN_SALT',   'J~*,N#3@$Rj5B16OoL$rKvh*zPkTNlY2YCiN J/K6`y0krLyer63#`W2#+a)AiOk');
define('NONCE_SALT',       'SXnf/E<R!bCQmyk+p,4v%Xjc+<}GFYJ^GxJ}Y?ud%V2-Z8jM~}ze=0?HAFO]juzV');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
