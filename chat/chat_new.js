document.addEventListener('DOMContentLoaded', function () {

    const prompt_id = document.querySelector('script[id]').getAttribute('id');
    const user_id = document.querySelector('script[user_id]').getAttribute('user_id');
    const business_id = document.querySelector('script[business_id]').getAttribute('business_id');
    const src = document.querySelector('script[user_id][id][src]').getAttribute('src');
    const segments = src.split('/chat/')[0]
    // const prompt_id=document.querySelector('script[id]').getAttribute('id');
    // const user_id=document.querySelector('script[user_id]').getAttribute('user_id');
    const aiApp = '';


    // localStorage.clear('unique_id');
    // localStorage.removeItem('unique_id');
    function generateSessionId() {
        let timestamp = new Date().getTime(); // get current timestamp
        let random = Math.floor(Math.random() * 1000000); // generate random number
        return `${timestamp}-${random}`; // combine timestamp and random number
    }
    if (localStorage.getItem('visitor_id') === undefined || localStorage.getItem('visitor_id') === '' || localStorage.getItem('visitor_id') === null) {
        const unique_id = localStorage.getItem('visitor_id');
        localStorage.setItem('visitor_id', generateSessionId());
    }
    generateSessionId();

    let color;
    let bottext_color;
    let botbackground_color;
    let usertext_color;
    let userbackground_color;
    let txt;
    // const baseUrl = 'https://www.aivideobuilderfx.in/app/';
    const baseUrl = segments + '/';
    let assistant_image;
    let chatbot_footer;
    let widget_image;
    let chatbot_background;
    let chatbot_class;
    let qhtml;
    let close_message;
    let welcome_message;
    let chatbot_question;
    let prompt_description;
    let prompt_place_holder_text;
    let prompt_notice_message;
    let text_labeling_check;
    let footer_redirect_url;
    let prompt_is_show_lead_form;
    let prompt_time_delay_close;
    let prompt_is_show_feedback_form;
    let msg_bot = '';
    let not_active = '';

    async function getStyle() {
        // console.log(prompt_id);
        const url = baseUrl + 'chat/style.php';
        const formData = new FormData();
        formData.append('prompt_id', prompt_id);
        formData.append('visitor_id', localStorage.getItem('visitor_id'));
        formData.append('user_id', business_id);
        formData.append('app', aiApp);

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const json = await response.json();
            // console.log(json)
            txt = json.txt;
            var maxLength = 24;

            // if (txt.length > 24) {
            //     txt = txt.slice(0, 24) + '...';
            // }
            if (json.not_active) {
                not_active = json.not_active
                msg_bot = json.not_active;
            } else {
                qhtml = json.qhtml;
                // console.log(qhtml);
                color = json.color; // Assign value to color
                bottext_color = json.bottext_color; // Assign value to color
                botbackground_color = json.botbackground_color; // Assign value to color
                usertext_color = json.usertext_color; // Assign value to color
                userbackground_color = json.userbackground_color; // Assign value to color
                list_id = json.list_id;
                widget_image = json.widget_image;
                autoresponder_id = json.autoresponder_id;
                chatbot_background = json.chatbot_background;
                close_message = json.close_message;
                welcome_message = json.prompt;
                chatbot_class = json.chatbot_class;
                chatbot_question = json.chatbot_question
                prompt_description = json.prompt_description
                prompt_place_holder_text = json.prompt_place_holder_text
                prompt_notice_message = json.prompt_notice_message
                chatbot_class = chatbot_class.split(",");
                assistant_image = json.assistant_image;
                customer_apps = json.customer_apps;
                customer_apps_questions = json.customer_apps_questions;
                text_labeling_check = json.text_labeling_check;
                footer_redirect_url = json.footer_redirect_url;
                prompt_is_show_lead_form = json.prompt_is_show_lead_form
                prompt_time_delay_close = json.prompt_time_delay_close
                prompt_is_show_feedback_form = json.prompt_is_show_feedback_form

                const myArray = assistant_image.split("/");
                const lastWord = myArray[myArray.length - 1];
                if (lastWord != 'default_profile.png') {
                    const baseUrlImg = baseUrl.split('app/')[0]
                    assistant_image = baseUrlImg + json.assistant_image;
                } else {
                    assistant_image = json.assistant_image;
                }

                widget_image = json.widget_image;
                const widgetArray = widget_image.split("/");
                const widgetlastWord = widgetArray[widgetArray.length - 1];

                if (widgetlastWord != 'widget.png') {
                    widget_image = baseUrl + json.widget_image;

                } else {
                    widget_image = baseUrl + json.widget_image;
                }

                if (text_labeling_check == 0) {
                    if (json.chatbot_footer != null) {
                        chatbot_footer = baseUrl + json.chatbot_footer;
                    } else {
                        chatbot_footer = baseUrl + 'chat/chatbot_footer.png';
                    }
                } else if (text_labeling_check == 1) {
                    fontsize = json.fontsize;
                    fontcolor = json.fontcolor;
                    boxcolor = json.boxcolor;
                    chatbot_footer = json.chatbot_footer;
                }

                speaker_icon = baseUrl + 'chat/speaker-icon.gif';
                // console.log(chatbot_footer);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    (async () => {
        await getStyle(); // Wait for getStyle() to complete before proceeding
        var chatboxHeader = '';
        let htmlData = "";
        let copilot = document.getElementById("u9sst8htz0xhrrds");
        if (not_active != null || not_active != '') {
            htmlData = `<h2>${msg_bot}</h2>`;
            copilot.innerHTML += htmlData;
        }
        if (not_active == null || not_active == '') {
            if (chatbot_class[0] == 'chatbox-five') {
                var chatboxHeader = `border:10px solid ${color}`;
            }

            if (chatbot_class[1] == 'block') {
                var height = `max-height:calc(100% - 250px)`;
            } else {
                var height = `max-height:calc(100% - 210px)`;
            }

            htmlData = `<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                        <style>
                            :root {
                                --rgba-primary-1: rgb(113, 72, 226, 0.10);
                                --rgba-primary-2: rgb(113, 72, 226, 0.2);
                                --rgba-primary-3: rgb(113, 72, 226, 0.3);
                                --rgba-primary-4: rgb(113, 72, 226, 0.4);
                                --rgba-primary-5: rgb(113, 72, 226, 0.5);
                                --rgba-primary-6: rgb(113, 72, 226, 0.6);
                                --rgba-primary-7: rgb(113, 72, 226, 0.7);
                                --rgba-primary-8: rgb(113, 72, 226, 0.8);
                                --rgba-primary-9: rgb(113, 72, 226, 0.9);
                            
                                --primary-hover: #5b35c4;
                                
                                --primary-color: #7148E2;
                                --primary-color2: #7148E2;
                                --primary-color3: #FF5858;
                                --primary-color4: #ec4242;
                                --secondary-color: #FDDB8A;
                                --secondary-color2: #CDD4ED;
                                --secondary-color3: #8B93B1;
                                --tertiary-color: #fff;
                                --text-primary: #ffffff;
                                --hover-color: #0D1216;
                                --white-color: #0D1216;
                                --black-color: #0D1216;  
                                
                                --danger-color:#FF4D4D;
                                --danger-color1: #FF4A4A;
                                --primary-color5: #7148E2;
                                --primary-color6: #7148E2;
                                --primary-color7: #7148E2;
                                --grey-color: #646464;
                                --blue-gradient:#7148E2;
                                --blue-gradient1:  #7148E2;
                                --theme-bg:#fff;
                                --theme-bg2:#f2f2f2;
                                --theme-color:#01010199;
                                --theme-color2:rgba(1, 1, 1, 0.60);
                                --theme-br: rgba(113, 72, 226, 0.20);
                                --theme-br2:#7148E2;
                                --theme-br3: rgba(1, 1, 1, 0.15);
                            }  
                            .modal,
                            .chat-user-card{
                                font-family: 'Inter', sans-serif;
                                box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
                            }
                            .typing-box {
                                min-width: 200px;
                                min-height: 44px;
                                max-height: 350px;
                                height: max-content;
                                width: calc(100% + 0px);
                                margin: 0px;
                                overflow: hidden;
                                border-radius: 5px;
                                border: 1px solid var(--theme-br3);
                                opacity: 1;
                                display: flex;
                                gap: 10px;
                                padding: 0 10px;
                                justify-content: space-between;
                            }
                            .typing-box input {
                                background: transparent;
                                border: 0;
                                outline: none;
                                box-shadow: none;
                                padding: 0 10px;
                                width: 80%;
                            }
                            .typing-box button {
                                background: transparent !important;
                                border: none;
                            }
                            .msg-container{
                                margin-bottom: 10px;
                            }
                            .msg-container i {
                                font-size: 1rem;
                                color: #cccccc;
                                margin: 10px 20px 0 0;
                                cursor: pointer;
                            }
                            .chat-area {
                                display: flex;
                                overflow-y: auto;
                                flex-direction: column;
                                gap: 14px;
                                height: 100%;
                                max-height: 250px;
                                margin-top: 20px;
                                /*scrollbar-width: thin;
                                scrollbar-color: #7148E2 rgba(113, 72, 226, 0.20);*/
                            }
                            .chat-area::-webkit-scrollbar{
                                width: 5px;
                            }
                            .card-inner img {
                                min-width: 75px;
                                width: 75px;
                                height: 75px;
                                object-fit: cover;
                            }
                            .chat-area::-webkit-scrollbar {
                                display: none;
                            }
                            .chatbox-chat {
                                width: 100%;
                            }
                            .chatbox-chat .text {
                                max-width: 70%;
                                padding: 10px;
                                display: block;
                                color: #0D1216;
                            }
                            .chatbox-chat.reciver .text {
                                border: 1px solid rgba(113, 72, 226, 0.20);
                                border-radius: 10px 10px 10px 0px;
                                background: #fff;
                            }
                            .chatbox-chat.sender {
                                display: flex;
                                justify-content: end;
                            }
                            .chatbox-chat.sender .text {
                                border-radius: 10px 10px 0px 10px;
                                background: #cccccc47;
                            }
                            .btn.reset {
                                padding: 10px 15px !important;
                                color: #646464;
                                border-color: rgba(1, 1, 1, 0.15) !important;
                                background: transparent!important;
                                border : 1px solid;
                            }
                            #u9sst8htz0xhrrds {
                                display: flex;
                                justify-content: center;
                            }
                            .ques-boxes{
                                display: flex;
                                gap: 10px;
                                margin: 20px 0;
                                margin-top: 50px;
                            }
                            .ques-box {
                                box-shadow: 0px 7px 30px -10px rgba(66, 98, 255, 0.1);
                                font-size: 14px;
                                font-weight: 400;
                                color: #000;
                                text-align: start;
                                border-radius: 10px;
                                transition: 0.4s;
                                min-width: 160px;
                                min-height: 90px;
                                margin: 0px;
                                padding: 20px;
                                border: 1px solid rgba(0, 0, 0, .07);
                                background: white;
                                cursor: pointer;
                            }
                            .ques-box button {
                                border: none;
                                background: none;
                            }
                            .ques-box:active {
                                background: none;
                                border: none;
                            }
                            #copyPopup {
                                display: none;
                                position: fixed;
                                bottom: 20px;
                                right: 20px;
                                color: #fff;
                                padding: 10px;
                                border-radius: 5px;
                                z-index: 1000;
                                transition: opacity 0.5s;
                                background: green;
                            }
                            .modal {
                                position: fixed;
                                top: 0;
                                right: 0;
                                bottom: 0;
                                left: 0;
                                z-index: 1050;
                                overflow: hidden;
                                outline: 0;
                                opacity: 0;
                                visibility: hidden;
                                transform: scale(1);
                                pointer-events: none;
                                transition: 0.5s;
                            }
                            .modal #le
                            .modal-open .modal {
                                overflow-x: hidden;
                                overflow-y: auto
                            }
                            .modal-dialog {
                                position: relative;
                                width: auto;
                                margin: .5rem;
                                pointer-events: none
                            }
                            .modal.fade .modal-dialog {
                                transition: -webkit-transform .3s ease-out;
                                transition: transform .3s ease-out;
                                transition: transform .3s ease-out, -webkit-transform .3s ease-out;
                                -webkit-transform: translate(0, -25%);
                                transform: translate(0, -25%)
                            }
                            .modal.show .modal-dialog {
                                -webkit-transform: translate(0, 0);
                                transform: translate(0, 0)
                            }
                            .modal-dialog-centered {
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-align: center;
                                -ms-flex-align: center;
                                align-items: center;
                                min-height: calc(100% - (.5rem * 2))
                            }
                            .modal-content {
                                position: relative;
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-orient: vertical;
                                -webkit-box-direction: normal;
                                -ms-flex-direction: column;
                                flex-direction: column;
                                width: 100%;
                                pointer-events: auto;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid rgba(0, 0, 0, .2);
                                border-radius: .3rem;
                                outline: 0
                            }
                            .modal-backdrop {
                                position: fixed;
                                top: 0;
                                right: 0;
                                bottom: 0;
                                left: 0;
                                z-index: 1040;
                                background-color: #000
                            }
                            .modal-backdrop.fade {
                                opacity: 0
                            }
                            .modal-backdrop.show {
                                opacity: .5
                            }
                            .modal-header {
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-align: start;
                                -ms-flex-align: start;
                                align-items: flex-start;
                                -webkit-box-pack: justify;
                                -ms-flex-pack: justify;
                                justify-content: space-between;
                                padding: 1rem;
                                border-bottom: 1px solid #e9ecef;
                                border-top-left-radius: .3rem;
                                border-top-right-radius: .3rem
                            }
                            .modal-header .close {
                                padding: 1rem;
                                margin: -1rem -1rem -1rem auto
                            }
                            .modal-title {
                                margin-top: 0;
                                margin-bottom: 0;
                                line-height: 1.5;
                                text-align: center; 
                            }
                            .modal-body {
                                position: relative;
                                -webkit-box-flex: 1;
                                -ms-flex: 1 1 auto;
                                flex: 1 1 auto;
                                padding: 0 1rem 1rem 1rem;
                            }
                            .modal-footer {
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-align: center;
                                -ms-flex-align: center;
                                align-items: center;
                                -webkit-box-pack: end;
                                -ms-flex-pack: end;
                                justify-content: flex-end;
                                padding: 1rem;
                                border-top: 1px solid #e9ecef
                            }
                            .modal-footer>:not(:first-child) {
                                margin-left: .25rem
                            }
                            .modal-footer>:not(:last-child) {
                                margin-right: .25rem
                            }
                            .modal-scrollbar-measure {
                                position: absolute;
                                top: -9999px;
                                width: 50px;
                                height: 50px;
                                overflow: scroll
                            }
                            @media (min-width: 576px) {
                                .modal-dialog {
                                    max-width: 500px;
                                    margin: 1.75rem auto
                                }
                                .modal-dialog-centered {
                                    min-height: calc(100% - (1.75rem * 2))
                                }
                                .modal-sm {
                                    max-width: 300px
                                }
                            }
                            .chat-user-card {
                                background:${color};
                                min-width: 600px;
                                max-width: 600px;
                                min-height: 500px;
                                margin: auto;
                                border-radius: 5px;
                                padding: 20px;
                            }
                            .card-inner {
                                display: flex;
                                flex-direction: column;
                                gap: 10px;
                                justify-content: space-between;
                                align-items: center;
                                text-align: center;
                            }
                            p {
                                font-size: 14px;
                            }
                            .title {
                                font-size: 24px;
                            }
                            .btn{
                                padding: 10px;
                                border: 0;
                                box-shadow: none;
                                outline: none;
                                border-radius: 5px;
                                padding: 10px 15px !important;
                                font-size: 14px !important;
                                display: inline-flex !important;
                                align-items: center;
                                justify-content: center;
                                border-color: transparent;
                                border-radius: 5px !important;
                                gap: 5px;
                                font-weight: 500;
                                color: var(--text-primary);
                                cursor: pointer;
                            }
                            .chat-type-box{
                                padding: 20px 0;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                gap: 10px;
                            }
                            .form-control {
                                display: block;
                                width: 100%;
                                padding: .375rem .75rem;
                                font-size: 1rem;
                                line-height: 1.5;
                                color: #495057;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid #ced4da;
                                border-radius: .25rem;
                                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out
                            }
                            .form-control::-ms-expand {
                                background-color: transparent;
                                border: 0
                            }
                            #leadForm{
                                display: flex; 
                                flex-direction: column;
                                gap: 20px;
                            }
                            .modal .modal-content{
                                transform: translateY(-100px) scale(1);
                                transition: 0.5s;
                            }
                            label{
                                display: block;
                                margin-bottom: 5px;
                            }
                            .modal-footer{
                                justify-content: center;
                            }
                            .powered-by{
                                display: flex;
                                align-items: center;
                                gap: 10px;
                            }
                            .close{
                                border: 0;
                                outline: 0;
                                background: transparent;
                                font-size: 2rem;
                            }
                            .modal-header i{
                                font-size: 20px; 
                                color: var(--theme-color);
                            }
                            .modal-header{
                                padding: 20px 20px 0 20px ;
                            }
                            .modal::before{
                                content: '';
                                position: absolute;
                                top: 0;
                                left: 0;
                                background: rgba(0, 0, 0, .8);
                                width: 100%;
                                height: 100%;
                            }
                            .modal.show-modal{
                                opacity: 1;
                                visibility: visible;
                                pointer-events: all;
                                transform: scale(1);
                            }
                            .modal.show-modal .modal-content{
                                transform: translateY(0) scale(1);
                            }   
                            .justify-txt{
                                text-align:justify;
                                line-height: 22px;
                                margin-top: 0px;
                                margin-bottom: 0px;
                            }
                            #start-over{
                                margin:15px 0px;
                            }
                            .pagination {
                                color : #cccccc;
                                display: inline-flex;
                                align-items: center; 
                                gap: 10px;
                                margin-right: 20px
                            }
                            .pagination i{
                                margin: 0px; 
                                
                            }                            
                            .message .reciver-text{
                                display: block;                             
                            }
                            .message .reciver-text .reciver{
                                display: block;                             
                            }
                            .chat-icons{
                                display: inline-flex!important;
                                align-items: center;
                                margin-top: 10px;
                                gap: 25px;
                            }
                            .chat-icons img{
                                opacity: 0.3;
                                width: 20;
                                object-fit: contain;
                            }
                            .chat-icons *{
                                margin: 0 !important;
                            }
                            .form-control.style-2:focus,
                            .form-control.style-2.form-control.style-2.form-control.style-2{
                                background: var(--theme-bg2) !important;
                                border: 0!important;
                                border-bottom: 1px solid var(--white-color)!important;
                            }
                            .reaction-box{
                                list-style: none;
                                display: flex;
                                justify-content: center;
                                gap: 20px;
                                align-items: center;
                                padding: 0;
                            }
                            ul.reaction-box li{
                                opacity: 0.5;
                                transition: 0.4s
                            }
                            ul.reaction-box li.active, ul.reaction-box li:hover{
                                opacity: 1;
                                scale: 1.2
                            }
                            #feedback_error{
                                margin-top: 10px;
                                margin-bottom: 10px;
                                color:red;
                            }
                            #feedback{
                                margin-top: 20px;
                            }
                        </style>
                        
                        <section class="chat-user-card ${chatbot_class[0]}">                            
                            <div class="card-inner d-flex flex-column gap-3 align-items-center justify-content-center">
                                <div class="media">
                                    <img src="${assistant_image}" width='50' class='d-block img-fluid' style='border-radius:50%;' alt="">
                                </div>
                                <div class="content" style='margion-top:-25px !important;'>
                                    <h3 class="title">${txt}</h3>
                                    <p>${prompt_description}</p>
                                </div>
                            </div>                           
                            
                            
                            <div class="row ques-boxes" id="chatbot_ques">
                                <button class="ques-box p-3 border" data-toggle="modal" data-target="#formLead">
                                    <div class="" id="ques">Hello, How can i help you ?</div>
                                </button>
                            </div> 
                            <div class="chat-area w-100" id='messages'>
                                <!--<div class="chatbox-chat reciver">
                                    <span class="text" style="display:none" id="welcome_message">${welcome_message}</span> 
                                </div> -->     
                            </div>
                            <div id="loader" style="display:none">
                                <!-- <div>
                                <img src="${assistant_image}" width='50'/>
                                </div> -->
                                <div class="msg-wrapper"   style="background-color:${botbackground_color};">

                                    <div class = "loader_msg1" id="loader_msg1" >Analyzing data</div>
                                    <div class = "loader_msg2" id="loader_msg2" style="display:none" >Optimizing response</div>
                                    <div class = "loader_msg3" id="loader_msg3" style="display:none" >Preparing insights</div>
                                    <div class="blue ball"   style="width: 4px; height: 4px; background-color:${bottext_color}"></div>
                                    <div class="red ball"    style="width: 4px; height: 4px; background-color:${bottext_color}"></div>  
                                    <div class="yellow ball" style="width: 4px; height: 4px; background-color:${bottext_color}"></div>  
                                </div>
                            </div>
                            
                            ${qhtml}
                            <div class="chat-type-box" id="chat-type-box">
                                <div class="text-center mb20">
                                    <button class="btn reset" id="start-over" style="display :none !important;">
                                        <i class="fa-solid fa-rotate-right"></i>
                                        Start Over
                                    </button>
                                    <!-- <button class="btn openFeedBack reset" id="openFeedBack" data-toggle="modal" data-target="#feedbackmodal" id="abc123">
                                        Feedback
                                    </button> -->
                                </div>
                                <div class="typing-box" id='chat-input'>
                                    <!-- <form class='chat-input' onsubmit='return false;'> -->
                                        <input type='text' autocomplete='on' placeholder='${prompt_place_holder_text}' id='input' />
                                        <button id='send'>
                                            <i class="fa-solid text-dark fa-paper-plane"></i>
                                        </button>
                                    <!-- </form> -->
                                </div>
                                    <p class="">${prompt_notice_message}</p>
                                    <img class="chatbot_footer" src="${chatbot_footer}" style="display:none"/>                                    
                                <div id="footer" class="footer">
                                </div>
                            </div>                            
                        </section>

                        <div id="copyPopup">
                            <i class="fa-solid fa-check"></i> Response copied to clipboard!
                        </div>`;

            if(prompt_is_show_lead_form == 1){                        
                htmlData += `<div class="modal" id="formLead">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border:0">
                                            <input type="hidden" id="click_index" />
                                            <button type="button" class="close closeModal closeLeadModal" style="color: var(--theme-text-color)">
                                            <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="modal-title" id="formLeadLabel">Get Started</h2>
                                            <div id="leadForm">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Name</label>
                                                    <input type="text" id="name" class="form-control style-2" placeholder="Enter Your Name">
                                                    <span id="name_error"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Email</label>
                                                    <input type="text" id="email" class="form-control style-2" placeholder="Enter Your Email">
                                                    <span id="email_error"></span>
                                                </div>
                                                <div style="text-align: center">
                                                    <input type="button" id="lead" class="btn btn-primary px-5" value="Submit" style="display: inline-block !important; color: #fff; background-color:var(--white-color); width: auto;padding: 10px 40px !important;!i;!;margin: auto;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="footerLead" class="footer">
                                            </div>
                                            <!-- <div class="chatbox-poweredby w-100 text-center">
                                                <div class="powered-by">Powered by 
                                                    <span>
                                                        <img src="https://www.aivideobuilderfx.in/app/chat/chatbot_footer.png" style="width: 100%; height: 24px;">
                                                    </span>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            }
            if(prompt_is_show_feedback_form == 1){
                htmlData +=`<div class="modal" id="feedbackmodal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border:0">
                                            <input type="hidden" id="click_index" />
                                            <button type="button" class="close closeModal closeFeedbackModal" style="color: var(--theme-text-color)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="modal-title" id="feedbackmodalLabel">Share Your Experience with Us</h2>
                                            <ul class="reaction-box">
                                                <li value="1"><img src="${baseUrl}chat/emoji1.png" /></li>
                                                <li value="2"><img src="${baseUrl}chat/emoji2.png" /></li>
                                                <li value="3" class="active"><img src="${baseUrl}chat/emoji3.png" /></li>
                                                <li value="4"><img src="${baseUrl}chat/emoji4.png" /></li>
                                                <li value="5"><img src="${baseUrl}chat/emoji5.png" /></li>
                                            </ul>
                                            <div id="feedbackmodalForm">
                                                <div class="form-group">
                                                    <textarea id="feedbackMessage" class="form-control style-2" style="height: 104px !important" placeholder="Enter Your Message Here"></textarea>
                                                    <span id="feedback_error"></span>
                                                </div>
                                                <div style="text-align: center">
                                                    <input type="button" id="feedback" class="btn btn-primary px-5" value="Submit" style="display: inline-block !important; color: #fff; background-color:var(--white-color); width: auto;padding: 10px 40px !important;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="footerFeedback" class="footer">
                                            </div>
                                            <!-- <div class="chatbox-poweredby w-100 text-center">
                                                <div class="powered-by">Powered by 
                                                    <span>
                                                        <img src="https://www.aivideobuilderfx.in/app/chat/chatbot_footer.png" style="width: 100%; height: 24px;">
                                                    </span>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            }

            //document.body.innerHTML += htmlData;
            let copilot = document.getElementById("u9sst8htz0xhrrds");            
            copilot.innerHTML += htmlData;
            
            let delayTime = prompt_time_delay_close*1000; 
            let startTime=getTimeMilli();
            const type = 'chatgpt';
            const section = document.querySelector('section');
            const messages = document.getElementById('messages');
            const input = document.getElementById('input');
            const typingBox = document.getElementById('chat-input');
            const send = document.getElementById('send');
            const startOver = document.getElementById("start-over")
            const ai = document.querySelector('input[name="ai"]:checked');
            const gptimg = "<img src=" + assistant_image + " width='50'  style='height: 50px; margin-right: 15px;'/>";
            const img = "<img src=" + baseUrl + "chat/default-user.png width='50' style='margin-left: 15px;'/>";
            const generate_script = document.getElementById('generate_script');
            const colorDivs = document.getElementsByClassName('colorDivs');
            const footer = document.getElementById('footer');
            const footerLead = document.getElementById('footerLead');
            const footerFeedback = document.getElementById('footerFeedback');

            if (text_labeling_check == 0) {
                footer.innerHTML = `<p style="margin: 0; display: flex; justify-content: center; align-items: centerl gap: 10px" >
                                        Powerd By Tarun Gpt Apps Engine <img src="${chatbot_footer}" style="width: 90px; margin-left: 10px; object-fit: contain;">
                                    </p>`;
                if(footerFeedback){
                    footerLead.innerHTML = footer.innerHTML;
                }
                if(footerFeedback){
                    footerFeedback.innerHTML = footer.innerHTML;
                }
            } else if (text_labeling_check == 1) {
                footer.innerHTML = `<a href="${footer_redirect_url}" target="_blank" style="text-decoration:none; font-size:${fontsize}; color:${fontcolor}; margin: 0; display: flex; justify-content: center; align-items: centerl gap: 10px" >${chatbot_footer}</a>`;
                if(footerFeedback){
                    footerLead.innerHTML = footer.innerHTML;
                }
                if(footerFeedback){
                    footerFeedback.innerHTML = footer.innerHTML;
                }
            }
            // document.getElementById("chat-type-box").style.display = "block";
            // document.getElementById("start-over").style.display = "none"; 
            messages.style.display = "none";

            var html1 = '';
            let chatbot_ques = document.getElementById('chatbot_ques');

            for (var i = 0; i < chatbot_question.length; i++) {
                html1 += `  <button  class="ques-box p-3 border" data-toggle="modal" id="abc${i}" style="background-color:${userbackground_color};color:${usertext_color}">
                                <div data-value="${chatbot_question[i]['question']}" id="ques_${i}" class="ques">${chatbot_question[i]['question']}</div>
                                <div data-value="${chatbot_question[i]['response']}"  id="res_${i}" class="res" style="display:none"></div><br>
                            </button>`;
                console.log(chatbot_question[i]['question']);
            }

            chatbot_ques.innerHTML = html1;

            var LeadForm = document.getElementById('formLead');
            var closeLeadModal = document.querySelector('.closeLeadModal');
            var feedbackmodal = document.getElementById('feedbackmodal');
            var closeFeedbackModal = document.querySelector('.closeFeedbackModal');
            const buttons = document.querySelectorAll('.ques-box');

            buttons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    showResult(index);
                });
            });
            
            function showResult(id) {
                if(LeadForm){
                    if (!localStorage.getItem("visitor_form_id")) {
                        LeadForm.classList.add('show-modal');
                        document.getElementById("click_index").value = id;
                    }else {
                        sResult(id);                   
                    }
                } else {
                    sResult(id);                   
                }
            }
            function sResult(id){
                document.getElementById("chatbot_ques").style.display = "none";
                    messages.style.display = "block";
                    startOver.setAttribute('style', "display:inline !important;");
                    var questionDiv = document.getElementById("ques_" + id);
                    var questionValue = questionDiv.getAttribute('data-value');
                    var sender_id = addMessage(img, questionValue);
                    startTime=getTimeMilli();

                    var resDiv = document.getElementById("res_" + id);
                    var resValue = resDiv.getAttribute('data-value');
                    appendBotMessage(gptimg, resValue, sender_id);
            }                    

            //Lead Form Start 
            let lead = document.getElementById("lead");
            lead.addEventListener('click', (e) => {
                e.preventDefault();
                if (document.getElementById("name").value == "") {
                    document.getElementById("name_error").innerHTML = "Enter Name*";
                }
                if (document.getElementById("email").value == "") {
                    document.getElementById("email_error").innerHTML = "Enter Email*";
                }
                if (document.getElementById("email").value != "" && document.getElementById("name").value != "") {
                    if (document.querySelector('.modal-backdrop')) {
                        document.querySelector('.modal-backdrop').style.display = "none";
                        document.querySelector('.modal-backdrop').style.position = "";
                        document.body.classList.remove('modal-open');
                    }
                    var id = document.getElementById("click_index").value;
                    if (id != "") {
                        const questionDiv = document.getElementById("ques_" + id);
                        const questionValue = questionDiv.getAttribute('data-value');
                        var sender_id = addMessage(img, questionValue);

                        const resDiv = document.getElementById("res_" + id);
                        const resValue = resDiv.getAttribute('data-value');
                        appendBotMessage(gptimg, resValue, sender_id);
                        document.getElementById("click_index").value = "";
                        fetchData();
                    } else {
                        message = input.value;
                        document.getElementById('formLead').style.display = "none";
                        document.getElementById("chatbot_ques").style.display = "none";
                        messages.style.display = "block";
                        startOver.setAttribute('style', "display:inline !important;");
                        if (message.trim() !== '') {
                            input.value = '';
                            var sender_id = addMessage(img, message);
                            addBotMessage(gptimg, message, type, sender_id);
                        }
                    }
                    // sessionStorage.setItem("visitor_form_id", Math.floor(Math.random() * 1000000));
                    localStorage.setItem("visitor_form_id", localStorage.getItem('visitor_id'));
                }
            });
            closeLeadModal.addEventListener('click', function () {
                LeadForm.classList.remove('show-modal');
                if (document.querySelector('.modal-backdrop')) {
                    document.querySelector('.modal-backdrop').style.display = "none";
                    document.querySelector('.modal-backdrop').style.position = "";
                    document.body.classList.remove('modal-open');
                }
            });
            //Lead Form End
            
            //Feed Back Form Start
            function getTimeMilli(){
                const minute = 1000 * 60;
                const hour = minute * 60;
                const day = hour * 24;
                const year = day * 365; 
                // Divide Time with a year
                const d = new Date();
                return  Math.round(d.getTime() / year);
            }
            let feedBack = document.getElementById('feedback');
            if(feedbackmodal){
                let openFeedBack = document.getElementById('openFeedBack');
                let typingTimeout;
                function showFeedbackModal() {
                    if(!sessionStorage.getItem("visitor_feedback_id")){
                        feedbackmodal.classList.add('show-modal');
                    }
                }
                function resetTypingTimeout() {
                    clearTimeout(typingTimeout);
                    typingTimeout = setTimeout(() => {
                        showFeedbackModal();
                    }, delayTime);
                }
                document.addEventListener('click',(event) => {
                    if (!section.contains(event.target)) {
                        resetTypingTimeout(); 
                    }
                });
                document.addEventListener('scroll', () => {
                    const sectionRect = section.getBoundingClientRect();
                    if (sectionRect.top > window.innerHeight || sectionRect.bottom < 0) {
                        resetTypingTimeout();
                    }
                });
                section.addEventListener('mousemove', resetTypingTimeout);
                // section.addEventListener('keypress', resetTypingTimeout);

                // typingBox.addEventListener('input', resetTypingTimeout);

                // openFeedBack.addEventListener('click', () => {
                //     feedbackmodal.classList.add('show-modal');
                // });
                
                let selectedValue = 3;
                
                let rate = document.querySelectorAll('.reaction-box li');
                document.querySelectorAll('.reaction-box li').forEach(li => {
                    selectedValue = li.getAttribute('value');
                    li.addEventListener('click', function () {
                        rate.forEach(item => item.classList.remove('active'));
                        this.classList.add('active');
                        selectedValue = this.getAttribute('value');
                    });
                });

                closeFeedbackModal.addEventListener('click', function () {
                    feedbackmodal.classList.remove('show-modal');
                    if (document.querySelector('.modal-backdrop')) {
                        document.querySelector('.modal-backdrop').style.display = "none";
                        document.querySelector('.modal-backdrop').style.position = "";
                        document.body.classList.remove('modal-open');
                    }
                });
            
                feedBack.addEventListener('click', async function (e) {
                    e.preventDefault();
                    const message = document.getElementById('feedbackMessage').value;

                    if (!selectedValue) {
                        alert("Please select an emoji.");
                        return;
                    }

                    if (!message || message === "Enter Your Message Here") {
                        document.getElementById("feedback_error").innerHTML = "Please enter your message.*";
                        return;
                    }
                    try {
                        const message = document.getElementById('feedbackMessage').value;
                        const formData = new FormData();
                        formData.append('prompt_id', prompt_id);
                        formData.append('visitor_id', localStorage.getItem('visitor_id'));
                        formData.append('selectedValue', selectedValue);
                        formData.append('message', message);
                        const apiUrl = baseUrl + `chat/feedBack.php`;

                        const response = await fetch(apiUrl, {
                            method: 'POST',
                            body: formData
                        });

                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const json = await response.json();

                        feedbackmodal.style.display = "none";

                        // feedbackmodal.classList.remove('show-modal');
                        // messages.style.display = "block";
                        // startOver.style.display = "block";
                        send.disabled = false;
                        sessionStorage.setItem("visitor_feedback_id", localStorage.getItem('visitor_id'));
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            }
            //Feed Back Form End

            //Msg Box Start
            let message;
            send.addEventListener('click', () => {
                submitMessage();
            });

            input.addEventListener('keypress', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    submitMessage();
                }
            });

            function submitMessage() {
                if(LeadForm){
                    if (!localStorage.getItem("visitor_form_id")) {
                        LeadForm.classList.add('show-modal');
                        // document.getElementById("click_index").value=id;               
                    } else {
                        sMessage();
                    }
                }else {
                        sMessage();
                }
            }
            function sMessage(){message = input.value;
                document.getElementById("chatbot_ques").style.display = "none";
                messages.style.display = "block";
                startOver.setAttribute('style', "display:inline !important;");
                if (message.trim() !== '') {
                    input.value = '';
                    var sender_id = addMessage(img, message);
                    addBotMessage(gptimg, message, type, sender_id);
                }
            }
            //Msg Box End      

            //Start Over
            startOver.addEventListener('click', () => {
                messages.innerHTML = '';
                document.getElementById("chatbot_ques").style.display = "flex";
                startOver.setAttribute('style', "display:none !important;");
            });

            //Send Lead Using Autoresponder
            async function fetchData() {
                try {
                    const name = document.getElementById("name").value;
                    const email = document.getElementById("email").value;
                    const autoresponder = autoresponder_id;
                    const list = list_id;

                    const apiUrl = baseUrl + `autoresponder_datasender?name=${name}&email=${email}&autoresponder_id=${autoresponder}&list_id=${list}&user_id=${user_id}&prompt_id=${prompt_id}`;
                    const response = await fetch(apiUrl);

                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    const data = await response.json();

                    localStorage.setItem('unique_id', localStorage.getItem('visitor_id'));
                    document.getElementById('formLead').style.display = "none";
                    document.getElementById("chatbot_ques").style.display = "none";
                    messages.style.display = "block";
                    startOver.style.display = "block";
                    send.disabled = false;
                    // appendBotMessage(gptimg, message)

                } catch (error) {
                    console.error('Error:', error);
                }
            }

            //Show Sender Msg in Div
            function addMessage(sender, message) {
                const div = document.createElement('div');
                var randomNumber = Math.floor(Math.random() * 100) + 1;
                var dId = "sender_id_" + randomNumber;
                div.className = 'message msg-container msg-self messages';
                div.innerHTML = `<div class="chatbox-chat sender">
                                    <span class=" text" style="background-color:${userbackground_color};color:${usertext_color}">
                                        <p class="justify-txt justify-txt-sender" data-id="${dId}" data-value="${message}">${message}</p>
                                    </span>
                                </div>`;
                messages.appendChild(div);
                messages.scrollTop = messages.scrollHeight;
                if(feedbackmodal){
                    resetTypingTimeout();
                }
                return dId;
            }

            //Send Sender Msg to API
            async function addBotMessage(gptimg, message, type, sender_id) {
                const url = baseUrl + 'chat/server.php';
                const formData = new FormData();
                formData.append('prompt_id', prompt_id);
                formData.append('message', message);
                formData.append('type', type);
                formData.append('visitor_id', localStorage.getItem('visitor_id'));
                formData.append('user_id', user_id);
                formData.append('app', localStorage.getItem('visitor_id'));

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const json = await response.json();
                    sendCurlrequest(json.id, message, type, sender_id);
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            //Get Response From API
            async function sendCurlrequest(id, message, type, sender_id) {
                document.getElementById("loader").style.display = 'inline-flex';
                setTimeout(function(){
                    document.getElementById('loader_msg1').style.display = "none";
                    document.getElementById('loader_msg2').style.display = "inline-flex";
                    setTimeout(function(){
                        document.getElementById('loader_msg2').style.display = "none";
                        document.getElementById('loader_msg3').style.display = "inline-flex";
                        setTimeout(function(){
                            document.getElementById('loader_msg3').style.display = "none";
                            document.getElementById('loader_msg1').style.display = "inline-flex";
                        },1000);
                    },1000);
                },1000);
                const url = baseUrl + 'chat/curl.php';
                const formData = new FormData();
                formData.append('user_id', user_id);
                formData.append('business_id', business_id);
                formData.append('message', message);
                formData.append('type', type);
                formData.append('id', id);
                formData.append('visitor_id', localStorage.getItem('visitor_id'));
                formData.append('prompt_id', prompt_id);
                formData.append('app', localStorage.getItem('visitor_id'));

                send.disabled = true;
                input.disabled = true;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const json = await response.json();
                    startTime=getTimeMilli();
                    if (json.txt != '') {
                        setTimeout(function () {
                            appendBotMessage(gptimg, json.txt, sender_id, type);
                            document.getElementById("loader").style.display = 'none';
                        }, 1000);
                        send.disabled = false;
                        input.disabled = false;
                    } else {
                        console.log('Your credit limit excedded');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    send.disabled = false;
                    input.disabled = false;
                }
            }

            //Write Content Like Type-Writer
            var index = 0;
            var speed = 12;

            function typeWriter(text, displayId) {
                if (index < text.length) {
                    document.getElementById(displayId).innerHTML += text.charAt(index);
                    index++;
                    messages.scrollTop = messages.scrollHeight;
                    setTimeout(function () {
                        typeWriter(text, displayId);
                    }, speed);
                }
            }

            //Show Response Msg in Div
            const messagesStore = {};

            function appendBotMessage(gptimg, message, sender_id, reciverType) {
                if(feedbackmodal){
                    resetTypingTimeout();
                }
                let reciverHTML = '';
                let reciverContainer = '';
                let activeMessageEl = '';
                let divCount = '';
                var div = null;

                if (!messagesStore[sender_id]) {
                    messagesStore[sender_id] = [];
                }

                messagesStore[sender_id].push(message);


                // if (reciverType === 'regenerate') { 
                //      var ele = document.querySelector(`.reciver-text[data-id="${sender_id}"]`);  
                //      div=ele.parentElement;
                // }else{
                div = document.createElement('div');
                div.className = 'message msg-container messages';
                // } 

                var randomNumber = Math.floor(Math.random() * 100) + 1;
                var dId = "bot_id_" + randomNumber;

                let div1;

                if (reciverType === 'regenerate') {
                    div1 = document.createElement('div');
                    div1.className = 'chatbox-chat reciver';
                    reciverContainer = document.querySelector(`.reciver-text[data-id="${sender_id}"]`);
                    activeMessageEl = reciverContainer.querySelector('.active');

                    reciverHTML = `<span class="text" style="background-color:${botbackground_color};color:${bottext_color}">
                                    <p class="justify-txt" id="${dId}"></p>
                                    </span>`;

                    div1.innerHTML += reciverHTML;

                    if (activeMessageEl) {
                        activeMessageEl.classList.remove('active');
                        activeMessageEl.style.display = 'none';
                    }
                    document.getElementById("page_count_" + sender_id).innerHTML = (messagesStore[sender_id].length) + '/' + (messagesStore[sender_id].length);
                } else {
                    reciverHTML = `<div class="reciver-text" data-id="${sender_id}">
                                    <div class="chatbox-chat reciver active">
                                        <span class="text" style="background-color:${botbackground_color};color:${bottext_color}">
                                            <p class="justify-txt" id="${dId}"></p>
                                        </span>
                                    </div>
                                </div>
                                <div class="chat-icons">
                                        <div class="pagination" id="pagi_${sender_id}" data-id="${sender_id}">
                                            <i class="fa-solid fa-chevron-left" id="prev_`+ sender_id + `" title="Privious"></i> 
                                                <span id="page_count_${sender_id}">${messagesStore[sender_id].length}/${messagesStore[sender_id].length}</span> 
                                            <i class="fa-solid fa-chevron-right" id="next_`+ sender_id + `" title="Next"></i>
                                        </div>
                                        <img src="${speaker_icon}" class="stop-speak"  style="display:none;">
                                        <i class="fa-solid fa-volume-high speak-text" title="Speak"></i>
                                        <!-- <i class="fa fa-stop-circle stop-speak" title="Stop" aria-hidden="true" style="display:none;"></i> -->
                                        <i class="fa-solid fa-clone copy-respon" title="Copy"></i>
                                        <i class="fa-solid fa-rotate re-generate" data-original-id="${sender_id}" title="Re-Ganerate"></i>
                                </div>`;
                    div.innerHTML = reciverHTML;
                }

                // Copy icon event
                const copyIcon = div.querySelector('.copy-respon');
                if (copyIcon) {
                    copyIcon.addEventListener('click', () => {
                        const textarea = document.createElement('textarea');
                        const activeMessageEl = div.querySelector('.active');
                        const messageToCopy = activeMessageEl ? activeMessageEl.textContent : '';
                        textarea.value = messageToCopy.trim();
                        document.body.appendChild(textarea);
                        textarea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textarea);
                        const popup = document.getElementById('copyPopup');
                        popup.style.display = 'block';
                        setTimeout(() => {
                            popup.style.display = 'none';
                        }, 2000);
                    });
                }

                // Regenerate event
                const reGenerate = div.querySelector('.re-generate');
                if (reGenerate) {
                    reGenerate.addEventListener('click', () => {
                        const originalMessageId = reGenerate.getAttribute('data-original-id');
                        const originalMessageElement = document.querySelector(`[data-id="${originalMessageId}"]`);
                        const senderMessage = originalMessageElement ? originalMessageElement.getAttribute('data-value') : '';
                        if (senderMessage) {
                            addBotMessage(gptimg, senderMessage, 'regenerate', sender_id);
                        }
                    });
                }

                //Previous Msg Btn
                var prev = div.querySelector('#prev_' + sender_id);
                if (prev) {
                    prev.addEventListener('click', () => {
                        var total = 0;
                        var found = false;
                        const recieverDivs = div.querySelectorAll('.chatbox-chat');
                        for (var i = 0; i < recieverDivs.length; i++) {
                            if (found === false) {
                                total++;
                            }
                            if (recieverDivs[i].classList.contains('active')) {
                                found = true;
                            }
                        }
                        if (total > 1) {
                            var curr = div.querySelector('.active');
                            var prevEl = curr.previousElementSibling;
                            prevEl.classList.add('active');
                            curr.classList.remove('active');
                            prevEl.style.display = 'block';
                            curr.style.display = 'none';
                            document.getElementById("page_count_" + sender_id).innerHTML = (total - 1) + '/' + (messagesStore[sender_id].length);
                        }
                    });
                }
                //Next Msg Btn
                var next = div.querySelector('#next_' + sender_id);
                if (next) {
                    next.addEventListener('click', () => {
                        var total = 0;
                        var found = false;
                        const recieverDivs = div.querySelectorAll('.chatbox-chat');
                        for (var i = 0; i < recieverDivs.length; i++) {
                            if (found === false) {
                                total++;
                            }
                            if (recieverDivs[i].classList.contains('active')) {
                                found = true;
                            }
                        }
                        if (total < messagesStore[sender_id].length) {
                            var curr = div.querySelector('.active');
                            var nextEl = curr.nextElementSibling;
                            nextEl.classList.add('active');
                            nextEl.style.display = 'block';
                            curr.classList.remove('active');
                            curr.style.display = 'none';
                            document.getElementById("page_count_" + sender_id).innerHTML = (total + 1) + '/' + (messagesStore[sender_id].length);
                        }
                    });
                }

                if (reciverContainer) {
                    reciverContainer.appendChild(div1);
                    messages.scrollTop = messages.scrollHeight;
                    index = 0;
                    typeWriter(message, dId);
                    const paginationBtn = document.getElementById("pagi_" + sender_id);
                    paginationBtn.style.display = 'block';
                    div1.classList.add('active');
                } else {
                    messages.appendChild(div);
                    const paginationBtn = div.querySelector('.pagination');
                    paginationBtn.style.display = 'none';
                    messages.scrollTop = messages.scrollHeight;
                    index = 0;
                    typeWriter(message, dId);
                }

                const speakText = div.querySelector('.speak-text');
                const speakStop = div.querySelector('.stop-speak');

                if (speakText) {
                    speakText.addEventListener('click', () => {
                        if ('speechSynthesis' in window) {
                            const activeMessageEl = div.querySelector('.active');
                            const messageToSpeak = activeMessageEl ? activeMessageEl.textContent : '';
                            let working = new SpeechSynthesisUtterance(messageToSpeak);
                            // window.speechSynthesis.cancel();
                            working.onend = function (event) {
                                speakText.style.display = "block";
                                speakStop.style.display = "none";
                            };
                            window.speechSynthesis.speak(working);
                            speakText.style.display = "none";
                            speakStop.style.display = "block";
                        }
                        else {
                            document.write("Browser not supported")
                        }
                    })
                }
                if (speakStop) {
                    speakStop.addEventListener('click', () => {
                        const activeMessageEl = div.querySelector('.active');
                        const messageToSpeak = activeMessageEl ? activeMessageEl.textContent : '';
                        let working = new SpeechSynthesisUtterance(messageToSpeak);
                        window.speechSynthesis.cancel();
                        speakText.style.display = "block";
                        speakStop.style.display = "none";
                    })
                }

            }


            var promptHit = document.getElementsByClassName('question');
            for (var i = 0; i < promptHit.length; i++) {
                promptHit[i].addEventListener("click", function (e) {
                    var qt = e.target.getAttribute('data-qt');
                    var ans = e.target.getAttribute('data-response');
                    addMessage(img, qt);
                    document.getElementById("loader").style.display = 'inline-flex';
                    setTimeout(function () {
                        document.getElementById("loader").style.display = 'none';
                        appendBotMessage(gptimg, ans);
                    }, 3000);
                });
            }

            var linkElement = document.createElement("link");
            linkElement.rel = "stylesheet";
            linkElement.href = baseUrl + "chat/chat.css";
            document.head.appendChild(linkElement);
        }
    })();
}); 