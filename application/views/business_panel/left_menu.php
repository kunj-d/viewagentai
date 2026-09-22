<?php  $masterTabsArr = $this->session->userdata('parentArr');
       $pArr = explode(',',$this->session->userdata('PRIVILEDGES')); ?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>&nbsp;</h3>
              <ul class="nav side-menu">
				<li><a href="<?=$this->config->item('spanel_url')?>"><i class="fa fa-home"></i> Home</a>
                </li>
				
				
				 <?php $allManagers	=	$this->config->item('memberManagers'); 
				 //echo "<pre>";
				 //print_r($allManagers);
				 //die;
				 ?>
  <?php for($i=0;isset($allManagers[$i]);$i++) { ?>
  <?php if ( in_array( $allManagers[$i]->mng_id,$masterTabsArr ) ) { ?>
				<li><a><i class="fa <?=$allManagers[$i]->class_name?>"></i> <?=$allManagers[$i]->manager_name?> <span class="fa fa-chevron-down"></span></a>
				 <?php $submanagers	=	$allManagers[$i]->submanagers; ?>
    <?php if( sizeof($submanagers) > 0 ) { ?>
                  <ul class="nav child_menu" style="display: none">
				  <?php for($j=0;isset($submanagers[$j]);$j++) { ?>
      <?php if( in_array( $submanagers[$j]->mng_id,$pArr ) ) { ?>
                    <li><a href="<?=$this->config->item('spanel_url').$submanagers[$j]->page_link?>"><?=$submanagers[$j]->manager_name?></a>
                    </li>
                 <?php }  } ?>
                  </ul>
				 <?php } ?>
                </li>
				<?php } } ?>
				
				<li><a><i class="fa fa-frown-o"></i> Manage Menu <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?=$this->config->item('spanel_url');?>create-menu">Create Menu</a></li>
						<li><a href="<?=$this->config->item('spanel_url');?>manage-menu-manager">Manage Menu</a></li>
					</ul>
				</li>
				
				<li><a><i class="fa fa-frown-o"></i> Manage Submenu <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?=$this->config->item('spanel_url');?>create-submenu">Create Submenu</a></li>
						<li><a href="<?=$this->config->item('spanel_url');?>manage-submenu-manager">Manage Submenu</a></li>
					</ul>
				</li>
				
				<li><a><i class="fa fa-frown-o"></i> Default Video Manager <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?=$this->config->item('spanel_url');?>create-video">Create Video</a></li>
						<li><a href="<?=$this->config->item('spanel_url');?>manage-video-manager">Manage Video</a></li>
					</ul>
				</li>

				<!-- Dropdown-->
           <li><a><i class="fa fa-cog"></i> Settings<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none;">
						<?php //if(ENVIRONMENT == 'development'){ ?>
						<li><a href="<?php echo $this->config->item('spanel_url').'settings/add';?>">Add Options</a></li>
					    <li><a href="<?php echo $this->config->item('spanel_url').'settings/all';?>">All Settings</a></li>
						<?php
						//}
						?>
					    <li><a href="<?php echo $this->config->item('spanel_url').'settings/index/Site';?>">Site</a></li>
						<li><a href="<?php echo $this->config->item('spanel_url').'settings/index/Reading';?>">Reading</a></li>
					    <li><a href="<?php echo $this->config->item('spanel_url').'settings/index/Writing';?>">Writing</a></li>
						<li><a href="<?php echo $this->config->item('spanel_url').'settings/index/Social';?>">Social</a></li>
						<li><a href="<?php echo $this->config->item('spanel_url').'settings/index/Application';?>">Application</a></li>						
						</ul>
				</li>
            <!-- Dropdown-->
			  </ul>
            </div>
          </div>