<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title><?php echo $this->config->item('productName') ?> | Optimize Your Video</title>
<style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
      display: none !important;
    }
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="allAnalysisCntrl"  ng-cloak>
    <div class="container-fluid container-padding">
        <div ng-if='analyz_data.length != 0'>
            <div class="row align-items-center row-gap-2 mb-sm-5 mb-3 ">
                <div class="col-md-6">
                    <div class="page-header-title d-flex align-items-center gap-2">
                        <!-- <i class="fa-solid fa-gauge-high"></i> -->
                        <div class="header-img">
                            <img src="<?php echo $this->config->item('assetsPath'); ?>images/optimize-img.png">
                        </div>
                        <div>
                            <h3 class="title">Optimize Your Video</h3>
                            <p class="desc">Get AI suggestions to improve your video's ranking and visibility.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-card mb-3">
                <!-- <h6 class="title-color">Manage All Videos</h6> -->
                <div>
                    <input type="text"
                        class="form-control"
                        placeholder="Search videos..."
                        ng-model="searchKey">
                </div>
            </div>
            <div class="table-responsive p-0">
                <!-- <div class="theme-card d-flex align-items-start justify-content-between optimizer-list gap-2 mb-3" style="min-width: 1050px;" ng-repeat="video in analyz_data"> -->
                <div class="theme-card d-flex align-items-start justify-content-between optimizer-list gap-2 mb-3" style="min-width: 1050px;" 
                    ng-repeat="video in filteredVideos = (analyz_data | filter:searchKey)">
                    <!-- <span class="{{ video.optimized == 1  ? 'optimized optimizer-badge'  : 'non-optimized optimizer-badge' }}">
                        {{ video.optimized == 1 ? '<i class="fa-solid fa-arrow-trend-up"></i> Optimized' : '<i class="fa-solid fa-arrow-trend-down"></i>Non-Optimized' }}
                    </span> -->
                    
                    <div class="d-flex">
                        <div class="rounded overflow-hidden me-3" style="height: 120px;min-width: 210px;width: 210px;">
                            <img class="object-fit-cover w-100 h-100" ng-src="{{video.thumbnail || video.video_info.thumbnail}}" alt="image">
                        </div>
                        <div>
                            <h6 class="title-color">{{video.title}}</h6>
                            <p>
                                {{ video.summary | limitTo:250 }}
                                <span ng-if="video.summary.length > 250">.....</span>
                            </p>
                            <div class="d-inline-flex align-items-center gap-3">
                                <div class="d-inline-flex align-items-center gap-2">
                                    <div class="rounded-circle overflow-hidden" style="height: 30px; min-width: 30px; width: 30px;">
                                        <img class="object-fit-cover w-100 h-100" ng-src="{{video.video_info.channelThumbnail}}" alt="image">
                                    </div>
                                    <p class="title-color w500 mb-0">{{video.video_info.channel_name}}</p>
                                </div>
                                <!--<i class="fa-solid fa-circle text-primary" style="font-size: 6px;"></i>-->
                                <!--<span>2 weeks ago</span>-->
                                <i class="fa-solid fa-circle text-primary" style="font-size: 6px;"></i>
                                <span>{{video.video_info.views}} views</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-3 align-self-stretch justify-content-between" style="flex-direction:column;">
                        <div class="d-flex align-items-end gap-3">
                            <a href="javascript:void(0)" class="action-btn btn-primary" ng-click="downloadPDF(video)"><i class="fa-solid fa-download"></i></a>
                            <a href="javascript:void(0)" class="action-btn btn-primary" ng-click="edit_analyz(video.id)">
                                <!-- <i class="fa-brands fa-searchengin"></i> -->
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.79932 12.1333C9.17399 12.1333 8.57969 12.0024 8.04022 11.7686L6.74219 13.0667H10.966C11.2236 13.0667 11.4327 12.8576 11.4327 12.6V11.8186C10.9268 12.0197 10.3768 12.1333 9.79932 12.1333Z" fill="white" fill-opacity="1"/>
                                    <path d="M10.966 1.16667H1.63268C1.37508 1.16667 1.16602 1.37574 1.16602 1.63334V12.6C1.16602 12.8576 1.37508 13.0667 1.63268 13.0667H2.12292L5.73072 9.45911C5.49692 8.91964 5.36602 8.32534 5.36602 7.70001C5.36602 5.25164 7.35098 3.26667 9.79935 3.26667C10.3768 3.26667 10.9268 3.38031 11.4327 3.58144V1.63334C11.4327 1.37574 11.2236 1.16667 10.966 1.16667ZM4.89935 5.60001H2.09935V4.66667H4.89935V5.60001ZM6.53268 3.73334H2.09935V2.80001H6.53268V3.73334Z" fill="white" fill-opacity="1"/>
                                    <path d="M9.80011 4.20001C7.86718 4.20001 6.30011 5.76708 6.30011 7.70001C6.30011 8.41331 6.51478 9.07575 6.88111 9.62921L4.17188 12.3384L5.16167 13.3282L7.87091 10.619C8.42438 10.9853 9.08681 11.2 9.80011 11.2C11.733 11.2 13.3001 9.63295 13.3001 7.70001C13.3001 5.76708 11.733 4.20001 9.80011 4.20001ZM8.63344 9.10001H7.70011V7.23335H8.63344V9.10001ZM10.2668 9.10001H9.33344V6.53335H10.2668V9.10001ZM11.9001 9.10001H10.9668V5.83335H11.9001V9.10001Z" fill="white" fill-opacity="1"/>
                                </svg>  
                            </a>
                            <a href="javascript:void(0)" class="action-btn btn-primary" ng-click="deleteAnalyzdata(video.id)"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <a href="javascript:void(0)" ng-click="optimizevideo(video.id , video.video_info)" class="btn btn-primary py-2 text-nowrap" ng-if="video.optimized ==0">
                                <i class="fa-brands fa-searchengin"></i> Optimize
                            </a>
                            <span class="text-nowrap {{ video.optimized == 1 ? 'optimized optimizer-badge' : 'non-optimized optimizer-badge' }}">
                                <i class="me-2 fa-solid {{ video.optimized == 1 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                                
                                {{ video.optimized == 1 ? 'Optimized' : 'Non-Optimized' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center gap-2 mt-3"
                ng-if="analyz_data.length > 0 && !searchKey">

                <span>
                    Page {{ currentPage }} of {{ totalPages }}
                </span>

                <button class="btn btn-dark btn-sm"
                        ng-click="prevPage()"
                        ng-disabled="!hasPrev">

                    <i class="fa fa-angle-double-left"></i>

                </button>

                <button class="btn btn-dark btn-sm"
                        ng-click="nextPage()"
                        ng-disabled="!hasNext">

                    <i class="fa fa-angle-double-right"></i>

                </button>

            </div>
        </div>

        <div class="create-first" ng-if="!loading && analyz_data.length == 0">
            <img src="<?php echo $this->config->item('assetsPath') ?>images/optimize.png" alt="image" class="img-fluid d-block mx-auto">
            <h3 class="title">
                Analyze first, then optimize your video
            </h3>
            <p class="description">
                Better analysis starts with smart optimization. Optimize first, then get deeper insights.
            </p>
            <a href="<?= base_url('analyz'); ?>" class="btn btn-primary">
                <i class="fa-solid fa-chart-line"></i>Go to Analyze page
            </a>
        </div>
    </div>
    <form id="videoPdfForm" action="<?php echo base_url('export-video-analysis-pdf') ?>" method="POST" style="display:none;"> 
        <input type="hidden" name="pdf_data" id="video_pdf_data_input">
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

        app.controller('allAnalysisCntrl', function ($scope, $http) {
        $scope.searchKey = '';
        $scope.currentPage = 1;
        $scope.limit = 10;
        $scope.analyz_data = [];
        $scope.loading = true;

           $scope.getanalyzedata = function() {
            jsLoader(true);
                let queryStr = "<?php echo base_url('get-all-analyz-data')?>";
            
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        pageNo: $scope.currentPage,
                        limit: $scope.limit,
                        searchKey: $scope.searchKey
                    }),
                    // data: $.param({ id: id }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function (response) {
                if (response.data.success) {
                    let data = response.data.analyze_data;
                
                    data.forEach(function(item){
                        item.video_info = JSON.parse(item.video_info || '{}');
                    });
                
                    $scope.analyz_data = data;

                    $scope.totalPages = response.data.totalPages;
                    $scope.hasNext = response.data.hasNext;
                    $scope.hasPrev = response.data.hasPrev;
                }  
                jsLoader(false);
                $scope.loading = false;
            })
            .catch(function () {
                jsLoader(false);
                $scope.loading = false;
                console.log("Something went wrong!");
            });
        };
        
        $scope.getanalyzedata();


         $scope.optimizevideo = function (id, video_info) {
                jsLoader(true);

                var queryStr = "<?php echo base_url('optimize-with-ai')?>";

                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                         'id': id,
                        'video_info': video_info
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                    .then(function (response) {
                        jsLoader(false);
                        if (response.data.success) {
                            toastr.success(response.data.msg);
                            var encodedId = btoa(id) .replace(/\+/g, '-') .replace(/\//g, '_') .replace(/=+$/, '');
                            
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

        $scope.downloadPDF = function (videoData) {
            if (!videoData) {
                toastr.error("No data found for this video!");
                return;
            }

            var payload = {
                analyze_data: videoData
            };

            var dataInput = document.getElementById('video_pdf_data_input');
            var form = document.getElementById('videoPdfForm');

            if (dataInput && form) {
                dataInput.value = JSON.stringify(payload);
                form.submit();
                toastr.success("Preparing report for: " + videoData.title);
            } else {
                console.error("Form or Input element not found!");
                toastr.error("Export failed. Technical issue.");
            }
        };


         $scope.deleteAnalyzdata = function(id) {
                 Swal.fire({
                     title: 'Are you sure?',
                     text: 'This action cannot be undone!',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Yes, delete it!',
                     cancelButtonText: 'Cancel'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         // Call the delete function here
                         $scope.softDelete(id);
                     }
                 });
             };

             $scope.softDelete = function(id) {
                 var id = id;
                 var fd = new FormData();
                 fd.append('id', id);
                 $http({
                     method: 'POST',
                     url: siteUrl + 'delete-analyz-data',
                     aync: false,
                     data: fd,
                     dataType: "json",
                     transformRequest: angular.identity,
                     headers: {
                         'Content-Type': undefined
                     }
                 }).then(function(response) {
                     if (response.data.status == true) {
                         toastr.success(response.data.msg);
                          $scope.getanalyzedata();
                     } else if (response.data.error) {
                         toastr.error(response.data.error.msg);
                     } else {
                         toastr.error('Something went wrong');
                     }
                 });
             }


             $scope.edit_analyz = function (id) {
            if (!id) {
                flashNow({
                    error: { message: "Something went wrong." }
                });
                return;
            }
        
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "<?php echo base_url('send-id'); ?>";
        
            // prompt field
            var input1 = document.createElement("input");
            input1.type = "hidden";
            input1.name = "id";
            input1.value = id;
            form.appendChild(input1);

            document.body.appendChild(form);
            form.submit();
        };

        $scope.nextPage = function () {

        if ($scope.hasNext) {
            $scope.currentPage++;
            $scope.getanalyzedata();
        }
    };

    $scope.prevPage = function () {

        if ($scope.hasPrev) {
            $scope.currentPage--;
            $scope.getanalyzedata();
        }
    };

    $scope.getFilteredCount = function() {
        return $scope.filteredVideos ? $scope.filteredVideos.length : 0;
    };

        $scope.$watch('searchKey', function (newVal, oldVal) {

            if (newVal !== oldVal) {

                $scope.currentPage = 1;

                $scope.getanalyzedata();
            }
        });

        });

    </script>