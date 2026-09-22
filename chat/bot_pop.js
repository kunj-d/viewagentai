document.addEventListener("DOMContentLoaded", function () {

    var element_id_script_pop = document.querySelector("script[element_id_pop]"); 
    if(element_id_script_pop){
         element_id_pop = element_id_script_pop.getAttribute("element_id_pop"); 
    }
    if(!element_id_pop){
         element_id_pop = "u9sst8htz0xhrrds";
    } 
    const prompt_id_pop = document.querySelector("script[id_pop][business_id_pop]").getAttribute("id_pop");
    const user_id_pop = document.querySelector("script[user_id_pop][business_id_pop]").getAttribute("user_id_pop");
    const business_id_pop = document.querySelector("script[business_id_pop]").getAttribute("business_id_pop");
    const src_pop = document.querySelector("script[src][business_id_pop]").getAttribute("src");
    const segments_pop = src_pop.split("/chat/")[0];
    
    // const prompt_id_pop=document.querySelector("script[id]").getAttribute("id");
    // const user_id_pop=document.querySelector("script[user_id]").getAttribute("user_id");
    const aiApp_pop = "";


    // localStorage.clear("unique_id");
    // localStorage.removeItem("unique_id");
    function generateSessionId_pop() {
        let timestamp_pop = new Date().getTime(); // get current timestamp
        let random_pop = Math.floor(Math.random() * 1000000); // generate random number
        return `${timestamp_pop}-${random_pop}`; // combine timestamp and random number
    }
    if (localStorage.getItem("visitor_id_pop") === undefined || localStorage.getItem("visitor_id_pop") === "" || localStorage.getItem("visitor_id_pop") === null) {
        const unique_id_pop = localStorage.getItem("visitor_id_pop");
        localStorage.setItem("visitor_id_pop", generateSessionId_pop());
    }
    generateSessionId_pop();

    let color_pop;
    let bottext_color_pop;
    let botbackground_color_pop;
    let usertext_color_pop;
    let userbackground_color_pop;
    let prompt_theme_text_color_pop;
    let font_color_pop;
    let font_size_pop;
    let txt_pop;
    // const baseUrl_pop = "https://www.aivideobuilderfx.in/app/";
    const baseUrl_pop = segments_pop + "/";
    let assistant_image_pop;
    let chatbot_footer_pop;
    let widget_image_pop;
    let chatbot_class_pop = "";
    let qhtml_pop;
    let close_message_pop;
    let welcome_message_pop;
    let chatbot_question_pop;
    let prompt_description_pop;
    let prompt_description_head1_pop;
    let prompt_description_head2_pop;
    let prompt_place_holder_text_pop;
    let prompt_notice_message_pop;
    let text_labeling_check_pop;
    let footer_redirect_url_pop;
    let prompt_is_show_lead_form_pop;
    let prompt_is_show_feedback_form_pop;
    let prompt_time_delay_close_pop;
    let manually_form_pop;
    let msg_bot_pop = "";
    let not_active_pop = "";

    async function getStyle_pop() {
        // console.log(prompt_id_pop);
        const url_pop = baseUrl_pop + "chat/style.php";
        const formData = new FormData();
        formData.append("prompt_id", prompt_id_pop);
        formData.append("visitor_id", localStorage.getItem("visitor_id_pop"));
        formData.append("business_id", business_id_pop);
        formData.append("app", aiApp_pop);

        try {
            const response_pop = await fetch(url_pop, {
                method: "POST",
                body: formData
            });

            if (!response_pop.ok) {
                throw new Error("Network response was not ok");
            }

            const json = await response_pop.json();
            // console.log(json)
            txt_pop = json.txt;
            var maxLength = 24;
            prompt_description_pop = json.prompt_description
            if (prompt_description_pop.length > 100) {
                prompt_description_head1_pop = prompt_description_pop.slice(0, 100) + '...';
            }else{
                prompt_description_head1_pop =prompt_description_pop;
            }
            if (json.not_active) {
                not_active_pop = json.not_active
                msg_bot_pop = json.not_active;
            } else {
                qhtml_pop = json.qhtml;               
                list_id_pop = json.list_id;
                autoresponder_id_pop = json.autoresponder_id;
                widget_image_pop = json.widget_image;
                close_message_pop = json.close_message;
                welcome_message_pop = json.prompt;                
                chatbot_question_pop = json.chatbot_question;              
                prompt_place_holder_text_pop = json.prompt_place_holder_text;
                prompt_notice_message_pop = json.prompt_notice_message;
                assistant_image_pop = json.assistant_image;
                text_labeling_check_pop = json.text_labeling_check;
                footer_redirect_url_pop = json.footer_redirect_url;
                prompt_is_show_lead_form_pop = json.prompt_is_show_lead_form;
                prompt_is_show_feedback_form_pop = json.prompt_is_show_feedback_form;
                prompt_time_delay_close_pop = json.prompt_time_delay_close;
                chatbot_class_pop = json.chatbot_class;
                chatbot_footer_pop = json.chatbot_footer;
                console.log(chatbot_footer_pop);
                
                if(chatbot_class_pop == "manually"){
                    bottext_color_pop = json.bottext_color; // Assign value to color
                    botbackground_color_pop = json.botbackground_color; // Assign value to color
                    usertext_color_pop = json.usertext_color; // Assign value to color
                    userbackground_color_pop = json.userbackground_color; // Assign value to color
                    prompt_theme_text_color_pop = json.prompt_theme_text_color; // Assign value to color
                    color_pop = json.color;
                    manually_form_pop = 'manually-form';
                }else{
                    chatbot_class_pop = json.chatbot_class;
                    color_pop = "";
                    bottext_color_pop = "";
                    botbackground_color_pop = ""; 
                    usertext_color_pop = "";
                    userbackground_color_pop = ""; 
                    prompt_theme_text_color_pop = ""; 
                }
                
                const baseUrl1_pop = baseUrl_pop.split('app/')[0];
                const baseUrlImg_pop = 'https://cdn.'+baseUrl1_pop.split('.')[1] +'.'+baseUrl1_pop.split('.')[2];                    
                if(assistant_image_pop!==undefined && assistant_image_pop != '' && assistant_image_pop!=='null'  && assistant_image_pop!==null){
                    const myArray_pop = assistant_image_pop.split("/");
                    const lastWord_pop = myArray_pop[myArray_pop.length - 1];
                    if (lastWord_pop != 'default_profile.png') {
                        assistant_image_pop = baseUrlImg_pop + assistant_image_pop;
                        widget_image_pop = assistant_image_pop;
                    } else {
                        assistant_image_pop = 'https://cdn.tubeengineai.com/assets/images/default-img.png';
                        widget_image_pop =  baseUrlImg_pop + 'assets/images/widget.png';
                    }
                } else {
                    assistant_image_pop = 'https://cdn.tubeengineai.com/assets/images/default-img.png';
                    widget_image_pop =  baseUrlImg_pop + 'assets/images/widget.png';
                }

                // if(assistant_image_pop != '' || assistant_image_pop != null){
                //     widget_image_pop = json.widget_image;
                //     const widgetArray_pop = widget_image_pop.split("/");
                //     const widgetlastWord_pop = widgetArray_pop[widgetArray_pop.length - 1];

                //     if (widgetlastWord_pop != 'widget.png') {
                //         widget_image_pop = assistant_image_pop;
                //     } else {
                //         widget_image_pop =  baseUrlImg_pop + 'assets/images/widget.png';
                //     }
                // } else {
                //     widget_image_pop =  baseUrlImg_pop + 'assets/images/widget.png';
                // }

                if (text_labeling_check_pop) {
                    if (text_labeling_check_pop == 0) {
                        if (chatbot_footer_pop != null && chatbot_footer_pop != undefined) {
                            chatbot_footer_pop = baseUrl_pop + json.chatbot_footer;
                        } else {
                            chatbot_footer_pop = baseUrl_pop + "chat/chatbot_footer.png";
                        }
                    } else if (text_labeling_check_pop == 1) {
                        font_size_pop = json.fontsize;
                        font_color_pop = json.fontcolor;
                        boxcolor_pop = json.boxcolor;
                        chatbot_footer_pop = json.chatbot_footer;
                    }
                }else{
                    if(chatbot_class_pop == 'dark-theme-color'){
                        chatbot_footer_pop = baseUrl_pop + 'chat/chatbot_footer_white.png';
                    }else {
                        chatbot_footer_pop = baseUrl_pop + 'chat/chatbot_footer.png';
                    }
                }
                // console.log(chatbot_footer);
            }
        } catch (error) {
            console.error("Error:", error);
        }
    }

    (async () => {
        await getStyle_pop(); // Wait for getStyle_pop() to complete before proceeding
        var chatboxHeader = "";
        let htmlData_pop = "";
        // let copilot = document.getElementById("u9sst8htz0xhrrds");
        if (not_active_pop != null || not_active_pop != "") {
            htmlData_pop = `<h2>${msg_bot_pop}</h2>`;
            let copilot_pop = document.getElementById(element_id_pop); 
            copilot_pop.innerHTML += htmlData_pop;
        }
        if (not_active_pop == null || not_active_pop == "") {
            let speaker_icon_pop = baseUrl_pop + "chat/speaker-icon.gif";
            htmlData_pop = `<link href="${baseUrl_pop}chat/copilot_style.css" rel="stylesheet">
                        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                        <style>
                            .pop-user-card {
                                background:${color_pop} !important;
                            }
                            .chat-area {
                                display: flex;
                                overflow-y: auto;
                                flex-direction: column;
                                gap: 14px;
                                height: 100%;
                               
                                margin-top: 10px;
                            }
                            .chatboat-header{
                                justify-content: space-between;
                            }
                            .chat-boat-profile{
                                    display: flex;
                                    align-items: center;
                                    gap: 10px;
                            }
                            .chat-icons-pop i,.chat-icons-pop span {
                                color:${prompt_theme_text_color_pop};
                                opacity: 0.90;
                            }
                            /*.typing-box, .typing-box input{
                                background:${userbackground_color_pop};
                                color:${usertext_color_pop};
                            }*/
                           .typing-box-pop button {
                                color:${prompt_theme_text_color_pop};
                            }
                           .typing-box-pop button:hover {
                                color:${usertext_color_pop};
                            }

                            .card-inner .content .title{
                                font-size: 20px;
                                margin: 15px 0  5px 0;
                            }
                            .card-inner .content p{
                                font-size: 14px;
                                font-weight: 400;
                                color: var(--theme-color);
                                line-height: 20px;
                                padding: 0 5px;
                            }
                            .cross-img-first{
                                position: absolute;
                                top: 0;
                                display: flex;
                                justify-content: space-between;
                                width: 100%;
                                left: 0;
                                top: 0;
                                
                            }
                            .chatboat-header{
                                margin: -20px -20px 0 -20px;
                                position: relative;
                                padding: 15px 15px 5px 15px;
                            }
                        .header-2{
                            position: relative;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            gap: 10px;
                        }

                        .cross-img-first i,
                        .cross-img-second i{
                            font-size: 16px;
                            cursor: pointer;
                            transition: 0.2s;
                            padding: 6px;
                            color:${prompt_theme_text_color_pop};
                        }
                        .cross-img-first i{
                            padding: 20px;
                        }
                        
                        .cross-img-second{
                            display: flex;
                        }

                        .cross-img-first i:hover,
                        .cross-img-second i:hover{
                            color: ${usertext_color_pop};
                        }
                        
                        .border-head{
                            border-bottom: 1px solid var(--theme-br3)
                        }
                        .chat-user-card.expandForm-pop{
                            min-height: 90vh!important;
                            max-height: 90vh!important;
                            width: 590px !important;
                        }
                            
                        @media(max-width: 991px ){
                            .chat-user-card,
                            .chat-user-card.expandForm-pop{
                                width: 95% !important;
                                right: 10px !important;
                            }
                        }
                        .chat-area .text p{
                            margin: 0;
                        }
                        .pop-user-card{
                         transition: 0.5s;
                         transform: scale(0);
                         transform-origin: bottom right;
                        }
                         .pop-user-card.open{
                            transform: scale(1);
                         }
                        .chat-user-card.expandForm-pop .chat-area{
                            max-height: calc(100vh - 380px )!important;
                        }

                        .chat-type-box{
                            position: absolute;
                            bottom: 15px;
                            width: calc(90% + 10px);
                            left: 50%;
                            transform: translateX(-50%);
                        }

                        .ques-boxes {
                            max-height: 30%;
                            overflow-y: auto;
                        }
                        .ques-boxes-::webkit-scrollbar{
                            display: none !important;
                        }
                        #start-over-pop{
                            color:${prompt_theme_text_color_pop};
                            margin-bottom:10px;
                        }
                        /*.msg-wrapper .ball{
                            margin: 5px 2px -4px 4px;
                        }*/

                        #closedMessage_pop{
                            display: block;
                            background: var(--theme-bg2);
                            border-radius: 10px;
                            padding: 20px 10px;
                            border-radius: 10px;
                            border: 1px solid var(--theme-br3);
                            text-align: center;
                            display: block;
                            position: absolute;
                            top: 50%;
                            z-index: 1000;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            font-size: 16px;
                            line-height: 24px;
                            box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.6);
                        }
                        .modal.show-modal .manually-form{
                            background:${color_pop};
                            color:${prompt_theme_text_color_pop};
                        }
                        .leadForm .lead-sub-pop,
                        .feedBackForm .feedback-sub-pop{
                            color:${color_pop};
                            background:${prompt_theme_text_color_pop};
                        }
                        .leadForm .lead-sub-pop:hover,
                        .feedBackForm .feedback-sub-pop:hover{
                            background:${color_pop};
                            color:${prompt_theme_text_color_pop};
                            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset !important;
                        }
                        .btn.btn-dark{
                            background : var(--white-color);
                            color : var(--text-primary);
                        }
                        .comment-box{
                            transition: 0.7s;
                             transform-origin: bottom right;
                             transform: scale(0);
                        }
                        .icon-card.openBox,
                        .comment-box.openBox{
                            transform: scale(1);
                            width: auto !important;
                        }
                        .comment-box,
                        .chatbot-modal-content{
                        width: 100% !important;
                            position: static !important;
                        }
                        .icon-card{
                            cursor: pointer;
                            display: flex;
                            position: fixed;
                            bottom: 20px;
                            flex-row: row-reverse;
                            right: 20px; 
                            flex-direction: row-reverse;
                            background: white;
                            padding: 10px;
                            border-radius: 50px 50px 0 50px;
                            align-items: center;
                            gap: 0px;
                            box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
                            transition: 0.3s;
                            z-index: 998;
                        }
                        .icon-card:hover{
                            transform: scale(0.98);
                        }
                        .chatbot-heading{
                         margin: 0 !important;
                         box-shadow: none;
                         border: none;
                         margin-left: 10px;
                         background: transparent !important;
                         width: auto; 
                        }
                        .chatbot-close-button{
                            position: absolute;
                            top: 10px;
                            background: transparent;
                            box-shadow: none;
                            right: 20px;
                        }
                        .chat-user-detail .content .title{
                            font-size: 16px;
                        }
                        .close-btns-flex{
                        display: flex;
                        gap: 10px;
                        justify-content:center;
                        }

                        #loader_pop .msg-wrapper{
                            border-radius: 10px 10px 10px 0;    
                        }
                    </style>
                        <section class="chat-user-card pop-user-card ${chatbot_class_pop}" id="chatbox_pop">
                            <div class="chatboat-header border-head">
                                <div class="header-1">
                                    <div class="card-inner">
                                        <div class="media">
                                            <img src="${assistant_image_pop}" width="50" class="d-block img-fluid" style="border-radius:50%;" alt="">
                                        </div>
                                        <div class="content" style="margion-top:-25px !important;">
                                            <h3 class="title" style="color:${prompt_theme_text_color_pop};">${txt_pop}</h3>
                                            <p style="color:${prompt_theme_text_color_pop};">${prompt_description_head1_pop}</p>
                                        </div>
                                    </div>
                                
                                    <div class="cross-img-first">
                                        <i class="fa-solid fa-up-right-and-down-left-from-center" id="expand_head1_pop"></i>
                                        <i class="fas fa-compress-alt" id="dexpand_head1_pop" style="display:none"></i>
                                        <i class="fa-solid fa-x" id="showcloseMessage_pop"></i>
                                    </div>
                                </div>
                                <div class="header-2" style="display:none;">
                                    <div class="chat-user-detail" style="border-bottom: 0; padding: 0;">
                                        <div class="chat-boat-profile">
                                            <div class="media" style="color:${prompt_theme_text_color_pop};">
                                                <img src="${assistant_image_pop}" style="object-fit: cover">
                                            </div>
                                            <div class="content">
                                                <h5 class="title themetextcolor" style="color:${prompt_theme_text_color_pop};">${txt_pop}</h5>
                                            </div>
                                        </div> 
                                    </div> 

                                    <div class="cross-img-second">
                                        <i class="fa-solid fa-up-right-and-down-left-from-center" id="expand_head2_pop"></i>
                                        <i class="fas fa-compress-alt" id="dexpand_head2_pop" style="display:none"></i>
                                        <i class="fa-solid fa-minus" id="minimize_pop"></i>
                                        <i class="fa-solid fa-x" id="showcloseMessage1_pop"></i>
                                    </div>
                                </div>
                            </div>
							                         
                            <div id="closedMessage_pop" data-show="hide" style="display:none">
                            	${close_message_pop}
                            	<br>
                            	<br>
                                <div class="close-btns-flex">
                                    <button type="submit" class="confirm-btn btn btn-dark" id="confirm_btn_pop" value="Submit">Exit Chat</button>
                                    <button type="reset" class="cancel-btn" id="cancel-btn-pop">Cancel</button>
                                </div>
                            </div>
                            
                            <div class="ques-boxes" id="chatbot_ques_pop">
                                <button class="ques-box ques-box-pop" data-toggle="modal">
                                    <div class="" id="ques">Hello, How can i help you ?</div>
                                </button>
                            </div> 
                            <div class="chat-area  chat-area-bot" id="messages_pop">
                                <!--<div class="chatbox-chat reciver">
                                    <span class="text" style="display:none" id="welcome_message">${welcome_message_pop}</span> 
                                </div> -->     
                            </div>
                            <div id="loader_pop" class="loader-bot" style="display:none">
                                <div class="msg-wrapper"   style="background-color:${botbackground_color_pop};color:${bottext_color_pop};">
                                    <div class = "loader_msg1" id="loader_msg1_pop" >Analyzing data</div>
                                    <div class = "loader_msg2" id="loader_msg2_pop" style="display:none" >Optimizing response</div>
                                    <div class = "loader_msg3" id="loader_msg3_pop" style="display:none" >Preparing insights</div>
                                    <div class="blue ball" style="width: 2px; height: 2px;"></div>
                                    <div class="red ball" style="width: 2px; height: 2px;"></div>  
                                    <div class="yellow ball" style="width: 2px; height: 2px;"></div>  
                                </div>
                            </div>
                            
                            <div class="chat-type-box" id="chat-type-box">
                                <div class="">
                                    <button class="btn reset" id="start-over-pop" style="display :none !important;">
                                        <i class="fa-solid fa-rotate-right"></i>
                                        Start Over
                                    </button>
                                </div>
                                <div class="typing-box typing-box-pop" id="chat-input">
                                    <!-- <form class="chat-input" onsubmit="return false;"> -->
                                        <input type="text" autocomplete="on" placeholder="${prompt_place_holder_text_pop}" id="input_pop" />
                                        <button id="send_pop">
                                            <i class="fa-solid  fa-paper-plane"></i>
                                        </button>
                                    <!-- </form> -->
                                </div>
                                    <p class="" style="font-size: 14px; margin: 10px 0 5px 0; color:${prompt_theme_text_color_pop};">${prompt_notice_message_pop}</p>                                   
                                <div id="footer_pop" class="footer" style="color:${prompt_theme_text_color_pop};">
                                </div>
                            </div>                            
                        </section>

						<div class="icon-card" id="icon-card">
                            <div class="chatbot-modal">
                                <div class="chatbot-modal-content" id="chatbot_modal_box_pop">
                                    <span class="chatbot-close-button chatbot-close" id="close_chat_modal_pop"><i class="fa-solid fa-x"></i></span>
                                    <!--<h1 class="chatbot-heading" style="font-size:16px;">${welcome_message_pop}</h1>-->
                                </div>
                            </div>
                            <div class="comment-box" id="comment-box-pop" style="background-color:none">
                                <img src="${widget_image_pop}" width=30" height="30" id="showClick_pop" />
                            </div>
						</div>

                        <div id="copyPopup_pop" class="copyPopup">
                            <i class="fa-solid fa-check"></i> Response copied to clipboard!
                        </div>`;

            if(prompt_is_show_lead_form_pop == 1){                        
                htmlData_pop += `<div class="modal ${chatbot_class_pop}" id="formLead_pop" style="display:none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content ${manually_form_pop}">
                                        <div class="modal-header" style="border:0">
                                            <input type="hidden" id="click_index_pop" />
                                            <button type="button" class="close closeModal closeLeadModal" id="closeLeadModal_pop"style="color: var(--theme-text-color)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="modal-title" id="formLeadLabel">Get Started</h2>
                                            <form id="leadForm_pop" class="leadForm" action="" method="POST">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name_pop" name="name" class="form-control style-2" placeholder="Enter Your Name">
                                                    <span id="name_error_pop" style="color:red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email_pop" name="email" class="form-control style-2" placeholder="Enter Your Email">
                                                    <span id="email_error_pop" style="color:red;"></span>
                                                </div>
                                                <div style="text-align: center">
                                                    <input type="submit" class="btn btn-primary btn-submit px-5 lead-sub-pop" value="Submit" style="width: auto;padding: 10px 40px !important; margin: auto;">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="footerLead_pop" class="footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            }
            if(prompt_is_show_feedback_form_pop == 1){
                htmlData_pop +=`<div class="modal ${chatbot_class_pop}" id="feedbackmodal_pop" style="display:none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content ${manually_form_pop}">
                                            <div class="modal-header" style="border:0">
                                                <input type="hidden" id="click_index" />
                                                <button type="button" class="close closeModal closeFeedbackModal" id="closeFeedbackModal_pop" style="color: var(--theme-text-color)">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h2 class="modal-title" id="feedbackmodalLabel">Share Your Experience with Us</h2>
                                                <form  class="feedBackForm" action="" id="feedBackForm_pop" method="POST">
                                                    <ul class="reaction-box">
                                                        <li value="1"><img src="${baseUrl_pop}chat/emoji1.png" /></li>
                                                        <li value="2"><img src="${baseUrl_pop}chat/emoji2.png" /></li>
                                                        <li value="3" class="active"><img src="${baseUrl_pop}chat/emoji3.png" /></li>
                                                        <li value="4"><img src="${baseUrl_pop}chat/emoji4.png" /></li>
                                                        <li value="5"><img src="${baseUrl_pop}chat/emoji5.png" /></li>
                                                    </ul>
                                                    <div id="feedbackmodalForm">
                                                        <div class="form-group">
                                                            <textarea id="feedbackMessage" class="form-control style-2" style="height: 104px !important" placeholder="Enter Your Message Here"></textarea>
                                                            <span id="feedback_error"></span>
                                                        </div>
                                                        <div style="text-align: center">
                                                            <input type="submit" id="feedBacksubmit_pop" class="btn btn-primary btn-submit px-5 feedback-bot feedback-sub-pop" value="Submit" style="display: inline-block !important; width: auto;padding: 10px 40px !important;">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <div id="footerFeedback_pop" class="footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
            }

            /* Chat Area Height Code */

            function setDynamiChatHeight(loaderHeight = 5) {
                setTimeout(() => {
                    const parentElem = document.querySelector('.chat-user-card');
                    const chatHeader = document.querySelector('.chatboat-header');
                    const chattypeBox = document.querySelector('.chat-type-box');
                    const mainChatArea = document.querySelector('.chat-area');

                    console.log(parentElem.clientHeight , chatHeader.clientHeight , chattypeBox.clientHeight)

                    mainChatArea.style.maxHeight = (parentElem && chatHeader && chattypeBox) 
                        ? `${parentElem.clientHeight - chatHeader.clientHeight - chattypeBox.clientHeight - loaderHeight}px`
                        : '250px';  
            
                    console.log(mainChatArea.style.maxHeight);
                }, 300);
            }
            
            setDynamiChatHeight();
            
           
            /* Chat Area Height Code */



            //document.body.innerHTML += htmlData_pop;
            let copilot_pop = document.getElementById(element_id_pop);
            copilot_pop.innerHTML += htmlData_pop;
            // document.body.innerHTML += htmlData;
            let delayTime_pop = prompt_time_delay_close_pop*1000;
            const type_pop = "chatgpt";
            const section_pop = document.querySelector("section");
            const messages_pop = document.getElementById("messages_pop");
            const input_pop = document.getElementById("input_pop");
            const typingBox_pop = document.getElementById("chat-input");
            const send_pop = document.getElementById("send_pop");
            const startOver_pop = document.getElementById("start-over-pop")
            const ai_pop = document.querySelector("input[name='ai_pop']:checked");
            const gptimg_pop = `<img src=" + assistant_image_pop + " width="50"  style="height: 50px; margin-right: 15px;"/>`;
            const img_pop = `<img src=" + baseUrl_pop + "chat/default-user.png width="50" style="margin-left: 15px;"/>`;
            const generate_script_pop = document.getElementById("generate_script_pop");
            const colorDivs_pop = document.getElementsByClassName("colorDivs_pop");
            const commentBox_pop = document.getElementById("comment-box-pop");
            const icon_card = document.getElementById("icon-card");
            const footer_pop = document.getElementById("footer_pop");
            const footerLead_pop = document.getElementById("footerLead_pop");
            const footerFeedback_pop = document.getElementById("footerFeedback_pop");
            const chatbox_pop = document.getElementById("chatbox_pop");
            const head1_pop = document.querySelector('.header-1');
            const head2_pop = document.querySelector('.header-2');
            let lead_pop = document.getElementById("leadForm_pop");
            let feedBackForm_pop = document.getElementById("feedBackForm_pop");
            let feedBack_pop = document.getElementById("feedBacksubmit_pop");
            let minimize_pop = document.getElementById("minimize_pop");

            minimize_pop.addEventListener("click",(event) => {
                // if (!section_pop.contains(event.target) && !icon_card.contains(event.target) && !lead_pop.contains(event.target) && !feedBackForm_pop.contains(event.target)) {
                    chatbox_pop.classList.remove('open');
                    commentBox_pop.classList.add('openBox');
                    icon_card.classList.add('openBox');
                // }
            });

            if(text_labeling_check_pop){
                if (text_labeling_check_pop == 0) {
                    footer_pop.innerHTML = `<p style="color:${prompt_theme_text_color_pop}; margin: 0; display: flex; justify-content: center; align-items: center;" >
                                            Powerd By 
                                            <img src="${chatbot_footer_pop}" style="width: 89px; height: 39px; margin-left: 5px; object-fit: contain;">
                                        </p>`;
                    if(footerLead_pop){
                        footerLead_pop.innerHTML = footer_pop.innerHTML;
                    }
                    if(footerFeedback_pop){
                        footerFeedback_pop.innerHTML = footer_pop.innerHTML;
                    }
                } else if (text_labeling_check_pop == 1) {
                    footer_pop.innerHTML = `<a href="${footer_redirect_url_pop}" target="_blank" style="padding: 2px 6px; text-decoration:none; font-size:15; color:${font_color_pop}; background:${boxcolor_pop}; margin: 0; display: flex; justify-content: center; align-items: center; gap: 10px;" >${chatbot_footer_pop}</a>`;
                    if(footerLead_pop){
                        footerLead_pop.innerHTML = footer_pop.innerHTML;
                    }
                    if(footerFeedback_pop){
                        footerFeedback_pop.innerHTML = footer_pop.innerHTML;
                    }
                }
            }else{
                footer_pop.innerHTML = `<p style="margin: 0; display: flex; justify-content: center; align-items: center;" >
                                            Powerd By 
                                            <img src="${chatbot_footer_pop}" style="width: 90px; margin-left: 5px; object-fit: contain;">
                                        </p>`;
                    if(footerLead_pop){
                        footerLead_pop.innerHTML = footer_pop.innerHTML;
                    }
                    if(footerFeedback_pop){
                        footerFeedback_pop.innerHTML = footer_pop.innerHTML;
                    }
            }
            
            messages_pop.style.display = "none";
			commentBox_pop.classList.add('openBox');
            icon_card.classList.add('openBox');
			icon_card.classList.add('openBox');
			commentBox_pop.style.background = '#e0e5ee';
			document.getElementById("chatbox_pop").classList.remove('open');
			
			function hideModalContent_pop() {
				var modalContents_pop = document.getElementById("chatbot_modal_box_pop");
				modalContents_pop.style.display = "none";
			}
			var closeButtonElements_pop = document.getElementById("close_chat_modal_pop");
            closeButtonElements_pop.addEventListener("click", hideModalContent_pop);

			commentBox_pop.addEventListener("click", hideModalContent_pop);

			var expandClick_pop = document.getElementById("expand_head1_pop");
            var dexpandClick_pop = document.getElementById("dexpand_head1_pop");
            var expandClick1_pop = document.getElementById("expand_head2_pop");
            var dexpandClick1_pop = document.getElementById("dexpand_head2_pop");
            
			expandClick_pop.addEventListener("click", function () {
				chatbox_pop.classList.add('expandForm-pop');
                expandClick_pop.style.display = "none";
                dexpandClick_pop.style.display = "flex";
                expandClick1_pop.style.display = "none";
                dexpandClick1_pop.style.display = "inline-flex";
			});
			
			dexpandClick_pop.addEventListener("click", function () {
				chatbox_pop.classList.remove('expandForm-pop');
                expandClick_pop.style.display = "flex";
                dexpandClick_pop.style.display = "none";
                expandClick1_pop.style.display = "inline-flex";
                dexpandClick1_pop.style.display = "none";
			});

			
			expandClick1_pop.addEventListener("click", function () {
				chatbox_pop.classList.add('expandForm-pop');
                expandClick1_pop.style.display = "none";
                dexpandClick1_pop.style.display = "inline-flex";
                expandClick_pop.style.display = "none";
                dexpandClick_pop.style.display = "flex";
			});
			
			dexpandClick1_pop.addEventListener("click", function () {
				chatbox_pop.classList.remove('expandForm-pop');
                expandClick1_pop.style.display = "inline-flex";
                dexpandClick1_pop.style.display = "none";
                expandClick_pop.style.display = "flex";
                dexpandClick_pop.style.display = "none";
			});

			var closeMessage_pop = document.getElementById("showcloseMessage_pop");
			closeMessage_pop.addEventListener("click", function () {
					document.getElementById("chatbox_pop").classList.remove('open');
					commentBox_pop.classList.add('openBox');
                    icon_card.classList.add('openBox');
			});
			var closeMessage1_pop = document.getElementById("showcloseMessage1_pop");
			closeMessage1_pop.addEventListener("click", function () {
				if (document.getElementById("closedMessage_pop").getAttribute("show") == "show") {
					document.getElementById("closedMessage_pop").style.display = "block";
				} else {
					document.getElementById("chatbox_pop").classList.remove('open');
					commentBox_pop.classList.add('openBox');
                    icon_card.classList.add('openBox');
				}
			});
			
			var cancelBtn_pop = document.getElementById("cancel-btn-pop");
			cancelBtn_pop.addEventListener("click", function () {
				document.getElementById("closedMessage_pop").style.display = "none";
			});
			var showClick_pop = document.getElementById("showClick_pop");
				showClick_pop.addEventListener("click", function () {
				document.getElementById("chatbox_pop").classList.add('open');
				commentBox_pop.classList.remove('openBox');
                icon_card.classList.remove('openBox');
                
			});

            var html1_pop = "";
            let chatbot_ques_pop = document.getElementById("chatbot_ques_pop");

            for (var i = 0; i < chatbot_question_pop.length; i++) {
                html1_pop += `  <button  class="ques-box ques-box-pop" data-toggle="modal" id="abc_${i}" style="background-color:${userbackground_color_pop};color:${usertext_color_pop}">
                                <div data-value-ques-pop="${chatbot_question_pop[i]["question"]}" id="ques_pop_${i}" class="ques">${chatbot_question_pop[i]["question"]}</div>
                                <div data-value-res-pop="${chatbot_question_pop[i]["response"]}"  id="res_pop_${i}" class="res" style="display:none"></div><br>
                            </button>`;
                // console.log(chatbot_question[i]["question"]);
            }

            chatbot_ques_pop.innerHTML = html1_pop;

            var LeadForm_pop = document.getElementById("formLead_pop");
            var closeLeadModal_pop = document.getElementById("closeLeadModal_pop");
            var feedbackmodal_pop = document.getElementById("feedbackmodal_pop");
            var closeFeedbackModal_pop = document.getElementById("closeFeedbackModal_pop");
            const buttons_pop = document.querySelectorAll(".ques-box-pop");

            buttons_pop.forEach((ques_box_btn_pop, index_pop) => {
                ques_box_btn_pop.addEventListener("click", () => {
                    showResult_pop(index_pop);
                    setDynamiChatHeight();
                });
            });
            
            function showResult_pop(id) {
                if(LeadForm_pop){
                    if (!localStorage.getItem("visitor_form_id_pop")) {
                        LeadForm_pop.classList.add("show-modal");
                        LeadForm_pop.style.display = "block";
                        document.getElementById("click_index_pop").value = id;
                    }else {
                        sResult_pop(id);                   
                    }
                } else {
                    sResult_pop(id);                   
                }
            }
            function sResult_pop(id){
                chatbot_ques_pop.style.display = "none";
                    messages_pop.style.display = "block";
                    startOver_pop.setAttribute("style", "display:inline !important;");
                    var questionDiv_pop = document.getElementById("ques_pop_" + id);
                    var questionValue_pop = questionDiv_pop.getAttribute("data-value-ques-pop");
                    var sender_id_pop = addMessage_pop(img_pop, questionValue_pop);

                    var resDiv_pop = document.getElementById("res_pop_" + id);
                    var resValue_pop = resDiv_pop.getAttribute("data-value-res-pop");
                    appendBotMessage_pop(gptimg_pop, resValue_pop, sender_id_pop);
            }                    

            //Lead Form Start
            if(LeadForm_pop){
                lead_pop.addEventListener('submit', (event) => {
                    event.preventDefault();

                    const name_pop = document.getElementById('name_pop').value;
                    const email_pop = document.getElementById('email_pop').value;

                    // Example basic validation
                    let isValid_pop = true;
                    if (!name_pop) {
                        document.getElementById('name_error_pop').innerText = 'Name is required';
                        isValid_pop = false;
                        setTimeout(function(){
                            document.getElementById("name_error_pop").innerHTML = "";
                        },3500);
                    } else {
                        document.getElementById('name_error_pop').innerText = '';
                    }

                    if (!email_pop) {
                        document.getElementById('email_error_pop').innerText = 'Email is required';
                        isValid_pop = false;
                        setTimeout(function(){
                            document.getElementById("email_error_pop").innerHTML = "";
                        },3500);
                    } else if (!/\S+@\S+\.\S+/.test(email_pop)) {
                        document.getElementById('email_error_pop').innerText = 'Enter a valid email';
                        isValid_pop = false;
                        setTimeout(function(){
                            document.getElementById("email_error_pop").innerHTML = "";
                        },3500);
                    } else {
                        document.getElementById('email_error_pop').innerText = '';
                    }

                    if (isValid_pop) {
                        
                            if (document.querySelector('.modal-backdrop')) {
                                document.querySelector('.modal-backdrop').style.display = "none";
                                document.querySelector('.modal-backdrop').style.position = "";
                                document.body.classList.remove('modal-open');
                            }
                            var id_pop = document.getElementById("click_index_pop").value;
                            if (id_pop != "") {
                                const questionDiv_pop = document.getElementById("ques_pop_" + id_pop);
                                const questionValue_pop = questionDiv_pop.getAttribute("data-value-ques-pop");
                                var sender_id_pop = addMessage_pop(img_pop, questionValue_pop);

                                const resDiv_pop = document.getElementById("res_pop_" + id_pop);
                                const resValue_pop = resDiv_pop.getAttribute("data-value-res-pop");
                                appendBotMessage_pop(gptimg_pop, resValue_pop, sender_id_pop);
                                document.getElementById("click_index_pop").value = "";
                                fetchData_pop();
                            } else {
                                fetchData_pop();
                                message_pop = input_pop.value;
                                LeadForm_pop.style.display = "none";
                                chatbot_ques_pop.style.display = "none";
                                messages_pop.style.display = "block";
                                startOver_pop.setAttribute('style', "display:inline !important;");
                                if (message_pop.trim() !== '') {
                                    input_pop.value = '';
                                    var sender_id_pop = addMessage_pop(img_pop, message_pop);
                                    addBotMessage_pop(gptimg_pop, message_pop, type_pop, sender_id_pop);
                                }
                            }
                            localStorage.setItem("visitor_form_id_pop", localStorage.getItem('visitor_id_pop'));
                        
                        // sessionStorage.setItem("visitor_form_id_pop", Math.floor(Math.random() * 1000000));
                    }
                });
                closeLeadModal_pop.addEventListener('click', function () {
                    LeadForm_pop.classList.remove('show-modal');
                    if (document.querySelector('.modal-backdrop')) {
                        document.querySelector('.modal-backdrop').style.display = "none";
                        document.querySelector('.modal-backdrop').style.position = "";
                        document.body.classList.remove('modal-open');
                    }
                });
            }
            //Lead Form End
            
            //Msg Box Start
            let message_pop;
            send_pop.addEventListener("click", () => {
                submitMessage_pop();
            });

            input_pop.addEventListener("keypress", (event) => {
                if (event.key === "Enter") {
                    event.preventDefault();
                    submitMessage_pop();
                }
            });

            function submitMessage_pop() {
                if(LeadForm_pop){
                    if (!localStorage.getItem("visitor_form_id_pop")) {
                        LeadForm_pop.classList.add("show-modal");
                        LeadForm_pop.style.display = "block";             
                    } else {
                        sMessage_pop();
                    }
                }else {
                        sMessage_pop();
                }
            }
            function sMessage_pop(){
                message_pop = input_pop.value;
                chatbot_ques_pop.style.display = "none";
                messages_pop.style.display = "block";
                startOver_pop.setAttribute("style", "display:inline !important;");
                if (message_pop.trim() !== "") {
                    input_pop.value = "";
                    var sender_id_pop = addMessage_pop(img_pop, message_pop);
                    addBotMessage_pop(gptimg_pop, message_pop, type_pop, sender_id_pop);
                }
            }
            //Msg Box End                  

            //Send Lead Using Autoresponder
            async function fetchData_pop() {
                try {
                    const name_pop = document.getElementById("name_pop").value;
                    const email_pop = document.getElementById("email_pop").value;
                    const autoresponder_pop = autoresponder_id_pop;
                    const list_pop = list_id_pop;

                    const apiUrl_pop = baseUrl_pop + `autoresponder_datasender?name=${name_pop}&email=${email_pop}&autoresponder_id=${autoresponder_pop}&list_id=${list_pop}&user_id=${user_id_pop}&prompt_id=${prompt_id_pop}`;
                    const response_pop = await fetch(apiUrl_pop);

                    if (!response_pop.ok) {
                        throw new Error(`HTTP error! Status: ${response_pop.status}`);
                    }

                    const data = await response_pop.json();

                    localStorage.setItem("unique_id_pop", localStorage.getItem("visitor_id_pop"));
                    LeadForm_pop.style.display = "none";
                    chatbot_ques_pop.style.display = "none";
                    messages_pop.style.display = "block";
                    startOver_pop.style.display = "block";
                    send_pop.disabled = false;
                } catch (error) {
                    console.error("Error:", error);
                }
            }

            //Show Sender Msg in Div
            function addMessage_pop(sender_pop, message_pop) {
                head1_pop.style.display = "none";
                head2_pop.style.display = "flex";
                const sender_div_pop = document.createElement("div");
                var rn_sender_div_pop = Math.floor(Math.random() * 100000) + 1; //Random Number
                var dId_sender_div_pop = "sender_id_" + rn_sender_div_pop;
                sender_div_pop.className = "message msg-container msg-self messages";
                sender_div_pop.innerHTML = `<div class="chatbox-chat sender">
                                    <span class=" text" style="background-color:${userbackground_color_pop};">
                                        <p class=" justify-txt-sender" style="color:${usertext_color_pop};" data-id="${dId_sender_div_pop}" data-value="${message_pop}">${message_pop}</p>
                                    </span>
                                </div>`;
                messages_pop.appendChild(sender_div_pop);
                messages_pop.scrollTop = messages_pop.scrollHeight;
				document.getElementById("closedMessage_pop").setAttribute("show", "show");
                return dId_sender_div_pop;
            }

            //Send Sender Msg to API
            async function addBotMessage_pop(gptimg_pop, message_pop, type_pop, sender_id_pop) {
                const url_pop = baseUrl_pop + "chat/server.php";
                const formData = new FormData();
                formData.append("prompt_id", prompt_id_pop);
                formData.append("message", message_pop);
                formData.append("type", type_pop);
                formData.append("visitor_id_pop", localStorage.getItem("visitor_id_pop"));
                formData.append("user_id", user_id_pop);
                formData.append("app", localStorage.getItem("visitor_id_pop"));

                try {
                    const response_pop = await fetch(url_pop, {
                        method: "POST",
                        body: formData
                    });

                    if (!response_pop.ok) {
                        throw new Error("Network response was not ok");
                    }

                    const json_pop = await response_pop.json();
                    sendCurlrequest_pop(json_pop.id, message_pop, type_pop, sender_id_pop);
                } catch (error) {
                    console.error("Error:", error);
                }
            }

            //Get Response From API
            async function sendCurlrequest_pop(id, message_pop, type_pop, sender_id_pop) {
                document.getElementById("loader_pop").style.display = "inline-flex";
                setTimeout(function(){
                    document.getElementById("loader_msg1_pop").style.display = "none";
                    document.getElementById("loader_msg2_pop").style.display = "inline-flex";
                    setTimeout(function(){
                        document.getElementById("loader_msg2_pop").style.display = "none";
                        document.getElementById("loader_msg3_pop").style.display = "inline-flex";
                        setTimeout(function(){
                            document.getElementById("loader_msg3_pop").style.display = "none";
                            document.getElementById("loader_msg1_pop").style.display = "inline-flex";
                        },3500);
                    },2500);
                },1500);
                const url_pop = baseUrl_pop + "chat/curl.php";
                const formData = new FormData();
                formData.append("user_id", user_id_pop);
                formData.append("business_id", business_id_pop);
                formData.append("message", message_pop);
                formData.append("type", type_pop);
                formData.append("id", id);
                formData.append("visitor_id", localStorage.getItem("visitor_id_pop"));
                formData.append("prompt_id", prompt_id_pop);
                formData.append("app", localStorage.getItem("visitor_id_pop"));

                send_pop.disabled = true;
                input_pop.disabled = true;

                try {
                    const response_pop = await fetch(url_pop, {
                        method: "POST",
                        body: formData
                    });

                    if (!response_pop.ok) {
                        throw new Error("Network response was not ok");
                    }

                    const json_pop = await response_pop.json();
                    if (json_pop.txt != "") {
                        setTimeout(function () {
                            appendBotMessage_pop(gptimg_pop, json_pop.txt, sender_id_pop, type_pop);
                            document.getElementById("loader_pop").style.display = "none";
                        }, 1000);
                        send_pop.disabled = false;
                        input_pop.disabled = false;
                    } else {
                        console.log("Your credit limit excedded");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    send_pop.disabled = false;
                    input_pop.disabled = false;
                }
            }
            

            //Show Response Msg in Div
            const messagesStore_pop = {};

            function appendBotMessage_pop(gptimg_pop, message_pop, sender_id_pop, reciverType_pop) {
                
                //Feed Back Form Start                
                if(feedbackmodal_pop && (delayTime_pop >= 10000)){
                    let typingTimeout;
                    function showFeedbackModal_pop() {
                        if(!sessionStorage.getItem("visitor_feedback_id_pop")){
                            feedbackmodal_pop.classList.add("show-modal");
                            feedbackmodal_pop.style.display = "block";
                        }
                    }
                    function resetTypingTimeout_pop() {
                        clearTimeout(typingTimeout);
                        typingTimeout = setTimeout(() => {
                            showFeedbackModal_pop();
                        }, delayTime_pop);
                    }
                    document.addEventListener("click",(event) => {
                        if (!section_pop.contains(event.target)) {
                            resetTypingTimeout_pop(); 
                        }
                    });
                    document.addEventListener("scroll", () => {
                        const sectionRect = section_pop.getBoundingClientRect();
                        if (sectionRect.top > window.innerHeight || sectionRect.bottom < 0) {
                            resetTypingTimeout_pop();
                        }
                    });
                    section_pop.addEventListener("mousemove", resetTypingTimeout_pop);
                    section_pop.addEventListener("keypress", resetTypingTimeout_pop);

                    typingBox_pop.addEventListener("input", resetTypingTimeout_pop);
                    input_pop.addEventListener("input", resetTypingTimeout_pop);
                    
                    let selectedValue = 3;                    
                    let rate = document.querySelectorAll(".reaction-box li");
                    document.querySelectorAll(".reaction-box li").forEach(li => {
                        selectedValue = li.getAttribute("value");
                        li.addEventListener("click", function () {
                            rate.forEach(item => item.classList.remove("active"));
                            this.classList.add("active");
                            selectedValue = this.getAttribute("value");
                        });
                    });

                    closeFeedbackModal_pop.addEventListener("click", function () {
                        sessionStorage.setItem("visitor_feedback_id_pop", localStorage.getItem("vissitor_id_pop"));
                        feedbackmodal_pop.classList.remove("show-modal");
                        if (document.querySelector(".modal-backdrop")) {
                            document.querySelector(".modal-backdrop").style.display = "none";
                            document.querySelector(".modal-backdrop").style.position = "";
                            document.body.classList.remove("modal-open");
                        }
                    });
                
                    feedBack_pop.addEventListener("click", async function (e) {
                        e.preventDefault();
                        const message_pop = document.getElementById("feedbackMessage").value;

                        if (!selectedValue) {
                            alert("Please select an emoji.");
                            return;
                        }

                        if (!message_pop || message_pop === "Enter Your Message Here") {
                            document.getElementById("feedback_error").innerHTML = "Please enter your message.*";
                            return;
                        }
                        try {
                            const message_pop = document.getElementById("feedbackMessage").value;
                            const formData = new FormData();
                            formData.append("prompt_id", prompt_id_pop);
                            formData.append("visitor_id", localStorage.getItem("visitor_id_pop"));
                            formData.append("selectedValue", selectedValue);
                            formData.append("message", message_pop);
                            const apiUrl_pop = baseUrl_pop + `chat/feedBack.php`;

                            const response_pop = await fetch(apiUrl_pop, {
                                method: "POST",
                                body: formData
                            });

                            if (!response_pop.ok) {
                                throw new Error("Network response was not ok");
                            }

                            const json = await response_pop.json();

                            feedbackmodal_pop.style.display = "none";
                            feedbackmodal_pop.classList.remove("show-modal");
                            messages_pop.innerHTML = "";
                            messages_pop.style.display = "none";
                            chatbot_ques_pop.style.display = "flex";
                            startOver_pop.setAttribute("style", "display:none !important;");
                            speakStopf_pop();
                            head1_pop.style.display = "block";
                            head2_pop.style.display = "none";
                            send_pop.disabled = false;
                            sessionStorage.setItem("visitor_feedback_id_pop", localStorage.getItem("visitor_id_pop"));
                        } catch (error) {
                            console.error("Error:", error);
                        }
                    });
                }
                //Feed Back Form End
                if(feedbackmodal_pop){
                    resetTypingTimeout_pop();
                }

                //Write Content Like Type-Writer
                var index_pop = 0;
                var speed_pop = 12;
                function typeWriter_pop(text, displayId) {
                    if (index_pop < text.length) {
                        if(feedbackmodal_pop){
                            resetTypingTimeout_pop();
                        }
                        document.getElementById(displayId).innerHTML += text.charAt(index_pop);
                        index_pop++;
                        messages_pop.scrollTop = messages_pop.scrollHeight;
                        setTimeout(function () {
                            typeWriter_pop(text, displayId);                            
                        }, speed_pop);
                    }
                    document.getElementById("input_pop").focus();
                }
                let reciverHTML_pop = "";
                let reciverContainer_pop = "";
                let activeMessageEl_pop = "";
                var bot_div_pop = null;

                if (!messagesStore_pop[sender_id_pop]) {
                    messagesStore_pop[sender_id_pop] = [];
                }

                messagesStore_pop[sender_id_pop].push(message_pop);

                bot_div_pop = document.createElement("div");
                bot_div_pop.className = "message msg-container messages";

                var rn_bot_div_pop = Math.floor(Math.random() * 100000) + 1;//Random Number
                var dId_bot_div_pop = "bot_id_" + rn_bot_div_pop;

                let bot_div1_pop;

                if (reciverType_pop === "regenerate") {
                    bot_div1_pop = document.createElement("div");
                    bot_div1_pop.className = "chatbox-chat reciver";
                    reciverContainer_pop = document.querySelector(`.reciver-text[data-id="${sender_id_pop}"]`);
                    activeMessageEl_pop = reciverContainer_pop.querySelector(".active");

                    reciverHTML_pop = `<span class="text" style="background-color:${botbackground_color_pop};">
                                    <p class="" style="color:${bottext_color_pop};" id="${dId_bot_div_pop}"></p>
                                    </span>`;

                    bot_div1_pop.innerHTML += reciverHTML_pop;

                    if (activeMessageEl_pop) {
                        activeMessageEl_pop.classList.remove("active");
                        activeMessageEl_pop.style.display = "none";
                    }
                    document.getElementById("page_count_" + sender_id_pop).innerHTML = (messagesStore_pop[sender_id_pop].length) + "/" + (messagesStore_pop[sender_id_pop].length);
                } else {
                    reciverHTML_pop = `<div class="reciver-text" data-id="${sender_id_pop}">
                                    <div class="chatbox-chat reciver active">
                                        <span class="text" style="background-color:${botbackground_color_pop};">
                                            <p class="" style="color:${bottext_color_pop};" id="${dId_bot_div_pop}"></p>
                                        </span>
                                    </div>
                                </div>
                                <div class="chat-icons chat-icons-pop">
                                        <div class="pagination" id="pagi_${sender_id_pop}" data-id="${sender_id_pop}">
                                            <i class="fa-solid fa-chevron-left" id="prev_`+ sender_id_pop + `" title="Privious"></i> 
                                                <span id="page_count_${sender_id_pop}">${messagesStore_pop[sender_id_pop].length}/${messagesStore_pop[sender_id_pop].length}</span> 
                                            <i class="fa-solid fa-chevron-right" id="next_`+ sender_id_pop + `" title="Next"></i>
                                        </div>
                                        <img src="${speaker_icon_pop}" class="stop-speak stop-speak-pop"  style="display:none;">
                                        <i class="fa-solid fa-volume-high speak-text speak-text-pop" title="Speak"></i>
                                        <i class="fa-solid fa-clone copy-respon copy-respon-pop" title="Copy"></i>
                                        <i class="fa-solid fa-rotate re-generate re-generate-pop" data-original-id="${sender_id_pop}" title="Re-Ganerate"></i>
                                </div>`;
                    bot_div_pop.innerHTML = reciverHTML_pop;
                }

                // Copy icon event
                const copyIcon_pop = bot_div_pop.querySelector(".copy-respon-pop");
                if (copyIcon_pop) {
                    copyIcon_pop.addEventListener("click", () => {
                        const textarea_pop = document.createElement("textarea");
                        const activeMessageEl_pop = bot_div_pop.querySelector(".active");
                        const messageToCopy_pop = activeMessageEl_pop ? activeMessageEl_pop.textContent : "";
                        textarea_pop.value = messageToCopy_pop.trim();
                        document.body.appendChild(textarea_pop);
                        textarea_pop.select();
                        document.execCommand("copy");
                        document.body.removeChild(textarea_pop);
                        const popup_pop = document.getElementById("copyPopup_pop");
                        popup_pop.style.display = "block";
                        setTimeout(() => {
                            popup_pop.style.display = "none";
                        }, 2000);
                    });
                }

                // Regenerate event
                const reGenerate_pop = bot_div_pop.querySelector(".re-generate-pop");
                if (reGenerate_pop) {
                    reGenerate_pop.addEventListener("click", () => {
                        const originalMessageId_pop = reGenerate_pop.getAttribute("data-original-id");
                        const originalMessageElement_pop = document.querySelector(`[data-id="${originalMessageId_pop}"]`);
                        const senderMessage_pop = originalMessageElement_pop ? originalMessageElement_pop.getAttribute("data-value") : "";
                        if (senderMessage_pop) {
                            addBotMessage_pop(gptimg_pop, senderMessage_pop, "regenerate", sender_id_pop);
                        }
                    });
                }

                //Previous Msg Btn
                var prev_pop = bot_div_pop.querySelector("#prev_" + sender_id_pop);
                if (prev_pop) {
                    prev_pop.addEventListener("click", () => {
                        var total_pop = 0;
                        var found_pop = false;
                        const recieverDivs_pop = bot_div_pop.querySelectorAll(".chatbox-chat");
                        for (var i = 0; i < recieverDivs_pop.length; i++) {
                            if (found_pop === false) {
                                total_pop++;
                            }
                            if (recieverDivs_pop[i].classList.contains("active")) {
                                found_pop = true;
                            }
                        }
                        if (total_pop > 1) {
                            var curr_pop = bot_div_pop.querySelector(".active");
                            var prevEl_pop = curr_pop.previousElementSibling;
                            prevEl_pop.classList.add("active");
                            curr_pop.classList.remove("active");
                            prevEl_pop.style.display = "block";
                            curr_pop.style.display = "none";
                            document.getElementById("page_count_" + sender_id_pop).innerHTML = (total_pop - 1) + "/" + (messagesStore_pop[sender_id_pop].length);
                        }
                    });
                }
                //Next Msg Btn
                var next_pop = bot_div_pop.querySelector("#next_" + sender_id_pop);
                if (next_pop) {
                    next_pop.addEventListener("click", () => {
                        var total_pop = 0;
                        var found_pop = false;
                        const recieverDivs_pop = bot_div_pop.querySelectorAll(".chatbox-chat");
                        for (var i = 0; i < recieverDivs_pop.length; i++) {
                            if (found_pop === false) {
                                total_pop++;
                            }
                            if (recieverDivs_pop[i].classList.contains("active")) {
                                found_pop = true;
                            }
                        }
                        if (total_pop < messagesStore_pop[sender_id_pop].length) {
                            var curr_pop = bot_div_pop.querySelector(".active");
                            var nextEl_pop = curr_pop.nextElementSibling;
                            nextEl_pop.classList.add("active");
                            nextEl_pop.style.display = "block";
                            curr_pop.classList.remove("active");
                            curr_pop.style.display = "none";
                            document.getElementById("page_count_" + sender_id_pop).innerHTML = (total_pop + 1) + "/" + (messagesStore_pop[sender_id_pop].length);
                        }
                    });
                }

                if (reciverContainer_pop) {
                    reciverContainer_pop.appendChild(bot_div1_pop);
                    messages_pop.scrollTop = messages_pop.scrollHeight;
                    index_pop = 0;
                    typeWriter_pop(message_pop, dId_bot_div_pop);
                    const paginationBtn_pop = document.getElementById("pagi_" + sender_id_pop);
                    paginationBtn_pop.style.display = 'inline-flex';
                    bot_div1_pop.classList.add("active");
                } else {
                    messages_pop.appendChild(bot_div_pop);
                    const paginationBtn_pop = bot_div_pop.querySelector(".pagination");
                    paginationBtn_pop.style.display = "none";
                    messages_pop.scrollTop = messages_pop.scrollHeight;
                    index_pop = 0;
                    typeWriter_pop(message_pop, dId_bot_div_pop);
                }

                const speakText_pop = bot_div_pop.querySelector(".speak-text-pop");
                const speakStop_pop = bot_div_pop.querySelector(".stop-speak-pop");

                if (speakText_pop) {
                    speakText_pop.addEventListener("click", () => {
                        if ("speechSynthesis" in window) {
                            const activeMessageEl_pop = bot_div_pop.querySelector(".active");
                            const messageToSpeak_pop = activeMessageEl_pop ? activeMessageEl_pop.textContent : "";
                            let working_pop = new SpeechSynthesisUtterance(messageToSpeak_pop);
                            // window.speechSynthesis.cancel();
                            working_pop.onend = function (event) {
                                speakText_pop.style.display = "block";
                                speakStop_pop.style.display = "none";
                            };
                            window.speechSynthesis.speak(working_pop);
                            speakText_pop.style.display = "none";
                            speakStop_pop.style.display = "block";
                        }
                        else {
                            document.write("Browser not supported")
                        }
                    })
                }
                if (speakStop_pop) {
                    speakStop_pop.addEventListener("click", () => {
                        speakStopf_pop();
                    })
                }

                function speakStopf_pop(){
                    const activeMessageEl_pop = bot_div_pop.querySelector(".active");
                        const messageToSpeak_pop = activeMessageEl_pop ? activeMessageEl_pop.textContent : "";
                        let working_pop = new SpeechSynthesisUtterance(messageToSpeak_pop);
                        window.speechSynthesis.cancel();
                        speakText_pop.style.display = "block";
                        speakStop_pop.style.display = "none";
                }

                startOver_pop.addEventListener("click", () => {
                    speakStopf_pop();
                    chatbot_ques_pop.style.display = "flex";
                    startOver_pop.setAttribute("style", "display:none !important;");                    
                    head1_pop.style.display = "block";
                    head2_pop.style.display = "none";
                    messages_pop.innerHTML = "";
                    messages_pop.style.display = "none";
                });

                var confirmBtn_pop = document.getElementById("confirm_btn_pop");
			    confirmBtn_pop.addEventListener("click", function () {
                    document.getElementById("closedMessage_pop").style.display = "none";
                    // document.getElementById("chatbox_pop").style.display = "none";
                    document.getElementById("chatbox_pop").classList.remove('open');
                    // commentBox_pop.style.display = "block";
                    commentBox_pop.classList.add('openBox');
                    icon_card.classList.add('openBox');
                    messages_pop.innerHTML = "";
                    messages_pop.style.display = "none";
                    chatbot_ques_pop.style.display = "flex";
                    startOver_pop.setAttribute("style", "display:none !important;");
                    speakStopf_pop();
                    head1_pop.style.display = "block";
                    head2_pop.style.display = "none";
				// commentBox_pop.style.background = '#e0e5ee';

			    });
            }

            var linkElement_pop = document.createElement("link");
            linkElement_pop.rel = "stylesheet";
            linkElement_pop.href = baseUrl_pop + "chat/chat.css";
            document.head.appendChild(linkElement_pop);
        }
    })();
}); 