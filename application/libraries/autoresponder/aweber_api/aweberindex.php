<?php

require_once('aweber_api.php'); 

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


?>