<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        <?=$detail->title?>'s detail</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>Category Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <table class="table">
                <thead>
                  <tr>
                    <th>Title :</th>
                    <th><?=$detail->title?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>Slug :</th>
                    <th><?=$detail->slug?></th>
                  </tr>
                </thead>
				 <thead>
                  <tr>
                    <th>Status :</th>
                    <th><?=$detail->status?></th>
                  </tr>
                </thead>
				 <thead>
                  <tr>
                    <th>Created :</th>
                    <th><?=date($this->config->item('Reading_date_time_format'),$detail->created)?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Modified :</th>
                    <th><?=date($this->config->item('Reading_date_time_format'),$detail->modified)?></th>
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