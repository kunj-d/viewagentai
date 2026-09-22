<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title><?php echo $this->config->item('productName') ?> | Instagram Publisher </title>

<style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
        display: none !important;
    }
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="instaCtrl">
    <div class="container-fluid container-padding">
        <div class="row">
            <div class="col-12">
                <div class="feature-banner">
                    <div class="row align-items-center justify-content-between g-0">
                        <div class="col-auto feature-wrap">
                            <h5 class="feature-title">Instagram Automation</h5>
                            <p class="feature-subtitle mb-0">
                                Choose or upload a video to post on Instagram
                            </p>
                        </div>
                        <div class="col-auto ms-auto">
                            <a href="javascript:void(0);" class="btn btn-primary" ng-click="uploadreel()">Publish</a>                     
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row gap-0 g-3">
                    <div class="col-lg-4">
                        <div class="theme-wrapper h-100">
                            <ul class="nav nav-pills nav-pills-style-3 mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-MyVideo-tab" data-bs-toggle="pill" data-bs-target="#pills-MyVideo" type="button" role="tab" aria-controls="pills-MyVideo" aria-selected="true">My Videos</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-UploadYourOwn-tab" data-bs-toggle="pill" data-bs-target="#pills-UploadYourOwn" type="button" role="tab" aria-controls="pills-UploadYourOwn" aria-selected="false">Upload Your Own</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent" style="height: calc(100% - 50px);">
                                <div class="tab-pane fade show active h-100" id="pills-MyVideo" role="tabpanel" aria-labelledby="pills-MyVideo-tab" tabindex="0">
                                    <div class="row gap-0 g-3 scrollbar-none viewSize1">
                                        
                                        <div class="col-md-6" ng-repeat="video in avatarList.avatarListingMade">
                                            <label class="theme-select">
                                                <input type="radio" name="presentation" class="radio" ng-checked="isSelected(video)" ng-click="get_video_url(video.url)">
                                                <div class="check-icon">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                                <img src="{{video.thumbnail}}" class="theme-media" alt="image">
                                            </label>
                                        </div>
                                        
                                    </div>    
                                </div>
                                <div class="tab-pane fade h-100" id="pills-UploadYourOwn" role="tabpanel" aria-labelledby="pills-UploadYourOwn-tab" tabindex="0">
                                    <div class="upload-area upload-area-style-2">
                                        <div class="upload-default">
                                            <img src="<?php echo $this->config->item('assetsPath');?>images/cloudUpload.png" alt="cloudUpload" >
                                            <h4>Upload Your Video</h4>
                                            <p>Drag and drop or click to select <br> a file from your device</p>
                                        </div>
                                        <div class="upload-preview">
                                            <i class="fa-solid fa-xmark cancel-btn"></i>
                                            <i class="fa-solid fa-video video-icon"></i>
                                            <p class="file-name"></p>
                                        </div>
                                        <!--<input type="file" id="videoUpload" accept="video/mp4">-->
                                        <input type="file" id="videoUpload" accept="video/mp4" file-input="videoFile" on-file-select="autoUpload(file)">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="theme-wrapper h-100">
                            <div class="title-head">
                                <h5 class="title">Instagram Post Setup</h5>
                                <p class="desc">Maximum 25 videos can be uploaded per day.</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="form-label">Media Type</h6>
                                <div class="story-post-toggle">
                                    <div>
                                        <input type="radio" class="btn-check" ng-click="get_post_type('REELS')" name="options-base" id="post" autocomplete="off" checked>
                                        <label class="btn" for="post">Media Post</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" ng-click="get_post_type('STORIES')" name="options-base" id="story" autocomplete="off" >
                                        <label class="btn" for="story">Story</label>
                                    </div>
                                </div>
                            </div>
            

                            <div class="creation-box mb-3">
                                <label for="enterCaption" class="form-label">Enter Caption</label>
                                <div class="position-relative overflow-hidden">
                                    <textarea name="enterCaption" id="enterCaption" ng-model="caption" class="form-control" placeholder="Enter your post caption" rows="5"></textarea>
                                    <button class="btn btn-primary gen_btn"><i class="fa-solid fa-wand-magic-sparkles" ng-click="generateCaption()"></i></button>
                                </div>
                            </div>

                            <div class="theme-box">
                                <label class="widget-box mb-2">
                                    <input type="radio" name="postSchedule" class="radio" autocomplete="off" ng-click="check_schedule_type('instant')" checked>
                                    <div class="check-icon">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <div class="icon-btn icon-lg bg-white border radius-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.75 15.75H19.5V18C19.5 18.1989 19.421 18.3897 19.2803 18.5303C19.1397 18.671 18.9489 18.75 18.75 18.75C18.5511 18.75 18.3603 18.671 18.2197 18.5303C18.079 18.3897 18 18.1989 18 18V15.75H15.75C15.5511 15.75 15.3603 15.829 15.2197 15.9697C15.079 16.1103 15 16.3011 15 16.5V21.75C15 21.9489 15.079 22.1397 15.2197 22.2803C15.3603 22.421 15.5511 22.5 15.75 22.5H21.75C21.9489 22.5 22.1397 22.421 22.2803 22.2803C22.421 22.1397 22.5 21.9489 22.5 21.75V16.5C22.5 16.3011 22.421 16.1103 22.2803 15.9697C22.1397 15.829 21.9489 15.75 21.75 15.75Z" fill="white"/>
                                            <path d="M10.5 14.25C10.9142 14.25 11.25 13.9142 11.25 13.5C11.25 13.0858 10.9142 12.75 10.5 12.75C10.0858 12.75 9.75 13.0858 9.75 13.5C9.75 13.9142 10.0858 14.25 10.5 14.25Z" fill="white"/>
                                            <path d="M15.7465 14.25H19.4965C19.4965 14.0025 19.534 13.755 19.534 13.5C19.537 11.3719 18.7789 9.31297 17.3965 7.695L17.9965 7.0575L18.214 7.2825C18.2838 7.3528 18.3667 7.40859 18.4581 7.44667C18.5495 7.48474 18.6475 7.50435 18.7465 7.50435C18.8455 7.50435 18.9436 7.48474 19.035 7.44667C19.1264 7.40859 19.2093 7.3528 19.279 7.2825C19.3493 7.21278 19.4051 7.12983 19.4432 7.03843C19.4813 6.94704 19.5009 6.84901 19.5009 6.75C19.5009 6.65099 19.4813 6.55296 19.4432 6.46157C19.4051 6.37017 19.3493 6.28722 19.279 6.2175L17.779 4.7175C17.7091 4.64757 17.6261 4.5921 17.5347 4.55426C17.4434 4.51641 17.3454 4.49693 17.2465 4.49693C17.0468 4.49693 16.8553 4.57627 16.714 4.7175C16.5728 4.85873 16.4935 5.05027 16.4935 5.25C16.4935 5.44973 16.5728 5.64127 16.714 5.7825L16.939 6L16.3015 6.6375C15.2066 5.7089 13.9054 5.05572 12.5065 4.7325C12.6632 4.42861 12.7454 4.09188 12.7465 3.75C12.7465 3.15326 12.5095 2.58097 12.0875 2.15901C11.6656 1.73705 11.0933 1.5 10.4965 1.5C9.8998 1.5 9.3275 1.73705 8.90555 2.15901C8.48359 2.58097 8.24654 3.15326 8.24654 3.75C8.24765 4.09188 8.32991 4.42861 8.48654 4.7325C7.0877 5.05572 5.78649 5.7089 4.69154 6.6375L4.05404 6L4.27904 5.7825C4.42026 5.64127 4.49961 5.44973 4.49961 5.25C4.49961 5.05027 4.42026 4.85873 4.27904 4.7175C4.13781 4.57627 3.94626 4.49693 3.74654 4.49693C3.54681 4.49693 3.35526 4.57627 3.21404 4.7175L1.71404 6.2175C1.64374 6.28722 1.58794 6.37017 1.54987 6.46157C1.51179 6.55296 1.49219 6.65099 1.49219 6.75C1.49219 6.84901 1.51179 6.94704 1.54987 7.03843C1.58794 7.12983 1.64374 7.21278 1.71404 7.2825C1.78376 7.3528 1.86671 7.40859 1.9581 7.44667C2.0495 7.48474 2.14753 7.50435 2.24654 7.50435C2.34555 7.50435 2.44357 7.48474 2.53497 7.44667C2.62636 7.40859 2.70931 7.3528 2.77904 7.2825L2.99654 7.0575L3.63404 7.695C2.37132 9.20554 1.63876 11.0885 1.54862 13.0552C1.45847 15.0219 2.01573 16.964 3.13497 18.5837C4.25421 20.2034 5.8737 21.4114 7.74522 22.0226C9.61675 22.6338 11.6371 22.6144 13.4965 21.9675C13.4928 21.895 13.4928 21.8225 13.4965 21.75V16.5C13.4965 15.9033 13.7336 15.331 14.1555 14.909C14.5775 14.4871 15.1498 14.25 15.7465 14.25ZM10.4965 3C10.6449 3 10.7899 3.04399 10.9132 3.1264C11.0366 3.20881 11.1327 3.32594 11.1894 3.46299C11.2462 3.60003 11.2611 3.75083 11.2321 3.89632C11.2032 4.0418 11.1318 4.17544 11.0269 4.28033C10.922 4.38522 10.7883 4.45665 10.6429 4.48559C10.4974 4.51453 10.3466 4.49968 10.2095 4.44291C10.0725 4.38614 9.95535 4.29001 9.87293 4.16668C9.79052 4.04334 9.74654 3.89834 9.74654 3.75C9.74654 3.55109 9.82555 3.36032 9.96621 3.21967C10.1069 3.07902 10.2976 3 10.4965 3ZM12.7465 13.5C12.7479 13.988 12.5906 14.4631 12.2984 14.8539C12.0062 15.2447 11.5948 15.5298 11.1263 15.6664C10.6579 15.803 10.1577 15.7836 9.70127 15.6111C9.24481 15.4387 8.85679 15.1225 8.5957 14.7102C8.33462 14.298 8.21463 13.8121 8.25381 13.3257C8.293 12.8393 8.48924 12.3788 8.81296 12.0137C9.13667 11.6486 9.57031 11.3986 10.0485 11.3014C10.5267 11.2043 11.0235 11.2652 11.464 11.475L13.714 9.225C13.8553 9.08377 14.0468 9.00443 14.2465 9.00443C14.4463 9.00443 14.6378 9.08377 14.779 9.225C14.9203 9.36623 14.9996 9.55777 14.9996 9.7575C14.9996 9.95723 14.9203 10.1488 14.779 10.29L12.529 12.54C12.6715 12.84 12.7458 13.1679 12.7465 13.5Z" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="content">
                                        <h6 class="title">Post instantly</h6>
                                        <p>Publish the video immediately</p>
                                    </div>
                                </label>
                                <label class="widget-box style-2">
                                    <input type="radio" name="postSchedule" class="radio" autocomplete="off" ng-click="check_schedule_type('schedule')">
                                    <div class="check-icon">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <div class="top">
                                        <div class="icon-btn icon-lg bg-white border radius-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.5 0C8.32969 0 9 0.670312 9 1.5V3H15V1.5C15 0.670312 15.6703 0 16.5 0C17.3297 0 18 0.670312 18 1.5V3H20.25C21.4922 3 22.5 4.00781 22.5 5.25V7.5H1.5V5.25C1.5 4.00781 2.50781 3 3.75 3H6V1.5C6 0.670312 6.67031 0 7.5 0ZM1.5 9H22.5V21.75C22.5 22.9922 21.4922 24 20.25 24H3.75C2.50781 24 1.5 22.9922 1.5 21.75V9ZM4.5 12.75V14.25C4.5 14.6625 4.8375 15 5.25 15H6.75C7.1625 15 7.5 14.6625 7.5 14.25V12.75C7.5 12.3375 7.1625 12 6.75 12H5.25C4.8375 12 4.5 12.3375 4.5 12.75ZM10.5 12.75V14.25C10.5 14.6625 10.8375 15 11.25 15H12.75C13.1625 15 13.5 14.6625 13.5 14.25V12.75C13.5 12.3375 13.1625 12 12.75 12H11.25C10.8375 12 10.5 12.3375 10.5 12.75ZM17.25 12C16.8375 12 16.5 12.3375 16.5 12.75V14.25C16.5 14.6625 16.8375 15 17.25 15H18.75C19.1625 15 19.5 14.6625 19.5 14.25V12.75C19.5 12.3375 19.1625 12 18.75 12H17.25ZM4.5 18.75V20.25C4.5 20.6625 4.8375 21 5.25 21H6.75C7.1625 21 7.5 20.6625 7.5 20.25V18.75C7.5 18.3375 7.1625 18 6.75 18H5.25C4.8375 18 4.5 18.3375 4.5 18.75ZM11.25 18C10.8375 18 10.5 18.3375 10.5 18.75V20.25C10.5 20.6625 10.8375 21 11.25 21H12.75C13.1625 21 13.5 20.6625 13.5 20.25V18.75C13.5 18.3375 13.1625 18 12.75 18H11.25ZM16.5 18.75V20.25C16.5 20.6625 16.8375 21 17.25 21H18.75C19.1625 21 19.5 20.6625 19.5 20.25V18.75C19.5 18.3375 19.1625 18 18.75 18H17.25C16.8375 18 16.5 18.3375 16.5 18.75Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h6 class="title">Post schedule</h6>
                                            <p>Set a date to publish automatically</p>
                                        </div>
                                    </div>
                                    <div class="schedule-wrap">
                                        <input type="date" name="" id="" class="form-control" ng-model="schedule_time">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="theme-wrapper h-100" style="min-height: 600px;">
                            <h5 class="title">Preview</h5>
                            <div class="theme-bg-dark preview-wrapper">
                                <div class="mobile-frame">
                                    <div class="post-box">
                                        <!-- Header -->
                                        <div class="post-header">
                                            <div class="logo insta-logo">
                                                <i class="fa-brands fa-instagram"></i>
                                            </div>
                                            <span class="brand">Instagram</span>
                                        </div>
                                        <!-- User Info -->
                                        <div class="user-row">
                                            <div class="top">
                                                <div class="avatar">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                                <div class="info">
                                                    <h4 class="name">James Raffalo</h4>
                                                </div>
                                                <div class="menu">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </div>
                                            </div>
                                            <!--<p class="desc">This is my first social media post.</p>-->
                                            <p class="desc">{{caption}}</p>
                                        </div>
                                        <!-- Video Preview -->
                                        <div class="mobile-video-preview">
                                            <button class="btn play-btn"><i class="fa-solid fa-play"></i></button>
                                            <video id="previewVideo" ng-src={{preview_url}} autoplay muted playsinline>
                                                <!--<source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">-->
                                            </video>
                                        </div>
                                        <!-- Actions -->
                                        <div class="action-row">
                                            <span><i class="fa-regular fa-heart"></i></span>
                                            <span><i class="fa-regular fa-comment"></i></span>
                                            <span><i class="fa-solid fa-share-nodes"></i></span>
                                        </div>
                                        <div class="likes">Liked by others</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- video play puase -->
    <script>
        const video = document.getElementById("previewVideo");
        const playBtn = document.querySelector(".play-btn");
        const icon = playBtn.querySelector("i");
        video.addEventListener("click", function () {
            const parent = this.closest(".mobile-video-preview");
            if (this.paused) {
                this.play();
                parent.classList.add("active");

                playBtn.style.opacity = "0";
                playBtn.style.pointerEvents = "none";

                icon.classList.remove("fa-play");
                icon.classList.add("fa-pause");

            } else {
                this.pause();
                parent.classList.remove("active");

                playBtn.style.opacity = "1";
                playBtn.style.pointerEvents = "auto";

                icon.classList.remove("fa-pause");
                icon.classList.add("fa-play");
            }
        });
        playBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            video.click();
        });
    </script>

<script>
    $(document).ready(function() {
    // When file is selected
    $('#videoUpload').on('change', function() {
        const file = this.files[0];
        if (file) {
        $('.file-name').text(file.name);
        $('.upload-default').hide();
        $('.upload-preview').fadeIn();
        }
    });
    
    // When cancel button is clicked
    $('.cancel-btn').on('click', function(e) {
        e.stopPropagation(); // prevent reopening file dialog
        $('#videoUpload').val(''); // clear file
        $('.file-name').text('');
        $('.upload-preview').hide();
        $('.upload-default').fadeIn();
    });
    
    });
</script>
<script>
// ========== ANGULAR APP ==========
var app = angular.module('MyApp', []);

// Directive for file input
app.directive("fileInput", function () {
    return {
        scope: { fileInput: '=', onFileSelect: '&' },
        link: function (scope, element) {
            element.bind("change", function (event) {
                var file = event.target.files[0];
                scope.$apply(function () {
                    scope.fileInput = file;
                    scope.onFileSelect({ file: file });
                });
            });
        }
    };
});

    app.controller('instaCtrl', function($scope, $http, $sce) {

    $scope.videoFile = null;
    $scope.video_url = "<?php echo !empty($video_url) ? $video_url : '' ?>";
    $scope.preview_url = "<?php echo !empty($video_url) ? $video_url : '' ?>";
    $scope.caption = "";
    $scope.post_type = "REELS";
    $scope.schedule_type = "instant";
    $scope.schedule_time = "";

    // AUTO UPLOAD when file selected
    $scope.autoUpload = function(file) {
        if (!file) return;
    
        var formData = new FormData();
        formData.append("video", file);
        // formData.append("caption", $scope.caption);
        // formData.append("video_url", $scope.video_url);
    
        jsLoader(true); 
    
        $http({
            method: 'POST',
            url: "<?php echo base_url('upload-reel-video'); ?>",
            data: formData, 
            headers: {
                'Content-Type': undefined  
            },
            transformRequest: angular.identity
        })
        .then(function(response) {
            // console.log('response' , response)
            jsLoader(false); 
    
            if (response.data.success) {
                $scope.video_url = response.data.cdn_url;
                $scope.preview_url = $sce.trustAsResourceUrl(response.data.cdn_url); 
                // console.log($scope.video_url);
                // alert("Video uploaded successfully!");
            } else {
                alert("Upload failed!");
            }
    
        })
        .catch(function(err) {
            jsLoader(false); 
            console.error(err);
            alert("Upload error!");
        });
    };
    
    
    $scope.get_video_url = function(videoUrl) {
        $scope.video_url = videoUrl
        $scope.preview_url = $sce.trustAsResourceUrl(videoUrl);
    };
        
    $scope.get_post_type = function(postType) {
        $scope.post_type = postType
    };
    
    $scope.check_schedule_type = function(scheduleType) {
        $scope.schedule_type = scheduleType
    };

        
        
        
    $scope.uploadVideo = function() {
            var fileInput = document.getElementById('videoUpload');
            var file = fileInput.files[0];
            if (!file) {
                alert('Please select a video file.');
                return;
            }
            var formData = new FormData();
            formData.append('video', file);
            
            jsLoader(true);
        
           $http({
                method: 'POST',
                url: "<?php echo base_url('upload-reel-video'); ?>",
                data: formData, 
                headers: {
                    'Content-Type': undefined  
                },
                transformRequest: angular.identity
            }).then(function(response) {
                // console.log(response)
                jsLoader(false); 
        
                if (response.data.success) {
                    $scope.video_url = response.data.cdn_url; 
                    $scope.uploadinstagram(response.data.cdn_url);
                } else {
                    alert("Upload failed!");
                }
        
            })
            .catch(function(err) {
                jsLoader(false); 
                console.error(err);
                alert("Upload error!");
            });
        };

    $scope.uploadreel= function() {
        jsLoader(true);
          var queryStr = "<?php echo base_url('upload-reel')?>";
            $http({
                method: 'POST',
                url: queryStr,
                aync: false,
                 data: $.param({
                    //  'video_cdn_url': $scope.video_cdn_url,
                    'caption': $scope.caption,
                    'video_url': $scope.video_url,
                    'post_type': $scope.post_type,
                    'schedule_type': $scope.schedule_type,
                    'schedule_time': $scope.schedule_time,
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function(response) {
                // console.log(response)
                jsLoader(false); 
                if (response.data.success) {
                     window.location.href = "<?php echo base_url('insta-publisher')?>";
                     toastr.success(response.data.msg);
                } else {
                    toastr.error(response.data.msg);
                }
        
            })
            .catch(function(err) {
                jsLoader(false); 
                console.error(err);
                toastr.error("Upload failed!");
            });
        };
        
        
        
        
        
    $scope.geteditorvideoList = function () {
    var queryStr = "<?php echo base_url('get-editor-list')?>";
        $http({
            method: 'POST',
            url: queryStr,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function (response) {
            if (response.data.status == true) {
                $scope.avatarList = response.data;
            } else {
                $scope.avatarList = response.data;
                // console.log($scope.avatarList);
            }
        });
    };
    $scope.geteditorvideoList();
    
    
    $scope.generateCaption = function(){
        if ($scope.caption == "") {
                flashNow({
                    error: { message: "Please enter a caption." }
                });
                return
            }
        jsLoader(true);
        var queryStr = "<?php echo base_url('generate-caption')?>";
            $http({
                method: 'POST',
                url: queryStr,
                aync: false,
                data : {
                    'caption' : $scope.caption
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) { 
                jsLoader(false);
                if (response.data.status == true) {
                    $scope.caption = response.data.data;
                } else {
                    $scope.allAudios = [];
                    console.log("Could not fetch Data.");
                }
            });
        
    }
        
        
    }); 
    
    
    
    
</script>

<script>
// Loader
function jsLoader(show) {
    $(".temp_js_loader").remove();
    if (show) {
        $("body").append(
            '<div class="temp_js_loader" style="background:rgba(200,200,200,0.34);width:100%;height:100%;position:fixed;top:0;left:0;z-index:9999;">' +
            '<img src="<?php echo $this->config->item('assetsPath');?>themes/default/img/loading-icon.gif" style="position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;">' +
            '</div>'
        );
    }
}
</script>
