document.addEventListener('DOMContentLoaded', function() {
    
    

  var app_set_element_script = document.querySelector("script[element_id_app_set]");
    if(app_set_element_script){

          app_set_element_id = app_set_element_script.getAttribute("element_id_app_set");
    }
    if(!app_set_element_id){

          app_set_element_id = "u9sst8htz0xhrrdsgpt";
    } 
    const app_set_cas_id=document.querySelector('script[id_app_set][business_id_app_set]').getAttribute('id_app_set');
    const app_set_cas_business_id=document.querySelector('script[business_id_app_set]').getAttribute('business_id_app_set');
    const app_set_user_id=document.querySelector('script[user_id_app_set][user_id_app_set]').getAttribute('user_id_app_set');
    const app_set_src=document.querySelector('script[src][business_id_app_set]').getAttribute('src');
    const app_set_segments = app_set_src.split('/chat/')[0];
    var app_set_ca_id_cur="";
    // const prompt_id=document.querySelector('script[id]').getAttribute('id');
    // const user_id=document.querySelector('script[user_id]').getAttribute('user_id');
    const app_set_aiApp='';


    // localStorage.clear('unique_id');
    function app_set_generateSessionId() {
        let timestamp = new Date().getTime(); // get current timestamp
        let random = Math.floor(Math.random() * 1000000); // generate random number
        return `${timestamp}-${random}`; // combine timestamp and random number
    }
    if(localStorage.getItem('app_set_visitor_id')===undefined || localStorage.getItem('app_set_visitor_id')==='' || localStorage.getItem('app_set_visitor_id')===null){
        const unique_id=localStorage.getItem('app_set_visitor_id');
        localStorage.setItem('app_set_visitor_id', app_set_generateSessionId());
    }
    app_set_generateSessionId();

    let app_set_color; 
    let app_set_bottext_color; 
    let app_set_botbackground_color; 
    let app_set_usertext_color; 
    let app_set_userbackground_color; 
    let app_set_txt; 
    const baseUrl = 'https://www.tubeengineai.com/app/';
    let app_set_assistant_image;
    let app_set_chatbot_footer;
    let app_set_widget_image;
    let app_set_chatbot_background;
    let app_set_chatbot_class;
    let app_set_qhtml;
    let app_set_close_message;
    let app_set_welcome_message;

    async function appsetgetStyle() {
        // console.log(prompt_id);
        const url = baseUrl + 'chat/apps_ques.php';
        const formData = new FormData();
        formData.append('cas_id', app_set_cas_id);
        formData.append('visitor_id', localStorage.getItem('app_set_visitor_id'));
        formData.append('ca_business_id', app_set_cas_business_id);
        formData.append('app', app_set_aiApp);
        formData.append('prompt_id', '');
        formData.append('user_id', app_set_user_id);

        try {
            const response = await fetch(url, {
              method: 'POST',
              body: formData
            });

            if (!response.ok) {
              throw new Error('Network response was not ok');
            }

            const json = await response.json();
            
            app_set_customer_app_sets = json.customer_app_sets;
            app_set_customer_apps = json.customer_apps;
            app_set_casName = app_set_customer_app_sets.cas_name;
            app_set_casDescription = app_set_customer_app_sets.cas_description;
            app_set_casGDPRLabel = app_set_customer_app_sets.cas_gdpr_display_lebel;
            app_set_casGDPRLink = app_set_customer_app_sets.cas_gdpr_display_link;
            app_set_casGDPRLabelJson = JSON.parse(app_set_casGDPRLabel); 
            app_set_jsonArray = [];
            app_set_casGDPRLinkJson = JSON.parse(app_set_casGDPRLink);
            app_set_casGDPRLinkJson.forEach((item,index) => {
              app_set_jsonArray.push({ label: app_set_casGDPRLabelJson[index], link: item});
            });
            
            // app_set_jsonArray.forEach((item) => {
            //   console.log(item.label+" : "+item.link);
            // });

            app_set_casLogo = app_set_customer_app_sets.cas_logo_image_path;
            if(app_set_casLogo){
                if(app_set_casLogo!=undefined){
                    const myArray = app_set_casLogo.split("/");
                    const lastWord = myArray[myArray.length - 1];
                    if (lastWord!='default-user.png') {
                        const baseUrl1 = baseUrl.split('app/')[0];
                        const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                        app_set_casLogo = baseUrlImg + app_set_casLogo;
                    }else{
                        app_set_casLogo = app_set_casLogo;
                    } 
                }
            }else{
                app_set_casLogo = baseUrl + 'chat/widget.png';
            }


            app_set_casFooter = app_set_customer_app_sets.cas_footer_image_path;
            if(app_set_casFooter){
                if(app_set_casFooter!=undefined){
                    const myArray = app_set_casFooter.split("/");
                    const lastWord = myArray[myArray.length - 1];
                    if (lastWord!='default-user.png') {
                        const baseUrl1 = baseUrl.split('app/')[0];
                        const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                        app_set_casFooter = baseUrlImg + app_set_casFooter;
                    }else{
                        app_set_casFooter = app_set_casFooter;
                    } 
                }
            }else{
                app_set_casFooter = baseUrl + 'chat/chatbot_footer.png';
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }    
    

    (async () => {
        await appsetgetStyle(); // Wait for getStyle() to complete before proceeding
        var app_set_chatboxHeader = '';
          // console.log(chatbot_class);
        // if(chatbot_class[0] == 'chatbox-five'){
        //   var app_set_chatboxHeader = `border:10px solid ${color}`;
        // }
        
        // if(chatbot_class[1] == 'block'){
        //   var height = `max-height:calc(100% - 250px)`;
        // }else{
        //   var height = `max-height:calc(100% - 210px)`;
        // }
        var htmlData=`  <link href="${baseUrl}chat/apps_set_style.css" rel="stylesheet">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                        <link rel="preconnect" href="https://fonts.googleapis.com">
                        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
                        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
                        
                        <style>
                            
                        .templates-card.style-2.blank-bg-style{
                            background: var(--theme-bg) !important;
                            padding: 20px !important;
                            min-height: 226px;
                            border-color: rgba(149, 149, 149, 0.3) !important;
                            box-shadow: none;
                        }

                        .templates-card.style-2.blank-bg-style:hover{
                            box-shadow: rgba(0, 0, 0, 0.2) 0px 18px 50px -10px !important; 
                        }

                        .templates-card.style-2.blank-bg-style .template-image {
                            box-shadow: none;
                            border: none;
                            padding: 0;
                            width: auto;
                            height: auto;
                        }
                        .templates-card.style-2.blank-bg-style .template-image img{
                            padding: 0;
                            object-fit: cover;
                        }
                        .templates-card.style-2.blank-bg-style::after{
                            display:none;
                        }

                        </style>
                        <div class="embedded-code">
                        <section class="appset-chat-user-card container">
                            <div id="app_set_List">
                                <div class="row justify-content-center">
                                    <div class="section-head col-md-9 col-sm-11 col-12 text-center">
                                        <img src="${app_set_casLogo}" alt="" class="logo mb-3">   
                                        <h3 class="w600 mb-3 text-dark">${app_set_casName}</h3>
                                        <p>${app_set_casDescription}</p>
                                    </div>
                                </div>
                                <div class="row mt30">
                                   <div class="col-md-12 col-12">
                                       <div class="search-bar" style="max-width: 100vw">
                                           <input type="text" id="search_app_sets" value=""  class="search1 bg-transparent form-control ng-pristine ng-untouched ng-valid" placeholder="Search for app..."   autocomplete="off">
                                       </div>
                                   </div>
                               </div>   
                                <div class="row row-gap mt30" id="app-set-apps-box"></div>
                            </div>
                            <div id="app_set_Data"></div>
                            <div class="form-site mb-5 form-style-1 form-response d-flex align-items-center justify-content-center" id="app_set_theme_change_2" style="display:none !important;">
                                <div>
                                    <h4>Response</h4>
                                    <div class="login-box">
                                        <div class="content-inner" id="app_set_response_contents"></div>
                                        <div class="text-center submit-btn-side">
                                            <a class="btn btn2 overflow-hidden " id="restartOver">
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
                            <div class="temp_js_loader "  id= "app_set_temp_js_loader" style="background: rgba(200, 200, 200, 0.34); width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 9999; display:none;">
                                <img src="${baseUrl}chat/gloader.gif" style="position: absolute; margin: auto; top: 0; bottom: 0; left: 0; right: 0; width:5%">
                            </div>               
                        </section>
                        <footer class="set-view-footer">
                            <div class="footer-logo">
                                <img src="${app_set_casFooter}" alt="Footer">
                            </div>
                            <ul class="footer-share-links  justify-content-center" id="app-set-footer-share-links"> 
                            </ul>
                        </footer>
                        </div>
                        `;
    
        //document.body.innerHTML += htmlData;
        document.getElementById(app_set_element_id).innerHTML += htmlData;
        
        var app_set_loader = document.getElementById("app_set_temp_js_loader");
        const app_set_List = document.getElementById("app_set_List");
        const app_set_appsBox = document.getElementById("app-set-apps-box");
        const app_set_appData = document.getElementById("app_set_Data");
        const app_set_footerShareLinks = document.getElementById("app-set-footer-share-links");

        app_set_customer_apps.forEach((apps, index) => {
            app_set_assistant_image = apps.ca_image_path;
            if(app_set_assistant_image!=undefined){
                const myArray = app_set_assistant_image.split("/");
                const lastWord = myArray[myArray.length - 1];
                if (lastWord!='default_profile.png') {
                    const baseUrl1 = baseUrl.split('app/')[0];
                    const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                    app_set_assistant_image = baseUrlImg + app_set_assistant_image;
                }else{
                    app_set_assistant_image = app_set_assistant_image;
                } 
            }
            const app_set_appBox = document.createElement("div");
            app_set_appBox.className = "col-md-3 col-sm-6 col-12"; 
            app_set_appBox.setAttribute('appset-data-status', apps.ca_name);
            app_set_appBox.innerHTML = `<div class="templates-card appset-templates-card style-2 blank-bg-style p-3 " id="${apps.ca_id}">
                                    <div class="template-image">
                                        <img src="${app_set_assistant_image}">
                                    </div>
                                    <div class="content text-center">
                                        <h6 class="title">${apps.ca_name}</h6> 
                                        <p>${apps.ca_description}</p>
                                    </div>
                                </div>`;
            app_set_appsBox.appendChild(app_set_appBox);
        });

        if(app_set_jsonArray){
            app_set_jsonArray.forEach((item) => { 
                const li = document.createElement("li");
                li.className = "share-link";
                li.innerHTML = `<a href="${item.link}" target="_blank">${item.label}</a>`;
                app_set_footerShareLinks.appendChild(li); 
            });
        }

        const app_set_app_cards = document.querySelectorAll('.appset-templates-card');
        if(app_set_app_cards){
            app_set_app_cards.forEach((app_set_app_cards, index) => {
                app_set_app_cards.addEventListener('click', () => {
                    appsetgetAppDetails(app_set_app_cards['id']);
                    app_set_appData.style.display = "block";
                    app_set_loader.style.display = "block";
                });
            });
        }

        async function appsetgetAppDetails(app_set_ca_id){
            const url = baseUrl + 'chat/style.php';
            const formData = new FormData();
            formData.append('ca_id', app_set_ca_id);
            formData.append('visitor_id', localStorage.getItem('app_set_visitor_id'));
            formData.append('ca_business_id', app_set_cas_business_id);
            formData.append('app', app_set_aiApp);
            formData.append('prompt_id', '');
            formData.append('user_id', app_set_user_id);
            app_set_ca_id_cur=app_set_ca_id;
            try {
                const response = await fetch(url, {
                method: 'POST',
                body: formData
                });

                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                
                const json = await response.json();

                app_set_assistant_image = json.assistant_image;
                app_set_customer_apps = json.customer_apps;
                app_set_caName = app_set_customer_apps.ca_name;
                app_set_ca_description = app_set_customer_apps.ca_description;
                app_set_ca_image_path = app_set_customer_apps.ca_image_path;
                app_set_customer_apps_questions = json.customer_apps_questions;
                if(app_set_assistant_image!=undefined){
                    const myArray = app_set_assistant_image.split("/");
                    const lastWord = myArray[myArray.length - 1];
                    if (lastWord!='default_profile.png') {
                        const baseUrl1 = baseUrl.split('app/')[0];
                        const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                        app_set_assistant_image = baseUrlImg + json.assistant_image;
                    }else{
                        app_set_assistant_image = json.assistant_image;
                    } 
                }
                appsetDetails(app_set_ca_id);
                app_set_List.style.display = "none";
                app_set_loader.style.display = "none";
            } catch (error) {
                console.error('Error:', error);
            }
        }
        const app_set_searchBox = document.getElementById('search_app_sets');
            app_set_searchBox.addEventListener('input', () => {
               appsetsearchApp();
            });
        function appsetsearchApp() {
            const app_set_searchValue = document.getElementById('search_app_sets').value; 
            const divs = document.querySelectorAll('div[appset-data-status]'); 
            if(app_set_searchValue===""){
                divs.forEach((div) => {
                    div.style.display = 'block';
                }); 
            }else{
                divs.forEach((div) => {
                const status = div.getAttribute('appset-data-status').toLowerCase(); 
                // Show the div if the status matches the search value, otherwise hide it
                if (status.includes(app_set_searchValue)) {
                    div.style.display = 'block';
                } else {
                    div.style.display = 'none';
                }
                });
            }
        }
        
        function appsetDetails(ca_id){
            const app_set_appDiv = document.createElement("div");
            app_set_appDiv.className = "appDiv"; 
            app_set_appDiv.innerHTML = `<div class="card-inner">
                                    <div class="media">
                                        <img src="${app_set_assistant_image}" width="50" class="d-block img-fluid" style="border-radius:50%;" alt>
                                    </div>
                                    <div class="content" >
                                        <h3 class="title">${app_set_caName}</h3>
                                        <p>${app_set_ca_description}</p>
                                    </div>
                                </div>
                                <div class="form-site form-style-1 d-flex align-items-center justify-content-center" id="app_set_theme_change_1">
                                    <form  id="app_set_form" action="">
                                        <div class="login-box">
                                            <h2>Get Started</h2>
                                            <div id='app-set-questions-container'></div>
                                            <div class="text-end submit-btn-side">
                                                <button type="submit" class="btn btn2 overflow-hidden ">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Submit
                                                </button>
                                                
                                                <button type="button" class="btn btn2 overflow-hidden " style="animation: none !important;" id="restartOverBack">
                                                     
                                                    Back
                                                </button>
                                                 
                                            
                                            </div>                            
                                        </div>
                                    </form>                    
                                </div>`;
            app_set_appData.appendChild(app_set_appDiv);
            const app_set_questionsContainer = document.getElementById("app-set-questions-container");
            // questionsContainer.innerHTML = "";
            app_set_customer_apps_questions.forEach((question, index) => {
                const app_set_questionBox = document.createElement("div");
                app_set_questionBox.className = "user-box";
                
                app_set_questionBox.innerHTML =`<input type="hidden" name="appset_question_id_${index}" value="${question.caq_id}"/>
                                        <h3 class="question">
                                            <span class="text-gray">${question.caq_question_label} ${question.caq_question_text} </span>
                                        </h3>`;
                let app_set_inputElement = "";

                // Define the input structure based on caq_question_type
                switch (question.caq_question_type) { 
                    case "1": // Text
                        app_set_inputElement = `<input type="text" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" required autocomplete="off">`;
                        break;
                    case "2": // Number
                        app_set_inputElement = `<input type="number" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required autocomplete="off">`;
                        break;
                    case "3": // Email
                        app_set_inputElement = `<input type="email" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" required autocomplete="off">`;
                        break;
                    case "4": // Date
                        app_set_inputElement = `<input type="date" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" id="date" required autocomplete="off">`;
                        break;
                    case "5": // Time
                        app_set_inputElement = `<input type="time" id="time" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" required autocomplete="off">`;
                        break;
                    case "6": // Datetime-local
                        app_set_inputElement = `<input type="datetime-local" id="dateTime" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" required autocomplete="off">`;
                        break;
                    case "7": // Radio
                        const radioOptions = question.caq_question_type_select_options.split(',');
                        app_set_inputElement = '<div class="wrapper-parent">';
                        app_set_inputElement += radioOptions.map((option, i) => `
                            <div class="radio-wrapper d-flex align-items-center gap-2">
                                <input type="radio" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" id="question_option_${index}_${i}" value="${option.trim()}">
                                <label for="question_option_${index}_${i}" class="w-100 m-0">${option.trim()}</label>
                            </div>`).join('');
                        app_set_inputElement += '</div>';

                        break;
                    case "8": // Checkbox
                    const checkboxOptions = question.caq_question_type_select_options.split(',');
                    app_set_inputElement = '<div class="wrapper-parent">';
                    app_set_inputElement += checkboxOptions.map((option, i) => `
                        <div class="checkbox-wrapper-4">
                            <input class="inp-cbx" id="checkbox_${index}_${i}" placeholder="${question.caq_reference_answer}" name="appset_answer_${index}[]" type="checkbox" value="${option.trim()}"/>
                            <label class="cbx" for="checkbox_${index}_${i}">
                                <span>
                                    <svg width="12px" height="10px">
                                        <symbol id="check-4" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                        <use xlink:href="#check-4"></use>
                                    </svg>
                                </span>
                                <span>${option.trim()}</span>
                            </label>
                        </div>
                    `).join('');
                    app_set_inputElement += '</div>';
                    break;
                    case "9": // Select
                        const selectOptions = question.caq_question_type_select_options.split(',');
                        app_set_inputElement = `
                            <select placeholder="${question.caq_reference_answer}" name="appset_answer_${index}" id="">
                                ${selectOptions.map(option => `<option value="${option.trim()}">${option.trim()}</option>`).join('')}
                            </select>`;
                        break;
                    default:
                        app_set_inputElement = `<input type="text" name="" required autocomplete="off">`;
                        break;
                }

                // Append the generated input element to the questionBox
                app_set_questionBox.innerHTML += app_set_inputElement;
                app_set_questionsContainer.appendChild(app_set_questionBox);
            });

            var style1 = [];
            var style2 = ["dark"];
            var style3 = ["centerform"];
            var style4 = ["border-form"];
            var style5 = ["border-form", "border-form-2"];
            var style6 = ["dark", "dark-form-center"];

            // Force `ca_style_type` to an integer
            var app_set_styleType = parseInt(app_set_customer_apps.ca_style_type, 10);

            // Create an array of IDs to target
            var app_set_themeChangeIds = ["app_set_theme_change_1", "app_set_theme_change_2"];

            // Loop through each ID and apply the styles
            app_set_themeChangeIds.forEach(id => {
                var themeChangeElement = document.getElementById(id);

                if (themeChangeElement) {
                    // Function to add multiple classes from an array
                    function addClasses(element, classes) {
                    classes.forEach(cls => element.classList.add(cls));
                    }

                    // Check the `ca_style_type` value and add the appropriate classes
                    switch (app_set_styleType) {
                    case 1:
                        addClasses(themeChangeElement, style1);
                        break;
                    case 2:
                        addClasses(themeChangeElement, style2);
                        break;
                    case 3:
                        addClasses(themeChangeElement, style3);
                        break;
                    case 4:
                        addClasses(themeChangeElement, style4);
                        break;
                    case 5:
                        addClasses(themeChangeElement, style5);
                        break;
                    case 6:
                        addClasses(themeChangeElement, style6);
                        break;
                    default:
                        console.warn("Unexpected ca_style_type value:", app_set_styleType);
                    }

                    // Log the updated classes for verification
                    console.log("Updated classes after adding:", themeChangeElement.className);
                } else {
                    console.error(`Element with ID ${id} not found`);
                }
            });

            function startOver(){
                document.getElementById("app_set_theme_change_1").style.display="block";
                document.getElementById("app_set_theme_change_2").style.display="none";
                document.getElementById("app_set_response_contents").innerHTML=""; 
           }
           
           
           
            const app_set_button = document.getElementById('restartOver');
            app_set_button.addEventListener('click', () => {
                // window.location.reload();
                app_set_appData.innerHTML = "";
                document.getElementById("app_set_response_contents").innerHTML=""; 
                app_set_List.style.display = "block";
                document.getElementById("app_set_theme_change_2").setAttribute('style', "display:none !important;");
                //$('html, body').animate({
                // scrollTop: $('#app_set_List').offset().top
                //}, 1000);
                
                
            });
            const app_set_restartOverBack = document.getElementById('restartOverBack');
            app_set_restartOverBack.addEventListener('click', () => {
                // window.location.reload();
                app_set_appData.innerHTML = "";
                document.getElementById("app_set_response_contents").innerHTML=""; 
                app_set_List.style.display = "block";
                document.getElementById("app_set_theme_change_2").setAttribute('style', "display:none !important;");
                //$('html, body').animate({
                // scrollTop: $('#app_set_List').offset().top
                //}, 1000); 
            });
            
              
       
       
           document.getElementById("app_set_form").addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent traditional form submission
            
                const app_set_formDatas = {};
                var index_count=0;
                // Iterate through each question to get the data
                app_set_customer_apps_questions.forEach((question, index) => {
                    const app_set_answerKey = `appset_answer_${index}`;
                        const caq_id = `appset_question_id_${index}`;
                        const caq_Element = document.querySelector(`[name="appset_question_id_${index}"]`);
                    // Select input elements based on question type
                    const questionType = question.caq_question_type;
                    app_set_formDatas['ca_id'] = app_set_ca_id_cur;
                    app_set_formDatas['ca_business_id'] = app_set_cas_business_id; 
                    app_set_formDatas[`question_id_${index}`]= caq_Element ? caq_Element.value : null;
                    if (questionType === "7") { // Radio button
                        const selectedRadio = document.querySelector(`input[name="${app_set_answerKey}"]:checked`);
                        app_set_formDatas[ `answer_${index}`] = selectedRadio ? selectedRadio.value : null;
                    } else if (questionType === "8") { // Checkbox
                        const selectedCheckboxes = Array.from(document.querySelectorAll(`input[name="${app_set_answerKey}[]"]:checked`)).map(checkbox => checkbox.value).join(",");
                        app_set_formDatas[`answer_${index}`] = selectedCheckboxes;
                    } else { // Other input types
                        const inputElement = document.querySelector(`[name="${app_set_answerKey}"]`);
                        app_set_formDatas[`answer_${index}`] = inputElement ? inputElement.value : null;
                    }
                    index_count=index;
                });
                    app_set_formDatas['index'] = index_count;
                    app_set_formDatas['visitor_id'] = localStorage.getItem('app_set_visitor_id');
                // Send the data
                appsetsendFormData(app_set_formDatas);
            });
        }
        

        async function appsetsendFormData(formDatas) {
            app_set_loader.style.display = "block";
            //document.getElementById("loader").style.display = 'inline-flex';
            const url = baseUrl + 'chat/app_gpt_server.php';
            const formData = new FormData();

            // Append each key-value pair from formDatas to FormData
            for (const key in formDatas) {
                if (Array.isArray(formDatas[key])) {
                    // For checkbox arrays, add each value individually
                    formDatas[key].forEach((value, i) => {
                        formData.append(`${key}`, value);
                    });
                } else {
                    formData.append(key, formDatas[key]); 
                }
            }

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                app_set_appData.style.display = "none";
                app_set_loader.style.display = "none";
                //document.getElementById("loader").style.display = 'none';
                const json = await response.json(); 
                console.log(json);
                
                document.getElementById("app_set_theme_change_1").style.display="none ";
                document.getElementById("app_set_theme_change_2").style.display="block";
                document.getElementById("app_set_response_contents").innerHTML="<p style='text-align:justify'>"+json.msg+"</p>"; 
                 
                if(json.redirect_url){
                    if(json.redirect_url!=undefined){
                        let a= document.createElement('a');
                        a.target= '_blank';
                        a.href= json.redirect_url;
                        a.click();
                    }
                }
                                
            } catch (error) {
                console.error('Error:', error);
            }
            
        }


    
    
        const messages = document.getElementById('messages');
        const input = document.getElementById('input');
        const send = document.getElementById('send');
        const ai = document.querySelector('input[name="ai"]:checked');
        const gptimg="<img src="+app_set_assistant_image+" width='50'  style='height: 50px; margin-right: 15px;'/>";
        const img="<img src="+baseUrl+"chat/default-user.png width='50' style='margin-left: 15px;'/>";

        const type='chatgpt';
        const generate_script = document.getElementById('generate_script');
        const colorDivs = document.getElementsByClassName('colorDivs');
        // send.disabled = true;
        // if(autoresponder_id != 0){
            // document.getElementById("leadForm").style.display = "block";
            // document.getElementById("chat-type-box").style.display = "block";
            // document.getElementById("start-over").style.display = "none"; 
            // messages.style.display = "none"; 
        // }else{
        //     document.getElementById("leadForm").style.display = "none"; 
        //     document.getElementById("PromptWall").style.display = "flex"; 
        //     send.disabled = false;
        //     appendBotMessage(gptimg, welcome_message);
        // }

        // var modal = document.getElementById("myModal");
        // var btn = document.getElementById("abc123");
        // var span = document.getElementById("close-modal");

        // // btn.onclick = function() {
        // //     alert('he')
        // //     modal.style.display = "block";
        // // }

        // // span.onclick = function() {
        // //     modal.style.display = "none";
        // // }

        // // window.onclick = function(event) {
        // //     if (event.target == modal) {
        // //         modal.style.display = "none";
        // //     }
        // // }

        // var html1 = '';
        // let chatbot_ques = document.getElementById('chatbot_ques');

        // for (var i = 0; i < chatbot_question.length; i++) {
        //     html1 += `<div class="col-md-4">
        //         <button class="ques-box p-3 border" data-toggle="modal" data-target="#formLead" id="abc${i}">
        //             <div data-value="${chatbot_question[i]['question']}" class="ques">${chatbot_question[i]['question']}</div>
        //             <div data-value="${chatbot_question[i]['response']}" class="res" style="display:none"></div>
        //         </button> </div>`;
        // }

        // chatbot_ques.innerHTML = html1;

        // Add event listeners for each button
        const buttons = document.querySelectorAll('.ques-box');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Get the data-value from the child div
                const questionDiv = button.querySelector('.ques');
                const questionValue = questionDiv.getAttribute('data-value');
                appsetaddMessage(img, questionValue);

                const resDiv = button.querySelector('.res');
                const resValue = resDiv.getAttribute('data-value');
                appendBotMessage(gptimg, resValue);
                console.log(questionValue); // Do something with the value
            });
        });

        // let message;
        // send.addEventListener('click', () => {
        //     message = input.value;
        //     input.value = '';
        //     console.log(message);
        //     addMessage(img, message);
        //     // if((localStorage.getItem('unique_id')===undefined || localStorage.getItem('unique_id')==='' || localStorage.getItem('unique_id')===null) && autoresponder_id != 0){ 
        //     //     // document.getElementById("leadForm").style.display = "block"; 
        //     // }else{
        //         addBotMessage(gptimg, message,type);
        //     // }
        // });

        // lead.addEventListener('click', () => {
        //     if(document.getElementById("name").value==""){
        //         document.getElementById("name_error").innerHTML="Enter Name*";
        //     }
        //     if(document.getElementById("email").value==""){
        //         document.getElementById("email_error").innerHTML="Enter Email*";
        //     }
        //     if(document.getElementById("email").value!="" && document.getElementById("name").value){    
        //         document.getElementById('formLead').style.display = "none";
        //         document.querySelector('.modal-backdrop').style.display = "none";
        //         document.body.classList.remove('modal-open');                
        //         document.getElementById("chatbot_ques").style.display = "none";
        //         messages.style.display = "block"; 
        //         document.getElementById("welcome_message").style.display = "block";
        //         // document.getElementById("start-over").style.display = "block"; 
        //         fetchData();
        //     }         
        // });
    
        async function fetchData() {
            try {
                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const autoresponder = autoresponder_id;
                const list = list_id;
                
                const apiUrl = baseUrl+`autoresponder_datasender?name=${name}&email=${email}&autoresponder_id=${autoresponder}&list_id=${list}&user_id=${app_set_user_id}&prompt_id=${prompt_id}`;
                const response = await fetch(apiUrl);
                
                if (!response.ok) {
                  throw new Error(`HTTP error! Status: ${response.status}`);
                }
                
                const data = await response.json(); // Assuming the response is in JSON format
                    
                localStorage.setItem('unique_id',localStorage.getItem('app_set_visitor_id'));
                      
                document.getElementById("leadForm").style.display = "none";
                document.getElementById("chat-type-box").style.display = "block";
                document.querySelector(".chatbox-poweredby").style.display = "block";
                // document.getElementById("PromptWall").style.display = "flex";
                document.getElementById("chat-input").style.display = "flex";
                send.disabled = false;  
                      
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function appsetaddMessage(sender, message) {
          const div = document.createElement('div');
          div.className = 'message msg-container msg-self messages';
          div.innerHTML = `<div class="chatbox-chat sender"><span class=" text" style="background-color:${app_set_userbackground_color};color:${app_set_usertext_color}">${message}</span></div>`;
          messages.appendChild(div);
          messages.scrollTop = messages.scrollHeight;
          // document.getElementById("closedMessage").setAttribute('show','show');
        }

        async function addBotMessage(gptimg, message, type) { 
            const url = baseUrl + 'chat/server.php';
            const formData = new FormData();
            formData.append('prompt_id', prompt_id);
            formData.append('message', message);
            formData.append('type', type);
            formData.append('visitor_id', localStorage.getItem('app_set_visitor_id'));
            formData.append('user_id', app_set_user_id);
            formData.append('app', app_set_aiApp);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const json = await response.json();
                sendCurlrequest(json.id, message, type);
            } catch (error) {
                console.error('Error:', error);
            }
        }


        async function sendCurlrequest(id, message, type) {
            // document.getElementById("loader").style.display = 'inline-flex';
            const url = baseUrl + 'chat/curl.php';
            const formData = new FormData();
            formData.append('user_id', app_set_user_id);
            formData.append('message', message);
            formData.append('type', type);
            formData.append('id', id);
            formData.append('visitor_id', localStorage.getItem('app_set_visitor_id'));
            formData.append('prompt_id', prompt_id);
            formData.append('app', app_set_aiApp);
            
            // Disable the send button
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
                // document.getElementById("loader").style.display = 'none';
                if(json.txt != ''){
                    appendBotMessage(gptimg, json.txt);
                    // Disable the send button
                    send.disabled = false;
                    input.disabled = false;
                }else{
                    console.log('Your credit limit excedded');
                }
            } catch (error) {
                console.error('Error:', error);
                // Disable the send button
                send.disabled = false;
                input.disabled = false;
            }
        }

        function appendBotMessage(gptimg, message){
            const div = document.createElement('div');
            div.className = 'message msg-container messages';
            // div.innerHTML = `<div>${gptimg}<span class="msg-self-text" style="background-color:${botbackground_color};color:${bottext_color}">${message}</span></div>`;
            div.innerHTML = `<div class="chatbox-chat reciver"><span class="text" style="background-color:${app_set_botbackground_color};color:${app_set_bottext_color}">${message}</span></div><i class="fa-solid fa-clone"></i>
                            <i class="fa-solid fa-rotate"></i>`;
            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight; 
        }
        
     
        // var hideClick=document.getElementById('hideClick');
        // hideClick.addEventListener("click", function() {
             
        // });

        // var closeMessage=document.getElementById('showcloseMessage');
        // closeMessage.addEventListener("click", function() {
        //     if(document.getElementById("closedMessage").getAttribute('show') == 'show'){
                 
        //     }else{
                
        //     }
        // });

        // var confirmBtn=document.getElementById('confirm-btn');
        // confirmBtn.addEventListener("click", function() {
             
        // });

        // var cancelBtn=document.getElementById('cancel-btn');
        // cancelBtn.addEventListener("click", function() {
        //     document.getElementById("closedMessage").style.display = 'none';
        // });

        /*
        var promptHit=document.getElementsByClassName('question');
        for (var i = 0; i < promptHit.length; i++) {
            promptHit[i].addEventListener("click", function(e) {
                var qt = e.target.getAttribute('data-qt');
                var ans = e.target.getAttribute('data-response');
                addMessage(img, qt);
                // document.getElementById("loader").style.display = 'inline-flex';
                setTimeout(function() {
                    // document.getElementById("loader").style.display = 'none';
                    appendBotMessage(gptimg, ans);
                }, 3000);
            });
        }*/

        

        //add color
        //document.getElementById("comment-box").style.background = color;
        //add bg image
        // document.getElementById('chatbox').style.display = "block";
        //document.getElementById('chatbox').style.backgroundImage="url("+chatbot_background+")";

        //add css
        var linkElement = document.createElement("link");
        linkElement.rel = "stylesheet";
        linkElement.href = baseUrl+"chat/chat.css";
        // Append the <link> element to the <head> tag
        document.head.appendChild(linkElement);        
    })();
}); 