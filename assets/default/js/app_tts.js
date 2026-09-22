"use strict";

var tts_global_base_url = $("#global_base_url").val();
var tts_global_caption_array = $("#global_caption").val().split("||");
var enabledEngine = $("#enabledEngine").val();
var tts_language_list_json;


(function($){
	$.ajax({  // get language list and details, the result will be saved to local as a variable
        url: tts_global_base_url + "get-language-detail/",
        async: false,
        dataType: "json",
        success: function(data) {
			tts_language_list_json = data;
        }
    });


	$('#tts_language').on("change", function(){
		if (enabledEngine == 'both' || enabledEngine == 'standard') {
			$("#tts_engine_standard").prop("checked", true);
			$("#tts_engine_neural").prop("checked", false);
			tts_list_voice_builder($("#tts_language").val(), "standard");
		}
		else {
			$("#tts_engine_neural").prop("checked", true);
			tts_list_voice_builder($("#tts_language").val(), "neural");
		}
		$("#tts_hidden_current_language").val($("#tts_language").val());
	});
	
	
	
	$('#tts_engine_standard').on("click", function(){
		$("#tts_engine_neural").prop("checked", false);
		tts_list_voice_builder($("#tts_language").val(), "standard");
	});
	
	
	
	$("#tts_engine_neural").on("click", function(){
		$("#tts_engine_standard").prop("checked", false);
		tts_list_voice_builder($("#tts_language").val(), "neural");
	});
	

	
	$('#tts_text').bind("input propertychange", function() {
		$("#tts_text_used").text(this.value.length);
		if (this.value.length > $("#tts_text_character_limit").text()) {
			var maximum_characters = $("#tts_text_character_limit").text();
			showMessage("warning", "", $('#maximum_characters_notice').val() + maximum_characters, "");
			this.value = this.value.substring(0, maximum_characters);
			$("#tts_text_used").text(maximum_characters);
		}
		if (this.value.length == 0) {
			$('#ssml_mode').prop('checked', false);
			$('#tts_btn_synthesize_to_preview').show();
			
		};
	});



	$("#tts_text_clear").on("click", function(){
		$("#tts_text").val("");
		$("#tts_text_used").text('0');
		$('#ssml_mode').prop('checked', false);
		$('#tts_btn_synthesize_to_preview').show();
	});
	
	
	
	$("#tts_text").on("focusout", function() {
		$('#tts_text_input_position').val($('#tts_text').prop("selectionStart"));		
	});	



	$("#tts_text_pause").on("click", function(){
		var tts_text = $('#tts_text').val();
		var tts_text_input_position = $('#tts_text_input_position').val();
		var tts_text_left = tts_text.substring(0, tts_text_input_position);
		var tts_text_right = tts_text.substring(tts_text_input_position);
		tts_text = tts_text_left + '<break time="1s"/>' + tts_text_right;
		$('#tts_text').val(tts_text);
		$("#tts_text_used").text($('#tts_text').val().length);
		$('#tts_text').focus();
	});
	
	
	$("#tts_breakline").on("click", function(){
		var tts_text = $('#tts_text').val();
		var tts_text_input_position = $('#tts_text_input_position').val();
		var tts_text_left = tts_text.substring(0, tts_text_input_position);
		var tts_text_right = tts_text.substring(tts_text_input_position);
		tts_text = tts_text_left + '<slidebreak>' + tts_text_right;
		$('#tts_text').val(tts_text);
		$("#tts_text_used").text($('#tts_text').val().length);
		$('#tts_text').focus();
	});
	
	
	
	$("#ssml_mode").change(function() {
		if(this.checked) {
          if ($('#tts_text').val() == '') {
			  $('#tts_text').val('<speak></speak>');
		  }
		  $('#tts_btn_synthesize_to_preview').hide();
		}
		else {
			if ($('#tts_text').val() == '<speak></speak>') {
				$('#tts_text').val('');
			}
			$('#tts_btn_synthesize_to_preview').show();
		}
	});



	$("#tts_btn_synthesize_to_preview").on("click", function(){
		event.preventDefault();
		$('#tts_view_text').hide();
		$("#synthesize_type").val('preview');
// 		my_blockUI(180);
       jsLoader(true);
		$.ajax({
			type: 'post',
			async: true,
			url: $("#tts_start").attr("action"),
			data: $("#tts_start").serialize(),
			success: function(data) {
			     jsLoader(false);
				var json = JSON.parse(data);
				if (json.result) {
					$("#tts_player").attr('controlsList', "nodownload");
					setTimeout(function(){
						$.unblockUI();
						play_file(json.tts_uri, '');
					}, $("#ttsc_preview_delay").val()*1000);
				}
				else {
					$.unblockUI();
					//alert();
					//flashNow({'error': {'message': 'Added to Library SuccessFully...!!!'}});
					showMessage("warning", "", json.message, "");
					return;
				}
			}
		});
	});



	$("#tts_btn_synthesize_to_file").on("click", function(){
		event.preventDefault();
		$("#synthesize_type").val('save');
// 		my_blockUI(180);
 jsLoader(true);
		$.ajax({
			type: 'post',
			url: $('#tts_start').attr('action'),
			data: $('#tts_start').serialize(),
			success: function(data) {
			     jsLoader(false);
				var json = JSON.parse(data);
				$.unblockUI();
				if (json.result) {
					window.location.href = global_base_url + "vox-list";
					/*$("html, body").animate({scrollTop: $("#dataTable_list_tts").offset().top}, 500);
					$("#dataTable_list_tts").DataTable().ajax.reload();*/
				}
				else {
					showMessage("warning", "", json.message, "");
					return;
				}
			}
		});	
	});
	
	
	$("#whiteboard_form").on("submit", function(event){
		event.preventDefault();
		$("#synthesize_type").val('save');
// 		my_blockUI(180);
 jsLoader(true);
		$.ajax({
			type: 'post',
			url: $('#whiteboard_form').attr('action'),
			data: new FormData(this),
			contentType: false,
            cache: false,
            processData: false,
			success: function(data) {
			     jsLoader(false);
				var json = JSON.parse(data);
				$.unblockUI();
				if (json.result) {
					window.location.href = global_base_url + "video/lists";
					/*$("html, body").animate({scrollTop: $("#dataTable_list_tts").offset().top}, 500);
					$("#dataTable_list_tts").DataTable().ajax.reload();*/
				}
				else {
					showMessage("warning", "", json.message, "");
					return;
				}
			}
		});	
	});
	
	
	
	
	$("#btn_stt_transcribe").on("click", function(){
		event.preventDefault();
// 		my_blockUI(600);
		$("#stt_language_value").val($("#stt_language").val());
		$("#stt_title_value").val($("#stt_title").val());
		$("#voice_source_value").val($("#voice_source").val());
		 jsLoader(true);
		$.ajax({
			type: 'post',
			url: $('#transcribe_start').attr('action'),
			data: $('#transcribe_start').serialize(),
			success: function(data) {
			     jsLoader(false);
				var json = JSON.parse(data);
				$.unblockUI();
				if (json.result) {
					Dropzone.forElement('.dropzone').removeAllFiles(true)
					$("html, body").animate({scrollTop: $("#dataTable_list_stt").offset().top}, 500);
					$("#dataTable_list_stt").DataTable().ajax.reload();
				}
				else {
					showMessage("warning", "", json.message, "");
					return;
				}
			}
		});	
	});
	
	

	$("#tts_sync_aws, #tts_sync_google, #tts_sync_azure, #tts_sync_ibm, #bulk_enable_aws ,#bulk_disable_aws ,#bulk_delete_aws, #bulk_enable_google, #bulk_disable_google, #bulk_delete_google, #bulk_enable_azure, #bulk_disable_azure, #bulk_delete_azure, #bulk_enable_ibm, #bulk_disable_ibm, #bulk_delete_ibm, #bulk_free, #bulk_payg, #bulk_revoke").on("click", function(){
		var id = this.id;
		Swal.fire({
			text: this.value,
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes"
		}).then(function(result) {
			if (result.value) {
				// my_blockUI(180);
				window.location.href = global_base_url + "tts/admin_resource_bulk_action/" + id;
			}
		});	
	});



	if ($("#dataTable_list_tts").length) {
	
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				//$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			$(td).html(cellData.substring(0, 100));
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(cellData.substring(0, 100)+ "...");
			}
		  },
		  {
			"targets": 5,
			"createdCell": function (td, cellData, rowData, row, col) {
				var cellData_array = cellData.split(",");
				var play_btn = '<button type="button" onclick="play_file(\'' + cellData_array[1] + '\', \'' + cellData_array[0] + '\')" id="btn_play1" class="btn btn-action btn-sm mr-2"><i class="icon-support size-icon"></i></button>';
				var download_btn = '<a href="' + global_base_url + 'tts-download/' + cellData_array[0] + '" class="btn btn-action btn-sm mr-2"><i class="icon-library-download"></i></a>';
				//var view_button = '<a href="' + global_base_url + 'tts/view/' + cellData_array[0] + '"  class="btn btn-action btn-sm mr-2"><i class="icon-stock-preview"></i></a>';
				var action_delete_url = global_base_url + 'tts-remove/' + cellData_array[0];
				var delete_button = '<a href="javascript:void(0)" onclick="actionQuery(\'' + global_caption_array[3] + '\', \'' + global_caption_array[4] + '\', \'' + action_delete_url + '\')"  class="btn btn-action btn-sm mr-2"><i class="icon-list-delete"></i></a>';
				//var action_btn = renderDataTableButton(cellData_array[0], 'tts/view/', '', 'tts/remove/');
				$(td).html(play_btn + download_btn + delete_button );
			}
		  }
		];
		renderDataTable('dataTable_list_tts', 'query/tts_list/', columnDefs);
	}



	if ($("#dataTable_list_stt").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				var statusBadge;
				if (cellData == 'completed') {
					statusBadge = '<span class="badge badge-success">' + $('#caption_completed').val() + '</span>';
				}
				else if (cellData == 'pending'){
					statusBadge = '<span class="badge badge-warning">' + $('#caption_pending').val() + '</span>';
				}
				else {
					statusBadge = '<span class="badge badge-danger">' + $('#caption_unknown').val() + '</span>';
				}
				$(td).html(statusBadge);
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  //{
			//"targets": 3,
			//"createdCell": function (td, cellData, rowData, row, col) {
				//$(td).html(cellData.substring(0, 100) + "...");
			//}
		  //},
		  {
			"targets": 5,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html('');
				//var cellData_array = cellData.split(",");
				//var play_btn = '<button type="button" onclick="play_file(\'' + cellData_array[1] + '\', \'' + cellData_array[0] + '\')" id="btn_play1" class="btn btn-light btn-sm mr-2"><i class="fa fa-play text-gray-500"></i></button>';
				//var download_btn = '<a href="' + global_base_url + 'tts/download/' + cellData_array[0] + '" target="_blank" class="btn btn-light btn-sm mr-2"><i class="fa fa-download text-gray-500"></i></a>';
				//var action_btn = renderDataTableButton(cellData_array[0], 'tts/view/', '', 'tts/remove/');
				//$(td).html(play_btn + download_btn + action_btn);
			}
		  }
		];
		renderDataTable('dataTable_list_stt', 'query/stt_list/', columnDefs);
	}
	
	
	
	if ($("#dataTableDisplay_st_list_tts").length) {
		var ttsTitle = '';
		var createdTime;
		
		var columnDefs = [
		{
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				ttsTitle = cellData;
			}
		  },
		 
		   {
			"targets": 2,
			"createdCell": function (td, cellData, rowData, row, col) {
			//	createdTime = time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val());
				createdTime = cellData;
				//alert(createdTime);
				//$(td).html(createdTime);
			}
		  },
		  
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				var view_btn = '<a href="' + tts_global_base_url + 'tts/view/' + cellData + '" target="_blank" class="btn btn-light btn-sm btn-action mr-2"><i class="icon-view"></i></a>';
				var add_btn = '<button type="button"  onclick="st_add_to_list(\'' + createdTime + '\', \'' + ttsTitle + '\', \'' + cellData + '\')" class="btn btn-light btn-action btn-sm mr-2 clear_icon music_icon_'+cellData+'"><i class="icon-add"></i></button>';
				$(td).html(view_btn + add_btn);
			}
		  }
		];
		renderDataTable('dataTableDisplay_st_list_tts', 'query/ss_tts_list/', columnDefs, 10);
	}
	
	
	
	if ($("#dataTable_list_st").length) {
		var columnDefs = [
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				var file_uri = global_base_url + 'tts_file/user/st_' + cellData + '.mp3';
				var play_btn = '<button type="button" onclick="play_file(\'' + file_uri + '\', \'\')" id="btn_play1" class="btn btn-light btn-sm mr-2 btn-action"><i class="icon-play"></i></button>';
				var download_btn = '<a href="' + global_base_url + 'ss/download/' + cellData + '" target="_blank" class="btn btn-light btn-sm mr-2 btn-action"><i class="icon-download"></i></a>';
				var action_btn = renderDataTableButton(cellData, '', '', 'ss/remove/');
				$(td).html(play_btn + download_btn + action_btn);
			}
		  }
		];
		renderDataTable('dataTable_list_st', 'query/ss_files_list/', columnDefs);
	}
	
	
	
	if ($("#dataTable_list_bgMusic").length) {
		var bgMusicTitle;
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(time_conversion(cellData, $("#timezone_offset").val(), $("#user_dateformat").val(), $("#user_timeformat").val()));
			}
		  },
		  {
			"targets": 1,
			"createdCell": function (td, cellData, rowData, row, col) {
				bgMusicTitle = cellData;
			}
		  },
		  {
			"targets": 2,
			"createdCell": function (td, cellData, rowData, row, col) {
				var cellDataArray = cellData.split(",");
				var file_uri = global_base_url + 'upload/' + cellDataArray[0];
				var play_btn = '<button type="button" onclick="play_file(\'' + file_uri + '\', \'\')" id="btn_play1" class="btn btn-light btn-sm mr-2"><i class="fa fa-play text-gray-500"></i></button>';
				var modify_btn = '<a href="javascript:void(0)" onclick="bgMusic_modal_show(\'' + global_base_url + 'ss/background_music_modify/\',\'' + cellDataArray[1] + '\', \'' + bgMusicTitle + '\', \'' + file_uri + '\')" class="btn btn-light btn-sm mr-2"><i class="fa fa-pencil-alt text-gray-500"></i></a>';
				var action_btn = renderDataTableButton(cellDataArray[1], '', '', 'ss/background_music_remove/');
				$(td).html(play_btn + modify_btn + action_btn);
			}
		  }
		];
		renderDataTable('dataTable_list_bgMusic', 'query/ss_music_mgt/', columnDefs);
	}
	
	
	
	if ($("#dataTable_list_tts_admin").length) {
		var columnDefs = [
		  {
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(cellData.substring(0, 100) + "...");
			}
		  },
		{
			"targets": 5,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html(renderDataTableButton(cellData, 'tts/admin_tts_view/', '', 'tts/remove/'));
			}
		}
		];
		renderDataTable('dataTable_list_tts_admin', 'query/tts_list_admin/', columnDefs);
	}
	
		
		
	if ($("#dataTable_tts_resource").length) {
		var columnDefs = [
		  {
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				switch (cellData) {
					case '1' :
					  $(td).html('<span class="badge badge-success">Enabled</span>');
					  break;
					case '0' :
					  $(td).html('<span class="badge badge-warning">Disabled</span>');
					  break;
				}
			}
		  },
		  {
			"targets": 7,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).html('<a href="' + global_base_url + 'tts/admin_resource_edit/' + cellData + '" target="_blank" class="btn btn-light btn-sm"><i class="fa fa-edit text-gray-500"></i></a>');
			}
		  }
		];
		renderDataTable('dataTable_tts_resource', 'query/tts_resource/', columnDefs);
	}
	
	
	
	$("#tts_listen_modal").on('hidden.bs.modal', function () {
		var player = document.getElementById("tts_player");
		player.pause();
	});
	
	
	
	if ($("#item_type").length && $("#purchase_times").length) {  //item_detail page loaded, for legacy reason ,need to check
		var act = $("#item_type").val();
		if (act == 'purchase') {
			$("#payment_item_row_recurring").hide();
			$("#renew_action option[value=3]").hide();
			$("#renew_action option[value=4]").hide();
		}
		else if (act == 'top-up') {
			$("#payment_item_row_recurring").hide();
			$("#payment_item_row_characters_limit").hide();
			$("#payment_item_row_actions").hide();
		}
		else if (act == 'subscription') {
			$("#payment_item_row_recurring").show();
			$("#renew_action option[value=1]").hide();
			$("#renew_action option[value=2]").hide();
		}
	}
	
	
	
	$("#item_type").on("change", function(){
		if ($("#purchase_times").length) {  //it's at item_detail page, for legacy reason ,need to check
			var act = $("#item_type").val();
			if (act == 'purchase') {
				$("#payment_item_row_recurring").hide();
				$("#payment_item_row_characters_limit").show();
				$("#payment_item_row_actions").show();
				$("#renew_action option[value=1]").show();
				$("#renew_action option[value=2]").show();
				$("#renew_action option[value=3]").hide();
				$("#renew_action option[value=4]").hide();
				$("#renew_action").val(1);
			}
			else if (act == 'top-up') {
				$("#payment_item_row_recurring").hide();
				$("#payment_item_row_characters_limit").hide();
				$("#payment_item_row_actions").hide();
			}
			else if (act == 'subscription') {
				$("#payment_item_row_recurring").show();
				$("#payment_item_row_characters_limit").show();
				$("#payment_item_row_actions").show();
				$("#renew_action option[value=1]").hide();
				$("#renew_action option[value=2]").hide();
				$("#renew_action option[value=3]").show();
				$("#renew_action option[value=4]").show();
				$("#renew_action").val(3);
			}
		}
	});
	
	
	if (enabledEngine == 'both' || enabledEngine == 'standard') {
		tts_list_voice_builder($("#tts_hidden_current_language").val(), "standard");  //init when page is loaded
	}
	else {
		tts_list_voice_builder($("#tts_hidden_current_language").val(), "neural");  //init when page is loaded
	}
	
	
	$("#ssml_emphasis").on("change", function(){
		var ssm_effect = $(this).val();
		switch (ssm_effect) {
			case 'ssml_emphasis_strong' :
			  tts_append_text('<emphasis level="strong"></emphasis>');
			  break;
			case 'ssml_emphasis_moderate' :
			  tts_append_text('<emphasis level="moderate"></emphasis>');
			  break;
			case 'ssml_emphasis_reduced' :
			  tts_append_text('<emphasis level="reduced"></emphasis>');
			  break;
		}
		$(this).val('ssml_emphasis_default');
		$(this).selectpicker('refresh');
		$('#ssml_mode').prop('checked', true);
		$('#tts_btn_synthesize_to_preview').hide();
	});


	$("#ssml_sayas").on("change", function(){
		var ssm_effect = $(this).val();
		switch (ssm_effect) {
			case 'ssml_sayas_characters' :
			  tts_append_text('<say-as interpret-as="characters"></say-as>');
			  break;
			case 'ssml_sayas_letters' :
			  tts_append_text('<say-as interpret-as="letters"></say-as>');
			  break;
			case 'ssml_sayas_digits' :
			  tts_append_text('<say-as interpret-as="digits"></say-as>');
			  break;
			case 'ssml_sayas_cardinal' :
			  tts_append_text('<say-as interpret-as="cardinal"></say-as>');
			  break;
			case 'ssml_sayas_ordinal' :
			  tts_append_text('<say-as interpret-as="ordinal"></say-as>');
			  break;
			case 'ssml_sayas_fraction' :
			  tts_append_text('<say-as interpret-as="fraction"></say-as>');
			  break;
			case 'ssml_sayas_unit' :
			  tts_append_text('<say-as interpret-as="unit"></say-as>');
			  break;
			case 'ssml_sayas_date' :
			  tts_append_text('<say-as interpret-as="date" format="yyyymmdd"></say-as>');
			  break;
			case 'ssml_sayas_time' :
			  tts_append_text('<say-as interpret-as="time" format="hms12"></say-as>');
			  break;
			case 'ssml_sayas_telephone' :
			  tts_append_text('<say-as interpret-as="telephone"></say-as>');
			  break;
			case 'ssml_sayas_expletive' :
			  tts_append_text('<say-as interpret-as="expletive"></say-as>');
			  break;
		}
		$(this).val('ssml_sayas_default');
		$(this).selectpicker('refresh');
		$('#ssml_mode').prop('checked', true);
		$('#tts_btn_synthesize_to_preview').hide();
	});


	$("#ssml_rpv").on("change", function(){
		var ssm_effect = $(this).val();
		switch (ssm_effect) {
			case 'ssml_rpv_rate_x_slow' :
			  tts_append_text('<prosody rate="x-slow"></prosody>');
			  break;
			case 'ssml_rpv_rate_slow' :
			  tts_append_text('<prosody rate="slow"></prosody>');
			  break;
			case 'ssml_rpv_rate_medium' :
			  tts_append_text('<prosody rate="medium"></prosody>');
			  break;
			case 'ssml_rpv_rate_fast' :
			  tts_append_text('<prosody rate="fast"></prosody>');
			  break;
			case 'ssml_rpv_rate_x_fast' :
			  tts_append_text('<prosody rate="x-fast"></prosody>');
			  break;
			case 'ssml_rpv_pitch_x_low' :
			  tts_append_text('<prosody pitch="x-low"></prosody>');
			  break;
			case 'ssml_rpv_pitch_low' :
			  tts_append_text('<prosody pitch="low"></prosody>');
			  break;
			case 'ssml_rpv_pitch_medium' :
			  tts_append_text('<prosody pitch="medium"></prosody>');
			  break;
			case 'ssml_rpv_pitch_high' :
			  tts_append_text('<prosody pitch="high"></prosody>');
			  break;
			case 'ssml_rpv_pitch_x_high' :
			  tts_append_text('<prosody pitch="x-high"></prosody>');
			  break;
			case 'ssml_rpv_volume_silent' :
			  tts_append_text('<prosody volume="silent"></prosody>');
			  break;
			case 'ssml_rpv_volume_x_soft' :
			  tts_append_text('<prosody volume="x-soft"></prosody>');
			  break;
			case 'ssml_rpv_volume_soft' :
			  tts_append_text('<prosody volume="soft"></prosody>');
			  break;
			case 'ssml_rpv_volume_medium' :
			  tts_append_text('<prosody volume="medium"></prosody>');
			  break;
			case 'ssml_rpv_volume_loud' :
			  tts_append_text('<prosody volume="loud"></prosody>');
			  break;
			case 'ssml_rpv_volume_x_loud' :
			  tts_append_text('<prosody volume="x-loud"></prosody>');
			  break;
		}
		$(this).val('ssml_rpv_default');
		$(this).selectpicker('refresh');
		$('#ssml_mode').prop('checked', true);
		$('#tts_btn_synthesize_to_preview').hide();
	});
	
	
	
	$("#ssml_advanced").on("change", function(){
		var ssm_effect = $(this).val();
		switch (ssm_effect) {
			case 'ssml_advanced_userful_strong_break' :
			  tts_append_text('<break strength="strong"/>');
			  break;
			case 'ssml_advanced_amazon_switch_language' :
			  tts_append_text('<lang xml:lang="fr-FR"></lang>');
			  break;
			case 'ssml_advanced_amazon_news' :
			  tts_append_text('<amazon:domain name="news"></amazon:domain>');
			  break;
			case 'ssml_advanced_amazon_breathing' :
			  tts_append_text('<amazon:breath/>');
			  break;
			case 'ssml_advanced_amazon_dynamic' :
			  tts_append_text('<amazon:effect name="drc"></amazon:effect>');
			  break;
			case 'ssml_advanced_amazon_speaking_softly' :
			  tts_append_text('<amazon:effect phonation="soft"></amazon:effect>');
			  break;
			case 'ssml_advanced_amazon_timbre' :
			  tts_append_text('<amazon:effect vocal-tract-length="+15%"></amazon:effect>');
			  break;
			case 'ssml_advanced_amazon_whispering' :
			  tts_append_text('<amazon:effect name="whispered"></amazon:effect>');
			  break;
		}
		$(this).val('ssml_advanced_default');
		$(this).selectpicker('refresh');
		$('#ssml_mode').prop('checked', true);
		$('#tts_btn_synthesize_to_preview').hide();
	});
	
	
	
	$('#tts_voice_list, #tts_engine_standard, #tts_engine_neural').click(function(){  //check ssml availability
		$.each(tts_language_list_json, function(key, detail){
			if (detail["ids"] == $('input[name="tts_resource_ids"]:checked').val()) {
				tts_ssml_availability_check(detail['scheme'], $('input[name="tts_engine"]:checked').val());
				return false;
			}
		});
	});
	
	
	
	$('#st_generate_background_music').on("change", function(){
		$.ajax({
			url: tts_global_base_url + "ss/background_music_uri/" + $(this).val(),
			async: false,
			dataType: "json",
			success: function(data) {
				document.getElementById('st_background_music_player').load();
				if (data.result) {
					$("#st_background_music_player").attr("src", data.uri);
				}
				else {
					$("#st_background_music_player").attr("src", "");
				}
			}
		});
	});
	
	
	
	$("#btn_st_generate").on("click", function(){
		event.preventDefault();
		var fileList = '';
		$("#st_voice_list option").each(function(){
			fileList += $(this).val() + ',';
		});
		$("#st_files_list_value").val(fileList);
// 		my_blockUI(300);  //block for 5 minutes maximum
 jsLoader(true);
		$.ajax({
			type: 'post',
			url: $('#st_start').attr('action'),
			data: $('#st_start').serialize(),
			success: function(data) {
			     jsLoader(false);
				var json = JSON.parse(data);
				$.unblockUI();
				if (json.result) {
					window.location.href = global_base_url + "ss/start_list";
					/*$("html, body").animate({scrollTop: $("#dataTable_list_st").offset().top}, 500);
					$("#dataTable_list_st").DataTable().ajax.reload();*/
				}
				else {
					showMessage("warning", "", json.message, "");
					return;
				}
			}
		});
	});
	
	
	
	$("#st_voice_list_clear").on("click", function(){
	    $(".clear_icon").show();
		$("#st_voice_list").empty();
	});
	
	
	
	$("#st_voice_list").dblclick(function() {
	var ID = $("select#st_voice_list option").filter(":selected").val();
		$(".music_icon_"+ID).show();
		$("#st_voice_list option:selected").remove();
	});
	
	
	if ($("#st_voice_list").length) {
		$("#st_voice_list").dragOptions({});
	}
	$('#tts_player').bind('contextmenu', function(){return false;});
	
})(jQuery);



function tts_append_text(appended_text) {
	var new_tts_text = $('#tts_text').val() + appended_text;
	$('#tts_text').val(new_tts_text);
	$("#tts_text_used").text($('#tts_text').val().length);
	$('#tts_text').focus();
}



function tts_ssml_availability_check(provider, engine) {
	if ($("#ssml_mode").length) {  //SSML is enabled
		if (provider == 'aws') {
			$('#ssml_advanced [value=ssml_advanced_amazon_group]').prop('disabled', false);
			if (engine == 'standard') {
				$('#ssml_emphasis').prop('disabled', false);
				$('#ssml_advanced [value=ssml_advanced_amazon_breathing]').prop('disabled', false);
				$('#ssml_advanced [value=ssml_advanced_amazon_news]').prop('disabled', true);
				$('#ssml_advanced [value=ssml_advanced_amazon_speaking_softly]').prop('disabled', false);
				$('#ssml_advanced [value=ssml_advanced_amazon_timbre]').prop('disabled', false);
				$('#ssml_advanced [value=ssml_advanced_amazon_whispering]').prop('disabled', false);
			}
			else {
				$('#ssml_emphasis').prop('disabled', true);
				$('#ssml_advanced [value=ssml_advanced_amazon_breathing]').prop('disabled', true);
				$('#ssml_advanced [value=ssml_advanced_amazon_news]').prop('disabled', false);
				$('#ssml_advanced [value=ssml_advanced_amazon_speaking_softly]').prop('disabled', true);
				$('#ssml_advanced [value=ssml_advanced_amazon_timbre]').prop('disabled', true);
				$('#ssml_advanced [value=ssml_advanced_amazon_whispering]').prop('disabled', true);
			}
			tts_ssml_specific_ibm(false);
		}
		else if (provider == 'google') {
			$('#ssml_emphasis').prop('disabled', false);
			$('#ssml_advanced [value=ssml_advanced_amazon_group]').prop('disabled', true);
			tts_ssml_specific_ibm(false);
		}
		else if (provider == 'azure') {
			$('#ssml_emphasis').prop('disabled', true);
			$('#ssml_advanced [value=ssml_advanced_amazon_group]').prop('disabled', true);
			tts_ssml_specific_ibm(false);
		}
		else if (provider == 'ibm') {
			$('#ssml_emphasis').prop('disabled', true);
			$('#ssml_advanced [value=ssml_advanced_amazon_group]').prop('disabled', true);
			tts_ssml_specific_ibm(true);
		}
		$('#ssml_emphasis').selectpicker('refresh');
		$('#ssml_sayas').selectpicker('refresh');
		$('#ssml_rpv').selectpicker('refresh');
		$('#ssml_advanced').selectpicker('refresh');
	}
	return true;
}


function tts_ssml_specific_ibm(enable) {
	if (enable) {
		$('#ssml_sayas [value=ssml_sayas_characters]').hide();
		$('#ssml_sayas [value=ssml_sayas_letters]').show();
		$('#ssml_sayas [value=ssml_sayas_digits]').show();
		$('#ssml_sayas [value=ssml_sayas_cardinal]').hide();
		$('#ssml_sayas [value=ssml_sayas_ordinal]').hide();
		$('#ssml_sayas [value=ssml_sayas_fraction]').hide();
		$('#ssml_sayas [value=ssml_sayas_unit]').hide();
		$('#ssml_sayas [value=ssml_sayas_date]').show();
		$('#ssml_sayas [value=ssml_sayas_time]').hide();
		$('#ssml_sayas [value=ssml_sayas_telephone]').hide();
		$('#ssml_sayas [value=ssml_sayas_expletive]').hide();
	}
	else {
		$('#ssml_sayas [value=ssml_sayas_characters]').show();
		$('#ssml_sayas [value=ssml_sayas_letters]').hide();
		$('#ssml_sayas [value=ssml_sayas_digits]').hide();
		$('#ssml_sayas [value=ssml_sayas_cardinal]').show();
		$('#ssml_sayas [value=ssml_sayas_ordinal]').show();
		$('#ssml_sayas [value=ssml_sayas_fraction]').show();
		$('#ssml_sayas [value=ssml_sayas_unit]').show();
		$('#ssml_sayas [value=ssml_sayas_date]').hide();
		$('#ssml_sayas [value=ssml_sayas_time]').show();
		$('#ssml_sayas [value=ssml_sayas_telephone]').show();
		$('#ssml_sayas [value=ssml_sayas_expletive]').show();
	}
	return true;
}



function tts_list_voice_builder(language_code, engine) { 	
	var voiceRadio = "", radio_id, radio_count = 0, engines, activate, checked, checked_set = false, checked_scheme, tts_example_url, tts_example_field, placeholder = 'place_holder', div_col;
	if ($("#tts_voice_list").html() != "" && $("#tts_hidden_current_language").val() != language_code) { //language changed, clear the voice list area
		$("#tts_voice_list").html('');
	}
	$.each(tts_language_list_json, function(key, detail){

		engines = detail["engines"];
		if (detail["language_code"] == language_code) {
			if (engines.includes(engine)) {
				activate = "";
				if (detail["scheme"] == "aws") {
					tts_example_url = tts_global_base_url + "tts_file/example/aws_" + engine + "_" + detail["language_code"] + "_" + detail["voice_id"] + ".mp3";
				}
				else if (detail["scheme"] == "azure") {
					tts_example_url = tts_global_base_url + "tts_file/example/azure_" + detail["voice_id"] + ".mp3";
				}
				else if (detail["scheme"] == "ibm") {
					tts_example_url = tts_global_base_url + "tts_file/example/ibm_" + detail["voice_id"] + ".mp3";
				}
				else {
					var google_voice_sample;
					(engine == 'standard') ? google_voice_sample = detail["voice_id"].replace('{{engine}}', 'Standard') : google_voice_sample = detail["voice_id"].replace('{{engine}}', 'Wavenet');
					tts_example_url = tts_global_base_url + "tts_file/example/" + google_voice_sample + ".mp3";
				}
				tts_example_field = '<audio name="tts_example_audio" id="tts_example_audio_' + detail["ids"] + '" src="' + tts_example_url + '" style="margin-bottom:15px"></audio><span class="playButton"> <i id="tts_example_play_button_' + detail["ids"] + '" onclick="play_example(\'' + detail["ids"] + '\')" class="icon-play" aria-hidden="true"></i></span>'
			}
			else {
				tts_example_field = "";
				activate = "disabled";
			}
			radio_id = "radio_" + detail["ids"];
			if (activate == "" && checked_set == false) {
				checked = " checked";
				checked_set = true;
				checked_scheme = detail["scheme"];  //used for tts_ssml_availability_check only
			}
			else {
				checked = "";
			}
			if (enabledEngine == 'both' || activate == "") {
				voiceRadio += '<div class="radio-toggle d-flex align-items-center" style="gap:20px;"><input type="radio" id="' + radio_id + '" name="tts_resource_ids" value="' + detail["ids"] + '" class="mr-2 mb-3" ' + activate + checked + '><label class="form-label" for="' + radio_id + '">' + detail["gender"] + ', ' + detail["name"] + ' </label> ' + tts_example_field + '<br></div>';
				radio_count++;
			}
		}
	});
	(radio_count > 10) ? div_col = 'col-lg-6 col-md-12' : div_col = 'col-lg-12';
	voiceRadio = voiceRadio.replaceAll('place_holder', div_col);
	
	$("#tts_voice_list").html("<div class=\"row\">" + voiceRadio + "</div>");
	tts_ssml_availability_check(checked_scheme, engine);
}



function play_example(ids) {
	var audio = document.getElementById("tts_example_audio_" + ids);
	if(!audio.paused){
		$("#tts_example_play_button_" + ids).attr("class", "icon-play");
		audio.pause();
		audio.currentTime = 0;
	}
	else {
		stop_play_examples();
		$("#tts_example_play_button_" + ids).attr("class", "icon-voice-pause");
		$("#tts_example_audio_" + ids).on("ended", function() {
			$("#tts_example_play_button_" + ids).attr("class", "icon-play");
		});
		audio.play();
	}
}



function stop_play_examples() {
	var audios = document.getElementsByTagName('audio');
	for(var i = 0, len = audios.length; i < len; i++){
		if(!audios[i].paused){
			var elId = audios[i].id;
			elId = elId.replace("tts_example_audio", "tts_example_play_button");
			$("#" + elId).attr("class", "icon-voice-pause");
			audios[i].pause();
			audios[i].currentTime = 0;
		}
	}
}



function play_file(uri, ids) {
	$('#tts_listen_modal').modal('show');
	if (ids != '') {
		$("#tts_player").attr('controlsList', "");
		$('#tts_view_text').show();
		$('#tts_view_text').attr("href", global_base_url + "tts/view/" + ids);
	}
	$("#tts_player").attr("src", uri).trigger("play");
}




function st_add_to_list(createdTime, title, ids) {
	var currentListSize = $("#st_voice_list option").length;
	if (currentListSize == $("#st_files_limit").val()) {
		var alertText = $("#st_files_limit_alert").val() + $("#st_files_limit").val();
		showMessage("warning", "", alertText, "");
	}
	else {
		var text = "[" + createdTime + "] " + title;
		$("#st_voice_list").append($("<option>", {value: ids, text: text}));
		$(".music_icon_"+ids).hide();
	}
	return true;
}

