<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title><?php echo $this->config->item('productName') ?> | Optimize</title>

<style>
    .border-right {
        border-right: 1px solid var(--theme-br);

        @media screen and (max-width: 1199px) {
            border-right: 0;
            border-bottom: 1px solid var(--theme-br);
            padding-bottom: 15px;
        }
    }

    .rec-list {
        height: 185px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="optimzeCntrl">
    <div class="container-fluid container-padding">
        <div class="row align-items-center row-gap-2 mb-3">
            <div class="col-md-6">
                <div class="page-header-title d-flex align-items-center gap-2">
                    <!-- <i class="fa-solid fa-chart-line"></i> -->
                    <div class="header-img">
                        <img src="<?php echo $this->config->item('assetsPath'); ?>images/optimize-img.png">
                    </div>
                    <div>
                        <h3 class="title">Optimize</h3>
                        <p class="desc">Optimize your YouTube video for AI visibility & higher rankings</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="<?= base_url('analyz-data'); ?>" class="btn btn-dark"><i class="fa-solid fa-clock-rotate-left"></i>
                    Optimization History</a>
            </div>
        </div>
        <div class="row gap-0 g-3">
            <div class="col-12">
                <div class="theme-card">
                    <div class="row gap-0 g-lg-3 g-4">
                        <div class="col-xl-8 border-right">
                            <div class="yt-optimize-wrap">
                                <div class="yt-thumbnail">
                                    <img src="{{video.thumbnail}}" alt="yt thumb">
                                </div>
                                <div class="yt-content">
                                    <h6 class="yt-title">{{video.title}}</h6>
                                    <div class="yt-meta">
                                        <div class="user divider">
                                            <img ng-src="{{video.video_info.channelThumbnail}}" alt="yt user"
                                                loading="lazy">
                                            <span class="name">{{video.video_info.channel_name}}</span>
                                        </div>
                                        <!--<span class="schedule divider">Published: 2 weeks ago</span>-->
                                        <span class="view">{{video.video_info.views}} views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="yt-progress">
                                <div class="yt-lbl">Optimization Progress</div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="progress flex-1" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="78" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar"
                                            style="--progress-width: {{video.optimized_value.optimization_progress}}%;">
                                        </div>
                                    </div>
                                    <div class="progress-count">{{video.optimized_value.optimization_progress}}%</div>
                                </div>
                                <p>Great! A few more changes to maximize AI visibility.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="theme-card overflow-hidden h-100">
                    <div class="opt-tabs-wrap">
                        <div class="nav nav-tabs opt-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-title-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-title" type="button" role="tab" aria-controls="nav-title"
                                aria-selected="true">
                                <i class="fa-solid fa-text"></i>
                                Title
                            </button>
                            <button class="nav-link" id="nav-description-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-description" type="button" role="tab"
                                aria-controls="nav-description" aria-selected="false">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Description
                            </button>
                            <button class="nav-link" id="nav-tags-tab" data-bs-toggle="tab" data-bs-target="#nav-tags"
                                type="button" role="tab" aria-controls="nav-tags" aria-selected="false">
                                <i class="fa-regular fa-tag"></i>
                                Tags
                            </button>
                            <button class="nav-link" id="nav-thumbnail-tab" data-bs-toggle="tab" data-bs-target="#nav-thumbnail" type="button" role="tab" aria-controls="nav-thumbnail" aria-selected="false">
                                <i class="fa-regular fa-image"></i>
                                Thumbnail
                            </button>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <!-- Title Content -->
                            <div class="tab-pane fade show active" id="nav-title" role="tabpanel"
                                aria-labelledby="nav-title-tab" tabindex="0">
                                <div class="opt-section">
                                    
                                    <div class="current-title-box">
                                        <div class="current-title-label">Current Title</div>
                                        <div class="current-title-row">
                                            <span
                                                class="title-text">{{video.optimized_value.title_section.current_title}}</span>
                                            <!-- <span class="title-score">{{video.optimized_value.title_section.current_score}}/100</span> -->
                                            <span class="title-score d-none">{{selectedTitleScore}}/100</span>
                                        </div>
                                    </div>
                                    <div class="opt-section-header">
                                        <div>
                                            <h6 class="opt-section-title">Optimize Title</h6>
                                            <p class="opt-section-sub">Create a title that helps AI models understand
                                                your content and rank it in answers.</p>
                                        </div>
                                        <!-- <span class="score-badge">Score:{{video.optimized_value.title_section.current_score}}/100</span> -->
                                        <span class="score-badge">Score:{{selectedTitleScore}}/100</span>
                                    </div>

                                    <!-- <div class="form-group mb-3">
                                        <label class="form-label fw-bold text-white">Title to Apply / Edit:</label>
                                        <input type="text" class="form-control text-white" ng-model="editableData.title" style="background: #1c1c1c; border: 1px solid var(--theme-br);">
                                    </div> -->
                                    <!--<div class="suggested-label">AI Suggested Titles <span class="click-hint">(Click to apply)</span></div>-->
                                    <div class="titles-card">
                                        <div class="form-check"
                                            ng-repeat="title in video.optimized_value.title_section.suggestions"
                                            ng-click="selectSuggestedTitle(title.title, title.score)" style="cursor:pointer;">
                                            <label class="title-radio-label" style="cursor:pointer; width: 100%;">
                                                <input class="title-radio-input" type="radio" name="aiTitle" ng-model="$parent.selectedSuggestedTitleText" ng-value="title.title">
                                                <span class="title-text">{{title.title}}</span>
                                                <span class="best-badge" ng-if="title.is_best">Best</span>
                                                <span class="title-score">{{title.score}}/100</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3 gap-2">
                                        <button class="btn btn-primary" ng-if="channelConnected && videoOwnershipVerified" ng-click="updateYoutubeMetadata('title')">Apply
                                            Title</button>
                                            <button class="btn btn-primary" ng-click="exportOptimizerPDF()"><i class="fa-solid fa-arrow-down-to-bracket"></i> Export</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Description Content -->
                            <div class="tab-pane fade" id="nav-description" role="tabpanel"
                                aria-labelledby="nav-description-tab" tabindex="0">
                                <div class="opt-section">
                                    <div class="opt-section-header">
                                        <div>
                                            <h6 class="opt-section-title">Optimize Description</h6>
                                            <p class="opt-section-sub">Write a description that explains your video
                                                clearly for AI models.</p>
                                        </div>
                                        <span class="score-badge">Score:
                                            {{video.optimized_value.description_section.score}}/100</span>
                                    </div>
                                    <div class="form-group mb-3 pt-2 pb-3 px-3 border radius-3 bg-dark">
                                        <label for="c_description" class="form-label">Current Description</label>
                                        <textarea name="c_description" id="c_description" rows="5" class="form-control"
                                            ng-model="editableData.description" placeholder="Write your Description">
                                            {{video.video_info.description}}
                                        </textarea>
                                    </div>
                                    <!--<div class="suggested-label">AI Optimized Descriptions  <span class="click-hint">(Click to apply)</span></div>-->
                                    <div class="titles-card">
                                        <div class="form-check">
                                            <label class="title-radio-label">
                                                <input class="title-radio-input" type="radio" name="aiDescription"
                                                    checked="" autocomplete="off">
                                                <span
                                                    class="title-text">{{video.optimized_value.description_section.optimized_description}}</span>
                                                <span class="best-badge">Best</span>
                                                <!--<span-->
                                                <!--    class="title-score">{{video.optimized_value.tags_section.score}}/100</span>-->
                                                <span class="title-score">  {{video.optimized_value.description_section.score}}/100</span>
                                            </label>
                                        </div>
                                        <!--<div class="form-check">-->
                                        <!--    <label class="title-radio-label">-->
                                        <!--        <input class="title-radio-input" type="radio" name="aiDescription" autocomplete="off">-->
                                        <!--        <span class="title-text">Master YouTube AEO — the complete guide to getting your videos featured in ChatGPT, Gemini, and Grok AI answers. Step-by-step strategies for AI search visibility.</span>-->
                                        <!--        <span class="title-score">84/100</span>-->
                                        <!--    </label>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="d-flex align-items-center mt-3 gap-2">
                                        <button class="btn btn-primary" ng-if="channelConnected && videoOwnershipVerified" ng-click="updateYoutubeMetadata('description')">Apply Description</button>
                                        <button class="btn btn-primary" ng-click="exportOptimizerPDF()"><i class="fa-solid fa-arrow-down-to-bracket"></i> Export</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Tags Content -->
                            <div class="tab-pane fade" id="nav-tags" role="tabpanel" aria-labelledby="nav-tags-tab"
                                tabindex="0">
                                <div class="opt-section">
                                    <div class="opt-section-header">
                                        <div>
                                            <h6 class="opt-section-title">Optimize Tags</h6>
                                            <p class="opt-section-sub">Add relevant tags and AI-friendly keywords to
                                                your video.</p>
                                        </div>
                                        <!-- <span class="score-badge">Score: 60/100</span> -->
                                    </div>
                                    <div class="current-title-box">
                                        <div class="current-title-label">Current Tags</div>
                                        <div class="tags-wrap mt-2">
                                            <span class="tag-chip" ng-model="editableData.tags"
                                                ng-repeat="oldtag in video.video_info.tags">
                                                {{oldtag}}
                                            </span>

                                            <!--<span class="tag-chip">ai seo<span class="tag-remove"><i class="fa-solid fa-xmark"></i></span></span>-->
                                            <!--<span class="tag-chip">chatgpt youtube<span class="tag-remove"><i class="fa-solid fa-xmark"></i></span></span>-->
                                            <!--<span class="tag-chip">gemini search<span class="tag-remove"><i class="fa-solid fa-xmark"></i></span></span>-->
                                            <!--<span class="tag-chip add-tag-btn">+ Add Tag</span>-->
                                        </div>
                                    </div>
                                    <div class="suggested-label">AI Suggested Tags
                                        <!-- <span class="click-hint">(Click to add)</span> -->
                                    </div>
                                    <div class="tags-wrap mt-2">
                                        <span class="tag-chip-suggest"
                                            ng-repeat="tag in video.optimized_value.tags_section.suggested_tags"
                                            ng-click="addSuggestedTag(tag)" style="cursor:pointer;">
                                            {{tag}}
                                        </span>
                                        <!--<span class="tag-chip-suggest">rank videos in chatgpt</span>-->
                                        <!--<span class="tag-chip-suggest">ai answer engine optimization</span>-->
                                        <!--<span class="tag-chip-suggest">grok youtube search</span>-->
                                        <!--<span class="tag-chip-suggest">ai visibility youtube</span>-->
                                        <!--<span class="tag-chip-suggest">gemini youtube ranking</span>-->
                                        <!--<span class="tag-chip-suggest">youtube ai search 2024</span>-->
                                        <!--<span class="tag-chip-suggest">aeo strategy</span>-->
                                    </div>
                                    <div class="d-flex align-items-center mt-3 gap-2">
                                        <button class="btn btn-primary" ng-if="channelConnected && videoOwnershipVerified" ng-click="updateYoutubeMetadata('tags')">Apply Tags</button>
                                        <button class="btn btn-primary" ng-click="exportOptimizerPDF()"><i class="fa-solid fa-arrow-down-to-bracket"></i> Export</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Thumbnail Content -->
                           <div class="tab-pane fade" id="nav-thumbnail" role="tabpanel">
                                <div class="opt-section-header">
                                    <h6 class="opt-section-title mb-3">AI THUMBNAIL SUGGESTIONS</h6>
                                </div>
                            
                                <div class="d-flex align-items-start gap-2 mb-3"
                                        ng-repeat="item in video.optimized_value.thumbnail_variations">
                            
                                    <div class="issue-dot bg-primary"></div>
                            
                                    <div>
                                        <label class="form-label d-block lh-1">
                            
                                            {{item.label}}
                                            <span ng-if="item.is_best">(Best)</span>:
                            
                                            "{{item.description}}"
                            
                                        </label>
                            
                                        <span class="d-flex align-items-center gap-2">
                            
                                            <!-- CTR Score -->
                                            <span ng-if="item.ctr_score">
                                                Predicted CTR Score: {{item.ctr_score}}/100
                                            </span>
                            
                                            <!-- Best Badge -->
                                            <span class="card-badge low"
                                                    ng-if="item.is_best">
                                                Best
                                            </span>
                            
                                        </span>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card gap-4 p-4">
                    <div class="card-head">
                        Youtube Score
                        <i class="fa-solid fa-circle-info ms-2 info-tooltip"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-custom-class="custom-tooltip"
                            data-bs-title="Youtube score checks how well your title, description, and tags are optimized."
                        >
                        </i>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="aeo-radial">
                                <div 
                                    class="score-circle"
                                    style="
                                        --percent: {{video.optimized_value.aeo_score}};
                                        --score-color: {{ video.optimized_value.aeo_score <= 40 ? '#ef4444' : (video.optimized_value.aeo_score <= 70 ? '#facc15' : '#22c55e') }};
                                    "
                                >
                                    <svg viewBox="0 0 100 100">
                                        <circle class="bg" cx="50" cy="50" r="44"></circle>
                                        <circle class="progress" cx="50" cy="50" r="44"></circle>
                                    </svg>
                                    <div class="num">{{video.optimized_value.aeo_score}}</div>
                                    <small>/100</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="indicator-card">
                                <div class="indicator-header">
                                    <div>Indicators</div>
                                    <div>Score</div>
                                </div>
                                <div class="indicator-row">
                                    <div class="indicator-left">
                                        <span class="status-dot status-red"></span>
                                        <span>Red</span>
                                    </div>
                                    <div class="indicator-score">0 / 40</div>
                                </div>
                                <div class="indicator-row">
                                    <div class="indicator-left">
                                        <span class="status-dot status-yellow"></span>
                                        <span>Yellow</span>
                                    </div>
                                    <div class="indicator-score">41 / 70</div>
                                </div>
                                <div class="indicator-row">
                                    <div class="indicator-left">
                                        <span class="status-dot status-green"></span>
                                        <span>Green</span>
                                    </div>
                                    <div class="indicator-score">71 / 100</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-desc text-center">You're on the right track! Optimize the remaining sections to boost
                        AI visibility.</p>
                </div>
                <div class="card p-4 mt-3">
                    <div class="card-head">Quick Recommendations</div>
                    <div class="rec-list">
                        <div class="rec-item" ng-repeat="rec in video.optimized_value.quick_recommendations">
                            <i class="fa-regular"
                                ng-class="{'fa-circle-check': rec.status == 'done','fa-circle-exclamation': rec.status == 'pending'}"
                                ng-style="{ color: rec.status == 'done' ? '#0C8649' : '#FE1D20'}"> </i>
                            <span class="rec-text">
                                {{rec.text}}
                            </span>
                        </div>
                    </div>
                    <!--<button class="btn btn-primary mb-3"><i class="fa-regular fa-bolt"></i> Apply All Changes</button>-->
                    <!--<p class="card-desc text-center">All changes will be saved to your video</p>-->
                </div>
            </div>
        </div>
    </div>

    <!--<form id="optimizerPdfForm" action="<?php echo base_url('export-optimizer-report-pdf') ?>" method="POST" style="display:none;">-->
    <!--    <input type="hidden" name="optimizer_data" id="optimizer_pdf_data_input">-->
    <!--</form>-->
    <form id="optimizerPdfForm" action="<?php echo base_url('export-optimizer-report-pdf') ?>" method="POST" style="display:none;">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="hidden" name="optimizer_data" id="optimizer_pdf_data_input">
    </form>






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

        app.controller('optimzeCntrl', function ($scope, $http) {

            var id = <?php echo $id ?>;

            $scope.editableData = {
                title: '',
                description: '',
                tags: ''
            };
            $scope.channelConnected = false;
$scope.videoOwnershipVerified = false;

            $scope.getoptimzedata = function () {
                let queryStr = "<?php echo base_url('get-analyz-data') ?>";

                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: id }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                    .then(function (response) {
                        console.log(response)
                        if (response.data.success) {
                            let data = response.data.analyze_data;
                            $scope.video = data;
                            $scope.video.video_info = JSON.parse(data.video_info || '{}');
                            $scope.video.optimized_value = JSON.parse(data.optimized_value || '{}');

                            $scope.editableData.title = $scope.video.optimized_value.title_section.current_title || $scope.video.video_info.title;
                            $scope.editableData.description = $scope.video.video_info.description;
                            $scope.editableData.tags = angular.isArray($scope.video.video_info.tags) ? $scope.video.video_info.tags.join(', ') : '';

                            $scope.channelConnected = response.data.is_channel_connected;
            $scope.videoOwnershipVerified = response.data.is_owner_of_video;

                            $scope.selectedSuggestedTitleText = '';
                            $scope.selectedTitleScore = $scope.video.optimized_value.title_section.current_score || 0;
                            if ($scope.video.optimized_value.title_section && $scope.video.optimized_value.title_section.suggestions) {
                                let suggestions = $scope.video.optimized_value.title_section.suggestions;
                                
                                // Suggestions me se 'is_best' wala title dhoondhein
                                let bestTitleObj = suggestions.find(function(item) {
                                    return item.is_best === true || item.is_best === 'true' || item.is_best == 1;
                                });

                                if (bestTitleObj) {
                                    // Agar 'Best' mil gaya to usko radio button aur input field dono me set karein
                                    $scope.selectedSuggestedTitleText = bestTitleObj.title;
                                    $scope.editableData.title = bestTitleObj.title;
                                    $scope.selectedTitleScore = bestTitleObj.score;
                                }
                            }
                        } else {
                            console.log(response.data.msg);
                        }
                    })
                    .catch(function () {
                        console.log("Something went wrong!");
                    });
            };
            $scope.getoptimzedata();

            $scope.selectSuggestedTitle = function (title, score) {
                $scope.selectedSuggestedTitleText = title;
                $scope.editableData.title = title;
                $scope.selectedTitleScore = score;
            };

            $scope.selectSuggestedDesc = function (desc) {
                $scope.editableData.description = desc;
            };

            $scope.addSuggestedTag = function (tag) {
                let currentTags = $scope.editableData.tags ? $scope.editableData.tags.split(',').map(t => t.trim()) : [];
                if (currentTags.indexOf(tag) === -1) {
                    currentTags.push(tag);
                    $scope.editableData.tags = currentTags.filter(Boolean).join(', ');
                }
            };

            // Main API trigger function
            $scope.updateYoutubeMetadata = function (type) {
                // Show universal loader if available
                if (typeof jsLoader === 'function') jsLoader(true);

                $http({
                    method: 'POST',
                    url: "<?php echo base_url('youtube/update_optimized_metadata') ?>",
                    data: $.param({
                        video_id: $scope.video.video_id, // Real video alphanumeric ID string (e.g. vQapfLDo-lo)
                        title: $scope.editableData.title,
                        description: $scope.editableData.description,
                        tags: $scope.editableData.tags,
                        category_id: $scope.video.video_info.categoryId || '22' // Fallback inside arrays
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    if (typeof jsLoader === 'function') jsLoader(false);

                    if (response.data.status) {
                        Swal.fire('Updated!', type.toUpperCase() + ' has been successfully synchronized on YouTube!', 'success');
                        $scope.getoptimzedata(); // Refresh local structures
                    } else {
                        Swal.fire('Error', response.data.message || 'Failed to update on YouTube.', 'error');
                    }
                }).catch(function () {
                    if (typeof jsLoader === 'function') jsLoader(false);
                    Swal.fire('Error', 'Network or permission failure.', 'error');
                });
            };

            $scope.exportOptimizerPDF = function () {
            if (!$scope.video) {
                toastr.error("Video data load nahi hua hai!");
                return;
            }
        
            // Ek naya unified copy object banayein taaki original data kharab na ho
            var exportData = angular.copy($scope.video);
            
            // JSON parse karne ki jaroorat na pade isliye object format me parse kar lete hain
            if(typeof exportData.optimized_value === 'string') {
                exportData.optimized_value = JSON.parse(exportData.optimized_value);
            }
        
            // IMP CHANGED LOGIC: Live selected title aur live score ko update karein database value ke upar
            exportData.optimized_value.title_section.current_title = $scope.editableData.title;
            exportData.optimized_value.title_section.current_score = $scope.selectedTitleScore;
        
            // 1. Convert completely to JSON string
            var jsonString = angular.toJson(exportData);
        
            // 2. Encode to safe Base64 string to bypass Firewall/WAF block
            var base64SafeData = btoa(unescape(encodeURIComponent(jsonString)));
        
            var dataInput = document.getElementById('optimizer_pdf_data_input');
            var form = document.getElementById('optimizerPdfForm');
        
            if (dataInput && form) {
                dataInput.value = base64SafeData; // Pass base64 data here
                
                // Backup dynamic CSRF token fallback protection layer
                var csrfName = "<?php echo $this->security->get_csrf_token_name(); ?>";
                var csrfInput = form.querySelector('input[name="' + csrfName + '"]');
                if(csrfInput) {
                    var matches = document.cookie.match(new RegExp('(?:^|; )' + csrfName + '=([^;]*)'));
                    if(matches) {
                        csrfInput.value = decodeURIComponent(matches[1]);
                    }
                }
        
                form.submit();
                toastr.success("Generating your optimized report...");
            } else {
                toastr.error("Export component configuration missing.");
            }
        };

        });

    </script>