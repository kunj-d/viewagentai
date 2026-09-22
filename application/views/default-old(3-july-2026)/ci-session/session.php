<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<div class="container-wrapper container-open">
        <title><?php echo $this->config->item('productName') ?> | Session</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding">



            <div class="table-wrapper">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped px-4" style="width:100%">
                        <thead class="">
                            <tr>
                                <th>NAME</th>
                                <th>Email</th>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($lists as $key => $val){ 
                            ?>
                            <tr>
                                <td><?= $val['name'] ?></td>
                                <td><?= $val['email'] ?></td>
                                <td><?= $val['activity'] ?></td>
                                <td><?= $val['description'] ?></td>
                                <td><?= date('Y-m-d H:i:s',$val['created']) ?></td>
                                
                                
                              
                                
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        
     <script>
         $('#data-table').DataTable();
    </script>