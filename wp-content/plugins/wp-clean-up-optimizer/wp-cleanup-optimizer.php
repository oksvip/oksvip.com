<?php
/*
  Plugin Name: Clean Up Optimizer
  Plugin URI: https://clean-up-optimizer.tech-banker.com
  Description: Clean Up Optimizer is a Superlative High Quality WordPress Plugin which not only allows you to clean and optimize the WordPress Database but also performs other vast functions.
  Author: Tech Banker
  Author URI: https://clean-up-optimizer.tech-banker.com
  Version: 4.0.15
  License: GPLv3
  Text Domain: wp-clean-up-optimizer
  Domain Path: /languages
 */
if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
/* Constant Declaration */
if (!defined("CLEAN_UP_OPTIMIZER_FILE")) {
   define("CLEAN_UP_OPTIMIZER_FILE", plugin_basename(__FILE__));
}
if (!defined("CLEAN_UP_OPTIMIZER_DIR_PATH")) {
   define("CLEAN_UP_OPTIMIZER_DIR_PATH", plugin_dir_path(__FILE__));
}
if (!defined("CLEAN_UP_OPTIMIZER_URL_PATH")) {
   define("CLEAN_UP_OPTIMIZER_URL_PATH", plugins_url(__FILE__));
}
if (!defined("CLEAN_UP_OPTIMIZER_PLUGIN_DIRNAME")) {
   define("CLEAN_UP_OPTIMIZER_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
}
if (!defined("clean_up_optimizer")) {
   define("clean_up_optimizer", "clean-up-optimizer");
}
if (!defined("clean_up_optimizer_local_time")) {
   define("clean_up_optimizer_local_time", strtotime(date_i18n("Y-m-d H:i:s")));
}


if (is_ssl()) {
   if (!defined("tech_banker_url")) {
      define("tech_banker_url", "https://tech-banker.com");
   }
   if (!defined("tech_banker_beta_url")) {
      define("tech_banker_beta_url", "https://clean-up-optimizer.tech-banker.com");
   }
   if (!defined("tech_banker_services_url")) {
      define("tech_banker_services_url", "https://tech-banker-services.org");
   }
} else {
   if (!defined("tech_banker_url")) {
      define("tech_banker_url", "http://tech-banker.com");
   }
   if (!defined("tech_banker_beta_url")) {
      define("tech_banker_beta_url", "https://clean-up-optimizer.tech-banker.com");
   }
   if (!defined("tech_banker_services_url")) {
      define("tech_banker_services_url", "http://tech-banker-services.org");
   }
}
if (!defined("tech_banker_stats_url")) {
   define("tech_banker_stats_url", "http://stats.tech-banker-services.org");
}
if (!defined("clean_up_optimizer_version_number")) {
   define("clean_up_optimizer_version_number", "4.0.15");
}

$memory_limit_clean_up_optimizer = intval(ini_get("memory_limit"));
if (!extension_loaded("suhosin") && $memory_limit_clean_up_optimizer < 512) {
   @ini_set("memory_limit", "1024M");
}

@ini_set("max_execution_time", 6000);
@ini_set("max_input_vars", 10000);


/*
  Function Name: install_script_for_clean_up_optimizer
  Parameters: No
  Description: This function is used to create tables in database.
  Created On: 23-09-2016 11:30
  Created By: Tech Banker Team
 */
function install_script_for_clean_up_optimizer() {
   global $wpdb;
   if (is_multisite()) {
      $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
      foreach ($blog_ids as $blog_id) {
         switch_to_blog($blog_id);
         $clean_up_optimizer_version_number = get_option("wp-cleanup-optimizer-version-number");
         if ($clean_up_optimizer_version_number < "4.0.0") {
            if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/install-script.php")) {
               include CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/install-script.php";
            }
         }
         restore_current_blog();
      }
   } else {
      $clean_up_optimizer_version_number = get_option("wp-cleanup-optimizer-version-number");
      if ($clean_up_optimizer_version_number < "4.0.0") {
         if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/install-script.php")) {
            include_once CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/install-script.php";
         }
      }
   }
}
/*
  Function Name: get_others_capabilities_clean_up_optimizer
  Parameters: No
  Description: This function is used to get all the roles available in WordPress
  Created On: 01-11-2016 03:16
  Created By: Tech Banker Team
 */
function get_others_capabilities_clean_up_optimizer() {
   $user_capabilities = array();
   if (function_exists("get_editable_roles")) {
      foreach (get_editable_roles() as $role_name => $role_info) {
         foreach ($role_info["capabilities"] as $capability => $values) {
            if (!in_array($capability, $user_capabilities)) {
               array_push($user_capabilities, $capability);
            }
         }
      }
   } else {
      $user_capabilities = array(
          "manage_options",
          "edit_plugins",
          "edit_posts",
          "publish_posts",
          "publish_pages",
          "edit_pages",
          "read"
      );
   }
   return $user_capabilities;
}
/*
  Function Name: check_user_roles_for_clean_up_optimizer
  Parameters: No
  Description: This function is used for checking roles of different users.
  Created On: 01-11-2016 03:10
  Created By: Tech Banker Team
 */
function check_user_roles_for_clean_up_optimizer() {
   global $current_user;
   $user = $current_user ? new WP_User($current_user) : wp_get_current_user();
   return $user->roles ? $user->roles[0] : false;
}
/*
  Function Name: clean_up_optimizer
  Parameters: No
  description: This function is used for creating parent table.
  Created on: 23-09-2016 11:48
  Created By: Tech Banker Team
 */
function clean_up_optimizer() {
   global $wpdb;
   return $wpdb->prefix . "clean_up_optimizer";
}
/*
  Function Name: clean_up_optimizer_meta
  Parameters: No
  description: This function is used for creating meta table.
  Created on: 23-09-2016 11:50
  Created By: Tech Banker Team
 */
function clean_up_optimizer_meta() {
   global $wpdb;
   return $wpdb->prefix . "clean_up_optimizer_meta";
}
$clean_up_optimizer_version_number = get_option("wp-cleanup-optimizer-version-number");
if ($clean_up_optimizer_version_number >= "4.0.0") {
   /*
     Function Name: backend_js_css_for_clean_up_optimizer
     Parameters: No
     Description: This function is used to include backend js.
     Created On: 02-11-2016 11:30
     Created By: Tech Banker Team
    */

   if (is_admin()) {

      function backend_js_css_for_clean_up_optimizer() {
         $pages_clean_up_optimizer = array
             (
             "cpo_wizard_optimizer",
             "cpo_dashboard",
             "cpo_schedule_optimizer",
             "cpo_add_new_wordpress_schedule",
             "cpo_db_optimizer",
             "cpo_schedule_db_optimizer",
             "cpo_database_view_records",
             "cpo_schedule_db_optimizer",
             "cpo_add_new_database_schedule",
             "cpo_live_traffic",
             "cpo_login_logs",
             "cpo_visitor_logs",
             "cpo_custom_jobs",
             "cpo_core_jobs",
             "cpo_notifications_setup",
             "cpo_message_settings",
             "cpo_email_templates",
             "cpo_roles_and_capabilities",
             "cpo_blockage_settings",
             "cpo_ip_addresses",
             "cpo_ip_ranges",
             "cpo_block_unblock_countries",
             "cpo_other_settings",
             "cpo_system_information"
         );
         if (in_array(isset($_REQUEST["page"]) ? esc_attr($_REQUEST["page"]) : "", $pages_clean_up_optimizer)) {
            wp_enqueue_script("jquery");
            wp_enqueue_script("jquery-ui-datepicker");
            wp_enqueue_script("clean-up-optimizer-bootstrap.js", plugins_url("assets/global/plugins/custom/js/custom.js", __FILE__));
            wp_enqueue_script("clean-up-optimizer-bootstrap-tabdrop.js", plugins_url("assets/global/plugins/tabdrop/js/tabdrop.js", __FILE__));
            wp_enqueue_script("clean-up-optimizer-jquery.validate.js", plugins_url("assets/global/plugins/validation/jquery.validate.js", __FILE__));
            wp_enqueue_script("clean-up-optimizer-jquery.datatables.js", plugins_url("assets/global/plugins/datatables/media/js/jquery.datatables.js", __FILE__));
            wp_enqueue_script("clean-up-optimizer-jquery.fngetfilterednodes.js", plugins_url("assets/global/plugins/datatables/media/js/fngetfilterednodes.js", __FILE__));
            wp_enqueue_script("clean-up-optimizer-toastr.js", plugins_url("assets/global/plugins/toastr/toastr.js", __FILE__));
            if (is_ssl()) {
               wp_enqueue_script("clean-up-optimizer-maps_script.js", "https://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=AIzaSyDOpCmwYFyneS7t5j8d6lNE1kRxL9vzsCI");
            } else {
               wp_enqueue_script("clean-up-optimizer-maps_script.js", "http://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=AIzaSyDOpCmwYFyneS7t5j8d6lNE1kRxL9vzsCI");
            }

            wp_enqueue_style("clean-up-optimizer-simple-line-icons.css", plugins_url("assets/global/plugins/icons/icons.css", __FILE__));
            wp_enqueue_style("clean-up-optimizer-components.css", plugins_url("assets/global/css/components.css", __FILE__));
            wp_enqueue_style("clean-up-optimizer-custom.css", plugins_url("assets/admin/layout/css/clean-up-optimizer-custom.css", __FILE__));
            if (is_rtl()) {
               wp_enqueue_style("clean-up-optimizer-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom-rtl.css", __FILE__));
               wp_enqueue_style("clean-up-optimizer-layout.css", plugins_url("assets/admin/layout/css/layout-rtl.css", __FILE__));
               wp_enqueue_style("clean-up-optimizer-tech-banker-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom-rtl.css", __FILE__));
            } else {
               wp_enqueue_style("clean-up-optimizer-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom.css", __FILE__));
               wp_enqueue_style("clean-up-optimizer-layout.css", plugins_url("assets/admin/layout/css/layout.css", __FILE__));
               wp_enqueue_style("clean-up-optimizer-tech-banker-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom.css", __FILE__));
            }
            wp_enqueue_style("clean-up-optimizer-plugins.css", plugins_url("assets/global/css/plugins.css", __FILE__));
            wp_enqueue_style("clean-up-optimizer-default.css", plugins_url("assets/admin/layout/css/themes/default.css", __FILE__));
            wp_enqueue_style("clean-up-optimizer-toastr.min.css", plugins_url("assets/global/plugins/toastr/toastr.css", __FILE__));
            wp_enqueue_style("clean-up-optimizer-jquery-ui.css", plugins_url("assets/global/plugins/datepicker/jquery-ui.css", __FILE__), false, "2.0", false);
            wp_enqueue_style("clean-up-optimizer-datatables.foundation.css", plugins_url("assets/global/plugins/datatables/media/css/datatables.foundation.css", __FILE__));
         }
      }
      add_action("admin_enqueue_scripts", "backend_js_css_for_clean_up_optimizer");
   }





   /*
     Function Name: validate_ip_cleanup_optimizer
     Parameters: No
     description: This function is used for validating ip address.
     Created on: 29-09-2015 10:56
     Created By: Tech Banker Team
    */
   function validate_ip_cleanup_optimizer($ip) {
      if (strtolower($ip) === "unknown") {
         return false;
      }
      $ip = ip2long($ip);

      if ($ip !== false && $ip !== -1) {
         $ip = sprintf("%u", $ip);

         if ($ip >= 0 && $ip <= 50331647) {
            return false;
         }
         if ($ip >= 167772160 && $ip <= 184549375) {
            return false;
         }
         if ($ip >= 2130706432 && $ip <= 2147483647) {
            return false;
         }
         if ($ip >= 2851995648 && $ip <= 2852061183) {
            return false;
         }
         if ($ip >= 2886729728 && $ip <= 2887778303) {
            return false;
         }
         if ($ip >= 3221225984 && $ip <= 3221226239) {
            return false;
         }
         if ($ip >= 3232235520 && $ip <= 3232301055) {
            return false;
         }
         if ($ip >= 4294967040) {
            return false;
         }
      }
      return true;
   }
   /*
     Function Name: get_ip_address_clean_up_optimizer
     Parameters: No
     description: This function is used for getIpAddress.
     Created on: 29-09-2016 10:56
     Created By: Tech Banker Team
    */
   function get_ip_address_clean_up_optimizer() {
      static $ip = null;
      if (isset($ip)) {
         return $ip;
      }

      global $wpdb;
      $data = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_key=%s", "other_settings"
          )
      );
      $other_settings_data = maybe_unserialize($data);

      switch (esc_attr($other_settings_data["ip_address_fetching_method"])) {
         case "REMOTE_ADDR":
            if (isset($_SERVER["REMOTE_ADDR"])) {
               if (!empty($_SERVER["REMOTE_ADDR"]) && validate_ip_cleanup_optimizer($_SERVER["REMOTE_ADDR"])) {
                  $ip = $_SERVER["REMOTE_ADDR"];
                  return $ip;
               }
            }
            break;

         case "HTTP_X_FORWARDED_FOR":
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && !empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
               if (strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",") !== false) {
                  $iplist = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
                  foreach ($iplist as $ip_address) {
                     if (validate_ip_cleanup_optimizer($ip_address)) {
                        $ip = $ip_address;
                        return $ip;
                     }
                  }
               } else {
                  if (validate_ip_cleanup_optimizer($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                     return $ip;
                  }
               }
            }
            break;

         case "HTTP_X_REAL_IP":
            if (isset($_SERVER["HTTP_X_REAL_IP"])) {
               if (!empty($_SERVER["HTTP_X_REAL_IP"]) && validate_ip_cleanup_optimizer($_SERVER["HTTP_X_REAL_IP"])) {
                  $ip = $_SERVER["HTTP_X_REAL_IP"];
                  return $ip;
               }
            }
            break;

         case "HTTP_CF_CONNECTING_IP":
            if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
               if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"]) && validate_ip_cleanup_optimizer($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                  $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
                  return $ip;
               }
            }
            break;

         default:
            if (isset($_SERVER["HTTP_CLIENT_IP"])) {
               if (!empty($_SERVER["HTTP_CLIENT_IP"]) && validate_ip_cleanup_optimizer($_SERVER["HTTP_CLIENT_IP"])) {
                  $ip = $_SERVER["HTTP_CLIENT_IP"];
                  return $ip;
               }
            }
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && !empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
               if (strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",") !== false) {
                  $iplist = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
                  foreach ($iplist as $ip_address) {
                     if (validate_ip_cleanup_optimizer($ip_address)) {
                        $ip = $ip_address;
                        return $ip;
                     }
                  }
               } else {
                  if (validate_ip_cleanup_optimizer($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                     return $ip;
                  }
               }
            }
            if (isset($_SERVER["HTTP_X_FORWARDED"])) {
               if (!empty($_SERVER["HTTP_X_FORWARDED"]) && validate_ip_cleanup_optimizer($_SERVER["HTTP_X_FORWARDED"])) {
                  $ip = $_SERVER["HTTP_X_FORWARDED"];
                  return $ip;
               }
            }
            if (isset($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
               if (!empty($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]) && validate_ip_cleanup_optimizer($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
                  $ip = $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"];
                  return $ip;
               }
            }
            if (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
               if (!empty($_SERVER["HTTP_FORWARDED_FOR"]) && validate_ip_cleanup_optimizer($_SERVER["HTTP_FORWARDED_FOR"])) {
                  $ip = $_SERVER["HTTP_FORWARDED_FOR"];
                  return $ip;
               }
            }
            if (isset($_SERVER["HTTP_FORWARDED"])) {
               if (!empty($_SERVER["HTTP_FORWARDED"]) && validate_ip_cleanup_optimizer($_SERVER["HTTP_FORWARDED"])) {
                  $ip = $_SERVER["HTTP_FORWARDED"];
                  return $ip;
               }
            }
            if (isset($_SERVER["REMOTE_ADDR"])) {
               if (!empty($_SERVER["REMOTE_ADDR"]) && validate_ip_cleanup_optimizer($_SERVER["REMOTE_ADDR"])) {
                  $ip = $_SERVER["REMOTE_ADDR"];
                  return $ip;
               }
            }
            break;
      }
      return "127.0.0.1";
   }
   /*
     Function Name: get_users_capabilities_for_clean_up_optimizer
     Parameters: No
     Description: This function is used to get users capabilities.
     Created On: 01-11-2016 02:55
     Created By: Tech Banker Team
    */
   function get_users_capabilities_for_clean_up_optimizer() {
      global $wpdb;
      $capabilities = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_key = %s", "roles_and_capabilities"
          )
      );
      $core_roles = array(
          "manage_options",
          "edit_plugins",
          "edit_posts",
          "publish_posts",
          "publish_pages",
          "edit_pages",
          "read"
      );
      $unserialized_capabilities = maybe_unserialize($capabilities);
      return isset($unserialized_capabilities["capabilities"]) ? $unserialized_capabilities["capabilities"] : $core_roles;
   }
   /*
     Function Name: sidebar_menu_for_clean_up_optimizer
     Parameters: No
     Description: This function is used for sidebar menu.
     Created On: 23-09-2016 11:40
     Created By: Tech Banker Team
    */
   function sidebar_menu_for_clean_up_optimizer() {
      global $wpdb, $current_user;
      $user_role_permission = get_users_capabilities_for_clean_up_optimizer();
      if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "includes/translations.php")) {
         include CLEAN_UP_OPTIMIZER_DIR_PATH . "includes/translations.php";
      }
      if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/sidebar-menu.php")) {
         include_once CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/sidebar-menu.php";
      }
   }
   /*
     Function Name: topbar_menu_for_clean_up_optimizer
     Parameters: No
     Description: This function is used for topbar menu.
     Created On: 23-09-2016 11:40
     Created By: Tech Banker Team
    */
   function topbar_menu_for_clean_up_optimizer() {
      global $wpdb, $current_user, $wp_admin_bar;
      $role_capabilities = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_key = %s", "roles_and_capabilities"
          )
      );
      $roles_and_capabilities_data = maybe_unserialize($role_capabilities);
      if (esc_attr($roles_and_capabilities_data["show_clean_up_optimizer_top_bar_menu"]) == "enable") {
         $user_role_permission = get_users_capabilities_for_clean_up_optimizer();
         if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "includes/translations.php")) {
            include CLEAN_UP_OPTIMIZER_DIR_PATH . "includes/translations.php";
         }
         if (get_option("clean-up-optimizer-wizard-set-up")) {
            if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/admin-bar-menu.php")) {
               include_once CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/admin-bar-menu.php";
            }
         }
      }
   }
   /*
     Function Name: helper_file_for_clean_up_optimizer
     Parameters: No
     Description: This function is used for helper file.
     Created On: 23-09-2016 11:40
     Created By: Tech Banker Team
    */
   function helper_file_for_clean_up_optimizer() {
      global $wpdb;
      $user_role_permission = get_users_capabilities_for_clean_up_optimizer();
      if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/helper.php")) {
         include_once CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/helper.php";
      }
   }
   /*
     Function Name: ajax_register_clean_up_optimizer
     Parameters: No
     Description: This function is used for register ajax.
     Created On: 24-09-2016 11:40
     Created By: Tech Banker Team
    */
   function ajax_register_clean_up_optimizer() {
      global $wpdb;
      $user_role_permission = get_users_capabilities_for_clean_up_optimizer();
      if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/action-library.php")) {
         include_once CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/action-library.php";
      }
   }
   if (!function_exists("cleanup_optimizer_smart_ip_detect_crawler")) {
      function cleanup_optimizer_smart_ip_detect_crawler() {
         // User lowercase string for comparison.
         $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
         // A list of some common words used only for bots and crawlers.
         $bot_identifiers = array(
             'bot',
             'slurp',
             'crawler',
             'spider',
             'curl',
             'facebook',
             'fetch',
             'scoutjet',
             'bingbot',
             'AhrefsBot',
             'spbot',
             'robot'
         );
         // See if one of the identifiers is in the UA string.
         foreach ($bot_identifiers as $identifier) {
            if (strpos($user_agent, $identifier) !== FALSE) {
               return TRUE;
            }
         }
         return FALSE;
      }
   }
   /*
     Function Name: user_login_status_clean_up_optimizer
     Parameters:yes($username,$password)
     description: This function is used for check the user's Login status.
     Created On: 06-10-2016 11:00
     Created By: Tech Banker Team
    */
   function user_login_status_clean_up_optimizer($username, $password) {
      global $wpdb;
      $ip = get_ip_address_clean_up_optimizer();
      $ip_address = $ip == "::1" ? ip2long("127.0.0.1") : ip2long($ip);
      $location = get_ip_location_clean_up_optimizer(long2ip($ip_address));
      $place = $location->country_name == "" && $location->city == "" ? "" : $location->country_name == "" ? "" : $location->city == "" ? $location->country_name : $location->city . ", " . $location->country_name;
      $userdata = get_user_by("login", $username);
      $user_email_data = get_user_by("email", $username);
      if (!cleanup_optimizer_smart_ip_detect_crawler()) {
         if (($userdata && wp_check_password($password, $userdata->user_pass)) || ($user_email_data && wp_check_password($password, $user_email_data->user_pass))) {
            $insert_login_logs = array();
            $insert_login_logs["type"] = "recent_login_logs";
            $insert_login_logs["parent_id"] = "0";
            $wpdb->insert(clean_up_optimizer(), $insert_login_logs);
            $last_id = $wpdb->insert_id;

            $insert_login_logs = array();
            $insert_login_logs["username"] = esc_attr($username);
            $insert_login_logs["user_ip_address"] = esc_attr($ip_address);
            $insert_login_logs["location"] = esc_attr($place);
            $insert_login_logs["latitude"] = esc_attr($location->latitude);
            $insert_login_logs["longitude"] = esc_attr($location->longitude);
            $insert_login_logs["resources"] = isset($_SERVER["REQUEST_URI"]) ? esc_attr($_SERVER["REQUEST_URI"]) : "";
            $insert_login_logs["http_user_agent"] = isset($_SERVER["HTTP_USER_AGENT"]) ? esc_attr($_SERVER["HTTP_USER_AGENT"]) : "";
            $timestamp = clean_up_optimizer_local_time;
            $insert_login_logs["date_time"] = intval($timestamp);
            $insert_login_logs["status"] = "Success";
            $insert_login_logs["meta_id"] = intval($last_id);
            $recent_logs_data = array();
            $recent_logs_data["meta_id"] = $last_id;
            $recent_logs_data["meta_key"] = "recent_login_data";
            $recent_logs_data["meta_value"] = serialize($insert_login_logs);
            $wpdb->insert(clean_up_optimizer_meta(), $recent_logs_data);
         } else {
            if ($username == "" || $password == "") {
               return;
            } else {
               $insert_login_logs = array();
               $insert_login_logs["type"] = "recent_login_logs";
               $insert_login_logs["parent_id"] = "0";
               $wpdb->insert(clean_up_optimizer(), $insert_login_logs);
               $last_id = $wpdb->insert_id;

               $insert_login_logs = array();
               $insert_login_logs["username"] = esc_attr($username);
               $insert_login_logs["user_ip_address"] = esc_attr($ip_address);
               $insert_login_logs["location"] = esc_attr($place);
               $insert_login_logs["latitude"] = esc_attr($location->latitude);
               $insert_login_logs["longitude"] = esc_attr($location->longitude);
               $insert_login_logs["resources"] = isset($_SERVER["REQUEST_URI"]) ? esc_attr($_SERVER["REQUEST_URI"]) : "";
               $insert_login_logs["http_user_agent"] = isset($_SERVER["HTTP_USER_AGENT"]) ? esc_attr($_SERVER["HTTP_USER_AGENT"]) : "";
               $timestamp = clean_up_optimizer_local_time;
               $insert_login_logs["date_time"] = intval($timestamp);
               $insert_login_logs["status"] = "Failure";
               $insert_login_logs["meta_id"] = intval($last_id);

               $recent_logs_data = array();
               $recent_logs_data["meta_id"] = $last_id;
               $recent_logs_data["meta_key"] = "recent_login_data";
               $recent_logs_data["meta_value"] = serialize($insert_login_logs);
               $wpdb->insert(clean_up_optimizer_meta(), $recent_logs_data);

               $auto_ip_block = $wpdb->get_var
                   (
                   $wpdb->prepare
                       (
                       "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
                                                          WHERE meta_key = %s", "blocking_options"
                   )
               );

               $blocking_options_data = maybe_unserialize($auto_ip_block);
               if (esc_attr($blocking_options_data["auto_ip_block"]) == "enable") {
                  add_filter("login_errors", "login_error_messages_clean_up_optimizer", 10, 1);
                  $get_ip = get_ip_location_clean_up_optimizer(long2ip($ip_address));
                  $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;
                  $date = clean_up_optimizer_local_time;

                  $meta_data_array = $blocking_options_data;

                  $get_all_user_data = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT * FROM " . clean_up_optimizer_meta() . "
                                                                  WHERE meta_key = %s", "recent_login_data"
                      )
                  );

                  $blocked_for_time = esc_attr($meta_data_array["block_for"]);

                  switch ($blocked_for_time) {
                     case "1Hour":
                        $this_time = 60 * 60;
                        break;

                     case "12Hour":
                        $this_time = 12 * 60 * 60;
                        break;

                     case "24hours":
                        $this_time = 24 * 60 * 60;
                        break;

                     case "48hours":
                        $this_time = 2 * 24 * 60 * 60;
                        break;

                     case "week":
                        $this_time = 7 * 24 * 60 * 60;
                        break;

                     case "month":
                        $this_time = 30 * 24 * 60 * 60;
                        break;

                     case "permanently":
                        $this_time = "permanently";
                        break;
                  }

                  $user_data = count(get_clean_up_optimizer_details_login_count_check($get_all_user_data, $date, $this_time, $ip_address));
                  if (!defined("cpo_count_login_status"))
                     define("cpo_count_login_status", $user_data);
                  if ($user_data >= esc_attr($meta_data_array["maximum_login_attempt_in_a_day"])) {
                     $advance_security_manage_ip_address = wp_create_nonce("cleanup_manage_ip_address");
                     $ip_address_block = array();
                     $ip_address_block["type"] = "block_ip_address";
                     $ip_address_block["parent_id"] = 0;
                     $wpdb->insert(clean_up_optimizer(), $ip_address_block);
                     $last_id = $wpdb->insert_id;

                     $ip_address_block_meta = array();
                     $ip_address_block_meta["ip_address"] = esc_attr($ip_address);
                     $ip_address_block_meta["blocked_for"] = esc_attr($blocked_for_time);
                     $ip_address_block_meta["location"] = esc_attr($location);
                     $ip_address_block_meta["comments"] = "IP ADDRESS AUTOMATIC BLOCKED!";
                     $timestamp = clean_up_optimizer_local_time;
                     $ip_address_block_meta["date_time"] = intval($timestamp);

                     $insert_data = array();
                     $insert_data["meta_id"] = $last_id;
                     $insert_data["meta_key"] = "block_ip_address";
                     $insert_data["meta_value"] = serialize($ip_address_block_meta);
                     $wpdb->insert(clean_up_optimizer_meta(), $insert_data);

                     if ($blocked_for_time != "permanently") {
                        $cron_name = "ip_address_unblocker_" . $last_id;
                        schedule_clean_up_optimizer_ip_address_and_ranges($cron_name, $blocked_for_time);
                     }

                     $error_message_data = $wpdb->get_var
                         (
                         $wpdb->prepare
                             (
                             "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
                                                                          WHERE meta_key = %s", "error_message"
                         )
                     );

                     $meta_data_array = maybe_unserialize($error_message_data);
                     $replace_ipaddress = $meta_data_array["for_blocked_ip_address_error"];
                     $replace_address = str_replace("[ip_address]", long2ip($ip_address), $replace_ipaddress);
                     wp_die($replace_address);
                  }
               }
            }
         }
      }
   }
   /*
     Function Name: login_error_messages_clean_up_optimizer
     Parameter: Yes($default_error_message)
     Description: This Function is used for login error messages.
     Created On: 14-10-2016 11:00
     Created By: Tech Banker Team
    */
   function login_error_messages_clean_up_optimizer($default_error_message) {
      global $wpdb;
      $max_login_attempts = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_key = %s", "blocking_options"
          )
      );
      $max_login_attempts_data = maybe_unserialize($max_login_attempts);
      $error_message_attempts = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_key = %s", "error_message"
          )
      );
      $error_message_attempts_data = maybe_unserialize($error_message_attempts);
      $login_attempts = intval($max_login_attempts_data["maximum_login_attempt_in_a_day"]) - cpo_count_login_status;
      $replace_attempts = str_replace("[maxAttempts]", $login_attempts, $error_message_attempts_data["for_maximum_login_attempts"]);
      $display_error_message = $default_error_message . " " . $replace_attempts;
      return $display_error_message;
   }
   /*
     Function Name: schedule_clean_up_optimizer_ip_address_and_ranges
     Parameter: Yes($cron_name,$time_interval)
     Description: This function is used for creating a scheduler of ip address.
     Created On: 14-10-2016 11:00
     Created By: Tech Banker Team
    */
   function schedule_clean_up_optimizer_ip_address_and_ranges($cron_name, $time_interval) {
      if (wp_next_scheduled($cron_name)) {
         unschedule_events_clean_up_optimizer($cron_name);
      }
      switch ($time_interval) {
         case "1Hour":
            $this_time = 60 * 60;
            break;

         case "12Hour":
            $this_time = 12 * 60 * 60;
            break;

         case "24hours":
            $this_time = 24 * 60 * 60;
            break;

         case "48hours":
            $this_time = 2 * 24 * 60 * 60;
            break;

         case "week":
            $this_time = 7 * 24 * 60 * 60;
            break;

         case "month":
            $this_time = 30 * 24 * 60 * 60;
            break;
      }
      wp_schedule_event(time() + $this_time, $time_interval, $cron_name);
   }
   $scheduler = _get_cron_array();
   $current_scheduler = array();

   foreach ($scheduler as $value => $key) {
      $arr_key = array_keys($key);
      foreach ($arr_key as $value) {
         array_push($current_scheduler, $value);
      }
   }

   if (isset($current_scheduler[0])) {
      if (!defined("scheduler_name"))
         define("scheduler_name", $current_scheduler[0]);

      if (strstr($current_scheduler[0], "ip_address_unblocker_")) {
         add_action($current_scheduler[0], "unblock_script_clean_up_optimizer");
      } else if (strstr($current_scheduler[0], "ip_range_unblocker_")) {
         add_action($current_scheduler[0], "unblock_script_clean_up_optimizer");
      }
   }

   /*
     Function Name: unblock_script_clean_up_optimizer
     Parameter: No
     Description: This function is used for including the unblock-script file.
     Created On: 24-10-2016 02:20
     Created By: Tech Banker Team
    */
   function unblock_script_clean_up_optimizer() {
      if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/unblock-script.php")) {
         $nonce_unblock_script = wp_create_nonce("unblock_script");
         global $wpdb;
         include_once CLEAN_UP_OPTIMIZER_DIR_PATH . "lib/unblock-script.php";
      }
   }
   /*
     Function Name: manage_security_settings_for_clean_up_optimizer
     Parameter: No
     Description: This function  is used for blocking ip address and ip ranges.
     Created On: 14-10-2016 11:00
     Created By: Tech Banker Team
    */
   function manage_security_settings_for_clean_up_optimizer($meta_data_array, $meta_values_ip_blocks, $ip_address, $location) {
      //code for checking ip range
      $flag = 0;
      $count_ip = 0;
      $country_code = "";
      for ($key = 0; $key < count($meta_values_ip_blocks); $key++) {
         if ($meta_values_ip_blocks[$key]->meta_key == "block_ip_range") {
            $block_ip_range = maybe_unserialize($meta_values_ip_blocks[$key]->meta_value);
            $ip_range_address = explode(",", $block_ip_range["ip_range"]);
            if ($ip_address >= $ip_range_address[0] && $ip_address <= $ip_range_address[1]) {
               $flag = 1;
               break;
            }
         } else if ($meta_values_ip_blocks[$key]->meta_key == "block_ip_address") {
            $block_ip_address = maybe_unserialize($meta_values_ip_blocks[$key]->meta_value);
            if ($block_ip_address["ip_address"] == $ip_address) {
               $count_ip = 1;
               break;
            }
         }
      }
      if ($count_ip == 1 || $flag == 1 || $country_code != "") {
         if ($count_ip == 1) {
            $replace_ipaddress = $meta_data_array["for_blocked_ip_address_error"];
            $replace_address = str_replace("[ip_address]", long2ip($ip_address), $replace_ipaddress);
            wp_die($replace_address);
         } else {
            $replace_iprange = $meta_data_array["for_blocked_ip_range_error"];
            $replace_range = str_replace("[ip_range]", long2ip($ip_range_address[0]) . "-" . long2ip($ip_range_address[1]), $replace_iprange);
            wp_die($replace_range);
         }
      }
   }
   /*
     Function Name: visitor_logs_insertion_clean_up_optimizer
     Parameter: No
     Description: This Function is used for insert the visitor log data in database.
     Created On: 06-10-2016 11:05
     Created By: Tech Banker Team
    */
   function visitor_logs_insertion_clean_up_optimizer($meta_data_array, $ip_address, $location) {
      if (!is_admin() && !defined("DOING_CRON")) {
         if (!cleanup_optimizer_smart_ip_detect_crawler()) {
            global $current_user, $wpdb;
            $place = $location->country_name == "" && $location->city == "" ? "" : $location->country_name == "" ? "" : $location->city == "" ? $location->country_name : $location->city . ", " . $location->country_name;
            $username = $current_user->user_login;

            $insert_live_traffic = array();
            $insert_live_traffic["type"] = "visitor_log";
            $insert_live_traffic["parent_id"] = 0;
            $wpdb->insert(clean_up_optimizer(), $insert_live_traffic);
            $last_id = $wpdb->insert_id;

            $insert_live_traffic = array();
            $insert_live_traffic["username"] = esc_attr($username);
            $insert_live_traffic["user_ip_address"] = esc_attr($ip_address);

            $insert_live_traffic["location"] = esc_attr($place);
            $insert_live_traffic["latitude"] = esc_attr($location->latitude);
            $insert_live_traffic["longitude"] = esc_attr($location->longitude);
            $insert_live_traffic["resources"] = isset($_SERVER["REQUEST_URI"]) ? esc_attr($_SERVER["REQUEST_URI"]) : "";
            $insert_live_traffic["http_user_agent"] = isset($_SERVER["HTTP_USER_AGENT"]) ? esc_attr($_SERVER["HTTP_USER_AGENT"]) : "";

            $timestamp = clean_up_optimizer_local_time;
            $insert_live_traffic["date_time"] = intval($timestamp);
            $insert_live_traffic["meta_id"] = intval($last_id);
            $insert_live_traffic_data = array();
            $insert_live_traffic_data["meta_id"] = $last_id;
            $insert_live_traffic_data["meta_key"] = "visitor_log_data";
            $insert_live_traffic_data["meta_value"] = serialize($insert_live_traffic);
            $wpdb->insert(clean_up_optimizer_meta(), $insert_live_traffic_data);
         }
      }
   }
   /*
     Function Name: get_ip_location_clean_up_optimizer
     Parameters: $ip_Address
     description: This function is used to get ip location.
     Created on: 29-09-2016 10:56
     Created By: Tech Banker Team
    */
   function get_ip_location_clean_up_optimizer($ip_Address) {
      $core_data = '{"ip":"0.0.0.0","country_code":"","country_name":"","region_code":"","region_name":"","city":"","latitude":0,"longitude":0}';
      $apiCall = tech_banker_services_url . "/api/getipaddress.php?ip_address=" . $ip_Address;
      $jsonData = @file_get_contents($apiCall);
      return json_decode($jsonData);
   }
   function get_clean_up_optimizer_details_login_count_check($data, $date, $time_interval, $ip_address) {
      $clean_up_details = array();
      foreach ($data as $raw_row) {
         $row = maybe_unserialize($raw_row->meta_value);
         if ($row["user_ip_address"] == $ip_address) {
            if ($time_interval != "permanently") {
               if ($row["status"] == "Failure" && $row["date_time"] + $time_interval >= $date) {
                  array_push($clean_up_details, $row);
               }
            } else {
               if ($row["status"] == "Failure") {
                  array_push($clean_up_details, $row);
               }
            }
         }
      }
      return $clean_up_details;
   }
   /*
     Function Name: scheduler_for_wordpress_and_database_clean_up_optimizer
     Parameter: Yes($cron_name,$time_interval)
     Description: This function is used for creating a scheduler of wordpress data.
     Created On: 13-10-2016 12:45
     Created By: Tech Banker Team
    */
   function scheduler_for_wordpress_and_database_clean_up_optimizer($cron_name, $time_interval, $timestamp) {
      if (wp_next_scheduled($cron_name)) {
         unschedule_events_clean_up_optimizer($cron_name);
      }
      $current_offset = get_option('gmt_offset') * 60 * 60;
      wp_schedule_event($timestamp - $current_offset, $time_interval, $cron_name);
   }
   /*
     Function Name: cron_scheduler_for_intervals_clean_up_optimizer
     Parameters: Yes($schedules)
     Description: This function is used to cron scheduler for intervals.
     Created On: 15-10-2016 12:05
     Created By: Tech Banker Team
    */
   function cron_scheduler_for_intervals_clean_up_optimizer($schedules) {
      $schedules["1Hour"] = array("interval" => 60 * 60, "display" => "Every 1 Hour");
      $schedules["2Hour"] = array("interval" => 60 * 60 * 2, "display" => "Every 2 Hours");
      $schedules["3Hour"] = array("interval" => 60 * 60 * 3, "display" => "Every 3 Hours");
      $schedules["4Hour"] = array("interval" => 60 * 60 * 4, "display" => "Every 4 Hours");
      $schedules["5Hour"] = array("interval" => 60 * 60 * 5, "display" => "Every 5 Hours");
      $schedules["6Hour"] = array("interval" => 60 * 60 * 6, "display" => "Every 6 Hours");
      $schedules["7Hour"] = array("interval" => 60 * 60 * 7, "display" => "Every 7 Hours");
      $schedules["8Hour"] = array("interval" => 60 * 60 * 8, "display" => "Every 8 Hours");
      $schedules["9Hour"] = array("interval" => 60 * 60 * 9, "display" => "Every 9 Hours");
      $schedules["10Hour"] = array("interval" => 60 * 60 * 10, "display" => "Every 10 Hours");
      $schedules["11Hour"] = array("interval" => 60 * 60 * 11, "display" => "Every 11 Hours");
      $schedules["12Hour"] = array("interval" => 60 * 60 * 12, "display" => "Every 12 Hours");
      $schedules["13Hour"] = array("interval" => 60 * 60 * 13, "display" => "Every 13 Hours");
      $schedules["14Hour"] = array("interval" => 60 * 60 * 14, "display" => "Every 14 Hours");
      $schedules["15Hour"] = array("interval" => 60 * 60 * 15, "display" => "Every 15 Hours");
      $schedules["16Hour"] = array("interval" => 60 * 60 * 16, "display" => "Every 16 Hours");
      $schedules["17Hour"] = array("interval" => 60 * 60 * 17, "display" => "Every 17 Hours");
      $schedules["18Hour"] = array("interval" => 60 * 60 * 18, "display" => "Every 18 Hours");
      $schedules["19Hour"] = array("interval" => 60 * 60 * 19, "display" => "Every 19 Hours");
      $schedules["20Hour"] = array("interval" => 60 * 60 * 20, "display" => "Every 20 Hours");
      $schedules["21Hour"] = array("interval" => 60 * 60 * 21, "display" => "Every 21 Hours");
      $schedules["22Hour"] = array("interval" => 60 * 60 * 22, "display" => "Every 22 Hours");
      $schedules["23Hour"] = array("interval" => 60 * 60 * 23, "display" => "Every 23 Hours");
      $schedules["Daily"] = array("interval" => 60 * 60 * 24, "display" => "Daily");
      $schedules["24hours"] = array("interval" => 60 * 60 * 24, "display" => "Every 24 Hours");
      $schedules["48hours"] = array("interval" => 60 * 60 * 48, "display" => "Every 48 Hours");
      $schedules["week"] = array("interval" => 60 * 60 * 24 * 7, "display" => "Every 1 Week");
      $schedules["month"] = array("interval" => 60 * 60 * 24 * 30, "display" => "Every 1 Month");
      return $schedules;
   }
   /*
     Function Name: unschedule_events_clean_up_optimizer
     Parameters: Yes($cron_name)
     Description: This function is used to unscheduling the events.
     Created On: 15-10-2016 12:11
     Created By: Tech Banker Team
    */
   function unschedule_events_clean_up_optimizer($cron_name) {
      if (wp_next_scheduled($cron_name)) {
         $db_cron = wp_next_scheduled($cron_name);
         wp_unschedule_event($db_cron, $cron_name);
      }
   }
   /*
     Function Name: plugin_load_textdomain_clean_up_optimizer
     Parameters: No
     Description: This function is used to load languages.
     Created On: 21-11-2016 12:11
     Created By: Tech Banker Team
    */
   function plugin_load_textdomain_clean_up_optimizer() {
      load_plugin_textdomain("wp-clean-up-optimizer", false, CLEAN_UP_OPTIMIZER_PLUGIN_DIRNAME . "/languages");
   }
   /*
     Function Name: admin_functions_clean_up_optimizer
     Parameters: No
     Description: This function is used for calling add_action .
     Created On: 23-10-2016 01:13
     Created by: Tech Banker Team
    */
   function admin_functions_clean_up_optimizer() {
      install_script_for_clean_up_optimizer();
      helper_file_for_clean_up_optimizer();
   }
   /*
     Function Name: user_functions_clean_up_optimizer
     Parameters: No
     Description: This function is used for calling add_action for frontend .
     Created On: 23-09-2016 01:13
     Created by: Tech Banker Team
    */
   function user_functions_clean_up_optimizer() {
      global $wpdb;
      plugin_load_textdomain_clean_up_optimizer();
      $meta_values = $wpdb->get_results
          (
          $wpdb->prepare
              (
              "SELECT meta_key,meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_key IN(%s,%s)", "error_message", "other_settings"
          )
      );
      $meta_values_ip_blocks = $wpdb->get_results
          (
          $wpdb->prepare
              (
              "SELECT meta_key,meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_key IN(%s,%s,%s)", "block_ip_address", "block_ip_range", "country_blocks"
          )
      );
      $meta_data_array = array();
      foreach ($meta_values as $row) {
         $meta_data_array[$row->meta_key] = maybe_unserialize($row->meta_value);
      }

      $other_settings_array = $meta_data_array["other_settings"];
      $error_message_array = $meta_data_array["error_message"];

      $ip_address = get_ip_address_clean_up_optimizer() == "::1" ? ip2long("127.0.0.1") : ip2long(get_ip_address_clean_up_optimizer());
      $location = get_ip_location_clean_up_optimizer(long2ip($ip_address));
      manage_security_settings_for_clean_up_optimizer($error_message_array, $meta_values_ip_blocks, $ip_address, $location);

      if (array_key_exists("visitor_logs_monitoring", $other_settings_array) && array_key_exists("live_traffic_monitoring", $other_settings_array)) {
         if ($other_settings_array["visitor_logs_monitoring"] == "enable" || $other_settings_array["live_traffic_monitoring"] == "enable") {
            visitor_logs_insertion_clean_up_optimizer($meta_data_array, $ip_address, $location);
         }
      }
   }
   /*
     Function Name: clean_up_optimizer_action_links
     Parameters: Yes
     Description: This function is used to create link for Pro Editions.
     Created On: 21-09-2016 03:56
     Created By: Tech Banker Team
    */
   function clean_up_optimizer_action_links($plugin_link) {
      $plugin_link[] = "<a href=\"https://clean-up-optimizer.tech-banker.com/products/clean-up-optimizer\" style=\"color: red; font-weight: bold;\" target=\"_blank\">Go Pro!</a>";
      return $plugin_link;
   }
   function clean_up_optimizer_settings_action_links($action) {
      global $wpdb;
      $user_role_permission = get_users_capabilities_for_clean_up_optimizer();
      $settings_link = '<a href = "' . admin_url('admin.php?page=cpo_dashboard') . '">' . "Settings" . '</a>';
      array_unshift($action, $settings_link);
      return $action;
   }
   /*
     Function Name: deactivation_function_for_clean_up_optimizer
     Description: This function is used for executing the code on deactivation.
     Parameters: No
     Created On: 06-04-2017 09:19
     Created By: Tech Banker Team
    */
   function deactivation_function_for_clean_up_optimizer() {
      $type = get_option("clean-up-optimizer-wizard-set-up");
      if ($type == "opt_in") {
         $plugin_info_clean_up_optimizer = new plugin_info_clean_up_optimizer();
         global $wp_version, $wpdb;
         $url = tech_banker_stats_url . "/wp-admin/admin-ajax.php";
         $theme_details = array();
         if ($wp_version >= 3.4) {
            $active_theme = wp_get_theme();
            $theme_details["theme_name"] = strip_tags($active_theme->Name);
            $theme_details["theme_version"] = strip_tags($active_theme->Version);
            $theme_details["author_url"] = strip_tags($active_theme->{"Author URI"});
         }

         $plugin_stat_data = array();
         $plugin_stat_data["plugin_slug"] = "wp-clean-up-optimizer";
         $plugin_stat_data["type"] = "standard_edition";
         $plugin_stat_data["version_number"] = clean_up_optimizer_version_number;
         $plugin_stat_data["status"] = $type;
         $plugin_stat_data["event"] = "de-activate";
         $plugin_stat_data["domain_url"] = site_url();
         $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();
         $plugin_stat_data["email"] = get_option("admin_email");
         $plugin_stat_data["wp_version"] = $wp_version;
         $plugin_stat_data["php_version"] = esc_html(phpversion());
         $plugin_stat_data["mysql_version"] = $wpdb->db_version();
         $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
         $plugin_stat_data["operating_system"] = PHP_OS . "  (" . PHP_INT_SIZE * 8 . ") BIT";
         $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit") ? ini_get("memory_limit") : "N/A";
         $plugin_stat_data["extensions"] = get_loaded_extensions();
         $plugin_stat_data["plugins"] = $plugin_info_clean_up_optimizer->get_plugin_info_clean_up_optimizer();
         $plugin_stat_data["themes"] = $theme_details;

         $response = wp_safe_remote_post($url, array
             (
             "method" => "POST",
             "timeout" => 45,
             "redirection" => 5,
             "httpversion" => "1.0",
             "blocking" => true,
             "headers" => array(),
             "body" => array("data" => serialize($plugin_stat_data), "site_id" => get_option("cpo_tech_banker_site_id") != "" ? get_option("cpo_tech_banker_site_id") : "", "action" => "plugin_analysis_data")
         ));

         if (!is_wp_error($response)) {
            $response["body"] != "" ? update_option("cpo_tech_banker_site_id", $response["body"]) : "";
         }
      }
      delete_option("clean-up-optimizer-wizard-set-up");
   }
   /* Hooks */

   /* add_action for admin_functions_clean_up_optimizer
     Description: This hook is used for calling all the Backend Functions
     Created On: 19-11-2016 11:50
     Created by: Tech Banker Team
    */

   add_action("admin_init", "admin_functions_clean_up_optimizer");

   /* add_action for ajax_register_clean_up_optimizer
     Description: This hook is used to register ajax
     Created On: 12-11-2016 14:28
     Created by: Tech Banker Team
    */

   add_action("wp_ajax_clean_up_optimizer_action", "ajax_register_clean_up_optimizer");

   /* add_action for user_functions_clean_up_optimizer
     Description: This hook is used for calling all the Backend Functions
     Created On: 19-11-2016 11:50
     Created by: Tech Banker Team
    */

   add_action("init", "user_functions_clean_up_optimizer");

   /* add_action for sidebar_menu_for_clean_up_optimizer
     Description: This hook is uesd for calling the function of sidebar menu.
     Created On: 23-11-2016 11:50
     Created By: Tech Banker Team
    */

   add_action("admin_menu", "sidebar_menu_for_clean_up_optimizer");

   /*
     add_action for sidebar_menu_for_clean_up_optimizer
     Description: This hook is used for calling the function of sidebar menuin multisite case.
     Created On: 28-10-2016 12:15
     Created By: Tech Banker Team
    */
   add_action("network_admin_menu", "sidebar_menu_for_clean_up_optimizer");

   /* add_action for topbar_menu_for_clean_up_optimizer
     Description: This hook is used for calling the function of topbar menu.
     Created On: 23-09-2016 11:50
     Created By: Tech Banker Team
    */

   add_action("admin_bar_menu", "topbar_menu_for_clean_up_optimizer", 100);

   /*
     add_action for user_login_status_clean_up_optimizer
     Description: This hook is used for calling function of check user login status.
     Created On: 06-10-2016 11:00
     Created By: Tech Banker Team
    */

   add_action("wp_authenticate", "user_login_status_clean_up_optimizer", 10, 2);

   /*
     Add Filter for cron_scheduler_for_intervals_clean_up_optimizer
     Description: This hook is used for calling the function of cron schedulers jobs for wordpress data and database.
     Created On Date: 13-10-2016 12:45
     Created By: Tech Banker Team
    */

   add_filter("cron_schedules", "cron_scheduler_for_intervals_clean_up_optimizer");

   /*
     register_deactivation_hook
     Description: This Hook is used for calling the function of deactivation.
     Created On: 06-04-2017 09:14
     Created By: Tech Banker Team
    */

   register_deactivation_hook(__FILE__, "deactivation_function_for_clean_up_optimizer");


   /* add_filter create Go Pro link for Clean Up optimizer
     Description: This hook is used for create link for premium Editions.
     Created On: 21-09-2016 03:56
     Created by: Tech Banker Team
    */
   add_filter("plugin_action_links_" . plugin_basename(__FILE__), "clean_up_optimizer_action_links");

   /* add_filter create Settings link for Clean Up optimizer
     Description: This hook is used for create link for premium Editions.
     Created On: 04-05-2017 11:53
     Created by: Tech Banker Team
    */
   add_filter("plugin_action_links_" . plugin_basename(__FILE__), "clean_up_optimizer_settings_action_links");
}
/*
  register_activation_hook
  Description: This hook is used for calling the function of install script.
  Created On: 23-09-2016 11:50
  Created By: Tech Banker Team
 */

register_activation_hook(__FILE__, "install_script_for_clean_up_optimizer");

/* add action for install_script_for_clean_up_optimizer
  Description: This hook used for calling the function of install script
  Created On: 08-11-2016 05:41
  Created By: Tech Banker Team
 */

add_action("admin_init", "install_script_for_clean_up_optimizer");

/*
  Function Name: plugin_activate_cleanup_optimizer
  Description: This function is used to add option.
  Parameters: No
  Created On: 27-04-2017 15:30
  Created By: Tech Banker Team
 */
function plugin_activate_cleanup_optimizer() {
   add_option("cleanup_optimizer_do_activation_redirect", true);
}
/*
  Function Name: cleanup_optimizer_redirect
  Description: This function is used to redirect page.
  Parameters: No
  Created On: 27-04-2017 15:35
  Created By: Tech Banker Team
 */
function cleanup_optimizer_redirect() {
   if (get_option("cleanup_optimizer_do_activation_redirect", false)) {
      delete_option("cleanup_optimizer_do_activation_redirect");
      wp_redirect(admin_url("admin.php?page=cpo_dashboard"));
      exit;
   }
}
/*
  register_activation_hook
  Description: This hook is used for calling the function plugin_activate_cleanup_optimizer
  Created On: 27-04-2017 15:40
  Created By: Tech Banker Team
 */

register_activation_hook(__FILE__, "plugin_activate_cleanup_optimizer");

/*
  add_action for cleanup_optimizer_redirect
  Description: This hook is used for calling the function cleanup_optimizer_redirect
  Created On: 27-04-2017 15:50
  Created By: Tech Banker Team
 */

add_action("admin_init", "cleanup_optimizer_redirect");

/*
  Function Name:clean_up_optimizer_admin_notice_class
  Parameter: No
  Description: This function is used to create the object of admin notices.
  Created On: 08-22-2017 16:16
  Created By: Tech Banker Team
 */
function clean_up_optimizer_admin_notice_class() {
   global $wpdb;
   class clean_up_optimizer_admin_notices {
      protected $promo_link = '';
      public $config;
      public $notice_spam = 0;
      public $notice_spam_max = 2;
      // Basic actions to run
      public function __construct($config = array()) {
         // Runs the admin notice ignore function incase a dismiss button has been clicked
         add_action('admin_init', array($this, 'cpo_admin_notice_ignore'));
         // Runs the admin notice temp ignore function incase a temp dismiss link has been clicked
         add_action('admin_init', array($this, 'cpo_admin_notice_temp_ignore'));
         add_action('admin_notices', array($this, 'cpo_display_admin_notices'));
      }
      // Checks to ensure notices aren't disabled and the user has the correct permissions.
      public function cpo_admin_notices() {
         $settings = get_option('cpo_admin_notice');
         if (!isset($settings['disable_admin_notices']) || ( isset($settings['disable_admin_notices']) && $settings['disable_admin_notices'] == 0 )) {
            if (current_user_can('manage_options')) {
               return true;
            }
         }
         return false;
      }
      // Primary notice function that can be called from an outside function sending necessary variables
      public function change_admin_notice_clean_up_optimizer($admin_notices) {
         // Check options
         if (!$this->cpo_admin_notices()) {
            return false;
         }
         foreach ($admin_notices as $slug => $admin_notice) {
            // Call for spam protection
            if ($this->cpo_anti_notice_spam()) {
               return false;
            }

            // Check for proper page to display on
            if (isset($admin_notices[$slug]['pages']) && is_array($admin_notices[$slug]['pages'])) {
               if (!$this->cpo_admin_notice_pages($admin_notices[$slug]['pages'])) {
                  return false;
               }
            }

            // Check for required fields
            if (!$this->cpo_required_fields($admin_notices[$slug])) {

               // Get the current date then set start date to either passed value or current date value and add interval
               $current_date = current_time("m/d/Y");
               $start = ( isset($admin_notices[$slug]['start']) ? $admin_notices[$slug]['start'] : $current_date );
               $start = date("m/d/Y");
               $date_array = explode('/', $start);
               $interval = ( isset($admin_notices[$slug]['int']) ? $admin_notices[$slug]['int'] : 0 );

               $date_array[1] += $interval;
               $start = date("m/d/Y", mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]));

               // This is the main notices storage option
               $admin_notices_option = get_option('cpo_admin_notice', array());
               // Check if the message is already stored and if so just grab the key otherwise store the message and its associated date information
               if (!array_key_exists($slug, $admin_notices_option)) {
                  $admin_notices_option[$slug]['start'] = date("m/d/Y");
                  $admin_notices_option[$slug]['int'] = $interval;
                  update_option('cpo_admin_notice', $admin_notices_option);
               }

               // Sanity check to ensure we have accurate information
               // New date information will not overwrite old date information
               $admin_display_check = ( isset($admin_notices_option[$slug]['dismissed']) ? $admin_notices_option[$slug]['dismissed'] : 0 );
               $admin_display_start = ( isset($admin_notices_option[$slug]['start']) ? $admin_notices_option[$slug]['start'] : $start );
               $admin_display_interval = ( isset($admin_notices_option[$slug]['int']) ? $admin_notices_option[$slug]['int'] : $interval );
               $admin_display_msg = ( isset($admin_notices[$slug]['msg']) ? $admin_notices[$slug]['msg'] : '' );
               $admin_display_title = ( isset($admin_notices[$slug]['title']) ? $admin_notices[$slug]['title'] : '' );
               $admin_display_link = ( isset($admin_notices[$slug]['link']) ? $admin_notices[$slug]['link'] : '' );
               $output_css = false;

               // Ensure the notice hasn't been hidden and that the current date is after the start date
               if ($admin_display_check == 0 && strtotime($admin_display_start) <= strtotime($current_date)) {

                  // Get remaining query string
                  $query_str = ( isset($admin_notices[$slug]['later_link']) ? $admin_notices[$slug]['later_link'] : esc_url(add_query_arg('cpo_admin_notice_ignore', $slug)) );
                  if (strpos($slug, 'promo') === FALSE) {
                     // Admin notice display output
                     echo '<div class="update-nag cpo-admin-notice" style="width:95%!important;">
                               <div></div>
                                <strong><p>' . $admin_display_title . '</p></strong>
                                <strong><p style="font-size:14px !important">' . $admin_display_msg . '</p></strong>
                                <strong><ul>' . $admin_display_link . '</ul></strong>
                              </div>';
                  } else {
                     echo '<div class="admin-notice-promo">';
                     echo $admin_display_msg;
                     echo '<ul class="notice-body-promo blue">
                                    ' . $admin_display_link . '
                                  </ul>';
                     echo '</div>';
                  }
                  $this->notice_spam += 1;
                  $output_css = true;
               }
            }
         }
      }
      // Spam protection check
      public function cpo_anti_notice_spam() {
         if ($this->notice_spam >= $this->notice_spam_max) {
            return true;
         }
         return false;
      }
      // Ignore function that gets ran at admin init to ensure any messages that were dismissed get marked
      public function cpo_admin_notice_ignore() {
         // If user clicks to ignore the notice, update the option to not show it again
         if (isset($_GET['cpo_admin_notice_ignore'])) {
            $admin_notices_option = get_option('cpo_admin_notice', array());
            $admin_notices_option[$_GET['cpo_admin_notice_ignore']]['dismissed'] = 1;
            update_option('cpo_admin_notice', $admin_notices_option);
            $query_str = remove_query_arg('cpo_admin_notice_ignore');
            wp_redirect($query_str);
            exit;
         }
      }
      // Temp Ignore function that gets ran at admin init to ensure any messages that were temp dismissed get their start date changed
      public function cpo_admin_notice_temp_ignore() {
         // If user clicks to temp ignore the notice, update the option to change the start date - default interval of 14 days
         if (isset($_GET['cpo_admin_notice_temp_ignore'])) {
            $admin_notices_option = get_option('cpo_admin_notice', array());
            $current_date = current_time("m/d/Y");
            $date_array = explode('/', $current_date);
            $interval = (isset($_GET['cpo_int']) ? $_GET['cpo_int'] : 7);
            $date_array[1] += $interval;
            $new_start = date("m/d/Y", mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]));

            $admin_notices_option[$_GET['cpo_admin_notice_temp_ignore']]['start'] = $new_start;
            $admin_notices_option[$_GET['cpo_admin_notice_temp_ignore']]['dismissed'] = 0;
            update_option('cpo_admin_notice', $admin_notices_option);
            $query_str = remove_query_arg(array('cpo_admin_notice_temp_ignore', 'cpo_int'));
            wp_redirect($query_str);
            exit;
         }
      }
      public function cpo_admin_notice_pages($pages) {
         foreach ($pages as $key => $page) {
            if (is_array($page)) {
               if (isset($_GET['page']) && $_GET['page'] == $page[0] && isset($_GET['tab']) && $_GET['tab'] == $page[1]) {
                  return true;
               }
            } else {
               if ($page == 'all') {
                  return true;
               }
               if (get_current_screen()->id === $page) {
                  return true;
               }
               if (isset($_GET['page']) && $_GET['page'] == $page) {
                  return true;
               }
            }
            return false;
         }
      }
      // Required fields check
      public function cpo_required_fields($fields) {
         if (!isset($fields['msg']) || ( isset($fields['msg']) && empty($fields['msg']) )) {
            return true;
         }
         if (!isset($fields['title']) || ( isset($fields['title']) && empty($fields['title']) )) {
            return true;
         }
         return false;
      }
      public function cpo_display_admin_notices() {
         $two_week_review_ignore = add_query_arg(array('cpo_admin_notice_ignore' => 'two_week_review'));
         $two_week_review_temp = add_query_arg(array('cpo_admin_notice_temp_ignore' => 'two_week_review', 'int' => 7));

         $notices['two_week_review'] = array(
             'title' => __('Leave A Clean Up Optimizer Review?'),
             'msg' => 'We love and care about you. Clean Up Optimizer Team is putting our maximum efforts to provide you the best functionalities.<br> We would really appreciate if you could spend a couple of seconds to give a Nice Review to the plugin for motivating us!',
             'link' => '<span class="dashicons dashicons-external clean-up-optimizer-admin-notice"></span><span class="clean-up-optimizer-admin-notice"><a href="https://wordpress.org/support/plugin/wp-clean-up-optimizer/reviews/?filter=5" target="_blank" class="clean-up-optimizer-admin-notice-link">' . __('Sure! I\'d love to!', 'cpo') . '</a></span>
                        <span class="dashicons dashicons-smiley clean-up-optimizer-admin-notice"></span><span class="clean-up-optimizer-admin-notice"><a href="' . $two_week_review_ignore . '" class="clean-up-optimizer-admin-notice-link"> ' . __('I\'ve already left a review', 'cpo') . '</a></span>
                        <span class="dashicons dashicons-calendar-alt clean-up-optimizer-admin-notice"></span><span class="clean-up-optimizer-admin-notice"><a href="' . $two_week_review_temp . '" class="clean-up-optimizer-admin-notice-link">' . __('Maybe Later', 'cpo') . '</a></span>',
             'later_link' => $two_week_review_temp,
             'int' => 7
         );

         $this->change_admin_notice_clean_up_optimizer($notices);
      }
   }
   $plugin_info_clean_up_optimizer = new clean_up_optimizer_admin_notices();
}
add_action("init", "clean_up_optimizer_admin_notice_class");
