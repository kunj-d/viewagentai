document.addEventListener('DOMContentLoaded', function() {
    
    var gpt_apps_element_id_script = document.querySelector("script[element_id_app_gpt]"); 
    if(gpt_apps_element_id_script){
        var gpt_apps_element_id = gpt_apps_element_id_script.getAttribute("element_id_app_gpt"); 
    }
    if(!gpt_apps_element_id){
        var gpt_apps_element_id = "zRdgcuDSIuBNHoA";
    } 
    
    const gpt_apps_ca_id=document.querySelector('script[id_app_gpt][business_id_app_gpt]').getAttribute('id_app_gpt');
    const gpt_apps_ca_business_id=document.querySelector('script[business_id_app_gpt]').getAttribute('business_id_app_gpt');
    const gpt_apps_user_id=document.querySelector('script[user_id_app_gpt][user_id_app_gpt]').getAttribute('user_id_app_gpt');
    const gpt_apps_src=document.querySelector('script[src][business_id_app_gpt]').getAttribute('src');
    const gpt_apps_segments = gpt_apps_src.split('/chat/')[0];
    // const prompt_id=document.querySelector('script[id]').getAttribute('id');
    // const gpt_apps_user_id=document.querySelector('script[user_id]').getAttribute('user_id');
    const gpt_apps_aiApp='';


    // localStorage.clear('gpt_apps_unique_id');
    function gpt_apps_generateSessionId() {
        let gpt_apps_timestamp = new Date().getTime(); // get current timestamp
        let gpt_apps_random = Math.floor(Math.random() * 1000000); // generate random number
        return `${gpt_apps_timestamp}-${gpt_apps_random}`; // combine timestamp and random number
    }
    if(localStorage.getItem('gpt_apps_visitor_id')===undefined || localStorage.getItem('gpt_apps_visitor_id')==='' || localStorage.getItem('gpt_apps_visitor_id')===null){
        const gpt_apps_unique_id=localStorage.getItem('gpt_apps_visitor_id');
        localStorage.setItem('gpt_apps_visitor_id', gpt_apps_generateSessionId());
    }
    gpt_apps_generateSessionId();

    let gpt_apps_color; 
    let gpt_apps_bottext_color; 
    let gpt_apps_botbackground_color; 
    let gpt_apps_usertext_color; 
    let gpt_apps_userbackground_color; 
    let gpt_apps_txt; 
    const gpt_apps_baseUrl = 'https://www.tubeengineai.com/app/';
    let gpt_apps_assistant_image;
    let gpt_apps_chatbot_footer;
    let gpt_apps_widget_image;
    let gpt_apps_chatbot_background;
    let gpt_apps_chatbot_class;
    let gpt_apps_qhtml;
    let gpt_apps_close_message;
    let gpt_apps_welcome_message;

    async function gpt_apps_getStyle() {
        // console.log(prompt_id);
        const gpt_apps_url = gpt_apps_baseUrl + 'chat/style.php';
        const gpt_apps_formData = new FormData();
        gpt_apps_formData.append('ca_id', gpt_apps_ca_id);
        gpt_apps_formData.append('visitor_id', localStorage.getItem('gpt_apps_visitor_id'));
        gpt_apps_formData.append('ca_business_id', gpt_apps_ca_business_id);
        gpt_apps_formData.append('app', gpt_apps_aiApp);
        gpt_apps_formData.append('prompt_id', '');
        gpt_apps_formData.append('user_id', gpt_apps_user_id);

        try {
            const gpt_apps_response = await fetch(gpt_apps_url, {
              method: 'POST',
              body: gpt_apps_formData
            });

            if (!gpt_apps_response.ok) {
              throw new Error('Network gpt_apps_response was not ok');
            }

            const gpt_apps_json = await gpt_apps_response.json();
            // console.log(gpt_apps_json)
            gpt_apps_txt = gpt_apps_json.txt;
            var maxLength = 24;

            if (gpt_apps_txt!==undefined && gpt_apps_txt.length > 24) {
                gpt_apps_txt = gpt_apps_txt.slice(0, 24) + '...';
            }
            
            gpt_apps_qhtml = gpt_apps_json.qhtml;
            // console.log(gpt_apps_qhtml);
            gpt_apps_color = gpt_apps_json.color; // Assign value to color
            gpt_apps_bottext_color = gpt_apps_json.bottext_color; // Assign value to color
            gpt_apps_botbackground_color = gpt_apps_json.botbackground_color; // Assign value to color
            gpt_apps_usertext_color = gpt_apps_json.usertext_color; // Assign value to color
            gpt_apps_userbackground_color = gpt_apps_json.userbackground_color; // Assign value to color
            gpt_apps_list_id = gpt_apps_json.list_id;
            gpt_apps_widget_image=gpt_apps_json.widget_image;
            gpt_apps_autoresponder_id = gpt_apps_json.autoresponder_id;
            gpt_apps_chatbot_background = gpt_apps_json.chatbot_background;
            gpt_apps_close_message = gpt_apps_json.close_message;
            gpt_apps_welcome_message = gpt_apps_json.prompt;
            gpt_apps_chatbot_class = gpt_apps_json.chatbot_class; 
            gpt_apps_chatbot_question = gpt_apps_json.chatbot_question
            if(gpt_apps_chatbot_class!==undefined){
                gpt_apps_chatbot_class = gpt_apps_chatbot_class.split(","); 
            }
            gpt_apps_assistant_image = gpt_apps_json.assistant_image;
            gpt_apps_customer_apps = gpt_apps_json.customer_apps;
            gpt_apps_caName = gpt_apps_customer_apps.ca_name;
            gpt_apps_ca_description = gpt_apps_customer_apps.ca_description;
            gpt_apps_ca_image_path = gpt_apps_customer_apps.ca_image_path;
            gpt_apps_customer_apps_questions = gpt_apps_json.customer_apps_questions;
            if(gpt_apps_assistant_image!=="" && gpt_apps_assistant_image!==null && gpt_apps_assistant_image!=undefined){
                const gpt_apps_myArray = gpt_apps_assistant_image.split("/");
                const gpt_apps_lastWord = gpt_apps_myArray[gpt_apps_myArray.length - 1];
                if (gpt_apps_lastWord!='default_profile.png') {
                    const gpt_apps_baseUrl1 = gpt_apps_baseUrl.split('app/')[0];
                    const gpt_apps_baseUrlImg = 'https://cdn.'+gpt_apps_baseUrl1.split('.')[1] +'.'+gpt_apps_baseUrl1.split('.')[2];                    
                    gpt_apps_assistant_image = gpt_apps_baseUrlImg + gpt_apps_json.assistant_image;
                }else{
                    gpt_apps_assistant_image = gpt_apps_json.assistant_image;
                } 
            }else{
                gpt_apps_assistant_image = "https://cdn.tubeengineai.com/assets/images/widget.png";
            }
                       
           
            gpt_apps_widget_image = gpt_apps_json.widget_image;
            if(gpt_apps_widget_image!=="" &&  gpt_apps_widget_image !==null &&  gpt_apps_widget_image !==undefined){
                const gpt_apps_widgetArray = gpt_apps_widget_image.split("/"); 
                const gpt_apps_widgetlastWord = gpt_apps_widgetArray[gpt_apps_widgetArray.length - 1]; 
                if (gpt_apps_widgetlastWord!='widget.png') {
                    gpt_apps_widget_image = gpt_apps_baseUrl + gpt_apps_json.widget_image;
                       
                }else{
                    gpt_apps_widget_image = gpt_apps_baseUrl+gpt_apps_json.widget_image;
                }
            }else{
                gpt_apps_widget_image = "https://cdn.tubeengineai.com/assets/images/widget.png";
            }   
            
            if(gpt_apps_json.gpt_apps_chatbot_footer!=="" && gpt_apps_json.gpt_apps_chatbot_footer !==null && gpt_apps_json.gpt_apps_chatbot_footer !==undefined){        
                gpt_apps_chatbot_footer = gpt_apps_baseUrl+gpt_apps_json.chatbot_footer;
            }else{
                gpt_apps_chatbot_footer = gpt_apps_baseUrl+'chat/chatbot_footer.png';
            }
            // console.log(gpt_apps_chatbot_footer);
        } catch (gpt_apps_error) {
            console.error('Error:', gpt_apps_error);
        }
    }    
    

    (async () => {
        await gpt_apps_getStyle(); // Wait for gpt_apps_getStyle() to complete before proceeding
        var gpt_apps_chatboxHeader = ''; 
        
        var gpt_apps_htmlData=`<link href="${gpt_apps_baseUrl}chat/app_gpt_style.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
                        
    <section class="gptapp-chat-user-card">
        <div class="card-inner">
            <div class="media">
                <img src="${gpt_apps_assistant_image}"
                    width="50" class="d-block img-fluid" style="border-radius:50%;" alt>
            </div>
            <div class="content" >
                <h3 class="title">${gpt_apps_caName}</h3>
                <p>${gpt_apps_ca_description}</p>
            </div>
        </div>
        <div class="form-site form-style-1 d-flex align-items-center justify-content-center" id="gpt_apps_theme_change_1">
            <form action="" id="gpt_apps_form">
                <div class="login-box">
                    <h2>Get Started</h2>
                        <div id='gptapp-questions-container'></div>
                        <div class="text-end submit-btn-side">
                            <button type="submit" class="btn btn1 overflow-hidden ">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Submit
                            </button>
                        </div>
                    
                </div></form>
            
        </div>
        <div class="form-site mb-5 form-style-1 form-response d-flex align-items-center justify-content-center" id="gpt_apps_theme_change_2" style="display:none !important;">
            <div>
                <h4>Response</h4>
                <div class="login-box">
                    <div class="content-inner" id="gpt_apps_response_contents">
                        
                    </div>
                    <div class="text-center submit-btn-side">
                        <a class="btn btn1 overflow-hidden " id="gpt_apps_restartOver">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Restart
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="temp_js_loader gpt_apps_temp_js_loader" style="background: rgba(200, 200, 200, 0.34); width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 9999; display:none;">
            <img src="${gpt_apps_baseUrl}chat/gloader.gif" style="position: absolute; margin: auto; top: 0; bottom: 0; left: 0; right: 0; width:5%">
        </div>
    </section>`;
    
        //document.body.innerHTML += gpt_apps_htmlData;
        document.getElementById(gpt_apps_element_id).innerHTML += gpt_apps_htmlData; 
        const gpt_apps_questionsContainer = document.getElementById("gptapp-questions-container"); 
        gpt_apps_customer_apps_questions.forEach((gpt_apps_question, gpt_apps_index) => {
        const gpt_apps_questionBox = document.createElement("div");
        gpt_apps_questionBox.className = "user-box"; 
        gpt_apps_questionBox.innerHTML = `<input type="hidden" name="gpt_apps_question_id_${gpt_apps_index}" value="${gpt_apps_question.caq_id}"/> <h3 class="question"> <span class="text-gray">${gpt_apps_question.caq_question_label} ${gpt_apps_question.caq_question_text} </span></h3>`;




        let gpt_apps_inputElement = "";

    // Define the input structure based on caq_question_type
   switch (gpt_apps_question.caq_question_type) { 
    case "1": // Text
        gpt_apps_inputElement = `<input type="text" placeholder="${gpt_apps_question.caq_reference_answer}" name="gpt_apps_answer_${gpt_apps_index}" required autocomplete="off">`;
        break;
    case "2": // Number
        gpt_apps_inputElement = `<input type="number" placeholder="${gpt_apps_question.caq_reference_answer}" name="gpt_apps_answer_${gpt_apps_index}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required autocomplete="off">`;
        break;
    case "3": // Email
        gpt_apps_inputElement = `<input type="email" placeholder="${gpt_apps_question.caq_reference_answer}" name="gpt_apps_answer_${gpt_apps_index}" required autocomplete="off">`;
        break;
    case "4": // Date
        gpt_apps_inputElement = `<input type="date" placeholder="${gpt_apps_question.caq_reference_answer}" name="gpt_apps_answer_${gpt_apps_index}" id="date" required autocomplete="off">`;
        break;
    case "5": // Time
        gpt_apps_inputElement = `<input type="time" id="time" placeholder="${gpt_apps_question.caq_reference_answer}" name="gpt_apps_answer_${gpt_apps_index}" required autocomplete="off">`;
        break;
    case "6": // Datetime-local
        gpt_apps_inputElement = `<input type="datetime-local" id="dateTime" placeholder="${gpt_apps_question.caq_reference_answer}" name="gpt_apps_answer_${gpt_apps_index}" required autocomplete="off">`;
        break;
    case "7": // Radio
        const gpt_apps_radioOptions = gpt_apps_question.caq_question_type_select_options.split(',');
        gpt_apps_inputElement = '<div class="wrapper-parent">';
        gpt_apps_inputElement += gpt_apps_radioOptions.map((gpt_apps_option, gpt_apps_option_i) => `
            <div class="radio-wrapper d-flex align-items-center gap-2">
                <input type="radio" placeholder="Enter Your Answer" name="gpt_apps_answer_${gpt_apps_index}" id="question_option_${gpt_apps_index}_${gpt_apps_option_i}" value="${gpt_apps_option.trim()}">
                <label for="question_option_${gpt_apps_index}_${gpt_apps_option_i}" class="w-100 m-0">${gpt_apps_option.trim()}</label>
            </div>`).join('');
        gpt_apps_inputElement += '</div>';

        break;
   case "8": // Checkbox
    const gpt_apps_checkboxOptions = gpt_apps_question.caq_question_type_select_options.split(',');
    gpt_apps_inputElement = '<div class="wrapper-parent">';
    gpt_apps_inputElement += gpt_apps_checkboxOptions.map((gpt_apps_option, gpt_apps_option_i) => `
        <div class="checkbox-wrapper-4">
            <input class="inp-cbx" id="checkbox_${gpt_apps_index}_${gpt_apps_option_i}" placeholder="Enter Your Answer" name="gpt_apps_answer_${gpt_apps_index}[]" type="checkbox" value="${gpt_apps_option.trim()}"/>
            <label class="cbx" for="checkbox_${gpt_apps_index}_${gpt_apps_option_i}">
                <span>
                    <svg width="12px" height="10px">
                        <symbol id="check-4" viewBox="0 0 12 10">
                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                        </symbol>
                        <use xlink:href="#check-4"></use>
                    </svg>
                </span>
                <span>${gpt_apps_option.trim()}</span>
            </label>
        </div>
    `).join('');
    gpt_apps_inputElement += '</div>';
    break;
    case "9": // Select
        const gpt_apps_selectOptions = gpt_apps_question.caq_question_type_select_options.split(',');
        gpt_apps_inputElement = `
            <select placeholder="Enter Your Answer" name="gpt_apps_answer_${gpt_apps_index}" id="">
                ${gpt_apps_selectOptions.map(gpt_apps_option => `<option value="${gpt_apps_option.trim()}">${gpt_apps_option.trim()}</option>`).join('')}
            </select>`;
        break;
    default:
        gpt_apps_inputElement = `<input type="text" name="" required autocomplete="off">`;
        break;
}

    // Append the generated input element to the gpt_apps_questionBox
    gpt_apps_questionBox.innerHTML += gpt_apps_inputElement;
    gpt_apps_questionsContainer.appendChild(gpt_apps_questionBox);
});    
       
       
// Define the styles as arrays to handle multiple classes for each case
var gpt_apps_style1 = [];
var gpt_apps_style2 = ["dark"];
var gpt_apps_style3 = ["centerform"];
var gpt_apps_style4 = ["border-form"];
var gpt_apps_style5 = ["border-form", "border-form-2"];
var gpt_apps_style6 = ["dark", "dark-form-center"];

// Force `ca_style_type` to an integer
var gpt_apps_styleType = parseInt(gpt_apps_customer_apps.ca_style_type, 10);

// Create an array of IDs to target
var gpt_apps_themeChangeIds = ["gpt_apps_theme_change_1", "gpt_apps_theme_change_2"];

// Loop through each ID and apply the styles
gpt_apps_themeChangeIds.forEach(gpt_apps_id => {
  var gpt_apps_themeChangeElement = document.getElementById(gpt_apps_id);

  if (gpt_apps_themeChangeElement) {
    // Function to add multiple classes from an array
    function gpt_apps_addClasses(gpt_apps_element, gpt_apps_classes) {
      gpt_apps_classes.forEach(gpt_apps_cls => gpt_apps_element.classList.add(gpt_apps_cls));
    }

    // Check the `ca_style_type` value and add the appropriate classes
    switch (gpt_apps_styleType) {
      case 1:
        gpt_apps_addClasses(gpt_apps_themeChangeElement, gpt_apps_style1);
        break;
      case 2:
        gpt_apps_addClasses(gpt_apps_themeChangeElement, gpt_apps_style2);
        break;
      case 3:
        gpt_apps_addClasses(gpt_apps_themeChangeElement, gpt_apps_style3);
        break;
      case 4:
        gpt_apps_addClasses(gpt_apps_themeChangeElement, gpt_apps_style4);
        break;
      case 5:
        gpt_apps_addClasses(gpt_apps_themeChangeElement, gpt_apps_style5);
        break;
      case 6:
        gpt_apps_addClasses(gpt_apps_themeChangeElement, gpt_apps_style6);
        break;
      default:
        console.warn("Unexpected ca_style_type value:", gpt_apps_styleType);
    }

    // Log the updated classes for verification
    // console.log("Updated classes after adding:", gpt_apps_themeChangeElement.className);
  } else {
    console.error(`Element with ID ${gpt_apps_id} not found`);
  }
});

    function gpt_apps_startOver(){
         document.getElementById("gpt_apps_theme_change_1").style.display="block";
        document.getElementById("gpt_apps_theme_change_2").style.display="none";
        document.getElementById("gpt_apps_response_contents").innerHTML=""; 
        //$('html, body').animate({
        //         scrollTop: $('#gpt_apps_theme_change_1').offset().top
        //}, 1000);
    }
    
    
    var gpt_apps_loader = document.querySelector(".gpt_apps_temp_js_loader");
    const gpt_apps_button = document.getElementById('gpt_apps_restartOver');
    gpt_apps_button.addEventListener('click', () => {
         document.getElementById("gpt_apps_theme_change_1").style.display="block";
         document.getElementById("gpt_apps_theme_change_2").style.setProperty("display", "none", "important");
         document.getElementById("gpt_apps_response_contents").innerHTML="";
         //$('html, body').animate({
         //        scrollTop: $('#gpt_apps_theme_change_1').offset().top
         //       }, 1000);
        
    });
            
    function gpt_apps_responderLoader(gpt_apps_flag) {
         if (gpt_apps_flag) {
             gpt_apps_loader.style.display = "block";
         }else{
            gpt_apps_loader.style.display = "none";
         }
    } 
    document.querySelector("[id='gpt_apps_form']").addEventListener("submit", function (gpt_apps_event) {
    gpt_apps_event.preventDefault(); // Prevent traditional form submission
    
    const gpt_apps_formDatas = {};
    var gpt_apps_index_count=0;
    // Iterate through each gpt_apps_question to get the data
    gpt_apps_customer_apps_questions.forEach((gpt_apps_question, gpt_apps_index) => {
        const gpt_apps_answerKey = `gpt_apps_answer_${gpt_apps_index}`;
         const gpt_apps_caq_id = `gpt_apps_question_id_${gpt_apps_index}`;
         const gpt_apps_caq_Element = document.querySelector(`[name="gpt_apps_question_id_${gpt_apps_index}"]`);
        // Select input elements based on question type
        const gpt_apps_questionType = gpt_apps_question.caq_question_type;
        gpt_apps_formDatas['ca_id'] = gpt_apps_ca_id;
        gpt_apps_formDatas['ca_business_id'] = gpt_apps_ca_business_id; 
        gpt_apps_formDatas[`question_id_${gpt_apps_index}`]= gpt_apps_caq_Element ? gpt_apps_caq_Element.value : null;
        if (gpt_apps_questionType === "7") { // Radio button
            const gpt_apps_selectedRadio = document.querySelector(`input[name="${gpt_apps_answerKey}"]:checked`);
            gpt_apps_formDatas[`answer_${gpt_apps_index}`] = gpt_apps_selectedRadio ? gpt_apps_selectedRadio.value : null;
        } else if (gpt_apps_questionType === "8") { // Checkbox
            const gpt_apps_selectedCheckboxes = Array.from(document.querySelectorAll(`input[name="${gpt_apps_answerKey}[]"]:checked`)).map(gpt_apps_checkbox => gpt_apps_checkbox.value).join(",");
            gpt_apps_formDatas[`answer_${gpt_apps_index}`] = gpt_apps_selectedCheckboxes;
        } else { // Other input types
            const gpt_apps_inputElement = document.querySelector(`[name="${gpt_apps_answerKey}"]`);
            gpt_apps_formDatas[`answer_${gpt_apps_index}`] = gpt_apps_inputElement ? gpt_apps_inputElement.value : null;
        }
        gpt_apps_index_count=gpt_apps_index;
    });
     gpt_apps_formDatas['index'] = gpt_apps_index_count;
     gpt_apps_formDatas['visitor_id'] = localStorage.getItem('gpt_apps_visitor_id');
    // Send the data
    gpt_apps_sendFormData(gpt_apps_formDatas);
});

async function gpt_apps_sendFormData(gpt_apps_formDatas) {
     //document.getElementById("gpt_apps_loader").style.display = 'inline-flex';
     gpt_apps_responderLoader(true);
    const gpt_apps_url = gpt_apps_baseUrl + 'chat/app_gpt_server.php';
    const gpt_apps_formData = new FormData();

    // Append each key-value pair from gpt_apps_formDatas to FormData
    for (const gpt_apps_key in gpt_apps_formDatas) {
        if (Array.isArray(gpt_apps_formDatas[gpt_apps_key])) {
            // For checkbox arrays, add each value individually
            gpt_apps_formDatas[gpt_apps_key].forEach((gpt_apps_value, gpt_apps_i) => {
                gpt_apps_formData.append(`${gpt_apps_key}`, gpt_apps_value);
            });
        } else {
            gpt_apps_formData.append(gpt_apps_key, gpt_apps_formDatas[gpt_apps_key]); 
        }
    }

    try {
        const gpt_apps_response = await fetch(gpt_apps_url, {
            method: 'POST',
            body: gpt_apps_formData
        });

        if (!gpt_apps_response.ok) {
            throw new Error('Network gpt_apps_response was not ok');
        }
        //document.getElementById("gpt_apps_loader").style.display = 'none';
        gpt_apps_responderLoader(false);
        const gpt_apps_json = await gpt_apps_response.json(); 
        document.getElementById("gpt_apps_theme_change_1").style.setProperty("display", "none", "important");
        document.getElementById("gpt_apps_theme_change_2").style.display="block";
        document.getElementById("gpt_apps_response_contents").innerHTML="<p style='text-align:justify'>"+gpt_apps_json.msg+"</p>"; 
        //$('html, body').animate({
        //         scrollTop: $('#gpt_apps_theme_change_2').offset().top
        //        }, 1000);
        if(gpt_apps_json.redirect_url){
            if(gpt_apps_json.redirect_url!=undefined){
                let gpt_apps_a= document.createElement('a');
                gpt_apps_a.target= '_blank';
                gpt_apps_a.href= gpt_apps_json.redirect_url;
                gpt_apps_a.click();
            }
        }
                         
    } catch (gpt_apps_error) {
        console.error('Error:', gpt_apps_error);
    }
    
}


    
    
        const gpt_apps_messages = document.getElementById('gpt_apps_messages');
        const gpt_apps_input = document.getElementById('gpt_apps_input');
        const gpt_apps_send = document.getElementById('gpt_apps_send');
        const gpt_apps_ai = document.querySelector('input[name="gpt_apps_ai"]:checked');
        const gpt_apps_gptimg="<img src="+gpt_apps_assistant_image+" width='50'  style='height: 50px; margin-right: 15px;'/>";
        const gpt_apps_img="<img src="+gpt_apps_baseUrl+"chat/default-user.png width='50' style='margin-left: 15px;'/>";

        const gpt_apps_type='chatgpt';
        const gpt_apps_generate_script = document.getElementById('gpt_apps_generate_script');
        const gpt_apps_colorDivs = document.getElementsByClassName('gpt_apps_colorDivs');
         
        // Add event listeners for each button
        const gpt_apps_buttons = document.querySelectorAll('.gpt-apps-ques-box');
        gpt_apps_buttons.forEach(gpt_apps_button => {
            gpt_apps_button.addEventListener('click', () => {
                // Get the data-value from the child div
                const gpt_apps_questionDiv = gpt_apps_button.querySelector('.gpt-apps-ques');
                const gpt_apps_questionValue = gpt_apps_questionDiv.getAttribute('data-value');
                gpt_apps_addMessage(gpt_apps_img, gpt_apps_questionValue);

                const gpt_apps_resDiv = gpt_apps_button.querySelector('.gpt-apps-res');
                const gpt_apps_resValue = gpt_apps_resDiv.getAttribute('data-value');
                gpt_apps_appendBotMessage(gpt_apps_gptimg, gpt_apps_resValue);
                console.log(gpt_apps_questionValue); // Do something with the value
            });
        });
 
        async function gpt_apps_fetchData() {
            try {
                const gpt_apps_name = document.getElementById("gpt_apps_name").value;
                const gpt_apps_email = document.getElementById("gpt_apps_email").value;
                const gpt_apps_autoresponder = gpt_apps_autoresponder_id;
                const gpt_apps_list = gpt_apps_list_id;
                
                const gpt_apps_apiUrl = gpt_apps_baseUrl+`autoresponder_datasender?name=${gpt_apps_name}&email=${gpt_apps_email}&autoresponder_id=${gpt_apps_autoresponder}&list_id=${gpt_apps_list}&user_id=${gpt_apps_user_id}&prompt_id=${gpt_apps_ca_id}`;
                const gpt_apps_response = await fetch(gpt_apps_apiUrl);
                
                if (!gpt_apps_response.ok) {
                  throw new Error(`HTTP error! Status: ${gpt_apps_response.status}`);
                }
                
                const gpt_apps_data = await gpt_apps_response.json(); // Assuming the gpt_apps_response is in JSON format 
                localStorage.setItem('gpt_apps_unique_id',localStorage.getItem('gpt_apps_visitor_id')); 
                document.getElementById("gpt_apps_leadForm").style.display = "none";
                document.getElementById("gpt_apps_chat-type-box").style.display = "block";
                document.querySelector(".gpt-apps-chatbox-poweredby").style.display = "block";
                // document.getElementById("PromptWall").style.display = "flex";
                document.getElementById("gpt_apps_chat-input").style.display = "flex";
                gpt_apps_send.disabled = false;  
                      
            } catch (gpt_apps_error) {
                console.error('Error:', gpt_apps_error);
            }
        }

        function gpt_apps_addMessage(gpt_apps_sender, gpt_apps_message) {
          const gpt_apps_div = document.createElement('div');
          gpt_apps_divclassName = 'message msg-container msg-self messages gpt-apps-message';
          gpt_apps_div.innerHTML = `<div class="gpt-apps-chatbox-chat chatbox-chat sender"><span class=" text" style="background-color:${gpt_apps_userbackground_color};color:${gpt_apps_usertext_color}">${gpt_apps_message}</span></div>`;
          gpt_apps_messages.appendChild(gpt_apps_div);
          gpt_apps_messages.scrollTop = gpt_apps_messages.scrollHeight; 
        }

        async function gpt_apps_addBotMessage(gpt_apps_gptimg, pt_apps_message, gpt_apps_type) { 
            const gpt_apps_url = gpt_apps_baseUrl + 'chat/server.php';
            const gpt_apps_formData = new FormData();
            gpt_apps_formData.append('prompt_id', gpt_apps_ca_id);
            gpt_apps_formData.append('message', pt_apps_message);
            gpt_apps_formData.append('type', gpt_apps_type);
            gpt_apps_formData.append('visitor_id', localStorage.getItem('gpt_apps_visitor_id'));
            gpt_apps_formData.append('user_id', gpt_apps_user_id);
            gpt_apps_formData.append('app', gpt_apps_aiApp);

            try {
                const gpt_apps_response = await fetch(url, {
                    method: 'POST',
                    body: gpt_apps_formData
                });

                if (!gpt_apps_response.ok) {
                    throw new Error('Network gpt_apps_response was not ok');
                }

                const gpt_apps_json = await gpt_apps_response.json();
                gpt_apps_sendCurlrequest(gpt_apps_json.id, message, gpt_apps_type);
            } catch (gpt_apps_error) {
                console.error('Error:', gpt_apps_error);
            }
        }


        async function gpt_apps_sendCurlrequest(gpt_apps_id, gpt_apps_message, gpt_apps_type) {
            // document.getElementById("gpt_apps_loader").style.display = 'inline-flex';
            const gpt_apps_url = gpt_apps_baseUrl + 'chat/curl.php';
            const gpt_apps_formData = new FormData();
            gpt_apps_formData.append('user_id', gpt_apps_user_id);
            gpt_apps_formData.append('message', gpt_apps_message);
            gpt_apps_formData.append('type', gpt_apps_type);
            gpt_apps_formData.append('id', gpt_apps_id);
            gpt_apps_formData.append('visitor_id', localStorage.getItem('gpt_apps_visitor_id'));
            gpt_apps_formData.append('prompt_id', prompt_id);
            gpt_apps_formData.append('app', gpt_apps_aiApp);
            
            // Disable the gpt_apps_send button
            gpt_apps_send.disabled = true;
            gpt_apps_input.disabled = true;

            try {
                const gpt_apps_response = await fetch(gpt_apps_url, {
                    method: 'POST',
                    body: gpt_apps_formData
                });

                if (!gpt_apps_response.ok) {
                    throw new Error('Network gpt_apps_response was not ok');
                }

                const gpt_apps_json = await gpt_apps_response.json();
                // document.getElementById("gpt_apps_loader").style.display = 'none';
                if(gpt_apps_json.txt != ''){
                    gpt_apps_appendBotMessage(gpt_apps_gptimg, gpt_apps_json.txt);
                    // Disable the gpt_apps_send button
                    gpt_apps_send.disabled = false;
                    gpt_apps_input.disabled = false;
                }else{
                    console.log('Your credit limit excedded');
                }
            } catch (gpt_apps_error) {
                console.error('Error:', gpt_apps_error);
                // Disable the gpt_apps_send button
                gpt_apps_send.disabled = false;
                gpt_apps_input.disabled = false;
            }
        }

        function gpt_apps_appendBotMessage(gpt_apps_gptimg, gpt_apps_message){
            const div = document.createElement('div');
            div.className = 'message msg-container messages';
            // div.innerHTML = `<div>${gpt_apps_gptimg}<span class="msg-self-text" style="background-color:${gpt_apps_botbackground_color};color:${gpt_apps_bottext_color}">${message}</span></div>`;
            div.innerHTML = `<div class="chatbox-chat reciver"><span class="text" style="background-color:${gpt_apps_botbackground_color};color:${gpt_apps_bottext_color}">${message}</span></div><i class="fa-solid fa-clone"></i>
                            <i class="fa-solid fa-rotate"></i>`;
            gpt_apps_messages.appendChild(div);
            gpt_apps_messages.scrollTop = messages.scrollHeight; 
        } 
        //add css
        var gpt_apps_linkElement = document.createElement("link");
        gpt_apps_linkElement.rel = "stylesheet";
        gpt_apps_linkElement.href = gpt_apps_baseUrl+"chat/chat.css";
        // Append the <link> element to the <head> tag
        document.head.appendChild(gpt_apps_linkElement);        
    })();
}); 