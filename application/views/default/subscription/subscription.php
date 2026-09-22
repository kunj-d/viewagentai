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
                        
                         <a class="nav-link" href="<?php echo base_url('user_credit') ?>">Credit</a>
                         
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
                                    <img src="<?php echo $assetsPath.'default/subscription/commercial.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Commercial</p>
                                    <p class="text-center"><span class="days-text">$47</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>BECOME THE NEXT SOCIAL MEDIA POWERHOUSE – Let Open Claw Launch Your Viral, Profitable Faceless YouTube Channels In Just 2 Minutes.</li>

                                        <li>YOUTUBE AI VISIBILITY & AEO SCORECARD – Analyze Any Video & Get AI Visibility, AEO, Generative Search & Content Readiness Scores — Export Reports In One Click.</li>

                                        <li>OPTIMIZE VIDEOS FOR THE AI SEARCH ERA – Instantly Upgrade Your Video Titles, Descriptions, Tags & Thumbnails To Maximize Your AEO Score & Get Found Everywhere.</li>

                                        <li>SPY ON YOUTUBE SEARCH TRENDS – See Trending Questions & Keywords Your Audience Is Searching On YouTube & Create Content That Answers Them Before Your Competition Does.</li>

                                        <li>LEAD FINDER & CHANNEL FINDER – Discover Hungry Leads & Top YouTube Channels By Niche & Keyword — Save & Export Everything To Excel Instantly.</li>

                                        <li>AUTO-POST, AUTO-COMMENT & AUTO-REPLY – Keep Your YouTube Channels Active & Engaged 24/7 — Completely Hands-Free.</li>

                                        <li>COMMAND BY CHAT & VOICE – Control Everything Through Your Claw Agent Via Chat Or Voice Command — From Your Mobile App Or Desktop Browser.</li>

                                        <li>58 DONE-FOR-YOU AI AGENTS – Deploy Specialized AI Agents For Your YouTube Business Growth — Each Loaded With Sample Prompts.</li>

                                        <li>INTERACTIVE VIDEO ELEMENTS – Add CTAs, Emojis, Buttons & Shapes To Boost Watch Time & Conversions.</li>

                                        <li>AI THUMBNAIL & CHANNEL NAME CREATOR – Design Eye-Catching Thumbnails & Perfect Channel Names Instantly.</li>

                                        <li>AI IDEA, TREND & COMPETITOR SPY – Get Endless Video Topics, Viral Trends & Expose Exactly What's Working For Your Competitors — All In One Place.</li>

                                        <li>AI PHOTO AVATAR CREATION – Upload Your Photo Or Use Ready-Made Avatars With Realistic Expressions & Perfect Lip-Sync.</li>

                                        <li>TALKING AI AVATAR TRANSFORMATION – Turn Any Photo Into A Human-Like Talking Avatar For Professional Videos.</li>

                                        <li>STUNNING VIDEO AVATARS WITHOUT FILMING – Create Studio-Quality Visuals Without Ever Touching A Camera.</li>

                                        <li>DONE-FOR-YOU AVATAR COLLECTION – Choose From 100+ Premium Avatars Covering All Ages, Ethnicities & Styles.</li>

                                        <li>PREMIUM AI VOICES & VOICE CLONING – Access 120+ Natural Voices Or Clone Your Own For A Personalized Touch.</li>

                                        <li>AI-POWERED SCRIPT GENERATOR – Create Unique, Engaging Scripts From Simple Keywords Or Prompts In Seconds.</li>

                                        <li>AI-GENERATED VIDEO CREATION – Instantly Turn Scripts Into Viral Videos & Shorts With Stunning Visuals — Ready To Post On Any Platform.</li>

                                        <li>100+ DFY VIDEO TEMPLATES – Use Professionally Designed Layouts To Create Scroll-Stopping Content In Any Niche.</li>

                                        <li>CUSTOM BACKGROUNDS & BRAND STYLING – Add Colors, Images, Or Videos To Make Every Scene Match Your Brand.</li>

                                        <li>BUILT-IN AI VIDEO EDITOR SUITE – Add Text, Backgrounds, Effects & Fine-Tune Every Scene Before Publishing.</li>

                                        <li>LIGHTNING-FAST CLOUD SERVERS – No Hosting, No VPS, No Installation. Everything Runs Smoothly In The Cloud From Day One.</li>

                                        <li>WORKS ON ALL DEVICES – Mobile App, Tablet, Or Desktop — Zero Extra Setup Required.</li>

                                        <li>100% SECURE & PRIVATE – Your Own Dedicated App Means Zero WhatsApp Or Telegram Access — Every Command & Conversation Fully Protected.</li>

                                        <li>FREE CREDITS – 10,000 Credits Included To Let AI Work For You From The Moment You Login.</li>

                                        <li>ACHIEVE MORE IN LESS TIME – Let Tube Claw Handle The Work While You Focus On Growth.</li>

                                        <li>CREATE MONEY-MAKING CHANNELS – Boost Engagement & Close More Deals Across Every Platform.</li>

                                        <li>COMMERCIAL LICENSE INCLUDED – Start Selling AI-Powered YouTube Account Boosting Services To Unlimited Clients Instantly.</li>                         
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                    <?php if(!empty($fe_A_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $fe_A_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
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
                                    <p class="product-name text-center mt-2">TubeClaw AI Unlimited</p>
                                    <p class="text-center"><span class="days-text">$77</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>UNLIMITED POWER UNLOCKED – Remove All Limits & Supercharge Your Tube Claw Account Instantly.</li>

                                        <li>UNLIMITED CLAW AGENT COMMANDS – Send Unlimited Chat & Voice Commands To Your Claw Agent — No Caps, No Cooldowns, Ever.</li>

                                        <li>UNLIMITED AI VIDEO CREATION – Create As Many AI-Powered Videos As You Want Without Any Restrictions.</li>

                                        <li>UNLIMITED AI SHORTS & REELS – Generate Endless Viral Shorts & Reels That Attract Traffic, Followers & Subscribers Daily.</li>

                                        <li>UNLIMITED AI PHOTO AVATARS – Design Countless AI Photo Avatars For Every Channel, Niche & Social Profile.</li>

                                        <li>UNLIMITED AI VIDEO AVATARS – Build Realistic Talking Avatars With Custom Voices, Styles & Emotions For Any Platform.</li>

                                        <li>UNLIMITED PREMIUM VOICES & VOICE CLONING – Access Top-Tier Voices & Clone Any Tone For Perfect Branding Across Every Video.</li>

                                        <li>UNLIMITED VIRAL BOOSTING – Auto-Rank Unlimited Videos On YouTube & Dominate Social Feeds Using Our Viral Ranking Engine.</li>

                                        <li>UNLIMITED WORKSPACES – Manage Multiple Channels, Niches, Platforms & Businesses From One Central Dashboard.</li>

                                        <li>UNLIMITED VIDEO DUPLICATION – Move Or Copy Videos Between Workspaces For Fast Content Repurposing Across Platforms.</li>

                                        <li>UNLIMITED AUTO-ACTIONS – Automate Posting, Scheduling, Commenting & Replying Across YouTube Channels For 24/7 Growth.</li>

                                        <li>UNLIMITED TITLES, DESCRIPTIONS & TAGS – Instantly Generate SEO & AEO-Optimized Metadata For Every Upload On Every Platform.</li>

                                        <li>UNLIMITED AI THUMBNAILS – Create Eye-Catching Thumbnails That Boost CTR & Viral Reach On Every Channel.</li>

                                        <li>UNLIMITED BANDWIDTH & STORAGE – Host, Render & Manage All Your Projects Without Ever Hitting A Limit.</li>

                                        <li>UNLIMITED MONETIZATION OPTIONS – Unlock Every Proven YouTube & Social Media Income Stream With Zero Restrictions.</li>

                                        <li>UNPARALLELED VALUE FOR MONEY – Get All These Unlimited Benefits At A Price That's Absolutely Unbeatable.</li>

                                        <li>HIGH-PRIORITY SUPPORT – Get Fast, Dedicated Assistance For All Your Technical Needs.</li>

                                        <li>REGULAR UPDATES – Always Stay Ahead With The Latest Features & Platform Improvements.</li>

                                        <li>ENTERPRISE VALUE, STARTUP PRICE – Unparalleled Pricing For A Premium, All-In-One Social Media Powerhouse.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                            <?php   if(!empty($pro_B_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $pro_B_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $pro_B_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col">
                                <div class="subscription-box">
                                     <img src="<?php echo $assetsPath.'default/subscription/unlimited.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Unlimited - Platinum</p>
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
                            </div> -->

                            <!-- Enterprize -->
                            <div class="col">
                                <div class="subscription-box">
                                     <img src="<?php echo $assetsPath.'default/subscription/enterprise.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Enterprize</p>
                                    <p class="text-center"><span class="days-text">$47</span></p>
                                    <ul class="sub-height list-unstyled">
                                       <li>24/7 AUTOMATED SOCIAL MEDIA SYSTEM – Tube Claw Runs Your Entire YouTube Businsess On Automation, Even While You No Desk.</li>
                                        <li>AI-POWERED GROWTH AUTOMATION – Enjoy Smart Posting, Scheduling, Auto-Replies, Traffic & Sales Across All Platforms With Zero Manual Work.</li>
                                        <li>SET ONCE, EARN DAILY – Smart Dashboard Tracks Channel Health, Subscribers, Followers & Video Performance Automatically Across Every Platform.</li>
                                        <li>INSTANT MONETIZATION BOOST – Run Ads, Launch Campaigns & Generate Leads To Multiply Your Income on YouTube.</li>
                                        <li>MULTI-PLATFORM AUDIENCE SYNC – Connect Your YouTube, Instagram & Facebook Audience To Your Email List & CRM For Auto Follow-Ups & Sales.</li>
                                        <li>PASSIVE INCOME MODE – Set It, Forget It & Watch Tube Claw Deliver Daily Profits Across Every Platform Without Extra Effort.</li>
                                        <li>VIRAL TRAFFIC ENGINE – Unlock Fast-Growing Views, Subscribers & Followers Using Advanced AI Algorithms Across All Your Channels.</li>
                                        <li>AUTOMATED TRAFFIC CAMPAIGNS – Let Your Claw Agent Run Targeted Campaigns 24/7 Via Chat & Voice Commands For Continuous Multi-Platform Growth.</li>
                                        <li>AI SEO & AEO OPTIMIZER – Maximize Organic & AI Search Reach With Automated Keyword Targeting, AEO Scoring & Ranking Power.</li>
                                        <li>UNLIMITED SUBSCRIBER & FOLLOWER GROWTH – Capture & Nurture Subscribers & Followers Across Every Platform Using The Built-In Growth System.</li>
                                        <li>SOCIAL SHARING POWERHOUSE – Unlock Multi-Platform Distribution To Drive Instant Viral Traffic Across YouTube & Beyond.</li>
                                        <li>FREE ORGANIC TRAFFIC BOOST – Get Real Views, Watch Time & Engagement Without Paying For Ads — Powered By AI Content Optimization.</li>
                                        <li>TARGETED NICHE TRAFFIC – Drive Highly Profitable Visitors From YouTube & Earn $500–1000+ Per Month Effortlessly.</li>
                                        <li>SCALE UNLIMITED CHANNELS & PROFILES – Grow Multiple YouTube Channels With Unlimited Views, Subscribers & Reach.</li>
                                        <li>START YOUR SOCIAL MEDIA AGENCY – Offer AI-Powered Traffic, Automation & Channel Management Services To Clients & Open A Powerful New Income Stream.</li>
                                        <li>QUICK CLAW AGENT SETUP – Get Started In Minutes, Brief Your Agent By Chat Or Voice & Let Tube Claw Handle Everything For You.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                            <?php   if(!empty($enterprie_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $enterprie_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $enterprie_link; ?>" class="btn btn-primary">Upgrade</a>
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
                                     <img src="<?php echo $assetsPath.'default/subscription/automation.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Automation</p>
                                    <p class="text-center"><span class="days-text">$97</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>24/7 AUTOMATED SOCIAL MEDIA SYSTEM – Tube Claw Runs Your Entire YouTube Businsess On Automation, Even While You No Desk.</li>
                                        <li>AI-POWERED GROWTH AUTOMATION – Enjoy Smart Posting, Scheduling, Auto-Replies, Traffic & Sales Across All Platforms With Zero Manual Work.</li>
                                        <li>SET ONCE, EARN DAILY – Smart Dashboard Tracks Channel Health, Subscribers, Followers & Video Performance Automatically Across Every Platform.</li>
                                        <li>INSTANT MONETIZATION BOOST – Run Ads, Launch Campaigns & Generate Leads To Multiply Your Income on YouTube.</li>
                                        <li>MULTI-PLATFORM AUDIENCE SYNC – Connect Your YouTube, Instagram & Facebook Audience To Your Email List & CRM For Auto Follow-Ups & Sales.</li>
                                        <li>PASSIVE INCOME MODE – Set It, Forget It & Watch Tube Claw Deliver Daily Profits Across Every Platform Without Extra Effort.</li>
                                        <li>VIRAL TRAFFIC ENGINE – Unlock Fast-Growing Views, Subscribers & Followers Using Advanced AI Algorithms Across All Your Channels.</li>
                                        <li>AUTOMATED TRAFFIC CAMPAIGNS – Let Your Claw Agent Run Targeted Campaigns 24/7 Via Chat & Voice Commands For Continuous Multi-Platform Growth.</li>
                                        <li>AI SEO & AEO OPTIMIZER – Maximize Organic & AI Search Reach With Automated Keyword Targeting, AEO Scoring & Ranking Power.</li>
                                        <li>UNLIMITED SUBSCRIBER & FOLLOWER GROWTH – Capture & Nurture Subscribers & Followers Across Every Platform Using The Built-In Growth System.</li>
                                        <li>SOCIAL SHARING POWERHOUSE – Unlock Multi-Platform Distribution To Drive Instant Viral Traffic Across YouTube & Beyond.</li>
                                        <li>FREE ORGANIC TRAFFIC BOOST – Get Real Views, Watch Time & Engagement Without Paying For Ads — Powered By AI Content Optimization.</li>
                                        <li>TARGETED NICHE TRAFFIC – Drive Highly Profitable Visitors From YouTube & Earn $500–1000+ Per Month Effortlessly.</li>
                                        <li>SCALE UNLIMITED CHANNELS & PROFILES – Grow Multiple YouTube Channels With Unlimited Views, Subscribers & Reach.</li>
                                        <li>START YOUR SOCIAL MEDIA AGENCY – Offer AI-Powered Traffic, Automation & Channel Management Services To Clients & Open A Powerful New Income Stream.</li>
                                        <li>QUICK CLAW AGENT SETUP – Get Started In Minutes, Brief Your Agent By Chat Or Voice & Let Tube Claw Handle Everything For You.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                     <?php   if($Automation_B_active == 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $Automation_B_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $Automation_B_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- DFY Account Service -->
                            <div class="col">
                                <div class="subscription-box">
                                     <img src="<?php echo $assetsPath.'default/subscription/dfy.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">DFY Account Service</p>
                                    <p class="text-center"><span class="days-text">$97</span></p>
                                    <ul class="sub-height list-unstyled">
                                       <li>COMPLETE HANDS-FREE SETUP – Our AI Experts Handle Everything From Start To Finish — No Technical Skills, No Installs, No VPS, Nothing.</li>
                                        <li>DEDICATED ACCOUNT MANAGER – Get 1-on-1 Video/Audio Support To Guide, Update & Walk You Through Every Step Of Your Tube Claw Journey.</li>
                                        <li>DONE-FOR-YOU SOCIAL MEDIA SETUP – We Build Your AI-Powered YouTube Channel, Instagram Profile & Facebook Page Loaded With Viral Videos, Reels & Shorts.</li>
                                        <li>FULL AI AUTOMATION SETUP – AEO & SEO-Optimized Titles, Tags, Descriptions & Thumbnails Configured & Done For You On Complete Autopilot.</li>
                                        <li>CLAW AGENT CONFIGURED FOR YOU – We Set Up & Brief Your Claw Agent With Voice & Chat Commands So It Starts Working For You From Day One.</li>
                                        <li>24/7 VIDEO POSTING & ENGAGEMENT – Your Channels & Profiles Grow Around The Clock With Auto-Posting, Scheduling & Smart Comment Replies Across All Platforms.</li>
                                        <li>MULTI-PLATFORM MONETIZATION BLUEPRINT – We Apply Proven Money-Making Methods Across YouTube, Instagram & Facebook For Fast, Reliable Income Streams.</li>
                                        <li>HIDDEN NICHE DISCOVERY – We Use Tube Claw's Competitor Spy & Trend Analysis To Uncover High-Converting, Low-Competition Niches For Maximum Profits.</li>
                                        <li>REGULAR VIRAL CONTENT UPLOADS – Get Flooded With Fresh, Trending AI Videos, Reels & Shorts That Drive Massive Views, Followers & Subscribers.</li>
                                        <li>58 AI AGENTS DEPLOYED FOR YOUR NICHE – We Hand-Pick, Configure & Activate The Right AI Agents For Your Goals & Platforms — Ready To Deliver Results Immediately.</li>
                                        <li>AI SOCIAL MEDIA AGENCY SETUP – We Build Your Own AI-Powered Agency So You Can Offer YouTube Business Management Services & Charge Clients Premium Prices.</li>
                                        <li>FULL BUSINESS AUTOMATION – We Automate Your Entire Tube Claw System With Scalable, Passive Income Strategies Across Every Platform.</li>
                                        <li>1-ON-1 SUPPORT ACCESS – Work Directly With Our Expert Team For Setup, Guidance, Optimization & Ongoing Growth Across All Your Channels.</li>
                                        <li>100% DONE-FOR-YOU SYSTEM – We Do All The Work… You Sit Back, Watch Your Channels Grow & Collect The Profits.</li>
                                        <li>SCALABLE SERVICE PACKAGES – Choose Plans That Fit Your Goals, Budget & Business Stage — From Solo Creator To Full Agency.</li>
                                        <li>COMMERCIAL LICENSE INCLUDED – Start Selling AI-Powered YouTube Account Boosing Services To Unlimited Clients Instantly.</li>
                                        <li>SATISFACTION GUARANTEED – Smooth Setup, Top Performance & Complete Peace Of Mind With Expert Support Every Step Of The Way.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                            <?php   if(!empty($dfy_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $dfy_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $dfy_link; ?>" class="btn btn-primary">Upgrade</a>
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
                                    <img src="<?php echo $assetsPath.'default/subscription/agency-unlimited.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Agency Unlimited</p>
                                    <p class="text-center"><span class="days-text">$147</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>UNLIMITED WHITE LABEL LICENSE – Launch Your Own Branded Version Of Tube Claw With 100% Brand Control — Your Name, Your Logo, Your Empire.</li>
                                        <li>UNLIMITED CLIENT & AGENCY LICENSE – Sell Access To Unlimited Clients Across YouTube, Instagram & Facebook Management Services & Keep 100% Of The Profits.</li>
                                        <li>UNLIMITED RESELLER LICENSE – Resell Tube Claw As Your Own Product, Set Your Own Price & Pocket 100% Of Every Sale — No Royalties, No Sharing, Ever.</li>
                                        <li>RESELLER SALES KIT INCLUDED – Get Done-For-You Sales Pages, Email Swipes, Banners & Promotional Material So You Can Start Selling Tube Claw Instantly Under Your Brand.</li>
                                        <li>DEDICATED TEAM ACCESS – Add Unlimited Team Members, Assign Roles & Collaborate Seamlessly Under Your Own Brand.</li>
                                        <li>WHITE-LABEL DASHBOARD – Replace Our Branding With Yours: Your Logo, Your Name, Your Identity — Clients Never Know It's Tube Claw Under The Hood.</li>
                                        <li>CREATE CLIENT ACCOUNTS IN 3 CLICKS – Instant Setup With Full Control, Visibility & Permissions — Onboard New Clients In Minutes.</li>
                                        <li>CLIENT USAGE ANALYTICS DASHBOARD – Track Every Client's Activity, Credits Used, Videos Created & Engagement — Spot Power Users, Upsell Opportunities & Churn Risk Instantly.</li>
                                        <li>REVENUE & COMMISSION DASHBOARD – See Total Sales, MRR, Active Subscriptions & Profit Per Client In Real Time — Run Your Agency Like A Real SaaS Business.</li>
                                        <li>SELL AI SOCIAL MEDIA SERVICES WITHOUT LIFTING A FINGER – Offer YouTube Channel Creation, Instagram Growth, Facebook Management, AI Video Creation & Full Automation As Your Own Premium Service.</li>
                                        <li>DONE-FOR-YOU AGENCY KIT – Proposals, Contracts, Fiverr/Upwork Templates, Invoices & Delivery Reports Ready-To-Use From Day One.</li>
                                        <li>RECOVER INVESTMENT WITH ONE CLIENT – Charge $497–$997+ Per Client For AI-Powered Social Media & YouTube Services. No Revenue Share. Pure Profit.</li>
                                        <li>CLAW AGENT BRANDED FOR YOUR CLIENTS – Your Clients Get Their Own Branded AI Agent Experience — Powered By Tube Claw, Presented Under Your Brand.</li>
                                        <li>INSTANT START + PREMIUM SUPPORT – Zero Learning Curve & Priority Support Whenever You Need It So You Can Focus On Closing Clients.</li>
                                        <li>BUILD YOUR BRAND. KEEP EVERY DOLLAR – Your Clients. Your Profits. Your 6–7 Figure AI Social Media Agency & Reseller Business Built On The Power Of Tube Claw.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a> 
                                    <?php   if($agency_A_active == 1) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $agency_A_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $agency_A_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Bundle -->
                            <div class="col">
                                <div class="subscription-box">
                                     <img src="<?php echo $assetsPath.'default/subscription/Bundle.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2"> TubeClaw AI Bundle</p>
                                    <p class="text-center"><span class="days-text">$367</span></p>
                                    <ul class="sub-height list-unstyled">
                                       <li>FE</li>

                                        <li>OTO1</li>

                                        <li>OTO2</li>

                                        <li>OTO3</li>

                                        <li>OTO4</li>

                                        <li>OTO5</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                            <?php   if(!empty($Bundle_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $Bundle_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $Bundle_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Fast Pass -->
                            <div class="col">
                                <div class="subscription-box">
                                     <img src="<?php echo $assetsPath.'default/subscription/fast-pass.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Fast Pass</p>
                                    <p class="text-center"><span class="days-text">$367</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>OTO1</li>

                                        <li>OTO2</li>

                                        <li>OTO3</li>

                                        <li>OTO4</li>

                                        <li>OTO5</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                            <?php   if(!empty($fastpass_active)) { ?>
                                    <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $fastpass_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                    </div>
                                    <?php } else { ?>
                                      <div class="text-center item-end cursor-pointer">
                                        <a href="<?php echo $fastpass_link; ?>" class="btn btn-primary">Upgrade</a>
                                    </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                           
                            <!-- Mega Bundle  -->
                            <div class="col">
                                <div class="subscription-box">
                                    <?php if($Mega_Bundle_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                   <img src="<?php echo $assetsPath.'default/subscription/mega-bundle.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Mega Bundle</p> 
                                    <p class="text-center"><span class="days-text">$147</span></p>
                                    <ul class="sub-height list-unstyled">
                                       <li>UNLOCK INSTAGRAM & FACEBOOK ACROSS YOUR ENTIRE TUBE CLAW SUITE – Activate Full Instagram & Facebook Capabilities On Every Feature You Already Own — Turn Your YouTube Empire Into A True Multi-Platform Powerhouse.</li>
                                        <li>INSTAGRAM TREND ANALYSIS – Fetch Viral Instagram Content With Captions, Hashtags, Likes & Deep Insights So You're Always Ahead Of The Curve.</li>
                                        <li>AUTO-POST, AUTO-COMMENT & AUTO-REPLY ON INSTAGRAM & FACEBOOK – Keep Your IG Profile & FB Page Active & Engaged 24/7 — Completely Hands-Free.</li>
                                        <li>AI VIDEO CREATION FOR INSTAGRAM REELS & FACEBOOK – Instantly Generate Reels, Stories & FB Videos From Scripts With Stunning Visuals — Ready To Post On Both Platforms.</li>
                                        <li>TALKING AVATARS FOR INSTAGRAM & FACEBOOK VIDEOS – Use Your Photo Avatars & Video Avatars Across IG Reels, Stories & FB Posts Without Showing Your Face.</li>
                                        <li>30 AI AGENTS UNLOCKED FOR INSTAGRAM & FACEBOOK GROWTH – Deploy The Full Roster Of AI Agents Specialized For IG & FB Growth, Engagement & Monetization.</li>
                                        <li>CLAW AGENT VOICE & CHAT COMMANDS FOR IG & FB – Brief Your Claw Agent To Post, Schedule, Reply & Manage Both Instagram & Facebook — All By Voice Or Chat.</li>
                                        <li>MULTI-FORMAT VIDEO EXPORT FOR IG & FB – Render Vertical Reels, Square Posts & Story-Sized Videos Perfectly Sized For Instagram & Facebook.</li>
                                        <li>INSTANT MONETIZATION ON IG & FB – Run Ads, Launch Campaigns & Generate Leads To Multiply Your Income Across Instagram & Facebook.</li>
                                        <li>VIRAL SOCIAL SHARING ACROSS INSTAGRAM & FACEBOOK – Unlock Multi-Platform Distribution To Drive Instant Viral Traffic Across IG, FB & Beyond.</li>
                                        <li>TARGETED NICHE TRAFFIC FROM IG & FB – Drive Highly Profitable Visitors From Instagram & Facebook & Multiply Your Monthly Earnings.</li>
                                        <li>SCALE UNLIMITED IG PROFILES & FB PAGES – Grow Multiple Instagram Profiles & Facebook Pages With Unlimited Views, Followers & Reach.</li>
                                        <li>DFY IG & FB ACCOUNT SETUP – We Build Your AI-Powered Instagram Profile & Facebook Page Loaded With Viral Reels, Stories & Shorts.</li>
                                        <li>AGENCY SERVICES FOR INSTAGRAM & FACEBOOK – Offer Full IG Growth & FB Management Services To Clients & Charge Premium Prices.</li>
                                        <li>WHITE-LABEL CLIENT ACCESS FOR IG & FB SERVICES – Resell Instagram & Facebook Management Services Under Your Own Brand With Full White-Label Control.</li>
                                        <li>2 YEARS EXTENDED SUPPORT – Get Priority Help & Account Assistance For A Full 24 Months — Far Beyond Standard Coverage.</li>
                                        <li>ADDITIONAL FREE CREDITS – Get A Massive Top-Up Of Bonus Credits To Power All Your Cross-Platform Content Creation.</li>
                                        <li>1 GB ADDITIONAL STORAGE – Extra Cloud Storage To Hold All Your Multi-Platform Videos, Avatars & Assets Without Limits.</li>
                                        <li>COMPLETE HANDS-FREE SETUP – Our AI Experts Handle Everything From Start To Finish — No Technical Skills, No Installs, No VPS, Nothing.</li>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:void(0)" class="load-more btn btn-primary">Know More</a>
                                        <?php   if($Mega_Bundle_active== 1) { ?>
                                        <div class="text-center item-end cursor-pointer">
                                            <a href="<?php echo $Mega_Bundle_link; ?>" class="base-btn disable-btn border rounded">Activated Plan</a>
                                        </div>
                                        <?php } else { ?>
                                        <div class="text-center item-end cursor-pointer">
                                            <a href="<?php echo $Mega_Bundle_link; ?>" class="btn btn-primary">Upgrade</a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                             <!-- Client Finder -->
                            <!-- <div class="col">
                                <div class="subscription-box">
                                        <?php if($traffic_recomnded == 1) { ?>
                                        <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                        <img src="<?php echo $assetsPath.'default/subscription/client-finder.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Client Finder</p>                                  
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
                            </div> -->


                            <!-- Viral Accelerator -->
                            <!-- <div class="col">
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
                            </div> -->
                            
                            <!-- Whitelabel Agency 100 Clients -->
                             <!-- <div class="col">
                                <div class="subscription-box">
                                     <?php if($agency_A_recomnded == 1) { ?>
                                     <div class="recommend">
                                        <img src="<?php echo $this->config->item('assetsPath') ?>default/subscription/recommend.png"
                                            class="img-reponsive">
                                    </div>
                                    <?php } ?>
                                  <img src="<?php echo $assetsPath.'default/subscription/agency.png' ?>" 
                                        class="iimg-fluid d-block mx-auto">
                                    <p class="product-name text-center mt-2">TubeClaw AI Agency - 100 Clients</p>
                                    <p class="text-center"><span class="days-text">$97</span></p>
                                    <ul class="sub-height list-unstyled">
                                        <li>Launch Your Own 6-Figure YouTube AI Agency — In Minutes</li>

                                        <li>Launch Your Own YouTube AI Agency – Start and run your agency using TubeClaw AI in minutes with no setup hassle.</li>

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

                                        <li>Full Commercial License – Offer services using TubeClaw AI and keep 100% of the profits with no revenue sharing.</li>
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
                            </div> -->
                            

                            <!-- <div class="col">
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
                                        <li>Sell TubeClaw AI As Your Own Product — Keep 100% of Every Dollar</li>

                                        <li>Full Reseller License – Sell TubeClaw AI as your own product and keep 100% of every sale with no revenue sharing.</li>

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
                            </div> -->
                            
                            <!-- <div class="col">
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
                                        <li>Sell TubeClaw AI As Your Own Product — Keep 100% of Every Dollar</li>

                                        <li>Full Reseller License – Sell TubeClaw AI as your own product and keep 100% of every sale with no revenue sharing.</li>

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
                            </div> -->
                           
                            
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