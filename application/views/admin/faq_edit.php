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
                                    <label class="form-control-label">Question *</label>
                                    <input type="text" name="question" class="form-control" placeholder="Question" value="<?php echo $form_data->question; ?>">
                                    <span class="error text-danger validation-message" data-field="question"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Answer *</label>
                                    <textarea name="answer" class="form-control" placeholder="Answer"><?php echo $form_data->answer; ?></textarea>
                                    <span class="error text-danger validation-message" data-field="answer"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">FAQ for *</label>
                                    <select name="faq_for" id="faq_for" class="form-control">
                                        <option value="Service Provider" <?php if($form_data->faq_for == "Service Provider"){ echo "selected"; } ?>>Service Provider</option>
                                        <option value="Customer" <?php if($form_data->faq_for == "Customer"){ echo "selected"; } ?>>Customer</option>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="faq_for"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Status *</label>
                                    <br/>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="status" <?php if($form_data->status == "Enable"){ echo "checked"; } ?>>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'customer'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>