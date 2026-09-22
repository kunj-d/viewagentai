<script>
$(document).ready(function() {
    $(".formclass1").submit(function(event) {
        var posturl = $(this).attr('action');
        $(this).ajaxSubmit({
            url: posturl,
            dataType: 'json',
            success: function(response) {
				
                if (response.success) {
					
					if(response.model=='hide')
					$('.modaldiv').modal('toggle');
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

<div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">Reset Password</h4>
                      </div>
					  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left formclass1" action="<?=$this->config->item('spanel_url').'reset-user-password'?>" method="post">
                      <div class="modal-body">
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_pass">New Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="new_pass" class="form-control col-md-7 col-xs-12" name="new_pass" value="">
						 <input type="hidden" name="user_id" value="<?=$user_id?>">
						 <input type="hidden" name="reset_pass" value="yes">
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
                        <button type="submit" class="btn btn-primary" >Update</button>
                      </div>
</form>
                    </div>
                  </div>