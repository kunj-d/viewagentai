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
                                    <div class="lbl">Youtube Ranking Visibility Score</div>
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
                    <div class="row gap-0 g-3 mb-3">
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
                                            <th class="th-score">Youtube Ranking</th>
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
                                            <th>Youtube Ranking</th>
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
        <div class="theme-card pt-5 pb-5">
            <div class="create-first" ng-show="!showDiv">
                <div class="mx-auto" style="max-width: 1040px;">
                    <div class="row row-gap-2">
                        <div class="col-12 text-center mb-2 mb-sm-4 bottom-divider">
                            <h1 class="title-color fw-bold">
                                Competitor <span class="text-primary">Growth</span> Tracker
                            </h1>
                            <p class="mb-0">Enter a YouTube video URL or channel name to analyze competitors and grow smarter.</p>
                        </div>
                        <div class="col-12">
                            <div class="theme-card" style="background: var(--body-bg);">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <!-- <i class="fa-solid fa-link text-primary fs-6"></i> -->
                                     <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_236_2272)">
                                        <path d="M8.71164 14.3337H3.07447C2.30997 14.3337 1.66797 13.6553 1.66797 12.8618V5.50033H14.168V8.10366C14.168 8.38883 14.3828 8.62016 14.668 8.62016C14.9531 8.62016 15.168 8.38899 15.168 8.10366V3.14933C15.168 1.80383 14.0941 0.666992 12.7631 0.666992H3.07447C1.74047 0.666992 0.667969 1.78049 0.667969 3.14933V12.8618C0.667969 14.2248 1.74047 15.3337 3.07447 15.3337H8.71164C8.9968 15.3337 9.22814 15.1188 9.22814 14.8337C9.22814 14.5485 8.9968 14.3337 8.71164 14.3337ZM1.66797 3.14933C1.66797 2.36366 2.32297 1.66699 3.07447 1.66699H12.7631C13.5343 1.66699 14.168 2.36366 14.168 3.14933V4.50033H1.66797V3.14933Z" fill="#DB1A1A"/>
                                        <path d="M12.43 2.66699H12.2235C11.9384 2.66699 11.707 2.96516 11.707 3.25033C11.707 3.53549 11.9382 3.83366 12.2235 3.83366H12.43C12.7152 3.83366 12.9465 3.53549 12.9465 3.25033C12.9465 2.96516 12.7152 2.66699 12.43 2.66699Z" fill="#DB1A1A"/>
                                        <path d="M10.6722 2.66699H10.4657C10.1806 2.66699 9.94922 2.96516 9.94922 3.25033C9.94922 3.53549 10.1804 3.83366 10.4657 3.83366H10.6722C10.9574 3.83366 11.1887 3.53549 11.1887 3.25033C11.1887 2.96516 10.9576 2.66699 10.6722 2.66699Z" fill="#DB1A1A"/>
                                        <path d="M8.81675 2.66699H8.61025C8.32508 2.66699 8.09375 2.96516 8.09375 3.25033C8.09375 3.53549 8.32492 3.83366 8.61025 3.83366H8.81675C9.10192 3.83366 9.33325 3.53549 9.33325 3.25033C9.33325 2.96516 9.10192 2.66699 8.81675 2.66699Z" fill="#DB1A1A"/>
                                        <path d="M8.48058 10.0692C8.02591 9.61454 8.02591 8.87454 8.48058 8.41988L8.48774 8.41271C8.94308 7.96471 9.67808 7.96671 10.1306 8.41921L11.3346 9.62321C11.5362 9.82488 11.8632 9.82488 12.0649 9.62321C12.2666 9.42154 12.2666 9.09454 12.0649 8.89288L10.8607 7.68871C10.0034 6.83154 8.60824 6.83171 7.75074 7.68871L7.73524 7.70438C6.68691 8.77054 7.33474 10.384 7.75008 10.7994L8.95408 12.0034C9.05491 12.1042 9.37441 12.3539 9.68441 12.0034C9.87341 11.7897 9.88608 11.4747 9.68441 11.273L8.48058 10.0692Z" fill="#DB1A1A"/>
                                        <path d="M14.7159 11.5427L13.5119 10.3388C13.3102 10.1371 12.9833 10.1371 12.7816 10.3388C12.5799 10.5404 12.5799 10.8674 12.7816 11.0691L13.9856 12.2731C14.4402 12.7278 14.4402 13.4677 13.9856 13.9224L13.9809 13.9271C13.5258 14.3777 12.7889 14.3764 12.3356 13.9231L11.1316 12.7189C10.9299 12.5172 10.6029 12.5172 10.4013 12.7189C10.1996 12.9206 10.1996 13.2476 10.4013 13.4493L11.6054 14.6534C12.0341 15.0819 13.5017 15.8548 14.7153 14.6534L14.7233 14.6454C15.5733 13.7874 15.5708 12.3976 14.7159 11.5427Z" fill="#DB1A1A"/>
                                        <path d="M9.57313 9.55561C9.37146 9.75728 9.37146 10.0843 9.57313 10.2859L12.1293 12.8421C12.2301 12.9429 12.625 13.1668 12.8596 12.8421C13.0266 12.6109 13.0613 12.3134 12.8596 12.1118L10.3035 9.55561C10.1018 9.35394 9.77496 9.35378 9.57313 9.55561Z" fill="#DB1A1A"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_236_2272">
                                        <rect width="16" height="16" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    <label class="form-label mb-0">Type and Paste Channel Url</label>
                                </div>
                                <div class="youTube-analytics-bar-parent">
                                    <!-- <div class="icon-parent">
                                        <i class="fa-solid fa-link"></i>
                                    </div> -->
                                    <div class="youTube-analytics-bar theme-card flex-column flex-sm-row">
                                        <input class="form-control px-0 order-1 order-sm-0 text-center text-sm-start" ng-model="channelInput" value="" type="url" placeholder="Paste Channel Url Here..." autocomplete="off">
                                    </div>
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
                            <div class="theme-card" style="background: var(--body-bg);">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_236_2286)">
                                        <path d="M4.19918 0.566466C4.02887 0.564198 3.85768 0.626623 3.72587 0.754617C3.45678 1.01595 3.45624 1.44758 3.72461 1.7097L4.72982 2.7149L5.60417 3.58925L6.11719 4.10227H3.75846C2.78374 4.10227 1.98397 4.75924 1.47005 5.63027C0.95613 6.50129 0.667969 7.63268 0.667969 8.87636V10.6602C0.667969 11.9039 0.95613 13.0346 1.47005 13.9057C1.98397 14.7767 2.78374 15.4337 3.75846 15.4337H12.2428C13.2176 15.4337 14.0199 14.7767 14.5339 13.9057C15.0478 13.0346 15.3359 11.9039 15.3359 10.6602V8.87636C15.3359 7.63268 15.0478 6.50129 14.5339 5.63027C14.0199 4.75924 13.2176 4.10227 12.2428 4.10227H9.88672L10.3997 3.58925L11.2741 2.7149L12.2793 1.7097C12.5476 1.44758 12.5471 1.01595 12.278 0.754617C12.1462 0.626622 11.975 0.564217 11.8047 0.566466C11.6344 0.568734 11.465 0.635556 11.3366 0.766987L10.3314 1.7722L9.45707 2.64654L8.00199 4.10227L6.54692 2.64654L5.67257 1.7722L4.66736 0.766987C4.53898 0.635557 4.36948 0.568715 4.19918 0.566466ZM3.75842 5.43365H12.2428C12.6111 5.43365 13.0223 5.69306 13.3847 6.30735C13.7472 6.92164 14.0019 7.84379 14.0019 8.87636V10.6602C14.0019 11.6928 13.7472 12.6149 13.3847 13.2292C13.0223 13.8435 12.6111 14.1023 12.2428 14.1023H3.75842C3.39012 14.1023 2.97893 13.8435 2.61649 13.2292C2.25405 12.6149 2.00191 11.6928 2.00191 10.6602V8.87636C2.00191 7.84379 2.25405 6.92164 2.61649 6.30735C2.97893 5.69306 3.39012 5.43365 3.75842 5.43365ZM6.5872 8.24355C6.07386 8.24362 5.56017 8.43759 5.17248 8.82558L4.70178 9.29694C4.43892 9.5537 4.43344 9.97471 4.68943 10.2383C4.95065 10.5073 5.38237 10.5076 5.64451 10.2396L6.11521 9.76825C6.38115 9.5021 6.7925 9.50223 7.05857 9.76825L7.52993 10.2396L8.00128 10.711C8.77703 11.4865 10.0553 11.4863 10.8307 10.7103L11.3014 10.2396C11.5697 9.9775 11.5692 9.54586 11.3 9.28452C11.0364 9.02855 10.6154 9.03403 10.3586 9.29687L9.88729 9.76757C9.62135 10.0337 9.21 10.0342 8.94393 9.76822L8.47257 9.29687L8.00122 8.82486C7.61334 8.43707 7.10053 8.24348 6.5872 8.24355Z" fill="#DB1A1A"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_236_2286">
                                        <rect width="16" height="16" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>

                                    <label class="form-label mb-0">Type YouTube Channel Name</label>
                                </div>
                                <div class="youTube-analytics-bar-parent">
                                    <!-- <div class="icon-parent">
                                        <i class="fa-solid fa-at"></i>
                                    </div> -->
                                    <div class="youTube-analytics-bar theme-card flex-column flex-sm-row">
                                        <input class="form-control px-0 order-1 order-sm-0 text-center text-sm-start" ng-model="channel_id" value="channelname" type="text" placeholder="Type YouTube Channel Name..." autocomplete="off">
                                    </div>
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
    </div>

    <!--<form id="pdfForm" action="<?php echo base_url('export-competitor-pdf') ?>" method="POST" style="display:none;"> -->
    <!--    <input type="hidden" name="pdf_data" id="pdf_data_input">-->
    <!--</form>-->
    <form id="pdfForm" action="<?php echo base_url('export-competitor-pdf') ?>" method="POST" style="display:none;"> 
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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

            // $scope.exportPDF = function () { 
            //     if (!$scope.analysisData) {
            //         toastr.error("Please analyze a competitor first before exporting!");
            //         return;
            //     }

            //     var dataInput = document.getElementById('pdf_data_input');
            //     dataInput.value = JSON.stringify($scope.analysisData);
                
            //     document.getElementById('pdfForm').submit();
                
            //     toastr.success("Generating your PDF report...");
            // };
            $scope.exportPDF = function () { 
            if (!$scope.analysisData) {
                toastr.error("Please analyze a competitor first before exporting!");
                return;
            }
        
            var jsonString = angular.toJson($scope.analysisData);
        
            var base64SafeData = btoa(unescape(encodeURIComponent(jsonString)));
        
            var form = document.getElementById('pdfForm');
            var dataInput = document.getElementById('pdf_data_input');
            
            dataInput.value = base64SafeData; 
            
            var csrfName = "<?php echo $this->security->get_csrf_token_name(); ?>";
            var csrfInput = form.querySelector('input[name="' + csrfName + '"]');
            if(csrfInput) {
                var matches = document.cookie.match(new RegExp('(?:^|; )' + csrfName + '=([^;]*)'));
                if(matches) {
                    csrfInput.value = decodeURIComponent(matches[1]);
                }
            }
        
            toastr.success("Generating your PDF report...");
            
            form.submit();
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