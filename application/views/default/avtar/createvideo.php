<style>
    .spinner-border{
        height: 25px!important;
        width: 25px!important;
    }
</style>
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="visController" ng-cloak>
    <title><?php echo $this->config->item('productName') ?> | Create Video</title>
    <div class="container-fluid container-padding">
        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chooseTemplateModal">Create Template</a>
    </div>

    <!-- insertNameModal -->
    <div class="modal fade" id="insertNameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content white shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <div>
                    <h5 class="modal-title fw-semibold">Name Your Video</h5>
                    <small class="theme-text-color">This title will be used for your new video.</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                <input type="hidden" name="id" ng-model="title_id">
                <input 
                    type="text" class="form-control text-white border-secondary rounded-3 mb-3"  placeholder="Enter Video Title"  name="project_name" ng-model="project_name">
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline btn-outline-white btn-no-style" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-no-style" ng-click="createNewVideo()">Create Video</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- insertNameModal -->

    <!-- Modal for createAvatar -->
    <div class="modal fade" id="createAvatarModal" tabindex="-1" aria-labelledby="createAvatarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex flex-column gap-2">
                        <h5 class="modal-title">Pick Your Avatar Type</h5>
                        <!-- <div class="std-btn">
                            <span>See The Difference</span>
                            <i
                                class="fa-solid fa-circle-info ms-2 info-tooltip"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-custom-class="custom-tooltip"
                                data-bs-title="Select the email type with your audience’s needs.">
                            </i>
                        </div> -->
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a class="text-center" href="<?= base_url('talking-avatars'); ?>">
                                <div class="createAvatarModal-box hover-video">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>images/photo-avatar.png" class="img-fluid mx-auto d-block" alt="image">
                                        <video class="hover-play" muted loop>
                                            <source src="<?php echo $this->config->item('assetsPath') ?>images/photo-avatar.mp4" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="inner-content">
                                        <h6 class="title">Create Photo Avatar</h6>
                                        <!-- <p class="description">Upload your photo or Choose a readymade face to animate with AI Voice</p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a class="text-center" href="<?= base_url('talking-avatars'); ?>?avatar_type=video">
                                <div class="createAvatarModal-box hover-video">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>images/video-avatar.png" class="img-fluid mx-auto d-block" alt="image">
                                        <video class="hover-play" muted loop>
                                            <source src="<?php echo $this->config->item('assetsPath') ?>images/video-avatar.mp4" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="inner-content">
                                        <h6 class="title">Create Video Avatar</h6>
                                        <!-- <p class="description">Pick from our readymade Video Avatars to effortlessly bring your voice to life.</p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="std-wrapper">
                        <div class="row g-0">
                            <div class="col-6">
                                <a href="javascript:void(0)">
                                    <div class="std-avatar-box">
                                        <span class="title-desc">Create with a Photo</span>
                                        <div class="media-box">
                                            <img src="<?php echo $this->config->item('assetsPath') ?>images/std-img/std1.png" alt="image">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0)">
                                    <div class="std-avatar-box border-0">
                                        <span class="title-desc">Create with a Video</span>
                                        <div class="media-box">
                                            <img src="<?php echo $this->config->item('assetsPath') ?>images/std-img/std1.png" alt="image">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for createAvatar -->

    <!-- chooseTemplateModal  -->
    <div class="modal fade" id="chooseTemplateModal" tabindex="-1">
        <div class="modal-dialog modal-xl premission-modal modal-dialog-centered modal-dialog-scrollable" style="max-width: 930px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Fast, Easy, and Ready to Publish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-gap w-100">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#insertNameModal" class="create-card">
                                <img src="<?php echo $this->config->item('assetsPath') ?>images/create_video/new.png" />
                                <h4 class="title">
                                    Create form scratch
                                </h4>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#createAvatarModal" class="create-card">
                                <img src="<?php echo $this->config->item('assetsPath') ?>images/create_video/video.png" />
                                <h4 class="title">
                                    Avatar Video
                                </h4>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <a href="<?= base_url('default-template'); ?>" class="create-card">
                                <img src="<?php echo $this->config->item('assetsPath') ?>images/create_video/temp.png" />
                                <h4 class="title">
                                    Template
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- chooseTemplateModal  -->
    
    <!-- Permission Confirmation Modal  -->
    <div class="modal fade" id="premissionModal" tabindex="-1">
        <div class="modal-dialog premission-modal modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permission Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-x: hidden;">
                    <p class="d-flex align-items-start gap-2"><span class="text-primary">1.) </span><span>Upload audio files in MP3 or WAV format, with a size between 200KB and 10MB and a duration of 10 to 30 seconds. The audio should feature clear, uninterrupted speech, free from background noise, overlapping voices, music, or distortions that may affect clarity.</span></p>
                    <p class="d-flex align-items-start gap-2"><span class="text-primary">2.) </span><span>Ensure you have explicit permission to use the voice in the audio file and confirm that it complies with copyright, privacy, and defamation laws. By uploading, you accept full responsibility for any legal consequences arising from the use of unauthorized or harmful audio content.</span></p>
                    <div class="text-center">
                        <a class="fw-bold text-white" href="https://www.humanizzer.com/legal/legal-policy.html" target="_blank">Privacy & Policy</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <label for="audioFile" class="btn btn-primary">
                        I Agree
                        <input type="file" id="audioFile" class="form-control d-none" accept=".mp3,.wav" file-input="audioFile" on-file-select="uploadAudio(file)">
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- videoPrModal -->
    <div class="modal fade video-pr-modal" id="videoPrModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px; max-height: 500px;">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Talking Avatar Preview</h5>
                </div>
                <div class="modal-body" style="overflow-x: hidden;">
                    <img src="<?php echo $this->config->item('assetsPath') ?>images/generate-avatar-pr.png" alt="image" class="img-fluid mx-auto d-block">
                </div>
                <div class="modal-footer justify-content-center gap-2">
                    <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Back</button>
                    <button type="button" id="showpLModal" class="btn btn-primary"  data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#pLModal">Create with AI Studio</button>
                </div>
            </div>
        </div>
    </div>
    <!-- videoPrModal -->

    <!-- portraitLandscapeModal -->
    <div class="modal fade pl-modal" id="pLModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 580px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Video From</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="pl-modal-pr">
                                <div class="media">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/landscape.png" alt="image" class="img-fluid mx-auto d-block">
                                </div>
                                <p class="desc">Landscape</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="pl-modal-pr">
                                <div class="media">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/portrait.png" alt="image" class="img-fluid mx-auto d-block">
                                </div>
                                <p class="desc">Portrait</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- portraitLandscapeModal -->
<!-- </div> -->

<script>
    // modal open and close working code
    $(document).on('click', '[data-bs-toggle="modal"]', function () {
        const target = $(this).data('bs-target');
        const $currentModal = $(this).closest('.modal');

        if ($currentModal.length) {
            $currentModal.modal('hide');

            $currentModal.one('hidden.bs.modal', function () {
            $(target).modal('show');

            $(target).one('hidden.bs.modal', function () {
                $('#chooseTemplateModal').modal('show');
            });
            });

            return false;
        }
    });
</script>

<script>
    // play video on hover from 0
    $('.hover-video').hover(
        function () {
            const video = $(this).find('.hover-play').get(0);
            video.currentTime = 0;
            video.play();
        },
        function () {
            const video = $(this).find('.hover-play').get(0);
            video.pause();
            video.currentTime = 0;
        }
    );
</script>


  <script>
  
  
      
  
      $(document).ready(function() {
        // // Handle icon click: stop event from bubbling up
        // $(document).on('click', '.list-group-item .icon i', function(e) {
        //     e.stopPropagation();
        //     // Optional: do something specific when icon is clicked
        //     // Example: $(this).toggleClass('fa-play fa-pause');
        // });
    
        // Handle list-group-item click: add 'active' class
        $(document).on('click', '.list-group-item', function() {
            $('.list-group-item').removeClass('active'); // Remove from all
            $(this).addClass('active'); // Add to clicked one
        });
    });

    $(function () {
        $('#tags').tagsInput({
            width: 'auto',
            onChange: function () {
                var val = $('#tags').val(); // get current tags
                var scope = angular.element($('#tags')).scope();
                scope.$apply(function () {
                    scope.triggerkeyword = val;
                });
            }
        });
    });

    $(document).ready(function(){
   /*   setTimeout(function(){
         $('.avatar-wrapper').on('click',function(e){
            $('.avatar-wrapper').removeClass('active');
            $(this).addClass('active');
       })   
     },1000);
       */

    $("#mysearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".inner-wrapper .list-group-item").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    });

   var baseUrl = '<?= base_url() ?>';

    var app = angular.module("AppModule", []);
    
    app.directive("fileInput", function () {
        return {
            scope: {
                fileInput: "=",
                onFileSelect: "&"
            },
            link: function (scope, element) {
                element.bind("change", function (event) {
                    scope.$apply(function () {
                        scope.fileInput = event.target.files[0];
                        scope.onFileSelect({ file: scope.fileInput });
                        
                        // ✅ Reset file input so selecting the same file again will trigger change
                        event.target.value = null;
                    });
                });
            }
        };
    });

    
    
    

    app.controller("visController", function ($scope, $http, $timeout, $sce) {

        $scope.imageFile = null; 
        $scope.selectedAvatar = '';;
        $scope.avatarImages = []; 
        $scope.prompt_id = <?php echo json_encode($prompt_id); ?>;
        $scope.allAudios = [];
        $scope.avatars = ['Avatar 1', 'Avatar 2', 'Avatar 3']; // Example data
        $scope.languages = []; 
        $scope.accents = ['Male', 'Female']; 
        $scope.emotions = ['Happy', 'Sad', 'Angry']; 
        $scope.selectedAvatar = "";
        $scope.selectedLanguage = "";
        $scope.selectedGender = "";
        $scope.selectedEmotion = "";
        $scope.selectedAvatarId = "";
        $scope.selectedAvatarUrl = "";
        $scope.selectedVideoUrl = "";
        $scope.audiooffset = 0;
        $scope.audiolimit = 6;
        $scope.isLoading = false;
        $scope.avtartype = "<?php echo $_GET['avatar_type'];?> ";
        $scope.offset = 0;  
        $scope.limit = $scope.avtartype.trim() == 'video' ? 10 : 30;  
        $scope.audioid = "";  
        $scope.avatar_name = "";
        $scope.clone_file = "",
        $scope.selectedvoicetype = 'ai_voice';
        $scope.getAudioId = function(id){
            $scope.audioid = id;
        }

        
 
        $scope.filterAvatars = function(avatar) {
            return avatar.user_id && avatar.user_id !== "" && avatar.business_id && avatar.business_id !== "";
        };

        $scope.filterDefaultAvatars = function(avatar) {
            return avatar.user_id == null && avatar.business_id == null;
        }; 


        $scope.checkData =  function(validation){
            $scope.offset = 0;
            $scope.limit = 10;
            $scope.avatarImages = [];
            var myagentsCount =  $('.myagents-class').data('myagents-count')
          
            if(validation == 'all'){
                
            }else if(validation == 'my-agents'){
                $scope.limit = 1000;
                
            }else if(validation == 'default'){  
                 $scope.limit = myagentsCount + 10;
            }
            $scope.getAvatarImage();

           
        }
        
        
        $scope.voicetype = function(type) {
            $scope.selectedvoicetype = type
        };
        
        $scope.generateAvatar = function(){
         
            if ($scope.avatar_name == "") {
                    flashNow({
                        error: { message: "Please enter a avatar name ." }
                    });
                    return
                }
            if ($scope.selectedvoicetype == "ai_voice") {
                // for character count
                var charCount = $scope.customprompt.trim().length;
                
                if (charCount < 50) {
                    flashNow({
                        error: { message: "Voice over script should be a minimum of 50 characters and a maximum of 500 characters." }
                    });
                    return;
                }
            
                
                if (!$scope.customprompt || $scope.customprompt.trim() === "") {
                    flashNow({
                        error: { message: "Please enter a voice over script." }
                    });
                    return;
                }
            
                if ($scope.audioid == "") {
                    flashNow({
                        error: { message: "Please select a voice." }
                    });
                    return
                }
            }  
            
            if ($scope.selectedvoicetype == "clone") {
                if ($scope.clone_file == "") {
                    flashNow({
                        error: { message: "Please Generate a voice." }
                    });
                    return
                }
            }
                

            jsAvatarLoader(true);
            var queryStr = "<?php echo base_url('generate-avatar-video')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                     data: {
                        'avatar_type': "<?php echo !empty($_GET['avatar_type']) ? $_GET['avatar_type'] : 'photo'; ?>",
                        'avatar_script': $scope.customprompt,
                        'avtar_audio': $scope.audioid,
                        'avtar_id': $scope.selectedAvatarId,
                        'avatar_name': $scope.avatar_name,
                        'avtar_url' : $scope.selectedAvatarUrl,
                        'video_url' : $scope.selectedVideoUrl,
                        'audio_url' : $scope.clone_file,
                        'voicetype' : $scope.selectedvoicetype,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log(response);
                    jsLoader(false);
                
                    if (response.data.video_id) {
                        toastr.success("Talking Avatar Generate Successfully");
                        window.location.href = "<?php echo base_url('avtar-create')?>";
                    } else {
                        toastr.error("Somthing went wrong");
                    }
                });

        }
        
        
        $scope.uploadAudio = function (file) {
            
            if (!$scope.customprompt || $scope.customprompt.trim() === "") {
                flashNow({
                    error: { message: "Please enter a voice over script." }
                });
                return;
            }
            
            if (!file) {
                toastr.error("No audio file selected.");
                return;
            }
          $("#premissionModal").modal('hide');
            var formData = new FormData();
            formData.append("audioFile", file);
            formData.append("prompts_id", $scope.prompts_id);
            formData.append("avatar_script", $scope.customprompt);
        
            jsLoader(true);
        
            $http.post("<?= base_url('upload_audioFile') ?>", formData, {
                headers: {
                    'Content-Type': undefined
                },
                transformRequest: angular.identity
            }).then(function (response) {
                jsLoader(false);
                // console.log(response.data);
                if (response.data.status === true ) {
                    toastr.success(response.data.msg);
                     $scope.clone_file = response.data.audioUrl;
                     
                    $scope.customprompt = "";
                    $scope.audioFile = null;
                    document.querySelector('input[type="file"][file-input="audioFile"]').value = "";
                     $scope.$apply();
                        // $timeout(function() {
                        //     var audio = document.getElementById('voice-audio');
                        //     if (audio) {
                        //         audio.load();
                        //     }
                        // });
                    
                } else {
                    toastr.error(response.data.msg);
                }
            }).catch(function (error) {
                jsLoader(false);
                toastr.error("An error occurred while uploading the audio file.");
                console.error(error);
            });
        };
        
        
      $scope.playAudio = function() {
            if ($scope.clone_file) {
                var audio = new Audio($scope.clone_file);
                audio.play();
                $scope.isPlaying = true;
                $scope.audio = audio;
                audio.onended = function() {
                    $scope.isPlaying = false;
                    $scope.$apply(); 
                };
            } else {
                console.log("No audio file URL found.");
            }
        };
        
        $scope.pauseAudio = function() {
            if ($scope.audio) {
                $scope.audio.pause();
                $scope.isPlaying = false;
            } else {
                console.log("No audio object to pause.");
            }
        };
       
        $scope.getGeneratevAvtarVideoById = function(video_id) {
            jsLoader(true);
              var queryStr = "<?php echo base_url('get-generated-avatar-video')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                     data: {
                        'avatar_type':   "<?php echo $_GET['avatar_type']?>",
                        'avtar_video_id': video_id,
                        'avatar_name': $scope.avatar_name
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) { 
                    jsLoader(false);
                    // console.log('test',response.data);
                    // if(response.data == 'true'){
                    //     alert();
                    // }else {
                    //     $scope.getGeneratevAvtarVideoById(video_id);                
                    // }
                });
            
        }
        
         $scope.removeAvatar = function(id) {
                     $("#deleteModal").modal('show');
                     $('#deleteModal .delete-yes-btn').on('click', function(e) {
                     $("#deleteModal").modal("hide");
                      $scope.removeAvatarConfirm(id);
                 });
                };
          
          $scope.removeAvatarConfirm = function(id)
          {
              $scope.imageId  = id
               var queryStr = "<?php echo base_url('remove-avatar')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: $scope.imageId }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    if (response.data.status == 2) {
                        toastr.success(response.data.msg); 
                        window.location.reload();
                        // $scope.getAvatarImageDefault(); 
                        // $scope.getAvatarImageBusiness();
                        // $scope.getAvatarImage();
                    } else {
                        toastr.warning("Something went wrong!");
                    }
                     
                }).catch(function(error) {
                    toastr.error("Something went wrong!");
                });
          }
          
          $scope.show_msg = function (msg) {
            flashNow({'error': {'message': msg}});
        };
        
        
        
       // $scope.getGeneratevAvtarVideoById('8fcc00b902ea42028ddea2442a803844');
       /*  $scope.resetoffset =  function(){
            $scope.offset = 0;
            $scope.limit = 9;
            $scope.avatarImages = []; 
            $scope.getAvatarImage();
        } */

        $scope.getUniqueLanguages = function () {
            let languages = $scope.allAudios.map(audio => audio.avatar_lang);
            $scope.uniqueLanguages = [...new Set(languages)]; // Remove duplicates
            setTimeout(() => {
                $('select').selectpicker('refresh');
            }, 500);
        };
        
        
        $scope.customprompt = "";
        
        $scope.getScript = function(){
            if ($scope.customprompt == "") {
                    flashNow({
                        error: { message: "Please enter a script." }
                    });
                    return
                }
            jsLoader(true);
            var queryStr = "<?php echo base_url('get-avtar-script')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                    data : {
                        'prompt' : $scope.customprompt
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) { 
                    jsLoader(false);
                    if (response.data.status == true) {
                        $scope.customprompt = response.data.data;
                    } else {
                        $scope.allAudios = [];
                        console.log("Could not fetch Data.");
                    }
                });
            
        }

        $scope.uploadFileChanged = function (fileInput) {
      
            $scope.imageFile = fileInput.files[0];
             $("#premissionModal").modal('hide');
             $scope.generate();
        };
        
        $scope.selectAvatarDefault = function() {
             $scope.selectedAvatar = avatar;
             $scope.userSelectedImage = avatar.apv_image_path; 
        };

        $scope.selectAvatar = function(avatar) {
             $scope.selectedAvatar = avatar;
             $scope.userSelectedImage = avatar.apv_image_path; 
        };


     $scope.generate = function () {

        //jsLoader(true);
        $(".temp_js_loader").remove();
        $("body").append(`
            <div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34); width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 9999;">
                <img src="https://www.humanizzer.com/app/assets/images/grabiris_loader.gif" style="position: absolute; margin: auto; top: 0; bottom: 0; left: 0; right: 0; height: 100px;">
                <div style="position: absolute; top: 60%; left: 50%; transform: translate(-50%, -50%); color: black; font-size: 16px; text-align: center;">
                    This may take up to 40-60 seconds...
                </div>
            </div>
        `);
    
        var formData = new FormData();
        
          if($scope.imageFile) 
          {
              formData.append('imageFile', $scope.imageFile);
          } else
          {
              toastr.error("Please upload image first");
              //jsLoader(false);
              $(".temp_js_loader").remove();
                return;
          }
            var queryStr = baseUrl + "generate-avatar";
        
            $http.post(queryStr, formData, {
                headers: {
                    'Content-Type': undefined
                },
                transformRequest: angular.identity
            }).then(function (response) {
                 if(response)
                 {
                     toastr.success("Image Uploaded successfully");
                     $scope.getAvatarImage();
                 }
                 else
                 {
                     toastr.error("Could not upload the image.");
                 }
                 //jsLoader(false);
                 $(".temp_js_loader").remove();
                 $scope.getAvatarImageDefault(); 
                 $scope.getAvatarImageBusiness();
                 $scope.getAvatarImage();
                // window.location.href = "<?= base_url('avatar-appearance') ?>";
            }, function (error) {
                // toastr.error("Error: Could not generate the avatar.");
                 //jsLoader(false);
                  $(".temp_js_loader").remove();
                 $scope.getAvatarImageDefault(); 
                 $scope.getAvatarImageBusiness();
                 $scope.getAvatarImage();
            });
        };
    
//   $("form#form_submit").on('submit',function(e){
//       jsLoader(true);
//         e.preventDefault();
//         var form = $(this);
//         var formData = new FormData($(this)[0]);
//         $.ajax({
//             url: "<?php echo base_url('upload-avatar')?>",
//             type: 'POST',
//             data: formData,
//             async: false,
//             success: function (data) {
//                 jsLoader(false);
//                 $('#uploadModal').modal('hide');
//                 $scope.offset = 0;
//                 $scope.avatarImages = [];
//                 $scope.getAvatarImage();
//                 console.log(form);
//                 form.find('input[type="file"]').val('');

//             },
//             cache: false,
//             contentType: false,
//             processData: false
//         });
        
//         return false;
//     });
   
   
   $("form#form_submit").on('submit', function (e) {
    e.preventDefault();
    jsLoader(true);

    var form = $(this);
    var name = form.find('input[name="name"]').val().trim();
    // var gender = form.find('select[name="gender"]').val();
    // var age = form.find('select[name="age"]').val();
    var file = form.find('input[name="avatar"]')[0].files[0];
    var checkbox = form.find('#flexCheckDefault').is(':checked'); 

    if (name === "") {
        jsLoader(false);
        flashNow({ error: { message: "Please enter a name." } });
        return false;
    }
    // if (!gender) {
    //     jsLoader(false);
    //     flashNow({ error: { message: "Please select a gender." } });
    //     return false;
    // }
    // if (!age) {
    //     jsLoader(false);
    //     flashNow({ error: { message: "Please select an age." } });
    //     return false;
    // }
    if (!file) {
        jsLoader(false);
        flashNow({ error: { message: "Please upload an image." } });
        return false;
    }
    if (!checkbox) { 
        jsLoader(false);
        flashNow({ error: { message: "Please select the checkbox." } });
        return false;
    }

    var formData = new FormData(form[0]);

    $.ajax({
        url: "<?php echo base_url('upload-avatar') ?>",
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jsLoader(false);
            $('#uploadModal').modal('hide');
            window.location.reload();
            form.find('input[type="file"]').val('');
            form.find('input[name="name"]').val('');
            // form.find('select[name="gender"]').val('');
            // form.find('select[name="age"]').val('');
            form.find('input[name="avatar"]').val('');
            form.find('#flexCheckDefault').prop('checked', false);
            
            $scope.offset = 0;
            $scope.avatarImages = [];
            $scope.getAvatarImage();
            form.find('input[type="file"]').val('');
        },
        error: function (xhr) {
            jsLoader(false);
            flashNow({ error: { message: "Upload failed. Please try again." } });
        }
    });

    return false;
});

    
    $scope.getAvatarImage = function () {
        
        var queryStr = "<?php echo base_url('get-getAvatarImage')?>";
        var avtar_type = "<?php echo $_GET['avatar_type'];?> ";
      
        // $('.load-more-btn').addClass('spinner-border');
        // $('.load-more-btn').show();
            $http({
                method: 'POST',
                url: queryStr,
                aync: false,
                data: {
                    // 'offset': $scope.offset,
                    // 'limit': $scope.limit,
                    'avtar_type': avtar_type.trim(),
                    'searchQuery':$scope.searchQuery
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) { 
                console.log(response);
                if (response.data.status == true) {
                     $scope.avatarImages = response.data.avatarImage;
                   // $scope.avatarImages = $scope.avatarImages.concat(response.data.avatarImage);
                    // $('.load-more-btn').removeClass('spinner-border'); 
                    // $('.load-more-btn').hide(); 
                    $scope.getSelectedAvtImage();
                    $scope.offset += $scope.limit;
                 
                } else {
                    console.log("Could not fetch images.");
                }
            });
    };
     /* Get All Audios Work Start */
         $scope.getAvatarAudios = function (avatar,lang,gender,emotion) {
            // jsLoader(true);
            // $('.loading-audio').addClass('spinner-border');
            // $('.loader-audio').css('opacity', 1);
            var queryStr = "<?php echo base_url('get-all-audio')?>";
            $scope.isLoading =  true;
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                    data : {
                        'avatars' : avatar,
                        'language': lang,
                        'gender'  : gender,
                        // 'offset'  : $scope.audiooffset,
                        // 'limit'  :  $scope.audiolimit,
                        'emotion' : emotion
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) { 
                    // jsLoader(false);
                    $('.loading-audio').removeClass('spinner-border');
                    $('.loader-audio').css('opacity', 0);
                    if (response.data.status == true) {
                        // $scope.allAudios = response.data.all_audio;
                       /*  if(response.data.filter) {
                            $scope.allAudios = [];
                            $scope.audiooffset = 0;
                        } */
                        $scope.allAudios = $scope.allAudios.concat(response.data.all_audio);

                        $scope.audiooffset += $scope.audiolimit;                      
                    } else {
                        $scope.allAudios = [];
                        console.log("Could not fetch images.");
                    }
                    $scope.isLoading =  false;
                }).catch(function(){
                    $scope.isLoading =  false;
                });
        };
    /* Get All Audios Work End */


    $scope.activeAvatarId = null;
     /* Avatar Image Id Get Start */
     $scope.activeAvatar =  function(avatar_id, image_url, video_url, avatar_name){
        $scope.activeAvatarId = avatar_id;
        $scope.selectedAvatarId =  avatar_id;
        $scope.selectedAvatarUrl =  image_url;
        $scope.selectedVideoUrl =  video_url;
        $scope.avatar_name =  avatar_name;
        if($scope.selectedAvatarId){
            // $("#pills-voice-tab").prop('disabled', false);
            // $("#pills-voice-tab").css('opacity','1');
            $("#pills-voice-tab").prop('disabled', false).css('opacity','1');
            $('#pills-voice-tab').tab('show');

        }
     }
    /* Avatar Image Id Get End */

   

        $scope.getAvatarImage();
        $scope.getAvatarAudios();
        

        /* play Audio Start */
        let audio = null;
        let playingIndex = null;

        $scope.playSample = function (audioUrl, index, event) {
            let element = event.target; // Get the clicked icon element
            $('.icons-audio').removeClass('fa-pause').addClass('fa-play');

            if (playingIndex === index) {
                if (audio && !audio.paused) {
                    audio.pause();
                    audio.currentTime = 0;
                    playingIndex = null;
                    $(element).removeClass('fa-pause').addClass('fa-play'); // Reset icon
                }
            } else {
                if (playingIndex !== null && audio && !audio.paused) {
                    audio.pause();
                    audio.currentTime = 0;
                    $('.icons-audio.fa-pause').removeClass('fa-pause').addClass('fa-play'); // Reset previous icon
                }

                // Create new audio instance
                audio = new Audio(audioUrl);
                audio.play().then(() => {
                    $(element).addClass('fa-pause').removeClass('fa-play');
                }).catch((error) => {
                    console.error(error);
                    $(element).removeClass('fa-pause').addClass('fa-play');
                });

                playingIndex = index;

                // Reset when audio ends
                audio.onended = function() {
                    playingIndex = null;
                    $(element).removeClass('fa-pause').addClass('fa-play');
                };
            }
        };

        /* play Audio End */


        /* Audio Filters Start */
       
        $scope.filterchange = function(){
            $scope.audiooffset = 0;
            $scope.audiolimit = 100;
            $scope.allAudios = [];
            $scope.isLoading = false;
            $scope.getAvatarAudios($scope.selectedAvatar, $scope.selectedLanguage, $scope.selectedGender,$scope.selectedEmotion);
        }



       




        /* $scope.customFilter = function(audio) {
            if ($scope.searchText && !audio.audio_name.toLowerCase().includes($scope.searchText.toLowerCase())) {
                return false;
            }
            
            
            if ($scope.selectedAvatar && audio.avatar !== $scope.selectedAvatar) {
                return false;
            }
            if ($scope.selectedLanguage && audio.avatar_lang !== $scope.selectedLanguage) {
                console.log(audio);
                return false;
            }
            if ($scope.selectedGender && audio.accent !== $scope.selectedGender) {
                return false;
            }
            if ($scope.selectedEmotion && audio.emotion !== $scope.selectedEmotion) {
                return false;
            }

            console.log($scope.selectedLanguage);
            return true;
        }; */
        /* Audio Filters End */


       

        // $scope.loadMoreBtn = function(){
        //     $scope.getAvatarImage();
        // }

        // $(".inner-wrapper .list-group").on("scroll", function() {
        //     if (!$scope.isLoading && $(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight - 100) {
        //         $scope.getAvatarAudios();
        //     }
        // });

        $scope.getAvatarImageBusiness = function () {
            var queryStr = "<?php echo base_url('get-getAvatarImageByBsnId')?>";
            $http({
                method: 'POST',
                url: queryStr,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) {
                if (response.data.status == true) {
                     
                    $scope.avatarImagesBusiness = response.data;
                } else {
                    console.log("Could not fetch images.");
                }
            });
        };
        $scope.getAvatarImageBusiness();
        
        $scope.getAvatarImageDefault = function () {
            var queryStr = "<?php echo base_url('get-getAvatarImageDefault')?>";
            $http({
                method: 'POST',
                url: queryStr,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) {
                if (response.data.status == true) {
                   
                    $scope.avatarImagesDefault = response.data;
                } else {
                    console.log("Could not fetch images.");
                }
            });
        };
        $scope.getAvatarImageDefault();     
 
         $scope.generateAppea =  function(){
           var id="";
           if($scope.selectedAvatar){
              id=$scope.selectedAvatar;
           }else if($scope.selectedAvatar!=="" && id===""){
               id=$scope.selectedAvatar;
           }else if($scope.selectedAvatarData.id && $scope.selectedAvatarData.id!==""){
                id=$scope.selectedAvatarData.id;
           }else if(id===""){
               let res=$scope.avatarImages;
               let avt2=res.avatarImage; 
               if (avt2) { 
                  for (let i = 0; i < avt2.length; i++) {
                      let item=avt2[i];
                     if(item['apv_id']===30 || item['apv_id']==='30'){
                         $scope.selectedAvatar=avt2[i];
                     }
                  } 
               }else{
                   console.error('$scope.avatarImages is not an array:', $scope.avatarImages);
               }
               id='30';
           }
           
            if (id==="" ) {
                toastr.error("Please select Agent first");
                return;
            }

            jsLoader(true);
            $http({
                method: "post",
                url: "<?php echo base_url('get-selectedAvatarDetails'); ?>", 
                data: $.param({
                     selectedAvatarDetails: $scope.selectedAvatar || $scope.selectedAvatarData ,
                     prompt_id:$scope.prompt_id
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function (response) {
                if(response.data.status == 1){
                    window.location.href = "<?= base_url('avatar-appearance') ?>"+"/"+ response.data.last_id;
                }
                jsLoader(false);
            });
    }
          
        //   console.log('selected',$scope.selectedAvatar);
          
          $scope.getSelectedAvtImage = function(){
                var queryStr = "<?php echo base_url('get-getSelectedAvtImage')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        avt_id:  $scope.prompt_id
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                        $scope.selectedAvatarData =  response.data;
                        $scope.selectedAvtId = response.data.prompt_apv_id;
                        $scope.selectedImagePath = response.data.apv_image_path;
                        if($scope.selectedImagePath != undefined){
                        $(".avatar-chatbot").css('background-image','url('+$scope.selectedImagePath+')');
                        }
                        
                });
            }
 
        $scope.getSelectedAvtImage() 
        $scope.changeRoute = function(page) {
            if($scope.prompt_id!=""){  
                if(page == 'training') {
                      window.location.href = "<?= base_url('avatar-training') ?>"+"/"+ $scope.prompt_id['prompt_id'];
                }  else if(page == 'appearance') {
                      window.location.href = "<?= base_url('avatar-appearance') ?>"+"/"+$scope.prompt_id['prompt_id'];
                }  else {
                    window.location.href = "<?= base_url('avatar-settings') ?>"+"/"+ $scope.prompt_id['prompt_id']; 
                }
            }
          } 
          
          
           $scope.deleteAgentProfile = function($event,id) {
                $event.stopPropagation();
                     $("#deleteModal").modal('show');
                     $('#deleteModal .yes').on('click', function(e) {
                     $("#deleteModal").modal("hide");
                      $scope.deleteAgentProfileConfirm(id);
                 });
                };
          
          $scope.deleteAgentProfileConfirm = function(id)
          {
              $scope.imageId  = id
               var queryStr = "<?php echo base_url('delete_agent_profile')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: $scope.imageId }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                      if (response.data.status == 1) {
                        toastr.error(response.data.mssg);
                    } else if (response.data.status == 2) {
                        toastr.success(response.data.msg); 
                        $scope.getAvatarImageDefault(); 
                        $scope.getAvatarImageBusiness();
                        $scope.getAvatarImage();
                    } else {
                        toastr.warning("Something went wrong!");
                    }
                     
                }).catch(function(error) {
                    toastr.error("Something went wrong!");
                });
          }
          
          $scope.show_msg = function (msg) {
            flashNow({'error': {'message': msg}});
        };
    });
</script>
