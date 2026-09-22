<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        <?php echo $detail->name?>'s detail</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>Sending Server Details</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <table class="table">
			  <thead>
                  <tr>
                    <th>Name :</th>
                    <th><?php echo $detail->name?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>Type :</th>
                    <th><?php echo $detail->type?></th>
                  </tr>
                </thead>
                
				 <thead>
                  <tr>
                    <th style='vertical-align: middle;'>Credential Field  :</th>
                    <th><?php
				  foreach($Sending_server_fields as $fields_data) {
						echo $fields_data->title," <br>";
				  }?></th>
                  </tr>
                </thead>
				 <thead>
                  <tr>
                    <th>Status :</th>
                    <th><?php echo  $detail->status=='active' ? "Acitve" : "Incative" ; ?></th>
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