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
		background: var(--theme-bg);
		padding: 5px 10px;
		border-radius: 5px;
		color: #fff;
	}
	.cross-icon i{
		font-size: 16px !important;
		color: var(--white-color) !important;
	 }
</style>

<div class="container-wrapper container-wrapper container-open">
<title><?php echo $this->config->item('productName') ?> | YT Auto Replay</title>
<div class="container-fluid container-padding padding-bonus" id="libCtrl" ng-app="MyApp" ng-controller="MyCtrl">
	<div class="bonus-wrapper">
	    
	     <div class="row row-gap-2">
            <div class="col-12">
                <div class="title-line">Auto Reply</div>
                <p>Manage and automate replies to your YouTube video comments.</p>
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
                                                    <i ng-if="!selectedVideo.thumbnail" class=" fa-solid fa-film"></i>
    												<div class="image-thumbnail position-relative" ng-if="selectedVideo.thumbnail">
    													<img ng-src="{{ selectedVideo.thumbnail }}" alt="Video Image" class="img-fluid">
    													<a href="javascript:void(0);" class="cross-icon" ng-click="emptymedia()"><i class="fa-solid fa-xmark"></i></a>
    												</div>
                                                </div>
    											<div ng-if="!selectedVideo.thumbnail" class="mt20" data-bs-toggle="modal" data-bs-target="#videoDetailsModal" style="cursor: pointer;">
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
                                    <!-- Trigger Keywords -->
                                    <div class="form-group">
                                        <label class="form-label" for="triggerKeyword">
                                            Trigger Keywords
                                            <span 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                data-bs-custom-class="custom-tooltip" 
                                                title="Replies will only trigger when these keywords appear in comments.">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </span>
                                        </label>
                                        <textarea 
                                            name="home_meta_keyword" 
                                            placeholder="Enter keywords to auto-reply when detected..." 
                                            class="form-control tags meta_keywords" 
                                            ng-model="triggerkeyword" 
                                            id="tags">
                                        </textarea>
                                        <p class="mt-1 text-dark mb-0" style="font-weight:300; font-size:12px;">Press enter to tag the keywords</p>
                                    </div>
                                    
                                    <!--<div class="form-check mb-0">
                                        <input class="form-check-input" id="ctkCheck1" type="checkbox" ng-model="iscustomreply">
                                        <label class="form-check-label" for="ctkCheck1" >Check this box to activate custom reply mode</label>
                                    </div>-->
                                    
                                    <!-- Reply Text Area (Shown only when checked) -->
                                    <!--<div class="form-group" ng-show="iscustomreply">-->
                                    <div class="form-group">
                                        <label class="form-label" for="replytext">
                                            Reply Text
                                            <span 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                data-bs-custom-class="custom-tooltip" 
                                                title="Enter the message to be sent automatically as a reply.">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </span>
                                        </label>
                                        <textarea 
                                            name="replyText" 
                                            rows="5" 
                                            id="replyText" 
                                            class="form-control" 
                                            ng-model="replytext" 
                                            placeholder="Enter Reply Text">
                                        </textarea>
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
    						<a href="javascript:void(0);" class="btn btn-primary" ng-click="saveReplyAutomation(<?php echo $video_data[0]['id'] ?>)">Save</a>
    					</div> 
                    </div>
                </div>
            </div>
		</div>
	</div>

	
<!-- Video Details Model -->
<div class="modal fade" id="videsoDsetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered w-75 mw-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                
                <div class="">
                    <div class="row" >
						
                        <div class="col-lg-4 col-md-6 col-12" ng-repeat="video in all_videos |orderBy:columName:reverse" ng-click="selectVideo(video)">
                            <div class="avatar-wrapper avatar-wrapper-style-1" ng-class="{'active-video': selectedVideo && selectedVideo.id === video.id}">
                                <div class="avatar-wrapper-inner">
                                    <div class="avatar-img" style="overflow: visible;">
                                        <!-- <div class="check-icon" style="border-radius: inherit;">
                                            <a href="javascript:void(0)" class="btn btn-white" ng-click="showVideoeDetails(video)">View Details</a>
                                        </div> -->
                                        <img src="{{video.thumbnail}}" alt="Image" style="border-radius: inherit;">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0">{{video.publishedAt|date:'medium'|limitTo:12}}</p>
                                        <p class="mb-0">{{avatar.name}}</p>
                                        <a class="text-white video" ng-href="https://www.youtube.com/watch?v={{video.id}}" target="_blank"><i class="fa-solid fa-circle-play"></i></a>
                                    </div>
                                </div>
                            </div>	

                        </div>
                    </div>
                    <!-- Pagination Section -->
                    <div class="col-xs-12">
                        <div class="row" ng-cloak ng-show="all_videos.length>0">
                            <div class="col-12 text-right p-0 px-3">
                                Page &nbsp;
                                <input value="{{pageNo}}" type="text" style="height: 30px;width: 45px;border: solid 1px rgb(237, 237, 237);color: #4a4949;padding: 0px 10px;" readonly> &nbsp;&nbsp; Of {{totalpages}}&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn "  ng-click="get_next_prev_videos(prevPageToken,'prev')" ng-disabled="!prevPageToken"><i class="fa fa-angle-double-left"></i></button>
                                <button type="button" class="btn "  ng-click="get_next_prev_videos(nextPageToken,'next')" ng-disabled="!nextPageToken"><i class="fa fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination Section -->
                    <p class="text-center" ng-show="all_videos.length == 0">No Record Found.</p>
                </div>
                <?php /*
                <p><b>Title :</b> {{ videoTitle  || 'Loading....' }}</p>
                <p><b>Likes:</b> {{ likeCount  || 'Loading....' }}</p>
                <p><b>Views:</b> {{ viewCount  || 'Loading....' }}</p>
                <p><b>Comments:</b> {{ commentCount  || 'Loading....' }}</p>
				<!-- <div class="mb-3">
					<button class="btn btn-success" ng-click="likeVideo(videoId)">👍 Like</button>
					<button class="btn btn-danger" ng-click="dislikeVideo(videoId)">👎 Dislike</button>
				</div> -->

                <h5>Comments:</h5>
                <!-- <textarea ng-model="newCommentText" class="form-control" placeholder="Write a comment..."></textarea> -->
    			<button class="btn btn-primary mt-2" ng-click="postComment(videoId)">Post Comment</button>
                <ul>
                    <li ng-repeat="comment in comments">
                    	<b>{{ comment.author }}:</b>
                    	{{comment.text}}
                    </li>
                </ul>
                */ ?>
            </div>
        </div>
    </div>
</div>



<div class="modal choose-video-modal fade" id="videoDetailsModal" tabindex="-1" aria-labelledby="chooseVideoModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h6 class="modal-title" id="chooseVideoModalLabel">Choose Video</h6>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="search-bar right-icon">
					<div class="search-icon p-2 px-3">
						<span class="icon-search"></span>
					</div>
					<input type="text" class="search form-control bg-transparent" ng-model="searchQuery" placeholder="Search for Video" autocomplete="off">
				</div>
				<div class="row g-3 gap-0 mb-3">
				<div class="loading-area text-center d-flex justify-content-center align-items-center col-12" style="min-height: 200px">
					Loading...
				</div>
				<div class="col-lg-4 col-md-6 col-12" ng-repeat="video in all_videos |orderBy:columName:reverse | filter:searchQuery " ng-click="selectVideo(video)">
					<!-- <div class="avatar-wrapper avatar-wrapper-style-1" ng-class="{'active-video': selectedVideo && selectedVideo.id === video.id}">
						<div class="avatar-wrapper-inner">
							<div class="avatar-img" style="overflow: visible;">
								
								<img src="{{video.thumbnail}}" alt="Image" style="border-radius: inherit;">
							</div>
							<div class="d-flex justify-content-between">
								<p class="mb-0">{{video.publishedAt|date:'medium'|limitTo:12}}</p>
								<p class="mb-0">{{video.title}}</p>
								<a class="text-white video" ng-href="https://www.youtube.com/watch?v={{video.id}}" target="_blank"><i class="fa-solid fa-circle-play"></i></a>
							</div>
						</div>
					</div>	 -->
					<div class="d-block video-box" ng-class="{'active-video': selectedVideo && selectedVideo.id === video.id}">
						<div class="media-box">
							<img ng-src="{{video.thumbnail}}" class="img-fluid mx-auto d-block" alt="Social Img">
						</div>
						<div class="video-title">
							<h6 class="title">{{video.title}}</h6>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-none col-12" ng-repeat="video in all_videos | orderBy:columName:reverse | filter:searchQuery" ng-click="toggleVideoSelection(video.id)">
					<!-- <div class="avatar-wrapper avatar-wrapper-style-1" ng-class="{'active-video': isSelected(video)}">
						<div class="avatar-wrapper-inner">
							<div class="avatar-img" style="overflow: visible;">
								<img ng-src="{{video.thumbnail}}" alt="Image" style="border-radius: inherit;">
							</div>
							<div class="d-flex justify-content-between">
								<p class="mb-0">{{video.publishedAt | date:'medium' | limitTo:12}}</p>
								<p class="mb-0">{{avatar.name}}</p>
								<a class="text-white video" 
								ng-href="https://www.youtube.com/watch?v={{video.id}}" 
								target="_blank">
								<i class="fa-solid fa-circle-play"></i>
								</a>
							</div>
						</div>
					</div> -->
					<div class="d-block video-box" ng-class="{'active-video': isSelected(video)}">
						<input type="checkbox" class="form-check-input" name="video" ng-checked="isSelected(video)">
						<div class="media-box">
							<img ng-src="{{video.thumbnail}}" class="img-fluid mx-auto d-block" alt="Social Img">
						</div>
						<div class="video-title">
							<h6 class="title">{{video.title}}</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer border-0 justify-content-center pb-0">
				<div class="col-xs-12">
					<div class="row justify-content-center" ng-cloak ng-show="all_videos.length>0">
						<div class="col-12 d-flex align-items-center">
							Page &nbsp;
							<input value="{{pageNo}}" type="text" class="form-control" style="height: 30px;width: 45px;" readonly> &nbsp;&nbsp; Of {{totalpages}}&nbsp;&nbsp;&nbsp;
							<button type="button" class="btn "  ng-click="get_next_prev_videos(prevPageToken,'prev')" ng-disabled="!prevPageToken"><i class="fa fa-angle-double-left"></i></button>
							<button type="button" class="btn "  ng-click="get_next_prev_videos(nextPageToken,'next')" ng-disabled="!nextPageToken"><i class="fa fa-angle-double-right"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Video Details Model -->

</div>
</div>




<!------ Page Content End --------->
<!-- Welcome Popup -->

<script>
 
	var app = angular.module('MyApp', []);

	app.controller('MyCtrl', function($scope,$http,$timeout,$parse) {
		$scope.columName_model = 'publishedAt';
		$scope.limit = '6';
		$scope.pageNo = 1;
		$scope.totalpages = 0; 
		$scope.commentCount =  $scope.commentCount || 0;
		$scope.likeCount =  $scope.likeCount || 0;
		$scope.thumbnail =  $scope.thumbnail || '';
		$scope.viewCount =  $scope.viewCount || 0;
		$scope.comments = {};
		$scope.selectedVideo = { id : "", thumbnail : "" };
		/* Setup Default Values Sidahrth */
		$scope.selectedVideo.id = `<?php echo !empty($video_data[0]['video_id']) ? $video_data[0]['video_id'] : '' ?>`;
		$scope.selectedVideo.thumbnail = `<?php echo !empty($video_data[0]['thumbnail']) ? $video_data[0]['thumbnail'] : '' ?>`;
		$scope.maxactivity = <?php echo !empty($video_data[0]['max_activity']) ? $video_data[0]['max_activity'] : 0 ?>;
		$scope.stopsetting = <?php echo !empty($video_data[0]['stop_setting']) ? $video_data[0]['stop_setting'] : 0 ?>;
		$scope.stopsettingtime = `<?php echo !empty($video_data[0]['stop_setting_time']) ? $video_data[0]['stop_setting_time'] : '' ?>`;
		$scope.delayactivity = <?php echo !empty($video_data[0]['delay_activity']) ? $video_data[0]['delay_activity'] : 0 ?>;
// 		$scope.openaiorcustom = $scope.replytext = `<?php echo !empty($video_data[0]['reply_text']) ? $video_data[0]['reply_text'] : '' ?>`;

        $scope.openaiorcustom = false;
		$scope.delayactivitytime = `hour`;
		/* Setup Default Values  Sidharth */
		$scope.triggerkeywordData = `<?php echo !empty($video_data[0]['keywords']) ? $video_data[0]['keywords'] : '' ?>`;
		$scope.triggerkeyword = $scope.triggerkeywordData.split(',').map(s => s.trim().toLowerCase());


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

		$scope.emptymedia =  function(){
			$scope.selectedVideo = { id : "", thumbnail : "" };
		}



		<?php if($key!="stats" && !empty($key)){ ?>
			$scope.playlist_id ="<?php echo $key;?>";
		<?php }else { ?>
			$scope.playlist_id = 'all';
		<?php } ?>

		set_default_variables();
		get_youtube_videos();

		$scope.getFilterData = function(){
			$scope.pageNo = 1;
			set_default_variables();
			get_youtube_videos();
		}

		function set_default_variables() {
			$scope.all_videos = [];
			$scope.pageToken = '';
			$scope.is_show_data = 0;
			$scope.searchKey = '';
			$scope.columName = 'publishedAt';
			$scope.sortOrder = true;
			$scope.draw = 0;
			$scope.from_date='';
			$scope.to_date='';
			$scope.total_videos=0;
			$scope.nextPageToken = "";
			$scope.prevPageToken = "";
			$scope.check_all_selected = false;
		}


		/* Code By Sidharth Start */
		

			$scope.selectVideo = function(video) {
				$scope.selectedVideo = video;
				$('#videoDetailsModal').modal('hide');
			};
			$scope.showVideoeDetails = function(currVideo){

				$scope.videoTitle =  	currVideo.title  != 0 ? currVideo.title : 'Empty';
				$scope.commentCount =  	currVideo.commentCount  != 0 ? currVideo.commentCount : '0';
				$scope.likeCount =  	currVideo.likeCount  != 0 ? currVideo.likeCount : '0';
				$scope.thumbnail =  	currVideo.thumbnail;
				$scope.viewCount =  	currVideo.viewCount  != 0 ? currVideo.viewCount : '0';
				var videoId = currVideo.id;
				$('#videoDetailsModal').modal('show');

				$http.get("<?= base_url('youtube/getLastComments') ?>", { params: { videoId } }).then(function(response) {
					$scope.comments = response.data;
					console.log('comments : ', $scope.comments);
				});
				
			}
			
			$scope.validateMaxActivity = function () {  
                if ($scope.maxactivity ===  undefined) {
                    $scope.maxactivity = 5;
                } else if ($scope.maxactivity < 0) {
                    $scope.maxactivity = 0;
                }
            };



		$scope.saveReplyAutomation =  function(update_id = null){
			var queryStr = "<?php echo base_url('insert-v2-reply')?>";
			
				if(!$scope.selectedVideo.id){
					flashNow({'error' : {'message':"Error ! Select The Video First."}});
					return;
				}
				jsLoader(true);
				$http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
						'update_id'          : update_id || "",
						'autolike'           : $scope.autolike ? 1 : 0,
						'video_id'           : $scope.selectedVideo.id,
						'thumbnail'          : $scope.selectedVideo.thumbnail,
						'openaiorcustom'     : $scope.openaiorcustom,
						'keywords'           : $scope.triggerkeyword,
						'reply_text'         : $scope.replytext,
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
                }).then(function (response) {
					jsLoader(false);
					flashNow({'success' : {'message':"AutoReply Set Successfully."}});
					
				// 	if(update_id != null ) {
				// 	    window.location.href = "<?php echo base_url('youtube-publisher');?>";
				// 	} else {
				// 	    window.location.href = "<?php echo base_url('youtube-v2-auto-comment');?>";
				// 	}
                    if (response.data.status == true) {
                        $scope.avatarList = response.data;
                        //  $scope.startGeneratingVideos();
                    } else {
                          $scope.avatarList = response.data;
                    }
                }); 
		}	




		/* Code By Sidharth End */



		function get_youtube_videos() {
			var queryStr = "<?php echo base_url('youtube/get_videos_json')?>";
			queryStr += "?limit=" + $scope.limit;
			queryStr += "&pageToken=" + $scope.pageToken;
			queryStr += "&searchKey=" + $scope.searchKey;
			queryStr += "&pageNo=" + $scope.pageNo;
			queryStr += "&sortOrder=" + $scope.sortOrder;
			queryStr += "&draw=" + $scope.draw;
			queryStr += "&date_type=" + $scope.date_type;
			queryStr += "&from_date=" + $scope.from_date;
			queryStr += "&to_date=" + $scope.to_date;	
			queryStr += "&columName=" + $scope.columName;	
			queryStr += "&playlist_id=" + $scope.playlist_id;

// 			jsLoader(true);
			$http.get(queryStr)
			.then(function(response) {
				jsLoader(false);
				$('.loading-area').removeClass('d-flex').addClass('d-none');
				$scope.all_videos = response.data.data;
				$scope.sort_data=[];
				angular.forEach($scope.all_videos, function (index, reply) {
					$scope.sort_data.push({ index });
				});
				console.log($scope.sort_data);
				$scope.total_videos = response.data.recordsTotal;
				$scope.nextPageToken = response.data.nextPageToken;
				$scope.prevPageToken = response.data.prevPageToken;

				if($scope.all_videos.length==0){
					$scope.is_show_data=2;
				} else{
					$scope.totalpages=Math.ceil($scope.total_videos/$scope.limit);
					$scope.is_show_data=1;
				}
			});
		}

		$scope.get_next_prev_videos = function(token,type){
			set_default_variables();
			$scope.pageToken = token;
			$('.loading-area').removeClass('d-none').addClass('d-flex');
			$scope.pageNo = type=='next' ? ($scope.pageNo + 1) : ($scope.pageNo - 1);
			get_youtube_videos();
		}

		$scope.toggleSelection = function() {
			angular.forEach($scope.all_videos, function(video) {
				video.selected=$scope.check_all_selected;
			});
		};

		$scope.uncheck = function(){
			$scope.total_check = 0;
			angular.forEach($scope.all_videos, function(video) {
				if(video.selected){
					$scope.total_check++;
				}
			});

			if($scope.limit==$scope.total_check){
				$scope.check_all_selected = true;		
			} else{
				$scope.check_all_selected = false;		
			}
		}

		/*$scope.delete_video = function(ids){
				deleteConfirm(function(){
					var url = siteUrl +'delete-videos-json?ids='+ids;
					$http.post(url).then(function(response){
						flashNow(response.data);
						set_default_variables();
						$timeout(function(){
							$scope.getFilterData();
						},1500);
					});
				},"Are you sure to delete this video ?");
		}*/

		$scope.reverse = true;
		$scope.columName="publishedAt";
		var propertyName="publishedAt";

		$scope.sortBy = function() {
			if($scope.columName === propertyName){
				$scope.reverse =true;
			}else{
				$scope.reverse = false;
				propertyName=$scope.columName;
			}
		}	
	});

	function jsLoader(add){
		if(add === undefined) {
			add=false;
		}
		$(".temp_js_loader").remove();

		if(add) {
			$("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $this->config->item('assetsPath');?>themes/default/img/loading-icon.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;"></div>');
		}	
	}

	$(document).on("click", function(e){
		target = e.target || e.srcElement;
		if($(target).hasClass('text')){
			angular.element("#customersCtrl").scope().sortBy();
		}
	});

	$("#checkAll").click(function () {
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	function openfileDialog(current_video) {
		// if(!angular.element("#customersCtrl").scope().pr_manage){
			// flashNow({'error' : {'message':"Error ! Permission Denied."}});
		// }else{
		video_id=$(current_video).attr('id');
		var frm_action_path = siteUrl +'edit-video-thumb-json/'+video_id;
		$('#frm_edit_thumbnail').attr('action',frm_action_path);
		$("#input_thumbnail").click();
		//}
	}
</script>