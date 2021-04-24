<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">New <?php echo $title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form1" action="" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Title *</label>
                                <input type="text" name="title" class="form-control" placeholder="Title" value="">
                                <span class="error text-danger validation-message" data-field="title"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Message *</label>
                                <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                <span class="error text-danger validation-message" data-field="message"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Users *</label>
                                <select name="users[]" id="users" class="form-control select2" multiple>
                                    <?php foreach($users as $key=>$val){ ?>
                                        <option value="<?php echo $val->id; ?>"><?php echo $val->firstname.' '.$val->lastname; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="users[]"></span>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer text-right">
                <!-- <a href="<?php echo base_url(ADMIN.'notification'); ?>" class="btn btn-default">Cancel</a> -->
                <button class="btn btn-primary btn-submit" onclick="create_data()">Submit</button>
            </div>
        </div>
    </div>
</div>