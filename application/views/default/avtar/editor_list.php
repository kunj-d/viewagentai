<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<!--<script src=""></script>-->
<style>
    .export-btn {
        background: var(--blue-gradient);
        border: 0px;
        color: white;
        padding: 10px 40px;
        margin: 3px 10px;
        border-radius: 5px;
    }

    .delete-btn {
        color: #fff;
        font-size: 18px;
        padding-left: 15px;
    }

    .delete-btn:hover {
        color: red;
    }

    div.dt-buttons>.dt-button:first-child,
    div.dt-buttons>div.dt-button-split .dt-button:first-child {
        background: var(--blue-gradient);
        border-radius: 5px;
        padding: 10px 20px 10px 20px;
        color: #fff;
    }

    div.dt-buttons>.dt-button:hover:not(.disabled),
    div.dt-buttons>div.dt-button-split .dt-button:hover:not(.disabled) {
        background: var(--blue-gradient);
        padding: 10px 20px 10px 20px;
        color: #fff;
        border-color: var(--theme-br2);
    }

    .dataTables_filter label {
        color: var(--black-color) !important;
    }

    #data-table.table>:not(:last-child)>:last-child>* {
        border-bottom-color: var(--theme-br);
    }

    .dt-buttons {
        position: relative;
        left: 51px;
    }
</style>

<?php
// if ($team_create_video) {
// $create_video_btn = '<a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertNameModal">Create New Video</a>';
// $create_video_btn = '<a href="' . base_url('ai-avatars-video') . '" class="btn btn-primary">Create New Videodfd</a>';
// } else {
//     $create_video_btn = '<a class="btn btn-primary" href="javascript:" ng-click="show_msg(\'You do not have permission to access Editor.\')">Create New Avatar</a>';
// }


// if ($team_create_video) {
// $create_video_scratch = '<a href="#" class=" btn btn-primary"  data-bs-toggle="modal" data-bs-target="#chooseTemplateModal" >Create New Video</a>';
// $create_video_scratch = '<a href="' . base_url('ai-avatars-video') . '" class="btn btn-primary">Create New Video</a>';
// } else {
//     $create_video_scratch = '<a class="btn btn-primary" href="javascript:" ng-click="show_msg(\'You do not have permission to access Editor.\')">Create New Video</a>';
// }


if ($team_templates) {
    $templates = '<a href="' . base_url('default-template') . '" class="btn btn-primary">Use a Template</a>';
} else {
    $templates = '<a class="btn btn-primary" href="javascript:;" ng-click="show_msg(\'You do not have permission to access Teamplate.\')">Use a Template</a>';
}

?>




<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="visController" ng-cloak>
    <title><?php echo $this->config->item('productName') ?> | Create Video</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding">
        <div class="row">
            <div class="col-12"
                ng-if="(!avatarList.avatarListingMade || avatarList.avatarListingMade.length === 0) && (!draftList.draftvideoListing || draftList.draftvideoListing.length === 0) && (!avatardata.avatarListingMade || avatardata.avatarListingMade.length === 0) && (!historyVideos || historyVideos.length === 0)">


                <div class="create-first d-none">
                    <img src="<?php echo $this->config->item('assetsPath') ?>images/first-tube-studio.png" alt="image"
                        class="img-fluid d-block mx-auto">
                    <!-- <p class="description">
                            Let’s Create Your First AI-Powered Video
                        </p> -->
                    <!--<a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertNameModal">Create New Video</a>-->
                    <?php echo $create_video_btn ?>
                </div>

                <div class="center-div d-none">
                    <div class="section-head mb-3 mb-sm-4">
                        <div class="title">
                            Create Videos Using <span class="text-primary">Editor, AI, Avatar,</span> or <span
                                class="text-primary">Templates</span>
                        </div>
                        <!--<p class="desc">Make videos easily using the Editor, Avatar, or Templates.</p>-->
                    </div>
                    <div class="row row-gap w-100">
                        <!-- <div class="col-12 col-sm-6 col-lg-3">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#insertNameModal"
                                class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/new.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    Create form scratch
                                </h4>
                                <p class="mb-0">Start with a Blank canvas and build your video.</p>
                            </a>
                        </div> -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <a href="<?= base_url('talking-avatars'); ?>" class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/video.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    Avatar Video
                                </h4>
                                <p class="mb-0">Create videos using realistic AI avatars.</p>
                            </a>
                        </div>
                        <!-- <div class="col-12 col-sm-6 col-lg-3">
                            <a href="<?= base_url('default-template'); ?>" class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/temp.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    Templates
                                </h4>
                                <p class="mb-0">Choose from pre-made templates and customize.</p>
                            </a>
                        </div> -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <a href="<?= base_url('ai-avatars-video'); ?>" class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/ai-video.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    AI Video
                                </h4>
                                <p class="mb-0">Let AI create video for you automatically.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
  <!-- ng-if="(avatarList.avatarListingMade && avatarList.avatarListingMade.length > 0) || (draftList.draftvideoListing && draftList.draftvideoListing.length > 0 || (avatardata.avatarListingMade && avatardata.avatarListingMade.length > 0)) || (historyVideos && historyVideos.length > 0)" -->

            <div class="col-12">
                <div class="row align-items-center mb-3">
                    <div class="col-12">
                        <div class="feature-banner">
                            <div class="row align-items-center justify-content-between g-0">
                                <div class="col-auto feature-wrap">
                                    <h5 class="feature-title">Create Your Video</h5>
                                    <p class="feature-subtitle mb-0">
                                        Create, edit, and customize videos with AI and ready-made templates.
                                    </p>
                                </div>
                                <div class="col-auto ms-auto">
                                    <?php echo $create_video_scratch ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <ul class="nav nav-pills nav-pills-style-1 nav-pills-with-gradient gap-2" id="pills-tab"
                            role="tablist">
                            <!-- <li class="nav-item" role="presentation">-->
                            <!--     <button class="nav-link active" id="pills-publish-tube-studio-tab" data-bs-toggle="pill"-->
                            <!--         data-bs-target="#pills-publish-tube-studio" type="button" role="tab"-->
                            <!--         aria-controls="pills-publish-tube-studio" aria-selected="true">-->
                            <!--         <span>Created Videos</span>-->
                            <!--     </button>-->
                            <!-- </li>-->
                            <!-- <li class="nav-item" role="presentation">-->
                            <!--     <button class="nav-link" id="pills-draft-tube-studio-tab" data-bs-toggle="pill"-->
                            <!--         data-bs-target="#pills-draft-tube-studio" type="button" role="tab"-->
                            <!--         aria-controls="pills-draft-tube-studio" aria-selected="false">-->
                            <!--         <span>Draft Videos</span>-->
                            <!--     </button>-->
                            <!-- </li>-->
                            <!-- <li class="nav-item" role="presentation">-->
                            <!--    <button class="nav-link" id="pills-avatar-videos-tab" data-bs-toggle="pill"-->
                            <!--        data-bs-target="#pills-avatar-videos" type="button" role="tab"-->
                            <!--        aria-controls="pills-avatar-videos" aria-selected="false">-->
                            <!--        <span>Avatar Videos</span>-->
                            <!--    </button>-->
                            <!--</li>-->

                            <li class="nav-item" role="presentation">
                                <button class="nav-link"
                                    ng-class="{   active: hasCreated() || (!hasCreated() && !hasDraft() && !hasAvatar() && !hasAiVideos()) }"
                                    id="pills-publish-tube-studio-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-publish-tube-studio" type="button">
                                    <span>Optimize</span>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link"
                                    ng-class="{ active: !hasCreated() && !hasDraft() && hasAvatar() }"
                                    id="pills-avatar-videos-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-avatar-videos" type="button">
                                    <span>Avatar Videos</span>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" ng-class="{ active: !hasCreated() && !hasDraft() && !hasAvatar() && hasAiVideos() }" id="pills-ai-video-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-ai-video" type="button">
                                    <span>AI Videos</span>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" ng-class="{  active: !hasCreated() && hasDraft() }"
                                    id="pills-draft-tube-studio-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-draft-tube-studio" type="button">
                                    <span>Draft Videos</span>
                                </button>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="w-100">
                            <div class="search-bar left-icon">
                                <div class="search-icon">
                                    <span class="icon-search"></span>
                                </div>
                                <input type="text" class="search form-control" placeholder="Search for Video"
                                    autocomplete="off" id="searchText" ng-model="searchQuery">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <!-- Publish -->
                    <!--<div class="tab-pane fade show active" id="pills-publish-tube-studio" role="tabpanel" aria-labelledby="pills-publish-tube-studio-tab" tabindex="0">-->
                    <div class="tab-pane fade" id="pills-publish-tube-studio" role="tabpanel"
                        aria-labelledby="pills-publish-tube-studio-tab" tabindex="0"
                        ng-class="{   'show active': hasCreated() || (!hasCreated() && !hasDraft() && !hasAvatar() && !hasAiVideos()) }">
                        
                        <div class="text-center text-muted py-5 w-100" ng-if="!avatarList.avatarListingMade || avatarList.avatarListingMade.length === 0">
                            <i class="fa-solid fa-video-slash d-block fs-2 mb-2"></i>
                            No created videos found in your dashboard.
                        </div>
                        <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 mt-2 mt-md-3">
                            <div class="col" ng-repeat="avatar in avatarList.avatarListingMade | filter:searchQuery">

                                <div class="avatar-listing avatar-listing-style-2">
                                    <img src="{{avatar.thumbnail}}" alt="image" class="avatar-listing-media">
                                    <div class="avatar-listing-inner">
                                        <div class="top-content d-flex align-items-center justify-content-end">
                                            <!--<div class="d-flex gap-2 float-start">
                                                <a class="d-inline-block" href="javascript:void(0);" ng-click="toggleStatus(avatar)">
                                                    <i ng-class="avatar.fav_status == 1 ? 'fas fa-star' : 'far fa-star'" id="star_{{avatar.id}}"></i>
                                                </a>
                                            </div>-->
                                            <div class="dropstart dropdown-no-arrow d-inline-flex overflow-visible">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </a>
                                                <ul class="dropdown-menu overflow-visible">
                                                    <li class="dropdown-item">
                                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#renameModal"
                                                            ng-click="gettitle(avatar.id)"><i
                                                                class="fa-solid fa-pen"></i> Rename</a>
                                                    </li>

                                                    <?php if ($team_edit_video): ?>
                                                        <li class="dropdown-item">
                                                            <a
                                                                href="<?php echo base_url('edit-video-template'); ?>/{{avatar.id}}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="dropdown-item">
                                                            <a href="javascript:;"
                                                                ng-click="show_msg('You do not have permission to access to edit Video.')">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <li class="dropdown-item">
                                                        <a href="javascript:void(0);"
                                                            ng-click="downloadFile(avatar.url,'mp4')">
                                                            <i class="fa-solid fa-download"></i> Download
                                                        </a>
                                                    </li>

                                                    <?php if ($team_workspace) { ?>
                                                        <li class="dropdown-item workspace-dropdown-parent">
                                                            <a
                                                                class="d-flex align-items-center justify-content-between gap-3">
                                                                <div><i
                                                                        class="fa-solid fa-file-import workspace-listing "></i>
                                                                    Workspace </div>
                                                                <i class="fa-solid fa-angle-right"></i>
                                                            </a>
                                                            <ul class="workspace-dropdown dropdown-menu">
                                                                <li>
                                                                    <a href="javascript:void(0);"
                                                                        ng-click="addvideotoWorkSpace(avatar.id, workspace.id ,avatar.title,avatar.url)"
                                                                        ng-repeat="workspace in workspacelist">{{workspace.domain}}</a>
                                                                </li>

                                                            </ul>
                                                        </li>
                                                    <?php } ?>

                                                    <?php if ($team_delete_video): ?>
                                                        <li class="dropdown-item">
                                                            <a href="javascript:void(0);" ng-click="deleteAvt(avatar.id)">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="dropdown-item">
                                                            <a href="javascript:;"
                                                                ng-click="show_msg('You do not have permission to access to Delete Video')">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>

                                                </ul>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="video-btn"
                                            ng-click="crateStudio(avatar.id,avatar.url)"><i
                                                class="fa-solid fa-play"></i></a>
                                        <!-- <a  href="javascript:void(0);" class="btn btn-primary add-btn" ><i class="fa-brands fa-youtube"></i>Post on social media</a> -->
                                        <div class="bottom-content">
                                            <div class="avatar-flex-content">
                                                <div class="sub-content">
                                                    <!--<a href="javascript:void(0);" class="avatar-link">{{avatar.title}}</a>-->
                                                    <a href="javascript:void(0);"
                                                        class="avatar-link">{{getShortTitle(avatar.title, 20)}}</a>
                                                </div>
                                                <form action="<?php echo base_url('automation') ?>" method="post">
                                                    <input type="hidden" value="{{getShortTitle(avatar.title, 20)}}"
                                                        name="video-name" id="video-name" />
                                                    <input type="hidden" value="{{avatar.url}}" name="video-url"
                                                        id="video-url" />
                                                    <?php if ($team_youtube_publisher) { ?>
                                                        <button type="submit" class="play-badge youtube-icon btn"
                                                            style="padding:0!important" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Post on social media" data-bs-original-title=""
                                                            title="">
                                                            <i class="fa-brands fa-youtube fs-3"
                                                                style="color: #ff0033;"></i>
                                                        </button>
                                                    <?php } else { ?>
                                                        <button
                                                            ng-click="show_msg('You do not have permission to access to youtube publisher')"
                                                            class="play-badge youtube-icon btn" style="padding:0!important"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Post on social media" data-bs-original-title=""
                                                            title="">
                                                            <i class="fa-brands fa-youtube fs-3"
                                                                style="color: #ff0033;"></i>
                                                        </button>
                                                    <?php } ?>
                                                </form>
                                                <!-- <a href="javascript:void(0);" class="play-badge youtube-icon"
                                                    href="<?php echo base_url(); ?>" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Post on social media"
                                                    data-bs-original-title=""
                                                    title=""
                                                >
                                                <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19.6 12.45C19.4 13.5 18.55 14.3 17.5 14.45C15.85 14.7 13.1 15 10 15C6.95 15 4.2 14.7 2.5 14.45C1.45 14.3 0.6 13.5 0.4 12.45C0.2 11.3 0 9.6 0 7.5C0 5.4 0.2 3.7 0.4 2.55C0.6 1.5 1.45 0.7 2.5 0.55C4.15 0.3 6.9 0 10 0C13.1 0 15.8 0.3 17.5 0.55C18.55 0.7 19.4 1.5 19.6 2.55C19.8 3.7 20.05 5.4 20.05 7.5C20 9.6 19.8 11.3 19.6 12.45Z" fill="#FF3D00"/>
                                                    <path d="M8 11V4L14 7.5L8 11Z" fill="white"/>
                                                </svg>
                                            </a> -->
                                            </div>
                                            <!-- <ul class="avatar-listing-icons d-none">
                                                <li 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Copy Embed Code" 
                                                    data-bs-original-title="" 
                                                    title=""
                                                >
                                                    <a data-bs-toggle="modal"><i class="fa-solid fa-copy"></i></a>
                                                </li>
                                                <li 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Share"  
                                                    data-bs-original-title="" title="">
                                                    <a data-bs-toggle="modal" data-bs-target="#shareModal">
                                                        <i class="fa-solid fa-share-from-square"></i>
                                                    </a>
                                                </li>
    
                                                 <li 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Edit" 
                                                    data-bs-original-title="" title="" >
                                                    <a href="javascript:void(0);">
                                                        <i class="fa-solid fa-pen-to-square"  ng-click="crateStudio(avatar.id,avatar.url)"></i>
                                                    </a>
                                                </li>
    
                                                <li class="template-list" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Add to Workspace" 
                                                    data-bs-original-title=""
                                                    title="">
                                                    <a href="javascript:void(0);"><i class="fa-solid fa-file-import workspace-listing "></i></a>
                                                    <ul style="max-height: 160px; overflow-y: auto;">
                                                        <p class="mb-0">Add to Workspace</p>
                                                            <li ng-click="addgptWorkSpace(avatar.id, workspace.id ,avatar.title,avatar.url)" ng-repeat="workspace in workspacelist">
                                                            {{workspace.domain}}
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Delete" data-bs-original-title="" title="">
                                                    <a ng-click="deleteAvt(avatar.id)" style="color: #FF4B4B !important;">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </li> 
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Draft -->
                    <!--<div class="tab-pane fade" id="pills-draft-tube-studio" role="tabpanel" aria-labelledby="pills-draft-tube-studio-tab" tabindex="0">-->
                    <div class="tab-pane fade" id="pills-draft-tube-studio" role="tabpanel"
                        aria-labelledby="pills-draft-tube-studio-tab" tabindex="0"
                        ng-class="{   'show active': !hasCreated() && hasDraft() }">
                         <div class="text-center text-muted py-5 w-100" ng-if="!draftList.draftvideoListing || draftList.draftvideoListing.length === 0">
                            <i class="fa-solid fa-file-signature d-block fs-2 mb-2"></i>
                            No draft videos found.
                        </div>

                        <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 mt-2 mt-md-3">
                            <div class="col" ng-repeat="draftvideo in draftList.draftvideoListing | filter:searchQuery">
                                <div class="avatar-listing avatar-listing-style-2">
                                    <img src="{{draftvideo.thumbnail}}" alt="image" class="avatar-listing-media">
                                    <div class="avatar-listing-inner">
                                        <div class="top-content d-flex align-items-center justify-content-between">
                                            <div class="d-flex gap-2 float-end ms-auto">
                                                <a class="trash-icon" href="javascript:void(0);"
                                                    ng-click="deleteAvt(draftvideo.id)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- <a  href="javascript:void(0);" class="btn btn-primary add-btn"><i class="fa-brands fa-youtube"></i>Post on social media</a> -->
                                        <a href="<?php echo base_url('edit-video-template') ?>/{{draftvideo.id}}"
                                            class="btn btn-primary add-btn btn-no-style">Complete Video</a>
                                        <div class="bottom-content">
                                            <div class="avatar-flex-content">
                                                <div class="sub-content">
                                                    <a href="javascript:void(0);"
                                                        class="avatar-link">{{draftvideo.title}}</a>
                                                </div>
                                                <!-- <a href="javascript:void(0);" class="play-badge"><i class="fa-solid fa-circle-play"></i></a> -->
                                            </div>
                                            <!-- <ul class="avatar-listing-icons d-none">
                                                <li 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Copy Embed Code" 
                                                    data-bs-original-title="" 
                                                    title=""
                                                >
                                                    <a data-bs-toggle="modal"><i class="fa-solid fa-copy"></i></a>
                                                </li>
                                                <li 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Share"  
                                                    data-bs-original-title="" title="">
                                                    <a data-bs-toggle="modal" data-bs-target="#shareModal">
                                                        <i class="fa-solid fa-share-from-square"></i>
                                                    </a>
                                                </li>
    
                                                 <li 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Edit" 
                                                    data-bs-original-title="" title="" >
                                                    <a href="javascript:void(0);">
                                                        <i class="fa-solid fa-pen-to-square"  ng-click="crateStudio(avatar.id,avatar.url)"></i>
                                                    </a>
                                                </li>
    
                                                <li class="template-list" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Add to Workspace" 
                                                    data-bs-original-title=""
                                                    title="">
                                                    <a href="javascript:void(0);"><i class="fa-solid fa-file-import workspace-listing "></i></a>
                                                    <ul style="max-height: 160px; overflow-y: auto;">
                                                        <p class="mb-0">Add to Workspace</p>
                                                            <li ng-click="addvideotoWorkSpace(avatar.id, workspace.id ,avatar.title,avatar.url)" ng-repeat="workspace in workspacelist">
                                                            {{workspace.domain}}
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Delete" data-bs-original-title="" title="">
                                                    <a ng-click="deleteAvt(avatar.id)" style="color: #FF4B4B !important;">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </li> 
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- avatar videos -->
                    <!--<div class="tab-pane fade" id="pills-avatar-videos" role="tabpanel" aria-labelledby="pills-avatar-videos-tab">-->
                    <div class="tab-pane fade" id="pills-avatar-videos" role="tabpanel"
                        aria-labelledby="pills-avatar-videos-tab" tabindex="0"
                        ng-class="{   'show active': !hasCreated() && !hasDraft() && hasAvatar() }">
                         
                        <div class="text-center text-muted py-5 w-100" ng-if="!avatardata.avatarListingMade || avatardata.avatarListingMade.length === 0">
                            <i class="fa-solid fa-user-slash d-block fs-2 mb-2"></i>
                            No avatar videos found.
                        </div>
                        <div
                            class="row row-cols-1 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mt-2 mt-md-3">
                            <div class="col" ng-repeat="avatar in avatardata.avatarListingMade | filter:searchQuery">
                                <div
                                    ng-class="{ 'avatar-listing overlay-loader': avatar.thumbnail === loaderImagePath, 'avatar-listing': avatar.thumbnail !== loaderImagePath}">
                                    <div class="avatar-listing">
                                        <!--<div class="overlay d-none">-->
                                        <!--    <h5 class="title">Creating Your Talking Avatar</h5>-->
                                        <!--    <div class="loading__bar"></div>-->
                                        <!--    <p class="subtext">This may take up to few minutes.<br>Stay tuned...</p>-->
                                        <!--</div>-->
                                        <!--<img src="{{avatar.thumbnail}}" alt="image" class="avatar-listing-media">-->
                                        <img ng-src="{{avatar.thumbnail}}" alt="image"
                                            ng-class="{ 'avatar-listing-media loader-img': avatar.thumbnail === loaderImagePath, 'avatar-listing-media': avatar.thumbnail !== loaderImagePath}">
                                        <div class="avatar-listing-inner">
                                            <div class="top-content d-flex align-items-center justify-content-between">
                                                <div class="d-flex gap-2 float-start">
                                                    <!-- <a class="d-inline-block" href="javascript:void(0);" ng-click="toggleStatus(avatar)" ng-if="!avatar.avatar_id">
                                            <i ng-class="avatar.fav_status == 1 ? 'fas fa-star' : 'far fa-star'" id="star_{{avatar.id}}"></i>
                                        </a> -->
                                                </div>
                                                <div class="dropstart dropdown-no-arrow d-inline-flex overflow-visible">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class="fa-solid fa-ellipsis"></i>
                                                    </a>
                                                    <ul class="dropdown-menu overflow-visible">
                                                        <li class="dropdown-item">
                                                            <a href="javascript:void(0);"
                                                                ng-click="getAvatartitle(avatar.id)"
                                                                ng-if="!avatar.avatar_id"><i
                                                                    class="fa-solid fa-pen"></i> Rename</a>
                                                        </li>
                                                        
                                                         <li class="dropdown-item">
                                                        <a href="javascript:void(0);"
                                                            ng-click="downloadFile(avatar.url,'mp4')">
                                                            <i class="fa-solid fa-download"></i> Download
                                                        </a>
                                                    </li>

                                                        <?php //if($team_workspace) { ?>
                                                        <li class="dropdown-item workspace-dropdown-parent">
                                                            <a class="d-flex align-items-center justify-content-between gap-3"
                                                                ng-if="!avatar.avatar_id">
                                                                <div><i
                                                                        class="fa-solid fa-file-import workspace-listing "></i>
                                                                    Workspace </div>
                                                                <i class="fa-solid fa-angle-right"></i>
                                                            </a>
                                                            <ul class="workspace-dropdown dropdown-menu">
                                                                <li>
                                                                    <a href="javascript:void(0);"
                                                                        ng-click="addgptWorkSpace(avatar.id, workspace.id ,avatar.title,avatar.url)"
                                                                        ng-repeat="workspace in workspacelist">{{workspace.domain}}</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <?php //} ?>

                                                        <?php //if ($team_create_avatar) { ?>
                                                        <li class="dropdown-item">
                                                            <a href="javascript:void(0);"
                                                                ng-click="deleteAvtarvideo(avatar.id)">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                        <?php //} else {  ?>
                                                        <!--<li class="dropdown-item">-->
                                                        <!--    <a href="javascript:void(0);" ng-click="show_msg('You do not have permission to delete Avatar')">-->
                                                        <!--        <i class="fa-solid fa-trash-can"></i>-->
                                                        <!--        Delete-->
                                                        <!--    </a>-->
                                                        <!--</li> -->
                                                        <?php  //}  ?>

                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0);" class="video-btn"
                                                ng-click="crateavatarStudio(avatar.id,avatar.url)"
                                                ng-if="!avatar.avatar_id"><i class="fa-solid fa-play"></i></a>
                                            <!--<a  href="javascript:void(0);" class="btn btn-primary add-btn"><i class="fa-brands fa-youtube"></i>Post on social media</a> -->
                                            <div class="bottom-content">
                                                <div class="avatar-flex-content">
                                                    <div class="sub-content">
                                                        <!--<a href="javascript:void(0);" class="avatar-link">{{avatar.title}}</a>-->
                                                        <a href="javascript:void(0);"
                                                            class="avatar-link">{{getShortTitle(avatar.title, 20)}}</a>
                                                        <p class="date">{{avatar.created}}</p>
                                                    </div>
                                                    <a href="javascript:void(0);" class="play-badge"><i
                                                            class="fa-solid fa-circle-play"></i></a>
                                                </div>
                                                <ul class="avatar-listing-icons d-none">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- avatar videos -->
                    </div>
                    <div class="tab-pane fade" id="pills-ai-video" role="tabpanel"
                        aria-labelledby="pills-ai-video-tab" tabindex="0"
                        ng-class="{ 'show active': !hasCreated() && !hasDraft() && !hasAvatar() && hasAiVideos() }">
                        <div>
                            <div class="text-center text-muted py-4" ng-if="!historyVideos || historyVideos.length === 0"    >
                                <i class="fa-solid fa-folder-open d-block fs-2 mb-2"></i>
                                No AI cinematic videos found in your history log.
                            </div>
                            <div class="row row-gap-2 gx-3">
                                <!--<div class="col-md-4">-->
                              <div class="col-md-6" ng-repeat="vid in historyVideos | filter:{keyword: searchQuery}">
                                    <div class="history-card p-3 d-flex align-items-start justify-content-between gap-4">
                                        <div class="d-flex align-items-center gap-3 min-w-0">
                                            <!--<div class="video-thumbnail">-->
                                            <div class="video-thumbnail position-relative" style="width: 100px; height: 56px; background: #000; border-radius: 6px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                                                <!--<img src="https://picsum.photos/150/150?random=10" alt="Futuristic City thumbnail" class="flex-shrink-0">-->
                                                
                                                <!--<img src="https://cdn.tubeclawai.com/assets/uploads/videos/qq8wajd252/qq8wajd252.jpg" alt="preview" style="width: 100%; height: 100%; object-fit: cover;">-->
                                    <img ng-src="{{vid.thumbnail}}" alt="preview" style="width: 100%; height: 100%; object-fit: cover;">
                                                 <!-- <video src="https://cdn.tubeclawai.com/assets/uploads/users/1/generated_1781268881_7734.mp4" style="width: 100%; height: 100%; object-fit: cover;" preload="metadata" playsinline></video> -->
                                                
                                                <!--<a href="javascript:void(0);" class="position-absolute d-flex align-items-center justify-content-center text-white h-100 w-100" style="top:0; left:0; background: rgba(0,0,0,0.45); transition: background 0.2s;" data-bs-toggle="modal" data-bs-target="#historyPreviewModal">-->
                                                <!--    <i class="fa-solid fa-circle-play fs-5"></i>-->
                                                <!--</a>-->
                                                <a href="javascript:void(0);" ng-click="playHistoryVideo(vid.id, vid.video_url)"  class="position-absolute d-flex align-items-center justify-content-center text-white h-100 w-100"
                                               style="top:0; left:0; background: rgba(0,0,0,0.45);">
                                                   <i class="fa-solid fa-circle-play fs-5"></i>
                                                    </a>
                                            </div>
                    
                                            <div class="d-flex flex-column gap-2 min-w-0">
                                                <!--<h6 class="video-title text-truncate m-0 fw-semibold" title="Email Marketing"style="cursor: pointer;">-->
                                                    <!--Futuristic city at sunset-->
                                                <!--    Email Marketing-->
                                                <!--</h6>-->
                                                
                                                <h6 class="video-title text-truncate m-0 fw-semibold" title="{{vid.keyword}}" style="cursor: pointer;">  {{vid.keyword}}
                                                </h6>
                                                <div>
                                                    <span class="style-badge">
                                                        <i class="fa-solid fa-wand-magic-sparkles"></i> 
                                                        <!--Futuristic-->
                                                        AI VIDEO
                                                    </span>
                                                    
                                                    <!--<span class="badge bg-danger" style="font-size: 10px; padding: 3px 6px; letter-spacing: 0.5px;">-->
                                                    <!--    <i class="fa-solid fa-clapperboard me-1"></i> AI VIDEO-->
                                                    <!--</span>-->
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                            <button class="action-btn" aria-label="Download Video" ng-click="downloadFile(vid.video_url, 'mp4')">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                           <!-- <button class="action-btn"-->
                                           <!--aria-label="Download Video"-->
                                           <!--ng-click="downloadFile(msg.downloadUrl, 'mp4')">-->
                                           <!--  <i class="fa-solid fa-download"></i>-->
                                           <!-- </button>-->
                                            <!--<button class="action-btn btn-delete" aria-label="Delete Video"-->
                                            <!--    onclick="handleDelete(this)">-->
                                            <!--<i class="fa-solid fa-trash-can"></i>-->
                                            <!--</button>-->
                                            <button type="button" class="action-btn btn-delete" aria-label="Delete Video" ng-click="deleteHistoryItem(vid.id)">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                    
                                    </div>
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade video-pr-modal" id="historyPreviewModal" tabindex="-1" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px;">
                 <div class="modal-content" style="background: #1a1d24; border: 1px solid #2e3541;">
                     <div class="modal-header border-0 pb-0">
                         <h6 class="modal-title fw-semibold text-white">
                             <i class="fa-solid fa-circle-play text-danger me-2"></i>History Video Playback
                         </h6>
                         <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" ng-click="closeHistoryModalPlayer()"></button>
                     </div>
                     <div class="modal-body text-center p-3">
                         <input type="hidden" id="historyVideoId" ng-model="historyVideoId">
                         <video id="historyModalPlayer" class="w-100 rounded mb-3" controls style="max-height: 450px; background: #000; outline: none; box-shadow: 0 4px 15px rgba(0,0,0,0.6);">
                             <source id="historyModalSource" src="" type="video/mp4">
                             Your current web browser configuration does not handle inline native file streams.
                         </video>
                     </div>
                     <div class="modal-footer justify-content-center border-0 pt-0 gap-2">
                         <button type="button" class="btn btn-primary btn-no-style" ng-click="goToCustomEditor()">
                             <i class="fa-solid fa-pen-to-square me-1"></i> Customize in Editor
                         </button>
                     </div>
                 </div>
             </div>
        </div>
    <!-- Modal for createAvatar -->

    <!--  <div class="modal fade" id="insertNameModal" aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-dialog-centered">-->
    <!--        <div class="modal-content">-->
    <!--           <div class="modal-header align-items-start">-->
    <!--               <div class="d-flex flex-column gap-2">-->
    <!--                   <h5 class="modal-title">AI Tube Star</h5>-->
    <!--                   <div class="std-btn">-->

    <!--                   </div>-->
    <!--               </div>-->
    <!--               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--           </div>-->
    <!--            <div class="modal-body">-->
    <!--               <div class="row row-gap">-->
    <!--                   <div class="col-sm-6">-->
    <!--                     <input type="text" plaseholder="Project name hear" name="project_name" ng-model="project_name"> -->
    <!--                   </div>-->
    <!--                   <div class="col-sm-6">-->
    <!--                     <button type="button" class="btn btn-danger" ng-click="createNewVideo()"> Submit</button>-->
    <!--                   </div>-->
    <!--               </div>-->

    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


    <!-- videoPrModal -->
    <div class="modal fade video-pr-modal" id="videoPrModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            style="max-width: 700px; max-height: 500px;">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h6 class="modal-title fw-semibold">Video Preview</h6>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-x: hidden;">
                    <input type="hidden" id="videoId" ng-model="videoId">
                    <video id="videoPreview" class="mx-auto d-block rounded-3 modal-video-preview" controls>
                        <source id="videoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="modal-footer justify-content-center gap-2">
                    <!-- <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Back</button> -->
                    <!--<button type="button" id="showpLModal" class="btn btn-primary" ng-click="getFramIfram()" >Customize in Editor</button>-->
                    <?php if ($team_edit_video) { ?>
                        <a id="editVideoLink" href="#" class="btn btn-primary">Customize in Editor</a>
                    <?php } else { ?>
                        <button id="editVideoLink" class="btn btn-primary"
                            ng-click="show_msg(\'You do not have permission to access Editor.\')">Customize in
                            Editor</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- videoPrModal -->

    <!-- videoPrModal -->
    <div class="modal fade video-pr-modal" id="videoPrModalavatar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            style="max-width: 700px; max-height: 500px;">
            <div class="modal-content">
                <div class="modal-header pb-2">
                    <h6 class="modal-title">Avatar Preview</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-x: hidden;">
                    <input type="hidden" id="videoId" ng-model="videoId">
                    <video id="avatarvideoPreview" class="img-fluid mx-auto d-block modal-video-preview" controls>
                        <source id="avatarvideoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="modal-footer justify-content-center gap-2">
                    <!-- <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Back</button> -->
                    <?php if ($team_create_video) { ?>
                        <button type="button" id="showpLModal" class="btn btn-primary"
                            ng-click="getFramIfram('1920','1080')">Customize in Editor</button>
                    <?php } else { ?>
                        <button type="button" id="showpLModal" class="btn btn-primary"
                            ng-click="show_msg('You do not have permission to access Editor.')">Customize in Editor</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- videoPrModal -->

    <!-- insertNameModal -->
    <div class="modal fade" id="insertNameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content white shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-semibold">Name Your Video</h5>
                        <small class="theme-text-color">This title will be used as your video name.</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <input type="hidden" name="id" ng-model="title_id">
                    <input type="text" class="form-control border-secondary rounded-3 mb-3"
                        placeholder="Enter Video Title" name="project_name" ng-model="project_name">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline btn-outline-white btn-no-style"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-no-style" ng-click="createNewVideo()">Create
                            Video</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- insertNameModal -->

    <div class="modal fade" id="renameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-semibold">Rename Video Title</h5>
                        <small class="theme-text-color">Rename title will appear as your video title</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <input type="hidden" name="id" ng-model="title_id">
                    <input type="text" class="form-control border-secondary rounded-3 mb-3" placeholder="Video 1"
                        name="project_name" ng-model="project_name">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline btn-outline-white btn-no-style"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-no-style"
                            ng-click="updatetitle()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for createAvatar -->
    <div class="modal fade" id="createAvatarModal" tabindex="-1" aria-labelledby="createAvatarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex flex-column gap-2">
                        <h5 class="modal-title">Pick Your Avatar Type</h5>
                        <!-- <div class="std-btn">
                        <span>See The Difference</span>
                        <i
                            class="fa-solid fa-circle-info ms-2 info-tooltip"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-custom-class="custom-tooltip"
                            data-bs-title="Select the email type with your audience’s needs.">
                        </i>
                    </div> -->
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a class="text-center" href="<?= base_url('talking-avatars'); ?>">
                                <div class="createAvatarModal-box hover-video">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>images/photo-avatar.png"
                                            class="img-fluid mx-auto d-block" alt="image">
                                        <video class="hover-play" muted loop>
                                            <source
                                                src="<?php echo $this->config->item('assetsPath') ?>images/photo-avatar.mp4"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="inner-content">
                                        <h6 class="title">Create Photo Avatar</h6>
                                        <!-- <p class="description">Upload your photo or Choose a readymade face to animate with AI Voice</p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a class="text-center" href="<?= base_url('talking-avatars'); ?>?avatar_type=video">
                                <div class="createAvatarModal-box hover-video">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>images/video-avatar.png"
                                            class="img-fluid mx-auto d-block" alt="image">
                                        <video class="hover-play" muted loop>
                                            <source
                                                src="<?php echo $this->config->item('assetsPath') ?>images/video-avatar.mp4"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="inner-content">
                                        <h6 class="title">Create Video Avatar</h6>
                                        <!-- <p class="description">Pick from our readymade Video Avatars to effortlessly bring your voice to life.</p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="std-wrapper">
                    <div class="row g-0">
                        <div class="col-6">
                            <a href="javascript:void(0)">
                                <div class="std-avatar-box">
                                    <span class="title-desc">Create with a Photo</span>
                                    <div class="media-box">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>images/std-img/std1.png" alt="image">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0)">
                                <div class="std-avatar-box border-0">
                                    <span class="title-desc">Create with a Video</span>
                                    <div class="media-box">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>images/std-img/std1.png" alt="image">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for createAvatar -->

    <!-- Modal for Rename title -->
    <div class="modal new-folder-modal fade" id="avatarrenameModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-semibold">Rename Video Name</h5>
                        <small class="theme-text-color">Rename title will appear as your video name</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <input type="hidden" name="id" ng-model="title_id">
                    <input type="text" class="form-control text-white border-secondary rounded-3 mb-3"
                        placeholder="Video 1" name="avatar_name" ng-model="avatar_name">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline btn-outline-white btn-no-style"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-no-style"
                            ng-click="updateavatartitle()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- chooseTemplateModal  -->
    <div class="modal fade" id="chooseTemplateModal" tabindex="-1">
        <div class="modal-dialog modal-xl premission-modal modal-dialog-centered modal-dialog-scrollable"
            style="max-width: 1140px;">
            <div class="modal-content border" style="padding: 40px 20px;">
                <div class="modal-header mx-auto">
                    <h4 class="modal-title">Create Videos Using <span class="text-primary">Editor, AI, Avatar,</span> or
                        <span class="text-primary">Templates</span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-gap w-100">
                        <!-- <div class="col-12 col-sm-6 col-lg-3">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#insertNameModal"
                                class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/new.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    Create form scratch
                                </h4>
                                <p class="mb-0">Start with a Blank canvas and build your video.</p>
                            </a>
                        </div> -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <a href="<?= base_url('talking-avatars'); ?>" class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/video.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    Avatar Video
                                </h4>
                                <p class="mb-0">Create videos using realistic AI avatars.</p>
                            </a>
                        </div>
                        <!-- <div class="col-12 col-sm-6 col-lg-3">
                            <a href="<?= base_url('default-template'); ?>" class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/temp.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    Templates
                                </h4>
                                <p class="mb-0">Choose from pre-made templates and customize.</p>
                            </a>
                        </div> -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <a href="<?= base_url('ai-avatars-video'); ?>" class="create-card">
                                <div class="card-img">
                                    <img
                                        src="<?php echo $this->config->item('assetsPath') ?>images/create_video/ai-video.png" />
                                </div>
                                <div class="card-divider"></div>
                                <h4 class="title">
                                    AI Video
                                </h4>
                                <p class="mb-0">Let AI create video for you automatically.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- chooseTemplateModal  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        // modal open and close working code
        $(document).on('click', '[data-bs-toggle="modal"]', function () {
            const target = $(this).data('bs-target');
            const $currentModal = $(this).closest('.modal');

            if ($currentModal.length) {
                $currentModal.modal('hide');

                $currentModal.one('hidden.bs.modal', function () {
                    $(target).modal('show');

                    $(target).one('hidden.bs.modal', function () {
                        $('#chooseTemplateModal').modal('show');
                    });
                });

                return false;
            }
        });
    </script>

    <script>
        // play video on hover from 0
        $('.hover-video').hover(
            function () {
                const video = $(this).find('.hover-play').get(0);
                video.currentTime = 0;
                video.play();
            },
            function () {
                const video = $(this).find('.hover-play').get(0);
                video.pause();
                video.currentTime = 0;
            }
        );
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var videoModal = document.getElementById('videoPrModal');
            var video = document.getElementById('videoPreview');

            videoModal.addEventListener('hidden.bs.modal', function () {
                if (video) {
                    video.pause();
                    video.currentTime = 0; // Optional: reset video to the start
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var avatarvideoModal = document.getElementById('videoPrModalavatar');
            var video = document.getElementById('avatarvideoPreview');

            avatarvideoModal.addEventListener('hidden.bs.modal', function () {
                if (video) {
                    video.pause();
                    video.currentTime = 0;
                    // ❌ video.src = "";  // REMOVE THIS
                }
            });
        });



        // avatar-listing z-index
        $(document).ready(function () {
            setTimeout(() => {
                $(".avatar-listing").each(function () {
                    const $avatar = $(this);
                    const $toggle = $avatar.find(".dropdown-toggle");

                    // On click of dropdown-toggle
                    $toggle.on("click", function () {
                        setTimeout(() => {
                            // Reset all avatar z-index first
                            $(".avatar-listing").css("z-index", "");

                            // If this dropdown is open (has .show class)
                            if ($(this).hasClass("show")) {
                                $avatar.css("z-index", "103");
                            }
                        }, 10); // slight delay to ensure .show is applied by Bootstrap
                    });
                });
            }, 3000);
        });
    </script>
    <script>
        // avatar-listing
        $(document).ready(function () {
            $('.avatar-listing .fa-star').on('click', function () {
                $(this).toggleClass('fa-regular fa-solid');
            });

            $('.avatar-listing select.select-style-2').on('change', function () {
                const $button = $(this).next('button');
                alert($button)
                if ($button.attr('title') === 'Deactive') {
                    $button.addClass('deactive-button').removeClass('active-button');
                } else {
                    $button.addClass('active-button').removeClass('deactive-button');
                }
            });

            $('.avatar-listing select.select-style-2').each(function () {
                const $button = $(this).next('button');
                if ($button.attr('title') === 'Deactive') {
                    $button.addClass('deactive-button').removeClass('active-button');
                } else {
                    $button.addClass('active-button').removeClass('deactive-button');
                }
            });
        });
    </script>


    <script>
        $(document).on('click', function (event) {
            if (!$(event.target).closest('.template-list').length) {
                $('.template-list').removeClass('active');
            }
        });
        setTimeout(() => {
            $('.template-list').on('click', function (event) {
                // $('.templates-card .template-list').removeClass('active');
                $('.template-list').not(this).removeClass('active');
                $(this).toggleClass('active');
                event.stopPropagation();
            });
        }, 1000);

        setTimeout(() => {
            $('.active-non-active-select .dropdown.bootstrap-select').addClass('active');
            $('#checkactive').on('change', function () {
                $('.active-non-active-select .dropdown.bootstrap-select').removeClass('active');
                if ($(this).val() == 'active') {
                    $('.active-non-active-select .dropdown.bootstrap-select').addClass('active');
                }
            })
        }, 1000);

        function setLabelList(autoresponder_ids, list_id) {
            $(".list_id").remove();
            responderLoader(true);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('autoresponder_forms'); ?>',
                data: {
                    'autoresponder_id': autoresponder_ids
                },
                dataType: 'json',
                success: function (response) {
                    responderLoader(false);
                    $.each(response, function (index, value) {
                        var autoresponderSet = (list_id == value.listid) ? 'selected' : '';
                        $(".responder_form_option").after("<option class='list_id' value='" + value.listid + "' " + autoresponderSet + ">" + value.title + "</option>");
                    });
                    setTimeout(function () {
                        $('.selectpicker').selectpicker('refresh')
                    }, 500);
                }
            });
        }

        function responderLoader(flag) {
            if (flag === undefined) {
                flag = false;
            }
            $(".temp_js_loader").remove();
            if (flag) {
                $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $assetsFolder; ?>images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;width:5%"></div>');
            }
        }
    </script>

    <script>
        // Define the AngularJS application
        var app = angular.module('AppModule', []);

        app.filter('customDate', function () {
            return function (input) {
                if (!input) return '';
                var date = new Date(input);
                return date.getDate().toString().padStart(2, '0') + '-' + (date.getMonth() + 1).toString().padStart(2, '0') + '-' + date.getFullYear();
            };
        });




        app.controller('visController', function ($scope, $http) {
            // Initialize the tabs array
            // $scope.allList = <?php echo json_encode($assistants); ?>;
            $scope.workspacelist = <?php echo json_encode($workspaceData); ?>;
            // console.log("worksapce" , $scope.workspacelist);

            // $scope.filter = { $: undefined }; 
            $scope.setFilter = function () {
                $scope.filter = {};
                $scope.filter[$scope.list.text || '$'] = $scope.searchQuery;
            };

            $scope.getAvatarMadeList = function () {
                var queryStr = "<?php echo base_url('get-editor-list') ?>";
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
            $scope.getAvatarMadeList();
            $scope.getShortTitle = function (title, limit) {
                title = title || '';
                return title.length > limit ? title.substring(0, limit) + '...' : title;
            };
           
            $scope.historyVideos = [];

            $scope.fetchHistory = function () {
                var queryStr = "<?php echo base_url('get_video_history') ?>";
            
                $http({
                    method: 'GET',
                    url: queryStr
                }).then(function (response) {
            
                    if (response.data.status == true) {
                        $scope.historyVideos = response.data.data;
                    }
            
                });
            };
            
            $scope.fetchHistory();
            
            
            
            
            
            
            

            $scope.gettitle = function (id) {
                var queryStr = "<?php echo base_url('get-title') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        id: id
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log(response.data);
                    if (response.data.status == true) {
                        $scope.title_id = response.data.videotitle.id;
                        $scope.project_name = response.data.videotitle.title;
                    } else {
                        $scope.project_name = response.data.videotitle.title;
                        // console.log($scope.avatarList);
                    }
                });
            };







            $scope.getFramIfram = function (width, height) {

                //$("#pLModal").modal('show');
                window.location.href = "<?php echo base_url() ?>goto-editor?id=" + $scope.videoId + "&width=" + width + "&height=" + height;
            }

            $scope.goTovideoEditor = function (width, height) {
                window.location.href = "<?php echo base_url() ?>goto-editor?id=" + $scope.videoId + "&width=" + width + "&height=" + height;
            }


            $scope.updatetitle = function () {
                var data = {
                    access_token: "<?php echo $access_token ?>",
                    id: $scope.title_id,
                    title: $scope.project_name,
                };
                console.log(data)
                var queryStr = "<?php echo base_url('kdmvideoeditor/update-title-editor') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param(data),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    $('#renameModal').modal('hide');
                    $scope.getAvatarMadeList();
                    // window.location.href ="<?php //echo base_url($this->config->item('prefix_video_route').'/video-editor'); 
                    ?>"
                });
            }

            // $scope.crateStudio = function(id,url) {
            //     var videoElement = document.getElementById('videoPreview');
            //     var videoSource = document.getElementById('videoSource');
            //     var hiddenInput = document.getElementById('videoId');
            //     if (url) {
            //         videoSource.src = url;
            //         videoElement.load();  
            //         videoElement.play();  
            //     }
            //     hiddenInput.value = id;
            //     $scope.videoId = id
            //     $("#videoPrModal").modal('show');
            // }

            $scope.crateStudio = function (id, url) {
                var videoElement = document.getElementById('videoPreview');
                var videoSource = document.getElementById('videoSource');
                var hiddenInput = document.getElementById('videoId');
                var editLink = document.getElementById('editVideoLink');

                if (url) {
                    videoSource.src = url;
                    videoElement.load();
                    videoElement.play();
                }

                hiddenInput.value = id;
                $scope.videoId = id;

                // Update link with video ID as query param
                editLink.href = "<?php echo base_url('edit-video-template/'); ?>" + encodeURIComponent(id);

                $("#videoPrModal").modal('show');
            }


            $scope.crateavatarStudio = function (id, url) {
                var videoElement = document.getElementById('avatarvideoPreview');
                var videoSource = document.getElementById('avatarvideoSource');
                var hiddenInput = document.getElementById('videoId');

                if (url) {
                    videoSource.src = url;   // ✅ correct source element
                    videoElement.load();
                }

                hiddenInput.value = id;
                $scope.videoId = id;

                var modalEl = document.getElementById('videoPrModalavatar');
                var modal = new bootstrap.Modal(modalEl);

                // ✅ Play ONLY after modal is fully shown
                modalEl.addEventListener('shown.bs.modal', function () {
                    videoElement.play();
                }, { once: true });

                modal.show();
            };
            
            
            $scope.playHistoryVideo = function(id, url) {

                var videoPlayer = document.getElementById('historyModalPlayer');
                var videoSource = document.getElementById('historyModalSource');
            
                if (url && videoPlayer && videoSource) {
            
                    videoSource.src = url;
                    videoPlayer.load();
            
                    $scope.historyVideoId = id;
            
                    var modalInstanceEl = document.getElementById('historyPreviewModal');
                    var bootstrapModal = new bootstrap.Modal(modalInstanceEl);
            
                    modalInstanceEl.addEventListener('shown.bs.modal', function () {
                        videoPlayer.play();
                    }, { once: true });
            
                    bootstrapModal.show();
                }
            };
            

            $scope.goToCustomEditor = function() {
            
                if ($scope.historyVideoId) {
            
                    window.location.href =
                        "<?php echo base_url(); ?>goto-editor?id=" +
                        $scope.historyVideoId +
                        "&width=1920&height=1080";
            
                } else {
            
                    alert("Video ID not found");
            
                }
            };

          $scope.downloadFile = function(url, extension) {
                if (!url) {
                    toastr.error("Video URL not found.");
                    return;
                }
                fetch(url)
                    .then(response => response.blob())
                    .then(blob => {
                        const blobUrl = window.URL.createObjectURL(blob);
            
                        const link = document.createElement("a");
                        link.href = blobUrl;
                        link.download = "video." + extension;
            
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
            
                        window.URL.revokeObjectURL(blobUrl);
                    })
                    .catch(error => {
                        console.error(error);
                        toastr.error("Unable to download file.");
                    });
            };
        
  
    
        
            $scope.deleteHistoryItem = function(id) {
            
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This video will be deleted permanently.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DB1A1A',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
            
                    if (result.isConfirmed) {
                        $scope.executeDelete(id);
                    }
            
                });
            
            };

            $scope.executeDelete = function(id) {
            
                var queryStr = "<?php echo base_url('delete_history_video')?>";
            
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: id }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function(response) {
            
                    if(response.data.status) {
            
                        toastr.success(
                            response.data.msg || "Video deleted successfully."
                        );
            
                        $scope.fetchHistory();
            
                    } else {
            
                        toastr.error(
                            response.data.msg || "Failed to delete video."
                        );
            
                    }
            
                }, function() {
            
                    toastr.error("Something went wrong. Please try again.");
            
                });
            };

            $scope.getdraftvideo = function () {
                var queryStr = "<?php echo base_url('get-editor-draft-list') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    if (response.data.status == true) {
                        $scope.draftList = response.data;
                    } else {
                        $scope.draftList = response.data;
                        console.log($scope.draftList);
                    }
                });
            };
            $scope.getdraftvideo();


            $scope.project_name = "";

            $scope.createNewVideo = function () {
                if ($scope.project_name == "") {
                    flashNow({
                        'error': {
                            'message': "Please enter the name of the video before processing."
                        }
                    });
                    return
                }
                var data = {
                    project_name: $scope.project_name,
                };
                var queryStr = "<?php echo base_url('create-new-project') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param(data),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    window.location.href = "<?php echo base_url($this->config->item('prefix_video_route') . '/video-editor'); ?>"
                });
            }




            $scope.copyContentScript = function (id, script, embed_script) {
                $singleTone_id = $scope.base32Encode('luckygautam-' + id);
                $view = '<?php echo site_url('stand_alone_script'); ?>' + '/' + $singleTone_id

                if (script == null) {
                    toastr.error("Please complete the All step by clicking the Edit button!")
                } else {
                    $('#modalMessage').text(script);
                    $('#modalMessageEmbeded').text(embed_script);
                    $('#modalMessageStand').text($view);

                    $scope.shareid = $view;
                    $scope.$apply();
                    $('#vaMessageModal').modal('show');
                    navigator.clipboard.writeText(script);
                    // toastr.info('Embed Script Copied Successfully');
                }
            }

            //  $scope.copyContentScript();

            $scope.copyContentScriptE = function () {

                let text = $('#modalMessageEmbeded').text();
                navigator.clipboard.writeText(text);
                toastr.info('Content copied to clipboard');
            }

            $scope.copyContentStand = function () {
                let text = $('#modalMessageStand').text();
                navigator.clipboard.writeText(text);
                toastr.info('Content copied to clipboard');
            }


            $scope.generateShareLink = function (id, script) {
                $singleTone_id = $scope.base32Encode('luckygautam-' + id);
                $view = '<?php echo site_url('stand_alone_script'); ?>' + '/' + $singleTone_id
                if (script == null) {
                    toastr.error("Please complete the All step by clicking the Edit button!")
                    $scope.shareid = "";
                    $scope.$apply();
                } else {
                    $scope.shareid = $view;
                    $scope.$apply();
                }
            }



            $scope.copyContent = function () {
                let text = $('#modalMessage').text();
                navigator.clipboard.writeText(text);
                toastr.info('Content copied to clipboard');
            }

            // $scope.copyContent = async (text) => {
            //     alert('hello');
            //     try {
            //         let text = $('#modalMessage').text();
            //         await navigator.clipboard.writeText(text);
            //         toastr.info('Content copied to clipboard');
            //     } catch (err) {
            //         console.error('Failed to copy: ', err);
            //     }
            // }

            $scope.copyShareStand = function () {
                navigator.clipboard.writeText($scope.shareid);
                toastr.info('Content copied to clipboard');
            }


            $scope.deleteAvt = function (id) {
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

            $scope.softDelete = function (listid) {
                var video_id = listid;
                var fd = new FormData();
                fd.append('video_id', video_id);
                $http({
                    method: 'POST',
                    url: siteUrl + 'delete-editor-video',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function (response) {
                    if (response.data.status == true) {
                        toastr.success(response.data.msg);
                        $scope.getAvatarMadeList();
                        $scope.getdraftvideo();
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }


            $scope.addvideotoWorkSpace = function (listid, workspaceid, name, url) {
                var listid = listid;
                var business_id = workspaceid;
                var name = name
                var url = url

                var fd = new FormData();
                fd.append('list_id', listid);
                fd.append('business_id', business_id);
                fd.append('name', name);
                fd.append('status', status);

                $http({
                    method: 'POST',
                    url: siteUrl + 'addvideo-workspace',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function (response) {
                    if (response.data.status == true) {
                        toastr.success(response.data.msg);
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }

            //status change active or inactive

            $scope.StatusChange = function (status, id) {
                jsLoader(true);
                var prompt_id = id;
                var fd = new FormData();
                fd.append('status', status);
                fd.append('prompt_id', prompt_id);
                $http({
                    method: 'POST',
                    url: '/virtual-assistant-v1/embed_status_change',
                    async: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function (response) {
                    jsLoader(false);
                    if (response.data.status) {
                        toastr.success(response.data.msg);
                        location.reload();
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            };



            $scope.toggleStatus = function (avatar) {

                var starElement = angular.element(document.querySelector("#star_" + avatar.id));

                if (starElement.hasClass('far')) {
                    avatar.prompt_avatar_fav = 1;
                    starElement.removeClass('far').addClass('fas');
                } else {
                    avatar.prompt_avatar_fav = 0;
                    starElement.removeClass('fas').addClass('far');
                }
                $scope.updateStatus(avatar.id, avatar.prompt_avatar_fav);
            };

            $scope.updateStatus = function (avatarId, value) {
                var data = {
                    prompt_id: avatarId,
                    value: value
                };
                console.log(data);
                $http({
                    method: 'POST',
                    url: '<?php echo site_url('Remotion-video/updateFav-status'); ?>',
                    data: $.param(data),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    flashNow({
                        'success': {
                            'message': response.data.message
                        }
                    });
                }).catch(function (error) {
                    console.error('Error updating database:', error);
                });
            }

            $scope.generateStandAloneScript = function (id) {
                $singleTone_id = $scope.base32Encode('luckygautam-' + id);
                var data = {
                    prompt_id: $singleTone_id,
                };
                $http({
                    method: 'POST',
                    url: '<?php echo site_url('generateStandAloneScript'); ?>',
                    data: $.param(data),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log(response.data.embed_script.embed_script);

                }).catch(function (error) {
                    console.error('Error updating database:', error);
                });
            }



            $scope.base32Encode = function (data) {
                const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
                let binaryString = '';

                for (let i = 0; i < data.length; i++) {
                    const binaryChar = data.charCodeAt(i).toString(2).padStart(8, '0');
                    binaryString += binaryChar;
                }

                const fiveBitChunks = binaryString.match(/.{1,5}/g) || [];
                let base32 = '';

                for (let chunk of fiveBitChunks) {
                    chunk = chunk.padEnd(5, '0');
                    base32 += alphabet[parseInt(chunk, 2)];
                }

                while (base32.length % 8 !== 0) {
                    base32 += '=';
                }

                return base32;
            };


            $scope.show_msg = function (msg) {
                flashNow({
                    'error': {
                        'message': msg
                    }
                });
            };




            //  avatar functions
            $scope.getAvatardata = function () {
                var data = {
                    avatar_type: "",
                    favourite: ""
                    // avatar_type: $scope.avatarDetails.avtar.avatar_type || "",
                    // favourite: $scope.avatarDetails.avtar.favourite || ""
                };

                // if (data.avatar_type !== "" || data.favourite !== "") {
                //         $scope.isFiltered = true;
                //     } else {
                //         $scope.isFiltered = false;
                //     }

                // console.log('test',data);
                // console.log('filter',$scope.isFiltered);

                var queryStr = "<?php echo base_url('get-getAvatarMadeList') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param(data),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log('response', response);
                    if (response.data.status == true) {
                        $scope.avatardata = response.data;
                        $scope.loaderImagePath = "<?php echo $this->config->item('assetsPath') ?>default/images/avatar_loder.gif";
                        $scope.startGeneratingVideos();
                    } else {
                        $scope.avatardata = response.data;

                    }
                });
            };
            $scope.getAvatardata();

            $scope.startGeneratingVideos = function () {

                $scope.avatardata.avatarListingMade.forEach(function (avatar) {
                    if (avatar.avatar_id) {

                        $scope.getGeneratevAvtarVideoById(avatar.id, avatar.avatar_id, avatar.url, avatar.avatar_type);
                    }
                });
            };


            $scope.getGeneratevAvtarVideoById = function (id, video_id, url, avatar_type) {
                console.log('hello');

                var queryStr = "<?php echo base_url('get-generated-avatar-video') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                    data: {
                        'id': id,
                        'avtar_video_id': video_id,
                        'url': url,
                        'avatar_type': avatar_type
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    // console.log('test', response);
                    if (response.data == 'true') {
                        $scope.getAvatarMadeList();
                        $scope.getAvatardata();
                    }
                });


            }


            setInterval(function () {
                $scope.startGeneratingVideos();
            }, 5000);


            $scope.deleteAvtarvideo = function (id) {
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
                        $scope.softDeleteavatar(id);
                    }
                });
            };

            $scope.softDeleteavatar = function (listid) {
                var video_id = listid;
                var fd = new FormData();
                fd.append('video_id', video_id);
                $http({
                    method: 'POST',
                    url: siteUrl + 'soft-delete',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function (response) {
                    if (response.data.status == true) {
                        toastr.success(response.data.msg);
                        $scope.getAvatarMadeList();
                        $scope.getAvatardata();
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }


            $scope.getAvatartitle = function (id) {
                $('#avatarrenameModal').modal('show');
                var queryStr = "<?php echo base_url('get-avatar-title') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: id }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    // console.log(response.data);
                    if (response.data.status == true) {
                        $scope.title_id = response.data.avatartitle.id;
                        $scope.avatar_name = response.data.avatartitle.title;
                    } else {
                        $scope.avatar_name = response.data.avatartitle.title;
                        // console.log($scope.avatarList);
                    }
                });
            };

            $scope.updateavatartitle = function () {
                var data = {
                    id: $scope.title_id,
                    title: $scope.avatar_name,
                };
                // console.log(data)
                var queryStr = "<?php echo base_url('update-title') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param(data),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    $('#avatarrenameModal').modal('hide');
                    $scope.getAvatarMadeList();
                    $scope.getAvatardata();
                    // window.location.href ="<?php //echo base_url($this->config->item('prefix_video_route').'/video-editor'); ?>"
                });
            }

            $scope.addgptWorkSpace = function (listid, workspaceid, name, url) {
                var listid = listid;
                var business_id = workspaceid;
                var name = name
                var url = url

                var fd = new FormData();
                fd.append('list_id', listid);
                fd.append('business_id', business_id);
                fd.append('name', name);
                fd.append('status', status);

                $http({
                    method: 'POST',
                    url: siteUrl + 'addworkspace-video',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function (response) {
                    if (response.data.status == true) {
                        toastr.success(response.data.msg);
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }

            $scope.hasCreated = function () {
                return $scope.avatarList?.avatarListingMade?.length > 0;
            };

            $scope.hasAvatar = function () {
                return $scope.avatardata?.avatarListingMade?.length > 0;
            };

            $scope.hasDraft = function () {
                return $scope.draftList?.draftvideoListing?.length > 0;
            };
            $scope.hasAiVideos = function () {
                return $scope.historyVideos && $scope.historyVideos.length > 0;
            };

        });
        
        
        $(document).ready(function () {

        const params = new URLSearchParams(window.location.search);
        const activeTab = params.get('tab');
    
        if (activeTab === 'ai-video') {
    
            setTimeout(function () {
    
                const aiTab = document.getElementById('pills-ai-video-tab');
    
                if (aiTab) {
                    aiTab.click();
                }
    
            }, 1000);
        }

});
    </script>