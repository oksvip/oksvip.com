<?php
/**
 * This File is used for managing database.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/lib
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
if (!is_user_logged_in()) {
   return;
} else {
   $access_granted = false;
   if (isset($user_role_permission) && count($user_role_permission) > 0) {
      foreach ($user_role_permission as $permission) {
         if (current_user_can($permission)) {
            $access_granted = true;
            break;
         }
      }
   }
   if (!$access_granted) {
      return;
   } else {
      if (file_exists(CLEAN_UP_OPTIMIZER_DIR_PATH . "includes/translations.php")) {
         include CLEAN_UP_OPTIMIZER_DIR_PATH . "includes/translations.php";
      }
      function get_excluded_termids_clean_up_optimizer() {
         $default_term_ids = get_default_taxonomy_termids_clean_up_optimizer();
         if (!is_array($default_term_ids)) {
            $default_term_ids = array();
         }
         $parent_term_ids = get_parent_termids_clean_up_optimizer();
         if (!is_array($parent_term_ids)) {
            $parent_term_ids = array();
         }
         return array_merge($default_term_ids, $parent_term_ids);
      }
      function get_default_taxonomy_termids_clean_up_optimizer() {
         $taxonomies = get_taxonomies();
         $default_term_ids = array();
         if ($taxonomies) {
            $tax = array_keys($taxonomies);
            if ($tax) {
               foreach ($tax as $t) {
                  $term_id = intval(get_option("default_" . $t));
                  if ($term_id > 0) {
                     $default_term_ids[] = $term_id;
                  }
               }
            }
         }
         return $default_term_ids;
      }
      function get_parent_termids_clean_up_optimizer() {
         global $wpdb;
         return $wpdb->get_col
                 (
                 $wpdb->prepare
                     (
                     "SELECT tt.parent FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt
						ON t.term_id = tt.term_id
						WHERE  tt.parent > %d", "0"
                 )
         );
      }
      function get_clean_up_optimizer_unserialize_data($manage_data) {
         $unserialize_complete_data = array();
         if (count($manage_data) > 0) {
            foreach ($manage_data as $value) {
               $unserialize_data = maybe_unserialize($value->meta_value);
               $unserialize_data["meta_id"] = isset($value->meta_id) ? intval($value->meta_id) : 0;
               array_push($unserialize_complete_data, $unserialize_data);
            }
         }
         return $unserialize_complete_data;
      }
      function clean_up_optimizer_data($types) {
         global $wpdb;
         $obj = new dbHelper_clean_up_optimizer();
         $where = array();
         switch ($types) {
            case 1:
               $where["post_status"] = "auto-draft";
               $obj->deleteCommand($wpdb->posts, $where);
               break;

            case 2:
               $wpdb->query
                   (
                   $wpdb->prepare
                       (
                       "DELETE FROM " . $wpdb->options . " WHERE option_name LIKE %s OR option_name LIKE %s OR option_name LIKE %s OR option_name LIKE %s", "_site_transient_browser_%", "_site_transient_timeout_browser_%", "_transient_feed_%", "_transient_timeout_feed_%"
                   )
               );
               break;

            case 3:
               $where["comment_approved"] = "0";
               $obj->deleteCommand($wpdb->comments, $where);
               break;

            case 4:
               $wpdb->query
                   (
                   "DELETE FROM " . $wpdb->commentmeta . " WHERE comment_id NOT IN (SELECT comment_id FROM $wpdb->comments)"
               );
               break;

            case 5:
               $wpdb->query
                   (
                   "DELETE pm FROM " . $wpdb->postmeta . " pm LEFT JOIN $wpdb->posts wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL"
               );
               break;

            case 6:
               $wpdb->query
                   (
                   $wpdb->prepare
                       (
                       "DELETE FROM " . $wpdb->term_relationships . " WHERE term_taxonomy_id=%d AND object_id NOT IN (SELECT id FROM " . $wpdb->posts . ")", 1
                   )
               );
               break;

            case 7:
               $where["post_type"] = "revision";
               $obj->deleteCommand($wpdb->posts, $where);
               break;

            case 8:
               $where["comment_type"] = "pingback";
               $obj->deleteCommand($wpdb->comments, $where);
               break;

            case 9:
               $wpdb->query
                   (
                   $wpdb->prepare
                       (
                       "DELETE FROM " . $wpdb->options . " WHERE option_name LIKE %s OR option_name LIKE %s", "_transient_%", "_site_transient_%"
                   )
               );
               break;

            case 10:
               $where["comment_type"] = "trackback";
               $obj->deleteCommand($wpdb->comments, $where);
               break;

            case 11:
               $where["comment_approved"] = "spam";
               $obj->deleteCommand($wpdb->comments, $where);
               break;

            case 12:
               $where["comment_approved"] = "trash";
               $obj->deleteCommand($wpdb->comments, $where);
               break;

            case 13:
               $where["post_status"] = "draft";
               $obj->deleteCommand($wpdb->posts, $where);
               break;

            case 14:
               $where["post_status"] = "trash";
               $obj->deleteCommand($wpdb->posts, $where);
               break;

            case 15:
               if (!function_exists("get_where_sql")) {

                  function get_where_sql() {
                     global $wpdb;
                     return sprintf("WHERE meta_id NOT IN (
										SELECT *
										FROM (
											SELECT MAX(meta_id)
											FROM $wpdb->postmeta
											GROUP BY post_id, meta_key,meta_value
										) AS x
									)"
                     );
                  }
               }
               $where_sql = get_where_sql();
               $query_sql = "DELETE FROM {$wpdb->postmeta} " . $where_sql;
               $wpdb->query($query_sql);
               echo "1";
               break;

            case 16:
               $query = $wpdb->get_results
                   (
                   $wpdb->prepare
                       (
                       "SELECT post_id, meta_key FROM $wpdb->postmeta WHERE meta_key LIKE (%s)", "%_oembed_%"
                   )
               );
               if ($query) {
                  foreach ($query as $meta) {
                     $post_id = intval($meta->post_id);
                     if ($post_id === 0) {
                        $wpdb->query
                            (
                            $wpdb->prepare
                                (
                                "DELETE FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta->meta_key
                            )
                        );
                     } else {
                        delete_post_meta($post_id, $meta->meta_key);
                     }
                  }
               }
               break;

            case 17:
               $query = $wpdb->get_results
                   (
                   $wpdb->prepare
                       (
                       "SELECT GROUP_CONCAT(meta_id ORDER BY meta_id DESC) AS ids, comment_id, COUNT(*) AS count
								FROM $wpdb->commentmeta GROUP BY comment_id, meta_key, meta_value HAVING count > %d", 1
                   )
               );
               if ($query) {
                  foreach ($query as $meta) {
                     $ids = array_map("intval", explode(",", $meta->ids));
                     array_pop($ids);
                     $wpdb->query
                         (
                         $wpdb->prepare
                             (
                             "DELETE FROM $wpdb->commentmeta WHERE meta_id IN (" . implode(",", $ids) . ") AND comment_id = %d", intval($meta->comment_id)
                         )
                     );
                  }
               }
               break;

            case 18:
               $wpdb->query
                   (
                   "DELETE FROM " . $wpdb->usermeta . " WHERE user_id NOT IN (SELECT ID FROM " . $wpdb->users . ")"
               );
               break;

            case 19:
               $query = $wpdb->get_results
                   (
                   $wpdb->prepare
                       (
                       "SELECT GROUP_CONCAT(umeta_id ORDER BY umeta_id DESC) AS ids, user_id, COUNT(*) AS count
								FROM $wpdb->usermeta GROUP BY user_id, meta_key, meta_value HAVING count > %d", 1
                   )
               );
               if ($query) {
                  foreach ($query as $meta) {
                     $ids = array_map("intval", explode(",", $meta->ids));
                     array_pop($ids);
                     $wpdb->query
                         (
                         $wpdb->prepare
                             (
                             "DELETE FROM $wpdb->usermeta WHERE umeta_id IN (" . implode(",", $ids) . ") AND user_id = %d", intval($meta->user_id)
                         )
                     );
                  }
               }
               break;

            case 20:
               $query = $wpdb->get_results
                   (
                   "SELECT tr.object_id, tt.term_id, tt.taxonomy FROM $wpdb->term_relationships AS tr
							INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
							WHERE tt.taxonomy != 'link_category' AND tr.object_id NOT IN (SELECT ID FROM $wpdb->posts)"
               );
               if ($query) {
                  foreach ($query as $tax) {
                     wp_remove_object_terms(intval($tax->object_id), intval($tax->term_id), $tax->taxonomy);
                  }
               }
               break;

            case 21:
               $query = $wpdb->get_results
                   (
                   $wpdb->prepare
                       (
                       "SELECT tt.term_taxonomy_id, t.term_id, tt.taxonomy FROM $wpdb->terms AS t
								INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
								WHERE tt.count = %d AND t.term_id NOT IN (" . implode(",", get_excluded_termids_clean_up_optimizer()) . ")", 0
                   )
               );
               if ($query) {
                  $check_wp_terms = false;
                  foreach ($query as $tax) {
                     if (taxonomy_exists($tax->taxonomy)) {
                        wp_delete_term(intval($tax->term_id), $tax->taxonomy);
                     } else {
                        $wpdb->query
                            (
                            $wpdb->prepare
                                (
                                "DELETE FROM $wpdb->term_taxonomy WHERE term_taxonomy_id = %d", intval($tax->term_taxonomy_id)
                            )
                        );
                        $check_wp_terms = true;
                     }
                  }
               }
               break;
         }
      }
      if (isset($_REQUEST["param"])) {
         $obj_dbHelper_clean_up_optimizer = new dbHelper_clean_up_optimizer();
         switch (esc_attr($_REQUEST["param"])) {
            case "wizard_clean_up_optimizer":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "clean_up_optimizer_check_status")) {
                  $type = isset($_REQUEST["type"]) ? sanitize_text_field($_REQUEST["type"]) : "";
                  update_option("clean-up-optimizer-wizard-set-up", $type);
                  if ($type == "opt_in") {
                     $plugin_info_clean_up_optimizer = new plugin_info_clean_up_optimizer();
                     global $wp_version;

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
                     $plugin_stat_data["event"] = "activate";
                     $plugin_stat_data["domain_url"] = site_url();
                     $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();
                     $plugin_stat_data["email"] = get_option("admin_email");
                     $plugin_stat_data["wp_version"] = $wp_version;
                     $plugin_stat_data["php_version"] = sanitize_text_field(phpversion());
                     $plugin_stat_data["mysql_version"] = $wpdb->db_version();
                     $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
                     $plugin_stat_data["operating_system"] = PHP_OS . "  (" . PHP_INT_SIZE * 8 . ") BIT";
                     $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit") ? ini_get("memory_limit") : "N/A";
                     $plugin_stat_data["extensions"] = get_loaded_extensions();
                     $plugin_stat_data["plugins"] = $plugin_info_clean_up_optimizer->get_plugin_info_clean_up_optimizer();
                     $plugin_stat_data["themes"] = $theme_details;
                     $url = tech_banker_stats_url . "/wp-admin/admin-ajax.php";
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
               }
               break;

            case "manual_clean_up_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "wordpress_data_manual_clean_up")) {
                  $types = isset($_REQUEST["data"]) ? array_map("intval", is_array(json_decode(stripslashes(html_entity_decode($_REQUEST["data"])))) ? json_decode(stripslashes(html_entity_decode($_REQUEST["data"]))) : array()) : array();
                  for ($flag = 0; $flag < count($types); $flag++) {
                     clean_up_optimizer_data($types[$flag]);
                  }
               }
               break;

            case "manual_clean_up_empty_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "empty_manual_clean_up")) {
                  $types = isset($_REQUEST["delete_id"]) ? intval($_REQUEST["delete_id"]) : 0;
                  clean_up_optimizer_data($types);
               }
               break;

            case "bulk_action_manual_clean_up_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "manual_db_bulk_action")) {
                  $action = isset($_REQUEST["table_action"]) ? sanitize_text_field($_REQUEST["table_action"]) : "";
                  $table_name = isset($_REQUEST["data"]) ? array_map("sanitize_text_field", is_array(json_decode(stripslashes(html_entity_decode($_REQUEST["data"])))) ? json_decode(stripslashes(html_entity_decode($_REQUEST["data"]))) : array()) : array();
                  if (isset($table_name) && count($table_name) > 0) {
                     $wpdb->query
                         (
                         "SET FOREIGN_KEY_CHECKS = 0"
                     );
                     foreach ($table_name as $row) {
                        switch ($action) {
                           case "delete":
                              $wpdb->query
                                  (
                                  "DROP TABLE IF EXISTS $row"
                              );
                              break;

                           case "optimize":
                              $wpdb->query
                                  (
                                  "OPTIMIZE TABLE $row"
                              );
                              break;
                        }
                     }
                     $wpdb->query
                         (
                         "SET FOREIGN_KEY_CHECKS = 1"
                     );
                  }
               }
               break;

            case "select_action_manual_clean_up_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "manual_db_select_action")) {
                  $action = isset($_REQUEST["perform_action"]) ? sanitize_text_field($_REQUEST["perform_action"]) : "";
                  $table_name = isset($_REQUEST["table_name"]) ? sanitize_text_field($_REQUEST["table_name"]) : "";
                  switch ($action) {
                     case "optimize":
                        $wpdb->query
                            (
                            "OPTIMIZE TABLE $table_name"
                        );
                        break;

                     case "delete":
                        $wpdb->query
                            (
                            "SET FOREIGN_KEY_CHECKS = 0"
                        );
                        $wpdb->query
                            (
                            "DROP TABLE IF EXISTS $table_name"
                        );
                        $wpdb->query
                            (
                            "SET FOREIGN_KEY_CHECKS = 1"
                        );
                        break;
                  }
               }
               break;

            case "other_settings_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "clean_up_other_settings")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $other_settings_array);
                  $update_clean_up_type = array();
                  $where = array();
                  if ($other_settings_array["ux_ddl_trackback"] == "enable") {
                     $trackback = $wpdb->query
                         (
                         $wpdb->prepare
                             (
                             "UPDATE " . $wpdb->posts . " SET ping_status=%s", "open"
                         )
                     );
                  } else {
                     $trackback = $wpdb->query
                         (
                         $wpdb->prepare
                             (
                             "UPDATE " . $wpdb->posts . " SET ping_status=%s", "closed"
                         )
                     );
                  }
                  if ($other_settings_array["ux_ddl_Comments"] == "enable") {
                     $comments = $wpdb->query
                         (
                         $wpdb->prepare
                             (
                             "UPDATE " . $wpdb->posts . " SET comment_status=%s", "open"
                         )
                     );
                  } else {
                     $comments = $wpdb->query
                         (
                         $wpdb->prepare
                             (
                             "UPDATE " . $wpdb->posts . " SET comment_status=%s", "closed"
                         )
                     );
                  }

                  $update_clean_up_type["live_traffic_monitoring"] = isset($other_settings_array["ux_ddl_live_traffic_monitoring"]) ? sanitize_text_field($other_settings_array["ux_ddl_live_traffic_monitoring"]) : "";
                  $update_clean_up_type["visitor_logs_monitoring"] = isset($other_settings_array["ux_ddl_visitor_log_monitoring"]) ? sanitize_text_field($other_settings_array["ux_ddl_visitor_log_monitoring"]) : "";
                  $update_clean_up_type["remove_tables_uninstall"] = isset($other_settings_array["ux_ddl_remove_tables"]) ? sanitize_text_field($other_settings_array["ux_ddl_remove_tables"]) : "";
                  $update_clean_up_type["ip_address_fetching_method"] = isset($other_settings_array["ux_ddl_ip_address_fetching_method"]) ? sanitize_text_field($other_settings_array["ux_ddl_ip_address_fetching_method"]) : "";
                  $update_data = array();
                  $where["meta_key"] = "other_settings";
                  $update_data["meta_value"] = serialize($update_clean_up_type);
                  $obj_dbHelper_clean_up_optimizer->updateCommand(clean_up_optimizer_meta(), $update_data, $where);
               }
               break;

            case "delete_selected_traffic_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "traffic_delete")) {
                  $confirm_id = isset($_REQUEST["confirm_id"]) ? intval($_REQUEST["confirm_id"]) : 0;
                  $where_meta = array();
                  $where_parent = array();
                  $where_meta["meta_id"] = $confirm_id;
                  $where_parent["id"] = $confirm_id;
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer_meta(), $where_meta);
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer(), $where_parent);
               }
               break;

            case "visitor_log_delete_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "visitor_log_delete")) {
                  $confirm_id = isset($_REQUEST["confirm_id"]) ? intval($_REQUEST["confirm_id"]) : 0;
                  $where_meta = array();
                  $where_parent = array();
                  $where_meta["meta_id"] = $confirm_id;
                  $where_parent["id"] = $confirm_id;
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer_meta(), $where_meta);
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer(), $where_parent);
               }
               break;

            case "delete_selected_recent_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "recent_selected_delete")) {
                  $login_id = isset($_REQUEST["login_id"]) ? intval($_REQUEST["login_id"]) : 0;
                  $where = array();
                  $where_parent = array();
                  $where["meta_id"] = $login_id;
                  $where_parent["id"] = $login_id;
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer_meta(), $where);
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer(), $where_parent);
               }
               break;

            case "blocking_options_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "clean_up_block")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $blocking_option_array);
                  $update_type = array();
                  $where = array();

                  $update_type["auto_ip_block"] = isset($blocking_option_array["ux_ddl_auto_ip"]) ? sanitize_text_field($blocking_option_array["ux_ddl_auto_ip"]) : "";
                  $update_type["maximum_login_attempt_in_a_day"] = isset($blocking_option_array["ux_txt_login"]) ? intval($blocking_option_array["ux_txt_login"]) : 0;
                  $update_type["block_for"] = isset($blocking_option_array["ux_ddl_blocked_for"]) ? sanitize_text_field($blocking_option_array["ux_ddl_blocked_for"]) : "";

                  $update_block_data = array();
                  $where["meta_key"] = "blocking_options";
                  $update_block_data["meta_value"] = serialize($update_type);
                  $obj_dbHelper_clean_up_optimizer->updateCommand(clean_up_optimizer_meta(), $update_block_data, $where);
               }
               break;

            case "manage_ip_address_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "clean_up_manage_ip_address")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $advance_security_data);
                  $ip = isset($_REQUEST["ip_address"]) ? ip2long(sanitize_text_field($_REQUEST["ip_address"])) : "";
                  $get_ip = get_ip_location_clean_up_optimizer(long2ip($ip));
                  $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;

                  $ip_address_count = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT meta_value FROM " . clean_up_optimizer_meta() . " WHERE meta_key = %s", "block_ip_address"
                      )
                  );
                  if (isset($ip_address_count) && count($ip_address_count) > 0) {
                     foreach ($ip_address_count as $data) {
                        $ip_address_unserialize = maybe_unserialize($data->meta_value);
                        $ip_address_unserialize_check = isset($ip_address_unserialize["ip_address"]) ? doubleval($ip_address_unserialize["ip_address"]) : 0;
                        if ($ip == $ip_address_unserialize_check) {
                           echo "1";
                           die();
                        }
                     }
                  }
                  $ip_address_ranges_data = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT meta_value FROM " . clean_up_optimizer_meta() . " WHERE meta_key = %s", "block_ip_range"
                      )
                  );
                  $ip_exists = false;
                  if (isset($ip_address_ranges_data) && count($ip_address_ranges_data) > 0) {
                     foreach ($ip_address_ranges_data as $data) {
                        $ip_range_unserialized_data = maybe_unserialize($data->meta_value);
                        $ip_range_unserialized_data_match = isset($ip_range_unserialized_data["ip_range"]) ? sanitize_text_field($ip_range_unserialized_data["ip_range"]) : "";
                        $data_range = explode(",", $ip_range_unserialized_data_match);
                        if ($ip >= $data_range[0] && $ip <= $data_range[1]) {
                           $ip_exists = true;
                           break;
                        }
                     }
                  }
                  if ($ip_exists == true) {
                     echo 1;
                  } else {
                     $insert_manage_ip_address = array();
                     $insert_manage_ip_address["type"] = "block_ip_address";
                     $insert_manage_ip_address["parent_id"] = "0";
                     $last_id = $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer(), $insert_manage_ip_address);

                     $insert_manage_ip_address = array();
                     $insert_manage_ip_address["ip_address"] = $ip;
                     $insert_manage_ip_address["blocked_for"] = isset($advance_security_data["ux_ddl_ip_blocked_for"]) ? sanitize_text_field($advance_security_data["ux_ddl_ip_blocked_for"]) : "";
                     $insert_manage_ip_address["location"] = isset($location) ? sanitize_text_field($location) : "";
                     $insert_manage_ip_address["comments"] = isset($advance_security_data["ux_txtarea_ip_comments"]) ? sanitize_text_field($advance_security_data["ux_txtarea_ip_comments"]) : "";
                     $insert_manage_ip_address["date_time"] = clean_up_optimizer_local_time;

                     $insert_data = array();
                     $insert_data["meta_id"] = $last_id;
                     $insert_data["meta_key"] = "block_ip_address";
                     $insert_data["meta_value"] = serialize($insert_manage_ip_address);
                     $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $insert_data);


                     $time_interval = isset($advance_security_data["ux_ddl_ip_blocked_for"]) ? sanitize_text_field($advance_security_data["ux_ddl_ip_blocked_for"]) : "";
                     if ($time_interval != "permanently") {
                        $cron_name = "ip_address_unblocker_" . $last_id;
                        schedule_clean_up_optimizer_ip_address_and_ranges($cron_name, $time_interval);
                     }
                  }
               }
               break;

            case "delete_ip_address_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "clean_up_manage_ip_address_delete")) {
                  $id = isset($_REQUEST["id_address"]) ? intval($_REQUEST["id_address"]) : 0;
                  $where = array();
                  $where_parent = array();
                  $where["meta_id"] = $id;
                  $where_parent["id"] = $id;
                  $cron_name = "ip_address_unblocker_" . $id;
                  unschedule_events_clean_up_optimizer($cron_name);
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer_meta(), $where);
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer(), $where_parent);
               }
               break;

            case "delete_ip_range_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "clean_up_manage_ip_ranges_delete")) {
                  $id_range = isset($_REQUEST["id_range"]) ? intval($_REQUEST["id_range"]) : 0;
                  $where = array();
                  $where_parent = array();
                  $where["meta_id"] = $id_range;
                  $where_parent["id"] = $id_range;
                  $cron_name = "ip_range_unblocker_" . $where["meta_id"];
                  unschedule_events_clean_up_optimizer($cron_name);
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer_meta(), $where);
                  $obj_dbHelper_clean_up_optimizer->deleteCommand(clean_up_optimizer(), $where_parent);
               }
               break;

            case "manage_ip_ranges_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "clean_up_manage_ip_ranges")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $ip_range_data);
                  $start_ip_range = isset($_REQUEST["start_range"]) ? ip2long(sanitize_text_field($_REQUEST["start_range"])) : "";
                  $end_ip_range = isset($_REQUEST["end_range"]) ? ip2long(sanitize_text_field($_REQUEST["end_range"])) : "";
                  $ip_range = $start_ip_range . "," . $end_ip_range;
                  $get_ip = get_ip_location_clean_up_optimizer(long2ip($start_ip_range));
                  $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;
                  $ip_address_range_data = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT meta_value FROM " . clean_up_optimizer_meta() . " WHERE meta_key = %s", "block_ip_range"
                      )
                  );
                  $ip_exists = false;
                  if (isset($ip_address_range_data) && count($ip_address_range_data) > 0) {
                     foreach ($ip_address_range_data as $data) {
                        $ip_range_unserialized_data = maybe_unserialize($data->meta_value);
                        $ip_range_unserialized_match_data = isset($ip_range_unserialized_data["ip_range"]) ? sanitize_text_field($ip_range_unserialized_data["ip_range"]) : "";
                        $data_range = explode(",", $ip_range_unserialized_match_data);
                        if (($start_ip_range >= $data_range[0] && $start_ip_range <= $data_range[1]) || ($end_ip_range >= $data_range[0] && $end_ip_range <= $data_range[1])) {
                           echo 1;
                           $ip_exists = true;
                           break;
                        } elseif (($start_ip_range <= $data_range[0] && $start_ip_range <= $data_range[1]) && ($end_ip_range >= $data_range[0] && $end_ip_range >= $data_range[1])) {
                           echo 1;
                           $ip_exists = true;
                           break;
                        }
                     }
                  }
                  if ($ip_exists == false) {
                     $insert_manage_ip_range = array();
                     $insert_manage_ip_range["type"] = "block_ip_range";
                     $insert_manage_ip_range["parent_id"] = "0";
                     $last_id = $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer(), $insert_manage_ip_range);

                     $insert_manage_ip_range = array();
                     $insert_manage_ip_range["ip_range"] = $ip_range;
                     $insert_manage_ip_range["blocked_for"] = isset($ip_range_data["ux_ddl_range_blocked"]) ? sanitize_text_field($ip_range_data["ux_ddl_range_blocked"]) : "";
                     $insert_manage_ip_range["location"] = isset($location) ? sanitize_text_field($location) : "";
                     $insert_manage_ip_range["comments"] = isset($ip_range_data["ux_txtarea_manage_ip_range"]) ? sanitize_text_field($ip_range_data["ux_txtarea_manage_ip_range"]) : "";
                     $insert_manage_ip_range["date_time"] = clean_up_optimizer_local_time;

                     $insert_data = array();
                     $insert_data["meta_id"] = $last_id;
                     $insert_data["meta_key"] = "block_ip_range";
                     $insert_data["meta_value"] = serialize($insert_manage_ip_range);
                     $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $insert_data);

                     $time_interval = isset($ip_range_data["ux_ddl_range_blocked"]) ? sanitize_text_field($ip_range_data["ux_ddl_range_blocked"]) : "";
                     if ($time_interval != "permanently") {
                        $cron_name = "ip_range_unblocker_" . $last_id;
                        schedule_clean_up_optimizer_ip_address_and_ranges($cron_name, $time_interval);
                     }
                  }
               }
               break;

            case "change_email_template_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? $_REQUEST["_wp_nonce"] : "", "email_template_data")) {
                  $templates = isset($_REQUEST["data"]) ? sanitize_text_field($_REQUEST["data"]) : "";
                  $templates_data = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT * FROM " . clean_up_optimizer_meta() .
                          " WHERE meta_key = %s", $templates
                      )
                  );
                  $email_template_data = get_clean_up_optimizer_unserialize_data($templates_data);
                  echo json_encode($email_template_data);
               }
               break;
         }
         die();
      }
   }
}