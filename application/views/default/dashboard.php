<style>
    #chart{
        min-height: unset !important;
        .apexcharts-canvas{
            height: 260px !important;
            svg.apexcharts-svg{
                height: 240px !important;
            }
        }
    }
    .apexcharts-tooltip {
        background: #fff !important;
        color: #000 !important;
        border: 1px solid #ddd !important;
    }

    .apexcharts-tooltip-title {
        background: #f5f5f5 !important;
        color: #000 !important;
    }

    .apexcharts-tooltip-series-group,
    .apexcharts-tooltip-text,
    .apexcharts-tooltip-y-group,
    .apexcharts-tooltip-x-group {
        color: #000 !important;
    }

    .apexcharts-tooltip,
    .apexcharts-tooltip * {
        color: #000 !important;
    }

    .apexcharts-tooltip-title {
        color: #000 !important;
    }
</style>

<!-- Container Start -->
<div class="container-wrapper container-open">
    <title><?php echo $this->config->item('productName') ?> | Dashboard</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" >
     
        <div class="row gap-0 g-3" ng-app="AppModule" ng-controller="virtualAssitant">
            <div class="col-12">
                <div class="theme-card" style="background: none; border: 0; padding-left: 0; padding-bottom: 10px;">
                    <div class="section-head section-head-style-1">
                        <h2 class="title mb-1">
                            Welcome back, <span class="text-primary"><?php echo $this->session->userdata('logged_in')['name']?></span>
                        </h2>
                        <p class="desc">
                            Command Your AI Agent to Create, Schedule, Publish, and Grow Your Social Accounts.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="theme-card ai-bg">
                    <span class="f-14 card-title text-uppercase">Welcome back, <span class="text-primary">Ghosman! 👋</span> </span>
                    <h4 class="f-28 mt30">
                        Let your ViewAgent <br>
                        <span class="text-gradient">handle the traffic work</span>
                    </h4>
                    <span class="f-12">Your agent is online and ready</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card rad-shade">
                    <div class="">
                        <div class="icon-box-sm rad-bg d-flex justify-content-center align-items-center mb-2">
                            <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.55 -9.53674e-06H7.65C8.61667 0.0323238 9.53333 0.0646572 10.4 0.0969906C11.9333 0.129324 12.9167 0.210157 13.35 0.339491C13.6833 0.404157 13.9667 0.55774 14.2 0.800241C14.4333 1.04274 14.5917 1.31757 14.675 1.62474C14.7583 1.93191 14.8333 2.36032 14.9 2.90999L14.95 3.29799C14.9833 3.91232 15 4.51049 15 5.09249V5.18949C15 5.80382 14.9667 6.41816 14.9 7.03249V7.22649C14.8333 7.84082 14.7583 8.30966 14.675 8.63299C14.5917 8.95632 14.4333 9.23116 14.2 9.45749C13.9667 9.68382 13.6833 9.84549 13.35 9.94249C12.8833 10.0718 11.85 10.1527 10.25 10.185C9.35 10.2173 8.45 10.2335 7.55 10.2335H7.45C6.55 10.2335 5.63333 10.2173 4.7 10.185H4.15C2.88333 10.1203 2.06667 10.0395 1.7 9.94249C1.33333 9.84549 1.03333 9.68382 0.8 9.45749C0.566667 9.23116 0.4 8.95632 0.3 8.63299C0.2 8.30966 0.133333 7.84082 0.1 7.22649V7.03249C0.0333333 6.41816 0 5.80382 0 5.18949V5.09249C0 4.51049 0.0166667 3.96082 0.05 3.44349L0.1 2.90999C0.166667 2.36032 0.241667 1.93191 0.325 1.62474C0.408333 1.31757 0.566667 1.04274 0.8 0.800241C1.03333 0.55774 1.31667 0.404157 1.65 0.339491C2.05 0.242491 2.88333 0.161657 4.15 0.0969906L4.7 0.0484905C5.6 0.0484905 6.48333 0.0323238 7.35 -9.53674e-06H7.55ZM6 2.95849V7.32349L9.9 5.14099L6 2.95849Z" fill="#FA5158"/>
                            </svg>
                        </div>
                        <div class="stats-info">
                            <p class="stats-value text-white f-28 w700">
                                <?php echo isset($total_analyzed_videos) ? $total_analyzed_videos : 0; ?></p>
                            <span class="f-12">Videos optimized</span>
                            <!-- <p class="stats-value">128<span class="limit">/20</span></p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card purple-shade">
                    <div class="">
                        <div class="icon-box-sm purple-bg d-flex justify-content-center align-items-center mb-2">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.6059 9.44854C13.6059 10.0004 13.4162 10.466 13.0368 10.8453C12.6574 11.2247 12.1918 11.4144 11.64 11.4144C11.0882 11.4144 10.6312 11.2247 10.2691 10.8453C9.90693 10.466 9.72587 10.009 9.72587 9.47441C9.72587 8.93983 9.90693 8.48285 10.2691 8.10348C10.6312 7.7241 11.0882 7.53441 11.64 7.53441C12.1918 7.53441 12.6574 7.7241 13.0368 8.10348C13.4162 8.48285 13.6059 8.93121 13.6059 9.44854ZM7.76 14.984C7.76 15.2254 7.82036 15.3979 7.94107 15.5013C8.06178 15.6048 8.19111 15.6738 8.32907 15.7083L8.536 15.76H14.744L14.9509 15.7083C15.0889 15.6738 15.2182 15.6048 15.3389 15.5013C15.4596 15.3979 15.52 15.2254 15.52 14.984C15.52 14.6391 15.4165 14.2597 15.2096 13.8459C14.9337 13.2941 14.5371 12.8457 14.0197 12.5008C13.3644 12.0869 12.5712 11.88 11.64 11.88C10.7088 11.88 9.91556 12.0869 9.26027 12.5008C8.74293 12.8457 8.34631 13.2941 8.0704 13.8459C7.86347 14.2597 7.76 14.6391 7.76 14.984ZM1.96587 2.15414C1.41404 2.15414 0.948444 2.34383 0.569067 2.72321C0.189689 3.10259 0 3.56819 0 4.12001V11.88C0 12.4318 0.189689 12.8974 0.569067 13.2768C0.948444 13.6562 1.3968 13.8459 1.91413 13.8459H7.03573C7.17369 13.501 7.34613 13.1733 7.55307 12.8629H1.96587C1.68996 12.8629 1.45716 12.7681 1.26747 12.5784C1.07778 12.3887 0.982933 12.1559 0.982933 11.88V4.12001C0.982933 3.8441 1.07778 3.6113 1.26747 3.42161C1.45716 3.23192 1.67271 3.13708 1.91413 3.13708H13.6059C13.8473 3.13708 14.0628 3.23192 14.2525 3.42161C14.4422 3.6113 14.5371 3.8441 14.5371 4.12001V11.6731C14.882 11.9145 15.1751 12.1732 15.4165 12.4491C15.4855 12.2766 15.52 12.0869 15.52 11.88V4.12001C15.52 3.56819 15.3303 3.10259 14.9509 2.72321C14.5716 2.34383 14.106 2.15414 13.5541 2.15414H1.96587Z" fill="#8686F0"/>
                            </svg>
                        </div>
                        <div class="stats-info">
                            <p class="stats-value text-white f-28 w700">
                                <?php echo isset($total_analyzed_videos) ? $total_analyzed_videos : 0; ?></p>
                            <span class="f-12">AI videos created</span>
                            <!-- <p class="stats-value">128<span class="limit">/20</span></p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card yellow-shade">
                    <div class="">
                        <div class="icon-box-sm yellow-bg d-flex justify-content-center align-items-center mb-2">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9163 0.291612C11.0198 0.36059 11.0888 0.446812 11.1233 0.550279C11.1578 0.653745 11.1578 0.757212 11.1233 0.860679L9.36435 6.55134H12.6235C12.8305 6.55134 12.9771 6.64619 13.0633 6.83588C13.1495 7.02557 13.1236 7.20663 12.9857 7.37908L5.22568 15.6047C5.12221 15.6737 5.01875 15.7168 4.91528 15.734C4.81181 15.7513 4.70835 15.734 4.60488 15.6823C4.50141 15.6305 4.43244 15.5529 4.39795 15.4495C4.36346 15.346 4.36346 15.2425 4.39795 15.1391L6.15688 9.44841H2.89768C2.69075 9.44841 2.54417 9.35357 2.45795 9.16388C2.37172 8.97419 2.39759 8.79312 2.53555 8.62068L10.2955 0.395079C10.399 0.3261 10.5025 0.28299 10.6059 0.265745C10.7094 0.248501 10.8129 0.257123 10.9163 0.291612ZM4.03581 8.46548H6.77768C6.95012 8.46548 7.08808 8.53446 7.19155 8.67241C7.29501 8.81037 7.31226 8.96557 7.24328 9.13801L5.94995 13.4319L11.4854 7.53428H8.74355C8.5711 7.53428 8.43315 7.4653 8.32968 7.32734C8.22621 7.18939 8.20897 7.03419 8.27795 6.86174L9.57128 2.56788L4.03581 8.46548Z" fill="#FAA810"/>
                            </svg>
                        </div>
                        <div class="stats-info">
                            <p class="stats-value text-white f-28 w700">
                                <?php echo isset($total_analyzed_videos) ? $total_analyzed_videos : 0; ?></p>
                            <span class="f-12">Videos optimized</span>
                            <!-- <p class="stats-value">128<span class="limit">/20</span></p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card blue-shade">
                    <div class="">
                        <div class="icon-box-sm blue-bg d-flex justify-content-center align-items-center mb-2">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.84587 8C6.63911 8 7.32027 7.71546 7.88933 7.1464C8.4584 6.57733 8.74293 5.88755 8.74293 5.07706C8.74293 4.26657 8.4584 3.58542 7.88933 3.0336C7.32027 2.48177 6.63049 2.19724 5.82 2.18C5.00951 2.16275 4.31973 2.43866 3.75067 3.00773C3.1816 3.5768 2.89707 4.26657 2.89707 5.07706C2.89707 5.88755 3.1816 6.57733 3.75067 7.1464C4.31973 7.71546 5.00089 8 5.79413 8H5.84587ZM0.982933 13.7941C0.879467 13.7941 0.793244 13.7941 0.724267 13.7941C0.517333 13.7252 0.344889 13.6217 0.206933 13.4837C0.0689778 13.3458 0 13.1388 0 12.8629C0 12.4146 0.137956 11.9317 0.413867 11.4144C0.827733 10.7246 1.41404 10.1728 2.1728 9.75893C3.13849 9.2416 4.35422 8.98293 5.82 8.98293C7.28578 8.98293 8.50151 9.2416 9.4672 9.75893C10.226 10.1728 10.8123 10.7246 11.2261 11.4144C11.502 11.9317 11.64 12.4146 11.64 12.8629C11.64 13.1388 11.571 13.3458 11.4331 13.4837C11.2951 13.6217 11.1227 13.7252 10.9157 13.7941H10.6571H0.982933ZM10.6571 3.6544C10.6571 3.51644 10.7088 3.39573 10.8123 3.29226C10.9157 3.1888 11.0364 3.13706 11.1744 3.13706H15.0544C15.1924 3.13706 15.3044 3.1888 15.3907 3.29226C15.4769 3.39573 15.52 3.51644 15.52 3.6544C15.52 3.79235 15.4769 3.90444 15.3907 3.99066C15.3044 4.07688 15.1924 4.12 15.0544 4.12H11.1744C11.0364 4.12 10.9157 4.07688 10.8123 3.99066C10.7088 3.90444 10.6571 3.79235 10.6571 3.6544ZM11.1744 6.03413C11.0364 6.03413 10.9157 6.08586 10.8123 6.18933C10.7088 6.2928 10.6571 6.41351 10.6571 6.55146C10.6571 6.68942 10.7088 6.80151 10.8123 6.88773C10.9157 6.97395 11.0364 7.01706 11.1744 7.01706H15.0544C15.1924 7.01706 15.3044 6.97395 15.3907 6.88773C15.4769 6.80151 15.52 6.68942 15.52 6.55146C15.52 6.41351 15.4769 6.2928 15.3907 6.18933C15.3044 6.08586 15.1924 6.03413 15.0544 6.03413H11.1744ZM13.0885 8.98293C12.9506 8.98293 12.8385 9.02604 12.7523 9.11226C12.666 9.19848 12.6229 9.31057 12.6229 9.44853C12.6229 9.58648 12.666 9.69857 12.7523 9.7848C12.8385 9.87102 12.9506 9.93137 13.0885 9.96586H15.0544C15.1924 9.93137 15.3044 9.87102 15.3907 9.7848C15.4769 9.69857 15.52 9.58648 15.52 9.44853C15.52 9.31057 15.4769 9.19848 15.3907 9.11226C15.3044 9.02604 15.1924 8.98293 15.0544 8.98293H13.0885ZM13.0885 11.88C12.9506 11.88 12.8385 11.9231 12.7523 12.0093C12.666 12.0956 12.6229 12.2076 12.6229 12.3456C12.6229 12.4836 12.666 12.6043 12.7523 12.7077C12.8385 12.8112 12.9506 12.8629 13.0885 12.8629H15.0544C15.1924 12.8629 15.3044 12.8112 15.3907 12.7077C15.4769 12.6043 15.52 12.4836 15.52 12.3456C15.52 12.2076 15.4769 12.0956 15.3907 12.0093C15.3044 11.9231 15.1924 11.88 15.0544 11.88H13.0885Z" fill="#3FB6F7"/>
                            </svg>
                        </div>
                        <div class="stats-info">
                            <p class="stats-value text-white f-28 w700">
                                <?php echo isset($total_analyzed_videos) ? $total_analyzed_videos : 0; ?></p>
                            <span class="f-12">Videos optimized</span>
                            <!-- <p class="stats-value">128<span class="limit">/20</span></p> -->
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="col-xl-6 col-lg-6">
                <div class="theme-card youtube-bg h-100">
                   <div class="">
                        <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="53.61" height="54" rx="12" fill="#DB1A1A"/>
                            <path d="M26.877 18.8602H27.0211C28.4137 18.9083 29.7344 18.9563 30.9829 19.0043C33.192 19.0523 34.6086 19.1724 35.2329 19.3645C35.7131 19.4605 36.1213 19.6886 36.4575 20.0488C36.7936 20.4089 37.0217 20.8171 37.1418 21.2733C37.2618 21.7296 37.3699 22.3659 37.4659 23.1822L37.538 23.7585C37.586 24.6709 37.61 25.5593 37.61 26.4237V26.5678C37.61 27.4802 37.562 28.3926 37.4659 29.3051V29.5932C37.3699 30.5056 37.2618 31.2019 37.1418 31.6822C37.0217 32.1624 36.7936 32.5706 36.4575 32.9067C36.1213 33.2429 35.7131 33.483 35.2329 33.6271C34.5606 33.8192 33.0719 33.9392 30.7668 33.9872C29.4702 34.0353 28.1736 34.0593 26.877 34.0593H26.733C25.4364 34.0593 24.1158 34.0353 22.7711 33.9872H21.9788C20.1539 33.8912 18.9774 33.7711 18.4491 33.6271C17.9209 33.483 17.4887 33.2429 17.1525 32.9067C16.8164 32.5706 16.5763 32.1624 16.4322 31.6822C16.2881 31.2019 16.1921 30.5056 16.1441 29.5932V29.3051C16.048 28.3926 16 27.4802 16 26.5678V26.4237C16 25.5593 16.024 24.743 16.072 23.9746L16.1441 23.1822C16.2401 22.3659 16.3482 21.7296 16.4682 21.2733C16.5883 20.8171 16.8164 20.4089 17.1525 20.0488C17.4887 19.6886 17.8969 19.4605 18.3771 19.3645C18.9534 19.2204 20.1539 19.1003 21.9788 19.0043L22.7711 18.9323C24.0677 18.9323 25.3403 18.9083 26.5889 18.8602H26.877ZM24.644 23.2543V29.7373L30.2626 26.4958L24.644 23.2543Z" fill="white"/>
                        </svg>
                   </div>
                   <div class="w-70 mt20">
                       <h4 class="text-white f-20">YouTube Video Optimization AI</h4>
                       <span class="f-12 d-block">Connect your channel → fetch videos → analyze & <br> optimize → approve → apply changes to YouTube.</span>
                       <div class="mt10">
                           <a href="javascripts:void(0)" class="red-clr f-14 ">Start optimizing</a> 
                       </div>
                   </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="theme-card ai-avatar-bg h-100">
                   <div class="">
                        <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="53.61" height="54" rx="12" fill="#6C6CF5"/>
                            <path d="M34.9448 29.0169C34.9448 29.7853 34.6806 30.4336 34.1524 30.9618C33.6242 31.4901 32.9759 31.7542 32.2075 31.7542C31.4391 31.7542 30.8028 31.4901 30.2986 30.9618C29.7944 30.4336 29.5423 29.7973 29.5423 29.0529C29.5423 28.3086 29.7944 27.6723 30.2986 27.1441C30.8028 26.6158 31.4391 26.3517 32.2075 26.3517C32.9759 26.3517 33.6242 26.6158 34.1524 27.1441C34.6806 27.6723 34.9448 28.2966 34.9448 29.0169ZM26.805 36.7245C26.805 37.0606 26.889 37.3008 27.0571 37.4448C27.2252 37.5889 27.4053 37.6849 27.5974 37.733L27.8855 37.805H36.5295L36.8176 37.733C37.0097 37.6849 37.1898 37.5889 37.3579 37.4448C37.526 37.3008 37.61 37.0606 37.61 36.7245C37.61 36.2443 37.4659 35.716 37.1778 35.1398C36.7936 34.3714 36.2414 33.7471 35.521 33.2669C34.6086 32.6906 33.5041 32.4025 32.2075 32.4025C30.9109 32.4025 29.8064 32.6906 28.894 33.2669C28.1736 33.7471 27.6214 34.3714 27.2372 35.1398C26.9491 35.716 26.805 36.2443 26.805 36.7245ZM18.7373 18.8602C17.9689 18.8602 17.3206 19.1243 16.7924 19.6526C16.2641 20.1808 16 20.8291 16 21.5975V32.4025C16 33.1708 16.2641 33.8191 16.7924 34.3474C17.3206 34.8756 17.9449 35.1398 18.6652 35.1398H25.7965C25.9886 34.6595 26.2287 34.2033 26.5169 33.7711H18.7373C18.3531 33.7711 18.0289 33.6391 17.7648 33.3749C17.5007 33.1108 17.3686 32.7867 17.3686 32.4025V21.5975C17.3686 21.2133 17.5007 20.8892 17.7648 20.625C18.0289 20.3609 18.3291 20.2289 18.6652 20.2289H34.9448C35.2809 20.2289 35.5811 20.3609 35.8452 20.625C36.1093 20.8892 36.2414 21.2133 36.2414 21.5975V32.1144C36.7216 32.4505 37.1298 32.8107 37.4659 33.1949C37.562 32.9547 37.61 32.6906 37.61 32.4025V21.5975C37.61 20.8291 37.3459 20.1808 36.8176 19.6526C36.2894 19.1243 35.6411 18.8602 34.8727 18.8602H18.7373Z" fill="white"/>
                        </svg>
                   </div>
                   <div class="w-70 mt20">
                       <h4 class="text-white f-20">AI & Avatar Video Generation</h4>
                       <span class="f-12 d-block">Create an AI video or avatar video from a script or <br> product, then publish it straight to YouTube.  </span>
                       <div class="mt10">
                           <a href="javascripts:void(0)" class="purple-clr f-14 ">Start creating</a> 
                       </div>
                   </div>
                </div>
            </div>
           
         
            
            <div class="col-xl-12 col-lg-6">
                <div class="theme-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label class="form-label mb-0">Recent Analyzed Videos</label>
                        <!-- <a href="#" class="btn btn-sm btn-outline">View All</a> -->
                    </div>
                    <div class="theme-card" ng-if="analyz_data.length == 0">
                        <p style="font-size: 16px; font-weight: 600; margin: 0; text-align: center;">You haven't analyzed any videos yet.</p>
                    </div>
                    
                    <div class="p-0" style="height: 350px; overflow-y: auto; overflow-x: hidden; scrollbar-width: none;" ng-if="analyz_data.length != 0">
                        <div class="p-0" ng-repeat="video in analyz_data" >
                            <div class="theme-card d-flex align-items-start justify-content-between optimizer-list gap-2 mb-3">
                                
                                <div class="d-flex">
                                    <div class="rounded overflow-hidden me-3"
                                        style="height: auto; min-width: 160px; width: 160px;">
                                        <img class="object-fit-cover w-100 h-100"
                                            ng-src="{{video.thumbnail || video.video_info.thumbnail}}" alt="image">
                                    </div>
                                    <div>
                                        <h6 class="title-color ng-binding">{{video.title}}</h6>
                                        <p class="ng-binding" style="font-size:11px;">
                                            {{ video.summary | limitTo:100 }}
                                            <span ng-if="video.summary.length > 100">.....</span>
                                        </p>
                                        <div class="d-inline-flex align-items-center gap-3">
                                            <div class="d-inline-flex align-items-center gap-2">
                                                <div class="rounded-circle overflow-hidden"
                                                    style="height: 30px; min-width: 30px; width: 30px;">
                                                    <img class="object-fit-cover w-100 h-100"
                                                        ng-src="{{video.video_info.channelThumbnail}}"
                                                        alt="image">
                                                </div>
                                                <p class="title-color w500 mb-0 ng-binding">{{video.video_info.channel_name}}</p>
                                            </div>
                                            <!--<i class="fa-solid fa-circle text-primary" style="font-size: 6px;"></i>-->
                                            <!--<span>2 weeks ago</span>-->
                                            <i class="fa-solid fa-circle text-primary" style="font-size: 6px;"></i>
                                            <span class="ng-binding">{{video.video_info.views}} views</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end gap-3 align-self-stretch justify-content-between" style="flex-direction: column;">
                                    <div class="d-flex align-items-end gap-3">
                                        <a href="javascript:void(0)" ng-click="downloadPDF(video)" class="action-btn btn-primary"><i
                                                class="fa-solid fa-download"></i></a>
                                        <a href="javascript:void(0)" ng-click="edit_analyz(video.id)" class="action-btn btn-primary">
                                            <!-- <i class="fa-solid fa-wand-magic-sparkles"></i> -->
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.79932 12.1333C9.17399 12.1333 8.57969 12.0024 8.04022 11.7686L6.74219 13.0667H10.966C11.2236 13.0667 11.4327 12.8576 11.4327 12.6V11.8186C10.9268 12.0197 10.3768 12.1333 9.79932 12.1333Z" fill="white" fill-opacity="1"/>
                                                <path d="M10.966 1.16667H1.63268C1.37508 1.16667 1.16602 1.37574 1.16602 1.63334V12.6C1.16602 12.8576 1.37508 13.0667 1.63268 13.0667H2.12292L5.73072 9.45911C5.49692 8.91964 5.36602 8.32534 5.36602 7.70001C5.36602 5.25164 7.35098 3.26667 9.79935 3.26667C10.3768 3.26667 10.9268 3.38031 11.4327 3.58144V1.63334C11.4327 1.37574 11.2236 1.16667 10.966 1.16667ZM4.89935 5.60001H2.09935V4.66667H4.89935V5.60001ZM6.53268 3.73334H2.09935V2.80001H6.53268V3.73334Z" fill="white" fill-opacity="1"/>
                                                <path d="M9.80011 4.20001C7.86718 4.20001 6.30011 5.76708 6.30011 7.70001C6.30011 8.41331 6.51478 9.07575 6.88111 9.62921L4.17188 12.3384L5.16167 13.3282L7.87091 10.619C8.42438 10.9853 9.08681 11.2 9.80011 11.2C11.733 11.2 13.3001 9.63295 13.3001 7.70001C13.3001 5.76708 11.733 4.20001 9.80011 4.20001ZM8.63344 9.10001H7.70011V7.23335H8.63344V9.10001ZM10.2668 9.10001H9.33344V6.53335H10.2668V9.10001ZM11.9001 9.10001H10.9668V5.83335H11.9001V9.10001Z" fill="white" fill-opacity="1"/>
                                            </svg>
   
                                        </a>
                                        <a href="javascript:void(0)" ng-click="deleteAnalyzdata(video.id)" class="action-btn btn-primary"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="javascript:void(0)" ng-click="optimizevideo(video.id , video.video_info)" class="btn btn-primary       py-2" ng-if="video.optimized ==0">
                                            <i class="fa-brands fa-searchengin"></i> Optimize
                                        </a>
                                        <span class="{{ video.optimized == 1  ? 'optimized optimizer-badge'  : 'non-optimized optimizer-badge' }}">
                                            {{ video.optimized == 1 ? 'Optimized' : 'Non-Optimized' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- <form id="videoPdfForm" action="<?php echo base_url('export-video-analysis-pdf') ?>" method="POST" style="display:none;"> -->
    <!--    <input type="hidden" name="pdf_data" id="video_pdf_data_input">-->
    <!--</form>-->
    <form id="videoPdfForm" action="<?php echo base_url('export-video-analysis-pdf') ?>" method="POST" style="display:none;"> 
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="hidden" name="pdf_data" id="video_pdf_data_input">
    </form>

    <!-- videoPrModal -->
    <div class="modal fade video-pr-modal" id="videoPrModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            style="max-width: 700px; max-height: 500px;">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h6 class="modal-title fw-semibold">Video </h6>
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

                <!--            	<div class="col-12 col-sm-6 col-lg-3">-->
                <a href="<?= base_url('business-list') ?>" class="business-list-card ater-none">
                    <div class="list-header">
                        <span class="title">Business Finder</span>
                    </div>

                    <div class="modal-footer justify-content-center gap-2">
                        <!-- <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Back</button> -->
                        <!--<button type="button" id="showpLModal" class="btn btn-primary btn-no-style" ng-click="getFramIfram()" >Continue with Editor</button>-->
                        <?php if ($team_edit_video) { ?>
                            <a id="editVideoLink" href="#" class="btn btn-primary">Customize in Editor</a>
                        <?php } else { ?>
                            <a id="editVideoLink"
                                ng-click="show_msg('You do not have permission to access to Customize Video')" href="#"
                                class="btn btn-primary">Customize in Editor</a>
                        <?php } ?>
                    </div>
            </div>
        </div>
    </div>
    <!-- videoPrModal -->

    <!---Modal--->
    <div class="modal fade confirm-del " id="superModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="<?php echo base_url('superva-update'); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="row align-items-center d-flex justify-content-around">
                            <div class="col-md-3">
                                <div class="inline-flex">
                                    <input type="hidden" name="type" value="custom">
                                    <label class="overflow-hidden aspect-square mx-auto">
                                        <img src="<?= $this->config->item('assetsPath') . 'default/va/' . $this->session->userdata('super_va')->category_image ?>"
                                            id="blah" />
                                        <!--<img src="" id="output" />-->
                                        <input type="file" accept="image/*" name="superva_image"
                                            onchange="loadimg(this)">
                                    </label>

                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="fname" class="mt20 mt-md10">Update Name </label>
                                        <input type="text" id="fname" name="superva_name" placeholder="Super VA Name"
                                            value="<?= $this->session->userdata('super_va')->text ?>"
                                            class="workspace-name mt10">
                                    </div>

                                    <div class="col-md-12 mt20">
                                        <div class="modal-footer mt20">
                                            <button type="button" class="base-btn blue-btn-outline"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <!--<button type="submit" class="theme-btn-blue">Set to Default</button>-->
                                            <button type="submit" class="theme-btn-blue">Save</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 🔥 LABEL SKIP FUNCTION (MAIN FIX)
        function formatXAxisLabels(labels, maxLabels = 6) {
            const step = Math.ceil(labels.length / maxLabels);

            return labels.map((label, i) => {
                return (i % step === 0 || i === labels.length - 1) ? label : '';
            });
        }

        // CHART OPTIONS
        const initialLabels = ['Apr 20', 'Apr 23', 'Apr 27', 'Apr 30', 'May 4', 'May 7', 'May 11', 'May 14', 'May 18', 'May 21', 'May 25', 'May 28', 'Jun 1', 'Jun 4', 'Jun 8', 'Jun 11', 'Jun 15'];

        // const options = {
        //     series: [{
        //         data: [35, 32, 45, 40, 50, 42, 52, 48, 60, 55, 47, 65, 67, 63, 52, 61, 62]
        //     }],
        //      chart: {
        //         type: 'area',
        //         height: 240,
        //         toolbar: {
        //             show: false
        //         },
        //         zoom: {
        //             enabled: false
        //         },
        //         foreColor: '#8b949e' // 👈 ye new line add karni hai
        //     },
        //     stroke: {
        //         curve: 'smooth',
        //         width: 3
        //     },
        //     colors: ['#ff0000'],

        //     fill: {
        //         type: 'gradient',
        //         gradient: {
        //             shadeIntensity: 1,
        //             opacityFrom: 0.35,
        //             opacityTo: 0,
        //             stops: [0, 100]
        //         }
        //     },

        //     markers: {
        //         size: 3,
        //         strokeWidth: 0
        //     },

        //       tooltip: {
        //         theme: 'light',
        //         x: {
        //             show: true
        //         },
        //         y: {
        //             formatter: function (val) {
        //                 return val;
        //             }
        //         }
        //     },


        //     dataLabels: {
        //         enabled: false
        //     },

        //     // 🔥 FIXED X-AXIS
        //     // xaxis: {
        //     //     categories: formatXAxisLabels(initialLabels)
        //     // },
            
        //     xaxis: {
        //         categories: initialLabels,
        //         labels: {
        //             rotate: -45,
        //             style: {
        //                 colors: '#8b949e'
        //             },
        //             formatter: function(value, timestamp, index) {
        //                 const step = Math.ceil(initialLabels.length / 6);
        //                 return (index % step === 0 || index === initialLabels.length - 1)
        //                     ? value
        //                     : '';
        //             }
        //         }
        //     },

        //     yaxis: {
        //         min: 0,
        //         max: 100,
        //         tickAmount: 4
        //     },

        //     grid: {
        //         borderColor: '#eee'
        //     }
        // };
        
        const options = {
            series: [{
                name: 'Optimized Videos',
                data: []
            }],
            chart: {
                type: 'area',
                height: 275,
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#ff0000'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.35,
                    opacityTo: 0,
                    stops: [0, 100]
                }
            },
            markers: {
                size: 3
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: []
            },
            yaxis: {
                min: 0
            }
        };
        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        
        
        function formatXAxisLabels(labels, maxLabels = 6) {
            if (!labels || labels.length === 0) return [];
            const step = Math.ceil(labels.length / maxLabels);
            return labels.map((label, i) => {
                return (i % step === 0 || i === labels.length - 1) ? label : '';
            });
        }

        // FUNCTION: LAST N DAYS
        function getLastNDays(n) {
            const dates = [];
            const today = new Date();

            for (let i = n - 1; i >= 0; i--) {
                const d = new Date();
                d.setDate(today.getDate() - i);

                dates.push(
                    d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
                );
            }

            return dates;
        }

        // DATASETS
        const datasets = {
            60: {
                data: Array.from({ length: 60 }, () => Math.floor(Math.random() * 40) + 30),
                labels: getLastNDays(60)
            },
            30: {
                data: Array.from({ length: 30 }, () => Math.floor(Math.random() * 40) + 30),
                labels: getLastNDays(30)
            },
            15: {
                data: Array.from({ length: 15 }, () => Math.floor(Math.random() * 40) + 30),
                labels: getLastNDays(15)
            }
        };

        // DROPDOWN CHANGE
//         $('#range').on('changed.bs.select', function () {

//     const val = $(this).val();
//     const selected = datasets[val];

//     chart.updateOptions({
//         series: [{
//             data: selected.data
//         }],
//         xaxis: {
//             categories: selected.labels,
//             labels: {
//                 formatter: function (value, timestamp, index) {

//                     const step = Math.ceil(selected.labels.length / 6);

//                     return (index % step === 0 ||
//                             index === selected.labels.length - 1)
//                         ? value
//                         : '';
//                 }
//             }
//         }
//     });

// });

            $('#range').on('changed.bs.select', function () {
            
                        loadOptimizationChart($(this).val());
            
            });
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

        $(function () {
            //   $('#date').datepicker({
            //     dateFormat: 'dd-M-yy',
            //     minDate: 1
            //   });

            $('.date-icon').on('click', function () {
                $('#date').focus();
            })
        });

        function loadimg(ele) {
            var profileimage = ele.files[0];
            var profileType = profileimage["type"];
            var profileallowed = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
            if ($.inArray(profileType, profileallowed) < 0) {
                showFlash({
                    "error": {
                        "message": 'The filetype you are attempting to upload is not allowed',
                        "type": "flash"
                    }
                });
            } else {
                document.getElementById('blah').src = window.URL.createObjectURL(ele.files[0]);
            }
        }
    </script>

    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/jquery.min.js"></script>

    <!--open after purchase Reseller plan -->
    <?php

    // $isReseller = in_array(16, $package_plan_ids) || in_array(17, $package_plan_ids);
    
    // if ($isReseller) {
    //     echo '<script>
    //         $(document).ready(function() {
    //             $("#resellerModal").modal("show");
    //         });
    //     </script>';
    // }
    

    if (!empty($this->session->userdata('business'))) {
        $this->business_id = $this->session->userdata('business')['id'];
    } else {
        $this->business_id = $this->session->userdata('business_switch_session');
    }

    // Check if the modal has already been shown
    $modalShown = $this->session->userdata('reseller_modal_shown');

    if (!$modalShown) {
        // Set the session variable to indicate that the modal has been shown
        $this->session->set_userdata('reseller_modal_shown', true);

        $isReseller = in_array(16, $package_plan_ids) || in_array(17, $package_plan_ids);

        if ($isReseller) {
            echo '<script>
                    $(document).ready(function() {
                        $("#resellerModal").modal("show");
                    });
                </script>';
        }
    }
    ?>

    <!--<div class="modal fade" id="resellerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-lg">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header">-->
    <!--                <h5 class="modal-title" id="exampleModalLabel">Reseller Plan Information</h5>-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
    <!--                <p>Thank you for choosing the IRIS Reseller!</p>-->
    <!--                <p><a href="https://www.grabiris.com/thankyou-reseller/" target="_blank"><button class="btn btn-primary">Apply here for Your Affiliate Link To Resell</button></a></p>-->
    <!--            </div>-->
    <!--            <div class="modal-footer">-->
    <!--                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


    <script>
        var app = angular.module("AppModule", []);

        app.controller("virtualAssitant", function ($scope, $http, $timeout) {
            $scope.searchKey = '';
            $scope.currentPage = 1;
            $scope.limit = 10;
            $scope.analyz_data = [];
            $scope.commandText = "";

            $scope.availableFeatures = JSON.parse(`<?php echo json_encode($available_features) ?>`);
            $scope.commandText = "";
            
            
            $scope.checkEnter = function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            $scope.redirectToGenerator();
        }
    };

    // Redirection and prompt value pass hone ka logic
    $scope.redirectToGenerator = function() {
        if (!$scope.commandText || $scope.commandText.trim() === "") {
            toastr.error("Please enter a prompt first.");
            return;
        }

        // Ek hidden form create karke 'sendpromt' route par data POST karenge
        // Taaki PHP use session flashdata mein set karke redirect kar sake
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "<?php echo base_url('db-post-data'); ?>"; // Ya jo aapka sendpromt ka specific route url ho

        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "prompt";
        input.value = $scope.commandText;
        
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    };
            
            
             $scope.loadOptimizationChart = function (days) {
                $.ajax({
                    url: "<?= base_url('dashboard/get-optimization-graph-data') ?>",
                    type: "POST",
                    data: { days: days },
                    dataType: "json",
                    success: function (response) {
                        let labels = [];
                        let counts = [];

                        if (response && response.length > 0) {
                            $.each(response, function (index, row) {
                                labels.push(
                                    new Date(row.optimize_date).toLocaleDateString('en-US', {
                                        month: 'short',
                                        day: 'numeric'
                                    })
                                ); 
                                counts.push(parseInt(row.optimized_count));
                            });
                        }

                        chart.updateOptions({
                            series: [{
                                name: 'Optimized Videos',
                                data: counts
                            }],
                            xaxis: {
                                categories: formatXAxisLabels(labels)
                            }
                        });
                    },
                    error: function (err) {
                        console.error("Graph data load failed", err);
                    }
                });
            };

            $timeout(function () {
                let initialDays = $('#range').val() || 60;
                $scope.loadOptimizationChart(initialDays);
            }, 200);

            // Standard bootstrap-select change event trigger
            $(document).ready(function () {
                // 'changed.bs.select' bootstrap selectpicker ka custom trigger h
                $('#range').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                    var selectedVal = $(this).val();
                    $scope.$apply(function () {
                        $scope.loadOptimizationChart(selectedVal);
                    });
                });

                $('#range').on('change', function () {
                    var selectedVal = $(this).val();
                    $scope.$apply(function () {
                        $scope.loadOptimizationChart(selectedVal);
                    });
                });
            });

            /* Work By Sidharth Start */

            $scope.getanalyzedata = function () {
                let queryStr = "<?php echo base_url('get-all-analyz-data') ?>";

                $http({
                    method: 'POST',
                    url: queryStr,
                    // data: $.param({ id: id }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                    .then(function (response) {
                        if (response.data.success) {
                            let data = response.data.analyze_data;

                            data.forEach(function (item) {
                                item.video_info = JSON.parse(item.video_info || '{}');
                            });

                            $scope.analyz_data = data;
                        } else {
                            console.log(response.data.msg);
                        }
                    })
                    .catch(function () {
                        console.log("Something went wrong!");
                    });
            };

            $scope.getanalyzedata();

            $scope.downloadPDF = function (videoData) {
            if (!videoData) {
                toastr.error("No data found for this video!");
                return;
            }
        
            var payload = {
                analyze_data: videoData
            };
        
            var jsonString = angular.toJson(payload);
        
            var base64SafeData = btoa(unescape(encodeURIComponent(jsonString)));
        
            var dataInput = document.getElementById('video_pdf_data_input');
            var form = document.getElementById('videoPdfForm');
        
            if (dataInput && form) {
                dataInput.value = base64SafeData;
                
                var csrfName = "<?php echo $this->security->get_csrf_token_name(); ?>";
                var csrfInput = form.querySelector('input[name="' + csrfName + '"]');
                if(csrfInput) {
                    var matches = document.cookie.match(new RegExp('(?:^|; )' + csrfName + '=([^;]*)'));
                    if(matches) {
                        csrfInput.value = decodeURIComponent(matches[1]);
                    }
                }
        
                toastr.success("Generating your video analysis report...");
                form.submit();
            } else {
                console.error("Form or Input element not found!");
                toastr.error("Export failed. Technical configuration missing.");
            }
        };

            $scope.deleteAnalyzdata = function (id) {
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

              $scope.optimizevideo = function (id, video_info) {
                jsLoader(true);

                var queryStr = "<?php echo base_url('optimize-with-ai')?>";

                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                         'id': id,
                        'video_info': video_info
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                    .then(function (response) {
                        jsLoader(false);
                        if (response.data.success) {
                            toastr.success(response.data.msg);
                            var encodedId = btoa(id) .replace(/\+/g, '-') .replace(/\//g, '_') .replace(/=+$/, '');
                            
                            window.location.href = "<?php echo base_url('optimize-data')?>/" + encodedId;
                        } else {
                            toastr.error(response.data.msg);
                        }
                    })
                    .catch(function (err) {
                        jsLoader(false);
                        console.error(err);
                        toastr.error("Something went wrong!");
                    });
            };

            $scope.softDelete = function (id) {
                var id = id;
                var fd = new FormData();
                fd.append('id', id);
                $http({
                    method: 'POST',
                    url: siteUrl + 'delete-analyz-data',
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
                        $scope.getanalyzedata();
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }


            $scope.edit_analyz = function (id) {
                if (!id) {
                    flashNow({
                        error: { message: "Something went wrong." }
                    });
                    return;
                }

                var form = document.createElement("form");
                form.method = "POST";
                form.action = "<?php echo base_url('send-id'); ?>";

                // prompt field
                var input1 = document.createElement("input");
                input1.type = "hidden";
                input1.name = "id";
                input1.value = id;
                form.appendChild(input1);

                document.body.appendChild(form);
                form.submit();
            };

            $scope.nextPage = function () {
                var totalFiltered = $scope.getFilteredCount();
                if (($scope.currentPage * $scope.limit) < totalFiltered) {
                    $scope.currentPage++;
                }
            };

            $scope.prevPage = function () {

                if ($scope.currentPage > 1) {
                    $scope.currentPage--;
                }
            };

            $scope.getFilteredCount = function () {

                if (!$scope.analyz_data || !$scope.analyz_data.length) {
                    return 0;
                }

                let filteredData = $scope.analyz_data;
                if ($scope.searchKey && $scope.searchKey.trim() !== '') {
                    let keyword = $scope.searchKey.toLowerCase();
                    filteredData = filteredData.filter(function (video) {
                        let title = (video.title || '').toLowerCase();
                        let channel = '';
                        if (video.video_info && video.video_info.channel_name) {
                            channel = video.video_info.channel_name.toLowerCase();
                        }
                        return title.includes(keyword) || channel.includes(keyword);
                    });
                }
                return filteredData.length;
            };


            $scope.searchData = function () {
                $scope.currentPage = 1;
            };
            $scope.$watch('searchKey', function () {
                $scope.currentPage = 1;
            });

            $scope.getPaginatedData = function () {

                if (!$scope.analyz_data || !$scope.analyz_data.length) {
                    return [];
                }

                let filteredData = $scope.analyz_data;
                // Search Filter
                if ($scope.searchKey && $scope.searchKey.trim() !== '') {
                    let keyword = $scope.searchKey.toLowerCase();
                    filteredData = filteredData.filter(function (video) {
                        let title = (video.title || '').toLowerCase();
                        let channel = '';
                        if (video.video_info && video.video_info.channel_name) {
                            channel = video.video_info.channel_name.toLowerCase();
                        }
                        return title.includes(keyword) || channel.includes(keyword);
                    });
                }
                // Pagination
                let start = ($scope.currentPage - 1) * $scope.limit;
                let end = start + $scope.limit;
                return filteredData.slice(start, end);
            };



                     /* Work By Sidharth End  */


            $scope.show_msg = function (msg) {
                flashNow({ 'error': { 'message': msg } });
            };




            $scope.openWarningModal = function (assistant) {
                $('#warningModal').modal('show'); // Show the Bootstrap modal
                $('#warningModal .yes').on('click', function (e) {
                    $("#warningModal").modal("hide");
                    $scope.deleteVa(assistant.id);
                });
            };
            $scope.base_url = '<?php echo base_url(); ?>';
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



            $scope.autoresponder_options = <?php echo json_encode($autoresponder); ?>;
            $scope.assiesten_id = '';
            $scope.autoresponders = '';
            $scope.autoresponder_list_response = [];
            $scope.autoresponder_model_show = function (assiesten_id) {
                $("#exampleAutoresponderModal").modal("show");

                $scope.assiesten_id = assiesten_id;
                jsLoader(true);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('get_save_autoresponder_forms'); ?>',
                    data: {
                        'id': $scope.assiesten_id
                    },
                    dataType: 'json',
                    success: function (response) {
                        jsLoader(false);
                        $scope.autoresponders = response.data.autoresponder_id;

                        if (response.data.autoresponder_id == 0 || response.data.autoresponder_id == '') {
                            $scope.autoresponders = '';


                        } else {
                            setTimeout(function () {
                                $('.selectpicker').selectpicker('refresh')
                                $scope.setResponderFormList(response.data.autoresponder_id);
                                //$scope.autoresponders  = response.data.autoresponder_id;  

                            }, 500);


                        }

                        $scope.$apply();


                    }
                });
            }

      

        });
    </script>