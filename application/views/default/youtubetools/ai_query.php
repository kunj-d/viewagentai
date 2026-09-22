<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title>
    <?php echo $this->config->item('productName') ?> | AI Queries
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
    .dropdown-menu{
        li{
            label {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 15px;
                clear: both;
                font-weight: 400;
                line-height: 1.5;
                color: var(--text-light)!important;
                white-space: nowrap;
                border-bottom: 1px solid var(--theme-br);
                &:hover,
                &:focus {
                    color: var(--white-color)!important;
                    text-decoration: none;
                    background: var(--primary-color);
                }
            }
        }
    }
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="AnalysisCntrl">
    <div class="container-fluid container-padding">
        <div ng-show="showResults">
            <div class="row align-items-center row-gap-2 mb-3">
                <div class="col-md-7">
                    <div class="page-header-title d-flex align-items-center gap-2">
                        <i class="fa-solid fa-person-circle-question"></i>
                        <div>
                            <h3 class="title">Al Queries</h3>
                            <p class="desc">Discover what people are asking Al tools like ChatGPT, Gemini, Grok & Claude.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 text-md-end">
                    <div class="d-inline-flex align-items-center gap-3">
                        <a href="javascript:void(0)" class="btn btn-white border" ng-click="downloadQueriesPDF()">
                            Export Report
                            <i class="fa-solid fa-download"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-dark d-none">
                            History
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row row-gap-2 gx-3">
                <div class="col-12">
                    <div class="theme-card">
                        <div class="row gx-3 align-items-end">
                            <div class="col-12 col-sm-6 col-lg-8 col-xl-10">
                                <label class="form-label">Enter a topic or keyword</label>
                                <input type="text" ng-model="keyword" class="form-control" placeholder="Enter a topic or keyword">
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-none">
                                <label class="form-label">Audience <span class="text-muted fw-normal">(Optional)</span></label>
                                <select class="selectpicker" ng-model="audience" title="Select your channel">
                                    <option value="1">Channel A</option>
                                    <option value="2">Channel B</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-none">
                                <label class="form-label">Language</label>
                                <select class="selectpicker" ng-model="language" title="Select Language">
                                    <option value="en">English</option>
                                    <option value="hi">Hindi</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                                <a href="javascript:void(0)" ng-click="generateQuery()" class="btn btn-primary text-nowrap w-100">
                                    <i class="fa-solid fa-search"></i> Search
                                </a>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <span class="small title-color w500">Try examples:</span>
                                    <span class="card-badge high cursor-pointer">Weight loss</span>
                                    <span class="card-badge high cursor-pointer">Digital Marketing</span>
                                    <span class="card-badge high cursor-pointer">Time Management</span>
                                    <span class="card-badge high cursor-pointer">Make Money Online</span>
                                    <span class="card-badge high cursor-pointer">Motivation</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-gap-2 gx-3 mt-3">
                <div class="col-xl-7 col-lg-6">
                    <div class="theme-card h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <p class="mb-0 title-color">All Queries</p>
                            <div>
                            <div class="dropdown-no-arrow d-inline-flex overflow-visible">
                                <a  href="#" class="dropdown-toggle btn btn-sm btn-outline" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-filter"></i> Filters
                                </a>
                                <ul class="dropdown-menu overflow-visible">
                                    <li class="dropdown-item p-0">
                                        <label class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="issue-dot" style="background: #FA1C26;">
                                                </div>
                                                <span class="mb-0 w500">How To</span>
                                            </div>
                                            <input class="form-check-input mt-0 bg-white cursor-pointer" type="checkbox" ng-model="selectedIntent['How To']" ng-change="currentPage = 1">
                                        </label>
                                    </li>
                                    <li class="dropdown-item p-0">
                                        <label class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="issue-dot" style="background: #F88A46;">
                                                </div>
                                                <span class="mb-0 w500">Problems</span>
                                            </div>
                                            <input class="form-check-input mt-0 bg-white cursor-pointer" type="checkbox" ng-model="selectedIntent['Problem']" ng-change="currentPage = 1">
                                        </label>
                                    </li>
                                    <li class="dropdown-item p-0">
                                        <label class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="issue-dot" style="background: #8045C4;">
                                                </div>
                                                <span class="mb-0 w500">Strategies</span>
                                            </div>
                                            <input class="form-check-input mt-0 bg-white cursor-pointer" type="checkbox" ng-model="selectedIntent['Strategies']" ng-change="currentPage = 1">
                                        </label>
                                    </li>
                                    <li class="dropdown-item p-0">
                                        <label class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="issue-dot" style="background: #558EEB;">
                                                </div>
                                                <span class="mb-0 w500">Comparisons</span>
                                            </div>
                                            <input class="form-check-input mt-0 bg-white cursor-pointer" type="checkbox" ng-model="selectedIntent['Comparison']" ng-change="currentPage = 1">
                                        </label>
                                    </li>
                                    <li class="dropdown-item p-0">
                                        <label class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="issue-dot" style="background: #C4C8C9;">
                                                </div>
                                                <span class="mb-0 w500">Others</span>
                                            </div>
                                            <input class="form-check-input mt-0 bg-white cursor-pointer" type="checkbox" ng-model="selectedIntent['Others']" ng-change="currentPage = 1">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="custom-table custom-table-style-1">
                                <thead>
                                    <tr>
                                        <th># AI Query</th>
                                        <th>Intent</th>
                                        <th>Sources</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in getPaginationQueries()">
                                        <td>
                                            <div class="text-truncate"
                                                style="width: 270px; overflow: hidden; white-space: nowrap;">
                                                {{ ((currentPage - 1) * itemsPerPage) + $index + 1 }}. {{item.query}}
                                            </div>
                                        </td>
    
                                        <td>
                                            <span class="card-badge"
                                                ng-class="{
                                                        'low' : item.intent == 'How To',
                                                        'high' : item.intent == 'Problem',
                                                        'purple' : item.intent == 'Strategies',
                                                        'blue' : item.intent == 'Comparison',
                                                        'gray' : item.intent == 'Others'
                                                }">
                                                {{item.intent}}
                                            </span>
                                        </td>
    
                                        <td>
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="gap-row d-inline-flex p-0"
                                                    ng-repeat="source in item.sources">
                                                    <div class="gap-query">
                                                        <div class="logo border">
                                                            <img ng-if="source == 'ChatGPT'"
                                                                src="<?php echo $this->config->item('assetsPath') ?>images/chatgpt-app.svg"
                                                                class="grok-ai">
    
                                                            <img ng-if="source == 'Gemini'"
                                                                src="<?php echo $this->config->item('assetsPath') ?>images/gemini-app.svg"
                                                                class="grok-ai">
    
                                                            <img ng-if="source == 'Grok'"
                                                                src="<?php echo $this->config->item('assetsPath') ?>images/grok-ai-app.svg"
                                                                class="grok-ai">
    
                                                            <img ng-if="source == 'Claude'"
                                                                src="<?php echo $this->config->item('assetsPath') ?>images/claude-app.svg"
                                                                class="grok-ai">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
    
                                        <td class="text-end">
                                            <div class="d-inline-flex gap-2 align-items-center">
                                                <a href="javascript:void(0)" ng-click="copyQuery(item.query)" class="title-color">
                                                    <i class="fa-regular fa-copy"></i>
                                                </a>
    
                                                <!-- <a href="javascript:void(0)" class="title-color">
                                                    <i class="fa-regular fa-bookmark"></i>
                                                </a> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
    
                                <div class="small text-muted">
                                    Showing
                                    {{ ((currentPage - 1) * itemsPerPage) + 1 }}
                                    to
                                    {{
                                        Math.min(
                                            currentPage * itemsPerPage,
                                            queries.length
                                        )
                                    }}
                                    of
                                    {{getFilteredQueries().length}} queries
                                </div>
    
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-dark"
                                            ng-disabled="currentPage == 1"
                                            ng-click="currentPage = currentPage - 1">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
    
                                    <span class="small fw-bold">
                                        {{currentPage}}
                                    </span>
    
                                    <button class="btn btn-sm btn-dark"
                                            ng-disabled="currentPage >= totalPages()"
                                            ng-click="currentPage = currentPage + 1">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="row row-gap-2">
                        <div class="col-12">
                            <div class="theme-card">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fa-solid fa-chart-column text-primary fs-6"></i>
                                    <p class="mb-0 w500 title-color">Query Insights</p>
                                    <p class="mb-0 w600 text-primary">: Top 25 Queries mention</p>
                                </div>
                                <div class="row row-gap-2">
                                    <div class="col-sm-6">
                                        <div class="query-insights-chart" id="chart"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center justify-content-between mb-2"
                                            ng-repeat="item in intentStats">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="issue-dot"
                                                    ng-style="{
                                                        'background':
                                                            item.intent == 'How To' ? '#FA1C26' :
                                                            item.intent == 'Problem' ? '#F88A46' :
                                                            item.intent == 'Strategies' ? '#8045C4' :
                                                            item.intent == 'Comparison' || item.intent == 'Comparisons' ? '#558EEB' :
                                                            '#C4C8C9'
                                                    }">
                                                </div>
                                                <span class="mb-0 w600">
                                                    {{item.intent}}
                                                </span>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 title-color small">
                                                    {{item.count}} ({{item.percentage}}%)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="theme-card">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fa-solid fa-fire text-primary fs-6"></i>
                                    <p class="mb-0 w500 title-color">Popular Intent</p>
                                </div>
                                <div class="chip-primary d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-1 small title-color w400">
                                            "{{popularIntent}}" queries are the most common.
                                        </p>

                                        <p class="mb-0 small w400"
                                        ng-if="popularIntent == 'How To'">
                                            Focus on step-by-step and actionable content.
                                        </p>

                                        <p class="mb-0 small w400"
                                        ng-if="popularIntent == 'Problem'">
                                            Create solution-oriented and pain-point focused content.
                                        </p>

                                        <p class="mb-0 small w400"
                                        ng-if="popularIntent == 'Strategies'">
                                            Share actionable growth and optimization strategies.
                                        </p>

                                        <p class="mb-0 small w400"
                                        ng-if="popularIntent == 'Comparison'">
                                            Comparison-based content is trending for decision making.
                                        </p>

                                        <p class="mb-0 small w400"
                                        ng-if="popularIntent == 'Others'">
                                            Mixed intent queries are gaining audience attention.
                                        </p>
                                    </div>
                                    <i class="fa-solid fa-chart-line text-primary fs-6"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="theme-card">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fa-solid fa-arrow-up text-primary fs-6"></i>
                                    <p class="mb-0 w500 title-color">Top Al Sources</p>
                                </div>
                               <div class="gap-row px-0"
                                    ng-repeat="item in topAISources"
                                    ng-class="{'pb-0' : $last}">

                                    <div class="gap-query d-flex align-items-center gap-2">

                                        <div class="logo border">

                                            <img ng-if="item.source == 'ChatGPT'"
                                                src="<?php echo $this->config->item('assetsPath') ?>images/chatgpt-app.svg"
                                                class="GPT">

                                            <img ng-if="item.source == 'Gemini'"
                                                src="<?php echo $this->config->item('assetsPath') ?>images/gemini-app.svg"
                                                class="gemini">

                                            <img ng-if="item.source == 'Grok'"
                                                src="<?php echo $this->config->item('assetsPath') ?>images/grok-ai-app.svg"
                                                class="grok-ai">

                                            <img ng-if="item.source == 'Claude'"
                                                src="<?php echo $this->config->item('assetsPath') ?>images/claude-app.svg"
                                                class="claude">

                                        </div>

                                        <span class="name">
                                            {{item.source}}
                                        </span>

                                    </div>

                                    <div class="gap-right">
                                        <span class="title-color">
                                            {{item.queryCount}} queries
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="theme-card">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fa-solid fa-clipboard-question text-primary fs-6"></i>
                                    <p class="mb-0 w500 title-color">Use These Queries For</p>
                                </div>
                                <div class="gap-row px-0">
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <i class="fa-regular fa-circle-check fs-6 text-primary"></i>
                                        <p class="mb-0 title-color small">Video Ideas & Topics</p>
                                    </div>
                                </div>
                                <div class="gap-row px-0">
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <i class="fa-regular fa-circle-check fs-6 text-primary"></i>
                                        <p class="mb-0 title-color small">Optimize Titles & Descriptions</p>
                                    </div>
                                </div>
                                <div class="gap-row px-0">
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <i class="fa-regular fa-circle-check fs-6 text-primary"></i>
                                        <p class="mb-0 title-color small">FAQ/Q&A Section</p>
                                    </div>
                                </div>
                                <div class="gap-row px-0 pb-0">
                                    <div class="d-flex gap-2 align-items-center w-100">
                                        <i class="fa-regular fa-circle-check fs-6 text-primary"></i>
                                        <p class="mb-0 title-color small">Al Visibility & Higher Rankings</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto create-first" style="max-width: calc(100% - 150px)" ng-hide="showResults">
            <div class="row row-gap">
                <div class="col-12 mb-3"style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="header-content">
                        <h1 class="fw-bold mb-3"><span class="text-primary">AI</span> Queries</h1>
                        <p class="mb-0">Enter a keyword to discover content ideas and queries people are searching for.</p>
                    </div>
                    <img src="<?php echo $this->config->item('assetsPath') ?>images/query.png" alt="image" class="img-fluid d-block">
                </div>
                <div class="col-12">
                    <div class="theme-card text-center">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_236_2800)">
                                <path d="M3 3.75C3 3.33525 3.336 3 3.75 3H4.5C4.914 3 5.25 3.33525 5.25 3.75C5.25 4.16475 4.914 4.5 4.5 4.5H3.75C3.336 4.5 3 4.16475 3 3.75ZM14.3302 13.7317L11.25 12.5767V9.081C11.25 7.944 10.443 6.95475 9.37275 6.78075C8.04075 6.53025 6.71925 7.6485 6.75 9.00075V14.0167C6.75 14.0167 6.40875 13.7437 6.4035 13.7392C5.496 12.9442 4.11225 13.0012 3.28275 13.89C2.43525 14.796 2.48325 16.2225 3.38025 17.0625L4.2045 17.8088C4.341 17.9317 4.518 18 4.70175 18C5.37375 18 5.6985 17.1772 5.208 16.7182L4.41375 15.975C4.1115 15.6915 4.09575 15.2152 4.37925 14.913C4.6605 14.6115 5.13525 14.5972 5.43675 14.877C5.4435 14.883 7.02675 16.1767 7.02675 16.1767C7.251 16.3597 7.56075 16.3965 7.8225 16.2735C8.08425 16.1497 8.25075 15.885 8.25075 15.5962V9C8.25075 8.586 8.58675 8.25 9.00075 8.25C9.41475 8.25 9.75075 8.586 9.75075 9V13.0965C9.75075 13.4092 9.9405 13.6875 10.5758 13.926L13.8053 15.1372C14.784 15.504 15.5243 16.3492 15.6975 17.3797C15.7673 17.7937 16.1745 18.066 16.575 17.9872C16.9815 17.9107 17.2493 17.5185 17.1727 17.1112C16.8832 15.576 15.7935 14.2815 14.3302 13.7317ZM3.75 7.5H5.25C5.664 7.5 6 7.16475 6 6.75C6 6.33525 5.664 6 5.25 6H3.75C3.336 6 3 6.33525 3 6.75C3 7.16475 3.336 7.5 3.75 7.5ZM8.25 4.5C8.664 4.5 9 4.16475 9 3.75C9 3.33525 8.664 3 8.25 3H7.5C7.086 3 6.75 3.33525 6.75 3.75C6.75 4.16475 7.086 4.5 7.5 4.5H8.25ZM14.25 0H3.75C1.68225 0 0 1.68225 0 3.75V6.75C0 8.81775 1.68225 10.5 3.75 10.5H4.5C4.914 10.5 5.25 10.1647 5.25 9.75C5.25 9.33525 4.914 9 4.5 9H3.75C2.5095 9 1.5 7.9905 1.5 6.75V3.75C1.5 2.5095 2.5095 1.5 3.75 1.5H14.25C15.4905 1.5 16.5 2.5095 16.5 3.75V6.75C16.5 7.9905 15.4905 9 14.25 9H13.5C13.0852 9 12.75 9.33525 12.75 9.75C12.75 10.1647 13.0852 10.5 13.5 10.5H14.25C16.3177 10.5 18 8.81775 18 6.75V3.75C18 1.68225 16.3177 0 14.25 0ZM14.25 6H12.75C12.3352 6 12 6.33525 12 6.75C12 7.16475 12.3352 7.5 12.75 7.5H14.25C14.6648 7.5 15 7.16475 15 6.75C15 6.33525 14.6648 6 14.25 6ZM14.25 3H11.25C10.8352 3 10.5 3.33525 10.5 3.75C10.5 4.16475 10.8352 4.5 11.25 4.5H14.25C14.6648 4.5 15 4.16475 15 3.75C15 3.33525 14.6648 3 14.25 3Z" fill="#DB1A1A"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_236_2800">
                                <rect width="18" height="18" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>

                            <label class="form-label mb-0">Enter Keyword</label>
                        </div>
                        <div class="d-flex align-items-md-center flex-md-row flex-column gap-3 mb-3">
                            <div class="search-bar left-icon flex-grow-1">
                                <div class="search-icon">
                                    <span class="icon-search text-primary"></span>
                                </div>
                                <input type="text" class="search form-control" placeholder="E.g. Fitness" autocomplete="off" ng-model="keyword">
                            </div>
                            <a  href="javascript:void(0)" ng-click="generateQuery()" class="btn btn-primary">
                                <i class="fa-solid fa-search"></i> Search
                            </a>
                        </div>
                        <div class="chip-primary d-inline-flex align-items-center gap-2 text-primary">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            Get relevant Al-powered queries, keywords, and content ideas in seconds.
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <hr class="m-0 w-25">
                        <span class="text-nowrap">What you'll get</span>
                        <hr class="m-0 w-25">
                    </div>
                </div>
                <div class="col-12">
                    <div class="row row-gap-2 justify-content-center gx-3">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="ai-query-card">
                                <div class="query-icon-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/ai-query-1.png" alt="icon">
                                </div>
                                <div class="query-content">
                                    <h3 class="query-title">Related Queries</h3>
                                    <p class="query-desc">Find the most relevant queries related to your keyword.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="ai-query-card">
                                <div class="query-icon-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/ai-query-2.png" alt="icon">
                                </div>
                                <div class="query-content">
                                    <h3 class="query-title">High Ranking Ideas</h3>
                                    <p class="query-desc">Discover high-potential queries that can help you rank higher.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="ai-query-card">
                                <div class="query-icon-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/ai-query-3.png" alt="icon">
                                </div>
                                <div class="query-content">
                                    <h3 class="query-title">Content Suggestions</h3>
                                    <p class="query-desc">Get content ideas based on real user intent and trends.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="ai-query-card">
                                <div class="query-icon-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/ai-query-4.png" alt="icon">
                                </div>
                                <div class="query-content">
                                    <h3 class="query-title">Better Performance</h3>
                                    <p class="query-desc">Create content that attracts  views, engagement & growth.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="queriesPdfForm" action="<?php echo base_url('export-ai-queries-pdf') ?>" method="POST" style="display:none;">
        <input type="hidden" name="pdf_data" id="queries_pdf_data_input">
    </form>

    <script>
        // Query Insights Chart Circle
       
        function renderChart(intentStats) {

            let dataValues = [];
            let dataLabels = [];
            let originalTotal = 0;
            let originalLabel = "Total Queries";

            intentStats.forEach(item => {

                dataValues.push(parseInt(item.count));
                dataLabels.push(item.intent);

                originalTotal += parseInt(item.count);
            });

            var options = {

                series: dataValues,
                labels: dataLabels,

                chart: {
                    type: 'donut',
                    width: 200
                },

                colors: ['#FA1C26', '#f58d4e', '#8844c5', '#5584e8', '#c2c8c9'],

                stroke: {
                    show: true,
                    width: 3,
                    colors: ['#fff']
                },

                plotOptions: {
                    pie: {
                        expandOnClick: false,

                        donut: {

                            size: '82%',

                            labels: {

                                show: true,

                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: originalLabel,

                                    formatter: function () {
                                        return originalTotal;
                                    }
                                }
                            }
                        }
                    }
                },

                dataLabels: {
                    enabled: false
                },

                legend: {
                    show: false
                }
            };

            if(!document.querySelector("#chart")){
                return;
            }

            document.querySelector("#chart").innerHTML = "";

            var chart = new ApexCharts(
                document.querySelector("#chart"),
                options
            );

            chart.render();
        }
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

        app.controller('AnalysisCntrl', function ($scope, $http) {

            $scope.url = "";

            $scope.showResults = false;
            $scope.selectedIntent = {};

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
                        console.log(response)
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
                    $scope.video = data;
                    $scope.video.issues = JSON.parse(data.issues || '[]');
                    $scope.video.opportunities = JSON.parse(data.opportunities || '[]');
                    $scope.video.keywords = JSON.parse(data.keywords || '{}');
                    $scope.video.video_info = JSON.parse(data.video_info || '{}');
                    $scope.video.issuesCount = $scope.video.issues.length;
                    $scope.video.opportunitiesCount = $scope.video.opportunities.length;
                } else {
                    console.log(response.data.msg);
                }
            })
            .catch(function () {
                console.log("Something went wrong!");
            });
        };

            $scope.generateQuery = function(){

                if (!$scope.keyword){
                    $scope.errorMessage = 'please enter keyword';
                    return;
                }
                $scope.loading = true;
                $scope.errorMessage = '';
                $scope.queries = [];
                $scope.totalQueries = 0;

                jsLoader(true);
	
                var queryStr = "<?php echo base_url('ai-generateQuery')?>";
                
                    $http({
                method: 'POST',
                url: queryStr,
                data:{
                    'keyword': $scope.keyword,
                    'audience': $scope.audience,
                            'language': $scope.language
                    },
                headers: {
                                    'Content-Type': 'application/json'
                            }
                }).then(function(response){
                        jsLoader(false);
                        $scope.loading = false;

                        const {
                            status,
                            message,
                            queries,
                            totalQueries,
                            intentStats,
                            topAISources,
                            queryInsights,
                            popularIntent,
                            sourceStats
                            
                        } = response.data || {};
                        if (status){

                            $scope.showResults = true;
                            $scope.popularIntent = popularIntent;
                            $scope.topAISources = topAISources; 
                            $scope.queries = queries;
                            $scope.currentPage = 1;
                            $scope.intentStats = [];
                            angular.forEach(intentStats, function(value, key){
                                let percentage = 0;
                                if(totalQueries > 0){
                                    percentage = Math.round((value / totalQueries) * 100);
                                }
                                $scope.intentStats.push({
                                    intent: key,
                                    count: value,
                                    percentage: percentage
                                });
                            });
                            $scope.sourceStats = sourceStats;

                            $scope.topAISources = [];
                            angular.forEach(sourceStats, function(value, key){
                                $scope.topAISources.push({
                                    source: key,
                                    queryCount: value
                                });
                            });

                            setTimeout(function () {
                                renderChart($scope.intentStats);
                            }, 500);
                        }
                        else{
                            $scope.errorMessage = message;
                        }
                    }).catch(function(error){
                        jsLoader(false);
                        $scope.loading = false;
                        console.log(error);
                        $scope.errorMessage ='Something went wrong';
                    });
            }

            $scope.copyQuery = function(query){
                navigator.clipboard.writeText(query);
                toastr.success('Query copied');
            }

            $scope.currentPage = 1;
            $scope.itemsPerPage = 10;
            $scope.Math = window.Math;

            $scope.getFilteredQueries = function(){
                    let activeFilters = [];
                    angular.forEach($scope.selectedIntent, function(value, key){
                        if(value){
                            activeFilters.push(key);
                        }
                    });
                    if(activeFilters.length === 0){
                        return $scope.queries || [];
                    }
                return ($scope.queries || []).filter(function(item){
                    return activeFilters.includes(item.intent);
                });
            }

            $scope.getPaginationQueries = function(){
                const filtered = $scope.getFilteredQueries();
                const start = ($scope.currentPage - 1) * $scope.itemsPerPage;
                const end = start + $scope.itemsPerPage;
                return filtered.slice(start, end);
            }
            
            $scope.totalPages = function(){
                const filtered = $scope.getFilteredQueries();
                if(!filtered.length){
                    return 1;
                }
                return Math.ceil(
                    filtered.length /
                    $scope.itemsPerPage
                );
            }

            $scope.downloadQueriesPDF = function () {
                if (!$scope.queries || $scope.queries.length === 0) {
                    toastr.error("First Generate the Queries ! Then export");
                    return;
                }

                // Backend ke liye clean payload object structure
                var payload = {
                    keyword: $scope.keyword,
                    popularIntent: $scope.popularIntent,
                    intentStats: $scope.intentStats,
                    topAISources: $scope.topAISources,
                    queries: $scope.queries
                };

                var dataInput = document.getElementById('queries_pdf_data_input');
                var form = document.getElementById('queriesPdfForm');

                if (dataInput && form) {
                    dataInput.value = JSON.stringify(payload);
                    form.submit();
                    toastr.success("Generating your AI Queries report...");
                } else {
                    toastr.error("Export configuration error.");
                }
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