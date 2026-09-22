<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (empty($video_url) && empty($_GET['video_id'])) {
    header("Refresh: 1; url=" . base_url('video-editor-list'));
    exit; // always recommended after header redirect
}

?>
<style>
	.event-none{
		pointer-events: none !important;
	}
	
	.pointerdisable{
		pointer-events: none !important;
		opacity: 0.5;
	}	
	[ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
	  display: none !important;
	}
	.ai-image .insert-layer{
		transition: 0.4s;
		background: rgba(0,0,0,0.7);
		opacity: 0;
		scale: 0.8;
		border-radius: 5px;
	}
	.ai-image:hover .insert-layer{
		opacity: 1;
		scale: 1;
	}
	.tube_star_wizard .nav-link{
		pointer-events: none !important;
	}
	
	.tube_star_wizard .nav-link.done{
		/* pointer-events: all !important; */
	}
	p{
		white-space: normal;
	}
    .avatar-wrapper{
        padding: 4px;
        border: 1px solid var(--theme-br);
        border-radius: 10px;
        transition: 0.4s;
    }
	button.btn.sw-btn-next.sw-btn.d-none {
		display: none !important;
	}

    .avatar-wrapper.active-video,
    .avatar-wrapper:hover{
        border-color: var(--primary-color);
        background: var(--primary-color);
    }
</style>

<div class="container-wrapper container-wrapper container-open">

<!-- Main Container Start -->
<div class="container-fluid container-padding" id="libCtrl" ng-app="MyApp" ng-controller="MyCtrl">
	<div class="row">
		<div class="col-12 d-none">
			<div class="agents-army-card ">
				<div class="title">Upload Your Video to YouTube</div>
				<div class="description">Fill in your video details and schedule publishing.</div>
			</div>
		</div>
		<!-- SmartWizard html Start -->
		<div class="tube_star_wizard" id="smartwizard">
		    <ul class="nav mb-lg-4 mb-3">
		        <li class="nav-item" ng-class="{'event-none': allSteps.includes('step-1')}" ng-click="saveStepData(currentStep)">
		          <a class="nav-link nav-step-1"> Details
					<div class="step-border"></div>	
				  </a>
		        </li>
		        <li class="nav-item" ng-class="{'event-none': allSteps.includes('step-2')}" ng-click="saveStepData(currentStep)">
		          <a class="nav-link nav-step-2"> Schedule
					<div class="step-border"></div>
				  </a>
		        </li>
		        <li class="nav-item" ng-class="{'event-none': allSteps.includes('step-3')}" ng-click="saveStepData(currentStep)">
		          <a class="nav-link nav-step-3"> Preview & Publish
					<div class="step-border"></div>
				  </a>
		        </li>
		    </ul>

		    <div class="tab-content">
		        <div id="step-1" class="tab-pane step-1" role="tabpanel" aria-labelledby="step-1">
		            <!-- Details -->
		        	<div class="row g-md-5">
						<div class="col-lg-8" style="border-right: 1px solid var(--theme-br3);">
							<div class="d-flex flex-column gap-4 w-100">
								<div class="form-group">
									<label class="form-label mb-2" for="input_title">Title 
										<span 
											data-bs-toggle="tooltip" 
											data-bs-placement="top" 
											data-bs-custom-class="custom-tooltip" 
											data-bs-title="Use a clear, engaging title to attract clicks and improve search visibility. "
											data-bs-original-title="Use a clear, engaging title to attract clicks and improve search visibility."
											title=""> 
											(Required) 
											<i class="fa-solid fa-circle-info"></i>
										</span>
									</label>
									<div class="position-relative">
										<input class="form-control" id="summernoteText" ng-model="title" name="input_title"  placeholder="Enter your video title">
										<button class="generate-button bottom-right" data-modal-for="summernoteText" data-bs-toggle="modal" data-bs-target="#aiModal" ng-click="generateModelText('AI Title Generator','Use AI to make YouTube titles that get more clicks.','Use Title','Generate Title')"><i class="fa-solid fa-wand-magic-sparkles"></i></button>
									</div>
									<small class="form-text f-14 text-left" ng-show="app_title.error">{{app_title.message}}</small>
								</div>
								<div class="form-group">
									<label class="form-label mb-2" for="input_description">Description 
										<span 
											data-bs-toggle="tooltip" 
											data-bs-placement="top" 
											data-bs-custom-class="custom-tooltip" 
											data-bs-title="Write a compelling summary to inform viewers and boost rankings."
											data-bs-original-title="Write a compelling summary to inform viewers and boost rankings."
											title=""> 
											(Required) 
											<i class="fa-solid fa-circle-info"></i>
										</span>
									</label>
									<div class="position-relative">
										<textarea class="form-control" id="summernoteDescription" ng-model="description" rows="6" name="input_description"  placeholder="Tell Viewers about your video"></textarea>
										<button class="generate-button bottom-right" data-modal-for="summernoteDescription" data-bs-toggle="modal" data-bs-target="#aiModal" ng-click="generateModelText('AI Description Generator','Boost your YouTube engagement with AI-optimized descriptions that ','Use Text','Generate Description')"><i class="fa-solid fa-wand-magic-sparkles"></i></button>
									</div>
									<small class="form-text f-14 text-left" ng-show="app_description.error">{{app_description.message}}</small>
								</div>
								<div class="form-group">
									<label class="form-label mb-2" for="input_tags">Tag 
										<span 
											data-bs-toggle="tooltip" 
											data-bs-placement="top" 
											data-bs-custom-class="custom-tooltip" 
											data-bs-title="Add keywords to help YouTube understand and categorize your video."
											data-bs-original-title="Add keywords to help YouTube understand and categorize your video."
											title=""> 
											<i class="fa-solid fa-circle-info"></i>
										</span>
									</label>
									<div class="position-relative">
										<textarea name="input_tags" placeholder="Enter Tags" class="form-control tags input_tags" ng-model="triggerkeyword" id="tags" ></textarea>
										<button class="generate-button bottom-right" data-modal-for="summernoteTags" data-bs-toggle="modal" data-bs-target="#aiModal" 
										ng-click="generateModelText('AI Hashtag Generator','Use AI to create hashtag and grow your audience.','Use Tags','Generate Tags')"><i class="fa-solid fa-wand-magic-sparkles"></i></button>
									</div>
                                </div>
								<div class="row align-items-end">	
									<div class="col-md-6">
										<div class="d-flex flex-column">
											<label class="form-label mb-2" for="input_tags">Thumbnail 
												<span
													data-bs-toggle="tooltip" 
													data-bs-placement="top" 
													data-bs-custom-class="custom-tooltip" 
													data-bs-title="Upload a custom image or generate one with AI to increase views."
													data-bs-original-title="Upload a custom image or generate one with AI to increase views."
													title=""> 
													<i class="fa-solid fa-circle-info"></i>
												</span>
											</label>
											<div class="form-group custom-file-upload custom-file-upload-style-2 upload_img_change flex-column text-center">
												<div class="left">
													<div class="image-box">
														<img ng-if="finalThumbnail" id="previewImage2" src="{{ finalThumbnail }}" alt="image">
														<img ng-if="!finalThumbnail" id="previewImage2" src="<?php echo $this->config->item('assetsPath');?>images/faFileUpload.png" alt="image">
													</div>
												</div>
												<div class="right">
													<h5 class="title">Drag & Drop Or <span class="border-bottom">Browse</span></h5>
													<p>Supports: JPEG, JPG</p>
													<span class="text-danger" style="font-size:11px;">Support file size less then 2 mb</span>
												</div>
												<input type="file" id="avatarImage" name="avatar" class="form-control" accept=".jpeg,.jpg">
												<input type="hidden" name="avatar"  />
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="thumbnail-wrapper" data-bs-toggle="modal" data-bs-target="#thumbnailModal">
											<div class="icon">
												<img class="img-fluid mx-auto d-block" src="<?php echo $this->config->item('assetsPath');?>images/ai-technology.svg">
											</div>
											<div class="thumbnail-content">
												<h5 class="title">Create Using AI</h5>
												<p class="desc">Just type your idea and let AI do the rest</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="video-preview-area">
								<div class="video-preview">
									<h6 class="form-label mb-2">Video Preview</h6>
									<div class="video-card">
										<video ng-show="!finalFrame" src="<?php echo !empty($video_url) ? $video_url : '' ?>" controls class="w-100 h-100 object-fit-cover"></video>
										<iframe ng-show="finalFrame" ng-src="{{finalFrame}}" frameborder="0" class="w-100 h-100 object-fit-cover"></iframe>
									</div>
									<div class="file-name" ng-show="!finalFrame">
										<span class="title">Filename</span>
										<span class="name">{{ filename }}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		        <div id="step-2" class="tab-pane step-2" role="tabpanel" aria-labelledby="step-2">
		            <!-- Schedule -->
		        	<div class="row justify-content-center">
						<div class="col-lg-9">
							<div class="schedule-area">
								<div class="accordion theme-accordion" id="accordionExample">
									<div class="accordion-item">
										<div class="accordion-header">
											<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Schedule 
												<span
													data-bs-toggle="tooltip" 
													data-bs-placement="top" 
													data-bs-custom-class="custom-tooltip" 
													data-bs-title="Set a date and time to automatically publish your video. It will remain private until then."
													data-bs-original-title="Set a date and time to automatically publish your video. It will remain private until then."
													title=""> 
													<i class="fa-solid fa-circle-info"></i>
												</span>
											</button>
										</div>
										<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												<div class="form-check mb-2">
													<input class="form-check-input" type="checkbox" ng-model="publishtype" value="" id="flexCheck1">
													<label class="form-check-label" for="flexCheck1">
														Publish your video on youtube instantly
													</label>
												</div>
												<!-- <p>Select a date to make your video public.</p> -->
												 <div ng-show="!videoId">
													 <div class="form-group w-50 mb-3">
														 <label class="form-label mb-2" for="schedule">Schedule as public</label>
														 <input class="form-control" ng-class="{'pointerdisable': publishtype}" type="datetime-local" ng-model="scheduletime" id="schedule" name="schedule">
													 </div>
													 <p>Video will be private before publishing</p>

												 </div>
											</div>
										</div>
									</div>
									<div class="accordion-item" ng-class="{'pointerdisable': !publishtype}">
										<div class="accordion-header">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												Visibility 
												<span
													data-bs-toggle="tooltip" 
													data-bs-placement="top" 
													data-bs-custom-class="custom-tooltip" 
													data-bs-title="Choose who can view your video: Public, Unlisted, or Private."
													data-bs-original-title="Choose who can view your video: Public, Unlisted, or Private."
													title=""> 
													<i class="fa-solid fa-circle-info"></i>
												</span>
											</button>
										</div>
										<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												<h6 class="title">Save or Publish</h6>
												<p class="mb-3">Make your video public, unlisted, or private</p>
												<div class="radio-option-wrapper">
													<div>
														<input type="radio" id="public" name="privacy" class="radio-input" ng-click="checkVisiblity('public')" ng-checked="privacy === 'public'">
														<label for="public" class="radio-label">
															<span class="radio-circle"></span>
															<div class="radio-label-inner">
																<div class="radio-title">Public</div>
																<div class="radio-desc">Everyone can watch your video</div>
															</div>
														</label>
													</div>

													<div>
														<input type="radio" id="unlisted" name="privacy" class="radio-input" ng-click="checkVisiblity('unlisted')" ng-checked="privacy === 'unlisted'">
														<label for="unlisted" class="radio-label">
															<span class="radio-circle"></span>
															<div class="radio-label-inner">
																<div class="radio-title">Unlisted</div>
																<div class="radio-desc">Anyone with the video link can watch your video</div>
															</div>
														</label>
													</div>

													<div>
														<input type="radio" id="private" name="privacy" class="radio-input" ng-click="checkVisiblity('private')"  ng-checked="privacy === 'private'">
														<label for="private" class="radio-label">
															<span class="radio-circle"></span>
															<div class="radio-label-inner">
																<div class="radio-title">Private</div>
																<div class="radio-desc">Only you and people you choose can watch your video</div>
															</div>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="d-flex align-items-center gap-2">
											<span class="text-nowrap">Video Category</span>
											<!-- <label class="switch switch-sm">
												<input type="checkbox" id="allow_comments" ng-model="allowcomment" value="0">
												<span class="slider round"></span>
											</label> -->
											<select
												data-live-search="true"
												ng-model="catDetails.cat"
												ng-options="category as category.name for category in categories track by category.id"
												class="form-control">
												<!--<option value="" disabled selected>Select Video Category</option>-->
												</select>
	
										</div>
									</div>
									
									<div class="d-flex col-md-3 align-items-center gap-2">
										<span>Allow Embedding</span>
										<label class="switch switch-sm">
											<input type="checkbox" id="allow_embedding" ng-model="allowembedding" value="0">
											<span class="slider round"></span>
										</label>
									</div>

									<div class="d-flex col-md-3 align-items-center gap-2">
										<!-- <span>Age Restriction</span> -->
										<span>Made For kids</span>
										<label class="switch switch-sm">
											<input type="checkbox" id="age_restriction" ng-model="agerestagerestriction" value="0">
											<span class="slider round"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		        <div id="step-3" class="tab-pane step-3" role="tabpanel" aria-labelledby="step-3">
		            <!-- Preview & Publish -->
		        	<div class="row justify-content-center">
						<div class="col-md-9">
							<h5 class="text-center mb-4">Final Review Before Publishing</h5>
							<div class="publish-video-area">
								<div class="card video-card">
									<div class="card-media">
										<img ng-if="finalThumbnail"  class="img-fluid mx-auto d-block" id="previewImage" src="{{ finalThumbnail }}" alt="image" style="height: 100%; object-fit: cover">
										<img ng-if="!finalThumbnail" class="img-fluid mx-auto d-block" id="previewImage" src="<?php echo $this->config->item('assetsPath');?>images/card-img.png" alt="image" style="height: 100%; object-fit: cover">
										<a href="javascript:void(0);" class="video-btn"><i class="fa-solid fa-play"></i></a>
									</div>
									<div class="card-body">
										<h5 class="card-title">{{ title }}</h5>
										<p class="card-text">
											{{ description }}
										</p>
										<div class="tags" ng-show="triggerkeyword">
											<a href="javascript:void(0);" class="tag-btn" ng-repeat="keyword in triggerkeyword track by $index">{{keyword}}</a>
										</div>
									</div>
								</div>
								<div class="video-info">
									<h6 class="title">Video Info Recap</h6>
									<div class="recap-box">
										<ul class="recap-box-list">
											<li>
												<div class="recap-teg">
													<div class="recap-icon">
														<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
															<g clip-path="url(#clip0_1361_1289)">
															<mask id="mask0_1361_1289" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
															<path d="M15.5 15.5V0.5H0.5V15.5H15.5Z" fill="white" stroke="white"/>
															</mask>
															<g mask="url(#mask0_1361_1289)">
															<path d="M12.3438 1.40625H1.71875C1.02841 1.40625 0.46875 1.96591 0.46875 2.65625V4.53125H13.5938V2.65625C13.5938 1.96591 13.0341 1.40625 12.3438 1.40625Z" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M3.09375 2.34375V0.46875" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M10.9688 2.34375V0.46875" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M8.34375 2.34375V0.46875" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M5.71875 2.34375V0.46875" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M8.03125 6.64062H8.8125" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M5.25 6.64062H6.03125" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M10.8125 6.64062H11.5937" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M2.46875 8.75H3.25" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M5.25 8.75H6.03125" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M8.03125 8.75H8.8125" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M2.46875 10.8594H3.25" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M5.25 10.8594H6.03125" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M15.5312 12.0938C15.5312 13.9922 13.9922 15.5312 12.0937 15.5312C10.1953 15.5312 8.65625 13.9922 8.65625 12.0938C8.65625 10.1953 10.1953 8.65625 12.0937 8.65625C13.9922 8.65625 15.5312 10.1953 15.5312 12.0938Z" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M12.0938 10.5313V12.0938H13.6562" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M13.5938 9.00003V4.53125H0.46875V12.0312C0.46875 12.549 0.8885 12.9688 1.40625 12.9688H8.76878" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
															</g>
															</g>
															<defs>
															<clipPath id="clip0_1361_1289">
															<rect width="16" height="16" fill="white"/>
															</clipPath>
															</defs>
														</svg>
													</div>
													<span>Schedule:</span>{{ publishtype ? 'Publish Instantly' : (scheduletime | date:'dd-MM-yyyy HH:mm') }} 
												</div>
											</li>
											<li>
												<div class="recap-teg">
													<div class="recap-icon">
														<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M8.00215 11.4148C4.11387 11.4148 4.11387 5.52344 8.00215 5.52344C11.8463 5.52344 12.0124 11.4148 8.00215 11.4148ZM8.00215 6.70171C5.64561 6.70171 5.64561 10.2365 8.00215 10.2365C10.3587 10.2365 10.3587 6.70171 8.00215 6.70171Z" fill="white"/>
															<path d="M8 13.7724C5.08438 13.7724 2.29247 12.2235 0.341257 9.52237C0.11944 9.21638 0 8.84811 0 8.47018C0 8.09224 0.11944 7.72397 0.341257 7.41798C2.29247 4.7168 5.08438 3.16797 8 3.16797C10.9156 3.16797 13.7075 4.7168 15.6587 7.41798C15.8806 7.72397 16 8.09224 16 8.47018C16 8.84811 15.8806 9.21638 15.6587 9.52237C13.7075 12.2235 10.9156 13.7724 8 13.7724ZM1.29389 8.8319C3.04833 11.258 5.42961 12.5941 8 12.5941C10.5704 12.5941 12.9517 11.258 14.7061 8.8319C14.7824 8.72662 14.8235 8.59991 14.8235 8.46988C14.8235 8.33985 14.7824 8.21314 14.7061 8.10786C12.9517 5.68239 10.5704 4.34624 8 4.34624C5.42961 4.34624 3.04833 5.68239 1.29389 8.10845C1.21757 8.21373 1.17647 8.34044 1.17647 8.47047C1.17647 8.6005 1.21757 8.72662 1.29389 8.8319Z" fill="white"/>
														</svg>
													</div>
													<span>Visibility:</span> {{ privacy }}
												</div>
											</li>
											<li>
												<div class="recap-teg">
													<div class="recap-icon">
														<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M12.5528 14.0021H9.60733C8.80599 14.0021 8.15625 13.3522 8.15625 12.5505V8.58566C8.15625 8.34734 8.35117 8.15234 8.58941 8.15234H12.5528C13.3541 8.15234 14.0039 8.80232 14.0039 9.60396V12.5505C14.0039 13.3522 13.3541 14.0021 12.5528 14.0021ZM9.02256 9.01898V12.5505C9.02256 12.8755 9.28246 13.1355 9.60733 13.1355H12.5528C12.8777 13.1355 13.1376 12.8755 13.1376 12.5505V9.60396C13.1376 9.27897 12.8777 9.01898 12.5528 9.01898H9.02256Z" fill="white"/>
															<path d="M5.39654 14.0022H2.45108C1.64974 14.0022 1 13.3522 1 12.5506V9.60399C1 8.80235 1.64974 8.15237 2.45108 8.15237H6.41446C6.6527 8.15237 6.84762 8.34737 6.84762 8.58569V12.5506C6.84762 13.3522 6.19788 14.0022 5.39654 14.0022ZM2.45108 9.01901C2.12621 9.01901 1.86631 9.279 1.86631 9.60399V12.5506C1.86631 12.8755 2.12621 13.1355 2.45108 13.1355H5.39654C5.72141 13.1355 5.9813 12.8755 5.9813 12.5506V9.01901H2.45108Z" fill="white"/>
															<path d="M12.5528 6.8498H8.58941C8.35117 6.8498 8.15625 6.65481 8.15625 6.41648V2.45162C8.15625 1.64998 8.80599 1 9.60733 1H12.5528C13.3541 1 14.0039 1.64998 14.0039 2.45162V5.39818C14.0039 6.19982 13.3541 6.8498 12.5528 6.8498ZM9.02256 5.98316H12.5528C12.8777 5.98316 13.1376 5.72317 13.1376 5.39818V2.45162C13.1376 2.12663 12.8777 1.86664 12.5528 1.86664H9.60733C9.28246 1.86664 9.02256 2.12663 9.02256 2.45162V5.98316Z" fill="white"/>
															<path d="M6.41446 6.8498H2.45108C1.64974 6.8498 1 6.19982 1 5.39818V2.45162C1 1.64998 1.64974 1 2.45108 1H5.39654C6.19788 1 6.84762 1.64998 6.84762 2.45162V6.41648C6.84762 6.65481 6.6527 6.8498 6.41446 6.8498ZM2.45108 1.86664C2.12621 1.86664 1.86631 2.12663 1.86631 2.45162V5.39818C1.86631 5.72317 2.12621 5.98316 2.45108 5.98316H5.9813V2.45162C5.9813 2.12663 5.72141 1.86664 5.39654 1.86664H2.45108Z" fill="white"/>
														</svg>
													</div>
													<span>Category:</span> {{ catDetails.cat.name }}
												</div>
											</li>
											<li>
												<div class="recap-teg">
													<div class="recap-icon">
														<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
															<g clip-path="url(#clip0_1361_1348)">
															<path d="M14.6693 9.4987H13.1693V6.4987H14.6693C14.9426 6.4987 15.1693 6.27203 15.1693 5.9987C15.1693 5.72536 14.9426 5.4987 14.6693 5.4987H13.1693V4.66536C13.1693 3.65203 12.3493 2.83203 11.3359 2.83203H10.5026V1.33203C10.5026 1.0587 10.2759 0.832031 10.0026 0.832031C9.72927 0.832031 9.5026 1.0587 9.5026 1.33203V2.83203H6.5026V1.33203C6.5026 1.0587 6.27594 0.832031 6.0026 0.832031C5.72927 0.832031 5.5026 1.0587 5.5026 1.33203V2.83203H4.66927C3.65594 2.83203 2.83594 3.65203 2.83594 4.66536V5.4987H1.33594C1.0626 5.4987 0.835938 5.72536 0.835938 5.9987C0.835938 6.27203 1.0626 6.4987 1.33594 6.4987H2.83594V9.4987H1.33594C1.0626 9.4987 0.835938 9.72536 0.835938 9.9987C0.835938 10.272 1.0626 10.4987 1.33594 10.4987H2.83594V11.332C2.83594 12.3454 3.65594 13.1654 4.66927 13.1654H5.5026V14.6654C5.5026 14.9387 5.72927 15.1654 6.0026 15.1654C6.27594 15.1654 6.5026 14.9387 6.5026 14.6654V13.1654H9.5026V14.6654C9.5026 14.9387 9.72927 15.1654 10.0026 15.1654C10.2759 15.1654 10.5026 14.9387 10.5026 14.6654V13.1654H11.3359C12.3493 13.1654 13.1693 12.3454 13.1693 11.332V10.4987H14.6693C14.9426 10.4987 15.1693 10.272 15.1693 9.9987C15.1693 9.72536 14.9426 9.4987 14.6693 9.4987ZM12.1693 11.332C12.1693 11.792 11.7959 12.1654 11.3359 12.1654H4.66927C4.20927 12.1654 3.83594 11.792 3.83594 11.332V4.66536C3.83594 4.20536 4.20927 3.83203 4.66927 3.83203H11.3359C11.7959 3.83203 12.1693 4.20536 12.1693 4.66536V11.332ZM7.2426 6.68536L5.92927 7.9987L7.2426 9.31203C7.43594 9.50536 7.43594 9.82536 7.2426 10.0187C7.1426 10.1187 7.01594 10.1654 6.88927 10.1654C6.7626 10.1654 6.63594 10.1187 6.53594 10.0187L4.86927 8.35203C4.67594 8.1587 4.67594 7.8387 4.86927 7.64536L6.53594 5.9787C6.72927 5.78536 7.04927 5.78536 7.2426 5.9787C7.43594 6.17203 7.43594 6.49203 7.2426 6.68536ZM11.1293 7.64536C11.3226 7.8387 11.3226 8.1587 11.1293 8.35203L9.4626 10.0187C9.3626 10.1187 9.23594 10.1654 9.10927 10.1654C8.9826 10.1654 8.85594 10.1187 8.75594 10.0187C8.5626 9.82536 8.5626 9.50536 8.75594 9.31203L10.0693 7.9987L8.75594 6.68536C8.5626 6.49203 8.5626 6.17203 8.75594 5.9787C8.94927 5.78536 9.26927 5.78536 9.4626 5.9787L11.1293 7.64536Z" fill="white"/>
															</g>
															<defs>
															<clipPath id="clip0_1361_1348">
															<rect width="16" height="16" fill="white"/>
															</clipPath>
															</defs>
															</svg>

													</div>
													<span>Embedding:</span> {{ allowembedding ? 'Allowed' : 'Not Allowed' }}
												</div>
											</li>
											<li>
												<div class="recap-teg">
													<div class="recap-icon">
														<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M12.737 3.26641C10.137 0.666406 5.87031 0.666406 3.27031 3.26641C0.670313 5.86641 0.670313 10.1331 3.27031 12.7331C5.87031 15.3331 10.0703 15.3331 12.6703 12.7331C15.337 10.1331 15.337 5.86641 12.737 3.26641ZM4.20365 4.19974C6.13698 2.26641 9.13698 2.13307 11.2703 3.73307L3.80365 11.2664C2.13698 9.19974 2.33698 6.13307 4.20365 4.19974ZM4.73698 12.1997L12.2036 4.73307C13.8036 6.79974 13.6703 9.86641 11.737 11.7997C9.80365 13.7331 6.80365 13.8664 4.73698 12.1997Z" fill="white"/>
														</svg>
													</div>
													<span>Made For Kids:</span> {{ agerestagerestriction ? 'Yes' : 'No' }} 
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="publish-check-box">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" ng-model="copyrightcontent" id="flexCheck2">
									<label class="form-check-label" for="flexCheck2">
										I agree my video does not contain any copyrighted content
									</label>
								</div>
							</div>
							<div class=" text-end form-check">
							</div>
						</div>
					</div>
				</div>
		    </div>
			<div class="pe-4 d-flex my-3 justify-content-end gap-2 align-items-center">
				<a href="javascript:void(0)" class="btn btn-primary " ng-click="previousSteps()" ng-show="currentStep !== 'step-1'">Previous</a>
				<a href="javascript:void(0)" class="btn btn-primary save-and-next save-next" ng-click="saveStepData(currentStep)"> Save & Next </a>
				<a class="btn btn-primary" ng-show="currentStep === 'step-3'" ng-class="{'pointerdisable': !copyrightcontent}" ng-click="insertVideoData()">Publish Video</a>
			</div>
		</div>
		<!-- SmartWizard html End -->
	</div>


<!-- AI Modal -->
<div class="modal fade ai-modal" id="aiModal" data-currentmodal="" tabindex="-1" aria-labelledby="aiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header p-3">
		<div class="d-flex flex-column">
			<h6 class="modal-title" id="aiModalLabel">{{  popupTitle }}</h6>
			<p class="mb-0">{{  popupDesc }}</p>	
		</div>
		<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<div class="prompt-box d-flex gap-3">
			<input class="form-control text-nowrap" placeholder="Describe your video or idea here to generate a title with AI..." id="aigentextInput" ng-model="inputText">
			<button class="btn btn-primary text-nowrap" ng-click="changeTextViaAi()">{{ genButtonText }}</button>
        </div>
        <div class="aiText mt-3 Modal-chat-container d-flex flex-column gap-4">
			<div class="aiTextModal-chat-item d-flex">
				<div class="aiTextModal-content w-100" style="padding: 10px;border: 1px solid var(--theme-br); border-radius: 5px; ">
					<div class="aiTextModal-chat-box text-editor mb15">
						<!--<span class="aiTextModal-badge badge badge-lg badge-light">-->
						<!--    Original Text-->
						<!--</span>-->
						<p class="mt-1">
							AI-generated title will appear here...
						</p>
					</div>
					<div class="aiTextModal-tool editor-option d-flex gap-2 justify-content-end">
						<button class="icon-btn icon-btn-outline icon-sm edit-icon">
							<i class="fa-solid fa-pen-to-square"></i>
						</button>

						<button class="icon-btn icons icon-btn-outline icon-sm edit-icon">
							<i class="fa-solid fa-clone" ng-click="copyEditortext()"></i>
						</button>
						<a href="#" class="btn btn-sm btn-primary use-text-btn" style="font-size: 12px!important;">{{ useButtonText }}</a>
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex flex-wrap gap-2 mt-3" style="width: 100%;">
			<button type="button" class="btn btn-sm btn btn-check-btn" ng-click="modifyText('rephrase')">Rephrase</button>
			<button type="button" class="btn btn-sm btn btn-check-btn" ng-click="modifyText('make_catchy')">Make Catchy</button>
			<button type="button" class="btn btn-sm btn btn-check-btn" ng-click="modifyText('make_shorter')">Make Shorter</button>
			<button type="button" class="btn btn-sm btn btn-check-btn" ng-click="modifyText('make_longer')">Make Longer</button>
		</div>
      </div>
    </div>
  </div>
</div>
<!-- AI Text Modal -->

<!-- Thumbnail Modal Structure -->
<div class="modal fade thumbnail-modal" id="thumbnailModal" tabindex="-1" aria-labelledby="thumbnailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
		<div class="modal-header align-items-start py-2">
			<div class="d-flex flex-column">
				<h6 class="modal-title" id="thumbnailModalLabel">AI Thumbnail Generator</h6>
				<p class="mb-0">Create scroll-stopping thumbnails with AI—just describe your video, and let AI do the rest.</p>
			</div>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<!-- Modal Body -->
		<div class="modal-body custom-modal-body" ng-class="{'preview-body': chat_history.length == 0}">
			<div class="describe-content d-none">
				<div class="media-bx">
					<i class="fa-solid fa-wand-magic-sparkles"></i>
				</div>
				<h5 class="desc mb-0">Describe & Generate Your Thumbnail</h5>
			</div>

			<div class="chat-wrapper" ng-repeat="chat in chat_history">
				<div class="user-msg">
					<div class="msg-bubble user-bubble">
						{{chat.human_text}}
					</div>
				</div>
				<div class="ai-msg">
					<p class="mb-2 text-white">Thumbnail Generated</p>
					<div class="position-relative ai-image">
						<div class="insert-layer position-absolute gap-2 top-0 left-0 w-100 h-100 d-flex align-items-center justify-content-center">
							<!-- <a href="" class="btn btn-sm btn-primary">Preview</a> -->
							<a href="" class="btn btn-sm btn-primary" ng-click="useThumbnail(chat.ai_response, chat.id)">Use Image</a>
						</div>
						<img ng-src="<?php echo $this->config->item('bucket_url'); ?>{{chat.ai_response}}" class="img-fluid rounded-3 shadow-sm" style="max-width: 250px;" alt="Generated Thumbnail">
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Footer -->
		<div class="modal-footer">
			<div class="input-group m-0 gap-3">
				<input type="hidden" ng-model="thumbnail_parent_id">
				<input type="text" class="form-control" id="usertext" ng-model="usertext" placeholder="Describe Thumbnail Idea Here. (e.g., “Fitness workout tips for beginners”)" aria-label="Describe Your Thumbnail" aria-describedby="button-addon">
				<button class="btn btn-primary" type="button" id="button-addon" ng-click="generateThumbnail(thumbnail_parent_id)">Generate</button>
			</div>
		</div>
    </div>
  </div>
</div>

<!-- Publish Modal -->
<div class="modal fade" id="publishModal" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="publishModalLabel">Confirm Publish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to publish?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Yes, Publish</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade video-published-modal" id="videoPublishedModal" tabindex="-1" aria-labelledby="videoPublishedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Video Published</h5>
                    <button type="button" ng-click="cancel_popup_share()" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="video-card d-flex align-items-center gap-3 mb-3">
                        <div class="video-thumb">
                            <img ng-src="{{ youtube_thumb_url }}" class="img-fluid mx-auto d-block" alt="Thumb Img">
                        </div>
                        <div>
                            <h6 class="video-title mb-1 fw-semibold">{{ title }}</h6>
                            <p class="video-date mb-0">{{ publishtype ? 'Publish Instantly' : (scheduletime | date:'dd-MM-yyyy HH:mm') }}</p>
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




<!------ Page Content End --------->
<!-- Welcome Popup -->

<script>

	let changesMade = true; // Assume changes are made; set to false after saving if needed

		window.addEventListener("beforeunload", function (e) {
		if (changesMade) {
			e.preventDefault();
			e.returnValue = "If you reload the page, changes will not be saved.";
			
		}
	});
	

	let currentModel;
	$('.generate-button').on('click', function() {
		var currentFor = $(this).data('modal-for');
		$('#aiModal').addClass(currentFor);
		$('#aiModal').data('currentmodal',currentFor);
		currentModel = $('#aiModal').data('currentmodal');
	});

	

	var app = angular.module('MyApp', []);

	app.controller('MyCtrl', function($scope,$http,$timeout,$parse,$sce) {
		$scope.totalpages = 0;
		$scope.thumbnail =  $scope.thumbnail || '';
		$scope.chat_history = [];
		$scope.thumbnail_parent_id = null;
		$scope.finalThumbnail = $("#previewImage").attr("src");
		$scope.triggerkeywordData = ``;
		$scope.triggerkeyword = $scope.triggerkeywordData.split(',').map(s => s.trim().toLowerCase()) || [''];
		$scope.videourl = `<?php echo !empty($video_url) ? $video_url : '' ?>`;
		$scope.filename = `<?php echo !empty($video_name) ? $video_name : 'select video' ?>`;
		$scope.privacy = "public";
		$scope.checkVisiblity =  function(visiblity){
			$scope.privacy = visiblity;
		}
		$scope.currentStep =  'step-1';
	    $scope.allSteps = 	['step-1'];
		$scope.videotitle = $('#summernoteText').summernote('code');
		$scope.videoDescription = $('#summernoteDescription').summernote('code');
		$scope.app_title={error:false, message:'', value:''};
		$scope.app_description={error:false, message:'', value:''};
		$scope.categories =[
				{ id: 1, name: 'Film & Animation' },
				{ id: 2, name: 'Autos & Vehicles' },
				{ id: 10, name: 'Music' },
				{ id: 15, name: 'Pets & Animals' },
				{ id: 17, name: 'Sports' },
				{ id: 18, name: 'Short Movies' },
				{ id: 19, name: 'Travel & Events' },
				{ id: 20, name: 'Gaming' },
				{ id: 21, name: 'Videoblogging' },
				{ id: 22, name: 'People & Blogs' },
				{ id: 23, name: 'Comedy' },
				{ id: 24, name: 'Entertainment' },
				{ id: 25, name: 'News & Politics' },
				{ id: 26, name: 'Howto & Style' },
				{ id: 27, name: 'Education' },
				{ id: 28, name: 'Science & Technology' },
				{ id: 29, name: 'Nonprofits & Activism' }
				]
			$scope.catDetails = {
				cat: $scope.categories.find(c => c.id === 22) || null
			};
		/* $scope.initCategory = function(id) {
			var defaultCatId = id || 22;
			$scope.catDetails = {
				cat: $scope.categories.find(c => c.id === defaultCatId)
			};
			
			// Delay to allow Angular to render before refreshing the picker
			setTimeout(function() {
				$('.selectpicker').selectpicker('refresh');
			}, 100);
			};

			$scope.refreshSelectPicker = function() {
			setTimeout(function() {
				$('.selectpicker').selectpicker('refresh');
			}, 0);
		}; */
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

			// Set placeholder after tagsInput has initialized
			 
		});
        
        $scope.cancel_popup_share = function() {
            window.location.href = "<?php echo base_url('youtube-publisher');?>";
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

		$scope.generateModelText = function(title,description,usebutton,genbutton){
			$scope.popupTitle = title; 
			$scope.popupDesc = description;
			$scope.useButtonText = usebutton;
			$scope.genButtonText = genbutton;

			$('#aiModal .aiTextModal-chat-box p').text(title);

		}

		
		if($scope.currentStep == 'step-1'){
			$('.wizard-prev-btn').hide();
		}else{
			$('.wizard-prev-btn').show();
		}
		$scope.saveStepData = function (currstep) {
			$scope.title = $('<div>').html($('#summernoteText').summernote('code')).text().trim();
			$scope.description = $('<div>').html($('#summernoteDescription').summernote('code')).text().trim();

			let hasError = false;

			if (currstep === 'step-1') {
				if (!$scope.title) {
					$scope.app_title = { error: true, message: 'Title required' };
					hasError = true;
				}
				if (!$scope.description) {
					$scope.app_description = { error: true, message: 'Description required' };
					hasError = true;
				}

				if(!$scope.videourl && !$scope.finalFrame){
					flashNow({
						'error': {
							'message': "Please Select The Video First."
						}
					});
					hasError =  true;
				}
				if(typeof $scope.triggerkeyword === 'string' &&  $scope.triggerkeyword){
					$scope.triggerkeyword = $scope.triggerkeyword.split(",")
				}

				if (hasError) return;
				$scope.currentStep = 'step-2';
				$scope.allSteps.push('step-2');

			} else if (currstep === 'step-2') {
				if(!$scope.publishtype && !$scope.scheduletime){
					flashNow({
						'error': {
							'message': "Please Select Publish Type : Instant Publish Or Schedule Publish"
						}
					});
					hasError =  true;
				}

				if (hasError) return;
				$scope.currentStep = 'step-3';
				$scope.allSteps.push('step-3');

			}

			updateStepView();
		};

		$scope.previousSteps = function () {
			$scope.allSteps.pop();
			if ($scope.currentStep === 'step-3') {
				$scope.currentStep = 'step-2';
			} else if ($scope.currentStep === 'step-2') {
				$scope.currentStep = 'step-1';
			}
			updateStepView();
		};

		// Shared function to update UI
		function updateStepView() {
			const steps = ['step-1', 'step-2', 'step-3'];

			// Toggle tab content visibility
			steps.forEach(step => {
				$('#' + step).toggleClass('d-block', $scope.currentStep === step).toggleClass('d-none', $scope.currentStep !== step);
			});

			// Update nav steps
			steps.forEach((step, index) => {
				const nav = $('.nav-' + step);
				nav.removeClass('active done');
				if (step === $scope.currentStep) {
					nav.addClass('active');
				} else if (index < steps.indexOf($scope.currentStep)) {
					nav.addClass('done');
				}
			});

			// Toggle buttons
			$('.save-and-next').toggle($scope.currentStep !== 'step-3');
			$('.wizard-prev-btn').toggle($scope.currentStep !== 'step-1');
		}


		$scope.videoId = "<?php echo base64_decode(urldecode($_GET['video_id'])) ?>";
		$scope.getVideoDetails = function() {

			var postData = $.param({
				videoId: $scope.videoId,
			});
			jsLoader(true);
			$http({
				method: 'POST',
				url: '<?php echo base_url('youtube/getVideoDetails')?>',
				data: postData,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
			}).then(function(response) {
				jsLoader(false);
				console.log(response.data);
				$timeout(function() {
				// DOM manipulations (OK outside timeout)
				$('#summernoteText').summernote('code', response.data.video_title);
				$('#summernoteDescription').summernote('code', response.data.video_description);
				if(response.data.video_tags){
					response.data.video_tags.forEach(function(tag) {
						if (tag) {
							$('#tags').addTag(tag);
						}
					});
				}

				$scope.finalThumbnail = response.data.thumbnail.high.url;
				$scope.finalFrame = $sce.trustAsResourceUrl(response.data.video_url);
				// All scope changes inside $timeout
				$scope.publishtype = response.data.publishAt == null;
				$scope.privacy = response.data.privacyStatus;
				$scope.scheduletime = response.data.publishAt ? new Date(response.data.publishAt) : null;
				$scope.allowembedding =  response.data.embeddable;
				$scope.agerestagerestriction =  response.data.madeForKids;
				// $scope.catId = response.data.categoryId;
				const categoryId = response.data.categoryId;

				// Make sure the value from the API is a number (or compare correctly if it's a string)
				$scope.catDetails.cat = $scope.categories.find(function(category) {
					return category.id == categoryId;
				}) || null;
				setTimeout(() => {
					$('select').selectpicker('refresh');
				}, 1000);
				
				});
			}).catch(function(error) {
				jsLoader(false);
			});
		}
		if($scope.videoId){
			$scope.getVideoDetails();
		}
		$scope.modifyText = function(action) {
			let currentText = $(".aiTextModal-chat-box p").text().trim();
			var workFor =  $('#aiModal').data('currentmodal');
			var postData = $.param({
				text: currentText,
				workFor: workFor,
				action: action,
			});
			jsLoader(true);
			$http({
				method: 'POST',
				url: '<?php echo base_url('editor-action')?>',
				data: postData,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
			}).then(function(response) {

				if (response.data && response.data.modified_text) {
						let modifiedText = response.data.modified_text.trim().replace(/<\/?(p|div)>/g, '');
						$(".aiTextModal-chat-box p").text(modifiedText);
					}
				jsLoader(false);
			}).catch(function(error) {

				jsLoader(false);
			});

		}

		$scope.changeTextViaAi = function() {
			var inputText = $scope.inputText;
			var workFor =  $('#aiModal').data('currentmodal');
			
			let currentText = $(".aiTextModal-chat-box p").text().trim();

			if (!inputText || inputText.trim() === "") {
				flashNow({
					'error': {
						'message': "Please enter prompt first."
					}
				});
				return;
			}
			var postData = $.param({
				inputText: inputText,
				currentText: currentText,
				workFor: workFor
			});
			jsLoader(true);
			$http({
				method: 'POST',
				url: '<?php echo base_url('make-better-prompt')?>',
				data: postData,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
			}).then(function(response) {
                    if (response.data && response.data.modified_text) {
                        let modifiedText = response.data.modified_text
                            .replace(/^Improved Text:\s*/i, '') // remove "Improved Text:" if present
                            .replace(/^[\"'\[{(]+|[\"'\]})]+$/g, '') // remove leading/trailing quotes/brackets/braces
                            .replace(/<[^>]*>/g, '') // remove all HTML tags
                            .trim();
                    
                        $(".aiTextModal-chat-box p").text(modifiedText);
                    }
				$('#aigentextInput').val('');
				jsLoader(false);
			}).catch(function(error) {

				jsLoader(false);
			});
		};

		$scope.copyEditortext = function() {
			let currentText = $(".aiTextModal-chat-box p").text().trim();
			navigator.clipboard.writeText(currentText).then(function() {
				flashNow({
					'success': {
						'message': "Content copied successfully!"
					}
				});
			}).catch(function(err) {
				console.error('Failed to Copy Content: ', err);
			});
		}

		/* For Chat Thumbnail */

		$scope.generateThumbnail =  function(parent_id){
			let currentText = $scope.usertext;
			var postData = $.param({
				usertext: currentText,
				parent_id: parent_id,
			});

			jsLoader(true);
			$http({
				method: 'POST',
				url: '<?php echo base_url('insert-chating')?>',
				data: postData,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
			}).then(function(response) {
			    console.log(response.data);
				$scope.chat_history = response.data.chat_history;
				$scope.thumbnail_parent_id = response.data.chat_history.length > 0 ? response.data.chat_history[0].id : null;
				$('#usertext').val('');
				if (response.data && response.data.modified_text) {
					let modifiedText = response.data.modified_text.trim().replace(/<\/?(p|div)>/g, '');
					$(".aiTextModal-chat-box p").text(modifiedText);
					
				}
				jsLoader(false);
			}).catch(function(error) {

				jsLoader(false);
			});
		}

		$scope.getThumbnailResponse =  function(parent_id){
			let currentText = $scope.usertext;
			var postData = $.param({
				parent_id: parent_id,
			});

			jsLoader(true);
			$http({
				method: 'POST',
				url: '<?php echo base_url('get-chat')?>',
				data: postData,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
			}).then(function(response) {
				$scope.chat_history = response.data.chat_history;
				$scope.thumbnail_parent_id = response.data.chat_history.length > 0 ? response.data.chat_history[0].id : null;
				
				jsLoader(false);
			}).catch(function(error) {

				jsLoader(false);
			});
		}
		//$scope.getThumbnailResponse();


		$scope.useThumbnail = function(imageUrl, thumbnailId){
			$scope.finalThumbnail = `<?php echo $this->config->item('bucket_url') ?>${imageUrl}`;
			$scope.thumbnailId = thumbnailId;
			$("#previewImage").attr("src", $scope.finalThumbnail);
			$("#previewImage2").attr("src", $scope.finalThumbnail);
			$('#thumbnailModal').modal('hide');
		}


		$scope.insertVideoData = function() {
			$scope.videocat = $scope.catDetails.cat.id;
			
			var videotitle = $('#summernoteText').summernote('code');
			var videoDescription = $('#summernoteDescription').summernote('code');
			var update_id = $scope.videoId;
			var finalThumbnail = $("#previewImage").attr("src");
			let formData = new FormData();
			const fileInput = document.getElementById('avatarImage');
			const file = fileInput?.files[0];

			if ($scope.thumbnailId) {
				formData.append('thumbnail', finalThumbnail);
			} else if(file != undefined ){
					const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2); // size in MB
					if(fileSizeMB > 1.8){
						flashNow({ 'error': { 'message': "Thumbnail Should Be Less Then 2 Mb" } });
						jsLoader(false);
						return;
					}
					formData.append('thumbnail', file);
			}else{
				formData.append('thumbnail', finalThumbnail);
			}

			const date = new Date($scope.scheduletime);
			const  youtubeScheduleTime =  $scope.scheduletime ? date.toISOString() : '';
			
			

			// Append all other fields
			formData.append('update_id', update_id || "");
			formData.append('title', videotitle || "");
			formData.append('description', videoDescription || "");
			formData.append('tags', $scope.triggerkeyword || "");
			formData.append('thumbnail_id', $scope.thumbnailId || "");
			formData.append('video_url', $scope.videourl || "");
			formData.append('schedule_date_time', youtubeScheduleTime || "");
			formData.append('publish_type', $scope.publishtype || false);
			formData.append('visiblity', $scope.privacy || "");
			formData.append('video_cat', $scope.videocat || 22);
			formData.append('allow_embeding', $scope.allowembedding || false);
			formData.append('age_restriction', $scope.agerestagerestriction || false);
			formData.append('copyright_content', $scope.copyrightcontent || false);

			jsLoader(true);
			if (!$scope.videourl && !$scope.videoId) {
				flashNow({ 'error': { 'message': "Error! No Video Found. Choose The Video First." } });
				jsLoader(false);
				return;
			}
			$http.post(`<?php echo base_url('insert-youtube-video')?>`, formData, {
				transformRequest: angular.identity,
				headers: { 'Content-Type': undefined } // Let browser set the multipart/form-data boundary
			}).then(function(response) {
				jsLoader(false);
				console.log(response);
				if (response.data.status == true) {
					$('#videoPublishedModal').modal('show');
					$scope.youtube_video_url = response.data.video_url;
					$scope.youtube_thumb_url = siteUrl + 'app/' + response.data.thumbnail_path;
					flashNow({ 'success': { 'message': response.data.message } });
				} else {
					// $('#videoPublishedModal').modal('show');
					flashNow({ 'error': { 'message': response.data.message } });
				}
			});
		};

		<?php if($key!="stats" && !empty($key)){ ?>
			$scope.playlist_id ="<?php echo $key;?>";
		<?php }else { ?>
			$scope.playlist_id = 'all';
		<?php } ?>




		/* Code By Sidharth Start */

		

		// Check if video is selected
	

		
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

	function initializeSummernote(selector) {
            $(selector).summernote({
                airMode: true, // Ensure toolbar is visible
                popover: {
                    air: [
                        ['style', ['bold', 'italic', 'underline', 'style']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'table', 'color', 'fontname', 'fontsize']],
                        ['custom', ['generateImage', 'aiImage', 'stockImage', 'aiText']]
                    ],
                    image: [
                        ['resize', ['resizeFull', 'resizeHalf', 'resizeQuarter']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ]
                },
                toolbar: [
                    ['style', ['style']],
                    ['font', ['fontname', 'fontsize']], // Added font family
                    ['color', ['color']], // Added color picker
                    ['font', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video', 'table']], // Table Option
                    ['custom', ['aiImage', 'stockImage', 'aiText']]
                ],
                fontNames: ['Arial', 'Helvetica', 'Times New Roman', 'Courier New', 'Verdana', 'Georgia'], // Customize font family options ,
				fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '32', '36', '40', '44', '48', '56', '64', '72', '80', '88', '96', '100'], // Added up to 100
                callbacks: {
                    onChange: function(contents, $editable) {
                        // angular.element(this).scope().$apply(function (scope) {
                        //     scope.description = contents;
                        // });
                    }
                }
            });

        }

        // Initialize Summernote for multiple editors
        initializeSummernote('#summernoteText');
        initializeSummernote('#summernoteDescription');


        $(document).ready(function() {
            let selectedRange = null;
			var selectedText;
            // Capture cursor position in Summernote
            $('#SummernoteIDtext').on('summernote.keyup summernote.mouseup', function() {
                let summernoteInstance = $('#SummernoteIDtext').summernote();
                selectedRange = summernoteInstance.summernote('editor.getLastRange');
            });

            // Show selected text in modal when opening
           /*  $('#aiTextModal').on('show.bs.modal', function() {
                let selectedText = window.getSelection().toString().trim();
				alert(selectedText);
                if (selectedText) {
                    $(".aiTextModal-chat-box p").text(selectedText);
                    sessionStorage.setItem("selectedText", selectedText);
                }
            }); */

            // Enable text editing inside modal
            $(document).on("click", ".fa-pen-to-square", function(e) {
                e.preventDefault();
                let textElement = $(".aiTextModal-chat-box p");
                let text = textElement.text();
				selectedText = text; 
                textElement.html(`<textarea class="form-control edit-textarea">${text}</textarea>`);

                // Change icons: Show Save & Cancel buttons
                $(this).closest(".aiTextModal-tool").html(`
						<button class="icons icon-btn icon-btn-outline icon-sm edit-icon text-danger cancel-edit">
							<i class="fa-solid fa-xmark"></i>
						</button>
						<button href="#" class="icons icon-btn icon-btn-outline icon-sm copy-icon text-success save-edited-text">
							<i class="fa-solid fa-check"></i>
						</button>
				`);
            });

            // Save edited text
            $(document).on("click", ".save-edited-text", function(e) {
                e.preventDefault();
                let newText = $(".edit-textarea").val();
                if (newText.trim() !== "") {
                    $(".aiTextModal-chat-box p").text(newText);
                }

                // Restore tool buttons
                restoreToolButtons();
            });

            // Cancel edit and restore original text
            $(document).on("click", ".cancel-edit", function(e) {
                e.preventDefault();
                $(".aiTextModal-chat-box p").text(selectedText || "Ai Generated Text");
                // Restore tool buttons
                restoreToolButtons();
            });

            // Insert edited text back into Summernote at cursor position
            $(document).on("click", ".use-text-btn", function(e) {
				e.preventDefault();
				useTheText(`#${currentModel}`);

            });
			function useTheText(summernoteId) {
				// 1. Pull the text from your AI modal
				const textContent = $(".aiTextModal-chat-box p").text().trim();
				$(summernoteId).summernote('code', '');
				$('#aigentextInput').val('');
				if (summernoteId === '#summernoteTags') {
					// 2. Split into individual tags on whitespace
					const tags = textContent ? textContent.replace(/,/g, "").split(/\s+/) : [];


					// 3. Clear existing tags (optional)
					$('#tags').importTags('');
					
					// 4. Add each tag
					tags.forEach(function(tag) {
						if (tag) {
							$('#tags').addTag(tag);
						}
					});
					
					// 5. Remove Default Value
					
					
					
				} else {
					// Insert into Summernote for any other editor
					const newText = textContent + ' ';
					const $editor = $(summernoteId);
					
					$editor.summernote('editor.insertText', newText);
				}

				// 5. Close both modals
				$('#aiModal').modal('hide');
				$('#aiTextModal').modal('hide');
			}


            // Reset modal content when closed
            $('#aiTextModal').on('hidden.bs.modal', function() {
                $(".aiTextModal-chat-box p").text("Pro Services For Homes & Business");
                restoreToolButtons();
            });

            // Function to restore tool buttons
            function restoreToolButtons() {
                let toolButtons = `
					<a href="#" class="icons icon-btn icon-btn-outline icon-sm edit-icon">
						<i class="fa-solid fa-pen-to-square"></i>
					</a>
					<a href="#" class="icons icon-btn icons icon-btn-outline icon-sm edit-icon" ng-click="copyEditortext()">
						<i class="fa-solid fa-clone"></i>
					</a>
					<a href="#" class="btn btn-sm btn-primary use-text-btn">Use text</a>
				`;

                let toolElement = $(".aiTextModal-tool");
                toolElement.html(toolButtons);

                // Recompile with AngularJS
                let scope = angular.element(toolElement).scope();
                let compile = angular.element(toolElement).injector().get('$compile');
                compile(toolElement.contents())(scope);
                scope.$apply();
            }

        });


</script>