<?php
/**
 * This Template is used for managing IP ranges.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/security-settings
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
   } else if (security_settings_clean_up_optimizer == "1") {
      $timestamp = clean_up_optimizer_local_time;
      $start_date = $timestamp - 2592000;
      $clean_up_manage_ip_ranges = wp_create_nonce("clean_up_manage_ip_ranges");
      $clean_up_manage_ip_ranges_delete = wp_create_nonce("clean_up_manage_ip_ranges_delete");
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
                  <?php echo $cpo_block_unblock_ip_ranges; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-paper-clip"></i>
                     <?php echo $cpo_block_unblock_ip_ranges; ?>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_manage_ip_ranges">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_manage_ip_ranges_start_ip_range_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_manage_ip_ranges_start_ip_range_tooltip; ?>" data-placement="right" ></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <input type="text" class="form-control" name="ux_txt_start_ip_range" id="ux_txt_start_ip_range"  onblur="check_all_ip_ranges_clean_up_optimizer(this);" onfocus="prevent_paste_clean_up_optimizer(this.id);" value="" onkeyPress="clean_up_optimizer_valid_ip_address(event);" placeholder="<?php echo $cpo_manage_ip_ranges_start_ip_range_placeholder; ?>">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_manage_ip_ranges_end_ip_range_label; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_manage_ip_ranges_end_ip_range_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <input type="text" class="form-control" name="ux_txt_end_ip_range" id="ux_txt_end_ip_range"  onblur="check_all_ip_ranges_clean_up_optimizer(this);" onfocus="prevent_paste_clean_up_optimizer(this.id);"  value="" onkeyPress="clean_up_optimizer_valid_ip_address(event);" placeholder="<?php echo $cpo_manage_ip_ranges_end_ip_range_placeholder; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpo_clean_up_blocked_for_label; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_manage_ip_ranges_range_blocked_for_tooltip; ?>" data-placement="right"></i>
                              <span class="required" aria-required="true">*</span>
                           </label>
                           <select name="ux_ddl_range_blocked" id="ux_ddl_range_blocked" class="form-control">
                              <option value="1Hour"><?php echo $cpo_one_hour; ?></option>
                              <option value="12Hour"><?php echo $cpo_twelve_hours; ?></option>
                              <option value="24hours"><?php echo $cpo_twenty_four_hours; ?></option>
                              <option value="48hours"><?php echo $cpo_forty_eight_hours; ?></option>
                              <option value="week"><?php echo $cpo_one_week; ?></option>
                              <option value="month"><?php echo $cpo_one_month; ?></option>
                              <option value="permanently"><?php echo $cpo_one_permanently; ?></option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpo_comments; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_manage_ip_ranges_comments_tooltip; ?>" data-placement="right"></i>
                           </label>
                           <textarea class="form-control" name="ux_txtarea_manage_ip_range" id="ux_txtarea_manage_ip_range" rows="4" placeholder="<?php echo $cpo_manage_ip_addresses_comments_placeholder; ?>"></textarea>
                        </div>
                        <div class="line-separator"></div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="button" class="btn vivid-green" name="ux_btn_clear" id="ux_btn_clear" value=<?php echo $cpo_clean_up_clear_button_label; ?> onclick="value_blank_clean_up_optimizer();"/>
                              <input type="submit" class="btn vivid-green" name="ux_btn_advance_security_ip_range_submit" id="ux_btn_advance_security_ip_range_submit" value="<?php echo $cpo_manage_ip_ranges_address_block_ip_range_button_label; ?>">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-paper-clip"></i>
                     <?php echo $cpo_manage_ip_ranges_view_block_ip_range_label; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_view_manage_ip_ranges">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_start_date; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_manage_ip_ranges_start_date_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <div class="input-icon right">
                                    <input type="text" class="form-control" value="<?php echo date_i18n("m/d/Y", esc_html($start_date)); ?>" name="ux_txt_start_date" id="ux_txt_start_date"  placeholder="<?php echo $cpo_start_date_placeholder; ?>" onkeypress="prevent_data_clean_up_optimizer(event)">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpo_end_date; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpo_manage_ip_ranges_end_date_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">* ( <?php echo $cpo_premium_editions_label; ?> )</span>
                                 </label>
                                 <input type="text" class="form-control" name="ux_txt_end_date" value="<?php echo date_i18n("m/d/Y", esc_html($timestamp)) ?>" id="ux_txt_end_date" placeholder="<?php echo $cpo_end_date_placeholder; ?>" onkeypress="prevent_data_clean_up_optimizer(event)">
                              </div>
                           </div>
                        </div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="submit" class="btn vivid-green" name="ux_btn_ip_range" id="ux_btn_ip_range" value="<?php echo $cpo_submit; ?>">
                           </div>
                        </div>
                        <div class="line-separator"></div>
                        <div class="table-top-margin">
                           <select name="ux_ddl_manage_ip_range" id="ux_ddl_manage_ip_range" class="custom-bulk-width">
                              <option value=""><?php echo $cpo_bulk_action_dropdown; ?></option>
                              <option value="delete" style="color:red;"><?php echo $cpo_delete; ?><span><?php echo " ( " . $cpo_premium_editions_label . " )"; ?></span></option>
                           </select>
                           <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo $cpo_apply; ?>" onclick="premium_edition_notification_clean_up_optimizer();">
                        </div>
                        <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_manage_ip_range">
                           <thead>
                              <tr>
                                 <th style="text-align: center;" class="chk-action">
                                    <input type="checkbox" name="ux_chk_all_manage_ip_range" id="ux_chk_all_manage_ip_range">
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpo_table_heading_ip_range; ?>
                                    </label>
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpo_location; ?>
                                    </label>
                                 </th>
                                 <th style="width:20%;">
                                    <label class="control-label">
                                       <?php echo $cpo_table_heading_blocked_date_time; ?>
                                    </label>
                                 </th>
                                 <th style="width:20%;">
                                    <label class="control-label">
                                       <?php echo $cpo_table_heading_release_date_time; ?>
                                    </label>
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpo_comments; ?>
                                    </label>
                                 </th>
                                 <th style="text-align:center;" class="chk-action">
                                    <label class="control-label">
                                       <?php echo $cpo_action; ?>
                                    </label>
                                 </th>
                              </tr>
                           </thead>
                           <tbody id="dynamic_table_filter">
                              <?php
                              if (isset($manage_ip_range) && count($manage_ip_range) > 0) {
                                 foreach ($manage_ip_range as $row) {
                                    ?>
                                    <tr>
                                       <td style="text-align: center;">
                                          <input type="checkbox" onclick="check_all_clean_up_optimizer('#ux_chk_all_manage_ip_range');" name="ux_chk_manage_ip_range_<?php echo intval($row["meta_id"]); ?>" id="ux_chk_manage_ip_range_<?php echo intval($row["meta_id"]); ?>" value="<?php echo intval($row["meta_id"]); ?>">
                                       </td>
                                       <td>
                                          <label>
                                             <?php $ip_address = explode(",", $row["ip_range"]); ?>
                                             <?php echo long2ip($ip_address[0]); ?> - <?php echo long2ip($ip_address[1]); ?>
                                          </label>
                                       </td>
                                       <td>
                                          <label>
                                             <?php echo $row["location"] != "" ? esc_html($row["location"]) : $cpo_not_available; ?>
                                          </label>
                                       </td>
                                       <td style="width:20%;">
                                          <label>
                                             <?php echo date_i18n("d M Y h:i A", esc_html($row["date_time"])); ?>
                                          </label>
                                       </td>
                                       <td>
                                          <label>
                                             <?php
                                             $blocking_time = esc_html($row["blocked_for"]);
                                             switch ($blocking_time) {
                                                case "1Hour":
                                                   $release_date = esc_html($row["date_time"]) + (60 * 60);
                                                   echo date_i18n("d M Y h:i A", $release_date);
                                                   break;

                                                case "12Hour":
                                                   $release_date = esc_html($row["date_time"]) + (60 * 60 * 12);
                                                   echo date_i18n("d M Y h:i A", $release_date);
                                                   break;

                                                case "24hours":
                                                   $release_date = esc_html($row["date_time"]) + (60 * 60 * 24);
                                                   echo date_i18n("d M Y h:i A", $release_date);
                                                   break;

                                                case "48hours":
                                                   $release_date = esc_html($row["date_time"]) + (60 * 60 * 48);
                                                   echo date_i18n("d M Y h:i A", $release_date);
                                                   break;

                                                case "week":
                                                   $release_date = esc_html($row["date_time"]) + (60 * 60 * 24 * 7);
                                                   echo date_i18n("d M Y h:i A", $release_date);
                                                   break;

                                                case "month":
                                                   $release_date = esc_html($row["date_time"]) + (60 * 60 * 30 * 24);
                                                   echo date_i18n("d M Y h:i A", $release_date);
                                                   break;

                                                case "permanently":
                                                   echo $cpo_never;
                                                   break;
                                             }
                                             ?>
                                          </label>
                                       </td>
                                       <td>
                                          <label>
                                             <?php echo $row["comments"]; ?>
                                          </label>
                                       </td>
                                       <td class="custom-alternative">
                                          <a href="javascript:void(0);">
                                             <i class="icon-custom-trash tooltips" data-original-title="<?php echo $cpo_delete; ?>" onclick="delete_ip_range_clean_up_optimizer(<?php echo $row["meta_id"]; ?>)"  data-placement="right"></i>
                                          </a>
                                       </td>
                                    </tr>
                                    <?php
                                 }
                              }
                              ?>
                           </tbody>
                        </table>
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
                  <?php echo $cpo_block_unblock_ip_ranges; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-paper-clip"></i>
                     <?php echo $cpo_block_unblock_ip_ranges; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_manage_ip_ranges">
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