<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid padding-bonus">
 <div class="bonus-wrapper">
  <!--<h1 class="h3 mb-4 text-gray-800"><?=my_caption('tts_file_view')?></h1>-->

  <div class="row">
    <div class="col-12">
	  <div class="card mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary1"><?=my_caption('tts_file_view')?></h6>
        </div>
        <div class="card-body text-14">
		  <div class="row mb-5 ">
		    <div class="col-lg-4">
			  <span class="font-weight-medium"><?=my_caption('tts_file_view_identifier')?> :</span><br><br>
			  <?=my_esc_html($rs->ids)?>
			</div>
		    <div class="col-lg-3 offset-lg-1 mt-lg-0 mt-2">
			  <span class="font-weight-medium"><?=my_caption('global_time')?> :</span><br><br>
			  <?=my_conversion_from_server_to_local_time(my_esc_html($rs->created_time), $this->user_timezone, $this->user_dtformat)?>
			</div>
			<div class="col-lg-4 mt-lg-0 mt-2">
			  <span class="font-weight-medium"><?=my_caption('tts_language')?> :</span><br><br>
			  <?=my_esc_html($rs->language_name)?>
			</div>
		  </div>
		  <div class="row mb-5">
		    <div class="col-lg-4">
			  <span class="font-weight-medium"><?=my_caption('tts_voice')?> :</span><br><br>
			  <?=my_esc_html($rs->voice_name)?>
			</div>
			<div class="col-lg-3 offset-lg-1 mt-lg-0 mt-2">
			  <span class="font-weight-medium"><?=my_caption('tts_engine')?> :</span><br><br>
			  <?=str_replace('neural', my_caption('tts_engine_neural'), str_replace('standard', my_caption('tts_engine_standard'), $rs->engine))?>
			</div>
			<div class="col-lg-4 mt-lg-0 mt-2">
			  <span class="font-weight-medium"><?=my_caption('tts_text_characters_count')?> :</span><br><br>
			  <?=my_esc_html($rs->characters_count)?>
			</div>
		  </div>
		  <div class="row mb-5">
		    <div class="col-lg-4">
			  <span class="font-weight-medium"><?=my_caption('tts_file_uri')?> :</span><br><br>
			  <?php
			  $tts_uri = $rs->tts_uri;
			  (substr($tts_uri, 0 ,4) != 'http') ?	$tts_uri = base_url($tts_uri) :null;
			  echo '<a href="' . $tts_uri . '" target="_blank">' . $tts_uri . '</a>';
			  ?>
			</div>
			<div class="col-lg-3 offset-lg-1 mt-lg-0 mt-2">
			  <span class="font-weight-medium"><?=my_caption('global_title')?> :</span><br><br>
			  <?=my_esc_html($rs->title)?>
			</div>
		    <div class="col-lg-4 mt-lg-0 mt-2">
			  <span class="font-weight-medium"><?=my_caption('tts_player_title')?> :</span><br><br>
			  <audio controls preload="none">
			    <source src="<?=$tts_uri?>" type="audio/mpeg">
			  </audio>
			</div>
		  </div>
		  <div class="row mb-5">
		    <div class="col-lg-12">
			  <span class="font-weight-medium"><?=my_caption('tts_text')?> :</span><br><br>
			  <textarea cols="40" rows="17" class="form-control"><?=my_esc_html($rs->text)?></textarea>
			</div>
		  </div>
		  <?php if (my_check_permission('TTS Management') && $this->router->method == 'admin_tts_view') { ?>
		  <div class="row mb-2">
		    <div class="col-lg-6">
			  <h5><?=my_caption('tts_admin_area')?></h5>
			</div>
		  </div>
		  <div class="row mb-5">
		    <div class="col-lg-6">
			  <span class="font-weight-medium"><?=my_caption('global_user')?> :</span><br><br>
			  <a href="<?php echo base_url('admin/edit_user/') . $rs->user_ids?>"><?=my_user_setting($rs->user_ids, 'email_address')?></a>
			</div>
		    <div class="col-lg-6">
			  <span class="font-weight-medium"><?=my_caption('tts_scheme')?> :</span><br><br>
			  <?=my_esc_html($rs->scheme)?>
			</div>
		  </div>
		  <div class="row mb-5">
		    <div class="col-lg-6">
			  <span class="font-weight-medium"><?=my_caption('tts_language_code')?> :</span><br><br>
			  <?=my_esc_html($rs->language_code)?>
			</div>
		    <div class="col-lg-6">
			  <span class="font-weight-medium"><?=my_caption('tts_voice_id')?> :</span><br><br>
			  <?=str_replace('{{engine}}', ucfirst($rs->engine), $rs->voice_id)?>
			</div>
		  </div>
		  <div class="row mb-5">
		    <div class="col-lg-12">
			  <span class="font-weight-medium"><?=my_caption('tts_file_storage')?> :</span><br><br>
			  <?=my_esc_html($rs->storage)?>
			</div>
		  </div>
		  <?php } ?>
		  <div class="row">
			<div class="col-lg-6 offset-6 text-right">
			  <button type="button" class="btn btn-success" onclick="window.history.back()"><?=my_caption('global_go_back')?></button>
			</div>
		  </div>
		</div>
      </div>
	</div>
  </div>
 </div>
  
</div>
<?php my_load_view($this->setting->theme, 'footer')?>