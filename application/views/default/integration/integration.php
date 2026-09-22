<!-- Container Start -->
<div class="container-wrapper container-open" style=" min-height: calc(94vh);">
   <title><?php echo !empty($title) ? $title : '' ?> </title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" style=" min-height: calc(93vh);">
        <div class="row mt30 mt-md120">
            <div class="col-12">
                <div class="title-line ">
                    Integrations
                </div>
            </div>
        </div>
        <div class="row mt20 mt-md30">
            <div class="col-12 text-center blank-page-h d-flex align-items-center justify-content-center flex-column">
                <img src="<?= $this->config->item('assetsPath'); ?>images/connection.png" alt="Connection" class="mx-auto d-block img-fluid">
                <p class="mt20 integration-para">You haven't integrated anything yet.</p>
                <div class="mt20">
                    <a href="<?= base_url() ?>integration/add" class="theme-btn-blue">New Integration</a>
                </div>
            </div>
        </div>
    </div>