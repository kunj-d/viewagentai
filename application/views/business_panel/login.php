<!DOCTYPE html>
<html>
<head>
<title>BMS Login-QuickAffiliatePro</title>
<!-- Device & IE Compatibility Meta -->
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<!--Load Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,600,700,800' rel='stylesheet' type='text/css'>
<!--Load Google Fonts -->
<link rel="icon" href="<?php echo $this->config->item('adminAssetsPath').'images/favicon.png';?>" type="icon" />
<!--Load External CSS -->
<script src="https://code.jquery.com/jquery-1.8.3.js"></script>
<script type='text/javascript'>//<![CDATA[
    $(function(){
    $(".first").click(function() {
        $('html,body').animate({
            scrollTop: $(".second").offset().top},
            'slow');
    });
    });//]]> 
    
    </script>
<link rel="stylesheet" href="<?php echo $this->config->item('adminAssetsPath');?>login/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->config->item('adminAssetsPath');?>login/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->config->item('adminAssetsPath');?>login/css/style.css" type="text/css" />
</head>
<body>
<div class="signupheader">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 padding0"> <img src="<?php echo $this->config->item('adminAssetsPath');?>login/images/logo.png" style="height:60px;width:350px" class="img-responsive center-block"></div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">

      

	  <form action="" method="post">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 signuparea">
        <div class="col-md-12 col-sm-12 col-xs-12 padding5">
          <h2 class="w400 lh130 mt1 xsmt4 whitetext em15 mdem14 smem14 xsem14 text-center">Business Panel Login</h2>
          <div class="second"></div>
        </div>
		<?php if (isset($error_login)) { ?>
	  <div class="text-danger text-center"><?=$error_login?></div>
	  <?php } ?>
		  <div class="col-md-12 mt3 xsmt3 col-sm-12 col-xs-12 padding5">
          <input type="text" class="user" autocomplete="off" placeholder="Email" name="email" value="<?php if(isset($email)) echo $email?>" >
          <div class="text-danger text-center"><?=form_error('email')?></div> </div>
		  <div class="col-md-12 mt3 xsmt3 col-sm-12 col-xs-12 padding5">
          <input type="password" class="key" placeholder="Password" name="password" value="" >
          <div class="text-danger text-center"><?=form_error('password')?></div></div>
        <div class="col-md-12 col-sm-12 col-xs-12 padding5 mt3 xsmt3">
          <input type="submit" value="LOGIN" class="signup-submit mdem14 smem13 xsem13 transition" />
        </div>
		 <!--<div class="col-md-12 col-sm-12 col-xs-12 padding5 mt3 xsmt3 text-center">
          <a href="#" class="w200 lh130 mt1 xsmt4 whitetext mdem11 smem10 xsem10 "><u>Forgot Your Password ?</u></a>
        </div>-->
      </div>
	  </form>


  </div>
</div>

<div class="gradient_strip greytext mt2 xsmt2 text-center ">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 mt1 xsmt1  "> All Rights Reserved @ Saglus.com &nbsp; &nbsp; </div>
      
    </div>
  </div>
</div>
</body>
</html>
