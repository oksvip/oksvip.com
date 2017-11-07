<?php
/**
 * This Template is used for managing roles and capabilities.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/general-settings
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
   } else if (general_settings_clean_up_optimizer == "1") {
      $roles_and_capabilities = explode(",", isset($details_roles_capabilities["roles_and_capabilities"]) ? esc_attr($details_roles_capabilities["roles_and_capabilities"]) : "");
      $administrator = explode(",", isset($details_roles_capabilities["administrator_privileges"]) ? esc_attr($details_roles_capabilities["administrator_privileges"]) : "");
      $author = explode(",", isset($details_roles_capabilities["author_privileges"]) ? esc_attr($details_roles_capabilities["author_privileges"]) : "");
      $editor = explode(",", isset($details_roles_capabilities["editor_privileges"]) ? esc_attr($details_roles_capabilities["editor_privileges"]) : "");
      $contributor = explode(",", isset($details_roles_capabilities["contributor_privileges"]) ? esc_attr($details_roles_capabilities["contributor_privileges"]) : "");
      $subscriber = explode(",", isset($details_roles_capabilities["subscriber_privileges"]) ? esc_attr($details_roles_capabilities["subscriber_privileges"]) : "");
      $other = explode(",", isset($details_roles_capabilities["other_privileges"]) ? esc_attr($details_roles_capabilities["other_privileges"]) : "");
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
                  <?php echo $cpo_roles_capabilities_label; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-users"></i>
                     <?php echo $cpo_roles_capabilities_label; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_roles_and_capabilities">
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpo_roles_and_capabilities_clean_up_optimizer_menu_label; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_choose_specific_role; ?>" data-placement="right"></i>
                              <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                           </label>
                           <table class="table table-striped table-bordered table-margin-top" id="ux_tbl_clean_up_roles">
                              <thead>
                                 <tr>
                                    <th>
                                       <input type="checkbox"  name="ux_chk_administrator" id="ux_chk_administrator" value="1" checked="checked" disabled="disabled" <?php echo $roles_and_capabilities[0] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpo_roles_and_capabilities_administrator_label; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox"  name="ux_chk_author" id="ux_chk_author"  value="1" onclick="show_roles_capabilities_clean_up_optimizer(this, 'ux_div_author_roles');" <?php echo $roles_and_capabilities[1] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpo_roles_and_capabilities_author_label; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox"  name="ux_chk_editor" id="ux_chk_editor" value="1" onclick="show_roles_capabilities_clean_up_optimizer(this, 'ux_div_editor_roles');" <?php echo $roles_and_capabilities[2] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpo_roles_and_capabilities_editor_label; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox"  name="ux_chk_contributor" id="ux_chk_contributor"  value="1" onclick="show_roles_capabilities_clean_up_optimizer(this, 'ux_div_contributor_roles');" <?php echo $roles_and_capabilities[3] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpo_roles_and_capabilities_contributor_label; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox"  name="ux_chk_subscriber" id="ux_chk_subscriber" value="1" onclick="show_roles_capabilities_clean_up_optimizer(this, 'ux_div_subscriber_roles');" <?php echo $roles_and_capabilities[4] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpo_roles_and_capabilities_subscriber_label; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox"  name="ux_chk_other" id="ux_chk_other" value="1" onclick="show_roles_capabilities_clean_up_optimizer(this, 'ux_div_other_roles');" <?php echo $roles_and_capabilities[5] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpo_roles_and_capabilities_other_label; ?>
                                    </th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpo_roles_and_capabilities_clean_up_top_bar_menu_label; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_clean_up_top_bar_tooltip; ?>" data-placement="right"></i>
                              <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                           </label>
                           <select name="ux_ddl_clean_up_optimizer_menu" id="ux_ddl_clean_up_optimizer_menu" class="form-control">
                              <option value="enable"><?php echo $cpo_enable; ?></option>
                              <option value="disable"><?php echo $cpo_disable; ?></option>
                           </select>
                        </div>
                        <div class="line-separator"></div>
                        <div class="form-group">
                           <div id="ux_div_administrator_roles">
                              <label class="control-label">
                                 <?php echo $cpo_roles_and_capabilities_administrator_role_label; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_choose_page_admin_access_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_administrator">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_administrator" id="ux_chk_full_control_administrator" checked="checked" disabled="disabled" value="1">
                                             <?php echo $cpo_roles_and_capabilities_full_control_label; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_data_manual_clean_up_admin" disabled="disabled" checked="checked" id="ux_chk_wordpress_data_manual_clean_up_admin" value="1">
                                             <?php echo $cpo_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_schedule_manual_clean_up_admin" disabled="disabled" checked="checked" id="ux_chk_wordpress_schedule_manual_clean_up_admin" value="1">
                                             <?php echo $cpo_schedule_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_manual_clean_up_admin" disabled="disabled" checked="checked" id="ux_chk_database_manual_clean_up_admin" value="1">
                                             <?php echo $cpo_database_optimizer; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_schedule_clean_up_admin" disabled="disabled" checked="checked" id="ux_chk_database_schedule_clean_up_admin" value="1">
                                             <?php echo $cpo_schedule_database_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_admin" disabled="disabled" checked="checked" id="ux_chk_logs_admin" value="1">
                                             <?php echo $cpo_logs_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_cron_jobs_admin" disabled="disabled" checked="checked" id="ux_chk_cron_jobs_admin" value="1">
                                             <?php echo $cpo_cron_jobs_label; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_admin" disabled="disabled" checked="checked" id="ux_chk_general_settings_admin" value="1">
                                             <?php echo $cpo_general_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_admin" disabled="disabled" checked="checked" id="ux_chk_advance_security_admin" value="1">
                                             <?php echo $cpo_security_settings; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_template_admin" disabled="disabled" checked="checked" id="ux_chk_template_admin" value="1">
                                             <?php echo $cpo_general_other_settings; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_admin" disabled="disabled" checked="checked" id="ux_chk_system_information_admin" value="1">
                                             <?php echo $cpo_system_information_label; ?>
                                          </td>
                                          <td>
                                          </td>
                                          <td>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_author_roles">
                              <label class="control-label">
                                 <?php echo $cpo_roles_and_capabilities_author_role_label; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_choose_page_author_access_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_author">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_author" id="ux_chk_full_control_author" value="1"  onclick="full_control_function_clean_up_optimizer(this, 'ux_div_author_roles');"  <?php echo isset($author) && $author[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_roles_and_capabilities_full_control_label; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_data_manual_clean_up_author" id="ux_chk_wordpress_data_manual_clean_up_author" value="1" <?php echo isset($author) && $author[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_schedule_manual_clean_up_author" id="ux_chk_wordpress_schedule_manual_clean_up_author" value="1" <?php echo isset($author) && $author[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_manual_clean_up_author" id="ux_chk_database_manual_clean_up_author" value="1" <?php echo isset($author) && $author[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_database_optimizer; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_schedule_clean_up_author" id="ux_chk_database_schedule_clean_up_author" value="1" <?php echo isset($author) && $author[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_database_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_author" id="ux_chk_logs_author" value="1" <?php echo isset($author) && $author[5] == "1" ? "checked = checked" : "" ?>?>
                                             <?php echo $cpo_logs_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_cron_jobs_author" id="ux_chk_cron_jobs_author" value="1" <?php echo isset($author) && $author[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_cron_jobs_label; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_author" id="ux_chk_general_settings_author" value="1" <?php echo isset($author) && $author[7] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_author" id="ux_chk_advance_security_author" value="1" <?php echo isset($author) && $author[9] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_security_settings; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_author" id="ux_chk_templates_author" value="1" <?php echo isset($author) && $author[8] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_other_settings; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_author" id="ux_chk_system_information_author" value="1" <?php echo isset($author) && $author[10] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_system_information_label; ?>
                                          </td>
                                          <td>
                                          </td>
                                          <td>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_editor_roles">
                              <label class="control-label">
                                 <?php echo $cpo_roles_and_capabilities_editor_role_label; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_choose_page_editor_access_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_editor">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_editor" id="ux_chk_full_control_editor" value="1" onclick="full_control_function_clean_up_optimizer(this, 'ux_div_editor_roles');" <?php echo isset($editor) && $editor[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_roles_and_capabilities_full_control_label; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_data_manual_clean_up_editor" id="ux_chk_wordpress_data_manual_clean_up_editor" value="1" <?php echo isset($editor) && $editor[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_schedule_manual_clean_up_editor" id="ux_chk_wordpress_schedule_manual_clean_up_editor" value="1" <?php echo isset($editor) && $editor[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_manual_clean_up_editor" id="ux_chk_database_manual_clean_up_editor" value="1" <?php echo isset($editor) && $editor[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_database_optimizer; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_schedule_clean_up_editor" id="ux_chk_database_schedule_clean_up_editor" value="1" <?php echo isset($editor) && $editor[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_database_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_editor" id="ux_chk_logs_editor" value="1" <?php echo isset($editor) && $editor[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_logs_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_cron_jobs_editor" id="ux_chk_cron_jobs_editor" value="1" <?php echo isset($editor) && $editor[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_cron_jobs_label; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_editor" id="ux_chk_general_settings_editor" value="1" <?php echo isset($editor) && $editor[7] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_editor" id="ux_chk_advance_security_editor" value="1" <?php echo isset($editor) && $editor[9] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_security_settings; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_editor" id="ux_chk_templates_editor" value="1" <?php echo isset($editor) && $editor[8] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_other_settings; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_editor" id="ux_chk_system_information_editor" value="1" <?php echo isset($editor) && $editor[10] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_system_information_label; ?>
                                          </td>
                                          <td>
                                          </td>
                                          <td>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_contributor_roles">
                              <label class="control-label">
                                 <?php echo $cpo_roles_and_capabilities_contributor_role_label; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_choose_page_contributor_access_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_contributor">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_contributor" id="ux_chk_full_control_contributor" value="1" onclick="full_control_function_clean_up_optimizer(this, 'ux_div_contributor_roles');" <?php echo isset($contributor) && $contributor[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_roles_and_capabilities_full_control_label; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_data_manual_clean_up_contributor" id="ux_chk_wordpress_data_manual_clean_up_contributor" value="1" <?php echo isset($contributor) && $contributor[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_schedule_manual_clean_up_contributor" id="ux_chk_wordpress_schedule_manual_clean_up_contributor" value="1" <?php echo isset($contributor) && $contributor[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_manual_clean_up_contributor" id="ux_chk_database_manual_clean_up_contributor" value="1" <?php echo isset($contributor) && $contributor[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_database_optimizer; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_schedule_clean_up_contributor" id="ux_chk_database_schedule_clean_up_contributor" value="1" <?php echo isset($contributor) && $contributor[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_database_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_contributor" id="ux_chk_logs_contributor" value="1" <?php echo isset($contributor) && $contributor[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_logs_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_cron_jobs_contributor" id="ux_chk_cron_jobs_contributor" value="1" <?php echo isset($contributor) && $contributor[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_cron_jobs_label; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_contributor" id="ux_chk_general_settings_contributor" value="1" <?php echo isset($contributor) && $contributor[7] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_contributor" id="ux_chk_advance_security_contributor" value="1" <?php echo isset($contributor) && $contributor[9] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_security_settings; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_contributor" id="ux_chk_templates_contributor" value="1" <?php echo isset($contributor) && $contributor[8] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_other_settings; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_contributor" id="ux_chk_system_information_contributor" value="1" <?php echo isset($contributor) && $contributor[10] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_system_information_label; ?>
                                          </td>
                                          <td>
                                          </td>
                                          <td>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_subscriber_roles">
                              <label class="control-label">
                                 <?php echo $cpo_roles_and_capabilities_subscriber_role_label; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_choose_page_subscriber_access_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_subscriber">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_subscriber" id="ux_chk_full_control_subscriber" value="1" onclick="full_control_function_clean_up_optimizer(this, 'ux_div_subscriber_roles');" <?php echo isset($subscriber) && $subscriber[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_roles_and_capabilities_full_control_label; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_data_manual_clean_up_subscriber" id="ux_chk_wordpress_data_manual_clean_up_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_schedule_manual_clean_up_subscriber" id="ux_chk_wordpress_schedule_manual_clean_up_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_manual_clean_up_subscriber" id="ux_chk_database_manual_clean_up_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_database_optimizer; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_schedule_clean_up_subscriber" id="ux_chk_database_schedule_clean_up_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_database_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_subscriber" id="ux_chk_logs_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_logs_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_cron_jobs_subscriber" id="ux_chk_cron_jobs_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_cron_jobs_label; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_subscriber" id="ux_chk_general_settings_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[7] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_subscriber" id="ux_chk_advance_security_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[9] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_security_settings; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_subscriber" id="ux_chk_templates_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[8] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_other_settings; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_subscriber" id="ux_chk_system_information_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[10] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_system_information_label; ?>
                                          </td>
                                          <td>
                                          </td>
                                          <td>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_other_roles">
                              <label class="control-label">
                                 <?php echo $cpo_roles_and_capabilities_other_role_label; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_choose_page_other_access_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_other">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_other" id="ux_chk_full_control_other" value="1" onclick="full_control_function_clean_up_optimizer(this, 'ux_div_other_roles');" <?php echo isset($other) && $other[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_roles_and_capabilities_full_control_label; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_data_manual_clean_up_other" id="ux_chk_wordpress_data_manual_clean_up_other" value="1" <?php echo isset($other) && $other[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_wordpress_schedule_manual_clean_up_other" id="ux_chk_wordpress_schedule_manual_clean_up_other" value="1" <?php echo isset($other) && $other[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_wp_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_manual_clean_up_other" id="ux_chk_database_manual_clean_up_other" value="1" <?php echo isset($other) && $other[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_database_optimizer; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_database_schedule_clean_up_other" id="ux_chk_database_schedule_clean_up_other" value="1" <?php echo isset($other) && $other[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_schedule_database_optimizer; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_other" id="ux_chk_logs_other" value="1" <?php echo isset($other) && $other[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_logs_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_cron_jobs_other" id="ux_chk_cron_jobs_other" value="1" <?php echo isset($other) && $other[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_cron_jobs_label; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_other" id="ux_chk_general_settings_other" value="1" <?php echo isset($other) && $other[7] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_other" id="ux_chk_advance_security_other" value="1" <?php echo isset($other) && $other[9] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_security_settings; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_other" id="ux_chk_templates_other" value="1" <?php echo isset($other) && $other[8] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_general_other_settings; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_other" id="ux_chk_system_information_other" value="1" <?php echo isset($other) && $other[10] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_system_information_label; ?>
                                          </td>
                                          <td>
                                          </td>
                                          <td>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_other_roles_capabilities">
                              <label class="control-label">
                                 <?php echo $cpo_roles_and_capabilities_other_roles_capabilities; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_roles_and_capabilities_other_roles_capabilities_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_other_roles">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_other_roles" id="ux_chk_full_control_other_roles" value="1" onclick="full_control_function_clean_up_optimizer(this, 'ux_div_other_roles_capabilities');" <?php echo $details_roles_capabilities["others_full_control_capability"] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpo_roles_and_capabilities_full_control_label; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $flag = 0;
                                       $user_capabilities = get_others_capabilities_clean_up_optimizer();
                                       if (isset($user_capabilities) && count($user_capabilities) > 0) {
                                          foreach ($user_capabilities as $key => $value) {
                                             $other_roles = in_array($value, $other_roles_array) ? "checked=checked" : "";
                                             $flag++;
                                             if ($key % 3 == 0) {
                                                ?>
                                                <tr>
                                                   <?php
                                                }
                                                ?>
                                                <td>
                                                   <input type="checkbox" name="ux_chk_other_capabilities_<?php echo $value; ?>" id="ux_chk_other_capabilities_<?php echo $value; ?>" value="<?php echo $value; ?>" <?php echo $other_roles; ?>>
                                                   <?php echo $value; ?>
                                                </td>
                                                <?php
                                                if (count($user_capabilities) == $flag && $flag % 3 == 1) {
                                                   ?>
                                                   <td>
                                                   </td>
                                                   <td>
                                                   </td>
                                                   <?php
                                                }
                                                ?>
                                                <?php
                                                if (count($user_capabilities) == $flag && $flag % 3 == 2) {
                                                   ?>
                                                   <td>
                                                   </td>
                                                   <?php
                                                }
                                                ?>
                                                <?php
                                                if ($flag % 3 == 0) {
                                                   ?>
                                                </tr>
                                                <?php
                                             }
                                          }
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
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
                  <?php echo $cpo_roles_capabilities_label; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-users"></i>
                     <?php echo $cpo_roles_capabilities_label; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_roles_and_capabilities">
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