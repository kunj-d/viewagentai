<!-- Container Start -->
<div class="container-wrapper container-open">
    <title><?php echo $this->config->item('productName') ?> | Workspace Settings</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" style=" min-height: calc(91.5vh);">
        <div class="row">
            <div class="col-12">
                <h1 class="title-line">Workspace Settings</h1>
                <!-- <p class="container-page-subtitle mt10">View, edit & manage your WorkSpace here.</p>  -->
            </div>

        </div>
        <div class="row px-3">
              <div class="col-md-8 col-sm-7 col-xs-12">
        
               
                <!--<p class="md14 f-14 f-md-14 white-clr"><span class="required mt5">*</span>All fields are mandaory</p>-->
            </div>
            <div class="col-12 wrapper-box">
                <form action="<?php echo base_url('save_workspace-settings'); ?>" method="post" class="form_ajax" id="business_setting_form">
                    <input type="hidden" name="logo" value="<?= $business['logo']; ?>" id="logo_input">
                    <input type="hidden" name="fevicon" value="<?= $business['fevicon']; ?>" id="fevicon_input">
                    <input type="hidden" name="business_id" value="<?= $business_id; ?>" id="fevicon_input">
                    <div class="row flex-column justify-content-center align-items-center">

                        <div class="col-md-3 d-flex align-items-center flex-column">
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" name="profile_image" id="profile_image" value="<?php echo ($business['logo'] == 'default_business_logo.png') ? $assetsPath . 'uploads/default_images/default_business_logo.png' : $this->config->item('bucket_url') . $business['logo'] ?>">
                                    <div class="profile-img profile-text">

                                    <img src="<?php echo ($business['logo'] == 'default_business_logo.png') ? $assetsPath . 'uploads/default_images/default_business_logo.png' : $this->config->item('bucket_url') . $business['logo'] ?>" alt="Profile Img" class="img-fluid mx-auto d-block" id="output">
                                
                                    <!-- Edit Profile Picture -->
                                    <label for="formFiles" class="profile-text d-none"><i class="icon-list-edit"></i></label>
                                    <input class="form-control d-none" type="file" id="formFiles" name="logo" placeholder="Edit Profile Picture" onchange="loadFile(event)">
                                 </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-12 field-design">
                            <div class="row mt20">

                                <div class="col-md-12">

                                    <label for="firstname" class="form-label">Change Workspace Name <span class="required">*</span></label>
                                    <input type="text" class="form-control search1 w-100" placeholder="Update  Your Workspace Name" name="title" value="<?= $business['title'] ?>">
                                    <span class="form_error required mt5"><?php echo form_error('title'); ?></span>
                                </div>
                                <!-- <div class="col-md-12 mt20 mt-md20">
                                    <label for="firstname" class="form-label">Subdomain</label>
                                    <div class="row align-items-center">
                                        <div class="col-lg-9 col-md-7 col-sm-6 col-xs-12 md14 sm14 xs14 mt0 xsmt5px xspadding0">
                                        <input type="text" placeholder="Enter your Subdomain Name" class="form-control search1 w-100" disabled value="<?= $business['domain'] ?>" style="background: transparent;">
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-3 col-xs-12 padding0 mt0 xsmt3px"><p style="color:#fff; margin-bottom:0px">.<?= $this->config->item('productSite'); ?></p></div>
                                    </div>
                                </div> -->
                                <!--<div class="col-md-12 mt20 mt-md20">-->
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
                                <!-- <div class="col-md-12 mt20">
                                    <label for="firstname" class="form-label">Address</label>
                                    <input type="text" class="form-control search1 w-100" name="address" value="<?= $business['address'] ?>" placeholder="Enter your Address Here">
                                    <span class="form_error required mt5"><?php echo form_error('address'); ?></span>
                                </div> -->

                                <!--<div class="col-md-12 mt20 mt-md20">-->
                                <!--    <label for="firstname" class="form-label">City</label>-->
                                <!--    <input type="text" class="form-control search1 w-100" name="city" value="<?php echo $business['city']; ?>" placeholder="Enter your City Here">-->
                                <!--    <span class="form_error required mt5"><?php echo form_error('city'); ?></span>-->
                                <!--</div>-->
                               <!--  <div class="col-md-12 mt20 mt-md20">
                                    <label for="firstname" class="form-label">Country</label>
                                    <input type="text" class="form-control search1 w-100" placeholder="Enter your Country Here" name="country" value="<?php echo $business['country']; ?>">
                                    <span class="form_error required mt5"><?php echo form_error('country'); ?></span>
                                </div> -->

                            </div>
                            
                        </div>
                        <div class="row mt10 mt-md10">
                        <div class="col-12 col-md-12  mt30 mt-md30 text-center text-md-center">
                            <a href="<?php echo base_url('workspace') ?>" class="btn btn-danger cancelbtn buttongap">Cancel</a>
                            <br class="d-block d-md-none"><br class="d-block d-md-none">
                            <a href="javascript:" class="btn btn-primary" onclick="$('#business_setting_form').submit();">Save Changes</a>
                        </div>
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