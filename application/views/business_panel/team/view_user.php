<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        <?=$detail->first_name?>'s detail</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>Personal Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <table class="table">
                <thead>
                  <tr>
                    <th>Name :</th>
                    <th><?=$detail->first_name.' '.$detail->lats_name?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>Phone :</th>
                    <th><?=$detail->phone?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>Email :</th>
                    <th><?=$detail->email?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
		<div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>Business Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
		    <?php foreach($bus_detail as $valBus) { 
			$valun = unserialize($valBus->domain_value);
			?>
            <div class="x_content">
              <table class="table">
                <thead>
                  <tr>
                    <th>Company Name :</th>
                    <th><?=$valun['company_name']?></th>
					<th>&nbsp;</th>
					<th>Business Email :</th>
                    <th><?=$valun['email']?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>Address :</th>
                    <th><?=$valun['address']?></th>
					<th>&nbsp;</th>
					<th>City :</th>
                    <th><?=$valun['city']?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Country :</th>
                    <th><?=$valun['country']?></th>
					<th>&nbsp;</th>
					<th>Industry :</th>
                    <th><?=$valun['industry']?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Employee :</th>
                    <th><?=$valun['employee']?></th>
					<th>&nbsp;</th>
					<th>Business Age :</th>
                    <th><?=$valun['business_age']?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Turnover :</th>
                    <th><?=$valun['turnover']?></th>
					<th>&nbsp;</th>
					<th>Challenge :</th>
                    <th><?=$valun['challenge']?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
				    <th>Domain Name :</th>
                    <th><?=$valBus->domain_name?></th>
					<th>&nbsp;</th>
                    <th>Mobile No :</th>
                    <th><?=$valun['mobile']?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
				    <th>User Role :</th>
                    <th><?=$valBus->user_role?></th>
					<th>&nbsp;</th>
                    <th>Status :</th>
                    <th><?=$valBus->status?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
					<th>Goal :</th>
                    <th colspan="4"><?=$valun['goal']?></th>
                  </tr>
                </thead>
              </table>
            </div>
			<?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>