<style>

    /*Setting Pag Card Effects*/



</style>



  <!-- Container Start -->

  <div class="container-wrapper container-open"><title><?php echo $this->config->item('productName') ?> | Settings</title>

        <!-- Main Container Start -->

        <div class="container-fluid container-padding" style=" min-height: calc(93vh);">

            <div class="row">

                <div class="col-12">

                    <div class="title-line mb-3">

                        Settings

                    </div>

                </div>

            </div>

            <div class="row">
                
                
        <?php if ($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) { ?>

            <div class="col-lg-3 col-md-4">
                <a href="<?= base_url('workspace') ?>" class="theme-shine-card" data-tilt>
                    <div class="shine"></div>
                    <div class="theme-card-icon">
                        <i class="fa-solid fa-briefcase setting-icon"></i>
                    </div>
                    <h5 class="theme-card-title">Manage Workspace</h5>
                </a>
            </div>
            
        <?php //if ($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id'] || $this->session->userdata('logged_in')['user_role'] != 'team') { ?>


            <!--<div class="col-lg-3 col-md-4">

                 <a href="<?= base_url('client-management')?>" class="setting-box">

                    <div class="text-center">

                        <i class="fa-solid fa-users-gear setting-icon"></i>

                        <h5 class="mt-4">Manage Client's</h5>

                    </div>

                                   

                     <span class="bg m-0 p-0"></span>

                  </a>

            </div>
            
            <div class="col-lg-3 col-md-4">

                 <a href="<?= base_url('team-management') ?>" class="setting-box">

                    <div class="text-center">

                        <span class="icon-team-management setting-icon"></span>

                        <h5 class="mt-4">Manage Team's</h5>

                    </div>

                     <span class="bg m-0 p-0"></span>

                </a>

            </div>-->
            
         <?php } ?> 
         
         
          <!-- <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('whitelabel', $team_privileges)) {?>
            <div class="col-lg-3 col-md-4">

                <a href="<?= base_url('whitelabel-setting') ?>" class="setting-box">

                <div class="text-center">

                    <span class="fa-solid fa-certificate setting-icon"></span>

                    <h5 class="mt-4">Whitelabel</h5>

                </div>

                    <span class="bg m-0 p-0"></span>

                </a>

            </div>
            <?php } ?>-->

            

            <div class="col-lg-3 col-md-4">
                <!--<a href="<?= base_url('settings') ?>" class="theme-shine-card" data-tilt>-->
                <a href="<?= base_url('subscription') ?>" class="theme-shine-card" data-tilt>
                    <div class="shine"></div>
                    <div class="theme-card-icon">
                        <span class="icon-subscription setting-icon"></span>
                    </div>
                    <h5 class="theme-card-title">Subscription</h5>
                </a>
            </div>

        <?php if (($this->session->userdata('logged_in')['id'] == $this->session->userdata('logged_in')['owner_id']) || in_array('integration', $team_privileges)) {?>
            <div class="col-lg-3 col-md-4">
            
                <a href="<?= base_url('integration') ?>" class="theme-shine-card" data-tilt>
                    <div class="shine"></div>
                    <div class="theme-card-icon">
                        <span class="icon-integration setting-icon"></span>
                    </div>
                    <h5 class="theme-card-title">Integration</h5>
                </a>
            </div>
        <?php } ?>

            <div class="col-lg-3 col-md-4 ">
                <!--<a href="<?= base_url('settings') ?>" class="theme-shine-card" data-tilt>-->
                <a href="<?= base_url('training') ?>" class="theme-shine-card" data-tilt>
                    <div class="shine"></div>
                    <div class="theme-card-icon">
                        <span class="icon-tutorial setting-icon"></span>
                    </div>
                    <h5 class="theme-card-title">Tutorial</h5>
                </a>
            </div>

             <div class="col-lg-3 col-md-4">

                <!--<a href="<?= base_url('settings') ?>" class="theme-shine-card" data-tilt>-->
                <a href="<?= base_url('bonuses/vip-bonuses') ?>" class="theme-shine-card" data-tilt>
                    <div class="shine"></div>
                    <div class="theme-card-icon">
                        <span class="icon-bonus setting-icon"></span>
                    </div>
                    <h5 class="theme-card-title">Bonuses</h5>
                </a>
            </div>

            <div class="col-lg-3 col-md-4">
                <!--<a href="<?= base_url('settings') ?>" class="theme-shine-card" data-tilt>-->
                <a href="<?= base_url('faqs') ?>" class="theme-shine-card" data-tilt>
                    <div class="shine"></div>
                    <div class="theme-card-icon">
                        <i class="icon-support setting-icon"></i>
                    </div>
                    <h5 class="theme-card-title">Support</h5>
                </a>
            </div>

        </div>

    </div>

<!--Shine Card -->
<script>
    const cards = document.querySelectorAll('.theme-shine-card[data-tilt]');

    cards.forEach(card => {
        const shine = card.querySelector('.shine');
        
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -15;
            const rotateY = ((x - centerX) / centerX) * 15;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
            const mouseXPercent = (x / rect.width) * 100;
            const mouseYPercent = (y / rect.height) * 100;
            shine.style.setProperty('--mouse-x', `${mouseXPercent}%`);
            shine.style.setProperty('--mouse-y', `${mouseYPercent}%`);
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        });
    });
</script>

<script>

$(function() {  

$('.setting-box')

.on('mouseenter', function(e) {

        var parentOffset = $(this).offset(),

          relX = e.pageX - parentOffset.left,

          relY = e.pageY - parentOffset.top;

        $(this).find('.bg').css({top:relY, left:relX})

})

.on('mouseout', function(e) {

        var parentOffset = $(this).offset(),

          relX = e.pageX - parentOffset.left,

          relY = e.pageY - parentOffset.top;

        $(this).find('.bg').css({top:relY, left:relX})

});

});



</script>





    