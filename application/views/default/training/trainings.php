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
    color: var(--theme-color);
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
                                         <button class="nav-link" id="nav-live-training-tab" data-bs-toggle="tab" data-bs-target="#live-training" type="button" role="tab" aria-controls="live-training" aria-selected="false">Get Started With TubeClaw AI</button> 
                                        <button class="nav-link" id="nav-dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard-tab" type="button" role="tab" aria-controls="dashboard-tab" aria-selected="false">Tube Agent Option</button>
                                        <button class="nav-link" id="nav-Let’s-Work-tab" data-bs-toggle="tab" data-bs-target="#Let’s-Work" type="button" role="tab" aria-controls="Let’s-Work" aria-selected="false">Create Video Option</button> 
                                        <button class="nav-link" id="nav-ai-template-editor-tab" data-bs-toggle="tab" data-bs-target="#ai-template-editor" type="button" role="tab" aria-controls="ai-template-editor" aria-selected="false">YouTube (YT) Growth Option</button> 
                                        <button class="nav-link" id="nav-image-to-image-tab" data-bs-toggle="tab" data-bs-target="#image-to-image" type="button" role="tab" aria-controls="image-to-image" aria-selected="false">Lead Finder Option</button>
                                        <button class="nav-link" id="nav-trained-chatbot-tab" data-bs-toggle="tab" data-bs-target="#trained-chatbot" type="button" role="tab" aria-controls="trained-chatbot" aria-selected="false">Automation Option </button>
                                        <button class="nav-link" id="nav-text-to-image-tab" data-bs-toggle="tab" data-bs-target="#text-to-image" type="button" role="tab" aria-controls="text-to-image" aria-selected="false">AI Agent Option</button>
                                        <button class="nav-link" id="nav-text-to-audio-tab" data-bs-toggle="tab" data-bs-target="#text-to-audio" type="button" role="tab" aria-controls="text-to-audio" aria-selected="false">Instagram (IG) Trend Analysis Option</button>
                                        <button class="nav-link" id="nav-text-to-video-tab" data-bs-toggle="tab" data-bs-target="#text-to-video" type="button" role="tab" aria-controls="text-to-video" aria-selected="false">Agency Option</button>
                                        <button class="nav-link" id="nav-tutorial-media-tab" data-bs-toggle="tab" data-bs-target="#tutorial-media" type="button" role="tab" aria-controls="tutorial-media" aria-selected="false">Facebook Integration Process</button>
                                        <button class="nav-link" id="nav-my-assets-tab" data-bs-toggle="tab" data-bs-target="#my-assets" type="button" role="tab" aria-controls="my-assets" aria-selected="false">Instagram Integration Process</button>
                                        <button class="nav-link" id="nav-tutorial-leads-tab" data-bs-toggle="tab" data-bs-target="#tutorial-leads" type="button" role="tab" aria-controls="tutorial-leads" aria-selected="false">YouTube Integration Process</button>
                                        <button class="nav-link" id="nav-white-label-tab" data-bs-toggle="tab" data-bs-target="#white-label" type="button" role="tab" aria-controls="white-label" aria-selected="false">How To Connect Telegram</button>
                                        <!--  <button class="nav-link" id="nav-tutorial-settings-tab" data-bs-toggle="tab" data-bs-target="#tutorial-settings" type="button" role="tab" aria-controls="tutorial-settings" aria-selected="false">Settings</button> -->
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
                                        <a class="d-block" href="https://www.dotcompal.com/video/embed/zycd1bm5au%22" target="_blank" style="margin-top: 20px;">
                                            <img class="img-fluid w-100" src="<?= $this->config->item('assetsPath') ?>images/pt.png" alt="PT image" style="aspect-ratio: 16 / 9;">
                                        </a>
                                        <div class="w-100 text-center mt-2">
                                            <a href="https://www.dotcompal.com/tubeclawai-customer-special-training" target="_blank" type="button" class="btn btn-primary">
                                                Yes, I want LaunchPad
                                            </a>
                                        </div>    
                                    </div>
                                     <div class="tab-pane fade" id="live-training" role="tabpanel" aria-labelledby="nav-live-training-tab">
                                        <h4 class="title-line">
                                        Get Started With TubeClaw AI
                                        </h4>
                                        <p class="desc">Learn the basics and set up TubeClaw AI.</p>
                                        <div class="video-demo">
                                            <iframe src="https://tube-claw-ai.dotcompal.co/video/embed/yoiubce4es" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/yoiubce4es" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="dashboard-tab" role="tabpanel" aria-labelledby="nav-dashboard-tab">
                                        <h4 class="title-line">
                                        Tube Agent Option
                                        </h4>
                                        <p class="desc">Generate, schedule, and publish videos using one prompt.</p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/km32ujsln2" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Let’s-Work" role="tabpanel" aria-labelledby="nav-Let’s-Work-tab">
                                        <h4 class="title-line">
                                           Create Video Option
                                        </h4>
                                        <p class="desc">Connect Facebook to manage pages and automate actions.</p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/w4ozz7ltmf" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="text-to-image" role="tabpanel" aria-labelledby="nav-text-to-image-tab">
                                        <h4 class="title-line">
                                        AI Agent Option
                                        </h4>
                                        <p class="desc">
                                        Use specialized AI agents for content and marketing.</p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/48cupysimo" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="image-to-image" role="tabpanel" aria-labelledby="nav-image-to-image-tab">
                                        <h4 class="title-line">
                                        Lead Finder Option
                                    </h4>
                                        <p class="desc">
                                        Find local businesses with complete contact details.
                                    </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/9h1spdfbet" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div> 
                                    </div>
                                    <div class="tab-pane fade" id="text-to-video" role="tabpanel" aria-labelledby="nav-text-to-video-tab">
                                        <h4 class="title-line">
                                        Agency Option
                                        </h4>
                                        <p class="desc">
                                            Manage clients and access agency business tools.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/gwxmpkw2kl" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="text-to-audio" role="tabpanel" aria-labelledby="nav-text-to-audio-tab">
                                        <h4 class="title-line">
                                        Instagram (IG) Trend Analysis Option
                                        </h4>
                                        <p class="desc">
                                            Discover trending hashtags and popular Instagram content.
                                        </p>
                                        <div class="video-demo">
                                             <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/yipi1ozeoy" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> 
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="trained-chatbot" role="tabpanel" aria-labelledby="nav-trained-chatbot-tab">
                                        <h4 class="title-line">
                                        Automation Option
                                        </h4>
                                        <p class="desc">
                                           Automate posts, comments, and replies across social media.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/pb83jmiuj9" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="ai-template-editor" role="tabpanel" aria-labelledby="nav-ai-template-editor-tab">
                                        <h4 class="title-line">
                                        YouTube (YT) Growth Option 
                                        </h4>
                                        <p class="desc">Analyze and optimize videos for better AI visibility.</p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/e2abwczm1a" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="my-assets" role="tabpanel" aria-labelledby="nav-my-assets-tab">
                                        <h4 class="title-line">
                                       Instagram Integration Process
                                        </h4>
                                        <p class="desc">
                                            Link your Instagram account for automated publishing and content management.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/d6utw3unqo" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="tutorial-media" role="tabpanel" aria-labelledby="nav-tutorial-media-tab">
                                        <h4 class="title-line">
                                        Facebook Integration Process
                                        </h4>
                                        <p class="desc">
                                            Connect your Facebook account to automate posting, comments, and engagement.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/ubkj7jdvkk" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="tutorial-leads" role="tabpanel" aria-labelledby="nav-tutorial-leads-tab">
                                        <h4 class="title-line">
                                        YouTube Integration Process
                                        </h4>
                                        <p class="desc">
                                           Connect your YouTube channel to publish and optimize videos automatically.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/laeafqa4jg" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                            <!-- <img src="https://www.instaengineai.com/jv/assets/images/video-sample.webp">     -->
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="white-label" role="tabpanel" aria-labelledby="nav-white-label-tab">
                                        <h4 class="title-line">
                                        How To Connect Telegram
                                        </h4>
                                        <p class="desc">
                                           Connect your Telegram and access it directly from Telegram.
                                        </p>
                                        <div class="video-demo">
                                            <iframe src="" data-videosrc="https://tube-claw-ai.dotcompal.co/video/embed/jzbqyrcuki" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
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