/* Addmore and remove function 

main container sag_container
<div id="sag_container">

Element repeat in this container id
<div id="element1" style="background-color:pink">A</div>
</div>

Element to repeat
<div class="element1">
<p  class="sag_count" ></p>
<input type="text" value="400"/>
<input type="button" value="Remove" class="sag_remove" sag_element="element1" />
</div>

Element to repeat end 
Add link/Button
<input type="button" value="Add" class="sag_add" sag_element="element1" sag_max_limit="3" sag_container="element1" />
*/

function addMore()
{
	"use strict";
	$('.sag_add').click(function(e){ //click event on add more fields button having class 
        e.preventDefault();
		var sag_element=$(this).attr('sag_element');
		var sag_max_limit=$(this).attr('sag_max_limit');
		var sag_container=$(this).attr('sag_container');
		var sag_model=$(this).attr('sag_model');
		
		if (typeof sag_max_limit !== typeof undefined && sag_max_limit !== false) {
			if($(".sag_count").length <= sag_max_limit){
				
				$("."+sag_element).first().clone().appendTo("#"+sag_container);
				 
				$("#"+sag_container).find(".sag_count").each(function(index) {
					//$(this).html(index+1);
					//alert($("#"+sag_container+":input").val());
				});
				$("#"+sag_container).find("input:text").each(function(index) {
					 var namePrefix = sag_model + '['+index+']';
					 $(this).attr('name', namePrefix);
					 $(this).attr('required', true);
				});
				$("#"+sag_container).find("input:radio").each(function(index) {
					  $(this).val(index);
					  if(index+1==1)
					  $(this).attr('checked', true);
					  
					  
				});
			}
			else
			{
				alert('Limit exceed');
			}
		}
		else
		{
			$("."+sag_element).first().clone().appendTo("#"+sag_container);
			$("#"+sag_element).find(".sag_count").each(function(index) {
				$(this).html(index+1);
			});
		}
	});
	$('body').on("click", ".sag_remove", function(e){ //user click on remove text links
		e.preventDefault();
		var sag_container=$(this).attr('sag_container');
		var sag_model=$(this).attr('sag_model');
		if($(".sag_count").length>2){
		var sag_element = $(this).attr('sag_element');
		$(this).parents("."+sag_element).remove();}
		$("#"+sag_container).find("input:text").each(function(index){
					 var namePrefix = sag_model + '['+index+']';
					 $(this).attr('name', namePrefix);
					 $(this).attr('required', true);
		});
		$("#"+sag_container).find("input:radio").each(function(index){
					 $(this).val(index);
					 
		});
	});
}

function camelCase(inputstring) {
	var a = inputstring.split('_'), i;
	s = [];
	for (i=0; i<a.length; i++){
	  s.push(a[i].charAt(0).toUpperCase() + a[i].substring(1));
	}
	s = s.join('');
	return s;
}
   
 $(document).ready(function(){
	"use strict";
	//addMore();
	formdata();
	datatable();
	
	

 /* Sag Link function 
 
 delete
 on-off
status change 
 */
	//$('.sag_link').click(function(e){
	$(document).on('click','.sag_link',function(e){
        e.preventDefault();
		
		var sag_ajax	=	$(this).attr('sag_ajax');    // db modification-delete work
		var sag_alert	=	$(this).attr('sag_alert');
		var sag_remove_container	=	$(this).attr('sag_remove_container');
		if (typeof sag_alert !== typeof undefined && sag_alert !== false) {	
			var result = confirm(sag_alert);
			if(!result){
			return false;
			}
			}
		if (typeof sag_ajax !== typeof undefined && sag_ajax !== false) {	
		
			var sag_url			     =	$(this).attr('sag_url');
			var sag_data_type	     =	$(this).attr('sag_data_type');
			var sag_update_container =	$(this).attr('sag_update_container');
			var sag_remove_container =	$(this).attr('sag_remove_container');
			 $.ajax({
				type : 'POST',
				url : sag_url,
				dataType : sag_data_type,
				processData: false,
				contentType: false,
				success: function(response){
			 if (typeof sag_remove_container !== typeof undefined && sag_remove_container !== false) {
			 if(sag_data_type=='json'){
				$("."+sag_remove_container).remove();
			 }
			 if(sag_data_type=='html'){
				 
				$("."+sag_remove_container).remove();
				var len = $('table tr').size();
				$('#total_records').val(len-1);
				}
			}
			if (typeof sag_update_container !== typeof undefined && sag_update_container !== false) {	
					if(sag_data_type=='html'){
					$('.'+sag_update_container).replaceWith(response);
	new PNotify({ 
 	title: 'Update Successfully', 
 	text: $("#msg").val(), 
 	type: 'success' 
 	}); 					
					}
					//$('#'+sag_update_container).html(result);
			}
		 }
		 });
		}
		if (typeof sag_remove_container !== typeof undefined && sag_remove_container !== false) {
			var sag_remove_container =	$(this).attr('sag_remove_container');
			var sag_data_type	     =	$(this).attr('sag_data_type');
				if(sag_data_type=='html'){
					$("."+sag_remove_container).remove();
				
				}
			}
		//some code here
	return false;
    });
});

$(function(){
var checked = [];
	$('#sag_select_all').on("click", function(event){
	   $(".sag_checkbox").prop('checked', $(this).prop("checked"));
	   checked = [];
	   $('.sag_checkbox:checked').each(function( index ) {
		  checked.push($( this ).val() );
		});
	});
	$('.sag_checkbox').change(function(){
		if(false == $(this).prop("checked")){ //if this item is unchecked
			$("#sag_select_all").prop('checked', false); 
		}
		if ($('.sag_checkbox:checked').length == $('.sag_checkbox').length ){
			$("#sag_select_all").prop('checked', true);
		}
		checked = [];
		$('.sag_checkbox:checked').each(function( index ) {
		  checked.push($( this ).val() );
		});
	});
	
	$('.sag_delete_all').click(function(e){
		e.preventDefault();
		var sag_remove_container	=	$(this).attr('sag_remove_container');
		var event_element=this;
		url = $(this).attr("action");
		var result = confirm('Are you sure you want to delete this?');
		$.post(url,
		{"data":checked},
		function(data){
				$('.sag_checkbox:checked').each(function(index) {
				$(this).parents("."+sag_remove_container).remove();
				$('#ajax_msg').html('<div class="message success">The post has been saved.</div>').fadeIn().delay(2000).fadeOut("slow");
			});
		});
    });
});
function formdata(){

$('.sag_submit').on('submit',function(event){ 
	
		var sag_ajax=$(this).attr('sag_ajax');
		if(sag_ajax=='true'){
			 event.preventDefault();
		 }
		
		var url=$(this).attr('sag_url');
		var value = url.substring(url.lastIndexOf('/') + 1);
		var sag_name=$(this).attr('sag_name');
		var data_type=$(this).attr('sag_data_type');
		var formdata=$("form").serialize();
		event.preventDefault();
		$.ajax({
		type : 'POST',
		url : url,
		data: new FormData(this),
		dataType : 'json',
	    processData: false,
		contentType: false,
		beforeSend: function()
             {
		 $('#save').val('Saving...');
		 $('#save').attr('disabled', true);
		 $(".error-message").remove();
           },
			success: function(response){
				console.log(response);
		 },
				error : function() {
      }
    });
 });
}



function datatable(){
	
$(document).ready(function() {
    $('#example').DataTable( {
       
    } );
} );

	
}

