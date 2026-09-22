<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style>
	[ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
	  display: none !important;
	}
</style>

<div class="container-wrapper container-wrapper container-open">

<div class="container-fluid container-padding padding-bonus" id="libCtrl" ng-app="MyApp" ng-controller="MyCtrl">
	<div class="bonus-wrapper">
	    
	    <h2>YouTube Video List</h2>

	    <!-- Search Bar -->
	    <input type="text" class="form-control mb-3" ng-model="search_txt" placeholder="Search videos..." ng-keyup="$event.keyCode == 13 && searchVideos()">
	    <button class="btn btn-primary" ng-click="searchVideos()">Search</button>

	    <!-- Loader -->
	    <div ng-show="loader" class="text-center mt-3">
	        <span class="spinner-border text-primary"></span> Loading...
	    </div>

	    <!-- Video List -->
	    <div class="row">
	        <div class="col-md-4 mb-3" ng-repeat="video in videos">
	            <div class="card">
	            	<a ng-href="https://www.youtube.com/watch?v={{video.id.videoId}}" target="_blank">
	                	<img ng-src="{{video.snippet.thumbnails.medium.url}}" class="card-img-top">
	            	</a>
	                <div class="card-body">
	                    <h5 class="card-title">{{video.snippet.title}}</h5>
	                    <button class="btn btn-info" ng-click="getVideoDetails(video.id.videoId)">View Details</button>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Pagination -->
	    <div class="text-center mt-3">
	        <button class="btn btn-secondary" ng-disabled="!prevPageToken" ng-click="getVideos(prevPageToken)">Previous</button>
	        <button class="btn btn-secondary" ng-disabled="!nextPageToken" ng-click="getVideos(nextPageToken)">Next</button>
	    </div>
		
	</div>
	<!-- Video Details Modal -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><b>Likes:</b> {{ selectedVideo.likeCount || 'Loading...' }}</p>
                <p><b>Views:</b> {{ selectedVideo.viewCount || 'Loading...' }}</p>
                <p><b>Subscribed :</b>
				{{ selectedVideo.subscribed === true ? 'Subscribed' : (selectedVideo.subscribed === false ? 'Not Subscribed' : 'Loading...') }}
				</p>

                <!-- <p><b>Dislikes:</b> {{ selectedVideo.dislikeCount || 'Loading...' }}</p> -->
                <button class="btn btn-success" ng-click="likeVideo(videoId)">👍 Like</button>
    			<button class="btn btn-danger" ng-click="dislikeVideo(videoId)">👎 Dislike</button>
    			<button class="btn btn-danger" ng-click="subscribeChannal(videoId,selectedVideo.subscribed)">👍 {{isSubscribed}}</button>
                
                <h5>Comments:</h5>
                <textarea ng-model="newCommentText" class="form-control" placeholder="Write a comment..."></textarea>
    			<button class="btn btn-primary mt-2" ng-click="postComment(videoId)">Post Comment</button>
                <ul>
                    <li ng-repeat="comment in comments">
                    	<b>{{ comment.snippet.topLevelComment.snippet.authorDisplayName }}:</b>
                    	{{comment.snippet.topLevelComment.snippet.textDisplay}}
                    </li>
                </ul>
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
		$scope.videos = [];
	    $scope.search_txt = "";
	    $scope.loader = false;
	    $scope.nextPageToken = null;
	    $scope.prevPageToken = null;
	    $scope.selectedVideo = {};
	    $scope.comments = {};
	    $scope.newCommentText = "";

	    // Load videos on page load
	    $scope.getVideos = function(pageToken = "") {
	        $scope.loader = true;

	        let params = {
	            search_txt: $scope.search_txt,
	            limit: 10,
	            page_token: pageToken
	        };

	        $http.get("<?= base_url('youtube/all_list') ?>", { params }).then(function(response) {
	            $scope.videos = response.data.items;
	            $scope.nextPageToken = response.data.nextPageToken || null;
	            $scope.prevPageToken = response.data.prevPageToken || null;
	            $scope.loader = false;
	        });
	    };

	    // Fetch video details (likes, views)
	    $scope.getVideoDetails = function(videoId) {
	    	$scope.videoId = videoId;	
	        $scope.selectedVideo = { likeCount: 'Loading...', viewCount: 'Loading...' };
	        $scope.comments = {};
	        $http.get("<?= base_url('youtube/getVideoDetails') ?>", { params: { videoId } }).then(function(response) {
	            $scope.selectedVideo = response.data.items[0].statistics;
				$scope.isSubscribed = $scope.selectedVideo.subscribed == true ? 'Unsubscribe' : 'Subscribe';
			});

	        $http.get("<?= base_url('youtube/getComments') ?>", { params: { videoId } }).then(function(response) {
	            $scope.comments = response.data.items;
	        });

	        $("#videoModal").modal("show");
	    };

	    // Post Comment
	    $scope.postComment = function(videoId) {
	        if (!$scope.newCommentText.trim()) return;

	        let commentData = {
	            videoId: videoId,
	            text: $scope.newCommentText
	        };

	        $http.post("<?= base_url('youtube/postComment') ?>", commentData)
	        .then(function(response) {
	            if (response.data.success) {
	                let newComment = {
	                    snippet: {
	                        topLevelComment: {
	                            snippet: {
	                                authorDisplayName: "You",
	                                textDisplay: $scope.newCommentText
	                            }
	                        }
	                    }
	                };

	                $scope.comments.unshift(newComment); // Add new comment to list
	                $scope.newCommentText = ""; // Clear textarea
	            } else {
	                alert("Failed to post comment!");
	            }
	        });
	    };

	    // Like Video
	    $scope.likeVideo = function(videoId) {
	        $http.post("<?= base_url('youtube/likeVideo') ?>", { videoId: videoId, action: "like" })
	        .then(function(response) {
	            if (response.data.success) {
	                $scope.selectedVideo.likeCount++;
	            }
	        });
	    };

	    // Dislike Video
	    $scope.dislikeVideo = function(videoId) {
	        $http.post("<?= base_url('youtube/dislikeVideo') ?>", { videoId: videoId, action: "dislike" })
	        .then(function(response) {
	            if (response.data.success) {
	                $scope.selectedVideo.likeCount--;
	            }
	        });
	    };
	    
		// Subscribe Channal 
	    $scope.subscribeChannal = function(videoId,isSubscribed) {
			var actionvar =  isSubscribed == true ? 'unsubscribe' : 'subscribe'; 
	        $http.post("<?= base_url('youtube/subscribe') ?>", { videoId: videoId, action: actionvar })
	        .then(function(response) {
				console.log(response);
	            if (response.data.success) {
					if(actionvar == 'unsubscribe'){
						$scope.selectedVideo.subscribed = false;
						$scope.isSubscribed = "Subscribe";
					}else{
						$scope.selectedVideo.subscribed = true;
						$scope.isSubscribed = "Unsubscribe";
					}
	            }
	        });
	    };

	    // Search function
	    $scope.searchVideos = function() {
	        $scope.getVideos();
	    };

	    // Initialize video list
	    $scope.getVideos();
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
</script>