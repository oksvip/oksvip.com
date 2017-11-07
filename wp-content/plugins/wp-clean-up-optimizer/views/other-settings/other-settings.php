<?php
/**
 * This Template is used for managing Other Plugin settings.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/other_settings
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
   exit;
}//exit if accessed directly
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
   } else if (other_settings_clean_up_optimizer == "1") {
      $clean_up_other_settings = wp_create_nonce("clean_up_other_settings");
      ?>
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li>
               <i class="icon-custom-home"></i>
               <a href="admin.php?page=cpo_dashboard">
                  <?php echo $cpo_clean_up_optimizer; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_general_other_settings; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-wrench"></i>
                     <?php echo $cpo_general_other_settings; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_other_settings">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_other_settings_trackbacks_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_other_settings_trackbacks_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <select name="ux_ddl_trackback" id="ux_ddl_trackback" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_comments; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_other_settings_comments_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <select name="ux_ddl_Comments" id="ux_ddl_Comments" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_other_settings_live_traffic_monitoring_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_other_settings_live_traffic_monitoring_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <select name="ux_ddl_live_traffic_monitoring" id="ux_ddl_live_traffic_monitoring" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_other_settings_visitor_logs_monitoring_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_other_settings_visitor_logs_monitoring_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <select name="ux_ddl_visitor_log_monitoring" id="ux_ddl_visitor_log_monitoring" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
                        </div>


                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpo_other_settings_remove_tables_at_uninstall; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_other_settings_remove_tables_at_uninstall_tooltip; ?>" data-placement="right"></i>
                              <span class="required" aria-required="true">*</span>
                           </label>
                           <select name="ux_ddl_remove_tables" id="ux_ddl_remove_tables" class="form-control">
                              <option value="enable"><?php echo $cpo_enable; ?></option>
                              <option value="disable"><?php echo $cpo_disable; ?></option>
                           </select>
                        </div>

                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpo_other_settings_ip_address_fetching_method; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_other_settings_ip_address_tooltips; ?>" data-placement="right"></i>
                              <span class="required" aria-required="true">*</span>
                           </label>
                           <select name="ux_ddl_ip_address_fetching_method" id="ux_ddl_ip_address_fetching_method" class="form-control">
                              <option value=""><?php echo $cpo_other_settings_ip_address_fetching_option1; ?></option>
                              <option value="REMOTE_ADDR"><?php echo $cpo_other_settings_ip_address_fetching_option2; ?></option>
                              <option value="HTTP_X_FORWARDED_FOR"><?php echo $cpo_other_settings_ip_address_fetching_option3; ?></option>
                              <option value="HTTP_X_REAL_IP"><?php echo $cpo_other_settings_ip_address_fetching_option4; ?></option>
                              <option value="HTTP_CF_CONNECTING_IP"><?php echo $cpo_other_settings_ip_address_fetching_option5; ?></option>
                           </select>
                        </div>
                        <div class="line-separator"></div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="submit" class="btn vivid-green" name="ux_btn_save_changes" id="ux_btn_save_changes" value="<?php echo $cpo_save_changes; ?>">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php
   } else {
      ?>
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li>
               <i class="icon-custom-home"></i>
               <a href="admin.php?page=cpo_dashboard">
                  <?php echo $cpo_clean_up_optimizer; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_general_other_settings; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-wrench"></i>
                     <?php echo $cpo_general_other_settings; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_other_settings">
                     <div class="form-body">
                        <strong><?php echo $cpo_roles_capabilities_message; ?></strong>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php
   }
}