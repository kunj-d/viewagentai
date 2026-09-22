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

    .disabled-btn {
        pointer-events: none;
        opacity: 0.6;
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
 <div class="container-wrapper container-open" ng-app="AppModule" ng-controller="visController" ng-cloak>
     <title><?php echo $this->config->item('productName') ?> | Templates</title>
     <!-- Main Container Start -->
     <div class="container-fluid container-padding">
        <div class="row">
            <div class="col-12" ng-if="avatarList.avatarListingMade.length > 0">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="feature-banner">
                            <div class="row align-items-center justify-content-between g-0">
                                <div class="col-auto feature-wrap">
                                    <h5 class="feature-title">Create Videos Easily Using Ready-Made Templates.</h5>
                                    <p class="feature-subtitle mb-0">
                                        Edit a ready-made template and turn it into a video
                                    </p>
                                </div>
                                <!-- <div class="col-auto ms-auto">
                                    <a href="<?php echo base_url('upload-insta-video');?>" class=" btn btn-primary"><i class="fa-solid fa-plus"></i> Create New Post </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-end d-flex align-items-sm-center justify-content-between gap-2 flex-column flex-sm-row mb-3 mb-sm-4">
                        <div class="w-50">
                            <div class="search-bar right-icon">
                                <div class="search-icon">
                                    <span class="icon-search"></span>
                                </div>
                                <input type="text" class="search form-control" placeholder="Search Templates" autocomplete="off" id="searchText" ng-model="searchQuery">
                            </div>
                        </div>
                        <!-- Landscape And Portrait Tabs Button -->
                        <div class="d-flex align-items-center gap-3">
                            <ul class="nav nav-pills nav-pills-style-2 nav-pills-with-gradient" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-portrait-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait" type="button" role="tab" aria-controls="pills-portrait" aria-selected="false">Portrait</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-landscape-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape" type="button" role="tab" aria-controls="pills-landscape" aria-selected="true">Landscape</button>
                                </li>
                            </ul>
                        </div>
                        <!-- Landscape And Portrait Tabs Button -->
                        <!-- <div class="d-flex align-items-center gap-3">
                            <a href="javascript:void(0)" class="btn btn-outline btn-outline-white">Create Using Template</a>
                            <a href="#" class=" btn btn-primary"  data-bs-toggle="modal" data-bs-target="#insertNameModal" >Create New Video</a>
                            <a href="<?= base_url($this->config->item('prefix_video_route').'/video-editor'); ?>" class=" btn btn-primary" >Create New Video</a>
                        </div> -->
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade  show active" id="pills-portrait" role="tabpanel" aria-labelledby="pills-portrait-tab" tabindex="0">
                        <div class="slider-wrapper mb-3 mb-sm-4">
                            <!-- Left Scroll Button -->
                            <button class="slide-btn left" onclick="scrollTabsLeft()"><i class="fa-solid fa-angle-left"></i></button>

                            <div class="overflow-auto scrollbar-thin px-4 scrollableTabWrapper">
                                <ul class="nav nav-pills nav-pills-style-1 nav-pills-with-gradient gap-0 flex-nowrap block-size" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-portrait-all-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-all" type="button" role="tab" aria-controls="pills-portrait-all" aria-selected="true">All</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-plain-bg-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-plain-bg" type="button" role="tab" aria-controls="pills-portrait-plain-bg" aria-selected="false">Plain bg</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-advertisement-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-advertisement" type="button" role="tab" aria-controls="pills-portrait-advertisement" aria-selected="false">Advertisement</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-ecommerce-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-ecommerce" type="button" role="tab" aria-controls="pills-portrait-ecommerce" aria-selected="false">Ecommerce</button>
                                    </li>
                                    
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-doctor-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-doctor" type="button" role="tab" aria-controls="pills-portrait-doctor" aria-selected="false">Doctor</button>
                                    </li>
                                    
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-food-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-food" type="button" role="tab" aria-controls="pills-portrait-food" aria-selected="false">Food</button>
                                    </li>
                                    
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-real_estate-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-real_estate" type="button" role="tab" aria-controls="pills-portrait-real_estate" aria-selected="false">Real Estate</button>
                                    </li>
                                    
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-learningDevelopment-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-learningDevelopment" type="button" role="tab" aria-controls="pills-portrait-learningDevelopment " aria-selected="false">Learning & Development</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-explainerVideo-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-explainerVideo" type="button" role="tab" aria-controls="pills-portrait-explainerVideo" aria-selected="false">Explainer Video</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-socialMedia-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-socialMedia" type="button" role="tab" aria-controls="pills-portrait-socialMedia" aria-selected="false">Social Media</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-businessCards-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-businessCards" type="button" role="tab" aria-controls="pills-portrait-businessCards" aria-selected="false">Business Cards</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-healthMedical-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-healthMedical" type="button" role="tab" aria-controls="pills-portrait-healthMedical" aria-selected="false">Health & Medical</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-festival-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-festival" type="button" role="tab" aria-controls="pills-portrait-festival" aria-selected="false">Festival</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-bnews-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-bnews" type="button" role="tab" aria-controls="pills-portrait-bnews" aria-selected="false">Breaking News</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-portrait-other-tab" data-bs-toggle="pill" data-bs-target="#pills-portrait-other" type="button" role="tab" aria-controls="pills-portrait-other" aria-selected="false">Others</button>
                                    </li>
                                </ul>
                            </div>

                            <!-- Right Scroll Button -->
                            <button class="slide-btn right" onclick="scrollTabsRight()"><i class="fa-solid fa-angle-right"></i></button>
                        </div>
                        <div class="tab-content templates-wrapper">
                            <div class="tab-pane fade show active" id="pills-portrait-all" role="tabpanel" aria-labelledby="pills-portrait-all-tab" tabindex="0">
                                <!--portrait All-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitalldata | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <!--<div class="top-content d-flex align-items-center justify-content-end">-->
                                                    <!--<div class="d-flex gap-2">-->
                                                    <!--    <a class="d-inline-block" href="">-->
                                                    <!--        <i class="fas fa-star"></i>-->
                                                    <!--    </a>-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                 <div class="d-flex flex-column add-btn-group">
                                                    <!--<a  href="<?php // echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>-->
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <!--<a href="javascript:void(0);" class="avatar-link">{{avatar.title}}</a>-->
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                        <!-- <div class="play-badge">Play<i class="fa-solid fa-circle-play"></i></div> -->
                                                    </div>
                                                    <ul class="avatar-listing-icons d-none">
                                                        <!--<li 
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Copy Embed Code" 
                                                            data-bs-original-title="" 
                                                            title=""
                                                        >
                                                            <a data-bs-toggle="modal"><i class="fa-solid fa-copy"></i></a>
                                                        </li>->
                                                        
                                                        <!--<li -->
                                                        <!--    data-bs-toggle="tooltip" -->
                                                        <!--    data-bs-placement="top" -->
                                                        <!--    data-bs-custom-class="custom-tooltip" -->
                                                        <!--    data-bs-title="Share"  -->
                                                        <!--    data-bs-original-title="" title="">-->
                                                        <!--    <a data-bs-toggle="modal" data-bs-target="#shareModal">-->
                                                        <!--        <i class="fa-solid fa-share-from-square"></i>-->
                                                        <!--    </a>-->
                                                        <!--</li>-->

                                                        <!-- <li 
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Edit" 
                                                            data-bs-original-title="" title="">
                                                            <a href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        </li> -->

                                                        <!--<li class="template-list" -->
                                                        <!--    data-bs-toggle="tooltip" -->
                                                        <!--    data-bs-placement="top"-->
                                                        <!--    data-bs-custom-class="custom-tooltip" -->
                                                        <!--    data-bs-title="Add to Workspace" -->
                                                        <!--    data-bs-original-title=""-->
                                                        <!--    title="">-->
                                                        <!--    <a href="javascript:void(0);"><i class="fa-solid fa-file-import workspace-listing "></i></a>-->
                                                        <!--    <ul style="max-height: 160px; overflow-y: auto;">-->
                                                        <!--        <p class="mb-0">Add to Workspace</p>-->
                                                        <!--         <li ng-click="addgptWorkSpace(avatar.id, workspace.id ,avatar.title,avatar.url)" ng-repeat="workspace in workspacelist">-->
                                                        <!--        {{workspace.domain}}-->
                                                        <!--    </li>-->
                                                        <!--    </ul>-->
                                                        <!--</li>-->
                                                        <!--<li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"-->
                                                        <!--    data-bs-title="Delete" data-bs-original-title="" title="">-->
                                                        <!--    <a ng-click="deleteAvt(avatar.id)" style="color: #FF4B4B !important;">-->
                                                        <!--        <i class="fa-solid fa-trash-can"></i>-->
                                                        <!--    </a>-->
                                                        <!--</li>-->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-plain-bg" role="tabpanel" aria-labelledby="pills-portrait-plain-bg-tab" tabindex="0">
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitplainbg | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-advertisement" role="tabpanel" aria-labelledby="pills-portrait-advertisement-tab" tabindex="0">
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitadvertisement | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="tab-pane fade" id="pills-portrait-ecommerce" role="tabpanel" aria-labelledby="pills-portrait-ecommerce-tab" tabindex="0">
                                <!--portrait Ecommerce-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitecommerce | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="pills-portrait-doctor" role="tabpanel" aria-labelledby="pills-portrait-doctor-tab" tabindex="0">
                                <!--portrait Ecommerce-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitdoctor | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-food" role="tabpanel" aria-labelledby="pills-portrait-food-tab" tabindex="0">
                                <!--portrait Ecommerce-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitfood | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-real_estate" role="tabpanel" aria-labelledby="pills-portrait-real_estate-tab" tabindex="0">
                                <!--portrait Ecommerce-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitreal_estate | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="pills-portrait-learningDevelopment" role="tabpanel" aria-labelledby="pills-portrait-learningDevelopment-tab" tabindex="0">
                                <!--portrait Learning And Development-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitlearningdevelopment | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-explainerVideo" role="tabpanel" aria-labelledby="pills-portrait-explainerVideo-tab" tabindex="0">
                                <!--portrait Explainer Video-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitexplainervideo | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-socialMedia" role="tabpanel" aria-labelledby="pills-portrait-socialMedia-tab" tabindex="0">
                                <!--portrait Social Media-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitsocialmedia | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-businessCards" role="tabpanel" aria-labelledby="pills-portrait-businessCards-tab" tabindex="0">
                                <!--portrait Business Cards-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitbusinesscard | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-healthMedical" role="tabpanel" aria-labelledby="pills-portrait-healthMedical-tab" tabindex="0">
                                <!--portrait Health And Medical-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraithealthandmedical | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-festival" role="tabpanel" aria-labelledby="pills-portrait-festival-tab" tabindex="0">
                                <!--portrait Festival-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitfestival | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-bnews" role="tabpanel" aria-labelledby="pills-portrait-bnews-tab"  tabindex="0">
                                <!--portrait Breaking News-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitbrekingnews | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-portrait-other" role="tabpanel" aria-labelledby="pills-portrait-other-tab" tabindex="0">
                                <!--portrait Others-->
                                <div class="row row-cols-1 row-cols-md-5 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in portraitother | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-3">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
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
                    <div class="tab-pane fade" id="pills-landscape" role="tabpanel" aria-labelledby="pills-landscape-tab" tabindex="0">
                        <div class="slider-wrapper mb-3 mb-sm-4">
                            <!-- Left Scroll Button -->
                            <button class="slide-btn left" onclick="scrollTabsLeft()"><i class="fa-solid fa-angle-left"></i></button>

                            <div class="overflow-auto scrollbar-thin px-4 scrollableTabWrapper">
                                <ul class="nav nav-pills nav-pills-style-1 nav-pills-with-gradient gap-0 flex-nowrap block-size" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-landscape-all-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-all" type="button" role="tab" aria-controls="pills-landscape-all" aria-selected="true">All</button>
                                    </li>
                                    <!--<li class="nav-item" role="presentation">-->
                                    <!--    <button class="nav-link" id="pills-landscape-plain-bg-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-plain-bg" type="button" role="tab" aria-controls="pills-landscape-plain-bg" aria-selected="false">Plain Bg</button>-->
                                    <!--</li>-->
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-advertisement-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-advertisement" type="button" role="tab" aria-controls="pills-landscape-advertisement" aria-selected="false">Advertisement</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-ecommerce-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-ecommerce" type="button" role="tab" aria-controls="pills-landscape-ecommerce" aria-selected="false">Ecommerce</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-learningDevelopment-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-learningDevelopment" type="button" role="tab" aria-controls="pills-landscape-learningDevelopment " aria-selected="false">Learning & Development</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-explainerVideo-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-explainerVideo" type="button" role="tab" aria-controls="pills-landscape-explainerVideo" aria-selected="false">Explainer Video</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-socialMedia-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-socialMedia" type="button" role="tab" aria-controls="pills-landscape-socialMedia" aria-selected="false">Social Media</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-businessCards-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-businessCards" type="button" role="tab" aria-controls="pills-landscape-businessCards" aria-selected="false">Business Cards</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-healthMedical-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-healthMedical" type="button" role="tab" aria-controls="pills-landscape-healthMedical" aria-selected="false">Health & Medical</button>
                                    </li>
                                    <!--<li class="nav-item" role="presentation">-->
                                    <!--    <button class="nav-link" id="pills-landscape-festival-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-festival" type="button" role="tab" aria-controls="pills-landscape-festival" aria-selected="false">Festival</button>-->
                                    <!--</li>-->
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-bnews-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-bnews" type="button" role="tab" aria-controls="pills-landscape-bnews" aria-selected="false">Breaking News</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-landscape-other-tab" data-bs-toggle="pill" data-bs-target="#pills-landscape-other" type="button" role="tab" aria-controls="pills-landscape-other" aria-selected="false">Others</button>
                                    </li>
                                </ul>
                            </div>

                            <!-- Right Scroll Button -->
                            <button class="slide-btn right" onclick="scrollTabsRight()"><i class="fa-solid fa-angle-right"></i></button>
                        </div>
                        <div class="tab-content templates-wrapper">
                            <div class="tab-pane fade show active" id="pills-landscape-all" role="tabpanel" aria-labelledby="pills-landscape-all-tab" tabindex="0">
                                <!--Landscape All-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapealldata | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <!--<div class="top-content d-flex align-items-center justify-content-end">-->
                                                    <!--<div class="d-flex gap-2">-->
                                                    <!--    <a class="d-inline-block" href="">-->
                                                    <!--        <i class="fas fa-star"></i>-->
                                                    <!--    </a>-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                                <div class="d-flex flex-column add-btn-group">
                                                    <!--<a  href="<?php // echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>-->
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <!--<a href="javascript:void(0);" class="avatar-link">{{avatar.title}}</a>-->
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                        <!-- <div class="play-badge">Play<i class="fa-solid fa-circle-play"></i></div> -->
                                                    </div>
                                                    <ul class="avatar-listing-icons d-none">
                                                        <!--<li 
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Copy Embed Code" 
                                                            data-bs-original-title="" 
                                                            title=""
                                                        >
                                                            <a data-bs-toggle="modal"><i class="fa-solid fa-copy"></i></a>
                                                        </li>->
                                                        
                                                        <!--<li -->
                                                        <!--    data-bs-toggle="tooltip" -->
                                                        <!--    data-bs-placement="top" -->
                                                        <!--    data-bs-custom-class="custom-tooltip" -->
                                                        <!--    data-bs-title="Share"  -->
                                                        <!--    data-bs-original-title="" title="">-->
                                                        <!--    <a data-bs-toggle="modal" data-bs-target="#shareModal">-->
                                                        <!--        <i class="fa-solid fa-share-from-square"></i>-->
                                                        <!--    </a>-->
                                                        <!--</li>-->

                                                        <!-- <li 
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Edit" 
                                                            data-bs-original-title="" title="">
                                                            <a href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        </li> -->

                                                        <!--<li class="template-list" -->
                                                        <!--    data-bs-toggle="tooltip" -->
                                                        <!--    data-bs-placement="top"-->
                                                        <!--    data-bs-custom-class="custom-tooltip" -->
                                                        <!--    data-bs-title="Add to Workspace" -->
                                                        <!--    data-bs-original-title=""-->
                                                        <!--    title="">-->
                                                        <!--    <a href="javascript:void(0);"><i class="fa-solid fa-file-import workspace-listing "></i></a>-->
                                                        <!--    <ul style="max-height: 160px; overflow-y: auto;">-->
                                                        <!--        <p class="mb-0">Add to Workspace</p>-->
                                                        <!--         <li ng-click="addgptWorkSpace(avatar.id, workspace.id ,avatar.title,avatar.url)" ng-repeat="workspace in workspacelist">-->
                                                        <!--        {{workspace.domain}}-->
                                                        <!--    </li>-->
                                                        <!--    </ul>-->
                                                        <!--</li>-->
                                                        <!--<li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"-->
                                                        <!--    data-bs-title="Delete" data-bs-original-title="" title="">-->
                                                        <!--    <a ng-click="deleteAvt(avatar.id)" style="color: #FF4B4B !important;">-->
                                                        <!--        <i class="fa-solid fa-trash-can"></i>-->
                                                        <!--    </a>-->
                                                        <!--</li>-->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="pills-landscape-plain-bg" role="tabpanel" aria-labelledby="pills-landscape-plain-bg-tab" tabindex="0">
                                <!---------Plain Bg ------------->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapeplainbg | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                 <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="tab-pane fade" id="pills-landscape-advertisement" role="tabpanel" aria-labelledby="pills-landscape-advertisement-tab" tabindex="0">
                                <!---------Landscape Advertisement------------->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapeadvertisement | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <!--<a  href="<?php // echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>-->
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-ecommerce" role="tabpanel" aria-labelledby="pills-landscape-ecommerce-tab" tabindex="0">
                            <!--Landscape Ecommerce-->
                            <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapeecommerce | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-learningDevelopment" role="tabpanel" aria-labelledby="pills-landscape-learningDevelopment-tab" tabindex="0">
                            <!--Landscape Learning And Development-->
                            <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapelearningdevelopment | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-explainerVideo" role="tabpanel" aria-labelledby="pills-landscape-explainerVideo-tab" tabindex="0">
                            <!--Landscape Explainer Video-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapeexplainervideo | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-socialMedia" role="tabpanel" aria-labelledby="pills-landscape-socialMedia-tab" tabindex="0">
                            <!--Landscape Social Media-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapesocialmedia | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-businessCards" role="tabpanel" aria-labelledby="pills-landscape-businessCards-tab" tabindex="0">
                            <!--Landscape Business Cards-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapebusinesscard | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-healthMedical" role="tabpanel" aria-labelledby="pills-landscape-healthMedical-tab" tabindex="0">
                            <!--Landscape Health And Medical-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapehealthandmedical | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-festival" role="tabpanel" aria-labelledby="pills-landscape-festival-tab" tabindex="0">
                            <!--Landscape Festival-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapefestival | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-bnews" role="tabpanel" aria-labelledby="pills-landscape-bnews-tab" tabindex="0">
                            <!--Landscape Breaking News-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapebrekingnews| filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-landscape-other" role="tabpanel" aria-labelledby="pills-landscape-other-tab" tabindex="0">
                            <!--Landscape Others-->
                                <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2">
                                    <div class="col" ng-repeat="avatar in landscapeother | filter:searchQuery">
                                        <div class="avatar-listing avatar-listing-style-2">
                                            <img src="{{avatar.thumbnail_url}}" alt="image" class="avatar-listing-media">
                                            <div class="avatar-listing-inner">
                                                <div class="d-flex flex-column add-btn-group">
                                                    <?php if($team_edit_video) { ?>
                                                             <a  href="<?php  echo base_url('edit-default-video-template')?>/{{avatar.id}}" class="btn btn-white add-btn">Use Template</a>
                                                     <?php }else { ?>
                                                             <a  href="javascript:void(0);" ng-click="show_msg('You do not have permission to access Editor.')"class="btn btn-white add-btn">Use Template</a> 
                                                    <?php } ?>
                                                                                
                                                    <a  href="javascript:void(0);" class="btn add-btn text-white" ng-click="crateStudio(avatar.id,avatar.video_url)">Preview</a>
                                                </div>
                                                <div class="bottom-content">
                                                    <div class="avatar-flex-content">
                                                        <div class="sub-content">
                                                            <p class="avatar-link">{{avatar.title}}</p>
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
                </div>
            </div>
           
        </div>
     </div>
     
    <!-- Modal for Name title --> 
    <div class="modal fade" id="insertNameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content white shadow-lg">
            <div class="modal-header border-0 pb-0">
                <div>
                <h5 class="modal-title fw-semibold">Name Your Video</h5>
                <small class="theme-text-color">This title will be used for your new AI video.</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <input type="hidden" name="id" ng-model="title_id">
                <input 
                type="text" class="form-control text-white border-secondary rounded-3 mb-3"  placeholder="Enter Video Title"  name="project_name" ng-model="project_name">
                <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-outline btn-outline-white btn-no-style" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-no-style" ng-click="createNewVideo()">Create Video</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- videoPrModal -->
    <div class="modal fade video-pr-modal" id="videoPrModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px; max-height: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Template Preview</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-x: hidden;">
                    <input type="hidden" id="videoId" ng-model="videoId">
                    <video id="videoPreview" class="img-fluid mx-auto d-block" controls>
                        <source id="videoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="modal-footer justify-content-center gap-2">
                    <!-- <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Back</button> -->
                    <!--<button type="button" id="showpLModal" class="btn btn-primary" ng-click="getFramIfram()" >Customize in Editor</button>-->
                    <!--<a id="editVideoLink" href="#" class="btn btn-primary">Customize in Editor</a>-->
                    
                    <?php if($team_edit_video) { ?>
                         <a id="editVideoLink" href="#" class="btn btn-primary">Customize in Editor</a>
                     <?php }else { ?>
                          <a  href="#" class="btn btn-primary" ng-click="show_msg('You do not have permission to access Editor.')" >Customize in Editor</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- videoPrModal -->

     <!-- Modal for createAvatar -->
     
       <!-- <div class="modal fade" id="insertNameModal" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                <div class="modal-header align-items-start">
                    <div class="d-flex flex-column gap-2">
                        <h5 class="modal-title">AI Tube Avatar</h5>
                        <div class="std-btn">
                          
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 <div class="modal-body">
                    <div class="row row-gap">
                        <div class="col-sm-6">
                          <input type="text" plaseholder="Project name hear" name="project_name" ng-model="project_name"> 
                        </div>
                        <div class="col-sm-6">
                          <button type="button" class="btn btn-danger" ng-click="createNewVideo()"> Submit</button>
                        </div>
                    </div>
                 
                 </div>
             </div>
         </div>
     </div> -->
     <div class="modal fade" id="createAvatarModal" tabindex="-1" aria-labelledby="createAvatarModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                <div class="modal-header align-items-start">
                    <div class="d-flex flex-column gap-2">
                        <h5 class="modal-title">AI Tube Avatar</h5>
                        <div class="std-btn">
                            <span>See The Difference</span>
                            <i
                                class="fa-solid fa-circle-info ms-2 info-tooltip"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-custom-class="custom-tooltip"
                                data-bs-title="Select the email type with your audience’s needs.">
                            </i>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 <div class="modal-body">
                    <div class="row row-gap">
                        <div class="col-sm-6">
                            <a href="<?= base_url('talking-avatars'); ?>">
                                <div class="createAvatarModal-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="image">
                                    <p class="description">Create Photo Avatar</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= base_url('talking-avatars'); ?>?avatar_type=video">
                                <div class="createAvatarModal-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-video.png" alt="image">
                                    <p class="description">Create Video Avatar</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="std-wrapper">
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
                    </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Modal for createAvatar -->

     <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

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
              $('#checkactive').on('change',function(){
                $('.active-non-active-select .dropdown.bootstrap-select').removeClass('active');
                if( $(this).val() == 'active'){
                    $('.active-non-active-select .dropdown.bootstrap-select').addClass('active');
                }
           }) 
        }, 1000);
        
         function setLabelList(autoresponder_ids,list_id) {
            $(".list_id").remove(); 
            responderLoader(true); 
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('autoresponder_forms'); ?>',
                data: {'autoresponder_id': autoresponder_ids},
                dataType: 'json',
                success: function (response) { 
                    responderLoader(false);
                    $.each(response, function (index, value) {
                        var autoresponderSet = (list_id == value.listid) ? 'selected' : '';  
                        $(".responder_form_option").after("<option class='list_id' value='" + value.listid + "' "+autoresponderSet+">" + value.title + "</option>");
                    }); 
                    setTimeout(function(){ $('.selectpicker').selectpicker('refresh')}, 500);
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
        
        app.filter('customDate', function() {
            return function(input) {
                if (!input) return '';
                var date = new Date(input);
                return date.getDate().toString().padStart(2, '0') + '-' + (date.getMonth() + 1).toString().padStart(2, '0') + '-' + date.getFullYear();
            };
        });

        
        
        
        app.controller('visController', function ($scope, $http) {
            // Initialize the tabs array
            // $scope.allList = <?php echo json_encode($assistants); ?>;
            $scope.workspacelist = <?php echo json_encode($workspaceData); ?>;
                console.log($scope.workspacelist);
            
            // $scope.filter = { $: undefined }; 
            $scope.setFilter = function () {
                $scope.filter = {};
                $scope.filter[$scope.list.text || '$'] = $scope.searchQuery;
            };
            
            $scope.getAvatarMadeList = function () {
                var queryStr = "<?php echo base_url('get-template-list')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log(response.data);
                    if (response.data.status === true) {
                        // Set the full response object
                        $scope.avatarList = response.data;
                        $scope.filteravatarList = response.data.avatarListingMade;
                        $scope.filtertemplate();
                    } else {
                        $scope.avatarList = {};
                        $scope.filteravatarList = [];
                    }
                });
            };
            
            $scope.filtertemplate = function () {
            // filter data for landscape tab 
                const list = $scope.filteravatarList || [];
                $scope.landscapealldata = list.filter(item =>item.template_type === 'landscape');
                $scope.landscapeplainbg = list.filter(item =>item.template_type === 'landscape' && item.template_category === 'plain_bg');
                $scope.landscapeadvertisement = list.filter(item =>item.template_type === 'landscape' && item.template_category === 'advertisement');
                $scope.landscapeecommerce = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'ecommerce');
                $scope.landscapelearningdevelopment = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'learningdevelopment');
                $scope.landscapeexplainervideo = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'explainervideo');
                $scope.landscapesocialmedia = list.filter(item =>item.template_type === 'landscape' && item.template_category === 'socialmedia');
                $scope.landscapebusinesscard = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'businesscard');
                $scope.landscapehealthandmedical = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'healthandmedical');
                $scope.landscapefestival = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'festival');
                $scope.landscapebrekingnews = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'brekingnews');
                $scope.landscapeother = list.filter(item => item.template_type === 'landscape'&& item.template_category === 'other');

            // filter data for portrait tab 
            
                $scope.portraitalldata = list.filter(item =>item.template_type === 'portrait');
                $scope.portraitplainbg = list.filter(item =>item.template_type === 'portrait' && item.template_category === 'plain_bg');
                $scope.portraitadvertisement = list.filter(item =>item.template_type === 'portrait' && item.template_category === 'advertisement');
                $scope.portraitecommerce = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'ecommerce');
                $scope.portraitdoctor = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'doctor');
                $scope.portraitfood = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'food');
                $scope.portraitreal_estate = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'real_estate');
                $scope.portraitlearningdevelopment = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'learningdevelopment');
                $scope.portraitexplainervideo = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'explainervideo');
                $scope.portraitsocialmedia = list.filter(item =>item.template_type === 'portrait' && item.template_category === 'socialmedia');
                $scope.portraitbusinesscard = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'businesscard');
                $scope.portraithealthandmedical = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'healthandmedical');
                $scope.portraitfestival = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'festival');
                $scope.portraitbrekingnews = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'brekingnews');
                $scope.portraitother = list.filter(item => item.template_type === 'portrait'&& item.template_category === 'other');
            };
            
            $scope.filtertemplate();
            $scope.getAvatarMadeList();


                  
            
            $scope.createNewVideo = function() {
                 var data = {
                            project_name: $scope.project_name,
                        };
                var queryStr = "<?php echo base_url('create-new-project')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param(data),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    window.location.href ="<?php echo base_url($this->config->item('prefix_video_route').'/video-editor'); ?>"
                });
            }
            
             $scope.crateStudio = function(id, url) {
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
                editLink.href = "<?php echo base_url('edit-default-video-template/'); ?>" + encodeURIComponent(id);
            
                $("#videoPrModal").modal('show');
            }


        $scope.copyContentScript =  function(id,script , embed_script)
        {
             $singleTone_id = $scope.base32Encode('luckygautam-' +id);
              $view =  '<?php echo site_url('stand_alone_script'); ?>' + '/' +$singleTone_id
              
            if(script == null){
                toastr.error("Please complete the All step by clicking the Edit button!")
            } else
            {
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
        
         $scope.copyContentScriptE =  function()
        {
            
                let text =$('#modalMessageEmbeded').text();
                navigator.clipboard.writeText(text);
                toastr.info('Content copied to clipboard');
        }
        
         $scope.copyContentStand =  function()
        {   
                let text =$('#modalMessageStand').text();
                navigator.clipboard.writeText(text);
                toastr.info('Content copied to clipboard');
        }
        
        
         $scope.generateShareLink =  function(id,script) {
            $singleTone_id = $scope.base32Encode('luckygautam-' +id);
            $view =  '<?php echo site_url('stand_alone_script'); ?>' + '/' +$singleTone_id 
            if(script == null){
                toastr.error("Please complete the All step by clicking the Edit button!")
                $scope.shareid = "";
                $scope.$apply();
            } else { 
                $scope.shareid = $view;
                $scope.$apply(); 
            }
        }
        
        
        
        $scope.copyContent = function()
        {
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
        
        $scope.copyShareStand = function()
        {
            navigator.clipboard.writeText($scope.shareid);
             toastr.info('Content copied to clipboard');
        }
        

             $scope.deleteAvt = function(id) {
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
                    }).then(function(response) {
                        if (response.data.status == true) {
                            toastr.success(response.data.msg);
                          $scope.getAvatarMadeList();
                        } else if (response.data.error) {
                            toastr.error(response.data.error.msg);
                        } else {
                            toastr.error('Something went wrong');
                        }
                    });
                }
                
                
                $scope.addgptWorkSpace = function (listid, workspaceid,name,url) {
                    var listid = listid;
                    var business_id = workspaceid;
                    var name  = name
                    var url  =  url
                 
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
                        }).then(function(response) {
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

                $scope.StatusChange = function(status,id) {
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
                        }).then(function(response) {
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
                
                
                
                $scope.toggleStatus = function(avatar) {
              
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

                 $scope.updateStatus =  function(avatarId,value) {
                    var data = {
                        prompt_id: avatarId,
                        value: value
                    };
                    // console.log(data);
                    $http({
                        method: 'POST',
                        url:  '<?php echo site_url('avatar/updateFav-status'); ?>',
                        data: $.param(data),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function(response) {
                      flashNow({
                                'success': {
                                    'message': response.data.message
                                }
                     });
                    }).catch(function(error) {
                        console.error('Error updating database:', error);
                    });
                }
                        
        $scope.generateStandAloneScript =  function(id)
        {
               $singleTone_id = $scope.base32Encode('luckygautam-' +id);
              var data = {
                            prompt_id: $singleTone_id,
                        };
                    $http({
                        method: 'POST',
                        url:  '<?php echo site_url('generateStandAloneScript'); ?>',
                        data: $.param(data),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function(response) {
                        console.log(response.data.embed_script.embed_script);
                      
                    }).catch(function(error) {
                        console.error('Error updating database:', error);
                    });
        }
        
        
        
        $scope.base32Encode = function(data) {
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
                flashNow({'error': {'message': msg}});
            };   
                 
                


        });
        
        

    
    </script>