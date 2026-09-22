<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        <?php echo $detail->display_title?>'s detail</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>Responder Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <table class="table">
			  <thead>
                  <tr>
                    <th>Display Title :</th>
                    <th><?php echo $detail->display_title?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>Title :</th>
                    <th><?php echo $detail->title?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th style='vertical-align: middle;'>logo :</th>
                    <th><img src="<?php echo $detail->logo;?>" style="height:25px; width:25px"/></th>
                  </tr>
                </thead>
				 <thead>
                  <tr>
                    <th style='vertical-align: middle;'>Credential Field  :</th>
                    <th><?php
				  foreach($autoresponder_fields as $fields_data) {
						echo $fields_data->display_title," <br>";
				  }?></th>
                  </tr>
                </thead>
				 <thead>
                  <tr>
                    <th>Status :</th>
                    <th><?php echo  $detail->status==1 ? "Acitve" : "Incative" ; ?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
		
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>