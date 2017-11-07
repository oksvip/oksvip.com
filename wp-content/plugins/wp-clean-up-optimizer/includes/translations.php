<?php
/**
 * This File is used for plugin header.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/includes
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

      $cpo_support_forum = __("Ask For Help", "wp-clean-up-optimizer");
      $cpo_upgrade_kanow_about = __("Know about", "wp-clean-up-optimizer");
      $cpo_full_features = __("Full Features", "wp-clean-up-optimizer");
      $cpo_chek_our = __("or check our", "wp-clean-up-optimizer");
      $cpo_online_demos = __("Online Demos", "wp-clean-up-optimizer");

      // Footer
      $cpo_update_blocking_options = __("Blockage Settings have been updated Successfully", "wp-clean-up-optimizer");
      $cpo_advance_security_manage_ip_address = __("IP Address has been blocked Successfully", "wp-clean-up-optimizer");
      $cpo_advance_security_manage_ip_ranges = __("IP Range has been blocked Successfully", "wp-clean-up-optimizer");
      $cpo_delete_blocked_ip_address = __("IP Address has been deleted Successfully", "wp-clean-up-optimizer");
      $cpo_delete_blocked_ip_range = __("IP Range has been deleted Successfully", "wp-clean-up-optimizer");
      $cpo_update_other_settings = __("Other Settings have been updated Successfully", "wp-clean-up-optimizer");
      $cpo_bulk_delete_custom_cron = __("Selected scheduler has been deleted Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up_data = __("Selected Data has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_optimize_tables = __("Selected Tables have been optimized Successfully", "wp-clean-up-optimizer");
      $cpo_optimize_table = __("Selected Table has been optimized Successfully", "wp-clean-up-optimizer");
      $cpo_repair_table = __("Selected Table has been repaired Successfully", "wp-clean-up-optimizer");
      $cpo_repair_tables = __("Selected Tables have been repaired Successfully", "wp-clean-up-optimizer");
      $cpo_delete_db_schedule = __("A Scheduler has been deleted Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up1 = __("Auto Drafts have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up2 = __("Dashboard Transient Feed has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up3 = __("Unapproved Comments have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up4 = __("Orphan Comments Meta has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up5 = __("Orphan Posts Meta has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up6 = __("Orphan Relationships have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up7 = __("Revisions have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up8 = __("Pingbacks have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up9 = __("Transient Options have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up10 = __("Trackbacks have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up11 = __("Spam Comments have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up12 = __("Trash Comments have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up13 = __("Drafts have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up14 = __("Deleted Posts have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up15 = __("Duplicated Post Meta has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up16 = __("oEmbed Caches in Post Meta have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up17 = __("Duplicated Comment Meta has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up18 = __("Orphan User Meta has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up19 = __("Duplicated User Meta has been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up20 = __("Orphaned Term Relationships have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_empty_manual_clean_up21 = __("Unused Terms have been cleaned Successfully", "wp-clean-up-optimizer");
      $cpo_choose_action = __("Please choose an Action from Dropdown!", "wp-clean-up-optimizer");
      $cpo_choose_clean_data = __("Please choose at least 1 type of Data to Clean!", "wp-clean-up-optimizer");
      $cpo_confirm_clean = __("Are you sure you want to Clean?", "wp-clean-up-optimizer");
      $cpo_delete_schedule = __("Are you sure you want to delete?", "wp-clean-up-optimizer");
      $cpo_perform_action = __("Are you sure you want to perform this action?", "wp-clean-up-optimizer");
      $cpo_choose_repair = __("Please choose at least 1 record to repair!", "wp-clean-up-optimizer");
      $cpo_choose_optimize = __("Please choose at least 1 record to optimize!", "wp-clean-up-optimizer");
      $cpo_choose_schedule_delete = __("Please choose at least 1 schedule to delete!", "wp-clean-up-optimizer");
      $cpo_location = __("Location", "wp-clean-up-optimizer");
      $cpo_latitude = __("Latitude", "wp-clean-up-optimizer");
      $cpo_longitude = __("Longitude", "wp-clean-up-optimizer");
      $cpo_http_user_agent = __("HTTP User Agent", "wp-clean-up-optimizer");
      $cpo_not_available = __("N/A", "wp-clean-up-optimizer");
      $cpo_valid_ip_address_message = __("Please provide valid IP Address", "wp-clean-up-optimizer");
      $cpo_valid_ip_address_title = __("Error Message", "wp-clean-up-optimizer");
      $cpo_duplicate_ip_address = __("This IP Address has been already blocked!", "wp-clean-up-optimizer");
      $cpo_duplicate_ip_address_title = __("Notification!", "wp-clean-up-optimizer");
      $cpo_valid_ip_range_message = __("Please provide valid IP Range", "wp-clean-up-optimizer");
      $cpo_duplicate_ip_range = __("This IP Range has been already blocked!", "wp-clean-up-optimizer");
      $cpo_success = __("Success!", "wp-clean-up-optimizer");

      $cpo_delete_table = __("Selected Table has been Deleted Successfully", "wp-clean-up-optimizer");
      $cpo_choose_delete = __("Please choose at least 1 record to delete!", "wp-clean-up-optimizer");
      $cpo_delete_tables = __("Selected Tables have been deleted Successfully", "wp-clean-up-optimizer");
      $message_premium_edition = __("This feature is available only in Premium Editions! <br> Kindly Purchase to unlock it!", "wp-clean-up-optimizer");
      $cpo_delete_traffic_logs = __("A Traffic Log has been deleted Successfully", "wp-clean-up-optimizer");
      $cpo_delete_visitor_logs = __("A Visitor Log has been deleted Successfully", "wp-clean-up-optimizer");
      $cpo_delete_login_log = __("A Login Log has been deleted Successfully", "wp-clean-up-optimizer");

      //database view records

      $cpo_database_manual_clean_up_view_records_label = __("Database - View Records", "wp-clean-up-optimizer");
      $cpo_rows = __("Rows", "wp-clean-up-optimizer");
      $cpo_table_size = __("Table Size", "wp-clean-up-optimizer");
      $cpo_database_view_record_back_button_label = __("<< Back to Manual Clean Up", "wp-clean-up-optimizer");

      $cpo_database_view_record_back_button_label = __("<< Back to Database Optimizer", "wp-clean-up-optimizer");
      $cpo_add_new_wordpress_optimizer_schedule = __("Wordpress - Add New Schedule", "wp-clean-up-optimizer");
      $cpo_update_wordpress_optimizer_schedule = __("Wordpress - Update Schedule", "wp-clean-up-optimizer");
      $cpo_add_new_database_schedule = __("Database - Add New Schedule", "wp-clean-up-optimizer");
      $cpo_update_database_schedule = __("Database - Update Schedule", "wp-clean-up-optimizer");

      //recent Login Logs

      $cpo_recent_logins_on_world_map_label = __("Login Logs On World Map", "wp-clean-up-optimizer");
      $cpo_recent_logins_start_date_tooltip = __("In this field, you would need to specify start date to view information about users who logged within a specified period", "wp-clean-up-optimizer");
      $cpo_recent_logins_end_date_tooltip = __("In this field, you would need to specify end date to view information about users who logged within a specified period", "wp-clean-up-optimizer");

      //live traffic

      $cpo_live_traffic_on_world_map_label = __("Live Traffic On World Map", "wp-clean-up-optimizer");
      $cpo_live_traffic_resources = __("Resources", "wp-clean-up-optimizer");
      $cpo_live_traffic_monitoring_message = __("Live Traffic Monitoring is Turned Off. Please go to Other Settings Menu to enable it", "wp-clean-up-optimizer");

      //Visitor Logs

      $cpo_visitor_log_start_date_tooltip = __("In this field, you would need to specify start date to view information about users who visit to your website within a specified period", "wp-clean-up-optimizer");
      $cpo_visitor_log_end_date_tooltip = __("In this field, you would need to specify end date to view information about users who visit to your website within a specified period", "wp-clean-up-optimizer");
      $cpo_visitor_logs_on_world_map_label = __("Visitor Logs On World Map", "wp-clean-up-optimizer");
      $cpo_visitor_logs_monitoring_message = __("Visitor Logs Monitoring is Turned Off. Please go to Other Settings Menu to enable it", "wp-clean-up-optimizer");

      //alert setup

      $cpo_alert_setup_email_user_fail_login_label = __("Email when a user Fails Login", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_user_fail_login_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when a user fails to login", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_user_success_login_label = __("Email when a user Success Login", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_user_success_login_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when a user succeeds in login", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_address_blocked_label = __("Email when an IP Address is Blocked", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_address_blocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Address is being blocked", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_address_unblocked_label = __("Email when an IP Address is Unblocked", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_address_unblocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Address is being unblocked", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_range_blocked_label = __("Email when an IP Range is Blocked", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_range_blocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Range is being blocked", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_range_unblocked_label = __("Email when an IP Range is Unblocked", "wp-clean-up-optimizer");
      $cpo_alert_setup_email_ip_range_unblocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Range is being unblocked", "wp-clean-up-optimizer");

      //error messasges

      $cpo_error_messages_max_login_attempts_label = __("For Maximum Login Attempts Error Message", "wp-clean-up-optimizer");
      $cpo_error_messages_max_login_attempts_label_tooltip = __("In this field, you would need to provide an error message that you would like to display whenever a user exceeds maximum number of login attempts", "wp-clean-up-optimizer");
      $cpo_error_messages_max_login_attempts_label_placeholder = __("Please provide your Login Attempts Error Message", "wp-clean-up-optimizer");

      $cpo_error_messages_blocked_country_label = __("For Blocked Country Error Message", "wp-clean-up-optimizer");
      $cpo_error_messages_blocked_country_tooltip = __("In this field, you would need to provide an error message that you would like to display whenever a user country is being blocked by the Administrator", "wp-clean-up-optimizer");
      $cpo_error_messages_blocked_country_placeholder = __("Please provide your Blocked Country Error Message", "wp-clean-up-optimizer");

      $cpo_error_messages_max_ip_address_label = __("For Blocked IP Address Error Message", "wp-clean-up-optimizer");
      $cpo_error_messages_max_ip_address_tooltip = __("In this field, you would need to provide an error message that you would like to display whenever a user IP Address is being blocked by the Administrator", "wp-clean-up-optimizer");
      $cpo_error_messages_max_ip_address_placeholder = __("Please provide your Blocked IP Address Error Message", "wp-clean-up-optimizer");

      $cpo_error_messages_max_ip_range_label = __("For Blocked IP Range Error Message", "wp-clean-up-optimizer");
      $cpo_error_messages_max_ip_range_tooltip = __("In this field, you would need to provide an error message that you would like to display whenever a user IP Range is being blocked by the Administrator", "wp-clean-up-optimizer");
      $cpo_error_messages_max_ip_range_placeholder = __("Please provide your Blocked IP Range Error Message", "wp-clean-up-optimizer");

      // other Settings

      $cpo_other_settings_trackbacks_label = __("Trackbacks", "wp-clean-up-optimizer");
      $cpo_other_settings_trackbacks_tooltip = __("Trackbacks are a way to notify legacy blog systems that you have linked to them. If you would like to enable trackbacks to your site then you would need to choose enable or vice-versa from drop-down", "wp-clean-up-optimizer");
      $cpo_other_settings_comments_tooltip = __("If you would like to allow people to comment on your posts or pages then you would need to choose enable or vice-versa from dropdown", "wp-clean-up-optimizer");
      $cpo_other_settings_live_traffic_monitoring_label = __("Live Traffic Monitoring", "wp-clean-up-optimizer");
      $cpo_other_settings_live_traffic_monitoring_tooltip = __("If you would like to monitor details of users who are currently visiting your website and pages visited by them then you would need to choose enable or vice-versa from dropdown", "wp-clean-up-optimizer");
      $cpo_other_settings_visitor_logs_monitoring_label = __("Visitor Logs Monitoring", "wp-clean-up-optimizer");
      $cpo_other_settings_visitor_logs_monitoring_tooltip = __("If you would like to monitor details of users who are visiting your website and pages visited by them then you would need to choose enable or vice-versa from dropdown", "wp-clean-up-optimizer");
      $cpo_other_settings_remove_tables_at_uninstall = __("Remove Tables At Uninstall", "wp-clean-up-optimizer");
      $cpo_other_settings_remove_tables_at_uninstall_tooltip = __("If you would like to remove tables during uninstalling the Plugin then you would need to choose enable or vice-versa from dropdown", "wp-clean-up-optimizer");
      $cpo_other_settings_ip_address_fetching_method = __("How does Clean Up Optimizer get IPs", "wp-clean-up-optimizer");
      $cpo_other_settings_ip_address_tooltips = __("In this field, you would need to choose a specific option  for how does Clean Up Optimizer get IPs", "wp-clean-up-optimizer");
      $cpo_other_settings_ip_address_fetching_option1 = __("Let Clean Up Optimizer use the most secure method to get visitor IP address. Prevents spoofing and works with most sites.", "wp-clean-up-optimizer");
      $cpo_other_settings_ip_address_fetching_option2 = __("Use PHP's built in REMOTE_ADDR and don't use anything else. Very secure if this is compatible with your site.", "wp-clean-up-optimizer");
      $cpo_other_settings_ip_address_fetching_option3 = __("Use the X-Forwarded-For HTTP header. Only use if you have a front-end proxy or spoofing may result.", "wp-clean-up-optimizer");
      $cpo_other_settings_ip_address_fetching_option4 = __("Use the X-Real-IP HTTP header. Only use if you have a front-end proxy or spoofing may result.", "wp-clean-up-optimizer");
      $cpo_other_settings_ip_address_fetching_option5 = __("Use the Cloudflare 'CF-Connecting-IP' HTTP header to get a visitor IP. Only use if you're using Cloudflare.", "wp-clean-up-optimizer");

      // blocking options

      $cpo_blocking_options_auto_ip_block_label = __("Auto IP Block", "wp-clean-up-optimizer");
      $cpo_blocking_options_auto_ip_block_tootltip = __("In this field, you would need to choose Enable to automatically block IP Addresses of users who exceeds their Maximum number of Login attempts", "wp-clean-up-optimizer");
      $cpo_blocking_options_max_login_attempts_day_label = __("Maximum Login Attempts In a Day", "wp-clean-up-optimizer");
      $cpo_blocking_options_max_login_attempts_day_tooltip = __("In this field, you would need to provide maximum number of login attempts in a day to restrict number of login attempts by users", "wp-clean-up-optimizer");
      $cpo_blocking_options_max_login_attempts_day_placeholder = __("Please provide Maximum Login Attempts in a Day", "wp-clean-up-optimizer");
      $cpo_blocking_options_blocked_for_tooltip = __("In this field, you would need to choose a time duration for which you would like to block an IP Address so that particular IP Address will be blocked for a fixed time interval", "wp-clean-up-optimizer");

      //manage ip Addresses

      $cpo_manage_ip_addresses_tooltip = __("In this field, you would need to provide a valid IP Address which you would like to block", "wp-clean-up-optimizer");
      $cpo_manage_ip_addresses_blocked_for_tooltip = __("In this field, you would need to choose duration of time for which you would like to block IP Address", "wp-clean-up-optimizer");
      $cpo_manage_ip_addresses_comments_tooltip = __("In this field, you would need to provide comments to give an overview about reason for blocking these IP Addresses", "wp-clean-up-optimizer");
      $cpo_manage_ip_addresses_comments_placeholder = __("Please provide Comments", "wp-clean-up-optimizer");
      $cpo_manage_ip_addresses_view_block_ip_address_label = __("View Blocked IP Addresses", "wp-clean-up-optimizer");
      $cpo_manage_ip_addresses_start_date_tooltip = __("In this field, you would need to choose start date to view information about IP Addresses which were blocked within a specified period", "wp-clean-up-optimizer");
      $cpo_manage_ip_addresses_end_date_tooltip = __("In this field, you would need to choose end date to view information about IP Addresses which were blocked within a specified period", "wp-clean-up-optimizer");

      // manage ip Ranges

      $cpo_manage_ip_ranges_start_ip_range_label = __("Start IP Range", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_start_ip_range_tooltip = __("In this field, you would need to provide a valid Start IP Ranges which you would like to block", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_start_ip_range_placeholder = __("Please provide Start IP Range", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_end_ip_range_label = __("End IP Range", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_end_ip_range_tooltip = __("In this field, you would need to provide a valid End IP Ranges which you would like to block", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_end_ip_range_placeholder = __("Please provide End IP Range", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_range_blocked_for_tooltip = __("In this field, you would need to choose duration of time for which you would like to block these IP Ranges", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_address_block_ip_range_button_label = __("Block IP Range", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_view_block_ip_range_label = __("View Blocked IP Ranges", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_start_date_tooltip = __("In this field, you would need to choose start date to view information about IP Ranges which were blocked within a specified period", "wp-clean-up-optimizer");
      $cpo_end_date = __("End Date", "wp-clean-up-optimizer");
      $cpo_end_date_placeholder = __("Please choose End Date", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_end_date_tooltip = __("In this field, you would need to choose end date to view information about IP Ranges which were blocked within a specified period", "wp-clean-up-optimizer");
      $cpo_manage_ip_ranges_comments_tooltip = __("In this field, you would need to provide comments to give an overview about reason for blocking these IP Ranges", "wp-clean-up-optimizer");

      //country Blocks

      $cpo_country_blocks_available_countries_label = __("Available Countries", "wp-clean-up-optimizer");
      $cpo_country_blocks_available_countries_tooltip = __("List of all Countries", "wp-clean-up-optimizer");
      $cpo_country_blocks_add_button_label = __("Add >>", "wp-clean-up-optimizer");
      $cpo_country_blocks_remove_button_label = __("<< Remove", "wp-clean-up-optimizer");
      $cpo_country_blocks_blocked_countries_label = __("Blocked Countries", "wp-clean-up-optimizer");
      $cpo_country_blocks_blocked_countries_tooltip = __("List of all Countries being Blocked", "wp-clean-up-optimizer");

      //Email Templates

      $cpo_email_templates_choose_email_template_label = __("Choose Email Template", "wp-clean-up-optimizer");
      $cpo_email_templates_send_to_label = __("Send To", "wp-clean-up-optimizer");
      $cpo_email_templates_cc_label = __("CC", "wp-clean-up-optimizer");
      $cpo_email_templates_bcc_label = __("BCC", "wp-clean-up-optimizer");
      $cpo_email_templates_message_label = __("Message", "wp-clean-up-optimizer");
      $cpo_email_templates_choose_template_tooltip = __("In this field, you would need to choose Email Template from dropdown", "wp-clean-up-optimizer");
      $cpo_email_templates_send_emails_address_tooltip = __("In this field, you would need to provide a valid email address where you would like to send an email notification", "wp-clean-up-optimizer");
      $cpo_email_templates_cc_email_address_tooltip = __("In this field, you would need to provide valid Cc Email Address", "wp-clean-up-optimizer");
      $cpo_email_templates_bcc_email_address_tooltip = __("In this field, you would need to provide valid Bcc Email Address", "wp-clean-up-optimizer");
      $cpo_email_templates_subject_email_tooltip = __("In this field, you would need to provide subject for email notification", "wp-clean-up-optimizer");
      $cpo_email_templates_content_email_tooltip = __("In this field, you would need to provide content which has to be sent to the Administrator", "wp-clean-up-optimizer");
      $cpo_email_templates_successful_login_dropdown = __("Template For User Successful Login", "wp-clean-up-optimizer");
      $cpo_email_templates_failure_login_dropdown = __("Template For User Failure Login", "wp-clean-up-optimizer");
      $cpo_email_templates_ip_address_blocked_dropdown = __("Template For IP Address Blocked", "wp-clean-up-optimizer");
      $cpo_email_templates_ip_address_unblocked_dropdown = __("Template For IP Address Unblocked", "wp-clean-up-optimizer");
      $cpo_email_templates_ip_range_blocked_dropdown = __("Template For IP Range Blocked", "wp-clean-up-optimizer");
      $cpo_email_templates_ip_range_unblocked_dropdown = __("Template For IP Range Unblocked", "wp-clean-up-optimizer");
      $cpo_email_templates_email_address_placeholder = __("Please provide valid Email Address", "wp-clean-up-optimizer");
      $cpo_email_templates_cc_email_placeholder = __("Please provide CC Email", "wp-clean-up-optimizer");
      $cpo_email_templates_bcc_email_placeholder = __("Please provide BCC Email", "wp-clean-up-optimizer");
      $cpo_email_templates_subject_placeholder = __("Please provide Subject", "wp-clean-up-optimizer");

      // Roles And Capabilities

      $cpo_roles_and_capabilities_clean_up_optimizer_menu_label = __("Show Clean Up Optimizer Menu", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_clean_up_top_bar_menu_label = __("Show Clean Up Optimizer Top Bar Menu", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_administrator_role_label = __("An Administrator Role can do the following", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_author_role_label = __("An Author Role can do the following", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_editor_role_label = __("An Editor Role can do the following", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_contributor_role_label = __("A Contributor Role can do the following", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_subscriber_role_label = __("A Subscriber Role can do the following", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_other_role_label = __("Other Roles can do the following", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_administrator_label = __("Administrator", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_author_label = __("Author", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_editor_label = __("Editor", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_contributor_label = __("Contributor", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_subscriber_label = __("Subscriber", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_other_label = __("Others", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_choose_specific_role = __("In this field, you would need to choose a specific role who can see Sidebar Menu", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_clean_up_top_bar_tooltip = __("If you would like to show Clean Up Optimizer Top Bar Menu then you would need to choose enable or vice-versa from dropdown", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_choose_page_admin_access_tooltip = __("Administrators will have by default full control to manage different options in Clean Up Optimizer, so all checkboxes will be already selected for the Administrator Role as mentioned below", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_choose_page_author_access_tooltip = __("You can choose what pages could be accessed by users having an Author Role and you can also choose additional capabilities that could be accessed by users on your Clean Up Optimizer for security purpose which is mentioned below in Author Role checkboxes", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_choose_page_editor_access_tooltip = __("You can choose what pages could be accessed by the users having an Editor Role and you can also choose additional capabilities that could be accessed by users on your Clean Up Optimizer for security purpose which is mentioned below in Editor Role checkboxes", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_choose_page_contributor_access_tooltip = __("You can choose what pages could be accessed by the users having a Contributor Role and you can also choose additional capabilities that could be accessed by users on your Clean Up Optimizer for security purpose which is mentioned below in Contributor Role checkboxes", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_choose_page_subscriber_access_tooltip = __("You can choose what pages could be accessed by the users having a Subscriber Role and you can also choose additional capabilities that could be accessed by users on your Clean Up Optimizer for security purpose which is mentioned below in Subscriber Role checkboxes", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_choose_page_other_access_tooltip = __("You can choose what pages could be accessed by the users having an Others Role and you can also choose additional capabilities that could be accessed by users on your Clean Up Optimizer for security purpose which is mentioned below in Others Role checkboxes", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_full_control_label = __("Full Control", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_other_roles_capabilities = __("In this field, you would need to choose appropriate capabilities for security purposes", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_other_roles_capabilities_tooltip = __("In this field, only users can access to these capabilities of Clean up Optimizer", "wp-clean-up-optimizer");

      // Common Variables

      $cpo_type_of_data = __("Type Of Data", "wp-clean-up-optimizer");
      $cpo_count = __("Count", "wp-clean-up-optimizer");
      $cpo_auto_drafts = __("Auto Drafts", "wp-clean-up-optimizer");
      $cpo_auto_drafts_tooltip = __("WordPress automatically saves Pages or Posts as a draft in WordPress Database. This is called an Auto Draft. You could have multiple Auto Drafts that you will never publish and hence you can clean them", "wp-clean-up-optimizer");
      $cpo_empty = __("Empty", "wp-clean-up-optimizer");
      $cpo_dashboard_transient_feed = __("Dashboard Transient Feed", "wp-clean-up-optimizer");
      $cpo_dashboard_transient_feed_tooltip = __("Transients Feed in WordPress allow developers to store information in your WordPress Database with an expiration time", "wp-clean-up-optimizer");
      $cpo_unapproved_comments = __("Unapproved Comments", "wp-clean-up-optimizer");
      $cpo_unapproved_comments_tooltip = __("Unapproved Comments in WordPress are those comments which are still pending to be approved", "wp-clean-up-optimizer");
      $cpo_orphan_comment_meta = __("Orphan Comments Meta", "wp-clean-up-optimizer");
      $cpo_orphan_comment_meta_tooltip = __("Orphan Comments Meta in WordPress holds miscellaneous bits of extra information of comment", "wp-clean-up-optimizer");
      $cpo_orphan_post_meta = __("Orphan Posts Meta", "wp-clean-up-optimizer");
      $cpo_orphan_post_meta_tooltip = __("Orphan Posts Meta in WordPress is Meta Data belonging to posts which no longer exist", "wp-clean-up-optimizer");
      $cpo_orphan_relationships = __("Orphan Relationships", "wp-clean-up-optimizer");
      $cpo_orphan_relationships_tooltip = __("Orphan Relationships in WordPress hold junk or obsolete Category and Tag", "wp-clean-up-optimizer");
      $cpo_revisions = __("Revisions", "wp-clean-up-optimizer");
      $cpo_revisions_tooltip = __("WordPress Revisions system stores a record of each saved draft or published an update", "wp-clean-up-optimizer");
      $cpo_remove_pingbacks = __("Pingbacks", "wp-clean-up-optimizer");
      $cpo_remove_pingbacks_tooltip = __("In WordPress, Ping-back is a type of comment that is created when you link to another blog post where Ping backs are enabled", "wp-clean-up-optimizer");
      $cpo_remove_transient_options = __("Transient Options", "wp-clean-up-optimizer");
      $cpo_remove_transient_options_tooltip = __("Transient Options are like a basic cache system used by WordPress", "wp-clean-up-optimizer");
      $cpo_remove_trackbacks = __("Trackbacks", "wp-clean-up-optimizer");
      $cpo_remove_trackbacks_tooltip = __("In WordPress, Trackbacks are a way to notify legacy blog systems that you have linked to them", "wp-clean-up-optimizer");
      $cpo_spam_comments = __("Spam Comments", "wp-clean-up-optimizer");
      $cpo_spam_comments_tooltip = __("Spam Comments are unwanted comments in WordPress Database", "wp-clean-up-optimizer");
      $cpo_trash_comments = __("Trash Comments", "wp-clean-up-optimizer");
      $cpo_trash_comments_tooltip = __("Trash Comments are  comments which are stored in WordPress Trash after deletion", "wp-clean-up-optimizer");
      $cpo_drafts = __("Drafts", "wp-clean-up-optimizer");
      $cpo_drafts_tooltip = __("Drafts are New Post or Page created as Draft in WordPress", "wp-clean-up-optimizer");
      $cpo_deleted_posts = __("Deleted Posts", "wp-clean-up-optimizer");
      $cpo_deleted_posts_tooltip = __("Deleted Posts are posts which are removed from WordPress Database", "wp-clean-up-optimizer");
      $cpo_duplicated_post_meta = __("Duplicated Post Meta", "wp-clean-up-optimizer");
      $cpo_duplicated_post_meta_tooltip = __("Duplicated Post Meta is duplicated values of Posts stored in a Posts Table in WordPress Database", "wp-clean-up-optimizer");
      $cpo_oEmbed_caches_post_meta = __("oEmbed Caches in Post Meta", "wp-clean-up-optimizer");
      $cpo_oEmbed_caches_post_meta_tooltip = __("oEmbed Caches in Post Meta hold data related to Embeddable Content in WordPress Database", "wp-clean-up-optimizer");
      $cpo_duplicated_comment_meta = __("Duplicated Comment Meta", "wp-clean-up-optimizer");
      $cpo_duplicated_comment_meta_tooltip = __("Duplicated Comment Meta holds information of Duplicate Comments in Comments Table in WordPress Database", "wp-clean-up-optimizer");
      $cpo_orphan_user_meta = __("Orphan User Meta", "wp-clean-up-optimizer");
      $cpo_orphan_user_meta_tooltip = __("Orphan User Meta holds orphan data of an Usermeta table in WordPress Database", "wp-clean-up-optimizer");
      $cpo_duplicated_user_meta = __("Duplicated User Meta", "wp-clean-up-optimizer");
      $cpo_duplicated_user_meta_tooltip = __("Duplicated User Meta holds information of Duplicate user meta data in WordPress Database", "wp-clean-up-optimizer");
      $cpo_orphaned_term_relationships = __("Orphaned Term Relationships", "wp-clean-up-optimizer");
      $cpo_orphaned_term_relationships_tooltip = __("Orphaned Term Relationships hold junk or obsolete term Category and Tag in WordPress Database", "wp-clean-up-optimizer");
      $cpo_unused_terms = __("Unused Terms", "wp-clean-up-optimizer");
      $cpo_unused_terms_tooltip = __("Unused Terms hold term data which are not used by WordPress", "wp-clean-up-optimizer");

      $cpo_type = __("Type", "wp-clean-up-optimizer");
      $cpo_scheduled_start_date_time = __("Start Date & Time", "wp-clean-up-optimizer");

      $cpo_data_update_scheduled_clean_up = __("Update Schedule", "wp-clean-up-optimizer");
      $cpo_data_action_label_scheduled_clean_up_tooltip = __("If you would like to empty selected types of data on a schedule then you would need to choose an Action from dropdown", "wp-clean-up-optimizer");
      $cpo_add_new_scheduled_duration_label_tooltip = __("In this field, you would need to choose Time Duration for schedule to run. It could be Hourly or Daily", "wp-clean-up-optimizer");

      $cpo_table_name_heading = __("Table Name", "wp-clean-up-optimizer");

      $cpo_clean_up_clear_button_label = __("Clear", "wp-clean-up-optimizer");
      $cpo_clean_up_blocked_for_label = __("Blocked For", "wp-clean-up-optimizer");
      $cpo_one_hour = __("1 Hour", "wp-clean-up-optimizer");
      $cpo_twelve_hours = __("12 Hours", "wp-clean-up-optimizer");
      $cpo_twenty_four_hours = __("24 Hours", "wp-clean-up-optimizer");
      $cpo_forty_eight_hours = __("48 Hours", "wp-clean-up-optimizer");
      $cpo_one_week = __("1 Week", "wp-clean-up-optimizer");
      $cpo_one_month = __("1 Month", "wp-clean-up-optimizer");
      $cpo_one_permanently = __("Permanently", "wp-clean-up-optimizer");
      $cpo_never = __("Never", "wp-clean-up-optimizer");
      $cpo_edit_tooltip = __("Edit", "wp-clean-up-optimizer");
      $cpo_for = __("for", "wp-clean-up-optimizer");

      $cpo_apply = __("Apply", "wp-clean-up-optimizer");
      $cpo_delete = __("Delete", "wp-clean-up-optimizer");
      $cpo_block_ip_address = __("Block IP Address", "wp-clean-up-optimizer");
      $cpo_ip_address = __("IP Address", "wp-clean-up-optimizer");
      $cpo_duration = __("Duration", "wp-clean-up-optimizer");
      $cpo_table_heading_blocked_date_time = __("Blocked Date & Time", "wp-clean-up-optimizer");
      $cpo_table_heading_release_date_time = __("Release Date & Time", "wp-clean-up-optimizer");
      $cpo_comments = __("Comments", "wp-clean-up-optimizer");

      $cpo_hourly = __("Hourly", "wp-clean-up-optimizer");
      $cpo_daily = __("Daily", "wp-clean-up-optimizer");
      $cpo_start_on = __("Start On", "wp-clean-up-optimizer");
      $cpo_start_on_placeholder = __("Please choose Start On", "wp-clean-up-optimizer");
      $cpo_start_on_tooltip = __("In this field, you would need to choose start date for scheduler to run", "wp-clean-up-optimizer");
      $cpo_start_time = __("Start Time", "wp-clean-up-optimizer");
      $cpo_start_time_tooltip = __("In this field, you would need to choose a start time for scheduler to run at", "wp-clean-up-optimizer");
      $cpo_repeat_every = __("Repeat Every", "wp-clean-up-optimizer");
      $cpo_repeat_every_tooltip = __("In this field, you would need to choose Repetition for the scheduler. The scheduler would be run on selected values from dropdown", "wp-clean-up-optimizer");
      $cpo_hrs = __(" hrs", "wp-clean-up-optimizer");
      $cpo_mins = __(" mins", "wp-clean-up-optimizer");

      $cpo_table_heading_ip_range = __("IP Ranges", "wp-clean-up-optimizer");

      $cpo_start_date = __("Start Date", "wp-clean-up-optimizer");
      $cpo_start_date_placeholder = __("Please choose Start Date", "wp-clean-up-optimizer");
      $cpo_end_date = __("End Date", "wp-clean-up-optimizer");
      $cpo_submit = __("Submit", "wp-clean-up-optimizer");
      $cpo_table_heading_user_name = __("User Name", "wp-clean-up-optimizer");
      $cpo_table_heading_date_time = __("Date & Time", "wp-clean-up-optimizer");
      $cpo_table_heading_status = __("Status", "wp-clean-up-optimizer");
      $cpo_table_heading_details = __("Details", "wp-clean-up-optimizer");
      $cpo_name_hook_label = __("Name of the Hook", "wp-clean-up-optimizer");
      $cpo_interval_hook_label = __("Interval Hook", "wp-clean-up-optimizer");
      $cpo_args_label = __("Args", "wp-clean-up-optimizer");
      $cpo_next_execution_label = __("Next Execution", "wp-clean-up-optimizer");
      $cpo_subject_label = __("Subject", "wp-clean-up-optimizer");
      $cpo_bulk_action_dropdown = __("Bulk Action", "wp-clean-up-optimizer");
      $cpo_action = __("Action", "wp-clean-up-optimizer");
      $cpo_optimize_dropdown = __("Optimize", "wp-clean-up-optimizer");
      $cpo_repair_dropdown = __("Repair", "wp-clean-up-optimizer");

      $cpo_roles_capabilities_label = __("Roles & Capabilities", "wp-clean-up-optimizer");
      $cpo_dashboard = __("Dashboard", "wp-clean-up-optimizer");
      $cpo_wp_optimizer = __("WP Optimizer", "wp-clean-up-optimizer");
      $cpo_schedule_wp_optimizer = __("WP Scheduler Optimizer", "wp-clean-up-optimizer");
      $cpo_database_optimizer = __("DB Optimizer", "wp-clean-up-optimizer");
      $cpo_schedule_database_optimizer = __("Scheduler DB Optimizer", "wp-clean-up-optimizer");
      $cpo_add_new_scheduled_clean_up_label = __("Add New Schedule", "wp-clean-up-optimizer");
      $cpo_view_records_label = __("View Records", "wp-clean-up-optimizer");
      $cpo_logs_label = __("Logs", "wp-clean-up-optimizer");
      $cpo_logs_recent_login_logs = __("Login Logs", "wp-clean-up-optimizer");
      $cpo_logs_live_traffic = __("Live Traffic", "wp-clean-up-optimizer");
      $cpo_logs_visitor_logs = __("Visitor Logs", "wp-clean-up-optimizer");
      $cpo_general_settings_label = __("General Settings", "wp-clean-up-optimizer");
      $cpo_notifications_setup = __("Notifications Setup", "wp-clean-up-optimizer");
      $cpo_message_settings = __("Message Settings", "wp-clean-up-optimizer");
      $cpo_general_other_settings = __("Other Settings", "wp-clean-up-optimizer");
      $cpo_security_settings = __("Security Settings", "wp-clean-up-optimizer");
      $cpo_blockage_settings = __("Blockage Settings", "wp-clean-up-optimizer");
      $cpo_block_unblock_ip_addresses = __("Block / Unblock IP Addresses", "wp-clean-up-optimizer");
      $cpo_block_unblock_ip_ranges = __("Block / Unblock IP Ranges", "wp-clean-up-optimizer");
      $cpo_block_unblock_countries = __("Block / Unblock Countries", "wp-clean-up-optimizer");
      $cpo_email_templates_label = __("Email Templates", "wp-clean-up-optimizer");
      $cpo_roles_and_capabilities_label = __("Roles & Capabilities", "wp-clean-up-optimizer");
      $cpo_cron_jobs_label = __("Cron Jobs", "wp-clean-up-optimizer");
      $cpo_cron_custom_jobs_label = __("Custom Jobs", "wp-clean-up-optimizer");
      $cpo_cron_core_jobs_label = __("Core Jobs", "wp-clean-up-optimizer");
      $cpo_system_information_label = __("System Information", "wp-clean-up-optimizer");
      $cpo_licensing_label = __("Licensing", "wp-clean-up-optimizer");
      $cpo_enable = __("Enable", "wp-clean-up-optimizer");
      $cpo_disable = __("Disable", "wp-clean-up-optimizer");
      $cpo_clean_up_optimizer = __("Clean Up Optimizer", "wp-clean-up-optimizer");
      $cpo_save_changes = __("Save Changes", "wp-clean-up-optimizer");
      $cpo_roles_capabilities_message = __("You do not have Sufficient Access to this Page. Kindly contact the Administrator for more Privileges", "wp-clean-up-optimizer");
      $cpo_block = __("Block", "wp-clean-up-optimizer");
      $cpo_upgrade = __("Premium Editions", "wp-clean-up-optimizer");
      $cpo_premium_editions_label = __("Premium Editions", "wp-clean-up-optimizer");
      $cpo_upgrade_to = __("Upgrade to Premium Editions", "wp-clean-up-optimizer");
   }
}