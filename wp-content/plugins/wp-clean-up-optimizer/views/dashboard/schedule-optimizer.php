<?php
/**
 * This Template is used for displaying schedulers of wordpress data.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/dashboard
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
   } else if (schedule_optimizer_clean_up_optimizer == "1") {
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
                  <?php echo $cpo_schedule_wp_optimizer; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-hourglass"></i>
                     <?php echo $cpo_schedule_wp_optimizer; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_schedule_clean_up">
                     <div class="form-body">
                        <div class="form-actions">
                           <div class="table-top-margin">
                              <select name="ux_ddl_scheduled" id="ux_ddl_scheduled" class="custom-bulk-width">
                                 <option value=""><?php echo $cpo_bulk_action_dropdown; ?></option>
                                 <option value="delete" style="color:red;"><?php echo $cpo_delete; ?><span><?php echo " ( " . $cpo_premium_editions_label . " )"; ?></span></option>
                              </select>
                              <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" onclick="premium_edition_notification_clean_up_optimizer();" value="<?php echo $cpo_apply; ?>">
                              <a href="admin.php?page=cpo_add_new_wordpress_schedule" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" ><?php echo $cpo_add_new_scheduled_clean_up_label; ?></a>
                           </div>
                           <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_schedule_clean_up">
                              <thead>
                                 <tr>
                                    <th style="text-align:center; width:4%;" class="chk-action">
                                       <input type="checkbox" class="custom-chkbox-operation" name="ux_chk_all_schedule" id="ux_chk_all_schedule">
                                    </th>
                                    <th style="width: 10%;">
                                       <label class="control-label">
                                          <?php echo $cpo_type; ?>
                                       </label>
                                    </th>
                                    <th style="width: 30%;">
                                       <label class="control-label">
                                          <?php echo $cpo_type_of_data; ?>
                                       </label>
                                    </th>
                                    <th style="width:10%;">
                                       <label class="control-label">
                                          <?php echo $cpo_duration; ?>
                                       </label>
                                    </th>
                                    <th style="width:18%;">
                                       <label class="control-label">
                                          <?php echo $cpo_scheduled_start_date_time; ?>
                                       </label>
                                    </th>
                                    <th style="text-align:center; width:10%;" class="chk-action">
                                       <label class="control-label">
                                          <?php echo $cpo_action; ?>
                                       </label>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 if (isset($manage_scheduled) && count($manage_scheduled) > 0) {
                                    foreach ($manage_scheduled as $row) {
                                       $combined_date_time = esc_attr($row["start_on"]) + esc_attr($row["start_time"]);
                                       $date = date("d M Y h:i A", $combined_date_time);
                                       ?>
                                       <tr>
                                          <td style="text-align:center;">
                                             <input type="checkbox" onclick="check_all_clean_up_optimizer('#ux_chk_all_schedule');" name="ux_chk_scheduled_<?php echo intval($row["meta_id"]) ?>" id="ux_chk_scheduled_<?php echo intval($row["meta_id"]) ?>" value="<?php echo intval($row["meta_id"]) ?>" onclick="check_all_logs(<?php echo intval($row["meta_id"]) ?>);">
                                          </td>
                                          <td>
                                             <label>
                                                <?php echo $row["action"]; ?>
                                             </label>
                                          </td>
                                          <td>
                                             <label>
                                                <?php
                                                $type = esc_html($row["type_data"]);
                                                $type_data = explode(",", $type);

                                                $data = "";
                                                $data .= $type_data[1] == "1" ? $cpo_auto_drafts . ", " : "";
                                                $data .= $type_data[2] == "1" ? $cpo_dashboard_transient_feed . ", " : "";
                                                $data .= $type_data[3] == "1" ? $cpo_unapproved_comments . ", " : "";
                                                $data .= $type_data[4] == "1" ? $cpo_orphan_comment_meta . ", " : "";
                                                $data .= $type_data[5] == "1" ? $cpo_orphan_post_meta . ", " : "";
                                                $data .= $type_data[6] == "1" ? $cpo_orphan_relationships . ", " : "";
                                                $data .= $type_data[7] == "1" ? $cpo_revisions . ", " : "";
                                                $data .= $type_data[8] == "1" ? $cpo_remove_pingbacks . ", " : "";
                                                $data .= $type_data[9] == "1" ? $cpo_remove_transient_options . ", " : "";
                                                $data .= $type_data[10] == "1" ? $cpo_remove_trackbacks . ", " : "";
                                                $data .= $type_data[11] == "1" ? $cpo_spam_comments . ", " : "";
                                                $data .= $type_data[12] == "1" ? $cpo_trash_comments . ", " : "";
                                                $data .= $type_data[13] == "1" ? $cpo_drafts . ", " : "";
                                                $data .= $type_data[14] == "1" ? $cpo_deleted_posts . ", " : "";
                                                $data .= $type_data[15] == "1" ? $cpo_duplicated_post_meta . ", " : "";
                                                $data .= $type_data[16] == "1" ? $cpo_oEmbed_caches_post_meta . ", " : "";
                                                $data .= $type_data[17] == "1" ? $cpo_duplicated_comment_meta . ", " : "";
                                                $data .= $type_data[18] == "1" ? $cpo_orphan_user_meta . ", " : "";
                                                $data .= $type_data[19] == "1" ? $cpo_duplicated_user_meta . ", " : "";
                                                $data .= $type_data[20] == "1" ? $cpo_orphaned_term_relationships . ", " : "";
                                                $data .= $type_data[21] == "1" ? $cpo_unused_terms . ", " : "";
                                                echo rtrim($data, ", ");
                                                ?>
                                             </label>
                                          </td>
                                          <td>
                                             <label>
                                                <?php echo esc_attr($row["duration"]); ?>
                                             </label>
                                          </td>
                                          <td>
                                             <label>
                                                <?php echo esc_attr($date); ?>
                                             </label>
                                          </td>
                                          <td class="custom-alternative">
                                             <a href="javascript:void(0);" class="icon-custom-note tooltips" data-original-title="<?php echo $cpo_edit_tooltip; ?>" data-placement="top" onclick="premium_edition_notification_clean_up_optimizer();"></a>|<a href="javascript:void(0);" class="icon-custom-trash tooltips" data-original-title="<?php echo $cpo_delete; ?>" data-placement="top" onclick="premium_edition_notification_clean_up_optimizer();"></a>
                                          </td>
                                       </tr>
                                       <?php
                                    }
                                 }
                                 ?>
                              </tbody>
                           </table>
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
                  <?php echo $cpo_schedule_wp_optimizer; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-hourglass"></i>
                     <?php echo $cpo_schedule_wp_optimizer; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_schedule_clean_up">
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