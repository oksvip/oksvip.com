<?php
/**
 * This Template is used for adding schedulers of wordpress.
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
   } else if (schedule_optimizer_clean_up_optimizer == "1") {
      $type_data = explode(",", isset($data_array["type_data"]) ? esc_attr($data_array["type_data"]) : "");
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
                     <?php echo isset($_REQUEST["id"]) ? $cpo_update_wordpress_optimizer_schedule : $cpo_add_new_wordpress_optimizer_schedule; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>               
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_add_new_schedule_clean_up">
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
                                    <input name="ux_txt_start_date" id="ux_txt_start_date" type="text" class="form-control" value="<?php echo isset($data_array["start_on"]) ? date("m/d/Y", esc_html($data_array["start_on"])) : date("m/d/Y"); ?>" placeholder="<?php echo $cpo_start_date_placeholder; ?>" onkeypress="prevent_data_clean_up_optimizer(event)">
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
                                       <select class="form-control custom-input-medium input-inline" name="ux_ddl_start_hours" id="ux_ddl_hours">
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
                                       <select class="form-control custom-input-medium input-inline" name="ux_ddl_start_mintues" id="ux_ddl_start_minutes">
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
                        <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_wp_manual_clean_up">
                           <thead>
                              <tr>
                                 <th style="width: 4%;">
                                    <input type="checkbox" id="ux_chk_select_all_first" value="0" name="ux_chk_select_all_first"  <?php echo isset($type_data[0]) && $type_data[0] == "1" ? "checked = checked" : ""; ?>>
                                 </th>
                                 <th clospan="2">
                                    <?php echo $cpo_type_of_data; ?>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_auto_draft"   value="0" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" name="ux_chk_auto_draft" <?php echo isset($type_data[1]) && $type_data[1] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_auto_drafts; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_auto_drafts_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td style="width: 4%;">
                                    <input type="checkbox" id="ux_chk_trash_comments" value="0"   name="ux_chk_trash_comments"  onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[12]) && $type_data[12] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_trash_comments; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_trash_comments_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_dashboard_transient_feed" value="0"   name="ux_chk_dashboard_transient_feed" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[2]) && $type_data[2] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_dashboard_transient_feed; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_dashboard_transient_feed_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_draft" value="0"   name="ux_chk_draft" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[13]) && $type_data[13] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_drafts; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_drafts_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_unapproved_comments" value="0"   name="ux_chk_unapproved_comments" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[3]) && $type_data[3] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_unapproved_comments; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_unapproved_comments_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_deleted_posts" value="0"   name="ux_chk_deleted_posts" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[14]) && $type_data[14] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_deleted_posts; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_deleted_posts_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_orphan_comments_meta" value="0"   name="ux_chk_orphan_comments_meta" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[4]) && $type_data[4] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_orphan_comment_meta; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_orphan_comment_meta_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_duplicated_postmeta" value="0"   name="ux_chk_duplicated_postmeta"  onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[15]) && $type_data[15] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_duplicated_post_meta; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_duplicated_post_meta_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_orphan_posts_meta" value="0"   name="ux_chk_orphan_posts_meta" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[5]) && $type_data[5] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_orphan_post_meta; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_orphan_post_meta_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_oembed_caches_in_post_meta" value="0"   name="ux_chk_oembed_caches_in_post_meta" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[16]) && $type_data[16] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_oEmbed_caches_post_meta; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_oEmbed_caches_post_meta_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_orphan_relationships"   value="0" name="ux_chk_orphan_relationships" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[6]) && $type_data[6] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_orphan_relationships; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_orphan_relationships_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_duplicated_comment_meta" value="0"   name="ux_chk_duplicated_comment_meta" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[17]) && $type_data[17] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_duplicated_comment_meta; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_duplicated_comment_meta_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_revision" value="0"   name="ux_chk_revision" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[7]) && $type_data[7] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_revisions; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_revisions_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_orphan_user_meta" value="0"   name="ux_chk_orphan_user_meta" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[18]) && $type_data[18] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_orphan_user_meta; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_orphan_user_meta_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_remove_pingbacks"   value="0" name="ux_chk_remove_pingbacks" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[8]) && $type_data[8] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_remove_pingbacks; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_remove_pingbacks_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_duplicated_usermeta" value="0"   name="ux_chk_duplicated_usermeta" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[19]) && $type_data[19] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_duplicated_user_meta; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_duplicated_user_meta_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_remove_transient_options" value="0"   name="ux_chk_remove_transient_options" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[9]) && $type_data[9] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_remove_transient_options; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_remove_transient_options_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_orphaned_term_relationships" value="0"   name="ux_chk_orphaned_term_relationships" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[20]) && $type_data[20] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_orphaned_term_relationships; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_orphaned_term_relationships_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_remove_trackbacks" value="0"   name="ux_chk_remove_trackbacks" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[10]) && $type_data[10] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_remove_trackbacks; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_remove_trackbacks_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td>
                                    <input type="checkbox" id="ux_chk_unused_terms" value="0"   name="ux_chk_unused_terms" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[21]) && $type_data[21] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_unused_terms; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_unused_terms_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="checkbox" id="ux_chk_spam_comments" value="0"   name="ux_chk_spam_comments" onclick="check_all_clean_up_optimizer('#ux_chk_select_all_first');" <?php echo isset($type_data[11]) && $type_data[11] == "1" ? "checked = checked" : ""; ?>>
                                 </td>
                                 <td>
                                    <label>
                                       <?php echo $cpo_spam_comments; ?>
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_spam_comments_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                 </td>
                                 <td></td>
                                 <td></td>
                              </tr>
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
                     <?php echo $cpo_add_new_wordpress_optimizer_schedule; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_add_new_schedule_clean_up">
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