      <!-- page content -->
      <div class="right_col" role="main">

        <br />
        <div class="">
          <div class="row top_tiles">
		  <?php if($user_access=='yes') { ?>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-user"></i>
                </div>
                <div class="count"><?=$total_user?></div>

                <h3>Total Users</h3>
              </div>
            </div>
		  <?php } ?>
		  <?php if($team_access=='yes') { ?>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-frown-o"></i>
                </div>
                <div class="count"><?=$total_team?></div>

                <h3>Total Team Members</h3>
              </div>
            </div>
		  <?php } ?>
		  <?php if($package_access=='yes') { ?>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-suitcase"></i>
                </div>
                <div class="count"><?=$total_package?></div>

                <h3>Total Packages</h3>
              </div>
            </div>
		  <?php } ?>
		  <?php if($order_access=='yes') { ?>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-shopping-cart"></i>
                </div>
                <div class="count"><?=$total_order?></div>

                <h3>Total Orders</h3>
              </div>
            </div>
		  <?php } ?>
		  <?php if($transaction_access=='yes') { ?>
			<div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-usd"></i>
                </div>
                <div class="count"><?=$total_trans['size']-$total_cgbk["size"]?> ($ <?=$total_trans['totalamount']-$total_cgbk["totalamount"]?>)</div>

                <h3>Total Transaction</h3>
              </div>
            </div>
		  <?php } ?>
		  <?php if($purchase_access=='yes') { ?>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square"></i>
                </div>
                <div class="count"><?=$total_purchase?></div>

                <h3>Total Purchased</h3>
              </div>
            </div>
		  <?php } ?>
          </div>

          


          <div class="row">
		  <?php if($user_access=='yes') { ?>
            <div class="col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h2>User Details </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <article class="media event">
                    <a class="pull-left">
                     <img alt="Avatar" class="avatar" src="<?=$this->config->item('adminAssetsPath')?>images/user.png">
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">User registerd this week</a>
                      <p><?=$user_week?> users</p>
                    </div>
                  </article>
				  <article class="media event">
                   <a class="pull-left">
                     <img alt="Avatar" class="avatar" src="<?=$this->config->item('adminAssetsPath')?>images/user.png">
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">User registerd this month</a>
                      <p><?=$user_month?> users</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <img alt="Avatar" class="avatar" src="<?=$this->config->item('adminAssetsPath')?>images/user.png">
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Active users</a>
                      <p><?=$user_active?> users</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <img alt="Avatar" class="avatar" src="<?=$this->config->item('adminAssetsPath')?>images/user.png">
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Inactive users</a>
                      <p><?=$user_inactive?> users</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <img alt="Avatar" class="avatar" src="<?=$this->config->item('adminAssetsPath')?>images/user.png">
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Total Users</a>
                      <p><?=$total_user?> users</p>
                    </div>
                  </article>
                  
                </div>
              </div>
            </div>
		  <?php } ?>
		  <?php if($purchase_access=='yes') { ?>
			<div class="col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Purchased Details</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-check-square"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Purchased this week</a>
                      <p><?=$purchase_week?> package</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-check-square"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Purchased this month</a>
                      <p><?=$purchase_month?> package</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-check-square"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Active purchased</a>
                      <p><?=$purchase_active?> package</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-check-square"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Inactive purchased</a>
                      <p><?=$purchase_inactive?> package</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-check-square"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Total purchased</a>
                      <p><?=$total_purchase?> package</p>
                    </div>
                  </article>
                </div>
              </div>
            </div>
		  <?php } ?>
		  <?php if($transaction_access=='yes') { ?>
			<div class="col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Transaction Details</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-usd"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Transaction added this week</a>
                      <p><?=$trans_week['size']?> transaction ($ <?=$trans_week['totalamount']?>)</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-usd"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Transaction added this month</a>
                      <p><?=$trans_month['size']?> Transaction ($ <?=$trans_month['totalamount']?>)</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-usd"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">JVZoo transaction</a>
                      <p><?=$trans_jvz['size']?> Transaction ($ <?=$trans_jvz['totalamount']?>)</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-usd"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">IB transaction</a>
                      <p><?=$trans_ib['size']?> Transaction ($ <?=$trans_ib['totalamount']?>)</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-usd"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Credit/debit card transaction</a>
                      <p><?=$trans_cc['size']?> Transaction ($ <?=$trans_cc['totalamount']?>)</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-usd"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Total transaction</a>
                      <p><?=$total_trans['size']?> Transaction ($ <?=$total_trans['totalamount']?>)</p>
                    </div>
                  </article>
                </div>
              </div>
            </div>
		  <?php } ?>
		  <?php if($order_access=='yes') { ?>
			<div class="col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Order Details</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Orders added this week</a>
                      <p><?=$order_week?> order</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Orders added this month</a>
                      <p><?=$order_month?> order</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">New Orders</a>
                      <p><?=$order_new?> orders</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Orders in process</a>
                      <p><?=$order_process?> Orders</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Pending orders</a>
                      <p><?=$order_pending?> Orders</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Complete orders</a>
                      <p><?=$order_complete?> Orders</p>
                    </div>
                  </article>
				  <article class="media event">
                    <a class="pull-left">
                     <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Total Orders</a>
                      <p><?=$total_order?> Orders</p>
                    </div>
                  </article>
                </div>
              </div>
            </div>
		  <?php } ?>
          </div>
        </div>

       
