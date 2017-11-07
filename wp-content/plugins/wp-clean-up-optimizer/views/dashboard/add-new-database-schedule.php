<?php
/**
 * This Template is used for adding new schedulers of database.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/dashboard
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
   } else if (schedule_db_optimizer_clean_up_optimizer == "1") {
      global $wp_version;
      $start_time = explode(",", isset($get_array["start_time_database"]) ? intval($get_array["start_time_database"]) : "");
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
               <a href="admin.php?page=cpo_dashboard">
                  <?php echo $cpo_dashboard; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo isset($_REQUEST["id"]) ? $cpo_data_update_scheduled_clean_up : $cpo_add_new_scheduled_clean_up_label; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-plus"></i>
                     <?php echo isset($_REQUEST["id"]) ? $cpo_update_database_schedule : $cpo_add_new_database_schedule; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_add_new_schedule_clean_up_db">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_action; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_data_action_label_scheduled_clean_up_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                    <span class="required" aria-required="true"> ( Premium Edition ) </span>
                                 </label>
                                 <select name="ux_ddl_action" id="ux_ddl_action" class="form-control">
                                    <option value=""><?php echo $cpo_bulk_action_dropdown; ?></option>
                                    <option value="Empty"><?php echo $cpo_empty; ?></option>
                                    <option value="Delete" ><?php echo $cpo_delete; ?></option>
                                    <option value="Optimize"><?php echo $cpo_optimize_dropdown; ?></option>
                                    <option value="Repair"><?php echo $cpo_repair_dropdown; ?></option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_duration; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_add_new_scheduled_duration_label_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                    <span class="required" aria-required="true"> ( Premium Edition ) </span>
                                 </label>
                                 <div class="input-icon right">
                                    <select name="ux_ddl_duration" id="ux_ddl_duration" class="form-control" onchange="change_duration_clean_up_optimizer();">
                                       <option value="Hourly"><?php echo $cpo_hourly; ?></option>
                                       <option value="Daily"><?php echo $cpo_daily; ?></option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="ux_div_start_on_start_time">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label">
                                       <?php echo $cpo_start_on; ?> :
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_start_on_tooltip; ?>" data-placement="right"></i>
                                       <span class="required" aria-required="true">*</span>
                                       <span class="required" aria-required="true"> ( Premium Edition ) </span>
                                    </label>
                                    <input name="ux_txt_start_date" id="ux_txt_start_date" type="text" class="form-control" placeholder="<?php echo $cpo_start_on_placeholder; ?>" value="<?php echo isset($get_array["start_on_database"]) ? date("m/d/Y", esc_html($get_array["start_on_database"])) : date("m/d/Y"); ?>" onkeypress="prevent_data_clean_up_optimizer(event)">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label">
                                       <?php echo $cpo_start_time; ?> :
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_start_time_tooltip; ?>" data-placement="right"></i>
                                       <span class="required" aria-required="true">*</span>
                                       <span class="required" aria-required="true"> ( Premium Edition ) </span>
                                    </label>
                                    <div class="input-icon right">
                                       <select class="form-control custom-input-medium input-inline" name="ux_ddl_start_hours" id="ux_ddl_start_hours">
                                          <?php
                                          for ($flag = 0; $flag < 24; $flag++) {
                                             if ($flag < 10) {
                                                ?>
                                                <option value="<?php echo $flag * 60 * 60; ?>">0<?php echo $flag; ?><?php echo $cpo_hrs; ?></option>
                                                <?php
                                             } else {
                                                ?>
                                                <option value="<?php echo $flag * 60 * 60; ?>"><?php echo $flag; ?><?php echo $cpo_hrs; ?></option>
                                                <?php
                                             }
                                          }
                                          ?>
                                       </select>
                                       <select class="form-control custom-input-medium input-inline" name="ux_ddl_start_minutes" id="ux_ddl_start_minutes">
                                          <?php
                                          for ($flag = 0; $flag < 60; $flag++) {
                                             if ($flag < 10) {
                                                ?>
                                                <option value="<?php echo $flag * 60; ?>">0<?php echo $flag; ?><?php echo $cpo_mins; ?></option>
                                                <?php
                                             } else {
                                                ?>
                                                <option value="<?php echo $flag * 60; ?>"><?php echo $flag; ?><?php echo $cpo_mins; ?></option>
                                                <?php
                                             }
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="ux_div_repeat_every">
                           <div class="form-group">
                              <label class="control-label">
                                 <?php echo $cpo_repeat_every; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_repeat_every_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" aria-required="true">*</span>
                                 <span class="required" aria-required="true"> ( Premium Edition ) </span>
                              </label>
                              <select class="form-control" name="ux_ddl_repeat_every" id="ux_ddl_repeat_every">
                                 <?php
                                 for ($flag = 1; $flag < 24; $flag++) {
                                    if ($flag < 10) {
                                       if ($flag == "4") {
                                          ?>
                                          <option selected="selected" value="<?php echo $flag . "Hour"; ?>">0<?php echo $flag; ?><?php echo $cpo_hrs; ?></option>
                                          <?php
                                       } else {
                                          ?>
                                          <option value="<?php echo $flag . "Hour"; ?>">0<?php echo $flag; ?><?php echo $cpo_hrs; ?></option>
                                          <?php
                                       }
                                    } else {
                                       ?>
                                       <option value="<?php echo $flag . "Hour"; ?>"><?php echo $flag; ?><?php echo $cpo_hrs; ?></option>
                                       <?php
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_database_schedule_clean_up">
                           <thead>
                              <tr>
                                 <th style="width: 4%;">
                                    <input type="checkbox" id="ux_chk_select_all_first" value="0" name="ux_chk_select_all_first">
                                 </th>
                                 <th>
                                    <?php echo $cpo_table_name_heading; ?>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              for ($flag = 0; $flag < count($result); $flag++) {
                                 $checked = isset($tables_array) ? in_array($result[$flag]->Name, $tables_array) : "";
                                 if ($flag % 2 == 0) {
                                    $tables = esc_attr($result[$flag]->Name);
                                    $table_termmeta = $wp_version >= 4.4 ? strstr($tables, $wpdb->termmeta) : "";
                                    if ((strstr($tables, $wpdb->terms) || strstr($tables, $wpdb->term_taxonomy) || strstr($tables, $wpdb->term_relationships) || strstr($tables, $wpdb->commentmeta) || strstr($tables, $wpdb->comments) || strstr($tables, $wpdb->links) || strstr($tables, $wpdb->options) || strstr($tables, $wpdb->postmeta) || strstr($tables, $wpdb->posts) || strstr($tables, $wpdb->users) || strstr($tables, $wpdb->usermeta) || strstr($tables, clean_up_optimizer()) || strstr($tables, clean_up_optimizer_meta()) || strstr($tables, $wpdb->signups) || strstr($tables, $wpdb->sitemeta) || strstr($tables, $wpdb->site) || strstr($tables, $wpdb->registration_log) || strstr($tables, $wpdb->blogs) || strstr($tables, $wpdb->blog_versions) || $table_termmeta) == true) {
                                       ?>
                                       <tr>
                                          <td style="text-align:center;">
                                             <input type="checkbox"  table="inbuilt" id="ux_chk_add_new_schedule_db_<?php echo $flag; ?>" name="ux_chk_add_new_schedule_db[]" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" value="<?php echo $result[$flag]->Name; ?>" <?php echo $checked != "" ? "checked=checked" : ""; ?>>
                                          </td>
                                          <td class="custom-manual-td">
                                             <label style="font-size:13px;color:#FF0000 !important;"><?php echo esc_attr($result[$flag]->Name) . "*"; ?></label>
                                          </td>
                                          <?php
                                       } else {
                                          ?>
                                       <tr>
                                          <td style="text-align:center;">
                                             <input type="checkbox" id="ux_chk_add_new_schedule_db_<?php echo $flag; ?>" name="ux_chk_add_new_schedule_db[]" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" value="<?php echo $result[$flag]->Name; ?>" <?php echo $checked != "" ? "checked=checked" : ""; ?>>
                                          </td>
                                          <td class="custom-manual-td green-custom">
                                             <label><?php echo $result[$flag]->Name ?></label>
                                          </td>
                                          <?php
                                       }
                                    } else {
                                       $tables = esc_attr($result[$flag]->Name);
                                       $table_termmeta = $wp_version >= 4.4 ? strstr($tables, $wpdb->termmeta) : "";
                                       if ((strstr($tables, $wpdb->terms) || strstr($tables, $wpdb->term_taxonomy) || strstr($tables, $wpdb->term_relationships) || strstr($tables, $wpdb->commentmeta) || strstr($tables, $wpdb->comments) || strstr($tables, $wpdb->links) || strstr($tables, $wpdb->options) || strstr($tables, $wpdb->postmeta) || strstr($tables, $wpdb->posts) || strstr($tables, $wpdb->users) || strstr($tables, $wpdb->usermeta) || strstr($tables, clean_up_optimizer()) || strstr($tables, clean_up_optimizer_meta()) || strstr($tables, $wpdb->signups) || strstr($tables, $wpdb->sitemeta) || strstr($tables, $wpdb->site) || strstr($tables, $wpdb->registration_log) || strstr($tables, $wpdb->blogs) || strstr($tables, $wpdb->blog_versions) || $table_termmeta) == true) {
                                          ?>
                                          <td style="text-align:center;">
                                             <input type="checkbox"  table="inbuilt" id="ux_chk_add_new_schedule_db_<?php echo $flag; ?>" name="ux_chk_add_new_schedule_db[]" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" value="<?php echo $result[$flag]->Name; ?>" <?php echo $checked != "" ? "checked=checked" : ""; ?>>
                                          </td>
                                          <td class="custom-manual-td">
                                             <label style="font-size:13px;color:#FF0000 !important;"><?php echo esc_attr($result[$flag]->Name) . "*"; ?></label>
                                          </td>
                                       </tr>
                                       <?php
                                    } else {
                                       ?>
                                    <td style="text-align:center;">
                                       <input type="checkbox"  id="ux_chk_add_new_schedule_db_<?php echo $flag; ?>" name="ux_chk_add_new_schedule_db[]" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" value="<?php echo $result[$flag]->Name; ?>" <?php echo $checked != "" ? "checked=checked" : ""; ?>>
                                    </td>
                                    <td class="custom-manual-td green-custom">
                                       <label><?php echo esc_attr($result[$flag]->Name) ?></label>
                                    </td>
                                    <?php
                                 }
                                 ?>
                                 </tr>
                                 <?php
                              }
                              if ($flag == count($result) - 1 && $flag % 2 == 0) {
                                 ?>
                                 <td style="text-align:center;">

                                 </td>
                                 <td class="custom-manual-td green-custom">
                                    <label></label>
                                 </td>
                                 <?php
                              }
                           }
                           $flag++;
                           ?>
                           </tbody>
                        </table>
                        <div class="line-separator"></div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="submit" class="btn vivid-green" name="ux_btn_schedule_save_changes" id="ux_btn_schedule_save_changes" value="<?php echo $cpo_save_changes; ?>">
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
               <a href="admin.php?page=cpo_dashboard">
                  <?php echo $cpo_dashboard; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_add_new_scheduled_clean_up_label; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-plus"></i>
                     <?php echo $cpo_add_new_database_schedule; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_add_new_schedule_clean_up_db">
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