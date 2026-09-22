<style>
    /* #chart{
        min-height: unset !important;
        .apexcharts-canvas{
            height: 260px !important;
            svg.apexcharts-svg{
                height: 280px !important;
            }
        }
    } */
</style>

<!-- Container Start -->
<div class="container-wrapper container-open">
    <title><?php echo $this->config->item('productName') ?> | Dashboard</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" >
     
        <div class="row gap-0 g-3" ng-app="AppModule" ng-controller="virtualAssitant">
            <div class="col-12">
                <div class="theme-card">
                    <div class="section-head section-head-style-1">
                        <h2 class="title mb-1">
                            Welcome back, <span class="text-primary"><?php echo $this->session->userdata('logged_in')['name']?></span>
                        </h2>
                        <p class="desc">
                            Here's what's happening with your YouTube growth today.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card">
                    <div class="card-content">
                        <div class="stats-info">
                            <h3 class="card-title">Total Videos Analyzed</h3>
                            <!-- <p class="stats-value">128<span class="limit">/20</span></p> -->
                            <p class="stats-value">
                                <?php echo isset($total_analyzed_videos) ? $total_analyzed_videos : 0; ?></p>
                        </div>
                        <div class="icon-box">
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M33.3705 17.1608C32.6633 16.7543 31.821 16.7573 31.116 17.1683L27 19.5698V27.681L31.116 30.0825C31.4707 30.2895 31.86 30.393 32.25 30.393C32.6348 30.393 33.0195 30.2925 33.3705 30.0908C34.0778 29.6843 34.5 28.9553 34.5 28.14V19.113C34.5 18.2977 34.0778 17.568 33.3705 17.1622V17.1608Z"
                                    fill="var(--primary-color)" />
                                <path
                                    d="M22.9515 15.9653C24.4965 14.802 25.5 12.9578 25.5 10.875C25.5 7.3545 22.6455 4.5 19.125 4.5C15.6045 4.5 12.75 7.3545 12.75 10.875C12.75 12.8317 13.6335 14.5807 15.021 15.75H10.9402C12.0502 14.7225 12.75 13.257 12.75 11.625C12.75 8.5185 10.2315 6 7.125 6C4.0185 6 1.5 8.5185 1.5 11.625C1.5 13.446 2.36925 15.0608 3.71175 16.089C2.41125 16.6785 1.5 17.982 1.5 19.5V27.75C1.5 29.8177 3.18225 31.5 5.25 31.5H21.75C23.8177 31.5 25.5 29.8177 25.5 27.75V19.5C25.5 17.8545 24.4282 16.4693 22.9515 15.9653ZM4.875 11.625C4.875 10.3822 5.88225 9.375 7.125 9.375C8.36775 9.375 9.375 10.3822 9.375 11.625C9.375 12.8678 8.36775 13.875 7.125 13.875C5.88225 13.875 4.875 12.8678 4.875 11.625ZM9 27.75H6C5.586 27.75 5.25 27.414 5.25 27C5.25 26.586 5.586 26.25 6 26.25H9C9.414 26.25 9.75 26.586 9.75 27C9.75 27.414 9.414 27.75 9 27.75ZM19.125 13.875C17.4682 13.875 16.125 12.5317 16.125 10.875C16.125 9.21825 17.4682 7.875 19.125 7.875C20.7817 7.875 22.125 9.21825 22.125 10.875C22.125 12.5317 20.7817 13.875 19.125 13.875Z"
                                    fill="var(--primary-color)" />
                            </svg>
                        </div>
                    </div>
                    <!-- <div class="comparison-box">
                        <p>vs previous 07 days <span class="trend">&uarr; 16%</span></p>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card">
                    <div class="card-content">
                        <div class="stats-info">
                            <h3 class="card-title">Average AEO Score</h3>
                            <!-- <p class="stats-value">62<span class="limit">/100</span></p> -->
                            <p class="stats-value"><?php echo isset($average_aeo_score) ? $average_aeo_score : 0; ?></p>
                        </div>
                        <div class="icon-box">
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.25 20.25H15.75C14.5074 20.25 13.5 21.2574 13.5 22.5V31.5C13.5 32.7426 14.5074 33.75 15.75 33.75H20.25C21.4926 33.75 22.5 32.7426 22.5 31.5V22.5C22.5 21.2574 21.4926 20.25 20.25 20.25Z"
                                    fill="var(--primary-color)"></path>
                                <path
                                    d="M9 23.625H4.5C3.25736 23.625 2.25 24.6324 2.25 25.875V31.5C2.25 32.7426 3.25736 33.75 4.5 33.75H9C10.2426 33.75 11.25 32.7426 11.25 31.5V25.875C11.25 24.6324 10.2426 23.625 9 23.625Z"
                                    fill="var(--primary-color)"></path>
                                <path
                                    d="M31.5 14.625H27C25.7574 14.625 24.75 15.6324 24.75 16.875V31.5C24.75 32.7426 25.7574 33.75 27 33.75H31.5C32.7426 33.75 33.75 32.7426 33.75 31.5V16.875C33.75 15.6324 32.7426 14.625 31.5 14.625Z"
                                    fill="var(--primary-color)"></path>
                                <path
                                    d="M6.75002 19.125C6.84373 19.1249 6.93707 19.1132 7.0279 19.0901C11.0546 18.0643 14.9289 16.5135 18.5513 14.4776C22.4947 12.2492 26.0978 9.46606 29.25 6.21337V9C29.25 9.29837 29.3685 9.58452 29.5795 9.7955C29.7905 10.0065 30.0767 10.125 30.375 10.125C30.6734 10.125 30.9595 10.0065 31.1705 9.7955C31.3815 9.58452 31.5 9.29837 31.5 9V3.375C31.5 3.07663 31.3815 2.79048 31.1705 2.5795C30.9595 2.36853 30.6734 2.25 30.375 2.25H24.75C24.4517 2.25 24.1655 2.36853 23.9545 2.5795C23.7435 2.79048 23.625 3.07663 23.625 3.375C23.625 3.67337 23.7435 3.95952 23.9545 4.1705C24.1655 4.38147 24.4517 4.5 24.75 4.5H27.7605C24.7313 7.66001 21.2575 10.3614 17.4488 12.519C13.9981 14.4564 10.3076 15.9316 6.47215 16.9065C6.20333 16.9714 5.96782 17.133 5.81061 17.3605C5.6534 17.5881 5.5855 17.8655 5.61987 18.1399C5.65424 18.4143 5.78847 18.6664 5.99694 18.8481C6.20541 19.0299 6.4735 19.1284 6.75002 19.125Z"
                                    fill="var(--primary-color)"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- <div class="comparison-box">
                        <p>vs previous 07 days <span class="trend">&uarr; 24%</span></p>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card">
                    <div class="card-content">
                        <div class="stats-info">
                            <h3 class="card-title">Videos Optimized</h3>
                            <!-- <p class="stats-value">462<span class="limit">/85</span></p> -->
                            <p class="stats-value">
                                <?php echo isset($total_optimized_videos) ? $total_optimized_videos : 0; ?></p>
                        </div>
                        <div class="icon-box">
                            <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_57_693)">
                                    <path
                                        d="M28.5687 13.7398L35.1801 9.92276C36.5763 12.5125 37.3692 15.4756 37.3692 18.6243H29.7412C29.7412 16.8653 29.3182 15.2052 28.5687 13.7398ZM19 27.8688C14.3045 27.8688 10.4978 24.0621 10.4978 19.3666H0.630859L0.630934 21.5374C0.630934 22.1559 1.13696 22.662 1.75557 22.662H3.80371C5.04257 22.662 6.10041 23.3689 6.57445 24.5134C7.04855 25.658 6.80037 26.9058 5.92429 27.7818L4.47598 29.2301C4.03854 29.6675 4.03854 30.3832 4.47598 30.8206L7.54604 33.8907C7.98341 34.328 8.69911 34.328 9.13648 33.8907L10.5848 32.4424C11.4608 31.5664 12.7086 31.3182 13.8531 31.7923C14.9976 32.2663 15.7045 33.3242 15.7045 34.563V36.6111C15.7045 37.2297 16.2106 37.7358 16.8291 37.7358H21.1707C21.7894 37.7358 22.2954 37.2297 22.2954 36.6111V34.5629C22.2954 33.3241 23.0022 32.2662 24.1468 31.7922C25.2913 31.3182 26.5391 31.5664 27.4151 32.4424L28.8634 33.8907C29.3007 34.328 30.0165 34.328 30.4538 33.8907L33.5239 30.8206C33.9612 30.3832 33.9612 29.6675 33.5239 29.2301L32.0756 27.7818C31.1996 26.9058 30.9514 25.658 31.4254 24.5134C31.8995 23.3689 32.9573 22.662 34.1961 22.662H36.2444C36.8629 22.662 37.369 22.156 37.369 21.5374V19.3666H27.5021C27.5022 24.0621 23.6955 27.8688 19 27.8688ZM28.0134 12.7805L34.6248 8.9634C33.1255 6.54424 31.0802 4.499 28.6607 3L24.844 9.61074C26.1096 10.433 27.1912 11.5148 28.0134 12.7805ZM27.7018 2.44396C25.2651 1.13066 22.4976 0.351878 19.5566 0.264374V7.89733C21.1092 7.97659 22.5744 8.38613 23.8843 9.05618L27.7018 2.44396ZM19 16.5244C19.2695 16.5244 19.5303 16.5619 19.7773 16.6321L25.3021 13.0644L21.7345 18.5892C21.8047 18.8363 21.8421 19.097 21.8421 19.3665C21.8421 20.9361 20.5697 22.2086 19.0001 22.2086C17.4304 22.2086 16.158 20.9361 16.158 19.3665C16.1579 17.7968 17.4303 16.5244 19 16.5244ZM18.0458 19.3665C18.0458 19.8934 18.473 20.3207 19 20.3207C19.527 20.3207 19.9542 19.8934 19.9542 19.3665C19.9542 18.8395 19.527 18.4124 19 18.4124C18.473 18.4124 18.0458 18.8395 18.0458 19.3665ZM19 23.3218C16.816 23.3218 15.0447 21.5505 15.0447 19.3665H11.6111C11.6111 23.4473 14.9192 26.7554 19 26.7554C23.0809 26.7554 26.3889 23.4473 26.3889 19.3665H22.9553C22.9553 21.5506 21.184 23.3218 19 23.3218ZM18.4434 7.89733V0.264374C15.5027 0.351878 12.7358 1.13066 10.2992 2.44351L14.1167 9.05566C15.4264 8.38591 16.8911 7.97652 18.4434 7.89733ZM13.1551 9.61133L9.33835 3.00052C6.91927 4.49952 4.87439 6.54462 3.37517 8.9634L9.98658 12.7805C10.8087 11.515 11.8898 10.4335 13.1551 9.61133ZM9.43135 13.7398L2.81994 9.92276C1.42366 12.5125 0.630859 15.4757 0.630859 18.6243H8.25877C8.25877 16.8653 8.68166 15.2051 9.43135 13.7398Z"
                                        fill="var(--primary-color)"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_57_693">
                                        <rect width="38" height="38" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <!-- <div class="comparison-box">
                        <p>vs previous 07 days <span class="trend">&uarr; 08%</span></p>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="stat-card theme-card">
                    <div class="card-content">
                        <div class="stats-info">
                            <h3 class="card-title">Score Improvement</h3>
                            <p class="stats-value">
                                +<?php echo isset($improvement_percentage) ? $improvement_percentage : 0; ?><span
                                    class="limit">%</span></p>
                        </div>
                        <div class="icon-box">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M26.9167 0H4.75C2.1307 0 0 2.1307 0 4.75V22.1667C0 24.786 2.1307 26.9167 4.75 26.9167H11.8193L14.516 30.9616C14.8105 31.4023 15.3045 31.6667 15.8333 31.6667H15.8805C16.4271 31.6497 16.9257 31.3528 17.201 30.8812L19.5133 26.9167H26.9167C29.536 26.9167 31.6667 24.786 31.6667 22.1667V4.75C31.6667 2.1307 29.536 0 26.9167 0ZM23.4841 11.8039L21.3394 15.02L22.4357 19.4082C22.5857 20.0081 22.3739 20.6405 21.8914 21.0271C21.4059 21.4152 20.7426 21.4817 20.1921 21.208L15.8333 19.0294L11.4745 21.208C11.2503 21.3193 11.0076 21.375 10.7664 21.375C10.413 21.375 10.0621 21.2575 9.77523 21.0271C9.29358 20.639 9.0802 20.0081 9.23018 19.4082L10.3272 15.02L8.18262 11.8039C7.85868 11.3184 7.82853 10.6937 8.10376 10.1788C8.37976 9.6639 8.9163 9.34229 9.5 9.34229H12.4525L14.516 6.24675C14.8097 5.80607 15.3038 5.54167 15.8333 5.54167C16.3629 5.54167 16.8569 5.80607 17.1507 6.24675L19.2134 9.34229H22.1667C22.7511 9.34229 23.2877 9.6639 23.5629 10.1788C23.8381 10.6937 23.8072 11.3184 23.4841 11.8039Z"
                                    fill="var(--primary-color)"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- <div class="comparison-box">
                        <p>vs previous 07 days <span class="trend">&uarr; 65%</span></p>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-8 col-lg-6">
                <div class="theme-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <label class="form-label mb-0">AEO Score Over Time</label>
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <div style="width: 130px">
                            <select class="selectpicker" id="range">
                                <option value="60" selected>Last 60 Days</option>
                                <option value="30">Last 30 Days</option>
                                <option value="15">Last 15 Days</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                    <div class="text-center">
                        <div class="chip-primary d-inline-flex align-items-center gap-2 text-primary">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.091 7.67922L12.2737 7.15988C11.4553 6.92915 10.7098 6.49226 10.1085 5.89101C9.50728 5.28976 9.07039 4.54428 8.83967 3.72588L8.32033 1.90855C8.29421 1.84497 8.24978 1.79058 8.19269 1.75231C8.13559 1.71404 8.0684 1.6936 7.99967 1.6936C7.93093 1.6936 7.86374 1.71404 7.80664 1.75231C7.74955 1.79058 7.70512 1.84497 7.679 1.90855L7.15967 3.72588C6.92894 4.54428 6.49205 5.28976 5.8908 5.89101C5.28955 6.49226 4.54406 6.92915 3.72567 7.15988L1.90833 7.67922C1.83855 7.69902 1.77714 7.74105 1.73341 7.79892C1.68968 7.85679 1.66602 7.92735 1.66602 7.99988C1.66602 8.07242 1.68968 8.14297 1.73341 8.20085C1.77714 8.25872 1.83855 8.30074 1.90833 8.32055L3.72567 8.83988C4.54406 9.07061 5.28955 9.5075 5.8908 10.1088C6.49205 10.71 6.92894 11.4555 7.15967 12.2739L7.679 14.0912C7.6988 14.161 7.74083 14.2224 7.7987 14.2661C7.85657 14.3099 7.92713 14.3335 7.99967 14.3335C8.0722 14.3335 8.14276 14.3099 8.20063 14.2661C8.2585 14.2224 8.30053 14.161 8.32033 14.0912L8.83967 12.2739C9.07039 11.4555 9.50728 10.71 10.1085 10.1088C10.7098 9.5075 11.4553 9.07061 12.2737 8.83988L14.091 8.32055C14.1608 8.30074 14.2222 8.25872 14.2659 8.20085C14.3097 8.14297 14.3333 8.07242 14.3333 7.99988C14.3333 7.92735 14.3097 7.85679 14.2659 7.79892C14.2222 7.74105 14.1608 7.69902 14.091 7.67922Z"
                                    fill="var(--primary-color)" />
                            </svg>
                            Great job! Your AEO score is improving consistently.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="theme-card h-100">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <label class="form-label mb-0">Score Improvement Overview</label>
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="improvement-gauge">
                        <div 
                            class="gauge-wrapper"
                            style="
                                --percent: <?php echo isset($improvement_percentage) ? $improvement_percentage : 0; ?>;
                                --score-color: <?php 
                                    $score = isset($improvement_percentage) ? $improvement_percentage : 0;
                                    if ($score <= 40) {
                                        echo '#ef4444'; // Red
                                    } elseif ($score <= 70) {
                                        echo '#facc15'; // Yellow
                                    } else {
                                        echo '#22c55e'; // Green
                                    }
                                ?>;
                            "
                        >
                            <svg viewBox="0 34 100 50" class="gauge-svg" preserveAspectRatio="xMidYMid meet">
                                <path class="gauge-track" d="M 20 80 A 32 32 0 1 1 80 80"></path>
                                <path class="gauge-fill" d="M 20 80 A 32 32 0 1 1 80 80"></path>
                            </svg>

                            <div class="gauge-content">
                                <?php
                                    $current_val = isset($improvement_percentage) ? $improvement_percentage : 0;
                                    $gauge_color = ($current_val <= 40) ? '#ef4444' : (($current_val <= 70) ? '#facc15' : '#22c55e');
                                ?>
                                <h2 class="gauge-value" style="color: <?php echo $gauge_color; ?>;">
                                    <span>+</span><?php echo $current_val; ?>%
                                </h2>
                                <p class="gauge-label">Average<br>Improvement</p>
                            </div>
                        </div>
                        <!-- <div class="info-banner">
                            <p>You're improving <span>18%</span> better than last week!</p>
                        </div> -->
                    </div>
                    <div class="row row-gap-2 gy-0 gx-3 mt-3 justify-content-center">
                        <!-- <div class="col-sm-4 col-6">
                            <div class="status-card decreased">
                                <div class="status-header">
                                    <i class="fa-solid fa-arrow-down"></i>
                                    <span>Decreased</span>
                                </div>
                                <div class="status-divider"></div>
                                <div class="status-footer">08 Videos</div>
                            </div>
                        </div> -->

                        <div class="col-sm-4 col-6">
                            <div class="status-card no-change">
                                <div class="status-header">
                                    <i class="fa-solid fa-minus"></i>
                                    <span>No Change</span>
                                </div>
                                <div class="status-divider"></div>
                                <div class="status-footer">
                                    <?php echo sprintf("%02d", isset($no_change_videos) ? $no_change_videos : 0); ?>
                                    Videos</div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-6">
                            <div class="status-card increase">
                                <div class="status-header">
                                    <i class="fa-solid fa-arrow-up"></i>
                                    <span>Increase</span>
                                </div>
                                <div class="status-divider"></div>
                                <div class="status-footer">
                                    <?php echo sprintf("%02d", isset($increased_videos) ? $increased_videos : 0); ?>
                                    Videos</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('analyz-data');?>"
                        class="chip-primary d-flex align-items-center justify-content-center gap-2 text-primary mt-3">
                        View Full Report <i class="fa-solid fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-12 col-lg-6">
                <div class="theme-card">
                    <div class="d-flex align-items-center justify-content-start mb-2">
                        <label class="form-label mb-0">Quick Actions</label>
                    </div>
                    <div class="row gap-0 g-3 my-auto">
                        <div class="col-sm-2">
                            <div class="icons-box-wrapper style-2">
                                <a class="content" href="<?= base_url('client-management')?>">
                                    <span class="icon-panel">
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.02734 12.9459H2.15975C1.54199 12.9459 1.03705 13.4455 1.03705 14.0632V22.6794C1.03705 23.2972 1.54199 23.8021 2.15975 23.8021H6.02734C6.6451 23.8021 7.15004 23.2972 7.15004 22.6794V14.0632C7.15004 13.4455 6.6451 12.9459 6.02734 12.9459ZM3.90017 22.0832C3.33615 22.0832 2.87954 21.632 2.87954 21.0679C2.87954 20.5039 3.33615 20.0473 3.90017 20.0473C4.45882 20.0473 4.91543 20.5039 4.91543 21.0679C4.91543 21.632 4.45881 22.0832 3.90017 22.0832Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M26.9287 18.2961C26.8481 17.947 26.6332 17.6569 26.3217 17.485C26.0101 17.3077 25.6502 17.2702 25.3118 17.383L17.1898 20.0419C16.9319 20.1333 16.6526 20.1816 16.3679 20.1816H12.2693C12.0437 20.1816 11.8664 20.0043 11.8664 19.7787C11.8664 19.5585 12.0437 19.3759 12.2693 19.3759H16.3679C16.5559 19.3759 16.7332 19.349 16.9051 19.2899C16.9104 19.2899 16.9158 19.2845 16.9212 19.2845L16.9266 19.2792C17.5712 19.0535 18.0331 18.4304 18.0331 17.7106C18.0331 16.7867 17.2865 16.04 16.3679 16.04H13.7035C13.0697 16.04 12.4627 15.7714 12.0383 15.2987L11.4743 14.6756C11.2003 14.3748 10.8082 14.2029 10.3999 14.2029H7.95583V22.6794C7.95583 22.8191 7.93973 22.9534 7.91284 23.0823L11.6784 25.2257C13.2469 26.1173 15.1861 26.112 16.7493 25.2095L26.3324 19.6659C26.8159 19.3866 27.0576 18.8387 26.9287 18.2961Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M13.6552 8.40687C12.6292 9.04073 11.8127 9.99149 11.3561 11.1464H7.59052C6.8546 11.1464 6.33891 10.4105 6.59677 9.72291C7.19302 8.13291 8.72394 6.99945 10.5235 6.99945C11.7751 6.99946 12.8924 7.542 13.6552 8.40687Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M12.5154 4.10116C12.5154 5.20178 11.6244 6.09273 10.5238 6.09273C9.42323 6.09273 8.53229 5.20178 8.53229 4.10116C8.53229 3.00057 9.42324 2.10962 10.5238 2.10962C11.6244 2.10962 12.5154 3.00057 12.5154 4.10116Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M25.763 11.1464H21.9384C21.4871 10.0022 20.6814 9.0622 19.6769 8.42834C20.445 7.55275 21.5731 6.99945 22.8354 6.99945C24.6296 6.99945 26.1605 8.13291 26.7568 9.72291C27.0093 10.4105 26.4989 11.1464 25.763 11.1464Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M24.8238 4.10116C24.8238 5.20178 23.9328 6.09273 22.8322 6.09273C21.7316 6.09273 20.8407 5.20178 20.8407 4.10116C20.8407 3.00057 21.7316 2.10962 22.8322 2.10962C23.9328 2.10962 24.8238 3.00057 24.8238 4.10116Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M20.0694 13.1943C20.9271 13.1943 21.5261 12.3357 21.2262 11.5321C20.534 9.67748 18.7469 8.3555 16.6519 8.3555C14.5511 8.3555 12.7628 9.67741 12.0703 11.5319C11.7702 12.3355 12.3692 13.1943 13.227 13.1943L20.0694 13.1943Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M18.9715 4.89037C18.9715 6.17435 17.9321 7.21371 16.6481 7.21371C15.3642 7.21371 14.3248 6.17435 14.3248 4.89037C14.3248 3.60644 15.3642 2.56708 16.6481 2.56708C17.9321 2.56708 18.9715 3.60644 18.9715 4.89037Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                        </svg>
                                    </span>
                                    <span class="text">Manage</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="icons-box-wrapper style-2">
                                <a class="content" href="<?= base_url('team-management')?>">
                                    <span class="icon-panel">
                                        <i class="fa-solid fa-users-gear"></i>
                                    </span>
                                    <span class="text">Teams</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="icons-box-wrapper style-2">
                                <a class="content" href="<?= base_url('integration')?>">
                                    <span class="icon-panel">
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.25781 20.6274V22.5955L5.52929 24.1113C5.15359 23.8075 4.67595 23.625 4.15625 23.625C2.95006 23.625 1.96875 24.6063 1.96875 25.8125C1.96875 27.0187 2.95006 28 4.15625 28C5.36244 28 6.34375 27.0187 6.34375 25.8125C6.34375 25.7219 6.33757 25.6327 6.3268 25.545L9.47647 23.7952C9.73695 23.6505 9.89844 23.376 9.89844 23.0781V20.043L9.50808 20.2772C9.13013 20.504 8.69816 20.6246 8.25781 20.6274Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M14.8203 23.7852V22.4219H13.1797V23.7852C12.3789 24.1104 11.8125 24.8963 11.8125 25.8125C11.8125 27.0187 12.7938 28 14 28C15.2062 28 16.1875 27.0187 16.1875 25.8125C16.1875 24.8963 15.6212 24.1104 14.8203 23.7852Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M23.8438 23.625C23.3241 23.625 22.8464 23.8075 22.4707 24.1113L19.7422 22.5955V20.6274C19.3018 20.6246 18.8699 20.504 18.492 20.2772L18.1016 20.043V23.0781C18.1016 23.376 18.2631 23.6505 18.5235 23.7952L21.6732 25.545C21.6624 25.6327 21.6562 25.7219 21.6562 25.8125C21.6562 27.0187 22.6376 28 23.8438 28C25.0499 28 26.0312 27.0187 26.0312 25.8125C26.0312 24.6063 25.0499 23.625 23.8438 23.625Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M20.3382 18.747L22.3564 16.7287C22.6226 16.4626 22.6734 16.0494 22.4798 15.7266L21.7302 14.4772C21.984 13.997 22.193 13.4914 22.3542 12.9673L23.7693 12.6136C24.1344 12.5223 24.3906 12.1942 24.3906 11.8177V8.9635C24.3906 8.58709 24.1344 8.25896 23.7693 8.16769L22.3542 7.81391C22.193 7.28984 21.984 6.78415 21.7301 6.30399L22.4798 5.05455C22.6734 4.73178 22.6226 4.31862 22.3564 4.05245L20.3382 2.03421C20.0721 1.76805 19.6589 1.71719 19.3361 1.91084L18.0866 2.66049C17.6065 2.40658 17.1008 2.19762 16.5768 2.03645L16.223 0.621359C16.1317 0.256156 15.8035 0 15.4271 0H12.5729C12.1965 0 11.8683 0.256156 11.7771 0.621359L11.4233 2.03645C10.8993 2.19756 10.3936 2.40663 9.91348 2.66049L8.66392 1.91084C8.34116 1.71719 7.92799 1.76805 7.66188 2.03421L5.64364 4.05245C5.37748 4.31862 5.32662 4.73178 5.52027 5.05455L6.26992 6.30399C6.01601 6.78415 5.80705 7.28984 5.64588 7.81391L4.23079 8.16769C3.86553 8.25896 3.60938 8.58709 3.60938 8.9635V11.8177C3.60938 12.1942 3.86553 12.5223 4.23073 12.6136L5.64583 12.9673C5.80699 13.4914 6.01601 13.9971 6.26981 14.4772L5.52021 15.7266C5.32656 16.0494 5.37742 16.4626 5.64359 16.7287L7.66183 18.747C7.92799 19.0132 8.34116 19.0641 8.66392 18.8704L9.91337 18.1208C10.3936 18.3747 10.8993 18.5837 11.4232 18.7449L11.777 20.1599C11.8683 20.5251 12.1964 20.7813 12.5728 20.7813H15.4271C15.8035 20.7813 16.1316 20.5251 16.2229 20.1599L16.5767 18.7449C17.1006 18.5837 17.6063 18.3747 18.0865 18.1208L19.336 18.8704C19.6588 19.0641 20.072 19.0132 20.3382 18.747ZM14 14.2188C11.8858 14.2188 10.1719 12.5048 10.1719 10.3906C10.1719 8.27641 11.8858 6.5625 14 6.5625C16.1142 6.5625 17.8281 8.27641 17.8281 10.3906C17.8281 12.5048 16.1142 14.2188 14 14.2188Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                        </svg>
                                    </span>
                                    <span class="text">Integrations</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="icons-box-wrapper style-2">
                                <a class="content" href="<?= base_url('training')?>">
                                    <span class="icon-panel">
                                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.4213 1.70488H7.23132V1.33799C7.23132 0.599056 6.63229 0 5.89333 0C5.15436 0 4.55534 0.599056 4.55534 1.33799V1.70488H1.36533C0.613346 1.70488 0 2.31289 0 3.06488V8.64886C0 9.40088 0.613346 10.0195 1.36533 10.0195H3.75238L2.73949 12.0245C2.60635 12.2879 2.71182 12.6094 2.97542 12.7426C3.23585 12.8745 3.55974 12.7721 3.69372 12.5063L4.95003 10.0195H6.83649L8.09281 12.5063C8.22686 12.7723 8.5508 12.8745 8.8111 12.7426C9.07471 12.6094 9.18018 12.2879 9.04704 12.0245L8.03415 10.0195H10.4213C11.1733 10.0195 11.7867 9.40088 11.7867 8.64886V3.06488C11.7867 2.31289 11.1733 1.70488 10.4213 1.70488ZM5.06133 7.33154C4.832 7.21423 4.68799 6.97956 4.68799 6.7182V4.79287C4.68799 4.53154 4.832 4.29688 5.06133 4.18486C5.29066 4.06755 5.56266 4.08887 5.77067 4.23822L7.08799 5.20889C7.26934 5.33688 7.36533 5.53955 7.36533 5.7582C7.36533 5.97689 7.26934 6.17422 7.08799 6.30221L5.77067 7.27288C5.52377 7.4524 5.28912 7.42747 5.06133 7.33154Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                        </svg>
                                    </span>
                                    <span class="text">Tutorials</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="icons-box-wrapper style-2">
                                <a class="content" href="<?= base_url('vip-bonuses')?>">
                                    <span class="icon-panel">
                                        <i class="fa-solid fa-gift"></i>
                                    </span>
                                    <span class="text">Bonuses</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="icons-box-wrapper style-2">
                                <a class="content" href="<?= base_url('faqs')?>">
                                    <span class="icon-panel">
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.4688 19.4141H18.0914C17.9501 21.5485 16.1697 23.2422 14 23.2422C11.8303 23.2422 10.0499 21.5485 9.90855 19.4141H8.53125C4.76191 19.4141 1.69531 22.4807 1.69531 26.25V27.1797C1.69531 27.6327 2.06259 28 2.51562 28H25.4844C25.9374 28 26.3047 27.6327 26.3047 27.1797V26.25C26.3047 22.4807 23.2381 19.4141 19.4688 19.4141Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M6.89062 12.3047V9.02344C5.98451 9.02344 5.25 9.75795 5.25 10.6641C5.25 11.5702 5.98451 12.3047 6.89062 12.3047Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M16.1544 5.43561C16.4499 5.14002 16.9205 5.11399 17.2469 5.37507L19.7565 7.38281H21.1094V7.10938C21.1094 3.18298 17.9264 0 14 0C10.0736 0 6.89062 3.18298 6.89062 7.10938V7.38281H11.4535C13.2167 7.38281 14.9076 6.68237 16.1544 5.43561Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M11.5391 18.7013V19.1407C11.5391 20.4998 12.6409 21.6016 14 21.6016C15.3591 21.6016 16.4609 20.4998 16.4609 19.1407V18.7013C15.6937 18.9852 14.8647 19.1407 14 19.1407C13.1353 19.1407 12.3063 18.9853 11.5391 18.7013Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M13.7266 15.0391C13.7266 14.586 14.0938 14.2187 14.5469 14.2187H19.0133C19.306 13.5488 19.4688 12.8091 19.4688 12.0312V9.25361L16.77 7.0946C15.2813 8.34328 13.4195 9.02343 11.4533 9.02343H8.53125V12.0312C8.53125 15.0515 10.9797 17.5 14 17.5C15.5297 17.5 16.9124 16.8717 17.905 15.8594H14.5469C14.0938 15.8594 13.7266 15.4921 13.7266 15.0391Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                            <path
                                                d="M21.1093 12.3047H21.9296V12.8516C21.9296 13.6054 21.3163 14.2188 20.5624 14.2188H19.0132C18.745 14.8326 18.3673 15.3877 17.9049 15.8594H20.5624C22.221 15.8594 23.5703 14.5101 23.5703 12.8516V10.6641C23.5703 9.75795 22.8358 9.02344 21.9296 9.02344H21.1093V12.3047Z"
                                                fill="rgba(255, 255, 255, 0.8)" />
                                        </svg>
                                    </span>
                                    <span class="text">Support</span>
                                </a>
                            </div>
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
                                <span class="{{ video.optimized == 1  ? 'optimized optimizer-badge'  : 'non-optimized optimizer-badge' }}">
                                    {{ video.optimized == 1 ? 'Optimized' : 'Non-Optimized' }}
                                </span>
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
                                <div class="d-flex align-items-end gap-3 align-self-stretch">
                                    <!-- ngIf: video.optimized ==0 -->
                                    <a href="javascript:void(0)" ng-click="optimizevideo(video.id , video.video_info)" class="btn btn-primary       py-2" ng-if="video.optimized ==0">
                                        <i class="fa-brands fa-searchengin"></i> Optimize
                                    </a>
                                    <a href="javascript:void(0)" ng-click="downloadPDF(video)" class="action-btn btn-primary"><i
                                            class="fa-solid fa-download"></i></a>
                                    <a href="javascript:void(0)" ng-click="edit_analyz(video.id)" class="action-btn btn-primary"><i
                                            class="fa-solid fa-wand-magic-sparkles"></i></a>
                                    <a href="javascript:void(0)" ng-click="deleteAnalyzdata(video.id)" class="action-btn btn-primary"><i
                                            class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
     <form id="videoPdfForm" action="<?php echo base_url('export-video-analysis-pdf') ?>" method="POST" style="display:none;"> 
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

        const options = {
            series: [{
                data: [35, 32, 45, 40, 50, 42, 52, 48, 60, 55, 47, 65, 67, 63, 52, 61, 62]
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
                size: 3,
                strokeWidth: 0
            },

            dataLabels: {
                enabled: false
            },

            // 🔥 FIXED X-AXIS
            xaxis: {
                categories: formatXAxisLabels(initialLabels)
            },

            yaxis: {
                min: 0,
                max: 100,
                tickAmount: 4
            },

            grid: {
                borderColor: '#eee'
            }
        };

        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

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
        $('#range').on('changed.bs.select', function () {
            const val = $(this).val();
            const selected = datasets[val];

            chart.updateOptions({
                series: [{ data: selected.data }],
                xaxis: {
                    categories: formatXAxisLabels(selected.labels) // 🔥 MAIN FIX
                }
            });
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

            $scope.availableFeatures = JSON.parse(`<?php echo json_encode($available_features) ?>`);
            $scope.commandText = "";

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

                var dataInput = document.getElementById('video_pdf_data_input');
                var form = document.getElementById('videoPdfForm');

                if (dataInput && form) {
                    dataInput.value = JSON.stringify(payload);
                    form.submit();
                    toastr.success("Preparing report for: " + videoData.title);
                } else {
                    console.error("Form or Input element not found!");
                    toastr.error("Export failed. Technical issue.");
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