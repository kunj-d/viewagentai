<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="instaCtrl">
    <div class="container-fluid container-padding">
        <div class="position-relative" style="min-height: calc(100vh - 110px) !important; max-width: calc(100% - 240px);display: flex;flex-direction: column;align-items: center;justify-content: center; margin: auto;">
            <div class="text-center mb-4" style="max-width: 420px;">
                <h1 class="title-color mb-0 fw-bold">
                    Youtube <span class="text-primary">Growth</span> Suite
                </h1>
                <p class="subtitle mb-0">Analyze content, track competitors, discover AI opportunities, and optimize your strategy for faster YouTube growth.</p>
            </div>
            <div class="row row-gap-2">
                <div class="col-12 col-sm-6">
                    <a href="<?= base_url('analyz'); ?>" class="automation-box style-3">
                        <div class="automation-image">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/analyze-img.png" alt="image">
                        </div>
                        <div class="automation-content">
                            <h6 class="title">Analyze</h6>
                            <div class="divider"></div>
                            <p class="desc">Analyze any YouTube video and Get data-driven insights to outperform competition.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="<?= base_url('analyz-data'); ?>" class="automation-box style-3">
                        <div class="automation-image">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/optimize-img.png" alt="image">
                        </div>
                        <div class="automation-content">
                            <h6 class="title">Optimize</h6>
                            <div class="divider"></div>
                            <p class="desc">Improve performance with smart AI insights.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="<?= base_url('ai-query'); ?>" class="automation-box style-3">
                        <div class="automation-image">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/ai-quires-img.png" alt="image">
                        </div>
                        <div class="automation-content">
                            <h6 class="title">AI Quires</h6>
                            <div class="divider"></div>
                            <p class="desc">Enter a keyword to discover smart Al-generated queries.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="<?= base_url('competitor-spy'); ?>" class="automation-box style-3">
                        <div class="automation-image">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/spy-img.png" alt="image">
                        </div>
                        <div class="automation-content">
                            <h6 class="title">Competitor Spy</h6>
                            <div class="divider"></div>
                            <p class="desc">Enter a YouTube video URL or channel name to analyze competitors.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>