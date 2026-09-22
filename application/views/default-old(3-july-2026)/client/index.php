<?php
// pr($stats_counts); die;
$assetsFolder = $this->config->item('assetsTemplatePath');
$min_date = date('m-d-Y', time());
?>
<!--------- graph start------------------------>
<link href="<?php echo $assetsFolder; ?>css/nv.d3.css" rel="stylesheet" type="text/css">
<script src="<?php echo $assetsFolder; ?>js/d3.min.js" charset="utf-8"></script>
<script src="<?php echo $assetsFolder; ?>js/nv.d3.js"></script>

<style>
    @media only screen and (min-width : 768px) {
        .text-sm-right {
            text-align: right;
        }
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .dashtopbox .row {
        display: flex;
        align-items: center;
    }

    svg {
        display: block;
    }

    #linechart1 {
        margin: 10px 0 0 0;
        padding: 0px;
        height: 100%;
        width: 100%;
    }

    @media (min-width: 768px) {
        #linechart1 {
            height: 300px;
        }
    }

    .dash-bg {
        width: 100%;
        background: var(--theme-gradient);
        background-size: cover;
        display: flex;
        padding: 0 20px;
        border-radius: 10px;
        overflow: hidden;
        padding-bottom: 0;
        position: relative;
        color: #fff;
        display: flex;
        align-items: center;
        min-height: 180px;
        /*flex-wrap: wrap;*/

    }

    @media (max-width: 768px) {
        .dash-bg {
            flex-direction: column-reverse;
        }

        .launch-card {
            margin-top: 20px;
        }

        .link-card {
            margin-bottom: 20px;
        }
    }

    .dash-bg::before {
        content: '';
        background: url('<?php echo $assetsFolder; ?>images/dash-bg.png');
        background-size: contain;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        mix-blend-mode: plus-lighter;
    }

    .dash-bg img,
    .dash-bg div {
        position: relative;
        z-index: 100;
        max-width: 100%;
        object-fit: contain;
    }

    .pt-40 {
        padding-top: 20px;
    }

    @media (min-width: 768px) {
        .pt-40 {
            padding-top: 40px;
        }

        .dash-bg::before {
            background-size: 100% 100%;
        }
    }

    .launch-card {
        padding: 30px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        row-gap: 5rem;
        background: var(--theme-bg-color);
        border-radius: 20px;
    }

    .cards-section {
        padding-top: 30px;

        position: relative;

    }

    .cards-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        height: 1px;
        background: var(--border-color);
        width: 96%;
        text-align: center;
        transform: translateX(-50%);
    }

    .pl0 {
        padding-left: 0;
    }

    .dash-section {
        padding-bottom: 30px !important;
    }

    .dashtopbox {
        background: var(--theme-bg-color);
        padding: 15px;
        height: 100%;
    }

    /*.dashtopbox .{*/
    /*    min-width: 75px;*/
    /*    min-height: 75px;*/
    /*}*/
    .linking-box {
        padding: 30px;
        background: var(--theme-bg-color);
        border-radius: 10px;
    }

    .linking-box .heading {
        margin-bottom: 20px;
    }

    .linking-box .link-card {
        padding: 20px;
        background: var(--theme-bg-color);
        display: flex;
        align-items: center;
        column-gap: 15px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        overflow: hidden;
        transition: 0.5s;
    }

    .linking-box .link-card i,
    .linking-box .link-card span {
        font-size: 25px;
        color: var(--body-color);
    }


    .link-card .bg {
        position: absolute;
        display: block;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: var(--theme-gradient);
        transition: width 0.6s ease-in-out, height 0.4s ease-in-out;
        transform: translate(-50%, -50%);
        z-index: -1;

    }

    .link-card:hover {
        box-shadow: 0 2px 4px 0 rgba(136, 144, 195, 0.2),
            0 5px 15px 0 rgba(37, 44, 97, 0.15);
        transform: translateY(-6px);
    }

    .link-card:hover .bg {
        width: 225%;
        height: 562.5px;
    }

    .dash-img {
        position: absolute !important;
        right: 0;
        top: 0;
        width: auto;
        padding-right: 10px;
        text-align: right;
    }

    .dash-img::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        box-shadow: 0 -10px 105px 140px var(--primary);
        z-index: 10;
    }

    .dash-img img {
        z-index: 0;
    }

    .content-side {
        z-index: 200 !important;
    }

    .videp-blank-box {
        border-radius: 10px;
        background: var(--theme-bg-color);
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icons-listing-box {
        overflow-y: scroll;
        background: var(--theme-bg-color);
        border-radius: 10px;
        height: 100%;
    }

    .icons-listing-box::-webkit-scrollbar {
        display: none;
    }

    .icons-headings {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1)
    }

    .icons-headings a {
        padding: 0 !important;
        display: block;
        width: 100%;

    }

    .icons-headings a,
    .icons-headings h4 {
        width: 100%;
        padding: 20px;
        text-align: center;
        color: var(--theme-text-color);
    }

    .icons-headings li.active h4 a {
        color: #fff;
    }

    .icons-headings li.active h4 {
        border-bottom: 1px solid #fff;
    }

    .icons-list {
        height: calc(100% - 61px);
        position: relative;
        margin: 0;
    }

    .icons-list .not-found-img {
        margin: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .icons-list li {
        display: flex;
        align-items: center;
        gap: 20px;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1)
    }

    .icons-list li:last-child {
        border-bottom: 0;
    }

    .icons-list li .price {
        color: #0ACE82;
        font-size: 24px;
        font-weight: 700;
    }

    .icons-listing-box.style-2 h4 {
        border: 0;
        text-align: left;
    }

    .icons-listing-box.style-2 a {
        color: var(--theme-text-color);
        width: 50%;
        text-align: center;
        text-decoration: underline;
    }

    .icons-listing-box.style-2 .icons-list span {
        color: rgba(255, 255, 255, 0.40);
        font-size: 14px;
        font-weight: 400;
        display: block;
    }

    .icons-listing-box.style-2 .icons-list .info-area {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .license-box {
        padding: 75px 20px;
        background: url('<?php echo $assetsFolder; ?>images/bg-dash-img.png');
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        row-gap: 20px;
        border-radius: 10px;
        height: 100%;
    }

    .section-head {
        margin-bottom: 30px;
    }

    .section-head .title {
        color: #FFF;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 5px
    }

    .section-head p {
        color: #86898B;
        font-size: 14px;
        font-weight: 400;
    }
</style>


<title><?php echo $this->config->item('productName') ?> | Dashboard</title>
<?php
$add_your_product_btn = '<a class="imsite-btn autobtn" href="' . site_url('custom-product-setting/about') . '">Add New Course</a>';
?>
<!-- Page Content Start -->
<div class="page-content footer-height" ng-app="myApp" ng-controller="customersCtrl" id="customersCtrl">
    <div class="container-fluid">
        <div class="row">

            <!-- Header title Start -->
            <!-- <div class="col-xs-12 padding0">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <h1 class="md30 sm29 xs25 text-ellipsis lh110"><?php //echo "Hello " . $logged_in['name']; 
                                                                        ?></h1>
                        <p class="md14 sm14 xs14 mt5px xsmt7px">Get a brief overview about your courses here</p>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12 text-sm-right mt0 xsmt10px smmt5px">
					 //$add_your_product_bt &nbsp;
					<a class="bordernav autobtn" style="padding:9px 10px!important; font-size:17px;" data-toggle="modal" data-target="#howtoModal" href="javascript:void" title="Watch How"><i class="icon icon-step-by-step-training"></i></a>
                    </div>
                </div>
            </div> -->
            <!-- Header title end -->

            <!-- Top Box Section Start -->
            <div class="col-xs-12 mb-3">
                <div class="section-head">
                    <h2 class="title">Dashboard</h2>
                    <p>Get a brief overview about your courses here</p>
                </div>
            </div>
            <div class="col-xs-12 dash-section ">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="dash-bg">
                            <div class="content-side">
                                <h1 class="md28  sm26 xs25 w600 text-ellipsis lh110"><?php echo "Hello " . $logged_in['name']; ?></h1>
                                <p class="md14 sm14 xs14 mt5px xsmt7px">Transform Your Coaching Practice where Innovation Meets Success...</p>
                                <a class="btn btn-warning mt20px" href="<?php echo base_url('subscription') ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                                        <path d="M8.58333 2.8329C8.9 2.63845 9.11111 2.28568 9.11111 1.88845C9.11111 1.27457 8.61389 0.777344 8 0.777344C7.38611 0.777344 6.88889 1.27457 6.88889 1.88845C6.88889 2.28845 7.1 2.63845 7.41667 2.8329L5.825 6.01623C5.57222 6.52179 4.91667 6.66623 4.475 6.31346L2 4.3329C2.13889 4.14679 2.22222 3.91623 2.22222 3.66623C2.22222 3.05234 1.725 2.55512 1.11111 2.55512C0.497222 2.55512 0 3.05234 0 3.66623C0 4.28012 0.497222 4.77734 1.11111 4.77734C1.11667 4.77734 1.125 4.77734 1.13056 4.77734L2.4 11.7607C2.55278 12.6051 3.28889 13.2218 4.15 13.2218H11.85C12.7083 13.2218 13.4444 12.6079 13.6 11.7607L14.8694 4.77734C14.875 4.77734 14.8833 4.77734 14.8889 4.77734C15.5028 4.77734 16 4.28012 16 3.66623C16 3.05234 15.5028 2.55512 14.8889 2.55512C14.275 2.55512 13.7778 3.05234 13.7778 3.66623C13.7778 3.91623 13.8611 4.14679 14 4.3329L11.525 6.31346C11.0833 6.66623 10.4278 6.52179 10.175 6.01623L8.58333 2.8329Z" fill="white" />
                                    </svg> <span style="padding-left: 4px"> Upgrade</span></a>
                            </div>
                            <div class="dash-img">
                                <img src="<?php echo $assetsFolder; ?>images/dash-main-img.png" alt="Main Image">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Top Box Section End -->
            <div class="col-xs-12 cards-section">
                <div class="row">
                    <div class="col-lg-8 col-xs-12">
                        <div class="videp-blank-box" style="overflow: hidden;">
                            <img class="img-responsive center-block" src="<?php echo $assetsFolder; ?>images/videp-blank-box-img.png" alt="Image" style="
                                height: 100%;
                                width: 100%;
                                object-fit: cover;
                            ">
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 col-xs-12 mb20px xsmb20px">
                                <div class="dashtopbox">
                                    <div class="row margin0 " style="gap: 15px">
                                        <div class="padding0">
                                            <img src="<?php echo $assetsFolder; ?>images/dash-card1.png" class="img-responsive ">
                                        </div>
                                        <div class="col-lg-topbox2 col-md-7 col-sm-7 col-xs-8  pl0 toptext mt6px xsmt4px">
                                            <div class="lg28 md20 sm17 xs30 lh100 w600"><?php echo $stats_counts['total_products'] ?></div>
                                            <div class="xs14 lh100 theme-text-color-light w300 xsmt10px text-uppercase">Total Courses</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12 col-xs-12 mb20px xsmb20px">
                                <div class="dashtopbox ">
                                    <div class="row margin0 " style="gap: 15px">
                                        <div class="padding0">
                                            <img src="<?php echo $assetsFolder; ?>images/dash-card2.png" class="img-responsive ">
                                        </div>
                                        <div class="col-lg-topbox2 col-md-7 col-sm-7 col-xs-8  pl0">
                                            <div class="lg28 md20 sm17 xs30 lh100 w600">
                                                <div class="vinline" data-toggle="tooltip"><?php echo $stats_counts['total_visitors']; ?></div>
                                            </div>
                                            <div class="xs14 lh100 theme-text-color-light w300 xsmt10px text-uppercase">Total Visitors</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12 col-xs-12 mb20px xsmb20px">
                                <div class="dashtopbox lgtopbox topboxalign1">
                                    <div class="row margin0 " style="gap: 15px">
                                        <div class="padding0">
                                            <img src="<?php echo $assetsFolder; ?>images/dash-card3.png" class="img-responsive ">
                                        </div>
                                        <div class="col-lg-topbox2 col-md-7 col-sm-7 col-xs-8  pl0">
                                            <div class="lg28 md20 sm17 xs30 lh100 w600">
                                                <div class="vinline" data-toggle="tooltip" title="0"><?php echo $stats_counts['total_sales']; ?></div>
                                            </div>
                                            <div class="xs14 lh100 theme-text-color-light w300 xsmt10px text-uppercase">Total Sales</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12 col-xs-12 mb0">
                                <div class="dashtopbox lgtopbox mdtop topboxalign2">
                                    <div class="row margin0 " style="gap: 15px">
                                        <div class="padding0">
                                            <img src="<?php echo $assetsFolder; ?>images/dash-card4.png" class="img-responsive ">
                                        </div>
                                        <div class="col-lg-topbox2 col-md-7 col-sm-7 col-xs-8  pl0">
                                            <div class="lg28 md20 sm17 xs30 lh100 w600">
                                                <div class="vinline" data-toggle="tooltip" title="0"><?php echo $stats_counts['total_subscribers']; ?></div>
                                            </div>
                                            <div class="xs14 lh100 theme-text-color-light w300 xsmt10px text-uppercase">Total Members</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>

            <div class="col-xs-12 ">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12 ">
                                <div class="icons-listing-box">
                                    <ul class="nav nav-tabs producttabs icons-headings">
                                        <li class="active">
                                            <h4 class="active">
                                                <a href="#producttab" data-toggle="tab" aria-expanded="true">
                                                    Top Selling Courses
                                                </a>
                                            </h4>
                                        </li>
                                        <li>
                                            <h4>
                                                <a href="#articletab" data-toggle="tab" aria-expanded="false">
                                                    Most Viewed Articles
                                                </a>
                                            </h4>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <ul class="icons-list tab-pane active" id="producttab" ng-show="top_sale_products_load == 1 && top_sale_products.length > 0">
                                            <li ng-repeat="product in top_sale_products">
                                                <img ng-src="{{product.image}}" alt="">
                                                <h4>{{product.title}}</h4>
                                                <p class="price">${{product.price}}</p>
                                            </li>
                                            <!--<li>-->
                                            <!--    <img src="<?php echo $assetsFolder; ?>images/dash-card1.png" alt="">-->
                                            <!--    <h4>Email marketing (Frontend)</h4>-->
                                            <!--    <p class="price">$10</p>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <img src="<?php echo $assetsFolder; ?>images/dash-card1.png" alt="">-->
                                            <!--    <h4>Email marketing (Frontend)</h4>-->
                                            <!--    <p class="price">$10</p>-->
                                            <!--</li>-->
                                        </ul>
                                        <ul class="icons-list" ng-hide="top_sale_products_load == 1 && top_sale_products.length > 0">
                                            <img src="<?php echo $assetsFolder; ?>images/not-found-img.png" class="img-fluid not-found-img" alt="Data Not Found">
                                        </ul>
                                        <ul class="icons-list tab-pane" id="articletab">
                                            <?php
                                            if (count($top_article) > 0) {
                                                foreach ($top_article as $val) {
                                            ?>
                                                    <li>
                                                        <?php if ($val['image'] != '') { ?>
                                                            <img src="<?= $val['image'] ?>" class="img-responsive">
                                                        <?php } else { ?>
                                                            <img src="<?php echo $assetsPath; ?>front_end/default/images/default-blog.png" class="img-responsive">
                                                        <?php } ?>
                                                        <h4><?php echo $val['title']; ?></h4>
                                                    </li>
                                                <?php } ?>
                                        </ul>
                                    <?php   } else {
                                    ?>
                                        <ul class="icons-list" ng-hide="top_sale_products_load == 1 && top_sale_products.length > 0">
                                            <img src="<?php echo $assetsFolder; ?>images/not-found-img.png" class="img-fluid not-found-img" alt="Data Not Found">
                                        </ul>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="icons-listing-box style-2">
                                    <div class="icons-headings">
                                        <h4 class="active">Recently Sold 10 Courses</h4>
                                        <!--<a href="#" >View All</a>-->
                                    </div>
                                    <ul class="icons-list" ng-show="recent_sold_products_load == 1 && recent_sold_products.length > 0">
                                        <li ng-repeat="product in recent_sold_products">
                                            <div class="info-area">
                                                <img src="{{product.image}}" alt="" class="img-responsive productboximg">
                                                <div>
                                                    <h4>{{product.title}}

                                                    </h4>
                                                    <span class="user-mail">{{product.email}}</span>
                                                    <span class="user-date">{{(product.created)*1000 | date : "MMM d, y" }}</span>
                                                </div>
                                            </div>
                                            <p class="price">${{product.price}}</p>
                                        </li>
                                    </ul>
                                    <ul class="icons-list" ng-hide="recent_sold_products_load == 1 && recent_sold_products.length > 0">
                                        <img src="<?php echo $assetsFolder; ?>images/not-found-img.png" class="img-fluid not-found-img" alt="Data Not Found">
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="icons-listing-box style-2">
                            <div class="icons-headings">
                                <h4 class="active">Recent Customer Tickets</h4>
                                <a href="<?= site_url('all-tickets') ?>">View All</a>
                            </div>
                            <ul class="icons-list" ng-show="recent_tickets_load == 1 && recent_tickets.length > 0">
                                <li ng-repeat="ticket in recent_tickets">
                                    <div class="info-area">
                                        <div>
                                            <div class="md12 sm12 xs12 w700" ng-class="ticket.priority_class">{{ticket.priority}}</div>
                                            <div class="md16 sm15 xs14 mt5px xsmt5px w700"><a ng-href="<?= site_url('view-ticket') . "/" ?>{{ticket.id}}" class="link">{{ticket.email}}</a></div>
                                            <div class="md14 sm14 xs14 mt4px xsmt5px">{{ticket.subject}}</div>
                                            <div class="md14 sm14 xs14 mt4px xsmt5px">{{(ticket.created)*1000 | date : "MMM d, y" }}</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="icons-list" ng-hide="recent_tickets_load == 1 && recent_tickets.length > 0">
                                <img src="<?php echo $assetsFolder; ?>images/not-found-img.png" class="img-fluid not-found-img" alt="Data Not Found">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <hr>
        </div>
        <div class="row">
            <div class="col-xs-12 ">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="graphsection  graphjs" data-graphsrc="<?php echo base_url('website-view-stats'); ?>">
                            <!--- Title Section ------->
                            <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                                <div class="row">
                                    <div class="col-lg-5 col-md-3 col-sm-3 col-xs-12 pr0">
                                        <div class="md18 sm16 xs16 w700 lh100 text-ellipsis mt10px xsmt5px" title="Traffic Graph">Traffic Graph</div>
                                    </div>

                                    <!--- Calendar block ------->
                                    <div class="col-lg-7 col-md-9 col-sm-9 col-xs-12">
                                        <div class="row" style="justify-content: end;">
                                            <div class="col-md-2 col-sm-0 col-xs-0"></div>

                                            <div class="col-md-3 col-sm-3 col-xs-6 mb0 xsmb3 mt0 xsmt6 imsite-form smleft">
                                                <div class="lgraphshow1 cdates1">
                                                    <input type="text" class="form-control md14 sm14 xs14 single-calander graphFromDate" placeholder="From Date">
                                                    <div class="dashimg visible-lg"><img src="<?php echo $assetsFolder; ?>images/dash.png" class="img-responsive center-block"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-3 col-xs-6 mb0 xsmb3 mt0 xsmt6 imsite-form smright">
                                                <div class="lgraphshow1 cdates1">
                                                    <input type="text" value="" class="form-control md14 sm14 xs14 single-calander graphToDate" placeholder="To Date">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12 md14 sm14 xs14 mb0 xsmb2">
                                                <select class="selectpicker linegraph1 graphSelect">
                                                    <option value="week">This Week</option>
                                                    <option value="month">This Month</option>
                                                    <option value="year">This Year</option>
                                                    <option value="cdates1">Custom</option>
                                                </select>
                                            </div>

                                            <div class="col-md-1 col-sm-2 col-xs-2 md18 sm18 xs18 pl0 text-center">
                                                <a href="#" class="refresh-icon graphbtn" title="Refresh"><i class="icon-reset"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                    <!--- Calendar block end------->
                                </div>
                            </div>
                            <!--- Title Section end----->

                            <!--- Graph--->
                            <div class="grapharea clear md14 sm14 xs14">
                                <input id="day1" name="lcharttoggler1" class="graphRadio" value="day" checked="checked" type="radio">
                                <label for="day1">Day </label>
                                <input id="week1" name="lcharttoggler1" class="graphRadio" value="week" type="radio">
                                <label for="week1">Week </label>
                                <input id="month1" name="lcharttoggler1" class="graphRadio" value="month" type="radio">
                                <label for="month1">Month </label>
                                <div id="linechart1" data-graphpath="linechart1 svg">
                                    <svg></svg>
                                </div>
                            </div>
                            <!--- Graph--->
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="license-box">
                            <img src="<?php echo $assetsFolder; ?>images/license-img.png" alt="Reseller image">
                            <?php if (in_array(12, $purchase_plan_ids)  || in_array(13, $purchase_plan_ids)) {  ?>
                            <a href="https://warriorplus.com/aff-offer/o/cx0jny" class="btn btn-white w600 text-dark">Get Reseller License</a>
                             <?php } else { ?>
                            <a href="<?php echo base_url('subscription');  ?>" class="btn btn-white w600 text-dark">Get Reseller License</a>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <hr>
        </div>

        <div class="col-xs-12 padding0">
            <div class="">
                <div class="linking-box">
                    <div class="heading md16 lh100 w600">Quick links</div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12 col-12 mt20px">
                            <a class="link-card" href="<?php echo base_url('add-client'); ?>">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                <p class="theme-text-color">Add Clients</p>
                                <span class="bg m-0 p-0"></span>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-12 mt20px">
                            <a class="link-card" href="<?php echo base_url('bonuses/exclusive-bonuses'); ?>">
                                <span class="icon icon-bonuses"></span>
                                <p class="theme-text-color">Bonuses</p>
                                <span class="bg m-0 p-0"></span>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-12 mt20px">
                            <a class="link-card" href="<?php echo base_url('integration-settings'); ?>">
                                <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                                <p class="theme-text-color">Integration</p>
                                <span class="bg m-0 p-0"></span>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-12 mt20px">
                            <a class="link-card" href="<?php echo base_url('members'); ?>">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <p class="theme-text-color">Members</p>
                                <span class="bg m-0 p-0"></span>
                            </a>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 col-12 mt20px">
                            <a class="link-card" href="<?php echo base_url('training'); ?>">
                                <i class="fa fa-file-video-o" aria-hidden="true"></i>
                                <p class="theme-text-color">Training</p>
                                <span class="bg m-0 p-0"></span>
                            </a>
                        </div>


                        <div class="col-md-4 col-sm-6 col-xs-12 col-12 mt20px">
                            <a class="link-card" href="<?php echo base_url('stats-overview'); ?>">
                                <span class="icon icon-reports"></span>
                                <p class="theme-text-color">Help</p>
                                <span class="bg m-0 p-0"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traffic On Website Start -->
    </div>
    <!-- <div class="col-xs-12 graphsection graphjs" data-graphsrc="<?php //echo base_url('website-view-stats'); 
                                                                    ?>"> -->
    <!--- Title Section ------->
    <!-- <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                    <div class="row"> -->
    <!-- <div class="col-lg-5 col-md-3 col-sm-3 col-xs-12 pr0">
                            <div class="md18 sm16 xs16 w700 lh100 text-ellipsis mt10px xsmt5px" title="Traffic Graph">Traffic Graph</div>
                        </div> -->

    <!--- Calendar block ------->
    <!-- <div class="col-lg-7 col-md-9 col-sm-9 col-xs-12">
                            <div class="row">

                                <div class="col-md-2 col-sm-0 col-xs-0"></div>

                                <div class="col-md-3 col-sm-3 col-xs-6 mb0 xsmb3 mt0 xsmt6 imsite-form smleft">
                                    <div class="lgraphshow1 cdates1">
                                        <input type="text" class="form-control md14 sm14 xs14 single-calander graphFromDate" placeholder="From Date">
                                        <div class="dashimg visible-lg"><img src="<?php //echo $assetsFolder; 
                                                                                    ?>images/dash.png" class="img-responsive "></div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-6 mb0 xsmb3 mt0 xsmt6 imsite-form smright">
                                    <div class="lgraphshow1 cdates1">
                                        <input type="text" value="" class="form-control md14 sm14 xs14 single-calander graphToDate" placeholder="To Date">
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-4 col-xs-10 md14 sm14 xs14 mb0 xsmb2">
                                    <select class="selectpicker linegraph1 graphSelect">
                                        <option value="week">    This Week </option>
                                        <option value="month">   This Month </option>
                                        <option value="year">    This Year </option>
                                        <option value="cdates1"> Custom </option>
                                    </select>
                                </div>

                                <div class="col-md-1 col-sm-2 col-xs-2 md18 sm18 xs18 pl0 text-center">
                                    <a href="#" class="refresh-icon graphbtn" title="Refresh"><i class="icon-reset"></i></a></div>
                            </div>

                        </div> -->
    <!--- Calendar block end------->
    <!-- </div> -->
    <!-- </div> -->
    <!--- Title Section end----->

    <!--- Graph--->
    <!-- <div class="grapharea clear md14 sm14 xs14">
                    <input id="day1" name="lcharttoggler1" class="graphRadio" value="day" checked="checked" type="radio">
                    <label for="day1">Day </label>
                    <input id="week1" name="lcharttoggler1" class="graphRadio" value="week" type="radio">
                    <label for="week1">Week </label>
                    <input id="month1" name="lcharttoggler1" class="graphRadio" value="month" type="radio">
                    <label for="month1">Month </label>
                    <div id="linechart1" data-graphpath="linechart1 svg">
                        <svg></svg>
                    </div>
                </div> -->
    <!--- Graph--->
    <!-- </div> -->


    <!-- Third Section Starts-->
    <!-- <div class="col-xs-12 mt30px xsmt25px padding0">
                <div class="row"> -->

    <!-- Recently Sold Products Section Starts-->
    <!-- <div class="col-sm-6 col-xs-12">
                        <div class="col-xs-12 recentprosec">
                            <div class="col-xs-12 lg18 md16 sm16 xs16 w700 lh100 padding0 mb25px xsmb25px">Recently Sold 10 Courses </div>

                            <div class="col-xs-12 mCustomScrollbar mCustomScrollbarproduct darkscroll">
                                <div class="col-xs-12 padding0 mt5px xsmt5px proborder">
                                    <div class="ng-cloak" ng-show="recent_sold_products_load == 1 && recent_sold_products.length > 0">
                                        <div class="col-xs-12 padding0 mb30px xsmb25px" ng-repeat="product in recent_sold_products">
                                            <div class="col-md-2 col-sm-2 col-xs-12 padding0">
                                                <img ng-src="{{product.image}}" class="img-responsive productboximg">
                                            </div>
                                            <div class="col-md-7 col-sm-8 col-xs-8 mt14px xsmt20px xspadding0">
                                                <div class="lg16 md15 sm14 xs14 w700 lh120 text-ellipsis" title="YouTube Marketing 2018">
                                                    {{product.title}}
                                                    <span ng-if="product.plan_type == 'fe'">(Frontend)</span>
                                                    <span ng-if="product.plan_type == 'upsell'">(Upsell)</span>
                                                    <span ng-if="product.plan_type == 'free_report'">(Free Report)</span>
                                                </div>
                                                <div class="md14 sm14 xs14 mt3px xsmt5px">{{product.email}}</div>
                                                <div class="md14 sm14 xs14 mt3px xsmt5px">{{(product.created)*1000 | date : "MMM d, y" }}</div>
                                            </div>
                                            <div class="col-md-3 col-sm-2 col-xs-4 lg22 md20 sm18 xs16 w700 mt25px xsmt25px pl0 text-center">
                                                ${{product.price}}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="ng-cloak" ng-hide="recent_sold_products_load == 1 && recent_sold_products.length > 0">
                                        <img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-responsive  mt6 xsmt6">
                                        <div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Record Found</div>
                                    </div>
                                    
                                    <div ng-show="recent_sold_products_load == 0" class="ng-cloak">
                                        <img src="<?php echo $assetsFolder; ?>images/preloader.gif" class="img-responsive ">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div> -->
    <!-- Recently Sold Products Section Ends-->

    <!-- Recently Customer Tickets Section Starts-->
    <!-- <div class="col-sm-6 col-xs-12 mt0 xsmt25px">
                        <div class="col-xs-12 recentprosec">
                            <div class="col-xs-12 padding0 mb25px xsmb25px">
                                <div class="col-sm-10 col-xs-9 lg18 md16 sm16 xs16 w700 lh100 padding0">Recent Customer Tickets</div>
                                <div class="col-sm-2 col-xs-3 lg18 md16 sm16 xs16 w700 lh100 text-center"><a href="<?= site_url('all-tickets') ?>" class="link">All</a></div>
                            </div>

                            <div class="col-xs-12 mCustomScrollbar mCustomScrollbarproduct darkscroll">
                                <div class="col-xs-12 padding0 proborder">

                                    <div class="ng-cloak" ng-show="recent_tickets_load == 1 && recent_tickets.length > 0">
                                        <div class="col-xs-12 pl0 mb25px xsmb20px" ng-repeat="ticket in recent_tickets">
                                            <div class="md12 sm12 xs12 w700" ng-class="ticket.priority_class">{{ticket.priority}}</div>
                                            <div class="md16 sm15 xs14 mt5px xsmt5px w700"><a ng-href="<?= site_url('view-ticket') . "/" ?>{{ticket.id}}" class="link">{{ticket.email}}</a></div>
                                            <div class="md14 sm14 xs14 mt4px xsmt5px">{{ticket.subject}}</div>
                                            <div class="md14 sm14 xs14 mt4px xsmt5px">{{(ticket.created)*1000 | date : "MMM d, y" }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="ng-cloak" ng-hide="recent_tickets_load == 1 && recent_tickets.length > 0">
                                        <img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-responsive  mt6 xsmt6">
                                        <div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Record Found</div>
                                    </div>
                                    
                                    <div ng-show="recent_tickets_load == 0" class="ng-cloak">
                                        <img src="<?php echo $assetsFolder; ?>images/preloader.gif" class="img-responsive ">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div> -->
    <!-- Recently Customer Tickets Section Ends-->

    <!-- </div>
            </div> -->
    <!-- Third Section Starts-->


    <!-- <div class="col-xs-12 mt30px xsmt25px padding0">
                <div class="row">

                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-xs-12 recentprosec">
                            <div class="row">

                                <div class="col-xs-12 padding0">
                                    <ul class="nav nav-tabs producttabs lg18 md16 sm15 xs14 w700">
                                        <li class="active"><a href="#producttab" data-toggle="tab" aria-expanded="true">
                                                Top Selling Courses</a>
                                            <img src="<?php echo $assetsFolder; ?>images/partition.png" class=" img-responsive partitionimg">
                                        </li>
                                        <li><a href="#articletab" data-toggle="tab" aria-expanded="false">
                                                Most Viewed Articles</a></li>
                                    </ul>
                                </div>

                                <div class="col-xs-12 tab-content mt14px xsmt15px padding0">


                                    <div class="col-xs-12 tab-pane active" id="producttab">
                                        <div class="col-xs-12 mCustomScrollbar mCustomScrollbarprotabs darkscroll">
                                            <div class="col-xs-12 padding0 mt5px xsmt5px proborder">

                                                <div class="ng-cloak" ng-show="top_sale_products_load == 1 && top_sale_products.length > 0">
                                                    <div class="col-xs-12 padding0 mb30px xsmb25px" ng-repeat="product in top_sale_products">
                                                        <div class="col-md-2 col-sm-2 col-xs-12 padding0">
                                                            <img ng-src="{{product.image}}" class="img-responsive productboximg">

                                                        </div>
                                                        <div class="col-md-8 col-sm-8 col-xs-9 mt5 xsmt20px smtp6 xspadding0">
                                                            <div class="lg14 md14 sm14 xs14 w700 text-ellipsis" title="YouTube Marketing 2018">{{product.title}} </div>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-xs-3 lg22 md20 sm18 xs16 w700 mt25px xsmt20px pl0 text-center">
                                                            ${{product.price}}</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="ng-cloak" ng-hide="top_sale_products_load == 1 && top_sale_products.length > 0">
                                                    <img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-responsive  mt6 xsmt6">
                                                    <div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Record Found</div>
                                                </div>
                                                
                                                <div ng-show="top_sale_products_load == 0" class="ng-cloak">
                                                    <img src="<?php echo $assetsFolder; ?>images/preloader.gif" class="img-responsive ">
                                                </div>


                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-xs-12 tab-pane" id="articletab">
                                        <div class="col-xs-12 mCustomScrollbar mCustomScrollbarprotabs darkscroll">
                                            <div class="col-xs-12 padding0 mt5px xsmt5px proborder">
                                                <?php
                                                if (count($top_article) > 0) {
                                                    foreach ($top_article as $val) {
                                                ?>

                                                        <div class="col-xs-12 padding0 mb30px xsmb25px">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 padding0">
                                                                <div class="articleimg">
                                                                    <?php if ($val['image'] != '') { ?>
                                                                        <img src="<?= $val['image'] ?>" class="img-responsive">
                                                                    <?php } else { ?>
                                                                        <img src="<?php echo $assetsPath; ?>front_end/images/default-blog.png" class="img-responsive">
                                                                    <?php } ?>

                                                                </div></div>
                                                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 mt26px xsmt20px smt15px xspl0 articletext">
                                                                <div class="lg14 md14 sm14 xs14 w700"><?php echo $val['title']; ?></div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                } else {
                                                        ?>
                                                    
                                                    <img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-responsive  mt6 xsmt6">
                                                    <div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Record Found</div>
                                                    
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                    <?php

                    $this->user_id = $this->session->userdata('logged_in')['id'];

                    $this->owner_id = $this->session->userdata('logged_in')['owner_id'];

                    if ($this->user_id == $this->owner_id) {

                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12 mt0px xsmt20px text-center">
                        <div class="graphsection affiliatebox">
                            <img src="<?php echo $assetsFolder; ?>images/affiliateimg.png" class="img-responsive  mt20 xsmt15">
                            <div class="md23 sm21 xs21 mt22px xsmt20px w700">Thank You For Purchasing aimentorpro</div>
                            <?php if (in_array(12, $purchase_plan_ids)  || in_array(13, $purchase_plan_ids)) {  ?>
                           <a href="https://www.aimentorpro.com/thankyou-reseller/"><div class="md14 sm14 xs14 mt1px xsmt5px">  Click here to get your affiliate link </div></a>
                            <?php } else { ?>

                            <div class="md14 sm14 xs14 mt25px xsmt10px mb20px xsmb30px"><a href="<?= site_url('subscription') ?>" class="imsite-btn autobtn">Manage Your Subscription</a></div>
                            <?php } ?>
                        </div>
                    </div>

<?php } ?>

                </div>
            </div> -->


    <!--             
            <div class="col-xs-12 mt30px xsmt25px graphsection linkssection">
                <div class="row">

                    <div class="col-xs-12 lg18 md16 sm16 xs17 w700 lh100">Quick Links</div>

                    <div class="col-xs-12 mt30px xsmt25px mb5px xsmb0">
                        <div class="row">
							<?php if ($buy_show == "true") {                                        ?>
                            <div class="col-md-2 col-sm-4 col-xs-12 text-center">
                                <a href="https://www.aimentorpro.com/premium-membership">
                                    <div class="qlinks md27 sm35 xs30"><i class="icon icon-products"></i></div>
                                    <div class="md14 sm14 xs14 mt10px xsmt10px qlinks-color">Buy New Course</div>
                                </a>
                            </div>							<?php } ?>

                            <div class="col-md-2 col-sm-4 col-xs-12 text-center mt0 xsmt20px">
                                <a href="<?= site_url('add-new-article') ?>">
                                    <div class="qlinks md27 sm35 xs30"><i class="icon icon-blog"></i></div>
                                    <div class="md14 sm14 xs14 mt10px xsmt10px qlinks-color">Add Article</div>
                                </a>
                            </div>

                            <div class="col-md-2 col-sm-4 col-xs-12 text-center mt0 xsmt20px">
                                <a href="<?= site_url('all-tickets') ?>">
                                    <div class="qlinks md27 sm35 xs30"><i class="icon icon-tickets"></i></div>
                                    <div class="md14 sm14 xs14 mt10px xsmt10px qlinks-color">Tickets</div>
                                </a>
                            </div>

                            <div class="col-md-2 col-sm-4 col-xs-12 text-center mt0 xsmt20px smmt15px">
                                <a href="<?= site_url('training') ?>">
                                    <div class="qlinks md27 sm35 xs30"><i class="icon icon-help"></i></div>
                                    <div class="md14 sm14 xs14 mt10px xsmt10px qlinks-color">Help</div>
                                </a>
                            </div>

                            <div class="col-md-2 col-sm-4 col-xs-12 text-center mt0 xsmt20px smmt15px">
                                <a href="<?= site_url('subscription') ?>">
                                    <div class="qlinks md27 sm35 xs30"><i class="icon icon-subscription"></i></div>
                                    <div class="md14 sm14 xs14 mt10px xsmt10px qlinks-color">Subscription</div>
                                </a>
                            </div>

                            <div class="col-md-2 col-sm-4 col-xs-12 text-center mt0 xsmt20px smmt15px">
                                <a href="<?= site_url('stats-overview') ?>">
                                    <div class="qlinks md27 sm35 xs30"><i class="icon icon-reports"></i></div>
                                    <div class="md14 sm14 xs14 mt10px xsmt10px qlinks-color">Reports</div>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div> -->


    <!-- </div> -->
</div>
</div>
<!-- Page Content End -->


<script>
    $(function() {
        $('.link-card')
            .on('mouseenter', function(e) {
                var parentOffset = $(this).offset(),
                    relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                $(this).find('span').css({
                    top: relY,
                    left: relX
                })
            })
            .on('mouseout', function(e) {
                var parentOffset = $(this).offset(),
                    relX = e.pageX - parentOffset.left,
                    relY = e.pageY - parentOffset.top;
                $(this).find('span').css({
                    top: relY,
                    left: relX
                })
            });
    });
</script>

<!-- Script for Show/Hide Date Dropdown -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".linegraph1").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".lgraphshow1").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".lgraphshow1").hide();
                }
            });
        }).change();
    });
</script>

<!-- Single Calendar -->
<script>
    // $('.single-calander').daterangepicker({
    //     "singleDatePicker": true,
    //     "startDate": "<?php echo date('m/d/Y'); ?>",
    //     "endDate": "<?php echo date('m/d/Y', strtotime("+1 month")); ?>",
    //     "minDate": "<?= $min_date ?>"
    // }, function (start, end, label) {
    //     console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    // });

    $('.graphFromDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": "<?php echo date('m/d/Y'); ?>",
        "endDate": "<?php echo date('m/d/Y', strtotime("+1 month")); ?>",
        //"minDate": "<?= $min_date ?>",
        "maxDate": "<?= $min_date ?>"
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('.graphToDate').daterangepicker({
        "singleDatePicker": true,
        "startDate": "<?php echo date('m/d/Y'); ?>",
        "endDate": "<?php echo date('m/d/Y', strtotime("+1 month")); ?>",
        "maxDate": "<?= $min_date ?>"
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
</script>
<script>
    var app = angular.module('myApp', []);
    app.controller('customersCtrl', function($scope, $http) {
        $scope.recent_sold_products_load = 0;
        $scope.recent_tickets_load = 0;
        $scope.top_sale_products_load = 0;
        $scope.recent_sold_products = [];
        $scope.recent_tickets = [];
        get_recent_sold_products();
        get_recent_tickets();
        get_top_sales_products();

        function get_recent_sold_products() {
            $http({
                url: "<?php echo site_url('get-recent-sold-products-json'); ?>",
                method: "POST",
                data: $.param({
                    limit: 10
                }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
            }).then(function(response) {
                $scope.recent_sold_products = response.data.recent_sold_products;
                $scope.recent_sold_products_load = $scope.recent_sold_products.length > 0 ? 1 : 2;
            });
        }

        function get_recent_tickets() {
            $http({
                url: "<?php echo site_url('get-recent-tickets-json'); ?>",
                method: "POST",
                data: $.param({
                    limit: 10
                }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
            }).then(function(response) {
                $scope.recent_tickets = response.data.recent_tickets;
                angular.forEach($scope.recent_tickets, function(ticket) {
                    if (ticket.priority == 'urgent') {
                        ticket.priority_class = 'urgentbox';
                    } else if (ticket.priority == 'high') {
                        ticket.priority_class = 'highbox';
                    } else if (ticket.priority == 'low') {
                        ticket.priority_class = 'lowbox';
                    } else {
                        ticket.priority_class = 'mediumbox';
                    }
                });
                $scope.recent_tickets_load = ($scope.recent_tickets.length > 0) ? 1 : 2;
            });

        }

        function get_top_sales_products() {
            $http({
                url: "<?php echo site_url('get-top-sale-products-json'); ?>",
                method: "POST",
                data: $.param({
                    limit: 10
                }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
            }).then(function(response) {
                $scope.top_sale_products = response.data.top_sale_products;
                $scope.top_sale_products_load = $scope.top_sale_products.length > 0 ? 1 : 2;
            });
        }
    });
</script>

<script src="<?php echo $this->config->item("assetsTemplatePath") . 'js/graphJS.js'; ?>"></script>