<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Send <?php echo $title; ?> To Customer</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Customers *</label>
                                <select name="customer[]" id="customer" class="form-control select2" multiple>
                                    <option value="All">All Customers</option>
                                    <?php foreach($customers as $key=>$val){ ?>
                                        <option value="<?php echo $val->id; ?>"><?php echo $val->firstname.' '.$val->lastname; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="customer[]"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'offer'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="send_data()">Submit</button>
            </div>
        </div>
    </div>
</div>