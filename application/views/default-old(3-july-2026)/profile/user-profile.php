<style>
    .profile-img{
        position: relative;
    }
    .profile-img {

    }
</style>
<!-- Container Start -->
 <div class="container-wrapper container-open"><title><?php echo $this->config->item('productName') ?> | My Profile</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding"  style=" min-height: calc(91.5vh);">
            <div class="row">
                <div class="col-12">
                    <div class="col page-title">My Profile</div>
                </div>
                
            </div>
            <div class="row mt-2 mt-md-3">
                <div class="col-12">
                    <div class="wrapper-box">
                    
                     <form  action="<?= $action; ?>" method="post"  enctype="multipart/form-data">

                    <div class="row">
                       
                        <div class="col-md-3 d-flex align-items-center flex-column">


                          <input type="hidden" name="profile_image" id="profile_image" value="<?php echo ($user_data['profile_image'] == "" || $user_data['profile_image'] == 'default_profile.png') ? $assetsPath . 'default/images/default_profile.png' : $this->config->item('assetsBasePath') . $user_data['profile_image'] ?>">



                            <div class="profile-img profile-text">
                                
                                <img src="<?php echo ($user_data['profile_image'] == "" || $user_data['profile_image'] == 'default_profile.png') ? $assetsPath . 'default/images/default_profile.png' : $this->config->item('bucket_url') . $user_data['profile_image'] ?>" alt="Profile Img" class="img-fluid mx-auto d-block" id="output">
                                <!--<img src="<?php echo ($user_data['profile_image'] == "" || $user_data['profile_image'] == 'default_profile.png') ? $assetsPath . 'default/images/default_profile.png' : $this->config->item('assetsBasePath') . $user_data['profile_image'] ?>" alt="Profile Img" class="img-fluid mx-auto d-block" id="output">-->
                                
                                <!-- Edit Profile Picture -->
                                <label for="formFiles" class="profile-text "><i class="icon-list-edit"></i></label>
                                <div class="upload-icon d-none">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    <input class="form-control " type="file" id="formFiles" name="avatar_icon" placeholder="Edit Profile Picture" onchange="loadFile(event)">
                                </div>
                            
                            </div>
                            <!--<div class="mt20 text-center">-->
                                <!-- Edit Profile Picture -->
                            <!--    <label for="formFileButton" class="profile-text">Edit Profile Picture</label>-->
                            <!--    <input class="form-control d-none" type="file" id="formFileButton" name="avatar_btn" placeholder="Edit Profile Picture" onchange="loadFile(event)">-->
                            <!--</div>-->
                        </div>
                        <div class=" col-md-9 field-design">
                      <!-- <form class="row" action="https://app.writerarc.com/save-user-profile">-->
                            <div class="row">
                                <div class="col-12 mb20"> <div class="title-line1">Personal Details</div></div>
                                <div class="col-md-6">
                                   
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control search1" name="firstname" id="firstname" placeholder="Enter Your First Name" value="<?= $user_data['firstname']; ?>">
                                     <span class="form_error  mt5"><?php echo form_error('firstname'); ?></span>
                                </div>
                                <div class="col-md-6 mt20 mt-md0">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control search1" id="lastname" name="lastname" placeholder="Enter Your Last Name" value="<?= $user_data['lastname']; ?>">
                                    <span class="form_error  mt5"><?php echo form_error('lastname'); ?></span>
                                </div>
                                <div class="col-md-6 mt20">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control search1" id="email disabledInput" name="email" placeholder="Enter Your Email" value="<?= $user_data['email']; ?>" readonly style="background:transparent;">
                                </div>
                                <div class="col-md-6 mt20">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control search1" id="contact" name="phone" placeholder="Enter Your Contact No." value="<?= $user_data['phone']?>">
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="gap:20px;">
                                  <div class="mt20 mt-md30 mb20">
                                    <span class="">Change Password </span>
                                  </div>
                                  <div class="mt20 mt-md30 mb20 mr-20">
                                    <label class="switch">
                                        <input type="checkbox" id="change_password" value="0">
                                        <span class="slider round"></span>
                                    </label>
                                  </div>
                            </div>
                            <div class="row">
                                  <input type="hidden" name="change_password" value="0">
                                <span class="cpsection"  style="display:none">
                                <div class="col-12 mt20 mt-md10 mb20"> <div class="title-line1">Change Password</div></div>
                                <div class="col-md-6">
                                    <label for="current-pwd" class="form-label">Current Password</label>
                                    <input type="password" class="form-control search1" id="current-pwd" name="current_password" placeholder="Enter Current Password">
                                      <span class="form_error  mt5"><?php echo form_error('current_password'); ?></span>
                                </div>
                                <div class="clear">
                                </div>   
                                <div class="col-md-6 mt20">
                                    <label for="new-pwd" class="form-label">New Password</label>
                                    <input type="password" class="form-control search1" id="new-pwd" name="new_password" placeholder="Enter New Password">
                                       <span class="form_error  mt5"><?php echo form_error('new_password'); ?></span>
                                </div>
                                <div class="col-md-6 mt20">
                                    <label for="confirm-pwd" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control search1" id="confirm-pwd" name="confirm_password" placeholder="Enter Confirm Password">
                                     <span class="form_error  mt5"><?php echo form_error('confirm_password'); ?></span>
                                </div>
                                </span>
                                
                                </div>
                            
                        </div>
                        <div class="col-12 mt30 mt-md30 text-center text-md-end">
                           
                             <a href="<?= $cancel; ?>" class="btn btn-danger mr10">Discard</a> 
                            <br class="d-block d-md-none"><br class="d-block d-md-none">
                            <button type="submit" class="btn btn-primary" value="upload">Save Changes</button>
                        </div>
                        
                    </div>
                    </form>

                    </div>

                </div>
      
                
            </div>
            
            
                
        </div>

     
    <script>
        var loadFile = function(event) {
      
          var output = document.getElementById('output');
          output.src = URL.createObjectURL(event.target.files[0]);
          alert( output.src);
          output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
          }
        };
        
        function onClickHandler(){
          var chk=document.getElementById("box").value;
      alert(chk);
      }
      var current_password = '<?php echo !empty(form_error('current_password')) ?>';
      var new_password = '<?php echo !empty(form_error('new_password')) ?>';
      var confirm_password = '<?php echo !empty(form_error('confirm_password')) ?>';
      
      if(current_password != '' || new_password != '' || confirm_password != '' ){
          $('#change_password').trigger('click');
        checkButton();
      }
      
       $('#change_password').on('click', function(e) {
                  //Show/Hide div with ON-OFF button
                //   $(".cpsection").toggle();
                 checkButton();
      
              });
              function checkButton(){
                   var change_password = $('#change_password').val()
                  if (change_password == '0') {
                      $(".cpsection").css('display','block');
                      change_password = '1';
                  } else if (change_password == '1') {
                       $(".cpsection").css('display','none');
                      var change_password = '0';
                  }
                  $('#change_password').val(change_password);
                  $('input[name=change_password]').val(change_password);
              }
      </script>  



