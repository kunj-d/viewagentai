<style>
.turtorials-heading{
    width: 100%;
}
.headings{
    background: var(--theme-bg);
    border: 1px solid var(--theme-br);
    border-radius: 5px;
    max-height: 400px;
    overflow-y: auto;
    padding: 20px 10px;
}
.turtorials-heading .headings button{
    width: 100%;
    background: transparent;
    color: var(--theme-color);
    border: 1px solid var(--theme-br)!important;
    font-size: 14px;
    font-weight: 600;
    outline: none;
    margin-bottom: 14px;
    border-radius: 5px;
    text-align: left;
    padding: 14px 30px;
}
.headings button.active{
    background: var(--primary-color);
    /* color: var(--text-primary) !important; */
}

.turtorials-content{
    border-radius: 5px;
    background: var(--theme-bg);
    padding: 30px;
    border: 1px solid var(--theme-br);
    /* box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; */
    position: sticky;
    top: 50px;
}
.turtorials-content .desc{
    font-size: 14px;
    color: var(--grey-color);
    margin-top: 10px;
}
.video-demo{
    max-width: 100%;
    position: relative;
    margin-top: 20px;

}
.video-demo.loading::before{
    content: 'Loading...';
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: rgba(0,0,0,0.6);
    font-size: 2.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
}
.video-demo iframe{
    width: 100%;
    height: auto;
    border-radius: 5px;
    /* box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; */
}
@media (min-width: 768px ){
    .video-demo iframe{
        /* height: 300px; */
        aspect-ratio: 16 / 9;
        overflow: hidden;
    }
}
.video-demo img{
    max-height: 300px;
    object-fit: contain;
}
</style>

<div class="container-wrapper container-open">
        <title><?php echo $this->config->item('productName') ?> | Tutorials</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <div class="title-line">
                        Tutorials
                    </div>
                </div>
            </div>
            <!--<div class="row">-->
            <!--    <div class="tab-content" id="pills-tabContent">-->
            <!--        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"-->
            <!--            aria-labelledby="pills-home-tab">-->
            <!--            <div class="row">-->
                            <?php // foreach($video_data as $data){
                        	?>
                            <!--<div class="col-12 col-md-3 mt20 mt-md0 mt-4">-->
                            <!--    <div class="tab-box">-->
                            <!--        <div class="tutorial-box">-->
                            <!--            <a href="#" data-bs-toggle="modal" data-bs-target="#videoModal<?php echo $data->video_id?>">-->
                            <!--                <div class="poster">-->
                            <!--                    <img src="<?php // echo $this->config->item('uploadPath').'training_video_image/'.$data->video_thumbnail; ?>" alt="Video" class="img-fluid d-block mx-auto">-->
                            <!--                </div>-->
                            <!--            </a>-->
                            <!--              <a href="#" class="title" data-bs-toggle="modal" data-bs-target="#videoModal<?php //echo $data->video_id?>"> <?php // echo $data->title; ?> </a>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="modal fade pop" id="videoModal<?php //echo $data->video_id?>"  tabindex="-1"-->
                            <!--        aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                            <!--        <div class="modal-dialog modal-dialog-centered modelw-450">-->
                            <!--            <div class="modal-content">-->
                            <!--                <div class="modal-body text-center">-->
                            <!--                   <div style="padding-bottom: 56.25%;position: relative;">-->
                                                  <!--              
                                    box-shadow: none !important;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <?php // } ?>
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            
            <div class="row mt20">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <nav class="turtorials-heading">
                                    <div class="nav mb-3 headings" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-product-training-tab" data-bs-toggle="tab" data-bs-target="#product-training" type="button" role="tab" aria-controls="product-training" aria-selected="false">Product Training</button> 
                                         <button class="nav-link" id="nav-live-training-tab" data-bs-toggle="tab" data-bs-target="#live-training" type="button" role="tab" aria-controls="live-training" aria-selected="false">Get Started With Social Claw AI</button> 
                                        <button class="nav-link" id="nav-dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard-tab" type="button" role="tab" aria-controls="dashboard-tab" aria-selected="false">Command Center Option</button>
                                        <button class="nav-link" id="nav-image-to-image-tab" data-bs-toggle="tab" data-bs-target="#image-to-image" type="button" role="tab" aria-controls="image-to-image" aria-selected="false">Instagram Integration Process</button>
                                         <button class="nav-link" id="nav-Let’s-Work-tab" data-bs-toggle="tab" data-bs-target="#Let’s-Work" type="button" role="tab" aria-controls="Let’s-Work" aria-selected="false">Facebook Integration Process</button> 
                                         <button class="nav-link" id="nav-ai-template-editor-tab" data-bs-toggle="tab" data-bs-target="#ai-template-editor" type="button" role="tab" aria-controls="ai-template-editor" aria-selected="false">YouTube Integration Process</button> 
                                        <!--<button class="nav-link" id="nav-trained-chatbot-tab" data-bs-toggle="tab" data-bs-target="#trained-chatbot" type="button" role="tab" aria-controls="trained-chatbot" aria-selected="false">Automation Option </button>-->
                                        <!-- <button class="nav-link" id="nav-text-to-image-tab" data-bs-toggle="tab" data-bs-target="#text-to-image" type="button" role="tab" aria-controls="text-to-image" aria-selected="false">AI Agent Option</button>-->
                                        <button class="nav-link" id="nav-text-to-audio-tab" data-bs-toggle="tab" data-bs-target="#text-to-audio" type="button" role="tab" aria-controls="text-to-audio" aria-selected="false">Agency Option</button>
                                        <button class="nav-link" id="nav-text-to-video-tab" data-bs-toggle="tab" data-bs-target="#text-to-video" type="button" role="tab" aria-controls="text-to-video" aria-selected="false">Settings Option</button>
                                        
                                        <!--  <button class="nav-link" id="nav-tutorial-media-tab" data-bs-toggle="tab" data-bs-target="#tutorial-media" type="button" role="tab" aria-controls="tutorial-media" aria-selected="false">My Stocks </button>
                                        <button class="nav-link" id="nav-my-assets-tab" data-bs-toggle="tab" data-bs-target="#my-assets" type="button" role="tab" aria-controls="my-assets" aria-selected="false">My Assets</button>
                                        
                                        <button class="nav-link" id="nav-tutorial-leads-tab" data-bs-toggle="tab" data-bs-target="#tutorial-leads" type="button" role="tab" aria-controls="tutorial-leads" aria-selected="false">Leads</button>
                                        <button class="nav-link" id="nav-white-label-tab" data-bs-toggle="tab" data-bs-target="#white-label" type="button" role="tab" aria-controls="white-label" aria-selected="false">White Label</button>
                                        <button class="nav-link" id="nav-tutorial-settings-tab" data-bs-toggle="tab" data-bs-target="#tutorial-settings" type="button" role="tab" aria-controls="tutorial-settings" aria-selected="false">Settings</button> -->
                                        <!-- <button class="nav-link" id="nav-tutorial-profile-tab" data-bs-toggle="tab" data-bs-target="#tutorial-profile" type="button" role="tab" aria-controls="tutorial-profile" aria-selected="false">Profile</button> -->
                                    </div>
                                </nav>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content turtorials-content" id="nav-tabContent">
                                     <div class="tab-pane fade active show" id="product-training" role="tabpanel" aria-labelledby="nav-product-training-tab">
                                        <h4 class="title-line">
                                        Product Training  
                                        </h4>
                                        <a class="d-block" href="https://warriorplus.com/o2/a/ry4bfxs/0" target="_blank" style="margin-top: 20px;">
                                            <img class="img-fluid w-100" src="<?= $this->config->item('assetsPath') ?>images/pt.png" alt="PT image" style="aspect-ratio: 16 / 9;">
                                        </a>  
                                    </div>
                                     <div class="tab-pane fade" id="live-training" role="tabpanel" aria-labelledby="nav-live-training-tab">
                                        <h4 class="title-line">
                                        Get Started With Social Claw AI
                                        </h4>
                                        <p class="desc">Learn how to access and navigate your product dashboard easily.</p>
                                        <div class="video-demo">
                                            <iframe src="https://socialclaw-ai.dotcompal.co/video/embed/ik5gwwcw3x" data-videosrc="https://socialclaw-ai.dotcompal.co/video/embed/ik5gwwcw3x" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="dashboard-tab" role="tabpanel" aria-labelledby="nav-dashboard-tab">
                                        <h4 class="title-line">
                                        Command Center Option
                                        </h4>
                                        <p class="desc">Create, schedule, and automate social media content using simple AI commands.</p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://socialclaw-ai.dotcompal.co/video/embed/961qywgada" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Let’s-Work" role="tabpanel" aria-labelledby="nav-Let’s-Work-tab">
                                        <h4 class="title-line">
                                           Facebook Integration Process
                                        </h4>
                                        <p class="desc">Connect Facebook to manage pages and automate actions.</p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://socialclaw-ai.dotcompal.co/video/embed/geqcgyhoep" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="text-to-image" role="tabpanel" aria-labelledby="nav-text-to-image-tab">
                                        <h4 class="title-line">
                                        AI Agent Option
                                        </h4>
                                        <p class="desc">
                                        Access a wide range of AI agents, designed to assist you across various niches.                                      </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://insta-engine-ai.dotcompal.co/video/embed/9hn8oxr1z1" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="image-to-image" role="tabpanel" aria-labelledby="nav-image-to-image-tab">
                                        <h4 class="title-line">
                                        Instagram Integration Process
                                    </h4>
                                        <p class="desc">
                                        Link Instagram to schedule posts and automate engagement.
                                    </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://socialclaw-ai.dotcompal.co/video/embed/g4xwb44wvd" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div> 
                                    </div>
                                    <div class="tab-pane fade" id="text-to-video" role="tabpanel" aria-labelledby="nav-text-to-video-tab">
                                        <h4 class="title-line">
                                        Settings Option
                                        </h4>
                                        <p class="desc">
                                            Configure and manage key account settings, integrations, and other personalization options.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://socialclaw-ai.dotcompal.co/video/embed/bq442amo1g" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="text-to-audio" role="tabpanel" aria-labelledby="nav-text-to-audio-tab">
                                        <h4 class="title-line">
                                        Agency Option
                                        </h4>
                                        <p class="desc">
                                            Access tools to manage clients, teams, branding, proposals, invoices, and performance reports easily.
                                        </p>
                                        <div class="video-demo">
                                             <iframe src="" data-videosrc="https://socialclaw-ai.dotcompal.co/video/embed/gf4vj8zmj2" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> 
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="trained-chatbot" role="tabpanel" aria-labelledby="nav-trained-chatbot-tab">
                                        <h4 class="title-line">
                                        Automation Option
                                        </h4>
                                        <p class="desc">
                                            Set up and manage automated replies and comments for your Instagram & YouTube videos effortlessly.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-engine-ai.dotcompal.co/video/embed/789klpfv7t" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="ai-template-editor" role="tabpanel" aria-labelledby="nav-ai-template-editor-tab">
                                        <h4 class="title-line">
                                        YouTube Integration Process  
                                        </h4>
                                        <p class="desc">
                                        YouTube to manage videos and automate publishing.                                         </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://socialclaw-ai.dotcompal.co/video/embed/n4ba4s8vbs" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="my-assets" role="tabpanel" aria-labelledby="nav-my-assets-tab">
                                        <h4 class="title-line">
                                        Coming Soon
                                        </h4>
                                        <!-- <p class="desc">
                                            Explore how to centralizes and organizes your resources, ensuring seamless access and management of your valuable assets for enhanced productivity.
                                        </p> -->
                                        <div class="video-demo">
                                            <!-- <iframe src="" data-videosrc="https://aiagentsarmy.oppyo.com/video/embed/jn2gusnd6j" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> -->
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="tutorial-media" role="tabpanel" aria-labelledby="nav-tutorial-media-tab">
                                        <h4 class="title-line">
                                        Coming Soon
                                        </h4>
                                       <!--  <p class="desc">
                                            Discover the advantages of Media and how to make the most of it.
                                        </p> -->
                                        <div class="video-demo">
                                            <!-- <iframe src="" data-videosrc="https://aiagentsarmy.oppyo.com/video/embed/8kj6l1y4p6" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> -->
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="tutorial-leads" role="tabpanel" aria-labelledby="nav-tutorial-leads-tab">
                                        <h4 class="title-line">
                                        Coming Soon
                                        </h4>
                                        <!-- <p class="desc">
                                            Learn the ins and outs of lead management in this simple tutorial.
                                        </p> -->
                                        <div class="video-demo">
                                            <!-- <iframe src="" data-videosrc="https://aiagentsarmy.oppyo.com/video/embed/8vkdxr2ykw" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> -->
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="white-label" role="tabpanel" aria-labelledby="nav-white-label-tab">
                                        <h4 class="title-line">
                                        Coming Soon
                                        </h4>
                                       <!--  <p class="desc">
                                            Learn how to personalize your brand with White Label in this step-by-step guide.
                                        </p> -->
                                        <div class="video-demo">
                                            <!-- <iframe src="" data-videosrc="https://aiagentsarmy.oppyo.com/video/embed/ws2tpo2nrk" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> -->
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="tutorial-settings" role="tabpanel" aria-labelledby="nav-tutorial-settings-tab">
                                        <h4 class="title-line">
                                        Coming Soon
                                        </h4>
                                        <!-- <p class="desc">
                                            Master the Settings section with this comprehensive tutorial.
                                        </p> -->
                                        <div class="video-demo">
                                            <!-- <iframe src="" data-videosrc="https://aiagentsarmy.oppyo.com/video/embed/96twrmaw4n" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> -->
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="tutorial-profile" role="tabpanel" aria-labelledby="nav-tutorial-profile-tab">
                                        <h4 class="title-line">
                                        Coming Soon
                                        </h4>
                                        <!-- <p class="desc">
                                            Unlock the full potential of your Profile section with this detailed walkthrough.
                                        </p> -->
                                        <div class="video-demo">
                                            <!-- <iframe src="" data-videosrc="https://aiagentsarmy.oppyo.com/video/embed/fimwqxyrql" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> -->
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
$('.turtorials-heading .nav-link').on('click',function(){
        $('.turtorials-content .tab-pane').find('.video-demo iframe').attr('src','');
        $('.turtorials-content .tab-pane').each(function(){
            $('.turtorials-content .tab-pane.active').find('.video-demo').addClass('loading');
            setTimeout(() => {
                if($(this).hasClass('active')){
                    var url = $(this).find('.video-demo iframe').data('videosrc')
                    // var url = 'https://www.instaengineai.com/jv/assets/images/video-sample.webp';
                    $(this).find('.video-demo iframe').attr('src',url)
                    $(this).find('.video-demo').removeClass('loading');
                }
            }, 200);
        })
    })
</script>