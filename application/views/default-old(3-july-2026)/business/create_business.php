
<!-- Container Start -->
<div class="container-wrapper container-open">
    <title><?php echo $this->config->item('productName') ?> | Create WorkSpace</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" style=" min-height: calc(91.5vh);">
        <div class="row">
            <div class="col-12">
                <h1 class="title-line">Create WorkSpace</h1>
                <!-- <p class="container-page-subtitle mt10">Create Your Workspace Here.</p> -->
            </div>

        </div>
        <div class="row mt20 px-3">
            <div class="col-12 wrapper-box">
                 <form method="post" action="" enctype="multipart/form-data" id="business_form">
                    <input type="hidden" name="business_logo" id="business_logo">
                    <div class="row  justify-content-center">
                        <div class=" col-lg-8 col-md-10 field-design">
                            <!-- <form class="row" action="https://app.writerarc.com/save-user-profile">-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <input type="hidden" name="profile_image" id="profile_image" value="">
                                    <div class="profile-img profile-text">
                                        <img src="<?php echo $this->config->item('assetsPath')?>uploads/default_images/default_business_logo.png" alt="workspace Img" class="img-fluid mx-auto d-block" name="business_logo" id="output">
                                        <!-- Edit Profile Picture -->
                                        <label for="formFiles" class="profile-text d-none"><i class="icon-list-edit"></i></label>
                                        <input class="form-control d-none" type="file" id="formFiles" name="business_logo" placeholder="Edit Profile Picture" onchange="loadFile(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt20 justify-content-center">

                                <!--<div class="col-md-9">

                                    <label for="firstname" class="form-label">Workspace Name <span class="required">*</span></label>
                                    <input type="text" class="form-control search1" placeholder="Enter Your Workspace Name" name="business_name" >
                                     <span class="form_error required mt5"><?php echo form_error('business_name'); ?></span>
                                </div>-->
                                <div class="col-md-12 mt20 mt-md20">
                                    <label for="firstname" class="form-label">Workspace Name 
                                        <span 
											data-bs-toggle="tooltip" 
											data-bs-placement="top" 
											data-bs-custom-class="custom-tooltip" 
											data-bs-title="Name your workspace to organize and access your projects easily."
											data-bs-original-title="Name your workspace to organize and access your projects easily."
											title=""> 
											<i class="fa-solid fa-circle-info"></i>
										</span>
                                    </label>
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-lg-12 col-xs-12 md14 sm14 xs14 mt0 xsmt5px xspadding0">
                                        <input type="text" placeholder="Enter Your Workspace Name (Max : 25 Characters)" name="domain" class="form-control search1" style="background: transparent;" maxlength="25">
                                        <span class="form_error mt5 text-danger mt-2 d-block"><?php echo form_error('domain'); ?></span>
                                    </div>
                                    <!-- <div class="col-lg-3 col-md-2 col-sm-3 col-xs-12 padding0 mt0 xsmt3px"><p>.<? //= $this->config->item('productSite'); ?></p></div> -->
                                    </div>
                                </div>
                                <!--<div class="col-md-9 mt20 mt-md20">-->
                                <!--    <div class="row align-items-center">-->
                                <!--        <div class="col-lg-2 col-sm-3 col-12">-->
                                <!--            <span class="f-14 f-md-16 white-clr">Busines Logo</span>-->
                                <!--            <br>-->
                                <!--            <span class="f-10 f-md-10 white-clr">(Size - 160 X 40)</span>-->
                                <!--        </div>-->
                                <!--        <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12">-->
                                <!--            <div class="business-logobox">-->
                                <!--                <div class="vendorimgsec" style="display:none;">-->
                                <!--                    <img src="" class="img-responsive center-block" >-->
                                <!--                </div>-->
                                <!--                <div class="md12 sm12 xs12 text-center vendortextsec grey w700">No-->
                                <!--                    Image Found</div>-->

                                <!--            </div>-->
                                <!--            <img src="" class="img-responsive center-block" id="blah" style="width:200px">-->
                                <!--            <span class="form_error form_error_logo">-->
                                <!--                <?php echo !empty($img_error) ? $img_error : form_error('business_logo'); ?>-->
                                <!--            </span>-->
                                <!--        </div>-->
                                <!--        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-left mt10 mt-md10">-->
                                <!--            <label for="formFile" class="white-clr">Upload Logo</label>-->
                                <!--            <input class="form-control d-none" type="file" onchange="loadimg(this)" id="formFile" name="logo" placeholder="Upload Logo" onchange="loadimg(this)">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!-- <div class="col-md-9 mt20">
                                    <label for="firstname" class="form-label">Address</label>
                                    <input type="text" class="form-control search1" name="address" value="<?= $business['address'] ?>" placeholder="Enter your Address Here">
                                    <span class="form_error required mt5"><?php echo form_error('address'); ?></span>
                                </div>

                                
                                <div class="col-md-9 mt20 mt-md20">
                                    <label for="firstname" class="form-label">Country</label>
                                    <input type="text" class="form-control search1" placeholder="Enter your Country Here" name="country" value="<?php echo $business['country']; ?>">
                                    <span class="form_error required mt5"><?php echo form_error('country'); ?></span>
                                </div> -->

                             
                            </div>
                        </div>
                        <div class="col-12 mt-2 text-center text-md-center">
                            <a href="<?php echo base_url('workspace') ?>" class="btn btn-danger">Cancel</a>
                            <br class="d-block d-md-none"><br class="d-block d-md-none">
                            <a href="javascript:void(0)" class="btn btn-primary mr10" onclick="$('#business_form').submit();">Create</a>
                            <a href="https://support.oppyo.com/support/solutions/1120000061278" target="_blank" class="btn btn-primary"><i class="fa-solid fa-video"></i> Watch Trainings</a>
                        </div>
                        <div class="col-12 mt30 d-none">
                            <a href="https://support.oppyo.com/support/solutions/1120000061278" target="_blank" class="text-dark text-center d-block"
                            style="
                                text-decoration: underline;
                                font-size: 1.1rem;
                                font-weight: 600;
                            "
                            >Click here to Watch the training for how to create your first workspace</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>




    </div>
    <script>
         function loadimg(ele) {
            var profileimage = ele.files[0];
            var profileType = profileimage["type"];
            var profileallowed = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
            if ($.inArray(profileType, profileallowed) < 0) {
                showFlash({
                    "error": {
                        "message": 'The filetype you are attempting to upload is not allowed',
                        "type": "flash"
                    }
                });
            } else {
                document.querySelector('.business-logobox').style.display ="none";
                document.getElementById('blah').src = window.URL.createObjectURL(ele.files[0]);
            }
        }

        function remove_image() {
            document.getElementById('blah').src = "<?= base_url() ?>assets/images/edit-profile.png";
            $("#formFile").val('');
        }
    </script>
    <!-- Page Content End -->
    <script>
        var default_logo = '<?php echo $default_business_logo; ?>';

        function readURL(input) {
            var file = input.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            $('.form_error_logo').html('');
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                $(input).val('');
                //flashNow({'error' : {'message':"Error ! The File type you are attempting to upload is not allowed."}});
                $('.form_error_logo').html('The File type you are attempting to upload is not allowed.');
                $('#previewHolder').attr('src', default_logo);
                return false;
            } else if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewHolder').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }

        }

        function loadimg(ele) {
            var profileimage = ele.files[0];
            var profileType = profileimage["type"];
            var profileallowed = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
            if ($.inArray(profileType, profileallowed) < 0) {
                showFlash({
                    "error": {
                        "message": 'The filetype you are attempting to upload is not allowed',
                        "type": "flash"
                    }
                });
            } else {
                document.querySelector('.business-logobox').style.display ="none";
                document.getElementById('blah').src = window.URL.createObjectURL(ele.files[0]);
            }
        }

        function remove_image() {
            document.getElementById('blah').src = "<?= base_url() ?>assets/images/edit-profile.png";
            $("#formFile").val('');
        }



        function library_callback_action() {
            var logo_input = $('#business_logo').val();
            if (logo_input != '<?= $default_logo; ?>' && logo_input != '') {
                $("#logo_remove_btn").show();
                $(".vendorimgsec").show();
                $(".vendortextsec").hide();
            }
        }
        $(".removeimg").click(function() {
            $(".vendorimgsec").hide();
            $(".vendortextsec").show();
            $("#logo_input").val('<?= $default_logo; ?>');
            $("#logo_remove_btn").hide();
        });
    </script>