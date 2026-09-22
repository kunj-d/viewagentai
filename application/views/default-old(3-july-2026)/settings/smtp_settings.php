  <!-- Container Start -->
  <div class="container-wrapper container-open"><title><?php echo $this->config->item('productName') ?> | SMPT Settings</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding view-height"style=" min-height: calc(92vh);">
            <div class="row">
                <div class="col-12 mt50 mt-md50">
                    <div class="title-line">SMPT Settings</div>
                </div>
                
            </div>
            
            <form class="form_ajax field-design" action="<?= base_url('save-smtp')?>" enctype="multipart/form-data">
                <div class="row mt20 mt-md35">
                
                    <div class="col-md-5 col-xl-4">
                        <div class="mb20">
                            <label for="username" class="form-label">User Name</label> 
                            <input type="text" name="username" class="form-control search1" id="username" value="<?= !empty($data)?$data[0]->username:null; ?>" placeholder="Enter User Name">
                        </div>
                        <div class="mb20">
                            <label for="host" class="form-label">Host</label> 
                            <input type="text"  name="host"  class="form-control search1" id="host" value="<?= !empty($data)?$data[0]->host:null;; ?>" placeholder="Enter Host Name">
                        </div>
                        <div class="mb20">
                            <label for="password" class="form-label">Password</label> 
                            <input type="text" name="password" class="form-control search1"  id="password" placeholder="Enter password" value="<?=!empty($data)?$data[0]->password:null; ?>">
                        </div>
                    
                        
                    </div>
                
                
                <div class="col-md-5 col-xl-4">
                        
                    
                        <div class="mb20">
                            <label for="port" class="form-label">Port</label> 
                            <input type="text" class="form-control search1" name="port" id="port" placeholder="Enter port" value="<?= !empty($data)?$data[0]->port:null; ?>">
                        </div>
                        
                        <div class="mb20">
                            <label for="from_name" class="form-label">From name</label> 
                            <input type="text" class="form-control search1" name="from_name" id="from_name" placeholder="Enter From Name" value="<?= !empty($data)?$data[0]->from_name:null; ?>">
                        </div>
                        <div class="mb20">
                            <label for="from_email" class="form-label">From email</label> 
                            <input type="email" class="form-control search1" name="from_email" id="from_email" placeholder="Enter From Email" value="<?= !empty($data)?$data[0]->from_email:null; ?>">
                        </div>
                    </div>
                </div>
            
                <div class="row mt30 mt-md20">
                    <div class="col-md-2 col-xxl-2 col-4">
                        <input type="submit" value="Save" class="form-control theme-btn-blue" style="width: fit-content;">
                    </div>
                </div> 
            </form>
                
                
        </div>

   

    <script>
  var loadFile = function(event) {

    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

	
	
$(document).ready(function(){
	$('.form_ajax').submit(function(){
	var formdata=new FormData(this);
	// console.log(formdata);
		$.ajax({
			url:"<?= base_url('save-smtp'); ?>",
			type:"POST",
			dataType:"JSON",
			data:formdata,
			processData:false,
			contentType:false,
			success:function(response){
				 //showFlash(response);
				 setTimeout(function () {
				location.reload(true);
				}, 100);
				
			}
	  
		});
	});
	
});
		

</script>
