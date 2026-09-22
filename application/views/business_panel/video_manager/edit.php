<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= $page_title ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?= $this->config->item('spanel_url') . 'manage-product-manager' ?>"><i class="fa fa-backward"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
              
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Title<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="title" class="form-control col-md-7 col-xs-12" name="title" value="<?php echo $template->title ?>">
                  <span class='form_error'><?= form_error('title') ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">template_category<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!--<input type="template_category" id="title" class="form-control col-md-7 col-xs-12" name="template_category" >-->
                  <select name="template_category" id="title" class="form-control col-md-7 col-xs-12">
                      <option value="plain_bg" <?= $template->template_category == 'plain_bg' ? 'selected' : '' ?>>Plain-bg</option>
                      <option value="advertisement" <?= $template->template_category == 'advertisement' ? 'selected' : '' ?>>advertisement</option>
                      <option value="ecommerce" <?= $template->template_category == 'ecommerce' ? 'selected' : '' ?>>ecommerce</option>
                      <option value="doctor" <?= $template->template_category == 'doctor' ? 'selected' : '' ?>>Doctor</option>
                      <option value="food" <?= $template->template_category == 'food' ? 'selected' : '' ?>>Food</option>
                      <option value="real_estate" <?= $template->template_category == 'real_estate' ? 'selected' : '' ?>>Real Estate</option>
                      <option value="learningdevelopment" <?= $template->template_category == 'learningdevelopment' ? 'selected' : '' ?>>learning development</option>
                      <option value="explainervideo" <?= $template->template_category == 'explainervideo' ? 'selected' : '' ?>>explainer video</option>
                      <option value="socialmedia" <?= $template->template_category == 'socialmedia' ? 'selected' : '' ?>>social media</option>
                      <option value="businesscard" <?= $template->template_category == 'businesscard' ? 'selected' : '' ?>>business card</option>
                      <option value="healthandmedical" <?= $template->template_category == 'healthandmedical' ? 'selected' : '' ?>>healthand medical</option>
                      <option value="festival" <?= $template->template_category == 'festival' ? 'selected' : '' ?>>festival</option>
                      <option value="brekingnews" <?= $template->template_category == 'brekingnews' ? 'selected' : '' ?>>brekingnews</option>
                      <option value="other" <?= $template->template_category == 'other' ? 'selected' : '' ?>>other</option>
                    </select>

                </div>
              </div>
              
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">template_type<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!--<input type="text" id="template_type" class="form-control col-md-7 col-xs-12" name="template_type" >-->
                  <select name="template_type" id="title" class="form-control col-md-7 col-xs-12">
                  <option value="landscape" <?= $template->template_type == 'landscape' ? 'selected' : '' ?>>Landscape</option>
                  <option value="portrait" <?= $template->template_type == 'portrait' ? 'selected' : '' ?>>portrait</option>
                </select>

                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image Upload <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="image" class="form-control col-md-7 col-xs-12" name="image" accept="image/*" value="<?php echo $template->thumbnail_url ?>">
                  <span class='form_error'><?= form_error('image') ?></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="json_file">JSON Upload <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="json_file" class="form-control col-md-7 col-xs-12" name="json_file" accept="application/json">
                  <span class='form_error'><?= form_error('json_file') ?></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="json_file">Video Upload <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="video_file" class="form-control col-md-7 col-xs-12" name="video_file" accept="video/mp4">
                  <span class='form_error'><?= form_error('video_file') ?></span>
                </div>
              </div>


              <div class="ln_solid"></div>
              <div class="form-group"> 
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success disable-btn" name="create-video" value="true">Submit</button>
                </div>
              </div>

            </form>
          </div>


        </div>
      </div>


    </div>
  </div>
  <!-- /page content -->
  <script>
  
//   $('.disable-btn').on('click', function() {
//         $(this).prop('disabled', true);
//     });

    /*-------------------------- Add Email Tag starts here ---------------------------------------------------*/
    $('body').delegate(".add_email_tag", 'click', function() {

      var perVal = $(this).val();
      CKEDITOR.instances.editor1.insertText(perVal);
    });
    /*--------------------------  Add Email Tag ends here ---------------------------------------------------*/

    $(document).ready(function() {
      $('body').delegate(".title", 'keyup blur', function() {
        var text = $(this).val();
        var slug = text.toString().toLowerCase()
          .replace(/\s+/g, '-') // Replace spaces with -
          .replace(/[^\w\-]+/g, '') // Remove all non-word chars
          .replace(/\-\-+/g, '-') // Replace multiple - with single -
          .replace(/^-+/, '') // Trim - from start of text
          .replace(/-+$/, '');

        //$('.slug').val(slug);


      });

    });
  </script>