<?php
$autoresponders_image_folder = $assetsFolder . 'images/integration/';
$autoresponder_all = json_decode($autoresponder_profile);
$autoresponders = $autoresponder_all->autoresponder;
$all_crm = $autoresponder_all->crm;
$all_webinar = $autoresponder_all->webinar;
$all_workflow = $autoresponder_all->workflow;
$payment_methods = $autoresponder_all->payment;
$all_contentprovider = $autoresponder_all->contentprovider;
$all_pinecone = $autoresponder_all->pinecone;


if (!isset($active_tab)) {
    $active_tab = 'youtube';
}
if (!isset($active_pos)) {
    $active_pos = false;
}
if ($this->session->userdata('active_tab') && $this->session->userdata('active_pos')) {
    $active_pos = $this->session->userdata('active_pos');
    $active_tab = $this->session->userdata('active_tab');
}
if ($this->session->flashdata('active_tab')) {
    $active_tab = $this->session->flashdata('active_tab');
}
if ($this->session->flashdata('active_pos')) {
    $active_pos = $this->session->flashdata('active_pos');
}

if ($this->input->get('tab')) {
    $active_tab = $this->input->get('tab');
}
if ($this->input->get('pos')) {
    $active_pos = $this->input->get('pos');
}
$this->session->unset_userdata('active_tab');
$this->session->unset_userdata('active_pos');


if ($this->session->flashdata('social_error')) {
    $social_error = $this->session->flashdata('social_error');
} else {
    $social_error = false;
}
?>

<style>
    .tab-box img{
        max-width: 50px;
    }
    .cancelbutton {
    position: absolute;
    top: 0;
    right: 0;
    }
    ul.dropdown-menu {
    /* min-width: 300px; */
    overflow-y: scroll;
    }
    /* .theme-btn-blue {
    border-radius: 10px;
    background: var(--blue-gradient);
    color: var(--white-color);
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    padding: 15px 30px;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    } */
    /* .tabs-banner{
        background:var(--theme-color);
        border-radius:5px;
        padding:10px;
    } */
    .tabs-banner ul li button{
        list-style:none;
        display:inline-block;
        padding:7px 15px;
        cursor:pointer;
        font-weight:400;
        border-radius:2px !important;
    }
    .tabs-banner ul li button:focus-visible{
        outline: 0 !important;    
    }
    .tabs-banner ul .active{
        background:var(--theme-br2) !important;
        border-radius:4px !important;
        color: #fff !important;
        font-weight : 400 !important;
    }
    .search-icon{
        top: 50%;
        transform: translateY(-50%);
    }
</style>
<!-- Container Start -->
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="addIntegration">
   <title><?php echo $this->config->item('productName') ?> | Integration</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" style=" min-height: calc(93vh);">
        <div class="row d-flex align-items-center">
            <div class="col-12">
                <div class="feature-banner">
                    <div class="row align-items-center justify-content-between g-0">
                        <div class="col-auto feature-wrap">
                            <h5 class="feature-title">Integrations</h5>
                            <p class="feature-subtitle mb-0">Here you can manage integrations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row mt10">
            <div class="col-md-12 col-12">
                <form action="<?= base_url('integration') ?>" method="post" class="mb-0">
                    <div class="search-bar">
                        <input type="hidden" ng-model="actab" name="tabed" ng-value="actab">
                        <input type="text" name="search" class="form-control" placeholder="Search.." ng-value="searchVal">
                        <button type='submit' style="background:transparent;border: none;" title="search" class="search-icon">
                            <span class="icon-search"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>-->
        <div class="row mt10">
            <div class="col-md-12 col-12">
                <div class="tabs-banner">
                    <ul class="nav nav-pills integration-pills d-block" id="pills-tab" role="tablist">
                         <!-- <li class="nav-item p-0" role="presentation">
                            <button class="nav-link <?php echo $active_tab == "facebook" ? 'active' : ''; ?>" ng-click="setActiveTab('facebook')" id="pills-facebook-tab" data-bs-toggle="pill" data-bs-target="#pills-facebook" type="button" role="tab" aria-controls="facebook" aria-selected="false">Facebook</button>
                        </li>
                         <li class="nav-item p-0" role="presentation">
                            <button class="nav-link <?php echo $active_tab == "insta" ? 'active' : ''; ?>" ng-click="setActiveTab('insta')" id="pills-insta-tab" data-bs-toggle="pill" data-bs-target="#pills-insta" type="button" role="tab" aria-controls="insta" aria-selected="false">Instagram</button> -->
                        </li>
                        <li class="nav-item p-0" role="presentation">
                            <button class="nav-link <?php echo $active_tab == "youtube" ? 'active' : ''; ?>" ng-click="setActiveTab('youtube')" id="pills-youtube-tab" data-bs-toggle="pill" data-bs-target="#pills-youtube" type="button" role="tab" aria-controls="youtube" aria-selected="false">YouTube</button>
                        </li>
                        <!--<li class="nav-item p-0" role="presentation">
                            <button class="nav-link <?php echo $active_tab == "autoresponder" ? 'active' : ''; ?>" ng-click="setActiveTab('autoresponder')" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#autoresponder" type="button" role="tab" aria-controls="autoresponder" aria-selected="true">Autoresponder</button>
                        </li>
                        <li class="nav-item p-0" role="presentation">
                            <button class="nav-link <?php echo $active_tab == "webinar" ? 'active' : ''; ?>"  ng-click="setActiveTab('webinar')" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Webinar</button>
                        </li>
                        <li class="nav-item p-0" role="presentation">
                            <button class="nav-link <?php echo $active_tab == "workflow" ? 'active' : ''; ?>"  ng-click="setActiveTab('workflow')" id="pills-workflow-tab" data-bs-toggle="pill" data-bs-target="#pills-workflow" type="button" role="tab" aria-controls="workflow" aria-selected="false">Workflow Automation</button>
                        </li>-->
                        <!--<li class="nav-item p-0" role="presentation">-->
                            <!--<button class="nav-link <?php echo $active_tab == "crm" ? 'active' : ''; ?>" ng-click="setActiveTab('crm')" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#crm" type="button" role="tab" aria-controls="crm" aria-selected="false">CRM</button>-->
                        <!--</li>-->
                        <!--  <li class="nav-item" role="presentation">-->
                            <!--<button class="nav-link <?php echo $active_tab == "social" ? 'active' : ''; ?>" ng-click="setActiveTab('social')" id="pills-social-tab" data-bs-toggle="pill" data-bs-target="#pills-social" type="button" role="tab" aria-controls="pills-content-provider" aria-selected="false">Social</button>-->
                        <!--</li>-->
                        <!-- <li class="nav-item p-0" role="presentation">-->
                        <!--    <button class="nav-link <?php echo $active_tab == "contentprovider" ? 'active' : ''; ?>" ng-click="setActiveTab('contentprovider')" id="pills-contentprovider-tab" data-bs-toggle="pill" data-bs-target="#pills-contentprovider" type="button" role="tab" aria-controls="contentprovider" aria-selected="false">Content Provider</button>-->
                        <!--</li>-->
                         
                        <!--<li class="nav-item p-0" role="presentation">-->
                        <!--    <button class="nav-link <?php echo $active_tab == "pinecone" ? 'active' : ''; ?>" ng-click="setActiveTab('pinecone')" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pinecone" type="button" role="tab" aria-controls="pinecone" aria-selected="false">Pinecone</button>-->
                        <!--</li>-->
                       
                        <!--<li class="nav-item" role="presentation">-->
                        <!--    <button class="nav-link <?php echo $active_tab == "social" ? 'active' : ''; ?>" id="pills-social-tab" data-bs-toggle="pill" data-bs-target="#pills-social" type="button" role="tab" aria-controls="pills-content-provider" aria-selected="false">Social</button>-->
                        <!--</li>-->
                        <!--<li class="nav-item" role="presentation">-->
                        <!--    <button class="nav-link <?php echo $active_tab == "advertisement" ? 'active' : ''; ?>" id="pills-drive-tab" data-bs-toggle="pill" data-bs-target="#pills-drive" type="button" role="tab" aria-controls="pills-drive" aria-selected="false">Advertisement</button>-->
                        <!--</li>-->
                        <!--<li class="nav-item" role="presentation">-->
                        <!--    <button class="nav-link <?php echo $active_tab == "payment" ? 'active' : ''; ?>" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">Payment</button>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tab-content" id="pills-tabContent">
                
                 <!---- Autoresponder Tab Starts ------>
                <?php include_once('autoresponder_integration_settings.php'); ?>
                <!---- Autoresponder Tab Ends ------>
                
                <!---- Webinar Tab Starts ------>
                <?php 
                    include_once('webinar_integration_settings.php');
                ?>
                <!---- Webinar Tab Ends ------>
                <!---- Webinar Tab Starts ------>
                <?php 
                    include_once('workflow_automation_settings.php');
                ?>
                <!---- Webinar Tab Ends ------>                
                <!---- CRM Tab Starts ------>
                <?php include_once('crm_integration_settings.php'); ?>
                <!---- CRM Tab Ends ------>

                <!---- Social Tab Starts ------>
                <?php include_once('contentprovider_integration_settings.php'); ?>
                <!---- Social Tab Ends ------>
                
                <!---- Social Tab Starts ------>
                <?php include_once('pinecone_integration_settings.php'); ?>
                <!---- Social Tab Ends ------>

                <!---- Advertisement Tab Starts ------>
                <!--<?php //include_once('advertisement_integration_settings.php'); ?>-->
                <!---- Advertisement Tab Ends ------>

                <!---- Payment Method Tab Starts ------>
                <!--<?php //include_once('payment_integration_settings.php'); ?>-->
                <!---- Payment Method Tab Ends ------>
                
                  <!---- Social Tab Starts ------>
                <?php include_once('social_integration_settings.php'); ?>
                <!---- Social Tab Ends ------>
                  <!---- youtube Tab Starts ------>
                <?php include_once('youtube_intigration.php'); ?>
                <!---- youtube Tab Ends ------>
                <!---- instagram Tab Starts ------>
                <?php include_once('instagram_integration.php'); ?>
                <!---- instagram Tab Ends ------>
                
                <!---- instagram Tab Starts ------>
                <?php include_once('facebook_integration.php'); ?>
                <!---- instagram Tab Ends ------>
            
                
                
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="tab-main-head">Webinar</div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/1537164106.png" alt="GetGist" class="mx-auto d-block img-fluid">
                                <div class="mt10 tab-heading"> GoToWebinar</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md0">
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/demio-logo.png" alt="GetGist" class="mx-auto d-block img-fluid">
                                <div class="mt10 tab-heading"> Demio</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-content-provider" role="tabpanel" aria-labelledby="pills-content-provider">
                    <div class="tab-main-head">Content Provider</div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="tab-box">
                                <img src="https://cdn.staticdcp.com/assets/images/integration/pixabay.png" alt="GetGist" class="mx-auto d-block img-fluid">
                                <div class="mt10 tab-heading"> Pixabay</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md0">
                            <div class="tab-box">
                                <img src="https://cdn.staticdcp.com/assets/images/integration/pexels.png">
                                <div class="mt10 tab-heading"> Pexels</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md0">
                            <div class="tab-box">
                                <img src="https://cdn.staticdcp.com/assets/images/integration/shutterstock.png">
                                <div class="mt10 tab-heading"> Shutterstock</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-drive" role="tabpanel" aria-labelledby="pills-drive">
                    <div class="tab-main-head">Drives</div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="tab-box">
                                <img src="https://cdn.staticdcp.com/assets/images/integration/drive.png" alt="GetGist" class="mx-auto d-block img-fluid">
                                <div class="mt10 tab-heading"> Google Drive</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md0">
                            <div class="tab-box">
                                <img src="https://cdn.staticdcp.com/assets/images/integration/my-drive-dropbox.png">
                                <div class="mt10 tab-heading"> Dropbox</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md0">
                            <div class="tab-box">
                                <img src="https://cdn.staticdcp.com/assets/images/integration/onedrive.png">
                                <div class="mt10 tab-heading"> OneDrive</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment">
                    <div class="tab-main-head">Payment</div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/paypal.png" alt="GetGist" class="mx-auto d-block img-fluid">
                                <div class="mt10 tab-heading">PayPal</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md0">
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/stripe.png">
                                <div class="mt10 tab-heading">Stripe</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md0">  
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/paydotcom.png">
                                <div class="mt10 tab-heading"> PayDotCom</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md30">  
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/jvzoo.png">
                                <div class="mt10 tab-heading"> JVZoo</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md30">  
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/clickbank.png">
                                <div class="mt10 tab-heading"> ClickBank</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                         <div class="col-12 col-md-4 mt20 mt-md30">  
                            <div class="tab-box">
                                <img src="https://cdn.dotcompaltest.com/assets/images/integration/autoresponder_logo/warriorplus.png">
                                <div class="mt10 tab-heading">WarriorPlus</div>
                                <div class="mt10 tab-para">
                                    Not Integrated
                                </div>
                                <a href="#" class="theme-btn-blue mt20">Integrate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    
       
        var app = angular.module("AppModule", []);
        app.controller("addIntegration", function($scope, $http, $timeout) {
            $scope.popup_close = function(id)
            {
                 $("#user_popup"+id).removeClass("show");
            }
            
            $scope.actab = "<?php echo !empty($active_tab) ? $active_tab : autoresponder ?>".trim();
            $scope.searchVal = "<?php echo !empty($search) ? $search : '' ?>".trim();
            $scope.setActiveTab = function(actab) {
                $scope.actab = actab;
            }
            $scope.addIntegration = function() {
                $http({
                    method: 'POST',
                    url: 'addIntegration',
                    aync: false,
                    data: {
                        'api_key': $scope.field_name
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function(response) {
                    if (response.data.status == 1) {
                        $scope.field_name = "";
                        toastr.success(response.data.msg);
                    } else {
                        toastr.error(response.data.msg);
                    }
                });
            }
        });
    </script>