<?php
$url_list = array(
    'dashboard',
    'conversation',
    'conversation-media',
    'my-conversations',
    'whitelabel',
    'whitelabel-setting',
    'virtual-assistant',
    'virtual-assistant/create',
    'virtual-assistant/list',
    "virtual-assistant-v1/create",
    "virtual-assistant-v1/overview_chatbot",
    "virtual-assistant-v1/list",
    'integration',
    'autoresponder-lead-list',
    'settings',
    'create-talk',
    'text-to-audio',
    'my-assets',
    'templates',
    'my_templates',
    "sets-list",
    "text-to-video",
    "create-newapp",
    "edit-app",
    "create-sets",
    "update-set",
    "getapp-response-list",
    "visitor-feedback-list",
    "video_script",
    "inkflow-video-setup",
    "quiz",
    "inkflow-ebook",
    "research",
    "inkflow-video-update",
    "test-avatar",
    "avtar-create",
    "video",
    "video-editor",
    "video-editor-list",
    "youtube-v2-list",
    "youtube-v2-auto-comment",
    "default-template",
    "youtube-publisher",
    "talking-avatars",
    "upload-youtube-video",
    "insta-auto-reply",
    "upload-insta-video",
    "insta-publisher",
    "agency-product",
    "automation",
    "generate-hastag",
    "post-generator",
    "analyz",
    "analyz-data",
    "ai-query",
    "competitor-spy",
    "business-list",
    // "youtube"
);


$currentpage = '';
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
foreach ($url_list as $url_slug) {
    if (strpos($url, $url_slug) !== false) {
        $currentpage = $url_slug;
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= $assetsPath ?>images/Ai-Employee-Favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/bootstrap-select.min.css">

    <!-- Animate style Css -->
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/animate.css">
    <!-- Animate style Css -->

    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/general.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/icomoon.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/header.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/layout.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/anam.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/table-css.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/enjoyhint.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/pnotify.custom.min.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/smart_wizard_all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assetsPath') ?>css/jquery.datetimepicker.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('assetsPath') ?>css/daterangepicker.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('assetsPath') ?>css/swiper-bundle-min.css" />
    <link href="<?php echo $assetsPath; ?>/default/plugins/summernote/summernote-lite.min.css" rel="stylesheet">

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">-->
    <!-- Common files -->

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/jquery.min.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/apexcharts.js"></script>
    <script src="<?= $this->config->item('assetsPath') ?>js/angular.min.js"></script>

    <script type='text/javascript' src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.js" integrity="sha512-klc+qN5PPscoGxSzFpetVsCr9sryi2e2vHwZKq43FdFyhSAa7vAqog/Ifl8tzg/8mBZiG2MAKhyjH5oPJp65EA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

    <!-- Datepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Animate style JS -->
    <script src="<?= $this->config->item('assetsPath') ?>js/wow.js"></script>
    <!-- Animate style JS -->

    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/basic.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/pnotify.custom.min.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/bootstrap.bundle.min.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/bootstrap-select.min.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/jquery.tagsinput.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/jquery.smartWizard.min.js"></script>

    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/script.js"></script>

    <!-- Common files End -->

    <!--font awesome css start-->
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>fonts/fontawesome/css/brands.css">
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>fonts/fontawesome/css/solid.css">
    <!--font awesome css end-->

    <!--font awesome Pro Icon Strat-->
    <script src="https://kit.fontawesome.com/f2a58feab5.js" crossorigin="anonymous"></script>
    <!--font awesome Pro Icon end-->


    <!-- Custom Scrollbar File -->
    <script type='text/javascript'
        src="<?= $this->config->item('assetsPath') ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $this->config->item('assetsPath') ?>js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('assetsPath') ?>js/daterangepicker.min.js"
        type="text/javascript"></script>
    <script src="<?php echo $this->config->item('assetsPath') ?>js/jquery.datetimepicker.js"
        type="text/javascript"></script>
    <script src="<?php echo $this->config->item('assetsPath') ?>js/jquery.magnific-popup.min.js"
        type="text/javascript"></script>

    <script type='text/javascript' src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type='text/javascript'
        src="<?php echo $this->config->item('assetsPath') ?>js/dataTables.bootstrap5.min.js"></script>
    <script type='text/javascript'
        src="<?php echo $this->config->item('assetsPath') ?>js/swiper-bundle-min.js"></script>
    <!-- Summer Note Js  -->
    <script src="<?php echo $assetsPath; ?>/default/plugins/summernote/summernote-lite.min.js"></script>
    <!-- SweetAlert library -->
    <!-- <script src="https://cdn.gtranslate.net/widgets/latest/dwf.js" defer></script>  -->
    <!--<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>-->
    <script src="https://sels.aicademy.live/app/assets/default/js/enjoyhint.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        ul.sub-child {
            background-color: var(--theme-bg);
            border-radius: 5px;
        }

        .dropdown-fontsize {
            overflow-y: auto;
            max-height: 200px;
        }

        .templates-card .meta,
        .image-box-wrapper .meta {
            z-index: 700 !important;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        ul.sub-child li.nav-item {
            margin-bottom: 0px;
        }

        .sidebar-menu ul li ul.sub-child li.nav-item a {
            padding: 7px;
            min-height: 40px;
        }

        .ai_response_contents {
            background: var(--body-bg);
        }

        .sn-checkbox-use-protocol {
            display: none !important;
        }

        .sidebar-menu ul li ul.sub-child li.nav-item a span.menu-title {
            font-size: 14px;
        }

        .tabs-banner {
            background: var(--theme-bg2) !important;
        }

        .btns-side i {
            cursor: pointer;
        }

        .theme-btn-blue {
            color: var(--text-light) !important;
        }

        ul.sub-child.dropOn {
            opacity: 1;
            height: 80px;
        }

        .note-editable {
            white-space: pre-wrap;
        }

        i {
            background: transparent !important
        }

        ul.sub-child {
            background-color: var(--theme-bg);
            opacity: 0;
            transition: 0.3s ease;
            /*display: none;*/
            height: 0px;
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child a.nav-link {
            font-weight: 600;
            border-radius: 5px;
            color: var(--black-color);
            background: transparent;
            border: none;
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child a.nav-link:hover {
            background: var(--theme-bg);
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child a.nav-link .size-icon {
            color: var(--white-color);
        }

        .switch-business {
            /*background: var(--theme-color) !important;*/
            padding: 10px;
            padding: 10px 10px 10px 20px;
            border-radius: 5px !important;
            border: 1px solid var(--theme-br);
            !important;
        }

        ul.switch-business {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            max-width: 200px;
            max-height: 265px;
            justify-content: center;
        }

        ul.switch-business li.profile {
            flex: 1;
        }

        ul.switch-business>li {
            list-style: none;
            padding-left: 8px;
            padding-right: 8px;
            position: relative;
        }

        /* @media (max-width:1380px) {
            .under-sub-menu {
                height: 60% !important;
                overflow-y: auto;
            }
        } */

        @media (min-width:768px) {
            ul.switch-business {
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
            }

            ul.switch-business>li {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        ul.switch-business>li:before {
            content: " ";
            position: absolute;
            top: 50%;
            left: 0px;
            transform: translatey(-50%);
            width: 1px;
            height: 25px;
            background: var(--secondary-color2);
        }

        ul.switch-business>li:first-child:before {
            display: none;
        }

        ul.switch-business>li:last-child {
            border: none;
            padding-right: 0px;
        }

        ul.switch-business>li:first-child {
            border: none;
            padding-left: 0px;
        }

        .switch-business .profile .dropdown-menu.show {
            max-height: unset;
        }

        .switch-business .profile ul.prot-drop-list {
            max-height: 170px !important;
            overflow-y: auto;
            padding-left: 0;
        }

        .switch-business .profile ul.prot-drop-list li {
            list-style: none;
        }

        .rotate {
            -moz-transition: all 2s linear;
            -webkit-transition: all 2s linear;
            transition: all 2s linear;
        }

        .rotate.down {
            -moz-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        span.icon-dropdown.rotate {
            transition: all 0.3s ease !important;
        }

        .rotate1 span::before {
            -moz-transition: all 0.4s linear;
            -webkit-transition: all 0.4s linear;
            transition: all 0.4s linear;
            display: inline-block;
            -moz-transform: rotate(0);
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }

        .rotate1.down span::before {
            -moz-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        span.icon-dropdown.rotate1 {
            transition: all 0.3s ease !important;
        }

        span.icon-close1.rotate1 {
            transition: all 0.3s ease !important;
        }


        ul.sub-child1 {
            background-color: var(--theme-bg);
            border-radius: 5px;
        }

        ul.sub-child1 li.nav-item {
            margin-bottom: 0px;
        }

        .sidebar-menu ul li ul.sub-child1 li.nav-item a {
            padding: 7px;
            min-height: 40px;
        }

        .sidebar-menu ul li ul.sub-child1 li.nav-item a span.menu-title {
            font-size: 14px;
        }

        ul.sub-child1.dropOn {
            opacity: 1;
            height: 80px;
        }

        ul.sub-child1 {
            background-color: var(--theme-bg);
            opacity: 0;
            transition: 0.3s ease;
            /*display: none;*/
            height: 0px;
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child1 a.nav-link {
            font-weight: 600;
            border-radius: 0px;
            color: var(--black-color);
            background: transparent;
            border: none;
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child1 a.nav-link .size-icon {
            color: var(--white-color);
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child1 a.nav-link:hover {
            background: var(--theme-br);
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child1 a.nav-link:focus {
            border-left: 3px solid var(--primary-color);
        }

        .sidebar-menu ul li.nav-item.active ul.sub-child1 a.nav-link .size-icon:focus {
            color: var(--primary-color);
        }

        .rotate-new {
            -moz-transition: all 2s linear;
            -webkit-transition: all 2s linear;
            transition: all 2s linear;
        }

        .rotate-new.down {
            -moz-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        span.icon-dropdown.rotate-new {
            transition: all 0.3s ease !important;
        }

        .rotate-new1 {
            -moz-transition: all 2s linear;
            -webkit-transition: all 2s linear;
            transition: all 2s linear;
        }

        .rotate-new1.down {
            -moz-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        span.icon-dropdown.rotate-new1 {
            transition: all 0.3s ease !important;
        }

        /*button.btn.right-btn{  */
        /*    background: var(--primary-color);*/
        /*    top:9%; */
        /*    position: relative; */
        /*    left:96%;*/
        /*}*/
        button.btn.right-btn {
            background: var(--primary-color);
            top: 60px;
            position: fixed;
            right: 10px;
        }

        .right-btn {
            position: absolute;
            right: 0px;
            background: var(--primary-color);
            border: 0px;
            color: #fff;
            z-index: 9999;
        }

        .right-sidebar {
            padding: 5px 20px 5px 20px;
            z-index: 1;
            margin: 0;
        }

        .right-sidebar {
            position: fixed;
            right: -100%;
            transition: 0.5s;
            top: 14%;
            z-index: 999;
            max-width: 350px;
            background-color: rgb(37 39 46);
            border-radius: 5px;
        }

        .right-sidebar.slideOn {
            right: 0;
        }

        .credits-count {
            background: #01010121;
            color: var(--tertiary-color);
            font-size: 11px;
            border-radius: 50px;
        }

        .container-padding {
            min-height: 90vh;
        }

        .form_error * {
            color: #dc3545;
        }


        /* // Panels */

        .panel-variant {
            border-color: var(--theme-br);
        }

        .panel-variant>.panel-heading {
            color: var(--theme-color);
            background-color: var(--theme-bg);
            border-color: var(--theme-br);
        }

        .panel-variant>.panel-heading+.panel-collapse>.panel-body {
            border-top-color: var(--theme-br);
        }

        .note-btn-group.note-color.open .note-dropdown-menu {
            display: flex;
        }

        .table.inserting-selected-checkbox img {
            background: transparent !important;
        }
    </style>


    <style>
        .businessDropDown {
            overflow: hidden !important;
            inset: 0px auto auto -50px !important;
            position: absolute !important;
            margin: 0px !important;
        }

        .sidebar-menu ul li a.nav-link {
            transition: all 0.3s ease !important;
        }
    </style>

    <script>
        jQuery(document).ready(function ($) {
            $('.target_share').on('click', function (e) {
                e.stopPropagation();
                $(this).find('.my_target').toggle()
            });
            $('.from_date').datetimepicker({
                format: 'd/m/Y',
                timepicker: false,
                lang: 'en',
            });

            $('.to_date').datetimepicker({
                format: 'd/m/Y',
                timepicker: false,
                lang: 'en',
            });
            $('.start_date').datetimepicker({
                format: 'Y-m-d H:i:s',
                timepicker: true,
                lang: 'en',
            });

            $('.timepicker').datetimepicker({
                format: 'H:i',
                timepicker: true,
                datepicker: false,
                lang: 'en',
            });
        });

        $(document).ready(function () {


            <?php

            if (isset($flashdata)) {

                echo "showFlash(" . $flashdata . ");";
            }

            // if(!empty($this->session->userdata('message')) || !empty($this->session->flashdata('message')))
            // {
            //     pr($this->session->userdata());
            //     pr($this->session->userdata('message'));
            //     pr($this->session->flashdata('message'));
            //     die;
            // }
            
            if ($flashdata = $this->session->userdata('message')) {

                //$flashdata = $this->session->flashdata('message');
            
                echo "showFlash(" . $flashdata . ");";

                $this->session->unset_userdata('message');
            } elseif ($flashdata = $this->session->flashdata('message')) {

                //$flashdata = $this->session->flashdata('message');
            
                echo "showFlash(" . $flashdata . ");";
            }

            echo "\n";

            ?>

        });
    </script>
    <style>
        [ng\:cloak],
        [ng-cloak],
        [data-ng-cloak],
        [x-ng-cloak],
        .ng-cloak,
        .x-ng-cloak {
            display: none !important;
        }

        a.listdisabled {
            pointer-events: none;
            cursor: default;
        }

        .cke_contents {
            height: 400px !important;
        }

        @media (max-width:767px) {
            .profile {
                gap: 10px !important;
            }
        }

        .form_error {
            color: red;
        }

        li.top-right-coins {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            min-width: 175px;
            max-height: 282px;
            justify-content: center;
        }

        .top-right-coins {
            background: var(--theme-color);
            border-radius: 10px;
            padding: 10px 10px 10px 20px;
            color: var(white-color);
            border: 1px solid var(--theme);
        }

        .coins {
            color: #fff;
        }

        .switch-header {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
        }

        /* Hide default HTML checkbox */
        .switch-header input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider-header {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider-header:before {
            position: absolute;
            content: "";
            height: 17px;
            width: 17px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider-header {
            background: radial-gradient(100% 100% at 50.00% 0%, #AA70ED 0%, #5340D7 100%);
        }

        input:focus+.slider-header {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider-header:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider-header.round {
            border-radius: 34px;
        }

        .slider-header.round:before {
            border-radius: 50%;
        }

        .logo-img:hover {
            content: "\e90a";
            font-size: 40px;
            position: absolute;
            align-items: center;
            color: rgb(255, 255, 255);
            justify-content: center;
            display: flex !important;
            background: rgba(0, 0, 0, 0.8);
        }

        .switch-business {
            padding: 10px 10px 10px 20px;
            border-radius: 10px;
        }

        ul.switch-business {
            padding: 4px 10px;
        }

        @media (min-width: 768px) {
            ul.switch-business {
                padding: 4px 10px;
            }
        }

        .profile-pic.rotate1 {
            transition: all 0.3s ease !important;
        }

        .nav-item input {
            background: transparent;
            border: none;
            color: var(--grey-color);
            padding: 0;
            width: 100%;
            text-align: start;
        }

        .nav-item.active input {
            color: var(--white-color);
        }

        .nav-item input:hover {
            background: transparent;
            border: none;
            color: var(--white-color);
            font-size: 14px;
            padding: 0;
        }

        /* .nav-item input:focus {
            background: transparent;
            border: none;
            color: var(--white-color);
            font-size: 16px;
            font-weight: 600;
            padding: 0;
        } */


        /* .gt_switcher_wrapper {
          position: relative !important;
          top: unset !important;
          right: unset !important;
        }
        .gt_option{
              position: absolute!important;
              top: 40px;
              left: -15px!important;
        }
        .gt_switcher_wrapper .gt_switcher{
            width: 80px!important;    
        }
       
        .gt_option{
          background: var(--theme-br) !important;
          color: rgb(0, 0, 0) !important;
          padding: 10px;
          border-radius: 5px;
          width: 100% !important;
          left: 0px;
        }
        .gt_container--hich1m .gt_switcher .gt_selected a{
            width: 100%!important;
        }
        .gt_option a {
            color: #fff!important;
        }
         */
        .aigptnew {
            position: relative;
            padding: 10px 30px 10px 20px;
        }

        .aigptnew::after {
            content: "NEW";
            animation: changeBackgroundColor 0.5s infinite;
            color: #fff;
            font-size: 10px;
            padding: 2px 6px;
            position: absolute;
            right: 0px;
            line-height: normal;
            font-weight: 500;
            top: 0px;
            box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.25);
            border-radius: 0 10px;
        }

        @keyframes changeBackgroundColor {
            0% {
                background-color: red;
            }

            50% {
                background-color: blue;
            }

            100% {
                background-color: red;
            }
        }

        #dashboardModal.show {
            display: flex !important;
        }

        .top-nav ul {
            display: flex;
            list-style: none;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: #fff;
            position: relative;
            z-index: 1000;
            column-gap: 10px;
        }

        .top-nav ul li a {
            flex-direction: column;
            background: transparent;
            color: #8A8B91;
            padding: 10px 20px !important;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
            font-weight: 600;

        }

        .top-nav ul .nav-item.active a {
            background: var(--primary-color) !important;
            color: #191919;
        }

        /* .dark-switch{
    color: var(--theme-color);
    font-size: 1.2rem;
} */

        /* .form-control.search:focus {
            border: none !important;
            background: transparent !important;
        } */

        /* ::-webkit-scrollbar{
        width: 8px !important;
    } */


        .gt_float_switcher {
            font-size: 14px !important;
        }

        .gt_float_switcher img {
            width: 20px !important;
        }

        .gtranslate_wrapper * {
            border-radius: 5px !important;
        }

        .gt_float_switcher .gt_options a {
            border-radius: 0px !important;
            transition: 0.3s !important;
        }

        .gt_float_switcher .gt_options a:hover {
            background: var(--primary-color) !important;
        }
    </style>
</head>

<body>
    <div class="gtranslate_wrapper ms-auto"></div>
    <?php if (!empty($this->session->userdata('logged_in'))){?>
    <header class="header-fixed justify-content-end d-lg-none shadow-none" style="background: transparent">

        <div class="d-flex align-items-center">
            <div class="d-lg-none">
                <input type="checkbox" id="side-nav-toggles">
                <label class="hamburger side-nav-toggles" for="side-nav-toggles">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </label>
            </div>

            <div class="d-none">
                <a href="<?php echo base_url('dashboard'); ?>">
                    <img src="<?php echo $web_logo; ?>" class="img-fluid logo-height"
                        style="max-width: 90% !important;" />
                </a>
            </div>


        </div>

        <!-- Nav Menu Items Start -->
        <div class="header-nav top-nav d-md-none d-none">
            <ul>
                <li class="nav-item <?php
                if ($currentpage == "dashboard") {
                    echo "active";
                }
                ?>">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link" id="dashboard">
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?php
                if ($currentpage == "virtual-assistant-v1/createt") {
                    echo "active";
                }
                ?>">
                    <a href="<?= base_url('virtual-assistant-v1/create'); ?>" class="nav-link" id="letswork">
                        <span class="menu-title">ChatBot</span>
                    </a>
                </li>
                <li class="nav-item rotate-new <?php
                if ($currentpage == "autoresponder-lead-list" || $currentpage == "autoresponder-lead-list") {
                    echo "active";
                }
                ?>">
                    <a href="<?= base_url('autoresponder-lead-list'); ?>" class="nav-link" id="aiTemplateEditor">
                        <span class="menu-title">Leads</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Nav Menu Items End -->

        <ul class="top-right-items d-none" style="margin-right: 40px;">
            <li class="profile me-5 me-md-0 pe-5">

                <!--<div id="google_translate_element"></div>-->
            </li>
            <!--<div style="margin-right:30px;">-->
            <!--    <label class="switch-header">-->
            <!--      <input type="checkbox" onclick="onClickHandler()" id="" value="0">-->
            <!--      <span class="slider-header round"></span>-->
            <!--    </label>-->
            <!--</div>-->
            <!-- <div class="switch-business d-none aigptnew  align-items-center justify-content-center theme-btn-transparant gtranslate_wrapper"></div> -->

            <li class="top-right-coins d-none " id="coins" data-toggle="tooltip" data-placement="bottom"
                title="&emsp;  1 Credit = 50 Character &emsp; &nbsp;">
                <div class="user-name d-none d-md-flex ">
                    <form action="<?php echo base_url('integration') ?>" method="post">
                        <input type="hidden" name="active_tab" value="contentprovider" />
                        <button type="submit"
                            style="background: transparent;text-decoration: none; border: none; margin-top:11px; color:var(--white-color);">
                            <!--<a href="#" >-->
                            <i class='icon-credit-left' style="line-height:1.5"></i> &nbsp; Credit Left &nbsp;
                            <span class="credits-count"></span>
                            <!--</a>-->
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </header>
    <?php }?>
    <?php if (!empty($this->session->userdata('logged_in'))){?>    
    <!-- Sidebar Start -->
    <div class="sidebar sidebar-show">
        <a href="javascript:void(0)" class="toggle-sidebar d-none"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="sidebar-menu" data-mcs-theme="inset-3" id="left-nav">
            <div class="h-100">
                <div class="header-logo-parent">
                    <a href="<?php echo base_url('dashboard'); ?>">
                        <img src="<?php echo $web_logo; ?>" />
                        <!-- <img src="<?php echo $this->config->item('assetsPath') ?>images/db-logo.png" alt="DB Logo"> -->
                    </a>
                </div>
                <ul class="outer-sub-menu">
                    <div class="nav-item">
                        <ul class="switch-business p-0 m-auto">
                            <li class="profile style-3 position-static">
                                <a href="#" class="dropdown-toggle w-100 profile-pic rotate1" id="headerDrop"
                                    data-bs-toggle="dropdown">
                                    <div
                                        class="actice-profile d-flex align-items-center gap-1 justify-content-center w-100">
                                        <div class="icon-logo">
                                            <img id="workspace"
                                                src="<?= ($this->session->userdata('business')['logo'] == '' || $this->session->userdata('business')['logo'] == 'default_business_logo.png') ? $uploadPath . 'default_images/default_business_logo.png' : $this->config->item('bucket_url') . $this->session->userdata('business')['logo'] ?>"
                                                class="img-fluid">
                                            <?php
                                            $strcount = strlen($current_subdomain);
                                            if ($strcount > 10) {
                                                $current_subdomain = substr($current_subdomain, 0, 10);
                                            }
                                            ?>
                                        </div>
                                        <div class="user-name d-md-flex"><?= $current_subdomain ?></div>
                                    </div>
                                    <!-- <span class="ms-auto fa-solid text-white fa-angle-right"></span> -->
                                    <a href="#" class=" profile-pic d-none ">
                                        <!-- <span class="fa-solid theme-text-color fa-angle-right"></span> -->
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end animated--grow-in businessDropDown "
                                        aria-labelledby="dropdownMenuButton1"
                                        style="overflow: hidden; inset: 0px auto auto -50px !important;">
                                        <li>
                                            <h6 class="mb-2" style="color: var(--white-color);">Workspace</h6>
                                            <div class="search-bar mb-2">
                                                <input type="text" class="search form-control" id="getBusinesslist"
                                                    placeholder="Search Workspace...">
                                                <div class="search-icon" style="cursor:pointer;"
                                                    onClick="getBusinesslist()">
                                                    <span class="icon-search"></span>
                                                </div>
                                            </div>
                                            <?php
                                            if (!empty($businessList)) { ?>
                                                <ul class="prot-drop-list " id="addBusinesslist">

                                                </ul>
                                            <?php } ?>
                                            <div class="row align-items-center g-2">
                                                <?php if ($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) { ?>
                                                    <div class="col-md-5">
                                                        <a href="#modal" class="btn btn-primary dropdown-item"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"><span
                                                                class="icon-campaign-name"></span> Add</a>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <a class="btn btn-primary dropdown-item"
                                                            href="<?= base_url('workspace'); ?>"> <span
                                                                class="icon-password-view"></span> Manage All</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    </ul>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="under-sub-menu">


                        <li class="nav-item <?php
                        if ($currentpage == "dashboard") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('dashboard'); ?>" class="nav-link hover-shadow" id="dashboard">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_29_2150)">
                                        <path
                                            d="M10.0837 3.66675V7.33342C10.0837 8.06276 9.79393 8.76223 9.2782 9.27796C8.76248 9.79368 8.063 10.0834 7.33366 10.0834H3.66699C2.93765 10.0834 2.23817 9.79368 1.72245 9.27796C1.20672 8.76223 0.916992 8.06276 0.916992 7.33342V3.66675C0.916992 2.9374 1.20672 2.23793 1.72245 1.7222C2.23817 1.20648 2.93765 0.916748 3.66699 0.916748H7.33366C8.063 0.916748 8.76248 1.20648 9.2782 1.7222C9.79393 2.23793 10.0837 2.9374 10.0837 3.66675ZM18.3337 0.916748H14.667C13.9376 0.916748 13.2382 1.20648 12.7224 1.7222C12.2067 2.23793 11.917 2.9374 11.917 3.66675V7.33342C11.917 8.06276 12.2067 8.76223 12.7224 9.27796C13.2382 9.79368 13.9376 10.0834 14.667 10.0834H18.3337C19.063 10.0834 19.7625 9.79368 20.2782 9.27796C20.7939 8.76223 21.0837 8.06276 21.0837 7.33342V3.66675C21.0837 2.9374 20.7939 2.23793 20.2782 1.7222C19.7625 1.20648 19.063 0.916748 18.3337 0.916748ZM7.33366 11.9167H3.66699C2.93765 11.9167 2.23817 12.2065 1.72245 12.7222C1.20672 13.2379 0.916992 13.9374 0.916992 14.6667V18.3334C0.916992 19.0628 1.20672 19.7622 1.72245 20.278C2.23817 20.7937 2.93765 21.0834 3.66699 21.0834H7.33366C8.063 21.0834 8.76248 20.7937 9.2782 20.278C9.79393 19.7622 10.0837 19.0628 10.0837 18.3334V14.6667C10.0837 13.9374 9.79393 13.2379 9.2782 12.7222C8.76248 12.2065 8.063 11.9167 7.33366 11.9167ZM18.3337 11.9167H14.667C13.9376 11.9167 13.2382 12.2065 12.7224 12.7222C12.2067 13.2379 11.917 13.9374 11.917 14.6667V18.3334C11.917 19.0628 12.2067 19.7622 12.7224 20.278C13.2382 20.7937 13.9376 21.0834 14.667 21.0834H18.3337C19.063 21.0834 19.7625 20.7937 20.2782 20.278C20.7939 19.7622 21.0837 19.0628 21.0837 18.3334V14.6667C21.0837 13.9374 20.7939 13.2379 20.2782 12.7222C19.7625 12.2065 19.063 11.9167 18.3337 11.9167Z"
                                            fill="white" fill-opacity="0.9" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_29_2150">
                                            <rect width="22" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item <?php
                        $active_pages = ["post-generator"];
                        if (in_array($currentpage, $active_pages)) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('post-generator'); ?>" class="nav-link hover-shadow" id="letswork">
                                <svg class="size-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1898 12.9213H7.80934C5.1337 13.1657 3.03798 15.415 3.03798 18.1546C3.03798 20.7715 4.95 20.9 7.45404 20.9C7.72728 20.9 8.00734 20.8987 8.29378 20.8987H13.7067C13.9911 20.8987 14.2718 20.9 14.5451 20.9C17.0491 20.9 18.9622 20.7717 18.9622 18.1546C18.9614 15.4147 16.8654 13.1652 14.1898 12.9213Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M11.966 10.2166H12.7703C13.0354 10.2166 13.2876 10.3068 13.4906 10.4674C13.9535 10.4053 14.3906 10.285 14.7695 10.1211C14.8788 9.95919 14.9739 9.78715 15.0614 9.61093V7.85071C15.0614 7.45273 15.2095 7.08203 15.4662 6.79955C15.0911 4.67017 13.2365 3.05141 10.9996 3.05141C8.76326 3.05141 6.90822 4.67039 6.53312 6.79977C6.78964 7.08203 6.93792 7.45273 6.93792 7.85071V9.61093C7.68174 11.1038 9.21888 12.1317 10.9993 12.1317C11.0271 12.1317 11.0539 12.1282 11.0814 12.1275C10.9096 11.9244 10.8018 11.6657 10.8018 11.3797C10.802 10.7384 11.3243 10.2166 11.966 10.2166Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M5.31894 10.8832H5.36976C5.92768 10.8832 6.38044 10.4304 6.38044 9.87053V7.85049C6.38044 7.45361 6.15142 7.11173 5.81812 6.94607C5.96222 4.21257 8.23086 2.03347 10.9993 2.03347C13.7678 2.03347 16.0373 4.21235 16.181 6.94607C15.8477 7.11151 15.6189 7.45361 15.6189 7.85049V9.87053C15.6189 10.0047 15.6451 10.1297 15.6908 10.2467C15.1015 10.6676 14.2441 10.9681 13.2785 11.0513C13.1692 10.8852 12.9829 10.7741 12.7699 10.7741H11.9656C11.6303 10.7741 11.3593 11.0455 11.3593 11.3795C11.3593 11.7139 11.6301 11.9858 11.9656 11.9858H12.7699C13.0042 11.9858 13.204 11.8523 13.3047 11.6587C14.4258 11.5702 15.4007 11.2279 16.0855 10.7217C16.2424 10.8233 16.4285 10.883 16.6294 10.883H16.68C17.2385 10.883 17.6904 10.4302 17.6904 9.87031V7.85027C17.6904 7.44789 17.4546 7.10051 17.1142 6.93925C16.966 3.69557 14.2802 1.10001 10.9996 1.10001C7.71892 1.10001 5.03272 3.69557 4.88554 6.93969C4.54476 7.10073 4.30826 7.44833 4.30826 7.85071V9.87075C4.30826 10.4304 4.76146 10.8832 5.31894 10.8832Z" fill="white" fill-opacity="0.8"/>
                                </svg>
                                <span class="menu-title">View Agent</span>
                            </a>
                        </li>


                        <li class="nav-item <?php
                        $active_pages = ["yt-video-op"];
                        if (in_array($currentpage, $active_pages)) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('yt-video-op'); ?>" class="nav-link hover-shadow" id="letswork">
                                <svg class="size-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1898 12.9213H7.80934C5.1337 13.1657 3.03798 15.415 3.03798 18.1546C3.03798 20.7715 4.95 20.9 7.45404 20.9C7.72728 20.9 8.00734 20.8987 8.29378 20.8987H13.7067C13.9911 20.8987 14.2718 20.9 14.5451 20.9C17.0491 20.9 18.9622 20.7717 18.9622 18.1546C18.9614 15.4147 16.8654 13.1652 14.1898 12.9213Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M11.966 10.2166H12.7703C13.0354 10.2166 13.2876 10.3068 13.4906 10.4674C13.9535 10.4053 14.3906 10.285 14.7695 10.1211C14.8788 9.95919 14.9739 9.78715 15.0614 9.61093V7.85071C15.0614 7.45273 15.2095 7.08203 15.4662 6.79955C15.0911 4.67017 13.2365 3.05141 10.9996 3.05141C8.76326 3.05141 6.90822 4.67039 6.53312 6.79977C6.78964 7.08203 6.93792 7.45273 6.93792 7.85071V9.61093C7.68174 11.1038 9.21888 12.1317 10.9993 12.1317C11.0271 12.1317 11.0539 12.1282 11.0814 12.1275C10.9096 11.9244 10.8018 11.6657 10.8018 11.3797C10.802 10.7384 11.3243 10.2166 11.966 10.2166Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M5.31894 10.8832H5.36976C5.92768 10.8832 6.38044 10.4304 6.38044 9.87053V7.85049C6.38044 7.45361 6.15142 7.11173 5.81812 6.94607C5.96222 4.21257 8.23086 2.03347 10.9993 2.03347C13.7678 2.03347 16.0373 4.21235 16.181 6.94607C15.8477 7.11151 15.6189 7.45361 15.6189 7.85049V9.87053C15.6189 10.0047 15.6451 10.1297 15.6908 10.2467C15.1015 10.6676 14.2441 10.9681 13.2785 11.0513C13.1692 10.8852 12.9829 10.7741 12.7699 10.7741H11.9656C11.6303 10.7741 11.3593 11.0455 11.3593 11.3795C11.3593 11.7139 11.6301 11.9858 11.9656 11.9858H12.7699C13.0042 11.9858 13.204 11.8523 13.3047 11.6587C14.4258 11.5702 15.4007 11.2279 16.0855 10.7217C16.2424 10.8233 16.4285 10.883 16.6294 10.883H16.68C17.2385 10.883 17.6904 10.4302 17.6904 9.87031V7.85027C17.6904 7.44789 17.4546 7.10051 17.1142 6.93925C16.966 3.69557 14.2802 1.10001 10.9996 1.10001C7.71892 1.10001 5.03272 3.69557 4.88554 6.93969C4.54476 7.10073 4.30826 7.44833 4.30826 7.85071V9.87075C4.30826 10.4304 4.76146 10.8832 5.31894 10.8832Z" fill="white" fill-opacity="0.8"/>
                                </svg>
                                <span class="menu-title">Youtube Video Optimisation AI</span>
                            </a>
                        </li>

                       <li class="nav-item <?php
                        $active_pages = ["ai-video-genration"];
                        if (in_array($currentpage, $active_pages)) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('ai-video-genration'); ?>" class="nav-link hover-shadow" id="letswork">
                                <svg class="size-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1898 12.9213H7.80934C5.1337 13.1657 3.03798 15.415 3.03798 18.1546C3.03798 20.7715 4.95 20.9 7.45404 20.9C7.72728 20.9 8.00734 20.8987 8.29378 20.8987H13.7067C13.9911 20.8987 14.2718 20.9 14.5451 20.9C17.0491 20.9 18.9622 20.7717 18.9622 18.1546C18.9614 15.4147 16.8654 13.1652 14.1898 12.9213Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M11.966 10.2166H12.7703C13.0354 10.2166 13.2876 10.3068 13.4906 10.4674C13.9535 10.4053 14.3906 10.285 14.7695 10.1211C14.8788 9.95919 14.9739 9.78715 15.0614 9.61093V7.85071C15.0614 7.45273 15.2095 7.08203 15.4662 6.79955C15.0911 4.67017 13.2365 3.05141 10.9996 3.05141C8.76326 3.05141 6.90822 4.67039 6.53312 6.79977C6.78964 7.08203 6.93792 7.45273 6.93792 7.85071V9.61093C7.68174 11.1038 9.21888 12.1317 10.9993 12.1317C11.0271 12.1317 11.0539 12.1282 11.0814 12.1275C10.9096 11.9244 10.8018 11.6657 10.8018 11.3797C10.802 10.7384 11.3243 10.2166 11.966 10.2166Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M5.31894 10.8832H5.36976C5.92768 10.8832 6.38044 10.4304 6.38044 9.87053V7.85049C6.38044 7.45361 6.15142 7.11173 5.81812 6.94607C5.96222 4.21257 8.23086 2.03347 10.9993 2.03347C13.7678 2.03347 16.0373 4.21235 16.181 6.94607C15.8477 7.11151 15.6189 7.45361 15.6189 7.85049V9.87053C15.6189 10.0047 15.6451 10.1297 15.6908 10.2467C15.1015 10.6676 14.2441 10.9681 13.2785 11.0513C13.1692 10.8852 12.9829 10.7741 12.7699 10.7741H11.9656C11.6303 10.7741 11.3593 11.0455 11.3593 11.3795C11.3593 11.7139 11.6301 11.9858 11.9656 11.9858H12.7699C13.0042 11.9858 13.204 11.8523 13.3047 11.6587C14.4258 11.5702 15.4007 11.2279 16.0855 10.7217C16.2424 10.8233 16.4285 10.883 16.6294 10.883H16.68C17.2385 10.883 17.6904 10.4302 17.6904 9.87031V7.85027C17.6904 7.44789 17.4546 7.10051 17.1142 6.93925C16.966 3.69557 14.2802 1.10001 10.9996 1.10001C7.71892 1.10001 5.03272 3.69557 4.88554 6.93969C4.54476 7.10073 4.30826 7.44833 4.30826 7.85071V9.87075C4.30826 10.4304 4.76146 10.8832 5.31894 10.8832Z" fill="white" fill-opacity="0.8"/>
                                </svg>
                                <span class="menu-title">AI & Avatar Video Generation</span>
                            </a>
                        </li>

                     <li class="nav-item <?php
                        $active_pages = ["ai-query"];
                        if (in_array($currentpage, $active_pages)) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('ai-query'); ?>" class="nav-link hover-shadow" id="letswork">
                                <svg class="size-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1898 12.9213H7.80934C5.1337 13.1657 3.03798 15.415 3.03798 18.1546C3.03798 20.7715 4.95 20.9 7.45404 20.9C7.72728 20.9 8.00734 20.8987 8.29378 20.8987H13.7067C13.9911 20.8987 14.2718 20.9 14.5451 20.9C17.0491 20.9 18.9622 20.7717 18.9622 18.1546C18.9614 15.4147 16.8654 13.1652 14.1898 12.9213Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M11.966 10.2166H12.7703C13.0354 10.2166 13.2876 10.3068 13.4906 10.4674C13.9535 10.4053 14.3906 10.285 14.7695 10.1211C14.8788 9.95919 14.9739 9.78715 15.0614 9.61093V7.85071C15.0614 7.45273 15.2095 7.08203 15.4662 6.79955C15.0911 4.67017 13.2365 3.05141 10.9996 3.05141C8.76326 3.05141 6.90822 4.67039 6.53312 6.79977C6.78964 7.08203 6.93792 7.45273 6.93792 7.85071V9.61093C7.68174 11.1038 9.21888 12.1317 10.9993 12.1317C11.0271 12.1317 11.0539 12.1282 11.0814 12.1275C10.9096 11.9244 10.8018 11.6657 10.8018 11.3797C10.802 10.7384 11.3243 10.2166 11.966 10.2166Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M5.31894 10.8832H5.36976C5.92768 10.8832 6.38044 10.4304 6.38044 9.87053V7.85049C6.38044 7.45361 6.15142 7.11173 5.81812 6.94607C5.96222 4.21257 8.23086 2.03347 10.9993 2.03347C13.7678 2.03347 16.0373 4.21235 16.181 6.94607C15.8477 7.11151 15.6189 7.45361 15.6189 7.85049V9.87053C15.6189 10.0047 15.6451 10.1297 15.6908 10.2467C15.1015 10.6676 14.2441 10.9681 13.2785 11.0513C13.1692 10.8852 12.9829 10.7741 12.7699 10.7741H11.9656C11.6303 10.7741 11.3593 11.0455 11.3593 11.3795C11.3593 11.7139 11.6301 11.9858 11.9656 11.9858H12.7699C13.0042 11.9858 13.204 11.8523 13.3047 11.6587C14.4258 11.5702 15.4007 11.2279 16.0855 10.7217C16.2424 10.8233 16.4285 10.883 16.6294 10.883H16.68C17.2385 10.883 17.6904 10.4302 17.6904 9.87031V7.85027C17.6904 7.44789 17.4546 7.10051 17.1142 6.93925C16.966 3.69557 14.2802 1.10001 10.9996 1.10001C7.71892 1.10001 5.03272 3.69557 4.88554 6.93969C4.54476 7.10073 4.30826 7.44833 4.30826 7.85071V9.87075C4.30826 10.4304 4.76146 10.8832 5.31894 10.8832Z" fill="white" fill-opacity="0.8"/>
                                </svg>
                                <span class="menu-title">AI Query</span>
                            </a>
                        </li>

 <li class="nav-item <?php
                        $active_pages = ["competitor-spy"];
                        if (in_array($currentpage, $active_pages)) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('competitor-spy'); ?>" class="nav-link hover-shadow" id="letswork">
                                <svg class="size-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1898 12.9213H7.80934C5.1337 13.1657 3.03798 15.415 3.03798 18.1546C3.03798 20.7715 4.95 20.9 7.45404 20.9C7.72728 20.9 8.00734 20.8987 8.29378 20.8987H13.7067C13.9911 20.8987 14.2718 20.9 14.5451 20.9C17.0491 20.9 18.9622 20.7717 18.9622 18.1546C18.9614 15.4147 16.8654 13.1652 14.1898 12.9213Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M11.966 10.2166H12.7703C13.0354 10.2166 13.2876 10.3068 13.4906 10.4674C13.9535 10.4053 14.3906 10.285 14.7695 10.1211C14.8788 9.95919 14.9739 9.78715 15.0614 9.61093V7.85071C15.0614 7.45273 15.2095 7.08203 15.4662 6.79955C15.0911 4.67017 13.2365 3.05141 10.9996 3.05141C8.76326 3.05141 6.90822 4.67039 6.53312 6.79977C6.78964 7.08203 6.93792 7.45273 6.93792 7.85071V9.61093C7.68174 11.1038 9.21888 12.1317 10.9993 12.1317C11.0271 12.1317 11.0539 12.1282 11.0814 12.1275C10.9096 11.9244 10.8018 11.6657 10.8018 11.3797C10.802 10.7384 11.3243 10.2166 11.966 10.2166Z" fill="white" fill-opacity="0.8"/>
                                    <path d="M5.31894 10.8832H5.36976C5.92768 10.8832 6.38044 10.4304 6.38044 9.87053V7.85049C6.38044 7.45361 6.15142 7.11173 5.81812 6.94607C5.96222 4.21257 8.23086 2.03347 10.9993 2.03347C13.7678 2.03347 16.0373 4.21235 16.181 6.94607C15.8477 7.11151 15.6189 7.45361 15.6189 7.85049V9.87053C15.6189 10.0047 15.6451 10.1297 15.6908 10.2467C15.1015 10.6676 14.2441 10.9681 13.2785 11.0513C13.1692 10.8852 12.9829 10.7741 12.7699 10.7741H11.9656C11.6303 10.7741 11.3593 11.0455 11.3593 11.3795C11.3593 11.7139 11.6301 11.9858 11.9656 11.9858H12.7699C13.0042 11.9858 13.204 11.8523 13.3047 11.6587C14.4258 11.5702 15.4007 11.2279 16.0855 10.7217C16.2424 10.8233 16.4285 10.883 16.6294 10.883H16.68C17.2385 10.883 17.6904 10.4302 17.6904 9.87031V7.85027C17.6904 7.44789 17.4546 7.10051 17.1142 6.93925C16.966 3.69557 14.2802 1.10001 10.9996 1.10001C7.71892 1.10001 5.03272 3.69557 4.88554 6.93969C4.54476 7.10073 4.30826 7.44833 4.30826 7.85071V9.87075C4.30826 10.4304 4.76146 10.8832 5.31894 10.8832Z" fill="white" fill-opacity="0.8"/>
                                </svg>
                                <span class="menu-title">Compititor Spy</span>
                            </a>
                        </li>
                         <li class="nav-item <?php
                        if ($currentpage == "video-editor-list" || $currentpage == "avtar-create" || $currentpage == "default-template") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('video-editor-list'); ?>" class="nav-link hover-shadow"
                                id="video-editor-list">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.3931 10.4871C19.9609 10.2387 19.4462 10.2405 19.0153 10.4917L16.5 11.9593V16.9162L19.0153 18.3837C19.2321 18.5102 19.47 18.5735 19.7083 18.5735C19.9435 18.5735 20.1786 18.5121 20.3931 18.3888C20.8253 18.1404 21.0833 17.6949 21.0833 17.1967V11.6802C21.0833 11.182 20.8253 10.736 20.3931 10.488V10.4871Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M14.0262 9.75654C14.9704 9.04567 15.5837 7.91862 15.5837 6.64583C15.5837 4.49442 13.8392 2.75 11.6878 2.75C9.53641 2.75 7.79199 4.49442 7.79199 6.64583C7.79199 7.84163 8.33191 8.91046 9.17983 9.625H6.68603C7.36437 8.99708 7.79199 8.1015 7.79199 7.10417C7.79199 5.20575 6.25291 3.66667 4.35449 3.66667C2.45608 3.66667 0.916992 5.20575 0.916992 7.10417C0.916992 8.217 1.4482 9.20379 2.26862 9.83217C1.47387 10.1924 0.916992 10.989 0.916992 11.9167V16.9583C0.916992 18.222 1.94503 19.25 3.20866 19.25H13.292C14.5556 19.25 15.5837 18.222 15.5837 16.9583V11.9167C15.5837 10.9111 14.9287 10.0645 14.0262 9.75654ZM2.97949 7.10417C2.97949 6.34471 3.59503 5.72917 4.35449 5.72917C5.11395 5.72917 5.72949 6.34471 5.72949 7.10417C5.72949 7.86363 5.11395 8.47917 4.35449 8.47917C3.59503 8.47917 2.97949 7.86363 2.97949 7.10417ZM5.50033 16.9583H3.66699C3.41399 16.9583 3.20866 16.753 3.20866 16.5C3.20866 16.247 3.41399 16.0417 3.66699 16.0417H5.50033C5.75333 16.0417 5.95866 16.247 5.95866 16.5C5.95866 16.753 5.75333 16.9583 5.50033 16.9583ZM11.6878 8.47917C10.6754 8.47917 9.85449 7.65829 9.85449 6.64583C9.85449 5.63337 10.6754 4.8125 11.6878 4.8125C12.7003 4.8125 13.5212 5.63337 13.5212 6.64583C13.5212 7.65829 12.7003 8.47917 11.6878 8.47917Z"
                                        fill="white" fill-opacity="0.8" />
                                </svg>
                                <span class="menu-title">Agent Jobs</span>
                            </a>
                        </li>

                     
                        <li class="nav-item d-none <?php
                        if ($currentpage == "analyz") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('analyz'); ?>" class="nav-link hover-shadow" id="analyz">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_29_2155)">
                                        <path d="M0.133789 8.11639H4.83148V20.3532H0.133789V8.11639Z" fill="white"
                                            fill-opacity="0.8" />
                                        <path
                                            d="M18.3 16.4399C19.2605 14.825 19.0597 12.7103 17.6696 11.3208C16.848 10.4993 15.7707 10.0881 14.6934 10.0881C13.6161 10.0881 12.5395 10.4993 11.7172 11.3208C10.0734 12.9646 10.0734 15.6294 11.7172 17.2732C12.5388 18.0948 13.6161 18.5059 14.6934 18.5059C15.4215 18.5059 16.1434 18.3017 16.793 17.9263L20.3701 21.5034L21.8661 20.0074L18.3 16.4399ZM16.6975 16.3004C16.1619 16.8359 15.4504 17.1302 14.6934 17.1302C13.9365 17.1302 13.2249 16.8353 12.69 16.3004C11.5852 15.1956 11.5852 13.3978 12.69 12.2929C13.2256 11.7574 13.9372 11.4631 14.6934 11.4631C15.4504 11.4631 16.1619 11.7581 16.6975 12.2929C17.8023 13.3978 17.8023 15.1956 16.6975 16.3004Z"
                                            fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M18.5248 10.2421V0.496826H13.8271V8.78601C14.1118 8.74201 14.4005 8.71314 14.6941 8.71314C16.1323 8.71314 17.484 9.25764 18.5248 10.2421Z"
                                            fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M10.7458 10.3486C11.0242 10.0702 11.3281 9.82751 11.6498 9.61713V4.73657H6.95215V20.3538H11.6498V18.9768C11.3274 18.7664 11.0235 18.523 10.7458 18.2453C8.56846 16.0679 8.56846 12.5259 10.7458 10.3486Z"
                                            fill="white" fill-opacity="0.8" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_29_2155">
                                            <rect width="22" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="menu-title">Analyze</span>
                            </a>
                        </li>
                        
                        <li class="nav-item d-none <?php
                        if ($currentpage == "analyz-data") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('analyz-data'); ?>" class="nav-link hover-shadow" id="analyz-data">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 4.76953C7.56452 4.76953 4.76953 7.56452 4.76953 11C4.76953 14.4355 7.56452 17.2305 11 17.2305C14.4355 17.2305 17.2305 14.4355 17.2305 11C17.2305 7.56452 14.4355 4.76953 11 4.76953ZM15.3589 11.3056H14.0699V10.1116L11 13.1815L9.625 11.8065L7.33073 14.1008L6.41923 13.1893L9.625 9.98349L11 11.3585L13.1584 9.20012H11.9644V7.91106H15.3589V11.3056Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M22 12.375V9.625H20.5268C20.4173 8.85943 20.218 8.12294 19.9393 7.42659L21.2138 6.69079L19.8388 4.30921L18.5627 5.04595C18.0917 4.44851 17.5515 3.90827 16.9541 3.43729L17.6908 2.1612L15.3092 0.786199L14.5734 2.06065C13.8771 1.78204 13.1406 1.58271 12.375 1.47318V0H9.625V1.47318C8.85943 1.58271 8.12294 1.78204 7.42659 2.06065L6.69079 0.786199L4.30921 2.1612L5.04595 3.43729C4.44851 3.90827 3.90827 4.44851 3.43729 5.04595L2.1612 4.30921L0.786199 6.69079L2.06065 7.42659C1.78204 8.12294 1.58271 8.85943 1.47318 9.625H0V12.375H1.47318C1.58271 13.1406 1.78204 13.8771 2.06065 14.5734L0.786199 15.3092L2.1612 17.6908L3.43729 16.9541C3.90827 17.5515 4.44851 18.0917 5.04595 18.5627L4.30921 19.8388L6.69079 21.2138L7.42659 19.9393C8.12294 20.218 8.85943 20.4173 9.625 20.5268V22H12.375V20.5268C13.1406 20.4173 13.8771 20.218 14.5734 19.9393L15.3092 21.2138L17.6908 19.8388L16.9541 18.5627C17.5515 18.0917 18.0917 17.5515 18.5627 16.9541L19.8388 17.6908L21.2138 15.3092L19.9393 14.5734C20.218 13.8771 20.4173 13.1406 20.5268 12.375H22ZM11 18.5195C6.85373 18.5195 3.48047 15.1463 3.48047 11C3.48047 6.85373 6.85373 3.48047 11 3.48047C15.1463 3.48047 18.5195 6.85373 18.5195 11C18.5195 15.1463 15.1463 18.5195 11 18.5195Z"
                                        fill="white" fill-opacity="0.8" />
                                </svg>
                                <span class="menu-title">Optimize</span>
                            </a>
                        </li>

                        <li class="nav-item d-none <?php
                        if ($currentpage == "ai-query") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('ai-query'); ?>" class="nav-link hover-shadow" id="ai-query">

                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.2422 20.075H2.80156C1.63711 20.075 0.807813 18.9406 1.16445 17.832L2.57813 13.4148C3.03359 11.9969 4.58477 11.2621 5.96836 11.7992C6.88789 12.1559 8.06953 12.4352 9.51758 12.4352C10.9656 12.4352 12.1473 12.1559 13.0668 11.7992C14.0551 11.4168 15.1293 11.6789 15.8297 12.3793L15.877 12.8605C15.9113 13.2 16.0832 13.4879 16.3324 13.6812C15.9328 14.0594 15.6836 14.5922 15.6836 15.1852C15.6836 16.3066 16.5773 17.2219 17.6902 17.2605L17.875 17.832C18.2316 18.9406 17.4066 20.075 16.2422 20.075Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M9.52188 10.7851C11.9685 10.7851 13.952 8.80173 13.952 6.35507C13.952 3.9084 11.9685 1.92499 9.52188 1.92499C7.07521 1.92499 5.0918 3.9084 5.0918 6.35507C5.0918 8.80173 7.07521 10.7851 9.52188 10.7851Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M16.943 7.29608H18.8465C20.2258 7.29608 20.9176 7.88046 20.9176 9.04491V10.4543C20.9176 11.6101 20.2473 12.1902 18.9023 12.2031L18.8465 12.7832C18.8293 12.9422 18.6961 13.0625 18.5371 13.0625H17.0461C16.8871 13.0625 16.7496 12.9422 16.7367 12.7832L16.5863 11.2492C16.5691 11.0644 16.7109 10.9055 16.8957 10.9055H18.1031C18.3395 10.9055 18.4555 10.8023 18.4555 10.5961V9.22968C18.4555 9.02343 18.3395 8.9203 18.1031 8.9203H17.6949C17.4586 8.9203 17.3426 9.02343 17.3426 9.22968V9.87421C17.3426 10.0461 17.2051 10.1879 17.0289 10.1879H15.1855C15.0137 10.1879 14.8719 10.0504 14.8719 9.87421V9.04491C14.8719 7.87616 15.5637 7.29608 16.943 7.29608Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M17.7598 16.4012C18.4314 16.4012 18.9758 15.8568 18.9758 15.1852C18.9758 14.5136 18.4314 13.9692 17.7598 13.9692C17.0882 13.9692 16.5438 14.5136 16.5438 15.1852C16.5438 15.8568 17.0882 16.4012 17.7598 16.4012Z"
                                        fill="white" fill-opacity="0.8" />
                                </svg>
                                <span class="menu-title">AI Queries</span>
                            </a>
                        </li>

                        <li class="nav-item <?php
                        if ($currentpage == "business-list") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('business-list'); ?>" class="nav-link hover-shadow"
                                id="business-list">

                                <svg class="size-icon" width="14" height="20" viewBox="0 0 22 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 7.47656C13.0646 7.47656 14.7383 5.80288 14.7383 3.73828C14.7383 1.67369 13.0646 0 11 0C8.9354 0 7.26172 1.67369 7.26172 3.73828C7.26172 5.80288 8.9354 7.47656 11 7.47656Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M18.5625 7.47653C19.8677 7.47653 20.9258 6.41846 20.9258 5.11325C20.9258 3.80805 19.8677 2.74997 18.5625 2.74997C17.2573 2.74997 16.1992 3.80805 16.1992 5.11325C16.1992 6.41846 17.2573 7.47653 18.5625 7.47653Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M3.4375 7.47653C4.7427 7.47653 5.80078 6.41846 5.80078 5.11325C5.80078 3.80805 4.7427 2.74997 3.4375 2.74997C2.1323 2.74997 1.07422 3.80805 1.07422 5.11325C1.07422 6.41846 2.1323 7.47653 3.4375 7.47653Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M5.76598 9.59878C4.8357 8.8366 3.99321 8.9375 2.91758 8.9375C1.30883 8.9375 0 10.2386 0 11.8375V16.5301C0 17.2245 0.566758 17.7891 1.26371 17.7891C4.27264 17.7891 3.91016 17.8435 3.91016 17.6593C3.91016 14.3341 3.5163 11.8956 5.76598 9.59878Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M12.0231 8.95463C10.1443 8.79793 8.51129 8.95644 7.10273 10.1191C4.7456 12.0071 5.19922 14.5493 5.19922 17.6592C5.19922 18.482 5.86867 19.164 6.70398 19.164C15.7739 19.164 16.1349 19.4566 16.6727 18.2655C16.8491 17.8627 16.8008 17.9907 16.8008 14.1375C16.8008 11.077 14.1508 8.95463 12.0231 8.95463Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M19.0828 8.93742C18.0013 8.93742 17.1634 8.83756 16.2344 9.59871C18.4672 11.8785 18.0902 14.1506 18.0902 17.6592C18.0902 17.8446 17.7893 17.789 20.6915 17.789C21.4134 17.789 22.0004 17.2042 22.0004 16.4853V11.8374C22.0004 10.2385 20.6915 8.93742 19.0828 8.93742Z"
                                        fill="white" fill-opacity="0.8" />
                                </svg>
                                <span class="menu-title">Lead Finder</span>
                            </a>
                        </li>

                       

                        <li class="nav-item <?php
                        if ($currentpage == "automation") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('automation'); ?>" class="nav-link hover-shadow" id="dashboard">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.1247 8.02075H6.87467C5.98872 8.02075 5.27051 8.73896 5.27051 9.62492V12.3749C5.27051 13.2609 5.98872 13.9791 6.87467 13.9791H15.1247C16.0106 13.9791 16.7288 13.2609 16.7288 12.3749V9.62492C16.7288 8.73896 16.0106 8.02075 15.1247 8.02075Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M15.1247 1.14575H6.87467C5.98872 1.14575 5.27051 1.86396 5.27051 2.74992V5.49992C5.27051 6.38588 5.98872 7.10409 6.87467 7.10409H15.1247C16.0106 7.10409 16.7288 6.38588 16.7288 5.49992V2.74992C16.7288 1.86396 16.0106 1.14575 15.1247 1.14575Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M15.1247 14.8958H6.87467C5.98872 14.8958 5.27051 15.614 5.27051 16.4999V19.2499C5.27051 20.1359 5.98872 20.8541 6.87467 20.8541H15.1247C16.0106 20.8541 16.7288 20.1359 16.7288 19.2499V16.4999C16.7288 15.614 16.0106 14.8958 15.1247 14.8958Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M1.83365 6.18741C1.65948 6.18741 1.48531 6.12324 1.34781 5.98574C1.08198 5.71991 1.08198 5.27991 1.34781 5.01407L2.23698 4.12491L1.34781 3.23574C1.08198 2.96991 1.08198 2.52991 1.34781 2.26407C1.61365 1.99824 2.05365 1.99824 2.31948 2.26407L3.69448 3.63907C3.96031 3.90491 3.96031 4.34491 3.69448 4.61074L2.31948 5.98574C2.18198 6.12324 2.00781 6.18741 1.83365 6.18741Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M18.7917 19.9375C18.6175 19.9375 18.4433 19.8734 18.3058 19.7359C18.04 19.47 18.04 19.03 18.3058 18.7642L19.195 17.875L18.3058 16.9859C18.04 16.72 18.04 16.28 18.3058 16.0142C18.5717 15.7484 19.0117 15.7484 19.2775 16.0142L20.6525 17.3892C20.9183 17.655 20.9183 18.095 20.6525 18.3609L19.2775 19.7359C19.14 19.8734 18.9658 19.9375 18.7917 19.9375Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M18.3333 11.6875H17.875C17.4992 11.6875 17.1875 11.3758 17.1875 11C17.1875 10.6242 17.4992 10.3125 17.875 10.3125H18.3333C18.9658 10.3125 19.4792 9.79917 19.4792 9.16667V5.95833C19.4792 5.32583 18.9658 4.8125 18.3333 4.8125H17.875C17.4992 4.8125 17.1875 4.50083 17.1875 4.125C17.1875 3.74917 17.4992 3.4375 17.875 3.4375H18.3333C19.7267 3.4375 20.8542 4.565 20.8542 5.95833V9.16667C20.8542 10.56 19.7267 11.6875 18.3333 11.6875Z"
                                        fill="white" fill-opacity="0.8" />
                                    <path
                                        d="M4.12467 18.5625H3.66634C2.27301 18.5625 1.14551 17.435 1.14551 16.0417V12.8333C1.14551 11.44 2.27301 10.3125 3.66634 10.3125H4.12467C4.50051 10.3125 4.81217 10.6242 4.81217 11C4.81217 11.3758 4.50051 11.6875 4.12467 11.6875H3.66634C3.03384 11.6875 2.52051 12.2008 2.52051 12.8333V16.0417C2.52051 16.6742 3.03384 17.1875 3.66634 17.1875H4.12467C4.50051 17.1875 4.81217 17.4992 4.81217 17.875C4.81217 18.2508 4.50051 18.5625 4.12467 18.5625Z"
                                        fill="white" fill-opacity="0.8" />
                                </svg>
                                <span class="menu-title">Automation</span>
                            </a>
                        </li>
                        <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('ai_tubeagent', $team_privileges)): ?>
                            <li class="nav-item <?php if ($currentpage == "virtual-assistant" || $currentpage == "conversation") {
                                echo "active";
                            } ?>">
                                <a href="<?= base_url('virtual-assistant'); ?>" class="nav-link hover-shadow" id="letswork">
                                    <span class="fa-solid fa-user-astronaut size-icon"></span>
                                    <span class="menu-title">AI Agents</span>
                                </a>
                            </li>
                        <?php else: ?> 
                            <li class="nav-item">
                                <a href="#" class="nav-link hover-shadow" id="letswork" onclick="show_msg('You do not have permission to access AI Agent.')">
                                    <svg class="size-icon" width="14" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_17_1161)">
                                        <path d="M20.5358 12.812H18.6797C18.8689 13.33 18.9722 13.889 18.9722 14.4716V21.4864C18.9722 21.7293 18.93 21.9625 18.853 22.1793H21.9215C23.0678 22.1793 24.0002 21.2468 24.0002 20.1006V16.2765C24.0003 14.3662 22.4461 12.812 20.5358 12.812Z" fill="white" fill-opacity="0.8"/>
                                        <path d="M5.02806 14.4715C5.02806 13.8889 5.13142 13.3299 5.3206 12.812H3.46454C1.55419 12.812 0 14.3661 0 16.2765V20.1006C0 21.2468 0.932486 22.1793 2.07872 22.1793H5.14726C5.07034 21.9624 5.02806 21.7293 5.02806 21.4864V14.4715Z" fill="white" fill-opacity="0.8"/>
                                        <path d="M14.1218 11.007H9.8786C7.96825 11.007 6.41406 12.5612 6.41406 14.4715V21.4864C6.41406 21.869 6.72428 22.1793 7.10697 22.1793H16.8935C17.2761 22.1793 17.5864 21.8691 17.5864 21.4864V14.4715C17.5864 12.5612 16.0322 11.007 14.1218 11.007Z" fill="white" fill-opacity="0.8"/>
                                        <path d="M12.0005 1.8208C9.70308 1.8208 7.83398 3.6899 7.83398 5.98739C7.83398 7.54575 8.6941 8.90677 9.96432 9.62133C10.5668 9.96024 11.2614 10.1539 12.0005 10.1539C12.7397 10.1539 13.4342 9.96024 14.0367 9.62133C15.307 8.90677 16.1671 7.5457 16.1671 5.98739C16.1671 3.68994 14.298 1.8208 12.0005 1.8208Z" fill="white" fill-opacity="0.8"/>
                                        <path d="M4.68438 5.7041C2.96617 5.7041 1.56836 7.10192 1.56836 8.82012C1.56836 10.5383 2.96617 11.9361 4.68438 11.9361C5.12023 11.9361 5.53526 11.8459 5.91227 11.6836C6.56412 11.4029 7.10159 10.9062 7.43417 10.2839C7.66761 9.84716 7.8004 9.34892 7.8004 8.82012C7.8004 7.10196 6.40259 5.7041 4.68438 5.7041Z" fill="white" fill-opacity="0.8"/>
                                        <path d="M19.3172 5.7041C17.599 5.7041 16.2012 7.10192 16.2012 8.82012C16.2012 9.34897 16.334 9.8472 16.5674 10.2839C16.9 10.9062 17.4375 11.403 18.0893 11.6836C18.4663 11.8459 18.8813 11.9361 19.3172 11.9361C21.0354 11.9361 22.4332 10.5383 22.4332 8.82012C22.4332 7.10192 21.0354 5.7041 19.3172 5.7041Z" fill="white" fill-opacity="0.8"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_17_1161">
                                        <rect width="24" height="24" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="menu-title">AI Agent</span>
                                </a>
                            </li>
                        <?php endif ?>

                        

                        <li class="nav-item d-none<?php
                        if ($currentpage == "competitor-spy") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('competitor-spy'); ?>" class="nav-link hover-shadow"
                                id="competitor-spy">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_29_2205)">
                                        <path d="M13.8071 8.88281H8.19238V21.9999H13.8071V8.88281Z" fill="white"
                                            fill-opacity="0.8" />
                                        <path
                                            d="M19.8324 11.3471C20.3186 10.8561 20.6196 10.1813 20.6196 9.4373C20.6196 7.93989 19.4013 6.72168 17.904 6.72168C16.4065 6.72168 15.1884 7.93993 15.1884 9.4373C15.1884 10.1813 15.4893 10.8561 15.9755 11.3471C15.6548 11.519 15.3594 11.7324 15.0967 11.98V14.3156H21.949C21.7448 13.0296 20.9405 11.9409 19.8324 11.3471Z"
                                            fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M15.0967 15.6047V22.0001H21.3558C21.7118 22.0001 22.0003 21.7116 22.0003 21.3556V15.6047H15.0967Z"
                                            fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M4.3869e-05 17.1687V21.3554C4.3869e-05 21.7114 0.288622 22 0.644575 22H6.9037V17.1687H4.3869e-05Z"
                                            fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M6.02527 12.9111C6.51151 12.4201 6.81246 11.7453 6.81246 11.0013C6.81246 9.50385 5.59421 8.28564 4.09684 8.28564C2.59946 8.28564 1.38125 9.5039 1.38125 11.0013C1.38125 11.7453 1.68216 12.4201 2.1684 12.9111C1.06032 13.5049 0.255988 14.5936 0.0517578 15.8797H6.90416V13.5441C6.6414 13.2964 6.34608 13.083 6.02527 12.9111Z"
                                            fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M12.9284 4.62541C13.4147 4.13445 13.7156 3.45959 13.7156 2.71563C13.7156 1.21821 12.4974 0 11 0C9.50262 0 8.28437 1.21825 8.28437 2.71563C8.28437 3.45959 8.58528 4.1345 9.07156 4.62541C7.96353 5.2192 7.15911 6.30794 6.95492 7.594H15.0451C14.8409 6.30798 14.0365 5.21924 12.9284 4.62541Z"
                                            fill="white" fill-opacity="0.8" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_29_2205">
                                            <rect width="22" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="menu-title">Competitor Spy</span>
                            </a>
                        </li>

                        <li class="nav-item <?php
                        if ($currentpage == "agency-product") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('agency-product'); ?>" class="nav-link hover-shadow" id="dashboard">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.4375 18.9062V17.5312H19.25C19.7966 17.5312 20.3225 17.314 20.7075 16.9273C21.0959 16.5402 21.3125 16.0157 21.3125 15.4688V3.78125C21.3125 3.23434 21.0959 2.70978 20.7075 2.32271C20.3225 1.936 19.7966 1.71875 19.25 1.71875C15.7059 1.71875 6.29406 1.71875 2.75 1.71875C2.20344 1.71875 1.6775 1.936 1.2925 2.32271C0.904066 2.70978 0.6875 3.23434 0.6875 3.78125V15.4688C0.6875 16.0157 0.904066 16.5402 1.2925 16.9273C1.6775 17.314 2.20344 17.5312 2.75 17.5312H7.5625V18.9062H6.53125C6.15312 18.9062 5.84375 19.2143 5.84375 19.5938C5.84375 19.9732 6.15312 20.2812 6.53125 20.2812H15.4688C15.8469 20.2812 16.1562 19.9732 16.1562 19.5938C16.1562 19.2143 15.8469 18.9062 15.4688 18.9062H14.4375ZM19.9375 14.0938H2.0625V3.78125C2.0625 3.59906 2.13468 3.42409 2.2653 3.29519C2.39249 3.16628 2.56781 3.09375 2.75 3.09375H19.25C19.4322 3.09375 19.6075 3.16628 19.7347 3.29519C19.8653 3.42409 19.9375 3.59906 19.9375 3.78125V14.0938ZM13.8394 11.9821L15.5581 12.6696C15.9088 12.8105 16.3109 12.639 16.4519 12.2867C16.5928 11.9343 16.4209 11.5338 16.0669 11.3929L14.3481 10.7054C13.9975 10.5645 13.5953 10.736 13.4544 11.0883C13.3134 11.4407 13.4853 11.8412 13.8394 11.9821ZM6.875 10.6562V12.0312C6.875 12.4108 7.18437 12.7188 7.5625 12.7188C7.94063 12.7188 8.25 12.4108 8.25 12.0312V10.8996L11.8284 12.001C12.0381 12.0649 12.265 12.0264 12.4403 11.8968C12.6156 11.7673 12.7188 11.562 12.7188 11.3438V5.84375C12.7188 5.62547 12.6156 5.42025 12.4403 5.29065C12.265 5.16106 12.0381 5.12257 11.8284 5.1865L7.45936 6.53125H6.1875C5.80594 6.53125 5.5 6.83891 5.5 7.21875V9.96875C5.5 10.3486 5.80594 10.6562 6.1875 10.6562H6.875ZM14.0938 9.28125H15.8125C16.1906 9.28125 16.5 8.97325 16.5 8.59375C16.5 8.21425 16.1906 7.90625 15.8125 7.90625H14.0938C13.7156 7.90625 13.4062 8.21425 13.4062 8.59375C13.4062 8.97325 13.7156 9.28125 14.0938 9.28125ZM14.3481 6.48209L16.0669 5.79459C16.4209 5.65365 16.5928 5.25318 16.4519 4.90084C16.3109 4.5485 15.9088 4.37697 15.5581 4.51791L13.8394 5.20541C13.4853 5.34635 13.3134 5.74682 13.4544 6.09916C13.5953 6.4515 13.9975 6.62303 14.3481 6.48209Z"
                                        fill="white" fill-opacity="0.8" />
                                </svg>
                                <span class="menu-title">Agency</span>
                            </a>
                        </li>

                        <li class="nav-item <?php
                        $active_pages = ["settings", "integration"];
                        if (in_array($currentpage, $active_pages)) {
                            echo "active";
                        }

                        ?>">
                            <a href="<?= base_url('settings'); ?>" class="nav-link hover-shadow" id="letswork">
                                <svg class="size-icon" width="14" height="22" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.1434 0.709116C13.1434 0.709116 13.9098 2.93267 13.9098 2.93163C14.5472 3.20486 15.1489 3.55272 15.7035 3.96817L18.013 3.51998C18.2811 3.46781 18.5574 3.56296 18.7375 3.76865C19.6738 4.84307 20.3931 6.08839 20.8546 7.437C20.9436 7.69591 20.8874 7.98242 20.7083 8.18908C20.7083 8.18908 19.1662 9.96441 19.1662 9.9634C19.2481 10.652 19.2481 11.3478 19.1662 12.0355L20.7083 13.8108C20.8874 14.0175 20.9436 14.304 20.8546 14.5629C20.3931 15.9115 19.6738 17.1568 18.7375 18.2312C18.5574 18.4369 18.2811 18.5321 18.013 18.4799C18.013 18.4799 15.7035 18.0317 15.7045 18.0317C15.1489 18.4472 14.5462 18.7951 13.9098 19.0672L13.1434 21.2908C13.0543 21.5496 12.8343 21.741 12.5662 21.7942C11.1675 22.0684 9.72877 22.0684 8.32996 21.7942C8.06187 21.741 7.84189 21.5496 7.75284 21.2908C7.75284 21.2908 6.98644 19.0672 6.98644 19.0683C6.34894 18.795 5.7473 18.4472 5.19266 18.0317L2.88319 18.48C2.6151 18.5322 2.33882 18.437 2.15872 18.2313C1.22242 17.1569 0.503096 15.9116 0.0415877 14.5629C-0.0474556 14.304 0.00884352 14.0175 0.187893 13.8108C0.187893 13.8108 1.72996 12.0355 1.72996 12.0365C1.6481 11.3478 1.6481 10.6521 1.72996 9.96441L0.187933 8.18908C0.00888363 7.98238 -0.0474155 7.69587 0.0415877 7.437C0.503096 6.08835 1.22242 4.84307 2.15868 3.76861C2.33878 3.56292 2.61506 3.46777 2.88315 3.51998C2.88315 3.51998 5.19262 3.96817 5.19161 3.96817C5.74726 3.55272 6.34994 3.20482 6.9864 2.93263L7.7528 0.709116C7.84185 0.450253 8.06183 0.258884 8.32992 0.205674C9.72869 -0.0685581 11.1674 -0.0685581 12.5662 0.205674C12.8343 0.258884 13.0543 0.450213 13.1434 0.709116ZM10.4481 6.47619C7.95135 6.47619 5.92426 8.50324 5.92426 11C5.92426 13.4968 7.95131 15.5238 10.4481 15.5238C12.9449 15.5238 14.9719 13.4967 14.9719 11C14.9719 8.50324 12.9448 6.47619 10.4481 6.47619ZM10.4481 8.01107C12.0976 8.01107 13.437 9.35053 13.437 11C13.437 12.6494 12.0976 13.9889 10.4481 13.9889C8.79861 13.9889 7.45919 12.6495 7.45919 11C7.45919 9.35049 8.79861 8.01107 10.4481 8.01107Z"
                                        fill="white" fill-opacity="0.8" />
                                </svg>

                                <span class="menu-title">Settings</span>
                            </a>
                        </li>


                        <li class="nav-item has-dropdown sidebar-custom-dropdown-parent d-none  <?php
                        if ($currentpage == "youtube-v2-list" || $currentpage == "youtube-v2-auto-comment") {
                            echo "permanent-active";
                        }
                        ?>">
                            <a href="javascript:void(0);" class="nav-link hover-shadow dropdown-toggle" id="letswork">
                                <svg class="size-icon" width="14" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_28_2509)">
                                        <path
                                            d="M0.738281 5.41324V18.5633C0.738281 21.1452 2.83131 23.2383 5.41324 23.2383H18.5633C21.1452 23.2383 23.2383 21.1452 23.2383 18.5633V5.41324C23.2383 2.83131 21.1452 0.738281 18.5633 0.738281H5.41324C2.83131 0.738281 0.738281 2.83131 0.738281 5.41324ZM14.3716 18.3634C8.82202 20.2782 3.69841 15.1545 5.61319 9.60493C6.25836 7.73451 7.73438 6.25836 9.6048 5.61319C15.1545 3.69841 20.2782 8.82202 18.3634 14.3718C17.7182 16.2422 16.2422 17.7182 14.3716 18.3634ZM19.7956 5.18472C19.7073 5.64711 19.3247 5.91614 18.9289 5.91614C18.688 5.91614 18.4425 5.81671 18.2545 5.60097C18.2379 5.58188 18.2223 5.56142 18.2086 5.54013C18.0146 5.2435 18.0085 4.89111 18.1734 4.60533C18.2902 4.40305 18.4786 4.25858 18.7042 4.19815C18.9296 4.13745 19.1652 4.16862 19.3672 4.28549C19.6532 4.45029 19.824 4.75859 19.8045 5.11208C19.8031 5.13625 19.8002 5.16083 19.7956 5.18472Z"
                                            fill="white" fill-opacity="0.8" />
                                        <path
                                            d="M11.9875 6.52246C8.97336 6.52246 6.52148 8.97433 6.52148 11.9884C6.52148 15.0025 8.97336 17.4544 11.9875 17.4544C15.0016 17.4544 17.4534 15.0025 17.4534 11.9884C17.4534 8.97433 15.0016 6.52246 11.9875 6.52246Z"
                                            fill="white" fill-opacity="0.8" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_28_2509">
                                            <rect width="24" height="24" fill="white" fill-opacity="0.8" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="menu-title">Automation</span>
                            </a>
                            <ul class="dropdown-menu sidebar-custom-dropdown">
                                <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('auto_reply', $team_privileges)): ?>
                                    <li>
                                        <a href="<?= base_url('youtube-v2-list'); ?>" class="dropdown-item <?php
                                          if ($currentpage == "youtube-v2-list") {
                                              echo "active";
                                          }
                                          ?>">
                                            <span class="leftdot"></span>
                                            <span class="menu-title">Auto Reply</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="#?>" onclick="show_msg('You do not have permission to access Auto Reply.')"
                                            class="dropdown-item <?php
                                            if ($currentpage == "youtube-v2-list") {
                                                echo "active";
                                            }
                                            ?>">
                                            <span class="leftdot"></span>
                                            <span class="menu-title">Auto Reply</span>
                                        </a>
                                    </li>
                                <?php endif ?>

                                <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('auto_comment', $team_privileges)): ?>
                                    <li>
                                        <a href="<?= base_url('youtube-v2-auto-comment'); ?>" class="dropdown-item <?php
                                          if ($currentpage == "youtube-v2-auto-comment") {
                                              echo "active";
                                          }
                                          ?>">
                                            <span class="leftdot"></span>
                                            <span class="menu-title">Auto Comment</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="#?>"
                                            onclick="show_msg('You do not have permission to access Auto Comment.')" class="dropdown-item <?php
                                            if ($currentpage == "youtube-v2-list") {
                                                echo "active";
                                            }
                                            ?>">
                                            <span class="leftdot"></span>
                                            <span class="menu-title">Auto Comment</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </li>
                                
                        <!-- <li class="nav-item <?php
                        if ($currentpage == "insta-publisher" || $currentpage == "upload-insta-video") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('insta-publisher'); ?>" class="nav-link hover-shadow" id="letswork">
                                <span class="fa-solid fa-file-arrow-up size-icon"></span>
                                <span class="menu-title">Instagram Publisher</span>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item <?php
                        if ($currentpage == "insta-auto-reply") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('insta-auto-reply'); ?>" class="nav-link hover-shadow" id="letswork">
                                <span class="fa-solid fa-file-arrow-up size-icon"></span>
                                <span class="menu-title">Insta auto reply</span>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item <?php
                        $active_pages = ["post-generator"];
                        if (in_array($currentpage, $active_pages)) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('post-generator'); ?>" class="nav-link hover-shadow" id="letswork">
                                <svg class="size-icon" width="14" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6941 13.2859C14.1812 13.2859 13.8248 13.5587 13.6137 13.9846V13.6966C13.6137 12.8658 12.9749 12.1923 12.1869 12.1923C11.5023 12.1923 10.9316 12.7011 10.7932 13.3793V12.1923C10.7932 11.3647 10.1569 10.6938 9.37189 10.6938C8.89807 10.6938 8.48128 10.9408 8.22304 11.3165V6.99703C8.22304 6.22497 7.62782 5.59909 6.89344 5.59909H6.8921C6.15589 5.59909 5.55996 6.22805 5.56314 7.00205C5.57407 9.66339 5.59207 15.3146 5.55681 17.4123C5.13781 16.6609 4.38928 15.3614 3.8088 14.4861C3.34771 13.791 2.56451 13.4292 1.84362 13.8083C1.17386 14.1606 0.864481 14.9892 1.12428 15.7277C2.32314 19.1356 2.87171 20.6887 3.68037 22.8748C3.93083 23.5519 4.55142 24 5.24241 24H13.3504C14.1729 24 14.8753 23.3724 15.0042 22.5183C15.4358 19.6586 15.7085 17.4179 15.96 15.4638C16.1997 13.6012 15.3096 13.2859 14.6941 13.2859ZM7.47095 0H6.21468V3.08164H7.47095V0ZM4.5278 3.80188L2.57799 1.75177L1.68977 2.68568L3.63958 4.7358L4.5278 3.80188ZM2.93109 6.49954H0V7.82043H2.93109V6.49954ZM10.7214 7.85526H13.6523V6.53437H10.7214V7.85526ZM11.9861 2.71056L11.0979 1.77664L9.14807 3.82676L10.0363 4.76067L11.9861 2.71056Z" fill="white" fill-opacity="0.8"/>
                                </svg>

                                <span class="menu-title">Command Center</span>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item <?php
                        if ($currentpage == "youtube") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('youtube'); ?>" class="nav-link hover-shadow" id="letswork">
                                <span class="fa-brands fa-youtube size-icon"></span>
                                <span class="menu-title">YouTube</span>
                            </a>
                        </li> -->

                        <!-- <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('templates', $team_privileges)): ?>
                        <li class="nav-item <?php
                        if ($currentpage == "default-template") {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= base_url('default-template'); ?>" class="nav-link hover-shadow" id="letswork">
                                <span class="fa-solid fa-film size-icon"></span>
                                <span class="menu-title">Templates</span>
                            </a>
                        </li>
                    <?php else: ?>
                            <li class="nav-item" >
                                <a href="#" class="nav-link hover-shadow" id="letswork" onclick="show_msg('You do not have permission to access Templates.')">
                                    <span class="fa-solid fa-film size-icon"></span>
                                    <span class="menu-title">Templates</span>
                                </a>
                            </li>
                        <?php endif ?> -->

                        <!-- <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('youtube_publisher', $team_privileges)): ?>
                             <li class="nav-item <?php
                             if ($currentpage == "youtube-publisher" || $currentpage == "upload-youtube-video") {
                                 echo "active";
                             }
                             ?>">
                                <a href="<?= base_url('youtube-publisher'); ?>" class="nav-link hover-shadow" id="letswork">
                                    <span class="fa-solid fa-file-arrow-up size-icon"></span>
                                    <span class="menu-title">YouTube Publisher</span>
                                </a>
                            </li>
                        <?php else: ?>
                                <li class="nav-item" >
                                <a href="#" class="nav-link hover-shadow" id="letswork" onclick="show_msg('You do not have permission to access YouTube Publisher.')">
                                    <span class="fa-solid fa-file-arrow-up size-icon"></span>
                                    <span class="menu-title">YouTube Publisher</span>
                                </a>
                            </li>
                        <?php endif ?> -->


                    </ul>

                    <li class="profile style-2" style="padding: 10px;">
                        <a class="dropdown-toggle drop-after" data-bs-toggle="dropdown" id="profile">
                            <span class="profile-pic"><img
                                    src="<?= ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? $assetsPath . 'default/images/default_profile.png' : $this->config->item('bucket_url') . $this->session->userdata('logged_in')['profile_pic'] ?>"
                                    class="img-fluid"></span>
                            <div class="d-flex justify-content-between flex-1">
                                <div class="user-name">
                                    <?php echo !empty($this->session->userdata('logged_in')['name']) ? $this->session->userdata('logged_in')['name'] : John ?>
                                </div>
                                <!-- <span class="email text-white" style=" font-size: 12px; font-weight: 400;"><?php echo !empty($this->session->userdata('logged_in')['email']) ? $this->session->userdata('logged_in')['email'] : John ?></span> -->
                                <!--<div class="d-flex mt-1 gap-1 align-items-center text-white" style=" font-size: 12px;"><span class="credits-count"> NA </span> Credit Left</div>-->
                                <div class="">
                                    <a href="javascripts:void(0)" class="leftarrows"><i class="fa-solid fa-chevron-right"></i> </a>
                                </div>
                            </div>
                            <!-- <i class="fa-solid text-white fa-angle-right pw-2" style="width: 3%"></i> -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end animated--grow-in"
                            aria-labelledby="dropdownMenuButton1">
                            <!--  <li class="d-block d-sm-none"><form action="<?php echo base_url('integration') ?>" method="post">
                            <input type="hidden" name="active_tab" value="contentprovider" />
                            <button type="submit" style="background: transparent;text-decoration: none; border: none; margin-top:11px;">
                                <a href="#" class="text-white">
                                    <i class='icon-credit-left' style="line-height:1.5"></i> &nbsp; Credit Left &nbsp;
                                    <span class="remaining_credit"></span>
                                </a>
                            </button>
                            </form></li> -->

                            <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('my_profile', $team_privileges)) { ?>
                                <li><a class="dropdown-item" href="<?= base_url('profile'); ?>"><i class="icon-user"></i> My
                                        Profile</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="#"
                                        onclick="show_msg('You do not have permission to access Profile.')"><i
                                            class="icon-user"></i> My Profile</a></li>
                            <?php } ?>


                            <!--<?php if ($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) { ?>
                                <li><a class="dropdown-item" href="<?= base_url('team-management'); ?>"><i class="icon-team-management"></i> Manage Team</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('client-management'); ?>"><i class="icon-client-management"></i> Manage Clients</a></li>
                            <?php } ?>
                            <?php if ($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id'] || $this->session->userdata('logged_in')['user_role'] == 'client') { ?>
                                <li><a class="dropdown-item" href="<?= base_url('workspace') ?>"><i class="icon-business"></i> Manage WorkSpace</a></li>
                            <?php } ?>-->
                            <!-- <li>
                                <a class="dropdown-item" href="<?= base_url('subscription') ?>">
                                    <i class="icon-subscription"></i> Subscription
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('training') ?>" target="_blank">
                                <i class="icon-tutorial"></i> Tutorials</a>
                            </li> -->
                            <!--<li><a class="dropdown-item" href="<?= base_url('training') ?>"><i class="icon-tutorial"></i> Tutorials</a></li>-->
                            <!-- <li><a class="dropdown-item" href="<?= base_url('settings') ?>"><i class="fa-solid fa-gear"></i> Settings</a></li> -->
                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>"><i class="icon-logout"></i>
                                    Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <a href="javascript:void(0);" class="nav-down-arrow" title="Scroll Down"><i
                    class="fa-solid fa-arrow-down"></i></a>
        </div>
    </div>
    <!-- Sidebar Start End -->
    <?php }?>
    <!---Modal--->
    <div class="modal fade confirm-del " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3 pt-0">
                    <h4 class="title-line">Create New Workspace</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('create-workspace'); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="row  d-flex justify-content-around">
                            <div class="col-md-3 mt-md-3 mt-0">
                                <div class="inline-flex">
                                </div>
                                <div class="profile-img profile-text">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>uploads/default_images/default_business_logo.png"
                                        class="" id="imageShow" />
                                    <label for="profile_upload" class="profile-text d-none"><i
                                            class="icon-list-edit"></i></label>
                                    <input id="profile_upload" class="d-none" type="file" accept="image/*"
                                        name="business_logo" onchange="loadImage(this)">
                                </div>
                                <!--<div class="text-center label-title text-white">-->
                                <!--    <label class="overflow-hidden cursor-pointer" for="upload">Select a logo</label>-->

                                <!--    <input type="file" accept="image/*" name="business_logo" id="upload"-->
                                <!--        onchange="loadImage(this)" style="display:none; ">-->
                                <!--</div>-->
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <!--<div class="col-md-12">-->
                                    <!--    <label for="fname" class="mt20 mt-md10">Workspace Name </label>-->
                                    <!--    <input type="text" id="fname" name="business_name" placeholder="Enter Name Here" class="workspace-name mt10">-->
                                    <!--</div>-->
                                    <div class="col-md-12 mt20">
                                        <label for="firstname" class="form-label">Workspace Name </label>
                                        <div class=" mt25 field-white-bg">
                                            <input class="form-control f-14 ng-valid ng-scope ng-valid-maxlength ng-not-empty ng-dirty ng-valid-parse 
                                            ng-touched form-control search1" maxlength="25"
                                                placeholder="Enter Your Workspace Name (Max : 25 Characters) "
                                                type="text" name="domain" autocomplete="off"
                                                required><!-- end ngIf: is_edit_subdomain == '0' -->
                                        </div>
                                        <!--<div class="f-16 f-md-20 w500 mt20">-->
                                        <!--	<span class="domain_name">-->
                                        <!--	    <span class=" d-gblue-clr">-->
                                        <!--	        <i class="icon-locked"></i> https://</span></span>.<?php echo $this->config->item('productSite') ?>-->
                                        <!--</div>-->
                                        <!--<div class="f-16 f-md-20 w500 mt20 red-clr">-->
                                        <!--				<label> -->
                                        <!--                             <input type="checkbox" required>  -->
                                        <!--                         I carefully reviewed the subdomain, and once saved, it cannot be altered.-->
                                        <!--                         </label> -->
                                        <!--</div>-->
                                    </div>
                                    <div class="col-md-12 mt20">
                                        <div class="modal-footer mt20">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Create Workspace</button>
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

    <!--  <div class="modal fade confirm-del  align-items-center justify-content-center " id="dashboardModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg" style="margin-top:50px; width: 600px">
            <div class="modal-content">
                 <div class="d-flex justify-content-right">
                     <button type="button" class="btn-close" aria-label="Close" style="position:absolute; top:7px; right:5px;"></button>
                 </div>
                <div class="modal-body">
                    <h4 class="text-white">AI Agents Army Customers Only VIP Training</h4>
                     <div class="responsive-video" style="margin-top:20px">
                     <iframe src="https://aivideobuilderfx.oppyo.com/video/embed/b4gc9tokhh" style=" position: absolute;top: 0;left: 0;width: 100%;height: 100%; background: transparent !important;
                     box-shadow: none !important;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                     </div> 
                     <div class="text-center">
                         <a href="https://www.jvzoo.com/b/111039/406464/2?coupon=FUNNELAI%20&aid=1188867" class="theme-btn-blue mt20">Click for More Info</a>
                         
                     </div>
                     
                </div>
            </div>
        </div>
    </div>

    -->

    <!-- Datepicker JS  -->
    <!-- <script>
        flatpickr("#date_picker", {
            dateFormat: "d-m-Y",
            minDate: "today",
            theme: "dark"
        });
    </script> -->

    <script>
        function toggleArrowVisibility() {
            const subMenu = document.querySelector('.under-sub-menu');
            const arrow = document.querySelector('.nav-down-arrow');

            if (!subMenu || !arrow) return;

            const isScrollable = subMenu.scrollHeight - subMenu.clientHeight > 1;

            arrow.style.opacity = isScrollable ? '1' : '0';
            arrow.style.pointerEvents = isScrollable ? 'all' : 'none';
        }
        window.addEventListener('load', toggleArrowVisibility);
        window.addEventListener('resize', toggleArrowVisibility);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const scrollBtn = document.querySelector(".nav-down-arrow");
            const menu = document.querySelector(".under-sub-menu");

            if (!scrollBtn || !menu) return;

            scrollBtn.addEventListener("click", function () {
                menu.scrollBy({ top: 120, behavior: "smooth" });
            });

            menu.addEventListener("scroll", function () {
                const isBottom =
                    menu.scrollTop + menu.clientHeight >= menu.scrollHeight - 5;

                // scrollBtn.style.display = isBottom ? "none" : "flex";
            });
        });
    </script>


    <script>
        // code by raj for sidebar dropdown menu
        $(document).ready(function () {
            $(".nav-item.has-dropdown > .dropdown-toggle").click(function (e) {
                e.preventDefault();

                // Toggle only the clicked dropdown
                $(this).next(".dropdown-menu").stop().slideToggle();
                $(this).parent().toggleClass("active");
            });
        });
    </script>
    <script>
        $(document).ready(function () {


            function hexToRgba(hex, alpha = 1) {

                hex = hex.replace(/^#/, '');
                let r = parseInt(hex.substring(0, 2), 16);
                let g = parseInt(hex.substring(2, 4), 16);
                let b = parseInt(hex.substring(4, 6), 16);

                // Return the RGBA color
                return `rgba(${r}, ${g}, ${b}, ${alpha})`;
            }

            // Theme Color Set 
            // Get the data-theme-color attribute value from the body
            const themeColor = $('body').data('theme-color');
            const themeStyle = $('body').data('theme-style');
            if (themeColor) {
                // Update the CSS :root variables
                const root = document.documentElement;
                if (themeColor != "") {
                    const variables = [
                        '--primary-color',
                        '--primary-hover',
                        '--primary-color2',
                        '--primary-color3',
                        '--primary-color4',
                        '--primary-color5',
                        '--primary-color6',
                        '--primary-color7',
                        '--theme-br2',
                        '--blue-gradient',
                        '--blue-gradient2',
                    ];
                    variables.forEach(variable => {
                        root.style.setProperty(variable, themeColor);
                    });
                    root.style.setProperty('--btn-color', '#fff');


                    for (let i = 1; i <= 9; i++) {
                        const alpha = i / 10;
                        root.style.setProperty(`--rgba-primary-${i}`, hexToRgba(themeColor, alpha));
                    }
                }

            }
            // Theme Color Set 

            //  if (themeStyle) {
            //     // Update the CSS :root variables
            //     const root = document.documentElement;
            //     if (themeStyle != "") {
            //         const variables = [
            //             '--primary-color',
            //             '--primary-hover',
            //             '--primary-color2',
            //             '--primary-color3',
            //             '--primary-color4',
            //             '--primary-color5',
            //             '--primary-color6',
            //             '--primary-color7',
            //             '--theme-br2',
            //             '--blue-gradient',
            //             '--blue-gradient2',
            //         ];
            //         variables.forEach(variable => {
            //             root.style.setProperty(variable, themeStyle);
            //         });
            //         root.style.setProperty('--btn-color', '#fff');


            //         for (let i = 1; i <= 9; i++) {
            //             const alpha = i / 10;
            //             root.style.setProperty(`--rgba-primary-${i}`, hexToRgba(themeStyle, alpha));
            //         }
            //     }

            // }
            // Theme style Set 


            $('.toggle-sidebar').on('click', function () {
                // Toggle the class on the <i> tag inside the anchor
                $(this).find('i').toggleClass('fa-chevron-left fa-chevron-right');

                // Toggle the 'sidebar-hidden' class on the <body>
                $('body').toggleClass('sidebar-hidden');
            });


            $('.gt_option a, .gt_selected a').each(function () {
                var text = $(this).text();
                let result = text.substring(0, 4);
                var imgHtml = $(this).find('img').prop('outerHTML'); // Get the outerHTML of the <img> tag
                $(this).html(imgHtml + ' ' + result); // Update the HTML content of <a> element
            });
        });
    </script>
    <script>
        var siteUrl = '<?php echo base_url(); ?>';
        $(document).ready(function () {

            if (<?= $this->session->userdata('dashboardModal') ?> == 0) {
                $("#dashboardModal").modal("show");
                // sessionStorage.setItem("dashboardModal", true);
                <?php $this->session->set_userdata('dashboardModal', 1); ?>
            }

            $('#dashboardModal').find('.btn-close').on('click', function () {
                $("#dashboardModal").modal("hide");
            });



        });


        /* $(document).ready(function () {
        window.zESettings = {
        webWidget: {
        zIndex: 999999,
        launcher: {
        chatLabel: {
        '*': 'Help?'
        }
        },
        offset: {
        horizontal: '70px',
        mobile: {
        horizontal: '0px',
        }
        }
        }
        };
        }); */
        window.onresize = function (event) {
            //check for width and if lower than 600: hide
            // if (window.innerWidth <= 767){
            //   zE('webWidget', 'hide');
            // } else {
            //   zE('webWidget', 'show');
            // }
        };
    </script>

    <!-- End of dotcompal Zendesk Widget script -->

    <script>
        // $(document).on('#buinessHeaderSearch','click',function(){
        //     getBusinesslist(val);
        // })
        getBusinesslist();

        function getBusinesslist() {
            var val = $('#getBusinesslist').val();
            $.ajax({
                type: "POST",
                url: siteUrl + "getbusinessheader",
                data: {
                    'business': val
                },
                dataType: "json",
                success: function (response) {
                    $('#addBusinesslist').html('');
                    if (response.status == 1) {
                        $('#addBusinesslist').html(response.html);
                        if (response.type == 'search') {
                            $('#headerDrop').trigger('click');
                        }
                    }
                    console.log(response.status);
                }
            });
        }
        //  remaining_credit
        function remainingCredit() {
            $.ajax({
                type: "POST",
                url: siteUrl + "dashboard/get-credit",
                dataType: "json",
                success: function (response) {
                    $('.credits-count').html(response.html);
                }
            });
        }


        function getNewLeads() {
            $.ajax({
                type: "POST",
                url: siteUrl + "dashboard/get-newlead-count",
                dataType: "json",
                success: function (response) {
                    if ($.trim(response.html) != "" && parseInt(response.html) > 0) {
                        if (response.html !== "" && parseInt(response.html) > 0) {
                            $('.new-leads').html("<span class='badge'>New</span>");
                            $('.new-leads_count').html("<span class='badge'>" + response.html + "</span>");
                        } else {
                            $('.new-leads').html("");
                            $('.new-leads_count').html("");
                        }
                    }
                }
            });
        }
        $(function () {
            remainingCredit();
            getNewLeads();
        })



        $('#getBusinesslist').on('keyup', function (e) {
            getBusinesslist();
            // var code = e.keyCode || e.which;
            // if (code == 13) {
            //      jsLoader(true);
            //      getBusinesslist();
            //      jsLoader(false);
            // }
        });
    </script>
    <!--<script>-->

    <!--$("#demo").css({-->
    <!--    "background-color": "#F1F1F1",-->
    <!--    "font-style"     : "italic"-->
    <!--});-->
    <script>
        $("#chat_bot").on('click', function () {
            $('.sub-child ').toggleClass("dropOn");
        });


        $(function () {
            setInterval(function () {
                if (window.location.hostname.indexOf('dotcompallocal.com') > -1) {
                    $('iframe').filter(function () {
                        if (typeof $(this).attr('src') !== 'undefined') {
                            if ($(this).attr('src').indexOf('video/embed') > -1) {
                                $(this).remove();
                            }
                        }
                    })
                }
            }, 3000);
        })

        function loadImage(ele) {
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
                document.getElementById('imageShow').src = window.URL.createObjectURL(ele.files[0]);
            }
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })



        function myFunction() {
            var x = document.getElementById("myICON");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        $(".rotate").click(function () {
            $('.rotateButton').toggleClass("down");
        })

        $(".rotate1").click(function () {
            $(this).toggleClass("down");
        })

        $(".rotate-new").click(function () {
            $('.rotateButton1').toggleClass("down");
        })

        $(".rotate-new1").click(function () {
            $(this).toggleClass("down");
        })
    </script>

    <script>
        $("#my_temp").on('click', function () {
            $('.sub-child1 ').toggleClass("dropOn");
        });
        $(".right-btn").on('click', function () {
            $('.right-sidebar').toggleClass("slideOn");
        });
    </script>
    <script>
        $("#template-pages").on('click', function () {
            $(this).closest('.sub-child').toggleClass("dropOn");
        });

        function show_msg(msg) {
            flashNow({ error: { message: msg } });
        }
    </script>

    <script type="text/javascript">
        window.NREUM || (NREUM = {});
        NREUM.info = {
            "beacon": "bam.nr-data.net",
            "licenseKey": "NRJS-761ca8752795809f11f",
            "applicationID": "1018670871",
            "transactionName": "ZAMEbRECXkFWWkUKC11JJ1oXCl9cGG9YBhMcDwhdBhs=",
            "queueTime": 0,
            "applicationTime": 1306,
            "atts": "SEQHG1kYTU8=",
            "errorBeacon": "bam.nr-data.net",
            "agent": ""
        }
    </script>