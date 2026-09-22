<?php 
$assetsFolder=$this->config->item('assetsTemplatePath');
?>

<link rel="shortcut icon" href="<?= $this->config->item('assetsPath') ?>images/favicon.png">
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/general.css" type="text/css" />
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/pnotify.custom.min.css" type="text/css" />
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/login_signup_style.css" type="text/css" />
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/login_signup_style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->config->item('assetsPath') ?>css/swiper-bundle-min.css" />

<!-- Animate style Css -->
    <link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/animate.css">
<!-- Animate style Css -->

<!-- IM University design css-->
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/icomoon.css" type="text/css" />
  <!--font awesome css start-->
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>fonts/fontawesome/css/all.min.css">
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>fonts/fontawesome/css/brands.css">
<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>fonts/fontawesome/css/solid.css">
<!--font awesome css end-->


<!-- Animate style JS -->
    <script src="<?= $this->config->item('assetsPath') ?>js/wow.js"></script>
<!-- Animate style JS -->

<!-- Common css-->
<script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/jquery.min.js"></script>
<script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/pnotify.custom.min.js"></script>
<script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/basic.js"></script>
<script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/angular.min.js"></script>
<script type='text/javascript' src="<?php echo $this->config->item('assetsPath') ?>js/swiper-bundle-min.js"></script>





<script>
$(document).ready(function(){
	<?php
	if($flashdata = $this->session->flashdata('message')){	
		 //$flashdata = $this->session->flashdata('message');		 
		echo "flashNow(".$flashdata.");";
	}
	?>
});
</script>
<style>
.form_error{
	color:red;
}

.swiper-wrapper{
	height: unset;
}

@media (min-width: 1380px) {
	.top-content h3{
		font-size: 2.3rem;
   		line-height: 3rem;
	}
}
</style>
	