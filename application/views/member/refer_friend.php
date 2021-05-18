<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0"><?php echo $title; ?> Email </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3>Referral Code <br/> <?php echo $this->member->loginData->refer_code; ?></h3>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <input type="text" name="link" id="link" class="form-control" value="<?php echo base_url().'member/register/refer/'.$this->member->loginData->refer_code; ?>" readonly>
                                <span class="error text-danger validation-message" data-field="link"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-primary btn-copy">Copy</button>
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" value="">
                                <span class="error text-danger validation-message" data-field="email"></span>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4">
                            <button class="btn btn-primary btn-submit" onclick="edit_data()">Send Email</button>
                        </div> -->

                    </div>
                    <input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <!-- <a href="<?php echo base_url(MEMBER.'payment'); ?>" class="btn btn-default">Cancel</a> -->
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Send Email</button>
            </div>
        </div>
    </div>
</div>