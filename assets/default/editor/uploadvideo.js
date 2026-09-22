//update for ffmpeg video process queue system.

var UploadCount=0;
var TotalUploadCount=0;
var ProcessCompleteCount = 0;
var group = false;
var previousHTML, SelectID;
var CancleUploadArr = [];
var Uploadflag=0;

var ProjectID = 0;
var currentVideoSlug = 0;
var upload_plan_limit = 100000;
function ID(el){
	return document.getElementById(el);
}
function ClassName(el){
	return document.getElementsByClassName(el);
}

/*function startappenduploads(SelectedID){
	//alert(SelectedID.files);
	if(SelectedID.files.length > upload_plan_limit){
		var response = {};
			response['error'] = {};
			response['error']['type'] = "flash";
			response['error']['message'] = 'Error! Please upgrade your plan.';
			flashNow(response);
			return false;
	}

		appenduploads(SelectedID);
	
}*/

function startappenduploads(SelectedID) {
    CancleUploadArr = []; // Clear previous cancel list
    Uploadflag = 1; // Mark upload as in-progress

    if (SelectedID.files.length > upload_plan_limit) {
        var response = {};
        response['error'] = {};
        response['error']['type'] = "flash";
        response['error']['message'] = 'Error! Please upgrade your plan.';
        flashNow(response);
        return false;
    }

    appenduploads(SelectedID);
}


function appenduploads(SelectedID){
	SelectID = SelectedID;
	Uploadflag =1;
	//console.log(SelectedID.files[0].name);

	var imageType = ['mp3','wav','aif','ogg','oga','wma','ram','snd','jpg','png','jpeg','avi', 'divx', 'flv', 'm4v', 'mkv', 'mov', 'mp4', 'mpeg', 'mpg', 'ogm', 'ogv', 'ogx', 'rm', 'rmvb', 'smil', 'webm', 'wmv', 'xvid', '3gp', 'flv'];  

	for(var temp=0; temp < SelectID.files.length; temp++){
		
			var FileName = SelectID.files[temp].name;
			var upload_size = SelectID.files[temp].size;
			
			if(upload_size >  '314572800') {
			    var response = {};
			response['error'] = {};
			response['error']['type'] = "flash";
			response['error']['message'] = 'File size not upload more then 300 mb';
			flashNow(response);
			return false;    
			}
			var FileExtension = FileName.substr( (FileName.lastIndexOf('.') +1) );
			console.log(FileExtension);
		if (-1 == $.inArray(FileExtension, imageType)){
			var response = {};
			response['error'] = {};
			response['error']['type'] = "flash";
			response['error']['message'] = 'Invalid file type';
			flashNow(response);
			return false;
		}
	}

	TotalUploadCount = SelectID.files.length;
	$(".upload-form").hide(100);
	$(".upload-process").html('').show(100);

	for (var temp = 0; temp < SelectID.files.length; temp++) {
		var html = '\
<div class="row mt2 row upload-num-'+temp+'">\
<div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 text-center mt0 xsmt6">\
</div>\
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-10 xsmt4 mt2">\
<p class="md15 sm15 xs14 mb1 xsmb1 preheading text-ellipsis">'+SelectID.files[temp].name+'</p>\
<div class="progress progress-bar-width progress-height">\
<div class="progress-bar progress-bar-striped active uploadprogressbar'+temp+'" role="progressbar"  style="width: 0%">\
</div>\
</div>\
<p class="text-right md13 sm13 xs13 w300 preheading uploadText'+temp+'">Uploading0%</p>\
</div>\
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-2 video-cancel">\
<a href="javascript:" class="light-grey upload-cancel-btn" upload-num='+temp+'>\
<i class="icon icon-cross em12 smem12 xsem13" aria-hidden="true"></i>\
</a>\
</div>\
</div>';
		$(".upload-process").append(html);
	}
	StartUploads();
}

function StartUploads(){
    UploadCount=0;
     TotalUploadCount=0;
ProcessCompleteCount = 0;
 group = false;
	file = SelectID.files[UploadCount];
	SingleUploads(file);
}

var blob, BYTES_PER_CHUNK, SIZE, NUM_CHUNKS, start, end;
var newVideoName = '';
var current_file_part_no=1;

function SingleUploads_hold(file){
	var formdata = new FormData();
	formdata.append('video', file);
	formdata.append("Action", 'AddVideo');
	formdata.append("ProjectID", ProjectID);
	formdata.append("APIkey", APIkey);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", UploadHandler, false);
	ajax.addEventListener("load", function(event){UploadComplete(event);}, false);
	ajax.open("POST", Videowhizz_APP_URL);
	ajax.send(formdata);
	//console.log(formdata);
}

function SingleUploads(file){
	blob = file;
	BYTES_PER_CHUNK = parseInt(1048576*1, 10);
	SIZE = blob.size;
	NUM_CHUNKS = Math.max(Math.ceil(SIZE / BYTES_PER_CHUNK), 1);
	start = 0;
	end = BYTES_PER_CHUNK;
	uploadnext();
}

/*function uploadnext(event){
	if(event === undefined) { event='';}
	var count=CancleUploadArr.length;
//     for(var i=0;i<count;i++)
//     {
//         if(CancleUploadArr[i]==UploadCount){
// 			SetCancleUpload();
// 			return false;
// 		}
//     }
	//console.log(SelectID.files.length+"uploadnext");
	if(start < SIZE){
		if(event!=''){
			newVideoName = JSON.parse(event.target.responseText).video_filename;
			current_file_part_no++;
		}
		
		var percent = Math.ceil(((current_file_part_no-1)/ NUM_CHUNKS) * 100);
		$(".uploadprogressbar"+UploadCount).css("width", percent+"%");
		$(".uploadText"+UploadCount).html("Uploading "+percent+"%");
		upload(blob.slice(start, end));
		start = end;
		end = start + BYTES_PER_CHUNK;
	}else{
		
		current_file_part_no = 1;
		newVideoName = JSON.parse(event.target.responseText).video_filename;
		addVideoQueue(newVideoName, UploadCount);

		currentVideoSlug = newVideoName;
		
		newVideoName = '';
		UploadCount++;
		if(UploadCount < SelectID.files.length){
			StartUploads(ProjectID, SelectID);
		}
	}
	
}*/

function uploadnext(event) {
    if (event === undefined) { event = ''; }

    if (Uploadflag === 0) {
        console.log("Upload process stopped.");
        return false;
    }

    for (var i = 0; i < CancleUploadArr.length; i++) {
        if (CancleUploadArr[i] == UploadCount) {
            console.log("Upload canceled: " + UploadCount);
            SetCancleUpload();
            return false;
        }
    }

    if (start < SIZE) {
        if (event != '') {
            newVideoName = JSON.parse(event.target.responseText).video_filename;
            current_file_part_no++;
        }

        var percent = Math.ceil(((current_file_part_no - 1) / NUM_CHUNKS) * 100);
        $(".uploadprogressbar" + UploadCount).css("width", percent + "%");
        $(".uploadText" + UploadCount).html("Uploading " + percent + "%");

        upload(blob.slice(start, end));
        start = end;
        end = start + BYTES_PER_CHUNK;
    } else {
        current_file_part_no = 1;
        newVideoName = JSON.parse(event.target.responseText).video_filename;
        addVideoQueue(newVideoName, UploadCount);

        currentVideoSlug = newVideoName;
        newVideoName = '';
        UploadCount++;

        if (UploadCount < SelectID.files.length) {
            StartUploads(ProjectID, SelectID);
        }
    }
}

function upload(blobOrFile){
     $(".video_upload_div input[type=file]").prop("disabled", true);
	var formdata = new FormData();
	if(newVideoName!=''){
		formdata.append('video_filename', newVideoName);
	}
	else{
		var FileName = SelectID.files[UploadCount].name;
		var FileExtension = FileName.substr( (FileName.lastIndexOf('.') +1) );
		formdata.append('file_ext',FileExtension);
	}
	formdata.append('filedata',blobOrFile);
	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", UploadHandler, false);
	ajax.addEventListener("load", function(event){uploadnext(event);}, false);
	ajax.open("POST", siteUrl+'kdmvideoeditor/append_video_parts');
	ajax.send(formdata);
}

function UploadHandler(event){ //process progress bar

	var percent_part = (event.loaded / event.total / NUM_CHUNKS) * 100;
	var percent = ((current_file_part_no-1)/ NUM_CHUNKS) * 100;
	percent = Math.ceil(percent + percent_part);
	if(percent > 100) {
		percent = 100;
	}
	else if(percent < 0) {
		percent = 0;
	}
	$(".uploadprogressbar"+UploadCount).css("width", percent+"%");
	$(".uploadText"+UploadCount).html("Uploading "+percent+"%");
}

function UploadComplete(event, ProjectID, SelectID){  //afert file upload

	console.log(event.target.responseText);
	VideoName = JSON.parse(event.target.responseText).NewFileName;
	ID("GetUploadID"+UploadCount).value = VideoName;
	ID("VideoStatusTextID"+UploadCount).innerHTML= "Video is Processing";
	ID("progressBar"+UploadCount).value = 0;
	StartCheckProcessStatus(VideoName,UploadCount);
	
	
	UploadCount++;
	if(UploadCount < SelectID.files.length){
		StartUploads(ProjectID, SelectID);
	}
	
}

function addVideoQueue(video_filename, UploadID){
	console.log('title:'+SelectID.files[UploadID].name);
	console.log('video_filename:'+video_filename);
	
	$.post(siteUrl+'kdmvideoeditor/queue_insert',
	{
		'video_filename': video_filename,
		'title'			: SelectID.files[UploadID].name,
		'project_id'	: ProjectID,
	},
	function(data, status){
		var uplode_type = JSON.parse(data).uplode_type;
		  //$('.video_upload_div input[type=file]').val('');
		      $(".video_upload_div input[type=file]").prop("disabled", false);
		  $(".video_upload_div input[type=file]").val(null);
		  $(".upload-process").html('');
		$('#exampleModalVideo').modal("hide");
		FileUploadedSuccessfully(uplode_type);
	/*	setTimeout(function(){ 
			$('.video-thumbnail'+UploadID).attr('src', video_thumbnail); 
			UploadDoneAll();
		}, 500);*/
		
	});
}
function StartCheckProcessStatus(VideoName, UploadID){
	var ProcessID = UploadID;

	console.log("t="+TotalUploadCount+'p='+ProcessCompleteCount);
	$.post(Videowhizz_APP_URL,
	{
		'APIkey': APIkey,
		'Action': 'getProcessStatus',
		'VideoName': VideoName,
	},
	function(data, status){
			
			ProcessStatus = JSON.parse(data);
			percent = ProcessStatus.getProcessStatus.toFixed(1);
			
			$("#videoupload_percent_width"+UploadID).css("width", percent+"%");
			$("#videoupload_percent_text"+UploadID).html(percent+"% Video is processed");
		
			//alert(data);
			if(ProcessStatus.getProcessStatus!=100){
				StartCheckProcessStatus(VideoName, ProcessID);
			}else{
				MoveVideoOnS3(VideoName);
				ProcessCompleteCount++;
			}
	});
}
function MoveVideoOnS3(VideoName){
var array = {
				'APIkey': APIkey,
				'Action': 'MoveVideoOnS3',
				'VideoName': VideoName,
			};
$("#VideoNameinput").val(VideoName.split(".")[0]);
GetJsonAPI(array,UploadDoneAll);		
}


function CancleUpload(UploadID){
	CancleUploadArr.push(UploadID);
}
// function SetCancleUpload(){
// 	current_file_part_no = 1;
// 	newVideoName = '';
// 	//UploadCount++;
// 	UploadCount = 0;
// 	/*if(UploadCount < SelectID.files.length){
// 		StartUploads(ProjectID, SelectID);
// 	}else{
// 		if(SelectID.files.length > 1)
// 		{
// 			UploadDoneAll();
// 		}
// 		else{*/
// 			CancleAlert();
// 	//	}
// 	//}
// }

function SetCancleUpload() {
    CancleUploadArr = [];
    Uploadflag = 0;
    UploadCount = 0;
    $(".video_upload_div input[type=file]").prop("disabled", false);
    $(".video_upload_div input[type=file]").val(null);
    $(".upload-process").html('');

    notify("success", 'Success! Upload removed.');
    setTimeout(function() {
        $('#exampleModalVideo').modal("hide");
    }, 100);
}

function CancleAlert(){
       $(".video_upload_div input[type=file]").prop("disabled", false);
	notify("success", 'Success! Upload removed.');
	Uploadflag = 0;
	setTimeout(function(){
		$('#exampleModalVideo').modal("hide");
	},100);
}

function closeVideoPopup() {
    $(".video_upload_div input[type=file]").prop("disabled", false);
    $(".video_upload_div input[type=file]").val(null);
    $('#exampleModalVideo').modal("hide");
}
function UploadDoneAll(){
	if(UploadCount==TotalUploadCount){
		addvideodone(TotalUploadCount);
	}
}
function addvideodone(videocount){
	Uploadflag =0;
	if($('#replace_video').length > 0){
		//replaceExsitngVideo();
		return;
	}
	setTimeout(function(){
		$(".error_success").hide();
		 $('.video_upload_div input[type=file]').val('');
		$("#exampleModalVideo").modal("hide");
	//	window.location = siteUrl+"kdmvideoeditor/video-editor";
		return true;
	},1000);
}

function replaceExsitngVideo(){
	$.post(siteUrl+'user/Videoreplace_controller/replace_exsitng_video',
	{
		'old_slug' : $('#replace_video').val(),
		'new_slug' : currentVideoSlug
	},
	function(data, status){
		response = JSON.parse(data);
		showFlash(response);
	});
	
}

$(window).on('beforeunload', function(){
	if(Uploadflag == 1){
		return 'Are you sure you want to leave?';
	}
});

$(document).on('click', ".upload-cancel-btn", function(event){
    if (event.stopPropagation) {
      event.stopPropagation();   // W3C model
      console.log('check',event);
  }
  
        $(".video_upload_div input[type=file]").prop("disabled", false);
        $(".video_upload_div input[type=file]").val(null);
		$(".upload-process").html('');
	var uploadNum = $(this).attr('upload-num');
	$(".upload-num-"+uploadNum).hide();
	SetCancleUpload();
	CancleUpload(uploadNum)
});









var SORT_ASC = 1;
function ShortBy(orderby){
	var i = 0;
	var URL = "https://saglus.com/apps/sort.php";
	SORT_ASC = 1-SORT_ASC;
	$.post(URL,
	{
		'jsondata' : JsonToSort,
		'orderby' : orderby,
		'SORT_By_ASC' : SORT_ASC,
	},
	function(data, status){
			JSONobject = JSON.parse(data);
			JSONobject.forEach(function (item, index) {
				$("#ProjectSortby"+item.project_id).attr("data-sortid",i++);
			});		

			var $wrapper = $('.testWrapper');
			$wrapper.find('.sortbox').sort(function (a, b) {
				return +a.dataset.sortid - +b.dataset.sortid;
			})
			.appendTo( $wrapper );			
	});
	
}

function ReplaceVideoUpload(VideoName, SelectID){
		TotalUploadCount =1;
		var temp = 0;
		$("#UploadTable")
			.append($('<tr>')
			.attr('id', 'Upload_tr'+temp)
				.append($('<td>')
				.attr('style', 'width:110px;')
						.append($('<img>')
						.attr('src', AssetsURL+'images/loader.gif')
						.attr('style', 'width:100px; margin:5px;')
								)
						)
				.append($('<td>')
						.append($('<progress>')	
						.attr('class', 'progressBar')
						.attr('id', 'progressBar'+temp)	
						.attr('value', '0')
						.attr('max', '100')
						.attr('style', 'width:100%;')
						)
						.append($('<input>')
						.attr('id', 'GetUploadID'+temp)	
						.attr('type', 'text')	
						)
						.append($('<input>')
						.attr('id', 'GetTitleID'+temp)	
						.attr('type', 'text')	
						)
						.append($('<p>Video is Uploading Please Wait.</p>')
						.attr('id', 'VideoStatusTextID'+temp)	
						)
				)
			);
	ReplaceUploads(VideoName, SelectID);
}
function ReplaceUploads(VideoName, SelectID){
	
	file = SelectID.files[0];
	var formdata = new FormData();
	formdata.append('video', file);
	formdata.append("Action", 'ReplaceVideo');
	formdata.append("VideoName", VideoName);
	formdata.append("APIkey", APIkey);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", ReplaceUploadHandler, false);
	ajax.addEventListener("load", function(event){ReplaceUploadComplete(event, VideoName, SelectID);}, false);
	ajax.open("POST",Videowhizz_APP_URL);
	ajax.send(formdata);
}
function ReplaceUploadHandler(event){ //process progress bar
	var percent = (event.loaded / event.total) * 100;
	if(percent > 100) {
		percent = 100;
	}
	else if(percent < 0) {
		percent = 0;
	}
	ID("progressBar0").value = Math.round(percent);
}

function ReplaceUploadComplete(event, VideoName, SelectID){  //afert file upload
//	console.log(UploadCount);
	//var VideoName = JSON.parse(event.target.responseText).NewFileName;
	ID("GetUploadID0").value = VideoName;
	ID("VideoStatusTextID0").innerHTML= "Video is Processing";
	ID("progressBar0").value = 0;
	StartCheckProcessStatus(VideoName+'.mp4', 0);
}

function EditVideo(EditType, VideoName){
	if(EditType =="title"){
		var VideoTitle = $("#VID_Title_"+VideoName).html();
		var formvalue = "'title', '"+VideoName+"', this";
		var html = '<input type="text" value="'+VideoTitle+'" onblur="SaveVideo('+formvalue+')" maxlength="200" required="">';
		previousHTML = $("#VID_"+VideoName).html();
		$("#VID_"+VideoName).html(html);
	}
	if(EditType =="desc"){
		var VideoTitle = $("#VID_Desc_"+VideoName).html();
		var formvalue = "'desc', '"+VideoName+"', this";
		var html = '<input type="text" value="'+VideoTitle+'" onblur="SaveVideo('+formvalue+')" maxlength="200">';
		previousHTML = $("#VID_Desc_div"+VideoName).html();
		$("#VID_Desc_div"+VideoName).html(html);
	}
}

function SaveVideo(Savetype, VideoName, elementid){
	var value = elementid.value;
	if(elementid.value.length == 0){
	$(elementid).parent().append('<div style="color:#F00;font-size: 12px;" c>This field is required!</div>');
		return false;
	}	
	if(elementid.value.length >= 200){
		$(elementid).parent().append('<div style="color:#F00;font-size: 12px;" c>This field has limit 200!</div>');
		return false;
	}
	if(Savetype =='title'){
		var array = {
					'APIkey': APIkey,
					'Action': 'SaveVideoTitleDesc',
					'VideoName': VideoName,
					'title' : value,
				};
		GetJsonAPI(array, Savechangesdone, {'HTMLDiv' : 'VID_'+VideoName , 'ValueDiv': 'VID_Title_'+VideoName , 'value': value, 'previousHTML':previousHTML});
	}
	if(Savetype =='desc'){
		var array = {
					'APIkey': APIkey,
					'Action': 'SaveVideoTitleDesc',
					'VideoName': VideoName,
					'desc' : value,
				};
		GetJsonAPI(array, Savechangesdone, {'HTMLDiv' : 'VID_Desc_div'+VideoName , 'ValueDiv': 'VID_Desc_'+VideoName , 'value': value, 'previousHTML':previousHTML});
	}
}
function EditProject(EditType, ProjectID){
	if(EditType =="title"){
		var ProjectTitle = $("#PID_Title_"+ProjectID).html();
		var formvalue = "'"+EditType+"', '"+ProjectID+"', this";
		var html = '<input type="text" value="'+ProjectTitle+'" onblur="SaveProject('+formvalue+')" maxlength="200" required="">';
		previousHTML = $("#PID_"+ProjectID).html();
		$("#PID_"+ProjectID).html(html);
	}
	else if(EditType =="desc"){
		var ProjectTitle = $("#PID_Desc_"+ProjectID).html();
		var formvalue = "'"+EditType+"', '"+ProjectID+"', this";
		var html = '<input type="text" value="'+ProjectTitle+'" onblur="SaveProject('+formvalue+')" maxlength="200">';
		previousHTML = $("#PID_Desc_div"+ProjectID).html();
		$("#PID_Desc_div"+ProjectID).html(html);
	}
	
}

function SaveProject(Savetype, ProjectID, elementid){
		
	var value = elementid.value;
	if(elementid.value.length == 0){
	$(elementid).parent().append('<div style="color:#F00;font-size: 12px;" c>This field is required!</div>');
		return false;
	}	
	if(elementid.value.length >= 200){
		$(elementid).parent().append('<div style="color:#F00;font-size: 12px;" c>This field has limit 200!</div>');
		return false;
	}
	if(Savetype =='title'){
		var array = {
					'APIkey': APIkey,
					'Action': 'SaveProjectTitleDesc',
					'ProjectID': ProjectID,
					'title' : value,
				};
		GetJsonAPI(array, Savechangesdone, {'HTMLDiv' : 'PID_'+ProjectID , 'ValueDiv': 'PID_Title_'+ProjectID , 'value': value, 'previousHTML':previousHTML});
	}
	if(Savetype =='desc'){
		var array = {
					'APIkey': APIkey,
					'Action': 'SaveProjectTitleDesc',
					'ProjectID': ProjectID,
					'desc' : value,
				};
		
GetJsonAPI(array, Savechangesdone, {'HTMLDiv' : 'PID_Desc_div'+ProjectID , 'ValueDiv': 'PID_Desc_'+ProjectID , 'value': value, 'previousHTML':previousHTML});
	}
}
function Savechangesdone(data){
	$("#"+data.HTMLDiv).html(data.previousHTML);
	$("#"+data.ValueDiv).html(data.value);
	AlertAction("<strong>Success!</strong> Changes are saved", false);

}

