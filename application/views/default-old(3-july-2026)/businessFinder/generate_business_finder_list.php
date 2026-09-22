<link rel="stylesheet" href="<?= $this->config->item('assetsPath') ?>css/chat_agent.css">

<style>
  .footer-sticky-height,
  .footer-design,
  .sidebar,
  .header-fixed {
    display: none !important;
  }

  body {
    background: #0B0511 url('<?= $this->config->item('assetsPath') ?>images/body-bg.png') no-repeat center center !important;
    background-size: cover !important;
    background-attachment: fixed !important;
  }
</style>

<?php
$activeFile = null;
$Created = null;
$Updated = null;
$theme_screenshot = null;
foreach ($themes as $theme) {
  if (!empty($theme['active'])) {
    $activeFile = $theme['publish_url'];
    $theme_screenshot = $theme['screenshot'];
    $Created = $theme['created_at'];
    $Updated = $theme['updated_at'];
    break;
  }
}

$custom_value = isset($custom_domian['custom_domain']) ? trim($custom_domian['custom_domain']) : '';
if (!empty($custom_value)) {
  if (!preg_match('#^https?://#', $custom_value)) {
    $embedDomain = 'https://' . rtrim($custom_value, '/');
  } else {
    $embedDomain = rtrim($custom_value, '/');
  }
  $parsed = parse_url($embedDomain);
  $cleanDomain = isset($parsed['host']) ? $parsed['host'] : $parsed['path'];
} else {
  $cleanDomain = '';
}

$originalUrl = base_url($activeFile);
if (empty($cleanDomain)) {
  $finalURL = $originalUrl;
} else {
  $parsedOriginal = parse_url($originalUrl);
  $path = isset($parsedOriginal['path']) ? $parsedOriginal['path'] : '';
  $finalURL = 'https://' . $cleanDomain . $path;
}

?>

<div class="business-generator-listing-wrapper">
  <div class="business-generator-inner">
    <div class="headline-text">
      <div class="headline">Your Digital Business Is Ready!</div>
    </div>
    <input type="hidden" id="themePrompt" value="<?php echo $business_search_keyword ?>">
    <div class="row row-gap-3 row-gap-sm-4">
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">Website</span>
            <!-- <a href="<?= base_url('editor'); ?>" class="edit-btn">Edit</a> -->
          </div>
          <div class="list-content">
            <div class="list-image-parent">
              <!-- <img src="<?php echo $theme['screenshot']; ?>" alt="image"> -->
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/website.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <a href="<?php echo $finalURL; ?>" target="_blank" class="btn btn-light">Preview <i class="fa-solid fa-play"></i></a>
            <a href="javascript:void(0);" class="btn btn-primary" onclick="createAiTemplateApp()">Regenerate <i class="fa-solid fa-arrows-rotate"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">Mobile App</span>
          </div>
          <div class="list-content">
            <div class="list-image-parent">
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/mobile.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <a href="javascript:void(0)" target="_blank" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#mobileAppModal">Preview <i class="fa-solid fa-play"></i></a>
            <a href="javascript:void(0);" class="btn btn-primary" onclick="createAiTemplateApp()">Regenerate <i class="fa-solid fa-arrows-rotate"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">Agent</span>
            <!-- <a href="javascript:void(0);" class="edit-btn">Edit</a> -->
          </div>
          <div class="list-content">
            <div class="list-image-parent">
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/agent.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#agentModal">Preview <i class="fa-solid fa-play"></i></a>
            <a href="javascript:void(0);" class="btn btn-primary">Regenerate <i class="fa-solid fa-arrows-rotate"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">Business Finder</span>
          </div>
          <div class="list-content">
            <div class="list-image-parent">
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/business-finder.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#businessFinderModal" class="btn btn-light">Preview <i class="fa-solid fa-play"></i></a>
            <a href="javascript:void(0);" onclick="find_inplace_default()" class="btn btn-primary">Regenerate <i class="fa-solid fa-arrows-rotate"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">AI Proposal</span>
            <!-- <a href="javascript:void(0);" class="edit-btn">Edit</a> -->
          </div>
          <div class="list-content">
            <div class="list-image-parent">
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/ai-proposal.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#aIProposalModal" class="btn btn-light">Preview <i class="fa-solid fa-play"></i></a>
            <a href="javascript:void(0);" onclick="emails_promotions_default()" class="btn btn-primary">Regenerate <i class="fa-solid fa-arrows-rotate"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">Social media content</span>
            <!-- <a href="javascript:void(0);" class="edit-btn">Edit</a> -->
          </div>
          <div class="list-content">
            <div class="list-image-parent">
                <?php if(!empty($social_media_content)) { ?>
                <!-- <img src="<?php echo $social_media_content['image'] ?>" alt="image"> -->
                <?php } ?>
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/social-post.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#socialPostModal" class="btn btn-light">Preview <i class="fa-solid fa-play"></i></a>
            <a href="javascript:void(0);" onclick="social_mediacontent_default()" class="btn btn-primary">Regenerate <i class="fa-solid fa-arrows-rotate"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">Email Sequence</span>
            <!-- <a href="javascript:void(0);" class="edit-btn">Edit</a> -->
          </div>
          <div class="list-content">
            <div class="list-image-parent">
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/email-sequence.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#emailSequenceModal" class="btn btn-light">Preview <i class="fa-solid fa-play"></i></a>
            <a href="javascript:void(0);" onclick="email_sequances_default()" class="btn btn-primary">Regenerate <i class="fa-solid fa-arrows-rotate"></i></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="business-list-card">
          <div class="list-header">
            <span class="title">QR Code</span>
          </div>
          <div class="list-content">
            <div class="list-image-parent">
              <!-- <div id="qrcode-preview"></div> -->
              <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/qr-code.png" alt="image">
            </div>
          </div>
          <div class="list-actions">
            <input type="hidden" id="input-url" class="form-control"
              value="<?php echo $finalURL; ?>" placeholder="https://example.com"
              readonly>
            <a href="javascript:void(0);" onclick="copyToClipboard($('#input-url'))" class="btn btn-light">Copy <i class="fa-regular fa-copy"></i></a>
            <a href="javascript:void(0);" target="_blank" download="qrcode-1762495758.png" id="download-qr-code" class="btn btn-primary">Download <i class="fa-solid fa-download"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-sm-5 mt-3">
      <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#quitBusinessList" class="btn btn-primary">Go to Dashboard <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </div>
</div>

<!-- quitBusinessList Modal -->
<div class="modal fade" id="quitBusinessList" tabindex="-1" aria-labelledby="quitBusinessListLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header after-none border-0 text-center">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center py-0">
        <i class="fa-solid fa-triangle-exclamation mb-2 text-warning" style="font-size: 64px;"></i>
        <h5 class="title mb-3">Alert</h5>
        <p class="mb-0 mx-auto" style="max-width: 310px">
          If you go to the dashboard, you won’t be able to change the keyword
        </p>
      </div>
      <div class="modal-footer after-none border-0 justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary-alt">Yes</a>
      </div>
    </div>
  </div>
</div>
<!-- quitBusinessList Modal -->

<!-- businessFinder Modal -->
<div class="modal fade" id="businessFinderModal" tabindex="-1" aria-labelledby="businessFinderLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 945px;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="businessFinderLabel">Business Finder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-wrapper-box">
          <div class="theme-card theme-card-style-2" style="font-size: 10px !important;">
            <!-- <div class="d-flex align-items-center justify-content-between mb-2">
              <h6 class="title mb-0">Search Results</h6>
              <span id="resultCount" class="placeholder-badge">20 Results</span>
            </div> -->
            <div class="table-responsive theme-custom-table">
              <table class="table table-bordered mb-0">
                <thead>
                  <tr>
                    <th>Lead Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($search_business_list)) { 
                        foreach($search_business_list as $kye=>$businesFinder) {
                    ?>
                  <tr>
                    <td><span class="overflow-content" style="width: 140px;"><?php echo $businesFinder['name']; ?></span></td>
                    <td><span class="overflow-content" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                        data-bs-title="<?php echo $businesFinder['address']; ?>"
                        style="width: 140px;"
                        ><?php echo $businesFinder['address']; ?></span></td>
                    <td><span class="overflow-content" style="width: 140px;" title="N/A"> <?php if(!empty($businesFinder['email'])) { echo $businesFinder['address']; }else { echo "N/A"; } ?></span></td>
                    <td><span style="white-space:nowrap;"><?php if(!empty($businesFinder['phone'])) { echo $businesFinder['phone']; }else { echo "N/A"; } ?></span></td>
                    <td>
                        <?php if(!empty($businesFinder['phone'])) {  ?>
                        <span style="white-space:nowrap;"><a href="<?php echo $businesFinder['phone'];?>" target="_blank"
                          class="visit-link">Visit Website</a></span>
                          <?php }else {  ?>
                            N/A
                          <?php  } ?>
                    </td>
                    <!--<td>-->
                    <!--  <a href="#" style="white-space:nowrap;" onclick="addToList('HOTEL%20LE%20AMOR%20(%20LUXURY%20HOTEL%20)', '5VF3%2BQ4G%20Circle%2C%208%2C%20Jhalawar%20Road%2C%20near%20chhawni%2C%20Tilak%20Nagar%2C%20Chawani%2C%20Kota', '%2B91%2094141%2089890', '%3Ca%20href%3D%22http%3A%2F%2Fhotelleamor.com%2F%22%20target%3D%22_blank%22%20class%3D%22visit-link%22%3EVisit%20Website%3C%2Fa%3E','N%2FA')" class="action-button">Add to List</a>-->
                    <!--</td>-->
                  </tr>
                  <?php } } else{ ?>
                    <tr>
                        <td colspan="6" style="padding: 20px 0 0 0;">
                            <div class="table-no-record"style="display: flex; flex-direction: column; align-items: center; background: var(--theme-br); padding: 20px;">
                                <img src="<?= $this->config->item('assetsPath') ?>images/no-record.png" alt="image">
                                <p class="mb-0 title">No results found</p>
                            </div>
                        </td>
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
<!-- businessFinder Modal -->

<!-- aIProposal Modal -->
<div class="modal fade" id="aIProposalModal" tabindex="-1" aria-labelledby="aIProposalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 945px;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="aIProposalLabel">AI Proposal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-wrapper-box">
          <div class="ai-proposal-box">
              <?php echo $proposal_email['email_body']; ?>
            <!--<p class="mb-0">Dear Valued VIP Customer,</p>-->
            <!--<p class="mb-0">We hope this message finds you in great spirits! As one of our esteemed VIP customers, we are excited to share an exclusive promotion designed to elevate your fitness journey.</p>-->
            <!--<p class="mb-0">For a limited time only, enjoy 20% off on all gym memberships and personal training packages. Whether you're looking to kickstart your fitness routine, refine your skills, or take your workouts to the next level, our state-of-the-art facilities and expert trainers are here to support you every step of the way.</p>-->
            <!--<p class="mb-0">Additionally, we invite you to join our upcoming fitness workshops, where you can learn new techniques, meet like-minded individuals, and gain motivation from our professional trainers. Spaces are limited, so be sure to reserve your spot today!</p>-->
            <!--<p class="mb-0">To take advantage of this exclusive offer, simply use the code VIPFIT20 at checkout or mention it at our front desk. This offer is valid until the end of the month, so don't miss out!</p>-->
            <!--<p class="mb-0">Thank you for being a valued part of our fitness community. We can't wait to see you back in the gym!</p>-->
            <!--<p class="mb-0">Warm regards,</p>-->
            <!--<p class="mb-0">The Fitness Team</p>-->
            <!--<p class="mb-0">Fitness Center Name</p>-->
            <!--<p class="mb-0">Email: info@fitnesscenter.com</p>-->
            <!--<p class="mb-0">Phone: (123) 456-7890</p>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- aIProposal Modal -->

<!-- emailSequence Modal -->
<div class="modal fade" id="emailSequenceModal" tabindex="-1" aria-labelledby="emailSequenceLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 945px;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="emailSequenceLabel">Email Sequence</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-wrapper-box">
          <div class="row row-gap-2 justify-content-center">
            <?php 
                $colors = [
                    '#9E70FF',
                    '#76B1FA',
                    '#FF8F58',
                    '#E6475B',
                    '#41F492'
                ];
                if(!empty($sequance_email)) {
                     $email_types =array('Welcome & Hook','Problem + Story','Value + Soft Pitch','Offer + Proof','Urgency + CTA');
                foreach($sequance_email as $keys=>$sequanceEmail) {
                $color = $colors[$keys] ?? $colors[$keys % count($colors)];
            ?>
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="email-sequence-box-parent">
                <div class="email-sequence-box-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle" style="color: <?php echo $color; ?>" aria-hidden="true"></i>
                        <p class="title mb-0 w500">Email <?php echo $keys + 1; ?> - <?php if($keys <= 4) echo $email_types[$keys]?> </p>
                    </div>
                </div>
                <div class="email-sequence-box">
                    <?php echo $sequanceEmail['email_body']; ?>
                  <!--<p class="mb-0">Dear Valued VIP Customer,</p>-->
                  <!--<p class="mb-0">We hope this message finds you in great spirits! As one of our esteemed VIP customers, we are excited to share an exclusive promotion designed to elevate your fitness journey.</p>-->
                  <!--<p class="mb-0">For a limited time only, enjoy 20% off on all gym memberships and personal training packages. Whether you're looking to kickstart your fitness routine, refine your skills, or take your workouts to the next level, our state-of-the-art facilities and expert trainers are here to support you every step of the way.</p>-->
                  <!--<p class="mb-0">Additionally, we invite you to join our upcoming fitness workshops, where you can learn new techniques, meet like-minded individuals, and gain motivation from our professional trainers. Spaces are limited, so be sure to reserve your spot today!</p>-->
                  <!--<p class="mb-0">To take advantage of this exclusive offer, simply use the code VIPFIT20 at checkout or mention it at our front desk. This offer is valid until the end of the month, so don't miss out!</p>-->
                  <!--<p class="mb-0">Thank you for being a valued part of our fitness community. We can't wait to see you back in the gym!</p>-->
                  <!--<p class="mb-0">Warm regards,</p>-->
                  <!--<p class="mb-0">The Fitness Team</p>-->
                  <!--<p class="mb-0">Fitness Center Name</p>-->
                  <!--<p class="mb-0">Email: info@fitnesscenter.com</p>-->
                  <!--<p class="mb-0">Phone: (123) 456-7890</p>-->
                </div>
              </div>
            </div>
            <?php } } ?>
            
            <!--<div class="col-12 col-sm-6 col-lg-4">-->
            <!--  <div class="email-sequence-box-parent">-->
            <!--    <div class="email-sequence-box" style="height: 240px;">-->
            <!--      <p class="mb-0">Dear Valued VIP Customer,</p>-->
            <!--      <p class="mb-0">We hope this message finds you in great spirits! As one of our esteemed VIP customers, we are excited to share an exclusive promotion designed to elevate your fitness journey.</p>-->
            <!--      <p class="mb-0">For a limited time only, enjoy 20% off on all gym memberships and personal training packages. Whether you're looking to kickstart your fitness routine, refine your skills, or take your workouts to the next level, our state-of-the-art facilities and expert trainers are here to support you every step of the way.</p>-->
            <!--      <p class="mb-0">Additionally, we invite you to join our upcoming fitness workshops, where you can learn new techniques, meet like-minded individuals, and gain motivation from our professional trainers. Spaces are limited, so be sure to reserve your spot today!</p>-->
            <!--      <p class="mb-0">To take advantage of this exclusive offer, simply use the code VIPFIT20 at checkout or mention it at our front desk. This offer is valid until the end of the month, so don't miss out!</p>-->
            <!--      <p class="mb-0">Thank you for being a valued part of our fitness community. We can't wait to see you back in the gym!</p>-->
            <!--      <p class="mb-0">Warm regards,</p>-->
            <!--      <p class="mb-0">The Fitness Team</p>-->
            <!--      <p class="mb-0">Fitness Center Name</p>-->
            <!--      <p class="mb-0">Email: info@fitnesscenter.com</p>-->
            <!--      <p class="mb-0">Phone: (123) 456-7890</p>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            <!--<div class="col-12 col-sm-6 col-lg-4">-->
            <!--  <div class="email-sequence-box-parent">-->
            <!--    <div class="email-sequence-box" style="height: 240px;">-->
            <!--      <p class="mb-0">Dear Valued VIP Customer,</p>-->
            <!--      <p class="mb-0">We hope this message finds you in great spirits! As one of our esteemed VIP customers, we are excited to share an exclusive promotion designed to elevate your fitness journey.</p>-->
            <!--      <p class="mb-0">For a limited time only, enjoy 20% off on all gym memberships and personal training packages. Whether you're looking to kickstart your fitness routine, refine your skills, or take your workouts to the next level, our state-of-the-art facilities and expert trainers are here to support you every step of the way.</p>-->
            <!--      <p class="mb-0">Additionally, we invite you to join our upcoming fitness workshops, where you can learn new techniques, meet like-minded individuals, and gain motivation from our professional trainers. Spaces are limited, so be sure to reserve your spot today!</p>-->
            <!--      <p class="mb-0">To take advantage of this exclusive offer, simply use the code VIPFIT20 at checkout or mention it at our front desk. This offer is valid until the end of the month, so don't miss out!</p>-->
            <!--      <p class="mb-0">Thank you for being a valued part of our fitness community. We can't wait to see you back in the gym!</p>-->
            <!--      <p class="mb-0">Warm regards,</p>-->
            <!--      <p class="mb-0">The Fitness Team</p>-->
            <!--      <p class="mb-0">Fitness Center Name</p>-->
            <!--      <p class="mb-0">Email: info@fitnesscenter.com</p>-->
            <!--      <p class="mb-0">Phone: (123) 456-7890</p>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            <!--<div class="col-12 col-sm-6 col-lg-4">-->
            <!--  <div class="email-sequence-box-parent">-->
            <!--    <div class="email-sequence-box" style="height: 240px;">-->
            <!--      <p class="mb-0">Dear Valued VIP Customer,</p>-->
            <!--      <p class="mb-0">We hope this message finds you in great spirits! As one of our esteemed VIP customers, we are excited to share an exclusive promotion designed to elevate your fitness journey.</p>-->
            <!--      <p class="mb-0">For a limited time only, enjoy 20% off on all gym memberships and personal training packages. Whether you're looking to kickstart your fitness routine, refine your skills, or take your workouts to the next level, our state-of-the-art facilities and expert trainers are here to support you every step of the way.</p>-->
            <!--      <p class="mb-0">Additionally, we invite you to join our upcoming fitness workshops, where you can learn new techniques, meet like-minded individuals, and gain motivation from our professional trainers. Spaces are limited, so be sure to reserve your spot today!</p>-->
            <!--      <p class="mb-0">To take advantage of this exclusive offer, simply use the code VIPFIT20 at checkout or mention it at our front desk. This offer is valid until the end of the month, so don't miss out!</p>-->
            <!--      <p class="mb-0">Thank you for being a valued part of our fitness community. We can't wait to see you back in the gym!</p>-->
            <!--      <p class="mb-0">Warm regards,</p>-->
            <!--      <p class="mb-0">The Fitness Team</p>-->
            <!--      <p class="mb-0">Fitness Center Name</p>-->
            <!--      <p class="mb-0">Email: info@fitnesscenter.com</p>-->
            <!--      <p class="mb-0">Phone: (123) 456-7890</p>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            <!--<div class="col-12 col-sm-6 col-lg-4">-->
            <!--  <div class="email-sequence-box-parent">-->
            <!--    <div class="email-sequence-box" style="height: 240px;">-->
            <!--      <p class="mb-0">Dear Valued VIP Customer,</p>-->
            <!--      <p class="mb-0">We hope this message finds you in great spirits! As one of our esteemed VIP customers, we are excited to share an exclusive promotion designed to elevate your fitness journey.</p>-->
            <!--      <p class="mb-0">For a limited time only, enjoy 20% off on all gym memberships and personal training packages. Whether you're looking to kickstart your fitness routine, refine your skills, or take your workouts to the next level, our state-of-the-art facilities and expert trainers are here to support you every step of the way.</p>-->
            <!--      <p class="mb-0">Additionally, we invite you to join our upcoming fitness workshops, where you can learn new techniques, meet like-minded individuals, and gain motivation from our professional trainers. Spaces are limited, so be sure to reserve your spot today!</p>-->
            <!--      <p class="mb-0">To take advantage of this exclusive offer, simply use the code VIPFIT20 at checkout or mention it at our front desk. This offer is valid until the end of the month, so don't miss out!</p>-->
            <!--      <p class="mb-0">Thank you for being a valued part of our fitness community. We can't wait to see you back in the gym!</p>-->
            <!--      <p class="mb-0">Warm regards,</p>-->
            <!--      <p class="mb-0">The Fitness Team</p>-->
            <!--      <p class="mb-0">Fitness Center Name</p>-->
            <!--      <p class="mb-0">Email: info@fitnesscenter.com</p>-->
            <!--      <p class="mb-0">Phone: (123) 456-7890</p>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- emailSequence Modal -->
 
<!-- mobileApp Modal -->
<div class="modal fade" id="mobileAppModal" tabindex="-1" aria-labelledby="mobileAppLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 945px;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="mobileAppLabel">Mobile App</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-wrapper-box">
          <div class="theme-phone-screen">
              <div class="display">
                  <iframe src="<?php echo $finalURL; ?>"
                      title="W3Schools Free Online Web Tutorials"></iframe>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- mobileApp Modal -->

<!-- socialPost Modal -->
<div class="modal fade" id="socialPostModal" tabindex="-1" aria-labelledby="socialPostLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 945px;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="socialPostLabel">Social media content</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-wrapper-box d-flex align-items-center justify-content-center">
          <div class="row row-gap-2 justify-content-center">
            <div class="col-12 col-md-5">
              <div class="social-post-img">
                  <?php if(!empty($social_media_content)) { ?>
                <img src="<?php echo $social_media_content['image'] ?>" alt="image">
                <?php } ?>
              </div>
            </div>
            <div class="col-12 col-md-5">
              <div class="social-post-single">
                   <?php if(!empty($social_media_content)) {  
                    echo str_replace('```html', '', $social_media_content['socialmedia_body']); ;
                   }?>
              
                <!--<h1 class="title">Stop posting content that the algorithm is ignoring.</h1>-->
                <!--  <p>-->
                <!--    If your reach has plummeted lately, it’s not “bad luck” —-->
                <!--    it’s your strategy.-->
                <!--  </p>-->
                <!--  <p>-->
                <!--    Platforms are shifting toward short-form, short-form video,-->
                <!--    and authentic content.-->
                <!--  </p>-->
                <!--  <p>-->
                <!--    If you’re still using 2023 tactics, you’re shouting into a void,-->
                <!--    not a crowd.-->
                <!--  </p>-->
                <!--  <p>-->
                <!--    Here’s the quick pivot you need to make today to get your engagement-->
                <!--    back on track.-->
                <!--  </p>-->
                <!--  <p class="hashtags">-->
                <!--    #DigitalMarketingTips #SocialMediaStrategy #AlgorithmUpdate-->
                <!--    #MarketingROI #ContentMarketing-->
                <!--  </p>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- socialPost Modal -->
 
<!-- agent Modal -->
<div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="agentLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 945px;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="agentLabel">Agent</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="my-embed-icon" id="my-embed">
          <div class="channel-view">
            <div class="chat-panel-container standalone-view" id="agent-standalone-view" agent-data-style="1" style="background-color:;">
              <div class="left-chat-col" id="welcome-agent-embed">
                  <div class="left-panel chat-panel" id="agent-left-panel-embed">
                      <div class="chat-container display-none" id="agent-chat-container-embed" style="overflow-y: auto;">
                          <!-- Agent Welcome Message -->
                          <div class="chat-message agent-suggest">
                               <?php if(!empty($agents_list_image)) { ?>
              
              <img src="<?php echo $agents_list_image['apv_image_path'] ?>" class="avatar agent-img-embed" alt="Agent">
                <?php } ?>
                              <!--<img src="https://cdn.grabagenticai.com/assets/templates/images/animal_nutritionist_ai_agent.png" alt="Agent Avatar" class="avatar agent-img-embed">-->
                              <div class="message-content">
                                  <p id="agent-wel-ai-msg-embed" style="color:;">Hello! Let me know how I can assist you!</p>
                                  <div class="btn-group" id="chatbot-ques-embed"></div>
                              </div>
                          </div>
                      </div>
                      <div class="agent-input-wrapper display-none">
                          <div class="agent-input-bx">
                              <textarea type="text" class="agent-input" id="agent-input-embed" placeholder="Type a message" style="resize: none;"></textarea>
                          </div>
                          <div class="agent-input-btn">
                              <button class="msgButton button-no-rule voice-active" id="agent-voice-active-embed">
                                  <span class="voice"><i class="fa-solid fa-phone-volume"></i></span>
                              </button>
                              <button class="msgButton button-no-rule send-active display-none" id="agent-send-active-embed">
                                  <span class="send"><i class="fa-solid fa-paper-plane"></i></span>
                              </button>
                          </div>
                      </div>
  
                      <div class="agent-call-wrapper display-none">
                          <div class="agent-call-photo">
                                   <?php if(!empty($agents_list_image)) { ?>
              
              <img src="<?php echo $agents_list_image['apv_image_path'] ?>" class="agent-photo agent-img-embed" alt="Agent">
                <?php } ?>
                             
                          </div>  
                          <div class="display-flex flex-column align-items-center gap-5">
                              <div class="agent-call-name agent-bname-embed" style="color:;">
                                      <?php if(!empty($agents_list)) { ?>
              <?php echo $agents_list['text'] ?>
                <?php } ?>
                </div>
                          </div>
                          <div class="talk-action-wrapper">
                              <button class="talk-button mb-2" id="agent-talk-button-embed">
                                  Talk to Agent
                                  <span class="icon">
                                      <i class="fa-solid fa-phone-volume"></i>
                                  </span>
                              </button>
                              <a href="javascript:void(0);" class="link-text" id="agent-go-to-chat-embed">
                                  <i class="fa-solid fa-arrow-left"></i> Back to chat
                              </a>
                              <p class="call-timer display-none" id="agent-call-timer-embed">00:00</p>
                              <div class="call-action-wrap display-none" id="agent-call-action-embed">
                                  <button class="icon-btn mic mic-cut">
                                      <i class="fa-solid fa-microphone-lines mic-on display-none" id="agent-mic-on-embed"></i>
                                      <i class="fa-solid fa-microphone-lines-slash mic-off" id="agent-mic-off-embed"></i>
                                  </button>
                                  <button class="icon-btn call-cut" id="agent-call-cut-embed"><i class="fa-solid fa-xmark"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="agent-privacy-policy" id="agent-privacy-policy-embed"><span style="">Powered By </span>
                      <a id="agent-footer-url-embed" href="https://www.getbizoraai.com/special/" target="_blank" style="display: flex; justify-content: center; align-items: center;">
                          <img src="<?php echo $this->config->item('assetsPath') ?>images/footer_logo.png" id="agent-footer-logo-embed" style="height:15px;">
                      </a>
                  </div>
              </div>
              <div class="right-chat-col">
                  <div class="right-panel" style="background-color:;">
                      <div class="head-content">
                          <h6 class="name m-b0 agent-name-embed" style="color:; ">
                                 <?php if(!empty($agents_list)) { ?>
              <?php echo $agents_list['text'] ?>
                <?php } ?>
                              <svg width="18" height="18" viewBox="0 0 18 18" fill="" xmlns="http://www.w3.org/2000/svg">
                                  <g clip-path="url(#clip0_1_73)">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.0625 1.40625H4.21875C3.47344 1.40625 2.75627 1.70268 2.23033 2.23003C1.70158 2.75737 1.40625 3.47288 1.40625 4.21875V5.0625H0.5625C0.253125 5.0625 0 5.3145 0 5.625C0 5.9355 0.253125 6.1875 0.5625 6.1875H1.40625V7.3125H0.5625C0.253125 7.3125 0 7.5645 0 7.875C0 8.1855 0.253125 8.4375 0.5625 8.4375H1.40625V9.5625H0.5625C0.253125 9.5625 0 9.8145 0 10.125C0 10.4355 0.253125 10.6875 0.5625 10.6875H1.40625V11.8125H0.5625C0.253125 11.8125 0 12.0645 0 12.375C0 12.6855 0.253125 12.9375 0.5625 12.9375H1.40625V13.7812C1.40625 14.5271 1.70158 15.2426 2.23033 15.77C2.75627 16.2973 3.47344 16.5938 4.21875 16.5938H5.0625V17.4375C5.0625 17.748 5.31563 18 5.625 18C5.93437 18 6.1875 17.748 6.1875 17.4375V16.5938H7.3125V17.4375C7.3125 17.748 7.56563 18 7.875 18C8.18437 18 8.4375 17.748 8.4375 17.4375V16.5938H9.5625V17.4375C9.5625 17.748 9.81563 18 10.125 18C10.4344 18 10.6875 17.748 10.6875 17.4375V16.5938H11.8125V17.4375C11.8125 17.748 12.0656 18 12.375 18C12.6844 18 12.9375 17.748 12.9375 17.4375V16.5938H13.7812C14.5266 16.5938 15.2437 16.2973 15.7697 15.77C16.2984 15.2426 16.5938 14.5271 16.5938 13.7812V12.9375H17.4375C17.7469 12.9375 18 12.6855 18 12.375C18 12.0645 17.7469 11.8125 17.4375 11.8125H16.5938V10.6875H17.4375C17.7469 10.6875 18 10.4355 18 10.125C18 9.8145 17.7469 9.5625 17.4375 9.5625H16.5938V8.4375H17.4375C17.7469 8.4375 18 8.1855 18 7.875C18 7.5645 17.7469 7.3125 17.4375 7.3125H16.5938V6.1875H17.4375C17.7469 6.1875 18 5.9355 18 5.625C18 5.3145 17.7469 5.0625 17.4375 5.0625H16.5938V4.21875C16.5938 3.47288 16.2984 2.75737 15.7697 2.23003C15.2437 1.70268 14.5266 1.40625 13.7812 1.40625H12.9375V0.5625C12.9375 0.252 12.6844 0 12.375 0C12.0656 0 11.8125 0.252 11.8125 0.5625V1.40625H10.6875V0.5625C10.6875 0.252 10.4344 0 10.125 0C9.81563 0 9.5625 0.252 9.5625 0.5625V1.40625H8.4375V0.5625C8.4375 0.252 8.18437 0 7.875 0C7.56563 0 7.3125 0.252 7.3125 0.5625V1.40625H6.1875V0.5625C6.1875 0.252 5.93437 0 5.625 0C5.31563 0 5.0625 0.252 5.0625 0.5625V1.40625ZM15.4688 4.21875V13.7812C15.4688 14.2287 15.2916 14.6579 14.9737 14.9746C14.6587 15.291 14.2284 15.4688 13.7812 15.4688H4.21875C3.77156 15.4688 3.34125 15.291 3.02625 14.9746C2.70844 14.6579 2.53125 14.2287 2.53125 13.7812V4.21875C2.53125 3.77128 2.70844 3.34209 3.02625 3.0254C3.34125 2.709 3.77156 2.53125 4.21875 2.53125H13.7812C14.2284 2.53125 14.6587 2.709 14.9737 3.0254C15.2916 3.34209 15.4688 3.77128 15.4688 4.21875ZM14.9062 4.21875C14.9062 3.92034 14.7881 3.63431 14.5772 3.42337C14.3662 3.21216 14.0794 3.09375 13.7812 3.09375C11.9334 3.09375 6.06656 3.09375 4.21875 3.09375C3.92062 3.09375 3.63376 3.21216 3.42282 3.42337C3.21189 3.63431 3.09375 3.92034 3.09375 4.21875V13.7812C3.09375 14.0797 3.21189 14.3657 3.42282 14.5766C3.63376 14.7878 3.92062 14.9062 4.21875 14.9062H13.7812C14.0794 14.9062 14.3662 14.7878 14.5772 14.5766C14.7881 14.3657 14.9062 14.0797 14.9062 13.7812V4.21875ZM9.84375 11.5312V7.3125C9.84375 6.22519 8.96344 5.34375 7.875 5.34375C6.78656 5.34375 5.90625 6.22519 5.90625 7.3125V11.5312C5.90625 11.8418 6.15938 12.0938 6.46875 12.0938C6.77812 12.0938 7.03125 11.8418 7.03125 11.5312V10.125H8.71875V11.5312C8.71875 11.8418 8.97188 12.0938 9.28125 12.0938C9.59062 12.0938 9.84375 11.8418 9.84375 11.5312ZM10.9688 5.90625V11.5312C10.9688 11.8418 11.2219 12.0938 11.5312 12.0938C11.8406 12.0938 12.0938 11.8418 12.0938 11.5312V5.90625C12.0938 5.59575 11.8406 5.34375 11.5312 5.34375C11.2219 5.34375 10.9688 5.59575 10.9688 5.90625ZM7.03125 9H8.71875V7.3125C8.71875 6.84647 8.34188 6.46875 7.875 6.46875C7.40812 6.46875 7.03125 6.84647 7.03125 7.3125V9Z" fill="var(--agent-bot-white-text)"></path>
                                  </g>
                                  <defs>
                                  <clipPath id="clip0_1_73">
                                  <rect width="18" height="18" fill="white"></rect>
                                  </clipPath>
                                  </defs>
                              </svg>
                          </h6>
                      </div>
                      <div class="agent-img">
                                <?php if(!empty($agents_list_image)) { ?>
              
              <img src="<?php echo $agents_list_image['apv_image_path'] ?>" class="agent-photo agent-img-embed" alt="Agent">
                <?php } ?>
                          
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- agent Modal -->

<script>
  function createAiTemplateApp() {
    const prompt = document.getElementById('themePrompt').value.trim();
    if (!prompt) {
      flashNow({
        'error': {
          'message': "Please enter prompt!"
        }
      });

      return false;
    }
    let newThemeName = prompt;

    jsLoader(true);
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('save-ai-prompt'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompt,
          project_name: newThemeName
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {
          console.log(data.redirect + '?theme=' + data.used_folder);

          window.location.href = "<?= base_url('business-generator-list'); ?>";


        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function email_sequances_default() {
    const prompts = document.getElementById('themePrompt').value.trim();
    jsLoader(true);
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('emails-sequances-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          window.location.href = "<?= base_url('business-generator-list'); ?>";

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function emails_promotions_default() {
    const prompts = document.getElementById('themePrompt').value.trim();
    jsLoader(true);
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('emails-promotions-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          window.location.href = "<?= base_url('business-generator-list'); ?>";

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function social_mediacontent_default() {
    const prompts = document.getElementById('themePrompt').value.trim();
    jsLoader(true);
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('social-mediacontent-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          window.location.href = "<?= base_url('business-generator-list'); ?>";

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }
  
  function agents_default(){
        const prompts = document.getElementById('themePrompt').value.trim();
           jsLoader(true);
            const btn = this;
                  btn.disabled = true;
                  const previousHtml = btn.innerHTML;
                  btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;
                
                  fetch("<?= base_url('agent-create-default'); ?>", {
                    method: "POST",
                    headers: {
                      "Content-Type": "application/json",
                      "Accept": "application/json"
                    },
                    credentials: "include",
                    body: JSON.stringify({ prompt: prompts })
                  })
                 
                  .then(response => {
              
                    return response.text().then(text => ({ ok: response.ok, status: response.status, text }));
                  })
                  .then(({ ok, status, text }) => {
                    console.log("Raw server response:", text);
                
                    let data;
                    try {
                      data = JSON.parse(text);
                    } catch (e) {
                     
                      btn.disabled = false;
                      btn.innerHTML = previousHtml;
                      return;
                    }
                
                    if (!ok) {
                      
                      const msg = data.message || `Server returned status ${status}`;
                      btn.disabled = false;
                      btn.innerHTML = previousHtml;
                      return;
                    }
                
                    if (data.status == "success") {
                        jsLoader(false);
                        window.location.href = "<?= base_url('business-generator-list'); ?>";
                  
                    }
                  })
                  .catch(error => {
                    console.error("Fetch error:", error);
                    btn.disabled = false;
                    btn.innerHTML = previousHtml;
                  });
           
        }

  function find_inplace_default() {

    const prompts = document.getElementById('themePrompt').value.trim();
    jsLoader(true);
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('find-inplace-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {
        jsLoader(false);
        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          window.location.href = "<?= base_url('business-generator-list'); ?>";
          setTimeout(() => {

          }, 500);

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }



  function jsLoader(add) {
    if (add === undefined) {
      add = false;
    }
    $(".temp_js_loader").remove();
    if (add) {
      $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999999;">\
        		<img src="<?php echo $this->config->item("assetsTemplatePath"); ?>images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; width:120px;">\
        		</div>');
    }
  }
</script>
<script>
  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();

    try {
      document.execCommand("copy");
      flashNow({
        'success': {
          'message': "Link copied to clipboard!"
        }
      });
      // alert("✅ Link copied to clipboard!");
    } catch (err) {
      flashNow({
        'error': {
          'message': "Unable to copy text"
        }
      });
      // alert("❌ Unable to copy text");
    }

    $temp.remove();
  }

  function modalCopy() {
    let input = document.getElementById("sharetext");

    input.select();
    input.setSelectionRange(0, 99999); // mobile support

    try {
      document.execCommand("copy");
      flashNow({
        'success': {
          'message': "Copied!"
        }
      });
    } catch (err) {
      flashNow({
        'error': {
          'message': "Unable to copy text"
        }
      });
    }
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/kjua@0.1.1/dist/kjua.min.js"></script>
<script>
  jQuery(document).ready(function() {
    var qrcode = kjua({
      text: "<?php echo base_url($activeFile) ?>",
      render: 'canvas',
      size: 200,
      fill: "#333333",
      back: "#FFFFFF",
      rounded: 0,
      quiet: 2
    });

    jQuery('#qrcode-preview').empty().append(qrcode);
    var imgURL = qrcode.toDataURL("image/png");
    jQuery('#download-qr-code').attr('href', imgURL);
  });
</script>
<!-- quitBusinessList Modal -->

<!-- chat agent js -->
<script>
const agentInputEmbed = document.getElementById("agent-input-embed");
const agentSendMsgEmbed = document.getElementById("agent-send-active-embed");
const agentVoiceActiveEmbed = document.getElementById("agent-voice-active-embed");
agentInputEmbed.addEventListener("input", () => {
    if (agentInputEmbed.value.trim() === "") {
        agentSendMsgEmbed.classList.add("display-none");
        agentVoiceActiveEmbed.classList.remove("display-none");
    } else {
        agentVoiceActiveEmbed.classList.add("display-none");
        agentSendMsgEmbed.classList.remove("display-none");
    }
});

function checkScreen() {
    if (window.innerWidth <= 575) {
        document.querySelector('.chat-panel-container.standalone-view')?.classList.add('chatbot-view');
        document.querySelector('.left-chat-col.welcome-screen')?.classList.remove('welcome-screen');
    } else {
        document.querySelector('.chat-panel-container.standalone-view')?.classList.remove('chatbot-view');
    }
}

checkScreen();

window.addEventListener('resize', checkScreen);

document.addEventListener("DOMContentLoaded", function () {

  const voiceBtn = document.getElementById("agent-voice-active-embed");
  const chatBtn = document.getElementById("agent-go-to-chat-embed");
  const leftPanel = document.getElementById("agent-left-panel-embed");

  if (voiceBtn && chatBtn && leftPanel) {

    // Add class on voice click
    voiceBtn.addEventListener("click", function () {
      leftPanel.classList.add("call-panel");
    });

    // Remove class on chat click
    chatBtn.addEventListener("click", function () {
      leftPanel.classList.remove("call-panel");
    });

  }

});
</script>
<!-- chat agent js -->