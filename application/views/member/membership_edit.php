<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Edit <?php echo $title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $form_data->name; ?>">
                                <span class="error text-danger validation-message" data-field="name"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Year *</label>
                                <select name="year" id="" class="form-control select2">
                                    <?php foreach(get_last_30_yr() as $val){ ?>
                                        <option value="<?php echo $val; ?>" <?php if($val == $form_data->year){ echo "selected"; } ?>><?php echo $val; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="year"></span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                    <input type="hidden" name="member_id" value="<?php echo $this->member->loginData->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(MEMBER.'vehicle'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>