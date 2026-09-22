<style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
      display: none !important;
    }
</style>

<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="analayzcontroller" ng-cloak>
    <title><?php echo $this->config->item('productName') ?> | Analyze </title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding py-md-5">
        <div class="mx-auto" style="max-width: 890px;">
            <div class="row row-gap-2">
                <div class="col-12 text-center">
                    <h1 class="title-color mb-0 fw-bold">
                        YouTube Analyze
                    </h1>
                </div>
                <div class="col-md-7 mx-auto text-center">
                    <p class="mb-0">Analyze any YouTube video for AI visibility issues and opportunities. Get data-driven insights to outperform competition.</p>
                </div>
                <div class="col-12">
                    <div class="youTube-analytics-bar-parent">
                        <div class="icon-parent">
                            <i class="fa-solid fa-link"></i>
                        </div>
                        <div class="youTube-analytics-bar theme-card flex-column flex-sm-row">
                            <input class="form-control px-0 order-1 order-sm-0 text-center text-sm-start" ng-model="url" value="" type="url" name='url' placeholder="Paste YouTube Link Here..." autocomplete="off">
                            <button class="btn btn-primary" ng-click="sendurl()">
                                <i class="fa-solid fa-magnifying-glass-chart"></i> Analyze
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 mx-auto">
                    <div class="d-flex align-items-center gap-2">
                        <hr class="m-0 w-50">
                        <span>OR</span>
                        <hr class="m-0 w-50">
                    </div>
                </div>
                <div class="col-12">
                    <?php if(empty($youtube_access_token)) { ?>
                        <div class="theme-card connet-your-channel">
                            <i class="fa-solid fa-link"></i>
                            <div class="d-flex align-items-center flex-column gap-3">
                                <div class="main-icon">
                                    <i class="fa-solid fa-link"></i>
                                </div>
                                <h4 class="fw-bolder mb-0 text-center" style="max-width: 400px;">
                                    Connect your channel to unlock historical growth data.
                                </h4>
                                <p class="mb-0">Unlock historical insights by connecting your channel.</p>
                                <a href="<?php echo base_url('integration'); ?>" class="btn btn-primary">Connet Your Channel</a>
                            </div>
                        </div>
                    <?php }else{?>
                        <div class="theme-card">
                            <h6 class="title-color d-flex align-items-center border-bottom m-0" style="padding: 10px 0 20px;">
                                <i class="fa-solid fa-chart-line text-primary me-2"></i>
                                Channel Overview
                                <i class="fa-solid fa-circle-info ms-2 info-tooltip"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-custom-class="custom-tooltip"
                                    data-bs-title="Analyze YouTube videos with AEO score and get better titles, descriptions, and tags to improve reach."
                                >
                                </i>
                            </h6>
                            <div class="border-bottom" style="margin-bottom: 20px;">
                                <div class="d-flex align-items-center" style="gap: 15px; padding: 20px 0;">
                                    <div class="overflow-hidden" style="height: 90px;min-width: 90px;width: 90px;border-radius: 50%;border: 1px solid rgba(0, 0, 0, 0.15);">
                                        <img class="object-fit-cover w-100 h-100" alt="image" ng-src="{{ channelOverview.thumbnail }}" src="https://i.ytimg.com/vi/LYsl99I0IEg/hqdefault.jpg">
                                    </div>
                                    <div class="flex-1">
                                        <div class="mb-1">
                                            <h6 class="mb-0" style="font-weight: 600;">{{ channelOverview.title }}</h6>
                                            <span style="font-weight: 600;">{{ channelOverview.handle }}</span>
                                        </div>
                                        <p>{{ channelOverview.description }}</p>
                                    </div>
                                    <button class="btn btn-primary" ng-click="disconnectChannel()" id="disconnectBtn">
                                        Disconnect
                                    </button>
                                </div>
                            </div>
                            <div class="row row-gap-2 justify-content-center gx-3">
                                <div class="col-md-4 col-sm-6">
                                    <div class="theme-card channel-card">
                                        <div>
                                            <div class="card-label">Total Subscribers</div>
                                            <div class="card-value">{{ channelOverview.subscribers }}</div>
                                            <!-- <div class="card-stat">
                                                <span class="growth-text">↑ 12.4%</span> vs last 30 days
                                            </div> -->
                                        </div>
                                        <div class="icon-container">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="theme-card channel-card">
                                        <div>
                                            <div class="card-label">Total Views</div>
                                            <div class="card-value">{{ channelOverview.views }}</div>
                                            <!-- <div class="card-stat">
                                                <span class="growth-text">↑ 8.2%</span> vs last 30 days
                                            </div> -->
                                        </div>
                                        <div class="icon-container">
                                            <i class="fa-solid fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="theme-card channel-card">
                                        <div>
                                            <div class="card-label">Total Uploads</div>
                                            <div class="card-value">{{ channelOverview.uploads }}</div>
                                            <!-- <div class="card-stat">
                                                <span class="growth-text">↑ 4</span> vs last 30 days
                                            </div> -->
                                        </div>
                                        <div class="icon-container">
                                            <i class="fa-solid fa-video"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="title-color d-flex align-items-center mb-0">
                                            <i class="fa-solid fa-video text-primary me-2"></i>
                                            Video List
                                        </h6>
                                        <!-- <p class="mb-0 title-color w500">5 videos found</p> -->
                                    </div>
                                    <div class="search-bar right-icon">
                                        <div class="search-icon">
                                            <span class="icon-search"></span>
                                        </div>
                                        <input type="text" class="search form-control" placeholder="Search videos..." autocomplete="off" ng-model="searchKey">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive p-0">
                                        <table class="custom-table custom-table-style-1" style="min-width: 850px;">
                                            <thead>
                                                <tr>
                                                    <th>Video</th>
                                                    <th class="text-center">Publish Date</th>
                                                    <th class="text-center">Views</th>
                                                    <th class="text-center">View Duration</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr ng-repeat="video in filteredVideos = (all_videos | filter:searchKey)"> -->
                                                    <tr ng-repeat="video in filteredVideos = (all_videos | filter:searchKey)"ng-if="video.privacyStatus != 'private'">
                                                        <!-- <tr ng-repeat="video in filteredVideos = (all_videos | filter:searchKey | filter:publicVideos)"> -->
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded overflow-hidden me-3" style="height: 80px; min-width: 150px; width: 150px;">
                                                                <img class="object-fit-cover w-100 h-100" alt="image" ng-src="{{ video.thumbnail }}">
                                                            </div>
                                                            <p class="mb-0 title-color w500" style="max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ video.title }}">
                                                                <!-- YouTube Algorithm Explained in Detail: 2024 -->
                                                                 {{ video.title }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0 title-color w500 small">{{ (video.publishAt || video.publishedAt) | date:'mediumDate' }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0 title-color w500 small">{{ video.viewCount | number }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0 title-color w500 small">{{ video.likeCount | number }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-primary" ng-click="share_youtube_video(video)">
                                                            <i class="fa-solid fa-magnifying-glass-chart"></i> Analyze
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr ng-if="all_videos.length === 0">
                                                    <td colspan="5" class="text-center title-color py-4">No videos found.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 mt-3" ng-show="all_videos.length > 0">
                                    <div class="d-flex justify-content-end align-items-center gap-2 px-2 title-color">
                                        <span>Page {{ pageNo }} of {{ totalpages }}</span>
                                        <button type="button" class="btn btn-dark btn-sm" ng-click="get_next_prev_videos(prevPageToken,'prev')" ng-disabled="!prevPageToken">
                                            <i class="fa fa-angle-double-left"></i>
                                        </button>
                                        <button type="button" class="btn btn-dark btn-sm" ng-click="get_next_prev_videos(nextPageToken,'next')" ng-disabled="!nextPageToken">
                                            <i class="fa fa-angle-double-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }?>
                </div>
            </div>
        </div>
    </div>


    <script>
        var app = angular.module("AppModule", []);

        app.controller("analayzcontroller", function($scope, $http, $timeout) { 
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

        $scope.share_youtube_video = function(video) {
            $scope.youtube_video_url = "https://www.youtube.com/watch?v="+video.id;
            $scope.url = $scope.youtube_video_url
            $scope.sendurl();
        }


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



        $scope.channelOverview = {
            title: 'Loading...',
            handle: '',
            description: '',
            thumbnail: '',
            subscribers: '0',
            views: '0',
            uploads: '0'
        };

        $scope.getChannelOverviewStats = function() {
            var overviewUrl = "<?php echo base_url('youtube/get_connected_channel_overview')?>";
            
            $http.get(overviewUrl)
            .then(function(response) {
                if (response.data && response.data.status) {
                    var resData = response.data;
                    $scope.channelOverview.title = resData.channel_name;
                    $scope.channelOverview.handle = resData.custom_url;
                    $scope.channelOverview.description = resData.description;
                    if(resData.thumbnail) {
                        $scope.channelOverview.thumbnail = resData.thumbnail;
                    }
                    $scope.channelOverview.subscribers = formatNumber(resData.subscriberCount);
                    $scope.channelOverview.views = formatNumber(resData.viewCount);
                    $scope.channelOverview.uploads = resData.videoCount;
                }
            }, function(error) {
                console.error("Error fetching channel overview statistics maps:", error);
            });
        };

        $scope.getChannelOverviewStats();


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

        set_default_variables();
        get_youtube_videos();



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