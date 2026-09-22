"use strict";

var global_base_url = $("#global_base_url").val();
var global_caption_array = $("#global_caption").val().split("||");

(function($){
	
	// ----- for global use start -----
	setInterval('$.get(global_base_url + "/generic/online/" + $("#global_user_identifier").val())',600*1000);
	$('#language_switcher').on("change", function() {
		window.location.href = global_base_url + 'generic/switchLang/' + $('#language_switcher option:selected' ).val().toLowerCase();
	});
	// ----- for global use end -----
	
	
	
	// hide sidebar in mobile
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
		document.getElementById("sidebarToggle").click();
	}
	
	
	
	// google Analytics
	if ($("#google_analytics_id").length) {
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', $('#google_analytics_id').val());
	}	
	
	
	
	// cookies consent
	if ($("#cookie_message").length) {
		window.cookieconsent.initialise({
			"palette": {
				"popup": {
					"background": "#237afc"
				},
				"button": {
					"background": "#14a7d0"
				}
			},
			"position": "bottom-right",
			"content": {
				"message": $('#cookie_message').val(),
				"deny": "Decline",
				"link": $('#cookie_policy_link_text').val(),
				"href": $('#cookie_policy_link').val()
			}
		});
	}
	
	
	
	if ($("#global_styling").length) {
		var globalStylingArray = $("#global_styling").val().split(";");
		$(".bg-gradient-primary").css("background-color", globalStylingArray[1]);
		$(".bg-gradient-primary").css("background-image", "linear-gradient(180deg, " + globalStylingArray[1] + " 10%, " + globalStylingArray[2] + " 100%)");
		$(".btn-primary").css("background-color", globalStylingArray[4]);
		$(".btn-primary").css("border-color", globalStylingArray[4]);
		$(".btn-secondary").css("background-color", globalStylingArray[5]);
		$(".btn-secondary").css("border-color", globalStylingArray[5]);
		$(".btn-success").css("background-color", globalStylingArray[6]);
		$(".btn-success").css("border-color", globalStylingArray[6]);
		$(".btn-info").css("background-color", globalStylingArray[7]);
		$(".btn-info").css("border-color", globalStylingArray[7]);
		$(".btn-warning").css("background-color", globalStylingArray[8]);
		$(".btn-warning").css("border-color", globalStylingArray[8]);
		$(".btn-danger").css("background-color", globalStylingArray[9]);
		$(".btn-danger").css("border-color", globalStylingArray[9]);
		
	}
	
	
	
	if ($("#sidebar_background_color").length) {
		$('#sidebar_background_color').colorpicker();
		$('#sidebar_background_gradient_color').colorpicker();
		$('#styling_btn_color_primary').colorpicker();
		$('#styling_btn_color_secondary').colorpicker();
		$('#styling_btn_color_info').colorpicker();
		$('#styling_btn_color_success').colorpicker();
		$('#styling_btn_color_warning').colorpicker();
		$('#styling_btn_color_danger').colorpicker();
	}
	
	
	
	$("#sidebar_style").on("change", function() {
		sidebar_styling($('#sidebar_style option:selected').val());
	});
	
	

	$("#btn_style").on("change", function() {
		btn_styling($('#btn_style option:selected').val());
	});

	

	// admin dashboard chart
	if (document.getElementById('admin_dashboard_chart_signup') != null) {
		var ctx_admin_dashboard_chart_signup = document.getElementById('admin_dashboard_chart_signup').getContext('2d');
		var admin_dashboard_chart_signup = new Chart(ctx_admin_dashboard_chart_signup, {
			type: 'bar',
			data: {
				labels: $("#signup_last_six_days_date").val().split(','),
				datasets: [{
					data: $("#signup_last_six_days_amount").val().split(','),
					backgroundColor: [
					  'rgba(54, 162, 235, 0.2)',
				      'rgba(54, 162, 235, 0.2)',
				      'rgba(54, 162, 235, 0.2)',
				      'rgba(54, 162, 235, 0.2)',
				      'rgba(54, 162, 235, 0.2)',
				      'rgba(54, 162, 235, 0.2)',
				      'rgba(54, 162, 235, 0.2)'
				    ],
					borderColor: [
				      'rgba(54, 162, 235, 1)',
				      'rgba(54, 162, 235, 1)',
				      'rgba(54, 162, 235, 1)',
				      'rgba(54, 162, 235, 1)',
				      'rgba(54, 162, 235, 1)',
				      'rgba(54, 162, 235, 1)',
			 	      'rgba(54, 162, 235, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				legend: {display: false},
				scales: {
					yAxes: [{
						ticks: {beginAtZero: true}
					}]
				}
			}
		});
	}
	
	
	
	// handle all dataTable start
	if ($("#dataTable_subscriber").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": -1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', '', 'admin/subscriber_action/remove/'));
			}
		  }
		];
		renderDataTable('dataTable_subscriber', 'query/list_subscriber/', columnDefs);
	}
	
	if ($("#dataTable_backup").length) {
		var columnDefs = [
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  }
		];
		renderDataTable('dataTable_backup', 'query/database_backup_log/', columnDefs);
	}
	
	if ($("#dataTable_activity_admin").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case 'Information' :
					  $(td).html('<span class="badge badge-success">' + cellData + '</span>');
					  break;
					case 'Warning' :
					  $(td).html('<span class="badge badge-warning">' + cellData + '</span>');
					  break;
					case 'Error' :
					  $(td).html('<span class="badge badge-danger">' + cellData + '</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css('word-break', 'break-all');
			}
		  }
		];
		renderDataTable('dataTable_activity_admin', 'query/users_activity_log/', columnDefs);
	}
	
	if ($("#dataTable_online").length) {
		var columnDefs = [
		  {
			"targets": 2,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  }
		];
		renderDataTable('dataTable_online', 'query/online_users/', columnDefs);
	}
	
	if ($("#dataTable_blog").length) {
		var columnDefs = [
		  {
		    "targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '0' :
					  $(td).html('<span class="badge badge-warning">Not Published</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-success">Published</span>');
					  break;
				}
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', 'admin/blog_edit/', 'admin/blog_remove/'));
			}
		  }
		];
		renderDataTable('dataTable_blog', 'query/list_blog/', columnDefs);
	}
	
	if ($("#dataTable_notification_admin").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '0' :
					  $(td).html('<span class="badge badge-warning">UnRead</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-success">Read</span>');
					  break;
					case '2' :
					  $(td).html('<span class="badge badge-light">System Notification	</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'admin/list_notification_view/', '', ''));
			}
		  }
		];
		renderDataTable('dataTable_notification_admin', 'query/list_notification/', columnDefs);
	}
	
	if ($("#dataTable_payment_admin").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case 'pending' :
					  $(td).html('<span class="badge badge-warning">' + cellData + '</span>');
					  break;
					case 'success' :
					  $(td).html('<span class="badge badge-success">' + cellData + '</span>');
					  break;
					case 'cancel' :
					  $(td).html('<span class="badge badge-light">' + cellData + '</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case 'pending' :
					  $(td).html('<span class="badge badge-warning">' + cellData + '</span>');
					  break;
					case 'success' :
					  $(td).html('<span class="badge badge-success">' + cellData + '</span>');
					  break;
					case 'cancel' :
					  $(td).html('<span class="badge badge-light">' + cellData + '</span>');
					  break;
					default :
					  $(td).html('');
				}
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": -1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'admin/payment_list_view/', '', 'admin/payment_list_remove_action/'));	
			}
		  }
		];
		var full_url = 'query/payment_list/' + $('#list_type').val() + '?user=' + $('#user').val();
		renderDataTable('dataTable_payment_admin', full_url, columnDefs);
	}
	
	if ($("#dataTable_payment_item").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '0' :
					  $(td).html('<span class="badge badge-danger">Disabled</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-success">Enabled</span>');
					  break;
				}
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(cellData.charAt(0).toUpperCase() + cellData.slice(1));
			}
		  },
		  {
			"targets": -1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', 'admin/payment_item_modify/', 'admin/payment_item_remove_action/'));	
			}
		  }
		];
		renderDataTable('dataTable_payment_item', 'query/payment_item/', columnDefs);
	}
	
	if ($("#dataTable_contactform").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				if (cellData == 0) {
					$(td).html('<span class="badge badge-warning">Unread</span>');
				}
				else {
					$(td).html('<span class="badge badge-success">Read</span>');
				}
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 5,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'admin/contact_form_view/', '', 'admin/contact_form_action/remove/'));
			}
		  }
		];
		renderDataTable('dataTable_contactform', 'query/contact_form_list/', columnDefs);
	}
	
	if ($("#dataTable_ticket_admin").length) {
		var columnDefs = [
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '2' :
					  $(td).html('<span class="badge badge-warning">Pending</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-success">Replied</span>');
					  break;
					case '0' :
					  $(td).html('<span class="badge badge-light">Closed</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 2,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '0' :
					  $(td).html('<span class="badge badge-warning">UnRead</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-light">Read</span>');
					  break;
				}
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 4,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 6,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'admin/ticket_view/', '', ''));
			}
		  }
		];
		renderDataTable('dataTable_ticket_admin', 'query/admin_ticket/', columnDefs);
	}
	
	if ($("#dataTable_documentation").length) {
		var columnDefs = [
		  {
		    "targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '0' :
					  $(td).html('<span class="badge badge-warning">Not Published</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-success">Published</span>');
					  break;
				}
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', 'admin/documentation_edit/', 'admin/documentation_action/remove/'));
			}
		  }
		];
		renderDataTable('dataTable_documentation', 'query/documentation_list/', columnDefs);
	}
	
	if ($("#dataTable_faq").length) {
		var columnDefs = [
		  {
			"targets": 2,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', 'admin/faq_edit/', 'admin/faq_action/remove/'));
			}
		  }
		];
		renderDataTable('dataTable_faq', 'query/faq_list/', columnDefs);
	}

	
	if ($("#dataTable_notification").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '0' :
					  $(td).html('<span class="badge badge-warning">UnRead</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-success">Read</span>');
					  break;
					case '2' :
					  $(td).html('<span class="badge badge-light">Information</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'user/my_notification_view/', '', ''));
			}
		  }
		];
		renderDataTable('dataTable_notification', 'query/user_notification/', columnDefs);
	}
	
	if ($("#dataTable_payment").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				status = cellData;
				switch (cellData) {
					case 'unpaid' :
					  $(td).html('<span class="badge badge-danger">' + cellData + '</span>');
					  break;
					case 'pending' :
					  $(td).html('<span class="badge badge-warning">' + cellData + '</span>');
					  break;
					case 'success' :
					  $(td).html('<span class="badge badge-success">' + cellData + '</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": -1,
			"createdCell": function (td, cellData, rowData, row, col) {
				if (status == 'unpaid') {
					var repay_url = global_base_url + 'user/pay_retry/' + cellData;
					$(td).html('<a href="' + repay_url + '" target="_blank" class="btn btn-danger btn-sm text-white font-weight-bold"><i class="fa fa-dollar-sign"></i> ' + $('#captain_payment_pay_now').val() + '</a>');
				}
				else if (status == 'success') {
					var invoice_url = global_base_url + 'user/invoice/' + cellData;
					$(td).html('<a href="' + invoice_url + '" class="btn btn-success btn-sm text-white font-weight-bold" target="_blank"><i class="fas fa-file-invoice"></i> ' + $('#captain_payment_list_get_invoice').val() + '</a>');
				}
				else {  //pending
					$(td).html('<a class="btn btn-light btn-sm">' + $('#captain_global_no_action_required').val() + '</a>');
				}
			}
		  }
		];
		renderDataTable('dataTable_payment', 'query/user_pay_list/', columnDefs);
	}
	
	if ($("#dataTable_my_activity").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case 'Information' :
					  $(td).html('<span class="badge badge-success">' + cellData + '</span>');
					  break;
					case 'Warning' :
					  $(td).html('<span class="badge badge-warning">' + cellData + '</span>');
					  break;
					case 'Error' :
					  $(td).html('<span class="badge badge-danger">' + cellData + '</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css('word-break', 'break-all');
			}
		  }
		];
		renderDataTable('dataTable_my_activity', 'query/my_activity_log/', columnDefs);
	}
	
	if ($("#dataTable_ticket_list").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '2' :
					  $(td).html('<span class="badge badge-success">Pending</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-warning">Replied</span>');
					  break;
					case '0' :
					  $(td).html('<span class="badge badge-light">Closed</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 2,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 4,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'user/ticket_view/', '', ''));
			}
		  }
		];
		renderDataTable('dataTable_ticket_list', 'query/user_ticket/', columnDefs);
	}
	
	if ($("#dataTable_subscription_admin").length) {
		var status;
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				status = cellData;
				switch (cellData) {
					case 'active' :
					  $(td).html('<span class="badge badge-success">Active</span>');
					  break;
					case 'suspended' :
					  $(td).html('<span class="badge badge-warning">Suspended</span>');
					  break;
					case 'pending_cancellation' :
					  $(td).html('<span class="badge badge-warning">Pending Cancellation</span>');
					  break;
					case 'expired' :
					  $(td).html('<span class="badge badge-danger">Expired</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": -3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": -2,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": -1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'admin/payment_subscription_list_view/', '', 'admin/payment_subscription_remove_action/', 'payment_subscription_admin', status));
			}
		  }
		];
		renderDataTable('dataTable_subscription_admin', 'query/payment_subscription_list/', columnDefs);
	}	

	if ($("#dataTable_list_user").length) {
		var status;
		var columnDefs = [
		  {
		    "targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '0' :
					  $(td).html('<span class="badge badge-warning">Pending</span>');
					  break;
					case '1' :
					  $(td).html('<span class="badge badge-success">Active</span>');
					  break;
					case '2' :
					  $(td).html('<span class="badge badge-danger">Deactivated</span>');
					  break;
				}
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
                $(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));				
			}
		  },
		  {
			"targets": -1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', 'admin/edit_user/', '', 'list_user'));				
				//$(td).html(renderDataTableButton(cellData, '', 'admin/edit_user/', 'admin/remove_user/', 'list_user'));				
			}
		  }
		];
		var full_url = 'query/users/' + $('#user_ids').val() + '/';
		renderDataTable('dataTable_list_user', full_url, columnDefs);
	}
	
	if ($("#dataTable_subscription_user").length) {
		var status;
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				status = cellData;
				switch (cellData) {
					case 'active' :
					  $(td).html('<span class="badge badge-success">Active</span>');
					  break;
					case 'suspended' :
					  $(td).html('<span class="badge badge-warning">Suspended</span>');
					  break;
					case 'pending_cancellation' :
					  $(td).html('<span class="badge badge-warning">Pending Cancellation</span>');
					  break;
					case 'expired' :
					  $(td).html('<span class="badge badge-danger">Expired</span>');
					  break;
				}			
			}
		  },
		  {
			"targets": -3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": -2,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": -1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'user/pay_subscription_list_view/', '', '', 'payment_subscription_user', status));
			}
		  }
		];
		renderDataTable('dataTable_subscription_user', 'query/user_subscription_list', columnDefs);
	}
	
	// for admin coupon usage log list
	if ($("#dataTable_coupon_log_admin").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
                $(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));				
			}
		  },
		  {
			"targets": 6,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'admin/payment_list_view/', '', ''));
			}
		  }
		];
		renderDataTable('dataTable_coupon_log_admin', 'query_ca/admin_coupon_log/' + $("#coupon_code").val(), columnDefs);
	}

	// for admin affiliate member list
	if ($("#dataTable_affiliate_member").length) {
		var columnDefs = [
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', 'affiliate/member_view/', ''));
			}
		  }
		];
		renderDataTable('dataTable_affiliate_member', 'query_ca/affiliate_member/', columnDefs);
	}
	
	// for admin affiliate log list
	if ($("#dataTable_affiliate_log_admin").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
                $(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));				
			}
		  },
		  {
			"targets": 6,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, '', 'affiliate/affiliate_view/', ''));
			}
		  }
		];
		renderDataTable('dataTable_affiliate_log_admin', 'query_ca/admin_affiliate_log/', columnDefs);
	}
	
	// for admin payout list
	if ($("#dataTable_affiliate_payout_admin").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
                $(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));				
			}
		  }
		];
		renderDataTable('dataTable_affiliate_payout_admin', 'query_ca/admin_payout_log/', []);
	}
	
	// for user payout list
	if ($("#dataTable_affiliate_payout").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
                $(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));				
			}
		  }
		];
		renderDataTable('dataTable_affiliate_payout', 'query_ca/payout_log/', columnDefs);
	}
	
	// for user affiliate list
	if ($("#dataTable_affiliate_log").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
                $(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));				
			}
		  }
		];
		renderDataTable('dataTable_affiliate_log', 'query_ca/affiliate_log/', columnDefs);
	}
	
	// for video listing
	if ($("#dataTable_videos_list").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				//switch (cellData) {
					//case '2' :
					  $(td).html('<img src="' +cellData +'" />');
					//  break;
					/*case '1' :
					  $(td).html('<span class="badge badge-warning">Replied</span>');
					  break;
					case '0' :
					  $(td).html('<span class="badge badge-light">Closed</span>');
					  break;*/
				//}			
			}
		  },
		
		
		  {
			"targets": 2,
			"createdCell": function (td, cellData, rowData, row, col) {
				//var cellData_array = cellData.split("http://www.tts.com/texttospeech/");
				$(td).html(renderDataTableButton(cellData,  '', '', 'video/delete_video/'));
			}
		  }
		];
		renderDataTable('dataTable_videos_list', 'video/user_videos_data/', columnDefs);
	}
	// handle all dataTable end

	
	
	// handle richTextInput area start
	if ($("#blog_body").length) {
		$('#blog_body').summernote({height:550});
		$('#blog_body').summernote('code', $('#blog_body_value').val());
	}
	
	if ($("#documentation_body").length) {
		$('#documentation_body').summernote({height:350});
		$('#documentation_body').summernote('code', $('#documentation_body_value').val());
	}
	
	if ($("#email_body").length) {
		$('#email_body').summernote({height:350});
		$('#email_body').summernote('code', $('#email_body_value').val());
	}
	
	
	if ($("#notification_body").length) {
		$('#notification_body').summernote({height:350});
		$('#notification_body').summernote('code', $('#notification_body_value').val());
	}
	
	if ($("#tc_body").length) {
		$('#tc_body').summernote({height:500});
		$('#tc_body').summernote('code', $('#tc_body_value').val());
	}	
	
	if ($("#pp_body").length) {
		$('#pp_body').summernote({height:500});
		$('#pp_body').summernote('code', $('#pp_body_value').val());
	}	
	
	
	if ($("#ticket_description").length) {
		$('#ticket_description').summernote({
			height: 350,
			toolbar: [
			  ['style', ['style']],
			  ['font', ['bold', 'underline', 'clear']],
			  ['fontname', ['fontname']],
			  ['color', ['color']],
			  ['para', ['ul', 'ol', 'paragraph']],
			  ['table', ['table']],
			  ['insert', ['link']],
			  ['view', []],
			]
		});
		$('#ticket_description').summernote('code', $('#ticket_description_value').val());
	}	
	
	if ($("#ticket_reply").length) {
		$('#ticket_reply').summernote({
			height: 350,
			toolbar: [
			  ['style', ['style']],
			  ['font', ['bold', 'underline', 'clear']],
			  ['fontname', ['fontname']],
			  ['color', ['color']],
			  ['para', ['ul', 'ol', 'paragraph']],
			  ['table', ['table']],
			  ['insert', ['link']],
			  ['view', []],
			]
		});
		$('#ticket_reply').summernote('code', $('#ticket_reply_value').val());
		$('#Rating' + $('#rating').val()).css("font-weight","Bold");
		if ($('#current_method').val() == 'ticket_view_action') {
			$("html, body").animate({ scrollTop: $(document).height() }, 1000);
		}
	}	
	// handle richTextInput area end

	
	
	// file upload zone
	if ($(".dropzone").length) {
		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone(".dropzone", {
			timeout: 180000,
			acceptedFiles: $("#allowed_file_type").val(),
			maxFilesize: $("#file_size").val()/100,
			addRemoveLinks: true,
			removedfile: function(file) {
				var fileName = file.name;
				var _ref;
				$.ajax({type: 'GET', url: global_base_url + 'files/file_upload_remove_action/' + fileName.replaceAll(' ', '_')});
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			}
		});
	}
	
	
	
	$('[data-toggle="tooltip"]').tooltip();
	
	
	$("#btn_submit_block").on("click", function() {
// 		my_blockUI(30);
	});
	
	
	$("#btn_backup_block").on("click", function() {  //database backup
		if ($('#backup_action option:selected').val() == 'A') {
// 			my_blockUI(300);
			$('#backup').submit();
		}
		else {
			$('#backup').prop('target', '_blank');
			$('#backup').submit();
		}
	});
	
	
	$("#userfile").on("change", function() {
		readIMG(this);
	});
	
	
	$("body").on("simple_input_modal_success", function(event, hidden_value, input_value, message){
		showSimpleNotice('success', message, 2000);
		setTimeout(function(){location.reload()}, 2000);
	});
	
	
	$("body").on("datatable_operation_success_callback", function(){
		$("#" + $("table[id^='dataTable_']").attr('id')).DataTable().ajax.reload();
	});
	
	
	$("body").on("reload_operation_success_callback", function(){
		document.location.reload();
	});
	

	$("body").on("catalog_add_success", function(event, message){
		showSimpleNotice('success', message, 2000);
		setTimeout(function(){location.reload()}, 2000);
	});
	
	
	$('#simple_input_modal').on('hidden.bs.modal', function() {
		$("#sim_input_label").text('');
		$("#sim_value").val('');
		$("#sim_err_msg").text('');
	});

	
	$('.fm-list-image, .fm-list-image-icon').on('click', function() {
		var file_ids = this.id;
		var base_url = $('#fm-base-url').val();
		$.getJSON(base_url + 'files/file_view/?ids='+file_ids, function(data) {
			if (data.result) {
				if (data.file_icon == 'img') {  //show image
				    var img_url = base_url + 'upload/' + data.catalog + '/' + file_ids + '.' + data.filename_ext;
					$('#fm-modal-preview').html('<img class="fm-view-image" src="' + img_url + '">');
				}
				else { // show icon according to file type
					$('#fm-modal-preview').html('<div class="fm-list-image-icon"><i class="far ' + data.file_icon + '"></i></div>');
				}
				$('#fm-modal-view-title').text(data.original_filename);
				$('#fm-modal-view-file-ids').val(file_ids);
				$('#fm-modal-view-file-name').text(data.original_filename);
				$('#fm-modal-view-file-catalog').text(data.catalog);
				$('#fm-modal-view-file-time').text(data.created_time);
				$('#fm-modal-view-file-description').text(data.description);
				$('#fm-modal-view-file-path').text(base_url + 'upload/' + data.catalog + '/' + file_ids + '.' + data.filename_ext);
				$('#fm-modal-view-download').attr('href', $('#fm-base-url').val() + 'files/file_download/' + file_ids);
				$('#fm-modal-view').modal('show');
			}
			else {
				showSimpleNotice('warning', 'No entries found, Please reload the page.', 3000);
			}
		});
	});
	
	
	
	// upgrade software
	$('#admin_upgrade_btn_start').on('click', function() {
		Swal.fire({
			title: '<h4>Are you sure to upgrade?</h4>',
			text: global_caption_array[4],
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: global_caption_array[5],
			cancelButtonText: global_caption_array[7]
			}).then(
			  function(result) {
				  if (result.value) {
					  $("#admin_upgrade_form").submit();
				// 	  my_blockUI();
				  }
			  }
			);	
	});
	
	
	
	//uninstall license
	$('#admin_uninstall_license_btn').on('click', function() {
		actionQuery('Uninstall License', 'Are you sure to uninstall the license?', '', global_base_url + 'admin/software_license_action/')
	});
	
	
	
	function readIMG(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#img').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);  //conver to base64
		}
	}
	
	
	
	$("a[id^='pay_now_button']").on('click', function() {
		event.preventDefault();
		var coupon_code = $("#pay_now_coupon_code_" + $(this).attr("name")).val();
		if (coupon_code != '' && typeof coupon_code !== "undefined") {
			var redirect_url = $(this).attr("href") + '/' + coupon_code;
			window.open(redirect_url, "_blank");
		}
		else {
			window.open($(this).attr("href"), "_blank");
		}
	});
	
	
	
	//below, for add-on only
	if ($("#addons_coupon_valid_from, #addons_coupon_valid_till").length) {
		$("#addons_coupon_valid_from, #addons_coupon_valid_till").datepicker({
			format: dt_php_to_js('Y-m-d')
		});
	}
	
	
	
	$('#addons_coupon_generate_code').on('click', function() {
		$("#addons_coupon_code").val(generate_string(6));
	});
	
	
	
	$("i[id^='btn_pay_now_coupon_apply_']").on('click', function() {
		var item_ids = $(this).attr("name");
		if ($("#pay_now_coupon_code_" + item_ids).val() != '') {
			$.getJSON(global_base_url + "coupon/validate_coupon/" + $("#btn_pay_now_coupon_apply_" + item_ids).attr("name") + '/' + $("#pay_now_coupon_code_" + item_ids).val(), function(data) {
				if (data.result) {
					$("#pay_now_price_" + item_ids).text(data.amount);
					$("#pay_now_coupon_alert_" + item_ids).text("");
					$("#btn_pay_now_coupon_apply_" + item_ids).addClass("fa fa-check").removeClass("far fa-hand-point-left");
				}
				else {
					$("#pay_now_coupon_alert_" + item_ids).text(data.message);
				}
			});
		}
	});
	
	
	
	// for multiple payment gateways add-on
	$("#addons_pg_active").on("change", function(){
		$("div[id^='block_']").hide();
		$("#block_" + $("#addons_pg_active").val()).show();
	});
	
	
	
	if ($("#addons_pg_active").length) {
		$("div[id^='block_']").hide();
		if ($("#addons_pg_active").val() != "0") {
			$("#block_" + $("#addons_pg_active").val()).show();
		}
	}
	
	
	//Credit: this snippet is from https://github.com/NikitaKA/jquery.dragOptions, it's used for drag and drop in the select element.
	$.fn.extend({dragOptions:function(t){var i={highlight:"->>"};var e=$.extend(i,t);var h=null;var u=false;$(document.body).on("mouseup",function(){u=false});return this.each(function(){var r={initial:[],hover:-1,current:-1};var a=e;var l=$(this);$(l).on("mousedown","option",function(t){if(!u&&!r.initial.length&&!t.ctrlKey&&!t.shiftKey){u=true}}).on("mousemove","option",function(){if(u&&!r.initial.length){s();r.initial=[];r.initialObjects=[];$("option",l).each(function(){r.initial.push({key:$(this).val(),text:$(this).text()});r.initialObjects.push(this)});$(this).text(a.highlight+$(this).text());r.drag=$(this).data("index");r.current=r.drag;h=this}if(!u&&!r.initial.length)return false;r.hover=$(this).data("index");if(r.current!=r.hover){r.current=r.hover;var t=r.initial.slice(0);var i=[];var e=t.splice(r.drag,1);for(var n=0,o=t.length;n<=o;n++){if(n!=r.current){i.push(t.shift())}else{i.push(e[0])}}$("option",l).each(function(t){if(t==r.current){$(this).text(a.highlight+i[t].text)}else{$(this).text(i[t].text)}});$("option",l).removeAttr("selected").eq(r.current).attr("selected","selected");(a.onDrag||$.noop).call(l)}}).on("mouseup","option",function(){if(!r.initial.length){u=false;return false}$("option",l).each(function(t){$(this).text(r.initial[t].text)});l.html("");var t=r.initialObjects.splice(r.drag,1);for(var i=0,e=r.initialObjects.length;i<=e;i++){if(i!=r.current){l.append(r.initialObjects.shift())}else{l.append(t[0])}}$(l)[0].selectedIndex=r.current;s();r.hover=-1;r.initial=[];r.initialObjects=[];h=null;(a.onChange||$.noop).call(l)}).on("mouseleave",function(){$(h).trigger("mouseup")}).on("mousemove",function(){if(!u&&h){$(h).trigger("mouseup")}});var s=function(){$("option",l).each(function(t){$(this).data("index",t)})}})}})
	
})(jQuery);



// all about render dataTable start
function renderDataTableButton(ids, view_url, edit_url, remove_url, append = '', append_data = '') {
	var btn = '', resp = '', singleBtn;
	((view_url == '' && edit_url == '') || (edit_url == '' && remove_url == '') || (view_url == '' && remove_url == '')) ? singleBtn = 1 : singleBtn = 0;
	(append != '') ? singleBtn = 0 : null;
	if (view_url != '') {
		var action_view_url = global_base_url + view_url + ids;
		if (singleBtn) {  //one button only
			btn = '<a href="' + action_view_url + '" class="btn btn-light btn-sm btn-action"><i class="icon-view"></i></a>';
		}
		else {
			btn = '<a class="dropdown-item" href="' + action_view_url + '" class="btn btn-light btn-sm btn-action"><i class="icon-view mr-2"></i> ' + global_caption_array[0] + '</a>';
		}
	}
	if (edit_url != '') {
		var action_edit_url = global_base_url + edit_url + ids;
		if (singleBtn) {  //one button only
			btn = '<a href="' + action_edit_url + '" class="btn btn-light btn-sm btn-action"><i class="fa fa-edit text-gray-500"></i></a>';
		}
		else {
			btn += '<a class="dropdown-item" href="' + action_edit_url + '" class="btn btn-light btn-sm btn-action"><i class="fa fa-edit text-gray-500 mr-2"></i> ' + global_caption_array[1] + '</a>';
		}
	}
	if (remove_url != '') {
		var action_remove_url = global_base_url + remove_url + ids;
		if (singleBtn) {  //one button only
			btn = '<a href="javascript:void(0)" onclick="actionQuery(\'' + global_caption_array[3] + '\', \'' + global_caption_array[4] + '\', \'' + action_remove_url + '\')" class="btn btn-light btn-sm btn-action"><i class="icon-delete"></i></a>';
		}
		else {
			btn += '<a class="dropdown-item" href="javascript:void(0)" onclick="actionQuery(\'' + global_caption_array[3] + '\', \'' + global_caption_array[4] + '\', \'' + action_remove_url + '\')" class="btn btn-light btn-sm btn-action"><i class="icon-delete mr-2"></i> ' + global_caption_array[2] + '</a>';
		}
	}
	if (!singleBtn) {
		var btns;
		(append == '') ? btns = btn : btns  = btn + renderDataTableButtonAppend(ids, append, append_data);
		resp = '<div class="btn-group" role="group"><button id="btnGroupDrop" type="button" class="btn btn-light btn-sm btn-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h text-gray-500 btn-action"></i></button><div class="dropdown-menu" aria-labelledby="btnGroupDrop">' + btns + '</div></div>';
	}
	else {
		resp = btn;
	}
	return resp;
}


function renderDataTableButtonAppend(ids, type, append_data='') {  //handle special button group
	var resp = '';
	switch (type) {
		case 'payment_subscription_admin' :
		  var caption_subscription_action_array = $('#caption_subscription_action').val().split('||');
		  if (append_data == 'active') {
			  resp = '<a class="dropdown-item" href="javascript:void(0)" onclick="subscription_action(\'' + ids + '\', \'cancel\')"><i class="fa fa-pause text-gray-500 mr-2"></i> ' + caption_subscription_action_array[6] + '</a>';
			  resp += '<a class="dropdown-item" href="javascript:void(0)" onclick="subscription_action(\'' + ids + '\', \'cancel_now\')"><i class="fa fa-times text-gray-500 mr-2"></i> ' + caption_subscription_action_array[7] + '</a>';
		  }
		  else if (append_data == 'pending_cancellation' || append_data == 'suspended') {
			  resp = '<a class="dropdown-item" href="javascript:void(0)" onclick="subscription_action(\'' + ids + '\', \'resume\')"><i class="fa fa-play text-gray-500 mr-2"></i> ' + caption_subscription_action_array[8] + '</a>';
			  resp += '<a class="dropdown-item" href="javascript:void(0)" onclick="subscription_action(\'' + ids + '\', \'cancel_now\')"><i class="fa fa-times text-gray-500 mr-2"></i> ' + caption_subscription_action_array[9] + '</a>';
		  }
		  break;
		case 'payment_subscription_user' :
		  var caption_list_user_array = $('#caption_subscription_action').val().split('||');
		  if (append_data == 'active') {
			  resp = '<a class="dropdown-item" href="javascript:void(0)" onclick="subscription_action(\'' + ids + '\', \'user_cancel\')"><i class="fa fa-pause text-gray-500 mr-2"></i> ' + caption_list_user_array[0] + '</a>';
		  }
		  else if (append_data == 'pending_cancellation' || append_data == 'suspended') {
			  resp = '<a class="dropdown-item" href="javascript:void(0)" onclick="subscription_action(\'' + ids + '\', \'user_resume\')"><i class="fa fa-play text-gray-500 mr-2"></i> ' + caption_list_user_array[1] + '</a>';
		  }
		  break;
		case 'list_user' :
		  var caption_list_user_array = $('#caption_list_user').val().split('||');
		  var signin_url = global_base_url + 'admin/signin_as_user/' + ids;
		  resp = '<a class="dropdown-item" href="javascript:void(0)" onclick="actionQuery(\'' + caption_list_user_array[0] + '\', \'' + caption_list_user_array[1] + '\', \'\', \'' + signin_url + '\')"><i class="fa fa-sign-in-alt text-gray-500 mr-2"></i> ' + caption_list_user_array[2] + '</a>';
		  break;
	}
	return resp;
}


function renderDataTable(dt, ajax_url, columnDefs = [], pageLength = 25) {
	$('#' + dt).DataTable({
		"pageLength": pageLength,
		"processing": true,
        "serverSide": true,
		"ordering": false,
        "ajax": global_base_url + ajax_url,
		"columnDefs": columnDefs,
		"language": {
             "url": global_base_url + "assets/default/vendors/datatables/i18n/" + $("#global_site_language").val() + ".json"
        }
	});	
}


// all about render dataTable end


// function my_blockUI(second = 0) {
// 	$.blockUI(
// 	{
// 		overlayColor: '#000000',
// 		state: 'primary',
// 		message: '<img src="' + global_base_url + 'assets/default/images/loading-icon.gif" alt="Processing..."/>',
// 		css: {
// 			border:"none",
// 			backgroundColor:"transparent"
// 		}
// 	});
// 	(second > 0) ? setTimeout($.unblockUI, second*1000) : null;
// }



function showSimpleNotice(icon, text, millsec) {
	Swal.fire({
        icon: icon,
        title: '<h5>' + text + '</h5>',
        showConfirmButton: false,
        timer: millsec
    });
}



function showMessage(icon, title, text, redirectTo) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
		confirmButtonText: global_caption_array[8]
    }).then(function(result) {
        if (result.value) {
			if (redirectTo == 'CallBack') {
				$("body").trigger("datatable_operation_success_callback");
			}
			else if (redirectTo == 'ReloadPage') {
				$("body").trigger("reload_operation_success_callback");
			}
			else if (redirectTo != '') {
				window.location.href = redirectTo;
			}
        }
    });	
}



function actionQuery(title, text, getDataFromUrl, redirectTo) {
	(typeof redirectTo == 'undefined') ? redirectTo = '' : null;
	var icon;
    Swal.fire({
        title: '<h4>' + title + '</h4>',
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: global_caption_array[5],
		cancelButtonText: global_caption_array[7]
    }).then(function(result) {
        if (result.value) {
			if (getDataFromUrl!='') {
				$.get(getDataFromUrl, function(data){  //get from a url
					var obj = JSON.parse(data);
					(obj.result) ? icon = "success" : icon = "error";
					showMessage(icon, obj.title, obj.text, obj.redirect);
				});
			}
			else {
				if (redirectTo != '') {
					window.location.href = redirectTo;
				}
			}
        }
    });	
}



function simple_input_modal_show(form_action, hidden_value, modal_title, input_label, input_value) {
	(typeof input_value == 'undefined') ? input_value = '' : null;
	document.sim_submit_to.action = form_action;  //required
	$("#sim_hidden").val(hidden_value); //required
	$("#sim_title").text(modal_title); //required
	$("#sim_input_label").text(input_label); //required
	$("#sim_err_msg").text('');  //clear the alert area
	$("#sim_value").val(input_value); //not required, only for update operation
	$('#simple_input_modal').modal('show'); 
}



function simReadySubmit() {
	document.getElementById("btn_submit").disabled = true;
	document.getElementById("loading_spinner").style.display = '';
	simple_input_modal_submit('sim_submit_to');
}



function simple_input_modal_submit(form_name) {
	$.ajax({
		type: 'post',
		url: $('#'+form_name).attr('action'),
		data: $('#'+form_name).serialize(),
		success: function(data) {  //post form and get json
			var json = JSON.parse(data);
			document.getElementById("btn_submit").disabled = false;
			document.getElementById("loading_spinner").style.display= 'none';
			if (json.result) {
				$('#simple_input_modal').modal('toggle');  // close modal
				$("body").trigger("simple_input_modal_success", [$("#sim_hidden").val(), $("#sim_value").val(), json.message]);  // trigger some value back, can be listened
				return true;
			}
			else {
				$("#sim_err_msg").text(json.message);
				return false;
			}
		}
	});
}



function catalog_modal_show(form_action, cata_ids, modal_title, cata_type, cata_name, cata_description) {
	(typeof cata_name == 'undefined') ? cata_name = '' : null;
	(typeof cata_description == 'undefined') ? cata_description = '' : null;
	document.catalog_submit_to.action = form_action;  //required
	$("#catalog_hidden_ids").val(cata_ids); //required
	$("#catalog_title").text(modal_title); //required
	$("#catalog_err_msg").text('');  //clear the alert area
	$("#catalog_name").val(cata_name); //not required, only for update operation
	$("#catalog_description").text(cata_description); //not required, only for update operation
	if (cata_type != '') {
		$("#catalog_type").val(cata_type);
		$('#catalog_type').attr("style", "pointer-events: none;");
	}
	else {
		$("#catalog_type").removeAttr("style");
		$("#catalog_type").prop("selectedIndex", 0);
	}
	$("#catalog_modal").modal("show"); 
}



function catalogReadySubmit() {
	document.getElementById("btn_submit").disabled = true;
	$.ajax({
		type: 'post',
		url: $('#catalog_submit_to').attr('action'),
		data: $('#catalog_submit_to').serialize(),
		success: function(data) {  //post form and get json
			var json = JSON.parse(data);
			document.getElementById("btn_submit").disabled = false;
			if (json.result) {
				$('#catalog_modal').modal('toggle');  // close modal
				showSimpleNotice('success', json.message, 2000);
				setTimeout(function(){location.reload()}, 2000);
				return true;
			}
			else {
				$("#catalog_err_msg").text(json.message);
				return false;
			}
		}
	});
}



function scenario_modal_show(form_action, scenario_ids, scenario_title, scenario_icon, scenario_voice, scenario_description) {
	(typeof scenario_title == 'undefined') ? scenario_title = '' : null;
	(typeof scenario_description == 'undefined') ? scenario_description = '' : null;
	document.form_submit_to.action = form_action;
	$("#form_err_msg").text('');
	$("#scenario_hidden_ids").val(scenario_ids);
	$("#scenario_modal_title").text(scenario_title);
	if (scenario_ids == '') {
		$("#scenario_block_title").val('');
	}
	else {
		$("#scenario_block_title").val(scenario_title);
	}
	$("#scenario_block_icon").val(scenario_icon);
	$("#scenario_block_voice").val(scenario_voice);
	$("#scenario_block_description").text(scenario_description);
	$("#scenario_modal").modal("show"); 
}



function bgMusic_modal_show(form_action, bgMusic_ids, bgMusic_name, bgMusic_url) {
	document.form_submit_to.action = form_action;
	$("#form_err_msg").text('');
	$("#bgMusic_hidden_ids").val('');
	$("#bgMusic_title").val('');
	$("#bgMusic_url").val('');
	if (typeof bgMusic_ids != 'undefined') {
		$("#bgMusic_hidden_ids").val(bgMusic_ids);
		$("#bgMusic_title").val(bgMusic_name);
		$("#bgMusic_url").val(bgMusic_url);
	}
	$("#bgMusic_modal").modal("show"); 
}



function formReadySubmit(formName) {
	document.getElementById("btn_submit").disabled = true;
	$.ajax({
		type: 'post',
		url: $('#form_submit_to').attr('action'),
		data: $('#form_submit_to').serialize(),
		success: function(data) {  //post form and get json
			var json = JSON.parse(data);
			document.getElementById("btn_submit").disabled = false;
			if (json.result) {
				$('#'+formName).modal('toggle');  // close modal
				showSimpleNotice('success', json.message, 2000);
				setTimeout(function(){location.reload()}, 2000);
				return true;
			}
			else {
				$("#form_err_msg").text(json.message);
				return false;
			}
		}
	});
}



function time_conversion(original_dt, offset_second, output_date_format, output_time_format) {
	var date_format, time_format, dd, tt, new_dt;
	var dt = moment(original_dt, "YYYY-MM-DD HH:mm:ss").toDate();
	dt.setSeconds(dt.getSeconds() + parseInt(offset_second));
	switch (output_date_format) {
		case 'Y-m-d' :
		  date_format = 'YYYY-MM-DD';
		  break;
		case 'd-m-Y' :
		  date_format = 'DD-MM-YYYY';
		  break;
		case 'd/m/Y' :
		  date_format = 'DD/MM/YYYY';
		  break;
		case 'm-d-Y' :
		  date_format = 'MM-DD-YYYY';
		  break;
		case 'm/d/Y' :
		  date_format = 'MM/DD/YYYY';
		  break;
	}
	switch (output_time_format) {
		case 'H:i:s' :
		  time_format = 'HH:mm:ss';
		  break;
		case 'g:i:s A' :
		  time_format = 'hh:mm:ss A';
		  break;
	}
	dd = moment(dt).format(date_format);
	tt = moment(dt).format(time_format);
	new_dt = dd + ' ' + tt
	return new_dt;
}



function KeyDown(func) {
	if (event.keyCode == 13) {
		event.returnValue=false;
		event.cancel = true;
		window[func]();
	}
}



function demo_show_credential(type) {
	if (type == 'admin') {
		$('#username').val('admin');
		$('#password').val('admin');
	}
	else {
		$('#username').val('user');
		$('#password').val('user');
	}
	return true;
}



function go_to_signup() {
	var sel = document.getElementById('choose_action');
	if (sel.value == 'signup') {
		window.location.href = global_base_url + 'auth/signup';
	}
}



function copyToClipboard(text) {
	if (window.clipboardData && window.clipboardData.setData) {
		// Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
        return clipboardData.setData("Text", text);

    }
    else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
		var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
            return document.execCommand("copy");  // Security exception may be thrown by some browsers.
        }
        catch (ex) {
            console.warn("Copy to clipboard failed.", ex);
            return false;
        }
        finally {
            document.body.removeChild(textarea);
        }
    }
}



function subscription_action(ids, act) {
// 	my_blockUI(3);
	var caption_subscription_action_array = $('#caption_subscription_action').val().split('||');
	if (act == 'cancel') {  //cancel after period ends
		var cancel_url = global_base_url + 'admin/payment_subscription_action/cancel/' + ids;
		actionQuery(caption_subscription_action_array[0], caption_subscription_action_array[1], cancel_url);
	}
	else if (act == 'cancel_now') {  //cancel at once
		var cancel_now_url = global_base_url + 'admin/payment_subscription_action/cancel_now/' + ids;
		actionQuery(caption_subscription_action_array[2], caption_subscription_action_array[3], cancel_now_url);
	}
	else if (act == 'resume') {  //resume
		var resume_url = global_base_url + 'admin/payment_subscription_action/resume/' + ids;
		actionQuery(caption_subscription_action_array[4], caption_subscription_action_array[5], resume_url);
	}
	else if (act == 'user_cancel') {  //not cancel now, just cancel until next billing day
		var cancel_url = global_base_url + 'user/pay_subscription_action/cancel/' + ids;
		actionQuery(caption_subscription_action_array[2], caption_subscription_action_array[3], cancel_url)
	}
	else if (act == 'user_resume') {
		var resume_url = global_base_url + 'user/pay_subscription_action/resume/' + ids;
		actionQuery(caption_subscription_action_array[4], caption_subscription_action_array[5], resume_url)
	}
}


function dt_php_to_js(original_format) {
	var output;
	switch (original_format) {
		case 'Y-m-d' :
		  output = 'yyyy-mm-dd';
		  break;
		case 'd-m-Y' :
		  output = 'dd-mm-yyyy';
		  break;
		case 'd/m/Y' :
		  output = 'dd/mm/yyyy';
		  break;
		case 'm-d-Y' :
		  output = 'mm-dd-yyyy';
		  break;
		case 'm/d/Y' :
		  output = 'mm/dd/yyyy';
		  break;
	}
	return output;
}



function generate_string(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}


function sidebar_styling(styleName) {
	var bgColor, bgGradientColor;
	switch (styleName) {
		case 'default' :
		  bgColor = '#4e73df'; bgGradientColor = '#224abe';
		  break;
		case 'roseanna' :
		  bgColor = '#ffafbd'; bgGradientColor = '#ffc3a0';
		  break;
		case 'sexy_blue' :
		  bgColor = '#2193b0'; bgGradientColor = '#6dd5ed';
		  break;
		case 'purple_love' :
		  bgColor = '#cc2b5e'; bgGradientColor = '#753a88';
		  break;
		case 'piglet' :
		  bgColor = '#ee9ca7'; bgGradientColor = '#ffdde1';
		  break;
		case 'mauve' :
		  bgColor = '#42275a'; bgGradientColor = '#734b6d';
		  break;
		case 'shades_of_grey' :
		  bgColor = '#bdc3c7'; bgGradientColor = '#2c3e50';
		  break;
		case 'lost_memory' :
		  bgColor = '#de6262'; bgGradientColor = '#ffb88c';
		  break;
		case 'socialive' :
		  bgColor = '#06beb6'; bgGradientColor = '#48b1bf';
		  break;
		case 'cherry' :
		  bgColor = '#eb3349'; bgGradientColor = '#f45c43';
		  break;
		case 'pinky' :
		  bgColor = '#dd5e89'; bgGradientColor = '#f7bb97';
		  break;
		case 'lush' :
		  bgColor = '#56ab2f'; bgGradientColor = '#a8e063';
		  break;
		case 'kashmir' :
		  bgColor = '#614385'; bgGradientColor = '#516395';
		  break;
		case 'tranquil' :
		  bgColor = '#eecda3'; bgGradientColor = '#ef629f';
		  break;
		case 'pale_wood' :
		  bgColor = '#eacda3'; bgGradientColor = '#d6ae7b';
		  break;
		case 'green_beach' :
		  bgColor = '#02aab0'; bgGradientColor = '#00cdac';
		  break;
		case 'sha_la_la' :
		  bgColor = '#d66d75'; bgGradientColor = '#e29587';
		  break;
		case 'frost' :
		  bgColor = '#000428'; bgGradientColor = '#004e92';
		  break;
		case 'almost' :
		  bgColor = '#ddd6f3'; bgGradientColor = '#faaca8';
		  break;
		case 'virgin_america' :
		  bgColor = '#7b4397'; bgGradientColor = '#dc2430';
		  break;
		case 'endless_river' :
		  bgColor = '#43cea2'; bgGradientColor = '#185a9d';
		  break;
		case 'purple_white' :
		  bgColor = '#ba5370'; bgGradientColor = '#f4e2d8';
		  break;
		case 'bloody_mary' :
		  bgColor = '#ff512f'; bgGradientColor = '#dd2476';
		  break;
		case 'feel_the_love' :
		  bgColor = '#4568dc'; bgGradientColor = '#b06ab3';
		  break;
		case 'bourbon' :
		  bgColor = '#ec6f66'; bgGradientColor = '#f3a183';
		  break;
		case 'dusk' :
		  bgColor = '#ffd89b'; bgGradientColor = '#19547b';
		  break;
		case 'relay' :
		  bgColor = '#3a1c71'; bgGradientColor = '#d76d77';
		  break;
		case 'decent' :
		  bgColor = '#4ca1af'; bgGradientColor = '#c4e0e5';
		  break;
		case 'sweet_morning' :
		  bgColor = '#ff5f6d'; bgGradientColor = '#ffc371';
		  break;
		case 'scooter' :
		  bgColor = '#36d1dc'; bgGradientColor = '#5b86e5';
		  break;
		case 'celestial' :
		  bgColor = '#c33764'; bgGradientColor = '#1d2671';
		  break;
		case 'royal' :
		  bgColor = '#141e30'; bgGradientColor = '#243b55';
		  break;
		case 'sunset_gradient' :
		  bgColor = '#ff7e5f'; bgGradientColor = '#feb47b';
		  break;
		case 'peach' :
		  bgColor = '#ed4264'; bgGradientColor = '#ffedbc';
		  break;
		case 'sea_blue' :
		  bgColor = '#2b5876'; bgGradientColor = '#4e4376';
		  break;
		case 'orange_coral' :
		  bgColor = '#ff9966'; bgGradientColor = '#ff5e62';
		  break;
		case 'aubergine' :
		  bgColor = '#aa076b'; bgGradientColor = '#61045f';
		  break;  
		default :
		  bgColor = 'white'; bgGradientColor = 'white';
		  break;
	}
	$("#sidebar_background_color").colorpicker("setValue", bgColor);
	$("#sidebar_background_gradient_color").colorpicker("setValue", bgGradientColor);
}



function btn_styling(styleName) {
	var primaryColor, secondaryColor, infoColor, successColor, warningColor, dangerColor;
	switch (styleName) {
		case 'flat' :
		  primaryColor = '#1da1f5', secondaryColor = '#8039da', successColor = '#12ac70', dangerColor = '#e83d2c', warningColor = '#ffc147', infoColor = '#2ccfd4';
		  break;
		case 'love' :
		  primaryColor = '#f53b57', secondaryColor = '#ff793f', successColor = '#05c46b', dangerColor = '#dd433a', warningColor = '#ffa801', infoColor = '#575fcf';
		  break;
		case 'endless' :
		  primaryColor = '#6eabc2', secondaryColor = '#506c6a', successColor = '#799f78', dangerColor = '#bb8282', warningColor = '#d5c357', infoColor = '#957fa9';
		  break;
		case 'forest' :
		  primaryColor = '#06794f', secondaryColor = '#0fa28b', successColor = '#3ac97c', dangerColor = '#d73f30', warningColor = '#ebb20c', infoColor = '#9d46cd';
		  break;
		default :
		  primaryColor = '#0061f2', secondaryColor = '#6900c7', successColor = '#00ac69', dangerColor = '#e81500', warningColor = '#f4a100', infoColor = '#00cfd5';
		  break;
	}
	$("#styling_btn_color_primary").colorpicker("setValue", primaryColor);
	$("#styling_btn_color_secondary").colorpicker("setValue", secondaryColor);
	$("#styling_btn_color_success").colorpicker("setValue", successColor);
	$("#styling_btn_color_danger").colorpicker("setValue", dangerColor);
	$("#styling_btn_color_warning").colorpicker("setValue", warningColor);
	$("#styling_btn_color_info").colorpicker("setValue", infoColor);
}



















