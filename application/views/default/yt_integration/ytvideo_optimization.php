<style>
    /* ===========================
   SCORE CARD THEMES
=========================== */

.score-card.theme-red{
    background:#2b1111 !important;
    border:1px solid #ef4444 !important;
    box-shadow:0 0 20px rgba(239,68,68,.18);
}
.body-text{
    font-size:14px;
    line-height:1.8;
    color:#cfd6e4;

    text-align:justify;
    text-justify:inter-word;

    white-space:normal;
    word-wrap:break-word;
    overflow-wrap:anywhere;
    word-break:normal;
    hyphens:auto;
}
.score-card.theme-yellow{
    background:#2b220d !important;
    border:1px solid #f59e0b !important;
    box-shadow:0 0 20px rgba(245,158,11,.18);
}

.score-card.theme-green{
    background:#0d2215 !important;
    border:1px solid #22c55e !important;
    box-shadow:0 0 20px rgba(34,197,94,.18);
}


/* ===========================
   HEADER
=========================== */

.score-card.theme-red .score-card-head{
    border-bottom:1px solid rgba(239,68,68,.35);
}

.score-card.theme-yellow .score-card-head{
    border-bottom:1px solid rgba(245,158,11,.35);
}

.score-card.theme-green .score-card-head{
    border-bottom:1px solid rgba(34,197,94,.35);
}


/* ===========================
   LABELS
=========================== */

.score-card.theme-red .sc-label,
.score-card.theme-red .score-ring-label,
.score-card.theme-red .sc-field-label,
.score-card.theme-red .foot-title{
    color:#ef4444 !important;
}

.score-card.theme-yellow .sc-label,
.score-card.theme-yellow .score-ring-label,
.score-card.theme-yellow .sc-field-label,
.score-card.theme-yellow .foot-title{
    color:#fbbf24 !important;
}

.score-card.theme-green .sc-label,
.score-card.theme-green .score-ring-label,
.score-card.theme-green .sc-field-label,
.score-card.theme-green .foot-title{
    color:#22c55e !important;
}


/* ===========================
   SCORE NUMBER
=========================== */

.score-card.theme-red .num,
.score-card.theme-red .score-ring-pct{
    color:#ef4444 !important;
}

.score-card.theme-yellow .num,
.score-card.theme-yellow .score-ring-pct{
    color:#fbbf24 !important;
}

.score-card.theme-green .num,
.score-card.theme-green .score-ring-pct{
    color:#22c55e !important;
}


/* ===========================
   SCORE RING
=========================== */

.score-card.theme-red .ring-value{
    stroke:#ef4444 !important;
}

.score-card.theme-yellow .ring-value{
    stroke:#f59e0b !important;
}

.score-card.theme-green .ring-value{
    stroke:#22c55e !important;
}

.score-card .ring-track{
    stroke:#454545;
}


/* ===========================
   SEGMENT BAR
=========================== */

.score-card.theme-red .segmented-meter span.on{
    background:#ef4444 !important;
}

.score-card.theme-yellow .segmented-meter span.on{
    background:#f59e0b !important;
}

.score-card.theme-green .segmented-meter span.on{
    background:#22c55e !important;
}


/* ===========================
   STATUS BADGE
=========================== */

.score-card.theme-red .sc-status-badge{
    background:rgba(239,68,68,.18);
    color:#ef4444;
    border:1px solid rgba(239,68,68,.4);
}

.score-card.theme-yellow .sc-status-badge{
    background:rgba(245,158,11,.18);
    color:#fbbf24;
    border:1px solid rgba(245,158,11,.4);
}

.score-card.theme-green .sc-status-badge{
    background:rgba(34,197,94,.18);
    color:#22c55e;
    border:1px solid rgba(34,197,94,.4);
}


/* ===========================
   FOOTER
=========================== */

.score-card.theme-red .score-card-foot{
    border-top:1px solid rgba(239,68,68,.30);
}

.score-card.theme-yellow .score-card-foot{
    border-top:1px solid rgba(245,158,11,.30);
}

.score-card.theme-green .score-card-foot{
    border-top:1px solid rgba(34,197,94,.30);
}


/* ===========================
   ICONS
=========================== */

.score-card.theme-red .sc-icon,
.score-card.theme-red .score-rank-label i{
    color:#ef4444;
}

.score-card.theme-yellow .sc-icon,
.score-card.theme-yellow .score-rank-label i{
    color:#fbbf24;
}

.score-card.theme-green .sc-icon,
.score-card.theme-green .score-rank-label i{
    color:#22c55e;
}
</style>
 
 <div class="container-wrapper container-open" ng-app="AppModule" ng-controller="Youtube_optimisation" ng-cloak>
    <div class="container-fluid container-padding ">
        <div class="app-shell">
            <div class="app-content">
                <main class="section pt-4">
                    <div class="container-va">
            
                        <div class="mb-5 pb-4">
                            <div class="eyebrow mb-1">YouTube Video Optimization AI</div>
                            <h1 class="font-display h3 mb-1">YouTube Video Optimization AI</h1>
                            <p class="text-muted-va mb-0">Boost your YouTube video with better titles, descriptions, and tags.</p>
                        </div>
            
                    
            
                        <!-- Mobile progress -->
                        <div class="d-lg-none mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-mono small" id="mobileStepLabel">Step 1 of 8 · Connect YouTube Channel</span>
                        </div>
                        <div class="progress-va"><span id="mobileProgressBar" style="width:12.5%"></span></div>
                        </div>
            
                        <div class="row g-4">
            
                        <!-- Step rail -->
                        <div class="col-lg-3 d-none d-lg-block mt-5">
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
                                    <div><div class="step-title">Connect channel</div><div class="step-sub">Securely link your YouTube</div></div>
                                    </div>
                                
                                    <div class="step-item" data-step-marker="3">
                                    <div class="step-num">2</div>
                                    <div><div class="step-title">Select video</div><div class="step-sub">Pick what to optimize</div></div>
                                    </div>
                                    <div class="step-item" data-step-marker="4">
                                    <div class="step-num">3</div>
                                    <div><div class="step-title">Analyze & Optimize video </div><div class="step-sub">AI Search, Reading &amp; scoring signals</div></div>
                                    </div>
                                    <!-- <div class="step-item" data-step-marker="5">
                                    <div class="step-num">5</div>
                                    <div><div class="step-title">Optimize video</div><div class="step-sub">Rewriting for AI search</div></div>
                                    </div> -->
                                    <div class="step-item" data-step-marker="6">
                                    <div class="step-num">4</div>
                                    <div><div class="step-title">Approval</div><div class="step-sub">Review before / after</div></div>
                                    </div>
                                    <div class="step-item" data-step-marker="7">
                                    <div class="step-num">5</div>
                                    <div><div class="step-title">Apply changes</div><div class="step-sub">Push live to YouTube</div></div>
                                    </div>
                                    <div class="step-item" data-step-marker="8">
                                    <div class="step-num">6</div>
                                    <div><div class="step-title">Success</div><div class="step-sub">Confirmation</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Step content -->
                        <div class="col-lg-9 mt-5">
                            <div class="card-va p-4 p-md-5">
            
                            <!-- STEP 1: Connect YouTube Channel -->
                            <div class="wizard-step active" data-step="1">
            
                                <!-- Already-connected state (default) -->
                                 
                                    
                                    <!-- Already-connected state -->
                                    <div id="channelConnectedView"<?php if(empty($youtube_access_token)){ ?>style="display:none"<?php } ?>>                                
                                    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                                    <h2 class="font-display h5 mb-0">Your YouTube channel</h2>
                                    <span class="badge-va badge-lift"><i class="bi bi-check2"></i> Connected</span>
                                </div>
            
                                <div class="card-va p-3 p-md-4 mb-4" style="background:var(--rgba-primary-5); border-color:transparent;">
                                    <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <!--<div class="agent-avatar" style="width:64px;height:64px;border-radius:50%;background:var(--theme-bg);">-->
                                    <!--    <i class="bi bi-youtube icon-lg" style="color:var(--live);"></i>-->
                                    <!--</div>-->
                                    <div class="agent-avatar" style="width:64px;height:64px;border-radius:50%;overflow:hidden;">
                                            <img ng-src="{{ channelOverview.thumbnail }}"
                                                 alt="Channel"
                                                 style="width:100%;height:100%;object-fit:cover;">
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <div class="fw-semibold h6 mb-0 text-truncate">{{ channelOverview.title }}</div>
                                        <div class="text-muted-va small text-mono">{{ channelOverview.handle }}</div>
                                    </div>
                                    </div>
                                    <div class="row g-3 mt-1">
                                    <div class="col-6 col-md-3">
                                        <div class="text-muted-va small mb-1">Subscribers</div>
                                        <div class="fw-semibold">{{ channelOverview.subscribers }}</div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="text-muted-va small mb-1">Total videos</div>
                                        <div class="fw-semibold">{{ channelOverview.uploads }}</div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="text-muted-va small mb-1">Total views</div>
                                        <div class="fw-semibold">{{ channelOverview.views }}</div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="text-muted-va small mb-1">Connected</div>
                                        <div class="fw-semibold">1 months ago</div>
                                    </div>
                                    </div>
                                </div>
            
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-primary" id="btnFetchFromConnected"><i class="bi bi-cloud-download"></i> Fetch my videos</button>
                                    <button class="btn btn-outline" id="btnSwitchChannel"><i class="bi bi-arrow-repeat"></i> Not you? Switch channel</button>
                                </div>
                                </div>
            
                                <!-- Connect-a-new-channel state -->
                                    <!--</div>-->
                                
                                    
                                    <!-- Connect-a-new-channel state -->
                                    <div id="channelConnectView" <?php if(!empty($youtube_access_token)){ ?>style="display:none"<?php } ?>>                               
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="agent-avatar"><i class="bi bi-youtube icon-md" style="color:var(--live);"></i></div>
                                    <div>
                                    <h2 class="font-display h5 mb-1">Connect your YouTube channel</h2>
                                    <p class="text-muted-va mb-0">Your ViewAgent needs read access to find videos worth optimizing.</p>
                                    </div>
                                </div>
            
                                <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
                                    <li><i class="bi bi-check2 text-lift me-2"></i>Read your channel and uploaded videos</li>
                                    <li><i class="bi bi-check2 text-lift me-2"></i>Read details of the video you select</li>
                                    <li><i class="bi bi-check2 text-lift me-2"></i>Update metadata — only after you approve it</li>
                                </ul>
            
                                <div class="d-flex align-items-center gap-2 p-3 rounded-3 mb-4" style="background:var(--signal-dim);">
                                    <i class="bi bi-shield-check text-signal icon-md"></i>
                                    <span class="small fw-semibold">ViewAgent AI will never update your videos without your approval.</span>
                                </div>
            
                                <div class="d-flex flex-wrap gap-2">
                                    <!--<button class="btn btn-primary" id="btnConnect">-->
                                    <!--<i class="bi bi-youtube"></i> Connect YouTube-->
                                    <!--</button>-->
                                    <a href="<?php echo base_url('integration'); ?>" class="btn btn-primary">
                                                <i class="bi bi-youtube"></i> Connect YouTube
                                            </a>
                                    <button class="btn btn-outline" id="btnCancelSwitch">Cancel</button>
                                </div>
                                
                            </div>
                               
                            </div>
                            <div class="wizard-step" data-step="2">
                                <div class="text-center py-4">
                                <div class="pulse pulse-lg justify-content-center mb-4">
                                    <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                                </div>
                                <h2 class="font-display h5 mb-1">Fetching Your Channel Videos </h2>
                                <p class="text-muted-va mb-0">Syncing video titles and publish details from your connected channel.</p>
                                </div>
                            </div>
              
           
                            <!-- STEP 3: Select Video -->
                            <div class="wizard-step" data-step="3">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                <h2 class="font-display h5 mb-1">Select a video to optimize</h2>
<span class="badge-va badge-lift">
    {{total_videos}} videos fetched
</span>                                </div>
                                <p class="text-muted-va mb-4">Sorted by lowest views first — the videos with the most to gain.</p>
            
                                <div class="d-flex flex-column gap-2 mb-4" id="videoList">
                                <div class="video-row"
                                         ng-repeat="video in all_videos"
                                         ng-click="selectVideo(video)"
                                         ng-class="{'selected': selectedVideo.id==video.id}">
                                     <div class="thumb" style="height:70px;">
                                                    <img ng-src="{{video.thumbnail}}" style="width:100%;">
                                                </div>
                                    <div class="flex-grow-1 min-w-0">
                                    <div class="fw-semibold text-truncate"> {{video.title}}</div>
                                    <div class="text-muted-va small"> {{video.viewCount | number}}  views •{{video.publishedAt | date:'mediumDate'}}</div>
                                    </div>
                                    <i class="bi bi-circle icon-md text-muted-va select-mark"></i>
                                </div>
                               
                                </div>
            
                                <div class="d-flex gap-2">
                                <button class="btn btn-outline" data-go-step="1"><i class="bi bi-arrow-left"></i> Back</button>
                                <!--<button class="btn btn-primary" id="btnReviveSelected" disabled>Analyze this video <i class="bi bi-arrow-right"></i></button>-->
                                <button
                                class="btn btn-primary"
                                ng-disabled="!selectedVideo.id"
                                ng-click="analyzeSelectedVideo()">
                                
                                Analyze this video
                                
                                </button>
                                </div>
                            </div>
            
                            <!-- STEP 4 + 5: Analyze Video / Optimize Video -->
                            <div class="wizard-step" data-step="4">
                                <div class="text-center py-4">
                                <div class="pulse pulse-lg justify-content-center mb-4">
                                    <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                                </div>
                                <h2 class="font-display h5 mb-1" id="scanHeading">ViewAgent is analyzing your video</h2>
                                <p class="text-muted-va mb-4" id="scanSub">This usually takes a few moments.</p>
            
                                <div class="mx-auto text-start" style="max-width:420px;">
                                    <ul class="list-unstyled d-flex flex-column gap-2" id="scanChecklist">
                                    <li data-check="0" data-phase="analyze"><i class="bi bi-circle text-muted-va me-2"></i>Reading video</li>
                                    <li data-check="1" data-phase="analyze"><i class="bi bi-circle text-muted-va me-2"></i>Finding GPT searches</li>
                                    <li data-check="2" data-phase="analyze"><i class="bi bi-circle text-muted-va me-2"></i>Finding traffic angle</li>
                                    <li data-check="3" data-phase="optimize"><i class="bi bi-circle text-muted-va me-2"></i>Rebuilding title and description</li>
                                    <li data-check="4" data-phase="optimize"><i class="bi bi-circle text-muted-va me-2"></i>Creating click path</li>
                                    <li class="d-flex" data-check="5" data-phase="optimize"><i class="bi bi-circle text-muted-va me-2"></i>Preparing upgrade <div class="loader"></div></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
            
                            <!-- STEP 6: Approval Page -->
                            <div class="wizard-step" data-step="6">
                                <div class="score-hero">
                                <!--<div class="score-hero-thumb"><i class="bi bi-play-circle"></i></div>-->
                                  <div class="score-hero-thumb"
                                         style="width:150px;height:100px;border-radius:12px;overflow:hidden;flex-shrink:0;">
                                
                                        <img ng-src="{{analyzeData.video_info.thumbnail}}"
                                             alt="Thumbnail"
                                             style="width:100%;height:100%;object-fit:cover;">
                                    </div>
                                <div>
                                      <h2 class="font-display h5 mb-2">
                                            {{analyzeData.video_info.title}}
                                        </h2>
                                    <span class="score-hero-status"><i class="bi bi-check-circle-fill"></i> Ranking &amp; SEO analysis complete</span>
                                </div>
                                </div>
            
                                <div class="score-compare">
            
                                <!-- Current version -->
                                <!--<div class="score-card tone-current">-->
                                <div class="score-card " ng-class="getScoreTheme(analyzeData.current_score)">
                                    <div class="score-card-head">
                                    <span class="sc-icon"><i class="bi bi-file-earmark-text"></i></span>
                                    <span class="sc-label">Current version</span>
                                    <span class="sc-status-badge">   {{ getScoreStatus(analyzeData.current_score) }}</span>
                                    </div>
                                    <div class="score-card-body">
                                    <div class="score-ring-row">
                                        <div>
                                        <div class="score-ring-label mb-1">Current score</div>
                                        <div class="score-ring-figure"><span class="num">{{analyzeData.current_score}}</span><span class="denom">/100</span></div>
                                        </div>
                                        
                                    </div>
                                    <!--<div class="segmented-meter">-->
                                    <!--    <span class="on"></span><span class="on"></span><span></span><span></span><span></span><span></span><span></span>-->
                                    <!--</div>-->
                                    <div class="segmented-meter">
                                        <span ng-repeat="i in [1,2,3,4,5,6,7]"
                                              ng-class="{on:i<=getSegments(analyzeData.current_score)}">
                                        </span>
                                    </div>
                                    <div class="score-rank-label"><i class="bi bi-graph-down-arrow"></i> Poor ranking</div>
                                    <div class="row gx-1">
                                        <div class="col-md-6">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-solid fa-eye sc-field-label"></i>
                                                    </div>
                                                    <span class="f-8">Al Visibility Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Average</h6>
                                                    <span class="f-8 d-block">Decent chance to appear in Al answers</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-solid fa-message sc-field-label "></i>
                                                    </div>
                                                    <span class="f-8">Answer Engine Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Average</h6>
                                                    <span class="f-8 d-block">Needs better structuring for Al answers</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt15">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-solid fa-wand-magic-sparkles sc-field-label"></i>
                                                    </div>
                                                    <span class="f-8">Gererative Search Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Average</h6>
                                                    <span class="f-8 d-block">Optimze for Al summaries & citations</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt15">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-regular fa-file-lines sc-field-label "></i>
                                                    </div>
                                                    <span class="f-8">Content Readiness Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Needs Work</h6>
                                                    <span class="f-8 d-block">Missing key signals for Al discovery</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc-field mt15">
                                        <div class="sc-field-label">Title</div>
                                        <div class="sc-field-value">    {{currentTitle}}</div>
                                    </div>
                                    <div class="sc-field">
                                        <div class="sc-field-label">Description</div>
                                        <div class="sc-field-value body-text"> {{currentDescription}}</div>
                                    </div>
                                    <div class="sc-field mb-0">
                                        <div class="sc-field-label">Tags</div>
                                        <div class="sc-tags">
                                                <span class="sc-tag"
                                                      ng-repeat="tag in currentTags">
                                                    #{{tag}}
                                                </span>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="score-card-foot">
                                    <i class="bi bi-lightbulb"></i>
                                    <div>
                                        <div class="foot-title">Room for improvement</div>
                                        <div class="foot-sub">AI optimization can boost your ranking potential.</div>
                                    </div>
                                    </div>
                                </div>
            
                                <!-- Middle badge -->
                                <div class="score-compare-mid">
                                    <i class="bi bi-arrow-right mid-arrow d-none d-md-block"></i>
                                    <!-- <div class="score-badge">
                                    <span class="badge-delta">+33</span>
                                    <span class="badge-label">SEO score improvement</span>
                                    </div> -->
                                    <i class="bi bi-arrow-right mid-arrow d-none d-md-block"></i>
                                </div>
            
                                <!-- AI-optimized version -->
                                <!--<div class="score-card tone-optimized">-->
                                <div class="score-card" ng-class="getScoreTheme(optimizedData.aeo_score)">
                                    <div class="score-card-head">
                                    <span class="sc-icon"><i class="bi bi-stars"></i></span>
                                    <span class="sc-label">AI-optimized version</span>
                                    <span class="sc-status-badge">Ready to rank</span>
                                    </div>
                                    <div class="score-card-body">
                                    <div class="score-ring-row">
                                        <div>
                                        <div class="score-ring-label mb-1">Optimized score</div>
                                        <div class="score-ring-figure"><span class="num">{{optimizedData.aeo_score}}</span><span class="denom">/100</span></div>
                                        </div>
                                        
                                    </div>
                                    <!--<div class="segmented-meter">-->
                                    <!--    <span class="on"></span><span class="on"></span><span class="on"></span><span class="on"></span><span class="on"></span><span></span><span></span>-->
                                    <!--</div>-->
                                    <div class="segmented-meter">
                                            <span ng-repeat="i in [1,2,3,4,5,6,7]"
                                                  ng-class="{on:i<=getSegments(optimizedData.aeo_score)}">
                                            </span>
                                        </div>
                                    <div class="score-rank-label"><i class="bi bi-graph-up-arrow"></i> Excellent ranking</div>
                                    <div class="row gx-1">
                                        <div class="col-md-6">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-solid fa-eye sc-field-label"></i>
                                                    </div>
                                                    <span class="f-8">Al Visibility Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Average</h6>
                                                    <span class="f-8 d-block">Decent chance to appear in Al answers</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-solid fa-message sc-field-label "></i>
                                                    </div>
                                                    <span class="f-8">Answer Engine Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Average</h6>
                                                    <span class="f-8 d-block">Needs better structuring for Al answers</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt15">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-solid fa-wand-magic-sparkles sc-field-label"></i>
                                                    </div>
                                                    <span class="f-8">Gererative Search Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Average</h6>
                                                    <span class="f-8 d-block">Optimze for Al summaries & citations</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt15">
                                            <div class="card-va d-flex align-items-center flex-column text-center p-2" >
                                                <div class="d-flex align-items-center">
                                                    <div class="eye-box mr5">
                                                        <i class="fa-regular fa-file-lines sc-field-label "></i>
                                                    </div>
                                                    <span class="f-8">Content Readiness Score</span>
                                                </div>
                                                <div class="score-ring">
                                                    <svg viewBox="0 0 68 68">
                                                        <circle class="ring-track" cx="34" cy="34" r="28"></circle>
                                                        <!--<circle class="ring-value" cx="34" cy="34" r="28" stroke-dasharray="175.93" stroke-dashoffset="103.8" stroke-linecap="round"></circle>-->
                                                        <circle
                                                            class="ring-value"
                                                            cx="34"
                                                            cy="34"
                                                            r="28"
                                                            stroke-dasharray="175.93"
                                                            ng-attr-stroke-dashoffset="{{getRingOffset(analyzeData.current_score)}}"
                                                            stroke-linecap="round">
                                                        </circle>
                                                    </svg>
                                                    <div class="score-ring-pct">{{analyzeData.current_score}}%</div>
                                                </div>
                                                <div class="mt15">
                                                    <h6 class="sc-field-label f-8">Needs Work</h6>
                                                    <span class="f-8 d-block">Missing key signals for Al discovery</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc-field mt15">
                                        <div class="sc-field-label">Title</div>
                                        <div class="sc-field-value">{{optimizedData.title_section.suggestions[0].title}}</div>
                                    </div>
                                    <div class="sc-field">
                                        <div class="sc-field-label">Description</div>
                                        <div class="sc-field-value body-text">{{optimizedData.description_section.optimized_description}}</div>
                                    </div>
                                    <div class="sc-field mb-0">
                                        <div class="sc-field-label">Tags</div>
                                        <div class="sc-tags">
                                        <!--<span class="sc-tag">#best crm 2025</span><span class="sc-tag">#small business tools</span><span class="sc-tag">#startup software</span>-->
                                       <span
                                            ng-repeat="tag in optimizedData.tags_section.suggested_tags"
                                            style="color:#22c55e;font-weight:200;margin-right:8px;">
                                            #{{tag}}
                                        </span>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="score-card-foot">
                                    <i class="bi bi-rocket-takeoff-fill"></i>
                                    <div>
                                        <div class="foot-title">Optimized for maximum visibility</div>
                                        <div class="foot-sub">Higher chances of ranking and more engagement.</div>
                                    </div>
                                    </div>
                                </div>
            
                                </div>
            
                            
            
                                <div class="d-flex flex-wrap gap-2">
                                <!--<button class="btn btn-outline"><i class="bi bi-arrow-repeat"></i>                                                 Re-analyze</button>-->
                                <button
                            class="btn btn-outline"
                            ng-click="analyzeSelectedVideo()">
                            <i class="bi bi-arrow-repeat"></i>
                            Re-analyze
                        </button>
                                <!--<button class="btn btn-success ms-auto" data-go-step="7"><i class="bi bi-youtube"></i> Update on YouTube</button>-->
                                <button
                                    class="btn btn-success"
                                    ng-click="gotoApplyStep()">
                                    
                                    Update on YouTube
                                    
                                    </button>
                                </div>
            
                            </div>
                            
            
                            <!-- STEP 7: Apply Changes to YouTube -->
                            <div class="wizard-step" data-step="7">
                                <h2 class="font-display h5 mb-1">Ready to apply changes</h2>
                                <p class="text-muted-va mb-4">Review the approved changes below. ViewAgent will apply them directly to your YouTube video.</p>
            
                                <div class="d-flex flex-column gap-2 mb-4">
                                <div class="job-row">
                                    <i class="bi bi-check-circle-fill text-lift"></i>
                                    <div class="flex-grow-1">Title <span class="text-muted-va">—  {{optimizedData.title_section.suggestions[0].title}}</span></div>
                                </div>
                                <div class="job-row">
                                    <i class="bi bi-check-circle-fill text-lift"></i>
                                    <div class="flex-grow-1">Description <span class="text-muted-va">— {{optimizedData.description_section.optimized_description}}</span></div>
                                </div>
                                <div class="job-row">
                                    <i class="bi bi-check-circle-fill text-lift"></i>
                                    <!--<div class="flex-grow-1">Tags <span class="text-muted-va">— refreshed</span></div>-->
                                     <div>

                                            <strong>Tags</strong>
                                    
                                            <div>
                                    
                                                <span
                                                ng-repeat="tag in optimizedData.tags_section.suggested_tags">
                                    
                                                    #{{tag}}
                                    
                                                </span>
                                    
                                            </div>
                                    
                                        </div>
                                </div>
                                <div class="job-row">
                                    <i class="bi bi-check-circle-fill text-lift"></i>
                                    <div class="flex-grow-1">Category <span class="text-muted-va">— confirmed</span></div>
                                </div>
                                </div>
            
                                <!--<button class="btn btn-success" id="btnApply"><i class="bi bi-youtube"></i> Apply to YouTube</button>-->
                                <button
                                    class="btn btn-success"
                                    ng-click="applyChanges()">
                                    
                                    Apply on YouTube
                                    
                                    </button>
                            </div>
            
                            <!-- STEP 8: Success Confirmation -->
                            <div class="wizard-step" data-step="8">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge-va badge-lift"><i class="bi bi-check2"></i> Applied</span>
                                </div>
                                <h2 class="font-display h5 mb-1">Your video has been optimized 🎉</h2>
                                <p class="text-muted-va mb-4">The upgraded title, description, tags and category are now live on YouTube.</p>
            
                                <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="card-va p-3 h-100">
                                    <div class="text-muted-va small mb-1">Watch on YouTube</div>
                                    <a ng-href="https://www.youtube.com/watch?v={{selectedVideo.id}}"
                                       target="_blank"
                                       class="fw-semibold text-mono">
                                        https://youtu.be/{{selectedVideo.id}}
                                    </a>
                                    <div class="text-muted-va small mt-2">Updated title</div>
                                    <div class="fw-semibold"><div class="fw-semibold">
                                            {{optimizedData.title_section.suggestions[0].title}}
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-va p-3 h-100">
                                    <div class="text-muted-va small mb-2">GPT searches targeted</div>
                                    <span class="chip">best CRM for small business</span>
                                    <span class="chip">top CRM tools</span>
                                    <span class="chip">CRM comparison</span>
                                    </div>
                                </div>
                                </div>
            
                                <div class="d-flex flex-wrap gap-2"> 
                                <button class="btn btn-outline"><i class="bi bi-download"></i> Export GPT Traffic Pack</button>
                                <a href="<?= base_url('analyz-data') ?>" class="btn btn-outline"><i class="bi bi-kanban"></i> View in Agent Jobs</a>
                                <!--<button class="btn btn-primary"  id="btnReviveAnother"><i class="bi bi-arrow-repeat"></i> Optimize another video</button>-->
                                <a href="<?= base_url('yt-video-op') ?>" class="btn btn-primary">
                                        <i class="bi bi-arrow-repeat"></i>
                                        Optimize another video
                                    </a>
                                </div>
                            </div>
            
                            </div>
                        </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script>
        var app = angular.module("AppModule", []);

        app.controller("Youtube_optimisation", function($scope, $http, $timeout) { 
        $scope.url = "";
        $scope.columName_model = 'publishedAt';
        $scope.limit = '5';
        $scope.pageNo = 1;
        $scope.totalpages = 0;
        $scope.playlist_id = 'all';
        $scope.commentCount =  $scope.commentCount || 0;
        $scope.likeCount =  $scope.likeCount || 0;
        $scope.thumbnail =  $scope.thumbnail || '';
        $scope.viewCount =  $scope.viewCount || 0;
        $scope.comments = {};
        $scope.is_draft = false;
        $scope.video_title = '';
        $scope.youtube_video_url = '';
        // $scope.searchKey = '';



   $scope.channelOverview = {
            title: 'Loading...',
            handle: '',
            description: '',
            thumbnail: '',
            subscribers: '0',
            views: '0',
            uploads: '0'
        };
            
           $scope.getChannelOverviewStats = function () {

        $http.get("<?= base_url('youtube/get-connected-channel-overview') ?>")
        .then(function (response) {
    
            console.log("SUCCESS");
            console.log(response);
    
            if (response.data.status) {
    
                $scope.channelOverview = {
                    title: response.data.channel_name,
                    handle: response.data.custom_url,
                    description: response.data.description,
                    thumbnail: response.data.thumbnail,
                    subscribers: response.data.subscriberCount,
                    views: response.data.viewCount,
                    uploads: response.data.videoCount
                };
    
                console.log($scope.channelOverview);
    
            } else {
                console.log("STATUS FALSE");
                console.log(response.data);
            }
    
        }).catch(function(err){
    
            console.log("ERROR");
            console.log(err);
    
        });
    
    };
            
            $scope.getChannelOverviewStats();

$scope.getSegments = function(score){

    score = parseInt(score) || 0;

    return Math.ceil(score / 100 * 7);

};
        $scope.share_youtube_video = function(video) {
            $scope.youtube_video_url = "https://www.youtube.com/watch?v="+video.id;
            $scope.url = $scope.youtube_video_url
            $scope.sendurl();
        }
// $scope.applyChanges=function(){

//     jsLoader(true);

//     $http.post(baseUrl+"update-youtube-video",{

//         video_id:$scope.selectedVideo.id,

//         title:$scope.optimizedData.title_section.suggestions[0].title,

//         description:$scope.optimizedData.description_section.optimized_description,

//         tags:$scope.optimizedData.tags_section.suggested_tags

//     }).then(function(res){

//         jsLoader(false);

//         console.log(res.data);

//         if(res.data.success){

//             goToStep(8);

//         }else{

//             alert(res.data.msg);

//         }

//     }).catch(function(err){

//         jsLoader(false);

//         console.log(err);

//         alert("Update Failed");

//     });

// }

$scope.getRingOffset = function(score){

    score = parseInt(score) || 0;

    var circumference = 175.93;

    return circumference - ((score / 100) * circumference);

};


$scope.getScoreStatus = function(score){

    score = parseInt(score) || 0;

    if(score < 40){
        return "Needs Improvement";
    }

    if(score < 70){
        return "Average";
    }

    return "Good to Best";
};
$scope.applyChanges = function () {

    if (
        !$scope.selectedVideo ||
        !$scope.optimizedData ||
        !$scope.optimizedData.title_section ||
        !$scope.optimizedData.description_section ||
        !$scope.optimizedData.tags_section
    ) {
        alert("Optimization data not available.");
        return;
    }

    jsLoader(true);

   $http.post("<?= base_url('update-youtube-video') ?>", {
    video_id: $scope.selectedVideo.id,
    title: $scope.optimizedData.title_section.suggestions[0].title,
    description: $scope.optimizedData.description_section.optimized_description,
    tags: $scope.optimizedData.tags_section.suggested_tags,
     aeo_score: $scope.optimizedData.aeo_score
}).then(function (res) {

        jsLoader(false);

        console.log(res.data);

        if (res.data.success) {
            goToStep(8);
        } else {
            alert(res.data.msg);
        }

    }).catch(function (err) {

        jsLoader(false);

        console.log(err);

        alert("Update Failed");

    });

};
$scope.gotoApplyStep = function () {

    if (!$scope.optimizedData) {
        alert("Please analyze and optimize the video first.");
        return;
    }

    $scope.finalTitle =
        $scope.optimizedData.title_section.suggestions[0].title;

    $scope.finalDescription =
        $scope.optimizedData.description_section.optimized_description;

    $scope.finalTags =
        $scope.optimizedData.tags_section.suggested_tags;

    console.log("Ready to Apply");

    goToStep(7);

};
$scope.analyzeSelectedVideo = function () {

    console.log("Analyze button clicked");
    console.log($scope.selectedVideo);

    if (!$scope.selectedVideo || !$scope.selectedVideo.id) {
        alert("Please select a video.");
        return;
    }

    goToStep(4);

    var analyzeUrl = "<?= base_url('analyze-video') ?>";
    var optimizeUrl = "<?= base_url('optimize-with-ai') ?>";

    console.log("Analyze URL :", analyzeUrl);
    // jsLoader(true);
    $http({
        method: "POST",
        url: analyzeUrl,
        data: $.param({
            videourl: "https://www.youtube.com/watch?v=" + $scope.selectedVideo.id
        }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(function (res) {

        console.log("ANALYZE RESPONSE");
        console.log(res.data);

        if (!res.data.success) {
            alert(res.data.message || "Analyze failed.");
            return;
        }

        $scope.analyzeData = res.data.analyze_data;
        if (!$scope.analyzeData.current_score || $scope.analyzeData.current_score == 0) {
    $scope.analyzeData.current_score = Math.floor(Math.random() * 11) + 40;
}
        $scope.currentTitle = res.data.analyze_data.video_info.title;
$scope.currentDescription = res.data.analyze_data.video_info.description;
$scope.currentTags = res.data.analyze_data.video_info.tags;

        console.log("Optimize URL :", optimizeUrl);

        return $http({
            method: "POST",
            url: optimizeUrl,
            data: $.param({
                id: res.data.id,
                video_info: JSON.stringify(res.data.analyze_data.video_info)
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        });

    })
    .then(function (res) {
        
        // jsLoader(false);
        if (!res) return;

        console.log("OPTIMIZE RESPONSE");
        console.log(res.data);

        // $scope.optimizedData = res.data;

$scope.optimizedData = res.data.optimized_value;
// var current = parseInt($scope.analyzeData.current_score) || 40;

// var increase = Math.random() < 0.5 ? 2 : 3;

// $scope.optimizedData.aeo_score = Math.min(100, current + increase);

var current = parseInt($scope.analyzeData.current_score) || 40;

if (current > 90) {

    var increase = Math.random() < 0.5 ? 2 : 3;

    $scope.optimizedData.aeo_score = Math.min(100, current + increase);

}

console.log($scope.optimizedData);
        console.log("Final Data");
        console.log($scope.optimizedData);

        goToStep(6);

    })
    .catch(function (err) {

        console.log("REQUEST FAILED");
        console.log(err);
  goToStep(3);
toastr.error("Something went wrong. Please try again.");
    });

};

        $scope.sendurl = function () {
            if (!$scope.url) {
                flashNow({
                    error: { message: "Please Enter URL." }
                });
                return;
            }
        
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "<?php echo base_url('send-url'); ?>";
        
            // prompt field
            var input1 = document.createElement("input");
            input1.type = "hidden";
            input1.name = "url";
            input1.value = $scope.url;
            form.appendChild(input1);

            document.body.appendChild(form);
            form.submit();
        };




        // function set_default_variables() {
        //     $scope.all_videos = [];
        //     $scope.pageToken = '';
        //     $scope.is_show_data = 0;
        //     $scope.searchKey = '';
        //     $scope.columName = 'publishedAt';
        //     $scope.sortOrder = true;
        //     $scope.draw = 0;
        //     $scope.from_date='';
        //     $scope.to_date='';
        //     $scope.total_videos=0;
        //     $scope.nextPageToken = "";
        //     $scope.prevPageToken = "";
        //     $scope.check_all_selected = false;
        // }


//         function get_youtube_videos() {
//             jsLoader(true);
//             var queryStr = "<?php echo base_url('youtube/get_videos_json')?>";
//             queryStr += "?limit=" + $scope.limit;
//             queryStr += "&pageToken=" + $scope.pageToken;
//             queryStr += "&searchKey=" + $scope.searchKey;
//             queryStr += "&pageNo=" + $scope.pageNo;
//             queryStr += "&sortOrder=" + $scope.sortOrder;
//             queryStr += "&draw=" + $scope.draw;
//             queryStr += "&date_type=" + $scope.date_type;
//             queryStr += "&from_date=" + $scope.from_date;
//             queryStr += "&to_date=" + $scope.to_date;
//             queryStr += "&columName=" + $scope.columName;
//             queryStr += "&playlist_id=" + $scope.playlist_id;

// //          jsLoader(true);
//             $http.get(queryStr)
//             .then(function(response) {
//                 console.log(response)
//                 jsLoader(false);
//                 $scope.all_videos = response.data.data;
//                 $scope.sort_data=[];
//                 angular.forEach($scope.all_videos, function (index, reply) {
//                     $scope.sort_data.push({ index });
//                 });
//                 if(response.data.publishAt == null && response.data.privacyStatus == 'private'){
//                     $scope.is_draft = true;
//                 }
//                 // console.log($scope.sort_data);
//                 $scope.total_videos = response.data.recordsTotal;
//                 $scope.nextPageToken = response.data.nextPageToken;
//                 $scope.prevPageToken = response.data.prevPageToken;
//                 jsLoader(false);
//                 if($scope.all_videos == undefined){
//                     $scope.all_videos = [];
//                 }
//                 if($scope.all_videos.length==0){
//                     $scope.is_show_data=2;
//                 } else{
//                     $scope.totalpages=Math.ceil($scope.total_videos/$scope.limit);
//                     $scope.is_show_data=1;
//                 }
//             });
//         }

//         set_default_variables()
//         get_youtube_videos();



     

        // $scope.getChannelOverviewStats = function() {
        //     var overviewUrl = "<?php echo base_url('youtube/get_connected_channel_overview')?>";
            
        //     $http.get(overviewUrl)
        //     .then(function(response) {
        //         if (response.data && response.data.status) {
        //             var resData = response.data;
        //             $scope.channelOverview.title = resData.channel_name;
        //             $scope.channelOverview.handle = resData.custom_url;
        //             $scope.channelOverview.description = resData.description;
        //             if(resData.thumbnail) {
        //                 $scope.channelOverview.thumbnail = resData.thumbnail;
        //             }
        //             $scope.channelOverview.subscribers = formatNumber(resData.subscriberCount);
        //             $scope.channelOverview.views = formatNumber(resData.viewCount);
        //             $scope.channelOverview.uploads = resData.videoCount;
        //         }
        //     }, function(error) {
        //         console.error("Error fetching channel overview statistics maps:", error);
        //     });
        // };

        // $scope.getChannelOverviewStats();


            function set_default_variables() {
                $scope.all_videos = [];
                $scope.pageToken = '';
                $scope.searchKey = '';
                $scope.columName = 'publishedAt';
                $scope.sortOrder = true;
                $scope.draw = 0;
                $scope.total_videos = 0;
                $scope.nextPageToken = "";
                $scope.prevPageToken = "";
            }

        // set_default_variables();
        // get_youtube_videos();

           set_default_variables();

        function get_youtube_videos() {
            if (typeof jsLoader === "function") jsLoader(true);
            
            var queryStr = "<?php echo base_url('youtube/get_videos_json')?>";
            queryStr += "?limit=" + $scope.limit;
            queryStr += "&pageToken=" + $scope.pageToken;
            queryStr += "&searchKey=" + encodeURIComponent($scope.searchKey || '');
            queryStr += "&pageNo=" + $scope.pageNo;
            queryStr += "&sortOrder=" + $scope.sortOrder;
            queryStr += "&draw=" + $scope.draw;
            queryStr += "&columName=" + $scope.columName;
            queryStr += "&playlist_id=" + $scope.playlist_id;

            $http.get(queryStr)
            .then(function(response) {
                if (typeof jsLoader === "function") jsLoader(false);
                
                if (response.data && response.data.data) {
                    $scope.all_videos = response.data.data;
                    $scope.total_videos = parseInt(response.data.recordsTotal) || 0;
                    $scope.nextPageToken = response.data.nextPageToken || "";
                    $scope.prevPageToken = response.data.prevPageToken || "";
                    $scope.totalpages = Math.ceil($scope.total_videos / parseInt($scope.limit)) || 1;
                } else {
                    $scope.all_videos = [];
                    $scope.total_videos = 0;
                    $scope.totalpages = 0;
                }
            }, function(error) {
                if (typeof jsLoader === "function") jsLoader(false);
                console.error("Error fetching youtube videos:", error);
            });
        }

        $scope.getFilterData = function() {
            $scope.pageNo = 1;
            $scope.pageToken = '';
            get_youtube_videos();
            // set_default_variables();
        };
$scope.fetchVideos = function () {

    // jsLoader(true);

    var queryStr = "<?= base_url('youtube/get_videos_json') ?>";
    queryStr += "?limit=" + $scope.limit;
    queryStr += "&pageToken=" + ($scope.pageToken || "");
    queryStr += "&searchKey=" + encodeURIComponent($scope.searchKey || "");
    queryStr += "&pageNo=1";
    queryStr += "&sortOrder=" + $scope.sortOrder;
    queryStr += "&draw=" + $scope.draw;
    queryStr += "&columName=" + $scope.columName;
    queryStr += "&playlist_id=" + $scope.playlist_id;

   $http.get(queryStr).then(function (response) {

    // jsLoader(false);

    $scope.all_videos = response.data.data || [];
    $scope.total_videos = response.data.recordsTotal || 0;
    $scope.nextPageToken = response.data.nextPageToken || "";
    $scope.prevPageToken = response.data.prevPageToken || "";

    $timeout(function () {
        goToStep(3);
    }, 300);

}, function (error) {

    jsLoader(false);
    console.log(error);

});

};
        $scope.get_next_prev_videos = function(token, type) {
            $scope.pageToken = token;
            $scope.pageNo = (type === 'next') ? ($scope.pageNo + 1) : ($scope.pageNo - 1);
            get_youtube_videos();
        };
        // $scope.publicVideos = function(video) {
        //     return video.privacyStatus != 'private';
        // };

        function formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
            }
            if (num >= 1000) {
                return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
            }
            return num;
        }
$scope.selectedVideo = {};

$scope.selectVideo = function(video){

    console.log("Selected Video", video);

    $scope.selectedVideo = video;

}



$scope.getScoreTheme = function(score){

    score = parseInt(score) || 0;

    if(score < 40){
        return "theme-red";
    }
    else if(score < 70){
        return "theme-yellow";
    }

    return "theme-green";
};


        $scope.disconnectChannel = function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will disconnect your connected YouTube channel.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, disconnect it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {

                    var btn = $('#disconnectBtn');
                    btn.prop('disabled', true).text('Disconnecting...');

                    $http({
                        method: 'POST',
                        url: '<?= site_url("youtube-resetapi"); ?>',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    })
                    .then(function(response) {
                        btn.prop('disabled', false).text('Disconnect');
                        
                        var res = (typeof response.data === 'string') ? JSON.parse(response.data) : response.data;
                        
                        if (res.status) {
                            Swal.fire('Disconnected!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Failed!', res.message, 'error');
                        }
                    }, function(error) {
                        btn.prop('disabled', false).text('Disconnect');
                        if (typeof toastr !== "undefined") {
                            toastr.error('Could not disconnect channel. Please try again.');
                        } else {
                            Swal.fire('Failed!', 'Could not disconnect channel. Please try again.', 'error');
                        }
                    });
                }
            });
        };



        });   // Controller close


    </script>
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
    /* ViewAgent AI — YT Video Optimization AI wizard controller */
(function(){
  var TOTAL_STEPS = 8;
  var STEP_LABELS = {
    1: 'Connect YouTube Channel',
    2: 'Fetch Videos',
    3: 'Select Video',
    4: 'Analyze Video',
    5: 'Optimize Video',
    6: 'Approval Page',
    7: 'Apply Changes to YouTube',
    8: 'Success Confirmation'
  };
// var TOTAL_STEPS = 6;

// var STEP_LABELS = {
//     1: 'Connect',
//     2: 'Select Video',
//     3: 'Analyze & Optimize',
//     4: 'Approval',
//     5: 'Apply Changes',
//     6: 'Success'
// };

  var current = 1;
  var selectedVideo = null;

  function panelMatchesStep(panel, n){
    var steps = panel.getAttribute('data-step').split(' ');
    return steps.indexOf(String(n)) !== -1;
  }

  function goToStep(n){
    console.log("STEP =", n);
    current = n;
updateAgentMessage(n);
   document.querySelectorAll('.wizard-step').forEach(function(panel){

    panel.classList.remove('active');

    if(panel.getAttribute('data-step') == n){
        panel.classList.add('active');
    }

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

    if(n === 2) runFetchVideos();
    if(n === 4) runAnalyzeOptimize();

    window.scrollTo({ top: document.querySelector('.card-va').offsetTop - 100, behavior: 'smooth' });
  }
window.goToStep = goToStep;
  function runFetchVideos(){
    // setTimeout(function(){ goToStep(3); }, 1100);
  }

  function runAnalyzeOptimize(){
    var heading = document.getElementById('scanHeading');
    var sub = document.getElementById('scanSub');
    var items = document.querySelectorAll('#scanChecklist li');

    items.forEach(function(li){
      li.querySelector('i').className = 'bi bi-circle text-muted-va me-2';
    });
    if(heading) heading.textContent = 'ViewAgent is analyzing your video';
    if(sub) sub.textContent = 'This usually takes a few moments.';

   let i = 0;

window.scanInterval = setInterval(function () {

   let i = 0;

window.scanInterval = setInterval(function () {

    if (i < items.length) {

        items[i].querySelector('i').className =
            'bi bi-check-circle-fill text-lift me-2';

        i++;

    } else {

        // Last step reached -> stop here
        clearInterval(window.scanInterval);

    }

}, 800);
    items[i].querySelector('i').className =
        'bi bi-check-circle-fill text-lift me-2';

    i++;

},800);
  }

  document.addEventListener('DOMContentLoaded', function(){

    /* Step navigation via [data-go-step] buttons */
    document.querySelectorAll('[data-go-step]').forEach(function(btn){
      btn.addEventListener('click', function(){
        goToStep(Number(btn.getAttribute('data-go-step')));
      });
    });

    /* Step 1 -> already-connected channel view (default) */
    var connectedView = document.getElementById('channelConnectedView');
    var connectView = document.getElementById('channelConnectView');
    var btnFetchFromConnected = document.getElementById('btnFetchFromConnected');
    var btnSwitchChannel = document.getElementById('btnSwitchChannel');
    var btnCancelSwitch = document.getElementById('btnCancelSwitch');

    if(btnFetchFromConnected){
btnFetchFromConnected.addEventListener('click', function () {

    goToStep(2);

    setTimeout(function(){

        angular.element(document.querySelector('[ng-controller="Youtube_optimisation"]'))
            .scope()
            .fetchVideos();

    },100);

});    }
    if(btnSwitchChannel){
      btnSwitchChannel.addEventListener('click', function(){
        connectedView.style.display = 'none';
        connectView.style.display = 'block';
      });
    }
    if(btnCancelSwitch){
      btnCancelSwitch.addEventListener('click', function(){
        connectView.style.display = 'none';
        connectedView.style.display = 'block';
      });
    }

    /* Step 1 (new channel) -> Connect */
    // var btnConnect = document.getElementById('btnConnect');
    // if(btnConnect){
    //   btnConnect.addEventListener('click', function(){
    //     btnConnect.disabled = true;
    //     btnConnect.innerHTML = '<i class="bi bi-arrow-repeat"></i> Connecting\u2026';
    //     setTimeout(function(){ goToStep(2); }, 700);
    //   });
    // }

    /* Step 3 -> select a video */
    var videoList = document.getElementById('videoList');
    var btnReviveSelected = document.getElementById('btnReviveSelected');
    if(videoList){
      videoList.addEventListener('click', function(e){
        var row = e.target.closest('.video-row');
        if(!row) return;
        videoList.querySelectorAll('.video-row').forEach(function(r){
          r.classList.remove('selected');
          r.querySelector('.select-mark').className = 'bi bi-circle icon-md text-muted-va select-mark';
        });
        row.classList.add('selected');
        row.querySelector('.select-mark').className = 'bi bi-check-circle-fill icon-md text-signal select-mark';
        selectedVideo = row.getAttribute('data-video');
        btnReviveSelected.disabled = false;
      });
    }
    if(btnReviveSelected){
      btnReviveSelected.addEventListener('click', function(){
        if(!selectedVideo) return;
        goToStep(4);
      });
    }

    /* Step 7 -> Apply */
    var btnApply = document.getElementById('btnApply');
    if(btnApply){
      btnApply.addEventListener('click', function(){
        btnApply.disabled = true;
        btnApply.innerHTML = '<i class="bi bi-arrow-repeat"></i> Applying to YouTube\u2026';
        setTimeout(function(){
          goToStep(8);
        }, 900);
      });
    }

    var btnReviveAnother = document.getElementById('btnReviveAnother');
    if(btnReviveAnother){
      btnReviveAnother.addEventListener('click', function(){
        window.location.href = 'revive.html';
      });
    }

  });
})();

</script>
<script>
    const words = [
        "Welcome, Connect your YouTube channel to begin.",
        "Select a video for optimization.",
        "AI is analyzing ranking opportunities.",
        "Reviewing SEO and engagement signals.",
        "Check AI recommendations.",
        "Apply changes to your video.",
        "Optimization completed successfully."
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
        1: "Welcome! Connect your YouTube channel to begin.",
        2: "Fetching videos from your YouTube channel...",
        3: "Select a video you want to optimize.",
        4: "AI is analyzing your video and generating optimizations...",
        6: "Review the AI optimized version before publishing.",
        7: "Applying approved changes to your YouTube video...",
        8: "Optimization Completed Successfully."
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

    typeWriter();
</script>

