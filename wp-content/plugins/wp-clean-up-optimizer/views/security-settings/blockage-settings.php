<?php
/**
 * This Template is used for displaying blocking options.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/security-settings
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
   } else if (security_settings_clean_up_optimizer == "1") {
      $clean_up_block = wp_create_nonce("clean_up_block");
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
               <a href="admin.php?page=cpo_blockage_settings">
                  <?php echo $cpo_security_settings; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_blockage_settings; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-shield"></i>
                     <?php echo $cpo_blockage_settings; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_blocking_options">
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpo_blocking_options_auto_ip_block_label; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_blocking_options_auto_ip_block_tootltip; ?>" data-placement="right"></i>
                              <span class="required" aria-required="true">*</span>
                           </label>
                           <select name="ux_ddl_auto_ip" id="ux_ddl_auto_ip" class="form-control" onchange="change_mailer_type_clean_up_optimizer();">
                              <option value="enable"><?php echo $cpo_enable; ?></option>
                              <option value="disable"><?php echo $cpo_disable; ?></option>
                           </select>
                        </div>
                        <div id="ux_div_auto_ip">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label">
                                       <?php echo $cpo_blocking_options_max_login_attempts_day_label; ?> :
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_blocking_options_max_login_attempts_day_tooltip; ?>" data-placement="right"></i>
                                       <span class="required" aria-required="true">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="ux_txt_login" id="ux_txt_login" value="<?php echo isset($blocking_option_array["maximum_login_attempt_in_a_day"]) ? intval($blocking_option_array["maximum_login_attempt_in_a_day"]) : "" ?>" onfocus="prevent_paste_clean_up_optimizer(this.id);" placeholder="<?php echo $cpo_blocking_options_max_login_attempts_day_placeholder; ?>" onkeypress="paste_only_digits_clean_up_optimizer(this.id);" maxlength="4">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label">
                                       <?php echo $cpo_clean_up_blocked_for_label; ?> :
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_blocking_options_blocked_for_tooltip; ?>" data-placement="right"></i>
                                       <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="input-icon right">
                                       <select name="ux_ddl_blocked_for" id="ux_ddl_blocked_for" class="form-control">
                                          <option value="1Hour"><?php echo $cpo_one_hour; ?></option>
                                          <option value="12Hour"><?php echo $cpo_twelve_hours; ?></option>
                                          <option value="24hours"><?php echo $cpo_twenty_four_hours; ?></option>
                                          <option value="48hours"><?php echo $cpo_forty_eight_hours; ?></option>
                                          <option value="week"><?php echo $cpo_one_week; ?></option>
                                          <option value="month"><?php echo $cpo_one_month; ?></option>
                                          <option value="permanently"><?php echo $cpo_one_permanently; ?></option>
                                       </select>
                                    </div>
                                 </div>
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
               <a href="admin.php?page=cpo_blockage_settings">
                  <?php echo $cpo_security_settings; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_blockage_settings; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-shield"></i>
                     <?php echo $cpo_blockage_settings; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_blocking_options">
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