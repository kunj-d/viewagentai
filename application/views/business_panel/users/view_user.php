<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        <?=$detail->firstname?>'s detail</h4>
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
                    <th><?=$detail->name?></th>
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
                    <th>Skype :</th>
                    <th><?=$detail->skype_id?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Country :</th>
                    <th><?=$detail->country?></th>
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
		
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>