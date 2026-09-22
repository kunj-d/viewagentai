<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->config->item('productName'); ?> Reset Password</title>
        <link rel="icon" type="image/x-icon" href="<?= $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap" rel="stylesheet">
        <title><?php echo $this->config->item('productName') ?> | Reset Password</title>
        <?php
        $this->load->view('default/login/login-header.php');
        ?>
        <script>
            $(document).ready(function () {
<?php
if ($flashdata = $this->session->flashdata('message')) {
    //$flashdata = $this->session->flashdata('message');
    echo "flashNow(" . $flashdata . ");";
}
?>
            });
        </script>


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
                padding: 0 !important;
            } */

            /* .heading {
                font-weight: 600;
                font-size: 20px;
                line-height: 24px;
                text-align: center;
                color: #0B161C;
            } */

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
                /* background: var(--primary-color); */
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
            /* 
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
            */
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
                /* .auth-section {
                    padding: 0 30px;
                    display: inline-block;
                } */

                /* .heading {
                    font-size: 24px;
                    line-height: 29px;
                } */

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
            /* .form-content .heading {
                padding: 30px;
            } */
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
                margin: auto;
            }
            .checkStatus{
                padding: 5px 10px;
                border-radius: 10px;
                margin-top: 5px;
                color: #000;
                font-size: 12px;
                width: fit-content;
            }
            
            .checkStatus.NotValid{
                background: #ffd1d1;
            }
            .checkStatus.isValid{
                background: #cef5ce;
            }
        </style>


    </head>
    <body class="h-100">
        <div class="checkStatus NotValid">
            <span class="uppercase invalid" data-text="One uppercase letter (A-Z)">❌ One uppercase letter (A-Z)</span>
            <span class="lowercase invalid" data-text="One lowercase letter (a-z)">❌ One lowercase letter (a-z)</span>
            <span class="number invalid" data-text="One number (0-9)">❌ One number (0-9)</span>
            <span class="special invalid" data-text="One special character (!@#$%^&*)">❌ One special character (!@#$%^&*)</span>
            <span class="length invalid" data-text="8-16 characters long">❌ 8-16 characters long</span>
        </div>
        <div class="auth-wrapper">
            <div class="container-fluid h-100 p-0">
                <div class="row m-0 h-100 align-items-center justify-content-center">
                    <div class="col-lg-6 text-center h-100 d-flex align-items-center justify-content-center flex-column position-relative overflow-hidden z-1">
                        <div class="auth-section">
                            <div class="login-form">
                                <form action="<?php echo base_url('reset-password'); ?>?code=<?php echo $this->input->get('code'); ?>&email=<?php echo $this->input->get('email'); ?>"  method="post" class="form_ajax">
                                    <div class="text-center">
                                        <div class="form-icon">
                                            <img src="<?= $this->config->item('assetsPath') ?>images/password-icon.png" alt="">
                                        </div>
                                        <h5 class="heading sub-heading-border my-3">Create a Password</h5>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-item text-start">
                                            <div class="label-items">
                                                <label class="form-label">Password</label>
                                            </div>
                                            <div class="form-item-in">
                                                <div class="input-icon">
                                                    <i class="fa-solid fa-lock"></i>
                                                </div>
                                                <input type="password" name="password" placeholder="Password" value="" id="password-field" autocomplete="off" class="form-control">
                                                <span class="form-control-feedback toggle-password" toggle="#password-field">
                                                    <i class="icon-password-view"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-item text-start">
                                            <div class="label-items">
                                                <label class="form-label">Confirm Password</label>
                                            </div>
                                            <div class="form-item-in">
                                                <div class="input-icon">
                                                    <i class="fa-solid fa-lock"></i>
                                                </div>
                                                <input type="password" name="cpassword" placeholder="Confirm Password" value="" id="cpassword-field" autocomplete="off" class="form-control" >
                                                <span class="form-control-feedback toggle-password" toggle="#cpassword-field">
                                                    <i class="icon-password-view"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-footer btn-wrapper-login">
                                        <button type="submit" class="signbtn btn-block">Submit </button>
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

        <script>
            $(document).ready(function () {

                // Code For The Passowrd Validation
                $('#password-field').on('input', function(){
                    var password = $(this).val().trim();
                    $('.checkStatus').fadeIn();

                    // Condition check
                    var hasUpperCase = /[A-Z]/.test(password);
                    var hasLowerCase = /[a-z]/.test(password);
                    var hasNumber = /[0-9]/.test(password);
                    var hasSpecialChar = /[^a-zA-Z0-9\s]/.test(password);
                    var isValidLength = password.length >= 8 && password.length <= 16;

                    // Update UI
                    updateStatus('.uppercase', hasUpperCase);
                    updateStatus('.lowercase', hasLowerCase);
                    updateStatus('.number', hasNumber);
                    updateStatus('.special', hasSpecialChar);
                    updateStatus('.length', isValidLength);

                    // Check if all conditions met
                    var isValid = hasUpperCase && hasLowerCase && hasNumber && hasSpecialChar && isValidLength;
                    
                    if (isValid) {
                        $('.checkStatus').addClass('isValid').removeClass('NotValid');
                        setTimeout(() => { 
                            $('.checkStatus').fadeOut();
                        }, 4000);
                    }else{
                        $('.checkStatus').removeClass('isValid').addClass('NotValid');
                        $('.checkStatus').fadeIn();
                    }
                });

                function updateStatus(selector, condition) {
                    var element = $(selector);
                    var text = element.attr('data-text'); // Get original text
                    if (condition) {
                        element.removeClass('invalid').addClass('valid').html('✅ ' + text);
                    } else {
                        element.removeClass('valid').addClass('invalid').html('❌ ' + text);
                    }
                }
                // Code For The Passowrd Validation
                
                
                
                
                
                $(".toggle-password").click(function () {
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                    $("i", this).toggleClass("icon-password-hide-show icon-password-hide");
                });

                $(".toggle-password1").click(function () {
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                    $("i", this).toggleClass("icon-password-hide-show icon-password-hide");
                });
            });

        </script>

    </body>
</html>


