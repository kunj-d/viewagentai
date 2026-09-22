<!-- Container Start -->
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="PostController" ng-cloak>
    <title><?php echo $this->config->item('productName') ?> | AI Avatars Video</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding">
        <div class="row mb-3">
            <div class="col-12 mt-3 mb-3">
                <div class="text-center" style="max-width:440px; margin:auto;">
                    <div class="title-line mb-2" style="font-size:26px;">
                        AI Video Generator
                    </div>
                    <p>Create high-quality videos with AI. Enter a prompt to get started.</p>
                </div>
            </div>
        </div>
        <div class="theme-card mb-3">
            <label class="form-label mb-2" for="promptInput">Prompt</label>
            <div class="position-relative">
                <textarea id="promptInput" ng-keydown="checkEnter($event)" 
                          ng-model="commandText" class="form-control form-control-style-1 custom-textarea p-3 resize-none" rows="5"
                    maxlength="1000"
                    placeholder="Enter Your Prompt here... e.g. A Futuristic city at Sunset with flying cars"></textarea>
                <div class="position-absolute bottom-0 end-0 m-2 char-count">
                    <span id="charCounter">0</span>/1000
                </div>
            </div>
            <div class="mt-3 text-end">
                <!--<a href="#" class="btn btn-primary"><i class="fa-solid fa-wand-magic-sparkles"></i> Generate Video</a>-->
                <button type="button" ng-click="generatePost('ai')" class="btn btn-primary">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Video
                </button>
            </div>
        </div>
        <div class="theme-card d-none">
            <label class="form-label mb-2 d-flex align-items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Video History
            </label>
            <div>
                
                <div class="text-center text-muted py-4" ng-if="historyVideos.length == 0">
                    <i class="fa-solid fa-folder-open d-block fs-2 mb-2"></i>
                    No AI cinematic videos found in your history log.
                </div>
                <div class="row row-gap-2 gx-3" ng-if="historyVideos.length > 0">
                    <div class="col-md-6" ng-repeat="vid in historyVideos track by $index">
                        <div class="history-card p-3 d-flex align-items-start justify-content-between gap-4">
                            <div class="d-flex align-items-center gap-3 min-w-0">
                                <!--<div class="video-thumbnail">-->
                                <div class="video-thumbnail position-relative" style="width: 100px; height: 56px; background: #000; border-radius: 6px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                                    <!--<img src="https://picsum.photos/150/150?random=10" alt="Futuristic City thumbnail" class="flex-shrink-0">-->
                                    <img ng-src="{{vid.thumbnail}}" ng-if="vid.thumbnail != ''" alt="preview" style="width: 100%; height: 100%; object-fit: cover;">
                                    
                                    <video ng-src="{{vid.video_url | trustUrl}}" ng-if="vid.thumbnail == ''" style="width: 100%; height: 100%; object-fit: cover;" preload="metadata" playsinline></video>
                                    
                                    <a href="javascript:void(0);" ng-click="playHistoryVideo(vid.id, vid.video_url)" class="position-absolute d-flex align-items-center justify-content-center text-white h-100 w-100" style="top:0; left:0; background: rgba(0,0,0,0.45); transition: background 0.2s;" onmouseover="this.style.background='rgba(0,0,0,0.2)'" onmouseout="this.style.background='rgba(0,0,0,0.45)'">
                                        <i class="fa-solid fa-circle-play fs-5"></i>
                                    </a>
                                </div>
        
                                <div class="d-flex flex-column gap-2 min-w-0">
                                    <h6 class="video-title text-truncate m-0 fw-semibold" title="{{vid.keyword}}" ng-click="playHistoryVideo(vid.id, vid.video_url)" style="cursor: pointer;">
                                        <!--Futuristic city at sunset-->
                                        {{vid.keyword || 'AI Generated Scene'}}
                                    </h6>
                                    <div>
                                        <span class="style-badge">
                                            <i class="fa-solid fa-wand-magic-sparkles"></i> 
                                            <!--Futuristic-->
                                            AI VIDEO
                                        </span>
                                        
                                        <!--<span class="badge bg-danger" style="font-size: 10px; padding: 3px 6px; letter-spacing: 0.5px;">-->
                                        <!--    <i class="fa-solid fa-clapperboard me-1"></i> AI VIDEO-->
                                        <!--</span>-->
                                    </div>
                                </div>
                            </div>
        
                            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                <button class="action-btn" aria-label="Download Video" ng-click="downloadFile(vid.video_url, 'mp4')">
                                    <i class="fa-solid fa-download"></i>
                                </button>
                                <!--<button class="action-btn btn-delete" aria-label="Delete Video"-->
                                <!--    onclick="handleDelete(this)">-->
                                <!--<i class="fa-solid fa-trash-can"></i>-->
                                <!--</button>-->
                                <button type="button" class="action-btn btn-delete" aria-label="Delete Video" ng-click="deleteHistoryItem(vid.id)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
       <div class="modal fade video-pr-modal" id="historyPreviewModal" tabindex="-1" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px;">
                 <div class="modal-content" style="background: #1a1d24; border: 1px solid #2e3541;">
                     <div class="modal-header border-0 pb-0">
                         <h6 class="modal-title fw-semibold text-white">
                             <i class="fa-solid fa-circle-play text-danger me-2"></i>History Video Playback
                         </h6>
                         <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" ng-click="closeHistoryModalPlayer()"></button>
                     </div>
                     <div class="modal-body text-center p-3">
                         <input type="hidden" id="historyVideoId" ng-model="historyVideoId">
                         <video id="historyModalPlayer" class="w-100 rounded mb-3" controls style="max-height: 450px; background: #000; outline: none; box-shadow: 0 4px 15px rgba(0,0,0,0.6);">
                             <source id="historyModalSource" src="" type="video/mp4">
                             Your current web browser configuration does not handle inline native file streams.
                         </video>
                     </div>
                     <div class="modal-footer justify-content-center border-0 pt-0 gap-2">
                         <button type="button" class="btn btn-primary btn-no-style" ng-click="goToCustomEditor()">
                             <i class="fa-solid fa-pen-to-square me-1"></i> Customize in Editor
                         </button>
                     </div>
                 </div>
             </div>
        </div>

    <!--<script>-->
         <!--Character Counter Logic-->
    <!--    const textarea = document.getElementById('promptInput');-->
    <!--    const charCounter = document.getElementById('charCounter');-->

    <!--    textarea.addEventListener('input', () => {-->
    <!--        charCounter.textContent = textarea.value.length;-->
    <!--    });-->
    <!--</script>-->
    
    <script>
        var baseUrl = '<?= base_url() ?>';
        var app = angular.module("AppModule", []);
    
        // Secure URL Resource Bypass Context Filter Pipeline Configuration
        app.filter('trustUrl', function ($sce) {
            return function (url) {
                if (!url) return '';
                return $sce.trustAsResourceUrl(url);
            };
        });
    
        app.controller("PostController", function ($scope, $http, $timeout, $sce) {
            $scope.commandText = "";
            $scope.videodata = "";
            // $scope.isChatActive = false;
            // $scope.messages = [];
            // $scope.pendingPrompt = "";
            $scope.historyVideos = [];
            $scope.historyVideoId = "";
    
            $scope.fetchHistory = function() {
                var queryStr = "<?php echo base_url('get_video_history')?>";
                $http({
                    method: 'GET',
                    url: queryStr
                }).then(function(response) {
                    if (response.data.status) {
                        $scope.historyVideos = response.data.data;
                    }
                });
            };
            $scope.fetchHistory();
    
            $scope.checkEnter = function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    $scope.generatePost();
                }
            };
    
            $scope.generatePost = function(selectedType){
                // Bypassed multi-type confirmation and routing constraints entirely 
                let videoType = 'ai'; 
                let prompt = $scope.commandText;
    
                if (!prompt) {
                    if(typeof toastr !== 'undefined') {
                        toastr.error("Please enter your prompt description setup.");
                    } else {
                        alert("Please enter your prompt description setup.");
                    }
                    return;
                }
    
                if(typeof jsLoader === 'function') { jsLoader(true); }
                var queryStr = "<?php echo base_url('auto-post-generator')?>";
                
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: { 
                        prompt: prompt,
                        video_type: videoType 
                    }
                }).then(function (response) {
                    // if(typeof jsLoader === 'function') { jsLoader(false); }
                    
                    if (response.data.success && response.data.status === 'video_started') {
                        if(typeof toastr !== 'undefined') {
                            // toastr.success(response.data.message || "AI Video Generation Pipeline triggered successfully.");
                        }
                        $scope.commandText = ""; // Clear source prompt text frame field
                        
                        // Start tracking loops immediately inside database tracking registers
                        $scope.getvideodata();
                    } else {
                        if(typeof toastr !== 'undefined') {
                            toastr.error(response.data.message || "Failed to submit tracking parameters.");
                        }
                    }
                });
            };
    
            $scope.getvideodata = function () {
                var queryStr = "<?php echo base_url('get-video-id')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;' }
                }).then(function (response) {
                    if (response.data.status == true) {
                        $scope.videodata = response.data.data;
                        $scope.startGeneratingVideos();
                    }
                });
            };
    
            $scope.startGeneratingVideos = function() {
                let video = $scope.videodata;
                if (!video || !video.video_id) return;
                $scope.getGeneratevAvtarVideoById(video);
            };
    
            $scope.getGeneratevAvtarVideoById = function(video) {
                let id = video.id;
                let video_id = video.video_id;
                var queryStr = "<?php echo base_url('get-compelete-video')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: { 'id': id, 'video_id': video_id },
                    headers: { 'Content-Type': 'application/json' }
                }).then(function (response) {
                    if(response.data.status == true){
                        if(typeof jsLoader === 'function') {
                jsLoader(false);
            }
                        $scope.fetchHistory(); // Updates history collection with newly synced element
                         window.location.href = baseUrl + "video-editor-list?tab=ai-video";
                    }
                });
            };
            
            // Auto-check for active background compilation queues every 10 seconds
            setInterval(function() {
                $scope.getvideodata();
            }, 10000);
    
            $scope.playHistoryVideo = function(id, url) {
                var videoPlayer = document.getElementById('historyModalPlayer');
                var videoSource = document.getElementById('historyModalSource');
                if (url && videoPlayer && videoSource) {
                    videoSource.src = url;
                    videoPlayer.load();
                    
                    $scope.historyVideoId = id;
                    
                    var modalInstanceEl = document.getElementById('historyPreviewModal');
                    var bootstrapModal = new bootstrap.Modal(modalInstanceEl);
                    
                    modalInstanceEl.addEventListener('shown.bs.modal', function () {
                        videoPlayer.play();
                    }, { once: true });
                    
                    bootstrapModal.show();
                }
            };
            
            $scope.goToCustomEditor = function() {
                if ($scope.historyVideoId) {
                    $scope.closeHistoryModalPlayer();
                    
                    var modalEl = document.getElementById('historyPreviewModal');
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) { modal.hide(); }

                    window.location.href = baseUrl + "goto-editor?id=" + $scope.historyVideoId + "&width=1920&height=1080";
                } else {
                    if(typeof toastr !== 'undefined') {
                        toastr.error("Invalid target selection ID mapping missing.");
                    } else {
                        alert("Invalid target selection ID mapping missing.");
                    }
                }
            };

            $scope.showPermissionDenied = function() {
                if(typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Access Denied',
                        text: 'You do not have permission to access Editor.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            };
    
            $scope.closeHistoryModalPlayer = function() {
                var videoPlayer = document.getElementById('historyModalPlayer');
                if (videoPlayer) {
                    videoPlayer.pause();
                    videoPlayer.currentTime = 0;
                }
            };
    
            $scope.downloadFile = function(url, extension) {
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute('target', '_blank');
                link.download = 'AI_Video_' + new Date().getTime() + '.' + extension;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            };
    
            $scope.deleteHistoryItem = function(id) {
                if(typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This video item will be permanently removed from your history log!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DB1A1A',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $scope.executeDelete(id);
                        }
                    });
                }
            };
            
            $scope.executeDelete = function(id) {
                var queryStr = "<?php echo base_url('delete_history_video')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: id }),
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function(response) {
                    if(response.data.status) {
                        if(typeof toastr !== 'undefined') { 
                            toastr.success(response.data.msg || "Video deleted successfully."); 
                        }
                        $scope.fetchHistory();
                    } else {
                        if(typeof toastr !== 'undefined') { 
                            toastr.error(response.data.msg || "Failed to delete."); 
                        }
                    }
                });
            };
    
            $scope.scrollToBottom = function() {
                $timeout(function () {
                    var container = document.getElementById("chatContainer");
                    if (container) { container.scrollTop = container.scrollHeight; }
                }, 100);
            };
        });
    
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('promptInput');
            const charCounter = document.getElementById('charCounter');
            if(textarea && charCounter) {
                textarea.addEventListener('input', () => {
                    charCounter.textContent = textarea.value.length;
                });
            }
            
            var modalEl = document.getElementById('historyPreviewModal');
            if(modalEl){
                modalEl.addEventListener('hidden.bs.modal', function () {
                    var videoPlayer = document.getElementById('historyModalPlayer');
                    if (videoPlayer) {
                        videoPlayer.pause();
                        videoPlayer.currentTime = 0;
                    }
                });
            }
        });
    </script>