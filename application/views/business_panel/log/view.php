<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        Frequently Asked Question</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>FAQ Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <table class="table">
                <thead>
                  <tr>
                    <th>Question :</th>
                    <th><?=$detail->question?></th>
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
                    <th>Answer :</th>
                    <th><?=$detail->answers?></th>
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
                    <th><?=date('d-m-Y H:i',$detail->created)?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Modified :</th>
                    <th><?=date('d-m-Y H:i',$detail->modified)?></th>
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