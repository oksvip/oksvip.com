<?php
/**
 * This Template is used for displaying live traffic logs.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/views/logs
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
   } else if (logs_clean_up_optimizer == "1") {
      $traffic_delete = wp_create_nonce("traffic_delete");
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
               <a href="admin.php?page=cpo_login_logs">
                  <?php echo $cpo_logs_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_logs_live_traffic; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-directions"></i>
                     <?php echo $cpo_live_traffic_on_world_map_label; ?>
                  </div>
                  <div class="caption pull-right" style="font-size:12px">
                     <strong>Next Refresh in
                        <span class="timer"></span> Seconds</strong>
                  </div>
                  <p class="premium-editions-optimizer">
                     <?php echo $cpo_upgrade_kanow_about; ?> <a href="<?php echo tech_banker_beta_url; ?>" target="_blank" class="premium-editions-documentation"><?php echo $cpo_full_features; ?></a> <?php echo $cpo_chek_our; ?> <a href="<?php echo tech_banker_beta_url; ?>/backend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpo_online_demos; ?></a>
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_live_traffic">
                     <div class="form-body">
                        <div id="map_canvas" class="custom-map"></div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-directions"></i>
                     <?php echo $cpo_logs_live_traffic; ?>
                  </div>
                  <div class="caption pull-right" style="font-size:12px">
                     <strong>Next Refresh in
                        <span class="timer"></span> Seconds</strong>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_live_traffic_logs">
                     <div class="form-body">
                        <?php
                        if ($live_traffic_logs_data["live_traffic_monitoring"] == "enable") {
                           ?>
                           <div class="form-actions">
                              <div class="table-top-margin">
                                 <select name="ux_ddl_live_traffic" id="ux_ddl_live_traffic" class="custom-bulk-width" onchange="bulk_block_time_for_clean_up_optimizer('#ux_ddl_live_traffic', '#ux_ddl_bulk_ip_blocked_for')">
                                    <option value=""><?php echo $cpo_bulk_action_dropdown; ?></option>
                                    <option value="delete" style="color:red;"><?php echo $cpo_delete; ?><span><?php echo " ( " . $cpo_premium_editions_label . " )"; ?></span></option>
                                    <option value="block" style="color:red;"><?php echo $cpo_block; ?><span><?php echo " ( " . $cpo_premium_editions_label . " )"; ?></span></option>
                                 </select>
                                 <select name="ux_ddl_bulk_ip_blocked_for" id="ux_ddl_bulk_ip_blocked_for" style="display:none" class="custom-bulk-width">
                                    <option value="1Hour"><?php echo $cpo_one_hour; ?></option>
                                    <option value="12Hour"><?php echo $cpo_twelve_hours; ?></option>
                                    <option value="24hours"><?php echo $cpo_twenty_four_hours; ?></option>
                                    <option value="48hours"><?php echo $cpo_forty_eight_hours; ?></option>
                                    <option value="week"><?php echo $cpo_one_week; ?></option>
                                    <option value="month"><?php echo $cpo_one_month; ?></option>
                                    <option value="permanently"><?php echo $cpo_one_permanently; ?></option>
                                 </select>
                                 <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" onclick="premium_edition_notification_clean_up_optimizer();" value="<?php echo $cpo_apply; ?>">
                              </div>
                              <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_live_traffic">
                                 <thead>
                                    <tr>
                                       <th  style="text-align:center;width: 5% !important;" class="chk-action">
                                          <input type="checkbox" name="ux_chk_all_live_traffic" id="ux_chk_all_live_traffic" >
                                       </th>
                                       <th style="width: 15%;">
                                          <label class="control-label" >
                                             <?php echo $cpo_table_heading_user_name; ?>
                                          </label>
                                       </th>
                                       <th style="width: 15%;">
                                          <label class="control-label">
                                             <?php echo $cpo_ip_address; ?>
                                          </label>
                                       </th>
                                       <th style="width: 15%;">
                                          <label class="control-label">
                                             <?php echo $cpo_location; ?>
                                          </label>
                                       </th>
                                       <th style="width: 25%;">
                                          <label class="control-label">
                                             <?php echo $cpo_table_heading_details; ?>
                                          </label>
                                       </th>
                                       <th style="width: 15%;">
                                          <label class="control-label">
                                             <?php echo $cpo_table_heading_date_time; ?>
                                          </label>
                                       </th>
                                       <th style="text-align:center;width: 10%;" class="chk-action">
                                          <label class="control-label">
                                             <?php echo $cpo_action; ?>
                                          </label>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody id="dynamic_table_filter">
                                    <?php
                                    if (isset($data_logs) && count($data_logs) > 0) {
                                       foreach ($data_logs as $row) {
                                          ?>
                                          <tr>
                                             <td  style="text-align: center;width: 5% !important;">
                                                <input type="checkbox" name="ux_chk_live_traffic_<?php echo intval($row["meta_id"]); ?>" id="ux_chk_live_traffic_<?php echo intval($row["meta_id"]); ?>" value="<?php echo intval($row["meta_id"]); ?>" onclick="check_all_clean_up_optimizer('#ux_chk_all_live_traffic');">
                                             </td>
                                             <td style="width: 15%;">
                                                <label>
                                                   <?php echo $row["username"] != "" ? esc_html($row["username"]) : $cpo_not_available; ?>
                                                </label>
                                             </td>
                                             <td style="width: 15%;">
                                                <label>
                                                   <?php echo long2ip($row["user_ip_address"]); ?>
                                                </label>
                                             </td>
                                             <td style="width: 15%;">
                                                <label>
                                                   <?php echo $row["location"] != "" ? esc_html($row["location"]) : $cpo_not_available; ?>
                                                </label>
                                             </td>
                                             <td style="width: 25%;">
                                                <label>
                                                   <?php echo $cpo_live_traffic_resources; ?>: <?php echo esc_attr($row["resources"]); ?><br/>
                                                   <?php echo $cpo_http_user_agent; ?>: <?php echo esc_attr($row["http_user_agent"]); ?>
                                                </label>
                                             </td>
                                             <td style="width: 15%;">
                                                <label>
                                                   <?php echo date("d M Y h:i A", esc_attr($row["date_time"])); ?>
                                                </label>
                                             </td>
                                             <td class="custom-alternative" style="width: 10%;">
                                                <a href="javascript:void(0);" class="icon-custom-trash tooltips" data-original-title="<?php echo $cpo_delete; ?>" data-placement="top" onclick="live_selected_delete_clean_up_optimizer(<?php echo $row["meta_id"]; ?>)"></a>
                                                <a onclick="premium_edition_notification_clean_up_optimizer();" class="icon-custom-ban tooltips" data-original-title="<?php echo $cpo_block_ip_address; ?>" data-placement="right"></a>
                                             </td>
                                          </tr>
                                          <?php
                                       }
                                    }
                                    ?>
                                 </tbody>
                              </table>
                           </div>
                           <?php
                        } else {
                           ?>
                           <strong>
                              <?php echo $cpo_live_traffic_monitoring_message; ?>
                           </strong>
                           <?php
                        }
                        ?>
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
               <a href="admin.php?page=cpo_login_logs">
                  <?php echo $cpo_logs_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpo_logs_live_traffic; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-directions"></i>
                     <?php echo $cpo_logs_live_traffic; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_live_traffic_logs">
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