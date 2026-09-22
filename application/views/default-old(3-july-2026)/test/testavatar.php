<div class="container-wrapper container-open">
    <title><?php echo $this->config->item('productName') ?> | Email</title>
    <div class="container-fluid container-padding">
        <div class="row">
        <div class="col-12 ">
                <div class="row justify-content-center align-items-center avatar-main-tabs">
                    <ul class="nav nav-pills nav-pills-style-1 mb-0 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link active" id="pills-avatar-tab" data-bs-toggle="pill" data-bs-target="#pills-avatar" type="button" role="tab" aria-controls="pills-avatar" aria-selected="true">
                                <i class="fa-solid fa-user-astronaut"></i>
                                Appereance
                            </button>
                        </li>
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link" id="pills-voice-tab" data-bs-toggle="pill" data-bs-target="#pills-voice" type="button" role="tab" aria-controls="pills-voice" aria-selected="false">
                                <i class="fa-solid fa-user-gear"></i>
                                Setup
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="row mt-3 mt-sm-5">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-avatar" role="tabpanel" aria-labelledby="pills-avatar-tab" tabindex="0">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-pills nav-pills-style-1 nav-pills-with-gradient mb-3 mb-sm-4" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-all-avatars-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-all-avatars" type="button" role="tab"
                                                aria-controls="pills-all-avatars" aria-selected="true">All Agents</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-my-avatar-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-my-avatar" type="button" role="tab"
                                                aria-controls="pills-my-avatar" aria-selected="false">My Agents</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-ai-avatar-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-ai-avatar" type="button" role="tab"
                                                aria-controls="pills-ai-avatar" aria-selected="false">AI Agents</button>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="pills-all-avatars" role="tabpanel" aria-labelledby="pills-all-avatars-tab" tabindex="0">
                                                <div class="row row-cols-2 row-cols-md-5 row-cols-sm-3">
                                                    <div class="col">
                                                        <div class="custom-upload-2 custom-upload-2-style-1 p-0" data-bs-toggle="modal" data-bs-target="#uploadModal" style="cursor: pointer;">
                                                            <label id="fashionGenInitFileLabel" class="w-100" style="pointer-events: none;">
                                                                <div class="form-group file-post custom-file-upload px-3 m-0 custom-height">
                                                                    <i class="fa-solid fa-square-plus"></i>
                                                                    <div class="theme-color w600">Create New</div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <!-- Tushar Work Start -->
                                                        <div class="modal fade upload-modal" id="uploadModal" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 500px;">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Upload Photo</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" style="overflow-x: hidden;">
                                                                        <div class="upload-area">
                                                                            <div class="form-group custom-file-upload custom-file-upload-style-2 upload_img_change">
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
                                                                                <input type="file" id="avatarImage" class="form-control" accept=".jpeg,.jpg,.png">
                                                                                <input type="hidden" name="type" value="avatar-image" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                            <label class="form-check-label" for="flexCheckDefault">Upload recent high-resolution photos of yourself, including close-ups and full-body shots with varied angles, expressions, and outfits.</label>
                                                                        </div>
                                                                        <div class="row g-2">
                                                                            <div class="col-md-6">
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
                                                                                                <div class="compare-image"></div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="compare-image"></div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="compare-image"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="swiper-pagination"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="compare-wrapper">
                                                                                    <div class="head-content">
                                                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path d="M9.5 18.5C14.4706 18.5 18.5 14.4706 18.5 9.5C18.5 4.52944 14.4706 0.5 9.5 0.5C4.52944 0.5 0.5 4.52944 0.5 9.5C0.5 14.4706 4.52944 18.5 9.5 18.5Z" fill="#E63946"/>
                                                                                            <path d="M10.7648 9.50017L12.8348 7.43917C13.0043 7.26969 13.0995 7.03984 13.0995 6.80017C13.0995 6.5605 13.0043 6.33064 12.8348 6.16117C12.6654 5.99169 12.4355 5.89648 12.1958 5.89648C11.9562 5.89648 11.7263 5.99169 11.5568 6.16117L9.49584 8.23117L7.43484 6.16117C7.26537 5.99169 7.03551 5.89648 6.79584 5.89648C6.55617 5.89648 6.32632 5.99169 6.15684 6.16117C5.98737 6.33064 5.89216 6.5605 5.89216 6.80017C5.89216 7.03984 5.98737 7.26969 6.15684 7.43917L8.22684 9.50017L6.15684 11.5612C6.07249 11.6448 6.00553 11.7444 5.95984 11.854C5.91415 11.9637 5.89062 12.0814 5.89062 12.2002C5.89062 12.319 5.91415 12.4366 5.95984 12.5463C6.00553 12.656 6.07249 12.7555 6.15684 12.8392C6.24051 12.9235 6.34005 12.9905 6.44972 13.0362C6.5594 13.0819 6.67703 13.1054 6.79584 13.1054C6.91465 13.1054 7.03229 13.0819 7.14196 13.0362C7.25164 12.9905 7.35118 12.9235 7.43484 12.8392L9.49584 10.7692L11.5568 12.8392C11.6405 12.9235 11.7401 12.9905 11.8497 13.0362C11.9594 13.0819 12.077 13.1054 12.1958 13.1054C12.3147 13.1054 12.4323 13.0819 12.542 13.0362C12.6516 12.9905 12.7512 12.9235 12.8348 12.8392C12.9192 12.7555 12.9862 12.656 13.0318 12.5463C13.0775 12.4366 13.1011 12.319 13.1011 12.2002C13.1011 12.0814 13.0775 11.9637 13.0318 11.854C12.9862 11.7444 12.9192 11.6448 12.8348 11.5612L10.7648 9.50017Z" fill="#EDEBEA"/>
                                                                                        </svg>
                                                                                        <span class="title">Bad Photos</span>
                                                                                    </div>
                                                                                    <p>Upload recent high-resolution photos of yourself, including close-ups and full-body shots with varied angles, expressions, and outfits.</p>
                                                                                    <div class="swiper compareBadSwiper">
                                                                                        <div class="swiper-wrapper">
                                                                                            <div class="swiper-slide">
                                                                                                <div class="compare-image"></div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="compare-image"></div>
                                                                                            </div>
                                                                                            <div class="swiper-slide">
                                                                                                <div class="compare-image"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="swiper-pagination"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-outline btn-outline-white" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Tushar Work End -->
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-my-avatar" role="tabpanel" aria-labelledby="pills-my-avatar-tab" tabindex="0">
                                                <div class="row row-cols-5">
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                        <p class="mb-0">Remove</p>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-ai-avatar" role="tabpanel" aria-labelledby="pills-ai-avatar-tab" tabindex="0">
                                                <div class="row row-cols-5">
                                                    <div class="col">
                                                        <div class="avatar-wrapper avatar-wrapper-style-2">
                                                            <div class="avatar-wrapper-inner">
                                                                <div class="avatar-img" style="overflow: visible;">
                                                                    <div class="check-icon" style="border-radius: inherit;">
                                                                        <a href="javascript:void(0)" class="btn btn-white">Choose Avatar</a>
                                                                    </div>
                                                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="Image" style="border-radius: inherit;">
                                                                </div>
                                                                <p class="mb-0">Avatar 1</p>
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
                        <div class="tab-pane fade" id="pills-voice" role="tabpanel" aria-labelledby="pills-voice-tab" tabindex="0">
                            <div class="row g-xl-5">
                                <div class="col-sm-9 border-after">
                                    <div class="comman-ai-box">
                                        <div class="prompt-box position-relative">
                                            <p>Enter Your own voice over script or generate with AI</p>
                                            <textarea name="custom_prompt" id="custom_prompt" class="form-control" placeholder="Describe what you want to see with phrases."></textarea>
                                            <button type="button" class="generate-btn"><i class="fa-solid  fa-wand-magic-sparkles"></i></button>
                                        </div>
                                    </div>
                                    <div class="voice-wrapper"> 
                                        <p>Select Voice</p>
                                        <div class="voice-area"> 
                                            <div class="top-area">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-lg-4">
                                                        <div class="search-bar">
                                                            <div class="search-icon">
                                                                <span class="icon-search"></span>
                                                            </div>
                                                            <input type="text" class="search form-control" placeholder="Search..">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <select title="Avatars">
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-2">
                                                        <select title="English">
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-2">
                                                        <select title="Accent">
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-2">
                                                        <select title="Emotion">
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inner-wrapper">
                                                <div class="list-group">
                                                    <div class="list-group-item list-group-item-action active">
                                                        <span class="icon"><i class="fa-solid fa-play"></i></span>
                                                        <span class="text">Simon Carter (Arabic)</span>
                                                    </div>
                                                    <div class="list-group-item list-group-item-action">
                                                        <span class="icon"><i class="fa-solid fa-play"></i></span>
                                                        <span class="text">Cole Bennett (Arabic)</span>
                                                    </div>
                                                    <div class="list-group-item list-group-item-action">
                                                        <span class="icon"><i class="fa-solid fa-play"></i></span>
                                                        <span class="text">Adria (Afrikaans)</span>
                                                    </div>
                                                    <div class="list-group-item list-group-item-action">
                                                        <span class="icon"><i class="fa-solid fa-play"></i></span>
                                                        <span class="text">Liam (Afrikaans)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="avatar-right-area">
                                        <div class="avatar-image-box">
                                            <img src="<?php echo $this->config->item('assetsPath') ?>images/generate-avatar.png" alt="image">
                                        </div>
                                        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoPrModal">Generate Avatar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <!-- videoPrModal -->
    <div class="modal fade video-pr-modal" id="videoPrModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 370px;">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Avatar Video Preview</h5>
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
</div>
