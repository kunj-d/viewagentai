<div class="tab-pane fade <?php echo $active_tab=="youtube"? 'in active show':'' ;?>" id="pills-youtube" role="tabpanel" aria-labelledby="pills-youtube-tab">
    <h6 class="title my-3">Integrate your YouTube Channel in just a few clicks.</h6>
     <?php   
    //  pr($yt_access_token); die('here');
    if(in_array('youtube_automation',$this->session->userdata('features')) ) { ?>


        <div class="tab-content mt-3">
            <form action="<?= base_url('youtube/') ?>" method="post" class="form_ajax_youtube">
                <div class="row form-group mb-3">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                                <div><span class="text-danger">*</span> Client ID</div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-8 col-12">
                                <input type="text" id="client_id" class="form-control" placeholder="Enter Client ID Here" value="<?php echo $yt_access_token->clientId;?>" name='clientId'>
                                <span class="form_error form_error_clientId text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                                <div><span class="text-danger">*</span> Client Secret</div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-8 col-12">
                                <input type="text"  class="form-control" placeholder="Enter Client Secret Here" value="<?php echo $yt_access_token->clientSecret;?>" name='clientSecret'>
                                <span class="form_error form_error_clientSecret text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-lg-2 col-md-3 col-sm-4 col-12">Redirection URL</label>
                    <div class="col-lg-7 col-md-7 col-sm-8 col-12 text-wrap">
                        <div class="mb-2">
                            <a href="javascript:" class="blink m-0 font-weight-bold text-primary"><?php echo base_url();?>save-youtube-integration</a>
                        </div>
                        <!-- <div>Authorized redirect URI in your app.
                            <a href="javascript:" class="blink m-0 font-weight-bold text-primary"><?php echo base_url();?>save-youtube-integration</a>
                        </div> -->
                        <div>
                            
                            Learn How to Get Your YouTube API Key. <a class="blink m-0 font-weight-bold text-primary olink" href="https://console.cloud.google.com/apis/library" target="_blank">Click Here</a><br>
                            
                            <!--<a class="blink m-0 font-weight-bold text-primary olink" href="<?php echo site_url('training');?>">-->
                            <!--    Learn How -->
                            <!--</a>-->
                            <!--To Create YouTube Client ID -->
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 padding0">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"></div>
                        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 d-flex align-items-center gap-2">
                            <!--<button type="submit" class="btn btn-primary">Save API Credentials</button>-->
                            
                            <button type="button" id="saveYoutube" class="btn btn-primary">
                                    Save API Credentials
                                </button>
                            <button  type="button" id ="reset_btn_<?php echo $yt_access_token->clientId;?>" class="btn btn-primary"> Reset </button>
                            <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"> Integration Tutorial </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    

    <?php } else { ?>
            <div class="col-xs-12 padding0 mt20 mt-md50">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 ">
						<div class="col-xs-12 tab-content text-center">
							<div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-12 mt2 xsmt2 mb5 xsmb5">
								<img src="<?php echo $this->config->item("assetsTemplatePath"); ?>images/logo.png" class="img-fluid d-block mx-auto integration-logo">
								<div class="title-line mt20 justify-content-center">Please Upgrade Your Plan To Use This Feature</div>
									<div class="base-btn theme-btn-blue mt20">
										<a href="<?php echo site_url("subscription");?>" class="newstory-btn" style="color:#fff;">Upgrade Now</a>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        <?php } ?>

    
    <div class="modal fade modal-watch-training" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h1 class="modal-title title-line" id="exampleModalCenterTitle">YouTube Integration Process</h1>
                            <p class="desc mb-0">Connect your YouTube channel to publish and optimize videos automatically.</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="video-demo mt-0">
                            <iframe src="https://tube-claw-ai.dotcompal.co/video/embed/laeafqa4jg" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/laeafqa4jg" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                        </div>
                    </div>
                    <div class="modal-footer d-none">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary d-none">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  
    
    
    
<script>
// 	$(document).on('submit', '.form_ajax_youtube', function(event){
// 		event.preventDefault();
// 		$that = $(this);
// 		$.ajax({
// 			type: "POST",
// 			dataType: 'json',
// 			contentType: false,
// 			cache: false,
// 			processData:false,
// 			url: $(this).attr('action'),
// 			data: new FormData(this),
// 			beforeSend: function(){
// 				$(".form_error").html("");
// 				$("#Youtube_btn_Add").html('In Progresss....');
// 			},
// 			success: function(response) {
// 				$("#Youtube_btn_Add").html('Add');
				
				
				
// 				//alert(response.error);
// 				if (response.success) {
// 					showMessage("success","",response.success,"CallBack");
// 				} else if (response.error){
// 					showMessage("error","",response.error,"CallBack");
// 				} else if (response.youtubeerror){
// 					showFlash(response, $that);
// 				}
// 				showFlash(response, $that);
// 				$('#Modal_youtube').modal('hide');
// 			},
// 			error:function(jqXHR, textStatus, errorThrown) {
// 				//alert('Error in Posting Data');
// 			}
// 		});
// 	});



        // $(document).on('submit', '.form_ajax_youtube', function(event) {
        //     event.preventDefault();
        //     var $form = $(this);
        //     var formData = new FormData(this);
        
        //     $.ajax({
        //         type: "POST",
        //         url: $form.attr('action'),
        //         data: formData,
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         // dataType: 'json',
        //         beforeSend: function() {
        //             $(".form_error").html(""); // Clear previous errors
        //             $("#Youtube_btn_Add").html('In Progress....');
        //         },
        //         success: function(response) {
        //             $("#Youtube_btn_Add").html('Save API Credentials');
        
        //             if (response.success) {
        //                 showMessage("success", "", response.success, "CallBack");
        //             } else if (response.error) {
        //                 showMessage("error", "", response.error, "CallBack");
        //             }
        
        //             showFlash(response, $form);
        //                 if (response.redirect) {
        //                 window.location.href = response.redirect;
        //                 return;
        //             }
        //             $('#Modal_youtube').modal('hide');
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log("AJAX error: ", textStatus);
        //         }
        //     });
        // });
        
        $('#saveYoutube').on('click', function() {
        
            var clientId = $('#client_id').val();
            var clientSecret = $('input[name="clientSecret"]').val();
        
            $.ajax({
                type: "POST",
                url: "<?= base_url('youtube/') ?>",
                data: {
                    clientId: clientId,
                    clientSecret: clientSecret
                },
                dataType: 'json',
        
                success: function(response) {
                    console.log(response);
        
                    $('.form_error').html('');
        
                    if (response.youtubeerror) {
        
                        if (response.youtubeerror.clientId) {
                            toastr.error('Client ID is required');
                        }
        
                        if (response.youtubeerror.clientSecret) {
                            toastr.error('Client Secret is required');
                        }
        
                        return;
                    }
        
                    if (response.success) {
                        toastr.success(response.success);
                    }
        
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
        
                error: function(xhr) {
                    console.log("ERROR:", xhr.responseText);
                }
            });
        
        });
        
        
        
        
     document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("exampleModalCenter");
    const iframe = modal.querySelector("iframe");
    const originalSrc = iframe.getAttribute("src");

    function stopVideo() {
        iframe.setAttribute("src", "");
        setTimeout(function () {
            iframe.setAttribute("src", originalSrc);
        }, 100);
    }

    // Cross button
    const closeBtn = modal.querySelector(".btn-close");
    closeBtn.addEventListener("click", stopVideo);

    // Close button (if exists)
    modal.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function (btn) {
        btn.addEventListener("click", stopVideo);
    });

    // Click outside modal (backdrop)
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            stopVideo();
        }
    });

    // ESC key / any Bootstrap modal close
    modal.addEventListener("hide.bs.modal", function () {
        stopVideo();
    });

});

$(document).ready(function() {
    $('[id^="reset_btn_"]').on('click', function() {
        var button = $(this);
        var Id = button.data('id');
        
        var clientId = $('#client_id').val().trim();

        if (clientId === '') {
            Swal.fire({
                icon: 'info',
                title: 'No data to reset',
                text: 'Please enter some credentials before resetting.',
            });
            return;
        }
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This will reset your saved API credentials.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url("youtube-resetapi"); ?>',
                    type: 'POST',
                    data: { id: Id },
                    beforeSend: function() {
                        button.prop('disabled', true).text('Resetting...');
                    },
                   success: function(response) {
                        let res = JSON.parse(response);
                        if (res.status) {
                            Swal.fire('Reset!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Failed!', res.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        // Swal.fire(
                        //     'Failed!',
                        //     'Could not reset credentials. Please try again.',
                        //     'error'
                        // );
                         toastr.error( 'Could not reset credentials. Please try again.');
                    },
                    complete: function() {
                        button.prop('disabled', false).text('Reset');
                    }
                });
            }
        });
    });
});




</script>


