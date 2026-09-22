document.addEventListener('DOMContentLoaded', function() {
    
    

  var element_id_script_app_set = document.querySelector("script[element_id]");
    if(element_id_script_app_set){

        var element_id_app_set = element_id_script_app_set.getAttribute("element_id");
    }
    if(!element_id_app_set){

        var element_id_app_set = "u9sst8htz0xhrrdsgpt";
    } 
    const ca_id=document.querySelector('script[business_id][id]').getAttribute('id');
    const ca_business_id=document.querySelector('script[business_id][id]').getAttribute('business_id');
    const user_id=document.querySelector('script[user_id][id]').getAttribute('user_id');
    const src=document.querySelector('script[business_id][id][src]').getAttribute('src');
    const segments = src.split('/chat/')[0];
    // const prompt_id=document.querySelector('script[id]').getAttribute('id');
    // const user_id=document.querySelector('script[user_id]').getAttribute('user_id');
    const aiApp='';


    // localStorage.clear('unique_id');
    function generateSessionId() {
        let timestamp = new Date().getTime(); // get current timestamp
        let random = Math.floor(Math.random() * 1000000); // generate random number
        return `${timestamp}-${random}`; // combine timestamp and random number
    }
    if(localStorage.getItem('visitor_id')===undefined || localStorage.getItem('visitor_id')==='' || localStorage.getItem('visitor_id')===null){
        const unique_id=localStorage.getItem('visitor_id');
        localStorage.setItem('visitor_id', generateSessionId());
    }
    generateSessionId();

    let color; 
    let bottext_color; 
    let botbackground_color; 
    let usertext_color; 
    let userbackground_color; 
    let txt; 
    const baseUrl = 'https://www.tubeengineai.com/app/';
    let assistant_image;
    let chatbot_footer;
    let widget_image;
    let chatbot_background;
    let chatbot_class;
    let qhtml;
    let close_message;
    let welcome_message;

    async function getStyle() {
        // console.log(prompt_id);
        const url = baseUrl + 'chat/apps_ques.php';
        const formData = new FormData();
        formData.append('cas_id', ca_id);
        formData.append('visitor_id', localStorage.getItem('visitor_id'));
        formData.append('ca_business_id', ca_business_id);
        formData.append('app', aiApp);
        formData.append('prompt_id', '');
        formData.append('user_id', user_id);

        try {
            const response = await fetch(url, {
              method: 'POST',
              body: formData
            });

            if (!response.ok) {
              throw new Error('Network response was not ok');
            }

            const json = await response.json();
            
            customer_app_sets = json.customer_app_sets;
            customer_apps = json.customer_apps;
            casName = customer_app_sets.cas_name;
            casDescription = customer_app_sets.cas_description;
            casGDPRLabel = customer_app_sets.cas_gdpr_display_lebel;
            casGDPRLink = customer_app_sets.cas_gdpr_display_link;
            casGDPRLabelJson = JSON.parse(casGDPRLabel); 
            jsonArray = [];
            casGDPRLinkJson = JSON.parse(casGDPRLink);
            casGDPRLinkJson.forEach((item,index) => {
              jsonArray.push({ label: casGDPRLabelJson[index], link: item}); console.log(item);
            });
            jsonArray.forEach((item) => {
              console.log(item.label+" : "+item.link);
            });

            casLogo = customer_app_sets.cas_logo_image_path;
            if(casLogo){
                if(casLogo!=undefined){
                    const myArray = casLogo.split("/");
                    const lastWord = myArray[myArray.length - 1];
                    if (lastWord!='default-user.png') {
                        const baseUrl1 = baseUrl.split('app/')[0];
                        const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                        casLogo = baseUrlImg + casLogo;
                    }else{
                        casLogo = casLogo;
                    } 
                }
            }else{
                casLogo = baseUrl + 'chat/widget.png';
            }


            casFooter = customer_app_sets.cas_footer_image_path;
            if(casFooter){
                if(casFooter!=undefined){
                    const myArray = casFooter.split("/");
                    const lastWord = myArray[myArray.length - 1];
                    if (lastWord!='default-user.png') {
                        const baseUrl1 = baseUrl.split('app/')[0];
                        const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                        casFooter = baseUrlImg + casFooter;
                    }else{
                        casFooter = casFooter;
                    } 
                }
            }else{
                casFooter = baseUrl + 'chat/chatbot_footer.png';
            }

            console.log(casGDPRLabel);
            console.log(casGDPRLink);
            console.log(casDescription);
            console.log(customer_apps);
        } catch (error) {
            console.error('Error:', error);
        }
    }    
    

    (async () => {
        await getStyle(); // Wait for getStyle() to complete before proceeding
        var chatboxHeader = '';
          // console.log(chatbot_class);
        // if(chatbot_class[0] == 'chatbox-five'){
        //   var chatboxHeader = `border:10px solid ${color}`;
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
                        
                        <section class="chat-user-card container">
                            <div id="appsList">
                                <div class="row justify-content-center">
                                    <div class="section-head col-md-9 col-sm-11 col-12 text-center">
                                        <img src="${casLogo}" alt="" class="logo mb-3">   
                                        <h3 class="w600 mb-3 text-dark">${casName}</h3>
                                        <p>${casDescription}</p>
                                    </div>
                                </div>
                                <div class="row mt30">
                                   <div class="col-md-12 col-12">
                                       <div class="search-bar" style="max-width: 100vw">
                                           <input type="text" id="search_app_sets" value="" class="search1 bg-transparent form-control ng-pristine ng-untouched ng-valid" placeholder="Search for app..."   autocomplete="off">
                                       </div>
                                   </div>
                               </div>   
                                <div class="row row-gap mt30" id="apps-box"></div>
                            </div>
                            <div id="appData"></div>
                            <div class="form-site mb-5 form-style-1 form-response d-flex align-items-center justify-content-center" id="theme_change_2" style="display:none !important;">
                                <div>
                                    <h4>Response</h4>
                                    <div class="login-box">
                                        <div class="content-inner" id="response_contents"></div>
                                        <div class="text-center submit-btn-side">
                                            <a class="btn btn overflow-hidden " id="restartOver">
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
                            <div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34); width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 9999; display:none;">
                                <img src="${baseUrl}chat/gloader.gif" style="position: absolute; margin: auto; top: 0; bottom: 0; left: 0; right: 0; width:5%">
                            </div>               
                        </section>
                        <footer class="set-view-footer">
                            <div class="footer-logo">
                                <img src="${casFooter}" alt="Footer">
                            </div>
                            <ul class="footer-share-links  justify-content-center" id="footer-share-links"> 
                            </ul>
                        </footer>`;
    
        //document.body.innerHTML += htmlData;
        document.getElementById(element_id_app_set).innerHTML += htmlData;
        
        var loader = document.querySelector(".temp_js_loader");
        const appsList = document.getElementById("appsList");
        const appsBox = document.getElementById("apps-box");
        const appData = document.getElementById("appData");
        const footerShareLinks = document.getElementById("footer-share-links");

        customer_apps.forEach((apps, index) => {
            assistant_image = apps.ca_image_path;
            if(assistant_image!=undefined){
                const myArray = assistant_image.split("/");
                const lastWord = myArray[myArray.length - 1];
                if (lastWord!='default_profile.png') {
                    const baseUrl1 = baseUrl.split('app/')[0];
                    const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                    assistant_image = baseUrlImg + assistant_image;
                }else{
                    assistant_image = assistant_image;
                } 
            }
            const appBox = document.createElement("div");
            appBox.className = "col-md-3 col-sm-6 col-12"; 
            appBox.setAttribute('data-status', apps.ca_name);
            appBox.innerHTML = `<div class="templates-card style-2 p-3 " id="${apps.ca_id}">
                                    <div class="template-image">
                                        <img src="${assistant_image}">
                                    </div>
                                    <div class="content text-center">
                                        <h6 class="title">${apps.ca_name}</h6> 
                                        <p>${apps.ca_description}</p>
                                    </div>
                                </div>`;
            appsBox.appendChild(appBox);
        });

        if(jsonArray){
            jsonArray.forEach((item) => { 
                const li = document.createElement("li");
                li.className = "share-link";
                li.innerHTML = `<a href="${item.link}" target="_blank">${item.label}</a>`;
                footerShareLinks.appendChild(li); 
            });
        }

        const app_cards = document.querySelectorAll('.templates-card');
        if(app_cards){
            app_cards.forEach((app_card, index) => {
                app_card.addEventListener('click', () => {
                    getAppDetails(app_card['id']);
                    appData.style.display = "block";
                    loader.style.display = "block";
                });
            });
        }

        async function getAppDetails(ca_id){
            const url = baseUrl + 'chat/style.php';
            const formData = new FormData();
            formData.append('ca_id', ca_id);
            formData.append('visitor_id', localStorage.getItem('visitor_id'));
            formData.append('ca_business_id', ca_business_id);
            formData.append('app', aiApp);
            formData.append('prompt_id', '');
            formData.append('user_id', user_id);

            try {
                const response = await fetch(url, {
                method: 'POST',
                body: formData
                });

                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                
                const json = await response.json();

                assistant_image = json.assistant_image;
                customer_apps = json.customer_apps;
                caName = customer_apps.ca_name;
                ca_description = customer_apps.ca_description;
                ca_image_path = customer_apps.ca_image_path;
                customer_apps_questions = json.customer_apps_questions;
                if(assistant_image!=undefined){
                    const myArray = assistant_image.split("/");
                    const lastWord = myArray[myArray.length - 1];
                    if (lastWord!='default_profile.png') {
                        const baseUrl1 = baseUrl.split('app/')[0];
                        const baseUrlImg = 'https://cdn.'+baseUrl1.split('.')[1] +'.'+baseUrl1.split('.')[2];                    
                        assistant_image = baseUrlImg + json.assistant_image;
                    }else{
                        assistant_image = json.assistant_image;
                    } 
                }
                appDetails(ca_id);
                appsList.style.display = "none";
                loader.style.display = "none";
            } catch (error) {
                console.error('Error:', error);
            }
        }
        const searchBox = document.getElementById('search_app_sets');
            searchBox.addEventListener('input', () => {
               searchApp();
            });
        function searchApp() {
            const searchValue = document.querySelector('.search1').value; 
            const divs = document.querySelectorAll('div[data-status]'); 
            if(searchValue===""){
                divs.forEach((div) => {
                    div.style.display = 'block';
                }); 
            }else{
                divs.forEach((div) => {
                const status = div.getAttribute('data-status').toLowerCase(); 
                // Show the div if the status matches the search value, otherwise hide it
                if (status.includes(searchValue)) {
                    div.style.display = 'block';
                } else {
                    div.style.display = 'none';
                }
                });
            }
        }
        
        function appDetails(ca_id){
            const appDiv = document.createElement("div");
            appDiv.className = "appDiv"; 
            appDiv.innerHTML = `<div class="card-inner">
                                    <div class="media">
                                        <img src="${assistant_image}" width="50" class="d-block img-fluid" style="border-radius:50%;" alt>
                                    </div>
                                    <div class="content" >
                                        <h3 class="title">${caName}</h3>
                                        <p>${ca_description}</p>
                                    </div>
                                </div>
                                <div class="form-site form-style-1 d-flex align-items-center justify-content-center" id="theme_change_1">
                                    <form action="" id="gpt_apps_set_form">
                                        <div class="login-box">
                                            <h2>Get Started</h2>
                                            <div id='questions-container'></div>
                                            <div class="text-end submit-btn-side">
                                                <button type="submit" href="#" class="btn btn overflow-hidden ">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    Submit
                                                </button>
                                            </div>                            
                                        </div>
                                    </form>                    
                                </div>`;
            appData.appendChild(appDiv);
            const questionsContainer = document.getElementById("questions-container");
            // questionsContainer.innerHTML = "";
            customer_apps_questions.forEach((question, index) => {
                const questionBox = document.createElement("div");
                questionBox.className = "user-box";
                
                questionBox.innerHTML =`<input type="hidden" name="question_id_${index}" value="${question.caq_id}"/>
                                        <h3 class="question">
                                            <span class="text-gray">${question.caq_question_label} ${question.caq_question_text} </span>
                                        </h3>`;
                let inputElement = "";

                // Define the input structure based on caq_question_type
                switch (question.caq_question_type) { 
                    case "1": // Text
                        inputElement = `<input type="text" placeholder="${question.caq_reference_answer}" name="answer_${index}" required autocomplete="off">`;
                        break;
                    case "2": // Number
                        inputElement = `<input type="number" placeholder="${question.caq_reference_answer}" name="answer_${index}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required autocomplete="off">`;
                        break;
                    case "3": // Email
                        inputElement = `<input type="email" placeholder="${question.caq_reference_answer}" name="answer_${index}" required autocomplete="off">`;
                        break;
                    case "4": // Date
                        inputElement = `<input type="date" placeholder="${question.caq_reference_answer}" name="answer_${index}" id="date" required autocomplete="off">`;
                        break;
                    case "5": // Time
                        inputElement = `<input type="time" id="time" placeholder="${question.caq_reference_answer}" name="answer_${index}" required autocomplete="off">`;
                        break;
                    case "6": // Datetime-local
                        inputElement = `<input type="datetime-local" id="dateTime" placeholder="${question.caq_reference_answer}" name="answer_${index}" required autocomplete="off">`;
                        break;
                    case "7": // Radio
                        const radioOptions = question.caq_question_type_select_options.split(',');
                        inputElement = '<div class="wrapper-parent">';
                        inputElement += radioOptions.map((option, i) => `
                            <div class="radio-wrapper d-flex align-items-center gap-2">
                                <input type="radio" placeholder="${question.caq_reference_answer}" name="answer_${index}" id="question_option_${index}_${i}" value="${option.trim()}">
                                <label for="question_option_${index}_${i}" class="w-100 m-0">${option.trim()}</label>
                            </div>`).join('');
                        inputElement += '</div>';

                        break;
                    case "8": // Checkbox
                    const checkboxOptions = question.caq_question_type_select_options.split(',');
                    inputElement = '<div class="wrapper-parent">';
                    inputElement += checkboxOptions.map((option, i) => `
                        <div class="checkbox-wrapper-4">
                            <input class="inp-cbx" id="checkbox_${index}_${i}" placeholder="${question.caq_reference_answer}" name="answer_${index}[]" type="checkbox" value="${option.trim()}"/>
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
                    inputElement += '</div>';
                    break;
                    case "9": // Select
                        const selectOptions = question.caq_question_type_select_options.split(',');
                        inputElement = `
                            <select placeholder="${question.caq_reference_answer}" name="answer_${index}" id="">
                                ${selectOptions.map(option => `<option value="${option.trim()}">${option.trim()}</option>`).join('')}
                            </select>`;
                        break;
                    default:
                        inputElement = `<input type="text" name="" required autocomplete="off">`;
                        break;
                }

                // Append the generated input element to the questionBox
                questionBox.innerHTML += inputElement;
                questionsContainer.appendChild(questionBox);
            });

            var style1 = [];
            var style2 = ["dark"];
            var style3 = ["centerform"];
            var style4 = ["border-form"];
            var style5 = ["border-form", "border-form-2"];
            var style6 = ["dark", "dark-form-center"];

            // Force `ca_style_type` to an integer
            var styleType = parseInt(customer_apps.ca_style_type, 10);

            // Create an array of IDs to target
            var themeChangeIds = ["theme_change_1", "theme_change_2"];

            // Loop through each ID and apply the styles
            themeChangeIds.forEach(id => {
                var themeChangeElement = document.getElementById(id);

                if (themeChangeElement) {
                    // Function to add multiple classes from an array
                    function addClasses(element, classes) {
                    classes.forEach(cls => element.classList.add(cls));
                    }

                    // Check the `ca_style_type` value and add the appropriate classes
                    switch (styleType) {
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
                        console.warn("Unexpected ca_style_type value:", styleType);
                    }

                    // Log the updated classes for verification
                    console.log("Updated classes after adding:", themeChangeElement.className);
                } else {
                    console.error(`Element with ID ${id} not found`);
                }
            });

            function startOver(){
                document.getElementById("theme_change_1").style.display="block";
                document.getElementById("theme_change_2").style.display="none";
                document.getElementById("response_contents").innerHTML=""; 
           }
           
           
           
            const button = document.getElementById('restartOver');
            button.addEventListener('click', () => {
                // window.location.reload();
                appData.innerHTML = "";
                document.getElementById("response_contents").innerHTML=""; 
                appsList.style.display = "block";
                document.getElementById("theme_change_2").setAttribute('style', "display:none !important;");
                
                
            });
              
       
       
           document.getElementById("gpt_apps_set_form").addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent traditional form submission
            
                const formDatas = {};
                var index_count=0;
                // Iterate through each question to get the data
                customer_apps_questions.forEach((question, index) => {
                    const answerKey = `answer_${index}`;
                        const caq_id = `question_id_${index}`;
                        const caq_Element = document.querySelector(`[name="question_id_${index}"]`);
                    // Select input elements based on question type
                    const questionType = question.caq_question_type;
                    formDatas['ca_id'] = ca_id;
                    formDatas['ca_business_id'] = ca_business_id; 
                    formDatas[caq_id]= caq_Element ? caq_Element.value : null;
                    if (questionType === "7") { // Radio button
                        const selectedRadio = document.querySelector(`input[name="${answerKey}"]:checked`);
                        formDatas[answerKey] = selectedRadio ? selectedRadio.value : null;
                    } else if (questionType === "8") { // Checkbox
                        const selectedCheckboxes = Array.from(document.querySelectorAll(`input[name="${answerKey}[]"]:checked`)).map(checkbox => checkbox.value).join(",");
                        formDatas[answerKey] = selectedCheckboxes;
                    } else { // Other input types
                        const inputElement = document.querySelector(`[name="${answerKey}"]`);
                        formDatas[answerKey] = inputElement ? inputElement.value : null;
                    }
                    index_count=index;
                });
                    formDatas['index'] = index_count;
                    formDatas['visitor_id'] = localStorage.getItem('visitor_id');
                // Send the data
                sendFormData(formDatas);
            });
        }
        

        async function sendFormData(formDatas) {
            loader.style.display = "block";
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
                appData.style.display = "none";
                loader.style.display = "none";
                //document.getElementById("loader").style.display = 'none';
                const json = await response.json(); 
                console.log(json);
                
                document.getElementById("theme_change_1").style.display="none";
                document.getElementById("theme_change_2").style.display="block";
                document.getElementById("response_contents").innerHTML="<p style='text-align:justify'>"+json.msg+"</p>"; 
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
        const gptimg="<img src="+assistant_image+" width='50'  style='height: 50px; margin-right: 15px;'/>";
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
                addMessage(img, questionValue);

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
                
                const apiUrl = baseUrl+`autoresponder_datasender?name=${name}&email=${email}&autoresponder_id=${autoresponder}&list_id=${list}&user_id=${user_id}&prompt_id=${prompt_id}`;
                const response = await fetch(apiUrl);
                
                if (!response.ok) {
                  throw new Error(`HTTP error! Status: ${response.status}`);
                }
                
                const data = await response.json(); // Assuming the response is in JSON format
                    
                localStorage.setItem('unique_id',localStorage.getItem('visitor_id'));
                      
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

        function addMessage(sender, message) {
          const div = document.createElement('div');
          div.className = 'message msg-container msg-self messages';
          div.innerHTML = `<div class="chatbox-chat sender"><span class=" text" style="background-color:${userbackground_color};color:${usertext_color}">${message}</span></div>`;
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
            formData.append('visitor_id', localStorage.getItem('visitor_id'));
            formData.append('user_id', user_id);
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
                sendCurlrequest(json.id, message, type);
            } catch (error) {
                console.error('Error:', error);
            }
        }


        async function sendCurlrequest(id, message, type) {
            // document.getElementById("loader").style.display = 'inline-flex';
            const url = baseUrl + 'chat/curl.php';
            const formData = new FormData();
            formData.append('user_id', user_id);
            formData.append('message', message);
            formData.append('type', type);
            formData.append('id', id);
            formData.append('visitor_id', localStorage.getItem('visitor_id'));
            formData.append('prompt_id', prompt_id);
            formData.append('app', aiApp);
            
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
            div.innerHTML = `<div class="chatbox-chat reciver"><span class="text" style="background-color:${botbackground_color};color:${bottext_color}">${message}</span></div><i class="fa-solid fa-clone"></i>
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