
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
                  <h2>Product Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <table class="table">
                
                
                <?php if($detail->image!=''){?>
                  <thead>
                    <tr>
                      <th>Image :</th>
                      <th>
                          <?php if(trim($detail->image)!='') { ?>
                              <img src="<?php echo $this->config->item('uploadPath').'default_product_images/'.$detail->image?>"height="25px" width="25px"/>
                          <?php }else { ?>
                              NA
                          <?php }?>
                      </th>
                    </tr>
                  </thead>
                <?php } ?>
                

                <thead>
                    <tr>
                      <th>Status :</th>
                      <th><?=$detail->status?></th>
                    </tr>
                  </thead>

                <thead>
                  <tr>
                    <th>Product Type :</th>
                    <th><?=$detail->has_purchased=='1' ? 'For Use' : 'For Buy';?></th>
                  </tr>
                </thead>

                 <thead>
                  <tr>
                    <th>Sales Page Url :</th>
                    <th><?=$detail->sales_page_url?></th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                    <th>Free Report Url :</th>
                    <th><?php foreach($free_report_urls as $key=>$val){
                            echo $val['file_url']."<br>";
                        }?>
                    </th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                    <th>Front End Guides Urls :</th>
                    <th><?php foreach($fe_guides_urls as $key=>$val){
                            echo $val['file_url']."<br>";
                        }?>
                    </th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                    <th>Front End Videos Urls :</th>
                    <th><?php foreach($fe_videos_urls as $key=>$val){
                            echo $val['file_url']."<br>";
                        }?>
                    </th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                    <th>Upsell Guides Urls :</th>
                    <th><?php foreach($upsell_guides_urls as $key=>$val){
                            echo $val['file_url']."<br>";
                        }?>
                    </th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                    <th>Upsell Videos Urls :</th>
                    <th><?php foreach($upsell_videos_urls as $key=>$val){
                            echo $val['file_url']."<br>";
                        }?>
                    </th>
                  </tr>
                </thead>


                <thead>
                  <tr>
                    <th>Customer Front End Zip file url :</th>
                    <th><?php  echo $customer_fe_zip_url[0]['file_url']; ?>
                    </th>
                  </tr>
                </thead>


                <thead>
                  <tr>
                    <th>Customer Upsell Zip file url :</th>
                    <th><?php  echo $customer_upsell_zip_url[0]['file_url']; ?>
                    </th>
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