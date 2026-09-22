<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style>
	[ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
	  display: none !important;
	}
	p{
		font-size: 14px;
	}
	.badge{
		font-size: 12px;
		font-weight: 400;
	}
	
	
	
	.dropup .dropdown-toggle::after{
	    display: none;
	}
	
	.table-wrapper-style-2 {
        .table-responsive {
            padding: 0;
            outline: 0;
            min-height: 320px;
        }
        .table-design.table{
            border: 1px solid var(--theme-br);
        }
    }
	
	/* ========== Upload Box ========== */
    .upload-area {
        width: 100%;
        height: 100%;
        background: var(--theme-br);
        border: 1px dashed var(--bg-dark);
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
	<title><?php echo $this->config->item('productName') ?> | YouTube Publisher</title>
	<div class="container-fluid container-padding padding-bonus" id="libCtrl" >
		<div class="col-12" ng-if="all_videos.length < 1">
			<div class="create-first">
				<img class="img-fluid d-block mx-auto" style="height:200px;" src="<?php echo $this->config->item('assetsPath');?>images/multimedia.png">
				<p class="description">
					You Haven’t Uploaded Any Video on YouTube Yet
				</p>
				<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoDetailsModal" >Upload New Video</a>
				<!-- <a href="<?php echo base_url('video-editor-list'); ?>" class="btn btn-primary">Upload New Video</a> -->
			</div>
		</div>
		<div class="bonus-wrapper" ng-if="all_videos.length > 0">
			<div class="row align-items-center mb-3">
				<!-- <div class="col-sm-6">
					<div class="title-line">Youtube Publisher</div>
				</div>
				<div class="col-sm-6 text-end">
					<a href="javascript:void(0);" class="btn btn-primary">Upload New Video</a>
				</div> -->


			
			<div class="col-12">
				<div class="row align-items-center mb-3">
					<div class="col-12">
						<div class="feature-banner">
							<div class="row align-items-center justify-content-between g-0">
								<div class="col-auto feature-wrap">
									<h5 class="feature-title">YouTube Publisher</h5>
									<p class="feature-subtitle mb-0">
										Create and manage your youtube video here
									</p>
								</div>
								<div class="col-auto ms-auto">
									<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoDetailsModal" >Upload New Video</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="agents-army-card agents-army-card-style-2" style="background: url('<?php echo $this->config->item('assetsPath') ?>images/youtube-list-bnr.png') no-repeat right/cover;">
					<div class="d-flex flex-column align-items-start h-100">
						<div class="title">YouTube Publisher</div>
						<div class="description">
							Create and manage your youtube video here
						</div>
						<a href="javascript:void(0);" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#videoDetailsModal" >Upload New Video</a>
					</div>
				</div> -->
			</div>
			</div>
			<div class="row align-items-center mb-3 ">
				<div class="col-sm-6">
					<div class="d-flex align-items-center gap-3">
						<!-- <a href="javascript:void(0);" class="btn btn-outline btn-light filter-btn btn-no-style"><i class="fa-solid fa-sliders"></i> Filter</a> -->
						<!--<a href="javascript:void(0);" class="icon-btn icon-disabled" id="inactiveicon" ng-click="delete_multiple()"><i class="fa-solid fa-trash"></i></a>-->
					</div>
				</div>
				<div class="col-sm-6 text-end">
					<div class="w-50 ms-auto">
						<div class="search-bar right-icon">
							<div class="search-icon">
								<span class="icon-search"></span>
							</div>
							<input type="text" class="search form-control" placeholder="Search For YouTube Video" autocomplete="off" id="searchText" ng-model="searchQuery">
						</div>
					</div>
				</div>
			</div>
			<div class="row ">
				<div class="col-xs-12 padding0">
					<div class="table-wrapper table-wrapper-style-2">
						<div class="table-responsive">
							<table id="data-table" class="table table-borderless table-design inserting-selected-checkbox px-3">
								<thead class="field-design">
									<tr>
										<!-- <th style="width:5%">S.No.</th> -->
										<!--<th style="width:5%">
											<div class="form-check">
												<input class="form-check-input" type="checkbox"  id="checkCustomColor_all" ng-model="selectAll" ng-change="toggleAll()">
											</div>
										</th>-->
										<th class="text-start" style="width:20%">Video</th>
										<!-- <th>Date</th> -->
										<th>Status</th>
										<th>Views</th>
										<th>Comments</th>
										<th>Likes</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="field-design" >
									<tr ng-repeat="video in filteredVideos = (all_videos | orderBy:columName:reverse | filter:searchQuery)">
										<!-- <td style="width:5%">{{$index + 1}}</td> -->
										<!--<td style="width:5%">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="checkDefault"
												ng-checked="selectedEbooks.includes(video.id)"
												ng-click="checkSelection(video.id)">
											</div>
										</td>-->
										<td class="text-start" style="width:40%">
											<div class="d-flex gap-3 align-items-center" style="display:flex!important;">
												<img src="{{ video.thumbnail }}" alt="Video Image" class="img-fluid rounded" style=" width:150px; height: 90px; object-fit: cover">
												<div>
													<h5 class="video-title"> {{video.title}} </h5>
													<p class="video-desc">{{ video.description }}</p>
													<p ng-show="video.publishAt || video.publishedAt" >
														<i class="fa-solid fa-clock-rotate-left"></i> :
														{{ (video.publishAt || video.publishedAt) | date:'dd-MMMM-yyyy hh:mm a' }}
													</p>
												</div>
											</div>
										</td>
										<td>
											<span class="badge position-static text-white text-bg-danger" ng-if="video.publishAt">Scheduled</span>
											<span class="badge position-static text-white bg-success" ng-if="!video.publishAt && video.publishedAt && video.privacyStatus != 'private' ">Published</span>
											<span class="badge position-static text-white bg-warning" ng-if="!video.publishAt && video.privacyStatus == 'private'" >Draft</span>
											</td>
										<!-- <td>{{ video.publishedAt }}</td> -->
										<td>{{ video.viewCount }}</td>
										<td>{{ video.commentCount }}</td>
										<td>{{ video.likeCount }}</td>

										<td>
    										<div class="action-link">
    											<div class="dropdown dropdown-no-arrow d-inline-flex" ng-class="{'dropup': filteredVideos.length > 1 && ($last)}">
    												<a
    													href="#"
    													class="action-btn blue-btn-outline dropdown-toggle position-relative"
    													data-bs-toggle="dropdown"
    												>
    													<div
    														data-bs-toggle="tooltip"
    														data-bs-placement="top"
    														data-bs-custom-class="custom-tooltip"
    														data-bs-title="More"
    														class="position-absolute"
    														style="top: 0; left: 0; height: 100%; width: 100%;"
    													>
    													</div>
    													<i class="fa-solid fa-ellipsis-vertical"></i>
    												</a>
    												<ul class="dropdown-menu overflow-visible" >
    													<!--<li class="workspace-dropdown-parent">-->
    													<!--	<a ng-href="<?php echo base_url('upload-youtube-video') ?>?video_id={{ encodeVideoId(video.id) }}">-->
    													<!--	<i class="fa-solid fa-pen-to-square"></i>-->
    													<!--	Edit</a>-->
    													<!--</li>-->
														<li class="workspace-dropdown-parent">
															<a ng-href="<?php echo base_url('upload-youtube-video') ?>?video_id={{ encodeVideoId(video.id) }}">
																<i class="fa-solid fa-pen-to-square"></i>
																Edit
															</a>
														</li>
    													<li class="workspace-dropdown-parent">
    														<a class="dropdown-item d-flex align-items-center" >
    														<i class="fa-solid fa-gear"></i>
    															Automation
    															<i class="fa-solid fa-angle-right ms-auto"></i>
    														</a>
    														<ul class="workspace-dropdown dropdown-menu bg-dark">
    															<li>
    																<a href="<?php echo base_url('youtube-v2-update') ?>/{{video.id}}">Auto	Replys</a>
    															</li>
    															<li>
    																<a href="<?php echo base_url('youtube-v2-auto-comment') ?>">Auto Comments</a>
    															</li>
    														</ul>
    													</li>
    													<li><a href="#" class="dropdown-item" ng-click="share_youtube_video(video)"><i class="fa-solid fa-share-from-square"></i> Share</a></li>
    													<li><a href="#" class="dropdown-item" ng-click="delete_multiple(video.id)"><i class="fa-solid fa-trash-can"></i> Delete</a></li>
    												</ul>
    											</div>
    										</div>
										</td>
									</tr>
									<tr ng-if="filteredVideos.length === 0">
										<td colspan="7" style="text-align: center; font-size: 14px!important">No results found</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- Pagination Section -->
				<div class="col-xs-12">
					<div class="row" ng-cloak ng-show="all_videos.length>0">
						<div class="col-12 text-right p-0 px-3">
							Page &nbsp;
							<input class="form-control d-inline-block" value="{{pageNo}}" type="text" style="height: 30px;width: 45px;" readonly> &nbsp;&nbsp; Of {{totalpages}}&nbsp;&nbsp;&nbsp;
							<button type="button" class="btn "  ng-click="get_next_prev_videos(prevPageToken,'prev')" ng-disabled="!prevPageToken"><i class="fa fa-angle-double-left"></i></button>
							<button type="button" class="btn "  ng-click="get_next_prev_videos(nextPageToken,'next')" ng-disabled="!nextPageToken"><i class="fa fa-angle-double-right"></i></button>
						</div>
					</div>
				</div>
				<!-- Pagination Section -->
				<p class="text-center" ng-show="all_videos.length == 0">No Record Found.</p>

				</div>
			</div>
			
			
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
				<h6 class="modal-title" id="chooseVideoModalLabel">Choose Videos</h6>
				<button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="d-flex align-items-sm-center align-items-start flex-sm-row flex-column gap-2 mb-3">
					<ul class="nav nav-pills nav-pills-style-2 nav-pills-with-gradient gap-2" style="min-width: fit-content;" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-landscape-tab" data-bs-toggle="pill" data-bs-target="#pills-MyVideo" type="button" role="tab" aria-controls="pills-MyVideo" aria-selected="true">My Videos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-portrait-tab" data-bs-toggle="pill" data-bs-target="#pills-uploadOwn" type="button" role="tab" aria-controls="pills-uploadOwn" aria-selected="false">Upload Your Own</button>
                        </li>
                    </ul>
					<div class="search-bar right-icon mb-0 w-100">
						<div class="search-icon p-2 px-3">
							<span class="icon-search"></span>
						</div>
						<input type="text" class="search form-control bg-transparent" ng-model="searchQuery" placeholder="Search for Video" autocomplete="off">
					</div>
				</div>
				<div class="tab-content">
			        <div class="tab-pane fade show active" id="pills-MyVideo" role="tabpanel" aria-labelledby="pills-MyVideo-tab" tabindex="0">
			            <div style="
                            max-height: 300px;
                            overflow-y: auto;
                            overflow-x: hidden;
                            min-height: 300px;
                        ">
    			            <div class="row g-3 gap-0">
        			            <div class="col-lg-4 col-md-6 col-12" ng-repeat="video in avatarList.avatarListingMade |orderBy:columName:reverse | filter:searchQuery " ng-click="selectVideo(video)">
        			                <div class="d-block video-box" ng-class="{'active-video': selectedVideo && selectedVideo.id === video.id}">
                						<div class="media-box">
                							<img ng-src="{{video.thumbnail}}" class="img-fluid mx-auto d-block" alt="Social Img" ng-click="uploadyoutube(video.title,video.url)">
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
			            <div style="
                            max-height: 246px;
                            overflow-y: auto;
                            overflow-x: hidden;
                            min-height: 246px;
                            margin-bottom:10px;
                        ">
			                <div class="upload-area" style="min-height: 245px; justify-content:center; height: 100%;">
                                <div class="upload-default">
									<i class="fa-solid fa-upload mb-2" style="font-size: 55px;"></i>
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
						<div class="video-title">
							<h6 class="title">{{video.title}}</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



</div>

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


<!--Video File Upload-->

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
<!--Video File Upload-->

<!-- Welcome Popup -->

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

			$('#inactiveicon').toggleClass('icon-disabled', !(anyChecked || allChecked));
		}

		$(document).on('change', '.inserting-selected-checkbox input[type="checkbox"]', function () {
			updateInactiveIconOpacity();
		});


	 });

	var app = angular.module('MyApp', []);

	app.controller('MyCtrl', function($scope,$http,$timeout,$parse) {
		$scope.columName_model = 'publishedAt';
		$scope.limit = '8';
		$scope.pageNo = 1;
		$scope.totalpages = 0;
		$scope.commentCount =  $scope.commentCount || 0;
		$scope.likeCount =  $scope.likeCount || 0;
		$scope.thumbnail =  $scope.thumbnail || '';
		$scope.viewCount =  $scope.viewCount || 0;
		$scope.comments = {};
		$scope.is_draft = false;
		 $scope.video_title = '';
		 $scope.youtube_video_url = '';
		
		<?php if($key!="stats" && !empty($key)){ ?>
			$scope.playlist_id ="<?php echo $key;?>";
		<?php }else { ?>
			$scope.playlist_id = 'all';
		<?php } ?>


		$scope.encodeVideoId = function(videoId) {
			try {
				return btoa(videoId); // Base64 encode
			} catch (e) {
				console.error('Encoding failed', e);
				return videoId;
			}
		};

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

		$scope.selectedEbooks = [];
		$scope.selectAll = false;

			 // Toggle all checkboxes when clicking "Select All"
			 $scope.toggleAll = function () {
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
			$scope.checkSelection = function (id) {
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
			    $scope.youtube_video_url = "https://www.youtube.com/watch?v="+video.id;
			    $scope.youtube_thumb_url = video.thumbnail;
			   
			    $("#videoPublishedModal").modal('show');
			}
			
    		$scope.copyToClipboard = function () {
    			var copyText = document.getElementById("videoLink");
    			copyText.select();
    			copyText.setSelectionRange(0, 99999); // For mobile devices
    
    			navigator.clipboard.writeText(copyText.value).then(function () {
    					// alert("Copied to clipboard: " + copyText.value);
    				flashNow({'success': {'message': "Link Copied Successfully!"} });
    			}, function (err) {
    				flashNow({'error': {'message': "CFailed to copy"} });
    			});
    		};

			$scope.delete_multiple = function (videoid = null) {

                console.log("Selected Ebooks:", $scope.selectedEbooks);
				var videoArr =  videoid ? [].concat(videoid) : $scope.selectedEbooks;
                if (videoArr === 0) {
                    flashNow({ 'error': { 'message': 'Please select at least one eBook to delete.' } });
                    return;
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
						jsLoader(true);
                        $http.post("<?= base_url('delelte-youtube-video') ?>", {
							videos_ids: videoArr,
                        })
                        .then(function (response) {
							jsLoader(false);
                            if (response.data.success) {
                                flashNow({ 'success': { 'message': 'Deleted successfully' } });
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            } else {
                                flashNow({ 'error': { 'message': 'Failed to delete!' } });
                            }
                        });
                    }
                });
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


		/* Code By Sidharth End */



		function get_youtube_videos() {
			jsLoader(true);
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
				$scope.all_videos = response.data.data;
				$scope.sort_data=[];
				angular.forEach($scope.all_videos, function (index, reply) {
					$scope.sort_data.push({ index });
				});
				if(response.data.publishAt == null && response.data.privacyStatus == 'private'){
					$scope.is_draft = true;
				}
				// console.log($scope.sort_data);
				$scope.total_videos = response.data.recordsTotal;
				$scope.nextPageToken = response.data.nextPageToken;
				$scope.prevPageToken = response.data.prevPageToken;
				jsLoader(false);
				if($scope.all_videos == undefined){
					$scope.all_videos = [];
				}
				if($scope.all_videos.length==0){
					$scope.is_show_data=2;
				} else{
					$scope.totalpages=Math.ceil($scope.total_videos/$scope.limit);
					$scope.is_show_data=1;
				}
			});
		}
		
		
        $scope.geteditorvideoList = function () {
            var queryStr = "<?php echo base_url('get-editor-list')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    if (response.data.status == true) {
                        $scope.avatarList = response.data;
                        

                    } else {
                        $scope.avatarList = response.data;
                        // console.log($scope.avatarList);
                    }
                });
            };
            $scope.geteditorvideoList();
            
 
        
        	$scope.uploadyoutube = function(title, video_url) {
                var form = document.createElement("form");
                form.method = "POST";
                form.action = "<?php echo base_url('upload-youtube-video'); ?>";
            
                var input1 = document.createElement("input");
                input1.type = "hidden";
                input1.name = "video-name";
                input1.value = title;
                form.appendChild(input1);
            
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.name = "video-url";
                input2.value = video_url;
                form.appendChild(input2);
            
                document.body.appendChild(form);
                form.submit(); // ✅ redirect with POST
            }


		$scope.get_next_prev_videos = function(token,type){
			set_default_variables();
			$scope.pageToken = token;
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
        
            $http.post('<?= base_url("upload-own-video") ?>', formData, {
                transformRequest: angular.identity,
                headers: { 'Content-Type': undefined }
            }).then(function(response) {
                	jsLoader(false);
                if (response.data.status === 'success') {
                    flashNow({ 'success': { 'message': 'Upload successful!' } });
                    $scope.uploadedVideoUrl = response.data.video_url;
                    var videoTitle = file.name.replace(/\.[^/.]+$/, ""); 
                    $scope.uploadyoutube(videoTitle, response.data.video_url);
                } else {
                    flashNow({ 'error': { 'message': response.data.error || 'Upload failed!' } });
                }
            }, function(error) {
                console.error(error);
                flashNow({ 'error': { 'message': 'Error uploading video!' } });
            });
        };

        
        
		
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

	$(document).on('change','#checkCustomColor_all',function(){
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