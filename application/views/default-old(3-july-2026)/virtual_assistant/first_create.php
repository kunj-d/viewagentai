 <!-- Container Start -->
 <div class="container-wrapper container-open">
        <title><?php echo $this->config->item('productName') ?>|| AI Dashboard</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding" style=" min-height: calc(93vh);">
            <div class="row mt50">
                <div class="col-12">
                    <div class="title-line">
                        My VA
                    </div>
                </div>
            </div>
            <div class="row mt50">
                <div
                    class="col-12 text-center blank-page-h d-flex align-items-center justify-content-center flex-column mt50">
                    <img src="<?= $this->config->item('assetsPath') ?>images/img.png" alt="Connection" class="mx-auto d-block img-fluid">
                    <p class="mt20 integration-para">Create a VA To Get Started</p>
                    <div class="mt10">
                        <a href="<?=base_url() ?>virtual-assistant/create" class="theme-btn-blue">Create New VA</a>
                    </div>
                </div>
            </div>
        </div>