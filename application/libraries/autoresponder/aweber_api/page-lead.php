<?php
if(isset($GLOBALS['prof_themename'])){$themename = $GLOBALS['prof_themename'];}
else{$themename = "Graffiti";}
$responder_options= $GLOBALS['prof_lead_options'];
/**
 * Create the options page for Header Settings
 */
function olp_lead() {
	global $responder_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; ?>
        <div class="wrap"><?php 
        require_once("option-menu.php");
		// Lib MailChimp
        require_once("lib/jsonRPCClient.php");
		require_once("lib/MCAPI.class.php"); 
		// Lib for iContact
		require_once('lib/iContactApi.php');
		// Lib for Constant Contact
		//require_once('ConstantContact_api/ConstantContact.php');
		// Lib for Benchmark
		//require_once 'lib/RPC2/Client.php';
		
        //add options for aweber
        add_option('aweber_consumerKey', '');
        add_option('aweber_consumerSecret', '');
        add_option('aweber_accessKey', '');
        add_option('aweber_accessSecret', '');
		//MC Options
		add_option('mc_field_names', '');
		add_option('mc_tag_names', '');
		add_option('mc_type_names', '');
		add_option('mc_fields', ''); 
		$actual_url = urlencode("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); 
		$domain_comp = substr($actual_url, 0, strpos($actual_url, 'wp-admin')); ?>
        <div class="dashboardbox"><?php 
        if ( false !== $_REQUEST['settings-updated'] ) : ?>
            <div class="updated">
                <p><strong><?php _e( 'Options saved', 'olptheme' ); ?></strong></p>
            </div><?php 
        endif; ?>
        <form method="post" action="options.php"><?php 
        settings_fields( 'olp_lead_options' ); 
        $lead_options = get_option( 'olp_theme_lead_options' ); 
        if($_GET['act']=='ResetAweber') {
            update_option('aweber_consumerKey', '');
            update_option('aweber_consumerSecret', '');
            update_option('aweber_accessKey', '');
            update_option('aweber_accessSecret', '');
            update_option($lead_options['aweber_api'], '');
        }
        if($_GET['act']=='ResetCtCt') {
            update_option('_ctct_AccessToken', '');
            update_option('_ctct_LoginUser', '');
        }
        if($_GET['act']=='ResetiCt') {
            update_option('olp_theme_lead_options[iContact_appId]', '');
            update_option('olp_theme_lead_options[iContact_appUser]', '');
            update_option('olp_theme_lead_options[iContact_appPass]', '');
        } ?>
        <div class="tabs-wrapper">
            <div class="tab-body-wrapper">
                <div id="tab-body-1" class="tab-body"> 
                <h3 class="dbheadings"><?php _e( 'Lead Generation Basic Settings', 'olptheme' ); ?></h3>
                <style>
                .button-danger {
                    color:#fff !important; border-radius:0px !important;
                    background-color:#B55858 !important;border:0px !important;outline:0px !important;
                    box-shadow:0px !important;
                }
                .button-danger:hover {
                    color:#fff !important; border-radius:0px !important;
                    background-color:#984747 !important;border:0px !important;outline:0px !important;
                    box-shadow:0px !important;
                }
                .button-danger:focus{border:0px !important;outline:0px !important; box-shadow:none;}
                </style>	
                <script type="text/javascript">
                    $(document).ready(function(){
                        $(".responder").change(function(){
                            $( ".responder option:selected").each(function(){
                                if($(this).attr("value")=="Aweber"){
                                    $(".area").hide();
                                    $(".aweber").show();
                                }
                                if($(this).attr("value")=="Getresponse"){
                                    $(".area").hide();
                                    $(".getresponse").show();
                                }
                                if($(this).attr("value")=="Mailchimp"){
                                    $(".area").hide();
                                    $(".mailchimp").show();
                                }
                                if($(this).attr("value")=="ConstantContact"){
                                    $(".area").hide();
                                    $(".ConstantContact").show();
                                }
                                if($(this).attr("value")=="iContact"){
                                    $(".area").hide();
                                    $(".iContact").show();
                                }
                                if($(this).attr("value")=="Benchmark"){
                                    $(".area").hide();
                                    $(".Benchmark").show();
                                }
                                if($(this).attr("value")=="InstaConsultant"){
                                    $(".area").hide();
                                    $(".InstaConsultant").show();
                                }
                            });
                        }).change();
                    });
                </script><?php
                /**************************
                    Basic Setting Table 
                **************************/ ?>
                <table class="form-table table-responsive">
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Form Headline', 'olptheme' ); ?></th>
                        <td><input id="olp_theme_lead_options[icheadline]" type="text" name="olp_theme_lead_options[icheadline]" value="<?php esc_attr_e( $lead_options['icheadline'] ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Form Sub-Headline', 'olptheme' ); ?></th>
                        <td><input id="olp_theme_lead_options[icsubheadline]" type="text" name="olp_theme_lead_options[icsubheadline]" value="<?php esc_attr_e( $lead_options['icsubheadline'] ); ?>" /></td>
                    </tr>
                    <tr valign="top" style="border-bottom:1px solid #ccc;">
                        <th scope="row"><?php _e( 'Form Button Text', 'olptheme' ); ?></th>
                        <td><input id="olp_theme_lead_options[btntxt]" type="text" name="olp_theme_lead_options[btntxt]" value="<?php esc_attr_e( $lead_options['btntxt'] ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Choose Autoresponder', 'olptheme' ); ?></th>
                        <td><select class="responder" name="olp_theme_lead_options[responder]"><?php
                                $selected = $lead_options['responder'];
                                $p = '';
                                $r = '';
                                foreach ( $responder_options as $options ) {
                                    $label = $options['label'];
                                    if ( $selected == $options['value'] ) // Make default first in list
                                        $p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $options['value'] ) . "'>$label</option>";
                                    else
                                        $r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $options['value'] ) . "'>$label</option>";
                                }
                                echo $p . $r; ?>
                          </select></td>
                    </tr>
                </table>
                <h3 class="dbheadings"><?php _e( 'Lead Generation Advance Settings', 'olptheme' ); ?></h3><?php
                #----------------------------------------
                # "Aweber" Form Setting Start 
                #---------------------------------------- ?>
                <div class="aweber area">
                  <table class="form-table table-responsive"><?php
                    $NSthemename = array('Proficient', 'Proficient-Pro', 'Exquisite', 'Exquisite-Pro');
                    if(in_array($themename, $NSthemename) ) {?>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Aweber HTML Script', 'olptheme' ); ?></th>
                            <td><textarea id="olp_theme_lead_options[awscript]" class="regular-text" name="olp_theme_lead_options[awscript]" rows="4" cols="50" style="width:25em;"><?php esc_attr_e( $lead_options['awscript'] ); ?></textarea></td>
                        </tr><?php
                    } else { ?>
                        <tr valign="top">
                          <th scope="row"><?php _e( 'Authorization Code', 'olptheme' ); ?></th>
                          <td><?php 
                            $aweber_appId = 'fdab3292'; # App ID?>
                            <input id="olp_theme_lead_options[aweber_api]" class="regular-text" type="text" name="olp_theme_lead_options[aweber_api]" value="<?php esc_attr_e( $lead_options['aweber_api'] ); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://auth.aweber.com/1.0/oauth/authorize_app/<?php echo $aweber_appId; ?>" target="_blank">Get Your Authorization Code</a><br /><?php
                            require_once('aweber_api/aweber_api.php'); 
                            if($lead_options['aweber_api']=='') {
                                update_option('aweber_consumerKey', '');
                                update_option('aweber_consumerSecret', '');
                                update_option('aweber_accessKey', '');
                                update_option('aweber_accessSecret', '');
                            }
                            if($lead_options['aweber_api']!='') {
                                $authorization_code = $lead_options['aweber_api'];	
                                try {
                                    $auth = AWeberAPI::getDataFromAweberID($authorization_code);
                                    list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = $auth;
                                }
                                catch(AWeberAPIException $exc) {
                                    if($lead_options['aweber_api']=='') {
                                        print "<h3>AWeberAPIException:</h3>";
                                        print " <li> Type: $exc->type              <br>";
                                        print " <li> Msg : $exc->message           <br>";
                                        print " <li> Docs: $exc->documentation_url <br>";
                                        print "<hr>";
                                    }
                                }
                                if($accessKey!='') {
                                    update_option('aweber_consumerKey', $consumerKey);
                                    update_option('aweber_consumerSecret', $consumerSecret);
                                    update_option('aweber_accessKey', $accessKey);
                                    update_option('aweber_accessSecret', $accessSecret);
                                }
                            } 
                            $consumerKey      = get_option('aweber_consumerKey'); 
                            $consumerSecret   = get_option('aweber_consumerSecret'); 
                            $accessKey        = get_option('aweber_accessKey'); 
                            $accessSecret     = get_option('aweber_accessSecret'); 
                            if($lead_options['aweber_api']!='' || $consumerKey!='' || $consumerSecret!='' || $accessKey!='' || $accessSecret!='' ) { ?>
                                <a href="admin.php?page=page-lead.php&act=ResetAweber" class="button danger-button">Reset Key</a><?php
                            } ?>
                          </td>
                        </tr><?php 
                        if($accessKey!='') { ?>
                            <tr valign="top">
                              <th scope="row"><?php _e( 'Select List', 'olptheme' ); ?></th>
                              <td><?php
                                    $aweber = new AWeberAPI($consumerKey, $consumerSecret);
                                    $account = $aweber->getAccount($accessKey, $accessSecret);
                                    $account_id = $account->id; ?>
                                        <select name="olp_theme_lead_options[aweber_listId]" id="olp_theme_lead_options[aweber_api]">
                                        <option>Select List</option><?php
                                        foreach ($account->lists as $list) { ?>
                                            <option value="<?php echo $list->id; ?>" <?php if($list->id==$lead_options['aweber_listId']) { echo 'selected="selected"'; } ?>><?php echo $list->name; ?></option><?php 
                                        } ?>
                                    </select>
                                    <?php  ?>
                                </td>
                            </tr><?php 
                        } 
                        if($lead_options['aweber_listId']!='' && $lead_options['aweber_api']!='' && $accessSecret!='') { 
                            $list_id = $lead_options['aweber_listId'];
                            try {
                                $listURL = "/accounts/{$account_id}/lists/{$list_id}"; 
                                $list=$account->loadFromUrl($listURL); 
                                $custom_fields = $list->custom_fields;
                                if($lead_options['cf_message']=='message'.$list_id) {
                                    $custom_fields->create(array('name' => 'message'));
                                }
                                if($lead_options['cf_mobile']=='mobile'.$list_id) {
                                    $custom_fields->create(array('name' => 'mobile'));
                                }
                            }
                            catch(AWeberAPIException $exc) {
                                
                            } ?><tr valign="top">
                              <th scope="row"><?php _e( 'Add Custom Field', 'olptheme' ); ?></th>
                              <td>
                                  <label><input type="checkbox" value="mobile<?php echo $list_id; ?>" name="olp_theme_lead_options[cf_mobile]" id="olp_theme_lead_options[cf_mobile]" <?php if($lead_options['cf_mobile']=='mobile'.$list_id){ ?> checked="checked"<?php } ?> />&nbsp;&nbsp;Mobile</label><br />
                                  <label><input type="checkbox" value="message<?php echo $list_id; ?>" name="olp_theme_lead_options[cf_message]" id="olp_theme_lead_options[cf_message]" <?php if($lead_options['cf_message']=='message'.$list_id){ ?> checked="checked"<?php } ?> />&nbsp;&nbsp;Message</label>
                              </td>
                            </tr>
                            <tr valign="top">
                              <th scope="row"><?php _e( 'Redirection URL', 'olptheme' ); ?></th>
                              <td>
                                  <input type="text" value="<?php echo $lead_options['aweber_rURL'] ?>" name="olp_theme_lead_options[aweber_rURL]" id="olp_theme_lead_options[aweber_rURL]" />
                              </td>
                            </tr><?php 
                        } 
                    } ?>
                  </table>
                  
                </div><?php
                #----------------------------------------
                # "Aweber" Form Setting End 
                # "Get Response" Form Setting Start 
                #---------------------------------------- ?>
                <div class="getresponse area">
                  <table class="form-table table-responsive"><?php
                  if(in_array($themename, $NSthemename) ) {?>
                    <tr valign="top">
                      <th scope="row"><?php _e( 'Getresponse Script', 'olptheme' ); ?></th>
                      <td><textarea id="olp_theme_lead_options[grscript]" class="regular-text" name="olp_theme_lead_options[grscript]" rows="4" cols="50" style="width:25em;"><?php esc_attr_e( $lead_options['grscript'] ); ?><?php 
                        //esc_attr_e(substr($lead_options['grscript'], strpos($lead_options['grscript'], "</style>")+8));
                      ?></textarea></td>
                    </tr>
                  <?php } else { ?> 
                    <tr valign="top">
                      <th scope="row"><?php _e( 'GetResponse API', 'olptheme' ); ?></th>
                      <td><input id="olp_theme_lead_options[grapi]" class="regular-text" type="text" name="olp_theme_lead_options[grapi]" value="<?php esc_attr_e( $lead_options['grapi'] ); ?>" /></td>
                    </tr><?php
                    # initialize JSON-RPC client
                    $api_key = $lead_options['grapi']; //Place API key here
                        $api_url = 'http://api2.getresponse.com';
                        $client = new jsonRPCClient($api_url);
                        // Add contact to selected campaign id
                        try{
                            $ping = $client->ping($api_key);
                            foreach($ping as $p=>$v) {
                                $v;
                            } 
                            if($v == 'pong') { ?>
                                <tr valign="top">
                                  <th scope="row"><?php _e( 'Select WebForm', 'olptheme' ); ?></th>
                                  <td><?php
                                    $name2 = array();
                                    $webforms = $client->get_webforms($api_key); 
                                    //Get Campaigns name and id.
                                    ?><select name="olp_theme_lead_options[webformid]" id="olp_theme_lead_options[webformid]"><?php
                                    foreach($webforms as $webform) {
                                        $url2 = $webform['url'];
                                        $name2 = $webform['name']; ?>
                                        <option value="<?php echo $url2; ?>" <?php if($lead_options['webformid']==$url2){ echo 'selected="selected"';  } ?>><?php echo $name2; ?></option><?php
                                    }?></select></td>
                                <?php
                            } 
                        }
                        catch (Exception $e) {
                            $result = $e->getMessage();  
                            if($result == 'pong' ) {
                                echo $result;
                            } else {
                                if($api_key=='') {
                                    echo "Insert API key";
                                } else {
                                    echo "Invalid API Key";
                                }
                            }
                        } ; ?></tr>
                  <?php } ?>
                </table>
                </div><?php
                #----------------------------------------
                # "Get Response" Form Setting End 
                # "Mailchimp" Form Setting Start 
                #---------------------------------------- ?>
                <div class="mailchimp area">
                  <table class="form-table table-responsive"><?php
                  if(in_array($themename, $NSthemename) ) { ?>
                    <tr valign="top">
                      <th scope="row"><?php _e( 'Mailchimp Script', 'olptheme' ); ?></th>
                      <td><textarea id="olp_theme_lead_options[mailchimp_script]" class="regular-text" name="olp_theme_lead_options[mailchimp_script]" rows="4" cols="50"><?php esc_attr_e( $lead_options['mailchimp_script'] ); 
                        //esc_attr_e(substr($lead_options['mailchimp_script'], strpos($lead_options['mailchimp_script'], "</style>")+8));
                      ?></textarea></td>
                    </tr><?php 
                  } else { ?>
                    <tr valign="top">
                      <th scope="row"><?php _e( 'Mailchimp API Key', 'olptheme' ); ?></th>
                      <td><input id="olp_theme_lead_options[mc_api]" class="regular-text" type="text" name="olp_theme_lead_options[mc_api]" value="<?php esc_attr_e( $lead_options['mc_api'] ); ?>" />
                      </td>
                    </tr><?php
                    if($lead_options['mc_api']!='') {
                        $mc_apikey = $lead_options['mc_api']; // Enter your MailChimp API key here
                        $mc_api = new MCAPI($mc_apikey);
                        $retval = $mc_api->lists(); 
                        //echo $lead_options['subscribe_url_long'];?>
                        <tr valign="top">
                          <th scope="row"><?php _e( 'Select List', 'olptheme' ); ?></th>
                          <td>
                          <select name="olp_theme_lead_options[subscribe_url_long]" id="olp_theme_lead_options[subscribe_url_long]"><?php
                            foreach ($retval['data'] as $list){ ?>
                                <option value="<?php echo $list['subscribe_url_long']; ?>" <?php if($lead_options['subscribe_url_long']==$list['subscribe_url_long']) { echo "selected='selected'"; }?>><?php echo $list['name']; ?></option><?php 
                            } ?>
                          </select>
                          </td>
                        </tr>
                        <tr valign="top">
                          <th scope="row"><?php _e( '', 'olptheme' ); ?></th>
                          <td><?php
                            if($lead_options['subscribe_url_long']!='') {
                                //get ID from URL
                                $mc_list_id = substr($lead_options['subscribe_url_long'], strpos($lead_options['subscribe_url_long'], '&id=')+4);
                                $mv = $mc_api->listMergeVars($mc_list_id);  # Get Form Content
                                update_option('mc_fields', $mv); 
                            } ?>
                         </td>
                        </tr><?php
                    } 
                  } ?>
                  </table>
                </div><?php
                #----------------------------------------
                # "Mailchimp" Form Setting End 		
                # "Constant Contact" Form Setting Start 
                #---------------------------------------- ?>
                <div class="ConstantContact area">
                    <table class="form-table table-responsive"><?php
                    $NSthemename = array('Proficient', 'Proficient-Pro', 'Exquisite', 'Exquisite-Pro', 'Diligent-Pro', 'Diligent');
                    if(in_array($themename, $NSthemename) ) {
                        //
                    } else { ?>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Authorization', 'olptheme' ); ?></th>
                            <td><?php 
                            $nonce = wp_create_nonce( 'my-nonce' );
                            $varificationURL = urlencode( "http://api.bizomart.com/ctct?_wpnonce=".$nonce."&domain=".$domain_comp."&action=ctct_oauth" );
                            if(isset($_GET['code']) && isset($_GET['code'])!='') {
                                update_option('_ctct_AccessToken', $_GET['code']); 
                                update_option('_ctct_LoginUser', $_GET['username']);
                            } 
                            if(get_option('_ctct_AccessToken')=='') { ?>
                                <a href="https://oauth2.constantcontact.com/oauth2/oauth/siteowner/authorize?response_type=code&client_id=bpe9berdckhvhkvxthk42sbk&redirect_uri=<?php echo $varificationURL; ?>" class="button">Grant Authorization this site on ConstantContact.com</a><?php
                            } else { ?>
                                <a href="<?php $domain_comp; ?>admin.php?page=page-lead.php&act=ResetCtCt" class="button button-danger" onclick="return confirm('Are you sure want to remove all settings related to Constant contact.');">De-Authenticate ConstantContact</a>&nbsp;&nbsp;You are Login with <b><?php echo get_option('_ctct_LoginUser'); ?>.</b><?php
							echo get_option('_ctct_AccessToken');
                            } ?>
                            </td>
                        </tr>
						<tr valign="top">
                            <th scope="row"><?php _e( 'Select List', 'olptheme' ); ?></th>
                            <td>&nbsp;</td>
                        </tr><?php
                    }  ?>
                    </table>
                  
                </div><?php
                #----------------------------------------
                #	"Constant Contact" Form Setting End 		
                #	"iContact" Form Setting Start 
                #---------------------------------------- ?>
                <div class="iContact area">
                    <table class="form-table table-responsive"><?php
                    $NSthemename = array('Proficient', 'Proficient-Pro', 'Exquisite', 'Exquisite-Pro', 'Diligent-Pro', 'Diligent');
                    if(in_array($themename, $NSthemename) ) {
                        //
                    } else {  ?>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'iContact AppId', 'olptheme' ); ?></th>
                                <td><input type="text" name="olp_theme_lead_options[iContact_appId]" value="<?php esc_attr_e( $lead_options['iContact_appId'] ); ?>" /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'API Username', 'olptheme' ); ?></th>
                                <td><input type="text" name="olp_theme_lead_options[iContact_appUser]" value="<?php esc_attr_e( $lead_options['iContact_appUser'] ); ?>" /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'API Password', 'olptheme' ); ?></th>
                                <td><input type="text" name="olp_theme_lead_options[iContact_appPass]" value="<?php esc_attr_e( $lead_options['iContact_appPass'] ); ?>" /></td>
                            </tr><?php
                        
                        if($lead_options['iContact_appId']=='' && $lead_options['iContact_appUser']=='' && $lead_options['iContact_appPass']=='') {
                            //
                        } else { ?>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'Select List', 'olptheme' ); ?></th>
                                <td><?php
                                // Give the API your information
                                iContactApi::getInstance()->setConfig(array(
                                    'appId'       => $lead_options['iContact_appId'], 
                                    'apiPassword' => $lead_options['iContact_appPass'], 
                                    'apiUsername' => $lead_options['iContact_appUser']
                                ));
                                // Store the singleton
                                $oiContact = iContactApi::getInstance();
                                // Try to make the call(s)
                                try {
                                    // Return the lists
                                    $lists = $oiContact->getLists(); ?>
                                    <select name="olp_theme_lead_options[iContact_ListId]"><?php
                                        foreach($lists as $list) { ?>
                                            <option value="<?php echo $list->listId; ?>" <?php if($list->listId==$lead_options['iContact_ListId']) { echo "selected"; } ?>><?php echo $list->name; ?></option><?php
                                        } ?>
                                    </select><?php
                                } catch (Exception $oException) { // Catch any exceptions 
                                    // Dump errors
                                    var_dump($oiContact->getErrors());
                                    // Grab the last raw request data
                                    var_dump($oiContact->getLastRequest());
                                    // Grab the last raw response data
                                    var_dump($oiContact->getLastResponse());
                                } ?>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'Choose Fields', 'olptheme' ); ?></th>
                                <td>
                                    <label><input type="checkbox" checked="checked" disabled="disabled" />&nbsp;Email</label><br />
                                    <label><input type="checkbox" name="olp_theme_lead_options[iContact_Name]" <?php if(1==$lead_options['iContact_Name']) { echo "checked"; } ?> value="1" />&nbsp;Name</label><br />
                                    <label><input type="checkbox" name="olp_theme_lead_options[iContact_Mob]" <?php if(1==$lead_options['iContact_Mob']) { echo "checked"; } ?> value="1" />&nbsp;Mobile</label>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'Re-Direct URL', 'olptheme' ); ?></th>
                                <td><input type="url" name="olp_theme_lead_options[iContact_rURL]" value="<?php esc_attr_e( $lead_options['iContact_rURL'] ); ?>" /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php /*?><a href="<?php $domain_comp; ?>admin.php?page=page-lead.php&act=ResetiCt" class="button button-danger" onclick="return confirm('Are you sure want to remove all settings related to iContact.');">De-Authenticate iContact</a><?php */?></th>
                                <td>&nbsp;</td>
                            </tr><?php
                            
                        }
                    }  ?>
                    </table>
                  
                </div><?php
                #----------------------------------------
                # "iContact" Form Setting End 		
                # "Benchmark" Form Setting Start 
                #---------------------------------------- ?>
                <div class="Benchmark area">
                    <table class="form-table table-responsive"><?php
                    $NSthemename = array('Proficient', 'Proficient-Pro', 'Exquisite', 'Exquisite-Pro', 'Diligent-Pro', 'Diligent');
                    if(in_array($themename, $NSthemename) ) {
                        //
                    } else { ?>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Login', 'olptheme' ); ?></th>
                            <td><input type="text" name="olp_theme_lead_options[Benchmark_User]" placeholder="YOUR BENCHMARK LOGIN" value="<?php esc_attr_e( $lead_options['Benchmark_User'] ); ?>" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Password', 'olptheme' ); ?></th>
                            <td><input type="text" name="olp_theme_lead_options[Benchmark_Pass]" placeholder="YOUR BENCHMARK PASSWORD" value="<?php esc_attr_e( $lead_options['Benchmark_Pass'] ); ?>" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Test', 'olptheme' ); ?></th>
                            <td>&nbsp;</td>
                        </tr><?php
                    }  ?>
                    </table>
                  
                </div><?php
                #----------------------------------------#
                # "Benchmark" Form Setting End 			 
                # "IC Lead Form" Form Setting Start 	 
                #----------------------------------------# ?>
                <div class="InstaConsultant area">
                    <h3><?php _e( 'Insta Consultant Lead Generator form', 'olptheme' ); ?></h3>
                  <table class="form-table table-responsive">
                    <tr valign="top">
                      <td colspan="2">
                      <label><input id="olp_theme_lead_options[icname]" type="checkbox" name="olp_theme_lead_options[icname]" value="1" <?php checked( $lead_options['icname'], 1 ); ?> /><?php _e( ' Name', 'olptheme' ); ?></label>	&nbsp; 
                      <label><input id="olp_theme_lead_options[icemail]" type="checkbox" name="olp_theme_lead_options[icemail]" value="1" <?php checked( $lead_options['icemail'], 1 ); ?> /><?php _e( ' Email', 'olptheme' ); ?></label> &nbsp; 
                      <label><input id="olp_theme_lead_options[icmobile]" type="checkbox" name="olp_theme_lead_options[icmobile]" value="1" <?php checked( $lead_options['icmobile'], 1 ); ?> /><?php _e( ' Mobile', 'olptheme' ); ?></label> &nbsp; 
                      <?php
					  if($themename!="Car-Rental-Pro" && $themename!="Car-Rental")
					  {
					  ?>
                      <label><input id="olp_theme_lead_options[icdesc]" type="checkbox" name="olp_theme_lead_options[icdesc]" value="1" <?php checked( $lead_options['icdesc'], 1 ); ?> /><?php _e( ' Description', 'olptheme' ); ?></label> &nbsp; 
                      <?php
					  }
					  ?>
                      <?php
					  if($themename=="Car-Rental-Pro" or $themename=="Car-Rental")
					  {
					  ?>
                      <label><input id="olp_theme_lead_options[pickpoint]" type="checkbox" name="olp_theme_lead_options[pickpoint]" value="1" <?php checked( $lead_options['pickpoint'], 1 ); ?> /><?php _e( ' Pick Point', 'olptheme' ); ?></label> &nbsp; 
                      <label><input id="olp_theme_lead_options[age]" type="checkbox" name="olp_theme_lead_options[age]" value="1" <?php checked( $lead_options['age'], 1 ); ?> /><?php _e( ' Driver Age', 'olptheme' ); ?></label> &nbsp; 
                      <label><input id="olp_theme_lead_options[pickdate]" type="checkbox" name="olp_theme_lead_options[pickdate]" value="1" <?php checked( $lead_options['pickdate'], 1 ); ?> /><?php _e( ' Pick Date', 'olptheme' ); ?></label><br>

                      <br>Car Size: (enter car size / type in textarea below with comma seperation Example : small,medium,large)<br>
<br>
<textarea id="olp_theme_lead_options[carsize]" rows="4" cols="50" name="olp_theme_lead_options[carsize]"><?php echo $lead_options['carsize']; ?></textarea>
                      <?php
					  }
					  ?>          
                    </td>
                    </tr> <tr valign="top">
                      <th scope="row"><?php _e( 'Redirection URL', 'olptheme' ); ?></th>
                      <td><input id="olp_theme_lead_options[icurl]" type="url" name="olp_theme_lead_options[icurl]" value="<?php esc_attr_e( $lead_options['icurl'] ); ?>" /></td>
                    </tr>
                  </table>
                </div>
                </div>
            </div>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'olptheme' ); ?>" />
            </p><?php 
            if(strstr($themename, 'Pro') ) { ?>
                <p><a href="admin.php?page=page-responsesetting.php">Auto responder Email setting.</a></p><?php 
            } ?>
        </div>
        </form>
        </div>
    </div><?php 
}