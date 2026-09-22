<style>
    .spinner-border{
        height: 25px!important;
        width: 25px!important;
    }
</style>
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="visController" ng-cloak>
    <title><?php echo $this->config->item('productName') ?> | Avatar</title>
    <div class="container-fluid container-padding">
        <div class="row">
            <div class="col-12">
                <h2 class="title mb-4 text-center text-primary w600">Create Your AI Avatar Video</h2>
                <div class="d-flex justify-content-center align-items-center avatar-main-tabs">
                    <ul class="nav nav-pills nav-pills-style-4 mb-0 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link active" id="pills-avatar-tab" data-bs-toggle="pill" data-bs-target="#pills-avatar" type="button" role="tab" aria-controls="pills-avatar" aria-selected="true">
                                <i class="fa-solid fa-video-plus"></i>
                                Create Video
                            </button>
                        </li>
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link" id="pills-voice-tab" disabled data-bs-toggle="pill" data-bs-target="#pills-voice" type="button" role="tab" aria-controls="pills-voice" aria-selected="false" style="transition: 0.2s">
                                <i class="fa-solid fa-thumbs-up"></i>
                                Finalize Video
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="row mt-3 mt-sm-5">
                    <div class="col-12">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-avatar" role="tabpanel" aria-labelledby="pills-avatar-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="theme-card">
                                            <div class="row gap-0 g-3">
                                                <div class="col-lg-6">
                                                    <div id="ideaContainer" class="theme-bg-dark p-3 border radius-3 custom-scroll" style="height: 550px; scrollbar-width: none;">
                                                        <div class="mb-3">
                                                            <h6 class="title title-design">
                                                                <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.3766 14.3047H6.91406C3.09375 14.3047 0 17.3984 0 21.2188C0 22.7563 1.24687 24.0031 2.78437 24.0031H18.5062C20.0437 24.0031 21.2906 22.7563 21.2906 21.2188C21.2906 17.3984 18.1969 14.3047 14.3766 14.3047Z" fill="var(--primary-color)"/>
                                                                    <path d="M10.6484 12.3281C14.0528 12.3281 16.8125 9.56838 16.8125 6.16406C16.8125 2.75974 14.0528 0 10.6484 0C7.24412 0 4.48438 2.75974 4.48438 6.16406C4.48438 9.56838 7.24412 12.3281 10.6484 12.3281Z" fill="var(--primary-color)"/>
                                                                </svg>
                                                                Avatar Name
                                                            </h6>
                                                            <div class="theme-card theme-card-style-2">
                                                                <label class="form-label" for="avatar_name">Name</label>
                                                                <input type="text" class="form-control" ng-model="avatar_name" id="avatar_name" placeholder="Enter Your Avatar Name" autocomplete="off">    
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6 class="title title-design">
                                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_2306_672)">
                                                                    <path d="M15 4.32125C14.4825 4.32125 14.0625 3.90125 14.0625 3.38375V0.9375C14.0625 0.42 14.4825 0 15 0C15.5175 0 15.9375 0.42 15.9375 0.9375V3.38375C15.9375 3.90125 15.5175 4.32125 15 4.32125Z" fill="var(--primary-color)"/>
                                                                    <path d="M23.2106 7.72312C22.9706 7.72312 22.7306 7.63188 22.5481 7.44813C22.1819 7.08188 22.1819 6.48812 22.5481 6.12187L24.2781 4.39188C24.6444 4.02563 25.2381 4.02563 25.6044 4.39188C25.9706 4.75813 25.9706 5.35187 25.6044 5.71812L23.8744 7.44813C23.6906 7.63063 23.4506 7.72312 23.2106 7.72312Z" fill="var(--primary-color)"/>
                                                                    <path d="M29.0634 15.9375H26.6172C26.0997 15.9375 25.6797 15.5175 25.6797 15C25.6797 14.4825 26.0997 14.0625 26.6172 14.0625H29.0634C29.5809 14.0625 30.0009 14.4825 30.0009 15C30.0009 15.5175 29.5809 15.9375 29.0634 15.9375Z" fill="var(--primary-color)"/>
                                                                    <path d="M24.9406 25.8794C24.7006 25.8794 24.4606 25.7881 24.2781 25.6044L22.5481 23.8744C22.1819 23.5081 22.1819 22.9144 22.5481 22.5481C22.9144 22.1819 23.5081 22.1819 23.8744 22.5481L25.6044 24.2781C25.9706 24.6444 25.9706 25.2381 25.6044 25.6044C25.4206 25.7881 25.1806 25.8794 24.9406 25.8794Z" fill="var(--primary-color)"/>
                                                                    <path d="M5.05437 25.8794C4.81437 25.8794 4.57438 25.7881 4.39188 25.6044C4.02563 25.2381 4.02563 24.6444 4.39188 24.2781L6.12188 22.5481C6.48813 22.1819 7.08187 22.1819 7.44812 22.5481C7.81437 22.9144 7.81437 23.5081 7.44812 23.8744L5.71813 25.6044C5.53438 25.7881 5.29437 25.8794 5.05437 25.8794Z" fill="var(--primary-color)"/>
                                                                    <path d="M3.38375 15.9375H0.9375C0.42 15.9375 0 15.5175 0 15C0 14.4825 0.42 14.0625 0.9375 14.0625H3.38375C3.90125 14.0625 4.32125 14.4825 4.32125 15C4.32125 15.5175 3.90125 15.9375 3.38375 15.9375Z" fill="var(--primary-color)"/>
                                                                    <path d="M6.78437 7.72312C6.54437 7.72312 6.30438 7.63188 6.12188 7.44813L4.39188 5.71812C4.02563 5.35187 4.02563 4.75813 4.39188 4.39188C4.75813 4.02563 5.35188 4.02563 5.71813 4.39188L7.44812 6.12187C7.81437 6.48812 7.81437 7.08188 7.44812 7.44813C7.26312 7.63063 7.02437 7.72312 6.78437 7.72312Z" fill="var(--primary-color)"/>
                                                                    <path d="M18.75 26.25V27.8125C18.75 29.0125 17.7625 30 16.5625 30H13.4375C12.3875 30 11.25 29.2 11.25 27.45V26.25H18.75Z" fill="var(--primary-color)"/>
                                                                    <path d="M20.5141 8.19829C18.4641 6.53579 15.7641 5.88579 13.1266 6.44829C9.81411 7.13579 7.12661 9.83579 6.43911 13.1483C5.73911 16.5483 7.01411 19.9233 9.73911 21.9858C10.4766 22.5358 10.9891 23.3858 11.1641 24.3733V24.3858C11.1891 24.3733 11.2266 24.3733 11.2516 24.3733H18.7516C18.7766 24.3733 18.7891 24.3733 18.8141 24.3858V24.3733C18.9891 23.4233 19.5516 22.5483 20.4141 21.8733C22.5266 20.1983 23.7516 17.6983 23.7516 14.9983C23.7516 12.3483 22.5766 9.87329 20.5141 8.19829ZM19.6891 15.6233C19.1766 15.6233 18.7516 15.1983 18.7516 14.6858C18.7516 12.7858 17.2141 11.2483 15.3141 11.2483C14.8016 11.2483 14.3766 10.8233 14.3766 10.3108C14.3766 9.79829 14.8016 9.37329 15.3141 9.37329C18.2391 9.37329 20.6266 11.7608 20.6266 14.6858C20.6266 15.1983 20.2016 15.6233 19.6891 15.6233Z" fill="var(--primary-color)"/>
                                                                    <path d="M11.1641 24.375H11.2516C11.2266 24.375 11.1891 24.375 11.1641 24.3875V24.375Z" fill="var(--primary-color)"/>
                                                                    <path d="M18.8125 24.375V24.3875C18.7875 24.375 18.775 24.375 18.75 24.375H18.8125Z" fill="var(--primary-color)"/>
                                                                    </g>
                                                                    <defs>
                                                                    <clipPath id="clip0_2306_672">
                                                                    <rect width="30" height="30" fill="white"/>
                                                                    </clipPath>
                                                                    </defs>
                                                                    </svg>

                                                                Create Video Ideas
                                                            </h6>
                                                            <div class="theme-card theme-card-style-2">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="platform">Niche</label>
                                                                    <select name="platform" id="platform" title="Niche" ng-model="selected_platform">
                                                                        <option value="" hidden></option>
                                                                        <option value="make-money-online">Make Money Online</option>
                                                                        <option value="real-estate">Real Estate</option>
                                                                        <option value="health-fitness">Health & Fitness</option>
                                                                        <option value="weight-loss">Weight Loss</option>
                                                                        <option value="finance-investing">Finance / Investing</option>
                                                                        <option value="crypto">Crypto</option>
                                                                        <option value="e-commerce">E-commerce</option>
                                                                        <option value="digital-marketing">Digital Marketing</option>
                                                                        <option value="ai-tools">AI Tools</option>
                                                                        <option value="motivation">Motivation</option>
                                                                        <option value="education">Education</option>
                                                                        <option value="travel">Travel</option>
                                                                        <option value="food">Food</option>
                                                                        <option value="beauty-skincare">Beauty / Skincare</option>
                                                                        <option value="local-business">Local Business</option> 
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="target_audience">Goal</label>
                                                                    <select name="target_audience" id="target_audience" title="Goal" ng-model="selected_video_goal">
                                                                        <option value="" hidden></option>
                                                                        <option value="get_views">Get Views</option>
                                                                        <option value="generate_leads">Generate Leads</option>
                                                                        <option value="drive_sales">Drive Sales</option>
                                                                        <option value="build_authority">Build Authority</option>
                                                                        <option value="grow_followers">Grow Followers</option>
                                                                        <!-- <option value="marketers">Marketers</option>
                                                                        <option value="content_creators">Content Creators</option>
                                                                        <option value="coaches_consultants">Coaches & Consultants</option>
                                                                        <option value="students">Students</option>
                                                                        <option value="general_audience">General Audience</option>  -->
                                                                    </select>
                                                                </div>
                                                                <div class="text-end w-100">
                                                                    <div class="btn-group gap-3">
                                                                        <button class="btn btn-primary" ng-if="videoIdeas.length > 0" ng-click="generateidea()"><i class="fa-solid fa-arrows-rotate"></i> Regenerate</button>
                                                                        <button class="btn btn-primary" ng-click="generateidea()" >Generate Ideas <i class="fa-solid fa-wand-magic-sparkles"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div ng-if="videoIdeas.length > 0">
                                                            <h6 class="title title-design">
                                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 4.875C0 2.18261 2.18261 0 4.875 0H19.5C22.1924 0 24.375 2.18261 24.375 4.875V16.25C24.375 18.9424 22.1924 21.125 19.5 21.125H15.3999L12.799 24.0975C12.6447 24.2738 12.4218 24.375 12.1875 24.375C11.9532 24.375 11.7303 24.2738 11.576 24.0975L8.97508 21.125H4.875C2.18261 21.125 0 18.9424 0 16.25V4.875ZM12.1875 4.875C12.5668 4.875 12.8957 5.13748 12.9798 5.50733L13.4293 7.4843C13.6372 8.39873 14.3513 9.11276 15.2657 9.32067L17.2427 9.77023C17.6125 9.85433 17.875 10.1832 17.875 10.5625C17.875 10.9418 17.6125 11.2707 17.2427 11.3548L15.2657 11.8043C14.3513 12.0122 13.6372 12.7263 13.4293 13.6407L12.9798 15.6177C12.8957 15.9875 12.5668 16.25 12.1875 16.25C11.8082 16.25 11.4793 15.9875 11.3952 15.6177L10.9457 13.6407C10.7378 12.7263 10.0237 12.0122 9.1093 11.8043L7.13233 11.3548C6.76248 11.2707 6.5 10.9418 6.5 10.5625C6.5 10.1832 6.76248 9.85433 7.13233 9.77023L9.1093 9.32067C10.0237 9.11276 10.7378 8.39873 10.9457 7.4843L11.3952 5.50733C11.4793 5.13748 11.8082 4.875 12.1875 4.875Z" fill="var(--primary-color)"/>
                                                                </svg>
                                                                AI Generated Ideas
                                                            </h6>
                                                            <div class="theme-card theme-card-style-2">
                                                        <div class="row gap-0 g-3">
                                                            <div class="col-md-6" ng-repeat="idea in videoIdeas track by $index">
                                                                <label class="idea-card">
                                                                    <input type="radio" name="idea" ng-value="idea" ng-model="selectedIdea">
                                                                    <div class="card-inner" ng-click="generatescript(idea)">
                                                                        <div class="top">
                                                                            <span class="idea-tag">Idea 0{{$index+1}}</span>
                                                                            <span class="radio-circle"></span>
                                                                        </div>
                                                                        <p>
                                                                            {{idea}}
                                                                        </p>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <!-- <div class="col-md-6">
                                                                <label class="idea-card">
                                                                    <input type="radio" name="idea" checked>
                                                                    <div class="card-inner" ng-click="selectedideas('This educational sales video target bottom line of local business owners by comparing the long-term maintenance costs inferior metals by comparing versus Backstar...')">
                                                                        <div class="top">
                                                                            <span class="idea-tag">Idea 01</span>
                                                                            <span class="radio-circle"></span>
                                                                        </div>
                                                                        <p>
                                                                            This educational sales video targe the bottom line of local business Blackstar...
                                                                        </p>
                                                                    </div>
                                                                </label>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="theme-bg-dark p-3 border radius-3">
                                                        <h6 class="title title-design">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.0884 16.2682C15.9871 15.9592 15.7021 15.75 15.3759 15.75C15.0496 15.75 14.7646 15.9592 14.6634 16.2682L13.9508 18.4519L11.7684 19.1617C11.4609 19.2622 11.2509 19.5503 11.2509 19.875C11.2509 20.1997 11.4609 20.4878 11.7684 20.5883L13.9508 21.2981L14.6634 23.4817C14.7646 23.7907 15.0496 24 15.3759 24C15.7021 24 15.9871 23.7907 16.0884 23.4817L16.8009 21.2981L18.9834 20.5883C19.2909 20.4878 19.5009 20.1997 19.5009 19.875C19.5009 19.5503 19.2909 19.2622 18.9834 19.1617L16.8009 18.4519L16.0884 16.2682ZM18.3121 0.878625L2.0971 17.0947C2.0146 17.1769 1.95085 17.2774 1.91335 17.388L0.038354 23.013C-0.051646 23.2822 0.0196003 23.5796 0.2221 23.7803C0.42085 23.9813 0.717115 24.0514 0.987115 23.9614L6.61212 22.0864C6.72462 22.0496 6.82213 21.9878 6.90463 21.9053L23.1234 5.6895C23.6859 5.12663 24.0009 4.3635 24.0009 3.56812C24.0009 2.77237 23.6859 2.00925 23.1234 1.44675C22.9321 1.2585 22.7409 1.06688 22.5534 0.878625C21.9909 0.316125 21.2296 0 20.4346 0C19.6359 0 18.8746 0.316125 18.3121 0.878625ZM1.93588 22.0642L4.98838 21.0472L2.95211 19.0132L1.93588 22.0642ZM19.1259 14.625H18.3759C17.9634 14.625 17.6259 14.961 17.6259 15.375C17.6259 15.789 17.9634 16.125 18.3759 16.125H19.1259V16.875C19.1259 17.289 19.4634 17.625 19.8759 17.625C20.2884 17.625 20.6259 17.289 20.6259 16.875V16.125H21.3759C21.7884 16.125 22.1259 15.789 22.1259 15.375C22.1259 14.961 21.7884 14.625 21.3759 14.625H20.6259V13.875C20.6259 13.461 20.2884 13.125 19.8759 13.125C19.4634 13.125 19.1259 13.461 19.1259 13.875V14.625ZM6.33837 0.51825C6.23712 0.20925 5.95211 0 5.62586 0C5.29961 0 5.0146 0.20925 4.91335 0.51825L3.83335 3.83362L0.518365 4.91175C0.210865 5.01225 0.000863116 5.30025 0.000863116 5.625C0.000863116 5.94975 0.210865 6.23775 0.518365 6.33825L3.83335 7.41638L4.91335 10.7318C5.0146 11.0408 5.29961 11.25 5.62586 11.25C5.95211 11.25 6.23712 11.0408 6.33837 10.7318L7.41837 7.41638L10.7334 6.33825C11.0409 6.23775 11.2509 5.94975 11.2509 5.625C11.2509 5.30025 11.0409 5.01225 10.7334 4.91175L7.41837 3.83362L6.33837 0.51825ZM5.62586 3.1755L6.10963 4.66088C6.18463 4.88888 6.36084 5.06775 6.58959 5.142L8.07462 5.625L6.58959 6.108C6.36084 6.18225 6.18463 6.36112 6.10963 6.58912L5.62586 8.0745L5.1421 6.58912C5.0671 6.36112 4.89088 6.18225 4.66213 6.108L3.1771 5.625L4.66213 5.142C4.89088 5.06775 5.0671 4.88888 5.1421 4.66088L5.62586 3.1755ZM20.6259 6.0645L17.9371 3.375L19.3734 1.9395C19.6546 1.65787 20.0334 1.5 20.4346 1.5C20.8321 1.5 21.2109 1.65787 21.4921 1.9395C21.6834 2.12737 21.8746 2.31937 22.0621 2.50725C22.3433 2.7885 22.5009 3.17025 22.5009 3.56812C22.5009 3.966 22.3433 4.34738 22.0621 4.62863L20.6259 6.0645Z" fill="var(--primary-color)"/>
                                                                </svg>

                                                            AI Generated Script
                                                        </h6>
                                                        <div class="theme-card theme-card-style-2">
                                                            <div class="form-group">
                                                                <p>You can also write your script manually.</p>
                                                                <div class="prompt-box position-relative">
                                                                    <textarea name="custom_prompt" id="custom_prompt" rows="5" class="form-control" ng-model="customprompt" placeholder="E.g. Hi there! Welcome to our channel..." maxlength="500" style="height: 414px;"></textarea>
                                                                    <button type="button" class="generate-button bottom-right" ng-click="getScript()"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Enhance your script."
                                                                    ><i class="fa-solid  fa-wand-magic-sparkles"></i></button>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <button class="btn btn-primary px-5" ng-click="saveandnext()">Save & Next 
                                                        <i class="fa-solid fa-angle-right"></i> 
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-voice" role="tabpanel" aria-labelledby="pills-voice-tab" tabindex="0">
                                <div class="row g-xl-5 g-4 justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center gap-2 justify-content-between mb-3 mb-sm-4">
                                                    <ul class="nav nav-pills nav-pills-style-1 nav-pills-with-gradient" id="pills-tab" role="tablist">
                                                        <li class="nav-item" role="presentation" ng-click="checkData('all')">
                                                            <button class="nav-link active" id="pills-all-avatars-tab" data-bs-toggle="pill"
                                                                data-bs-target="#pills-all-avatars" type="button" role="tab"
                                                                aria-controls="pills-all-avatars" aria-selected="true">All Avatars</button>
                                                        </li>
                                                        <li class="nav-item  <?= $_GET['avatar_type'] ? 'd-none' : '' ?>" role="presentation"  ng-click="checkData('my-agents')">
                                                            <button class="nav-link" id="pills-my-avatar-tab" data-bs-toggle="pill"
                                                                data-bs-target="#pills-my-avatar" type="button" role="tab"
                                                                aria-controls="pills-my-avatar" aria-selected="false">My Avatars</button>
                                                        </li>
                                                        <li class="nav-item  <?= $_GET['avatar_type'] ? 'd-none' : '' ?>" role="presentation" ng-click="checkData('default')">
                                                            <button class="nav-link" id="pills-ai-avatar-tab" data-bs-toggle="pill"
                                                                data-bs-target="#pills-ai-avatar" type="button" role="tab"
                                                                aria-controls="pills-ai-avatar" aria-selected="false">AI Avatars</button>
                                                        </li>
                                                    </ul>
                                                    <div class="d-flex align-items-center ms-auto">
                                                        <div class="custom-width w-auto">
                                                            <div class="search-bar left-icon">
                                                                <div class="search-icon">
                                                                    <span class="icon-search"></span>
                                                                </div>
                                                                <input type="text" class="search form-control" placeholder="Search for Avatars" autocomplete="off" id="searchText" ng-model="searchQuery" ng-change="getAvatarImage()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade show active" id="pills-all-avatars" role="tabpanel" aria-labelledby="pills-all-avatars-tab" tabindex="0">
                                                            <div class="row row-cols-2 row-cols-md-4 row-cols-sm-3 gap-0 g-3 custom-scroll" style="height: 300px;">
                                                                <div class="col <?= $_GET['avatar_type'] ? 'd-none' : '' ?>">
                                                                    <div class="custom-upload-2 custom-upload-2-style-1 p-0" data-bs-toggle="modal" data-bs-target="#uploadModal" style="cursor: pointer;">
                                                                        <label id="fashionGenInitFileLabel" class="w-100" style="pointer-events: none;">
                                                                            <div class="form-group file-post custom-file-upload px-3 m-0 custom-height">
                                                                                <i class="fa-solid fa-square-plus"></i>
                                                                                <div class="theme-color w600">Create New</div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <!-- Tushar Work Start -->
                                                                    <!--<div class="modal fade upload-modal" id="uploadModal" tabindex="-1">-->
                                                                    <!--    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 780px;">-->
                                                                    <!--        <div class="modal-content overflow-auto">-->
                                                                    <!--            <div class="modal-header py-2">-->
                                                                    <!--                <h6 class="modal-title">Upload Photo</h6>-->
                                                                    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                                                    <!--            </div>-->
                                                                    <!--            <form method="POST" id="form_submit" enctype="multipart/form-data">-->
                                                                    <!--                <div class="modal-body p-0" style="overflow-x: hidden;">-->
                                                                    <!--                    <div class="upload-area">-->
                                                                    <!--                        <div class="row g-0 gap-0">-->
                                                                    <!--                            <div class="col-md-8">-->
                                                                    <!--                                <div class="left-area">-->
                                                                    <!--                                    <div class="form-group custom-file-upload custom-file-upload-style-2 upload_img_change h-100 flex-column text-center justify-content-center">-->
                                                                    <!--                                        <div class="left">-->
                                                                    <!--                                            <div class="image-box">-->
                                                                    <!--                                                <img id="previewImage" src="<?php echo $this->config->item('assetsPath') ?>images/faFileUpload.png" alt="image">-->
                                                                    <!--                                                <i class="fa-solid fa-xmark custom-cross"></i>-->
                                                                    <!--                                            </div>-->
                                                                    <!--                                        </div>-->
                                                                    <!--                                        <div class="right">-->
                                                                    <!--                                            <h5 class="title">Drag & Drop Or <span class="border-bottom">Browse</span></h5>-->
                                                                    <!--                                            <p>Supports: JPEG, JPG, PNG</p>-->
                                                                    <!--                                        </div>-->
                                                                    <!--                                        <input type="file" id="avatarImage" name="avatar" class="form-control" accept=".jpeg,.jpg,.png">-->
                                                                    <!--                                        <input type="hidden" name="avatar"  />-->
                                                                    <!--                                    </div>-->
                                                                    <!--                                    <div class="form-check">-->
                                                                    <!--                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">-->
                                                                    <!--                                        <label class="form-check-label" for="flexCheckDefault">By creating an avatar, I confirm I’m over 18 (or of legal age) and have rights to the photos used. I accept full responsibility for uploaded content, agree to follow all laws, and accept the Terms of Service and Privacy Policy.</label>-->
                                                                    <!--                                    </div>-->
                                                                    <!--                                    <div class="d-flex align-items-center justify-content-end gap-2 mt-auto">-->
                                                                    <!--                                        <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Cancel</button>-->
                                                                    <!--                                        <button type="submit" class="btn btn-primary" >Upload</button>-->
                                                                    <!--                                    </div>-->
                                                                    <!--                                </div>-->
                                                                    <!--                            </div>-->
                                                                    <!--                            <div class="col-md-4">-->
                                                                    <!--                                <div class="right-area">-->
                                                                    <!--                                    <div class="row g-3 gap-0">-->
                                                                    <!--                                        <div class="col-12">-->
                                                                    <!--                                            <div class="compare-wrapper">-->
                                                                    <!--                                                <div class="head-content">-->
                                                                    <!--                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                                                    <!--                                                        <path d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z" fill="#14C18B"/>-->
                                                                    <!--                                                        <path d="M12.1717 5.15918L7.85425 10.4059L6.04019 8.64105L4.84375 9.93902L7.99431 13.0035L13.5001 6.31343L12.1717 5.15918Z" fill="white"/>-->
                                                                    <!--                                                    </svg>-->
                                                                    <!--                                                    <span class="title">Good Photos</span>-->
                                                                    <!--                                                </div>-->
                                                                    <!--                                                <p>Upload recent high-resolution photos of yourself, including close-ups and full-body shots with varied angles, expressions, and outfits.</p>-->
                                                                    <!--                                                <div class="swiper compareGoodSwiper">-->
                                                                    <!--                                                    <div class="swiper-wrapper">-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G1.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G2.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G3.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G4.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G5.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G6.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                    </div>-->
                                                                    <!--                                                    <div class="swiper-pagination"></div>-->
                                                                    <!--                                                </div>-->
                                                                    <!--                                            </div>-->
                                                                    <!--                                        </div>-->
                                                                    <!--                                        <div class="col-12">-->
                                                                    <!--                                            <div class="compare-wrapper">-->
                                                                    <!--                                                <div class="head-content">-->
                                                                    <!--                                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                                                    <!--                                                        <path d="M9.5 18.5C14.4706 18.5 18.5 14.4706 18.5 9.5C18.5 4.52944 14.4706 0.5 9.5 0.5C4.52944 0.5 0.5 4.52944 0.5 9.5C0.5 14.4706 4.52944 18.5 9.5 18.5Z" fill="#E63946"/>-->
                                                                    <!--                                                        <path d="M10.7648 9.50017L12.8348 7.43917C13.0043 7.26969 13.0995 7.03984 13.0995 6.80017C13.0995 6.5605 13.0043 6.33064 12.8348 6.16117C12.6654 5.99169 12.4355 5.89648 12.1958 5.89648C11.9562 5.89648 11.7263 5.99169 11.5568 6.16117L9.49584 8.23117L7.43484 6.16117C7.26537 5.99169 7.03551 5.89648 6.79584 5.89648C6.55617 5.89648 6.32632 5.99169 6.15684 6.16117C5.98737 6.33064 5.89216 6.5605 5.89216 6.80017C5.89216 7.03984 5.98737 7.26969 6.15684 7.43917L8.22684 9.50017L6.15684 11.5612C6.07249 11.6448 6.00553 11.7444 5.95984 11.854C5.91415 11.9637 5.89062 12.0814 5.89062 12.2002C5.89062 12.319 5.91415 12.4366 5.95984 12.5463C6.00553 12.656 6.07249 12.7555 6.15684 12.8392C6.24051 12.9235 6.34005 12.9905 6.44972 13.0362C6.5594 13.0819 6.67703 13.1054 6.79584 13.1054C6.91465 13.1054 7.03229 13.0819 7.14196 13.0362C7.25164 12.9905 7.35118 12.9235 7.43484 12.8392L9.49584 10.7692L11.5568 12.8392C11.6405 12.9235 11.7401 12.9905 11.8497 13.0362C11.9594 13.0819 12.077 13.1054 12.1958 13.1054C12.3147 13.1054 12.4323 13.0819 12.542 13.0362C12.6516 12.9905 12.7512 12.9235 12.8348 12.8392C12.9192 12.7555 12.9862 12.656 13.0318 12.5463C13.0775 12.4366 13.1011 12.319 13.1011 12.2002C13.1011 12.0814 13.0775 11.9637 13.0318 11.854C12.9862 11.7444 12.9192 11.6448 12.8348 11.5612L10.7648 9.50017Z" fill="#EDEBEA"/>-->
                                                                    <!--                                                    </svg>-->
                                                                    <!--                                                    <span class="title">Bad Photos</span>-->
                                                                    <!--                                                </div>-->
                                                                    <!--                                                <p>Avoid group photos, hats, sunglasses, pets, heavy filters, low-resolution images, screenshots, or overly edited and outdated pictures.</p>-->
                                                                    <!--                                                <div class="swiper compareBadSwiper">-->
                                                                    <!--                                                    <div class="swiper-wrapper">-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B1.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B2.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B3.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B4.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B5.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                        <div class="swiper-slide">-->
                                                                    <!--                                                            <div class="compare-image">-->
                                                                    <!--                                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B6.png" alt="image" class="img-fluid mx-auto d-block">-->
                                                                    <!--                                                            </div>-->
                                                                    <!--                                                        </div>-->
                                                                    <!--                                                    </div>-->
                                                                    <!--                                                    <div class="swiper-pagination"></div>-->
                                                                    <!--                                                </div>-->
                                                                    <!--                                            </div>-->
                                                                    <!--                                        </div>-->
                                                                    <!--                                    </div>-->
                                                                    <!--                                </div>-->
                                                                    <!--                            </div>-->
                                                                    <!--                        </div>-->
                                                                    <!--                    </div>-->
                                                                    <!--                </div>-->
                                                                    <!--            </form>-->
                                                                    <!--        </div>-->
                                                                    <!--    </div>-->
                                                                    <!--</div>-->
                                                                    <!-- Tushar Work End -->
                                                                </div>
                                                                <div class="col" ng-repeat="avatar in avatarImages">
                                                                    <div class="avatar-wrapper avatar-wrapper-style-2 {{ activeAvatarId }} {{ avatar.id }}" ng-class="{'active': activeAvatarId === avatar.id}"  ng-click="activeAvatar(avatar.id,avatar.url,avatar.video_url,avatar.name)">
                                                                        <div class="avatar-wrapper-inner gap-0">
                                                                            <div class="avatar-img" style="overflow: visible;">
                                                                                <div class="check-icon" style="border-radius: inherit;">
                                                                                    <i class="fa-solid fa-check"></i>
                                                                                </div>
                                                                                <img src="{{avatar.url}}" alt="Image" style="border-radius: inherit;">
                                                                            </div>
                                                                            <p class="mb-0 avatar-name">{{avatar.name}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="pills-my-avatar" role="tabpanel" aria-labelledby="pills-my-avatar-tab" tabindex="0">
                                                            <div class="row row-cols-2 row-cols-md-4 row-cols-sm-3 gap-0 g-3 custom-scroll" style="height: 300px;">
                                                                <div class="col myagents-class" ng-repeat="avatar in avatarImages | filter: filterAvatars" data-myagents-count="{{ (avatarImages | filter: filterAvatars).length }}">
                                                                    <div class="avatar-wrapper avatar-wrapper-style-2" ng-class="{'active': activeAvatarId === avatar.id}"  ng-click="activeAvatar(avatar.id,avatar.url,avatar.video_url,avatar.name)">
                                                                        <div class="avatar-wrapper-inner gap-0">
                                                                            <div class="avatar-img" style="overflow: visible;">
                                                                                <button class="btn btn-primary btn-sm remove-button" ng-click="removeAvatar(avatar.id)">Remove</button>
                                                                                <div class="check-icon" style="border-radius: inherit;">
                                                                                    <i class="fa-solid fa-check"></i>
                                                                                </div>
                                                                                <img src="{{avatar.url}}" alt="Image" style="border-radius: inherit;">
                                                                            </div>
                                                                            <p class="mb-0 avatar-name">{{avatar.name}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center"> 
                                                                    <svg class="load-more-btn border-0 spinner-border" width="45" height="45" viewBox="0 0 25 25" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.248 3.23438V6.23438" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M18.6116 4.87061L16.4902 6.99193" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M21.248 12.2344H18.248" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M18.6116 18.5984L16.4902 16.4771" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M12.248 21.2344V18.2344" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M5.88379 18.5984L8.00511 16.4771" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M3.24805 12.2344H6.24805" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M5.88379 5.87061L8.00511 7.99193" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="pills-ai-avatar" role="tabpanel" aria-labelledby="pills-ai-avatar-tab" tabindex="0">
                                                            <div class="row row-cols-2 row-cols-md-4 row-cols-sm-3 gap-0 g-3 custom-scroll" style="height: 300px;">
                                                                <div class="col" ng-repeat="avatar in avatarImages | filter : filterDefaultAvatars">
                                                                    <div class="avatar-wrapper avatar-wrapper-style-2" ng-class="{'active': activeAvatarId === avatar.id}"  ng-click="activeAvatar(avatar.id,avatar.url,avatar.video_url,avatar.name)">
                                                                        <div class="avatar-wrapper-inner gap-0">
                                                                            <div class="avatar-img" style="overflow: visible;">
                                                                                <div class="check-icon" style="border-radius: inherit;">
                                                                                    <i class="fa-solid fa-check"></i>
                                                                                    <!--<p class="mb-0">Remove</p>-->
                                                                                </div>
                                                                                <img src="{{avatar.url}}" alt="Image" style="border-radius: inherit;">
                                                                            </div>
                                                                            <p class="mb-0 avatar-name">{{avatar.name}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-center"> 
                                                                    <svg class="load-more-btn border-0 spinner-border" width="45" height="45" viewBox="0 0 25 25" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.248 3.23438V6.23438" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M18.6116 4.87061L16.4902 6.99193" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M21.248 12.2344H18.248" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M18.6116 18.5984L16.4902 16.4771" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M12.248 21.2344V18.2344" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M5.88379 18.5984L8.00511 16.4771" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M3.24805 12.2344H6.24805" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M5.88379 5.87061L8.00511 7.99193" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="comman-ai-box">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="enter_Name">Avatar Name</label>
                                                <input type="text" class="form-control" id="enter_Name" ng-model="avatar_name" placeholder="E.g Emma">
                                            </div>
                                            <div class="form-group">
                                                <label for="custom_prompt" class="form-label">Write your script or describe what you want the avatar to say</label>
                                                <div class="prompt-box position-relative">
                                                    <textarea name="custom_prompt" id="custom_prompt" class="form-control" ng-model="customprompt" placeholder="E.g. Hi there! Welcome to our channel..." maxlength="500"></textarea>
                                                    <button type="button" class="generate-button bottom-right" ng-click="getScript()"><i class="fa-solid  fa-wand-magic-sparkles"></i></button>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="voice-wrapper">
                                            <div class="voice-area">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0">Select Voice</p>     
                                                    <ul class="nav nav-pills nav-pills-style-2" id="pills-tab" role="tablist">
                                                        <li 
                                                            class="nav-item" 
                                                            role="presentation"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Select from various AI accents and speaking styles for your agent."
                                                        >
                                                            <button class="nav-link active" id="pills-ai-voice-tab" data-bs-toggle="pill" data-bs-target="#pills-ai-voice" type="button" role="tab" aria-controls="pills-ai-voice" aria-selected="true" ng-click="voicetype('ai_voice')">AI Voice</button>
                                                        </li>
                                                        <li 
                                                            class="nav-item" 
                                                            role="presentation"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Clone your voice to give your agent a personalized speaking style."
                                                            >
                                                            <button class="nav-link" id="pills-clone-voice-tab" data-bs-toggle="pill" data-bs-target="#pills-clone-voice" type="button" role="tab" aria-controls="pills-clone-voice" aria-selected="false" ng-click="voicetype('clone')">Clone Voice</button>
                                                        </li>
                                                    </ul>  
                                                </div>
                                                <!-- Tab Content  -->
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade active show" id="pills-ai-voice" role="tabpanel"  aria-labelledby="pills-ai-voice-tab" tabindex="0">
                                                        <!-- <div class="top-area">
                                                            
                                                        </div> -->
                                                        <div class="row g-3 gap-0 align-items-center mb-3">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <!-- <label for="Language" class="form-label">Language</label> -->
                                                                    <select title="Language" ng-model="selectedLanguage" ng-change="filterchange()">
                                                                        <option value="{{Language}}" ng-repeat="Language in allLanguage">{{Language}}</option>
                                                                        <!--    <option value="Afrikaans">Afrikaans</option>-->
                                                                        <!--<option value="Arabic">Arabic</option>-->
                                                                        <!--<option value="Chinese">Chinese</option>-->
                                                                        <!--<option value="Croatian">Croatian</option>-->
                                                                        <!--<option value="Czech">Czech</option>-->
                                                                        <!--<option value="Danish">Danish</option>-->
                                                                        <!--<option value="Dutch">Dutch</option>-->
                                                                        <!--<option value="English">English</option>-->
                                                                        <!--<option value="Estonian">Estonian</option>-->
                                                                        <!--<option value="Filipino">Filipino</option>-->
                                                                        <!--<option value="Finnish">Finnish</option>-->
                                                                        <!--<option value="French">French</option>-->
                                                                        <!--<option value="German">German</option>-->
                                                                        <!--<option value="Hindi">Hindi</option>-->
                                                                        <!--<option value="Hungarian">Hungarian</option>-->
                                                                        <!--<option value="Icelandic">Icelandic</option>-->
                                                                        <!--<option value="Indonesian">Indonesian</option>-->
                                                                        <!--<option value="Irish">Irish</option>-->
                                                                        <!--<option value="Italian">Italian</option>-->
                                                                        <!--<option value="Japanese">Japanese</option>-->
                                                                        <!--<option value="Javanese">Javanese</option>-->
                                                                        <!--<option value="">Korean</option>-->
                                                                        <!--<option value="Korean">Latvian</option>-->
                                                                        <!--<option value="Lithuanian">Lithuanian</option>-->
                                                                        <!--<option value="Malay">Malay</option>-->
                                                                        <!--<option value="Marathi">Marathi</option>-->
                                                                        <!--<option value="Mongolian">Mongolian</option>-->
                                                                        <!--<option value="Norwegian">Norwegian</option>-->
                                                                        <!--<option value="Polish">Polish</option>-->
                                                                        <!--<option value="Portuguese">Portuguese</option>-->
                                                                        <!--<option value="Romanian">Romanian</option>-->
                                                                        <!--<option value="Russian">Russian</option>-->
                                                                        <!--<option value="Serbian">Serbian</option>-->
                                                                        <!--<option value="Slovak">Slovak</option>-->
                                                                        <!--<option value="Spanish">Spanish</option>-->
                                                                        <!--<option value="Swahili">Swahili</option>-->
                                                                        <!--<option value="Swedish">Swedish</option>-->
                                                                        <!--<option value="Tamil">Tamil</option>-->
                                                                        <!--<option value="Thai">Thai</option>-->
                                                                        <!--<option value="Turkish">Turkish</option>-->
                                                                        <!--<option value="Urdu">Urdu</option>-->
                                                                        <!--<option value="Vietnamese">Vietnamese</option>-->
                                                                        <!--<option value="Welsh">Welsh</option>-->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <!-- <label for="Gender" class="form-label">Gender</label> -->
                                                                    <select title="Gender" ng-model="selectedGender" ng-change="filterchange()">
                                                                        <!-- <option value="">All</option> -->
                                                                        <option value="1">Male</option>
                                                                        <option value="2">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="search-bar right-icon">
                                                                    <div class="search-icon">
                                                                        <span class="icon-search"></span>
                                                                    </div>
                                                                    <input type="text" class="search form-control" id="mysearch" placeholder="Search.." ng-model="searchText">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="inner-wrapper">
                                                            <div class="list-group">
                                                                <div class="list-group-item list-group-item-action"
                                                                    ng-click="getAudioId(value.sv_svid)"

                                                                    ng-repeat="(key, value) in allAudios">
                                                                    <span class="icon">
                                                                        <i class="fa-solid icons-audio fa-play" ng-click="playSample(value.sv_preview_url, key, $event)"></i>
                                                                    </span>
                                                                    <span class="text">{{ value.sv_name }} ({{value.sv_locale }})</span>
                                                                        
                                                                    <div class="selected-badge" ng-show="agent2.audioid == value.ev_id">Selected</div>
                                                                    
                                                                    <span class="icon volume-icon">
                                                                        <i class="fa-solid fa-volume-high"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="list-group-item loader-audio justify-content-center list-group-item-action" style="transition:0.3s">
                                                                    <p class="mb-0 d-flex align-items-center gap-2" style="font-size: 14px;">Loading
                                                                    <svg class="loading-audio border-0" width="25" height="25" viewBox="0 0 25 25" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.248 3.23438V6.23438" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M18.6116 4.87061L16.4902 6.99193" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M21.248 12.2344H18.248" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M18.6116 18.5984L16.4902 16.4771" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M12.248 21.2344V18.2344" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M5.88379 18.5984L8.00511 16.4771" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M3.24805 12.2344H6.24805" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path opacity="1" d="M5.88379 5.87061L8.00511 7.99193" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-clone-voice" role="tabpanel" aria-labelledby="pills-clone-voice-tab" tabindex="0">
                                                        <div class="custom-upload-2 custom-upload-2-style-1 bg-transparent p-0"  data-bs-toggle="modal" data-bs-target="#premissionModal" style="cursor: pointer;"> 
                                                            <label class="w-100 mb-0" style="pointer-events: none;"> 
                                                                <div class="form-group file-post custom-file-upload p-3 m-0" style="height: 300px;">
                                                                    <i class="fa-solid fa-file-audio mb-2" style="font-size: 50px;"></i>
                                                                    <label class="form-label">Upload Voice File (MP3/WAV) - Minimum 5 seconds, Maximum 30 seconds</label>
                                                                    <input type="file" class="form-control" accept=".mp3,.wav" file-input="audioFile">
                                                                    <div class="theme-color w600">
                                                                        <i class="fa-solid fa-upload" style="font-size: 16px"></i> Upload Audio
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="list-group-item list-group-item-style-2 mt-3" ng-if="clone_file">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fa-solid fa-play play-sample" ng-click="playAudio()" ng-show="!isPlaying"></i>
                                                                <i class="fa-solid fa-pause pause-sample" ng-click="pauseAudio()" ng-show="isPlaying"></i>
                                                                <!-- <span class="ms-2">sdvvvvvvvvvvv</span> -->
                                                                <span class="ms-2">{{ clone_file }}</span>
                                                            </div>
                                                            <audio id="voice-audio" ng-src="{{ clone_file }}" preload="auto"></audio>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>        
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-4">
                                        <div class="avatar-right-area">
                                            <div class="avatar-image-box">
                                                <img src="{{ selectedAvatarUrl }}" alt="image">
                                            </div>
                                            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoPrModal">Generate Avatar</a>
                                            <a href="#" class="btn btn-primary" ng-click="generateAvatar()" >Generate Video</a>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-10 mt-0 text-center">
                                        <a href="#" class="btn btn-primary px-5" ng-click="generateAvatar()" >Generate Video</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    
    <!-- Permission Confirmation Modal  -->
    <div class="modal fade" id="premissionModal" tabindex="-1">
        <div class="modal-dialog premission-modal modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permission Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-x: hidden;">
                    <p class="d-flex align-items-start gap-2"><span class="text-primary">1.) </span><span>Upload audio files in MP3 or WAV format, with a size between 200KB and 10MB and a duration of 10 to 30 seconds. The audio should feature clear, uninterrupted speech, free from background noise, overlapping voices, music, or distortions that may affect clarity.</span></p>
                    <p class="d-flex align-items-start gap-2"><span class="text-primary">2.) </span><span>Ensure you have explicit permission to use the voice in the audio file and confirm that it complies with copyright, privacy, and defamation laws. By uploading, you accept full responsibility for any legal consequences arising from the use of unauthorized or harmful audio content.</span></p>
                    <div class="text-center">
                        <a class="fw-bold text-white" href="https://www.humanizzer.com/legal/legal-policy.html" target="_blank">Privacy & Policy</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <label for="audioFile" class="btn btn-primary">
                        I Agree
                        <input type="file" id="audioFile" class="form-control d-none" accept=".mp3,.wav" file-input="audioFile" on-file-select="uploadAudio(file)">
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- videoPrModal -->
    <div class="modal fade video-pr-modal" id="videoPrModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px; max-height: 500px;">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Avatar Preview</h5>
                </div>
                <div class="modal-body" style="overflow-x: hidden;">
                    <img src="<?php echo $this->config->item('assetsPath') ?>images/generate-avatar-pr.png" alt="image" class="img-fluid mx-auto d-block">
                </div>
                <div class="modal-footer justify-content-center gap-2">
                    <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Back</button>
                    <button type="button" id="showpLModal" class="btn btn-primary"  data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#pLModal">Create with AI Studio</button>
                </div>
            </div>
        </div>
    </div>
    <!-- videoPrModal -->
    
    <!--uploadModal-->
    <div class="modal fade upload-modal" id="uploadModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 780px;">
            <div class="modal-content overflow-auto">
                <div class="modal-header py-2">
                    <h6 class="modal-title">Upload Photo</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form_submit" enctype="multipart/form-data">
                    <div class="modal-body p-0" style="overflow-x: hidden;">
                        <div class="upload-area">
                            <div class="row g-0 gap-0">
                                <div class="col-md-8">
                                    <div class="left-area">
                                        <div class="form-group custom-file-upload custom-file-upload-style-2 upload_img_change h-100 flex-column text-center justify-content-center">
                                            <div class="left">
                                                <div class="image-box">
                                                    <img id="previewImage" src="<?php echo $this->config->item('assetsPath') ?>images/faFileUpload.png" alt="image">
                                                    <i class="fa-solid fa-xmark custom-cross"></i>
                                                </div>
                                            </div>
                                            <div class="right">
                                                <h5 class="title">Drag & Drop Or <span class="border-bottom">Browse</span></h5>
                                                <p>Supports: JPEG, JPG, PNG</p>
                                            </div>
                                            <input type="file" id="avatarImage" name="avatar" class="form-control" accept=".jpeg,.jpg,.png">
                                            <input type="hidden" name="avatar"  />
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">By creating an avatar, I confirm I’m over 18 (or of legal age) and have rights to the photos used. I accept full responsibility for uploaded content, agree to follow all laws, and accept the Terms of Service and Privacy Policy.</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end gap-2 mt-auto">
                                            <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" >Upload</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="right-area">
                                        <div class="row g-3 gap-0">
                                            <div class="col-12">
                                                <div class="compare-wrapper">
                                                    <div class="head-content">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z" fill="#14C18B"/>
                                                            <path d="M12.1717 5.15918L7.85425 10.4059L6.04019 8.64105L4.84375 9.93902L7.99431 13.0035L13.5001 6.31343L12.1717 5.15918Z" fill="white"/>
                                                        </svg>
                                                        <span class="title">Good Photos</span>
                                                    </div>
                                                    <p>Upload recent high-resolution photos of yourself, including close-ups and full-body shots with varied angles, expressions, and outfits.</p>
                                                    <div class="swiper compareGoodSwiper">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G1.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G2.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G3.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G4.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G5.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/good-images/G6.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-pagination"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="compare-wrapper">
                                                    <div class="head-content">
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.5 18.5C14.4706 18.5 18.5 14.4706 18.5 9.5C18.5 4.52944 14.4706 0.5 9.5 0.5C4.52944 0.5 0.5 4.52944 0.5 9.5C0.5 14.4706 4.52944 18.5 9.5 18.5Z" fill="#E63946"/>
                                                            <path d="M10.7648 9.50017L12.8348 7.43917C13.0043 7.26969 13.0995 7.03984 13.0995 6.80017C13.0995 6.5605 13.0043 6.33064 12.8348 6.16117C12.6654 5.99169 12.4355 5.89648 12.1958 5.89648C11.9562 5.89648 11.7263 5.99169 11.5568 6.16117L9.49584 8.23117L7.43484 6.16117C7.26537 5.99169 7.03551 5.89648 6.79584 5.89648C6.55617 5.89648 6.32632 5.99169 6.15684 6.16117C5.98737 6.33064 5.89216 6.5605 5.89216 6.80017C5.89216 7.03984 5.98737 7.26969 6.15684 7.43917L8.22684 9.50017L6.15684 11.5612C6.07249 11.6448 6.00553 11.7444 5.95984 11.854C5.91415 11.9637 5.89062 12.0814 5.89062 12.2002C5.89062 12.319 5.91415 12.4366 5.95984 12.5463C6.00553 12.656 6.07249 12.7555 6.15684 12.8392C6.24051 12.9235 6.34005 12.9905 6.44972 13.0362C6.5594 13.0819 6.67703 13.1054 6.79584 13.1054C6.91465 13.1054 7.03229 13.0819 7.14196 13.0362C7.25164 12.9905 7.35118 12.9235 7.43484 12.8392L9.49584 10.7692L11.5568 12.8392C11.6405 12.9235 11.7401 12.9905 11.8497 13.0362C11.9594 13.0819 12.077 13.1054 12.1958 13.1054C12.3147 13.1054 12.4323 13.0819 12.542 13.0362C12.6516 12.9905 12.7512 12.9235 12.8348 12.8392C12.9192 12.7555 12.9862 12.656 13.0318 12.5463C13.0775 12.4366 13.1011 12.319 13.1011 12.2002C13.1011 12.0814 13.0775 11.9637 13.0318 11.854C12.9862 11.7444 12.9192 11.6448 12.8348 11.5612L10.7648 9.50017Z" fill="#EDEBEA"/>
                                                        </svg>
                                                        <span class="title">Bad Photos</span>
                                                    </div>
                                                    <p>Avoid group photos, hats, sunglasses, pets, heavy filters, low-resolution images, screenshots, or overly edited and outdated pictures.</p>
                                                    <div class="swiper compareBadSwiper">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B1.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B2.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B3.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B4.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B5.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="compare-image">
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/bad-images/B6.png" alt="image" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-pagination"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--uploadModal-->

    <!-- portraitLandscapeModal -->
    <div class="modal fade pl-modal" id="pLModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 580px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Video From</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="pl-modal-pr">
                                <div class="media">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/landscape.png" alt="image" class="img-fluid mx-auto d-block">
                                </div>
                                <p class="desc">Landscape</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="pl-modal-pr">
                                <div class="media">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/portrait.png" alt="image" class="img-fluid mx-auto d-block">
                                </div>
                                <p class="desc">Portrait</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- portraitLandscapeModal -->
<!-- </div> -->


  <script>
  
  
      
  
      $(document).ready(function() {
        // // Handle icon click: stop event from bubbling up
        // $(document).on('click', '.list-group-item .icon i', function(e) {
        //     e.stopPropagation();
        //     // Optional: do something specific when icon is clicked
        //     // Example: $(this).toggleClass('fa-play fa-pause');
        // });
    
        // Handle list-group-item click: add 'active' class
        $(document).on('click', '.list-group-item', function() {
            $('.list-group-item').removeClass('active'); // Remove from all
            $(this).addClass('active'); // Add to clicked one
        });
    });

    $(function () {
        $('#tags').tagsInput({
            width: 'auto',
            onChange: function () {
                var val = $('#tags').val(); // get current tags
                var scope = angular.element($('#tags')).scope();
                scope.$apply(function () {
                    scope.triggerkeyword = val;
                });
            }
        });
    });

    $(document).ready(function(){
   /*   setTimeout(function(){
         $('.avatar-wrapper').on('click',function(e){
            $('.avatar-wrapper').removeClass('active');
            $(this).addClass('active');
       })   
     },1000);
       */

    $("#mysearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".inner-wrapper .list-group-item").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    });

   var baseUrl = '<?= base_url() ?>';

    var app = angular.module("AppModule", []);
    
    app.directive("fileInput", function () {
        return {
            scope: {
                fileInput: "=",
                onFileSelect: "&"
            },
            link: function (scope, element) {
                element.bind("change", function (event) {
                    scope.$apply(function () {
                        scope.fileInput = event.target.files[0];
                        scope.onFileSelect({ file: scope.fileInput });
                        
                        // ✅ Reset file input so selecting the same file again will trigger change
                        event.target.value = null;
                    });
                });
            }
        };
    });

    
    
    

    app.controller("visController", function ($scope, $http, $timeout, $sce) {

        $scope.imageFile = null; 
        $scope.selectedAvatar = '';;
        $scope.avatarImages = []; 
        $scope.prompt_id = <?php echo json_encode($prompt_id); ?>;
        $scope.allAudios = [];
        $scope.avatars = ['Avatar 1', 'Avatar 2', 'Avatar 3']; // Example data
        $scope.languages = []; 
        $scope.accents = ['Male', 'Female']; 
        $scope.emotions = ['Happy', 'Sad', 'Angry']; 
        $scope.selectedAvatar = "";
        $scope.selectedLanguage = "";
        $scope.selectedGender = "";
        $scope.selectedEmotion = "";
        $scope.selectedAvatarId = "";
        $scope.selectedAvatarUrl = "";
        $scope.selectedVideoUrl = "";
        $scope.audiooffset = 0;
        $scope.audiolimit = 6;
        $scope.isLoading = false;
        $scope.avtartype = "<?php echo $_GET['avatar_type'];?> ";
        $scope.offset = 0;  
        $scope.limit = $scope.avtartype.trim() == 'video' ? 10 : 30;  
        $scope.audioid = "";  
        $scope.avatar_name = "";
        $scope.clone_file = "",
        $scope.selectedvoicetype = 'ai_voice';
        // $scope.business_name = "";
        // $scope.business_niche = "";
        $scope.selected_platform = 'make-money-online';
        // $scope.selected_target_audience = 'get_views';
        $scope.selected_video_goal = 'get_views';

        
        
        $scope.getAudioId = function(id){
            $scope.audioid = id;
        }

        
 
        $scope.filterAvatars = function(avatar) {
            return avatar.user_id && avatar.user_id !== "" && avatar.business_id && avatar.business_id !== "";
        };

        $scope.filterDefaultAvatars = function(avatar) {
            return avatar.user_id == null && avatar.business_id == null;
        }; 


        $scope.checkData =  function(validation){
            $scope.offset = 0;
            $scope.limit = 10;
            $scope.avatarImages = [];
            var myagentsCount =  $('.myagents-class').data('myagents-count')
          
            if(validation == 'all'){
                
            }else if(validation == 'my-agents'){
                $scope.limit = 1000;
                
            }else if(validation == 'default'){  
                 $scope.limit = myagentsCount + 10;
            }
            $scope.getAvatarImage();

           
        }
        
        
        $scope.voicetype = function(type) {
            $scope.selectedvoicetype = type
        };
        
        
        
        $scope.saveandnext = function() {
            if ($scope.avatar_name == "") {
                flashNow({
                    error: { message: "Please enter a avatar name ." }
                });
                return
            }
            
            if (!$scope.customprompt || $scope.customprompt.trim() === "") {
                flashNow({
                    error: { message: "Kindly enter an Avatar Script or use the generate option.." }
                });
                return;
            }
            
            var charCount = $scope.customprompt.trim().length;
                
            if (charCount < 50) {
                flashNow({
                    error: { message: "Voice over script should be a minimum of 50 characters and a maximum of 500 characters." }
                });
                return;
            }
            
            $("#pills-voice-tab").prop('disabled', false).css('opacity','1');
            $('#pills-voice-tab').tab('show');
        };
        
        $scope.generateAvatar = function(){
            if ($scope.selectedAvatarUrl == "") {
                    flashNow({
                        error: { message: "Please select a image." }
                    });
                    return
            }
            
            if ($scope.selectedvoicetype == "ai_voice") {
                // for character count
                var charCount = $scope.customprompt.trim().length;
                
                if (charCount < 50) {
                    flashNow({
                        error: { message: "Voice over script should be a minimum of 50 characters and a maximum of 500 characters." }
                    });
                    return;
                }
            
                if ($scope.audioid == "") {
                    flashNow({
                        error: { message: "Please select a voice." }
                    });
                    return
                }
            }  
            
            if ($scope.selectedvoicetype == "clone") {
                if ($scope.clone_file == "") {
                    flashNow({
                        error: { message: "Please Generate a voice." }
                    });
                    return
                }
            }
                

            jsAvatarLoader(true);
            var queryStr = "<?php echo base_url('generate-avatar-video')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                     data: {
                        'avatar_type': "<?php echo !empty($_GET['avatar_type']) ? $_GET['avatar_type'] : 'photo'; ?>",
                        'avatar_script': $scope.customprompt,
                        'avtar_audio': $scope.audioid,
                        'avtar_id': $scope.selectedAvatarId,
                        'avatar_name': $scope.avatar_name,
                        'avtar_url' : $scope.selectedAvatarUrl,
                        'video_url' : $scope.selectedVideoUrl,
                        'audio_url' : $scope.clone_file,
                        'voicetype' : $scope.selectedvoicetype,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log(response);
                    jsLoader(false);
                
                    if (response.data.video_id) {
                        toastr.success("Avatar Generate Successfully");
                        // window.location.href = "<?php //echo base_url('avtar-create')?>";
                        window.location.href = "<?php echo base_url('video-editor-list')?>";
                    } else {
                        toastr.error("Somthing went wrong");
                    }
                });

        }
        
        
        $scope.uploadAudio = function (file) {
            
            if (!$scope.customprompt || $scope.customprompt.trim() === "") {
                flashNow({
                    error: { message: "Please enter a voice over script." }
                });
                return;
            }
            
            if (!file) {
                toastr.error("No audio file selected.");
                return;
            }
          $("#premissionModal").modal('hide');
            var formData = new FormData();
            formData.append("audioFile", file);
            formData.append("prompts_id", $scope.prompts_id);
            formData.append("avatar_script", $scope.customprompt);
        
            jsLoader(true);
        
            $http.post("<?= base_url('upload_audioFile') ?>", formData, {
                headers: {
                    'Content-Type': undefined
                },
                transformRequest: angular.identity
            }).then(function (response) {
                jsLoader(false);
                // console.log(response.data);
                if (response.data.status === true ) {
                    toastr.success(response.data.msg);
                     $scope.clone_file = response.data.audioUrl;
                     
                    $scope.customprompt = "";
                    $scope.audioFile = null;
                    document.querySelector('input[type="file"][file-input="audioFile"]').value = "";
                     $scope.$apply();
                        // $timeout(function() {
                        //     var audio = document.getElementById('voice-audio');
                        //     if (audio) {
                        //         audio.load();
                        //     }
                        // });
                    
                } else {
                    toastr.error(response.data.msg);
                }
            }).catch(function (error) {
                jsLoader(false);
                toastr.error("An error occurred while uploading the audio file.");
                console.error(error);
            });
        };
        
        
      $scope.playAudio = function() {
            if ($scope.clone_file) {
                var audio = new Audio($scope.clone_file);
                audio.play();
                $scope.isPlaying = true;
                $scope.audio = audio;
                audio.onended = function() {
                    $scope.isPlaying = false;
                    $scope.$apply(); 
                };
            } else {
                console.log("No audio file URL found.");
            }
        };
        
        $scope.pauseAudio = function() {
            if ($scope.audio) {
                $scope.audio.pause();
                $scope.isPlaying = false;
            } else {
                console.log("No audio object to pause.");
            }
        };
       
        $scope.getGeneratevAvtarVideoById = function(video_id) {
            jsLoader(true);
              var queryStr = "<?php echo base_url('get-generated-avatar-video')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                     data: {
                        'avatar_type':   "<?php echo $_GET['avatar_type']?>",
                        'avtar_video_id': video_id,
                        'avatar_name': $scope.avatar_name
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) { 
                    jsLoader(false);
                    // console.log('test',response.data);
                    // if(response.data == 'true'){
                    //     alert();
                    // }else {
                    //     $scope.getGeneratevAvtarVideoById(video_id);                
                    // }
                });
            
        }
        
         $scope.removeAvatar = function(id) {
                     $("#deleteModal").modal('show');
                     $('#deleteModal .delete-yes-btn').on('click', function(e) {
                     $("#deleteModal").modal("hide");
                      $scope.removeAvatarConfirm(id);
                 });
                };
          
          $scope.removeAvatarConfirm = function(id)
          {
              $scope.imageId  = id
               var queryStr = "<?php echo base_url('remove-avatar')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: $scope.imageId }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    if (response.data.status == 2) {
                        toastr.success(response.data.msg); 
                        // window.location.reload();
                        // $scope.getAvatarImageDefault(); 
                        // $scope.getAvatarImageBusiness();
                        $scope.getAvatarImage();
                    } else {
                        toastr.warning("Something went wrong!");
                    }
                     
                }).catch(function(error) {
                    toastr.error("Something went wrong!");
                });
          }
          
          $scope.show_msg = function (msg) {
            flashNow({'error': {'message': msg}});
        };
        
        
        
       // $scope.getGeneratevAvtarVideoById('8fcc00b902ea42028ddea2442a803844');
       /*  $scope.resetoffset =  function(){
            $scope.offset = 0;
            $scope.limit = 9;
            $scope.avatarImages = []; 
            $scope.getAvatarImage();
        } */

        $scope.getUniqueLanguages = function () {
            let languages = $scope.allAudios.map(audio => audio.avatar_lang);
            $scope.uniqueLanguages = [...new Set(languages)]; // Remove duplicates
            setTimeout(() => {
                $('select').selectpicker('refresh');
            }, 500);
        };
        
        
        $scope.customprompt = "";
        
        $scope.getScript = function(){
            if ($scope.customprompt == "") {
                    flashNow({
                        error: { message: "Please enter a script." }
                    });
                    return
                }
            jsLoader(true);
            var queryStr = "<?php echo base_url('get-avtar-script')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                    data : {
                        'prompt' : $scope.customprompt
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) { 
                    jsLoader(false);
                    if (response.data.status == true) {
                        $scope.customprompt = response.data.data;
                    } else {
                        $scope.allAudios = [];
                        console.log("Could not fetch Data.");
                    }
                });
            
        }
        
        
        $scope.generateidea = function(){
            // if ($scope.business_name == "") {
            //         flashNow({
            //             error: { message: "Please enter a Business Name." }
            //         });
            //         return
            //     }
            // if ($scope.business_niche == "") {
            //         flashNow({
            //             error: { message: "Please enter a Business Niche." }
            //         });
            //         return
            //     }
            jsLoader(true);
            var queryStr = "<?php echo base_url('generate-idea')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                    data : {
                        // 'business_name' : $scope.business_name,
                        // 'business_niche' : $scope.business_niche,
                        // 'selected_target_audience' : $scope.selected_target_audience,
                        'selected_platform' : $scope.selected_platform,
                        'selected_video_goal' : $scope.selected_video_goal,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    jsLoader(false);
            
                    if (response.data.status == true) {
                        let text = response.data.data;
                        let ideas = text.split(/\n?\d+\.\s/).filter(Boolean);
                        $scope.videoIdeas = ideas;
            
                        // ✅ DOM render hone ke baad scroll
                        $timeout(function() {
                            let container = document.getElementById("ideaContainer");
                            container.scrollTop = container.scrollHeight;
                        }, 100);
            
                    } else {
                        console.log("Could not fetch Data.");
                    }
                });
            }
            
            
        $scope.generatescript = function(idea){
            $scope.idea = idea
            jsLoader(true);
            var queryStr = "<?php echo base_url('generate-script')?>";
            $http({
                method: 'POST',
                url: queryStr,
                aync: false,
                data : {
                    'prompt' : $scope.idea
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) { 
                jsLoader(false);
                if (response.data.status == true) {
                    $scope.customprompt = response.data.data;
                } else {
                    $scope.allAudios = [];
                    console.log("Could not fetch Data.");
                }
            });
        
        }

        $scope.uploadFileChanged = function (fileInput) {
      
            $scope.imageFile = fileInput.files[0];
             $("#premissionModal").modal('hide');
             $scope.generate();
        };
        
        $scope.selectAvatarDefault = function() {
             $scope.selectedAvatar = avatar;
             $scope.userSelectedImage = avatar.apv_image_path; 
        };

        $scope.selectAvatar = function(avatar) {
             $scope.selectedAvatar = avatar;
             $scope.userSelectedImage = avatar.apv_image_path; 
        };


     $scope.generate = function () {

        //jsLoader(true);
        $(".temp_js_loader").remove();
        $("body").append(`
            <div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34); width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 9999;">
                <img src="https://www.humanizzer.com/app/assets/images/grabiris_loader.gif" style="position: absolute; margin: auto; top: 0; bottom: 0; left: 0; right: 0; height: 100px;">
                <div style="position: absolute; top: 60%; left: 50%; transform: translate(-50%, -50%); color: black; font-size: 16px; text-align: center;">
                    This may take up to 40-60 seconds...
                </div>
            </div>
        `);
    
        var formData = new FormData();
        
          if($scope.imageFile) 
          {
              formData.append('imageFile', $scope.imageFile);
          } else
          {
              toastr.error("Please upload image first");
              //jsLoader(false);
              $(".temp_js_loader").remove();
                return;
          }
            var queryStr = baseUrl + "generate-avatar";
        
            $http.post(queryStr, formData, {
                headers: {
                    'Content-Type': undefined
                },
                transformRequest: angular.identity
            }).then(function (response) {
                 if(response)
                 {
                     toastr.success("Image Uploaded successfully");
                     $scope.getAvatarImage();
                 }
                 else
                 {
                     toastr.error("Could not upload the image.");
                 }
                 //jsLoader(false);
                 $(".temp_js_loader").remove();
                 $scope.getAvatarImageDefault(); 
                 $scope.getAvatarImageBusiness();
                 $scope.getAvatarImage();
                // window.location.href = "<?= base_url('avatar-appearance') ?>";
            }, function (error) {
                // toastr.error("Error: Could not generate the avatar.");
                 //jsLoader(false);
                  $(".temp_js_loader").remove();
                 $scope.getAvatarImageDefault(); 
                 $scope.getAvatarImageBusiness();
                 $scope.getAvatarImage();
            });
        };
    
//   $("form#form_submit").on('submit',function(e){
//       jsLoader(true);
//         e.preventDefault();
//         var form = $(this);
//         var formData = new FormData($(this)[0]);
//         $.ajax({
//             url: "<?php echo base_url('upload-avatar')?>",
//             type: 'POST',
//             data: formData,
//             async: false,
//             success: function (data) {
//                 jsLoader(false);
//                 $('#uploadModal').modal('hide');
//                 $scope.offset = 0;
//                 $scope.avatarImages = [];
//                 $scope.getAvatarImage();
//                 console.log(form);
//                 form.find('input[type="file"]').val('');

//             },
//             cache: false,
//             contentType: false,
//             processData: false
//         });
        
//         return false;
//     });
   
   
   $("form#form_submit").on('submit', function (e) {
    e.preventDefault();
    jsLoader(true);

    var form = $(this);
    // var name = form.find('input[name="name"]').val().trim();
    // var gender = form.find('select[name="gender"]').val();
    // var age = form.find('select[name="age"]').val();
    var file = form.find('input[name="avatar"]')[0].files[0];
    var checkbox = form.find('#flexCheckDefault').is(':checked'); 

    // if (name === "") {
    //     jsLoader(false);
    //     flashNow({ error: { message: "Please enter a name." } });
    //     return false;
    // }
    // if (!gender) {
    //     jsLoader(false);
    //     flashNow({ error: { message: "Please select a gender." } });
    //     return false;
    // }
    // if (!age) {
    //     jsLoader(false);
    //     flashNow({ error: { message: "Please select an age." } });
    //     return false;
    // }
    if (!file) {
        jsLoader(false);
        flashNow({ error: { message: "Please upload an image." } });
        return false;
    }
    if (!checkbox) { 
        jsLoader(false);
        flashNow({ error: { message: "Please select the checkbox." } });
        return false;
    }

    var formData = new FormData(form[0]);

    $.ajax({
        url: "<?php echo base_url('upload-avatar') ?>",
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jsLoader(false);
            $('#uploadModal').modal('hide');
            // window.location.reload();
            form.find('input[type="file"]').val('');
            // form.find('input[name="name"]').val('');
            // form.find('select[name="gender"]').val('');
            // form.find('select[name="age"]').val('');
            // form.find('input[name="avatar"]').val('');
            form.find('#flexCheckDefault').prop('checked', false);
            $('#previewImage').attr('src', '<?php echo $this->config->item('assetsPath') ?>images/faFileUpload.png');
            $('.custom-cross').hide();
            
            $scope.offset = 0;
            $scope.avatarImages = [];
            $scope.getAvatarImage();
            form.find('input[type="file"]').val('');
        },
        error: function (xhr) {
            jsLoader(false);
            flashNow({ error: { message: "Upload failed. Please try again." } });
        }
    });

    return false;
});

    
    $scope.getAvatarImage = function () {
        
        var queryStr = "<?php echo base_url('get-getAvatarImage')?>";
        var avtar_type = "<?php echo $_GET['avatar_type'];?> ";
      
        // $('.load-more-btn').addClass('spinner-border');
        // $('.load-more-btn').show();
            $http({
                method: 'POST',
                url: queryStr,
                aync: false,
                data: {
                    // 'offset': $scope.offset,
                    // 'limit': $scope.limit,
                    'avtar_type': avtar_type.trim(),
                    'searchQuery':$scope.searchQuery
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) { 
                console.log(response);
                if (response.data.status == true) {
                     $scope.avatarImages = response.data.avatarImage;
                   // $scope.avatarImages = $scope.avatarImages.concat(response.data.avatarImage);
                    // $('.load-more-btn').removeClass('spinner-border'); 
                    // $('.load-more-btn').hide(); 
                    $scope.getSelectedAvtImage();
                    $scope.offset += $scope.limit;
                 
                } else {
                    console.log("Could not fetch images.");
                }
            });
    };
    
         $scope.isShuffling = false;

        $scope.shuffleAvatars = function () {
            if (!$scope.avatarImages || !$scope.avatarImages.length) {
                return;
            }
        
            $scope.isShuffling = true; // spinner ON
        
            // Thoda delay taaki spinner dikhe (UX ke liye)
            setTimeout(function () {
        
                for (let i = $scope.avatarImages.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    let temp = $scope.avatarImages[i];
                    $scope.avatarImages[i] = $scope.avatarImages[j];
                    $scope.avatarImages[j] = temp;
                }
        
                $scope.isShuffling = false; // spinner OFF
                $scope.$apply(); // Angular ko update batane ke liye
        
            }, 500); // 0.5 sec
        };

    
    // $scope.shuffleAvatars = function () {
    //     if (!$scope.avatarImages || !$scope.avatarImages.length) {
    //         return;
    //     }
    
    //     for (let i = $scope.avatarImages.length - 1; i > 0; i--) {
    //         const j = Math.floor(Math.random() * (i + 1));
    //         let temp = $scope.avatarImages[i];
    //         $scope.avatarImages[i] = $scope.avatarImages[j];
    //         $scope.avatarImages[j] = temp;
    //     }
    // };

    
     /* Get All Audios Work Start */
       $scope.getAvatarAudios = function (avatar,lang,gender,emotion) {
        // jsLoader(true);
        $('.loading-audio').addClass('spinner-border');
        $('.loader-audio').css('opacity', 1);
        var queryStr = "<?php echo base_url('get-all-audio')?>";
        $scope.isLoading =  true;
            $http({
                method: 'POST',
                url: queryStr,
                aync: false,
                data : {
                    'avatars' : avatar,
                    'language': lang,
                    'gender'  : gender,
                    // 'offset'  : $scope.audiooffset,
                    // 'limit'  :  $scope.audiolimit,
                    'emotion' : emotion
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) { 
                // jsLoader(false);
                $('.loading-audio').removeClass('spinner-border');
                $('.loader-audio').css('opacity', 0);
                if (response.data.status == true) {
                    // $scope.allAudios = response.data.all_audio;
                   /*  if(response.data.filter) {
                        $scope.allAudios = [];
                        $scope.audiooffset = 0;
                    } */
                    $scope.allAudios = $scope.allAudios.concat(response.data.all_audio);
                    $scope.allLanguage = response.data.all_language;

                    $scope.audiooffset += $scope.audiolimit;                      
                } else {
                    $scope.allAudios = [];
                    console.log("Could not fetch images.");
                }
                $scope.isLoading =  false;
            }).catch(function(){
                $scope.isLoading =  false;
            });
        };
    /* Get All Audios Work End */


    $scope.activeAvatarId = null;
     /* Avatar Image Id Get Start */
     $scope.activeAvatar =  function(avatar_id, image_url, video_url, avatar_name){
        $scope.activeAvatarId = avatar_id;
        $scope.selectedAvatarId =  avatar_id;
        $scope.selectedAvatarUrl =  image_url;
        $scope.selectedVideoUrl =  video_url;
        // $scope.avatar_name =  avatar_name;
        if($scope.selectedAvatarId){
            // $("#pills-voice-tab").prop('disabled', false);
            // $("#pills-voice-tab").css('opacity','1');
            $("#pills-voice-tab").prop('disabled', false).css('opacity','1');
            $('#pills-voice-tab').tab('show');

        }
     }
    /* Avatar Image Id Get End */

   

        $scope.getAvatarImage();
        $scope.getAvatarAudios();
        

        /* play Audio Start */
        let audio = null;
        let playingIndex = null;

        $scope.playSample = function (audioUrl, index, event) {
            let element = event.target; // Get the clicked icon element
            $('.icons-audio').removeClass('fa-pause').addClass('fa-play');

            if (playingIndex === index) {
                if (audio && !audio.paused) {
                    audio.pause();
                    audio.currentTime = 0;
                    playingIndex = null;
                    $(element).removeClass('fa-pause').addClass('fa-play'); // Reset icon
                }
            } else {
                if (playingIndex !== null && audio && !audio.paused) {
                    audio.pause();
                    audio.currentTime = 0;
                    $('.icons-audio.fa-pause').removeClass('fa-pause').addClass('fa-play'); // Reset previous icon
                }

                // Create new audio instance
                audio = new Audio(audioUrl);
                audio.play().then(() => {
                    $(element).addClass('fa-pause').removeClass('fa-play');
                }).catch((error) => {
                    console.error(error);
                    $(element).removeClass('fa-pause').addClass('fa-play');
                });

                playingIndex = index;

                // Reset when audio ends
                audio.onended = function() {
                    playingIndex = null;
                    $(element).removeClass('fa-pause').addClass('fa-play');
                };
            }
        };

        /* play Audio End */


        /* Audio Filters Start */
       
        $scope.filterchange = function(){
            $scope.audiooffset = 0;
            $scope.audiolimit = 100;
            $scope.allAudios = [];
            $scope.isLoading = false;
            $scope.getAvatarAudios($scope.selectedAvatar, $scope.selectedLanguage, $scope.selectedGender,$scope.selectedEmotion);
        }



       




        /* $scope.customFilter = function(audio) {
            if ($scope.searchText && !audio.audio_name.toLowerCase().includes($scope.searchText.toLowerCase())) {
                return false;
            }
            
            
            if ($scope.selectedAvatar && audio.avatar !== $scope.selectedAvatar) {
                return false;
            }
            if ($scope.selectedLanguage && audio.avatar_lang !== $scope.selectedLanguage) {
                console.log(audio);
                return false;
            }
            if ($scope.selectedGender && audio.accent !== $scope.selectedGender) {
                return false;
            }
            if ($scope.selectedEmotion && audio.emotion !== $scope.selectedEmotion) {
                return false;
            }

            console.log($scope.selectedLanguage);
            return true;
        }; */
        /* Audio Filters End */


       

        // $scope.loadMoreBtn = function(){
        //     $scope.getAvatarImage();
        // }

        // $(".inner-wrapper .list-group").on("scroll", function() {
        //     if (!$scope.isLoading && $(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight - 100) {
        //         $scope.getAvatarAudios();
        //     }
        // });

        $scope.getAvatarImageBusiness = function () {
            var queryStr = "<?php echo base_url('get-getAvatarImageByBsnId')?>";
            $http({
                method: 'POST',
                url: queryStr,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) {
                if (response.data.status == true) {
                     
                    $scope.avatarImagesBusiness = response.data;
                } else {
                    console.log("Could not fetch images.");
                }
            });
        };
        $scope.getAvatarImageBusiness();
        
        $scope.getAvatarImageDefault = function () {
            var queryStr = "<?php echo base_url('get-getAvatarImageDefault')?>";
            $http({
                method: 'POST',
                url: queryStr,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) {
                if (response.data.status == true) {
                   
                    $scope.avatarImagesDefault = response.data;
                } else {
                    console.log("Could not fetch images.");
                }
            });
        };
        $scope.getAvatarImageDefault();     
 
         $scope.generateAppea =  function(){
           var id="";
           if($scope.selectedAvatar){
              id=$scope.selectedAvatar;
           }else if($scope.selectedAvatar!=="" && id===""){
               id=$scope.selectedAvatar;
           }else if($scope.selectedAvatarData.id && $scope.selectedAvatarData.id!==""){
                id=$scope.selectedAvatarData.id;
           }else if(id===""){
               let res=$scope.avatarImages;
               let avt2=res.avatarImage; 
               if (avt2) { 
                  for (let i = 0; i < avt2.length; i++) {
                      let item=avt2[i];
                     if(item['apv_id']===30 || item['apv_id']==='30'){
                         $scope.selectedAvatar=avt2[i];
                     }
                  } 
               }else{
                   console.error('$scope.avatarImages is not an array:', $scope.avatarImages);
               }
               id='30';
           }
           
            if (id==="" ) {
                toastr.error("Please select Agent first");
                return;
            }

            jsLoader(true);
            $http({
                method: "post",
                url: "<?php echo base_url('get-selectedAvatarDetails'); ?>", 
                data: $.param({
                     selectedAvatarDetails: $scope.selectedAvatar || $scope.selectedAvatarData ,
                     prompt_id:$scope.prompt_id
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function (response) {
                if(response.data.status == 1){
                    window.location.href = "<?= base_url('avatar-appearance') ?>"+"/"+ response.data.last_id;
                }
                jsLoader(false);
            });
    }
          
        //   console.log('selected',$scope.selectedAvatar);
          
          $scope.getSelectedAvtImage = function(){
                var queryStr = "<?php echo base_url('get-getSelectedAvtImage')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        avt_id:  $scope.prompt_id
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                        $scope.selectedAvatarData =  response.data;
                        $scope.selectedAvtId = response.data.prompt_apv_id;
                        $scope.selectedImagePath = response.data.apv_image_path;
                        if($scope.selectedImagePath != undefined){
                        $(".avatar-chatbot").css('background-image','url('+$scope.selectedImagePath+')');
                        }
                        
                });
            }
 
        $scope.getSelectedAvtImage() 
        $scope.changeRoute = function(page) {
            if($scope.prompt_id!=""){  
                if(page == 'training') {
                      window.location.href = "<?= base_url('avatar-training') ?>"+"/"+ $scope.prompt_id['prompt_id'];
                }  else if(page == 'appearance') {
                      window.location.href = "<?= base_url('avatar-appearance') ?>"+"/"+$scope.prompt_id['prompt_id'];
                }  else {
                    window.location.href = "<?= base_url('avatar-settings') ?>"+"/"+ $scope.prompt_id['prompt_id']; 
                }
            }
          } 
          
          
           $scope.deleteAgentProfile = function($event,id) {
                $event.stopPropagation();
                     $("#deleteModal").modal('show');
                     $('#deleteModal .yes').on('click', function(e) {
                     $("#deleteModal").modal("hide");
                      $scope.deleteAgentProfileConfirm(id);
                 });
                };
          
          $scope.deleteAgentProfileConfirm = function(id)
          {
              $scope.imageId  = id
               var queryStr = "<?php echo base_url('delete_agent_profile')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({ id: $scope.imageId }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                      if (response.data.status == 1) {
                        toastr.error(response.data.mssg);
                    } else if (response.data.status == 2) {
                        toastr.success(response.data.msg); 
                        $scope.getAvatarImageDefault(); 
                        $scope.getAvatarImageBusiness();
                        $scope.getAvatarImage();
                    } else {
                        toastr.warning("Something went wrong!");
                    }
                     
                }).catch(function(error) {
                    toastr.error("Something went wrong!");
                });
          }
          
          $scope.show_msg = function (msg) {
            flashNow({'error': {'message': msg}});
        };
    });
    
    setTimeout(function(){
        $('.selectpicker').selectpicker('refresh');
    },100);
</script>
