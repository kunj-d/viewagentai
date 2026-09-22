<style>
    .permission-list {
        padding-left: 18px;
        margin-top: 8px;
    }
    
    .permission-list li {
        font-size: 13px;
        color: var(--text-dark);
        margin-bottom: 6px;
        line-height: 1.4;
        list-style-type: disc;
    }
    .policy-links {
        p {
            color: var(--text-dark);
            margin-bottom: 5px;
        }
    
        a {
            color: var(--primary-color);
            text-decoration: none;
            &:hover {
                text-decoration: underline;
            }
        }
    }
</style>
<div class="tab-pane fade <?php echo $active_tab=="facebook"? 'in active show':'' ;?>" id="pills-facebook" role="tabpanel" aria-labelledby="pills-facebook-tab">
    <h6 class="title my-3">Integrate your Facebook Page in just a few clicks.</h6>
     <?php   
        if(in_array('facebook_automation',$this->session->userdata('features')) ) { ?>

        <div class="tab-content mt-3">
            <form action="<?php echo base_url("save-facebook-access-token");?>" method="post" class="form_ajax_facebook">
                
                 <div class="row form-group mb-3">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                                <div><span class="text-danger">*</span> App ID </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-8 col-12">
                                <input type="text" class="form-control" placeholder="Enter App ID Here" value="<?php echo $fb_app_id ?>" name='fb_app_id'>
                                <span class="form_error form_error_fb_app_id"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="row form-group mb-3">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                                <div><span class="text-danger">*</span> App Secret </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-8 col-12">
                                <input type="text" class="form-control" placeholder="Enter App Secret Here" value="<?php echo $fb_client_secret ?>" name='client_secret'>
                                <span class="form_error form_error_client_id"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row form-group mb-3">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-lg-2">
                                <label><span class="text-danger">*</span>Page Access Token</label>
                            </div>
            
                            <div class="col-lg-7">
                                <input type="text" id="fb_access_token" class="form-control" placeholder="Enter Page Access Token Here" name="fb_access_token" value="<?php echo $fb_user_token ?>">
                                <span class="form_error form_error_fb_access_token"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row form-group mb-3">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                                <div><span class="text-danger">*</span>Facebook Page ID </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-8 col-12">
                                <input type="text" class="form-control" placeholder="Enter Facebook Page ID Here" value="<?php echo $fb_page_token ?>" name='fb_page_id'>
                                <span class="form_error form_error_fb_page_id"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!--<div class="form-group row mb-4">-->
                <!--    <label class="col-lg-2 col-md-3 col-sm-4 col-12">Redirection URL</label>-->
                <!--    <div class="col-lg-7 col-md-7 col-sm-8 col-12 text-wrap">-->
                <!--        <div class="mb-2">-->
                <!--            <a href="javascript:" class="blink m-0 font-weight-bold text-primary"><?php echo base_url();?>save-youtube-integration</a>-->
                <!--        </div>-->
                <!--         <div>Authorized redirect URI in your app.-->
                <!--            <a href="javascript:" class="blink m-0 font-weight-bold text-primary"><?php echo base_url();?>save-youtube-integration</a>-->
                <!--        </div>-->
                <!--        <div>-->
                <!--            Please Integrate your Instagram Account First.. <a class="blink m-0 font-weight-bold text-primary olink" href="<?php echo site_url('training');?>">Click Here</a><br> To Learn How To  Create Instagram Access token-->
                            
                <!--            <a class="blink m-0 font-weight-bold text-primary olink" href="<?php echo site_url('training');?>">-->
                <!--                Learn How -->
                <!--            </a>-->
                <!--            To Create YouTube Client ID -->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-xs-12 padding0">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"></div>
                        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 d-flex align-items-center gap-2">
                            <button type="submit" id="facebook_btn_save" class="btn btn-primary">Save Access token</button>
                            <button type="button" id="reset_btn_facebook_<?php echo $fb_access_token ?>" class="btn btn-primary"> Reset </button>
                            <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#fbModalCenter"> Integration Tutorial </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="permission-wrap mt-3">
                <h6>Required Facebook Permission</h6>
                <ul class="permission-list">
                    <li>Business Management</li>
                    <li>Read Insights</li>
                    <li>Publish Video</li>
                    <li>Pages Manage Metadata</li>
                    <li>Pages Read User Content</li>
                    <li>Pages Manage Posts</li>
                    <li>Pages Manage Engagement</li>
                </ul>
            </div>
            
            <div class="policy-links mt-3">
                <p>
                    <strong>Privacy Policy:</strong> 
                    <a href="javascript:void(0);">
                        <?php echo base_url();?>privacy
                    </a>
                </p>
                <p>
                    <strong>Terms & Conditions:</strong> 
                    <a href="javascript:void(0);">
                        <?php echo base_url();?>terms
                    </a>
                </p>
            </div>
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

        <div class="modal fade modal-watch-training" id="fbModalCenter" tabindex="-1" aria-labelledby="fbModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h1 class="modal-title title-line" id="fbModalCenterTitle">Facebook Integration Process</h1>
                            <p class="desc mb-0">Connect your Facebook account to automate posting, comments, and engagement.</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="video-demo mt-0">
                            <iframe src="https://tube-claw-ai.dotcompal.co/video/embed/ubkj7jdvkk" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/ubkj7jdvkk" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
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
    $(document).ready(function() {
        $('[id^="reset_btn_facebook_"]').on('click', function() {
            var button = $(this);
            var Id = button.data('id');
            
            var fbaccessToken = $('#fb_access_token').val().trim();

            if (fbaccessToken === '') {
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
                        url: '<?= site_url("reset-facebook-api"); ?>',
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

document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("fbModalCenter");
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





       $(document).on('submit', '.form_ajax_facebook', function(event) {
            event.preventDefault();
            var $form = $(this);
            var formData = new FormData(this);
        
            $.ajax({
                type: "POST",
                url: $form.attr('action'),
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
        
                beforeSend: function() {
                    $(".form_error").html("");
                    $("#facebook_btn_save").html('In Progress...');
                },
        
                success: function(response) {
                    console.log(response)
                    $("#facebook_btn_save").html('Save Access token');
        
                    // Show input error under fields
                    if (!response.status && response.error_field) {
                        $(".form_error_" + response.error_field).html(response.message);
                        return;
                    }
        
                    if (response.status) {
                       toastr.success(response.message);
                    //   setTimeout(function() {
                    //         location.reload();
                    //     }, 1000);
                    } else {
                        toastr.error(response.message);
                    }
        
                },
        
                error: function(e) {
                    console.log("AJAX error:", e);
                }
            });
        });


        
        function showFlash(response, $form) {
            if (response.youtubeerror) {
                if (response.youtubeerror.accessToken) {
                    $form.find('.form_error_fb_access_token').html(response.youtubeerror.accessToken);
                }
                if (response.youtubeerror.clientSecret) {
                    $form.find('.form_error_fb_page_id').html(response.youtubeerror.clientSecret);
                }
            }
        }


</script>


