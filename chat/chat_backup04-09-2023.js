
const prompt_id=document.querySelector('script[id]').getAttribute('id');
const user_id=document.querySelector('script[user_id]').getAttribute('user_id');
const aiApp=document.querySelector('script[app]').getAttribute('app');


localStorage.clear('unique_id');
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
let txt; 
const baseUrl = 'https://aistaff.getvideowhizz.com/';

async function getStyle() {
  const url = baseUrl + 'chat/style.php';
  const formData = new FormData();
  formData.append('prompt_id', prompt_id);
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
    txt = json.txt;
    color = json.color; // Assign value to color
    list_id = json.list_id;
    autoresponder_id = json.autoresponder_id;


  } catch (error) {
    console.error('Error:', error);
  }
}


(async () => {
  await getStyle(); // Wait for getStyle() to complete before proceeding
var htmlData=`<div class='chatbox' style='background-color:#10a37f' id='chatbox'>
<div class='chatbox-header' style='background-color:${color}'>
<div class='chatbox-text'>${txt}</div>
            <div class='cross-img'><img src='https://i.ibb.co/bHrtxqF/545121.png' width='15' height='15' id='hideClick'/></div>
</div>

    		<div class='chat-window' id='messages'>
    			
    		</div>
    		<div id='leadForm' style='display:none'> Name <input type='text' id='name'/> </br/>
    			Email <input type='text' id='email'/> </br/>
    			<input type="button" id="lead" value='submit'/>
    		</div>
    		<form class='chat-input' onsubmit='return false;'>
    			<input type='text' autocomplete='on' placeholder='Type a message' id='input' />
    			<button id='send'>
                      <svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
	 viewBox='0 0 50 50' style='enable-background:new 0 0 50 50; width:22px; height:22px;' xml:space='preserve'>
<style type='text/css'>
	.st0{fill:#ffffff;}
</style>
<path class='st0' d='M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
	l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z'/>
</svg>
                    </button>
    		</form>
	</div>  
	<div class='comment-box' id='comment-box' style='display:none'>
            <img src='https://i.ibb.co/sWw7Qmf/icon.png' width=30' height='30' id='showClick'/>
        </div>`;

  document.body.innerHTML += htmlData;

const baseUrl = 'https://aistaff.getvideowhizz.com/';
const messages = document.getElementById('messages');
const input = document.getElementById('input');
const send = document.getElementById('send');
const ai = document.querySelector('input[name="ai"]:checked');
const img="<img src="+baseUrl+"chat/av.jpg width='50'/>";
const gptimg="<img src="+baseUrl+"chat/chatgpt.jpeg width='50'/>";
const type='chatgpt';
const generate_script = document.getElementById('generate_script');
const colorDivs = document.getElementsByClassName('colorDivs');






  let message;
  send.addEventListener('click', () => {
  message = input.value;
  input.value = '';
  addMessage(img, message);
  if(localStorage.getItem('unique_id')===undefined || localStorage.getItem('unique_id')==='' || localStorage.getItem('unique_id')===null){ 
            document.getElementById("leadForm").style.display = "block"; 
           
            

  }else{
             addBotMessage(gptimg, message,type);


  }

  });

 lead.addEventListener('click', () => { 
    if(document.getElementById("name").value==""){
       alert('Enter Name');
   }
   if(document.getElementById("email").value==""){
       alert('Enter Email');
   }
   if(document.getElementById("email").value!="" && document.getElementById("name").value){
        fetchData();
 
   }

   
  });
  
  
  async function fetchData() {
              try {
                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const autoresponder = autoresponder_id;
                const list = list_id;
            
                const apiUrl = baseUrl+`autoresponder_datasender?name=${name}&email=${email}&autoresponder_id=${autoresponder}&list_id=${list}&user_id=${user_id}`;
            
                const response = await fetch(apiUrl);
            
                if (!response.ok) {
                  throw new Error(`HTTP error! Status: ${response.status}`);
                }
            
                const data = await response.json(); // Assuming the response is in JSON format
                console.log(data); // Do something with the data
                localStorage.setItem('unique_id',localStorage.getItem('visitor_id'));
                document.getElementById("leadForm").style.display = "none"; 
                addBotMessage(gptimg, message,type);

                
              } catch (error) {
                console.error('Error:', error);
                
              }
    }




function addMessage(sender, message) {
  const div = document.createElement('div');
  div.className = 'message msg-container msg-self msg-box messages';
 // div.innerHTML = `<strong>${sender}:</strong> ${message}`;
  div.innerHTML = `<div>${sender}:${message}</div>`;
  messages.appendChild(div);
  messages.scrollTop = messages.scrollHeight;

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
    console.log(json);
    appendBotMessage(gptimg, json.txt);
     // Disable the send button
  send.disabled = false;
  input.disabled = false;
  } catch (error) {
    console.error('Error:', error);
       // Disable the send button
  send.disabled = false;
  input.disabled = false;
  }
}



function appendBotMessage(gptimg, message){
	const div = document.createElement('div');
	div.className = 'message msg-container msg-remote msg-box messages';
	div.innerHTML = `<div>${gptimg}:${message}</div>`;
	messages.appendChild(div);
	  messages.scrollTop = messages.scrollHeight;

}
 document.getElementById("chatbox").style.display = "none";
 document.getElementById("comment-box").style.display = "block";
var hideClick=document.getElementById('hideClick');
hideClick.addEventListener("click", function() {
  document.getElementById("chatbox").style.display = "none";
  document.getElementById("comment-box").style.display = "block";
});

var showClick=document.getElementById('showClick');
showClick.addEventListener("click", function() {
  document.getElementById("chatbox").style.display = "block";
  document.getElementById("comment-box").style.display = "none";
});


 var linkElement = document.createElement("link");
    linkElement.rel = "stylesheet";
    linkElement.href = baseUrl+"chat/chat.css";

    // Append the <link> element to the <head> tag
    document.head.appendChild(linkElement);
})();

  


