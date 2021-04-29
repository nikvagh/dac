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

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $form_data->name; ?>">
                                <span class="error text-danger validation-message" data-field="name"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Categories *</label>
                                <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                                    <?php foreach($permissions as $key=>$val){ ?>
                                        <option value="<?php echo $val->id; ?>" <?php if(in_array($val->id,$form_data->permission_ids)){ echo "selected"; } ?>><?php echo $val->text; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="permissions[]"></span>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'role'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>