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
    <div class="container-fluid container-padding"
        style="--red: #e8001d;--red-light: #ff1a35;--red-bg: #fff0f2;--dark: #111214;--card-bg: #ffffff;--border: #e8eaed;--muted: #6b7280;--tag-bg: #f1f3f5;--high: #ef4444;--medium: #f97316;--low: #22c55e;"
        ng-clock>
        <div class="row align-items-center row-gap-2 mb-3">
            <div class="col-md-6">
                <div class="page-header-title d-flex align-items-center gap-2">
                    <!-- <i class="fa-solid fa-chart-line"></i> -->
                    <div class="header-img">
                        <img src="<?php echo $this->config->item('assetsPath'); ?>images/analyze-img.png">
                    </div>
                    <div>
                        <h3 class="title">Analyze</h3>
                        <p class="desc">Analyze any YouTube video for AI visibility issues and opportunities</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="<?php echo base_url('analyz-data'); ?>" class=" btn btn-primary"><i
                        class="fa-solid fa-clock-rotate-left"></i>Analysis
                    History</a>
            </div>
        </div>
        <div class="url-bar-card theme-card flex-column flex-sm-row">
            <div class="icon-parent">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input ng-model="id" type="hidden" value="{{id}}">
            <input class="form-control px-0 order-1 order-sm-0 text-center text-sm-start" ng-model="url" type="text"
                value="" placeholder="Paste YouTube Link Here...">
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
                    <div class="d-flex align-items-center mt-2 gap-1 mb-2">
                        <div class="overflow-hidden" style="height: 30px;width: 30px;">
                            <img ng-src="{{video.video_info.channelThumbnail}}"
                                class="h-100 w-100 object-fit-cover rounded-circle" alt="Thumbnail">
                        </div>
                        <p class="w500 mb-0">{{video.video_info.channel_name}} <i
                                class="fa-solid fa-circle-check text-primary" style="font-size: 14px;"></i></p>
                    </div>
                    <!-- <p class="small mt-1 mb-0">
                        <i class="fa-solid fa-calendar-days me-1"></i> {{video.video_info.views}} Views • 👍
                        {{video.video_info.likes}} Likes
                    </p> -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="metric-widget">
                            <div class="metric-widget__info">
                                <div class="metric-widget__icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_527_1104)">
                                            <path
                                                d="M6.99939 1.55566C5.0355 1.55566 3.46293 2.45011 2.31814 3.51469C1.18064 4.56955 0.419878 5.83344 0.0601562 6.70115C-0.0200521 6.89316 -0.0200521 7.10705 0.0601562 7.29907C0.419878 8.16677 1.18064 9.43066 2.31814 10.4855C3.46293 11.5501 5.0355 12.4446 6.99939 12.4446C8.96328 12.4446 10.5359 11.5501 11.6806 10.4855C12.8181 9.42823 13.5789 8.16677 13.9411 7.29907C14.0213 7.10705 14.0213 6.89316 13.9411 6.70115C13.5789 5.83344 12.8181 4.56955 11.6806 3.51469C10.5359 2.45011 8.96328 1.55566 6.99939 1.55566ZM3.49939 7.00011C3.49939 6.07185 3.86814 5.18161 4.52452 4.52523C5.1809 3.86886 6.07114 3.50011 6.99939 3.50011C7.92765 3.50011 8.81789 3.86886 9.47427 4.52523C10.1306 5.18161 10.4994 6.07185 10.4994 7.00011C10.4994 7.92837 10.1306 8.8186 9.47427 9.47498C8.81789 10.1314 7.92765 10.5001 6.99939 10.5001C6.07114 10.5001 5.1809 10.1314 4.52452 9.47498C3.86814 8.8186 3.49939 7.92837 3.49939 7.00011ZM6.99939 5.44455C6.99939 6.30254 6.30182 7.00011 5.44384 7.00011C5.27127 7.00011 5.10599 6.97094 4.95043 6.9199C4.81675 6.87615 4.6612 6.95879 4.66606 7.09976C4.67335 7.26747 4.69766 7.43518 4.74384 7.60289C5.07682 8.84733 6.35773 9.58622 7.60217 9.25323C8.84661 8.92025 9.5855 7.63934 9.25252 6.3949C8.98273 5.38622 8.09071 4.70809 7.09905 4.66677C6.95807 4.66191 6.87543 4.81504 6.91918 4.95115C6.97023 5.10671 6.99939 5.27198 6.99939 5.44455Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_527_1104">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>

                                <div class="metric-widget__content">
                                    <!--<div class="metric-widget__value">9.1M</div>-->
                                    <div class="metric-widget__value">{{video.video_info.views}}</div>
                                    <div class="metric-widget__label">Views</div>
                                </div>
                            </div>

                            <div class="metric-widget__trend">
                                <svg width="44" height="16" viewBox="0 0 44 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.60298 8.36145L0.367188 14V16L43.3672 15L42.8672 2L38.3233 5.78653C37.5068 6.46699 36.3006 6.38988 35.5774 5.61099L32.073 1.83703C31.1994 0.896222 29.6782 1.01049 28.955 2.07126L24.227 9.00561C23.5208 10.0414 22.0468 10.1796 21.1603 9.29314L18.7814 6.91421C18.0004 6.13316 16.734 6.13317 15.953 6.91421L13.133 9.73422C12.4124 10.4548 11.2651 10.5184 10.4694 9.88174L8.31796 8.16062C7.50001 7.50626 6.31574 7.59386 5.60298 8.36145Z"
                                        fill="url(#paint0_linear_527_1106)" />
                                    <path
                                        d="M0.367188 14L5.60298 8.36145C6.31574 7.59386 7.50001 7.50626 8.31796 8.16062L10.4694 9.88174C11.2651 10.5184 12.4124 10.4548 13.133 9.73422L15.953 6.91421C16.734 6.13317 18.0004 6.13316 18.7814 6.91421L21.1603 9.29314C22.0468 10.1796 23.5208 10.0414 24.227 9.00561L28.955 2.07126C29.6782 1.01049 31.1994 0.896222 32.073 1.83703L35.5774 5.61099C36.3006 6.38988 37.5068 6.46699 38.3233 5.78653L42.8672 2"
                                        stroke="#2BC066" />
                                    <defs>
                                        <linearGradient id="paint0_linear_527_1106" x1="21.8672" y1="0" x2="21.8672"
                                            y2="16" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#2BC066" />
                                            <stop offset="1" stop-color="#2BC066" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                        </div>
                        <div class="metric-widget">
                            <div class="metric-widget__info">
                                <div class="metric-widget__icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_527_1115)">
                                            <path
                                                d="M8.56953 0.899604C9.28047 1.04179 9.74258 1.73359 9.60039 2.44453L9.5375 2.75625C9.39258 3.48632 9.12461 4.18085 8.75 4.81249H12.6875C13.4121 4.81249 14 5.40039 14 6.12499C14 6.63085 13.7129 7.07109 13.2918 7.28984C13.5898 7.53046 13.7812 7.8996 13.7812 8.3125C13.7812 8.95234 13.3219 9.48554 12.7176 9.60039C12.8379 9.8 12.9062 10.0324 12.9062 10.2812C12.9062 10.8637 12.5262 11.3586 12.0012 11.5281C12.0203 11.6184 12.0312 11.7141 12.0312 11.8125C12.0312 12.5371 11.4434 13.125 10.7188 13.125H8.05273C7.5332 13.125 7.02734 12.9719 6.59531 12.6848L5.54258 11.982C4.8125 11.4953 4.375 10.675 4.375 9.79726V8.75V7.43749V6.75664C4.375 5.9582 4.73867 5.20624 5.35938 4.70585L5.56172 4.54453C6.28633 3.96484 6.78125 3.15 6.96172 2.24218L7.02461 1.93046C7.1668 1.21953 7.85859 0.757417 8.56953 0.899604ZM0.875 5.24999H2.625C3.10898 5.24999 3.5 5.64101 3.5 6.12499V12.25C3.5 12.734 3.10898 13.125 2.625 13.125H0.875C0.391016 13.125 0 12.734 0 12.25V6.12499C0 5.64101 0.391016 5.24999 0.875 5.24999Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_527_1115">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>

                                <div class="metric-widget__content">
                                    <!--<div class="metric-widget__value">25.9k</div>-->
                                    <div class="metric-widget__value">{{video.video_info.likes}}</div>
                                    <div class="metric-widget__label">Likes</div>
                                </div>
                            </div>

                            <div class="metric-widget__trend">
                                <svg width="44" height="16" viewBox="0 0 44 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.60298 8.36145L0.367188 14V16L43.3672 15L42.8672 2L38.3233 5.78653C37.5068 6.46699 36.3006 6.38988 35.5774 5.61099L32.073 1.83703C31.1994 0.896222 29.6782 1.01049 28.955 2.07126L24.227 9.00561C23.5208 10.0414 22.0468 10.1796 21.1603 9.29314L18.7814 6.91421C18.0004 6.13316 16.734 6.13317 15.953 6.91421L13.133 9.73422C12.4124 10.4548 11.2651 10.5184 10.4694 9.88174L8.31796 8.16062C7.50001 7.50626 6.31574 7.59386 5.60298 8.36145Z"
                                        fill="url(#paint0_linear_527_1106)" />
                                    <path
                                        d="M0.367188 14L5.60298 8.36145C6.31574 7.59386 7.50001 7.50626 8.31796 8.16062L10.4694 9.88174C11.2651 10.5184 12.4124 10.4548 13.133 9.73422L15.953 6.91421C16.734 6.13317 18.0004 6.13316 18.7814 6.91421L21.1603 9.29314C22.0468 10.1796 23.5208 10.0414 24.227 9.00561L28.955 2.07126C29.6782 1.01049 31.1994 0.896222 32.073 1.83703L35.5774 5.61099C36.3006 6.38988 37.5068 6.46699 38.3233 5.78653L42.8672 2"
                                        stroke="#2BC066" />
                                    <defs>
                                        <linearGradient id="paint0_linear_527_1106" x1="21.8672" y1="0" x2="21.8672"
                                            y2="16" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#2BC066" />
                                            <stop offset="1" stop-color="#2BC066" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="theme-card h-100 flex-lg-column d-lg-flex">
                    <div
                        class="d-flex align-items-sm-center flex-column flex-sm-row justify-content-between mb-3 gap-2">
                        <h6 class="title-color mb-0">
                            Youtube Ranking Score
                        </h6>
                        <a href="#" class="text-primary">
                            <i class="fa-solid fa-circle-question info-tooltip" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-custom-class="custom-tooltip more-width analyze-tooltip"
                                data-bs-html="true" data-bs-title="
                                    <div class='text-start'>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>AI Visibility Score</b> → AI can find your content.<br>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>Answer Engine Score</b> → Quality of your answers.<br>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>Generative Search Score</b> → Performance in AI search.<br>
                                        <i class='fa-solid fa-circle me-1' style='font-size: 6px;'></i> <b>Content Readiness Score</b> → Content is properly optimized.
                                    </div>
                                ">
                            </i>
                            How it Works?
                        </a>
                    </div>
                    <div class="row row-gap-2 g-2 flex-grow-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="theme-card bg-green px-2 text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-center mx-auto">
                                    <!-- <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-regular fa-eye text-primary"></i>
                                    </div> -->
                                    <p class="small title-color mb-0">AI Visibility Score</p>
                                </div>
                                <div class="score-circle" style="
                                        --percent: {{video.ai_visibility_score}};
                                        --score-color: {{ video.ai_visibility_score <= 40 ? '#ef4444' : (video.ai_visibility_score <= 70 ? '#facc15' : '#22c55e') }};
                                    ">
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
                                class="theme-card bg-yellow px-2 text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-center mx-auto">
                                    <!-- <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-solid fa-comment-dots text-primary"></i>
                                    </div> -->
                                    <p class="small title-color mb-0">Answer Engine Score</p>
                                </div>
                                <div class="score-circle" style="
                                        --percent: {{video.answer_engine_score}}; 
                                        --score-color: {{ video.answer_engine_score <= 40 ? '#ef4444' : (video.answer_engine_score <= 70 ? '#facc15' : '#22c55e') }};
                                    ">
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
                                class="theme-card px-2 bg-yellow text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-center mx-auto">
                                    <!-- <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-solid fa-wand-magic-sparkles text-primary"></i>
                                    </div> -->
                                    <p class="small title-color mb-0">Generative Search Score</p>
                                </div>
                                <div class="score-circle" style="
                                        --percent: {{video.generative_search_score}}; 
                                        --score-color: {{ video.generative_search_score <= 40 ? '#ef4444' : (video.generative_search_score <= 70 ? '#facc15' : '#22c55e') }};
                                    ">
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
                                class="theme-card px-2 bg-darkpink text-center h-100 d-lg-flex flex-lg-column justify-content-lg-between">
                                <div class="d-flex align-items-center gap-2 mb-2 text-center mx-auto">
                                    <!-- <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="background: var(--rgba-primary-1); min-width: 35px; height: 35px;">
                                        <i class="fa-solid fa-file-magnifying-glass text-primary"></i>
                                    </div> -->
                                    <p class="small title-color mb-0">Content Readiness Score</p>
                                </div>
                                <div class="score-circle" style="
                                        --percent: {{video.content_readiness_score}}; 
                                        --score-color: {{ video.content_readiness_score <= 40 ? '#ef4444' : (video.content_readiness_score <= 70 ? '#facc15' : '#22c55e') }};
                                    ">
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
                    <div
                        class="d-flex align-items-md-center flex-md-row flex-column justify-content-between gap-2 mt-2 mt-md-3">
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
                        <div style="overflow-y: auto; max-height: 456px; margin-right: -15px; padding-right: 15px;">
                            <div class="issue-item" ng-repeat="item in video.issues">
                                <div class="issue-dot"
                                    ng-style="{'background': item.severity == 'High' ? '#ef4444' : item.severity == 'Medium' ? '#f97316' : '#22c55e'}">
                                </div>
                                <span class="issue-text">{{item.issue}}</span>
                                <span class="card-badge"
                                    ng-class="{'high': item.severity=='High','medium': item.severity=='Medium','low': item.severity=='Low'}">
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
                        <div style="overflow-y: auto; max-height: 456px; margin-right: -15px; padding-right: 15px;">
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
                            <div class="mb-1 opp-item p-0" style="font-size: 12px; font-weight: 500; gap:10px;"
                                ng-repeat="item in video.thumbnail_analytics">
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
            <div class="col-xl-9">
                <div class="theme-card">
                    <h6 class="title-color d-flex align-items-center">
                        <i class="fa-solid fa-bolt me-2 text-primary"></i>
                        Opportunities to Improve
                        <i class="fa-solid fa-circle-info ms-2 info-tooltip" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Optimize titles, tags, and descriptions for better AI search visibility.">
                        </i>
                    </h6>
                    <div class="row row-gap-2 gx-3">
                        <div class="col-sm-6 col-lg-2">
                            <div class="action-card style-2 theme-card h-100">
                                <div class="action-icon-wrap">
                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.38889 1.125C0.621528 1.125 0 1.7543 0 2.53125V4.5C0 5.12227 0.496528 5.625 1.11111 5.625C1.72569 5.625 2.22222 5.12227 2.22222 4.5V3.375H4.44444V14.625H3.33333C2.71875 14.625 2.22222 15.1277 2.22222 15.75C2.22222 16.3723 2.71875 16.875 3.33333 16.875H7.77778C8.39236 16.875 8.88889 16.3723 8.88889 15.75C8.88889 15.1277 8.39236 14.625 7.77778 14.625H6.66667V3.375H8.88889V4.5C8.88889 5.12227 9.38542 5.625 10 5.625C10.6146 5.625 11.1111 5.12227 11.1111 4.5V2.53125C11.1111 1.7543 10.4896 1.125 9.72222 1.125H1.38889ZM15.2292 12.7055C14.7951 12.266 14.0903 12.266 13.6562 12.7055C13.2222 13.1449 13.2222 13.8586 13.6562 14.298L15.8785 16.548C16.3125 16.9875 17.0174 16.9875 17.4514 16.548L19.6736 14.298C20.1076 13.8586 20.1076 13.1449 19.6736 12.7055C19.2396 12.266 18.5347 12.266 18.1007 12.7055L17.7743 13.0359V4.96758L18.1007 5.29805C18.5347 5.7375 19.2396 5.7375 19.6736 5.29805C20.1076 4.85859 20.1076 4.14492 19.6736 3.70547L17.4514 1.45547C17.2431 1.24453 16.9618 1.125 16.6667 1.125C16.3715 1.125 16.0903 1.24453 15.8819 1.45547L13.6597 3.70547C13.2257 4.14492 13.2257 4.85859 13.6597 5.29805C14.0938 5.7375 14.7986 5.7375 15.2326 5.29805L15.559 4.96758V13.0359L15.2326 12.7055H15.2292Z"
                                            fill="#DB1A1A" />
                                    </svg>
                                </div>
                                <div class="action-title">Optimize Title for AEO</div>
                                <div class="action-sub">Make title AI query friendly</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="action-card style-2 theme-card h-100">
                                <div class="action-icon-wrap">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 4.16667H0.833333C0.375 4.16667 0 3.79167 0 3.33333C0 2.875 0.375 2.5 0.833333 2.5H15C15.4583 2.5 15.8333 2.875 15.8333 3.33333C15.8333 3.79167 15.4583 4.16667 15 4.16667ZM15.8333 16.6667C15.8333 16.2083 15.4583 15.8333 15 15.8333H0.833333C0.375 15.8333 0 16.2083 0 16.6667C0 17.125 0.375 17.5 0.833333 17.5H15C15.4583 17.5 15.8333 17.125 15.8333 16.6667ZM20 10C20 9.54167 19.625 9.16667 19.1667 9.16667H5C4.54167 9.16667 4.16667 9.54167 4.16667 10C4.16667 10.4583 4.54167 10.8333 5 10.8333H19.1667C19.625 10.8333 20 10.4583 20 10Z"
                                            fill="#DB1A1A" />
                                    </svg>

                                </div>
                                <div class="action-title">Improve Description</div>
                                <div class="action-sub">Add AI signals &amp; takeaways</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="action-card style-2 theme-card h-100">
                                <div class="action-icon-wrap">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_527_1277)">
                                            <path
                                                d="M10 0C8.02219 0 6.08879 0.58649 4.4443 1.6853C2.79981 2.78412 1.51809 4.3459 0.761209 6.17317C0.00433286 8.00043 -0.193701 10.0111 0.192152 11.9509C0.578004 13.8907 1.53041 15.6725 2.92894 17.0711C4.32746 18.4696 6.10929 19.422 8.0491 19.8079C9.98891 20.1937 11.9996 19.9957 13.8268 19.2388C15.6541 18.4819 17.2159 17.2002 18.3147 15.5557C19.4135 13.9112 20 11.9778 20 10C19.9971 7.34872 18.9426 4.80684 17.0679 2.9321C15.1932 1.05736 12.6513 0.00286757 10 0ZM10 18.3333C8.35183 18.3333 6.74066 17.8446 5.37025 16.9289C3.99984 16.0132 2.93174 14.7117 2.30101 13.189C1.67028 11.6663 1.50525 9.99076 1.82679 8.37425C2.14834 6.75774 2.94201 5.27288 4.10745 4.10744C5.27289 2.94201 6.75774 2.14833 8.37425 1.82679C9.99076 1.50525 11.6663 1.67027 13.189 2.301C14.7118 2.93173 16.0132 3.99984 16.9289 5.37025C17.8446 6.74066 18.3333 8.35182 18.3333 10C18.3309 12.2094 17.4522 14.3276 15.8899 15.8899C14.3276 17.4522 12.2094 18.3309 10 18.3333Z"
                                                fill="#DB1A1A" />
                                            <path
                                                d="M10.5988 4.21915C10.1182 4.13159 9.62431 4.15072 9.15196 4.27518C8.67962 4.39965 8.24039 4.6264 7.86538 4.9394C7.49037 5.2524 7.18873 5.644 6.98181 6.08648C6.77489 6.52896 6.66775 7.01151 6.66797 7.49998C6.66797 7.721 6.75577 7.93296 6.91205 8.08924C7.06833 8.24552 7.28029 8.33332 7.5013 8.33332C7.72232 8.33332 7.93428 8.24552 8.09056 8.08924C8.24684 7.93296 8.33464 7.721 8.33464 7.49998C8.33443 7.2548 8.38832 7.01258 8.49246 6.79061C8.59661 6.56865 8.74845 6.37239 8.93715 6.21584C9.12585 6.05929 9.34677 5.9463 9.58416 5.88494C9.82154 5.82357 10.0695 5.81533 10.3105 5.86082C10.6397 5.92472 10.9423 6.0853 11.1798 6.32206C11.4173 6.55881 11.5789 6.86098 11.6438 7.18998C11.7094 7.53532 11.6641 7.89255 11.5144 8.2106C11.3648 8.52865 11.1184 8.79123 10.8105 8.96082C10.3006 9.2562 9.87929 9.68291 9.59041 10.1965C9.30152 10.7101 9.15564 11.2917 9.16797 11.8808V12.5C9.16797 12.721 9.25577 12.933 9.41205 13.0892C9.56833 13.2455 9.78029 13.3333 10.0013 13.3333C10.2223 13.3333 10.4343 13.2455 10.5906 13.0892C10.7468 12.933 10.8346 12.721 10.8346 12.5V11.8808C10.8242 11.5908 10.8903 11.3032 11.0264 11.0469C11.1624 10.7906 11.3636 10.5746 11.6096 10.4208C12.2134 10.0892 12.6996 9.5787 13.0014 8.95949C13.3031 8.34028 13.4057 7.64278 13.2949 6.96292C13.1841 6.28306 12.8653 5.65423 12.3826 5.16289C11.8998 4.67156 11.2766 4.34187 10.5988 4.21915Z"
                                                fill="#DB1A1A" />
                                            <path
                                                d="M10.8346 15C10.8346 14.5397 10.4615 14.1666 10.0013 14.1666C9.54106 14.1666 9.16797 14.5397 9.16797 15C9.16797 15.4602 9.54106 15.8333 10.0013 15.8333C10.4615 15.8333 10.8346 15.4602 10.8346 15Z"
                                                fill="#DB1A1A" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_527_1277">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>
                                <div class="action-title">Add FAQ Section</div>
                                <div class="action-sub">Get into AI answer boxes</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="action-card style-2 theme-card h-100">
                                <div class="action-icon-wrap">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_527_1288)">
                                            <path
                                                d="M6.42141 7.71336C6.74724 8.0392 6.74724 8.5667 6.42141 8.8917C6.09558 9.21753 5.56808 9.21753 5.24308 8.8917C4.91724 8.56586 4.91724 8.03836 5.24308 7.71336C5.56891 7.38753 6.09641 7.38753 6.42141 7.71336ZM17.9647 12.7842L17.4939 13.255C17.4714 14.2825 17.0731 15.3025 16.2981 16.0875L13.6589 18.7609C12.8731 19.5567 11.8247 19.9967 10.7064 20H10.6922C9.57974 20 8.53391 19.5667 7.74724 18.78L1.56724 12.6525C1.02558 12.1117 0.763911 11.3675 0.847244 10.6084L1.48474 4.84503C1.52724 4.46503 1.82141 4.16253 2.19974 4.11086L7.94058 3.32586C8.71724 3.22253 9.49891 3.4867 10.0472 4.03503L16.2764 10.2117C16.5989 10.5342 16.8572 10.8975 17.0522 11.285C17.7289 10.3134 17.6339 8.95586 16.7672 8.0892L10.4414 1.91836C10.2506 1.72753 9.98724 1.6392 9.73224 1.67503L3.99141 2.46003C3.53391 2.52169 3.11474 2.20253 3.05224 1.74753C2.99058 1.29169 3.30974 0.871695 3.76474 0.809195L9.50641 0.0233618C10.2739 -0.0858048 11.0639 0.182528 11.6131 0.733362L17.9372 6.90419C19.5589 8.52503 19.5681 11.16 17.9639 12.785L17.9647 12.7842ZM15.0997 11.3925L8.87058 5.21586C8.68474 5.03003 8.42391 4.9442 8.16474 4.9767L3.06891 5.6742L2.50308 10.7909C2.47558 11.0434 2.56224 11.2917 2.74224 11.4709L8.92224 17.5984C9.39641 18.0734 10.0239 18.3325 10.6914 18.3325H10.6997C11.3714 18.3309 12.0006 18.0667 12.4714 17.5884L15.1106 14.915C16.0731 13.94 16.0681 12.3592 15.0989 11.3909L15.0997 11.3925Z"
                                                fill="#DB1A1A" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_527_1288">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>
                                <div class="action-title">Generate AI Tags</div>
                                <div class="action-sub">AI intent based tags</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="action-card style-2 theme-card h-100">
                                <div class="action-icon-wrap">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.83333 5.00004H19.1667C19.3877 5.00004 19.5996 4.91224 19.7559 4.75596C19.9122 4.59968 20 4.38772 20 4.16671C20 3.94569 19.9122 3.73373 19.7559 3.57745C19.5996 3.42117 19.3877 3.33337 19.1667 3.33337H5.83333C5.61232 3.33337 5.40036 3.42117 5.24408 3.57745C5.0878 3.73373 5 3.94569 5 4.16671C5 4.38772 5.0878 4.59968 5.24408 4.75596C5.40036 4.91224 5.61232 5.00004 5.83333 5.00004Z"
                                            fill="#DB1A1A" />
                                        <path
                                            d="M19.1667 9.16663H5.83333C5.61232 9.16663 5.40036 9.25442 5.24408 9.4107C5.0878 9.56698 5 9.77895 5 9.99996C5 10.221 5.0878 10.4329 5.24408 10.5892C5.40036 10.7455 5.61232 10.8333 5.83333 10.8333H19.1667C19.3877 10.8333 19.5996 10.7455 19.7559 10.5892C19.9122 10.4329 20 10.221 20 9.99996C20 9.77895 19.9122 9.56698 19.7559 9.4107C19.5996 9.25442 19.3877 9.16663 19.1667 9.16663Z"
                                            fill="#DB1A1A" />
                                        <path
                                            d="M19.1667 15H5.83333C5.61232 15 5.40036 15.0878 5.24408 15.2441C5.0878 15.4004 5 15.6123 5 15.8333C5 16.0543 5.0878 16.2663 5.24408 16.4226C5.40036 16.5789 5.61232 16.6667 5.83333 16.6667H19.1667C19.3877 16.6667 19.5996 16.5789 19.7559 16.4226C19.9122 16.2663 20 16.0543 20 15.8333C20 15.6123 19.9122 15.4004 19.7559 15.2441C19.5996 15.0878 19.3877 15 19.1667 15Z"
                                            fill="#DB1A1A" />
                                        <path
                                            d="M1.66667 5.83333C2.58714 5.83333 3.33333 5.08714 3.33333 4.16667C3.33333 3.24619 2.58714 2.5 1.66667 2.5C0.746192 2.5 0 3.24619 0 4.16667C0 5.08714 0.746192 5.83333 1.66667 5.83333Z"
                                            fill="#DB1A1A" />
                                        <path
                                            d="M1.66667 11.6667C2.58714 11.6667 3.33333 10.9205 3.33333 10C3.33333 9.07957 2.58714 8.33337 1.66667 8.33337C0.746192 8.33337 0 9.07957 0 10C0 10.9205 0.746192 11.6667 1.66667 11.6667Z"
                                            fill="#DB1A1A" />
                                        <path
                                            d="M1.66667 17.5C2.58714 17.5 3.33333 16.7538 3.33333 15.8333C3.33333 14.9128 2.58714 14.1666 1.66667 14.1666C0.746192 14.1666 0 14.9128 0 15.8333C0 16.7538 0.746192 17.5 1.66667 17.5Z"
                                            fill="#DB1A1A" />
                                    </svg>


                                </div>
                                <div class="action-title">Add Key Takeaways</div>
                                <div class="action-sub">Summary for Al models</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="action-card style-2 theme-card h-100">
                                <div class="action-icon-wrap">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.2742 2.03748C11.743 1.88436 11.1898 2.19373 11.0367 2.72498L7.03672 16.725C6.88359 17.2562 7.19297 17.8094 7.72422 17.9625C8.25547 18.1156 8.80859 17.8062 8.96172 17.275L12.9617 3.27498C13.1148 2.74373 12.8055 2.19061 12.2742 2.03748ZM14.793 5.79061C14.4023 6.18123 14.4023 6.81561 14.793 7.20623L17.5836 9.99998L14.7898 12.7937C14.3992 13.1844 14.3992 13.8187 14.7898 14.2094C15.1805 14.6 15.8148 14.6 16.2055 14.2094L19.7055 10.7094C20.0961 10.3187 20.0961 9.68436 19.7055 9.29373L16.2055 5.79373C15.8148 5.40311 15.1805 5.40311 14.7898 5.79373L14.793 5.79061ZM5.20859 5.79061C4.81797 5.39998 4.18359 5.39998 3.79297 5.79061L0.292969 9.29061C-0.0976562 9.68123 -0.0976562 10.3156 0.292969 10.7062L3.79297 14.2062C4.18359 14.5969 4.81797 14.5969 5.20859 14.2062C5.59922 13.8156 5.59922 13.1812 5.20859 12.7906L2.41484 9.99998L5.20859 7.20623C5.59922 6.81561 5.59922 6.18123 5.20859 5.79061Z"
                                            fill="#DB1A1A" />
                                    </svg>


                                </div>
                                <div class="action-title">Add Schema Markup</div>
                                <div class="action-sub">Structure for Al parsing</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 no-print">
                        <button class="btn btn-primary w-75" ng-click="optimizevideo()">Optimize Now</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="theme-card h-100 d-flex flex-column">
                    <h6 class="title-color d-flex align-items-center">
                        <i class="fa-solid fa-chart-line text-primary me-2"></i>
                        Analysis Summary
                    </h6>
                    <div class="flex-grow-1 mb-2">
                        <div style="overflow-y: auto; max-height: 88px; margin-right: -15px; padding-right: 15px;">
                            <p style="font-size:12px;">{{video.summary}}</p>
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
    <!--<form id="videoPdfForm" action="<?php echo base_url('export-video-analysis-pdf') ?>" method="POST"-->
    <!--    style="display:none;">-->
    <!--    <input type="hidden" name="pdf_data" id="video_pdf_data_input">-->
    <!--</form>-->
    <form id="videoPdfForm" action="<?php echo base_url('export-video-analysis-pdf') ?>" method="POST" style="display:none;">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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

                var queryStr = "<?php echo base_url('analyze-video') ?>";

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


            $scope.getanalyzedata = function (id) {
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

                var queryStr = "<?php echo base_url('optimize-with-ai') ?>";

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
                            var encodedId = btoa($scope.id).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');

                            window.location.href = "<?php echo base_url('optimize-data') ?>/" + encodedId;
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

            // $scope.downloadPDF = function () {
                
                
            //     if (!$scope.video) {
            //         toastr.error("Please analyze the video first!");
            //         return;
            //     }
            //     var payload = {
            //         analyze_data: $scope.video
            //     };

            //     var dataInput = document.getElementById('video_pdf_data_input');
            //     // dataInput.value = JSON.stringify($scope.video);
            //   dataInput.value = JSON.stringify(payload);
               
            //   console.log(document.getElementById('video_pdf_data_input').value);
            //     document.getElementById('videoPdfForm').submit();

            //     toastr.success("Generating your video analysis report...");
            // };
            $scope.downloadPDF = function () {
            if (!$scope.video) {
                toastr.error("Please analyze the video first!");
                return;
            }
            
            var payload = {
                analyze_data: $scope.video
            };
        
            var jsonString = angular.toJson(payload);
        
            var base64SafeData = btoa(unescape(encodeURIComponent(jsonString)));
        
            var dataInput = document.getElementById('video_pdf_data_input');
            dataInput.value = base64SafeData;
            
            var form = document.getElementById('videoPdfForm');
            var csrfName = "<?php echo $this->security->get_csrf_token_name(); ?>";
            var csrfInput = form.querySelector('input[name="' + csrfName + '"]');
            if(csrfInput) {
                var matches = document.cookie.match(new RegExp('(?:^|; )' + csrfName + '=([^;]*)'));
                if(matches) {
                    csrfInput.value = decodeURIComponent(matches[1]);
                }
            }
        
            toastr.success("Generating your video analysis report...");
            form.submit();
        };

        });


        // Loader
        function jsLoader(show) {
            $(".temp_js_loader").remove();
            if (show) {
                $("body").append(
                    '<div class="temp_js_loader" style="background:rgba(200,200,200,0.34);width:100%;height:100%;position:fixed;top:0;left:0;z-index:9999;">' +
                    '<img src="<?php echo $this->config->item('assetsPath'); ?>themes/default/img/loading-icon.gif" style="position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;">' +
                    '</div>'
                );
            }
        }


    </script>