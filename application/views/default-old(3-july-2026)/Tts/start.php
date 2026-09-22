<title><?php echo $this->config->item('productName') ?> | Create App Set  </title>

<style>

    .templates-card.style-3::before{
        content: attr(data-count);
        width: 24px;
        height: 24px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 50%;
        top: 10px;
        position: absolute;
        left: 10px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateX(-10px) scale(0.8);
        transition: 0.3s;
    }
    .templates-card.style-3.active::before{
        transform: translateX(0) scale(1);
        opacity: 1;
    }
    .templates-card.style-3.active{
        background: var(--rgba-primary-1);
    }

</style>
<!-- Container Start -->
<div class="container-wrapper container-open">
    <div class="container-fluid container-padding">
        <div class="comman-top-bar">
            <div class="edit-box d-flex align-items-center gap-3">
                <div class="back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                        <g clip-path="url(#clip0_105_2116)">
                            <path d="M30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15ZM12.7383 22.084L6.88477 15.8086C6.67969 15.5859 6.5625 15.2988 6.5625 15C6.5625 14.7012 6.67969 14.4082 6.88477 14.1914L12.7383 7.91602C12.9844 7.65234 13.3301 7.5 13.6934 7.5C14.4141 7.5 15 8.08594 15 8.80664V12.1875H20.625C21.6621 12.1875 22.5 13.0254 22.5 14.0625V15.9375C22.5 16.9746 21.6621 17.8125 20.625 17.8125H15V21.1934C15 21.9141 14.4141 22.5 13.6934 22.5C13.3301 22.5 12.9844 22.3477 12.7383 22.084Z" fill="white" fill-opacity="0.6"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_105_2116">
                                <rect width="30" height="30" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="edit">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img2.png" alt="user">
                            <p class="m-0">App Set 1</p>
                    </div>
                    <i class="fa-regular fa-pen-to-square"></i>
                </div>
            </div>
            <div class="btn-boxes">
                <a href="" class="btn btn-light text-dark">Create App Set</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="title-line w600">
                    Create App Set
                </div>
                <p class="container-page-subtitle mt10">One or more apps to create app set*</p>
            </div>
        </div>
        <div class="row mt10">
            <div class="col-md-12 col-12">
                <div class="search-bar" style="max-width: 100vw">
                    <input type="text" class="search1 form-control ng-pristine ng-untouched ng-valid" placeholder="Search for AI Assistants..." id="searchText" ng-model="searchQuery" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row mt10">
            <div class="col-md-12 col-12">
                <div class="tabs-banner style-2 p-0 bg-transparent">
                    <ul class="f-12 w600 white p-0 m-0 tabs-list" >
                        <li class="active">All AI Chats</li>
                        <li ng-click="changeTab(1)">Business</li>
                        <li ng-click="changeTab(2)">Coach</li>
                        <li ng-click="changeTab(4)">Education</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt20 mt-md30 row-gap row-cols-xxl-5 row-cols-lg-4 row-cols-sm-2">
            <div class="col">
                <div class="templates-card style-3" data-count="01">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets/images/default-img.png">
                    </div>
                    <div class="content">
                        <h6 class="title">YouTube Short Scripts</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="templates-card style-3" data-count="02">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img.png">
                    </div>
                    <h6 class="title">YouTube Short Scripts</h6>
                </div>
            </div>
            <div class="col">
                <div class="templates-card style-3" data-count="03">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img.png">
                    </div>
                    <h6 class="title">YouTube Short Scripts</h6>
                </div>
            </div>
            <div class="col">
                <div class="templates-card style-3" data-count="04">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img.png">
                    </div>
                    <h6 class="title">YouTube Short Scripts</h6>
                </div>
            </div>
            <div class="col">
                <div class="templates-card style-3" data-count="05">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img.png">
                    </div>
                    <h6 class="title">YouTube Short Scripts</h6>
                </div>
            </div>
            <div class="col">
                <div class="templates-card style-3" data-count="06">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img.png">
                    </div>
                    <h6 class="title">YouTube Short Scripts</h6>
                </div>
            </div>
            <div class="col">
                <div class="templates-card style-3" data-count="07">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img.png">
                    </div>
                    <h6 class="title">YouTube Short Scripts</h6>
                </div>
            </div>
            <div class="col">
                <div class="templates-card style-3" data-count="08">
                    <div class="template-image">
                        <img src="https://cdn.instaengineai.com/app/assets//images/default-img.png">
                    </div>
                    <h6 class="title">YouTube Short Scripts</h6>
                </div>
            </div>


            <!-- ngIf: allList.length == 0 --><div ng-if="allList.length == 0" class="d-none ng-scope">
                <div class="col-xs-12  mt30px xsmt25px">
                    <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 mt2 xsmt3">
                                <div class="col-xs-12 padding0 ">
                                    <img src="https://cdn.instaengineai.com/app/assets/default/images/no-record-found.png" class="img-responsive center-block mt6 xsmt6">
                                        <div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Record Found</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end ngIf: allList.length == 0 -->

        </div>
    </div>



    <script>
        $('.templates-card').on('click', function () {
            $(this).toggleClass('active');
        })
    </script>