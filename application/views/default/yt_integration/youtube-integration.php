<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<title >Youtube Integration</title>   
<?php

if(isset($yt_access_token)) {
	$clientId = $yt_access_token->clientId;
	$clientSecret = $yt_access_token->clientSecret;
}else{
	$clientId = '';
	$clientSecret = '';
}

?>
<div class="container-wrapper container-wrapper container-open">

<div class="container-fluid container-padding">
	<div class="bonus-wrapper">
	     <div class="page-header">
				<div class="row ">
					<div class="col-lg-3">
						<div class="nav-wrapper custom-tabs side-tab py-5 sticky-top theme-color w-100 justify-content-start comman-tab">
							<ul class="nav w-100 nav-tabs flex-column align-items-start border-0 row-gap-2" id="tabs-icons-text" role="tablist">
								<li class="nav-item w-100" role="presentation">
									<a class="nav-link w-100 text-white rounded active font-16" id="tabs-youtube-x" data="YouTube Integration " data-bs-toggle="tab" data-bs-target="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="true">YouTube Integration</a>
								</li>
								<li class="nav-item w-100" role="presentation">
									<a class="nav-link w-100 text-white rounded  font-16" id="tabs-youtube-x" data="YouTube Integration"  href="<?php echo base_url(); ?>video/ylists">Video Editor List</a>
								</li>
								<li class="nav-item w-100" role="presentation">
									<a class="nav-link w-100 text-white rounded mb-sm-3 mb-md-0" id="list-youtube-video" data="Add YouTube Video"  href="<?php echo base_url(); ?>youtube/all_videos">Add YouTube Video</a>
								</li>
								<li class="nav-item w-100" role="presentation">
									<a class="nav-link w-100 text-white rounded font-16" id="tab-add-youtube-video" data="List YouTube Video"  href="<?php echo base_url(); ?>youtube_list">List YouTube Video</a>
								</li>
							</ul>
						</div>
					</div>
					 <div class="col-lg-9">
						 <div class="card bg-transparent px-0">
							 <div class="card-body p-0">
								 <div class="tab-content" id="myTabContent">
								 <div class="tab-pane fade show active " id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-youtube-x">
									 <div class="row row-gap-2">
										 <div class="col-lg-12">  
											 <div class="content-side theme-color comman-tab p-lg-5">
												 <div class="col-12">
                                        				<h4 class="m-0 text-white font-weight-bold " id="swal2-title" style="display: flex;"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="red" class="bi bi-youtube" viewBox="0 0 16 16">
                                        					<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                                        				</svg> &nbsp;YouTube Integration </h4><hr>
                                        				<form action="<?php echo base_url("youtube");?>" method="POST" class="form_ajax_youtube">
                                        					<div class="row form-group mb-4">
                                        						<div class="col-lg-12">
                                        							<div class="text-white mb-2"><span class="text-danger">*</span> Client ID</div>
                                        							<input type="text" class="form-control" placeholder="Enter Client ID Here" value="<?php echo $clientId;?>" name='clientId'>
                                        							<span class="form_error form_error_clientId"></span>
                                        						</div>
                                        					</div>
                                        					<div class="row form-group mb-4">
                                        						<div class="col-lg-12">
                                        							<div class="text-white mb-2"><span class="text-danger">*</span> Client Secret</div>
                                        							<input type="text" class="form-control" placeholder="Enter Client Secret Here" value="<?php echo $clientSecret;?>" name='clientSecret'>
                                        							<span class="form_error form_error_clientSecret"></span>
                                        						</div>
                                        					</div>
                                        					<div class="col-xs-12 mt-3">
                                        						<button class="btn btn-success" type="submit" >Save</button>
                                        					</div>
                                        					
                                        				</form><br>
                                        				<div class="col-xs-12">
                                        					<div>Authorized redirect URI in your app.
                                        						<a href="javascript:" class="blink m-0 font-weight-bold text-primary"><?php echo base_url();?>save-youtube-integration</a>
                                        					</div>
                                        					<div><a class="blink m-0 font-weight-bold text-primary" href="<?php echo site_url('training');?>" class="olink">Learn How</a> To Create YouTube Client ID </div>
                                        				</div>
                                        				
                                        			</div>
											 </div>
										 </div>
									 </div>
								 </div>
							 </div>
						 </div>
					 </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on('submit', '.form_ajax_youtube', function(event){
	    alert('hello')
		event.preventDefault();
		$that = $(this);
		$.ajax({
			type: "POST",
			dataType: 'json',
			contentType: false,
			cache: false,
			processData:false,
			url: $(this).attr('action'),
			data: new FormData(this),
			beforeSend: function(){
				$(".form_error").html("");
				$("#Youtube_btn_Add").html('In Progresss....');
			},
			success: function(response) {
				$("#Youtube_btn_Add").html('Add');
				//alert(response.error);
				if (response.success) {
					showMessage("success","",response.success,"CallBack");
				} else if (response.error){
					showMessage("error","",response.error,"CallBack");
				} else if (response.youtubeerror){
					showFlash(response, $that);
				}
				showFlash(response, $that);
				$('#Modal_youtube').modal('hide');
			},
			error:function(jqXHR, textStatus, errorThrown) {
				//alert('Error in Posting Data');
			}
		});
	});
</script>
