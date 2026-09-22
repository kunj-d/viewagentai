<style>
    .dataTables_filter label {
         color: var(--black-color) !important;
    }   
</style>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
 <div class="container-wrapper container-open">
        <title><?php echo $this->config->item('productName') ?> | Payment</title>
    <div class="container-fluid container-padding">
        <div class="row d-flex align-items-center">
            <div class="col-12">
                <div class="title-line">
                    Subscription
                </div>
            </div>
            <div class="col-12 col-md-12 mt20 ">
                <div class="tab-design">
                    <a class="nav-link" href="<?php echo base_url('subscription') ?>">Your Plan</a>
                    <a class="nav-link active" href="<?php echo base_url('payment') ?>">Payment History</a>
                    <?php
                    /*
                     <a class="nav-link" href="<?php echo base_url('user_credit') ?>">Credit</a>
                     */
                     ?>
                </div>
            </div>
        </div>
        <div class="row mt20">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-wrapper">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-borderless table-design">
                                        <thead>
                                            <tr>
                                                <th>Plan Purchased</th>
                                                <th>Payment Date</th>
                                                <th>Amount</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                             <?php foreach($payment_history as $pr_key=>$purchase_package_data) {
                                          ?>
                                       <tr>
                                          <td><?php echo $purchase_package_data["title"];?></td>
                                          <td><?php echo date("d/m/Y",$purchase_package_data["add_time"]);?> </td>
                                          <td><?php echo "$".$purchase_package_data["price"]?></td>
                                       </tr>
                                       <?php } ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            $('#datatable').DataTable();
         </script>
        