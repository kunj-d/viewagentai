
$(document).ready(function(){
	"use strict";
	$('#profitmozo_search').click(function(e){
		e.preventDefault();
		search();	
	});	
	$('#per_page').change(function(e){
		e.preventDefault();
		search();	
	});
});

function search(){
	var total=$("#per_page option:selected").attr("value");

			var data = {
				startdate:$('#start_date').val(),
				enddate:$('#end_date').val(),
				keyword:$('#keyword').val(),
				per_page:$("#per_page option:selected").attr("value")
				}
			var url= $("#profitmozo_search").attr('url');
			if(data!=''){
				$.ajax({
					url: url,
					type: "POST",
					data: data,
					success: function(response) {
						data = $.parseJSON(response);
						inserttolist(data);
					},
					error: function(e) 
					{
							
					} 	        
			   });
			}
}
function inserttolist(response){
	$("#socialmozo_list").find("tbody").html("");
	$.each(response, function( index, value ) {
		var tr='<tr class="sag_remove_container">\
					<td><input class="sag_checkbox" multiple="multiple" value="'+value.id+'" type="checkbox"></td>\
					<td>'+value.title+'</td>\
					<td><img src="' + value.template_id + '"/></td>\
					<td>facebook</td>\
					<td>'+value.schedule_on+'</td>\
					<td>'+value.type+'</td>\
					<td>\
					<a href="javascript:" class="btn btn-primary btn-xs viewlink" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="1"><i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i> </a>\
					<a href="http://192.168.0.130/profitmozo/BMS/edit-socialmozo/1" class="btn btn-info btn-xs" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>\
					<a href="javascript:" class="btn btn-danger btn-xs deletelink" title="" data-toggle="tooltip" data-placement="top" data-href="http://192.168.0.130/profitmozo/BMS/delete-socialmozo/1" data-original-title="Delete"><i class="fa fa-trash-o"></i> </a>\
					</td>\
				</tr>';
		$("#socialmozo_list").find("tbody").append(tr);
	});
	
}



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
		
			var values=$("#default_filter option:selected").attr("mytag")
			var url = $("#default_filter option:selected").attr('sag_url');
			e.preventDefault();
			var sag_remove_container	=	$(this).attr('sag_remove_container');
			var event_element=this;
			alert(sag_remove_container);
			
			bootbox.confirm("Are you sure to delete this Socialmozo?", function(result) {
			if(result) {
			$.post(url,
			{"data":checked},
			function(data){
				$('.sag_checkbox:checked').each(function(index) {
				$(event_element).parents("."+sag_remove_container).remove();
				
			});
		});
	  }
	}); 
			
			//var result = confirm('Are you sure you want to delete this?');
			
    });
	
	
	

});




	


function formdata(){

$('.sag_submit').on('click',function(event){ 
	event.preventDefault();
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

