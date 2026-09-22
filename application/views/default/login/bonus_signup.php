<?php 
$assetsFolder=$this->config->item('assetsTemplatePath');
?>

<style>
    :root {
    --primary-color: #5055BE;
    --primary-color2: #25297E;
    --primary-color3: #FF5858;
    --primary-color4: #ec4242;
    --secondary-color: #FDDB8A;
    --secondary-color2: #CDD4ED;
    --secondary-color3: #8B93B1;
    --tertiary-color: #F5F6FA;
    --text-primary: #1C295D;
    --hover-color: #ffffff;
    --white-color: #ffffff;
    --black-color: #000000;
    blue-gradient: radial-gradient(100% 100% at 50.00% 0%, #AA70ED 0%, #5340D7 100%);
    --blue-gradient1: radial-gradient(100% 100% at 50.00% 0%, #5340D7 0%, #AA70ED 100%);
}


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
.auth-wrapper {
    padding: 30px 0px;
}
/*.auth-wrapper::before {*/
/*    content: '';*/
/*    display: block;*/
/*    background: url('<?= $this->config->item('assetsPath') ?>images/auth-bg-mview.png') no-repeat center center;*/
/*    background-size: cover;*/
/*    position: absolute;*/
/*    top: 0;*/
/*    left: 0;*/
/*    right: 0;*/
/*    bottom: 0;*/
/*    z-index:-1;*/
/*}*/
.auth-section {
    background: var(--white-color);
    box-shadow: 0px 0px 8px 4px rgba(0, 0, 0, 0.05);
    border-radius: 15px;
    padding: 20px;
    max-width: 470px;
    width: 100%;
    height:470px;
}

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
    line-height: 100%;
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

.forget-link {
    font-weight: 600;
    font-size: 14px;
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
    /* background: #1869D8; */
    border-radius: 6px;
    text-align: center;
    padding: 12px 25px;
    color: var(--white-color);
    margin: auto;
    border: 0;
    font-weight: 600;
    font-size: 14px;
    width: 100%;
    cursor: pointer;
}
/* .signbtn:hover{
    background:#1869D8;
    color: var(--white-color);
} */
.btn-wrapper-login {
    display: flex;
    align-items: center;
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
@media (min-width:768px) {
    .auth-wrapper {
    padding: 40px 0px;
}
    .auth-section {
        padding: 30px 15px;
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
    
    .login-body{
        height:100vh;
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
</style>






<!DOCTYPE html>
<html lang="en">

 

<head>

 

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $this->config->item('productName');?> Login</title>
<link rel="icon" type="image/x-icon" href="<?= $this->config->item('assetsPath') ?>images/Ai-Employee-Favicon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap" rel="stylesheet">
<?php
$this->load->view('default/login/login-header.php');
?>

 

            <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

 

        <body class="position-relative login-body" style="display: flex; align-items: center; justify-content: center; background: url('https://cdn.grabiris.com/assets/images/login-section.webp') no-repeat center center; background-size:cover;">
            <div class="auth-wrapper">
                <div class="container">
                    <div class="row">
                <div class="col-md-5 col-12 mb20 text-center">
                <img src="https://cdn.grabiris.com/assets/images/login-logo.svg" class="img-fluid mx-auto d-block" width="300">
            <div class="auth-section" style="margin-top:30px;">
            <div class="heading">
                           Signup & Get Started Now
            </div>
            <!--<div class="sub-heading mt10">-->
            <!--                100% FREE, No Credit Card Required-->
            <!--</div>-->
            <form action="<?php echo $this->config->item('base_url'); ?>bonus-signup" method="post" class="form_ajax">
            <div class="form mt2">
            <div class="md11 sm10 xs10 errormsg text-left form_error_message form_error"></div>
            <div class="md11 sm10 xs10 errormsg text-left"></div>
            <div class="form-item">
            <input type="name" id="name" placeholder="Name" value="" name="name" autocomplete="off">
            
            </div>
            
            <div class="form-item">
            <input type="email" id="username" placeholder="Email" value="" name="email" autocomplete="off">
            
            </div>
            
            <div class="form-item mb0">
            <input type="password" name="password" placeholder="Password" value="" id="password-field" autocomplete="off">
            
            <span class="form-control-feedback toggle-password" toggle="#password-field"><i class="icon-password-view"></i></span>
            </div>
            
             <div class="form-item mb0">
            <input type="password" name="confirm_password" placeholder="Confirm-Password" value="" id="password" autocomplete="off">
            
            <span class="form-control-feedback toggle-password" toggle="#password-field"><i class="icon-password-view"></i></span>
            </div>
            
            </div>
            <div> 
            
            <div class="g-recaptcha" data-sitekey="6Ld1vkkpAAAAAAFGB2UylRPstHJijHFAHJHB8G-y">
            </div>
            
            <div class="btn-wrapper-login mt15">
            <button type="submit" name="login" class="signbtn btn-block">Sign Up</button>
            <a href="<?= base_url('forgot-password'); ?>" class="forgot-link">Forgot Password ?</a>
            </div>
            </form>
            </div>
            </div></div>
            <div class="col-md-7 col-12 invisible">
                    <div class="gradinet">
                        <div class="form-content">
                            <div class="heading">
                                <h2>"#1 Super VA That Finish Your 100s Type of Marketing Tasks <span class="caveat">(Better & Faster Than Any CMO Out There...)</span> AND Trim Your Workload, Hiring/Firing Headaches, & Monthly Bills"</h2>
                            </div>
                            <div class="form-img">
                                <img src="<?= $this->config->item('assetsPath') ?>images/robot.png" class="img-fluid mx-auto d-block ele1" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div></div></div>
            <!--<div class="col-md-4">-->
            <!--        <div class="form-content">-->
            <!--            <div class="heading">-->
            <!--                <h2>"Start your Journey With AI, Unlock the Doors of Sucess, Let dreams take flight, A future bright, in every light."</h2>-->
            <!--            </div>-->
            <!--            <div class="form-img">-->
            <!--                <img src="../../../../assets/images/robot.png" class="img-fluid" alt="">-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <script>
               $(document).ready(function(){

                            $(".toggle-password").click(function() {
                                var input = $($(this).attr("toggle"));
                                if (input.attr("type") == "password") {
                                    input.attr("type", "text");
                                } else {
                                    input.attr("type", "password");
                                }
                                $("i", this).toggleClass("icon-password-hide-show icon-password-hide");
                            });

               $(".toggle-password1").click(function() {
                                var input = $($(this).attr("toggle"));
                                if (input.attr("type") == "password") {
                                    input.attr("type", "text");
                                } else {
                                    input.attr("type", "password");
                                }
                                $("i", this).toggleClass("icon-password-hide-show icon-password-hide");
                            });                    });

</script>
</body>

 

</html>