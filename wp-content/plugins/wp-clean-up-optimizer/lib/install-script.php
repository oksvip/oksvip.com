<?php
/**
 * This File is used for creating tables.
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
   if (!current_user_can("manage_options")) {
      return;
   } else {
      /*
        Class Name: dbHelper_install_script_clean_up_optimizer
        Parameters: No
        Description: This Class is used for Insert Update and Delete operations.
        Created On: 23-09-2016 1:10
        Created By: Tech Banker Team
       */
       if(!class_exists("dbHelper_install_script_clean_up_optimizer"))
       {
        class dbHelper_install_script_clean_up_optimizer {
         /*
           Function Name: insertCommand
           Parameters: Yes($table_name,$data)
           Description: This Function is used for Insert data in database.
           -2016: 23-09-2016 1:10
           Created By: Tech Banker Team
          */
         function insertCommand($table_name, $data) {
            global $wpdb;
            $wpdb->insert($table_name, $data);
            return $wpdb->insert_id;
         }
         /*
           Function Name: updateCommand
           Parameters: Yes($table_name,$data,$where)
           Description: This function is used for Update data.
           Created On: 23-09-2016 1:10
           Created By: Tech Banker Team
          */
         function updateCommand($table_name, $data, $where) {
            global $wpdb;
            $wpdb->update($table_name, $data, $where);
         }
         /*
           Function Name: deleteCommand
           Parameters: Yes($table_name,$where)
           Description: This function is used for delete data.
           Created On: 12-09-2016 09:24
           Created By: Tech Banker Team
          */
         function deleteCommand($table_name, $where) {
            global $wpdb;
            $wpdb->delete($table_name, $where);
         }
      }
   }
      require_once ABSPATH . "wp-admin/includes/upgrade.php";
      $clean_up_optimizer_version_number = get_option("wp-cleanup-optimizer-version-number");
      $obj_dbHelper_clean_up_optimizer = new dbHelper_install_script_clean_up_optimizer();
      if (!function_exists("clean_up_optimizer_table")) {
         function clean_up_optimizer_table() {
            global $wpdb;
            $sql = "CREATE TABLE IF NOT EXISTS " . clean_up_optimizer() . "
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`type` longtext NOT NULL,
					`parent_id` int(10) DEFAULT NULL,
					 PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
            dbDelta($sql);

            $data = "INSERT INTO " . clean_up_optimizer() . " (`type`, `parent_id`) VALUES
				('general_settings', 0),
				('advance_security', 0),
				('other_settings', 0)";

            dbDelta($data);

            $parent_table = $wpdb->get_results
                (
                "SELECT * FROM " . clean_up_optimizer()
            );
            $obj_dbHelper_clean_up_optimizer = new dbHelper_install_script_clean_up_optimizer();
            if (isset($parent_table) && count($parent_table) > 0) {
               foreach ($parent_table as $parent) {
                  switch (esc_attr($parent->type)) {
                     case "advance_security":
                        $insert_parent_value = array();
                        $insert_parent_value["blocking_options"] = isset($parent->id) ? intval($parent->id) : 0;
                        $insert_parent_value["country_blocks"] = isset($parent->id) ? intval($parent->id) : 0;
                        foreach ($insert_parent_value as $keys => $value) {
                           $insert_advance_security_data = array();
                           $insert_advance_security_data["type"] = $keys;
                           $insert_advance_security_data["parent_id"] = $value;
                           $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer(), $insert_advance_security_data);
                        }
                        break;

                     case "general_settings":
                        $insert_into_parent = array();
                        $insert_into_parent["alert_setup"] = isset($parent->id) ? intval($parent->id) : 0;
                        $insert_into_parent["error_message"] = isset($parent->id) ? intval($parent->id) : 0;
                        $insert_into_parent["email_templates"] = isset($parent->id) ? intval($parent->id) : 0;
                        $insert_into_parent["roles_and_capabilities"] = isset($parent->id) ? intval($parent->id) : 0;
                        foreach ($insert_into_parent as $keys => $value) {
                           $insert_parent_value = array();
                           $insert_parent_value["type"] = $keys;
                           $insert_parent_value["parent_id"] = $value;
                           $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer(), $insert_parent_value);
                        }
                        break;
                  }
               }
            }
         }
      }
      if (!function_exists("clean_up_optimizer_meta_table")) {
         function clean_up_optimizer_meta_table() {
            global $wpdb;
            $sql = "CREATE TABLE IF NOT EXISTS " . clean_up_optimizer_meta() . "
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`meta_id` int(10) NOT NULL,
					`meta_key` varchar(200) NOT NULL,
					`meta_value` longtext,
					PRIMARY KEY(`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
            dbDelta($sql);

            $admin_email = get_option("admin_email");

            $parent_table_data = $wpdb->get_results
                (
                "SELECT id,type FROM " . clean_up_optimizer()
            );
            $obj_dbHelper_clean_up_optimizer = new dbHelper_install_script_clean_up_optimizer();
            if (isset($parent_table_data) && count($parent_table_data) > 0) {
               foreach ($parent_table_data as $row) {
                  switch (esc_attr($row->type)) {
                     case "roles_and_capabilities":
                        $roles_and_capabilities_data["roles_and_capabilities"] = "1,1,1,0,0,0";
                        $roles_and_capabilities_data["show_clean_up_optimizer_top_bar_menu"] = "enable";
                        $roles_and_capabilities_data["administrator_privileges"] = "1,1,1,1,1,1,1,1,1,1,1,1,1";
                        $roles_and_capabilities_data["author_privileges"] = "0,1,0,1,0,0,1,0,1,1,0,0,0";
                        $roles_and_capabilities_data["editor_privileges"] = "0,0,0,0,0,0,1,0,1,0,1,0,0";
                        $roles_and_capabilities_data["contributor_privileges"] = "0,0,0,0,0,1,0,0,1,0,0,0,0";
                        $roles_and_capabilities_data["subscriber_privileges"] = "0,0,0,0,0,0,0,0,0,0,0,0,0";
                        $roles_and_capabilities_data["others_full_control_capability"] = "0";
                        $roles_and_capabilities_data["other_privileges"] = "0,0,0,0,0,0,0,0,0,0,0,0,0";

                        $user_capabilities = get_others_capabilities_clean_up_optimizer();
                        $other_roles_array = array();
                        $other_roles_access_array = array(
                            "manage_options",
                            "edit_plugins",
                            "edit_posts",
                            "publish_posts",
                            "publish_pages",
                            "edit_pages",
                            "read"
                        );
                        foreach ($other_roles_access_array as $role) {
                           if (in_array($role, $user_capabilities)) {
                              array_push($other_roles_array, $role);
                           }
                        }
                        $roles_and_capabilities_data["capabilities"] = $other_roles_array;

                        $roles_and_capabilities_data_serialize = array();
                        $roles_and_capabilities_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : "";
                        $roles_and_capabilities_data_serialize["meta_key"] = "roles_and_capabilities";
                        $roles_and_capabilities_data_serialize["meta_value"] = serialize($roles_and_capabilities_data);
                        $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $roles_and_capabilities_data_serialize);
                        break;

                     case "country_blocks":
                        $country_blocks_data = array();
                        $country_blocks_data["country_blocks_data"] = "";

                        $advance_security_data_serialize = array();
                        $advance_security_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : "";
                        $advance_security_data_serialize["meta_key"] = "country_blocks";
                        $advance_security_data_serialize["meta_value"] = serialize($country_blocks_data);
                        $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $advance_security_data_serialize);
                        break;

                     case "blocking_options":
                        $blocking_option_data["auto_ip_block"] = "enable";
                        $blocking_option_data["maximum_login_attempt_in_a_day"] = "5";
                        $blocking_option_data["block_for"] = "1Hour";

                        $blocking_option_data_serialize = array();
                        $blocking_option_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : "";
                        $blocking_option_data_serialize["meta_key"] = "blocking_options";
                        $blocking_option_data_serialize["meta_value"] = serialize($blocking_option_data);
                        $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $blocking_option_data_serialize);
                        break;

                     case "alert_setup":
                        $alert_setup_data["email_when_a_user_fails_login"] = "disable";
                        $alert_setup_data["email_when_a_user_success_login"] = "disable";
                        $alert_setup_data["email_when_an_ip_address_is_blocked"] = "disable";
                        $alert_setup_data["email_when_an_ip_address_is_unblocked"] = "disable";
                        $alert_setup_data["email_when_an_ip_range_is_blocked"] = "disable";
                        $alert_setup_data["email_when_an_ip_range_is_unblocked"] = "disable";

                        $alert_setup_data_serialize = array();
                        $alert_setup_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : "";
                        $alert_setup_data_serialize["meta_key"] = "alert_setup";
                        $alert_setup_data_serialize["meta_value"] = serialize($alert_setup_data);
                        $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $alert_setup_data_serialize);
                        break;

                     case "error_message":
                        $error_message_data["for_maximum_login_attempts"] = "<p>Your Maximum <strong>[maxAttempts]</strong> Login Attempts has been Left.</p>";
                        $error_message_data["for_blocked_ip_address_error"] = "<p>Your IP Address <strong>[ip_address]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the website Administrator for more details.</p>";
                        $error_message_data["for_blocked_country_error"] = "<p>Unfortunately, your country location <strong>[country_location]</strong> has been blocked by the Administrator for security purposes.</p><p>Please contact the website Administrator for more details.</p>";
                        $error_message_data["for_blocked_ip_range_error"] = "<p>Your IP Range <strong>[ip_range]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the website Administrator for more details.</p>";

                        $error_message_data_serialize = array();
                        $error_message_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : "";
                        $error_message_data_serialize["meta_key"] = "error_message";
                        $error_message_data_serialize["meta_value"] = serialize($error_message_data);
                        $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $error_message_data_serialize);
                        break;

                     case "other_settings":
                        $other_settings_data["live_traffic_monitoring"] = "disable";
                        $other_settings_data["visitor_logs_monitoring"] = "disable";
                        $other_settings_data["remove_tables_uninstall"] = "enable";
                        $other_settings_data["ip_address_fetching_method"] = "";

                        $other_settings_data_serialize = array();
                        $other_settings_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : "";
                        $other_settings_data_serialize["meta_key"] = "other_settings";
                        $other_settings_data_serialize["meta_value"] = serialize($other_settings_data);
                        $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $other_settings_data_serialize);
                        break;

                     case "email_templates":
                        $email_templates_data = array();
                        $email_templates_data["template_for_user_success"] = "<p>Hi,</p><p>A login attempt has been successfully made to your website [site_url] by user <strong>[username]</strong> at [date_time] from IP Address <strong>[ip_address]</strong>.</p><p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Username:</strong> [username]</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p><strong>Resource:</strong> [resource]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                        $email_templates_data["template_for_user_failure"] = "<p>Hi,</p><p>An unsuccessful attempt to login at your website [site_url] was being made by user <strong>[username]</strong> at [date_time] from IP Address <strong>[ip_address]</strong>.</p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Username:</strong> [username]</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]<p><strong>IP Address:</strong> [ip_address]</p><strong>Resource:</strong>[resource]</p><p>Thanks & Regards</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                        $email_templates_data["template_for_ip_address_blocked"] = "<p>Hi,</p><p>An IP Address <strong>[ip_address]</strong> has been Blocked <strong>[blocked_for]</strong> to your website [site_url]. <p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p><strong>Resource:</strong> [resource]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                        $email_templates_data["template_for_ip_address_unblocked"] = "<p>Hi,</p><p>An IP Address <strong>[ip_address]</strong> has been Unblocked from your website [site_url].</p><p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                        $email_templates_data["template_for_ip_range_blocked"] = "<p>Hi,</p><p>An IP Range from <strong>[start_ip_range]</strong> to <strong>[end_ip_range]</strong> has been Blocked <strong>[blocked_for]</strong> to your website [site_url]. <p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Range:</strong> [ip_range]</p><p><strong>Resource:</strong> [resource]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                        $email_templates_data["template_for_ip_range_unblocked"] = "<p>Hi,</p><p>An IP Range from <strong>[start_ip_range]</strong> to <strong>[end_ip_range]</strong> has been Unblocked from your website [site_url].</p><p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Range:</strong> [ip_range]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";

                        $email_templates_message = array("Login Success Notification - Clean Up Optimizer", "Login Failure Notification - Clean Up Optimizer", "IP Address Blocked Notification - Clean Up Optimizer", "IP Address Unblocked Notification - Clean Up Optimizer", "IP Range Blocked Notification - Clean Up Optimizer", "IP Range Unblocked Notification - Clean Up Optimizer");
                        $count = 0;

                        foreach ($email_templates_data as $keys => $value) {
                           $email_templates_data_array = array();
                           $email_templates_data_array["email_send_to"] = $admin_email;
                           $email_templates_data_array["email_cc"] = "";
                           $email_templates_data_array["email_bcc"] = "";
                           $email_templates_data_array["email_subject"] = $email_templates_message[$count];
                           $email_templates_data_array["email_message"] = $value;
                           $count++;

                           $email_templates_data_serialize = array();
                           $email_templates_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : "";
                           $email_templates_data_serialize["meta_key"] = $keys;
                           $email_templates_data_serialize["meta_value"] = serialize($email_templates_data_array);
                           $obj_dbHelper_clean_up_optimizer->insertCommand(clean_up_optimizer_meta(), $email_templates_data_serialize);
                        }
                        break;
                  }
               }
            }
         }
      }
      $obj_dbHelper_clean_up_optimizer = new dbHelper_install_script_clean_up_optimizer();
      switch ($clean_up_optimizer_version_number) {
         case "":
            clean_up_optimizer_table();
            clean_up_optimizer_meta_table();
            break;

         default:
            if ($clean_up_optimizer_version_number < "3.0.1") {
               if (wp_next_scheduled("wp_clean_up_optimizer_scheduler")) {
                  wp_clear_scheduled_hook("wp_clean_up_optimizer_scheduler");
               }
               $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cleanup_optimizer_db_scheduler");
               $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cleanup_optimizer_wp_scheduler");
               $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cleanup_optimizer_login_log");
               $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cleanup_optimizer_block_single_ip");
               $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cleanup_optimizer_block_range_ip");
               $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cleanup_optimizer_plugin_settings");
               $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cleanup_optimizer_licensing");
            }
            if (count($wpdb->get_var("SHOW TABLES LIKE '" . clean_up_optimizer() . "'")) == 0) {
               clean_up_optimizer_table();
            }
            if (count($wpdb->get_var("SHOW TABLES LIKE '" . clean_up_optimizer_meta() . "'")) == 0) {
               clean_up_optimizer_meta_table();
            } else {
               $other_settings_serialized_data = $wpdb->get_var
                   (
                   $wpdb->prepare
                       (
                       "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
							WHERE meta_key=%s", "other_settings"
                   )
               );
               $other_settings_data = maybe_unserialize($other_settings_serialized_data);
               if (!array_key_exists("ip_address_fetching_method", $other_settings_data)) {
                  $other_settings_data["ip_address_fetching_method"] = "";
               }
               $other_settings_data_serialize = array();
               $where = array();
               $where["meta_key"] = "other_settings";
               $other_settings_data_serialize["meta_value"] = serialize($other_settings_data);
               $obj_dbHelper_clean_up_optimizer->updateCommand(clean_up_optimizer_meta(), $other_settings_data_serialize, $where);
               $get_roles_and_capabilities_data = $wpdb->get_var
                   (
                   $wpdb->prepare
                       (
                       "SELECT meta_value FROM " . clean_up_optimizer_meta() .
                       " WHERE meta_key = %s", "roles_and_capabilities"
                   )
               );
               $roles_and_capabilities_data_array = maybe_unserialize($get_roles_and_capabilities_data);

               if (array_key_exists("roles_and_capabilities", $roles_and_capabilities_data_array)) {
                  $roles_and_capabilities_data = isset($roles_and_capabilities_data_array["roles_and_capabilities"]) ? explode(",", $roles_and_capabilities_data_array["roles_and_capabilities"]) : array();
                  $administrator_roles_and_capabilities_privileges_data = isset($roles_and_capabilities_data_array["administrator_privileges"]) ? explode(',', $roles_and_capabilities_data_array["administrator_privileges"]) : array();
                  $author_roles_and_capabilities_privileges_data = isset($roles_and_capabilities_data_array["author_privileges"]) ? explode(",", $roles_and_capabilities_data_array["author_privileges"]) : array();
                  $editor_roles_and_capabilities_privileges_data = isset($roles_and_capabilities_data_array["editor_privileges"]) ? explode(',', $roles_and_capabilities_data_array["editor_privileges"]) : array();
                  $contributor_roles_and_capabilities_privileges_data = isset($roles_and_capabilities_data_array["contributor_privileges"]) ? explode(',', $roles_and_capabilities_data_array["contributor_privileges"]) : array();
                  $subscriber_roles_and_capabilities_privileges_data = isset($roles_and_capabilities_data_array["subscriber_privileges"]) ? explode(',', $roles_and_capabilities_data_array["subscriber_privileges"]) : array();
                  $other_roles_and_capabilities_privileges_data = isset($roles_and_capabilities_data_array["other_privileges"]) ? explode(',', $roles_and_capabilities_data_array["other_privileges"]) : array();

                  if (count($roles_and_capabilities_data) == 5) {
                     array_push($roles_and_capabilities_data, 0);
                     $roles_and_capabilities_data_array["roles_and_capabilities"] = implode(",", $roles_and_capabilities_data);
                  }

                  if (count($administrator_roles_and_capabilities_privileges_data) == 12) {
                     $administrator_roles_and_capabilities_privileges_data[12] = $administrator_roles_and_capabilities_privileges_data[11];
                     $administrator_roles_and_capabilities_privileges_data[11] = 1;
                     $roles_and_capabilities_data_array["administrator_privileges"] = implode(",", $administrator_roles_and_capabilities_privileges_data);
                  }

                  if (count($author_roles_and_capabilities_privileges_data) == 12) {
                     $author_roles_and_capabilities_privileges_data[12] = $author_roles_and_capabilities_privileges_data[11];
                     $author_roles_and_capabilities_privileges_data[11] = 0;
                     $roles_and_capabilities_data_array["author_privileges"] = implode(",", $author_roles_and_capabilities_privileges_data);
                  }

                  if (count($editor_roles_and_capabilities_privileges_data) == 12) {
                     $editor_roles_and_capabilities_privileges_data[12] = $editor_roles_and_capabilities_privileges_data[11];
                     $editor_roles_and_capabilities_privileges_data[11] = 0;
                     $roles_and_capabilities_data_array["editor_privileges"] = implode(",", $editor_roles_and_capabilities_privileges_data);
                  }

                  if (count($contributor_roles_and_capabilities_privileges_data) == 12) {
                     $contributor_roles_and_capabilities_privileges_data[12] = $contributor_roles_and_capabilities_privileges_data[11];
                     $contributor_roles_and_capabilities_privileges_data[11] = 0;
                     $roles_and_capabilities_data_array["contributor_privileges"] = implode(",", $contributor_roles_and_capabilities_privileges_data);
                  }

                  if (count($subscriber_roles_and_capabilities_privileges_data) == 12) {
                     $subscriber_roles_and_capabilities_privileges_data[12] = $subscriber_roles_and_capabilities_privileges_data[11];
                     $subscriber_roles_and_capabilities_privileges_data[11] = 0;
                     $roles_and_capabilities_data_array["subscriber_privileges"] = implode(",", $subscriber_roles_and_capabilities_privileges_data);
                  }

                  if (count($other_roles_and_capabilities_privileges_data) == 12) {
                     $other_roles_and_capabilities_privileges_data[12] = $other_roles_and_capabilities_privileges_data[11];
                     $other_roles_and_capabilities_privileges_data[11] = 0;
                     $roles_and_capabilities_data_array["other_privileges"] = implode(",", $other_roles_and_capabilities_privileges_data);
                  } else {
                     $roles_and_capabilities_data_array["other_privileges"] = "0,0,0,0,0,0,0,0,0,0,0,0,0";
                  }
                  if (!array_key_exists("others_full_control_capability", $roles_and_capabilities_data_array)) {
                     $roles_and_capabilities_data_array["others_full_control_capability"] = 0;
                  }
                  if (!array_key_exists("capabilities", $roles_and_capabilities_data_array)) {
                     $user_capabilities = get_others_capabilities_clean_up_optimizer();
                     $other_roles_array = array();
                     $other_roles_access_array = array(
                         "manage_options",
                         "edit_plugins",
                         "edit_posts",
                         "publish_posts",
                         "publish_pages",
                         "edit_pages",
                         "read"
                     );
                     foreach ($other_roles_access_array as $role) {
                        if (in_array($role, $user_capabilities)) {
                           array_push($other_roles_array, $role);
                        }
                     }
                     $roles_and_capabilities_data_array["capabilities"] = $other_roles_array;
                  }

                  $where = array();
                  $roles_capabilities_array = array();
                  $where["meta_key"] = "roles_and_capabilities";
                  $roles_capabilities_array["meta_value"] = serialize($roles_and_capabilities_data_array);
                  $obj_dbHelper_clean_up_optimizer->updatecommand(clean_up_optimizer_meta(), $roles_capabilities_array, $where);
               }
            }
            break;
      }
      update_option("wp-cleanup-optimizer-version-number", "4.0.0");
   }
}