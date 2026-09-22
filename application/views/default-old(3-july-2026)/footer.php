<style>
/*    .enjoyhint.enjoyhint-step-1::before,*/
/*    .enjoyhint.enjoyhint-step-2::before,*/
/*    .enjoyhint.enjoyhint-step-3::before,*/
/*    .enjoyhint.enjoyhint-step-4::before{*/
/*    content: '';*/
/*    background: rgba(0,0,0,0.8);*/
/*    top: 0;*/
/*    position: absolute;*/
/*    left: 0;*/
/*    width: 100%;*/
/*    z-index: 99;*/
/*    height: 100%;*/
/*}*/
#enjoyhint_label {
    backdrop-filter: contrast(0.5);
    padding: 5px 30px;
    border-radius: 5px;
}
.sender-text{
    white-space: pre-line;
}
/* .inserting-selected-checkbox{
    word-break: break-all;
} */
.gt_option a{
    color: var(--white-color) !important;
}
.removedisable{
    display: none !important;
    opacity: 1 !important;
    pointer-events: all !important;
}
</style>

<!-- thumbnailPreviewModal -->
<div class="modal fade" id="thumbnailPreviewModal" tabindex="-1" aria-labelledby="thumbnailPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="thumbnailPreviewModalLabel">Preview</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <img class="d-block img-fluid mx-auto" src="" alt="image">
      </div>
    </div>
  </div>
</div>
<!-- thumbnailPreviewModal -->

<div class="footer-sticky-height"></div>
<footer class="footer-design">
    <div class="footer-border">    
        All rights reserved to <span><?php echo $this->config->item('productName') ?></span>
    </div>
</footer>
</div>

<!-- Common Modal File -->

        <?php include 'common-modal.php' ?>
    
    <!-- Common Modal File -->

<!-- <div class="gtranslate_wrapper"></div> -->

<!-- YouTube Integration Wizard Js Fn    -->


<script>
    var handleWowAnimation = function(){
		if($('.wow').length > 0)
		{
			var wow = new WOW(
			{
			  boxClass:     'wow',      // animated element css class (default is wow)
			  animateClass: 'animated', // animation css class (default is animated)
			  offset:       50,          // distance to the element when triggering the animation (default is 0)
			  mobile:       false       // trigger animations on mobile devices (true is default)
			});
			wow.init();	
		}	
	}
    handleWowAnimation();
</script>



<!-- Custom Scrollbar Function With Click btn -->
<script>
   function scrollTabsLeft() {
        document.querySelectorAll('.scrollableTabWrapper').forEach(wrapper => {
            wrapper.scrollLeft -= 220;
        });
    }

    function scrollTabsRight() {
        document.querySelectorAll('.scrollableTabWrapper').forEach(wrapper => {
            wrapper.scrollLeft += 220;
        });
    }
</script>
<!-- Custom Scrollbar Function With Click btn -->

<script>
$(document).ready(function () {
    if ($('#smartwizard').length) {
        $('#smartwizard').smartWizard({
            lang: {
                next: 'Save And Next',
                previous: 'Previous'
            },
            anchor: {
                enableNavigation: false // 🔒 disable clicking nav tabs
            },
            keyboard: {
                keyNavigation: false // 🔒 disable keyboard arrow navigation
            },
            toolbarSettings: {
                showNextButton: false, // 👋 hide default Next
                showPreviousButton: false
            }
        });

        $('.sw-btn-next').addClass('d-none');
        $('.toolbar-bottom').addClass('d-none');
/* 
        // Prevent default step change on Save & Next
        $('#smartwizard .sw-btn-next').off('click').on('click', function (e) {
            e.preventDefault(); // ❌ Prevent SmartWizard from advancing by itself

            // Call Angular function from outside Angular context
            var scope = angular.element(document.getElementById('libCtrl')).scope();
            scope.$apply(function () {
                scope.saveStepData(); // ✅ Call the manual step change logic
            });
        });
 */
        /* $("#smartwizard").on("showStep", function (e, anchorObject, stepIndex, stepDirection) {
            var totalSteps = $('#smartwizard .nav .nav-link').length;
            if (stepIndex === totalSteps - 1) {
                $('.sw-btn-next').addClass('removedisable d-none');
            } else {
                $('.sw-btn-next').text('Save And Next').removeClass('removedisable d-none');
            }
        }); */
    }
});






</script>
<!-- YouTube Integration Wizard Js Fn    -->
<script>
    $(document).ready(function () {
        if ($('.std-btn').length > 0) {
            $(document).ready(function(){
                $(document).ready(function(){
                    $(".std-btn").click(function(){
                        $(".std-wrapper").fadeToggle(500);
                    });
                });
            });
        }

        // upload area Images Upload Function 
        if ($('#previewImage').length > 0) {
            $(document).ready(function () {
                let defaultImg = $("#previewImage").attr("src");

                $("#avatarImage").change(function (e) {
                    let file = e.target.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (e) {
                            $("#previewImage").attr("src", e.target.result);
                            $("#previewImage2").attr("src", e.target.result);
                            $(".custom-cross").css("display", "flex");
                        };
                        reader.readAsDataURL(file);
                    }
                });
                
                $(".custom-cross").click(function () {
                    $("#previewImage").attr("src", defaultImg);
                    $("#avatarImage").val("");
                    $(this).css("display", "none");
                });
            });
        }
        // upload area Images Upload Function 
            
        if ($('.avatarSwiper1').length > 0) {
            var swiper = new Swiper(".avatarSwiper1", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto", 
                initialSlide: 2,
                spaceBetween: 0,
                loop: true,
                coverflowEffect: {
                    rotate: 0,    
                    stretch: 50,  
                    depth: 150,   
                    modifier: 2,   
                    slideShadows: false,
                },
            });
        }

        if ($('.compareGoodSwiper').length > 0) {
            var swiper = new Swiper(".compareGoodSwiper", {
                slidesPerView: 2,
                spaceBetween: 10,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        }  
        if ($('.compareBadSwiper').length > 0) {
            var swiper = new Swiper(".compareBadSwiper", {
                slidesPerView: 2,
                spaceBetween: 10,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        }
    });  
</script>

<script>
    // upload_img_change code
	$(document).on('change', '.upload_img_change input[type="file"]', function (e) {
        if ($('.upload_img_change').length > 0) { // Check if .upload_img_change exists
            var file = e.target.files[0];
    
            if (file) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var $img = $(e.target).closest('.upload_img_change').find('.image-box img');
                    
                    if ($img.length > 0) {
                        $img.attr('src', event.target.result);
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>

<script>
    // temp solution
    // $(document).ready(function() {
    //     $('body').addClass('dark-theme-color');
    // });
</script>

<script>
    $(document).on("click", ".inserting-selected-checkbox img", function () {
        let columnName = $(this).data("column-name");
        let tableName = $(this).data("table-name");
        let bodyId =  $(this).parent().find('.res-preview-body').val();
    });


</script>
<script>
   /*  $(document).ready(function () {
        let checkedCount = 0;

        function updateCheckBox(updatedCount) {
            let container = $('.for-showing-selection');

            if (container.length === 0) {
                container = $(`
                    <div class="d-flex gap-2 align-items-center for-showing-selection">
                        <p class="mb-0"><span class="selected-count">${updatedCount}</span> Selected</p>
                    </div>
                `);
                $('.inserting-selected-checkbox').before(container);
            } else {
                container.find('.selected-count').text(updatedCount);
            }
        }

        $('.inserting-selected-checkbox').find('input[type="checkbox"]').not('#checkCustomColor_all').on('change', function () {
            checkedCount = $('.inserting-selected-checkbox').find('input[type="checkbox"]:checked').not('#checkCustomColor_all').length;
            if($('#checkCustomColor_all').is(':checked')){
                $('#inactiveicon').css('opacity', '1');
                updateCheckBox('All');
            }else{
                $('#inactiveicon').css('opacity', '1');
                updateCheckBox(checkedCount);
            }
        });

        $('#checkCustomColor_all').on('change',function(){
            if ($(this).is(':checked')) {
                $('#inactiveicon').css('opacity', '1');
                updateCheckBox('All');
            }else{
                $('#inactiveicon').css('opacity', '1');
                updateCheckBox('0');
            }
        })
    }); */

</script>

<script>
    $(document).ready(function () {

        var status =  1;
        var isFirstLoad = true;
        function isContentEmpty(content) {
                if (!content) {
                    $('.copy-icon, .download-icon').css('pointer-events', 'none').addClass('disabled');
                } else {
                    $('.copy-icon, .download-icon').css('pointer-events', 'all').removeClass('disabled');
                }
        }


        setTimeout(function() {
            let content = $('.note-editable').text().trim();
            isContentEmpty(content);
        }, 100); 

        $(document).on('click', '.copy-download-parent', function(e) {
            let content = $('.note-editable').text().trim();
            // console.log(content); 
            isContentEmpty(content);
            if(!content){
                flashNow({
                    'warning': {
                        'message': "Please Fill The Data First."
                    }
                });
            }
        });
        $(document).on('input', '.note-editable', function() {
            markUnsaved();
        });

        
        $(document).on('summernote.change', '#SummernoteIDtext', function() {
           let content = $('#SummernoteIDtext').summernote('code').trim(); // Get content and trim spaces
           isContentEmpty(content);
            if (isFirstLoad) {
                isFirstLoad = false; // Ignore first change event (initial load)
            } else {
                if (isContentEmpty(content)) {
                status = 0; // Mark as unsaved if empty
                } else {
                    markUnsaved(); // Otherwise, mark as modified
                }
            }

            

        });
        // Detect changes made dynamically using Summernote's callback
        /* $('#SummernoteIDtext').on('summernote.change', function () {
        }); */


        function markUnsaved() {
            $('.savebtn').addClass('btn-primary').removeClass('btn-outline');
            $('.publishbtn').removeClass('btn-primary').addClass('btn-outline');
            status = 0;
        }

    
        $('.savebtn').on('click',function(){
            $('.publishbtn').addClass('btn-primary');
            $('.publishbtn').removeClass('btn-outline');
            $('.savebtn').addClass('btn-outline');
            $('.savebtn').removeClass('btn-primary');
            status = 1;
        })
        $('.copy-download-parent .download-icon').on('click',function(e){
            if(status != 1){
                e.stopPropagation();
                setTimeout(() => {
                    flashNow({
                        'warning': {
                            'message': "Please Save The Changes."
                        }
                    });
                    $(this).next().removeClass('show');
                    $(this).removeClass('show');
                }, 0);
            }
        })

        /* $('.action-btn').each(function() {
            $(this).on('click', function(event) {
                if($(this).find('i.fa-star').hasClass('fas')){
                    flashNow({
                        'success': {
                            'message': 'Added to Favourite..'
                        }
                     });
                }else{
                    flashNow({
                        'error': {
                            'message': 'Remove From Favourite..'
                        }
                     });
                }
            });
        }); */



        


        function updateinputFields() {
            if ($("#user_radio").is(":checked")) {
                $(".user_input_text").show();
                $(".user_with_ai_text").hide();
            } else if ($("#ai_with_user_radio").is(":checked")) {
                $(".user_input_text").hide();
                $(".user_with_ai_text").show();
            } else {
                $(".user_input_text, .user_with_ai_text").hide();
            }
        }

        // Check on page load
        updateinputFields();

        // Update on radio button change
        $('input[name="selection-radios"]').on("change", function () {
            updateinputFields();
        });
    });
</script>
<script>
    // $(document).ready(function(){

    function theme_toggle() {
        // Toggle the dark theme class on the body
        $('body').toggleClass('dark-theme-color');

        // Determine the new theme (dark or default)
        var themeStyle = $('body').hasClass('dark-theme-color') ? 'dark' : 'default';


        // Prepare the data to send in the correct format
        let dataToSend = {
            checkisthemeDark: themeStyle // Send the correct theme style (either 'dark' or 'default')
        };

        $.ajax({
            url: "<?php echo base_url('insertdata'); ?>", // Your PHP controller method URL
            type: "POST",
            dataType: "JSON",
            data: dataToSend, // Send the theme style as part of the request
            success: function(response) {
                
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }



        /* let theme_toggle = $('.theme-toggle');
        theme_toggle.click(function(){
           
        }); */
    // });
</script>

<script>
    // tooltips initialized
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            initializeTooltips();

            // Event delegation for dynamically added tooltips
            document.body.addEventListener('mouseover', function (event) {
                const target = event.target.closest('[data-bs-toggle="tooltip"]');
                if (target && !target.hasAttribute('data-tooltip-initialized')) {
                    new bootstrap.Tooltip(target);
                    target.setAttribute('data-tooltip-initialized', 'true'); // Prevent re-initialization
                }
            });
        }, 1500);
    });

    // Function to initialize tooltips present in DOM
    function initializeTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        if (tooltipTriggerList.length > 0) {
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
                tooltipTriggerEl.setAttribute('data-tooltip-initialized', 'true');
            });
        }
    }
</script>

<script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"right","flag_style":"3d","alt_flags":{"en":"usa"}}</script> 
<script>

   /*  setTimeout(() => {
        $('.sub-menu').each(function(){
            $(this).on('click',function(){
                $(this).toggleClass('active-sub-menu');
            })
        })
    }, 1000); */


     function gotoConversationPage(assistant_id='',chat_id=''){
         const postData = {
              'assistant_id': assistant_id,
              'chat_id': chat_id,
            };
            
            const url = '<?= base_url() ?>conversation'; // Replace with your API endpoint
            
            // Create a hidden form element
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            
            // Add input fields for each data key-value pair
            for (const key in postData) {
              if (postData.hasOwnProperty(key)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = postData[key];
                form.appendChild(input);
              }
            }
            
            // Append the form to the document and submit it
            document.body.appendChild(form);
            form.submit();
     }

    var loadFile = function(event) {

        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    
     var loadFileSelector = function(event) {

        var output = document.querySelectorAll('.outputimage');
        for (let i = 0; i < output.length; i++) {
            output[i].src = URL.createObjectURL(event.target.files[0]);
            output[i].onload = function() {
                URL.revokeObjectURL(output[i].src) // free memory
            }
        }
        
    };
    
    var loadWidgetFile = function(event) {

        var output = document.querySelectorAll('.widget_show');
        for (let i = 0; i < output.length; i++) {
            output[i].src = URL.createObjectURL(event.target.files[0]);
            output[i].onload = function() {
                URL.revokeObjectURL(output[i].src) // free memory
            }
        }
        
       
    };
</script>
<script>


  /* -----------------Loader -------------------  */
  function jsLoader(add) {
        if (add === undefined) {
            add = false;
        }
        $(".temp_js_loader").remove();
        if (add) {
            $("body").append('<div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?= $assetsBasePath ?>assets/images/grabiris_loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; height:100px"></div>');
        }
    };

    function jsLoader(add,status) {
        if (add === undefined) {
            add = false;
        }
        $(".temp_js_loader").remove();
        if (add) {
            $("body").append('<div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?= $assetsBasePath ?>assets/images/grabiris_loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; height:100px"></div>');
        }
    };
    
      function jsLoaderText(text,add) {
    if (add === undefined) {
        add = false;
    }
    $(".temp_js_loader_text").remove();
    if (add) {
        $("body").append(`<div class="temp_js_loader_text" style="background: rgba(0, 0, 0, 0.04);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;    z-index: 9999999999 !important;">\
                            <h5 style="position: absolute;top: 63%;left: 50%;color: var(--theme-white) !important;transform: translate(-50%, -50%);">${text}</h5>\
                        </div>`);
    }
};
    
    function jsAvatarLoader(add) {
    if (add === undefined) {
        add = false;
    }
    $(".temp_js_loader").remove();
    if (add) {
        $("body").append(`
            <div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34); width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 9999;">
                <img src="<?= $assetsBasePath ?>assets/images/grabiris_loader.gif" style="position: absolute; margin: auto; top: 0; bottom: 0; left: 0; right: 0; height: 100px;">
                <div style="position: absolute; top: 60%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 16px; text-align: center;">
                    It may take 5–10 minutes. If delayed, please refresh (Ctrl + Shift + R) or try Incognito mode.
                </div>
            </div>
        `);
    }
}
</script>


<!-- Enjoy Hint Section Starts-->
<link rel="stylesheet" href="<?php echo $assetsFolder; ?>css/enjoyhint.css" type="text/css" />
<script src="<?php echo $assetsFolder; ?>js/enjoyhint.min.js"></script>
<script src="<?php echo $assetsFolder; ?>js/custom-file-input.js"></script>




<!-- <script>
// .. some code
var wasShown = 'enjoyhint:wasShown';
if (localStorage.getItem(wasShown)) {} else {
//initialize instance

var enjoyhint_instance = new EnjoyHint({});
//simple config.
//Only one step - highlighting(with description) "New" button
//hide EnjoyHint after a click on the button.
var enjoyhint_script_steps = [
    { "next #dashboard": 'Get familiar with your dashboard and make the most out of it.', shape: 'rectangle' },
	{ "next #letswork": 'Get ready to dive into productivity with Lets Work.', shape: 'rectangle' },
    { "next #textToImage": 'Discover the magic of transforming text into captivating visuals with Text to Image feature.', shape: 'rectangle' },
    { "next #imageToImage": 'Dive into the realm of creativity as we demonstrate the power of Image-to-Image conversion.', shape: 'rectangle' },
    { "next #textToGif": 'Explore the art of storytelling with Text to GIF conversion.', shape: 'rectangle' },
    { "next #chatBot": 'Unlock the potential of a Trained Chatbot. leverage advanced AI technology to create intelligent chatbots.', shape: 'rectangle' },
    { "next #aiTemplateEditor": 'Step into the future of design with the AI Template Editor. Discover how this innovative tool revolutionizes the creation process.', shape: 'rectangle' },
    { "next #myAssets": 'Empower your workflow with My Assets. Explore how to centralizes and organizes your resources.', shape: 'rectangle' },
    { "next #media": 'Explore how to use the Media and its benefits. Discover the advantages of Media and how to make the most of it.', shape: 'rectangle' },
    { "next #leads": 'Understand how to collect and manage your leads effectively, Ins and outs of lead management.', shape: 'rectangle' },
    { "next #whiteLabel": 'Set up your own branding with White Label in Ai Agents Army, step-by-step guide.', shape: 'rectangle' },
    { "next #settings": 'Configure all the options in the Settings of Ai Agents Army.', shape: 'rectangle' },
    { "next #profile": 'Set up your Profile and explore all the available options.', shape: 'circle',radius: 20 },
];
//set script config
// enjoyhint_instance.set(enjoyhint_script_steps);
//run Enjoyhint script
enjoyhint_instance.run();
//   localStorage.setItem(wasShown, true);
}
$( ".walkthroughsec" ).click(function() {
//initialize instance
var enjoyhint_instance = new EnjoyHint({});
//simple config.
//Only one step - highlighting(with description) "New" button
//hide EnjoyHint after a click on the button.
var enjoyhint_script_steps = [
	{ "next #dashboard": 'Get familiar with your dashboard and make the most out of it.', shape: 'rectangle' },
	{ "next #letswork": 'Get ready to dive into productivity with Lets Work.', shape: 'rectangle' },
    { "next #textToImage": 'Discover the magic of transforming text into captivating visuals with Text to Image feature.', shape: 'rectangle' },
    { "next #imageToImage": 'Dive into the realm of creativity as we demonstrate the power of Image-to-Image conversion.', shape: 'rectangle' },
    { "next #textToGif": 'Explore the art of storytelling with Text to GIF conversion.', shape: 'rectangle' },
    { "next #chatBot": 'Unlock the potential of a Trained Chatbot. leverage advanced AI technology to create intelligent chatbots.', shape: 'rectangle' },
    { "next #aiTemplateEditor": 'Step into the future of design with the AI Template Editor. Discover how this innovative tool revolutionizes the creation process.', shape: 'rectangle' },
    { "next #myAssets": 'Empower your workflow with My Assets. Explore how to centralizes and organizes your resources.', shape: 'rectangle' },
    { "next #media": 'Explore how to use the Media and its benefits. Discover the advantages of Media and how to make the most of it.', shape: 'rectangle' },
    { "next #leads": 'Understand how to collect and manage your leads effectively, Ins and outs of lead management.', shape: 'rectangle' },
    { "next #whiteLabel": 'Set up your own branding with White Label in Ai Agents Army, step-by-step guide.', shape: 'rectangle' },
    { "next #settings": 'Configure all the options in the Settings of Ai Agents Army.', shape: 'rectangle' },
    { "next #profile": 'Set up your Profile and explore all the available options.', shape: 'circle',radius: 20 },
];
//set script config
enjoyhint_instance.set(enjoyhint_script_steps);
	// enjoyhint_instance.run();
});
</script> -->
<!-- Enjoy Hint Section Ends-->
</body>

</html>