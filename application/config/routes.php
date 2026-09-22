<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('pr')) {
    function pr($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}
$user_folder = 'default/';
$prefix_videoname = $this->config->item('prefix_video_route');
$prefix_videoapi = $this->config->item('prefix_video_api');
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url, $this->config->item('adminName')) !== false) {
    require_once('routesadmin.php'); // previously it was routes_admin
} else {
	//die('stopwelcome');
    $route['default_controller'] = 'Dashboard_controller';
    $route['404_override'] = 'Error/index';
    $route['translate_uri_dashes'] = FALSE;
}

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'Dashboard_controller';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;


/*
 * Conversaion routes
*/


$route['dashboard'] = $user_folder . 'Dashboard_controller/index';
$route['dashboard/get-credit'] = $user_folder . 'Dashboard_controller/getCredit';
$route['dashboard/get-newlead-count'] = $user_folder . 'Dashboard_controller/getNewLeadsCount';
$route['dashboard/get-optimization-graph-data'] = $user_folder . 'Dashboard_controller/get_optimization_graph_data';
$route['test'] = $user_folder . 'Dashboard_controller/test';
$route['superva-update'] = $user_folder . 'Dashboard_controller/superVaUpdate';
$route['getbusinessheader'] = $user_folder . 'Dashboard_controller/getBusinessHeader';






$route['temp'] = $user_folder . 'Dashboard_controller/temp';
$route['testing'] = $user_folder . 'Dashboard_controller/testing';
//$route['test-avatar'] = $user_folder . 'Dashboard_controller/testAvatar';

$route['conversation'] = $user_folder . 'Conversation_controller';
$route['conversation-media'] = $user_folder . 'Conversation_controller/conversationMedia';
$route['my-conversations'] = $user_folder . 'Conversation_controller/conversationList';
$route['get_conversation_list'] = $user_folder . 'Conversation_controller/getConversationList';
$route['delete_conversation'] = $user_folder . 'Conversation_controller/deleteConversation';
$route['delete_conversation_multiple'] = $user_folder . 'Conversation_controller/deleteConversationMultiple';
$route['download_conversation'] = $user_folder . 'Conversation_controller/downloadConversation';
$route['save-curl'] = $user_folder . 'Conversation_controller/saveCurlFiles';

// create folder Routes for 
$route['conversation-my-assets/add-folder'] = $user_folder . 'Conversation_controller/addFolder';
$route['conversation-my-assets/get-all-folders'] = $user_folder . 'Conversation_controller/getAllFolders';
$route['conversation-my-assets/rename-object'] = $user_folder . 'Conversation_controller/renameFolder'; 
$route['conversation-my-assets/delete-object'] = $user_folder . 'Conversation_controller/deleteObject';
$route['conversation-my-assets/open-folder-view'] = $user_folder . 'Conversation_controller/openFolderView';
$route['conversation-my-assets/save-asset'] = $user_folder . 'Conversation_controller/saveAssets';


//talk route
$route['create-talk'] = $user_folder . 'CreateTalk_controller/createTalk';
$route['text-to-audio'] = $user_folder . 'CreateTalk_controller/textToAudio';
$route['generate-text-to-audio'] = $user_folder . 'CreateTalk_controller/getTextToAudio';
$route['audiolist'] = $user_folder . 'CreateTalk_controller/getAiGenerationVoice';
$route['get-ai-generationVoice-list'] = $user_folder . 'CreateTalk_controller/getAiGenerationVoiceList';
$route['delete-audio'] = $user_folder . 'CreateTalk_controller/deleteAudio';



/*
 * Login routes
*/

$route['login'] = $user_folder . 'Login_controller/login';
$route['logout'] = $user_folder . 'Login_controller/logout';
$route['forgot-password'] = $user_folder . 'Login_controller/forgotPassword';
$route['forgot-password/thank-you'] = $user_folder . 'Login_controller/aftrForgotPassword';

$route['reset-password'] = $user_folder . 'Login_controller/resetPassword';
$route['reset-password/success'] = $user_folder . 'Login_controller/afterResetPassword';

$route['bonus-signup'] = $user_folder . 'Login_controller/BonusSignup';



/**
 * User Profile
 * ================================================
 */

$route['profile'] = $user_folder . 'Profile_controller';
$route['save-user-profile'] = $user_folder . 'Profile_controller/saveUserProfile';


/**
 * Bonuses
 * =================================================
 */
// $route['bonuses'] = $user_folder . 'Bonus_controller/index';
$route['bonuses/(:any)'] = $user_folder . 'Bonus_controller/index/$1';

$route['reset-autoresponder'] = $user_folder . 'Integration_controller/resetAutoresponder';

/* whitelabel */
$route['whitelabel-setting'] = $user_folder . 'Whitelabel_controller/index';
$route['insertdata'] = $user_folder . 'Whitelabel_controller/insertdata';
$route['whitelabel-reset'] = $user_folder . 'Whitelabel_controller/whitelabel_reset';

/* whitelable ends */


/**
 * Integration Settings
 * ================================================
 */
$route['settings'] = $user_folder . 'Settings_controller/index';



/* smtp setting routes*/
$route['smtp-setting'] = $user_folder . 'Smtp_setting_controller/index';
$route['save-smtp'] = $user_folder . 'Smtp_setting_controller/insertdata';


/* Autoresponder Lead Data */
$route['autoresponder-lead-list'] = $user_folder . 'Autoresponder_lead_data_controller/index';

$route['export-csv'] = $user_folder . 'Autoresponder_lead_data_controller/exportcsv';
$route['get-autoresponder-lead-list'] = $user_folder . 'Autoresponder_lead_data_controller/getResponderLeadList'; 
$route['autoresponder-lead-list/delete'] = $user_folder . 'Autoresponder_lead_data_controller/deleteResponder'; 
$route['download-autoresponder-lead'] = $user_folder . 'Autoresponder_lead_data_controller/downloadAutoResponderLead';

$route['getapp-response-list'] = $user_folder . 'Autoresponder_lead_data_controller/getResponseList';
$route['autoresponder-lead-list/delete-app-response'] = $user_folder . 'Autoresponder_lead_data_controller/deleteAppResponse';
$route['autoresponder-lead-list/app-response-question'] = $user_folder . 'Autoresponder_lead_data_controller/app_response_question';

$route['visitor-feedback-list'] = $user_folder . 'Autoresponder_lead_data_controller/coPilotFeedbackList'; 
$route['autoresponder-lead-list/delete-feedback'] = $user_folder . 'Autoresponder_lead_data_controller/deleteFeedback';





$route['pexel-images'] = $user_folder . 'Conversation_controller/getImagesPexel';
$route['images'] = $user_folder . 'Conversation_controller/images';
$route['search-library'] = $user_folder . 'Conversation_controller/searchImages';
$route['save-image-url'] = $user_folder . 'Conversation_controller/saveImageUrl';
$route['image-response-to-html'] = $user_folder . 'Conversation_controller/imageResponseToHtml';




$route['pdfgenerate'] = $user_folder . 'Conversation_controller/pdfGenerate';
$route['getconversation'] = $user_folder . 'Conversation_controller/getConversation';
$route['chat'] = $user_folder . 'Conversation_controller/chat';
$route['my-chat'] = $user_folder . 'Conversation_controller/chat';
$route['openai'] = $user_folder . 'Conversation_controller/openai';
$route['getchattitle'] = $user_folder . 'Conversation_controller/getchattitle';
$route['getchatlist'] = $user_folder . 'Conversation_controller/getchatlist';
$route['file-upload'] = $user_folder . 'Conversation_controller/fileUpload';
$route['prompt-category'] = $user_folder . 'Conversation_controller/getPromptCategory';
$route['prompt-detail'] = $user_folder . 'Conversation_controller/getPromptDetail';
$route['chat-update'] = $user_folder . 'Conversation_controller/chatUpdate';
$route['delete-chat'] = $user_folder . 'Conversation_controller/deleteChat';
$route['conversation/chat-setting'] = $user_folder . 'Conversation_controller/chatSetting';


/*
* Virtural Assistant routes
*/
$route['virtual-assistant'] = $user_folder . 'VirtualAssistant_controller/index';
//chat-bot list route
$route['virtual-assistant/list'] = $user_folder . 'VirtualAssistant_controller/view';
$route['virtual-assistant/create'] = $user_folder . 'VirtualAssistant_controller/create';
$route['virtual-assistant/store'] = $user_folder . 'VirtualAssistant_controller/store';
$route['virtual-assistant/webstore'] = $user_folder . 'VirtualAssistant_controller/webStore';
$route['virtual-assistant/web-preview/(:any)'] = $user_folder . 'VirtualAssistant_controller/webPreview';
$route['virtual-assistant/edit/(:any)'] = $user_folder . 'VirtualAssistant_controller/edit';
$route['virtual-assistant/appoint/(:any)'] = $user_folder . 'VirtualAssistant_controller/appoint';
$route['virtual-assistant/update'] = $user_folder . 'VirtualAssistant_controller/updateAssitant';
$route['virtual-assistant/delete'] = $user_folder . 'VirtualAssistant_controller/deleteVa';
$route['virtual-assistant/deletemultiva'] = $user_folder . 'VirtualAssistant_controller/deleteMultiVa';
$route['virtual-assistant/get-va'] = $user_folder . 'VirtualAssistant_controller/getVA';
$route['virtual-assistant/get-inactiveva'] = $user_folder . 'VirtualAssistant_controller/getInactiveVA';
$route['virtual-assistant/change-status'] = $user_folder . 'VirtualAssistant_controller/changeStatus';
$route['virtual-assistant/search_authenticat_url'] = $user_folder . 'VirtualAssistant_controller/search_authenticat_url';
$route['virtual-assistant/updateFav-status'] = $user_folder . 'VirtualAssistant_controller/updateFavStatus';

$route['virtual-assistant-v1/create'] = $user_folder . 'VirtualAssistant_v1_controller/create';
$route['virtual-assistant-v1/create/(:num)'] = $user_folder . 'VirtualAssistant_v1_controller/create/$1';
$route['virtual-assistant-v1/list'] = $user_folder . 'VirtualAssistant_v1_controller/view';
$route['virtual-assistant-v1/store_theme'] = $user_folder . 'VirtualAssistant_v1_controller/store_theme';
$route['virtual-assistant-v1/store_profile'] = $user_folder . 'VirtualAssistant_v1_controller/store_profile';
$route['virtual-assistant-v1/store_qa'] = $user_folder . 'VirtualAssistant_v1_controller/store_qa';
$route['virtual-assistant-v1/store_training'] = $user_folder . 'VirtualAssistant_v1_controller/store_training';
$route['virtual-assistant-v1/store_cta'] = $user_folder . 'VirtualAssistant_v1_controller/store_cta';
$route['virtual-assistant-v1/store_cta1'] = $user_folder . 'VirtualAssistant_v1_controller/store_cta1';
$route['virtual-assistant-v1/gettrainstatus'] = $user_folder . 'VirtualAssistant_v1_controller/getTrainStatus';
// code by abhishek
$route['virtual-assistant-v1/create1'] = $user_folder . 'VirtualAssistant_v1_controller/create1';
$route['virtual-assistant-v1/create1/(:num)'] = $user_folder . 'VirtualAssistant_v1_controller/create1/$1';
$route['virtual-assistant-v1/store_profile1'] = $user_folder . 'VirtualAssistant_v1_controller/store_profile1';
$route['virtual-assistant-v1/store_qa1'] = $user_folder . 'VirtualAssistant_v1_controller/store_qa1';
$route['virtual-assistant-v1/getChatgptModel'] = $user_folder . 'VirtualAssistant_v1_controller/getChatgptModel';
$route['virtual-assistant-v1/addworkspace-chatbot'] = $user_folder . 'VirtualAssistant_v1_controller/addWorkspacechatbot';
$route['virtual-assistant-v1/soft-delete-chatbot'] = $user_folder . 'VirtualAssistant_v1_controller/softdeletechatbot';
$route['virtual-assistant-v1/view-test'] = $user_folder . 'VirtualAssistant_v1_controller/viewtest';
$route['virtual-assistant-v1/gettrainstatusnew'] = $user_folder . 'VirtualAssistant_v1_controller/getTrainStatusNew';
$route['virtual-assistant-v1/getuntrainstatusnew'] = $user_folder . 'VirtualAssistant_v1_controller/getUnTrainStatusNew';
$route['virtual-assistant-v1/gpt'] = $user_folder . 'VirtualAssistant_v1_controller/save_gpt_data';
$route['virtual-assistant-v1/embed_status_change'] = $user_folder . 'VirtualAssistant_v1_controller/embed_status_change';
$route['virtual-assistant-v1/overview_chatbot'] = $user_folder . 'VirtualAssistant_v1_controller/overview_bot';



/*
* integration routes
*/
$route['integration'] = $user_folder . 'Integration_controller/index';
$route['integration/add'] = $user_folder . 'Integration_controller/add';
$route['integration/addIntegration'] = $user_folder . 'Integration_controller/addIntegration';
$route['autoresponder_datasender'] = $user_folder . 'Autoresponder_sender_controller';
$route['autoresponder_forms'] = $user_folder . 'Integration_controller/autoresponder_forms';


/**
 * drive
 * =================================================
 */
 
$route['my-assets'] = $user_folder . 'Assets_controller/index';
$route['my-assets/add-folder'] = $user_folder . 'Assets_controller/addFolder';
$route['my-assets/get-all-folders'] = $user_folder . 'Assets_controller/getAllFolders';
$route['my-assets/rename-object'] = $user_folder . 'Assets_controller/renameFolder'; 
$route['my-assets/delete-object'] = $user_folder . 'Assets_controller/deleteObject';
$route['my-assets/open-folder-view'] = $user_folder . 'Assets_controller/openFolderView';
$route['my-assets/getdocxdata'] = $user_folder . 'Assets_controller/getDocxData';

$route['get-asset'] = $user_folder . 'Assets_controller/getAssets';

/**
 * Business
 * ================================================
 */
// $route['business'] = $user_folder . 'Business_controller/business_list';
// $route['create-business'] = $user_folder . 'Business_controller/create_business';
// $route['business_switch/(:num)'] = $user_folder . 'Business_controller/business_switch/$1';
// $route['get-business-list-json'] = $user_folder . 'Business_controller/get_business_list_json';
// $route['delete-business-json'] = $user_folder . 'Business_controller/deleteBusinessJson';

// $route['business-settings/(:num)'] = $user_folder . 'Business_controller/BusinessSettings/$1';
// $route['save_business-settings'] = $user_folder . 'Business_controller/SaveBusinessSettings';


/**
*Business_finder
*
* =================================================
*/
$route['business-finder']     = $user_folder. 'Business_finder_controller/index';
$route['search-place-keyword'] =          $user_folder . 'Business_finder_controller/findPlaces';
$route['save-search-business'] =          $user_folder . 'Business_finder_controller/SaveSearchBusiness';
$route['business-list'] =          $user_folder . 'Business_finder_controller/businessList';
$route['delete-business'] =          $user_folder . 'Business_finder_controller/businessDelete';




$route['workspace'] = $user_folder . 'Business_controller/business_list';
$route['create-workspace'] = $user_folder . 'Business_controller/create_business';
$route['workspace_switch/(:num)'] = $user_folder . 'Business_controller/business_switch/$1';
$route['get-workspace-list-json'] = $user_folder . 'Business_controller/get_business_list_json';
$route['delete-workspace-json'] = $user_folder . 'Business_controller/deleteBusinessJson';

$route['workspace-settings/(:num)'] = $user_folder . 'Business_controller/BusinessSettings/$1';
$route['save_workspace-settings'] = $user_folder . 'Business_controller/SaveBusinessSettings';



/**
 * Team Management
 * ================================================
 */
$route['team-management'] = $user_folder . 'Team_controller/index';
$route['get-team-list-json'] = $user_folder . 'Team_controller/TeamListJson';
$route['edit-team-member/(:num)'] = $user_folder . 'Team_controller/editTeamMember/$1';
$route['edit-team-member-json'] = $user_folder . 'Team_controller/editTeamMemberJson';
$route['delete-team-member-json'] = $user_folder . 'Client_controller/deleteTeamMemberJson';
$route['add-team-member'] = $user_folder . 'Team_controller/AddTeam';
$route['add-team-member-json'] = $user_folder . 'Team_controller/AddTeamMemberJson';

$route['save_autoresponder_forms'] = $user_folder . 'VirtualAssistant_controller/saveAutoresponderForms';
$route['get_save_autoresponder_forms'] = $user_folder . 'VirtualAssistant_controller/getSaveAutoresponderForms';


/**
 * old Team Management
 * ================================================
//  */
// $route['team-management'] = $user_folder . 'Team_controller/index';
// $route['get-team-list-json'] = $user_folder . 'Team_controller/TeamListJson';
// $route['edit-team-member/(:num)'] = $user_folder . 'Team_controller/editTeamMember/$1';
// $route['edit-team-member-json'] = $user_folder . 'Team_controller/editTeamMemberJson';
// $route['delete-team-member-json'] = $user_folder . 'Team_controller/deleteTeamMemberJson';
// $route['add-team-member'] = $user_folder . 'Team_controller/AddTeam';
// $route['add-team-member-json'] = $user_folder . 'Team_controller/AddTeamMemberJson';


/**
 * old Client Management
 * ================================================
 */
$route['client-management'] = $user_folder . 'Client_controller/index';
$route['get-client-list-json'] = $user_folder . 'Client_controller/TeamListJson';
$route['edit-client-member/(:num)'] = $user_folder . 'Client_controller/editTeamMember/$1';
$route['edit-client-member-json'] = $user_folder . 'Client_controller/editTeamMemberJson';
$route['delete-client-member-json'] = $user_folder . 'Client_controller/deleteTeamMemberJson';
$route['add-client-member'] = $user_folder . 'Client_controller/AddTeam';
$route['add-client-member-json'] = $user_folder . 'Client_controller/AddTeamMemberJson';



/**
 * Client Management
 * ================================================
 */
// $route['client-management'] = $user_folder . 'Client_controller/index';
// $route['get-client-list-json'] = $user_folder . 'Client_controller/ClientListJson';
// $route['delete-client-json'] = $user_folder . 'Client_controller/deleteClientJson';
// $route['add-client'] = $user_folder . 'Client_controller/AddClient';
// $route['add-client-json'] = $user_folder . 'Client_controller/AddClientJson';
// $route['edit-client/(:num)'] = $user_folder . 'Client_controller/EditClient/$1';
// $route['edit-client-json'] = $user_folder . 'Client_controller/EditClientJson';



$route['save_autoresponder_forms'] = $user_folder . 'VirtualAssistant_controller/saveAutoresponderForms';
$route['get_save_autoresponder_forms'] = $user_folder . 'VirtualAssistant_controller/getSaveAutoresponderForms';


/**
 * Trainings
 * =================================================
 */
$route['training'] = $user_folder . 'Training';
/**
 * Trainings
 * =================================================
 */
$route['training'] = $user_folder . 'Training';
$route['training-pdf'] = $user_folder . 'Training/pdfTraining';
$route['faqs'] = $user_folder . 'Training/faqs';
$route['faqs/(:any)'] = $user_folder . 'Training/faqs/$1';
$route['faqs-like-dislike-json'] = $user_folder . 'Training/faqsLikeDislikeJson';

/**
 * Crons
 * =================================================
 */
$route['get-free-credit'] = $user_folder . 'Cron_controller/getFreeCredit';





/**
 * 
 * Trainings
 * =================================================
 */
$route['session'] = $user_folder . 'Session_controller';
$route['get-session-list-json'] = $user_folder . 'Session_controller/getSessionListDatadd';

/**
 * Subscription_controller
 * =================================================
 */
$route['subscription'] = $user_folder . 'subscription_controller/index';
$route['payment'] = $user_folder . 'subscription_controller/payment';
$route['user_credit'] = $user_folder . 'subscription_controller/user_credit';

/**
 * TTS by mahesh
 * ================================================
 */
$route['get-language-detail'] = $user_folder . 'Tts/get_language_detail';
$route['spin'] = $user_folder . 'Tts/spin';
$route['vox'] = $user_folder . 'Tts/start';
$route['vox-list'] = $user_folder . 'Tts/audio_list';
$route['vox-list-json'] = $user_folder . 'Tts/getVoxlistJson';
$route['start_action'] = $user_folder . 'Tts/start_action';
$route['tts-download/(:num)'] = $user_folder . 'Tts/download/$1';
$route['tts-remove/(:num)'] = $user_folder . 'Tts/remove/$1';


/* ipn */
$route['jvz-ipn'] = "package/Ipn/index";
$route['wp-ipn'] = "package/Warrior_plus_ipn/index";
$route['launchpad-ipn'] = "package/Launchpad_ipn/index";


/**
 * Campaigns
 * ================================================
 */
$route['campaigns'] = $user_folder . 'Campaigns_controller/index';
$route['templates'] = $user_folder . 'Templates_controller/index';
$route['get_more_template'] = $user_folder . 'Templates_controller/get_more_template';
$route['campaign_template'] = $user_folder . 'Templates_controller/campaign_template';
$route['my_templates'] = $user_folder . 'Templates_controller/my_templates';
$route['templates/action'] = $user_folder . 'Templates_controller/action';

//$route['templates/(:num)'] = $user_folder . 'Templates_controller/index/$1';

/*chatboat response audio check*/
$route['start-action-chatbot'] = $user_folder . 'Tts_chatbot/start_action_chatbot';


/**
 * Vision
 * ================================================
 */
// Vision_controller
$route['text-to-image'] = $user_folder . 'Vision_controller/texttoImage';
$route['image-to-image'] = $user_folder . 'Vision_controller/imagetoImage';
$route['text-to-video'] = $user_folder . 'Vision_controller/texttoVideo';
$route['save-ai-generation'] = $user_folder . 'Vision_controller/saveAiGeneration';

$route['generate-text-to-image'] = $user_folder . 'Vision_controller/generateTexttoImage';
$route['generate-image-to-image'] = $user_folder . 'Vision_controller/generateImagetoImage';
$route['generate-text-to-video'] = $user_folder . 'Vision_controller/generateTexttoVideo';
$route['get-ai-generation-list'] = $user_folder . 'Vision_controller/getAiGenerationList';
$route['get-ai-generation-delete'] = $user_folder . 'Vision_controller/getAiGenerationDelete';
$route['remain-image-count'] = $user_folder . 'Vision_controller/remainImageCount';


$route['test'] = $user_folder . 'Test/index';
$route['chatbotcron'] = $user_folder . 'Cron_controller/chatbotCron';

//============== ROUTE FOR 100APP BY LUCKY=========

$route['template-apps'] = $user_folder . 'AppTemplate_controller/index';
$route['template-apps_upload'] = $user_folder . 'AppTemplate_controller/upload_template_excel';
$route['template-apps-create'] = $user_folder . 'AppTemplate_controller/createTemplates';
$route['custom-template-list'] = $user_folder . 'AppTemplate_controller/custom_template_list';
$route['create-app-custom-template'] = $user_folder . 'AppTemplate_controller/create_app_custom_template';

$route['template-profile-save'] = $user_folder . 'AppTemplate_controller/custom_template_profile_save';
$route['template-questions-save'] = $user_folder . 'AppTemplate_controller/custom_template_question_save';
$route['template-appstyle-save'] = $user_folder . 'AppTemplate_controller/custom_template_question_appstyle_save';

$route['get-app-list'] = $user_folder . 'AppTemplate_controller/get_app_list';

$route['create-newapp'] = $user_folder . 'AppTemplate_controller/createNewapp';
$route['create-newapp-profile-save'] = $user_folder . 'AppTemplate_controller/createNewapp_profile_save';
$route['create-newapp-questions-save'] = $user_folder . 'AppTemplate_controller/createNewappQuestion_question_save';
$route['create-newapp-appstyle-save'] = $user_folder . 'AppTemplate_controller/createNewapp_appstyle_save';

$route['scratchapp-question-save'] = $user_folder . 'AppTemplate_controller/app_question_save';

$route['edit-app/(:num)'] = $user_folder . 'AppTemplate_controller/edit_app/$1';
$route['edit-profile-save'] = $user_folder . 'AppTemplate_controller/edit_profile_save';
$route['edit-questions-save'] = $user_folder . 'AppTemplate_controller/edit_question_save';
$route['edit-appstyle-save'] = $user_folder . 'AppTemplate_controller/edit_appstyle_save';

$route['edit-app-save'] = $user_folder . 'AppTemplate_controller/edit_app_save';
$route['delete-app'] = $user_folder . 'AppTemplate_controller/delete_app';
$route['duplicate-app'] = $user_folder . 'AppTemplate_controller/duplicateApp';
$route['addworkspace-app'] = $user_folder . 'AppTemplate_controller/addWorkspaceApp';
$route['addappset-app'] = $user_folder . 'AppTemplate_controller/addappset';


$route['view-appset/(:any)'] = $user_folder . 'AppSetView_controller/viewAppSetById/$1';
$route['get-app-infobyid'] = $user_folder . 'AppSetView_controller/getAppInfoById';
$route['chatgpt'] = $user_folder . 'AppSetView_controller/chatgpt';
$route['updateAppsetEmbedcode'] = $user_folder . 'AppSet_controller/updateAppsetEmbedcode';
$route['create-appset-profile-save'] = $user_folder . 'AppSet_controller/create_appset_profile_save';
$route['updateFav-status'] = $user_folder . 'AppSet_controller/updateFavStatus';





//route by SAJID
$route['generate-ai-image'] = $user_folder . 'Inkflow_email_controller/generateAiImage';
$route['generate-ai-image-stock'] = $user_folder . 'Inkflow_email_controller/generateAiImageStock';




//** remotion video editor route by mahesh start *//

 $route[$prefix_videoname.'/video-editor']              = $user_folder . 'Remotion_video_controller';
 $route[$prefix_videoapi.'/append_video_parts']         = $user_folder . 'Remotion_editor_api_controller/append_parts';
 $route[$prefix_videoapi.'/queue_insert']               = $user_folder . 'Remotion_editor_api_controller/queueInsert';
 $route[$prefix_videoapi.'/get-user-video']             = $user_folder . 'Remotion_editor_api_controller/getUserVideo';
 $route[$prefix_videoapi.'/get-user-images']            = $user_folder . 'Remotion_editor_api_controller/getUserImage';
 $route[$prefix_videoapi.'/get-user-audios']            = $user_folder . 'Remotion_editor_api_controller/getUserAudio';
 $route[$prefix_videoapi.'/render-video-server']        = $user_folder . 'Remotion_editor_api_controller/renderVideo';
 $route[$prefix_videoapi.'/watermark']                  = $user_folder . 'Remotion_editor_api_controller/getWatermarkLogo';
 $route[$prefix_videoapi.'/get-save-draft-template']    = $user_folder . 'Remotion_editor_api_controller/getSaveDraftTemplate';
 $route[$prefix_videoapi.'/save-draft-template']        = $user_folder . 'Remotion_editor_api_controller/saveDraftTemplate';
 $route[$prefix_videoapi.'/delete-save-draft-template'] = $user_folder . 'Remotion_editor_api_controller/deleteSaveDraftTemplate';
 $route[$prefix_videoapi.'/get-default-template']       = $user_folder . 'Remotion_editor_api_controller/defaultTemplate';
 $route[$prefix_videoapi.'/get-user-avatar-video']      = $user_folder . 'Remotion_editor_api_controller/getUserHeygenVideo';
 $route[$prefix_videoapi.'/add-background-reomove']      = $user_folder . 'Remotion_editor_api_controller/addBackgroundRemoveVideo';
 $route[$prefix_videoapi.'/update-title-editor']        = $user_folder . 'Remotion_editor_api_controller/addTitleEditor';
 $route['upload-imagesss']                              = $user_folder . 'Remotion_editor_api_controller/downloadImageUrl';
 
//  add new by kunj

$route[$prefix_videoapi.'/text-to-image']              = $user_folder . 'Remotion_editor_api_controller/textToImage';
 $route[$prefix_videoapi.'/get-ai-image-generate']      = $user_folder . 'Remotion_editor_api_controller/getAiImageGenerat';
 $route[$prefix_videoapi.'/get-default-sp-audio']       = $user_folder . 'Remotion_editor_api_controller/getSpeechifyDefaultAudioList';
 $route[$prefix_videoapi.'/generate-ai-sp-audio']       = $user_folder . 'Remotion_editor_api_controller/generateSpeechifyAudio';
 $route[$prefix_videoapi.'/get-ai-sp-audio-list']       = $user_folder . 'Remotion_editor_api_controller/getSpeechifyAudioList';
 $route[$prefix_videoapi.'/delete-ai-sp-audio-list']       = $user_folder . 'Remotion_editor_api_controller/deleteAiSpAudioList';
 $route[$prefix_videoapi.'/get-user-mystories-video-list']       = $user_folder . 'Remotion_editor_api_controller/get_user_mystories_video_list';

 
 
 
 
 
 
 
 $route['video-editor-list']                            = $user_folder . 'Remotion_video_controller/videoEditorList';
 $route['create-new-project']                           = $user_folder . 'Remotion_video_controller/createNewProject';
 $route['edit-video-template/(:num)']                   = $user_folder . 'Remotion_video_controller/editVideoTemplate/$1';
 $route['edit-default-video-template/(:num)']           = $user_folder . 'Remotion_video_controller/editDefaultVideoTemplate/$1';
 $route['get-voice']                                    = $user_folder . 'Remotion_video_controller/getHeygenVoice';
 $route['get-avatar']                                   = $user_folder . 'Remotion_video_controller/getHeygenAvatar';
 $route['upload-avatar']                                = $user_folder . 'Remotion_video_controller/uploadOwnPhotoHeygen';
 $route['avatar-video-generate']                        = $user_folder . 'Remotion_video_controller/avatarVideoGenerate';
 $route['get-video-status']                             = $user_folder . 'Remotion_video_controller/getCompeleteVideoStatus';
 $route['video-templates']                              = $user_folder . 'Remotion_video_controller/getTemplates';
 $route['talking-avatars']                              = $user_folder . 'Remotion_video_controller/getHeygenTalkingPhotoAvatar';
//  $route['ai-avatars-video']                             = $user_folder . 'Remotion_video_controller/getAiAvatarVideo';
 $route['get-getAvatarMadeList']                        = $user_folder . 'Remotion_video_controller/getAvatarMadeList';
 $route['get-avatar-title']                             = $user_folder . 'Remotion_video_controller/getavatartitle';
 $route['get-editor-list']                              = $user_folder . 'Remotion_video_controller/getEditorList';
 $route['get-title']                                    = $user_folder . 'Remotion_video_controller/gettitle';
 $route['get-editor-draft-list']                        = $user_folder . 'Remotion_video_controller/getEditorDraftList';
 $route['soft-delete']                                  = $user_folder . 'Remotion_video_controller/deleteAvatarVideo';
 $route['delete-editor-video']                          = $user_folder . 'Remotion_video_controller/deleteRenderVideo';
 $route['addworkspace-video']                           = $user_folder . 'Remotion_video_controller/addworkspaceVideo';
 $route['get-getAvatarImage']                           = $user_folder . 'Remotion_video_controller/getAvatarImage';
 $route['get-all-audio']                                = $user_folder . 'Remotion_video_controller/getAllAudios';
 $route['get-avtar-script']                             = $user_folder . 'Remotion_video_controller/getScript';
 $route['generate-avatar-video']                        = $user_folder . 'Remotion_video_controller/generateAvatarVideo';
 $route['get-generated-avatar-video']                   = $user_folder . 'Remotion_video_controller/getGeneratedAvatarVideo';
 $route['default-template']                             = $user_folder . 'Remotion_video_controller/default_template';
 $route['get-template-list']                            = $user_folder . 'Remotion_video_controller/get_default_template';
 $route['goto-editor']                                  = $user_folder . 'Remotion_video_controller/gotoEditor';
 //$route['video-editor-list']                            = $user_folder . 'Remotion_video_controller/videoEditorList';
 $route['insert-avatar']                                = $user_folder . 'Remotion_video_controller/insertAllAvatars';
 $route['Remotion-video/updateFav-status']              = $user_folder . 'Remotion_video_controller/updateFavStatus';
 $route['get-favvideoList']                             = $user_folder . 'Remotion_video_controller/getfavVideoList';
 $route['count']                                        = $user_folder . 'Remotion_video_controller/count_check';
 $route['addvideo-workspace']                           = $user_folder . 'Remotion_video_controller/addvideotoworkspace';
 $route['update-title']                                 = $user_folder . 'Remotion_video_controller/updateavatartitle';
 $route['avatar-Fav-status']                            = $user_folder . 'Remotion_video_controller/AvatarFavStatuschange';
 $route['remove-avatar']                                = $user_folder . 'Remotion_video_controller/delete_avatar';
 $route['create-video']                                 = $user_folder . 'Remotion_video_controller/createVideo';
 $route['generate-idea']                                 = $user_folder . 'Remotion_video_controller/generate_idea';
 $route['generate-script']                                 = $user_folder . 'Remotion_video_controller/generate_script';
 
 
 
 
 $route['agency-product']                               = $user_folder . 'Settings_controller/agency_product';

//** remotion video editor route by mahesh end *// 

/* avtar create routes start*/
 $route['avtar-create']                   = $user_folder . 'Remotion_video_controller/avatarList';
 $route['avatar']                   = $user_folder . 'Remotion_video_controller/getHeygenAvatar';
 $route['upload_audioFile']                   = $user_folder . 'Remotion_video_controller/uploadAudioFile';
 
 
 
 
 
 $route['upload-avatar-video']                   = $user_folder . 'Remotion_video_controller/Upload_avtar_video';
 $route['upload-video-direct']                   = $user_folder . 'Remotion_video_controller/upload_video_direct';
 
$route['video/ylists'] = $user_folder . 'Youtube/ylists';

$route['analyze-video'] = $user_folder . 'Youtube/analyzeVideo';




$route['youtube'] = $user_folder . 'Youtube/index';
$route['save-youtube-integration'] = $user_folder . 'Youtube/save_youtube_integration';
$route['youtube_list'] = $user_folder . 'Youtube/youtube_list';
$route['youtube/get_videos_json'] = $user_folder . 'Youtube/get_videos_json';
$route['uploadYoutube/(:any)'] = $user_folder . 'Youtube/uploadData/$1';
$route['youtube/uploadData'] = $user_folder . 'Youtube/uploadData';

$route['youtube/videoComment'] = $user_folder . 'Youtube/videoComment';
$route['youtube/videolike'] = $user_folder . 'Youtube/videolike';
$route['youtube/all_list'] = $user_folder . 'Youtube/all_list';
$route['youtube/all_videos'] = $user_folder . 'Youtube/all_videos';
$route['youtube/getVideoDetails'] = $user_folder . 'Youtube/getVideoDetails';
$route['youtube/getComments'] = $user_folder . 'Youtube/getComments';
$route['youtube/getLastComments'] = $user_folder . 'Youtube/getLastComments';
$route['youtube/postComment'] = $user_folder . 'Youtube/postComment';
$route['youtube/likeVideo'] = $user_folder . 'Youtube/likeVideo';
$route['youtube/subscribe'] = $user_folder . 'Youtube/subscribeChannal';


$route['youtube-v2-list'] = $user_folder . 'Youtube/youtube_list';
$route['youtube-v2-auto-comment'] = $user_folder . 'Youtube/youtube_list';
$route['insert-v2-reply'] = $user_folder . 'Youtube/insert_v2_reply';
$route['insert-v2-comment'] = $user_folder . 'Youtube/insertAutoComment';
$route['youtube-v2-update/(:any)'] = $user_folder . 'Youtube/updateCommentData/$1';
$route['crone-youtube-reply'] = $user_folder . 'Crone_youtube_controller/index';
$route['crone-youtube-comments'] = $user_folder . 'Crone_youtube_controller/runAutoComments';
// $route['test_process_reply'] = $user_folder . 'Youtube/test_process_reply';
$route['delelte-youtube-video'] = $user_folder . 'Youtube/processDeleteVideo';

// $route['test_process_comment'] = $user_folder . 'Youtube/testAutoComment';
$route['youtube-publisher'] = $user_folder . 'Youtube/publishYoutube';
$route['upload-youtube-video'] = $user_folder . 'Youtube/youtubeUpload';
$route['editor-action'] = $user_folder . 'Youtube/edtiorActions';
$route['make-better-prompt'] = $user_folder . 'Youtube/makeBetterPrompt';

$route['upload-own-video'] = $user_folder . 'Youtube/uploadOwnVideo';


$route['insert-chating'] = $user_folder . 'Youtube/thumbnailChat';
$route['get-chat'] = $user_folder . 'Youtube/getChat';
$route['insert-youtube-video'] = $user_folder . 'Youtube/insertYoutubePublisher';

$route['get-channel-info'] = $user_folder . 'Youtube/processReplyAutomation';
$route['youtube-resetapi'] = $user_folder . 'Youtube/resetYoutubeAPI';
$route['youtube/update_optimized_metadata'] = $user_folder . 'Youtube/update_optimized_metadata';
$route['youtube/get-connected-channel-overview'] = $user_folder . 'Youtube/get_connected_channel_overview';
$route['youtube/get_yt_channels_list'] = $user_folder . 'Youtube/get_yt_channels_list';

/*mahesh talking tails routes start*/
 $route['story-create']                   = $user_folder . 'Story_video_controller/avatarList';
 
 
 
/*one prompt automation routes start*/ 
$route['smart-generator']           = $user_folder . 'AutoPost_Controller/smartGenerator';
$route['auto-post-generator']       = $user_folder . 'AutoPost_Controller/generatePost';
$route['post-generator']            = $user_folder . 'AutoPost_Controller/postGenerator';
$route['ai-avatars-video']          = $user_folder . 'AutoPost_Controller/getAiAvatarVideo';
$route['get_video_history']          = $user_folder . 'AutoPost_Controller/getVideoHistory';
$route['get_avatar_video_history']          = $user_folder . 'AutoPost_Controller/getAvatarVideoHistory';
$route['delete_history_video']      = $user_folder . 'AutoPost_Controller/deleteHistoryVideo';
$route['get-video-id']              = $user_folder . 'AutoPost_Controller/get_video_id';
$route['get-compelete-video']       = $user_folder . 'AutoPost_Controller/getCompeleteVideobyid';
$route['post-social-media']         = $user_folder . 'AutoPost_Controller/socialmedia_post';
$route['get-dupdub-videobyid']      = $user_folder . 'AutoPost_Controller/fetchDupDubVideoAndSave';
$route['db-post-data']              = $user_folder . 'AutoPost_Controller/sendpromt';
$route['fetch-video']              = $user_folder . 'AutoPost_Controller/fetch_video';

$route['pwa-install']              = $user_folder . 'AppView_controller/pwaInstall';
$route['pwa-conversation']          = $user_folder . 'AppView_controller/pwaConversation';
$route['pwa-auto-post-generator']   = $user_folder . 'AppView_controller/generatePost'; 
$route['pwa-get-compelete-video']       = $user_folder . 'AppView_controller/getCompeleteVideobyid';
$route['pwa-get-video-id']              = $user_folder . 'AppView_controller/get_video_id';
$route['pwa-post-social-media']         = $user_folder . 'AppView_controller/socialmedia_post';



$route['get-telegram-integration'] = $user_folder . 'AutoPost_Controller/getTelegramIntegration';
 

/*Instagram automation routes start*/ 

$route['automation']                    = $user_folder . 'Instavideo_controller/automation';
$route['save-insta-access-token']       = $user_folder . 'Instavideo_controller/save_insta_access_token';
$route['reset-insta-api']               = $user_folder . 'Instavideo_controller/delete_insta_access_token';

$route['generate-hastag']               = $user_folder . 'Instavideo_controller/generate_hastag';

$route['upload-insta-video']            = $user_folder . 'Instavideo_controller/publish_video';
$route['upload-reel']                   = $user_folder . 'Instavideo_controller/upload_reel';
$route['upload-reel-video']             = $user_folder . 'Instavideo_controller/upload_reel_video';

$route['insta-auto-reply']              = $user_folder . 'Instavideo_controller/insta_auto_reply';
$route['get-comments']                  = $user_folder . 'Instavideo_controller/get_comments';
$route['get-insta-data']                = $user_folder . 'Instavideo_controller/get_insta_data';
$route['get-instavideo-data']           = $user_folder . 'Instavideo_controller/get_instavideo_data';
$route['get-schedule-video']            = $user_folder . 'Instavideo_controller/get_schedule_video';
$route['delete-schedule-video']         = $user_folder . 'Instavideo_controller/delete_schedule_video';
$route['save-insta-reply-automation']   = $user_folder . 'Instavideo_controller/save_insta_reply_automation';

$route['insta-publisher']               = $user_folder . 'Instavideo_controller/insta_publisher';
$route['get-insights']                  = $user_folder . 'Instavideo_controller/get_insights';
$route['delete-insta-video']            = $user_folder . 'Instavideo_controller/instaVideoDelete';
$route['search-hastag']                 = $user_folder . 'Instavideo_controller/ig_hashtag_search';
$route['generate-caption']              = $user_folder . 'Instavideo_controller/generate_caption';

$route['get-access-token']              = $user_folder . 'Crone_insta_controller/get_access_token';
$route['reply-insta-automation']        = $user_folder . 'Crone_insta_controller/replyInstaAutomation';
$route['insta-auto-post']               = $user_folder . 'Crone_insta_controller/schedule_auto_post';


/*Face-Book automation routes start*/ 
$route['save-facebook-access-token']    = $user_folder . 'Facebook_controller/save_fb_access_token';
$route['reset-facebook-api']            = $user_folder . 'Facebook_controller/delete_fb_access_token';
$route['facebook-video']                = $user_folder . 'Facebook_controller/fb_publish_video';
$route['fb-post-video']                 = $user_folder . 'Facebook_controller/fb_post_video';
$route['facebook-publisher']            = $user_folder . 'Facebook_controller/facebook_publisher';
$route['get-fb-data']                   = $user_folder . 'Facebook_controller/get_posts';
$route['get-fb-insights']               = $user_folder . 'Facebook_controller/get_fb_insights';
$route['facebook-auto-reply']           = $user_folder . 'Facebook_controller/facebook_auto_reply';
$route['save-fb-reply-automation']      = $user_folder . 'Facebook_controller/save_fb_reply_automation';
$route['get-fb-schedule-video']         = $user_folder . 'Facebook_controller/get_fb_schedule_video';
$route['delete-fb-schedule-video']      = $user_folder . 'Facebook_controller/delete_fb_schedule_video';
$route['fb-video-count']                = $user_folder . 'Facebook_controller/fb_video_count';

$route['facebook-reply-automation']     = $user_folder . 'Crone_fb_controller/facebookreplyAutomation';
$route['facebook-auto-post']            = $user_folder . 'Crone_fb_controller/facebook_schedule_auto_post';

$route['analyz']                        = $user_folder . 'AnalyzeVideo_controller/analyz';
$route['send-id']                        = $user_folder . 'AnalyzeVideo_controller/send_id';
$route['send-url']                        = $user_folder . 'AnalyzeVideo_controller/sendurl';
$route['video-analyzer']                = $user_folder . 'AnalyzeVideo_controller/videoanalyzer';
$route['analyze-video']                 = $user_folder . 'AnalyzeVideo_controller/analyzeVideo';
$route['get-analyz-data']               = $user_folder . 'AnalyzeVideo_controller/get_analyz_data';
$route['analyz-data']                   = $user_folder . 'AnalyzeVideo_controller/analyz_data';
$route['get-all-analyz-data']           = $user_folder . 'AnalyzeVideo_controller/get_all_analyz_data';
$route['delete-analyz-data']            = $user_folder . 'AnalyzeVideo_controller/delete_analyz_data';
$route['update-video-title']            = $user_folder . 'AnalyzeVideo_controller/update_title';
$route['lead-finder']                   = $user_folder . 'AnalyzeVideo_controller/lead_finder';
$route['find-channel']                  = $user_folder . 'AnalyzeVideo_controller/search_channels';
$route['image-analyze']                 = $user_folder . 'AnalyzeVideo_controller/image_analyze';
$route['save-channel']                  = $user_folder . 'AnalyzeVideo_controller/save_channel';
$route['get-channel-data']              = $user_folder . 'AnalyzeVideo_controller/get_channel_data';
$route['delete-channel-data']           = $user_folder . 'AnalyzeVideo_controller/delete_channel_data';
$route['youtube-grow']                  = $user_folder . 'AnalyzeVideo_controller/youtubeGrow';


$route['optimize-data/(:any)']          = $user_folder . 'AnalyzeVideo_controller/optimize_data/$1';
$route['optimize-with-ai']              = $user_folder . 'AnalyzeVideo_controller/optimizeWithAI';
$route['ai-query']                      = $user_folder . 'AnalyzeVideo_controller/ai_query';
$route['ai-generateQuery']              = $user_folder . 'AnalyzeVideo_controller/generateQuery';


$route['competitor-spy']                = $user_folder . 'Comparison_controller/competitor_spy';
$route['competitor-spy-analyze']        = $user_folder . 'Comparison_controller/competitorSpyAnalyze';
$route['export-competitor-pdf']         = $user_folder . 'Comparison_controller/export_pdf_report'; 
$route['export-video-analysis-pdf']     = $user_folder . 'Comparison_controller/export_video_analysis_pdf';
$route['export-optimizer-report-pdf']   = $user_folder . 'Comparison_controller/export_optimizer_report_pdf';
$route['export-ai-queries-pdf']         = $user_folder . 'Comparison_controller/export_ai_queries_pdf';

// ------------------------------------------------------------//
$route['yt-audio'] = $user_folder . 'Youtube_optimisation/getVoices';
$route['yt-video-op'] = $user_folder . 'Youtube_optimisation/yt_video_optimization';


$route['ai-video-genration'] = $user_folder . 'Youtube_Controller/ai_video_genration';
$route['ai-video-gen-process'] = $user_folder . 'AutoPost_Controller/ai_video_process';
$route['ai-uploadYoutube/(:num)'] = $user_folder . 'AutoPost_Controller/publishJob/$1';
$route['check-video-status'] = $user_folder . 'AutoPost_Controller/check_video_status';
$route['ai_video/checkVideoStatus/(:num)'] = $user_folder . 'AutoPost_Controller/checkVideoStatus/$1'; 

//-----------------------Telegram By AMAN----------------------------------//
// $route['get-telegram-integration'] = $user_folder. 'Telegram/get_telegram_integration';
// For connecting Telegram (Angular call)
$route['telegram-webhook'] = $user_folder . 'Telegram/telegram_webhook';

// For Telegram incoming messages
$route['telegram/webhook/(:any)'] = $user_folder . 'Telegram/webhook/$1';
$route['telegram-video-check'] = $user_folder . 'Telegram_Cron/check_telegram_video_process';
$route['telegram-reset'] = $user_folder . 'Telegram/telegram_reset';

// ---------------------WAHA WhatsApp By AMAN------------------------------------//

$route['whatsapp-channel-session'] =$user_folder . 'Telegram/whatssapp_session_check';

$route['whatsapp-webhook-waha'] =  $user_folder . 'Telegram/waha_whatssapp_webhook';


$route['check-youtube-connection']= $user_folder .'Youtube_optimisation/checkYoutubeConnection';
$route['update-youtube-video']     =$user_folder.'Youtube_optimisation/updateYoutubeVideo';
$route['user-list']     =$user_folder.'UserController/getUserData';