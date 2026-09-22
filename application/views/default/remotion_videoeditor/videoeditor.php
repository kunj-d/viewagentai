<style>
    .editor-sidebar-logo{
        width: 30px;
        height: 30px;
        img{
            width:100%;
            height:100%;
            object-fit: cover;
        }
    }
</style>

<div class="container-wrapper container-open pt-0 editor-parent" style="width: 100%; left : 0;">
  <title><?php echo $this->config->item('productName') ?> | Video Editor</title>
  <div class="p-0 container-padding">
    <div class="d-flex vh-100">

      <!-- Sidebar Section -->
      <div class="editor-sidebar-menu">
        <div class="sidebar-head d-flex align-items-center justify-content-center gap-2">
          <div class="back-btn text-white">
            <a class="dashboard-link" href="<?= base_url('dashboard') ?>">
                <i class="fa-solid fa-angle-left"></i>
            </a>
          </div>
          <a href="<?= base_url('dashboard') ?>" class="editor-sidebar-logo">
            <img src="<?= $this->config->item('assetsPath') ?>images/default-img.png" alt="image">
          </a>
        </div>
        <div class="sidebar-items-list">
         
         
             <!-- Avatar button -->
          <div class="sidebar-items">
            <button onclick="handleSidebarClick(this, 'heygen_video_list')" class="items-link active">
              <i class="fa-solid fa-user-astronaut"></i>
              <span class="item-text">Avatar</span>
            </button>
          </div>
         
         
         
         
         
           <!-- Template Tool Button -->
          <div class="sidebar-items">
            <button onclick="handleSidebarClick(this,'template')" class="items-link">
              <i class="fa-solid fa-layer-group"></i>
              <span class="item-text">Template</span>
            </button>
          </div>
         
         
         
         
       
         
         
         
         <!-- ai gen button -->
         <div class="sidebar-items">
            <button onclick="handleSidebarClick(this,'GenerativeAiLibrary')" class="items-link">
                <i class="fa-solid fa-robot" aria-hidden="true"></i>
                <span class="item-text">AI Studio</span>
            </button>
          </div>
         
         
         
         
         
         
            <!-- background button -->
          <div class="sidebar-items">
            <button onclick="handleSidebarClick(this, 'main_container_bg')" class="items-link">
             <i class="fas fa-palette"></i>
              <span class="item-text">BG</span>
            </button>
          </div>
         
           <!-- Text Button -->
          <div class="sidebar-items">
            <button onclick="handleSidebarClick(this,'text')" class="items-link">
              <i class="fas fa-font"></i>
              <span class="item-text">Text</span>
            </button>
          </div>
         
           
          <!-- Elements Button -->
          <div class="sidebar-items">
            <button onclick="handleSidebarClick(this,'emoji')" class="items-link">
              <i class="fa-solid fa-shapes"></i>
              <span class="item-text">Elements</span>
            </button>
          </div>
         
         
         
          <!-- Asset button -->
          <div class="sidebar-items">
            <button onclick="handleSidebarClick(this,'upload')" class="items-link">
              <i class="fas fa-photo-video"></i>
              <span class="item-text">Asset</span>
            </button>
          </div>
 
          
            <!-- Library Button -->
          <div class="sidebar-items">
            <button onclick="handleSidebarClick(this,'Library')" class="items-link">
             <i class="fa-solid fa-icons"></i>
               <span class="item-text">Library</span>
            </button>
          </div>
 
        </div>
        
      </div>
      <!-- Sidebar Section -->

      <!-- Iframe Section -->
      <div class="p-0 overflow-hidden" style="flex: 1;">
        <iframe id="reactIframe" class="w-100 h-100 border-0" src="https://aivideobuilderfx.in/"
          title="React App">
        </iframe>
      </div>


      <!-- Modal  video upload-->
      <div class="modal fade" id="exampleModalVideo" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Media</h5>
              <button type="button" class="btn-close close_video_popup" onClick="closeVideoPopup()"
                data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <form action="<?php echo base_url().$this->config->item('prefix_video_route').'/upload-video'?>"
                method="POST" enctype="multipart/form-data" id="videoUploadForm">
                <div class="mb-3 video_upload_div">

                  <input type="file" name="video_file" id="video_file" class="form-control" accept="image/*,video/*,audio/*">
                </div>

              </form>
              <div class="upload-process">

              </div>
            </div>

            <div class="modal-footer">
              
            </div>
          </div>
        </div>
      </div>
         <script>
               function handleSidebarClick(button, state) {
                document.querySelectorAll('.sidebar-items .items-link').forEach(btn => {
                btn.classList.remove('active');
               });
            button.classList.add('active');
            sendMessageToIframe(state);
          }
          </script>

      <script src="<?php echo $this->config->item('assetsTemplatePath');?>editor/drop_uploader.js"></script>
      <script src="<?php echo $this->config->item('assetsTemplatePath');?>editor/uploadvideo.js"></script>
      <!-- Modal  video upload-->

    </div>
  </div>

  <script>
    // removing footer
    $(document).ready(function() {
      $(".footer-sticky-height, .footer-design, .sidebar").addClass("d-none");
    });
  </script>

  <script>
  var assetsFolder = '<?php echo $this->config->item('assetsTemplatePath'); ?>';
  var siteUrl = '<?php echo base_url();?>';
  var iframe_main_url = 'https://aivideobuilderfx.in/';
 var templates_json = '<?php  echo $this->session->userdata('project_name')['json_url'] ?>';
 var id = '<?php echo $this->session->userdata('project_name')['id']?>';
 var project_name = '<?php echo $this->session->userdata('project_name')['name']?>';
 var mp4_sesson = '<?php echo $this->session->userdata('mp4_session')['url']?>';
  // site menu send satet
  function sendMessageToIframe(state) {
    console.log("done2");

    const iframe = document.getElementById("reactIframe");
    iframe.contentWindow.postMessage({
        action: "updateState",
        state: state,
      },
      iframe_main_url
    );
  }

  // event  inner iframe 
  window.addEventListener("message", (event) => {
    if (event.data.action === "iframeReady") {
      sendInitialdata();
      console.log('test',templates_json);
      console.log('test1',mp4_sesson);
      if(templates_json != '') {
        temlateOpen();
      }
      if(mp4_sesson != '') {
          videoOpenInEditor();
      }
    }
    if (event.data.action === "sendMessageModelOpen") {
      console.log("open popup")
      $("#exampleModalVideo").modal("show");
      //   FileUploadedSuccessfully();
    }if (
           event.data?.type === "REDIRECT" &&
             event.data?.url === "video-editor-list" 
                ) {
                     window.onbeforeunload = null;
                    window.location.href = "<?= base_url('video-editor-list') ?>";
                    window.top.location.href = "<?= base_url('video-editor-list') ?>?r=" + Date.now();

                    // window.location.reload(true);
                }if (
                    event.data?.type === "REDIRECT" &&
                    event.data?.url === "video-editor-list-draft" 
                ) {
                    window.onbeforeunload = null;
                     window.top.location.href = "<?= base_url('video-editor-list') ?>?r=" + Date.now();

                    // window.location.href = "<?= base_url('video-editor-list') ?>";
                    // window.location.reload(true);
                }
    
  });
  
  
 
    // videoOpenInEditor
    function videoOpenInEditor() {
        console.log("Kkkkkkkk")
        const iframe = document.getElementById("reactIframe");
        iframe.contentWindow.postMessage(
            {
                action: "videoOpenInEditor",
                url: '<?php echo $this->session->userdata('mp4_session')['url']?>',
                thumbnail_url: '<?php echo $this->session->userdata('mp4_session')['thumbnail_url']?>',
                width: '<?php echo $this->session->userdata('mp4_session')['width']?>',
                height: '<?php echo $this->session->userdata('mp4_session')['height']?>',
                duration: '<?php echo $this->session->userdata('mp4_session')['duration']?>',
                playerHeight: '<?php echo $this->session->userdata('mp4_session')['playerHeight']?>',
                playerWidth: '<?php echo $this->session->userdata('mp4_session')['playerWidth']?>',
                id: '<?php echo $this->session->userdata('mp4_session')['id']?>',
                project_name: '<?php echo $this->session->userdata('mp4_session')['project_name']?>',
                project_type: 'mp4_avatar',
            },
            iframe_main_url
        );
    }
 
  
  //template run in ifrmae
     function temlateOpen() {
        console.log("temp_open",templates_json)
        const iframe = document.getElementById("reactIframe");
        iframe.contentWindow.postMessage(
          {
            action: "temlateOpenInEditor",
            id:id,
            project_name:project_name,
            template_url: templates_json,
            project_type: 'save_draft',
          },
          iframe_main_url
        );
      }

  // send project data to iframe
  function sendInitialdata() {
    console.log("done1");
    const iframe = document.getElementById("reactIframe");
    const initialData = {
      action: "sendProjectInfo",
      id: id,
      project_name:project_name,
      project_id: "project_tubeclawai",
      access_token: "<?php echo $access_token ?>",
      api_url: "<?php echo $this->config->item('www_domain') ?>",
    };

    iframe.contentWindow.postMessage(
      initialData,
      iframe_main_url
    );
  }


  // send message to iframe File Uploaded Successfully
  function FileUploadedSuccessfully(upload_type) {
    const iframe = document.getElementById("reactIframe");
    iframe.contentWindow.postMessage({
        action: "FileUploadedSuccessfully",
        upload_file_type: upload_type,
      },
      iframe_main_url
    );
  }
  
  
  // video editor notification toster
            window.addEventListener("message", (event) => {
                if (event.data.action === "notificationToster") {
                    flashNow({
                            'success': {
                                'message':event.data.message
                            }
                        });
                        
                }
            });
  
  
  </script>