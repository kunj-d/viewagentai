<style>.dataTables_filter label {color: var(--black-color) !important; }</style>

<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<div class="container-wrapper container-open">
        <title><?php echo $this->config->item('productName') ?> || Chatbot List</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding">



            <div class="table-wrapper mt20 mt-md50">
                <div class="table-responsive">
                     <a href="#" class="action-btn red-btn-outline" id="del" style="display:none"> <i class="icon-list-delete"></i></a>
                    <table id="data-table" class="table table-striped px-4" style="width:100%">
                        <thead class="">
                            <tr>
                                <!--<th>-->
                                <!--    <input id="checkAll" class="form-check-input ng-pristine ng-untouched ng-valid"-->
                                <!--        type="checkbox">-->
                                <!--    <label for="checkAll" class="form-label"></label>-->
                                <!--</th>-->
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Expert</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                       <tbody>
    <?php foreach ($assistants as $index => $assistant) { ?>
        <tr>
            <!--<td>-->
                <!-- <div >-->
                <!--        <input class="form-check-input checkBox" id="check<?php echo $assistant['id']; ?>" data-id="<?php echo $assistant['id']; ?>" type="checkbox" >-->
                <!--        <label class="form-label" for="check<?php echo $assistant['id']; ?>"></label>-->
                <!--</div>-->
            <!--</td>-->
            <td><?= $index + 1 ?></td>
            <td><?= $assistant['text'] ?></td> 
            <td><?= $assistant['purpose'] ?></td> 
            <td>
                <div class="action-link">

                    <a href="<?= base_url() ?>virtual-assistant/appoint/<?= $assistant['id'] ?>" 
                    class="btn btn-primary shadow btn-xs sharp me-1" style="color: #fff; background-color: #6e4fde; border-color: #5b45d9;">
                        <span class="icon-list-edit icon-edit"></span>
                    </a>
                    <a href="#" 
                    class="btn btn-primary shadow btn-xs sharp me-1 getEmbedCode" data-script="<?php echo $assistant['script_tag'] ?>" style="color: #fff; background-color: #6e4fde; border-color: #5b45d9;">
                        <span class="icon-copy"></span>
                        
                    </a>
                    <a href="#"  data-id="<?= $assistant['id'] ?>" class="btn btn-danger shadow btn-xs sharp delete-va">
                         <i class="icon-list-delete icon-delete"></i>
                   </a>
                </div>
            </td>
        </tr>
    <?php } ?>
</tbody>

                    </table>
                </div>

            </div>
        </div>
        
     <script>
        $('#data-table').DataTable();
       $("#checkAll").click(function(){
             $('tbody input[type="checkbox"]').prop('checked', $(this).prop('checked'));
             $(this).css({"display":"block"});
        }); 
        
         $('#data-table').on('change', 'input[type="checkbox"]', function() {
                // Check the number of checkboxes checked
            var checkedCheckboxes = $('input[type="checkbox"]:checked');
            
            // Toggle the visibility of the multi-delete button based on the number of checked checkboxes
            $('#del').toggle(checkedCheckboxes.length > 1);
        });
        
        
         $('#del').on('click', function() {
                // Get an array of data for selected rows
                var selectedData = [];
                $('input[type="checkbox"]:checked').each(function() {
                    // var data = table.row($(this).closest('tr')).data();
                    var data = $(this).data('id');
                    if(data != undefined){
                         selectedData.push(data);
                    }
                    console.log(selectedData);
                });

                // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                             data: { ids: selectedData },
                            url: siteUrl + 'virtual-assistant/deletemultiva',
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                });
            });
        
        
    
    //these are the changes
    $(document).ready(function() {
        $('.delete-va').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                type: 'POST',
                 data: { id: id },
                url: siteUrl + 'virtual-assistant/delete',
                success: function(response) {
                    location.reload();
                }
            });
                    }
                });
            });
            
            
            
             $('.getEmbedCode').click(function() {
                 var text = $(this).data('script');
                 copyContent(text);
             });
            
            async function copyContent(text){
                try {
                     await navigator.clipboard.writeText(text);
                     toastr.info('Embeeded Script Copy');

                 } catch (err) {
                     console.error('Failed to copy: ', err);
                 }
            }
            
    });



      
      
</script>
