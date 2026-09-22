<!-- Bootstrap Select (BS5 COMPATIBLE VERSION) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" />
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title><?php echo $this->config->item('productName') ?> | Competitor Spy</title>

<style>
    [ng\:cloak],
    [ng-cloak],
    [data-ng-cloak],
    [x-ng-cloak],
    .ng-cloak,
    .x-ng-cloak {
        display: none !important;
    }
    
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-cloak ng-controller="CompetitorCntrl">
    <div class="container-fluid container-padding">
        <div  ng-if="showDiv" ng-clock>
            <div class="row align-items-center row-gap-2 mb-3">
                <div class="col-md-6">
                    <div class="page-header-title d-flex align-items-center gap-2">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <div>
                            <h3 class="title">Competitor Spy</h3>
                            <p class="desc">Analyze competitors to find content gaps, top performing videos & AI visibility opportunities.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-primary" ng-click="exportPDF()"><i class="fa-solid fa-arrow-down-to-bracket"></i> Export Report</button>
                    <!-- <a href="javascript:void(0)" class="btn btn-dark"><i class="fa-solid fa-clock-rotate-left"></i> History</a> -->
                </div>
            </div>
            <div class="row gap-0 g-3">
                <div class="col-12 d-none">
                    <div class="theme-card">
                        <div class="row gap-0 g-3 align-items-end">
                            <div class="col-lg-5">
                                <label for="ytUrl" class="form-label">Enter competitor channel or URL</label>
                                <input type="url" class="form-control" ng-model="channelInput" id="ytUrl" name="ytUrl" placeholder="Enter channel URL...">    
                            </div>
                            <div class="col-lg-1" style="max-width: fit-content;">
                                <div style="font-size: 20px; text-align: center; font-weight: 600; text-transform: capitalize; color: var(--primary-color);">Or</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="selectChannel" class="form-label">Enter Channel Name</label>
                                <input type="text" class="form-control" ng-model="channel_id" id="selectChannel" name="selectChannel" placeholder="Enter channel Name...">   
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-primary w-100" style="font-size:13px;" ng-click="comparevideo()"><i class="fa-solid fa-magnifying-glass"></i> Analyze Competitor</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="theme-card">
                        <div class="row gap-0 g-lg-3 g-4">
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6" style="border-right: 1px solid var(--theme-br);">
                                <div class="channel-profile">
                                    <div class="channel-avatar">
                                        <!-- <img src="https://i.pravatar.cc/160?img=68" alt="Avatar" loading="lazy"> -->
                                        <img ng-src="{{channel.thumbnail}}" alt="Avatar" loading="lazy">
                                    </div>
                                    <div>
                                        <div class="channel-name">
                                            <!--Ali Abdaal-->
                                            {{channel.title}}
                                            <i class="fa-solid fa-circle-check"></i>
                                        </div>
                                        <!--<div class="channel-meta">@aliabdaal &nbsp;·&nbsp; 5.21M subscribers &nbsp;·&nbsp; 523 videos</div>-->
                                        <div class="channel-meta">{{formatViewsJS(channel.subscribers)}} subscribers • {{channel.videos | number}} videos</div>
                                        <div class="channel-tag">Education</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6" style="border-right: 1px solid var(--theme-br);">
                                
                                <div class="d-flex align-items-center flex-column">
                                    <div class="lbl">AEO Visibility Score</div>
                                    <div class="aeo-strip-wrap">
                                        <div class="radial-mini">
                                            <!--<div class="score-circle" style="--percent: 72;">-->
                                            <div 
                                                class="score-circle"
                                                style="
                                                    --percent: {{ai.AI_Competitor_Spy_Dashboard.Overall_Score.AEO_Visibility_Score.score}};
                                                    --score-color: {{ ai.AI_Competitor_Spy_Dashboard.Overall_Score.AEO_Visibility_Score.score <= 40 ? '#ef4444' : (ai.AI_Competitor_Spy_Dashboard.Overall_Score.AEO_Visibility_Score.score <= 70 ? '#facc15' : '#22c55e') }};
                                                "
                                            >
                                                <svg viewBox="0 0 100 100">
                                                    <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                    <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                </svg>
                                                <!--<div class="num">72</div>-->
                                                <div class="num">{{ai.AI_Competitor_Spy_Dashboard.Overall_Score.AEO_Visibility_Score.score}}</div>
                                            </div>
                                        </div>
                                        <div class="aeo-label-group">
                                            <!-- <div class="score-val">72 <span>/100</span></div> -->
                                            <div class="score-val">{{ai.AI_Competitor_Spy_Dashboard.Overall_Score.AEO_Visibility_Score.score}}/100</div>
                                            <!-- <div class="good">Good</div> -->
                                            <div class="good">{{ai.AI_Competitor_Spy_Dashboard.Overall_Score.AEO_Visibility_Score.label}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-4 col-sm-4" style="border-right: 1px solid var(--theme-br);">
                                <div class="stat-block">
                                    <div class="stat-block-label">Top AI Mentions</div>
                                    <div class="stat-block-value">
                                        <!--1,842-->
                                        {{ai.AI_Competitor_Spy_Dashboard.Top_AI_Mentions.count}}
                                        <!-- <span class="change-pos">+18%</span> -->
                                        <span class="change-pos">{{ai.AI_Competitor_Spy_Dashboard.Top_AI_Mentions.growth}}</span>
                                    </div>
                                    <div class="stat-block-sub">vs last 30 days</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-4 col-sm-4" style="border-right: 1px solid var(--theme-br);">
                                <div class="stat-block">
                                    <div class="stat-block-label">High Performing Topics</div>
                                    <!--<div class="stat-block-value">12</div>-->
                                    <div class="stat-block-value">{{ai.AI_Competitor_Spy_Dashboard.High_Performing_Topics.length}}</div>
                                    <div class="stat-block-sub">Topics identified</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-4 col-sm-4">
                                <div class="stat-block">
                                    <div class="stat-block-label">Estimated AI Traffic</div>
                                    <div class="stat-block-value">
                                        <!--28.7K-->
                                        {{ai.AI_Competitor_Spy_Dashboard.Estimated_AI_Traffic.monthly_traffic}}
                                        <!-- <span class="change-pos">+23%</span> -->
                                        <span class="change-pos">{{ai.AI_Competitor_Spy_Dashboard.Estimated_AI_Traffic.growth}}</span>
                                    </div>
                                    <div class="stat-block-sub">Monthly</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="theme-card mb-3">
                        <h6 class="card-head">Performance Overview</h6>
                        <div class="row gap-0 g-3">
                            <div class="col-xl-3">
                                <div class="perf-card">
                                    <div class="perf-label">Total Views</div>
                                    <!--<h4 class="perf-value">156.8M <span class="change-pos">+14%</span></h4>-->
                                    <h4 class="perf-value">{{formatViewsJS(channel.views)}} <span class="change-pos">{{ai.AI_Competitor_Spy_Dashboard.Performance_Overview.Total_Views.growth}}</span></h4>
                                    <div class="perf-sub">vs last 30 days</div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="perf-card">
                                    <div class="perf-label">Avg. Views per Video</div>
                                    <!--<h4 class="perf-value">156.8M <span class="change-pos">+14%</span></h4>-->
                                    <h4 class="perf-value">{{avg_views | number}} <span class="change-pos">{{ai.AI_Competitor_Spy_Dashboard.Performance_Overview.Avg_Views_Per_Video.growth}}</span></h4>
                                    <div class="perf-sub">vs last 30 days</div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="perf-card">
                                    <div class="perf-label">Engagement Rate</div>
                                    <!--<h4 class="perf-value">156.8M <span class="change-pos">+14%</span></h4>-->
                                    <h4 class="perf-value">{{engagement_rate}} <span class="change-pos">{{ai.AI_Competitor_Spy_Dashboard.Performance_Overview.Engagement_Rate.growth}}</span></h4>
                                    <div class="perf-sub">vs last 30 days</div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="perf-card">
                                    <div class="perf-label">Top AI Rank Keywords</div>
                                    <!--<h4 class="perf-value">156.8M <span class="change-pos">+14%</span></h4>-->
                                    <h4 class="perf-value">{{ai.AI_Competitor_Spy_Dashboard.Top_AI_Rank_Keywords.Keyword_Optimization_Score.score}} <span class="change-pos">{{ai.AI_Competitor_Spy_Dashboard.Performance_Overview.Top_AI_Rank_Keywords.growth}}</span></h4>
                                    <div class="perf-sub">vs last 30 days</div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-area mt-3 d-none">
                            <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                <h6 class="chart-title mb-0">AI Visibility Score Over Time</h6>
                                <div>
                                    <select class="selectpicker" id="range" data-width="auto">
                                        <option value="60" selected>Last 60 Days</option>
                                        <option value="30">Last 30 Days</option>
                                        <option value="15">Last 15 Days</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="chart-wrap">
                                <div id="chart"></div>
                            </div>
                            <div class="chart-note">
                                <i class="fa-sharp fa-regular fa-circle-info text-primary"></i>
                                AEO Visibility Score shows how often this channel and its content appear in AI tool responses.
                            </div>
                        </div>
                    </div>
                    <div class="row gap-0 g-3">
                        <div class="col-xl-12">
                            <div class="video-card h-100">
                                <div class="video-card-header">
                                    <span class="video-card-title">Top Performing Videos</span>
                                    <!-- <a href="javascript:void(0);" class="btn-view-all">View All</a> -->
                                </div>
                                <div class="table-responsive" style="overflow-y: auto;max-height: 735px;padding-right: 15px !important;margin-right: -15px;">
                                    <table class="custom-video-table">
                                        <thead style="position: sticky;top: 0;background: var(--theme-bg);z-index: 1;box-shadow: 0 1px 0 0 var(--theme-br);">
                                            <tr>
                                            <th class="th-video">Video</th>
                                            <th class="th-views">Views</th>
                                            <th class="th-engagement">Engagement</th>
                                            <th class="th-score">AEO Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="video in ai.AI_Competitor_Spy_Dashboard.Top_Performing_Videos">
                                                <td class="td-video">
                                                    <div class="video-cell">
                                                        <div class="video-thumb">
                                                            <img ng-src="{{video.thumbnail || channel.thumbnail}}" style="width:60px;height:60px;border-radius:10px;object-fit:cover;">
                                                        </div>
                                                        <div class="video-info-text">
                                                            <!-- <div class="video-title">How I Take Smart Notes</div> -->
                                                            <div class="video-title">{{video.title}}</div>
                                                            <!-- <div class="video-date">Mar 12, 2024</div> -->
                                                            <div class="video-date">{{video.published_date}}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td class="td-stat">2.4M</td> -->
                                                <td class="td-stat">{{video.views}}</td>
                                                <!-- <td class="td-stat">8.7%</td> -->
                                                <td class="td-stat">{{video.engagement_rate}}</td>
                                                <td class="td-score">
                                                    <div class="score-ring">
                                                       <!-- <div class="score-circle" style="--percent: 85;"> -->
                                                       <div 
                                                            class="score-circle"
                                                            style="
                                                                --percent: {{video.aeo_score}};
                                                                --score-color: {{ video.aeo_score <= 40 ? '#ef4444' : (video.aeo_score <= 70 ? '#facc15' : '#22c55e') }};
                                                            "
                                                        >
                                                            <svg viewBox="0 0 100 100">
                                                                <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                                <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                            </svg>
                                                            <!-- <div class="num">85</div> -->
                                                            <div class="num">{{video.aeo_score}}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td class="td-video">
                                                    <div class="video-cell">
                                                        <div class="video-thumb">
                                                            
                                                        </div>
                                                        <div class="video-info-text">
                                                            <div class="video-title">How I Take Smart Notes</div>
                                                            <div class="video-date">Mar 12, 2024</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="td-stat">2.4M</td>
                                                <td class="td-stat">8.7%</td>
                                                <td class="td-score">
                                                    <div class="score-ring">
                                                       <div class="score-circle" style="--percent: 85;">
                                                            <svg viewBox="0 0 100 100">
                                                                <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                                <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                            </svg>
                                                            <div class="num">85</div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-video">
                                                    <div class="video-cell">
                                                        <div class="video-thumb">
                                                            
                                                        </div>
                                                        <div class="video-info-text">
                                                            <div class="video-title">How I Take Smart Notes</div>
                                                            <div class="video-date">Mar 12, 2024</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="td-stat">2.4M</td>
                                                <td class="td-stat">8.7%</td>
                                                <td class="td-score">
                                                    <div class="score-ring">
                                                       <div class="score-circle" style="--percent: 85;">
                                                            <svg viewBox="0 0 100 100">
                                                                <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                                <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                            </svg>
                                                            <div class="num">85</div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 d-none">
                            <div class="card h-100">
                                <div class="tbl-head">
                                    <h5 class="tbl-title">Top Content Gaps <span style="font-size:11px;font-weight:400;color:#9ca3af;">(Opportunities)</span></h5>
                                    <!-- <a href="javascript:void(0);" class="view-all">View All</a> -->
                                </div>
                                <div class="gap-col-head">
                                    <span>Topic / Query</span>
                                    <span>Search Volume</span>
                                </div>
                                <div class="custom-scroll scrollbar-none" >
                                    <div class="gap-row" ng-repeat="gap in ai.AI_Competitor_Spy_Dashboard.Top_Content_Gaps">
                                        <!--<span class="gap-query">how to stay consistent</span>-->
                                        <span class="gap-query">{{gap.Keyword_Query}}</span>
                                        <div class="gap-right">
                                            <!--<span class="gap-vol">8.1K</span>-->
                                            <span class="gap-vol">{{gap.Search_Volume}}</span>
                                            <!--<span class="card-badge high">High</span>-->
                                            <span class="card-badge" ng-class="{
                                                    'high': gap.Competition == 'High',
                                                    'medium': gap.Competition == 'Medium',
                                                    'low': gap.Competition == 'Low'
                                                  }">
                                                  {{gap.Competition}}
                                                  </span>
                                        </div>
                                    </div>
                                    <!--<div class="gap-row">-->
                                    <!--    <span class="gap-query">best productivity apps 2024</span>-->
                                    <!--    <div class="gap-right">-->
                                    <!--        <span class="gap-vol">5.4K</span>-->
                                    <!--        <span class="card-badge high">High</span>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="gap-row">-->
                                    <!--    <span class="gap-query">time blocking tutorial</span>-->
                                    <!--    <div class="gap-right">-->
                                    <!--        <span class="gap-vol">4.4K</span>-->
                                    <!--        <span class="card-badge medium">Medium</span>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="gap-row">-->
                                    <!--    <span class="gap-query">how to build a second brain</span>-->
                                    <!--    <div class="gap-right">-->
                                    <!--        <span class="gap-vol">3.6K</span>-->
                                    <!--        <span class="card-badge medium">Medium</span>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="gap-row">-->
                                    <!--    <span class="gap-query">morning routine for success</span>-->
                                    <!--    <div class="gap-right">-->
                                    <!--        <span class="gap-vol">3.2K</span>-->
                                    <!--        <span class="card-badge medium">Medium</span>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card mb-3">
                        <div class="tbl-head">
                            <h5 class="tbl-title">Top Performing Topics</h5>
                            <!-- <a href="javascript:void(0);" class="view-all">View All</a> -->
                        </div>
                        <div class="custom-table">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Topic</th>
                                            <th>Est. AI Traffic</th>
                                            <th>AEO Score</th>
                                        </tr>
                                    </thead>
                                    <tbody class="custom-scroll scrollbar-none" >
                                        <tr ng-repeat="topic in ai.AI_Competitor_Spy_Dashboard.High_Performing_Topics">
                                            <td class="td-num">{{$index + 1}}</td>
                                            <!-- <td class="td-name">Productivity Tips</td> -->
                                            <td class="td-name">{{topic.Topic}}</td>
                                            <!-- <td class="td-traffic">8.7K</td> -->
                                            <td class="td-traffic">{{topic.Estimated_AI_Traffic}}</td>
                                            <td class="td-score">
                                                <div class="score-ring">
                                                    <!-- <div class="score-circle" style="--percent: 82;"> -->
                                                    <div 
                                                        class="score-circle"
                                                        style="
                                                            --percent: {{topic.AEO_Score}};
                                                            --score-color: {{ topic.AEO_Score <= 40 ? '#ef4444' : (topic.AEO_Score <= 70 ? '#facc15' : '#22c55e') }};
                                                        "
                                                    >
                                                        <svg viewBox="0 0 100 100">
                                                            <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                            <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                        </svg>
                                                        <!-- <div class="num">82</div> -->
                                                        <div class="num">{{topic.AEO_Score}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td class="td-num">2</td>
                                            <td class="td-name">Study With Me</td>
                                            <td class="td-traffic">6.4K</td>
                                            <td class="td-score">
                                                <div class="score-ring">
                                                    <div class="score-circle" style="--percent: 78;">
                                                        <svg viewBox="0 0 100 100">
                                                            <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                            <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                        </svg>
                                                        <div class="num">78</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-num">3</td>
                                            <td class="td-name">Building Habits</td>
                                            <td class="td-traffic">4.9K</td>
                                            <td class="td-score">
                                                <div class="score-ring">
                                                    <div class="score-circle" style="--percent: 74;">
                                                        <svg viewBox="0 0 100 100">
                                                            <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                            <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                        </svg>
                                                        <div class="num">74</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-num">4</td>
                                            <td class="td-name">Career Advice</td>
                                            <td class="td-traffic">3.8K</td>
                                            <td class="td-score">
                                                <div class="score-ring">
                                                    <div class="score-circle" style="--percent: 68;">
                                                        <svg viewBox="0 0 100 100">
                                                            <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                            <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                        </svg>
                                                        <div class="num">68</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-num">5</td>
                                            <td class="td-name">Notion Tutorials</td>
                                            <td class="td-traffic">2.9K</td>
                                            <td class="td-score">
                                                <div class="score-ring">
                                                    <div class="score-circle" style="--percent: 63;">
                                                        <svg viewBox="0 0 100 100">
                                                            <circle class="bg" cx="50" cy="50" r="44"></circle>
                                                            <circle class="progress" cx="50" cy="50" r="44"></circle>
                                                        </svg>
                                                        <div class="num">63</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="tbl-head">
                            <h5 class="tbl-title">Top AI Mentions</h5>
                            <!-- <a href="javascript:void(0);" class="view-all">View All</a> -->
                        </div>
                        <div class="gap-col-head">
                            <span>AI Platform</span>
                            <div class="d-flex align-items-center gap-2">    
                                <span>Mentions</span>
                                <span>Change</span>
                            </div>
                        </div>
                        <div class="custom-scroll scrollbar-none" >
                            <div class="gap-row"  ng-repeat="mention in ai.AI_Competitor_Spy_Dashboard.Top_AI_Mentions.platforms">
                                <div class="gap-query d-flex align-items-center gap-2">
                                    <div class="logo">
                                        <!-- <img src="<?php echo $this->config->item('assetsPath') ?>images/chatgpt-app.svg" class="GPT"> -->
                                         <img ng-src="{{getAiLogo(mention.Platform)}}" class="GPT">
                                    </div>
                                    <!--<span class="name">ChatGPT</span>-->
                                    <span class="name">{{mention.Platform}}</span>
                                </div>
                                <div class="gap-right">
                                    <!--<span class="gap-vol">842</span>-->
                                    <span class="gap-vol">{{mention.Mentions}}</span>
                                    <!--<span class="card-badge high">+20%</span>-->
                                    <span class="card-badge high">{{mention.Growth}}</span>
                                </div>
                            </div>
                            <!--<div class="gap-row">-->
                            <!--    <div class="gap-query d-flex align-items-center gap-2">-->
                            <!--        <div class="logo">-->
                            <!--            <img src="<?php echo $this->config->item('assetsPath') ?>images/gemini-app.svg" class="gemini">-->
                            <!--        </div>-->
                            <!--        <span class="name">Gemini</span>-->
                            <!--    </div>-->
                            <!--    <div class="gap-right">-->
                            <!--        <span class="gap-vol">612</span>-->
                            <!--        <span class="card-badge high">+15%</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="gap-row">-->
                            <!--    <div class="gap-query d-flex align-items-center gap-2">-->
                            <!--        <div class="logo">-->
                            <!--            <img src="<?php echo $this->config->item('assetsPath') ?>images/grok-ai-app.svg" class="grok-ai">-->
                            <!--        </div>-->
                            <!--        <span class="name">Grok</span>-->
                            <!--    </div>-->
                            <!--    <div class="gap-right">-->
                            <!--        <span class="gap-vol">278</span>-->
                            <!--        <span class="card-badge high">+25%</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="gap-row">-->
                            <!--    <div class="gap-query d-flex align-items-center gap-2">-->
                            <!--        <div class="logo">-->
                            <!--            <img src="<?php echo $this->config->item('assetsPath') ?>images/claude-app.svg" class="claude">-->
                            <!--        </div>-->
                            <!--        <span class="name">Claude</span>-->
                            <!--    </div>-->
                            <!--    <div class="gap-right">-->
                            <!--        <span class="gap-vol">110</span>-->
                            <!--        <span class="card-badge high">+18%</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="card">
                        <div class="tbl-head">
                            <h5 class="tbl-title">Top Content Gaps <span style="font-size:11px;font-weight:400;color:#9ca3af;">(Opportunities)</span></h5>
                            <!-- <a href="javascript:void(0);" class="view-all">View All</a> -->
                        </div>
                        <div class="gap-col-head">
                            <span>Topic / Query</span>
                            <span>Search Volume</span>
                        </div>
                        <div class="custom-scroll scrollbar-none" >
                            <div class="gap-row" ng-repeat="gap in ai.AI_Competitor_Spy_Dashboard.Top_Content_Gaps">
                                <!--<span class="gap-query">how to stay consistent</span>-->
                                <span class="gap-query">{{gap.Keyword_Query}}</span>
                                <div class="gap-right">
                                    <!--<span class="gap-vol">8.1K</span>-->
                                    <span class="gap-vol">{{gap.Search_Volume}}</span>
                                    <!--<span class="card-badge high">High</span>-->
                                    <span class="card-badge" ng-class="{
                                            'high': gap.Competition == 'High',
                                            'medium': gap.Competition == 'Medium',
                                            'low': gap.Competition == 'Low'
                                            }">
                                            {{gap.Competition}}
                                            </span>
                                </div>
                            </div>
                            <!--<div class="gap-row">-->
                            <!--    <span class="gap-query">best productivity apps 2024</span>-->
                            <!--    <div class="gap-right">-->
                            <!--        <span class="gap-vol">5.4K</span>-->
                            <!--        <span class="card-badge high">High</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="gap-row">-->
                            <!--    <span class="gap-query">time blocking tutorial</span>-->
                            <!--    <div class="gap-right">-->
                            <!--        <span class="gap-vol">4.4K</span>-->
                            <!--        <span class="card-badge medium">Medium</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="gap-row">-->
                            <!--    <span class="gap-query">how to build a second brain</span>-->
                            <!--    <div class="gap-right">-->
                            <!--        <span class="gap-vol">3.6K</span>-->
                            <!--        <span class="card-badge medium">Medium</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="gap-row">-->
                            <!--    <span class="gap-query">morning routine for success</span>-->
                            <!--    <div class="gap-right">-->
                            <!--        <span class="gap-vol">3.2K</span>-->
                            <!--        <span class="card-badge medium">Medium</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="create-first" ng-show="!showDiv">
            <div class="mx-auto" style="max-width: 890px;">
                <div class="row row-gap-2">
                    <div class="col-12 text-center mb-2 mb-sm-4">
                        <h1 class="title-color fw-bold">
                            Competitor Growth Tracker
                        </h1>
                        <p class="mb-0">Enter a YouTube video URL or channel name to analyze competitors and grow smarter.</p>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-link text-primary fs-6"></i>
                            <label class="form-label">Type and Paste YouTube Video Url</label>
                        </div>
                        <div class="youTube-analytics-bar-parent">
                            <div class="icon-parent">
                                <i class="fa-solid fa-link"></i>
                            </div>
                            <div class="youTube-analytics-bar theme-card flex-column flex-sm-row">
                                <input class="form-control px-0 order-1 order-sm-0 text-center text-sm-start" ng-model="channelInput" value="" type="url" placeholder="Paste YouTube Link Here..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 mx-auto my-3">
                        <div class="d-flex align-items-center gap-2">
                            <hr class="m-0 w-50">
                            <span>OR</span>
                            <hr class="m-0 w-50">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-at text-primary fs-6"></i>
                            <label class="form-label">Type YouTube Channel Name</label>
                        </div>
                        <div class="youTube-analytics-bar-parent">
                            <div class="icon-parent">
                                <i class="fa-solid fa-at"></i>
                            </div>
                            <div class="youTube-analytics-bar theme-card flex-column flex-sm-row">
                                <input class="form-control px-0 order-1 order-sm-0 text-center text-sm-start" ng-model="channel_id" value="channelname" type="text" placeholder="Type YouTube Channel Name..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-none">
                        <div class="chip-primary d-flex align-items-center gap-2 text-primary">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            Channel name should start using "@" sign
                        </div>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-primary" ng-click="comparevideo()">
                            <i class="fa-solid fa-people-group"></i> Analyze Competitors
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="pdfForm" action="<?php echo base_url('export-competitor-pdf') ?>" method="POST" style="display:none;"> 
        <input type="hidden" name="pdf_data" id="pdf_data_input">
    </form>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> -->

    <!-- Performance Chart -->
    <script>
        $(window).on('load', function(){
        $('.selectpicker').selectpicker('render');
        });

        function formatXAxisLabels(labels, maxLabels = 6) {
        const step = Math.ceil(labels.length / maxLabels);

        return labels.map((label, i) => {
            return (i % step === 0 || i === labels.length - 1) ? label : '';
        });
        }

        const initialLabels = ['Apr 20','Apr 23','Apr 27','Apr 30','May 4','May 7','May 11','May 14','May 18','May 21','May 25','May 28','Jun 1','Jun 4','Jun 8','Jun 11','Jun 15'];

        const options = {
        series: [{
            data: [35,32,45,40,50,42,52,48,60,55,47,65,67,63,52,61,62]
        }],
        chart: {
            type: 'area',
            height: 300,
            toolbar: { show: false },
            zoom: { enabled: false }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        colors: ['#ff0000'],

        fill: {
            type: 'gradient',
            gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.35,
            opacityTo: 0,
            stops: [0, 100]
            }
        },

        markers: {
            size: 3,
            strokeWidth: 0
        },

        dataLabels: {
            enabled: false
        },

        xaxis: {
            categories: formatXAxisLabels(initialLabels)
        },

        yaxis: {
            min: 0,
            max: 100,
            tickAmount: 4
        },

        grid: {
            borderColor: '#eee'
        }
        };

        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        function getLastNDays(n) {
        const dates = [];
        const today = new Date();

        for (let i = n - 1; i >= 0; i--) {
            const d = new Date();
            d.setDate(today.getDate() - i);

            dates.push(
            d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
            );
        }

        return dates;
        }

        const datasets = {
        60: {
            data: Array.from({length:60}, () => Math.floor(Math.random()*40)+30),
            labels: getLastNDays(60)
        },
        30: {
            data: Array.from({length:30}, () => Math.floor(Math.random()*40)+30),
            labels: getLastNDays(30)
        },
        15: {
            data: Array.from({length:15}, () => Math.floor(Math.random()*40)+30),
            labels: getLastNDays(15)
        }
        };

        $('#range').on('changed.bs.select', function () {
        const val = $(this).val();
        const selected = datasets[val];

        chart.updateOptions({
            series: [{ data: selected.data }],
            xaxis: {
            categories: formatXAxisLabels(selected.labels)
            }
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

        app.controller('CompetitorCntrl', function ($scope, $http) {

            $scope.channelInput = "";
            $scope.channel_id = "";
            $scope.showDiv = false;

            $scope.formatViewsJS = function(num) {
                if(!num) return '0';
                if (num >= 1000000000) return (num / 1000000000).toFixed(1) + 'B';
                if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
                if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
                return num;
            };

            // $scope.comparevideo = function () {
            //     if (!$scope.url) {
            //         toastr.error("Please Enter a youtube video url");
            //         return;
            //     }

            //     jsLoader(true);

            //     var queryStr = "<?php echo base_url('analyze-video')?>";

            //     $http({
            //         method: 'POST',
            //         url: queryStr,
            //         data: $.param({
            //             'videourl': $scope.url
            //         }),
            //         headers: {
            //             'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            //         }
            //     })
            //         .then(function (response) {
            //             console.log(response)
            //             jsLoader(false);
            //             if (response.data.success) {
            //                 $scope.analysisData = response.data.analyze_data;
            //                 $scope.id = response.data.id;
                            
            //                 $scope.getanalyzedata($scope.id)
                            
            //                 toastr.success(response.data.msg);
            //             } else {
            //                 toastr.error(response.data.msg);
            //             }
            //         })
            //         .catch(function (err) {
            //             jsLoader(false);
            //             console.error(err);
            //             toastr.error("Something went wrong!");
            //         });
            // };
            
            $scope.comparevideo = function () {

                // if (!$scope.channelInput || !$scope.channel_id) {
                //     toastr.error("Please enter channel URL / ID / Name");
                //     return;
                // }
                if ($scope.channelInput && $scope.channel_id) {
                    toastr.error("Please enter only one input (either Channel URL or Name)");
                    return;
                }
                if ((!$scope.channelInput || $scope.channelInput.trim() === '') &&
                    (!$scope.channel_id || $scope.channel_id.trim() === '')
                ) {
                    console.log($scope.channel_id, "channel id1");
                    toastr.error("Please enter channel URL / ID / Name");
                    return;
                }
                if ($scope.channel_id && ($scope.channel_id.includes('http://') || $scope.channel_id.includes('https://') || $scope.channel_id.includes('youtube.com'))) {
                    toastr.error("Please paste URLs in the 'Channel URL' field only, not in Channel Name.");
                    return;
                }
            
                jsLoader(true);
            
                var queryStr = "<?php echo base_url('competitor-spy-analyze')?>";
            
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        'channel_url': $scope.channelInput,
                        'channel_id': $scope.channel_id
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function (response) {
                    console.log($scope.channel_id, "channel id");
            
                    jsLoader(false);
            
                    console.log(response.data);
            
                    if (response.data.status) {
            
                        $scope.analysisData = response.data;
                        $scope.channel = response.data.channel;
                        $scope.videos = response.data.videos;
                        $scope.ai = response.data.ai_analysis;
                        $scope.avg_views = response.data.avg_views;
                        $scope.engagement_rate = response.data.engagement_rate;
                        $scope.showDiv = true;
                        toastr.success("Analyze Completed");
            
                    } else {
                        $scope.showDiv = false;
                        toastr.error(response.data.message);
                    }
                })
                .catch(function (err) {
                    jsLoader(false);
                    console.error(err);
                    toastr.error("Something went wrong!");
                });
            };
             $scope.getAiLogo = function(platform){
            // alert("hello");
            console.log(platform, "platformssssss");

            if(platform == 'ChatGPT'){
                return '<?php echo $this->config->item('assetsPath') ?>images/chatgpt-app.svg';
            }

            if(platform == 'Gemini'){
                return '<?php echo $this->config->item('assetsPath') ?>images/gemini-app.svg';
            }

            if(platform == 'Grok'){
                return '<?php echo $this->config->item('assetsPath') ?>images/grok-ai-app.svg';
            }

            if(platform == 'Claude'){
                return '<?php echo $this->config->item('assetsPath') ?>images/claude-app.svg';
            }

            return '<?php echo $this->config->item('assetsPath') ?>images/chatgpt-app.svg';
        }
            // $scope.exportPDF = function () {
            //     if (!$scope.analysisData) {
            //         toastr.error("Please analyze a competitor first before exporting!");
            //         return;
            //     }

            //     jsLoader(true);

            //     const { jsPDF } = window.jspdf;
            //     const element = document.querySelector('.container-fluid');

            //     html2canvas(element, {
            //         useCORS: true, // Thumnails load karne ke liye zaroori hai
            //         scale: 2,
            //         allowTaint: true,
            //         logging: false
            //     }).then(canvas => {
            //         const imgData = canvas.toDataURL('image/png');
                    
            //         // A4 size PDF setup
            //         const pdf = new jsPDF('p', 'mm', 'a4');
            //         const imgProps = pdf.getImageProperties(imgData);
            //         const pdfWidth = pdf.internal.pageSize.getWidth();
            //         const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            //         // Image ko PDF
            //         pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                    
            //         // File save karna channel ke naam se
            //         let filename = "Competitor_Spy_" + $scope.channel.title.replace(/\s+/g, '_') + ".pdf";
            //         pdf.save(filename);
                    
            //         jsLoader(false);
            //         toastr.success("PDF Downloaded successfully!");
            //     }).catch(err => {
            //         console.error("PDF Error: ", err);
            //         jsLoader(false);
            //         toastr.error("An error occurred while generating the PDF!");
            //     });
            // };

            $scope.exportPDF = function () { 
                if (!$scope.analysisData) {
                    toastr.error("Please analyze a competitor first before exporting!");
                    return;
                }

                var dataInput = document.getElementById('pdf_data_input');
                dataInput.value = JSON.stringify($scope.analysisData);
                
                document.getElementById('pdfForm').submit();
                
                toastr.success("Generating your PDF report...");
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