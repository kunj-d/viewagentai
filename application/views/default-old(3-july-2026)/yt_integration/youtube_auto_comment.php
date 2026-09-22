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
	.pointerdisable{
		pointer-events: none !important;
		opacity: 0.5;
	}
    .avatar-wrapper.active-video,
    .avatar-wrapper:hover{
        border-color: var(--primary-color);
        background: var(--primary-color);
    }
</style>

<div class="container-wrapper container-wrapper container-open">
<title><?php echo $this->config->item('productName') ?> | YT Auto Comments</title>
<div class="container-fluid container-padding padding-bonus" id="libCtrl" ng-app="MyApp" ng-controller="MyCtrl">
	<div class="bonus-wrapper">
		<div class="row row-gap-2">
			<div class="col-12">
				<div class="title-line">Auto Comment</div>
				<p>Set automatic comments for your selected YouTube videos</p>
			</div>
			<div class="col-lg-12">
				<div class="content-side comman-tab py-lg-2">
					<div class="form-group mb-4">
						<label for="chooseVideo" class="form-label mb-2">Choose target Video
							<span 
								data-bs-toggle="tooltip" 
								data-bs-placement="top" 
								data-bs-custom-class="custom-tooltip" 
								data-bs-title="Select one or more videos where auto comments will be posted."
								data-bs-original-title="Select one or more videos where auto comments will be posted."
								title=""> 
								<i class="fa-solid fa-circle-info"></i>
							</span>
						</label>
						<div class="input-group custom-input-group">
							<div>{{ selectedVideo.id }}</div>
							<input type="text" class="form-control" placeholder="Select Video"  value="{{ selectedCount }} Selected Videos" readonly>
							<button class="btn btn-primary btn-no-style" type="button"  data-bs-toggle="modal" data-bs-target="#videoDetailsModal">Choose Video</button>
						</div>
						<!-- <div>
							<div>{{ selectedVideo.id }}</div>
							<button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#videoDetailsModal">Choose Specific Video</button>
						</div> -->
					</div>
					<div class="form-group mb-4">
						<label for="triggerKeyword" class="form-label mb-2">Comment Text
							<span 
								data-bs-toggle="tooltip" 
								data-bs-placement="top" 
								data-bs-custom-class="custom-tooltip" 
								data-bs-title="Write the comment that will be posted automatically. "
								data-bs-original-title="Write the comment that will be posted automatically. "
								title=""> 
								<i class="fa-solid fa-circle-info"></i>
							</span>
						</label>
						<textarea name="commenttext" rows="9" id="commenttext" ng-model="commenttext" class="form-control" placeholder="Write your comment here..."></textarea>
					</div>
					<div class="form-group mb-4">
						<div class="d-flex flex-column gap-3">
							<div class="form-check">
								<input class="form-check-input" type="radio" id="instant" ng-model="commentType" name="comment_type" value="instant">
								<label class="form-check-label" for="instant">Comment Instantly</label>
							</div>
							<div class="d-flex align-items-center gap-3">
								<div class="form-check">
								<input class="form-check-input" type="radio" id="delay" ng-model="commentType" name="comment_type" value="delay">
								<label class="form-check-label" for="delay">Set Delay</label>
								</div>
								<div class="input-group w-25">
								<input type="number" min="1" class="form-control" 
										ng-class="{'pointerdisable': commentType === 'instant'}" 
										ng-model="delayactivity" id="delayInput">
								<span class="input-group-text">Hour</span>
								</div>
							</div>
							</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="#" class="btn btn-primary" ng-click="saveAutoComment()">Save</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	
<!-- Video Details Model -->
<div class="modal fade" id="videoDetailssModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered w-75 mw-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                
                <div class="">
                    <div class="row" >
						<div class="col-lg-4 col-md-6 col-12 mt-2" 
							ng-repeat="video in all_videos | orderBy:columName:reverse" 
							ng-click="toggleVideoSelection(video.id)">
							
							<div class="avatar-wrapper avatar-wrapper-style-1" 
								ng-class="{'active-video': isSelected(video)}">
								
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
		<div class="modal-content border">
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
				<div class="col-md-4 col-12" ng-repeat="video in all_videos | orderBy:columName:reverse | filter:searchQuery" ng-click="toggleVideoSelection(video.id)">
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
			<div class="modal-footer border-0 justify-content-between pb-0">
				<div class="col-xs-12">
					<div class="row justify-content-center" ng-cloak ng-show="all_videos.length>0">
						<div class="col-12 d-flex align-items-center">
							Page &nbsp;
							<input value="{{pageNo}}" type="text" class="form-control" style="height: 30px; width: 45px;" readonly> &nbsp;&nbsp; Of {{totalpages}}&nbsp;&nbsp;&nbsp;
							<button type="button" class="btn "  ng-click="get_next_prev_videos(prevPageToken,'prev')" ng-disabled="!prevPageToken"><i class="fa fa-angle-double-left"></i></button>
							<button type="button" class="btn "  ng-click="get_next_prev_videos(nextPageToken,'next')" ng-disabled="!nextPageToken"><i class="fa fa-angle-double-right"></i></button>
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<button class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Continue</button>
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
		$scope.selectedVideos = [];

		/* Setup Default Values Sidahrth */
		// $scope.selectedVideo.id = `<?php echo !empty($video_data[0]['video_id']) ? $video_data[0]['video_id'] : '' ?>`;
		$scope.maxactivity = <?php echo !empty($video_data[0]['max_activity']) ? $video_data[0]['max_activity'] : 0 ?>;
		$scope.stopsetting = <?php echo !empty($video_data[0]['stop_setting']) ? $video_data[0]['stop_setting'] : 0 ?>;
		$scope.stopsettingtime = `<?php echo !empty($video_data[0]['stop_setting_time']) ? $video_data[0]['stop_setting_time'] : '' ?>`;
		$scope.delayactivity = <?php echo !empty($video_data[0]['delay_activity']) ? $video_data[0]['delay_activity'] : 0 ?>;

		/* Setup Default Values  Sidharth */







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
		
			// Toggle selection
			$scope.toggleVideoSelection = function(videoId) {
			const idx = $scope.selectedVideos.indexOf(videoId);
			if (idx > -1) {
				$scope.selectedVideos.splice(idx, 1); // Deselect
			} else {
				$scope.selectedVideos.push(videoId);  // Select
			}
		};
		$scope.selectedCount = 0;
		// Check if video is selected
		$scope.isSelected = function(video) {
			$scope.selectedCount = $scope.selectedVideos.length;
			return $scope.selectedVideos.includes(video.id);
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

		$scope.saveAutoComment =  function(update_id = null){
			var queryStr = "<?php echo base_url('insert-v2-comment')?>";
				jsLoader(true);
				$http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
						'update_id'          : update_id || "",
						'video_id'           : $scope.selectedVideos,
						'comment_text'         : $scope.commenttext,
						'delay_activity'     : $scope.delayactivity,
						'instant_comment'     : $scope.commentType,
					}),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
					jsLoader(false);
					flashNow({'success' : {'message':"AutoComment Set Successfully."}});
				
						if(update_id != null ) {
					    window.location.href = "<?php echo base_url('youtube-publisher');?>";
					} else {
					    window.location.href = "<?php echo base_url('youtube-v2-auto-comment');?>";
					}
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