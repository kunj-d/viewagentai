<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style>
	[ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
	  display: none !important;
	}

    .avatar-wrapper{
        padding: 4px;
        border: 1px solid var(--theme-br);
        border-radius: 10px;
        transition: 0.4s;
    }
    .video-box.active-video,
    .video-box:hover{
        border-color: var(--primary-color);
        background: var(--primary-color);
    }
	.cross-icon{
		position: absolute;
		top: -10px;
		right: -10px;
		background: var(--primary-color);
		padding: 5px 10px;
		border-radius: 5px;
		color: #fff;
	}
	.cross-icon i{
		font-size: 16px !important;
		color: var(--white-color) !important;
	 }
</style>

<div class="container-wrapper container-wrapper container-open" ng-app="MyApp" ng-controller="MyCtrl">
<title><?php echo $this->config->item('productName') ?> | Facebook Replay</title>

<div class="container-fluid container-padding padding-bonus">
    <div class="bonus-wrapper">

        <div class="row row-gap-2">
            <div class="col-12">
                <div class="title-line">Facebook Auto Reply</div>
                <p>Create and manage your visual content</p>
            </div>

            <div class="col-12">
                <div class="wrapper-box position-relative border-0" style="min-height: calc(100vh - 110px) !important;">
                    <div class="content-side">

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label mb-2">Choose Target Video</label>

                                    <div>
                                        <div class="custom-upload-2" >
                                            <div class="file-post custom-file-upload">
                                                <div class="media-box mb-0">
                                                    <i ng-if="!selectedVideo.id" class=" fa-solid fa-film"></i>
                                                    <div class="image-thumbnail position-relative" ng-if="selectedVideo.id" ng-clock>
                                                        <img  ng-src="{{ selectedVideo.full_picture }}" alt="Video Image" class="img-fluid">
                                                        <!--<img ng-if="selectedVideo.media_type == 'VIDEO'" ng-src="{{ selectedVideo.thumbnail_url }}" alt="Video Image" class="img-fluid">-->
                                                        <!--<img ng-if="selectedVideo.media_type == 'IMAGE'" ng-src="{{ selectedVideo.media_url }}" alt="Video Image" class="img-fluid">-->
                                                        <a href="javascript:void(0);" class="cross-icon" ng-click="emptymedia()"><i class="fa-solid fa-xmark"></i></a>
                                                    </div>
                                                </div>
                                                <div ng-if="!selectedVideo.id" class="mt20" data-bs-toggle="modal" data-bs-target="#videoDetailsModal" style="cursor: pointer;">
                                                    <h5 class="title">Choose Video</h5>
                                                    <p class="upload-text">Pick a video to enable smart auto-reply</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="d-flex flex-column gap-3">

                                    <div class="form-group">
                                        <label class="form-label" for="triggerKeyword">Trigger Keywords
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="Replies will only trigger when these keywords appear in comments.">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </span>
                                        </label>
                                        <textarea  name="home_meta_keyword"  placeholder="Enter keywords to auto-reply when detected..."  class="form-control tags meta_keywords"  ng-model="triggerkeyword" id="tags">
                                        </textarea>
                                        <p class="mt-1 text-dark mb-0" style="font-weight:300; font-size:12px;">Press enter to tag the keywords</p>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" id="ctkCheck1" type="checkbox" ng-model="iscustomreply">
                                        <label class="form-check-label" for="ctkCheck1" >Check this box to activate custom reply mode</label>
                                    </div>
                                    <div class="form-group" ng-show="iscustomreply">
                                        <label class="form-label">
                                            Reply Text
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    title="Enter the message to be sent automatically as a reply.">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </span>
                                        </label>
                                        <textarea rows="5" class="form-control" placeholder="Write your automated message..." ng-model="replytext"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Duration</label>
                                        <div class="theme-card">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="maximumactivity" class="form-label">Maximum Activity
                                                            <span 
                                                                data-bs-toggle="tooltip" 
                                                                data-bs-placement="top" 
                                                                data-bs-custom-class="custom-tooltip" 
                                                                data-bs-title="Set how many comments will get auto reply at one time."
                                                                data-bs-original-title="Set how many comments will get auto reply at one time."
                                                                title=""> 
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            </span>
                                                        </label>
                                                        <input type="number" min="0" max="5"  ng-change="validateMaxActivity()" class="form-control" ng-model="maxactivity"  id="maximumactvity">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="delay-activity" class="form-label">Delay Activity
                                                            <span 
                                                                data-bs-toggle="tooltip" 
                                                                data-bs-placement="top" 
                                                                data-bs-custom-class="custom-tooltip" 
                                                                data-bs-title="Set time gap between each auto reply (Instant replies are limited as per YouTube guidelines to avoid being flagged as suspicious)"
                                                                data-bs-original-title="Set time gap between each auto reply (Instant replies are limited as per YouTube guidelines to avoid being flagged as suspicious)"
                                                                title=""> 
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            </span>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" max="99" class="form-control"  ng-model="delayactivity" id="delaytime">
                                                            <span class="input-group-text" ng-model="delayactivitytime">Hour</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="stopafter" class="form-label">Stop Settings After
                                                            <span 
                                                                data-bs-toggle="tooltip" 
                                                                data-bs-placement="top" 
                                                                data-bs-custom-class="custom-tooltip" 
                                                                data-bs-title="Stop auto reply after these many days."
                                                                data-bs-original-title="Stop auto reply after these many days."
                                                                title=""> 
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            </span>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" max="30" class="form-control" ng-model="stopsetting" id="stopafter">
                                                            <span class="input-group-text">Days</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" ng-click="savefbReplyAutomation()">Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Video Modal -->
    <div class="modal choose-video-modal fade" id="videoDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header border-0">
                    <h6 class="modal-title">Choose Video</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    
                    <!--<div class="search-bar right-icon">-->
                    <!--    <div class="search-icon p-2 px-3">-->
                    <!--        <span class="icon-search"></span>-->
                    <!--    </div>-->
                    <!--    <input type="text" class="search form-control bg-transparent" placeholder="Search for Video">-->
                    <!--</div>-->
                    
                    <div class="row g-3 gap-0 mb-3">
                        <div class="col-lg-4 col-md-6 col-12" ng-repeat="video in all_videos" ng-click="selectVideo(video)">
                            <div class="d-block video-box">
                                <div class="media-box">
                                    <img ng-src="{{video.full_picture}}" class="img-fluid">
                                    <!--<img ng-if="video.media_type == 'VIDEO'" ng-src="{{video.thumbnail_url}}" class="img-fluid">-->
                                    <!--<img ng-if="video.media_type == 'IMAGE'" ng-src="{{video.media_url}}" class="img-fluid">-->
                                </div>
                                <div class="video-title">
                                    <h6 class="title">{{video.message || 'No Title'}}</h6>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    
                    <!-- Load More Button -->
                    	<div class="text-center mt-3" ng-if="all_videos.length >= 5 && next_cursor">
                            <button ng-click="loadMore()" class="btn btn-primary">
                                Load More
                            </button>
                        </div>


                </div>

            </div>
        </div>
    </div>

</div>







<!------ Page Content End --------->
<!-- Welcome Popup -->

<script>
 
	var app = angular.module('MyApp', []);

	app.controller('MyCtrl', function($scope,$http,$timeout,$parse) {
	    
	  $scope.all_videos = [];
	   $scope.next_cursor = null;
        
        $scope.maxactivity =  0 ;
		$scope.stopsetting =  0 ;
		$scope.stopsettingtime = "";
		$scope.delayactivity = 0 ;

        $(function () {
			$('#tags').tagsInput({
				width: 'auto',
				defaultText: ' ',
				onChange: function () {
					var val = $('#tags').val(); // get current tags
					var scope = angular.element($('#tags')).scope();
					scope.$apply(function () {
						scope.triggerkeyword = val;
					});
				}
			});
		});
        
    //     $scope.getinstadata = function (afterCursor = "") {
    //         if (afterCursor) {
				// 	url += "?after=" + afterCursor;
				// }
    //         var queryStr = "<?php echo base_url('get-instavideo-data')?>";
        
    //         $http({
    //             method: 'GET',
    //             url: queryStr,
    //             headers: {
    //                 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //             }
    //         }).then(function (response) {
    //     console.log(response);
    //             if (response.data.success == true) {
    //                 $scope.all_videos = response.data.all_video.data;
    //             } else {
    //                 console.log("Could not fetch Videos.");
    //             }
    //         });
    //     };

        
        $scope.getinstadata = function (afterCursor = "") {
            var queryStr = "<?php echo base_url('get-fb-data')?>";
        
            if (afterCursor) {
                queryStr += "?after=" + afterCursor;
            }
        
            $http({
                method: 'GET',
                url: queryStr
            }).then(function (response) {

                if (response.data.success == true) {
                    console.log(response)

                    if (!afterCursor) {
                        $scope.all_videos = response.data.all_video.data;
                    } 
                    else {
                        $scope.all_videos = $scope.all_videos.concat(response.data.all_video.data);
                    }
                    if (response.data.all_video.paging &&
                        response.data.all_video.paging.cursors &&
                        response.data.all_video.paging.cursors.after) {
                        $scope.next_cursor = response.data.all_video.paging.cursors.after;
                    } else {
                        $scope.next_cursor = null;
                    }
                } else {
                    console.log("Could not fetch Videos.");
                }
            });
        };
        
        // LOAD MORE FUNCTION
        $scope.loadMore = function () {
            if ($scope.next_cursor) {
                $scope.getinstadata($scope.next_cursor);
            }
        };
        
        // Initial Load
        $scope.getinstadata();


	    $scope.selectVideo = function(video) {
			$scope.selectedVideo = video;
			console.log($scope.selectedVideo)
			$scope.video_id = video.id;
			$('#videoDetailsModal').modal('hide');
		};
		
        $scope.emptymedia =  function(){
			$scope.selectedVideo = { id : "", full_picture : "" , media_url : "" };
			$scope.video_id = "";
		}
		
		$scope.savefbReplyAutomation = function() {
	            if(!$scope.video_id){
					flashNow({'error' : {'message':"Error ! Select The Video First."}});
					return;
				}
				if(!$scope.triggerkeyword){
					flashNow({'error' : {'message':"Error ! Please Enter Trigger Keywords."}});
					return;
				}
            jsLoader(true);
              var queryStr = "<?php echo base_url('save-fb-reply-automation')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                     data: $.param({
                        'triggerkeyword': $scope.triggerkeyword,
                        'video_id': $scope.video_id,
                        'reply_text': $scope.replytext,
                        'max_activity'       : $scope.maxactivity,
						'delay_activity'     : $scope.delayactivity,
						'delay_activity_time': 'hour',
						'stop_setting'       : $scope.stopsetting,
						'stop_setting_time'  : 'days',
						'iscustomreply'      : $scope.iscustomreply
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function(response) {
                    jsLoader(false);
                    // console.log(response)
                    if (response.data.success) {
                         toastr.success(response.data.msg);
                            window.location.href = "<?php echo base_url('automation')?>";
                    } else {
                        toastr.error(response.data.msg);
                    }
                })
                .catch(function(error) {
                    jsLoader(false);
                    toastr.error(error);
                    console.error(error);
                });
            
        } 
	    
	    
	});



</script>