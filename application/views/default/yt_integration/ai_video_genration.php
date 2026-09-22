 
   <style>
   .video-row{
    /* display:flex;
    align-items:center; */
    /* gap:15px; */
    padding:0px;
    border:1px solid #ddd;
    border-radius:5px;
    cursor:pointer;
    margin-bottom:0px;
    background: var(--rgba-primary-3);
    position: relative;

    .checkbox-avtar{
        position: absolute;
        top: 0;
        right: 0;
        padding: 4px;

    }
    .bi-check-circle-fill::before {
        background: #fff;
        border-radius: 50%;
    }
}

.video-row.selected{
    border:2px solid var(--primary-color);
    background:var(--rgba-primary-3);
}
.avtarList {
    height: 220px;
    overflow: auto;
}
.avatar-thumb{
    width:64px;
    height:64px;
    border-radius:8px;
    object-fit:cover;
}
    
</style>


<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="MyCtrl">
<div class="container-fluid container-padding ">
    <div class="row align-items-center mb-3">
       
        <div class="col-12">
            <div class="mb-5 ">
                <div class="eyebrow mb-1">AI &amp; Avatar Video Generation</div>
                <h1 class="font-display h3 mb-1">Create AI &amp; Avatar Video</h1>
                <p class="text-muted-va mb-0">Generate an AI video or an avatar-led video from a script, and publish it straight to YouTube.</p>
            </div>
           
        </div>
    </div>
    <div class="row g-4 mt-5">
        <!-- Step rail -->
        <div class="col-lg-3 d-none d-lg-block">
        <div class="card-va p-3" style="position:sticky; top:90px;">
            <div class="agent-strip">
                <div class="agent-strip-avatar">
                    <img src="<?php echo $this->config->item('assetsPath') ?>images/aiAgent.png" alt="DB Logo" class="img-fluid">
                    <!-- <i class="bi bi-youtube"></i> -->
                </div>
                <div class="agent-strip-body">
                    <div class="agent-strip-title typewriter">
                        <span id="text"></span>
                        <span class="cursor"></span>
                    </div>
                </div>
                <!-- <div class="agent-strip-wave">
                    <span class="pulse"><span></span><span></span><span></span><span></span><span></span></span>
                </div> -->
            </div>
            <div class="step-rail" id="stepRail">
            <div class="step-item active" data-step-marker="1">
                <div class="step-num">1</div>
                <div><div class="step-title">Video type</div><div class="step-sub">AI or avatar video</div></div>
            </div>
            <div class="step-item" data-step-marker="2">
                <div class="step-num">2</div>
                <div><div class="step-title" id="railStep2Title">Create video</div><div class="step-sub" id="railStep2Sub">Prompt or script &amp; avatar</div></div>
            </div>
            <div class="step-item" data-step-marker="3">
                <div class="step-num">3</div>
                <div><div class="step-title">Generating</div><div class="step-sub">ViewAgent builds the video</div></div>
            </div>
            <div class="step-item" data-step-marker="4">
                <div class="step-num">4</div>
                <div><div class="step-title">Preview</div><div class="step-sub">Watch before you publish</div></div>
            </div>
            <div class="step-item" data-step-marker="5">
                <div class="step-num">5</div>
                <div><div class="step-title">Publish</div><div class="step-sub">Review &amp; approve</div></div>
            </div>
            </div>
        </div>
        </div>
        <!-- Step content -->
        <div class="col-lg-9">
        <div class="card-va p-2 p-md-4">

            <!-- STEP 1: Choose video type -->
            <div class="wizard-step active" data-step="1">
            <h2 class="font-display h5 mb-1">Which type of video would you like to create?</h2>
            <p class="text-muted-va mb-4">ViewAgent will show you the right inputs for the path you pick.</p>

            <div data-radio-group="videoType" class="d-flex flex-column gap-2 mb-4" id="videoTypeGroup">
                <div class="radio-card active" data-video-type="ai">
                <div class="radio-dot"></div>
                <div class="path-icon" style="width:40px;height:40px;"><i class="bi bi-magic"></i></div>
                <div>
                    <div class="fw-semibold">AI Video</div>
                    <div class="text-muted-va small">Give ViewAgent a prompt and it generates a full AI video for you.</div>
                </div>
                </div>
                <div class="radio-card" data-video-type="avatar">
                <div class="radio-dot"></div>
                <div class="path-icon" style="width:40px;height:40px;"><i class="bi bi-person-video3"></i></div>
                <div>
                    <div class="fw-semibold">AI Avatar Video</div>
                    <div class="text-muted-va small">A talking avatar reads your script in a voice you choose.</div>
                </div>
                </div>
            </div>

            <button class="btn btn-primary" id="btnChooseType">Continue <i class="bi bi-arrow-right"></i></button>
            </div>

            <!-- STEP 2: Create Video (branches by type) -->
            <div class="wizard-step" data-step="2">

            <!-- AI Video inputs -->
            <div id="aiVideoFields">
                <h2 class="font-display h5 mb-1">What should your AI video be about?</h2>
                <p class="text-muted-va mb-4">Describe the topic, offer or niche — ViewAgent writes the script and builds the video.</p>

                <div class="form-va mb-4">
                <label>Prompt</label>
                <textarea class="form-control-va" id="aiPrompt" ng-model= "script" rows="5" placeholder="e.g. A 60-second video explaining why small businesses should automate their invoicing with AI tools."></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-outline" data-go-step="1"><i class="bi bi-arrow-left"></i> Back</button>
                    <button class="btn btn-primary" id="btnGenerateAi" ng-click="generateVideo('ai')"  ng-disabled="!script || !script.trim() || isGenerating" ><i class="bi bi-stars"></i> Generate Video</button>
                </div>
            </div>

            <!-- AI Avatar Video inputs -->
            <div id="avatarVideoFields" style="display:none;">
                <h2 class="font-display h5 mb-1">Build your AI avatar video</h2>
                <p class="text-muted-va mb-4">Name your avatar, write the script, pick a photo, and choose or clone a voice.</p>

                <div class="form-va mb-3">
                <label>Avatar name</label>
                <input type="text" class="form-control-va" id="avatarName" ng-model="avatarName" placeholder="e.g. Maya — Product Explainer">
                </div>

                <div class="form-va mb-4" style="position: relative;">
                <label>Script</label>
                <textarea name="custom_prompt" id="custom_prompt" rows="5" class="form-control-va"  ng-model="customprompt" placeholder="E.g. Hi there! Welcome to our channel..." maxlength="500"></textarea>
                    <button type="button" class="generate-button bottom-right" ng-click="getScript()"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip"
                    data-bs-title="Enhance your script."
                    ><i class="fa-solid  fa-wand-magic-sparkles"></i></button>
                
                </div>

                <!-- Upload / Select Avatar Photo -->
                <div class="form-va mb-2">
                <label>Avatar photo</label>
                </div>
                <div class="pill-select mb-3" data-tab-group="photo">
                <span class="pill active selectAvtar" id= "select-avtar" data-tab="select">Select existing avatar</span>
                <span class="pill upAvatar" id= "upAvatar" data-tab="upload">Upload avatar photo</span>
                </div>

                <div class="d-flex  gap-3 mb-4 avtarList flex-wrap" >

    <div class="video-row" id="avtar-list" style="display:block; height:190px ; flex: 0 0 18%; overflow:hidden;"
         ng-repeat="avatar in avatarImages track by avatar.id"
         ng-click="selectAvatar(avatar)"
         ng-class="{'selected': avatar.id == selectedAvatarId}" >

        <div class="thumb " style="width:100%; height:150px;" >
            <img ng-src="{{avatar.url}}"
                 class="avatar-thumb"
                 alt="{{avatar.name}}"
                 style="width:100%;height:100%;border-radius:5px;object-fit:cover;"
                 onerror="this.src='https://via.placeholder.com/64?text=Avatar'">
        </div>
    
            <div class="flex-grow-1 text-center p-2 overflow-hidden">
    
                <div class="fw-bold text-white">
    
                    {{avatar.name}}
    
                </div>
    
                <div class="small text-muted">
    
                    {{avatar.gender}}
    
                </div>
    
            </div>
    
            <div class="checkbox-avtar">
    
                <i class="bi"
                   ng-class="avatar.id == selectedAvatarId ?
                   'bi-check-circle-fill text-primary' :
                   'bi-circle text-secondary'">
                </i>
    
            </div>
    
        </div>
    
    </div>
    
    
    
    <div class="text-center"
         ng-if="!loadingMore && avatarImages.length==0">
    
        <h5>No Avatar Found</h5>
    
    </div>

            <div class="form-va mb-4" id="avatarUploadZoneWrap" data-tab-panel="photo-upload" style="display:none;">
                <div class="thumb-upload" id="avatarUploadZone">
                    <label for="avatarInput" class="cursor-pointer">
                        <i class="bi bi-cloud-arrow-up icon-lg d-block mb-1"></i>
                        Click to upload a photo (JPG or PNG)
                        <!-- Add input file here -->
                        <input type="file" id="avatarInput" accept=".jpg,.jpeg,.png" style="display:none; margin-top:10px;">
                    </label>
                </div>
            </div>

                <!-- Select or Clone Voice -->
                <div class="form-va mb-2 d-flex justify-content-between align-items-center">
                    <label>Select Voice</label>
                    <div class="pill-select mb-3" data-tab-group="voice">
                        <span class="pill active" data-tab="select">Ai voice</span>
                        <span class="pill" data-tab="clone">Clone voice</span>
                    </div>
                </div>
                
                <div class="pill-select mb-4" id="voiceSelect" data-tab-panel="voice-select">
                    <div class="w-100">
                        <div class="row g-3 gap-0 align-items-center mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <select title="Language"
                                    ng-model="selectedLanguage"
                                    ng-change="filterchange()"
                                    class="ng-pristine ng-untouched ng-valid">
                            
                                <option value="">Select Language</option>
                                <option value="English">English</option>
                                <option value="French">French</option>
                                <option value="Spanish">Spanish</option>
                                <option value="German">German</option>
                                <option value="Italian">Italian</option>
                                <option value="Portuguese">Portuguese</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Arabic">Arabic</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Japanese">Japanese</option>
                            
                            </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <select title="Gender"
                                        ng-model="selectedGender"
                                        ng-change="filterchange()"
                                        class="ng-pristine ng-untouched ng-valid">
                                
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                
                                </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="search-bar right-icon">
                                    <div class="search-icon">
                                        <span class="icon-search"></span>
                                    </div>
                                    <input type="text" class="search form-control" id="mysearch" placeholder="Search.."  autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class=" voice-lists">
                            <span class="pill voice-pill"
                                  ng-repeat="voice in allAudios"
                                  ng-class="{'active': selectedVoiceId === voice.sv_id}"
                                  ng-click="selectVoice(voice)">
                                <span>
                                    <i class="bi"
                                       ng-class="playingVoiceId === voice.sv_id ? 'bi-pause-circle-fill' : 'bi-play-circle'"
                                       ng-click="togglePreview(voice, $event)">
                                    </i>
                            
                                    {{ voice.sv_name }} — {{ getVoiceTagline(voice) }}
                                </span>
                                <i class="fa-solid fa-volume-high"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div ng-if="isLoading" class="text-muted small">Loading voices...</div>
                
                <audio id="voicePreviewPlayer"></audio>
                
                

            <div class="form-va mb-4" id="cloneVoiceUpload" data-tab-panel="voice-clone" style="display:none;">
                <div class="thumb-upload">
                    <label for="autoInput" class="cursor-pointer">
                        <i class="bi bi-mic icon-lg d-block mb-1"></i>
                        Upload a 30-second voice sample to clone your voice
                        </div>
                        <input type="file" id="autoInput" accept=".jpg,.jpeg,.png" style="display:none; margin-top:10px;">
                    </label>
                </div>

                <div class="d-flex gap-2">
                <button class="btn btn-outline" data-go-step="1"><i class="bi bi-arrow-left"></i> Back</button>
                <button class="btn btn-primary" id="btnGenerateAvatar" ng-click="generateVideo('avatar')" ng-disabled="isGenerating"><i class="bi bi-stars"></i> Generate Video</button>
                </div>
            </div>
            </div>

            <!-- STEP 3: Generating (this IS the loader now) -->
            <div class="wizard-step" data-step="3">
                <div class="text-center py-4">
                    <div class="pulse pulse-lg justify-content-center mb-4">
                    <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                    </div>
                    <h2 class="font-display h5 mb-1" id="buildHeading">ViewAgent is building your video</h2>
                    <p class="text-muted-va mb-4">This usually takes a minute or two.</p>

                    <div class="mx-auto text-start" style="max-width:420px;">
                    <ul class="list-unstyled d-flex flex-column gap-2" id="buildChecklist">
                        <li><i class="bi bi-circle text-muted-va me-2"></i>Writing the script</li>
                        <li><i class="bi bi-circle text-muted-va me-2"></i>Generating scenes &amp; visuals</li>
                        <li><i class="bi bi-circle text-muted-va me-2"></i>Rendering voiceover</li>
                        <li class="d-flex"><i class="bi bi-circle text-muted-va me-2"></i>Compositing final video <div class="loader"></div></li>
                    </ul>
                    </div>
                </div>
            </div>
            
           

            <!-- STEP 4: Video Preview -->
            <div class="wizard-step" data-step="4">
            <h2 class="font-display h5 mb-1">Your video is ready</h2>
            <p class="text-muted-va mb-4">Preview it below, then publish to YouTube whenever you're ready.</p>

            <!--<div class="thumb thumb-after mb-4" style="max-width:520px; aspect-ratio:16/9;">-->

                 <!--Show video if available -->
            <!--    <video ng-if="generatedVideoUrl"-->
            <!--           controls-->
            <!--           autoplay-->
            <!--           style="width:100%;height:100%;object-fit:cover;border-radius:12px;">-->
                    
            <!--        <source ng-src="{{generatedVideoUrl}}" type="video/mp4">-->
            <!--        Your browser does not support the video tag.-->
            <!--    </video>-->
                
               
                <!-- Placeholder while no video -->
            <!--    <div ng-if="!generatedVideoUrl"-->
            <!--         style="width:100%;height:100%;display:flex;justify-content:center;align-items:center;">-->
            <!--        <i class="bi bi-play-circle icon-xl"></i>-->
            <!--        <span class="thumb-dur">0:58</span>-->
            <!--    </div>-->
            
            <!--</div>-->
            
            <div class="thumb thumb-after mb-4" style="max-width:520px;aspect-ratio:16/9;">

                <video
                    id="previewVideo"
                    ng-if="generatedVideoUrl"
                    controls
                    autoplay
                    playsinline
                    preload="auto"
                    style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
            
                    Your browser does not support the video tag.
            
                </video>
            
                <div
                    ng-if="!generatedVideoUrl"
                    style="width:100%;height:100%;display:flex;justify-content:center;align-items:center;">
            
                    <i class="bi bi-play-circle icon-xl"></i>
                    <span class="thumb-dur">0:58</span>
            
                </div>
            
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary" data-go-step="5"><i class="bi bi-youtube"></i> Publish to YouTube</button>
                <a href="<?php echo base_url('video-editor-list')?>" class="btn btn-outline"><i class="bi bi-kanban"></i> Go to list</a>
                <button class="btn btn-outline"     ng-click="createNewVideo()"  id="btnCreateAnotherFromPreview"><i class="bi bi-plus-lg"></i> Create new video</button>
            </div>
            </div>

            <!-- STEP 5: Publish review -->
            <div class="wizard-step" data-step="5">
            <h2 class="font-display h5 mb-1">Ready to publish</h2>
            <p class="text-muted-va mb-4">Review the AI-generated details before your video goes live.</p>

            <div class="row g-4">
                <div class="col-md-5">
                <!--<div class="thumb thumb-after mb-2">-->
                <!--    <i class="bi bi-play-circle icon-xl"></i>-->
                <!--    <span class="thumb-dur">0:58</span>-->
                <!--</div>-->
                
                <div class="thumb thumb-after mb-2"
     style="position:relative;width:100%;aspect-ratio:16/9;overflow:hidden;">

    <!-- Video -->
    <video
        id="previewVideo2"
        ng-show="generatedVideoUrl"
        controls
        autoplay
        playsinline
        preload="metadata"
        style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
    </video>

    <!-- Placeholder -->
    <div ng-show="!generatedVideoUrl"
         style="width:100%;height:100%;display:flex;justify-content:center;align-items:center;">
        <i class="bi bi-play-circle icon-xl"></i>
        <span class="thumb-dur">0:58</span>
    </div>

</div>
                
                
                <div class="text-muted-va small">AI-generated thumbnail</div>
                </div>
                <div class="col-md-7">
                <div class="form-va mb-3">
                    <label>AI generated title</label>
                    <input type="text" class="form-control-va" id="publishTitle" ng-model="publishTitle"  placeholder="3 AI Tools That Automate Your Invoicing in 2026">
                </div>
                <div class="form-va mb-3">
                    <label>Description</label>
                    <textarea class="form-control-va" id="publishDescription"  ng-model="publishDescription" rows="3" placeholder = "Stop tracking invoices by hand. Here are 3 AI tools that automate the busywork so you get paid faster."></textarea>
                </div>
                <!--<div class="form-va">-->
                <!--    <label>Tags</label>-->
                <!--    <div class="tag-select">-->
                <!--    <span class="pill ">AI tools</span>-->
                <!--    <span class="pill ">invoicing</span>-->
                <!--    <span class="pill ">small business</span>-->
                <!--    <span class="pill">automation</span>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="form-va">
                    <label>Tags</label>
                
                    <div class="tag-select">
                
                        <span
                            class="pill"
                            ng-repeat="tag in publishTags track by $index">
                
                            {{tag}}
                
                        </span>
                
                    </div>
                </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-outline" data-go-step="4"><i class="bi bi-arrow-left"></i> Back</button>
                <button
                    class="btn btn-success ms-auto"
                    ng-click="publishToYoutube(currentJobId)">
                    <i class="bi bi-check2"></i>
                    Approve &amp; Publish
                </button>
            </div>
            </div>

        </div>
        </div>
    </div>
</div>



    <div class="va-modal-backdrop " id="publishSuccessBackdrop">
        <div class="va-modal text-center" style="max-width:440px;">
            <div class="d-flex justify-content-end">
                <button class="va-modal-close" id="publishSuccessClose"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="agent-avatar online mx-auto mb-3" style="width:56px;height:56px;">
                <i class="bi bi-check-lg icon-md text-lift"></i>
            </div>
            <h2 class="font-display h5 mb-1">✅ Video Published Successfully!</h2>
            <p class="text-muted-va mb-4">Your video has been successfully published and is now live on YouTube.</p>
            <div class="d-flex flex-column gap-2">
                <a href="#" class="btn btn-primary btn-va-block"><i class="bi bi-youtube"></i> View on YouTube</a>
                <a href="jobs.html" class="btn btn-outline btn-va-block"><i class="bi bi-kanban"></i> Go to Video List</a>
                <button class="btn btn-primary " id="btnCreateNewFromSuccess"><i class="bi bi-plus-lg"></i> Create New Video</button>
            </div>
        </div>
    </div>
<!---------------BACK-END-JS------------------>
<script>
    var app = angular.module('MyApp', []);

    app.controller('MyCtrl', function($scope,$http,$timeout,$parse ,$sce) {
        $scope.avatarImages = [];
        $scope.selectedvoicetype = 'ai_voice';
        $scope.selectedAvatar = null;
        $scope.selectedAvatarId = null;
        $scope.loadingMore = false;
        $scope.hasMore = true;
        $scope.offset = 0;
        $scope.limit = 10;
        $scope.searchQuery = "";
        $scope.avatarType = "<?php echo isset($_GET['avatar_type']) ? $_GET['avatar_type'] : ''; ?>";
        
        $scope.allAudios = [];
        $scope.allLanguage = [];
        $scope.selectedVoice = null;
        $scope.selectedVoiceId = null;
        $scope.isLoading = false;
        
        $scope.playingVoiceId = null;
        $scope.selectedVoiceurl = null;
        $scope.customprompt = "";
        $scope.script = '';

        // NEW: drives step-3 "generating" state — replaces the global jsLoader() calls
        $scope.isGenerating = false;
        $scope.generatedVideoUrl = null;
        $scope.currentJobId = null;
        
        
        $scope.publishTitle = "";
        $scope.publishDescription = "";
        $scope.publishTags = [];
                
        
        $scope.createNewVideo = function () {

            window.location.href = "<?= base_url('ai-video-genration') ?>";
        
        };


        $scope.generateVideo = function (videoType) {
            var payload = { video_type: videoType };
        
            if (videoType === 'ai') {
        
                if (!$scope.script || !$scope.script.trim()) {
                    flashNow({
                        error: {
                            message: "Please enter a prompt."
                        }
                    });
                    return;
                }

                payload.script = $scope.script.trim();
        
            } else if (videoType === 'avatar') {
                var avatarName = document.getElementById('avatarName').value.trim();
        
                if (!$scope.customprompt) {
                    flashNow({ error: { message: "Please enter a script." } });
                    return;
                }
                if (!$scope.selectedAvatarId) {
                    flashNow({ error: { message: "Please select an avatar photo." } });
                    return;
                }
                if (!$scope.selectedVoiceId) {
                    flashNow({ error: { message: "Please select a voice." } });
                    return;
                }
        
                var selectedAvatarUrl = '';
                if ($scope.selectedAvatar && $scope.selectedAvatar.url) {
                    selectedAvatarUrl = $scope.selectedAvatar.url;
                } else if ($scope.selectedAvatarId) {
                    var found = $scope.avatarImages.find(function(avatar) {
                        return avatar.id == $scope.selectedAvatarId;
                    });
                    if (found && found.url) {
                        selectedAvatarUrl = found.url;
                    }
                }
        
                payload.avatar_name = avatarName;
                payload.script = $scope.customprompt;
                payload.avatar_id = $scope.selectedAvatarId;
                payload.avatar_url = selectedAvatarUrl;
                payload.voice_id = $scope.selectedVoiceId;
                payload.voice_url = $scope.selectedVoiceurl;
            }
        
            console.log('Payload being sent:', payload);
        
            // Reset any previous preview and flip the generating flag
            $scope.isGenerating = true;
            $scope.generatedVideoUrl = null;

            // Step 3 ("Generating") IS the loader now — no more jsLoader(true)
            if (window.goToStep) {
                window.goToStep(3);
            }
        
            $http({
                method: 'POST',
                url: "<?php echo base_url('ai-video-gen-process')?>",
                data: JSON.stringify(payload),
                headers: { 
                    'Content-Type': 'application/json'
                }
            }).then(function (response) {

                $scope.isGenerating = false; // no more jsLoader(false)
        
                console.log('Response received:', response);
                 

                // IMPORTANT: the real server payload is in response.data, not response itself
                var result = response.data;
                
                 console.log('result received:', result);
        
                if (result && result.status === true && result.job_id) {
                    
                    $scope.currentJobId = result.job_id;
                    
                    $scope.publishTitle = result.title || "";

                    $scope.publishDescription = result.description || "";
                    
                    $scope.publishTags = angular.isArray(result.tags)
                        ? result.tags
                        : [];

                
                  
                    if (result.video_url) {

    $scope.generatedVideoUrl = result.video_url;

    if (window.goToStep) {
        window.goToStep(4);
    }

    $timeout(function () {

        var videoIds = ["previewVideo", "previewVideo2"];

        angular.forEach(videoIds, function(id) {

            var video = document.getElementById(id);

            if (!video) {
                console.log(id + " not found");
                return;
            }

            console.log("Loading video into:", id);

            video.pause();

            video.src = result.video_url + "?t=" + new Date().getTime();

            video.load();

            video.onloadeddata = function () {

                console.log(id + " loaded");

                video.play().catch(function(err){
                    console.log(id + " autoplay blocked", err);
                });

            };

            video.onerror = function () {
                console.log(id + " error", video.error);
            };

        });

    }, 800);

}
                
                    flashNow({
                        success: {
                            message: result.message || "Video generation started successfully!"
                        }
                    });

                    // Now that we actually have a result, move to the Preview step
                    if (window.goToStep) {
                        window.goToStep(4);
                    }
                
                } else {
                
                    flashNow({
                        error: {
                            message: (result && result.message) || "Something went wrong."
                        }
                    });

                    // Send the user back to the form instead of stranding them on step 3
                    if (window.goToStep) {
                        window.goToStep(2);
                    }
                
                }
                
            }).catch(function(error) {
                $scope.isGenerating = false;
                
                console.error('Error occurred:', error);
                
                var errorMessage = "An error occurred. Please check your connection and try again.";
                if (error.data && error.data.message) {
                    errorMessage = error.data.message;
                } else if (error.statusText) {
                    errorMessage = error.statusText;
                }
                
                flashNow({ error: { message: errorMessage } });

                if (window.goToStep) {
                    window.goToStep(2);
                }
            });
        };
        
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
        
        $scope.selectVoice = function (voice) {
            $scope.selectedVoice = voice;
            $scope.selectedVoiceId = voice.sv_id;
            $scope.selectedVoiceurl = voice.sv_preview_url; 
            
        
            var player = document.getElementById('voicePreviewPlayer');
            if (player && voice.sv_preview_url) {
                player.src = voice.sv_preview_url;
                player.play();
            }
        };
        
        $scope.togglePreview = function (voice, event) {

            // Prevent the parent pill's ng-click (selectVoice) from also firing
            event.stopPropagation();
        
            var player = document.getElementById('voicePreviewPlayer');
            var previewUrl = voice.sv_preview_url_hold;
        
            if (!previewUrl) return;
        
            // If this voice is already playing, pause it
            if ($scope.playingVoiceId === voice.sv_id) {
                player.pause();
                $scope.playingVoiceId = null;
                return;
            }
        
            // Otherwise play the new one
            player.src = previewUrl;
            player.play();
            $scope.playingVoiceId = voice.sv_id;
        };
        
        // Parses "accent:american-neutral, age:middle-aged, timbre:deep, timbre:direct, ..."
        // into a tagline like "deep & direct"
        $scope.getVoiceTagline = function (voice) {
            if (!voice.sv_tag) return '';
        
            var parts = voice.sv_tag.split(',').map(function (p) { return p.trim(); });
        
            var timbres = parts
                .filter(function (p) { return p.indexOf('timbre:') === 0; })
                .map(function (p) { return p.replace('timbre:', '').replace(/-/g, ' '); });
        
            if (timbres.length >= 2) {
                return timbres[0] + ' & ' + timbres[1];
            } else if (timbres.length === 1) {
                return timbres[0];
            }
            return '';
        };
        
        document.querySelectorAll('.pill-select').forEach(function(group){
          if (group.id === 'voiceSelect') return; // Angular manages this one — skip it
          group.addEventListener('click', function(e){
            var pill = e.target.closest('.pill');
            if(!pill) return;
            group.querySelectorAll('.pill').forEach(function(p){ p.classList.remove('active'); });
            pill.classList.add('active');
          });
        });
       
        // SHOW AVTAR ------
        // Get Avatar Images
        // $scope.getAvatarImage = function() {

        //     $scope.limit = 5;   // Force only 5 records
        
        //     $scope.loadingMore = true;
        
        //     $http({
        //         method: 'POST',
        //         url: "<?php echo base_url('get-getAvatarImage')?>",
        //         data: {
        //             offset: $scope.offset,
        //             limit: $scope.limit,
        //             avtar_type: $scope.avatarType,
        //             searchQuery: $scope.searchQuery
        //         }
        //     }).then(function(response) {
        
        //         $scope.loadingMore = false;
        
        //         if (response.data.status) {
        
        //                 var rows = (response.data.avatarImage || []).slice(0, 5);

        //                 if ($scope.offset === 0) {
        //                     $scope.avatarImages = rows;
        //                 } else {
        //                     $scope.avatarImages = $scope.avatarImages.concat(rows);
        //                 }
                        
        //                 $scope.hasMore = rows.length === 5;
        //                 $scope.offset += 5;
        //         } else {
        
        //             $scope.hasMore = false;
        
        //             if ($scope.offset === 0) {
        //                 $scope.avatarImages = [];
        //             }
        //         }
        
        //     });
        // };
        
        $scope.getAvatarImage = function () {

    $scope.loadingMore = true;

    $http({
        method: 'POST',
        url: "<?php echo base_url('get-getAvatarImage')?>",
        data: {
            offset: $scope.offset,
            avtar_type: $scope.avatarType,
            searchQuery: $scope.searchQuery
        }
    }).then(function (response) {

        $scope.loadingMore = false;

        if (response.data.status) {

            var rows = response.data.avatarImage || [];

            if ($scope.offset === 0) {
                $scope.avatarImages = rows;

                // Select first avatar by default
                if (rows.length > 0) {
                    $scope.selectedAvatar = rows[0].avatar_url; // Change field if needed
                    $scope.selectedAvatarId = rows[0].id;       // Change field if needed
                }

            } else {
                $scope.avatarImages = $scope.avatarImages.concat(rows);
            }

            $scope.hasMore = rows.length > 0;
            $scope.offset += rows.length;

        } else {

            $scope.hasMore = false;

            if ($scope.offset === 0) {
                $scope.avatarImages = [];
                $scope.selectedAvatar = null;
                $scope.selectedAvatarId = null;
            }
        }

    });
};
        
        $scope.loadMore = function () {
        
            if (!$scope.hasMore)
                return;
        
            $scope.getAvatarImage();
        
        };
        
        $scope.selectAvatar = function (avatar) {
            $scope.selectedAvatar = avatar;
            $scope.selectedAvatarId = Number(avatar.id);
        
            $scope.getAvatarAudios();   
        
            if ($scope.selectAvtImage) {
                $scope.selectAvtImage(avatar);
            }
        };
        
        $scope.searchAvatars = function () {
        
            $scope.offset = 0;
            $scope.avatarImages = [];
            $scope.hasMore = true;
        
            $scope.getAvatarImage();
        
        };
        
        $scope.clearSelection = function () {
        
            $scope.selectedAvatar = null;
            $scope.selectedAvatarId = null;
        
        };
        
    //  $scope.publishToYoutube = function (job_id) {

//     if (!$scope.generatedVideoUrl) {
//         alert("Video not found.");
//         return;
//     }

//     var postData = {

//         title: "AI Generated Video",

//         description: "This video was generated using AI.",

//         tags: "AI,Artificial Intelligence,Automation,ViewAgentAI",

//         thumbnail: $scope.generatedThumbnail || "",

//         video_url: $scope.generatedVideoUrl,

//         video_cat: "22",

//         allow_embeding: "true",

//         publish_type: "true",

//         visiblity: "public",

//         schedule_date_time: "",

//         age_restriction: "false"
//     };

//     jsLoader(true);

//     $http({
//         method: "POST",
//         url: "<?php echo base_url('uploadYoutube'); ?>/" + job_id,
//         data: $.param(postData),
//         headers: {
//             "Content-Type": "application/x-www-form-urlencoded"
//         }

//     }).then(function (response) {

//         jsLoader(false);

//         console.log(response.data);

//     }).catch(function (error) {

//         jsLoader(false);

//         console.log(error);

//     });

// };

//     $scope.publishToYoutube = function (job_id) {

//     if (!$scope.generatedVideoUrl) {
//         alert("Video not found.");
//         return;
//     }

//     var postData = {
//         title: $scope.publishTitle,
//         description: $scope.publishDescription,
//         tags: $scope.publishTags,
//         // Local server path (relative to FCPATH, matching the videoPath convention),
//         // NOT a remote URL — the backend reads this straight off disk.
//         thumbnail: "assets/uploads/thumbnails/default_video_thumb.jpg",
//         job_id: job_id,
//         video_url: $scope.generatedVideoUrl,
//         video_cat: "22",
//         allow_embeding: "true",
//         publish_type: "true",
//         visiblity: "public",
//         schedule_date_time: "",
//         age_restriction: "false"
//     };

//     jsLoader(true);

//     $http({
//         method: "POST",
//         url: "<?php echo base_url('uploadYoutube'); ?>/" + job_id,
//         data: $.param(postData),
//         headers: {
//             "Content-Type": "application/x-www-form-urlencoded"
//         }
//     }).then(function (response) {

//         jsLoader(false);

//         if (response.data.status) {
//             flashNow({ success: { message: response.data.msg } });
//             $scope.youtubeVideoUrl = response.data.video_url;

//             var viewBtn = document.getElementById('viewOnYoutubeBtn');
//             if (viewBtn) viewBtn.href = response.data.video_url || '#';

//             var successBackdrop = document.getElementById('publishSuccessBackdrop');
//             if (successBackdrop) successBackdrop.classList.add('open');
//         } else {
//             flashNow({ error: { message: response.data.msg || "Publish failed." } });
//         }

//     }).catch(function (error) {
//         jsLoader(false);
//         flashNow({ error: { message: "Upload failed." } });
//     });
// };

$scope.publishToYoutube = function (job_id) {

    if (!$scope.generatedVideoUrl) {
        alert("Video not found.");
        return;
    }

    var postData = {
        title: $scope.publishTitle,
        description: $scope.publishDescription,
        video_url: $scope.generatedVideoUrl,
        tags: $scope.publishTags,
        publish_type: "true",       // "false" + schedule_date_time when scheduling
        schedule_date_time: new Date().toISOString()
    };

    jsLoader(true);

    $http({
        method: "POST",
        url: "<?php echo base_url('ai-uploadYoutube'); ?>/" + job_id,
        data: $.param(postData),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    }).then(function (response) {

        jsLoader(false);

        if (response.data.status) {
            flashNow({ success: { message: response.data.msg } });
            $scope.youtubeVideoUrl = response.data.video_url;

            var viewBtn = document.getElementById('viewOnYoutubeBtn');
            if (viewBtn) viewBtn.href = response.data.video_url || '#';

            var successBackdrop = document.getElementById('publishSuccessBackdrop');
            if (successBackdrop) successBackdrop.classList.add('open');
        } else {
            flashNow({ error: { message: response.data.msg || "Publish failed." } });
        }

    }).catch(function (error) {
        jsLoader(false);
        flashNow({ error: { message: "Upload failed." } });
    });
};

    // Add this function to your controller
    $scope.generateThumbnailFromVideo = function(videoUrl) {
    return new Promise(function(resolve, reject) {
        var video = document.createElement('video');
        video.crossOrigin = 'anonymous';
        video.src = videoUrl;
        video.currentTime = 1; // 1 second into the video
        
        video.addEventListener('loadeddata', function() {
            // Create canvas
            var canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var ctx = canvas.getContext('2d');
            
            // Draw video frame to canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            // Convert to data URL (JPEG)
            var thumbnailDataUrl = canvas.toDataURL('image/jpeg', 0.8);
            resolve(thumbnailDataUrl);
        });
        
        video.addEventListener('error', function(e) {
            reject('Failed to load video: ' + e.message);
        });
        
        // Load the video
        video.load();
    });
};

    // Alternatively, seek to the middle of the video
    $scope.generateThumbnailFromVideoSmart = function(videoUrl) {
        return new Promise(function(resolve, reject) {
            var video = document.createElement('video');
            video.crossOrigin = 'anonymous';
            video.src = videoUrl;
            
            var thumbnailGenerated = false;
            
            video.addEventListener('loadedmetadata', function() {
                // Get video duration
                var duration = video.duration;
                // Seek to 25% of video
                var seekTime = Math.min(2, duration * 0.25);
                
                video.currentTime = seekTime;
            });
            
            video.addEventListener('seeked', function() {
                if (thumbnailGenerated) return;
                thumbnailGenerated = true;
                
                var canvas = document.createElement('canvas');
                var maxWidth = 1280;
                var maxHeight = 720;
                var width = video.videoWidth;
                var height = video.videoHeight;
                
                // Resize if too large
                if (width > maxWidth) {
                    height = height * (maxWidth / width);
                    width = maxWidth;
                }
                if (height > maxHeight) {
                    width = width * (maxHeight / height);
                    height = maxHeight;
                }
                
                canvas.width = width;
                canvas.height = height;
                var ctx = canvas.getContext('2d');
                
                ctx.drawImage(video, 0, 0, width, height);
                
                // Generate thumbnail as data URL
                var thumbnailDataUrl = canvas.toDataURL('image/jpeg', 0.8);
                resolve(thumbnailDataUrl);
            });
            
            video.addEventListener('error', function(e) {
                reject('Failed to generate thumbnail: ' + e.message);
            });
            
            video.load();
        });
    };
        
        //----------------------- Get all audio ------------------------------------------------//
        $scope.getAvatarAudios = function () {

                $scope.isLoading = true;
            
                $http({
                    method: "POST",
                    url: "<?php echo base_url('get-all-audio');?>",
                    data: {
                        avatars: $scope.selectedAvatar,
                        language: $scope.selectedLanguage,
                        gender: $scope.selectedGender,
                        emotion: $scope.selectedEmotion
                    }
                }).then(function(response){
            
                    $scope.isLoading = false;
            
                    if(response.data.status){
                        // $scope.allAudios = response.data.all_audio.slice(0,5);
                        $scope.allAudios = response.data.all_audio;
                        $scope.selectedVoice = null;
                        $scope.selectedVoiceId = null;
                    } else {
                        $scope.allAudios = [];
                    }
            
                });
            
            };

        
                        
        $scope.getAvatarImage();
        $scope.getAvatarAudios();   // <-- add this
                
        
        

    });


</script>

<!---------------FRONT END JS------------------>
<script>
    (function(){
  document.addEventListener('DOMContentLoaded', function(){

    /* Sidebar open/close (mobile) */
    var shell = document.querySelector('.app-shell');
    var openBtn = document.querySelector('[data-sidebar-toggle]');
    var closeBtn = document.querySelector('[data-sidebar-close]');
    var backdrop = document.querySelector('[data-sidebar-backdrop]');

    function openSidebar(){ if(shell) shell.classList.add('sidebar-open'); }
    function closeSidebar(){ if(shell) shell.classList.remove('sidebar-open'); }

    if(openBtn) openBtn.addEventListener('click', openSidebar);
    if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if(backdrop) backdrop.addEventListener('click', closeSidebar);

    /* Close sidebar automatically when a nav link is tapped on mobile */
    document.querySelectorAll('.sidebar-nav a').forEach(function(link){
      link.addEventListener('click', closeSidebar);
    });

    /* Sidebar submenu (e.g. Lead Finder) expand/collapse */
    document.querySelectorAll('[data-expand-toggle]').forEach(function(btn){
      btn.addEventListener('click', function(){
        var group = btn.closest('.nav-expand');
        if(group) group.classList.toggle('open');
      });
    });

    /* Generic action dropdown (three-dot menu): [data-dropdown-toggle] */
    document.querySelectorAll('[data-dropdown-toggle]').forEach(function(btn){
      btn.addEventListener('click', function(e){
        e.stopPropagation();
        var dropdown = btn.closest('.va-dropdown');
        var wasOpen = dropdown.classList.contains('open');
        document.querySelectorAll('.va-dropdown.open').forEach(function(d){ d.classList.remove('open'); });
        if(!wasOpen) dropdown.classList.add('open');
      });
    });
    document.addEventListener('click', function(){
      document.querySelectorAll('.va-dropdown.open').forEach(function(d){ d.classList.remove('open'); });
    });

    /* Generic copy-to-clipboard: [data-copy-target] holds the id of an input/text to copy */
    document.querySelectorAll('[data-copy-target]').forEach(function(btn){
      btn.addEventListener('click', function(){
        var target = document.getElementById(btn.getAttribute('data-copy-target'));
        if(!target) return;
        var text = target.value || target.textContent;
        if(navigator.clipboard && navigator.clipboard.writeText){
          navigator.clipboard.writeText(text).catch(function(){});
        }
        var original = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check2"></i>';
        setTimeout(function(){ btn.innerHTML = original; }, 1200);
      });
    });

    /* Generic accordion: <div class="acc-item"><button class="acc-head">...<div class="acc-body">... */
    document.querySelectorAll('.acc-va .acc-head').forEach(function(head){
      head.addEventListener('click', function(){
        head.closest('.acc-item').classList.toggle('open');
      });
    });

    /* Generic pill-select group: click toggles .active within same parent */
    document.querySelectorAll('.pill-select').forEach(function(group){
      group.addEventListener('click', function(e){
        var pill = e.target.closest('.pill');
        if(!pill) return;
        group.querySelectorAll('.pill').forEach(function(p){ p.classList.remove('active'); });
        pill.classList.add('active');
      });
    });

    /* Generic tag-select group: each pill toggles independently */
    document.querySelectorAll('.tag-select').forEach(function(group){
      group.addEventListener('click', function(e){
        var pill = e.target.closest('.pill');
        if(!pill) return;
        pill.classList.toggle('active');
      });
    });

    /* Generic radio-card group: [data-radio-group] wraps .radio-card options */
    document.querySelectorAll('[data-radio-group]').forEach(function(group){
      group.addEventListener('click', function(e){
        var card = e.target.closest('.radio-card');
        if(!card) return;
        group.querySelectorAll('.radio-card').forEach(function(c){ c.classList.remove('active'); });
        card.classList.add('active');
      });
    });

  });
})();
</script>
<script>
    /* ViewAgent AI — AI & Avatar Video Generation wizard controller */
(function(){
  var TOTAL_STEPS = 5;
  var STEP_LABELS = {
    1: 'Choose video type',
    2: 'Video details',
    3: 'Generating video',
    4: 'Video preview',
    5: 'Publish review'
  };

  var chosenType = 'ai';

  function goToStep(n){
    document.querySelectorAll('.wizard-step').forEach(function(panel){
      panel.classList.toggle('active', Number(panel.getAttribute('data-step')) === n);
    });

    document.querySelectorAll('#stepRail .step-item').forEach(function(item){
      var num = Number(item.getAttribute('data-step-marker'));
      item.classList.remove('active', 'done');
      if(num < n) item.classList.add('done');
      if(num === n) item.classList.add('active');
    });

    var label = document.getElementById('mobileStepLabel');
    var bar = document.getElementById('mobileProgressBar');
    if(label) label.textContent = 'Step ' + n + ' of ' + TOTAL_STEPS + ' \u00B7 ' + STEP_LABELS[n];
    if(bar) bar.style.width = (n / TOTAL_STEPS * 100) + '%';

    // NOTE: step 3 no longer auto-advances to step 4 on its own.
    // It just plays the checklist animation while the real request (see
    // generateVideo() in the Angular controller) is in flight, and the
    // controller itself calls goToStep(4) once the actual API response
    // comes back with a job_id/video_url, or goToStep(2) on failure.
    if(n === 3) runBuild();

    window.scrollTo({ top: document.querySelector('.card-va').offsetTop - 100, behavior: 'smooth' });
  }

  // Expose globally so the Angular controller's generateVideo() can drive
  // the wizard steps directly (used as the "loader" instead of jsLoader()).
  window.goToStep = goToStep;

  function runBuild(){
    var heading = document.getElementById('buildHeading');
    if(heading){
      heading.textContent = chosenType === 'avatar'
        ? 'ViewAgent is building your avatar video'
        : 'ViewAgent is building your AI video';
    }
    var items = document.querySelectorAll('#buildChecklist li');
    items.forEach(function(li){
      li.querySelector('i').className = 'bi bi-circle text-muted-va me-2';
    });
    // Animate the checklist for feedback only — it does NOT navigate away.
    // The actual step 3 -> step 4 transition is driven by the real API
    // response inside $scope.generateVideo().
    items.forEach(function(li, index){
      setTimeout(function(){
        li.querySelector('i').className = 'bi bi-check-circle-fill text-lift me-2';
      }, (index + 1) * 480);
    });
  }

  function applyTypeVisibility(){
    var aiFields = document.getElementById('aiVideoFields');
    var avatarFields = document.getElementById('avatarVideoFields');
    var railTitle = document.getElementById('railStep2Title');
    var railSub = document.getElementById('railStep2Sub');

    if(chosenType === 'avatar'){
      if(aiFields) aiFields.style.display = 'none';
      if(avatarFields) avatarFields.style.display = 'block';
      if(railTitle) railTitle.textContent = 'Avatar details';
      if(railSub) railSub.textContent = 'Script, avatar &amp; voice';
    } else {
      if(aiFields) aiFields.style.display = 'block';
      if(avatarFields) avatarFields.style.display = 'none';
      if(railTitle) railTitle.textContent = 'Prompt';
      if(railSub) railSub.textContent = 'Describe your video';
    }
  }

  document.addEventListener('DOMContentLoaded', function(){

    document.querySelectorAll('[data-go-step]').forEach(function(btn){
      btn.addEventListener('click', function(){
        goToStep(Number(btn.getAttribute('data-go-step')));
      });
    });

    /* Step 1: video type selection */
    var typeGroup = document.getElementById('videoTypeGroup');
    if(typeGroup){
      typeGroup.addEventListener('click', function(e){
        var card = e.target.closest('.radio-card');
        if(!card) return;
        chosenType = card.getAttribute('data-video-type');
      });
    }

    var btnChooseType = document.getElementById('btnChooseType');
    if(btnChooseType){
      btnChooseType.addEventListener('click', function(){
        applyTypeVisibility();
        goToStep(2);
      });
    }

    /* Step 2 (avatar): tab switchers — photo (select existing / upload) and voice (select / clone) */
    document.querySelectorAll('[data-tab-group]').forEach(function(group){
      var groupName = group.getAttribute('data-tab-group');
      group.addEventListener('click', function(e){
        var pill = e.target.closest('.pill');
        if(!pill) return;
        group.querySelectorAll('.pill').forEach(function(p){ p.classList.remove('active'); });
        pill.classList.add('active');

        var tab = pill.getAttribute('data-tab');
        document.querySelectorAll('[data-tab-panel^="' + groupName + '-"]').forEach(function(panel){
          var panelTab = panel.getAttribute('data-tab-panel').split('-')[1];
          panel.style.display = (panelTab === tab) ? 'block' : 'none';
        });
      }, true);
    });

    /* NOTE: the old direct goToStep(3) click listeners on
       #btnGenerateAi / #btnGenerateAvatar have been removed.
       Those buttons use ng-click="generateVideo(...)", and it is now
       generateVideo() itself (in the Angular controller) that calls
       window.goToStep(3) when the request starts and window.goToStep(4)
       only once the real API response arrives. This keeps the wizard
       step in sync with the actual network call instead of a fixed
       timer that always advanced regardless of success/failure. */

    /* Step 5: Approve & publish -> success popup */
    var btnApprovePublish = document.getElementById('btnApprovePublish');
    var successBackdrop = document.getElementById('publishSuccessBackdrop');
    var successClose = document.getElementById('publishSuccessClose');
    if(btnApprovePublish){
      btnApprovePublish.addEventListener('click', function(){
        btnApprovePublish.disabled = true;
        btnApprovePublish.innerHTML = '<i class="bi bi-arrow-repeat"></i> Publishing\u2026';
        setTimeout(function(){
          btnApprovePublish.disabled = false;
          btnApprovePublish.innerHTML = '<i class="bi bi-check2"></i> Approve &amp; publish';
          if(successBackdrop) successBackdrop.classList.add('open');
        }, 900);
      });
    }
    if(successClose && successBackdrop){
      successClose.addEventListener('click', function(){
        successBackdrop.classList.remove('open');
      });
    }
    var btnCreateNewFromSuccess = document.getElementById('btnCreateNewFromSuccess');
    if(btnCreateNewFromSuccess){
      btnCreateNewFromSuccess.addEventListener('click', function(){
        window.location.href = 'create.html';
      });
    }

    var btnCreateAnotherFromPreview = document.getElementById('btnCreateAnotherFromPreview');
    if(btnCreateAnotherFromPreview){
      btnCreateAnotherFromPreview.addEventListener('click', function(){
        window.location.href = 'create.html';
      });
    }

  });
})();

</script>
<script>
    const words = [
        "Welcome! Please choose your video creation method.",
        "Great choice! Describe the video you want to create.",
        "Your AI video is being generated.",
        "Your video is ready!",
        "Ready to go live!.",
    ];

    const textElement = document.getElementById("text");

    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    const typingSpeed = 50;
    const deletingSpeed = 25;
    const pauseAfterTyping = 1500;
    const pauseAfterDeleting = 500;
    const stepMessages = {
        1: "Welcome! Please choose your video creation method.",
        2: "Great choice! Describe the video you want to create.",
        3: "Your AI video is being generated.",
        4: "Your video is ready!",
        5: "Ready to go live!.",
    };

function updateAgentMessage(step) {

    const textElement = document.getElementById("text");

    if (textElement && stepMessages[step]) {
        textElement.textContent = stepMessages[step];
    }

}
     function typeWriter() {
         const currentWord = words[wordIndex];

         if (!isDeleting) {
             charIndex++;
             textElement.textContent = currentWord.substring(0, charIndex);

             if (charIndex === currentWord.length) {
                 isDeleting = true;
                 setTimeout(typeWriter, pauseAfterTyping);
                 return;
             }

             setTimeout(typeWriter, typingSpeed);

         } else {
             charIndex--;
             textElement.textContent = currentWord.substring(0, charIndex);

             if (charIndex === 0) {
                 isDeleting = false;

                 wordIndex++;
                 if (wordIndex === words.length) {
                     wordIndex = 0;
                 }

                 setTimeout(typeWriter, pauseAfterDeleting);
                 return;
             }

             setTimeout(typeWriter, deletingSpeed);
         }
     }
     
//  $('#up-avatar').on('click', function () {
//     $('.avtarList').addClass('d-none');
// });
//     typeWriter();
// let upLoadtab = document.querySelector("#up-avatar");
let avtarList  =  document.querySelector(".avtarList")
let selectArea  =  document.querySelector(".pill-select")
selectArea.addEventListener('click',(e)=>{
    if(e.target.classList.contains('upAvatar')){
        avtarList.classList.add("d-none")
    }else if (e.target.classList.contains('selectAvtar')){
          avtarList.classList.remove("d-none")
    }
})
</script>