 <!-- Container Start -->

 <div class="container-wrapper container-open">

  <title><?php echo $this->config->item('productName') ?> | White Label</title>

 <style>

 .whitelabelimg{
   height:10vw;
   width:10vw;
 }

 /* .field-design .form-control {

     display: block;

     height: 54px;

     padding: 17px 20px 15px 20px;

     justify-content: center;

     align-items: flex-start;

     gap: 282px;

     flex-shrink: 0;

     border-radius: 10px;

     border: 2px solid #ddd !important;

     background: var(--theme-bg);

     backdrop-filter: blur(15px);

     color: #fff;

 } */

 .border-hr{

    border-bottom: 1px solid var(--theme-br3);

    padding-bottom: 10px;

 }

 /* .field-design .form-control:hover{

     height: 40px;

     padding: 17px 20px 15px 20px;

 } */

 /* .field-design .form-control, .field-design .form-control:hover, .field-design .form-control:focus {

     height:40px;

     box-shadow: none;

     border: 1px solid var(--secondary-color2);

     border-radius: 6px;

     color: var(--white-color);

       padding:10px;

     outline: none;

     font-size: 0.875rem;

     line-height: 1.0625rem;

     font-weight: 400;

 } */

 .white-wrapper{

  padding: 30px;

  border-radius: 20px;

  color: #fff

 }

 .form-control.text-dark{

    color: #000!important;

    

}

.form-control::file-selector-button{

  margin: 0 10px 0 0 !important;

}

.custom-upload-2 .custom-file-upload {

    border: 2px dashed var(--theme-br);

}

.custom-upload-2{

    margin: 0!important;

}
.file-select-control::file-selector-button {

    background: transparent !important;

    border: 1px solid var(--theme-color2);

    border-radius: 5px;

    color: var(--grey-color);

    padding: 5px 21px;



}

.file-select-control {

    color: var(--grey-color);

}


.custom-file-upload input {

    opacity: 0;

    position: absolute;

    width: 100%;

    height: 100%;

    z-index: 10;

    top: 0;

    left: 0;

    margin: 0 !important;

}

.custom-upload-2 .custom-file-upload {

    border: 2px dashed var(--theme-br);

}

.custom-upload-2 {

    margin: 0 !important;

}

.custom-file-upload {

    width: 100%;

    border-radius: 10px;

    display: flex !important;

    flex-direction: column;

    row-gap: 7px;

    position: relative;

    align-items: center;

    justify-content: center;

    background: var(--theme-bg);

    padding: 30px 50px;

    color: var(--white-color);

    font-weight: 600;

}



.custom-file-upload i {

    font-size: 60px;

    color: #8A8A8A;

    margin-bottom: 20px;

}

.output-div img{

    max-height: 150px;

    object-fit: contain;

    border-radius: 10px;

}

.form-book-wrapper{

    position: relative;

}

.form-book-wrapper::before{

   /*  content: '';

    position: absolute;

    top: 0;

    left: 50%;

    transform: translateX(-50%);

    width: .1px;

    height: 100%;

    background: var(--theme-br);

    pointer-events: none; */

}

@media (max-width: 1024px) {
    .form-book-wrapper::before{
        display: none;
    }
    .form-book-wrapper{
        padding: 20px 0;
    }
}

.video-body{

    width: 100%;

    min-height: 316px;

    position: relative;

    background: var(--theme-bg);

}

.extra-btns{

    padding: 20px;

    border: 1px dashed var(--theme-br3);

    border-radius: 5px;

}

 </style>

 

 <style>

 [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {

   display: none !important;

 }

 .checkbox-wrapper-54 input[type="checkbox"] {
    visibility: hidden;
    display: none;
  }

  .checkbox-wrapper-54 *,
  .checkbox-wrapper-54 ::after,
  .checkbox-wrapper-54 ::before {
    box-sizing: border-box;
  }

  /* The switch - the box around the slidercheck */
  .checkbox-wrapper-54 .switch {
    --width-of-switch: 3.5em;
    --height-of-switch: 2em;
    /* size of sliding icon -- sun and moon */
    --size-of-icon: 1.4em;
    /* it is like a inline-padding of switch */
    --slidercheck-offset: 0.3em;
    position: relative;
    width: var(--width-of-switch);
    height: var(--height-of-switch);
    display: inline-block;
  }

  /* The slidercheck */
  .checkbox-wrapper-54 .slidercheck {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: transparent;
    border: 1px solid var(--theme-br);
    transition: .4s;
    border-radius: 30px;
  }

  .checkbox-wrapper-54 .slidercheck:before {
    position: absolute;
    content: "";
    height: var(--size-of-icon,1.4em);
    width: var(--size-of-icon,1.4em);
    border-radius: 20px;
    left: var(--slidercheck-offset,0.3em);
    top: 50%;
    transform: translateY(-50%);
    background: linear-gradient(40deg,#ff0080,#ff8c00 70%);
    ;
   transition: .4s;
  }

  .checkbox-wrapper-54 input:checked + .slidercheck {
    background-color: #303136;
  }

  .checkbox-wrapper-54 input:checked + .slidercheck:before {
    left: calc(100% - (var(--size-of-icon,1.4em) + var(--slidercheck-offset,0.3em)));
    background: #303136;
    /* change the value of second inset in box-shadow to change the angle and direction of the moon  */
    box-shadow: inset -3px -2px 5px -2px #8983f7, inset -10px -4px 0 0 #a3dafb;
  }
 </style>

 <?php 
 
//  print_r($data[0]);
 ?>

 <!-- Main Container Start -->

 <div class="container-fluid container-padding mt20 mt-md50" >
 <form class="form_ajax field-design" action="" enctype="multipart/form-data"> 

    <div class="row align-items-center">

         <div class="col-md-6 title-line">

              WhiteLabel

         </div>

         <div class="text-end col-md-6">

             <button type="button" id="btn_delete" cat_id="<?php echo $data[0]->userid; ?>" class="btn btn-outline">Reset</button>

             <button type="submit" class="btn btn-primary">Save Changes</button>

         </div>

     </div>

     <div class="mt-2 mt-md-3 form-book-wrapper white-wrapper text-dark" style="background-color: var(--theme-bg2) ">

         <div class="row justify-content-center">

                 <div class="row">

                     <div class="col-md-6 pb2">

                         <div class="row mb-4 m-0">

                            <!-- <div class="col-12">
                                <label class="form-label border-hr d-block" style="font-size: 18px;">
                                    White label Domain
                                    <i 
                                        class="fa-solid fa-circle-info ms-2 info-tooltip"
                                        style="font-size: 14px;"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        data-bs-title="Enter your custom domain to run the product under your own brand."
                                    >
                                    </i>
                                </label>
                                <div class="d-flex align-items-center gap-2 mt-3 mb-4">
                                    <div class="text-nowrap">Enter Domain<span class="red">*</span></div>
                                    <input style="width: 78%;" type="text" class="form-control" name="domain_whitelabel" id="domain_whitelabel" aria-describedby="emailHelp" placeholder="Enter whitelabel domain here" value="<?php echo $whitelabel_domain; ?>">
                                    <span class="form_error_domain form_error"></span>
                                </div>
                            </div> -->

                             <div class="col-md-12">

                                 <div class="mb20">

                                     <label  class="form-label border-hr d-block" style="font-size: 18px;">
                                        Dashboard Logo
                                        <!-- <i class="fa-solid text-gray fa-circle-play" data-bs-toggle="modal" data-bs-target="#video1modall"></i> -->
                                        <i 
                                            class="fa-solid fa-circle-info ms-2 info-tooltip"
                                            style="font-size: 14px;"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Upload a custom logo to personalize the product branding."
                                        >
                                        </i>
                                    </label>

                                     <div style="font-weight:400" class="mb20">

                                        <!-- <p class="mb-2">* Logo size must be (188X88). <br> Want to resize your logo, <a href="https://imageresizer.com/" target="_blank" class="text-dark w600" style="text-decoration: underline;">Click Here!</a></p> -->
                                        <p class="mb-2">* Logo size must be (100X20). <br> Want to resize your logo, <a href="https://imageresizer.com/" target="_blank" class="text-dark w600" style="text-decoration: underline;">Click Here!</a></p>

                                        <!-- <p class="mb-0">* Only upload jpg, jpeg, png file.</p> -->

                                     </div>

                                     <div class="custom-upload-2 mb-3 bg-transparent p-0">

                                        <label id="fashionGenInitFileLabel" class="w-100">

                                            <div class="form-group custom-file-upload">

                                                <i class="fa-solid fa-file-arrow-up"></i>

                                                <div class="w600">Choose File <span class="w400 theme-text-color"> or drag them here </span>

                                                <span class="text-dark d-block w400 text-center">Supports: jpg, jpeg, png file</span>

                                            </div>                                                    

                                                <a href="javascript:void(0)" class="">

                                                    <input onchange="loadFile(event)" type="file" class="form-control mt-3" name="logo" id="logo" accept=".png,.jpg">

                                                    <input type="hidden" name="file_hidden"  value="<?php echo $data[0]->logo; ?>"/>

                                                </a>

                                                <!-- <p class="mb-0 text-dark d-block w400 text-center w400">(You Can upload Maximum 5 PDFs)</p> -->

                                            </div>

                                        </label>

                                    </div>

                                    

                                     <span class="form_error_email form_error"></span>

                                 </div>

                                 <div class="mb20 col-12 col-md-6 output-div">

                                     <img id="output" class="img-fluid d-block" src="<?php echo  !empty($data[0]->logo) ? $assetsBasePath.$data[0]->logo : $this->config->item('assetsBasePath').'assets/images/db-logo.png'; ?>">

                                 </div>    

                             </div>

                             <!-- <div class="col-md-6">

                                  <video autoplay muted loop class="radius10 w-100">

                                    <source src="../../../../app/assets/images/whitelable-guide.mp4" type="video/mp4">

                                    Your browser does not support the video tag.

                                </video>

                             </div> -->

                         </div>
                        <div class="row d-none">
                             <label class="form-label border-hr d-block" style="font-size: 18px;">
                                Theme Style
                                <i 
                                    class="fa-solid fa-circle-info ms-2 info-tooltip"
                                    style="font-size: 14px;"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-custom-class="custom-tooltip"
                                    data-bs-title="Switch between light and dark mode to customize your product’s appearance."
                                >
                                </i>
                             </label>
                             <div class="col-md-12 d-flex align-items-center gap-3">
                                <label class="w500 mb-0">Theme Style <span class="w600">Light / Dark : </span> </label>    
                                <div class="checkbox-wrapper-54">
                                  <label class="switch">
                                    <input type="checkbox" id="darktheme"  value="<?php echo $data[0]->darktheme; ?>" <?php echo $data[0]->theme_style == 'dark' ?" checked='checked'":""; ?> onchange="isthemeDark()">
                                    <span class="slidercheck"></span>
                                  </label>
                                </div>    
                             </div>
                             <!-- <div class=" mt-4 col-md-12 ">
                                <div class="d-flex gap-3 align-items-center">
                                     <h6 class="w500 mb-0">Theme Primary Color : </h6>    
                                     <div class="checkbox-wrapper-34">
                                      <input class='tgl tgl-ios' id='theme_color' type='checkbox' <?php echo $data[0]->theme_color != 'default' && $data[0]->theme_color != '' ?" checked='checked'":""; ?> name="theme_color">
                                      <label class='tgl-btn' for='theme_color'></label>
                                    </div>
                                </div>
                                 <div class="customThemeColor mt-3 col-md-12" style="display: <?php echo $data[0]->theme_color == 'default' ? 'none' : ''; ?>">
                                     <div class="d-flex gap-3 align-items-center">
                                          <h6 class="w500 mb-0">Choose Custom Color : </h6>
                                         <input type="color" name="primarycolor" id="primarycolor" class="form-control w-50" value="<?php echo $data[0]->theme_color; ?>" autocomplete="off" >
                                     </div>
                                 </div>
                             </div> -->
                         </div> 
                         

                     </div>
                <?php /*
                     <div class="col-md-6 ">

                         <div class="row m-0">

                             <div class="col-md-12">

                                 <div class="mb20">

                                     <label class="form-label border-hr d-block" style="font-size: 18px;">Copilot Footer Branding <i class="fa-solid text-gray fa-circle-play" data-bs-toggle="modal" data-bs-target="#video2modall"></i></label>

                                     <div style=" font-weight:400" class="mb20">

                                        <p class="mb-2">* Logo size must be (83X39). <br> Want to resize your logo, <a href="https://imageresizer.com/" target="_blank" class="text-dark w600" style="text-decoration: underline;">Click Here!</a></p>
                                        <!-- <p class="mb-0">* Only upload jpg, jpeg, png file.</p> -->
                                     </div>
                                    <div class="custom-upload-2 mb-3 bg-transparent p-0">

                                        <label id="fashionGenInitFileLabel" class="w-100">

                                            <div class="form-group custom-file-upload">

                                                <i class="fa-solid fa-file-arrow-up"></i>

                                                <div class="w600">Choose File 

                                                   <span class="w400 theme-text-color"> or drag them here </span>

                                                   <span class="text-dark d-block w400 text-center">Supports: jpg, jpeg, png file</span>

                                                </div>                                                    

                                                <a href="javascript:void(0)" class="">

                                                     <input onchange="chatbotFooterBrand(event)" type="file" class="form-control mt-3" name="chatbot_footer_branding" id="chatbot_footer_branding" accept=".png,.jpg">

                                                    <input type="hidden" name="file_hidden"  value="<?php echo $data[0]->logo; ?>"/>

                                                </a>

                                                <!-- <p class="mb-0 text-dark d-block w400 text-center w400">(You Can upload Maximum 5 PDFs)</p> -->

                                            </div>

                                        </label>

                                    </div>


                                    <div class="d-flex align-items-center gap-4 flex-column my-4">

                                    

                                        <div class="clearfix"><p class="mb-0">OR</p></div>



                                        <div class="checkbox-wrapper-4 clearfix">

                                            <input class="inp-cbx ng-pristine ng-untouched ng-valid" id="checkCustomLabel" value="<?php echo $data[0]->chatbot_footer_is_text_labeling==1? 1:0?>" type="checkbox" <?php echo $data[0]->chatbot_footer_is_text_labeling==1?" checked='checked'":""; ?> onchange="isStyleManually()"  autocomplete="off">

                                            <label class="cbx" for="checkCustomLabel" onclick="isStyleManually()">

                                                <span>

                                                    <svg width="12px" height="10px">

                                                        <use xlink:href="#check-4"></use>

                                                    </svg>

                                                </span>

                                                <span>Add Textual Footer Whitelabel</span>

                                            </label>

                                            <svg class="inline-svg">

                                                <symbol id="check-4" viewBox="0 0 12 10">

                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>

                                                </symbol>

                                            </svg>

                                        </div> 

                                        </div>
                                        <div class="row-gap-2 mb-3 extra-btns row" id="customeLabel" style="display: none;">

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label for="">Input Text</label>

                                                    <input type="text" name="text" id="text" class="form-control" placeholder="Enter Your Text" value="<?php echo $data[0]->text; ?>">

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label for="">Text Color</label>

                                                    <input type="color"  name="fontcolor" id="fontcolor"  class="form-control"  value="<?php echo $data[0]->fontcolor; ?>">

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label for="">Text Background</label>

                                                    <input type="color"  name="boxcolor" id="boxcolor"  class="form-control"   value="<?php echo $data[0]->boxcolor; ?>">

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label for="">Font Size</label>

                                                    <input type="number"   name="fontsize" id="fontsize"   class="form-control" min="0" max="100" placeholder="Size" value="<?php echo $data[0]->fontsize; ?>">

                                                </div>

                                            </div>

                                            </div>
                                    <hr class="my-3">
                                    <div class="mt20">

                                        <label for="chatbot_footer_branding_redirect_url">Add Link to Footer</label>

                                        <input type="url" name="chatbot_footer_branding_redirect_url" id="chatbot_footer_branding_redirect_url" placeholder="https://www.instaengineai.com/login" class="form-control" value="<?php echo $data[0]->chatbot_footer_branding_redirect_url; ?>">

                                    </div>



                                     <span class="form_error_email form_error"></span>

                                 </div>

                                 <div class="mb20 col-12 col-md-6 output-div">

                                     <img id="chatbot_footer_brand_show" class="img-fluid d-block" src="<?php echo  !empty($data[0]->chatbot_footer_branding) ? $assetsBasePath.$data[0]->chatbot_footer_branding : 'https://cdn.instaengineai.com/assets/images/logo.png'; ?>">

                                 </div>

                                 

                                
                            

                               

                             </div>

                            <!--  <div class="col-md-6">

                                <video autoplay muted loop class="radius10 w-100">

                                    <source src="../../../../app/assets/images/whitelable-guide-2.mp4" type="video/mp4">

                                    Your browser does not support the video tag.

                                </video>

                            </div> -->

                         </div>

                     </div>
                */ ?>
                 </div>

             </form>

         </div>

     </div>

 </div>





<!-- Modal -->

<div class="modal fade" id="video1modall" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="video1modallLabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header border-0">

        <h1 class="modal-title fs-5" id="video1modallLabel">Dashboard Logo</h1>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <div class="video-body">

        <video autoplay muted controls loop class="radius10 w-100">

            <source src="../../../../app/assets/images/whitelable-guide.mp4" type="video/mp4">

            Your browser does not support the video tag.

        </video>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="modal fade" id="video2modall" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="video2modallLabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header border-0">

        <h1 class="modal-title fs-5" id="video2modallLabel">Book Reader Footer Branding Logo</h1>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <div class="video-body">

            <video autoplay muted controls loop class="radius10 w-100">

                <source src="../../../../app/assets/images/whitelable-guide-2.mp4" type="video/mp4">

                Your browser does not support the video tag.

            </video>

        </div>

      </div>

    </div>

  </div>

</div>

 

 <!-- Main Container End -->

 <script>

   var loadFile = function(event) {
 

     var output = document.getElementById('output');

     output.src = URL.createObjectURL(event.target.files[0]);

     output.onload = function() {

       URL.revokeObjectURL(output.src) // free memory

     }

   };
   
   var chatbotFooterBrand = function(event) {
       
     var output = document.getElementById('chatbot_footer_brand_show');

     output.src = URL.createObjectURL(event.target.files[0]);

     output.onload = function() {

       URL.revokeObjectURL(output.src) // free memory

     }

   };


   $('#checkCustomLabel').on('change',function(){ 

          if($('#checkCustomLabel').is(':checked')){
             $("#customeLabel").show();
             var checkCustomLabel = 1;
         }else{
             $("#customeLabel").hide();
            var checkCustomLabel = 0;
         }

    });
    isStyleManually();
    
    function isStyleManually(){

        if($('#checkCustomLabel').is(':checked')){
            //  $('body').addClass('dark-theme-color');
             $("#customeLabel").show();
                var checkCustomLabel = 1;
         }else{
          
             $("#customeLabel").hide();
                var checkCustomLabel = 0;
         }
            return checkCustomLabel;
    }
    isthemeDark();
     
  function isthemeDark(){
        if($('#darktheme').is(':checked')){
             $('body').addClass('dark-theme-color');
            var checkdarktheme = 'dark';
         }else{
            // $('body').removeClass('dark-theme-color');
            var checkdarktheme = 'light';
         }
        return checkdarktheme;
    }
    
    $('#theme_color').on('input',function(){
        themeColorChange();
    });
    function themeColorChange() {
        var checkThemeColor = "default";
        if ($('#theme_color').is(':checked')) {
        	checkThemeColor = $("#primarycolor").val();
            $('.customThemeColor').slideDown();
        } else {
            $('.customThemeColor').slideUp();
            checkThemeColor = "default";
        }    
        // setTimeout(function() {
            
        // }, 400); 
        return checkThemeColor;
    }
     
    $('#primarycolor').on('change', function () {
        themeColorChange();
    });

    

 $(document).ready(function(){

   $('.form_ajax').submit(function(){
     
   var formdata = new FormData(this);

    //formdata.append('checkCustomThemeColor', $("#primarycolor").val()); 

    formdata.append('checkCustomLabel', isStyleManually());
    formdata.append('checkisthemeDark', isthemeDark());
    formdata.append('checkCustomThemeColor', themeColorChange());
    
    $.ajax({
    url: "<?php echo base_url('insertdata'); ?>",
    type: "POST",
    dataType: "JSON",
    data: formdata,
    processData: false,
    contentType: false,
    success: function(response) {
        
        setTimeout(function() {
                    location.reload(true);
                }, 500);
        showFlash(response);
        // flashNow({'success': {'message': 'Data Updated Successfully...!!!'}});
        setTimeout(function() {
            
            // location.reload(true);
        }, 500);
    },
    error: function(xhr, status, error) {
        // alert('error');
        console.error("Error:", status, error);
    }
});


   });
 });
    


     
    $('#btn_delete').on('click', function() { 
    var user_id = $(this).attr('cat_id');
    
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('whitelabel-reset')?>",
        dataType: "JSON",
        data: { user_id: user_id },
        success: function(response) {
            if (response == "Deleted") {
                 
                setTimeout(function() {
                    location.reload(true);
                }, 500);

                // Flash a success message
                flashNow({'success': {'message': 'Whitelabel Reset Successfully...!!!'}});

                // Set the logo to default logo after reset
                $('#logo').attr('src', '../../../../app/assets/default/images/logo.png');  // Update to your default logo path

             }
        }
    });
});

   
 </script>

 
 