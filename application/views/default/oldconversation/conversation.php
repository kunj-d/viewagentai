<style>
    .receiver-text,
    .sender-text {
        max-width: 50%;
        width: fit-content;
        /*white-space: pre-line;*/
        min-width: 100px;
    }

    .sender-text {
        width: 70%;
    }

    .side-regen-btn {
        position: absolute;
        right: -10px;
        display: block;
        bottom: 5px;
        opacity: 0.5;
    }

    .receiver-msg {
        justify-content: end;
    }

    #loading-chat {
        transition: 0.3s;
    }

    .dot-falling {
        position: relative;
        left: -9987px;
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: var(--primary-color);
        color: var(--primary-color);
        box-shadow: 9999px 0 0 0 var(--primary-color);
        animation: dot-falling 1s infinite linear;
        animation-delay: 0.1s;
    }

    .dot-falling::before,
    .dot-falling::after {
        content: "";
        display: inline-block;
        position: absolute;
        top: 0;
    }

    .dot-falling::before {
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: var(--primary-color);
        color: var(--primary-color);
        animation: dot-falling-before 1s infinite linear;
        animation-delay: 0s;
    }

    .dot-falling::after {
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: var(--primary-color);
        color: var(--primary-color);
        animation: dot-falling-after 1s infinite linear;
        animation-delay: 0.2s;
    }

    @keyframes dot-falling {
        0% {
            box-shadow: 9999px -15px 0 0 rgba(152, 128, 255, 0);
        }

        25%,
        50%,
        75% {
            box-shadow: 9999px 0 0 0 var(--primary-color);
        }

        100% {
            box-shadow: 9999px 15px 0 0 rgba(152, 128, 255, 0);
        }
    }

    @keyframes dot-falling-before {
        0% {
            box-shadow: 9984px -15px 0 0 rgba(152, 128, 255, 0);
        }

        25%,
        50%,
        75% {
            box-shadow: 9984px 0 0 0 var(--primary-color);
        }

        100% {
            box-shadow: 9984px 15px 0 0 rgba(152, 128, 255, 0);
        }
    }

    @keyframes dot-falling-after {
        0% {
            box-shadow: 10014px -15px 0 0 rgba(152, 128, 255, 0);
        }

        25%,
        50%,
        75% {
            box-shadow: 10014px 0 0 0 var(--primary-color);
        }

        100% {
            box-shadow: 10014px 15px 0 0 rgba(152, 128, 255, 0);
        }
    }

    .assistant-img {
        width: 140px;
        height: 130px;
        border-radius: 100%;
        border: 1px solid #374073;
        background: #27215D;
    }

    .library-result {
        height: 250px;
        margin-bottom: 24px;
        position: relative;
    }

    .library-result img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .library-result .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: all 0.8s;
    }

    .library-result .overlay:hover {
        opacity: 1;
    }

    .library-result .overlay a {
        width: 40px;
        height: 40px;
        background: var(--theme-bg);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
        border-radius: 5px;
        /* opacity: 1; */
        color: var(--grey-color);
        font-size: 18px;
    }

    .library-result .overlay a:hover {
        background: var(--theme-br2);
        color: var(--white-color);
    }

    .library-result .overlay a:last-child {
        margin-right: 0;
    }

    .right-btn {
        position: absolute;
        right: 0px;
        background: var(--blue-gradient1);
        border: 0px;
        color: var(--theme-color);
        z-index: 9999;
    }

    .right-btn:hover {
        color: var(--theme-color) !important;
    }

    .right-sidebar {
        position: fixed;
        right: -100%;
        transition: 0.5s;
        top: 60px;
        z-index: 999;
        max-width: 350px;
        background: var(--theme-bg2);
        border-radius: 10px;
    }

    .right-sidebar.slideOn {
        right: 0;
    }

    .sidebar-btn a {
        position: absolute !important;
        top: -20px !important;
        right: 55px !important;
    }

    .sidebar-btn a {
        padding: 8px 30px 9px;
    }

    .sidebar-btn .theme-btn-blue {
        border-radius: 5px;
    }

    .chat-bot-close {
        position: relative;
        color: #fff;
        top: 55px;
        left: 49%;
    }


    .chatBG-header:focus {
        position: absolute !important;
        top: 88px !important;
    }

    /*.chatBG-item.dropbg .chatBG-header:focus {*/
    /*     transform: scale(3); */
    /*     opacity: 0; */
    /*     z-index: -1; */
    /*}*/
    div#accordionExample {
        width: 300px;
    }

    a.dark-bg.ng-binding.ng-scope:focus {
        background: var(--theme-color2) !important;
    }

    .text-generater a:hover {
        transform: scale(1.01);
    }

    .chat-superva .regenerator-text.showOn {
        display: block;
        width: 120px;
        margin-top: 0;
        left: 90px;
        height: 145px;
    }

    .chat-superva.regenerator-text {
        border-radius: 10px 10px 0px 0px;
        border: 1px solid #374073;
        border-bottom: 0px solid #374073;
        background: #27215D;
        padding: 10px;
        display: none;
        position: absolute;
        bottom: 100%;
        left: 10.2%;
        /* transform: translateX(-50%); */
        margin-top: 100px;
        transition: all 0.5s;
    }

    .left-tg-border .title-line {
        background: var(--theme-color2);
        border-radius: 10px;
        padding: 5px;
    }

    .prompt .title-line {
        background: var(--theme-color2);
        border-radius: 10px;
        padding: 5px;
    }

    .icon-list-edit1 {
        font-size: 20px;
        background: #fff;
        border: 1px solid var(--blue-gradient);
        padding: 5px;
        color: var(--blue-gradient);
    }

    .mic-off {
        content: url(app/assets/images/mic.png);
        width: 24px;
        height: 24px;
        display: inline-block;
        cursor: pointer;
    }

    .mic-on {
        content: url(app/assets/images/microphone1.gif);
        width: 24px;
        height: 24px;
    }


    .chat-main-container {
        min-width: 800px;
        min-height: 85vh;
        max-height: 84vh;
        display: flex;
        overflow: hidden;
        box-sizing: border-box;
        width: 100vw;
        height: auto;
        position: relative;
        word-wrap: break-word;
        background-clip: border-box;
        /*margin-bottom: 1.5rem;*/
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-radius: 8px;
        padding-left: 0;
        padding-right: 0;
        border: 1px solid var(--theme-br);
    }

    .chat-main-container #expand {
        display: none;
    }

    .chat-main-container .chat-sidebar-container {
        top: 0;
        width: 240px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        border-right: 1px solid var(--theme-br);
        position: relative;
        transition: width 0.05s ease;
    }

    .chat-sidebar-search {
        border-bottom: 1px solid var(--theme-br) !important;
    }

    .chat-sidebar-search {
        max-height: 79px;
        min-height: 79px;
        font-size: 16px;
        margin: 0;
        padding: 15px 20px;
        color: var(--grey-color);
        display: flex;
        align-items: center;
        position: relative;
        /*min-height: 3.5rem;*/
        border-bottom: 1px solid var(--theme-br);
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages {
        flex: 1 1;
        overflow: auto;
        overflow-x: hidden;
        padding: 20px;
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message {
        padding: 10px 14px;
        background-color: var(--theme-bg2);
        border-radius: 5px;
        margin-bottom: 10px;
        border: 1px solid var(--theme-br);
        transition: background-color 0.3s ease;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        position: relative;
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .selected-message {
        border: 1px solid var(--primary-color);
        background-color: var(--theme-bg2);
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-title {
        font-size: 14px;
        font-weight: 600;
        display: block;
        width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .selected-message .chat-title {
        color: #007BFF;
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-info {
        color: var(--grey-color);
        font-size: 12px;
        margin-top: 8px;
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-actions {
        position: absolute;
        top: 25px;
        right: -20px;
        transition: all 0.3s ease;
        opacity: 0;
        cursor: pointer;
        z-index: 100;
        top: 50% !important;
        transform: translateY(-50%);
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-actions a {
        color: var(--grey-color);
        font-size: 16px;
        width: 25px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--theme-br);
        border-radius: 3px;
        background: var(--theme-bg2);
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-actions a:hover {
        color: var(--theme-br2);
        font-size: 16px;
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover,
    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus {

        background: var(--theme-bg);
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover .chat-actions,
    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus .chat-actions {
        opacity: 1;
        right: 10px;
    }

    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover .chat-actions:hover,
    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover .chat-actions:focus,
    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus .chat-actions:hover,
    .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus .chat-actions:focus {
        opacity: 1;

    }

    .chat-main-container .card-footer {
        border-top: 1px solid var(--theme-br) !important;
        min-height: 75px !important;
    }

    .chat-main-container .chat-message-container {
        width: calc(100% - 240px);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .chat-avatar {
        border-radius: 50%;
        height: 44px;
        width: 44px;
        clear: both;
        display: block;
        position: relative;
    }

    #chat-system {
        min-height: 400px;
        font-size: 13px;
    }

    .card-header {
        background: transparent;
        padding: 11px 1.5rem;
        display: flex;
        min-height: 79px;
        max-height: 79px;
        /*min-height: 3.5rem;*/
        align-items: center;
        margin-bottom: 0;
        border-bottom: 1px solid var(--theme-br);
        position: relative;
    }

    .card-header:first-child {
        border-radius: 2px 2px 0 0;
    }

    .card-header:before {
        content: "";
        position: absolute;
        left: 0px;
        padding: 3px;
        border-radius: 0 50px 50px 0;
        height: 20px;
    }

    .text-muted {
        color: var(--grey-color) !important;
    }

    .table-action-buttons {
        background: var(--theme-bg);
        border: none;
        border-radius: 5px;
        color: var(--grey-color);
        width: 40px;
        height: 40px;
        text-align: center;
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, -webkit-text-decoration-color;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 0.15s;
        padding: 12px;
    }

    .table-action-buttons-big {
        /*line-height: 2.4 !important;*/
        font-size: 18px !important;
        width: 40px !important;
        height: 40px !important;
    }

    .side-regen-btn i {
        font-size: 14px !important;
    }

    .view-action-button,
    .delete-action-button,
    .edit-action-button {
        transition: all 0.3s;
    }

    .openPromt .modal-content {
        max-height: 90vh;
        overflow: auto;
        ;
    }

    @media (max-width: 767px) {
        .send-box {
            margin-top: 15px;
        }

        .chat-main-container {
            min-width: 100%;
            min-height: 91vh;
            max-height: 91vh;
            width: 100vw;
            height: auto;
        }

        .chat-main-container .chat-message-container {
            min-width: 100%;
            position: relative;
            left: -265px;
        }

        .chat-sidebar-search {
            padding: 7px 20px;
        }

        .chat-sidebar-container {
            left: -271px;
            transition: 0.5s;
        }

        .chat-sidebar-container.slideOn {
            left: 0px;
            background: var(--theme-bg);
            z-index: 1;
        }

        .card-header {
            display: block;
            /*min-height: block;*/
            align-items: center;
            min-height: 8rem;
        }

        .card-header a {
            display: inline-block;
        }

        .chatbox-area {
            padding: 0;
            height: calc(100vh - 22rem);
        }

        .sender-img {
            width: 25px;
        }

        .receiver-img {
            width: 25px;
        }

        .chatbox-sendbox {
            padding: 10px 0;
        }

        .send-btn {
            max-width: 40px;
            max-height: 40px;
            font-size: 18px;
            padding: 10px;
        }

        .chat-superva .regenerator-text.showOn {
            bottom: 120px;
            left: 75px;
        }
    }

    .view-action-button:hover,
    .delete-action-button:hover,
    .edit-action-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(29, 39, 59, 0.15);
    }

    .edit-action-button:hover,
    .edit-action-button:focus {
        background: var(--primary-color) !important;
        color: var(--white-color);
    }

    textarea {
        overflow: auto;
        /* This allows scrolling */
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    textarea::-webkit-scrollbar {
        display: none;
        /* WebKit browsers */
    }
</style>
<!-- Container Start -->

<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="conversationCtrl" ng-cloak>
    <title><?php echo $this->config->item('productName') ?> | Conversation</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-box2  chat-main-container">
                    <?php if ($assistantData->assistant_status != "super_va") { ?>
                        <div class="chat-sidebar-container">
                            <div class="chat-sidebar-search">
                                <div class="search-bar ">
                                    <div class="search-icon" style="cursor:pointer;">
                                        <span class="icon-search"></span>
                                    </div>
                                    <input type="text" class="search form-control" placeholder="Search.."
                                        ng-model="chatSearch">

                                </div>
                            </div>
                            <div class="chat-sidebar-messages">
                                <div class="chat-sidebar-message" ng-class="{ 'selected-message': isSelected(list.id) }"
                                    ng-repeat="list in chatlist | filter: chatSearch" ng-click="getConversation(list.id)">
                                    <h6 class="chat-title">
                                        <i class="fa-solid fa-comment-dots me-1"></i>
                                        {{ list.chat_name }}
                                    </h6>
                                    <div class="chat-info">
                                        <div class="chat-date">{{ formatDate(list.created_at) }}</div>
                                    </div>
                                    <div class="chat-actions d-flex gap-1">
                                        <a href="javascript:void(0)" ng-click="editChat(list.id,list.chat_name)"
                                            class="chat-edit f-16" data-toggle="tooltip" data-placement="top"
                                            title="Edit Name"><span class="icon-list-edit"></span></a>
                                        <a href="javascript:void(0)" ng-click="deleleChatModal(list.id);"
                                            class="chat-delete f-16" title="Delete Chat"><span
                                                class="icon-list-delete"></span></a>
                                    </div>
                                </div>
                                <!-- Chat Delete modal -->
                                <div class="modal fade" id="chat_deletion" tabindex="-1" aria-labelledby="chat_deletion"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <i class="fa-solid fa-circle-exclamation text-danger mb-3"
                                                    style="font-size : 50px"></i>
                                                <p class="title-line">Confirm Chat Delete</p>
                                                <p class="mb-0">It will permanently delete this chat history</p>
                                            </div>
                                            <div class="modal-footer justify-content-center border-0 pt-0">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" ng-click="deleleChat()"
                                                    class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Chat Delete modal -->
                            </div>
                            <div class="card-footer">
                                <div class="row text-center">
                                    <div class="col-sm-12">
                                        <a class="btn btn-primary pl-6 pr-6 f-14 mt-2" ng-click="newConversation()"><i
                                                class="fa-solid fa-plus"></i> New Conversation</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="chat-message-container"
                        style='<?php echo $assistantData->assistant_status == "super_va" ? "width: 100%;" : ""; ?><?php echo $assistantData->assistant_status == "super_va" ? "left: unset;" : ""; ?>'>
                        <div class="card-header">
                            <div class="w-100 pt-2 pb-2">
                                <div class="d-flex align-items-center">
                                    <div class="overflow-hidden me-2"><img alt="Avatar" class="chat-avatar"
                                            src="<?= ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? $assetsPath . 'default/images/default_profile.png' : $this->config->item('bucket_url') . $this->session->userdata('logged_in')['profile_pic'] ?>">
                                    </div>
                                    <div class="widget-user-name"><span
                                            class="w700"><?php echo !empty($this->session->userdata('logged_in')['name']) ? $this->session->userdata('logged_in')['name'] : John ?></span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 w-md-50 text-end pt-2 pb-2 inl">

                                <?php if ($assistantData->purpose == 'chat') { ?>
                                    <a class="template-button me-2" ng-href="{{ wordUrl }}" data-toggle="tooltip"
                                        data-placement="top" title="Export Chat Conversation as Word File"><i
                                            class="fa-solid fa-file-word table-action-buttons table-action-buttons-big edit-action-button"></i></a>
                                    <a class="template-button me-2" href="{{ pdfUrl}}" data-toggle="tooltip"
                                        data-placement="top" title="Export Chat Conversation as PDF File"><i
                                            class="fa-solid fa-file-pdf table-action-buttons table-action-buttons-big edit-action-button"></i></a>
                                    <a class="template-button me-2" href="{{ textUrl}}" data-toggle="tooltip"
                                        data-placement="top" title="Export Chat Conversation Text File"><i
                                            class="fa-solid fa-file-lines table-action-buttons table-action-buttons-big edit-action-button"></i></a>
                                <?php } ?>
                                <a id=""
                                    class="template-button me-2 chat-sidebar-container-btn d-inline-block d-md-none"
                                    href="#"><i
                                        class="fa-solid fa-bars-staggered table-action-buttons table-action-buttons-big edit-action-button "></i></a>

                            </div>
                        </div>
                        <div class="chatbox" id="myDIV">
                            <div class="chatbox-area" id="messageBody">
                                <span ng-repeat="chat in chating">
                                    <div class="receiver-msg mt20" ng-if='chat.human'>
                                        <div class="receiver-text" data-conversation_id={{chat.id}}
                                            data-type="{{chat.type}}">
                                            {{chat.human}}
                                        </div>
                                        <div class="">
                                            <img src="<?= ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? $assetsPath . 'default/images/default_profile.png' : $this->config->item('bucket_url') . $this->session->userdata('logged_in')['profile_pic'] ?>"
                                                alt="receiver" class="img-fluid d-block receiver-img" width="60"
                                                style="border-radius:50%">
                                        </div>
                                    </div>
                                    <div class="sender-msg mt20" ng-if='chat.ai'>
                                        <div class="">
                                            <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/Ai-Employee-Favicon.png"
                                                alt="Sender" class="img-fluid d-block sender-img"
                                                style="border-radius:50%; width: 50px; height:50px;">

                                        </div>
                                        <div ng-if="chat.type=='chatgpt'" class="sender-text"
                                            id="copyContent{{chat.id}}">
                                            <!-- <p style="white-space: pre;">{{chat.ai}}</p> -->
                                            {{chat.ai}}
                                            <div class="btn-group dropstart dash-drop">
                                                <button type="button" class="btn  dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <!--<span class="icon-option"></span>-->
                                                </button>
                                                <!--<ul class="dropdown-menu" style="white-space: nowrap;">-->
                                                <!--   <li ng-click="copyContent(chat.ai)" style="cursor: pointer;"><span-->
                                                <!--      class="icon-copy"></span> Copy</li>-->
                                                <!--   <a href="javascript:void(0)" data-bs-toggle="modal"-->
                                                <!--      data-bs-target="#saveConversationAssets" ng-click="saveToGallery('chat',chat.id)">-->
                                                <!--      <li><span class="icon-my-drive"></span> Save to Work Done</li>-->
                                                <!--   </a>-->
                                                <!--   <li data-id="{{chat.id}}" class="pdfDownload" style="cursor: pointer;"><span-->
                                                <!--      class="icon-library-download"></span> Download</li>-->
                                                <!--</ul>-->
                                            </div>
                                            <a href="" class=" side-regen-btn me-2" title="Regenrate Response"
                                                ng-click=regenerateConversation()><i class="icon-refresh"></i></a>
                                            <a href="" class=" side-regen-btn side-regen-btn-2 me-2"
                                                title="Copy Response"
                                                ng-click="copyconversation('copyContent' + chat.id )"><i
                                                    class="fa-solid fa-copy"></i></a>
                                        </div>
                                        <div class="sender-text" ng-if="chat.type !='chatgpt'">
                                            <div
                                                class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 gallery">
                                                <div class="col" ng-repeat="(key, image) in chat.ai">
                                                    <div class="library-result" ng-show="image.file_type =='image'">
                                                        <div class="overlay">
                                                            <a title="select">
                                                                <span
                                                                    class="carouselGallery-col-1 carouselGallery-carousel"
                                                                    data-index="{{key}}"
                                                                    data-imagetext="<div class='img-preview'><div class='d-flex gap-20 align-items-center '>Attachment Detail </div><span class='icons icon-cross iconscircle-cross'></span></div>"
                                                                    data-imagepath="{{ image.largeImageURL }}">
                                                                    <i class="fa-solid fa-eye"></i></span></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="saveToGallery(key,image)" title="Add"><i
                                                                    class="fa-solid fa-bookmark"></i></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="downloadFile(image.largeImageURL,'png')"
                                                                title="Download"><i
                                                                    class="fa-solid fa-download"></i></a>
                                                        </div>
                                                        <img src="{{ image.largeImageURL }}" alt="Image"
                                                            class="img-fluid d-block mx-auto">
                                                    </div>
                                                    <div class="library-result" ng-show="image.file_type =='gifs'">
                                                        <div class="overlay">
                                                            <a href="#" title="select">
                                                                <span
                                                                    class="carouselGallery-col-1 carouselGallery-carousel"
                                                                    data-index="{{key}}"
                                                                    data-imagetext="<div class='img-preview'><div class='d-flex gap-20 align-items-center '>Attachment Detail</div><span class='icons icon-cross iconscircle-cross'></span></div>"
                                                                    data-imagepath="{{ image.largeImageURL }}">
                                                                    <i class="fa-solid fa-eye"></i></span></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="saveToGallery(key,image)" title="Add"><i
                                                                    class="fa-solid fa-bookmark"></i></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="downloadFile(image.largeImageURL,'gif')"
                                                                title="Download"><i
                                                                    class="fa-solid fa-download"></i></a>
                                                        </div>
                                                        <img src="{{ image.largeImageURL }}" alt="Gifs"
                                                            class="img-fluid d-block mx-auto">
                                                    </div>
                                                    <div class="library-result" ng-show="image.file_type =='stickers'">
                                                        <div class="overlay">
                                                            <a href="#" title="select">
                                                                <span
                                                                    class="carouselGallery-col-1 carouselGallery-carousel"
                                                                    data-index="{{$index}}"
                                                                    data-imagetext="<div class='img-preview'><div class='d-flex gap-20 align-items-center '>Attachment Detail</div><span class='icons icon-cross iconscircle-cross'></span></div>"
                                                                    data-imagepath="{{ image.largeImageURL }}">
                                                                    <i class="fa-solid fa-eye"></i></span></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="saveToGallery(key,image)" title="Add"><i
                                                                    class="fa-solid fa-bookmark"></i></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="downloadFile(image.largeImageURL,'gif')"
                                                                title="Download"><i
                                                                    class="fa-solid fa-download"></i></a>
                                                        </div>
                                                        <img src="{{ image.largeImageURL }}" alt="Stickers"
                                                            class="img-fluid d-block mx-auto">
                                                    </div>
                                                    <div class="library-result" ng-show="image.file_type =='video'">
                                                        <div class="overlay">
                                                            <a ng-click="playVideo(image.small_video);" title="select">
                                                                <span
                                                                    class="carouselGallery-col-1 carouselGallery-carousel">
                                                                    <i class="fa-solid fa-eye"></i></span></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="saveToGallery(key,image)" title="Add"><i
                                                                    class="fa-solid fa-bookmark"></i></a>
                                                            <a href="javascript:void(0)"
                                                                ng-click="downloadFile(image.small_video,'mp4')"
                                                                title="Download"><i
                                                                    class="fa-solid fa-download"></i></a>
                                                        </div>
                                                        <img src="{{ image.largeImageURL }}" style="height:200px;"
                                                            alt="Video" class="img-fluid d-block mx-auto">
                                                    </div>
                                                </div>
                                            </div>



                                        </div>


                                    </div>
                                </span>
                                <span>
                                    <div class="sender-msg mt20 loading-chat" style="display: none" id="#loading-chat">
                                        <div class="">
                                            <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/Ai-Employee-Favicon.png"
                                                alt="Sender" class="img-fluid d-block sender-img"
                                                style="border-radius:50%; width: 50px; height:50px;">
                                        </div>
                                        <div class="sender-text pb-0 ">
                                            <div class="">
                                                <div class="snippet" data-title="dot-falling" style="line-height: 0">
                                                    <div class="stage">
                                                        <div class="dot-falling"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <!--<div id="stockImagesresult" class="container mt-3"> </div>-->
                                <!--//// stock image show-->
                                <div class="row" id="images-section" ng-cloak ng-show="imagesList.length > 0">
                                    <div class="col-12 mt20">
                                        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 gallery">
                                            <div class="col" ng-repeat="(key, image) in imagesList">
                                                <div class="library-result" ng-show="image.file_type =='image'">
                                                    <div class="overlay">
                                                        <a title="select">
                                                            <span class="carouselGallery-col-1 carouselGallery-carousel"
                                                                data-index="{{key}}"
                                                                data-imagetext="<div class='img-preview'><div class='d-flex gap-20 align-items-center '>Attachment Detail</div><span class='icons icon-cross iconscircle-cross'></span></div>"
                                                                data-imagepath="{{ image.largeImageURL }}">
                                                                <i class="fa-solid fa-eye"></i></span></a>
                                                        <a href="javascript:void(0)" ng-click="saveToGallery(key,image)"
                                                            title="Add"><i class="fa-solid fa-bookmark"></i></a>
                                                        <a href="javascript:void(0)"
                                                            ng-click="downloadFile(image.largeImageURL,'png')"
                                                            title="Download"><i class="fa-solid fa-download"></i></a>
                                                    </div>
                                                    <img src="{{ image.largeImageURL }}" alt="Image"
                                                        class="img-fluid d-block mx-auto">
                                                </div>
                                                <div class="library-result" ng-show="image.file_type =='gifs'">
                                                    <div class="overlay">
                                                        <a href="#" title="select">
                                                            <span class="carouselGallery-col-1 carouselGallery-carousel"
                                                                data-index="{{key}}"
                                                                data-imagetext="<div class='img-preview'><div class='d-flex gap-20 align-items-center '>Attachment Detail</div><span class='icons icon-cross iconscircle-cross'></span></div>"
                                                                data-imagepath="{{ image.largeImageURL }}">
                                                                <i class="fa-solid fa-eye"></i></span></a>
                                                        <a href="javascript:void(0)" ng-click="saveToGallery(key,image)"
                                                            title="Add"><i class="fa-solid fa-bookmark"></i></a>
                                                        <a href="javascript:void(0)"
                                                            ng-click="downloadFile(image.largeImageURL,'gif')"
                                                            title="Download"><i class="fa-solid fa-download"></i></a>
                                                    </div>
                                                    <img src="{{ image.largeImageURL }}" alt="Gifs"
                                                        class="img-fluid d-block mx-auto">
                                                </div>
                                                <div class="library-result" ng-show="image.file_type =='stickers'">
                                                    <div class="overlay">
                                                        <a href="#" title="select">
                                                            <span class="carouselGallery-col-1 carouselGallery-carousel"
                                                                data-index="{{$index}}"
                                                                data-imagetext="<div class='img-preview'><div class='d-flex gap-20 align-items-center '>Attachment Detail</div><span class='icons icon-cross iconscircle-cross'></span></div>"
                                                                data-imagepath="{{ image.largeImageURL }}">
                                                                <i class="fa-solid fa-eye"></i></span></a>
                                                        <a href="javascript:void(0)" ng-click="saveToGallery(key,image)"
                                                            title="Add"><i class="fa-solid fa-bookmark"></i></a>
                                                        <a href="javascript:void(0)"
                                                            ng-click="downloadFile(image.largeImageURL,'gif')"
                                                            title="Download"><i class="fa-solid fa-download"></i></a>
                                                    </div>
                                                    <img src="{{ image.largeImageURL }}" alt="Stickers"
                                                        class="img-fluid d-block mx-auto">
                                                </div>
                                                <div class="library-result" ng-show="image.file_type =='video'">
                                                    <div class="overlay">
                                                        <a ng-click="playVideo(image.small_video);" title="select">
                                                            <span
                                                                class="carouselGallery-col-1 carouselGallery-carousel">
                                                                <i class="fa-solid fa-eye"></i></span></a>
                                                        <a href="javascript:void(0)" ng-click="saveToGallery(key,image)"
                                                            title="Add"><i class="fa-solid fa-bookmark"></i></a>
                                                        <a href="javascript:void(0)"
                                                            ng-click="downloadFile(image.small_video,'mp4')"
                                                            title="Download"><i class="fa-solid fa-download"></i></a>
                                                    </div>
                                                    <img src="{{ image.largeImageURL }}" style="height:200px;"
                                                        alt="Video" class="img-fluid d-block mx-auto">
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="row mt20">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <a href="javascript:void(0)" ng-click="loadMore()"
                                                    class="base-btn blue-btn-outline">Load More....</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-center" ng-if="show_div== true"> No Record Found</div>
                                <!--/// close-->
                            </div>
                            <div class="chatbox-sendbox">
                                <!--<div class="regenerate-box  d-flex align-items-center justify-content-end">-->

                                <!--</div>-->

                                <!-- <div class="chat-prompt chat-superva">
                                    <div class="mt20 regenerator-text" id="generated-text">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-generater" style="cursor:pointer">
                                                    <a ng-click="setSuperVapurpose('chat')"  >Chat</a>
                                                    <a ng-click="setSuperVapurpose('images')">Images</a>
                                                    <a ng-click="setSuperVapurpose('videos')">Videos</a>
                                                    <a ng-click="setSuperVapurpose('gifs')"  >Gifs</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> -->


                                <div class=" d-flex"
                                    style="<?php echo $assistantData->assistant_status == 'super_vachat' ? 'padding:20px 0px' : '' ?>">

                                    <?php if ($assistantData->purpose != 'chat') { ?>
                                        <!-- <a href="javascript:void(0);" class="use-link" id="<?php echo $assistantData->purpose != 'chat'
                                            ? 'use-promo' : '' ?>">
                                        <div class="use-promt text-uppercase">
                                            {{vaPurpose}}
                                         </div>
                                    </a> -->
                                    <?php } ?>
                                    <div
                                        class="flex-xs-column d-md-flex align-items-center justify-content-between w100 bussiness-box">
                                        <div class="send-msg chatbox-input">
                                            <!--<img src="<?= $assetsPath ?>images/mic.gif" id="listing"  style="display: none;" />-->
                                            <p id="listing" style="display: none;">Listening...</p>
                                            <textarea class="dash-input form-control" id="inputText"
                                                placeholder="Type here..." ng-model="chat"></textarea>
                                        </div>
                                        <div class="send-box d-flex send-box align-items-center">
                                            <?php  //if($assistantData->purpose == 'chat'){ ?>

                                            <a class="template-button me-2" href="#" data-bs-toggle="modal"
                                                data-bs-target="#openPromt" data-toggle="tooltip" data-placement="top"
                                                title="Prompt Library"><i
                                                    class="fa-solid fa-book table-action-buttons table-action-buttons-big edit-action-button"></i></a>
                                            <?php //} ?>
                                            <!--<a class="template-button" href="#" id="myImage"><span id="mic"
                                                    class="mic-off mr10 table-action-buttons table-action-buttons-big edit-action-button"></span></a>-->
                                            <!-- <a href="" class="template-button me-2" ng-click=regenerateConversation()><i class="icon-refresh table-action-buttons table-action-buttons-big edit-action-button"></i></a> -->
                                            <!--<a href="" id="micOn"><i class="icon-mic mr10 mr-md30"-->
                                            <!--   style="font-size: 21px;"></i></a>-->
                                            <!--<img onclick="changeImage" id ="myImage"  src="<?= $this->config->item('assetsBasePath') ?>assets/images/mic.png" class="mr10">-->

                                            <a href="" class="send-btn" ng-click="addMessage()"><span
                                                    class="d-none d-md-inline-block">Send </span> <i
                                                    class="fa-solid fa-paper-plane ms-md-1"></i></a>
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



    <!--Start Rename Chat Modal-->

    <!-- <div class="modal new-folder-modal fade" id="renameChat" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <form ng-submit="updateTitle()">
                <div class="modal-body p-15 p-md30">
                    <h5 class="fw-normal">Rename Your Chat</h5>
                    <div class="form-group d-gblue-clr f-14 mb0">
                        <label for="exampleSelect1">Chat Name</label>
                        <input type="text" ng-model="update_chatname"
                        maxlength="50" class="form-control field-h40 f-14" placeholder="Chat Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div> -->
    <div class="modal new-folder-modal fade" id="renameChat" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0 align-items-start">
                    <div>
                        <h5 class="modal-title fw-semibold">Rename Your Chat</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form ng-submit="updateTitle()">
                    <div class="modal-body p-15 p-md30">
                        <div class="form-group d-gblue-clr f-14 mb0">
                            <label for="exampleSelect1">Chat Name</label>
                            <input type="text" ng-model="update_chatname" maxlength="15"
                                class="form-control field-h40 f-14" placeholder="Chat Name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline btn-outline-white"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--End Rename Chat Modal-->








    <div class="modal fade" id="StockVideosPopup" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modelw-450">
            <div class="modal-content delete-model">
                <div class="modal-body text-center">
                    <div class="mt10 description" id="divVideo">
                        <video>
                            <source
                                src="https://player.vimeo.com/external/180289892.hd.mp4?s=eb15830073fb988b59fc25009bf30349d2d9eed5&profile_id=119"
                                type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="mt30">
                        <button type="button" class="base-btn secondary-btn1 mr10"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Conversation Modal -->
    <div class="modal fade confirm-del" id="saveConversationAssets" tabindex="-1"
        aria-labelledby="saveConversationAssetsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveConversationAssetsLabel">Save to My Assets</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ">
                        <!--<div class="col-12 assets-container">-->
                        <!--   <ul class="nav nav-pills mb-3 integration-pills" id="tab1" role="tablist">-->
                        <!--      <li class="nav-item" role="presentation">-->
                        <!--         <button class="nav-link active" id="tab1" data-bs-toggle="pill"-->
                        <!--            data-bs-target="#pills-home" type="button" role="tab"-->
                        <!--            aria-controls="pills-home" aria-selected="true">Conversation</button>-->
                        <!--      </li>-->
                        <!--   </ul>-->
                        <!--</div>-->
                        <div class="">
                            <div class="tab-content" id="pills-tabContent">
                                <!-- ---tab-pane---conversation Start -->
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="row align-items-center row-gap">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="search-bar">
                                                <input type="text" class="search form-control" placeholder="Search.."
                                                    ng-model="filterfolder">
                                                <div class="search-icon">
                                                    <span class="icon-search"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6 text-md-end">
                                            <div class="create-btn">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#new-folder" ng-if="data.level == 0">
                                                    <span class="icon-create-new-campaign"
                                                        style="font-size:18px;"></span>
                                                    New Folder
                                                </a>
                                                <a href="#" class="" style="font-size: 16px;" ng-if="data.level == 1"
                                                    ng-click="load_folders()">
                                                    &lt;--
                                                    Back
                                                </a>
                                                <a href="#" class="" style="font-size: 16px;" ng-if="data.level == 1"
                                                    ng-click="saveAssets()">
                                                    Save
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-4 mt20 mt-md0">
                                        <div class="col mt20 mt-md30"
                                            ng-repeat="(key, val) in data.records | filter:filterfolder">
                                            <div class="folder-wall" ng-if="val.file_type == '5'">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu ">
                                                        <li><a href="#" ng-click="initialize_rename(val)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href="" ng-click="initialize_delete(val)"><span
                                                                    class="icon-list-delete"></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="javascript:void(0)"
                                                        ng-click="select_folder(val.library_object_id, val.title)">
                                                        <img src="<?= $this->config->item('assetsPath') ?>images/folder-img.png"
                                                            class="mx-auto d-block img-fluid" style="max-height:85%">
                                                    </a>
                                                </div>
                                                <div class=" appoint-title text-center">
                                                    {{ val.file_name }}
                                                </div>
                                            </div>
                                            <!--for image view-->
                                            <div class="folder-wall" ng-if="val.file_type == '1' ">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu ">
                                                        <li><a href="#" ng-click="initialize_rename(val)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href=""
                                                                ng-click="downloadFile(val.file,val.file_extension)"><span
                                                                    class="icon-library-download"></span> Download</a>
                                                        </li>
                                                        <li><a href="" ng-click="initialize_delete(val)"><span
                                                                    class="icon-list-delete"></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="#">
                                                        <img src="{{val.file}}" class="mx-auto d-block"
                                                            style="width: 125px !important; max-width: 100%; height: 125px;">
                                                    </a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    {{ val.file_name }}
                                                </div>
                                            </div>
                                            <div class="folder-wall" ng-if="val.file_type == '2' ">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu ">
                                                        <li><a href="#" ng-click="initialize_rename(val)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href=""
                                                                ng-click="downloadFile(val.file,val.file_extension)"><span
                                                                    class="icon-library-download"></span> Download</a>
                                                        </li>
                                                        <li><a href="" ng-click="initialize_delete(val)"><span
                                                                    class="icon-list-delete"></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">

                                                    <a href="#">
                                                        <video style="width:100%;" controls>
                                                            <source ng-src="{{val.file | trustUrl}}" />

                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    {{ val.file_name }}
                                                </div>
                                            </div>
                                            <div class="folder-wall" ng-if="val.file_type == '3' ">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu ">
                                                        <li><a href="#" ng-click="initialize_rename(val)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href="" data-id="{{val.file}}" class="pdfDownload"><span
                                                                    class="icon-library-download"></span> Download</a>
                                                        </li>
                                                        <li><a href="" ng-click="initialize_delete(val)"><span
                                                                    class="icon-list-delete"></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="#">
                                                        <img src="<?= $assetsPath ?>images/pdf.png"
                                                            class="mx-auto d-block img-fluid"
                                                            style="width: 125px !important;">
                                                    </a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    {{ val.file_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ---tab-pane---conversation End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Start Image Modal -->

    <div class="modal fade confirm-del" id="saveImageAssets" tabindex="-1" aria-labelledby="saveImageAssetsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveImageAssetsLabel">Save to Assets</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-12 assets-container">
                            <ul class="nav nav-pills mb-3 integration-pills" id="tab1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-images" type="button" role="tab"
                                        aria-controls="pills-images" aria-selected="true">Images</button>
                                </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="tab-content" id="pills-tabContent">
                                <!-- ---tab-pane---image Start -->
                                <div class="tab-pane fade show active" id="pills-images" role="tabpanel"
                                    aria-labelledby="pills-images-tab">
                                    <div class="row mt20  align-items-center">
                                        <div class="col-6 col-md-4  ">
                                            <div class="search-bar">
                                                <input type="text" class="search form-control" placeholder="Search..">
                                                <div class="search-icon">
                                                    <span class="icon-search"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 offset-md-4 col-xl-5 offset-xl-3 text-md-end">
                                            <div class="create-btn">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#new-folder">
                                                    <span class="icon-create-new-campaign"
                                                        style="font-size:18px;"></span>
                                                    Create New Folder
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-4 mt20 mt-md30">
                                        <div class="col">
                                            <div class="folder-wall">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-delete"></span> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="javascript:void(0)"><img src="images/folder-img.png"
                                                            class="mx-auto d-block img-fluid"></a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    Folder 1
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt20 mt-md0">
                                            <div class="folder-wall">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-delete"></span> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="javascript:void(0)"><img src="images/folder-img.png"
                                                            class="mx-auto d-block img-fluid"></a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    Folder 2
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt20 mt-md0">
                                            <div class="folder-wall">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-delete"></span> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="javascript:void(0)"><img src="images/folder-img.png"
                                                            class="mx-auto d-block img-fluid"></a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    Folder 3
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt20 mt-md0">
                                            <div class="folder-wall">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-delete"></span> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="javascript:void(0)"><img src="images/folder-img.png"
                                                            class="mx-auto d-block img-fluid"></a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    Folder 4
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt20 mt-md30">
                                            <div class="folder-wall">
                                                <div class="btn-group dropstart dash-drop">
                                                    <button type="button" class="btn  dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="icon-option"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-edit"></span> Rename</a></li>
                                                        <li><a href="javascript:void(0)"><span
                                                                    class="icon-list-delete"></span> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="appoint-inner">
                                                    <a href="javascript:void(0)"><img src="images/folder-img.png"
                                                            class="mx-auto d-block img-fluid"></a>
                                                </div>
                                                <div class="mt19 appoint-title text-center">
                                                    Folder 5
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ---tab-pane---image End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--End Image Modal -->

    <!--Start Create Folder Modal-->

    <div class="modal new-folder-modal fade" id="new-folder" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form ng-submit="create_folder()">
                    <div class="modal-body p-15 p-md30">
                        <img class="img-fluid d-block mx-auto"
                            ng-src="<?= $this->config->item('assetsPath') ?>images/folder-img.png"
                            src="<?= $this->config->item('assetsPath') ?>images/folder-img.png"
                            style="margin-bottom: 15px;">
                        <div class="form-group d-gblue-clr f-14 mb0 mt15 mt-md35"
                            ng-class="{'error-message':general.add_folder_title.error}">
                            <label for="exampleSelect1">Folder name</label>
                            <input type="text" id="createFolderInput" ng-model="general.add_folder_title.value"
                                maxlength="50" class="form-control field-h40 f-14" placeholder="Folder name">
                            <small class="form-text f-14 text-left" ng-show="general.add_folder_title.error">{{
                                general.add_folder_title.message }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="theme-btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="theme-btn-blue">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--End Create Folder Modal-->

    <!--Start Rename Folder Modal-->

    <div class="modal new-folder-modal fade" id="renameFolder" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form ng-submit="rename_object()">
                    <div class="modal-body p-15 p-md30">
                        <img class="img-fluid d-block mx-auto"
                            ng-src="<?= $this->config->item('assetsPath') ?>images/folder-img.png"
                            src="<?= $this->config->item('assetsPath') ?>images/folder-img.png"
                            style="margin-bottom: 15px;">
                        <h5 class="fw-normal">Rename Your Folder</h5>
                        <div class="form-group d-gblue-clr f-14 mb0 mt15 mt-md35"
                            ng-class="{'error-message':general.add_folder_title.error}">
                            <label for="exampleSelect1">Folder Name</label>
                            <input type="text" id="renameFolderInput" ng-model="general.rename_object_title.value"
                                maxlength="50" class="form-control field-h40 f-14" placeholder="Folder name">
                            <small class="form-text f-14 text-left"
                                ng-show="general.rename_object_title.error">{{general.rename_object_title.message}}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Rename</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--End Rename Folder Modal-->

    <!-- Delete Modal Popup -->

    <div class="modal new-folder-modal fade" id="deleteFolderModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-15 p-md30">
                    <img class="img-fluid d-block mx-auto"
                        ng-src="<?= $this->config->item('assetsPath') ?>images/folder-img.png"
                        src="<?= $this->config->item('assetsPath') ?>images/folder-img.png" style="margin-bottom: 15px;">
                    <h5 class="fw-normal">Are You Sure?</h5>
                    <div class="mt10 description">
                        Do you really want to delete this item? This item <br class="d-none d-lg-block">
                        cannot be recovered
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="theme-btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="theme-btn-blue yes">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- promt open modal start-->
    <div class="modal fade confirm-del openPromt" id="openPromt" tabindex="-1" aria-labelledby="openPromt"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title text-center" id="openPromt"><i class="fa-solid fa-book me-1"></i> Prompt
                        Library</h5>
                    <div class="row ">

                        <div class="col-12">
                            <div class="tab-content" id="pills-tabContent">
                                <!-- ---tab-pane---conversation Start -->
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="row my-3">
                                        <div class="col-12 col-md-12">
                                            <div class="search-bar">
                                                <div class="search-icon">
                                                    <span class="icon-search"></span>
                                                </div>
                                                <input type="text" class="search2 form-control" placeholder="Search.."
                                                    ng-model="promptfilter">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Search Results -->
                                    <div class="row row-cols-1 row-cols-md-2 g-3 gap-0">
                                        <div class="col"
                                            ng-repeat="prom_det in (filteredPrompts = (prompt_detail | filter: promptfilter))"
                                            ng-click="promptHit(prom_det.prompt)">
                                            <div class="promt-wall text-start">
                                                <h6>{{ prom_det.title }}</h6>
                                                <p>{{ prom_det.prompt }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- No record found message -->
                                    <div ng-if="filteredPrompts.length === 0" class="text-center mt-3">
                                        <p>No record found</p>
                                    </div>

                                </div>
                                <!-- ---tab-pane---conversation End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--promt open modal end-->

    <!-- Delete Modal Popup End -->
    <!---------LightBox ---------->
    <link href="<?php echo $assetsBasePath; ?>vendors/lighbox/lightbox-gallery.css" rel="stylesheet" />
    <script type='text/javascript' src="<?php echo $assetsFolder; ?>vendors/lighbox/lightbox-gallery.js"></script>
    <script type='text/javascript' src="<?= $this->config->item('assetsBasePath') ?>assets/js/speechtotext.js"></script>
    <script src="<?= $this->config->item('assetsBasePath') ?>assets/js/selector.js"></script>
    <script>
        var app = angular.module("AppModule", []);

        var baseUrl = '<?= base_url() ?>';

        app.factory('webServices', ['$http', function ($http) {
            return {
                query: function (url, data) {
                    return $http({
                        method: 'POST',
                        url: url,
                        data: $.param(data),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    });
                }
            };
        }]);
        app.filter("trustUrl", ['$sce', function ($sce) {
            return function (recordingUrl) {
                return $sce.trustAsResourceUrl(recordingUrl);
            };
        }]);

        app.filter('strReplace', function () {
            return function (input) {
                if (input && input.length > 14) {
                    return input.substring(0, 14) + '...';
                }
                return input;
            };
        });



        app.controller("conversationCtrl", function ($scope, $http, $timeout, webServices) {
            $scope.assistant_id = 1;
            $scope.chat = "";
            $scope.chat_id = "<?= !empty($last_chatid->chat_id) ? $last_chatid->chat_id : $continue_chat_id ?>";
            $scope.chatgpt_id = ""
            $scope.fileList = '';
            $scope.business_id = <?= $business_id ?>;
            $scope.propmt_category_id = '<?= $assistantData->niche ?>';
            $scope.searchImages = "<?= base_url('search-library'); ?>";
            $scope.search = {};
            $scope.search.category = 0;
            $scope.search.criteria = '<?php echo !empty($assistantChatInfo->purpose) ? $assistantChatInfo->purpose : 'chat'; ?>';
            $scope.search.q = '';
            $scope.search.page = 1;
            $scope.imagesList = [];
            $scope.show_div = false;
            //   $scope.token = "<?php echo $assistantChatInfo->token; ?>"
            //   $scope.tones = "<?php echo $assistantChatInfo->tones; ?>"
            //   $scope.superVapurpose = "<?php echo !empty($assistantChatInfo->purpose) ? $assistantChatInfo->purpose : 'chat'; ?>"
            $scope.vaPurpose = "chat"
            $scope.language = 26;
            $scope.selectedId = null;

            $scope.wordUrl = "#";
            $scope.pdfUrl = "#";
            $scope.textUrl = "#";






            $scope.general = {
                select_object: '',
                add_folder_title: { error: false, message: '', value: '' },
                rename_object_title: { error: false, message: '', value: '', type: '', id: '' },
                select: [],
                all_folders: [],
                select_folder: { error: false, message: '', type: '', id: '' },
                all_businesses: [],
                select_business: { error: false, message: '', type: '', id: '' },
                upload_types: ['all', 'image', 'video', 'document', 'audio', 'other'],
                share: { link: '', email: { error: false, message: '', value: [] }, message: '', expiry: '', id: '' },
                status: { privacy: '', password: { error: false, message: '', value: '', protected: true }, type: '', id: '' },
                delete_object: { id: '', type: '' },
                transfer_object: { id: '', type: '' },
                doc_slug: '',
                doc_edit: false,
                domain: '',
                doc_suffix: ''


            };
            $scope.data = {
                records: [],
                total_rows: 0,
                show_total_rows: 0,
                limit: "10",
                current_page: 1,
                search: '',
                type: '',
                filter: [{ "title": "", "value": "", "gate": "or" }],
                first_filter: 'uploaded',
                select: { all: false, folder: false, image: false, video: false, audio: false, document: false, other: false },
                order_by: "desc",
                order_type: 'created_date',
                folder_id: '',
                folder_title: '',
                recent: '',
                is_myDrive: '0',
                folder_nav: [],
                level: 0
            }






            /* ---------------  Create folder  ---------------   */

            $scope.create_folder = function () {
                //   console.log($scope.general);

                if ($scope.general.add_folder_title.value.trim() == '') {
                    $scope.general.add_folder_title.error = true;
                    $scope.general.add_folder_title.message = 'Folder Name required';
                    return;
                }
                var data = '';
                jsLoader(true);
                var data = $.param({
                    title: $scope.general.add_folder_title.value,
                });
                $http({
                    url: '<?= base_url('conversation-my-assets/add-folder') ?>',
                    method: "POST",
                    data: data,
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function (response) {
                    $('#new-folder').modal("hide");
                    $scope.load_folders();
                    $("#createFolderInput").val(null);
                    jsLoader(false);
                }).catch(function (error) {
                    console.log(error);
                });

            }

            /* ----------------- End  Create folder -------------------  */



            /* -----------------Show folder -------------------  */


            $scope.load_folders = function () {
                jsLoader(true);
                $http({
                    url: '<?= base_url('my-assets/get-all-folders') ?>',
                    method: "POST",
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                    .then(function (response) {
                        if (response.data.status == 'success') {
                            //   alert('ok');
                            $scope.general.all_folders = response.data.message.records;
                            $scope.data.records = response.data.message.records;
                            $scope.data.level = 0;


                            // console.log($scope.general.all_folders);
                            // $timeout(function () {$('.selectpicker').selectpicker('refresh');});
                        }
                    });


                jsLoader(false);
            }
            $scope.load_folders();


            /* ----------------- End Show folder -------------------  */



            /* ----------------- Start Rename Functions ----------------- */


            $scope.initialize_rename = function (object) {

                $("#renameFolder").modal('show');

                $scope.general.rename_object_title.value = object.title;
                $scope.general.rename_object_title.type = object.file_type;
                $scope.general.rename_object_title.error = false;


                //5 means folder

                if (object.file_type == "5") {
                    $scope.general.rename_object_title.id = object.library_object_id;
                } else {
                    $scope.general.rename_object_title.id = object.library_object_id;
                }
                //   console.log(object);
                //   console.log('general');
                //   console.log($scope.general);
            }

            $scope.rename_object = function () {
                if ($scope.general.rename_object_title.value.trim() == '') {
                    $scope.general.rename_object_title.error = true;
                    $scope.general.rename_object_title.message = 'Folder Name required';
                    return;
                }
                if ($scope.general.rename_object_title.type == '5') {
                    url = '<?= base_url('conversation-my-assets/rename-object') ?>';

                } else {

                    url = '<?= base_url('my-assets/rename-object') ?>';
                }
                var data = $.param({ title: $scope.general.rename_object_title.value, id: $scope.general.rename_object_title.id });

                $http({
                    url: url,
                    method: "POST",
                    data: data,
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function (response) {
                    //console.log(response);

                    if (response.data.status == 'success') {
                        $scope.general.rename_object_title.error = false;
                        $('#renameFolder').modal('hide');
                        $scope.load_folders();
                        $("#renameFolderInput").val('');
                        $scope.general.rename_object_title.value = '';

                    } else {
                        $scope.general.rename_object_title.error = true;
                        $scope.general.rename_object_title.message = response.data.message;
                    }

                });

            }

            /* ----------------- End Rename Functions ----------------- */




            /* -----------------Start Delete Function ----------------- */

            $scope.initialize_delete = function (object) {

                //   console.log(object);
                $("#deleteFolderModal").modal('show');

                $scope.general.delete_object.type = object.file_type;

                if (object.file_type == '1') {
                    $scope.general.delete_object.id = object.library_object_id;
                } else {
                    $scope.general.delete_object.id = object.library_object_id;
                }

                $('#deleteFolderModal .yes').on('click', function (e) {
                    $("#deleteFolderModal").modal("hide");
                    $scope.delete_folder(object);
                });

            }

            $scope.delete_folder = function (object) {

                jsLoader(true);

                var group_select = false;
                var single_delete = true;
                var data = '';
                var object_id = [];

                if (single_delete && !group_select) {
                    object_id.push({ type: $scope.general.delete_object.type, id: $scope.general.delete_object.id });
                }
                data += '&object_id=' + JSON.stringify(object_id);

                $http({
                    url: '<?= base_url('conversation-my-assets/delete-object') ?>',
                    method: "POST",
                    data: data,
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                    .then(function (response) {
                        $('#deleteFolderModal').modal('hide');
                        if (response.data.status == 1) {
                            flashNow({
                                'success': {
                                    'message': response.data.msg
                                }
                            });
                            // toastr.success(response.data.msg);
                            if (response.data.type == 1) {
                                $scope.get_data(true);
                            } else {
                                $scope.load_folders();
                            }
                            jsLoader(false);
                        } else {
                            flashNow({
                                'error': {
                                    'message': response.data.msg
                                }
                            });
                            // toastr.error(response.data.msg);
                        }
                        //   console.log(response.data)


                    });




            }

            /*----------------- End Delete Function -----------------*/





            /*-----------------Start Enter Folder after click  -----------------*/

            $scope.get_condition = function () {
                var data = '';
                data += 'search=' + $scope.data.search;
                data += '&recent=' + $scope.data.recent;
                data += '&is_myDrive=' + $scope.data.is_myDrive;
                data += '&items_per_page=' + $scope.data.limit;
                data += '&current_page=' + $scope.data.current_page;
                data += '&order_type=' + $scope.data.order_type;
                data += '&order_by=' + $scope.data.order_by;
                data += '&type=' + $scope.data.type;
                data += '&folder_id=' + $scope.data.folder_id;
                data += '&select=' + JSON.stringify($scope.data.select);

                return data;
            }

            $scope.get_data = function (callback = false, msg = '') {

                jsLoader(true);
                var data = $scope.get_condition();


                $http({
                    url: '<?= base_url('my-assets/open-folder-view') ?>',
                    method: "POST",
                    data: data,
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                    .then(function (response) {

                        $scope.data.records = response.data.message.records;
                        $scope.data.level = 1;

                        jsLoader(false);

                        //   console.log($scope.data.records);



                    });
            }

            $scope.select_folder = function (id, title) {



                $scope.data.folder_id = id;

                $scope.data.folder_title = title;
                $scope.data.recent = '';
                $scope.get_data();

                $scope.data.folder_nav.push({ 'object_id': id, 'title': title })

                var findflag = false;
                var updated_nav = [];
                angular.forEach($scope.data.folder_nav, function (val, key) {
                    if (!findflag) {
                        updated_nav.push(val);
                    }
                    if (val.object_id == id) {
                        findflag = true;
                    }
                })
                $scope.data.folder_nav = updated_nav;


            }


            /*----------------End enter Folder after click -----------------*/


            /*----------------File Download -----------------*/

            $scope.downloadFile = function (url, extension) {
                fetch(url)
                    .then(response => response.blob())
                    .then(blob => {
                        // Creating an invisible link
                        var link = document.createElement("a");
                        link.href = URL.createObjectURL(blob);
                        link.download = 'downloaded.' + extension;

                        // Triggering the click event on the link
                        link.click();
                    })
                    .catch(error => console.error('Error downloading image:', error));
            };




            /*----------------Image Save to folder -----------------*/

            $scope.saveToGallery = function (id, title) {
                // $scope.load_folders();
                $('#saveConversationAssets').modal('show');
                $scope.imageData = title;
                $scope.imageid = id;

            }

            //   play videos
            $scope.playVideo = function (url) {
                $("#StockVideosPopup").modal("show");
                $scope.url = url;
                var videoFile = url;
                $('#divVideo').html('<video style="width:100%;" autoplay muted loop controls>\
                    <source src="' + videoFile + '" type="video/mp4" />\
                    Your browser does not support the video tag.\
                </video>');
            };

            /* -----------------Save Assets -------------------  */
            $scope.saveAssets = function () {
                jsLoader(true);
                $http({
                    method: 'POST',
                    url: baseUrl + 'conversation-my-assets/save-asset',
                    aync: false,
                    data: {
                        'id': $scope.imageid,
                        'imagedata': $scope.imageData,
                        'folder_id': $scope.data.folder_id,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    if (response.data.status == 1) {
                        flashNow({
                            'success': {
                                'message': response.data.msg
                            }
                        });
                        //   toastr.success(response.data.msg);
                        $scope.get_data(true);
                        $scope.imageid = '';
                        $scope.imageData = '';
                        $scope.folder_id = '';
                        $('#saveConversationAssets').modal('hide');
                        $scope.load_folders();
                        // jsLoader(false);
                    } else {
                        flashNow({
                            'error': {
                                'message': response.data.msg
                            }
                        });
                        // toastr.error(response.data.msg);
                    }
                    jsLoader(false);
                });
            }

            /*  shadab work close*/


            /* -----------------Copy Text -------------------  */

            $scope.copyContent = async (text) => {
                try {
                    await navigator.clipboard.writeText(text);
                    flashNow({
                        'info': {
                            'message': 'Content copied to clipboard'
                        }
                    });
                    //    toastr.info('Content copied to clipboard');
                } catch (err) {
                    console.error('Failed to copy: ', err);
                }
            }

            /* -----------------Super Va Purpose  -------------------  */

            $scope.setSuperVapurpose = function (vapurpose) {
                $scope.vaPurpose = vapurpose;
                $('.send-msg, #generated-text ').toggleClass("showOn");
                $scope.chatSettings();
            }

            /* -----------------Chatname Edit -------------------  */


            //   $scope.editMode = function (id, name) {
            //       $edit_mode_off = $(".edit_input_off" + id);
            //       $edit_icon_off = $(".edit_icon_off" + id);
            //       $edit_mode_on = $(".edit_mode_on" + id);
            //       $scope.inputChat = name;

            //       $edit_mode_on.css('display', "none");
            //       $edit_mode_off.css('display', "block");
            //       $edit_icon_off.removeAttr("style");
            //   };

            $scope.editChat = function (id, value) {
                $scope.update_chatname = value;
                $scope.update_chat_id = id;
                $('#renameChat').modal('show');
            }


            $scope.updateTitle = function () {

                if ($scope.update_chatname != '') {
                    $http({
                        method: 'POST',
                        url: 'chat-update',
                        aync: false,
                        data: {
                            'id': $scope.update_chat_id,
                            'value': $scope.update_chatname
                        },
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function (response) {

                        if (response.data.status == 1) {
                            //    toastr.success(response.data.msg);
                            flashNow({
                                'success': {
                                    'message': 'Chatname Updated Successfully'
                                }
                            });
                            $('#renameChat').modal('hide');
                        }
                        getChatlist();
                    });
                } else {
                    flashNow({
                        'error': {
                            'message': 'Please enter chat name'
                        }
                    });
                    //    toastr.error('Please enter chat name');
                }


            };

            /* -----------------On Enter Search -------------------  */
            $('#inputText').on('keypress', function (e) {
                if ($scope.chat != "") {
                    var code = e.keyCode || e.which;
                    if (code == 13) {
                        $scope.addMessage();
                        $scope.chat = "";
                    }
                }
            });

            /* -----------------Upload Chat BG -------------------  */
            $(document).on('change', '#formFile', function () {
                jsLoader(true);
                var selectedFile = this.files[0];
                $scope.imageType = 'custom';
                $scope.fileUpload(selectedFile, $scope.imageType);
                jsLoader(false);
            });

            $scope.uploadChatBG = function (selectedFile) {
                jsLoader(true);
                $scope.setChatBg(selectedFile)
                $scope.imageType = 'default';
                $scope.fileUpload(selectedFile, $scope.imageType);
                jsLoader(false);
            }

            $scope.fileUpload = function (img, type) {
                if ($scope.chat_id != '') {
                    $scope.fileList = img;
                    var formData = new FormData();
                    formData.append('image', $scope.fileList);
                    formData.append('chat_id', $scope.chat_id);
                    formData.append('type', $scope.imageType);
                    $http({
                        method: 'POST',
                        url: 'file-upload',
                        data: formData,
                        transformRequest: angular.identity,
                        headers: {
                            'Content-Type': undefined
                        },
                    }).then(function (response) {
                        if (response.data.status == 'success' && type == 'custom') {
                            $scope.setChatBg('app/' + response.data.path)
                            flashNow({
                                'success': {
                                    'message': response.data.message
                                }
                            });
                            // toastr.success(response.data.message);
                        } else if (response.data.status == 'failed') {
                            flashNow({
                                'error': {
                                    'message': response.data.error
                                }
                            });
                            //    toastr.error(response.data.error);
                        }
                    }, function (error) {
                        flashNow({
                            'error': {
                                'message': response.data.error
                            }
                        });
                        //    toastr.error(response.data.error);
                    });


                } else {
                    flashNow({
                        'error': {
                            'message': 'Please enter chat'
                        }
                    });
                    //    toastr.error('Please select a chat');
                }
            }

            $scope.setChatBg = function (path) {
                document.getElementById("myDIV").style.backgroundImage = "";
                document.getElementById("myDIV").style.backgroundPosition = "center center";
                document.getElementById("myDIV").style.backgroundRepeat = "no-repeat";
                document.getElementById("myDIV").style.backgroundSize = "cover";
            }

            /* -----------------Save Chat Setting -------------------  */
            $scope.chatSettings = function () {
                if ($scope.chat_id != '') {
                    $http({
                        method: 'POST',
                        url: 'conversation/chat-setting',
                        data: {
                            'language': $scope.language,
                            'tones': $scope.tones,
                            'chat_id': $scope.chat_id,
                            //   'token': $scope.token,
                            'purpose': $scope.vaPurpose,
                        },
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function (response) {
                        if (response.data.status == '1') {
                            $scope.search.criteria = $scope.vaPurpose;
                            if ($scope.imagesList.length > 0) {
                                $scope.imagesList = [];
                                $scope.getConversation($scope.chat_id);

                            }
                        }

                    }, function (error) {
                        flashNow({
                            'error': {
                                'message': response.data.error
                            }
                        });
                        //    toastr.error(response.data.error);
                    });


                } else {
                    flashNow({
                        'error': {
                            'message': 'Please enter chat'
                        }
                    });
                    //    toastr.error('Please select a chat');
                }
            }


            /* -----------------Auto Chat Scroll Bar  -------------------  */

            function setScrollBar() {
                $timeout(function () {
                    var messageBody = document.querySelector('#messageBody');
                    messageBody.scroll({
                        top: messageBody.scrollHeight,
                        behavior: 'smooth'
                    });
                    // messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                }, 500);
            }

            /* -----------------deleter conversation -------------------  */

            $scope.deleleChatModal = function (id) {


                $('#chat_deletion').modal('show');
                $scope.deleteChatID = id;
            }


            $scope.deleleChat = function () {
                $http({
                    method: 'POST',
                    url: 'delete-chat',
                    aync: false,
                    data: {
                        'id': $scope.deleteChatID,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    if (response.data.status == 1) {
                        flashNow({
                            'success': {
                                'message': 'Chat Deleted successfully'
                            }
                        });
                        //    toastr.success(response.data.msg);
                        getChatlist($scope.business_id);
                        $("#chat_deletion").modal("hide");
                        $timeout(function () {
                            $scope.getConversation(id + 1);
                        }, 300);
                    } else {
                        flashNow({
                            'error': {
                                'message': 'The last chat cannot be deleted.'
                            }
                        });
                        //    toastr.error(response.data.msg);
                    }
                });
            }

            /* -----------------new conversation generate -------------------  */

            $scope.newConversation = function () {
                $http({
                    method: 'POST',
                    url: 'getchattitle',
                    aync: false,
                    data: {
                        'business_id': $scope.business_id,
                        'assistant_id': $scope.assistant_id
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    $scope.vaPurpose = response.data.purpose;
                    $scope.chatSettings();
                    $scope.chat_id = response.data.chat_id;
                    getChatlist($scope.business_id);
                    $timeout(function () {
                        $scope.getConversation($scope.chat_id);
                    }, 300);
                });
            }

            /* -----------------prompts Code -------------------  */
            //   function promptCategory(id) {
            //       $http({
            //           method: 'POST',
            //           url: 'prompt-category',
            //           aync: false,
            //           data: {
            //               id: id
            //           },
            //           headers: {
            //               'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            //           }
            //       }).then(function (response) {
            //           $scope.category = response.data.category;
            //             // $('#'+response.data.category[0].id).focus();
            //             // $('#'+response.data.category[0].id).trigger('click');
            //          if(response.data.category[0].id){
            //           $scope.promptdetail(response.data.category[0].id)
            //          }
            //       });
            //   }

            //   promptCategory($scope.propmt_category_id);

            //// Prompt Details
            $scope.promptdetail = function (id) {
                $http({
                    method: 'POST',
                    url: 'prompt-detail',
                    aync: false,
                    data: {
                        'id': id,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log(response);
                    $scope.prompt_detail = response.data.prompt_detail;
                });
            }
            $scope.promptdetail("<?php echo $assistantData->pro_cat_id ?>");

            /* -----------------Lists -------------------  */
            function getChatlist() {
                $http({
                    method: 'POST',
                    url: 'getchatlist',
                    aync: false,
                    data: {
                        'business_id': $scope.business_id,
                        'assistant_id': $scope.assistant_id
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    $scope.chatlist = response.data.chatlist;
                    console.log($scope.chatlist);
                });
            }
            getChatlist();

            $scope.getConversation = function (chat_id) {
                $scope.chat_id = chat_id;
                $scope.selectedId = chat_id;
                $http({
                    method: 'POST',
                    url: 'getconversation',
                    aync: false,
                    data: {
                        'business_id': $scope.business_id,
                        'chat_id': chat_id,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
          /*  if (response.data.chat_setting != null) {
               if("<?= $assistantData->assistant_status; ?>" != "super_va"){
                    $scope.wordUrl = '<?php echo base_url("download_conversation") ?>' + '?id=' + chat_id + '&type=word';
                    $scope.pdfUrl = '<?php echo base_url("download_conversation") ?>' + '?id=' + chat_id + '&type=pdf';
                    $scope.textUrl = '<?php echo base_url("download_conversation") ?>' + '?id=' + chat_id + '&type=text';
                }
               var imageUrl = '';
                if (response.data.chat_setting.type == 'default') {
                    imageUrl = `${response.data.chat_setting.chat_bg}`;
                } else {
                    imageUrl = `<?= $assetsBasePath ?>${response.data.chat_setting.chat_bg}`;
                }
                //   $scope.update_chatname = `${response.data.chat_setting.chat_name}`
                //   $scope.token     = `${response.data.chat_setting.token}`;
                $scope.tones = `${response.data.chat_setting.tones}`;
                $scope.language = `${response.data.chat_setting.language}`;
                setTimeout(function () {
                    $('.selectpicker').selectpicker('refresh')
                }, 500);
                $scope.setChatBg(imageUrl);
                $timeout(function () {
                    $.getScript("<?= $assetsBasePath; ?>vendors/lighbox/lightbox-gallery.js");
                }, 700);
            } */

            $.each(response.data.chats, function (index, value) {
                if (value.type != "chatgpt" && value.ai != '') {
                    response.data.chats[index].ai = JSON.parse(value.ai);
                }
            });

            $scope.chating = response.data.chats;
            //   console.log($scope.chating);
            setScrollBar();
        });
   
   }

        $scope.isSelected = function (id) {
            return $scope.selectedId === id;
        };

        if ($scope.chat_id != '') {
            $scope.getConversation($scope.chat_id);
        }

        /* -----------------Send Request Ai -------------------  */
        $scope.promptHit = function (msg) {
            $scope.chat = msg
            //   $('.send-msg, #generated-text ').toggleClass("showOn");
            $("#openPromt").modal("hide");
            // $("#use-promo").trigger('click');
            // $scope.addMessage();
        }

        $scope.addMessage = function () {
            var url = "my-chat";
            var data = {
                'business_id': $scope.business_id,
                'chat_id': $scope.chat_id,
                'assistant_id': $scope.assistant_id,
                'type': 'chatgpt',
                'message': $scope.chat,
                'tones': $scope.tones,
                //   'token': $scope.token,
                'language': $scope.language,
            }
            //   var assistant_status = "<?= $assistantData->assistant_status; ?>";
            if ($scope.vaPurpose == "images" || $scope.vaPurpose == "videos" || $scope.vaPurpose == "gifs") {
                url = "images";
                data = {
                    'business_id': $scope.business_id,
                    'chat_id': $scope.chat_id,
                    'assistant_id': $scope.assistant_id,
                    'type': 'stockimage',
                    'keyword': $scope.chat,
                }

            }
            // console.log($scope.vaPurpose);
            // console.log('here');
            // console.log(data);
            // console.log($scope.chat);

            if ($scope.chat_id != '') {
                if ($scope.chat != '') {
                    //   console.log(data);
                    $http({
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        },
                        method: 'POST',
                        url: url,
                        aync: false,
                        data: data
                    }).then(function (response) {
                        if (response.data.status == 'success') {
                            $scope.chat = "";
                            //Get data form database
                            $scope.getConversation(response.data.data.chat_id);
                            setScrollBar();

                            if (response.data.data.type == 'chatgpt') {


                                addBotMessage(response.data.data.user_question, response.data.data);
                            } else if (response.data.data.type == 'stockimage') {

                                $scope.search.q = response.data.data.keyword;
                                $scope.chatgpt_id = response.data.data.id;
                                $scope.searchPixabay();

                            }


                        } else {
                            flashNow({
                                'error': {
                                    'message': response.data.msg
                                }
                            });
                            //   toastr.error(response.data.msg);
                        }

                        // setScrollBar();
                        // $scope.customerData = response.data.customer_data;
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else {
                    flashNow({
                        'error': {
                            'message': 'Please write your question'
                        }
                    });
                    //   toastr.error('Please write your question')
                }
            } else {
                flashNow({
                    'error': {
                        'message': 'Please select chat'
                    }
                });
                //   toastr.error('Please select chat')
            }
        }

        /* on search button clicked */
        $scope.searchPixabay = function () {
            if ($scope.search.q == '') {
                flashNow({
                    'error': {
                        'message': 'Please Enter Keyword'
                    }
                });
                return;
            }
            jsLoader(true);
            $scope.search.page = 1;
            webServices.query($scope.searchImages, $scope.search)
                .then(function (response) {
                    //   console.log(response);
                    if (response.data.error == undefined) {
                        if (response.data == '') {
                            $scope.show_div = true;
                        } else {
                            $scope.show_div = false;
                        }
                        $scope.imagesList = response.data;
                        $scope.responseSave(response.data);
                        // console.log(response.data.html);
                        // 
                        // imageResponseToHtml(response.data);
                        $timeout(function () {
                            $.getScript("<?= $assetsBasePath; ?>vendors/lighbox/lightbox-gallery.js");
                            jsLoader(false);
                        }, 300);
                        $("html, body").animate({
                            scrollTop: $("#images-section").offset().top
                        }, 500);
                    }
                    if (response.data.error) {
                        flashNow({
                            'error': {
                                'message': response.data.error
                            }
                        });
                        //    toastr.error(response.data.error)
                    }
                    //   new PNotify({
                    //       title: 'Error',
                    //       text: response.data.error,
                    //       type: 'error'
                    //   });
                    jsLoader(false);
                });
        };

        $scope.responseSave = function (data) {
            $http({
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
                method: 'POST',
                url: 'save-curl',
                aync: false,
                data: {
                    'data': data,
                    'id': $scope.chatgpt_id,
                    'page': $scope.search.page,
                },
            }).then(function (response) {

            }).catch(function (error) {
                console.log(error);
            });
        }

        /* load more button clicked */
        $scope.loadMore = function () {
            jsLoader(true);
            $scope.search.page = $scope.search.page + 1;
            webServices.query($scope.searchImages, $scope.search)
                .then(function (response) {
                    if (response.data.length == 0) {
                        jsLoader(false);
                        flashNow({
                            'info': {
                                'message': 'No more image available'
                            }
                        });
                        //    toastr.info('No more image available');
                        return false;
                    }
                    if (response.data.error == undefined) {
                        $scope.imagesList = $scope.imagesList.concat(response.data);
                        $scope.responseSave(response.data);
                        $timeout(function () {
                            $.getScript("<?php echo $assetsFolder; ?>vendors/lighbox/lightbox-gallery.js");
                            jsLoader(false);
                        }, 300);
                    }
                    if (response.data.error) new PNotify({
                        title: 'Error',
                        text: response.data.error,
                        type: 'error'
                    });
                });
        };



        $scope.formatDate = function (created_at) {
            // Parse the date string into a JavaScript Date object
            var date = new Date(created_at);

            // Extract the date part (YYYY-MM-DD)
            var formattedDate = date.toISOString().split('T')[0];

            return formattedDate;
        };



        /* Save image url in ai response */
        $(document).on('click', ".pixabay-images", function () {
            image_url = $(this).find('img').prop('src');

            $("#stockImagesresult").html('');

            data = {
                'business_id': $scope.business_id,
                'chat_id': $scope.chat_id,
                'assistant_id': $scope.assistant_id,
                'chatgpt_id': $scope.chatgpt_id,
                'image_url': image_url
            }

            $http({
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
                method: 'POST',
                url: "<?= base_url() . 'save-image-url'; ?>",
                data: data
            }).then(function (response) {

                if (response.data.status == 1) {
                    $scope.getConversation(response.data.id);
                } else {
                    alert("failed");
                }
            });
        });


        /// chat gpt response
        function addBotMessage(message, data, action = "bot") {
            $('.loading-chat').show();
            $http({
                method: 'POST',
                url: 'openai',
                aync: true,
                data: {
                    'business_id': $scope.business_id,
                    'type': data.type,
                    'chat_id': data.chat_id,
                    'message': message,
                    'action': action,
                    'id': data.id,
                    'tones': $scope.tones,
                    //   'token': $scope.token,
                    'language': $scope.language,
                    'assistent_id': $scope.assistant_id
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function (response) {
                if (response.data.status == 1) {
                    remainingCredit();
                    setTimeout(() => {
                        $scope.getConversation($scope.chat_id);
                        $('.loading-chat').hide();
                    }, 2000);
                    setScrollBar();
                } else if (response.data.status == 2) {

                } else {
                    $('.loading-chat').hide();
                    flashNow({
                        'info': {
                            'message': response.data.msg
                        }
                    });
                    //    toastr.error(response.data.msg);
                }
                // $scope.customerData = response.data.customer_data;
            }).catch(function (error) {
                console.log(error);
            });
        }
        $scope.copyconversation = function (id) {
            var textToCopy = $("#" + id).text().trim();
            var copyicon = $("#" + id).find('.fa-copy');

            navigator.clipboard.writeText(textToCopy).then(() => {
                // Reset all icons
                $('.fa-copy').css({
                    'transform': 'scale(1)',
                    'filter': 'none',
                    'transition': 'transform 0.2s ease, box-shadow 0.2s ease'
                });

                // Apply scale & shadow to the clicked icon
                copyicon.css({
                    'transform': 'scale(1.2)',
                    'filter': 'drop-shadow(rgba(0, 0, 0, 0.3) 0px 10px 3px)', // Drop shadow effect
                    'transition': 'transform 0.2s ease, box-shadow 0.2s ease'
                });

            }).catch(err => {
                console.error("Failed to copy: ", err);
            });
        };

        /// chat gpt regenerate Conversation
        $scope.regenerateConversation = function () {
            var text = $.trim($('.receiver-text:last').text());
            var conversation_id = $('.receiver-text:last').data('conversation_id');
            var type = $('.receiver-text:last').data('type');
            //   var data = {
            //       'type': type,
            //       'id': conversation_id,
            //       'chat_id': $scope.chat_id
            //   };



            var data = {
                'type': type,
                'id': conversation_id,
                'chat_id': $scope.chat_id
            }

            var purpose = "<?= $assistantData->purpose; ?>";

            if (purpose == "images" || purpose == "videos" || purpose == "gifs") {
                url = "images";
                data = {
                    'business_id': $scope.business_id,
                    'chat_id': $scope.chat_id,
                    'assistant_id': $scope.assistant_id,
                    'type': 'stockimage',
                    'keyword': $scope.chat,
                }

            }








            if (text == '') {
                flashNow({
                    'error': {
                        'message': 'please start your chat first'
                    }
                });
                //    toastr.error('please start your chat first');
            } else {
                if (type == 'chatgpt') {

                    addBotMessage(text, data, 'regenerate')
                } else {

                    $scope.search.q = text;
                    $scope.chatgpt_id = conversation_id;
                    $scope.searchPixabay();

                }
            }
        }

        /* -----------------Assets Download -------------------  */
        $(document).on('click', '.pdfDownload', function () {
            var id = $(this).data('id');
            window.location.href = baseUrl + 'pdfgenerate?id=' + id
        });

        /* -----------------Loader -------------------  */
        function jsLoader(add) {
            if (add === undefined) {
                add = false;
            }
            $(".temp_js_loader").remove();
            if (add) {
                $("body").append('<div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?= $assetsBasePath ?>assets/images/grabiris_loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; height:100px"></div>');
            }
        };
})
    </script>
    <script>
        $(document).ready(function () {
            $('#sideNavButton').trigger('click');
            var chatBgCount = 0;
            $("#use-promo").on('click', function () {
                $('#generated-text ').toggleClass("showOn");
            });
            $(".chat-sidebar-container-btn").on('click', function () {
                $('.chat-sidebar-container').toggleClass("slideOn");
            });
            $("#chatBG").on('click', function () {
                $('.chatBG-item').toggleClass("dropbg");

            });

            $(document).click(function (e) {
                var chatBG = $("#chatBG");
                if (!chatBG.is(e.target) && chatBG.has(e.target).length === 0) {
                    $('#chatBG').removeClass("dropbg");
                }

                // var promo = $("#use-promo");
                // console.log(promo.is(e.target));
                // console.log(promo.has(e.target).length);
                // if (!promo.is(e.target) && promo.has(e.target).length === 0)
                // {
                //     $('.regenerator-text').removeClass("showOn");
                // }


                //  var p = 1;
                // var promo = $("#generated-text");
                // if (!promo.is(e.target) && promo.has(e.target).length === 0)
                // {
                //     $('.regenerator-text').removeClass("showOn");
                // }
            });

            const txHeight = 40;
            const tx = document.getElementsByTagName("textarea");

            for (let i = 0; i < tx.length; i++) {
                if (tx[i].value == '') {
                    tx[i].setAttribute("style", "height:" + txHeight + "px;");
                } else {
                    tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;");
                }
                tx[i].addEventListener("input", OnInput, false);
            }

            function OnInput(e) {
                this.style.height = 0;
                this.style.height = (this.scrollHeight) + "px";
            }
        })


    </script>
    <script>
        const button0 = document.getElementById("btn1")
        const listDrop = document.querySelectorAll(".style-link")

        listDrop.forEach(lists => {
            lists.addEventListener(click, function () {
                lists.textContent = button0.innerText;
            })
        });


    </script>
    <script>
        var light = document.getElementById('mic');
        light.addEventListener('click', function (light) {
            light.target.classList.toggle('mic-on')
        })
    </script>
    <script>
        function changeImage() {
            var image = document.getElementById('myImage');
            if (image.src.match("bulbon")) {
                image.src = "<?= $this->config->item('assetsBasePath') ?>assets/images/mic.png";
            } else {
                image.src = "<?= $this->config->item('assetsBasePath') ?>assets/images/microphone1.gif";
            }

        }
    </script>