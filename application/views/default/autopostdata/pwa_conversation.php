<title><?php echo $this->config->item('productName') ?> | Conversation</title>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png">
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
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/jquery.datetimepicker.css" />
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/daterangepicker.css" />
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/swiper-bundle-min.css" />
    <link href="<?= $this->config->item('assetsPath') ?>/default/plugins/summernote/summernote-lite.min.css"
        rel="stylesheet">

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
    <script src="<?= $this->config->item('assetsPath') ?>js/moment.min.js" type="text/javascript"></script>
    <script src="<?= $this->config->item('assetsPath') ?>js/daterangepicker.min.js" type="text/javascript"></script>
    <script src="<?= $this->config->item('assetsPath') ?>js/jquery.datetimepicker.js" type="text/javascript"></script>
    <script src="<?= $this->config->item('assetsPath') ?>js/jquery.magnific-popup.min.js"
        type="text/javascript"></script>

    <script type='text/javascript' src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type='text/javascript'
        src="<?= $this->config->item('assetsPath') ?>js/dataTables.bootstrap5.min.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/swiper-bundle-min.js"></script>
    <!-- Summer Note Js  -->
    <script src="<?= $this->config->item('assetsPath') ?>/default/plugins/summernote/summernote-lite.min.js"></script>
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

        /* pwa */

        .container-wrapper,
        .container-padding {
            height: 100% !important;
            min-height: 100% !important;
        }

        @media (max-width: 991px) {
            .container-wrapper {
                padding-top: 0;
            }
        }

        .header-stripe {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            left: 0;
            top: 0;
            padding: 13px 25px;
            background: linear-gradient(165.3deg, #DB1A1A 16.71%, #9D1111 96.38%);
            z-index: 1;

            @media screen and (max-width: 991px) {
                top: 0px;
            }

            .logo {
                width: 40px;
                height: 40px;

                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }

            p {
                font-size: 18px;
                font-weight: 600;
                color: var(--text-light);
                margin: 0;
            }
        }

        .ai-command-section {
            inset: 0;
            background-image: url('/app/assets/images/pre-pwa-bg.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body class="h-100">

    <div class="container-wrapper container-open pwa-container" ng-app="AppModule" ng-controller="PostController">
        <div class="container-fluid container-padding p-0">
            <div class="header-stripe" ng-show="isChatActive">
                <div class="d-flex align-items-center">
                    <div class="logo me-2">
                        <img src="<?php echo $this->config->item('assetsPath') ?>images/post-gen-logo.png" alt="logo">
                    </div>
                    <p>Tube Claw AI</p>
                </div>
                <!-- <a href="javascript:void(0);" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#integrationModal">Integration</a> -->
            </div>
            <section class="ai-command-section style-pwa" ng-class="{'chat-wrapper-active': isChatActive}">
                <div class="row h-100 w-100">
                    <div class="col-12 h-100 p-0">
                        <div class="ai-command-inner">
                            <div class="ai-command-header mt-auto">
                                <div class="ai-command-icon">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/post-gen-logo.png"
                                        alt="Post Gen Logo">
                                </div>

                                <h2 class="ai-command-title">
                                    <span class="text-primary">Tube</span> Claw AI
                                </h2>

                                <p class="ai-command-description">
                                    Chat with an AI Agent to Create, Schedule & Publish AI Videos & Avatars.
                                </p>
                            </div>

                            <!-- CHAT AREA -->
                            <div class="post-chat-wrapper">
                                <!--<div class="post-chat-container">-->
                                <!-- RIGHT -->
                                <!--    <div class="chat-message chat-message-right">-->
                                <!--        <div class="chat-bubble">-->
                                <!--            <p>Hey Social Agent, post 5 viral reels on Instagram & YouTube tomorrow about ‘Stoic Wisdom’ at 10 AM...</p>-->
                                <!--        </div>-->
                                <!--        <div class="chat-avatar">-->
                                <!--            <img src="https://i.pravatar.cc/40" alt="">-->
                                <!--        </div>-->
                                <!--    </div>-->

                                <!-- LEFT -->
                                <!--    <div class="chat-message chat-message-left">-->
                                <!--        <div class="chat-avatar">-->
                                <!--            <img src="https://i.pravatar.cc/40" alt="">-->
                                <!--        </div>-->
                                <!--        <div class="chat-card">-->
                                <!--            <div class="chat-content">-->
                                <!--                <h6 class="chat-title">Your content is ready to go live</h6>-->
                                <!--                <div class="d-flex align-items-center gap-1">-->
                                <!--                    Just one step left - -->
                                <!--                    <a href="javascript:void(0);" class="btn btn-primary">-->
                                <!--                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                <!--                            <path d="M0.787819 4.33566C0.850897 4.55193 0.938433 4.76047 1.04914 4.95614L0.733752 5.35392C0.630767 5.48394 0.642353 5.66931 0.758211 5.78646L1.30145 6.3297C1.4186 6.44684 1.60397 6.45713 1.73399 6.35415L2.12919 6.04133C2.33259 6.15849 2.54885 6.24987 2.77413 6.31424L2.83335 6.82272C2.85266 6.9875 2.99169 7.11108 3.15646 7.11108H3.92498C4.08976 7.11108 4.22879 6.98749 4.2481 6.82272L4.30474 6.33226C4.54675 6.26918 4.77847 6.17521 4.99602 6.05292L5.37835 6.35543C5.50837 6.45842 5.69374 6.44683 5.81089 6.33097L6.35413 5.78773C6.47128 5.67059 6.48157 5.48521 6.37859 5.3552L6.08122 4.97801C6.2048 4.76431 6.30135 4.53647 6.36572 4.29832L6.824 4.24554C6.98879 4.22623 7.11236 4.0872 7.11236 3.92242V3.1539C7.11236 2.98913 6.98877 2.8501 6.824 2.83079L6.37215 2.77801C6.31035 2.54243 6.21768 2.31715 6.09926 2.10603L6.37732 1.7546C6.4803 1.62458 6.46871 1.43921 6.35286 1.32206L5.8109 0.780108C5.69376 0.662963 5.50838 0.652664 5.37837 0.755649L5.03723 1.02598C4.81581 0.895965 4.57894 0.796843 4.3305 0.729903L4.27901 0.288357C4.2597 0.123581 4.12067 0 3.95589 0H3.18737C3.0226 0 2.88357 0.123581 2.86426 0.288357L2.81276 0.729903C2.55788 0.79813 2.31458 0.901115 2.08801 1.03628L1.734 0.755649C1.60398 0.652664 1.41861 0.66425 1.30147 0.780108L0.758223 1.32335C0.641079 1.4405 0.63078 1.62587 0.733765 1.75589L1.02985 2.13049C0.911413 2.34419 0.821301 2.57204 0.762085 2.8089L0.288357 2.86297C0.123581 2.88228 0 3.02131 0 3.18608V3.95461C0 4.11938 0.123581 4.25841 0.288357 4.27772L0.787819 4.33566ZM3.57226 2.25666C4.27256 2.25666 4.84283 2.82694 4.84283 3.52723C4.84283 4.22753 4.27256 4.7978 3.57226 4.7978C2.87198 4.7978 2.30169 4.22753 2.30169 3.52723C2.30169 2.82694 2.87197 2.25666 3.57226 2.25666Z" fill="white"/>-->
                                <!--                            <path d="M11.17 4.52411L10.7645 4.18169C10.6396 4.07613 10.4555 4.08128 10.3371 4.19327L10.1131 4.40311C9.92389 4.31171 9.72307 4.24734 9.5158 4.21001L9.45275 3.90106C9.42057 3.74143 9.27253 3.63072 9.1103 3.64359L8.58122 3.68865C8.41902 3.70281 8.29158 3.8354 8.28643 3.99889L8.27614 4.31299C8.07273 4.38637 7.88093 4.48678 7.70585 4.61294L7.43811 4.43529C7.30163 4.34518 7.12013 4.37092 7.01458 4.49579L6.67216 4.90387C6.56659 5.02874 6.57173 5.21282 6.68372 5.33125L6.91802 5.58098C6.83691 5.76378 6.77898 5.9556 6.74552 6.15254L6.41082 6.22077C6.2512 6.25295 6.14049 6.40099 6.15336 6.56321L6.19842 7.09229C6.21258 7.25449 6.34517 7.38193 6.50866 7.38708L6.87039 7.39865C6.93607 7.57115 7.0223 7.73465 7.12656 7.88783L6.92447 8.19292C6.83436 8.32938 6.8601 8.51089 6.98496 8.61645L7.39046 8.95887C7.51534 9.06443 7.69942 9.05928 7.81786 8.94728L8.08305 8.69883C8.25683 8.77993 8.43962 8.84044 8.62756 8.87648L8.70095 9.2395C8.73314 9.39913 8.88118 9.50984 9.04338 9.49696L9.57246 9.45191C9.73466 9.43775 9.8621 9.30517 9.86725 9.14167L9.87884 8.78636C10.0719 8.71813 10.2547 8.62544 10.4234 8.51089L10.7156 8.70398C10.852 8.79409 11.0335 8.76835 11.1391 8.64348L11.4815 8.23798C11.5871 8.11311 11.5819 7.92902 11.4699 7.81059L11.2344 7.56087C11.3206 7.37807 11.3837 7.18497 11.4197 6.98672L11.7416 6.92106C11.9012 6.88888 12.0119 6.74084 11.999 6.57863L11.954 6.04954C11.9398 5.88734 11.8072 5.7599 11.6437 5.75475L11.3206 5.74445C11.2537 5.55651 11.1635 5.37887 11.0516 5.21408L11.2279 4.9489C11.3206 4.81247 11.2949 4.62967 11.17 4.52411ZM9.17597 7.58274C8.6044 7.63167 8.09975 7.20556 8.05214 6.63401C8.00321 6.06244 8.42933 5.55781 9.00087 5.51018C9.57243 5.46126 10.0771 5.88737 10.1247 6.45892C10.1736 7.0305 9.74751 7.53512 9.17597 7.58274Z" fill="white"/>-->
                                <!--                            <path d="M2.63992 9.00652C2.47771 9.02325 2.35285 9.15969 2.35156 9.3232L2.3477 9.64888C2.34512 9.81237 2.46613 9.9514 2.62833 9.97201L2.86777 10.0029C2.90767 10.1484 2.96432 10.2874 3.03769 10.4187L2.88322 10.6092C2.78023 10.7367 2.78796 10.9195 2.90253 11.0366L3.13038 11.2696C3.24495 11.3868 3.42775 11.3996 3.55776 11.2992L3.74956 11.1512C3.88473 11.231 4.02763 11.2941 4.17695 11.3378L4.20269 11.585C4.21943 11.7472 4.35588 11.8721 4.51937 11.8734L4.84507 11.8772C5.00855 11.8798 5.14759 11.7588 5.16818 11.5966L5.19779 11.3623C5.36001 11.3224 5.51448 11.2619 5.66122 11.1821L5.84145 11.3275C5.96889 11.4305 6.1517 11.4228 6.26884 11.3082L6.50185 11.0804C6.61899 10.9658 6.63186 10.783 6.53147 10.653L6.3937 10.474C6.47866 10.3324 6.54433 10.1818 6.58938 10.0235L6.80308 10.0016C6.96528 9.98487 7.09013 9.84842 7.09143 9.68493L7.09528 9.35923C7.09787 9.19575 6.97686 9.05671 6.81466 9.03611L6.60611 9.00908C6.5662 8.85203 6.507 8.70013 6.42976 8.55852L6.55978 8.3989C6.66276 8.27145 6.65504 8.08866 6.54047 7.97151L6.31263 7.73851C6.19806 7.62135 6.01523 7.60848 5.88523 7.7089L5.72945 7.82862C5.58271 7.7398 5.42565 7.67157 5.26088 7.62523L5.24027 7.42312C5.22354 7.2609 5.0871 7.13605 4.9236 7.13476L4.59791 7.1309C4.43442 7.12833 4.29539 7.24933 4.27478 7.41153L4.24903 7.61237C4.07912 7.65612 3.91564 7.72307 3.76373 7.8106L3.60282 7.67929C3.47538 7.57631 3.29257 7.58404 3.17542 7.6986L2.94113 7.92776C2.82399 8.04231 2.81111 8.22512 2.91152 8.35513L3.04927 8.53279C2.96945 8.67439 2.90637 8.82499 2.86518 8.98335L2.63992 9.00652ZM4.74209 8.63834C5.20938 8.64348 5.58397 9.0284 5.57884 9.49569C5.57369 9.96299 5.18877 10.3376 4.72148 10.3324C4.25418 10.3273 3.87959 9.94239 3.88473 9.47508C3.88989 9.0078 4.27479 8.6332 4.74209 8.63834Z" fill="white"/>-->
                                <!--                        </svg>-->
                                <!--                        connect your social accounts-->
                                <!--                    </a>-->
                                <!--                    <a href="javascript:void(0);" class="btn btn-secondary">-->
                                <!--                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                <!--                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.75116 8.43997H3.37607C3.06546 8.43997 2.81332 8.18783 2.81332 7.87723C2.81332 7.56682 3.06546 7.31468 3.37607 7.31468H3.75116V6.93958C3.75116 6.62898 4.0033 6.37684 4.31371 6.37684C4.62432 6.37684 4.87645 6.62898 4.87645 6.93958V7.31468H5.25155C5.56215 7.31468 5.8141 7.56682 5.8141 7.87723C5.8141 8.18783 5.56215 8.43997 5.25155 8.43997H4.87645V8.81507C4.87645 9.12548 4.62432 9.37761 4.31371 9.37761C4.0033 9.37761 3.75116 9.12548 3.75116 8.81507V8.43997ZM0.562742 1.50058C0.562742 1.18998 0.814879 0.93784 1.12548 0.93784C1.4359 0.93784 1.68803 1.18998 1.68803 1.50058V1.83061C2.77952 0.70202 4.30944 0 6.00174 0C9.31409 0 12.0035 2.68939 12.0035 6.00174C12.0035 6.31235 11.7513 6.56449 11.4407 6.56449C11.1301 6.56449 10.878 6.31235 10.878 6.00174C10.878 3.31041 8.69308 1.12549 6.00174 1.12549C4.08605 1.12549 2.42696 2.23271 1.62956 3.84129C1.5134 4.07556 1.25155 4.19891 0.997085 4.13927C0.742618 4.07964 0.562742 3.85276 0.562742 3.59149V1.50058ZM11.4407 10.5029C11.4407 10.8135 11.1886 11.0656 10.878 11.0656C10.5676 11.0656 10.3155 10.8135 10.3155 10.5029V10.1729C9.22396 11.3015 7.69405 12.0035 6.00174 12.0035C2.68939 12.0035 0 9.31409 0 6.00174C0 5.69114 0.252137 5.439 0.562742 5.439C0.873348 5.439 1.12548 5.69114 1.12548 6.00174C1.12548 8.69308 3.31041 10.878 6.00174 10.878C7.91744 10.878 9.57652 9.77078 10.3739 8.16219C10.4901 7.92793 10.7519 7.80458 11.0064 7.86421C11.2609 7.92385 11.4407 8.15073 11.4407 8.412V10.5029ZM7.46716 2.80575L7.98523 4.20571L9.38538 4.72377C9.60625 4.80555 9.75271 5.01612 9.75271 5.25155C9.75271 5.48698 9.60625 5.69755 9.38538 5.77913L7.98523 6.29739L7.46716 7.69735C7.38558 7.91821 7.17501 8.06487 6.93958 8.06487C6.70415 8.06487 6.49358 7.91821 6.4118 7.69735L5.89374 6.29739L4.49359 5.77913C4.27272 5.69755 4.12626 5.48698 4.12626 5.25155C4.12626 5.01612 4.27272 4.80555 4.49359 4.72377L5.89374 4.20571L6.4118 2.80575C6.49358 2.58489 6.70415 2.43823 6.93958 2.43823C7.17501 2.43823 7.38558 2.58489 7.46716 2.80575ZM6.93958 4.62218L6.85936 4.83896C6.80225 4.993 6.68084 5.11441 6.5268 5.17132L6.31021 5.25155L6.5268 5.33178C6.68084 5.38869 6.80225 5.5101 6.85936 5.66414L6.93958 5.88092L7.01961 5.66414C7.07672 5.5101 7.19813 5.38869 7.35217 5.33178L7.56876 5.25155L7.35217 5.17132C7.19813 5.11441 7.07672 4.993 7.01961 4.83896L6.93958 4.62218Z" fill="white"/>-->
                                <!--                        </svg>-->
                                <!--                        Regenerate-->
                                <!--                    </a>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--            <p class="chat-footer">-->
                                <!--                Once connected, I’ll automatically publish and schedule everything for you.-->
                                <!--            </p>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--    <div class="chat-message chat-message-left">-->
                                <!--        <div class="chat-avatar">-->
                                <!--            <img src="https://i.pravatar.cc/40" alt="">-->
                                <!--        </div>-->
                                <!--        <div class="chat-card">-->
                                <!--            <div class="chat-content">-->
                                <!--                <h6 class="chat-title">Here is your Video for viral reels on Instagram & YouTube.</h6>-->
                                <!--                <div class="video-area">-->
                                <!--                    <video controls autoplay>-->
                                <!--                        <source src="movie.mp4" type="video/mp4">-->
                                <!--                        <source src="movie.ogg" type="video/ogg">-->
                                <!--                    </video>-->
                                <!--                </div>-->
                                <!--                <div class="d-flex align-items-center gap-1">-->
                                <!--                    <a href="javascript:void(0);" class="btn btn-primary">-->
                                <!--                        <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                <!--                            <path d="M15.2006 11.8311H4.50149C4.06053 11.8311 3.70312 11.4737 3.70312 11.0327C3.70312 10.5918 4.06053 10.2344 4.50149 10.2344H15.2004C15.6413 10.2344 15.9987 10.5918 15.9987 11.0327C15.9987 11.4737 15.6416 11.8311 15.2006 11.8311Z" fill="white"/>-->
                                <!--                            <path d="M15.2006 6.82329H4.50149C4.06053 6.82329 3.70312 6.46589 3.70312 6.02493C3.70312 5.58396 4.06053 5.22656 4.50149 5.22656H15.2004C15.6413 5.22656 15.9987 5.58396 15.9987 6.02493C15.999 6.46589 15.6416 6.82329 15.2006 6.82329Z" fill="white"/>-->
                                <!--                            <path d="M15.2006 1.80766H4.50149C4.06053 1.80766 3.70312 1.45026 3.70312 1.0093C3.70312 0.568338 4.06053 0.210938 4.50149 0.210938H15.2004C15.6413 0.210938 15.9987 0.568338 15.9987 1.0093C15.9987 1.45026 15.6416 1.80766 15.2006 1.80766Z" fill="white"/>-->
                                <!--                            <path d="M1.0722 2.1444C1.66436 2.1444 2.1444 1.66436 2.1444 1.0722C2.1444 0.480041 1.66436 0 1.0722 0C0.480041 0 0 0.480041 0 1.0722C0 1.66436 0.480041 2.1444 1.0722 2.1444Z" fill="white"/>-->
                                <!--                            <path d="M1.0722 7.08972C1.66436 7.08972 2.1444 6.60967 2.1444 6.01751C2.1444 5.42535 1.66436 4.94531 1.0722 4.94531C0.480041 4.94531 0 5.42535 0 6.01751C0 6.60967 0.480041 7.08972 1.0722 7.08972Z" fill="white"/>-->
                                <!--                            <path d="M1.0722 12.0428C1.66436 12.0428 2.1444 11.5628 2.1444 10.9706C2.1444 10.3785 1.66436 9.89844 1.0722 9.89844C0.480041 9.89844 0 10.3785 0 10.9706C0 11.5628 0.480041 12.0428 1.0722 12.0428Z" fill="white"/>-->
                                <!--                        </svg>-->
                                <!--                        Go To List-->
                                <!--                    </a>-->
                                <!--                    <a href="javascript:void(0);" class="btn btn-secondary">-->
                                <!--                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                <!--                            <path d="M6.16663 5.33337H1.16663C0.523315 5.33337 0 4.81006 0 4.16663V1.16663C0 0.523315 0.523315 0 1.16663 0H6.16663C6.81006 0 7.33337 0.523315 7.33337 1.16663V4.16663C7.33337 4.81006 6.81006 5.33337 6.16663 5.33337ZM1.16663 1C1.07471 1 1 1.07471 1 1.16663V4.16663C1 4.25867 1.07471 4.33337 1.16663 4.33337H6.16663C6.25867 4.33337 6.33337 4.25867 6.33337 4.16663V1.16663C6.33337 1.07471 6.25867 1 6.16663 1H1.16663Z" fill="white"/>-->
                                <!--                            <path d="M6.16663 15.9974H1.16663C0.523315 15.9974 0 15.4741 0 14.8308V7.83081C0 7.18738 0.523315 6.66406 1.16663 6.66406H6.16663C6.81006 6.66406 7.33337 7.18738 7.33337 7.83081V14.8308C7.33337 15.4741 6.81006 15.9974 6.16663 15.9974ZM1.16663 7.66406C1.07471 7.66406 1 7.73877 1 7.83081V14.8308C1 14.9227 1.07471 14.9974 1.16663 14.9974H6.16663C6.25867 14.9974 6.33337 14.9227 6.33337 14.8308V7.83081C6.33337 7.73877 6.25867 7.66406 6.16663 7.66406H1.16663Z" fill="white"/>-->
                                <!--                            <path d="M14.8308 15.9974H9.83081C9.18738 15.9974 8.66406 15.4741 8.66406 14.8308V11.8308C8.66406 11.1874 9.18738 10.6641 9.83081 10.6641H14.8308C15.4741 10.6641 15.9974 11.1874 15.9974 11.8308V14.8308C15.9974 15.4741 15.4741 15.9974 14.8308 15.9974ZM9.83081 11.6641C9.73877 11.6641 9.66406 11.7388 9.66406 11.8308V14.8308C9.66406 14.9227 9.73877 14.9974 9.83081 14.9974H14.8308C14.9227 14.9974 14.9974 14.9227 14.9974 14.8308V11.8308C14.9974 11.7388 14.9227 11.6641 14.8308 11.6641H9.83081Z" fill="white"/>-->
                                <!--                            <path d="M14.8308 9.33337H9.83081C9.18738 9.33337 8.66406 8.81006 8.66406 8.16663V1.16663C8.66406 0.523315 9.18738 0 9.83081 0H14.8308C15.4741 0 15.9974 0.523315 15.9974 1.16663V8.16663C15.9974 8.81006 15.4741 9.33337 14.8308 9.33337ZM9.83081 1C9.73877 1 9.66406 1.07471 9.66406 1.16663V8.16663C9.66406 8.25867 9.73877 8.33337 9.83081 8.33337H14.8308C14.9227 8.33337 14.9974 8.25867 14.9974 8.16663V1.16663C14.9974 1.07471 14.9227 1 14.8308 1H9.83081Z" fill="white"/>-->
                                <!--                        </svg>-->
                                <!--                        Dashboard-->
                                <!--                    </a>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="post-chat-container" id="chatContainer">
                                    <div ng-repeat="msg in messages track by $index">

                                        <!-- USER -->
                                        <div class="chat-message chat-message-right" ng-if="msg.type == 'user'">
                                            <div class="chat-bubble">
                                                <p>{{msg.text}}</p>
                                            </div>
                                            <div class="chat-avatar">
                                                <img src="<?= ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? 'https://tubeclawai.com/app/assets/default/images/default_profile.png' : $this->config->item('bucket_url') . $this->session->userdata('logged_in')['profile_pic'] ?>"
                                                    alt="Product Icon">
                                            </div>
                                        </div>

                                        <!-- BOT TEXT -->
                                        <div class="chat-message chat-message-left"
                                            ng-show="msg.type == 'bot' && !msg.subType && !msg.hidden">
                                            <div class="chat-avatar">
                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png"
                                                    alt="Product Icon">
                                            </div>
                                            <div class="chat-bubble">
                                                <p>
                                                    <span>{{msg.text}}</span>
                                                <div class="theme-loader-dots" ng-if="msg.loading">
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- ❌ INTEGRATION REQUIRED -->
                                        <div class="chat-message chat-message-left"
                                            ng-if="msg.subType == 'integration_required'">
                                            <div class="chat-avatar">
                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png"
                                                    alt="Product Icon">
                                            </div>

                                            <div class="chat-card">
                                                <div class="chat-content">
                                                    <h6 class="chat-title">Your content is ready to go live</h6>

                                                    <div class="d-flex align-items-center gap-1">
                                                        Just one step left -

                                                        <a href="<?php echo base_url('integration') ?>" target="_blank"
                                                            class="btn btn-primary">
                                                            connect your social accounts
                                                        </a>

                                                        <a href="javascript:void(0);" class="btn btn-secondary"
                                                            ng-click="regenerate()">
                                                            Regenerate
                                                        </a>
                                                    </div>
                                                </div>

                                                <p class="chat-footer">
                                                    Once connected, I’ll automatically publish and schedule everything
                                                    for you.
                                                </p>
                                            </div>
                                        </div>

                                        <!--🎥 VIDEO Loader-->
                                        <!--<div class="chat-message chat-message-left" ng-if="msg.subType == 'loader' && msg.subType != 'video'">-->
                                        <!--    <div class="chat-avatar">-->
                                        <!--        <img src="<?php echo $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png" alt="Product Icon">-->
                                        <!--    </div>-->

                                        <!--    <div class="chat-card">-->
                                        <!--        <div class="chat-content">-->
                                        <!--            <h6 class="chat-title">Here is your generated video—your idea has come to life! Keep creating, keep growing, and let this be just the beginning of your success journey 🚀</h6>-->
                                        <!--            <video autoplay muted playsinlinelay style="width:100%; height: 100%; object-fit: cover;">-->
                                        <!--                <source src="https://cdn.socialclawai.com/assets/default/agent-loader.mp4" type="video/mp4">-->
                                        <!--            </video>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->


                                        <!----  ai video and avatar type--->

                                        <div class="chat-message chat-message-left"
                                            ng-if="msg.subType == 'choose_type'">
                                            <div class="chat-avatar">
                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png"
                                                    alt="Icon">
                                            </div>
                                            <div class="chat-bubble">
                                                <p style="Width:100%">{{msg.text}}</p>
                                                <div class="d-flex gap-2 mt-2">
                                                    <button class="btn btn-primary btn-sm"
                                                        ng-click="generatePost('avatar')">
                                                        <i class="fa-solid fa-user-tie"></i> Talking Avatar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" ng-click="generatePost('ai')">
                                                        <i class="fa-solid fa-clapperboard"></i> AI Cinematic Video
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 🎥 VIDEO -->
                                        <div class="chat-message chat-message-left" ng-if="msg.subType == 'video'">
                                            <div class="chat-avatar">
                                                <img src="<?php echo $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png"
                                                    alt="Product Icon">
                                            </div>

                                            <div class="chat-card">
                                                <div class="chat-content">
                                                    <h6 class="chat-title">Here is your generated video—your idea has
                                                        come to life! Keep creating, keep growing, and let this be just
                                                        the beginning of your success journey 🚀</h6>
                                                    <div class="video-area">
                                                        <video autoplay controls playsinline loop>
                                                            <source ng-src="{{msg.video}}" type="video/mp4">
                                                        </video>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-center gap-1 mt-2">
                                                        <!--<a href="<?php echo base_url('automation'); ?>"-->
                                                        <!--    class="btn btn-primary">-->
                                                        <!--    <svg width="16" height="13" viewBox="0 0 16 13" fill="none"-->
                                                        <!--        xmlns="http://www.w3.org/2000/svg">-->
                                                        <!--        <path-->
                                                        <!--            d="M15.2006 11.8311H4.50149C4.06053 11.8311 3.70312 11.4737 3.70312 11.0327C3.70312 10.5918 4.06053 10.2344 4.50149 10.2344H15.2004C15.6413 10.2344 15.9987 10.5918 15.9987 11.0327C15.9987 11.4737 15.6416 11.8311 15.2006 11.8311Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M15.2006 6.82329H4.50149C4.06053 6.82329 3.70312 6.46589 3.70312 6.02493C3.70312 5.58396 4.06053 5.22656 4.50149 5.22656H15.2004C15.6413 5.22656 15.9987 5.58396 15.9987 6.02493C15.999 6.46589 15.6416 6.82329 15.2006 6.82329Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M15.2006 1.80766H4.50149C4.06053 1.80766 3.70312 1.45026 3.70312 1.0093C3.70312 0.568338 4.06053 0.210938 4.50149 0.210938H15.2004C15.6413 0.210938 15.9987 0.568338 15.9987 1.0093C15.9987 1.45026 15.6416 1.80766 15.2006 1.80766Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M1.0722 2.1444C1.66436 2.1444 2.1444 1.66436 2.1444 1.0722C2.1444 0.480041 1.66436 0 1.0722 0C0.480041 0 0 0.480041 0 1.0722C0 1.66436 0.480041 2.1444 1.0722 2.1444Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M1.0722 7.08972C1.66436 7.08972 2.1444 6.60967 2.1444 6.01751C2.1444 5.42535 1.66436 4.94531 1.0722 4.94531C0.480041 4.94531 0 5.42535 0 6.01751C0 6.60967 0.480041 7.08972 1.0722 7.08972Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M1.0722 12.0428C1.66436 12.0428 2.1444 11.5628 2.1444 10.9706C2.1444 10.3785 1.66436 9.89844 1.0722 9.89844C0.480041 9.89844 0 10.3785 0 10.9706C0 11.5628 0.480041 12.0428 1.0722 12.0428Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--    </svg>-->
                                                        <!--    Go To List-->
                                                        <!--</a>-->
                                                        <!--<a href="<?php echo base_url('dashboard'); ?>"-->
                                                        <!--    class="btn btn-secondary">-->
                                                        <!--    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"-->
                                                        <!--        xmlns="http://www.w3.org/2000/svg">-->
                                                        <!--        <path-->
                                                        <!--            d="M6.16663 5.33337H1.16663C0.523315 5.33337 0 4.81006 0 4.16663V1.16663C0 0.523315 0.523315 0 1.16663 0H6.16663C6.81006 0 7.33337 0.523315 7.33337 1.16663V4.16663C7.33337 4.81006 6.81006 5.33337 6.16663 5.33337ZM1.16663 1C1.07471 1 1 1.07471 1 1.16663V4.16663C1 4.25867 1.07471 4.33337 1.16663 4.33337H6.16663C6.25867 4.33337 6.33337 4.25867 6.33337 4.16663V1.16663C6.33337 1.07471 6.25867 1 6.16663 1H1.16663Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M6.16663 15.9974H1.16663C0.523315 15.9974 0 15.4741 0 14.8308V7.83081C0 7.18738 0.523315 6.66406 1.16663 6.66406H6.16663C6.81006 6.66406 7.33337 7.18738 7.33337 7.83081V14.8308C7.33337 15.4741 6.81006 15.9974 6.16663 15.9974ZM1.16663 7.66406C1.07471 7.66406 1 7.73877 1 7.83081V14.8308C1 14.9227 1.07471 14.9974 1.16663 14.9974H6.16663C6.25867 14.9974 6.33337 14.9227 6.33337 14.8308V7.83081C6.33337 7.73877 6.25867 7.66406 6.16663 7.66406H1.16663Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M14.8308 15.9974H9.83081C9.18738 15.9974 8.66406 15.4741 8.66406 14.8308V11.8308C8.66406 11.1874 9.18738 10.6641 9.83081 10.6641H14.8308C15.4741 10.6641 15.9974 11.1874 15.9974 11.8308V14.8308C15.9974 15.4741 15.4741 15.9974 14.8308 15.9974ZM9.83081 11.6641C9.73877 11.6641 9.66406 11.7388 9.66406 11.8308V14.8308C9.66406 14.9227 9.73877 14.9974 9.83081 14.9974H14.8308C14.9227 14.9974 14.9974 14.9227 14.9974 14.8308V11.8308C14.9974 11.7388 14.9227 11.6641 14.8308 11.6641H9.83081Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--        <path-->
                                                        <!--            d="M14.8308 9.33337H9.83081C9.18738 9.33337 8.66406 8.81006 8.66406 8.16663V1.16663C8.66406 0.523315 9.18738 0 9.83081 0H14.8308C15.4741 0 15.9974 0.523315 15.9974 1.16663V8.16663C15.9974 8.81006 15.4741 9.33337 14.8308 9.33337ZM9.83081 1C9.73877 1 9.66406 1.07471 9.66406 1.16663V8.16663C9.66406 8.25867 9.73877 8.33337 9.83081 8.33337H14.8308C14.9227 8.33337 14.9974 8.25867 14.9974 8.16663V1.16663C14.9974 1.07471 14.9227 1 14.8308 1H9.83081Z"-->
                                                        <!--            fill="white" />-->
                                                        <!--    </svg>-->
                                                        <!--    Dashboard-->
                                                        <!--</a>-->
                                                        
                                                        <a href="javascript:void(0)"ng-click="downloadVideo(msg.downloadUrl)" class="btn btn-secondary">
                                                            <i class="fa-solid fa-download"></i>
                                                            Download
                                                            
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Input Box -->
                            <div class="ai-command-box">

                                <div class="ai-command-mic" ng-click="startListening()">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9 0C7.13672 0 5.625 1.51172 5.625 3.375V9C5.625 10.8633 7.13672 12.375 9 12.375C10.8633 12.375 12.375 10.8633 12.375 9V3.375C12.375 1.51172 10.8633 0 9 0ZM4.5 7.59375C4.5 7.12617 4.12383 6.75 3.65625 6.75C3.18867 6.75 2.8125 7.12617 2.8125 7.59375V9C2.8125 12.1324 5.13984 14.7199 8.15625 15.1312V16.3125H6.46875C6.00117 16.3125 5.625 16.6887 5.625 17.1562C5.625 17.6238 6.00117 18 6.46875 18H9H11.5312C11.9988 18 12.375 17.6238 12.375 17.1562C12.375 16.6887 11.9988 16.3125 11.5312 16.3125H9.84375V15.1312C12.8602 14.7199 15.1875 12.1324 15.1875 9V7.59375C15.1875 7.12617 14.8113 6.75 14.3438 6.75C13.8762 6.75 13.5 7.12617 13.5 7.59375V9C13.5 11.4855 11.4855 13.5 9 13.5C6.51445 13.5 4.5 11.4855 4.5 9V7.59375Z"
                                            fill="white" />
                                    </svg>

                                </div>

                                <textarea ng-keydown="checkEnter($event)" class="ai-command-input"
                                    placeholder=" Enter Your Prompt..." ng-model="commandText"></textarea>

                                <button class="ai-command-button" ng-click="generatePost()">
                                    <span>Run Command</span> <i class="fa-solid fa-play"></i>
                                </button>

                            </div>
                            <!-- Social Status -->
                            <div class="ai-social-wrapper mt-auto d-none">
                                <div class="ai-social-item">
                                    <i class="fa-brands fa-instagram"></i>
                                    <span class="label">Instagram</span>
                                </div>
                                <div class="divider"></div>
                                <div class="ai-social-item">
                                    <i class="fa-brands fa-facebook"></i>
                                    <span class="label">Facebook</span>
                                </div>
                                <div class="divider"></div>
                                <div class="ai-social-item">
                                    <i class="fa-brands fa-square-youtube"></i>
                                    <span class="label">YouTube</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
   <script>
     var baseUrl = '<?= base_url() ?>';

    var app = angular.module("AppModule", []);

    app.controller("PostController", function ($scope, $http, $timeout, $sce) {
        $scope.commandText = "";
        $scope.videodata = ""
        $scope.isChatActive = false;
        $scope.messages = [];
        $scope.pendingPrompt = "";
        $scope.selectedVideoType = "";
        $scope.dashboardpromt = "<?php echo isset($prompt) ? trim($prompt) : ''; ?>";
        $scope.completedVideos = {};
        
        if ($scope.dashboardpromt && $scope.dashboardpromt.length > 0) {
            $timeout(function () {
                $scope.commandText = $scope.dashboardpromt;
                $scope.generatePost();
            }, 100); 
        }
        
            
    $scope.checkEnter = function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // new line rokne ke liye
            $scope.generatePost();  // button ka kaam
        }
    };
 
    
    
          $scope.downloadVideo = function(url) {
                if (!url) {
                    toastr.error("Video URL not found.");
                    return;
                }
                fetch(url)
                    .then(response => response.blob())
                    .then(blob => {
                        const blobUrl = window.URL.createObjectURL(blob);
            
                        const link = document.createElement("a");
                        link.href = blobUrl;
                        link.download = "video." + 'mp4';
            
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
            
                        window.URL.revokeObjectURL(blobUrl);
                    })
                    .catch(error => {
                        console.error(error);
                        toastr.error("Unable to download file.");
                    });
            };
    $scope.generatePost = function(selectedType){ 
    // Agar user ne button par click kiya hai toh selectedType pass hoga
    let videoType = selectedType ? selectedType : ''; 
    let prompt = "";
   
    if (!videoType) { 
        // Pehli baar jab user input box se run karega
        if (!$scope.commandText) {
            flashNow({ error: { message: "Please Enter prompt." } });
            return;
        }
        $scope.isChatActive = true;
        prompt = $scope.commandText;
        $scope.pendingPrompt = prompt; // Backup for step 2
        
        $scope.messages.push({
            type: 'user',
            text: prompt
        });
        $scope.commandText = "";
    } else { 
        // Jab user Avatar/AI ke button par click karega
        prompt = $scope.pendingPrompt;
        $scope.selectedVideoType = videoType;
        // Buttons ko disabled/hide karne ke liye subtype badal do
        let lastMsg = $scope.messages[$scope.messages.length - 1];
        if (lastMsg && lastMsg.subType === 'choose_type') {
            lastMsg.subType = 'processed_choice';
        }
    }

    jsLoader(true);
    var queryStr = "<?php echo base_url('pwa-auto-post-generator')?>";  
    $http({
        method: 'POST',
        url: queryStr,
        data: { 
            prompt: prompt,
            video_type: videoType // Pehli baar khali jaega, doosri baar 'avatar' ya 'ai' jaega
        }
    }).then(function (response) {
        console.log(response);
        jsLoader(false);
        
        // CASE 1: Normal Chat Reply
        if (response.data.success && response.data.status === 'chat_reply') {
            $scope.messages.push({
                type: 'bot',
                text: response.data.message
            });
            $scope.scrollToBottom();
        }

        // CASE 2: Ask user for selection (Avatar or AI Video)
        if (response.data.success && response.data.status === 'ask_type') {
            $scope.messages.push({
                type: 'bot',
                subType: 'choose_type',
                text: "How would you like to create a video for this topic? Please choose one of the following options:"
            });
            $scope.scrollToBottom();
        }

        // CASE 3: Integration Required Error
        if (!response.data.success && response.data.integration_required) {
            $scope.messages.push({
                type: 'bot',
                subType: 'integration_required'
            });
            return;
        }
        
        
        // CASE 4: Error Message
            if (!response.data.success && response.data.message) {
                $scope.messages.push({
                    type: 'bot',
                    text: response.data.message
                });
                $scope.scrollToBottom();
                return;
            }

        // CASE 5: Final Success (Video generation started)
        if (response.data.success && response.data.status === 'video_started') {
            $scope.messages.push({
                type: 'bot',
                text: response.data.message,
                loading: response.data.loading
            });
            $scope.scrollToBottom();
            if(response.data.insert_id){
                $scope.getvideodata();
            }
        }
    });
};



    // 🔁 REGENERATE
    $scope.regenerate = function () {
        $scope.commandText = $scope.lastUserPrompt;
        $scope.generatePost();
    };
    
     
        
        $scope.getvideodata = function () {
            var queryStr = "<?php echo base_url('pwa-get-video-id')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    // console.log('response', response); 
                    if (response.data.status == true) {
                        $scope.videodata = response.data.data;
                        $scope.startGeneratingVideos();
                    } else {
                          $scope.videodata = response.data.data;
                       
                    }
                });
            };
            
            $scope.getvideodata();

        
        $scope.startGeneratingVideos = function() {
            let video = $scope.videodata;
            if (!video || !video.video_id) {
                return;
            }
            
            $scope.getGeneratevAvtarVideoById(video);
        };
        
        $scope.getGeneratevAvtarVideoById = function(video) {
            let id = video.id;
            let video_id = video.video_id;
            var queryStr = "<?php echo base_url('pwa-get-compelete-video')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                     data: {
                        'id':id,
                        'video_id': video_id,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                        // console.log(response);
                    // if(response.data.status == true){
                    //     video.url = response.data.url;
                    //     $scope.getvideodata();
                    //     $scope.social_media_post(video);
                    // } else {
                    //     console.error('Video generation failed.');
                    // }
                    if(response.data.status == true){
                         if($scope.completedVideos[video.id]){
                                return;
                            }
                        
                            $scope.completedVideos[video.id] = true;
                        video.url = response.data.url;
                        video.safeUrl = $sce.trustAsResourceUrl(response.data.url);
                        let lastMsg = $scope.messages[$scope.messages.length - 1];
                        if (lastMsg && lastMsg.type === 'bot') {
                            lastMsg.loading = false;
                            lastMsg.hidden = true; // 👈 YE ADD KARO (important)
                        }
                        // 🎥 CHAT ME VIDEO ADD
                        $scope.messages.push({
                            type: 'bot',
                            subType: 'video',
                            id: video.id,   
                            video: video.safeUrl,
                            downloadUrl: video.url
                        });
                        
                        $scope.scrollToBottom();
                        $scope.getvideodata();
                        $scope.social_media_post(video);
                    }
                });
        }
        
        setInterval(function() {
            $scope.startGeneratingVideos();
        }, 10000);
        
        $scope.social_media_post = function(video) {
            var queryStr = "<?php echo base_url('pwa-post-social-media')?>";
            
            $http({
                method: 'POST',
                url: queryStr,
                async: false,
                data: $.param({
                    'id': video.id,
                    'keyword': video.keyword,
                    'instagram': video.instagram,
                    'facebook': video.facebook,
                    'youtube': video.youtube,
                    'video_url': video.url,
                    'video_id': video.video_id,
                    'schedule': video.schedule,
                    'schedule_time': video.schedule_time
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function(response) {
                if (response.data == true) {
                    
                }
            });
        };
        
        
        $scope.scrollToBottom = function() {
            $timeout(function () {
                var container = document.getElementById("chatContainer");
                if (container) {
                    container.scrollTo({
                        top: container.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            }, 100);
        };
        
        $scope.startListening = function () {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
            if (!SpeechRecognition) {
                alert("Speech Recognition not supported");
                return;
            }
        
            const recognition = new SpeechRecognition();
        
            recognition.lang = navigator.language || 'en-IN';
            recognition.interimResults = true;
            recognition.continuous = true;
        
            let silenceTimer = null;
            let finalTranscript = '';
        
            recognition.start();
        
            // 🔥 Silence timer function
            function resetSilenceTimer() {
                if (silenceTimer) {
                    clearTimeout(silenceTimer);
                }
        
                silenceTimer = setTimeout(() => {
                    recognition.stop(); // ⛔ 2 sec silence → stop
                }, 2000);
            }
        
            // start timer initially
            resetSilenceTimer();
        
            recognition.onresult = function (event) {
                let interimTranscript = '';
        
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    let text = event.results[i][0].transcript;
        
                    if (event.results[i].isFinal) {
                        finalTranscript += text + ' ';
                    } else {
                        interimTranscript += text;
                    }
                }
        
                $scope.$apply(function () {
                    $scope.commandText = finalTranscript + interimTranscript;
                });
        
                // 🔁 jab bhi voice aaye → timer reset
                resetSilenceTimer();
            };
        
            recognition.onerror = function (event) {
                console.error("Speech error:", event.error);
            };
        
            recognition.onend = function () {
                if (silenceTimer) {
                    clearTimeout(silenceTimer);
                }
                console.log("Mic stopped due to silence");
            };
        };
      
      
    //   TELEGRAM CONNECT _ ALSHAT
            $scope.agent_id = <?= json_encode($agent_id); ?>;
            $scope.business_id = <?= json_encode($business_id); ?>;
        
                $scope.connectTelegram = function() {
            
                        // if (!$scope.selected_agent) {
                        //     toastr.error('Please Select an Agent First');
                        //   // Swal.fire('Warning', 'Please Select an Agent First', 'warning');
                        //     return;
                        // }
            
                        if (!$scope.telegram.bot_token) {
                            toastr.error('Please Enter Telegram Bot Token');
                            //Swal.fire('Warning', 'Please Enter Telegram Bot Token', 'warning');
                            return;
                        }
            
                        // Enforce only-one-active rule
                        // $scope.channel.active = false;
                        // $scope.channel.connected = false;
                        // $scope.channel.qr_code = '';
                        // $scope.telegram.active = false;
            
                        var payload = {
                            agent_unique_code: $scope.agent_id,
                            bot_token: $scope.telegram.bot_token,
                            business_id:  $scope.business_id,
                            status: 'active'
                            
                        };
                        
                        console.log(payload);
                        
                        $scope.telegram.loading = true;
            
                        $http({
                            method: 'POST',
                            url: "<?= base_url('telegram-webhook'); ?>",
                            data: $.param(payload),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        }).then(function(response) {
            
                            $scope.telegram.loading = false;
                            
                         
                            if (response.data.success== true) {
            
                                // $scope.telegram.active = true;
                                toastr.success(response.data.message);
                                
                                var modalEl = document.getElementById('integrationModal');
                                var modal = bootstrap.Modal.getInstance(modalEl);
                            
                                if (modal) {
                                    modal.hide();
                                }
                            
                                // Reset Form
                                // $scope.telegram.bot_token = '';
                                $scope.getTelegramIntegration();
                                
            
                            } else {
                             $('#integrationModal').modal('hide');
                            toastr.error(response.data.message || 'Something went wrong');
                                // Swal.fire({
                                //     icon: 'error',
                                //     title: 'Error',
                                //     text: response.data.message || 'Something went wrong'
                                // });
            
                            }
            
                        }).catch(function(error) {
            
                            $scope.telegram.loading = false;
            
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Something went wrong. Please try again.'
                            });
            
                            console.error(error);
            
                        });
            
                    };
                  
                    
                
                
     $scope.telegram = {};
     
     
     $scope.resetTelegram = function() {
    // Confirm karne ke liye alert de sakte hain taaki galti se reset na ho
    if (!confirm("Are you sure you want to reset/disconnect Telegram?")) {
        return;
    }

    var payload = {
        business_id: $scope.business_id
    };

    $scope.telegram.loading = true;

    $http({
        method: 'POST',
        url: "<?= base_url('telegram-reset'); ?>", // Niche diye gaye route ke hisab se badlein
        data: $.param(payload),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).then(function(response) {
        $scope.telegram.loading = false;

        if (response.data.success == true) {
            toastr.success(response.data.message);
            
            // UI level par token khali karein aur connection status false karein
            $scope.telegram.bot_token = '';
            $scope.telegram.is_connected = false;

            // Agar koi modal khula ho to use hide karne ke liye
            var modalEl = document.getElementById('integrationModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) { modal.hide(); }

            // Dobara integration data list fetch karne ke liye (agar koi function ho)
            if (typeof $scope.getTelegramIntegration === "function") {
                $scope.getTelegramIntegration();
            }

        } else {
            toastr.error(response.data.message || 'Reset failed');
        }
    }).catch(function(error) {
        $scope.telegram.loading = false;
        toastr.error('Server error occurred while resetting');
        console.error(error);
    });
};

     $scope.getTelegramIntegration = function () {

    $http({
        method: 'GET',
        url: "<?= base_url('get-telegram-integration'); ?>",
         params: {
            agent_unique_code: $scope.user_id
        }
    }).then(function (response) {

        if (response.data.success) {

            $scope.telegram = response.data.data;
            $scope.telegram.is_connected = true;

        } else {

            $scope.telegram = {
                is_connected: false,
                bot_username: "",
                bot_token: ""
            };
        }

    });

};
$scope.getTelegramIntegration();

});
</script> 
<script>


  /* -----------------Loader -------------------  */
  function jsLoader(add) {
        if (add === undefined) {
            add = false;
        }
        $(".temp_js_loader").remove();
        if (add) {
            $("body").append('<div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="https://shadab.tubeclawai.com/app/assets/images/grabiris_loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; height:100px"></div>');
        }
    };

    function jsLoader(add,status) {
        if (add === undefined) {
            add = false;
        }
        $(".temp_js_loader").remove();
        if (add) {
            $("body").append('<div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="https://shadab.tubeclawai.com/app/assets/images/grabiris_loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; height:100px"></div>');
        }
    };
    
      function jsLoaderText(text,add) {
    if (add === undefined) {
        add = false;
    }
    $(".temp_js_loader_text").remove();
    if (add) {
        $("body").append(`<div class="temp_js_loader_text" style="background: rgba(0, 0, 0, 0.04);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;    z-index: 9999999999 !important;">\
                            <h5 style="position: absolute;top: 63%;left: 50%;color: var(--theme-white) !important;transform: translate(-50%, -50%);">${text}</h5>\
                        </div>`);
    }
};
    
    function jsAvatarLoader(add) {
    if (add === undefined) {
        add = false;
    }
    $(".temp_js_loader").remove();
    if (add) {
        $("body").append(`
            <div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34); width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 9999;">
                <img src="https://shadab.tubeclawai.com/app/assets/images/grabiris_loader.gif" style="position: absolute; margin: auto; top: 0; bottom: 0; left: 0; right: 0; height: 100px;">
                <div style="position: absolute; top: 68%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 16px; text-align: center;">
                    It may take 5–10 minutes. If delayed, please refresh (Ctrl + Shift + R) or try Incognito mode.
                </div>
            </div>
        `);
    }
}
</script>
</body>

</html>