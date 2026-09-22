<style>
    .chat-window::-webkit-scrollbar {
    width: 5px;
 }

 .chat-window::-webkit-scrollbar-track {
    background-color: #fff;
    border-radius: 10px;
 }

 .chat-window::-webkit-scrollbar-thumb {
    border-radius: 10px;
    background-color: #e9ebed;
 }
 
.chatbox-va {
    position: relative;
    z-index: 1;
    max-width: 437px;
    height: 480px !important;
    max-height: 480px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 0 4px rgba(0,0,0,.14), 0 4px 8px rgba(0,0,0,.28);
    bottom: 0px;
    border-radius: 10px !important;
    /*background:url(https://test.grabiris.com/app/assets/images/bg1.png) !important;*/
    background:#ffffff;
}
.chat-window {
    flex: auto;
    max-height: calc(100% - 60px);
    background: transparent;
    overflow: auto;
    padding: 10px 10px 35px 10px;
}
.chatbox-va .chat-input-va {
    flex: 0 0 auto;
    height: 60px;
    background: #fff;
    box-shadow: 0 0 4px rgba(0,0,0,.14),0 4px 8px rgba(0,0,0,.28);
    margin-bottom: 0px;
    display: flex;
   position: absolute;
    width: 100%;
    bottom: 0px;
}
.chatbox-va .chat-input-va input {
    height: 59px;
    line-height: 60px;
    outline: 0 none;
    border: none;
    width: calc(100% - 60px);
    color: #000 !important;
    text-indent: 10px;
    font-size: 12pt;
    padding: 0;
    background: #fff;
    
}
.chatbox-va .chat-input-va button {
    float: right;
    outline: 0 none;
    border: none;
    background: rgb(16 163 127);
    height: 40px;
    width: 40px;
    border-radius: 50%;
    padding: 2px 0 0 0;
    margin: 10px;
    transition: all 0.15s ease-in-out;
	display: flex;
    align-items: center;
    justify-content: center;
}
.chatbox-va .chat-input-va input[good] + button {
    box-shadow: 0 0 2px rgba(0,0,0,.12),0 2px 4px rgba(0,0,0,.24);
    background: #2671ff;
}
.chatbox-va .chat-input-va input[good] + button:hover {
    box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
.chatbox-va .chat-input-va input[good] + button path {
    fill: white;
}
.msg-container {
    position: relative;
    display: inline-block;
    width: 100%;
    margin: 0 0 10px 0;
    padding: 0;
}
.msg-box {
    display: flex;
    background: #5b5e6c;
    padding: 10px 10px 0 10px;
    border-radius: 10px;
    width: auto;
    float: left;
    box-shadow: 0 0 2px rgba(0,0,0,.12),0 2px 4px rgba(0,0,0,.24);
}
.user-img {
    display: inline-block;
    border-radius: 50%;
    height: 40px;
    width: 40px;
    background: #2671ff;
    margin: 0 10px 10px 0;
}
.flr {
    flex: 1 0 auto;
    display: flex;
    flex-direction: column;
    width: calc(100% - 50px);
}
.messages {
    flex: 1 0 auto;
	color:#000 !important;
	font-size: 16px;
    background: #e9ebed!important;
}
.msg {
    display: inline-block;
    font-size: 11pt;
    line-height: 13pt;
    color: rgba(255,255,255,.7);
    margin: 0 0 4px 0;
}
.msg:first-of-type {
    margin-top: 8px;
}
.timestamp {
    color: rgba(0,0,0,.38);
    font-size: 8pt;
    margin-bottom: 10px;
}
.username {
    margin-right: 3px;
}
.posttime {
    margin-left: 3px;
}
.msg-self .msg-box {
    border-radius: 6px 0 0 6px;
    background: #2671ff;
    float: right;
}
.msg-self .user-img {
    margin: 0 0 10px 10px;
}
.msg-self .msg {
    text-align: right;
}
.msg-self .timestamp {
    text-align: right;
}

.comment-box{
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 10px;
    position: fixed;
    bottom: 20px;
    right: 20px;
    border-radius: 50%;
    background: rgb(16 163 127);
 }
 .cross-img{
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 10px;
 }
 .msg-remote{
    padding:10px 10px 10px 10px !important;
 }

 .msg-remote img{
    height: 35px;
    width: 35px;
    border-radius: 25px;
    margin-right:15px;
	background: #fff;
 }
 .msg-self{
    float: right!important;
    padding: 10px !important;
 }
 .msg-self img{
    height: 35px;
    width: 35px;
    border-radius: 25px;
    margin-right:15px;

 }
 
 .message div{
     display:flex;}
 
 .chatbox-header{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    background:rgb(16 163 127);
 }
 .chatbox-text{
     font-size:16px;
     color:#fff;
	 display: flex;
	 align-items: center;
 }
 .chatbox-text img{
	border-radius: 100%;
	background: #fff;
	height: 35px;
    width: 35px;
 }
 .accordion-item {
    position: relative;
    background: #21205a;
    background-clip: padding-box;
    border: solid 1px var(--theme-br);
    border-radius: 10px !important;
}
.accordion-item {
    position: relative;
    background: #21205a;
    background-clip: padding-box;
    border: solid 1px var(--theme-br);
    border-radius: 10px;
}
.accordion-item::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
    margin: -1px;
    border-radius: inherit;
    background: var(--theme-color);
}
.accordion-item::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
    margin: -1px;
    border-radius: inherit;
    background: var(--theme-color);
}
.accordion-button::after {
    background-image: none;
    background-size: 18.5px;
}
.accordion-button::after {
    background-image: none;
    background-size: 18.5px;
}
.accordion-button:focus { x
    box-shadow: none;
}

.accordion-button:not(.collapsed) {
    background: transparent;
    color: var(--white-color);
    box-shadow: none;
}
.accordion-button:focus {
    box-shadow: none;
}
.accordion-button:not(.collapsed) {
    background: transparent;
    color: var(--white-color);
    box-shadow: none;
}
.accordion-item .accordion-button:not(.collapsed)::after {
    background-image: none;
}
.accordion-item .accordion-button:not(.collapsed)::after {
    background-image: none;
}
.accordion-item .accordion-button::after {
     content: "\e906" !important;  
    font-family: 'icomoon';
}
}
.accordion-item .accordion-button::after {
   content: "\e906" !important;  
    font-family: 'icomoon';
}
.accordion-body {
    padding: 1rem 1.25rem !important;
    position: absolute !important;
    background-color: var(--theme-color) !important;
    z-index: 999 !important;
    border: 1px solid var(--theme-br) !important;
    border-radius: 10px !important;
    
}
.profile-img1 {
    width: 138px;
    height: 138px;
    border-radius: 100%;
    box-shadow: 1px 2px 15px rgba(0, 0, 0, 0.08);
    background: #374073;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    justify-content: center;
}
.profile-img1 img {
    object-fit: cover;
    height:100px;
    width:100px;
    border-radius:100%;
}
.profile-img1:hover .profile-text1 {
    font-size: 40px;
    position: absolute;
    left: 0px;
    right: 0px;
    top: 0px;
    bottom: 0px;
    align-items: center;
    color: rgb(255, 255, 255);
    justify-content: center;
    display: flex !important;
    background: rgba(0, 0, 0, 0.8);
}
.profile-text1 {
    color:#fff;
    font-weight: 600;
    font-size: 1rem;
    line-height: 1.250rem;
    cursor: pointer;
    padding: 5px 5px;
}
@media (min-width:768px){
   .mt-md70{
        margin-top: 70px;
    }
}
button#collClose{background:var(--theme-color);}
</style>
 
 <?php
$assets_folder = $assetsFolder;
$redirect_base_url = $this->config->item('base_url');
?>
    <div class="container-wrapper container-open ng-cloak" ng-app="AppModule" ng-controller="virtualAssitantUpdate" >
        <title><?php echo $this->config->item('productName') ?>|| ChatBot</title>
        <!-- Main Container Start -->
            <div class="container-fluid container-padding" style=" min-height: calc(92.5vh);">
                <form ng-submit="vaUpdate()" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 mt50 mt-md50">
                            <div class="title-line">Chat Bot</div>
                            <p class="container-page-subtitle mt10">Create Embed ChatBot on any Website.</p>
                        </div>

                    </div>
             

                <div class="row align-items-center">
               
                    <div class="col-md-7 col-12">
                        <div class="row mt20 mt-md35 align-items-center">
                           
                            <div class="col-xxl-6 col-xl-6 col-md-6 mt20 mt-md0">
                                <div class="row align-items-center">
                                    <div class="col-xxl-4 col-xl-3 col-md-3">
                                        <div class="profile-img profile-text">
                                

                                            <img src="<?= ($assistant_data->assistant_image == '' || $assistant_data->assistant_image == "default/images/grabiris.png") ? $assetsPath.'default/images/grabiris.png': $this->config->item('bucket_url') . $assistant_data->assistant_image  ?>" alt="Profile Img" class="img-fluid mx-auto d-block outputimage">
                                            
                                            <!-- Edit Profile Picture -->
                                            <label for="formFiles" class="profile-text d-none"><i class="icon-list-edit"></i></label>
                                            <input class="form-control d-none" type="file" id="formFiles" name="image" placeholder="Edit Profile Picture" onchange="loadFileSelector(event)">
                                        </div>
                                    </div>
                                      <label for="upload" class="form-label mt20 ps-4">Profile Image</label>
                                </div>
                            </div>
                            
                            <div class="col-xxl-6 col-xl-6 col-md-6 mt20 mt-md0">
                                <div class="row align-items-center">
                                    <div class="col-xxl-4 col-xl-3 col-md-3">
                                        <div class="profile-img1 profile-text1">
                                

                                            <img src="<?= ($assistant_data->widget_image == '' || $assistant_data->widget_image == "chat/widget.png") ? $assetsBasePath.'chat/widget.png': $this->config->item('bucket_url') . $assistant_data->widget_image ?>" alt="Profile Img" class="img-fluid mx-auto d-block widget_show">
                                            
                                            <!-- Edit Profile Picture -->
                                            <label for="widget_image" class="profile-text1 d-none"><i class="icon-list-edit"></i></label>
                                            <input onchange="loadWidgetFile(event)"  class="form-control d-none" id="widget_image" type="file"  name="widget_image" >
                                        </div>
                                        
                                    </div>
                                     <label for="upload1" class="form-label mt20 ps-4">Widget Image</label>
                                </div>
                            </div>
                            <!-- <div class="col-md-6 col-12">-->
                            <!--     <label for="vaname" class="form-label">Chatbot Name</label>-->
                            <!--     <input type="text" class="form-control search-clr" ng-model="text" id="naname" placeholder="Enter Name">-->
                            <!--</div>-->
                        </div>
                       
                        <div class="row mt20 mt-md30">
                             
                            <div class="col-md-6">
         
                                 <label for="vaname" class="form-label">Chatbot Name</label>
                                 <input type="text" class="form-control search-clr" ng-model="text" id="naname" placeholder="Enter Name">
                                <!--<div class="va-selectpicker" style="height:52px">-->
                                <!--     <label for="vatype" class="form-label">Chatbot Expertise</label>-->
                                <!--     <div class="dropdown bootstrap-select custom-drop dropup ds-select" style="max-height:54px !important">-->
                                <!--         <div class="dropdown bootstrap-select custom-drop" style="max-height:52px !important">-->
                                <!--             <select id="purpose" class="selectpicker custom-drop" ng-model="purpose" data-live-search="true" tabindex="null">-->
                                <!--             <option value="" >Select Expertise</option>-->
                                <!--                 <option value="chat" >Chat</option>-->
                                <!--                 <option value="images">Images</option>-->
                                <!--                 <option value="videos">Videos</option>-->
                                <!--                 <option value="gifs">Gifs</option>-->
                                <!--             </select>-->
                                <!--         </div>-->
                                <!--     </div>-->
                                <!-- </div>-->
                            </div>
                             <div class="col-md-6 mt20 mt-md0">
                                 <div class="va-selectpicker"  style="height:52px">
                                     <label for="vatype" class="form-label">Language</label> 
                                     <div class="dropdown bootstrap-select custom-drop dropup ds-select" style="max-height:54px !important">
                                         <div class="dropdown bootstrap-select custom-drop">
                                             <select name="tts_language" ng-model="languaage" id="tts_language" class="selectpicker custom-drop" data-live-search="true" tabindex="null">
                                              <option value="" >Select</option>
                                              <option value='en'>English</option>
                                              <option value='af'>Afrikaans</option>
                                              <option value='sq'>shqip</option>
                                              <option dir='ltr' value='ar'>العربية</option>
                                              <option value='be'>Беларуская</option>
                                              <option value='bg'>български</option>
                                              <option value='ca'>català</option>
                                              <option value='zh-CN'>中文(简体)</option>
                                              <option value='zh-TW'>中文(繁體)</option>
                                              <option value='hr'>Hrvatska</option>
                                              <option value='cs'>česky</option>
                                              <option value='da'>Dansk</option>
                                              <option value='nl'>Nederlands</option>
                                              <option value='et'>Eesti</option>
                                              <option value='tl'>Filipino</option>
                                              <option value='fi'>suomi</option>
                                              <option value='fr'>Français</option>
                                              <option value='gl'>Galego</option>
                                              <option value='de'>Deutsch</option>
                                              <option value='el'>Ελληνικά</option>
                                              <option dir='ltr' value='iw'>עברית</option>
                                              <option value='hi'>हिन्दी</option>
                                              <option value='hu'>magyar</option>
                                              <option value='is'>Íslenska</option>
                                              <option value='id'>Indonesia</option>
                                              <option value='ga'>Gaeilge</option>
                                              <option value='it'>Italiano</option>
                                              <option value='ja'>日本語</option>
                                              <option value='ko'>한국어</option>
                                              <option value='pt'>Portuguese</option>
                                              <option value='es'>Spanish</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                             </div>
        
                        </div>
                        <div class="row mt20 mt-md30">
                            
                            <div class="col-md-6">
                                 <div class="va-selectpicker">
            
                                     <label for="vaexpertise" class="form-label">Chatbot Theme Color</label>
                                     <div class="search-clr">
                                         <div class="color-picker-html">
                                             <label for="colorPicker">
                                                 <input type="color" ng-model="color" id="colorPicker" ng-change="updateButtonColor()" >
                                                 <!-- <span class="ng-binding">#2dd24e</span></label> -->
                                         </div>
                                     </div>
                                 </div>
                            </div>
                         <!--<div class="col-md-6 mt20 mt-md0">
                             <div class="va-selectpicker">
                                 <label for="vatype" class="form-label">VA Language</label>
                                 <div class="dropdown bootstrap-select custom-drop dropup ds-select">
                                     <div class="dropdown bootstrap-select custom-drop">
                                         <select name="tts_language" ng-model="languaage" id="tts_language" class="selectpicker custom-drop" data-live-search="true" tabindex="null">
                                             <option value="" selected="">Select</option>
                                             <?php foreach ($languages as $key => $lang) { ?>
                                                 <option value="<?= $lang['id'] ?>"><?= $lang['language_name'] ?></option>
                                             <?php }  ?>
                                         </select>
                                     </div>
                                 </div>
                             </div>
                         </div>-->
                         
                         <div class="col-md-6">
                             
                                <div class="accordion" id="accordionExample" style="">
                                    <label for="accordion" class="form-label">Chatbot Background</label>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            
                                            <button class="accordion-button collapsed" type="button" id="collClose" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Select
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-4 col-md-4">
                                                       <a href="javascript:void(0)">
                                                         <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/white-bg1.webp"
                                                           alt="Chat Background" class="mx-auto d-block img-fluid"
                                                           ng-click='updateChatBg("https://cdn.grabiris.com/assets/images/whitebg1.webp")'>
                                                       </a>
                                                    </div>
                                                    <div class="col-4 col-md-4">
                                                        <a href="javascript:void(0)">
                                                           <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg2.png"
                                                           alt="Chat Background" class="mx-auto d-block img-fluid"
                                                           ng-click='updateChatBg("https://cdn.grabiris.com/assets/images/bg2.webp")'>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 col-md-4">
                                                        <a href="">
                                                            <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg3.png"
                                                               alt="Chat Background" class="mx-auto d-block img-fluid"
                                                               ng-click='updateChatBg("https://cdn.grabiris.com/assets/images/bg3.webp")'>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 col-md-4 mt10">
                                                        <a href="">
                                                            <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg4.png"
                                                               alt="Chat Background" class="mx-auto d-block img-fluid"
                                                               ng-click='updateChatBg("https://cdn.grabiris.com/assets/images/bg4.webp")'>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 col-md-4 mt10">
                                                        <a href="">
                                                        <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg5.png"
                                                           alt="Chat Background" class="mx-auto d-block img-fluid"
                                                           ng-click='updateChatBg("https://cdn.grabiris.com/assets/images/bg5.webp")'>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 col-md-4 mt10">
                                                        <div class="bg-upload">
                                                            <label for="formFile" class="base-btn upload-btn show_upload cw-icons"><img src="https://test.grabiris.com/app/assets/images/add.png" alt="Chat Background" class="mx-auto d-block img-fluid"></label>
                                                             <input class="form-control d-none" type="file" id="formFile" name="uploadFiles" placeholder="Edit Profile Picture">
                                                        </div>
                                                        <!-- <a href="#">-->
                                                        <!--    <img src="images/add.png" alt="Chat Background" class="mx-auto d-block img-fluid">-->
                                                        <!--</a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                              
                               
                                </div>
                            </div>
                         
                            
                        </div>
                        
                        <div class="row mt20 mt-md30">
                            <div class="col-md-6">
         
                                <div class="va-selectpicker" style="height:52px">
                                     <label for="vatype" class="form-label">Collect Leads</label>
                                     <div class="dropdown bootstrap-select custom-drop dropup ds-select" style="height:54px">
                                       <div class="dropdown bootstrap-select custom-drop">
                                       <select name="autoresponder" id="autoresponder" class="selectpicker custom-drop responder_list" data-live-search="true" tabindex="null" ng-model="autoresponders"  ng-change="change_auoresponder_option()">
                                                <option value=""  >Select Autoresponder</option>
                                           <?php foreach ($autoresponder as $key => $autores) { ?>
                                                  <option value="<?= $autores['id'] ?>" <?php echo  $assistant_data->autoresponder_id == $autores['id'] ? 'selected' :'' ?>><?= $autores['title'] ?></option>-
                                               <?php }  ?>
                                               <!-- <option ng-repeat="optionsss in autoresponder_options" selected={{(autoresponders == optionsss.id) ? 'selected':''}} value="{{optionsss.id}}">{{optionsss.title}}</option>--->
                                                <!--<option ng-repeat="optionsss in autoresponder_options" ng-selected="optionsss.id == autoresponders " value="{{optionsss.id}}">{{optionsss.title}}</option>-->
                                           </select>
                                       </div>
                                    </div>
                                 </div>
                            </div>
                             <div class="col-md-6 mt20 mt-md0">
                                   <label for="vatype" class="form-label">Select List</label>
                                  <div class="va-selectpicker mt20 mt-md0" style="height:52px">
                                        <div class="dropdown bootstrap-select custom-drop dropup ds-select" style="height:54px">
                                    <select name="select_list" id="select_list" class=" responder_form_list selectpicker custom-drop" data-live-search="true" tabindex="null" ng-model="tones" ng-change="chatSettings()">
                                        <option class="responder_form_option" value="">Select List</option>
                                        <option ng-repeat="list_response in autoresponder_list_response" value="{{list_response.listid}}"> {{list_response.title}}</option>
                                       
                                    </select>
                                </div>
                                    </div>
                             </div>
        
                        </div>

                        <div class="row mt30 mt-md50">
                             <div class="col-md-6 col-xxl-6 col-12">
                                 <input type="submit" value="Save & Get Embed Code" class="base-btn theme-btn-blue" style="width: fit-content;">
                             </div>
                        </div>
                     
                    </div>
                    </form>
                    <div class="col-12 col-md-5 mt20 mt-md35 d-flex justify-content-center">
                        <div class="row">
                                <div class="col-12">
                                    <div class="title-line">Chatbot Preview</div>
                                </div>
                                <div class="col-12 mt20 mt-md20">
                                    <div class="chatbox-va" style=" display: block;" id="myDIV">
                            
                                        <div class="chatbox-header" ng-style="buttonStyle">
                                            <div class="chatbox-text">
                                                <img src="<?= ($assistant_data->assistant_image == '' || $assistant_data->assistant_image == "default/images/grabiris.png") ? $assetsPath.'default/images/grabiris.png': $this->config->item('bucket_url') . $assistant_data->assistant_image  ?>" width="50" class="d-block img-fluid mr15 outputimage"> &nbsp; &nbsp; {{text}}
                                            </div>
                                            <div class="cross-img"><img src="https://i.ibb.co/bHrtxqF/545121.png" width="15" height="15" id="hideClick"></div>
                                        </div>
            
                                        <div class="chat-window">
                                               <div class="message msg-container msg-self msg-box messages"><div><img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available</div></div>
                                               <div class="message msg-container msg-remote msg-box messages"><div><img src="<?= ($assistant_data->assistant_image == '' || $assistant_data->assistant_image == "default/images/grabiris.png") ? $assetsPath.'default/images/grabiris.png': $this->config->item('bucket_url') . $assistant_data->assistant_image  ?>" width="50" class="outputimage">:Hello! How can I assist you today?</div></div>
                                        </div>
            
                                       <div class="chat-input-va ng-pristine ng-valid" onsubmit="return false;">
                                                      <input type="text" autocomplete="on" placeholder="Type a message" id="input">
                                                      <button type="button" ng-style="buttonStyle">
                                                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50; width:22px; height:22px;" xml:space="preserve">
                                                            <style type="text/css">
                                                               .st0 {
                                                                  fill: #ffffff;
                                                               }
                                                            </style>
                                                            <path class="st0" d="M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
                                                l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z">
                                                            </path>
                                             </svg>
                                          </button>
                                       </div>
                                    </div>
                                   <div class="row align-items-center mt20 mt-md30">
                                        <div class="col-md-7 col-9">
                                            <!--<div class=" mt20 mt-md30">-->
                                            <!--     <div class="user-name" style="color:white;">See, How Chatbot look on your Website </div>-->
                                            <!--     <input type="button" ng-disabled="isButtonDisabled" ng-class="isButtonDisabledClass"  ng-click="vaWebsitePreview()" value="Website Preview" class="" style="width: fit-content;">-->
                                            <!--</div>-->
                                        </div>
                                        <div class="col-md-2 col-3">
                                            <img src="<?= ($assistant_data->widget_image == '' || $assistant_data->widget_image == "chat/widget.png") ? $assetsBasePath.'chat/widget.png': $this->config->item('bucket_url') . $assistant_data->widget_image ?>" alt="Profile Img" class="img-fluid mx-auto d-block profile-img1 profile-text1 widget_show" style="width:60px; height:60px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
          
             </div>

             
     </div>
     
     <!-- Modal -->
         <div class="modal fade confirm-del show" id="vaMessageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">VA Script</h1>
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <p id="modalMessage" style="word-break: break-all;"></p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="theme-btn-white" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="theme-btn-blue" ng-click="copyContent()">Copy Text</button>
                 </div>
             </div>
         </div>
     </div>
    






 

     <script>
     var baseUrl = '<?= base_url() ?>';
         var app = angular.module("AppModule", []);
         app.controller("virtualAssitantUpdate", function($scope, $http, $timeout) {

              $scope.updateButtonColor = function() {
                $scope.buttonStyle = { 'background-color': $scope.color };
              };
              
             $scope.white_lable = '<?php echo $white_lable ?>';
             $scope.fileList = '';
             $scope.chatbotFile = '<?php echo $assistant_data->chatbot_background  ?>';
             $scope.id = '<?php echo !empty($assistant_data->id) ? $assistant_data->id :'' ?>';
             $scope.text = '<?php echo !empty($assistant_data->text) ? $assistant_data->text :'' ?>';
             $scope.niche = '<?php echo ($assistant_data->assistant_status == 'custom') ? trim($assistant_data->prompt_cat) : $assistant_data->niche ?>';
             $scope.image = '<?php echo !empty($assistant_data->assistant_image) ? $assistant_data->assistant_image :'' ?>';
             $scope.widget_image = '<?php echo !empty($assistant_data->widget_image) ? $assistant_data->widget_image :'' ?>';
             $scope.languaage = '<?php echo !empty($assistant_data->language_id) ? $assistant_data->language_id :'' ?>';
            //  $scope.purpose = '<?php echo !empty($assistant_data->purpose) ? $assistant_data->purpose :'' ?>';
             $scope.color = '<?php echo !empty($assistant_data->color) ? $assistant_data->color :'' ?>';
             $scope.updateButtonColor();
             $scope.autoresponders = '<?php echo !empty($assistant_data->autoresponder_id) ? $assistant_data->autoresponder_id :'' ?>';
             $scope.select_list = '<?php echo !empty($assistant_data->list_id) ? $assistant_data->list_id :'' ?>';
             $scope.copyContent = async (text) => {
                 try {
                     let text = $('#modalMessage').text();
                     await navigator.clipboard.writeText(text);
                     toastr.info('Content copied to clipboard');
                 } catch (err) {
                     console.error('Failed to copy: ', err);
                 }
             }
            
            const fileSelector = document.getElementById('formFiles');
             fileSelector.addEventListener('change', (event) => {
                 $scope.fileList = event.target.files;
             });

             document.getElementById('formFile').addEventListener('change', (event) => {
                 $('#collClose').trigger('click');
                 $scope.chatbotFile = event.target.files;
                 var imageUrl = URL.createObjectURL($scope.chatbotFile[0]);
                 $scope.setChatBg(imageUrl);
                 $scope.setType = 'custom';
             });
             
            document.getElementById('widget_image').addEventListener('change', (event) => {
                if($scope.white_lable == 'on'){
                     $scope.widget_image = event.target.files;
                }else{
                    window.location.href = "<?php echo base_url('whitelabel'); ?>";
                }
             });

             $scope.vaUpdate = function() {
                //  e.preventDefault();
                 var image = $scope.fileList[0] == undefined ? '' : $scope.fileList[0];
                 var widget_image = $scope.widget_image[0] == undefined ? '' : $scope.widget_image[0];
                 var botimage = $scope.setType == 'custom' ? $scope.chatbotFile[0] : $scope.chatbotFile;
                 var text = $scope.text == undefined ? '' : $scope.text;
                 var type = $scope.setType;
                 var niche = $scope.niche == undefined ? '' : $scope.niche;
                //  var purpose = $scope.purpose == undefined ? '' : $scope.purpose;
                 var color = $scope.color == undefined ? '' : $scope.color;
                 var languaage = $scope.languaage == undefined ? '' : $scope.languaage;
                  var autoresponder = $('#autoresponder').find(":selected").val();
                  var select_list = $('#select_list').find(":selected").val();
                 var fd = new FormData();
                 fd.append('id', $scope.id);
                 fd.append('botimage', botimage);
                 fd.append('image', image);
                 fd.append('widget_image', widget_image);
                 fd.append('type', type);
                 fd.append('text', text);
                 fd.append('niche', niche);
                //  fd.append('purpose', purpose);
                 fd.append('color', color);
                 fd.append('languaage', languaage);
                 fd.append('autoresponder', autoresponder);
                 fd.append('select_list', select_list);
                 $http({
                     method: 'POST',
                     url: baseUrl+'virtual-assistant/update',
                     aync: false,
                     data: fd,
                     dataType: "json",
                     transformRequest: angular.identity,
                     headers: {
                         'Content-Type': undefined
                     }
                 }).then(function(response) {
                     console.log();
                     if (response.data.status == 1) {
                         toastr.success(response.data.msg);
                         $timeout(function() {
                            //  gotoConversationPage('<?= $assistant_data->id ?>');
                             location.reload();
                         }, 500);
                     } else if (response.data.error) {
                         toastr.error(response.data.error.message);
                     } else {
                         toastr.error('Something went wrong');
                     }

                 });

             }
             
          $scope.updateChatBg = function (path) {
               $scope.chatbotFile = path;
               $scope.setType = 'default';
               $scope.setChatBg(path);
             }
             $scope.setChatBg = function (path) {
               document.getElementById("myDIV").style.backgroundImage = "url(" + path + ")";
               document.getElementById("myDIV").style.backgroundPosition = "center center";
               document.getElementById("myDIV").style.backgroundRepeat = "no-repeat";
               document.getElementById("myDIV").style.backgroundSize = "cover";
             }
             
                 $scope.setChatBg("<?php echo $assistant_data->chatbot_background  ?>");
            //  var str1 = "<?php echo $assistant_data->chatbot_background  ?>";
            // var str2 = "<?php echo $this->config->item('bucket_url')  ?>";
            // if(str1.indexOf(str2) != -1){
            // }else{
            //     var url = str2 + str1;
            //      $scope.setChatBg(url);
            // }
             
             
        

         });
         
         
         $(document).ready(function() {

             $(function() {
                 $(document).on("change", "#autoresponder", function() {
                     var autoresponder_ids = $(this).find('option:selected').val()
                     $(".fields").hide();
                     $(".list-box").show();
                     /*   if (isListShow()) {
                            $(".list-box").hide();
                        }*/
                     if (this.value == "") {
                         $(".autoresponders_fields").removeClass("active");
                     } else {
                         $(".autoresponders_fields").addClass("active");
                         $(".field_" + this.value).show();
                     }
                     setResponderFormList(autoresponder_ids);
                     // updateResponderForm();
                 });

                 /*$(document).on("change", ".autoresponders_fields input", function () {
                     updateResponderForm();
                 });
                 $(document).on("change", ".responder_form_list", function () {
                     updateResponderForm();
                 });*/


             });


             function isListShow() {

                 if ($(this).find('option:selected').val() == 15 || $(this).find('option:selected').val() == 17) {
                     return true;
                 } else {
                     return false;
                 }
             }
             
             setResponderFormList(<?= $assistant_data->autoresponder_id ?>);
         
               function setResponderFormList(autoresponder_ids) {
                 $(".list_id").remove();
                 // responderLoader(true);
                   $.ajax({
                     type: 'POST',
                     url: '<?php echo site_url('autoresponder_forms'); ?>',
                     data: {
                         'autoresponder_id': autoresponder_ids
                     },
                     dataType: 'json',
                     success: function(response) {
                         // responderLoader(false);

                         $.each(response, function(index, value) {

                             $(".responder_form_option").after("<option class='list_id' value='" + value.listid + "'  >" + value.title + "</option>");
                         });

                         
                         setTimeout(function() {
                             $('.selectpicker').selectpicker('refresh')
                         }, 500);
                         //$('.selectpicker').selectpicker('refresh');
                        $('#select_list').val('<?= $assistant_data->list_id ?>');   

                         /*  if (setDefault) {
                               setDefault = false;
                               setDefaultAutoresponder();
                           }*/

                     }
                 });
             }
            
        //   setTimeout(function() {
        //      },600);

             function responderLoader(add) {
                 if (add === undefined) {
                     add = false;
                 }
                 $(".temp_js_loader").remove();
                 if (add) {
                     $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $assets_folder; ?>images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;"></div>');
                 }
             }


         });


         function loadimg(ele) {
             var profileimage = ele.files[0];
             var profileType = profileimage["type"];
             var profileallowed = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
             if ($.inArray(profileType, profileallowed) < 0) {
                 showFlash({
                     "error": {
                         "message": 'The filetype you are attempting to upload is not allowed',
                         "type": "flash"
                     }
                 });
             } else {
                 document.getElementById('blah').src = window.URL.createObjectURL(ele.files[0]);
             }
         }

         function remove_image() {
             document.getElementById('blah').src = "<?= $assetsPath ?>images/edit-profile.png";
             $("#formFile").val('');
         }
     </script>