<?php

/**
 * This File is used to drop Tables and Unschedule schedulers at uninstall.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/lib
 * @version 3.0.0
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
if (!current_user_can("manage_options")) {
    return;
} else {
    global $wpdb;
    if (is_multisite()) {
        $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
        foreach ($blog_ids as $blog_id) {
            switch_to_blog($blog_id);
            $clean_up_optimizer_version_number = get_option("wp-cleanup-optimizer-version-number");
            if ($clean_up_optimizer_version_number != "") {
                global $wpdb;
                $other_settings_data = $wpdb->get_var
                        (
                        $wpdb->prepare
                                (
                                "SELECT meta_value FROM " . $wpdb->prefix . "clean_up_optimizer_meta
                             WHERE meta_key = %s ", "other_settings"
                        )
                );
                $other_settings_unserialized_data = maybe_unserialize($other_settings_data);

                if (esc_attr($other_settings_unserialized_data["remove_tables_uninstall"]) == "enable") {


                    // Drop Tables
                    $wpdb->query("DROP TABLE IF EXISTS  " . $wpdb->prefix . "clean_up_optimizer");
                    $wpdb->query("DROP TABLE IF EXISTS  " . $wpdb->prefix . "clean_up_optimizer_meta");

                    delete_option("wp-cleanup-optimizer-version-number");
                    delete_option("cpo_admin_notice");
                    delete_option("clean-up-optimizer-api-details");
                    delete_option("clean-up-optimizer-wizard-set-up");
                }
            }
            restore_current_blog();
        }
    } else {
        $clean_up_optimizer_version_number = get_option("wp-cleanup-optimizer-version-number");
        if ($clean_up_optimizer_version_number != "") {
            global $wpdb;
            $other_settings_data = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . $wpdb->prefix . "clean_up_optimizer_meta
                             WHERE meta_key = %s ", "other_settings"
                    )
            );
            $other_settings_unserialized_data = maybe_unserialize($other_settings_data);

            if (esc_attr($other_settings_unserialized_data["remove_tables_uninstall"]) == "enable") {


                // Drop Tables
                $wpdb->query("DROP TABLE IF EXISTS  " . $wpdb->prefix . "clean_up_optimizer");
                $wpdb->query("DROP TABLE IF EXISTS  " . $wpdb->prefix . "clean_up_optimizer_meta");

                delete_option("wp-cleanup-optimizer-version-number");
                delete_option("cpo_admin_notice");
                delete_option("clean-up-optimizer-api-details");
            }
        }
    }
}
