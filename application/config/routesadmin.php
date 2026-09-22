<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
/*
adminName = 'BMS';
adminFolderName = 'businessPanel';
*/

$route['default_controller'] = config_item('adminFolderName')."/dashboard";
$route['404_override'] = 'dashboard/error404';
$route['scaffolding_trigger'] = "";
$route[config_item('adminName').'/(\w{2})/(.*)'] = '$2';
$route[config_item('adminName').'/(\w{2})'] = $route['default_controller']; 

$route[config_item('adminName')] = config_item('adminFolderName')."/dashboard";
$route[config_item('adminName').'/access-denied'] = config_item('adminFolderName')."/dashboard/accessDenied";
$route[config_item('adminName').'/login'] = config_item('adminFolderName')."/login/index";
$route[config_item('adminName').'/logout'] = config_item('adminFolderName')."/login/logout";

/* ------------------User manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-users'] = config_item('adminFolderName')."/users/index";
$route[config_item('adminName').'/create-user'] = config_item('adminFolderName')."/users/createUser";
$route[config_item('adminName').'/view-user'] = config_item('adminFolderName')."/users/view";
$route[config_item('adminName').'/add-user-plan'] = config_item('adminFolderName')."/users/addUserPlan";
$route[config_item('adminName').'/update-user-plan'] = config_item('adminFolderName')."/users/updateUserPlan";
$route[config_item('adminName').'/add-user-product'] = config_item('adminFolderName')."/users/addUserProduct";
$route[config_item('adminName').'/update-user-product'] = config_item('adminFolderName')."/users/updateUserProduct";
$route[config_item('adminName').'/reset-user-password'] = config_item('adminFolderName')."/users/resetPassword";
$route[config_item('adminName').'/login-user/(:num)'] = config_item('adminFolderName')."/users/loginUser/$1";
$route[config_item('adminName').'/edit-user/(:num)'] = config_item('adminFolderName')."/users/editUser/$1";
$route[config_item('adminName').'/delete-user/(:num)'] = config_item('adminFolderName')."/users/deleteUser/$1";
$route[config_item('adminName').'/change-user-status/(:any)/(:num)'] = config_item('adminFolderName')."/users/changeStatus/$1/$2";
/* ------------------User manager ends -------------------------------------------*/


/* ------------------Email Template manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-email-template'] = config_item('adminFolderName')."/email_template/index";
$route[config_item('adminName').'/create-email-template'] = config_item('adminFolderName')."/email_template/create";
$route[config_item('adminName').'/view-email-template'] = config_item('adminFolderName')."/email_template/view";
$route[config_item('adminName').'/edit-email-template/(:num)'] = config_item('adminFolderName')."/email_template/edit/$1";
$route[config_item('adminName').'/delete-email-template/(:num)'] = config_item('adminFolderName')."/email_template/delete/$1";
$route[config_item('adminName').'/change-email-template-status/(:any)/(:num)'] = config_item('adminFolderName')."/email_template/changeStatus/$1/$2";
/* ------------------Email Template manager ends -------------------------------------------*/

/* ------------------Training Video manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-training-videos'] = config_item('adminFolderName')."/training_videos/index";
$route[config_item('adminName').'/create-training-videos'] = config_item('adminFolderName')."/training_videos/create";
$route[config_item('adminName').'/view-training-videos'] = config_item('adminFolderName')."/training_videos/view";
$route[config_item('adminName').'/edit-training-videos/(:num)'] = config_item('adminFolderName')."/training_videos/edit/$1";
$route[config_item('adminName').'/delete-training-videos/(:num)'] = config_item('adminFolderName')."/training_videos/delete/$1";
$route[config_item('adminName').'/change-training-videos-status/(:any)/(:num)'] = config_item('adminFolderName')."/training_videos/changeStatus/$1/$2";
/* ------------------Training Video manager ends -------------------------------------------*/

/* ------------------Training Video Category manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-training-video-category'] = config_item('adminFolderName')."/training_video_category/index";
$route[config_item('adminName').'/create-training-video-category'] = config_item('adminFolderName')."/training_video_category/create";
$route[config_item('adminName').'/view-training-video-category'] = config_item('adminFolderName')."/training_video_category/view";
$route[config_item('adminName').'/edit-training-video-category/(:num)'] = config_item('adminFolderName')."/training_video_category/edit/$1";
$route[config_item('adminName').'/delete-training-video-category/(:num)'] = config_item('adminFolderName')."/training_video_category/delete/$1";
$route[config_item('adminName').'/change-training-video-category-status/(:any)/(:num)'] = config_item('adminFolderName')."/training_video_category/changeStatus/$1/$2";
/* ------------------Training Video Category manager ends -------------------------------------------*/


/* ------------------Training Pdf manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-training-pdf'] = config_item('adminFolderName')."/training_pdf/index";
$route[config_item('adminName').'/create-training-pdf'] = config_item('adminFolderName')."/training_pdf/create";
$route[config_item('adminName').'/view-training-pdf'] = config_item('adminFolderName')."/training_pdf/view";
$route[config_item('adminName').'/edit-training-pdf/(:num)'] = config_item('adminFolderName')."/training_pdf/edit/$1";
$route[config_item('adminName').'/delete-training-pdf/(:num)'] = config_item('adminFolderName')."/training_pdf/delete/$1";
$route[config_item('adminName').'/change-training-pdf-status/(:any)/(:num)'] = config_item('adminFolderName')."/training_pdf/changeStatus/$1/$2";
/* ------------------Training Pdf manager ends -------------------------------------------*/

/* ------------------Training Pdf Category manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-training-pdf-category'] = config_item('adminFolderName')."/training_pdf_category/index";
$route[config_item('adminName').'/create-training-pdf-category'] = config_item('adminFolderName')."/training_pdf_category/create";
$route[config_item('adminName').'/view-training-pdf-category'] = config_item('adminFolderName')."/training_pdf_category/view";
$route[config_item('adminName').'/edit-training-pdf-category/(:num)'] = config_item('adminFolderName')."/training_pdf_category/edit/$1";
$route[config_item('adminName').'/delete-training-pdf-category/(:num)'] = config_item('adminFolderName')."/training_pdf_category/delete/$1";
$route[config_item('adminName').'/change-training-pdf-category-status/(:any)/(:num)'] = config_item('adminFolderName')."/training_pdf_category/changeStatus/$1/$2";
/* ------------------Training Pdf Category manager ends -------------------------------------------*/



/* ------------------FAQ Category manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-faq-category'] = config_item('adminFolderName')."/faq_category/index";
$route[config_item('adminName').'/create-faq-category'] = config_item('adminFolderName')."/faq_category/create";
$route[config_item('adminName').'/view-faq-category'] = config_item('adminFolderName')."/faq_category/view";
$route[config_item('adminName').'/edit-faq-category/(:num)'] = config_item('adminFolderName')."/faq_category/edit/$1";
$route[config_item('adminName').'/delete-faq-category/(:num)'] = config_item('adminFolderName')."/faq_category/delete/$1";
$route[config_item('adminName').'/change-faq-category-status/(:any)/(:num)'] = config_item('adminFolderName')."/faq_category/changeStatus/$1/$2";


/* ------------------FAQ Category manager ends -------------------------------------------*/

/* ------------------FAQ manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-faq'] = config_item('adminFolderName')."/faq/index";
$route[config_item('adminName').'/create-faq'] = config_item('adminFolderName')."/faq/create";
$route[config_item('adminName').'/view-faq'] = config_item('adminFolderName')."/faq/view";
$route[config_item('adminName').'/edit-faq/(:num)'] = config_item('adminFolderName')."/faq/edit/$1";
$route[config_item('adminName').'/delete-faq/(:num)'] = config_item('adminFolderName')."/faq/delete/$1";
$route[config_item('adminName').'/change-faq-status/(:any)/(:num)'] = config_item('adminFolderName')."/faq/changeStatus/$1/$2";
/* ------------------FAQ manager ends -------------------------------------------*/

/* ------------------Update Log manager starts -------------------------------------------*/
$route[config_item('adminName').'/update-log-version'] = config_item('adminFolderName')."/updates_category/index";
$route[config_item('adminName').'/create-update-log-version'] = config_item('adminFolderName')."/updates_category/create";
$route[config_item('adminName').'/view-update-log-version'] = config_item('adminFolderName')."/updates_category/view";
$route[config_item('adminName').'/edit-update-log-version/(:num)'] = config_item('adminFolderName')."/updates_category/edit/$1";
$route[config_item('adminName').'/delete-update-log-version/(:num)'] = config_item('adminFolderName')."/updates_category/delete/$1";
$route[config_item('adminName').'/change-update-log-version-status/(:any)/(:num)'] = config_item('adminFolderName')."/updates_category/changeStatus/$1/$2";

/* ------------------Update Log manager ends -------------------------------------------*/


/* ------------------Update Log manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-log'] = config_item('adminFolderName')."/log/index";
$route[config_item('adminName').'/create-log'] = config_item('adminFolderName')."/log/create";
$route[config_item('adminName').'/view-log'] = config_item('adminFolderName')."/log/view";
$route[config_item('adminName').'/edit-log/(:num)'] = config_item('adminFolderName')."/log/edit/$1";
$route[config_item('adminName').'/delete-log/(:num)'] = config_item('adminFolderName')."/log/delete/$1";
$route[config_item('adminName').'/change-log-status/(:any)/(:num)'] = config_item('adminFolderName')."/log/changeStatus/$1/$2";


/* ------------------Update Log  manager ends -------------------------------------------*/


/* ------------------Bonus Category manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-bonus-category'] = config_item('adminFolderName')."/bonus_category/index";
$route[config_item('adminName').'/create-bonus-category'] = config_item('adminFolderName')."/bonus_category/create";
$route[config_item('adminName').'/view-bonus-category'] = config_item('adminFolderName')."/bonus_category/view";
$route[config_item('adminName').'/edit-bonus-category/(:num)'] = config_item('adminFolderName')."/bonus_category/edit/$1";
$route[config_item('adminName').'/delete-bonus-category/(:num)'] = config_item('adminFolderName')."/bonus_category/delete/$1";
$route[config_item('adminName').'/change-bonus-category-status/(:any)/(:num)'] = config_item('adminFolderName')."/bonus_category/changeStatus/$1/$2";
/* ------------------Bonus Category manager ends -------------------------------------------*/

/* ------------------Bonus manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-bonus'] = config_item('adminFolderName')."/bonus/index";
$route[config_item('adminName').'/create-bonus'] = config_item('adminFolderName')."/bonus/create";
$route[config_item('adminName').'/view-bonus'] = config_item('adminFolderName')."/bonus/view";
$route[config_item('adminName').'/edit-bonus/(:num)'] = config_item('adminFolderName')."/bonus/edit/$1";
$route[config_item('adminName').'/delete-bonus/(:num)'] = config_item('adminFolderName')."/bonus/delete/$1";
$route[config_item('adminName').'/change-bonus-status/(:any)/(:num)'] = config_item('adminFolderName')."/bonus/changeStatus/$1/$2";
/* ------------------Bonuso manager ends -------------------------------------------*/



/* ------------------Business manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-business'] = config_item('adminFolderName')."/business/index";
$route[config_item('adminName').'/create-business'] = config_item('adminFolderName')."/business/createBusiness";
$route[config_item('adminName').'/view-business'] = config_item('adminFolderName')."/business/view";
$route[config_item('adminName').'/edit-business/(:num)'] = config_item('adminFolderName')."/business/editBusiness/$1";
$route[config_item('adminName').'/delete-business/(:num)'] = config_item('adminFolderName')."/business/deleteBusiness/$1";
$route[config_item('adminName').'/change-business-status/(:any)/(:num)'] = config_item('adminFolderName')."/business/changeStatus/$1/$2";
/* ------------------Business manager ends -------------------------------------------*/


/* ------------------Team manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-team'] = config_item('adminFolderName')."/team/index";
$route[config_item('adminName').'/create-team-member'] = config_item('adminFolderName')."/team/createTeam";
$route[config_item('adminName').'/edit-team/(:num)'] = config_item('adminFolderName')."/team/editTeam/$1";
$route[config_item('adminName').'/view-team'] = config_item('adminFolderName')."/team/view";
$route[config_item('adminName').'/delete-team/(:num)'] = config_item('adminFolderName')."/team/deleteTeam/$1";
$route[config_item('adminName').'/change-team-status/(:any)/(:num)'] = config_item('adminFolderName')."/team/changeStatus/$1/$2";
$route[config_item('adminName').'/team/change-password'] = config_item('adminFolderName')."/team/changePassword";
$route[config_item('adminName').'/team-web-logs'] = config_item('adminFolderName')."/team/webLogs";
$route[config_item('adminName').'/team-web-logs-clear'] = config_item('adminFolderName')."/team/clearweblog";
/* ------------------Team manager ends -------------------------------------------*/


/* ------------------Package manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-packages'] = config_item('adminFolderName')."/package/index";
$route[config_item('adminName').'/create-package'] = config_item('adminFolderName')."/package/createPackage";
$route[config_item('adminName').'/view-package'] = config_item('adminFolderName')."/package/view";
$route[config_item('adminName').'/edit-package/(:num)'] = config_item('adminFolderName')."/package/editPackage/$1";
$route[config_item('adminName').'/delete-package/(:num)'] = config_item('adminFolderName')."/package/deletePackage/$1";
$route[config_item('adminName').'/change-package-status/(:any)/(:num)'] = config_item('adminFolderName')."/package/changeStatus/$1/$2";
$route[config_item('adminName').'/get-app-fields'] = config_item('adminFolderName')."/package/getAppFields";
/* ------------------Package manager ends -------------------------------------------*/


/* ------------------Package field manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-package-fields'] = config_item('adminFolderName')."/package_fields/index";
$route[config_item('adminName').'/create-package-field'] = config_item('adminFolderName')."/package_fields/create";
$route[config_item('adminName').'/edit-package-field/(:num)'] = config_item('adminFolderName')."/package_fields/edit/$1";
$route[config_item('adminName').'/delete-package-field/(:num)'] = config_item('adminFolderName')."/package_fields/deleteRecord/$1";
$route[config_item('adminName').'/change-package-field-status/(:any)/(:num)'] = config_item('adminFolderName')."/package_fields/changeStatus/$1/$2";
/* ------------------Package field manager ends -------------------------------------------*/


/* ------------------Feature manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-features'] = config_item('adminFolderName')."/features/index";
$route[config_item('adminName').'/create-feature'] = config_item('adminFolderName')."/features/create";
$route[config_item('adminName').'/edit-feature/(:num)'] = config_item('adminFolderName')."/features/edit/$1";
$route[config_item('adminName').'/delete-feature/(:num)'] = config_item('adminFolderName')."/features/deleteRecord/$1";
$route[config_item('adminName').'/change-feature-status/(:any)/(:num)'] = config_item('adminFolderName')."/features/changeStatus/$1/$2";
/* ------------------Feature manager ends -------------------------------------------*/


/* ------------------Package field manager starts -------------------------------------------*/
$route[config_item('adminName').'/manage-feature-plans'] = config_item('adminFolderName')."/feature_plans/index";
$route[config_item('adminName').'/create-feature-plan'] = config_item('adminFolderName')."/feature_plans/create";
$route[config_item('adminName').'/edit-feature-plan/(:num)'] = config_item('adminFolderName')."/feature_plans/edit/$1";
$route[config_item('adminName').'/delete-feature-plan/(:num)'] = config_item('adminFolderName')."/feature_plans/deleteRecord/$1";
$route[config_item('adminName').'/change-feature-plan-status/(:any)/(:num)'] = config_item('adminFolderName')."/feature_plans/changeStatus/$1/$2";
/* ------------------Package field manager ends -------------------------------------------*/

/* ------------------Package order manager starts -------------------------------------------*/
$route[config_item('adminName').'/package-orders'] = config_item('adminFolderName')."/package_order/index";
/* ------------------Package order manager ends -------------------------------------------*/

/* ------------------Package transaction manager starts -------------------------------------------*/
$route[config_item('adminName').'/package-transactions'] = config_item('adminFolderName')."/package_transaction/index";
/* ------------------Package transaction manager ends -------------------------------------------*/

/* ------------------Package purchase manager starts -------------------------------------------*/
$route[config_item('adminName').'/purchased-package'] = config_item('adminFolderName')."/package_purchase/index";
$route[config_item('adminName').'/change-purchase-package-status/(:any)/(:num)'] = config_item('adminFolderName')."/package_purchase/changeStatus/$1/$2";
/* ------------------Package purchase manager ends -------------------------------------------*/

/* ------------------Auto Responder field manager starts (by VKC)-------------------------------------------*/
$route[config_item('adminName').'/create-autoresponder'] = config_item('adminFolderName')."/autoresponder/create";
$route[config_item('adminName').'/manage-autoresponder'] = config_item('adminFolderName')."/autoresponder";
$route[config_item('adminName').'/change-autoresponder-status/(:any)/(:num)'] = config_item('adminFolderName')."/autoresponder/changeStatus/$1/$2";
$route[config_item('adminName').'/delete-autoresponder/(:num)'] = config_item('adminFolderName')."/autoresponder/deleteRecord/$1";
$route[config_item('adminName').'/view-autoresponder'] = config_item('adminFolderName')."/autoresponder/viewRecord";
$route[config_item('adminName').'/edit-autoresponder/(:num)'] = config_item('adminFolderName')."/autoresponder/edit/$1";
/* ------------------Auto Responder field manager ends -------------------------------------------*/

/* ------------------Social Responder field manager starts (by VKC)-------------------------------------------*/
$route[config_item('adminName').'/create-socialresponder'] = config_item('adminFolderName')."/socialresponder/create";
$route[config_item('adminName').'/manage-socialresponder'] = config_item('adminFolderName')."/socialresponder";
$route[config_item('adminName').'/change-socialresponder-status/(:any)/(:num)'] = config_item('adminFolderName')."/socialresponder/changeStatus/$1/$2";
$route[config_item('adminName').'/delete-socialresponder/(:num)'] = config_item('adminFolderName')."/socialresponder/deleteRecord/$1";
$route[config_item('adminName').'/view-socialresponder'] = config_item('adminFolderName')."/socialresponder/viewRecord";
$route[config_item('adminName').'/edit-socialresponder/(:num)'] = config_item('adminFolderName')."/socialresponder/editRecord/$1";
/* ------------------Social Responder field manager ends -------------------------------------------*/

/* -------------------------------- Template Manager Start -------------------------------------------------------*/
$route[config_item('adminName').'/manage-template-manager'] = config_item('adminFolderName')."/template_manager/index";
$route[config_item('adminName').'/create-template'] = config_item('adminFolderName')."/template_manager/create";
$route[config_item('adminName').'/view-template-manager'] = config_item('adminFolderName')."/template_manager/view";
$route[config_item('adminName').'/edit-template-manager/(:num)'] = config_item('adminFolderName')."/template_manager/edit/$1";
$route[config_item('adminName').'/delete-template-manager/(:num)'] = config_item('adminFolderName')."/template_manager/delete/$1";
$route[config_item('adminName').'/change-template-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/template_manager/changeStatus/$1/$2";
/* ------------------ Template Manager End --------------------------------------------------------------------------*/


//17/2/18  Anurag
/* -------------------------------- Page Manager Start -------------------------------------------------------*/
$route[config_item('adminName').'/manage-page-templates'] = config_item('adminFolderName')."/Page_manager/index";
$route[config_item('adminName').'/add-page-templates'] = config_item('adminFolderName')."/Page_manager/create";
$route[config_item('adminName').'/view-page-manager'] = config_item('adminFolderName')."/Page_manager/view";
$route[config_item('adminName').'/edit-page-manager/(:num)'] = config_item('adminFolderName')."/Page_manager/edit/$1";
$route[config_item('adminName').'/delete-page-manager/(:num)'] = config_item('adminFolderName')."/Page_manager/delete/$1";
$route[config_item('adminName').'/change-page-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/Page_manager/changeStatus/$1/$2";
/* ------------------ Page Manager End --------------------------------------------------------------------------*/

//17/2/18




/* -------------------------------- Form template Manager Start ----------------------*/
$route[config_item('adminName').'/manage-form-templates'] = config_item('adminFolderName')."/Form_template_manager/index";
$route[config_item('adminName').'/add-form-templates'] = config_item('adminFolderName')."/Form_template_manager/create";
$route[config_item('adminName').'/view-form-manager'] = config_item('adminFolderName')."/form_template_manager/view";
$route[config_item('adminName').'/edit-form-manager/(:num)'] = config_item('adminFolderName')."/form_template_manager/edit/$1";
$route[config_item('adminName').'/delete-form-manager/(:num)'] = config_item('adminFolderName')."/form_template_manager/delete/$1";
$route[config_item('adminName').'/change-form-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/form_template_manager/changeStatus/$1/$2";
/* ------------------ Form Template Manager End -----------------------------------------------*/




/*----------------------------------------Socialmozo Start --------------------------------*/
$route[config_item('adminName').'/manage-socialmozo'] = config_item('adminFolderName')."/socialmozo/index";
$route[config_item('adminName').'/create-socialmozo'] = config_item('adminFolderName')."/socialmozo/create";
$route[config_item('adminName').'/view-socialmozo'] = config_item('adminFolderName')."/socialmozo/view";
$route[config_item('adminName').'/edit-socialmozo/(:num)'] = config_item('adminFolderName')."/socialmozo/edit/$1";
$route[config_item('adminName').'/delete-socialmozo/(:num)'] = config_item('adminFolderName')."/socialmozo/delete/$1";
$route[config_item('adminName').'/deleteall-socialmozo'] = config_item('adminFolderName')."/socialmozo/deleteall_social";
$route[config_item('adminName').'/socialmozosearch'] = config_item('adminFolderName')."/socialmozo/socialmozosearch";
$route[config_item('adminName').'/change-socialmozo-status/(:any)/(:num)'] = config_item('adminFolderName')."/socialmozo/changeStatus/$1/$2";


/* ----------------------------------------Socialmozo End -----------------------------------------------------------*/

/* Setting Config Manager Start Jitendra */

$route[config_item('adminName').'/settings'] = config_item('adminFolderName')."/setting_controller/index";
$route[config_item('adminName').'/create-setting'] = config_item('adminFolderName')."/setting_controller/create_setting";
$route[config_item('adminName').'/delete-setting/(:num)'] = config_item('adminFolderName')."/setting_controller/delete/$1";
$route[config_item('adminName').'/edit-setting/(:num)'] = config_item('adminFolderName')."/setting_controller/edit/$1";


/* Setting Config Manager Start*/
/* ------------------Site Settings starts  Jitendra -------------------------------------------*/
$route[config_item('adminName').'/settings/add'] = config_item('adminFolderName')."/settings/add";
$route[config_item('adminName').'/settings/edit/(:num)'] = config_item('adminFolderName')."/settings/edit/$1";
$route[config_item('adminName').'/settings/addoptionaction'] = config_item('adminFolderName')."/settings/addoptionaction/";
$route[config_item('adminName').'/settings/addoptionaction/(:num)'] = config_item('adminFolderName')."/settings/addoptionaction/$1";
$route[config_item('adminName').'/settings/status/(:any)/(:num)'] = config_item('adminFolderName')."/settings/changeStatus/$1/$2";
$route[config_item('adminName').'/settings/all'] = config_item('adminFolderName')."/settings/all";
$route[config_item('adminName').'/settings/delete/(:num)'] = config_item('adminFolderName')."/settings/delete/$1";
$route[config_item('adminName').'/settings/index/(:any)'] = config_item('adminFolderName')."/settings/index/$1";
$route[config_item('adminName').'/settings/editable/(:any)/(:num)'] = config_item('adminFolderName')."/settings/editable/$1/$2";

/* ------------------Site Settings ends  Jitendra -------------------------------------------*/

/* ----------------Sending Server manager starts (by Chirayu)------------------------------*/
$route[config_item('adminName').'/add-sending-server'] = config_item('adminFolderName')."/Sending_server/create";
$route[config_item('adminName').'/manage-sending-server'] = config_item('adminFolderName')."/Sending_server";
$route[config_item('adminName').'/change-sending-server-status/(:any)/(:num)'] = config_item('adminFolderName')."/Sending_server/changeStatus/$1/$2";
$route[config_item('adminName').'/delete-sending-server/(:num)'] = config_item('adminFolderName')."/Sending_server/deleteRecord/$1";
$route[config_item('adminName').'/view-sending-server'] = config_item('adminFolderName')."/Sending_server/viewRecord";
$route[config_item('adminName').'/edit-sending-server/(:num)'] = config_item('adminFolderName')."/Sending_server/edit/$1";
/* -----------------Sending Server manager ends -------------------------------------------*/



/* -------------------------------- Product Manager Start -------------------------------------------------------*/
$route[config_item('adminName').'/manage-product-manager'] = config_item('adminFolderName')."/product_manager/index";
$route[config_item('adminName').'/create-product'] = config_item('adminFolderName')."/product_manager/create";
$route[config_item('adminName').'/view-product-manager'] = config_item('adminFolderName')."/product_manager/view";
$route[config_item('adminName').'/edit-product-manager/(:num)'] = config_item('adminFolderName')."/product_manager/edit/$1";
$route[config_item('adminName').'/delete-product-manager/(:num)'] = config_item('adminFolderName')."/product_manager/delete/$1";
$route[config_item('adminName').'/change-product-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/product_manager/changeStatus/$1/$2";

$route[config_item('adminName').'/product-sales-pages-setting/(:num)'] = config_item('adminFolderName')."/product_manager/productSalesPagesSetting/$1";

$route[config_item('adminName').'/product-materials-setting/(:num)'] = config_item('adminFolderName')."/product_manager/productMaterialsSetting/$1";
// $route[config_item('adminName').'/product-fe-materials-setting/(:num)'] = config_item('adminFolderName')."/product_manager/productFeMaterialsSetting/$1";
// $route[config_item('adminName').'/product-upsell-materials-setting/(:num)'] = config_item('adminFolderName')."/product_manager/productUpsellMaterialsSetting/$1";



/* -------------------------------- Blog Manager Start -------------------------------------------------------*/
$route[config_item('adminName').'/manage-blog-manager'] = config_item('adminFolderName')."/blog_manager/index";
$route[config_item('adminName').'/create-blog'] = config_item('adminFolderName')."/blog_manager/create";
$route[config_item('adminName').'/view-blog-manager'] = config_item('adminFolderName')."/blog_manager/view";
$route[config_item('adminName').'/edit-blog-manager/(:num)'] = config_item('adminFolderName')."/blog_manager/edit/$1";
$route[config_item('adminName').'/delete-blog-manager/(:num)'] = config_item('adminFolderName')."/blog_manager/delete/$1";
$route[config_item('adminName').'/change-blog-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/blog_manager/changeStatus/$1/$2";

/* -------------------------------- Menu Manager Start -------------------------------------------------------*/
$route[config_item('adminName').'/manage-menu-manager'] = config_item('adminFolderName')."/Menu_manager/index";
$route[config_item('adminName').'/create-menu'] = config_item('adminFolderName')."/Menu_manager/create";
$route[config_item('adminName').'/view-menu-manager'] = config_item('adminFolderName')."/Menu_manager/view";
$route[config_item('adminName').'/edit-menu-manager/(:num)'] = config_item('adminFolderName')."/Menu_manager/edit/$1";
$route[config_item('adminName').'/delete-menu-manager/(:num)'] = config_item('adminFolderName')."/Menu_manager/delete/$1";
$route[config_item('adminName').'/change-menu-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/Menu_manager/changeStatus/$1/$2";
/* -------------------------------- Submenu Manager Start -------------------------------------------------------*/
$route[config_item('adminName').'/manage-submenu-manager'] = config_item('adminFolderName')."/Submenu_manager/index";
$route[config_item('adminName').'/create-submenu'] = config_item('adminFolderName')."/Submenu_manager/create";
$route[config_item('adminName').'/view-submenu-manager'] = config_item('adminFolderName')."/Submenu_manager/view";
$route[config_item('adminName').'/edit-submenu-manager/(:num)'] = config_item('adminFolderName')."/Submenu_manager/edit/$1";
$route[config_item('adminName').'/delete-submenu-manager/(:num)'] = config_item('adminFolderName')."/Submenu_manager/delete/$1";
$route[config_item('adminName').'/change-submenu-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/Submenu_manager/changeStatus/$1/$2";
/* -------------------------------- Default Video Start -------------------------------------------------------*/
$route[config_item('adminName').'/manage-video-manager'] = config_item('adminFolderName')."/Video_manager/index";
$route[config_item('adminName').'/create-video'] = config_item('adminFolderName')."/Video_manager/create";
$route[config_item('adminName').'/view-video-manager'] = config_item('adminFolderName')."/Video_manager/view";
$route[config_item('adminName').'/edit-video-manager/(:num)'] = config_item('adminFolderName')."/Video_manager/edit/$1";
$route[config_item('adminName').'/delete-video-manager/(:num)'] = config_item('adminFolderName')."/Video_manager/deletetemplate/$1";
$route[config_item('adminName').'/change-video-manager-status/(:any)/(:num)'] = config_item('adminFolderName')."/Video_manager/changeStatus/$1/$2";


/*Timer Settings start Mahesh
*/
//$route['timer-settings'] = config_item('adminFolderName')."/Timer_settings/create";
$route[config_item('adminName').'/manage-timer-settings'] = config_item('adminFolderName')."/Timer_settings/index";
//$route['view-timer-manager'] = config_item('adminFolderName')."/Timer_settings/view";
$route[config_item('adminName').'/edit-timer-manager/(:num)'] = config_item('adminFolderName')."/Timer_settings/edit/$1";
$route[config_item('adminName').'/delete-timer-manager/(:num)'] = config_item('adminFolderName')."/Timer_settings/delete/$1";
$route[config_item('adminName').'/change-email-template-status/(:any)/(:num)'] = config_item('adminFolderName')."/Timer_settings/changeStatus/$1/$2"; 
$route[config_item('adminName').'/user-index'] = config_item('adminFolderName')."/UserController/index";
$route[config_item('adminName').'/user-list'] = config_item('adminFolderName')."/UserController/getUserData";
$route[config_item('adminName').'/sag-user-list'] = config_item('adminFolderName')."/UserController/getSagUserData";
 
/*Timer Settings End Mahesh*/

/* $route[config_item('adminName').'/ipn'] = "package/Ipn/index"; */

