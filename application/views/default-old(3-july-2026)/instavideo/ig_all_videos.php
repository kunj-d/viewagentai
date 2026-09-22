<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>
<style>
	[ng\:cloak],
	[ng-cloak],
	[data-ng-cloak],
	[x-ng-cloak],
	.ng-cloak,
	.x-ng-cloak {
		display: none !important;
	}

	p {
		font-size: 14px;
	}

	.badge {
		font-size: 12px;
		font-weight: 400;
	}

	/* ========== Upload Box ========== */
	.upload-area {
		width: 100%;
		height: 100%;
		background: linear-gradient(145deg, #121212, #1c1c1c);
		border: 1px dashed rgba(255, 255, 255, 0.3);
		border-radius: 12px;
		padding: 20px;
		display: flex;
		align-items: center;
		text-align: center;
		position: relative;
		transition: all 0.3s ease;

		&:hover {
			border-color: var(--primary-color);
			box-shadow: 0 0 10px rgba(255, 59, 59, 0.4);
		}

		/* Default content */
		.upload-default {
			h4 {
				font-size: 18px;
				font-weight: 500;

				span {
					color: var(--primary-color);
					border-bottom: 1px solid var(--primary-color);
					cursor: pointer;
				}
			}

			p {
				color: #aaa;
				font-size: 14px;
				margin-top: 6px;
			}
		}

		.upload-preview {
			display: none;
			flex-direction: column;
			align-items: center;
			gap: 10px;

			.video-icon {
				font-size: 42px;
				color: var(--primary-color);
			}

			.file-name {
				color: var(--primary-color);
				font-size: 15px;
				word-break: break-all;
			}

			.cancel-btn {
				position: absolute;
				top: 12px;
				right: 15px;
				color: #fff;
				font-size: 22px;
				cursor: pointer;
				transition: 0.3s;
				z-index: 9;

				&:hover {
					color: var(--primary-color);
				}
			}
		}

		#videoUpload {
			position: absolute;
			inset: 0;
			opacity: 0;
			cursor: pointer;
		}
	}
</style>

<div class="container-wrapper container-wrapper container-open" ng-app="MyApp" ng-controller="MyCtrl">
	<title><?php echo $this->config->item('productName') ?> | Instagram Publisher</title>
	<div class="container-fluid container-padding padding-bonus" id="libCtrl">
		<div class="col-12" ng-if="all_videos.length === 0 && schedule_videos.length === 0" ng-cloak>
			<div class="create-first">
				<img class="img-fluid d-block mx-auto" src="<?php echo $this->config->item('assetsPath'); ?>images/multimedia.png">
				<p class="description">
					You Haven’t Uploaded Any Video on Instagram Yet
				</p>
				<a href="<?php echo base_url('upload-insta-video'); ?>" class="btn btn-primary">Upload New Video</a>
			</div>
		</div>

		<div class="row align-items-center mb-3" ng-if="all_videos.length > 0 || schedule_videos.length > 0" ng-cloak>
			<div class="col-12">
				<div class="feature-banner">
					<div class="row align-items-center justify-content-between g-0">
						<div class="col-auto feature-wrap">
							<h5 class="feature-title">Create and Manage Instagram Posts</h5>
							<p class="feature-subtitle mb-0">
								Schedule, publish, and track post performance in one place.
							</p>
						</div>
						<div class="col-auto ms-auto">
							<a href="<?php echo base_url('upload-insta-video'); ?>" class=" btn btn-primary"><i class="fa-solid fa-plus"></i> Create New Post </a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="table-wrapper table-wrapper-style-2" ng-if="all_videos.length > 0 || schedule_videos.length > 0" ng-cloak>
			<!-- <div class="form-group mb-2">
				<label for="search" class="form-label">Search</label>
				<div class="input-with-icon left-icon">
					<div class="icon">
						<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
					</div>
					<input type="search" class="form-control" ng-model="searchKey" placeholder="Search content">
				</div>
			</div> -->
			<div class="mb-3">
				<ul class="nav nav-pills nav-pills-style-2 nav-pills-with-gradient gap-2" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="pills-published-tab" data-bs-toggle="pill" data-bs-target="#pills-published" type="button" role="tab" aria-controls="pills-published" aria-selected="false">Published</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="pills-scheduled-tab" data-bs-toggle="pill" data-bs-target="#pills-scheduled" type="button" role="tab" aria-controls="pills-scheduled" aria-selected="true">Scheduled</button>
					</li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane fade show active" id="pills-published" role="tabpanel" aria-labelledby="pills-published-tab" tabindex="0">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Content Details</th>
									<th>Status</th>
									<th>Media Type</th>
									<th>Likes</th>
									<th>Views</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="video in all_videos | filter:searchKey">
									<td>
										<div class="d-flex gap-2 align-items-center">
											<div class="thumb">
												<img ng-if="video.media_type == 'VIDEO'" src="{{ video.thumbnail }}" alt="Video Image" >
												<img ng-if="video.media_type === 'IMAGE' || video.media_type === 'CAROUSEL_ALBUM'" src="{{ video.media_url }}" alt="Video Image" >
											</div>
																		
											<div>
												<div class="title">{{ video.caption || 'No Caption' }}</div>
												<div class="time">{{video.timestamp | date:'dd MMM yyyy, hh:mm a' }}</div>
											</div>
										</div>
									</td>
									<td><span class="badge-status">Published</span></td>
									<!--<td ng-if="video.source == 'scheduled'"><span class="badge-status">Scheduled</span></td>-->
									<td>
										<span>{{video.media_type}}</span>
									</td>
									<td>
										<span class="icon-size"><i class="fa-solid fa-heart text-danger" aria-hidden="true"></i></span>
										<span>{{ video.likeCount }}</span>
									</td>
									<td>
										<span class="icon-size"><i class="fa-solid fa-eye" aria-hidden="true"></i></span>
										<span>{{ video.viewCount }}</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
									
        			<div class="text-center mt-3"
                         ng-if="all_videos.length >= 5 && next_cursor">
                        <button ng-click="loadMore()" class="btn btn-primary">
                            Load More
                        </button>
                    </div>
				</div>

				
				<!--scheduled-->
				<div class="tab-pane fade" id="pills-scheduled" role="tabpanel" aria-labelledby="pills-scheduled-tab" tabindex="0">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Content Details</th>
									<th>Status</th>
									<th>Media Type</th>
									<th>schedule Time</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="scheduledata in schedule_videos | filter:searchKey">
									<td>
										<div class="d-flex gap-2 align-items-center">
											<div class="thumb with-video">
                                                <video muted preload="metadata" style="pointer-events: none;" >
                                                     <source ng-src="{{ getTrustedUrl(scheduledata.video_url) }}" type="video/mp4">
                                                </video>
											</div>
																		
											<div>
												<div class="title">{{ scheduledata.caption || 'No Caption' }}</div>
												<!--<div class="time">{{scheduledata.timestamp | date:'dd MMM yyyy, hh:mm a' }}</div>-->
											</div>
										</div>
									</td>
									<td><span class="badge-status scheduled">Scheduled</span></td>
									<!--<td ng-if="video.source == 'scheduled'"><span class="badge-status">Scheduled</span></td>-->
									<td>
										<span>{{scheduledata.post_type}}</span>
									</td>
									<td>
                                       <span> {{ formatDate(scheduledata.schedule_time) | date:'dd-MM-yyyy hh:mm a' }} </span>
                                    </td>

									<td>
										<a class="trash-icon" href="javascript:void(0);" ng-click="delete_schedule_video(scheduledata.id)">
                                             <i class="fa-solid fa-trash-can"></i>
                                         </a>
									</td>
								</tr>
								
								<tr ng-if="!schedule_videos || schedule_videos.length === 0">
                                    <td colspan="6" class="text-center"> No results found.</td>
                                </tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
				<!--<div class="text-center mt-3"-->
    <!--                 ng-if="all_videos.length >= 5 && next_cursor">-->
    <!--                <button ng-click="loadMore()" class="btn btn-primary">-->
    <!--                    Load More-->
    <!--                </button>-->
    <!--            </div>-->
		

		<!-- Share Modal -->
		<div class="modal fade video-published-modal" id="videoPublishedModal" tabindex="-1" aria-labelledby="videoPublishedModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header border-0">
						<h5 class="modal-title">Video Published</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="video-card d-flex align-items-center gap-3 mb-3">
							<div class="video-thumb">
								<img ng-src="{{ youtube_thumb_url }}" class="img-fluid mx-auto d-block" alt="Thumb Img">
							</div>
							<div>
								<h6 class="video-title mb-1 fw-semibold">{{ video_title }}</h6>
								<p class="video-date mb-0"></p>
							</div>
						</div>
						<h6 class="title mb-2">Share a link</h6>
						<div class="share-icons d-flex flex-wrap mb-3">
							<a ng-href="https://www.facebook.com/sharer/sharer.php?u={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/facebook.png" class="img-fluid mx-auto d-block" alt="Facebook">
								<span>Facebook</span>
							</a>

							<a ng-href="https://www.snapchat.com/scan?attachmentUrl={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/snapchat.png" class="img-fluid mx-auto d-block" alt="Snapchat">
								<span>Snapchat</span>
							</a>

							<a ng-href="https://www.instagram.com/?url={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/instagram.png" class="img-fluid mx-auto d-block" alt="Instagram">
								<span>Instagram</span>
							</a>

							<a ng-href="https://www.tiktok.com/upload?url={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/tik-tok.png" class="img-fluid mx-auto d-block" alt="TikTok">
								<span>TikTok</span>
							</a>

							<a ng-href="https://www.messenger.com/share?link={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/messenger.png" class="img-fluid mx-auto d-block" alt="Messenger">
								<span>Messenger</span>
							</a>

							<a ng-href="https://www.reddit.com/submit?url={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/reddit.png" class="img-fluid mx-auto d-block" alt="Reddit">
								<span>Reddit</span>
							</a>

							<a ng-href="https://twitter.com/intent/tweet?url={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/twiter_x.png" class="img-fluid mx-auto d-block" alt="Twitter">
								<span>Twitter (X)</span>
							</a>

							<a ng-href="https://wa.me/?text={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/whatsapp.png" class="img-fluid mx-auto d-block" alt="WhatsApp">
								<span>WhatsApp</span>
							</a>

							<a ng-href="https://www.linkedin.com/sharing/share-offsite/?url={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/linkedin.png" class="img-fluid mx-auto d-block" alt="LinkedIn">
								<span>LinkedIn</span>
							</a>

							<a ng-href="https://t.me/share/url?url={{youtube_video_url}}" class="social-icon" target="_blank">
								<img src="<?php echo $this->config->item('assetsPath') ?>images/social-icon/telegram.png" class="img-fluid mx-auto d-block" alt="Telegram">
								<span>Telegram</span>
							</a>
						</div>
						<label for="videoLink" class="form-label">Video link</label>
						<div class="d-flex align-items-center gap-2">
							<div class="input-group custom-input-group copy-link">
								<input type="text" id="videoLink" class="form-control border-end-0" value="{{ youtube_video_url }}" readonly>
								<button class="btn btn-outline-secondary input-group-text bg-transparent border-start-0" ng-click="copyToClipboard()"><i class="fa-solid fa-copy"></i></button>
							</div>
							<a href="{{ youtube_video_url }}" target="_blank" class="icon-btn icon-btn-outline"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Choose Video -->
	<div class="modal choose-video-modal fade" id="videoDetailsModal" tabindex="-1" aria-labelledby="chooseVideoModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header border-0">
					<h6 class="modal-title" id="chooseVideoModalLabel">Choose Video</h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="d-flex align-items-sm-center align-items-start flex-sm-row flex-column gap-2 mb-3">
						<ul class="nav nav-pills nav-pills-style-2 nav-pills-with-gradient gap-2" style="min-width: fit-content;" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="pills-landscape-tab" data-bs-toggle="pill" data-bs-target="#pills-MyVideo" type="button" role="tab" aria-controls="pills-MyVideo" aria-selected="true">My Video</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="pills-portrait-tab" data-bs-toggle="pill" data-bs-target="#pills-uploadOwn" type="button" role="tab" aria-controls="pills-uploadOwn" aria-selected="false">Upload Your Own</button>
							</li>
						</ul>
						<!--<div class="search-bar right-icon mb-0 w-100">-->
						<!--	<div class="search-icon p-2 px-3">-->
						<!--		<span class="icon-search"></span>-->
						<!--	</div>-->
						<!--	<input type="text" class="search form-control bg-transparent" ng-model="searchQuery" placeholder="Search for Video" autocomplete="off">-->
						<!--</div>-->
					</div>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="pills-MyVideo" role="tabpanel" aria-labelledby="pills-MyVideo-tab" tabindex="0">
							<div style=" max-height: 300px; overflow-y: auto; overflow-x: hidden; min-height: 300px;">
								<div class="row g-3 gap-0">
									<div class="col-lg-4 col-md-6 col-12" ng-repeat="video in avatarList.avatarListingMade |orderBy:columName:reverse | filter:searchQuery " ng-click="selectVideo(video)">
										<div class="d-block video-box" ng-class="{'active-video': selectedVideo && selectedVideo.id === video.id}">
											<div class="media-box">
												<img ng-src="{{video.thumbnail}}" class="img-fluid mx-auto d-block" alt="Social Img" ng-click="uploadinstagram(video.url)">
											</div>
											<div class="video-title">
												<h6 class="title">{{video.title}}</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-uploadOwn" role="tabpanel" aria-labelledby="pills-uploadOwn-tab" tabindex="0">
							<div style=" max-height: 246px; overflow-y: auto; overflow-x: hidden; min-height: 246px; margin-bottom:10px;">
								<div class="upload-area" style="min-height: calc(100vh - 395px); justify-content:center; height: 100%;">
									<div class="upload-default">
										<h4>Drag & Drop or <span>Browse</span></h4>
										<p>Supports: MP4</p>
									</div>
									<div class="upload-preview">
										<i class="fa-solid fa-xmark cancel-btn"></i>
										<i class="fa-solid fa-video video-icon"></i>
										<p class="file-name"></p>
									</div>
									<input type="file" id="videoUpload" accept="video/mp4">
								</div>
							</div>
							<button class="btn btn-primary float-end" ng-click="uploadVideo()"><i class="fa-solid fa-upload me-1"></i>Upload</button>
						</div>
					</div>
					<div class="row g-3 gap-0 mb-3">
						<div class="col-md-4 d-none col-12" ng-repeat="video in avatarList.avatarListingMade | orderBy:columName:reverse | filter:searchQuery" ng-click="toggleVideoSelection(video.id)">
							<div class="d-block video-box" ng-class="{'active-video': isSelected(video)}">
								<input type="checkbox" class="form-check-input" name="video" ng-checked="isSelected(video)">
								<div class="media-box">
									<img ng-src="{{video.thumbnail}}" class="img-fluid mx-auto d-block" alt="Social Img">
								</div>
								<!--<div class="video-title">-->
								<!--	<h6 class="title">{{video.title}}</h6>-->
								<!--</div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>


	<!-- Choose Video -->
	<!--<div class="modal choose-video-modal fade" id="videoDetailsModal" tabindex="-1" aria-labelledby="chooseVideoModalLabel" aria-hidden="true">-->
	<!--	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">-->
	<!--		<div class="modal-content">-->
	<!--			<div class="modal-header border-0">-->
	<!--				<h6 class="modal-title" id="chooseVideoModalLabel">Choose Video</h6>-->
	<!--				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>-->
	<!--			</div>-->
	<!--			<div class="modal-body">-->
	<!--				<div class="search-bar right-icon">-->
	<!--					<div class="search-icon p-2 px-3">-->
	<!--						<span class="icon-search"></span>-->
	<!--					</div>-->
	<!--					<input type="text" class="search form-control bg-transparent" ng-model="searchQuery" placeholder="Search for Video" autocomplete="off">-->
	<!--				</div>-->
	<!--				<div class="row g-3 gap-0 mb-3">-->
	<!--<div class="loading-area text-center d-flex justify-content-center align-items-center col-12" style="min-height: 200px">-->
	<!--	Loading...-->
	<!--</div>-->
	<!--				<div class="col-lg-4 col-md-6 col-12" ng-repeat="video in avatarList.avatarListingMade |orderBy:columName:reverse | filter:searchQuery " ng-click="selectVideo(video)">-->
	<!-- <div class="avatar-wrapper avatar-wrapper-style-1" ng-class="{'active-video': selectedVideo && selectedVideo.id === video.id}">
<!--						<div class="avatar-wrapper-inner">-->
	<!--							<div class="avatar-img" style="overflow: visible;">-->

	<!--								<img src="{{video.thumbnail}}" alt="Image" style="border-radius: inherit;">-->
	<!--							</div>-->
	<!--							<div class="d-flex justify-content-between">-->
	<!--								<p class="mb-0">{{video.publishedAt|date:'medium'|limitTo:12}}</p>-->
	<!--								<p class="mb-0">{{video.title}}</p>-->
	<!--								<a class="text-white video" ng-href="https://www.youtube.com/watch?v={{video.id}}" target="_blank"><i class="fa-solid fa-circle-play"></i></a>-->
	<!--							</div>-->
	<!--						</div>-->
	<!--					</div>	 -->
	<!--					<div class="d-block video-box" ng-class="{'active-video': selectedVideo && selectedVideo.id === video.id}">-->
	<!--						<div class="media-box">-->
	<!--							<img ng-src="{{video.thumbnail}}" class="img-fluid mx-auto d-block" alt="Social Img" ng-click="uploadinstagram(video.title,video.url)">-->
	<!--						</div>-->
	<!--						<div class="video-title">-->
	<!--							<h6 class="title">{{video.title}}</h6>-->
	<!--						</div>-->
	<!--					</div>-->
	<!--				</div>-->
	<!--				<div class="col-md-4 d-none col-12" ng-repeat="video in avatarList.avatarListingMade | orderBy:columName:reverse | filter:searchQuery" ng-click="toggleVideoSelection(video.id)">-->
	<!-- <div class="avatar-wrapper avatar-wrapper-style-1" ng-class="{'active-video': isSelected(video)}">
<!--						<div class="avatar-wrapper-inner">-->
	<!--							<div class="avatar-img" style="overflow: visible;">-->
	<!--								<img ng-src="{{video.thumbnail}}" alt="Image" style="border-radius: inherit;">-->
	<!--							</div>-->
	<!--							<div class="d-flex justify-content-between">-->
	<!--								<p class="mb-0">{{video.publishedAt | date:'medium' | limitTo:12}}</p>-->
	<!--								<p class="mb-0">{{avatar.name}}</p>-->
	<!--								<a class="text-white video" -->
	<!--								ng-href="https://www.youtube.com/watch?v={{video.id}}" -->
	<!--								target="_blank">-->
	<!--								<i class="fa-solid fa-circle-play"></i>-->
	<!--								</a>-->
	<!--							</div>-->
	<!--						</div>-->
	<!--					</div> -->
	<!--					<div class="d-block video-box" ng-class="{'active-video': isSelected(video)}">-->
	<!--						<input type="checkbox" class="form-check-input" name="video" ng-checked="isSelected(video)">-->
	<!--						<div class="media-box">-->
	<!--							<img ng-src="{{video.thumbnail}}" class="img-fluid mx-auto d-block" alt="Social Img">-->
	<!--						</div>-->
	<!--						<div class="video-title">-->
	<!--							<h6 class="title">{{video.title}}</h6>-->
	<!--						</div>-->
	<!--					</div>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--<div class="modal-footer border-0 justify-content-center pb-0">-->
	<!--	<div class="col-xs-12">-->
	<!--		<div class="row justify-content-center" ng-cloak ng-show="all_videos.length>0">-->
	<!--			<div class="col-12 d-flex align-items-center">-->
	<!--				Page &nbsp;-->
	<!--				<input value="{{pageNo}}" type="text" class="form-control" style="height: 30px;width: 45px;" readonly> &nbsp;&nbsp; Of {{totalpages}}&nbsp;&nbsp;&nbsp;-->
	<!--				<button type="button" class="btn "  ng-click="get_next_prev_videos(prevPageToken,'prev')" ng-disabled="!prevPageToken"><i class="fa fa-angle-double-left"></i></button>-->
	<!--				<button type="button" class="btn "  ng-click="get_next_prev_videos(nextPageToken,'next')" ng-disabled="!nextPageToken"><i class="fa fa-angle-double-right"></i></button>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->



	<!--</div>-->

	<!-- Video Details Model -->
	<div class="modal fade" id="videoDetailsModal" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Video Details</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">

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
				</div>
			</div>
		</div>
	</div>
	<!-- Video Details Model -->





	<!------ Page Content End --------->
	<!-- Welcome Popup -->
	<script>
		$(document).ready(function() {

			// When file is selected
			$('#videoUpload').on('change', function() {
				const file = this.files[0];
				if (file) {
					$('.file-name').text(file.name);
					$('.upload-default').hide();
					$('.upload-preview').fadeIn();
				}
			});

			// When cancel button is clicked
			$('.cancel-btn').on('click', function(e) {
				e.stopPropagation(); // prevent reopening file dialog
				$('#videoUpload').val(''); // clear file
				$('.file-name').text('');
				$('.upload-preview').hide();
				$('.upload-default').fadeIn();
			});

		});
	</script>


	<script>
		$(document).ready(function() {
			function encrypt_video_id($video_id) {
				return urlencode(base64_encode($video_id));
			}
			// var table = $('#data-table').DataTable({
			//     "text":  'Export',
			//     dom:
			//       "<'row'<'col-sm-3'l><'col-sm-4'><'col-sm-5'Bf>>" +
			//         "<'row'<'col-sm-12 table-responsive 'tr>>" +
			//         "<'row'<'col-sm-4'i><'col-sm-8'p>>",
			//       buttons: [
			//                 {
			//                     extend: 'excelHtml5',
			//                     title: 'Leads',
			//                     text: 'Export.csv'
			//                 },
			//             ],
			//     'lengthMenu': [[10, 25, 50, -1], [10, 25, 50,'100']],
			// });
			/* function updateCheckBox(updatedCount) {
            let container = $('.for-showing-selection');
            if (container.length === 0) {
                container = $(`
                    <div class="d-flex gap-2 align-items-center for-showing-selection">
                        <p class="mb-0"><span class="selected-count">${updatedCount}</span> Selected</p>
                    </div>
                `);
                $('.inserting-selected-checkbox').before(container);
            } else {
                container.find('.selected-count').text(updatedCount);
            }
        } */
			function updateInactiveIconOpacity() {
				const anyChecked = $('.inserting-selected-checkbox input[type="checkbox"]:checked').not('#checkCustomColor_all').length > 0;
				const allChecked = $('#checkCustomColor_all').is(':checked');

				if (anyChecked || allChecked) {
					$('#inactiveicon').css('opacity', '1');
				} else {
					$('#inactiveicon').css('opacity', '0');
				}
			}

			$(document).on('change', '.inserting-selected-checkbox input[type="checkbox"]', function() {
				updateInactiveIconOpacity();
			});


		});

		var app = angular.module('MyApp', []);

		app.controller('MyCtrl', function($scope, $http, $timeout, $parse, $sce) {
			$scope.columName_model = 'publishedAt';
			$scope.limit = '8';
			$scope.pageNo = 1;
			$scope.totalpages = 0;
			$scope.commentCount = $scope.commentCount || 0;
			$scope.likeCount = $scope.likeCount || 0;
			$scope.thumbnail = $scope.thumbnail || '';
			$scope.viewCount = $scope.viewCount || 0;
			$scope.comments = {};
			$scope.is_draft = false;
			$scope.video_title = '';
			$scope.youtube_video_url = '';

			<?php if ($key != "stats" && !empty($key)) { ?>
				$scope.playlist_id = "<?php echo $key; ?>";
			<?php } else { ?>
				$scope.playlist_id = 'all';
			<?php } ?>

            $scope.getTrustedUrl = function(url) {
                return $sce.trustAsResourceUrl(url);
            };
            
            
            $scope.formatDate = function(ts) {
                if (!ts) return 'N/A';
                return new Date(parseInt(ts) * 1000);
            };

			$scope.encodeVideoId = function(videoId) {
				try {
					return btoa(videoId); // Base64 encode
				} catch (e) {
					console.error('Encoding failed', e);
					return videoId;
				}
			};

			set_default_variables();
			// 		get_instagram_videos();

			$scope.getFilterData = function() {
				$scope.pageNo = 1;
				set_default_variables();
				// 			get_instagram_videos();
			}

			function set_default_variables() {
				$scope.pageToken = '';
				$scope.is_show_data = 0;
				$scope.searchKey = '';
				$scope.columName = 'publishedAt';
				$scope.sortOrder = true;
				$scope.draw = 0;
				$scope.from_date = '';
				$scope.to_date = '';
				$scope.total_videos = 0;
				$scope.nextPageToken = "";
				$scope.prevPageToken = "";
				$scope.check_all_selected = false;
				$scope.all_videos = []; // API ka pura data
				$scope.display_videos = []; // Sirf modal me dikhane ke liye
				$scope.limit = 9;
			}


			/* Code By Sidharth Start */

			$scope.selectedEbooks = [];
			$scope.selectAll = false;

			// Toggle all checkboxes when clicking "Select All"
			$scope.toggleAll = function() {
				if ($scope.selectAll) {
					// Select all IDs
					$scope.selectedEbooks = $scope.all_videos.map(function(item) {
						return item.id;
					});
				} else {
					// Deselect all
					$scope.selectedEbooks = [];
				}
			};
			
		

			// Ensure "Select All" updates based on selection
			$scope.checkSelection = function(id) {
				let index = $scope.selectedEbooks.indexOf(id);

				if (index === -1) {
					// If not selected, add to the array
					$scope.selectedEbooks.push(id);
				} else {
					// If already selected, remove from the array
					$scope.selectedEbooks.splice(index, 1);
				}
				// Update "Select All" checkbox
				$scope.selectAll = ($scope.selectedEbooks.length === $scope.all_videos.length);
			};

			$scope.share_youtube_video = function(video) {
				$scope.video_title = video.title;
				$scope.youtube_video_url = "https://www.youtube.com/watch?v=" + video.id;
				$scope.youtube_thumb_url = video.thumbnail;

				$("#videoPublishedModal").modal('show');
			}

			$scope.copyToClipboard = function() {
				var copyText = document.getElementById("videoLink");
				copyText.select();
				copyText.setSelectionRange(0, 99999); // For mobile devices

				navigator.clipboard.writeText(copyText.value).then(function() {
					// alert("Copied to clipboard: " + copyText.value);
					flashNow({
						'success': {
							'message': "Link Copied Successfully!"
						}
					});
				}, function(err) {
					flashNow({
						'error': {
							'message': "CFailed to copy"
						}
					});
				});
			};

			$scope.delete_multiple = function(videoid = null) {

				console.log("Selected Ebooks:", $scope.selectedEbooks);
				var videoArr = videoid ? [].concat(videoid) : $scope.selectedEbooks;
				if (videoArr === 0) {
					flashNow({
						'error': {
							'message': 'Please select at least one eBook to delete.'
						}
					});
					return;
				}
				Swal.fire({
					title: 'Are you sure?',
					text: 'This action cannot be undone!',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes, delete Selected Ones!',
					cancelButtonText: 'Cancel'
				}).then((result) => {
					if (result.isConfirmed) {
						jsLoader(true);
						$http.post("<?= base_url('delete-insta-video') ?>", {
								videos_ids: videoArr,
							})
							.then(function(response) {
								jsLoader(false);
								if (response.data.success) {
									flashNow({
										'success': {
											'message': 'Deleted successfully'
										}
									});
									setTimeout(() => {
										location.reload();
									}, 1000);
								} else {
									flashNow({
										'error': {
											'message': 'Failed to delete!'
										}
									});
								}
							});
					}
				});
			};


			$scope.showVideoeDetails = function(currVideo) {

				$scope.videoTitle = currVideo.title != 0 ? currVideo.title : 'Empty';
				$scope.commentCount = currVideo.commentCount != 0 ? currVideo.commentCount : '0';
				$scope.likeCount = currVideo.likeCount != 0 ? currVideo.likeCount : '0';
				$scope.thumbnail = currVideo.thumbnail;
				$scope.viewCount = currVideo.viewCount != 0 ? currVideo.viewCount : '0';
				var videoId = currVideo.id;
				$('#videoDetailsModal').modal('show');

				$http.get("<?= base_url('youtube/getLastComments') ?>", {
					params: {
						videoId
					}
				}).then(function(response) {
					$scope.comments = response.data;
					console.log('comments : ', $scope.comments);
				});
			}


			/* Code By Sidharth End */





			//         $scope.get_instagram_videos = function () {
			//             var queryStr = "<?php echo base_url('get-insights') ?>";
			//             jsLoader(true);
			//             $http({
			//                 method: 'GET',
			//                 url: queryStr,
			//                 headers: {
			//                     'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
			//                 }
			//             }).then(function (response) {
			//             jsLoader(false);
			//                 console.log(response.data.data);

			//                 if (response.data.success == true) {

			//                     $scope.all_videos = response.data.data;
			//                     console.log($scope.all_videos);
			//                     $scope.limit = 9;
			//                     $scope.display_videos = $scope.all_videos.slice(0, $scope.limit);

			//                 } else {
			//                     console.log("Could not fetch data.");
			//                 }
			//             });
			//         };
			// 		$scope.get_instagram_videos();


			$scope.all_videos = [];
			$scope.next_cursor = null;

			$scope.get_instagram_videos = function(afterCursor = "") {

				let url = "<?php echo base_url('get-insights') ?>";

				if (afterCursor) {
					url += "?after=" + afterCursor;
				}

				jsLoader(true);

				$http.get(url).then(function(response) {
					// console.log(response.data)
					jsLoader(false);

					if (response.data.success) {
						// Add new items to the array
						$scope.all_videos = $scope.all_videos.concat(response.data.data);
						$scope.next_cursor = response.data.next;
					} else {
						$scope.next_cursor = response.data.next;
						console.log("No data Found");
					}
				});
			};

			// First call
			$scope.get_instagram_videos();

			$scope.loadMore = function() {
				if ($scope.next_cursor) {
					$scope.get_instagram_videos($scope.next_cursor);
				}
			};


			// 		$scope.loadMore = function () {
			//             $scope.limit += 9;
			//             $scope.display_videos = $scope.all_videos.slice(0, $scope.limit);
			//         };
			//         $scope.get_instagram_videos();


			$scope.geteditorvideoList = function() {
				var queryStr = "<?php echo base_url('get-editor-list') ?>";
				$http({
					method: 'POST',
					url: queryStr,
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
					}
				}).then(function(response) {
					if (response.data.status == true) {
						$scope.avatarList = response.data;
					} else {
						$scope.avatarList = response.data;
						// console.log($scope.avatarList);
					}
				});
			};
			$scope.geteditorvideoList();
			
			
			$scope.getschedulevideoList = function() {
				var queryStr = "<?php echo base_url('get-schedule-video') ?>";
				$http({
					method: 'POST',
					url: queryStr,
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
					}
				}).then(function(response) {
				    console.log(response.data)
					if (response.data.success == true) {
						$scope.schedule_videos = response.data.schedule_data;
					} else {
						$scope.schedule_videos = response.data.schedule_data;
						// console.log($scope.avatarList);
					}
				});
			};
			$scope.getschedulevideoList();

	        $scope.delete_schedule_video = function(videoid) {
            if (!videoid) {
                flashNow({
                    'error': {
                        'message': 'Something went Wrong!'
                    }
                });
                return;
            }
        
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    jsLoader(true);
        
                   $http({
		                method: 'POST',
		                url: "<?php echo base_url('delete-schedule-video') ?>",
		                data: $.param({
                                    video_id: videoid
                                }),
		                headers: {
		                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
		                }
                    }).then(function(response) {
                        jsLoader(false);
        
                        if (response.data.success) {
                            flashNow({
                                'success': {
                                    'message': 'Deleted successfully'
                                }
                            });
        
                           $scope.getschedulevideoList();
        
                        } else {
                            flashNow({
                                'error': {
                                    'message': 'Failed to delete!'
                                }
                            });
                        }
                    });
                }
            });
        };
        $scope.getschedulevideoList();

			$scope.uploadVideo = function() {
				var fileInput = document.getElementById('videoUpload');
				var file = fileInput.files[0];
				if (!file) {
					alert('Please select a video file.');
					return;
				}
				var formData = new FormData();
				formData.append('video', file);

				jsLoader(true);

				$http({
						method: 'POST',
						url: "<?php echo base_url('upload-reel-video'); ?>",
						data: formData,
						headers: {
							'Content-Type': undefined
						},
						transformRequest: angular.identity
					}).then(function(response) {
						console.log(response)
						jsLoader(false);

						if (response.data.success) {
							$scope.video_url = response.data.cdn_url;
							$scope.uploadinstagram(response.data.cdn_url);
						} else {
							alert("Upload failed!");
						}

					})
					.catch(function(err) {
						jsLoader(false);
						console.error(err);
						alert("Upload error!");
					});
			};

			$scope.uploadinstagram = function(video_url) {
				var form = document.createElement("form");
				form.method = "POST";
				form.action = "<?php echo base_url('upload-insta-video'); ?>";

				// var input1 = document.createElement("input");
				// input1.type = "hidden";
				// input1.name = "video-name";
				// input1.value = title;
				// form.appendChild(input1);

				var input2 = document.createElement("input");
				input2.type = "hidden";
				input2.name = "video-url";
				input2.value = video_url;
				form.appendChild(input2);

				document.body.appendChild(form);
				form.submit(); // ✅ redirect with POST
			}


			$scope.get_next_prev_videos = function(token, type) {
				set_default_variables();
				$scope.pageToken = token;
				$scope.pageNo = type == 'next' ? ($scope.pageNo + 1) : ($scope.pageNo - 1);
				get_instagram_videos();
			}

			$scope.toggleSelection = function() {
				angular.forEach($scope.all_videos, function(video) {
					video.selected = $scope.check_all_selected;
				});
			};

			$scope.uncheck = function() {
				$scope.total_check = 0;
				angular.forEach($scope.all_videos, function(video) {
					if (video.selected) {
						$scope.total_check++;
					}
				});

				if ($scope.limit == $scope.total_check) {
					$scope.check_all_selected = true;
				} else {
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
			$scope.columName = "publishedAt";
			var propertyName = "publishedAt";

			$scope.sortBy = function() {
				if ($scope.columName === propertyName) {
					$scope.reverse = true;
				} else {
					$scope.reverse = false;
					propertyName = $scope.columName;
				}
			}
		});

		function jsLoader(add) {
			if (add === undefined) {
				add = false;
			}
			$(".temp_js_loader").remove();

			if (add) {
				$("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $this->config->item('assetsPath'); ?>themes/default/img/loading-icon.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;"></div>');
			}
		}

		$(document).on("click", function(e) {
			target = e.target || e.srcElement;
			if ($(target).hasClass('text')) {
				angular.element("#customersCtrl").scope().sortBy();
			}
		});

		$(document).on('change', '#checkCustomColor_all', function() {
			$('input:checkbox').not(this).prop('checked', this.checked);
		});

		function openfileDialog(current_video) {
			// if(!angular.element("#customersCtrl").scope().pr_manage){
			// flashNow({'error' : {'message':"Error ! Permission Denied."}});
			// }else{
			video_id = $(current_video).attr('id');
			var frm_action_path = siteUrl + 'edit-video-thumb-json/' + video_id;
			$('#frm_edit_thumbnail').attr('action', frm_action_path);
			$("#input_thumbnail").click();
			//}
		}
	</script>