<style>
    .dataTables_filter label {
         color: var(--black-color) !important;
    }   
</style>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
 <div class="container-wrapper container-open">
        <title>Ultimate Ai || Payment</title>
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
                    <a class="nav-link" href="<?php echo base_url('payment') ?>">Payment History</a>
                    <a class="nav-link active" href="<?php echo base_url('user_credit') ?>">Credit</a>
                </div>
            </div>
        </div>
        <div class="row mt20">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="credit-card">
                        <div class="credit-card-header">
                            <!--<p class="title">-->
                            <!--    <span class="text-primary">Credit Left:</span>-->
                            <!--    Unlimited Credit                            -->
                            <!--</p>-->
                            <?php  
                                // if ($this->user_id != $this->owner_id) {
                                    echo '<p class="title"><span class="text-primary">Credit Left:</span> ' . $remainCredit . '</p>';
                                
                            ?>


                            
                            <!--<a href="https://www.getultimateai.com/credit/" target="_blank" class="btn btn-sm btn-primary">Recharge</a>-->
                        </div>
                        <div class="credit-card-body">
                            <p class="mb-1"><span class="text-title">1 Avatar video</span>  = 10 Credits</p>
                            <p class="mb-1"><span class="text-title">1 Ai Images</span>  = 5 Credits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            $('#datatable').DataTable();
         </script>
        