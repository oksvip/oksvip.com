<?php
/**
 * This Template is used for managing settings for email.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/general-settings
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
   } else if (general_settings_clean_up_optimizer == "1") {
      $clean_up_alert_setup = wp_create_nonce("clean_up_alert_setup");
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
               <a href="admin.php?page=cpo_notifications_setup">
                  <?php echo $cpo_general_settings_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_notifications_setup; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-bell"></i>
                     <?php echo $cpo_notifications_setup; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_alert_setup">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_alert_setup_email_user_fail_login_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_alert_setup_email_user_fail_login_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <select name="ux_ddl_fail" id="ux_ddl_fail" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_alert_setup_email_user_success_login_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_alert_setup_email_user_success_login_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <select name="ux_ddl_success" id="ux_ddl_success" class="form-control">
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
                                    <?php echo $cpo_alert_setup_email_ip_address_blocked_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_alert_setup_email_ip_address_blocked_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <select name="ux_ddl_ip_address_blocked" id="ux_ddl_ip_address_blocked" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_alert_setup_email_ip_address_unblocked_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_alert_setup_email_ip_address_unblocked_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <select name="ux_ddl_ip_address_unblocked" id="ux_ddl_ip_address_unblocked" class="form-control">
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
                                    <?php echo $cpo_alert_setup_email_ip_range_blocked_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_alert_setup_email_ip_range_blocked_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <select name="ux_ddl_ip_range_blocked" id="ux_ddl_ip_range_blocked" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_alert_setup_email_ip_range_unblocked_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_alert_setup_email_ip_range_unblocked_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <select name="ux_ddl_ip_range_unblocked" id="ux_ddl_ip_range_unblocked" class="form-control">
                                    <option value="enable"><?php echo $cpo_enable; ?></option>
                                    <option value="disable"><?php echo $cpo_disable; ?></option>
                                 </select>
                              </div>
                           </div>
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
               <a href="admin.php?page=cpo_notifications_setup">
                  <?php echo $cpo_general_settings_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_notifications_setup; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-bell"></i>
                     <?php echo $cpo_notifications_setup; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_alert_setup">
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