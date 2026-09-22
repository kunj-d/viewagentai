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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="title" class="form-control col-md-7 col-xs-12 title" name="title" value="<?= $title ?>">
                                    <span class='form_error'><?= form_error('title') ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="slug" class="form-control col-md-7 col-xs-12 title" name="slug" value="<?= $slug ?>">
                                    <span class='form_error'><?= form_error('slug') ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Thumbnail <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="thumbnail" onchange="readURL(this)">
                                    <span class='form_error'><?= form_error('thumbnail') ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Content <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="content" class="form-control col-md-7 col-xs-12" id="content"><?php echo $content; ?></textarea>
                                    <span class='form_error'><?= form_error('content') ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_type">Product type<span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="has_purchased" class="form-control col-md-7 col-xs-12">
                                        <option value="for_use" <?php if ($has_purchased == "1") { ?> selected="selected" <?php } ?>>For Use</option>
                                        <option value="to_buy" <?php if ($has_purchased == "0") { ?> selected="selected" <?php } ?>>To Buy</option>
                                    </select>
                                    <span class='form_error'><?= form_error('has_purchased') ?></span>
                                </div>
                            </div>




                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Package Plan<span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <?php
                                    if (!empty($package_plan)) {
                                        foreach ($package_plan as $plan) {
                                            ?>
                                            <li style="list-style:none;">
                                                <input type="checkbox" class="flat" name="package_plan[]" id="<?php echo $plan->id; ?>"  value="<?php echo $plan->id; ?>" <?php if (in_array($plan->id, $save_plan_id)) { ?> checked="checked" <?php } ?>/> <label for="<?php echo $plan->id; ?>" style="cursor:pointer;"> <?php
                                                    echo ucwords($plan->sell_type) . "-" . $plan->title . " => ";
                                                    if ($plan->price != "") {
                                                        echo $plan->price, " $";
                                                    } else {
                                                        echo "free";
                                                    }
                                                    ?></label>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <span class='form_error'><?= form_error('package_plan[]') ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_page_url">Sales Page Url <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="sales_page_url" class="form-control col-md-7 col-xs-12" id="sales_page_url" value="<?php echo $sales_page_url; ?>"></textarea>
                                    <span class='form_error'><?= form_error('sales_page_url') ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_type">Market Place<span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="market_place" class="form-control col-md-7 col-xs-12">
                                        <?php foreach ($all_market_place as $key => $val) { ?>
                                            <option value="<?= $val['title'] ?>" <?php if ($market_place == $val['title']) { ?> selected="selected" <?php } ?>><?= $val['display_title'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class='market_place'><?= form_error('title') ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ipn_product_id">JVZoo IPN Product id <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="ipn_product_id" class="form-control col-md-7 col-xs-12" id="ipn_product_id" value="<?php echo $ipn_product_id; ?>"></textarea>
                                    <span class='form_error'><?= form_error('ipn_product_id') ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ipn_product_id">ClickBank IPN Product id <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="cb_ipn_product_id" class="form-control col-md-7 col-xs-12" id="ipn_product_id" value="<?php echo $cb_ipn_product_id; ?>"></textarea>
                                    <span class='form_error'><?= form_error('cb_ipn_product_id') ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="price" class="form-control col-md-7 col-xs-12" id="price" value="<?php echo $price; ?>"></textarea>
                                    <span class='form_error'><?= form_error('price') ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zip_file_url">Customer Front End plan Zip File URL <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="zip_file_url" class="form-control col-md-7 col-xs-12" id="zip_file_url" value="<?php echo $zip_file_url; ?>"></textarea>
                                    <span class='form_error'><?= form_error('zip_file_url') ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zip_file_url_upsell">Customer Upsell plan Zip File URL <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="zip_file_url_upsell" class="form-control col-md-7 col-xs-12" id="zip_file_url_upsell" value="<?php echo $zip_file_url_upsell; ?>"></textarea>
                                    <span class='form_error'><?= form_error('zip_file_url_upsell') ?></span>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="free_report_url">Buyer(Member) Free Report Material Url <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="free_report_url" class="form-control col-md-7 col-xs-12" id="free_report_url" value="<?php echo $free_report_url; ?>"></textarea>
                                    <span class='form_error'><?= form_error('free_report_url') ?></span>
                                </div>
                            </div>





                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
                        .replace(/\s+/g, '-')           // Replace spaces with -
                        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                        .replace(/^-+/, '')             // Trim - from start of text
                        .replace(/-+$/, '');

                //$('.slug').val(slug);


            });

        });
    </script>

    <script>

        function readURL(input) {
            var file = input.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                $(input).val('');
                PNotify.removeAll();
                new PNotify({title: 'Error', text: 'The File type you are attempting to upload is not allowed.', type: 'error'});
                return false;
            }

        }
    </script>
