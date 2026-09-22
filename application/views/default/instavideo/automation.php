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
            
            <div class="automation-wrapper mb-3">
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-box me-3 youtube-icon">
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                    <div>
                        <h5 class="title mb-0">YouTube Automation</h5>
                        <p class="subtitle mb-0">Upload videos automatically and grow your channel.</p>
                    </div>
                </div>
                <div class="row row-gap-2">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('youtube-publisher'); ?>" class="automation-box">
                            <div class="automation-icon icon-yt">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 2H5.875C5.37772 2 4.90081 2.19754 4.54917 2.54917C4.19754 2.90081 4 3.37772 4 3.875V25.4375C4.00049 25.8479 4.11845 26.2497 4.33996 26.5952C4.56146 26.9408 4.87725 27.2157 5.25 27.3875C5.55067 27.5452 5.88546 27.6268 6.225 27.625C6.67656 27.6102 7.11278 27.4575 7.475 27.1875L14.1625 22.1875C14.3789 22.0252 14.642 21.9375 14.9125 21.9375C15.183 21.9375 15.4461 22.0252 15.6625 22.1875L22.35 27.1875C22.675 27.4312 23.0614 27.5797 23.466 27.6162C23.8707 27.6526 24.2774 27.5757 24.6408 27.3941C25.0041 27.2124 25.3097 26.9331 25.5233 26.5875C25.7369 26.242 25.85 25.8437 25.85 25.4375V3.875C25.85 3.38202 25.6559 2.90886 25.3097 2.55794C24.9635 2.20702 24.4929 2.00657 24 2Z" fill="url(#paint0_linear_286_509)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_286_509" x1="14.925" y1="2" x2="14.925" y2="27.625" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D95F5F"/>
                                    <stop offset="1" stop-color="#EF0316"/>
                                    </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                            <div>
                                <h6 class="title">Auto Post</h6>
                                <p class="desc">Auto-optimize titles, tags and descriptions on upload.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('youtube-v2-list'); ?>" class="automation-box">
                            <div class="automation-icon icon-yt">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.25 1.875H3.75C2.19937 1.875 0.9375 3.13687 0.9375 4.6875V19.6875C0.9375 21.2381 2.19937 22.5 3.75 22.5H6.5625V27.1875C6.5625 27.5484 6.76969 27.8756 7.09312 28.0322C7.22344 28.0941 7.36219 28.125 7.5 28.125C7.70906 28.125 7.91625 28.0556 8.08594 27.9197L14.8603 22.5H26.25C27.8006 22.5 29.0625 21.2381 29.0625 19.6875V4.6875C29.0625 3.13687 27.8006 1.875 26.25 1.875ZM15 15H7.5C6.98156 15 6.5625 14.58 6.5625 14.0625C6.5625 13.545 6.98156 13.125 7.5 13.125H15C15.5184 13.125 15.9375 13.545 15.9375 14.0625C15.9375 14.58 15.5184 15 15 15ZM22.5 11.25H7.5C6.98156 11.25 6.5625 10.83 6.5625 10.3125C6.5625 9.795 6.98156 9.375 7.5 9.375H22.5C23.0184 9.375 23.4375 9.795 23.4375 10.3125C23.4375 10.83 23.0184 11.25 22.5 11.25Z" fill="url(#paint0_linear_286_517)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_286_517" x1="15" y1="1.875" x2="15" y2="28.125" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D95F5F"/>
                                    <stop offset="1" stop-color="#EF0316"/>
                                    </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                            <div>
                                <h6 class="title">Auto Reply</h6>
                                <p class="desc">Reply to comments on your videos quickly with preset responses.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('youtube-v2-auto-comment'); ?>" class="automation-box">
                            <div class="automation-icon icon-yt">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8065 30C11.6897 30 11.5716 29.9767 11.4588 29.928C11.0638 29.7577 10.8502 29.3265 10.9539 28.909L13.926 16.9455H5.91799C5.62813 16.9455 5.3569 16.8026 5.19301 16.5635C5.02913 16.3244 4.99368 16.0199 5.09827 15.7495L10.973 0.561853C11.1039 0.223241 11.4296 0 11.7926 0H19.8763C20.1733 0 20.4502 0.149999 20.6125 0.398787C20.7747 0.647576 20.8003 0.961461 20.6806 1.23328L17.2019 9.12934H24.082C24.4034 9.12934 24.6992 9.30483 24.8533 9.58695C25.0074 9.86902 24.9952 10.2127 24.8215 10.4832L12.5464 29.5959C12.3804 29.8545 12.0981 30 11.8065 30Z" fill="url(#paint0_linear_286_525)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_286_525" x1="15" y1="0" x2="15" y2="30" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D95F5F"/>
                                    <stop offset="1" stop-color="#EF0316"/>
                                    </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                            <div>
                                <h6 class="title">Auto Comment</h6>
                                <p class="desc">Post comments on your videos to engage viewers.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <img src="<?php echo $this->config->item('assetsPath') ?>images/yt-automation.png" alt="image" class="img-fluid d-block">
            </div>
            <div class="automation-wrapper mb-3">
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
                        <a href="<?php echo base_url('insta-publisher'); ?>" class="automation-box box-pink">
                            <div class="automation-icon icon-insta">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.14909 1.85273L10.66 7.36364H1.11455C1.30933 6.19358 1.7758 5.0855 2.47648 4.12841C3.17717 3.17132 4.09255 2.39189 5.14909 1.85273ZM12.5564 1H8.63636C8.39455 1 8.15273 1.01273 7.91091 1.02546L14.2491 7.36364H18.92L12.5564 1ZM21.3636 1H16.1709L22.5345 7.36364H28.8855C28.5873 5.58446 27.6679 3.96865 26.2906 2.80348C24.9134 1.63831 23.1676 0.999285 21.3636 1ZM13.0679 22.1604L19.4315 18.6604C19.6313 18.5507 19.798 18.3894 19.9141 18.1933C20.0302 17.9971 20.0915 17.7734 20.0915 17.5455C20.0915 17.3175 20.0302 17.0938 19.9141 16.8977C19.798 16.7015 19.6313 16.5402 19.4315 16.4305L13.0679 12.9305C12.8741 12.824 12.6559 12.7697 12.4348 12.7732C12.2137 12.7766 11.9973 12.8376 11.8069 12.9501C11.6165 13.0627 11.4588 13.2229 11.3491 13.4149C11.2395 13.607 11.1819 13.8243 11.1818 14.0455V21.0455C11.1819 21.2666 11.2395 21.4839 11.3491 21.676C11.4588 21.8681 11.6165 22.0282 11.8069 22.1408C11.9973 22.2533 12.2137 22.3143 12.4348 22.3177C12.6559 22.3212 12.8741 22.2669 13.0679 22.1604ZM29 9.90909V21.3636C28.9984 23.3884 28.1933 25.3298 26.7616 26.7616C25.3298 28.1933 23.3884 28.9984 21.3636 29H8.63636C6.61157 28.9984 4.67017 28.1933 3.23843 26.7616C1.80668 25.3298 1.00162 23.3884 1 21.3636V9.90909H29Z" fill="url(#paint0_linear_286_473)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_286_473" x1="15" y1="1" x2="15" y2="29" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#FFC9E8"/>
                                    <stop offset="1" stop-color="#C9358A"/>
                                    </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                            <div>
                                <h6 class="title">ReelFlow</h6>
                                <p class="desc">Automatically schedule and publish reels at your selected date and time.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('insta-auto-reply'); ?>" class="automation-box box-pink">
                            <div class="automation-icon icon-insta">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.25 1.875H3.75C2.19937 1.875 0.9375 3.13687 0.9375 4.6875V19.6875C0.9375 21.2381 2.19937 22.5 3.75 22.5H6.5625V27.1875C6.5625 27.5484 6.76969 27.8756 7.09312 28.0322C7.22344 28.0941 7.36219 28.125 7.5 28.125C7.70906 28.125 7.91625 28.0556 8.08594 27.9197L14.8603 22.5H26.25C27.8006 22.5 29.0625 21.2381 29.0625 19.6875V4.6875C29.0625 3.13687 27.8006 1.875 26.25 1.875ZM15 15H7.5C6.98156 15 6.5625 14.58 6.5625 14.0625C6.5625 13.545 6.98156 13.125 7.5 13.125H15C15.5184 13.125 15.9375 13.545 15.9375 14.0625C15.9375 14.58 15.5184 15 15 15ZM22.5 11.25H7.5C6.98156 11.25 6.5625 10.83 6.5625 10.3125C6.5625 9.795 6.98156 9.375 7.5 9.375H22.5C23.0184 9.375 23.4375 9.795 23.4375 10.3125C23.4375 10.83 23.0184 11.25 22.5 11.25Z" fill="url(#paint0_linear_286_480)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_286_480" x1="15" y1="1.875" x2="15" y2="28.125" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#FFC9E8"/>
                                    <stop offset="1" stop-color="#C9358A"/>
                                    </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                            <div>
                                <h6 class="title">Comment Responder</h6>
                                <p class="desc">Automatically Reply to Instagram messages using your predefined responses.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <img src="<?php echo $this->config->item('assetsPath') ?>images/insta-automation.png" alt="image" class="img-fluid d-block">
            </div>
            <div class="automation-wrapper">
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
                        <a href="<?php echo base_url('facebook-publisher'); ?>" class="automation-box box-blue">
                            <div class="automation-icon icon-fb">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.2875 3.475L23.5875 25.3125C23.4875 25.7875 23.175 26.1875 22.7375 26.4C22.3 26.6125 21.8 26.6125 21.35 26.4L17.85 24.7C17.85 24.7 13.375 27.9375 12.4625 28.3625C12.2875 28.45 12.2125 28.4375 12.0875 28.4375C11.9125 28.4375 11.725 28.3875 11.575 28.2875C11.3125 28.1125 11.15 27.825 11.15 27.5125V20.875C11.1375 20.7375 11.15 20.6 11.225 20.4625C11.225 20.4625 11.2375 20.4375 11.25 20.425C11.2875 20.3625 11.325 20.3 11.375 20.2375L22.8875 7.6375L8.57497 19.4125C8.46247 19.525 8.31247 19.625 8.14997 19.6625C7.88747 19.7375 7.59997 19.6875 7.37497 19.5375L2.56247 17.3625C2.02497 17.1 1.68747 16.575 1.66247 15.975C1.64997 15.3875 1.96247 14.8375 2.48747 14.55L25.9875 1.7625C26.5375 1.4625 27.1875 1.5125 27.7 1.8875C28.2 2.2625 28.425 2.875 28.3 3.475H28.2875Z" fill="url(#paint0_linear_286_441)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_286_441" x1="14.998" y1="1.56763" x2="14.998" y2="28.4381" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#69A7FE"/>
                                    <stop offset="1" stop-color="#336CF7"/>
                                    </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                            <div>
                                <h6 class="title">PostPilot</h6>
                                <p class="desc">Automatically schedule and publish videos at your selected date and time.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="<?php echo base_url('facebook-auto-reply'); ?>" class="automation-box box-blue">
                            <div class="automation-icon icon-fb">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.25 1.875H3.75C2.19937 1.875 0.9375 3.13687 0.9375 4.6875V19.6875C0.9375 21.2381 2.19937 22.5 3.75 22.5H6.5625V27.1875C6.5625 27.5484 6.76969 27.8756 7.09312 28.0322C7.22344 28.0941 7.36219 28.125 7.5 28.125C7.70906 28.125 7.91625 28.0556 8.08594 27.9197L14.8603 22.5H26.25C27.8006 22.5 29.0625 21.2381 29.0625 19.6875V4.6875C29.0625 3.13687 27.8006 1.875 26.25 1.875ZM15 15H7.5C6.98156 15 6.5625 14.58 6.5625 14.0625C6.5625 13.545 6.98156 13.125 7.5 13.125H15C15.5184 13.125 15.9375 13.545 15.9375 14.0625C15.9375 14.58 15.5184 15 15 15ZM22.5 11.25H7.5C6.98156 11.25 6.5625 10.83 6.5625 10.3125C6.5625 9.795 6.98156 9.375 7.5 9.375H22.5C23.0184 9.375 23.4375 9.795 23.4375 10.3125C23.4375 10.83 23.0184 11.25 22.5 11.25Z" fill="url(#paint0_linear_286_448)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_286_448" x1="15" y1="1.875" x2="15" y2="28.125" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#69A7FE"/>
                                    <stop offset="1" stop-color="#336CF7"/>
                                    </linearGradient>
                                    </defs>
                                </svg>

                            </div>
                            <div>
                                <h6 class="title">Smart Reply</h6>
                                <p class="desc">Automatically respond to comments and messages using your pre-set replies.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <img src="<?php echo $this->config->item('assetsPath') ?>images/fb-automation.png" alt="image" class="img-fluid d-block">
            </div>
            <div class="text-center mb-4 d-none">
                <h1 class="title-color mb-0 fw-bold">
                    YouTube Automation
                </h1>
                <p class="subtitle mb-0">Upload videos automatically and grow your channel.</p>
            </div>
            <div class="row row-gap-2 d-none">
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
