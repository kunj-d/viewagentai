document.addEventListener('DOMContentLoaded', function () {

    var element_id_script_chat = document.querySelector("script[element_id_chat]"); 
    if(element_id_script_chat){
        var element_id_chat = element_id_script_chat.getAttribute("element_id_chat"); 
    }
    if(!element_id_chat){
        var element_id_chat = "u9sst8htz0xhrrds";
    }
    const prompt_id_chat = document.querySelector('script[id_chat][business_id_chat]').getAttribute('id_chat');
    const user_id_chat = document.querySelector('script[user_id_chat][business_id_chat]').getAttribute('user_id_chat');
    const business_id_chat = document.querySelector('script[business_id_chat]').getAttribute('business_id_chat');
    const src_chat = document.querySelector('script[src][business_id_chat]').getAttribute('src');
    const segments_chat = src_chat.split('/chat/')[0];
    const aiApp = '';


    // localStorage.clear('unique_id_chat');
    // localStorage.removeItem('unique_id_chat');
    function generateSessionId_chat() {
        let timestamp = new Date().getTime(); // get current timestamp
        let random = Math.floor(Math.random() * 1000000); // generate random number
        return `${timestamp}-${random}`; // combine timestamp and random number
    }
    if (localStorage.getItem('visitor_id') === undefined || localStorage.getItem('visitor_id') === '' || localStorage.getItem('visitor_id') === null) {
        const unique_id_chat = localStorage.getItem('visitor_id');
        localStorage.setItem('visitor_id', generateSessionId_chat());
    }
    generateSessionId_chat();

    let color_chat;
    let bottext_color_chat;
    let botbackground_color_chat;
    let usertext_color_chat;
    let userbackground_color_chat;
    let prompt_theme_text_color_chat;
    let fontcolor_chat;
    let fontsize_chat;
    let txt_chat;
    // const baseUrl_chat = 'https://www.aivideobuilderfx.in/app/';
    const baseUrl_chat = segments_chat + '/';
    let assistant_image_chat;
    let chatbot_footer_chat;
    let widget_image_chat;
    let chatbot_class_chat = '';
    let welcome_message;
    let chatbot_question_chat;
    let prompt_description_chat;
    let prompt_description1_chat;
    let prompt_description2_chat;
    let prompt_place_holder_text_chat;
    let prompt_notice_message_chat;
    let text_labeling_check_chat;
    let footer_redirect_url_chat;
    let prompt_is_show_lead_form_chat;
    let prompt_time_delay_close_chat;
    let prompt_is_show_feedback_form_chat;
    let msg_bot_chat = '';
    let not_active_chat = '';

    async function getStyle_chat() {
        const url = baseUrl_chat + 'chat/style.php';
        const formData = new FormData();
        formData.append('prompt_id', prompt_id_chat);
        formData.append('visitor_id', localStorage.getItem('visitor_id'));
        formData.append('business_id', business_id_chat);
        formData.append('app', aiApp);

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const json_chat = await response.json();
            // console.log(json)
            txt_chat = json_chat.txt;
            prompt_description_chat = json_chat.prompt_description;

            if (prompt_description_chat.length > 120) {
                prompt_description1_chat = prompt_description_chat.slice(0, 120) + '...';
            }else{
                prompt_description1_chat =prompt_description_chat;
            }
            if (prompt_description_chat.length > 70) {
                prompt_description2_chat = prompt_description_chat.slice(0, 70) + '...';
            }else{
                prompt_description2_chat =prompt_description_chat;
            }
            if (json_chat.not_active) {
                not_active_chat = json_chat.not_active
                msg_bot_chat = json_chat.not_active;
            } else {
                 // Assign value to color                
                list_id_chat = json_chat.list_id;
                widget_image_chat = json_chat.widget_image;
                autoresponder_id_chat = json_chat.autoresponder_id;
                welcome_message = json_chat.prompt;                
                chatbot_question_chat = json_chat.chatbot_question                
                prompt_place_holder_text_chat = json_chat.prompt_place_holder_text
                prompt_notice_message_chat = json_chat.prompt_notice_message
                assistant_image_chat = json_chat.assistant_image;
                text_labeling_check_chat = json_chat.text_labeling_check;
                footer_redirect_url_chat = json_chat.footer_redirect_url;
                prompt_is_show_lead_form_chat = json_chat.prompt_is_show_lead_form
                prompt_is_show_feedback_form_chat = json_chat.prompt_is_show_feedback_form
                prompt_time_delay_close_chat = json_chat.prompt_time_delay_close

                chatbot_class_chat = json_chat.chatbot_class;
                
                if(chatbot_class_chat == 'manually'){
                    bottext_color_chat = json_chat.bottext_color; // Assign value to color
                    botbackground_color_chat = json_chat.botbackground_color; // Assign value to color
                    usertext_color_chat = json_chat.usertext_color; // Assign value to color
                    userbackground_color_chat = json_chat.userbackground_color; // Assign value to color
                    prompt_theme_text_color_chat = json_chat.prompt_theme_text_color; // Assign value to color
                    color_chat = json_chat.color;
                }else{
                    chatbot_class_chat = json_chat.chatbot_class;
                    color_chat = '';
                    bottext_color_chat = '';
                    botbackground_color_chat = ''; 
                    usertext_color_chat = '';
                    userbackground_color_chat = ''; 
                    prompt_theme_text_color_chat = ''; 
                }
                
                if(assistant_image_chat != null){
                    const myArray = assistant_image_chat.split("/");
                    const lastWord = myArray[myArray.length - 1];
                    if (lastWord != 'default_profile.png') {
                        const baseUrl1 = baseUrl_chat.split('app/')[0];
                        const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                        assistant_image_chat = baseUrlImg + assistant_image_chat;
                    } else {
                        assistant_image_chat = 'https://cdn.tubeengineai.com/assets/images/default-img.png';
                    }
                } else {
                    assistant_image_chat = 'https://cdn.tubeengineai.com/assets/images/default-img.png';
                }

                if(assistant_image_chat != null){
                    widget_image_chat = json_chat.widget_image;
                    const widgetArray_chat = widget_image_chat.split("/");
                    const widgetlastWord_chat = widgetArray_chat[widgetArray_chat.length - 1];

                    if (widgetlastWord_chat != 'widget.png') {
                        widget_image_chat = baseUrl_chat + json_chat.widget_image;

                    } else {
                        widget_image_chat = assistant_image_chat;
                    }
                } else {
                    widget_image_chat = assistant_image_chat;
                }
                    

                if (text_labeling_check_chat) {
                    if (text_labeling_check_chat == 0) {
                        if (json_chat.chatbot_footer != null) {
                            chatbot_footer_chat = baseUrl_chat + json_chat.chatbot_footer;
                        } else {
                            chatbot_footer_chat = baseUrl_chat + 'chat/chatbot_footer.png';
                        }
                    } else if (text_labeling_check_chat == 1) {
                        fontsize_chat = json_chat.fontsize;
                        fontcolor_chat = json_chat.fontcolor;
                        boxcolor = json_chat.boxcolor;
                        chatbot_footer_chat = json_chat.chatbot_footer;
                    }
                }else{
                    if(chatbot_class_chat == 'dark-theme-color'){
                        chatbot_footer_chat = baseUrl_chat + 'chat/chatbot_footer_white.png';
                    }else {
                        chatbot_footer_chat = baseUrl_chat + 'chat/chatbot_footer.png';
                    }
                }
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    (async () => {
        await getStyle_chat(); // Wait for getStyle() to complete before proceeding
        var chatboxHeader = '';
        let htmlData_chat = "";
        let copilot_chat = document.getElementById(element_id_chat);
        if (not_active_chat != null || not_active_chat != '') {
            htmlData_chat = `<h2>${msg_bot_chat}</h2>`;
            copilot_chat.innerHTML += htmlData_chat;
        }
        if (not_active_chat == null || not_active_chat == '') {
            let speaker_icon_chat = baseUrl_chat + 'chat/speaker-icon.gif';
            htmlData_chat = `<link href="${baseUrl_chat}chat/copilot_style.css" rel="stylesheet">
                        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                        <style>
                            .chat-user-card {
                                background:${color_chat};
                                position: relative;
                                padding-bottom: 200px;
                            }
                            .chat-area{
                            max-height: 375px;
                            margin: 10px 0;
                            }
                            .chat-icons i,.chat-icons span {
                                color:${prompt_theme_text_color_chat};
                                opacity: 0.90;
                            }
                            /*.typing-box, .typing-box input{
                                background:${userbackground_color_chat};
                                color:${usertext_color_chat};
                            }*/
                           .typing-box button {
                                color:${usertext_color_chat};
                            }
                            .ques-boxes {
                                max-height: 175px;
                                overflow-y: auto;
                            }
                            .chat-type-box{
                                position: absolute;
                                bottom: 20px;
                                width: calc(90% + 10px);
                                left: 50%;
                                transform: translateX(-50%);
                            }
                            .ques-boxes::-webkit-scrollbar{
                                display: none !important;
                            }
                             .msg-wrapper{
                                margin-top:-25px;

                             }   
                        </style>
                        <section class="chat-user-card ${chatbot_class_chat}" id="section_chat">
                                                    
                            <div class="card-inner head1" id="head1_chat">
                                <div class="media">
                                    <img src="${assistant_image_chat}" width='50' class='d-block img-fluid' style='border-radius:50%;' alt="">
                                </div>
                                <div class="content" style='margion-top:-25px !important;'>
                                    <h3 class="title" style="color:${prompt_theme_text_color_chat};">${txt_chat}</h3>
                                    <p style="color:${prompt_theme_text_color_chat};">${prompt_description1_chat}</p>
                                </div>
                            </div>
                            <div class="head2" id="head2_chat"style="display:none"> 
                                <div class="chat-user-detail">
                                    <div class="media">
                                        <img src="${assistant_image_chat}" class="img-fluid mx-auto d-block outputimage" alt="">
                                    </div>
                                    <div class="content">
                                        <h5 class="title" style="color:${prompt_theme_text_color_chat};">${txt_chat}</h5>
                                        <p class="w300" style="color:${prompt_theme_text_color_chat};">${prompt_description2_chat}</p>
                                    </div>
                                </div>
                                <div class="blank-chat-card">
                                    <!-- Add chat card content here -->
                                </div>
                            </div>

                            <div class="ques-boxes" id="chatbot_ques_chat">
                                <button class="ques-box-chat ques-box" data-toggle="modal">
                                    <div class="" id="ques">Hello, How can i help you ?</div>
                                </button>
                            </div> 
                            <div class="chat-area" id='messages_chat'>
                                <!--<div class="chatbox-chat reciver">
                                    <span class="text" style="display:none" id="welcome_message">${welcome_message}</span> 
                                </div> -->     
                            </div>
                            <div id="loader_chat" class="loader-bot" style="display:none">
                                <div class="msg-wrapper"   style="background-color:${botbackground_color_chat}; color:${bottext_color_chat}">
                                    <div class = "loader_msg1" id="loader_msg1_chat" >Analyzing data</div>
                                    <div class = "loader_msg2" id="loader_msg2_chat" style="display:none" >Optimizing response</div>
                                    <div class = "loader_msg3" id="loader_msg3_chat" style="display:none" >Preparing insights</div>
                                    <div class="blue ball" style="width: 2px; height: 2px;"></div>
                                    <div class="red ball" style="width: 2px; height: 2px;"></div>  
                                    <div class="yellow ball" style="width: 2px; height: 2px;"></div>  
                                </div>
                            </div>

                            <div class="chat-type-box" id="chat-type-box">
                                <div class=" ">
                                    <button class="btn reset" id="start-over" style="display :none !important;">
                                        <i class="fa-solid fa-rotate-right"></i>
                                        Start Over
                                    </button>
                                </div>
                                <div class="typing-box" id='chat-input'>
                                    <!-- <form class='chat-input' onsubmit='return false;'> -->
                                        <input type='text' autocomplete='on' placeholder='${prompt_place_holder_text_chat}' id='input_chat' />
                                        <button id='send_chat'>
                                            <i class="fa-solid  fa-paper-plane"></i>
                                        </button>
                                    <!-- </form> -->
                                </div>
                                    <p class="" style="margin: 10px 0 5px 0;  color:${prompt_theme_text_color_chat};">${prompt_notice_message_chat}</p>                                   
                                <div id="footer_chat" class="footer">
                                </div>
                            </div>                            
                        </section>

                        <div id="copyPopup_chat" class="copyPopup">
                            <i class="fa-solid fa-check"></i> Response copied to clipboard!
                        </div>`;

            if(prompt_is_show_lead_form_chat == 1){                        
                htmlData_chat += `<div class="modal ${chatbot_class_chat} formLead" id="formLead_chat" style="display:none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border:0">
                                            <input type="hidden" id="click_index_chat" />
                                            <button type="button" class="close closeModal closeLeadModal" id="closeLeadModal_chat" style="color: var(--theme-text-color)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="modal-title" id="formLeadLabel">Get Started</h2>
                                            <form id="leadForm_chat" class="leadForm" action="" method="POST"> <!-- Wrapped inputs in form -->
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name_chat" name="name" class="form-control style-2" placeholder="Enter Your Name" required>
                                                    <span id="name_error_chat" style="color:red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email_chat" name="email" class="form-control style-2" placeholder="Enter Your Email" required>
                                                    <span id="email_error_chat" style="color:red;"></span>
                                                </div>
                                                <div style="text-align: center">
                                                    <input type="submit" class="btn btn-primary px-5 btn-submit"  style="display: inline-block !important; color: #fff; background-color:var(--white-color); width: auto;padding: 10px 40px !important;" value="Submit">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="footerLead_chat" class="footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            }
            if(prompt_is_show_feedback_form_chat == 1){
                htmlData_chat +=`<div class="modal ${chatbot_class_chat}" id="feedbackmodal_chat" style="display:none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border:0">
                                            <button type="button" class="close closeModal closeFeedbackModal closeFeedbackModal_chat" style="color: var(--theme-text-color)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="modal-title" id="feedbackmodalLabel">Share Your Experience with Us</h2>
                                            <ul class="reaction-box">
                                                <li value="1"><img src="${baseUrl_chat}chat/emoji1.png" /></li>
                                                <li value="2"><img src="${baseUrl_chat}chat/emoji2.png" /></li>
                                                <li value="3" class="active"><img src="${baseUrl_chat}chat/emoji3.png" /></li>
                                                <li value="4"><img src="${baseUrl_chat}chat/emoji4.png" /></li>
                                                <li value="5"><img src="${baseUrl_chat}chat/emoji5.png" /></li>
                                            </ul>
                                            <div id="feedbackmodalForm">
                                                <div class="form-group">
                                                    <textarea id="feedbackMessage_chat" class="form-control style-2" style="height: 104px !important" placeholder="Enter Your Message Here"></textarea>
                                                    <span id="feedback_error_chat"></span>
                                                </div>
                                                <div style="text-align: center">
                                                    <input type="button" id="feedback_chat" class="btn btn-primary btn-submit px-5 feedback-bot" value="Submit" style="display: inline-block !important; color: #fff; background-color:var(--white-color); width: auto;padding: 10px 40px !important;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="footerFeedback_chat" class="footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            }

            //document.body.innerHTML += htmlData_chat;
            let copilot_chat = document.getElementById(element_id_chat);            
            copilot_chat.innerHTML += htmlData_chat;
            
            let delayTime_chat = prompt_time_delay_close_chat*1000;
            const type_chat = 'chatgpt';
            const section_chat = document.getElementById('section_chat');
            const messages_chat = document.getElementById('messages_chat');
            const input_chat = document.getElementById('input_chat');
            const typingBox_chat = document.getElementById('chat-input');
            const send_chat = document.getElementById('send_chat');
            const startOver_chat = document.getElementById("start-over")
            const gptimg_chat = "<img src=" + assistant_image_chat + " width='50'  style='height: 50px; margin-right: 15px;'/>";
            const img = "<img src=" + baseUrl_chat + "chat/default-user.png width='50' style='margin-left: 15px;'/>";
            const footer_chat = document.getElementById('footer_chat');
            const footerLead_chat = document.getElementById('footerLead_chat');
            const footerFeedback_chat = document.getElementById('footerFeedback_chat');
            const head1_chat = document.getElementById('head1_chat');
            const head2_chat = document.getElementById('head2_chat');
            
            if (text_labeling_check_chat) {
                if (text_labeling_check_chat == 0) {
                    footer_chat.innerHTML = `<p style="margin: 0; display: flex; justify-content: center; align-items: centerl gap: 10px" >
                                            Powerd By 
                                            <img src="${chatbot_footer_chat}" style="width: 90px; margin-left: 10px; object-fit: contain;">
                                        </p>`;
                    if(footerLead_chat){
                        footerLead_chat.innerHTML = footer_chat.innerHTML;
                    }
                    if(footerFeedback_chat){
                        footerFeedback_chat.innerHTML = footer_chat.innerHTML;
                    }
                } else if (text_labeling_check_chat == 1) {
                    footer_chat.innerHTML = `<a href="${footer_redirect_url_chat}" target="_blank" style="text-decoration:none; font-size:${fontsize_chat}; color:${fontcolor_chat}; margin: 0; display: flex; justify-content: center; align-items: centerl gap: 10px" >${chatbot_footer_chat}</a>`;
                    if(footerLead_chat){
                        footerLead_chat.innerHTML = footer_chat.innerHTML;
                    }
                    if(footerFeedback_chat){
                        footerFeedback_chat.innerHTML = footer_chat.innerHTML;
                    }
                }
            }else{
                footer_chat.innerHTML = `<p style="margin: 0; display: flex; justify-content: center; align-items: centerl gap: 10px" >
                                            Powerd By 
                                            <img src="${chatbot_footer_chat}" style="width: 90px; margin-left: 10px; object-fit: contain;">
                                        </p>`;
                if(footerLead_chat){
                    footerLead_chat.innerHTML = footer_chat.innerHTML;
                }
                if(footerFeedback_chat){
                    footerFeedback_chat.innerHTML = footer_chat.innerHTML;
                }
            }
            // document.getElementById("chat-type-box").style.display = "block";
            // document.getElementById("start-over").style.display = "none"; 
            messages_chat.style.display = "none";

            var html1_chat = '';
            let chatbot_ques_chat = document.getElementById('chatbot_ques_chat');

            for (var i = 0; i < chatbot_question_chat.length; i++) {
                html1_chat += `  <button  class="ques-box-chat ques-box" data-toggle="modal" id="abc${i}" style="background-color:${userbackground_color_chat};color:${usertext_color_chat}">
                                <div data-value="${chatbot_question_chat[i]['question']}" id="ques_chat_${i}" class="ques">${chatbot_question_chat[i]['question']}</div>
                                <div data-value="${chatbot_question_chat[i]['response']}"  id="res_chat_${i}" class="res" style="display:none"></div><br>
                            </button>`;
            }

            chatbot_ques_chat.innerHTML = html1_chat;

            var LeadForm_chat = document.getElementById('formLead_chat');
            var closeLeadModal_chat = document.getElementById('closeLeadModal_chat');
            var feedbackmodal_chat = document.getElementById('feedbackmodal_chat');
            var closeFeedbackModal_chat = document.querySelector('.closeFeedbackModal_chat');
            const buttons = document.querySelectorAll('.ques-box-chat');

            buttons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    showResult_chat(index);
                });
            });
            
            function showResult_chat(id) {
                if(LeadForm_chat){
                    if (!localStorage.getItem("visitor_form_id_chat")) {
                        LeadForm_chat.classList.add('show-modal');
                        LeadForm_chat.style.display = "block";
                        document.getElementById("click_index_chat").value = id;
                    }else {
                        sResult_chat(id);                   
                    }
                } else {
                    sResult_chat(id);                   
                }
            }
            function sResult_chat(id){
                chatbot_ques_chat.style.display = "none";
                    messages_chat.style.display = "block";
                    startOver_chat.setAttribute('style', `display:inline !important; color:${prompt_theme_text_color_chat}`);
                    var questionDiv_chat = document.getElementById("ques_chat_" + id);
                    var questionValue_chat = questionDiv_chat.getAttribute('data-value');
                    var sender_id_chat = addMessage_chat(img, questionValue_chat);

                    var resDiv_chat = document.getElementById("res_chat_" + id);
                    var resValue_chat = resDiv_chat.getAttribute('data-value');
                    appendBotMessage_chat(gptimg_chat, resValue_chat, sender_id_chat);
            } 

            //Lead Form Start 
            let lead_chat = document.getElementById("leadForm_chat");
            if(LeadForm_chat){
                lead_chat.addEventListener('submit', (event) => {
                    event.preventDefault();

                    const name_chat = document.getElementById('name_chat').value;
                    const email_chat = document.getElementById('email_chat').value;

                    // Example basic validation
                    let isValid_chat = true;
                    if (!name_chat) {
                        document.getElementById('name_error_chat').innerText = 'Name is required';
                        isValid_chat = false;
                        setTimeout(function(){
                            document.getElementById("name_error_chat").innerHTML = "";
                        },3500);
                    } else {
                        document.getElementById('name_error_chat').innerText = '';
                    }

                    if (!email_chat) {
                        document.getElementById('email_error_chat').innerText = 'Email is required';
                        isValid_chat = false;
                        setTimeout(function(){
                            document.getElementById("email_error_chat").innerHTML = "";
                        },3500);
                    } else if (!/\S+@\S+\.\S+/.test(email_chat)) {
                        document.getElementById('email_error_chat').innerText = 'Enter a valid email';
                        isValid_chat = false;
                        setTimeout(function(){
                            document.getElementById("email_error_chat").innerHTML = "";
                        },3500);
                    } else {
                        document.getElementById('email_error_chat').innerText = '';
                    }

                    if (isValid_chat) {
                        
                            if (document.querySelector('.modal-backdrop')) {
                                document.querySelector('.modal-backdrop').style.display = "none";
                                document.querySelector('.modal-backdrop').style.position = "";
                                document.body.classList.remove('modal-open');
                            }
                            var id_chat = document.getElementById("click_index_chat").value;
                            if (id_chat != "") {
                                const questionDiv_chat = document.getElementById("ques_chat_" + id_chat);
                                const questionValue_chat = questionDiv_chat.getAttribute('data-value');
                                var sender_id_chat = addMessage_chat(img, questionValue_chat);

                                const resDiv_chat = document.getElementById("res_chat_" + id_chat);
                                const resValue_chat = resDiv_chat.getAttribute('data-value');
                                appendBotMessage_chat(gptimg_chat, resValue_chat, sender_id_chat);
                                id_chat.value = "";
                                fetchData_chat();
                            } else {
                                message_chat = input_chat.value;
                                LeadForm_chat.style.display = "none";
                                chatbot_ques_chat.style.display = "none";
                                messages_chat.style.display = "block";
                                startOver_chat.setAttribute('style', `display:inline !important; color:${prompt_theme_text_color_chat}`);
                                if (message_chat.trim() !== '') {
                                    input_chat.value = '';
                                    var sender_id_chat = addMessage_chat(img, message_chat);
                                    addBotMessage_chat(gptimg_chat, message_chat, type_chat, sender_id_chat);
                                }
                            }
                            localStorage.setItem("visitor_form_id_chat", localStorage.getItem('visitor_id'));
                        
                        // sessionStorage.setItem("visitor_form_id_chat", Math.floor(Math.random() * 1000000));
                    }
                });
                closeLeadModal_chat.addEventListener('click', function () {
                    LeadForm_chat.classList.remove('show-modal');
                    if (document.querySelector('.modal-backdrop')) {
                        document.querySelector('.modal-backdrop').style.display = "none";
                        document.querySelector('.modal-backdrop').style.position = "";
                        document.body.classList.remove('modal-open');
                    }
                });
            }
            //Lead Form End
            
            //Msg Box Start
            let message_chat;
            send_chat.addEventListener('click', () => {
                submitMessage_chat();
            });

            input_chat.addEventListener('keypress', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    submitMessage_chat();
                }
            });

            function submitMessage_chat() {
                if(LeadForm_chat){
                    if (!localStorage.getItem("visitor_form_id_chat")) {
                        LeadForm_chat.classList.add('show-modal');
                        LeadForm_chat.style.display = "block";             
                    } else {
                        sMessage_chat();
                    }
                }else {
                        sMessage_chat();
                }
            }
            function sMessage_chat(){
                message_chat = input_chat.value;
                chatbot_ques_chat.style.display = "none";
                messages_chat.style.display = "block";
                startOver_chat.setAttribute('style', `display:inline !important; color:${prompt_theme_text_color_chat}`);
                if (message_chat.trim() !== '') {
                    input_chat.value = '';
                    var sender_id_chat = addMessage_chat(img, message_chat);
                    addBotMessage_chat(gptimg_chat, message_chat, type_chat, sender_id_chat);
                }
            }
            //Msg Box End            

            //Send Lead Using Autoresponder
            async function fetchData_chat() {
                try {
                    const name_chat = document.getElementById("name_chat").value;
                    const email_chat = document.getElementById("email_chat").value;
                    const autoresponder_chat = autoresponder_id_chat;
                    const list_chat = list_id_chat;

                    const apiUrl_chat = baseUrl_chat + `autoresponder_datasender?name=${name_chat}&email=${email_chat}&autoresponder_id=${autoresponder_chat}&list_id=${list_chat}&user_id=${user_id_chat}&prompt_id=${prompt_id_chat}`;
                    const response = await fetch(apiUrl_chat);

                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    const data = await response.json();

                    localStorage.setItem('unique_id_chat', localStorage.getItem('visitor_id'));
                    LeadForm_chat.style.display = "none";
                    chatbot_ques_chat.style.display = "none";
                    startOver_chat.setAttribute('style', `display:inline !important; color:${prompt_theme_text_color_chat}`);
                    messages_chat.style.display = "block";
                    send_chat.disabled = false;
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            //Show Sender Msg in Div
            function addMessage_chat(sender, message_chat) {
                head1_chat.style.display = "none";
                head2_chat.style.display = "block";
                const sender_div_chat = document.createElement('div');
                var randomNumber_chat = Math.floor(Math.random() * 100) + 1;
                var dId_sender_div_chat = "sender_id_" + randomNumber_chat;
                sender_div_chat.className = 'message msg-container msg-self messages_chat';
                sender_div_chat.innerHTML = `<div class="chatbox-chat sender">
                                    <span class=" text" style="background-color:${userbackground_color_chat};">
                                        <p class="justify-txt justify-txt-sender" style="color:${usertext_color_chat};" data-id="${dId_sender_div_chat}" data-value="${message_chat}">${message_chat}</p>
                                    </span>
                                </div>`;
                messages_chat.appendChild(sender_div_chat);
                messages_chat.scrollTop = messages_chat.scrollHeight;
                return dId_sender_div_chat;
            }

            //Send Sender Msg to API
            async function addBotMessage_chat(gptimg_chat, message_chat, type_chat, sender_id_chat) {
                message_chat = message_chat.trim();
                const url = baseUrl_chat + 'chat/server.php';
                const formData = new FormData();
                formData.append('prompt_id', prompt_id_chat);
                formData.append('message', message_chat);
                formData.append('type', type_chat);
                formData.append('visitor_id', localStorage.getItem('visitor_id'));
                formData.append('user_id', user_id_chat);
                formData.append('app', localStorage.getItem('visitor_id'));

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const json_chat = await response.json();
                    message_chat = message_chat.trim();
                    sendCurlrequest_chat(json_chat.id, message_chat, type_chat, sender_id_chat);
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            //Get Response From API
            async function sendCurlrequest_chat(id, message_chat, type_chat, sender_id_chat) {
                document.getElementById("loader_chat").style.display = 'inline-flex';
                setTimeout(function(){
                    document.getElementById('loader_msg1_chat').style.display = "none";
                    document.getElementById('loader_msg2_chat').style.display = "inline-flex";
                    setTimeout(function(){
                        document.getElementById('loader_msg2_chat').style.display = "none";
                        document.getElementById('loader_msg3_chat').style.display = "inline-flex";
                        setTimeout(function(){
                            document.getElementById('loader_msg3_chat').style.display = "none";
                            document.getElementById('loader_msg1_chat').style.display = "inline-flex";
                        },3500);
                    },2500);
                },1500);
                const url = baseUrl_chat + 'chat/curl.php';
                const formData = new FormData();
                formData.append('user_id', user_id_chat);
                formData.append('business_id', business_id_chat);
                formData.append('message', message_chat);
                formData.append('type', type_chat);
                formData.append('id', id);
                formData.append('visitor_id', localStorage.getItem('visitor_id'));
                formData.append('prompt_id', prompt_id_chat);
                formData.append('app', localStorage.getItem('visitor_id'));

                send_chat.disabled = true;
                input_chat.disabled = true;

                try {
                    const response_chat = await fetch(url, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response_chat.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const json_chat = await response_chat.json();
                    if (json_chat.txt != '') {
                        setTimeout(function () {
                            appendBotMessage_chat(gptimg_chat, json_chat.txt, sender_id_chat, type_chat);
                            document.getElementById("loader_chat").style.display = 'none';
                        }, 1000);
                        send_chat.disabled = false;
                        input_chat.disabled = false;
                    } else {
                        console.log('Your credit limit excedded');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    send_chat.disabled = false;
                    input_chat.disabled = false;
                }
            }

            //Show Response Msg in Div
            const messagesStore_chat = {};

            function appendBotMessage_chat(gptimg_chat, message_chat, sender_id_chat, reciverType_chat) {
                
                //Feed Back Form Start                
                let feedBack_chat = document.getElementById('feedback_chat');
                if(feedbackmodal_chat && delayTime_chat >= 10000){
                    let typingTimeout_chat;
                    function showFeedbackModal_chat() {
                        if(!sessionStorage.getItem("visitor_feedback_id_chat")){
                            feedbackmodal_chat.classList.add('show-modal');
                            feedbackmodal_chat.style.display = "block";
                        }
                    }
                    function resetTypingTimeout_chat() {
                        clearTimeout(typingTimeout_chat);
                        typingTimeout_chat = setTimeout(() => {
                            showFeedbackModal_chat();
                        }, delayTime_chat);
                    }
                    document.addEventListener('click',(event) => {
                        if (!section_chat.contains(event.target)) {
                            resetTypingTimeout_chat(); 
                        }
                    });
                    document.addEventListener('scroll', () => {
                        const sectionRect_chat = section_chat.getBoundingClientRect();
                        if (sectionRect_chat.top > window.innerHeight || sectionRect_chat.bottom < 0) {
                            resetTypingTimeout_chat();
                        }
                    });
                    section_chat.addEventListener('mousemove', resetTypingTimeout_chat);
                    section_chat.addEventListener('keypress', resetTypingTimeout_chat);

                    typingBox_chat.addEventListener('input', resetTypingTimeout_chat);
                    input_chat.addEventListener('input', resetTypingTimeout_chat);
                    
                    let selectedValue_chat = 3;                    
                    let rate_chat = document.querySelectorAll('.reaction-box li');
                    document.querySelectorAll('.reaction-box li').forEach(li => {
                        selectedValue_chat = li.getAttribute('value');
                        li.addEventListener('click', function () {
                            rate_chat.forEach(item => item.classList.remove('active'));
                            this.classList.add('active');
                            selectedValue_chat = this.getAttribute('value');
                        });
                    });

                    closeFeedbackModal_chat.addEventListener('click', function () {
                        feedbackmodal_chat.classList.remove('show-modal');
                        if (document.querySelector('.modal-backdrop')) {
                            document.querySelector('.modal-backdrop').style.display = "none";
                            document.querySelector('.modal-backdrop').style.position = "";
                            document.body.classList.remove('modal-open');
                        }
                    });
                
                    feedBack_chat.addEventListener('click', async function (e) {
                        e.preventDefault();
                        const message_chat = document.getElementById('feedbackMessage_chat').value;

                        if (!selectedValue_chat) {
                            alert("Please select an emoji.");
                            return;
                        }

                        if (!message_chat || message_chat === "Enter Your Message Here") {
                            document.getElementById("feedback_error_chat").innerHTML = "Please enter your message.*";
                            return;
                        }
                        try {
                            const formData = new FormData();
                            formData.append('prompt_id', prompt_id_chat);
                            formData.append('visitor_id', localStorage.getItem('visitor_id'));
                            formData.append('selectedValue', selectedValue_chat);
                            formData.append('message', message_chat);
                            const apiUrl_chat = baseUrl_chat + `chat/feedBack.php`;

                            const response_chat = await fetch(apiUrl_chat, {
                                method: 'POST',
                                body: formData
                            });

                            if (!response_chat.ok) {
                                throw new Error('Network response was not ok');
                            }

                            const json = await response_chat.json();

                            feedbackmodal_chat.style.display = "none";
                            feedbackmodal_chat.classList.remove('show-modal');
                            messages_chat.innerHTML = '';
                            messages_chat.style.display = "none";
                            chatbot_ques_chat.style.display = "flex";
                            startOver_chat.setAttribute('style', `display:inline !important; color:${prompt_theme_text_color_chat}`);
                            speakStopf_chat();
                            head1_chat.style.display = "flex";
                            head2_chat.style.display = "none";
                            send_chat.disabled = false;
                            sessionStorage.setItem("visitor_feedback_id_chat", localStorage.getItem('visitor_id'));
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    });
                }
                //Feed Back Form End
                if(feedbackmodal_chat){
                    resetTypingTimeout_chat();
                }

                //Write Content Like Type-Writer
                var index_chat = 0;
                var speed_chat = 12;
                function typeWriter_chat(text, displayId) {
                    if (index_chat < text.length) {
                        if(feedbackmodal_chat){
                            resetTypingTimeout_chat();
                        }
                        document.getElementById(displayId).innerHTML += text.charAt(index_chat);
                        index_chat++;
                        messages_chat.scrollTop = messages_chat.scrollHeight;
                        setTimeout(function () {
                            typeWriter_chat(text, displayId);
                        }, speed_chat);
                    }
                }

                let reciverHTML_chat = '';
                let reciverContainer_chat = '';
                let activeMessageEl_chat = '';
                var bot_div_chat = null;

                if (!messagesStore_chat[sender_id_chat]) {
                    messagesStore_chat[sender_id_chat] = [];
                }

                messagesStore_chat[sender_id_chat].push(message_chat);

                bot_div_chat = document.createElement('div');
                bot_div_chat.className = 'message msg-container messages';

                var randomNumber_chat = Math.floor(Math.random() * 100000) + 1; //Random Number
                var dId_bot_div_chat = "bot_id_" + randomNumber_chat;

                let bot_div1_chat;

                if (reciverType_chat === 'regenerate') {
                    bot_div1_chat = document.createElement('div');
                    bot_div1_chat.className = 'chatbox-chat reciver';
                    reciverContainer_chat = document.querySelector(`.reciver-text[data-id="${sender_id_chat}"]`);
                    activeMessageEl_chat = reciverContainer_chat.querySelector('.active');

                    reciverHTML_chat = `<span class="text" style="background-color:${botbackground_color_chat};">
                                    <p class="justify-txt"  style="color:${bottext_color_chat};" id="${dId_bot_div_chat}"></p>
                                    </span>`;

                    bot_div1_chat.innerHTML += reciverHTML_chat;

                    if (activeMessageEl_chat) {
                        activeMessageEl_chat.classList.remove('active');
                        activeMessageEl_chat.style.display = 'none';
                    }
                    document.getElementById("page_count_" + sender_id_chat).innerHTML = (messagesStore_chat[sender_id_chat].length) + '/' + (messagesStore_chat[sender_id_chat].length);
                } else {
                    reciverHTML_chat = `<div class="reciver-text" data-id="${sender_id_chat}">
                                    <div class="chatbox-chat reciver active">
                                        <span class="text" style="background-color:${botbackground_color_chat};">
                                            <p class="justify-txt" style="color:${bottext_color_chat};" id="${dId_bot_div_chat}"></p>
                                        </span>
                                    </div>
                                </div>
                                <div class="chat-icons" style="color:${prompt_theme_text_color_chat};">
                                        <div class="pagination" id="pagi_${sender_id_chat}" data-id="${sender_id_chat}">
                                            <i class="fa-solid fa-chevron-left" id="prev_`+ sender_id_chat + `" title="Privious"></i> 
                                                <span id="page_count_${sender_id_chat}">${messagesStore_chat[sender_id_chat].length}/${messagesStore_chat[sender_id_chat].length}</span> 
                                            <i class="fa-solid fa-chevron-right" id="next_`+ sender_id_chat + `" title="Next"></i>
                                        </div>
                                        <i class="stop-speak stop-speak-chat" style="display:none;"><img src="${speaker_icon_chat}"></i>
                                        <i class="fa-solid fa-volume-high speak-text speak-text-chat" title="Speak"></i>
                                        <i class="fa-solid fa-clone copy-respon copy-respon-chat" title="Copy"></i>
                                        <i class="fa-solid fa-rotate re-generate re-generate-chat" data-original-id="${sender_id_chat}" title="Re-Ganerate"></i>
                                </div>`;
                    bot_div_chat.innerHTML = reciverHTML_chat;
                }

                // Copy icon event
                const copyIcon_chat = bot_div_chat.querySelector('.copy-respon-chat');
                if (copyIcon_chat) {
                    copyIcon_chat.addEventListener('click', () => {
                        const textarea_chat = document.createElement('textarea');
                        const activeMessageEl_chat = bot_div_chat.querySelector('.active');
                        const messageToCopy_chat = activeMessageEl_chat ? activeMessageEl_chat.textContent : '';
                        textarea_chat.value = messageToCopy_chat.trim();
                        document.body.appendChild(textarea_chat);
                        textarea_chat.select();
                        document.execCommand('copy');
                        document.body.removeChild(textarea_chat);
                        const popup_chat = document.getElementById('copyPopup_chat');
                        popup_chat.style.display = 'block';
                        setTimeout(() => {
                            popup_chat.style.display = 'none';
                        }, 2000);
                    });
                }

                // Regenerate event
                const reGenerate_chat = bot_div_chat.querySelector('.re-generate-chat');
                if (reGenerate_chat) {
                    reGenerate_chat.addEventListener('click', () => {
                        const originalMessageId_chat = reGenerate_chat.getAttribute('data-original-id');
                        const originalMessageElement_chat = document.querySelector(`[data-id="${originalMessageId_chat}"]`);
                        const senderMessage_chat = originalMessageElement_chat ? originalMessageElement_chat.getAttribute('data-value') : '';
                        if (senderMessage_chat) {
                            addBotMessage_chat(gptimg_chat, senderMessage_chat, 'regenerate', sender_id_chat);
                        }
                    });
                }

                //Previous Msg Btn
                var prev_chat = bot_div_chat.querySelector('#prev_' + sender_id_chat);
                if (prev_chat) {
                    prev_chat.addEventListener('click', () => {
                        var total_chat = 0;
                        var found_chat = false;
                        const recieverDivs_chat = bot_div_chat.querySelectorAll('.chatbox-chat');
                        for (var i = 0; i < recieverDivs_chat.length; i++) {
                            if (found_chat === false) {
                                total_chat++;
                            }
                            if (recieverDivs_chat[i].classList.contains('active')) {
                                found_chat = true;
                            }
                        }
                        if (total_chat > 1) {
                            var curr_chat = bot_div_chat.querySelector('.active');
                            var prevEl_chat = curr_chat.previousElementSibling;
                            prevEl_chat.classList.add('active');
                            curr_chat.classList.remove('active');
                            prevEl_chat.style.display = 'block';
                            curr_chat.style.display = 'none';
                            document.getElementById("page_count_" + sender_id_chat).innerHTML = (total_chat - 1) + '/' + (messagesStore_chat[sender_id_chat].length);
                        }
                    });
                }
                //Next Msg Btn
                var next_chat = bot_div_chat.querySelector('#next_' + sender_id_chat);
                if (next_chat) {
                    next_chat.addEventListener('click', () => {
                        var total_chat = 0;
                        var found_chat = false;
                        const recieverDivs_chat = bot_div_chat.querySelectorAll('.chatbox-chat');
                        for (var i = 0; i < recieverDivs_chat.length; i++) {
                            if (found_chat === false) {
                                total_chat++;
                            }
                            if (recieverDivs_chat[i].classList.contains('active')) {
                                found_chat = true;
                            }
                        }
                        if (total_chat < messagesStore_chat[sender_id_chat].length) {
                            var curr_chat = bot_div_chat.querySelector('.active');
                            var nextEl_chat = curr_chat.nextElementSibling;
                            nextEl_chat.classList.add('active');
                            nextEl_chat.style.display = 'block';
                            curr_chat.classList.remove('active');
                            curr_chat.style.display = 'none';
                            document.getElementById("page_count_" + sender_id_chat).innerHTML = (total_chat + 1) + '/' + (messagesStore_chat[sender_id_chat].length);
                        }
                    });
                }

                if (reciverContainer_chat) {
                    reciverContainer_chat.appendChild(bot_div1_chat);
                    messages_chat.scrollTop = messages_chat.scrollHeight;
                    index_chat = 0;
                    typeWriter_chat(message_chat, dId_bot_div_chat);
                    const paginationBtn_chat = document.getElementById("pagi_" + sender_id_chat);
                    paginationBtn_chat.style.display = 'inline-flex';
                    bot_div1_chat.classList.add('active');
                } else {
                    messages_chat.appendChild(bot_div_chat);
                    const paginationBtn_chat = bot_div_chat.querySelector('.pagination');
                    paginationBtn_chat.style.display = 'none';
                    messages_chat.scrollTop = messages_chat.scrollHeight;
                    index_chat = 0;
                    typeWriter_chat(message_chat, dId_bot_div_chat);
                }

                const speakText_chat = bot_div_chat.querySelector('.speak-text-chat');
                const speakStop_chat = bot_div_chat.querySelector('.stop-speak-chat');

                if (speakText_chat) {
                    speakText_chat.addEventListener('click', () => {
                        if ('speechSynthesis' in window) {
                            const activeMessageEl_chat = bot_div_chat.querySelector('.active');
                            const messageToSpeak_chat = activeMessageEl_chat ? activeMessageEl_chat.textContent : '';
                            let working_chat = new SpeechSynthesisUtterance(messageToSpeak_chat);
                            // window.speechSynthesis.cancel();
                            working_chat.onend = function (event) {
                                speakText_chat.style.display = "flex";
                                speakStop_chat.style.display = "none";
                            };
                            window.speechSynthesis.speak(working_chat);
                            speakText_chat.style.display = "none";
                            speakStop_chat.style.display = "flex";
                        }
                        else {
                            document.write("Browser not supported")
                        }
                    })
                }
                if (speakStop_chat) {
                    speakStop_chat.addEventListener('click', () => {
                        speakStopf_chat();
                    })
                }

                function speakStopf_chat(){
                    const activeMessageEl_chat = bot_div_chat.querySelector('.active');
                        const messageToSpeak_chat = activeMessageEl_chat ? activeMessageEl_chat.textContent : '';
                        let working_chat = new SpeechSynthesisUtterance(messageToSpeak_chat);
                        window.speechSynthesis.cancel();
                        speakText_chat.style.display = "flex";
                        speakStop_chat.style.display = "none";
                }

                startOver_chat.addEventListener('click', () => {
                    speakStopf_chat();                    
                    chatbot_ques_chat.style.display = "flex";
                    startOver_chat.setAttribute('style', `display:none !important; color:${prompt_theme_text_color_chat}`);                    
                    head1_chat.style.display = "flex";
                    head2_chat.style.display = "none";
                    messages_chat.innerHTML = '';
                    messages_chat.style.display = "none";
                });
            }

            var linkElement_chat = document.createElement("link");
            linkElement_chat.rel = "stylesheet";
            linkElement_chat.href = baseUrl_chat + "chat/chat.css";
            document.head.appendChild(linkElement_chat);
        }
    })();
}); 