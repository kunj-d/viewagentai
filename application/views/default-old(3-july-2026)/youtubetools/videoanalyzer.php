<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<title>
    <?php echo $this->config->item('productName') ?> | video Analysis
</title>


<style>
    [ng\:cloak],
    [ng-cloak],
    [data-ng-cloak],
    [x-ng-cloak],
    .ng-cloak,
    .x-ng-cloak {
        display: none !important;
    }
    
    
    .no-print {
        display: block;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
        }
    
    
    .theme-card {
        break-inside: avoid;
        page-break-inside: avoid;
    }
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="AnalysisCntrl">
    <div class="container-fluid container-padding" style="--red: #e8001d;--red-light: #ff1a35;--red-bg: #fff0f2;--dark: #111214;--card-bg: #ffffff;--border: #e8eaed;--muted: #6b7280;--tag-bg: #f1f3f5;--high: #ef4444;--medium: #f97316;--low: #22c55e;" ng-clock>
        <div class="row align-items-center row-gap-2 mb-3">
            <div class="col-md-6">
                <div class="page-header-title d-flex align-items-center gap-2">
                    <i class="fa-solid fa-chart-line"></i>
                    <div>
                        <h3 class="title">Analyze</h3>
                        <p class="desc">Analyze any YouTube video for AI visibility issues and opportunities</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="<?php echo base_url('analyz-data');?>" class=" btn btn-dark"><i class="fa-solid fa-clock-rotate-left"></i>Analysis
                    History</a>
            </div>
        </div>
        <div class="url-bar-card theme-card flex-column flex-sm-row">
            <div class="icon-parent">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input  ng-model="id" type="hidden" value="{{id}}">
            <input class="form-control px-0 order-1 order-sm-0 text-center text-sm-start" ng-model="url" type="text" value="" placeholder="Paste YouTube Link Here...">
            <button class="btn btn-primary" ng-click="analyzevideo()">
                <i class="fa-solid fa-search"></i> Analyze Now
            </button>
        </div>
        
        <p ng-if="showDiv" ng-clock>
            <!-- <i class="fa-solid fa-circle-question"></i> -->
            Supports: YouTube Videos & Shorts
        </p>
        <div class="row row-gap-2 gx-3" id="downloadReport" ng-if="showDiv">
            <div class="col-xl-4">
                <div class="theme-card h-100">
                    <h6 class="title-color">
                        Video Overview
                    </h6>
                    <div>
                        <img ng-src="{{video.thumbnail}}" class="h-100 w-100 object-fit-cover rounded" alt="Thumbnail">
                    </div>
                    <h6 class="title-color mt-2">
                        {{video.title}}
                    </h6>
                    <div class="d-flex align-items-center mt-2 gap-1">
                        <div class="overflow-hidden" style="height: 30px;width: 30px;">
                            <img ng-src="{{video.video_info.channelThumbnail}}"
                                class="h-100 w-100 object-fit-cover rounded-circle" alt="Thumbnail">
                        </div>
                        <p class="w500 mb-0">{{video.video_info.channel_name}} <i class="fa-solid fa-circle-check text-primary"
                                style="font-size: 14px;"></i></p>
                    </div>
                    <p class="small mt-1 mb-0">
                        <!--<i class="fa-solid fa-calendar-days me-1"></i> Published: 2 weeks ago • 125K Views-->
                        <i class="fa-solid fa-calendar-days me-1"></i> {{video.video_info.views}} Views • 👍 {{video.video_info.likes}} Likes
                    </p>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="theme-card h-100 flex-lg-column d-lg-flex">
                    <div class="d-flex align-items-sm-center flex-column flex-sm-row justify-content-between mb-3 gap-2">
                        <h6 class="title-color mb-0">
                            AI Visibility Scores (AEO)
                        </h6>
                        <a href="#" class="text-primary">
                            <i class="fa-solid fa-circle-question info-tooltip"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-custom-class="custom-tooltip more-width analyze-tooltip"
                                data-bs-html="true"
                                data-bs-title="
                                    <div class='text-start'>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>AI Visibility Score</b> → AI can find your content.<br>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>Answer Engine Score</b> → Quality of your answers.<br>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>Generative Search Score</b> → Performance in AI search.<br>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>Content Readiness Score</b> → Content is properly optimized.
                                    </div>
                                "
                            >
                            </i>
                            How it Works?
                        </a>
                    </div>
                    <div class="row row-gap-2 g-2 flex-grow-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="theme-card px-2 text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-start">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-regular fa-eye text-primary"></i>
                                    </div>
                                    <p class="small title-color mb-0">AI Visibility Score</p>
                                </div>
                                <div 
                                    class="score-circle"
                                    style="
                                        --percent: {{video.ai_visibility_score}};
                                        --score-color: {{ video.ai_visibility_score <= 40 ? '#ef4444' : (video.ai_visibility_score <= 70 ? '#facc15' : '#22c55e') }};
                                    "
                                >
                                    <svg viewBox="0 0 100 100">
                                        <circle class="bg" cx="50" cy="50" r="44"></circle>
                                        <circle class="progress" cx="50" cy="50" r="44"></circle>
                                    </svg>
                                    <span>{{video.ai_visibility_score}}</span>
                                    <small>/100</small>
                                </div>
                                <p class="mb-0 fw-bold text-primary">{{video.ai_visibility_status}}</p>
                                <p class="mb-0">Decent chance to appear in AI answers</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="theme-card px-2 text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-start">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-solid fa-comment-dots text-primary"></i>
                                    </div>
                                    <p class="small title-color mb-0">Answer Engine Score</p>
                                </div>
                                <div 
                                    class="score-circle" 
                                    style="
                                        --percent: {{video.answer_engine_score}}; 
                                        --score-color: {{ video.answer_engine_score <= 40 ? '#ef4444' : (video.answer_engine_score <= 70 ? '#facc15' : '#22c55e') }};
                                    "
                                >
                                    <svg viewBox="0 0 100 100">
                                        <circle class="bg" cx="50" cy="50" r="44"></circle>
                                        <circle class="progress" cx="50" cy="50" r="44"></circle>
                                    </svg>
                                    <span>{{video.answer_engine_score}}</span>
                                    <small>/100</small>
                                </div>
                                <p class="mb-0 fw-bold text-primary">{{video.answer_engine_status}}</p>
                                <p class="mb-0">Needs better structuring for AI answers</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="theme-card px-2 text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-start">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-solid fa-wand-magic-sparkles text-primary"></i>
                                    </div>
                                    <p class="small title-color mb-0">Generative Search Score</p>
                                </div>
                                <div 
                                    class="score-circle" 
                                    style="
                                        --percent: {{video.generative_search_score}}; 
                                        --score-color: {{ video.generative_search_score <= 40 ? '#ef4444' : (video.generative_search_score <= 70 ? '#facc15' : '#22c55e') }};
                                    "
                                >
                                    <svg viewBox="0 0 100 100">
                                        <circle class="bg" cx="50" cy="50" r="44"></circle>
                                        <circle class="progress" cx="50" cy="50" r="44"></circle>
                                    </svg>
                                    <span>{{video.generative_search_score}}</span>
                                    <small>/100</small>
                                </div>
                                <p class="mb-0 fw-bold text-primary">{{video.generative_search_status}}</p>
                                <p class="mb-0">Optimize for AI summaries & citations</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="theme-card px-2 text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-start">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-solid fa-file-magnifying-glass text-primary"></i>
                                    </div>
                                    <p class="small title-color mb-0">Content Readiness Score</p>
                                </div>
                                <div 
                                    class="score-circle" 
                                    style="
                                        --percent: {{video.content_readiness_score}}; 
                                        --score-color: {{ video.content_readiness_score <= 40 ? '#ef4444' : (video.content_readiness_score <= 70 ? '#facc15' : '#22c55e') }};
                                    "
                                >
                                    <svg viewBox="0 0 100 100">
                                        <circle class="bg" cx="50" cy="50" r="44"></circle>
                                        <circle class="progress" cx="50" cy="50" r="44"></circle>
                                    </svg>
                                    <span>{{video.content_readiness_score}}</span>
                                    <small>/100</small>
                                </div>
                                <p class="mb-0 fw-bold text-primary">{{video.content_readiness_status}}</p>
                                <p class="mb-0">Missing key signals for AI discovery</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-md-center flex-md-row flex-column justify-content-between gap-2 mt-2 mt-md-3">
                        <div>
                            <div class="d-flex align-items-md-center flex-md-row flex-column gap-2 gap-sm-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="issue-dot bg-danger">
                                    </div>
                                    <label class="form-label mb-0">0 – 40 (Needs Improvement)</label>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="issue-dot bg-warning">
                                    </div>
                                    <label class="form-label mb-0">40 – 70 (Average)</label>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="issue-dot bg-success">
                                    </div>
                                    <label class="form-label mb-0">70 – 100 (Good to Best)</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="form-label mb-0 text-success">Best Score: 92/100</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="theme-card h-100 d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="title-color d-flex align-items-center small mb-0 mb-0">
                            <i class="fa-solid fa-triangle-exclamation me-2 text-primary"></i>
                            Issues Found
                        </h6>
                        <span class="card-badge low">{{video.issues.length}} Issues</span>
                    </div>
                    <div class="flex-grow-1">
                        <div style="overflow-y: auto; max-height: 340px; margin-right: -15px; padding-right: 15px;">
                            <div class="issue-item" ng-repeat="item in video.issues">
                                <div class="issue-dot" ng-style="{'background': item.severity == 'High' ? '#ef4444' : item.severity == 'Medium' ? '#f97316' : '#22c55e'}"></div>
                                <span class="issue-text">{{item.issue}}</span>
                                <span class="card-badge" ng-class="{'high': item.severity=='High','medium': item.severity=='Medium','low': item.severity=='Low'}">
                                    {{item.severity}}
                                </span>
                                <!--<div class="issue-dot" style="background:#ef4444"></div>-->
                                <!--<span class="issue-text">Title is not AI query optimized </span>-->
                                <!--<span class="card-badge high">High</span>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="theme-card h-100 d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="title-color d-flex align-items-center small mb-0">
                            <i class="fa-solid fa-rocket me-2 text-success"></i>
                            Opportunities to Improve
                        </h6>
                        <span class="card-badge low">{{video.opportunities.length}} Opportunities</span>
                    </div>
                    <div class="flex-grow-1">
                        <div style="overflow-y: auto; max-height: 340px; margin-right: -15px; padding-right: 15px;">
                            <div class="opp-item" ng-repeat="opp in video.opportunities">
                                <div class="opp-dot"></div>
                                <span>{{opp}}</span>
                            </div>
                            <!--<div class="opp-item">-->
                            <!--    <div class="opp-dot"></div><span>Include FAQ section for AI answers</span>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="theme-card h-100 d-flex flex-column">
                    <div class="mb-3 border-bottom" style="padding-bottom:15px;">
                        <h5 class="text-primary mb-2">Thumbnail Analytics</h5>
                        <div style="display: flex; flex-direction: column;">
                            <div class="mb-1 opp-item p-0" style="font-size: 12px; font-weight: 500; gap:10px;" ng-repeat="item in video.thumbnail_analytics">
                                <span class="opp-dot"></span>
                                {{item}}
                            </div>
                            <!--<div class="mb-1 opp-item p-0" style="font-size: 12px; font-weight: 500; gap:10px;">-->
                            <!--    <span class="opp-dot"></span>    -->
                            <!--    Systematic Coding Process-->
                            <!--</div>-->
                            <!--<div class="opp-item p-0" style="font-size: 12px; font-weight: 500; gap:10px;">-->
                            <!--    <span class="opp-dot"></span>-->
                            <!--    High Flexibility-->
                            <!--</div>-->
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="title-color d-flex align-items-center small mb-0">
                            <i class="fa-solid fa-lightbulb text-warning me-2"></i>
                            AI Query Keyword Insights
                        </h6>
                    </div>
                    <div class="flex-grow-1">
                        <div style="overflow-y: auto; max-height: 340px; margin-right: -15px; padding-right: 15px;">
                            <h6 class="title-color small">Primary Keyword</h6>
                            <div class="chip-primary mb-4">
                                {{video.keywords.primary}}
                                <!--<div class="kw-meta">Search Volume: High &nbsp;|&nbsp; Competition: Medium</div>-->
                            </div>
                            <h6 class="title-color small">Related Keywords</h6>
                            <div>
                                <span class="chip" ng-repeat="keyword in video.keywords.related">{{keyword}}</span>
                                <!--<span class="chip">chatgpt youtube</span>-->
                                <!--<span class="chip">youtube in gemini</span>-->
                                <!--<span class="chip">grok youtube search</span>-->
                                <!--<span class="chip">ai visibility for youtube</span>-->
                                <!--<span class="chip">answer engine optimization</span>-->
                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="theme-card">
                    <h6 class="title-color d-flex align-items-center">
                        <i class="fa-solid fa-bolt me-2"></i>
                        Opportunities to Improve
                        <i class="fa-solid fa-circle-info ms-2 info-tooltip"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-custom-class="custom-tooltip"
                            data-bs-title="Optimize titles, tags, and descriptions for better AI search visibility."
                        >
                        </i>
                    </h6>
                    <div class="row row-gap-2 gx-3">
                        <div class="col-sm-6 col-lg-3">
                            <div class="action-card theme-card h-100">
                                <div class="action-icon-wrap">
                                    <i class="fa-solid fa-t"></i>
                                </div>
                                <div class="action-title">Optimize Title for AEO</div>
                                <div class="action-sub">Make title AI query friendly</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="action-card theme-card h-100">
                                <div class="action-icon-wrap">
                                    <i class="fa-solid fa-align-left"></i>
                                </div>
                                <div class="action-title">Improve Description</div>
                                <div class="action-sub">Add AI signals &amp; takeaways</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="action-card theme-card h-100">
                                <div class="action-icon-wrap">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div class="action-title">Add FAQ Section</div>
                                <div class="action-sub">Get into AI answer boxes</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="action-card theme-card h-100">
                                <div class="action-icon-wrap">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <div class="action-title">Generate AI Tags</div>
                                <div class="action-sub">AI intent based tags</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 no-print" >
                        <button class="btn btn-primary w-75" ng-click="optimizevideo()">Optimize Now</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="theme-card h-100 d-flex flex-column">
                    <h6 class="title-color d-flex align-items-center">
                        <i class="fa-solid fa-chart-line text-primary me-2"></i>
                        Analysis Summary
                    </h6>
                    <div class="flex-grow-1 mb-2">
                        <div style="overflow-y: auto; max-height: 160px; margin-right: -15px; padding-right: 15px;">
                            <p>{{video.summary}}</p>
                        </div>
                    </div>
                    <a class="btn btn-primary w-100 mt-3 no-print" ng-click="downloadPDF()">
                        <i class="fa-solid fa-download"></i>
                        Download Full Report
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form id="videoPdfForm" action="<?php echo base_url('export-video-analysis-pdf') ?>" method="POST" style="display:none;">
        <input type="hidden" name="pdf_data" id="video_pdf_data_input">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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

        app.controller('AnalysisCntrl', function ($scope, $http, $timeout, $sce) {

            // $scope.url = "";
            $scope.showDiv = false;

            $scope.analyz_url = "<?php echo isset($url) ? trim($url) : ''; ?>";
            if ($scope.analyz_url && $scope.analyz_url.length > 0) {
                $timeout(function () {
                    $scope.url = $scope.analyz_url;
                    $scope.analyzevideo();
                }, 100); 
            }

            $scope.analyz_id = "<?php echo isset($id) ? trim($id) : ''; ?>";
                if ($scope.analyz_id && $scope.analyz_id.length > 0) {
                    $timeout(function () {
                        $scope.id = $scope.analyz_id;
                        $scope.getanalyzedata($scope.id)
                    }, 100); 
                }

            $scope.analyzevideo = function () {
                if (!$scope.url) {
                    toastr.error("Please Enter a youtube video url");
                    return;
                }

                jsLoader(true);

                var queryStr = "<?php echo base_url('analyze-video')?>";

                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        'videourl': $scope.url
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                    .then(function (response) {
                        jsLoader(false);
                        if (response.data.success) {
                            $scope.analysisData = response.data.analyze_data;
                            $scope.id = response.data.id;
                            
                            $scope.getanalyzedata($scope.id)
                            
                            toastr.success(response.data.msg);
                        } else {
                            toastr.error(response.data.msg);
                        }
                    })
                    .catch(function (err) {
                        jsLoader(false);
                        console.error(err);
                        toastr.error("Something went wrong!");
                    });
            };
            
            
           $scope.getanalyzedata = function(id) {
                let queryStr = "<?php echo base_url('get-analyz-data')?>";
            
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: id }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function (response) {
        
                if (response.data.success) {
                    let data = response.data.analyze_data;
                    $scope.url = data.video_url;
                    $scope.video = data;
                    $scope.video.issues = JSON.parse(data.issues || '[]');
                    $scope.video.opportunities = JSON.parse(data.opportunities || '[]');
                    $scope.video.keywords = JSON.parse(data.keywords || '{}');
                    $scope.video.video_info = JSON.parse(data.video_info || '{}');
                    $scope.video.issuesCount = $scope.video.issues.length;
                    $scope.video.thumbnail_analytics = JSON.parse(data.thumbnail_analytics || '[]');
                    $scope.video.opportunitiesCount = $scope.video.opportunities.length;
                    $scope.video.video_data = data.video_info;
                    $scope.showDiv = true;
                } else {
                    $scope.showDiv = false;
                    console.log(response.data.msg);
                }
            })
            .catch(function () {
                console.log("Something went wrong!");
            });
        };
        
        $scope.optimizevideo = function () {
                if (!$scope.id) {
                    toastr.error("Somthing Went wrong");
                    return;
                }

                jsLoader(true);

                var queryStr = "<?php echo base_url('optimize-with-ai')?>";

                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        'id': $scope.id,
                        'video_info': $scope.video.video_data
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                    .then(function (response) {
                        jsLoader(false);
                        if (response.data.success) {
                            toastr.success(response.data.msg);
                            var encodedId = btoa($scope.id) .replace(/\+/g, '-') .replace(/\//g, '_') .replace(/=+$/, '');
                            
                            window.location.href = "<?php echo base_url('optimize-data')?>/" + encodedId;
                        } else {
                            toastr.error(response.data.msg);
                        }
                    })
                    .catch(function (err) {
                        jsLoader(false);
                        console.error(err);
                        toastr.error("Something went wrong!");
                    });
            };
        
        
        
        // $scope.downloadPDF = function () {
        //     const element = document.getElementById('downloadReport');
        
        //     const opt = {
        //         margin: 0.3,
        //         filename: 'youtube-ai-report.pdf',
        
        //         image: {
        //             type: 'jpeg',
        //             quality: 1
        //         },
        
        //         html2canvas: {
        //             scale: 2,
        //             useCORS: true,
        //             scrollY: 0
        //         },
        
        //         jsPDF: {
        //             unit: 'in',
        //             format: 'a4',
        //             orientation: 'landscape'
        //         },
        
        //         pagebreak: {
        //             mode: ['avoid-all', 'css', 'legacy']
        //         }
        //     };
        
        //     html2pdf()
        //         .set(opt)
        //         .from(element)
        //         .save();
        // };

        $scope.downloadPDF = function () {
            if (!$scope.video) {
                toastr.error("Please analyze the video first!");
                return;
            }
            var payload = {
                analyze_data: $scope.video
            };

            var dataInput = document.getElementById('video_pdf_data_input');
            dataInput.value = JSON.stringify($scope.video);
            
            document.getElementById('videoPdfForm').submit();
            
            toastr.success("Generating your video analysis report...");
        };

        });


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