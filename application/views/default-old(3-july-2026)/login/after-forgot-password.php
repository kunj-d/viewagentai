<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->config->item('productName'); ?> Thank You</title>
        <link rel="icon" type="image/x-icon" href="<?= $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap" rel="stylesheet">
        <?php
        $this->load->view('default/login/login-header.php');
        
        $assetsFolder=$this->config->item('assetsTemplatePath');
        
        ?>
       



            <style>

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Inter', sans-serif;
                font-size: 16px;
                font-weight: 400;
                line-height: 1.5;
                color: var(--text-primary);
            }
            img.center-img {
                display: block;
                margin: 0 auto;
            }
            a,
            a:hover {
                text-decoration: none;
                color: var(--primary-color);
            }
            .w600{
                font-weight: 600;
            }

            /* .auth-section {
                background: var(--white-color);
                border-radius: 15px;
                padding: 20px;
                width: 100%;
                max-width: 415px;

            } */

            .heading {
                font-weight: 600;
                font-size: 20px;
                line-height: 24px;
                text-align: center;
                color: #0B161C;
            }

            .sub-heading {
                font-weight: 500;
                font-size: 14px;
                text-align: center;
            }

            .login-wrapper {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0px;
                flex-direction: column;
            }

            a.google-login-btn {
                display: flex;
                align-items: center;
                border-radius: 5px;
                padding: 9px 5px;
                justify-content: center;
                font-size: 12px;
                font-weight: 500;
                text-decoration: none;
                gap: 15px;
                width: 100%;
                color: var(--text-primary);
            }

            a.google-login-btn img {
                height: 22px;
            }

            .line-for {
                font-weight: 400;
                font-size: 14px;
                color: var(--secondary-color3);
                text-align: center;
                position: relative;
                z-index: 1;
            }

            .line-for::before {
                border-top: 1px solid var(--secondary-color2);
                content: "";
                margin: 0 auto;
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                z-index: -1;
            }

            .line-for span {
                display: inline-block;
                background-color: var(--white-color);
                padding: 0 15px;
            }

            /*******Form CSS*******/

            *,
            *:focus {
                outline: none
            }

            .form-item {
                position: relative;
                margin-bottom: 20px
            }

            .form-item input {
                display: block;
                width: 100%;
                height: 40px;
                background: var(--white-color) !important;
                border: solid 1px #D1CFCF ;
                transition: all .3s ease;
                padding: 0 15px;
                border-radius: 5px;
                color: var(--text-primary);
                font-weight: 400;
                font-size: 14px;
            }

            .form-item input:focus {
                border-color: #D1CFCF;
            }

            .mt10 {
                margin-top: 10px;
            }

            .mt15 {
                margin-top: 15px;
            }

            .mb2 {
                margin-bottom: 20px;
            }

            .mt2 {
                margin-top: 20px;
            }

            .mt3 {
                margin-top: 30px;
            }

            .forgot-link.forgot-link.forgot-link.forgot-link.forgot-link.forgot-link.forgot-link.forgot-link {
                font-weight: 500;
                font-size: 16px;
                color: var(--primary-color) !important;
            }

            .capcha-wrapper {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .btn-wrapper a {
                background: var(--primary-color);
                border-radius: 8px;
                font-weight: 600;
                font-size: 14px;
                color: var(--white-color);
                display: flex;
                width: 100%;
                align-items: center;
                justify-content: center;
                text-align: center;
                height: 40px;
                text-decoration: none;
            }

            .hr-line {
                border-bottom: 2px solid var(--secondary-color2);
            }

            .signup {
                font-weight: 400;
                font-size: 14px;
                color: var(--secondary-color3);
                text-align: center;
            }
            .signbtn, .signbtn:focus {
                display: inline-block;
                background: var(--primary-color);
                border-radius: 6px;
                text-align: center;
                padding: 12px 25px;
                color: var(--text-primary);
                margin: auto;
                border: 0;
                font-weight: 600;
                font-size: 14px;
                width: 100%;
                cursor: pointer;
            }
            /* .signbtn:hover{
                background:var(--primary-color);
                color: var(--text-primary);
            } */
            .btn-wrapper-login {
                display: flex;
                align-items: center;
                flex-direction: column;
                row-gap: 10px;
            }
            .btn-wrapper-login {
                display: flex;
                align-items: center;
            }
            a.forgot-link {
                font-size: 14px;
                text-decoration: none;
                white-space: nowrap;
                margin-left: 20px;
                font-weight: 600;
                color: #0B161C;
            }
            a.forgot-link:hover{
                color: #0B161C;
            }
            .dark{
                color: var(--text-primary);
            }
            a.dark:hover{
                color: var(--text-primary);
            }
            .form-control-feedback {
                position: absolute;
                top: 0;
                right: 0;
                z-index: 2;
                display: block;
                width: 34px;
                height: 34px;
                line-height: 34px;
                text-align: center;
                pointer-events: none;
            }
            .form-control-feedback {
                top: 12px;
                right: 20px;
                color: var(--secondary-color2);
                font-size: 13px;
                cursor: pointer;
                pointer-events: fill;
                z-index: 100;
                width: auto;
                height: auto;
                line-height: normal;
            }
            .form-control-feedback i{
                font-size: 16px;
            }
            .login-body{
                height:100vh;
            }
            @media (min-width:768px) {
                /*.auth-wrapper {*/
                /*    padding: 40px 0px;*/
                /*}*/
                .auth-section {
                    /* padding: 0 30px; */
                    display: inline-block;
                }

                .heading {
                    font-size: 24px;
                    line-height: 29px;
                }

                .login-wrapper {
                    flex-direction: row;
                    gap: 20px;
                }
            }
            /*.gradinet{*/
            /*     border-radius: 20px;*/
            /*    border-image: linear-gradient(#DCD3FF 80%, #FFFFFF 0%) 0.1;*/
            /*    border-width: 1px;*/
            /*    border-style: solid;*/
            /*}*/
            .form-content {
                border-bottom: 0px !important;
                border-radius: 20px;
                border-image: linear-gradient(#DCD3FF 80%, #FFFFFF 0%) 0.1;
                border-width: 1px;
                border-style: solid;
                background: linear-gradient(180deg, rgba(163, 126, 227, 0.80) 1.77%, rgba(83, 67, 189, 0.00) 80.77%);
                backdrop-filter: blur(15px);
                padding-bottom: 20px;
                position:relative;
            }

            .form-content::after{
                content: "";
                position: absolute;
                z-index: -1;
                inset: 0;
                padding:1px;
                border-radius:1rem;
                background:linear-gradient(180deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05) 50%, rgba(255, 255, 255, 0.05) 50%, rgba(255, 255, 255, 0.3));
                -webkit-mask: linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
                mask: linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
                -webkit-mask-composite: xor;
                mask-composite: exclude;
                pointer-events:none;
            }
            .form-content .heading {
                padding: 30px;
            }
            .form-content h2{
                color: #FFF;
                font-family: Inter;
                font-size: 22px;
                font-weight: 700;
                line-height: 28px;
            }

            @media(min-width:992px){
                .form-content h2{
                    color: #FFF;
                    font-family: Inter;
                    font-size: 22px;
                    font-weight: 700;
                    line-height: 34px;
                }
            }
            @media(max-width:768px){
                .form-content{
                    margin-top:20px;
                }

            }
            .ele1{
                animation: 2s ease-in-out 0s infinite alternate none running mover1;
            }
            @-webkit-keyframes mover1 {
                0% { transform: translateY(0); }
                100% { transform: translateY(20px); }
            }
            @keyframes mover1 {
                0% { transform: translateY(0); }
                100% { transform: translateY(20px); }
            }
            .sky-blue {
                color: #01dffb;
            }
            .caveat {
                font-family: 'Caveat', cursive;
            }

            .auth-wrapper{
                width: 100%;
                height: 100%;
            }
            .sitelogo{
                width: 230px;
            }
            .testimonails-card{
                padding: 20px;
                background: #0101018f;
                border-radius: 10px;
                color: var(--text-primary);
            }
            .testimonails-card p {
                color: var(--text-primary);
            }
            .testimonails-card .user-detail{
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .user-img {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                border: 2px solid var(--text-primary);
            }
            .user-detail h6{
                font-size: 1rem;
                color: var(--text-primary);
                font-weight: 600;
            }
            .user-detail p{
                margin: 0;
                font-size: 14px;
                color: rgba(255,255,255,0.6);
            }

            .swiper-pagination{
                position: static !important;
                margin: auto;
                width: 100% !important;
                transform: none !important;
                margin-top: 20px;
            }
            .swiper-pagination .swiper-pagination-bullet{
                background: var(--theme-bg) !important;
            }
            .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active{
                background: var(--primary-color) !important;
            }
            .login-form{
                max-width: 500px;
                margin: auto;
            }
        </style>
    </head>
    <body class="h-100">
        <div class="auth-wrapper">
            <div class="container-fluid h-100 p-0">
                <div class="row m-0 h-100 align-items-center justify-content-center">
                    <div class="col-lg-6 text-center h-100 d-flex align-items-center justify-content-center flex-column position-relative overflow-hidden z-1">
                        <div class="auth-section">
                            <div class="login-form">
                                <form action="">
                                    <div class="text-center">
                                        <div class="form-icon">
                                            <img src="<?= $this->config->item('assetsPath') ?>images/check.png" alt="">
                                        </div>
                                        <label class="heading my-3">Thank You!</label>
                                        <p class="sub-heading sub-heading-border">Please check your inbox for the Password Reset link, If you haven't received, check your spam folder.</p>
                                    </div>

                                    <div class="form-footer btn-wrapper-login">
                                        <a href="<?= base_url('login') ?>" class="signbtn btn-block">Back to Log In</a>
                                        <!-- <button type="submit" class="theme-btn-blue">Back to Sign in </button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-flex align-items-center h-100">
                        <div class="user-section-card d-flex flex-column gap-2 justify-content-between">
                            <div class="top-content">
                                <h3 class="sub-title">
                                    FROM YOUTUBE VIDEOS TO
                                </h3>
                                <h3 class="main-title">
                                    AI Search Discovery Everywhere
                                </h3>
                                <p class="description mb-0">
                                    <span>Analyze. Optimize. Grow Automatically.</span>
                                </p>
                            </div>
                            <div class="bottom-content w-100 overflow-hidden">
                                <div class="media-img">
                                    <img src="<?= $this->config->item('assetsPath') ?>default/images/login-pr-thumb.png" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>