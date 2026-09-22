<div class="container-wrapper container-open ng-cloak" ng-app="AppModule" ng-controller="virtualAssitantCreate" ng-cloak>

<style>
    /* css by raj 1 april */

    /*nav-pills*/
	.integration-pills{
		overflow : hidden;
	}
	button#overview-tab {
		padding-left: 0;
		padding-right: 0;
	}
	.nav-pills .nav-link {
		color: var(--white-color);
		padding: 15px 0;
		border: 0;
		margin: auto;
		width: 100%;
	}
	.nav{
		padding: 0;
	}
	 .nav-item:last-child .nav-link{
		border: 0;
	}
	.nav-pills .nav-link {
		background: 0 0;
	}
	.progress-bar-primary{
		background-color : var(--blue-gradient);    
	}
	.progress{
        background-color: var(--theme-bg) !important;
	}
	
	/*nav-pills*/
	
	/*content-tabs*/
	.dropdown-menu.open.livesearchdrop{
		max-height: 250.5px !important;
		overflow: hidden !important;
		
	}
	.dropdown-menu.open.livesearchdrop ul{
		max-height: 230.5px !important;
		overflow: scroll !important;
	}
	.tab-content>.active {
		display : block !important;
	}
	.profile-text {
		color: #fff;
		font-weight: 600;
		font-size: 1rem;
		line-height: 1.250rem;
		cursor: pointer;
		padding: 10px;
	}
	.profile-img {
		min-width: 100px;
		min-height: 100px;
		max-width: 100px;
		max-height: 100px;
		border-radius: 100%;
	    background: var(--rgba-primary-1);
		overflow: hidden;
		display: flex;
		align-items: center;
		justify-content: center;
		position: relative;
		justify-content: center;
		margin : unset;
	}
	.profile-img:hover .profile-text {
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
		margin : 0;
	}
	.color-picker-html label {
		width: 100%;
		position: relative;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.color-picker-html [type='color'], .color-picker-html [type='color']:focus {
		padding: 0px;
		height: 21px;
		width: 100%;
		border: none;
	}
	#headingOne .dropdown-toggle{
		width: 100%;
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 9px 12px ;
		border-radius: 5px;
		border: 1px solid var(--theme-br);
		background: var(--theme-color);
		color: var(--white-color);
	}
	#headingOne .dropdown-toggle:focus,#headingOne .dropdown-toggle:active,#headingOne .dropdown-toggle:hover{
		background-color : transparent;
	}
	.previous-btn, .next-btn {
		padding: 10px;
		border-radius: 5px;
		color: var(--grey-color);
		border: 1px solid var(--theme-br);
		font-size: 14px;
		font-weight: 400;
		display: inline-flex;
		align-items: center;
		gap: 5px;
		transition : 0.2s;
		background : transparent;
	}
	.previous-btn:hover, .next-btn:hover{
		border-color : var(--blue-gradient) ;
		color: var(--blue-gradient) ;
	}
	.base-btn.upload-btn{
		padding : unset ;
		border-radius : unset;
		border : 0;
	}
	
	.appoint-inner .appoint-btn {
		position: absolute;
		background: rgba(0, 0, 0, 0.50);
		width: 100%;
		height: calc(100% - 72px);
		opacity: 1;
		transition: all 0.3s ease;
		text-align: center;
		z-index: 2;
		top: 0;
		left: 0;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	
	.appoint-inner .appoint-btn .appoint-link {
		font-size: 1.6rem;
		font-weight: 600;
		line-height: 1.250rem;
		color: #fff;
		text-decoration: none;
		border-radius: 5px;
		background: var(--blue-gradient);
		padding: 20px;
		border: 0px;
		margin-top: 18px;
	}
	@media only screen and (max-width : 575px){
		.appoint-inner .appoint-btn .appoint-link{
			font-size: 1.2rem;
			padding: 15px;
		}
		.appoint-inner .appoint-btn{
			height: calc(100% - 62px);
		}
	}
	.info-box {
		border-radius: 5px;
		border: 1px solid var(--theme-br);
		padding: 15px 20px;
	}
	.option-wall textarea {
		min-height: 126px;
		padding: 15px 10px;
		resize: none;
		border-radius: 5px;
		background: #fff;
		padding: 3px 10px;
		font-size: 14px;
		width: 100%;
	}
	.massage-wall .form-control:focus {
		background-color: transparent;
		box-shadow: none;
	}
	.option-wall input, .option-wall textarea {
		border-radius: 5px;
		border: 1px solid var(--theme-br);
		background: transparent;
			padding: 10px 15px;
		font-size: 14px;
		color: var(--white-color);
		width: 100%;
		transition : 0.3s;
	}
	.option-wall input:focus{
		border : 1px solid var(--blue-gradient);
	}
	.opion-list-sec::before {
		position: absolute;
		content: url(https://aimentor.aimentorpro.com/app/assets/images/arrow.png);
		top: 55%;
        right: -22px;
		filter: contrast(0);
	}
	@media only screen and (max-width : 991px){
		.opion-list-sec::before {
			display : none;
		}    
	}
	.opion-list-sec {
		position: relative;
	}
	u {
		text-decoration: underline !important;
	}
	.imsite-btn{
		display : inline-flex;
		align-items : center;
		gap : 5px;
	}
	.appoint-inner{
		position : relative;
	}
	.form-control{
		box-shadow : none;
	}
	.form-control:focus{
		border-color: var(--blue-gradient);
		box-shadow: none;
	}
	.cursor-pointer{
	    cursor : pointer;
	}
	input:focus-visible{
	    outline : 0;
	}
	.chatbot-themes{
	    padding : 1rem !important;
	}
	/*content-tabs*/
	
	/* css by raj 1 april */
</style>


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
    margin:20px auto 0 auto;
    background : #fff;
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
    /*background: #5b5e6c;*/
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
	font-size: 14px;
    background-color: #e9ebed;
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
    background : transparent;
    background-clip: padding-box;
    border-radius: 10px !important;
}


/*.accordion-item::before {*/
/*    content: "";*/
/*    position: absolute;*/
/*    top: 0;*/
/*    right: 0;*/
/*    bottom: 0;*/
/*    left: 0;*/
/*    z-index: -1;*/
/*    margin: -1px;*/
/*    border-radius: inherit;*/
/*    background: radial-gradient(100% 100% at 50.00% 0%, #AA70ED 0%, #5340D7 100%);*/
/*}*/
.accordion-button::after {
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
    background-size: 18.5px;
}
.accordion-button::after {
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
    background-size: 18.5px;
}
.accordion-button:focus {
    box-shadow: none;
    border-color : var(--theme-br);
}
.accordion-button:not(.collapsed) {
    background: transparent;
    border-color : var(--theme-br2);
    box-shadow: none;
}
.accordion-button:not(.collapsed) {
    background: transparent;
    color: var(--text-primary2);
    box-shadow: none;
}
.accordion-item .accordion-button:not(.collapsed)::after {
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
}
.accordion-item .accordion-button:not(.collapsed)::after {
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
}
.accordion-button::after {
     content: "\e906" !important;  
    font-family: 'icomoon';
}
.accordion-button::after{
    background-image:none !important;
}
.accordion-item .accordion-button::after {
   content: "\e907" !important;  
    font-family: 'icomoon';
    font-weight:400;
}
.accordion-body {
    padding: 1rem 1.25rem !important;
    position: absolute !important;
    background-color: var(--theme-bg) !important;
    z-index: 999 !important;
    border: 1px solid var(--theme-br) !important;
    border-radius: 10px !important;
    
}
a.base-btn, .base-btn, a.base-btn:focus, .base-btn:focus {
    padding: 10px 30px;
    min-height: 40px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    background: var(--blue-gradient);
   
    cursor: pointer;
    text-align: center;
    line-height: normal;
    outline: none;
    font-weight: 600;
    font-size: 0.875rem;
    line-height: 1.0625rem;
    gap: 10px;
}

.disabled-btn{
  border-radius: 10px;
  background: #626786;
  color: var(--white-color);
  font-size: 1rem;
  font-weight: 600;
  line-height: 1.250rem;
  padding: 15px 30px;
  text-decoration: none;
  display: inline-block;
}

.disabled-btn:hover{
  background: #626786;
}


.profile-img1 {
    width: 100px;
    height: 100px;
    border-radius: 100%;
    background: var(--rgba-primary-1);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    justify-content: center;
}
.profile-img1 img {
    object-fit: cover;
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
    padding: 10px;
}
.search-clr {
    display: block;
    padding: 15px 20px;
    justify-content: center;
    align-items: flex-start;
    gap: 282px;
    flex-shrink: 0;
    border-radius: 10px;
    border: 1px solid var(--theme-br);
    color: var(--text-primary2);
   
}

@media (min-width:768px){
   .mt-md70{
        margin-top: 70px;
    }
}

.file-input__input {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}

.file-input__label {
  cursor: pointer;
  display: inline-flex;
  align-items: center;
}

/*Anam Chatbox Css*/

@keyframes msgbounce {  
    50% {
        transform: translateY(5px);
    }
}
/* Scrollbar Styling */
.promt-msg-wall::-webkit-scrollbar {
  height: 5px;
}

.promt-msg-wall::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0);
}

.promt-msg-wall::-webkit-scrollbar-thumb{
  height: 5px;
  background-color: rgba(13,100,190,0.5);
}

.promt-msg-wall::-webkit-scrollbar-thumb:hover {
  background-color: #0D64BE !important;
}

.promt-msg-wall::-webkit-scrollbar:vertica{
  display: none;
}


.chatbox-one .chatbox-header{
    border-radius: 10px 10px 0px 0px;
    background: #0D64BE;
}
.chatbox-one .mr7{
    margin-right:7px;
}
.chatbox-one .ml15{
    margin-left:15px;
}
.chatbox-one .f-10{
    font-size:10px;
}
.chatbox-one .msg-self {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-one.chatbox-va .chat-input-va{
    border-radius: 0px 0px 10px 10px;
    background: #FFF;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.20);
    bottom:30px;
    position:absolute;
}
.chatbox-one.chatbox-va .chat-input-va button{
    background: #0D64BE;
}
.chatbox-one .chatbox-poweredby{
    position: absolute;
    bottom: 0px;
    font-size: 10px;
    font-weight: 400;
    color: #A1BCD0;
    width: 100%;
    padding: 7px 10px;
    text-align:center;
}
.chatbox-one .msg-self-text{
    border-radius: 0px 15px 15px 15px;
    background: rgba(13, 100, 190, 0.20);
    padding: 7px 15px;
    width: 100%;
}
.chatbox-one .msg-remote-text{
    border-radius: 15px 0px 15px 15px;
    background: #0D64BE;
    padding: 7px 15px;
    width: 100%;
    color:#fff;
}
.chatbox-one .msg-remote{
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-one .msg-remote img{
    margin-left:15px;
}
.msg-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius:50px;
  background:#EBF7FD;
  padding:0px 7px;
}

.msg-wrapper .ball {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  margin: 0 2px;
  animation: 2s msgbounce ease infinite;
}

.msg-wrapper .blue {
  background: rgba(13,100,190,0.5);
}

.msg-wrapper .red {
  background:rgba(13,100,190,0.7);
  animation-delay: .25s;
}

.msg-wrapper .yellow {
  background:#0D64BE;
  animation-delay: .5s;
}
.chatbox-one .promt-msg-wall{
    width: 98%;
    overflow-x: scroll;
    padding: 10px;
    position: absolute;
    bottom: 100px;
    /* display: inline-flex; */
    display: -webkit-box;
    white-space: nowrap;
}

.chatbox-one .promt-msg-wall .promt-msg1 div, .chatbox-one .promt-msg-wall .promt-msg2 div{
    margin-right: 10px;
    padding: 3px 7px;
    width: 280px;
    overflow: hidden;
    border-radius: 5px;
    background: rgba(13, 100, 190, 0.20);
    color : #000;
}

/*chatbot-two css*/
.chatbox-two .chatbox-header{
    border-radius: 0px 0px 15px 15px;
    background: #FF8383;
}
.chatbox-two .mr7{
    margin-right:7px;
}
.chatbox-two .ml15{
    margin-left:15px;
}
.chatbox-two .f-10{
    font-size:10px;
}
.chatbox-two .msg-self {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-two.chatbox-va .chat-input-va{
    border-radius: 0px 0px 10px 10px;
    background: #FFF;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.20);
    bottom:30px;
    position:absolute;
}
.chatbox-two.chatbox-va .chat-input-va button{
    background:#ff8383;
}
.chatbox-two .chatbox-poweredby{
    position: absolute;
    bottom: 0px;
    font-size: 10px;
    font-weight: 400;
    color: #A1BCD0;
    width: 100%;
    padding: 7px 10px;
    text-align:center;
}
.chatbox-two .msg-self-text{
    border-radius: 20px;
    background: rgba(255, 131, 131, 0.50);
    padding: 7px 15px;
    width: 100%;
}
.chatbox-two .msg-remote-text{
    border-radius: 20px;
    background: rgba(255, 131, 131, 0.50);
    padding: 7px 15px;
    width: 100%;
    color:#000000;
}
.chatbox-two .msg-remote{
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-two .msg-remote img{
    margin-left:15px;
}
.chatbox-two .msg-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius:50px;
  background:rgba(255, 131, 131, 0.50);
  padding:0px 7px;
}

.chatbox-two .msg-wrapper .ball {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  margin: 0 2px;
  animation: 2s msgbounce ease infinite;
}

.chatbox-two .msg-wrapper .blue {
  background: rgba(0,0,0,0.5);
}

.chatbox-two .msg-wrapper .red {
  background:rgba(0,0,0,0.7);
  animation-delay: .25s;
}

.chatbox-two .msg-wrapper .yellow {
  background:#000000;
  animation-delay: .5s;
}
.chatbox-two .promt-msg-wall{
    width: 98%;
    overflow-x: scroll;
    padding: 10px;
    position: absolute;
    bottom: 100px;
    /* display: inline-flex; */
    display: -webkit-box;
    white-space: nowrap;
}
.chatbox-two .promt-msg-wall .promt-msg1 div, .chatbox-two .promt-msg-wall .promt-msg2 div{
    margin-right: 10px;
    padding: 3px 15px;
    width: 280px;
    overflow: hidden;
    border-radius: 20px;
    background: rgba(255, 131, 131, 0.50);
    color : #000;
}

/*chatbox-two css end*/

/*chatbox-three css start*/
.chatbox-three .chatbox-header{
    border-radius: 10px 10px 0px 0px;
    background: #DA8301;
}
.chatbox-three .mr7{
    margin-right:7px;
}
.chatbox-three .ml15{
    margin-left:15px;
}
.chatbox-three .f-10{
    font-size:10px;
}
.chatbox-three .msg-self {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-three .chat-input-va{
    border-radius: 0px 0px 10px 10px ;
    background: #FFF;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.20);
    bottom:30px;
    position:absolute;
}
.chatbox-three.chatbox-va .chat-input-va button{
    background:#da8301;
}
.chatbox-three .chatbox-poweredby{
    position: absolute;
    bottom: 0px;
    font-size: 10px;
    font-weight: 400;
    color: #A1BCD0;
    width: 100%;
    padding: 7px 10px;
    text-align:center;
}
.chatbox-three .msg-self-text{
    border-radius: 5px;
    background: rgba(218, 131, 1, 0.50);
    padding: 7px 15px;
    width: 100%;
}
.chatbox-three .msg-self-text:before{
	width: 0;
	height: 0;
	border-top: 7px solid transparent;
	border-right: 9px solid {{botbackground_color}};
	border-bottom: 7px solid transparent;
	position:absolute;
	top:5px;
	left:41px;
	content:'';
}
.chatbox-three .msg-remote-text{
    border-radius: 5px;
    background: rgba(218, 131, 1, 0.50);
    padding: 7px 15px;
    width: 100%;
    color:#000000;
}
.chatbox-three .msg-remote-text:after{
	width: 0;
	height: 0;
	border-top: 7px solid transparent;
	border-left: 9px solid {{userbackground_color}};
	border-bottom: 7px solid transparent;
	position:absolute;
	top:5px;
	right:56px;
	content:'';
}
.chatbox-three .msg-remote{
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-three .msg-remote img{
    margin-left:15px;
}
.chatbox-three .msg-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius:50px;
  background:rgba(218, 131, 1, 0.50);
  padding:0px 7px
}

.chatbox-three .msg-wrapper .ball {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  margin: 0 2px;
  animation: 2s msgbounce ease infinite;
}

.chatbox-three .msg-wrapper .blue {
  background: rgba(0,0,0,0.5);
}

.chatbox-three .msg-wrapper .red {
  background:rgba(0,0,0,0.7);
  animation-delay: .25s;
}

.chatbox-three .msg-wrapper .yellow {
  background:#000000;
  animation-delay: .5s;
}
.chatbox-three .promt-msg-wall{
    width: 98%;
    overflow-x: scroll;
    padding: 10px;
    position: absolute;
    bottom: 100px;
    /* display: inline-flex; */
    display: -webkit-box;
    white-space: nowrap;
}

.chatbox-three .promt-msg-wall .promt-msg1 div, .chatbox-three .promt-msg-wall .promt-msg2 div{
    margin-right: 10px;
    padding: 3px 7px;
    width: 280px;
    overflow: hidden;
    border-radius: 5px;
    background: rgba(218, 131, 1, 0.50);
    color : #000;
}

/*chatbox-three css end*/

/*chatbox-four css start*/
.chatbox-four .chatbox-header{
    border-radius: 10px 10px 0px 0px;
    background: #6223C6;
}
.chatbox-four .mr7{
    margin-right:7px;
}
.chatbox-four .ml15{
    margin-left:15px;
}
.chatbox-four .f-10{
    font-size:10px;
}
.chatbox-four .msg-self {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-four .chat-input-va{
    border-radius: 0px 0px 10px 10px ;
    background: #FFF;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.20);
    bottom:30px;
    position:absolute;
}
.chatbox-four.chatbox-va .chat-input-va button{
    background:#6223C6;;
}
.chatbox-four .chatbox-poweredby{
    position: absolute;
    bottom: 0px;
    font-size: 10px;
    font-weight: 400;
    color: #A1BCD0;
    width: 100%;
    padding: 7px 10px;
    text-align:center;
}
.chatbox-four .msg-self-text{
    border-radius: 0px 10px 10px 10px;
    background: #6223C6;
    padding: 7px 15px;
    width: 100%;
    color:#fff;
}
.chatbox-four .msg-remote-text{
    border-radius: 10px 0px 10px 10px;
    border: 2px solid #6223C6;
    background: #FFF;
    padding: 7px 15px;
    width: 100%;
    color:#000000;
}
.chatbox-four .msg-remote{
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-four .msg-remote img{
    margin-left:15px;
}
.chatbox-four .msg-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius:50px;
  background:#6223C6;
  padding:0px 7px;
}

.chatbox-four .msg-wrapper .ball {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  margin: 0 2px;
  animation: 2s msgbounce ease infinite;
}

.chatbox-four .msg-wrapper .blue {
  background: rgba(255,255,255,0.5);
}

.chatbox-four .msg-wrapper .red {
  background:rgba(255,255,255,0.7);
  animation-delay: .25s;
}

.chatbox-four .msg-wrapper .yellow {
  background:#ffffff;
  animation-delay: .5s;
}

.chatbox-four .promt-msg-wall{
    width: 98%;
    overflow-x: scroll;
    padding: 10px;
    position: absolute;
    bottom: 100px;
    /* display: inline-flex; */
    display: -webkit-box;
    white-space: nowrap;
}

.chatbox-four .promt-msg-wall .promt-msg1 div, .chatbox-four .promt-msg-wall .promt-msg2 div{
    border-radius: 5px;
    border: 2px solid #6223C6;
    padding: 3px 7px;
    margin-right:10px;
    margin-top:10px;
    color : #000;
    background #fff: 
}

/*chatbox-four css end*/

/*chatbox-five css start*/
.chatbox-border{
    border-radius: 10px !important;
  
    max-width: 437px;
}
.chatbox-va-five {
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
    border-radius: 0px !important;
    margin:0 !important; 
    /*background:url(https://test.getintelimateai.com/app/assets/images/bg1.png) !important;*/
}
.chatbox-five .chatbox-header{
    border-radius: 0px 0px 0px 0px;
    background: #18B586;
}
.chatbox-five .mr7{
    margin-right:7px;
}
.chatbox-five .ml15{
    margin-left:15px;
}
.chatbox-five .f-10{
    font-size:10px;
}
.chatbox-five .msg-self {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-five .chat-input-va{
    border-radius: 0px 0px 10px 10px ;
    background: #FFF;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.20);
    bottom:30px;
    position:absolute;
}
.chatbox-five.chatbox-va .chat-input-va button{
    background:#17B585;
}
.chatbox-five .chatbox-poweredby{
    position: absolute;
    bottom: 0px;
    font-size: 10px;
    font-weight: 400;
    color: #A1BCD0;
    width: 100%;
    padding: 7px 10px;
    text-align:center;
}
.chatbox-five .msg-self-text{
    border-radius: 0px 10px 10px 10px;
    background: #17B585;
    padding: 7px 15px;
    width: 100%;
    color:#fff;
}
.chatbox-five  .msg-self-text:before{
	width: 0;
	height: 0;
	border-top: 0px solid transparent;
	border-right: 8px solid {{botbackground_color}};
	border-bottom: 8px solid transparent;
	position:absolute;
	top:0px;
	left:42px;
	content:'';
}
.chatbox-five .msg-remote-text{
    border-radius: 10px 0px 10px 10px;
    background: #E5E5E5;
    padding: 7px 15px;
    width: 100%;
    color:#000000;
}
.chatbox-five .msg-remote-text:after{
	width: 0;
	height: 0;
	border-top: 0px solid transparent;
	border-left: 8px solid {{userbackground_color}};
	border-bottom: 8px solid transparent;
	position:absolute;
	top:0px;
    right:58px;
	content:'';
}
.chatbox-five .msg-remote{
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-five .msg-remote img{
    margin-left:13px;
}
.chatbox-five .msg-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius:50px;
  background:#17B585;
  padding:0px 7px;
}

.chatbox-five .msg-wrapper .ball {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  margin: 0 2px;
  animation: 2s msgbounce ease infinite;
}

.chatbox-five .msg-wrapper .blue {
  background: rgba(255,255,255,0.5);
}

.chatbox-five .msg-wrapper .red {
  background:rgba(255,255,255,0.7);
  animation-delay: .25s;
}

.chatbox-five .msg-wrapper .yellow {
  background:#ffffff;
  animation-delay: .5s;
}


.chatbox-five .promt-msg-wall{
    width: 98%;
    overflow-x: scroll;
    padding: 10px;
    position: absolute;
    bottom: 100px;
    /* display: inline-flex; */
    display: -webkit-box;
    white-space: nowrap;
}

.chatbox-five .promt-msg-wall .promt-msg1 div, .chatbox-five .promt-msg-wall .promt-msg2 div{
    border-radius: 5px;
    background: #17B585;
        padding: 3px 7px;
        margin-right:10px;
        margin-top:10px;
        color:#fff;
}

/*chatbox-five css end*/

/*chatbot-six css start*/

.chatbox-six .chatbox-header{
    border-radius: 10px 10px 0px 0px;
    background: #4DB0F9;
}
.chatbox-six .mr7{
    margin-right:7px;
}
.chatbox-six .ml15{
    margin-left:15px;
}
.chatbox-six .f-10{
    font-size:10px;
}
.chatbox-six .msg-self {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-six .chat-input-va{
    border-radius: 0px 0px 10px 10px ;
    background: #FFF;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.20);
    bottom:30px;
    position:absolute;
}
.chatbox-six.chatbox-va .chat-input-va button{
    background:#4DB0F9;
}
.chatbox-six .chatbox-poweredby{
    position: absolute;
    bottom: 0px;
    font-size: 10px;
    font-weight: 400;
    color: #A1BCD0;
    width: 100%;
    padding: 7px 10px;
    text-align:center;
}
.chatbox-six .msg-self-text{
    border-radius: 0px 10px 10px 10px;
    background: #4DB0F9;
    padding: 7px 15px;
    width: 100%;
    color:#fff;
     box-shadow: -5px 5px 0px 0px rgba(0, 0, 0, 0.25);
}
.chatbox-six .msg-remote-text{
    border-radius: 10px 10px 0px 10px;
    border: 2px solid #4DB0F9;
    background: #FFF;
    box-shadow: -5px 5px 0px 0px rgba(0, 0, 0, 0.25);
    padding: 7px 15px;
    width: 100%;
    color:#000000;
}
.chatbox-six .msg-remote{
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    padding: 0px !important;
}
.chatbox-six .msg-remote img{
    margin-left:15px;
}
.chatbox-six .msg-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius:50px;
  background:#4DB0F9;;
  padding:0px 7px;
   box-shadow: -5px 5px 0px 0px rgba(0, 0, 0, 0.25);
}

.chatbox-six .msg-wrapper .ball {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  margin: 0 2px;
  animation: 2s msgbounce ease infinite;
}

.chatbox-six .msg-wrapper .blue {
  background: rgba(255,255,255,0.5);
}

.chatbox-six .msg-wrapper .red {
  background:rgba(255,255,255,0.7);
  animation-delay: .25s;
}

.chatbox-six .msg-wrapper .yellow {
  background:#ffffff;
  animation-delay: .5s;
}


.chatbox-six .promt-msg-wall{
    width: 98%;
    overflow-x: scroll;
    padding: 10px;
    position: absolute;
    bottom: 100px;
    /* display: inline-flex; */
    display: -webkit-box;
    white-space: nowrap;
}

.chatbox-six .promt-msg-wall .promt-msg1 div, .chatbox-six .promt-msg-wall .promt-msg2 div{
    border-radius: 5px;
    border: 2px solid #4DB0F9;
    background: #FFF;
    box-shadow: -5px 5px 0px 0px rgba(0, 0, 0, 0.25);
    padding: 3px 7px;
    margin-right:10px;
    margin-top:10px;
    color:#000;
}

/*chatbot-six css end*/

.chatbot-pills button{
    padding:0px;
}
.chatbot-pills .nav-link.active{
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.40);
   background-color: transparent;
}
/* Scrollbar Styling */
.theme-scroll::-webkit-scrollbar {
  height: 5px;
}

.theme-scroll::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0);
}

.theme-scroll::-webkit-scrollbar-thumb{
  height: 5px;
  background-color: rgba(13,100,190,0.5);
}

.theme-scroll::-webkit-scrollbar-thumb:hover {
  background-color: #0D64BE !important;
}

.theme-scroll::-webkit-scrollbar:vertical{
  display: none;
}

@media only screen and (min-width :1200px){
.tabs-border{border-right:1px solid var(--theme-br);}
}

}
.pills-profile {
     position: relative; 
     overflow: hidden; 
}
.appoint-wall {
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.pills-profile:hover .appoint-btn {
    opacity: 1;
}
.pills-profile .appoint-btn {
    background: rgba(20, 15, 76, 1) !important;
    transition: none;
    z-
}
.appoint-wall .appoint-btn {
    position: absolute;
    background: rgba(0, 0, 0, 0.50);
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.3s ease;
    text-align: center;
    z-index: 2;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.appoint-wall .appoint-btn {
    position: absolute;
    background: rgba(0, 0, 0, 0.50);
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.3s ease;
    text-align: center;
    z-index: 2;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.appoint-btn {
    border-radius: 0px;
    background: var(--blue-gradient);
    color: var(--white-color);
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    padding: 15px 30px;
    text-decoration: none;
    display: inline-block;
    border: none;
}
.appoint-btn {
    border-radius: 0px;
    background: var(--blue-gradient);
    color: var(--white-color);
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    padding: 15px 30px;
    text-decoration: none;
    display: inline-block;
    border: none;
}
.appoint-inner .appoint-btn .appoint-link {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    color: var(--white-color);
    text-decoration: none;
    border-radius: 10px;
    background: #21A1FF;
    padding: 10px 20px;
    border: 0px;
    margin-top: 18px;
}
.appoint-inner .appoint-btn .appoint-link {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    color: var(--white-color);
    text-decoration: none;
    border-radius: 10px;
    background: #21A1FF;
    padding: 10px 20px;
    border: 0px;
    margin-top: 18px;
}
.tooltip {
  position: relative;
  display: block;
  opacity:1;
 
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 600px;
  text-align:center;
  background-color:#ebf7fd;
  color: #092E4A;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  backdrop-filter: contrast(0.5);
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
.appoint-wall2 .appoint-btn2 {
    position: absolute;
    background: rgba(0, 0, 0, 0.50);
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.3s ease;
    text-align: center;
    z-index: 2;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.appoint-wall2 .appoint-btn2 {
    position: absolute;
    background: rgba(0, 0, 0, 0.50);
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.3s ease;
    text-align: center;
    z-index: 2;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.appoint-btn2 {
    border-radius: 0px;
    background: var(--blue-gradient);
    color: var(--white-color);
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    padding: 15px 30px;
    text-decoration: none;
    display: inline-block;
    border: none;
}
.appoint-btn2 {
    border-radius: 0px;
    background: var(--blue-gradient);
    color: var(--white-color);
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    padding: 15px 30px;
    text-decoration: none;
    display: inline-block;
    border: none;
}
.appoint-inner2 .appoint-btn2 .appoint-link2 {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    color: var(--white-color);
    text-decoration: none;
    border-radius: 10px;
    background: #21A1FF;
    padding: 10px 20px;
    border: 0px;
    margin-top: 18px;
}
.appoint-inner2 .appoint-btn2 .appoint-link2 {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    color: var(--white-color);
    text-decoration: none;
    border-radius: 10px;
    background: #21A1FF;
    padding: 10px 20px;
    border: 0px;
    margin-top: 18px;
}
.appoint-inner2 .appoint-btn2 {
    position: absolute;
    background: rgba(0, 0, 0, 0.50);
    width: 66%;
    height: 50%;
    opacity: 1;
    transition: all 0.3s ease;
    text-align: center;
    z-index: 2;
    top: 250px;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
button#overview-tab{
    padding-left: 0;
    padding-right: 0;
}
.mt-md200{margin-top: 200px;}
.overview-wall {
    margin: 30px 0;
    padding: 50px 30px;
    border: 1px solid var(--theme-br);
    border-radius: 5px;
    @media only screen and (max-width : 575px){
        padding : 15px;
    }
}
.theme-btn-blue {
    border: none;
}
.theme-btn-blue2 {
    border-radius: 10px;
    background: var(--blue-gradient);
    color: var(--white-color);
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    padding: 10px 18px;
    text-decoration: none;
    display: inline-block;
}
.previous-btn2{
    padding: 7px 22px;
    border-radius: 10px;
    border: 1px solid var(--theme-br);
    font-size: 14px;
    font-weight: 400;
    display: inline-block;
}
.delete-btn{
    padding: 7px 22px;
    border-radius: 10px;
    border: 1px solid #FF361D;
    color: #FF361D;
    font-size: 14px;
    font-weight: 400;
    display: inline-block;
}

.disabled{
    pointer-events:none;
    opacity:0.9;
}
.training-history{
    height: 220px;
    overflow-y: scroll;
    overflow-x: hidden;
    padding: 0px 5px;
}
.va-selectpicker .filter-option {
    color : var(--grey-color);
}
</style>
 
 <?php
$assets_folder = $assetsFolder;
$redirect_base_url = $this->config->item('base_url');
?>
    
        <title><?php echo $this->config->item('productName') ?> || ChatBot</title>
        <!-- Main Container Start -->
            <div class="container-fluid container-padding" style="min-height: calc(90.2vh);" name="myForm">
                <div class="white-wrapper2 " style=" min-height: calc(100% - 100px);">
                    <form enctype="multipart/form-data">
                        <!--<div class="row">-->
                        <!--    <div class="col-12 mt50 mt-md50">-->
                        <!--        <div class="title-line">Chat Bot</div>-->
                        <!--        <p class="container-page-subtitle mt10">Create And Embed Chat-bot on any Website.</p>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="row mt3">
                            <div class="col-xl-8 col-12 tabs-border">
                                <ul class="nav nav-pills row  row-cols-3 row-cols-md-4 row-cols-lg-6 integration-pills text-center" id="pills-tab" role="tablist">
                                    <li class="nav-item col" role="presentation">
                                        <button class="nav-link progress-item <?php echo is_null($chatbotObj->form_step) || $chatbotObj->form_step == 5 ? 'active' : '' ?>"  id="overview-tab" data-step="1" data-bs-toggle="pill" data-bs-target="#pills-overview" type="button" role="tab" aria-controls="overview" aria-selected="true"><span class="icon-my-va size-icon"></span><span style="margin-left:5px">Overview</span></button>
                                    </li>
                                    <li class="nav-item col" role="presentation">
                                        <button class="nav-link progress-item <?php echo $chatbotObj->form_step == 1 ? 'active' : '' ?>" id="pills-theme-tab" data-step="2" data-bs-toggle="pill" data-bs-target="#pills-theme" type="button" role="tab" aria-controls="theme" aria-selected="true"><span class="icon-my-va size-icon"></span><span style="margin-left:5px">Themes</span></button>
                                    </li>
                                    <li class="nav-item col" role="presentation">
                                        <button class="nav-link progress-item <?php echo $chatbotObj->form_step == 2 ? 'active' : '' ?>" id="profiletab" data-step="3" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><span class="icon-my-va size-icon"></span><span style="margin-left:5px">Profile</span></button>
                                    </li>
                                    <li class="nav-item col" role="presentation">
                                        <button class="nav-link progress-item <?php echo $chatbotObj->form_step == 3 ? 'active' : '' ?>" id="pills-contact-tab" data-step="4" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><span class="icon-my-va size-icon"></span><span style="margin-left:5px">Q&A</span></button>
                                    </li>
                                     <li class="nav-item col" role="presentation">
                                        <button class="nav-link progress-item <?php echo $chatbotObj->form_step == 4 ? 'active' : '' ?>" id="pills-training-tab" data-step="5" data-bs-toggle="pill" data-bs-target="#pills-training" type="button" role="tab" aria-controls="training" aria-selected="false"><span class="icon-my-va size-icon"></span><span style="margin-left:5px">Training</span></button>
                                    </li>
                                    <li class="nav-item col" role="presentation">
                                        <button class="nav-link progress-item" id="pills-cta-tab" data-step="6" data-bs-toggle="pill" data-bs-target="#pills-cta" type="button" role="tab" aria-controls="cta" aria-selected="false"><span class="icon-my-va size-icon"></span><span style="margin-left:5px">CTA</span></button>
                                    </li> 
                                </ul>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1"
                                        aria-valuemax="6" style="width: 20%; height:5px;">
                                    </div>
                                </div>
                                <!--Tab One Start-->
                                <div class="tab-content theme-scroll" id="pills-tabContent">
                                    <!-- Overview Tab Start -->
                                    <div class="tab-pane fade <?php echo is_null($chatbotObj->form_step) || $chatbotObj->form_step == 5 ? 'show in active' : '' ?>" class="pills-overview" id="pills-overview" role="tabpanel" aria-labelledby="overview-tab">
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="overview-wall">
                                                    <div class="row align-items-center">
                                                        <div class="col-xl-8 d-flex align-items-center justify-content-xl-start justify-content-center flex-column flex-sm-row">
                                                            <div class="profile-img profile-text">
                                                                <img src="https://cdn.intellimateai.co/assets/images/intelimateai-chat-bot.png" alt="Profile Img" class="img-fluid mx-auto d-block outputimage">
                                                            </div>
                                                            <div class="" style="margin-left:15px;">
                                                                <div class="ng-binding">
                                                                    <strong>Chatbot Name: </strong> {{text}}
                                                                </div>
                                                                <div class="">
                                                                    <strong>Status: </strong> {{trainStatus}}
                                                                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#34C300" class="bi bi-dot" viewBox="0 0 16 16">-->
                                                                        <!--    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>-->
                                                                        <!--</svg>-->
                                                                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if($created) { ?>
                                                        <div class="col-xl-3 mt-3 mt-xl-4 offset-xl-1 col-12 text-center px-md-0">
                                                            <div class="theme-btn-blue2 cursor-pointer" ng-click="tabChange('pills-theme-tab')"><span class="icon-list-edit"> </span> Customize</div>
                                                            <div  class="previous-btn2 mt-2 mt-xl-4 cursor-pointer" ng-click="tabChange('pills-training-tab')">Train More <span class="icon-right"> </span> </div>
                                                        </div>
                                                        <?php } else { ?>
                                                        <div class="col-xl-3 offset-xl-1 mt-3 mt-xl-0 col-12 text-center px-md-0">
                                                            <div  class="theme-btn-blue2 cursor-pointer" ng-click="tabChange('pills-theme-tab')"> Let’s Create <span class="icon-right"> </span></div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <?php if($created) { ?>
                                            <div class="col-xl-7 mx-auto col-12 d-flex align-items-center justify-content-between flex-column flex-sm-row">
                                                <div class="theme-btn-blue2  getEmbedCode cursor-pointer mb-2 mb-sm-0" data-script='<?= $chatbotObj->script_tag ?>'><i class="icon-copy" style="line-height:1.25rem;"></i> Copy Embed Code</div>
                                                <div class="delete-btn delete-va cursor-pointer" data-id="<?= $chatbotObj->id ?>"><span class="icon-list-delete"></span> Delete</div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <!--<div class="row mt20 mt-md30 align-items-center">-->
                                        <!--    <div class="col-md-6 col-12">-->
                                        <!--        <p><strong>Chatbot Name: </strong> {{text}}</p>-->
                                        <!--        <p class="mt20 mt-md30"><strong>Status: </strong><?php echo ($chatbotObj->cron_status) ? $chatbotObj->cron_status : 'Not created yet' ?></p>-->
                                        <!--    </div>-->
                                        <!--    <div class="col-md-6 col-12 text-center">-->
                                        <!--        <div class="profile-img profile-text">-->
                                        <!--            <img src="https://cdn.intellimateai.co/assets/images/intelimateai-chat-bot.png" alt="Profile Img" class="img-fluid mx-auto d-block outputimage">-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<div class="row mt20 mt-md50">-->
                                        <!--    <?php if($created) { ?>-->
                                        <!--    <div class="col-md-12 col-12 d-flex align-items-center justify-content-between mt40 mt-md200">-->
                                        <!--        <button class="btn btn-success" ng-click="tabChange('pills-theme-tab')">Customize <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="m9.707 13.707l5-5a.999.999 0 0 0 0-1.414l-5-5a.999.999 0 1 0-1.414 1.414L11.586 7H2a1 1 0 0 0 0 2h9.586l-3.293 3.293a.997.997 0 0 0 0 1.414a.999.999 0 0 0 1.414 0"/></svg></button>-->
                                        <!--        <button class="btn btn-success" ng-click="tabChange('pills-training-tab')">Train More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="m9.707 13.707l5-5a.999.999 0 0 0 0-1.414l-5-5a.999.999 0 1 0-1.414 1.414L11.586 7H2a1 1 0 0 0 0 2h9.586l-3.293 3.293a.997.997 0 0 0 0 1.414a.999.999 0 0 0 1.414 0"/></svg></button>-->
                                        <!--        <?php if($chatbotObj->script_tag) { ?>-->
                                        <!--            <button class="btn btn-info getEmbedCode" data-script='<?php echo $chatbotObj->script_tag; ?>'><i class="icon-copy" style="line-height:1.25rem;"></i>Copy Embed Code</button>-->
                                        <!--        <?php } ?>-->
                                        <!--        <button class="btn btn-danger delete-va" data-id="<?= $chatbotObj->id ?>">Delete</button>-->
                                        <!--    </div>-->
                                        <!--    <?php } else { ?>-->
                                        <!--    <button class="btn btn-success" ng-click="tabChange('pills-theme-tab')">Let's Create <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="m9.707 13.707l5-5a.999.999 0 0 0 0-1.414l-5-5a.999.999 0 1 0-1.414 1.414L11.586 7H2a1 1 0 0 0 0 2h9.586l-3.293 3.293a.997.997 0 0 0 0 1.414a.999.999 0 0 0 1.414 0"/></svg></button>-->
                                        <!--    <?php } ?>-->
                                        <!--</div>-->
                                    </div>
                                    <!-- Overview Tab End -->
                                
                                    <!-- Themes Tab Start -->
                                    <div class="tab-pane fade <?php echo $chatbotObj->form_step == 1 ? 'show in active' : '' ?>" id="pills-theme" role="tabpanel" aria-labelledby="pills-theme-tab">
                                        <div class="row mt20 mt-md-30 justify-content-center">
                                            <ul class="nav nav-pills row mb-3 chatbot-pills try" id="pills-tab" role="tablist">
                                                <li class="nav-item col-md-4" role="presentation">
                                                    <button class="nav-link chatbot-themes" data-theme="chatbox-one" ng-click="setThemeColor('#0D64BE', '#CEE0F2', '#0D64BE','#000000','#FFF'); setThemeClass('chatbox-one,none', 'chatbox-one')" id="pills-chatbot1-tab" data-bs-toggle="pill" data-bs-target="#pills-chatbot1" type="button" role="tab" aria-controls="chatbot1" aria-selected="true">
                                                        <img src="<?php echo $assetsPath.'images/theme-1.png' ; ?>" class="d-block img-fluid mx-auto chatbot-theme" alt="Chatbot-One">
                                                    </button>
                                                </li>
                                                <li class="nav-item col-md-4 mt20 mt-md0" role="presentation">
                                                    <button class="nav-link chatbot-themes" data-theme="chatbox-two" ng-click="setThemeColor('#FF8383', '#FFC1C1', '#FFC1C1','#000000','#000000'); setThemeClass('chatbox-two,none', 'chatbox-two')" id="pills-chatbot2-tab" data-bs-toggle="pill" data-bs-target="#pills-chatbot2" type="button" role="tab" aria-controls="chatbot2" aria-selected="false">
                                                        <img src="<?php echo $assetsPath.'images/theme-2.png' ; ?>" class="d-block img-fluid mx-auto chatbot-theme" alt="Chatbot-One">
                                                    </button>
                                                </li>
                                                <li class="nav-item col-md-4 mt20 mt-md0" role="presentation">
                                                    <button class="nav-link chatbot-themes" data-theme="chatbox-three"  ng-click="setThemeColor('#DA8301', '#ECC17F', '#ECC17F','#000000','#000000'); setThemeClass('chatbox-three,none', 'chatbox-three')" id="pills-chatbot3-tab" data-bs-toggle="pill" data-bs-target="#pills-chatbot3" type="button" role="tab" aria-controls="pills-chatbot3" aria-selected="false">
                                                        <img src="<?php echo $assetsPath.'images/theme-3.png' ; ?>" class="d-block img-fluid mx-auto chatbot-theme" alt="Chatbot-One">
                                                    </button>
                                                </li>
                                                 <li class="nav-item col-md-4 mt20 mt-md30" role="presentation">
                                                    <button class="nav-link chatbot-themes" data-theme="chatbox-four" ng-click="setThemeColor('#6223C6', '#6223C6', '#FFF','#FFF','#000000'); setThemeClass('chatbox-four,block', 'chatbox-four')" id="pills-chatbot4-tab" data-bs-toggle="pill" data-bs-target="#pills-chatbot4" type="button" role="tab" aria-controls="chatbot4" aria-selected="false">
                                                        <img src="<?php echo $assetsPath.'images/theme-4.png' ; ?>" class="d-block img-fluid mx-auto chatbot-theme" alt="Chatbot-One">
                                                    </button>
                                                </li>
                                                <li class="nav-item col-md-4 mt20 mt-md30" role="presentation">
                                                    <button class="nav-link chatbot-themes" data-theme="chatbox-five" ng-click="setThemeColor('#18B586', '#18B586', '#E5E5E5','#FFF','#000000'); setThemeClass('chatbox-five,block', 'chatbox-five')" id="pills-chatbot5-tab" data-bs-toggle="pill" data-bs-target="#pills-chatbot5" type="button" role="tab" aria-controls="chatbot5" aria-selected="false">
                                                        <img src="<?php echo $assetsPath.'images/theme-5.png' ; ?>" class="d-block img-fluid mx-auto chatbot-theme" alt="Chatbot-One">
                                                    </button>
                                                </li> 
                                                <li class="nav-item col-md-4 mt20 mt-md30" role="presentation">
                                                    <button class="nav-link chatbot-themes" data-theme="chatbox-six" ng-click="setThemeColor('#4DB0F9', '#4DB0F9', '#FBFDFD','#FFF','#000000'); setThemeClass('chatbox-six,block', 'chatbox-six')" id="pills-chatbot6tab" data-bs-toggle="pill" data-bs-target="#pills-chatbot6" type="button" role="tab" aria-controls="chatbot6" aria-selected="false">
                                                        <img src="<?php echo $assetsPath.'images/theme-6.png' ; ?>" class="d-block img-fluid mx-auto chatbot-theme" alt="Chatbot-One">
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row mt20 mt-md30">
                                            <div class="col-12 d-flex align-items-center justify-content-end">
                                                <!--<a href="#" class="previous-btn"><i class="icon-left"></i> Previous</a>-->
                                                <a href="javascript:void(0)" ng-click="storeTheme()" class="next-btn" >Save & Next <i class="icon-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Themes Tab End -->

                                    <!-- Profile Tab Start -->
                                    <div class="tab-pane fade <?php echo $chatbotObj->form_step == 2 ? 'show in active' : '' ?>" class="pills-profile" id="pills-profile" role="tabpanel" aria-labelledby="profiletab">
                                        <div class="appoint-inner">
                                            <div class="row mt20 align-items-center">
                                                <div class="col-xxl-6 col-xl-6 col-md-6 mt-md0">
                                                    <div class="row align-items-center">
                                                        <div class=" col-md-12 d-flex align-items-center">
                                                            <div class="profile-img profile-text">
                                                                <img src="https://cdn.intellimateai.co/assets/images/intelimateai-chat-bot.png" alt="Profile Img" class="img-fluid mx-auto d-block outputimage">
                                                                <!-- Edit Profile Picture -->
                                                                <label for="formFiles" class="profile-text d-none"><i class="icon-list-edit"></i></label>
                                                                <input  onchange="loadFileSelector(event)" class="form-control d-none" type="file" id="formFiles" name="image" placeholder="Edit Profile Picture">
                                                            </div>
                                                            <label for="upload" class="form-label mt20 ps-4">Bot Profile Image</label>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <div class="col-xxl-6 col-xl-6 col-md-6 mt20 mt-md0">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 d-flex align-items-center">
                                                            <div class="profile-img1 profile-text1">
                                                                <img src="<?= $assetsPath.'images/intelimateai-chat-bot.png' ?>" alt="Profile Img" class="img-fluid mx-auto d-block widget_show">
                                                                <label for="widget_image" class="profile-text1 d-none"><i class="icon-list-edit"></i></label>
                                                                <input onchange="loadWidgetFile(event)"  class="form-control d-none" id="widget_image" type="file"  name="widget_image" >
                                                            </div>
                                                             <label for="upload1" class="form-label mt20 ps-4">Widget Image</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt50 mt-md30">
                                                <div class="col-md-6">
                                                     <label for="vaname" class="form-label">Chatbot Name</label>
                                                     <input type="text" class="form-control search-clr" ng-model="text" id="naname" placeholder="Enter Name" ng-change="checkWebButton()">
                                                </div>
                                                <div class="col-md-6 mt20 mt-md0">
                                                    <div class="va-selectpicker"  style="height:52px">
                                                        <label for="vatype" class="form-label">Bot Language</label> 
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
                                                                <label for="colorPicker mt5">
                                                                <input type="color" ng-model="bottheme_color" ng-change="updateButtonColor('bottheme_color')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                             
                                                <div class="col-md-6 mt20 mt-md0">
                                                    <div class="accordion" id="accordionExample" style="">
                                                        <label for="accordion" class="form-label">Chatbot Background</label>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button class="accordion-button collapsed"  id="collClose" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                                                                               ng-click='updateChatBg("https://cdn.intellimateai.co/assets/images/whitebg1.webp")'>
                                                                           </a>
                                                                        </div>
                                                                        <div class="col-4 col-md-4">
                                                                            <a href="javascript:void(0)">
                                                                               <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg2.png"
                                                                               alt="Chat Background" class="mx-auto d-block img-fluid"
                                                                               ng-click='updateChatBg("https://cdn.intellimateai.co/assets/images/bg2.webp")'>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-4 col-md-4">
                                                                            <a href="">
                                                                                <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg3.png"
                                                                                   alt="Chat Background" class="mx-auto d-block img-fluid"
                                                                                   ng-click='updateChatBg("https://cdn.intellimateai.co/assets/images/bg3.webp")'>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-4 col-md-4 mt10">
                                                                            <a href="">
                                                                                <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg4.png"
                                                                                   alt="Chat Background" class="mx-auto d-block img-fluid"
                                                                                   ng-click='updateChatBg("https://cdn.intellimateai.co/assets/images/bg4.webp")'>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-4 col-md-4 mt10">
                                                                            <a href="">
                                                                            <img src="<?= $this->config->item('assetsBasePath') ?>assets/images/chat-bg5.png"
                                                                               alt="Chat Background" class="mx-auto d-block img-fluid"
                                                                               ng-click='updateChatBg("https://cdn.intellimateai.co/assets/images/bg5.webp")'>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-4 col-md-4 mt10">
                                                                            <div class="bg-upload">
                                                                                <label for="formFile" class="base-btn upload-btn show_upload cw-icons"><img src="<?= $this->config->item('assetsBasePath') ?>assets/images/add.png" alt="Chat Background" class="mx-auto d-block img-fluid"></label>
                                                                                 <input class="form-control d-none" type="file" id="formFile" name="uploadFiles" placeholder="Edit Profile Picture">
                                                                            </div>
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
                                                    
                                                    <div class="va-selectpicker">
                                                        <label for="vaexpertise" class="form-label">Bot Text Color</label>
                                                        <div class="search-clr">
                                                            <div class="color-picker-html">
                                                                <label for="colorPicker mt5">
                                                                <input type="color" ng-model="bottext_color"  ng-change="updateButtonColor('bottext_color')"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt20 mt-md0">
                                                    
                                                    <div class="va-selectpicker">
                                                        <label for="vaexpertise" class="form-label">Bot Background Color</label>
                                                        <div class="search-clr">
                                                            <div class="color-picker-html">
                                                                <label for="colorPicker mt5">
                                                                <input type="color" ng-model="botbackground_color"  ng-change="updateButtonColor('botbackground_color')"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="row mt20 mt-md30">
                                                <div class="col-md-6">
                                                    <div class="va-selectpicker">
                                                        <label for="vaexpertise" class="form-label"> User Text Color </label>
                                                        <div class="search-clr">
                                                            <div class="color-picker-html">
                                                                <label for="colorPicker mt5">
                                                                <input type="color" ng-model="usertext_color" ng-change="updateButtonColor('usertext_color')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt20 mt-md0">
                                                    <div class="va-selectpicker">
                                                        <label for="vaexpertise" class="form-label">User Background Color</label>
                                                        <div class="search-clr">
                                                            <div class="color-picker-html">
                                                                <label for="colorPicker mt5">
                                                                <input type="color" ng-model="userbackground_color"  ng-change="updateButtonColor('userbackground_color')"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                      
                                            <div class="row mt20 mt-md-30" ng-hide="isHide">
                                                <div class="col-md-6">
                                                    <label for="vaname" class="form-label">Website Content</label>
                                                    <textarea class="form-control"  rows="4" cols="10" ng-model="website_content"  id="website_auth_content" placeholder="Enter Content"></textarea>
                                                </div>
                                            </div>
                         
                                            <div class="row mt20 mt-md30">
                                                <div class="col-12 d-flex align-items-center justify-content-between">
                                                    <a href="javascript:void(0)" ng-click="tabChange('pills-theme-tab')" class="previous-btn"><i class="icon-left"></i> Previous</a>
                                                    <a href="javascript:void(0)" ng-click="storeProfile()" class="next-btn">Save & Next <i class="icon-right"></i></a>
                                                    
                                                </div>
                                            </div>

                                            <!--<?php if(!in_array('welcome_message',$this->session->userdata('features'))) { ?>-->
                                            <!--<div class="appoint-btn">-->
                                            <!--    <form action="<?= base_url('subscription') ?>"  class="">-->
                                            <!--        <input type="hidden" name="" value="">-->
                                            <!--        <input type="submit" value="Upgrade Your Plan" class="appoint-link">-->
                                            <!--    </form>-->
                                            <!--</div>-->
                                            <!--<?php } ?>-->
                                       </div>
                                    </div>
                                    <!-- Profile Tab End -->
                        
                                    <!-- Q&A Tab Start-->
                                    <div class="tab-pane fade <?php echo $chatbotObj->form_step == 3 ? 'show in active' : '' ?>" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <div class="appoint-inner">
                                           <div class="row mt20 mt-md30">
                                              <div class="col-12">
                                                 <div class="blue-clr">
                                                    Welcome Message
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="info-box mt10">
                                              <div class="row">
                                                 <div class="col-12">
                                                    <div class="row">
                                                       <div class="col-md-9">
                                                          <div class="blue-clr mt10 option-wall massage-wall">
                                                                
                                                                <textarea class="form-control" name=""
                                                                   placeholder="I'm here to help you with anything you need, from answering your questions to providing you with information and support." ng-model='prompt' value="" style="border:none"></textarea>
                                                             </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                          <!--<img src="robot.png" alt="Robot" class="mx-auto d-block img-fluid">-->
                                                          <img src="<?= $assetsPath.'/images/robot.png' ?>" class="d-block img-fluid mx-auto">
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="row mt20">
                                                <div class="col-md-6">
                                                    <div class="mt10">
                                                        <div class="option-wall opion-list-sec">
                                                            <div class="blue-clr mb-1 mb-md-2">Question1</div>
                                                            <input type="text" name="question[]" id="question1" placeholder="Question 1" value="">
                                                        </div>
                                                        <div class="option-wall mt15 opion-list-sec">
                                                            <div class="blue-clr mb-1 mb-md-2">Question2</div>
                                                            <input type="text" name="question[]" id="question2" placeholder="Question 2" value="">
                                                        </div>
                                                        <div class="option-wall mt15 opion-list-sec">
                                                            <div class="blue-clr mb-1 mb-md-2">Question3</div>
                                                            <input type="text" name="question[]" id="question3" placeholder="Question 3" value="">
                                                        </div>
                                                        <div class="option-wall mt15 opion-list-sec">
                                                            <div class="blue-clr mb-1 mb-md-2">Question4</div>
                                                            <input type="text" name="question[]" id="question4" placeholder="Question 4" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mt10">
                                                        <div class="option-wall">
                                                            <div class="blue-clr mb-1 mb-md-2">Response1</div>
                                                            <input type="text" name="question_response1" id="answer1" placeholder="Answer 1" value="">
                                                        </div>
                                                        <div class="option-wall mt15">
                                                            <div class="blue-clr mb-1 mb-md-2">Response2</div>
                                                            <input type="text" name="question_response2" id="answer2" placeholder="Answer 2" value="">
                                                        </div>
                                                        <div class="option-wall mt15">
                                                            <div class="blue-clr mb-1 mb-md-2">Response3</div>
                                                            <input type="text" name="question_response3" id="answer3" placeholder="Answer 3" value="">
                                                        </div>
                                                        <div class="option-wall mt15">
                                                            <div class="blue-clr mb-1 mb-md-2">Response4</div>
                                                            <input type="text" name="question_response4" id="answer4" placeholder="Answer 4" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                              <!--</div>-->
                                            </div>
                                        
                                           <!--<div id="addQuestion"></div>-->
                                        
                                           <!--<div class="more-btn" id="question">-->
                                           <!--   <a href="javascript:void(0);"><i class="icon-create-new-campaign"></i>More-->
                                           <!--      Question</a>-->
                                           <!--</div>-->
                                           
                                           <!--<button type="button" ng-click="vaCreate()">Click</button>-->

                                            <div class="row mt20 mt-md30">
                                                <div class="col-12 d-flex align-items-center justify-content-between">
                                                    <a href="javascript:void(0)" ng-click="tabChange('profiletab')" class="previous-btn"><i class="icon-left"></i> Previous</a>
                                                    <a href="javascript:void(0)" ng-click="storeQA()" class="next-btn">Save & Next <i class="icon-right"></i></a>
                                                </div>
                                            </div>
                                            <!--<?php if(!in_array('welcome_message',$this->session->userdata('features'))) { ?>-->
                                            <!--<div class="appoint-btn">-->
                                            <!--    <form action="<?= base_url('subscription') ?>"  class="">-->
                                            <!--        <input type="hidden" name="" value="">-->
                                            <!--        <input type="submit" value="Upgrade Your Plan" class="appoint-link">-->
                                            <!--    </form>-->
                                            <!--</div>-->
                                            <!--<?php } ?>-->
                                        </div>
                                    </div>
                                    <!--Q&A Tab End-->
                        
                                    <!-- Training Tab Start-->
                                    <div class="tab-pane fade <?php echo $chatbotObj->form_step == 4 ? 'show in active' : '' ?>" id="pills-training" role="tabpanel" aria-labelledby="pills-training-tab">
                                        <div class="row mt20 mt-md-30">
                                            <div class="col-md-12">
                                                <div class="blue-clr">
                                                    <div class="d-flex align-items-center">
                                                        <!--<div class="tooltip mt20"> <span class="icon-information">-->
                                                        <!--    <span class="tooltiptext">Training your bot with a URL requires the addition of a Free Pinecone account. Simply navigate to the left-hand side, click on Integration, and select Pinecone to proceed. <a href="https://www.youtube.com/watch?v=tJUeMxOJ0dI">https://www.youtube.com/watch?v=tJUeMxOJ0dI</a></span>-->
                                                        <!--     </span>-->
                                                        <!--</div>-->
                                                        <div class="mt20"><a href="<?= base_url('integration') ?>"><u> Integrate Free Pincone API</u></a> Key before Training ChatBot </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        Train Bot Using URL &nbsp
                                                    </div>
                                                </div>
                                                
                                              
                                                     <div class="mt10">
                                                    <input type="text"  name="url[]" placeholder="Enter Your Url" class="form-control search-clr"  style="margin-bottom:20px;">
                                                </div>
                                                
                                               <div id="urlDiv" ></div>
                                                    <button type="button" id="addUrl" class="file-input__label previous-btn" > <i class="icon-create-new-campaign"></i> &nbsp More</button>
                                                   
                                             
                                                
                                                <div class="blue-clr mt20 mt-md-30 text-center">
                                                    OR
                                                </div>
                                                <div class="blue-clr mt20 text-center">
                                                    Train Bot Using PDF
                                                </div>
                                                <div class="text-center mt20">
                                                    <!--<a href="#"  onclick="importData()" class="theme-btn-blue">Choose File</a>-->
                                                    <div class="file-input">
                                                        <input type="file" name="file-input" id="file-input"  ng-model="pdfs" class="file-input__input" multiple="multiple" onchange="updateFileCounter()" />
                                                        <label class="file-input__label theme-btn-blue" for="file-input"> <span>Upload file</span></label>
                                                    </div>
                                                        <span style="margin-top:15px;color:red;font-weight:600; display:block;"> You Can upload Maximum 5 Pdfs </span>
                                                      <p id="file-count-message" style="display: none;">Number of files selected: <span id="file-count">0</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <p class="mt-2">Training History</p>
                                        <div class="training-history">
                                        <?php
                                        //  if($this->session->userdata('logged_in')['id']==3){
                                            foreach($training_data as $key => $val){
                                             $pdfs = json_decode($val['pdf_uploads'],true);
                                             $urls = json_decode($val['url_uploads'],true);
                                         ?>
                                        <div class="text-secondary row mb-2 mb-md-3 row-cols-md-3 row-cols-1 border rounded me-0 ms-0 p-1 justify-content-center">
                                       <div class="text-center text-md-start text-truncate d-flex align-items-center gap-2">
                                           <span><?= date('Y-m-d', strtotime($val['created_at'])) ?></span>
                                           <?php  if($chatbotObj->cron_status =='complete' ) { ?> 
                                           <i class="icon-check size-icon"></i> 
                                           <?php   }elseif($chatbotObj->cron_status =='failed' ) { ?>
                                                 <i class="icon-total-article size-icon"></i>
                                            <?php   }else  { ?>
                                           <i class="icon-light-mode size-icon"></i>
                                           <?php } ?>
                                       </div>
                                              
                                        <?php 
                                        if(count($pdfs) > 0){
                                        foreach($pdfs as $key => $p){ ?>
                                       
                                       
                                                    <div><span class="icon-pdf"></span> &nbsp&nbsp <?= $p ?></div>
                                                    <?php }  }else{ ?>
                                                    <div class="text-center text-md-start text-truncate d-flex align-items-center gap-2"><span class="icon-pdf"></span>  Traing with no data</div>
                                                <?php } ?>
                                                
                                          
                                        <?php 
                                        if(count($urls) > 0){
                                        foreach($urls as $key => $u){ ?>
                                                    <div class="text-center text-md-start text-truncate d-flex align-items-center gap-2"><span class="icon-url-link"></span>  <?= $u ?></div>
                                                     <?php }  }else{ ?>
                                                    <div class="text-center text-md-start text-truncate d-flex align-items-center gap-2 text-truncate"><span class="icon-url-link"></span>  Traing with no data</div>
                                                <?php } ?> 
                                                

                                       
                                        </div>
                                        <?php  } ?>
                                        </div>
                                        
                                        
                                        
                                        <div class="row mt20 mt-md70">
                                            <div class="col-12 d-flex align-items-center justify-content-between">
                                                <a href="javascript:void(0)" ng-click="tabChange('pills-contact-tab')" class="previous-btn"><i class="icon-left"></i> Previous</a>
                                            <a href="javascript:void(0)" ng-click="storeTraining()" class="next-btn">Save & Next<i class="icon-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Training Tab End-->
                                
                                    <!-- CTA Tab Start-->
                                    <div class="tab-pane fade" id="pills-cta" role="tabpanel" aria-labelledby="pills-cta-tab">
                                        <div class="appoint-inner2">
                                            <div class="row mt20">
                                                <div class="col-12">
                                                    <div class="row row-gap-2">
                                                        <div class="col-md-6">
                                                            <div class="va-selectpicker">
                                                                <div class="d-flex align-items-center">
                                                                    <div for="vatype" class="form-label">Collect leads &nbsp</div>
                                                                    
                                                                    <!--<div class="tooltip" style="margin-bottom:5px;"> <span class="icon-information">-->
                                                                    <!--    <span class="tooltiptext">To gather leads in your preferred Autoresponder/Webinar/CRM platform, navigate to the left-hand side and click on Integration to proceed. </span>-->
                                                                    <!--     </span>-->
                                                                    <!--</div>-->
                                                                </div>
                                                                
                                                                <div class="dropdown bootstrap-select custom-drop dropup ds-select">
                                                                    <div class="dropdown bootstrap-select custom-drop">
                                                                        <select name="autoresponder" id="autoresponder" ng-change="checkWebButton()" class="selectpicker custom-drop responder_list" data-live-search="true" tabindex="null" ng-model="autoresponders">
                                                                            <option value=""  >Select Autoresponder</option>
                                                                            <?php foreach ($autoresponder as $key => $autores) { ?>
                                                                              <option value="<?= $autores['id'] ?>" <?php echo $autores['id'] == $chatbotObj->autoresponder_id ? 'selected' : '' ?>><?= $autores['title'] ?></option>-
                                                                             <?php }  ?>
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="va-selectpicker">
                                                                <label for="vatype" class="form-label">Select List</label> 
                                                                <div class="dropdown bootstrap-select custom-drop dropup ds-select">
                                                                    <div class="dropdown bootstrap-select custom-drop">
                                                                        <select name="select_list" id="select_list" ng-model="select_list" ng-change="checkWebButton()" class="responder_form_list selectpicker custom-drop" data-live-search="true" tabindex="null">
                                                                            <option class="responder_form_option" value="">Select List</option>
                                                                            <option ng-repeat="list_response in autoresponder_list_response" value="{{list_response.listid}}"> {{list_response.title}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12 mt-2">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="autoresponder_Checkbox" checked>
                                                          <label class="grey-clr form-check-label" for="autoresponder_Checkbox">
                                                                Yes, I want to proceed without Autoresponder Integration. All leads generated through the chatbot will be saved in the Leads section.
                                                          </label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-12 mt20 mt-md70">
                                                    <div class="blue-clr">
                                                        Show Closing Message
                                                    </div>
                                                    <div class="blue-clr mt10 option-wall">
                                                        <!-- What is your least favorite thing about being a chatbot? -->
                                                        <textarea class="grey-clr form-control"  ng-model="close_message" rows="10" placeholder="I'm here to help you with anything you need, from answering your questions to providing you with information and support."></textarea>
                                                    </div>
                                                </div>
                                                <!--<div class="col-12 mt20 mt-md20">-->
                                                <!--    <div class="row align-items-center">-->
                                                <!--        <div class="col-md-9 col-12">-->
                                                <!--            <h6>-->
                                                <!--               Consider chat close after there is no responce from user-->
                                                <!--            </h6>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </div>
                                            <div class="row mt20 mt-md100">
                                                <div class="col-12 d-flex align-items-center justify-content-between">
                                                    <a href="javascript:void(0)" ng-click="tabChange('pills-training-tab')" class="previous-btn"><i class="icon-left"></i> Previous</a>
                                                    
                                                    <a href="javascript:void(0)"  ng-click="storeCta()" class="btn btn-primary"><i class="icon-copy" style="line-height:1.25rem;"></i>  Save and Copy Embed</a>
                                                </div>
                                            </div>
                                            <!--<?php if(!in_array('welcome_message',$this->session->userdata('features'))) { ?>-->
                                            <!--<div class="appoint-btn2">-->
                                            <!--     <form action="<?= base_url('subscription') ?>"  class="">-->
                                            <!--        <input type="hidden" name="" value="">-->
                                            <!--        <input type="submit" value="Upgrade Your Plan" class="appoint-link2">-->
                                                    
                                            <!--    </form>-->
                                            <!--</div>-->
                                            <!--<?php } ?>-->
                                        </div>
                                    </div>
                                    <!-- CTA Tab End-->
                                </div>
                            </div>
                         
                    </form>
                    <div class="col-12 col-xl-4">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="blue-clr mt20">Chatbot Preview</div>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show in active" id="pills-chatbot1" role="tabpanel" aria-labelledby="pills-chatbot1-tab">
                                    <!--Chatbot One Start-->
                                    <div class="chatbox-va chatbox-one" style=" display: block;" id="chatbox-one">
                                        <div class="chatbox-header" ng-style="bottheme_style">
                                            <div class="chatbox-text">
                                                <div>
                                                    <img src="<?= $assetsPath.'default/images/intelimateai.png' ?>" width="50" class="d-block img-fluid mr7 outputimage">
                                                </div>
                                                <div>
                                                    <div class="f-14 f-md-16 w600">{{text}}</div>
                                                    <div class="f-10 w400">Online</div>
                                                </div>
                                            </div>
                                            <div class="cross-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <rect y="9" width="20" height="2" rx="1" fill="white"/>
                                                </svg>
                                                <img src="https://i.ibb.co/bHrtxqF/545121.png" width="15" height="15" id="hideClick" class="ml15">
                                            </div>
                                        </div>
                    
                                        <div class="chat-window">
                                            <div class="message msg-container msg-self msg-box messages">
                                                <!--<div ng-style="usertext_style">-->
                                                <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                                <!--</div>-->
                                                <div>
                                                        <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-self-text"  ng-style="botbackground_style">
                                                    <span ng-style="bottext_style">Hello! How can I assist you ?</span>
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-remote msg-box messages">
                                                <!--<div ng-style="bottext_style">-->
                                                <!--    <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">:Hello! How can I assist you today?-->
                                                <!--</div>-->
                                                <div class="msg-remote-text"  ng-style="userbackground_style">
                                                   <span ng-style="usertext_style">How can I setup my account ?</span>
                                                </div>
                                                <div>
                                                    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-self msg-box messages">
                                                <div>
                                                        <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-wrapper" ng-style="botbackground_style">
                                                    <div class="blue ball"   ng-style="userbackground_style"></div>
                                                    <div class="red ball"    ng-style="userbackground_style"></div>  
                                                    <div class="yellow ball" ng-style="userbackground_style"></div>  
                                                </div>
                                            </div>
                                            <!--<div class="text-end">-->
                                            <!--    <button class="regenerate-code" ng-style="bottheme_style">-->
                                            <!--        <i class="icon-refresh size-icon"></i>-->
                                            <!--    </button>-->
                                            <!--</div>-->
                                        </div>
                                        
                                        <div class="promt-msg-wall" >
                                            <div class="promt-msg1">
                                                <div ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Create Chat Bot</span>
                                                </div>
                                                <div class="d-none" ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Upgrade Plan </span>
                                                </div>
                                            </div>
                                            
                                            <div class="promt-msg2">
                                                <div ng-style="userbackground_style">
                                                    <span  ng-style="usertext_style">Train Chatbot</span>
                                                </div>
                                                
                                                <div class="d-none"  ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Api Integration</span></div>                                            
                                            </div>
                                        </div>

                                        <div class="chat-input-va ng-pristine ng-valid align-items-center" onsubmit="return false;">
                                            <input type="text" autocomplete="on" placeholder="Type a message" id="input">
                                            <button type="button" ng-style="bottheme_style">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50; width:22px; height:22px;" xml:space="preserve">
                                                    <style type="text/css">
                                                        .st0 {
                                                            fill: #ffffff;
                                                        }
                                                    </style>
                                                    <path class="st0" d="M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
                                                    l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        
                                        <div class="chatbox-poweredby">
                                            <div class="d-flex align-items-center justify-content-center" style="gap:5px;">Powered by 
                                            <span>
                                                <img class="img-fluid" src="<?= $this->config->item('assetsBasePath') ?>assets/images/logo-small.png" alt="Logo">
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Chatbot One End-->
                                </div>
                                <div class="tab-pane fade" id="pills-chatbot2" role="tabpanel" aria-labelledby="pills-chatbot2-tab">
                                    <!--Chatbot Two Start-->
                                    <div class="chatbox-va chatbox-two" style=" display: block;" id="chatbox-two">
                                        <div class="chatbox-header" ng-style="bottheme_style">
                                            <div class="chatbox-text">
                                                <div>
                                                    <img src="<?= $assetsPath.'default/images/intelimateai.png' ?>" width="50"
                                                        class="d-block img-fluid mr7 outputimage">
                                                </div>
                                                <div>
                                                    <div class="f-14 f-md-16 w600">{{text}}</div>
                                                    <div class="f-10 w400">Online</div>
                                                </div>
                                            </div>
                                            <div class="cross-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <rect y="9" width="20" height="2" rx="1" fill="white" />
                                                </svg>
                                                <img src="https://i.ibb.co/bHrtxqF/545121.png" width="15" height="15" id="hideClick" class="ml15">
                                            </div>
                                        </div>
                                    
                                        <div class="chat-window">
                                            <div class="message msg-container msg-self msg-box messages">
                                                <div>
                                                    <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-self-text" ng-style="botbackground_style">
                                                    <span ng-style="bottext_style">Hello! How can I assist you ?</span>
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-remote msg-box messages">
                                                <div class="msg-remote-text" ng-style="userbackground_style">
                                                   <span ng-style="usertext_style">How can I setup my account ?</span>
                                                </div>
                                                <div>
                                                  <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-self msg-box messages">
                                                <!--<div ng-style="usertext_style">-->
                                                <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                                <!--</div>-->
                                                <div><img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-wrapper" ng-style="botbackground_style">
                                                    <div class="blue ball" ng-style="userbackground_style"></div>
                                                    <div class="red ball" ng-style="userbackground_style"></div>
                                                    <div class="yellow ball" ng-style="userbackground_style"></div>
                                                </div>
                                            </div>
                                            <!--<div class="text-end">-->
                                            <!--    <button class="regenerate-code" ng-style="bottheme_style"><i class="icon-refresh size-icon"></i></button>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="promt-msg-wall" >
                                            <div class="promt-msg1">
                                                <div ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Create Chat Bot </span>
                                                </div>
                                                <div class="d-none" ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Upgrade Plan</span>
                                                </div>
                                            </div>
                                            
                                            <div class="promt-msg2">
                                                <div ng-style="userbackground_style">
                                                    <span  ng-style="usertext_style">Train Chatbot</span>
                                                </div>
                                                
                                                <div class="d-none"  ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Api Integration</span></div>                                            
                                            </div>
                                        </div>
                                    
                                        <div class="chat-input-va ng-pristine ng-valid align-items-center" onsubmit="return false;">
                                            <input type="text" autocomplete="on" placeholder="Type a message" id="input">
                                            <button type="button" ng-style="bottheme_style">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                                                    style="enable-background:new 0 0 50 50; width:22px; height:22px;" xml:space="preserve">
                                                    <style type="text/css">
                                                        .st0 {
                                                            fill: #ffffff;
                                                        }
                                                    </style>
                                                    <path class="st0"
                                                        d="M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
                                                    l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    
                                        <div class="chatbox-poweredby">
                                            <div class="d-flex align-items-center justify-content-center" style="gap:5px;">Powered by 
                                            <span>
                                                <img class="img-fluid" src="<?= $this->config->item('assetsBasePath') ?>assets/images/logo-small.png" alt="Logo">
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--Chatbot Two End-->
                                    
                                </div>
                                <div class="tab-pane fade" id="pills-chatbot3" role="tabpanel" aria-labelledby="pills-chatbot3-tab">
                                    
                                    
                                    
                                    <!--Chatbot Three Start-->
                                   <div class="chatbox-va chatbox-three" style=" display: block;" id="chatbox-three">
                                        <div class="chatbox-header" ng-style="bottheme_style">
                                            <div class="chatbox-text">
                                                <div>
                                                    <img src="<?= $assetsPath.'default/images/intelimateai.png' ?>" width="50"
                                                        class="d-block img-fluid mr7 outputimage">
                                                </div>
                                                <div>
                                                    <div class="f-14 f-md-16 w600">{{text}}</div>
                                                    <div class="f-10 w400">Online</div>
                                                </div>
                                            </div>
                                            <div class="cross-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <rect y="9" width="20" height="2" rx="1" fill="white" />
                                                </svg>
                                                <img src="https://i.ibb.co/bHrtxqF/545121.png" width="15" height="15" id="hideClick" class="ml15">
                                            </div>
                                        </div>
                                    
                                        <div class="chat-window">
                                            <div class="message msg-container msg-self msg-box messages">
                                                <!--<div ng-style="usertext_style">-->
                                                <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                                <!--</div>-->
                                                <div>
                                                   <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-self-text" ng-style="botbackground_style">
                                                    <span ng-style="bottext_style">Hello! How can I assist you ?</span>
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-remote msg-box messages">
                                                <!--<div ng-style="bottext_style">-->
                                                <!--    <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">:Hello! How can I assist you today?-->
                                                <!--</div>-->
                                                <div class="msg-remote-text" ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">How can I setup my account ?</span>
                                                </div>
                                                <div>
                                                     <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-self msg-box messages">
                                                <!--<div ng-style="usertext_style">-->
                                                <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                                <!--</div>-->
                                                <div>
                                                   <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-wrapper"  ng-style="botbackground_style">
                                                    <div class="blue ball"  ng-style="userbackground_style"></div>
                                                    <div class="red ball"  ng-style="userbackground_style"></div>
                                                    <div class="yellow ball"  ng-style="userbackground_style"></div>
                                                </div>
                                            </div>
                                            <!--<div class="text-end">-->
                                            <!--    <button class="regenerate-code" ng-style="bottheme_style"><i class="icon-refresh size-icon"></i></button>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="promt-msg-wall" >
                                            <div class="promt-msg1">
                                                <div ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Create Chat Bot </span>
                                                </div>
                                                <div class="d-none" ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Upgrade Plan</span>
                                                </div>
                                            </div>
                                            
                                            <div class="promt-msg2">
                                                <div ng-style="userbackground_style">
                                                    <span  ng-style="usertext_style">Train Chatbot</span>
                                                </div>
                                                
                                                <div class="d-none"  ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Api Integration</span></div>                                            
                                            </div>
                                        </div>
                                    
                                        <div class="chat-input-va ng-pristine ng-valid align-items-center" onsubmit="return false;">
                                            <input type="text" autocomplete="on" placeholder="Type a message" id="input">
                                            <!--<a href="#">-->
                                            <!--    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">-->
                                            <!--        <g clip-path="url(#clip0_542_34724)">-->
                                            <!--            <path-->
                                            <!--                d="M17.0312 10.1562C17.0312 9.72477 16.6815 9.375 16.25 9.375C15.8185 9.375 15.4688 9.72477 15.4688 10.1562C15.4688 13.1717 13.0155 15.625 10 15.625C6.98453 15.625 4.53125 13.1717 4.53125 10.1562C4.53125 9.72477 4.18148 9.375 3.75 9.375C3.31852 9.375 2.96875 9.72477 2.96875 10.1562C2.96875 13.7692 5.70805 16.7539 9.21875 17.1439V18.4375H6.875C6.44352 18.4375 6.09375 18.7873 6.09375 19.2188C6.09375 19.6502 6.44352 20 6.875 20H13.125C13.5565 20 13.9062 19.6502 13.9062 19.2188C13.9062 18.7873 13.5565 18.4375 13.125 18.4375H10.7812V17.1439C14.292 16.7539 17.0312 13.7692 17.0312 10.1562Z"-->
                                            <!--                fill="#A1BCD0" />-->
                                            <!--            <path-->
                                            <!--                d="M10 14.0625C7.84609 14.0625 6.09375 12.3102 6.09375 10.1562V3.90625C6.09375 1.75234 7.84609 0 10 0C12.1539 0 13.9062 1.75234 13.9062 3.90625V10.1562C13.9062 12.3102 12.1539 14.0625 10 14.0625ZM10 1.5625C8.70766 1.5625 7.65625 2.61391 7.65625 3.90625V10.1562C7.65625 11.4486 8.70766 12.5 10 12.5C11.2923 12.5 12.3438 11.4486 12.3438 10.1562V3.90625C12.3438 2.61391 11.2923 1.5625 10 1.5625Z"-->
                                            <!--                fill="#A1BCD0" />-->
                                            <!--            <path-->
                                            <!--                d="M3.75 7.8125C3.31852 7.8125 2.96875 7.46273 2.96875 7.03125V5.46875C2.96875 5.03727 3.31852 4.6875 3.75 4.6875C4.18148 4.6875 4.53125 5.03727 4.53125 5.46875V7.03125C4.53125 7.46273 4.18148 7.8125 3.75 7.8125Z"-->
                                            <!--                fill="#A1BCD0" />-->
                                            <!--            <path-->
                                            <!--                d="M0.78125 9.375C0.349766 9.375 0 9.02523 0 8.59375V3.90625C0 3.47477 0.349766 3.125 0.78125 3.125C1.21273 3.125 1.5625 3.47477 1.5625 3.90625V8.59375C1.5625 9.02523 1.21273 9.375 0.78125 9.375Z"-->
                                            <!--                fill="#A1BCD0" />-->
                                            <!--            <path-->
                                            <!--                d="M16.25 7.8125C15.8185 7.8125 15.4688 7.46273 15.4688 7.03125V5.46875C15.4688 5.03727 15.8185 4.6875 16.25 4.6875C16.6815 4.6875 17.0312 5.03727 17.0312 5.46875V7.03125C17.0312 7.46273 16.6815 7.8125 16.25 7.8125Z"-->
                                            <!--                fill="#A1BCD0" />-->
                                            <!--            <path-->
                                            <!--                d="M19.2188 9.375C18.7873 9.375 18.4375 9.02523 18.4375 8.59375V3.90625C18.4375 3.47477 18.7873 3.125 19.2188 3.125C19.6502 3.125 20 3.47477 20 3.90625V8.59375C20 9.02523 19.6502 9.375 19.2188 9.375Z"-->
                                            <!--                fill="#A1BCD0" />-->
                                            <!--        </g>-->
                                            <!--        <defs>-->
                                            <!--            <clipPath id="clip0_542_34724">-->
                                            <!--                <rect width="20" height="20" fill="white" />-->
                                            <!--            </clipPath>-->
                                            <!--        </defs>-->
                                            <!--    </svg>-->
                                            <!--</a>-->
                                            <button type="button" ng-style="bottheme_style">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                                                    style="enable-background:new 0 0 50 50; width:22px; height:22px;" xml:space="preserve">
                                                    <style type="text/css">
                                                        .st0 {
                                                            fill: #ffffff;
                                                        }
                                                    </style>
                                                    <path class="st0"
                                                        d="M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
                                                                                        l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    
                                        <div class="chatbox-poweredby">
                                            <div class="d-flex align-items-center justify-content-center" style="gap:5px;">Powered by 
                                            <span>
                                                <img class="img-fluid" src="<?= $this->config->item('assetsBasePath') ?>assets/images/logo-small.png" alt="Logo">
                                            </span>        
                                            </div>
                                        </div>
                                    </div>
                                    <!--Chatbot Three End-->
                                    
                                    
                                </div>
                                <div class="tab-pane fade" id="pills-chatbot4" role="tabpanel" aria-labelledby="pills-chatbot4-tab">
                                    <!--Chatbot Four Start-->
                                   <div class="chatbox-va chatbox-four" style=" display: block;" id="chatbox-four">
                                    <div class="chatbox-header" ng-style="bottheme_style">
                                        <div class="chatbox-text">
                                            <div>
                                                <img src="<?= $assetsPath.'default/images/intelimateai.png' ?>" width="50" class="d-block img-fluid mr7 outputimage">
                                            </div>
                                            <div>
                                                <div class="f-14 f-md-16 w600">{{text}}</div>
                                                <div class="f-10 w400">Online</div>
                                            </div>
                                        </div>
                                        <div class="cross-img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <rect y="9" width="20" height="2" rx="1" fill="white"/>
                                            </svg>
                                            <img src="https://i.ibb.co/bHrtxqF/545121.png" width="15" height="15" id="hideClick" class="ml15">
                                        </div>
                                    </div>
                                
                                    <div class="chat-window">
                                        <div class="message msg-container msg-self msg-box messages">
                                            <!--<div ng-style="usertext_style">-->
                                            <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                            <!--</div>-->
                                            <div>
                                                    <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                            </div>
                                            <div class="msg-self-text" ng-style="botbackground_style">
                                                <span ng-style="bottext_style">Hello! How can I assist you ?</span>
                                            </div>
                                        </div>
                                        <div class="message msg-container msg-remote msg-box messages">
                                            <!--<div ng-style="bottext_style">-->
                                            <!--    <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">:Hello! How can I assist you today?-->
                                            <!--</div>-->
                                            <div class="msg-remote-text" ng-style="userbackground_style">
                                                <span ng-style="usertext_style">How can I setup my account ?</span>
                                            </div>
                                            <div>
                                               <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">
                                            </div>
                                        </div>
                                        <div class="message msg-container msg-self msg-box messages">
                                            <!--<div ng-style="usertext_style">-->
                                            <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                            <!--</div>-->
                                            <div>
                                                   <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                            </div>
                                            <div class="msg-wrapper" ng-style="botbackground_style">
                                                <div class="blue ball" ng-style="userbackground_style"></div>
                                                <div class="red ball" ng-style="userbackground_style"></div>
                                                <div class="yellow ball" ng-style="userbackground_style"></div>
                                            </div>
                                        </div>
                                        <!--<div class="text-end">-->
                                        <!--    <button class="regenerate-code" ng-style="botbackground_style"><i class="icon-refresh size-icon"></i></button>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="promt-msg-wall" >
                                            <div class="promt-msg1">
                                                <div ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Create Chat Bot?</span>
                                                </div>
                                                <div ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">Upgrade Plan?</span>
                                                </div>
                                            </div>
                                            
                                            <div class="promt-msg2">
                                                <div ng-style="userbackground_style">
                                                    <span  ng-style="usertext_style">Trained Chatbot?</span>
                                                </div>
                                                
                                                <div ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">API Integration?</span></div>                                            
                                            </div>
                                        </div>
                                
                                    <div class="chat-input-va ng-pristine ng-valid align-items-center" onsubmit="return false;">
                                        <input type="text" autocomplete="on" placeholder="Type a message" id="input">
                                        <!--<a href="#">-->
                                        <!--    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">-->
                                        <!--        <g clip-path="url(#clip0_542_34724)">-->
                                        <!--            <path d="M17.0312 10.1562C17.0312 9.72477 16.6815 9.375 16.25 9.375C15.8185 9.375 15.4688 9.72477 15.4688 10.1562C15.4688 13.1717 13.0155 15.625 10 15.625C6.98453 15.625 4.53125 13.1717 4.53125 10.1562C4.53125 9.72477 4.18148 9.375 3.75 9.375C3.31852 9.375 2.96875 9.72477 2.96875 10.1562C2.96875 13.7692 5.70805 16.7539 9.21875 17.1439V18.4375H6.875C6.44352 18.4375 6.09375 18.7873 6.09375 19.2188C6.09375 19.6502 6.44352 20 6.875 20H13.125C13.5565 20 13.9062 19.6502 13.9062 19.2188C13.9062 18.7873 13.5565 18.4375 13.125 18.4375H10.7812V17.1439C14.292 16.7539 17.0312 13.7692 17.0312 10.1562Z" fill="#A1BCD0"/>-->
                                        <!--            <path d="M10 14.0625C7.84609 14.0625 6.09375 12.3102 6.09375 10.1562V3.90625C6.09375 1.75234 7.84609 0 10 0C12.1539 0 13.9062 1.75234 13.9062 3.90625V10.1562C13.9062 12.3102 12.1539 14.0625 10 14.0625ZM10 1.5625C8.70766 1.5625 7.65625 2.61391 7.65625 3.90625V10.1562C7.65625 11.4486 8.70766 12.5 10 12.5C11.2923 12.5 12.3438 11.4486 12.3438 10.1562V3.90625C12.3438 2.61391 11.2923 1.5625 10 1.5625Z" fill="#A1BCD0"/>-->
                                        <!--            <path d="M3.75 7.8125C3.31852 7.8125 2.96875 7.46273 2.96875 7.03125V5.46875C2.96875 5.03727 3.31852 4.6875 3.75 4.6875C4.18148 4.6875 4.53125 5.03727 4.53125 5.46875V7.03125C4.53125 7.46273 4.18148 7.8125 3.75 7.8125Z" fill="#A1BCD0"/>-->
                                        <!--            <path d="M0.78125 9.375C0.349766 9.375 0 9.02523 0 8.59375V3.90625C0 3.47477 0.349766 3.125 0.78125 3.125C1.21273 3.125 1.5625 3.47477 1.5625 3.90625V8.59375C1.5625 9.02523 1.21273 9.375 0.78125 9.375Z" fill="#A1BCD0"/>-->
                                        <!--            <path d="M16.25 7.8125C15.8185 7.8125 15.4688 7.46273 15.4688 7.03125V5.46875C15.4688 5.03727 15.8185 4.6875 16.25 4.6875C16.6815 4.6875 17.0312 5.03727 17.0312 5.46875V7.03125C17.0312 7.46273 16.6815 7.8125 16.25 7.8125Z" fill="#A1BCD0"/>-->
                                        <!--            <path d="M19.2188 9.375C18.7873 9.375 18.4375 9.02523 18.4375 8.59375V3.90625C18.4375 3.47477 18.7873 3.125 19.2188 3.125C19.6502 3.125 20 3.47477 20 3.90625V8.59375C20 9.02523 19.6502 9.375 19.2188 9.375Z" fill="#A1BCD0"/>-->
                                        <!--        </g>-->
                                        <!--        <defs>-->
                                        <!--            <clipPath id="clip0_542_34724">-->
                                        <!--                <rect width="20" height="20" fill="white"/>-->
                                        <!--            </clipPath>-->
                                        <!--        </defs>-->
                                        <!--    </svg>-->
                                        <!--</a>-->
                                        <!--<button type="button" ng-style="bottheme_style">-->
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50; width:22px; height:22px;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #ffffff;
                                                    }
                                                </style>
                                                <path class="st0" d="M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
                                                l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="chatbox-poweredby">
                                        <div class="d-flex align-items-center justify-content-center" style="gap:5px;">Powered by 
                                        <span>
                                            <img class="img-fluid" src="<?= $this->config->item('assetsBasePath') ?>assets/images/logo-small.png" alt="Logo">
                                        </span> 
                                        </div>
                                    </div>
                                </div>
                                    <!--Chatbot Four End-->
                                    
                                    
                                    
                                </div>     
                                <div class="tab-pane fade" id="pills-chatbot5" role="tabpanel" aria-labelledby="pills-chatbot5-tab">
                                    <!--chatbot Five Start-->
                                    <div class="chatbox-border chatbox-va" style="border: 10px solid {{bottheme_color}};">
                                        <div class="chatbox-va chatbox-va-five chatbox-five" style=" display: block; box-shadow:none; border-radius:0px !important" id="chatbox-five">
                                        <div class="chatbox-header" ng-style="bottheme_style">
                                            <div class="chatbox-text">
                                                <div>
                                                    <img src="<?= $assetsPath.'default/images/intelimateai.png' ?>" width="50" class="d-block img-fluid mr7 outputimage">
                                                </div>
                                                <div>
                                                    <div class="f-14 f-md-16 w600">{{text}}</div>
                                                    <div class="f-10 w400">Online</div>
                                                </div>
                                            </div>
                                            <div class="cross-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <rect y="9" width="20" height="2" rx="1" fill="white"/>
                                                </svg>
                                                <img src="https://i.ibb.co/bHrtxqF/545121.png" width="15" height="15" id="hideClick" class="ml15">
                                            </div>
                                        </div>
                                    
                                        <div class="chat-window">
                                            <div class="message msg-container msg-self msg-box messages">
                                                <!--<div ng-style="usertext_style">-->
                                                <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                                <!--</div>-->
                                                <div>
                                                      <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-self-text" ng-style="botbackground_style">
                                                    <span ng-style="bottext_style">:hi, Are You Available</span>
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-remote msg-box messages">
                                                <!--<div ng-style="bottext_style">-->
                                                <!--    <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">:Hello! How can I assist you today?-->
                                                <!--</div>-->
                                                <div class="msg-remote-text" ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">How can I setup my account ?</span>
                                                </div>
                                                <div>
                                                   <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50"> 
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-self msg-box messages">
                                                <!--<div ng-style="usertext_style">-->
                                                <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                                <!--</div>-->
                                                <div>
                                                       <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-wrapper" ng-style="botbackground_style">
                                                    <div class="blue ball" ng-style="userbackground_style"></div>
                                                    <div class="red ball" ng-style="userbackground_style"></div>
                                                    <div class="yellow ball" ng-style="userbackground_style"></div>
                                                </div>
                                            </div>
                                            <!--<div class="text-end">-->
                                            <!--    <button class="regenerate-code" ng-style="bottheme_style"><i class="icon-refresh size-icon"></i></button>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="promt-msg-wall">
                                            <div class="promt-msg1">
                                                <div  ng-style="userbackground_style"><span ng-style="usertext_style">Create Chat BOt?</span></div>
                                                <div  ng-style="userbackground_style"><span ng-style="usertext_style">Upgrade Plan?</span></div>
                                            </div>
                                            <div class="promt-msg2">
                                                <div ng-style="userbackground_style"><span ng-style="usertext_style">Trained Chatbot?</span></div>
                                                <div ng-style="userbackground_style"><span ng-style="usertext_style">API Integration?</span></div>                                            
                                            </div>
                                        </div>
                                    
                                        <div class="chat-input-va ng-pristine ng-valid align-items-center" onsubmit="return false;">
                                            <input type="text" autocomplete="on" placeholder="Type a message" id="input">
                                            <!--<a href="#">-->
                                            <!--    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">-->
                                            <!--        <g clip-path="url(#clip0_542_34724)">-->
                                            <!--            <path d="M17.0312 10.1562C17.0312 9.72477 16.6815 9.375 16.25 9.375C15.8185 9.375 15.4688 9.72477 15.4688 10.1562C15.4688 13.1717 13.0155 15.625 10 15.625C6.98453 15.625 4.53125 13.1717 4.53125 10.1562C4.53125 9.72477 4.18148 9.375 3.75 9.375C3.31852 9.375 2.96875 9.72477 2.96875 10.1562C2.96875 13.7692 5.70805 16.7539 9.21875 17.1439V18.4375H6.875C6.44352 18.4375 6.09375 18.7873 6.09375 19.2188C6.09375 19.6502 6.44352 20 6.875 20H13.125C13.5565 20 13.9062 19.6502 13.9062 19.2188C13.9062 18.7873 13.5565 18.4375 13.125 18.4375H10.7812V17.1439C14.292 16.7539 17.0312 13.7692 17.0312 10.1562Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M10 14.0625C7.84609 14.0625 6.09375 12.3102 6.09375 10.1562V3.90625C6.09375 1.75234 7.84609 0 10 0C12.1539 0 13.9062 1.75234 13.9062 3.90625V10.1562C13.9062 12.3102 12.1539 14.0625 10 14.0625ZM10 1.5625C8.70766 1.5625 7.65625 2.61391 7.65625 3.90625V10.1562C7.65625 11.4486 8.70766 12.5 10 12.5C11.2923 12.5 12.3438 11.4486 12.3438 10.1562V3.90625C12.3438 2.61391 11.2923 1.5625 10 1.5625Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M3.75 7.8125C3.31852 7.8125 2.96875 7.46273 2.96875 7.03125V5.46875C2.96875 5.03727 3.31852 4.6875 3.75 4.6875C4.18148 4.6875 4.53125 5.03727 4.53125 5.46875V7.03125C4.53125 7.46273 4.18148 7.8125 3.75 7.8125Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M0.78125 9.375C0.349766 9.375 0 9.02523 0 8.59375V3.90625C0 3.47477 0.349766 3.125 0.78125 3.125C1.21273 3.125 1.5625 3.47477 1.5625 3.90625V8.59375C1.5625 9.02523 1.21273 9.375 0.78125 9.375Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M16.25 7.8125C15.8185 7.8125 15.4688 7.46273 15.4688 7.03125V5.46875C15.4688 5.03727 15.8185 4.6875 16.25 4.6875C16.6815 4.6875 17.0312 5.03727 17.0312 5.46875V7.03125C17.0312 7.46273 16.6815 7.8125 16.25 7.8125Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M19.2188 9.375C18.7873 9.375 18.4375 9.02523 18.4375 8.59375V3.90625C18.4375 3.47477 18.7873 3.125 19.2188 3.125C19.6502 3.125 20 3.47477 20 3.90625V8.59375C20 9.02523 19.6502 9.375 19.2188 9.375Z" fill="#A1BCD0"/>-->
                                            <!--        </g>-->
                                            <!--        <defs>-->
                                            <!--            <clipPath id="clip0_542_34724">-->
                                            <!--                <rect width="20" height="20" fill="white"/>-->
                                            <!--            </clipPath>-->
                                            <!--        </defs>-->
                                            <!--    </svg>-->
                                            <!--</a>-->
                                            <button type="button" ng-style="bottheme_style">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50; width:22px; height:22px;" xml:space="preserve">
                                                    <style type="text/css">
                                                        .st0 {
                                                            fill: #ffffff;
                                                        }
                                                    </style>
                                                    <path class="st0" d="M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
                                                    l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    
                                        <div class="chatbox-poweredby">
                                            <div class="d-flex align-items-center justify-content-center" style="gap:5px;">Powered by 
                                            <span>
                                                <img class="img-fluid" src="<?= $this->config->item('assetsBasePath') ?>assets/images/logo-small.png" alt="Logo">
                                            </span>
                                            </div>
                                        </div>
                                    </div> 
                                    </div>
                                    <!--Chatbot Five End-->
                                    
                                    
                                    
                                </div>
                                <div class="tab-pane fade" id="pills-chatbot6" role="tabpanel" aria-labelledby="pills-chatbot6-tab">
                                    <!--chatbot Six Start-->
                                    <div class="chatbox-va chatbox-six" style=" display: block;" id="chatbox-six">
                                        <div class="chatbox-header" ng-style="bottheme_style">
                                            <div class="chatbox-text">
                                                <div>
                                                    <img src="<?= $assetsPath.'default/images/intelimateai.png' ?>" width="50" class="d-block img-fluid mr7 outputimage">
                                                </div>
                                                <div>
                                                    <div class="f-14 f-md-16 w600">{{text}}</div>
                                                    <div class="f-10 w400">Online</div>
                                                </div>
                                            </div>
                                            <div class="cross-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <rect y="9" width="20" height="2" rx="1" fill="white"/>
                                                </svg>
                                                <img src="https://i.ibb.co/bHrtxqF/545121.png" width="15" height="15" id="hideClick" class="ml15">
                                            </div>
                                        </div>
                                    
                                        <div class="chat-window">
                                            <div class="message msg-container msg-self msg-box messages">
                                                <!--<div ng-style="usertext_style">-->
                                                <!--    <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">:hi, Are You Available-->
                                                <!--</div>-->
                                                <div>
                                                       <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-self-text" ng-style="botbackground_style">
                                                    <span ng-style="bottext_style">Hello! How can I assist you ?</span>
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-remote msg-box messages">
                                                <div class="msg-remote-text" ng-style="userbackground_style">
                                                    <span ng-style="usertext_style">How can I setup my account ?</span>
                                                </div>
                                                <div>
                                                     <img src="https://webgpt.getvideowhizz.com/chat/av.jpg" width="50">
                                                </div>
                                            </div>
                                            <div class="message msg-container msg-self msg-box messages">
                                                <div>
                                                        <img src="<?= $assetsPath.'default/images/intelimateai.png'  ?>" width="50" class="outputimage">
                                                </div>
                                                <div class="msg-wrapper" ng-style="botbackground_style">
                                                    <div class="blue ball" ng-style="userbackground_style"></div>
                                                    <div class="red ball" ng-style="userbackground_style"></div>
                                                    <div class="yellow ball" ng-style="userbackground_style"></div>
                                                </div>
                                            </div>
                                            <!--<div class="text-end">-->
                                            <!--    <button class="regenerate-code" ng-style="bottheme_style"><i class="icon-refresh size-icon"></i></button>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="promt-msg-wall">
                                            <div class="promt-msg1">
                                                <div  ng-style="userbackground_style"><span ng-style="usertext_style"> Create Chat Bot ?</span></div>
                                                <div ng-style="userbackground_style"><span ng-style="usertext_style">Trained Chatbot?</span></div>
                                            </div>
                                            <div class="promt-msg2">
                                                <div ng-style="userbackground_style"><span ng-style="usertext_style">Upgrade Plan?</span></div>
                                                <div ng-style="userbackground_style"><span ng-style="usertext_style">API Integration?</span></div>                                            
                                            </div>
                                        </div>
                                        <div class="chat-input-va ng-pristine ng-valid align-items-center" onsubmit="return false;">
                                            <input type="text" autocomplete="on" placeholder="Type a message" id="input">
                                            <!--<a href="#">-->
                                            <!--    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">-->
                                            <!--        <g clip-path="url(#clip0_542_34724)">-->
                                            <!--            <path d="M17.0312 10.1562C17.0312 9.72477 16.6815 9.375 16.25 9.375C15.8185 9.375 15.4688 9.72477 15.4688 10.1562C15.4688 13.1717 13.0155 15.625 10 15.625C6.98453 15.625 4.53125 13.1717 4.53125 10.1562C4.53125 9.72477 4.18148 9.375 3.75 9.375C3.31852 9.375 2.96875 9.72477 2.96875 10.1562C2.96875 13.7692 5.70805 16.7539 9.21875 17.1439V18.4375H6.875C6.44352 18.4375 6.09375 18.7873 6.09375 19.2188C6.09375 19.6502 6.44352 20 6.875 20H13.125C13.5565 20 13.9062 19.6502 13.9062 19.2188C13.9062 18.7873 13.5565 18.4375 13.125 18.4375H10.7812V17.1439C14.292 16.7539 17.0312 13.7692 17.0312 10.1562Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M10 14.0625C7.84609 14.0625 6.09375 12.3102 6.09375 10.1562V3.90625C6.09375 1.75234 7.84609 0 10 0C12.1539 0 13.9062 1.75234 13.9062 3.90625V10.1562C13.9062 12.3102 12.1539 14.0625 10 14.0625ZM10 1.5625C8.70766 1.5625 7.65625 2.61391 7.65625 3.90625V10.1562C7.65625 11.4486 8.70766 12.5 10 12.5C11.2923 12.5 12.3438 11.4486 12.3438 10.1562V3.90625C12.3438 2.61391 11.2923 1.5625 10 1.5625Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M3.75 7.8125C3.31852 7.8125 2.96875 7.46273 2.96875 7.03125V5.46875C2.96875 5.03727 3.31852 4.6875 3.75 4.6875C4.18148 4.6875 4.53125 5.03727 4.53125 5.46875V7.03125C4.53125 7.46273 4.18148 7.8125 3.75 7.8125Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M0.78125 9.375C0.349766 9.375 0 9.02523 0 8.59375V3.90625C0 3.47477 0.349766 3.125 0.78125 3.125C1.21273 3.125 1.5625 3.47477 1.5625 3.90625V8.59375C1.5625 9.02523 1.21273 9.375 0.78125 9.375Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M16.25 7.8125C15.8185 7.8125 15.4688 7.46273 15.4688 7.03125V5.46875C15.4688 5.03727 15.8185 4.6875 16.25 4.6875C16.6815 4.6875 17.0312 5.03727 17.0312 5.46875V7.03125C17.0312 7.46273 16.6815 7.8125 16.25 7.8125Z" fill="#A1BCD0"/>-->
                                            <!--            <path d="M19.2188 9.375C18.7873 9.375 18.4375 9.02523 18.4375 8.59375V3.90625C18.4375 3.47477 18.7873 3.125 19.2188 3.125C19.6502 3.125 20 3.47477 20 3.90625V8.59375C20 9.02523 19.6502 9.375 19.2188 9.375Z" fill="#A1BCD0"/>-->
                                            <!--        </g>-->
                                            <!--        <defs>-->
                                            <!--            <clipPath id="clip0_542_34724">-->
                                            <!--                <rect width="20" height="20" fill="white"/>-->
                                            <!--            </clipPath>-->
                                            <!--        </defs>-->
                                            <!--    </svg>-->
                                            <!--</a>-->
                                            <button type="button" ng-style="bottheme_style">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50; width:22px; height:22px;" xml:space="preserve">
                                                    <style type="text/css">
                                                        .st0 {
                                                            fill: #ffffff;
                                                        }
                                                    </style>
                                                    <path class="st0" d="M1.86,15.26L46.44,0.2c2.13-0.74,4.09,1.31,3.44,3.44l-15.13,44.5c-0.74,2.13-3.6,2.45-4.83,0.57l-9.57-14.56
                                                    l16.69-20.53c0.49-0.57-0.08-1.15-0.65-0.65L15.84,29.65L1.2,20C-0.68,18.77-0.27,15.91,1.86,15.26L1.86,15.26z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    
                                        <div class="chatbox-poweredby">
                                            <div class="d-flex align-items-center justify-content-center" style="gap:5px;">Powered by 
                                            <span>
                                                <img class="img-fluid" src="<?= $this->config->item('assetsBasePath') ?>assets/images/logo-small.png" alt="Logo">
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--chatbot Six End-->
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
                     <h1 class="modal-title fs-5" id="exampleModalLabel">{{text}}</h1>
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <p id="modalMessage" style="word-break: break-all;"></p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="theme-btn-white" data-bs-dismiss="modal" onclick="window.location.reload()" >Close</button>
                     <button type="button" class="theme-btn-blue" ng-click="copyContent()" >Copy Text</button>
                 </div>
             </div>
         </div>
     </div>
     


    
     <script>

        var botData = text = prompt = color = botbackground_color = userbackground_color = bottext_color = usertext_color = assistant_image = widget_image = language_id = chatbot_background = list_id = form_step = close_message = null;
        var chatbot_class = 'chatbox-one';
        var chatbot_class_full = 'chatbox-one,none';
        var checkTrain = false;
        <?php if($chatbotObj) { ?>
            checkTrain = true;
            text = '<?php echo $chatbotObj->text; ?>';
            prompt = `<?php echo $chatbotObj->prompt; ?>`;
            color = '<?php echo $chatbotObj->color; ?>';
            botbackground_color = '<?php echo $chatbotObj->botbackground_color; ?>';
            userbackground_color = '<?php echo $chatbotObj->userbackground_color; ?>';
            bottext_color = '<?php echo $chatbotObj->bottext_color; ?>';
            usertext_color = '<?php echo $chatbotObj->usertext_color; ?>';
            assistant_image = '<?php echo $chatbotObj->assistant_image; ?>';
            widget_image = '<?php echo $chatbotObj->widget_image; ?>';
            language_id = '<?php echo $chatbotObj->language_id; ?>';
            chatbot_background = '<?php echo $chatbotObj->chatbot_background; ?>';
            chatbot_class = '<?php echo $chatbotObj->chatbot_class; ?>';
            chatbot_class_full = '<?php echo $chatbotObj->chatbot_class; ?>';
            list_id = '<?php echo $chatbotObj->list_id; ?>';
            // form_step = '<?php echo $chatbotObj->form_step; ?>';
            close_message = '<?php echo $chatbotObj->close_message; ?>';
        <?php } ?>
         var app = angular.module("AppModule", []);

         app.controller("virtualAssitantCreate", function($scope, $http, $timeout) {
            $('.progress-item').parents('li').addClass('disabled');
            var question = []; 
            $scope.text = text ? text : "getaisupreme";
            $scope.white_lable = '<?php echo $white_lable ?>';
            $scope.pinecone_environment = "gcp-starter";
            $scope.close_message = close_message ? close_message : "Thank you for chatting with us today! If you have any more questions, feel free to reach out. Have a wonderful day!";
            $scope.prompt = prompt ? prompt : "Hello! How can I assist you ?";
            if(chatbot_class)
            {
                chatbot_class = chatbot_class.replace(",none", "");
                chatbot_class = chatbot_class.replace(",block", "");
                jQuery('[data-theme="'+chatbot_class+'"]').trigger('click');
            }
            $scope.activeChatbox =  chatbot_class;
            $scope.chatbot_class = chatbot_class_full;
            $scope.bottheme_color = color ? color : '#0D64BE';
            $scope.pdfs = '';
            $scope.botbackground_color = botbackground_color ? botbackground_color : '#CEE0F2';
            $scope.userbackground_color = userbackground_color ? userbackground_color : '#0D64BE';
            $scope.bottext_color = bottext_color ? bottext_color : '#000000';
            $scope.usertext_color = usertext_color ? usertext_color : '#FFF';
            $scope.isHide = true;
            $scope.isButtonDisabled = true;
            $scope.isButtonDisabledClass = 'base-btn theme-btn-blue mt10 disabled-btn';
            $scope.bottheme_style = { 'background-color': color ? color : '#0D64BE' };
            $scope.bottext_style = { 'color': $scope.bottext_color };
            $scope.botbackground_style = { 'background-color': $scope.botbackground_color };
            $scope.usertext_style = { 'color': $scope.usertext_color };
            $scope.userbackground_style = { 'background-color': $scope.userbackground_color };

            if(assistant_image)
            {
                jQuery('.outputimage').attr('src', assistant_image);
            }

            if(widget_image)
            {
                jQuery('.widget_show').attr('src', widget_image);
            }

            $scope.updateButtonColor = function(type) {
                 if(type == 'bottheme_color'){
                     
                    $scope.bottheme_style = { 'background-color': $scope.bottheme_color };
                    
                 }else if(type == 'bottext_color'){
                     
                     $scope.bottext_style = { 'color': $scope.bottext_color };
                     
                 }else if(type == 'botbackground_color'){
                     
                     $scope.botbackground_style = { 'background-color': $scope.botbackground_color };
                     
                 }else if(type == 'usertext_color'){
                     
                     $scope.usertext_style = { 'color': $scope.usertext_color };
                     
                 }else if(type == 'userbackground_color'){
                     
                     $scope.userbackground_style = { 'background-color': $scope.userbackground_color };
                     
                 }
              };
            $scope.fileList = '';
            $scope.widget_image = '';
            $scope.chatbotFile = '';
            $scope.purpose = 'chat';
            $scope.languaage = language_id ? language_id : 'en';
            var urlValues = []; 

             $scope.copyContent = async (text) => {
                 try {
                    let text = $('#modalMessage').text();
                     await navigator.clipboard.writeText(text);
                     toastr.info('Content copied to clipboard');  
                      $timeout(function() {
                          location.reload();
                    }, 2000);
                 } catch (err) {
                     console.error('Failed to copy: ', err);
                 }
             }
             
             $scope.tabChange = function(id){
                 $('#'+id).trigger('click');
             }
             
             $scope.setThemeColor = function(bottheme_color,botbackground_color,userbackground_color,bottext_color,usertext_color){
                $scope.bottheme_style = '';
                $scope.botbackground_style = '';
                $scope.userbackground_style = '';
                $scope.bottext_style = '';
                $scope.usertext_style = '';
                $scope.bottheme_color = bottheme_color;
                $scope.botbackground_color = botbackground_color;
                $scope.userbackground_color = userbackground_color;
                $scope.bottext_color = bottext_color;
                $scope.usertext_color = usertext_color;
                // $scope.prompt_color = prompt_color;
             }
             
            $scope.setThemeClass = function(chatbotClass,activeChatbox) {
                $scope.chatbot_class = chatbotClass;
                $scope.activeChatbox = activeChatbox;
                $scope.setChatBg('');
            };
                         
             
             const fileSelector = document.getElementById('formFiles');
             fileSelector.addEventListener('change', (event) => {
                 $scope.fileList = event.target.files;
             });

            document.getElementById('formFile').addEventListener('change', (event) => {
                 $scope.chatbotFile = event.target.files;
                 $('#collClose').trigger('click');
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
             
             
             document.getElementById('file-input').addEventListener('change', (event) => {
                 $scope.pdfs = event.target.files;
                 if($scope.pdfs.length > 5){
                    toastr.warning('PDF Upload limit Exceeded');
                 }
             });
             
             <!-- $scope.checkQuestion = function(number){-->
             <!--   var val = $(`#question${number}`).val();-->
             <!--   if(val != ''){-->
             <!--       $(`.question${number}`).prop('disabled', false);-->
             <!--   }else{-->
             <!--       $(`.question${number}`).prop('disabled', true);-->
             <!--   }-->
             <!--}-->
             

            $scope.getUrl = function () {
                var urlValues = [];
                $("input[name='url[]']").each(function () {
                    var val = $(this).val(); 
                    if (val !== "") {
                        urlValues.push(val);
                    }
                });
                return urlValues;
            };

             
           
            
            let quesObj = {};
            $scope.question = function() {
                 $("input[name='question[]']").each(function() {
                   var val = $(this).val();
                   if(val != ''){
                        question.push(val);
                   }
                });
                
                
                // quesObj['qi'] = 'abc'
                $.each(question, function(index, item) {
                    quesObj[item] =  $(`input[name='question_response${index+1}`).val();; 
                });
                question = [];
                return quesObj;
                
             };
             
            $scope.storeTheme = function() {
                jsLoader(true);

                var botbackground_color = $scope.botbackground_color == undefined ? '' : $scope.botbackground_color;
                var userbackground_color = $scope.userbackground_color == undefined ? '' : $scope.userbackground_color;
                var bottext_color = $scope.bottext_color == undefined ? '' : $scope.bottext_color;
                var usertext_color = $scope.usertext_color == undefined ? '' : $scope.usertext_color;
                var bottheme_color = $scope.bottheme_color == undefined ? '' : $scope.bottheme_color;
                var bottheme_color = $scope.bottheme_color == undefined ? '' : $scope.bottheme_color;
                var close_message = $scope.close_message == undefined ? '' : $scope.close_message;
                var purpose = $scope.purpose == undefined ? '' : $scope.purpose;
                var chatbot_class = $scope.chatbot_class == undefined ? '' : $scope.chatbot_class;

                var fd = new FormData();
                fd.append('botbackground_color', botbackground_color);
                fd.append('userbackground_color', userbackground_color);
                fd.append('bottext_color', bottext_color);
                fd.append('usertext_color', usertext_color);
                fd.append('color', bottheme_color);
                fd.append('chatbot_class', chatbot_class);
                fd.append('close_message', close_message);
                fd.append('purpose', purpose);

                $http({
                    method: 'POST',
                    url: 'store_theme',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function(response) {
                    quesObj = {};
                    jsLoader(false);
                    if (response.data.status == true) {
                        $scope.tabChange('profiletab');
                        toastr.success(response.data.msg);
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }
             
            $scope.storeProfile = function() {
                jsLoader(true);
                var image = $scope.fileList[0] == undefined ? '' : $scope.fileList[0];
                var widget_image = $scope.widget_image[0] == undefined ? '' : $scope.widget_image[0];
                var text = $scope.text == undefined ? '' : $scope.text;
                var languaage = $scope.languaage == undefined ? '' : $scope.languaage;
                var bottheme_color = $scope.bottheme_color == undefined ? '' : $scope.bottheme_color;
                var botimage = $scope.setType == 'custom' ? $scope.chatbotFile[0] : $scope.chatbotFile;
                var bottext_color = $scope.bottext_color == undefined ? '' : $scope.bottext_color;
                var botbackground_color = $scope.botbackground_color == undefined ? '' : $scope.botbackground_color;
                var usertext_color = $scope.usertext_color == undefined ? '' : $scope.usertext_color;
                var userbackground_color = $scope.userbackground_color == undefined ? '' : $scope.userbackground_color;

                var fd = new FormData();
                fd.append('image', image);
                fd.append('widget_image', widget_image);
                fd.append('text', text);
                fd.append('languaage', languaage);
                fd.append('color', bottheme_color);
                fd.append('botimage', botimage);
                fd.append('bottext_color', bottext_color);
                fd.append('botbackground_color', botbackground_color);
                fd.append('usertext_color', usertext_color);
                fd.append('userbackground_color', userbackground_color);

                $http({
                    method: 'POST',
                    url: 'store_profile',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function(response) {
                    quesObj = {};
                    jsLoader(false);
                    if (response.data.status == true) {
                        $scope.tabChange('pills-contact-tab');
                        toastr.success(response.data.msg);
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }
             
            $scope.storeQA = function() {
                jsLoader(true);
                var prompt = $scope.prompt == undefined ? '' : $scope.prompt;
                var Questionobj =  JSON.stringify($scope.question());

                var fd = new FormData();
                fd.append('prompt', prompt);
                fd.append('questionobj', Questionobj);

                $http({
                    method: 'POST',
                    url: 'store_qa',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function(response) {
                    quesObj = {};
                    jsLoader(false);
                    if (response.data.status == true) {
                        $scope.tabChange('pills-training-tab');
                        toastr.success(response.data.msg);
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }
             
            $scope.storeTraining = function() {
                jsLoader(true);
                var urlallValues = $scope.getUrl();

                var fd = new FormData();
                fd.append('urls', urlallValues);
                for (var i = 0; i < 5; i++) {
                    fd.append("pdf_docs[]", $scope.pdfs[i]);
                }

                $http({
                    method: 'POST',
                    url: 'store_training',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function(response) {
                    quesObj = {};
                    jsLoader(false);
                    if (response.data.status == true) {
                        $scope.tabChange('pills-cta-tab');
                        toastr.success(response.data.msg);
                    } else if (response.data.error) {
                        toastr.error(response.data.error.msg);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }
             
            $scope.storeCta = function() {
                jsLoader(true);
                var autoresponder = $('#autoresponder').find(":selected").val();
                var select_list = $('#select_list').find(":selected").val();
                var close_message = $scope.close_message == undefined ? '' : $scope.close_message;
                if ($('#autoresponder_Checkbox').is(':checked')) {
                    var checkBox = 1;
                } else {
                    var checkBox = 0;
                }

                var fd = new FormData();
                fd.append('close_message', close_message);
                fd.append('autoresponder', autoresponder);
                fd.append('select_list', select_list);
                fd.append('checkbox', checkBox);

                $http({
                    method: 'POST',
                    url: 'store_cta',
                    aync: false,
                    data: fd,
                    dataType: "json",
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).then(function(response) {
                    quesObj = {};
                    jsLoader(false);
                    console.log('test',response.data.error);
                    if (response.data.status == true) {
                        $('#modalMessage').text(response.data.prompt);
                        $('#vaMessageModal').modal('show');
                        toastr.success(response.data.msg);
                    } else if(response.data.status == false) {
                        toastr.error(response.data.msg);
                    }else if (response.data.error) {
                        toastr.error(response.data.error.message);
                    } else {
                        toastr.error('Something went wrong');
                    }
                });
            }
            
            
            /// get Training Status 
            $scope.gettrainStatus = function(){
                 	$http({
        				method 	: 'POST',
        				url: siteUrl +"virtual-assistant-v1/gettrainstatus",
        				headers : {'Content-Type': 'application/x-www-form-urlencoded','X-Requested-With': 'XMLHttpRequest'}
        		}).then(function(response) {
        		    if(response.data.cron_status == 'complete'){
        		         $scope.trainStatus = 'Active (complete)';
        		    }else if(response.data.cron_status == 'failed'){
        		         $scope.trainStatus = 'failed';
        		    }else if(response.data.cron_status == '' && checkTrain){
        		        $scope.trainStatus = 'Pending';
        		    }else{
        		       $scope.trainStatus =  'Not Created Yet'
        		    }
        		});
             }
             $scope.gettrainStatus();
             setInterval(function() {
                   $scope.gettrainStatus()
            }, 10000);
          


             $scope.vaCreate = function() {
                 jsLoader(true);
                 var Questionobj =  JSON.stringify($scope.question());
                 var urlallValues = $scope.getUrl();
                 var image = $scope.fileList[0] == undefined ? '' : $scope.fileList[0];
                 var widget_image = $scope.widget_image[0] == undefined ? '' : $scope.widget_image[0];
                 var botimage = $scope.setType == 'custom' ? $scope.chatbotFile[0] : $scope.chatbotFile;
                 var type = $scope.setType;
                 var text = $scope.text == undefined ? '' : $scope.text;
                 var pinecone_environment = $scope.pinecone_environment == undefined ? '' : $scope.pinecone_environment;
                 var pinecone_index = $scope.pinecone_index == undefined ? '' : $scope.pinecone_index;
                 var pinecone_api_key = $scope.pinecone_api_key == undefined ? '' : $scope.pinecone_api_key;
                 var prompt = $scope.prompt == undefined ? '' : $scope.prompt;
                 var close_message = $scope.close_message == undefined ? '' : $scope.close_message;
                 
                 
                 
                //  var niche = $scope.niche == undefined ? '' : $scope.niche;
                 var purpose = $scope.purpose;
                 var chatbot_class = $scope.chatbot_class;

                 var bottheme_color = $scope.bottheme_color == undefined ? '' : $scope.bottheme_color;
                 var bottext_color = $scope.bottext_color == undefined ? '' : $scope.bottext_color;
                 var botbackground_color = $scope.botbackground_color == undefined ? '' : $scope.botbackground_color;
                 var usertext_color = $scope.usertext_color == undefined ? '' : $scope.usertext_color;
                 var userbackground_color = $scope.userbackground_color == undefined ? '' : $scope.userbackground_color;
                 
                 var languaage = $scope.languaage == undefined ? '' : $scope.languaage;
                //  var website_content = $scope.website_content == undefined ? '' : $scope.website_content;
                //  var website_url = $scope.website_url == undefined ? '' : $scope.website_url;
                  var autoresponder = $('#autoresponder').find(":selected").val();
                  var select_list = $('#select_list').find(":selected").val();
                  if ($('#autoresponder_Checkbox').is(':checked')) {
                    var checkBox = 1;
                  }else{
                    var checkBox = 0;
                  }
                  <!--let checkBox = () ? 1 : 0;-->
                 var fd = new FormData();
                 fd.append('botimage', botimage);
                 fd.append('image', image);
                 fd.append('questionobj', Questionobj);
                 fd.append('chatbot_class', chatbot_class);
                 fd.append('widget_image', widget_image);
                 fd.append('type', type);
                 fd.append('checkbox', checkBox);
                 fd.append('close_message', close_message);
                 fd.append('text', text);
                 fd.append('pinecone_environment', pinecone_environment);
                 fd.append('pinecone_index', pinecone_index);
                 fd.append('pinecone_api_key', pinecone_api_key);
                 fd.append('prompt', prompt);
                //  fd.append('niche', niche);
                 fd.append('purpose', purpose);
                 fd.append('urls', urlallValues);
                 fd.append('color', bottheme_color);
                 fd.append('bottext_color', bottext_color);
                 fd.append('botbackground_color', botbackground_color);
                 fd.append('usertext_color', usertext_color);
                 fd.append('userbackground_color', userbackground_color);
                 
                //  fd.append('website_content', website_content);
                //  fd.append('website_url', website_url);
                 fd.append('languaage', languaage);
                 fd.append('autoresponder', autoresponder);
                 fd.append('select_list', select_list);
                 
                 for (var i = 0; i < 5; i++) {
                    fd.append("pdf_docs[]", $scope.pdfs[i]);
                }
                
               
                 
                 $http({
                     method: 'POST',
                     url: 'store',
                     aync: false,
                     data: fd,
                     dataType: "json",
                     transformRequest: angular.identity,
                     headers: {
                         'Content-Type': undefined
                     }
                 }).then(function(response) {
                    //  console.log();
                     quesObj = {};
                     jsLoader(false);
                     if (response.data.status == 1) {
                         $scope.fileList = '';
                         $('#modalMessage').text(response.data.prompt);
                         $('#vaMessageModal').modal('show');
                         toastr.success(response.data.msg);
                     } else if (response.data.error) {
                         toastr.error(response.data.error.message);
                         
                     } else {
                         toastr.error('Something went wrong');
                     }
                 });

             }
             
             
            
             
             
             $scope.checkWebButton = function (path) {
                  var autoresponder = $('#autoresponder').find(":selected").val();
                  var select_list = $('#select_list').find(":selected").val();
                  if($scope.text != undefined && $scope.bottheme_color != '' && autoresponder != '' && select_list != '')
                  {
                      $scope.isButtonDisabled = false;
                      $scope.isButtonDisabledClass = 'base-btn theme-btn-blue mt10';
                  }else{
                      $scope.isButtonDisabled = true;
                      $scope.isButtonDisabledClass = 'base-btn theme-btn-blue mt10 disabled-btn';
                  }
             }
             
             $scope.websiteContentShow = function(){
                 if($scope.purpose == 'url'){
                     $scope.isHide = false;
                 }else{
                     $scope.isHide = true;
                     $scope.website_content = '';
                     $scope.website_url = '';
                 }
             }
             
             
             $scope.updateChatBg = function (path) {
             $('#collClose').trigger('click');
               $scope.chatbotFile = path;
               $scope.setType = 'default';
               $scope.setChatBg(path,$scope.activeChatbox);
             }
             
             $scope.setChatBg = function (path) {
               document.getElementById($scope.activeChatbox).style.backgroundImage = "url(" + path + ")";
               document.getElementById($scope.activeChatbox).style.backgroundPosition = "center center";
               document.getElementById($scope.activeChatbox).style.backgroundRepeat = "no-repeat";
               document.getElementById($scope.activeChatbox).style.backgroundSize = "cover";
             }
             $scope.setChatBg(chatbot_background ? chatbot_background : "https://cdn.intellimateai.co/assets/images/whitebg1.webp");

             
            $scope.getSearchAuthUrl = function(){
               
                 $scope.auth_data = {website_auth_url: $scope.website_auth_url,purpose:$scope.purpose}
                 var data = {
                            website_auth_url: $scope.website_url,
                            };
               jsLoader(true);
                 
              	$http({
				method 	: 'POST',
				url 	: 'search_authenticat_url',
				data 	: $.param(data),
				headers : {'Content-Type': 'application/x-www-form-urlencoded','X-Requested-With': 'XMLHttpRequest'}
		}).then(function(response) {
		     jsLoader(false);
            	$scope.website_content = response.data;
		
			
		});
                 
                 
                 
                 
                 
                 
                 
            }
             
         }); 
         
$(document).ready(function() {
         
   $(function () {
        $(document).on("change", "#autoresponder", function () {
        
        $('#autoresponder_Checkbox').prop('checked', false)
            var autoresponder_ids =  $(this).find('option:selected').val()
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

   

    <?php if($chatbotObj->autoresponder_id) { ?>
        jQuery('#autoresponder').selectpicker('val', '<?php echo $chatbotObj->autoresponder_id ?>');
        setResponderFormList('<?php echo $chatbotObj->autoresponder_id ?>');
    <?php } ?>
    
    
   function isListShow() {

        if ($(this).find('option:selected').val() == 15 || $(this).find('option:selected').val() == 17) {
            return true;
        } else {
            return false;
        }
    }

   function setResponderFormList(autoresponder_ids) {
        $(".list_id").remove();
       // responderLoader(true);
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('autoresponder_forms'); ?>',
            data: {'autoresponder_id': autoresponder_ids},
            dataType: 'json',
            success: function (response) {
               // responderLoader(false);
        
                $.each(response, function (index, value) {
                    var autoresponderSet = (list_id == value.listid) ? 'selected' : '';  
                    $(".responder_form_option").after("<option class='list_id' value='" + value.listid + "' "+autoresponderSet+">" + value.title + "</option>");
                });
                
                
                setTimeout(function(){ $('.selectpicker').selectpicker('refresh')}, 500);
                    //$('.selectpicker').selectpicker('refresh');
            
              /*  if (setDefault) {
                    setDefault = false;
                    setDefaultAutoresponder();
                }*/

            }
        });
    }
    
    
   function responderLoader(add) {
            if (add === undefined) {
                add = false;
            }
            $(".temp_js_loader").remove();
            if (add) {
                $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $assets_folder; ?>images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;"></div>');}
        }
                
                            
});

 
         
     </script>
     
    <!--Upload File JS Start-->
     
     <script>
    //     function importData() {
    //         let input = document.createElement('input');
    //         input.type = 'file';
    //         input.onchange = _ => {
    //              you can use this method to get file and perform respective operations
    //             let files =   Array.from(input.files);
    //             console.log(files);
    //         };
    //         input.click();
    //     }
     </script>
    
    <!--Upload File JS End-->
    
    <!-- value Add Remove Start-->
    <script>
    $('.quantity').each(function() {
  var spinner = $(this),
      btnUp = spinner.find('.quantity__btn--up'),
      btnDown = spinner.find('.quantity__btn--down'),
      min = input.attr('min'),
      max = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });
});
</script>
<!-- value Add Remove Ends-->

<script>
    if(form_step != 5)
    {
        progressBar(parseInt(form_step) + 1);
    }
    $(document).on('click','.progress-item',function(e){
        progressBar(parseInt($(this).data('step')));
    });

    function progressBar(step) {
        var percent = (parseInt(step) / 6) * 100;
        $('.progress-bar').css({ width: percent + '%' });
    }
</script>

<script>
     function updateFileCounter() {
        const fileInput = document.getElementById('file-input');
        const fileCount = document.getElementById('file-count');
        const fileCountMessage = document.getElementById('file-count-message');

        if (fileInput.files && fileInput.files.length > 0) {
            fileCount.innerText = fileInput.files.length;
            fileCountMessage.style.display = 'block';
        } else {
            fileCountMessage.style.display = 'none';
        }
    }
</script>

 <script>
//     $(document).ready(function () {
//         var maxUrls = 4;

//         $(document).on('click', '#addUrl', function () {
//             var currentUrlCount = $('#urlDiv input[name="url[]"]').length;

//             if (currentUrlCount < maxUrls) {
//                 var urlHtml = `<div>
//                                     <input type="text" name="url[]" placeholder="What is your least" class="form-control search-clr">
//                                     <button type="button" class="removeUrl">Remove</button>
//                               </div> `;
//                 $('#urlDiv').append(urlHtml);
//                 if ($('#urlDiv input[name="url[]"]').length === maxUrls) {
//                     $('#addUrl').hide();
//                     toastr.warning('Urls limit exceeded');
//                 }
//             } else {
//                 toastr.warning('Urls limit exceeded');
//             }
//         });

//         $(document).on('click', '.removeUrl', function () {
//             $(this).parent().remove();
//             $('#addUrl').show();
//         });
//     });
 </script>

<script>
 $(document).ready(function () {
    var maxUrls = 4;
 
    $(document).on('click', '#addUrl', function () {
        var currentUrlCount = $('#urlDiv input[name="url[]"]').length;
        if (currentUrlCount < maxUrls) {
            var urlHtml = ` <div>
                                <input type="text" name="url[]" placeholder="Enter Your Url" class="form-control search-clr" style="margin-bottom:20px;">
                            </div> `; 
            $('#urlDiv').append(urlHtml);
            if ($('#urlDiv input[name="url[]"]').length === maxUrls) {
                $('#addUrl').hide();
                 toastr.warning('Urls limit exceeded');
            }
        } else {
             toastr.warning('Urls limit exceeded');
        }
    });

    $('.getEmbedCode').click(function() {
         var text = $(this).data('script');
         copyContent(text);
    });
    
    async function copyContent(text){
        try {
             await navigator.clipboard.writeText(text);
             toastr.info('Embeeded Script Copy');
              setTimeout(function() {
                  location.reload();
            }, 2000);

         } catch (err) {
             console.error('Failed to copy: ', err);
         }
    }

    $('.delete-va').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                     data: { id: id },
                    url: siteUrl + 'virtual-assistant/delete',
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        });
    });

    var queAns = '<?php echo json_encode($queAns); ?>';
    var queAns = queAns ? JSON.parse(queAns) : {};
    $.each(queAns,function(key,value){
        key++;
        jQuery('#question'+key).val(value.question);
        jQuery('#answer'+key).val(value.response);
    });

});
 
</script>