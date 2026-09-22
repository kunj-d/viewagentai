<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title><?php echo $this->config->item('productName') ?> | Automation</title>

<style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
        display: none !important;
    }
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="instaCtrl">
    <div class="container-fluid container-padding">
        <div class="position-relative" style="min-height: calc(100vh - 110px) !important;display: flex;flex-direction: column;align-items: center;justify-content: center;">
            <div class="automation-wrapper mb-3 d-none">
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-box me-3">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div>
                        <h5 class="title mb-0">Facebook Automation</h5>
                        <p class="subtitle mb-0">Automatically schedule posts and grow your page.</p>
                    </div>
                </div>
                <div class="row row-gap-2">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('facebook-publisher'); ?>" class="automation-box">
                            <div class="automation-icon">
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <div>
                                <h6 class="title">PostPilot</h6>
                                <p class="desc">Automatically schedule and publish videos at your selected date and time.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('facebook-auto-reply'); ?>" class="automation-box">
                            <div class="automation-icon">
                                <i class="fa-solid fa-message"></i>
                            </div>
                            <div>
                                <h6 class="title">Smart Reply</h6>
                                <p class="desc">Automatically respond to comments and messages using your pre-set replies.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="automation-wrapper mb-3 d-none">
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-box me-3 insta-icon">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    <div>
                        <h5 class="title mb-0">Instagram Automation</h5>
                        <p class="subtitle mb-0">Easily manage Reels and boost engagement.</p>
                    </div>
                </div>
                <div class="row row-gap-2">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('insta-publisher'); ?>" class="automation-box">
                            <div class="automation-icon">
                                <i class="fa-solid fa-video"></i>
                            </div>
                            <div>
                                <h6 class="title">ReelFlow</h6>
                                <p class="desc">Automatically schedule and publish reels at your selected date and time.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('insta-auto-reply'); ?>" class="automation-box">
                            <div class="automation-icon">
                                <i class="fa-solid fa-message"></i>
                            </div>
                            <div>
                                <h6 class="title">Comment Responder</h6>
                                <p class="desc">Automatically Reply to Instagram messages using your predefined responses.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center mb-4">
                <h1 class="title-color mb-0 fw-bold">
                    YouTube Automation
                </h1>
                <p class="subtitle mb-0">Upload videos automatically and grow your channel.</p>
            </div>
            <div class="row row-gap-2">
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="<?php echo base_url('youtube-publisher'); ?>" class="automation-box style-2 border">
                        <div class="automation-image border">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/auto-post.png" alt="image">
                        </div>
                        <div class="text-center automation-content">
                            <h6 class="title">Auto Post</h6>
                            <div class="divider"></div>
                            <p class="desc">Auto-optimize titles, tags and descriptions on upload.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="<?php echo base_url('youtube-v2-list'); ?>" class="automation-box style-2 border">
                        <div class="automation-image border">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/auto-reply.png" alt="image">
                        </div>
                        <div class="text-center automation-content">
                            <h6 class="title">Auto Reply</h6>
                            <div class="divider"></div>
                            <p class="desc">Reply to comments on your videos quickly with preset responses.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="<?php echo base_url('youtube-v2-auto-comment'); ?>" class="automation-box style-2 border">
                        <div class="automation-image border">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/auto-comment.png" alt="image">
                        </div>
                        <div class="text-center automation-content">
                            <h6 class="title">Auto Comment</h6>
                            <div class="divider"></div>
                            <p class="desc">Post comments on your videos to engage viewers.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
