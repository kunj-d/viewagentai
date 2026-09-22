<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">
                <?= $detail->name ?>
                's plan Management</h4>
        </div>
        <form class="form-horizontal form-label-left" action="<?= $this->config->item('spanel_url') . 'update-user-plan' ?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Choose Plan </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="hidden" name="user_id" value="<?= $detail->id ?>"  />
                                        <?php foreach ($plan_list as $val) { ?>
                                            <input type="checkbox" class="flat" name="plan_id[]" value="<?= $val->id ?>" <?php if (in_array($val->id, $userPlans)) { ?> checked="checked"  <?php } ?>> &nbsp;<?= $val->title ?>
                                            <br />
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Add User Credit </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="credit" class="form-control">
                                            <option value="">Assign User Credit</option>
                                            <option value="350000">aitubestar 10k Credit</option>
                                            <option value="700000">aitubestar 20k Credit</option>
                                            <option value="1050000">aitubestar 30k Credit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
