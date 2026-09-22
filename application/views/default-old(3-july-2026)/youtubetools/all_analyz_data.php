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
                        <i class="fa-solid fa-gauge-high"></i>
                        <div>
                            <h3 class="title">Optimize Your Video</h3>
                            <p class="desc">Improve performance with smart AI insights.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-card mb-3">
                <h6 class="title-color">Manage All Videos</h6>
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
                    <span class="{{ video.optimized == 1  ? 'optimized optimizer-badge'  : 'non-optimized optimizer-badge' }}">
                        {{ video.optimized == 1 ? 'Optimized' : 'Non-Optimized' }}
                    </span>
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
                    <div class="d-flex align-items-end gap-3 align-self-stretch">
                        <a href="javascript:void(0)" ng-click="optimizevideo(video.id , video.video_info)" class="btn btn-primary py-2" ng-if="video.optimized ==0">
                            <i class="fa-brands fa-searchengin"></i> Optimize
                        </a>
                        <a href="javascript:void(0)" class="action-btn btn-primary" ng-click="downloadPDF(video)"><i class="fa-solid fa-download"></i></a>
                        <a href="javascript:void(0)" class="action-btn btn-primary" ng-click="edit_analyz(video.id)">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 4.84854H2.98944V12.6356H0V4.84854Z" fill="black" fill-opacity="1"/>
                                <path d="M11.561 10.1453C12.1722 9.11762 12.0445 7.77187 11.1598 6.88768C10.637 6.36487 9.95145 6.10324 9.26589 6.10324C8.58032 6.10324 7.8952 6.36487 7.37195 6.88768C6.32589 7.93374 6.32589 9.62949 7.37195 10.6756C7.89476 11.1984 8.58032 11.46 9.26589 11.46C9.7292 11.46 10.1886 11.3301 10.602 11.0912L12.8783 13.3675L13.8303 12.4155L11.561 10.1453ZM10.5412 10.0565C10.2004 10.3973 9.74757 10.5846 9.26589 10.5846C8.7842 10.5846 8.33139 10.3969 7.99101 10.0565C7.28795 9.35343 7.28795 8.20937 7.99101 7.5063C8.33182 7.16549 8.78464 6.97824 9.26589 6.97824C9.74757 6.97824 10.2004 7.16593 10.5412 7.5063C11.2443 8.20937 11.2443 9.35343 10.5412 10.0565Z" fill="black" fill-opacity="1"/>
                                <path d="M11.7033 6.20156V0H8.71387V5.27494C8.89499 5.24694 9.07874 5.22856 9.26555 5.22856C10.1808 5.22856 11.0409 5.57506 11.7033 6.20156Z" fill="black" fill-opacity="1"/>
                                <path d="M6.75299 6.26904C6.93018 6.09185 7.12355 5.93741 7.3283 5.80354V2.69772H4.33887V12.636H7.3283V11.7597C7.12312 11.6258 6.92974 11.4709 6.75299 11.2942C5.36743 9.9086 5.36743 7.6546 6.75299 6.26904Z" fill="black" fill-opacity="1"/>
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="action-btn btn-primary" ng-click="deleteAnalyzdata(video.id)"><i class="fa-solid fa-trash"></i></a>
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