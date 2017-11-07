<?php
/**
 * This File contains javascript code.
 *
 * @author Tech Banker
 * @package wp-cleanup-optimizer/includes
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
   } else {
      ?>
      </div>
      </div>
      </div>
      <script type="text/javascript">
         jQuery("li > a").parents("li").each(function ()
         {
            if (jQuery(this).parent("ul.page-sidebar-menu-tech-banker").size() === 1)
            {
               jQuery(this).find("> a").append("<span class=\"selected\"></span>");
            }
         });
         jQuery(".tooltips").tooltip_tip({placement: "right"});

         function load_sidebar_content_clean_up_optimizer()
         {
            var menus_height = jQuery(".page-sidebar-menu-tech-banker").height();
            var content_height = jQuery(".page-content").height() + 30;
            if (parseInt(menus_height) > parseInt(content_height))
            {
               jQuery(".page-content").attr("style", "min-height:" + menus_height + "px");
            } else
            {
               jQuery(".page-sidebar-menu-tech-banker").attr("style", "min-height:" + content_height + "px");
            }
         }
         jQuery(".page-sidebar-tech-banker").on("click", "li > a", function (e)
         {
            var hasSubMenu = jQuery(this).next().hasClass("sub-menu");
            var parent = jQuery(this).parent().parent();
            var sidebar_menu = jQuery(".page-sidebar-menu-tech-banker");
            var sub = jQuery(this).next();
            var slideSpeed = parseInt(sidebar_menu.data("slide-speed"));
            parent.children("li.open").children(".sub-menu:not(.always-open)").slideUp(slideSpeed);
            parent.children("li.open").removeClass("open");
            var sidebar_close = parent.children("li.open").removeClass("open");
            if (sidebar_close)
            {
               setInterval(load_sidebar_content_clean_up_optimizer, 100);
            }
            if (sub.is(":visible"))
            {
               jQuery(this).parent().removeClass("open");
               sub.slideUp(slideSpeed);
            } else if (hasSubMenu)
            {
               jQuery(this).parent().addClass("open");
               sub.slideDown(slideSpeed);
            }
         });
         var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
         setTimeout(function ()
         {
            clearInterval(sidebar_load_interval);
         }, 5000);

         function overlay_loading_clean_up_optimizer(control_id)
         {
            var overlay_opacity = jQuery("<div class=\"opacity_overlay\"></div>");
            jQuery("body").append(overlay_opacity);
            var overlay = jQuery("<div class=\"loader_opacity\"><div class=\"processing_overlay\"></div></div>");
            jQuery("body").append(overlay);
            if (control_id !== undefined)
            {
               var message = control_id;
               var success = <?php echo json_encode($cpo_success); ?>;
               switch (control_id)
               {
                  case "empty_manual_clean_up1":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up1); ?>;
                     break;
                  case "empty_manual_clean_up2":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up2); ?>;
                     break;
                  case "empty_manual_clean_up3":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up3); ?>;
                     break;
                  case "empty_manual_clean_up4":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up4); ?>;
                     break;
                  case "empty_manual_clean_up5":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up5); ?>;
                     break;
                  case "empty_manual_clean_up6":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up6); ?>;
                     break;
                  case "empty_manual_clean_up7":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up7); ?>;
                     break;
                  case "empty_manual_clean_up8":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up8); ?>;
                     break;
                  case "empty_manual_clean_up9":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up9); ?>;
                     break;
                  case "empty_manual_clean_up10":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up10); ?>;
                     break;
                  case "empty_manual_clean_up11":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up11); ?>;
                     break;
                  case "empty_manual_clean_up12":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up12); ?>;
                     break;
                  case "empty_manual_clean_up13":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up13); ?>;
                     break;
                  case "empty_manual_clean_up14":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up14); ?>;
                     break;
                  case "empty_manual_clean_up15":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up15); ?>;
                     break;
                  case "empty_manual_clean_up16":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up16); ?>;
                     break;
                  case "empty_manual_clean_up17":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up17); ?>;
                     break;
                  case "empty_manual_clean_up18":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up18); ?>;
                     break;
                  case "empty_manual_clean_up19":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up19); ?>;
                     break;
                  case "empty_manual_clean_up20":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up20); ?>;
                     break;
                  case "empty_manual_clean_up21":
                     var message = <?php echo json_encode($cpo_empty_manual_clean_up21); ?>;
                     break;
               }
               var issuccessmessage = jQuery("#toast-container").exists();
               if (issuccessmessage !== true)
               {
                  var shortCutFunction = jQuery("#manage_messages input:checked").val();
                  toastr[shortCutFunction](message, success);
               }
            }
         }

         function remove_overlay_clean_up_optimizer()
         {
            jQuery(".loader_opacity").remove();
            jQuery(".opacity_overlay").remove();
         }

         function prevent_paste_clean_up_optimizer(control_id)
         {
            jQuery("#" + control_id).on("paste", function (e)
            {
               e.preventDefault();
            });
         }

         function paste_only_digits_clean_up_optimizer(control_id)
         {
            jQuery("#" + control_id).on("paste keypress", function (e)
            {
               var $this = jQuery("#" + control_id);
               setTimeout(function ()
               {
                  $this.val($this.val().replace(/[^0-9]/g, ""));
               }, 5);
            });
         }

         function prevent_data_clean_up_optimizer(event)
         {
            event.preventDefault();
         }
         function clean_up_optimizer_valid_ip_address(event)
         {
            if (event.which === 8 || event.keyCode === 37 || event.keyCode === 39 || event.keyCode === 46 || event.keyCode === 9 || event.keyCode === 110)
            {
               return true;
            } else if (event.which !== 46 && (event.which < 48 || event.which > 57))
            {
               event.preventDefault();
            }
         }

         function get_datatable_clean_up_optimizer(id, order, bsort, scrollX, processing)
         {
            var oTable = jQuery(id).dataTable
                    ({
                       "pagingType": "full_numbers",
                       "language":
                               {
                                  "emptyTable": "No data available in table",
                                  "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                                  "infoEmpty": "No entries found",
                                  "infoFiltered": "(filtered1 from _MAX_ total entries)",
                                  "lengthMenu": "Show _MENU_ entries",
                                  "search": "Search:",
                                  "zeroRecords": "No matching records found"
                               },
                       "order": [[order, 'asc']],
                       "bSort": bsort,
                       "pageLength": 10,
                       "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
                       "scrollX": scrollX,
                       "processing": processing
                    });
            return oTable;
         }

         function check_all_clean_up_optimizer(id)
         {
            if ((jQuery("tbody input:checked").length) === jQuery("tbody input[type=checkbox]").length)
            {
               jQuery(id).attr("checked", "checked");
            } else
            {
               jQuery(id).removeAttr("checked");
            }
         }

         function cpo_initialize()
         {
            var mapOptions =
                    {
                       center: new google.maps.LatLng(51.83790, -17.35093),
                       zoom: 2,
                       streetViewControl: false,
                       draggableCursor: "default",
                       draggingCursor: "grab"
                    };
            var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
      <?php
      if (isset($data_logs) && count($data_logs) > 0) {
         foreach ($data_logs as $row) {
            ?>
                  var infowindow = new google.maps.InfoWindow();
                  var marker = new google.maps.Marker
                          ({
                             draggable: false,
                             position: new google.maps.LatLng(<?php echo json_encode($row["latitude"]); ?>, <?php echo json_encode($row["longitude"]); ?>),
                             cursor: "pointer",
                             icon: "<?php echo plugins_url("assets/global/img/map-marker.png", dirname(__FILE__)); ?>"
                          });
                  marker.content = "<b>" +<?php echo json_encode($cpo_ip_address); ?> + ": </b>" + <?php echo json_encode(long2ip($row["user_ip_address"])); ?> +
                          "<br><b>" +<?php echo json_encode($cpo_location); ?> + ": </b>" + <?php echo $row["location"] != "" ? json_encode($row["location"]) : json_encode($cpo_not_available); ?> +
                          "<br><b>" +<?php echo json_encode($cpo_latitude); ?> + ": </b>" +<?php echo $row["latitude"] != "" ? json_encode($row["latitude"]) : json_encode($cpo_not_available) ?> +
                          "<br><b>" +<?php echo json_encode($cpo_longitude); ?> + ": </b>" +<?php echo $row["longitude"] != "" ? json_encode($row["longitude"]) : json_encode($cpo_not_available) ?> +
                          "<br><b>" +<?php echo json_encode($cpo_http_user_agent); ?> + ": </b>" + <?php echo json_encode($row["http_user_agent"]); ?>;
                  google.maps.event.addListener(marker, "click", function ()
                  {
                     infowindow.setContent(this.content);
                     infowindow.open(this.getMap(), this);
                  });
                  marker.setMap(map);
            <?php
         }
      }
      ?>
         }

         jQuery(document).ready(function ()
         {
            jQuery("#ux_txt_start_date").datepicker
                    ({
                       dateFormat: "mm/dd/yy",
                       numberOfMonths: 1,
                       changeMonth: true,
                       changeYear: true,
                       yearRange: "1970:2039",
                       onSelect: function (selected)
                       {
                          jQuery("#ux_txt_end_date").datepicker("option", "minDate", selected);
                       }
                    });
            jQuery("#ux_txt_end_date").datepicker
                    ({
                       dateFormat: "mm/dd/yy",
                       numberOfMonths: 1,
                       changeMonth: true,
                       changeYear: true,
                       yearRange: "1970:2039",
                       onSelect: function (selected)
                       {
                          jQuery("#ux_txt_start_date").datepicker("option", "maxDate", selected);
                       }
                    });
         });

         function change_duration_clean_up_optimizer()
         {
            var duration = jQuery("#ux_ddl_duration").val();
            switch (duration)
            {
               case "Hourly" :
                  jQuery("#ux_div_repeat_every").css("display", "block");
                  break;
               case "Daily" :
                  jQuery("#ux_div_repeat_every").css("display", "none");
                  break;
            }
         }

         function sort_function_clean_up_optimizer(control_id)
         {
            var options = jQuery("#" + control_id + " option");
            var arr = options.map(function (_, o)
            {
               return{
                  t: jQuery(o).text(),
                  v: o.value
               };
            }).get();
            arr.sort(function (o1, o2)
            {
               return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
            });
            options.each(function (i, o)
            {
               o.value = arr[i].v;
               jQuery(o).text(arr[i].t);
            });
         }


         function ip2long(IP)
         {
            var i = 0;
            IP = IP.match(
                    /^([1-9]\d*|0[0-7]*|0x[\da-f]+)(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?$/i
                    );
            if (!IP)
            {
               return false;
            }
            IP[0] = 0;
            for (i = 1; i < 5; i += 1) {
               IP[0] += !!((IP[i] || "")
                       .length);
               IP[i] = parseInt(IP[i]) || 0;
            }
            IP.push(256, 256, 256, 256);
            IP[4 + IP[0]] *= Math.pow(256, 4 - IP[0]);
            if (IP[1] >= IP[5] || IP[2] >= IP[6] || IP[3] >= IP[7] || IP[4] >= IP[8])
            {
               return false;
            }
            return IP[1] * (IP[0] === 1 || 16777216) + IP[2] * (IP[0] <= 2 || 65536) + IP[3] * (IP[0] <= 3 || 256) + IP[4] * 1;
         }

         function base64_encode_clean_up_optimizer(data)
         {
            var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
            var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                    ac = 0,
                    enc = "",
                    tmp_arr = [];
            if (!data)
            {
               return data;
            }
            do
            {
               o1 = data.charCodeAt(i++);
               o2 = data.charCodeAt(i++);
               o3 = data.charCodeAt(i++);
               bits = o1 << 16 | o2 << 8 | o3;
               h1 = bits >> 18 & 0x3f;
               h2 = bits >> 12 & 0x3f;
               h3 = bits >> 6 & 0x3f;
               h4 = bits & 0x3f;
               tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
            } while (i < data.length);
            enc = tmp_arr.join('');
            var r = data.length % 3;
            return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
         }

         function bulk_block_time_for_clean_up_optimizer(id, time_div)
         {
            if (jQuery(id).val() === "block")
            {
               jQuery(time_div).css("display", "inline-block");
            } else
            {
               jQuery(time_div).css("display", "none");
            }
         }

         jQuery(document).ready(function ()
         {
            load_sidebar_content_clean_up_optimizer();
         });
         function premium_edition_notification_clean_up_optimizer()
         {
            var premium_edition = <?php echo json_encode($message_premium_edition); ?>;
            var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
            toastr[shortCutFunction](premium_edition);
         }
      <?php
      $check_clean_up_wizard = get_option("clean-up-optimizer-wizard-set-up");
      $cpo_page_url = $check_clean_up_wizard == "" ? "cpo_wizard_optimizer" : esc_attr($_GET["page"]);
      if (isset($_GET["page"])) {
         switch (esc_attr($cpo_page_url)) {
            case "cpo_wizard_optimizer":
               ?>
                  function show_hide_details_clean_up_optimizer()
                  {
                     if (jQuery("#ux_div_wizard_set_up").hasClass("wizard-set-up"))
                     {
                        jQuery("#ux_div_wizard_set_up").css("display", "none");
                        jQuery("#ux_div_wizard_set_up").removeClass("wizard-set-up");
                     } else
                     {
                        jQuery("#ux_div_wizard_set_up").css("display", "block");
                        jQuery("#ux_div_wizard_set_up").addClass("wizard-set-up");
                     }
                  }
                  function plugin_stats_clean_up_optimizer(type)
                  {
                     overlay_loading_clean_up_optimizer();
                     jQuery.post(ajaxurl,
                             {
                                type: type,
                                param: "wizard_clean_up_optimizer",
                                action: "clean_up_optimizer_action",
                                _wp_nonce: "<?php echo $clean_up_optimizer_check_status; ?>"
                             },
                             function ()
                             {
                                remove_overlay_clean_up_optimizer();
                                window.location.href = "admin.php?page=cpo_dashboard";
                             });
                  }
               <?php
               break;
            case "cpo_dashboard" :
               ?>
                  jQuery("#ux_li_dashboard").addClass("active");
                  jQuery("#ux_li_wp_optimizer").addClass("active");
               <?php
               if (wordpress_optimizer_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        jQuery("#ux_chk_select_all").click(function ()
                        {
                           var check = jQuery(this);
                           jQuery("#ux_frm_manual_clean_up input[type=checkbox]").each(function ()
                           {
                              jQuery(this).prop("checked", check.is(":checked"));
                           });
                        });
                     });
                     function bulk_empty_clean_up_optimizer()
                     {
                        var confirm_action = jQuery("#ux_ddl_bulk_action").val();
                        if (confirm_action === "")
                        {
                           var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                           toastr[shortCutFunction](<?php echo json_encode($cpo_choose_action); ?>);
                        } else
                        {
                           chkArray = [];
                           jQuery(".check-all input:checkbox:checked").each(function ()
                           {
                              chkArray.push(jQuery(this).val());
                           }).get();
                           if (chkArray.length < 1)
                           {
                              var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                              toastr[shortCutFunction](<?php echo json_encode($cpo_choose_clean_data); ?>);
                           } else
                           {
                              var empty_data = confirm(<?php echo json_encode($cpo_confirm_clean); ?>);
                              if (empty_data === true)
                              {
                                 overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_empty_manual_clean_up_data); ?>);
                                 jQuery.post(ajaxurl,
                                         {
                                            data: JSON.stringify(chkArray),
                                            param: "manual_clean_up_module",
                                            action: "clean_up_optimizer_action",
                                            _wp_nonce: "<?php echo $wordpress_data_manual_clean_up; ?>"
                                         },
                                         function (data)
                                         {
                                            setTimeout(function ()
                                            {
                                               remove_overlay_clean_up_optimizer();
                                               window.location.href = "admin.php?page=cpo_dashboard";
                                            }, 3000);
                                         });
                              }
                           }
                        }
                     }
                     function selected_empty_clean_up_optimizer(id)
                     {
                        var selected_empty = confirm(<?php echo json_encode($cpo_confirm_clean); ?>);
                        if (selected_empty === true)
                        {
                           overlay_loading_clean_up_optimizer("empty_manual_clean_up" + id);
                           jQuery.post(ajaxurl,
                                   {
                                      delete_id: id,
                                      param: "manual_clean_up_empty_module",
                                      action: "clean_up_optimizer_action",
                                      _wp_nonce: "<?php echo $empty_manual_clean_up; ?>"
                                   },
                                   function ()
                                   {
                                      setTimeout(function ()
                                      {
                                         remove_overlay_clean_up_optimizer();
                                         window.location.href = "admin.php?page=cpo_dashboard";
                                      }, 3000);
                                   });
                        }
                     }
                  <?php
               }
               break;
            case "cpo_schedule_optimizer" :
               ?>
                  jQuery("#ux_li_dashboard").addClass("active");
                  jQuery("#ux_li_wp_scheduled_optimizer").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (schedule_optimizer_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_schedule_clean_up", 0, true, false, false);
                     jQuery("#ux_chk_all_schedule").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr('checked', this.checked);
                     });
                  <?php
               }
               break;
            case "cpo_add_new_wordpress_schedule" :
               ?>
                  jQuery("#ux_li_dashboard").addClass("active");
                  jQuery("#ux_li_wp_scheduled_optimizer").addClass("active");
               <?php
               if (schedule_optimizer_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        jQuery("#ux_ddl_action").val("<?php echo isset($data_array["action"]) ? esc_attr($data_array["action"]) : ""; ?>");
                        jQuery("#ux_ddl_duration").val("<?php echo isset($data_array["duration"]) ? esc_attr($data_array["duration"]) : "Hourly"; ?>");
                        jQuery("#ux_ddl_repeat_every").val("<?php echo isset($data_array["repeat_every"]) ? esc_attr($data_array["repeat_every"]) : "4Hour"; ?>");
                        jQuery("#ux_ddl_hours").val("<?php echo isset($data_array["start_time"]) ? doubleval(floor($data_array["start_time"] / 3600) * 3600) : 0; ?>");
                        jQuery("#ux_ddl_start_minutes").val("<?php echo isset($data_array["start_time"]) ? doubleval(floor($data_array["start_time"] % 3600)) : 0; ?>");
                        change_duration_clean_up_optimizer();
                     });
                     jQuery("#ux_chk_select_all_first").click(function ()
                     {
                        var check = jQuery(this);
                        jQuery("#ux_frm_add_new_schedule_clean_up input[type=checkbox]").each(function ()
                        {
                           jQuery(this).prop("checked", check.is(":checked"));
                        });
                     });
                     jQuery("#ux_frm_add_new_schedule_clean_up").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_db_optimizer" :
               ?>
                  jQuery("#ux_li_dashboard").addClass("active");
                  jQuery("#ux_cpo_li_db_optimizer").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (database_optimizer_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_manual_clean_up", 0, false, false, false);
                     jQuery("#ux_chk_all_database_manual_clean_up").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked", this.checked);
                     });
                     function select_action_clean_up_optimizer(table_name, id)
                     {
                        var perform_action = jQuery("#ux_ddl_action_table_" + id).val();
                        if (perform_action !== "empty" && perform_action !== "repair")
                        {
                           var confirm_action = confirm(<?php echo json_encode($cpo_perform_action); ?>);
                           var show_message = "";
                           switch (perform_action)
                           {
                              case "optimize":
                                 show_message = <?php echo json_encode($cpo_optimize_table); ?>;
                                 break;
                              case "delete":
                                 show_message = <?php echo json_encode($cpo_delete_table); ?>;
                                 break;
                           }
                           if (confirm_action === true)
                           {
                              overlay_loading_clean_up_optimizer(show_message);
                              jQuery.post(ajaxurl,
                                      {
                                         perform_action: perform_action,
                                         table_name: table_name,
                                         param: "select_action_manual_clean_up_module",
                                         action: "clean_up_optimizer_action",
                                         _wp_nonce: "<?php echo $manual_db_select_action; ?>"
                                      },
                                      function ()
                                      {
                                         setTimeout(function ()
                                         {
                                            remove_overlay_clean_up_optimizer();
                                            window.location.href = "admin.php?page=cpo_db_optimizer";
                                         }, 3000);
                                      });
                           }
                        } else
                        {
                           premium_edition_notification_clean_up_optimizer();
                        }
                     }
                     function bulk_actions_manual_clean_up_optimizer()
                     {
                        var type = jQuery("#ux_ddl_manual").val();
                        var chkBoxArray = [];
                        if (type === "")
                        {
                           var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                           toastr[shortCutFunction](<?php echo json_encode($cpo_choose_action); ?>);
                        } else
                        {
                           if (type !== "empty" && type !== "repair")
                           {
                              var flag = 0;
                              jQuery("input[type=checkbox][name*=ux_chk_database_manual_]", oTable.fnGetFilteredNodes()).each(function ()
                              {
                                 var table_type = jQuery(this).attr("table");
                                 var isChecked = jQuery(this).prop("checked");
                                 if (isChecked === true)
                                 {
                                    var table_id = jQuery(this).val();
                                    if (type === "delete")
                                    {
                                       if (table_type !== "inbuilt")
                                       {
                                          chkBoxArray.push(table_id);
                                       }
                                    } else
                                    {
                                       chkBoxArray.push(table_id);
                                    }
                                    flag++;
                                 }
                              });
                              if (type === "optimize")
                              {
                                 var toast_message = <?php echo json_encode($cpo_choose_optimize) ?>;
                                 var show_message = <?php echo json_encode($cpo_optimize_tables); ?>;
                              } else if (type === "delete")
                              {
                                 var toast_message = <?php echo json_encode($cpo_choose_delete) ?>;
                                 var show_message = <?php echo json_encode($cpo_delete_tables); ?>;
                              }
                              if (flag === 0)
                              {
                                 var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                                 toastr[shortCutFunction](toast_message);
                              } else
                              {
                                 var confirm_action = confirm(<?php echo json_encode($cpo_perform_action) ?>);
                                 var bulk_manual = jQuery("#ux_ddl_manual").val();
                                 if (confirm_action === true)
                                 {
                                    overlay_loading_clean_up_optimizer(show_message);
                                    jQuery.post(ajaxurl,
                                            {
                                               table_action: bulk_manual,
                                               data: JSON.stringify(chkBoxArray),
                                               param: "bulk_action_manual_clean_up_module",
                                               action: "clean_up_optimizer_action",
                                               _wp_nonce: "<?php echo $manual_db_bulk_action; ?>"
                                            },
                                            function ()
                                            {
                                               setTimeout(function ()
                                               {
                                                  remove_overlay_clean_up_optimizer();
                                                  window.location.href = "admin.php?page=cpo_db_optimizer";
                                               }, 3000);
                                            });
                                 }
                              }
                           } else
                           {
                              premium_edition_notification_clean_up_optimizer();
                           }
                        }
                     }
                  <?php
               }
               break;
            case "cpo_database_view_records" :
               ?>
                  jQuery("#ux_li_dashboard").addClass("active");
                  jQuery("#ux_cpo_li_db_optimizer").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (database_optimizer_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_view_records_manual_clean_up", 0, true, true, true);
                     jQuery("#ux_chk_all_db_view_records").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr('checked', this.checked);
                     });
                  <?php
               }
               break;
            case "cpo_schedule_db_optimizer" :
               ?>
                  jQuery("#ux_li_dashboard").addClass("active");
                  jQuery("#ux_cpo_li_schedule_db_optimizer").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (schedule_db_optimizer_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_schedule_clean_up_db", 0, true, false, false);
                     jQuery("#ux_chk_all_schedule").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr('checked', this.checked);
                     });
                  <?php
               }
               break;
            case "cpo_add_new_database_schedule" :
               ?>
                  jQuery("#ux_li_dashboard").addClass("active");
                  jQuery("#ux_cpo_li_schedule_db_optimizer").addClass("active");
               <?php
               if (schedule_db_optimizer_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        jQuery("#ux_ddl_action").val("<?php echo isset($get_array["action_database"]) ? esc_attr($get_array["action_database"]) : "Optimize" ?>");
                        jQuery("#ux_ddl_duration").val("<?php echo isset($get_array["duration_database"]) ? esc_attr($get_array["duration_database"]) : "Hourly" ?>");
                        jQuery("#ux_ddl_start_hours").val("<?php echo isset($get_array["start_time_database"]) ? doubleval(floor($get_array["start_time_database"] / 3600) * 3600) : 0; ?>");
                        jQuery("#ux_ddl_start_minutes").val("<?php echo isset($get_array["start_time_database"]) ? doubleval(floor($get_array["start_time_database"] % 3600)) : 0; ?>");
                        jQuery("#ux_ddl_repeat_every").val("<?php echo isset($get_array["repeat_every_database"]) ? esc_attr($get_array["repeat_every_database"]) : "4Hour" ?>");
                        change_duration_clean_up_optimizer();
                        check_all_clean_up_optimizer('#ux_chk_select_all_first');
                     });
                     jQuery("#ux_chk_select_all_first").click(function ()
                     {
                        var check = jQuery(this);
                        jQuery("#ux_frm_add_new_schedule_clean_up_db input[type=checkbox]").each(function ()
                        {
                           jQuery(this).prop("checked", check.is(":checked"));
                        });
                     });
                     jQuery("#ux_frm_add_new_schedule_clean_up_db").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_login_logs" :
               ?>
                  jQuery("#ux_li_logs").addClass("active");
                  jQuery("#ux_li_logins_logs").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (logs_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        cpo_initialize();
                     });
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_recent_logs", 0, true, false, false);
                     jQuery("#ux_chk_all_logins").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked", this.checked);
                     });
                     function delete_selected_log_clean_up_optimizer(id)
                     {
                        var confirmDelete = confirm(<?php echo json_encode($cpo_delete_schedule); ?>);
                        if (confirmDelete === true)
                        {
                           overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_delete_login_log); ?>);
                           jQuery.post(ajaxurl,
                                   {
                                      login_id: id,
                                      param: "delete_selected_recent_module",
                                      action: "clean_up_optimizer_action",
                                      _wp_nonce: "<?php echo $recent_selected_delete; ?>"
                                   },
                                   function ()
                                   {
                                      setTimeout(function ()
                                      {
                                         remove_overlay_clean_up_optimizer();
                                         window.location.href = "admin.php?page=cpo_login_logs";
                                      }, 3000);
                                   });
                        }
                     }
                     jQuery("#ux_frm_recent_login").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_live_traffic" :
               ?>
                  jQuery("#ux_li_logs").addClass("active");
                  jQuery("#ux_li_live_traffic").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (logs_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        cpo_initialize();
                     });
                     i = 30;
                     function counter_live_traffic_clean_up()
                     {
                        jQuery(".timer").html(i);
                        if (i === 0)
                        {
                           window.location.href = "admin.php?page=cpo_live_traffic";
                        }
                        i--;
                     }
                     setInterval(counter_live_traffic_clean_up, 1000);
                  <?php
                  if ($live_traffic_logs_data["live_traffic_monitoring"] == "enable") {
                     ?>
                        var oTable = get_datatable_clean_up_optimizer("#ux_tbl_live_traffic", 0, true, false, false);
                        jQuery("#ux_chk_all_live_traffic").click(function ()
                        {
                           jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked", this.checked);
                        });

                        function live_selected_delete_clean_up_optimizer(meta_id)
                        {
                           var confirm_delete = confirm(<?php echo json_encode($cpo_delete_schedule); ?>);
                           if (confirm_delete === true)
                           {
                              overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_delete_traffic_logs); ?>);
                              jQuery.post(ajaxurl,
                                      {
                                         confirm_id: meta_id,
                                         param: "delete_selected_traffic_module",
                                         action: "clean_up_optimizer_action",
                                         _wp_nonce: "<?php echo $traffic_delete; ?>"
                                      },
                                      function ()
                                      {
                                         setTimeout(function ()
                                         {
                                            remove_overlay_clean_up_optimizer();
                                            window.location.href = "admin.php?page=cpo_live_traffic";
                                         }, 3000);
                                      });
                           }
                        }
                     <?php
                  }
               }
               break;
            case "cpo_visitor_logs" :
               ?>
                  jQuery("#ux_li_logs").addClass("active");
                  jQuery("#ux_li_visitor_logs").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (logs_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        cpo_initialize();
                     });
                  <?php
                  if ($visitor_logs_data["visitor_logs_monitoring"] == "enable") {
                     ?>
                        var oTable = get_datatable_clean_up_optimizer("#ux_tbl_visitor_logs", 0, true, false, false);
                        jQuery("#ux_chk_all_visitor_logs").click(function ()
                        {
                           jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked", this.checked);
                        });
                        function visitor_log_selected_delete_clean_up_optimizer(meta_id)
                        {
                           var confirm_delete = confirm(<?php echo json_encode($cpo_delete_schedule); ?>);
                           if (confirm_delete === true)
                           {
                              overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_delete_visitor_logs); ?>);
                              jQuery.post(ajaxurl,
                                      {
                                         confirm_id: meta_id,
                                         param: "visitor_log_delete_module",
                                         action: "clean_up_optimizer_action",
                                         _wp_nonce: "<?php echo $visitor_log_delete; ?>"
                                      },
                                      function ()
                                      {
                                         setTimeout(function ()
                                         {
                                            remove_overlay_clean_up_optimizer();
                                            window.location.href = "admin.php?page=cpo_visitor_logs";
                                         }, 3000);
                                      });
                           }
                        }
                        jQuery("#ux_frm_visitor_logs").validate
                                ({
                                   submitHandler: function ()
                                   {
                                      premium_edition_notification_clean_up_optimizer();
                                   }
                                });
                     <?php
                  }
               }
               break;
            case "cpo_custom_jobs" :
               ?>
                  jQuery("#ux_li_cron_jobs").addClass("active");
                  jQuery("#ux_li_custom_cron_jobs").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (cron_jobs_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_data_table_custom_cron", 4, true, false, false);
                     jQuery("#ux_chk_select_all_scheduler").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr('checked', this.checked);
                     });
                  <?php
               }
               break;
            case "cpo_core_jobs" :
               ?>
                  jQuery("#ux_li_cron_jobs").addClass("active");
                  jQuery("#ux_li_core_cron_jobs").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (cron_jobs_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_data_table_core_cron", 3, true, false, false);
                  <?php
               }
               break;
            case "cpo_notifications_setup" :
               ?>
                  jQuery("#ux_li_general_settings").addClass("active");
                  jQuery("#ux_li_notifications_setup").addClass("active");
               <?php
               if (general_settings_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        jQuery("#ux_ddl_fail").val("<?php echo isset($meta_data_array["email_when_a_user_fails_login"]) ? esc_attr($meta_data_array["email_when_a_user_fails_login"]) : "" ?>");
                        jQuery("#ux_ddl_success").val("<?php echo isset($meta_data_array["email_when_a_user_success_login"]) ? esc_attr($meta_data_array["email_when_a_user_success_login"]) : "" ?>");
                        jQuery("#ux_ddl_ip_address_blocked").val("<?php echo isset($meta_data_array["email_when_an_ip_address_is_blocked"]) ? esc_attr($meta_data_array["email_when_an_ip_address_is_blocked"]) : "" ?>");
                        jQuery("#ux_ddl_ip_address_unblocked").val("<?php echo isset($meta_data_array["email_when_an_ip_address_is_unblocked"]) ? esc_attr($meta_data_array["email_when_an_ip_address_is_unblocked"]) : "" ?>");
                        jQuery("#ux_ddl_ip_range_blocked").val("<?php echo isset($meta_data_array["email_when_an_ip_range_is_blocked"]) ? esc_attr($meta_data_array["email_when_an_ip_range_is_blocked"]) : "" ?>");
                        jQuery("#ux_ddl_ip_range_unblocked").val("<?php echo isset($meta_data_array["email_when_an_ip_range_is_unblocked"]) ? esc_attr($meta_data_array["email_when_an_ip_range_is_unblocked"]) : "" ?>");
                     });
                     jQuery("#ux_frm_alert_setup").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_message_settings" :
               ?>
                  jQuery("#ux_li_general_settings").addClass("active");
                  jQuery("#ux_li_message_settings").addClass("active");
               <?php
               if (general_settings_clean_up_optimizer == "1") {
                  ?>
                     jQuery("#ux_frm_error_messages").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_email_templates" :
               ?>
                  jQuery("#ux_li_general_settings").addClass("active");
                  jQuery("#ux_li_email_templates").addClass("active");
               <?php
               if (general_settings_clean_up_optimizer == "1") {
                  ?>

                     function template_change_data_clean_up_optimizer()
                     {
                        var email_type = jQuery("#ux_ddl_user_success").val();
                        jQuery.post(ajaxurl,
                                {
                                   data: email_type,
                                   param: "change_email_template_module",
                                   action: "clean_up_optimizer_action",
                                   _wp_nonce: "<?php echo $email_template_data; ?>"
                                },
                                function (data)
                                {
                                   jQuery("#ux_email_template_meta_id").val(jQuery.parseJSON(data)[0]["meta_id"]);
                                   jQuery("#ux_txt_send_to").val(jQuery.parseJSON(data)[0]["email_send_to"]);
                                   jQuery("#ux_txt_cc").val(jQuery.parseJSON(data)[0]["email_cc"]);
                                   jQuery("#ux_txt_bcc").val(jQuery.parseJSON(data)[0]["email_bcc"]);
                                   jQuery("#ux_txt_subject").val(jQuery.parseJSON(data)[0]["email_subject"]);
                                   if (window.CKEDITOR)
                                   {
                                      CKEDITOR.instances["ux_heading_content"].setData(jQuery.parseJSON(data)[0]["email_message"]);
                                   } else if (jQuery("#wp-ux_heading_content-wrap").hasClass("tmce-active"))
                                   {
                                      tinyMCE.get("ux_heading_content").setContent(jQuery.parseJSON(data)[0]["email_message"]);
                                   } else
                                   {
                                      jQuery("#ux_heading_content").val(jQuery.parseJSON(data)[0]["email_message"]);
                                   }
                                });
                     }
                     jQuery(document).ready(function ()
                     {
                        if (window.CKEDITOR)
                        {
                           CKEDITOR.replace("ux_heading_content");
                        }
                        template_change_data_clean_up_optimizer();
                     });
                     jQuery("#ux_frm_email_templates").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_roles_and_capabilities" :
               ?>
                  jQuery("#ux_li_general_settings").addClass("active");
                  jQuery("#ux_li_roles_capabilities").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (general_settings_clean_up_optimizer == "1") {
                  ?>
                     function show_roles_capabilities_clean_up_optimizer(id, div_id)
                     {
                        if (jQuery(id).prop("checked"))
                        {
                           jQuery("#" + div_id).css("display", "block");
                        } else
                        {
                           jQuery("#" + div_id).css("display", "none");
                        }
                     }
                     function full_control_function_clean_up_optimizer(id, div_id)
                     {
                        var checkbox_id = jQuery(id).prop("checked");
                        jQuery("#" + div_id + " input[type=checkbox]").each(function ()
                        {
                           if (checkbox_id)
                           {
                              jQuery(this).attr("checked", "checked");
                              if (jQuery(id).attr("id") !== jQuery(this).attr("id"))
                              {
                                 jQuery(this).attr("disabled", "disabled");
                              }
                           } else
                           {
                              if (jQuery(id).attr("id") !== jQuery(this).attr("id"))
                              {
                                 jQuery(this).removeAttr("disabled");
                                 jQuery("#ux_chk_other_capabilities_manage_options").attr("disabled", "disabled");
                                 jQuery("#ux_chk_other_capabilities_read").attr("disabled", "disabled");
                              }
                           }
                        });
                     }
                     jQuery(document).ready(function ()
                     {
                        jQuery("#ux_ddl_clean_up_optimizer_menu").val("<?php echo isset($details_roles_capabilities["show_clean_up_optimizer_top_bar_menu"]) ? esc_attr($details_roles_capabilities["show_clean_up_optimizer_top_bar_menu"]) : "enable"; ?>");
                        show_roles_capabilities_clean_up_optimizer("#ux_chk_author", "ux_div_author_roles");
                        full_control_function_clean_up_optimizer("#ux_chk_full_control_author", "ux_div_author_roles");
                        show_roles_capabilities_clean_up_optimizer("#ux_chk_editor", "ux_div_editor_roles");
                        full_control_function_clean_up_optimizer("#ux_chk_full_control_editor", "ux_div_editor_roles");
                        show_roles_capabilities_clean_up_optimizer("#ux_chk_contributor", "ux_div_contributor_roles");
                        full_control_function_clean_up_optimizer("#ux_chk_full_control_contributor", "ux_div_contributor_roles");
                        show_roles_capabilities_clean_up_optimizer("#ux_chk_subscriber", "ux_div_subscriber_roles");
                        full_control_function_clean_up_optimizer("#ux_chk_full_control_subscriber", "ux_div_subscriber_roles");
                        show_roles_capabilities_clean_up_optimizer("#ux_chk_other", "ux_div_other_roles");
                        full_control_function_clean_up_optimizer("#ux_chk_full_control_other", "ux_div_other_roles");
                        full_control_function_clean_up_optimizer("#ux_chk_full_control_other_roles", "ux_div_other_roles_capabilities");
                     });
                     jQuery("#ux_frm_roles_and_capabilities").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_blockage_settings" :
               ?>
                  jQuery("#ux_li_security_settings").addClass("active");
                  jQuery("#ux_li_blockage_settings").addClass("active");
               <?php
               if (security_settings_clean_up_optimizer == "1") {
                  ?>

                     function change_mailer_type_clean_up_optimizer()
                     {
                        var change = jQuery("#ux_ddl_auto_ip").val();
                        switch (change)
                        {
                           case "enable":
                              jQuery("#ux_div_auto_ip").css("display", "block");
                              break;
                           case "disable":
                              jQuery("#ux_div_auto_ip").css("display", "none");
                              break;
                        }
                     }
                     jQuery(document).ready(function ()
                     {
                        jQuery("#ux_ddl_auto_ip").val("<?php echo isset($blocking_option_array["auto_ip_block"]) ? esc_attr($blocking_option_array["auto_ip_block"]) : "" ?>");
                        jQuery("#ux_ddl_blocked_for").val("<?php echo isset($blocking_option_array["block_for"]) ? esc_attr($blocking_option_array["block_for"]) : "" ?>");
                        change_mailer_type_clean_up_optimizer();
                     });
                     jQuery("#ux_frm_blocking_options").validate
                             ({
                                rules:
                                        {
                                           ux_txt_login:
                                                   {
                                                      required: true
                                                   }
                                        },
                                errorPlacement: function ()
                                {
                                },
                                highlight: function (element)
                                {
                                   jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                },
                                success: function (label, element)
                                {
                                   var icon = jQuery(element).parent(".input-icon").children("i");
                                   jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                   icon.removeClass("fa-warning").addClass("fa-check");
                                },
                                submitHandler: function ()
                                {
                                   overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_update_blocking_options); ?>);
                                   jQuery.post(ajaxurl,
                                           {
                                              data: base64_encode_clean_up_optimizer(jQuery("#ux_frm_blocking_options").serialize()),
                                              param: "blocking_options_module",
                                              action: "clean_up_optimizer_action",
                                              _wp_nonce: "<?php echo $clean_up_block; ?>"
                                           },
                                           function ()
                                           {
                                              setTimeout(function ()
                                              {
                                                 remove_overlay_clean_up_optimizer();
                                                 window.location.href = "admin.php?page=cpo_blockage_settings";
                                              }, 3000);
                                           });
                                }
                             });
                  <?php
               }
               break;
            case "cpo_ip_addresses" :
               ?>
                  jQuery("#ux_li_security_settings").addClass("active");
                  jQuery("#ux_li_manage_ip_addresses").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (security_settings_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_manage_ip_addresses", 0, true, false, false);
                     jQuery("#ux_chk_all_manage_ip_address").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked", this.checked);
                     });
                     function delete_ip_address_clean_up_optimizer(meta_id)
                     {
                        var confirm_delete = confirm(<?php echo json_encode($cpo_delete_schedule); ?>);
                        if (confirm_delete === true)
                        {
                           overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_delete_blocked_ip_address); ?>);
                           jQuery.post(ajaxurl,
                                   {
                                      id_address: meta_id,
                                      param: "delete_ip_address_module",
                                      action: "clean_up_optimizer_action",
                                      _wp_nonce: "<?php echo $clean_up_manage_ip_address_delete; ?>"
                                   },
                                   function ()
                                   {
                                      setTimeout(function ()
                                      {
                                         remove_overlay_clean_up_optimizer();
                                         window.location.href = "admin.php?page=cpo_ip_addresses";
                                      }, 3000);
                                   });
                        }
                     }
                     jQuery("#ux_frm_view_blocked_ip_addresses").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                     function value_blank_clean_up_optimizer()
                     {
                        jQuery("#ux_txt_ip_address").val("");
                        jQuery("#ux_txtarea_ip_comments").val("");
                     }
                     function check_clean_up_optimizer_ip_address()
                     {
                        var single_ip = jQuery("#ux_txt_ip_address").val();
                        var flag;
                        if (single_ip !== "")
                        {
                           if (!single_ip.match(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/))
                           {
                              var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                              toastr[shortCutFunction](<?php echo json_encode($cpo_valid_ip_address_message); ?>,<?php echo json_encode($cpo_valid_ip_address_title); ?>);
                              return flag = false;
                           }
                           return flag = true;
                        }
                     }
                     jQuery("#ux_frm_manage_ip_addresses_form").validate
                             ({
                                rules:
                                        {
                                           ux_txt_ip_address:
                                                   {
                                                      required: true
                                                   }
                                        },
                                errorPlacement: function ()
                                {
                                },
                                highlight: function (element)
                                {
                                   jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                },
                                success: function (label, element)
                                {
                                   var icon = jQuery(element).parent(".input-icon").children("i");
                                   jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                   icon.removeClass("fa-warning").addClass("fa-check");
                                },
                                submitHandler: function ()
                                {
                                   var ip_address_flag = check_clean_up_optimizer_ip_address();
                                   if (ip_address_flag === true)
                                   {
                                      var ip_address = jQuery("#ux_txt_ip_address").val();
                                      jQuery.post(ajaxurl,
                                              {
                                                 data: base64_encode_clean_up_optimizer(jQuery("#ux_frm_manage_ip_addresses_form").serialize()),
                                                 ip_address: ip_address,
                                                 param: "manage_ip_address_module",
                                                 action: "clean_up_optimizer_action",
                                                 _wp_nonce: "<?php echo $clean_up_manage_ip_address; ?>"
                                              },
                                              function (data)
                                              {
                                                 if (parseInt(data) === 1)
                                                 {
                                                    var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                                                    toastr[shortCutFunction](<?php echo json_encode($cpo_duplicate_ip_address); ?>,<?php echo json_encode($cpo_duplicate_ip_address_title); ?>);
                                                 } else
                                                 {
                                                    overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_advance_security_manage_ip_address); ?>);
                                                    setTimeout(function ()
                                                    {
                                                       remove_overlay_clean_up_optimizer();
                                                       window.location.href = "admin.php?page=cpo_ip_addresses";
                                                    }, 3000);
                                                 }
                                              });
                                   }
                                }
                             });
                  <?php
               }
               break;
            case "cpo_ip_ranges" :
               ?>
                  jQuery("#ux_li_security_settings").addClass("active");
                  jQuery("#ux_li_manage_ip_ranges").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (security_settings_clean_up_optimizer == "1") {
                  ?>
                     var oTable = get_datatable_clean_up_optimizer("#ux_tbl_manage_ip_range", 0, true, false, false);
                     jQuery("#ux_chk_all_manage_ip_range").click(function ()
                     {
                        jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked", this.checked);
                     });

                     function delete_ip_range_clean_up_optimizer(meta_id)
                     {
                        var confirm_delete = confirm(<?php echo json_encode($cpo_delete_schedule); ?>);
                        if (confirm_delete === true)
                        {
                           overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_delete_blocked_ip_range); ?>);
                           jQuery.post(ajaxurl,
                                   {
                                      id_range: meta_id,
                                      param: "delete_ip_range_module",
                                      action: "clean_up_optimizer_action",
                                      _wp_nonce: "<?php echo $clean_up_manage_ip_ranges_delete; ?>"
                                   },
                                   function ()
                                   {
                                      setTimeout(function ()
                                      {
                                         remove_overlay_clean_up_optimizer();
                                         window.location.href = "admin.php?page=cpo_ip_ranges";
                                      }, 3000);
                                   });
                        }
                     }
                     jQuery("#ux_view_manage_ip_ranges").validate
                             ({
                                rules:
                                        {
                                           ux_txt_start_date:
                                                   {
                                                      required: true
                                                   },
                                           ux_txt_end_date:
                                                   {
                                                      required: true
                                                   }
                                        },
                                errorPlacement: function ()
                                {
                                },
                                highlight: function (element)
                                {
                                   jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                },
                                success: function (label, element)
                                {
                                   var icon = jQuery(element).parent(".input-icon").children("i");
                                   jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                   icon.removeClass("fa-warning").addClass("fa-check");
                                },
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                     function value_blank_clean_up_optimizer()
                     {
                        jQuery("#ux_txt_start_ip_range").val("");
                        jQuery("#ux_txt_end_ip_range").val("");
                        jQuery("#ux_txtarea_manage_ip_range").val("");
                     }
                     function check_all_ip_ranges_clean_up_optimizer(control_id)
                     {
                        var ip_value = jQuery(control_id).val();
                        var flag;
                        if (ip_value !== "")
                        {
                           if (!jQuery(control_id).val().match(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/))
                           {
                              var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                              switch (jQuery(control_id).attr("id"))
                              {
                                 case "ux_txt_start_ip_range" :
                                    toastr[shortCutFunction](<?php echo json_encode($cpo_valid_ip_range_message); ?>,<?php echo json_encode($cpo_valid_ip_address_title); ?>);
                                    break;
                                 case "ux_txt_end_ip_range" :
                                    toastr[shortCutFunction](<?php echo json_encode($cpo_valid_ip_range_message); ?>,<?php echo json_encode($cpo_valid_ip_address_title); ?>);
                                    break;
                              }
                              return flag = false;
                           }
                           return flag = true;
                        }
                     }
                     jQuery("#ux_frm_manage_ip_ranges").validate
                             ({
                                rules:
                                        {
                                           ux_txt_start_ip_range:
                                                   {
                                                      required: true
                                                   },
                                           ux_txt_end_ip_range:
                                                   {
                                                      required: true
                                                   }
                                        },
                                errorPlacement: function ()
                                {
                                },
                                highlight: function (element)
                                {
                                   jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                },
                                success: function (label, element)
                                {
                                   var icon = jQuery(element).parent(".input-icon").children("i");
                                   jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                   icon.removeClass("fa-warning").addClass("fa-check");
                                },
                                submitHandler: function ()
                                {
                                   var control_start_range = jQuery("#ux_txt_start_ip_range");
                                   var control_end_range = jQuery("#ux_txt_end_ip_range");
                                   if (check_all_ip_ranges_clean_up_optimizer(control_start_range) && check_all_ip_ranges_clean_up_optimizer(control_end_range))
                                   {
                                      if (ip2long(control_start_range.val()) < ip2long(control_end_range.val()))
                                      {
                                         var start_range = jQuery("#ux_txt_start_ip_range").val();
                                         var end_range = jQuery("#ux_txt_end_ip_range").val();
                                         jQuery.post(ajaxurl,
                                                 {
                                                    data: base64_encode_clean_up_optimizer(jQuery("#ux_frm_manage_ip_ranges").serialize()),
                                                    start_range: start_range,
                                                    end_range: end_range,
                                                    param: "manage_ip_ranges_module",
                                                    action: "clean_up_optimizer_action",
                                                    _wp_nonce: "<?php echo $clean_up_manage_ip_ranges; ?>"
                                                 },
                                                 function (data)
                                                 {
                                                    if (parseInt(data) === 1)
                                                    {
                                                       var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                                                       toastr[shortCutFunction](<?php echo json_encode($cpo_duplicate_ip_range); ?>,<?php echo json_encode($cpo_duplicate_ip_address_title); ?>);
                                                    } else
                                                    {
                                                       overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_advance_security_manage_ip_ranges); ?>);
                                                       setTimeout(function ()
                                                       {
                                                          remove_overlay_clean_up_optimizer();
                                                          window.location.href = "admin.php?page=cpo_ip_ranges";
                                                       }, 3000);
                                                    }
                                                 });
                                      } else
                                      {
                                         var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                                         toastr[shortCutFunction](<?php echo json_encode($cpo_valid_ip_range_message); ?>,<?php echo json_encode($cpo_valid_ip_address_title); ?>);
                                      }
                                   } else
                                   {
                                      var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                                      toastr[shortCutFunction](<?php echo json_encode($cpo_valid_ip_address_message); ?>,<?php echo json_encode($cpo_valid_ip_address_title); ?>);
                                   }
                                }
                             });
                  <?php
               }
               break;
            case "cpo_block_unblock_countries" :
               ?>
                  jQuery("#ux_li_security_settings").addClass("active");
                  jQuery("#ux_li_block_unblock_countries").addClass("active");
               <?php
               if (security_settings_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        var available_countries = ["AF", "AX", "AL", "DZ", "AS", "AD", "AO", "AI", "AQ", "AG", "AR", "AM", "AW", "AU", "AT", "AZ", "BS", "BH", "BD", "BB", "BY", "BE", "BZ", "BJ", "BM", "BT", "BO", "BQ", "BA", "BW", "BV", "BR", "IO", "BN", "BG", "BF", "BI", "KH", "CM", "CA", "CV", "KY", "CF", "TD", "CL", "CN", "CX", "CC", "CO", "KM", "CG", "CD", "CK", "CR", "CI", "HR", "CU", "CW", "CY", "CZ", "DK", "DJ", "DM", "DO", "EC", "EG", "SV", "GQ", "ER", "EE", "ET", "FK", "FO", "FJ", "FI", "FR", "GF", "PF", "TF", "GA", "GM", "GE", "DE", "GH", "GI", "GR", "GL", "GD", "GP", "GU", "GT", "GG", "GN", "GW", "GY", "HT", "HM", "VA", "HN", "HK", "HU", "IS", "IN", "ID", "IR", "IQ", "IE", "IM", "IL", "IT", "JM", "JP", "JE", "JO", "KZ", "KE", "KI", "KP", "KR", "KW", "KG", "LA", "LV", "LB", "LS", "LR", "LY", "LI", "LT", "LU", "MO", "MK", "MG", "MW", "MY", "MV", "ML", "MT", "MH", "MQ", "MR", "MU", "YT", "MX", "FM", "MD", "MC", "MN", "ME", "MS", "MA", "MZ", "MM", "NA", "NR", "NP", "NL", "NC", "NZ", "NI", "NE", "NG", "NU", "NF", "MP", "NO", "OM", "PK", "PW", "PS", "PA", "PG", "PY", "PE", "PH", "PN", "PL", "PT", "PR", "QA", "RE", "RO", "RU", "RW", "BL", "SH", "KN", "LC", "MF", "PM", "VC", "WS", "SM", "ST", "SA", "SN", "RS", "SC", "SL", "SG", "SX", "SK", "SI", "SB", "SO", "ZA", "GS", "SS", "ES", "LK", "SD", "SR", "SJ", "SZ", "SE", "CH", "SY", "TW", "TJ", "TZ", "TH", "TL", "TG", "TK", "TO", "TT", "TN", "TR", "TM", "TC", "TV", "UG", "UA", "AE", "GB", "US", "UM", "UY", "UZ", "VU", "VE", "VN", "VG", "VI", "WF", "EH", "YE", "ZM", "ZW"];
                        var all_available_countries = [];
                        var selected_countries = "<?php echo isset($country_data_array["country_blocks_data"]) ? esc_attr($country_data_array["country_blocks_data"]) : ""; ?>";
                        var strings = selected_countries.split(",");
                        all_available_countries = available_countries.filter(function (val)
                        {
                           return selected_countries.indexOf(val) === -1;
                        });
                        var option = "";
                        var option1 = "";
                        if (all_available_countries.length > 0)
                        {
                           for (var flag = 0; flag < all_available_countries.length; flag++)
                           {
                              if (all_available_countries[flag] !== "")
                              {
                                 option += '<option value="' + all_available_countries[flag] + '"> ' + jQuery("#ux_ddl_available_country_duplicate option[value=" + all_available_countries[flag] + "]").text() + '</option>';
                              }
                           }
                           jQuery("#ux_ddl_available_country").append(option);
                           sort_function_clean_up_optimizer("ux_ddl_selected_country");
                        }
                        var sel_coun = selected_countries.split(",");
                        if (sel_coun.length > 0)
                        {
                           for (var flag = 0; flag < sel_coun.length; flag++)
                           {
                              if (sel_coun[flag] !== "")
                              {
                                 option1 += '<option value="' + sel_coun[flag] + '"> ' + jQuery("#ux_ddl_available_country_duplicate option[value=" + sel_coun[flag] + "]").text() + '</option>';
                              }
                           }
                           jQuery("#ux_ddl_selected_country").append(option1);
                           sort_function_clean_up_optimizer("ux_ddl_available_country");
                        }
                     });
                     function add_country_clean_up_optimizer()
                     {
                        var selected_countries = [];
                        jQuery.each(jQuery("#ux_ddl_available_country option:selected"), function ()
                        {
                           selected_countries.push(jQuery(this));
                           jQuery(this).remove();
                        });
                        var value = "";
                        for (var flag = 0; flag < selected_countries.length; flag++)
                        {
                           value += '<option value="' + jQuery(selected_countries[flag]).val() + '">' + jQuery(selected_countries[flag]).text() + '</option>';
                        }
                        jQuery("#ux_ddl_selected_country").append(value);
                        sort_function_clean_up_optimizer("ux_ddl_selected_country");
                     }
                     function remove_country_clean_up_optimizer()
                     {
                        var selected_countries = [];
                        jQuery.each(jQuery("#ux_ddl_selected_country option:selected"), function ()
                        {
                           selected_countries.push(jQuery(this));
                           jQuery(this).remove();
                        });
                        var value = "";
                        for (var flag = 0; flag < selected_countries.length; flag++)
                        {
                           value += '<option value="' + jQuery(selected_countries[flag]).val() + '">' + jQuery(selected_countries[flag]).text() + '</option>';
                        }
                        jQuery("#ux_ddl_available_country").append(value);
                        sort_function_clean_up_optimizer("ux_ddl_available_country");
                     }

                     jQuery("#ux_frm_country_blocks").validate
                             ({
                                submitHandler: function ()
                                {
                                   premium_edition_notification_clean_up_optimizer();
                                }
                             });
                  <?php
               }
               break;
            case "cpo_other_settings" :
               ?>
                  jQuery("#ux_li_other_settings").addClass("active");
               <?php
               if (other_settings_clean_up_optimizer == "1") {
                  ?>
                     jQuery(document).ready(function ()
                     {
                        jQuery("#ux_ddl_trackback").val("<?php echo $trackbacks_status > 0 ? "enable" : "disable" ?>");
                        jQuery("#ux_ddl_Comments").val("<?php echo $comments_status > 0 ? "enable" : "disable" ?>");
                        jQuery("#ux_ddl_live_traffic_monitoring").val("<?php echo isset($meta_data_array["live_traffic_monitoring"]) ? esc_attr($meta_data_array["live_traffic_monitoring"]) : "" ?>");
                        jQuery("#ux_ddl_visitor_log_monitoring").val("<?php echo isset($meta_data_array["visitor_logs_monitoring"]) ? esc_attr($meta_data_array["visitor_logs_monitoring"]) : "" ?>");
                        jQuery("#ux_ddl_remove_tables").val("<?php echo isset($meta_data_array["remove_tables_uninstall"]) ? esc_attr($meta_data_array["remove_tables_uninstall"]) : "" ?>");
                        jQuery("#ux_ddl_ip_address_fetching_method").val("<?php echo isset($meta_data_array["ip_address_fetching_method"]) ? esc_attr($meta_data_array["ip_address_fetching_method"]) : "" ?>");
                     });
                     jQuery("#ux_frm_other_settings").validate
                             ({
                                submitHandler: function ()
                                {
                                   overlay_loading_clean_up_optimizer(<?php echo json_encode($cpo_update_other_settings); ?>);
                                   jQuery.post(ajaxurl,
                                           {
                                              data: base64_encode_clean_up_optimizer(jQuery("#ux_frm_other_settings").serialize()),
                                              param: "other_settings_module",
                                              action: "clean_up_optimizer_action",
                                              _wp_nonce: "<?php echo $clean_up_other_settings; ?>"
                                           },
                                           function ()
                                           {
                                              setTimeout(function ()
                                              {
                                                 remove_overlay_clean_up_optimizer();
                                                 window.location.href = "admin.php?page=cpo_other_settings";
                                              }, 3000);
                                           });
                                }
                             });
                  <?php
               }
               break;
            case "cpo_system_information" :
               ?>
                  jQuery("#ux_li_system_information").addClass("active");
                  var sidebar_load_interval = setInterval(load_sidebar_content_clean_up_optimizer, 1000);
                  setTimeout(function ()
                  {
                     clearInterval(sidebar_load_interval);
                  }, 5000);
               <?php
               if (system_information_clean_up_optimizer == "1") {
                  ?>
                     jQuery.getSystemReport = function (strDefault, stringCount, string, location)
                     {
                        var o = strDefault.toString();
                        if (!string)
                        {
                           string = "0";
                        }
                        while (o.length < stringCount)
                        {
                           if (location === "undefined")
                           {
                              o = string + o;
                           } else
                           {
                              o = o + string;
                           }
                        }
                        return o;
                     };
                     jQuery(".system-report").click(function ()
                     {
                        var report = "";
                        jQuery(".custom-form-body").each(function ()
                        {
                           jQuery("h3.form-section", jQuery(this)).each(function ()
                           {
                              report = report + "\n### " + jQuery.trim(jQuery(this).text()) + " ###\n\n";
                           });
                           jQuery("tbody > tr", jQuery(this)).each(function ()
                           {
                              var the_name = jQuery.getSystemReport(jQuery.trim(jQuery(this).find("strong").text()), 25, " ");
                              var the_value = jQuery.trim(jQuery(this).find("span").text());
                              var value_array = the_value.split(", ");
                              if (value_array.length > 1)
                              {
                                 var temp_line = "";
                                 jQuery.each(value_array, function (key, line)
                                 {
                                    var tab = (key === 0) ? 0 : 25;
                                    temp_line = temp_line + jQuery.getSystemReport("", tab, " ", "f") + line + "\n";
                                 });
                                 the_value = temp_line;
                              }
                              report = report + "" + the_name + the_value + "\n";
                           });
                        });
                        try
                        {
                           jQuery("#ux_system_information").slideDown();
                           jQuery("#ux_system_information textarea").val(report).focus().select();
                           return false;
                        } catch (e)
                        {
                        }
                        return false;
                     });
                     jQuery("#ux_btn_system_information").click(function ()
                     {
                        if (jQuery("#ux_btn_system_information").text() === "Close System Information!")
                        {
                           jQuery("#ux_system_information").slideUp();
                           jQuery("#ux_btn_system_information").html("Get System Information!");
                        } else
                        {
                           jQuery("#ux_btn_system_information").html("Close System Information!");
                           jQuery("#ux_btn_system_information").removeClass("system-information");
                           jQuery("#ux_btn_system_information").addClass("close-information");
                        }
                     });
                  <?php
               }
               break;

            case "cpo_upgrade" :
               ?>
                  jQuery("#ux_li_upgrade").addClass("active");
               <?php
               break;
         }
      }
      ?>
      </script>
      <?php
   }
}