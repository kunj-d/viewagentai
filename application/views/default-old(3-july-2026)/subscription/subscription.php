<style>
    .list-style-none{
        list-style: none;
    }
    .subscription-box li span{
        font-weight: 600;
    }
    .subscription-box img{
        width: 120px;
    }
    .pt10{
        padding-top:10px;
    }
    .subscription-box ul li{
        padding: 10px 0;
        font-weight: 400;
        border-bottom: 1px solid rgba(255,255,255,0.1)
    }
    .subscription-box ul{
        display: none;
        height: 300px;
        overflow-y: scroll;

    }
</style>
    <div class="container-wrapper container-open">
        <title><?php echo $this->config->item('productName') ?> | Subscription</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <div class="title-line">
                        Subscription
                    </div>
                </div>
                <div class="col-12 col-md-12 mt20 ">
                    <div class="tab-design">
                        <a class="nav-link active" href="<?php echo base_url('subscription') ?>">Your Plan</a>
                        <a class="nav-link" href="<?php echo base_url('payment') ?>">Payment History</a>
                        <?php
                        /*
                         <a class="nav-link" href="<?php echo base_url('user_credit') ?>">Credit</a>
                         */
                         ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1 row-gap mt-lg-4 mt-3">

                            <div class="col">
                                <div class="subscription-box">
                                    <img src="<?php echo $assetsPath.'default/subscription/default.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Vesora AI Commercial</p>
                                    <p class="text-center"><span class="days-text">$17</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Analyze, Optimize & Spy on Competitors — Start Winning in AI Search Today</li>

                                        <li>Analyze YouTube Videos – Paste any URL and get AEO Score & AI Visibility across ChatGPT, Gemini, Grok & Claude (10 URLs/Day)</li>

                                        <li>Optimize Video Titles – AI rewrites your title for maximum AI search visibility (10/Day)</li>

                                        <li>Optimize Video Descriptions – Restructure descriptions so AI engines can read, understand & recommend your video (10/Day)</li>

                                        <li>Optimize Video Tags – Replace outdated tags with AI-aligned keywords that actually rank (10/Day)</li>

                                        <li>AI Query Research – Find exact queries people ask on ChatGPT, Gemini, Grok & Claude, sorted by source (25/Day)</li>

                                        <li>AI Thumbnail Analyzer</li>

                                        <li>Connect YouTube Channel – Connect your channel directly and analyze your own videos without pasting URLs</li>

                                        <li>Commercial License – Offer services to clients and keep 100% of every dollar you earn</li>

                                        <li>30-Day Money-Back Guarantee – Zero risk, full refund if not satisfied within 30 days</li>                           
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                    <?php if(!empty($fe_A_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $fe_A_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $fe_A_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="subscription-box">
                                     <img src="<?php echo $assetsPath.'default/subscription/unlimited.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Visora AI Unlimited - Gold</p>
                                    <p class="text-center"><span class="days-text">$67</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Remove Every Limit — Do Everything Without Any Restrictions</li>

                                        <li>Unlimited Video URL Audits – Audit as many videos as you want, no daily cap, ever.</li>

                                        <li>Unlimited AI Visibility Checks – Check AI visibility across all 4 platforms without any limit.</li>

                                        <li>Unlimited Title Optimizations – Rewrite unlimited video titles anytime, with no restrictions.</li>

                                        <li>Unlimited Description Optimizations – Optimize every description without hitting any limits.</li>

                                        <li>Unlimited Tag Optimizations – Replace tags across all your videos without any cap.</li>

                                        <li>Unlimited AI Query Research – Pull unlimited queries from ChatGPT, Gemini, Grok & Claude across all sources, with no limits.</li>

                                        <li>Priority AI Processing – Faster results, no queue, no waiting; your requests are processed first.</li>

                                        <li>No Limits on Anything – Full platform freedom with every feature completely unlimited, forever.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                            <?php   if(!empty($pro_B_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $pro_B_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $pro_B_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="subscription-box">
                                     <img src="<?php echo $assetsPath.'default/subscription/unlimited.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Visora AI Unlimited - Platinum</p>
                                    <p class="text-center"><span class="days-text">$147</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Remove Every Limit — Do Everything Without Any Restrictions</li>

                                        <li>Unlimited Video URL Audits – Audit as many videos as you want, no daily cap, ever.</li>

                                        <li>Unlimited AI Visibility Checks – Check AI visibility across all 4 platforms without any limit.</li>

                                        <li>Unlimited Title Optimizations – Rewrite unlimited video titles anytime, with no restrictions.</li>

                                        <li>Unlimited Description Optimizations – Optimize every description without hitting any limits.</li>

                                        <li>Unlimited Tag Optimizations – Replace tags across all your videos without any cap.</li>

                                        <li>Unlimited AI Query Research – Pull unlimited queries from ChatGPT, Gemini, Grok & Claude across all sources, with no limits.</li>

                                        <li>Priority AI Processing – Faster results, no queue, no waiting; your requests are processed first.</li>

                                        <li>No Limits on Anything – Full platform freedom with every feature completely unlimited, forever.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                            <?php   if(!empty($pro_B_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $pro_B_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $pro_B_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Client Finder -->
                            <div class="col">
                                <div class="subscription-box">
                                        <?php if($traffic_recomnded == 1) { ?>
                                        <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                        <img src="<?php echo $assetsPath.'default/subscription/client-finder.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Visora AI Client Finder</p>                                  
                                    <p class="text-center"><span class="days-text">$97</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Find Ready-to-Pay Clients & Get Paid $300–$1,000/Month</li>

                                        <li>Business Finder – Find business leads using names and locations, ready to pitch instantly.</li>

                                        <li>Channel Finder – Find YouTube channels by keyword, filtered and ready to contact.</li>

                                        <li>Smart Lead Filters – Filter by weak titles, poor descriptions, low views, bad thumbnails, and inactive accounts.</li>

                                        <li>DFY Cold Outreach Emails – Done-for-you email scripts to land clients without writing a single word.</li>

                                        <li>DFY DM Scripts – Close clients through direct messages using proven conversation templates.</li>

                                        <li>DFY Proposal Templates – Professional, brandable proposals ready to send to clients in minutes.</li>

                                        <li>DFY Audit Reports – Send prospects visual proof reports that help close deals automatically.</li>

                                        <li>Pricing Guide – Ready-made $300–$1,000/month service packages to help you charge clients confidently.</li>

                                        <li>Monthly Retainer Contracts – Secure recurring monthly income with professionally written contract templates.</li>

                                        <li>Commercial Rights – Charge clients monthly and keep every single dollar with 100% profit.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a> 
                                    <?php   if($traffic_active== 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $traffic_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                        <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $traffic_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Viral Accelerator -->
                            <div class="col">
                                <div class="subscription-box">
                                        <?php if($traffic_recomnded == 1) { ?>
                                        <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                        <img src="<?php echo $assetsPath.'default/subscription/viral-accelerator.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Viral Accelerator</p>                                  
                                    <p class="text-center"><span class="days-text">$37</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Go Viral Faster With 500 Proven Templates, Scripts & a Channel Blueprint</li>

                                        <li>500 Proven Viral Video Templates – Tested, niche-specific templates that already perform, organized by industry.</li>

                                        <li>Templates for Every Format – Reels, Shorts, Long-Form videos, and Ads for every platform and content type.</li>

                                        <li>Competitor Spy – Analyze top competitor channels and discover their winning video topics and content strategies.</li>

                                        <li>Competitor Topic Finder – Find exactly which topics are performing best for any competitor channel right now.</li>

                                        <li>Authority Script Packs – Ready-to-use video scripts designed for maximum engagement, categorized by niche.</li>

                                        <li>Hook Scripts – Capture viewer attention within the first 3 seconds using proven hook formulas.</li>

                                        <li>CTA Scripts – Turn viewers into subscribers and customers with high-converting call-to-action scripts.</li>

                                        <li>Trending Niches Database – Discover fast-growing niches before your competitors with weekly updates.</li>

                                        <li>Thumbnail Swipe Vault – Access high-CTR thumbnail designs proven to generate more clicks, ready to use instantly.</li>

                                        <li>Fast-Track Channel Blueprint – Follow a step-by-step roadmap to grow from zero to an authority channel faster.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a> 
                                    <?php   if($traffic_active== 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $traffic_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                        <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $traffic_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Automation -->
                             <div class="col">
                                <div class="subscription-box">
                                    <?php if($Automation_A_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                     <img src="<?php echo $assetsPath.'default/subscription/Automation.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Visora AI Automation</p>
                                    <p class="text-center"><span class="days-text">$127</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Set Once — AI Runs Your Entire YouTube Channel Automatically</li>

                                        <li>YouTube Automation – Publish and schedule videos to your channel automatically with zero manual work.</li>

                                        <li>AI-Generated Titles on Publish – The platform creates and applies optimized titles every time you publish.</li>

                                        <li>AI-Generated Descriptions – Full video descriptions are written and applied automatically.</li>

                                        <li>AI-Generated Tags – Relevant, optimized tags are added to every video without manual input.</li>

                                        <li>AI-Generated Thumbnails – Eye-catching thumbnails are created and applied automatically to your videos.</li>

                                        <li>Auto Reply to Comments – AI responds to comments and keeps your channel active and engaged 24/7.</li>

                                        <li>Auto Comments – Maintain engagement on your videos without needing to log in every day.</li>

                                        <li>Smart Scheduling Engine – Videos are published at the best time for maximum reach, decided automatically by AI.</li>

                                        <li>Bulk Video Scheduling – Upload and schedule multiple videos at once and plan weeks ahead in minutes.</li>

                                        <li>Advanced Video Editor – Full drag-and-drop editing suite for creating professional-quality videos.</li>

                                        <li>AI Video Creation from Prompts – Turn any idea or script into a finished video automatically with no editing skills required.</li>

                                        <li>AI Voiceover Generator – Generate natural human-like voiceovers and apply them to videos in seconds.</li>

                                        <li>Add Text, Subtitles & Graphics – Create professional overlays, captions, and visual elements directly inside the editor.</li>

                                        <li>Cloud-Based Editor – Access and edit your videos from any device, anywhere in the world.</li>

                                        <li>Create Video – Build avatar and template-based videos inside the built-in editor (5 Videos/Month).</li>

                                        <li>AI Studio – Generate text-to-speech, AI images, rhymes, and subtitles inside the editor (Limited).</li>

                                        <li>Avatar Videos – Create videos using AI photo avatars, video avatars, or custom uploads (Limited).</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                     <?php   if($Automation_B_active == 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $Automation_B_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $Automation_B_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Whitelabel Agency 100 Clients -->
                             <div class="col">
                                <div class="subscription-box">
                                     <?php if($agency_A_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                  <img src="<?php echo $assetsPath.'default/subscription/agency.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Visora AI Agency - 100 Clients</p>
                                    <p class="text-center"><span class="days-text">$97</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Launch Your Own 6-Figure YouTube AI Agency — In Minutes</li>

                                        <li>Launch Your Own YouTube AI Agency – Start and run your agency using Visora AI in minutes with no setup hassle.</li>

                                        <li>White-Labeled Dashboard – Use your own logo, agency name, and brand identity across the entire platform.</li>

                                        <li>Manage 100 Clients – Add and manage multiple client accounts from one centralized dashboard.</li>

                                        <li>Client Management Dashboard – Organize, track, and manage all client projects, results, and activities in one place.</li>

                                        <li>Team Management System – Add team members, assign roles, and manage your agency workflow efficiently.</li>

                                        <li>Done-For-You Agency Setup Kit – Get everything needed to start, manage, and scale your agency from day one.</li>

                                        <li>Recurring Income Business Model – Charge clients monthly for ongoing AI visibility and optimization services.</li>

                                        <li>Multi-Workspace Client System – Create separate workspaces for each client for better organization and control.</li>

                                        <li>High-Ticket Client Profit Model – Recover your investment with just one client and scale your earnings from there.</li>

                                        <li>All-in-One Agency Control Panel – Manage clients, content, automation, and operations from a single dashboard.</li>

                                        <li>Dedicated Support Access – Get direct platform support for both you and your clients whenever needed.</li>

                                        <li>Full Commercial License – Offer services using Visora AI and keep 100% of the profits with no revenue sharing.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a> 
                                    <?php  if($agency_A_active == 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $agency_A_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $agency_A_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Whitelabel Agency Unlimited Clients -->
                            <div class="col">
                                <div class="subscription-box">
                                   <?php if($agency_B_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                    <img src="<?php echo $assetsPath.'default/subscription/agency.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Visora AI Agency Unlimited</p>
                                    <p class="text-center"><span class="days-text">$197</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Launch Your Own 6-Figure YouTube AI Agency — In Minutes</li>

                                        <li>Launch Your Own YouTube AI Agency – Start and run your agency using Visora AI in minutes with no setup hassle.</li>

                                        <li>White-Labeled Dashboard – Use your own logo, agency name, and brand identity across the entire platform.</li>

                                        <li>Manage Unlimited Clients – Add and manage multiple client accounts from one centralized dashboard.</li>

                                        <li>Client Management Dashboard – Organize, track, and manage all client projects, results, and activities in one place.</li>

                                        <li>Team Management System – Add team members, assign roles, and manage your agency workflow efficiently.</li>

                                        <li>Done-For-You Agency Setup Kit – Get everything needed to start, manage, and scale your agency from day one.</li>

                                        <li>Recurring Income Business Model – Charge clients monthly for ongoing AI visibility and optimization services.</li>

                                        <li>Multi-Workspace Client System – Create separate workspaces for each client for better organization and control.</li>

                                        <li>High-Ticket Client Profit Model – Recover your investment with just one client and scale your earnings from there.</li>

                                        <li>All-in-One Agency Control Panel – Manage clients, content, automation, and operations from a single dashboard.</li>

                                        <li>Dedicated Support Access – Get direct platform support for both you and your clients whenever needed.</li>

                                        <li>Full Commercial License – Offer services using Visora AI and keep 100% of the profits with no revenue sharing.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a> 
                                    <?php   if($agency_B_active == 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $agency_B_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $agency_B_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col">
                                <div class="subscription-box">
                                       <?php if($reseller_A_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                     <img src="<?php echo $assetsPath.'default/subscription/Reseller.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Reseller- 100 License</p>
                                    <p class="text-center"><span class="days-text">$67</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Sell Visora AI As Your Own Product — Keep 100% of Every Dollar</li>

                                        <li>Full Reseller License – Sell Visora AI as your own product and keep 100% of every sale with no revenue sharing.</li>

                                        <li>Done-For-You Sales Page – Fully written, designed, and conversion-optimized sales page ready to launch.</li>

                                        <li>DFY Email Swipe Copy – Complete email sequences written for you to drive traffic and sales instantly.</li>

                                        <li>DFY Marketing Kit – Social media posts, banners, and ad creatives ready to use from day one.</li>

                                        <li>Reseller Dashboard – Track sales, customers, and revenue from a centralized dashboard.</li>

                                        <li>Automated Customer Delivery – Buyers receive instant access automatically with zero manual work required.</li>

                                        <li>100 License Keys – Sell to 100 customers with no cap on the number of licenses you can distribute.</li>

                                        <li>Set Your Own Pricing – Choose any price you want and maintain full control over your profit margins.</li>

                                        <li>White-Label Option – Fully brand the platform as your own product with your name and identity.</li>

                                        <li>Priority Reseller Support – Dedicated support channel for resellers with faster response times.</li>

                                        <li>Proven Sales Funnel – Built on a funnel that already converts so you can start generating sales quickly.</li>

                                        <li>Reseller Training Included – Step-by-step training on how to sell, scale, and maximize reseller revenue.</li>

                                        <li>Earn $50–$300 Per Sale – Build a scalable software business with multiple income streams and unlimited growth potential.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a> 
                                    <?php   if($reseller_A_active == 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $reseller_A_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $reseller_A_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="subscription-box">
                                       <?php if($reseller_B_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                     <img src="<?php echo $assetsPath.'default/subscription/Reseller.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Reseller - Unlimited License</p>
                                    <p class="text-center"><span class="days-text">$97</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Sell Visora AI As Your Own Product — Keep 100% of Every Dollar</li>

                                        <li>Full Reseller License – Sell Visora AI as your own product and keep 100% of every sale with no revenue sharing.</li>

                                        <li>Done-For-You Sales Page – Fully written, designed, and conversion-optimized sales page ready to launch.</li>

                                        <li>DFY Email Swipe Copy – Complete email sequences written for you to drive traffic and sales instantly.</li>

                                        <li>DFY Marketing Kit – Social media posts, banners, and ad creatives ready to use from day one.</li>

                                        <li>Reseller Dashboard – Track sales, customers, and revenue from a centralized dashboard.</li>

                                        <li>Automated Customer Delivery – Buyers receive instant access automatically with zero manual work required.</li>

                                        <li>Unlimited License Keys – Sell to unlimited customers with no cap on the number of licenses you can distribute.</li>

                                        <li>Set Your Own Pricing – Choose any price you want and maintain full control over your profit margins.</li>

                                        <li>White-Label Option – Fully brand the platform as your own product with your name and identity.</li>

                                        <li>Priority Reseller Support – Dedicated support channel for resellers with faster response times.</li>

                                        <li>Proven Sales Funnel – Built on a funnel that already converts so you can start generating sales quickly.</li>

                                        <li>Reseller Training Included – Step-by-step training on how to sell, scale, and maximize reseller revenue.</li>

                                        <li>Earn $50–$300 Per Sale – Build a scalable software business with multiple income streams and unlimited growth potential.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a> 
                                    <?php   if($reseller_B_active == 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $reseller_B_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $reseller_B_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                           
                            <!-- Mega Suite  -->
                            <div class="col">
                                <div class="subscription-box">
                                    <?php if($Mega_Bundle_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                   <img src="<?php echo $assetsPath.'default/subscription/megasuite.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">Visora AI Mega Suite</p> 
                                    <p class="text-center"><span class="days-text">$127</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>SocialClaw AI</li>
                                        <li>AI Titan</li>
                                        <li>ShortBeast AI</li>
                                        <li>MagicApps AI</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                        <?php   if($Mega_Bundle_active== 1) { ?>
                                        <div class="text-center item-end cursor-pointer">
                                            <a href="<?php echo $Mega_Bundle_link; ?>" class="base-btn disable-btn">Activated Plan</a>
                                        </div>
                                        <?php } else { ?>
                                        <div class="text-center item-end cursor-pointer">
                                            <a href="<?php echo $Mega_Bundle_link; ?>" class="btn btn-primary">Upgrade</a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        <script>
            $(document).ready(function(){
        
            
            $(".subscription-box .load-more").click(function(){
              $(this).closest(".subscription-box").find("ul").slideToggle();
              $(".subscription-box").toggleClass('h-auto');
            });
        });
        </script>