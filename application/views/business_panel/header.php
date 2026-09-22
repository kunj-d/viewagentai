<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $this->config->item('productName');?> - Business Panel</title>
<link rel="icon" href="<?php echo $this->config->item('adminAssetsPath').'images/favicon.png';?>" type="icon" />
<!-- Bootstrap core CSS -->
<link href="<?=$this->config->item('adminAssetsPath')?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=$this->config->item('adminAssetsPath')?>fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?=$this->config->item('adminAssetsPath')?>css/animate.min.css" rel="stylesheet">
<!-- Custom styling plus plugins -->
<link href="<?=$this->config->item('adminAssetsPath')?>css/custom.css" rel="stylesheet">
<link href="<?=$this->config->item('adminAssetsPath')?>css/icheck/flat/green.css" rel="stylesheet">
<link href="<?=$this->config->item('adminAssetsPath')?>js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('adminAssetsPath')?>js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('adminAssetsPath')?>js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('adminAssetsPath')?>js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('adminAssetsPath')?>js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?=$this->config->item('adminAssetsPath')?>js/jquery.min.js"></script>
<script src="<?=$this->config->item('adminAssetsPath')?>js/jquery.form.js"></script>
<script src="<?=$this->config->item('adminAssetsPath')?>js/ajax.js"></script>
<style>
  .form_error{
    color:red;
    font-size:14px;
  }
</style>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.7.3/basic/ckeditor.js"></script>

<!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;"> <a href="<?=$this->config->item('spanel_url')?>" class="site_title"><i class="fa fa-paw"></i> <span>Business Panel</span></a> </div>
    <div class="clearfix"></div>
    <!-- menu prile quick info -->
    <div class="profile">
      <div class="profile_pic"> 
	  <a href="<?=$this->config->item('spanel_url').'edit-team/'.$this->session->userdata('SAG_mem_id')?>">
	  <img src="<?=$this->config->item('adminAssetsPath')?>uploads/profile_images/<?=$this->session->userdata('profile_image')?>" alt="<?=$this->session->userdata('profile_image')?>" class="img-circle profile_img" style="height:60px; width:60px"> 
	  </a>
	  </div>
      <div class="profile_info"> <span>Welcome,</span>
        <h2><?=$this->session->userdata('SAG_membername')?></h2>
      </div>
    </div>
    <!-- /menu prile quick info -->
    <br />
    <!-- sidebar menu -->
    <?php $this->load->view($this->config->item('adminFolderName').'/left_menu')?>
    <!-- /sidebar menu -->
    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small"> <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=$this->config->item('spanel_url').'logout'?>"> <span class="fa fa-sign-out" aria-hidden="true"></span> </a> </div>
    <!-- /menu footer buttons -->
  </div>
</div>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav class="" role="navigation">
	<?php $ltime=$this->Last_login_Model->lastEntryTime()?>
	
      <div class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a> </div>
      <ul class="nav navbar-nav navbar-right">
        <li class=""> <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="<?=$this->config->item('adminAssetsPath')?>uploads/profile_images/<?=$this->session->userdata('profile_image')?>" alt="<?=$this->session->userdata('profile_image')?>" style="height:30px; width:30px"><?=$this->session->userdata('SAG_membername')?> <span class=" fa fa-angle-down"></span> </a>
          <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
            <li><a href="<?=$this->config->item('spanel_url').'edit-team/'.$this->session->userdata('SAG_mem_id')?>"> Profile</a> </li>
            <li> <a href="javascript:;" data-toggle="modal" data-target=".change_pass_model"> Change Password </a> </li>
            <li><a href="<?=$this->config->item('spanel_url').'logout'?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a> </li>
          </ul>
        </li>
        <li role="presentation" class="dropdown">
		<br/>
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <span class="badge bg-green">Last Login Time : <strong>
	<?php if($ltime) { ?>
      <?=$ltime?>
      ago
      <?php } else { ?>
      Login First Time 
      <?php } ?> </strong></span>
                </a>
                
              </li>
      </ul>
	    
    </nav>
  </div>
</div>
<!-- /top navigation -->
<script>
var spanel_url = '<?=$this->config->item('spanel_url')?>';
</script>
<script>
$(document).ready(function() {
    $(".formclass").submit(function(event) {
        var posturl = $(this).attr('action');
        $(this).ajaxSubmit({
            url: posturl,
            dataType: 'json',
            success: function(response) {
				
                if (response.success) {
					
					if(response.model=='hide')
					$('.modal').modal('toggle');
					PNotify.removeAll();
					new PNotify({title: 'Success',text: response.success_msg,type: 'success'});
					 
                } else {
                   
				   PNotify.removeAll();
				   new PNotify({title: 'Error',text: response.error,type: 'error'});
				    
                }
            },
        });
        return false;
    });
});
</script>
<!-- Small modal -->

                <div class="modal fade change_pass_model" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Change Password</h4>
                      </div>
					  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left formclass" action="<?=$this->config->item('spanel_url').'team/change-password'?>" method="post">
                      <div class="modal-body">
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="curr_password">Current Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="curr_password"  class="form-control col-md-7 col-xs-12" name="curr_password" value="">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_pass">New Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="new_pass" class="form-control col-md-7 col-xs-12" name="new_pass" value="">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_pass">Confirm Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="confirm_pass" class="form-control col-md-7 col-xs-12" name="confirm_pass" value="">
                      </div>
                    </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
</form>
                    </div>
                  </div>
                </div>
                <!-- /modals -->
<!-- PNotify -->
<script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/notify/pnotify.core.js"></script>
<script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/notify/pnotify.buttons.js"></script>
<script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/notify/pnotify.nonblock.js"></script>
<!-- icheck -->
<script src="<?=$this->config->item('adminAssetsPath')?>js/icheck/icheck.min.js"></script>