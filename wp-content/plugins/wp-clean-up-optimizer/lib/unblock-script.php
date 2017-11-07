<?php
/**
 * This File is used for unscheduling schedulers.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/lib
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
if (defined("DOING_CRON") && DOING_CRON) {
   if (wp_verify_nonce($nonce_unblock_script, "unblock_script")) {
      if (strstr(scheduler_name, "ip_address_unblocker_")) {
         $meta_id = explode("ip_address_unblocker_", scheduler_name);
      } else {
         $meta_id = explode("ip_range_unblocker_", scheduler_name);
      }
      $where = array();
      $where_parent = array();
      $where["meta_id"] = $meta_id[1];
      $where_parent["id"] = $meta_id[1];
      $type = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT type FROM " . clean_up_optimizer() . "
				WHERE id = %d", $meta_id[1]
          )
      );
      if ($type != "") {
         $manage_ip = $wpdb->get_var
             (
             $wpdb->prepare
                 (
                 "SELECT meta_value FROM " . clean_up_optimizer_meta() . "
					WHERE meta_id=%d AND meta_key=%s", $meta_id[1], $type
             )
         );

         $ip_address_data_array = maybe_unserialize($manage_ip);

         $wpdb->delete(clean_up_optimizer(), $where_parent);
         $wpdb->delete(clean_up_optimizer_meta(), $where);
      }
      unschedule_events_clean_up_optimizer(scheduler_name);
   }
}